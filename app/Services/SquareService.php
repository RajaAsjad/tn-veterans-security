<?php

namespace App\Services;

use App\Models\SiteSetting;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SquareService
{
    protected $settings;

    public function __construct()
    {
        $this->settings = SiteSetting::first();
    }

    protected function getBaseUrl(): string
    {
        $env = $this->settings?->getAttribute('square_environment') ?? 'sandbox';
        return $env === 'production'
            ? 'https://connect.squareup.com'
            : 'https://connect.squareupsandbox.com';
    }

    public function isEnabled(): bool
    {
        if (!$this->settings) {
            return false;
        }
        $enabled = $this->settings->getAttribute('square_enabled');
        $appId = trim((string) ($this->settings->getAttribute('square_application_id') ?? ''));
        $token = trim((string) ($this->settings->getAttribute('square_access_token') ?? ''));
        $locationId = trim((string) ($this->settings->getAttribute('square_location_id') ?? ''));
        return ($enabled === true || $enabled === 1 || $enabled === '1')
            && $appId !== ''
            && $token !== ''
            && $locationId !== '';
    }

    /**
     * Get Application ID for Web Payments SDK (public, used in frontend).
     */
    public function getApplicationId(): ?string
    {
        return $this->settings?->getAttribute('square_application_id') ?? null;
    }

    /**
     * Get Location ID.
     */
    public function getLocationId(): ?string
    {
        return $this->settings?->getAttribute('square_location_id') ?? null;
    }

    /**
     * Get Web Payments SDK script URL based on environment.
     */
    public function getWebPaymentsScriptUrl(): string
    {
        $env = $this->settings?->getAttribute('square_environment') ?? 'sandbox';
        return $env === 'production'
            ? 'https://web.squarecdn.com/v1/square.js'
            : 'https://sandbox.web.squarecdn.com/v1/square.js';
    }

    /**
     * Create a payment using Square Payments API.
     *
     * @param string $sourceId Payment nonce from Web Payments SDK (e.g. cnon:xxx)
     * @param int $amountCents Amount in cents (e.g. 1000 = $10.00)
     * @param string $idempotencyKey Unique key to prevent duplicate charges
     * @param string|null $reference Optional reference (e.g. booking ID)
     */
    public function createPayment(string $sourceId, int $amountCents, string $idempotencyKey, ?string $reference = null): array
    {
        if (!$this->isEnabled()) {
            return [
                'success' => false,
                'message' => 'Square payment is not configured.',
            ];
        }

        $url = $this->getBaseUrl() . '/v2/payments';

        $body = [
            'source_id' => $sourceId,
            'idempotency_key' => $idempotencyKey,
            'amount_money' => [
                'amount' => $amountCents,
                'currency' => 'USD',
            ],
            'location_id' => $this->settings->square_location_id,
        ];

        if ($reference) {
            $body['reference_id'] = $reference;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->settings->square_access_token,
            'Content-Type' => 'application/json',
            'Square-Version' => '2024-01-18',
        ])->post($url, $body);

        $data = $response->json();

        if (!$response->successful()) {
            Log::error('Square payment failed', [
                'status' => $response->status(),
                'body' => $data,
            ]);
            $message = $data['errors'][0]['detail'] ?? $data['errors'][0]['code'] ?? $response->body();
            return [
                'success' => false,
                'message' => $message,
                'square_payment_id' => null,
            ];
        }

        $payment = $data['payment'] ?? null;
        return [
            'success' => true,
            'message' => 'Payment successful.',
            'square_payment_id' => $payment['id'] ?? null,
        ];
    }
}
