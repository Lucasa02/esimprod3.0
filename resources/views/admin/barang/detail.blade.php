@extends('layouts.admin.main')

@section('content')
<div class="font-display bg-background-light dark:bg-background-dark min-h-screen">
  <div class="flex">
    <main class="flex-1 p-4 sm:p-6 lg:p-8">
      <div class="max-w-7xl mx-auto">

        <div class="flex flex-wrap gap-2 mb-6">
          <a href="{{ route('barang.index') }}" class="text-gray-500 dark:text-[#9dabb9] text-sm font-medium hover:text-primary dark:hover:text-white">Barang</a>
          <span class="text-gray-500 dark:text-[#9dabb9] text-sm font-medium">/</span>
          <span class="text-gray-800 dark:text-white text-sm font-medium">{{ $barang->nama_barang }}</span>
        </div>

        <div class="flex flex-wrap justify-between items-start gap-4 mb-8">
          <div class="flex min-w-72 flex-col gap-3">
            <p class="text-gray-900 dark:text-white text-3xl lg:text-4xl font-black leading-tight tracking-[-0.033em]">
              {{ $barang->nama_barang }}
            </p>
            <p class="text-gray-500 dark:text-[#9dabb9] text-base font-normal">
              Detail lengkap barang.
            </p>
          </div>

          <div class="flex flex-wrap gap-3">
            
            {{-- TOMBOL LIHAT SURAT (Hanya muncul jika status Perbaikan dan ada suratnya) --}}
            @php
                // Mengambil surat terakhir yang diupload untuk barang ini
                $suratTerbaru = $barang->surat()->latest()->first();
                $suratDitemukan = $barang->surat()
                                ->where('nama_file', 'LIKE', '%_DITEMUKAN_%')
                                ->latest()
                                ->first();
            @endphp

            @if($barang->status == 'perbaikan' && $suratTerbaru)
                <a href="{{ asset('uploads/surat/' . $suratTerbaru->nama_file) }}" target="_blank"
                class="flex min-w-[84px] items-center justify-center gap-2 rounded-lg h-10 px-4 bg-yellow-500 text-white text-sm font-bold hover:bg-yellow-600 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-base">description</span>
                <span>Lihat Surat Perbaikan</span>
                </a>
            @endif

            {{-- TAMBAHAN: Tombol Lihat Surat Ditemukan --}}
            @if($barang->status == 'ditemukan' && $suratDitemukan)
                <a href="{{ asset('uploads/surat/' . $suratDitemukan->nama_file) }}" target="_blank"
                class="flex min-w-[84px] items-center justify-center gap-2 rounded-lg h-10 px-4 bg-blue-600 text-white text-sm font-bold hover:bg-blue-700 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-base">verified</span>
                <span>Bukti Ditemukan</span>
                </a>
            @endif
            {{-- --------------------------------------------------------------------- --}}

            <a href="{{ route('barang.edit', $barang->uuid) }}"
              class="flex min-w-[84px] items-center justify-center gap-2 rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-opacity-90 transition-colors">
              <span class="material-symbols-outlined text-base">edit</span>
              <span>Edit Item</span>
            </a>

            <a href="{{ asset('storage/uploads/qr_codes_barang/' . $barang->qr_code) }}" target="_blank"
              class="flex min-w-[84px] items-center justify-center gap-2 rounded-lg h-10 px-4 bg-gray-200 dark:bg-white/10 text-gray-800 dark:text-white text-sm font-bold hover:bg-gray-300 dark:hover:bg-white/20 transition-colors">
              <span class="material-symbols-outlined text-base">qr_code_scanner</span>
              <span>Print QR Code</span>
            </a>

            <form action="{{ route('barang.destroy', $barang->uuid) }}" method="POST"
              onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="flex min-w-[84px] items-center justify-center gap-2 rounded-lg h-10 px-4 text-red-500 hover:bg-red-500/10 text-sm font-bold transition-colors">
                <span class="material-symbols-outlined text-base">delete</span>
                <span>Delete Item</span>
              </button>
            </form>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

          <div class="lg:col-span-2 space-y-8">
            <div class="bg-white dark:bg-[#1a232c] p-6 rounded-xl border border-gray-200 dark:border-gray-800">
              <h3 class="text-gray-900 dark:text-white text-lg font-bold mb-4">Deskripsi</h3>
              <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                {{ $barang->deskripsi ?? 'Tidak ada deskripsi.' }}
              </p>
            </div>

            <div class="bg-white dark:bg-[#1a232c] p-6 rounded-xl border border-gray-200 dark:border-gray-800">
              <h3 class="text-gray-900 dark:text-white text-lg font-bold mb-6">Detail Barang</h3>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6">
                
                {{-- Bagian Status dengan Badge --}}
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Status</p>
                  
                  @if ($barang->status == 'tersedia')
                      <span class="inline-flex items-center rounded-full bg-green-100 dark:bg-green-500/20 px-3 py-1 text-sm font-medium text-green-800 dark:text-green-300">
                        <span class="material-symbols-outlined text-sm mr-1">check_circle</span> Tersedia
                      </span>
                  @elseif ($barang->status == 'perbaikan')
                      <span class="inline-flex items-center rounded-full bg-yellow-100 dark:bg-yellow-500/20 px-3 py-1 text-sm font-medium text-yellow-800 dark:text-yellow-300">
                        <span class="material-symbols-outlined text-sm mr-1">build</span> Perbaikan
                      </span>
                  @elseif ($barang->status == 'ditemukan')
                      <span class="inline-flex items-center rounded-full bg-blue-100 dark:bg-blue-500/20 px-3 py-1 text-sm font-medium text-blue-800 dark:text-blue-300">
                        <span class="material-symbols-outlined text-sm mr-1">check_circle</span> Ditemukan
                      </span>
                  @elseif ($barang->status == 'tidak-tersedia')
                      <span class="inline-flex items-center rounded-full bg-red-100 dark:bg-red-500/20 px-3 py-1 text-sm font-medium text-red-800 dark:text-red-300">
                        <span class="material-symbols-outlined text-sm mr-1">cancel</span> Tidak Tersedia/Rusak
                      </span>
                  @else
                      <span class="inline-flex items-center rounded-full bg-gray-100 dark:bg-gray-700 px-3 py-1 text-sm font-medium text-gray-800 dark:text-gray-300">
                        {{ $barang->status }}
                      </span>
                  @endif
                </div>
                {{-- End Status --}}

                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Kode Barang</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->kode_barang }}</p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nomor Seri</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->nomor_seri ?? '-' }}</p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Merk</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->merk }}</p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Limit</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->limit }}</p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Sisa Limit</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->sisa_limit }}</p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Jenis Barang</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->jenisBarang->jenis_barang }}</p>
                </div>
                
                {{-- Pindahkan Kondisi ke sini agar layout seimbang --}}
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Kondisi</p>
                    <span class="text-sm font-medium text-gray-800 dark:text-gray-200">
                         {{-- Sesuaikan logika kondisi jika ada kolom kondisi di DB, jika tidak hapus --}}
                         {{ $barang->kondisi ?? '-' }}
                    </span>
                 </div>

              </div>
            </div>
          </div>

          <div class="lg:col-span-1 space-y-8">
              <div class="bg-white dark:bg-[#1a232c] p-6 rounded-xl border border-gray-200 dark:border-gray-800 flex flex-col items-center">
                  <h3 class="text-gray-900 dark:text-white text-lg font-bold mb-4">Foto Barang</h3>
                  <div class="w-full aspect-square rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800 flex items-center justify-center relative">
                      @if ($barang->foto)
                          <img src="{{ asset('storage/uploads/foto_barang/' . $barang->foto) }}" 
                              alt="{{ $barang->nama_barang }}" 
                              class="object-cover w-full h-full">
                      @else
                          <span class="text-gray-400 text-sm">Tidak ada foto</span>
                      @endif
                      
                      {{-- Tambahan Badge di Foto Detail (Opsional) --}}
                      <span class="absolute top-2 left-2 bg-primary text-white text-xs font-bold px-2 py-1 rounded shadow">
                        {{ $barang->jenisBarang->jenis_barang }}
                      </span>
                  </div>
              </div>

              <div class="bg-white dark:bg-[#1a232c] p-6 rounded-xl border border-gray-200 dark:border-gray-800 flex flex-col items-center">
                  <h3 class="text-gray-900 dark:text-white text-lg font-bold mb-4">QR Code</h3>
                  <div class="w-full aspect-square rounded-lg bg-white flex items-center justify-center border border-gray-100">
                    @if($barang->qr_code)
                      <img src="{{ asset('storage/uploads/qr_codes_barang/' . $barang->qr_code) }}" 
                        alt="QR Code {{ $barang->kode_barang }}" 
                        class="object-contain w-3/4 h-3/4">
                    @else
                        <span class="text-gray-400 text-xs">QR Code belum digenerate</span>
                    @endif
                  </div>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-4 text-center">Scan untuk lihat detail</p>
              </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
@endsection

{{-- Script tetap sama --}}
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    primary: "#137fec",
                    background: {
                        light: "#f6f7f8",
                        dark: "#101922",
                    }
                },
                fontFamily: {
                    display: ["Inter", "sans-serif"]
                },
            },
        },
    }
</script>
<style>
    .material-symbols-outlined {
        font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24
    }
</style>