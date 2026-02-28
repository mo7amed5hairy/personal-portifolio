<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ locale_direction() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - {{ config('app.name', 'Portfolio') }}</title>
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
<body class="antialiased bg-slate-100 dark:bg-slate-950 text-slate-900 dark:text-slate-100 {{ is_rtl() ? 'font-arabic' : 'font-english' }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' || false }" x-init="$watch('darkMode', val => { localStorage.setItem('darkMode', val); document.documentElement.classList.toggle('dark', val); })" x-bind:class="{ 'dark': darkMode }">

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-r from-violet-600 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold">Admin Panel</h1>
                <p class="text-slate-500 mt-2">{{ __('messages.login_prompt', [], 'ar') ?? 'تسجيل الدخول للوحة التحكم' }}</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl p-8">
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-lg text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium mb-2">{{ __('messages.email', [], 'ar') ?? 'البريد الإلكتروني' }}</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition"
                               placeholder="admin@example.com">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">{{ __('messages.password', [], 'ar') ?? 'كلمة المرور' }}</label>
                        <input type="password" name="password" required
                               class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-violet-500 focus:border-transparent transition"
                               placeholder="••••••••">
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-violet-600 focus:ring-violet-500">
                            <span>{{ __('messages.remember_me', [], 'ar') ?? 'تذكرني' }}</span>
                        </label>
                    </div>

                    <button type="submit" 
                            class="w-full py-3 bg-gradient-to-r from-violet-600 to-purple-600 text-white rounded-lg font-semibold hover:shadow-lg transition">
                        {{ __('messages.login', [], 'ar') ?? 'تسجيل الدخول' }}
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('home', ['locale' => 'ar']) }}" class="text-sm text-slate-500 hover:text-violet-600 transition">
                        &larr; {{ __('messages.back_to_website', [], 'ar') ?? 'العودة للموقع' }}
                    </a>
                </div>
            </div>

            <!-- Dark Mode Toggle -->
            <div class="text-center mt-6">
                <button @click="darkMode = !darkMode" 
                        class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-800 transition inline-flex items-center gap-2">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span x-text="darkMode ? '{{ __("messages.light_mode", [], "ar") ?? "الوضع الفاتح" }}' : '{{ __("messages.dark_mode", [], "ar") ?? "الوضع المظلم" }}'"></span>
                </button>
            </div>
        </div>
    </div>

</body>
</html>
