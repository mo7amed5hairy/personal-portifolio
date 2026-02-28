<?php

namespace App\Models;

use App\Traits\HasMediaUpload;
use Illuminate\Database\Eloquent\Model;

class Bio extends Model
{
    use HasMediaUpload;

    protected $fillable = [
        'full_name', 'title', 'about_me', 'email', 'phone', 'location', 
        'cv_path', 'social_links', 'profile_image', 'hero_video', 'skills'
    ];

    protected $casts = [
        'title' => 'array',
        'about_me' => 'array',
        'social_links' => 'array',
        'skills' => 'array',
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
     * Get localized about me
     */
    public function getLocalizedAbout(?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();
        return $this->about_me[$locale] ?? $this->about_me['en'] ?? '';
    }

    /**
     * Get profile image URL
     */
    public function getProfileImageUrl(): ?string
    {
        return $this->mediaUrl($this->profile_image);
    }

    /**
     * Get hero video URL
     */
    public function getHeroVideoUrl(): ?string
    {
        return $this->mediaUrl($this->hero_video);
    }

    /**
     * Get CV URL
     */
    public function getCvUrl(): ?string
    {
        return $this->mediaUrl($this->cv_path);
    }
}
