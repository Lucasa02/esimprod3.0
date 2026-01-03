<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerawatanInventaris;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DataPenghapusanController extends Controller
{
    public function index()
    {
        // Mengambil semua data penghapusan tanpa filter request
        $data = PerawatanInventaris::with('barang')
            ->where('jenis_perawatan', 'penghapusan')
            ->latest()
            ->get();

        $title = "Data Penghapusan";
        return view('admin.data_penghapusan.index', compact('data', 'title'));
    }

    // ===============================
    // CETAK PDF (Preview Mode)
    // ===============================
    public function cetakPdf()
    {
        $data = PerawatanInventaris::with('barang')
            ->where('jenis_perawatan', 'penghapusan')
            ->get();

        $pdf = Pdf::loadView('admin.data_penghapusan.pdf', compact('data'))
            ->setPaper('A4', 'portrait');

        // Menggunakan stream() alih-alih download() agar terbuka di tab baru (preview)
        return $pdf->stream('data_penghapusan.pdf');
    }
}