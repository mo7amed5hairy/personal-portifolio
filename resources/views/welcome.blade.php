<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth" style="scroll-behavior: smooth;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $bio->getLocalizedAbout() }}">
    <title>{{ $bio->full_name ?? 'Portfolio' }} | {{ $bio->getLocalizedTitle() }}</title>
    <link rel="icon" href="{{ $bio->getProfileImageUrl() ?? asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #ec4899;
            --success: #0284c7;
            --warning: #f59e0b;
            --dark-bg: #0f172a;
            --light-bg: #f8fafc;
            --card-bg-light: rgba(255, 255, 255, 0.9);
            --card-bg-dark: rgba(15, 23, 42, 0.82);
        }

        [x-cloak] {
            display: none !important;
        }

        html {
            scroll-behavior: smooth;
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }
        }

        body {
            transition: background-color 0.6s cubic-bezier(0.4, 0, 0.2, 1),
                color 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            scroll-behavior: smooth;
        }

        .dark body {
            background-color: #020617;
        }

        .font-arabic {
            font-family: 'Cairo', sans-serif;
        }

        .font-english {
            font-family: 'Inter', sans-serif;
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-gradient {
            background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.15), transparent),
                radial-gradient(circle at bottom left, rgba(236, 72, 153, 0.1), transparent),
                #f8fafc;
            transition: all 0.6s ease;
        }

        .dark .hero-gradient {
            background: radial-gradient(circle at top right, rgba(79, 70, 229, 0.2), transparent),
                radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.15), transparent),
                #020617;
        }

        .glass-effect {
            background: var(--card-bg-light);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
            transition: all 0.4s ease;
        }

        .dark .glass-effect {
            background: var(--card-bg-dark);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.5);
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0.2, 0, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .dark .card-hover:hover {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        }

        .nav-link-premium {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 500;
            color: #94a3b8;
            /* gray-400 */
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dark .nav-link-premium {
            color: #cbd5e1;
            /* gray-300 */
        }

        .nav-link-premium:hover {
            background-color: rgba(99, 102, 241, 0.08);
            /* indigo-500/8 */
            color: #4f46e5;
            /* indigo-600 */
            transform: translateY(-1px);
        }

        .dark .nav-link-premium:hover {
            background-color: rgba(99, 102, 241, 0.15);
            /* indigo-500/15 */
            color: #818cf8;
            /* indigo-400 */
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            transition: all 0.3s ease;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .floating {
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-15px) rotate(3deg);
            }
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.35;
            animation: blob-float 15s ease-in-out infinite;
            z-index: 0;
        }

        .blob-1 {
            width: 500px;
            height: 500px;
            background: var(--primary);
            top: -200px;
            left: -100px;
            animation-delay: 0s;
        }

        .blob-2 {
            width: 400px;
            height: 400px;
            background: var(--secondary);
            bottom: -150px;
            right: -100px;
            animation-delay: -5s;
        }

        .blob-3 {
            width: 300px;
            height: 300px;
            background: var(--accent);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -10s;
        }

        @keyframes blob-float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -30px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        /* Project & Course Card Base */
        .premium-card {
            background: white;
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
            border-radius: 1.5rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .dark .premium-card {
            background: #0f172a;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-align: justify;
        }

        /* Global Text Transitions */
        p:not(.ignore-dark),
        .text-gray-600,
        .text-gray-500 {
            transition: color 0.6s ease;
        }

        .dark p,
        .dark .text-gray-600,
        .dark .text-gray-500 {
            color: #94a3b8 !important;
            /* Premium Slate-400 */
        }

        .dark h1,
        .dark h2,
        .dark h3:not(.ignore-dark),
        .dark h4 {
            color: #f8fafc !important;
            /* Premium Slate-50 */
        }

        .dark .nav-blur {
            background: rgba(2, 6, 23, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Skills Progress Bar */
        .skill-bar {
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            transition: width 1.5s ease-out;
        }



        .project-card {
            position: relative;
            overflow: hidden;
        }

        .project-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.95) 0%, rgba(15, 23, 42, 0.7) 50%, transparent 100%);
            opacity: 0;
            transition: all 0.4s ease;
            z-index: 1;
        }

        .project-card:hover::before {
            opacity: 1;
        }

        .project-card .project-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.4s ease;
            z-index: 2;
        }

        .project-card:hover .project-content {
            transform: translateY(0);
            opacity: 1;
        }

        .project-card img {
            transition: transform 0.6s ease;
        }

        .project-card:hover img {
            transform: scale(1.1);
        }

        .service-icon {
            position: relative;
            overflow: hidden;
        }

        .service-icon::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.2) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .service-icon:hover::after {
            opacity: 1;
        }

        .service-icon i {
            transition: transform 0.4s ease;
        }

        .service-icon:hover i {
            transform: scale(1.2) rotate(5deg);
        }

        .course-card {
            overflow: hidden;
        }

        .course-card img {
            transition: transform 0.6s ease;
        }

        .course-card:hover img {
            transform: scale(1.1);
        }

        .section-padding {
            padding: 120px 0;
        }

        .container-custom {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .profile-ring {
            position: relative;
        }

        .profile-ring::before {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary), var(--accent));
            z-index: -1;
            animation: rotate 4s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .typing-effect {
            overflow: hidden;
            border-right: 3px solid var(--primary);
            white-space: nowrap;
            animation: typing 3s steps(30) infinite, blink 0.7s step-end infinite;
        }

        @keyframes typing {
            from {
                width: 0
            }

            to {
                width: 100%
            }
        }

        @keyframes blink {
            50% {
                border-color: transparent
            }
        }

        .social-btn {
            position: relative;
            overflow: hidden;
        }

        .social-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .social-btn:hover::before {
            left: 100%;
        }

        .gradient-border {
            position: relative;
        }

        .gradient-border::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            padding: 2px;
            background: linear-gradient(135deg, var(--primary), var(--secondary), var(--accent));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
        }

        /* Project Tags - Premium Style */
        .tag-pill {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.12) 0%, rgba(139, 92, 246, 0.12) 50%, rgba(236, 72, 153, 0.12) 100%);
            color: #8b5cf6;
            border: 1px solid rgba(139, 92, 246, 0.25);
            transition: all 0.3s ease;
            letter-spacing: 0.08em;
        }

        .tag-pill:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.25) 0%, rgba(139, 92, 246, 0.25) 50%, rgba(236, 72, 153, 0.25) 100%);
            border-color: rgba(139, 92, 246, 0.5);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.15);
        }

        .dark .tag-pill {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(139, 92, 246, 0.15) 50%, rgba(236, 72, 153, 0.15) 100%);
            color: #c4b5fd;
            border-color: rgba(139, 92, 246, 0.3);
        }

        .dark .tag-pill:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.3) 0%, rgba(139, 92, 246, 0.3) 50%, rgba(236, 72, 153, 0.3) 100%);
            border-color: rgba(139, 92, 246, 0.6);
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.2);
        }

        /* More Button - Gradient Style */
        .more-btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .more-btn::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .more-btn:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .more-btn i {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 {{ $locale === 'ar' ? 'font-arabic' : 'font-english' }}"
    x-data="{ 
          darkMode: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches), 
          mobileMenu: false, 
          scrolled: false
      }"
    x-init="$watch('darkMode', val => { 
          localStorage.setItem('theme', val ? 'dark' : 'light');
          if (val) document.documentElement.classList.add('dark');
          else document.documentElement.classList.remove('dark');
      }); 
      if (darkMode) document.documentElement.classList.add('dark');"
    :class="{ 'dark': darkMode }"
    @scroll.window="scrolled = (window.pageYOffset > 50)">

    <!-- Navigation -->
    <nav :class="{ 'nav-blur shadow-lg': scrolled, 'bg-transparent': !scrolled }"
        class="fixed w-full z-50 transition-all duration-300">
        <div class="container-custom">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0">
                    <a href="#home" class="text-2xl md:text-3xl font-bold gradient-text">{{ $bio->full_name ?? 'Portfolio' }}</a>
                </div>

                <div class="hidden lg:flex items-center gap-x-8">
                    <a href="#home" class="nav-link-premium">{{ __('messages.home') }}</a>
                    <a href="#about" class="nav-link-premium">{{ __('messages.about') }}</a>
                    <a href="#services" class="nav-link-premium">{{ __('messages.services') }}</a>
                    <a href="#projects" class="nav-link-premium">{{ __('messages.projects') }}</a>
                    <a href="#courses" class="nav-link-premium">{{ __('messages.courses') }}</a>
                    <a href="#contact" class="nav-link-premium">{{ __('messages.contact') }}</a>
                </div>

                <div class="flex items-center space-x-4">
                    <button @click="darkMode = !darkMode"
                        class="p-3 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
                        <i x-show="!darkMode" class="fas fa-moon text-gray-700 dark:text-gray-300"></i>
                        <i x-show="darkMode" class="fas fa-sun text-yellow-500" x-cloak></i>
                    </button>

                    <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-3 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800">
                        <i class="fas fa-bars text-gray-700 dark:text-gray-300"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenu" x-cloak class="lg:hidden glass-effect border-t">
            <div class="container-custom py-6 space-y-4">
                <a href="#home" @click="mobileMenu = false" class="block py-3 text-gray-400 dark:text-gray-300 font-medium hover:text-indigo-600">{{ __('messages.home') }}</a>
                <a href="#about" @click="mobileMenu = false" class="block py-3 text-gray-400 dark:text-gray-300 font-medium hover:text-indigo-600">{{ __('messages.about') }}</a>
                <a href="#services" @click="mobileMenu = false" class="block py-3 text-gray-400 dark:text-gray-300 font-medium hover:text-indigo-600">{{ __('messages.services') }}</a>
                <a href="#projects" @click="mobileMenu = false" class="block py-3 text-gray-400 dark:text-gray-300 font-medium hover:text-indigo-600">{{ __('messages.projects') }}</a>
                <a href="#courses" @click="mobileMenu = false" class="block py-3 text-gray-400 dark:text-gray-300 font-medium hover:text-indigo-600">{{ __('messages.courses') }}</a>
                <a href="#contact" @click="mobileMenu = false" class="block py-3 text-gray-400 dark:text-gray-300 font-medium hover:text-indigo-600">{{ __('messages.contact') }}</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    @php
    $heroSection = $sections->firstWhere('order', 1);
    @endphp
    <section id="home" class="min-h-screen flex items-center justify-center relative overflow-hidden pt-20">
        <div class="absolute inset-0 hero-gradient"></div>
        <div class="absolute inset-0 overflow-hidden">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
        </div>

        <div class="container-custom relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-{{ $locale === 'ar' ? 'right' : 'left' }} fade-in">
                    <div class="mb-6">
                        <span class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-500/10 dark:bg-indigo-500/20 border border-indigo-500/30 text-indigo-600 dark:text-indigo-400 rounded-full font-semibold">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            {{ __('messages.available_for_work') }}
                        </span>
                    </div>

                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
                        <span class="gradient-text">{{ $heroSection?->getLocalizedTitle() ?? __('messages.hero_title') }}</span>
                    </h1>

                    <div x-data="{ expanded: false }" class="mb-8 max-w-2xl mx-auto lg:mx-0">
                        <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-400 leading-relaxed transition-all duration-300"
                            :class="expanded ? '' : 'line-clamp-3'">
                            {{ $heroSection?->getLocalizedContent() ?? $bio->getLocalizedAbout() }}
                        </p>
                        <button @click="expanded = !expanded"
                            class="mt-2 text-indigo-600 dark:text-indigo-400 font-bold hover:text-indigo-500 transition-colors flex items-center gap-2">
                            <span x-text="expanded ? 'أقل' : 'اقرأ المزيد...'"></span>
                            <i class="fas text-xs" :class="expanded ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        </button>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4 {{ $locale === 'ar' ? 'flex-row-reverse' : '' }}">
                        <a href="#contact" class="btn-primary px-8 py-4 text-white rounded-full font-semibold text-lg inline-flex items-center justify-center gap-3">
                            <i class="fas fa-paper-plane"></i>
                            {{ __('messages.hire_me') }}
                        </a>
                        <a href="#projects" class="px-8 py-4 border-2 border-indigo-600 text-indigo-600 dark:text-indigo-400 rounded-full font-semibold text-lg hover:bg-indigo-600 hover:text-white transition-all inline-flex items-center justify-center gap-3">
                            <i class="fas fa-folder-open"></i>
                            {{ __('messages.my_work') }}
                        </a>
                    </div>

                    <!-- Social Links -->
                    @if($bio->social_links)
                    <div class="mt-10 flex justify-center lg:justify-start gap-4 {{ $locale === 'ar' ? 'flex-row-reverse' : '' }}">
                        @foreach($bio->social_links as $platform => $url)
                        @if($url)
                        <a href="{{ $url }}" target="_blank" class="social-btn w-12 h-12 rounded-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all">
                            <i class="fab fa-{{ $platform }} text-lg"></i>
                        </a>
                        @endif
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="flex justify-center fade-in" style="animation-delay: 0.3s">
                    <div class="relative">
                        <div class="profile-ring w-72 h-72 md:w-96 md:h-96 rounded-full overflow-hidden shadow-2xl">
                            <img src="{{ $bio->getProfileImageUrl() ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&h=600&fit=crop&crop=face&auto=format&format=webp' }}"
                                alt="{{ $bio->full_name }}"
                                class="w-full h-full object-cover">
                        </div>

                        <!-- Floating badges -->
                        <div class="absolute -top-4 -right-4 md:-right-8 glass-effect rounded-2xl p-4 floating">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-sm">{{ __('messages.projects_completed') }}</p>
                                    <p class="text-gray-500 text-xs">50+</p>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -bottom-4 -left-4 md:-left-8 glass-effect rounded-2xl p-4 floating" style="animation-delay: 2s">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-code text-white"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-sm">{{ __('messages.years_experience') }}</p>
                                    <p class="text-gray-500 text-xs">5+ {{ __('messages.years') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            @php
            $yearsExp = $bio->years_experience ?? rand(3, 7);
            $projectsCompleted = $bio->projects_completed ?? rand(40, 60);
            $happyClients = $bio->happy_clients ?? rand(25, 40);
            $awardsWon = $bio->awards_won ?? rand(10, 20);
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto mt-10">
                <div class="text-center glass-effect rounded-2xl p-6 fade-in">
                    <div class="text-4xl font-bold gradient-text mb-2">{{ $yearsExp }}+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-medium">{{ __('messages.years_experience') }}</div>
                </div>
                <div class="text-center glass-effect rounded-2xl p-6 fade-in" style="animation-delay: 0.1s">
                    <div class="text-4xl font-bold gradient-text mb-2">{{ $projectsCompleted }}+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-medium">{{ __('messages.projects_completed') }}</div>
                </div>
                <div class="text-center glass-effect rounded-2xl p-6 fade-in" style="animation-delay: 0.2s">
                    <div class="text-4xl font-bold gradient-text mb-2">{{ $happyClients }}+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-medium">{{ __('messages.happy_clients') }}</div>
                </div>
                <div class="text-center glass-effect rounded-2xl p-6 fade-in" style="animation-delay: 0.3s">
                    <div class="text-4xl font-bold gradient-text mb-2">{{ $awardsWon }}+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-medium">{{ __('messages.awards_won') }}</div>
                </div>
            </div>
            <!-- Scroll Down Indicator -->
            <div class="flex justify-center mt-20 mb-12">
                <a href="#about" @click.prevent="document.getElementById('about').scrollIntoView({ behavior: 'smooth' })"
                    class="group flex flex-col items-center gap-3 text-gray-400 dark:text-gray-500 hover:text-indigo-600 transition-all duration-300">
                    <span class="text-xs font-bold uppercase tracking-[0.2em] group-hover:tracking-[0.3em] transition-all">{{ __('messages.scroll_down') }}</span>
                    <i class="fas fa-chevron-down animate-bounce text-xl"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    @php
    $aboutSection = $sections->firstWhere('order', 2);
    @endphp
    <section id="about" class="section-padding bg-white dark:bg-gray-900 overflow-hidden relative">
        <div class="blob blob-1 opacity-10"></div>
        <div class="container-custom relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="fade-in">
                    <h2 class="text-4xl md:text-5xl font-bold mb-8">
                        <span class="gradient-text">{{ $aboutSection?->getLocalizedTitle() ?? __('messages.about') }}</span>
                    </h2>

                    <div x-data="{ expanded: false }" class="relative mb-8">
                        <div class="relative transition-all duration-700 ease-in-out overflow-hidden"
                            :style="expanded ? 'max-height: 1000px' : 'max-height: 120px'">
                            <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed transition-all duration-300"
                                :class="expanded ? '' : 'line-clamp-4'">
                                {{ $bio->getLocalizedAbout() }}
                            </p>
                        </div>

                        <button @click="expanded = !expanded"
                            class="mt-4 flex items-center gap-2 text-indigo-600 dark:text-indigo-400 font-bold hover:text-indigo-500 transition-all focus:outline-none group">
                            <span x-text="expanded ? 'أقل' : 'اقرأ المزيد...'"></span>
                            <i class="fas transition-transform duration-300" :class="expanded ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        </button>
                    </div>

                    @if($bio->skills)
                    @php
                    $skills = $bio->skills;
                    if (is_string($skills)) {
                    $skills = json_decode($skills, true) ?? [];
                    }
                    @endphp
                    @if(is_array($skills) && count($skills) > 0)
                    <div class="space-y-6">
                        @foreach($skills as $skill)
                        <div class="fade-in">
                            <div class="flex justify-between mb-3">
                                <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $skill['name'] ?? $skill }}</span>
                                <span class="text-indigo-600 dark:text-indigo-400 font-medium">{{ $skill['level'] ?? '' }}%</span>
                            </div>
                            @if(isset($skill['level']))
                            <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-3 overflow-hidden border border-gray-200 dark:border-gray-700 shadow-inner">
                                <div class="skill-bar h-3 rounded-full" style="width: {{ $skill['level'] }}%"></div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @endif
                </div>
                <div class="fade-in relative" style="animation-delay: 0.3s">
                    <div class="relative group max-w-[300px] mx-auto lg:mx-0 lg:ml-auto">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-3xl transform rotate-3 opacity-20 blur-xl group-hover:rotate-6 transition-transform duration-500"></div>
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-3xl transform rotate-3 opacity-30 group-hover:rotate-2 transition-transform duration-500"></div>
                        <img src="{{ $aboutSection?->getImageUrl() ?? $bio->getProfileImageUrl() ?? 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=700&fit=crop&auto=format&format=webp' }}"
                            alt="{{ $bio->full_name }}"
                            class="relative rounded-3xl shadow-2xl w-64 object-cover aspect-[4/5] object-center">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Services Section -->
    @php
    $servicesSection = $sections->firstWhere('order', 3);
    @endphp
    <section id="services" class="section-padding bg-gradient-to-br from-gray-50 to-indigo-50 dark:from-gray-800 dark:to-gray-900">
        <div class="container-custom">
            <div class="text-center mb-16 fade-in">
                <span class="inline-block px-4 py-2 bg-indigo-500/10 text-indigo-600 rounded-full text-sm font-semibold mb-4">{{ __('messages.services') }}</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="gradient-text">{{ $servicesSection?->getLocalizedTitle() ?? __('messages.what_i_do') }}</span>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">{{ $servicesSection?->getLocalizedContent() ?? '' }}</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                $services = [
                ['icon' => 'laptop-code', 'title' => __('messages.web_development'), 'description' => 'تطوير مواقع وتطبيقات ويب متكاملة باستخدام أحدث التقنيات', 'color' => 'from-blue-500 to-cyan-500'],
                ['icon' => 'mobile-alt', 'title' => __('messages.mobile_apps'), 'description' => 'تطبيقات جوال احترافية Native و Cross-platform', 'color' => 'from-purple-500 to-pink-500'],
                ['icon' => 'palette', 'title' => __('messages.ui_ux_design'), 'description' => 'تصميم واجهات مستخدم عصرية وجذابة وتجربة مستخدم متميزة', 'color' => 'from-orange-500 to-red-500'],
                ['icon' => 'server', 'title' => __('messages.api_development'), 'description' => 'بناء واجهات برمجية آمنة وفعالة REST & GraphQL', 'color' => 'from-green-500 to-teal-500'],
                ];
                @endphp

                @foreach($services as $index => $service)
                @php
                $colors = $service['color'] ?? 'from-indigo-500 to-purple-500';
                @endphp
                <div class="glass-effect rounded-2xl p-8 card-hover fade-in gradient-border" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="service-icon w-16 h-16 bg-gradient-to-br {{ $colors }} rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-{{ $service['icon'] }} text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">{{ $service['title'] }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $service['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    @php
    $projectsSection = $sections->firstWhere('order', 4);
    @endphp
    <section id="projects" class="section-padding bg-white dark:bg-gray-900">
        <div class="container-custom">
            <div class="text-center mb-16 fade-in">
                <span class="inline-block px-4 py-2 bg-indigo-500/10 text-indigo-600 rounded-full text-sm font-semibold mb-4">{{ __('messages.projects') }}</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="gradient-text">{{ $projectsSection?->getLocalizedTitle() ?? __('messages.featured_projects') }}</span>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">{{ $projectsSection?->getLocalizedContent() ?? '' }}</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                $projectImages = [
                'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop&auto=format&format=webp',
                'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop&auto=format&format=webp',
                'https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=600&h=400&fit=crop&auto=format&format=webp',
                'https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?w=600&h=400&fit=crop&auto=format&format=webp',
                'https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&h=400&fit=crop&auto=format&format=webp',
                'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&h=400&fit=crop&auto=format&format=webp',
                ];
                @endphp
                @foreach($featuredProjects as $index => $project)
                <div class="premium-card group glass-effect rounded-[1.5rem] shadow-xl overflow-hidden fade-in flex flex-col" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="relative aspect-video overflow-hidden">
                        <img src="{{ $project->getImageUrl() ?? $projectImages[$index % count($projectImages)] }}"
                            alt="{{ $project->getLocalizedTitle() }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="flex gap-4 {{ $locale === 'ar' ? 'flex-row-reverse' : '' }}">
                                @if($project->link)
                                <a href="{{ $project->link }}" target="_blank" class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-indigo-600 transition-colors">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                @endif
                                @if($project->github_link)
                                <a href="{{ $project->github_link }}" target="_blank" class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-indigo-600 transition-colors">
                                    <i class="fab fa-github"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="p-8 flex-grow flex flex-col">
                        @php
                        $tags = $project->tags;
                        if (is_string($tags)) {
                        $tags = json_decode($tags, true) ?? [];
                        }
                        $tags = is_array($tags) ? $tags : [];
                        $description = $project->getLocalizedDescription() ?? '';
                        $descLength = mb_strlen($description);
                        $truncatedDesc = $descLength > 120 ? mb_substr($description, 0, 120) . '...' : $description;
                        @endphp

                        @if(count($tags) > 0)
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach(array_slice($tags, 0, 3) as $tag)
                            <span class="tag-pill px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full">{{ trim($tag, '"') }}</span>
                            @endforeach
                        </div>
                        @endif

                        <h3 class="text-xl font-bold mb-4 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $project->getLocalizedTitle() }}</h3>

                        <div x-data="{ expanded: false }" class="mb-6 flex-grow">
                            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed"
                                :class="expanded ? '' : 'line-clamp-3'">
                                <span x-show="!expanded">{{ $truncatedDesc }}</span>
                                <span x-show="expanded" x-cloak>{{ $description }}</span>
                            </p>

                            @if($descLength > 120)
                            <button @click="expanded = !expanded" class="more-btn text-sm mt-3 font-bold flex items-center gap-2 transition-all duration-300 hover:gap-3">
                                <span x-text="expanded ? 'أقل' : 'المزيد'"></span>
                                <i class="fas text-xs transition-transform duration-300" :class="expanded ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            </button>
                            @endif
                        </div>

                        <div class="pt-6 border-t border-gray-100 dark:border-white/5 flex justify-between items-center mt-auto">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-indigo-500/10 flex items-center justify-center">
                                    <i class="fas fa-layer-group text-indigo-600 text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500">{{ count($tags) }} {{ __('messages.technologies') }}</span>
                            </div>
                            <a href="{{ $project->link ?? '#' }}" class="text-sm font-bold text-gray-900 dark:text-gray-100 hover:text-indigo-600 transition-colors flex items-center gap-2 group/link">
                                {{ __('messages.view_project') }}
                                <i class="fas fa-arrow-{{ $locale === 'ar' ? 'left' : 'right' }} text-xs transition-transform group-hover/link:translate-{{ $locale === 'ar' ? 'x-[-4px]' : 'x-1' }}"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

                @if($featuredProjects->count() > 6)
                <div class="text-center mt-12">
                    <a href="#" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-indigo-600 text-indigo-600 dark:text-indigo-400 rounded-full font-semibold hover:bg-indigo-600 hover:text-white transition-all">
                        <i class="fas fa-folder-open"></i>
                        {{ __('messages.view_all_projects') }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    @php
    $coursesSection = $sections->firstWhere('order', 5);
    @endphp
    <section id="courses" class="section-padding bg-gradient-to-br from-gray-50 to-purple-50 dark:from-gray-800 dark:to-gray-900">
        <div class="container-custom">
            <div class="text-center mb-16 fade-in">
                <span class="inline-block px-4 py-2 bg-indigo-500/10 text-indigo-600 rounded-full text-sm font-semibold mb-4">{{ __('messages.my_resume') }}</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="gradient-text">{{ $coursesSection?->getLocalizedTitle() ?? __('messages.certifications') }}</span>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">{{ $coursesSection?->getLocalizedContent() ?? '' }}</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                $courseImages = [
                'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400&h=250&fit=crop&auto=format&format=webp',
                'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=400&h=250&fit=crop&auto=format&format=webp',
                'https://images.unsplash.com/photo-1501504905252-473c47e087f8?w=400&h=250&fit=crop&auto=format&format=webp',
                'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=400&h=250&fit=crop&auto=format&format=webp',
                'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=250&fit=crop&auto=format&format=webp',
                'https://images.unsplash.com/photo-1587620962725-abab7fe55159?w=400&h=250&fit=crop&auto=format&format=webp',
                ];
                @endphp
                @foreach($courses as $index => $course)
                <div class="premium-card group glass-effect rounded-[1.5rem] overflow-hidden card-hover fade-in flex flex-col" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="relative aspect-[16/10] overflow-hidden">
                        <img src="{{ $course->getCourseImageUrl() ?? $courseImages[$index % count($courseImages)] }}"
                            alt="{{ $course->getLocalizedTitle() }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center">
                            <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md text-white text-[10px] font-bold uppercase tracking-widest rounded-full border border-white/10">
                                {{ $course->provider }}
                            </span>
                        </div>
                    </div>

                    <div class="p-8 flex-grow flex flex-col">
                        @php
                        $courseDesc = $course->getLocalizedDescription() ?? '';
                        $courseDescLength = mb_strlen($courseDesc);
                        $truncatedCourseDesc = $courseDescLength > 100 ? mb_substr($courseDesc, 0, 100) . '...' : $courseDesc;
                        @endphp

                        <h3 class="text-xl font-bold mb-4 line-clamp-2 leading-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $course->getLocalizedTitle() }}</h3>

                        <div x-data="{ expanded: false }" class="mb-6 flex-grow">
                            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed"
                                :class="expanded ? '' : 'line-clamp-3'">
                                <span x-show="!expanded">{{ $truncatedCourseDesc }}</span>
                                <span x-show="expanded" x-cloak>{{ $courseDesc }}</span>
                            </p>

                            @if($courseDescLength > 100)
                            <button @click="expanded = !expanded" class="text-indigo-600 dark:text-indigo-400 text-sm mt-3 font-bold flex items-center gap-1 hover:underline">
                                <span x-text="expanded ? 'أقل' : 'المزيد'"></span>
                                <i class="fas transition-transform duration-300" :class="expanded ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            </button>
                            @endif
                        </div>

                        <div class="pt-6 border-t border-gray-100 dark:border-white/5 flex justify-between items-center mt-auto">
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-calendar-alt text-indigo-500"></i>
                                {{ $course->completion_date?->format('M Y') }}
                            </span>
                            @if($course->certificate_link)
                            <a href="{{ $course->certificate_link }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 font-bold flex items-center gap-2 text-xs group/btn relative overflow-hidden">
                                <span class="relative z-10">{{ __('messages.certificate') }}</span>
                                <i class="fas fa-certificate relative z-10"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    @php
    $contactSection = $sections->firstWhere('order', 6);
    @endphp
    <section id="contact" class="section-padding bg-white dark:bg-gray-900">
        <div class="container-custom">
            <div class="text-center mb-16 fade-in">
                <span class="inline-block px-4 py-2 bg-indigo-500/10 text-indigo-600 rounded-full text-sm font-semibold mb-4">{{ __('messages.contact') }}</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="gradient-text">{{ $contactSection?->getLocalizedTitle() ?? __('messages.get_in_touch_title') }}</span>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">{{ $contactSection?->getLocalizedContent() ?? __('messages.get_in_touch_subtitle') }}</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-16">
                <div class="fade-in">
                    <div class="space-y-6">
                        <div class="glass-effect rounded-2xl p-6 flex items-center gap-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-envelope text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">{{ __('messages.email') }}</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ $bio->email }}</p>
                            </div>
                        </div>

                        <div class="glass-effect rounded-2xl p-6 flex items-center gap-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-phone text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">{{ __('messages.phone') }}</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ $bio->phone }}</p>
                            </div>
                        </div>

                        <div class="glass-effect rounded-2xl p-6 flex items-center gap-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-map-marker-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">{{ __('messages.location') }}</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ $bio->location }}</p>
                            </div>
                        </div>

                        @if($bio->social_links)
                        <div class="pt-6">
                            <h4 class="font-bold text-lg mb-6">{{ __('messages.follow_me') }}</h4>
                            <div class="flex gap-4 {{ $locale === 'ar' ? 'flex-row-reverse' : '' }}">
                                @foreach($bio->social_links as $platform => $url)
                                @if($url)
                                <a href="{{ $url }}" target="_blank" class="social-btn w-12 h-12 rounded-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all">
                                    <i class="fab fa-{{ $platform }} text-lg"></i>
                                </a>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="fade-in" style="animation-delay: 0.2s">
                    @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 dark:bg-green-900 border border-green-300 dark:border-green-700 text-green-700 dark:text-green-300 rounded-xl">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form action="{{ route('contact.submit') }}" method="POST" class="glass-effect rounded-2xl p-8 space-y-6">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold mb-3">{{ __('messages.name') }}</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="w-full px-5 py-4 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" placeholder="اسمك" required>
                                @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-3">{{ __('messages.email') }}</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-5 py-4 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" placeholder="بريدك@الإلكتروني.com" required>
                                @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-3">{{ __('messages.phone') }}</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-5 py-4 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" placeholder="رقم الهاتف (اختياري)">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-3">{{ __('messages.subject') }}</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" class="w-full px-5 py-4 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" placeholder="موضوع الرسالة" required>
                            @error('subject')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-3">{{ __('messages.message') }}</label>
                            <textarea name="message" rows="5" class="w-full px-5 py-4 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition resize-none" placeholder="اكتب رسالتك هنا..." required>{{ old('message') }}</textarea>
                            @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full btn-primary py-4 text-white rounded-xl font-bold text-lg flex items-center justify-center gap-3">
                            <i class="fas fa-paper-plane"></i>
                            {{ __('messages.send_message') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container-custom">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="text-center md:text-{{ $locale === 'ar' ? 'right' : 'left' }}">
                    <div class="text-3xl font-bold gradient-text mb-2">{{ $bio->full_name ?? 'Portfolio' }}</div>
                    <p class="text-gray-400">{{ $bio->getLocalizedTitle() }}</p>
                </div>
                <div class="text-center md:text-{{ $locale === 'ar' ? 'left' : 'right' }}">
                    <p class="text-gray-400">&copy; {{ date('Y') }} {{ $bio->full_name }}. {{ __('messages.all_rights_reserved') }}</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Fade In Script -->
    <script>
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
    </script>
</body>

</html>