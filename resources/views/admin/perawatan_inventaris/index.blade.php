@extends('layouts.admin.main')

@section('content')

{{-- Filter --}}
<div x-data="{ open: false }"
  class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mx-6 mb-8 border border-border-light dark:border-border-dark">

  <div class="flex justify-between items-center mb-3">
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Filter Perawatan</h2>

    <button 
      type="button" 
      @click="open = !open"
      class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
      <i class="fa-solid fa-filter mr-2"></i>
      <span x-text="open ? 'Tutup Filter' : 'Buka Filter'"></span>
    </button>
  </div>

  <div x-show="open" x-transition
    class="mt-4 border-t border-border-light dark:border-border-dark pt-5">

    <form method="GET" action="{{ route('perawatan_inventaris.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6">

      {{-- Cari Barang --}}
      <div>
        <label class="block text-sm text-text-light-secondary dark:text-text-dark-secondary mb-1">Cari Barang</label>
        <input type="text" name="search" value="{{ request('search') }}"
          placeholder="Nama / Kode Barang"
          class="w-full bg-slate-50 dark:bg-slate-800 border border-border-light dark:border-border-dark rounded text-sm focus:ring-primary focus:border-primary p-2.5" />
      </div>

      {{-- Status --}}
      <div x-data="{ status: '{{ request('status') }}' }">
        <label class="block text-sm text-text-light-secondary dark:text-text-dark-secondary mb-1">Status</label>

        <select name="status" x-model="status"
          :class="{
            'bg-yellow-100 text-yellow-800': status === 'pending',
            'bg-blue-100 text-blue-800': status === 'proses',
            'bg-green-100 text-green-800': status === 'selesai',
            'bg-slate-50 dark:bg-slate-800': status === ''
          }"
          class="w-full border border-border-light dark:border-border-dark rounded text-sm focus:ring-primary focus:border-primary p-2.5">

          <option value="">Semua</option>
          <option value="pending">Pending</option>
          <option value="proses">Proses</option>
          <option value="selesai">Selesai</option>

        </select>
      </div>

      {{-- Tombol Filter --}}
      <div class="flex items-end">
        <button type="submit"
          class="bg-blue-600 text-white font-semibold px-5 py-2.5 rounded-lg flex items-center gap-2 hover:bg-blue-700">
          <span class="material-symbols-outlined !text-xl">search</span>
          Filter
        </button>
      </div>

    </form>
  </div>
</div>

{{-- Jika tidak ada data --}}
@if ($data->isEmpty())
  <div class="text-center text-gray-500 mt-6">
      <p>Belum ada data perawatan.</p>
  </div>
@endif

{{-- Grid Card --}}
<div class="flex justify-center p-3 ml-3 mr-3">
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 w-full">

    @foreach($data as $row)

    @php
        // Warna status diperjelas
        $warnaStatus = match($row->status) {
            'proses' => 'bg-yellow-200 text-yellow-800 border border-yellow-400',
            'pending' => 'bg-gray-200 text-gray-800 border border-gray-400',
            'selesai' => 'bg-green-200 text-green-800 border border-green-400',
            default => 'bg-gray-300 text-gray-900 border border-gray-500'
        };

        $jenis = str_replace('_', ' ', $row->jenis_perawatan);
    @endphp

    <div class="w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 relative">

        {{-- Foto Barang --}}
        <img 
            class="w-full rounded-t-lg h-40 object-cover {{ $row->barang->foto ? '' : 'opacity-50' }}"
            src="{{ $row->barang->foto 
                  ? asset('storage/'.$row->barang->foto)
                  : asset('img/no-image.png') }}"
            alt="{{ $row->barang->nama_barang }}"
        >

        {{-- Badge Jenis --}}
        <span class="absolute top-3 left-3 bg-tvri_base_color text-white text-xs font-semibold px-2 py-0.5 rounded-full">
            {{ $jenis }}
        </span>

        <div class="p-4">

            {{-- Nama Barang + Tombol Detail --}}
    <div class="flex justify-between items-center mb-1">
        <p class="font-semibold text-gray-900 dark:text-white text-sm truncate w-40">
            {{ $row->barang->nama_barang ?? '-' }}
        </p>

        <a href="{{ route('perawatan_inventaris.detail', $row->id) }}"
            class="bg-blue-600 hover:bg-blue-700 text-white p-1.5 rounded-lg text-xs flex items-center justify-center">
            <i class="fa-solid fa-eye text-xs"></i>
        </a>
    </div>

            {{-- Tanggal --}}
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                {{ $row->tanggal_perawatan }}
            </p>

            {{-- Badge Status --}}
            <span class="{{ $warnaStatus }} text-xs font-semibold px-2 py-0.5 rounded-full">
                {{ ucfirst($row->status) }}
            </span>

            {{-- BUTTON --}}
            <div class="mt-4 flex flex-wrap gap-2">

                {{-- Mulai Perbaiki --}}
                @if($row->status != 'proses')
                <a href="{{ route('perawatan_inventaris.perbaiki', $row->id) }}"
                    class="inline-flex text-white bg-blue-600 hover:bg-blue-700 text-xs px-2 py-1 rounded-lg">
                    Perbaiki
                </a>
                @endif

                {{-- Selesaikan --}}
                @if($row->status == 'proses')
                <a href="{{ route('perawatan_inventaris.selesaiForm', $row->id) }}"
                    class="inline-flex text-white bg-green-700 hover:bg-green-600 text-xs px-2 py-1 rounded-lg">
                    Selesaikan Perbaikan
                </a>
                @endif

                {{-- Rencana Penghapusan --}}
                @if($row->status != 'pending')
                <a href="{{ route('perawatan_inventaris.hapuskan', $row->id) }}"
                    onclick="return confirm('Yakin barang ini tidak bisa diperbaiki?')"
                    class="inline-flex text-white bg-red-700 hover:bg-red-800 text-xs px-2 py-1 rounded-lg">
                    Rencana Penghapusan
                </a>
                

                @endif

            </div>
        </div>

    </div>

    @endforeach

  </div>
</div>

@endsection
