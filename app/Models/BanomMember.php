<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BanomMember extends Model
{
    protected $fillable = ['position', 'name', 'photo_path', 'sort_order'];

    public function banom(): BelongsTo
    {
        return $this->belongsTo(Banom::class);
    }

    public function photoUrl(): ?string
    {
        return $this->photo_path ? asset('storage/' . $this->photo_path) : null;
    }
}
