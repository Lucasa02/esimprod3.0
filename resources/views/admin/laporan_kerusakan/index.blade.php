@extends('layouts.admin.main')

@section('content')

<div class="px-6 py-6">
    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Laporan Kerusakan</h2>
            <p class="text-sm text-slate-500">Daftar permintaan perbaikan aset yang memerlukan persetujuan.</p>
        </div>
        
        {{-- TOMBOL CETAK PDF UTAMA --}}
        <a href="{{ route('admin.laporan-kerusakan.export-pdf') }}" 
        target="_blank" 
        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-red-600 rounded-xl shadow-md hover:bg-red-700 transition-all duration-200 ease-in-out transform hover:-translate-y-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak Rekap PDF
        </a>
    </div>

    {{-- Jika tidak ada data --}}
    @if ($laporan->isEmpty())
        <div class="flex flex-col items-center justify-center py-12 bg-white rounded-2xl border border-dashed border-gray-300">
            <p class="text-gray-500">Belum ada laporan kerusakan.</p>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-full">
        @foreach ($laporan as $l)
    @php
        $statusColor = match ($l->status) {
            'pending' => 'bg-yellow-500',
            'disetujui' => 'bg-green-600',
            'ditolak' => 'bg-red-600',
            default => 'bg-gray-500',
        };
    @endphp

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 dark:bg-gray-800 dark:border-gray-700 overflow-hidden relative group">
    
    {{-- FOTO BARANG --}}
    <div class="relative overflow-hidden">
        <img class="w-full h-44 object-cover transform transition-transform duration-500 group-hover:scale-110"
             src="{{ $l->barang->foto ? asset('storage/' . $l->barang->foto) : asset('img/no-image.png') }}"
             alt="{{ $l->barang->nama_barang }}">
        
        {{-- STATUS OVERLAY - Gunakan warna yang lebih gelap agar teks putih terbaca --}}
        <div class="absolute top-3 left-3">
            <span class="inline-block bg-slate-900/80 backdrop-blur-md text-white text-[10px] uppercase tracking-wider font-bold px-2 py-1 rounded-md shadow-sm">
                {{ $l->barang->kategori }}
            </span>
        </div>
        <div class="absolute top-3 right-3">
            <span class="{{ $statusColor }} text-white text-[10px] uppercase tracking-wider font-bold px-2 py-1 rounded-md shadow-sm">
                {{ $l->status }}
            </span>
        </div>
    </div>

    <div class="p-4">
        <h3 class="font-bold text-gray-900 dark:text-white text-base truncate mb-1">
            {{ $l->barang->nama_barang }}
        </h3>
        <p class="text-xs text-red-500 font-medium mb-2 italic">
            ⚠ {{ $l->jenis_kerusakan }}
        </p>
        <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2 mb-4 h-8">
            {{ $l->deskripsi ?? 'Tidak ada deskripsi.' }}
        </p>

        <div class="flex items-center">
            {{-- Tombol Detail - Gunakan warna biru tua yang standar jika custom hex gagal --}}
            <a href="{{ route('admin.laporan-kerusakan.detail', $l->uuid) }}"
               class="w-full block text-center bg-[#1b365d] hover:bg-slate-800 text-white text-xs font-bold py-2.5 rounded-lg transition-all duration-200 shadow-sm">
                Detail Laporan
            </a>
        </div>
    </div>
</div>
@endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $laporan->links() }}
    </div>
</div>

@endsection