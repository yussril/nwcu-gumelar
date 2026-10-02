<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = [
        'kegiatan_id', 'title', 'slug', 'category', 'label', 'alt_text', 'description',
        'image_url', 'image_path', 'event_date', 'location', 'is_published', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function imageSource(): ?string
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : $this->image_url;
    }

    public function photos()
    {
        return $this->hasMany(GalleryPhoto::class)->orderBy('sort_order')->orderBy('id');
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}