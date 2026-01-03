<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerawatanInventaris;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RencanaPenghapusanController extends Controller
{
    public function index()
    {
        $data = PerawatanInventaris::with('barang')
            ->where('jenis_perawatan', 'rencana_penghapusan')
            ->latest()
            ->get();

        $title = "Rencana Penghapusan Barang";

        return view('admin.rencana_penghapusan.index', compact('data', 'title'));
    }

    /**
     * UPLOAD SURAT PENGHAPUSAN
     */
    public function uploadSurat(Request $request, $id)
    {
        $request->validate([
            'surat' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $rencana = PerawatanInventaris::findOrFail($id);

        // Hapus surat lama jika ada
        if ($rencana->surat_penghapusan) {
            Storage::disk('public')->delete($rencana->surat_penghapusan);
        }

        // Upload surat baru
        $path = $request->file('surat')->store('surat_penghapusan', 'public');

        // Simpan ke database
        $rencana->update([
            'surat_penghapusan' => $path,
        ]);

        return back()->with('success', 'Surat penghapusan berhasil diupload.');
    }

    /**
     * PINDAHKAN KE DATA PENGHAPUSAN
     */
    public function hapuskan($id)
    {
        $rencana = PerawatanInventaris::with('barang')->findOrFail($id);

        // CEK: Surat harus sudah ada!
        if (!$rencana->surat_penghapusan) {
            return back()->with('error', 'Upload surat penghapusan terlebih dahulu!');
        }

        // Pindahkan ke data penghapusan
        PerawatanInventaris::create([
            'uuid' => Str::uuid(),
            'barang_id' => $rencana->barang_id,
            'tanggal_perawatan' => now(),
            'jenis_perawatan' => 'penghapusan',
            'status' => 'pending',
            'deskripsi' => $rencana->deskripsi,
            'surat_penghapusan' => $rencana->surat_penghapusan,
        ]);

        // Hapus dari rencana penghapusan
        $rencana->delete();

        return back()->with('success', 'Barang berhasil dipindahkan ke data penghapusan.');
    }

    /**
     * CETAK PDF
     */
    public function cetakPdf()
    {
        $data = PerawatanInventaris::with('barang')
            ->where('jenis_perawatan', 'rencana_penghapusan')
            ->latest()
            ->get();

        $pdf = Pdf::loadView('admin.rencana_penghapusan.pdf', compact('data'));

        // Setup ukuran kertas F4 atau A4 Landscape
        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-rencana-penghapusan.pdf');
    }
}
