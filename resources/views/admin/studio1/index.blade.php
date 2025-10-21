@extends('layouts.admin.main')

@section('content')
  <div class="flex items-center ml-6 mr-3">
    <button id="dropdownRightButton" data-dropdown-toggle="dropdownRight" data-dropdown-placement="right"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
      type="button" title="Menu"><i class="fa solid fa-gear mr-2"></i> Opsi
    </button>

    <div id="dropdownRight" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
      <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
        <li>
          <a href="#"
            class="block px-3 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            Tambah Data
          </a>
        </li>
        <li>
          <a href="#"
            class="block px-3 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
            Cetak Data
          </a>
        </li>
      </ul>
    </div>
  </div>

  {{-- Search Form --}}
  <form class="flex items-center max-w-sm mx-auto ml-6 mr-3 mt-2" action="#" method="GET">
    <label for="simple-search" class="sr-only">Search</label>
    <div class="w-full relative">
      <input type="text" id="search" autocomplete="off"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Cari peralatan di Studio 1..." name="search" />
      <svg class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-tvri_base_color" aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="m19 19-4-4m0-7A7 7 0 1 1   1 8a7 7 0 0 1 14 0Z" />
      </svg>
    </div>
  </form>

  {{-- Card Grid Dummy --}}
  <div class="flex justify-center p-3 ml-3 mr-3">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 w-full">

      {{-- Card Contoh 1 --}}
      <div class="w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 relative">
        <a href="#">
          <img class="w-full rounded-lg h-auto object-cover mx-auto"
            src="https://placehold.co/600x400?text=Studio+1" alt="Image Description" />
        </a>
        <a href="#"
          class="absolute top-3 left-3 bg-tvri_base_color text-white text-xs font-semibold px-2 py-0.5 rounded-full">
          Kamera
        </a>
        <div class="p-5">
          <p class="font-normal text-gray-700 dark:text-gray-400"><strong>Kamera Utama Sony A7</strong></p>
          <p class="font-normal text-gray-700 dark:text-gray-400"><strong>Status: </strong>
            <span class="bg-green-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full">Tersedia</span>
          </p>
          <div class="mt-3">
            <a href="#" title="Detail"
              class="inline-flex focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-1 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
              Detail
            </a>
            <a href="#" title="Edit"
              class="inline-flex focus:outline-none text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-1 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
              Edit
            </a>
            <button class="inline-flex focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
              type="button" title="Hapus">
              Hapus
            </button>
          </div>
        </div>
      </div>

      {{-- Card Contoh 2 --}}
      <div class="w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 relative">
        <a href="#">
          <img class="w-full rounded-lg h-auto object-cover mx-auto"
            src="https://placehold.co/600x400?text=Lighting+Set" alt="Image Description" />
        </a>
        <a href="#"
          class="absolute top-3 left-3 bg-tvri_base_color text-white text-xs font-semibold px-2 py-0.5 rounded-full">
          Lighting
        </a>
        <div class="p-5">
          <p class="font-normal text-gray-700 dark:text-gray-400"><strong>Lighting Set Studio</strong></p>
          <p class="font-normal text-gray-700 dark:text-gray-400"><strong>Status: </strong>
            <span class="bg-red-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full">Digunakan</span>
          </p>
          <div class="mt-3">
            <a href="#" title="Detail"
              class="inline-flex focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-1 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
              Detail
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection