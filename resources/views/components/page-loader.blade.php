<!-- ======================================================= -->
<!-- CLEAN WHITE PRELOADER: NATURAL WORD-BY-WORD MORPH       -->
<!-- ======================================================= -->
<div id="sitePreloader" class="preloader-overlay-white">
    <div class="preloader-card-white">
        <!-- Center Emblem -->
        <div class="preloader-emblem-white">
            <svg viewBox="0 0 48 48" class="preloader-svg-white">
                <path d="M6 36c6-4 12-4 18 0 6-4 12-4 18 0V12c-6-4-12-4-18 0-6-4-12-4-18 0v24z" stroke="#0b2545" stroke-width="2.5" fill="none" />
                <path d="M24 12v24" stroke="#3b82f6" stroke-width="2.5" />
                <path d="M24 4l14 6-14 6-14-6 14-6z" fill="rgba(37, 99, 235, 0.15)" stroke="#2563eb" stroke-width="2" />
                <path d="M34 11.5v7c0 2-4.5 4-10 4s-10-2-10-4v-7" stroke="#2563eb" stroke-width="2" />
            </svg>
        </div>

        <!-- Typography Box -->
        <div class="preloader-brand-box">
            <!-- Line 1: શ્રી મંગલમ -> Shree Mangalam -->
            <h1 class="loader-line-main">
                <span class="morph-word" id="wordShree">
                    <span class="font-gujarati">શ્રી</span>
                </span>
                <span class="morph-word" id="wordMangalam">
                    <span class="font-gujarati">મંગલમ</span>
                </span>
            </h1>

            <!-- Line 2: સ્પોકન ઇંગ્લીશ કલાસીસ -> Spoken English Classes -->
            <p class="loader-line-sub">
                <span class="morph-word sub-word" id="wordSpoken">
                    <span class="font-gujarati">સ્પોકન</span>
                </span>
                <span class="morph-word sub-word" id="wordEnglish">
                    <span class="font-gujarati">ઇંગ્લીશ</span>
                </span>
                <span class="morph-word sub-word" id="wordClasses">
                    <span class="font-gujarati">કલાસીસ</span>
                </span>
            </p>
        </div>

        <!-- Subtle Subtitle Tag -->
        <div class="loader-sub-tag">
            <span id="loaderTagText" class="font-gujarati">ગુજરાતી માધ્યમમાંથી અંગ્રેજી શીખો</span>
        </div>
    </div>
</div>

<script>
    (function() {
        const preloader = document.getElementById('sitePreloader');
        if (!preloader) return;

        // Prevent body scroll and hide scrollbars completely
        document.documentElement.style.overflow = 'hidden';
        document.body.style.overflow = 'hidden';

        const wordShree = document.getElementById('wordShree');
        const wordMangalam = document.getElementById('wordMangalam');
        const wordSpoken = document.getElementById('wordSpoken');
        const wordEnglish = document.getElementById('wordEnglish');
        const wordClasses = document.getElementById('wordClasses');
        const tagText = document.getElementById('loaderTagText');

        // Smooth snappy text morph helper
        function morphWord(element, newText, isGujarati = false) {
            if (!element) return;
            element.classList.add('morph-switching');
            
            setTimeout(() => {
                element.innerHTML = `<span class="${isGujarati ? 'font-gujarati' : ''}">${newText}</span>`;
                element.classList.remove('morph-switching');
                element.classList.add('morph-english-done');
            }, 180);
        }

        // Fast & fluid sequence:
        // Hold pure Gujarati for 1.2s: [શ્રી મંગલમ] [સ્પોકન ઇંગ્લીશ કલાસીસ]
        // 1200ms: શ્રી -> Shree
        // 1450ms: મંગલમ -> Mangalam
        // 1700ms: સ્પોકન -> Spoken
        // 1950ms: ઇંગ્લીશ -> English
        // 2200ms: કલાસીસ -> Classes

        setTimeout(() => {
            morphWord(wordShree, 'Shree');
        }, 1200);

        setTimeout(() => {
            morphWord(wordMangalam, 'Mangalam');
        }, 1450);

        setTimeout(() => {
            morphWord(wordSpoken, 'Spoken');
        }, 1700);

        setTimeout(() => {
            morphWord(wordEnglish, 'English');
        }, 1950);

        setTimeout(() => {
            morphWord(wordClasses, 'Classes');
        }, 2200);

        // Tagline transition
        setTimeout(() => {
            if (tagText) {
                tagText.style.opacity = '0';
                setTimeout(() => {
                    tagText.classList.remove('font-gujarati');
                    tagText.textContent = 'Learn Today • Speak Tomorrow • Grow Forever';
                    tagText.style.opacity = '1';
                }, 200);
            }
        }, 1800);

        // Quick smooth fade out of the preloader at 2.9s and unlock page
        setTimeout(() => {
            preloader.classList.add('preloader-fade-out');

            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';

            setTimeout(() => {
                preloader.remove();
            }, 450);
        }, 2900);
    })();
</script>
