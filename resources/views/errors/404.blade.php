@extends('layouts.app')

@section('title', '404 - પેજ મળ્યું નથી | Page Not Found - Shree Mangalam Spoken English Classes')

@section('content')
<div class="error-404-wrapper">
    <div class="container">
        <div class="error-404-card">
            <!-- Decorative Glow Backdrop -->
            <div class="error-glow-orb"></div>

            <!-- Big 404 Visual Indicator -->
            <div class="error-code-badge-wrapper">
                <span class="error-code-number">404</span>
                <div class="error-icon-floating">
                    <i data-lucide="compass" class="error-lucide-icon"></i>
                </div>
            </div>

            <!-- Titles & Explanations -->
            <div class="error-text-content">
                <span class="error-subtitle-badge">
                    <span class="pulse-dot"></span>
                    <span>URL Not Found / સરનામું ખોટું છે</span>
                </span>
                
                <h1 class="error-heading">
                    ક્ષમા કરશો! તમે શોધેલ પેજ ઉપલબ્ધ નથી
                </h1>
                
                <p class="error-subheading-en">
                    Oops! The page you are looking for doesn't exist, has been removed, or the link is incorrect.
                </p>

                <p class="error-gujarati-desc">
                    તમે જે વેબ સરનામું (URL) દાખલ કર્યું છે તે ખોટું હોઈ શકે છે અથવા આ પેજ ખસેડી લેવામાં આવ્યું છે. ચિંતા કરશો નહીં, તમે નીચેના મુખ્ય પેજ પરથી આગળ વધી શકો છો.
                </p>
            </div>

            <!-- Quick Action Buttons -->
            <div class="error-actions-group">
                <a href="{{ route('home') }}" class="btn-primary-gradient">
                    <i data-lucide="home" style="width: 1.15rem; height: 1.15rem;"></i>
                    <span>હોમ પેજ પર જાઓ (Go Home)</span>
                </a>
                <a href="{{ route('courses') }}" class="btn-outline-navy">
                    <i data-lucide="book-open" style="width: 1.15rem; height: 1.15rem;"></i>
                    <span>અમારા કોર્સ જુઓ (View Courses)</span>
                </a>
                <a href="{{ route('contact') }}" class="btn-outline-navy">
                    <i data-lucide="phone-call" style="width: 1.15rem; height: 1.15rem;"></i>
                    <span>સંપર્ક કરો (Contact Us)</span>
                </a>
            </div>

            <!-- Helpful Navigation Suggestions -->
            <div class="error-helpful-links">
                <span class="helpful-links-title">અન્ય ઉપયોગી લિંક્સ (Helpful Links):</span>
                <div class="helpful-pills">
                    <a href="{{ route('about') }}" class="helpful-pill-link">
                        <i data-lucide="info" style="width: 0.95rem; height: 0.95rem;"></i>
                        <span>About Us</span>
                    </a>
                    <a href="{{ route('study-material') }}" class="helpful-pill-link">
                        <i data-lucide="file-text" style="width: 0.95rem; height: 0.95rem;"></i>
                        <span>Study Material</span>
                    </a>
                    <a href="{{ route('testimonials') }}" class="helpful-pill-link">
                        <i data-lucide="star" style="width: 0.95rem; height: 0.95rem;"></i>
                        <span>Reviews</span>
                    </a>
                    <a href="tel:+919033965711" class="helpful-pill-link highlight-pill">
                        <i data-lucide="help-circle" style="width: 0.95rem; height: 0.95rem;"></i>
                        <span>મદદ જોઈએ છે? Call 9033965711</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* ==========================================
   404 ERROR PAGE STYLING
   ========================================== */
.error-404-wrapper {
    min-height: 72vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3.5rem 1rem 4.5rem;
    background: radial-gradient(circle at 50% 20%, rgba(219, 234, 254, 0.45) 0%, rgba(248, 250, 252, 1) 70%);
    position: relative;
    overflow: hidden;
}

.error-404-card {
    position: relative;
    max-width: 760px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 1.5rem;
    padding: 3.25rem 2.25rem;
    text-align: center;
    box-shadow: 0 20px 40px -15px rgba(11, 37, 69, 0.08), 0 0 0 1px rgba(226, 232, 240, 0.85);
    z-index: 1;
}

