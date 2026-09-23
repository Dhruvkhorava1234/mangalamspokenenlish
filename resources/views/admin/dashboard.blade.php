@extends('layouts.app')

@section('title', 'Admin Dashboard &bull; Shree Mangalam Spoken English')

@section('content')
<style>
    /* ── Admin Dashboard ── */
    .admin-dashboard-wrap {
        background-color: #f8fafc;
        min-height: 80vh;
        padding: 2rem 0;
    }

    /* Header Row */
    .admin-header-row {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    @media (min-width: 768px) {
        .admin-header-row {
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-start;
        }
    }

    .admin-header-title {
        font-size: 1.6rem;
        font-weight: 900;
        color: #0f172a;
        margin: 0;
    }
    @media (min-width: 768px) {
        .admin-header-title { font-size: 2rem; }
    }

    .admin-header-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    /* ── Stats Grid ── */
    .admin-stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }
    @media (min-width: 1024px) {
        .admin-stats-grid {
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
        }
    }

    .admin-stat-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        padding: 1.1rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    @media (min-width: 768px) {
        .admin-stat-card { padding: 1.5rem; gap: 1rem; }
    }

    .admin-stat-icon {
        width: 2.75rem;
        height: 2.75rem;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    @media (min-width: 768px) {
        .admin-stat-icon { width: 3.25rem; height: 3.25rem; }
    }

    .admin-stat-value {
        font-size: 1.25rem;
        font-weight: 900;
        color: #0f172a;
        margin: 0.1rem 0 0;
        line-height: 1.1;
    }
    @media (min-width: 768px) {
        .admin-stat-value { font-size: 1.65rem; }
    }

    /* ── DESKTOP: Two-column grid ── */
    .admin-two-col {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    @media (min-width: 1024px) {
        .admin-two-col {
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }
    }

    /* ── MOBILE Slider ── */

    /* Tab pill row */
    .mobile-panel-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    @media (min-width: 1024px) {
        .mobile-panel-tabs { display: none; } /* hide tabs on desktop */
    }

    .panel-tab-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        padding: 0.55rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.85rem;
        font-weight: 700;
        border: 2px solid #e2e8f0;
        background: #ffffff;
        color: #64748b;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .panel-tab-btn.active {
        background: #0f172a;
        border-color: #0f172a;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(15,23,42,0.18);
    }

    /* Slider viewport */
    .mobile-slider-viewport {
        overflow: hidden;
        width: 100%;
    }
    @media (min-width: 1024px) {
        /* On desktop, reset to normal block display — each panel visible */
        .mobile-slider-viewport { overflow: visible; }
    }

    /* Slider track holds both panels side by side */
    .mobile-slider-track {
        display: flex;
        transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        will-change: transform;
    }
    @media (min-width: 1024px) {
        .mobile-slider-track {
            display: contents; /* Let the grid take over */
        }
    }

    /* Each panel as a slide */
    .admin-panel-slide {
        width: 100%;
        flex-shrink: 0;
    }
    @media (min-width: 1024px) {
        .admin-panel-slide {
            width: auto;
            flex-shrink: unset;
        }
    }

    /* Panel card */
    .admin-panel-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    /* Sales table */
    .admin-table-wrap {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .admin-table-wrap table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 0.9rem;
        min-width: 520px;
    }

    /* Dot indicators */
    .slider-dots {
        display: flex;
        justify-content: center;
        gap: 0.4rem;
        margin-top: 1rem;
    }
    @media (min-width: 1024px) {
        .slider-dots { display: none; }
    }
    .slider-dot {
        width: 7px;
        height: 7px;
        border-radius: 9999px;
        background: #cbd5e1;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .slider-dot.active {
        width: 20px;
        background: #0f172a;
    }
</style>

<div class="admin-dashboard-wrap">
    <div class="container">

        {{-- ── Header & Fast Actions ── --}}
        <div class="admin-header-row">
            <div>
                <div style="display:inline-flex;align-items:center;gap:0.5rem;background:#e0f2fe;color:#0284c7;padding:0.25rem 0.75rem;border-radius:9999px;font-size:0.8rem;font-weight:800;margin-bottom:0.5rem;">
                    <i data-lucide="shield" style="width:0.9rem;height:0.9rem;"></i>
                    <span>ADMINISTRATOR PORTAL</span>
                </div>
                <h1 class="admin-header-title">Academy Business Overview</h1>
                <p style="color:#64748b;font-size:0.95rem;margin-top:0.25rem;">Monitor student enrollments, track sales revenue, and manage course materials.</p>
            </div>

            <div class="admin-header-actions">
                <a href="{{ route('admin.courses.index') }}" class="btn-secondary" style="font-size:0.9rem;padding:0.65rem 1.25rem;">
                    <i data-lucide="layers" style="width:1rem;height:1rem;"></i>
                    <span>Manage Courses</span>
                </a>
                <a href="{{ route('admin.courses.create') }}" class="btn-primary" style="font-size:0.9rem;padding:0.65rem 1.25rem;">
                    <i data-lucide="plus-circle" style="width:1rem;height:1rem;"></i>
                    <span>Add New Course</span>
                </a>
            </div>
        </div>

        {{-- ── Stat Cards Grid ── --}}
        <div class="admin-stats-grid">
            <div class="admin-stat-card">
                <div class="admin-stat-icon" style="background:#ecfdf5;color:#059669;">
                    <i data-lucide="indian-rupee" style="width:1.4rem;height:1.4rem;"></i>
                </div>
                <div>
                    <span style="font-size:0.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.04em;">Revenue</span>
                    <h3 class="admin-stat-value">₹{{ number_format($totalRevenue) }}</h3>
                </div>
            </div>

            <div class="admin-stat-card">
                <div class="admin-stat-icon" style="background:#eff6ff;color:#2563eb;">
                    <i data-lucide="users" style="width:1.4rem;height:1.4rem;"></i>
                </div>
                <div>
                    <span style="font-size:0.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.04em;">Students</span>
                    <h3 class="admin-stat-value">{{ $totalStudents }}</h3>
                </div>
            </div>

            <div class="admin-stat-card">
                <div class="admin-stat-icon" style="background:#faf5ff;color:#9333ea;">
                    <i data-lucide="book-open" style="width:1.4rem;height:1.4rem;"></i>
                </div>
                <div>
                    <span style="font-size:0.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.04em;">Courses</span>
                    <h3 class="admin-stat-value">{{ $totalCourses }}</h3>
                </div>
            </div>

            <div class="admin-stat-card">
                <div class="admin-stat-icon" style="background:#fffbeb;color:#d97706;">
                    <i data-lucide="shopping-cart" style="width:1.4rem;height:1.4rem;"></i>
                </div>
                <div>
                    <span style="font-size:0.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.04em;">Purchases</span>
                    <h3 class="admin-stat-value">{{ $totalPurchases }}</h3>
                </div>
            </div>
        </div>

        {{-- ── Mobile Tab Switcher (hidden on desktop) ── --}}
        <div class="mobile-panel-tabs" id="panelTabs">
            <button type="button" class="panel-tab-btn active" id="tabSales" onclick="switchPanel(0)">
                <i data-lucide="receipt" style="width:0.9rem;height:0.9rem;"></i>
                Recent Sales
            </button>
            <button type="button" class="panel-tab-btn" id="tabAlerts" onclick="switchPanel(1)">
                <i data-lucide="bell" style="width:0.9rem;height:0.9rem;"></i>
                Alerts
                @if(Auth::user()->unreadNotifications->count() > 0)
                    <span style="background:#ef4444;color:#fff;font-size:0.65rem;font-weight:800;padding:0.1rem 0.4rem;border-radius:9999px;margin-left:0.1rem;">
                        {{ Auth::user()->unreadNotifications->count() }}
                    </span>
                @endif
            </button>
        </div>

        {{-- ── Two-col on desktop / Swipe Slider on mobile ── --}}
        <div class="admin-two-col">
            <div class="mobile-slider-viewport" id="sliderViewport">
                <div class="mobile-slider-track" id="sliderTrack">

                    {{-- ─ PANEL 1: Recent Sales ─ --}}
                    <div class="admin-panel-slide">
                        <div class="admin-panel-card">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem;">
                                <div>
                                    <h2 style="font-size:1.15rem;font-weight:800;color:#0f172a;margin:0;">Recent Sales &amp; Enrollments</h2>
                                    <p style="font-size:0.85rem;color:#64748b;margin-top:0.2rem;">Live list of student transactions</p>
                                </div>
                            </div>

                            @if($recentSales->isEmpty())
                                <div style="text-align:center;padding:3rem 1rem;color:#94a3b8;">
                                    <i data-lucide="inbox" style="width:2.5rem;height:2.5rem;margin:0 auto 0.75rem;"></i>
                                    <p style="margin:0;font-weight:600;">No course purchases recorded yet.</p>
                                </div>
                            @else
                                <div class="admin-table-wrap">
                                    <table>
                                        <thead>
                                            <tr style="border-bottom:2px solid #f1f5f9;color:#64748b;font-size:0.78rem;text-transform:uppercase;">
                                                <th style="padding:0.75rem 0.5rem;">Student</th>
                                                <th style="padding:0.75rem 0.5rem;">Course</th>
                                                <th style="padding:0.75rem 0.5rem;">Amount</th>
                                                <th style="padding:0.75rem 0.5rem;">Date</th>
                                                <th style="padding:0.75rem 0.5rem;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentSales as $sale)
                                                <tr style="border-bottom:1px solid #f1f5f9;">
                                                    <td style="padding:0.9rem 0.5rem;">
                                                        <div style="font-weight:700;color:#0f172a;">{{ $sale->user->name ?? 'Student' }}</div>
                                                        <div style="font-size:0.75rem;color:#64748b;">{{ $sale->user->email ?? 'N/A' }}</div>
                                                    </td>
                                                    <td style="padding:0.9rem 0.5rem;font-weight:600;color:#1e293b;">{{ $sale->course->title ?? 'Course' }}</td>
                                                    <td style="padding:0.9rem 0.5rem;font-weight:800;color:#059669;">₹{{ number_format($sale->amount) }}</td>
                                                    <td style="padding:0.9rem 0.5rem;font-size:0.8rem;color:#64748b;">{{ $sale->created_at->format('M d, Y h:i A') }}</td>
                                                    <td style="padding:0.9rem 0.5rem;">
                                                        <span style="background:#ecfdf5;color:#059669;font-size:0.75rem;font-weight:700;padding:0.25rem 0.6rem;border-radius:9999px;">Paid</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- ─ PANEL 2: Purchase Alerts ─ --}}
                    <div class="admin-panel-slide">
                        <div class="admin-panel-card" style="height:fit-content;">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem;">
                                <div style="display:flex;align-items:center;gap:0.5rem;">
                                    <i data-lucide="bell" style="width:1.25rem;height:1.25rem;color:#2563eb;"></i>
                                    <h2 style="font-size:1.1rem;font-weight:800;color:#0f172a;margin:0;">Purchase Alerts</h2>
                                </div>
                                @if(Auth::user()->unreadNotifications->count() > 0)
                                    <form method="POST" action="{{ route('admin.notifications.markRead') }}">
                                        @csrf
                                        <button type="submit" style="font-size:0.75rem;color:#2563eb;font-weight:700;background:none;border:none;cursor:pointer;">Mark all read</button>
                                    </form>
                                @endif
                            </div>

                            @if($notifications->isEmpty())
                                <div style="text-align:center;padding:2rem 1rem;color:#94a3b8;">
                                    <p style="margin:0;font-size:0.85rem;">No new alerts.</p>
                                </div>
                            @else
                                <div style="display:flex;flex-direction:column;gap:0.75rem;">
                                    @foreach($notifications as $notification)
                                        <div style="padding:0.85rem;border-radius:0.75rem;border:1px solid #e2e8f0;background:{{ $notification->read_at ? '#ffffff' : '#eff6ff' }};">
                                            <div style="display:flex;justify-content:space-between;margin-bottom:0.25rem;">
                                                <strong style="font-size:0.85rem;color:#0f172a;">New Enrollment</strong>
                                                <span style="font-size:0.7rem;color:#94a3b8;">{{ $notification->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p style="font-size:0.8rem;color:#475569;margin:0 0 0.35rem;">
                                                <strong>{{ $notification->data['student_name'] ?? 'Student' }}</strong> purchased <em>{{ $notification->data['course_title'] ?? 'Course' }}</em>.
                                            </p>
                                            <div style="display:flex;justify-content:space-between;font-size:0.75rem;color:#64748b;">
                                                <span style="color:#059669;font-weight:700;">+₹{{ number_format($notification->data['amount'] ?? 0) }}</span>
                                                <span style="font-family:monospace;">{{ substr($notification->data['transaction_id'] ?? '', 0, 14) }}...</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                </div>{{-- /slider-track --}}
            </div>{{-- /slider-viewport --}}
        </div>{{-- /admin-two-col --}}

        {{-- Dot indicators (mobile only) --}}
        <div class="slider-dots" id="sliderDots">
            <div class="slider-dot active" onclick="switchPanel(0)"></div>
            <div class="slider-dot" onclick="switchPanel(1)"></div>
        </div>

    </div>
</div>

<script>
(function () {
    let currentPanel = 0;
    const track   = document.getElementById('sliderTrack');
    const tabBtns = [document.getElementById('tabSales'), document.getElementById('tabAlerts')];
    const dots    = document.querySelectorAll('.slider-dot');

    function isDesktop() {
        return window.innerWidth >= 1024;
    }

    function applySlide(index) {
        if (isDesktop()) return;   // desktop uses CSS grid — no JS needed
        track.style.transform = `translateX(-${index * 100}%)`;
    }

    window.switchPanel = function (index) {
        if (isDesktop()) return;
        currentPanel = index;

        // Update tabs
        tabBtns.forEach((btn, i) => btn.classList.toggle('active', i === index));

        // Update dots
        dots.forEach((dot, i) => dot.classList.toggle('active', i === index));

        applySlide(index);
    };

    // Touch swipe support
    let touchStartX = 0;
    const viewport = document.getElementById('sliderViewport');

    viewport.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].clientX;
    }, { passive: true });

    viewport.addEventListener('touchend', (e) => {
        if (isDesktop()) return;
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) {
            if (diff > 0 && currentPanel < 1) switchPanel(currentPanel + 1);
            if (diff < 0 && currentPanel > 0) switchPanel(currentPanel - 1);
        }
    }, { passive: true });

    // Re-apply on resize (e.g., orientation change)
    window.addEventListener('resize', () => {
        if (isDesktop()) {
            track.style.transform = '';   // reset for desktop grid
        } else {
            applySlide(currentPanel);
        }
    });
})();
</script>
@endsection
