<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PengembalianController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data = [
			'title' => "Pengembalian",
			'pengembalian' => Pengembalian::orderBy('created_at', 'desc')->paginate(5)
		];
		return view('admin.pengembalian.index', $data);
	}


	/**
	 * Display the specified resource.
	 */
	public function show(string $uuid)
	{
		$data = [
			'title' => 'Detail Pengembalian',
			'pengembalian' => Pengembalian::where("uuid", $uuid)->first(),
		];

		return view('admin.pengembalian.detail', $data);
	}

	public function search(Request $request)
	{
		$search = $request->search;
		$bulan = $request->bulan;
		$tahun = $request->tahun;
		$status = $request->status;

		$query = Pengembalian::query();

		// Filter pencarian kode
		if ($search) {
			$query->where('kode_pengembalian', 'like', "%$search%");
		}

		// Filter bulan
		if ($bulan) {
			$query->whereMonth('tanggal_kembali', $bulan);
		}

		// Filter tahun
		if ($tahun) {
			$query->whereYear('tanggal_kembali', $tahun);
		}

		// Filter status
		if ($status) {
			$query->where('status', $status);
		}

		$pengembalian = $query->orderBy('created_at', 'desc')
			->paginate(10)
			->appends($request->all());

		return view('admin.pengembalian.index', [
			'title' => 'Pengembalian',
			'pengembalian' => $pengembalian
		]);
	}

	public function cetak(Request $request)
	{
		$query = Pengembalian::with(['peminjaman', 'detailPengembalian.barang.jenisBarang']);

		// FILTER SEARCH
		if ($request->search) {
			$query->where('kode_pengembalian', 'like', '%' . $request->search . '%');
		}

		// FILTER BULAN
		if ($request->bulan) {
			$query->whereMonth('tanggal_kembali', $request->bulan);
		}

		// FILTER TAHUN
		if ($request->tahun) {
			$query->whereYear('tanggal_kembali', $request->tahun);
		}

		// FILTER STATUS
		if ($request->status) {
			$query->where('status', $request->status);
		}

		$pengembalian = $query->orderBy('created_at', 'desc')->get();

		$pdf = Pdf::loadView('admin.pengembalian.cetak', [
			'pengembalian' => $pengembalian
		])->setPaper('a4', 'landscape');

		return $pdf->stream('laporan_pengembalian.pdf');
	}

}
