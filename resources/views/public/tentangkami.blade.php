@extends('layouts.public')

@section('content')
{{-- Hero section --}}
<section class="relative mt-10 px-8 py-16 md:py-24 bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('storage/bg-hero.png') }}');">
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
 
            {{-- Gambar --}}
            <div class="h-full">
                <img src="{{ $aboutUs['visi_misi_image'] ?? asset('storage/assets/visi.jpg') }}"
                     alt="Visi Misi"
                     class="w-full h-full object-cover"
                     style="min-height: 400px; max-height: 550px;">
            </div>
 
            {{-- Visi Misi --}}
            <div class="grid sm:grid-cols-2 gap-8">
 
                {{-- VISI --}}
                <div class="text-center group">
                    <div class="border-2 border-amber-400 rounded-2xl flex items-center justify-center mb-4 bg-amber-50 group-hover:bg-amber-100 transition"
                         style="height: 140px;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-amber-500"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 3l7 4v5c0 5-3.5 8.5-7 9-3.5-.5-7-4-7-9V7l7-4z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8l1.5 3h3l-2.5 2 1 3-3-2-3 2 1-3-2.5-2h3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-3 tracking-widest">VISI</h3>
                    <p class="text-gray-500 text-sm leading-relaxed italic">
                        "{{ \Illuminate\Support\Str::limit($aboutUs['vision'] ?? 'Menjadi perusahaan yang unggul di bidang teknologi informasi...', 90) }}"
                    </p>
                    @if (!empty($aboutUs['vision']) && strlen($aboutUs['vision']) > 90)
                        <button type="button"
                                onclick="openModal('modal-visi')"
                                class="mt-3 inline-flex items-center gap-1 text-amber-500 text-xs font-bold hover:text-amber-600 transition">
                            Lihat Selengkapnya
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    @endif
                </div>
 
                {{-- MISI --}}
                <div class="text-center group">
                    <div class="border-2 border-blue-400 rounded-2xl flex items-center justify-center mb-4 bg-blue-50 group-hover:bg-blue-100 transition"
                         style="height: 140px;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-blue-500"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4 8h16M6 8V6a2 2 0 012-2h8a2 2 0 012 2v2M6 8v10a2 2 0 002 2h8a2 2 0 002-2V8"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-3 tracking-widest">MISI</h3>
                    <p class="text-gray-500 text-sm leading-relaxed italic">
                        {{ \Illuminate\Support\Str::limit($aboutUs['mission'] ?? 'Memberikan solusi teknologi informasi yang inovatif...', 90) }}
                    </p>
                    @if (!empty($aboutUs['mission']) && strlen($aboutUs['mission']) > 90)
                        <button type="button"
                                onclick="openModal('modal-misi')"
                                class="mt-3 inline-flex items-center gap-1 text-blue-500 text-xs font-bold hover:text-blue-600 transition">
                            Lihat Selengkapnya
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    @endif
                </div>
 
            </div>
        </div>
    </div>
</section>

{{-- Section Founder --}}
<section class="bg-amber-500 p-16">
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
<div id="modal-visi"
     class="hidden fixed inset-0 z-50 flex items-center justify-center px-4"
     onclick="if(event.target===this) closeModal('modal-visi')">
 
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black bg-opacity-60 backdrop-blur-sm"></div>
 
    {{-- Modal --}}
    <div class="relative bg-white rounded-3xl shadow-2xl max-w-lg w-full overflow-hidden animate-fadeIn">
 
        {{-- Header --}}
        <div class="bg-gradient-to-r from-amber-400 to-amber-500 px-8 py-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-white bg-opacity-30 rounded-full p-2">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 3l7 4v5c0 5-3.5 8.5-7 9-3.5-.5-7-4-7-9V7l7-4z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white tracking-widest">VISI</h3>
            </div>
            <button onclick="closeModal('modal-visi')"
                    class="text-white hover:text-amber-100 transition">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
 
        {{-- Body --}}
        <div class="px-8 py-6">
            <div class="border-l-4 border-amber-400 pl-4 mb-4">
                <p class="text-gray-700 text-base leading-relaxed italic font-medium">
                    "{{ $aboutUs['vision'] }}"
                </p>
            </div>
        </div>
 
        {{-- Footer --}}
        <div class="px-8 pb-6 text-right">
            <button onclick="closeModal('modal-visi')"
                    class="bg-amber-400 hover:bg-amber-500 text-white font-semibold px-6 py-2 rounded-full transition text-sm">
                Tutup
            </button>
        </div>
 
    </div>
</div>
@endif
 
{{-- ==================== MODAL POPUP MISI ==================== --}}
@if (!empty($aboutUs['mission']) && strlen($aboutUs['mission']) > 90)
<div id="modal-misi"
     class="hidden fixed inset-0 z-50 flex items-center justify-center px-4"
     onclick="if(event.target===this) closeModal('modal-misi')">
 
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black bg-opacity-60 backdrop-blur-sm"></div>
 
    {{-- Modal --}}
    <div class="relative bg-white rounded-3xl shadow-2xl max-w-lg w-full overflow-hidden">
 
        {{-- Header --}}
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-8 py-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-white bg-opacity-30 rounded-full p-2">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 8h16M6 8V6a2 2 0 012-2h8a2 2 0 012 2v2M6 8v10a2 2 0 002 2h8a2 2 0 002-2V8"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white tracking-widest">MISI</h3>
            </div>
            <button onclick="closeModal('modal-misi')"
                    class="text-white hover:text-blue-100 transition">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
 
        {{-- Body --}}
        <div class="px-8 py-6">
            <div class="border-l-4 border-blue-400 pl-4">
                <p class="text-gray-700 text-base leading-relaxed">
                    {{ $aboutUs['mission'] }}
                </p>
            </div>
        </div>
 
        {{-- Footer --}}
        <div class="px-8 pb-6 text-right">
            <button onclick="closeModal('modal-misi')"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-full transition text-sm">
                Tutup
            </button>
        </div>
 
    </div>
</div>
@endif
@endsection

@push('scripts')
<style>
    @keyframes fadeInScale {
        from { opacity: 0; transform: scale(0.95); }
        to   { opacity: 1; transform: scale(1); }
    }
    .animate-fadeIn {
        animation: fadeInScale 0.2s ease-out;
    }
</style>
<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
        const modal = document.getElementById(id);
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }
    // Tutup modal dengan ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('[id^="modal-"]').forEach(m => {
                m.classList.add('hidden');
            });
            document.body.style.overflow = '';
        }
    });
</script>
@endpush