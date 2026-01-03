@extends('layouts.admin.main')

@section('content')
  <div class="flex items-center ml-6 mr-3">
    {{-- Tombol Reset Filter --}}
    @if (request()->has('search') || request()->has('filter'))
      <a href="{{ route('barang.index') }}"
        class="mr-3 text-white bg-gray-700 hover:bg-gray-800 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none">
        Reset Filter
      </a>
    @endif

    {{-- Tombol Opsi Dropdown (Mengikuti Gaya BMN) --}}
    <button id="dropdownRightButton" data-dropdown-toggle="dropdownRight" data-dropdown-placement="right"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
        type="button" title="Menu">
        <i class="fa-solid fa-gear mr-2"></i> Opsi
    </button>

    {{-- Isi Dropdown Opsi --}}
    <div id="dropdownRight" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-52 dark:bg-gray-700 border border-gray-100 dark:border-gray-600">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRightButton">
            <li>
                <a href="{{ route('barang.create') }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <i class="fa-solid fa-plus mr-2 text-blue-600"></i> Tambah Barang
                </a>
            </li>
            <li>
                <button data-modal-target="print-modal" data-modal-toggle="print-modal"
                    class="w-full text-left block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <i class="fa-solid fa-print mr-2 text-gray-600"></i> Menu Cetak & QR
                </button>
            </li>
        </ul>
    </div>
  </div>

  {{-- Search Filter --}}
  <form class="flex items-center max-w-md mx-auto ml-6 mr-3 mt-4" action="{{ route('barang.index') }}" method="GET">
    <div class="flex w-full space-x-2">
      <select name="filter" id="filter"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        <option value="nama_barang" {{ request('filter') == 'nama_barang' ? 'selected' : '' }}>Nama Barang</option>
        <option value="kode_barang" {{ request('filter') == 'kode_barang' ? 'selected' : '' }}>Kode Barang</option>
        {{-- Tambahan Opsi Baru --}}
        <option value="jenis_barang" {{ request('filter') == 'jenis_barang' ? 'selected' : '' }}>Jenis Barang</option>
        <option value="nomor_seri" {{ request('filter') == 'nomor_seri' ? 'selected' : '' }}>Nomor Seri</option>
      </select>

      <div class="relative w-full">
        <input type="text" id="search" name="search" value="{{ request('search') }}" autocomplete="off"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
          placeholder="Cari sesuai kategori..." />
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
      </div>
    </div>
</form>          

  @if ($barang->isEmpty())
    <x-empty-data></x-empty-data>
  @endif
 
  {{-- Grid Barang --}}
  <div class="flex justify-center p-3 ml-3 mr-3">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 w-full">
      @foreach ($barang as $b)
        @php
            $detailRoute = route('barang.show', $b->uuid);
            $fotoPath = asset('storage/uploads/foto_barang/' . $b->foto);
        @endphp

        <div class="w-full bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-between overflow-hidden">
          
          {{-- FOTO & LINK --}}
          <a href="{{ $detailRoute }}" class="block group">
            <div class="w-full h-48 flex items-center justify-center bg-gray-50 rounded-t-xl overflow-hidden relative">
                <img src="{{ $fotoPath }}"
                    alt="Foto Barang"
                    class="object-contain w-full h-full p-4 transition-transform duration-500 group-hover:scale-110" />
                
                {{-- Badge Jenis --}}
                <div class="absolute top-3 left-3 flex flex-col items-start gap-1.5 z-10">
                    <span class="bg-blue-900 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                        {{ $b->jenisBarang->jenis_barang ?? '-' }}
                    </span>
                </div>
            </div>
          </a>

          {{-- BODY CARD --}}
          <div class="p-4 flex-1 flex flex-col gap-3">
            <div>
                <h3 class="font-bold text-gray-800 dark:text-gray-200 text-sm mb-3 line-clamp-2 leading-tight min-h-[2.5em]" title="{{ $b->nama_barang }}">
                  {{ $b->nama_barang }}
                </h3>

                {{-- Info Sisa Limit --}}
                <div class="flex justify-between items-center text-xs bg-gray-50 dark:bg-gray-700/50 p-2.5 rounded-lg border border-gray-100 dark:border-gray-600">
                    <span class="text-gray-500 dark:text-gray-400">Sisa Limit</span>
                    <span class="font-bold text-gray-700 dark:text-gray-300">
                        {{ $b->sisa_limit }}
                    </span>
                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="flex flex-wrap gap-2 mt-auto pt-2">
              <a href="{{ $detailRoute }}" title="Detail"
                class="flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-green-700 bg-green-50 border border-green-200 rounded-md hover:bg-green-100 transition-colors">
                <i class="fa-regular fa-eye mr-1.5"></i> Detail
              </a>

              @if (Auth::user()->role == 'superadmin')
                <a href="{{ route('barang.edit', ['uuid' => $b->uuid, 'page' => request('page')]) }}" title="Edit"
                    class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-yellow-700 bg-yellow-50 border border-yellow-200 rounded-md hover:bg-yellow-100">
                    <i class="fa-regular fa-pen-to-square"></i>
                </a>
                
                <button data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                    onclick="confirmDelete('{{ route('barang.destroy', ['uuid' => $b->uuid]) }}')"
                    class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded-md hover:bg-red-100"
                    type="button" title="Hapus">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  {{-- Pagination --}}
  <div class="p-3 ml-3 mr-3">
    {{ $barang->appends(request()->query())->links() }}
  </div>

  {{-- Modal Cetak --}}
  <div id="print-modal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Cetak Barang</h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="print-modal">
                      <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                  </button>
              </div>
              
              <div class="p-4 md:p-5">
        <form id="printForm" method="GET" target="_blank">
            <input type="hidden" name="kategori" value="master">
            
            <p class="text-sm text-gray-500 mb-4 text-center">Pilih format output untuk data Barang Master yang tampil.</p>
            
                    <div class="grid grid-cols-2 gap-4">
                        <button type="button" onclick="submitPrint('{{ route('barang.print-barang') }}')" 
                            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <i class="fa-solid fa-print mr-2"></i> Cetak PDF
                        </button>
                        <button type="button" onclick="submitPrint('{{ route('barang.print-qrcode') }}')" 
                            class="text-white bg-gray-700 hover:bg-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <i class="fa-solid fa-qrcode mr-2"></i> Cetak QR
                        </button>
                    </div>
                </form>
            </div>
          </div>
      </div>
  </div>

  {{-- Modal Delete --}}
  <div id="delete-modal" tabindex="-1" class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 p-5 text-center">
          <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
          <h3 class="mb-5 text-lg font-normal text-gray-500">Yakin ingin menghapus data ini?</h3>
          <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" value="{{ $barang->currentPage() }}">
            <button type="submit" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5">Ya, Hapus</button>
            <button data-modal-hide="delete-modal" type="button" class="ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 px-5 py-2.5">Tidak</button>
          </form>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
    function submitPrint(url) {
        const form = document.getElementById('printForm');
        form.action = url;
        form.submit();
    }

    function confirmDelete(url) {
      const form = document.getElementById('deleteForm');
      form.action = url;
    }
</script>
@endsection