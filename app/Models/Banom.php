<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Banom extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
        'title',
        'motto',
        'description',
        'term',
        'member_count',
        'coverage',
        'legal_status',
        'note',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function members(): HasMany
    {
        return $this->hasMany(BanomMember::class)->orderBy('sort_order')->orderBy('id');
    }
}