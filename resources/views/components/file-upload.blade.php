<div x-data="{
    previewUrl: '{{ $currentImage ?? '' }}',
    isUploading: false,
    progress: 0,
    
    handleFiles(files) {
        if (!files.length) return;
        const file = files[0];
        
        if (!file.type.startsWith('image/') && !file.type.startsWith('video/')) {
            alert('الرجاء اختيار صورة أو فيديو');
            return;
        }
        
        this.isUploading = true;
        this.progress = 0;
        
        // Create preview
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.previewUrl = e.target.result;
                this.$refs.previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else if (file.type.startsWith('video/')) {
            this.previewUrl = URL.createObjectURL(file);
            this.$refs.previewContainer.classList.remove('hidden');
        }
        
        // Simulate progress
        const interval = setInterval(() => {
            this.progress += 10;
            if (this.progress >= 100) {
                clearInterval(interval);
                this.isUploading = false;
            }
        }, 100);
        
        // Set file to input
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        $refs.fileInput.files = dataTransfer.files;
    },
    
    removeImage() {
        this.previewUrl = null;
        this.$refs.fileInput.value = '';
        this.$refs.previewContainer.classList.add('hidden');
    }
}" class="space-y-3">
    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
        {{ $label }}
        @if($required)<span class="text-red-500">*</span>@endif
    </label>
    
    <!-- Upload Area -->
    <div 
        x-ref="uploadArea"
        class="upload-area rounded-xl p-6 text-center cursor-pointer"
        @click="$refs.fileInput.click()"
        @dragover.prevent="uploadArea.classList.add('dragover')"
        @dragleave.prevent="uploadArea.classList.remove('dragover')"
        @drop.prevent="uploadArea.classList.remove('dragover'); handleFiles($event.dataTransfer.files)"
    >
        <input 
            type="file" 
            x-ref="fileInput"
            name="{{ $name }}"
            accept="{{ $accept }}"
            class="hidden"
            @change="handleFiles($event.target.files)"
        >
        
        <!-- Preview Container -->
        <div x-ref="previewContainer" class="{{ $currentImage ? '' : 'hidden' }} relative mb-4">
            <div class="image-upload-container inline-block">
                <template x-if="previewUrl && previewUrl.startsWith('data:video') || '{{ $currentImage }}' && '{{ $currentImage }}'.endsWith('.mp4')">
                    <video :src="previewUrl" class="w-48 h-32 rounded-lg object-cover"></video>
                </template>
                <template x-if="previewUrl && !previewUrl.startsWith('data:video') && !'{{ $currentImage }}'.endsWith('.mp4')">
                    <img :src="previewUrl" class="w-48 h-32 rounded-lg preview-image">
                </template>
                <div @click="removeImage()" class="remove-image">
                    <i class="fas fa-times text-xs"></i>
                </div>
            </div>
        </div>
        
        <!-- Upload Content -->
        <div x-show="!previewUrl && !'{{ $currentImage }}'">
            <div class="mb-3">
                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
            </div>
            <p class="text-gray-600 dark:text-gray-400 mb-1">
                <span class="text-indigo-600 font-semibold">اضغط للرفع</span> أو اسحب الملف هنا
            </p>
            <p class="text-xs text-gray-500">{{ $hint }}</p>
        </div>
        
        <!-- Progress Bar -->
        <div x-show="isUploading" class="mt-4">
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                <div class="bg-indigo-600 h-2 rounded-full transition-all" :style="'width: ' + progress + '%'"></div>
            </div>
            <p class="text-sm text-gray-500 mt-1">جاري الرفع... <span x-text="progress + '%'"></span></p>
        </div>
    </div>
</div>
