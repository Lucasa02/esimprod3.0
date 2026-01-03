<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BmnBarang;
use App\Models\BmnRuangan;
use App\Models\BmnKategori;
use App\Models\BmnJenisKerusakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\PerawatanInventaris;
class BmnController extends Controller
{
    private function tentukanKondisi($persentase)
    {
        if ($persentase >= 90) return 'Sangat Baik';
        if ($persentase >= 70) return 'Baik';
        if ($persentase >= 50) return 'Kurang Baik';
        return 'Rusak / Cacat';
    }

    private function generateUniqueKode()
    {
        $prefix = 'BRG';
        $year = Carbon::now()->format('Y');

        $last = BmnBarang::where('kode_barang', 'like', "{$prefix}-{$year}-%")
            ->orderBy('kode_barang', 'desc')
            ->first();

        $next = $last ? intval(substr($last->kode_barang, -4)) + 1 : 1;

        return sprintf("%s-%s-%04d", $prefix, $year, $next);
    }

    public function ruanganIndex()
    {
        $ruangan = BmnRuangan::orderBy('nama_ruangan', 'asc')->paginate(10);
        $title = 'Ruangan BMN';
        return view('admin.bmn.ruangan.index', compact('ruangan', 'title'));
    }

    public function ruanganStore(Request $request)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required|unique:bmn_ruangans,nama_ruangan',
        ]);

        $validated['uuid'] = Str::uuid();
        BmnRuangan::create($validated);

        return redirect()->back()->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function ruanganEdit($uuid)
    {
        $ruangan = BmnRuangan::where('uuid', $uuid)->firstOrFail();
        return response()->json($ruangan);
    }

    public function ruanganUpdate(Request $request, $uuid)
    {
        $ruangan = BmnRuangan::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'nama_ruangan' => 'required|unique:bmn_ruangans,nama_ruangan,' . $ruangan->id,
        ]);

        $ruangan->update(['nama_ruangan' => $request->nama_ruangan]);

        return response()->json(['success' => true]);
    }

    public function ruanganDestroy($uuid)
    {
        BmnRuangan::where('uuid', $uuid)->delete();
        return redirect()->back()->with('success', 'Ruangan berhasil dihapus.');
    }

    public function ruanganSearch(Request $request)
    {
        $keyword = $request->search;
        $ruangan = BmnRuangan::where('nama_ruangan', 'like', "%{$keyword}%")
            ->paginate(10);
        $title = 'Hasil Pencarian Ruangan';
        return view('admin.bmn.ruangan.index', compact('ruangan', 'title'));
    }

    public function kategoriIndex()
    {
        $kategori = BmnKategori::orderBy('nama_kategori', 'asc')->paginate(10);
        $title = 'Kategori BMN';
        return view('admin.bmn.kategori.index', compact('kategori', 'title'));
    }

    public function kategoriStore(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|unique:bmn_kategoris,nama_kategori',
        ]);

        $validated['uuid'] = Str::uuid();
        BmnKategori::create($validated);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function kategoriEdit($uuid)
    {
        $kategori = BmnKategori::where('uuid', $uuid)->firstOrFail();
        return response()->json($kategori);
    }

    public function kategoriUpdate(Request $request, $uuid)
    {
        $kategori = BmnKategori::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'nama_kategori' => 'required|unique:bmn_kategoris,nama_kategori,' . $kategori->id,
        ]);

        $kategori->update(['nama_kategori' => $request->nama_kategori]);

        return response()->json(['success' => true]);
    }

    public function kategoriDestroy($uuid)
    {
        BmnKategori::where('uuid', $uuid)->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }

    public function kategoriSearch(Request $request)
    {
        $keyword = $request->search;
        $kategori = BmnKategori::where('nama_kategori', 'like', "%{$keyword}%")
            ->paginate(10);
        $title = 'Hasil Pencarian Kategori';
        return view('admin.bmn.kategori.index', compact('kategori', 'title'));
    }

    public function jenisKerusakanIndex()
    {
        $jenis_kerusakan = BmnJenisKerusakan::orderBy('nama_jenis_kerusakan', 'asc')->paginate(10);
        $title = 'Jenis Kerusakan BMN';
        return view('admin.bmn.jenis_kerusakan.index', compact('jenis_kerusakan', 'title'));
    }

    public function jenisKerusakanStore(Request $request)
    {
        $request->validate([
            'nama_jenis_kerusakan' => 'required|unique:bmn_jenis_kerusakans,nama_jenis_kerusakan',
        ]);

        BmnJenisKerusakan::create([
            'nama_jenis_kerusakan' => $request->nama_jenis_kerusakan
        ]);

        return redirect()->back()->with('success', 'Jenis kerusakan berhasil ditambahkan.');
    }

    public function jenisKerusakanEdit($uuid)
    {
        $data = BmnJenisKerusakan::where('uuid', $uuid)->firstOrFail();
        return response()->json($data);
    }

    public function jenisKerusakanUpdate(Request $request, $uuid)
    {
        $data = BmnJenisKerusakan::where('uuid', $uuid)->firstOrFail();
        $request->validate([
            'nama_jenis_kerusakan' => 'required|unique:bmn_jenis_kerusakans,nama_jenis_kerusakan,' . $data->id,
        ]);

        $data->update(['nama_jenis_kerusakan' => $request->nama_jenis_kerusakan]);
        return response()->json(['success' => true]);
    }

    public function jenisKerusakanDestroy($uuid)
    {
        BmnJenisKerusakan::where('uuid', $uuid)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function jenisKerusakanSearch(Request $request)
    {
        $keyword = $request->search;
        $jenis_kerusakan = BmnJenisKerusakan::where('nama_jenis_kerusakan', 'like', "%{$keyword}%")
            ->paginate(10);
        $title = 'Hasil Pencarian Jenis Kerusakan';
        return view('admin.bmn.jenis_kerusakan.index', compact('jenis_kerusakan', 'title'));
    }

    public function index(Request $request, $ruangan)
    {
        $keyword = $request->input('q') ?? $request->input('search');

        // Ambil data ruangan untuk dropdown di modal cetak
        $list_ruangan = BmnRuangan::orderBy('nama_ruangan', 'asc')->get();

        $data = BmnBarang::with([
            'perawatan' => function ($q) {
                $q->whereIn('status', ['pending', 'proses'])
                    ->orderBy('tanggal_perawatan', 'desc');
            },
            'perawatanAktif'
        ])
            ->where('ruangan', 'LIKE', ucfirst($ruangan) . '%')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama_barang', 'like', "%{$keyword}%")
                        ->orWhere('kode_barang', 'like', "%{$keyword}%")
                        ->orWhere('nup', 'like', "%{$keyword}%")
                        ->orWhere('kategori', 'like', "%{$keyword}%")
                        ->orWhere('merk', 'like', "%{$keyword}%")
                        ->orWhere('asal_pengadaan', 'like', "%{$keyword}%")
                        ->orWhere('peruntukan', 'like', "%{$keyword}%")
                        ->orWhere('kondisi', 'like', "%{$keyword}%");
                });
            })
            ->orderBy('nama_barang')
            ->paginate(20);

        $title = 'Data BMN - ' . ucfirst($ruangan);

        // Tambahkan 'list_ruangan' ke compact
        return view('admin.bmn.index', compact('data', 'ruangan', 'title', 'keyword', 'list_ruangan'));
    }

    public function create($ruangan)
    {
        // Mengambil semua data ruangan dan kategori dari database
        $ruangans = BmnRuangan::orderBy('nama_ruangan', 'asc')->get();
        $kategoris = BmnKategori::orderBy('nama_kategori', 'asc')->get();

        if ($ruangan == 'general') {
            $title = 'Tambah Barang BMN';
        } else {
            $title = 'Tambah Barang - ' . ucfirst($ruangan);
        }

        // Kirim data ke view
        return view('admin.bmn.create', compact('ruangan', 'title', 'ruangans', 'kategoris'));
    }

    public function store(Request $request, $ruangan)
    {
        $rules = [
            'nama_barang'        => 'required',
            'nup'                => 'required|string|max:255|unique:bmn_barangs',
            'kode_barang'        => 'nullable|string|max:255|unique:bmn_barangs',
            'kategori'           => 'required',
            'merk'               => 'nullable',
            'nomor_seri'         => 'nullable',
            'jumlah'             => 'required|integer|min:1',
            'persentase_kondisi' => 'required|numeric|min:0|max:100',
            'tanggal_perolehan'  => 'nullable|date', // Diubah dari tahun_pengadaan (digits:4)
            'nilai_perolehan'    => 'nullable|numeric|min:0', // Field baru
            'asal_pengadaan'     => 'nullable',
            'catatan'            => 'nullable',
            'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'posisi'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        if ($ruangan == 'general') {
            $rules['ruangan_pilihan'] = 'required|exists:bmn_ruangans,nama_ruangan';
        }

        $validated = $request->validate($rules);

        // LOGIKA LOKASI DISERDAHANAKAN
        if ($ruangan == 'general') {
            $finalRuangan = $validated['ruangan_pilihan'];
        } else {
            $finalRuangan = ucfirst($ruangan);
        }

        $validated['kode_barang'] = $validated['kode_barang'] ?? $this->generateUniqueKode();
        $validated['uuid']        = Str::uuid();
        $validated['ruangan']     = $finalRuangan;
        $validated['kondisi']     = $this->tentukanKondisi($validated['persentase_kondisi']);

        $manager = new ImageManager(new Driver());

        // ... (Kode upload foto, posisi, dan QR Code tetap sama, tidak berubah) ...
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $name = time() . "_barang." . $file->getClientOriginalExtension();
            $img = $manager->read($file)->scaleDown(800, 800);
            $canvas = $manager->create(800, 800)->fill('#ffffff')->place($img, 'center');
            $path = 'bmn/foto/' . $name;
            Storage::disk('public')->put($path, $canvas->encodeByExtension($file->getClientOriginalExtension(), quality: 80));
            $validated['foto'] = $path;
        }

        if ($request->hasFile('posisi')) {
            $file   = $request->file('posisi');
            $name   = time() . "_posisi." . $file->getClientOriginalExtension();
            $img    = $manager->read($file)->scaleDown(800, 800);
            $canvas = $manager->create(800, 800)->fill('#ffffff')->place($img, 'center');
            $path = 'bmn/posisi/' . $name;
            Storage::disk('public')->put($path, $canvas->encodeByExtension($file->getClientOriginalExtension(), quality: 80));
            $validated['posisi'] = $path;
        }

        $qrName = 'qr_' . $validated['kode_barang'] . '.png';
        $qrPath = 'bmn/qrcode/' . $qrName;
        $scanUrl = route('user.inventaris.scan', $validated['kode_barang']);
        QrCode::format('png')->size(300)->margin(2)
            ->generate($scanUrl, Storage::disk('public')->path($qrPath));
        $validated['qr_code'] = $qrPath;

        BmnBarang::create($validated);

        // Redirect: Jika Studio 1, kita ambil kata pertamanya saja untuk redirect ke index umum "studio"
        $redirectRuangan = Str::startsWith($finalRuangan, 'Studio') ? 'studio' : strtolower($finalRuangan);

        return redirect()->route('barang.bmn_index')
            ->with('success', 'Barang berhasil ditambahkan ke ' . $finalRuangan);
    }

    public function show($ruangan, $id)
    {
    // Eager load perawatan yang statusnya pending atau proses
    $barang = BmnBarang::with(['perawatan' => function($q){
    $q->whereIn('status', ['proses', 'pending'])->orderBy('tanggal_perawatan', 'desc');
    }])->findOrFail($id);


    $title = 'Detail Barang - ' . ucfirst($ruangan);


    // Ambil perawatan aktif (jika ada) — gunakan koleksi dari relasi yang sudah eager-loaded
    $perawatan = $barang->perawatan->first(); // null jika tidak ada

    return view('admin.bmn.show', compact('barang', 'ruangan', 'title','perawatan'));
    }

    public function edit($ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);

        // Tambahkan pengambilan data ini agar dropdown berfungsi
        $ruangans = BmnRuangan::orderBy('nama_ruangan', 'asc')->get();
        $kategoris = BmnKategori::orderBy('nama_kategori', 'asc')->get();

        $title = 'Edit Barang - ' . ucfirst($ruangan);

        // Kirimkan data tambahan ke view
        return view('admin.bmn.edit', compact('barang', 'ruangan', 'title', 'ruangans', 'kategoris'));
    }

    public function update(Request $request, $ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);

        $validated = $request->validate([
            'nama_barang'        => 'required',
            'nup'                => 'required|string|max:255|unique:bmn_barangs,nup,' . $barang->id,
            'kode_barang'        => 'required|string|max:255|unique:bmn_barangs,kode_barang,' . $barang->id,
            'kategori'           => 'required',
            'jumlah'             => 'required|integer|min:1',
            'persentase_kondisi' => 'required|numeric|min:0|max:100',
            'tanggal_perolehan'  => 'nullable|date', // Tambahkan ini
            'nilai_perolehan'    => 'nullable|numeric|min:0', // Tambahkan ini
            'ruangan_pilihan'    => 'required',
            'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'posisi'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // LANGSUNG AMBIL DARI PILIHAN
        $validated['ruangan'] = $request->ruangan_pilihan;
        $validated['kondisi'] = $this->tentukanKondisi($validated['persentase_kondisi']);

        $manager = new ImageManager(new Driver());

        // UPDATE FOTO BARANG
        if ($request->hasFile('foto')) {
            if ($barang->foto) Storage::disk('public')->delete($barang->foto);

            $file = $request->file('foto');
            $name = time() . "_barang." . $file->getClientOriginalExtension();

            $img = $manager->read($file)->scaleDown(800, 800);
            $canvas = $manager->create(800, 800)->fill('#ffffff')->place($img, 'center');

            $path = 'bmn/foto/' . $name;
            Storage::disk('public')->put($path, $canvas->encodeByExtension($file->getClientOriginalExtension(), quality: 80));

            $validated['foto'] = $path;
        }

        // UPDATE FOTO POSISI (kolom: posisi)
        if ($request->hasFile('posisi')) {
            if ($barang->posisi) Storage::disk('public')->delete($barang->posisi);

            $file = $request->file('posisi');
            $name = time() . "_posisi." . $file->getClientOriginalExtension();

            $img = $manager->read($file)->scaleDown(800, 800);
            $canvas = $manager->create(800, 800)->fill('#ffffff')->place($img, 'center');

            $path = 'bmn/posisi/' . $name;
            Storage::disk('public')->put($path, $canvas->encodeByExtension($file->getClientOriginalExtension(), quality: 80));

            $validated['posisi'] = $path;
        }
        if ($request->hasFile('foto') || $request->hasFile('posisi') || $request->kode_barang !== $barang->kode_barang) {

        if ($barang->qr_code) Storage::disk('public')->delete($barang->qr_code);

        $qrName = 'qr_' . $validated['kode_barang'] . '.png';
        $qrPath = 'bmn/qrcode/' . $qrName;
        $scanUrl = route('user.inventaris.scan', $validated['kode_barang']);

        QrCode::format('png')->size(300)->margin(2)
            ->generate($scanUrl, Storage::disk('public')->path($qrPath));

        $validated['qr_code'] = $qrPath;
    }

        $barang->update($validated);

        return redirect()->route('barang.bmn_index')
            ->with('success', 'Data barang BMN berhasil diperbarui.');
    }

    public function destroy($ruangan, $id)
    {
    $barang = BmnBarang::findOrFail($id);


    if ($barang->foto && Storage::disk('public')->exists($barang->foto)) {
    Storage::disk('public')->delete($barang->foto);
    }
    if ($barang->posisi && Storage::disk('public')->exists($barang->posisi)) {
    Storage::disk('public')->delete($barang->posisi);
    }
    if ($barang->qr_code && Storage::disk('public')->exists($barang->qr_code)) {
    Storage::disk('public')->delete($barang->qr_code);
    }

    $barang->delete();

    return redirect()->route('barang.bmn_index', $ruangan)
    ->with('success', 'Barang berhasil dihapus.');
    }

    public function print($ruangan)
    {
        $data = BmnBarang::where('ruangan', 'like', ucfirst($ruangan) . '%')
            ->orderBy('nama_barang')
            ->get();

        $title = 'Cetak Data BMN - ' . ucfirst($ruangan);
        return view('admin.bmn.print', compact('data', 'ruangan', 'title'));
    }

    public function search(Request $request, $ruangan)
    {
        $keyword = $request->input('search');

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
            ->orderBy('nama_barang', 'asc')
            ->paginate(10)
            ->appends($request->all());

        $title = 'Hasil Pencarian BMN - ' . ucfirst($ruangan);

        return view('admin.bmn.index', compact('data', 'ruangan', 'title', 'keyword'));
    }

    public function showFilterForm($ruangan)
    {
        $kategoriList = BmnBarang::select('kategori')->distinct()->pluck('kategori');
        $asalList = BmnBarang::select('asal_pengadaan')->distinct()->pluck('asal_pengadaan');
        $posisiList = BmnBarang::select('posisi')->distinct()->pluck('posisi');
        $tahunList = BmnBarang::select('tahun_pengadaan')->distinct()->orderBy('tahun_pengadaan', 'desc')->pluck('tahun_pengadaan');

        return view('admin.bmn.filter_form', compact('ruangan', 'kategoriList', 'asalList', 'posisiList', 'tahunList'));
    }

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

    /** 🔥 Download QR ALL Barang */
public function downloadQRAll()
{
    $url = route('user.inventaris.index');

    // Buat QR PNG
    $qr = QrCode::format('png')
        ->size(400)
        ->errorCorrection('H')
        ->generate($url);

    $filename = 'QR-ALL-INVENTARIS.png';

    return response($qr)
        ->header('Content-Type', 'image/png')
        ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
}
}