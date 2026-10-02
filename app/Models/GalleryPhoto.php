<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_item_id',
        'photo_path',
        'caption',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function galleryItem()
    {
        return $this->belongsTo(GalleryItem::class);
    }

    public function photoUrl(): string
    {
        return asset('storage/' . $this->photo_path);
    }
}
