@extends('layouts.public')

@section('content')
{{-- Hero Section — Swiper --}}
<section class="relative mt-16">

    {{-- Swiper Container --}}
    <div class="swiper heroSwiper">
        <div class="swiper-wrapper">

            @forelse ($heroSlides ?? [] as $slide)
                <div class="swiper-slide">
                    <div class="relative px-24 py-24 md:py-24 min-h-64"
                         style="
                            @if ($slide['background_type'] === 'color')
                                background-color: {{ $slide['background_value'] }};
                            @else
                                background-image: url('{{ $slide['background_value'] }}');
                                background-size: cover;
                                background-position: center;
                            @endif
                         ">

                        <div class="max-w-2xl relative z-10">

                            {{-- Icon --}}
                            @if (!empty($slide['icon_url']))
                                <img src="{{ $slide['icon_url'] }}"
                                     class="w-16 h-16 object-contain mb-4" alt="icon">
                            @endif

                            {{-- Title --}}
                            <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                                {{ $slide['title'] }}
                            </h1>

                            {{-- Description --}}
                            @if (!empty($slide['description']))
                                <p class="mt-6 text-gray-600 text-xs md:text-sm">
                                    {{ $slide['description'] }}
                                </p>
                            @endif

                            {{-- Button --}}
                            @if (!empty($slide['button_text']))
                                <div class="mt-16 flex gap-4">
                                    <a href="{{ $slide['button_url'] ?? '#' }}">
                                        <button class="bg-blue-900 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-300">
                                            {{ $slide['button_text'] }}
                                        </button>
                                    </a>
                                </div>
                            @endif

                        </div>

                        {{-- Logo kanan --}}
                        <div class="hidden md:block absolute right-8 top-1/2 -translate-y-1/2">
                            <img src="{{ asset('storage/hero-logo.png') }}"
                                alt="logo"
                                style="width: 420px; height: 280px; object-fit: contain;">
                        </div>

                    </div>
                </div>
            @empty
                {{-- Fallback kalau tidak ada data --}}
                <div class="swiper-slide">
                    <div class="bg-gray-300 relative px-8 py-16 md:py-24">
                        <div class="max-w-2xl">
                            <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                                Where Innovation Meets Execution
                            </h1>
                            <p class="mt-6 text-gray-600 text-xs md:text-sm">
                                Kami membantu perusahaan dan UMKM bertransformasi secara digital.
                            </p>
                        </div>
                    </div>
                </div>
            @endforelse

            
          </div>
          
          {{-- Navigation --}}
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
          
          {{-- Pagination --}}
          <div class="swiper-pagination"></div>
        </div>
</section>

{{-- Section Core Value --}}
<section class="bg-amber-500 text-white py-6">
  <div class="max-w-6xl mx-auto text-center">

    <!-- Title -->
    <h2 class="text-3xl md:text-4xl font-bold">
      Kenapa Memilih Kami?
    </h2>

    <!-- Grid -->
    <div class="flex justify-center gap-28 mt-8 flex-wrap">

      <!-- Item -->
      <div class="flex flex-col items-center">
        <img src="{{ asset('storage/icon4.png') }}" 
             class="w-18 h-18 object-contain" />
        <p class="mt-4 text-sm">Inovatif</p>
      </div>

      <div class="flex flex-col items-center">
        <img src="{{ asset('storage/icon3.png') }}" 
             class="w-18 h-18 object-contain" />
        <p class="mt-4 text-sm">Solutif</p>
      </div>

      <div class="flex flex-col items-center">
        <img src="{{ asset('storage/icon.png') }}" 
             class="w-18 h-18 object-contain" />
        <p class="mt-4 text-sm">Produktif</p>
      </div>

      <div class="flex flex-col items-center">
        <img src="{{ asset('storage/icon2.png') }}" 
             class="w-18 h-18 object-contain" />
        <p class="mt-4 text-sm">Update</p>
      </div>

    </div>
  </div>
</section>

{{-- Section About --}}
<section class="flex flex-col md:flex-row py-16">

  <div class="grid grid-cols-3 gap-3 max-w-xl mx-auto">

    <!-- gambar kiri -->
    <div class="col-span-1 grid grid-rows-3 gap-4">
      <img src="{{ $about['image_url'] ?? asset('storage/assets/beranda2.jpg') }}" 
           class="w-full h-full object-cover">

      <img src="{{ asset('storage/assets/beranda4.jpg') }}" 
           class="w-full h-full object-cover">

      <div class="grid grid-cols-2 gap-2">
        <img src="{{ asset('storage/assets/beranda3.jpg') }}" 
             class="w-full h-full object-cover">
        <img src="{{ asset('storage/assets/beranda5.jpg') }}" 
             class="w-full h-full object-cover">
      </div>
    </div>

    <!-- KANAN (gambar besar) -->
    <div class="col-span-2">
      <img src="{{ asset('storage/assets/beranda.jpg') }}" 
           class="w-full h-full object-cover">
    </div>

  </div>

  <!-- TEKS -->
  <div class="max-w-2xl px-8 mt-8 md:mt-0">
    <span class="text-amber-500 font-bold">{{ $about['title'] ?? 'Tentang Kami' }}</span>
    <h1 class="text-4xl md:text-5xl font-bold leading-tight">
      {{ $about['subtitle'] ?? 'Mitra Strategis dalam Transformasi Digital' }}
    </h1>
    <p class="mt-6 text-gray-600 text-xs md:text-sm">
      {{ $about['description'] ?? 'PT Motekar Cipta Teknologi adalah perusahaan yang bergerak di bidang teknologi informasi, industri digital, aktivitas profesional dan teknis, serta pendidikan. Kami berkomitmen menghadirkan solusi teknologi yang inovatif, berorientasi pada kebutuhan pengguna, dan berkelanjutan. Dengan dukungan tim profesional dan kolaborasi strategis, kami membantu organisasi meningkatkan efisiensi, produktivitas, dan daya saing melalui implementasi sistem dan platform digital yang tepat guna. Kami senantiasa mengikuti perkembangan teknologi terkini untuk memastikan setiap solusi yang kami kembangkan relevan dan adaptif terhadap perubahan. Melalui pendekatan yang terstruktur dan berbasis kualitas, kami berupaya memberikan nilai tambah yang nyata bagi setiap mitra dan klien kami.' }}
    </p>
    <div class="mt-6 flex gap-4">
      <button class="bg-blue-900 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-300">
        LIHAT LAYANAN
      </button>
    </div>
  </div>

