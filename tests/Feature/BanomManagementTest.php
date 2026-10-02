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
        $this->get(route('dashboard.index'))
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

    public function test_authenticated_user_can_create_update_and_delete_banom_with_members(): void
    {
        $this->actingAs(User::factory()->create(['is_admin' => true]));

        $this->post(route('dashboard.banoms.store'), [
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
        ])->assertRedirect(route('dashboard.banoms.index'));

        $banom = Banom::with('members')->where('slug', 'banom-percobaan')->firstOrFail();
        $this->assertSame('Nama Ketua', $banom->members->first()->name);

        $this->put(route('dashboard.banoms.update', $banom), [
            'name' => 'Banom Percobaan',
            'category' => 'Badan Otonom',
            'title' => 'Judul yang diperbarui',
            'description' => 'Deskripsi yang diperbarui.',
            'members' => [
                ['position' => 'Ketua', 'name' => 'Nama Ketua Baru'],
                ['position' => 'Sekretaris', 'name' => 'Nama Sekretaris'],
            ],
        ])->assertRedirect(route('dashboard.banoms.index'));

        $this->assertDatabaseHas('banoms', ['id' => $banom->id, 'title' => 'Judul yang diperbarui']);
        $this->assertDatabaseHas('banom_members', ['banom_id' => $banom->id, 'name' => 'Nama Ketua Baru']);
        $this->assertDatabaseHas('banom_members', ['banom_id' => $banom->id, 'name' => 'Nama Sekretaris']);

        $this->delete(route('dashboard.banoms.destroy', $banom))
            ->assertRedirect(route('dashboard.banoms.index'));

        $this->assertDatabaseMissing('banoms', ['id' => $banom->id]);
        $this->assertDatabaseMissing('banom_members', ['banom_id' => $banom->id]);
    }
}