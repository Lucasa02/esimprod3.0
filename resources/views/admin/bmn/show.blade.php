@extends('layouts.admin.main')

@section('content')
<div class="font-display bg-background-light dark:bg-background-dark min-h-screen">
  <div class="flex">
    <main class="flex-1 p-4 sm:p-6 lg:p-8">
      <div class="max-w-7xl mx-auto">

        {{-- Breadcrumbs --}}
        <div class="flex flex-wrap gap-2 mb-6">
          <a href="{{ route('bmn.index', $ruangan) }}" class="text-gray-500 dark:text-[#9dabb9] text-sm font-medium hover:text-primary dark:hover:text-white">Home</a>
          <span class="text-gray-500 dark:text-[#9dabb9] text-sm font-medium">/</span>
          <a href="{{ route('bmn.index', $ruangan) }}" class="text-gray-500 dark:text-[#9dabb9] text-sm font-medium hover:text-primary dark:hover:text-white">
            {{ ucfirst($ruangan) }}
          </a>
          <span class="text-gray-500 dark:text-[#9dabb9] text-sm font-medium">/</span>
          <span class="text-gray-800 dark:text-white text-sm font-medium">{{ $barang->nama_barang }}</span>
        </div>

        {{-- Header & Actions --}}
        <div class="flex flex-wrap justify-between items-start gap-4 mb-8">
          <div class="flex min-w-72 flex-col gap-3">
            <p class="text-gray-900 dark:text-white text-3xl lg:text-4xl font-black leading-tight tracking-[-0.033em]">
              {{ $barang->nama_barang }}
            </p>
            <p class="text-gray-500 dark:text-[#9dabb9] text-base font-normal">
              Detail lengkap barang inventaris BMN.
            </p>
          </div>

          <div class="flex flex-wrap gap-3">
            <a href="{{ route('bmn.edit', [$ruangan, $barang->id]) }}"
              class="flex min-w-[84px] items-center justify-center gap-2 rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-opacity-90 transition-colors">
              <span class="material-symbols-outlined text-base">edit</span>
              <span>Edit</span>
            </a>

            <a href="{{ asset('storage/' . $barang->qr_code) }}" target="_blank"
              class="flex min-w-[84px] items-center justify-center gap-2 rounded-lg h-10 px-4 bg-gray-200 dark:bg-white/10 text-gray-800 dark:text-white text-sm font-bold hover:bg-gray-300 dark:hover:bg-white/20 transition-colors">
              <span class="material-symbols-outlined text-base">qr_code_scanner</span>
              <span>Print QR</span>
            </a>

            <form action="{{ route('bmn.delete', [$ruangan, $barang->id]) }}" method="POST"
              onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="flex min-w-[84px] items-center justify-center gap-2 rounded-lg h-10 px-4 text-red-500 hover:bg-red-500/10 text-sm font-bold transition-colors">
                <span class="material-symbols-outlined text-base">delete</span>
                <span>Hapus</span>
              </button>
            </form>

            <form action="{{ route('perawatan_inventaris.storeFromBarang', $barang->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex min-w-[84px] items-center justify-center gap-2 rounded-lg h-10 px-4 bg-yellow-500 text-white text-sm font-bold hover:bg-yellow-600 transition-colors">
                    <span class="material-symbols-outlined text-base">home_repair_service</span>
                    <span>Perawatan</span>
                </button>
            </form>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

          {{-- Kolom Kiri: Detail Informasi --}}
          <div class="lg:col-span-2 space-y-8">
            
            {{-- Deskripsi --}}
            <div class="bg-white dark:bg-[#1a232c] p-6 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm">
              <h3 class="text-gray-900 dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">notes</span> Deskripsi / Catatan
              </h3>
              <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                {{ $barang->catatan ?? 'Tidak ada deskripsi tambahan.' }}
              </p>
            </div>

            {{-- Detail Informasi Dasar --}}
            <div class="bg-white dark:bg-[#1a232c] p-6 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm">
              <h3 class="text-gray-900 dark:text-white text-lg font-bold mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">info</span> Detail Barang & Spesifikasi
              </h3>
              
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6">
                
                {{-- Lokasi Utama --}}
                <div class="col-span-1 sm:col-span-2 bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-100 dark:border-blue-800">
                    <p class="text-xs font-bold text-blue-600 dark:text-blue-300 mb-1 uppercase tracking-wider">Lokasi Ruangan</p>
                    <p class="text-2xl font-black text-gray-800 dark:text-white">{{ $barang->ruangan }}</p>
                </div>

                {{-- Baris 1: Identitas --}}
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Kode Barang / BMN</p>
                  <p class="text-sm font-bold text-gray-800 dark:text-gray-200">{{ $barang->kode_barang }}</p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">NUP (Nomor Urut Pendaftaran)</p>
                  <p class="text-sm font-bold text-gray-800 dark:text-gray-200">{{ $barang->nup ?? '-' }}</p>
                </div>

                {{-- Baris 2: Merk & S/N --}}
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Merk / Brand</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->merk ?? '-' }}</p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nomor Seri (S/N)</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->nomor_seri ?? '-' }}</p>
                </div>

                {{-- Baris 3: Kondisi & Jumlah --}}
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Kondisi Fisik</p>
                  <div class="flex items-center gap-2">
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium {{ $barang->persentase_kondisi >= 70 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $barang->kondisi }} ({{ $barang->persentase_kondisi }}%)
                    </span>
                  </div>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Jumlah Unit</p>
                  <p class="text-sm font-bold text-gray-800 dark:text-gray-200">{{ $barang->jumlah }} Unit</p>
                </div>

                {{-- Baris 4: Pengadaan --}}
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal Perolehan</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
                    {{ $barang->tanggal_perolehan ? \Carbon\Carbon::parse($barang->tanggal_perolehan)->format('d F Y') : '-' }}
                  </p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nilai Perolehan</p>
                  <p class="text-sm font-bold text-primary">
                    Rp {{ number_format($barang->nilai_perolehan, 0, ',', '.') }}
                  </p>
                </div>

                {{-- Baris 5: Kategori & Asal --}}
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Kategori</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->kategori }}</p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Asal Pengadaan / Peruntukan</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->asal_pengadaan ?? '-' }}</p>
                </div>

                {{-- Foto Posisi Barang (Wide) --}}
                <div class="sm:col-span-2 mt-4">
                    <p class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-2 uppercase">Foto Posisi Terpasang / Lokasi Penyimpanan</p>
                    <div class="w-full h-72 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-800 flex items-center justify-center border border-gray-200 dark:border-gray-700 shadow-inner">
                        @if ($barang->posisi)
                            <img src="{{ asset('storage/' . $barang->posisi) }}" 
                                class="object-contain w-full h-full hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="flex flex-col items-center text-gray-400">
                                <span class="material-symbols-outlined text-5xl mb-2">map</span>
                                <span class="text-sm font-medium">Foto posisi belum diunggah</span>
                            </div>
                        @endif
                    </div>
                </div>

              </div>
            </div>
          </div>

          {{-- Kolom Kanan: Media & Status --}}
          <div class="lg:col-span-1 space-y-6">
              
              {{-- Foto Fisik --}}
              <div class="bg-white dark:bg-[#1a232c] p-6 rounded-xl border border-gray-200 dark:border-gray-800 flex flex-col items-center shadow-sm">
                  <h3 class="text-gray-900 dark:text-white text-lg font-bold mb-4">Foto Fisik Barang</h3>
                  <div class="w-full aspect-square rounded-lg overflow-hidden bg-gray-50 dark:bg-gray-900 flex items-center justify-center border border-gray-200 dark:border-gray-700">
                      @if ($barang->foto)
                          <img src="{{ asset('storage/' . $barang->foto) }}" 
                              alt="{{ $barang->nama_barang }}" 
                              class="object-contain w-full h-full hover:scale-110 transition-transform duration-500">
                      @else
                          <div class="flex flex-col items-center text-gray-400">
                                <span class="material-symbols-outlined text-5xl mb-2">image_not_supported</span>
                                <span class="text-sm font-medium">Tidak ada foto fisik</span>
                          </div>
                      @endif
                  </div>
              </div>

              {{-- QR Code --}}
              <div class="bg-white dark:bg-[#1a232c] p-6 rounded-xl border border-gray-200 dark:border-gray-800 flex flex-col items-center shadow-sm">
                  <h3 class="text-gray-900 dark:text-white text-lg font-bold mb-4">Identitas Digital (QR)</h3>
                  <div class="w-48 h-48 bg-white border p-2 rounded-lg shadow-inner flex items-center justify-center">
                      <img src="{{ asset('storage/' . $barang->qr_code) }}" 
                           class="w-full h-full">
                  </div>
                  <p class="text-[10px] text-gray-400 mt-4 text-center uppercase tracking-widest font-bold">
                    Scan untuk akses cepat sistem inventaris
                  </p>
              </div>

              {{-- Status Perawatan Aktif --}}
              @if(!empty($perawatan))
              <div class="bg-white dark:bg-[#1a232c] p-5 rounded-xl border-l-4 border-l-yellow-500 border border-gray-200 dark:border-gray-800 shadow-md animate-pulse">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-yellow-500">engineering</span>
                    <h4 class="text-base font-bold text-gray-900 dark:text-white">Sedang Maintenance</h4>
                </div>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Status:</span>
                        <span class="font-bold text-yellow-600">{{ ucfirst($perawatan->status) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Mulai:</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ \Carbon\Carbon::parse($perawatan->tanggal_perawatan)->format('d M Y') }}</span>
                    </div>
                </div>
              </div>
              @endif
          </div>

        </div>
      </div>
    </main>
  </div>
</div>

{{-- Scripts & Config (Ditempatkan di bawah content) --}}
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
                    "primary": "#137fec",
                    "background-light": "#f6f7f8",
                    "background-dark": "#101922",
                },
                fontFamily: {
                    "display": ["Inter", "sans-serif"]
                },
                borderRadius: {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
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
@endsection