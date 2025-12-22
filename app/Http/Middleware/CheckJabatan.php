<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckJabatan
{
    public function handle(Request $request, Closure $next, ...$jabatans)
    {
        // Jika tidak login, biarkan Laravel ditangani oleh middleware 'auth' di web.php
        if (!Auth::check()) {
            return $next($request);
        }

        $userJabatan = Auth::user()->jabatan->jabatan ?? null;

        if (!$userJabatan || !in_array($userJabatan, $jabatans)) {
            notify()->error('Anda tidak memiliki akses ke halaman ini!');
            return redirect()->route('user.option');
        }

        return $next($request);
    }
}
