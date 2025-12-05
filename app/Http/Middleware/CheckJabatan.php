<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckJabatan
{
    public function handle(Request $request, Closure $next, ...$jabatans)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userJabatan = Auth::user()->jabatan->jabatan; // Mengambil nama jabatan

        if (!in_array($userJabatan, $jabatans)) {
            notify()->error('Anda tidak memiliki akses ke halaman ini!');
            return redirect()->route('user.option'); // Halaman default user lain
        }

        return $next($request);
    }
}
