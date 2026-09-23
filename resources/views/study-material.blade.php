@extends('layouts.app')

@section('title', 'Study Material | Shree Mangalam Spoken English Classes')

@section('content')
    <!-- Page Banner Header -->
    <section class="page-banner">
        <div class="container">
            <div class="page-banner-content">
                <span class="page-banner-badge">Our Unique Advantage</span>
                <h1 class="page-banner-title">Image-Based Study Material</h1>
                <p class="page-banner-sub">
                    Scientifically crafted books, charts, and flash notes that make remembering English grammar effortless for Gujarati speakers.
                </p>
                <div class="breadcrumbs">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span class="active">Study Material</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Visual Learning Philosophy -->
    <section class="features-section" style="padding-bottom: 2rem;">
        <div class="container">
            <div class="section-head-center">
                <h2 class="section-title">Why Image-Based Learning Works</h2>
                <div class="center-line"></div>
                <p class="section-head-subtitle">
                    The human brain processes visual information 60,000 times faster than raw text. Here is how our custom materials accelerate your learning.
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-item f-blue">
                    <div class="feature-icon-circle">
                        <i data-lucide="brain" style="width: 1.75rem; height: 1.75rem;"></i>
                    </div>
                    <div>
                        <h3 class="feature-title">Long-Term Memory Recall</h3>
                        <p class="feature-subtitle sub-blue">Picture Associations</p>
                        <p class="feature-detail">Associate prepositions and verbs with memorable graphics rather than dry definitions.</p>
                    </div>
                </div>

                <div class="feature-item f-green">
                    <div class="feature-icon-circle">
                        <i data-lucide="book-check" style="width: 1.75rem; height: 1.75rem;"></i>
                    </div>
                    <div>
                        <h3 class="feature-title">Gujarati-English Side by Side</h3>
                        <p class="feature-subtitle sub-green font-gujarati">સરળ ગુજરાતી સમજૂતી</p>
                        <p class="feature-detail">Every tense rule is printed with its direct Gujarati equivalent so doubts vanish immediately.</p>
                    </div>
                </div>

                <div class="feature-item f-red">
                    <div class="feature-icon-circle">
                        <i data-lucide="layers" style="width: 1.75rem; height: 1.75rem;"></i>
                    </div>
                    <div>
                        <h3 class="feature-title">Color-Coded Sentences</h3>
                        <p class="feature-subtitle sub-red">Visual Sentence Blueprints</p>
                        <p class="feature-detail">Subject, verb, and object are clearly differentiated to eliminate grammatical ordering errors.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Study Material Collection Showcase -->
    <section class="study-material-section">
        <div class="container">
            <div class="material-grid">

                <!-- Material Item 1 -->
                <div class="material-card">
                    <div class="material-card-header">
                        <div class="material-card-icon icon-book">
                            <i data-lucide="book-open" style="width: 2rem; height: 2rem;"></i>
                        </div>
                        <span class="material-badge">Comprehensive Booklet</span>
                    </div>
                    <div class="material-card-body">
                        <h3 class="material-title">Complete Spoken English Handbook</h3>
                        <p class="material-desc">
                            The definitive guide prepared by Vijay Joshi sir containing all essentials from phonetics to conversational sentence templates.
                        </p>
                        <ul class="material-points">
                            <li><i data-lucide="check" style="width: 0.9rem; height: 0.9rem; color: var(--emerald-600);"></i> 150+ pages of focused grammar rules</li>
                            <li><i data-lucide="check" style="width: 0.9rem; height: 0.9rem; color: var(--emerald-600);"></i> Step-by-step Gujarati explanations</li>
                            <li><i data-lucide="check" style="width: 0.9rem; height: 0.9rem; color: var(--emerald-600);"></i> Provided in hardcopy upon admission</li>
                        </ul>
                    </div>
                </div>

                <!-- Material Item 2 -->
                <div class="material-card">
                    <div class="material-card-header">
                        <div class="material-card-icon icon-chart">
                            <i data-lucide="table" style="width: 2rem; height: 2rem;"></i>
                        </div>
                        <span class="material-badge">Wall Chart &amp; Cheatsheet</span>
                    </div>
                    <div class="material-card-body">
                        <h3 class="material-title">12 Tenses Master Chart</h3>
                        <p class="material-desc">
                            A one-page color-coded master diagram showing affirmative, negative, and interrogative formulas for all 12 tenses at a single glance.
                        </p>
                        <ul class="material-points">
                            <li><i data-lucide="check" style="width: 0.9rem; height: 0.9rem; color: var(--emerald-600);"></i> Quick 2-minute daily revision helper</li>
                            <li><i data-lucide="check" style="width: 0.9rem; height: 0.9rem; color: var(--emerald-600);"></i> Color highlighted auxiliary verbs</li>
                            <li><i data-lucide="check" style="width: 0.9rem; height: 0.9rem; color: var(--emerald-600);"></i> High-res printed laminated sheet</li>
                        </ul>
                    </div>
                </div>

                <!-- Material Item 3 -->
                <div class="material-card">
                    <div class="material-card-header">
                        <div class="material-card-icon icon-vocab">
                            <i data-lucide="image" style="width: 2rem; height: 2rem;"></i>
                        </div>
                        <span class="material-badge">Flashcards</span>
                    </div>
                    <div class="material-card-body">
                        <h3 class="material-title">Image-Based Vocabulary Cards</h3>
                        <p class="material-desc">
                            Visual flashcards categorised by topics: daily household items, emotions, professional meetings, traveling, and restaurant orders.
                        </p>
                        <ul class="material-points">
                            <li><i data-lucide="check" style="width: 0.9rem; height: 0.9rem; color: var(--emerald-600);"></i> Over 1,000 photographic word cards</li>
                            <li><i data-lucide="check" style="width: 0.9rem; height: 0.9rem; color: var(--emerald-600);"></i> Pronunciation guides spelled in Gujarati</li>
                            <li><i data-lucide="check" style="width: 0.9rem; height: 0.9rem; color: var(--emerald-600);"></i> Interactive quiz exercises</li>
                        </ul>
                    </div>
                </div>

                <!-- Material Item 4 -->
                <div class="material-card">
                    <div class="material-card-header">
                        <div class="material-card-icon icon-worksheet">
                            <i data-lucide="file-pen" style="width: 2rem; height: 2rem;"></i>
                        </div>
                        <span class="material-badge">Daily Worksheets</span>
                    </div>
                    <div class="material-card-body">
                        <h3 class="material-title">Daily Practice Worksheets</h3>
                        <p class="material-desc">
                            Structured 20-sentence daily translation challenges that test and reinforce the grammar concepts taught in class each day.
                        </p>
                        <ul class="material-points">
                            <li><i data-lucide="check" style="width: 0.9rem; height: 0.9rem; color: var(--emerald-600);"></i> 60 sequential practice sheets</li>
                            <li><i data-lucide="check" style="width: 0.9rem; height: 0.9rem; color: var(--emerald-600);"></i> Live teacher evaluation &amp; remarks</li>
                            <li><i data-lucide="check" style="width: 0.9rem; height: 0.9rem; color: var(--emerald-600);"></i> Progressive difficulty level from Day 1 to 60</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Sample Worksheet Highlight -->
    <section class="cta-section" style="background-color: var(--slate-50); border-top: 1px solid var(--slate-200);">
        <div class="container">
            <div class="cta-banner">
                <div class="cta-left">
                    <div class="cta-icon-box">
                        <i data-lucide="file-check" style="width: 2rem; height: 2rem;"></i>
                    </div>
                    <div>
                        <h3 class="cta-heading">Want to See Sample Study Notes?</h3>
                        <p class="cta-desc">
                            Visit our classroom in Porbandar to inspect our full course book collection and demo worksheets.
                        </p>
                    </div>
                </div>
                <div class="cta-right">
                    <a href="{{ route('contact') }}" class="btn-primary cta-button">
                        <span>Visit Our Centre</span>
                        <i data-lucide="arrow-right" style="width: 1.25rem; height: 1.25rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
