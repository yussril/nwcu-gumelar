<?php

namespace App\Http\Controllers;

use App\Models\KartaNu;
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
            ? KartaNu::where('nik_hash', hash_hmac('sha256', $digits, (string) config('app.key')))->first()
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

            private function page(?KartaNu $card = null, ?KartaNu $tracking = null, ?string $lookupMessage = null, ?string $trackingMessage = null): View
    {
        return view('kartanu', [
            'title' => 'Pusat Layanan KartaNU - MWCNU Gumelar',
            'card' => $card,
            'tracking' => $tracking,
            'lookupMessage' => $lookupMessage,
            'trackingMessage' => $trackingMessage,
        ]);
    }
}