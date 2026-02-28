<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ locale_direction() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('messages.admin_dashboard') }} - {{ config('app.name', 'Portfolio') }}</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app-BIcgRnCI.css') }}">
    <script src="{{ asset('build/assets/app-CKl8NZMC.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .font-arabic { font-family: 'Cairo', sans-serif; }
        .font-english { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="antialiased bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 {{ is_rtl() ? 'font-arabic' : 'font-english' }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' || false }" x-init="$watch('darkMode', val => { localStorage.setItem('darkMode', val); document.documentElement.classList.toggle('dark', val); })" x-bind:class="{ 'dark': darkMode }">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen flex">
        <!-- Sidebar -->
        <aside :class="{ '-translate-x-full': !sidebarOpen && !isRTL(), 'translate-x-full': !sidebarOpen && isRTL(), 'translate-x-0': sidebarOpen }" 
               class="fixed inset-y-0 {{ is_rtl() ? 'right-0' : 'left-0' }} z-50 w-64 bg-slate-900 text-white transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-between h-16 px-6 bg-slate-800">
                <span class="text-xl font-bold">Admin Panel</span>
                <button @click="sidebarOpen = false" class="lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800' : '' }}">
                    <svg class="w-5 h-5 {{ is_rtl() ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    {{ __('messages.dashboard') }}
                </a>
                <a href="{{ route('admin.projects.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.projects.*') ? 'bg-slate-800' : '' }}">
                    <svg class="w-5 h-5 {{ is_rtl() ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    {{ __('messages.projects') }}
                </a>
                <a href="{{ route('admin.sections.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.sections.*') ? 'bg-slate-800' : '' }}">
                    <svg class="w-5 h-5 {{ is_rtl() ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                    {{ __('messages.sections') }}
                </a>
                <a href="{{ route('admin.courses.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.courses.*') ? 'bg-slate-800' : '' }}">
                    <svg class="w-5 h-5 {{ is_rtl() ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    {{ __('messages.courses') }}
                </a>
                <a href="{{ route('admin.bio.edit') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.bio.*') ? 'bg-slate-800' : '' }}">
                    <svg class="w-5 h-5 {{ is_rtl() ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    {{ __('messages.bio_profile') }}
                </a>
                <hr class="border-slate-700 my-4">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" target="_blank" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors">
                    <svg class="w-5 h-5 {{ is_rtl() ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    {{ __('messages.view_website') }}
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Top Header -->
            <header class="h-16 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-6 lg:px-8">
                <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-slate-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div class="flex items-center gap-4">
                    <!-- Language Switcher -->
                    <a href="{{ route('home', ['locale' => is_rtl() ? 'en' : 'ar']) }}" 
                       class="px-3 py-1 rounded-full bg-violet-100 dark:bg-violet-900 text-violet-700 dark:text-violet-300 text-sm font-medium hover:bg-violet-200 transition">
                        {{ is_rtl() ? 'English' : 'العربية' }}
                    </a>
                    
                    <!-- Dark Mode Toggle -->
                    <button @click="darkMode = !darkMode" 
                            class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </button>
                    
                    <span class="text-sm text-slate-500">{{ __('messages.welcome_admin') }}</span>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
