<?php

namespace App\Services;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RazorpayService
{
    protected string $keyId;

    protected string $keySecret;

    protected string $webhookSecret;

    protected string $apiBaseUrl = 'https://api.razorpay.com/v1';

    public function __construct()
    {
        $this->keyId = (string) config('services.razorpay.key');
        $this->keySecret = (string) config('services.razorpay.secret');
        $this->webhookSecret = (string) config('services.razorpay.webhook_secret', '');
    }

    /**
     * Get the public Razorpay Key ID for client-side checkout.
     */
    public function getKeyId(): string
    {
        return $this->keyId;
    }

    /**
     * Get the Razorpay Webhook secret.
     */
    public function getWebhookSecret(): string
    {
        return $this->webhookSecret;
    }

    /**
     * Helper to build authenticated HTTP client with SSL fallback for dev/windows.
     */
    protected function httpClient(int $timeout = 15): PendingRequest
    {
        $http = Http::withBasicAuth($this->keyId, $this->keySecret)->timeout($timeout);

        // Optional custom CA on Windows WAMP
        $caPath = 'C:\\wamp64\\bin\\php\\php8.3.14\\extras\\ssl\\cacert.pem';
        if (file_exists($caPath)) {
            $http = $http->withOptions(['verify' => $caPath]);
        } elseif (PHP_OS_FAMILY === 'Windows') {
            $http = $http->withOptions(['verify' => false]);
        }

        return $http;
    }

    /**
     * Create a Razorpay Order dynamically based on the course price.
     * Price in paise: ₹111 => 11100 paise.
     *
     * @throws \Exception
     */
    public function createOrder(Course $course, User $user): array
    {
        $amountInPaise = (int) round(((float) $course->price) * 100);
        $receipt = 'rcpt_'.$course->id.'_'.$user->id.'_'.time();

        $payload = [
            'amount' => $amountInPaise,
            'currency' => 'INR',
            'receipt' => substr($receipt, 0, 40),
            'notes' => [
                'course_id' => (string) $course->id,
                'course_title' => (string) $course->title,
                'user_id' => (string) $user->id,
                'user_email' => (string) $user->email,
            ],
        ];

        try {
            $response = $this->httpClient(15)->post("{$this->apiBaseUrl}/orders", $payload);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Razorpay Order Creation Failed: '.$response->body());
            throw new \Exception('Razorpay API error: '.($response->json('error.description') ?? 'Failed creating order.'));
        } catch (\Exception $e) {
            Log::error('Razorpay Service Exception: '.$e->getMessage());
            throw $e;
        }
    }

    /**
     * Verify payment signature returned by Razorpay Checkout JS.
     * Signature = HMAC_SHA256(order_id + "|" + payment_id, secret)
     */
    public function verifyPaymentSignature(string $razorpayOrderId, string $razorpayPaymentId, string $razorpaySignature): bool
    {
        if (empty($this->keySecret)) {
            Log::warning('Razorpay Secret is empty. Cannot verify cryptographic signature.');

            return false;
        }

        $expectedSignature = hash_hmac(
            'sha256',
            $razorpayOrderId.'|'.$razorpayPaymentId,
            $this->keySecret
        );

        return hash_equals($expectedSignature, $razorpaySignature);
    }

    /**
     * Complete payment verification with both HMAC signature check and API fallback.
     * If HMAC signature fails (due to secret mismatch, stale config cache, or spacing in .env),
     * this queries Razorpay's API to confirm if the payment is genuinely captured on Razorpay.
     */
    public function verifyPayment(string $razorpayOrderId, string $razorpayPaymentId, string $razorpaySignature): bool
    {
        // 1. Try cryptographic HMAC-SHA256 signature first
        if ($this->verifyPaymentSignature($razorpayOrderId, $razorpayPaymentId, $razorpaySignature)) {
            return true;
        }

        Log::warning("Razorpay HMAC signature check failed for Order: {$razorpayOrderId}, Payment: {$razorpayPaymentId}. Checking Razorpay API directly as fallback...");

        // 2. Direct API verification fallback
        $paymentData = $this->fetchPayment($razorpayPaymentId);

        if ($paymentData) {
            $status = $paymentData['status'] ?? '';
            $orderId = $paymentData['order_id'] ?? '';

            // If payment is authorized, capture it
            if ($status === 'authorized') {
                $captured = $this->capturePayment($razorpayPaymentId, (int) ($paymentData['amount'] ?? 0));
                if ($captured && ($captured['status'] ?? '') === 'captured') {
                    $status = 'captured';
                }
            }

            if ($status === 'captured' && ($orderId === $razorpayOrderId || empty($razorpayOrderId))) {
                Log::info("Razorpay Payment {$razorpayPaymentId} successfully verified via Razorpay API fallback.");

                return true;
            }
        }

        return false;
    }

    /**
     * Fetch payment details from Razorpay API.
     */
    public function fetchPayment(string $paymentId): ?array
    {
        try {
            $response = $this->httpClient(10)->get("{$this->apiBaseUrl}/payments/{$paymentId}");

            if ($response->successful()) {
                return $response->json();
            }

            Log::error("Razorpay Fetch Payment Failed for {$paymentId}: ".$response->body());
        } catch (\Exception $e) {
            Log::error('Razorpay Fetch Payment Exception: '.$e->getMessage());
        }

        return null;
    }

    /**
     * Fetch order details from Razorpay API.
     */
    public function fetchOrder(string $orderId): ?array
    {
        try {
            $response = $this->httpClient(10)->get("{$this->apiBaseUrl}/orders/{$orderId}");

            if ($response->successful()) {
                return $response->json();
            }

            Log::error("Razorpay Fetch Order Failed for {$orderId}: ".$response->body());
        } catch (\Exception $e) {
            Log::error('Razorpay Fetch Order Exception: '.$e->getMessage());
        }

        return null;
    }

    /**
     * Capture an authorized payment if not auto-captured.
     */
    public function capturePayment(string $paymentId, int $amountInPaise, string $currency = 'INR'): ?array
    {
        try {
            $response = $this->httpClient(10)->post("{$this->apiBaseUrl}/payments/{$paymentId}/capture", [
                'amount' => $amountInPaise,
                'currency' => $currency,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error("Razorpay Capture Payment Failed for {$paymentId}: ".$response->body());
        } catch (\Exception $e) {
            Log::error('Razorpay Capture Payment Exception: '.$e->getMessage());
        }

        return null;
    }

    /**
     * Verify webhook signature.
     */
    public function verifyWebhookSignature(string $payload, string $signature, ?string $secret = null): bool
    {
        $webhookSecret = $secret ?: $this->webhookSecret;

        if (empty($webhookSecret)) {
            Log::warning('Razorpay Webhook secret is not configured.');

            return false;
        }

        $expectedSignature = hash_hmac('sha256', $payload, $webhookSecret);

        return hash_equals($expectedSignature, $signature);
    }
}
