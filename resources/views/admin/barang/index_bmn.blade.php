@extends('layouts.admin.main')

@section('content')
    {{-- BAGIAN ATAS: OPSI & FILTER --}}
    <div class="flex items-center ml-6 mr-3">
        {{-- Tombol Reset Filter --}}
        @if (request()->has('search') || request()->has('filter') || request()->has('ruangan_filter'))
            <a href="{{ route('barang.bmn_index') }}"
                class="mr-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none">
                Reset Filter
            </a>
        @endif

        {{-- Tombol Opsi Dropdown --}}
        <button id="dropdownRightButton" data-dropdown-toggle="dropdownRight" data-dropdown-placement="right"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            type="button" title="Menu"><i class="fa solid fa-gear mr-2"></i> Opsi
        </button>

        {{-- Isi Dropdown Opsi --}}
        <div id="dropdownRight"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li>
                    <a href="{{ route('bmn.create', 'general') }}"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        <i class="fa-solid fa-plus mr-2"></i> Tambah Barang
                    </a>
                </li>
                <li>
                    <button data-modal-target="print-modal" data-modal-toggle="print-modal"
                        class="w-full text-left block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <i class="fa-solid fa-print mr-2"></i> Menu Cetak & QR
                    </button>
                </li>
            </ul>
        </div>
    </div>

    {{-- FORM PENCARIAN --}}
<form class="flex flex-wrap items-center gap-2 max-w-4xl mx-auto ml-6 mr-3 mt-4" action="{{ url()->current() }}" method="GET">
    
    {{-- Filter Ruangan --}}
    <select name="ruangan_filter" onchange="this.form.submit()"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        <option value="">Semua Ruangan</option>
        @foreach ($list_ruangan as $rm)
            <option value="{{ $rm->nama_ruangan }}" {{ request('ruangan_filter') == $rm->nama_ruangan ? 'selected' : '' }}>
                {{ $rm->nama_ruangan }}
            </option>
        @endforeach
    </select>

    <div class="flex flex-1 space-x-2">
        <select name="filter" id="filter"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <option value="nama_barang" {{ request('filter') == 'nama_barang' ? 'selected' : '' }}>Nama Barang</option>
            <option value="kode_barang" {{ request('filter') == 'kode_barang' ? 'selected' : '' }}>Kode Barang</option>
            <option value="kategori" {{ request('filter') == 'kategori' ? 'selected' : '' }}>Kategori</option>
        </select>

        <div class="relative w-full">
            <input type="text" id="search" name="search" value="{{ request('search') }}" autocomplete="off"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="Cari BMN..." />
            <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2">
                <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </button>
        </div>
    </div>
