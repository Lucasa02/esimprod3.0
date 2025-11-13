@extends('layouts.admin.main')

@section('content')
<div class="p-6 font-sans text-left">

  {{-- Tombol Kembali --}}
  <a href="{{ route('studio2.index') }}" 
     class="bg-gray-700 hover:bg-gray-800 text-white font-medium py-2 px-4 rounded-lg mb-4 inline-block no-print">
     ← Kembali
  </a>

  {{-- Card Detail --}}
  <div class="bg-white shadow-lg rounded-lg border border-gray-200 overflow-hidden max-w-5xl mx-auto p-6 text-left">

    {{-- Flex utama: Detail kiri | Foto kanan --}}
    <div class="flex flex-col md:flex-row items-start justify-between md:gap-8 gap-4">

      {{-- Detail Barang --}}
      <div class="flex-grow text-left md:w-2/3">
        <h2 class="text-2xl font-bold text-gray-800 mb-1">{{ ucfirst($barang->nama_barang ?? '-') }}</h2>
        <p class="text-sm text-gray-500 mb-4">{{ $barang->catatan ?? 'Tidak ada deskripsi' }}</p>

        <ul class="text-sm text-gray-700 space-y-2">
          <li><i class="fa-solid fa-code text-blue-700 w-5"></i> <strong>Kode Barang:</strong> {{ $barang->kode_barang ?? '-' }}</li>
          <li><i class="fa-solid fa-hashtag text-blue-700 w-5"></i> <strong>Nomor Seri:</strong> {{ $barang->nomor_seri ?? '-' }}</li>
          <li><i class="fa-solid fa-industry text-blue-700 w-5"></i> <strong>Merk:</strong> {{ $barang->merk ?? '-' }}</li>
          <li><i class="fa-solid fa-warehouse text-blue-700 w-5"></i> <strong>Asal Pengadaan:</strong> {{ $barang->asal_pengadaan ?? '-' }}</li>
          <li><i class="fa-solid fa-location-dot text-blue-700 w-5"></i> <strong>Peruntukan:</strong> {{ strtoupper($barang->studio ?? '-') }}</li>
          <li><i class="fa-solid fa-calendar text-blue-700 w-5"></i> <strong>Tahun Pengadaan:</strong> {{ $barang->tahun_pengadaan ?? '-' }}</li>
          <li><i class="fa-solid fa-percent text-blue-700 w-5"></i> <strong>Persentase Kondisi:</strong> {{ $barang->kondisi ? $barang->kondisi . '%' : '-' }}</li>

          {{-- Kondisi --}}
          <li>
            <i class="fa-solid fa-circle-check text-green-700 w-5"></i>
            <strong>Kondisi:</strong>
            @if ($barang->kondisi >= 90)
              <span class="text-green-700 font-semibold">Sangat Baik</span>
            @elseif ($barang->kondisi >= 70)
              <span class="text-yellow-600 font-semibold">Baik</span>
            @else
              <span class="text-red-600 font-semibold">Perlu Perawatan</span>
            @endif
          </li>

          <li><i class="fa-solid fa-comment-dots text-blue-700 w-5"></i> <strong>Catatan:</strong> {{ $barang->catatan ?? '-' }}</li>

          {{-- Status --}}
          <li>
            <i class="fa-solid fa-info-circle text-blue-700 w-5"></i>
            <strong>Status:</strong>
            @if ($barang->status === 'Tersedia')
              <span class="bg-green-500 text-white text-xs px-2 py-1 rounded">Tersedia</span>
            @elseif ($barang->status === 'Digunakan')
              <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">Digunakan</span>
            @else
              <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded">Perawatan</span>
            @endif
          </li>

          <li><i class="fa-solid fa-clock text-blue-700 w-5"></i> <strong>Diperbarui:</strong> {{ $barang->updated_at->format('d M Y H:i') }}</li>
        </ul>
      </div>

      {{-- Foto + QR Code --}}
      <div class="md:w-1/3 flex flex-col items-center md:items-start space-y-4">
        {{-- Foto Barang --}}
        @if ($barang->foto)
          <img src="{{ asset('storage/' . $barang->foto) }}" 
               alt="{{ $barang->nama_barang }}" 
               class="w-60 h-60 object-contain rounded-lg border shadow-sm">
        @else
          <img src="https://placehold.co/250x250?text=Tidak+Ada+Foto" 
               alt="No Image" 
               class="w-60 h-60 object-contain rounded-lg border shadow-sm">
        @endif

        {{-- QR Code --}}
        <div class="text-center md:text-left">
          <p class="font-semibold text-gray-700 mb-1">QR Code</p>
          <div class="border p-2 rounded-md bg-gray-50 inline-block shadow-sm">
            {!! QrCode::size(110)->generate($barang->qr_code ?? 'QR-NOT-SET') !!}
          </div>
          <p class="text-xs text-gray-500 mt-1">{{ $barang->qr_code ?? '-' }}</p>
        </div>

        {{-- Tombol Cetak --}}
        <button onclick="window.print()" 
                class="no-print mt-2 bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm">
          🖨 Cetak Detail
        </button>
      </div>

    </div>
  </div>
</div>

{{-- CSS untuk print --}}
<style>
  @media print {
    .no-print { display: none !important; }
    body { background: white !important; }
  }
</style>
@endsection
