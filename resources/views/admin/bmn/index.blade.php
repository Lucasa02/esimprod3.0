@extends('layouts.admin.main')

@section('content')
{{-- Dropdown Opsi --}}
<div class="flex items-center ml-6 mr-3 mb-4">
  <button id="dropdownRightButton" data-dropdown-toggle="dropdownRight" data-dropdown-placement="right"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
      type="button" title="Menu">
      <i class="fa-solid fa-gear mr-2"></i> Opsi
  </button>
<a href="{{ route('bmn.qr_all.download') }}"
   class="bg-blue-600 text-white px-4 py-2 rounded-lg">
   Download QR Semua Barang
</a>

  <div id="dropdownRight"
      class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
      <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRightButton">
          <li>
              <a href="{{ route('bmn.create', $ruangan) }}"
                  class="block px-3 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                  Tambah Barang
              </a>
          </li>
          <li>
              <a href="{{ route('bmn.print', $ruangan) }}" target="_blank"
                  class="block px-3 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                  Cetak Semua Data
              </a>
          </li>
      </ul>
  </div>
</div>

{{-- Filter dan Pencarian --}}
<div x-data="{ open: false }"
  class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mx-6 mb-8 border border-border-light dark:border-border-dark">

  {{-- Header Filter --}}
  <div class="flex justify-between items-center mb-3">
    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Filter & Pencarian</h2>
    <button 
      type="button" 
      @click="open = !open"
      class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
      <i class="fa-solid fa-filter mr-2"></i>
      <span x-text="open ? 'Tutup Filter' : 'Buka Filter'"></span>
    </button>
  </div>

  {{-- Isi Filter --}}
  <div 
    x-show="open"
    x-transition
    class="mt-4 border-t border-border-light dark:border-border-dark pt-5">

    <form method="GET" action="{{ route('bmn.search', $ruangan) }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      
      {{-- Cari Barang --}}
      <div>
        <label for="search" class="block text-sm font-medium text-text-light-secondary dark:text-text-dark-secondary mb-1">Cari Barang</label>
        <input type="text" id="search" name="search" value="{{ request('search') }}"
          placeholder="Nama / Kode Barang"
          class="w-full bg-slate-50 dark:bg-slate-800 border border-border-light dark:border-border-dark rounded text-sm focus:ring-primary focus:border-primary p-2.5" />
      </div>

      {{-- Tahun Pengadaan --}}
      <div>
        <label for="tahun_pengadaan" class="block text-sm font-medium text-text-light-secondary dark:text-text-dark-secondary mb-1">Tahun Pengadaan</label>
        <input type="text" id="tahun_pengadaan" name="tahun_pengadaan" value="{{ request('tahun_pengadaan') }}"
          placeholder="2023"
          class="w-full bg-slate-50 dark:bg-slate-800 border border-border-light dark:border-border-dark rounded text-sm focus:ring-primary focus:border-primary p-2.5" />
      </div>

      {{-- Kondisi --}}
      <div>
        <label for="kondisi" class="block text-sm font-medium text-text-light-secondary dark:text-text-dark-secondary mb-1">Kondisi</label>
        <select id="kondisi" name="kondisi"
          class="w-full bg-slate-50 dark:bg-slate-800 border border-border-light dark:border-border-dark rounded text-sm focus:ring-primary focus:border-primary p-2.5">
          <option value="">Semua</option>
          <option value="Sangat Baik" {{ request('kondisi') == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
          <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
          <option value="Kurang Baik" {{ request('kondisi') == 'Kurang Baik' ? 'selected' : '' }}>Kurang Baik</option>
          <option value="Rusak / Cacat" {{ request('kondisi') == 'Rusak / Cacat' ? 'selected' : '' }}>Rusak / Cacat</option>
        </select>
      </div>

      {{-- Kategori --}}
      <div>
        <label for="kategori" class="block text-sm font-medium text-text-light-secondary dark:text-text-dark-secondary mb-1">Kategori</label>
        <input type="text" id="kategori" name="kategori" value="{{ request('kategori') }}"
          placeholder="Kamera / Laptop"
          class="w-full bg-slate-50 dark:bg-slate-800 border border-border-light dark:border-border-dark rounded text-sm focus:ring-primary focus:border-primary p-2.5" />
      </div>

      {{-- Asal Pengadaan --}}
      <div>
        <label for="asal_pengadaan" class="block text-sm font-medium text-text-light-secondary dark:text-text-dark-secondary mb-1">Asal Pengadaan</label>
        <input type="text" id="asal_pengadaan" name="asal_pengadaan" value="{{ request('asal_pengadaan') }}"
          placeholder="APBN / Hibah"
          class="w-full bg-slate-50 dark:bg-slate-800 border border-border-light dark:border-border-dark rounded text-sm focus:ring-primary focus:border-primary p-2.5" />
      </div>

      {{-- Posisi Barang --}}
      <div>
        <label for="posisi_barang" class="block text-sm font-medium text-text-light-secondary dark:text-text-dark-secondary mb-1">Posisi Barang</label>
        <input type="text" id="posisi_barang" name="posisi_barang" value="{{ request('posisi_barang') }}"
          placeholder="Rak / Studio 1"
          class="w-full bg-slate-50 dark:bg-slate-800 border border-border-light dark:border-border-dark rounded text-sm focus:ring-primary focus:border-primary p-2.5" />
      </div>

      {{-- Peruntukan --}}
      <div>
        <label for="peruntukan" class="block text-sm font-medium text-text-light-secondary dark:text-text-dark-secondary mb-1">Peruntukan</label>
        <input type="text" id="peruntukan" name="peruntukan" value="{{ request('peruntukan') }}"
          placeholder="Studio / Kantor"
          class="w-full bg-slate-50 dark:bg-slate-800 border border-border-light dark:border-border-dark rounded text-sm focus:ring-primary focus:border-primary p-2.5" />
      </div>

      {{-- Nomor Seri --}}
      <div>
        <label for="nomor_seri" class="block text-sm font-medium text-text-light-secondary dark:text-text-dark-secondary mb-1">Nomor Seri</label>
        <input type="text" id="nomor_seri" name="nomor_seri" value="{{ request('nomor_seri') }}"
          placeholder="SN12345"
          class="w-full bg-slate-50 dark:bg-slate-800 border border-border-light dark:border-border-dark rounded text-sm focus:ring-primary focus:border-primary p-2.5" />
      </div>

      {{-- Merk --}}
      <div class="col-span-1 md:col-span-2 lg:col-span-4">
        <label for="merk" class="block text-sm font-medium text-text-light-secondary dark:text-text-dark-secondary mb-1">Merk</label>
        <input type="text" id="merk" name="merk" value="{{ request('merk') }}"
          placeholder="Sony / Canon"
          class="w-full max-w-xs bg-slate-50 dark:bg-slate-800 border border-border-light dark:border-border-dark rounded text-sm focus:ring-primary focus:border-primary p-2.5" />
      </div>

      {{-- Tombol --}}
      <div class="col-span-1 md:col-span-2 lg:col-span-4 mt-8 flex items-center gap-4">
        <button type="submit"
          class="bg-blue-600 text-white font-semibold px-5 py-2.5 rounded-lg flex items-center gap-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-background-light dark:focus:ring-offset-background-dark">
          <span class="material-symbols-outlined !text-xl">search</span> Filter
        </button>

        <a href="{{ route('bmn.printFiltered', [
            'ruangan' => $ruangan,
            'search' => request('search'),
            'tahun_pengadaan' => request('tahun_pengadaan'),
            'kondisi' => request('kondisi'),
            'kategori' => request('kategori'),
            'asal_pengadaan' => request('asal_pengadaan'),
            'posisi_barang' => request('posisi_barang'),
            'peruntukan' => request('peruntukan'),
            'nomor_seri' => request('nomor_seri'),
            'merk' => request('merk')
          ]) }}"
          target="_blank"
          class="text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-green-600 dark:hover:bg-green-700">
          <i class="fa-solid fa-file-pdf mr-1"></i> Cetak PDF
        </a>
      </div>

    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

