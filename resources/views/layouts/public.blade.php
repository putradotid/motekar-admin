<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Motekar</title>
  <link rel="icon" href="{{ asset('storage/motekar-logo.ico') }}" type="image/x-icon">
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="{{ asset('css/font.css') }}">

  {{-- Api Public --}}
  <script src="{{ asset('js/api-public.js') }}"></script>
  
</head>

<body class="bg-gray-50 text-gray-900 font-[Inter] scroll-smooth" id="page-top">
  
<!-- Navbar -->
@include('components.public.topbar')

<!-- Begin Page Content -->
@yield('content')
<!-- /.container-fluid -->

<!-- Footer -->
@include('components.public.footer')
<!-- End of Footer -->

<!-- Scroll To Top -->
<a
    href="#page-top"
    class="fixed bottom-6 right-6 z-50 flex h-12 w-12 items-center justify-center rounded-full bg-amber-500 text-white shadow-lg transition hover:bg-amber-600"
>
    <svg xmlns="http://www.w3.org/2000/svg"
         class="h-6 w-6"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M5 15l7-7 7 7" />
    </svg>
</a>
</body>
</html>