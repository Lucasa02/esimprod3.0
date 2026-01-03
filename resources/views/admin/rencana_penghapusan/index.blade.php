@extends('layouts.admin.main')

@section('content')

<div class="p-6 lg:p-10">

    {{-- HEADER SECTION --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $title ?? 'Rencana Penghapusan' }}
            </h2>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                Kelola inventaris yang ditandai untuk penghapusan aset.
            </p>
        </div>

        {{-- Tombol Cetak PDF --}}
        @if (!$data->isEmpty())
            <a href="{{ route('rencana_penghapusan.cetak_pdf') }}" target="_blank"
               class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white transition-all duration-200 bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 dark:focus:ring-red-700">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                Export PDF
            </a>
        @endif
    </div>
    
    <div class="w-full border-b border-gray-200 dark:border-gray-700 mb-8"></div>

    {{-- EMPTY STATE --}}
    @if ($data->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 text-center bg-gray-50 dark:bg-gray-800/50 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700">
             <div class="bg-white dark:bg-gray-700 rounded-full p-4 mb-4 shadow-sm">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
             </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Data Kosong</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Belum ada barang yang masuk dalam rencana penghapusan.</p>
        </div>
    @endif

    {{-- GRID CARD --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @foreach ($data as $row)
        <div class="group bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col overflow-hidden">

            {{-- FOTO & BADGE --}}
            <div class="relative h-48 bg-gray-100 overflow-hidden">
                <img src="{{ $row->barang->foto ? asset('storage/'.$row->barang->foto) : asset('img/no-image.png') }}"
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                     alt="{{ $row->barang->nama_barang }}">
                
                {{-- Status Badge di atas gambar --}}
                <div class="absolute top-3 right-3">
                     <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-white/90 backdrop-blur-sm text-gray-700 shadow-sm border border-gray-200">
                        {{ $row->barang->kode_barang }}
                    </span>
                </div>
            </div>

            <div class="p-5 flex flex-col flex-grow">
                {{-- INFORMASI BARANG --}}
                <div class="mb-4">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white line-clamp-1 mb-1" title="{{ $row->barang->nama_barang }}">
                        {{ $row->barang->nama_barang }}
                    </h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Masuk daftar penghapusan
                    </p>
                </div>

                <div class="mt-auto space-y-4">
                    
                    {{-- LOGIKA TAMPILAN BERDASARKAN STATUS SURAT --}}
                    @if($row->surat_penghapusan)
                        {{-- STATE: SURAT SUDAH ADA --}}
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-lg p-3">
                            <div class="flex items-center mb-2">
                                <div class="flex-shrink-0 bg-green-100 text-green-600 rounded-full p-1 mr-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-xs font-medium text-green-700 dark:text-green-300">Surat Terlampir</span>
                            </div>
                            
                            {{-- Form untuk Update Surat --}}
                            <form action="{{ route('rencana_penghapusan.uploadSurat', $row->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label class="block text-[10px] text-gray-500 hover:text-blue-600 cursor-pointer text-right underline decoration-dotted">
                                    Ganti file surat?
                                    <input type="file" name="surat" class="hidden" onchange="this.form.submit()" accept=".pdf,.jpg,.jpeg,.png">
                                </label>
                            </form>
                        </div>

                        {{-- TOMBOL EKSEKUSI --}}
                        <form action="{{ route('rencana_penghapusan.hapuskan', $row->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                onclick="return confirm('Konfirmasi: Barang ini akan dihapus permanen dari inventaris. Lanjutkan?')"
                                class="w-full flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-sm hover:shadow transition-colors duration-200 focus:ring-4 focus:ring-red-100">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Eksekusi Penghapusan
                            </button>
                        </form>

                    @else
                        {{-- STATE: BELUM ADA SURAT --}}
                        <div class="space-y-3">
                            <div class="flex items-center justify-between text-xs text-amber-600 bg-amber-50 dark:bg-amber-900/20 px-3 py-2 rounded-lg border border-amber-100">
                                <span class="font-medium">Menunggu Dokumen</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>

                            <form action="{{ route('rencana_penghapusan.uploadSurat', $row->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
                                @csrf
                                {{-- Styled Input File --}}
                                <div class="relative group">
                                    <input type="file" name="surat" id="file-{{ $row->id }}" 
                                           class="block w-full text-xs text-gray-500
                                           file:mr-2 file:py-2 file:px-3
                                           file:rounded-md file:border-0
                                           file:text-xs file:font-medium
                                           file:bg-gray-100 file:text-gray-700
                                           hover:file:bg-gray-200
                                           cursor-pointer focus:outline-none" 
                                           accept=".pdf,.jpg,.jpeg,.png" required>
                                </div>
                                
                                {{-- TOMBOL UPLOAD FIX --}}
                                {{-- Saya menambahkan style="background-color: #1b365d;" agar warnanya dipaksa muncul --}}
                                <button type="submit" 
                                        style="background-color: #1b365d;"
                                        class="w-full text-xs text-white hover:opacity-90 py-2 rounded-lg transition-colors font-medium">
                                    Upload & Simpan
                                </button>
                            </form>
                            
                            {{-- Disabled Button Placeholder --}}
                            <div class="opacity-50 select-none">
                                <button disabled class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">
                                    <span class="mr-2">Hapus</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </button>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

@endsection