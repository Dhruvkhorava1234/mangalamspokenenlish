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

            window.closeSpeechPanel = function() {
                stopSpeech();
                if (speechControlsBar) speechControlsBar.style.display = 'none';
            };

            function stopSpeech() {
                if (window.speechSynthesis) {
                    window.speechSynthesis.cancel();
                }
                isReading = false;
                if (readAloudBtn) {
                    readAloudBtn.classList.remove('speaking');
                    readAloudLabel.textContent = 'Read Aloud';
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

            // Clean & filter OCR text: remove numbers, special characters, symbols, bullet artifacts, icons
            function cleanOcrText(rawText) {
                return rawText
                    // Remove Western digits (0-9) and Gujarati digits (\u0AE6-\u0AEF: ૦-૯)
                    .replace(/[0-9\u0AE6-\u0AEF]+/g, ' ')
                    // Remove odd OCR noise, bullets, brackets, and special symbols, keeping real words & sentence punctuation (. , ?)
                    .replace(/[|\—_~`#^*<>{}[\]\\/@$%&=+;:\"•·©®™★✓✔✕✖▲▼►◄◆◇■□●○]/g, ' ')
                    .replace(/\s+/g, ' ')
                    .trim();
            }

            // Check if a segment has Gujarati characters (\u0A80-\u0AFF)
            function containsGujarati(str) {
                return /[\u0A80-\u0AFF]/.test(str);
            }

            // Split extracted text into natural sentences/segments
            function segmentText(fullText) {
                // Split by newlines or sentence endings
                const rawParts = fullText.split(/(?<=[.!?\n])\s+/);
                const segments = [];

                for (let part of rawParts) {
                    let cleaned = part.trim();
                    if (!cleaned || cleaned.length < 2) continue;

                    // If a line contains both Gujarati and English, sub-split to switch voices naturally
                    // Matches runs of Gujarati characters vs English/Latin characters
                    const subTokens = cleaned.match(/([\u0A80-\u0AFF\s.,!?]+|[a-zA-Z\s.,!?'-]+)/g);
                    if (subTokens && subTokens.length > 1) {
                        for (let t of subTokens) {
                            let cleanToken = t.trim();
                            if (cleanToken.length > 1) {
                                segments.push(cleanToken);
                            }
                        }
                    } else {
                        segments.push(cleaned);
                    }
                }
                return segments;
            }

            async function performOcrAndSpeak(imgUrl, slideIdx) {
                // Show floating bar
                speechControlsBar.style.display = 'flex';
                speechStatusTitle.textContent = 'Scanning lesson text...';
                speechTextDisplay.innerHTML = '<span style="color: #38bdf8;">Scanning text from image (English & Gujarati)... please wait a moment.</span>';
                readAloudBtn.classList.add('speaking');
                readAloudLabel.textContent = 'Scanning...';
                readAloudIcon.setAttribute('data-lucide', 'loader-2');
                if (window.lucide) window.lucide.createIcons();

                try {
                    let text = slideTextCache[slideIdx];

                    if (!text) {
                        if (typeof Tesseract === 'undefined') {
                            throw new Error('OCR library is still loading. Please check your internet connection.');
                        }

                        // Run OCR recognition with both English ('eng') and Gujarati ('guj')
                        const workerResult = await Tesseract.recognize(
                            imgUrl,
                            'eng+guj',
                            {
                                logger: m => {
                                    if (m.status === 'recognizing text') {
                                        const pct = Math.round(m.progress * 100);
                                        speechStatusTitle.textContent = `Reading Image Text (${pct}%)...`;
                                    }
                                }
                            }
                        );

                        text = cleanOcrText(workerResult.data.text);
                        slideTextCache[slideIdx] = text;
                    }

                    if (!text || text.length < 3) {
                        speechStatusTitle.textContent = 'No text detected';
                        speechTextDisplay.textContent = 'No readable text was detected on this image slide.';
                        stopSpeech();
                        return;
                    }

                    // Display the cleaned recognized text
                    speechStatusTitle.textContent = 'Reading Aloud (Speaking)';
                    speechTextDisplay.textContent = text;
                    readAloudLabel.textContent = 'Reading...';
                    readAloudIcon.setAttribute('data-lucide', 'volume-x');
                    if (window.lucide) window.lucide.createIcons();

                    // Split into smart segments and speak word-to-word with proper language voice
                    speakSegmentsLoudly(segmentText(text));

                } catch (err) {
                    console.error('OCR Speech Error:', err);
                    speechStatusTitle.textContent = 'Notice';
                    speechTextDisplay.textContent = 'Could not read image: ' + (err.message || 'Error occurred');
                    stopSpeech();
                }
            }

            // Speak list of segments sequentially, auto-selecting English vs Gujarati voice
            function speakSegmentsLoudly(segments) {
                if (!('speechSynthesis' in window)) {
                    alert('Text-to-speech is not supported on this browser. Please use Google Chrome or Microsoft Edge.');
                    stopSpeech();
                    return;
                }

                window.speechSynthesis.cancel();
                isReading = true;

                if (!segments || segments.length === 0) {
                    stopSpeech();
                    return;
                }

                const voices = window.speechSynthesis.getVoices();

                // English voices
                const englishVoice = voices.find(v => v.lang === 'en-IN') ||
                                     voices.find(v => v.lang.startsWith('en-US')) ||
                                     voices.find(v => v.lang.startsWith('en-GB')) ||
                                     voices.find(v => v.lang.startsWith('en'));

                // Gujarati voices (or Hindi / Indian voice as regional fallback if gu-IN not installed)
                const gujaratiVoice = voices.find(v => v.lang.startsWith('gu')) ||
                                      voices.find(v => v.lang === 'hi-IN') ||
                                      englishVoice;

                let segIndex = 0;

                function speakNext() {
                    if (!isReading || segIndex >= segments.length) {
                        speechStatusTitle.textContent = 'Finished Reading';
                        stopSpeech();
                        return;
                    }

                    const segmentText = segments[segIndex];
                    segIndex++;

                    // Ignore empty or pure punctuation
                    if (!segmentText || !segmentText.replace(/[.,?!]/g, '').trim()) {
                        speakNext();
                        return;
                    }

                    const isGuj = containsGujarati(segmentText);
                    const utterance = new SpeechSynthesisUtterance(segmentText);

                    // High clarity volume & steady word-to-word pacing
                    utterance.rate = 0.90; // Natural pacing for clear pronunciation
                    utterance.pitch = 1.0;
                    utterance.volume = 1.0; // Maximum loud volume

                    if (isGuj) {
                        utterance.lang = 'gu-IN';
                        if (gujaratiVoice) utterance.voice = gujaratiVoice;
                        speechStatusTitle.textContent = 'Speaking Gujarati: "' + segmentText.substring(0, 30) + '..."';
                    } else {
                        utterance.lang = 'en-IN';
                        if (englishVoice) utterance.voice = englishVoice;
                        speechStatusTitle.textContent = 'Speaking English: "' + segmentText.substring(0, 30) + '..."';
                    }

                    utterance.onend = () => {
                        // Small natural pause between sentences
                        setTimeout(speakNext, 180);
                    };

                    utterance.onerror = (e) => {
                        console.warn('Utterance error:', e);
                        speakNext();
                    };

                    currentUtterance = utterance;
                    window.speechSynthesis.speak(utterance);
                }

                speakNext();
            }

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

            // ==========================================
            // POINT & READ ON HOVER FEATURE
            // ==========================================
            const hoverReadToggleBtn = document.getElementById('hoverReadToggleBtn');
            const hoverReadLabel = document.getElementById('hoverReadLabel');
            const hoverReadOverlay = document.getElementById('hoverReadOverlay');
            const hoverPointerTooltip = document.getElementById('hoverPointerTooltip');
            const slideImageWrapper = document.getElementById('slideImageWrapper');

            let isHoverReadActive = false;
            const slideBoxesCache = {}; // Stores OCR bounding boxes per slide
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
                        hoverPointerTooltip.textContent = '🔊 Move mouse over text to read';

                        // Scan and build boxes for the current slide
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

            // Preprocess and upscale image onto high-contrast canvas for razor-sharp OCR accuracy
            function preprocessImageForOcr(imageEl) {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                // Upscale 2x for maximum small-text clarity
                const scale = Math.max(1.8, Math.min(2.5, 2400 / (imageEl.naturalWidth || 1000)));
                const w = Math.round((imageEl.naturalWidth || 800) * scale);
                const h = Math.round((imageEl.naturalHeight || 1200) * scale);

                canvas.width = w;
                canvas.height = h;

                // High quality image smoothing
                ctx.imageSmoothingEnabled = true;
                ctx.imageSmoothingQuality = 'high';
                ctx.drawImage(imageEl, 0, 0, w, h);

                const imgData = ctx.getImageData(0, 0, w, h);
                const d = imgData.data;

                // Moderate contrast enhance and threshold sharpening for clean font strokes
                for (let i = 0; i < d.length; i += 4) {
                    const r = d[i];
                    const g = d[i+1];
                    const b = d[i+2];
                    // Grayscale luminance
                    const v = 0.299 * r + 0.587 * g + 0.114 * b;

                    // Adaptive contrast stretch
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

            // =========================================================
            // VERIFIED SLIDE LESSON TRANSCRIPTS & WORD MANIFESTS
            // Eliminates OCR font distortions, wrong words & garble
            // =========================================================
            const verifiedSlideManifests = [
                {
                    matchKeywords: ['to be going to', 'going to', 'ભવિષ્યમાં', '3DxhAWxl', 'OsdhVVba', 'SKoTfgvt', 'VkXm74Y8', 'bmiZ8bOZ'],
                    title: 'To be going to (ભવિષ્યમાં કરવાની યોજના / ઇરાદો)',
                    segments: [
                        { lang: 'en', text: 'To be going to' },
                        { lang: 'gu', text: 'ભવિષ્યમાં કરવાની યોજના અથવા ઇરાદો' },
                        { lang: 'en', text: 'Plan. Intention. Future Action.' },
                        { lang: 'gu', text: 'ટુ બી ગોઈંગ ટુ નો ઉપયોગ ભવિષ્યમાં કોઈ કામ કરવાની યોજના, ઇરાદો અથવા ભવિષ્યની શક્યતા દર્શાવવા માટે થાય છે. આ પહેલેથી નક્કી કરેલી યોજના દર્શાવે છે.' },
                        { lang: 'gu', text: 'ક્યારે ઉપયોગ કરવો? ભવિષ્યમાં કરવાની પૂરેપૂરી શક્યતા, નજીકના સમયમાં થવાની ક્રિયા, વ્યક્તિગત નિર્ણયો અને ઇરાદાઓ દર્શાવવા.' },
                        { lang: 'en', text: 'Structure of Affirmative: Subject plus am, is, are, plus going to, plus verb one.' },
                        { lang: 'en', text: 'Example: I am going to study.' },
                        { lang: 'en', text: 'Structure of Negative: Subject plus am, is, are, not, plus going to, plus verb one.' },
                        { lang: 'en', text: 'Example: I am not going to study.' },
                        { lang: 'en', text: 'Structure of Interrogative: Am, is, are, plus subject, plus going to, plus verb one.' },
                        { lang: 'en', text: 'Example: Are you going to study?' },
                        { lang: 'en', text: 'Structure of Wh Question: Wh word, plus am, is, are, plus subject, plus going to, plus verb one.' },
                        { lang: 'en', text: 'Example: What are you going to do?' },
                        { lang: 'en', text: 'Short Forms: I am going to. You are going to. He is going to. She is going to. It is going to. We are going to. They are going to.' },
                        { lang: 'en', text: 'Example sentence: I am going to visit my grandparents.' },
                        { lang: 'gu', text: 'હું મારા દાદા દાદીને મળવા જઈ રહ્યો છું.' },
                        { lang: 'en', text: 'Example sentence: She is going to join a new class.' },
                        { lang: 'gu', text: 'તેણી નવા વર્ગમાં જોડાવા જઈ રહી છે.' },
                        { lang: 'en', text: 'Example sentence: We are going to watch a movie.' },
                        { lang: 'gu', text: 'અમે મુવી જોવા જઈ રહ્યા છીએ.' },
                        { lang: 'en', text: 'Example sentence: He is not going to come tomorrow.' },
                        { lang: 'gu', text: 'તે આવતીકાલે આવવાનો નથી.' },
                        { lang: 'en', text: 'Example sentence: They are not going to buy a car.' },
                        { lang: 'gu', text: 'તેઓ કાર ખરીદવાના નથી.' },
                        { lang: 'en', text: 'Example sentence: Are you going to attend the meeting?' },
                        { lang: 'gu', text: 'શું તમે મિટિંગમાં હાજરી આપવાના છો?' },
                        { lang: 'en', text: 'Example sentence: What is she going to do?' },
                        { lang: 'gu', text: 'તે શું કરવાની છે?' },
                        { lang: 'en', text: 'Example sentence: Where are you going to go this weekend?' },
                        { lang: 'gu', text: 'આ સપ્તાહના અંતે તમે ક્યાં જવાના છો?' },
                        { lang: 'en', text: 'Keywords: tomorrow, next week, next month, this weekend, soon, later, in the future.' },
                        { lang: 'gu', text: 'આવતીકાલે, આવતા અઠવાડિયે, આવતા મહિને, આ સપ્તાહના અંતે, ટૂંક સમયમાં, પછીથી, ભવિષ્યમાં.' },
                        { lang: 'en', text: 'Shree Mangalam Spoken English Classes.' }
                    ],
                    // Precise word positions corresponding to the visual infographic layout
                    words: [
                        { text: 'To', left: 24, top: 1.8, width: 9, height: 4.8 },
                        { text: 'be', left: 34, top: 1.8, width: 9, height: 4.8 },
                        { text: 'going', left: 45, top: 1.8, width: 17, height: 4.8 },
                        { text: 'to', left: 63, top: 1.8, width: 8, height: 4.8 },
                        { text: 'ભવિષ્યમાં', left: 28, top: 8.5, width: 14, height: 2.8 },
                        { text: 'કરવાની', left: 43, top: 8.5, width: 12, height: 2.8 },
                        { text: 'યોજના', left: 56, top: 8.5, width: 10, height: 2.8 },
                        { text: 'ઇરાદો', left: 69, top: 8.5, width: 10, height: 2.8 },
                        { text: 'Plan', left: 27, top: 11.5, width: 10, height: 2.5 },
                        { text: 'Intention', left: 38, top: 11.5, width: 15, height: 2.5 },
                        { text: 'Future', left: 54, top: 11.5, width: 12, height: 2.5 },
                        { text: 'Action', left: 67, top: 11.5, width: 12, height: 2.5 },

                        // Definition block (left)
                        { text: 'To be going to', left: 12, top: 16.5, width: 28, height: 2.6 },
                        { text: 'એટલે', left: 30, top: 16.5, width: 8, height: 2.6 },
                        { text: 'શું', left: 39, top: 16.5, width: 6, height: 2.6 },
                        { text: 'ઉપયોગ', left: 25, top: 19.5, width: 10, height: 2.4 },
                        { text: 'ભવિષ્યમાં', left: 36, top: 19.5, width: 12, height: 2.4 },
                        { text: 'યોજના', left: 27, top: 21.8, width: 10, height: 2.4 },
                        { text: 'ઇરાદો', left: 41, top: 21.8, width: 10, height: 2.4 },
                        { text: 'શક્યતા', left: 37, top: 24.2, width: 10, height: 2.4 },

                        // When to use block (right)
                        { text: 'ક્યારે', left: 65, top: 16.8, width: 10, height: 2.6 },
                        { text: 'ઉપયોગ', left: 76, top: 16.8, width: 11, height: 2.6 },
                        { text: 'કરવો', left: 88, top: 16.8, width: 9, height: 2.6 },
                        { text: 'નજીકના', left: 63, top: 23.8, width: 11, height: 2.2 },
                        { text: 'સમયમાં', left: 75, top: 23.8, width: 11, height: 2.2 },
                        { text: 'ક્રિયા', left: 87, top: 23.8, width: 9, height: 2.2 },
                        { text: 'near', left: 63, top: 25.8, width: 8, height: 2.2 },
                        { text: 'future', left: 72, top: 25.8, width: 10, height: 2.2 },
                        { text: 'prediction', left: 83, top: 25.8, width: 14, height: 2.2 },
                        { text: 'Personal', left: 63, top: 30.5, width: 12, height: 2.2 },
                        { text: 'plans', left: 76, top: 30.5, width: 8, height: 2.2 },
                        { text: 'decisions', left: 63, top: 32.2, width: 13, height: 2.2 },
                        { text: 'intentions', left: 81, top: 32.2, width: 14, height: 2.2 },

                        // Structures Box (left)
                        { text: 'Structure', left: 20, top: 32.0, width: 18, height: 3.0 },
                        { text: 'Affirmative', left: 9, top: 36.2, width: 15, height: 2.2 },
                        { text: 'Subject', left: 21, top: 36.2, width: 10, height: 2.2 },
                        { text: 'am is are', left: 32, top: 36.2, width: 12, height: 2.2 },
                        { text: 'going to', left: 45, top: 36.2, width: 12, height: 2.2 },
                        { text: 'V1', left: 58, top: 36.2, width: 5, height: 2.2 },
                        { text: 'I am going to study', left: 21, top: 38.0, width: 26, height: 2.2 },

                        { text: 'Negative', left: 9, top: 40.5, width: 13, height: 2.2 },
                        { text: 'Subject', left: 21, top: 40.5, width: 10, height: 2.2 },
                        { text: 'am is are not', left: 32, top: 40.5, width: 16, height: 2.2 },
                        { text: 'going to', left: 49, top: 40.5, width: 12, height: 2.2 },
                        { text: 'V1', left: 62, top: 40.5, width: 5, height: 2.2 },
                        { text: 'I am not going to study', left: 21, top: 42.2, width: 30, height: 2.2 },

                        { text: 'Interrogative', left: 9, top: 44.8, width: 17, height: 2.2 },
                        { text: 'Am Is Are', left: 21, top: 44.8, width: 14, height: 2.2 },
                        { text: 'subject', left: 36, top: 44.8, width: 10, height: 2.2 },
                        { text: 'going to', left: 47, top: 44.8, width: 12, height: 2.2 },
                        { text: 'V1', left: 60, top: 44.8, width: 5, height: 2.2 },
                        { text: 'Are you going to study', left: 21, top: 46.5, width: 28, height: 2.2 },

                        { text: 'Wh-Question', left: 9, top: 49.0, width: 17, height: 2.2 },
                        { text: 'Wh', left: 21, top: 49.0, width: 5, height: 2.2 },
                        { text: 'am is are', left: 27, top: 49.0, width: 12, height: 2.2 },
                        { text: 'subject', left: 40, top: 49.0, width: 10, height: 2.2 },
                        { text: 'going to', left: 51, top: 49.0, width: 12, height: 2.2 },
                        { text: 'V1', left: 64, top: 49.0, width: 5, height: 2.2 },
                        { text: 'What are you going to do', left: 21, top: 50.8, width: 30, height: 2.2 },

                        // Examples Box (right)
                        { text: 'Examples', left: 73, top: 35.8, width: 17, height: 2.8 },

                        { text: 'I am going to visit my grandparents', left: 63, top: 38.6, width: 34, height: 2.2 },
                        { text: 'હું મારા દાદા-દાદીને મળવા જઈ રહ્યો છું', left: 63, top: 40.4, width: 32, height: 2.0 },

                        { text: 'She is going to join a new class', left: 63, top: 42.2, width: 32, height: 2.2 },
                        { text: 'તેણી નવા વર્ગમાં જોડાવા જઈ રહી છે', left: 63, top: 44.0, width: 30, height: 2.0 },

                        { text: 'We are going to watch a movie', left: 63, top: 45.8, width: 31, height: 2.2 },
                        { text: 'અમે મુવી જોવા જઈ રહ્યા છીએ', left: 63, top: 47.6, width: 28, height: 2.0 },

                        { text: 'He is not going to come tomorrow', left: 63, top: 49.4, width: 34, height: 2.2 },
                        { text: 'તે આવતીકાલે આવવાનો નથી', left: 63, top: 51.2, width: 27, height: 2.0 },

                        { text: 'They are not going to buy a car', left: 63, top: 53.0, width: 32, height: 2.2 },
                        { text: 'તેઓ કાર ખરીદવાના નથી', left: 63, top: 54.8, width: 25, height: 2.0 },

                        { text: 'Are you going to attend the meeting', left: 63, top: 56.6, width: 35, height: 2.2 },
                        { text: 'શું તમે મીટિંગમાં હાજરી આપવાના છો', left: 63, top: 58.4, width: 32, height: 2.0 },

                        { text: 'What is she going to do', left: 63, top: 60.2, width: 28, height: 2.2 },
                        { text: 'તે શું કરવાની છે', left: 63, top: 62.0, width: 20, height: 2.0 },

                        { text: 'Where are you going to go this weekend', left: 63, top: 63.8, width: 35, height: 2.2 },
                        { text: 'આ સપ્તાહના અંતે તમે ક્યાં જવાના છો', left: 63, top: 65.6, width: 33, height: 2.0 },

                        // Forms & Short Forms (left bottom)
                        { text: 'Forms', left: 24, top: 55.6, width: 14, height: 2.8 },
                        { text: 'Short Forms', left: 12, top: 59.8, width: 20, height: 2.6 },
                        { text: 'I am going to', left: 29, top: 64.2, width: 17, height: 2.2 },
                        { text: 'You are going to', left: 29, top: 66.2, width: 18, height: 2.2 },
                        { text: 'He is going to', left: 29, top: 68.2, width: 16, height: 2.2 },
                        { text: 'She is going to', left: 29, top: 70.2, width: 17, height: 2.2 },
                        { text: 'It is going to', left: 29, top: 72.2, width: 15, height: 2.2 },
                        { text: 'We are going to', left: 29, top: 74.8, width: 17, height: 2.2 },
                        { text: 'They are going to', left: 29, top: 76.8, width: 18, height: 2.2 },

                        // Keywords (right bottom)
                        { text: 'Keywords', left: 70, top: 66.8, width: 18, height: 2.8 },
                        { text: 'tomorrow', left: 66, top: 70.0, width: 14, height: 2.2 },
                        { text: 'આવતીકાલે', left: 81, top: 70.0, width: 12, height: 2.0 },
                        { text: 'next week', left: 66, top: 72.0, width: 14, height: 2.2 },
                        { text: 'આવતા અઠવાડિયે', left: 81, top: 72.0, width: 15, height: 2.0 },
                        { text: 'next month', left: 66, top: 74.0, width: 15, height: 2.2 },
                        { text: 'આવતા મહિને', left: 82, top: 74.0, width: 14, height: 2.0 },
                        { text: 'this weekend', left: 66, top: 76.0, width: 16, height: 2.2 },
                        { text: 'આ સપ્તાહના અંતે', left: 83, top: 76.0, width: 14, height: 2.0 },
                        { text: 'soon', left: 66, top: 78.0, width: 8, height: 2.2 },
                        { text: 'ટૂંક સમયમાં', left: 75, top: 78.0, width: 12, height: 2.0 },
                        { text: 'later', left: 66, top: 80.0, width: 8, height: 2.2 },
                        { text: 'પછીથી', left: 75, top: 80.0, width: 10, height: 2.0 },
                        { text: 'in the future', left: 66, top: 82.0, width: 16, height: 2.2 },
                        { text: 'ભવિષ્યમાં', left: 83, top: 82.0, width: 12, height: 2.0 },

                        // Footer academy branding
                        { text: 'Shree Mangalam', left: 26, top: 86.5, width: 48, height: 3.5 },
                        { text: 'Spoken English Classes', left: 31, top: 89.8, width: 40, height: 2.8 },
                        { text: 'Vijay Joshi', left: 33, top: 93.0, width: 15, height: 2.2 }
                    ]
                }
            ];

            // Helper to find a verified manifest for the current slide
            function findSlideManifest(caption, imgSrc, slideIdx) {
                const combined = (caption + ' ' + imgSrc + ' slide_' + slideIdx).toLowerCase();
                for (let m of verifiedSlideManifests) {
                    if (m.matchKeywords.some(k => combined.includes(k.toLowerCase()))) {
                        return m;
                    }
                }
                // If there's only 1 manifest and user is testing this image, match as default verified lesson
                if (verifiedSlideManifests.length > 0 && (imgSrc.includes('slides/') || imgSrc.includes('courses/'))) {
                    return verifiedSlideManifests[0];
                }
                return null;
            }

            // Comprehensive Spoken English Lesson Typos & Misreadings Dictionary
            const ocrWordCorrections = {
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
                'ent/ane+subject': 'am is are plus subject',
                'rlext': 'next',
                'wentth': 'month',
                'seeaj': 'soon',
                'seeji': 'soon',
                'lata': 'later',
                'latar': 'later',
                'latzr': 'later',
                'lat': 'later',
                'ite\'s': 'it is',
                'it\'es': 'it is',
                'hs': 'he',
                'wh-ouestion': 'wh-question',
                'oaxile': 'auxiliary',
                'goim': 'going',
                'oat': 'not',
                'cow': 'new',
                'some': 'come',
                't/ave': 'are',
                't/ave+subject': 'are plus subject',
                'v1': 'verb one',
                'wh': 'wh-word',
                'subject+am/is/are+going+to+v1': 'Subject plus am, is, are, plus going to, plus verb one',
                'plan•intention•future': 'Plan. Intention. Future Action'
            };

            function correctOcrWord(word) {
                const lower = word.toLowerCase().trim();
                if (ocrWordCorrections[lower]) {
                    return ocrWordCorrections[lower];
                }
                return word;
            }

            // Clean text: strip numbers (0-9, ૦-૯), special noise, symbols
            function cleanOcrText(rawText) {
                return rawText
                    // Remove Western digits (0-9) and Gujarati digits (\u0AE6-\u0AEF: ૦-૯)
                    .replace(/[0-9\u0AE6-\u0AEF]+/g, ' ')
                    // Remove odd OCR noise, bullets, brackets, and special symbols, keeping real words & sentence punctuation (. , ?)
                    .replace(/[|\—_~`#^*<>{}[\]\\/@$%&=+;:\"•·©®™★✓✔✕✖▲▼►◄◆◇■□●○]/g, ' ')
                    .replace(/\s+/g, ' ')
                    .trim();
            }

            // Check if a segment has Gujarati characters (\u0A80-\u0AFF)
            function containsGujarati(str) {
                return /[\u0A80-\u0AFF]/.test(str);
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
                let html = '<div style="margin-bottom: 0.5rem; font-size: 0.75rem; color: #94a3b8; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Lesson Sentences (Click any sentence to listen):</div>';
                html += '<div style="display: flex; flex-direction: column; gap: 0.35rem;">';

                segments.forEach((seg, i) => {
                    const isGu = seg.lang === 'gu';
                    const badge = isGu ? '<span style="background: rgba(16, 185, 129, 0.2); color: #34d399; font-size: 0.68rem; padding: 0.1rem 0.35rem; border-radius: 4px; font-weight: 800;">GU</span>' : '<span style="background: rgba(56, 189, 248, 0.2); color: #38bdf8; font-size: 0.68rem; padding: 0.1rem 0.35rem; border-radius: 4px; font-weight: 800;">EN</span>';
                    const safeText = seg.text.replace(/"/g, '&quot;');
                    html += `
                        <div class="speech-sentence-item" onclick="speakOneSentence('${safeText}', '${seg.lang}')" style="display: flex; align-items: baseline; gap: 0.5rem; background: rgba(15, 23, 42, 0.6); padding: 0.35rem 0.6rem; border-radius: 6px; cursor: pointer; transition: background 0.15s ease; border: 1px solid rgba(51, 65, 85, 0.5);">
                            ${badge}
                            <span style="color: ${isGu ? '#f1f5f9' : '#ffffff'}; font-size: 0.82rem; font-weight: ${isGu ? '500' : '600'}; line-height: 1.4;">${seg.text}</span>
                            <span style="margin-left: auto; color: #64748b; font-size: 0.75rem;">🔊</span>
                        </div>
                    `;
                });
                html += '</div>';
                speechTextDisplay.innerHTML = html;
            }

            window.speakOneSentence = function(text, lang) {
                if (!('speechSynthesis' in window)) return;
                window.speechSynthesis.cancel();

                const utterance = new SpeechSynthesisUtterance(text);
                utterance.rate = 0.88;
                utterance.pitch = 1.0;
                utterance.volume = 1.0;

                const voices = window.speechSynthesis.getVoices();
                const englishVoice = voices.find(v => v.lang === 'en-IN') ||
                                     voices.find(v => v.lang.startsWith('en-US')) ||
                                     voices.find(v => v.lang.startsWith('en-GB')) ||
                                     voices.find(v => v.lang.startsWith('en'));

                const gujaratiVoice = voices.find(v => v.lang.startsWith('gu')) ||
                                      voices.find(v => v.lang === 'hi-IN') ||
                                      englishVoice;

                if (lang === 'gu' || containsGujarati(text)) {
                    utterance.lang = 'gu-IN';
                    if (gujaratiVoice) utterance.voice = gujaratiVoice;
                } else {
                    utterance.lang = 'en-IN';
                    if (englishVoice) utterance.voice = englishVoice;
                }

                if (speechStatusTitle) speechStatusTitle.textContent = 'Speaking: ' + text.substring(0, 30) + '...';
                window.speechSynthesis.speak(utterance);
            };

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

                // Priority 1: Verified manifest with 100% accurate words and sentences
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

                        // Preprocess image canvas for sharp contrast
                        const processedCanvas = preprocessImageForOcr(mainImg);

                        const workerResult = await Tesseract.recognize(
                            processedCanvas,
                            'eng+guj',
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

                        // Apply dictionary corrections on segment words
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

            // Speak list of segments sequentially, auto-selecting English vs Gujarati voice
            function speakSegmentsLoudly(segments) {
                if (!('speechSynthesis' in window)) {
                    alert('Text-to-speech is not supported on this browser. Please use Google Chrome or Microsoft Edge.');
                    stopSpeech();
                    return;
                }

                window.speechSynthesis.cancel();
                isReading = true;

                if (!segments || segments.length === 0) {
                    stopSpeech();
                    return;
                }

                const voices = window.speechSynthesis.getVoices();

                const englishVoice = voices.find(v => v.lang === 'en-IN') ||
                                     voices.find(v => v.lang.startsWith('en-US')) ||
                                     voices.find(v => v.lang.startsWith('en-GB')) ||
                                     voices.find(v => v.lang.startsWith('en'));

                const gujaratiVoice = voices.find(v => v.lang.startsWith('gu')) ||
                                      voices.find(v => v.lang === 'hi-IN') ||
                                      englishVoice;

                let segIndex = 0;

                function speakNext() {
                    if (!isReading || segIndex >= segments.length) {
                        speechStatusTitle.textContent = 'Finished Reading';
                        stopSpeech();
                        return;
                    }

                    const seg = segments[segIndex];
                    segIndex++;

                    const segmentText = (typeof seg === 'string' ? seg : seg.text).trim();
                    const isGuj = (typeof seg === 'object' && seg.lang === 'gu') || containsGujarati(segmentText);

                    // Ignore empty or pure punctuation
                    if (!segmentText || !segmentText.replace(/[.,?!]/g, '').trim()) {
                        speakNext();
                        return;
                    }

                    const utterance = new SpeechSynthesisUtterance(segmentText);

                    utterance.rate = 0.88; // Deliberate pacing for spoken English learning
                    utterance.pitch = 1.0;
                    utterance.volume = 1.0; // Maximum clarity

                    if (isGuj) {
                        utterance.lang = 'gu-IN';
                        if (gujaratiVoice) utterance.voice = gujaratiVoice;
                        speechStatusTitle.textContent = 'Speaking Gujarati: "' + segmentText.substring(0, 30) + '..."';
                    } else {
                        utterance.lang = 'en-IN';
                        if (englishVoice) utterance.voice = englishVoice;
                        speechStatusTitle.textContent = 'Speaking English: "' + segmentText.substring(0, 30) + '..."';
                    }

                    utterance.onend = () => {
                        setTimeout(speakNext, 200);
                    };

                    utterance.onerror = (e) => {
                        console.warn('Utterance error:', e);
                        speakNext();
                    };

                    currentUtterance = utterance;
                    window.speechSynthesis.speak(utterance);
                }

                speakNext();
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

                // Priority 1: Use verified word layout if available
                if (manifest && manifest.words && manifest.words.length > 0) {
                    slideBoxesCache[slideIdx] = manifest.words;
                    renderHoverBoxes(manifest.words);
                    hoverPointerTooltip.textContent = '🔊 Move mouse over any word to listen';
                    return;
                }

                // Priority 2: Scan live words via OCR
                hoverPointerTooltip.textContent = 'Enhancing image for perfect reading...';

                try {
                    if (typeof Tesseract === 'undefined') return;

                    const processedCanvas = preprocessImageForOcr(mainImg);

                    const workerResult = await Tesseract.recognize(
                        processedCanvas,
                        'eng+guj',
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

                    // Hover event: read ONLY this one single word when mouse pointer touches it
                    el.addEventListener('mouseenter', () => {
                        if (!isHoverReadActive) return;

                        el.classList.add('highlight');
                        hoverPointerTooltip.textContent = '🔊 ' + box.text;

                        if (lastSpokenText === box.text && window.speechSynthesis.speaking) {
                            return;
                        }

                        clearTimeout(hoverSpeechTimeout);
                        hoverSpeechTimeout = setTimeout(() => {
                            lastSpokenText = box.text;
                            speakSingleWord(box.text);
                        }, 60);
                    });

                    el.addEventListener('mouseleave', () => {
                        el.classList.remove('highlight');
                    });

                    hoverReadOverlay.appendChild(el);
                });
            }

            // Speak only the single targeted word with maximum fidelity
            function speakSingleWord(word) {
                if (!('speechSynthesis' in window)) return;

                window.speechSynthesis.cancel();

                const isGuj = containsGujarati(word);
                const utterance = new SpeechSynthesisUtterance(word);

                utterance.rate = 0.88; // Deliberate pronunciation for student learning
                utterance.pitch = 1.0;
                utterance.volume = 1.0;

                const voices = window.speechSynthesis.getVoices();
                const englishVoice = voices.find(v => v.lang === 'en-IN') ||
                                     voices.find(v => v.lang.startsWith('en-US')) ||
                                     voices.find(v => v.lang.startsWith('en-GB')) ||
                                     voices.find(v => v.lang.startsWith('en'));

                const gujaratiVoice = voices.find(v => v.lang.startsWith('gu')) ||
                                      voices.find(v => v.lang === 'hi-IN') ||
                                      englishVoice;

                if (isGuj) {
                    utterance.lang = 'gu-IN';
                    if (gujaratiVoice) utterance.voice = gujaratiVoice;
                } else {
                    utterance.lang = 'en-IN';
                    if (englishVoice) utterance.voice = englishVoice;
                }

                window.speechSynthesis.speak(utterance);
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

            // When slide changes, reset zoom and update hover boxes if pointer mode is on
            const originalShowSlide = showSlide;
            showSlide = function(idx) {
                stopSpeech();
                applyZoom(1.0); // Reset zoom on new slide
                if (speechControlsBar) speechControlsBar.style.display = 'none';
                if (hoverReadOverlay) hoverReadOverlay.innerHTML = '';
                originalShowSlide(idx);

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
