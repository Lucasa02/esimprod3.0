<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerawatanInventaris;
use App\Models\BmnBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PerawatanInventarisController extends Controller
{
    // ==============================
    // LIST PERAWATAN
    // ==============================
    public function index()
    {
        $data = PerawatanInventaris::with('barang')
            ->where('jenis_perawatan', 'perbaikan')   // hanya perbaikan
            ->latest()
            ->get();

        $title = "Perawatan Inventaris";
        return view('admin.perawatan_inventaris.index', compact('data', 'title'));
    }

    // ==============================
    // DETAIL PERAWATAN
    // ==============================
    public function detail($id)
    {
        $data = PerawatanInventaris::with('barang')->findOrFail($id);
        $title = "Detail Perbaikan Barang";

        return view('admin.perawatan_inventaris.detail', compact('data', 'title'));
    }

    // ==============================
    // CEGAH INPUT GANDA
    // ==============================
    private function cekBarangSudahDiproses($barang_id)
    {
        return PerawatanInventaris::where('barang_id', $barang_id)
            ->whereIn('status', ['pending','proses']) // belum selesai
            ->exists();
    }

    // ==============================
    // MASUKKAN KE PERBAIKAN (dari halaman detail barang)
    // ==============================
    public function storeFromBarang($barang_id)
    {
        if ($this->cekBarangSudahDiproses($barang_id)) {
            return back()->with('error', 'Barang ini sudah masuk proses perawatan atau penghapusan!');
        }

        PerawatanInventaris::create([
            'uuid' => Str::uuid(),
            'barang_id' => $barang_id,
            'tanggal_perawatan' => now(),
            'jenis_perawatan' => 'perbaikan',
            'status' => 'proses',
        ]);

        return back()->with('success', 'Barang berhasil dimasukkan ke perawatan.');
    }

    // ==============================
    // FORM UNTUK MEMULAI / MENGUPDATE PERBAIKAN
    // GET -> tampilkan form
    // ==============================
    public function perbaikiForm($id)
    {
        $data = PerawatanInventaris::with('barang')->findOrFail($id);
        $title = "Mulai / Edit Perbaikan";
        return view('admin.perawatan_inventaris.perbaiki', compact('data', 'title'));
    }

    // ==============================
    // SUBMIT PERBAIKAN (simpan perubahan & set status proses)
    // POST
    // ==============================
    public function perbaikiSubmit(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'nullable|string',
            'estimasi_biaya' => 'nullable|numeric',
            'foto_kerusakan' => 'nullable|image|max:4096'
        ]);

        $p = PerawatanInventaris::findOrFail($id);

        // simpan foto kerusakan (opsional)
        if ($request->hasFile('foto_kerusakan')) {
            // hapus file lama jika ada
            if ($p->foto_kerusakan ?? false) {
                Storage::disk('public')->delete($p->foto_kerusakan);
            }
            $path = $request->file('foto_kerusakan')->store('perawatan/kerusakan', 'public');
            $p->foto_kerusakan = $path;
        }

        // update fields
        $p->deskripsi = $request->catatan ?? $p->deskripsi;
        $p->biaya = $request->estimasi_biaya ?? $p->biaya;
        $p->status = 'proses';
        $p->save();

        return redirect()->route('perawatan_inventaris.detail', $p->id)
                        ->with('success', 'Data perbaikan disimpan. Status: proses.');
    }

    // ==============================
    // Ubah status langsung jadi 'proses' (alternatif cepat)
    // ==============================
    public function perbaiki($id)
    {
        $p = PerawatanInventaris::findOrFail($id);
        $p->update(['status' => 'proses']);

        return back()->with('success', 'Barang mulai diperbaiki.');
    }

    // ==============================
    // PINDAHKAN KE RENCANA PENGHAPUSAN
    // ==============================
    public function hapuskan($id)
    {
        $item = PerawatanInventaris::with('barang')->findOrFail($id);
        $barang_id = $item->barang_id;

        // hapus record perbaikan / rencana lama
        $item->delete();

        // cek duplicate rencana_penghapusan
        $cek = PerawatanInventaris::where('barang_id', $barang_id)
            ->where('jenis_perawatan', 'rencana_penghapusan')
            ->whereIn('status', ['pending', 'proses'])
            ->first();

        if ($cek) {
            return back()->with('error', 'Barang ini sudah ada dalam rencana penghapusan!');
        }

        PerawatanInventaris::create([
            'uuid' => Str::uuid(),
            'barang_id' => $barang_id,
            'tanggal_perawatan' => now(),
            'jenis_perawatan' => 'rencana_penghapusan',
            'status' => 'pending',
        ]);

        // <-- FIX BAGIAN INI
    return redirect()->route('data_penghapusan.index')
                    ->with('success', 'Barang berhasil masuk ke Data Penghapusan.');
    }

    // ==============================
    // FORM SELESAI PERBAIKAN (GET)
    // ==============================
    public function selesaiForm($id)
    {
        $data = PerawatanInventaris::with('barang')->findOrFail($id);
        $title = "Selesaikan Perbaikan";
        return view('admin.perawatan_inventaris.selesai', compact('data', 'title'));
    }

    // ==============================
    // SIMPAN SELESAI PERBAIKAN (POST)
    // ==============================
    public function selesaiSubmit(Request $request, $id)
    {
        $request->validate([
            'biaya' => 'required|numeric',
            'deskripsi' => 'required',
            'foto_bukti' => 'nullable|image|max:4096'
        ]);

        $p = PerawatanInventaris::findOrFail($id);

        // upload foto bukti
        if ($request->hasFile('foto_bukti')) {
            if ($p->foto_bukti) {
                Storage::disk('public')->delete($p->foto_bukti);
            }
            $foto = $request->file('foto_bukti')->store('perawatan/bukti', 'public');
        } else {
            $foto = $p->foto_bukti;
        }

        $p->update([
            'biaya' => $request->biaya,
            'deskripsi' => $request->deskripsi,
            'foto_bukti' => $foto,
            'status' => 'selesai'
        ]);

        return redirect()->route('perawatan_inventaris.index')->with('success', 'Perawatan diselesaikan.');
    }
}