{{-- Jika tidak ada data --}}
@if ($data->isEmpty())
  <div class="text-center text-gray-500 mt-6">
    <p>Data belum tersedia.</p>
  </div>
@endif

{{-- Card Barang --}}
<div class="flex justify-center p-3 ml-3 mr-3">
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 w-full">
    @foreach ($data as $item)
      @php
        $warna = match($item->kondisi) {
          'Sangat Baik' => 'bg-green-500',
          'Baik' => 'bg-blue-500',
          'Kurang Baik' => 'bg-yellow-400',
          'Rusak / Cacat', 'Rusak', 'Cacat' => 'bg-red-500',
          default => 'bg-gray-500'
        };
      @endphp

      <div class="w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 relative">
        <a href="{{ route('bmn.show', [$ruangan, $item->id]) }}">
          <img class="w-full rounded-t-lg h-40 object-cover {{ $item->foto ? '' : 'opacity-50' }}"
              src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('img/no-image.png') }}"
              alt="{{ $item->nama_barang }}">
        </a>

       {{-- BADGE ATAS (Kategori + Status) --}}
<div class="absolute top-3 left-3 right-3 flex items-center justify-between">

    {{-- KATEGORI --}}
    <span class="bg-tvri_base_color text-white text-xs font-semibold px-2 py-[2px] rounded-full whitespace-nowrap">
        {{ $item->kategori }}
    </span>

    @php
        $penghapusan = $item->perawatan->firstWhere('jenis_perawatan', 'penghapusan');
        $rencana     = $item->perawatan->firstWhere('jenis_perawatan', 'rencana_penghapusan');
        $perawatan   = $item->perawatan->firstWhere('jenis_perawatan', 'perbaikan');
    @endphp

    {{-- STATUS --}}
    @if ($penghapusan)
        <span class="bg-red-600 text-white text-xs font-semibold px-2 py-[2px] rounded-full whitespace-nowrap">
            Penghapusan
        </span>
    @elseif ($rencana)
        <span class="bg-orange-600 text-white text-xs font-semibold px-2 py-[2px] rounded-full whitespace-nowrap">
            Rencana Penghapusan
        </span>
    @elseif ($perawatan)
        <span class="
            text-white text-xs font-semibold px-2 py-[2px] rounded-full whitespace-nowrap
            @switch($perawatan->status)
                @case('pending') bg-gray-500 @break
                @case('proses') bg-blue-600 @break
                @case('selesai') bg-green-600 @break
                @default bg-gray-600
            @endswitch
        ">
            {{ ucfirst($perawatan->status) }}
        </span>
    @endif
