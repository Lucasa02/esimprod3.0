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
                        "accent": "#137fec",
                        "background-light": "#f8fafc",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                },
            },
        }
    </script>

    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24 }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-premium { animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }

        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        @keyframes premiumShine {
            0% { transform: translateX(-150%) skewX(-25deg); }
            25% { transform: translateX(150%) skewX(-25deg); }
            100% { transform: translateX(150%) skewX(-25deg); }
        }

        .logo-container { position: relative; overflow: hidden; background: white; transition: transform 0.3s ease; }
        .logo-container::after {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.7) 50%, rgba(255,255,255,0) 100%);
            animation: premiumShine 5s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }
    </style>
</head>

<body class="font-display bg-background-light min-h-screen text-slate-900">

<div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 space-y-8">
    
    {{-- Header --}}
    <header class="flex flex-col sm:flex-row justify-between items-center gap-6 animate-premium">
    <div class="flex items-center gap-4">
        {{-- Tombol Kembali Dinamis --}}
        @php
            $previousUrl = url()->previous();
            
            // Cek apakah URL sebelumnya mengandung '/rak/' (halaman hasil_scan_rak)
            // Kita gunakan '/rak/' agar lebih spesifik
            $isFromRak = str_contains($previousUrl, '/rak/');
            
            // Logika: Jika dari Rak, kembali ke Rak tersebut. 
            // Jika tidak (misal dari Inventaris utama), maka kembali ke Inventaris.
            $backUrl = $isFromRak ? $previousUrl : route('user.inventaris'); 
        @endphp

        <a href="{{ $backUrl }}" 
           class="flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-primary hover:border-primary/30 transition-all duration-300 shadow-sm group">
            <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
        </a>

        <div class="logo-container p-2 rounded-xl shadow-sm border border-slate-200 relative">
            <img src="{{ asset('img/assets/esimprod_logo.png') }}" alt="ESIMPROD Logo" class="h-8 sm:h-10 w-auto relative z-10">
        </div>
        <div class="h-8 w-[1px] bg-slate-300 hidden sm:block"></div>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('user.inventaris.lapor-kerusakan.form', $barang->id) }}"
            class="group flex items-center justify-center gap-2 rounded-xl h-11 px-6 bg-red-600 text-white text-sm font-bold hover:bg-red-700 hover:shadow-lg hover:shadow-red-200 transition-all duration-300 transform active:scale-95">
            <span class="material-symbols-outlined text-base group-hover:rotate-12 transition-transform">report_problem</span>
            <span>Laporkan Kerusakan</span>
        </a>
    </div>
