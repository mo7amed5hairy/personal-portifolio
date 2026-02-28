<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">

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
            --success: #10b981;
            --warning: #f59e0b;
            --dark: #0f172a;
            --light: #f8fafc;
        }

        [x-cloak] {
            display: none !important;
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
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .dark .glass-effect {
            background: rgba(30, 41, 59, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0.2, 0, 1);
        }

        .card-hover:hover {
            transform: translateY(-12px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.4);
        }

        .skill-bar {
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            transition: width 1.5s ease-out;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(40px);
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
                transform: translateY(-25px) rotate(5deg);
            }
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            animation: blob-float 15s ease-in-out infinite;
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

        .nav-blur {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .dark .nav-blur {
            background: rgba(15, 23, 42, 0.85);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
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

                <div class="hidden lg:flex items-center space-x-8 {{ $locale === 'ar' ? 'space-x-reverse' : '' }}">
                    <a href="#home" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 transition-colors font-medium">{{ __('messages.home') }}</a>
                    <a href="#about" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 transition-colors font-medium">{{ __('messages.about') }}</a>
                    <a href="#services" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 transition-colors font-medium">{{ __('messages.services') }}</a>
                    <a href="#projects" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 transition-colors font-medium">{{ __('messages.projects') }}</a>
                    <a href="#courses" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 transition-colors font-medium">{{ __('messages.courses') }}</a>
                    <a href="#contact" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 transition-colors font-medium">{{ __('messages.contact') }}</a>
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
    $heroSection = $sections->firstWhere('slug', 'hero');
    $heroContent = $heroSection ? $heroSection->getLocalizedContent() : null;
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
                            {{ $heroContent['subheadline'] ?? __('messages.available_for_work') }}
                        </span>
                    </div>

                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
                        <span class="gradient-text">{{ $heroContent['headline'] ?? __('messages.hero_title') }}</span>
                    </h1>

                    <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-400 max-w-2xl mb-8 leading-relaxed">
                        {{ $bio->getLocalizedAbout() }}
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4 {{ $locale === 'ar' ? 'flex-row-reverse' : '' }}">
                        <a href="#contact" class="btn-primary px-8 py-4 text-white rounded-full font-semibold text-lg inline-flex items-center justify-center gap-3">
                            <i class="fas fa-paper-plane"></i>
                            {{ $heroContent['cta_primary'] ?? __('messages.hire_me') }}
                        </a>
                        <a href="#projects" class="px-8 py-4 border-2 border-indigo-600 text-indigo-600 dark:text-indigo-400 rounded-full font-semibold text-lg hover:bg-indigo-600 hover:text-white transition-all inline-flex items-center justify-center gap-3">
                            <i class="fas fa-folder-open"></i>
                            {{ $heroContent['cta_secondary'] ?? __('messages.my_work') }}
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
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto mt-20">
                <div class="text-center glass-effect rounded-2xl p-6 fade-in">
                    <div class="text-4xl font-bold gradient-text mb-2">5+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-medium">{{ __('messages.years_experience') }}</div>
                </div>
                <div class="text-center glass-effect rounded-2xl p-6 fade-in" style="animation-delay: 0.1s">
                    <div class="text-4xl font-bold gradient-text mb-2">50+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-medium">{{ __('messages.projects_completed') }}</div>
                </div>
                <div class="text-center glass-effect rounded-2xl p-6 fade-in" style="animation-delay: 0.2s">
                    <div class="text-4xl font-bold gradient-text mb-2">30+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-medium">{{ __('messages.happy_clients') }}</div>
                </div>
                <div class="text-center glass-effect rounded-2xl p-6 fade-in" style="animation-delay: 0.3s">
                    <div class="text-4xl font-bold gradient-text mb-2">15+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-medium">{{ __('messages.awards_won') }}</div>
                </div>
            </div>
        </div>

        <!-- Scroll Down -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2">
            <a href="#about" class="flex flex-col items-center gap-2 text-gray-500 hover:text-indigo-600 transition-colors">
                <span class="text-sm">{{ __('messages.scroll_down') }}</span>
                <i class="fas fa-chevron-down animate-bounce"></i>
            </a>
        </div>
    </section>

    <!-- About Section -->
    @php
    $aboutSection = $sections->firstWhere('slug', 'about');
    $aboutContent = $aboutSection ? $aboutSection->getLocalizedContent() : null;
    @endphp
    <section id="about" class="section-padding bg-white dark:bg-gray-900">
        <div class="container-custom">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="fade-in">
                    <h2 class="text-4xl md:text-5xl font-bold mb-8">
                        <span class="gradient-text">{{ $aboutContent['headline'] ?? 'من أنا' }}</span>
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                        {{ $bio->getLocalizedAbout() }}
                    </p>

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
                                <span class="text-indigo-600 font-medium">{{ $skill['level'] ?? '' }}%</span>
                            </div>
                            @if(isset($skill['level']))
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden">
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
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-3xl transform rotate-3 opacity-30"></div>
                        <img src="{{ $aboutSection?->getImageUrl() ?? $bio->getProfileImageUrl() ?? 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=700&fit=crop&auto=format&format=webp' }}"
                            alt="{{ $bio->full_name }}"
                            class="relative rounded-3xl shadow-2xl w-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    @php
    $servicesSection = $sections->firstWhere('slug', 'services');
    $servicesContent = $servicesSection ? $servicesSection->getLocalizedContent() : null;
    @endphp
    <section id="services" class="section-padding bg-gradient-to-br from-gray-50 to-indigo-50 dark:from-gray-800 dark:to-gray-900">
        <div class="container-custom">
            <div class="text-center mb-16 fade-in">
                <span class="inline-block px-4 py-2 bg-indigo-500/10 text-indigo-600 rounded-full text-sm font-semibold mb-4">{{ __('messages.services') }}</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="gradient-text">{{ $servicesContent['headline'] ?? __('messages.what_i_do') }}</span>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">{{ $servicesContent['description'] ?? '' }}</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                $services = $servicesContent['services'] ?? [
                ['icon' => 'laptop-code', 'title' => __('messages.web_development'), 'description' => 'تطوير مواقع وتطبيقات ويب متكاملة باستخدام أحدث التقنيات', 'color' => 'from-blue-500 to-cyan-500'],
                ['icon' => 'mobile-alt', 'title' => __('messages.mobile_apps'), 'description' => 'تطبيقات جوال احترافية Native و Cross-platform', 'color' => 'from-purple-500 to-pink-500'],
                ['icon' => 'palette', 'title' => __('messages.ui_ux_design'), 'description' => 'تصميم واجهات مستخدم عصرية وجذابة用户体验', 'color' => 'from-orange-500 to-red-500'],
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
    $projectsSection = $sections->firstWhere('slug', 'featured-projects');
    $projectsContent = $projectsSection ? $projectsSection->getLocalizedContent() : null;
    @endphp
    <section id="projects" class="section-padding bg-white dark:bg-gray-900">
        <div class="container-custom">
            <div class="text-center mb-16 fade-in">
                <span class="inline-block px-4 py-2 bg-indigo-500/10 text-indigo-600 rounded-full text-sm font-semibold mb-4">{{ __('messages.projects') }}</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="gradient-text">{{ $projectsContent['headline'] ?? __('messages.featured_projects') }}</span>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">{{ $projectsContent['description'] ?? '' }}</p>
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
                <div class="project-card group rounded-2xl shadow-xl overflow-hidden fade-in" style="animation-delay: {{ $index * 0.1 }}s">
                    <img src="{{ $project->getImageUrl() ?? $projectImages[$index % count($projectImages)] }}"
                        alt="{{ $project->getLocalizedTitle() }}"
                        class="w-full h-64 object-cover">

                    <div class="project-content">
                        @php
                        $tags = $project->tags;
                        if (is_string($tags)) {
                            $tags = json_decode($tags, true) ?? [];
                        }
                        $tags = is_array($tags) ? $tags : [];
                        $description = $project->getLocalizedDescription() ?? '';
                        $descLength = strlen($description);
                        $truncatedDesc = $descLength > 100 ? substr($description, 0, 100) . '...' : $description;
                        @endphp
                        
                        @if(count($tags) > 0)
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach(array_slice($tags, 0, 3) as $tag)
                            <span class="px-3 py-1 bg-indigo-600/90 text-white text-xs rounded-full">{{ trim($tag, '"') }}</span>
                            @endforeach
                        </div>
                        @endif
                        
                        <h3 class="text-xl font-bold text-white mb-2">{{ $project->getLocalizedTitle() }}</h3>
                        
                        @if($descLength > 100)
                        <div x-data="{ expanded: false }" class="mb-4">
                            <p class="text-gray-300 text-sm" x-show="!expanded">{{ $truncatedDesc }}</p>
                            <p class="text-gray-300 text-sm" x-show="expanded" x-cloak>{{ $description }}</p>
                            <button @click="expanded = !expanded" class="text-indigo-400 text-sm mt-1 hover:underline">
                                <span x-show="!expanded">المزيد</span>
                                <span x-show="expanded" x-cloak>أقل</span>
                            </button>
                        </div>
                        @else
                        <p class="text-gray-300 text-sm mb-4">{{ $description }}</p>
                        @endif
                        
                        <div class="flex gap-4 {{ $locale === 'ar' ? 'flex-row-reverse' : '' }}">
                            @if($project->link)
                            <a href="{{ $project->link }}" target="_blank" class="text-white hover:text-indigo-400 transition flex items-center gap-2">
                                <i class="fas fa-external-link-alt"></i>
                                {{ __('messages.live_demo') }}
                            </a>
                            @endif
                            @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" class="text-white hover:text-indigo-400 transition flex items-center gap-2">
                                <i class="fab fa-github"></i>
                                {{ __('messages.github') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                        @endif
                        
                        <h3 class="text-xl font-bold text-white mb-2">{{ $project->getLocalizedTitle() }}</h3>
                        
                        @php
                        $description = $project->getLocalizedDescription() ?? '';
                        $truncatedDesc = strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;
                        @endphp
                        
                        @if(strlen($description) > 100)
                        <div x-data="{ expanded: false }" class="mb-4">
                            <p class="text-gray-300 text-sm" x-show="!expanded">{{ $truncatedDesc }}</p>
                            <p class="text-gray-300 text-sm" x-show="expanded" x-cloak>{{ $description }}</p>
                            <button @click="expanded = !expanded" class="text-indigo-400 text-sm mt-1 hover:underline">
                                <span x-show="!expanded">المزيد</span>
                                <span x-show="expanded" x-cloak>أقل</span>
                            </button>
                        </div>
                        @else
                        <p class="text-gray-300 text-sm mb-4">{{ $description }}</p>
                        @endif
                        
                        <h3 class="text-xl font-bold text-white mb-2">{{ $project->getLocalizedTitle() }}</h3>
                        
                        @php
                        $description = $project->getLocalizedDescription() ?? '';
                        $truncatedDesc = strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;
                        @                        @if(strendphp
                        
len($description) > 100)
                        <div x-data="{ expanded: false }" class="mb-4">
                            <p class="text-gray-300 text-sm" x-show="!expanded">{{ $truncatedDesc }}</p>
                            <p class="text-gray-300 text-sm" x-show="expanded" x-cloak>{{ $description }}</p>
                            <button @click="expanded = !expanded" class="text-indigo-400 text-sm mt-1 hover:underline">
                                <span x-show="!expanded">المزيد</span>
                                <span x-show="expanded" x-cloak>أقل</span>
                            </button>
                        </div>
                        @else
                        <p class="text-gray-300 text-sm mb-4">{{ $description }}</p>
                        @endif
                        
                        <div class="flex gap-4 {{ $locale === 'ar' ? 'flex-row-reverse' : '' }}">
                            @if($project->link)
                            <a href="{{ $project->link }}" target="_blank" class="text-white hover:text-indigo-400 transition flex items-center gap-2">
                                <i class="fas fa-external-link-alt"></i>
                                {{ __('messages.live_demo') }}
                            </a>
                            @endif
                            @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" class="text-white hover:text-indigo-400 transition flex items-center gap-2">
                                <i class="fab fa-github"></i>
                                {{ __('messages.github') }}
                            </a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($featuredProjects->count() > 6)
                <div class="text-center mt-12">
                    <a href="#" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-indigo-600 text-indigo-600 dark:text-indigo-400 rounded-full font-semibold hover:bg-indigo-600 hover:text-white transition-all">
                        <i class="fas fa-folder-open"></i>
                        {{ __('messages.view_all_projects') }}
                    </a>
                </div>
                @endif
            </div>
    </section>

    <!-- Courses Section -->
    @php
    $coursesSection = $sections->firstWhere('slug', 'courses');
    $coursesContent = $coursesSection ? $coursesSection->getLocalizedContent() : null;
    @endphp
    <section id="courses" class="section-padding bg-gradient-to-br from-gray-50 to-purple-50 dark:from-gray-800 dark:to-gray-900">
        <div class="container-custom">
            <div class="text-center mb-16 fade-in">
                <span class="inline-block px-4 py-2 bg-indigo-500/10 text-indigo-600 rounded-full text-sm font-semibold mb-4">{{ __('messages.my_resume') }}</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="gradient-text">{{ $coursesContent['headline'] ?? __('messages.certifications') }}</span>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">{{ $coursesContent['description'] ?? '' }}</p>
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
                <div class="course-card glass-effect rounded-2xl overflow-hidden card-hover fade-in" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="relative">
                        <img src="{{ $course->getCourseImageUrl() ?? $courseImages[$index % count($courseImages)] }}"
                            alt="{{ $course->getLocalizedTitle() }}"
                            class="w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur text-white text-xs rounded-full">
                                {{ $course->provider }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        @php
                        $courseDesc = $course->getLocalizedDescription() ?? '';
                        $truncatedCourseDesc = strlen($courseDesc) > 80 ? substr($courseDesc, 0, 80) . '...' : $courseDesc;
                        @endphp
                        <h3 class="text-lg font-bold mb-3 line-clamp-2">{{ $course->getLocalizedTitle() }}</h3>
                        
                        @if(strlen($courseDesc) > 80)
                        <div x-data="{ expanded: false }" class="mb-4">
                            <p class="text-gray-600 dark:text-gray-400 text-sm" x-show="!expanded">{{ $truncatedCourseDesc }}</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm" x-show="expanded" x-cloak>{{ $courseDesc }}</p>
                            <button @click="expanded = !expanded" class="text-indigo-600 dark:text-indigo-400 text-sm mt-1 hover:underline">
                                <span x-show="!expanded">المزيد</span>
                                <span x-show="expanded" x-cloak>أقل</span>
                            </button>
                        </div>
                        @else
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ $courseDesc }}</p>
                        @endif
                        
                        <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-calendar-alt ml-1"></i>
                                {{ $course->completion_date?->format('M Y') }}
                            </span>
                            @if($course->certificate_link)
                            <a href="{{ $course->certificate_link }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline flex items-center gap-2 text-sm">
                                <i class="fas fa-certificate"></i>
                                {{ __('messages.certificate') }}
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
    $contactSection = $sections->firstWhere('slug', 'contact');
    $contactContent = $contactSection ? $contactSection->getLocalizedContent() : null;
    @endphp
    <section id="contact" class="section-padding bg-white dark:bg-gray-900">
        <div class="container-custom">
            <div class="text-center mb-16 fade-in">
                <span class="inline-block px-4 py-2 bg-indigo-500/10 text-indigo-600 rounded-full text-sm font-semibold mb-4">{{ __('messages.contact') }}</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="gradient-text">{{ $contactContent['headline'] ?? __('messages.get_in_touch_title') }}</span>
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">{{ $contactContent['description'] ?? __('messages.get_in_touch_subtitle') }}</p>
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
                    <form class="glass-effect rounded-2xl p-8 space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold mb-3">{{ __('messages.name') }}</label>
                                <input type="text" class="w-full px-5 py-4 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" placeholder="اسمك">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-3">{{ __('messages.email') }}</label>
                                <input type="email" class="w-full px-5 py-4 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" placeholder="بريدك@الإلكتروني.com">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-3">{{ __('messages.subject') }}</label>
                            <input type="text" class="w-full px-5 py-4 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" placeholder="موضوع الرسالة">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-3">{{ __('messages.message') }}</label>
                            <textarea rows="5" class="w-full px-5 py-4 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition resize-none" placeholder="اكتب رسالتك هنا..."></textarea>
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