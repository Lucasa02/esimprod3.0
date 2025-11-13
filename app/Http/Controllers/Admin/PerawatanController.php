<?php

namespace App\Http\Controllers\Admin;

use App\Models\Barang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PerawatanController extends Controller
{
	public function limitHabis()
	{
		$data = [
			'title' => 'Limit Habis',
			'barang' => Barang::where('sisa_limit', 0)
				->where('status', 'tidak-tersedia')
				->paginate(10),
		];

		return view('admin.perawatan.limit_habis.barang', $data);
	}

	public function resetLimit(string $uuid)
	{
		$barang = Barang::where('uuid', $uuid)->first();
		if ($barang) {
			if ($barang->sisa_limit == $barang->limit) {
				notify()->warning('Barang sudah direset sebelumnya');
				return redirect()->back();
			}

			$barang->update([
				'sisa_limit' => $barang->limit,
				'status' => 'tersedia'
			]);
			notify()->success('Limit Berhasil Direset');
			return redirect()->route('perawatan.limit.habis.index');
		}
	}

	public function detailBarangHabis(string $uuid)
	{
		$data = [
			'title' => 'Detail Barang',
			'barang' => Barang::where('uuid', $uuid)->first(),
		];

		return view('admin.perawatan.limit_habis.detail', $data);
	}

	public function barangHilang()
	{
		$data = [
			'title' => 'Barang Hilang',
			'barang' => Barang::where('status', 'tidak-tersedia')
				->whereHas('detail_pengembalian', function ($query) {
					$query->where('status', 'hilang');
				})
				->paginate(10),
		];

		return view('admin.perawatan.barang_hilang.barang', $data);
	}

	public function detailBarangHilang(string $uuid)
	{
		$data = [
			'title' => 'Detail Barang',
			'barang' => Barang::where('uuid', $uuid)->first(),
		];

		return view('admin.perawatan.barang_hilang.detail', $data);
	}

	public function barangRusak()
	{
		$data = [
			'title' => 'Barang Rusak',
			'barang' => Barang::where('status', 'tidak-tersedia')
				->whereHas('detail_pengembalian', function ($query) {
					$query->where('status', 'rusak');
				})
				->paginate(10),
		];

		return view('admin.perawatan.barang_rusak.barang', $data);
	}

	public function detailBarangRusak(string $uuid)
	{
		$data = [
			'title' => 'Detail Barang',
			'barang' => Barang::where('uuid', $uuid)->first(),
		];

		return view('admin.perawatan.barang_rusak.detail', $data);
	}

	public function perbaikiBarangRusak(string $uuid)
{
    $barang = Barang::where('uuid', $uuid)->first();

    if ($barang && $barang->status == 'rusak') {
        $barang->update([
            'status' => 'tersedia',
            'sisa_limit' => $barang->limit,
        ]);

        notify()->success('Barang rusak berhasil diperbaiki dan tersedia kembali');
    } else {
        notify()->warning('Barang tidak ditemukan atau bukan dalam kondisi rusak');
    }

    return redirect()->route('perawatan.barang.rusak.index');
}

	public function ubahStatus(string $uuid)
{
    $barang = Barang::where('uuid', $uuid)->first();

    if ($barang) {
        // Jika barang statusnya "tidak tersedia" (hilang)
        if ($barang->status == 'tidak-tersedia') {
            $barang->update([
                'sisa_limit' => $barang->limit, // reset ke limit penuh
                'status' => 'tersedia' // ubah status jadi tersedia
            ]);

            notify()->success('Barang berhasil direset menjadi tersedia kembali');
        } else {
            notify()->warning('Barang ini sudah tersedia');
        }

        return redirect()->route('perawatan.barang.hilang.index');
    } else {
        notify()->error('Barang tidak ditemukan');
        return redirect()->back();
    }
}

}
