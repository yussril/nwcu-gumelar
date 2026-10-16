<?php

namespace App\Services;

use App\Models\KartaNu;
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Output\QRMarkupSVG;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

/**
 * Membuat QR code verifikasi keanggotaan e-KartaNU.
 *
 * QR dirender sebagai SVG markup (bukan PNG) supaya tetap tajam saat kertas
 * dicetak atau diunduh sebagai PDF, dan tanpa perlu ekstensi GD/Imagick.
 */
class KartuQrCode
{
    /**
     * Isi QR: tautan halaman verifikasi publik kartu anggota.
     */
    public static function payload(KartaNu $record): string
    {
        return route('kartanu.verifikasi', ['registrationCode' => $record->registration_code]);
    }

    /**
     * Render QR sebagai markup SVG untuk disisipkan langsung di halaman cetak.
     */
    public static function svg(KartaNu $record): string
    {
        return (new QRCode(new QROptions([
            'outputInterface' => QRMarkupSVG::class,
            'outputBase64' => false,
            'eccLevel' => EccLevel::L,
            'scale' => 8,
            'addQuietzone' => true,
            'quietzoneSize' => 1,
            'svgAddXmlHeader' => false,
        ])))->render(self::payload($record));
    }
}
