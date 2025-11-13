@extends('layouts.admin.main')

@section('content')
<div class="p-6">
  <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>

  <form action="{{ route('studio2.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="block font-semibold mb-1">Nama Barang</label>
      <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" class="w-full border border-gray-300 rounded-lg p-2" required>
    </div>

    <div class="mb-3">
      <label class="block font-semibold mb-1">Kode Barang</label>
      <input type="text" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" class="w-full border border-gray-300 rounded-lg p-2" required>
    </div>

    <div class="mb-3">
      <label class="block font-semibold mb-1">Merek</label>
      <input type="text" name="merk" value="{{ old('merk', $barang->merk) }}" class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <div class="mb-3">
      <label class="block font-semibold mb-1">Nomor Seri</label>
      <input type="text" name="nomor_seri" value="{{ old('nomor_seri', $barang->nomor_seri) }}" class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <div class="mb-3">
      <label class="block font-semibold mb-1">Status</label>
      <select name="status" class="w-full border border-gray-300 rounded-lg p-2" required>
        <option value="Tersedia" {{ $barang->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
        <option value="Digunakan" {{ $barang->status == 'Digunakan' ? 'selected' : '' }}>Digunakan</option>
        <option value="Perawatan" {{ $barang->status == 'Perawatan' ? 'selected' : '' }}>Perawatan</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="block font-semibold mb-1">Ganti Foto (opsional)</label>
      <input type="file" name="foto" accept="image/*" class="w-full border border-gray-300 rounded-lg p-2">
      @if ($barang->foto)
        <img src="{{ asset('storage/' . $barang->foto) }}" alt="Foto Barang" class="mt-2 w-32 rounded">
      @endif
    </div>

    <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800">
      Simpan Perubahan
    </button>
  </form>
</div>
@endsection
