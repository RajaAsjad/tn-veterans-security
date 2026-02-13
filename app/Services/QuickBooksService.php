<?php

namespace App\Services;

use App\Models\SiteSetting;
use App\Models\Payment;
use App\Models\ServiceBooking;
use Illuminate\Support\Facades\Log;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\OAuth\OAuth2\OAuth2LoginHelper;
use QuickBooksOnline\API\Core\OAuth\OAuth2\OAuth2AccessToken;
use QuickBooksOnline\API\Facades\Invoice;
use QuickBooksOnline\API\Facades\Payment as QuickBooksPayment;

class QuickBooksService
{
    protected $dataService;
    protected $settings;

    public function __construct()
    {
        $this->settings = SiteSetting::first();
    }

    /**
     * Initialize QuickBooks DataService
     */
    protected function initializeDataService()
    {
        if (!$this->settings || !$this->settings->quickbooks_enabled) {
            throw new \Exception('QuickBooks integration is not enabled.');
        }

        if (empty($this->settings->quickbooks_client_id) || empty($this->settings->quickbooks_client_secret)) {
            throw new \Exception('QuickBooks API credentials are not configured.');
        }

        $environment = $this->settings->quickbooks_environment ?? 'sandbox';
        
        // Get redirect URI from settings or use default
        $redirectUri = config('app.url') . '/admin/quickbooks/callback';
        
        $dataService = DataService::Configure([
            'auth_mode' => 'oauth2',
            'ClientID' => $this->settings->quickbooks_client_id,
            'ClientSecret' => $this->settings->quickbooks_client_secret,
            'RedirectURI' => $redirectUri,
            'scope' => 'com.intuit.quickbooks.accounting',
            'baseUrl' => $environment === 'production' ? 'production' : 'development',
        ]);

        // Set access token if available (SDK expects OAuth2AccessToken object, not a string)
        if (!empty($this->settings->quickbooks_access_token) && !empty($this->settings->quickbooks_refresh_token) && !empty($this->settings->quickbooks_company_id)) {
            // Refresh token first (access tokens expire in 1 hour); use standalone helper
            $token = $this->refreshAndPersistToken();
            $token->setRealmID($this->settings->quickbooks_company_id);
            $dataService->updateOAuth2Token($token);
        }

        $this->dataService = $dataService;
        return $dataService;
    }

    /**
     * Refresh OAuth2 access token and save new tokens to settings. Returns the new token.
     */
    protected function refreshAndPersistToken(): OAuth2AccessToken
    {
        $oauth2Helper = new OAuth2LoginHelper(
            $this->settings->quickbooks_client_id,
            $this->settings->quickbooks_client_secret
        );
        try {
            $newToken = $oauth2Helper->refreshAccessTokenWithRefreshToken($this->settings->quickbooks_refresh_token);
        } catch (\Exception $e) {
            Log::warning('QuickBooks token refresh failed', ['error' => $e->getMessage()]);
            throw new \Exception('QuickBooks token expired or invalid. Please reconnect in Site Settings → QuickBooks: ' . $e->getMessage());
        }
        // Persist new tokens (QuickBooks may return a new refresh token)
        $this->settings->update([
            'quickbooks_access_token' => $newToken->getAccessToken(),
            'quickbooks_refresh_token' => $newToken->getRefreshToken(),
        ]);
        $this->settings->refresh();
        return $newToken;
    }

