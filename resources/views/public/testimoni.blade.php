@extends('layouts.public')

@section('content')
{{-- Hero section --}}
<section class="bg-gray-300 relative mt-10 px-8 py-16 md:py-24">
    {{-- Gear Decoration --}}
    <div class="absolute inset-0 opacity-20 pointer-events-none">
        <img
            src="{{ asset('storage/assets/gear-bg.png') }}"
            class="absolute top-0 right-0 w-1/2"
            alt=""
        >
    </div>

    <div class="container max-w-2xl mx-auto text-center">
        <h1 class="text-3xl md:text-5xl font-bold leading-tight">
            Pelanggan Kami
        </h1>

        <p class="mt-6 text-gray-600 text-sm md:text-base">
            Beberapa pelanggan yang pernah bekerja sama dengan kami
        </p>
    </div>

</section>

<section class="bg-orange-500 py-24">

    <div class="container mx-auto px-6">

        <div class="grid lg:grid-cols-[80px_280px_1fr_80px] items-center gap-10">

            {{-- Prev --}}
            <div class="flex justify-center">
                <button class="text-white text-6xl hover:opacity-80">
                    &#8249;
                </button>
            </div>

            {{-- Photo --}}
            <div>
                <img
                    src="{{ asset('storage/assets/testimoni.jpg') }}"
                    alt="Client"
                    class="w-full h-[420px] object-cover"
                >
            </div>

            {{-- Content --}}
            <div class="text-white">

                <h2 class="text-5xl font-bold mb-8 leading-tight">
                    PT Motekar Cipta Teknologi memberikan solusi yang benar-benar sesuai dengan kebutuhan bisnis kami.
                </h2>

                <p class="text-xl leading-relaxed mb-10">
                    Tim mereka sangat profesional dalam memahami kebutuhan sistem yang kami butuhkan dan mampu menerjemahkannya menjadi platform digital yang efisien dan mudah digunakan.
                    Proses pengerjaan terstruktur, komunikatif, dan hasilnya meningkatkan produktivitas operasional perusahaan kami secara signifikan.
                </p>

                <div>
                    <h4 class="font-bold text-2xl">
                        Andi Pratama
                    </h4>

                    <p class="text-orange-100">
                        @andipratama
                    </p>
                </div>

            </div>

            {{-- Next --}}
            <div class="flex justify-center">
                <button class="text-white text-6xl hover:opacity-80">
                    &#8250;
                </button>
            </div>

        </div>

    </div>

</section>

<section class="bg-white py-24">

    <div class="container mx-auto px-6">

        <h2 class="text-center text-6xl font-bold text-blue-700 mb-16">
            Client & Partners
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-12 items-center">

            <img
                src="{{ asset('storage/assets/client1.png') }}"
                alt="client"
                class="h-20 mx-auto object-contain grayscale hover:grayscale-0 transition"
            >

            <img
                src="{{ asset('storage/assets/client2.png') }}"
                alt="client"
                class="h-20 mx-auto object-contain grayscale hover:grayscale-0 transition"
            >

            <img
                src="{{ asset('storage/assets/client3.png') }}"
                alt="client"
                class="h-20 mx-auto object-contain grayscale hover:grayscale-0 transition"
            >

            <img
                src="{{ asset('storage/assets/client4.png') }}"
                alt="client"
                class="h-20 mx-auto object-contain grayscale hover:grayscale-0 transition"
            >

            <img
                src="{{ asset('storage/assets/client5.png') }}"
                alt="client"
                class="h-20 mx-auto object-contain grayscale hover:grayscale-0 transition"
            >

        </div>

    </div>

</section>
@endsection