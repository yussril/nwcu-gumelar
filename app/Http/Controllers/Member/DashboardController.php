<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Services\BranchDirectory;
use App\Services\KartuQrCode;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan portal jamaah beserta data KartaNU terkait.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $record = $user->kartanuRecord;

        return view('member.dashboard', [
            'title' => 'Portal Nahdliyin - MWCNU Gumelar',
            'user' => $user,
            'record' => $record,
            // Pilihan desa/ranting untuk formulir penyuntingan data pribadi.
            'desaList' => BranchDirectory::desaList(),
            // QR hanya dibutuhkan untuk kartu yang sudah diterbitkan (sisi belakang).
            'qrSvg' => $record && $record->verification_status === 'issued'
                ? KartuQrCode::svg($record)
                : null,
        ]);
    }
}
