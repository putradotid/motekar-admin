@extends('layouts.public')

@section('content')
<section class="bg-[#F8E29A] py-20 overflow-hidden relative">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2 items-center gap-10">

            <div>
                <h1 class="text-5xl font-bold mb-6">
                    Hubungi Kami
                </h1>

                <p class="text-xl text-gray-700 max-w-lg">
                    Kirimkan pertanyaan, saran, atau kebutuhan konsultasi Anda.
                    Tim kami akan merespon secepat mungkin.
                </p>
            </div>

            <div>
                <img
                    src="{{ asset('storage/assets/contact.png') }}"
                    class="w-full max-w-xl mx-auto"
                    alt="Contact"
                >
            </div>

        </div>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">

        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-2xl p-10">

            <h2 class="text-4xl font-bold mb-10">
                Kirim Pesan
            </h2>

            <form action="#" method="POST">

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block mb-2 font-medium">
                            Nama
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400"
                            placeholder="Nama Lengkap">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400"
                            placeholder="email@gmail.com">
                    </div>

                </div>

                <div class="mt-6">
                    <label class="block mb-2 font-medium">
                        Subjek
                    </label>

                    <input
                        type="text"
                        name="subject"
                        class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400"
                        placeholder="Contoh: Konsultasi Website Company Profile">
                </div>

                <div class="mt-6">
                    <label class="block mb-2 font-medium">
                        Pesan
                    </label>

                    <textarea
                        rows="6"
                        name="message"
                        class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400"
                        placeholder="Tulis pesan Anda di sini..."></textarea>
                </div>

                <div class="mt-8 text-center">

                    <button
                        type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-10 py-4 rounded-xl transition">

                        Kirim Pesan

                    </button>

                </div>

            </form>

        </div>

    </div>
</section>
@endsection