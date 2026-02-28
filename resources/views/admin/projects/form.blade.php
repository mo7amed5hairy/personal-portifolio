@extends('layouts.admin')

@section('title', isset($project) ? 'تعديل مشروع' : 'إضافة مشروع')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
        <div>
            <h2 style="margin:0;font-size:24px;font-weight:bold;">{{ isset($project) ? 'تعديل مشروع' : 'إضافة مشروع جديد' }}</h2>
            <p style="margin:4px 0 0;color:#666;">{{ isset($project) ? 'قم بتحديث بيانات المشروع' : 'أضف مشروع جديد لمعرض أعمالك' }}</p>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-right"></i> رجوع
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ isset($project) ? route('admin.projects.update', $project) : route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($project))
                    @method('PUT')
                @endif

                <!-- Image Upload -->
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-image"></i> صورة المشروع</label>
                    @if(isset($project) && $project->getImageUrl())
                        <div id="project_preview_container" style="margin-bottom:10px;">
                            <div class="image-preview">
                                <img src="{{ $project->getImageUrl() }}">
                            </div>
                        </div>
                    @else
                        <div id="project_preview_container"></div>
                    @endif
                    
                    <div class="upload-area" onclick="document.getElementById('project_image').click()">
                        <input type="file" id="project_image" name="image" accept="image/*" style="display:none;" onchange="previewImage(this, 'project')">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>اضغط للرفع أو اسحب الصورة هنا</p>
                        <p style="font-size:12px;color:#999;">PNG, JPG - الحد الأقصى 5MB</p>
                    </div>
                </div>

                <!-- Title -->
                <div class="form-group">
                    <label class="form-label">اسم المشروع</label>
                    <input type="text" name="title" value="{{ old('title', $project->title['ar'] ?? $project->title ?? '') }}" 
                           class="form-control" placeholder="اسم المشروع" required>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label class="form-label">وصف المشروع</label>
                    <textarea name="description" rows="5" class="form-control" placeholder="وصف المشروع...">{{ old('description', $project->description['ar'] ?? $project->description ?? '') }}</textarea>
                </div>

                <!-- Links -->
                <div class="grid grid-2">
                    <div class="form-group">
                        <label class="form-label">رابط المشروع</label>
                        <input type="url" name="link" value="{{ old('link', $project->link ?? '') }}" 
                               class="form-control" placeholder="https://example.com">
                    </div>

                    <div class="form-group">
                        <label class="form-label">رابط GitHub</label>
                        <input type="url" name="github_link" value="{{ old('github_link', $project->github_link ?? '') }}" 
                               class="form-control" placeholder="https://github.com/...">
                    </div>
                </div>

                <!-- Tags -->
                <div class="form-group">
                    <label class="form-label">التقنيات (مفصولة بفواصل)</label>
                    <input type="text" name="tags" value="{{ old('tags', isset($project) ? implode(', ', is_array($project->tags) ? $project->tags : json_decode($project->tags, true) ?? []) : '') }}" 
                           class="form-control" placeholder="Laravel, PHP, Vue.js">
                </div>

                <!-- Order & Featured -->
                <div class="grid grid-2">
                    <div class="form-group">
                        <label class="form-label">الترتيب</label>
                        <input type="number" name="order" value="{{ old('order', $project->order ?? 0) }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label" style="display:flex;align-items:center;gap:10px;margin-top:30px;">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}>
                            <span>مشروع مميز</span>
                        </label>
                    </div>
                </div>

                <!-- Submit -->
                <div style="display:flex;gap:12px;padding-top:20px;border-top:1px solid #eee;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        {{ isset($project) ? 'حفظ التغييرات' : 'إضافة المشروع' }}
                    </button>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
@endsection
