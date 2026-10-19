<?php

namespace App\Services;

use App\Models\KartaNu;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MemberAccountService
{
    /**
     * Kata sandi default akun jamaah: tanggal lahir format DDMMYYYY (HHBBTTTT).
     */
    public static function defaultPassword(KartaNu $record): string
    {
        return $record->birth_date?->format('dmY') ?? '';
    }

    /**
     * Pastikan catatan KartaNU memiliki akun login. Akun yang sudah ada dipakai
     * kembali, jadi pemanggilan berulang tidak menimbulkan duplikat.
     */
    public static function ensureFor(KartaNu $record): ?User
    {
        if (! $record->nik || ! $record->birth_date) {
            return null;
        }

        $user = User::where('nik', $record->nik)->first();

        if (! $user) {
            $user = User::create([
                'name' => $record->name,
                'email' => null,
                'nik' => $record->nik,
                'password' => Hash::make(self::defaultPassword($record)),
                'is_admin' => false,
            ]);
        }

        if ($record->user_id !== $user->id) {
            $record->update(['user_id' => $user->id]);
        }

        return $user;
    }

    /**
     * Sinkronkan NIK akun jamaah bila admin mengubah NIK pada catatan KartaNU.
     */
    public static function syncNik(KartaNu $record, ?string $nik): void
    {
        if (! $record->user_id) {
            return;
        }

        $record->user()->update(['nik' => $nik ?: null]);
    }
}
