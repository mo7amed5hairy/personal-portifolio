<?php

namespace App\Models;

use App\Traits\HasMediaUpload;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasMediaUpload;

    protected $fillable = ['title', 'content', 'order', 'is_active', 'image'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * الحصول على العنوان
     */
    public function getLocalizedTitle(?string $locale = null): string
    {
        return $this->title ?? '';
    }

    /**
     * الحصول على المحتوى كنص عادي
     */
    public function getLocalizedContent(?string $locale = null): ?string
    {
        return $this->content ?? null;
    }

    /**
     * الحصول على رابط صورة القسم
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
