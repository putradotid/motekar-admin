@extends('layouts.public')

@section('content')
{{-- Hero section --}}
<section class="bg-gray-300 relative mt-10 px-8 py-16 md:py-24">
  {{-- Gear Background --}}
  <div class="absolute inset-0 opacity-20 pointer-events-none">
      <img
          src="{{ asset('storage/assets/gear-bg.png') }}"
          class="absolute top-0 right-0 w-1/2"
          alt=""
      >
  </div>
  <div class="max-w-2xl mx-auto text-center">
      <h1 class="text-3xl md:text-5xl font-bold leading-tight">
          Tim Kami
      </h1>

      <p class="mt-6 text-gray-600 text-sm md:text-base">
          PT Motekar Cipta Teknologi adalah perusahaan yang bergerak di bidang industri, informasi dan komunikasi, aktivitas profesional, ilmiah dan teknis, serta pendidikan. Kami berkomitmen menjadi perusahaan unggul di bidang teknologi informasi melalui penciptaan inovasi dan pengembangan solusi yang berkelanjutan. Kami menghadirkan produk dan layanan teknologi yang inovatif, terkini, dan berorientasi pada kebutuhan pengguna. Dengan penguatan kompetensi sumber daya manusia serta kolaborasi strategis, kami mendukung transformasi digital dan peningkatan produktivitas di berbagai sektor. Kami juga berupaya memberikan kontribusi positif bagi pembangunan masyarakat dan negara.
      </p>
  </div>
</section>

{{-- section 1 --}}
<section class="bg-amber-500 text-white py-14">
  <div class="max-w-6xl mx-auto px-6">

    <div class="flex justify-between text-center">

      <!-- Item -->
      <div class="flex flex-col items-center flex-1">
        <h2 class="text-4xl md:text-6xl font-bold">Meet Our Team</h2>
      </div>

    </div>

  </div>
</section>

<section class="bg-white py-24">

    <div class="container mx-auto px-6">

        <h2 class="text-center text-6xl font-bold text-blue-700 mb-20">
            The Leader
        </h2>

        <div class="flex flex-wrap justify-center gap-16">

            {{-- Leader --}}
            <div class="text-center">

                <img
                    src="{{ asset('storage/assets/leader1.jpg') }}"
                    class="w-64 h-80 object-cover rounded-lg shadow-xl"
                >

                <h3 class="text-4xl font-bold mt-6 text-orange-500">
                    John Doe
                </h3>

                <p class="italic text-gray-500">
                    Chief Executive Officer
                </p>

            </div>

            {{-- Leader --}}
            <div class="text-center">

                <img
                    src="{{ asset('storage/assets/leader2.jpg') }}"
                    class="w-64 h-80 object-cover rounded-lg shadow-xl"
                >

                <h3 class="text-4xl font-bold mt-6 text-orange-500">
                    John Doe
                </h3>

                <p class="italic text-gray-500">
                    Chief Technology Officer
                </p>

            </div>

        </div>

    </div>

</section>

<section class="bg-orange-500 py-24">

    <div class="container mx-auto px-6">

        <h2 class="text-center text-6xl font-bold text-white mb-20">
            Client Support
        </h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- Member --}}
            <div class="text-center text-white">

                <img
                    src="{{ asset('storage/assets/support1.jpg') }}"
                    class="w-56 h-72 object-cover rounded-lg shadow-lg mx-auto"
                >

                <h3 class="text-3xl font-bold mt-6">
                    Sarah
                </h3>

                <p class="italic">
                    Customer Support
                </p>

            </div>

        </div>

    </div>

</section>

<section class="bg-orange-500 pb-24">

    <div class="container mx-auto px-6">

        <h2 class="text-center text-6xl font-bold text-white mb-20">
            Developer
        </h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- Developer --}}
            <div class="text-center text-white">

                <img
                    src="{{ asset('storage/assets/dev1.jpg') }}"
                    class="w-56 h-72 object-cover rounded-lg shadow-lg mx-auto"
                >

                <h3 class="text-3xl font-bold mt-6">
                    Michael
                </h3>

                <p class="italic">
                    Backend Developer
                </p>

            </div>

        </div>

    </div>

</section>
@endsection