<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerawatanInventaris;
use Illuminate\Support\Str;
class RencanaPenghapusanController extends Controller
{
    public function index()
    {
        // Ambil hanya data yang jenis_perawatan = rencana_penghapusan
        $data = PerawatanInventaris::with('barang')
            ->where('jenis_perawatan', 'rencana_penghapusan')
            ->latest()
            ->get();

        $title = "Rencana Penghapusan Barang";

        return view('admin.rencana_penghapusan.index', compact('data', 'title'));
    }

     // =====================================
    // PINDAHKAN KE DATA PENGHAPUSAN
    // =====================================
    public function hapuskan($id)
    {
        $rencana = PerawatanInventaris::with('barang')->findOrFail($id);


        // 1. Pindahkan ke data penghapusan
        PerawatanInventaris::create([
            'uuid' => Str::uuid(),
            'barang_id' => $rencana->barang_id,
            'tanggal_perawatan' => now(),
            'jenis_perawatan' => 'penghapusan',
            'status' => 'pending',
        ]);

        // 2. Hapus dari rencana penghapusan
        $rencana->delete();

        return back()->with('success', 'Barang berhasil dipindahkan ke data penghapusan.');
    }

}
