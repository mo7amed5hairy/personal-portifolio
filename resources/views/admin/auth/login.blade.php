<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('messages.admin_login') }} - {{ config('app.name', 'Portfolio') }}</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%236b7280'%3E%3Cpath d='M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5'/%3E%3C/svg%3E">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .font-arabic { font-family: 'Cairo', sans-serif; }
        .font-english { font-family: 'Inter', sans-serif; }
        
        .login-gradient {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 50%, #1e293b 100%);
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
        }
        
        .dark .login-card {
            background: rgba(30, 41, 59, 0.95);
        }
        
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }
        
        .btn-login {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        .shape-1 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.3) 0%, transparent 70%);
            top: -100px;
            left: -100px;
        }
        
        .shape-2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.3) 0%, transparent 70%);
            bottom: -150px;
            right: -150px;
            animation-delay: 2s;
        }
        
        .shape-3 {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.2) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(10deg); }
        }
        
        .pulse-icon {
            animation: pulse-glow 2s ease-in-out infinite;
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.3); }
            50% { box-shadow: 0 0 40px rgba(99, 102, 241, 0.6); }
        }
    </style>
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-arabic"
      x-data="{ 
          darkMode: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),
          loading: false
      }"
      x-init="$watch('darkMode', val => { 
          localStorage.setItem('theme', val ? 'dark' : 'light');
          if (val) document.documentElement.classList.add('dark');
          else document.documentElement.classList.remove('dark');
      });
      if (darkMode) document.documentElement.classList.add('dark');"
      :class="{ 'dark': darkMode }">

    <div class="min-h-screen login-gradient flex items-center justify-center p-4 relative overflow-hidden">
        <!-- Floating Shapes -->
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        
        <div class="w-full max-w-md relative z-10">
            <!-- Logo & Title -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-2xl pulse-icon">
                    <i class="fas fa-user-shield text-white text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">لوحة التحكم</h1>
                <p class="text-gray-400">قم بتسجيل الدخول للمتابعة</p>
            </div>

            <!-- Login Card -->
            <div class="login-card rounded-3xl shadow-2xl p-8">
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 rounded-xl text-sm flex items-center gap-3">
                        <i class="fas fa-exclamation-circle text-xl"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login') }}" class="space-y-6" @submit="loading = true">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">البريد الإلكتروني</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 {{ is_rtl() ? 'right-0 pr-4' : 'left-0 pl-4' }} flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required
                                   class="w-full px-5 py-4 {{ is_rtl() ? 'pr-12' : 'pl-12' }} rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 input-focus focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                   placeholder="admin@example.com">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">كلمة المرور</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 {{ is_rtl() ? 'right-0 pr-4' : 'left-0 pl-4' }} flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" 
                                   name="password" 
                                   required
                                   class="w-full px-5 py-4 {{ is_rtl() ? 'pr-12' : 'pl-12' }} rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 input-focus focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <span>تذكرني</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            :disabled="loading"
                            class="w-full py-4 btn-login text-white rounded-xl font-bold text-lg flex items-center justify-center gap-3 disabled:opacity-70 disabled:cursor-not-allowed">
                        <i x-show="!loading" class="fas fa-sign-in-alt"></i>
                        <svg x-show="loading" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24" x-cloak>
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span x-text="loading ? 'جاري الدخول...' : 'تسجيل الدخول'"></span>
                    </button>
                </form>

                <!-- Back to Website -->
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 text-center">
                    <a href="{{ route('home', ['locale' => 'ar']) }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-indigo-500 transition-colors text-sm">
                        <i class="fas fa-arrow-right"></i>
                        العودة للموقع
                    </a>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} جميع الحقوق محفوظة</p>
            </div>
        </div>

        <!-- Dark Mode Toggle (Bottom Right) -->
        <div class="fixed bottom-6 left-6 z-50">
            <button @click="darkMode = !darkMode" 
                    class="p-3 rounded-full bg-white/10 dark:bg-gray-800/50 backdrop-blur text-white hover:bg-white/20 transition-all shadow-lg"
                    :class="{ 'bg-gray-800/50': darkMode, 'bg-white/20': !darkMode }">
                <i x-show="!darkMode" class="fas fa-moon"></i>
                <i x-show="darkMode" class="fas fa-sun" x-cloak></i>
            </button>
        </div>
    </div>

</body>
</html>
