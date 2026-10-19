<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Services\BranchDirectory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Perbarui data pribadi jamaah dari portal.
     *
     * Nama lengkap dan NIK sengaja tidak dapat diubah sendiri karena menjadi
     * dasar verifikasi identitas; perubahan keduanya harus lewat sekretariat.
     */
    public function update(Request $request): RedirectResponse
    {
        $record = $request->user()->kartanuRecord;

        if (! $record) {
            return redirect()->to(route('portal').'#data-pribadi')->withErrors([
                'tempat_lahir' => 'Data KartaNU Anda belum terhubung dengan akun portal.',
            ]);
        }

        $validated = $request->validate([
            'tempat_lahir' => ['required', 'string', 'min:3', 'max:100', 'regex:/^[A-Za-z][A-Za-z .,\'\-]*$/'],
            'tanggal_lahir' => ['required', 'date', 'before:tomorrow'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'no_whatsapp' => ['required', 'string', 'regex:/^(?:\+?62|0)?8[0-9]{8,11}$/'],
            'alamat_lengkap' => ['required', 'string', 'max:1000'],
            'desa_ranting' => ['required', 'string', 'in:'.implode(',', BranchDirectory::desaList())],
        ], [
            'tempat_lahir.min' => 'Tempat lahir minimal 3 karakter.',
            'tempat_lahir.max' => 'Tempat lahir maksimal 100 karakter.',
            'tempat_lahir.regex' => 'Tempat lahir hanya boleh berisi huruf, spasi, titik, koma, apostrof, dan tanda hubung.',
            'no_whatsapp.regex' => 'Nomor WhatsApp tidak valid. Gunakan 10–13 angka dengan awalan 08 (contoh: 081234567890).',
        ]);

        $record->update([
            'birth_place' => $validated['tempat_lahir'],
            'birth_date' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'no_whatsapp' => $this->normalizeWhatsapp($validated['no_whatsapp']),
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'desa_ranting' => $validated['desa_ranting'],
            'branch_name' => BranchDirectory::resolve($validated['desa_ranting']),
        ]);

        return redirect()->to(route('portal').'#data-pribadi')
            ->with('status_profile', 'Data pribadi berhasil diperbarui.');
    }

    /**
     * Perbarui foto KTP (depan dan/atau belakang) dari portal jamaah.
     *
     * Unggahan bersifat opsional per sisi: hanya file yang dikirim yang
     * diganti, sehingga jamaah bisa memperbaiki satu sisi saja.
     */
    public function updateKtp(Request $request): RedirectResponse
    {
        $record = $request->user()->kartanuRecord;

        if (! $record) {
            return redirect()->to(route('portal').'#dokumen-ktp')->withErrors([
                'foto_ktp' => 'Data KartaNU Anda belum terhubung dengan akun portal.',
            ]);
        }

        $request->validate([
            'foto_ktp' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'foto_ktp_belakang' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $updates = [];

        foreach (['foto_ktp' => 'foto_ktp_path', 'foto_ktp_belakang' => 'foto_ktp_belakang_path'] as $input => $column) {
            if (! $request->hasFile($input)) {
                continue;
            }

            if ($record->{$column}) {
                Storage::disk('public')->delete($record->{$column});
            }

            $updates[$column] = $request->file($input)->store('kartanu/ktp', 'public');
        }

        if ($updates === []) {
            return redirect()->to(route('portal').'#dokumen-ktp')->withErrors([
                'foto_ktp' => 'Pilih minimal satu foto KTP yang ingin diperbarui.',
            ]);
        }

        $record->update($updates);

        return redirect()->to(route('portal').'#dokumen-ktp')
            ->with('status_ktp', 'Foto KTP berhasil diperbarui.');
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
}
