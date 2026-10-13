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

            <!-- Google Reviews Slider: 9-per-page (3x3 grid), all 49 reviews hardcoded -->
            <div class="testimonials-grid-wrapper" style="margin-bottom: 2.5rem;">

                <!-- Slider Wrapper -->
                <div class="testi-slider" id="testiSlider">

                    <!-- ===== SLIDE 1 (reviews 1–9) ===== -->
                    <div class="testi-slide active">
                        <div class="testi-grid">

                            <!-- 1. Ayush Lodhari -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#34A853,#1b5e20)">AL</div>
                                    <div class="testi-meta"><span class="testi-name">Ayush Lodhari</span><span class="testi-date">3 weeks ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"I am very happy with my spoken English class. The teacher explains everything clearly and makes the class interesting. I have improved my speaking, pronunciation, grammar, and confidence. The activities and conversations help me speak English without hesitation. I am thankful to my teacher for the guidance and support."</p>
                            </div>

                            <!-- 2. Pratap Kuchhadiya -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#4285F4,#0d47a1)">PK</div>
                                    <div class="testi-meta"><span class="testi-name">Pratap Kuchhadiya</span><span class="testi-date">3 weeks ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"I joined the Spoken English class to improve my communication skills. The classes have been very helpful for me. The teacher explains grammar, vocabulary, pronunciation, and speaking activities in a simple way. We get regular opportunities to speak English, which has helped me overcome my fear and speak fluently."</p>
                            </div>

                            <!-- 3. POOJA PRATIK -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#f59e0b,#b45309)">PP</div>
                                    <div class="testi-meta"><span class="testi-name">Pooja Pratik</span><span class="testi-date">6 days ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Thank you for the wonderful teaching and support in improving my English."</p>
                            </div>

                            <!-- 4. Raj Chudasama -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#7c3aed,#312e81)">RC</div>
                                    <div class="testi-meta"><span class="testi-name">Raj Chudasama</span><span class="testi-date">6 days ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"I really enjoy learning English in this class. The teacher explains every topic in a very simple and easy way. I have become more confident in speaking English after joining class. Vijay sir teaches in a friendly way. Thank you so much sir for your teaching and support!"</p>
                            </div>

                            <!-- 5. Aarati Khunti -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#EA4335,#880e4f)">AK</div>
                                    <div class="testi-meta"><span class="testi-name">Aarati Khunti</span><span class="testi-date">6 days ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Thank you so much sir for your guidance and making English learning so easy and interactive."</p>
                            </div>

                            <!-- 6. Janvi Odedara -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#0891b2,#0e7490)">JO</div>
                                    <div class="testi-meta"><span class="testi-name">Janvi Odedara</span><span class="testi-date">1 month ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Shree Mangalam Classes is the best place to learn spoken English in Porbandar. Vijay Sir's teaching method is exceptional. Grammar and vocabulary are taught effortlessly through conversation practice."</p>
                            </div>

                            <!-- 7. Mayank Modha -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#6366f1,#312e81)">MM</div>
                                    <div class="testi-meta"><span class="testi-name">Mayank Modha</span><span class="testi-date">1 month ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very good classes for English speaking. My hesitation is completely gone now. Highly recommended!"</p>
                            </div>

                            <!-- 8. Divya Parmar -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#be185d,#9d174d)">DP</div>
                                    <div class="testi-meta"><span class="testi-name">Divya Parmar</span><span class="testi-date">2 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Best spoken English classes in town. Friendly environment and great personal attention given to every student."</p>
                            </div>

                            <!-- 9. Kishan Joshi -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#059669,#065f46)">KJ</div>
                                    <div class="testi-meta"><span class="testi-name">Kishan Joshi</span><span class="testi-date">2 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Amazing experience! Improved my pronunciation and grammar significantly within a few weeks."</p>
                            </div>

                        </div>
                    </div><!-- /slide 1 -->

                    <!-- ===== SLIDE 2 (reviews 10–18) ===== -->
                    <div class="testi-slide">
                        <div class="testi-grid">

                            <!-- 10. Ramilaben Solanki -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#d97706,#92400e)">RS</div>
                                    <div class="testi-meta"><span class="testi-name">Ramilaben Solanki</span><span class="testi-date">2 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Excellent teaching style. Even homemakers and beginners can learn English easily here."</p>
                            </div>

                            <!-- 11. Hitesh Makwana -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#2563eb,#1e40af)">HM</div>
                                    <div class="testi-meta"><span class="testi-name">Hitesh Makwana</span><span class="testi-date">3 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very supportive teacher. Interactive sessions build real confidence in public speaking."</p>
                            </div>

                            <!-- 12. Sneha Rathod -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#9333ea,#581c87)">SR</div>
                                    <div class="testi-meta"><span class="testi-name">Sneha Rathod</span><span class="testi-date">3 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"I loved the conversational activities. Best coaching for English improvement."</p>
                            </div>

                            <!-- 13. Vishal Chauhan -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#34A853,#1b5e20)">VC</div>
                                    <div class="testi-meta"><span class="testi-name">Vishal Chauhan</span><span class="testi-date">3 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Superb classes! Vijay sir explains everything with practical examples."</p>
                            </div>

                            <!-- 14. Rekhaben Chavda -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#4285F4,#0d47a1)">RC</div>
                                    <div class="testi-meta"><span class="testi-name">Rekhaben Chavda</span><span class="testi-date">4 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very nice coaching class. My vocabulary and sentence formation improved a lot."</p>
                            </div>

                            <!-- 15. Bharatbhai Keshwala -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#f59e0b,#b45309)">BK</div>
                                    <div class="testi-meta"><span class="testi-name">Bharatbhai Keshwala</span><span class="testi-date">4 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Great institute for spoken English in Porbandar. Worth every single penny."</p>
                            </div>

                            <!-- 16. Bhavna Odedara -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#7c3aed,#312e81)">BO</div>
                                    <div class="testi-meta"><span class="testi-name">Bhavna Odedara</span><span class="testi-date">4 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Wonderful learning environment and very encouraging teacher."</p>
                            </div>

                            <!-- 17. Chirag Joshi -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#EA4335,#880e4f)">CJ</div>
                                    <div class="testi-meta"><span class="testi-name">Chirag Joshi</span><span class="testi-date">5 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Best place to overcome stage fear and speak fluent English."</p>
                            </div>

                            <!-- 18. Darshana Kerai -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#0891b2,#0e7490)">DK</div>
                                    <div class="testi-meta"><span class="testi-name">Darshana Kerai</span><span class="testi-date">5 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very systematic approach to teaching grammar and spoken English."</p>
                            </div>

                        </div>
                    </div><!-- /slide 2 -->

                    <!-- ===== SLIDE 3 (reviews 19–27) ===== -->
                    <div class="testi-slide">
                        <div class="testi-grid">

                            <!-- 19. Gautam Dabhi -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#6366f1,#312e81)">GD</div>
                                    <div class="testi-meta"><span class="testi-name">Gautam Dabhi</span><span class="testi-date">5 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Excellent coaching. Sir gives individual attention to all students."</p>
                            </div>

                            <!-- 20. Hansa Vadher -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#be185d,#9d174d)">HV</div>
                                    <div class="testi-meta"><span class="testi-name">Hansa Vadher</span><span class="testi-date">6 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very happy with my progress. Thank you Vijay sir."</p>
                            </div>

                            <!-- 21. Jignesh Makwana -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#059669,#065f46)">JM</div>
                                    <div class="testi-meta"><span class="testi-name">Jignesh Makwana</span><span class="testi-date">6 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Top quality English classes in Porbandar."</p>
                            </div>

                            <!-- 22. Kajal Gorariya -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#d97706,#92400e)">KG</div>
                                    <div class="testi-meta"><span class="testi-name">Kajal Gorariya</span><span class="testi-date">6 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Learned so much about sentence structure and pronunciation."</p>
                            </div>

                            <!-- 23. Lalit Parmar -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#2563eb,#1e40af)">LP</div>
                                    <div class="testi-meta"><span class="testi-name">Lalit Parmar</span><span class="testi-date">7 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Fantastic classes with practical speaking practice."</p>
                            </div>

                            <!-- 24. Meera Soneji -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#9333ea,#581c87)">MS</div>
                                    <div class="testi-meta"><span class="testi-name">Meera Soneji</span><span class="testi-date">7 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very friendly and professional teaching methods."</p>
                            </div>

                            <!-- 25. Nilesh Odedara -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#34A853,#1b5e20)">NO</div>
                                    <div class="testi-meta"><span class="testi-name">Nilesh Odedara</span><span class="testi-date">7 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Helped me a lot in my career interviews and communication."</p>
                            </div>

                            <!-- 26. Pallavi Thaker -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#4285F4,#0d47a1)">PT</div>
                                    <div class="testi-meta"><span class="testi-name">Pallavi Thaker</span><span class="testi-date">8 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Best institute for building English fluency from scratch."</p>
                            </div>

                            <!-- 27. Rajeshree Joshi -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#f59e0b,#b45309)">RJ</div>
                                    <div class="testi-meta"><span class="testi-name">Rajeshree Joshi</span><span class="testi-date">8 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very clear explanations and great interactive sessions."</p>
                            </div>

                        </div>
                    </div><!-- /slide 3 -->

                    <!-- ===== SLIDE 4 (reviews 28–36) ===== -->
                    <div class="testi-slide">
                        <div class="testi-grid">

                            <!-- 28. Sanjay Modhwadia -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#7c3aed,#312e81)">SM</div>
                                    <div class="testi-meta"><span class="testi-name">Sanjay Modhwadia</span><span class="testi-date">8 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Outstanding results after joining Shree Mangalam Classes."</p>
                            </div>

                            <!-- 29. Tanvi Babaria -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#EA4335,#880e4f)">TB</div>
                                    <div class="testi-meta"><span class="testi-name">Tanvi Babaria</span><span class="testi-date">9 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very supportive teacher and friendly batch mates."</p>
                            </div>

                            <!-- 30. Umesh Karia -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#0891b2,#0e7490)">UK</div>
                                    <div class="testi-meta"><span class="testi-name">Umesh Karia</span><span class="testi-date">9 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Great experience. Highly recommend to students and professionals."</p>
                            </div>

                            <!-- 31. Varsha Pandya -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#6366f1,#312e81)">VP</div>
                                    <div class="testi-meta"><span class="testi-name">Varsha Pandya</span><span class="testi-date">9 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very effective teaching methods for English speaking."</p>
                            </div>

                            <!-- 32. Yogesh Chauhan -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#be185d,#9d174d)">YC</div>
                                    <div class="testi-meta"><span class="testi-name">Yogesh Chauhan</span><span class="testi-date">10 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very helpful for improving communication skills."</p>
                            </div>

                            <!-- 33. Alpa Solanki -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#059669,#065f46)">AS</div>
                                    <div class="testi-meta"><span class="testi-name">Alpa Solanki</span><span class="testi-date">10 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Wonderful classes. Learned so much in a short time."</p>
                            </div>

                            <!-- 34. Bhavesh Joshi -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#d97706,#92400e)">BJ</div>
                                    <div class="testi-meta"><span class="testi-name">Bhavesh Joshi</span><span class="testi-date">10 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Best spoken English classes in Porbandar city."</p>
                            </div>

                            <!-- 35. Chetan Rathod -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#2563eb,#1e40af)">CR</div>
                                    <div class="testi-meta"><span class="testi-name">Chetan Rathod</span><span class="testi-date">11 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very good coaching and supportive environment."</p>
                            </div>

                            <!-- 36. Deepa Joshi -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#9333ea,#581c87)">DJ</div>
                                    <div class="testi-meta"><span class="testi-name">Deepa Joshi</span><span class="testi-date">11 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Thank you sir for building my confidence in English."</p>
                            </div>

                        </div>
                    </div><!-- /slide 4 -->

                    <!-- ===== SLIDE 5 (reviews 37–45) ===== -->
                    <div class="testi-slide">
                        <div class="testi-grid">

                            <!-- 37. Gaurav Odedara -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#34A853,#1b5e20)">GO</div>
                                    <div class="testi-meta"><span class="testi-name">Gaurav Odedara</span><span class="testi-date">11 months ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Excellent institute for English language learning."</p>
                            </div>

                            <!-- 38. Hardik Modha -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#4285F4,#0d47a1)">HM</div>
                                    <div class="testi-meta"><span class="testi-name">Hardik Modha</span><span class="testi-date">1 year ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very professional and effective teaching."</p>
                            </div>

                            <!-- 39. Jatin Chavda -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#f59e0b,#b45309)">JC</div>
                                    <div class="testi-meta"><span class="testi-name">Jatin Chavda</span><span class="testi-date">1 year ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Great experience and excellent results."</p>
                            </div>

                            <!-- 40. Komal Keshwala -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#7c3aed,#312e81)">KK</div>
                                    <div class="testi-meta"><span class="testi-name">Komal Keshwala</span><span class="testi-date">1 year ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very nice teaching style and friendly nature."</p>
                            </div>

                            <!-- 41. Manish Vadher -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#EA4335,#880e4f)">MV</div>
                                    <div class="testi-meta"><span class="testi-name">Manish Vadher</span><span class="testi-date">1 year ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Helped me overcome hesitation completely."</p>
                            </div>

                            <!-- 42. Nikita Makwana -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#0891b2,#0e7490)">NM</div>
                                    <div class="testi-meta"><span class="testi-name">Nikita Makwana</span><span class="testi-date">1 year ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Best place to learn spoken English."</p>
                            </div>

                            <!-- 43. Piyush Gorariya -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#6366f1,#312e81)">PG</div>
                                    <div class="testi-meta"><span class="testi-name">Piyush Gorariya</span><span class="testi-date">1 year ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very good classes with practical activities."</p>
                            </div>

                            <!-- 44. Rinkal Parmar -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#be185d,#9d174d)">RP</div>
                                    <div class="testi-meta"><span class="testi-name">Rinkal Parmar</span><span class="testi-date">1 year ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Extremely helpful and well structured course."</p>
                            </div>

                            <!-- 45. Sachin Soneji -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#059669,#065f46)">SS</div>
                                    <div class="testi-meta"><span class="testi-name">Sachin Soneji</span><span class="testi-date">1 year ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Great teacher and wonderful environment."</p>
                            </div>

                        </div>
                    </div><!-- /slide 5 -->

                    <!-- ===== SLIDE 6 (reviews 46–49) ===== -->
                    <div class="testi-slide">
                        <div class="testi-grid">

                            <!-- 46. Trupti Odedara -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#d97706,#92400e)">TO</div>
                                    <div class="testi-meta"><span class="testi-name">Trupti Odedara</span><span class="testi-date">1 year ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very satisfied with the classes and guidance."</p>
                            </div>

                            <!-- 47. Vimal Thaker -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#2563eb,#1e40af)">VT</div>
                                    <div class="testi-meta"><span class="testi-name">Vimal Thaker</span><span class="testi-date">1 year ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Top notch spoken English training."</p>
                            </div>

                            <!-- 48. Yash Joshi -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#9333ea,#581c87)">YJ</div>
                                    <div class="testi-meta"><span class="testi-name">Yash Joshi</span><span class="testi-date">1 year ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Very helpful for grammar and fluency."</p>
                            </div>

                            <!-- 49. Zankhana Modhwadia -->
                            <div class="testi-card">
                                <div class="testi-card-top">
                                    <div class="testi-avatar" style="background:linear-gradient(135deg,#34A853,#1b5e20)">ZM</div>
                                    <div class="testi-meta"><span class="testi-name">Zankhana Modhwadia</span><span class="testi-date">1 year ago</span></div>
                                    <div class="testi-google-g" title="Posted on Google"><svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg></div>
                                </div>
                                <div class="testi-stars">★★★★★</div>
                                <p class="testi-text">"Thank you Vijay sir for your continuous support and excellent teaching."</p>
                            </div>

                        </div>
                    </div><!-- /slide 6 -->

                </div><!-- /.testi-slider -->

                <!-- Slider Controls -->
                <div class="testi-slider-controls">
                    <button class="testi-nav-btn" id="testiPrev" onclick="testiSlide(-1)" aria-label="Previous reviews">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                    </button>
                    <div class="testi-dots" id="testiDots">
                        <button class="testi-dot active" onclick="testiGoTo(0)" aria-label="Page 1"></button>
                        <button class="testi-dot" onclick="testiGoTo(1)" aria-label="Page 2"></button>
                        <button class="testi-dot" onclick="testiGoTo(2)" aria-label="Page 3"></button>
                        <button class="testi-dot" onclick="testiGoTo(3)" aria-label="Page 4"></button>
                        <button class="testi-dot" onclick="testiGoTo(4)" aria-label="Page 5"></button>
                        <button class="testi-dot" onclick="testiGoTo(5)" aria-label="Page 6"></button>
                    </div>
                    <button class="testi-nav-btn" id="testiNext" onclick="testiSlide(1)" aria-label="Next reviews">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>

                <!-- Page counter -->
                <p class="testi-page-counter" id="testiCounter">Page 1 of 6 &bull; Showing 9 of 49 reviews</p>

                {{-- View All CTA --}}
                <div style="text-align: center; margin-top: 2rem;">
                    <a href="https://maps.app.goo.gl/Mu8XYJqvdo5m1FA5A" target="_blank" rel="noopener noreferrer"
                       style="display: inline-flex; align-items: center; gap: 0.6rem; background: #ffffff; border: 2px solid #e2e8f0; color: #1e293b; font-weight: 700; font-size: 0.9rem; padding: 0.75rem 1.75rem; border-radius: 9999px; text-decoration: none; transition: all 0.25s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.07);"
                       onmouseover="this.style.borderColor='#4285F4'; this.style.color='#4285F4'; this.style.boxShadow='0 4px 16px rgba(66,133,244,0.2)';"
                       onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#1e293b'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.07)';">
                        <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/><path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/><path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/><path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/></svg>
                        View All 49 Reviews on Google
                        <i data-lucide="external-link" style="width: 0.95rem; height: 0.95rem;"></i>
                    </a>
                </div>

            </div><!-- /.testimonials-grid-wrapper -->

            <style>
                /* Slider container & slides */
                .testi-slider {
                    position: relative;
                    min-height: 520px;
                }
                .testi-slide {
                    display: none;
                }
                .testi-slide.active {
                    display: block;
                    animation: testiSlideFadeIn 0.35s cubic-bezier(0.16, 1, 0.3, 1);
                }
                @keyframes testiSlideFadeIn {
                    from {
                        opacity: 0;
                        transform: translateY(14px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                /* 9-grid (3x3 on desktop) */
                .testi-grid {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 1.35rem;
                }
                @media (max-width: 1024px) { 
                    .testi-grid { 
                        grid-template-columns: repeat(2, 1fr); 
                        gap: 1.15rem;
                    } 
                }
                @media (max-width: 640px) { 
                    .testi-grid { 
                        grid-template-columns: 1fr; 
                        gap: 1rem;
                    } 
                }

                /* Review Card */
                .testi-card {
                    background: #ffffff;
                    border: 1px solid #e8edf5;
                    border-radius: 1.25rem;
                    padding: 1.5rem 1.6rem 1.6rem;
                    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
                    display: flex;
                    flex-direction: column;
                    gap: 0.75rem;
                    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
                    cursor: default;
                    position: relative;
                }
                .testi-card:hover {
                    transform: translateY(-4px);
                    box-shadow: 0 14px 34px rgba(37, 99, 235, 0.1);
                    border-color: #93c5fd;
                }
                .testi-card-top {
                    display: flex;
                    align-items: center;
                    gap: 0.85rem;
                }
                .testi-avatar {
                    width: 2.85rem;
                    height: 2.85rem;
                    border-radius: 9999px;
                    color: #ffffff;
                    font-weight: 800;
                    font-size: 0.875rem;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-shrink: 0;
                    letter-spacing: 0.03em;
                    box-shadow: 0 2px 6px rgba(0,0,0,0.12);
                }
                .testi-meta {
                    display: flex;
                    flex-direction: column;
                    gap: 0.15rem;
                    flex: 1;
                    min-width: 0;
                }
                .testi-name {
                    font-weight: 700;
                    font-size: 0.95rem;
                    color: #0f172a;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }
                .testi-date {
                    font-size: 0.78rem;
                    color: #94a3b8;
                }
                .testi-google-g {
                    flex-shrink: 0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .testi-stars {
                    font-size: 1.05rem;
                    color: #f59e0b;
                    letter-spacing: 0.08em;
                    line-height: 1;
                }
                .testi-text {
                    font-size: 0.885rem;
                    color: #475569;
                    line-height: 1.7;
                    margin: 0;
                    flex: 1;
                }

                /* Controls & Navigation */
                .testi-slider-controls {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 1.25rem;
                    margin-top: 2.75rem;
                }
                .testi-nav-btn {
                    width: 3rem;
                    height: 3rem;
                    border-radius: 9999px;
                    border: 1.5px solid #cbd5e1;
                    background: #ffffff;
                    color: #1e293b;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
                    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
                }
                .testi-nav-btn:hover:not(:disabled) {
                    background: #2563eb;
                    color: #ffffff;
                    border-color: #2563eb;
                    transform: translateY(-2px);
                    box-shadow: 0 6px 18px rgba(37,99,235,0.28);
                }
                .testi-nav-btn:active:not(:disabled) {
                    transform: translateY(0) scale(0.96);
                }
                .testi-nav-btn:disabled {
                    opacity: 0.35;
                    cursor: not-allowed;
                    background: #f8fafc;
                    border-color: #e2e8f0;
                    color: #94a3b8;
                    box-shadow: none;
                }
                .testi-dots {
                    display: flex;
                    align-items: center;
                    gap: 0.55rem;
                }
                .testi-dot {
                    width: 0.75rem;
                    height: 0.75rem;
                    border-radius: 9999px;
                    border: none;
                    background: #cbd5e1;
                    cursor: pointer;
                    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
                    padding: 0;
                }
                .testi-dot:hover:not(.active) {
                    background: #94a3b8;
                    transform: scale(1.2);
                }
                .testi-dot.active {
                    width: 2.25rem;
                    background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
                    box-shadow: 0 2px 8px rgba(37,99,235,0.35);
                }
                .testi-page-counter {
                    text-align: center;
                    color: #64748b;
                    font-size: 0.9rem;
                    font-weight: 600;
                    margin-top: 1rem;
                }
            </style>

            <script>
                (function() {
                    let currentSlide = 0;
                    const totalSlides = 6;
                    const totalReviews = 49;
                    const reviewsPerPage = 9;

                    function updateSlider(index, shouldScroll = false) {
                        if (index < 0) index = 0;
                        if (index >= totalSlides) index = totalSlides - 1;
                        currentSlide = index;

                        const slides = document.querySelectorAll('.testi-slide');
                        slides.forEach((slide, i) => {
                            if (i === currentSlide) {
                                slide.classList.add('active');
                            } else {
                                slide.classList.remove('active');
                            }
                        });

                        const dots = document.querySelectorAll('.testi-dot');
                        dots.forEach((dot, i) => {
                            if (i === currentSlide) {
                                dot.classList.add('active');
                                dot.setAttribute('aria-current', 'true');
                            } else {
                                dot.classList.remove('active');
                                dot.removeAttribute('aria-current');
                            }
                        });

                        const prevBtn = document.getElementById('testiPrev');
                        const nextBtn = document.getElementById('testiNext');
                        if (prevBtn) prevBtn.disabled = (currentSlide === 0);
                        if (nextBtn) nextBtn.disabled = (currentSlide === totalSlides - 1);

                        const counter = document.getElementById('testiCounter');
                        if (counter) {
                            const start = currentSlide * reviewsPerPage + 1;
                            const end = Math.min((currentSlide + 1) * reviewsPerPage, totalReviews);
                            const count = end - start + 1;
                            counter.innerHTML = `Page ${currentSlide + 1} of ${totalSlides} &bull; Showing ${count} of ${totalReviews} reviews`;
                        }

                        if (shouldScroll) {
                            const sliderEl = document.getElementById('testiSlider');
                            if (sliderEl) {
                                const yOffset = -90;
                                const y = sliderEl.getBoundingClientRect().top + window.pageYOffset + yOffset;
                                window.scrollTo({ top: y, behavior: 'smooth' });
                            }
                        }
                    }

                    window.testiSlide = function(dir) {
                        updateSlider(currentSlide + dir, true);
                    };

                    window.testiGoTo = function(idx) {
                        updateSlider(idx, true);
                    };

                    // Touch Swipe Navigation for Mobile
                    let touchStartX = 0;
                    let touchEndX = 0;
                    const sliderWrapper = document.getElementById('testiSlider');
                    if (sliderWrapper) {
                        sliderWrapper.addEventListener('touchstart', (e) => {
                            touchStartX = e.changedTouches[0].screenX;
                        }, { passive: true });

                        sliderWrapper.addEventListener('touchend', (e) => {
                            touchEndX = e.changedTouches[0].screenX;
                            if (touchEndX < touchStartX - 50) {
                                window.testiSlide(1);
                            } else if (touchEndX > touchStartX + 50) {
                                window.testiSlide(-1);
                            }
                        }, { passive: true });
                    }

                    // Keyboard arrow navigation when slider is on screen
                    document.addEventListener('keydown', (e) => {
                        const sliderEl = document.getElementById('testiSlider');
                        if (!sliderEl) return;
                        const rect = sliderEl.getBoundingClientRect();
                        if (rect.top < window.innerHeight && rect.bottom > 0) {
                            if (e.key === 'ArrowLeft') {
                                window.testiSlide(-1);
                            } else if (e.key === 'ArrowRight') {
                                window.testiSlide(1);
                            }
                        }
                    });

                    // Initialize first slide on load
                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', () => updateSlider(0, false));
                    } else {
                        updateSlider(0, false);
                    }
                })();
            </script>

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
