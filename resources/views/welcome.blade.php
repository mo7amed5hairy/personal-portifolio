<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $bio->full_name ?? 'Portfolio' }} | {{ $bio->getLocalizedTitle() }}</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app-BIcgRnCI.css') }}">
    <script src="{{ asset('build/assets/app-CKl8NZMC.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --secondary: #8b5cf6;
            --accent: #ec4899;
            --dark: #1e293b;
            --light: #f8fafc;
        }
        
        [x-cloak] { display: none !important; }
        
        .font-arabic { font-family: 'Cairo', sans-serif; }
        .font-english { font-family: 'Inter', sans-serif; }
        
        .gradient-text {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .dark .glass-effect {
            background: rgba(30, 41, 59, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }
        
        .skill-bar {
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            transition: width 1.5s ease-out;
        }
        
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .pulse-glow {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        .nav-blur {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dark .nav-blur {
            background: rgba(30, 41, 59, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .project-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.7) 50%, transparent 100%);
        }
        
        .social-icon {
            transition: all 0.3s ease;
        }
        
        .social-icon:hover {
            transform: translateY(-3px) scale(1.1);
        }
        
        .section-padding {
            padding: 100px 0;
        }
        
        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
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
                    <a href="#home" class="text-3xl font-bold gradient-text">{{ $bio->full_name ?? 'Portfolio' }}</a>
                </div>
                
                <div class="hidden lg:flex items-center space-x-8 {{ $locale === 'ar' ? 'space-x-reverse' : '' }}">
                    <a href="#home" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 transition-colors font-medium">{{ __('messages.home') }}</a>
                    <a href="#about" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 transition-colors font-medium">{{ __('messages.about') }}</a>
                    <a href="#services" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 transition-colors font-medium">{{ __('messages.skills') }}</a>
                    <a href="#projects" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 transition-colors font-medium">{{ __('messages.projects') }}</a>
                    <a href="#courses" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 transition-colors font-medium">{{ __('messages.courses') }}</a>
                    <a href="#contact" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 transition-colors font-medium">{{ __('messages.contact') }}</a>
                </div>
                
                <div class="flex items-center space-x-4 {{ $locale === 'ar' ? 'space-x-reverse' : '' }}">
                    <!-- Language Switch -->
                    <a href="{{ route('switch.language', ['locale' => $locale, 'to' => $locale === 'ar' ? 'en' : 'ar']) }}" 
                       class="px-4 py-2 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 font-medium hover:bg-blue-200 transition-all">
                        {{ $locale === 'ar' ? 'English' : 'العربية' }}
                    </a>
                    
                    <!-- Dark Mode Toggle -->
                    <button @click="darkMode = !darkMode" 
                            class="p-3 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
                        <i x-show="!darkMode" class="fas fa-moon text-gray-700"></i>
                        <i x-show="darkMode" class="fas fa-sun text-yellow-500" x-cloak></i>
                    </button>
                    
                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-3 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800">
                        <i class="fas fa-bars text-gray-700 dark:text-gray-300"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div x-show="mobileMenu" x-cloak class="lg:hidden glass-effect border-t">
            <div class="container-custom py-6 space-y-4">
                <a href="#home" @click="mobileMenu = false" class="block py-3 text-gray-700 dark:text-gray-300 font-medium hover:text-blue-600">{{ __('messages.home') }}</a>
                <a href="#about" @click="mobileMenu = false" class="block py-3 text-gray-700 dark:text-gray-300 font-medium hover:text-blue-600">{{ __('messages.about') }}</a>
                <a href="#services" @click="mobileMenu = false" class="block py-3 text-gray-700 dark:text-gray-300 font-medium hover:text-blue-600">{{ __('messages.skills') }}</a>
                <a href="#projects" @click="mobileMenu = false" class="block py-3 text-gray-700 dark:text-gray-300 font-medium hover:text-blue-600">{{ __('messages.projects') }}</a>
                <a href="#courses" @click="mobileMenu = false" class="block py-3 text-gray-700 dark:text-gray-300 font-medium hover:text-blue-600">{{ __('messages.courses') }}</a>
                <a href="#contact" @click="mobileMenu = false" class="block py-3 text-gray-700 dark:text-gray-300 font-medium hover:text-blue-600">{{ __('messages.contact') }}</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    @php
        $heroSection = $sections->firstWhere('slug', 'hero');
        $heroContent = $heroSection ? $heroSection->getLocalizedContent() : null;
    @endphp
    <section id="home" class="min-h-screen flex items-center justify-center relative overflow-hidden pt-20">
        <!-- Animated Background -->
        <div class="absolute inset-0 hero-gradient opacity-10"></div>
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 floating"></div>
            <div class="absolute top-40 right-10 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 floating" style="animation-delay: 2s"></div>
            <div class="absolute bottom-20 left-1/3 w-96 h-96 bg-pink-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 floating" style="animation-delay: 4s"></div>
        </div>
        
        <div class="container-custom relative z-10">
            <div class="text-center fade-in">
                <div class="mb-8">
                    <span class="inline-block px-6 py-3 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-full font-semibold mb-6">
                        {{ $heroContent['subheadline'] ?? __('messages.hero_subtitle') }}
                    </span>
                </div>
                <h1 class="text-5xl md:text-7xl font-bold mb-8 leading-tight">
                    <span class="gradient-text">{{ $heroContent['headline'] ?? __('messages.hero_title') }}</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto mb-12 leading-relaxed">
                    {{ $heroContent['description'] ?? $bio->getLocalizedAbout() }}
                </p>
                
                <div class="flex flex-col sm:flex-row justify-center gap-6 {{ $locale === 'ar' ? 'flex-row-reverse' : '' }}">
                    <a href="#contact" class="btn-primary px-8 py-4 text-white rounded-full font-semibold text-lg inline-flex items-center justify-center gap-3">
                        <i class="fas fa-envelope"></i>
                        {{ $heroContent['cta_primary'] ?? __('messages.hire_me') }}
                    </a>
                    <a href="#projects" class="px-8 py-4 border-2 border-blue-600 text-blue-600 dark:text-blue-400 rounded-full font-semibold text-lg hover:bg-blue-600 hover:text-white transition-all inline-flex items-center justify-center gap-3">
                        <i class="fas fa-briefcase"></i>
                        {{ $heroContent['cta_secondary'] ?? __('messages.my_work') }}
                    </a>
                </div>
            </div>
            
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto mt-20">
                <div class="text-center glass-effect rounded-2xl p-8 fade-in">
                    <div class="text-5xl font-bold gradient-text mb-4">5+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-medium">{{ __('messages.years_experience') }}</div>
                </div>
                <div class="text-center glass-effect rounded-2xl p-8 fade-in" style="animation-delay: 0.2s">
                    <div class="text-5xl font-bold gradient-text mb-4">50+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-medium">{{ __('messages.projects_completed') }}</div>
                </div>
                <div class="text-center glass-effect rounded-2xl p-8 fade-in" style="animation-delay: 0.4s">
                    <div class="text-5xl font-bold gradient-text mb-4">30+</div>
                    <div class="text-gray-600 dark:text-gray-400 font-medium">{{ __('messages.happy_clients') }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    @php
        $aboutSection = $sections->firstWhere('slug', 'about');
        $aboutContent = $aboutSection ? $aboutSection->getLocalizedContent() : null;
    @endphp
    <section id="about" class="section-padding bg-white dark:bg-gray-900">
        <div class="container-custom">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="fade-in">
                    <h2 class="text-4xl md:text-5xl font-bold mb-8">
                        <span class="gradient-text">{{ $aboutContent['headline'] ?? __('messages.what_i_do') }}</span>
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                        {{ $aboutContent['description'] ?? $bio->getLocalizedAbout() }}
                    </p>
                    
                    @if($bio->skills)
                    <div class="space-y-6">
                        @foreach($bio->skills as $skill)
                        <div class="fade-in">
                            <div class="flex justify-between mb-3">
                                <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $skill['name'] }}</span>
                                <span class="text-blue-600 font-medium">{{ $skill['level'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden">
                                <div class="skill-bar h-3 rounded-full" style="width: {{ $skill['level'] }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="fade-in relative">
                    <div class="absolute inset-0 hero-gradient rounded-3xl transform rotate-3 opacity-20"></div>
                    <img src="{{ $bio->getProfileImageUrl() ?? 'https://via.placeholder.com/600x700/3b82f6/ffffff?text=Profile' }}" 
                         alt="{{ $bio->full_name }}" 
                         class="relative rounded-3xl shadow-2xl w-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    @php
        $servicesSection = $sections->firstWhere('slug', 'services');
        $servicesContent = $servicesSection ? $servicesSection->getLocalizedContent() : null;
    @endphp
    <section id="services" class="section-padding bg-gray-50 dark:bg-gray-800">
        <div class="container-custom">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="gradient-text">{{ $servicesContent['headline'] ?? __('messages.what_i_do') }}</span>
                </h2>
                <div class="w-24 h-1 hero-gradient mx-auto rounded-full"></div>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $services = $servicesContent['services'] ?? [
                        ['icon' => 'code', 'title' => __('messages.web_development'), 'description' => 'Full-stack web applications using Laravel & Vue.js'],
                        ['icon' => 'mobile', 'title' => __('messages.mobile_apps'), 'description' => 'PWA and Flutter apps for mobile devices'],
                        ['icon' => 'design', 'title' => __('messages.ui_ux_design'), 'description' => 'Attractive user interface design'],
                        ['icon' => 'api', 'title' => __('messages.api_development'), 'description' => 'RESTful APIs and GraphQL APIs'],
                    ];
                @endphp
                
                @foreach($services as $index => $service)
                <div class="glass-effect rounded-2xl p-8 card-hover fade-in" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="w-16 h-16 hero-gradient rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-{{ $service['icon'] }} text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">{{ $service['title'] }}</h3>
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
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="gradient-text">{{ $projectsContent['headline'] ?? __('messages.featured_projects') }}</span>
                </h2>
                <div class="w-24 h-1 hero-gradient mx-auto rounded-full"></div>
                <p class="text-lg text-gray-600 dark:text-gray-400 mt-6">{{ $projectsContent['description'] ?? '' }}</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredProjects as $index => $project)
                <div class="group relative overflow-hidden rounded-2xl shadow-xl card-hover fade-in" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ $project->getImageUrl() ?? 'https://via.placeholder.com/600x400/3b82f6/ffffff?text=Project' }}" 
                             alt="{{ $project->getLocalizedTitle() }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    </div>
                    
                    <div class="project-overlay absolute inset-0 p-6 flex flex-col justify-end opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="flex flex-wrap gap-2 mb-4">
                            @php
                                $tags = $project->tags;
                                if (is_string($tags)) {
                                    $tags = json_decode($tags, true) ?? [];
                                }
                                $tags = is_array($tags) ? $tags : [];
                            @endphp
                            @foreach(array_slice($tags, 0, 3) as $tag)
                                <span class="px-3 py-1 bg-blue-600/90 text-white text-xs rounded-full">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">{{ $project->getLocalizedTitle() }}</h3>
                        <p class="text-gray-200 text-sm mb-4 line-clamp-2">{{ $project->getLocalizedDescription() }}</p>
                        <div class="flex gap-4 {{ $locale === 'ar' ? 'flex-row-reverse' : '' }}">
                            @if($project->link)
                            <a href="{{ $project->link }}" target="_blank" class="text-white hover:text-blue-400 transition flex items-center gap-2">
                                <i class="fas fa-external-link-alt"></i>
                                {{ __('messages.live_demo') }}
                            </a>
                            @endif
                            @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" class="text-white hover:text-blue-400 transition flex items-center gap-2">
                                <i class="fab fa-github"></i>
                                {{ __('messages.github') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    @php
        $coursesSection = $sections->firstWhere('slug', 'courses');
        $coursesContent = $coursesSection ? $coursesSection->getLocalizedContent() : null;
    @endphp
    <section id="courses" class="section-padding bg-gray-50 dark:bg-gray-800">
        <div class="container-custom">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="gradient-text">{{ $coursesContent['headline'] ?? __('messages.my_resume') }}</span>
                </h2>
                <div class="w-24 h-1 hero-gradient mx-auto rounded-full"></div>
                <p class="text-lg text-gray-600 dark:text-gray-400 mt-6">{{ $coursesContent['description'] ?? '' }}</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($courses as $index => $course)
                <div class="glass-effect rounded-2xl overflow-hidden card-hover fade-in" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="relative">
                        <img src="{{ $course->getCourseImageUrl() ?? 'https://via.placeholder.com/400x250/8b5cf6/ffffff?text=Course' }}" 
                             alt="{{ $course->getLocalizedTitle() }}" 
                             class="w-full h-56 object-cover">
                        <div class="absolute top-4 right-4 bg-white/90 dark:bg-gray-900/90 backdrop-blur px-4 py-2 rounded-full text-sm font-semibold">
                            {{ $course->provider }}
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3">{{ $course->getLocalizedTitle() }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">{{ $course->getLocalizedDescription() }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">{{ $course->completion_date?->format('M Y') }}</span>
                            @if($course->certificate_link)
                            <a href="{{ $course->certificate_link }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-2">
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
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="gradient-text">{{ $contactContent['headline'] ?? __('messages.get_in_touch_title') }}</span>
                </h2>
                <div class="w-24 h-1 hero-gradient mx-auto rounded-full"></div>
                <p class="text-lg text-gray-600 dark:text-gray-400 mt-6">{{ $contactContent['description'] ?? __('messages.get_in_touch_subtitle') }}</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-16">
                <div class="fade-in">
                    <div class="space-y-8">
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-16 hero-gradient rounded-2xl flex items-center justify-center">
                                <i class="fas fa-envelope text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-2">{{ __('messages.email') }}</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ $bio->email }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-16 hero-gradient rounded-2xl flex items-center justify-center">
                                <i class="fas fa-phone text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-2">{{ __('messages.phone') }}</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ $bio->phone }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-16 hero-gradient rounded-2xl flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-2">{{ __('messages.location') }}</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ $bio->location }}</p>
                            </div>
                        </div>
                        
                        <!-- Social Links -->
                        @if($bio->social_links)
                        <div class="pt-8">
                            <h4 class="font-bold text-lg mb-6">{{ __('messages.follow_me') }}</h4>
                            <div class="flex gap-4 {{ $locale === 'ar' ? 'flex-row-reverse' : '' }}">
                                @foreach($bio->social_links as $platform => $url)
                                    @if($url)
                                    <a href="{{ $url }}" target="_blank" class="w-12 h-12 rounded-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center hover:bg-blue-600 hover:text-white social-icon">
                                        <i class="fab fa-{{ $platform }} text-lg"></i>
                                    </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="fade-in">
                    <form class="glass-effect rounded-2xl p-8 space-y-6">
                        <div>
                            <label class="block text-sm font-medium mb-3">{{ __('messages.name') }}</label>
                            <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-3">{{ __('messages.email') }}</label>
                            <input type="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-3">{{ __('messages.message') }}</label>
                            <textarea rows="5" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none"></textarea>
                        </div>
                        <button type="submit" class="w-full btn-primary py-4 text-white rounded-lg font-semibold text-lg">
                            <i class="fas fa-paper-plane mr-2"></i>
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
                <div class="text-center md:text-left">
                    <div class="text-3xl font-bold gradient-text mb-2">{{ $bio->full_name ?? 'Portfolio' }}</div>
                    <p class="text-gray-400">{{ $bio->getLocalizedTitle() }}</p>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-gray-400">&copy; {{ date('Y') }} {{ $bio->full_name }}. {{ __('messages.all_rights_reserved') }}</p>
                    <p class="text-gray-500 text-sm mt-2">{{ __('messages.designed_by') }} {{ $bio->full_name }}</p>
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
