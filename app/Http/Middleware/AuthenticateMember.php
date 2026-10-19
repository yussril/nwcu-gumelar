<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class AuthenticateMember extends Middleware
{
    /**
     * Arahkan jamaah yang belum masuk ke halaman login portal.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('masuk');
    }
}
