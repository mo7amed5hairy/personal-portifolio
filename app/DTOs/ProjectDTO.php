<?php

namespace App\DTOs;

class ProjectDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $slug,
        public readonly string $description,
        public readonly ?string $image = null,
        public readonly ?string $link = null,
        public readonly ?string $github_link = null,
        public readonly array $tags = [],
        public readonly int $order = 0,
        public readonly bool $is_featured = false,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            title: $data['title'],
            slug: $data['slug'] ?? \Illuminate\Support\Str::slug($data['title']),
            description: $data['description'],
            image: $data['image'] ?? null,
            link: $data['link'] ?? null,
            github_link: $data['github_link'] ?? null,
            tags: $data['tags'] ?? [],
            order: (int) ($data['order'] ?? 0),
            is_featured: (bool) ($data['is_featured'] ?? false),
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'image' => $this->image,
            'link' => $this->link,
            'github_link' => $this->github_link,
            'tags' => $this->tags,
            'order' => $this->order,
            'is_featured' => $this->is_featured,
        ];
    }
}
