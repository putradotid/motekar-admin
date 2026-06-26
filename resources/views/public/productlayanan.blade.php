@extends('layouts.public')

@section('content')
{{-- Hero section --}}
<section class="relative mt-10 px-8 py-16 md:py-24 bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('storage/bg-hero.png') }}');">

    {{-- Gear Background --}}
    <div class="absolute top-0 right-0 opacity-20">
        <img src="{{ asset('storage/assets/gear.png') }}" alt="">
    </div>

    <div class="max-w-2xl mx-auto text-center">
        <h1 class="text-3xl md:text-5xl font-bold leading-tight">
            {{ $plHero['title'] ?? 'Produk Kami' }}
        </h1>

        <p class="mt-6 text-gray-600 text-sm md:text-base">
            {{ $plHero['description'] ?? 'Produk kami dirancang untuk menjawab tantangan industri modern melalui solusi digital yang inovatif, aman, dan scalable.' }}
    </div>
</section>

{{-- Produk Kami --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-5xl font-bold mb-12">
            Produk Kami
        </h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse ($plProducts as $product)
                <div class="bg-white shadow-lg cursor-pointer hover:shadow-2xl transition"
                     onclick="document.getElementById('modal-product-{{ $product['id'] }}').classList.remove('hidden')">
                    <div class="bg-blue-900 text-white text-center py-4 hover:bg-blue-700 transition duration-300">
                        <h3 class="text-2xl font-bold">
                            {{ $product['title'] }}
                        </h3>
                    </div>

                    <div class="p-6">
                        @if (!empty($product['image_url']))
                            <img src="{{ $product['image_url'] }}" class="w-full h-40 object-contain mb-6">
                        @else
                            <div class="w-full h-40 bg-gray-100 mb-6 flex items-center justify-center text-gray-400 text-sm">
                                Tidak ada gambar
                            </div>
                        @endif

                        <h4 class="font-bold text-3xl mb-4">
                            {{ $product['title'] }}
                        </h4>

                        <p class="text-gray-600">
                            {{ $product['description'] }}
                        </p>

                        @if (!empty($product['detail_description']))
                            <p class="text-amber-500 text-xs font-semibold mt-3 hover:underline">
                                Lihat Selengkapnya
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500 col-span-4 text-center">Belum ada produk.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- Layanan Kami --}}
<section class="relative bg-[#F6DD8F] py-24 overflow-hidden">
    <div class="container mx-auto px-6">
        <h2 class="text-5xl font-bold mb-12">
            Layanan Kami
        </h2>
        <div class="grid lg:grid-cols-2 gap-6">

            @forelse ($plServices as $service)
                <div class="bg-white p-6 flex items-start gap-4 shadow cursor-pointer hover:shadow-xl transition"
                     onclick="document.getElementById('modal-service-{{ $service['id'] }}').classList.remove('hidden')">

                    @if (!empty($service['icon_url']))
                        <img src="{{ $service['icon_url'] }}" class="w-16 h-16 object-contain">
                    @else
                        <div class="w-16 h-16 bg-gray-100 flex items-center justify-center text-gray-400 text-xs rounded">
                            Icon
                        </div>
                    @endif

                    <div>
                        <h3 class="font-bold text-2xl mb-2">
                            {{ $service['title'] }}
                        </h3>

                        <p class="text-gray-600">
                            {{ $service['description'] }}
                        </p>

                        @if (!empty($service['detail_description']))
                            <p class="text-amber-600 text-xs font-semibold mt-2 hover:underline">
                                Lihat Selengkapnya
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500 col-span-2 text-center">Belum ada layanan.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- Call to Action --}}
<section class="py-24 bg-white">
    <div class="container mx-auto px-6">
        <div class="border-2 border-blue-900 rounded-xl p-12">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-8">
                <div>
                    <h2 class="text-5xl font-bold mb-4">
                        Anda Berminat?
                    </h2>
                    <p class="text-gray-600">
                        Mari ciptakan produk yang menjadi solusi untuk negeri bersama kami.
                    </p>
                </div>
                <a href="{{ route('hubungi-kami') }}"
                    class="bg-amber-500 hover:bg-amber-600 text-white px-10 py-4 rounded-xl font-semibold"
                >HUBUNGI KAMI</a>
            </div>
        </div>
    </div>
</section>

{{-- ==================== MODAL POPUP PRODUK ==================== --}}
@foreach ($plProducts as $product)
    @if (!empty($product['detail_description']))
        <div id="modal-product-{{ $product['id'] }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-4">
            <div class="bg-white rounded-2xl shadow-lg max-w-lg w-full p-8 relative">
                <button type="button" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700"
                        onclick="document.getElementById('modal-product-{{ $product['id'] }}').classList.add('hidden')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                @if (!empty($product['image_url']))
                    <img src="{{ $product['image_url'] }}" class="w-full h-40 object-contain mb-4">
                @endif

                <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $product['title'] }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $product['detail_description'] }}</p>
            </div>
        </div>
    @endif
@endforeach

{{-- ==================== MODAL POPUP LAYANAN ==================== --}}
@foreach ($plServices as $service)
    @if (!empty($service['detail_description']))
        <div id="modal-service-{{ $service['id'] }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-4">
            <div class="bg-white rounded-2xl shadow-lg max-w-lg w-full p-8 relative">
                <button type="button" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700"
                        onclick="document.getElementById('modal-service-{{ $service['id'] }}').classList.add('hidden')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                @if (!empty($service['icon_url']))
                    <img src="{{ $service['icon_url'] }}" class="w-16 h-16 object-contain mb-4">
                @endif

                <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $service['title'] }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $service['detail_description'] }}</p>
            </div>
        </div>
    @endif
@endforeach

@endsection