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
        'tags' => 'array',
        'gallery' => 'array',
        'is_featured' => 'boolean',
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
     * Get image URL
     */
    public function getImageUrl(): ?string
    {
        if (!$this->image) {
            return null;
        }
        
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        
        return 'https://localhost/personal-portifolio/storage/app/public/' . $this->image;
    }

    /**
     * Get gallery URLs
     */
    public function getGalleryUrls(): array
    {
        if (!$this->gallery || !is_array($this->gallery)) {
            return [];
        }
        
        return array_map(function($path) {
            if (str_starts_with($path, 'http')) {
                return $path;
            }
            return 'https://localhost/personal-portifolio/storage/app/public/' . $path;
        }, $this->gallery);
    }
}
