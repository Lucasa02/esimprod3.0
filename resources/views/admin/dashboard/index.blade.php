@extends('layouts.admin.main')

@section('content')
<main class="flex-1 px-6 sm:px-10 py-8 bg-white dark:bg-background-dark">
  <div class="w-full max-w-7xl mx-auto">

    {{-- Judul Baru (Selamat datang) --}}
    <div class="mb-6">
        <p class="text-2xl sm:text-3xl font-bold text-[#1b365d] dark:text-white">
            Selamat datang, {{ Auth::user()->nama_lengkap }}!
        </p>
        <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm sm:text-base mt-1">
            Administrator Sistem Peminjaman Barang Produksi
        </p>
    </div>

    {{-- Hero Section (Tanpa teks selamat datang lagi) --}}

    {{-- Hero Section --}}
<div class="relative w-full aspect-[16/5] rounded-2xl overflow-hidden mb-8">

    {{-- Slider Backgrounds --}}
    <div id="hero-slider" class="absolute inset-0 z-0">

        {{-- Default Image --}}
        @if ($slider_images->count() == 0)
            <div class="absolute inset-0 bg-cover bg-center opacity-100"
                style="background-image: url('{{ asset('images/default-image.jpg') }}')">
            </div>
        @endif

        {{-- Uploaded Images --}}
        @foreach ($slider_images as $index => $img)
            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 
                {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                style="background-image: url('{{ asset('storage/' . $img->image_path) }}');">
            </div>
        @endforeach

    </div>

    {{-- Overlay Gelap --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent z-10"></div>

            {{-- 🔥 Button Kelola Slider --}}
            <div class="relative z-20 flex h-full items-end p-6 sm:p-8">
          <div class="flex w-full justify-end">
          <a href="{{ route('slider.index') }}"
           class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white font-medium backdrop-blur-sm px-4 py-2 rounded-lg transition">
            <span class="material-symbols-outlined">photo_library</span>
            Kelola Slider
        </a>
    </div>
</div>


</div>



    {{-- Statistik Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

      {{-- Barang --}}
      <div class="flex flex-col gap-2 rounded-xl p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
        <div class="flex items-center justify-between text-text-light-secondary dark:text-text-dark-secondary">
          <p class="text-sm font-medium">Total Barang</p>
          <span class="material-symbols-outlined">inventory_2</span>
        </div>
        <p class="text-text-light-primary dark:text-white text-3xl font-bold leading-tight tracking-tight">
          {{ $barang }}
        </p>
        <div class="flex items-center gap-4 text-xs mt-1 text-text-light-secondary dark:text-text-dark-secondary">
          <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-green-500"></span>Tersedia: {{ $barang_tersedia }}</span>
          <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-red-500"></span>Hilang: {{ $barang_hilang }}</span>
          <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-amber-500"></span>Habis: {{ $barang_tidak_tersedia }}</span>
        </div>
      </div>

      {{-- Peminjaman --}}
      <div class="flex flex-col gap-2 rounded-xl p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
        <div class="flex items-center justify-between text-text-light-secondary dark:text-text-dark-secondary">
          <p class="text-sm font-medium">Total Penggunaan</p>
          <span class="material-symbols-outlined">local_shipping</span>
        </div>
        <p class="text-text-light-primary dark:text-white text-3xl font-bold leading-tight tracking-tight">
          {{ $peminjaman }}
        </p>
        <div class="flex items-center gap-4 text-xs mt-1 text-text-light-secondary dark:text-text-dark-secondary">
          <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-yellow-500"></span>Proses: {{ $peminjaman_proses }}</span>
          <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-green-500"></span>Selesai: {{ $peminjaman_selesai }}</span>
        </div>
      </div>

      {{-- Pengembalian --}}
      <div class="flex flex-col gap-2 rounded-xl p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
        <div class="flex items-center justify-between text-text-light-secondary dark:text-text-dark-secondary">
          <p class="text-sm font-medium">Total Pengembalian</p>
          <span class="material-symbols-outlined">assignment_return</span>
        </div>
        <p class="text-text-light-primary dark:text-white text-3xl font-bold leading-tight tracking-tight">
          {{ $pengembalian }}
        </p>
        <div class="flex items-center gap-4 text-xs mt-1 text-text-light-secondary dark:text-text-dark-secondary">
          <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-red-500"></span>Tidak Lengkap: {{ $pengembalian_incomplete }}</span>
          <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-green-500"></span>Lengkap: {{ $pengembalian_complete }}</span>
        </div>
      </div>

      {{-- Jabatan --}}
      <div class="flex flex-col gap-2 rounded-xl p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
        <div class="flex items-center justify-between text-text-light-secondary dark:text-text-dark-secondary">
          <p class="text-sm font-medium">Jabatan</p>
          <span class="material-symbols-outlined">movie</span>
        </div>
        <p class="text-text-light-primary dark:text-white text-3xl font-bold leading-tight tracking-tight">
          {{ $jabatan }}
        </p>
      </div>

      {{-- Jenis Barang --}}
      <div class="flex flex-col gap-2 rounded-xl p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
        <div class="flex items-center justify-between text-text-light-secondary dark:text-text-dark-secondary">
          <p class="text-sm font-medium">Jenis Barang</p>
          <span class="material-symbols-outlined">category</span>
        </div>
        <p class="text-text-light-primary dark:text-white text-3xl font-bold leading-tight tracking-tight">
          {{ $jenis_barang }}
        </p>
      </div>

      {{-- Peruntukan --}}
      <div class="flex flex-col gap-2 rounded-xl p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
        <div class="flex items-center justify-between text-text-light-secondary dark:text-text-dark-secondary">
          <p class="text-sm font-medium">Peruntukan</p>
          <span class="material-symbols-outlined">warehouse</span>
        </div>
        <p class="text-text-light-primary dark:text-white text-3xl font-bold leading-tight tracking-tight">
          {{ $peruntukan }}
        </p>
      </div>

      {{-- User --}}
      <div class="flex flex-col gap-2 rounded-xl p-6 bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark">
        <div class="flex items-center justify-between text-text-light-secondary dark:text-text-dark-secondary">
          <p class="text-sm font-medium">Total Pengguna</p>
          <span class="material-symbols-outlined">group</span>
        </div>
        <p class="text-text-light-primary dark:text-white text-3xl font-bold leading-tight tracking-tight">
          {{ $user }}
        </p>
      </div>

    </div>
  </div>
</main>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const slides = document.querySelectorAll("#hero-slider > div");
  let current = 0;

  setInterval(() => {
    // Hilangkan slide aktif
    slides[current].classList.remove("opacity-100");
    slides[current].classList.add("opacity-0");

    // Ganti ke slide berikutnya
    current = (current + 1) % slides.length;

    // Tampilkan slide baru
    slides[current].classList.remove("opacity-0");
    slides[current].classList.add("opacity-100");
  }, 5000); // Ganti gambar setiap 5 detik
});
</script>

@endsection
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#3182CE",
                    "background-light": "#f7f9fc",
                    "background-dark": "#101622",
                    "card-light": "#ffffff",
                    "card-dark": "#171E2C",
                    "border-light": "#e2e8f0",
                    "border-dark": "#2d3748",
                    "text-light-primary": "#1a202c",
                    "text-dark-primary": "#e2e8f0",
                    "text-light-secondary": "#64748b",
                    "text-dark-secondary": "#a0aec0",
                    "sidebar-dark": "#171E2C",
                },
                fontFamily: {
                    "display": ["Inter", "sans-serif"]
                },
                borderRadius: {
                    "DEFAULT": "0.75rem",
                    "lg": "1rem",
                    "xl": "1.5rem",
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
        'wght' 300,
        'GRAD' 0,
        'opsz' 24
    }
</style>