<?php

namespace App\Models;

use App\Traits\HasMediaUpload;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasMediaUpload;
    
    protected $fillable = ['title', 'slug', 'content', 'order', 'is_active', 'image'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get localized title (Arabic only now)
     */
    public function getLocalizedTitle(?string $locale = null): string
    {
        return $this->title ?? '';
    }

    /**
     * Get localized content (Arabic only now)
     */
    public function getLocalizedContent(?string $locale = null): ?string
    {
        return $this->content ?? null;
    }

    /**
     * Get section image URL
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
}
