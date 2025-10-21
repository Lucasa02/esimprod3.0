<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catatan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Peruntukan;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
{
    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');

    $query = Peminjaman::orderBy('tanggal_peminjaman', 'desc');

    if ($bulan && $tahun) {
        // Filter berdasarkan bulan dan tahun
        $query->whereMonth('tanggal_peminjaman', $bulan)
              ->whereYear('tanggal_peminjaman', $tahun);
    } elseif ($tahun) {
        // Filter hanya berdasarkan tahun
        $query->whereYear('tanggal_peminjaman', $tahun);
    }

    $data = [
        'title' => 'Peminjaman',
        'peminjaman' => $query->paginate(5),
        'catatan' => Catatan::get(['id', 'isi_catatan']),
        'bulan' => $bulan,
        'tahun' => $tahun,
    ];

    return view('admin.peminjaman.index', $data);
}


	/**
	 * Display the specified resource.
	 */
	public function show(string $uuid)
	{
		$data = [
			'title' => 'Detail Peminjaman',
			'peminjaman' => Peminjaman::where('uuid', $uuid)->first(),
		];

		return view('admin.peminjaman.detail', $data);
	}

	public function search(Request $request)
	{
		$search = $request->search;
		$peminjaman = Peminjaman::where('kode_peminjaman', 'like', "%" . $search . "%")
			->orderBy('tanggal_peminjaman', 'desc')
			->paginate(10)
			->appends(['search' => $search]);

		$data = [
			'title' => 'Peminjaman',
			'peminjaman' => $peminjaman,
		];

		return view('admin.peminjaman.index', $data);
	}

	public function print(string $uuid)
	{
		$peminjaman = Peminjaman::where('uuid', $uuid)->first();

		if (!$peminjaman) {
			notify()->error('Peminjaman tidak ditemukan');
			return redirect()->back();
		}

		$pdf = Pdf::loadView('admin.peminjaman.pdf', [
			'peminjaman' => $peminjaman,
			'catatan' => Catatan::get()
		])->setPaper('A4', 'landscape');
		return $pdf->stream('Peminjaman-' . $peminjaman->kode_peminjaman . '-' . time() . '.pdf');
	}

	public function laporanBulanan(Request $request)
{
    $tipe_filter = $request->tipe_filter;
    $bulan = $request->bulan;
    $tahun = $request->tahun;
    $tanggal_awal = $request->tanggal_awal;
    $tanggal_akhir = $request->tanggal_akhir;
    $peruntukan = $request->peruntukan;

    $query = Peminjaman::with('detailPeminjaman.barang', 'peruntukan');

    if ($tipe_filter === 'bulan' && $bulan && $tahun) {
        $query->whereMonth('tanggal_peminjaman', $bulan)
              ->whereYear('tanggal_peminjaman', $tahun);
    }

    if ($tipe_filter === 'tanggal' && $tanggal_awal && $tanggal_akhir) {
        $query->whereBetween('tanggal_peminjaman', [$tanggal_awal, $tanggal_akhir]);
    }

    if ($peruntukan) {
        $query->where('peruntukan_id', $peruntukan);
    }

    $peminjamanBulanan = $query->orderBy('tanggal_peminjaman', 'desc')->get();

    return view('admin.peminjaman.laporan-bulanan', [
        'peminjamanBulanan' => $peminjamanBulanan,
        'tipe_filter' => $tipe_filter,
        'bulan' => $bulan,
        'tahun' => $tahun,
        'tanggal_awal' => $tanggal_awal,
        'tanggal_akhir' => $tanggal_akhir,
        'peruntukan' => $peruntukan,
        'daftarPeruntukan' => Peruntukan::all(),
    ]);
}

public function exportLaporanBulanan(Request $request)
{
    $bulan = $request->bulan;
    $tahun = $request->tahun;
    $tanggal_awal = $request->tanggal_awal;
    $tanggal_akhir = $request->tanggal_akhir;
    $peruntukan = $request->peruntukan;

    $query = Peminjaman::with('detailPeminjaman.barang.jenisBarang', 'peruntukan');

    if ($bulan && $tahun) {
        $query->whereMonth('tanggal_peminjaman', $bulan)
              ->whereYear('tanggal_peminjaman', $tahun);
    }

    if ($tanggal_awal && $tanggal_akhir) {
        $query->whereBetween('tanggal_peminjaman', [$tanggal_awal, $tanggal_akhir]);
    }

    if ($peruntukan) {
        $query->where('peruntukan_id', $peruntukan);
    }

    $peminjamanBulanan = $query->orderBy('tanggal_peminjaman', 'desc')->get();

    $periode = 'Semua Periode';
    if ($bulan && $tahun) {
        $periode = Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y');
    } elseif ($tanggal_awal && $tanggal_akhir) {
        $periode = 'Periode ' . Carbon::parse($tanggal_awal)->translatedFormat('d F Y') .
                   ' - ' . Carbon::parse($tanggal_akhir)->translatedFormat('d F Y');
    }

    $pdf = Pdf::loadView('admin.peminjaman.pdf-laporan-bulanan', [
        'peminjamanBulanan' => $peminjamanBulanan,
        'periode' => $periode,
        'bulan' => $bulan,
        'tahun' => $tahun,
        'tanggal_awal' => $tanggal_awal,
        'tanggal_akhir' => $tanggal_akhir,
        'peruntukan' => $peruntukan,
    ])->setPaper('A4', 'landscape');

    return $pdf->download('Laporan-Peminjaman-' . str_replace(' ', '-', $periode) . '.pdf');
}


	public function editCatatan($id)
	{
		$data = [
			'title' => 'Edit Catatan Peminjaman',
			'catatan' => Catatan::findOrFail($id)
		];

		return view('admin.peminjaman.catatan', $data);
	}

	public function updateCatatan(Request $request, $id)
	{
		$request->validate([
			'isi_catatan' => 'required'
		], [
			'isi_catatan.required' => 'Catatan harus diisi'
		]);

		$data = $request->only('isi_catatan');

		Catatan::where('id', $id)->update($data);

		notify()->success('Catatan berhasil diubah');
		return redirect()->route('peminjaman.index');
	}
}
