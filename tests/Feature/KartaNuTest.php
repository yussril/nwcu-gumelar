<?php

namespace Tests\Feature;

use App\Models\KartaNu;
use App\Models\User;
use App\Services\KartuQrCode;
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

    public function test_admin_can_export_kartanu_records_as_csv_and_pdf(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        KartaNu::create([
            'name' => 'Anggota Ekspor',
            'nia' => 'NIA-GML-EXPORT-1',
            'nik' => '3302142104780022',
            'nik_hash' => hash_hmac('sha256', '3302142104780022', (string) config('app.key')),
            'branch_name' => 'PRNU Desa Cihonje',
            'registration_code' => 'REG-GML-2026-EXPT',
            'verification_status' => 'issued',
        ]);

        $csv = $this->actingAs($admin)->get(route('admin.kartanu.export.excel'));
        $csv->assertOk();
        $csv->assertHeader('content-type', 'text/csv; charset=UTF-8');
        $this->assertStringContainsString('Anggota Ekspor', $csv->streamedContent());

        $this->actingAs($admin)
            ->get(route('admin.kartanu.export.pdf'))
            ->assertOk()
            ->assertSee('Data Sensus KartaNU')
            ->assertSee('Anggota Ekspor');
    }

    public function test_printed_card_is_one_a4_sheet_with_front_and_back_from_member_data(): void
    {
        $record = $this->issuedMember();

        $this->get(route('cetak-kartanu.show', ['registration_code' => $record->registration_code]))
            ->assertOk()
            ->assertSee('1 kartu (depan &amp; belakang)', false)
            ->assertSee('Sisi depan kartu')
            ->assertSee('Sisi belakang kartu')
            ->assertSee($record->name)
            ->assertSee($record->nia)
            ->assertSee($record->nik)
            ->assertSee('Laki-laki')
            ->assertSee('PRNU Desa Cihonje')
            ->assertSee('Jl. Raya Gumelar No. 19')
            ->assertSee('21 Apr 1978')
            ->assertSee('01 Jan 2026 s/d 31 Des 2027')
            ->assertSee(route('kartanu.verifikasi', ['registrationCode' => $record->registration_code]));
    }

    public function test_qr_code_on_printed_card_leads_to_verification_page(): void
    {
        $record = $this->issuedMember();

        $this->assertSame(
            route('kartanu.verifikasi', ['registrationCode' => $record->registration_code]),
            KartuQrCode::payload($record)
        );
        $this->assertStringStartsWith('<svg', KartuQrCode::svg($record));

        $this->get(route('kartanu.verifikasi', ['registrationCode' => $record->registration_code]))
            ->assertOk()
            ->assertSee($record->name)
            ->assertSee('Kartu Terbit')
            ->assertDontSee($record->nik);
    }

    public function test_verification_page_reports_unknown_registration_code(): void
    {
        $this->get(route('kartanu.verifikasi', ['registrationCode' => 'REG-GML-2026-TIDAKADA']))
            ->assertOk()
            ->assertSee('Kode pada kartu tidak terdaftar');
    }

    /**
     * Anggota dengan status "issued" beserta data identitas lengkap untuk diuji pada kartu cetak.
     */
    private function issuedMember(): KartaNu
    {
        return KartaNu::create([
            'name' => 'Anggota Kartu Cetak',
            'nia' => 'NIA-GML-0003',
            'nik' => '3302142104780022',
            'branch_name' => 'PRNU Desa Cihonje',
            'birth_place' => 'Banyumas',
            'birth_date' => '1978-04-21',
            'jenis_kelamin' => 'L',
            'no_whatsapp' => '081234567890',
            'alamat_lengkap' => 'Jl. Raya Gumelar No. 19, RT 03/RW 05',
            'desa_ranting' => 'Cihonje',
            'registration_code' => 'REG-GML-2026-IJKLMNOP',
            'verification_status' => 'issued',
            'valid_from' => '2026-01-01',
            'valid_until' => '2027-12-31',
        ]);
    }
}
