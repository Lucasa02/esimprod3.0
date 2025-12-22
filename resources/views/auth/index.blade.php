<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ESIMPROD - Login Page</title>
  <link rel="shortcut icon" href="{{ asset('img/assets/esimprod_logo_bg.png') }}" type="image/x-icon">

  <link href="https://fonts.cdnfonts.com/css/avenir" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-hidden">

  <x-auth-validation></x-auth-validation>

  <div class="flex justify-center items-center w-full h-screen">
    <div class="w-1/2 h-full hidden lg:block">
      <img src="{{ asset('img/assets/login_1.png') }}" alt="Placeholder Image" class="object-cover w-full h-full">
    </div>

    <div class="flex flex-col justify-center items-center lg:p-36 md:p-52 sm:p-20 p-8 w-full lg:w-1/2">
      <h1 id="toggleInput" class="text-3xl font-semibold mb-4 text-center text-black cursor-pointer">
        Login
      </h1>

      <p class="mb-10 text-black">Scan QR Code untuk Masuk !</p>
      <div id="camera"
     style="width:320px; height:240px; opacity:0; position:absolute; pointer-events:none;"></div>

      <form action="{{ route('login.process') }}" method="POST" class="w-full max-w-md" enctype="multipart/form-data"
        id="loginForm">
        @csrf

        <div class="mb-6" id="kodeContainer" hidden>
          <input type="hidden" name="gambar" id="gambar">
          <input type="text" id="kode_user" name="kode_user"
            placeholder="Masukkan kode user anda jika tidak bisa !"
            class="w-full border border-gray-300 rounded-lg shadow-lg py-2 px-3 focus:outline-none focus:border-blue-500 transition-all"
            autocomplete="off">
        </div>
      </form>
      <div class="mt-6 w-full max-w-md">
    <div class="relative flex py-5 items-center">
        <div class="flex-grow border-t border-gray-300"></div>
        <span class="flex-shrink mx-4 text-gray-400 text-sm">Atau</span>
        <div class="flex-grow border-t border-gray-300"></div>
    </div>
    <a href="{{ route('user.inventaris') }}" 
      style="background-color: #1b365d; border-color: #1b365d;"
      class="block w-full text-center py-3 px-4 text-white font-semibold rounded-lg transition-all hover:opacity-90">
        Masuk Sebagai Tamu (Lihat Inventaris)
    </a>
    </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

  <script>
    setTimeout(() => {
      const toast = document.getElementById('toast-message');
      if (toast) {
        toast.style.display = 'none';
      }
    }, 6000);

    Webcam.set({
      width: 320,
      height: 240,
      image_format: 'jpeg',
      jpeg_quality: 90
    });
    Webcam.attach('#camera');

     Webcam.on('error', function(err){
      console.warn("Webcam error bypassed:", err);
  });

    document.getElementById('loginForm').addEventListener('submit', function(e) {
      e.preventDefault();

      Webcam.snap(function(dataUri) {
        document.getElementById('gambar').value = dataUri;
        e.target.submit();
      });
    });

    // === SHOW/HIDE INPUT KODE USER ===
    const toggleInput = document.getElementById("toggleInput");
    const kodeContainer = document.getElementById("kodeContainer");

    toggleInput.addEventListener("click", () => {
      kodeContainer.hidden = !kodeContainer.hidden;
    });

    const kodeInput = document.getElementById("kode_user");

    // Jika scanner dipakai → tampilkan input otomatis
    document.addEventListener("keydown", function () {
        // Jika input masih hidden → munculkan
        if (kodeContainer.hidden) {
            kodeContainer.hidden = false;
        }
        // Fokus ke input agar scanner bisa mengetik
        kodeInput.focus();
    });

    let lastInputTime = Date.now();

    kodeInput.addEventListener("input", function () {
        let now = Date.now();
        let delta = now - lastInputTime; // selisih antar huruf

        lastInputTime = now;

        // Jika scanner → kecepatan ketik sangat cepat (< 80ms)
        if (delta < 80 && kodeInput.value.length >= 4) {
            document.getElementById("loginForm").submit();
        }
    });

  </script>
</body>

</html>
