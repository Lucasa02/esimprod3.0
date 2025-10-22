<?php

namespace App\Http\Controllers\Admin;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\BmnBarang;

class BmnController extends Controller
{
    /**
     * Menentukan kondisi berdasarkan persentase kondisi.
     */
    private function tentukanKondisi($persentase)
    {
        if ($persentase >= 90) {
            return 'Sangat Baik';
        } elseif ($persentase >= 70) {
            return 'Baik';
        } elseif ($persentase >= 50) {
            return 'Kurang Baik / Cacat';
        } else {
            return 'Rusak';
        }
    }

    /**
     * Menampilkan daftar barang per ruangan.
     */
    public function index($ruangan)
    {
        $data = BmnBarang::where('ruangan', $ruangan)->paginate(10);

        return view('admin.bmn.index', [
            'title'   => 'Data Barang - ' . ucfirst($ruangan),
            'ruangan' => $ruangan,
            'data'    => $data,
        ]);
    }

    /**
     * Form tambah barang.
     */
    public function create($ruangan)
    {
        return view('admin.bmn.create', [
            'title'   => 'Tambah Barang - ' . ucfirst($ruangan),
            'ruangan' => $ruangan,
        ]);
    }

    /**
     * Simpan barang baru ke database.
     */
    public function store(Request $request, $ruangan)
    {
        $validated = $request->validate([
            'nama_barang'        => 'required|string|max:255',
            'kode_barang'        => 'required|string|max:255|unique:bmn_barangs',
            'nomor_seri'         => 'nullable|string|max:255',
            'merk'               => 'nullable|string|max:255',
            'tahun_pengadaan'    => 'nullable|integer',
            'asal_pengadaan'     => 'nullable|string|max:255',   // ✅ tambahan validasi
            'peruntukan'         => 'nullable|string|max:255',   // ✅ tambahan validasi
            'kategori'           => 'required|string|max:255',
            'jumlah'             => 'required|integer|min:1',
            'persentase_kondisi' => 'required|numeric|min:0|max:100',
            'catatan'            => 'nullable|string',
            'foto'               => 'nullable|image|max:2048',
        ]);

        $validated['ruangan'] = $ruangan;
        $validated['uuid'] = Str::uuid();
        $validated['kondisi'] = $this->tentukanKondisi($validated['persentase_kondisi']);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('bmn/foto', 'public');
        }

        // === Generate QR Code otomatis ===
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
        // ================================

        BmnBarang::create($validated);

        return redirect()->route('bmn.index', $ruangan)
                         ->with('success', 'Barang berhasil ditambahkan dengan QR Code otomatis.');
    }

    /**
     * Tampilkan detail barang.
     */
    public function show($ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);

        return view('admin.bmn.show', [
            'title'   => 'Detail Barang - ' . ucfirst($ruangan),
            'ruangan' => $ruangan,
            'barang'  => $barang,
        ]);
    }

    /**
     * Form edit barang.
     */
    public function edit($ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);

        return view('admin.bmn.edit', [
            'title'   => 'Edit Barang - ' . ucfirst($ruangan),
            'ruangan' => $ruangan,
            'barang'  => $barang,
        ]);
    }

    /**
     * Update barang.
     */
    public function update(Request $request, $ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);

        $validated = $request->validate([
            'nama_barang'        => 'required|string|max:255',
            'kode_barang'        => 'required|string|max:255|unique:bmn_barangs,kode_barang,' . $barang->id,
            'nomor_seri'         => 'nullable|string|max:255',
            'merk'               => 'nullable|string|max:255',
            'tahun_pengadaan'    => 'nullable|integer',
            'asal_pengadaan'     => 'nullable|string|max:255',   // ✅ tambahan validasi
            'peruntukan'         => 'nullable|string|max:255',   // ✅ tambahan validasi
            'kategori'           => 'required|string|max:255',
            'jumlah'             => 'required|integer|min:1',
            'persentase_kondisi' => 'required|numeric|min:0|max:100',
            'catatan'            => 'nullable|string',
            'foto'               => 'nullable|image|max:2048',
            'qr_code'            => 'nullable|image|max:2048',
        ]);

        // Tentukan kondisi otomatis
        $validated['kondisi'] = $this->tentukanKondisi($validated['persentase_kondisi']);

        // Ganti foto jika upload baru
        if ($request->hasFile('foto')) {
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }
            $validated['foto'] = $request->file('foto')->store('bmn/foto', 'public');
        }

        // Ganti QR Code jika upload baru
        if ($request->hasFile('qr_code')) {
            if ($barang->qr_code) {
                Storage::disk('public')->delete($barang->qr_code);
            }
            $validated['qr_code'] = $request->file('qr_code')->store('bmn/qrcode', 'public');
        }

        $barang->update($validated);

        return redirect()->route('bmn.show', [$ruangan, $barang->id])
                         ->with('success', 'Data barang berhasil diperbarui.');
    }

    /**
     * Hapus barang.
     */
    public function destroy($ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);

        // Hapus file foto dan QR jika ada
        if ($barang->foto) {
            Storage::disk('public')->delete($barang->foto);
        }
        if ($barang->qr_code) {
            Storage::disk('public')->delete($barang->qr_code);
        }

        $barang->delete();

        return redirect()->route('bmn.index', $ruangan)
                         ->with('success', 'Barang berhasil dihapus.');
    }

    /**
     * Cetak / Preview Barang.
     */
    public function print($ruangan, $id)
    {
        $barang = BmnBarang::findOrFail($id);

        return view('admin.bmn.print', [
            'title'   => 'Cetak Barang - ' . ucfirst($ruangan),
            'ruangan' => $ruangan,
            'barang'  => $barang,
        ]);
    }
}
