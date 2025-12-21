@extends('layouts.admin.main')

@section('content')

{{-- Jika tidak ada data --}}
@if ($laporan->isEmpty())
    <div class="text-center text-gray-500 mt-6">
        <p>Belum ada laporan kerusakan.</p>
    </div>
@endif

<div class="flex justify-center px-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 w-full">

        @foreach ($laporan as $l)

            @php
                // Warna status
                $statusColor = match ($l->status) {
                    'pending' => 'bg-yellow-500',
                    'disetujui' => 'bg-green-600',
                    'ditolak' => 'bg-red-600',
                    default => 'bg-gray-500',
                };
            @endphp

            <div class="w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 relative">

                {{-- HEADER FOTO BARANG --}}
                <a href="{{ route('admin.laporan-kerusakan.detail', $l->uuid) }}">
                    <img
                        class="w-full rounded-t-lg h-40 object-cover {{ $l->barang->foto ? '' : 'opacity-50' }}"
                        src="{{ $l->barang->foto ? asset('storage/' . $l->barang->foto) : asset('img/no-image.png') }}"
                        alt="{{ $l->barang->nama_barang }}">
                </a>

                {{-- BADGE ATAS --}}
                <div class="absolute top-3 left-3 right-3 flex items-center justify-between">
                    <span class="bg-blue-600 text-white text-xs font-semibold px-2 py-[2px] rounded-full">
                        {{ $l->barang->kategori }}
                    </span>

                    {{-- STATUS --}}
                    <span class="{{ $statusColor }} text-white text-xs font-semibold px-2 py-[2px] rounded-full">
                        {{ ucfirst($l->status) }}
                    </span>
                </div>

                <div class="p-4">

                    {{-- Nama barang --}}
                    <p class="font-semibold text-gray-900 dark:text-white text-sm truncate">
                        {{ $l->barang->nama_barang }}
                    </p>

                    {{-- Jenis kerusakan --}}
                    <p class="text-xs text-gray-500 dark:text-gray-400 italic mb-2">
                        Kerusakan: {{ $l->jenis_kerusakan }}
                    </p>

                    {{-- DESKRIPSI --}}
                    <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2 mb-3">
                        {{ $l->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </p>

                    {{-- Tombol --}}
                    <div class="flex gap-2">
                        <a href="{{ route('admin.laporan-kerusakan.detail', $l->uuid) }}"
                            class="inline-flex text-white bg-green-700 hover:bg-green-800 focus:ring-4 
                                   focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1 dark:bg-green-600 
                                   dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Detail
                        </a>

                        {{-- Jika butuh tombol Edit / Hapus tinggal tambahkan --}}
                        {{-- <button ...> --}}
                    </div>

                </div>
            </div>

        @endforeach

    </div>
</div>

{{-- Pagination --}}
<div class="p-3 ml-3 mr-3">
    {{ $laporan->links() }}
</div>

@endsection
