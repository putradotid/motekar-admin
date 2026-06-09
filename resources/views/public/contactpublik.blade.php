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

            <div id="contactAlert" class="mt-4"></div>

            <form id="contactForm">

                <div class="mt-6">
                    <label class="block mb-2 font-medium">
                        Nama
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="contactName"
                        class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400"
                        placeholder="Nama Lengkap"
                        required>
                </div>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block mb-2 font-medium">
                            Nomor Telepon
                        </label>

                        <input
                            type="text"
                            id="contactPhone"
                            name="phone"
                            class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400"
                            placeholder="Nomor Telepon"
                            required>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Email
                        </label>

                        <input
                            type="email"
                            id="contactEmail"
                            name="email"
                            class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400"
                            placeholder="email@gmail.com"
                            required>
                    </div>

                </div>

                <div class="mt-6">
                    <label class="block mb-2 font-medium">
                        Subjek
                    </label>

                    <input
                        type="text"
                        id="contactSubject"
                        name="subject"
                        class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400"
                        placeholder="Contoh: Konsultasi Website Company Profile"
                        required>
                </div>

                <div class="mt-6">
                    <label class="block mb-2 font-medium">
                        Pesan
                    </label>

                    <textarea
                        rows="6"
                        name="message"
                        id="contactMessage"
                        class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-400"
                        placeholder="Tulis pesan Anda di sini..."
                        required></textarea>
                </div>

                <div class="mt-8 text-center">

                    <button
                        type="submit"
                        id="submitBtn"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-10 py-4 rounded-xl transition">

                        Kirim Pesan

                    </button>

                </div>

            </form>

        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
document.getElementById('contactForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    e.stopPropagation();

    console.log('Submit dipanggil');

    const btn = document.getElementById('submitBtn');
    const alertBox = document.getElementById('contactAlert');

    btn.disabled = true;

    try {

        const payload = {
            name: document.getElementById('contactName').value,
            email: document.getElementById('contactEmail').value,
            phone: document.getElementById('contactPhone').value,
            subject: document.getElementById('contactSubject').value,
            message: document.getElementById('contactMessage').value,
        };

        const res = await fetch('http://127.0.0.1:8000/api/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        const data = await res.json();

        if (res.ok) {

            alertBox.innerHTML = `
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    ${data.message}
                </div>
            `;

            this.reset();

        } else {

            alertBox.innerHTML = `
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    ${data.message}
                </div>
            `;
        }

    } catch (err) {

        console.error(err);

    } finally {

        btn.disabled = false;

    }

    return false;
});
</script>
@endpush