<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanKerusakan;
use App\Models\PerawatanInventaris;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanKerusakanAdminController extends Controller
{
    public function index()
    {
        // Tambahkan with('barang') di sini
        $laporan = LaporanKerusakan::with('barang')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $title = "Laporan Kerusakan";
        return view('admin.laporan_kerusakan.index', compact('laporan', 'title'));
    }


    public function detail($uuid)
    {
        $laporan = LaporanKerusakan::with('barang')->where('uuid', $uuid)->firstOrFail();
        $title = "Laporan Kerusakan";
        return view('admin.laporan_kerusakan.detail', compact('laporan', 'title'));
    }

    public function setujui($uuid)
    {
        $laporan = LaporanKerusakan::where('uuid', $uuid)->firstOrFail();

        // MASUKKAN KE PERAWATAN INVENTARIS
        PerawatanInventaris::create([
            'barang_id'         => $laporan->barang_id,
            'tanggal_perawatan' => now(), // Sertakan tanggal sekarang
            'jenis_perawatan'   => 'perbaikan',
            'deskripsi'         => $laporan->deskripsi,
            'foto_kerusakan'    => $laporan->foto,
            'status'            => 'pending'
        ]);

        // Update status laporan asal
        $laporan->update(['status' => 'disetujui']);

        // Redirect ke halaman index perawatan inventaris
        return redirect()->route('perawatan_inventaris.index')
            ->with('success', 'Laporan disetujui dan berhasil dipindahkan ke daftar Perawatan.');
    }

    public function tolak($uuid)
    {
        LaporanKerusakan::where('uuid', $uuid)->update([
            'status' => 'ditolak'
        ]);

        return redirect()->back()->with('success', 'Laporan ditolak.');
    }

    public function exportPDF()
    {
        // Tambahkan with('barang') di sini juga agar PDF tidak error
        $laporan = LaporanKerusakan::with('barang')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.laporan_kerusakan.pdf_rekap', compact('laporan'));

        return $pdf->stream('rekap-laporan-kerusakan-' . date('Y-m-d') . '.pdf');
    }
}