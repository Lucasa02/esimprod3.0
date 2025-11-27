<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-16 transition-transform -translate-x-full bg-tvri_base_color sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700 shadow-xl"
    aria-label="Sidebar">

  <div class="h-full px-3 pb-4 bg-tvri_base_color dark:bg-gray-800">
    <ul class="space-y-2 font-medium font-sans">

      {{-- === GENERAL === --}}
      <div class="flex items-center my-2">
        <small class="mx-2 text-white opacity-65">GENERAL</small>
        <hr class="h-px flex-grow bg-gray-200 border-0 opacity-20">
      </div>

      {{-- Dashboard --}}
      <li>
        <a href="{{ route('dashboard.index') }}"
          class="flex items-center p-2 text-white rounded-lg hover:bg-gray-100 hover:text-tvri_base_color">
          <i class="fa-solid fa-house"></i>
          <span class="ms-3">Dashboard</span>
        </a>
      </li>

      {{-- === DATA MASTER === --}}
      <li>
        <button type="button"
          class="flex items-center w-full p-2 text-white rounded-lg hover:bg-gray-100 hover:text-tvri_base_color"
          aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
          <i class="fa-solid fa-database"></i>
          <span class="flex-1 ms-3 text-left whitespace-nowrap">Data Master</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 4 4 4-4" />
          </svg>
        </button>

        <ul id="dropdown-example" class="hidden py-2">
          <li>
            <a href="{{ route('barang.index') }}"
              class="flex items-center p-1 pl-9 text-white hover:bg-gray-100 hover:text-tvri_base_color">
              <i class="fa-solid fa-box text-xs opacity-70 me-2"></i>
              Barang
            </a>
          </li>
          <li>
            <a href="{{ route('jenis-barang.index') }}"
              class="flex items-center p-1 pl-9 text-white hover:bg-gray-100 hover:text-tvri_base_color">
              <i class="fa-solid fa-tags text-xs opacity-70 me-2"></i>
              Jenis Barang
            </a>
          </li>
          <li>
            <a href="{{ route('peruntukan.index') }}"
              class="flex items-center p-1 pl-9 text-white hover:bg-gray-100 hover:text-tvri_base_color">
              <i class="fa-solid fa-location-dot text-xs opacity-70 me-2"></i>
              Peruntukan
            </a>
          </li>
          <li>
            <a href="{{ route('jabatan.index') }}"
              class="flex items-center p-1 pl-9 text-white hover:bg-gray-100 hover:text-tvri_base_color">
              <i class="fa-solid fa-user-tie text-xs opacity-70 me-2"></i>
              Jabatan
            </a>
          </li>
        </ul>
      </li>

      {{-- === DATA INVENTARIS === --}}
      <li>
        <button type="button"
          class="flex items-center w-full p-2 text-white rounded-lg hover:bg-gray-100 hover:text-tvri_base_color"
          aria-controls="dropdown-bmn" data-collapse-toggle="dropdown-bmn">
          <i class="fa-solid fa-box-archive me-2"></i>
          <span class="flex-1 text-left whitespace-nowrap font-medium">Data Inventaris</span>
          <svg class="w-3 h-3 ms-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 4 4 4-4" />
          </svg>
        </button>

        <ul id="dropdown-bmn" class="hidden flex-col gap-1 py-2 ps-2 border-l border-gray-700/40 mt-1">
          {{-- MCR --}}
          <li>
            <a href="{{ route('bmn.mcr.index') }}"
              class="flex items-center w-full p-1 pl-9 text-white rounded-lg hover:bg-gray-100 hover:text-tvri_base_color">
              <i class="fa-solid fa-network-wired text-xs opacity-70 me-2"></i>
              MCR
            </a>
          </li>

          {{-- Studio --}}
          <li>
            <a href="{{ route('studio2.index') }}"
              class="flex items-center w-full p-1 pl-9 text-white rounded-lg hover:bg-gray-100 hover:text-tvri_base_color">
              <i class="fa-solid fa-video text-xs opacity-70 me-2"></i>
              Studio
            </a>
          </li>

          {{-- Perawatan MCR --}}
          <li>
            <a href="#"
              class="flex items-center w-full p-1 pl-9 text-white rounded-lg hover:bg-gray-100 hover:text-tvri_base_color">
              <i class="fa-solid fa-toolbox text-xs opacity-70 me-2"></i>
              Perawatan
            </a>
          </li>
        </ul>
      </li>

      {{-- === BARANG === --}}
      <div class="flex items-center my-2">
        <small class="mx-2 text-white opacity-65">BARANG</small>
        <hr class="h-px flex-grow bg-gray-200 border-0 opacity-20">
      </div>

      <li>
        <a href="{{ route('peminjaman.index') }}"
          class="flex items-center p-2 text-white rounded-lg hover:bg-gray-100 hover:text-tvri_base_color">
          <i class="fa-solid fa-paper-plane"></i>
          <span class="ms-3">Data Penggunaan</span>
        </a>
      </li>

      <li>
        <a href="{{ route('pengembalian.index') }}"
          class="flex items-center p-2 text-white rounded-lg hover:bg-gray-100 hover:text-tvri_base_color">
          <i class="fa-solid fa-rotate-left"></i>
          <span class="ms-3">Data Pengembalian</span>
        </a>
      </li>

      {{-- === PERAWATAN === --}}
      <li>
        <button type="button"
          class="flex items-center w-full p-2 text-white rounded-lg hover:bg-gray-100 hover:text-tvri_base_color"
          aria-controls="dropdown-perawatan" data-collapse-toggle="dropdown-perawatan">
          <i class="fa-solid fa-screwdriver-wrench"></i>
          <span class="flex-1 ms-3 text-left whitespace-nowrap">Data Perawatan</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 4 4 4-4" />
          </svg>
        </button>

        <ul id="dropdown-perawatan" class="hidden py-2">
          <li>
            <a href="{{ route('perawatan.limit.habis.index') }}"
              class="flex items-center p-1 pl-9 text-white hover:bg-gray-100 hover:text-tvri_base_color">
              <i class="fa-solid fa-battery-empty text-xs opacity-70 me-2"></i>
              Limit Habis
            </a>
          </li>
          <li>
            <a href="{{ route('perawatan.barang.hilang.index') }}"
              class="flex items-center p-1 pl-9 text-white hover:bg-gray-100 hover:text-tvri_base_color">
              <i class="fa-solid fa-circle-xmark text-xs opacity-70 me-2"></i>
              Barang Hilang
            </a>
          </li>
          <li>
            <a href="{{ route('perawatan.barang.rusak.index') }}"
              class="flex items-center p-1 pl-9 text-white hover:bg-gray-100 hover:text-tvri_base_color">
              <i class="fa-solid fa-screwdriver text-xs opacity-70 me-2"></i>
              Barang Rusak
            </a>
          </li>
        </ul>
      </li>

      {{-- === USER / TAMBAHAN === --}}
      <div class="flex items-center my-2">
        <small class="mx-2 text-white opacity-65">USER/TAMBAHAN</small>
        <hr class="h-px flex-grow bg-gray-200 border-0 opacity-20">
      </div>

      <li>
        <a href="{{ route('users.index') }}"
          class="flex items-center p-2 text-white rounded-lg hover:bg-gray-100 hover:text-tvri_base_color">
          <i class="fa-solid fa-user"></i>
          <span class="ms-3">Data User</span>
        </a>
      </li>

      <li>
        <a href="{{ route('buku-panduan.index') }}"
          class="flex items-center p-2 text-white rounded-lg hover:bg-gray-100 hover:text-tvri_base_color">
          <i class="fa-solid fa-bookmark"></i>
          <span class="ms-3">Buku Panduan</span>
        </a>
      </li>

      {{-- Logout --}}
      <li>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
          class="flex items-center p-2 text-white rounded-lg hover:bg-gray-100 hover:text-tvri_base_color">
          <i class="fa-solid fa-sign-out text-red-500"></i>
          <span class="ms-3 text-red-500">Logout</span>
        </a>
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
      </li>

    </ul>
  </div>
</aside>
