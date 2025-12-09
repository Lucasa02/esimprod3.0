<?php

namespace App\Http\Controllers\Admin;

use App\Models\Barang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
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

	public function barangHilang(Request $request)
    {
        $query = Barang::where('status', 'tidak-tersedia')
            ->whereHas('detail_pengembalian', function ($q) {
                $q->where('status', 'hilang');
            });

        // Filter Jenis Barang
        if ($request->jenis_barang_id) {
            $query->where('jenis_barang_id', $request->jenis_barang_id);
        }

        // Search Kode Barang / Nomor Seri
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_barang', 'like', "%$search%")
                ->orWhere('nomor_seri', 'like', "%$search%");
            });
        }

        $data = [
            'title' => 'Barang Hilang',
            'barang' => $query->paginate(12)->withQueryString(),
            'jenisBarang' => \App\Models\JenisBarang::all()
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

	public function barangRusak(Request $request)
    {
        $query = Barang::where('status', 'tidak-tersedia')
            ->whereHas('detail_pengembalian', function ($query) {
                $query->where('status', 'rusak');
            });

        // Filter Jenis Barang
        if ($request->jenis_barang_id) {
            $query->where('jenis_barang_id', $request->jenis_barang_id);
        }

        // Search Kode Barang / Nomor Seri
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_barang', 'like', "%$search%")
                ->orWhere('nomor_seri', 'like', "%$search%");
            });
        }

        $data = [
            'title' => 'Barang Rusak',
            'barang' => $query->paginate(12)->withQueryString(),
            'jenisBarang' => \App\Models\JenisBarang::all(),
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

            if ($barang->status == 'tidak-tersedia') {

                $barang->update([
                    'sisa_limit' => $barang->limit,
                    'status' => 'tersedia'
                ]);

                notify()->success('Barang Telah Ditemukan Kembali ✅');

            } else {
                notify()->warning('Barang ini sudah tersedia');
            }

            return redirect()->route('perawatan.barang.hilang.index');

        } else {
            notify()->error('Barang tidak ditemukan');
            return redirect()->back();
        }
    }

    public function cetakPdfBarangHilang(Request $request)
    {
        $query = Barang::where('status', 'tidak-tersedia')
            ->whereHas('detail_pengembalian', function ($q) {
                $q->where('status', 'hilang');
            });

        // Filter Jenis Barang
        if ($request->jenis_barang_id) {
            $query->where('jenis_barang_id', $request->jenis_barang_id);
        }

        // Search kode / nomor seri
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_barang', 'like', "%$search%")
                ->orWhere('nomor_seri', 'like', "%$search%");
            });
        }

        $barang = $query->get();

        $pdf = Pdf::loadView('admin.perawatan.barang_hilang.pdf', [
            'barang' => $barang
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-barang-hilang.pdf');
    }

    public function cetakPdfBarangRusak(Request $request)
    {
        $query = Barang::where('status', 'tidak-tersedia')
            ->whereHas('detail_pengembalian', function ($q) {
                $q->where('status', 'rusak');
            });

        // Filter Jenis Barang
        if ($request->jenis_barang_id) {
            $query->where('jenis_barang_id', $request->jenis_barang_id);
        }

        // Search kode / nomor seri
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_barang', 'like', "%$search%")
                ->orWhere('nomor_seri', 'like', "%$search%");
            });
        }

        $barang = $query->get();

        $pdf = Pdf::loadView('admin.perawatan.barang_rusak.pdf', [
            'barang' => $barang
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-barang-rusak.pdf');
    }

    public function uploadSurat(Request $request, $uuid)
    {
        $request->validate([
            'surat' => 'required|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        $file = $request->file('surat');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/surat'), $namaFile);

        \App\Models\Surat::create([
            'barang_uuid' => $uuid,
            'nama_file'   => $namaFile
        ]);

        // --- TAMBAHAN KODE ---
        // Update status barang menjadi 'perbaikan' agar hilang dari list rusak
        // dan bisa dideteksi sebagai 'Perbaikan' di halaman index
        $barang = Barang::where('uuid', $uuid)->first();
        if ($barang) {
            $barang->update(['status' => 'perbaikan']);
        }
        // ---------------------

        notify()->success('Surat berhasil diupload dan status barang menjadi Perbaikan');
        return back();
    }

    public function lihatSurat(Request $request)
    {
        // Ambil parameter kategori dari URL (rusak atau hilang)
        $kategori = $request->query('kategori');

        // Query dasar
        $query = \App\Models\Surat::with('barang');

        if ($kategori == 'hilang') {
            // Filter khusus barang hilang (Cari yang nama filenya mengandung _DITEMUKAN_)
            $query->where('nama_file', 'LIKE', '%_DITEMUKAN_%');
            
            $pageTitle = 'Daftar Surat Barang Ditemukan';
            $tableHeader = 'Surat Bukti Ditemukan';
            // Set tombol kembali ke halaman barang hilang
            $backUrl = route('perawatan.barang.hilang.index');
        } else {
            // Default: Barang Rusak (Cari yang nama filenya TIDAK mengandung _DITEMUKAN_)
            $query->where('nama_file', 'NOT LIKE', '%_DITEMUKAN_%');

            $pageTitle = 'Daftar Surat Perbaikan';
            $tableHeader = 'Surat Perbaikan';
            // Set tombol kembali ke halaman barang rusak
            $backUrl = route('perawatan.barang.rusak.index');
        }

        return view('admin.perawatan.surat.index', [
            'title'       => $pageTitle,
            'tableHeader' => $tableHeader,
            'backUrl'     => $backUrl,
            'surat'       => $query->get()
        ]);
    }

    public function ubahStatusSurat($id)
    {
        $surat = \App\Models\Surat::find($id);
        $surat->status = !$surat->status;
        $surat->save();

        notify()->success('Status surat diperbarui');
        return back();
    }

    public function hapusSurat($id)
    {
        $surat = \App\Models\Surat::find($id);

        if (!$surat) {
            notify()->error('Surat tidak ditemukan');
            return back();
        }

        // Hapus file fisik
        $filepath = public_path('uploads/surat/' . $surat->nama_file);
        if (file_exists($filepath)) {
            unlink($filepath);
        }

        // Hapus database
        $surat->delete();

        notify()->success('Surat berhasil dihapus');
        return back();
    }

    public function uploadSuratDitemukan(Request $request, $uuid)
{
    // 1. Validasi File
    $request->validate([
        'surat' => 'required|mimes:pdf,jpg,jpeg,png|max:2048'
    ]);

    // 2. Cari Barang
    $barang = Barang::where('uuid', $uuid)->first();

    if (!$barang) {
        notify()->error('Barang tidak ditemukan');
        return back();
    }

    // 3. Proses Upload File
    $file = $request->file('surat');
    $namaFile = time() . '_DITEMUKAN_' . $file->getClientOriginalName(); 
    $file->move(public_path('uploads/surat'), $namaFile);

    // 4. Simpan ke Tabel Surat
    \App\Models\Surat::create([
        'barang_uuid' => $uuid,
        'nama_file'   => $namaFile
    ]);

    // 5. Update Status Barang 
    // UBAH DISINI: Status menjadi 'ditemukan' agar muncul badge khusus
    $barang->update([
        'sisa_limit' => $barang->limit,
        'status'     => 'ditemukan' 
    ]);

    notify()->success('Surat Berhasil Diupload & Barang Status Ditemukan ✅');
    return back();
}

}
