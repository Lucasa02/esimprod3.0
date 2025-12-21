<?php

namespace App\Http\Controllers\Admin;

use App\Models\Barang;
use App\Models\BmnBarang;
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
     * Display a listing of the resource.
     * UPDATED: Menggabungkan Master & BMN + Search Logic
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter', 'nama_barang');
        
        // --- 1. Query MASTER ---
        // Load relasi jenisBarang agar tidak N+1 Problem
        $masterQuery = Barang::with('jenisBarang')
            ->whereIn('status', ['tersedia', 'perbaikan', 'ditemukan']);
            
        // --- 2. Query BMN ---
        $bmnQuery = BmnBarang::query();

        // --- 3. Terapkan Filter ---
        if ($search) {
            if ($filter == 'nama_barang') {
                $masterQuery->where('nama_barang', 'like', '%' . $search . '%');
                $bmnQuery->where('nama_barang', 'like', '%' . $search . '%');
            } 
            elseif ($filter == 'kode_barang') {
                $masterQuery->where('kode_barang', 'like', '%' . $search . '%');
                $bmnQuery->where('kode_barang', 'like', '%' . $search . '%');
            }
            elseif ($filter == 'kategori_data') {
                // Filter logika: Jika user ketik 'master', kosongkan BMN. Jika 'bmn', kosongkan Master.
                if (stripos('master', $search) !== false) {
                    $bmnQuery->where('id', 0); // Force empty BMN
                } elseif (stripos('bmn', $search) !== false) {
                    $masterQuery->where('id', 0); // Force empty Master
                }
            }
            elseif ($filter == 'ruangan') {
                // Master tidak punya ruangan, jadi kosongkan master
                $masterQuery->where('id', 0);
                $bmnQuery->where('ruangan', 'like', '%' . $search . '%');
            }
            // Tambahan: Filter Status/Kondisi jika diperlukan
            elseif ($filter == 'status') {
                 // Sederhana: cari di field status master atau kondisi BMN
                 $masterQuery->where('status', 'like', '%' . $search . '%');
                 $bmnQuery->where('kondisi', 'like', '%' . $search . '%');
            }
        }

        // --- 4. Eksekusi Query ---
        $masterResults = $masterQuery->orderBy('created_at', 'DESC')->get();
        $bmnResults = $bmnQuery->orderBy('created_at', 'DESC')->get();

        // --- 5. Gabungkan Hasil (Merge) ---
        $merged = $masterResults->concat($bmnResults);
        
        // Sorting gabungan berdasarkan created_at terbaru
        $merged = $merged->sortByDesc('created_at');

        // --- 6. Manual Pagination Logic ---
        $page = $request->input('page', 1);
        $perPage = 10;
        
        // Slice koleksi sesuai halaman
        $items = $merged->slice(($page - 1) * $perPage, $perPage)->values();

        // Buat objek Paginator baru
        $paginatedItems = new LengthAwarePaginator(
            $items,
            $merged->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $data = [
            'title' => 'Semua Barang',
            'barang' => $paginatedItems,
        ];

        return view('admin.barang.index', $data);
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
     * (LOGIKA ASLI DIPERTAHANKAN)
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

            // 🧠 Baca file dan ubah ke ukuran seragam 500x500 (Intervention Image V3)
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);

            // Resize tanpa merusak rasio, lalu pasang di canvas 500x500 dengan background putih
            $image->scaleDown(500, 500);
            $canvas = $manager->create(500, 500)->fill('#ffffff');
            $canvas->place($image, 'center');

            // Kompres gambar ke kualitas 80
            $encoded = $canvas->encodeByExtension($file->getClientOriginalExtension(), quality: 80);

            // Simpan ke storage
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
     * (LOGIKA ASLI DIPERTAHANKAN)
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

            // 🧠 Image Processing V3
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

        Barang::where('uuid', $uuid)->firstOrFail()->update([
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
     * (LOGIKA ASLI DIPERTAHANKAN)
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
    
    // --- FITUR CETAK DATA (PDF) - DIPERBARUI ---
    public function printBarang(Request $request)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);

        $kategori = $request->input('kategori', 'all'); // master, bmn, all
        $ruangan = $request->input('ruangan', 'all');   // all, MCR, Studio 1, dll

        $collection = collect();

        // 1. Ambil Data Master
        if ($kategori == 'all' || $kategori == 'master') {
            $master = Barang::with('jenisBarang')->orderBy('nama_barang', 'ASC')->get();
            $collection = $collection->concat($master);
        }

        // 2. Ambil Data BMN
        if ($kategori == 'all' || $kategori == 'bmn') {
            $bmnQuery = BmnBarang::query();
            
            // Filter ruangan hanya jika kategori BMN dipilih secara spesifik
            if ($kategori == 'bmn' && $ruangan != 'all') {
                $bmnQuery->where('ruangan', $ruangan);
            }

            $bmn = $bmnQuery->orderBy('nama_barang', 'ASC')->get();
            $collection = $collection->concat($bmn);
        }

        if ($collection->isEmpty()) {
            notify()->error('Data barang tidak ditemukan untuk kriteria cetak ini.');
            return redirect()->back();
        }

        $data = [
            'barang' => $collection,
            'filter_info' => strtoupper($kategori) . ($kategori == 'bmn' ? ' - ' . strtoupper($ruangan) : ''),
        ];

        $pdf = Pdf::loadView('admin.barang.barang_pdf', $data)
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan-Barang-' . time() . '.pdf');
    }

    // --- FITUR CETAK QR (PDF) - DIPERBARUI ---
    public function printQrCode(Request $request)
    {
        ini_set('memory_limit', '-1');

        $kategori = $request->input('kategori', 'all');
        $ruangan = $request->input('ruangan', 'all');

        $collection = collect();

        // 1. Master
        if ($kategori == 'all' || $kategori == 'master') {
            $collection = $collection->concat(Barang::get());
        }

        // 2. BMN
        if ($kategori == 'all' || $kategori == 'bmn') {
            $query = BmnBarang::query();
            if ($kategori == 'bmn' && $ruangan != 'all') {
                $query->where('ruangan', $ruangan);
            }
            $collection = $collection->concat($query->get());
        }

        if ($collection->isEmpty()) {
            notify()->error('Data tidak ditemukan');
            return redirect()->back();
        }

        $data['barang'] = $collection;

        $pdf = Pdf::loadView('admin.barang.qrcode_pdf', $data)->setPaper('a4', 'potrait');
        return $pdf->stream('QRCode-Barang-' . time() . '.pdf');
    }

    // --- HELPER METHOD ---
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
}