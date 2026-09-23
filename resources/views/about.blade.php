@extends('layouts.app')

@section('title', 'About Us | Shree Mangalam Spoken English Classes')

@section('content')
    <!-- Page Banner Header -->
    <section class="page-banner">
        <div class="container">
            <div class="page-banner-content">
                <span class="page-banner-badge">About Our Academy</span>
                <h1 class="page-banner-title">Empowering Porbandar Through English</h1>
                <p class="page-banner-sub">
                    Helping Gujarati medium students, homemakers, and career seekers master spoken English with confidence.
                </p>
                <div class="breadcrumbs">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span class="active">About Us</span>
                </div>
            </div>
        </div>
    </section>

    <!-- About Instructor & Legacy Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-grid">
                
                <div class="about-image-wrapper">
                    <!-- Subtle ambient lighting glow behind photo -->
                    <div class="about-image-glow"></div>

                    <!-- Experience Badge with subtle hover lift and pulse -->
                    <div class="about-experience-badge">
                        <div class="badge-pulse-ring"></div>
                        <span class="exp-number">15+</span>
                        <span class="exp-text">Years of Teaching Excellence</span>
                    </div>

                    <!-- Floating Verified Mentor Chip -->
                    <div class="about-mentor-chip">
                        <span class="mentor-chip-icon">
                            <i data-lucide="shield-check" style="width: 1.15rem; height: 1.15rem;"></i>
                        </span>
                        <div>
                            <span class="mentor-chip-title">Verified Master Trainer</span>
                            <span class="mentor-chip-sub">5,000+ Students Mentored</span>
                        </div>
                    </div>

                    <div class="about-image-card">
                        <!-- Shimmer light reflection effect -->
                        <div class="about-image-sheen"></div>

                        <img src="{{ asset('images/vijayjoshi2.jpeg') }}" 
                             onerror="this.onerror=null; this.src='{{ asset('images/placeholders/hero-default.svg') }}';" 
                             alt="Vijay Joshi - Founder, Teacher and Author at Shree Mangalam Classes" 
                             class="about-main-img"
                             loading="eager">

                        <div class="about-instructor-caption">
                            <div class="instructor-caption-badge">
                                <span class="caption-dot"></span>
                                <span>Master English Trainer</span>
                            </div>
                            <h3 class="instructor-caption-name">Vijay Joshi</h3>
                            <p class="instructor-caption-role">Founder, Teacher &amp; Author &bull; Shree Mangalam Classes</p>
                        </div>
                    </div>
                </div>

                <div class="about-content-wrapper">
                    <span class="section-label">
                        <i data-lucide="award" style="width: 1rem; height: 1rem;"></i>
                        <span>Founder, Teacher &amp; Author: Vijay Joshi</span>
                    </span>
                    <h2 class="about-heading font-gujarati">
                        સરળ ગુજરાતી માધ્યમથી અંગ્રેજી શીખવાનો શ્રેષ્ઠ અનુભવ
                    </h2>
                    <p class="about-text-lead">
                        At Shree Mangalam Spoken English Classes, we believe that English is not merely an academic subject — it is a life-changing skill.
                    </p>
                    <p class="about-text-body">
                        Founded in Porbandar, our mission is to eliminate the fear of speaking English among Gujarati learners. Many students understand grammar rules theoretically, yet hesitate when speaking in public. We bridge this exact gap through our proven visual methodology, daily conversations, and supportive classroom environment.
                    </p>

                    <!-- Key Pillars Grid -->
                    <div class="about-pillars-grid">
                        <div class="pillar-box">
                            <div class="pillar-icon pi-blue">
                                <i data-lucide="check" style="width: 1.25rem; height: 1.25rem;"></i>
                            </div>
                            <div>
                                <h4 class="pillar-title">Grammar Without Jargon</h4>
                                <p class="pillar-desc">Rules demystified using day-to-day Gujarati parallels.</p>
                            </div>
                        </div>

                        <div class="pillar-box">
                            <div class="pillar-icon pi-red">
                                <i data-lucide="eye" style="width: 1.25rem; height: 1.25rem;"></i>
                            </div>
                            <div>
                                <h4 class="pillar-title">Visual Retention</h4>
                                <p class="pillar-desc">Diagrams and real pictures for rapid memory recall.</p>
                            </div>
                        </div>

                        <div class="pillar-box">
                            <div class="pillar-icon pi-emerald">
                                <i data-lucide="mic" style="width: 1.25rem; height: 1.25rem;"></i>
                            </div>
                            <div>
                                <h4 class="pillar-title">Daily Speaking Drills</h4>
                                <p class="pillar-desc">Overcome stage fear and build authentic stage confidence.</p>
                            </div>
                        </div>

                        <div class="pillar-box">
                            <div class="pillar-icon pi-amber">
                                <i data-lucide="clock" style="width: 1.25rem; height: 1.25rem;"></i>
                            </div>
                            <div>
                                <h4 class="pillar-title">Flexible Timings</h4>
                                <p class="pillar-desc">Special batches for school students, housewives & working professionals.</p>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 2rem;">
                        <a href="{{ route('courses') }}" class="btn-primary">
                            <span>Browse Our Courses</span>
                            <i data-lucide="arrow-right" style="width: 1rem; height: 1rem;"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Institute Values & Methodology -->
    <section class="features-section" style="background-color: var(--slate-50); border-top: 1px solid var(--slate-200); border-bottom: 1px solid var(--slate-200);">
        <div class="container">
            <div class="section-head-center">
                <h2 class="section-title">Our Learning Methodology</h2>
                <div class="center-line"></div>
                <p class="section-head-subtitle">
                    A four-stage learning journey designed to take you from basic sentence construction to natural fluency.
                </p>
            </div>

            <div class="steps-timeline-grid">
                <div class="timeline-step">
                    <span class="step-num">01</span>
                    <h3 class="step-title">Foundation &amp; Phonics</h3>
                    <p class="step-desc">Master correct English alphabet sounds, pronunciations, and basic Gujarati-to-English translation formulas.</p>
                </div>

                <div class="timeline-step">
                    <span class="step-num">02</span>
                    <h3 class="step-title">Grammar with Images</h3>
                    <p class="step-desc">Tenses, prepositions, and active/passive forms taught visually so you never have to memorize rules blindly.</p>
                </div>

                <div class="timeline-step">
                    <span class="step-num">03</span>
                    <h3 class="step-title">Vocabulary &amp; Sentences</h3>
                    <p class="step-desc">Learn daily situational words and phrases for shopping, banking, office meetings, and phone calls.</p>
                </div>

                <div class="timeline-step">
                    <span class="step-num">04</span>
                    <h3 class="step-title">Public Speaking &amp; Fluency</h3>
                    <p class="step-desc">Group discussions, role-playing, debates, and one-on-one speaking drills to eliminate hesitation completely.</p>
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
                        <i data-lucide="user-check" style="width: 2rem; height: 2rem;"></i>
                    </div>
                    <div>
                        <h3 class="cta-heading">Ready to Start Speaking Confidently?</h3>
                        <p class="cta-desc">Visit our institute in Porbandar or call us today to attend a free trial class.</p>
                    </div>
                </div>
                <div class="cta-right">
                    <a href="{{ route('contact') }}" class="btn-primary cta-button">
                        <span>Get In Touch</span>
                        <i data-lucide="arrow-right" style="width: 1.25rem; height: 1.25rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
