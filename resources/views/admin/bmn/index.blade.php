@extends('layouts.admin.main')

@section('content')
{{-- Opsi / Dropdown --}}
<div class="flex items-center ml-6 mr-3 mb-3">
    <button id="dropdownRightButton" data-dropdown-toggle="dropdownRight" data-dropdown-placement="right"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
        type="button" title="Menu">
        <i class="fa-solid fa-gear mr-2"></i> Opsi
    </button>

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
                    Cetak Data BMN
                </a>
            </li>
        </ul>
    </div>
</div>

{{-- Form Pencarian --}}
<form class="flex items-center max-w-sm mx-auto ml-6 mr-3 mb-3" action="{{ route('bmn.search', $ruangan) }}" method="GET">
    <label for="search" class="sr-only">Search</label>
    <div class="w-full relative">
        <input type="text" id="search" name="search" autocomplete="off"
            value="{{ request('search') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Cari nama / kode barang + Enter" />
        <svg class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-tvri_base_color" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
    </div>
</form>

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
                // Warna kondisi
                $warna = match($item->kondisi) {
                    'Sangat Baik' => 'bg-green-500',
                    'Baik' => 'bg-lime-500',
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

                {{-- Kategori --}}
                <span class="absolute top-3 left-3 bg-tvri_base_color text-white text-xs font-semibold px-2 py-0.5 rounded-full">
                    {{ $item->kategori }}
                </span>

                <div class="p-4">
                    <p class="font-semibold text-gray-900 dark:text-white text-sm truncate">{{ $item->nama_barang }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Kode: {{ $item->kode_barang }}</p>

                    {{-- Persentase Kondisi --}}
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mb-2">
                        <div class="h-2.5 rounded-full" style="width: {{ $item->persentase_kondisi ?? 0 }}%; background-color:
                            @switch($item->kondisi)
                                @case('Sangat Baik') green @break
                                @case('Baik') lime @break
                                @case('Kurang Baik') yellow @break
                                @case('Rusak / Cacat') red @break
                                @default gray @break
                            @endswitch
                        "></div>
                    </div>
                    <p class="text-xs text-gray-400 mb-2">Kondisi: {{ $item->persentase_kondisi ?? 0 }}%</p>

                    {{-- Status Kondisi --}}
                    <span class="{{ $warna }} text-white text-xs font-semibold px-2 py-0.5 rounded-full">
                        {{ $item->kondisi }}
                    </span>

                    {{-- Tombol aksi --}}
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
