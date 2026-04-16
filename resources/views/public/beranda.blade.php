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

    <div class="mt-8 flex gap-4">
      <button class="bg-blue-900 text-white px-6 py-3 rounded-full">
        HUBUGI KAMI
      </button>
    </div>
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

</section>

<section class="bg-orange-400 text-white height-auto py-16">
  <div class="max-w-6xl mx-auto text-center">
    <span class="text-3xl font-bold">Kenapa Memilih Kami</span>
    <div class="max-w-4xl mx-auto mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <img src="{{ asset('storage/hero-logo.png') }}"class="img-fluid rounded-top" alt="logo"/>
      <img src="{{ asset('storage/hero-logo.png') }}"class="img-fluid rounded-top" alt="logo"/>
      <img src="{{ asset('storage/hero-logo.png') }}"class="img-fluid rounded-top" alt="logo"/>
      <img src="{{ asset('storage/hero-logo.png') }}"class="img-fluid rounded-top" alt="logo"/>
    </div>
  </div>
</section>
@endsection