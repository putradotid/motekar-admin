<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Motekar</title>
  <link rel="icon" href="{{ asset('storage/motekar-logo.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="{{ asset('css/font.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

  {{-- swiper css --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

  {{-- Api Public --}}
  <script src="{{ asset('js/api-public.js') }}"></script>

  @stack('styles')

  <style>
    .swiper-button-next,
    .swiper-button-prev {
        color: #FF8C00 !important;
        background: rgba(255,255,255,0.8);
        width: 40px !important;
        height: 40px !important;
        border-radius: 50%;
        padding: 24px;
    }
    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 16px !important;
        font-weight: bold;
    }
    .swiper-pagination-bullet-active {
        background: #FF8C00 !important;
    }
</style>
  
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

{{-- Swiper JS --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

{{-- Init Swiper --}}
<script>
    const heroSwiper = new Swiper('.heroSwiper', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>

@stack('scripts')

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