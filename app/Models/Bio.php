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
        'social_links' => 'array',
        'skills' => 'array',
    ];

    /**
     * Get title (Arabic only now)
     */
    public function getLocalizedTitle(?string $locale = null): string
    {
        return $this->title ?? '';
    }

    /**
     * Get about me (Arabic only now)
     */
    public function getLocalizedAbout(?string $locale = null): string
    {
        return $this->about_me ?? '';
    }

    /**
     * Get profile image URL
     */
    public function getProfileImageUrl(): ?string
    {
        if (!$this->profile_image) {
            return null;
        }
        
        if (str_starts_with($this->profile_image, 'http')) {
            return $this->profile_image;
        }
        
        return 'https://localhost/personal-portifolio/storage/app/public/' . $this->profile_image;
    }

    /**
     * Get hero video URL
     */
    public function getHeroVideoUrl(): ?string
    {
        if (!$this->hero_video) {
            return null;
        }
        
        if (str_starts_with($this->hero_video, 'http')) {
            return $this->hero_video;
        }
        
        return 'https://localhost/personal-portifolio/storage/app/public/' . $this->hero_video;
    }

    /**
     * Get CV URL
     */
    public function getCvUrl(): ?string
    {
        if (!$this->cv_path) {
            return null;
        }
        
        if (str_starts_with($this->cv_path, 'http')) {
            return $this->cv_path;
        }
        
        return 'https://localhost/personal-portifolio/storage/app/public/' . $this->cv_path;
    }
}
