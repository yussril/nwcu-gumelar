<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'foto_ktp_belakang_path',
        'registration_code',
        'verification_status',
        'valid_from',
        'valid_until',
        'verification_note',
        'user_id',
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

    /**
     * Akun login jamaah yang terkait dengan catatan KartaNU ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Hash NIK kanonik (HMAC-SHA256 dengan APP_KEY) untuk pencarian
     * deterministik tanpa menyimpan NIK asli.
     */
    public static function hashNik(string $nik): string
    {
        return hash_hmac('sha256', $nik, (string) config('app.key'));
    }

    /**
     * Semua varian hash NIK yang pernah dipakai. Catatan lama dari formulir
     * pendaftaran memakai SHA-256 biasa, sedangkan data baru memakai HMAC.
     * Pencarian memeriksa keduanya agar data lama tetap dapat ditemukan.
     *
     * @return array<int, string>
     */
    public static function nikHashCandidates(string $nik): array
    {
        return array_values(array_unique([
            self::hashNik($nik),
            hash('sha256', $nik),
        ]));
    }

    public function maskedNik(): string
    {
        $nik = $this->nik;

        return $nik ? str_repeat('*', max(0, strlen($nik) - 4)).substr($nik, -4) : 'Tidak tersedia';
    }

    public function photoUrl(): ?string
    {
        return $this->photo_path ? asset('storage/'.$this->photo_path) : null;
    }

    /**
     * URL foto KTP bagian depan yang diunggah saat pendaftaran.
     */
    public function fotoKtpDepanUrl(): ?string
    {
        return $this->foto_ktp_path ? asset('storage/'.$this->foto_ktp_path) : null;
    }

    /**
     * URL foto KTP bagian belakang yang diunggah saat pendaftaran.
     */
    public function fotoKtpBelakangUrl(): ?string
    {
        return $this->foto_ktp_belakang_path ? asset('storage/'.$this->foto_ktp_belakang_path) : null;
    }

    public function jenisKelaminLabel(): string
    {
        return match ($this->jenis_kelamin) {
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
            default => 'Tidak dicantumkan',
        };
    }

    /**
     * Format tanggal memakai nama bulan bahasa Indonesia, dipakai saat mencetak kartu.
     */
    public function tanggalIndonesia(?DateTimeInterface $tanggal, string $format = 'd M Y'): string
    {
        return $tanggal?->locale('id')->translatedFormat($format) ?? '—';
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
