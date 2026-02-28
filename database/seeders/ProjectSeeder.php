<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => json_encode([
                    'ar' => 'نظام إدارة المحتوى المتكامل',
                    'en' => 'Integrated Content Management System'
                ]),
                'slug' => 'cms-system',
                'description' => json_encode([
                    'ar' => 'نظام إدارة محتوى متكامل مع لوحة تحكم احترافية، يدعم المستخدمين المتعددين والأدوار والصلاحيات، مع نظام إشعارات متكامل وتحليلات متقدمة.',
                    'en' => 'A comprehensive content management system with a professional admin dashboard, supporting multiple users, roles, and permissions, with an integrated notification system and advanced analytics.'
                ]),
                'image' => 'uploads/projects/cms-dashboard.jpg',
                'gallery' => json_encode([
                    'uploads/projects/cms-1.jpg',
                    'uploads/projects/cms-2.jpg',
                    'uploads/projects/cms-3.jpg'
                ]),
                'link' => 'https://cms-demo.example.com',
                'github_link' => 'https://github.com/ahmed/cms-system',
                'tags' => json_encode(['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS', 'REST API']),
                'order' => 1,
                'is_featured' => true,
            ],
            [
                'title' => json_encode([
                    'ar' => 'متجر إلكتروني متكامل',
                    'en' => 'Full E-Commerce Platform'
                ]),
                'slug' => 'ecommerce-platform',
                'description' => json_encode([
                    'ar' => 'منصة تجارة إلكترونية متكاملة مع نظام دفع، سلة تسوق، إدارة مخزون، ونظام تقييمات العملاء. يدعم اللغات المتعددة والعملات المختلفة.',
                    'en' => 'A complete e-commerce platform with payment system, shopping cart, inventory management, and customer review system. Supports multiple languages and currencies.'
                ]),
                'image' => 'uploads/projects/ecommerce-hero.jpg',
                'gallery' => json_encode([
                    'uploads/projects/ecommerce-1.jpg',
                    'uploads/projects/ecommerce-2.jpg'
                ]),
                'link' => 'https://shop-demo.example.com',
                'github_link' => 'https://github.com/ahmed/ecommerce',
                'tags' => json_encode(['Laravel', 'React', 'Stripe', 'Redis', 'Docker']),
                'order' => 2,
                'is_featured' => true,
            ],
            [
                'title' => json_encode([
                    'ar' => 'تطبيق إدارة المهام',
                    'en' => 'Task Management Application'
                ]),
                'slug' => 'task-management',
                'description' => json_encode([
                    'ar' => 'تطبيق ويب لإدارة المهام والمشاريع مع ميزات التعاون الجماعي، تتبع الوقت، وتقارير التقدم. يدعم الإشعارات الفورية والتكامل مع التقويم.',
                    'en' => 'A web application for task and project management with team collaboration features, time tracking, and progress reporting. Supports real-time notifications and calendar integration.'
                ]),
                'image' => 'uploads/projects/tasks-app.jpg',
                'gallery' => json_encode([
                    'uploads/projects/tasks-1.jpg',
                    'uploads/projects/tasks-2.jpg',
                    'uploads/projects/tasks-3.jpg'
                ]),
                'link' => 'https://tasks-demo.example.com',
                'github_link' => 'https://github.com/ahmed/task-app',
                'tags' => json_encode(['Laravel', 'Livewire', 'Alpine.js', 'PostgreSQL']),
                'order' => 3,
                'is_featured' => true,
            ],
            [
                'title' => json_encode([
                    'ar' => 'بوابة الأخبار الإلكترونية',
                    'en' => 'Online News Portal'
                ]),
                'slug' => 'news-portal',
                'description' => json_encode([
                    'ar' => 'بوابة أخبار إلكترونية مع نظام إدارة المقالات، تصنيفات متعددة، نظام تعليقات، ومحرك بحث متقدم. تصميم متجاوب بالكامل.',
                    'en' => 'An online news portal with article management system, multiple categories, comment system, and advanced search engine. Fully responsive design.'
                ]),
                'image' => 'uploads/projects/news-portal.jpg',
                'gallery' => json_encode([
                    'uploads/projects/news-1.jpg',
                    'uploads/projects/news-2.jpg'
                ]),
                'link' => 'https://news-demo.example.com',
                'github_link' => 'https://github.com/ahmed/news-portal',
                'tags' => json_encode(['Laravel', 'Elasticsearch', 'AWS S3', 'Tailwind']),
                'order' => 4,
                'is_featured' => false,
            ],
            [
                'title' => json_encode([
                    'ar' => 'نظام حجز المواعيد',
                    'en' => 'Appointment Booking System'
                ]),
                'slug' => 'booking-system',
                'description' => json_encode([
                    'ar' => 'نظام حجز مواعيد متكامل للعيادات والمراكز الصحية مع تقويم تفاعلي، تذكيرات آلية، وإدارة الموظفين.',
                    'en' => 'A complete appointment booking system for clinics and health centers with interactive calendar, automated reminders, and staff management.'
                ]),
                'image' => 'uploads/projects/booking-system.jpg',
                'gallery' => json_encode([
                    'uploads/projects/booking-1.jpg',
                    'uploads/projects/booking-2.jpg'
                ]),
                'link' => 'https://booking-demo.example.com',
                'github_link' => 'https://github.com/ahmed/booking-system',
                'tags' => json_encode(['Laravel', 'FullCalendar', 'Pusher', 'Twilio']),
                'order' => 5,
                'is_featured' => false,
            ],
            [
                'title' => json_encode([
                    'ar' => 'منصة التعليم الإلكتروني',
                    'en' => 'E-Learning Platform'
                ]),
                'slug' => 'elearning-platform',
                'description' => json_encode([
                    'ar' => 'منصة تعليم إلكتروني مع دورات تفاعلية، اختبارات، شهادات، ونظام تتبع التقدم. يدعم الفيديو والمحتوى التفاعلي.',
                    'en' => 'An e-learning platform with interactive courses, quizzes, certificates, and progress tracking system. Supports video and interactive content.'
                ]),
                'image' => 'uploads/projects/elearning.jpg',
                'gallery' => json_encode([
                    'uploads/projects/elearning-1.jpg',
                    'uploads/projects/elearning-2.jpg',
                    'uploads/projects/elearning-3.jpg'
                ]),
                'link' => 'https://learn-demo.example.com',
                'github_link' => 'https://github.com/ahmed/elearning',
                'tags' => json_encode(['Laravel', 'Vue.js', 'Video.js', 'WebRTC']),
                'order' => 6,
                'is_featured' => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
