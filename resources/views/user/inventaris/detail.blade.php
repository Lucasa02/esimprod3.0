<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang - {{ $barang->nama_barang }}</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" crossorigin href="https://fonts.gstatic.com"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1b365d",
                        "background-light": "#f8fafc",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                },
            },
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24
        }

        /* Animasi Premium Fade In Up */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-premium {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }

        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* --- ANIMASI KILAU LOGO PREMIUM --- */
        @keyframes premiumShine {
            0% { transform: translateX(-150%) skewX(-25deg); }
            /* Kilauan muncul di 1.5 detik pertama */
            25% { transform: translateX(150%) skewX(-25deg); }
            /* Jeda istirahat (looping) agar tidak melelahkan mata */
            100% { transform: translateX(150%) skewX(-25deg); }
        }

        .logo-container {
            position: relative;
            overflow: hidden;
            background: white;
            transition: transform 0.3s ease;
        }

        .logo-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Multi-stop gradient untuk efek cahaya yang soft di pinggir, tajam di tengah */
            background: linear-gradient(
                to right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.1) 30%,
                rgba(255, 255, 255, 0.7) 50%,
                rgba(255, 255, 255, 0.1) 70%,
                rgba(255, 255, 255, 0) 100%
            );
            /* Durasi total 5 detik (1.25 detik bergerak, sisanya diam) */
            animation: premiumShine 5s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }

        .logo-container:hover {
            transform: translateY(-2px);
        }
        /* ---------------------------------- */
    </style>
</head>

<body class="font-display bg-background-light min-h-screen text-slate-900">

