@extends('layouts.admin.main')

@section('content')
<div class="flex items-center ml-6 mr-3">
  <button id="dropdownRightButton" data-dropdown-toggle="dropdownRight" data-dropdown-placement="right"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2"
    type="button" title="Menu">
    <i class="fa-solid fa-gear mr-2"></i> Opsi
  </button>

  <div id="dropdownRight"
    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
      <li>
        <a href="{{ route('studio2.create') }}"
          class="block px-3 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
          Tambah Data
        </a>
      </li>
      <li>
        <a href="{{ route('studio2.print') }}"
          class="block px-3 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
          Cetak Data
        </a>
      </li>
    </ul>
  </div>
</div>

{{-- Search Form --}}
<form class="flex items-center max-w-sm mx-auto ml-6 mr-3 mt-2" method="GET" action="#">
  <label for="simple-search" class="sr-only">Search</label>
  <div class="w-full relative">
    <input type="text" id="search" name="search" autocomplete="off"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10"
      placeholder="Cari peralatan di Studio 2...">
    <svg class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-blue-700" xmlns="http://www.w3.org/2000/svg"
      fill="none" viewBox="0 0 20 20">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
    </svg>
  </div>
</form>

{{-- Card Grid Studio 2 --}}
<div class="flex justify-center p-3 ml-3 mr-3">
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 w-full">

    {{-- 🟢 Loop semua barang dari database --}}
    @forelse ($barangs as $barang)
      <div class="w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 relative">
        {{-- Foto --}}
        <a href="#">
          <img class="w-full rounded-lg h-auto object-cover mx-auto"
            src="{{ $barang->foto ? asset('storage/' . $barang->foto) : 'https://placehold.co/600x400?text=' . urlencode($barang->nama_barang) }}"
            alt="{{ $barang->nama_barang }}" />
        </a>

        {{-- Label kategori --}}
        <a href="#"
          class="absolute top-3 left-3 bg-blue-700 text-white text-xs font-semibold px-2 py-0.5 rounded-full">
          {{ $barang->jenisBarang->nama ?? 'Peralatan' }}
        </a>

        {{-- Konten --}}
        <div class="p-5">
          <p class="font-normal text-gray-700 dark:text-gray-400">
            <strong>{{ $barang->nama_barang }}</strong>
          </p>
          <p class="font-normal text-gray-700 dark:text-gray-400">
            <strong>Status: </strong>
            @if ($barang->status === 'Tersedia')
              <span class="bg-green-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full">Tersedia</span>
            @elseif ($barang->status === 'Digunakan')
              <span class="bg-red-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full">Digunakan</span>
            @else
              <span class="bg-yellow-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full">Perawatan</span>
            @endif
          </p>

          <div class="mt-3 flex flex-wrap gap-2">
            {{-- Detail --}}
            <a href="{{ route('studio2.detail', $barang->id) }}" title="Detail"
              class="inline-flex text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-1">
              Detail
            </a>

            {{-- Edit --}}
            <a href="{{ route('studio2.edit', $barang->id) }}" title="Edit"
              class="inline-flex text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-1">
              Edit
            </a>

            {{-- Hapus --}}
            <form id="delete-form-{{ $barang->id }}" action="{{ route('studio2.destroy', $barang->id) }}" method="POST" class="inline">
              @csrf
              @method('DELETE')
              <button type="button" onclick="confirmDelete('{{ $barang->id }}')"
                class="inline-flex text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1">
                Hapus
              </button>
            </form>
          </div>
        </div>
      </div>
    @empty
      <div class="col-span-full text-center text-gray-500 font-semibold">
        Belum ada data peralatan di Studio 2.
      </div>
    @endforelse

  </div>
</div>

{{-- SweetAlert Konfirmasi Hapus --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {
  Swal.fire({
    title: 'Yakin ingin menghapus data ini?',
    text: 'Data yang dihapus tidak dapat dikembalikan.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, hapus',
    cancelButtonText: 'Batal',
    reverseButtons: true,
    customClass: {
      confirmButton: 'swal2-confirm-button',
      cancelButton: 'swal2-cancel-button'
    },
    buttonsStyling: false
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('delete-form-' + id).submit();
    }
  });
}
</script>

{{-- Tombol Custom Style --}}
<style>
.swal2-confirm-button {
  background-color: #dc2626 !important; /* Merah */
  color: #fff !important;
  border: none;
  border-radius: 6px;
  padding: 8px 18px;
  font-weight: 600;
  font-size: 14px;
  margin: 0 5px;
  transition: background-color 0.2s;
}
.swal2-confirm-button:hover {
  background-color: #b91c1c !important;
}

.swal2-cancel-button {
  background-color: #2563eb !important; /* Biru */
  color: #fff !important;
  border: none;
  border-radius: 6px;
  padding: 8px 18px;
  font-weight: 600;
  font-size: 14px;
  margin: 0 5px;
  transition: background-color 0.2s;
}
.swal2-cancel-button:hover {
  background-color: #1d4ed8 !important;
}
</style>

{{-- Notifikasi Sukses --}}
@if (session('success'))
<script>
Swal.fire({
  icon: 'success',
  title: 'Berhasil!',
  text: '{{ session('success') }}',
  showConfirmButton: false,
  timer: 2000
});
</script>
@endif
@endsection
