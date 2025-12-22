<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="shortcut icon" href="{{ asset('img/assets/esimprod_logo_bg.png') }}" type="image/x-icon" />
  <link href="https://fonts.cdnfonts.com/css/avenir" rel="stylesheet" />
  <title>Inventaris</title>

  @notifyCss
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    /* --- ANIMASI LOGO BERKILAU & BERCAHAYA --- */
    @keyframes shimmer {
      0% { transform: translateX(-150%) skewX(-25deg); }
      50% { transform: translateX(150%) skewX(-25deg); }
      100% { transform: translateX(150%) skewX(-25deg); }
    }

    @keyframes glow {
      0%, 100% { box-shadow: 0 0 5px rgba(59, 130, 246, 0.5); }
      50% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.9), 0 0 30px rgba(59, 130, 246, 0.4); }
    }

    .logo-container {
      position: relative;
      overflow: hidden; /* Penting untuk kilauan */
      display: inline-flex;
      align-items: center;
      border-radius: 0.5rem; /* rounded-lg */
      animation: glow 3s infinite ease-in-out;
    }

    .logo-container::after {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(
        to right,
        transparent,
        rgba(255, 255, 255, 0.4),
        transparent
      );
      animation: shimmer 2s infinite;
    }

    /* --- ANIMASI TOMBOL CLOSE --- */
    .btn-close-anim {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-close-anim:hover {
      transform: rotate(90deg) scale(1.2);
      color: #ef4444 !important; /* Warna merah saat hover */
    }

    .btn-close-anim:active {
      transform: scale(0.9);
    }

    /* Animasi Modal Pop-In */
    @keyframes modalPop {
      0% { opacity: 0; transform: scale(0.95) translateY(-10px); }
      100% { opacity: 1; transform: scale(1) translateY(0); }
    }
    .animate-modal-content {
      animation: modalPop 0.3s ease-out forwards;
    }

    /* FIX AREA KAMERA */
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
      animation: modalPop .25s ease-out;
    }
  </style>
</head>

<body class="bg-cover bg-center bg-[url('../../public/img/assets/option-bg-1.png')] bg-opacity-40 bg-blend-multiply flex flex-col min-h-screen">

  {{-- Navbar --}}
  <nav class="fixed top-0 z-50 w-full dark:bg-gray-800 dark:border-gray-700 font-sans">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">

        <div class="flex items-center justify-start rtl:justify-end">
  <p class="flex ms-2 md:me-24">
    {{-- LOGO DENGAN ANIMASI BERKILAU --}}
    <span class="logo-container bg-blue-900 p-1 me-3">
      <img src="{{ asset('img/assets/esimprod_logo.png') }}" class="h-6 animate-logo" alt="ESIMPROD" />
    </span>
    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
      <small class="text-xs text-white font-thin">Version 2.2</small>
    </span>
  </p>
</div>

        <div class="flex items-center">
          @auth
          <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" data-dropdown-toggle="dropdown-user">
            <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->foto ? asset('storage/uploads/foto_user/' . Auth::user()->foto) : Avatar::create(Auth::user()->nama_lengkap)->toBase64() }}" alt="user photo" />
          </button>
          @endauth

          @guest
          <a href="{{ route('login') }}" class="text-white bg-blue-700 hover:bg-blue-800 px-4 py-2 rounded-lg text-sm">Login</a>
          @endguest

          @auth
          <div id="dropdown-user" class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow">
            <ul class="py-1">
              <li><a href="{{ route('user.profil') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a></li>
              <div class="my-2 border-t border-gray-200"></div>
              <li><a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a></li>
            </ul>
          </div>
          @endauth
        </div>

        <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
      </div>
    </div>
  </nav>

  {{-- Welcome Section --}}
  <section class="flex flex-1 justify-center items-center sm:justify-start sm:items-start pt-10 bg-transparent lg:mt-16">
    <div class="lg:ml-32 md:ml-16 sm:ml-8 px-4 w-full lg:w-auto">
      <div class="mr-auto place-self-center lg:col-span-7 w-full" data-aos="fade-right" data-aos-duration="1500">

        <h1 class="text-white mb-4 text-4xl sm:text-5xl md:text-6xl font-extrabold">Inventaris</h1>

        <h3 class="text-white mb-4 text-3xl sm:text-4xl font-extrabold">
          {{ Auth::check() ? Auth::user()->nama_lengkap : 'Halo, Tamu' }}
        </h3>
        @auth
        <h3 class="text-white text-2xl mb-4">{{ Auth::user()->jabatan->jabatan }} <br> {{ Auth::user()->nip }}</h3>
        @endauth

        <div class="bg-white rounded-lg p-2 shadow-lg flex flex-col sm:flex-row gap-2 items-center justify-center lg:mt-36">
          <button type="button" data-modal-target="inventaris-modal" data-modal-toggle="inventaris-modal" class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-10 sm:px-24 py-3 w-full sm:w-auto transform transition active:scale-95">Lihat Barang</button>
        </div>
      </div>
    </div>
  </section>

  {{-- MODAL INVENTARIS --}}
  <div id="inventaris-modal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 right-0 left-0 z-50 overflow-y-auto overflow-x-hidden justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      {{-- DIV DIBAWAH INI DITAMBAHKAN CLASS animate-modal-content --}}
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 animate-modal-content">
        <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Lihat Barang</h3>
          <button type="button" data-modal-hide="inventaris-modal" 
  class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex items-center justify-center btn-close-anim">
  ✕
