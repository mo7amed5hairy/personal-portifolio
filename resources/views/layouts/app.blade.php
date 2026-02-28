<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Portfolio') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .dark .glass {
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100 transition-colors duration-300">
    <div id="app">
        <nav x-data="{ open: false, scrolled: false }" 
             @scroll.window="scrolled = (window.pageYOffset > 20)"
             :class="{ 'glass shadow-lg': scrolled, 'bg-transparent': !scrolled }"
             class="fixed w-full z-50 transition-all duration-300 px-6 py-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-sky-500 bg-clip-text text-transparent">
                    Portfolio
                </a>
                
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#about" class="hover:text-primary-500 transition-colors">About</a>
                    <a href="#projects" class="hover:text-primary-500 transition-colors">Projects</a>
                    <a href="#courses" class="hover:text-primary-500 transition-colors">Courses</a>
                    <a href="#contact" class="px-5 py-2 bg-primary-600 text-white rounded-full hover:bg-primary-700 transition-all shadow-lg hover:shadow-primary-500/30">Hire Me</a>
                </div>

                <button @click="open = !open" class="md:hidden text-slate-500 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path><path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="open" x-cloak class="md:hidden glass absolute top-full left-0 w-full p-6 space-y-4 shadow-xl">
                <a href="#about" @click="open = false" class="block hover:text-primary-500">About</a>
                <a href="#projects" @click="open = false" class="block hover:text-primary-500">Projects</a>
                <a href="#courses" @click="open = false" class="block hover:text-primary-500">Courses</a>
                <a href="#contact" @click="open = false" class="block bg-primary-600 text-white p-3 rounded-lg text-center">Hire Me</a>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <footer class="bg-slate-100 dark:bg-slate-900 py-12 px-6 mt-20">
            <div class="max-w-7xl mx-auto text-center">
                <p class="text-slate-500">&copy; {{ date('Year') }} Portfolio. Built with Laravel & Tailwind CSS.</p>
            </div>
        </footer>
    </div>
</body>
</html>
