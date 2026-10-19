<?php

namespace Tests\Feature;

use App\Models\KartaNu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MemberPortalTest extends TestCase
{
    use RefreshDatabase;

    public function test_pendaftaran_online_membuat_akun_login(): void
    {
        $response = $this->post(route('pendaftaran.kartanu.store'), [
            'nik' => '3302142010900001',
            'nama_lengkap' => 'Ahmad Fauzi',
            'tempat_lahir' => 'Gumelar',
            'tanggal_lahir' => '1999-06-10',
            'jenis_kelamin' => 'L',
            'no_whatsapp' => '81234567890',
            'alamat_lengkap' => 'Jl. Gumelar RT.12 RW.04',
            'desa_ranting' => 'Desa Gumelar',
            'foto_ktp' => $this->fakePhoto('ktp-depan.png'),
            'foto_ktp_belakang' => $this->fakePhoto('ktp-belakang.png'),
            'pas_foto' => $this->fakePhoto('pas.png'),
        ]);

        $response->assertRedirect();

        $user = User::where('nik', '3302142010900001')->first();

        $this->assertNotNull($user);
        $this->assertFalse($user->is_admin);
        $this->assertTrue(Hash::check('10061999', $user->password));

        $record = KartaNu::whereIn('nik_hash', KartaNu::nikHashCandidates('3302142010900001'))->first();
        $this->assertNotNull($record);
        $this->assertSame($user->id, $record->user_id);
        // Pas foto menjadi foto profil, sedangkan KTP disimpan terpisah per sisi.
        $this->assertSame('kartanu/pas_foto', dirname((string) $record->photo_path));
        $this->assertSame('kartanu/ktp', dirname((string) $record->foto_ktp_path));
        $this->assertSame('kartanu/ktp', dirname((string) $record->foto_ktp_belakang_path));
        // Input 812... dari formulir +62 disimpan seragam sebagai 0812....
        $this->assertSame('081234567890', $record->no_whatsapp);
    }

    public function test_pendaftaran_membatasi_format_nik_nama_tempat_dan_whatsapp(): void
    {
        $this->post(route('pendaftaran.kartanu.store'), [
            'nik' => '3302142010900', // 13 digit, bukan 16
            'nama_lengkap' => str_repeat('A', 101), // melebihi 100 karakter
            'tempat_lahir' => 'Gumelar99', // mengandung angka
            'tanggal_lahir' => '1999-06-10',
            'jenis_kelamin' => 'L',
            'no_whatsapp' => 'abc0812', // bukan angka
            'alamat_lengkap' => 'Jl. Gumelar RT.12 RW.04',
            'desa_ranting' => 'Desa Gumelar',
            'foto_ktp' => $this->fakePhoto('ktp-depan.png'),
            'foto_ktp_belakang' => $this->fakePhoto('ktp-belakang.png'),
            'pas_foto' => $this->fakePhoto('pas.png'),
        ])->assertSessionHasErrors(['nik', 'nama_lengkap', 'tempat_lahir', 'no_whatsapp']);
    }

    public function test_jamaah_dapat_masuk_dengan_nik_dan_password_default(): void
    {
        $user = User::factory()->create([
            'nik' => '3302142010900002',
            'email' => null,
            'password' => Hash::make('20011995'),
            'is_admin' => false,
        ]);

        $response = $this->post(route('masuk'), [
            'nik' => '3302142010900002',
            'password' => '20011995',
        ]);

        $response->assertRedirect(route('portal'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_password_salah_ditolak(): void
    {
        User::factory()->create([
            'nik' => '3302142010900003',
            'email' => null,
            'password' => Hash::make('20011995'),
        ]);

        $this->post(route('masuk'), [
            'nik' => '3302142010900003',
            'password' => 'salah',
        ])->assertSessionHasErrors('nik');

        $this->assertGuest();
    }

    public function test_portal_hanya_bisa_diakses_setelah_masuk(): void
    {
        $this->get(route('portal'))->assertRedirect(route('masuk'));
    }

    public function test_halaman_masuk_mengarahkan_yang_sudah_masuk(): void
    {
        $user = User::factory()->create(['nik' => '3302142010900004', 'email' => null]);

        $this->actingAs($user)->get(route('masuk'))->assertRedirect(route('portal'));
    }

    public function test_jamaah_dapat_mengubah_kata_sandi(): void
    {
        $user = User::factory()->create([
            'nik' => '3302142010900005',
            'email' => null,
            'password' => Hash::make('20011995'),
        ]);

        $this->actingAs($user)
            ->put(route('portal.kata-sandi'), [
                'current_password' => '20011995',
                'password' => 'Sand!Baru2026',
                'password_confirmation' => 'Sand!Baru2026',
            ])
            ->assertSessionHasNoErrors();

        $this->assertTrue(Hash::check('Sand!Baru2026', $user->fresh()->password));
    }

    public function test_halaman_sukses_menampilkan_pemberitahuan_login(): void
    {
        $this->get(route('pendaftaran.kartanu.sukses', [
            'registration_code' => 'REG-GML-2026-ABCDEFGH',
            'branch_name' => 'Ranting Gumelar',
        ]))
            ->assertOk()
            ->assertSee('Masuk Portal')
            ->assertSee(route('masuk'));
    }

    public function test_jamaah_dapat_memperbarui_data_pribadi(): void
    {
        $user = User::factory()->create(['nik' => '3302142010900006', 'email' => null]);
        $record = $this->buatCatatanKartanu($user, 'REG-GML-2026-EDIT0001');

        $this->actingAs($user)
            ->put(route('portal.data-pribadi'), [
                // Nama & NIK sengaja dikirim untuk memastikan diabaikan server.
                'name' => 'Nama Palsu',
                'nik' => '9999999999999999',
                'tempat_lahir' => 'Banyumas',
                'tanggal_lahir' => '1996-03-02',
                'jenis_kelamin' => 'P',
                'no_whatsapp' => '081299998888',
                'alamat_lengkap' => 'Jl. Baru No. 5, Gumelar',
                'desa_ranting' => 'Desa Cihonje',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $record->refresh();

        $this->assertSame('Banyumas', $record->birth_place);
        $this->assertSame('1996-03-02', $record->birth_date->format('Y-m-d'));
        $this->assertSame('P', $record->jenis_kelamin);
        $this->assertSame('081299998888', $record->no_whatsapp);
        $this->assertSame('Jl. Baru No. 5, Gumelar', $record->alamat_lengkap);
        $this->assertSame('Desa Cihonje', $record->desa_ranting);
        $this->assertSame('Ranting Cihonje', $record->branch_name);
        // Nama dan NIK tidak ikut berubah walau dikirim di permintaan.
        $this->assertSame($user->name, $record->name);
        $this->assertSame('3302142010900006', $record->nik);
    }

    public function test_data_pribadi_menolak_desa_di_luar_daftar(): void
    {
        $user = User::factory()->create(['nik' => '3302142010900007', 'email' => null]);
        $record = $this->buatCatatanKartanu($user, 'REG-GML-2026-EDIT0002');

        // followingRedirects: pesan galat ikut dirender ulang di portal dan
        // modal edit otomatis terbuka kembali.
        $this->actingAs($user)
            ->from(route('portal'))
            ->followingRedirects()
            ->put(route('portal.data-pribadi'), [
                'tempat_lahir' => 'Gumelar',
                'tanggal_lahir' => '1996-03-02',
                'jenis_kelamin' => 'L',
                'no_whatsapp' => '081200000000',
                'alamat_lengkap' => 'Dusun Lama',
                'desa_ranting' => 'Desa Entah',
            ])
            ->assertOk()
            ->assertSee('edit: true', false);

        $this->assertSame('Desa Gumelar', $record->fresh()->desa_ranting);
    }

    public function test_data_pribadi_butuh_catatan_kartanu(): void
    {
        $user = User::factory()->create(['nik' => '3302142010900008', 'email' => null]);

        $this->actingAs($user)
            ->put(route('portal.data-pribadi'), [
                'tempat_lahir' => 'Gumelar',
                'tanggal_lahir' => '1996-03-02',
                'jenis_kelamin' => 'L',
                'no_whatsapp' => '081200000000',
                'alamat_lengkap' => 'Dusun Lama',
                'desa_ranting' => 'Desa Gumelar',
            ])
            ->assertSessionHasErrors('tempat_lahir');
    }

    public function test_jamaah_dapat_memperbarui_foto_ktp_depan_dan_belakang(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['nik' => '3302142010900009', 'email' => null]);
        $record = $this->buatCatatanKartanu($user, 'REG-GML-2026-KTP00001');

        $this->actingAs($user)
            ->put(route('portal.foto-ktp'), [
                'foto_ktp' => $this->fakePhoto('ktp-depan.png'),
                'foto_ktp_belakang' => $this->fakePhoto('ktp-belakang.png'),
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $record->refresh();

        $this->assertNotNull($record->foto_ktp_path);
        $this->assertNotNull($record->foto_ktp_belakang_path);
        Storage::disk('public')->assertExists($record->foto_ktp_path);
        Storage::disk('public')->assertExists($record->foto_ktp_belakang_path);
    }

    public function test_satu_sisi_foto_ktp_dapat_diperbarui_tanpa_mengubah_sisi_lain(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['nik' => '3302142010900010', 'email' => null]);
        $record = $this->buatCatatanKartanu($user, 'REG-GML-2026-KTP00002');

        $depanLama = $this->fakePhoto('depan-lama.png')->store('kartanu/ktp', 'public');
        $belakangLama = $this->fakePhoto('belakang-lama.png')->store('kartanu/ktp', 'public');
        $record->update([
            'foto_ktp_path' => $depanLama,
            'foto_ktp_belakang_path' => $belakangLama,
        ]);

        $this->actingAs($user)
            ->put(route('portal.foto-ktp'), [
                'foto_ktp' => $this->fakePhoto('depan-baru.png'),
            ])
            ->assertSessionHasNoErrors();

        $record->refresh();

        Storage::disk('public')->assertMissing($depanLama);
        Storage::disk('public')->assertExists($record->foto_ktp_path);
        $this->assertNotSame($depanLama, $record->foto_ktp_path);
        $this->assertSame($belakangLama, $record->foto_ktp_belakang_path);
        Storage::disk('public')->assertExists($belakangLama);
    }

    public function test_edit_foto_ktp_butuh_setidaknya_satu_file(): void
    {
        $user = User::factory()->create(['nik' => '3302142010900011', 'email' => null]);
        $this->buatCatatanKartanu($user, 'REG-GML-2026-KTP00003');

        $this->actingAs($user)
            ->put(route('portal.foto-ktp'), [])
            ->assertSessionHasErrors('foto_ktp');
    }

    /**
     * Berkas PNG 1x1 valid agar aturan validasi "image" berjalan tanpa GD.
     */
    private function fakePhoto(string $name): UploadedFile
    {
        $path = tempnam(sys_get_temp_dir(), 'kartanu_').'.png';
        file_put_contents($path, base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg=='
        ));

        return new UploadedFile($path, $name, 'image/png', null, true);
    }

    private function buatCatatanKartanu(User $user, string $registrationCode): KartaNu
    {
        return KartaNu::create([
            'name' => $user->name,
            'nia' => 'NIA-GML-'.substr($registrationCode, -4),
            'nik' => $user->nik,
            'nik_hash' => KartaNu::hashNik((string) $user->nik),
            'branch_name' => 'Ranting Gumelar',
            'birth_place' => 'Gumelar',
            'birth_date' => '1995-01-20',
            'jenis_kelamin' => 'L',
            'no_whatsapp' => '081200000000',
            'alamat_lengkap' => 'Dusun Lama',
            'desa_ranting' => 'Desa Gumelar',
            'registration_code' => $registrationCode,
            'verification_status' => 'submitted',
            'user_id' => $user->id,
        ]);
    }
}
