@extends('layouts.public')

@section('content')
{{-- Hero section --}}
<section class="bg-gray-300 relative mt-10 px-8 py-16 md:py-24">
    <div class="max-w-2xl mx-auto text-center">
        <h1 class="text-3xl md:text-5xl font-bold leading-tight">
            Tentang Kami
        </h1>

        <p class="mt-6 text-gray-600 text-sm md:text-base">
            PT Motekar Cipta Teknologi adalah perusahaan yang bergerak di bidang industri, informasi dan komunikasi, aktivitas profesional, ilmiah dan teknis, serta pendidikan. Kami berkomitmen menjadi perusahaan unggul di bidang teknologi informasi melalui penciptaan inovasi dan pengembangan solusi yang berkelanjutan. Kami menghadirkan produk dan layanan teknologi yang inovatif, terkini, dan berorientasi pada kebutuhan pengguna. Dengan penguatan kompetensi sumber daya manusia serta kolaborasi strategis, kami mendukung transformasi digital dan peningkatan produktivitas di berbagai sektor. Kami juga berupaya memberikan kontribusi positif bagi pembangunan masyarakat dan negara.
        </p>
    </div>

    <div class="mt-16 flex gap-4 justify-start md:justify-center">
        <button class="bg-blue-900 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-300">
            PRODUK KAMI
        </button>
        <button class="bg-blue-900 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-300">
        PELANGGAN KAMI
        </button>
    </div>

</section>

{{-- Section 2 --}}
{{-- Section Visi Misi --}}
<section class="py-20 bg-white">

    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-3 gap-10 items-center">

            <!-- Gambar -->
            <div>
                <img
                    src="{{ asset('storage/assets/beranda.jpg') }}"
                    alt="Motekar"
                    class="w-full h-125 object-cover"
                >
            </div>

            <!-- VISI -->
            <div class="text-center">

                <div class="border border-gray-400 rounded-xl h-40 flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-14 h-14 text-gray-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M12 3l7 3v5c0 5-3.5 8.5-7 10-3.5-1.5-7-5-7-10V6l7-3z"/>

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M12 8l1.2 2.4 2.6.4-1.9 1.8.5 2.6-2.4-1.3-2.4 1.3.5-2.6-1.9-1.8 2.6-.4L12 8z"/>
                    </svg>
                </div>

                <h3 class="text-3xl font-bold text-gray-700 mb-4">
                    VISI
                </h3>

                <p class="text-blue-700 leading-relaxed">
                    Menjadi perusahaan yang unggul di bidang teknologi
                    informasi melalui berbagai kegiatan usaha yang
                    inovatif, profesional, dan berkelanjutan.
                </p>

            </div>

            <!-- MISI -->
            <div class="text-center">

                <div class="border border-gray-400 rounded-xl h-40 flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-14 h-14 text-gray-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M4 7h16v11H4z"/>

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M9 7V5h6v2"/>
                    </svg>
                </div>

                <h3 class="text-3xl font-bold text-gray-700 mb-4">
                    MISI
                </h3>

                <p class="text-blue-700 leading-relaxed text-left">
                    1. Memberikan solusi teknologi informasi yang inovatif dan berorientasi pada kebutuhan pengguna.<br><br>

                    2. Mengembangkan layanan digital yang berkualitas dan berkelanjutan.<br><br>

                    3. Meningkatkan kompetensi sumber daya manusia melalui pendidikan dan pelatihan.
                </p>

            </div>

        </div>

    </div>

</section>
@endsection