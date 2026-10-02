<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image_path',
        'location',
        'category',
        'scheduled_at',
        'scheduled_end_at',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'scheduled_end_at' => 'datetime',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function coverImageUrl(): ?string
    {
        return $this->cover_image_path
            ? asset('storage/' . $this->cover_image_path)
            : null;
    }

    /**
     * Waktu berakhirnya kegiatan. Jika admin belum mengisi akhir pelaksanaan,
     * jadwal mulai dipakai sebagai batas akhirnya.
     */
    public function endsAt(): Carbon
    {
        return $this->scheduled_end_at ?? $this->scheduled_at;
    }

    public function isDue(): bool
    {
        return $this->endsAt()->isPast();
    }

    /**
     * Kegiatan yang masih tampil di halaman agenda:
     * jadwal akhirnya belum lewat (fallback ke jadwal mulai).
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where(function (Builder $builder) {
            $builder->where('scheduled_end_at', '>', now())
                ->orWhere(function (Builder $nested) {
                    $nested->whereNull('scheduled_end_at')->where('scheduled_at', '>', now());
                });
        });
    }

    /**
     * Kegiatan yang sudah melewati akhir pelaksanaan dan harus dipindah ke galeri.
     */
    public function scopeDue(Builder $query): Builder
    {
        return $query->where(function (Builder $builder) {
            $builder->where('scheduled_end_at', '<=', now())
                ->orWhere(function (Builder $nested) {
                    $nested->whereNull('scheduled_end_at')->where('scheduled_at', '<=', now());
                });
        });
    }
}
