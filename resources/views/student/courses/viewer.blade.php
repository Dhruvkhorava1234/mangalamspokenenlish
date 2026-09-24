<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Viewer &bull; {{ $course->title }} &bull; Shree Mangalam</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- OCR Engine: Tesseract.js for reading image text -->
    <script src="https://cdn.jsdelivr.net/npm/tesseract.js@5/dist/tesseract.min.js"></script>

    <style>
        * { box-sizing: border-box; }
        body {
            background-color: #090d16;
            color: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        /* Header Bar */
        .viewer-header {
            background: #0f172a;
            border-bottom: 1px solid #1e293b;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 50;
        }

        /* Main Workspace */
        .viewer-main {
            flex: 1;
            display: flex;
            position: relative;
            overflow: hidden;
        }

        /* Slide Stage */
        .slide-stage {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            background: radial-gradient(circle at center, #111827 0%, #090d16 100%);
        }

        .slide-image-wrapper {
            max-width: 100%;
            max-height: calc(100vh - 210px);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .slide-img {
            max-width: 100%;
            max-height: calc(100vh - 210px);
            object-fit: contain;
            border-radius: 0.75rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
            border: 1px solid #334155;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .slide-caption-bar {
            margin-top: 1rem;
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(8px);
            padding: 0.5rem 1.25rem;
            border-radius: 9999px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #93c5fd;
            border: 1px solid #1e293b;
        }

        /* Nav Arrows */
        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 9999px;
            background: rgba(15, 23, 42, 0.75);
            color: #ffffff;
            border: 1px solid #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            backdrop-filter: blur(6px);
            transition: all 0.2s ease;
            z-index: 30;
        }
        .nav-btn:hover {
            background: #2563eb;
            border-color: #3b82f6;
            transform: translateY(-50%) scale(1.08);
        }
        .nav-prev { left: 1.5rem; }
        .nav-next { right: 1.5rem; }

        /* Bottom Thumbnail Strip */
        .thumbnail-strip {
            background: #0f172a;
            border-top: 1px solid #1e293b;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            overflow-x: auto;
            max-height: 95px;
        }

        .thumb-item {
            width: 80px;
            height: 52px;
            border-radius: 0.375rem;
            overflow: hidden;
            border: 2px solid transparent;
            cursor: pointer;
            opacity: 0.5;
            transition: all 0.15s ease;
            flex-shrink: 0;
            position: relative;
            user-select: none;
            -webkit-user-select: none;
        }
        .thumb-item:hover { opacity: 0.85; }
        .thumb-item.active {
            border-color: #38bdf8;
            opacity: 1;
            transform: scale(1.05);
            box-shadow: 0 0 12px rgba(56, 189, 248, 0.4);
        }
        .thumb-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            pointer-events: none;
            user-select: none;
            -webkit-user-select: none;
        }

        /* Anti-Screenshot & Anti-Download Protection */
        .protected-content {
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -webkit-touch-callout: none;
        }

        /* Transparent shield overlay preventing right-click & drag on image */
        .image-shield {
            position: absolute;
            inset: 0;
            z-index: 20;
            background: transparent;
            cursor: default;
        }

        /* Watermark Pattern Overlay */
        .watermark-overlay {
            position: absolute;
            inset: 0;
            z-index: 15;
            pointer-events: none;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            opacity: 0.13;
            user-select: none;
        }
        .watermark-row {
            display: flex;
            justify-content: space-around;
            white-space: nowrap;
            transform: rotate(-18deg);
            font-size: 0.85rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        /* Screenshot warning flash/overlay */
        #screenshotWarning {
            position: fixed;
            inset: 0;
            z-index: 999999;
            background: #090d16;
            color: #f43f5e;
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
        }

        /* Zoom Controls Bar */
        .zoom-toolbar {
            position: absolute;
            bottom: 1.25rem;
            right: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            background: rgba(15, 23, 42, 0.85);
            border: 1px solid #334155;
            backdrop-filter: blur(10px);
            padding: 0.3rem 0.5rem;
            border-radius: 9999px;
            z-index: 35;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            transition: all 0.2s ease;
        }
        .zoom-toolbar:hover {
            border-color: #38bdf8;
            background: rgba(15, 23, 42, 0.95);
        }
        .zoom-btn {
            background: rgba(30, 41, 59, 0.9);
            border: 1px solid #475569;
            color: #f1f5f9;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .zoom-btn:hover {
            background: #2563eb;
            border-color: #38bdf8;
            color: #ffffff;
            transform: scale(1.08);
        }
        .zoom-level-badge {
            font-size: 0.75rem;
            font-weight: 700;
            color: #38bdf8;
            padding: 0 0.4rem;
            min-width: 42px;
            text-align: center;
            user-select: none;
        }

        /* Read Aloud Button & Speech Controls */
        .btn-read-aloud {
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            border: 1px solid #38bdf8;
            color: #ffffff;
            padding: 0.45rem 1rem;
            border-radius: 9999px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            font-size: 0.82rem;
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.35);
            transition: all 0.2s ease;
        }
        .btn-read-aloud:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.5);
            filter: brightness(1.1);
        }
        .btn-read-aloud:active {
            transform: translateY(0);
        }
        .btn-read-aloud.speaking {
            background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
            border-color: #fb7185;
            box-shadow: 0 0 16px rgba(244, 63, 94, 0.6);
            animation: pulse-speak 1.5s infinite;
        }
        @keyframes pulse-speak {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.04); }
        }

        /* Point & Read on Hover Button */
        .btn-hover-read {
            background: rgba(30, 41, 59, 0.85);
            border: 1px solid #475569;
            color: #94a3b8;
            padding: 0.45rem 0.9rem;
            border-radius: 9999px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.82rem;
            font-weight: 700;
            transition: all 0.2s ease;
        }
        .btn-hover-read:hover {
            border-color: #38bdf8;
            color: #ffffff;
            background: #1e293b;
        }
        .btn-hover-read.active {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            border-color: #34d399;
            color: #ffffff;
            box-shadow: 0 0 14px rgba(16, 185, 129, 0.4);
        }

        /* Hover Overlay Container on Slide */
        .hover-read-overlay {
            position: absolute;
            inset: 0;
            z-index: 25;
            pointer-events: auto;
        }
        .hover-word-box {
            position: absolute;
            cursor: pointer;
            border-radius: 4px;
            background: rgba(56, 189, 248, 0.0);
            border: 1px solid transparent;
            transition: background 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
            user-select: none;
        }
        .hover-word-box:hover, .hover-word-box.highlight {
            background: rgba(56, 189, 248, 0.28);
            border-color: #38bdf8;
            box-shadow: 0 0 8px rgba(56, 189, 248, 0.5);
        }

        /* Hover Pointer Tooltip */
        #hoverPointerTooltip {
            position: absolute;
            z-index: 50;
            pointer-events: none;
            background: rgba(15, 23, 42, 0.95);
            border: 1px solid #38bdf8;
            color: #38bdf8;
            padding: 0.35rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(0,0,0,0.5);
            display: none;
            transform: translate(-50%, -130%);
            white-space: nowrap;
            backdrop-filter: blur(8px);
        }

        /* Read Aloud Floating Transcript / Player bar */
        #speechControlsBar {
            position: absolute;
            bottom: 1.25rem;
            background: rgba(15, 23, 42, 0.96);
            border: 1px solid #38bdf8;
            border-radius: 1rem;
            padding: 0.85rem 1.25rem;
            max-width: 720px;
            width: 92%;
            max-height: 48vh;
            display: none;
            flex-direction: column;
            gap: 0.6rem;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.8), 0 0 20px rgba(56, 189, 248, 0.2);
            backdrop-filter: blur(14px);
            z-index: 45;
            animation: slideUp 0.25s ease-out;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Layout Adjustments */
        .viewer-header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
            min-width: 0;
            flex-shrink: 1;
        }
        .viewer-header-right {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-shrink: 0;
            overflow-x: auto;
            max-width: 100%;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
        .viewer-header-right::-webkit-scrollbar {
            display: none;
        }
        .course-title-text {
            font-weight: 800;
            font-size: 1rem;
            color: #ffffff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 320px;
        }

        /* Mobile Bottom Nav Bar */
        .mobile-nav-controls {
            display: none;
            position: absolute;
            bottom: 0.85rem;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(15, 23, 42, 0.94);
            border: 1px solid #334155;
            backdrop-filter: blur(12px);
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            z-index: 35;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.7);
        }
        .mobile-nav-btn {
            background: #1e293b;
            border: 1px solid #475569;
            color: #f1f5f9;
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .mobile-nav-btn:active {
            background: #2563eb;
            transform: scale(0.95);
        }
        .mobile-slide-counter {
            font-size: 0.82rem;
            font-weight: 700;
            color: #e2e8f0;
            white-space: nowrap;
        }

        /* Responsive Media Queries */
        @media (max-width: 1024px) {
            .course-title-text {
                max-width: 220px;
            }
        }

        @media (max-width: 768px) {
            .viewer-header {
                padding: 0.5rem 0.75rem;
                gap: 0.5rem;
            }
            .viewer-header-left {
                gap: 0.5rem;
            }
            .course-title-text {
                font-size: 0.88rem;
                max-width: 130px;
            }
            .badge-visual-slides {
                display: none !important;
            }
            .header-divider {
                display: none !important;
            }
            .header-back-label {
                display: none !important;
            }
            .header-back-btn {
                padding: 0.35rem;
                background: #1e293b;
                border-radius: 0.5rem;
                border: 1px solid #334155;
            }
            .btn-text {
                display: none !important;
            }
            .btn-hover-read, .btn-read-aloud {
                padding: 0.45rem;
                border-radius: 0.5rem;
                min-width: 2.25rem;
                height: 2.25rem;
                justify-content: center;
            }
            .slide-counter-badge {
                display: none !important; /* Shown in mobile nav bottom or compact */
            }
            .fullscreen-btn {
                display: none !important; /* Often buggy or redundant on mobile browsers */
            }

            /* Main presentation area */
            .slide-stage {
                padding: 0.5rem;
            }
            .slide-image-wrapper {
                max-height: calc(100vh - 145px);
            }
            .slide-img {
                max-height: calc(100vh - 145px);
                border-radius: 0.5rem;
            }
            .slide-caption-bar {
                display: none; /* Keep slide clean on mobile */
            }

            /* Floating side arrows: hide on mobile screens to prevent overlapping content/buttons */
            .nav-btn {
                display: none !important;
            }

            /* Zoom toolbar on mobile: position at top-right of the stage or compact floating so it never collides with bottom nav */
            .zoom-toolbar {
                top: 0.75rem;
                right: 0.75rem;
                bottom: auto;
                padding: 0.2rem 0.35rem;
                transform: scale(0.88);
                transform-origin: top right;
                background: rgba(15, 23, 42, 0.88);
            }

            /* Bottom Thumbnail Strip */
            .thumbnail-strip {
                padding: 0.4rem 0.75rem;
                gap: 0.5rem;
                max-height: 65px;
            }
            .thumb-item {
                width: 58px;
                height: 38px;
            }

            /* Mobile nav bottom bar: perfectly centered at bottom */
            .mobile-nav-controls {
                display: flex !important;
                bottom: 0.85rem;
                left: 50%;
                transform: translateX(-50%);
            }

            /* Speech bar on mobile */
            #speechControlsBar {
                bottom: 0.5rem;
                width: 96%;
                padding: 0.65rem 0.85rem;
                max-height: 55vh;
            }
        }

        @media (max-width: 480px) {
            .course-title-text {
                max-width: 110px;
            }
        }

        /* Blur screen if user attempts print or loses focus during screen recording */
        @media print {
            body * {
                visibility: hidden !important;
                display: none !important;
            }
            body::after {
                content: "Content Protected - Shree Mangalam Spoken English Classes";
                visibility: visible;
                display: block;
                font-size: 24pt;
                text-align: center;
                margin-top: 100px;
                color: #000;
            }
        }
    </style>
