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
        'title' => 'array',
        'description' => 'array',
        'completion_date' => 'date',
    ];

    /**
     * Get localized title
     */
    public function getLocalizedTitle(?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();
        return $this->title[$locale] ?? $this->title['en'] ?? '';
    }

    /**
     * Get localized description
     */
    public function getLocalizedDescription(?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();
        return $this->description[$locale] ?? $this->description['en'] ?? '';
    }

    /**
     * Get course image URL
     */
    public function getCourseImageUrl(): ?string
    {
        return $this->mediaUrl($this->course_image);
    }

    /**
     * Get certificate image URL
     */
    public function getCertificateImageUrl(): ?string
    {
        return $this->mediaUrl($this->certificate_image);
    }
}
