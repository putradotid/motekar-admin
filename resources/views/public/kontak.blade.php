@extends('layouts.public')

@section('content')
{{-- Hero section --}}
<section class="bg-[#F8E19A] relative mt-10 px-8 py-16 md:py-24">
    <div class="container mx-auto px-6 relative z-10">

        <div class="text-center mb-12">
            <h2 class="text-5xl font-bold mb-4">Kontak Kami</h2>
            <p class="text-gray-700 max-w-xl mx-auto">
                Hubungi kami dengan cara di bawah. Klik pada peta
                untuk melihat lebih detail atau membuka Google Maps.
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-10 items-center">

            {{-- Maps — dynamic dari setting --}}
            <iframe class="rounded-lg shadow-lg w-full"
                style="height: 400px; border:0;"
                src="https://www.google.com/maps?q={{ $setting['map_latitude'] ?? '-7.398976461906811' }},{{ $setting['map_longitude'] ?? '109.65420204629316' }}&hl=id;z=14&output=embed"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>

            {{-- Info --}}
            <div>
                <div class="space-y-5">
                    <div>
                        <h4 class="font-bold">Nama Perusahaan</h4>
                        <p class="text-gray-700">{{ $setting['company_name'] ?? '-' }}</p>
                    </div>
                    <div>
                        <h4 class="font-bold">Alamat</h4>
                        <p class="text-gray-700">{{ $setting['company_address'] ?? '-' }}</p>
                    </div>
                    <div>
                        <h4 class="font-bold">Email</h4>
                        <p class="text-gray-700">{{ $setting['company_email'] ?? '-' }}</p>
                    </div>
                    <div>
                        <h4 class="font-bold">Telepon</h4>
                        <p class="text-gray-700">{{ $setting['company_phone'] ?? '-' }}</p>
                    </div>
                    <div>
                        <h4 class="font-bold">Jam Operasional</h4>
                        <p class="text-gray-700">
                            {{ $setting['office_open'] ?? '-' }} - {{ $setting['office_close'] ?? '-' }} WIB
                        </p>
                    </div>
                </div>

                {{-- WA Button — fix format nomor --}}
                @php
                    $wa = $setting['company_whatsapp'] ?? '';
                    if (str_starts_with($wa, '62')) {
                        $waLink = $wa;
                    } elseif (str_starts_with($wa, '0')) {
                        $waLink = '62' . substr($wa, 1);
                    } else {
                        $waLink = '62' . $wa;
                    }
                @endphp

                @if ($wa)
                    <a href="https://wa.me/{{ $waLink }}" target="_blank"
                       class="mt-8 inline-flex items-center gap-4 bg-white px-8 py-4 rounded-2xl shadow-md hover:shadow-lg transition">
                        <i class="fab fa-whatsapp text-4xl text-green-500"></i>
                        <span class="font-bold text-green-500 text-lg">Chat Lewat WhatsApp</span>
                    </a>
                @endif
            </div>

        </div>
    </div>
</section>

{{-- Section sosmed --}}
<section class="bg-amber-500 text-white py-14">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex justify-between text-center">

            <div class="flex flex-col items-center flex-1">
                <a href="{{ $setting['youtube_url'] ?? '#' }}" target="_blank"
                   class="text-white hover:opacity-75 transition">
                    <i class="fab fa-youtube text-5xl mb-2"></i>
                    <p class="text-sm font-semibold">YouTube</p>
                </a>
            </div>

            <div class="flex flex-col items-center flex-1">
                <a href="{{ $setting['facebook_url'] ?? '#' }}" target="_blank"
                   class="text-white hover:opacity-75 transition">
                    <i class="fab fa-facebook text-5xl mb-2"></i>
                    <p class="text-sm font-semibold">Facebook</p>
                </a>
            </div>

            <div class="flex flex-col items-center flex-1">
                <a href="{{ $setting['instagram_url'] ?? '#' }}" target="_blank"
                   class="text-white hover:opacity-75 transition">
                    <i class="fab fa-instagram text-5xl mb-2"></i>
                    <p class="text-sm font-semibold">Instagram</p>
                </a>
            </div>

        </div>
    </div>
</section>

{{-- CTA --}}
<section class="bg-gray-100 py-16 md:py-24">
    <div class="max-w-5xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-lg p-10">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="w-24 md:w-40 flex-shrink-0">
                    <img
                        src="{{ $cta['icon_url'] ?? asset('storage/hero-logo.png') }}"
                        class="w-full object-contain">
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900">
                        {{ $cta['title'] ?? 'Butuh Konsultasi Teknologi?' }}
                    </h2>
                    <p class="mt-5 text-gray-600 text-base md:text-lg leading-relaxed">
                        {{ $cta['description'] ?? 'Diskusikan kebutuhan sistem atau solusi digital Anda bersama tim kami.' }}
                    </p>
                </div>
            </div>
            <div class="mt-10 flex justify-center">
                <a href="{{ $cta['button_url'] ?? '#' }}"
                   class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-10 py-4 rounded-xl transition duration-300">
                    {{ $cta['button_text'] ?? 'Hubungi Kami' }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection