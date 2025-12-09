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

   public function index(Request $request, $ruangan)
{
    $keyword = $request->input('q') ?? $request->input('search');

    $data = BmnBarang::with([
        'perawatan' => function($q){
            $q->whereIn('status', ['pending', 'proses'])
              ->orderBy('tanggal_perawatan', 'desc');
        },
        'perawatanAktif'
    ])
    ->where('ruangan', ucfirst($ruangan))
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

    return view('admin.bmn.index', compact('data', 'ruangan', 'title', 'keyword'));
}



    public function create($ruangan)
    {
        $title = 'Tambah Barang - ' . ucfirst($ruangan);
        return view('admin.bmn.create', compact('ruangan', 'title'));
    }

    public function store(Request $request, $ruangan)
    {
        $validated = $request->validate([
            'nama_barang'        => 'required',
            'nup'                => 'required|string|max:255|unique:bmn_barangs',
            'kode_barang'        => 'nullable|string|max:255|unique:bmn_barangs',
            'kategori'           => 'required',
            'merk'               => 'nullable',
            'nomor_seri'         => 'nullable',
            'jumlah'             => 'required|integer|min:1',
            'persentase_kondisi' => 'required|numeric|min:0|max:100',
            'tahun_pengadaan'    => 'nullable|digits:4',
            'asal_pengadaan'     => 'nullable',
            'peruntukan'         => 'nullable',
            'catatan'            => 'nullable',
            // FOTO BARANG
            'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            // FOTO POSISI (nama input tetap posisi_foto)
            'posisi'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['kode_barang'] = $validated['kode_barang'] ?? $this->generateUniqueKode();
        $validated['uuid'] = Str::uuid();
        $validated['ruangan'] = ucfirst($ruangan);
        $validated['kondisi'] = $this->tentukanKondisi($validated['persentase_kondisi']);

        $manager = new ImageManager(new Driver());

        // =====================
        // UPLOAD FOTO BARANG
        // =====================
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $name = time() . "_barang." . $file->getClientOriginalExtension();

            $img = $manager->read($file)->scaleDown(800, 800);
            $canvas = $manager->create(800, 800)->fill('#ffffff')->place($img, 'center');

            $path = 'bmn/foto/' . $name;
            Storage::disk('public')->put($path, $canvas->encodeByExtension($file->getClientOriginalExtension(), quality: 80));

            $validated['foto'] = $path;
        }

        // =====================
        // UPLOAD FOTO POSISI (disimpan ke kolom: posisi)
        // =====================
        if ($request->hasFile('posisi')) {
            $file   = $request->file('posisi');
            $name   = time() . "_posisi." . $file->getClientOriginalExtension();

            $img    = $manager->read($file)->scaleDown(800, 800);
            $canvas = $manager->create(800, 800)->fill('#ffffff')->place($img, 'center');

            $path = 'bmn/posisi/' . $name;
            Storage::disk('public')->put($path, $canvas->encodeByExtension($file->getClientOriginalExtension(), quality: 80));

            $validated['posisi'] = $path;
        }

        // =====================
        // QR CODE
        // =====================
        $qrName = 'qr_' . $validated['kode_barang'] . '.png';
        $qrPath = 'bmn/qrcode/' . $qrName;

        QrCode::format('png')->size(300)->margin(2)
            ->generate($validated['kode_barang'], Storage::disk('public')->path($qrPath));

        $validated['qr_code'] = $qrPath;

        BmnBarang::create($validated);

        return redirect()->route('bmn.index', $ruangan)
            ->with('success', 'Barang berhasil ditambahkan.');
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
        $title = 'Edit Barang - ' . ucfirst($ruangan);
        return view('admin.bmn.edit', compact('barang', 'ruangan', 'title'));
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

            'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // posisi tetap file foto
            'posisi'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

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

        $barang->update($validated);

        return redirect()->route('bmn.index', $ruangan)
            ->with('success', 'Data barang berhasil diperbarui.');
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


return redirect()->route('bmn.index', $ruangan)
->with('success', 'Barang berhasil dihapus.');
}

    public function print($ruangan)
    {
        $data = BmnBarang::where('ruangan', ucfirst($ruangan))
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
}

