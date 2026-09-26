<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Razorpay Checkout &bull; {{ $course->title }} &bull; Shree Mangalam</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Razorpay Standard Checkout JS -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>


    <style>
        body {
            background-color: #0b1329;
            background-image:
                radial-gradient(at 0% 0%, rgba(37, 99, 235, 0.18) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(14, 165, 233, 0.15) 0px, transparent 50%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #f8fafc;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .checkout-nav {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(12px);
        }

        .checkout-container {
            max-width: 1020px;
            margin: 2rem auto;
            padding: 0 1.25rem;
            width: 100%;
        }

        .checkout-card {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(16px);
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(255, 255, 255, 0.1);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr;
        }

        @media (min-width: 820px) {
            .checkout-card {
                grid-template-columns: 1fr 1.08fr;
            }
        }

        .order-summary-pane {
            background: linear-gradient(180deg, #091122 0%, #0d1b38 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            padding: 2.5rem 2.25rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .payment-action-pane {
            padding: 2.5rem 2.25rem;
            background: rgba(15, 23, 42, 0.6);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .test-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            background: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.4);
            color: #fcd34d;
            font-size: 0.75rem;
            font-weight: 800;
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            letter-spacing: 0.05em;
        }

        .price-display {
            display: flex;
            align-items: baseline;
            gap: 0.5rem;
            margin: 1.25rem 0;
        }

        .price-val {
            font-size: 3rem;
            font-weight: 900;
            color: #38bdf8;
            letter-spacing: -0.02em;
            line-height: 1;
        }

        .price-currency {
            font-size: 1.5rem;
            font-weight: 800;
            color: #94a3b8;
        }

        .upi-badge {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #e2e8f0;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.3rem 0.6rem;
            border-radius: 0.375rem;
        }

        .rzp-btn {
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            color: #ffffff;
            font-weight: 800;
            font-size: 1.05rem;
            padding: 1.05rem 1.5rem;
            border-radius: 0.85rem;
            width: 100%;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.65rem;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.5);
            transition: all 0.25s ease;
        }

        .rzp-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(37, 99, 235, 0.7);
            filter: brightness(1.1);
        }

        .rzp-btn:active {
            transform: translateY(0);
        }
    </style>
</head>

