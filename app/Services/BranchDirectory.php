<?php

namespace App\Services;

/**
 * Daftar desa/ranting di wilayah MWCNU Kecamatan Gumelar beserta nama
 * rantingnya. Dipakai bersama oleh formulir pendaftaran KartaNU dan
 * penyuntingan data pribadi di portal jamaah supaya daftarnya selalu sama.
 */
class BranchDirectory
{
    /**
     * @var array<string, string>
     */
    private const BRANCHES = [
        'Desa Gumelar' => 'Ranting Gumelar',
        'Desa Cihonje' => 'Ranting Cihonje',
        'Desa Samudra' => 'Ranting Samudra',
        'Desa Kemitir' => 'Ranting Kemitir',
        'Desa Puring' => 'Ranting Puring',
        'Desa Somawangi' => 'Ranting Somawangi',
        'Desa Somagede' => 'Ranting Somagede',
        'Desa Cilangkap' => 'Ranting Cilangkap',
        'Desa Karanganyar' => 'Ranting Karanganyar',
        'Desa Lumbir' => 'Ranting Lumbir',
    ];

    /**
     * Nama desa yang dapat dipilih warga.
     *
     * @return array<int, string>
     */
    public static function desaList(): array
    {
        return array_keys(self::BRANCHES);
    }

    /**
     * Nama ranting untuk sebuah desa. Desa yang tidak dikenal memakai
     * "Ranting Gumelar" sebagai nilai cadangan.
     */
    public static function resolve(string $desa): string
    {
        return self::BRANCHES[$desa] ?? 'Ranting Gumelar';
    }
}
