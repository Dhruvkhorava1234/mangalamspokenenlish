@extends('layouts.app')

@section('title', 'Student Dashboard &bull; My Enrolled Courses')

@section('content')
<div style="background-color: #f8fafc; min-height: 80vh; padding: 3rem 0;">
    <div class="container">

        <!-- Welcome Banner -->
        <div style="background: linear-gradient(135deg, #0b2545 0%, #133e75 100%); border-radius: 1.25rem; padding: 2.5rem; color: #ffffff; margin-bottom: 3rem; display: flex; flex-direction: column; md:flex-row; justify-content: space-between; align-items: flex-start; gap: 1.5rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
            <div>
                <span style="background: rgba(34, 211, 238, 0.2); color: #67e8f9; font-size: 0.75rem; font-weight: 800; padding: 0.3rem 0.8rem; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.05em;">
                    Student Learning Area
                </span>
                <h1 style="font-size: 2.25rem; font-weight: 900; margin: 0.75rem 0 0.25rem; line-height: 1.2;">
                    Welcome back, {{ Auth::user()->name }}!
                </h1>
                <p style="color: #cbd5e1; font-size: 1rem; margin: 0; max-width: 600px;">
                    Access your image-based courses, resume your visual lessons, and build spoken English fluency step-by-step.
                </p>
            </div>

            <a href="{{ route('courses') }}" class="btn-primary" style="background-color: #ffffff; color: #0b2545; font-weight: 800; padding: 0.85rem 1.5rem;">
                <i data-lucide="compass" style="width: 1rem; height: 1rem;"></i>
                <span>Explore More Courses</span>
            </a>
        </div>

        <!-- Enrolled Courses Grid -->
        <div style="margin-bottom: 3.5rem;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <i data-lucide="book-marked" style="width: 1.5rem; height: 1.5rem; color: #2563eb;"></i>
                    <h2 style="font-size: 1.5rem; font-weight: 800; color: #0f172a; margin: 0;">My Courses</h2>
                </div>
                <span style="font-size: 0.9rem; font-weight: 700; color: #64748b;">
                    {{ $orders->count() }} {{ Str::plural('Course', $orders->count()) }} Unlocked
                </span>
            </div>

            @if($orders->isEmpty())
                <div style="background: #ffffff; border: 1px dashed #cbd5e1; border-radius: 1.25rem; padding: 4rem 2rem; text-align: center;">
                    <div style="width: 4.5rem; height: 4.5rem; border-radius: 1rem; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem;">
                        <i data-lucide="book-open" style="width: 2.25rem; height: 2.25rem;"></i>
                    </div>
                    <h3 style="font-size: 1.35rem; font-weight: 800; color: #0f172a; margin: 0 0 0.5rem;">No Courses Purchased Yet</h3>
                    <p style="color: #64748b; font-size: 0.95rem; max-width: 480px; margin: 0 auto 1.5rem;">
                        You haven't enrolled in any courses yet. Browse our comprehensive English curriculum to unlock visual slide learning.
                    </p>
                    <a href="{{ route('courses') }}" class="btn-primary" style="padding: 0.85rem 1.75rem;">
                        <span>Browse Courses Catalog</span>
                        <i data-lucide="arrow-right" style="width: 1rem; height: 1rem;"></i>
                    </a>
                </div>
            @else
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.75rem;">
                    @foreach($orders as $order)
                        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); display: flex; flex-direction: column; transition: transform 0.2s, box-shadow 0.2s;">
                            <!-- Thumbnail / Header -->
                            <div style="height: 180px; background: #0f172a; position: relative; overflow: hidden;">
                                @if($order->course && $order->course->thumbnail)
                                    <img src="{{ asset('storage/' . $order->course->thumbnail) }}" onerror="this.onerror=null; this.src='{{ asset('images/placeholders/course-default.svg') }}';" alt="{{ $order->course->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #1e3a8a, #0b2545); color: #ffffff;">
                                        <i data-lucide="book-open" style="width: 3.5rem; height: 3.5rem; opacity: 0.6;"></i>
                                    </div>
                                @endif

                                @if($order->isActive())
                                    <div style="position: absolute; top: 0.75rem; right: 0.75rem; background: rgba(16, 185, 129, 0.95); backdrop-filter: blur(4px); color: #ffffff; font-size: 0.75rem; font-weight: 800; padding: 0.25rem 0.65rem; border-radius: 9999px; display: flex; align-items: center; gap: 0.3rem;">
                                        <i data-lucide="check-circle" style="width: 0.8rem; height: 0.8rem;"></i>
                                        <span>ACTIVE (1 YEAR)</span>
                                    </div>
                                @else
                                    <div style="position: absolute; top: 0.75rem; right: 0.75rem; background: rgba(239, 68, 68, 0.95); backdrop-filter: blur(4px); color: #ffffff; font-size: 0.75rem; font-weight: 800; padding: 0.25rem 0.65rem; border-radius: 9999px; display: flex; align-items: center; gap: 0.3rem;">
                                        <i data-lucide="alert-circle" style="width: 0.8rem; height: 0.8rem;"></i>
                                        <span>SUBSCRIPTION EXPIRED</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Body -->
                            <div style="padding: 1.5rem; display: flex; flex-direction: column; justify-content: space-between; flex: 1; gap: 1.25rem;">
                                <div>
                                    <div style="font-size: 0.8rem; font-weight: 700; color: #2563eb; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">
                                        {{ $order->course->level ?? 'Course' }} &bull; {{ $order->course ? $order->course->images->count() : 0 }} Visual Slides
                                    </div>
                                    <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin: 0 0 0.5rem; line-height: 1.3;">
                                        {{ $order->course->title ?? 'English Course' }}
                                    </h3>
                                    <p style="font-size: 0.85rem; color: #64748b; margin: 0 0 0.75rem; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $order->course->description ?? '' }}
                                    </p>

                                    <!-- Subscription Validity Info -->
                                    <div style="font-size: 0.8rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 0.5rem 0.75rem; color: #475569; display: flex; align-items: center; justify-content: space-between;">
                                        <span>Validity:</span>
                                        @php
                                            $expiryDate = $order->expires_at ?? $order->created_at->addYear();
                                        @endphp
                                        @if($order->isActive())
                                            <span style="font-weight: 700; color: #059669;">Valid until {{ $expiryDate->format('M d, Y') }}</span>
                                        @else
                                            <span style="font-weight: 700; color: #dc2626;">Expired on {{ $expiryDate->format('M d, Y') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div style="border-top: 1px solid #f1f5f9; padding-top: 1rem;">
                                    @if($order->isActive() && $order->course)
                                        <a href="{{ route('student.courses.viewer', $order->course->slug) }}" class="btn-primary" style="width: 100%; padding: 0.85rem; font-size: 0.95rem; border-radius: 0.65rem; background-color: #2563eb;">
                                            <i data-lucide="play-circle" style="width: 1.2rem; height: 1.2rem;"></i>
                                            <span>Open Course Viewer</span>
                                        </a>
                                    @elseif($order->course)
                                        <a href="{{ route('checkout.show', $order->course->slug) }}" class="btn-primary" style="width: 100%; padding: 0.85rem; font-size: 0.95rem; border-radius: 0.65rem; background-color: #f59e0b; border-color: #f59e0b;">
                                            <i data-lucide="refresh-cw" style="width: 1.1rem; height: 1.1rem;"></i>
                                            <span>Renew 1-Year Access &bull; ₹{{ number_format($order->course->price) }}</span>
                                        </a>
                                    @else
                                        <button disabled class="btn-secondary" style="width: 100%; opacity: 0.6; cursor: not-allowed;">
                                            Unavailable
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Purchase Receipts Table -->
        @if($orders->isNotEmpty())
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h3 style="font-size: 1.2rem; font-weight: 800; color: #0f172a; margin: 0 0 1.25rem;">Order History &amp; Receipts</h3>
                
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                        <thead>
                            <tr style="border-bottom: 2px solid #f1f5f9; color: #64748b; font-size: 0.8rem; text-transform: uppercase;">
                                <th style="padding: 0.75rem 0.5rem;">Course</th>
                                <th style="padding: 0.75rem 0.5rem;">Transaction ID</th>
                                <th style="padding: 0.75rem 0.5rem;">Purchase Date</th>
                                <th style="padding: 0.75rem 0.5rem;">Validity / Expiry</th>
                                <th style="padding: 0.75rem 0.5rem;">Amount</th>
                                <th style="padding: 0.75rem 0.5rem;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                @php
                                    $expDate = $order->expires_at ?? $order->created_at->addYear();
                                @endphp
                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                    <td style="padding: 0.85rem 0.5rem; font-weight: 700; color: #0f172a;">
                                        {{ $order->course->title ?? 'English Course' }}
                                    </td>
                                    <td style="padding: 0.85rem 0.5rem; font-family: monospace; font-size: 0.8rem; color: #64748b;">
                                        {{ $order->transaction_id }}
                                    </td>
                                    <td style="padding: 0.85rem 0.5rem; font-size: 0.85rem; color: #64748b;">
                                        {{ $order->created_at->format('M d, Y') }}
                                    </td>
                                    <td style="padding: 0.85rem 0.5rem; font-size: 0.85rem;">
                                        @if($order->isActive())
                                            <span style="color: #059669; font-weight: 700;">Valid to {{ $expDate->format('M d, Y') }}</span>
                                        @else
                                            <span style="color: #dc2626; font-weight: 700;">Expired on {{ $expDate->format('M d, Y') }}</span>
                                        @endif
                                    </td>
                                    <td style="padding: 0.85rem 0.5rem; font-weight: 800; color: #059669;">
                                        ₹{{ number_format($order->amount) }}
                                    </td>
                                    <td style="padding: 0.85rem 0.5rem;">
                                        @if($order->isActive())
                                            <span style="background: #ecfdf5; color: #059669; font-size: 0.75rem; font-weight: 800; padding: 0.2rem 0.55rem; border-radius: 9999px;">
                                                Active (1 Year)
                                            </span>
                                        @else
                                            <span style="background: #fef2f2; color: #dc2626; font-size: 0.75rem; font-weight: 800; padding: 0.2rem 0.55rem; border-radius: 9999px;">
                                                Expired
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
