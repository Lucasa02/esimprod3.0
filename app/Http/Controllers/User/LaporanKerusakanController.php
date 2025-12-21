<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BmnBarang;
use App\Models\LaporanKerusakan;
use Illuminate\Http\Request;

class LaporanKerusakanController extends Controller
{
    public function form($id)
    {
        $barang = BmnBarang::findOrFail($id);

        return view('user.lapor_kerusakan', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'jenis_kerusakan' => 'required',
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image|max:4096'
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('laporan/kerusakan', 'public');
        }

        LaporanKerusakan::create([
            'barang_id' => $request->barang_id,
            'jenis_kerusakan' => $request->jenis_kerusakan,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Laporan telah dikirim, menunggu verifikasi admin.');
    }
}

