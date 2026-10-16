<?php

namespace App\Services;

use App\Models\GalleryItem;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Memindahkan kegiatan yang sudah melewati "akhir pelaksanaan" ke halaman galeri.
 *
 * Dipanggil dari 2 tempat:
 *  - route /kegiatan dan /galeri (otomatis saat halaman dibuka, tanpa cron)
 *  - command `php artisan app:move-kegiatan-to-galeri`
 */
class KegiatanMover
{
    /**
     * Nama tampilan untuk kategori kegiatan (dipakai sebagai label badge galeri).
     */
    private const CATEGORY_LABELS = [
        'syuriyah-tanfidziyah' => 'Syuriyah & Tanfidziyah',
        'ansor' => 'Ansor & Banser',
        'fatayat' => 'Fatayat & Muslimat',
        'ipnu-ippnu' => 'IPNU & IPPNU',
        'lazisnu' => 'LAZISNU & Filantropi',
        'dakwah' => 'LBM & Dakwah',
        'ranting' => 'Ranting & Desa',
    ];

    /**
     * Pindahkan semua kegiatan yang waktunya sudah lewat ke galeri.
     *
     * @return array<int, Kegiatan> kegiatan yang berhasil dipindahkan
     */
    public static function moveDue(): array
    {
        // lockForUpdate mencegah dua request bersamaan memindahkan kegiatan yang sama.
        return DB::transaction(function () {
            $due = Kegiatan::query()->due()->lockForUpdate()->orderBy('scheduled_at')->orderBy('id')->get();

            return $due->map(fn (Kegiatan $kegiatan) => static::move($kegiatan))->filter()->values()->all();
        });
    }

    private static function move(Kegiatan $kegiatan): Kegiatan
    {
        GalleryItem::create([
            'kegiatan_id' => $kegiatan->id,
            'title' => $kegiatan->title,
            'slug' => static::uniqueSlug($kegiatan->title),
            'category' => $kegiatan->category ?? 'ranting',
            'label' => self::CATEGORY_LABELS[$kegiatan->category] ?? 'Dokumentasi Kegiatan',
            'alt_text' => $kegiatan->title,
            'description' => $kegiatan->description,
            'image_path' => $kegiatan->cover_image_path,
            'event_date' => $kegiatan->endsAt()->toDateString(),
            'location' => $kegiatan->location,
            // Status publikasi ikut dibawa agar kegiatan yang masih draft tidak
            // bocor tayang di galeri publik begitu waktunya habis.
            'is_published' => $kegiatan->is_published,
            'sort_order' => 0,
        ]);

        $kegiatan->delete();

        return $kegiatan;
    }

    private static function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'kegiatan';
        $slug = $base;
        $suffix = 2;

        while (GalleryItem::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }
}
