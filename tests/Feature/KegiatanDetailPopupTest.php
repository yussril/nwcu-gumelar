<?php

namespace Tests\Feature;

use App\Models\Kegiatan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KegiatanDetailPopupTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_kegiatan_menampilkan_popup_detail(): void
    {
        Kegiatan::factory()->create([
            'title' => 'Kajian Rutin Wali Ranting',
            'location' => 'Masjid Al-Ikhlas',
        ]);

        $this->get(route('kegiatan'))
            ->assertOk()
            ->assertSee('aria-modal="true"', false)
            ->assertSee('openKegiatan', false)
            ->assertSee('data-kegiatan=', false)
            ->assertSee('x-on:click="openKegiatan($el)"', false);
    }

    public function test_popup_memuat_data_kegiatan_yang_diklik(): void
    {
        $kegiatan = Kegiatan::factory()->create([
            'title' => 'Silaturahmi Banom',
            'category' => 'syuriyah-tanfidziyah',
            'location' => 'Balai Desa Gumelar',
        ]);

        $this->get(route('kegiatan'))
            ->assertOk()
            ->assertSee($kegiatan->title)
            ->assertSee('Balai Desa Gumelar', false)
            ->assertSee('Waktu Mulai', false)
            ->assertSee('Waktu Selesai', false)
            ->assertSee('Lokasi', false);
    }
}
