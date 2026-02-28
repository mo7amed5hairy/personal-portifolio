<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'title' => json_encode([
                    'ar' => 'الرئيسية',
                    'en' => 'Hero Section'
                ]),
                'slug' => 'hero',
                'content' => json_encode([
                    'ar' => json_encode([
                        'headline' => 'مطور ويب متكامل',
                        'subheadline' => 'أحول الأفكار إلى واقع رقمي',
                        'description' => 'أقوم بتطوير تطبيقات ويب حديثة وسريعة باستخدام أحدث التقنيات',
                        'cta_primary' => 'تواصل معي',
                        'cta_secondary' => 'شاهد أعمالي',
                    ]),
                    'en' => json_encode([
                        'headline' => 'Full Stack Developer',
                        'subheadline' => 'Turning Ideas Into Digital Reality',
                        'description' => 'I develop modern, fast web applications using the latest technologies',
                        'cta_primary' => 'Contact Me',
                        'cta_secondary' => 'View My Work',
                    ])
                ]),
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => json_encode([
                    'ar' => 'نبذة عني',
                    'en' => 'About Section'
                ]),
                'slug' => 'about',
                'content' => json_encode([
                    'ar' => json_encode([
                        'headline' => 'من أنا',
                        'description' => 'مطور ويب شغوف ببناء تطبيقات استثنائية',
                        'stats' => [
                            ['number' => '5+', 'label' => 'سنوات خبرة'],
                            ['number' => '50+', 'label' => 'مشروع منجز'],
                            ['number' => '30+', 'label' => 'عميل سعيد'],
                        ]
                    ]),
                    'en' => json_encode([
                        'headline' => 'Who I Am',
                        'description' => 'A passionate web developer building exceptional applications',
                        'stats' => [
                            ['number' => '5+', 'label' => 'Years Experience'],
                            ['number' => '50+', 'label' => 'Projects Done'],
                            ['number' => '30+', 'label' => 'Happy Clients'],
                        ]
                    ])
                ]),
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => json_encode([
                    'ar' => 'الخدمات',
                    'en' => 'Services Section'
                ]),
                'slug' => 'services',
                'content' => json_encode([
                    'ar' => json_encode([
                        'headline' => 'ما يمكنني تقديمه',
                        'services' => [
                            ['icon' => 'code', 'title' => 'تطوير الويب', 'description' => 'تطبيقات ويب متكاملة باستخدام Laravel و Vue.js'],
                            ['icon' => 'mobile', 'title' => 'تطبيقات الجوال', 'description' => 'تطبيقات PWA و Flutter للهواتف'],
                            ['icon' => 'design', 'title' => 'UI/UX Design', 'description' => 'تصميم واجهات مستخدم جذابة'],
                            ['icon' => 'api', 'title' => 'API Development', 'description' => 'RESTful APIs و GraphQL APIs'],
                        ]
                    ]),
                    'en' => json_encode([
                        'headline' => 'What I Offer',
                        'services' => [
                            ['icon' => 'code', 'title' => 'Web Development', 'description' => 'Full-stack web applications using Laravel & Vue.js'],
                            ['icon' => 'mobile', 'title' => 'Mobile Apps', 'description' => 'PWA and Flutter apps for mobile devices'],
                            ['icon' => 'design', 'title' => 'UI/UX Design', 'description' => 'Attractive user interface design'],
                            ['icon' => 'api', 'title' => 'API Development', 'description' => 'RESTful APIs and GraphQL APIs'],
                        ]
                    ])
                ]),
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => json_encode([
                    'ar' => 'المشاريع المميزة',
                    'en' => 'Featured Projects'
                ]),
                'slug' => 'featured-projects',
                'content' => json_encode([
                    'ar' => json_encode([
                        'headline' => 'أعمالي المختارة',
                        'description' => 'بعض المشاريع التي قمت بتطويرها',
                    ]),
                    'en' => json_encode([
                        'headline' => 'Featured Work',
                        'description' => 'Some of the projects I have developed',
                    ])
                ]),
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => json_encode([
                    'ar' => 'الكورسات',
                    'en' => 'Courses Section'
                ]),
                'slug' => 'courses',
                'content' => json_encode([
                    'ar' => json_encode([
                        'headline' => 'شهاداتي وتعليمي',
                        'description' => 'الدورات والشهادات التي حصلت عليها',
                    ]),
                    'en' => json_encode([
                        'headline' => 'My Certifications',
                        'description' => 'Courses and certificates I have earned',
                    ])
                ]),
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => json_encode([
                    'ar' => 'فيديو تعريفي',
                    'en' => 'Video Introduction'
                ]),
                'slug' => 'video-intro',
                'content' => json_encode([
                    'ar' => json_encode([
                        'headline' => 'تعرف علي أكثر',
                        'description' => 'شاهد الفيديو التعريفي للتعرف على مهاراتي وخبراتي',
                        'video_url' => 'uploads/intro-video.mp4',
                        'thumbnail' => 'uploads/video-thumb.jpg',
                    ]),
                    'en' => json_encode([
                        'headline' => 'Get To Know Me',
                        'description' => 'Watch the intro video to learn about my skills and experience',
                        'video_url' => 'uploads/intro-video.mp4',
                        'thumbnail' => 'uploads/video-thumb.jpg',
                    ])
                ]),
                'order' => 6,
                'is_active' => true,
            ],
            [
                'title' => json_encode([
                    'ar' => 'تواصل معي',
                    'en' => 'Contact Section'
                ]),
                'slug' => 'contact',
                'content' => json_encode([
                    'ar' => json_encode([
                        'headline' => 'لنبدأ مشروعاً معاً',
                        'description' => 'هل لديك فكرة مشروع؟ دعنا نتحدث عنها',
                    ]),
                    'en' => json_encode([
                        'headline' => 'Let\'s Start a Project',
                        'description' => 'Have a project idea? Let\'s talk about it',
                    ])
                ]),
                'order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}
