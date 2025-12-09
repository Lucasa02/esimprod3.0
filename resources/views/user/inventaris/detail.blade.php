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
                        "primary": "#137fec",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    }
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
</head>

<body class="font-display bg-background-light min-h-screen">

<div class="p-6 max-w-6xl mx-auto space-y-8">

    <!-- Heading -->
    <div>
        <h1 class="text-3xl font-black text-gray-900">{{ $barang->nama_barang }}</h1>
        <p class="text-gray-500 text-sm">Detail lengkap barang</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Detail Utama -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Detail Barang -->
            <div class="bg-white p-6 rounded-xl border border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Barang</h3>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <p class="text-gray-500">Kode Barang:</p>
                    <p class="font-medium text-gray-900">{{ $barang->kode_barang }}</p>

                    <p class="text-gray-500">NUP:</p>
                    <p class="font-medium text-gray-900">{{ $barang->nup ?? '-' }}</p>

                    <p class="text-gray-500">Kategori:</p>
                    <p class="font-medium text-gray-900">{{ $barang->kategori }}</p>

                    <p class="text-gray-500">Kondisi:</p>
                    <p class="font-medium text-gray-900">{{ $barang->kondisi }}</p>

                    <p class="text-gray-500">Tahun Perolehan:</p>
                    <p class="font-medium text-gray-900">{{ $barang->tahun_pengadaan }}</p>
                </div>
            </div>
        </div>

        <!-- Foto & QR -->
        <div class="space-y-6">

            <!-- Foto Barang -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 flex flex-col items-center">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Foto Barang</h3>

                <div class="w-full aspect-square bg-gray-200 rounded-lg overflow-hidden flex items-center justify-center">
                    @if ($barang->foto)
                        <img src="{{ asset('storage/' . $barang->foto) }}" class="object-cover w-full h-full">
                    @else
                        <span class="text-gray-400 text-sm">Tidak ada foto</span>
                    @endif
                </div>
            </div>

            <!-- QR Code -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 flex flex-col items-center">
                <h3 class="text-lg font-bold text-gray-900 mb-4">QR Code</h3>
                <div class="w-full aspect-square bg-white flex items-center justify-center rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $barang->qr_code) }}" class="object-contain w-3/4 h-3/4">
                </div>
                <p class="text-xs text-gray-500 mt-2">Scan untuk lihat detail</p>
            </div>

        </div>
    </div>

</div>

</body>
</html>
