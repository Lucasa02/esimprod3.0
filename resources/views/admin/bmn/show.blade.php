@extends('layouts.admin.main')

@section('content')
<div class="font-display bg-background-light dark:bg-background-dark min-h-screen">
  <div class="flex">
    <main class="flex-1 p-4 sm:p-6 lg:p-8">
      <div class="max-w-7xl mx-auto">

        <div class="flex flex-wrap gap-2 mb-6">
          <a href="{{ route('bmn.index', $ruangan) }}" class="text-gray-500 dark:text-[#9dabb9] text-sm font-medium hover:text-primary dark:hover:text-white">Home</a>
          <span class="text-gray-500 dark:text-[#9dabb9] text-sm font-medium">/</span>
          <a href="{{ route('bmn.index', $ruangan) }}" class="text-gray-500 dark:text-[#9dabb9] text-sm font-medium hover:text-primary dark:hover:text-white">
            {{ ucfirst($ruangan) }}
          </a>
          <span class="text-gray-500 dark:text-[#9dabb9] text-sm font-medium">/</span>
          <span class="text-gray-800 dark:text-white text-sm font-medium">{{ $barang->nama_barang }}</span>
        </div>

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
              <span>Edit Item</span>
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

            @if(!empty($perawatan))
            <form action="{{ route('perawatan_inventaris.hapuskan', $perawatan->id) }}" method="POST" onsubmit="return confirm('Pindahkan ke rencana penghapusan?')">
                @csrf
                <button type="submit"
                    class="flex min-w-[84px] items-center justify-center gap-2 rounded-lg h-10 px-4 bg-red-600 text-white text-sm font-bold hover:bg-red-700 transition-colors">
                    <span class="material-symbols-outlined text-base">delete_forever</span>
                    <span>Penghapusan</span>
                </button>
            </form>
            @endif
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

          <div class="lg:col-span-2 space-y-8">
            <div class="bg-white dark:bg-[#1a232c] p-6 rounded-xl border border-gray-200 dark:border-gray-800">
              <h3 class="text-gray-900 dark:text-white text-lg font-bold mb-4">Deskripsi / Catatan</h3>
              <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                {{ $barang->catatan ?? 'Tidak ada deskripsi tambahan.' }}
              </p>
            </div>

            <div class="bg-white dark:bg-[#1a232c] p-6 rounded-xl border border-gray-200 dark:border-gray-800">
              <h3 class="text-gray-900 dark:text-white text-lg font-bold mb-6">Detail Barang</h3>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6">
                
                {{-- HIGHLIGHT LOKASI RUANGAN --}}
              <div class="col-span-1 sm:col-span-2 bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-100 dark:border-blue-800 mb-2">
                  <p class="text-xs font-bold text-blue-600 dark:text-blue-300 mb-1 uppercase tracking-wider flex items-center">
                      <span class="material-symbols-outlined text-[18px] mr-1">location_on</span> Lokasi & Detail Rak
                  </p>
                  <p class="text-2xl font-black text-gray-800 dark:text-white">
                      {{ $barang->ruangan }}
                  </p>
                  @if(Str::contains($barang->ruangan, 'MCR'))
                  @elseif(Str::contains($barang->ruangan, 'Studio'))
                      <span class="text-sm text-blue-500 font-medium italic">Penyimpanan: Studio Production Area</span>
                  @endif
              </div>

                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Kondisi</p>
                  <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium {{ $barang->kondisi == 'Baik' || $barang->kondisi == 'Sangat Baik' ? 'bg-green-100 dark:bg-green-500/20 text-green-800 dark:text-green-300' : 'bg-red-100 dark:bg-red-500/20 text-red-800 dark:text-red-300' }}">
                    {{ $barang->kondisi }}
                  </span>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Kode Barang</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->kode_barang }}</p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">NUP</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->nup ?? '-' }}</p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Merk</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->merk ?? '-' }}</p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Asal Pengadaan</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ ucfirst($barang->asal_pengadaan) }}</p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tahun Pengadaan</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->tahun_pengadaan ?? '-' }}</p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Peruntukan</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ ucfirst($barang->peruntukan) }}</p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Kategori</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->kategori }}</p>
                </div>
                <div>
                  <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Jumlah</p>
                  <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $barang->jumlah }} Unit</p>
                </div>
                
                {{-- Foto Posisi Barang (Full Width di Mobile, 1 col di desktop grid) --}}
                <div class="sm:col-span-2 mt-4">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">Foto Posisi Barang</p>
                    <div class="w-full h-64 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800 flex items-center justify-center border border-gray-200 dark:border-gray-700">
                        @if ($barang->posisi)
                            <img src="{{ asset('storage/' . $barang->posisi) }}" 
                                alt="Foto Posisi {{ $barang->nama_barang }}" 
                                class="object-contain w-full h-full hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="flex flex-col items-center text-gray-400">
                                <span class="material-symbols-outlined text-4xl mb-1">image_not_supported</span>
                                <span class="text-sm">Tidak ada foto posisi</span>
                            </div>
                        @endif
                    </div>
                </div>

              </div>
            </div>
          </div>

          <div class="lg:col-span-1 space-y-8">
              <div class="bg-white dark:bg-[#1a232c] p-6 rounded-xl border border-gray-200 dark:border-gray-800 flex flex-col items-center">
                  <h3 class="text-gray-900 dark:text-white text-lg font-bold mb-4">Foto Barang</h3>
                  <div class="w-full aspect-square rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800 flex items-center justify-center border border-gray-200 dark:border-gray-700">
                      @if ($barang->foto)
                          <img src="{{ asset('storage/' . $barang->foto) }}" 
                              alt="{{ $barang->nama_barang }}" 
                              class="object-contain w-full h-full hover:scale-105 transition-transform duration-300">
                      @else
                          <div class="flex flex-col items-center text-gray-400">
                                <span class="material-symbols-outlined text-4xl mb-1">image_not_supported</span>
                                <span class="text-sm">Tidak ada foto</span>
                          </div>
                      @endif
                  </div>
              </div>

              <div class="bg-white dark:bg-[#1a232c] p-6 rounded-xl border border-gray-200 dark:border-gray-800 flex flex-col items-center">
                  <h3 class="text-gray-900 dark:text-white text-lg font-bold mb-4">QR Code</h3>
                  <div class="w-full aspect-square rounded-lg bg-white border border-gray-200 flex items-center justify-center p-4">
                      <img src="{{ asset('storage/' . $barang->qr_code) }}" 
                           alt="QR Code {{ $barang->kode_barang }}" 
                           class="object-contain w-full h-full">
                  </div>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-4 flex items-center">
                    <span class="material-symbols-outlined text-sm mr-1">qr_code_scanner</span>
                    Scan untuk lihat detail
                  </p>
              </div>

              @if(!empty($perawatan))
              <div class="bg-white dark:bg-[#1a232c] p-5 rounded-xl border border-l-4 border-l-yellow-500 border-gray-200 dark:border-gray-800 shadow-sm">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-yellow-500">warning</span>
                    <h4 class="text-base font-bold text-gray-900 dark:text-white">Sedang Dalam Perawatan</h4>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 dark:text-gray-400">Status:</span>
                        <span class="font-medium bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded text-xs">{{ ucfirst($perawatan->status) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 dark:text-gray-400">Tanggal:</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ optional(\Carbon\Carbon::parse($perawatan->tanggal_perawatan))->format('d M Y') ?? '-' }}</span>
                    </div>
                    <div class="pt-2 border-t border-gray-100 dark:border-gray-700">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Catatan:</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200 mt-1">{{ $perawatan->deskripsi ?? '-' }}</p>
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