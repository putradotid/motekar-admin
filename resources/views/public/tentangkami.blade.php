@extends('layouts.public')

@section('content')
{{-- Hero section --}}
<section class="bg-gray-300 relative mt-10 px-8 py-16 md:py-24">
    <div class="max-w-2xl mx-auto text-center">
        <h1 class="text-3xl md:text-5xl font-bold leading-tight">
            {{ $aboutUs['title'] ?? 'Tentang Kami' }}
        </h1>

        <p class="mt-6 text-gray-600 text-sm md:text-base">
            {{ $aboutUs['description'] ?? 'PT Motekar Cipta Teknologi adalah perusahaan yang bergerak di bidang teknologi informasi.' }}
        </p>
    </div>

    <div class="mt-16 flex gap-4 justify-start md:justify-center">
        <a href="/produk-layanan">
            <button class="bg-blue-900 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-300">
                PRODUK KAMI
            </button>
        </a>
        <a href="/hubungi-kami">
            <button class="bg-blue-900 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-300">
                PELANGGAN KAMI
            </button>
        </a>
    </div>

</section>

{{-- Section Visi Misi --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-28">
        <div class="grid md:grid-cols-2 gap-12 items-center">

            {{-- Gambar — full height --}}
            <div class="h-full">
                <img
                    src="{{ $aboutUs['visi_misi_image'] ?? asset('storage/assets/visi.jpg') }}"
                    alt="Visi Misi"
                    class="w-full h-full object-cover"
                    style="min-height: 400px; max-height: 550px;"
                >
            </div>

            {{-- Visi Misi --}}
            <div class="grid sm:grid-cols-2 gap-8">

                {{-- VISI --}}
                <div class="text-center">
                    <div class="border border-gray-500 rounded-2xl flex items-center justify-center mb-4"
                         style="height: 140px;">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-14 h-14 text-gray-500"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="1">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 3l7 4v5c0 5-3.5 8.5-7 9-3.5-.5-7-4-7-9V7l7-4z"/>
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 8l1.5 3h3l-2.5 2 1 3-3-2-3 2 1-3-2.5-2h3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600 mb-3 tracking-widest">
                        VISI
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed italic">
                        "{{ \Illuminate\Support\Str::limit($aboutUs['vision'] ?? 'Menjadi perusahaan yang unggul di bidang teknologi informasi...', 90) }}"
                    </p>
                    @if (!empty($aboutUs['vision']) && strlen($aboutUs['vision']) > 90)
                        <button type="button" class="text-amber-500 text-xs font-semibold mt-2 hover:underline"
                                onclick="document.getElementById('modal-visi').classList.remove('hidden')">
                            Lihat Selengkapnya
                        </button>
                    @endif
                </div>

                {{-- MISI --}}
                <div class="text-center">
                    <div class="border border-gray-500 rounded-2xl flex items-center justify-center mb-4"
                         style="height: 140px;">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-14 h-14 text-gray-500"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="1">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M4 8h16M6 8V6a2 2 0 012-2h8a2 2 0 012 2v2M6 8v10a2 2 0 002 2h8a2 2 0 002-2V8"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600 mb-3 tracking-widest">
                        MISI
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed italic">
                        {{ \Illuminate\Support\Str::limit($aboutUs['mission'] ?? 'Memberikan solusi teknologi informasi yang inovatif...', 90) }}
                    </p>
                    @if (!empty($aboutUs['mission']) && strlen($aboutUs['mission']) > 90)
                        <button type="button" class="text-amber-500 text-xs font-semibold mt-2 hover:underline"
                                onclick="document.getElementById('modal-misi').classList.remove('hidden')">
                            Lihat Selengkapnya
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </div>
</section>

{{-- Section Founder --}}
<section class="bg-orange-500 p-16">
    <div class="container mx-auto m-5">

        <div class="grid lg:grid-cols-2 gap-16 items-center px-8">

            {{-- Kiri --}}
            <div class="text-white">

                <h2 class="text-5xl font-bold mb-4">
                    {{ $aboutUs['founder_title'] ?? 'The Founder' }}
                </h2>

                <div class="space-y-6 text-white text-sm">
                    @if (!empty($aboutUs['founder_description']))
                        @foreach (explode("\n", $aboutUs['founder_description']) as $paragraph)
                            @if (trim($paragraph) !== '')
                                <p>{{ trim($paragraph) }}</p>
                            @endif
                        @endforeach
                    @else
                        <p>PT Motekar Cipta Teknologi didirikan dengan visi untuk menghadirkan solusi teknologi yang inovatif dan relevan dengan kebutuhan industri modern.</p>
                    @endif
                </div>

                <div class="mt-12">
                    <h3 class="text-3xl font-bold">
                        {{ $aboutUs['founder_name'] ?? 'John Doe' }}
                    </h3>

                    <p class="italic text-xl mt-2">
                        {{ $aboutUs['founder_position'] ?? 'Founder & Chief Executive Officer' }}
                    </p>
                </div>

            </div>

            {{-- Kanan --}}
            <div class="flex justify-center lg:justify-end">
                <img
                    src="{{ $aboutUs['founder_image'] ?? asset('storage/assets/founder.jpg') }}"
                    alt="Founder"
                    class="w-full max-w-md rounded-3xl object-cover shadow-xl"
                >
            </div>

        </div>

    </div>
</section>

{{-- ==================== MODAL POPUP VISI ==================== --}}
@if (!empty($aboutUs['vision']) && strlen($aboutUs['vision']) > 90)
<div id="modal-visi" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-2xl shadow-lg max-w-lg w-full p-8 relative">
        <button type="button" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700"
                onclick="document.getElementById('modal-visi').classList.add('hidden')">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <h3 class="text-xl font-bold text-gray-800 mb-4 tracking-widest">VISI</h3>
        <p class="text-gray-600 text-sm leading-relaxed italic">"{{ $aboutUs['vision'] }}"</p>
    </div>
</div>
@endif

{{-- ==================== MODAL POPUP MISI ==================== --}}
@if (!empty($aboutUs['mission']) && strlen($aboutUs['mission']) > 90)
<div id="modal-misi" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-2xl shadow-lg max-w-lg w-full p-8 relative">
        <button type="button" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700"
                onclick="document.getElementById('modal-misi').classList.add('hidden')">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <h3 class="text-xl font-bold text-gray-800 mb-4 tracking-widest">MISI</h3>
        <p class="text-gray-600 text-sm leading-relaxed italic">{{ $aboutUs['mission'] }}</p>
    </div>
</div>
@endif

@endsection