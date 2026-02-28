<?php

namespace Database\Seeders;

use App\Models\Bio;
use Illuminate\Database\Seeder;

class BioSeeder extends Seeder
{
    public function run(): void
    {
        Bio::create([
            'full_name' => 'Ahmed Mohammed',
            'title' => 'Full Stack Web Developer',
            'about_me' => json_encode([
                'ar' => 'مطور ويب متكامل متخصص في إنشاء تطبيقات ويب حديثة وعالية الأداء. أمتلك خبرة واسعة في العمل مع Laravel، Vue.js، React، وTailwind CSS. أسعى دائماً لتقديم حلول تقنية مبتكرة تلبي احتياجات العملاء وتتجاوز توقعاتهم.',
                'en' => 'A full-stack web developer specializing in creating modern, high-performance web applications. I have extensive experience working with Laravel, Vue.js, React, and Tailwind CSS. I always strive to provide innovative technical solutions that meet client needs and exceed expectations.'
            ]),
            'email' => 'ahmed@example.com',
            'phone' => '+20 123 456 7890',
            'location' => 'Cairo, Egypt',
            'cv_path' => 'uploads/cv/ahmed_cv.pdf',
            'social_links' => [
                'github' => 'https://github.com/ahmed',
                'linkedin' => 'https://linkedin.com/in/ahmed',
                'twitter' => 'https://twitter.com/ahmed',
                'facebook' => 'https://facebook.com/ahmed',
                'instagram' => 'https://instagram.com/ahmed',
            ],
            'profile_image' => 'uploads/bio/profile.jpg',
            'hero_video' => 'uploads/bio/intro.mp4',
        ]);
    }
}
