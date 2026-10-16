<?php

namespace Tests\Feature;

use App\Models\GalleryItem;
use App\Models\Kegiatan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KegiatanAutoMoveTest extends TestCase
{
    use RefreshDatabase;

    public function test_kegiatan_yang_sudah_lewat_waktu_akhir_dipindah_ke_galeri(): void
    {
        $kegiatan = Kegiatan::factory()->due()->create([
            'title' => 'Kajian Rutin Wali Ranting',
            'category' => 'dakwah',
            'location' => 'Masjid Al-Ikhlas',
        ]);

        $this->get(route('kegiatan'))->assertOk();

        $this->assertDatabaseMissing('kegiatans', ['id' => $kegiatan->id]);

        $galeri = GalleryItem::sole();
        $this->assertSame($kegiatan->title, $galeri->title);
        $this->assertSame('dakwah', $galeri->category);
        $this->assertSame('LBM & Dakwah', $galeri->label);
        $this->assertSame('Masjid Al-Ikhlas', $galeri->location);
        $this->assertTrue($galeri->is_published);
        $this->assertSame($kegiatan->endsAt()->toDateString(), $galeri->event_date->toDateString());
    }

    public function test_kegiatan_tanpa_akhir_pelaksanaan_memakai_jadwal_mulai(): void
    {
        $kegiatan = Kegiatan::factory()->withoutEndTime()->create();

        $this->get(route('kegiatan'))->assertOk();

        $this->assertDatabaseMissing('kegiatans', ['id' => $kegiatan->id]);
        $this->assertTrue(GalleryItem::sole()->is_published);
    }

    public function test_kegiatan_yang_baru_jalan_tetap_di_halaman_kegiatan(): void
    {
        $kegiatan = Kegiatan::factory()->create([
            'scheduled_at' => now()->addHour(),
            'scheduled_end_at' => now()->addHours(3),
        ]);

        $this->get(route('kegiatan'))->assertOk()->assertSee($kegiatan->title);

        $this->assertDatabaseHas('kegiatans', ['id' => $kegiatan->id]);
        $this->assertSame(0, GalleryItem::count());
    }

    public function test_kegiatan_draft_tidak_bocor_ke_galeri_publik(): void
    {
        Kegiatan::factory()->due()->draft()->create(['title' => 'Rencana Internal']);

        $this->get(route('kegiatan'))->assertOk();

        $galeri = GalleryItem::sole();
        $this->assertFalse($galeri->is_published);

        $this->get(route('galeri'))->assertOk()->assertDontSee('Rencana Internal');
    }

    public function test_kegiatan_yang_sudah_berakhir_tidak_muncul_di_galeri_langsung(): void
    {
        Kegiatan::factory()->due()->create(['title' => 'Kegiatan Selesai Kemarin']);

        $this->get(route('galeri'))->assertOk()->assertSee('Kegiatan Selesai Kemarin');
    }

    public function test_berulang_tidak_menggandakan_entri_galeri(): void
    {
        Kegiatan::factory()->due()->create();

        $this->get(route('kegiatan'))->assertOk();
        $this->get(route('kegiatan'))->assertOk();
        $this->get(route('galeri'))->assertOk();

        $this->assertSame(1, GalleryItem::count());
    }
}
