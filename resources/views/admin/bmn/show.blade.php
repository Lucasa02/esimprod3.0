@extends('layouts.admin.main')
@section('content')
  {{-- Tombol Kembali --}}
  <div class="flex p-3 ml-3 mr-3">
    <a href="{{ route('bmn.index', $barang->ruangan) }}"
      class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none font-bold rounded-lg text-sm text-center px-5 py-2.5 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
      type="button">
      Kembali
    </a>
  </div>

  {{-- Detail Content --}}
  <div class="p-3 ml-6 mr-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    {{-- Tabs Header --}}
    <ul
      class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800"
      id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">

      <li class="me-2">
        <button id="detail-tab" data-tabs-target="#detail" type="button" role="tab" aria-controls="detail"
          aria-selected="true"
          class="inline-block p-4 text-blue-600 rounded-ss-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500">
          Detail
        </button>
      </li>

      <li class="me-2">
        <button id="gambar-tab" data-tabs-target="#gambar" type="button" role="tab" aria-controls="gambar"
          aria-selected="false"
          class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
          Gambar
        </button>
      </li>

      <li class="me-2">
        <button id="qrcode-tab" data-tabs-target="#qrcode" type="button" role="tab" aria-controls="qrcode"
          aria-selected="false"
          class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
          QR-Code
        </button>
      </li>
    </ul>

    {{-- Tabs Content --}}
    <div id="defaultTabContent">

      {{-- TAB DETAIL --}}
      <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="detail" role="tabpanel" aria-labelledby="detail-tab">
        <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
          {{ $barang->nama_barang }}
        </h2>

        <p class="mb-3 text-gray-500 dark:text-gray-400">{{ $barang->deskripsi ?? 'Tidak ada deskripsi' }}</p>

        <ul role="list" class="space-y-2 text-gray-500 dark:text-gray-400">
          <li class="flex space-x-2 items-center">
            <i class="fa-solid fa-code text-sm"></i>
            <span class="font-bold">Kode Barang:</span>
            <span>{{ $barang->kode_barang }}</span>
          </li>

          <li class="flex space-x-2 items-center">
            <i class="fa-solid fa-hashtag text-sm"></i>
            <span class="font-bold">Nomor Seri:</span>
            <span>{{ $barang->nomor_seri ?? '-' }}</span>
          </li>

          <li class="flex space-x-2 items-center">
            <i class="fa-solid fa-copyright text-sm"></i>
            <span class="font-bold">Merk:</span>
            <span>{{ $barang->merk ?? '-' }}</span>
          </li>

          <li class="flex space-x-2 items-center">
            <i class="fa-solid fa-location-dot text-sm"></i>
            <span class="font-bold">Ruangan:</span>
            <span>{{ $barang->ruangan }}</span>
          </li>

          <li class="flex space-x-2 items-center">
            <i class="fa-solid fa-calendar text-sm"></i>
            <span class="font-bold">Tahun Pengadaan:</span>
            <span>{{ $barang->tahun_pengadaan ?? '-' }}</span>
          </li>

          <li class="flex space-x-2 items-center">
            <i class="fa-solid fa-percent text-sm"></i>
            <span class="font-bold">Persentase Kondisi:</span>
            <span>{{ $barang->persentase_kondisi }}%</span>
          </li>

          {{-- Kondisi Barang --}}
          <li class="flex space-x-2 items-center">
            @php
              $warna = match($barang->kondisi) {
                  'Sangat Baik' => 'text-green-600',
                  'Baik' => 'text-lime-600',
                  'Kurang Baik' => 'text-yellow-600',
                  'Rusak', 'Rusak / Cacat', 'Cacat' => 'text-red-600',
                  default => 'text-gray-600'
              };
            @endphp
            <i class="fa-solid fa-circle-check {{ $warna }} text-sm"></i>
            <span class="font-bold {{ $warna }}">Kondisi:</span>
            <span class="{{ $warna }}">{{ $barang->kondisi }}</span>
          </li>

          @if($barang->catatan)
          <li class="flex space-x-2 items-center">
            <i class="fa-solid fa-note-sticky text-sm"></i>
            <span class="font-bold">Catatan:</span>
            <span>{{ $barang->catatan }}</span>
          </li>
          @endif

          <li class="flex space-x-2 items-center">
            <i class="fa-solid fa-clock text-sm"></i>
            <span class="font-bold">Diperbarui:</span>
            <span>{{ $barang->updated_at->format('d M Y H:i') }}</span>
          </li>
        </ul>
      </div>

      {{-- TAB GAMBAR --}}
      <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="gambar" role="tabpanel" aria-labelledby="gambar-tab">
        <figure class="flex flex-col items-center justify-center max-w-lg mx-auto">
          @if ($barang->foto)
            <img class="h-auto w-64 rounded-lg shadow-md border border-gray-200" 
                 src="{{ asset('storage/' . $barang->foto) }}" 
                 alt="{{ $barang->nama_barang }}">
          @else
            <div class="w-64 h-64 flex items-center justify-center bg-gray-100 text-gray-500 rounded-lg border">
              Tidak ada foto
            </div>
          @endif
          <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">
            {{ $barang->nama_barang }}
          </figcaption>
        </figure>
      </div>

      {{-- TAB QR CODE --}}
      <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="qrcode" role="tabpanel" aria-labelledby="qrcode-tab">
        <figure class="flex flex-col items-center justify-center max-w-lg mx-auto">
          @if ($barang->qr_code)
            <img class="h-auto w-48 rounded-lg shadow-md border border-gray-200"
                 src="{{ asset('storage/' . $barang->qr_code) }}" 
                 alt="QR Code">
          @else
            <div class="w-48 h-48 flex items-center justify-center bg-gray-100 text-gray-500 rounded-lg border">
              Tidak ada QR Code
            </div>
          @endif
          <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">
            {{ $barang->kode_barang }}
          </figcaption>
        </figure>
      </div>

    </div>
  </div>
@endsection
