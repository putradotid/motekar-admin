@extends('layouts.public')

@section('content')
{{-- Hero section --}}
<section class="bg-gray-300 relative mt-10 px-8 py-16 md:py-24">
    {{-- Gear Background --}}
    <div class="absolute inset-0 opacity-20 pointer-events-none">
        <img src="{{ asset('storage/assets/gear-bg.png') }}"
             class="absolute top-0 right-0 w-1/2" alt="">
    </div>
    <div class="max-w-2xl mx-auto text-center">
        <h1 class="text-3xl md:text-5xl font-bold leading-tight">
            {{ $tkHero['title'] ?? 'Tim Kami' }}
        </h1>
        <p class="mt-6 text-gray-600 text-sm md:text-base">
            {{ $tkHero['description'] ?? '' }}
        </p>
    </div>
</section>

{{-- Section 2 — Meet Our Team --}}
<section class="bg-amber-500 text-white py-14">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex justify-between text-center">
            <div class="flex flex-col items-center flex-1">
                <h2 class="text-4xl md:text-6xl font-bold">
                    {{ $tkHero['section2_label'] ?? 'Meet Our Team' }}
                </h2>
            </div>
        </div>
    </div>
</section>

{{-- Section 3 — The Leader --}}
<section class="bg-white py-24">
    <div class="container mx-auto px-6">
        <h2 class="text-center text-6xl font-bold text-blue-700 mb-20">
            The Leader
        </h2>

        @if (count($tkLeaders) > 0)
            <div class="flex flex-wrap justify-center gap-16">
                @foreach ($tkLeaders as $member)
                    <div class="text-center">
                        @if (!empty($member['photo']))
                            <img src="{{ $member['photo'] }}" alt="{{ $member['name'] }}"
                                 class="w-64 h-80 object-cover rounded-lg shadow-xl">
                        @else
                            <div class="w-64 h-80 bg-gray-200 rounded-lg shadow-xl flex items-center justify-center text-gray-400 text-sm">
                                Tidak ada foto
                            </div>
                        @endif
                        <h3 class="text-4xl font-bold mt-6 text-orange-500">
                            {{ $member['name'] }}
                        </h3>
                        @if (!empty($member['designation']))
                            <p class="italic text-gray-500">{{ $member['designation'] }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-400">Belum ada data.</p>
        @endif
    </div>
</section>

{{-- Section 4 — Client Support --}}
<section class="bg-orange-500 py-24">
    <div class="container mx-auto px-6">
        <h2 class="text-center text-6xl font-bold text-white mb-20">
            Client Support
        </h2>

        @if (count($tkClientSupport) > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10">
                @foreach ($tkClientSupport as $member)
                    <div class="text-center text-white">
                        @if (!empty($member['photo']))
                            <img src="{{ $member['photo'] }}" alt="{{ $member['name'] }}"
                                 class="w-56 h-72 object-cover rounded-lg shadow-lg mx-auto">
                        @else
                            <div class="w-56 h-72 bg-orange-400 rounded-lg shadow-lg mx-auto flex items-center justify-center text-white text-sm">
                                Tidak ada foto
                            </div>
                        @endif
                        <h3 class="text-3xl font-bold mt-6">
                            {{ $member['name'] }}
                        </h3>
                        @if (!empty($member['designation']))
                            <p class="italic">{{ $member['designation'] }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-white opacity-70">Belum ada data.</p>
        @endif
    </div>
</section>

{{-- Section 5 — Developer --}}
<section class="bg-orange-500 pb-24">
    <div class="container mx-auto px-6">
        <h2 class="text-center text-6xl font-bold text-white mb-20">
            Developer
        </h2>

        @if (count($tkDevelopers) > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10">
                @foreach ($tkDevelopers as $member)
                    <div class="text-center text-white">
                        @if (!empty($member['photo']))
                            <img src="{{ $member['photo'] }}" alt="{{ $member['name'] }}"
                                 class="w-56 h-72 object-cover rounded-lg shadow-lg mx-auto">
                        @else
                            <div class="w-56 h-72 bg-orange-400 rounded-lg shadow-lg mx-auto flex items-center justify-center text-white text-sm">
                                Tidak ada foto
                            </div>
                        @endif
                        <h3 class="text-3xl font-bold mt-6">
                            {{ $member['name'] }}
                        </h3>
                        @if (!empty($member['designation']))
                            <p class="italic">{{ $member['designation'] }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-white opacity-70">Belum ada data.</p>
        @endif
    </div>
</section>

@endsection