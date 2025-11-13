<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Studio2Controller extends Controller
{
    /**
     * Menampilkan daftar barang di Studio 2
     */
    public function index()
    {

        $title = 'Daftar Peralatan Studio 2';
        // ✅ Ganti ruangan -> studio
        $barangs = Barang::where('studio', 'studio2')->get();

        $title = 'Daftar Peralatan Studio ';
        $barangs = Barang::where('studio', 'studio2')->get();

        $title = 'Daftar Peralatan Studio ';
        // Diperbaiki: Menggunakan kolom ''
        $barangs = Barang::where('ruangan', 'studio2')->get();


        return view('admin.studio2.index', compact('title', 'barangs'));
    }

    /**
     * Form tambah data
     */
    public function create()
    {
        $title = 'Tambah Data Peralatan Studio 2';
        return view('admin.studio2.create', compact('title'));
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'nullable|string|max:50',
            'merk' => 'nullable|string|max:100',
            'nomor_seri' => 'nullable|string|max:100',
            'jumlah' => 'nullable|integer',
            'kondisi' => 'nullable|integer',
            'tahun_pengadaan' => 'nullable|integer',
            'asal_pengadaan' => 'nullable|string|max:150',
            'catatan' => 'nullable|string',
            'status' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🔹 Generate kode unik jika kosong
        $kode_barang = $validated['kode_barang'] ?? strtoupper(Str::random(10));
        while (Barang::where('kode_barang', $kode_barang)->exists()) {
            $kode_barang = strtoupper(Str::random(10));
        }

        // 🔹 Upload foto (jika ada)
        $path = $request->file('foto') ? $request->file('foto')->store('barang', 'public') : null;

        // 🔹 Simpan data ke database
Barang::create([

    'uuid' => Str::uuid(),
    'nama_barang' => $validated['nama_barang'],
    'kode_barang' => $kode_barang,
    'merk' => $validated['merk'] ?? null,
    'nomor_seri' => $validated['nomor_seri'] ?? null,
    'jumlah' => $validated['jumlah'] ?? null,
    'kondisi' => $validated['kondisi'] ?? null,
    'tahun_pengadaan' => $validated['tahun_pengadaan'] ?? null,
    'asal_pengadaan' => $validated['asal_pengadaan'] ?? null,  // 🔹 ini penting
    'catatan' => $validated['catatan'] ?? null,
    'foto' => $path,
    'status' => $validated['status'],
    'studio' => $validated['studio'], // 🔹 ambil dari form
    'limit' => 1,
    'sisa_limit' => 1,
    'qr_code' => 'QR-' . $kode_barang,
]);

            Barang::create([
            'uuid' => Str::uuid(),
            'nama_barang' => $validated['nama_barang'],
            'kode_barang' => $validated['kode_barang'],
            'merk' => $validated['merk'] ?? null,
            'nomor_seri' => $validated['nomor_seri'] ?? null,
            'limit' => 1,
            'sisa_limit' => 1,
            'foto' => $path,
            'status' => $validated['status'],

            // ✅ Ganti ruangan -> studio
            'studio' => 'studio2', 

            // Diperbaiki: Menggunakan kolom '' saat membuat data baru
            'ruangan' => 'studio2', 

        ]);

        return redirect()->route('studio2.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Edit barang
     */
    public function edit($id)
    {
        $title = 'Edit Data Peralatan Studio 2';
        $barang = Barang::findOrFail($id);
        return view('admin.studio2.edit', compact('title', 'barang'));
    }

    /**
     * Update barang
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:50',
            'merk' => 'nullable|string|max:100',
            'nomor_seri' => 'nullable|string|max:100',
            'jumlah' => 'nullable|integer',
            'kondisi' => 'nullable|integer',
            'tahun_pengadaan' => 'nullable|integer',
            'asal_pengadaan' => 'nullable|string|max:150',
            'catatan' => 'nullable|string',
            'status' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🔹 Update foto bila ada
        if ($request->hasFile('foto')) {
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }
            $validated['foto'] = $request->file('foto')->store('barang', 'public');
        }

        // Tetapkan ruangan tetap studio2
        $validated['ruangan'] = 'studio2';

        $barang->update($validated);

        return redirect()->route('studio2.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Hapus barang
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        if ($barang->foto) Storage::disk('public')->delete($barang->foto);
        $barang->delete();
        return redirect()->route('studio2.index')->with('success', 'Data berhasil dihapus!');
    }

    /**
     * Detail barang
     */
    public function show($id)
    {
        $title = 'Detail Peralatan Studio 2';
        $barang = Barang::findOrFail($id);
        return view('admin.studio2.detail', compact('title', 'barang'));
    }

    /**
     * Cetak laporan
     */
    public function print()

    {
        


    $title = 'Laporan Data Peralatan Studio 2';

    // Gunakan kolom '' jika memang kolom 'studio' sudah tidak ada
    $barangs = Barang::where('ruangan', 'studio2')->get();

    return view('admin.studio2.print', compact('title', 'barangs'));
}




}

