@extends('layouts.app')

@section('title', 'Home | Shree Mangalam Spoken English Classes Porbandar')

@section('content')
    <!-- ========================================== -->
    <!-- 1. HERO SECTION -->
    <!-- ========================================== -->
    <section class="hero-section">
        <div class="hero-blob-1"></div>
        <div class="hero-blob-2"></div>

        <div class="container">
            <div class="hero-grid">
                
                <!-- Left Column (Content & Badges) -->
                <div class="hero-content">
                    <div>
                        <h2 class="hero-subtitle-gu font-gujarati">
                            આત્મવિશ્વાસ સાથે
                        </h2>
                        <h1 class="hero-title-en">
                            SPEAK ENGLISH
                        </h1>
                        <p class="hero-tagline-motto">
                            FOR A BRIGHTER TOMORROW
                        </p>
                        
                        <div class="hero-pills-row">
                            <span>Learn</span>
                            <span style="color: var(--slate-300);">&bull;</span>
                            <span>Practice</span>
                            <span style="color: var(--slate-300);">&bull;</span>
                            <span>Improve</span>
                            <span style="color: var(--slate-300);">&bull;</span>
                            <span>Succeed</span>
                        </div>
                    </div>

                    <!-- Highlight Quote Box -->
                    <div class="hero-quote-box">
                        <p>&ldquo;English is not a subject, It is a skill for life.&rdquo;</p>
                    </div>

                    <!-- 4 Key Feature Badges -->
                    <div class="badges-grid-4">
                        <div class="badge-card">
                            <div class="badge-icon-wrap badge-icon-blue">
                                <i data-lucide="image"></i>
                            </div>
                            <span class="badge-title">Image Based Learning</span>
                        </div>

                        <div class="badge-card">
                            <div class="badge-icon-wrap badge-icon-red">
                                <i data-lucide="file-text"></i>
                            </div>
                            <span class="badge-title">Easy to Understand Notes</span>
                        </div>

                        <div class="badge-card">
                            <div class="badge-icon-wrap badge-icon-amber">
                                <i data-lucide="lightbulb"></i>
                            </div>
                            <span class="badge-title">Step by Step Guidance</span>
                        </div>

                        <div class="badge-card">
                            <div class="badge-icon-wrap badge-icon-emerald">
                                <i data-lucide="users"></i>
                            </div>
                            <span class="badge-title">For All Age Groups</span>
                        </div>
                    </div>

                    <!-- Action buttons -->
                    <div class="hero-actions">
                        <a href="{{ route('courses') }}" class="btn-primary">
                            <span>Explore Our Courses</span>
                            <i data-lucide="arrow-right" style="width: 1rem; height: 1rem;"></i>
                        </a>
                        <a href="tel:+919033965711" class="btn-secondary">
                            <i data-lucide="phone" style="width: 1.1rem; height: 1.1rem; color: var(--emerald-600);"></i>
                            <span>Call: +91 9033965711</span>
                        </a>
                    </div>
                </div>

                <!-- Right Column (Hero Visual & Floating Cards) -->
                <div class="hero-visual-col">
                    <div class="hero-visual-wrapper">
                        
                        <div class="floating-script-badge">
                            <span>Small Steps<br>Big Results</span>
                        </div>

                        <div class="hero-img-container">
                            <img 
                                src="{{ asset('images/student_hero.jpg') }}" 
                                onerror="this.onerror=null; this.src='{{ asset('images/placeholders/hero-default.svg') }}';"
                                alt="Confident Indian Student with Shree Mangalam Spoken English" 
                                class="hero-student-img"
                            >
                            
                            <div class="hero-photo-tag">
                                <div class="photo-tag-top">
                                    <i data-lucide="sparkles" style="width: 1.1rem; height: 1.1rem; color: var(--amber-400);"></i>
                                    <span>Better English</span>
                                </div>
                                <span class="photo-tag-bottom">Brighter You</span>
                            </div>
                        </div>

                        <div class="floating-pills-stack">
                            <div class="floating-pill pill-green">
                                <span class="floating-pill-dot"></span>
                                <span>Learn English</span>
                            </div>
                            <div class="floating-pill pill-blue">
                                <span class="floating-pill-dot"></span>
                                <span>Build Confidence</span>
                            </div>
                            <div class="floating-pill pill-red">
                                <span class="floating-pill-dot"></span>
                                <span>Create Opportunities</span>
                            </div>
                            <div class="floating-pill pill-orange">
                                <span class="floating-pill-dot"></span>
                                <span>Shape Your Future</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 2. COURSES PREVIEW SECTION -->
    <!-- ========================================== -->
    <section class="courses-section">
        <div class="container">
            
            <div class="section-head-bar">
                <div>
                    <div class="section-label">
                        <i data-lucide="book-open" style="width: 1rem; height: 1rem;"></i>
                        <span>Skill Building Programs</span>
                    </div>
                    <h2 class="section-title">
                        Our Popular Courses
                    </h2>
                </div>
                <a href="{{ route('courses') }}" class="btn-secondary" style="background-color: var(--white); border-radius: 0.5rem; padding: 0.6rem 1.25rem; font-size: 0.875rem;">
                    <span>View All Courses</span>
                    <i data-lucide="arrow-right" style="width: 1rem; height: 1rem;"></i>
                </a>
            </div>

            <!-- 5 Courses Grid Layout -->
            <div class="courses-grid-5">
                <!-- 1. Basic English Course -->
                <div class="course-card c-blue">
                    <div class="course-card-top">
                        <div class="course-icon-badge">A B C</div>
                    </div>
                    <div class="course-card-body">
                        <div>
                            <h3 class="course-title">Basic English Course</h3>
                            <p class="course-desc">Start from the basics and build a strong foundation.</p>
                        </div>
                        <a href="{{ route('courses') }}" class="btn-course-action" style="display: block; text-align: center;">View Course</a>
                    </div>
                </div>

                <!-- 2. English Grammar Course -->
                <div class="course-card c-red">
                    <div class="course-card-top">
                        <div class="course-icon-badge">
                            <i data-lucide="notebook-pen" style="width: 2rem; height: 2rem;"></i>
                        </div>
                    </div>
                    <div class="course-card-body">
                        <div>
                            <h3 class="course-title">English Grammar Course</h3>
                            <p class="course-desc">Learn grammar in a simple and easy way.</p>
                        </div>
                        <a href="{{ route('courses') }}" class="btn-course-action" style="display: block; text-align: center;">View Course</a>
                    </div>
                </div>

                <!-- 3. English Grammar Practice Course -->
                <div class="course-card c-amber">
                    <div class="course-card-top">
                        <div class="course-icon-badge">
                            <i data-lucide="pencil-line" style="width: 2rem; height: 2rem;"></i>
                        </div>
                    </div>
                    <div class="course-card-body">
                        <div>
                            <h3 class="course-title">English Grammar Practice</h3>
                            <p class="course-desc">Practice makes perfect! Improve your grammar through practice.</p>
                        </div>
                        <a href="{{ route('courses') }}" class="btn-course-action" style="display: block; text-align: center;">View Course</a>
                    </div>
                </div>

                <!-- 4. Spoken English Course -->
                <div class="course-card c-teal">
                    <div class="course-card-top">
                        <div class="course-icon-badge">
                            <i data-lucide="messages-square" style="width: 2rem; height: 2rem;"></i>
                        </div>
                    </div>
                    <div class="course-card-body">
                        <div>
                            <h3 class="course-title">Spoken English Course</h3>
                            <p class="course-desc">Improve your speaking skills with daily practice.</p>
                        </div>
                        <a href="{{ route('courses') }}" class="btn-course-action" style="display: block; text-align: center;">View Course</a>
                    </div>
                </div>

                <!-- 5. English Vocabulary Course -->
                <div class="course-card c-purple">
                    <div class="course-card-top">
                        <div class="course-icon-badge">
                            <i data-lucide="book-marked" style="width: 2rem; height: 2rem;"></i>
                        </div>
                    </div>
                    <div class="course-card-body">
                        <div>
                            <h3 class="course-title">English Vocabulary</h3>
                            <p class="course-desc">Learn new words and use them confidently.</p>
                        </div>
                        <a href="{{ route('courses') }}" class="btn-course-action" style="display: block; text-align: center;">View Course</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- CLASS HIGHLIGHTS & SLIDES ANIMATED SLIDER -->
    <!-- ========================================== -->
    <section class="gallery-slider-section">
        <div class="container text-center">
            <div class="section-label" style="display: inline-flex; margin-bottom: 0.5rem;">
                <i data-lucide="sparkles" style="width: 1rem; height: 1rem;"></i>
                <span>UNLOCK YOUR POTENTIAL WITH ENGLISH✨</span>
            </div>
            <h2 class="section-title" style="margin-bottom: 0.5rem;">
                Why English is Important?
            </h2>
            <p style="color: var(--slate-600); max-width: 600px; margin: 0 auto; font-size: 0.95rem;">
                English connects you to better education, better careers, and a bigger world. It builds confidence, improves communication, and helps you discover new opportunities. At Shree Mangalam Academy, we turn English learning into a practical skill for everyday life and career growth.
            </p>
        </div>

        <!-- Infinite Loop Smooth Animated Marquee Slider -->
        <div class="gallery-slider-wrapper">
            <div class="gallery-slider-track">
                @php
                    $slides = [
                        ['file' => '1.jpeg', 'caption' => 'Interactive Learning Sessions'],
                        ['file' => '2.jpeg', 'caption' => 'Grammar & Vocabulary Practice'],
                        ['file' => '3.jpeg', 'caption' => 'Student Group Discussions'],
                        ['file' => '4.jpeg', 'caption' => 'Spoken English Practice'],
                        ['file' => '5.jpeg', 'caption' => 'Confidence Building Activities'],
                        ['file' => '6.jpeg', 'caption' => 'Daily Conversation Practice'],
                        ['file' => '7.jpeg', 'caption' => 'Personalized Guidance'],
                        ['file' => '8.jpeg', 'caption' => 'Public Speaking & Presentations'],
                        ['file' => '9.jpeg', 'caption' => 'Interactive Visual Smart Class'],
                        ['file' => '10.jpeg', 'caption' => 'Successful Batches & Celebrations'],
                    ];
                @endphp

                {{-- Set 1 (Original items) --}}
                @foreach($slides as $index => $slide)
                    <div class="gallery-slide-card" 
                         role="button" 
                         tabindex="0"
                         onclick="openGalleryLightbox({{ $index }})"
                         title="Click to view full image">
                        <img src="{{ asset('images/slides/' . $slide['file']) }}" alt="{{ $slide['caption'] }}" class="gallery-slide-img" loading="lazy">
                        <div class="gallery-slide-badge">
                            <i data-lucide="zoom-in" style="width: 0.9rem; height: 0.9rem; color: #38bdf8;"></i>
                            <span>{{ $slide['caption'] }}</span>
                        </div>
                    </div>
                @endforeach

                {{-- Set 2 (Duplicated items for seamless infinite loop) --}}
                @foreach($slides as $index => $slide)
                    <div class="gallery-slide-card" 
                         role="button" 
                         tabindex="0"
                         onclick="openGalleryLightbox({{ $index }})"
                         title="Click to view full image"
                         aria-hidden="true">
                        <img src="{{ asset('images/slides/' . $slide['file']) }}" alt="{{ $slide['caption'] }}" class="gallery-slide-img" loading="lazy">
                        <div class="gallery-slide-badge">
                            <i data-lucide="zoom-in" style="width: 0.9rem; height: 0.9rem; color: #38bdf8;"></i>
                            <span>{{ $slide['caption'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Lightbox Fullscreen Popup Modal -->
        <div id="galleryLightbox" class="lightbox-modal" onclick="closeGalleryLightbox(event)">
            <button type="button" class="lightbox-nav-btn lightbox-btn-prev" onclick="changeLightboxSlide(-1); event.stopPropagation();" title="Previous Image">
                <i data-lucide="chevron-left" style="width: 1.5rem; height: 1.5rem;"></i>
            </button>
            <button type="button" class="lightbox-nav-btn lightbox-btn-next" onclick="changeLightboxSlide(1); event.stopPropagation();" title="Next Image">
                <i data-lucide="chevron-right" style="width: 1.5rem; height: 1.5rem;"></i>
            </button>

            <div class="lightbox-container" onclick="event.stopPropagation()">
                <button type="button" class="lightbox-btn-close" onclick="closeGalleryLightbox()" title="Close Viewer">
                    &times;
                </button>
                <img id="lightboxImage" src="" alt="Shree Mangalam Poster" class="lightbox-img">
                <div id="lightboxCaption" class="lightbox-caption-bar"></div>
            </div>
        </div>
    </section>

    <!-- Lightbox Controller Script -->
    <script>
        const gallerySlides = @json($slides);
        let currentSlideIndex = 0;

        function openGalleryLightbox(index) {
            currentSlideIndex = index;
            updateLightboxContent();
            const modal = document.getElementById('galleryLightbox');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            if (window.renderLucideIcons) window.renderLucideIcons();
        }

        function closeGalleryLightbox(e) {
            if (e && e.target && e.target.closest('.lightbox-container') && !e.target.closest('.lightbox-btn-close')) {
                return;
            }
            const modal = document.getElementById('galleryLightbox');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        function changeLightboxSlide(direction) {
            currentSlideIndex = (currentSlideIndex + direction + gallerySlides.length) % gallerySlides.length;
            updateLightboxContent();
        }

        function updateLightboxContent() {
            const slide = gallerySlides[currentSlideIndex];
            const imgEl = document.getElementById('lightboxImage');
            const capEl = document.getElementById('lightboxCaption');
            if (imgEl && capEl && slide) {
                imgEl.src = "{{ asset('images/slides') }}/" + slide.file;
                capEl.textContent = (currentSlideIndex + 1) + " / " + gallerySlides.length + " - " + slide.caption;
            }
        }

        document.addEventListener('keydown', (e) => {
            const modal = document.getElementById('galleryLightbox');
            if (modal && modal.classList.contains('active')) {
                if (e.key === 'Escape') closeGalleryLightbox();
                if (e.key === 'ArrowRight') changeLightboxSlide(1);
                if (e.key === 'ArrowLeft') changeLightboxSlide(-1);
            }
        });
    </script>

    <!-- ========================================== -->
    <!-- 3. WHY CHOOSE US PREVIEW -->
    <!-- ========================================== -->
    <section class="features-section">
        <div class="container">
            <div class="section-head-center">
                <h2 class="section-title">Why Choose Shree Mangalam?</h2>
                <div class="center-line"></div>
                <p class="section-head-subtitle">
                    Our unique teaching pedagogy designed especially for Gujarati-medium students & learners.
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-item f-blue">
                    <div class="feature-icon-circle">
                        <i data-lucide="graduation-cap" style="width: 1.75rem; height: 1.75rem;"></i>
                    </div>
                    <div>
                        <h3 class="feature-title">Experienced Teacher</h3>
                        <p class="feature-subtitle sub-blue">Learn from Vijay Joshi</p>
                        <p class="feature-detail">Decades of expert guidance and personalized mentoring.</p>
                    </div>
                </div>

                <div class="feature-item f-green">
                    <div class="feature-icon-circle">
                        <i data-lucide="check-circle-2" style="width: 1.75rem; height: 1.75rem;"></i>
                    </div>
                    <div>
                        <h3 class="feature-title">Simple &amp; Easy Language</h3>
                        <p class="feature-subtitle sub-green font-gujarati">English explained in Gujarati</p>
                        <p class="feature-detail">Clear translations & practical real-life examples.</p>
                    </div>
                </div>

                <div class="feature-item f-red">
                    <div class="feature-icon-circle">
                        <i data-lucide="image" style="width: 1.75rem; height: 1.75rem;"></i>
                    </div>
                    <div>
                        <h3 class="feature-title">Image Based Learning</h3>
                        <p class="feature-subtitle sub-red">Easy to understand for everyone</p>
                        <p class="feature-detail">Visual associations that help remember grammar rules easily.</p>
                    </div>
                </div>

                <div class="feature-item f-amber">
                    <div class="feature-icon-circle">
                        <i data-lucide="users-round" style="width: 1.75rem; height: 1.75rem;"></i>
                    </div>
                    <div>
                        <h3 class="feature-title">For All Age Groups</h3>
                        <p class="feature-subtitle sub-amber">Students, Housewives, Professionals</p>
                        <p class="feature-detail">Tailored batch timings and friendly classroom atmosphere.</p>
                    </div>
                </div>

                <div class="feature-item f-purple">
                    <div class="feature-icon-circle">
                        <i data-lucide="indian-rupee" style="width: 1.75rem; height: 1.75rem;"></i>
                    </div>
                    <div>
                        <h3 class="feature-title">Affordable Courses</h3>
                        <p class="feature-subtitle sub-purple">Quality Education at Reasonable Fees</p>
                        <p class="feature-detail">Value-focused programs with complete study materials included.</p>
                    </div>
                </div>

                <div class="feature-item f-sky">
                    <div class="feature-icon-circle">
                        <i data-lucide="trending-up" style="width: 1.75rem; height: 1.75rem;"></i>
                    </div>
                    <div>
                        <h3 class="feature-title">Learn Anytime Anywhere</h3>
                        <p class="feature-subtitle sub-sky">Study at your own pace</p>
                        <p class="feature-detail">Flexible sessions with quick revision support.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 4. CALL TO ACTION (CTA) BANNER -->
    <!-- ========================================== -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-banner">
                <div class="cta-left">
                    <div class="cta-icon-box">
                        <i data-lucide="send" style="width: 2rem; height: 2rem;"></i>
                    </div>
                    <div>
                        <h3 class="cta-heading">Start Your English Journey Today!</h3>
                        <p class="cta-desc">
                            Join Shree Mangalam Spoken English Classes and take the first step towards a brighter future.
                        </p>
                    </div>
                </div>

                <div class="cta-right">
                    <a href="{{ route('contact') }}" class="btn-primary cta-button">
                        <span>Enroll Now</span>
                        <i data-lucide="arrow-right" style="width: 1.25rem; height: 1.25rem;"></i>
                    </a>
                    <span class="cta-script-text">
                        Practice Makes Progress
                    </span>
                </div>
            </div>
        </div>
    </section>
@endsection
