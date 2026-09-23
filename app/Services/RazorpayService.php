<?php

namespace App\Services;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RazorpayService
{
    protected string $keyId;
    protected string $keySecret;
    protected string $apiBaseUrl = 'https://api.razorpay.com/v1';

    public function __construct()
    {
        $this->keyId = (string) config('services.razorpay.key');
        $this->keySecret = (string) config('services.razorpay.secret');
    }

    /**
     * Get the public Razorpay Key ID for client-side checkout.
     */
    public function getKeyId(): string
    {
        return $this->keyId;
    }

    /**
     * Create a Razorpay Order dynamically based on the course price.
     * Price in paise: ₹111 => 11100 paise.
     *
     * @param Course $course
     * @param User $user
     * @return array
     * @throws \Exception
     */
    public function createOrder(Course $course, User $user): array
    {
        $amountInPaise = (int) round(((float) $course->price) * 100);
        $receipt = 'rcpt_' . $course->id . '_' . $user->id . '_' . time();

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
            $http = Http::withBasicAuth($this->keyId, $this->keySecret)->timeout(15);
            
            // Check for cacert on Windows WAMP
            $caPath = 'C:\\wamp64\\bin\\php\\php8.3.14\\extras\\ssl\\cacert.pem';
            if (file_exists($caPath)) {
                $http = $http->withOptions(['verify' => $caPath]);
            } else {
                $http = $http->withOptions(['verify' => false]);
            }

            $response = $http->post("{$this->apiBaseUrl}/orders", $payload);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Razorpay Order Creation Failed: ' . $response->body());
            throw new \Exception('Razorpay API error: ' . ($response->json('error.description') ?? 'Failed creating order.'));
        } catch (\Exception $e) {
            Log::error('Razorpay Service Exception: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Verify payment signature returned by Razorpay Checkout JS.
     * Signature = HMAC_SHA256(order_id + "|" + payment_id, secret)
     *
     * @param string $razorpayOrderId
     * @param string $razorpayPaymentId
     * @param string $razorpaySignature
     * @return bool
     */
    public function verifyPaymentSignature(string $razorpayOrderId, string $razorpayPaymentId, string $razorpaySignature): bool
    {
        $expectedSignature = hash_hmac(
            'sha256',
            $razorpayOrderId . '|' . $razorpayPaymentId,
            $this->keySecret
        );

        return hash_equals($expectedSignature, $razorpaySignature);
    }

    /**
     * Fetch payment details from Razorpay API.
     *
     * @param string $paymentId
     * @return array|null
     */
    public function fetchPayment(string $paymentId): ?array
    {
        try {
            $http = Http::withBasicAuth($this->keyId, $this->keySecret)->timeout(10);
            $caPath = 'C:\\wamp64\\bin\\php\\php8.3.14\\extras\\ssl\\cacert.pem';
            if (file_exists($caPath)) {
                $http = $http->withOptions(['verify' => $caPath]);
            } else {
                $http = $http->withOptions(['verify' => false]);
            }

            $response = $http->get("{$this->apiBaseUrl}/payments/{$paymentId}");

            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Exception $e) {
            Log::error('Razorpay Fetch Payment Exception: ' . $e->getMessage());
        }

        return null;
    }
}
