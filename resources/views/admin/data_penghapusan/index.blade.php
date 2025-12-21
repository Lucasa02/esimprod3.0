@extends('layouts.admin.main')

@section('content')

{{-- Filter --}}
<div x-data="{ open: false }"
  class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mx-6 mb-8 border border-border-light dark:border-border-dark">

  {{-- HEADER FILTER --}}
  <div class="flex justify-between items-center mb-3">
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Filter Penghapusan</h2>

    <button 
      type="button" 
      @click="open = !open"
      class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
      <i class="fa-solid fa-filter mr-2"></i>
      <span x-text="open ? 'Tutup Filter' : 'Buka Filter'"></span>
    </button>
  </div>

  {{-- BODY FILTER --}}
  <div x-show="open" x-transition
    class="mt-4 border-t border-border-light dark:border-border-dark pt-5">

    <form method="GET" action="{{ route('penghapusan.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6">

      {{-- Nama Barang --}}
      <div>
        <label class="block text-sm text-text-light-secondary dark:text-text-dark-secondary mb-1">
          Nama Barang
        </label>
        <input type="text" name="nama_barang" value="{{ request('nama_barang') }}"
          placeholder="Cari nama barang..."
          class="w-full bg-slate-50 dark:bg-slate-800 border border-border-light dark:border-border-dark 
                 rounded text-sm focus:ring-primary focus:border-primary p-2.5" />
      </div>

      {{-- Kode Barang --}}
      <div>
        <label class="block text-sm text-text-light-secondary dark:text-text-dark-secondary mb-1">
          Kode Barang
        </label>
        <input type="text" name="kode_barang" value="{{ request('kode_barang') }}"
          placeholder="Cari kode barang..."
          class="w-full bg-slate-50 dark:bg-slate-800 border border-border-light dark:border-border-dark 
                 rounded text-sm focus:ring-primary focus:border-primary p-2.5" />
      </div>

      {{-- Tahun --}}
      <div>
        <label class="block text-sm text-text-light-secondary dark:text-text-dark-secondary mb-1">
          Tahun Penghapusan
        </label>
        <input type="number" name="tahun" value="{{ request('tahun') }}"
          placeholder="e.g. 2024"
          class="w-full bg-slate-50 dark:bg-slate-800 border border-border-light dark:border-border-dark 
                 rounded text-sm focus:ring-primary focus:border-primary p-2.5" />
      </div>

      {{-- Tombol --}}
      <div class="md:col-span-3 flex items-center gap-2 mt-2">

        <button type="submit"
          class="bg-blue-600 text-white font-semibold px-5 py-2.5 rounded-lg flex items-center gap-2 hover:bg-blue-700">
          <span class="material-symbols-outlined !text-xl">search</span>
          Filter
        </button>

        <a href="{{ route('penghapusan.index') }}"
          class="bg-gray-500 text-white font-semibold px-5 py-2.5 rounded-lg hover:bg-gray-600">
          Reset
        </a>

        {{-- CETAK PDF --}}
        <a href="{{ route('penghapusan.cetak.pdf', request()->query()) }}"
          target="_blank"
          class="bg-red-600 text-white font-semibold px-5 py-2.5 rounded-lg hover:bg-red-700 flex items-center gap-2">
          <i class="fa-solid fa-file-pdf"></i>
          Cetak PDF
        </a>

      </div>

    </form>

  </div>
</div>


{{-- Jika tidak ada data --}}
@if ($data->isEmpty())
  <div class="text-center text-gray-500 mt-10">
      <p>Belum ada barang yang dihapuskan.</p>
  </div>
@endif


{{-- GRID DATA --}}
<div class="flex justify-center p-3 ml-3 mr-3">
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 w-full">

    @foreach($data as $row)

    <div class="w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 relative">

      {{-- Foto --}}
      <img 
          class="w-full rounded-t-lg h-40 object-cover {{ $row->barang->foto ? '' : 'opacity-50' }}"
          src="{{ $row->barang->foto 
                ? asset('storage/'.$row->barang->foto)
                : asset('img/no-image.png') }}"
          alt=""
      >

      {{-- Badge Penghapusan --}}
      <span class="absolute top-3 left-3 bg-red-600 text-white text-xs font-semibold px-2 py-0.5 rounded-full">
          Penghapusan
      </span>

      <div class="p-4">
        <p class="font-semibold text-gray-900 dark:text-white text-sm truncate w-40">
            {{ $row->barang->nama_barang ?? '-' }}
        </p>

        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
            {{ $row->barang->kode_barang }}
        </p>

        <p class="text-xs text-gray-400">
            {{ $row->created_at->format('d-m-Y') }}
        </p>
{{-- Tombol Lihat Surat Penghapusan --}}
@if($row->surat_penghapusan)
    <a href="{{ asset('storage/' . $row->surat_penghapusan) }}" 
       target="_blank"
       class="block mt-3 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-3 py-2 rounded-lg text-center">
        <i class="fa-solid fa-file-pdf mr-1"></i> Lihat Surat Penghapusan
    </a>
@else
    <button 
        class="block mt-3 bg-gray-400 text-white text-xs font-semibold px-3 py-2 rounded-lg w-full cursor-not-allowed">
        Surat belum di-upload
    </button>
@endif

      </div>

    </div>

    @endforeach

  </div>
</div>

@endsection
