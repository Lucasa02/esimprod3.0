@extends('layouts.admin.main')

@section('content')
<div class="p-6">
  <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>

  {{-- 🔹 Form Tambah Data Peralatan Studio --}}
  <form action="{{ route('studio2.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Nama Barang --}}
    <div class="mb-3">
      <label class="block font-semibold mb-1">Nama Barang</label>
      <input type="text" name="nama_barang" class="w-full border border-gray-300 rounded-lg p-2" required>
    </div>

    {{-- Kode Barang (Opsional) --}}
    <div class="mb-3">
      <label class="block font-semibold mb-1">Kode Barang <span class="text-gray-500 text-sm">(opsional)</span></label>
      <input type="text" name="kode_barang" placeholder="Biarkan kosong untuk otomatis" 
             class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    {{-- Kategori / Jenis Barang --}}
    <div class="mb-3">
      <label class="block font-semibold mb-1">Kategori / Jenis Barang</label>
      <input type="text" name="jenis_barang_id" placeholder="Contoh: Kamera, Tripod, Mikrofon"
             class="w-full border border-gray-300 rounded-lg p-2" required>
    </div>

    {{-- Merek --}}
    <div class="mb-3">
      <label class="block font-semibold mb-1">Merek</label>
      <input type="text" name="merk" class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    {{-- Nomor Seri --}}
    <div class="mb-3">
      <label class="block font-semibold mb-1">Nomor Seri</label>
      <input type="text" name="nomor_seri" class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    {{-- Jumlah --}}
    <div class="mb-3">
      <label class="block font-semibold mb-1">Jumlah</label>
      <input type="number" name="jumlah" min="1" class="w-full border border-gray-300 rounded-lg p-2" required>
    </div>

    {{-- Persentase Kondisi --}}
    <div class="mb-3">
      <label class="block font-semibold mb-1">Persentase Kondisi (%)</label>
      <input type="number" name="kondisi" min="1" max="100" class="w-full border border-gray-300 rounded-lg p-2" required>
    </div>

    {{-- Tahun Pengadaan --}}
    <div class="mb-3">
      <label class="block font-semibold mb-1">Tahun Pengadaan</label>
      <input type="number" name="tahun_pengadaan" min="2000" max="{{ date('Y') }}" 
             class="w-full border border-gray-300 rounded-lg p-2" required>
    </div>

    {{-- 🏢 Asal Pengadaan --}}
    <div class="mb-3">
      <label class="block font-semibold mb-1">Asal Pengadaan</label>
      <input type="text" name="asal_pengadaan" placeholder="Contoh: APBN, Hibah, Sponsor, Pembelian Internal" 
             class="w-full border border-gray-300 rounded-lg p-2" required>
    </div>

    {{-- 🎥 Peruntukan (Lokasi / Studio) --}}
    <div class="mb-3">
      <label class="block font-semibold mb-1">Peruntukan</label>
      <select name="studio" class="w-full border border-gray-300 rounded-lg p-2" required>
        <option value="">-- Pilih Peruntukan --</option>
        <option value="mcr">MCR</option>
        <option value="studio1">Studio 1</option>
        <option value="studio2">Studio 2</option>
      </select>
    </div>

    {{-- Catatan --}}
    <div class="mb-3">
      <label class="block font-semibold mb-1">Catatan</label>
      <textarea name="catatan" rows="3" class="w-full border border-gray-300 rounded-lg p-2"
                placeholder="Tulis catatan tambahan (opsional)"></textarea>
    </div>

    {{-- Upload Foto --}}
    <div class="mb-3">
      <label class="block font-semibold mb-1">Foto Barang</label>
      <input type="file" name="foto" accept="image/*" class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    {{-- Status Barang --}}
    <div class="mb-3">
      <label class="block font-semibold mb-1">Status</label>
      <select name="status" class="w-full border border-gray-300 rounded-lg p-2" required>
        <option value="Tersedia">Tersedia</option>
        <option value="Digunakan">Digunakan</option>
        <option value="Perawatan">Perawatan</option>
      </select>
    </div>

    {{-- Tombol Simpan --}}
    <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800">
      Simpan
    </button>
  </form>
</div>
@endsection
