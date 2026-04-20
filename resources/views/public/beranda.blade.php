@extends('layouts.public')

@section('content')
{{-- Hero section --}}
<section class="bg-gray-300 relative mt-10 px-8 py-16 md:py-24">
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

{{-- Section 1 --}}
<section class="bg-amber-500 text-white py-10">
  <div class="max-w-6xl mx-auto text-center px-6">

    <!-- Title -->
    <h2 class="text-3xl md:text-4xl font-bold">
      Kenapa Memilih Kami?
    </h2>

    <!-- Grid -->
    <div class="flex justify-center gap-16">

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

{{-- Section 2 --}}
<section class="flex py-16 md:py-16">

  <div class="grid grid-cols-3 gap-3 max-w-6xl mx-auto">

    <!-- Gambar -->
    <div class="grid grid-rows-3">
      
      <img src="{{ asset('storage/assets/beranda2.jpg') }}" 
          class="w-auto h-30 object-cover">

      <img src="{{ asset('storage/assets/beranda4.jpg') }}" 
          class="w-auto h-30 object-cover">
          
      <img src="{{ asset('storage/assets/beranda4.jpg') }}" 
          class="w-auto h-30 object-cover">

    </div>

    <!-- RIGHT SIDE (gambar besar) -->
    <div class="col-span-2">
      <img src="{{ asset('storage/assets/beranda.jpg') }}" 
          class="w-auto h-120 object-cover">
    </div>

  </div>

  {{-- Text --}}
  <div class="max-w-2xl px-8">
    <span class="text-amber-500 font-bold">Beranda</span>
    <h1 class="text-4xl md:text-5xl font-bold leading-tight">
      Mitra Strategis dalam Transformasi Digital
    </h1>

    <p class="mt-6 text-gray-600 text-xs md:text-sm">
      PT Motekar Cipta Teknologi adalah perusahaan yang bergerak di bidang teknologi informasi, industri digital, aktivitas profesional dan teknis, serta pendidikan. Kami berkomitmen menghadirkan solusi teknologi yang inovatif, berorientasi pada kebutuhan pengguna, dan berkelanjutan. Dengan dukungan tim profesional dan kolaborasi strategis, kami membantu organisasi meningkatkan efisiensi, produktivitas, dan daya saing melalui implementasi sistem dan platform digital yang tepat guna. Kami senantiasa mengikuti perkembangan teknologi terkini untuk memastikan setiap solusi yang kami kembangkan relevan dan adaptif terhadap perubahan. Melalui pendekatan yang terstruktur dan berbasis kualitas, kami berupaya memberikan nilai tambah yang nyata bagi setiap mitra dan klien kami.
    </p>

    <div class="mt-6 flex gap-4">
    <button class="bg-blue-900 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-300">
      LIHAT LAYANAN
    </button>
  </div>
  </div>

</section>

{{-- Section 3 --}}
<section class="bg-amber-500 text-white py-14">
  <div class="max-w-6xl mx-auto px-6">

    <div class="flex justify-between text-center">

      <!-- Item -->
      <div class="flex flex-col items-center flex-1">
        <h2 class="text-4xl md:text-6xl font-bold">190+</h2>
        <p class="mt-2 text-xs md:text-sm font-semibold tracking-wide">
          KLIEN TERLAYANI
        </p>
      </div>

      <div class="flex flex-col items-center flex-1">
        <h2 class="text-4xl md:text-6xl font-bold">460+</h2>
        <p class="mt-2 text-xs md:text-sm font-semibold tracking-wide">
          PROYEK SELESAI
        </p>
      </div>

      <div class="flex flex-col items-center flex-1">
        <h2 class="text-4xl md:text-6xl font-bold">230+</h2>
        <p class="mt-2 text-xs md:text-sm font-semibold tracking-wide">
          TENAGA PROFESIONAL
        </p>
      </div>

      <div class="flex flex-col items-center flex-1">
        <h2 class="text-4xl md:text-6xl font-bold">50+</h2>
        <p class="mt-2 text-xs md:text-sm font-semibold tracking-wide">
          MITRA & KOLABORASI
        </p>
      </div>

    </div>

  </div>
</section>

{{-- Section 4 --}}
<section class="py-16 md:py-24">
  <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row items-center gap-10">

    <!-- TEXT -->
    <div class="flex-1">
      <h1 class="text-4xl md:text-5xl font-bold leading-tight">
        Where Innovation <br>
        Meets Execution
      </h1>

      <p class="mt-6 text-gray-600 text-sm md:text-base">
        Kami membantu perusahaan dan UMKM bertransformasi secara digital melalui pengembangan software, sistem terintegrasi, dan solusi teknologi yang scalable. 
        Solusi teknologi terintegrasi untuk mempercepat pertumbuhan bisnis Anda di era digital.
      </p>

      <div class="mt-8">
        <button class="bg-blue-900 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition">
          HUBUNGI KAMI
        </button>
      </div>
    </div>

    <!-- IMAGE -->
    <div class="flex-1 flex justify-center">
      <img 
        src="{{ asset('storage/hero-logo.png') }}"
        class="w-72 md:w-96 object-contain"
        alt="hero"
      />
    </div>

  </div>
</section>

{{-- Section 5 --}}
<section class="bg-gray-100 py-16 md:py-24">
  <div class="max-w-3xl mx-auto px-6">

    <div class="bg-white rounded-2xl shadow-lg p-10 flex flex-col md:flex-row items-center gap-8">

      <!-- IMAGE -->
      <div class="w-24 md:w-32 flex">
        <img src="{{ asset('storage/hero-logo.png') }}" 
             class="w-full object-contain" />
      </div>

      <!-- CONTENT -->
      <div class="flex-1 text-center md:text-left">

        <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
          Butuh Konsultasi Teknologi?
        </h2>

        <p class="mt-4 text-gray-600 text-sm md:text-base leading-relaxed max-w-xl">
          Diskusikan kebutuhan sistem atau solusi digital Anda bersama tim kami 
          untuk menemukan solusi teknologi yang tepat bagi bisnis
        </p>

        <div class="mt-6">
          <button class="bg-amber-500 hover:bg-amber-600 text-white px-8 py-3 rounded-lg font-semibold transition">
            Jadwalkan Meeting
          </button>
        </div>

      </div>

    </div>

  </div>
</section>
@endsection