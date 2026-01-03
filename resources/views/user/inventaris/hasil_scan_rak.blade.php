<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang - {{ $nama_rak }}</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" crossorigin href="https://fonts.gstatic.com"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1b365d", /* Warna Biru Baru */
                        "secondary": "#64748b",
                        "accent": "#f8fafc",
                    },
                    fontFamily: {
                        "sans": ["Inter", "sans-serif"]
                    }
                },
            },
        }
    </script>

    <style>
        body { background-color: #f8fafc; }
        .card-hover { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover:hover { transform: translateY(-8px); box-shadow: 0 25px 50px -12px rgba(27, 54, 93, 0.15); }
        .glass { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); }
        
        /* Animasi Shimmer untuk Logo */
        .logo-container {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        .logo-shimmer::after {
            content: "";
            position: absolute;
            top: 0;
            left: -150%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.6),
                transparent
            );
            transform: skewX(-20deg);
            animation: shimmer 4s infinite;
        }
        @keyframes shimmer {
            0% { left: -150%; }
            30% { left: 150%; }
            100% { left: 150%; }
        }

        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #1b365d; border-radius: 10px; }
    </style>
</head>

<body class="font-sans text-slate-900 antialiased custom-scrollbar">

<div class="max-w-6xl mx-auto px-4 py-10">

    <header class="mb-12 animate__animated animate__fadeInDown">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-slate-200 pb-8">
            <div class="space-y-4">
                <div class="logo-container logo-shimmer rounded-lg">
                    <img src="{{ asset('img/assets/esimprod_logo.png') }}" alt="Logo ESIMPROD" class="h-10 w-auto object-contain">
                </div>

                <div class="space-y-1">
                    <div class="flex items-center gap-2 text-primary/80 font-bold text-xs tracking-[0.2em] uppercase">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        <span>BMN Storage Area</span>
                    </div>
                    <h1 class="text-4xl font-black tracking-tight text-slate-900">
                        Ruangan: <span class="text-primary">{{ $nama_rak }}</span>
                    </h1>
                    <p class="text-slate-500 font-medium">
                        Ditemukan <span class="text-primary font-bold">{{ $barang->count() }}</span> unit barang di lokasi ini.
                    </p>
                </div>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($barang as $index => $b)
        <div class="animate__animated animate__fadeInUp card-hover bg-white rounded-[2rem] border border-slate-100 overflow-hidden flex flex-col group/card" 
             style="animation-delay: {{ $index * 0.1 }}s">
            
            <div class="relative aspect-[4/3] overflow-hidden bg-slate-50">
                @if ($b->foto)
                    <img src="{{ asset('storage/' . $b->foto) }}" class="object-cover w-full h-full transition-transform duration-700 group-hover/card:scale-110" alt="{{ $b->nama_barang }}">
                @else
                    <div class="flex flex-col items-center justify-center h-full text-slate-300">
                        <span class="material-symbols-outlined text-6xl font-light">inventory_2</span>
                        <span class="text-[10px] font-bold mt-2 uppercase tracking-[0.3em]">No Image</span>
                    </div>
                @endif
                
                <div class="absolute top-5 right-5">
                    <span class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest glass shadow-sm border border-white/50 
                        {{ $b->kondisi == 'Baik' || $b->kondisi == 'Sangat Baik' ? 'text-emerald-600' : 'text-rose-600' }}">
                        <span class="inline-block w-1.5 h-1.5 rounded-full mr-1.5 {{ $b->kondisi == 'Baik' || $b->kondisi == 'Sangat Baik' ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                        {{ $b->kondisi }}
                    </span>
                </div>
            </div>

            <div class="p-8 flex-1 flex flex-col">
                <div class="mb-6">
                    <p class="text-[10px] font-black text-primary/60 uppercase tracking-[0.25em] mb-2">{{ $b->kode_barang }}</p>
                    <h3 class="text-xl font-extrabold text-slate-800 leading-tight group-hover/card:text-primary transition-colors">
                        {{ $b->nama_barang }}
                    </h3>
                </div>

                <div class="mt-auto pt-6 border-t border-slate-100/80">
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="flex flex-col">
                            <span class="text-[9px] text-slate-400 font-black uppercase tracking-widest mb-1">Kategori</span>
                            <span class="text-sm font-bold text-slate-700">{{ $b->kategori }}</span>
                        </div>
                        <div class="flex flex-col text-right">
                            <span class="text-[9px] text-slate-400 font-black uppercase tracking-widest mb-1">Status Ruangan</span>
                            <span class="text-sm font-bold text-emerald-600">{{ $nama_rak }}</span>
                        </div>
                    </div>

                    <a href="{{ route('user.inventaris.scan', $b->kode_barang) }}" 
                       class="flex items-center justify-center w-full py-4 bg-primary hover:bg-slate-900 text-white rounded-2xl text-sm font-bold transition-all duration-300 group shadow-xl shadow-primary/10">
                        Detail Unit
                        <span class="material-symbols-outlined text-lg ml-2 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($barang->isEmpty())
    <div class="animate__animated animate__fadeIn flex flex-col items-center justify-center py-24 px-6 bg-white rounded-[3rem] border-2 border-dashed border-slate-200">
        <div class="w-28 h-28 bg-slate-50 rounded-full flex items-center justify-center mb-8">
            <span class="material-symbols-outlined text-6xl text-slate-200">grid_view</span>
        </div>
        <h3 class="text-2xl font-black text-slate-800 tracking-tight">Rak Kosong</h3>
        <p class="text-slate-400 max-w-xs text-center mt-3 font-medium">Belum ada barang yang ditempatkan pada koordinat rak ini.</p>
    </div>
    @endif

</div>

</body>
</html>