<div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 space-y-8">
    
    <header class="flex flex-col sm:flex-row justify-between items-center gap-6 animate-premium">
        <div class="flex items-center gap-4">
            <div class="logo-container p-2 rounded-xl shadow-sm border border-slate-200 relative">
                <img src="{{ asset('img/assets/esimprod_logo.png') }}" alt="ESIMPROD Logo" class="h-8 sm:h-10 w-auto relative z-10">
            </div>
            <div class="h-8 w-[1px] bg-slate-300 hidden sm:block"></div>
            <div>
                <h1 class="text-xl font-bold tracking-tight text-slate-800">Inventory System</h1>
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('user.inventaris.lapor-kerusakan.form', $barang->id) }}"
                class="group flex items-center justify-center gap-2 rounded-xl h-11 px-6 bg-red-600 text-white text-sm font-bold hover:bg-red-700 hover:shadow-lg hover:shadow-red-200 transition-all duration-300 transform active:scale-95">
                <span class="material-symbols-outlined text-base group-hover:rotate-12 transition-transform">report_problem</span>
                <span>Laporkan Kerusakan</span>
            </a>

            <a href="{{ asset('storage/' . $barang->qr_code) }}" target="_blank"
                class="flex items-center justify-center gap-2 rounded-xl h-11 px-5 bg-white text-slate-700 border border-slate-200 text-sm font-bold hover:bg-slate-50 hover:border-slate-300 transition-all duration-300 shadow-sm transform active:scale-95">
                <span class="material-symbols-outlined text-base">qr_code_scanner</span>
                <span>Cetak QR</span>
            </a>
        </div>
    </header>

    <div class="animate-premium stagger-1">
        <h2 class="text-3xl lg:text-4xl font-black text-slate-900 leading-tight">
            {{ $barang->nama_barang }}
        </h2>
        <div class="flex items-center gap-2 mt-2">
            <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-xs font-bold uppercase tracking-wider">Aset Inventaris</span>
            <span class="text-slate-400 text-sm">•</span>
            <span class="text-slate-500 text-sm">Update terakhir: {{ now()->format('d M Y') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-8 animate-premium stagger-2">
            
            <div class="bg-gradient-to-br from-primary to-slate-800 p-6 rounded-2xl shadow-xl shadow-primary/20 text-white relative overflow-hidden group">
                <div class="relative z-10">
                    <p class="text-blue-100 text-xs font-bold uppercase tracking-[0.2em] mb-2">Penempatan Lokasi</p>
                    <div class="flex items-end gap-3">
                        <span class="material-symbols-outlined text-4xl">location_on</span>
                        <h3 class="text-3xl font-black">{{ $barang->ruangan }}</h3>
                    </div>
                </div>
                <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition-transform duration-700">
                    <span class="material-symbols-outlined text-[120px]">apartment</span>
                </div>
            </div>

            <div class="glass-card p-8 rounded-2xl border border-white shadow-sm ring-1 ring-slate-200/50">
                <h3 class="text-slate-900 text-lg font-bold mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-primary rounded-full"></span>
                    Spesifikasi Teknis
                </h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Kondisi Saat Ini</p>
                        <div class="flex items-center gap-2">
                            <span class="h-3 w-3 rounded-full {{ $barang->kondisi == 'Baik' ? 'bg-green-500 animate-pulse' : 'bg-blue-500' }}"></span>
                            <p class="font-bold text-slate-800 text-lg">{{ $barang->kondisi }}</p>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Kode Unik Barang</p>
                        <p class="font-mono font-bold text-primary text-lg">{{ $barang->kode_barang }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nomor Urut Pendaftaran (NUP)</p>
                        <p class="font-bold text-slate-700 text-lg">{{ $barang->nup ?? '-' }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Merk / Brand</p>
                        <p class="font-bold text-slate-700 text-lg">{{ $barang->merk ?? '-' }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Tahun Pengadaan</p>
                        <p class="font-bold text-slate-700 text-lg">{{ $barang->tahun_pengadaan ?? '-' }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Kategori Aset</p>
                        <p class="font-bold text-slate-700 text-lg">{{ $barang->kategori }}</p>
                    </div>
                </div>

                <div class="mt-10 pt-8 border-t border-slate-100">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Catatan Tambahan</p>
                    <p class="text-slate-600 text-sm leading-relaxed italic">
                        "{{ $barang->catatan ?? 'Tidak ada deskripsi tambahan untuk barang ini.' }}"
                    </p>
                </div>
            </div>

            <div class="glass-card p-6 rounded-2xl border border-white shadow-sm ring-1 ring-slate-200/50">
                 <h3 class="text-slate-900 text-lg font-bold mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">distance</span>
                    Titik Presisi Lokasi Barang
                </h3>
                <div class="relative group rounded-xl overflow-hidden bg-slate-100 aspect-video flex items-center justify-center border border-slate-200">
                    @if ($barang->posisi)
                        <img src="{{ asset('storage/' . $barang->posisi) }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    @else
                        <div class="text-center space-y-2">
                            <span class="material-symbols-outlined text-4xl text-slate-300">image_not_supported</span>
                            <p class="text-xs text-slate-400 font-medium tracking-tight">Data visual lokasi tidak tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-8 animate-premium stagger-3">
            
            <div class="glass-card p-4 rounded-2xl border border-white shadow-md ring-1 ring-slate-200/50">
                <div class="relative group rounded-xl overflow-hidden bg-slate-50 aspect-square flex items-center justify-center border border-slate-100">
                    @if ($barang->foto)
                        <img src="{{ asset('storage/' . $barang->foto) }}" class="object-contain w-full h-full p-4 transition-transform duration-500 group-hover:scale-110">
                    @else
                        <span class="material-symbols-outlined text-6xl text-slate-200">inventory_2</span>
                    @endif
                </div>
                <div class="mt-4 text-center">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Foto Barang</p>
                </div>
            </div>

            <div class="glass-card p-8 rounded-2xl border border-white shadow-md ring-1 ring-slate-200/50 flex flex-col items-center group">
                <div class="p-4 bg-white rounded-2xl shadow-inner border border-slate-100 transition-transform group-hover:scale-105 duration-300">
                    <img src="{{ asset('storage/' . $barang->qr_code) }}" class="w-40 h-40">
                </div>
                <div class="mt-6 text-center">
                    <h4 class="font-bold text-slate-800">QR Barang</h4>
                    <p class="text-xs text-slate-500 mt-1">Scan kode ini untuk mengakses<br>sertifikat digital barang ini.</p>
                </div>
            </div>

            @if(!empty($perawatan))
            <div class="bg-amber-50 p-6 rounded-2xl border border-amber-200 relative overflow-hidden">
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-3 text-amber-700">
                        <span class="material-symbols-outlined">build_circle</span>
                        <h4 class="font-bold">Sedang Maintenance</h4>
                    </div>
                    <p class="text-xs text-amber-800/80 leading-relaxed font-medium">
                        Aset ini sedang dalam tahap perbaikan rutin sejak tanggal permohonan diajukan.
                    </p>
                </div>
                <div class="absolute -right-2 -bottom-2 text-amber-200/50">
                    <span class="material-symbols-outlined text-6xl">engineering</span>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

</body>
</html>