.error-glow-orb {
    position: absolute;
    top: -50px;
    left: 50%;
    transform: translateX(-50%);
    width: 280px;
    height: 180px;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
    filter: blur(35px);
    z-index: -1;
    pointer-events: none;
}

.error-code-badge-wrapper {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.error-code-number {
    font-size: 6.5rem;
    font-weight: 900;
    line-height: 1;
    letter-spacing: -0.05em;
    background: linear-gradient(135deg, var(--navy-900) 0%, var(--blue-600) 50%, #38bdf8 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    user-select: none;
    filter: drop-shadow(0 6px 12px rgba(37, 99, 235, 0.15));
}

.error-icon-floating {
    position: absolute;
    right: -1.75rem;
    top: 0.25rem;
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: #ffffff;
    width: 3.25rem;
    height: 3.25rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 18px rgba(217, 119, 6, 0.35);
    animation: floatIcon 3s ease-in-out infinite alternate;
}

.error-lucide-icon {
    width: 1.75rem;
    height: 1.75rem;
}

@keyframes floatIcon {
    0% { transform: translateY(0) rotate(0deg); }
    100% { transform: translateY(-8px) rotate(15deg); }
}

.error-subtitle-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
    padding: 0.35rem 0.95rem;
    border-radius: 9999px;
    font-size: 0.825rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 1.25rem;
}

.error-heading {
    font-family: var(--font-gujarati);
    font-size: 1.85rem;
    font-weight: 800;
    color: var(--navy-900);
    margin-bottom: 0.75rem;
    line-height: 1.35;
}

.error-subheading-en {
    font-size: 1.05rem;
    font-weight: 600;
    color: var(--slate-700);
    margin-bottom: 0.85rem;
    line-height: 1.5;
}

.error-gujarati-desc {
    font-family: var(--font-gujarati);
    font-size: 0.95rem;
    color: var(--slate-500);
    max-width: 580px;
    margin: 0 auto 2.25rem;
    line-height: 1.6;
}

.error-actions-group {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 2.5rem;
}

.btn-primary-gradient {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    background: linear-gradient(135deg, var(--navy-900) 0%, var(--blue-600) 100%);
    color: #ffffff !important;
    font-weight: 700;
    font-size: 0.95rem;
    padding: 0.85rem 1.6rem;
    border-radius: 0.75rem;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(11, 37, 69, 0.25);
    transition: all 0.2s ease;
}

.btn-primary-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(11, 37, 69, 0.35);
    color: #ffffff !important;
}

.btn-outline-navy {
    display: inline-flex;
    align-items: center;
    gap: 0.55rem;
    background: #ffffff;
    color: var(--navy-900) !important;
    font-weight: 600;
    font-size: 0.95rem;
    padding: 0.85rem 1.4rem;
    border-radius: 0.75rem;
    border: 1.5px solid var(--slate-300);
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-outline-navy:hover {
    border-color: var(--blue-600);
    color: var(--blue-600) !important;
    background: var(--blue-50);
    transform: translateY(-2px);
}

.error-helpful-links {
    border-top: 1px dashed var(--slate-200);
    padding-top: 1.75rem;
}

.helpful-links-title {
    display: block;
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--slate-500);
    margin-bottom: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.helpful-pills {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 0.65rem;
}

.helpful-pill-link {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.45rem 0.9rem;
    background: var(--slate-50);
    border: 1px solid var(--slate-200);
    border-radius: 9999px;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--slate-600);
    text-decoration: none;
    transition: all 0.15s ease;
}

.helpful-pill-link:hover {
    background: #ffffff;
    border-color: var(--blue-600);
    color: var(--blue-600);
    transform: translateY(-1px);
}

.helpful-pill-link.highlight-pill {
    background: var(--amber-50);
    border-color: var(--amber-400);
    color: #b45309;
}

.helpful-pill-link.highlight-pill:hover {
    background: #fef3c7;
    color: #92400e;
}

@media (max-width: 640px) {
    .error-404-card {
        padding: 2.25rem 1.25rem;
    }
    .error-code-number {
        font-size: 5rem;
    }
    .error-icon-floating {
        right: -0.75rem;
        top: -0.25rem;
        width: 2.75rem;
        height: 2.75rem;
    }
    .error-heading {
        font-size: 1.45rem;
    }
    .btn-primary-gradient,
    .btn-outline-navy {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection
