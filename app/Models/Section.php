<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'order', 'is_active'];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'is_active' => 'boolean',
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
     * Get localized content
     */
    public function getLocalizedContent(?string $locale = null): ?array
    {
        $locale = $locale ?: app()->getLocale();
        $content = $this->content[$locale] ?? $this->content['en'] ?? null;
        return $content ? json_decode($content, true) : null;
    }
}
