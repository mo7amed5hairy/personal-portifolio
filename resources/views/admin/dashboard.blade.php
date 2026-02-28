@extends('layouts.admin')

@section('title', 'لوحة التحكم')

@section('content')
    <h2 style="margin:0 0 24px;font-size:24px;font-weight:bold;">لوحة التحكم</h2>

    <!-- Stats -->
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;margin-bottom:30px;">
        <div class="stat-card">
            <div class="icon" style="background:#e0f2fe;"><i class="fas fa-folder-open" style="color:#0284c7;"></i></div>
            <div class="value">{{ $projectsCount ?? 0 }}</div>
            <div class="label">المشاريع</div>
        </div>

        <div class="stat-card">
            <div class="icon" style="background:#d1fae5;"><i class="fas fa-check-circle" style="color:#059669;"></i></div>
            <div class="value">{{ $sectionsCount ?? 0 }}</div>
            <div class="label">الأقسام النشطة</div>
        </div>

        <div class="stat-card">
            <div class="icon" style="background:#ede9fe;"><i class="fas fa-graduation-cap" style="color:#7c3aed;"></i></div>
            <div class="value">{{ $coursesCount ?? 0 }}</div>
            <div class="label">الكورسات</div>
        </div>

        <div class="stat-card">
            <div class="icon" style="background:#fef3c7;"><i class="fas fa-star" style="color:#d97706;"></i></div>
            <div class="value">{{ $featuredCount ?? 0 }}</div>
            <div class="label">المشاريع المميزة</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <div class="card-header">
            <h3 style="margin:0;font-size:16px;font-weight:600;">إجراءات سريعة</h3>
        </div>
        <div class="card-body">
            <div style="display:flex;flex-wrap:wrap;gap:12px;">
                <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> إضافة مشروع
                </a>
                <a href="{{ route('admin.courses.create') }}" class="btn btn-secondary">
                    <i class="fas fa-plus"></i> إضافة كورس
                </a>
                <a href="{{ route('admin.sections.create') }}" class="btn btn-secondary">
                    <i class="fas fa-plus"></i> إضافة قسم
                </a>
                <a href="{{ route('admin.bio.edit') }}" class="btn btn-secondary">
                    <i class="fas fa-user-edit"></i> الملف الشخصي
                </a>
            </div>
        </div>
    </div>
    
    <!-- Preview Site -->
    <div class="card" style="margin-top:24px;">
        <div class="card-body">
            <a href="{{ route('home', ['locale' => 'ar']) }}" target="_blank" style="display:flex;align-items:center;justify-content:center;gap:15px;padding:20px;background:#f9fafb;border-radius:8px;text-decoration:none;color:inherit;">
                <i class="fas fa-external-link-alt" style="font-size:24px;color:#00d9ff;"></i>
                <div style="text-align:right;">
                    <p style="margin:0;font-weight:600;">معاينة الموقع</p>
                    <p style="margin:0;font-size:13px;color:#666;">اضغط لفتح الموقع في نافذة جديدة</p>
                </div>
                <i class="fas fa-chevron-left" style="margin-right:auto;color:#999;"></i>
            </a>
        </div>
    </div>
@endsection