</div>


        <div class="p-4">
          <p class="font-semibold text-gray-900 dark:text-white text-sm truncate">{{ $item->nama_barang }}</p>
          <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Kode: {{ $item->kode_barang }}</p>

          <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mb-2">
            <div class="h-2.5 rounded-full"
                style="width: {{ $item->persentase_kondisi ?? 0 }}%; background-color:
                @switch($item->kondisi)
                    @case('Sangat Baik') green @break
                    @case('Baik') blue @break
                    @case('Kurang Baik') yellow @break
                    @case('Rusak / Cacat') red @break
                    @default gray @break
                @endswitch
            "></div>
          </div>

          <p class="text-xs text-gray-400 mb-2">Kondisi: {{ $item->persentase_kondisi ?? 0 }}%</p>

          <span class="{{ $warna }} text-white text-xs font-semibold px-2 py-0.5 rounded-full">
            {{ $item->kondisi }}
          </span>

          <div class="mt-3 flex gap-2">
            <a href="{{ route('bmn.show', [$ruangan, $item->id]) }}"
                class="inline-flex focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-1 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Detail
            </a>
            <a href="{{ route('bmn.edit', [$ruangan, $item->id]) }}"
                class="inline-flex focus:outline-none text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-1 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                Edit
            </a>
            <form action="{{ route('bmn.delete', [$ruangan, $item->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
              @csrf
              @method('DELETE')
              <button type="submit"
                  class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-2 py-1 text-center">
                  Hapus
              </button>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

{{-- Pagination --}}
<div class="p-3 ml-3 mr-3">
  {{ $data->links() }}
</div>
@endsection