<body>

    <!-- Nav Header -->
    <header class="checkout-nav">
        <div
            style="max-width: 1020px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between;">
            <a href="{{ route('courses.show', $course->slug) }}"
                style="display: inline-flex; align-items: center; gap: 0.5rem; color: #94a3b8; text-decoration: none; font-size: 0.9rem; font-weight: 700; transition: color 0.2s;"
                onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#94a3b8'">
                <i data-lucide="arrow-left" style="width: 1.1rem; height: 1.1rem;"></i>
                <span>Back to course details</span>
            </a>
            <div
                style="display: flex; align-items: center; gap: 0.5rem; color: #34d399; font-size: 0.85rem; font-weight: 700;">
                <i data-lucide="shield-check" style="width: 1.25rem; height: 1.25rem;"></i>
                <span>Razorpay Secured 256-Bit SSL</span>
            </div>
        </div>
    </header>

    <!-- Main Checkout Box -->
    <main class="checkout-container">
        @if (session('error'))
            <div
                style="background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; border-radius: 0.75rem; padding: 1rem 1.25rem; margin-bottom: 1.5rem; color: #fca5a5; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                <i data-lucide="alert-triangle" style="width: 1.2rem; height: 1.2rem; color: #ef4444;"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="checkout-card">

            <!-- Left Side: Order & Academy Summary -->
            <div class="order-summary-pane">
                <div>
                    <div
                        style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
                        <span class="test-badge">
                            <span
                                style="width: 7px; height: 7px; border-radius: 9999px; background: #f59e0b; box-shadow: 0 0 8px #f59e0b;"></span>
                            <span>RAZORPAY TEST MODE</span>
                        </span>
                        <span style="font-size: 0.8rem; color: #64748b; font-weight: 600;">
                            ID: {{ substr($razorpayOrder['id'] ?? '', 0, 15) }}
                        </span>
                    </div>

                    <p
                        style="color: #38bdf8; font-size: 0.85rem; margin: 0; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 800;">
                        Shree Mangalam English Academy
                    </p>

                    <h1
                        style="font-size: 1.85rem; font-weight: 900; margin: 0.5rem 0 0.85rem; line-height: 1.2; color: #ffffff;">
                        {{ $course->title }}
                    </h1>

                    <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.5; margin: 0 0 1.25rem;">
                        {{ Str::limit($course->description, 140) }}
                    </p>

                    <!-- Price Block (Dynamically Loaded From Course) -->
                    <div class="price-display">
                        <span class="price-val">₹{{ number_format($course->price) }}</span>
                        <span class="price-currency">INR</span>
                    </div>

                    <!-- Perks Table -->
                    <div
                        style="border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 1.25rem; margin-top: 0.5rem; display: flex; flex-direction: column; gap: 0.75rem;">
                        <div style="display: flex; justify-content: space-between; font-size: 0.875rem;">
                            <span style="color: #94a3b8;">Learning Materials:</span>
                            <span style="font-weight: 700; color: #ffffff;">{{ $course->images->count() }} Visual Lesson
                                Slides</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 0.875rem;">
                            <span style="color: #94a3b8;">Proficiency Level:</span>
                            <span style="font-weight: 700; color: #ffffff;">{{ $course->level }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 0.875rem;">
                            <span style="color: #94a3b8;">Subscription Validity:</span>
                            <span style="font-weight: 700; color: #34d399;">1 Year Active Access</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 0.875rem;">
                            <span style="color: #94a3b8;">Student:</span>
                            <span style="font-weight: 700; color: #ffffff;">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                </div>

                <div
                    style="font-size: 0.775rem; color: #64748b; border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 1.25rem; margin-top: 1.5rem;">
                    Instant automatic unlock upon successful payment via Razorpay.
                </div>
            </div>

            <!-- Right Side: UPI Scanner Option & Razorpay Payment Actions -->
            <div class="payment-action-pane">
                <div>
                    <!-- Header -->
                    <div
                        style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
                        <div>
                            <h2 style="margin: 0; font-size: 1.25rem; font-weight: 800; color: #ffffff;">Razorpay Payment</h2>
                            <p style="margin: 0.2rem 0 0; font-size: 0.8rem; color: #94a3b8;">Fast, Secure &amp; Instant Activation</p>
                        </div>
                        <img src="https://badges.razorpay.com/badge-light.png" alt="Razorpay"
                            style="height: 26px; border-radius: 4px;">
                    </div>

                    <!-- Razorpay Official Payment Card -->
                    <div style="background: rgba(15, 23, 42, 0.7); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 1.25rem; padding: 2rem 1.5rem; text-align: center; margin-top: 1rem;">
                        <div style="width: 4.5rem; height: 4.5rem; margin: 0 auto 1.25rem; border-radius: 1rem; background: rgba(56, 189, 248, 0.1); border: 1px solid rgba(56, 189, 248, 0.25); display: flex; align-items: center; justify-content: center; color: #38bdf8;">
                            <i data-lucide="shield-check" style="width: 2.5rem; height: 2.5rem;"></i>
                        </div>
                        <h3 style="margin: 0 0 0.5rem; font-size: 1.25rem; font-weight: 800; color: #ffffff;">Official Razorpay Gateway</h3>
                        <p style="margin: 0 0 1.25rem; font-size: 0.875rem; color: #94a3b8; line-height: 1.6;">
                            Pay directly using any method: <strong>UPI (GPay, PhonePe, Paytm), Cards (Debit/Credit), NetBanking, or Wallets</strong>.
                        </p>
                        <div style="display: flex; justify-content: center; gap: 0.5rem; flex-wrap: wrap;">
                            <span class="upi-badge">UPI / QR</span>
                            <span class="upi-badge">Google Pay</span>
                            <span class="upi-badge">PhonePe</span>
                            <span class="upi-badge">Cards</span>
                            <span class="upi-badge">NetBanking</span>
                        </div>
                    </div>

                    <!-- Hidden Verification Form -->
                    <form id="razorpay-form" method="POST" action="{{ route('checkout.process', $course->slug) }}"
                        style="display: none;">
                        @csrf
                        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
                    </form>
                </div>

                <div style="margin-top: 1.5rem;">
                    <!-- Razorpay Main Trigger Button -->
                    <button type="button" id="rzp-button" class="rzp-btn">
                        <i data-lucide="credit-card" style="width: 1.2rem; height: 1.2rem;"></i>
                        <span>Pay ₹{{ number_format($course->price) }} via Razorpay</span>
                    </button>

                    <div
                        style="text-align: center; margin-top: 0.85rem; color: #64748b; font-size: 0.75rem; display: flex; align-items: center; justify-content: center; gap: 0.4rem;">
                        <i data-lucide="shield" style="width: 0.85rem; height: 0.85rem;"></i>
                        <span>Safe &amp; Encrypted &bull; Official Razorpay Checkout</span>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Razorpay Integration Script -->
    <script>
        // Razorpay Standard Checkout Handler
        const razorpayOptions = {
            "key": "{{ $razorpayKeyId }}",
            "amount": "{{ $razorpayOrder['amount'] }}",
            "currency": "{{ $razorpayOrder['currency'] }}",
            "name": "Shree Mangalam English",
            "description": "{{ addslashes($course->title) }}",
            "image": "{{ asset('images/logo.png') }}",
            "order_id": "{{ $razorpayOrder['id'] }}",
            "handler": function (response) {
                // Set hidden fields and auto-submit
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;

                const btn = document.getElementById('rzp-button');
                btn.disabled = true;
                btn.innerHTML = '<span>Verifying Payment...</span>';

                document.getElementById('razorpay-form').submit();
            },
            "prefill": {
                "name": "{{ addslashes(Auth::user()->name) }}",
                "email": "{{ Auth::user()->email }}",
                "contact": ""
            },
            "notes": {
                "course_id": "{{ $course->id }}",
                "course_title": "{{ addslashes($course->title) }}"
            },
            "theme": {
                "color": "#0284c7"
            },
            "modal": {
                "ondismiss": function () {
                    console.log('Razorpay modal closed');
                }
            }
        };

        const rzpInstance = new Razorpay(razorpayOptions);

        // Click on "Pay via Razorpay" opens Razorpay modal
        document.getElementById('rzp-button').onclick = function (e) {
            rzpInstance.open();
            e.preventDefault();
        };

        // Direct auto-open Razorpay checkout screen immediately on page load
        window.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                try {
                    rzpInstance.open();
                } catch(err) {
                    console.error("Auto open error: ", err);
                }
            }, 300);
        });
    </script>
</body>

</html>