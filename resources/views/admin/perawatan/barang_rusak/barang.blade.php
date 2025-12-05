@extends('layouts.admin.main')
@section('content')
  @if ($barang->isEmpty())
    <x-empty-data></x-empty-data>
  @endif

  <div class="flex flex-col md:flex-row md:items-center md:space-x-3 p-3 ml-3 mr-3">

    <!-- Filter Jenis Barang -->
    <form action="{{ route('perawatan.barang.rusak.index') }}" method="GET" class="flex space-x-3 w-full md:w-auto">

        <select name="jenis_barang_id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5">
            <option value="">-- Semua Jenis Barang --</option>

            @foreach ($jenisBarang as $j)
                <option value="{{ $j->id }}" {{ request('jenis_barang_id') == $j->id ? 'selected' : '' }}>
                    {{ $j->jenis_barang }}
                </option>
            @endforeach
        </select>

        <!-- Search -->
        <input type="text" name="search" placeholder="Kode Barang/Nomor Seri"
            value="{{ request('search') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 w-full md:w-64" />

        <button type="submit"
            class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">
            Filter
        </button>
    </form>
    
    <a href="{{ route('perawatan.lihat.surat.index') }}"
    class="px-4 py-2 rounded-lg flex items-center"
    style="background-color:#1b365d; color:white;">
    <i class="fa-solid fa-envelope-open-text mr-2"></i>
    Lihat Surat
</a>

      <div class="flex justify-end p-3 ml-3 mr-3">
      <a href="{{ route('perawatan.barang.rusak.cetak.pdf', request()->query()) }}"
        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 mr-2">
          <i class="fa-solid fa-file-pdf mr-1"></i> Cetak PDF
      </a>
      
  </div>
</div>

  {{-- card barang  --}}
  <div class="flex justify-center p-3 ml-3 mr-3">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 w-full">
      @foreach ($barang as $b)
        <div
          class="w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 relative">
          <a href="{{ route('perawatan.barang.rusak.detail', $b->uuid) }}">
            <img class="w-full rounded-lg h-48 object-cover mx-auto"
              src="{{ asset('storage/uploads/foto_barang/' . $b->foto) }}" alt="Image Description" />
          </a>
          <span class="absolute top-3 left-3 bg-tvri_base_color text-white text-xs font-semibold px-2 py-0.5 rounded-full">
            {{ $b->jenisBarang->jenis_barang }}
          </span>
          <div class="p-5">
            <p class="font-normal text-gray-700 dark:text-gray-400">
              <strong>{{ $b->nama_barang }}</strong>
            </p>
            <p class="font-normal text-gray-700 dark:text-gray-400">
              <strong>Sisa Limit : </strong> {{ $b->sisa_limit }}
            </p>
            <p class="font-normal text-gray-700 dark:text-gray-400">
              <strong>Status : </strong>
              @if ($b->status == 'tidak-tersedia')
                <span
                  class="bg-red-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                  Rusak
                </span>
              @else
                <span
                  class="bg-green-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                  Tersedia
                </span>
              @endif
            </p>
            <div class="mt-3">

              <a href="{{ route('perawatan.barang.rusak.detail', $b->uuid) }}" title="Detail"
                class="inline-flex focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 me-0.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                <i class="fa-solid fa-circle-info"></i>
              </a>

              <!-- Tombol Upload Surat -->
              <button data-modal-target="upload-surat-modal" data-modal-toggle="upload-surat-modal"
                  onclick="uploadSurat('{{ $b->uuid }}')"
                  class="inline-flex focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 me-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  type="button" title="Upload Surat">
                  <i class="fa-solid fa-screwdriver-wrench"></i>
              </button>

            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>


  {{-- modal upload surat --}}
  <div id="upload-surat-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">

    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

            <button type="button" data-modal-hide="upload-surat-modal"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-900">
                ✖
            </button>

            <div class="p-6 text-center">
                <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">
                    Upload Surat Perbaikan
                </h3>

                <form id="uploadSuratForm" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="file" name="surat" accept=".pdf,.jpg,.jpeg,.png"
                        class="block w-full mb-4 border p-2 rounded" required>

                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Upload
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function uploadSurat(uuid) {
    let url = "{{ route('perawatan.upload.surat', ':uuid') }}";
    url = url.replace(':uuid', uuid);
    document.getElementById('uploadSuratForm').action = url;
}
</script>
@endsection