<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerawatanInventaris;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DataPenghapusanController extends Controller
{
    public function index(Request $request)
    {
        $query = PerawatanInventaris::with('barang')
            ->where('jenis_perawatan', 'penghapusan');

        // Filter Nama Barang
        if ($request->nama_barang) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('nama_barang', 'LIKE', "%" . $request->nama_barang . "%");
            });
        }

        // Filter Kode Barang
        if ($request->kode_barang) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('kode_barang', 'LIKE', "%" . $request->kode_barang . "%");
            });
        }

        // Filter Tahun
        if ($request->tahun) {
            $query->whereYear('created_at', $request->tahun);
        }

        $data = $query->get();
        $title = "Data Penghapusan"; 
        return view('admin.data_penghapusan.index', compact('data','title'));
    }
    

    // ===============================
    // CETAK PDF
    // ===============================
    public function cetakPdf(Request $request)
    {
        $query = PerawatanInventaris::with('barang')
            ->where('jenis_perawatan', 'penghapusan');

        if ($request->nama_barang) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('nama_barang', 'LIKE', "%" . $request->nama_barang . "%");
            });
        }

        if ($request->kode_barang) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('kode_barang', 'LIKE', "%" . $request->kode_barang . "%");
            });
        }

        if ($request->tahun) {
            $query->whereYear('created_at', $request->tahun);
        }

        $data = $query->get();

        $pdf = Pdf::loadView('admin.data_penghapusan.pdf', compact('data'))
                ->setPaper('A4', 'portrait');

        return $pdf->download('data_penghapusan.pdf');
    }
}

   
