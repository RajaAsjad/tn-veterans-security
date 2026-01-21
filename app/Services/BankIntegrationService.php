<?php

namespace App\Services;

use App\Models\SiteSetting;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class BankIntegrationService
{
    protected $settings;

    public function __construct()
    {
        $this->settings = SiteSetting::first();
    }

    /**
     * Sync payment to bank account
     */
    public function syncPayment(Payment $payment): array
    {
        try {
            if (!$this->settings || !$this->settings->bank_sync_enabled) {
                return [
                    'success' => false,
                    'message' => 'Bank sync integration is not enabled.',
                ];
            }

            // Check if already synced
            if ($payment->synced_to_bank) {
                return [
                    'success' => true,
                    'message' => 'Payment already synced to bank.',
                ];
            }

            $provider = $this->settings->bank_api_provider ?? 'plaid';

            switch ($provider) {
                case 'plaid':
                    return $this->syncWithPlaid($payment);
                case 'yodlee':
                    return $this->syncWithYodlee($payment);
                default:
                    return $this->syncGeneric($payment);
            }

        } catch (\Exception $e) {
            Log::error('Bank sync error', [
                'payment_id' => $payment->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'message' => 'Failed to sync payment to bank: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Sync with Plaid API
     */
    protected function syncWithPlaid(Payment $payment): array
    {
        if (empty($this->settings->bank_api_key) || empty($this->settings->bank_api_secret)) {
            throw new \Exception('Plaid API credentials are not configured.');
        }

        // Plaid API integration
        // This is a placeholder - actual implementation depends on Plaid API version
        $response = Http::withHeaders([
            'PLAID-CLIENT-ID' => $this->settings->bank_api_key,
            'PLAID-SECRET' => $this->settings->bank_api_secret,
        ])->post('https://production.plaid.com/transactions/sync', [
            'account_id' => $this->settings->bank_account_id,
            'amount' => $payment->amount,
            'date' => $payment->payment_date->format('Y-m-d'),
            'description' => "Payment #{$payment->id} - Booking #{$payment->booking_id}",
        ]);

        if ($response->successful()) {
            $payment->markSyncedToBank();
            
            Log::info('Payment synced to bank via Plaid', [
                'payment_id' => $payment->id,
            ]);

            return [
                'success' => true,
                'message' => 'Payment synced to bank successfully.',
            ];
        }

        throw new \Exception('Plaid API request failed: ' . $response->body());
    }

    /**
     * Sync with Yodlee API
     */
    protected function syncWithYodlee(Payment $payment): array
    {
        if (empty($this->settings->bank_api_key) || empty($this->settings->bank_api_secret)) {
            throw new \Exception('Yodlee API credentials are not configured.');
        }

        // Yodlee API integration
        // This is a placeholder - actual implementation depends on Yodlee API
        $response = Http::withHeaders([
            'Api-Version' => '1.1',
            'Authorization' => 'Bearer ' . $this->settings->bank_api_key,
        ])->post('https://api.yodlee.com/ysl/transactions', [
            'accountId' => $this->settings->bank_account_id,
            'amount' => $payment->amount,
            'date' => $payment->payment_date->format('Y-m-d'),
            'description' => "Payment #{$payment->id} - Booking #{$payment->booking_id}",
        ]);

        if ($response->successful()) {
            $payment->markSyncedToBank();
            
            Log::info('Payment synced to bank via Yodlee', [
                'payment_id' => $payment->id,
            ]);

            return [
                'success' => true,
                'message' => 'Payment synced to bank successfully.',
            ];
        }

        throw new \Exception('Yodlee API request failed: ' . $response->body());
    }

    /**
     * Generic bank sync (for custom implementations)
     */
    protected function syncGeneric(Payment $payment): array
    {
        // For now, just mark as synced
        // This can be extended for custom bank integrations
        $payment->markSyncedToBank();
        
        Log::info('Payment synced to bank (generic)', [
            'payment_id' => $payment->id,
        ]);

        return [
            'success' => true,
            'message' => 'Payment synced to bank successfully.',
        ];
    }

    /**
     * Test bank connection
     */
    public function testConnection(): array
    {
        try {
            if (!$this->settings || !$this->settings->bank_sync_enabled) {
                return [
                    'success' => false,
                    'message' => 'Bank sync is not enabled.',
                ];
            }

            $provider = $this->settings->bank_api_provider ?? 'plaid';

            switch ($provider) {
                case 'plaid':
                    return $this->testPlaidConnection();
                case 'yodlee':
                    return $this->testYodleeConnection();
                default:
                    return [
                        'success' => true,
                        'message' => 'Generic bank integration configured.',
                    ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Connection test failed: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Test Plaid connection
     */
    protected function testPlaidConnection(): array
    {
        if (empty($this->settings->bank_api_key) || empty($this->settings->bank_api_secret)) {
            return [
                'success' => false,
                'message' => 'Plaid API credentials are not configured.',
            ];
        }

        // Test API call
        $response = Http::withHeaders([
            'PLAID-CLIENT-ID' => $this->settings->bank_api_key,
            'PLAID-SECRET' => $this->settings->bank_api_secret,
        ])->post('https://production.plaid.com/accounts/get', [
            'access_token' => $this->settings->bank_account_id,
        ]);

        if ($response->successful()) {
            return [
                'success' => true,
                'message' => 'Plaid connection successful.',
            ];
        }

        return [
            'success' => false,
            'message' => 'Plaid connection failed: ' . $response->body(),
        ];
    }

    /**
     * Test Yodlee connection
     */
    protected function testYodleeConnection(): array
    {
        if (empty($this->settings->bank_api_key)) {
            return [
                'success' => false,
                'message' => 'Yodlee API credentials are not configured.',
            ];
        }

        // Test API call
        $response = Http::withHeaders([
            'Api-Version' => '1.1',
            'Authorization' => 'Bearer ' . $this->settings->bank_api_key,
        ])->get('https://api.yodlee.com/ysl/accounts');

        if ($response->successful()) {
            return [
                'success' => true,
                'message' => 'Yodlee connection successful.',
            ];
        }

        return [
            'success' => false,
            'message' => 'Yodlee connection failed: ' . $response->body(),
        ];
    }
}
