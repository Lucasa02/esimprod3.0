<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BmnBarang;
use App\Models\LaporanKerusakan;
use App\Models\BmnJenisKerusakan;
use Illuminate\Http\Request;

class LaporanKerusakanController extends Controller
{
    public function form($id)
    {
        $barang = BmnBarang::findOrFail($id);

        // Pastikan variabel ini diambil dari database
        $jenis_kerusakan = BmnJenisKerusakan::all();

        // Sesuaikan path view dengan folder: user/inventaris/lapor_kerusakan.blade.php
        return view('user.inventaris.lapor_kerusakan', compact('barang', 'jenis_kerusakan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'jenis_kerusakan' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|max:4096' // Validasi untuk input bernama 'foto'
        ]);

        $foto = null;
        // Sesuaikan name input dari Blade (kita akan ubah di Blade menjadi 'foto')
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