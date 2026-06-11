@extends('layouts.public')

@section('content')
{{-- Hero section --}}
<section class="bg-[#F8E19A] relative mt-10 px-8 py-16 md:py-24">
    <div class="container mx-auto px-6 relative z-10">

        {{-- Header --}}
        <div class="text-center mb-12">

            <h2 class="text-5xl font-bold mb-4">
                Kontak Kami
            </h2>

            <p class="text-gray-700 max-w-xl mx-auto">
                Hubungi kami dengan cara di bawah. Klik pada peta
                untuk melihat lebih detail atau membuka Google Maps.
            </p>

        </div>

        {{-- Content --}}
        <div class="grid lg:grid-cols-2 gap-10 items-center">

            {{-- Maps --}}
            <iframe class="rounded-lg shadow-lg h-100 w-full"
                src="https://www.google.com/maps?q=-7.398976461906811,109.65420204629316&hl=es;z=14&output=embed"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>

            {{-- Info --}}
            <div>

                <div class="space-y-5">

                    <div>
                        <h4 class="font-bold">Nama Perusahaan</h4>
                        <p class="text-gray-700">
                            {{ $setting['company_name'] ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <h4 class="font-bold">Alamat</h4>
                        <p class="text-gray-700">
                            {{ $setting['company_address'] ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <h4 class="font-bold">Email</h4>
                        <p class="text-gray-700">
                            {{ $setting['company_email'] ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <h4 class="font-bold">Telepon</h4>
                        <p class="text-gray-700">
                            {{ $setting['company_phone'] ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <h4 class="font-bold">Jam Operasional</h4>
                        <p class="text-gray-700">
                            {{ $setting['office_open'] ?? '-' }} -
                            {{ $setting['office_close'] ?? '-' }} WIB
                        </p>
                    </div>

                </div>

                {{-- WA Button --}}
                <a
                    href="https://wa.me/{{ $setting['company_whatsapp'] ?? '#' }}"
                   target="_blank"
                    class="mt-8 inline-flex items-center gap-4 bg-white px-8 py-4 rounded-2xl shadow-md hover:shadow-lg transition"
                >
                    <span class="text-4xl">🟢</span>

                    <span class="font-bold text-green-600 text-lg">
                        Chat Lewat WhatsApp
                    </span>
                </a>

            </div>

        </div>

    </div>

</section>

{{-- Section sosmed --}}
<section class="bg-amber-500 text-white py-14">
  <div class="max-w-6xl mx-auto px-6">

    <div class="flex justify-between text-center">

      <!-- Item -->
      <div class="flex flex-col items-center flex-1">
        <h2 class="">{{ $setting['company_name'] ?? '-' }}</h2>
      </div>
      
      <div class="flex flex-col items-center flex-1">
        <h2 class="">{{ $setting['company_facebook'] ?? '-' }}</h2>
      </div>
      
      <div class="flex flex-col items-center flex-1">
        <h2 class="">{{ $setting['company_twitter'] ?? '-' }}</h2>
      </div>

    </div>

  </div>
</section>

<section class="bg-gray-100 py-20">

    <div class="container mx-auto px-6">

        <div
            class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-10"
        >

            <div class="grid md:grid-cols-[150px_1fr] gap-8 items-center">

                {{-- Ilustrasi --}}
                <div class="flex justify-center">
                    <img
                        src="{{ asset('storage/assets/beranda2.jpg') }}"
                        alt="Meeting"
                        class="w-32"
                    >
                </div>

                {{-- Text --}}
                <div>

                    <h3 class="text-4xl font-bold mb-4">
                        Butuh Konsultasi Teknologi?
                    </h3>

                    <p class="text-gray-600 text-xl mb-8">
                        Diskusikan kebutuhan sistem atau solusi digital
                        Anda bersama tim kami untuk menemukan solusi
                        teknologi yang tepat bagi bisnis.
                    </p>

                    <a
                        href="{{ route('login') }}"
                        class="inline-block bg-orange-500 text-white font-semibold px-10 py-4 rounded-xl hover:bg-orange-600 transition"
                    >
                        Jadwalkan Meeting
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>
@endsection