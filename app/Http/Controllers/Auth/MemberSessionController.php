<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\MemberLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MemberSessionController extends Controller
{
    /**
     * Tampilkan halaman login portal jamaah.
     */
    public function create(): View
    {
        return view('member.login', [
            'title' => 'Masuk Portal Nahdliyin - MWCNU Gumelar',
        ]);
    }

    /**
     * Proses login jamaah memakai NIK dan kata sandi.
     */
    public function store(MemberLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('portal'));
    }

    /**
     * Keluar dari portal jamaah.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beranda');
    }
}
