<?php

namespace App\Http\Controllers;

use App\Models\KartaNu;
use App\Services\KartuQrCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KartaNuController extends Controller
{
    public function index(): View
    {
        return $this->page();
    }

    public function lookup(Request $request): View|RedirectResponse
    {
        $validated = $request->validate([
            'identifier' => ['required', 'string', 'max:40'],
        ]);

        $identifier = trim($validated['identifier']);
        $digits = preg_replace('/\D+/', '', $identifier);

        $record = strlen($digits) === 16
            ? KartaNu::whereIn('nik_hash', KartaNu::nikHashCandidates($digits))->first()
            : KartaNu::where('nia', $identifier)->first();

        return $this->page($record, null, $record ? null : 'Data KartaNU belum ditemukan. Periksa kembali NIA atau NIK yang dimasukkan.');
    }

    public function track(Request $request): View|RedirectResponse
    {
        $validated = $request->validate([
            'registration_code' => ['required', 'string', 'max:40'],
        ]);

        $record = KartaNu::where('registration_code', strtoupper(trim($validated['registration_code'])))->first();

        return $this->page(null, $record, null, $record ? null : 'Kode pendaftaran belum ditemukan. Pastikan kode dimasukkan dengan benar.');
    }

    /**
     * Halaman tujuan QR code pada kartu cetak: memverifikasi keabsahan kode registrasi.
     */
    public function verify(string $registrationCode): View
    {
        $record = KartaNu::where('registration_code', strtoupper(trim($registrationCode)))->first();

        return $this->page(null, $record, null, $record
            ? null
            : 'Kode pada kartu tidak terdaftar di MWCNU Gumelar. Pastikan kartu Anda diterbitkan sekretariat MWCNU.');
    }

    private function page(?KartaNu $card = null, ?KartaNu $tracking = null, ?string $lookupMessage = null, ?string $trackingMessage = null): View
    {
        // QR hanya dibutuhkan untuk kartu yang sudah diterbitkan; sisi belakang
        // pratinjau memakainya, sama persis seperti kartu yang dicetak.
        $qrSvg = $card && $card->verification_status === 'issued'
            ? KartuQrCode::svg($card)
            : null;

        return view('kartanu', [
            'title' => 'Pusat Layanan KartaNU - MWCNU Gumelar',
            'card' => $card,
            'qrSvg' => $qrSvg,
            'tracking' => $tracking,
            'lookupMessage' => $lookupMessage,
            'trackingMessage' => $trackingMessage,
        ]);
    }
}
