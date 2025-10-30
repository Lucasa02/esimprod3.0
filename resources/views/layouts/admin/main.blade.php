<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="theme-color" content="#1E3164">

  {{-- Font --}}
  <link href="https://fonts.cdnfonts.com/css/avenir" rel="stylesheet">

  {{-- Font Awesome Icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


  {{-- Favicon --}}
  <link rel="shortcut icon" href="{{ asset('img/assets/esimprod_logo_bg.png') }}" type="image/x-icon">

  {{-- TinyMCE Configuration --}}
  <x-head.tinymce-config />

  {{-- Notifications --}}
  @notifyCss

  {{-- Vite Assets --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- Dynamic Page Title --}}
  <title>ESIMPROD | @yield('title', 'Untitled Page')</title>
</head>

<body class="bg-gray-50 dark:bg-neutral-900 antialiased font-sans">

  {{-- Navbar --}}
  @include('layouts.admin.partials.navbar')

  {{-- Validation & Alerts --}}
  @include('layouts.admin.partials.validation')

  {{-- Sidebar --}}
  @include('layouts.admin.partials.sidebar')

  {{-- Main Content --}}
  <div class="p-4 sm:ml-64 font-sans">
    {{-- Breadcrumb --}}
    @include('layouts.admin.partials.breadcrumb')

    {{-- Content Section --}}
    @yield('content')

    {{-- Notification Toast --}}
    <div class="absolute top-0 left-0 right-0 z-50">
      <x-notify::notify />
    </div>

    @notifyJs
  </div>

  {{-- Custom Scripts --}}
  @yield('scripts')

  {{-- Auto-hide Toast After 6s --}}
  <script>
    setTimeout(() => {
      const toast = document.getElementById('toast-message');
      if (toast) {
        toast.style.display = 'none';
      }
    }, 6000);
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>
