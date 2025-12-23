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

    {{-- Tombol Opsi Dropdown --}}
    <button id="dropdownRightButton" data-dropdown-toggle="dropdownRight" data-dropdown-placement="right"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
      type="button" title="Menu"><i class="fa solid fa-gear mr-2"></i> Opsi
    </button>

    {{-- Isi Dropdown Opsi --}}
    <div id="dropdownRight" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
      <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
        
        {{-- START: Multi-Level Dropdown Tambah --}}
        <li class="relative">
          {{-- PERUBAHAN ADA DI SINI: Tambahkan data-dropdown-trigger="hover" --}}
          <button id="doubleDropdownButton" 
                  data-dropdown-toggle="doubleDropdown" 
                  data-dropdown-placement="right-start" 
                  data-dropdown-trigger="hover" 
                  type="button" 
                  class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            <span>Tambah Barang</span>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
          </button>
          
          <div id="doubleDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
              <li>
                <a href="{{ route('barang.create') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Barang TX</a>
              </li>
              <li>
                <a href="{{ route('bmn.create', 'general') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Barang BMN</a>
              </li>
            </ul>
          </div>
        </li>
        
        {{-- MENU CETAK MEMBUKA MODAL --}}
        <li>
          <button data-modal-target="print-modal" data-modal-toggle="print-modal" 
            class="w-full text-left block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            Menu Cetak & QR
          </button>
        </li>
      </ul>
    </div>
  </div>

  <form class="flex items-center max-w-md mx-auto ml-6 mr-3 mt-2" action="{{ route('barang.index') }}" method="GET">
    <label for="simple-search" class="sr-only">Search</label>
    <div class="flex w-full space-x-2">
      <select name="filter" id="filter" onchange="toggleSearchInput()"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
        <option value="nama_barang" {{ request('filter') == 'nama_barang' ? 'selected' : '' }}>Nama Barang</option>
        <option value="kategori_data" {{ request('filter') == 'kategori_data' ? 'selected' : '' }}>Kategori Data (Master/BMN)</option>
        <option value="ruangan" {{ request('filter') == 'ruangan' ? 'selected' : '' }}>Ruangan (BMN)</option>
        <option value="kode_barang" {{ request('filter') == 'kode_barang' ? 'selected' : '' }}>Kode Barang</option>
      </select>

      <div class="relative w-full">
        {{-- Input Text Biasa --}}
        <input type="text" id="search" name="search" value="{{ request('search') }}" autocomplete="off"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
          placeholder="Cari..." />
          
        <svg class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-tvri_base_color" aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m19 19-4-4m0-7A7 7 0 1 1  1 8a7 7 0 0 1 14 0Z" />
        </svg>
      </div>
    </div>
  </form>          

  @if ($barang->isEmpty())
    <x-empty-data></x-empty-data>
  @endif
 
  <div class="flex justify-center p-3 ml-3 mr-3">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 w-full">
      @foreach ($barang as $b)
        {{-- LOGIC DETEKSI TIPE BARANG --}}
        @php
            $isBmn = isset($b->ruangan); 
            $detailRoute = $isBmn 
                ? route('bmn.show', [strtolower($b->ruangan), $b->id]) 
                : route('barang.show', $b->uuid);

            $fotoPath = $isBmn 
                ? ($b->foto ? asset('storage/' . $b->foto) : asset('img/no-image.png'))
                : asset('storage/uploads/foto_barang/' . $b->foto);
        @endphp

        <div class="w-full bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-between overflow-hidden">
          
          {{-- FOTO & LINK --}}
          <a href="{{ $detailRoute }}" class="block group">
            
            {{-- CONTAINER GAMBAR --}}
            <div class="w-full h-48 flex items-center justify-center bg-gray-50 rounded-t-xl overflow-hidden relative">
                <img src="{{ $fotoPath }}"
                    alt="Foto Barang"
                    class="object-contain w-full h-full p-4 transition-transform duration-500 group-hover:scale-110" />
                
                @if($isBmn)
                    <div class="absolute inset-0 bg-blue-900/5 pointer-events-none"></div>
                @endif

                {{-- BADGE ITEM --}}
              <div class="absolute top-3 left-3 flex flex-col items-start gap-1.5 z-10">
                  <span class="bg-blue-900 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                    @if($isBmn)
                        BMN - {{ $b->kategori }}
                    @else
                        {{ $b->jenisBarang->jenis_barang ?? '-' }}
                    @endif
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

                {{-- INFO AREA --}}
                <div class="space-y-1.5 bg-gray-50 dark:bg-gray-700/50 p-2.5 rounded-lg border border-gray-100 dark:border-gray-600">
                    @if($isBmn)
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-500 dark:text-gray-400">Kondisi</span>
                            <span class="font-semibold {{ $b->kondisi == 'Sangat Baik' || $b->kondisi == 'Baik' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $b->kondisi }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-500 dark:text-gray-400">Tahun</span>
                            <span class="font-medium text-gray-700 dark:text-gray-300">{{ $b->tahun_pengadaan ?? '-' }}</span>
                        </div>
                    @else
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-500 dark:text-gray-400">Sisa Limit</span>
                            <span class="font-bold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-600 px-1.5 rounded border border-gray-200 dark:border-gray-500">
                                {{ $b->sisa_limit }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center text-xs pt-1 border-t border-gray-200 dark:border-gray-600 mt-1">
                            <span class="text-gray-500 dark:text-gray-400">Status</span>
                            @if ($b->sisa_limit == 0)
                                <span class="text-red-600 font-semibold text-[10px]">Habis</span>
                            @elseif ($b->status == 'ditemukan')
                                <span class="text-blue-600 font-semibold text-[10px]">Hilang</span>
                            @else
                                <span class="text-green-600 font-semibold text-[10px]">Tersedia</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="flex flex-wrap gap-2 mt-auto pt-2">
              <a href="{{ $detailRoute }}" title="Detail"
                class="flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-green-700 bg-green-50 border border-green-200 rounded-md hover:bg-green-100 focus:ring-2 focus:ring-green-300 transition-colors">
                <i class="fa-regular fa-eye mr-1.5"></i> Detail
              </a>

              @if (Auth::user()->role == 'superadmin')
                @if($isBmn)
                      <a href="{{ route('bmn.edit', [strtolower($b->ruangan), $b->id]) }}" title="Edit"
                        class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-yellow-700 bg-yellow-50 border border-yellow-200 rounded-md hover:bg-yellow-100 focus:ring-2 focus:ring-yellow-300 transition-colors">
                        <i class="fa-regular fa-pen-to-square"></i>
                      </a>

                      <button data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                        onclick="confirmDelete('{{ route('bmn.delete', [strtolower($b->ruangan), $b->id]) }}')"
                        class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded-md hover:bg-red-100 focus:ring-2 focus:ring-red-300 transition-colors"
                        type="button" title="Hapus">
                        <i class="fa-regular fa-trash-can"></i>
                      </button>

                @else
                    <a href="{{ route('barang.edit', ['uuid' => $b->uuid, 'page' => request('page')]) }}" title="Edit"
                        class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-yellow-700 bg-yellow-50 border border-yellow-200 rounded-md hover:bg-yellow-100 focus:ring-2 focus:ring-yellow-300 transition-colors">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    
                    <button data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                        onclick="confirmDelete('{{ route('barang.destroy', ['uuid' => $b->uuid]) }}')"
                        class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded-md hover:bg-red-100 focus:ring-2 focus:ring-red-300 transition-colors"
                        type="button" title="Hapus">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                @endif
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <div class="p-3 ml-3 mr-3">
    {{ $barang->appends(request()->query())->links() }}
  </div>

  <div id="print-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Opsi Cetak & QR Code
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="print-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              
              {{-- FORM CETAK --}}
<div class="p-4 md:p-5">
    <form id="printForm" action="" method="GET" target="_blank">
        
        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Jenis Data</label>
            <select id="print_kategori" name="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                <option value="all">Semua Barang (Master & BMN)</option>
                <option value="master">Hanya Barang Master</option>
                <option value="bmn">Hanya Barang BMN</option>
            </select>
        </div>

        <div id="print_ruangan_container" class="mb-4 hidden">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Ruangan (BMN)</label>
    {{-- TAMBAHKAN id="print_ruangan" --}}
    <select id="print_ruangan" name="ruangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
        <option value="all">Seluruh Barang BMN</option>
        <option value="MCR">MCR</option>
        <option value="Studio 1">Studio 1</option>
        <option value="Studio 2">Studio 2</option>
    </select>
</div>

        {{-- START: Tambahan Kode dari Gambar --}}
        <div id="rak_khusus_container" class="p-4 md:p-5 border-t mt-4 dark:border-gray-600 hidden">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opsi Khusus Rak</label>
    <button type="button" onclick="submitPrint('{{ route('barang.print-qr-rak') }}')" 
        class="w-full text-black bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700">
        <i class="fa-solid fa-layer-group mr-2"></i> Cetak Semua QR Rak MCR
    </button>
</div>
        {{-- END: Tambahan Kode dari Gambar --}}

        <div class="grid grid-cols-2 gap-4 mt-4">
            <button type="button" onclick="submitPrint('{{ route('barang.print-barang') }}')" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="fa-solid fa-print mr-2"></i> Cetak Data
            </button>
            <button type="button" onclick="submitPrint('{{ route('barang.print-qrcode') }}')" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                <i class="fa-solid fa-qrcode mr-2"></i> Cetak QR
            </button>
        </div>
    </form>
</div>
          </div>
      </div>
  </div>

  <div id="delete-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button type="button"
          class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="delete-modal">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="p-4 md:p-5 text-center">
          <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin menghapus data ?</h3>

          <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="page" value="{{ $barang->currentPage() }}">
            <button type="submit"
              class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
              Ya
            </button>
            <button data-modal-hide="delete-modal" type="button"
              class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
              Tidak
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
    const kategoriSelect = document.getElementById('print_kategori');
    const ruanganSelect = document.getElementById('print_ruangan'); // Element baru
    const ruanganContainer = document.getElementById('print_ruangan_container');
    const rakKhususContainer = document.getElementById('rak_khusus_container'); // Container Rak

    function updateModalVisibility() {
        const selectedKategori = kategoriSelect.value;
        const selectedRuangan = ruanganSelect.value;

        // 1. Logika Tampilkan Select Ruangan
        if (selectedKategori === 'bmn') {
            ruanganContainer.classList.remove('hidden');
        } else {
            ruanganContainer.classList.add('hidden');
            // Reset ruangan ke 'all' jika kategori bukan BMN agar rak hidden kembali
            ruanganSelect.value = 'all'; 
        }

        // 2. Logika Tampilkan Opsi Khusus Rak
        // Muncul HANYA JIKA Kategori = BMN DAN Ruangan = MCR
        if (selectedKategori === 'bmn' && selectedRuangan === 'MCR') {
            rakKhususContainer.classList.remove('hidden');
        } else {
            rakKhususContainer.classList.add('hidden');
        }
    }

    // Jalankan fungsi setiap kali ada perubahan pada Kategori
    kategoriSelect.addEventListener('change', updateModalVisibility);

    // Jalankan fungsi setiap kali ada perubahan pada Ruangan
    ruanganSelect.addEventListener('change', updateModalVisibility);

    // Fungsi Submit (Tetap sama)
    function submitPrint(url) {
        const form = document.getElementById('printForm');
        form.action = url;
        form.submit();
    }

    // Logic Delete (Tetap sama)
    function confirmDelete(url) {
      const form = document.getElementById('deleteForm');
      form.action = url;
    }
</script>
@endsection