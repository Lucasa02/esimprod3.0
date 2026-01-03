@extends('layouts.admin.main')

@section('content')
<div class="max-w-3xl mx-auto animate-fade-in">

    {{-- Card --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm
                border border-gray-100 dark:border-gray-700
                transition-all duration-300 hover:shadow-md">

        {{-- Header --}}
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
            <h2 class="flex items-center gap-2 text-lg font-semibold text-gray-800 dark:text-gray-100">
                {{-- Heroicon: Wrench --}}
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.8"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M14.7 6.3a1 1 0 010 1.4l-8.6 8.6a2 2 0 01-2.8 0l-.6-.6a2 2 0 010-2.8l8.6-8.6a1 1 0 011.4 0z"/>
                </svg>
                Selesaikan Perbaikan
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Lengkapi data perbaikan sebelum menyelesaikan proses
            </p>
        </div>

        {{-- Content --}}
        <div class="p-6 space-y-6">

            {{-- Info Barang --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div class="flex items-start gap-2">
                    {{-- Icon --}}
                    <svg class="w-4 h-4 mt-1 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.8"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 7h18M3 12h18M3 17h18"/>
                    </svg>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Nama Barang</p>
                        <p class="font-medium text-gray-800 dark:text-gray-100">
                            {{ $data->barang->nama_barang }}
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-2">
                    {{-- Icon --}}
                    <svg class="w-4 h-4 mt-1 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.8"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8 7V3m8 4V3M3 11h18"/>
                    </svg>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Tanggal Perawatan</p>
                        <p class="font-medium text-gray-800 dark:text-gray-100">
                            {{ $data->tanggal_perawatan }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form action="{{ route('perawatan_inventaris.selesaiSubmit', $data->id) }}"
                  method="POST" enctype="multipart/form-data"
                  class="space-y-5">
                @csrf

                {{-- Deskripsi --}}
                <div class="group">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        <svg class="w-4 h-4 text-gray-400 group-focus-within:text-emerald-500 transition"
                             fill="none" stroke="currentColor" stroke-width="1.8"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                        </svg>
                        Deskripsi Perbaikan
                    </label>
                    <textarea name="deskripsi" rows="4" required
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 
                               bg-gray-50 dark:bg-gray-700 
                               text-gray-800 dark:text-gray-100
                               focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                               transition text-sm p-3">{{ old('deskripsi') }}</textarea>
                </div>

                {{-- Biaya --}}
                <div class="group">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        <svg class="w-4 h-4 text-gray-400 group-focus-within:text-emerald-500 transition"
                             fill="none" stroke="currentColor" stroke-width="1.8"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8c-1.1 0-2 .9-2 2s.9 2 2 2 2 .9 2 2-.9 2-2 2m0-10v1m0 10v1"/>
                        </svg>
                        Biaya Perbaikan
                    </label>
                    <input type="number" name="biaya" required
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 
                               bg-gray-50 dark:bg-gray-700 
                               text-gray-800 dark:text-gray-100
                               focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                               transition text-sm p-3">
                </div>

                {{-- Foto --}}
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.8"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 7h18M5 7l2-3h10l2 3"/>
                        </svg>
                        Foto Bukti <span class="text-gray-400">(Opsional)</span>
                    </label>
                    <input type="file" name="foto_bukti"
                        class="w-full text-sm text-gray-600 dark:text-gray-300
                               file:mr-4 file:py-2 file:px-4
                               file:rounded-lg file:border-0
                               file:bg-gray-100 file:text-gray-700
                               hover:file:bg-gray-200 transition
                               dark:file:bg-gray-600 dark:file:text-gray-200">
                </div>

                {{-- Action --}}
                <div class="flex justify-between items-center pt-6 border-t border-gray-100 dark:border-gray-700">
                    <a href="{{ route('perawatan_inventaris.index') }}"
                        class="flex items-center gap-2 px-5 py-2 rounded-lg text-sm font-medium
                               text-gray-600 dark:text-gray-300
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               transition hover:-translate-x-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 19l-7-7 7-7"/>
                        </svg>
                        Kembali
                    </a>

                    <button type="submit"
                        class="flex items-center gap-2 px-6 py-2 rounded-lg text-sm font-semibold
                               bg-emerald-600 hover:bg-emerald-700
                               text-black transition
                               hover:-translate-y-0.5 shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan & Selesaikan
                
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
