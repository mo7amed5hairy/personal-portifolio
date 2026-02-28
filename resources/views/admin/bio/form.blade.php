@extends('layouts.admin')

@section('title', 'الملف الشخصي')

@section('content')
<style>
    .profile-upload-wrapper {
        position: relative;
    }
    
    .upload-zone {
        border: 2px dashed #ddd;
        border-radius: 16px;
        padding: 40px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fafafa;
    }
    
    .upload-zone:hover, .upload-zone.dragover {
        border-color: #6366f1;
        background: #f0f0ff;
    }
    
    .upload-zone i {
        font-size: 48px;
        color: #6366f1;
        margin-bottom: 15px;
    }
    
    .upload-zone p {
        color: #666;
        margin: 0;
    }
    
    .upload-zone .browse-btn {
        display: inline-block;
        margin-top: 10px;
        padding: 8px 20px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border-radius: 20px;
        font-size: 14px;
    }
    
    .preview-container {
        position: relative;
        display: inline-block;
        margin: 15px 0;
        text-align: center;
    }
    
    .preview-container img {
        display: block;
    }
    
    .preview-image {
        width: 180px;
        height: 180px;
        object-fit: cover;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .preview-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .preview-container:hover .preview-overlay {
        opacity: 1;
    }
    
    .preview-overlay button {
        background: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .upload-progress {
        display: none;
        margin-top: 15px;
    }
    
    .progress-bar-wrapper {
        background: #e5e7eb;
        border-radius: 10px;
        height: 8px;
        overflow: hidden;
    }
    
    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
        width: 0%;
        transition: width 0.3s ease;
        border-radius: 10px;
    }
    
    .progress-text {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
        text-align: center;
    }
    
    .form-section {
        background: white;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }
    
    .form-section-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .form-section-title i {
        color: #6366f1;
    }
    
    .cv-upload-zone {
        border: 2px dashed #ddd;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fafafa;
    }
    
    .cv-upload-zone:hover {
        border-color: #10b981;
        background: #f0fdf4;
    }
    
    .cv-upload-zone i {
        font-size: 32px;
        color: #10b981;
        margin-bottom: 10px;
    }
    
    .cv-preview {
        display: flex;
        align-items: center;
        gap: 15px;
        background: #f0fdf4;
        padding: 15px 20px;
        border-radius: 12px;
        margin-top: 15px;
    }
    
    .cv-preview i {
        font-size: 32px;
        color: #10b981;
    }
    
    .cv-info {
        flex: 1;
    }
    
    .cv-info .name {
        font-weight: 600;
        color: #1a1a2e;
    }
    
    .cv-info .size {
        font-size: 12px;
        color: #666;
    }
</style>

<h2 style="margin: 0 0 24px; font-size: 24px; font-weight: bold;">الملف الشخصي</h2>

<form action="{{ route('admin.bio.update') }}" method="POST" enctype="multipart/form-data" id="bio-form">
    @csrf
    @method('PUT')

    <!-- Profile Image Section -->
    <div class="form-section">
        <h3 class="form-section-title">
            <i class="fas fa-user-circle"></i>
            صورة الملف الشخصي
        </h3>
        
        <div class="profile-upload-wrapper" style="display: block; width: 100%;">
            <!-- Current Image Preview -->
            @php
                $profileImageUrl = null;
                if (!empty($bio) && !empty($bio->profile_image)) {
                    $profileImageUrl = 'https://localhost/personal-portifolio/storage/app/public/' . $bio->profile_image;
                }
            @endphp
            
            @if($profileImageUrl)
            <div class="preview-container" id="current_profile_preview" style="display: inline-block;">
                <img src="{{ $profileImageUrl }}" class="preview-image" alt="الصورة الحالية" style="display: block; width: 180px; height: 180px; object-fit: cover; border-radius: 16px;">
                <div class="preview-overlay" style="position: absolute; inset: 0; background: rgba(0,0,0,0.5); border-radius: 16px; display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s;">
                    <button type="button" onclick="document.getElementById('profile_image').click()" style="background: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer;">
                        <i class="fas fa-edit"></i> تغيير الصورة
                    </button>
                </div>
            </div>
            <p style="color: green; margin-top: 10px;"><i class="fas fa-check-circle"></i> الصورة الحالية</p>
            @endif
            
            @if(empty($profileImageUrl))
            <p style="color: #f59e0b;">لا توجد صورة شخصية. يرجى رفع صورة.</p>
            @endif
            
            <!-- Upload Zone (Hidden if showing current image) -->
            <div class="upload-zone" id="upload_zone" onclick="document.getElementById('profile_image').click()" @if(isset($bio) && $bio->getProfileImageUrl()) style="display:none;" @endif>
                <i class="fas fa-cloud-upload-alt"></i>
                <p>اسحب الصورة هنا أو اضغط للتصفح</p>
                <span class="browse-btn">اختر صورة</span>
                <p style="font-size: 12px; margin-top: 10px; color: #999;">JPG, PNG, GIF - 最大 5MB</p>
            </div>
            
            <!-- New Image Preview -->
            <div class="preview-container" id="profile_preview_container" style="display: none;">
                <img src="" class="preview-image" id="profile_preview_img" alt="معاينة الصورة">
                <div class="preview-overlay">
                    <button type="button" onclick="removeProfileImage()">
                        <i class="fas fa-trash"></i> إزالة
                    </button>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="upload-progress" id="profile_progress">
                <div class="progress-bar-wrapper">
                    <div class="progress-bar" id="profile_progress_bar"></div>
                </div>
                <p class="progress-text" id="profile_progress_text">جاري الرفع... 0%</p>
            </div>
            
            <input type="file" id="profile_image" name="profile_image" accept="image/*" style="display: none;" onchange="handleProfileUpload(this)">
        </div>
    </div>

    <!-- Basic Info Section -->
    <div class="form-section">
        <h3 class="form-section-title">
            <i class="fas fa-info-circle"></i>
            المعلومات الأساسية
        </h3>
        
        <div class="grid grid-2">
            <div class="form-group">
                <label class="form-label">الاسم الكامل</label>
                <input type="text" name="full_name" value="{{ old('full_name', $bio->full_name ?? '') }}" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">المسمى الوظيفي</label>
                <input type="text" name="title" value="{{ old('title', $bio->title ?? '') }}" class="form-control" required placeholder="مطور ويب ومصمم">
            </div>
        </div>
        
        <div class="grid grid-2">
            <div class="form-group">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email', $bio->email ?? '') }}" class="form-control" placeholder="email@example.com">
            </div>
            
            <div class="form-group">
                <label class="form-label">رقم الهاتف</label>
                <input type="text" name="phone" value="{{ old('phone', $bio->phone ?? '') }}" class="form-control" placeholder="+20 123 456 7890">
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">الموقع (المدينة)</label>
            <input type="text" name="location" value="{{ old('location', $bio->location ?? '') }}" class="form-control" placeholder="القاهرة، مصر">
        </div>
    </div>

        <!-- About Section -->
    <div class="form-section">
        <h3 class="form-section-title">
            <i class="fas fa-address-card"></i>
            نبذة عني
        </h3>
        
        <div class="form-group">
            <textarea name="about_me" rows="8" class="form-control" placeholder="اكتب نبذة عن نفسك، خبراتك، مهاراتك، وأهدافك المهنية...">{{ old('about_me', $bio->about_me ?? '') }}</textarea>
        </div>
    </div>

    <!-- CV Upload Section -->
    <div class="form-section">
        <h3 class="form-section-title">
            <i class="fas fa-file-pdf"></i>
            السيرة الذاتية (CV)
        </h3>
        
        @if(isset($bio) && $bio->getCvUrl())
        <div class="cv-preview">
            <i class="fas fa-file-pdf"></i>
            <div class="cv-info">
                <div class="name">السيرة الذاتية الحالية</div>
                <div class="size">تم الرفع سابقاً</div>
            </div>
            <a href="{{ $bio->getCvUrl() }}" target="_blank" class="btn btn-primary">
                <i class="fas fa-eye"></i> عرض
            </a>
        </div>
        <p style="font-size: 12px; color: #666; margin-top: 10px;">قم برفع ملف جديد لاستبداله</p>
        @endif
        
        <div class="cv-upload-zone" onclick="document.getElementById('cv_file').click()">
            <i class="fas fa-cloud-upload-alt"></i>
            <p>اسحب ملف السيرة الذاتية هنا</p>
            <span class="browse-btn" style="background: #10b981;">اختر ملف</span>
            <p style="font-size: 12px; margin-top: 10px; color: #999;">PDF, DOC, DOCX - 最大 10MB</p>
        </div>
        
        <input type="file" id="cv_file" name="cv_file" accept=".pdf,.doc,.docx" style="display: none;" onchange="handleCvUpload(this)">
        
        <div class="cv-preview" id="cv_preview" style="display: none;">
            <i class="fas fa-file-alt"></i>
            <div class="cv-info">
                <div class="name" id="cv_file_name">filename.pdf</div>
                <div class="size" id="cv_file_size">0 KB</div>
            </div>
            <button type="button" onclick="removeCvFile()" class="btn" style="background: #ff4757; color: white;">
                <i class="fas fa-trash"></i> إزالة
            </button>
        </div>
    </div>

    <!-- Submit -->
    <div style="display: flex; gap: 12px; padding-top: 10px;">
        <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 16px;">
            <i class="fas fa-save"></i> حفظ التغييرات
        </button>
    </div>
</form>

<script>
    // Profile Image Upload
    function handleProfileUpload(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // Validate file size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('حجم الصورة يجب أن يكون أقل من 5 ميجابايت');
                input.value = '';
                return;
            }
            
            // Validate file type
            const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!validTypes.includes(file.type)) {
                alert('يرجى اختيار صورة بصيغة صالحة (JPG, PNG, GIF, WebP)');
                input.value = '';
                return;
            }
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                // Hide upload zone and current preview
                document.getElementById('upload_zone').style.display = 'none';
                const currentPreview = document.getElementById('current_profile_preview');
                if (currentPreview) {
                    currentPreview.style.display = 'none';
                }
                
                // Show new preview
                const previewContainer = document.getElementById('profile_preview_container');
                const previewImg = document.getElementById('profile_preview_img');
                previewImg.src = e.target.result;
                previewContainer.style.display = 'block';
                
                // Simulate progress
                simulateProgress('profile');
            };
            reader.readAsDataURL(file);
        }
    }
    
    function removeProfileImage() {
        document.getElementById('profile_image').value = '';
        document.getElementById('profile_preview_container').style.display = 'none';
        
        // Show upload zone again
        const currentPreview = document.getElementById('current_profile_preview');
        if (currentPreview) {
            currentPreview.style.display = 'block';
        } else {
            document.getElementById('upload_zone').style.display = 'block';
        }
        
        // Hide progress
        document.getElementById('profile_progress').style.display = 'none';
    }
    
    // CV Upload
    function handleCvUpload(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // Update preview
            document.getElementById('cv_file_name').textContent = file.name;
            document.getElementById('cv_file_size').textContent = formatFileSize(file.size);
            document.getElementById('cv_preview').style.display = 'flex';
        }
    }
    
    function removeCvFile() {
        document.getElementById('cv_file').value = '';
        document.getElementById('cv_preview').style.display = 'none';
    }
    
    // Progress simulation
    function simulateProgress(type) {
        const progress = document.getElementById(type + '_progress');
        const progressBar = document.getElementById(type + '_progress_bar');
        const progressText = document.getElementById(type + '_progress_text');
        
        progress.style.display = 'block';
        
        let width = 0;
        const interval = setInterval(function() {
            if (width >= 100) {
                clearInterval(interval);
                progressText.textContent = 'تم الرفع بنجاح!';
                setTimeout(function() {
                    progress.style.display = 'none';
                }, 1500);
            } else {
                width += Math.random() * 15;
                if (width > 100) width = 100;
                progressBar.style.width = width + '%';
                progressText.textContent = 'جاري الرفع... ' + Math.round(width) + '%';
            }
        }, 200);
    }
    
    // Format file size
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    // Drag and drop
    const uploadZone = document.getElementById('upload_zone');
    if (uploadZone) {
        uploadZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });
        
        uploadZone.addEventListener('dragleave', function() {
            this.classList.remove('dragover');
        });
        
        uploadZone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file) {
                const input = document.getElementById('profile_image');
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
                handleProfileUpload(input);
            }
        });
    }
</script>
@endsection
