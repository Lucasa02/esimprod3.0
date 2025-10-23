@extends('layouts.admin.main')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
  <h1 class="text-2xl font-bold mb-4 text-center">{{ $title }}</h1>

  <table class="min-w-full border border-gray-300 text-sm">
    <thead class="bg-gray-100 text-gray-700 uppercase">
      <tr>
        <th class="border border-gray-300 px-3 py-2 text-left">No</th>
        <th class="border border-gray-300 px-3 py-2 text-left">Nama Barang</th>
        <th class="border border-gray-300 px-3 py-2 text-left">Kode Barang</th>
        <th class="border border-gray-300 px-3 py-2 text-left">Kategori</th>
        <th class="border border-gray-300 px-3 py-2 text-left">Merk</th>
        <th class="border border-gray-300 px-3 py-2 text-left">Nomor Seri</th>
        <th class="border border-gray-300 px-3 py-2 text-left">Jumlah</th>
        <th class="border border-gray-300 px-3 py-2 text-left">Kondisi (%)</th>
        <th class="border border-gray-300 px-3 py-2 text-left">Tahun Pengadaan</th>
        <th class="border border-gray-300 px-3 py-2 text-left">Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($barangs as $index => $b)
      <tr class="hover:bg-gray-50">
        <td class="border border-gray-300 px-3 py-2">{{ $index + 1 }}</td>
        <td class="border border-gray-300 px-3 py-2">{{ $b->nama_barang }}</td>
        <td class="border border-gray-300 px-3 py-2">{{ $b->kode_barang }}</td>
        <td class="border border-gray-300 px-3 py-2">{{ $b->jenis_barang ?? '-' }}</td>
        <td class="border border-gray-300 px-3 py-2">{{ $b->merk ?? '-' }}</td>
        <td class="border border-gray-300 px-3 py-2">{{ $b->nomor_seri ?? '-' }}</td>
        <td class="border border-gray-300 px-3 py-2">{{ $b->jumlah ?? '-' }}</td>
        <td class="border border-gray-300 px-3 py-2">{{ $b->kondisi ?? '-' }}</td>
        <td class="border border-gray-300 px-3 py-2">{{ $b->tahun_pengadaan ?? '-' }}</td>
        <td class="border border-gray-300 px-3 py-2">
          @if($b->status === 'Tersedia')
            <span class="bg-green-500 text-white px-2 py-0.5 rounded text-xs">Tersedia</span>
          @elseif($b->status === 'Digunakan')
            <span class="bg-red-500 text-white px-2 py-0.5 rounded text-xs">Digunakan</span>
          @else
            <span class="bg-yellow-500 text-white px-2 py-0.5 rounded text-xs">Perawatan</span>
          @endif
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="10" class="text-center py-3 text-gray-500">Tidak ada data peralatan di Studio 2</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  {{-- Tombol Cetak --}}
  <div class="mt-6 text-center">
    <button onclick="window.print()" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800">
      <i class="fa-solid fa-print mr-1"></i> Cetak
    </button>
  </div>
</div>

{{-- CSS khusus untuk mode cetak --}}
<style>
@media print {
  button {
    display: none;
  }
  body {
    background: white !important;
  }
  table {
    width: 100%;
    border-collapse: collapse;
  }
  th, td {
    border: 1px solid #000;
    padding: 6px;
  }
}
</style>
@endsection
