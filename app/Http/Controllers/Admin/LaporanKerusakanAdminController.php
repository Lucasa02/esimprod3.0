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
    $laporan = LaporanKerusakan::where('status', 'pending')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
    $title = "Laporan Kerusakan";
    return view('admin.laporan_kerusakan.index', compact('laporan','title'));
}


    public function detail($uuid)
    {
        $laporan = LaporanKerusakan::where('uuid', $uuid)->firstOrFail();
        $title = "Laporan Kerusakan";
        return view('admin.laporan_kerusakan.detail', compact('laporan','title'));
    }

    public function setujui($uuid)
    {
        $laporan = LaporanKerusakan::where('uuid', $uuid)->firstOrFail();

        // MASUKKAN KE PERAWATAN INVENTARIS
        PerawatanInventaris::create([
            'barang_id' => $laporan->barang_id,
            'jenis_perawatan' => 'perbaikan',
            'deskripsi' => $laporan->deskripsi,
            'foto_kerusakan' => $laporan->foto,
            'status' => 'pending'
        ]);

        $laporan->update(['status' => 'disetujui']);

        return redirect()->back()->with('success', 'Laporan disetujui dan dimasukkan ke Perawatan.');
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
        // Mengambil data yang sedang tampil (pending)
        $laporan = LaporanKerusakan::where('status', 'pending')->orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('admin.laporan_kerusakan.pdf_rekap', compact('laporan'));

        // Ubah download menjadi stream agar terbuka di browser
        return $pdf->stream('rekap-laporan-kerusakan-' . date('Y-m-d') . '.pdf');
    }
}