</button>
        </div>

        <div class="p-4">
          <p class="text-gray-700 dark:text-gray-300 mb-4 text-center">Silahkan pilih tindakan:</p>
          <a href="#" onclick="openScanner()" class="block w-full text-center text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-3 transform transition active:scale-95">Scan Barang</a>
        </div>
      </div>
    </div>
  </div>

  {{-- MODAL SCANNER --}}
  <script src="https://unpkg.com/html5-qrcode"></script>

  <div id="scan-camera-modal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-40 flex justify-center items-center backdrop-blur-sm">
    <div class="scanner-card animate-modal-content">
      <button id="btn-close-scanner" 
  class="absolute top-1 right-2 text-gray-700 hover:text-black text-xl font-bold btn-close-anim">
  ✕
</button>
      <h3 class="text-center font-semibold mb-2">Scan QR Barang</h3>
      <div id="reader" class="w-full h-56 bg-gray-200 rounded-lg overflow-hidden"></div>
    </div>
  </div>

  <div class="absolute top-0 left-0 right-0 z-50"><x-notify::notify /></div>
  @notifyJs

  <script>
    // Script tetap sama seperti sebelumnya
    let html5QrCode = null;
    let scanningActive = false;
    let scannerAllowed = true;

    if (window.location.pathname.match(/^\/user\/scan-barang(\/.*)?$/)) {
      if (window.location.pathname.match(/^\/user\/scan-barang\/.+/)) {
        scannerAllowed = false;
      } else {
        scannerAllowed = true;
      }
    }

    function showScannerModal() {
      document.getElementById('scan-camera-modal').classList.remove('hidden');
    }

    function hideScannerModal() {
      document.getElementById('scan-camera-modal').classList.add('hidden');
    }

    function cleanScannedString(s) {
      if (!s || typeof s !== 'string') return s;
      s = s.trim();
      s = s.replace(/[\u0000-\u001F\u007F]+/g, "");
      s = s.replace(/\s+/g, " ");
      return s;
    }

    function stopScanner() {
      scanningActive = false;
      if (html5QrCode) {
        html5QrCode.stop().then(() => {
          try { html5QrCode.clear(); } catch (e) {}
          html5QrCode = null;
        }).catch(err => {
          try { html5QrCode.clear(); } catch (e) {}
          html5QrCode = null;
        });
      }
      hideScannerModal();
    }

    function openScanner() {
      if (!scannerAllowed || scanningActive) return;

      showScannerModal();
      html5QrCode = new Html5Qrcode("reader");
      scanningActive = true;

      const config = {
        fps: 12,
        qrbox: { width: 220, height: 220 }
      };

      html5QrCode.start({ facingMode: "environment" }, config, rawMessage => {
        stopScanner();
        let qrMessage = cleanScannedString(rawMessage || "");
        if (!qrMessage) return;

        if (qrMessage.includes("/user/scan-barang/")) {
          const parts = qrMessage.split("/");
          const kodeBarang = parts.pop() || parts.pop();
          if (kodeBarang) {
            location.assign("/user/scan-barang/" + encodeURIComponent(kodeBarang));
            return;
          }
        }

        try {
          const parsed = new URL(qrMessage);
          location.assign(parsed.href);
          return;
        } catch (e) {}

        location.assign("/user/scan-barang/" + encodeURIComponent(qrMessage));
      }).catch(err => {
        scanningActive = false;
        hideScannerModal();
      });
    }

    document.getElementById('btn-close-scanner').addEventListener('click', function (e) {
      e.preventDefault();
      stopScanner();
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === "Escape") stopScanner();
    });
  </script>

</body>
</html>