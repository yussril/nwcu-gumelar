<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    public const CATEGORIES = [
        'kartanu' => 'Layanan KartaNU',
        'jamiyyah' => "Informasi Jam'iyyah / Banom",
        'lazisnu' => 'UPZIS LAZISNU',
        'lainnya' => 'Lainnya',
    ];

    protected $fillable = [
        'full_name',
        'contact_point',
        'category',
        'message',
        'is_read',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
            'read_at' => 'datetime',
        ];
    }

    public function categoryLabel(): string
    {
        return self::CATEGORIES[$this->category] ?? 'Lainnya';
    }

    public function markAsRead(): void
    {
        if ($this->is_read) {
            return;
        }

        $this->update(['is_read' => true, 'read_at' => now()]);
    }

    public function initials(): string
    {
        $words = preg_split('/\s+/', trim($this->full_name)) ?: [];

        return strtoupper(substr(implode('', array_slice($words, 0, 2)), 0, 2)) ?: '??';
    }
}
