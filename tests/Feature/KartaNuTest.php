<?php

namespace Tests\Feature;

use App\Models\KartaNu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class KartaNuTest extends TestCase
{
    use RefreshDatabase;

    public function test_kartanu_page_is_available_and_admin_records_require_admin_access(): void
    {
        $this->get(route('kartanu'))->assertOk();
        $this->get(route('admin.kartanu.index'))->assertRedirect(route('login'));
    }

    public function test_card_lookup_uses_encrypted_nik_and_never_displays_full_nik(): void
    {
        $nik = '3302142104780003';
        $record = KartaNu::create([
            'name' => 'Anggota Contoh',
            'nia' => 'NIA-GML-0001',
            'nik' => $nik,
            'nik_hash' => hash_hmac('sha256', $nik, (string) config('app.key')),
            'branch_name' => 'PRNU Desa Cihonje',
            'registration_code' => 'REG-GML-2026-ABCD',
            'verification_status' => 'issued',
        ]);

        $storedNik = DB::table('kartanu_records')->where('id', $record->id)->value('nik');
        $this->assertNotSame($nik, $storedNik);

        $this->post(route('kartanu.lookup'), ['identifier' => $nik])
            ->assertOk()
            ->assertSee('Anggota Contoh')
            ->assertSee('************0003')
            ->assertDontSee($nik);
    }

    public function test_pending_card_is_not_printed_but_can_be_tracked(): void
    {
        $record = KartaNu::create([
            'name' => 'Anggota Dalam Verifikasi',
            'nia' => 'NIA-GML-0002',
            'branch_name' => 'PRNU Desa Gumelar',
            'registration_code' => 'REG-GML-2026-EFGH',
            'verification_status' => 'branch_verified',
        ]);

        $this->post(route('kartanu.lookup'), ['identifier' => $record->nia])
            ->assertOk()
            ->assertSee('Data ditemukan, kartu belum diterbitkan')
            ->assertDontSee('Cetak / Simpan PDF');

        $this->post(route('kartanu.track'), ['registration_code' => $record->registration_code])
            ->assertOk()
            ->assertSee('Anggota Dalam Verifikasi')
            ->assertSee('Verifikasi Ranting');
    }

    public function test_admin_can_manage_kartanu_records(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->get(route('admin.kartanu.index'))
            ->assertOk();

        $this->post(route('admin.kartanu.store'), [
            'name' => 'Anggota Admin',
            'nia' => 'NIA-GML-ADMIN-1',
            'nik' => '3302142104780011',
            'branch_name' => 'PRNU Desa Samudra',
            'verification_status' => 'submitted',
        ])->assertRedirect(route('admin.kartanu.index'));

        $record = KartaNu::where('nia', 'NIA-GML-ADMIN-1')->firstOrFail();

        $this->assertDatabaseHas('kartanu_records', ['nia' => 'NIA-GML-ADMIN-1']);
        $this->assertMatchesRegularExpression('/^REG-GML-\d{4}-[A-Z0-9]{8}$/', $record->registration_code);
    }
}