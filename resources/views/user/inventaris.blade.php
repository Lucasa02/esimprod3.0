<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{ asset('img/assets/esimprod_logo_bg.png') }}" type="image/x-icon">
  <link href="https://fonts.cdnfonts.com/css/avenir" rel="stylesheet">
  <title>Inventaris</title>

  @notifyCss
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- FIX AREA KAMERA (hilangkan background hitam bawaan html5-qrcode) -->
  <style>
    #reader video {
      border-radius: 12px;
      width: 100% !important;
      height: auto !important;
      object-fit: cover;
      background: transparent !important;
    }

    /* Modal scanner card */
    .scanner-card {
      width: 310px;
      background: white;
      padding: 14px;
      border-radius: 16px;
      position: relative;
      box-shadow: 0 0 20px rgba(0, 0, 0, .3);
      animation: fadeIn .25s ease-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(.95); }
      to   { opacity: 1; transform: scale(1); }
    }
  </style>

</head>

<body
  class="bg-cover bg-center bg-[url('../../public/img/assets/option-bg-1.png')] bg-opacity-40 bg-blend-multiply flex flex-col min-h-screen">

  {{-- Navbar --}}
  <nav class="fixed top-0 z-50 w-full dark:bg-gray-800 dark:border-gray-700 font-sans">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        
        <div class="flex items-center justify-start rtl:justify-end">
          <p class="flex ms-2 md:me-24">
            <img src="{{ asset('img/assets/esimprod_logo.png') }}" class="h-8 me-3 bg-blue-900 p-1 rounded-lg" alt="ESIMPROD" />
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
              <small class="text-xs text-white font-thin">Version 2.2</small>
            </span>
          </p>
        </div>

        <div class="flex items-center">
          <button type="button"
            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
            aria-expanded="false" data-dropdown-toggle="dropdown-user">
            <img class="w-8 h-8 rounded-full"
              src="{{ Auth::user()->foto ? asset('storage/uploads/foto_user/' . Auth::user()->foto) : Avatar::create(Auth::user()->nama_lengkap)->toBase64() }}"
              alt="user photo">
          </button>

          <div
            class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
            id="dropdown-user">
            <ul class="py-1" role="none">
              <li>
                <a href="{{ route('user.profil') }}"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                  Profil Saya
                </a>
              </li>

              <div class="my-2 border-t border-gray-200 dark:border-gray-600"></div>

              <li>
                <a href="#"
                  onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                  Logout
                </a>
              </li>

            </ul>
          </div>
        </div>

        <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
      </div>
    </div>
  </nav>


  {{-- Welcome --}}
  <section class="flex flex-1 justify-center items-center sm:justify-start sm:items-start pt-10 bg-transparent lg:mt-16">
    <div class="lg:ml-32 md:ml-16 sm:ml-8 px-4 w-full lg:w-auto">
      <div class="mr-auto place-self-center lg:col-span-7 w-full" data-aos="fade-right" data-aos-duration="1500">

        <h1 class="text-white mb-4 text-4xl sm:text-5xl md:text-6xl font-extrabold">
          Inventaris
        </h1>

        <h3 class="text-white mb-4 text-3xl sm:text-4xl font-extrabold">
          {{ Auth::user()->nama_lengkap }}
        </h3>

        <h3 class="text-white text-2xl mb-4">
          {{ Auth::user()->jabatan->jabatan }} <br>
          {{ Auth::user()->nip }}
        </h3>

        {{-- MENU --}}
        <div class="bg-white rounded-lg p-2 shadow-lg flex flex-col sm:flex-row gap-2 items-center justify-center lg:mt-36">
          <button type="button" data-modal-target="inventaris-modal" data-modal-toggle="inventaris-modal"
            class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-10 sm:px-24 py-3 w-full sm:w-auto">
            Lihat Barang
          </button>

          <button type="button" data-modal-target="inventaris-modal" data-modal-toggle="inventaris-modal"
            class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-10 sm:px-24 py-3 w-full sm:w-auto">
            Lapor Barang
          </button>

        </div>
      </div>
    </div>
  </section>


  {{-- MODAL INVENTARIS --}}
  <div id="inventaris-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 right-0 left-0 z-50 overflow-y-auto overflow-x-hidden justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

        <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Lihat Barang</h3>

          <button type="button" data-modal-hide="inventaris-modal"
            class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8">✕</button>
        </div>

        <div class="p-4">
          <p class="text-gray-700 dark:text-gray-300 mb-4 text-center">Silahkan pilih tindakan:</p>

          <a href="#" onclick="openScanner()"
            class="block w-full text-center text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-3">
            Scan Barang
          </a>
        </div>

      </div>
    </div>
  </div>


  {{-- MODAL SCANNER BARU (background tidak hitam) --}}
  <div id="scan-camera-modal"
    class="hidden fixed inset-0 z-50 bg-black bg-opacity-40 flex justify-center items-center backdrop-blur-sm">

    <div class="scanner-card">

      <!-- TOMBOL CLOSE -->
      <button onclick="stopScanner()"
        class="absolute top-1 right-2 text-gray-700 hover:text-black text-xl font-bold">✕</button>

      <h3 class="text-center font-semibold mb-2">Scan QR Barang</h3>

      <div id="reader" class="w-full h-56 bg-gray-200 rounded-lg overflow-hidden"></div>

    </div>
  </div>


  <div class="absolute top-0 left-0 right-0 z-50"><x-notify::notify /></div>
  @notifyJs


  {{-- QR Scanner CDN --}}
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>


  <script>
    let html5QrCode = null;

    function openScanner() {
      document.getElementById('scan-camera-modal').classList.remove('hidden');

      html5QrCode = new Html5Qrcode("reader");

      const config = {
        fps: 12,
        qrbox: { width: 220, height: 220 }
      };

      html5QrCode.start(
        { facingMode: "environment" },
        config,
        qrMessage => {
          stopScanner();
          window.location.href = "/scan-barang/" + qrMessage;
        },
        err => {}
      );
    }

    function stopScanner() {
      if (html5QrCode) {
        html5QrCode.stop().then(() => {
          html5QrCode.clear();
        });
      }
      document.getElementById('scan-camera-modal').classList.add('hidden');
    }
  </script>

</body>
</html>
