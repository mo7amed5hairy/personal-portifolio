@extends('layouts.admin')

@section('title', isset($course) ? 'تعديل كورس' : 'إضافة كورس')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
        <div>
            <h2 style="margin:0;font-size:24px;font-weight:bold;">{{ isset($course) ? 'تعديل كورس' : 'إضافة كورس جديد' }}</h2>
            <p style="margin:4px 0 0;color:#666;">{{ isset($course) ? 'قم بتحديث بيانات الكورس' : 'أضف كورس أو شهادة جديدة' }}</p>
        </div>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-right"></i> رجوع
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ isset($course) ? route('admin.courses.update', $course) : route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($course))
                    @method('PUT')
                @endif

                <!-- Image -->
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-image"></i> صورة الكورس</label>
                    @if(isset($course) && $course->getCourseImageUrl())
                        <div id="course_preview_container" style="margin-bottom:10px;">
                            <div class="image-preview">
                                <img src="{{ $course->getCourseImageUrl() }}">
                            </div>
                        </div>
                    @else
                        <div id="course_preview_container"></div>
                    @endif
                    
                    <div class="upload-area" onclick="document.getElementById('course_image').click()">
                        <input type="file" id="course_image" name="course_image" accept="image/*" style="display:none;" onchange="previewImage(this, 'course')">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>اضغط للرفع أو اسحب الصورة هنا</p>
                    </div>
                </div>

                <!-- Title -->
                <div class="form-group">
                    <label class="form-label">اسم الكورس</label>
                    <input type="text" name="title" value="{{ old('title', $course->title['ar'] ?? $course->title ?? '') }}" 
                           class="form-control" placeholder="اسم الكورس" required>
                </div>

                <!-- Provider & Date -->
                <div class="grid grid-2">
                    <div class="form-group">
                        <label class="form-label">المنصة / المزود</label>
                        <input type="text" name="provider" value="{{ old('provider', $course->provider ?? '') }}" 
                               class="form-control" placeholder="Udemy, Coursera, etc." required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">تاريخ الإتمام</label>
                        <input type="date" name="completion_date" value="{{ old('completion_date', isset($course) && $course->completion_date ? $course->completion_date->format('Y-m-d') : '') }}" class="form-control">
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label class="form-label">وصف الكورس</label>
                    <textarea name="description" rows="5" class="form-control" placeholder="وصف الكورس...">{{ old('description', $course->description['ar'] ?? $course->description ?? '') }}</textarea>
                </div>

                <!-- Certificate Link -->
                <div class="form-group">
                    <label class="form-label">رابط الشهادة</label>
                    <input type="url" name="certificate_link" value="{{ old('certificate_link', $course->certificate_link ?? '') }}" 
                           class="form-control" placeholder="https://example.com/certificate">
                </div>

                <!-- Submit -->
                <div style="display:flex;gap:12px;padding-top:20px;border-top:1px solid #eee;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        {{ isset($course) ? 'حفظ التغييرات' : 'إضافة الكورس' }}
                    </button>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
@endsection