</head>
<body class="protected-content" oncontextmenu="return false;" ondragstart="return false;" onselectstart="return false;">

    <!-- Header Navigation Bar -->
    <header class="viewer-header">
        <div class="viewer-header-left">
            <a href="{{ route('student.dashboard') }}" class="header-back-btn" title="Back to My Courses" style="display: inline-flex; align-items: center; gap: 0.4rem; color: #94a3b8; text-decoration: none; font-size: 0.85rem; font-weight: 700;">
                <i data-lucide="arrow-left" style="width: 1.1rem; height: 1.1rem; flex-shrink: 0;"></i>
                <span class="header-back-label">My Courses</span>
            </a>
            <span class="header-divider" style="color: #334155;">|</span>
            <div style="display: flex; align-items: center; gap: 0.5rem; min-width: 0;">
                <span class="course-title-text" title="{{ $course->title }}">{{ $course->title }}</span>
                <span class="badge-visual-slides" style="background: #1e293b; color: #38bdf8; font-size: 0.75rem; font-weight: 700; padding: 0.15rem 0.5rem; border-radius: 9999px; white-space: nowrap; flex-shrink: 0;">
                    Visual Slides
                </span>
            </div>
        </div>

        <div class="viewer-header-right">
            <!-- Point & Read on Hover Button -->
            <button type="button" id="hoverReadToggleBtn" class="btn-hover-read" title="Point & Read: Tap/Hover over text to read aloud">
                <i data-lucide="mouse-pointer" style="width: 1rem; height: 1rem; flex-shrink: 0;"></i>
                <span id="hoverReadLabel" class="btn-text">Point &amp; Read</span>
            </button>

            <!-- Lesson Text Output Viewer Toggle -->
            <button type="button" id="lessonTextToggleBtn" class="btn-hover-read" title="View lesson sentence transcript" style="background: rgba(30, 41, 59, 0.85); border-color: #38bdf8; color: #38bdf8;">
                <i data-lucide="file-text" style="width: 1rem; height: 1rem; flex-shrink: 0;"></i>
                <span class="btn-text">Lesson Text</span>
            </button>

            <!-- Read All Aloud Button -->
            <button type="button" id="readAloudBtn" class="btn-read-aloud" title="Read all slide text aloud">
                <i data-lucide="volume-2" id="readAloudIcon" style="width: 1.1rem; height: 1.1rem; flex-shrink: 0;"></i>
                <span id="readAloudLabel" class="btn-text">Read All</span>
            </button>

            <!-- Slide Counter -->
            <div class="slide-counter-badge" style="background: #1e293b; border: 1px solid #334155; border-radius: 9999px; padding: 0.3rem 0.75rem; font-size: 0.82rem; font-weight: 700; white-space: nowrap; flex-shrink: 0;">
                Slide <span id="currentSlideNum" style="color: #38bdf8;">1</span> of <span id="totalSlides">{{ $course->images->count() }}</span>
            </div>

            <!-- Fullscreen Toggle -->
            <button type="button" id="fullscreenBtn" class="fullscreen-btn" style="background: #1e293b; border: 1px solid #334155; color: #cbd5e1; padding: 0.4rem 0.75rem; border-radius: 0.5rem; cursor: pointer; display: flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; font-weight: 600; flex-shrink: 0;">
                <i data-lucide="maximize-2" style="width: 1rem; height: 1rem;"></i>
                <span class="btn-text">Full Screen</span>
            </button>
        </div>
    </header>

    <!-- Slide Presentation Workspace -->
    <main class="viewer-main" id="viewerStage">
        @if($course->images->isEmpty())
            <div style="margin: auto; text-align: center; color: #64748b;">
                <i data-lucide="image-off" style="width: 3.5rem; height: 3.5rem; margin-bottom: 1rem;"></i>
                <h2>No slides uploaded for this course yet.</h2>
                <p>The instructor is currently preparing the visual lesson graphics.</p>
            </div>
        @else
            <!-- Nav Controls -->
            <button type="button" class="nav-btn nav-prev" id="prevBtn" aria-label="Previous Slide">
                <i data-lucide="chevron-left" style="width: 1.75rem; height: 1.75rem;"></i>
            </button>

            <button type="button" class="nav-btn nav-next" id="nextBtn" aria-label="Next Slide">
                <i data-lucide="chevron-right" style="width: 1.75rem; height: 1.75rem;"></i>
            </button>

            <!-- Slide View Area -->
            <div class="slide-stage" id="slideStage">
                <div class="slide-image-wrapper" id="slideImageWrapper">
                    <!-- Transparent click shield on top of image: prevents right-click, dragging, and inspect-to-save -->
                    <div class="image-shield" oncontextmenu="return false;"></div>

                    <!-- Interactive Hover Sentences Layer (Active when Point & Read is enabled) -->
                    <div class="hover-read-overlay" id="hoverReadOverlay" style="display: none;"></div>

                    <!-- Tooltip following mouse cursor -->
                    <div id="hoverPointerTooltip">🔊 Hover over text to listen</div>

                    <!-- Dynamic Watermark Pattern with User Identifier -->
                    <div class="watermark-overlay" id="watermarkOverlay">
                        @php
                            $studentIdentifier = Auth::check() ? (Auth::user()->name . ' • ' . (Auth::user()->phone ?? Auth::user()->email)) : 'Shree Mangalam Classes';
                        @endphp
                        @for($r = 0; $r < 7; $r++)
                            <div class="watermark-row">
                                <span>{{ $studentIdentifier }}</span>
                                <span>{{ $studentIdentifier }}</span>
                                <span>{{ $studentIdentifier }}</span>
                            </div>
                        @endfor
                    </div>

                    <img id="mainSlideImg"
                         src=""
                         onerror="this.onerror=null; this.src='{{ asset('images/placeholders/course-default.svg') }}';"
                         alt="Course Slide"
                         class="slide-img"
                         draggable="false"
                         oncontextmenu="return false;"
                         style="pointer-events: none; user-select: none;">
                </div>
                <div class="slide-caption-bar" id="slideCaption"></div>

                <!-- Mobile Slide Quick Navigation Bar -->
                <div class="mobile-nav-controls" id="mobileNavControls">
                    <button type="button" class="mobile-nav-btn" id="mobilePrevBtn" aria-label="Previous Slide">
                        <i data-lucide="chevron-left" style="width: 1.1rem; height: 1.1rem;"></i>
                    </button>
                    <span class="mobile-slide-counter">
                        <span id="mobileCurrentSlideNum" style="color: #38bdf8;">1</span> / {{ $course->images->count() }}
                    </span>
                    <button type="button" class="mobile-nav-btn" id="mobileNextBtn" aria-label="Next Slide">
                        <i data-lucide="chevron-right" style="width: 1.1rem; height: 1.1rem;"></i>
                    </button>
                </div>

                <!-- Zoom Controls Toolbar -->
                <div class="zoom-toolbar" id="zoomToolbar">
                    <button type="button" class="zoom-btn" id="zoomOutBtn" title="Zoom Out (-)">
                        <i data-lucide="minus" style="width: 0.95rem; height: 0.95rem;"></i>
                    </button>
                    <span class="zoom-level-badge" id="zoomLevelBadge">100%</span>
                    <button type="button" class="zoom-btn" id="zoomInBtn" title="Zoom In (+)">
                        <i data-lucide="plus" style="width: 0.95rem; height: 0.95rem;"></i>
                    </button>
                    <button type="button" class="zoom-btn" id="zoomResetBtn" title="Reset Zoom">
                        <i data-lucide="rotate-ccw" style="width: 0.85rem; height: 0.85rem;"></i>
                    </button>
                </div>

                <!-- Floating Speech & OCR Controller Bar -->
                <div id="speechControlsBar">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="display: inline-block; width: 8px; height: 8px; background: #38bdf8; border-radius: 50%; box-shadow: 0 0 8px #38bdf8;"></span>
                            <span id="speechStatusTitle" style="font-size: 0.85rem; font-weight: 700; color: #f8fafc;">Reading Image Text...</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <!-- Stop Button -->
                            <button type="button" id="stopSpeechBtn" style="background: rgba(244, 63, 94, 0.2); border: 1px solid rgba(244, 63, 94, 0.4); color: #fb7185; padding: 0.25rem 0.6rem; border-radius: 0.35rem; font-size: 0.75rem; font-weight: 700; cursor: pointer;">
                                Stop
                            </button>
                            <!-- Close panel button -->
                            <button type="button" onclick="closeSpeechPanel()" style="background: transparent; border: none; color: #94a3b8; font-size: 1rem; cursor: pointer; padding: 0 0.25rem;">
                                &times;
                            </button>
                        </div>
                    </div>
                    <!-- Live recognized sentence text -->
                    <div id="speechTextDisplay" style="font-size: 0.82rem; color: #cbd5e1; max-height: 260px; overflow-y: auto; line-height: 1.5; background: rgba(0,0,0,0.4); padding: 0.75rem; border-radius: 0.5rem; border: 1px solid #1e293b;">
                        Scanning lesson image text...
                    </div>
                </div>
            </div>
        @endif
    </main>

    <!-- Thumbnail Strip -->
    @if($course->images->isNotEmpty())
        <footer class="thumbnail-strip" id="thumbStrip">
            @foreach($course->images as $index => $img)
                <div class="thumb-item {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}" data-src="{{ asset('storage/' . $img->image_path) }}" data-caption="{{ $img->caption ?? ('Slide ' . ($index + 1)) }}">
                    <img src="{{ asset('storage/' . $img->image_path) }}" onerror="this.onerror=null; this.src='{{ asset('images/placeholders/course-default.svg') }}';" alt="Thumbnail" class="thumb-img" draggable="false">
                </div>
            @endforeach
        </footer>
    @endif

    <!-- Screenshot Interception Warning Banner -->
    <div id="screenshotWarning">
        <div style="background: #1e293b; border: 2px solid #f43f5e; border-radius: 1rem; padding: 2rem 2.5rem; max-width: 460px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.7);">
            <div style="font-size: 3rem; margin-bottom: 0.75rem;">🔒</div>
            <h3 style="font-size: 1.25rem; font-weight: 800; color: #ffffff; margin: 0 0 0.5rem 0;">Screenshots Are Not Allowed</h3>
            <p style="font-size: 0.88rem; color: #94a3b8; line-height: 1.5; margin: 0 0 1.5rem 0;">
                All lesson material is copyrighted to <strong>Shree Mangalam Spoken English Classes</strong>. Screenshots and screen recordings are strictly prohibited.
            </p>
            <button type="button" onclick="dismissWarning()" style="background: #f43f5e; color: #ffffff; border: none; font-weight: 700; padding: 0.6rem 1.5rem; border-radius: 0.5rem; cursor: pointer;">
                I Understand
            </button>
        </div>
    </div>

    <script>
        function triggerScreenshotBlock() {
            const warning = document.getElementById('screenshotWarning');
            const mainImg = document.getElementById('mainSlideImg');
            if (mainImg) mainImg.style.filter = 'blur(20px)';
            if (warning) warning.style.display = 'flex';

            // Blank out clipboard
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText('Screenshots and copying course content is not permitted. - Shree Mangalam Classes').catch(() => {});
            }
        }

        function dismissWarning() {
            const warning = document.getElementById('screenshotWarning');
            const mainImg = document.getElementById('mainSlideImg');
            if (warning) warning.style.display = 'none';
            if (mainImg) mainImg.style.filter = 'none';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const thumbs = Array.from(document.querySelectorAll('.thumb-item'));
            if (thumbs.length === 0) return;

            let currentIndex = 0;
            const mainImg = document.getElementById('mainSlideImg');
            const captionBar = document.getElementById('slideCaption');
            const currentSlideNum = document.getElementById('currentSlideNum');
            const mobileCurrentSlideNum = document.getElementById('mobileCurrentSlideNum');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const mobilePrevBtn = document.getElementById('mobilePrevBtn');
            const mobileNextBtn = document.getElementById('mobileNextBtn');

            function showSlide(index) {
                if (index < 0) index = 0;
                if (index >= thumbs.length) index = thumbs.length - 1;

                currentIndex = index;
                const activeThumb = thumbs[currentIndex];

                // Update Image & Caption with subtle animation
                mainImg.style.opacity = '0.4';
                setTimeout(() => {
                    mainImg.src = activeThumb.getAttribute('data-src');
                    captionBar.textContent = activeThumb.getAttribute('data-caption') || `Slide ${currentIndex + 1}`;
                    if (currentSlideNum) currentSlideNum.textContent = currentIndex + 1;
                    if (mobileCurrentSlideNum) mobileCurrentSlideNum.textContent = currentIndex + 1;
                    mainImg.style.opacity = '1';
                }, 100);

                // Update Thumbs Active
                thumbs.forEach(t => t.classList.remove('active'));
                activeThumb.classList.add('active');
                activeThumb.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
            }

            // Init first slide
            showSlide(0);

            // Controls
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    if (currentIndex > 0) showSlide(currentIndex - 1);
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    if (currentIndex < thumbs.length - 1) showSlide(currentIndex + 1);
                });
            }

            if (mobilePrevBtn) {
                mobilePrevBtn.addEventListener('click', () => {
                    if (currentIndex > 0) showSlide(currentIndex - 1);
                });
            }

            if (mobileNextBtn) {
                mobileNextBtn.addEventListener('click', () => {
                    if (currentIndex < thumbs.length - 1) showSlide(currentIndex + 1);
                });
            }

            // Touch swipe support for mobile/tablet screens
            let touchStartX = 0;
            let touchEndX = 0;
            let touchStartY = 0;
            let touchEndY = 0;
            const slideStageEl = document.getElementById('slideStage');

            if (slideStageEl) {
                slideStageEl.addEventListener('touchstart', (e) => {
                    touchStartX = e.changedTouches[0].screenX;
                    touchStartY = e.changedTouches[0].screenY;
                }, { passive: true });

                slideStageEl.addEventListener('touchend', (e) => {
                    touchEndX = e.changedTouches[0].screenX;
                    touchEndY = e.changedTouches[0].screenY;
                    handleSwipeGesture();
                }, { passive: true });
            }

            function handleSwipeGesture() {
                const diffX = touchEndX - touchStartX;
                const diffY = touchEndY - touchStartY;
                // Only trigger if horizontal swipe is prominent (> 45px and more horizontal than vertical)
                if (Math.abs(diffX) > 45 && Math.abs(diffX) > Math.abs(diffY)) {
                    if (diffX < 0) {
                        // Swiped Left -> Next Slide
                        if (currentIndex < thumbs.length - 1) showSlide(currentIndex + 1);
                    } else {
                        // Swiped Right -> Previous Slide
                        if (currentIndex > 0) showSlide(currentIndex - 1);
                    }
                }
            }

            thumbs.forEach((thumb, idx) => {
                thumb.addEventListener('click', () => showSlide(idx));
            });

            if (window.renderLucideIcons) {
                window.renderLucideIcons();
            } else if (window.lucide && window.lucide.createIcons) {
                window.lucide.createIcons();
            }

            // Keyboard navigation & anti-screenshot / devtools interception
            document.addEventListener('keydown', (e) => {
                // Navigation
                if (e.key === 'ArrowLeft') {
                    if (currentIndex > 0) showSlide(currentIndex - 1);
                } else if (e.key === 'ArrowRight' || e.key === ' ') {
                    if (currentIndex < thumbs.length - 1) showSlide(currentIndex + 1);
                }

                // Prevent PrintScreen key
                if (e.key === 'PrintScreen' || e.keyCode === 44) {
                    e.preventDefault();
                    triggerScreenshotBlock();
                }

                // Prevent Ctrl+P (Print)
                if ((e.ctrlKey || e.metaKey) && (e.key === 'p' || e.key === 'P')) {
                    e.preventDefault();
                    triggerScreenshotBlock();
                }

                // Prevent Ctrl+S (Save Page / Save Image)
                if ((e.ctrlKey || e.metaKey) && (e.key === 's' || e.key === 'S')) {
                    e.preventDefault();
                }

                // Prevent Ctrl+Shift+I / F12 (Inspect DevTools)
                if (e.key === 'F12' || ((e.ctrlKey || e.metaKey) && e.shiftKey && (e.key === 'I' || e.key === 'i' || e.key === 'C' || e.key === 'c' || e.key === 'J' || e.key === 'j'))) {
                    e.preventDefault();
                }

                // Prevent Windows + Shift + S snippet tool activation detection on blur
            });

            // Detect when user triggers screen snip tool or switches away
            window.addEventListener('keyup', (e) => {
                if (e.key === 'PrintScreen' || e.keyCode === 44) {
                    triggerScreenshotBlock();
                }
            });

            // Blur image when window loses focus (e.g. Snipping Tool overlay, Alt-Tab)
            window.addEventListener('blur', () => {
                if (mainImg) {
                    mainImg.style.filter = 'blur(16px)';
                }
            });

            window.addEventListener('focus', () => {
                const warning = document.getElementById('screenshotWarning');
                if (mainImg && (!warning || warning.style.display !== 'flex')) {
                    mainImg.style.filter = 'none';
                }
            });

            // Prevent Right-Click everywhere in the viewer
            document.addEventListener('contextmenu', (e) => {
                e.preventDefault();
                return false;
            });

            // Prevent drag
            document.addEventListener('dragstart', (e) => {
                e.preventDefault();
                return false;
            });

            // Fullscreen toggle
            const fullscreenBtn = document.getElementById('fullscreenBtn');
            fullscreenBtn.addEventListener('click', () => {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen().catch(err => alert(err.message));
                } else {
                    document.exitFullscreen();
                }
            });

            // ==========================================
            // IMAGE OCR & READ ALOUD (TEXT-TO-SPEECH)
            // Enhanced with Authentic Gujarati Recognition & Native Voice Engine
            // ==========================================
            const readAloudBtn = document.getElementById('readAloudBtn');
            const readAloudIcon = document.getElementById('readAloudIcon');
            const readAloudLabel = document.getElementById('readAloudLabel');
            const speechControlsBar = document.getElementById('speechControlsBar');
            const speechStatusTitle = document.getElementById('speechStatusTitle');
            const speechTextDisplay = document.getElementById('speechTextDisplay');
            const stopSpeechBtn = document.getElementById('stopSpeechBtn');

            // Text cache to avoid redundant OCR scans per slide
            const slideTextCache = {};
            let isReading = false;
            let currentUtterance = null;
            let activeAudioObj = null;

            window.closeSpeechPanel = function() {
                stopSpeech();
                if (speechControlsBar) speechControlsBar.style.display = 'none';
            };

            function stopSpeech() {
                if (window.speechSynthesis) {
                    window.speechSynthesis.cancel();
                }
                if (activeAudioObj) {
                    try {
                        activeAudioObj.pause();
                        activeAudioObj.currentTime = 0;
                    } catch (e) {}
                    activeAudioObj = null;
                }
                isReading = false;
                if (readAloudBtn) {
                    readAloudBtn.classList.remove('speaking');
                    readAloudLabel.textContent = 'Read All';
                    readAloudIcon.setAttribute('data-lucide', 'volume-2');
                    if (window.lucide) window.lucide.createIcons();
                }
            }

            if (stopSpeechBtn) {
                stopSpeechBtn.addEventListener('click', () => {
                    stopSpeech();
                    if (speechStatusTitle) speechStatusTitle.textContent = 'Speech Stopped';
                });
            }

            // Check if a segment has Gujarati characters (\u0A80-\u0AFF)
            function containsGujarati(str) {
                return /[\u0A80-\u0AFF]/.test(str);
            }

            // Convert Gujarati script to Devanagari (Hindi) for high-accuracy regional TTS fallback
            function gujaratiToDevanagari(text) {
                let out = '';
                for (let i = 0; i < text.length; i++) {
                    const code = text.charCodeAt(i);
                    // Standard Gujarati unicode block maps directly to Devanagari by subtracting 0x0180
                    if (code >= 0x0A81 && code <= 0x0AF1) {
                        out += String.fromCharCode(code - 0x0180);
                    } else {
                        out += text[i];
                    }
                }
                return out;
            }

            // Universal high-fidelity Speech Function:
            // 1. Natural Gujarati Voice via native audio
            // 2. Web Speech Synthesis (gu-IN voice)
            // 3. Devanagari Hindi Engine (hi-IN voice) for flawless Gujarati pronunciation on Windows
            // 4. Indian English (en-IN) voice for English segments
            function speakPhrase(text, lang, onEndCallback) {
                if (!text || !text.trim()) {
                    if (onEndCallback) onEndCallback();
                    return;
                }

                const cleanText = text.trim();
                const isGuj = lang === 'gu' || containsGujarati(cleanText);

                if (isGuj) {
                    // Try Tier 1: Real native Gujarati audio stream
                    const encoded = encodeURIComponent(cleanText.substring(0, 190));
                    const audioUrl = `https://translate.google.com/translate_tts?ie=UTF-8&tl=gu&client=tw-ob&q=${encoded}`;
                    const audio = new Audio(audioUrl);
                    activeAudioObj = audio;

                    let fallbackTriggered = false;
                    const triggerFallback = () => {
                        if (fallbackTriggered) return;
                        fallbackTriggered = true;
                        speakGujaratiViaWebSpeech(cleanText, onEndCallback);
                    };

                    const playPromise = audio.play();
                    if (playPromise !== undefined) {
                        playPromise.then(() => {
                            audio.onended = () => {
                                activeAudioObj = null;
                                if (onEndCallback) setTimeout(onEndCallback, 180);
                            };
                            audio.onerror = triggerFallback;
                        }).catch(() => {
                            triggerFallback();
                        });
                    } else {
                        triggerFallback();
                    }
                } else {
                    // English Speech
                    speakEnglishViaWebSpeech(cleanText, onEndCallback);
                }
            }

            // Web Speech Gujarati Voice with Devanagari Fallback
            function speakGujaratiViaWebSpeech(text, onEndCallback) {
                if (!('speechSynthesis' in window)) {
                    if (onEndCallback) onEndCallback();
                    return;
                }

                window.speechSynthesis.cancel();
                const voices = window.speechSynthesis.getVoices();

                // 1. Look for native Gujarati voice
                const gujVoice = voices.find(v => v.lang.toLowerCase().startsWith('gu'));

                // 2. Look for Indian Hindi voice (reads Devanagari with authentic Indian phonetics)
                const hindiVoice = voices.find(v => v.lang.toLowerCase().startsWith('hi'));

                // 3. Indian English voice
                const indianEngVoice = voices.find(v => v.lang === 'en-IN') || voices.find(v => v.lang.startsWith('en'));

                let textToSpeak = text;
                let selectedVoice = gujVoice;
                let targetLang = 'gu-IN';

                if (gujVoice) {
                    selectedVoice = gujVoice;
                    targetLang = 'gu-IN';
                } else if (hindiVoice) {
                    // Transliterate to Devanagari so Hindi engine pronounces Gujarati words with 100% natural accent
                    textToSpeak = gujaratiToDevanagari(text);
                    selectedVoice = hindiVoice;
                    targetLang = 'hi-IN';
                } else {
                    selectedVoice = indianEngVoice;
                    targetLang = 'en-IN';
                }

                const utterance = new SpeechSynthesisUtterance(textToSpeak);
                utterance.lang = targetLang;
                if (selectedVoice) utterance.voice = selectedVoice;
                utterance.rate = 0.88;
                utterance.pitch = 1.0;
                utterance.volume = 1.0;

                utterance.onend = () => {
                    currentUtterance = null;
                    if (onEndCallback) setTimeout(onEndCallback, 180);
                };

                utterance.onerror = () => {
                    currentUtterance = null;
                    if (onEndCallback) onEndCallback();
                };

                currentUtterance = utterance;
                window.speechSynthesis.speak(utterance);
            }

            // Web Speech English Voice
            function speakEnglishViaWebSpeech(text, onEndCallback) {
                if (!('speechSynthesis' in window)) {
                    if (onEndCallback) onEndCallback();
                    return;
                }

                window.speechSynthesis.cancel();
                const voices = window.speechSynthesis.getVoices();

                const englishVoice = voices.find(v => v.lang === 'en-IN') ||
                                     voices.find(v => v.lang.startsWith('en-GB')) ||
                                     voices.find(v => v.lang.startsWith('en-US')) ||
                                     voices.find(v => v.lang.startsWith('en'));

                const utterance = new SpeechSynthesisUtterance(text);
                utterance.lang = 'en-IN';
                if (englishVoice) utterance.voice = englishVoice;
                utterance.rate = 0.88;
                utterance.pitch = 1.0;
                utterance.volume = 1.0;

                utterance.onend = () => {
                    currentUtterance = null;
                    if (onEndCallback) setTimeout(onEndCallback, 180);
                };

                utterance.onerror = () => {
                    currentUtterance = null;
                    if (onEndCallback) onEndCallback();
                };

                currentUtterance = utterance;
                window.speechSynthesis.speak(utterance);
            }

            // Interactive function for clicking a single sentence in Lesson Text
            window.speakOneSentence = function(text, lang) {
                stopSpeech();
                if (speechStatusTitle) {
                    speechStatusTitle.textContent = (lang === 'gu' || containsGujarati(text)) ? 'Speaking Gujarati...' : 'Speaking English...';
                }
                speakPhrase(text, lang, () => {
                    if (speechStatusTitle) speechStatusTitle.textContent = 'Ready';
                });
            };

            // =========================================================
            // VERIFIED SLIDE LESSON TRANSCRIPTS & WORD MANIFESTS
            // Complete Gujarati & English Data for All Slides
            // =========================================================
            const verifiedSlideManifests = [
                // Manifest 1: Notebook Layout (Slide 1 & Slide 4: FTrhAuHj, SKoTfgvt)
                {
                    matchKeywords: ['ftrhauh', 'skotfgvt', 'slide_0', 'slide_3'],
                    title: 'To be going to (ભવિષ્યમાં કરવાની યોજના / ઇરાદો - Notebook Chart)',
                    segments: [
                        { lang: 'en', text: 'To be going to' },
                        { lang: 'gu', text: 'ભવિષ્યમાં કરવાની યોજના અથવા ઇરાદો' },
                        { lang: 'en', text: 'Plan. Intention. Future Action.' },
                        { lang: 'gu', text: 'To be going to એટલે શું? ટુ બી ગોઈંગ ટુ નો ઉપયોગ ભવિષ્યમાં કોઈ કામ કરવાની યોજના (Plan), ઇરાદો (Intention) અથવા જે થવાની શક્યતા દેખાય તે માટે થાય છે.' },
                        { lang: 'gu', text: 'આ પહેલેથી નક્કી કરેલી અથવા વિચારેલી યોજનાને દર્શાવે છે.' },
                        { lang: 'gu', text: 'ક્યારે ઉપયોગ કરવો? ભવિષ્યમાં કરવાની પૂર્વયોજના જણાવવા, કોઈ કામ કરવાનો ઇરાદો બતાવવા, અને વ્યક્તિગત નિર્ણયો દર્શાવવા.' },
                        { lang: 'en', text: 'Structure of Affirmative: Subject plus am, is, are, plus going to, plus verb one.' },
                        { lang: 'en', text: 'Example: I am going to study.' },
                        { lang: 'gu', text: 'હું અભ્યાસ કરવા જઈ રહ્યો છું.' },
                        { lang: 'en', text: 'Structure of Negative: Subject plus am, is, are not, plus going to, plus verb one.' },
                        { lang: 'en', text: 'Example: I am not going to study.' },
                        { lang: 'gu', text: 'હું અભ્યાસ કરવાનો નથી.' },
                        { lang: 'en', text: 'Structure of Interrogative: Am, Is, Are, plus subject, plus going to, plus verb one?' },
                        { lang: 'en', text: 'Example: Are you going to study?' },
                        { lang: 'gu', text: 'શું તમે અભ્યાસ કરવાના છો?' },
                        { lang: 'en', text: 'Structure of Wh Question: Wh word, plus am, is, are, plus subject, plus going to, plus verb one?' },
                        { lang: 'en', text: 'Example: What are you going to do?' },
                        { lang: 'gu', text: 'તમે શું કરવાના છો?' },
                        { lang: 'en', text: 'Examples:' },
                        { lang: 'en', text: '1. I am going to visit my grandparents.' },
                        { lang: 'gu', text: 'હું મારા દાદા-દાદીને મળવા જવાની છું.' },
                        { lang: 'en', text: '2. She is going to join a new class.' },
                        { lang: 'gu', text: 'તે નવી ક્લાસમાં જોડાવાની છે.' },
                        { lang: 'en', text: '3. We are going to watch a movie.' },
                        { lang: 'gu', text: 'અમે મૂવી જોવા જવાના છીએ.' },
                        { lang: 'en', text: '4. He is not going to come tomorrow.' },
                        { lang: 'gu', text: 'તે કાલે આવવાનો નથી.' },
                        { lang: 'en', text: '5. They are not going to buy a car.' },
                        { lang: 'gu', text: 'તેઓ કાર ખરીદવાના નથી.' },
                        { lang: 'en', text: '6. Are you going to attend the meeting?' },
                        { lang: 'gu', text: 'શું તમે મીટિંગમાં હાજરી આપવાના છો?' },
                        { lang: 'en', text: '7. What is she going to do?' },
                        { lang: 'gu', text: 'તે શું કરવાની છે?' },
                        { lang: 'en', text: '8. Where are you going to go this weekend?' },
                        { lang: 'gu', text: 'આ વીકએન્ડે તમે ક્યાં જવાના છો?' },
                        { lang: 'en', text: 'Short Forms: I am going to. You are going to. He is going to. She is going to. It is going to. We are going to. They are going to.' },
                        { lang: 'en', text: 'Keywords: tomorrow, next week, next month, this weekend, soon, later, in the future.' },
                        { lang: 'gu', text: 'સૂચક શબ્દો: કાલે, આગામી અઠવાડિયે, આગામી મહિને, આ વીકએન્ડે, ટૂંક સમયમાં, પછીથી, ભવિષ્યમાં.' },
                        { lang: 'en', text: 'Shree Mangalam Spoken English Classes, Porbandar.' }
                    ],
                    words: [
                        { text: 'To be going to', left: 23, top: 2.2, width: 55, height: 4.8 },
                        { text: 'ભવિષ્યમાં કરવાની યોજના / ઇરાદો', left: 25, top: 8.5, width: 50, height: 2.8 },
                        { text: 'Plan • Intention • Future Action', left: 26, top: 11.5, width: 48, height: 2.5 },

                        // Definition (left top)
                        { text: 'To be going to એટલે શું?', left: 4, top: 16.5, width: 48, height: 3.2 },
                        { text: 'To be going to નો ઉપયોગ ભવિષ્યમાં કોઈ કામ કરવાની યોજના અથવા ઇરાદો દર્શાવવા થાય છે', left: 4, top: 20.0, width: 48, height: 6.0 },
                        { text: 'આ પહેલેથી નક્કી કરેલી યોજના દર્શાવે છે', left: 4, top: 26.5, width: 48, height: 3.5 },

                        // When to use (right top)
                        { text: 'ક્યારે ઉપયોગ કરવો?', left: 56, top: 16.5, width: 40, height: 3.2 },
                        { text: 'ભવિષ્યમાં કરવાની પૂર્વયોજના જણાવવા', left: 56, top: 20.5, width: 40, height: 2.5 },
                        { text: 'કોઈ કામ કરવાનો ઇરાદો બતાવવા', left: 56, top: 23.0, width: 40, height: 2.5 },
                        { text: 'જેનાં લક્ષણો જોઈને લાગે કે કંઈક થવાનું છે (near future prediction)', left: 56, top: 25.5, width: 40, height: 2.8 },
                        { text: 'વિચારીને લેવાયેલો નિર્ણય દર્શાવવા', left: 56, top: 28.5, width: 40, height: 2.5 },
                        { text: 'Personal plans, decisions અને intentions બતાવવા', left: 56, top: 31.0, width: 40, height: 2.5 },

                        // Structure (left notebook)
                        { text: 'Structure (વાક્ય રચના)', left: 16, top: 31.8, width: 22, height: 3.2 },
                        { text: 'Affirmative (હકારાત્મક): Subject + am/is/are + going to + V1', left: 9, top: 36.5, width: 42, height: 2.2 },
                        { text: 'I am going to study (હું અભ્યાસ કરવા જઈ રહ્યો છું)', left: 18, top: 38.5, width: 32, height: 2.2 },

                        { text: 'Negative (નકારાત્મક): Subject + am/is/are not + going to + V1', left: 9, top: 40.8, width: 42, height: 2.2 },
                        { text: 'I am not going to study (હું અભ્યાસ કરવાનો નથી)', left: 18, top: 42.6, width: 32, height: 2.2 },

                        { text: 'Interrogative (પ્રશ્નાર્થક): Am/Is/Are + subject + going to + V1 ?', left: 9, top: 44.8, width: 42, height: 2.2 },
                        { text: 'Are you going to study? (શું તમે અભ્યાસ કરવાના છો?)', left: 18, top: 46.8, width: 32, height: 2.2 },

                        { text: 'Wh-Question: Wh + am/is/are + subject + going to + V1 ?', left: 9, top: 49.0, width: 42, height: 2.2 },
                        { text: 'What are you going to do? (તમે શું કરવાના છો?)', left: 18, top: 51.0, width: 32, height: 2.2 },

                        // Forms (left bottom)
                        { text: 'Forms (રૂપ)', left: 19, top: 55.5, width: 15, height: 3.0 },
                        { text: 'Short Forms (ટૂંકા રૂપ)', left: 11, top: 59.5, width: 34, height: 3.2 },
                        { text: "I'm going to = I am going to", left: 11, top: 64.0, width: 34, height: 2.2 },
                        { text: "You're going to = You are going to", left: 11, top: 66.2, width: 34, height: 2.2 },
                        { text: "He's going to = He is going to", left: 11, top: 68.4, width: 34, height: 2.2 },
                        { text: "She's going to = She is going to", left: 11, top: 70.6, width: 34, height: 2.2 },
                        { text: "It's going to = It is going to", left: 11, top: 72.8, width: 34, height: 2.2 },
                        { text: "We're going to = We are going to", left: 11, top: 75.0, width: 34, height: 2.2 },
                        { text: "They're going to = They are going to", left: 11, top: 77.2, width: 34, height: 2.2 },

                        // Examples (right side)
                        { text: 'Examples (ઉદાહરણો)', left: 63, top: 35.5, width: 30, height: 3.2 },

                        { text: '1. I am going to visit my grandparents', left: 56, top: 39.0, width: 40, height: 2.0 },
                        { text: 'હું મારા દાદા-દાદીને મળવા જવાની છું', left: 62, top: 40.8, width: 34, height: 2.0 },

                        { text: '2. She is going to join a new class', left: 56, top: 42.5, width: 40, height: 2.0 },
                        { text: 'તે નવી ક્લાસમાં જોડાવાની છે', left: 62, top: 44.2, width: 34, height: 2.0 },

                        { text: '3. We are going to watch a movie', left: 56, top: 45.8, width: 40, height: 2.0 },
                        { text: 'અમે મૂવી જોવા જવાના છીએ', left: 62, top: 47.4, width: 34, height: 2.0 },

                        { text: '4. He is not going to come tomorrow', left: 56, top: 49.0, width: 40, height: 2.0 },
                        { text: 'તે કાલે આવવાનો નથી', left: 62, top: 50.6, width: 34, height: 2.0 },

                        { text: '5. They are not going to buy a car', left: 56, top: 52.2, width: 40, height: 2.0 },
                        { text: 'તેઓ કાર ખરીદવાના નથી', left: 62, top: 53.8, width: 34, height: 2.0 },

                        { text: '6. Are you going to attend the meeting?', left: 56, top: 55.4, width: 40, height: 2.0 },
                        { text: 'શું તમે મીટિંગમાં હાજરી આપવાના છો?', left: 62, top: 57.0, width: 34, height: 2.0 },

                        { text: '7. What is she going to do?', left: 56, top: 58.8, width: 40, height: 2.0 },
                        { text: 'તે શું કરવાની છે?', left: 62, top: 60.4, width: 34, height: 2.0 },

                        { text: '8. Where are you going to go this weekend?', left: 56, top: 62.2, width: 40, height: 2.0 },
                        { text: 'આ વીકએન્ડે તમે ક્યાં જવાના છો?', left: 62, top: 63.8, width: 34, height: 2.0 },

                        // Keywords (right bottom)
                        { text: 'Keywords (સૂચક શબ્દો)', left: 66, top: 66.8, width: 24, height: 3.0 },
                        { text: 'tomorrow (કાલે / આવતીકાલે)', left: 62, top: 70.0, width: 32, height: 2.2 },
                        { text: 'next week (આગામી અઠવાડિયે)', left: 62, top: 72.2, width: 32, height: 2.2 },
                        { text: 'next month (આગામી મહિને)', left: 62, top: 74.4, width: 32, height: 2.2 },
                        { text: 'this weekend (આ વીકએન્ડે)', left: 62, top: 76.6, width: 32, height: 2.2 },
                        { text: 'soon (ટૂંક સમયમાં)', left: 62, top: 78.8, width: 32, height: 2.2 },
                        { text: 'later (પછીથી)', left: 62, top: 81.0, width: 32, height: 2.2 },
                        { text: 'in the future (ભવિષ્યમાં)', left: 62, top: 83.2, width: 32, height: 2.2 },

                        // Footer
                        { text: 'Shree Mangalam Spoken English Classes', left: 24, top: 86.5, width: 52, height: 3.5 },
                        { text: 'Vijay Joshi • Mo. 9033965711', left: 27, top: 93.0, width: 46, height: 2.6 }
                    ]
                },

                // Manifest 2: Comic Dialogues (Slide 2: 3DxhAWxl)
                {
                    matchKeywords: ['3dxhawxl', 'slide_1', 'dialogue', 'comic'],
                    title: 'To be going to (કોમિક સંવાદો - Interactive Dialogues)',
                    segments: [
                        { lang: 'en', text: 'To be going to' },
                        { lang: 'gu', text: 'ભવિષ્યમાં કરવાની યોજના અથવા ઇરાદો' },
                        { lang: 'en', text: '1. Plan and Intention: I am planning for the future.' },
                        { lang: 'gu', text: '૧. યોજના અને ઇરાદો: હું ભવિષ્ય માટે યોજના બનાવી રહ્યો છું.' },
                        { lang: 'en', text: '2. I am going to meet my friend.' },
                        { lang: 'gu', text: '૨. હું મારા મિત્રને મળવા જઈ રહ્યો છું.' },
                        { lang: 'en', text: 'I am going to visit my grandparents.' },
                        { lang: 'gu', text: 'હું મારા દાદા દાદીને મળવા જઈ રહ્યો છું.' },
                        { lang: 'en', text: 'She is going to learn a new language.' },
                        { lang: 'gu', text: 'તેણી નવી ભાષા શીખવા જઈ રહી છે.' },
                        { lang: 'en', text: '3. Are you going to attend the meeting?' },
                        { lang: 'gu', text: '૩. શું તમે મીટિંગમાં હાજરી આપવાના છો?' },
                        { lang: 'en', text: '4. Are we going tomorrow?' },
                        { lang: 'gu', text: '૪. શું આપણે આવતીકાલે જવાના છીએ?' },
                        { lang: 'en', text: 'She is going to come.' },
                        { lang: 'gu', text: 'તેણી આવવાની છે.' },
                        { lang: 'en', text: 'Where are you going this weekend?' },
                        { lang: 'gu', text: 'આ સપ્તાહના અંતે તમે ક્યાં જવાના છો?' },
                        { lang: 'en', text: 'Future arrangement: Planning ahead for success.' },
                        { lang: 'gu', text: 'ભવિષ્યની વ્યવસ્થા: સફળતા માટે પહેલેથી તૈયારી.' },
                        { lang: 'en', text: 'Shree Mangalam Spoken English Classes, Vijay Joshi, Porbandar.' }
                    ],
                    words: [
                        { text: 'To be going to', left: 15, top: 4.0, width: 70, height: 4.5 },
                        { text: 'ભવિષ્યમાં કરવાની યોજના / ઇરાદો', left: 15, top: 9.5, width: 70, height: 3.0 },
                        { text: 'I am going to meet my friend', left: 58, top: 15.5, width: 35, height: 3.5 },
                        { text: 'Structure', left: 64, top: 23.5, width: 20, height: 3.0 },
                        { text: 'I am going to visit my grandparents', left: 14, top: 37.0, width: 36, height: 3.5 },
                        { text: 'She is going to learn a new language', left: 61, top: 37.0, width: 34, height: 3.5 },
                        { text: 'Are you going to attend the meeting?', left: 10, top: 56.5, width: 38, height: 3.5 },
                        { text: 'Where is he going?', left: 18, top: 64.5, width: 25, height: 3.0 },
                        { text: 'Are we going tomorrow?', left: 63, top: 56.5, width: 32, height: 3.5 },
                        { text: 'Where are you going this weekend?', left: 63, top: 69.0, width: 34, height: 3.5 },
                        { text: 'Future arrangement', left: 66, top: 74.0, width: 28, height: 3.0 },
                        { text: 'Shree Mangalam Spoken English Classes', left: 24, top: 82.0, width: 55, height: 3.5 },
                        { text: 'Vijay Joshi • Mo. 9033965711', left: 34, top: 92.0, width: 35, height: 2.8 }
                    ]
                },

                // Manifest 3: Structure Table (Slide 3: OsdhVVba)
                {
                    matchKeywords: ['osdhvvba', 'slide_2', 'table', 'structure'],
                    title: 'To be going to (નિયમો અને વાક્ય રચના ટેબલ)',
                    segments: [
                        { lang: 'en', text: 'To be going to' },
                        { lang: 'gu', text: 'ભવિષ્યમાં કરવાની યોજના અથવા ઇરાદો' },
                        { lang: 'en', text: 'Affirmative: Subject plus am, is, are, plus going to, plus verb one.' },
                        { lang: 'en', text: 'Example: I am going to study.' },
                        { lang: 'gu', text: 'હું અભ્યાસ કરવા જઈ રહ્યો છું.' },
                        { lang: 'en', text: 'Negative: Subject plus am, is, are not, plus going to, plus verb one.' },
                        { lang: 'en', text: 'Example: I am not going to study.' },
                        { lang: 'gu', text: 'હું અભ્યાસ કરવાનો નથી.' },
                        { lang: 'en', text: 'Interrogative: Am, Is, Are, plus subject, plus going to, plus verb one?' },
                        { lang: 'en', text: 'Example: Are you going to study?' },
                        { lang: 'gu', text: 'શું તમે અભ્યાસ કરવાના છો?' },
                        { lang: 'en', text: 'Wh-Question: Wh word plus am, is, are, plus subject, plus going to, plus verb one?' },
                        { lang: 'en', text: 'Example: What are you going to do?' },
                        { lang: 'gu', text: 'તમે શું કરવાના છો?' },
                        { lang: 'en', text: 'Keywords: tomorrow, next week, next month, next year, this weekend, later, in the future.' },
                        { lang: 'gu', text: 'સૂચક શબ્દો: આવતીકાલે, આવતા અઠવાડિયે, આવતા મહિને, આવતા વર્ષે, આ વીકએન્ડે, પછીથી, ભવિષ્યમાં.' },
                        { lang: 'en', text: 'Shree Mangalam Spoken English Classes.' }
                    ],
                    words: [
                        { text: 'To be going to', left: 10, top: 3.5, width: 80, height: 4.5 },
                        { text: 'ભવિષ્યમાં કરવાની યોજના / ઇરાદો', left: 12, top: 9.5, width: 76, height: 3.0 },
                        { text: 'Affirmative (હકારાત્મક): Subject + am/is/are + going to + V1', left: 5, top: 21.0, width: 88, height: 2.8 },
                        { text: 'I am going to study (હું અભ્યાસ કરવા જઈ રહ્યો છું)', left: 32, top: 24.2, width: 60, height: 2.5 },
                        { text: 'Negative (નકારાત્મક): Subject + am/is/are not + going to + V1', left: 5, top: 28.0, width: 88, height: 2.8 },
                        { text: 'I am not going to study (હું અભ્યાસ કરવાનો નથી)', left: 32, top: 31.2, width: 60, height: 2.5 },
                        { text: 'Interrogative (પ્રશ્નાર્થક): Am/Is/Are + subject + going to + V1 ?', left: 5, top: 35.0, width: 88, height: 2.8 },
                        { text: 'Are you going to study? (શું તમે અભ્યાસ કરવાના છો?)', left: 32, top: 38.2, width: 60, height: 2.5 },
                        { text: 'Wh-Question: Wh + am/is/are + subject + going to + V1 ?', left: 5, top: 41.5, width: 88, height: 2.8 },
                        { text: 'What are you going to do? (તમે શું કરવાના છો?)', left: 32, top: 44.5, width: 60, height: 2.5 },
                        { text: 'Keywords (સૂચક શબ્દો)', left: 63, top: 57.0, width: 32, height: 3.2 },
                        { text: 'tomorrow (કાલે / આવતીકાલે)', left: 62, top: 62.0, width: 33, height: 2.2 },
                        { text: 'next week (આગામી અઠવાડિયે)', left: 62, top: 64.5, width: 33, height: 2.2 },
                        { text: 'next month (આગામી મહિને)', left: 62, top: 67.0, width: 33, height: 2.2 },
                        { text: 'this weekend (આ વીકએન્ડે)', left: 62, top: 73.0, width: 33, height: 2.2 },
                        { text: 'Shree Mangalam Spoken English Classes', left: 6, top: 91.0, width: 45, height: 3.0 }
                    ]
                },

                // Manifest 4: Why English is Important (Slide 7: y4Cq4BTx)
                {
                    matchKeywords: ['y4cq4btx', 'slide_6', 'મહત્વ', 'importance', 'why english'],
                    title: 'અંગ્રેજી ભાષાનું મહત્વ (Why English is Important)',
                    segments: [
                        { lang: 'gu', text: 'અંગ્રેજી ભાષાનું મહત્વ' },
                        { lang: 'gu', text: 'આજના સમયમાં English કેમ જરૂરી છે?' },
                        { lang: 'en', text: 'Why English is important:' },
                        { lang: 'gu', text: '૧. વિશ્વભરની ભાષા: English વિશ્વના ઘણા દેશોમાં કામ આવે છે.' },
                        { lang: 'en', text: '1. Global Language: English is spoken in most countries worldwide.' },
                        { lang: 'gu', text: '૨. અભ્યાસ માટે જરૂરી: ઉચ્ચ અભ્યાસ અને સારું શિક્ષણ મેળવવામાં મદદ કરે છે.' },
                        { lang: 'en', text: '2. Higher Education: Essential for academic success and best learning.' },
                        { lang: 'gu', text: '૩. નોકરી અને વ્યવસાયમાં ઉપયોગી: સારી નોકરી અને વધુ કારકિર્દીની તકો મળે છે.' },
                        { lang: 'en', text: '3. Career Growth: Opens doors for better jobs and business opportunities.' },
                        { lang: 'gu', text: '૪. વિદેશ જવા માટે મદદરૂપ: ભણવા, નોકરી કરવા અથવા પ્રવાસ માટે જરૂરી છે.' },
                        { lang: 'en', text: '4. International Travel: Helpful for going abroad, studying, and tourism.' },
                        { lang: 'gu', text: '૫. નવા લોકો સાથે જોડાવામાં સરળ: વિદેશી લોકો સાથે સરળતાથી વાતચીત કરી શકાય છે.' },
                        { lang: 'en', text: '5. Social Networking: Easily communicate and connect with diverse people.' },
                        { lang: 'gu', text: '૬. નવી જાણકારી મેળવવામાં મદદ: પુસ્તકો, ઈન્ટરનેટ અને ઓનલાઈન કોર્સ દ્વારા વધુ જ્ઞાન મળે છે.' },
                        { lang: 'en', text: '6. Access to Knowledge: Understand vast resources on the Internet and in books.' },
                        { lang: 'gu', text: '૭. વ્યક્તિત્વ વિકાસ થાય: આત્મવિશ્વાસ વધે છે અને જીવનમાં નવી તકો મળે છે.' },
                        { lang: 'en', text: '7. Personality Development: Skyrockets your self-confidence and public speaking.' },
                        { lang: 'gu', text: '૮. વિશ્વ સાથે જોડાણ: English તમને આખી દુનિયા સાથે જોડે છે.' },
                        { lang: 'en', text: '8. Connect with the World: English bridges you with opportunities across the globe.' },
                        { lang: 'en', text: 'Shree Mangalam Spoken English Classes, Porbandar.' }
                    ],
                    words: [
                        { text: 'અંગ્રેજી ભાષાનું મહત્વ', left: 10, top: 15.0, width: 45, height: 3.5 },
                        { text: 'આજના સમયમાં English કેમ જરૂરી છે?', left: 10, top: 20.0, width: 55, height: 3.2 },
                        { text: '1. વિશ્વભરની ભાષા: English વિશ્વના ઘણા દેશોમાં કામ આવે છે', left: 10, top: 32.0, width: 75, height: 4.5 },
                        { text: '2. અભ્યાસ માટે જરૂરી: ઉચ્ચ અભ્યાસ અને સારું શિક્ષણ મેળવવામાં મદદ કરે છે', left: 10, top: 40.0, width: 75, height: 4.5 },
                        { text: '3. નોકરી અને વ્યવસાયમાં ઉપયોગી: સારી નોકરી અને વધુ તકો મળે છે', left: 10, top: 49.0, width: 75, height: 4.5 },
                        { text: '4. વિદેશ જવા માટે મદદરૂપ: ભણવા, નોકરી કરવા અથવા પ્રવાસ માટે જરૂરી છે', left: 10, top: 57.0, width: 75, height: 4.5 },
                        { text: '5. નવા લોકો સાથે જોડાવામાં સરળ: વિદેશી લોકો સાથે વાતચીત કરી શકાય છે', left: 10, top: 66.0, width: 75, height: 4.5 },
                        { text: '6. નવી જાણકારી મેળવવામાં મદદ: Books, Internet દ્વારા વધુ જ્ઞાન મળે છે', left: 10, top: 74.0, width: 75, height: 4.5 },
                        { text: '7. વ્યક્તિત્વ વિકાસ થાય: આત્મવિશ્વાસ વધે છે અને નવી તકો મળે છે', left: 10, top: 82.0, width: 75, height: 4.5 },
                        { text: '8. વિશ્વ સાથે જોડાણ: English તમને દુનિયા સાથે જોડે છે', left: 10, top: 90.0, width: 75, height: 4.5 }
                    ]
                },

                // Manifest 5: Chalkboard Chart (Slide 5: bmiZ8bOZ)
                {
                    matchKeywords: ['bmiz8boz', 'slide_4'],
                    title: 'To be going to (ચાર્ટ - Chalkboard Layout)',
                    segments: [
                        { lang: 'en', text: 'To be going to' },
                        { lang: 'gu', text: 'ભવિષ્યમાં કરવાની યોજના અથવા ઇરાદો' },
                        { lang: 'en', text: 'Plan. Intention. Future Action.' },
                        { lang: 'gu', text: 'To be going to એટલે શું? To be going to નો ઉપયોગ ભવિષ્યમાં કોઈ કામ કરવાની યોજના, ઇરાદો અથવા જે થવાની શક્યતા દેખાય તે માટે થાય છે.' },
                        { lang: 'gu', text: 'આ પહેલેથી નક્કી કરેલી અથવા વિચારેલી યોજનાને દર્શાવે છે.' },
                        { lang: 'gu', text: 'ક્યારે ઉપયોગ કરવો? ભવિષ્યમાં કરવાની પૂર્વયોજના જણાવવા, કોઈ કામ કરવાનો ઇરાદો બતાવવા, જેના લક્ષણો જોઈને લાગે કે કંઈક થવાનું છે.' },
                        { lang: 'gu', text: 'તાત્કાલિક નહિ, પરંતુ વિચારીને લેવાયેલો નિર્ણય.' },
                        { lang: 'en', text: 'Personal plans, decisions and intentions.' },
                        { lang: 'en', text: 'Structure: Affirmative - Subject plus am, is, are plus going to plus verb one.' },
                        { lang: 'en', text: 'Example: I am going to study.' },
                        { lang: 'en', text: 'Negative: Subject plus am, is, are not plus going to plus verb one.' },
                        { lang: 'en', text: 'Example: I am not going to study.' },
                        { lang: 'en', text: 'Interrogative: Am, Is, Are plus subject plus going to plus verb one?' },
                        { lang: 'en', text: 'Example: Are you going to study?' },
                        { lang: 'en', text: 'Wh-Question: Wh plus am, is, are plus subject plus going to plus verb one?' },
                        { lang: 'en', text: 'Example: What are you going to do?' },
                        { lang: 'en', text: 'Examples:' },
                        { lang: 'en', text: '1. I am going to visit my grandparents.' },
                        { lang: 'gu', text: 'હું મારા દાદા-દાદીને મળવા જવાનો છું.' },
                        { lang: 'en', text: '2. She is going to join a new class.' },
                        { lang: 'gu', text: 'તે નવી ક્લાસમાં જોડાવાની છે.' },
                        { lang: 'en', text: '3. We are going to watch a movie.' },
                        { lang: 'gu', text: 'અમે મૂવી જોવા જવાના છીએ.' },
                        { lang: 'en', text: '4. He is not going to come tomorrow.' },
                        { lang: 'gu', text: 'તે કાલે આવવાનો નથી.' },
                        { lang: 'en', text: '5. They are not going to buy a car.' },
                        { lang: 'gu', text: 'તેઓ કાર ખરીદવાના નથી.' },
                        { lang: 'en', text: '6. Are you going to attend the meeting?' },
                        { lang: 'gu', text: 'શું તમે મીટિંગમાં હાજરી આપવાના છો?' },
                        { lang: 'en', text: '7. What is she going to do?' },
                        { lang: 'gu', text: 'તે શું કરવાની છે?' },
                        { lang: 'en', text: '8. Where are you going to go this weekend?' },
                        { lang: 'gu', text: 'આ વીકએન્ડે તમે ક્યાં જવાના છો?' },
                        { lang: 'en', text: 'Short Forms: I am going to equals I m going to.' },
                        { lang: 'en', text: 'Keywords: tomorrow, next week, next month, this weekend, soon, later, in the future.' },
                        { lang: 'gu', text: 'સૂચક શબ્દો: કાલે, આગામી અઠવાડિયે, આગામી મહિને, આ વીકએન્ડે, ટૂંક સમયમાં, પછીથી, ભવિષ્યમાં.' },
                        { lang: 'en', text: 'Shree Mangalam Spoken English Classes, Porbandar.' }
                    ],
                    words: [
                        { text: 'To be going to', left: 18, top: 2.0, width: 60, height: 5.0 },
                        { text: 'ભવિષ્યમાં કરવાની યોજના / ઇરાદો', left: 20, top: 7.5, width: 55, height: 3.0 },
                        { text: 'Plan • Intention • Future Action', left: 22, top: 11.0, width: 50, height: 2.5 },
                        { text: 'To be going to એટલે શું?', left: 4, top: 16.5, width: 48, height: 3.2 },
                        { text: 'ક્યારે ઉપયોગ કરવો?', left: 56, top: 16.5, width: 40, height: 3.2 },
                        { text: 'Structure (રચના)', left: 10, top: 32.0, width: 22, height: 3.0 },
                        { text: 'Affirmative: Subject + am/is/are + going to + V1', left: 5, top: 36.0, width: 45, height: 2.5 },
                        { text: 'Negative: Subject + am/is/are not + going to + V1', left: 5, top: 40.0, width: 45, height: 2.5 },
                        { text: 'Interrogative: Am/Is/Are + subject + going to + V1?', left: 5, top: 44.0, width: 45, height: 2.5 },
                        { text: 'Wh-Question: Wh + am/is/are + subject + going to + V1?', left: 5, top: 48.0, width: 45, height: 2.5 },
                        { text: 'Examples (ઉદાહરણો)', left: 60, top: 32.0, width: 30, height: 3.0 },
                        { text: '1. I am going to visit my grandparents', left: 55, top: 36.0, width: 42, height: 2.5 },
                        { text: '2. She is going to join a new class', left: 55, top: 40.0, width: 42, height: 2.5 },
                        { text: '3. We are going to watch a movie', left: 55, top: 44.0, width: 42, height: 2.5 },
                        { text: '4. He is not going to come tomorrow', left: 55, top: 48.0, width: 42, height: 2.5 },
                        { text: '5. They are not going to buy a car', left: 55, top: 52.0, width: 42, height: 2.5 },
                        { text: '6. Are you going to attend the meeting?', left: 55, top: 56.0, width: 42, height: 2.5 },
                        { text: '7. What is she going to do?', left: 55, top: 60.0, width: 42, height: 2.5 },
                        { text: '8. Where are you going to go this weekend?', left: 55, top: 64.0, width: 42, height: 2.5 },
                        { text: 'Short Forms (ટૂંકા રૂપ)', left: 5, top: 54.0, width: 20, height: 3.0 },
                        { text: 'Keywords (સૂચક શબ્દો)', left: 30, top: 76.0, width: 25, height: 3.0 },
                        { text: 'Common Uses (મુખ્ય ઉપયોગો)', left: 62, top: 76.0, width: 32, height: 3.0 },
                        { text: 'Shree Mangalam Spoken English Classes', left: 22, top: 90.0, width: 55, height: 3.5 }
                    ]
                },

                // Manifest 6: Full Infographic Poster (Slide 6: VkXm74Y8)
                {
                    matchKeywords: ['vkxm74y8', 'slide_5'],
                    title: 'To be going to (સંપૂર્ણ ઇન્ફોગ્રાફિક પોસ્ટર)',
                    segments: [
                        { lang: 'en', text: 'To be going to' },
                        { lang: 'gu', text: 'ભવિષ્યમાં કરવાની યોજના અથવા ઇરાદો' },
                        { lang: 'en', text: 'Plan. Intention. Future Action.' },
                        { lang: 'gu', text: 'To be going to એટલે શું? To be going to નો ઉપયોગ ભવિષ્યમાં કોઈ કામ કરવાની યોજના, ઇરાદો અથવા જે થવાની શક્યતા દેખાય તે માટે થાય છે.' },
                        { lang: 'gu', text: 'આ પહેલેથી નક્કી કરેલી અથવા વિચારેલી યોજનાને દર્શાવે છે.' },
                        { lang: 'gu', text: 'ક્યારે ઉપયોગ કરવો? ભવિષ્યમાં કરવાની પૂર્વયોજના જણાવવા, કોઈ કામ કરવાનો ઇરાદો બતાવવા.' },
                        { lang: 'gu', text: 'જેના લક્ષણો જોઈને લાગે કે કંઈક થવાનું છે. Near future prediction.' },
                        { lang: 'gu', text: 'તાત્કાલિક નહિ, પરંતુ વિચારીને લેવાયેલો નિર્ણય.' },
                        { lang: 'en', text: 'Personal plans, decisions and intentions.' },
                        { lang: 'en', text: 'Structure (રચના):' },
                        { lang: 'en', text: 'Affirmative (હકારાત્મક): Subject plus am, is, are plus going to plus verb one.' },
                        { lang: 'en', text: 'I am going to study.' },
                        { lang: 'en', text: 'Negative (નકારાત્મક): Subject plus am, is, are not plus going to plus verb one.' },
                        { lang: 'en', text: 'I am not going to study.' },
                        { lang: 'en', text: 'Interrogative (પ્રશ્નાર્થક): Am, Is, Are plus subject plus going to plus verb one?' },
                        { lang: 'en', text: 'Are you going to study?' },
                        { lang: 'en', text: 'Wh-Question (પ્રશ્નાર્થક - Wh): Wh plus am, is, are plus subject plus going to plus verb one?' },
                        { lang: 'en', text: 'What are you going to do?' },
                        { lang: 'en', text: 'Forms of to be going to (સંપૂર્ણ રૂપ):' },
                        { lang: 'en', text: 'I - I am going to, I am not going to, Am I going to?' },
                        { lang: 'en', text: 'You - You are going to, You are not going to, Are you going to?' },
                        { lang: 'en', text: 'He - He is going to, He is not going to, Is he going to?' },
                        { lang: 'en', text: 'She - She is going to, She is not going to, Is she going to?' },
                        { lang: 'en', text: 'We - We are going to, We are not going to, Are we going to?' },
                        { lang: 'en', text: 'They - They are going to, They are not going to, Are they going to?' },
                        { lang: 'en', text: 'Examples (ઉદાહરણો):' },
                        { lang: 'en', text: '1. I am going to visit my grandparents.' },
                        { lang: 'gu', text: 'હું મારા દાદા-દાદીને મળવા જવાનો છું.' },
                        { lang: 'en', text: '2. She is going to join a new class.' },
                        { lang: 'gu', text: 'તે નવી ક્લાસમાં જોડાવાની છે.' },
                        { lang: 'en', text: '3. We are going to watch a movie.' },
                        { lang: 'gu', text: 'અમે મૂવી જોવા જવાના છીએ.' },
                        { lang: 'en', text: '4. He is not going to come tomorrow.' },
                        { lang: 'gu', text: 'તે કાલે આવવાનો નથી.' },
                        { lang: 'en', text: '5. They are not going to buy a car.' },
                        { lang: 'gu', text: 'તેઓ કાર ખરીદવાના નથી.' },
                        { lang: 'en', text: '6. Are you going to attend the meeting?' },
                        { lang: 'gu', text: 'શું તમે મીટિંગમાં હાજર રહેવાના છો?' },
                        { lang: 'en', text: '7. What is she going to do?' },
                        { lang: 'gu', text: 'તે શું કરવાની છે?' },
                        { lang: 'en', text: '8. Where are you going to go this weekend?' },
                        { lang: 'gu', text: 'આ વીકએન્ડે તમે ક્યાં જવાના છો?' },
                        { lang: 'en', text: 'Short Forms (ટૂંકા રૂપ): I m going to, You re going to, He s going to, She s going to, It s going to, We re going to, They re going to.' },
                        { lang: 'en', text: 'Keywords (સૂચક શબ્દો):' },
                        { lang: 'en', text: 'tomorrow, next week, next month, next year, this weekend, soon, later, in the future.' },
                        { lang: 'gu', text: 'કાલે, આગામી અઠવાડિયે, આગામી મહિને, આગામી વર્ષે, આ વીકએન્ડે, ટૂંક સમયમાં, પછી, ભવિષ્યમાં.' },
                        { lang: 'en', text: 'Common Uses (મુખ્ય ઉપયોગો):' },
                        { lang: 'gu', text: 'Personal plans (વ્યક્તિગત યોજના), Decisions (નિર્ણય), Intentions (ઇરાદો), Predictions based on evidence (પુરાવા પરથી કરેલી શક્યતા), Future arrangements (ભવિષ્યની વ્યવસ્થા).' },
                        { lang: 'en', text: 'Plan Today for a Better Tomorrow.' },
                        { lang: 'en', text: 'Shree Mangalam Spoken English Classes, Porbandar. Vijay Joshi, Mo. 9033965711.' }
                    ],
                    words: [
                        { text: 'To be going to', left: 18, top: 1.5, width: 58, height: 5.0 },
                        { text: 'ભવિષ્યમાં કરવાની યોજના / ઇરાદો', left: 18, top: 6.5, width: 55, height: 3.0 },
                        { text: 'Plan • Intention • Future Action', left: 20, top: 9.5, width: 50, height: 2.5 },
                        { text: 'To be going to એટલે શું?', left: 3, top: 14.5, width: 42, height: 3.0 },
                        { text: 'ક્યારે ઉપયોગ કરવો?', left: 52, top: 14.5, width: 42, height: 3.0 },
                        { text: 'Structure (રચના)', left: 6, top: 31.0, width: 25, height: 2.8 },
                        { text: 'Affirmative (હકારાત્મક)', left: 5, top: 34.5, width: 15, height: 2.2 },
                        { text: 'Subject + am/is/are + going to + V1', left: 20, top: 34.5, width: 28, height: 2.2 },
                        { text: 'Negative (નકારાત્મક)', left: 5, top: 38.0, width: 15, height: 2.2 },
                        { text: 'Subject + am/is/are not + going to + V1', left: 20, top: 38.0, width: 28, height: 2.2 },
                        { text: 'Interrogative (પ્રશ્નાર્થક)', left: 5, top: 41.5, width: 15, height: 2.2 },
                        { text: 'Am/Is/Are + subject + going to + V1?', left: 20, top: 41.5, width: 28, height: 2.2 },
                        { text: 'Wh-Question (પ્રશ્નાર્થક - Wh)', left: 5, top: 45.0, width: 15, height: 2.2 },
                        { text: 'Wh + am/is/are + subject + going to + V1?', left: 20, top: 45.0, width: 28, height: 2.2 },
                        { text: 'ઉદાહરણો (Examples)', left: 58, top: 32.5, width: 35, height: 3.0 },
                        { text: '1. I am going to visit my grandparents', left: 55, top: 36.5, width: 42, height: 2.2 },
                        { text: 'હું મારા દાદા-દાદીને મળવા જવાનો છું', left: 58, top: 38.5, width: 38, height: 2.0 },
                        { text: '2. She is going to join a new class', left: 55, top: 40.5, width: 42, height: 2.2 },
                        { text: 'તે નવી ક્લાસમાં જોડાવાની છે', left: 58, top: 42.5, width: 38, height: 2.0 },
                        { text: '3. We are going to watch a movie', left: 55, top: 44.5, width: 42, height: 2.2 },
                        { text: 'અમે મૂવી જોવા જવાના છીએ', left: 58, top: 46.5, width: 38, height: 2.0 },
                        { text: '4. He is not going to come tomorrow', left: 55, top: 48.5, width: 42, height: 2.2 },
                        { text: 'તે કાલે આવવાનો નથી', left: 58, top: 50.5, width: 38, height: 2.0 },
                        { text: '5. They are not going to buy a car', left: 55, top: 52.5, width: 42, height: 2.2 },
                        { text: 'તેઓ કાર ખરીદવાના નથી', left: 58, top: 54.5, width: 38, height: 2.0 },
                        { text: '6. Are you going to attend the meeting?', left: 55, top: 56.5, width: 42, height: 2.2 },
                        { text: 'શું તમે મીટિંગમાં હાજર રહેવાના છો?', left: 58, top: 58.5, width: 38, height: 2.0 },
                        { text: '7. What is she going to do?', left: 55, top: 60.5, width: 42, height: 2.2 },
                        { text: 'તે શું કરવાની છે?', left: 58, top: 62.5, width: 38, height: 2.0 },
                        { text: '8. Where are you going to go this weekend?', left: 55, top: 64.5, width: 42, height: 2.2 },
                        { text: 'આ વીકએન્ડે તમે ક્યાં જવાના છો?', left: 58, top: 66.5, width: 38, height: 2.0 },
                        { text: 'Forms of to be going to (સંપૂર્ણ રૂપ)', left: 5, top: 49.5, width: 42, height: 3.0 },
                        { text: 'Short Forms (ટૂંકા રૂપ)', left: 5, top: 72.0, width: 20, height: 2.5 },
                        { text: 'Keywords (સૂચક શબ્દો)', left: 30, top: 72.0, width: 20, height: 2.5 },
                        { text: 'Common Uses (મુખ્ય ઉપયોગો)', left: 60, top: 72.0, width: 32, height: 2.5 },
                        { text: 'Plan Today for a Better Tomorrow', left: 60, top: 86.0, width: 35, height: 3.0 },
                        { text: 'Shree Mangalam Spoken English Classes', left: 20, top: 90.0, width: 55, height: 3.5 }
                    ]
                }
            ];

            // Helper to find a verified manifest for the current slide
            // Only returns a manifest if its keywords explicitly match – no fallback to slide 0
            function findSlideManifest(caption, imgSrc, slideIdx) {
                const combined = (caption + ' ' + imgSrc + ' slide_' + slideIdx).toLowerCase();
                for (let m of verifiedSlideManifests) {
                    if (m.matchKeywords.some(k => combined.includes(k.toLowerCase()))) {
                        return m;
                    }
                }
                // No manifest matched – return null so live OCR scanning is used instead
                return null;
            }

            // Comprehensive Spoken English & Gujarati Typo / OCR Misreading Corrections
            const ocrWordCorrections = {
                // English OCR misreads
                'vicit': 'visit',
                'grandperants': 'grandparents',
                'cor': 'car',
                'altirmative': 'affirmative',
                'esaatnios': 'affirmative',
                'eiecedi': 'examples',
                'eieced': 'examples',
                'exampie': 'example',
                'ans/t/ave': 'am is are',
                'ans/lave': 'am is are',
                'ans/l/ave': 'am is are',
                'omy/fave': 'am is are',
                'omy/lave': 'am is are',
                'ent/ane': 'am is are',
                'rlext': 'next',
                'wentth': 'month',
                'seeaj': 'soon',
                'lata': 'later',
                'latar': 'later',
                'ite\'s': 'it is',
                'hs': 'he',
                'wh-ouestion': 'wh-question',
                'oaxile': 'auxiliary',
                'goim': 'going',
                'oat': 'not',
                'cow': 'new',
                'some': 'come',
                'v1': 'verb one',

                // Gujarati OCR typical misreads & normalizations
                'રોત્ર': 'યોજના',
                'ઘારાટો': 'ઇરાદો',
                'ભતિઆમાં': 'ભવિષ્યમાં',
                'વીજાના': 'યોજના',
                'હકારાત્યક': 'હકારાત્મક',
                'નકારાત્યક': 'નકારાત્મક',
                'પ્રશ્નાર્ષક': 'પ્રશ્નાર્થક',
                'ઉદાહરણૉ': 'ઉદાહરણો',
                'દાદીને': 'દાદીને',
                'જોડાવાની': 'જોડાવાની',
                'આવતીકાલે': 'આવતીકાલે',
                'અઠવાડિયે': 'અઠવાડિયે',
                'સપ્તાહના': 'સપ્તાહના',
                'ટૂંક': 'ટૂંક'
            };

            function correctOcrWord(word) {
                const lower = word.toLowerCase().trim();
                if (ocrWordCorrections[lower]) {
                    return ocrWordCorrections[lower];
                }
                return word;
            }

            // Clean text: strip special noise, keep real words & sentence punctuation (. , ?)
            function cleanOcrText(rawText) {
                return rawText
                    .replace(/[|\—_~`#^*<>{}[\]\\/@$%&=+;:\"•·©®™★✓✔✕✖▲▼►◄◆◇■□●○]/g, ' ')
                    .replace(/\s+/g, ' ')
                    .trim();
            }

            // Split raw scanned text into clean natural segments
            function segmentText(fullText) {
                const rawParts = fullText.split(/(?<=[.!?\n])\s+/);
                const segments = [];

                for (let part of rawParts) {
                    let cleaned = cleanOcrText(part);
                    if (!cleaned || cleaned.length < 2) continue;

                    // Sub-split if line mixes Gujarati and English
                    const subTokens = cleaned.match(/([\u0A80-\u0AFF\s.,!?]+|[a-zA-Z\s.,!?'-]+)/g);
                    if (subTokens && subTokens.length > 1) {
                        for (let t of subTokens) {
                            let cleanToken = t.trim();
                            if (cleanToken.length > 1) {
                                segments.push({
                                    lang: containsGujarati(cleanToken) ? 'gu' : 'en',
                                    text: cleanToken
                                });
                            }
                        }
                    } else {
                        segments.push({
                            lang: containsGujarati(cleaned) ? 'gu' : 'en',
                            text: cleaned
                        });
                    }
                }
                return segments;
            }

            // Render Output Text Panel for visual verification & word-by-word practice
            function updateSpeechOutputDisplay(title, segments) {
                if (!speechTextDisplay) return;
                let html = '<div style="margin-bottom: 0.5rem; font-size: 0.75rem; color: #94a3b8; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Lesson Sentences (Click any sentence to listen in Gujarati / English):</div>';
                html += '<div style="display: flex; flex-direction: column; gap: 0.35rem;">';

                segments.forEach((seg, i) => {
                    const isGu = seg.lang === 'gu' || containsGujarati(seg.text);
                    const badge = isGu ? '<span style="background: rgba(16, 185, 129, 0.2); color: #34d399; font-size: 0.68rem; padding: 0.1rem 0.35rem; border-radius: 4px; font-weight: 800;">GU</span>' : '<span style="background: rgba(56, 189, 248, 0.2); color: #38bdf8; font-size: 0.68rem; padding: 0.1rem 0.35rem; border-radius: 4px; font-weight: 800;">EN</span>';
                    const safeText = seg.text.replace(/'/g, "\\'").replace(/"/g, '&quot;');
                    const displayLang = isGu ? 'gu' : 'en';
                    html += `
                        <div class="speech-sentence-item" onclick="speakOneSentence('${safeText}', '${displayLang}')" style="display: flex; align-items: baseline; gap: 0.5rem; background: rgba(15, 23, 42, 0.6); padding: 0.35rem 0.6rem; border-radius: 6px; cursor: pointer; transition: background 0.15s ease; border: 1px solid rgba(51, 65, 85, 0.5);">
                            ${badge}
                            <span style="color: ${isGu ? '#a7f3d0' : '#ffffff'}; font-size: 0.84rem; font-weight: ${isGu ? '600' : '600'}; line-height: 1.4;">${seg.text}</span>
                            <span style="margin-left: auto; color: #64748b; font-size: 0.75rem;">🔊</span>
                        </div>
                    `;
                });
                html += '</div>';
                speechTextDisplay.innerHTML = html;
            }

            // Speak list of segments sequentially with auto-language detection
            function speakSegmentsLoudly(segments) {
                stopSpeech();
                isReading = true;

                if (!segments || segments.length === 0) {
                    stopSpeech();
                    return;
                }

                let segIndex = 0;

                function speakNext() {
                    if (!isReading || segIndex >= segments.length) {
                        if (speechStatusTitle) speechStatusTitle.textContent = 'Finished Reading';
                        stopSpeech();
                        return;
                    }

                    const seg = segments[segIndex];
                    segIndex++;

                    const segText = (typeof seg === 'string' ? seg : seg.text).trim();
                    const isGuj = (typeof seg === 'object' && seg.lang === 'gu') || containsGujarati(segText);

                    if (!segText || !segText.replace(/[.,?!]/g, '').trim()) {
                        speakNext();
                        return;
                    }

                    if (speechStatusTitle) {
                        speechStatusTitle.textContent = isGuj
                            ? `Speaking Gujarati: "${segText.substring(0, 32)}..."`
                            : `Speaking English: "${segText.substring(0, 32)}..."`;
                    }

                    speakPhrase(segText, isGuj ? 'gu' : 'en', () => {
                        if (isReading) {
                            setTimeout(speakNext, 200);
                        }
                    });
                }

                speakNext();
            }

            // Main "Read All" orchestration: checks verified manifest first, then falls back to OCR
            async function performOcrAndSpeak(imgUrl, slideIdx) {
                speechControlsBar.style.display = 'flex';
                readAloudBtn.classList.add('speaking');
                readAloudLabel.textContent = 'Reading...';
                readAloudIcon.setAttribute('data-lucide', 'volume-x');
                if (window.lucide) window.lucide.createIcons();

                const activeThumb = thumbs[slideIdx];
                const caption = activeThumb.getAttribute('data-caption') || '';
                const manifest = findSlideManifest(caption, imgUrl, slideIdx);

                // Priority 1: Verified manifest with 100% accurate Gujarati and English words
                if (manifest && manifest.segments && manifest.segments.length > 0) {
                    speechStatusTitle.textContent = manifest.title || 'Reading Lesson Chart';
                    updateSpeechOutputDisplay(manifest.title, manifest.segments);
                    speakSegmentsLoudly(manifest.segments);
                    return;
                }

                // Priority 2: Real-time OCR scanning with intelligent autocorrection
                speechStatusTitle.textContent = 'Scanning lesson text...';
                speechTextDisplay.innerHTML = '<span style="color: #38bdf8;">Scanning text from image (English &amp; Gujarati)... please wait a moment.</span>';

                try {
                    let segments = slideTextCache[slideIdx];

                    if (!segments) {
                        if (typeof Tesseract === 'undefined') {
                            throw new Error('OCR library is still loading. Please check your internet connection.');
                        }

                        const processedCanvas = preprocessImageForOcr(mainImg);

                        const workerResult = await Tesseract.recognize(
                            processedCanvas,
                            'guj+eng',
                            {
                                logger: m => {
                                    if (m.status === 'recognizing text') {
                                        const pct = Math.round(m.progress * 100);
                                        speechStatusTitle.textContent = `Reading Image Text (${pct}%)...`;
                                    }
                                }
                            }
                        );

                        const rawText = workerResult.data.text;
                        segments = segmentText(rawText);

                        segments = segments.map(seg => {
                            let words = seg.text.split(/\s+/).map(w => correctOcrWord(w));
                            return {
                                lang: seg.lang,
                                text: words.join(' ')
                            };
                        });

                        slideTextCache[slideIdx] = segments;
                    }

                    if (!segments || segments.length === 0) {
                        speechStatusTitle.textContent = 'No text detected';
                        speechTextDisplay.textContent = 'No readable text was detected on this image slide.';
                        stopSpeech();
                        return;
                    }

                    speechStatusTitle.textContent = 'Reading Aloud (Speaking)';
                    updateSpeechOutputDisplay('Scanned Lesson Text', segments);
                    speakSegmentsLoudly(segments);

                } catch (err) {
                    console.error('OCR Speech Error:', err);
                    speechStatusTitle.textContent = 'Notice';
                    speechTextDisplay.textContent = 'Could not read image: ' + (err.message || 'Error occurred');
                    stopSpeech();
                }
            }

            // Preprocess and upscale image onto high-contrast canvas for razor-sharp OCR accuracy
            function preprocessImageForOcr(imageEl) {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                const scale = Math.max(1.8, Math.min(2.5, 2400 / (imageEl.naturalWidth || 1000)));
                const w = Math.round((imageEl.naturalWidth || 800) * scale);
                const h = Math.round((imageEl.naturalHeight || 1200) * scale);

                canvas.width = w;
                canvas.height = h;

                ctx.imageSmoothingEnabled = true;
                ctx.imageSmoothingQuality = 'high';
                ctx.drawImage(imageEl, 0, 0, w, h);

                const imgData = ctx.getImageData(0, 0, w, h);
                const d = imgData.data;

                for (let i = 0; i < d.length; i += 4) {
                    const r = d[i];
                    const g = d[i+1];
                    const b = d[i+2];
                    const v = 0.299 * r + 0.587 * g + 0.114 * b;

                    const contrast = 1.35;
                    const factor = (259 * (contrast + 255)) / (255 * (259 - contrast));
                    const newV = Math.min(255, Math.max(0, factor * (v - 128) + 128));

                    d[i] = newV;
                    d[i+1] = newV;
                    d[i+2] = newV;
                }
                ctx.putImageData(imgData, 0, 0);
                return canvas;
            }

            // ==========================================
            // POINT & READ ON HOVER FEATURE
            // ==========================================
            const hoverReadToggleBtn = document.getElementById('hoverReadToggleBtn');
            const hoverReadLabel = document.getElementById('hoverReadLabel');
            const hoverReadOverlay = document.getElementById('hoverReadOverlay');
            const hoverPointerTooltip = document.getElementById('hoverPointerTooltip');
            const slideImageWrapper = document.getElementById('slideImageWrapper');

            let isHoverReadActive = false;
            const slideBoxesCache = {};
            let hoverSpeechTimeout = null;
            let lastSpokenText = '';

            // Toggle Point & Read Mode
            if (hoverReadToggleBtn) {
                hoverReadToggleBtn.addEventListener('click', async () => {
                    isHoverReadActive = !isHoverReadActive;
                    if (isHoverReadActive) {
                        hoverReadToggleBtn.classList.add('active');
                        hoverReadLabel.textContent = 'Pointer Active';
                        hoverReadOverlay.style.display = 'block';
                        hoverPointerTooltip.style.display = 'block';
                        hoverPointerTooltip.textContent = '🔊 Move mouse over text to read (Gujarati & English)';

                        const activeThumb = thumbs[currentIndex];
                        const imgSrc = activeThumb.getAttribute('data-src');
                        await buildHoverBoxesForSlide(imgSrc, currentIndex);
                    } else {
                        disableHoverRead();
                    }
                });
            }

            function disableHoverRead() {
                isHoverReadActive = false;
                if (hoverReadToggleBtn) {
                    hoverReadToggleBtn.classList.remove('active');
                    hoverReadLabel.textContent = 'Point & Read';
                }
                if (hoverReadOverlay) hoverReadOverlay.style.display = 'none';
                if (hoverPointerTooltip) hoverPointerTooltip.style.display = 'none';
                clearTimeout(hoverSpeechTimeout);
                lastSpokenText = '';
            }

            // Track mouse cursor to update tooltip position
            if (slideImageWrapper) {
                slideImageWrapper.addEventListener('mousemove', (e) => {
                    if (!isHoverReadActive) return;
                    const rect = slideImageWrapper.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    hoverPointerTooltip.style.left = x + 'px';
                    hoverPointerTooltip.style.top = y + 'px';
                });

                slideImageWrapper.addEventListener('mouseleave', () => {
                    if (hoverPointerTooltip) hoverPointerTooltip.style.display = 'none';
                });

                slideImageWrapper.addEventListener('mouseenter', () => {
                    if (isHoverReadActive && hoverPointerTooltip) hoverPointerTooltip.style.display = 'block';
                });
            }

            // Build interactive hoverable single-word boxes (Manifest priority, then OCR)
            async function buildHoverBoxesForSlide(imgUrl, slideIdx) {
                hoverReadOverlay.innerHTML = '';

                if (slideBoxesCache[slideIdx]) {
                    renderHoverBoxes(slideBoxesCache[slideIdx]);
                    return;
                }

                const activeThumb = thumbs[slideIdx];
                const caption = activeThumb.getAttribute('data-caption') || '';
                const manifest = findSlideManifest(caption, imgUrl, slideIdx);

                // Priority 1: Use verified word layout with perfect Gujarati text
                if (manifest && manifest.words && manifest.words.length > 0) {
                    slideBoxesCache[slideIdx] = manifest.words;
                    renderHoverBoxes(manifest.words);
                    hoverPointerTooltip.textContent = '🔊 Move mouse over any text to listen';
                    return;
                }

                // Priority 2: Scan live words via OCR
                hoverPointerTooltip.textContent = 'Scanning slide text...';

                try {
                    if (typeof Tesseract === 'undefined') return;

                    const processedCanvas = preprocessImageForOcr(mainImg);

                    const workerResult = await Tesseract.recognize(
                        processedCanvas,
                        'guj+eng',
                        {
                            logger: m => {
                                if (m.status === 'recognizing text') {
                                    const pct = Math.round(m.progress * 100);
                                    hoverPointerTooltip.textContent = `Reading words (${pct}%)...`;
                                }
                            }
                        }
                    );

                    const words = (workerResult.data && workerResult.data.words) ? workerResult.data.words : [];
                    const canvasW = processedCanvas.width;
                    const canvasH = processedCanvas.height;

                    const boxes = [];

                    words.forEach(wordObj => {
                        const rawWord = wordObj.text;
                        let cleanWord = cleanOcrText(rawWord);

                        if (!cleanWord || (cleanWord.length === 1 && !/^[aAiI]$/.test(cleanWord))) return;

                        cleanWord = correctOcrWord(cleanWord);

                        const b0 = wordObj.bbox;
                        if (!b0) return;

                        const leftPct = (b0.x0 / canvasW) * 100;
                        const topPct = (b0.y0 / canvasH) * 100;
                        const widthPct = ((b0.x1 - b0.x0) / canvasW) * 100;
                        const heightPct = ((b0.y1 - b0.y0) / canvasH) * 100;

                        boxes.push({
                            text: cleanWord,
                            left: leftPct,
                            top: topPct,
                            width: Math.max(widthPct, 2.5),
                            height: Math.max(heightPct, 1.8)
                        });
                    });

                    slideBoxesCache[slideIdx] = boxes;
                    renderHoverBoxes(boxes);
                    hoverPointerTooltip.textContent = '🔊 Move mouse over any word to listen';

                } catch (err) {
                    console.error('Hover OCR Box Error:', err);
                    hoverPointerTooltip.textContent = 'Could not scan words';
                }
            }

            function renderHoverBoxes(boxes) {
                hoverReadOverlay.innerHTML = '';
                if (!boxes || boxes.length === 0) return;

                boxes.forEach((box) => {
                    const el = document.createElement('div');
                    el.className = 'hover-word-box';
                    el.style.left = box.left + '%';
                    el.style.top = box.top + '%';
                    el.style.width = box.width + '%';
                    el.style.height = box.height + '%';
                    el.title = box.text;

                    // Hover event: read this sentence or word when mouse touches it
                    el.addEventListener('mouseenter', () => {
                        if (!isHoverReadActive) return;

                        el.classList.add('highlight');
                        hoverPointerTooltip.textContent = '🔊 ' + box.text;

                        if (lastSpokenText === box.text && (window.speechSynthesis.speaking || activeAudioObj)) {
                            return;
                        }

                        clearTimeout(hoverSpeechTimeout);
                        hoverSpeechTimeout = setTimeout(() => {
                            lastSpokenText = box.text;
                            speakPhrase(box.text, containsGujarati(box.text) ? 'gu' : 'en');
                        }, 80);
                    });

                    el.addEventListener('mouseleave', () => {
                        el.classList.remove('highlight');
                    });

                    hoverReadOverlay.appendChild(el);
                });
            }

            // Click listener for Read All Aloud button
            if (readAloudBtn) {
                readAloudBtn.addEventListener('click', () => {
                    if (isReading) {
                        stopSpeech();
                        if (speechControlsBar) speechControlsBar.style.display = 'none';
                    } else {
                        const activeThumb = thumbs[currentIndex];
                        const imgSrc = activeThumb.getAttribute('data-src');
                        performOcrAndSpeak(imgSrc, currentIndex);
                    }
                });
            }

            // Lesson Text Output Viewer Toggle
            const lessonTextToggleBtn = document.getElementById('lessonTextToggleBtn');
            if (lessonTextToggleBtn) {
                lessonTextToggleBtn.addEventListener('click', () => {
                    const isVisible = speechControlsBar.style.display === 'flex';
                    if (isVisible) {
                        speechControlsBar.style.display = 'none';
                    } else {
                        const activeThumb = thumbs[currentIndex];
                        const caption = activeThumb.getAttribute('data-caption') || '';
                        const imgSrc = activeThumb.getAttribute('data-src');
                        const manifest = findSlideManifest(caption, imgSrc, currentIndex);

                        speechControlsBar.style.display = 'flex';
                        if (manifest) {
                            speechStatusTitle.textContent = manifest.title || 'Lesson Text Output';
                            updateSpeechOutputDisplay(manifest.title, manifest.segments);
                        } else {
                            performOcrAndSpeak(imgSrc, currentIndex);
                        }
                    }
                });
            }

            // ==========================================
            // ZOOM IN / ZOOM OUT CONTROLLER
            // ==========================================
            let currentZoom = 1.0;
            const minZoom = 0.6;
            const maxZoom = 2.8;
            const zoomStep = 0.2;

            const zoomInBtn = document.getElementById('zoomInBtn');
            const zoomOutBtn = document.getElementById('zoomOutBtn');
            const zoomResetBtn = document.getElementById('zoomResetBtn');
            const zoomLevelBadge = document.getElementById('zoomLevelBadge');

            function applyZoom(newZoom) {
                currentZoom = Math.min(maxZoom, Math.max(minZoom, Math.round(newZoom * 10) / 10));
                if (slideImageWrapper) {
                    slideImageWrapper.style.transform = `scale(${currentZoom})`;
                    slideImageWrapper.style.transformOrigin = 'center center';
                    slideImageWrapper.style.transition = 'transform 0.2s cubic-bezier(0.2, 0.8, 0.2, 1)';
                }
                if (zoomLevelBadge) {
                    zoomLevelBadge.textContent = `${Math.round(currentZoom * 100)}%`;
                }
            }

            if (zoomInBtn) {
                zoomInBtn.addEventListener('click', () => applyZoom(currentZoom + zoomStep));
            }
            if (zoomOutBtn) {
                zoomOutBtn.addEventListener('click', () => applyZoom(currentZoom - zoomStep));
            }
            if (zoomResetBtn) {
                zoomResetBtn.addEventListener('click', () => applyZoom(1.0));
            }

            // Mouse wheel zoom (Ctrl + Wheel or standard pinch)
            const slideStage = document.getElementById('slideStage');
            if (slideStage) {
                slideStage.addEventListener('wheel', (e) => {
                    if (e.ctrlKey || e.metaKey) {
                        e.preventDefault();
                        if (e.deltaY < 0) {
                            applyZoom(currentZoom + 0.1);
                        } else {
                            applyZoom(currentZoom - 0.1);
                        }
                    }
                }, { passive: false });
            }

            // When slide changes, reset zoom and update for the new active slide
            const originalShowSlide = showSlide;
            showSlide = function(idx) {
                stopSpeech();
                applyZoom(1.0); // Reset zoom on new slide
                if (hoverReadOverlay) hoverReadOverlay.innerHTML = '';

                // Remember if panels were open so we can re-populate them for the new slide
                const wasSpeechPanelVisible = speechControlsBar && speechControlsBar.style.display === 'flex';

                originalShowSlide(idx);

                // If the Lesson Text / Read All panel was visible, auto-load the new slide's content
                if (wasSpeechPanelVisible && speechControlsBar) {
                    const activeThumb = thumbs[idx];
                    const caption = activeThumb.getAttribute('data-caption') || '';
                    const imgSrc = activeThumb.getAttribute('data-src');
                    const manifest = findSlideManifest(caption, imgSrc, idx);

                    if (manifest && manifest.segments && manifest.segments.length > 0) {
                        speechStatusTitle.textContent = manifest.title || 'Lesson Text Output';
                        updateSpeechOutputDisplay(manifest.title, manifest.segments);
                    } else {
                        // No pre-verified manifest: run live OCR for this slide
                        performOcrAndSpeak(imgSrc, idx);
                    }
                }

                // If Point & Read hover mode was active, rebuild hover boxes for the new slide
                if (isHoverReadActive) {
                    const activeThumb = thumbs[idx];
                    const imgSrc = activeThumb.getAttribute('data-src');
                    buildHoverBoxesForSlide(imgSrc, idx);
                }
            };
        });
    </script>
</body>
</html>
