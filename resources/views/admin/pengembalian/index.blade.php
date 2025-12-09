@extends('layouts.admin.main')

@section('content')
  <div class="p-3 ml-3 mr-3">

    {{-- BAGIAN HEADER & TOMBOL AKSI --}}
    <div class="flex flex-col mb-6">
      
      {{-- Judul Halaman telah dihapus --}}

      <div class="flex flex-wrap items-center gap-3">
        {{-- TOMBOL CETAK PDF --}}
        <a href="{{ route('pengembalian.cetak', request()->only(['search', 'bulan', 'tahun', 'status'])) }}"
           class="flex items-center space-x-2 text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-4 py-2"
           target="_blank">
           <i class="fa-solid fa-print"></i>
           <span>Cetak PDF</span>
        </a>

        {{-- TOMBOL BUKA/TUTUP FILTER --}}
        <button type="button" id="toggle-filter-btn"
          class="flex items-center space-x-2 text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-4 py-2 focus:ring-4 focus:ring-blue-300">
          <i class="fa-solid fa-filter"></i>
          <span>Filter Pencarian</span>
        </button>

        {{-- TOMBOL KEMBALI (Jika sedang mode search & hasil kosong) --}}
        @if (Route::currentRouteName() == 'pengembalian.search' && $pengembalian->isEmpty())
          <a href="{{ route('pengembalian.index') }}"
             class="text-white bg-gray-600 hover:bg-gray-700 font-medium rounded-lg text-sm px-4 py-2">
            Kembali ke Semua Data
          </a>
        @endif
      </div>
    </div>

    {{-- BAGIAN FILTER (TERSEMBUNYI DEFAULT) --}}
    <div id="filter-container" class="hidden mb-6 p-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
      <form action="{{ route('pengembalian.search') }}" method="GET" class="flex flex-col md:flex-row flex-wrap gap-3 w-full">
        
        {{-- Input Search --}}
        <div class="flex-1 min-w-[200px]">
           <input id="search-input" type="text" name="search" value="{{ request('search') }}"
             placeholder="Cari kode pengembalian..."
             class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>

        {{-- Select Bulan --}}
        <div>
           <select name="bulan" class="w-full md:w-auto bg-white border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
             <option value="">Semua Bulan</option>
             @for ($m = 1; $m <= 12; $m++)
               <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                 {{ date('F', mktime(0, 0, 0, $m, 1)) }}
               </option>
             @endfor
           </select>
        </div>

        {{-- Select Tahun --}}
        <div>
           <select name="tahun" class="w-full md:w-auto bg-white border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
             <option value="">Semua Tahun</option>
             @for ($y = 2023; $y <= date('Y'); $y++)
               <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                 {{ $y }}
               </option>
             @endfor
           </select>
        </div>

        {{-- Select Status --}}
        <div>
           <select name="status" class="w-full md:w-auto bg-white border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
             <option value="">Semua Status</option>
             <option value="Lengkap" {{ request('status') == 'Lengkap' ? 'selected' : '' }}>Lengkap</option>
             <option value="Tidak Lengkap" {{ request('status') == 'Tidak Lengkap' ? 'selected' : '' }}>Tidak Lengkap</option>
           </select>
        </div>

        {{-- Tombol Terapkan --}}
        <button type="submit" class="flex items-center space-x-2 text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-4 py-2 focus:ring-4 focus:ring-blue-300">
          Terapkan
        </button>

      </form>
    </div>

    {{-- TABEL DATA --}}
    @if ($pengembalian->isEmpty())
      <x-empty-data></x-empty-data>
    @else
      <div class="relative overflow-x-auto sm:rounded-lg border rounded-lg shadow-sm">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3 text-center">No.</th>
              <th scope="col" class="px-6 py-3 text-center">Kode Pengembalian</th>
              <th scope="col" class="px-6 py-3 text-center">Kode Penggunaan</th>
              <th scope="col" class="px-6 py-3 text-center">Tanggal Kembali</th>
              <th scope="col" class="px-6 py-3 text-center">Peminjam</th>
              <th scope="col" class="px-6 py-3 text-center">Status</th>
              <th scope="col" class="px-6 py-3 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pengembalian as $row)
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                  {{ $pengembalian->firstItem() + $loop->index }}
                </th>
                <td class="px-6 py-4 text-center font-medium">{{ $row->kode_pengembalian }}</td>
                <td class="px-6 py-4 text-center">{{ $row->kode_peminjaman }}</td>
                <td class="px-6 py-4 text-center">{{ date('d F Y', strtotime($row->tanggal_kembali)) }}</td>
                <td class="px-6 py-4 text-center">{{ $row->peminjam }}</td>
                <td class="px-6 py-4 text-center">
                  @if ($row->status == 'Tidak Lengkap')
                    <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                      <i class="fa-solid fa-circle-xmark mr-1"></i>Tidak Lengkap
                    </span>
                  @else
                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                      <i class="fa-solid fa-circle-check mr-1"></i>Lengkap
                    </span>
                  @endif
                </td>
                <td class="flex items-center px-6 py-4 justify-center space-x-2">
                  <a href="{{ route('pengembalian.show', ['uuid' => $row->uuid]) }}"
                    class="text-white bg-yellow-400 hover:bg-yellow-500 font-medium rounded-lg text-sm px-3 py-1.5 focus:outline-none">
                    Detail
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif

    <div class="mt-4">
      {{ $pengembalian->links() }}
    </div>

  </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Logic untuk Search agar tidak kosong saat enter
    const searchInput = document.getElementById('search-input');
    if(searchInput){
        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && searchInput.value.trim() === "") {
                e.preventDefault();
                alert("Kolom pencarian tidak boleh kosong!");
            }
        });
    }

    // Logic Toggle Filter (Buka/Tutup)
    const toggleBtn = document.getElementById('toggle-filter-btn');
    const filterContainer = document.getElementById('filter-container');

    toggleBtn.addEventListener('click', function() {
        filterContainer.classList.toggle('hidden');
    });

    // Menjaga filter tetap terbuka jika ada parameter URL
    const urlParams = new URLSearchParams(window.location.search);
    if(urlParams.has('search') || urlParams.has('bulan') || urlParams.has('tahun') || urlParams.has('status')) {
        filterContainer.classList.remove('hidden');
    }
});
</script>