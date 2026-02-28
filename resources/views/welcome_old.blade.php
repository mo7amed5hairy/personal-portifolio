<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $bio->full_name ?? 'Portfolio' }} | {{ $bio->getLocalizedTitle() }}</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app-BIcgRnCI.css') }}">
    <script src="{{ asset('build/assets/app-CKl8NZMC.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --accent-color: #667eea;
        }
        
        [x-cloak] { display: none !important; }
        
        .font-arabic { font-family: 'Cairo', sans-serif; }
        .font-english { font-family: 'Inter', sans-serif; }
        
        .gradient-text {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dark .glass-card {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .animate-pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        .project-card:hover .project-overlay {
            opacity: 1;
            transform: translateY(0);
        }
        
        .project-overlay {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }
        
        .skill-bar {
            transition: width 1s ease-out;
        }
        
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }
        
        .scroll-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="antialiased bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 {{ $locale === 'ar' ? 'font-arabic' : 'font-english' }}"
      x-data="{ 
          darkMode: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches), 
          mobileMenu: false, 
          videoModal: false 
      }"
      x-init="$watch('darkMode', val => { 
          localStorage.setItem('theme', val ? 'dark' : 'light');
          if (val) document.documentElement.classList.add('dark');
          else document.documentElement.classList.remove('dark');
      }); 
      if (darkMode) document.documentElement.classList.add('dark');"
      :class="{ 'dark': darkMode }">
    
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="#home" class="text-2xl font-bold gradient-text">{{ $bio->full_name ?? 'Portfolio' }}</a>
                </div>
                
                <div class="hidden md:flex items-center space-x-8 {{ $locale === 'ar' ? 'space-x-reverse' : '' }}">
                    <a href="#home" class="text-slate-600 dark:text-slate-300 hover:text-violet-600 dark:hover:text-violet-400 transition">{{ __('messages.home') }}</a>
                    <a href="#about" class="text-slate-600 dark:text-slate-300 hover:text-violet-600 dark:hover:text-violet-400 transition">{{ __('messages.about') }}</a>
                    <a href="#services" class="text-slate-600 dark:text-slate-300 hover:text-violet-600 dark:hover:text-violet-400 transition">{{ __('messages.skills') }}</a>
                    <a href="#projects" class="text-slate-600 dark:text-slate-300 hover:text-violet-600 dark:hover:text-violet-400 transition">{{ __('messages.projects') }}</a>
                    <a href="#courses" class="text-slate-600 dark:text-slate-300 hover:text-violet-600 dark:hover:text-violet-400 transition">{{ __('messages.courses') }}</a>
                    <a href="#contact" class="text-slate-600 dark:text-slate-300 hover:text-violet-600 dark:hover:text-violet-400 transition">{{ __('messages.contact') }}</a>
                </div>
                
                <div class="flex items-center space-x-4 {{ $locale === 'ar' ? 'space-x-reverse' : '' }}">
                    <!-- Language Switch -->
                    <a href="{{ route('switch.language', ['locale' => $locale, 'to' => $locale === 'ar' ? 'en' : 'ar']) }}" 
                       class="px-3 py-1 rounded-full bg-violet-100 dark:bg-violet-900 text-violet-700 dark:text-violet-300 text-sm font-medium hover:bg-violet-200 transition">
                        {{ $locale === 'ar' ? 'English' : 'العربية' }}
                    </a>
                    
                    <!-- Dark Mode Toggle -->
                    <button @click="darkMode = !darkMode; document.documentElement.classList.toggle('dark')" 
                            class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </button>
                    
                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenu = !mobileMenu" class="md:hidden p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div x-show="mobileMenu" class="md:hidden bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800" x-cloak>
            <div class="px-4 py-4 space-y-2">
                <a href="#home" @click="mobileMenu = false" class="block py-2 text-slate-600 dark:text-slate-300">{{ __('messages.home') }}</a>
                <a href="#about" @click="mobileMenu = false" class="block py-2 text-slate-600 dark:text-slate-300">{{ __('messages.about') }}</a>
                <a href="#services" @click="mobileMenu = false" class="block py-2 text-slate-600 dark:text-slate-300">{{ __('messages.skills') }}</a>
                <a href="#projects" @click="mobileMenu = false" class="block py-2 text-slate-600 dark:text-slate-300">{{ __('messages.projects') }}</a>
                <a href="#courses" @click="mobileMenu = false" class="block py-2 text-slate-600 dark:text-slate-300">{{ __('messages.courses') }}</a>
                <a href="#contact" @click="mobileMenu = false" class="block py-2 text-slate-600 dark:text-slate-300">{{ __('messages.contact') }}</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    @php
        $heroSection = $sections->firstWhere('slug', 'hero');
        $heroContent = $heroSection ? $heroSection->getLocalizedContent() : null;
    @endphp
    <section id="home" class="min-h-screen flex items-center justify-center relative overflow-hidden pt-16">
        <!-- Animated Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-violet-50 via-purple-50 to-pink-50 dark:from-slate-900 dark:via-violet-950 dark:to-purple-950">
            <div class="absolute inset-0 opacity-30">
                <div class="absolute top-20 left-10 w-72 h-72 bg-violet-400 rounded-full mix-blend-multiply filter blur-xl animate-pulse-slow"></div>
                <div class="absolute top-40 right-10 w-72 h-72 bg-pink-400 rounded-full mix-blend-multiply filter blur-xl animate-pulse-slow" style="animation-delay: 2s"></div>
                <div class="absolute bottom-20 left-1/3 w-72 h-72 bg-indigo-400 rounded-full mix-blend-multiply filter blur-xl animate-pulse-slow" style="animation-delay: 4s"></div>
            </div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-float">
                <p class="text-violet-600 dark:text-violet-400 font-semibold mb-4 text-lg">{{ $heroContent['subheadline'] ?? __('messages.hero_subtitle') }}</p>
                <h1 class="text-5xl md:text-7xl font-bold mb-6">
                    <span class="gradient-text">{{ $heroContent['headline'] ?? __('messages.hero_title') }}</span>
                </h1>
                <p class="text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto mb-8">
                    {{ $heroContent['description'] ?? $bio->getLocalizedAbout() }}
                </p>
                
                <div class="flex justify-center gap-4 {{ $locale === 'ar' ? 'flex-row-reverse' : '' }}">
                    <a href="#contact" class="px-8 py-4 bg-gradient-to-r from-violet-600 to-purple-600 text-white rounded-full font-semibold hover:shadow-lg hover:scale-105 transition transform">
                        {{ $heroContent['cta_primary'] ?? __('messages.hire_me') }}
                    </a>
                    <a href="#projects" class="px-8 py-4 border-2 border-violet-600 text-violet-600 dark:text-violet-400 rounded-full font-semibold hover:bg-violet-600 hover:text-white transition">
                        {{ $heroContent['cta_secondary'] ?? __('messages.my_work') }}
                    </a>
                </div>
            </div>
            
            <!-- Stats -->
            <div class="mt-16 grid grid-cols-3 gap-8 max-w-3xl mx-auto">
                <div class="text-center">
                    <div class="text-4xl font-bold gradient-text">5+</div>
                    <div class="text-slate-600 dark:text-slate-400">{{ __('messages.years_experience') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold gradient-text">50+</div>
                    <div class="text-slate-600 dark:text-slate-400">{{ __('messages.projects_completed') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold gradient-text">30+</div>
                    <div class="text-slate-600 dark:text-slate-400">{{ __('messages.happy_clients') }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    @php
        $aboutSection = $sections->firstWhere('slug', 'about');
        $aboutContent = $aboutSection ? $aboutSection->getLocalizedContent() : null;
    @endphp
    <section id="about" class="py-20 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="scroll-reveal">
                    <h2 class="text-4xl font-bold mb-6">{{ $aboutContent['headline'] ?? __('messages.what_i_do') }}</h2>
                    <p class="text-lg text-slate-600 dark:text-slate-400 mb-6">
                        {{ $aboutContent['description'] ?? $bio->getLocalizedAbout() }}
                    </p>
                    
                    @if($bio->skills)
                    <div class="space-y-4">
                        @foreach($bio->skills as $skill)
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="font-medium">{{ $skill['name'] }}</span>
                                <span>{{ $skill['level'] }}%</span>
                            </div>
                            <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-violet-600 to-purple-600 h-2 rounded-full" style="width: {{ $skill['level'] }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="scroll-reveal">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-violet-400 to-pink-400 rounded-2xl transform rotate-3 opacity-20"></div>
                        <img src="{{ $bio->getProfileImageUrl() ?? 'https://via.placeholder.com/500x600/667eea/ffffff?text=Profile' }}" 
                             alt="{{ $bio->full_name }}" 
                             class="relative rounded-2xl shadow-2xl w-full object-cover aspect-[4/5]">
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
    <section id="services" class="py-20 bg-slate-50 dark:bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-4xl font-bold mb-4">{{ $servicesContent['headline'] ?? __('messages.what_i_do') }}</h2>
                <div class="w-20 h-1 bg-gradient-to-r from-violet-600 to-purple-600 mx-auto rounded-full"></div>
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
                
                @foreach($services as $service)
                <div class="glass-card p-6 rounded-2xl hover:transform hover:scale-105 transition duration-300 scroll-reveal">
                    <div class="w-14 h-14 bg-gradient-to-r from-violet-600 to-purple-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($service['icon'] === 'code')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            @elseif($service['icon'] === 'mobile')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            @elseif($service['icon'] === 'design')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            @endif
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">{{ $service['title'] }}</h3>
                    <p class="text-slate-600 dark:text-slate-400">{{ $service['description'] }}</p>
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
    <section id="projects" class="py-20 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-4xl font-bold mb-4">{{ $projectsContent['headline'] ?? __('messages.featured_projects') }}</h2>
                <p class="text-lg text-slate-600 dark:text-slate-400">{{ $projectsContent['description'] ?? '' }}</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredProjects as $project)
                <div class="project-card group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer scroll-reveal">
                    <img src="{{ $project->getImageUrl() ?? 'https://via.placeholder.com/600x400/667eea/ffffff?text=Project' }}" 
                         alt="{{ $project->getLocalizedTitle() }}" 
                         class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
                    
                    <div class="project-overlay absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/80 to-transparent p-6 flex flex-col justify-end">
                        <div class="flex flex-wrap gap-2 mb-3">
                            @php
                                $tags = $project->tags;
                                if (is_string($tags)) {
                                    $tags = json_decode($tags, true) ?? [];
                                }
                                $tags = is_array($tags) ? $tags : [];
                            @endphp
                            @foreach(array_slice($tags, 0, 3) as $tag)
                                <span class="px-3 py-1 bg-violet-600/80 text-white text-xs rounded-full">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">{{ $project->getLocalizedTitle() }}</h3>
                        <p class="text-slate-300 text-sm line-clamp-2">{{ $project->getLocalizedDescription() }}</p>
                        <div class="flex gap-4 mt-4 {{ $locale === 'ar' ? 'flex-row-reverse' : '' }}">
                            @if($project->link)
                            <a href="{{ $project->link }}" target="_blank" class="text-white hover:text-violet-400 transition">{{ __('messages.live_demo') }}</a>
                            @endif
                            @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" class="text-white hover:text-violet-400 transition">{{ __('messages.github') }}</a>
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
    <section id="courses" class="py-20 bg-slate-50 dark:bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-4xl font-bold mb-4">{{ $coursesContent['headline'] ?? __('messages.my_resume') }}</h2>
                <p class="text-lg text-slate-600 dark:text-slate-400">{{ $coursesContent['description'] ?? '' }}</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($courses as $course)
                <div class="glass-card rounded-2xl overflow-hidden hover:shadow-xl transition duration-300 scroll-reveal">
                    <div class="relative">
                        <img src="{{ $course->getCourseImageUrl() ?? 'https://via.placeholder.com/400x200/764ba2/ffffff?text=Course' }}" 
                             alt="{{ $course->getLocalizedTitle() }}" 
                             class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4 bg-white/90 dark:bg-slate-900/90 backdrop-blur px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $course->provider }}
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-2">{{ $course->getLocalizedTitle() }}</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm mb-4 line-clamp-2">{{ $course->getLocalizedDescription() }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">{{ $course->completion_date?->format('M Y') }}</span>
                            @if($course->certificate_link)
                            <a href="{{ $course->certificate_link }}" target="_blank" class="text-violet-600 dark:text-violet-400 hover:underline text-sm">
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
    <section id="contact" class="py-20 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-4xl font-bold mb-4">{{ $contactContent['headline'] ?? __('messages.get_in_touch_title') }}</h2>
                <p class="text-lg text-slate-600 dark:text-slate-400">{{ $contactContent['description'] ?? __('messages.get_in_touch_subtitle') }}</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12">
                <div class="scroll-reveal">
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-violet-600 to-purple-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold">{{ __('messages.email') }}</h4>
                                <p class="text-slate-600 dark:text-slate-400">{{ $bio->email }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-violet-600 to-purple-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold">{{ __('messages.phone') }}</h4>
                                <p class="text-slate-600 dark:text-slate-400">{{ $bio->phone }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-violet-600 to-purple-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold">{{ __('messages.location') }}</h4>
                                <p class="text-slate-600 dark:text-slate-400">{{ $bio->location }}</p>
                            </div>
                        </div>
                        
                        <!-- Social Links -->
                        <div class="flex gap-4 pt-6 {{ $locale === 'ar' ? 'flex-row-reverse' : '' }}">
                            @if($bio->social_links)
                                @foreach($bio->social_links as $platform => $url)
                                    @if($url)
                                    <a href="{{ $url }}" target="_blank" class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-800 flex items-center justify-center hover:bg-violet-600 hover:text-white transition">
                                        <span class="text-sm font-bold uppercase">{{ substr($platform, 0, 1) }}</span>
                                    </a>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="scroll-reveal">
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">{{ __('messages.name') }}</label>
                            <input type="text" class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">{{ __('messages.email') }}</label>
                            <input type="email" class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">{{ __('messages.message') }}</label>
                            <textarea rows="4" class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition"></textarea>
                        </div>
                        <button type="submit" class="w-full py-4 bg-gradient-to-r from-violet-600 to-purple-600 text-white rounded-lg font-semibold hover:shadow-lg transition">
                            {{ __('messages.send_message') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-center md:text-left">
                    <span class="text-2xl font-bold gradient-text">{{ $bio->full_name ?? 'Portfolio' }}</span>
                    <p class="text-slate-400 mt-2">{{ $bio->getLocalizedTitle() }}</p>
                </div>
                <div class="text-slate-400 text-sm text-center md:text-right">
                    <p>&copy; {{ date('Y') }} {{ $bio->full_name }}. {{ __('messages.all_rights_reserved') }}</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll Reveal Script -->
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

        document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));
    </script>
</body>
</html>
