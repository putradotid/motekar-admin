@extends('layouts.public')

@section('content')
{{-- Hero section --}}
<section class="relative mt-10 px-8 py-16 md:py-24 bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('storage/bg-hero.png') }}');">
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
            {{ $tHero['title'] ?? 'Pelanggan Kami' }}
        </h1>

        <p class="mt-6 text-gray-600 text-sm md:text-base">
            {{ $tHero['description'] ?? 'Beberapa pelanggan yang pernah bekerja sama dengan kami' }}
        </p>
    </div>

    {{-- Grid Featured Customers --}}
    @if (count($featuredCustomers) > 0)
        <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-8 relative z-10">
            @foreach ($featuredCustomers as $customer)
                <div class="flex flex-col items-center text-center">
                    @if (!empty($customer['photo']))
                        <img src="{{ $customer['photo'] }}" alt="{{ $customer['name'] }}"
                            class="w-40 h-52 object-cover shadow-lg mb-3">
                    @else
                        <div class="w-40 h-52 bg-amber-300 flex items-center justify-center text-white text-sm mb-3">
                            Tidak ada foto
                        </div>
                    @endif
                    <h3 class="font-bold text-lg">{{ $customer['name'] }}</h3>
                    @if (!empty($customer['designation']))
                        <p class="text-gray-600 text-sm italic">{{ $customer['designation'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

</section>

{{-- Testimonials --}}
<section class="bg-amber-500 py-24">
    <div class="container mx-auto px-6">

        @if(count($testimonials) > 0)

            <div class="swiper testimoniSwiper relative">

                <div class="swiper-wrapper">

                    @foreach($testimonials as $item)

                        <div class="swiper-slide">

                            <div class="grid lg:grid-cols-[80px_280px_1fr_80px] items-center gap-10">

                                {{-- Prev --}}
                                <div class="flex justify-center">
                                    <button class="testimoni-prev text-white text-6xl hover:opacity-80">
                                        &#8249;
                                    </button>
                                </div>

                                {{-- Photo --}}
                                <div>
                                    @if(!empty($item['photo']))
                                        <img
                                            src="{{ $item['photo'] }}"
                                            alt="{{ $item['name'] }}"
                                            class="w-full h-[420px] object-cover"
                                        >
                                    @else
                                        <div class="w-full h-[420px] bg-amber-400 flex items-center justify-center text-white">
                                            Tidak ada foto
                                        </div>
                                    @endif
                                </div>

                                {{-- Content --}}
                                <div class="text-white">

                                    <h2 class="text-5xl font-bold mb-8 leading-tight">
                                        {{ $item['title'] }}
                                    </h2>

                                    <p class="text-xl leading-relaxed mb-10">
                                        {{ $item['description'] }}
                                    </p>

                                    <div>
                                        <h4 class="font-bold text-2xl">
                                            {{ $item['name'] }}
                                        </h4>

                                        @if(!empty($item['social_handle']))
                                            <p class="text-orange-100">
                                                {{ $item['social_handle'] }}
                                            </p>
                                        @endif
                                    </div>

                                </div>

                                {{-- Next --}}
                                <div class="flex justify-center">
                                    <button class="testimoni-next text-white text-6xl hover:opacity-80">
                                        &#8250;
                                    </button>
                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @else

            <div class="text-center text-white">
                Belum ada testimoni.
            </div>

        @endif

    </div>
</section>

{{-- Partners --}}
<section class="bg-white py-24">

    <div class="container mx-auto px-6">

        <h2 class="text-center text-6xl font-bold text-blue-900 mb-16">
            Client & Partners
        </h2>

        @if (count($partners) > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-12 items-center">

                @foreach ($partners as $partner)
                    <div class="flex items-center justify-center">
                        <img src="{{ $partner['logo_image'] }}"
                             alt="{{ $partner['name'] ?? 'Partner' }}"
                             class="max-h-16 object-contain grayscale hover:grayscale-0 transition">
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center">Belum ada client & partner.</p>
        @endif

    </div>

</section>
@endsection

@push('scripts')
<style>
    .testimoni-prev,
    .testimoni-next {
        color: #fff !important;
    }
    .testimoni-prev::after,
    .testimoni-next::after {
        font-size: 24px !important;
        font-weight: bold;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('.testimoniSwiper')) {
            new Swiper('.testimoniSwiper', {
                loop: true,
                autoplay: {
                    delay: 6000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.testimoni-next',
                    prevEl: '.testimoni-prev',
                },
            });
        }
    });
</script>
@endpush