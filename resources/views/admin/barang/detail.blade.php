@extends('layouts.admin.main')

@section('content')
  {{-- Tambahkan Tailwind & Bootstrap --}}
  @push('styles')
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,container-queries"></script>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      body {
        font-family: 'Manrope', sans-serif;
      }

      /* Efek premium gradient */
      .gradient-bg {
        background: linear-gradient(135deg, #f0f4ff, #e8ecff);
      }

      /* Efek glassmorphism */
      .glass {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(14px);
        border: 1px solid rgba(255, 255, 255, 0.2);
      }

      .dark .glass {
        background: rgba(31, 41, 55, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
      }

      /* Hover soft scale */
      .hover-soft:hover {
        transform: scale(1.02);
        transition: all 0.3s ease-in-out;
      }

      /* Shadow lembut */
      .soft-shadow {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      }
    </style>
  @endpush

  <div class="flex p-3 ml-3 mr-3">
    <a href="{{ route('barang.index') }}"
      class="group relative inline-flex items-center gap-2 text-gray-800 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-lg px-5 py-2.5 font-semibold overflow-hidden hover:text-white hover:bg-gradient-to-r from-gray-800 to-gray-900 transition-all duration-300">
      <span class="absolute inset-0 bg-gradient-to-r from-gray-800 to-gray-900 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
      <i class="fa-solid fa-arrow-left relative z-10"></i>
      <span class="relative z-10">Kembali</span>
    </a>
  </div>

  {{-- Kontainer utama --}}
  <div
    class="p-6 ml-6 mr-3 mt-2 rounded-3xl border border-gray-200 dark:border-gray-700 soft-shadow glass transition-all duration-300">

    {{-- Tabs --}}
    <ul
      class="flex flex-wrap text-sm font-semibold text-gray-600 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700 justify-center"
      id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">

      @php
        $tabs = [
            ['id' => 'detail', 'label' => 'Detail'],
            ['id' => 'gambar', 'label' => 'Gambar'],
            ['id' => 'qrcode', 'label' => 'QR-Code'],
        ];
      @endphp

      @foreach ($tabs as $i => $tab)
        <li class="me-2 mb-2">
          <button id="{{ $tab['id'] }}-tab" data-tabs-target="#{{ $tab['id'] }}" type="button" role="tab"
            aria-controls="{{ $tab['id'] }}" aria-selected="{{ $i == 0 ? 'true' : 'false' }}"
            class="relative inline-block px-6 py-3 rounded-lg transition-all duration-300 hover:text-gray-900 dark:hover:text-white focus:outline-none 
              {{ $i == 0 ? 'text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-gray-700 shadow-md' : 'text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
            {{ $tab['label'] }}
          </button>
        </li>
      @endforeach
    </ul>

    {{-- Konten --}}
    <div id="defaultTabContent" class="mt-5">
      {{-- Detail --}}
      <div class="hidden space-y-4 md:space-y-6 p-4 md:p-8" id="detail" role="tabpanel" aria-labelledby="detail-tab">
        <div class="text-center mb-5">
          <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-2">
            {{ $barang->nama_barang }}
          </h2>
          <p class="text-gray-500 dark:text-gray-400 max-w-2xl mx-auto">{{ $barang->deskripsi }}</p>
        </div>

        <div class="row gy-3">
          {{-- Setiap item detail --}}
          @php
            $details = [
                ['icon' => 'fa-brands fa-codepen text-blue-500', 'label' => 'Kode Barang', 'value' => $barang->kode_barang],
                ['icon' => 'fa-solid fa-6 text-purple-500', 'label' => 'Nomor Seri', 'value' => $barang->nomor_seri],
                ['icon' => 'fa-solid fa-copyright text-yellow-500', 'label' => 'Merk', 'value' => $barang->merk],
                ['icon' => 'fa-solid fa-arrows-up-to-line text-indigo-500', 'label' => 'Limit', 'value' => $barang->limit],
                ['icon' => 'fa-solid fa-truck-ramp-box text-pink-500', 'label' => 'Sisa Limit', 'value' => $barang->sisa_limit],
                ['icon' => 'fa-solid fa-layer-group text-emerald-500', 'label' => 'Jenis Barang', 'value' => $barang->jenisBarang->jenis_barang],
            ];
          @endphp

          @foreach ($details as $detail)
            <div class="col-12 col-md-6">
              <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl hover-soft transition-all">
                <i class="{{ $detail['icon'] }} w-6"></i>
                <span class="ml-3 font-semibold text-gray-800 dark:text-gray-100">{{ $detail['label'] }}:</span>
                <span class="ml-auto text-gray-600 dark:text-gray-300">{{ $detail['value'] }}</span>
              </div>
            </div>
          @endforeach

          {{-- Status --}}
          <div class="col-12">
            <div
              class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl hover-soft transition-all">
              @if ($barang->status == 'tersedia')
                <div class="flex items-center gap-3 text-green-600 font-semibold">
                  <i class="fa-solid fa-circle-check"></i>
                  <span>Status: Tersedia</span>
                </div>
              @else
                <div class="flex items-center gap-3 text-red-600 font-semibold">
                  <i class="fa-solid fa-circle-xmark"></i>
                  <span>Status: Tidak Tersedia</span>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>

      {{-- Gambar --}}
      <div class="hidden p-4 md:p-8 text-center" id="gambar" role="tabpanel" aria-labelledby="gambar-tab">
        <figure
          class="max-w-md mx-auto rounded-2xl overflow-hidden soft-shadow hover-soft bg-gray-100 dark:bg-gray-700/40 transition-transform duration-300">
          <img class="h-auto w-full object-cover"
            src="{{ asset('storage/uploads/foto_barang/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}">
          <figcaption
            class="py-3 text-sm text-gray-600 dark:text-gray-300 bg-white/70 dark:bg-gray-800/50 font-medium">
            {{ $barang->nama_barang }}
          </figcaption>
        </figure>
      </div>

      {{-- QR Code --}}
      <div class="hidden p-4 md:p-8 text-center" id="qrcode" role="tabpanel" aria-labelledby="qrcode-tab">
        <figure
          class="max-w-xs mx-auto rounded-2xl overflow-hidden soft-shadow hover-soft bg-gray-100 dark:bg-gray-700/40 transition-transform duration-300">
          <img class="h-auto w-full object-contain p-4"
            src="{{ asset('storage/uploads/qr_codes_barang/' . $barang->qr_code) }}" alt="{{ $barang->kode_barang }}">
          <figcaption
            class="py-3 text-sm text-gray-600 dark:text-gray-300 bg-white/70 dark:bg-gray-800/50 font-medium">
            {{ $barang->kode_barang }}
          </figcaption>
        </figure>
      </div>
    </div>
  </div>

  {{-- Bootstrap JS --}}
  @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @endpush
@endsection
