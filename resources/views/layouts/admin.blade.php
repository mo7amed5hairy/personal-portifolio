<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>لوحة التحكم - {{ config('app.name', 'Portfolio') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #ec4899;
            --dark: #0f172a;
            --light: #f8fafc;
        }
        
        body { 
            font-family: 'Cairo', sans-serif; 
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            min-height: 100vh;
        }
        
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar - Matching Portfolio Theme */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0,0,0,0.3);
        }
        
        .sidebar-header { 
            padding: 30px 25px; 
            border-bottom: 1px solid rgba(255,255,255,0.1);
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(139, 92, 246, 0.1) 100%);
        }
        
        .sidebar-header h2 { 
            font-size: 22px; 
            display: flex; 
            align-items: center; 
            gap: 12px;
            font-weight: 700;
        }
        
        .sidebar-header h2 i { 
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 28px;
        }
        
        .sidebar-brand {
            font-size: 14px;
            color: #94a3b8;
            margin-top: 8px;
            padding-right: 40px;
        }
        
        .sidebar-menu { padding: 20px 0; }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 14px 25px;
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.3s ease;
            gap: 14px;
            font-size: 15px;
            border-right: 3px solid transparent;
        }
        
        .menu-item:hover, .menu-item.active {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.2) 0%, transparent 100%);
            color: #a5b4fc;
            border-right-color: #6366f1;
        }
        
        .menu-item.active {
            color: #6366f1;
            font-weight: 600;
        }
        
        .menu-item i { 
            width: 24px; 
            text-align: center;
            font-size: 18px;
        }
        
        .menu-item:hover i, .menu-item.active i {
            color: #6366f1;
        }
        
        .menu-divider { 
            height: 1px; 
            background: rgba(255,255,255,0.1); 
            margin: 15px 25px; 
        }
        
        .menu-item.logout {
            color: #f87171;
        }
        
        .menu-item.logout:hover {
            background: rgba(248, 113, 113, 0.1);
            border-right-color: #ef4444;
        }
        
        .menu-item.logout i {
            color: #ef4444;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-right: 280px;
            min-height: 100vh;
        }
        
        /* Header */
        .header {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(20px);
            padding: 20px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .header-title { 
            font-size: 20px; 
            font-weight: 600; 
            color: white;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .header-title i {
            color: #6366f1;
        }
        
        .header-actions { 
            display: flex; 
            align-items: center; 
            gap: 20px; 
        }
        
        /* Dark Mode Toggle */
        .theme-toggle {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(255,255,255,0.1);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 18px;
            transition: all 0.3s;
        }
        
        .theme-toggle:hover {
            background: rgba(99, 102, 241, 0.2);
            color: #6366f1;
        }
        
        .user-info { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            padding: 8px 16px;
            background: rgba(255,255,255,0.05);
            border-radius: 12px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }
        
        .user-name {
            color: white;
            font-weight: 500;
        }
        
        /* Content Area */
        .content { 
            padding: 35px; 
            background: #f8fafc;
            min-height: calc(100vh - 80px);
        }
        
        /* Cards */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 24px;
            overflow: hidden;
        }
        
        .card-header { 
            padding: 20px 25px; 
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .card-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-header h3 i {
            color: #6366f1;
        }
        
        .card-body { 
            padding: 25px; 
        }
        
        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-family: 'Cairo', sans-serif;
        }
        
        .btn-primary { 
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); 
            color: white; 
        }
        
        .btn-primary:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4); 
        }
        
        .btn-secondary { 
            background: #f1f5f9; 
            color: #475569; 
        }
        
        .btn-secondary:hover { 
            background: #e2e8f0; 
        }
        
        .btn-danger { 
            background: #ef4444; 
            color: white; 
        }
        
        .btn-danger:hover { 
            background: #dc2626; 
            transform: translateY(-2px);
        }
        
        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }
        
        /* Forms */
        .form-group { margin-bottom: 24px; }
        
        .form-label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: 600; 
            color: #334155;
            font-size: 14px;
        }
        
        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s;
            font-family: 'Cairo', sans-serif;
        }
        
        .form-control:focus { 
            outline: none; 
            border-color: #6366f1; 
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); 
        }
        
        /* Grid */
        .grid { display: grid; gap: 24px; }
        .grid-2 { grid-template-columns: repeat(2, 1fr); }
        .grid-3 { grid-template-columns: repeat(3, 1fr); }
        .grid-4 { grid-template-columns: repeat(4, 1fr); }
        
        @media (max-width: 1024px) {
            .grid-4 { grid-template-columns: repeat(2, 1fr); }
        }
        
        @media (max-width: 768px) {
            .grid-2, .grid-3, .grid-4 { grid-template-columns: 1fr; }
            .sidebar { transform: translateX(100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-right: 0; }
            .content { padding: 20px; }
        }
        
        /* Alerts */
        .alert { 
            padding: 16px 20px; 
            border-radius: 12px; 
            margin-bottom: 20px; 
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .alert-success { 
            background: #d1fae5; 
            color: #065f46; 
            border: 1px solid #a7f3d0; 
        }
        
        .alert-success i {
            color: #10b981;
            font-size: 20px;
        }
        
        .alert-danger { 
            background: #fee2e2; 
            color: #991b1b; 
            border: 1px solid #fecaca; 
        }
        
        .alert-danger i {
            color: #ef4444;
            font-size: 20px;
        }
        
        /* Table */
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { 
            padding: 16px; 
            text-align: right; 
            border-bottom: 1px solid #f1f5f9; 
        }
        .table th { 
            background: #f8fafc; 
            font-weight: 600; 
            color: #475569; 
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .table tr:hover {
            background: #f8fafc;
        }
        
        /* Upload Area */
        .upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #f8fafc;
        }
        
        .upload-area:hover { 
            border-color: #6366f1; 
            background: #f0f0ff; 
        }
        
        .upload-area i { 
            font-size: 48px; 
            color: #6366f1; 
            margin-bottom: 15px; 
        }
        
        .upload-area p {
            color: #64748b;
            margin: 0;
        }
        
        /* Image Preview */
        .image-preview { 
            position: relative; 
            display: inline-block; 
            margin: 10px; 
        }
        
        .image-preview img { 
            width: 180px; 
            height: 120px; 
            object-fit: cover; 
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .image-preview .remove {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ef4444;
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }
        
        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .stat-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        .stat-card .icon.primary {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(139, 92, 246, 0.2) 100%);
            color: #6366f1;
        }
        
        .stat-card .icon.success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);
            color: #10b981;
        }
        
        .stat-card .icon.warning {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(217, 119, 6, 0.2) 100%);
            color: #f59e0b;
        }
        
        .stat-card .icon.info {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.2) 100%);
            color: #3b82f6;
        }
        
        .stat-card .value { 
            font-size: 32px; 
            font-weight: bold; 
            color: #1e293b; 
        }
        
        .stat-card .label { 
            color: #64748b; 
            font-size: 14px; 
        }
        
        /* Toggle Button */
        .toggle-btn {
            display: none;
            padding: 12px;
            background: rgba(255,255,255,0.1);
            border: none;
            cursor: pointer;
            font-size: 20px;
            color: white;
            border-radius: 10px;
        }
        
        @media (max-width: 768px) {
            .toggle-btn { display: block; }
        }
        
        /* Note editor */
        .note-editor { border-radius: 12px; }
        
        /* Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }
        
        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }
        
        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }
        
        /* Dark mode styles */
        body.dark .content {
            background: #1e293b;
        }
        
        body.dark .card {
            background: #334155;
        }
        
        body.dark .card-header {
            border-bottom-color: #475569;
        }
        
        body.dark .card-header h3 {
            color: #f1f5f9;
        }
        
        body.dark .table th {
            background: #334155;
            color: #94a3b8;
        }
        
        body.dark .table td {
            color: #e2e8f0;
            border-bottom-color: #475569;
        }
        
        body.dark .table tr:hover {
            background: #334155;
        }
        
        body.dark .form-control {
            background: #334155;
            border-color: #475569;
            color: #e2e8f0;
        }
        
        body.dark .form-label {
            color: #e2e8f0;
        }
        
        body.dark .upload-area {
            background: #334155;
            border-color: #475569;
        }
        
        body.dark .upload-area p {
            color: #94a3b8;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ar-AR.min.js"></script>
    <script>
        // Dark mode toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle');
            const body = document.body;
            
            // Check saved theme
            if (localStorage.getItem('adminTheme') === 'dark' || 
                (!localStorage.getItem('adminTheme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                body.classList.add('dark');
            }
            
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    body.classList.toggle('dark');
                    localStorage.setItem('adminTheme', body.classList.contains('dark') ? 'dark' : 'light');
                });
            }
        });
    </script>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-cube"></i> لوحة التحكم</h2>
                <div class="sidebar-brand">مدير الموقع الشخصي</div>
            </div>
            <nav class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> الرئيسية
                </a>
                <a href="{{ route('admin.projects.index') }}" class="menu-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <i class="fas fa-folder-open"></i> المشاريع
                </a>
                <a href="{{ route('admin.courses.index') }}" class="menu-item {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
                    <i class="fas fa-graduation-cap"></i> الكورسات
                </a>
                <a href="{{ route('admin.sections.index') }}" class="menu-item {{ request()->routeIs('admin.sections.*') ? 'active' : '' }}">
                    <i class="fas fa-layer-group"></i> الأقسام
                </a>
                <a href="{{ route('admin.bio.edit') }}" class="menu-item {{ request()->routeIs('admin.bio.*') ? 'active' : '' }}">
                    <i class="fas fa-user-circle"></i> الملف الشخصي
                </a>
                <a href="{{ route('admin.contact-messages.index') }}" class="menu-item {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> رسائل التواصل
                </a>
                
                <div class="menu-divider"></div>
                
                <a href="{{ route('home', ['locale' => 'ar']) }}" target="_blank" class="menu-item">
                    <i class="fas fa-external-link-alt"></i> معاينة الموقع
                </a>
                
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="menu-item logout" style="width:100%;background:none;border:none;cursor:pointer;text-align:right;">
                        <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header class="header">
                <div style="display:flex;align-items:center;gap:15px;">
                    <button class="toggle-btn" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="header-title">
                        <i class="fas fa-@yield('header-icon', 'dashboard')"></i>
                        @yield('title', 'لوحة التحكم')
                    </h1>
                </div>
                
                <div class="header-actions">
                    <button class="theme-toggle" id="themeToggle" title="تبديل السمة">
                        <i class="fas fa-moon"></i>
                    </button>
                    
                    <div class="user-info">
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="user-name">مدير الموقع</span>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="content">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            <strong>حدث خطأ:</strong>
                            <ul style="margin:10px 0 0 20px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
        }
        
        $(document).ready(function() {
            $('.summernote').summernote({
                lang: 'ar-AR',
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
        
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var container = document.getElementById(previewId + '_container');
                    if (!container) {
                        container = document.createElement('div');
                        container.id = previewId + '_container';
                        container.className = 'image-preview';
                        input.parentNode.appendChild(container);
                    }
                    var html = '<img src="' + e.target.result + '"><span class="remove" onclick="removeImage(\'' + input.id + '\', \'' + previewId + '\')"><i class="fas fa-times"></i></span>';
                    container.innerHTML = html;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function removeImage(inputId, previewId) {
            document.getElementById(inputId).value = '';
            var container = document.getElementById(previewId + '_container');
            if (container) {
                container.innerHTML = '';
            }
        }
    </script>
</body>
</html>
