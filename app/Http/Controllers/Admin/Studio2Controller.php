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
        $title = 'Daftar Peralatan Studio 2';
        // Diperbaiki: Menggunakan kolom 'ruangan'
        $barangs = Barang::where('ruangan', 'studio2')->get();
        return view('admin.studio2.index', compact('title', 'barangs'));
    }

    public function create()
    {
        $title = 'Tambah Data Peralatan Studio 2';
        return view('admin.studio2.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:50',
            'merk' => 'nullable|string|max:100',
            'nomor_seri' => 'nullable|string|max:100',
            'jumlah' => 'nullable|integer',
            'kondisi' => 'nullable|integer',
            'tahun_pengadaan' => 'nullable|integer',
            'catatan' => 'nullable|string',
            'status' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('foto') ? $request->file('foto')->store('barang', 'public') : null;

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
            // Diperbaiki: Menggunakan kolom 'ruangan' saat membuat data baru
            'ruangan' => 'studio2', 
        ]);

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
            'catatan' => 'nullable|string',
            'status' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

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
        // Diperbaiki: Menggunakan kolom 'ruangan'
        $barangs = \App\Models\Barang::where('ruangan', 'studio2')->get();

        return view('admin.studio2.print', compact('title', 'barangs'));
    }

}