</header>

    {{-- Title Section --}}
    <div class="animate-premium stagger-1">
        <h2 class="text-3xl lg:text-4xl font-black text-slate-900 leading-tight">
            {{ $barang->nama_barang }}
        </h2>
        <div class="flex flex-wrap items-center gap-2 mt-2">
            <span class="px-3 py-1 bg-primary text-white rounded-full text-[10px] font-bold uppercase tracking-wider">Aset BMN</span>
            <span class="text-slate-400 text-sm">•</span>
            <span class="text-slate-500 text-sm">Update Sistem: {{ now()->format('d M Y') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Kolom Kiri: Detail Utama --}}
        <div class="lg:col-span-2 space-y-8 animate-premium stagger-2">
            
            {{-- Lokasi Card --}}
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

            {{-- Spesifikasi Lengkap (Disesuaikan dengan bmn/show) --}}
            <div class="glass-card p-8 rounded-2xl shadow-sm ring-1 ring-slate-200/50">
                <h3 class="text-slate-900 text-lg font-bold mb-8 flex items-center gap-2">
                    <span class="w-2 h-6 bg-accent rounded-full"></span>
                    Spesifikasi & Identitas Barang
                </h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-12 gap-y-8">
                    {{-- Baris 1 --}}
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Kode Barang / BMN</p>
                        <p class="font-mono font-bold text-primary text-lg">{{ $barang->kode_barang }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">NUP (Nomor Urut Pendaftaran)</p>
                        <p class="font-bold text-slate-700 text-lg">{{ $barang->nup ?? '-' }}</p>
                    </div>

                    {{-- Baris 2 --}}
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Merk / Brand</p>
                        <p class="font-bold text-slate-700 text-lg">{{ $barang->merk ?? '-' }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nomor Seri (S/N)</p>
                        <p class="font-bold text-slate-700 text-lg">{{ $barang->nomor_seri ?? '-' }}</p>
                    </div>

                    {{-- Baris 3 --}}
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Kondisi Fisik</p>
                        <div class="flex items-center gap-2">
                            <span class="h-3 w-3 rounded-full {{ $barang->persentase_kondisi >= 70 ? 'bg-green-500 animate-pulse' : 'bg-amber-500' }}"></span>
                            <p class="font-bold text-slate-800 text-lg">{{ $barang->kondisi }} ({{ $barang->persentase_kondisi }}%)</p>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Jumlah Unit</p>
                        <p class="font-bold text-slate-700 text-lg">{{ $barang->jumlah }} Unit</p>
                    </div>

                    {{-- Baris 4 --}}
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Perolehan</p>
                        <p class="font-bold text-slate-700 text-lg">
                            {{ $barang->tanggal_perolehan ? \Carbon\Carbon::parse($barang->tanggal_perolehan)->format('d F Y') : '-' }}
                        </p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nilai Perolehan</p>
                        <p class="font-bold text-accent text-lg">Rp {{ number_format($barang->nilai_perolehan, 0, ',', '.') }}</p>
                    </div>

                    {{-- Baris 5 --}}
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Kategori</p>
                        <p class="font-bold text-slate-700 text-lg">{{ $barang->kategori }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Asal Pengadaan</p>
                        <p class="font-bold text-slate-700 text-lg">{{ $barang->asal_pengadaan ?? '-' }}</p>
                    </div>
                </div>

                {{-- Catatan --}}
                <div class="mt-10 pt-8 border-t border-slate-100">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Deskripsi Tambahan</p>
                    <p class="text-slate-600 text-sm leading-relaxed italic">
                        "{{ $barang->catatan ?? 'Tidak ada deskripsi tambahan untuk barang ini.' }}"
                    </p>
                </div>
            </div>

            {{-- Visual Lokasi --}}
            <div class="glass-card p-6 rounded-2xl shadow-sm ring-1 ring-slate-200/50">
                 <h3 class="text-slate-900 text-lg font-bold mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-accent">map</span>
                    Foto Posisi Terpasang
                </h3>
                <div class="relative group rounded-xl overflow-hidden bg-slate-100 aspect-video flex items-center justify-center border border-slate-200 shadow-inner">
                    @if ($barang->posisi)
                        <img src="{{ asset('storage/' . $barang->posisi) }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="text-center space-y-2">
                            <span class="material-symbols-outlined text-4xl text-slate-300">image_not_supported</span>
                            <p class="text-xs text-slate-400 font-medium">Data visual lokasi tidak tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Media & Status --}}
        <div class="lg:col-span-1 space-y-8 animate-premium stagger-3">
            
            {{-- Foto Fisik --}}
            <div class="glass-card p-4 rounded-2xl shadow-md ring-1 ring-slate-200/50">
                <div class="relative group rounded-xl overflow-hidden bg-slate-50 aspect-square flex items-center justify-center border border-slate-100">
                    @if ($barang->foto)
                        <img src="{{ asset('storage/' . $barang->foto) }}" class="object-contain w-full h-full p-4 transition-transform duration-500 group-hover:scale-110">
                    @else
                        <span class="material-symbols-outlined text-6xl text-slate-200">inventory_2</span>
                    @endif
                </div>
                <div class="mt-4 text-center">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Foto Fisik Barang</p>
                </div>
            </div>

            {{-- QR Code --}}
            <div class="glass-card p-8 rounded-2xl shadow-md ring-1 ring-slate-200/50 flex flex-col items-center group">
                <div class="p-4 bg-white rounded-2xl shadow-inner border border-slate-100 transition-transform group-hover:scale-105 duration-300">
                    <img src="{{ asset('storage/' . $barang->qr_code) }}" class="w-40 h-40">
                </div>
                <div class="mt-6 text-center">
                    <h4 class="font-bold text-slate-800">QR Barang</h4>
                </div>
            </div>

            {{-- Status Perawatan --}}
            @if(!empty($perawatan))
            <div class="bg-amber-50 p-6 rounded-2xl border border-amber-200 relative overflow-hidden shadow-sm">
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-3 text-amber-700">
                        <span class="material-symbols-outlined animate-spin-slow">engineering</span>
                        <h4 class="font-bold">Maintenance Aktif</h4>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs">
                            <span class="text-amber-800/60 font-bold uppercase">Status:</span>
                            <span class="text-amber-700 font-black uppercase">{{ $perawatan->status }}</span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-amber-800/60 font-bold uppercase">Mulai:</span>
                            <span class="text-amber-700 font-bold">{{ \Carbon\Carbon::parse($perawatan->tanggal_perawatan)->format('d M Y') }}</span>
                        </div>
                    </div>w
                </div>
                <div class="absolute -right-2 -bottom-2 text-amber-200/40">
                    <span class="material-symbols-outlined text-7xl">build</span>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

</body>
</html>