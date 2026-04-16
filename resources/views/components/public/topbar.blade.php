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
      <a href="#" class="hover:text-black transition">Beranda</a>
      <a href="#" class="hover:text-black transition">Tentang Kami</a>
      <a href="#" class="hover:text-black transition">Product</a>
      <a href="#" class="hover:text-black transition">Testimoni</a>
      <a href="#" class="hover:text-black transition">Tim</a>
      <a href="#" class="hover:text-black transition">Kontak</a>
    </nav>

    <!-- Button -->
    <a href="#" 
       class="text-sm px-4 py-1.5 rounded-full border bg-orange-400 text-white hover:bg-orange-500 transition">
      Sign in
    </a>

  </div>

</header>