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
    <section class="testimonials-section" style="background-color: var(--white); border-top: none;">
        <div class="container">
            
            <div class="section-head-center">
                <h2 class="section-title">Confidence Transformed Into Fluency</h2>
                <div class="center-line"></div>
                <p class="section-head-subtitle">
                    Discover how our Gujarati-friendly teaching helped learners across all ages achieve their personal &amp; professional dreams.
                </p>
            </div>

            <div class="testimonials-grid" style="grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));">
                
                <!-- Testimonial 1 -->
                <div class="testimonial-card">
                    <div>
                        <div class="stars-row">
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                        </div>
                        <p class="testimonial-quote">
                            &ldquo;Very easy to understand. Image based learning makes a big difference. I used to be terrified of speaking during school presentations, but Vijay sir helped me gain complete confidence.&rdquo;
                        </p>
                    </div>

                    <div class="testimonial-author">
                        <img 
                            src="{{ asset('images/meet_patel.jpg') }}" 
                            onerror="this.onerror=null; this.src='{{ asset('images/placeholders/avatar-default.svg') }}';"
                            alt="Meet Patel - Shree Mangalam Student" 
                            class="author-avatar"
                        >
                        <div>
                            <h4 class="author-name">Meet Patel</h4>
                            <p class="author-role">Std. 10 Student &bull; Porbandar</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card">
                    <div>
                        <div class="stars-row">
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                        </div>
                        <p class="testimonial-quote">
                            &ldquo;I am a housewife and was always hesitant during Parent-Teacher meetings at my children's school. Now I can speak English confidently and understand everything effortlessly. Thank you Shree Mangalam!&rdquo;
                        </p>
                    </div>

                    <div class="testimonial-author">
                        <img 
                            src="{{ asset('images/heena_ben.jpg') }}" 
                            onerror="this.onerror=null; this.src='{{ asset('images/placeholders/avatar-default.svg') }}';"
                            alt="Heena Ben - Shree Mangalam Student" 
                            class="author-avatar"
                        >
                        <div>
                            <h4 class="author-name">Heena Ben</h4>
                            <p class="author-role">Homemaker &bull; Porbandar</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="testimonial-card">
                    <div>
                        <div class="stars-row">
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                        </div>
                        <p class="testimonial-quote">
                            &ldquo;Best English classes in Porbandar. Notes and images are excellent. Dealing with out-of-state business clients and vendors has become so much smoother for my company.&rdquo;
                        </p>
                    </div>

                    <div class="testimonial-author">
                        <img 
                            src="{{ asset('images/rajeshbhai.jpg') }}" 
                            onerror="this.onerror=null; this.src='{{ asset('images/placeholders/avatar-default.svg') }}';"
                            alt="Rajeshbhai - Shree Mangalam Student" 
                            class="author-avatar"
                        >
                        <div>
                            <h4 class="author-name">Rajeshbhai</h4>
                            <p class="author-role">Businessman &bull; Porbandar</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 4 -->
                <div class="testimonial-card">
                    <div>
                        <div class="stars-row">
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                        </div>
                        <p class="testimonial-quote">
                            &ldquo;As a Gujarati medium graduate, clearing multinational company interviews felt impossible. The daily speaking practice sessions and interview drills gave me the exact skills I needed.&rdquo;
                        </p>
                    </div>

                    <div class="testimonial-author">
                        <div class="author-avatar" style="background-color: var(--blue-100); display: flex; align-items: center; justify-content: center; font-weight: 800; color: var(--blue-600); font-size: 1.25rem;">
                            PB
                        </div>
                        <div>
                            <h4 class="author-name">Pooja Barot</h4>
                            <p class="author-role">Software Associate</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 5 -->
                <div class="testimonial-card">
                    <div>
                        <div class="stars-row">
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                        </div>
                        <p class="testimonial-quote">
                            &ldquo;Vijay Joshi sir teaches tenses in such an intuitive manner that you never get confused between simple past and present perfect again. The 12 tenses chart alone is worth gold!&rdquo;
                        </p>
                    </div>

                    <div class="testimonial-author">
                        <div class="author-avatar" style="background-color: var(--emerald-100); display: flex; align-items: center; justify-content: center; font-weight: 800; color: var(--emerald-600); font-size: 1.25rem;">
                            KJ
                        </div>
                        <div>
                            <h4 class="author-name">Karan Joshi</h4>
                            <p class="author-role">College Student</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 6 -->
                <div class="testimonial-card">
                    <div>
                        <div class="stars-row">
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                            <i data-lucide="star"></i>
                        </div>
                        <p class="testimonial-quote">
                            &ldquo;The atmosphere in class is extremely encouraging. No one laughs at your mistakes; rather, Vijay sir guides you step-by-step until your sentence is grammatically correct.&rdquo;
                        </p>
                    </div>

                    <div class="testimonial-author">
                        <div class="author-avatar" style="background-color: var(--amber-100); display: flex; align-items: center; justify-content: center; font-weight: 800; color: var(--amber-500); font-size: 1.25rem;">
                            AS
                        </div>
                        <div>
                            <h4 class="author-name">Ankit Shah</h4>
                            <p class="author-role">Accountant</p>
                        </div>
                    </div>
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
