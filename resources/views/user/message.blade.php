@extends('layouts.user')

@section('content')
<div class="container mt-5 pt-4">
    <div class="row" style="height: 85vh; max-width: 1100px; margin: auto;">

        {{-- ========== SIDEBAR KIRI ========== --}}
        <div class="col-md-4 col-lg-3 border-right bg-white p-0 d-flex flex-column">

            {{-- Header --}}
            <div class="p-3 border-bottom">
                <h5 class="font-weight-bold mb-3">Messages</h5>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Cari Pesan"
                    style="border-radius: 4px;"
                >
            </div>

            {{-- Daftar Kontak --}}
            <div style="flex: 1 1 0; overflow-y: auto;">
                @php
                    $contacts = [
                        ['name' => 'Putra', 'sub' => 'Build Website POS', 'time' => '10.30', 'active' => true],
                        ['name' => 'Putra', 'sub' => 'Build Website POS', 'time' => '10.30', 'active' => false],
                        ['name' => 'Putra', 'sub' => 'Build Website POS', 'time' => '10.30', 'active' => false],
                        ['name' => 'Putra', 'sub' => 'Build Website POS', 'time' => '10.30', 'active' => false],
                        ['name' => 'Putra', 'sub' => 'Build Website POS', 'time' => '10.30', 'active' => false],
                        ['name' => 'Putra', 'sub' => 'Build Website POS', 'time' => '10.30', 'active' => false],
                    ];
                @endphp

                @foreach ($contacts as $contact)
                    <div class="d-flex align-items-center px-3 py-2 border-bottom contact-item {{ $contact['active'] ? 'bg-light' : '' }}"
                         style="cursor: pointer;">
                        {{-- Avatar --}}
                        <div class="rounded-circle bg-secondary mr-3"
                             style="width: 44px; height: 44px; flex-shrink: 0;">
                        </div>
                        {{-- Info --}}
                        <div style="flex: 1 1 0; min-width: 0; overflow: hidden;">
                            <div class="font-weight-bold text-truncate">{{ $contact['name'] }}</div>
                            <small class="text-muted text-truncate d-block">{{ $contact['sub'] }}</small>
                        </div>
                        {{-- Waktu --}}
                        <small class="text-muted ml-2" style="flex-shrink: 0;">{{ $contact['time'] }}</small>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ========== PANEL CHAT KANAN ========== --}}
        <div class="col-md-8 col-lg-9 p-0 bg-white d-flex flex-column">

            {{-- Header Chat --}}
            <div class="d-flex align-items-center px-4 py-3 border-bottom">
                <div class="rounded-circle bg-secondary mr-3"
                     style="width: 44px; height: 44px; flex-shrink: 0;">
                </div>
                <div>
                    <div class="font-weight-bold">Putra</div>
                    <small class="text-muted">Build Website POS</small>
                </div>
            </div>

            {{-- Area Chat (scrollable) --}}
            <div id="chatArea" class="px-4 py-3" style="flex: 1 1 0; overflow-y: auto; background-color: #f8f8f8;">

                {{-- Pesan dari KITA (kanan) --}}
                <div class="d-flex justify-content-end mb-3">
                    <div class="border px-3 py-2 chat-bubble-right"
                         style="max-width: 60%; border-radius: 8px;">
                        Silakan Meeting hari Senin jam 10.00
                    </div>
                </div>

                {{-- Pesan dari LAWAN (kiri) --}}
                <div class="d-flex align-items-start mb-3">
                    <div class="rounded-circle bg-secondary mr-2"
                         style="width: 36px; height: 36px; flex-shrink: 0;">
                    </div>
                    <div class="border px-3 py-2 chat-bubble-left"
                         style="max-width: 60%; border-radius: 8px;">
                        Baik pak, siap
                    </div>
                </div>

                {{-- Pesan dari KITA (kanan) --}}
                <div class="d-flex justify-content-end mb-3">
                    <div class="border px-3 py-2 chat-bubble-right"
                         style="max-width: 60%; border-radius: 8px;">
                        Jangan lupa bawa requirement
                    </div>
                </div>

                {{-- Pesan dari LAWAN (kiri) --}}
                <div class="d-flex align-items-start mb-3">
                    <div class="rounded-circle bg-secondary mr-2"
                         style="width: 36px; height: 36px; flex-shrink: 0;">
                    </div>
                    <div class="border px-3 py-2 chat-bubble-left"
                         style="max-width: 60%; border-radius: 8px;">
                        Baik, saya bawa kak
                    </div>
                </div>

            </div>

            {{-- Input Pesan --}}
            <div class="d-flex align-items-center px-4 py-3 border-top">
                <input
                    type="text"
                    id="messageInput"
                    class="form-control mr-2"
                    placeholder="Tulis Pesan ..."
                    style="border-radius: 4px;"
                >
                <button
                    class="btn btn-amber px-4"
                    onclick="sendMessage()"
                    style="flex-shrink: 0; border-radius: 4px; white-space: nowrap;">
                    Kirim
                </button>
            </div>
        </div>

    </div>
</div>

{{-- ========== CSS ========== --}}
<style>
    .btn-amber {
        background-color: #FF8C00;
        color: white;
        font-weight: 500;
    }
    .btn-amber:hover {
        background-color: #e07b00;
        color: white;
    }
    .contact-item:hover {
        background-color: #f8f9fa;
    }
    .chat-bubble-right {
        background-color: #ffffff;
    }
    .chat-bubble-left {
        background-color: #ffffff;
    }
</style>

{{-- ========== JS: Kirim Pesan --}}
<script>
    function sendMessage() {
        const input = document.getElementById('messageInput');
        const chatArea = document.getElementById('chatArea');
        const text = input.value.trim();

        if (!text) return;

        const bubble = document.createElement('div');
        bubble.className = 'd-flex justify-content-end mb-3';
        bubble.innerHTML = `
            <div class="border px-3 py-2 chat-bubble-right"
                 style="max-width: 60%; border-radius: 8px; background: #fff;">
                ${text}
            </div>`;
        chatArea.appendChild(bubble);
        chatArea.scrollTop = chatArea.scrollHeight;
        input.value = '';
    }

    document.getElementById('messageInput').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') sendMessage();
    });
</script>
@endsection