@extends('layouts.public')

@section('content')
<section class="bg-gray-300 relative mt-16 px-8 py-16 md:py-24">

  <div class="max-w-2xl">
    <h1 class="text-4xl md:text-6xl font-bold leading-tight">
      Where Innovation
      <br>
      Meets Execution
    </h1>

    <p class="mt-6 text-gray-600 text-xs md:text-sm">
      Kami membantu perusahaan dan UMKM bertransformasi secara digital melalui pengembangan software, sistem terintegrasi, dan solusi teknologi yang scalable. Solusi teknologi terintegrasi untuk mempercepat pertumbuhan bisnis Anda di era digital.
    </p>
  </div>

  <!-- Card kanan -->
  <div class="hidden md:block absolute right-0 top-10">
    <div class="h-100 w-100 rounded-lg flex items-center justify-center">
      <img 
          src="{{ asset('storage/hero-logo.png') }}"
          class="img-fluid rounded-top"
          alt="logo"
      />
    </div>
  </div>

  <div class="mt-16 flex gap-4 justify-start md:justify-center">
    <button class="bg-blue-900 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-300">
      HUBUGI KAMI
    </button>
  </div>

</section>

<section class="bg-amber-500 text-white py-20">
  <div class="max-w-6xl mx-auto text-center px-6">

    <!-- Title -->
    <h2 class="text-3xl md:text-4xl font-bold">
      Kenapa Memilih Kami?
    </h2>

    <!-- Grid -->
    <div class="mt-12 flex justify-center gap-16">

      <!-- Item -->
      <div class="flex flex-col items-center">
        <img src="{{ asset('storage/icon4.png') }}" 
             class="w-32 h-32 object-contain" />
        <p class="mt-4 text-sm">Inovatif</p>
      </div>

      <div class="flex flex-col items-center">
        <img src="{{ asset('storage/icon3.png') }}" 
             class="w-32 h-32 object-contain" />
        <p class="mt-4 text-sm">Solutif</p>
      </div>

      <div class="flex flex-col items-center">
        <img src="{{ asset('storage/icon.png') }}" 
             class="w-32 h-32 object-contain" />
        <p class="mt-4 text-sm">Produktif</p>
      </div>

      <div class="flex flex-col items-center">
        <img src="{{ asset('storage/icon2.png') }}" 
             class="w-32 h-32 object-contain" />
        <p class="mt-4 text-sm">Update</p>
      </div>

    </div>
  </div>
</section>
@endsection