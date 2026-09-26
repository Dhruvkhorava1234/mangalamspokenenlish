<!DOCTYPE html>
<html lang="gu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Shree Mangalam Spoken English Classes | શ્રી મંગલમ સ્પોકન ઇંગ્લીશ કલાસીસ Porbandar')</title>
    
    <meta name="description" content="@yield('meta_description', 'Join Shree Mangalam Spoken English Classes in Porbandar. Learn English easily in Gujarati with image-based learning, step-by-step guidance, and affordable courses.')">
    <meta name="keywords" content="Spoken English Classes Porbandar, Learn English in Gujarati, Shree Mangalam Spoken English, Vijay Joshi English Classes, English Grammar Course">

    <!-- Google Fonts: Plus Jakarta Sans, Noto Sans Gujarati, and Caveat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Noto+Sans+Gujarati:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Animated Morph Preloader (Gujarati to English) -->
    <x-page-loader />

    <!-- ========================================== -->
    <!-- 1. TOP BAR / ANNOUNCEMENT HEADER -->
    <!-- ========================================== -->
    <header class="top-bar">
        <div class="container top-bar-content">
            <div class="welcome-badge">
                <span class="pulse-dot"></span>
                <span>Welcome to Shree Mangalam Spoken English Classes</span>
            </div>
            <div class="top-bar-links">
                <a href="tel:+919033965711" class="top-link" title="Call Us">
                    <i data-lucide="phone-call"></i>
                    <span>+91 9033965711</span>
                </a>
                <span class="divider-pipe">|</span>
                <a href="mailto:joshi.vijay700@gmail.com" class="top-link" title="Email Us">
                    <i data-lucide="mail"></i>
                    <span>joshi.vijay700@gmail.com</span>
                </a>
            </div>
        </div>
    </header>

    <!-- ========================================== -->
    <!-- 2. MAIN NAVIGATION BAR -->
    <!-- ========================================== -->
    <nav class="main-navbar">
        <div class="container nav-container">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <div class="brand-logo-emblem">
                    <svg viewBox="0 0 48 48" class="brand-logo-svg">
                        <!-- Open Book Outline -->
                        <path d="M6 36c6-4 12-4 18 0 6-4 12-4 18 0V12c-6-4-12-4-18 0-6-4-12-4-18 0v24z" stroke="#ffffff" />
                        <path d="M24 12v24" stroke="#dbeafe" />
                        <!-- Graduation Cap on top -->
                        <path d="M24 4l14 6-14 6-14-6 14-6z" fill="rgba(34, 211, 238, 0.3)" stroke="#67e8f9" stroke-width="2" />
                        <path d="M34 11.5v7c0 2-4.5 4-10 4s-10-2-10-4v-7" stroke="#67e8f9" stroke-width="2" />
                    </svg>
                </div>
                
                <div class="brand-text font-gujarati">
                    <span class="brand-name">શ્રી મંગલમ</span>
                    <span class="brand-subname">સ્પોકન ઇંગ્લીશ કલાસીસ</span>
                    <span class="brand-tagline">Learn Today &bull; Speak Tomorrow &bull; Grow Forever</span>
                </div>
            </a>

            <!-- Center Menu Links (Desktop) -->
            <div class="nav-menu">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
                <a href="{{ route('courses') }}" class="nav-link {{ request()->routeIs('courses*') ? 'active' : '' }}">Courses</a>
                <a href="{{ route('study-material') }}" class="nav-link {{ request()->routeIs('study-material') ? 'active' : '' }}">Study Material</a>
                <a href="{{ route('testimonials') }}" class="nav-link {{ request()->routeIs('testimonials') ? 'active' : '' }}">Testimonials</a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            </div>

            <!-- Right Action & Auth/Mobile Toggle -->
            <div class="nav-actions">
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn-primary" style="background-color: var(--navy-900);">
                            <i data-lucide="shield" style="width: 1rem; height: 1rem; color: #67e8f9;"></i>
                            <span>Admin Panel</span>
                        </a>
                    @else
                        <a href="{{ route('student.dashboard') }}" class="btn-primary" style="background-color: var(--blue-600);">
                            <i data-lucide="book-open" style="width: 1rem; height: 1rem;"></i>
                            <span>My Courses</span>
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-secondary" style="padding: 0.5rem 0.85rem; font-size: 0.8rem;" title="Log Out">
                            <i data-lucide="log-out" style="width: 1rem; height: 1rem;"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary" style="padding: 0.55rem 1rem; font-size: 0.85rem;">
                        <i data-lucide="log-in" style="width: 1rem; height: 1rem;"></i>
                        <span>Log In</span>
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary">
                        <i data-lucide="user-plus" style="width: 1rem; height: 1rem;"></i>
                        <span>Join Now</span>
                    </a>
                @endauth

                <!-- Mobile Hamburger Button -->
                <button id="mobileMenuBtn" type="button" class="mobile-menu-toggle" aria-label="Toggle navigation menu">
                    <i data-lucide="menu" style="width: 1.5rem; height: 1.5rem;"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div id="mobileMenu" class="mobile-drawer">
            <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="mobile-nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
            <a href="{{ route('courses') }}" class="mobile-nav-link {{ request()->routeIs('courses*') ? 'active' : '' }}">Courses</a>
            <a href="{{ route('study-material') }}" class="mobile-nav-link {{ request()->routeIs('study-material') ? 'active' : '' }}">Study Material</a>
            <a href="{{ route('testimonials') }}" class="mobile-nav-link {{ request()->routeIs('testimonials') ? 'active' : '' }}">Testimonials</a>
            <a href="{{ route('contact') }}" class="mobile-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            
            <div style="padding-top: 0.75rem; display: flex; flex-direction: column; gap: 0.5rem;">
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn-primary" style="width: 100%; text-align: center;">
                            Admin Dashboard
                        </a>
                    @else
                        <a href="{{ route('student.dashboard') }}" class="btn-primary" style="width: 100%; text-align: center;">
                            My Enrolled Courses
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                        @csrf
                        <button type="submit" class="btn-secondary" style="width: 100%; text-align: center; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                            <i data-lucide="log-out" style="width: 1rem; height: 1rem;"></i>
                            Log Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary" style="width: 100%; text-align: center;">
                        Log In
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary" style="width: 100%; text-align: center;">
                        Register Student Account
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages Alert Banner -->
    @if(session('success'))
        <div style="background-color: #ecfdf5; border-bottom: 1px solid #a7f3d0; padding: 0.85rem 1rem; color: #065f46; text-align: center; font-weight: 600; font-size: 0.9rem;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background-color: #fef2f2; border-bottom: 1px solid #fecaca; padding: 0.85rem 1rem; color: #991b1b; text-align: center; font-weight: 600; font-size: 0.9rem;">
            {{ session('error') }}
        </div>
    @endif
    @if(session('info'))
        <div style="background-color: #eff6ff; border-bottom: 1px solid #bfdbfe; padding: 0.85rem 1rem; color: #1e40af; text-align: center; font-weight: 600; font-size: 0.9rem;">
            {{ session('info') }}
        </div>
    @endif

    <!-- ========================================== -->
    <!-- MAIN CONTENT SLOT -->
    <!-- ========================================== -->
    <main>
        @yield('content')
    </main>

    <!-- ========================================== -->
    <!-- FOOTER SECTION -->
    <!-- ========================================== -->
    <footer id="contact" class="footer-main">
        <div class="container">
            <div class="footer-grid">
                
                <!-- Column 1 (Brand) -->
                <div class="footer-col">
                    <div class="footer-brand">
                        <div class="footer-logo-box">
                            <i data-lucide="book-open" style="width: 1.95rem; height: 1.95rem;"></i>
                        </div>
                        <div class="font-gujarati">
                            <span class="footer-brand-subtitle"style="color: #ffffff;">શ્રી મંગલમ</span>
                            <span class="footer-brand-subtitle" style="color: #ffffff;">સ્પોકન ઇંગ્લીશ કલાસીસ</span>
                        </div>
                    </div>
                    <p class="footer-text">
                        Helping students, housewives, and professionals speak English with confidence and fluency.
                    </p>
                    <p class="footer-subtagline">
                        Learn &bull; Speak &bull; Grow
                    </p>
                </div>

                <!-- Column 2 (Contact & Address) -->
                <div class="footer-col">
                    <h4 class="footer-heading">Contact &amp; Location</h4>
                    <div class="footer-contacts">
                        <a href="tel:+919033965711" class="contact-row">
                            <i data-lucide="phone" class="contact-icon"></i>
                            <span style="font-weight: 700; color: var(--white);">9033965711</span>
                        </a>
                        <div class="contact-row">
                            <i data-lucide="map-pin" class="contact-icon"></i>
                            <span class="font-gujarati" style="font-size: 0.8rem; line-height: 1.5;">
                                Shivkuber Complex, S10, Opppsite zudio cloth store, Uganda Road, Porbandar - 360575
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Column 3 (Social Media) -->
                <div class="footer-col">
                    <h4 class="footer-heading">Follow Us</h4>
                    <p class="footer-text" style="font-size: 0.8rem;">Stay updated with free daily tips and vocabulary updates.</p>
                    <div class="social-icons-row">
                        <!-- WhatsApp -->
                        <a href="https://wa.me/919033965711" target="_blank" rel="noopener noreferrer" class="social-btn social-wa" title="WhatsApp">
                            <svg style="width: 1.25rem; height: 1.25rem; fill: currentColor;" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.299.144.35.49 1.199.534 1.286.044.087.073.188.014.303-.058.116-.087.188-.173.289l-.26.302c-.087.087-.179.182-.077.357.101.174.45 1.034 1.258 1.753.649.578 1.196.757 1.37.844.173.087.275.073.376-.044.101-.116.433-.506.549-.68.116-.173.231-.144.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.42-.099.825zm-3.394-10.416c-5.522 0-10 4.477-10 10 0 1.763.457 3.42 1.259 4.869l-1.336 4.881 5.006-1.314c1.4.764 3.003 1.197 4.707 1.197 5.523 0 10-4.477 10-10s-4.477-10-10-10z"/>
                            </svg>
                        </a>
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/english_with_vijay1/" target="_blank" rel="noopener noreferrer" class="social-btn social-insta" title="Instagram">
                            <svg style="width: 1.25rem; height: 1.25rem; fill: currentColor;" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/profile.php?id=100072326893306&ref=PROFILE_EDIT_xav_ig_profile_page_web#" target="_blank" rel="noopener noreferrer" class="social-btn social-fb" title="Facebook">
                            <svg style="width: 1.25rem; height: 1.25rem; fill: currentColor;" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <!-- YouTube -->
                        <a href="https://youtube.com/@speak_english_with_vijay?si=1RwXawNMwjEA0TeG" target="_blank" rel="noopener noreferrer" class="social-btn social-yt" title="YouTube">
                            <svg style="width: 1.25rem; height: 1.25rem; fill: currentColor;" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg> 
                        </a>
                    </div>
                </div>

                <!-- Column 4 (Motto) -->
                <div class="footer-motto-col">
                    <span class="footer-motto-script">
                        Better English,<br>Brighter You
                    </span>
                    <p class="footer-motto-sub">
                        Porbandar's trusted learning academy
                    </p>
                </div>

            </div>

            <!-- Bottom Bar -->
            <div class="footer-bottom">
                <div>
                    &copy; 2024 Shree Mangalam Spoken English Classes. All Rights Reserved.
                </div>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <span>|</span>
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu script and icon refresh -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.renderLucideIcons) {
                window.renderLucideIcons();
            }
            const menuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');

            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('open');
                });
            }
        });
    </script>
</body>
</html>
