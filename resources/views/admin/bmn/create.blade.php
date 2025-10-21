@extends('layouts.admin.main')

@section('content')
<div class="p-5">
  <h1 class="text-xl font-semibold text-white mb-4">Tambah Barang - {{ strtoupper($ruangan) }}</h1>

  <form action="{{ route('bmn.store', $ruangan) }}" method="POST" class="bg-gray-800 p-5 rounded-lg shadow-md">
    @csrf
    <div class="grid gap-4">
      <div>
        <label class="text-gray-200">Nama Barang</label>
        <input type="text" name="nama_barang" class="w-full rounded p-2 bg-gray-700 text-white" required>
      </div>
      <div>
        <label class="text-gray-200">Kode Barang</label>
        <input type="text" name="kode_barang" class="w-full rounded p-2 bg-gray-700 text-white" required>
      </div>
      <div>
        <label class="text-gray-200">Kategori</label>
        <input type="text" name="kategori" class="w-full rounded p-2 bg-gray-700 text-white" required>
      </div>
      <div>
        <label class="text-gray-200">Jumlah</label>
        <input type="number" name="jumlah" class="w-full rounded p-2 bg-gray-700 text-white" min="1" required>
      </div>
      <div>
        <label class="text-gray-200">Kondisi</label>
        <select name="kondisi" class="w-full rounded p-2 bg-gray-700 text-white" required>
          <option>Baik</option>
          <option>Rusak Ringan</option>
          <option>Rusak Berat</option>
        </select>
      </div>
    </div>

    <div class="mt-4 flex gap-2">
      <button type="submit" class="bg-green-600 px-4 py-2 rounded-lg hover:opacity-90 text-white">Simpan</button>
      <a href="{{ route('bmn.index', $ruangan) }}" class="bg-gray-500 px-4 py-2 rounded-lg hover:opacity-90 text-white">Kembali</a>
    </div>
  </form>
</div>
@endsection
