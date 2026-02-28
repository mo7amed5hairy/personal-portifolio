<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'title' => json_encode([
                    'ar' => 'Laravel للمحترفين - بناء تطبيقات متكاملة',
                    'en' => 'Laravel for Professionals - Building Complete Applications'
                ]),
                'provider' => 'Udemy',
                'description' => json_encode([
                    'ar' => 'دورة متقدمة في Laravel تشمل بناء APIs، نظام المصادقة، Queues، Events، ونشر التطبيقات على الخوادم.',
                    'en' => 'Advanced Laravel course covering API building, authentication systems, Queues, Events, and application deployment on servers.'
                ]),
                'completion_date' => '2024-08-15',
                'certificate_link' => 'https://udemy.com/certificate/laravel-pro',
                'certificate_image' => 'uploads/courses/laravel-cert.jpg',
                'course_image' => 'uploads/courses/laravel-course.jpg',
                'order' => 1,
            ],
            [
                'title' => json_encode([
                    'ar' => 'React.js - من الصفر للاحتراف',
                    'en' => 'React.js - From Zero to Hero'
                ]),
                'provider' => 'Coursera',
                'description' => json_encode([
                    'ar' => 'تعلم React.js بما في ذلك Hooks، Context API، Redux، وNext.js لبناء تطبيقات ويب تفاعلية حديثة.',
                    'en' => 'Learn React.js including Hooks, Context API, Redux, and Next.js for building modern interactive web applications.'
                ]),
                'completion_date' => '2024-06-20',
                'certificate_link' => 'https://coursera.org/certificate/react',
                'certificate_image' => 'uploads/courses/react-cert.jpg',
                'course_image' => 'uploads/courses/react-course.jpg',
                'order' => 2,
            ],
            [
                'title' => json_encode([
                    'ar' => 'Docker و Kubernetes للمطورين',
                    'en' => 'Docker and Kubernetes for Developers'
                ]),
                'provider' => 'Pluralsight',
                'description' => json_encode([
                    'ar' => 'تعلم حاوية التطبيقات باستخدام Docker وإدارتها باستخدام Kubernetes. يشمل CI/CD ونشر التطبيقات.',
                    'en' => 'Learn containerizing applications using Docker and managing them with Kubernetes. Includes CI/CD and application deployment.'
                ]),
                'completion_date' => '2024-04-10',
                'certificate_link' => 'https://pluralsight.com/certificate/docker-k8s',
                'certificate_image' => 'uploads/courses/docker-cert.jpg',
                'course_image' => 'uploads/courses/docker-course.jpg',
                'order' => 3,
            ],
            [
                'title' => json_encode([
                    'ar' => 'AWS Certified Solutions Architect',
                    'en' => 'AWS Certified Solutions Architect'
                ]),
                'provider' => 'Amazon Web Services',
                'description' => json_encode([
                    'ar' => 'شهادة معتمدة في تصميم حلول AWS تشمل EC2، S3، RDS، Lambda، وخدمات AWS المتنوعة.',
                    'en' => 'Certified credential in designing AWS solutions including EC2, S3, RDS, Lambda, and various AWS services.'
                ]),
                'completion_date' => '2024-02-28',
                'certificate_link' => 'https://aws.amazon.com/certification',
                'certificate_image' => 'uploads/courses/aws-cert.jpg',
                'course_image' => 'uploads/courses/aws-course.jpg',
                'order' => 4,
            ],
            [
                'title' => json_encode([
                    'ar' => 'UI/UX Design - Principles and Practices',
                    'en' => 'UI/UX Design - Principles and Practices'
                ]),
                'provider' => 'Google (Coursera)',
                'description' => json_encode([
                    'ar' => 'تعلم مبادئ تصميم واجهات المستخدم وتجربة المستخدم. يشمل Figma، prototyping، وuser research.',
                    'en' => 'Learn UI/UX design principles including Figma, prototyping, and user research methodologies.'
                ]),
                'completion_date' => '2023-12-15',
                'certificate_link' => 'https://coursera.org/certificate/ux-design',
                'certificate_image' => 'uploads/courses/ux-cert.jpg',
                'course_image' => 'uploads/courses/ux-course.jpg',
                'order' => 5,
            ],
            [
                'title' => json_encode([
                    'ar' => 'Node.js و Express - بناء APIs احترافية',
                    'en' => 'Node.js and Express - Building Professional APIs'
                ]),
                'provider' => 'freeCodeCamp',
                'description' => json_encode([
                    'ar' => 'بناء RESTful APIs باستخدام Node.js و Express.js مع MongoDB، authentication، و testing.',
                    'en' => 'Building RESTful APIs using Node.js and Express.js with MongoDB, authentication, and testing.'
                ]),
                'completion_date' => '2023-10-20',
                'certificate_link' => 'https://freecodecamp.org/certificate/node',
                'certificate_image' => 'uploads/courses/node-cert.jpg',
                'course_image' => 'uploads/courses/node-course.jpg',
                'order' => 6,
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
