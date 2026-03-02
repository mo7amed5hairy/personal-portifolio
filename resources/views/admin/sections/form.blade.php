@extends('layouts.admin')

@section('title', isset($section) ? 'تعديل قسم' : 'إضافة قسم')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
    <div>
        <h2 style="margin:0;font-size:24px;font-weight:bold;">{{ isset($section) ? 'تعديل قسم' : 'إضافة قسم جديد' }}</h2>
        <p style="margin:4px 0 0;color:#666;">{{ isset($section) ? 'قم بتحديث بيانات القسم' : 'أضف قسم جديد' }}</p>
    </div>
    <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-right"></i> رجوع
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ isset($section) ? route('admin.sections.update', $section) : route('admin.sections.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($section))
            @method('PUT')
            @endif

            <!-- Section Image (for Hero, About, etc) -->
            <div class="form-group">
                <label class="form-label"><i class="fas fa-image"></i> صورة القسم (اختياري)</label>
                @if(isset($section) && $section->getImageUrl())
                <div id="section_preview_container" style="margin-bottom:10px;">
                    <div class="image-preview">
                        <img src="{{ $section->getImageUrl() }}">
                    </div>
                </div>
                @else
                <div id="section_preview_container"></div>
                @endif

                <div class="upload-area" onclick="document.getElementById('section_image').click()">
                    <input type="file" id="section_image" name="image" accept="image/*" style="display:none;" onchange="previewImage(this, 'section')">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>اضغط للرفع أو اسحب الصورة هنا (لل Hero - About - Sections)</p>
                </div>
            </div>

            <!-- Title -->
            <div class="form-group">
                <label class="form-label"><i class="fas fa-heading"></i> عنوان القسم</label>
                <input type="text" name="title" value="{{ old('title', $section->title ?? '') }}"
                    class="form-control" placeholder="مثال: مطور ويب متكامل" required>
                <small style="color:#64748b;font-size:12px;margin-top:4px;display:block;">أدخل عنوان القسم بالعربي أو الإنجليزي</small>
            </div>

            <!-- Content (Plain Text) -->
            <div class="form-group">
                <label class="form-label"><i class="fas fa-align-right"></i> المحتوى</label>
                <textarea name="content" rows="8" class="form-control" placeholder="أدخل محتوى القسم كنص عادي بالعربي أو الإنجليزي...">{{ old('content', $section->content ?? '') }}</textarea>
                <small style="color:#64748b;font-size:12px;margin-top:4px;display:block;">
                    <i class="fas fa-info-circle" style="color:#6366f1;"></i>
                    أدخل المحتوى كنص عادي - يقبل العربي والإنجليزي. لا يشترط صيغة معينة.
                </small>
            </div>

            <!-- Order & Active -->
            <div class="grid grid-2">
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-sort-numeric-down"></i> الترتيب</label>
                    <input type="number" name="order" value="{{ old('order', $section->order ?? 0) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label" style="display:flex;align-items:center;gap:10px;margin-top:30px;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $section->is_active ?? true) ? 'checked' : '' }}>
                        <span>القسم نشط</span>
                    </label>
                </div>
            </div>

            <!-- Submit -->
            <div style="display:flex;gap:12px;padding-top:20px;border-top:1px solid #eee;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    {{ isset($section) ? 'حفظ التغييرات' : 'إضافة القسم' }}
                </button>
                <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection