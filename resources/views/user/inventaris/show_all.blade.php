<!DOCTYPE html>
<html class="light" lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Manajemen Inventaris</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
<style>
.material-symbols-outlined {
  font-variation-settings: 'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 24
}
</style>
<script id="tailwind-config">
tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        "primary": "#4A90E2",
        "background-light": "#FFFFFF",
        "background-dark": "#121212",
        "surface-light": "#F2F2F7",
        "surface-dark": "#1E1E1E",
        "text-light": "#333333",
        "text-dark": "#E0E0E0",
        "text-muted-light": "#666666",
        "text-muted-dark": "#999999",
        "status-green": "#2ECC71",
        "status-yellow": "#F39C12",
        "status-red": "#E74C3C",
      },
      fontFamily: { "display": ["Plus Jakarta Sans", "sans-serif"] },
      borderRadius: { "DEFAULT": "0.5rem", "lg": "0.75rem", "xl": "1rem", "full": "9999px" },
    },
  },
}
</script>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark">

<div class="relative flex flex-col min-h-screen w-full overflow-x-hidden">
  <div class="flex flex-col grow h-full">
    <header class="sticky top-0 z-10 flex w-full items-center justify-between border-b border-surface-light dark:border-surface-dark/50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm px-4 md:px-10 lg:px-20 py-3">
      <div class="flex items-center gap-4 text-text-light dark:text-text-dark">
        <div class="text-primary text-2xl">
          <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M21.6 4.2H2.4A2.4 2.4 0 0 0 0 6.6v10.8A2.4 2.4 0 0 0 2.4 19.8h19.2a2.4 2.4 0 0 0 2.4-2.4V6.6a2.4 2.4 0 0 0-2.4-2.4Zm-1.2 13.2H3.6V6.6h16.8v10.8Z"></path>
            <path d="M15 13.2H9a.6.6 0 1 0 0 1.2h6a.6.6 0 1 0 0-1.2Z"></path>
            <path d="M15 9.6H9a.6.6 0 1 0 0 1.2h6a.6.6 0 1 0 0-1.2Z"></path>
          </svg>
        </div>
        <h2 class="text-lg font-bold tracking-tight">Manajemen Inventaris</h2>
      </div>

      <div class="flex flex-1 justify-end gap-2 sm:gap-4 items-center">
        <button class="flex items-center justify-center h-10 w-10 rounded-full hover:bg-surface-light dark:hover:bg-surface-dark text-text-muted-light dark:text-text-muted-dark">
          <span class="material-symbols-outlined">settings</span>
        </button>
        <div class="bg-center bg-no-repeat bg-cover rounded-full h-10 w-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCUw_XIS41TDTI3a3sMpL2DpRIjZA8KFh0g5Ugn4JXcI8qXDslUVQRjHCAAqSSXZA7mRgl1tXk8r8P9U-dr8Qf_zeFMwZU2zFd3lbY0M762VlInKK9xdEqEMXieeC3_f806_4l-3zZprP2XGW1Kh4VwaC6uRR5RHspvsUTnkUjBC3T4QVlFg5ZyKmbqz9N2Q1N5FKhxI1njK3HfsvmC-Cg3B7gKn0fFbxDwSxPVIQhnSNG7uYIYATBuapypilPQoRSpJBxu1A91_w");'></div>
      </div>
    </header>

    <main class="px-4 md:px-10 lg:px-20 py-8">
      <div class="mx-auto flex flex-col max-w-7xl">
        <div class="flex flex-wrap justify-between items-center mb-6">
          <p class="text-3xl md:text-4xl font-black tracking-tight">Daftar Barang</p>
          <button class="flex items-center gap-2 h-10 px-4 rounded-lg bg-primary text-white font-bold text-sm hover:bg-primary/90 transition-colors">
            <span class="material-symbols-outlined text-base">add_circle</span>
            <span>Tambah Barang</span>
          </button>
        </div>

        {{-- Filter --}}
        <div x-data="{ open: false }" class="bg-background-light dark:bg-background-dark shadow-md rounded-lg p-6 mb-8 border border-surface-light dark:border-surface-dark">
          <div class="flex justify-between items-center mb-3">
            <h2 class="text-lg font-semibold text-text-light dark:text-text-dark">Filter & Pencarian</h2>
            <button type="button" @click="open = !open" class="flex items-center px-3 py-2 border rounded-lg border-surface-light dark:border-surface-dark text-text-muted-light dark:text-text-muted-dark hover:bg-surface-light dark:hover:bg-surface-dark text-sm font-medium">
              <i class="fa-solid fa-filter mr-2"></i>
              <span x-text="open ? 'Tutup Filter' : 'Buka Filter'"></span>
            </button>
          </div>
          <div x-show="open" x-transition class="mt-4 border-t border-surface-light dark:border-surface-dark pt-5">
            <form method="GET" action="{{ route('bmn.search', $ruangan) }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
              {{-- Semua input filter --}}
              <div class="col-span-1 md:col-span-2 lg:col-span-4 mt-8 flex gap-4">
                <button type="submit" class="flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-lg font-semibold hover:bg-primary/90 focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:outline-none">
                  <span class="material-symbols-outlined !text-xl">search</span> Filter
                </button>
                <a href="#" target="_blank" class="px-4 py-2 text-white bg-status-green rounded-lg font-medium hover:bg-green-800">
                  <i class="fa-solid fa-file-pdf mr-1"></i> Cetak PDF
                </a>
              </div>
            </form>
          </div>
        </div>

        {{-- Card Barang --}}
        <div class="flex justify-center p-3">
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 w-full">
            @foreach ($barang as $item)
            @php
              $warna = match($item->kondisi) {
                'Sangat Baik' => 'bg-status-green',
                'Baik' => 'bg-primary',
                'Kurang Baik' => 'bg-status-yellow',
                'Rusak / Cacat', 'Rusak', 'Cacat' => 'bg-status-red',
                default => 'bg-gray-500'
              };
            @endphp
            <div class="bg-background-light dark:bg-background-dark border border-surface-light dark:border-surface-dark rounded-lg shadow-lg relative w-full">
              <a href="{{ route('bmn.show', [$ruangan, $item->id]) }}">
                <img class="w-full h-40 object-cover rounded-t-lg {{ $item->foto ? '' : 'opacity-50' }}" src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('img/no-image.png') }}" alt="{{ $item->nama_barang }}">
              </a>
              {{-- Badge --}}
              <div class="absolute top-3 left-3 right-3 flex justify-between items-center">
                <span class="bg-primary text-white text-xs font-semibold px-2 py-[2px] rounded-full">{{ $item->kategori }}</span>
                @php
              $penghapusan = $item->perawatan->firstWhere('jenis_perawatan', 'penghapusan');
              $rencana     = $item->perawatan->firstWhere('jenis_perawatan', 'rencana_penghapusan');
              $perawatan   = $item->perawatan->firstWhere('jenis_perawatan', 'perbaikan');
          @endphp
                @if ($penghapusan)
                  <span class="bg-status-red text-white text-xs font-semibold px-2 py-[2px] rounded-full">Penghapusan</span>
                @elseif ($rencana)
                  <span class="bg-status-yellow text-white text-xs font-semibold px-2 py-[2px] rounded-full">Rencana Penghapusan</span>
                @elseif ($perawatan)
                  <span class="{{ $warna }} text-white text-xs font-semibold px-2 py-[2px] rounded-full">{{ ucfirst($perawatan->status) }}</span>
                @endif
              </div>

              <div class="p-4">
                <p class="font-semibold text-text-light dark:text-text-dark text-sm truncate">{{ $item->nama_barang }}</p>
                <p class="text-xs text-text-muted-light dark:text-text-muted-dark mb-1">Kode: {{ $item->kode_barang }}</p>

                <div class="w-full bg-surface-light dark:bg-surface-dark h-2.5 rounded-full mb-2">
                  <div class="h-2.5 rounded-full" style="width: {{ $item->persentase_kondisi ?? 0 }}%; background-color: @switch($item->kondisi) @case('Sangat Baik') green @break @case('Baik') blue @break @case('Kurang Baik') yellow @break @case('Rusak / Cacat') red @break @default gray @endswitch"></div>
                </div>

                <p class="text-xs text-text-muted-light dark:text-text-muted-dark mb-2">Kondisi: {{ $item->persentase_kondisi ?? 0 }}%</p>

                <span class="{{ $warna }} text-white text-xs font-semibold px-2 py-0.5 rounded-full">{{ $item->kondisi }}</span>

                <div class="mt-3 flex gap-2">
                  <a href="{{ route('bmn.show', [$ruangan, $item->id]) }}" class="inline-flex text-white bg-status-green hover:bg-green-800 font-medium rounded-lg text-sm px-2 py-1">Detail</a>
                  <a href="{{ route('bmn.edit', [$ruangan, $item->id]) }}" class="inline-flex text-white bg-status-yellow hover:bg-yellow-800 font-medium rounded-lg text-sm px-2 py-1">Edit</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>

        {{-- Pagination --}}
        <div class="p-3">
          {{ $barang->links() }}
        </div>
      </div>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
