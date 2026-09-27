@extends('layouts.app')

@section('title', 'Testimonials | Shree Mangalam Spoken English Classes')

@section('content')
    <!-- Page Banner Header -->
    <section class="page-banner">
        <div class="container">
            <div class="page-banner-content">
                <span class="page-banner-badge">Real Experiences</span>
                <h1 class="page-banner-title">What Our Students Say</h1>
                <p class="page-banner-sub">
                    Genuine feedback from students, homemakers, teachers, and business owners who learned English with Vijay Joshi sir.
                </p>
                <div class="breadcrumbs">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span class="active">Testimonials</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Showcase -->
    <section class="testimonials-section" style="background-color: var(--white); border-top: none; padding-top: 3.5rem;">
        <div class="container">
            
            <!-- Google Reviews Trust & Action Header -->
            <div class="google-reviews-header-card" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border: 1px solid var(--slate-200); border-radius: 1.5rem; padding: 2.25rem; margin-bottom: 3.5rem; box-shadow: var(--shadow-sm); display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 2rem;">
                <div style="display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;">
                    <!-- Google G Logo Badge -->
                    <div style="width: 4rem; height: 4rem; background: #ffffff; border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-md); border: 1px solid var(--slate-100); flex-shrink: 0;">
                        <svg width="36" height="36" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                            <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/>
                            <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                            <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                        </svg>
                    </div>
                    
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap; margin-bottom: 0.35rem;">
                            <span style="font-weight: 800; font-size: 1.35rem; color: var(--slate-900); letter-spacing: -0.02em;">Google Customer Reviews</span>
                            <span style="background-color: var(--emerald-50); color: var(--emerald-600); border: 1px solid var(--emerald-100); font-size: 0.75rem; font-weight: 700; padding: 0.25rem 0.65rem; border-radius: 9999px; display: inline-flex; align-items: center; gap: 0.35rem;">
                                <i data-lucide="check-circle-2" style="width: 0.9rem; height: 0.9rem;"></i> Verified Listing
                            </span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
                            <span style="font-size: 1.5rem; font-weight: 800; color: var(--slate-900);">5.0</span>
                            <div class="stars-row" style="margin-bottom: 0; color: #f59e0b;">
                                <i data-lucide="star" style="width: 1.25rem; height: 1.25rem; fill: #f59e0b; color: #f59e0b;"></i>
                                <i data-lucide="star" style="width: 1.25rem; height: 1.25rem; fill: #f59e0b; color: #f59e0b;"></i>
                                <i data-lucide="star" style="width: 1.25rem; height: 1.25rem; fill: #f59e0b; color: #f59e0b;"></i>
                                <i data-lucide="star" style="width: 1.25rem; height: 1.25rem; fill: #f59e0b; color: #f59e0b;"></i>
                                <i data-lucide="star" style="width: 1.25rem; height: 1.25rem; fill: #f59e0b; color: #f59e0b;"></i>
                            </div>
                            <span style="color: var(--slate-500); font-size: 0.9rem; font-weight: 500;">&bull; 100% Genuine Student Reviews on Google</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons: Write a review & View all -->
                <div style="display: flex; align-items: center; gap: 0.85rem; flex-wrap: wrap;">
                    <a href="https://g.page/r/CW-QfM4JvX0iEBM/review" target="_blank" rel="noopener noreferrer" class="btn-primary" style="background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%); box-shadow: 0 4px 14px rgba(37,99,235,0.35); text-decoration: none;">
                        <svg width="18" height="18" viewBox="0 0 24 24" style="margin-right: 0.4rem; vertical-align: middle;">
                            <path fill="#ffffff" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                        </svg>
                        <span>Write a Review on Google</span>
                        <i data-lucide="external-link" style="width: 1rem; height: 1rem; margin-left: 0.35rem;"></i>
                    </a>
                </div>
            </div>
            
            <div class="section-head-center">
                <h2 class="section-title">Live Student Experiences</h2>
                <div class="center-line"></div>
                <p class="section-head-subtitle">
                    Real-time feedback &amp; ratings streamed directly from our official Google Business profile.
                </p>
            </div>

            <!-- Trustindex Live Google Reviews Widget Container -->
            <div class="trustindex-google-reviews-wrapper" style="min-height: 400px; margin-bottom: 2rem;">
                <script defer async src='https://cdn.trustindex.io/loader.js?c7ad93282355337d89861f78315'></script>
            </div>

            <!-- Post a Google Review Banner -->
            <div style="margin-top: 3.5rem; background: linear-gradient(135deg, #0b2545 0%, #133e75 100%); border-radius: 1.5rem; padding: 2.5rem; color: #ffffff; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 2rem; position: relative; overflow: hidden; box-shadow: var(--shadow-lg);">
                <div style="position: absolute; right: -2rem; bottom: -2rem; opacity: 0.08; pointer-events: none;">
                    <svg width="240" height="240" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                </div>

                <div style="max-width: 600px; position: relative; z-index: 1;">
                    <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255, 255, 255, 0.12); padding: 0.35rem 0.85rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.85rem; color: #93c5fd; border: 1px solid rgba(255, 255, 255, 0.15);">
                        <i data-lucide="award" style="width: 1rem; height: 1rem; color: #fbbf24;"></i>
                        <span>Are you a student of Shree Mangalam?</span>
                    </div>
                    <h3 style="font-size: 1.65rem; font-weight: 800; color: #ffffff; margin-bottom: 0.5rem; line-height: 1.3;">
                        Share Your Experience on Google
                    </h3>
                    <p style="color: #cbd5e1; font-size: 0.95rem; line-height: 1.6;">
                        Your valuable feedback helps aspiring learners in Porbandar take their first confident step towards speaking fluent English.
                    </p>
                </div>

                <div style="position: relative; z-index: 1;">
                    <a href="https://g.page/r/CW-QfM4JvX0iEBM/review" target="_blank" rel="noopener noreferrer" class="btn-primary" style="background-color: #ffffff; color: var(--navy-900); font-weight: 700; padding: 0.85rem 1.75rem; border-radius: 0.75rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.15); transition: transform 0.2s, background-color 0.2s; text-decoration: none;">
                        <svg width="20" height="20" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                            <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/>
                            <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                            <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                        </svg>
                        <span>Leave a Google Review</span>
                        <i data-lucide="arrow-right" style="width: 1.1rem; height: 1.1rem; color: var(--navy-900);"></i>
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- Call to action -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-banner">
                <div class="cta-left">
                    <div class="cta-icon-box">
                        <i data-lucide="sparkles" style="width: 2rem; height: 2rem;"></i>
                    </div>
                    <div>
                        <h3 class="cta-heading">Write Your Own Success Story</h3>
                        <p class="cta-desc">Enroll today and experience the difference of Gujarati-oriented English coaching.</p>
                    </div>
                </div>
                <div class="cta-right">
                    <a href="{{ route('contact') }}" class="btn-primary cta-button">
                        <span>Enroll Now</span>
                        <i data-lucide="arrow-right" style="width: 1.25rem; height: 1.25rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
