@extends('layouts.admin.main')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
        <div>
            <h2 class="text-2xl font-light tracking-tight text-slate-800 dark:text-white">
                Arsip <span class="font-bold text-[#1b365d] dark:text-indigo-400">Penghapusan Barang</span>
            </h2>
            <p class="text-sm text-slate-500 mt-1">Daftar aset yang telah dikeluarkan dari sistem operasional.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <a href="{{ route('penghapusan.cetak.pdf') }}" 
               target="_blank" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 font-medium rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-all duration-300 shadow-sm hover:shadow-md">
                <i class="fa-solid fa-file-pdf text-red-500"></i>
                <span class="text-sm font-semibold">Export PDF</span>
            </a>
        </div>
    </div>

    {{-- Empty State --}}
    @if ($data->isEmpty())
    <div class="flex flex-col items-center justify-center py-20 bg-white dark:bg-slate-800 rounded-3xl border border-dashed border-slate-300 dark:border-slate-700">
        <div class="bg-slate-100 dark:bg-slate-700 p-4 rounded-full mb-4">
            <i class="fa-solid fa-box-open text-3xl text-slate-400"></i>
        </div>
        <p class="text-slate-500 dark:text-slate-400 font-medium">Belum ada riwayat penghapusan.</p>
    </div>
    @endif

    {{-- GRID DATA --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @foreach($data as $row)
        <div class="group bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-slate-200/50 dark:hover:shadow-none hover:-translate-y-2">
            
            {{-- Foto Section --}}
            <div class="relative overflow-hidden h-44">
                <img 
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 {{ $row->barang->foto ? '' : 'grayscale opacity-30' }}"
                    src="{{ $row->barang->foto ? asset('storage/'.$row->barang->foto) : asset('img/no-image.png') }}"
                    alt="Foto Barang"
                >
                {{-- Overlay Halus saat Hover --}}
                <div class="absolute inset-0 bg-gradient-to-t from-[#1b365d]/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                
                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-md text-[#1b365d] text-[10px] uppercase tracking-widest font-bold px-2.5 py-1 rounded-lg shadow-sm">
                    Dihapus
                </span>
            </div>

            {{-- Info Section --}}
            <div class="p-5">
                <div class="mb-4">
                    <h3 class="font-bold text-slate-800 dark:text-white text-sm leading-tight truncate transition-colors duration-300">
                        {{ $row->barang->nama_barang ?? 'Tanpa Nama' }}
                    </h3>
                    <p class="text-[11px] font-medium text-slate-400 uppercase tracking-tighter mt-1">
                        ID: {{ $row->barang->kode_barang }}
                    </p>
                </div>

                <div class="flex items-center justify-between mb-4 pb-4 border-b border-slate-50 dark:border-slate-700">
                    <div class="flex flex-col">
                        <span class="text-[10px] text-slate-400 uppercase tracking-wide">Tanggal Hapus</span>
                        <span class="text-xs font-semibold text-slate-600 dark:text-slate-300">
                            {{ $row->created_at->format('d M, Y') }}
                        </span>
                    </div>
                </div>

                {{-- Action --}}
                @if($row->surat_penghapusan)
                    <a href="{{ asset('storage/' . $row->surat_penghapusan) }}" 
                       target="_blank"
                       class="flex items-center justify-center gap-2 w-full py-2.5 bg-slate-900 text-white text-xs font-bold rounded-xl transition-all duration-300 hover:bg-[#1b365d] hover:shadow-lg hover:shadow-indigo-900/20 active:scale-95">
                        <i class="fa-solid fa-file-lines opacity-70"></i>
                        Lihat Dokumen
                    </a>
                @else
                    <button disabled
                        class="w-full py-2.5 bg-slate-50 dark:bg-slate-700 text-slate-400 text-[10px] font-bold rounded-xl cursor-not-allowed italic">
                        Dokumen Belum Tersedia
                    </button>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    /* Halus transition untuk seluruh elemen interaktif */
    * {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
@endsection