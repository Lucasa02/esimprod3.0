@extends('layouts.admin.main')
@section('content')

<div class="p-5">
  <h1 class="text-xl font-semibold text-white mb-4">Data BMN - {{ strtoupper($ruangan) }}</h1>

 <a href="{{ route('bmn.create', $ruangan) }}"
   class="bg-tvri_base_color text-white px-3 py-2 rounded-lg hover:opacity-90">
   + Tambah Barang
</a>

  <div class="mt-4 bg-gray-800 rounded-lg shadow overflow-x-auto">
    <table class="min-w-full text-sm text-gray-300">
      <thead class="bg-gray-700 text-gray-100">
        <tr>
          <th class="px-4 py-2 text-left">Nama Barang</th>
          <th class="px-4 py-2">Kode</th>
          <th class="px-4 py-2">Kategori</th>
          <th class="px-4 py-2">Jumlah</th>
          <th class="px-4 py-2">Kondisi</th>
          <th class="px-4 py-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($data as $item)
        <tr class="border-b border-gray-700 hover:bg-gray-700/50">
          <td class="px-4 py-2">{{ $item->nama_barang }}</td>
          <td class="px-4 py-2">{{ $item->kode_barang }}</td>
          <td class="px-4 py-2">{{ $item->kategori }}</td>
          <td class="px-4 py-2 text-center">{{ $item->jumlah }}</td>
          <td class="px-4 py-2">{{ $item->kondisi }}</td>
          <td class="px-4 py-2 flex gap-2">
            <a href="{{ route('bmn.edit', [$ruangan, $item->id]) }}" class="text-yellow-400 hover:text-yellow-300">
              <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <form action="{{ route('bmn.delete', [$ruangan, $item->id]) }}" method="POST" 
                  onsubmit="return confirm('Hapus data ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-500 hover:text-red-400">
                <i class="fa-solid fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-4 text-gray-400">Belum ada data</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
