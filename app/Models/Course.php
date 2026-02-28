<?php

namespace App\Models;

use App\Traits\HasMediaUpload;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasMediaUpload;

    protected $fillable = [
        'title', 'provider', 'description', 'completion_date', 
        'certificate_link', 'certificate_image', 'course_image', 'order'
    ];

    protected $casts = [
        'completion_date' => 'date',
    ];

    /**
     * Get localized title (Arabic only now)
     */
    public function getLocalizedTitle(?string $locale = null): string
    {
        return $this->title ?? '';
    }

    /**
     * Get localized description (Arabic only now)
     */
    public function getLocalizedDescription(?string $locale = null): string
    {
        return $this->description ?? '';
    }

    /**
     * Get course image URL
     */
    public function getCourseImageUrl(): ?string
    {
        if (!$this->course_image) {
            return null;
        }
        
        if (str_starts_with($this->course_image, 'http')) {
            return $this->course_image;
        }
        
        return 'https://localhost/personal-portifolio/storage/app/public/' . $this->course_image;
    }

    /**
     * Get certificate image URL
     */
    public function getCertificateImageUrl(): ?string
    {
        if (!$this->certificate_image) {
            return null;
        }
        
        if (str_starts_with($this->certificate_image, 'http')) {
            return $this->certificate_image;
        }
        
        return 'https://localhost/personal-portifolio/storage/app/public/' . $this->certificate_image;
    }
}
