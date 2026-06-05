@extends('layouts.public')

@section('content')
{{-- Hero section --}}
<section class="bg-gray-300 relative mt-10 px-8 py-16 md:py-24">

    {{-- Gear Background --}}
    <div class="absolute top-0 right-0 opacity-20">
        <img src="{{ asset('storage/assets/gear.png') }}" alt="">
    </div>

    <div class="max-w-2xl mx-auto text-center">
        <h1 class="text-3xl md:text-5xl font-bold leading-tight">
            Produk Kami
        </h1>

        <p class="mt-6 text-gray-600 text-sm md:text-base">
            Produk kami dirancang untuk menjawab tantangan industri modern melalui solusi digital yang inovatif, aman, dan scalable.
        </p>
    </div>
</section>

<section class="py-20 bg-white">

    <div class="container mx-auto px-6">

        <h2 class="text-5xl font-bold mb-12">
            Produk Kami
        </h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            {{-- Product Card --}}
            <div class="bg-white shadow-lg">

                <div class="bg-blue-700 text-white text-center py-4">
                    <h3 class="text-2xl font-bold">
                        Software
                    </h3>
                </div>

                <div class="p-6">

                    <img
                        src="{{ asset('storage/assets/software.png') }}"
                        class="w-full h-40 object-contain mb-6"
                    >

                    <h4 class="font-bold text-3xl mb-4">
                        Software
                    </h4>

                    <p class="text-gray-600">
                        Pengembangan aplikasi perangkat lunak.
                    </p>

                </div>

            </div>

            {{-- Copy untuk produk lain --}}
        </div>

    </div>

</section>

<section class="relative bg-[#F6DD8F] py-24 overflow-hidden">

    <div class="container mx-auto px-6">

        <h2 class="text-5xl font-bold mb-12">
            Layanan Kami
        </h2>

        <div class="grid lg:grid-cols-2 gap-6">

            {{-- Card --}}
            <div class="bg-white p-6 flex items-start gap-4 shadow">

                <img
                    src="{{ asset('storage/assets/service-icon.png') }}"
                    class="w-16 h-16"
                >

                <div>

                    <h3 class="font-bold text-2xl mb-2">
                        Pemrograman Kecerdasan Artifisial
                    </h3>

                    <p class="text-gray-600">
                        Membangun solusi cerdas untuk otomasi dan analisis data.
                    </p>

                </div>

            </div>

            <div class="bg-white p-6 flex items-start gap-4 shadow">
                ...
            </div>

            <div class="bg-white p-6 flex items-start gap-4 shadow">
                ...
            </div>

            <div class="bg-white p-6 flex items-start gap-4 shadow">
                ...
            </div>

            <div class="bg-white p-6 flex items-start gap-4 shadow">
                ...
            </div>

        </div>

    </div>

</section>

<section class="py-24 bg-white">

    <div class="container mx-auto px-6">

        <div class="border-2 border-blue-600 rounded-xl p-12">

            <div class="flex flex-col lg:flex-row justify-between items-center gap-8">

                <div>

                    <h2 class="text-5xl font-bold mb-4">
                        Anda Berminat?
                    </h2>

                    <p class="text-gray-600">
                        Mari ciptakan produk yang menjadi solusi untuk negeri bersama kami.
                    </p>

                </div>

                <a
                    href="{{ route('kontak') }}"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-10 py-4 rounded-xl font-semibold"
                >
                    HUBUNGI KAMI
                </a>

            </div>

        </div>

    </div>

</section>
@endsection