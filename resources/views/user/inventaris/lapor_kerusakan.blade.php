<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Lapor Kerusakan Barang - Report Damaged Item</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,container-queries"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet"
    />

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    fontFamily: {
                        sans: ["Inter", "sans-serif"],
                    },
                    colors: {
                        primary: {
                            50: "#eef2ff",
                            100: "#e0e7ff",
                            200: "#c7d2fe",
                            300: "#a5b4fc",
                            400: "#818cf8",
                            500: "#6366f1",
                            600: "#1B365D",
                            700: "#4338ca",
                            800: "#3730a3",
                            900: "#312e81",
                        },
                        slate: {
                            850: "#172033",
                        },
                    },
                    animation: {
                        "fade-in": "fadeIn 0.5s ease-out",
                        "slide-up": "slideUp 0.5s ease-out",
                    },
                    keyframes: {
                        fadeIn: {
                            "0%": { opacity: "0" },
                            "100%": { opacity: "1" },
                        },
                        slideUp: {
                            "0%": {
                                transform: "translateY(10px)",
                                opacity: "0",
                            },
                            "100%": {
                                transform: "translateY(0)",
                                opacity: "1",
                            },
                        },
                    },
                },
            },
        };
    </script>
</head>


<body
    class="bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-900 dark:to-slate-800 min-h-screen flex items-center justify-center p-4 transition-colors duration-300 font-sans text-slate-900 dark:text-slate-100"
>
    <div class="w-full max-w-xl animate-slide-up">
        <div
            class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl overflow-hidden border border-white/50 dark:border-slate-700/50 backdrop-blur-sm transition-all duration-300"
        >
            <div
                class="bg-primary-50 dark:bg-slate-800/50 p-6 sm:p-8 border-b border-primary-100 dark:border-slate-700"
            >
                <div class="flex items-start justify-between">
                    <div>
                        <h1
                            class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white tracking-tight"
                        >
                            Lapor Kerusakan
                        </h1>
                        <p
                            class="text-slate-500 dark:text-slate-400 mt-1 text-sm"
                        >
                            Submit a damage report ticket
                        </p>
                    </div>
 <div
                        class="hidden sm:flex h-12 w-12 bg-primary-100 dark:bg-primary-900/30 rounded-full items-center justify-center text-primary-600 dark:text-primary-400"
                    >
                        <span class="material-symbols-outlined text-2xl">
                            assignment_late
                        </span>
                    </div>
                </div>
{{-- INFORMASI BARANG --}}
 <div
                    class="mt-6 flex items-center p-3 bg-white dark:bg-slate-900/50 rounded-lg border border-primary-100 dark:border-slate-700 shadow-sm"
                >
                    <div
    class="flex-shrink-0 h-10 w-10 rounded-md bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 dark:text-slate-400"
>
    <span class="material-symbols-outlined">
        inventory_2
    </span>
</div>

<div class="ml-3 flex-1">
                        <p
                            class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider"
                        >
                            Item Details
                        </p>
<p
                        class="text-sm font-semibold text-slate-900 dark:text-white"
                        >{{ $barang->nama_barang }}</p>
</div>
 <div class="flex-shrink-0">
                        <span
                            class="inline-flex items-center rounded-full bg-green-50 dark:bg-green-900/30 px-2 py-1 text-xs font-medium text-green-700 dark:text-green-400 ring-1 ring-inset ring-green-600/20"
                        >
                            Active Asset
                        </span>
                    </div>
</div>
</div>

{{-- ALERT SUCCESS --}}
@if (session('success'))
<div class="p-4 bg-green-100 text-green-800 text-sm">
    {{ session('success') }}
</div>
@endif

 <div class="p-6 sm:p-8 space-y-6 bg-white dark:bg-slate-800">

