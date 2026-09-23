<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $storageDir = storage_path('app/public/courses/slides');
        if (! File::exists($storageDir)) {
            File::makeDirectory($storageDir, 0755, true);
        }

        $thumbnailDir = storage_path('app/public/courses/thumbnails');
        if (! File::exists($thumbnailDir)) {
            File::makeDirectory($thumbnailDir, 0755, true);
        }

        $coursesData = [
            [
                'title' => 'Basic English Course',
                'description' => 'Ideal for starters who want to develop strong foundational knowledge of the English alphabet, letter sounds, daily greetings, and basic sentence construction in Gujarati.',
                'price' => 111.00,
                'status' => 'published',
                'level' => 'Starter / Level 1',
                'duration' => '2 Months',
                'theme_color' => '#2563eb',
                'slides' => [
                    ['title' => 'Phonics & Letter Sounds', 'desc' => 'Gujarati sound associations for English letters A through Z'],
                    ['title' => 'Basic Pronouns (I, You, We, They)', 'desc' => 'How to identify and address subjects in daily dialogue'],
                    ['title' => 'Daily Greetings & Common Phrases', 'desc' => 'Good morning, How are you?, Welcome, Nice to meet you'],
                    ['title' => 'Three-Word Sentences', 'desc' => 'Subject + Verb + Object structure explained visually'],
                    ['title' => 'Action Verbs in Pictures', 'desc' => 'Walk, Talk, Eat, Drink, Read, Write with visual flashcards'],
                    ['title' => 'Self Introduction Blueprint', 'desc' => 'Speak 5 sentences about yourself in English confidently'],
                ]
            ],
            [
                'title' => 'English Grammar Course',
                'description' => 'Complete breakdown of 12 English tenses, voice (Active/Passive), direct-indirect speech, modal auxiliaries, and prepositions with Gujarati formulas and memory charts.',
                'price' => 111.00,
                'status' => 'published',
                'level' => 'Core Grammar / All Levels',
                'duration' => '3 Months',
                'theme_color' => '#dc2626',
                'slides' => [
                    ['title' => '12 Tenses Master Matrix', 'desc' => 'Past, Present, Future timelines mapped to Gujarati verbs'],
                    ['title' => 'Simple Present & Daily Routine', 'desc' => 'Rules for s/es, habits, universal truths, and negatives'],
                    ['title' => 'Simple Past & Storytelling', 'desc' => 'Using V2 irregular forms to narrate past events accurately'],
                    ['title' => 'Continuous vs Perfect Aspect', 'desc' => 'Never get confused between "have done" and "did" again'],
                    ['title' => 'Modal Verbs (Can, Could, Should)', 'desc' => 'Expressing ability, possibility, permission, and obligations'],
                    ['title' => 'Active & Passive Voice Formulations', 'desc' => 'Transforming sentences without changing the essential meaning'],
                ]
            ],
            [
                'title' => 'Spoken English Fluency',
                'description' => 'Designed to eliminate hesitation and hesitation-free speaking for Gujarati speakers. Focus on daily conversations, interview prep, and public speaking confidence.',
                'price' => 111.00,
                'status' => 'published',
                'level' => 'Practical Fluency',
                'duration' => '2.5 Months',
                'theme_color' => '#f59e0b',
                'slides' => [
                    ['title' => 'Overcoming Speaking Anxiety', 'desc' => 'Mental frameworks to stop translating Gujarati in your head'],
                    ['title' => 'Shopping, Travel & Restaurant Scenarios', 'desc' => 'Polite inquiries, asking prices, placing food orders'],
                    ['title' => 'Telephone & WhatsApp Etiquette', 'desc' => 'Professional greetings, leaving voicemails, and message clarity'],
                    ['title' => 'Job Interview Q&A Blueprints', 'desc' => 'Tell me about yourself, strengths, and handling tough questions'],
                    ['title' => 'Small Talk & Networking Conversations', 'desc' => 'Breaking the ice at social events, offices, and parties'],
                ]
            ],
            [
                'title' => 'Kids & School English',
                'description' => 'Interactive and playful visual learning for school students. Boosts classroom confidence, handwriting, vocabulary, reading comprehension, and storytelling.',
                'price' => 111.00,
                'status' => 'published',
                'level' => 'Kids / School Level',
                'duration' => '2 Months',
                'theme_color' => '#0d9488',
                'slides' => [
                    ['title' => 'Animal, Fruits & Colors World', 'desc' => 'Engaging picture cards connecting English words to nature'],
                    ['title' => 'My School & Classroom Objects', 'desc' => 'Pen, pencil, eraser, blackboard, teacher, and friends'],
                    ['title' => 'Story Reading: The Brave Lion', 'desc' => 'Step-by-step reading practice with highlighted vocabulary'],
                    ['title' => 'Polite Words & Manners', 'desc' => 'Please, Thank You, Sorry, and Excuse Me in everyday actions'],
                    ['title' => 'Sentence Building Blocks Game', 'desc' => 'Fun puzzle format to arrange words into correct English'],
                ]
            ],
            [
                'title' => 'English Vocabulary Mastery',
                'description' => 'Expand your active word bank with root words, high-frequency idioms, collocations, and contextual antonym/synonym pairs with visual mnemonics.',
                'price' => 111.00,
                'status' => 'published',
                'level' => 'Vocabulary Booster',
                'duration' => '1.5 Months',
                'theme_color' => '#9333ea',
                'slides' => [
                    ['title' => 'Root Words: The Keys to 100+ Words', 'desc' => 'Understanding prefixes (un, dis, re) and suffixes (ful, less)'],
                    ['title' => 'Top 50 Daily Colloquial Expressions', 'desc' => 'Phrases used constantly in English web series and podcasts'],
                    ['title' => 'Emotional & Personality Descriptors', 'desc' => 'Go beyond "happy/sad" into resilient, empathetic, ecstatic'],
                    ['title' => 'Business & Office English Vocabulary', 'desc' => 'Deadlines, deliverables, bandwidth, synergy, agenda'],
                    ['title' => 'Memory Hooks & Visual Mnemonics', 'desc' => 'Retain 10 new words daily without tedious rote memorization'],
                ]
            ],
        ];

        foreach ($coursesData as $courseData) {
            $slug = Str::slug($courseData['title']);

            // Generate SVG Thumbnail
            $thumbFilename = "thumb_{$slug}.svg";
            $thumbSvg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 450" width="800" height="450">
    <defs>
        <linearGradient id="grad_{$slug}" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#0b2545" />
            <stop offset="100%" stop-color="{$courseData['theme_color']}" />
        </linearGradient>
    </defs>
    <rect width="800" height="450" fill="url(#grad_{$slug})" />
    <circle cx="700" cy="80" r="140" fill="white" opacity="0.05" />
    <circle cx="100" cy="380" r="100" fill="white" opacity="0.05" />
    <text x="60" y="100" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto" font-size="20" font-weight="bold" fill="#67e8f9" letter-spacing="2">SHREE MANGALAM ENGLISH</text>
    <text x="60" y="210" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto" font-size="44" font-weight="900" fill="#ffffff">{$courseData['title']}</text>
    <text x="60" y="270" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto" font-size="22" font-weight="500" fill="#cbd5e1">{$courseData['level']} &bull; {$courseData['duration']}</text>
    <rect x="60" y="330" width="220" height="50" rx="25" fill="#ffffff" />
    <text x="170" y="362" text-anchor="middle" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto" font-size="18" font-weight="bold" fill="#0b2545">VISUAL COURSE</text>
</svg>
SVG;
            File::put($thumbnailDir . '/' . $thumbFilename, $thumbSvg);

            $course = Course::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $courseData['title'],
                    'description' => $courseData['description'],
                    'price' => $courseData['price'],
                    'status' => $courseData['status'],
                    'level' => $courseData['level'],
                    'duration' => $courseData['duration'],
                    'thumbnail' => 'courses/thumbnails/' . $thumbFilename,
                ]
            );

            // Generate each slide SVG
            foreach ($courseData['slides'] as $index => $slide) {
                $slideNum = $index + 1;
                $slideFilename = "slide_{$slug}_{$slideNum}.svg";
                $slideSvg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 675" width="1200" height="675">
    <defs>
        <linearGradient id="bg_{$slug}_{$slideNum}" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#071930" />
            <stop offset="100%" stop-color="#0f2747" />
        </linearGradient>
    </defs>
    <rect width="1200" height="675" fill="url(#bg_{$slug}_{$slideNum})" />
    
    <!-- Decorative framing -->
    <rect x="30" y="30" width="1140" height="615" rx="16" fill="none" stroke="{$courseData['theme_color']}" stroke-width="2" opacity="0.4" />
    
    <!-- Header banner -->
    <text x="70" y="85" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto" font-size="18" font-weight="bold" fill="#67e8f9" letter-spacing="2">SHREE MANGALAM SPOKEN ENGLISH &bull; LESSON SLIDE</text>
    <rect x="1010" y="55" width="120" height="40" rx="20" fill="{$courseData['theme_color']}" />
    <text x="1070" y="81" text-anchor="middle" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto" font-size="16" font-weight="bold" fill="#ffffff">SLIDE {$slideNum}</text>
    
    <!-- Course Title & Lesson Topic -->
    <text x="70" y="150" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto" font-size="24" font-weight="600" fill="#94a3b8">{$courseData['title']}</text>
    <text x="70" y="210" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto" font-size="46" font-weight="900" fill="#ffffff">{$slide['title']}</text>
    
    <!-- Central Content Box -->
    <rect x="70" y="260" width="1060" height="300" rx="12" fill="#0b1b30" stroke="#1e3a8a" stroke-width="1.5" />
    <circle cx="140" cy="335" r="40" fill="{$courseData['theme_color']}" opacity="0.3" />
    <text x="140" y="347" text-anchor="middle" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto" font-size="28" font-weight="900" fill="#ffffff">{$slideNum}</text>
    
    <text x="210" y="330" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto" font-size="26" font-weight="bold" fill="#38bdf8">Concept Overview</text>
    <text x="210" y="375" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto" font-size="22" font-weight="500" fill="#e2e8f0">{$slide['desc']}</text>
    
    <!-- Gujarati Hint Tag -->
    <rect x="210" y="420" width="480" height="50" rx="8" fill="#1e293b" />
    <text x="230" y="452" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto" font-size="18" font-weight="bold" fill="#fef08a">&bull; ગુજરાતી સરળ સમજૂતી અને ઉદાહરણો સાથે શીખો</text>
    
    <!-- Footer -->
    <text x="70" y="605" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto" font-size="15" fill="#64748b">Vijay Joshi &bull; Porbandar Coaching Academy &bull; Shree Mangalam</text>
</svg>
SVG;
                File::put($storageDir . '/' . $slideFilename, $slideSvg);

                CourseImage::updateOrCreate(
                    [
                        'course_id' => $course->id,
                        'sort_order' => $slideNum,
                    ],
                    [
                        'image_path' => 'courses/slides/' . $slideFilename,
                        'caption' => $slide['title'] . ': ' . $slide['desc'],
                    ]
                );
            }
        }
    }
}
