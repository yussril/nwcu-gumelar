<?php

namespace App\Http\Controllers;

use App\Models\KartaNu;
use App\Services\BranchDirectory;
use App\Services\MemberAccountService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PendaftarKartanuController extends Controller
{
    public function index(): View
    {
        return view('pendaftaran.kartanu-form', [
            'title' => 'Registrasi Sensus KartaNU - MWCNU Gumelar',
            'desaList' => BranchDirectory::desaList(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nik' => 'required|numeric|digits:16|unique:kartanu_records,nik',
            'nama_lengkap' => ['required', 'string', 'min:3', 'max:100', 'regex:/^[A-Za-z][A-Za-z .,\'\-]*$/'],
            'tempat_lahir' => ['required', 'string', 'min:3', 'max:100', 'regex:/^[A-Za-z][A-Za-z .,\'\-]*$/'],
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'no_whatsapp' => ['required', 'string', 'regex:/^(?:\+?62|0)?8[0-9]{8,11}$/'],
            'alamat_lengkap' => 'required|string',
            'desa_ranting' => 'required|string',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_ktp_belakang' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'pas_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.numeric' => 'NIK hanya boleh berisi angka.',
            'nik.digits' => 'NIK harus tepat 16 angka.',
            'nik.unique' => 'NIK tersebut sudah terdaftar.',
            'nama_lengkap.min' => 'Nama lengkap minimal 3 karakter.',
            'nama_lengkap.max' => 'Nama lengkap maksimal 100 karakter.',
            'nama_lengkap.regex' => 'Nama lengkap hanya boleh berisi huruf, spasi, titik, koma, apostrof, dan tanda hubung.',
            'tempat_lahir.min' => 'Tempat lahir minimal 3 karakter.',
            'tempat_lahir.max' => 'Tempat lahir maksimal 100 karakter.',
            'tempat_lahir.regex' => 'Tempat lahir hanya boleh berisi huruf, spasi, titik, koma, apostrof, dan tanda hubung.',
            'no_whatsapp.regex' => 'Nomor WhatsApp tidak valid. Gunakan 9–12 angka setelah +62 (contoh: 81234567890).',
        ]);

        $ktpPath = $request->file('foto_ktp')->store('kartanu/ktp', 'public');
        $ktpBelakangPath = $request->file('foto_ktp_belakang')->store('kartanu/ktp', 'public');
        $pasFotoPath = $request->file('pas_foto')->store('kartanu/pas_foto', 'public');

        // Generate unique registration code
        $registrationCode = 'REG-GML-'.date('Y').'-'.strtoupper(Str::random(8));

        // Generate NIA (Nomor Induk Anggota)
        $nia = 'NIA-'.date('Y').'-'.str_pad(KartaNu::count() + 1, 5, '0', STR_PAD_LEFT);

        $kartanu = KartaNu::create([
            'name' => $validated['nama_lengkap'],
            'nia' => $nia,
            'nik' => $validated['nik'],
            'nik_hash' => KartaNu::hashNik($validated['nik']),
            'branch_name' => BranchDirectory::resolve($validated['desa_ranting']),
            'birth_place' => $validated['tempat_lahir'],
            'birth_date' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'no_whatsapp' => $this->normalizeWhatsapp($validated['no_whatsapp']),
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'desa_ranting' => $validated['desa_ranting'],
            'photo_path' => $pasFotoPath,
            'foto_ktp_path' => $ktpPath,
            'foto_ktp_belakang_path' => $ktpBelakangPath,
            'registration_code' => $registrationCode,
            'verification_status' => 'submitted',
            'verification_note' => 'Menunggu verifikasi dari Sekretariat MWCNU',
        ]);

        // Buatkan akun login jamaah (NIK + kata sandi default tanggal lahir DDMMYYYY).
        MemberAccountService::ensureFor($kartanu);

        return redirect()->route('pendaftaran.kartanu.sukses', [
            'registration_code' => $registrationCode,
            'branch_name' => BranchDirectory::resolve($validated['desa_ranting']),
        ]);
    }

    /**
     * Seragamkan nomor WhatsApp ke format lokal 08xxxxxxxxxx.
     * Menerima input 08..., 8..., 62..., atau +62....
     */
    private function normalizeWhatsapp(string $nomor): string
    {
        $angka = preg_replace('/\D/', '', $nomor);
        $angka = preg_replace('/^62/', '', $angka);
        $angka = ltrim($angka, '0');

        return '0'.$angka;
    }

    public function success(Request $request): View
    {
        $registrationCode = $request->query('registration_code');
        $branchName = $request->query('branch_name', 'Ranting Gumelar');

        if (! $registrationCode) {
            return redirect()->route('pendaftaran.kartanu');
        }

        return view('pendaftaran.kartanu-sukses', [
            'title' => 'Pendaftaran Berhasil - MWCNU Gumelar',
            'registrationCode' => $registrationCode,
            'branchName' => $branchName,
        ]);
    }
}
