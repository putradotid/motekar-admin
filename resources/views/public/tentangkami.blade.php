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

{{-- Section Visi Misi --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12 items-center">

            {{-- Gambar — full height --}}
            <div class="h-full">
                <img
                    src="{{ asset('storage/assets/visi.jpg') }}"
                    alt="Visi Misi"
                    class="w-full h-full object-cover"
                    style="min-height: 400px; max-height: 550px;"
                >
            </div>

            {{-- Visi Misi --}}
            <div class="grid sm:grid-cols-2 gap-8">

                {{-- VISI --}}
                <div class="text-center">
                    <div class="border border-gray-300 rounded-2xl flex items-center justify-center mb-4"
                         style="height: 140px;">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-14 h-14 text-gray-400"
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
                        "Menjadi perusahaan yang unggul di bidang teknologi
                        informasi melalui berbagai kegiatan usaha......"
                    </p>
                </div>

                {{-- MISI --}}
                <div class="text-center">
                    <div class="border border-gray-300 rounded-2xl flex items-center justify-center mb-4"
                         style="height: 140px;">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-14 h-14 text-gray-400"
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
                        1. Memberikan solusi teknologi informasi yang inovatif
                        dan berorientasi kepada....
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>


{{-- Section Visi Misi --}}
<section class="bg-orange-500 p-16">
    <div class="container mx-auto m-5">

        <div class="grid lg:grid-cols-2 gap-16 items-center  px-8">

            {{-- Kiri --}}
            <div class="text-white">

                <h2 class="text-5xl font-bold mb-4">
                    The Founder
                </h2>

                <div class="space-y-6 text-white text-sm">

                    <p>
                        PT Motekar Cipta Teknologi didirikan dengan visi untuk
                        menghadirkan solusi teknologi yang inovatif dan relevan
                        dengan kebutuhan industri modern. Di balik berdirinya
                        perusahaan ini adalah sosok pemimpin yang memiliki
                        semangat untuk mengembangkan teknologi sebagai alat
                        transformasi dan peningkatan produktivitas di berbagai sektor.
                    </p>

                    <p>
                        Sebagai pendiri, beliau percaya bahwa teknologi bukan
                        sekadar alat, melainkan sarana untuk menciptakan
                        efisiensi, membuka peluang baru, serta mendorong
                        kemajuan bisnis dan masyarakat. Dengan latar belakang
                        di bidang teknologi informasi dan pengalaman dalam
                        pengembangan sistem digital, beliau memimpin perusahaan
                        untuk terus berinovasi dalam pengembangan perangkat
                        lunak, platform digital, serta berbagai solusi berbasis teknologi.
                    </p>

                    <p>
                        Melalui kepemimpinan yang visioner dan kolaboratif,
                        beliau mendorong tim untuk terus berkembang, beradaptasi
                        dengan perubahan teknologi, serta menghadirkan solusi
                        yang memberikan nilai nyata bagi klien dan mitra.
                    </p>

                </div>

                <div class="mt-12">
                    <h3 class="text-3xl font-bold">
                        John Doe
                    </h3>

                    <p class="italic text-xl mt-2">
                        Founder & Chief Executive Officer
                    </p>
                </div>

            </div>

            {{-- Kanan --}}
            <div class="flex justify-center lg:justify-end">

                <img
                    src="{{ asset('storage/assets/founder.jpg') }}"
                    alt="Founder"
                    class="w-full max-w-md rounded-3xl object-cover shadow-xl"
                >

            </div>

        </div>

    </div>
</section>
@endsection