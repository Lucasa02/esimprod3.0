<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BmnBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class BmnController extends Controller
{
    /**
     * Tentukan kondisi berdasarkan persentase
     */
    private function tentukanKondisi($persentase)
    {
        if ($persentase >= 90) return 'Sangat Baik';
        if ($persentase >= 70) return 'Baik';
        if ($persentase >= 50) return 'Kurang Baik';
        return 'Rusak / Cacat';
    }

    /**
     * Generate kode barang unik jika tidak diisi
     * Format: BRG-YYYY-0001
     */
    private function generateUniqueKode()
    {
        $prefix = 'BRG';
        $year = Carbon::now()->format('Y');

        $last = BmnBarang::where('kode_barang', 'like', "{$prefix}-{$year}-%")
            ->orderBy('kode_barang', 'desc')
            ->first();

        $nextNumber = $last
            ? intval(substr($last->kode_barang, -4)) + 1
            : 1;

        return sprintf("%s-%s-%04d", $prefix, $year, $nextNumber);
    }

    /**
     * Menampilkan daftar barang berdasarkan ruangan
     */
    public function index(Request $request, $ruangan)
    {
        $keyword = $request->input('q') ?? $request->input('search');
        $filterPosisi = $request->input('posisi');

        $data = BmnBarang::where('ruangan', ucfirst($ruangan))
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama_barang', 'like', "%{$keyword}%")
                        ->orWhere('kode_barang', 'like', "%{$keyword}%")
                        ->orWhere('kategori', 'like', "%{$keyword}%")
                        ->orWhere('merk', 'like', "%{$keyword}%")
                        ->orWhere('nomor_seri', 'like', "%{$keyword}%")
                        ->orWhere('asal_pengadaan', 'like', "%{$keyword}%")
                        ->orWhere('peruntukan', 'like', "%{$keyword}%")
                        ->orWhere('kondisi', 'like', "%{$keyword}%");
                });
            })
            
            ->orderBy('nama_barang')
            ->paginate(10)
            ->appends($request->all());

        $title = 'Data BMN - ' . ucfirst($ruangan);
        

        return view('admin.bmn.index', compact('data', 'ruangan', 'title', 'keyword'));
    }

    /**
     * Form tambah barang
     */
    public function create($ruangan)
    {
        $title = 'Tambah Barang - ' . ucfirst($ruangan);
        return view('admin.bmn.create', compact('ruangan', 'title'));
    }

    /**
     * Simpan barang baru (dengan auto kode jika kosong)
     */
    public function store(Request $request, $ruangan)
    {
        $validated = $request->validate([
            'nama_barang'        => 'required|string|max:255',
            'kode_barang'        => 'nullable|string|max:255|unique:bmn_barangs',
            'kategori'           => 'required|string|max:255',
            'merk'               => 'nullable|string|max:255',
            'nomor_seri'         => 'nullable|string|max:255',
            'jumlah'             => 'required|integer|min:1',
            'persentase_kondisi' => 'required|numeric|min:0|max:100',
            'tahun_pengadaan'    => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'asal_pengadaan'     => 'nullable|string|max:255',
            'peruntukan'         => 'nullable|string|max:255',
            'catatan'            => 'nullable|string',
            'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'posisi'             => 'nullable|string|max:255',
        ]);

        // Generate kode otomatis jika kosong
        $validated['kode_barang'] = $validated['kode_barang'] ?? $this->generateUniqueKode();

        $validated['ruangan'] = ucfirst($ruangan);
        $validated['uuid'] = Str::uuid();
        $validated['kondisi'] = $this->tentukanKondisi($validated['persentase_kondisi']);

        // Upload foto
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('bmn/foto', 'public');
        }

        // Generate QR Code
        $namaFileQR = 'qr_' . $validated['kode_barang'] . '.png';
        $pathQR = 'bmn/qrcode/' . $namaFileQR;
        if (!Storage::disk('public')->exists('bmn/qrcode')) {
            Storage::disk('public')->makeDirectory('bmn/qrcode');
        }

        QrCode::format('png')
            ->size(300)
            ->margin(2)
            ->generate($validated['kode_barang'], Storage::disk('public')->path($pathQR));

        $validated['qr_code'] = $pathQR;

        BmnBarang::create($validated);

        return redirect()->route('bmn.index', $ruangan)
            ->with('success', 'Barang berhasil ditambahkan (kode: ' . $validated['kode_barang'] . ') dan QR Code dibuat.');
    }

    /**
     * Tampilkan detail barang
     */
    public function show($ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);
        $title = 'Detail Barang - ' . ucfirst($ruangan);
        return view('admin.bmn.show', compact('barang', 'ruangan', 'title'));
    }

    /**
     * Form edit barang
     */
    public function edit($ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);
        $title = 'Edit Barang - ' . ucfirst($ruangan);
        return view('admin.bmn.edit', compact('barang', 'ruangan', 'title'));
    }

    /**
     * Update barang
     */
    public function update(Request $request, $ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);

        $validated = $request->validate([
            'nama_barang'        => 'required|string|max:255',
            'kode_barang'        => 'required|string|max:255|unique:bmn_barangs,kode_barang,' . $barang->id,
            'kategori'           => 'required|string|max:255',
            'merk'               => 'nullable|string|max:255',
            'nomor_seri'         => 'nullable|string|max:255',
            'jumlah'             => 'required|integer|min:1',
            'persentase_kondisi' => 'required|numeric|min:0|max:100',
            'tahun_pengadaan'    => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'asal_pengadaan'     => 'nullable|string|max:255',
            'peruntukan'         => 'nullable|string|max:255',
            'catatan'            => 'nullable|string',
            'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'posisi'             => 'nullable|string|max:255',

        ]);

        // Upload foto baru (jika ada)
        if ($request->hasFile('foto')) {
            if ($barang->foto && Storage::disk('public')->exists($barang->foto)) {
                Storage::disk('public')->delete($barang->foto);
            }
            $validated['foto'] = $request->file('foto')->store('bmn/foto', 'public');
        }

        $validated['kondisi'] = $this->tentukanKondisi($validated['persentase_kondisi']);

        $barang->update($validated);

        return redirect()->route('bmn.index', $ruangan)
            ->with('success', 'Data barang berhasil diperbarui.');
    }

    /**
     * Hapus barang
     */
    public function destroy($ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);

        if ($barang->foto && Storage::disk('public')->exists($barang->foto)) {
            Storage::disk('public')->delete($barang->foto);
        }
        if ($barang->qr_code && Storage::disk('public')->exists($barang->qr_code)) {
            Storage::disk('public')->delete($barang->qr_code);
        }

        $barang->delete();

        return redirect()->route('bmn.index', $ruangan)
            ->with('success', 'Data barang berhasil dihapus.');
    }

    /**
     * Cetak semua barang di ruangan
     */
    public function print($ruangan)
    {
        $data = BmnBarang::where('ruangan', ucfirst($ruangan))
            ->orderBy('nama_barang')
            ->get();

        $title = 'Cetak Data BMN - ' . ucfirst($ruangan);
        return view('admin.bmn.print', compact('data', 'ruangan', 'title'));
    }

    /**
     * Fitur pencarian barang
     */
    public function search(Request $request, $ruangan)
    {
        $keyword = $request->input('search');
        $filterPosisi = $request->input('posisi');

        $data = BmnBarang::where('ruangan', ucfirst($ruangan))
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama_barang', 'like', "%{$keyword}%")
                        ->orWhere('kode_barang', 'like', "%{$keyword}%")
                        ->orWhere('kategori', 'like', "%{$keyword}%")
                        ->orWhere('merk', 'like', "%{$keyword}%")
                        ->orWhere('nomor_seri', 'like', "%{$keyword}%")
                        ->orWhere('asal_pengadaan', 'like', "%{$keyword}%")
                        ->orWhere('posisi', 'like', "%{$keyword}%")
                        ->orWhere('peruntukan', 'like', "%{$keyword}%")
                        ->orWhere('kondisi', 'like', "%{$keyword}%");
                });
            })
            
            ->orderBy('nama_barang', 'asc')
            ->paginate(10)
            ->appends($request->all());

        $title = 'Hasil Pencarian BMN - ' . ucfirst($ruangan);
        

        return view('admin.bmn.index', compact('data', 'ruangan', 'title', 'keyword'));
    }

    /**
     * Form filter laporan PDF
     */
    public function showFilterForm($ruangan)
    {
        $kategoriList = BmnBarang::select('kategori')->distinct()->pluck('kategori');
        $asalList = BmnBarang::select('asal_pengadaan')->distinct()->pluck('asal_pengadaan');
        $posisiList = BmnBarang::select('posisi')->distinct()->pluck('posisi');
        $tahunList = BmnBarang::select('tahun_pengadaan')->distinct()->orderBy('tahun_pengadaan', 'desc')->pluck('tahun_pengadaan');

        return view('admin.bmn.filter_form', compact('ruangan', 'kategoriList', 'asalList', 'posisiList', 'tahunList'));
    }

    /**
     * Cetak PDF berdasarkan filter
     */
    public function printFiltered(Request $request, $ruangan)
    {
        $query = BmnBarang::where('ruangan', ucfirst($ruangan));

        if ($request->filled('tahun_pengadaan')) $query->where('tahun_pengadaan', $request->tahun_pengadaan);
        if ($request->filled('kondisi')) $query->where('kondisi', $request->kondisi);
        if ($request->filled('kategori')) $query->where('kategori', $request->kategori);
        if ($request->filled('asal_pengadaan')) $query->where('asal_pengadaan', $request->asal_pengadaan);
        if ($request->filled('posisi')) $query->where('posisi', $request->posisi);
        if ($request->filled('peruntukan')) $query->where('peruntukan', $request->peruntukan);
        if ($request->filled('merk')) $query->where('merk', $request->merk);
        if ($request->filled('nomor_seri')) $query->where('nomor_seri', $request->nomor_seri);
        
        $data = $query->orderBy('nama_barang', 'asc')->get();
        $title = 'Laporan BMN (Filtered) - ' . ucfirst($ruangan);

        $pdf = Pdf::loadView('admin.bmn.print_filtered', compact('data', 'ruangan', 'title'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan_BMN_Filtered_' . ucfirst($ruangan) . '.pdf');
    }
}
