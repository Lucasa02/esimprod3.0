<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Studio2Controller extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $title = 'Daftar Peralatan Studio ';
        $barangs = Barang::where('studio', 'studio2')->get();
=======
        $title = 'Daftar Peralatan Studio 2';
        // Diperbaiki: Menggunakan kolom 'ruangan'
        $barangs = Barang::where('ruangan', 'studio2')->get();
>>>>>>> 5b11ca64a7f2d1e4e690573ee3f3cb5617049c1e
        return view('admin.studio2.index', compact('title', 'barangs'));
    }

    public function create()
    {
        $title = 'Tambah Data Peralatan Studio';
        return view('admin.studio2.create', compact('title'));
    }

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
    'studio' => 'required|string',
]);


        // 🔹 Generate kode unik jika kosong
        $kode_barang = $validated['kode_barang'] ?? strtoupper(Str::random(10));

        // 🔹 Pastikan tidak duplikat
        while (Barang::where('kode_barang', $kode_barang)->exists()) {
            $kode_barang = strtoupper(Str::random(10));
        }

        // 🔹 Simpan foto jika ada
        $path = $request->file('foto') ? $request->file('foto')->store('barang', 'public') : null;

        // 🔹 Simpan data ke database
        Barang::create([
<<<<<<< HEAD
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
=======
            'uuid' => Str::uuid(),
            'nama_barang' => $validated['nama_barang'],
            'kode_barang' => $validated['kode_barang'],
            'merk' => $validated['merk'] ?? null,
            'nomor_seri' => $validated['nomor_seri'] ?? null,
            'limit' => 1,
            'sisa_limit' => 1,
            'foto' => $path,
            'status' => $validated['status'],
            // Diperbaiki: Menggunakan kolom 'ruangan' saat membuat data baru
            'ruangan' => 'studio2', 
        ]);
>>>>>>> 5b11ca64a7f2d1e4e690573ee3f3cb5617049c1e

        return redirect()->route('studio2.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $title = 'Edit Data Peralatan Studio 2';
        $barang = Barang::findOrFail($id);
        return view('admin.studio2.edit', compact('title', 'barang'));
    }

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
            'studio' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🔹 Update foto bila ada
        if ($request->hasFile('foto')) {
            if ($barang->foto) Storage::delete('public/' . $barang->foto);
            $validated['foto'] = $request->file('foto')->store('barang', 'public');
        }

        $barang->update($validated);

        return redirect()->route('studio2.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        if ($barang->foto) Storage::delete('public/' . $barang->foto);
        $barang->delete();
        return redirect()->route('studio2.index')->with('success', 'Data berhasil dihapus!');
    }

    public function show($id)
    {
        $title = 'Detail Peralatan Studio 2';
        $barang = Barang::findOrFail($id);
        return view('admin.studio2.detail', compact('title', 'barang'));
    }

    public function print()
    {
        $title = 'Laporan Data Peralatan Studio 2';
<<<<<<< HEAD
        $barangs = Barang::where('studio', 'studio2')->get();
        return view('admin.studio2.print', compact('title', 'barangs'));
    }
=======
        // Diperbaiki: Menggunakan kolom 'ruangan'
        $barangs = \App\Models\Barang::where('ruangan', 'studio2')->get();

        return view('admin.studio2.print', compact('title', 'barangs'));
    }

>>>>>>> 5b11ca64a7f2d1e4e690573ee3f3cb5617049c1e
}
