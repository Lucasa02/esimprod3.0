@extends('layouts.admin.main')

@section('content')
{{-- Tombol Kembali --}}
<div class="flex p-3 ml-3 mr-3">
  <a href="{{ route('bmn.mcr.index') }}"
     class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none font-bold rounded-lg text-sm text-center px-5 py-2.5 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
     Kembali
  </a>
</div>

{{-- Detail Barang --}}
<div class="p-6 ml-6 mr-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
  <h2 class="mb-6 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
    {{ $barang->nama_barang }}
  </h2>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    {{-- KIRI: Detail Barang --}}
    <div>
      <p class="mb-3 text-gray-500 dark:text-gray-400">
        {{ $barang->deskripsi ?? 'Tidak ada deskripsi' }}
      </p>

      <ul role="list" class="space-y-2 text-gray-500 dark:text-gray-400">
        <li class="flex items-center space-x-2"><i class="fa-solid fa-code text-sm"></i>
          <span class="font-bold">Kode Barang:</span>
          <span>{{ $barang->kode_barang }}</span>
        </li>
        <li class="flex items-center space-x-2"><i class="fa-solid fa-hashtag text-sm"></i>
          <span class="font-bold">Nomor Seri:</span>
          <span>{{ $barang->nomor_seri ?? '-' }}</span>
        </li>
        <li class="flex items-center space-x-2"><i class="fa-solid fa-copyright text-sm"></i>
          <span class="font-bold">Merk:</span>
          <span>{{ $barang->merk ?? '-' }}</span>
        </li>
        <li class="flex items-center space-x-2"><i class="fa-solid fa-location-dot text-sm"></i>
          <span class="font-bold">Ruangan:</span>
          <span>{{ $barang->ruangan }}</span>
        </li>
        <li class="flex items-center space-x-2"><i class="fa-solid fa-calendar text-sm"></i>
          <span class="font-bold">Tahun Pengadaan:</span>
          <span>{{ $barang->tahun_pengadaan ?? '-' }}</span>
        </li>
        <li class="flex items-center space-x-2"><i class="fa-solid fa-truck text-sm"></i>
          <span class="font-bold">Asal Pengadaan:</span>
          <span>{{ $barang->asal_pengadaan ?? '-' }}</span>
        </li>
        <li class="flex items-center space-x-2"><i class="fa-solid fa-briefcase text-sm"></i>
          <span class="font-bold">Peruntukan:</span>
          <span>{{ $barang->peruntukan ?? '-' }}</span>
        </li>
        <li class="flex items-center space-x-2"><i class="fa-solid fa-percent text-sm"></i>
          <span class="font-bold">Persentase Kondisi:</span>
          <span>{{ $barang->persentase_kondisi ?? 0 }}%</span>
        </li>

        {{-- Warna Kondisi --}}
        @php
            $warna = match($barang->kondisi) {
                'Sangat Baik' => 'text-green-600 dark:text-green-400',
                'Baik' => 'text-lime-600 dark:text-lime-400',
                'Kurang Baik' => 'text-yellow-600 dark:text-yellow-400',
                'Rusak', 'Rusak / Cacat', 'Cacat' => 'text-red-600 dark:text-red-400',
                default => 'text-gray-600 dark:text-gray-400'
            };
        @endphp

        <li class="flex items-center space-x-2">
          <i class="fa-solid fa-circle-check {{ $warna }} text-sm"></i>
          <span class="font-bold {{ $warna }}">Kondisi:</span>
          <span class="{{ $warna }}">{{ $barang->kondisi ?? '-' }}</span>
        </li>

        @if ($barang->catatan)
          <li class="flex items-center space-x-2">
            <i class="fa-solid fa-note-sticky text-sm"></i>
            <span class="font-bold">Catatan:</span>
            <span>{{ $barang->catatan }}</span>
          </li>
        @endif

        <li class="flex items-center space-x-2">
          <i class="fa-solid fa-clock text-sm"></i>
          <span class="font-bold">Diperbarui:</span>
          <span>{{ optional($barang->updated_at)->format('d M Y H:i') ?? '-' }}</span>
        </li>
      </ul>
    </div>

    
{{-- KANAN: Gambar & QR Code --}}
<div class="flex flex-col items-center justify-center p-6">
    {{-- Card utama untuk gambar + QR --}}
    <div class="flex items-center justify-center p-6 space-x-8">
        {{-- Gambar Barang --}}
        <figure class="flex flex-col items-center justify-center">
            @if ($barang->foto)
                <img class="max-h-40 w-auto object-contain rounded-md"
                    src="{{ asset('storage/' . $barang->foto) }}"
                    alt="{{ $barang->nama_barang }}">
            @else
                <div class="w-64 h-64 flex items-center justify-center bg-gray-100 text-gray-500 rounded-lg border dark:bg-gray-700 dark:text-gray-400">
                    Tidak ada foto
                </div>
            @endif
        </figure>

        {{-- QR Code --}}
        <figure class="flex flex-col items-center justify-center">
            @if ($barang->qr_code)
                <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600">
                    <img class="w-32 h-32 object-contain"
                        src="{{ asset('storage/' . $barang->qr_code) }}"
                        alt="QR Code">
                </div>
            @else
                <div class="w-32 h-32 flex items-center justify-center bg-gray-100 text-gray-500 rounded-lg border dark:bg-gray-700 dark:text-gray-400">
                    Tidak ada QR Code
                </div>
            @endif
        </figure>
    </div>

    {{-- Caption di bawah gambar --}}
    <figcaption class="mt- text-sm text-gray-500 dark:text-gray-400 text-center">
        {{ $barang->nama_barang }} — {{ $barang->kode_barang }}
    </figcaption>
</div>

  </div>
</div>
@endsection