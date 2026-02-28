<?php

namespace App\Models;

use App\Traits\HasMediaUpload;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasMediaUpload;

    protected $fillable = [
        'title', 'slug', 'description', 'image', 'gallery', 
        'link', 'github_link', 'tags', 'order', 'is_featured', 'video'
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'tags' => 'array',
        'gallery' => 'array',
        'is_featured' => 'boolean',
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
     * Get image URL
     */
    public function getImageUrl(): ?string
    {
        return $this->mediaUrl($this->image);
    }

    /**
     * Get gallery URLs
     */
    public function getGalleryUrls(): array
    {
        if (!$this->gallery) {
            return [];
        }
        return $this->multipleMediaUrls($this->gallery);
    }
}