    /**
     * Sync payment to QuickBooks
     */
    public function syncPayment(Payment $payment): array
    {
        try {
            if (!$this->settings || !$this->settings->quickbooks_enabled) {
                return [
                    'success' => false,
                    'message' => 'QuickBooks integration is not enabled.',
                ];
            }

            // Check if already synced
            if ($payment->synced_to_quickbooks) {
                return [
                    'success' => true,
                    'message' => 'Payment already synced to QuickBooks.',
                    'invoice_id' => $payment->quickbooks_invoice_id,
                    'payment_id' => $payment->quickbooks_payment_id,
                ];
            }

            $this->initializeDataService();

            // Get booking details
            $booking = $payment->booking;
            if (!$booking) {
                throw new \Exception('Booking not found for payment.');
            }

            $service = $booking->service;
            $customer = $payment->customer;

            // Create or get customer in QuickBooks
            $qbCustomer = $this->getOrCreateCustomer($customer);

            // Create invoice
            $invoice = $this->createInvoice($payment, $booking, $service, $qbCustomer);

            // Create payment record
            $qbPayment = $this->createPaymentRecord($payment, $invoice);

            // Update payment record
            $payment->markSyncedToQuickBooks(
                $invoice->Id ?? null,
                $qbPayment->Id ?? null
            );

            Log::info('Payment synced to QuickBooks', [
                'payment_id' => $payment->id,
                'invoice_id' => $invoice->Id ?? null,
                'qb_payment_id' => $qbPayment->Id ?? null,
            ]);

            return [
                'success' => true,
                'message' => 'Payment synced to QuickBooks successfully.',
                'invoice_id' => $invoice->Id ?? null,
                'payment_id' => $qbPayment->Id ?? null,
            ];

        } catch (\Exception $e) {
            Log::error('QuickBooks sync error', [
                'payment_id' => $payment->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'message' => 'Failed to sync payment to QuickBooks: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Get or create customer in QuickBooks
     */
    protected function getOrCreateCustomer($customer)
    {
        // Search for existing customer by email
        $queryString = "SELECT * FROM Customer WHERE PrimaryEmailAddr = '{$customer->email}'";
        $customers = $this->dataService->Query($queryString);

        if (!empty($customers) && count($customers) > 0) {
            return $customers[0];
        }

        // Create new customer
        $customerObj = \QuickBooksOnline\API\Facades\Customer::create([
            'DisplayName' => $customer->name ?? $customer->email,
            'PrimaryEmailAddr' => [
                'Address' => $customer->email,
            ],
            'GivenName' => $customer->name ?? 'Customer',
            'FamilyName' => '',
        ]);

        $resultingCustomerObj = $this->dataService->Add($customerObj);
        return $resultingCustomerObj;
    }

    /**
     * Create invoice in QuickBooks
     */
    protected function createInvoice(Payment $payment, ServiceBooking $booking, $service, $qbCustomer)
    {
        $invoice = Invoice::create([
            'Line' => [
                [
                    'Amount' => $payment->amount,
                    'DetailType' => 'SalesItemLineDetail',
                    'SalesItemLineDetail' => [
                        'ItemRef' => [
                            'value' => $this->getOrCreateServiceItem($service)->Id,
                            'name' => $service->title,
                        ],
                        'Qty' => $booking->number_of_students ?? 1,
                    ],
                ],
            ],
            'CustomerRef' => [
                'value' => $qbCustomer->Id,
            ],
            'TxnDate' => $payment->payment_date->format('Y-m-d'),
            'DueDate' => $payment->payment_date->format('Y-m-d'),
            'TotalAmt' => $payment->amount,
            'PrivateNote' => "Booking #{$booking->id} - {$service->title}",
        ]);

        $resultingInvoice = $this->dataService->Add($invoice);
        return $resultingInvoice;
    }

    /**
     * Get or create service item in QuickBooks
     */
    protected function getOrCreateServiceItem($service)
    {
        // Search for existing item
        $queryString = "SELECT * FROM Item WHERE Name = '{$service->title}'";
        $items = $this->dataService->Query($queryString);

        if (!empty($items) && count($items) > 0) {
            return $items[0];
        }

        // Create new item
        $item = \QuickBooksOnline\API\Facades\Item::create([
            'Name' => $service->title,
            'Type' => 'Service',
            'IncomeAccountRef' => [
                'value' => '1', // Default income account - should be configured
            ],
        ]);

        $resultingItem = $this->dataService->Add($item);
        return $resultingItem;
    }

    /**
     * Create payment record in QuickBooks
     */
    protected function createPaymentRecord(Payment $payment, $invoice)
    {
        $customerRefValue = is_object($invoice->CustomerRef) && isset($invoice->CustomerRef->value)
            ? $invoice->CustomerRef->value
            : (string) $invoice->CustomerRef;

        $qbPayment = QuickBooksPayment::create([
            'CustomerRef' => [
                'value' => $customerRefValue,
            ],
            'TotalAmt' => $payment->amount,
            'TxnDate' => $payment->payment_date->format('Y-m-d'),
            'Line' => [
                [
                    'Amount' => $payment->amount,
                    'LinkedTxn' => [
                        [
                            'TxnId' => $invoice->Id,
                            'TxnType' => 'Invoice',
                        ],
                    ],
                ],
            ],
        ]);

        $resultingPayment = $this->dataService->Add($qbPayment);
        return $resultingPayment;
    }

    /**
     * Test QuickBooks connection
     */
    public function testConnection(): array
    {
        try {
            $this->initializeDataService();
            $companyInfo = $this->dataService->getCompanyInfo();
            
            return [
                'success' => true,
                'message' => 'Connection successful.',
                'company_name' => $companyInfo->CompanyName ?? 'N/A',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Connection failed: ' . $e->getMessage(),
            ];
        }
    }
}
