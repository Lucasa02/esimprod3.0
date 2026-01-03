<?php

namespace App\Http\Controllers\Admin;

use App\Models\Barang;
use App\Models\BmnBarang;
use App\Models\BmnRuangan;
use App\Models\JenisBarang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as Pdf;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Pagination\LengthAwarePaginator;

class BarangController extends Controller
{
    /**
     * 1. Fungsi Index - Khusus Mengambil Data Master
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter', 'nama_barang');

        // Query khusus Data Master (Model: Barang)
        $masterQuery = Barang::with('jenisBarang')
            ->whereIn('status', ['tersedia', 'perbaikan', 'ditemukan']);

        if ($search) {
            if ($filter == 'nama_barang') {
                $masterQuery->where('nama_barang', 'like', '%' . $search . '%');
            } elseif ($filter == 'kode_barang') {
                $masterQuery->where('kode_barang', 'like', '%' . $search . '%');
            } elseif ($filter == 'nomor_seri') {
                $masterQuery->where('nomor_seri', 'like', '%' . $search . '%');
            } elseif ($filter == 'jenis_barang') {
                // Filter berdasarkan nama jenis_barang di tabel relasi
                $masterQuery->whereHas('jenisBarang', function ($q) use ($search) {
                    $q->where('jenis_barang', 'like', '%' . $search . '%');
                });
            }
        }

        $barang = $masterQuery->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.barang.index', [
            'title' => 'Data Barang Master',
            'barang' => $barang,
        ]);
    }

    public function bmnIndex(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter', 'nama_barang');
        // Tambahkan variabel untuk menangkap filter ruangan
        $ruangan_filter = $request->input('ruangan_filter');

        $list_ruangan = BmnRuangan::orderBy('nama_ruangan', 'asc')->get();

        $bmnQuery = BmnBarang::query()
            ->whereDoesntHave('perawatanInventaris', function ($q) {
                // Cukup filter jenisnya saja, biarkan statusnya apa pun
                $q->where('jenis_perawatan', 'penghapusan');
            });
        // Logika Filter Ruangan
        if ($ruangan_filter) {
            $bmnQuery->where('ruangan', $ruangan_filter);
        }

        // Logika Pencarian yang sudah ada
        if ($search) {
            if ($filter == 'nama_barang') {
                $bmnQuery->where('nama_barang', 'like', '%' . $search . '%');
            } elseif ($filter == 'ruangan') {
                $bmnQuery->where('ruangan', 'like', '%' . $search . '%');
            } elseif ($filter == 'kode_barang') {
                $bmnQuery->where('kode_barang', 'like', '%' . $search . '%');
            }
        }

        $barang = $bmnQuery->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.barang.index_bmn', [
            'title' => 'Data Barang BMN',
            'barang' => $barang,
            'list_ruangan' => $list_ruangan,
            'ruangan_filter' => $ruangan_filter, // Kirim status filter kembali ke view
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Barang',
            'jenis_barang' => JenisBarang::all()
        ];

        return view('admin.barang.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|unique:barang,nama_barang',
            'merk' => 'required',
            'nomor_seri' => 'required',
            'jenis_barang_id' => 'required|exists:jenis_barang,id',
            'limit' => 'required|numeric',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png',
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.unique' => 'Nama barang sudah ada.',
            'merk.required' => 'Merk wajib diisi.',
            'nomor_seri.required' => 'Nomor Seri wajib diisi.',
            'jenis_barang_id.required' => 'Jenis Barang wajib diisi.',
            'jenis_barang_id.exists' => 'Jenis barang tidak ditemukan.',
            'limit.required' => 'Limit wajib diisi.',
            'limit.numeric' => 'Limit harus berupa angka.',
            'foto.mimes' => 'File harus dalam format jpg, jpeg, png.',
        ]);

        $kode_barang = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 12);
        $qrCode = QrCode::format('svg')->size(200)->generate($kode_barang);
        $qrCodeFileName = time() . '_qr.svg';
        Storage::disk('public')->put('uploads/qr_codes_barang/' . $qrCodeFileName, $qrCode);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);

            $image->scaleDown(500, 500);
            $canvas = $manager->create(500, 500)->fill('#ffffff');
            $canvas->place($image, 'center');

            $encoded = $canvas->encodeByExtension($file->getClientOriginalExtension(), quality: 80);

            Storage::disk('public')->put('uploads/foto_barang/' . $filename, $encoded);
            $data['foto'] = $filename;
        } else {
            $data['foto'] = 'default.jpg';
        }

        Barang::create([
            'uuid' => Str::uuid(),
            'kode_barang' => $kode_barang,
            'nama_barang' => $request->nama_barang,
            'nomor_seri' => $request->nomor_seri,
            'merk' => $request->merk,
            'jenis_barang_id' => $request->jenis_barang_id,
            'status' => $request->limit == 0 ? 'tidak-tersedia' : 'tersedia',
            'limit' => $request->limit,
            'sisa_limit' => $request->limit,
            'foto' => $data['foto'],
            'deskripsi' => $request->deskripsi,
            'qr_code' => $qrCodeFileName,
        ]);

        notify()->success('Barang Berhasil Ditambahkan');
        return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $data = [
            'title' => 'Detail Barang',
            'barang' => Barang::where('uuid', $uuid)->first(),
        ];

        return view('admin.barang.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $data = [
            'title' => 'Edit Barang',
            'barang' => Barang::where('uuid', $uuid)->first(),
            'jenis_barang' => JenisBarang::all()
        ];

        return view('admin.barang.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $request->validate([
            'nama_barang' => 'required',
            'nomor_seri' => 'required',
            'merk' => 'required',
            'jenis_barang_id' => 'required|exists:jenis_barang,id',
            'limit' => 'required|numeric',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png',
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nomor_seri.required' => 'Nomor Seri wajib diisi.',
            'merk.required' => 'Merk wajib diisi.',
            'jenis_barang_id.required' => 'Jenis Barang wajib diisi.',
            'jenis_barang_id.exists' => 'Jenis barang tidak ditemukan.',
            'limit.required' => 'Limit wajib diisi.',
            'limit.numeric' => 'Limit harus berupa angka.',
            'foto.mimes' => 'File harus dalam format jpg, jpeg, png.',
        ]);

        $barang = Barang::where('uuid', $uuid)->firstOrFail();
        $filename = $barang->foto;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);

            $image->scaleDown(500, 500);
            $canvas = $manager->create(500, 500)->fill('#ffffff');
            $canvas->place($image, 'center');

            $encoded = $canvas->encodeByExtension($file->getClientOriginalExtension(), quality: 80);

            Storage::disk('public')->put('uploads/foto_barang/' . $filename, $encoded);
        }

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'nomor_seri' => $request->nomor_seri,
            'merk' => $request->merk,
            'jenis_barang_id' => $request->jenis_barang_id,
            'status' => $request->limit == 0 ? 'tidak-tersedia' : 'tersedia',
            'limit' => $request->limit,
            'deskripsi' => $request->deskripsi,
            'foto' => $filename,
        ]);

        notify()->success('Barang Berhasil Diupdate');

        $currentPage = $request->input('page', 1);
        return redirect()->route('barang.index', ['page' => $currentPage]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $uuid)
    {
        $barang = Barang::where('uuid', $uuid)->first();
        if ($barang) {
            if ($barang->qr_code) {
                Storage::disk('public')->delete('uploads/qr_codes_barang/' . $barang->qr_code);
            }
            if ($barang->foto && $barang->foto !== 'default.jpg') {
                Storage::disk('public')->delete('uploads/foto_barang/' . $barang->foto);
            }
            $barang->delete();
            notify()->success('Barang Berhasil Dihapus');
            return redirect()->route('barang.index', ['page' => $request->page]);
        }
    }

    /**
     * Fitur Cetak Data (PDF)
     */
    /**
     * Fitur Cetak Data (PDF)
     */
    public function printBarang(Request $request)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);

        $kategori = $request->input('kategori', 'all');
        $ruangan = $request->input('ruangan', 'all');

        $collection = collect();

        // Ambil Data Master jika kategori 'all' atau 'master'
        if ($kategori == 'all' || $kategori == 'master') {
            $master = Barang::with('jenisBarang')->orderBy('nama_barang', 'ASC')->get();
            $collection = $collection->concat($master);
        }

        // Ambil Data BMN jika kategori 'all' atau 'bmn'
        if ($kategori == 'all' || $kategori == 'bmn') {
            $bmnQuery = BmnBarang::query();
            if ($ruangan != 'all') {
                $bmnQuery->where('ruangan', 'like', $ruangan . '%');
            }
            $bmn = $bmnQuery->orderBy('nama_barang', 'ASC')->get();
            $collection = $collection->concat($bmn);
        }

        if ($collection->isEmpty()) {
            notify()->error('Data barang tidak ditemukan.');
            return redirect()->back();
        }

        // LOGIKA PEMILIHAN VIEW BERDASARKAN KATEGORI
        if ($kategori == 'bmn') {
            // Jika BMN, gunakan print_filtered.blade.php (Pastikan key adalah 'data')
            $data = [
                'data'    => $collection,
                'ruangan' => $ruangan,
                'title'   => 'Laporan Data Barang BMN'
            ];
            $pdf = Pdf::loadView('admin.bmn.print_filtered', $data)->setPaper('a4', 'landscape');
        } else {
            // Jika Master (atau all), gunakan barang_pdf.blade.php (Pastikan key adalah 'barang')
            $data = [
                'barang'      => $collection,
                'filter_info' => strtoupper($kategori),
                'title'       => 'Laporan Data Barang'
            ];
            $pdf = Pdf::loadView('admin.barang.barang_pdf', $data)->setPaper('a4', 'landscape');
        }

        return $pdf->stream('Laporan-Barang-' . time() . '.pdf');
    }

    /**
     * Fitur Cetak QR (PDF)
     */
    public function printQrCode(Request $request)
    {
        ini_set('memory_limit', '-1');
        $kategori = $request->input('kategori', 'all');
        $ruangan = $request->input('ruangan', 'all');

        $collection = collect();

        if ($kategori == 'all' || $kategori == 'master') {
            $collection = $collection->concat(Barang::get());
        }

        if ($kategori == 'all' || $kategori == 'bmn') {
            $query = BmnBarang::query();
            if ($kategori == 'bmn' && $ruangan != 'all') {
                $query->where('ruangan', 'like', $ruangan . '%');
            }
            $collection = $collection->concat($query->get());
        }

        if ($collection->isEmpty()) {
            notify()->error('Data tidak ditemukan');
            return redirect()->back();
        }

        $data['barang'] = $collection;
        $pdf = Pdf::loadView('admin.barang.qrcode_pdf', $data)->setPaper('a4', 'portrait');
        return $pdf->stream('QRCode-Barang-' . time() . '.pdf');
    }

    /**
     * Helper Method untuk Jenis Barang
     */
    public function jenisBarang(JenisBarang $jenisBarang)
    {
        $barang = $jenisBarang->barang()->with('jenisBarang')->paginate(5);
        $data = [
            'title' => 'Jenis Barang : ' . $jenisBarang->jenis_barang,
            'barang' => $barang,
            'count' => $barang->count()
        ];
        return view('admin.barang.index', $data);
    }

    /**
     * Fitur Cetak QR Khusus Label Ruangan (Pintu)
     */
    public function printQrRuangan(Request $request)
    {
        $ruanganNama = $request->input('ruangan');

        // Logika penggabungan: jika 'all', ambil semua. Jika spesifik, filter by name.
        if ($ruanganNama == 'all') {
            $ruangans = BmnRuangan::orderBy('nama_ruangan', 'asc')->get();
        } else {
            $ruangans = BmnRuangan::where('nama_ruangan', $ruanganNama)->get();
        }

        if ($ruangans->isEmpty()) {
            notify()->error('Data ruangan tidak ditemukan.');
            return redirect()->back();
        }

        $data = [
            'ruangans' => $ruangans,
            'title'    => 'QR Code Ruangan BMN'
        ];

        $pdf = Pdf::loadView('admin.barang.qrcode_ruangan_pdf', $data)->setPaper('a4', 'portrait');
        return $pdf->stream('QRCode-Ruangan-' . time() . '.pdf');
    }
}