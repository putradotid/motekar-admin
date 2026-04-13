<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Motekar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-900 font-[Inter]">

<!-- Navbar -->
<header class="flex items-center justify-between px-8 py-4 max-w-6xl mx-auto">
  <div class="flex items-center gap-2">
    <div class="w-16 h-16">
      <img 
          src="{{ asset('storage/motekar-logo.png') }}"
          class="w-full h-full object-contain rounded-full"
          alt="logo"
      />
    </div>
  </div>

  
  <div class="flex items-center gap-4">
    <nav class="hidden md:flex gap-8 text-gray-600">
      <a href="#">Beranda</a>
      <a href="#">Tentang Kami</a>
      <a href="#">Product & Layanan</a>
      <a href="#">Testimoni</a>
      <a href="#">Tim Kami</a>
      <a href="#">Kontak</a>
    </nav>
    <button class="bg-amber-600 text-white px-4 py-2 rounded-full">
      Sign in
    </button>
  </div>
</header>

<!-- Hero -->
<section class="relative px-8 py-16 md:py-24 max-w-6xl mx-auto">

  <div class="max-w-2xl">
    <h1 class="text-4xl md:text-6xl font-bold leading-tight">
      Where Innovation
      <br>
      Meets Execution
    </h1>

    <p class="mt-6 text-gray-600 text-lg">
      Kami membantu perusahaan dan UMKM bertransformasi secara digital melalui pengembangan software, sistem terintegrasi, dan solusi teknologi yang scalable. Solusi teknologi terintegrasi untuk mempercepat pertumbuhan bisnis Anda di era digital.
    </p>

    <div class="mt-8 flex gap-4">
      <button class="bg-gray-900 text-white px-6 py-3 rounded-full">
        Get 6 months free
      </button>
      <button class="border px-6 py-3 rounded-full text-gray-700">
        ▶ Watch video
      </button>
    </div>
  </div>

  <!-- Card kanan -->
  {{-- <div class="hidden md:block absolute right-0 top-10">
    <div class="w-72 bg-white rounded-3xl shadow-xl p-6 border">
      <div class="flex justify-between items-center mb-6">
        <div class="w-6 h-6 bg-blue-600 rounded-full"></div>
        <button class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm">
          Get started
        </button>
      </div>

      <h2 class="text-2xl font-bold leading-tight">
        Accounting 
        <span class="text-blue-600">made simple</span>
        <br>
        for small businesses.
      </h2>

      <p class="mt-4 text-gray-600 text-sm">
        Most bookkeeping software is accurate, but hard to use.
      </p>

      <div class="mt-6 flex gap-2">
        <button class="bg-gray-900 text-white px-4 py-2 rounded-full text-sm">
          Get free
        </button>
        <button class="border px-4 py-2 rounded-full text-sm">
          ▶ Watch
        </button>
      </div>
    </div>
  </div> --}}

</section>

<!-- Trusted -->
<section class="px-8 py-12 text-center">
  <p class="text-gray-500 mb-6">
    Trusted by these companies
  </p>

  <div class="flex flex-wrap justify-center gap-8 text-gray-700 font-medium">
    <span>Transistor</span>
    <span>Tuple</span>
    <span>StaticKit</span>
    <span>Mirage</span>
    <span>Laravel</span>
  </div>
</section>

</body>
</html>