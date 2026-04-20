<header class="fixed top-0 left-0 right-0  z-50 bg-white flex items-center justify-between px-6 py-3">

  <!-- Logo -->
  <div class="flex items-center">
    <div class="w-12 h-12">
      <img 
          src="{{ asset('storage/motekar-logo.png') }}"
          class="w-full h-full object-contain"
          alt="logo"
      />
    </div>
  </div>

  <!-- Right -->
  <div class="flex items-center gap-6">

    <!-- Navigation -->
    <nav class="hidden md:flex items-center gap-6 text-sm text-gray-600">
      <a href="{{ route('beranda') }}" class="hover:text-black transition">Beranda</a>
      <a href="{{ route('tentang-kami') }}" class="hover:text-black transition">Tentang Kami</a>
      <a href="{{ route('produk-layanan') }}" class="hover:text-black transition">Product</a>
      <a href="{{ route('testimoni') }}" class="hover:text-black transition">Testimoni</a>
      <a href="{{ route('tim-kami') }}" class="hover:text-black transition">Tim Kami</a>
      <a href="{{ route('kontak') }}" class="hover:text-black transition">Kontak</a>
    </nav>

    <!-- Button -->
    <a href="{{ route('login') }}" 
       class="text-sm px-4 py-1.5 rounded-full border bg-orange-400 text-white hover:bg-orange-500 transition">
      Sign in
    </a>

  </div>

</header>