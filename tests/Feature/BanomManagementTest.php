<?php

namespace Tests\Feature;

use App\Models\Banom;
use App\Models\User;
use Database\Seeders\BanomSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BanomManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_requires_authentication(): void
    {
        $this->get(route('dashboard'))
            ->assertRedirect(route('login'));
    }

    public function test_public_page_renders_seeded_banoms_without_all_filter(): void
    {
        $this->seed(BanomSeeder::class);

        $this->get(route('banom'))
            ->assertOk()
            ->assertSee('GP Ansor &amp; Banser', false)
            ->assertSee('LBM &amp; Lembaga Dakwah', false)
            ->assertDontSee('Semua Banom &amp; Lembaga', false);
    }

    public function test_seeder_matches_the_five_keluarga_besar_banner_categories(): void
    {
        $this->seed(BanomSeeder::class);

        $this->assertSame(
            [
                'gp-ansor-banser' => 'Badan Otonom Kepemudaan & Kebanseran',
                'fatayat-nu' => 'Perempuan & Keluarga Nahdliyin',
                'ipnu-ippnu' => 'Kaderisasi Pelajar & Santri',
                'upzis-lazisnu' => 'Lembaga Amil & Filantropi',
                'lbmnu-ldnu' => 'Kajian Syariat & Dakwah',
            ],
            Banom::orderBy('sort_order')->pluck('category', 'slug')->all(),
        );

        // Muslimat NU digabung ke dalam Fatayat NU, jadi tidak ada entitas terpisah.
        $this->assertDatabaseMissing('banoms', ['slug' => 'muslimat-nu']);
        $this->assertDatabaseHas('banom_members', ['position' => 'Sekretaris Muslimat']);
    }

    public function test_homepage_renders_one_banner_per_active_banom_with_its_category(): void
    {
        $this->seed(BanomSeeder::class);

        $response = $this->get(route('beranda'))->assertOk();

        foreach (Banom::orderBy('sort_order')->get() as $banom) {
            $response
                ->assertSee(route('banom').'#'.$banom->slug, false)
                ->assertSee($banom->name, false)
                ->assertSee($banom->category, false);
        }

        $response->assertSee('Keluarga Besar MWCNU', false);
    }

    public function test_homepage_banner_skips_inactive_banoms_and_falls_back_when_empty(): void
    {
        Banom::create([
            'name' => 'Banom Nonaktif',
            'slug' => 'banom-nonaktif',
            'category' => 'Badan Otonom',
            'title' => 'Pimpinan Banom Nonaktif',
            'description' => 'Entitas yang sudah tidak aktif.',
            'sort_order' => 1,
            'is_active' => false,
        ]);

        $this->get(route('beranda'))
            ->assertOk()
            ->assertDontSee('banom-nonaktif', false)
            ->assertSee('Data badan otonom belum tersedia.');
    }

    public function test_homepage_banner_renders_banoms_without_a_custom_theme(): void
    {
        Banom::create([
            'name' => 'Lembaga Dakwah Baru',
            'slug' => 'lembaga-dakwah-baru',
            'category' => 'Kajian Syariat & Dakwah',
            'title' => 'Pimpinan Lembaga Dakwah Baru',
            'motto' => 'Tagline lembaga baru',
            'description' => 'Deskripsi lembaga baru.',
            'member_count' => '12 kader',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $this->get(route('beranda'))
            ->assertOk()
            ->assertSee('Lembaga Dakwah Baru', false)
            ->assertSee('Tagline lembaga baru', false);
    }

    public function test_authenticated_user_can_create_update_and_delete_banom_with_members(): void
    {
        $this->actingAs(User::factory()->create(['is_admin' => true]));

        $this->post(route('admin.banoms.store'), [
            'name' => 'Banom Percobaan',
            'category' => 'Badan Otonom',
            'title' => 'Pimpinan Banom Percobaan',
            'motto' => 'Berkhidmat bersama',
            'description' => 'Deskripsi organisasi untuk pengujian.',
            'term' => '2025–2028',
            'member_count' => '25 kader',
            'coverage' => '10 ranting',
            'legal_status' => 'SK pengurus',
            'note' => 'Catatan program',
            'is_active' => '1',
            'members' => [
                ['position' => 'Ketua', 'name' => 'Nama Ketua'],
            ],
        ])->assertRedirect(route('admin.banoms.index'));

        $banom = Banom::with('members')->where('slug', 'banom-percobaan')->firstOrFail();
        $this->assertSame('Nama Ketua', $banom->members->first()->name);

        $this->put(route('admin.banoms.update', $banom), [
            'name' => 'Banom Percobaan',
            'category' => 'Badan Otonom',
            'title' => 'Judul yang diperbarui',
            'description' => 'Deskripsi yang diperbarui.',
            'members' => [
                ['position' => 'Ketua', 'name' => 'Nama Ketua Baru'],
                ['position' => 'Sekretaris', 'name' => 'Nama Sekretaris'],
            ],
        ])->assertRedirect(route('admin.banoms.index'));

        $this->assertDatabaseHas('banoms', ['id' => $banom->id, 'title' => 'Judul yang diperbarui']);
        $this->assertDatabaseHas('banom_members', ['banom_id' => $banom->id, 'name' => 'Nama Ketua Baru']);
        $this->assertDatabaseHas('banom_members', ['banom_id' => $banom->id, 'name' => 'Nama Sekretaris']);

        $this->delete(route('admin.banoms.destroy', $banom))
            ->assertRedirect(route('admin.banoms.index'));

        $this->assertDatabaseMissing('banoms', ['id' => $banom->id]);
        $this->assertDatabaseMissing('banom_members', ['banom_id' => $banom->id]);
    }
}
