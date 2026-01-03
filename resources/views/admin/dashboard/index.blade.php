@extends('layouts.admin.main')

@section('content')
<main class="flex-1 px-6 sm:px-10 py-8 bg-background-light dark:bg-background-dark min-h-screen transition-colors duration-300">
    <div class="w-full max-w-7xl mx-auto space-y-8">

        {{-- Header Section (Welcome) --}}
        <div class="animate-enter">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white tracking-tight">
                Selamat datang, <span class="text-[#1b365d] dark:text-white">{{ Auth::user()->nama_lengkap }}</span>!
            </h1>
        </div>

        {{-- Hero Slider Section --}}
        <div class="relative w-full aspect-[16/6] sm:aspect-[16/5] md:aspect-[21/6] rounded-2xl overflow-hidden shadow-2xl animate-enter delay-100 group">
            
            {{-- Slider Backgrounds --}}
            <div id="hero-slider" class="absolute inset-0 z-0">
                @if ($slider_images->count() == 0)
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[10000ms] ease-linear scale-100 active-slide"
                         style="background-image: url('{{ asset('images/default-image.jpg') }}')">
                    </div>
                @endif

                @foreach ($slider_images as $index => $img)
                    <div class="absolute inset-0 bg-cover bg-center transition-all duration-1000 ease-in-out
                        {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }} slider-item"
                        style="background-image: url('{{ asset('storage/' . $img->image_path) }}');">
                    </div>
                @endforeach
            </div>

            {{-- Gradient Overlay (Cinematic look) --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10"></div>

            {{-- Action Button (Glassmorphism) --}}
            <div class="absolute bottom-6 right-6 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 transform translate-y-2 group-hover:translate-y-0">
                <a href="{{ route('slider.index') }}"
                   class="backdrop-blur-md bg-white/10 hover:bg-white/20 border border-white/20 text-white font-medium px-5 py-2.5 rounded-full transition-all duration-300 flex items-center gap-2 shadow-lg hover:shadow-blue-500/20">
                   <span class="material-symbols-outlined text-[20px]">tune</span>
                   <span>Kelola Slider</span>
                </a>
            </div>
        </div>

        {{-- Statistik Cards Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            {{-- Card Template: Barang --}}
            <div class="stat-card animate-enter delay-200">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-sm font-medium text-text-light-secondary dark:text-gray-400">Total Barang</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $barang }}</h3>
                    </div>
                    <div class="p-3 rounded-xl bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400">
                        <span class="material-symbols-outlined">inventory_2</span>
                    </div>
                </div>
                <div class="space-y-2 pt-4 border-t border-gray-100 dark:border-gray-800">
                    <div class="flex justify-between items-center text-xs text-gray-600 dark:text-gray-400">
                        <span class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Tersedia</span>
                        <span class="font-semibold">{{ $barang_tersedia }}</span>
                    </div>
                    <div class="flex justify-between items-center text-xs text-gray-600 dark:text-gray-400">
                        <span class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>Hilang</span>
                        <span class="font-semibold">{{ $barang_hilang }}</span>
                    </div>
                    <div class="flex justify-between items-center text-xs text-gray-600 dark:text-gray-400">
                        <span class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Habis</span>
                        <span class="font-semibold">{{ $barang_tidak_tersedia }}</span>
                    </div>
                </div>
            </div>

            {{-- Card Template: Peminjaman --}}
            <div class="stat-card animate-enter delay-300">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-sm font-medium text-text-light-secondary dark:text-gray-400">Total Penggunaan</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $peminjaman }}</h3>
                    </div>
                    <div class="p-3 rounded-xl bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400">
                        <span class="material-symbols-outlined">local_shipping</span>
                    </div>
                </div>
                <div class="space-y-2 pt-4 border-t border-gray-100 dark:border-gray-800">
                    <div class="flex justify-between items-center text-xs text-gray-600 dark:text-gray-400">
                        <span class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Proses</span>
                        <span class="font-semibold">{{ $peminjaman_proses }}</span>
                    </div>
                    <div class="flex justify-between items-center text-xs text-gray-600 dark:text-gray-400">
                        <span class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Selesai</span>
                        <span class="font-semibold">{{ $peminjaman_selesai }}</span>
                    </div>
                </div>
            </div>

            {{-- Card Template: Pengembalian --}}
            <div class="stat-card animate-enter delay-400">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-sm font-medium text-text-light-secondary dark:text-gray-400">Total Pengembalian</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $pengembalian }}</h3>
                    </div>
                    <div class="p-3 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400">
                        <span class="material-symbols-outlined">assignment_return</span>
                    </div>
                </div>
                <div class="space-y-2 pt-4 border-t border-gray-100 dark:border-gray-800">
                    <div class="flex justify-between items-center text-xs text-gray-600 dark:text-gray-400">
                        <span class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>Tidak Lengkap</span>
                        <span class="font-semibold">{{ $pengembalian_incomplete }}</span>
                    </div>
                    <div class="flex justify-between items-center text-xs text-gray-600 dark:text-gray-400">
                        <span class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Lengkap</span>
                        <span class="font-semibold">{{ $pengembalian_complete }}</span>
                    </div>
                </div>
            </div>

            {{-- Card Template: Simple Stats --}}
            <div class="stat-card animate-enter delay-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-text-light-secondary dark:text-gray-400">Jabatan</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $jabatan }}</h3>
                    </div>
                    <div class="p-3 rounded-xl bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400">
                        <span class="material-symbols-outlined">movie</span>
                    </div>
                </div>
            </div>

             <div class="stat-card animate-enter delay-600">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-text-light-secondary dark:text-gray-400">Jenis Barang</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $jenis_barang }}</h3>
                    </div>
                    <div class="p-3 rounded-xl bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400">
                        <span class="material-symbols-outlined">category</span>
                    </div>
                </div>
            </div>

             <div class="stat-card animate-enter delay-700">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-text-light-secondary dark:text-gray-400">Peruntukan</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $peruntukan }}</h3>
                    </div>
                    <div class="p-3 rounded-xl bg-pink-50 dark:bg-pink-900/20 text-pink-600 dark:text-pink-400">
                        <span class="material-symbols-outlined">warehouse</span>
                    </div>
                </div>
            </div>

             <div class="stat-card animate-enter delay-800">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-text-light-secondary dark:text-gray-400">Total Pengguna</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-1">{{ $user }}</h3>
                    </div>
                    <div class="p-3 rounded-xl bg-orange-50 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400">
                        <span class="material-symbols-outlined">group</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

{{-- Custom CSS untuk Animasi dan Card Style --}}
<style>
    /* Keyframe untuk animasi masuk */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Kelas dasar animasi */
    .animate-enter {
        opacity: 0; /* Mulai invisible */
        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    /* Delay staggered */
    .delay-100 { animation-delay: 100ms; }
    .delay-200 { animation-delay: 150ms; }
    .delay-300 { animation-delay: 200ms; }
    .delay-400 { animation-delay: 250ms; }
    .delay-500 { animation-delay: 300ms; }
    .delay-600 { animation-delay: 350ms; }
    .delay-700 { animation-delay: 400ms; }
    .delay-800 { animation-delay: 450ms; }

    /* Styling Card Mewah */
    .stat-card {
        background-color: white;
        border-radius: 1rem; /* rounded-xl */
        padding: 1.5rem;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        transition: all 0.4s ease;
    }
    
    /* Dark Mode Card */
    .dark .stat-card {
        background-color: #171E2C; /* card-dark */
        border-color: #2d3748; /* border-dark */
        box-shadow: none;
    }

    /* Efek Hover Mewah */
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.01);
        border-color: rgba(49, 130, 206, 0.3); /* Sedikit sentuhan warna primary */
    }

    /* Ken Burns Effect untuk Slider */
    .slider-item {
        transform: scale(1);
    }
    .slider-item.active-ken-burns {
        transform: scale(1.1); /* Zoom in halus */
        transition: transform 6s linear;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelectorAll("#hero-slider .slider-item");
    
    // Jika tidak ada slide atau hanya 1, hentikan
    if (slides.length <= 1) return;

    let current = 0;
    
    // Inisialisasi slide pertama dengan Ken Burns effect
    slides[0].classList.add("active-ken-burns");

    setInterval(() => {
        const activeSlide = slides[current];
        
        // Reset slide saat ini
        activeSlide.classList.remove("opacity-100", "z-10", "active-ken-burns");
        activeSlide.classList.add("opacity-0", "z-0");
        
        // Pindah index
        current = (current + 1) % slides.length;
        const nextSlide = slides[current];

        // Tampilkan slide berikutnya
        nextSlide.classList.remove("opacity-0", "z-0");
        nextSlide.classList.add("opacity-100", "z-10");
        
        // Trigger reflow untuk restart animasi CSS transform (trik penting)
        void nextSlide.offsetWidth; 
        
        // Tambahkan efek zoom
        nextSlide.classList.add("active-ken-burns");

    }, 5000); 
});
</script>

@endsection

{{-- 
    Catatan:
    Pastikan script Tailwind dan Font sudah terload di layout utama (main.blade.php).
    Jika belum, biarkan script/link di bawah ini tetap ada.
--}}
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#3182CE",
                    "background-light": "#F8FAFC", /* Lebih terang/bersih */
                    "background-dark": "#0F172A", /* Slate-900 yang lebih modern */
                    "card-light": "#ffffff",
                    "card-dark": "#1E293B", /* Slate-800 */
                    "text-light-secondary": "#64748b",
                    "text-dark-secondary": "#94a3b8",
                },
                fontFamily: {
                    "sans": ["Inter", "sans-serif"],
                }
            },
        },
    }
</script>
<style>
    body { font-family: 'Inter', sans-serif; }
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
</style>