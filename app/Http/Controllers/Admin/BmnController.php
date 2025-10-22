<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BmnBarang;
use Illuminate\Http\Request;

class BmnController extends Controller
{
    private function tentukanKondisi($persentase)
    {
        if ($persentase >= 90) return 'Sangat Baik';
        if ($persentase >= 70) return 'Baik';
        if ($persentase >= 50) return 'Kurang Baik';
        return 'Rusak / Cacat';
    }

    public function index(Request $request, $ruangan)
    {
        $keyword = $request->input('q') ?? $request->input('search');
        $data = BmnBarang::where('ruangan', ucfirst($ruangan))
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama_barang', 'like', "%{$keyword}%")
                      ->orWhere('kode_barang', 'like', "%{$keyword}%")
                      ->orWhere('kategori', 'like', "%{$keyword}%")
                      ->orWhere('merk', 'like', "%{$keyword}%")
                      ->orWhere('nomor_seri', 'like', "%{$keyword}%");
            })
            ->orderBy('nama_barang')
            ->paginate(10)
            ->appends($request->all());

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
        $tableName = (new BmnBarang)->getTable();

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => "required|string|max:255|unique:{$tableName},kode_barang",
            'kategori' => 'required|string|max:255',
            'merk' => 'nullable|string|max:255',
            'nomor_seri' => 'nullable|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'persentase_kondisi' => 'required|numeric|min:0|max:100',
            'tahun_pengadaan' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'catatan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = $request->hasFile('foto')
            ? $request->file('foto')->store('uploads/bmn', 'public')
            : null;

        $kondisi = $this->tentukanKondisi($request->persentase_kondisi);

        BmnBarang::create([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'kategori' => $request->kategori,
            'merk' => $request->merk,
            'nomor_seri' => $request->nomor_seri,
            'ruangan' => ucfirst($ruangan),
            'jumlah' => $request->jumlah,
            'persentase_kondisi' => $request->persentase_kondisi,
            'kondisi' => $kondisi,
            'foto' => $fotoPath,
            'tahun_pengadaan' => $request->tahun_pengadaan,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('bmn.index', $ruangan)->with('success', 'Data berhasil ditambahkan.');
    }

    public function show($ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);
        $title = 'Detail Barang - ' . ucfirst($ruangan);
        return view('admin.bmn.show', compact('barang', 'ruangan', 'title'));
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
        $tableName = (new BmnBarang)->getTable();

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => "required|string|max:255|unique:{$tableName},kode_barang,{$barang->id}",
            'kategori' => 'required|string|max:255',
            'merk' => 'nullable|string|max:255',
            'nomor_seri' => 'nullable|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'persentase_kondisi' => 'required|numeric|min:0|max:100',
            'tahun_pengadaan' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'catatan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = $barang->foto;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads/bmn', 'public');
        }

        $kondisi = $this->tentukanKondisi($request->persentase_kondisi);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'kategori' => $request->kategori,
            'merk' => $request->merk,
            'nomor_seri' => $request->nomor_seri,
            'jumlah' => $request->jumlah,
            'persentase_kondisi' => $request->persentase_kondisi,
            'kondisi' => $kondisi,
            'foto' => $fotoPath,
            'tahun_pengadaan' => $request->tahun_pengadaan,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('bmn.index', $ruangan)->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);
        $barang->delete();

        return redirect()->route('bmn.index', $ruangan)->with('success', 'Data berhasil dihapus.');
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
                $query->where('nama_barang', 'like', "%{$keyword}%")
                      ->orWhere('kode_barang', 'like', "%{$keyword}%")
                      ->orWhere('kategori', 'like', "%{$keyword}%")
                      ->orWhere('merk', 'like', "%{$keyword}%")
                      ->orWhere('nomor_seri', 'like', "%{$keyword}%");
            })
            ->orderBy('nama_barang', 'asc')
            ->paginate(10)
            ->appends($request->all());

        $title = 'Hasil Pencarian BMN - ' . ucfirst($ruangan);
        return view('admin.bmn.index', compact('data', 'ruangan', 'title', 'keyword'));
    }
}
