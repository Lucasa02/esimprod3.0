<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BmnBarang;
use Illuminate\Http\Request;

class BmnController extends Controller
{
    /**
     * Menampilkan daftar barang berdasarkan ruangan.
     */
    public function index($ruangan)
    {
        $data = BmnBarang::where('ruangan', ucfirst($ruangan))->get();
        $title = 'Data BMN - ' . ucfirst($ruangan);

        return view('admin.bmn.index', compact('data', 'ruangan', 'title'));
    }

    /**
     * Menampilkan form tambah barang baru.
     */
    public function create($ruangan)
    {
        $title = 'Tambah Barang - ' . ucfirst($ruangan);
        return view('admin.bmn.create', compact('ruangan', 'title'));
    }

    /**
     * Menyimpan data barang baru ke database.
     */
    public function store(Request $request, $ruangan)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255|unique:bmn_barang,kode_barang',
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|string|max:255',
        ]);

        BmnBarang::create([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'kategori' => $request->kategori,
            'ruangan' => ucfirst($ruangan),
            'jumlah' => $request->jumlah,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
    ->route("bmn.{$ruangan}.index")
    ->with('success', 'Data berhasil ditambahkan.');

    }

    /**
     * Menampilkan form edit data barang.
     */
    public function edit($ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);
        $title = 'Edit Barang - ' . ucfirst($ruangan);

        return view('admin.bmn.edit', compact('barang', 'ruangan', 'title'));
        
    }

    /**
     * Memperbarui data barang.
     */
    public function update(Request $request, $ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => "required|string|max:255|unique:bmn_barang,kode_barang,{$barang->id}",
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|string|max:255',
        ]);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route("bmn.$ruangan.index")
            ->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Menghapus data barang.
     */
    public function destroy($ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);
        $barang->delete();

        return redirect()
            ->route("bmn.$ruangan.index")
            ->with('success', 'Data berhasil dihapus.');
    }
}
