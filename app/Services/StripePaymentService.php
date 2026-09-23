<?php

namespace App\Services;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Str;

class StripePaymentService
{
    /**
     * Process a mock card charge for demonstration.
     * In production, this can call Stripe\PaymentIntent::create or Stripe\Checkout\Session.
     *
     * @param User $user
     * @param Course $course
     * @param array $paymentDetails
     * @return array
     */
    public function processPayment(User $user, Course $course, array $paymentDetails = []): array
    {
        // Generate realistic mock Stripe charge data
        $transactionId = 'ch_mock_' . strtolower(Str::random(24));

        return [
            'success' => true,
            'transaction_id' => $transactionId,
            'amount' => $course->price,
            'payment_status' => 'paid',
            'payment_method' => 'stripe_card_mock',
            'currency' => 'usd',
            'charge_time' => now(),
            'card_last4' => substr($paymentDetails['card_number'] ?? '4242', -4),
        ];
    }

    /**
     * Placeholder hook for verifying webhooks from Stripe in production.
     */
    public function handleWebhook(array $payload, string $sigHeader): bool
    {
        // Stripe webhook signature verification placeholder
        return true;
    }
}
