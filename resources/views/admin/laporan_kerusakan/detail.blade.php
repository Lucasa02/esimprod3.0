@extends('layouts.admin.main')

@section('content')
<div class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Detail Laporan</h2>
                <p class="text-sm text-slate-500 mt-1">Informasi lengkap mengenai kerusakan aset barang.</p>
            </div>
            <a href="{{ route('admin.laporan-kerusakan.index') }}" 
               class="group inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-full shadow-sm hover:bg-slate-50 hover:text-slate-900 hover:border-slate-300 hover:shadow-md transition-all duration-300 ease-out">
                <span class="transform transition-transform duration-300 group-hover:-translate-x-1">←</span>
                Kembali ke Daftar
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Nama Barang</label>
                            <p class="text-lg font-medium text-slate-800">{{ $laporan->barang->nama_barang }}</p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Jenis Kerusakan</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-50 text-amber-700 border border-amber-100">
                                {{ $laporan->jenis_kerusakan }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Deskripsi Masalah</label>
                            <p class="text-slate-600 leading-relaxed text-sm bg-slate-50 p-4 rounded-xl border border-slate-100 italic">
                                "{{ $laporan->deskripsi }}"
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col items-center justify-center">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-3 self-start">Bukti Foto</label>
                        @if ($laporan->foto)
                            <div class="group relative overflow-hidden rounded-2xl ring-1 ring-slate-200 transition-all hover:ring-indigo-300 shadow-sm w-full">
                                <img src="{{ asset('storage/'.$laporan->foto) }}" 
                                     class="w-full h-64 object-cover transform transition-transform duration-700 group-hover:scale-110"
                                     alt="Foto Kerusakan">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        @else
                            <div class="w-full h-64 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-xs">Tidak ada foto terlampir</p>
                            </div>
                        @endif
                    </div>
                </div>

                <hr class="my-8 border-slate-100">

                <div class="flex items-center justify-end gap-4">
                    
                    <form action="{{ route('admin.laporan-kerusakan.tolak', $laporan->uuid) }}" method="POST">
                        @csrf
                        <button class="px-6 py-2.5 text-sm font-semibold text-rose-600 bg-white border border-rose-200 rounded-full shadow-sm hover:bg-rose-50 hover:border-rose-300 hover:text-rose-700 hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-300 ease-out focus:ring-4 focus:ring-rose-100">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                Tolak Laporan
                            </span>
                        </button>
                    </form>

                    <form action="{{ route('admin.laporan-kerusakan.setujui', $laporan->uuid) }}" method="POST">
                        @csrf
                        <button class="px-8 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-slate-800 to-slate-900 rounded-full shadow-lg shadow-slate-300 hover:from-emerald-500 hover:to-emerald-600 hover:shadow-emerald-300 hover:shadow-xl transform hover:-translate-y-0.5 hover:scale-105 transition-all duration-300 ease-out focus:ring-4 focus:ring-slate-200">
                            <span class="flex items-center gap-2">
                                Setujui & Proses
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>
                    </form>
                </div>
                </div>
        </div>
    </div>
</div>
@endsection