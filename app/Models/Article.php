<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'slug', 'category', 'excerpt', 'body', 'image_url', 'image_path',
        'author', 'published_at', 'is_featured', 'is_published', 'sort_order',
        // Social Media Official MWCNU Gumelar
        'social_facebook', 'social_twitter', 'social_instagram', 'social_youtube', 'social_whatsapp', 'social_website',
        // Tags
        'tags',
        // Visibility / Access
        'visibility',
        // Publish mode
        'publish_mode',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
            'tags' => 'array',
        ];
    }

    public function imageSource(): ?string
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : $this->image_url;
    }

    public function getSocialMediaLinks(): array
    {
        return array_filter([
            'facebook' => $this->social_facebook,
            'twitter' => $this->social_twitter,
            'instagram' => $this->social_instagram,
            'youtube' => $this->social_youtube,
            'whatsapp' => $this->social_whatsapp,
            'website' => $this->social_website,
        ]);
    }
}