</section>

{{-- Section Stats --}}
<section class="bg-amber-500 text-white py-14">
  <div class="max-w-6xl mx-auto px-6">

    <div class="flex justify-between text-center">

      <!-- Item -->
      <div class="flex flex-col items-center flex-1">
        <h2 class="text-4xl md:text-6xl font-bold">{{ $stats['value_1'] }}</h2>
        <p class="mt-2 text-xs md:text-sm font-semibold tracking-wide">
          {{ $stats['label_1'] ?? 'KLIEN TERLAYANI' }}
        </p>
      </div>

      <div class="flex flex-col items-center flex-1">
        <h2 class="text-4xl md:text-6xl font-bold">{{ $stats['value_2'] }}</h2>
        <p class="mt-2 text-xs md:text-sm font-semibold tracking-wide">
          {{ $stats['label_2'] ?? 'PROYEK SELESAI' }}
        </p>
      </div>

      <div class="flex flex-col items-center flex-1">
        <h2 class="text-4xl md:text-6xl font-bold">{{ $stats['value_3'] }}</h2>
        <p class="mt-2 text-xs md:text-sm font-semibold tracking-wide">
          {{ $stats['label_3'] ?? 'TENAGA PROFESIONAL' }}
        </p>
      </div>

      <div class="flex flex-col items-center flex-1">
        <h2 class="text-4xl md:text-6xl font-bold">{{ $stats['value_4'] ?? '50+' }}</h2>
        <p class="mt-2 text-xs md:text-sm font-semibold tracking-wide">
          {{ $stats['label_4'] ?? 'MITRA & KOLABORASI' }}
        </p>
      </div>

    </div>

  </div>
</section>

{{-- Section Layanan --}}
<section class="py-16 md:py-24">
  <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row items-center gap-16">

    <!-- TEXT -->
    <div class="flex-1 flex flex-col justify-start">
      <span class="text-amber-500 font-bold">Layanan Kami</span>
      <h1 class="text-4xl md:text-5xl font-bold leading-tight">
        {{ $service['name'] ?? 'Solusi & Layanan Kami' }}
      </h1>

      <p class="mt-6 text-gray-600 text-sm md:text-base">
        {{ $service['description'] ?? 'Kami menyediakan layanan pengembangan dan konsultasi teknologi yang dirancang untuk menjawab kebutuhan industri modern.' }}
      </p>
    </div>

    <!-- IMAGE COLLAGE -->
    <div class="flex-1 flex justify-center">

      <div class="grid grid-cols-2 gap-4 w-80 md:w-105">

        <img src="{{ $service['image_1'] ?? asset('storage/assets/beranda5.jpg') }}"
        class="w-full aspect-square object-cover">

      <img src="{{ asset('storage/assets/beranda2.jpg') }}"
        class="w-full aspect-square object-cover">

      <img src="{{ asset('storage/assets/beranda3.jpg') }}"
        class="w-full aspect-square object-cover">

      <img src="{{ asset('storage/assets/beranda4.jpg') }}"
        class="w-full aspect-square object-cover">

      </div>

    </div>

  </div>
</section>

{{-- Section CTA --}}
<section class="bg-gray-100 py-16 md:py-24">
  <div class="max-w-3xl mx-auto px-6">

    <div class="bg-white rounded-2xl shadow-lg p-10">
      <div class="flex flex-col md:flex-row items-center gap-8">
        
        <!-- IMAGE -->
        <div class="w-24 md:w-32 flex">
          <img src="{{ asset('storage/hero-logo.png') }}" 
               class="w-full object-contain" />
        </div>
  
        <!-- CONTENT -->
        <div class="flex-1 text-center md:text-left">
  
          <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
            {{ $cta['title'] ?? 'Butuh Konsultasi Teknologi?' }}
          </h2>
  
          <p class="mt-4 text-gray-600 text-sm md:text-base leading-relaxed max-w-xl">
            {{ $cta['description'] ?? 'Diskusikan kebutuhan sistem atau solusi digital Anda bersama tim kami untuk menemukan solusi teknologi yang tepat bagi bisnis.' }}
          </p>
  
        </div>
      </div>
      
      <div class="w-full md:w-auto flex justify-center">
        <div class="mt-6">
          <a href="{{ $cta['button_url'] ?? '#' }}" class="bg-amber-500 hover:bg-amber-600 text-white px-8 py-3 rounded-lg font-semibold transition">
            {{ $cta['button_text'] ?? 'Jadwalkan Meeting' }}
          </a>
        </div>
      
    </div>
    

  </div>
</section>
@endsection