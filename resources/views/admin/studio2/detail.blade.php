@extends('layouts.admin.main')

@section('content')
<div class="p-6">
  <h1 class="text-2xl font-bold mb-6">{{ $title }}</h1>

  {{-- Tombol Kembali --}}
  <a href="{{ route('studio2.index') }}" 
    class="bg-gray-700 hover:bg-gray-800 text-white font-medium py-2 px-4 rounded-lg mb-6 inline-block">
    ← Kembali
  </a>

  {{-- Card Detail Barang --}}
  <div class="bg-white shadow-lg rounded-lg border border-gray-200 overflow-hidden max-w-5xl mx-auto">

    {{-- Foto Barang --}}
    <div class="w-full h-80 bg-gray-100 flex items-center justify-center">
      @if ($barang->foto)
        <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}" class="max-h-80 object-contain">
      @else
        <img src="https://placehold.co/600x400?text=Tidak+Ada+Foto" alt="No Image" class="max-h-80 object-contain">
      @endif
    </div>

    {{-- Detail Informasi --}}
    <div class="p-6">
      <h2 class="text-xl font-bold mb-4 text-gray-800">{{ $barang->nama_barang ?? '-' }}</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700">

        {{-- Kolom Kiri --}}
        <div>
          <p><strong>UUID:</strong> {{ $barang->uuid ?? '-' }}</p>
          <p><strong>Jenis / Kategori:</strong> {{ $barang->jenis_barang ?? '-' }}</p>
          <p><strong>Nomor Seri:</strong> {{ $barang->nomor_seri ?? '-' }}</p>
          <p><strong>Kondisi (%):</strong> {{ $barang->kondisi ? $barang->kondisi . '%' : '-' }}</p>
          <p><strong>Catatan:</strong> {{ $barang->catatan ?? '-' }}</p>
          <p><strong>QR Code:</strong> {{ $barang->qr_code ?? '-' }}</p>
        </div>

        {{-- Kolom Kanan --}}
        <div>
          <p><strong>Kode Barang:</strong> {{ $barang->kode_barang ?? '-' }}</p>
          <p><strong>Merek:</strong> {{ $barang->merk ?? '-' }}</p>
          <p><strong>Jumlah:</strong> {{ $barang->jumlah ?? '-' }}</p>
          <p><strong>Tahun Pengadaan:</strong> {{ $barang->tahun_pengadaan ?? '-' }}</p>

          <p><strong>Status:</strong>
            @if ($barang->status === 'Tersedia')
              <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Tersedia</span>
            @elseif ($barang->status === 'Digunakan')
              <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Digunakan</span>
            @else
              <span class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Perawatan</span>
            @endif
          </p>

          <p><strong>Studio:</strong> {{ ucfirst($barang->studio ?? '-') }}</p>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