<form action="{{ route('user.inventaris.lapor-kerusakan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">

    @csrf
    <input type="hidden" name="barang_id" value="{{ $barang->id }}">

    {{-- JENIS KERUSAKAN --}}
    <div class="group">
        <label for="jenis_kerusakan" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 transition-colors group-focus-within:text-primary-600 dark:group-focus-within:text-primary-400">
            Jenis Kerusakan
            <span class="text-red-500">*</span>
        </label>
        <div class="relative">
            <select
                id="jenis_kerusakan"
                name="jenis_kerusakan"
                required
                class="block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm py-3 px-4 transition-all duration-200 shadow-sm appearance-none"
            >
                <option value="" disabled selected>Pilih jenis kerusakan...</option>
                @foreach ($jenis_kerusakan as $jk)
                    <option value="{{ $jk->nama_jenis_kerusakan }}">{{ $jk->nama_jenis_kerusakan }}</option>
                @endforeach
            </select>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                <span class="material-symbols-outlined text-lg">
                    expand_more
                </span>
            </div>
        </div>
    </div>

    {{-- DESKRIPSI --}}
    <div class="group">
        <label for="deskripsi" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 transition-colors group-focus-within:text-primary-600 dark:group-focus-within:text-primary-400">
            Deskripsi Detail
            <span class="text-red-500">*</span>
        </label>

        <textarea
            id="deskripsi"
            name="deskripsi"
            rows="4"
            required
            placeholder="Jelaskan kronologi dan kondisi kerusakan secara rinci..."
            class="block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-white placeholder-slate-400 focus:border-primary-500 focus:ring-primary-500 sm:text-sm p-4 transition-all duration-200 resize-none shadow-sm"
        ></textarea>
    </div>

    {{-- FOTO --}}
     <div>
    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
        Foto Bukti
    </label>

                        <div
                            class="mt-1 flex justify-center px-6 pt-6 pb-6 border-2 border-slate-300 dark:border-slate-600 border-dashed rounded-xl hover:border-primary-500 dark:hover:border-primary-400 hover:bg-primary-50/50 dark:hover:bg-slate-700/50 transition-all duration-200 relative group cursor-pointer">
                            <div class="space-y-2 text-center">
                                <div
                                    class="mx-auto h-12 w-12 text-slate-400 dark:text-slate-500 group-hover:text-primary-500 dark:group-hover:text-primary-400 transition-colors duration-200 flex items-center justify-center rounded-full bg-slate-100 dark:bg-slate-700 group-hover:bg-white dark:group-hover:bg-slate-600 shadow-sm">
                                    <span
                                        class="material-symbols-outlined text-3xl">
                                        cloud_upload
                                    </span>
                                </div>

                                <div
                                    class="text-sm text-slate-600 dark:text-slate-400">
                                    <span
                                        class="font-semibold text-primary-600 dark:text-primary-400 hover:text-primary-500 hover:underline">
                                        Click to upload
                                    </span>
                                    <span class="text-slate-500">
                                        or drag and drop
                                    </span>
                                </div>

                                <p
                                    class="text-xs text-slate-400 dark:text-slate-500"
                                >
                                    PNG, JPG up to 10MB
                                </p>

                                <p
                                    id="file-name"
                                    class="text-sm font-medium text-primary-600 dark:text-primary-400 mt-2 h-5 transition-all"
                                ></p>
                            </div>

                            <input
                            id="file-upload"
                            name="foto" {{-- UBAH DARI 'file-upload' MENJADI 'foto' --}}
                            type="file"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                            onchange="const name = this.files[0]?.name; document.getElementById('file-name').textContent = name ? 'Selected: ' + name : '';"
                        />
                    </div>
                </div>
<div class="pt-2 flex flex-col-reverse sm:flex-row gap-3">
<a class="w-full sm:w-auto px-6 py-3 border border-slate-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-lg text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all text-center" href="{{ url()->previous() }}">
                            Batal
                        </a>
<button class="w-full flex-1 flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all transform active:scale-[0.98]" type="submit">
                            Kirim Laporan
                        </button>


</form>
</div>
</div>
</div>

</body>
</html>