</form>

    {{-- KONTEN UTAMA: GRID CARD --}}
    @if ($barang->isEmpty())
        <x-empty-data></x-empty-data>
    @endif

    <div class="flex justify-center p-3 ml-3 mr-3">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 w-full">
            @foreach ($barang as $b)
                @php
                    $detailRoute = route('bmn.show', [strtolower($b->ruangan), $b->id]);
                    $fotoPath = $b->foto ? asset('storage/' . $b->foto) : asset('img/no-image.png');
                @endphp

                <div
                    class="w-full bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-between overflow-hidden relative">

                    {{-- BADGE BMN (Sesuai Gambar) --}}
                    <div class="absolute top-3 left-3 z-10">
                        <span class="bg-blue-900 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                            BMN - {{ $b->kategori }}
                        </span>
                    </div>

                    {{-- GAMBAR BARANG --}}
                    <a href="{{ $detailRoute }}" class="block group">
                        <div
                            class="w-full h-48 flex items-center justify-center bg-gray-50 rounded-t-xl overflow-hidden relative">
                            <img src="{{ $fotoPath }}" alt="Foto {{ $b->nama_barang }}"
                                class="object-contain w-full h-full p-4 transition-transform duration-500 group-hover:scale-110" />
                            <div class="absolute inset-0 bg-blue-900/5 pointer-events-none"></div>
                        </div>
                    </a>

                    {{-- DETAIL INFO --}}
                    <div class="p-4 flex-1 flex flex-col gap-3">
                        <div>
                            <h3 class="font-bold text-gray-800 dark:text-gray-200 text-sm mb-3 line-clamp-2 leading-tight min-h-[2.5em]"
                                title="{{ $b->nama_barang }}">
                                {{ $b->nama_barang }}
                            </h3>

                            <div
                                class="space-y-1.5 bg-gray-50 dark:bg-gray-700/50 p-2.5 rounded-lg border border-gray-100 dark:border-gray-600">
                                <div class="flex justify-between items-center text-xs">
                                    <span class="text-gray-500 dark:text-gray-400">Kondisi</span>
                                    <span
                                        class="font-semibold {{ in_array($b->kondisi, ['Baik', 'Sangat Baik']) ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $b->kondisi }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center text-xs">
                                    {{-- UBAH LABEL TAHUN MENJADI TANGGAL --}}
                                    <span class="text-gray-500 dark:text-gray-400">Tanggal</span>
                                    <span class="font-medium text-gray-700 dark:text-gray-300">
                                        {{-- TAMPILKAN TANGGAL PEROLEHAN --}}
                                        {{ $b->tanggal_perolehan ? \Carbon\Carbon::parse($b->tanggal_perolehan)->format('d/m/Y') : '-' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- TOMBOL AKSI --}}
                        <div class="flex flex-wrap gap-2 mt-auto pt-2">
                            <a href="{{ $detailRoute }}"
                                class="flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-green-700 bg-green-50 border border-green-200 rounded-md hover:bg-green-100 transition-colors">
                                <i class="fa-regular fa-eye mr-1.5"></i> Detail
                            </a>

                            @if (Auth::user()->role == 'superadmin')
                                <a href="{{ route('bmn.edit', [strtolower($b->ruangan), $b->id]) }}"
                                    class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-yellow-700 bg-yellow-50 border border-yellow-200 rounded-md hover:bg-yellow-100 transition-colors">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>

                                <button data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                                    onclick="confirmDelete('{{ route('bmn.delete', [strtolower($b->ruangan), $b->id]) }}')"
                                    class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded-md hover:bg-red-100 transition-colors"
                                    type="button">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="p-3 ml-3 mr-3">
        {{ $barang->appends(request()->query())->links() }}
    </div>

    {{-- MODAL CETAK --}}
    <div id="print-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Cetak & QR (BMN)</h3>
                    <button type="button" data-modal-hide="print-modal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="p-4 md:p-5">
                    <form id="printForm" method="GET" target="_blank">
                        <input type="hidden" name="kategori" value="bmn">

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filter Ruangan
                                BMN</label>
                            <select id="print_ruangan" name="ruangan"
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:text-white">
                                <option value="all">Seluruh Ruangan</option>
                                {{-- DATA DINAMIS DARI DATABASE --}}
                                @foreach ($list_ruangan as $rm)
                                    <option value="{{ $rm->nama_ruangan }}">{{ $rm->nama_ruangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- GRID TOMBOL AKSI --}}
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <button type="button" onclick="submitPrint('{{ route('barang.print-barang') }}')"
                                class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                <i class="fa-solid fa-print mr-2"></i> Data BMN
                            </button>
                            <button type="button" onclick="submitPrint('{{ route('barang.print-qrcode') }}')"
                                class="text-white bg-gray-700 hover:bg-gray-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                <i class="fa-solid fa-qrcode mr-2"></i> QR BMN
                            </button>

                            {{-- Tombol ini sekarang SELALU MUNCUL (Tanpa class 'hidden') --}}
                            {{-- Jika user pilih 'Seluruh Ruangan', maka akan mencetak QR untuk semua pintu ruangan --}}
                            <button type="button" id="btn_qr_ruangan"
                                onclick="submitPrint('{{ route('barang.print-qr-ruangan') }}')"
                                class="col-span-2 text-white bg-[#1b365d] hover:bg-[#152a4a] font-medium rounded-lg text-sm px-5 py-2.5">
                                <i class="fa-solid fa-door-open mr-2"></i> Cetak QR Ruangan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div id="delete-modal" tabindex="-1" class="hidden fixed inset-0 z-50 justify-center items-center backdrop-blur-sm">
        <div class="relative p-4 w-full max-w-md">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 p-5 text-center">
                <i class="fa-solid fa-triangle-exclamation text-red-500 text-5xl mb-4"></i>
                <h3 class="mb-5 text-lg font-normal text-gray-500">Yakin ingin menghapus data BMN ini?</h3>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5">Ya,
                        Hapus</button>
                    <button type="button" data-modal-hide="delete-modal"
                        class="ms-3 text-sm font-medium text-gray-900 bg-white border rounded-lg px-5 py-2.5">Batal</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const ruanganSelect = document.getElementById('print_ruangan');

        // Kita tidak perlu lagi menyembunyikan tombol QR Ruangan Saja
        // karena sekarang mendukung opsi 'Seluruh Ruangan' (all)
        function submitPrint(url) {
            const form = document.getElementById('printForm');
            form.action = url;
            form.submit();
        }

        function confirmDelete(url) {
            document.getElementById('deleteForm').action = url;
        }
    </script>
@endsection
