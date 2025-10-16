<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catatan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

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
		$bulan = $request->bulan;
		$tahun = $request->tahun;

		// Ambil data peminjaman sesuai bulan & tahun
		$peminjamanBulanan = Peminjaman::whereMonth('tanggal_peminjaman', $bulan)
			->whereYear('tanggal_peminjaman', $tahun)
			->with('detailPeminjaman.barang', 'peruntukan')
			->get();

		// Ambil catatan (jika ada)
		$catatan = Catatan::whereMonth('created_at', $bulan)
			->whereYear('created_at', $tahun)
			->get();

		return view('admin.peminjaman.laporan-bulanan', [
			'peminjamanBulanan' => $peminjamanBulanan,
			'catatan' => $catatan,
			'bulan' => $bulan,
			'tahun' => $tahun,
		]);
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
