<?php

namespace App\Http\Controllers;

use App\Models\KartaNu;
use App\Services\KartuQrCode;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CetakKartanuController extends Controller
{
    public function index(): View
    {
        return view('public.cetak-kartanu-form', [
            'title' => 'Cetak KartaNU - MWCNU Gumelar',
        ]);
    }

    public function show(Request $request): View
    {
        $request->validate([
            'registration_code' => 'required|string|max:50',
        ]);

        $record = KartaNu::where('registration_code', $request->registration_code)->first();

        if (! $record) {
            return view('public.cetak-kartanu-form', [
                'title' => 'Cetak KartaNU - MWCNU Gumelar',
                'error' => 'Kode registrasi tidak ditemukan. Pastikan kode yang Anda masukkan benar.',
            ]);
        }

        if ($record->verification_status !== 'issued') {
            return view('public.cetak-kartanu-form', [
                'title' => 'Cetak KartaNU - MWCNU Gumelar',
                'error' => 'Kartu Anda belum disetujui. Status saat ini: '.$record->verificationLabel(),
            ]);
        }

        return view('public.cetak-kartanu', [
            'title' => 'Cetak KartaNU - '.$record->name,
            'record' => $record,
            'verificationUrl' => KartuQrCode::payload($record),
            'qrSvg' => KartuQrCode::svg($record),
        ]);
    }
}
