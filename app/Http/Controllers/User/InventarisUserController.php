<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InventarisUserController extends Controller
{
    public function index()
    {
        // Bersihkan session jika tidak dipakai (opsional)
        session()->forget(['kodePeminjaman', 'kodePengembalian', 'dataPeminjaman', 'BarangData']);

        // Title hanya jika diperlukan
        $title = 'Inventaris';

        return view('user.inventaris', compact('title'));
    }

    public function scan($kode)
{
    return redirect()->route('peminjaman.scan', ['kode' => $kode]);
}

}
