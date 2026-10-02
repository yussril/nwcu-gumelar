<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartaNu extends Model
{
    protected $table = 'kartanu_records';

    protected $fillable = [
        'name',
        'nia',
        'nik',
        'nik_hash',
        'branch_name',
        'birth_place',
        'birth_date',
        'jenis_kelamin',
        'no_whatsapp',
        'alamat_lengkap',
        'desa_ranting',
        'photo_path',
        'foto_ktp_path',
        'registration_code',
        'verification_status',
        'valid_from',
        'valid_until',
        'verification_note',
    ];

    protected function casts(): array
    {
        return [
            'nik' => 'encrypted',
            'birth_date' => 'date',
            'valid_from' => 'date',
            'valid_until' => 'date',
        ];
    }

    public function maskedNik(): string
    {
        $nik = $this->nik;

        return $nik ? str_repeat('*', max(0, strlen($nik) - 4)) . substr($nik, -4) : 'Tidak tersedia';
    }

    public function photoUrl(): ?string
    {
        return $this->photo_path ? asset('storage/' . $this->photo_path) : null;
    }

    public function verificationProgress(): int
    {
        return match ($this->verification_status) {
            'submitted' => 1,
            'branch_verified' => 2,
            'mwc_verified' => 3,
                'issued' => 5,
            default => 0,
        };
    }

    public function verificationLabel(): string
    {
        return match ($this->verification_status) {
            'submitted' => 'Berkas Masuk',
            'branch_verified' => 'Verifikasi Ranting',
            'mwc_verified' => 'Validasi MWCNU',
            'issued' => 'Kartu Terbit',
            'rejected' => 'Perlu Perbaikan',
            default => 'Status belum diketahui',
        };
    }
}