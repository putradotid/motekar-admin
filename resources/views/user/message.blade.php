@extends('layouts.user')

@push('styles')
<style>
    .contact-item:hover    { background-color: #f8f9fa; }
    .contact-item.active   { background-color: #f0f0f0; }
    .chat-bubble-right     { background-color: #ffffff; }
    .chat-bubble-left      { background-color: #ffffff; }
</style>
@endpush

@section('content')
<div style="position: fixed;
    top: 56px;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    overflow: hidden;
    ">

    {{-- ========== SIDEBAR KIRI ========== --}}
    <div class="border-right bg-white p-0 d-flex flex-column" style="width: 300px; flex-shrink: 0;">

        <div class="p-3 border-bottom">
            <h5 class="font-weight-bold my-2">Messages</h5>
            <input type="text" class="form-control" placeholder="Cari Pesan" style="border-radius: 4px;">
        </div>

        <div style="flex: 1 1 0; overflow-y: auto;">
            @forelse ($meetings ?? [] as $meeting)
                <a href="{{ route('user-message', ['meeting' => $meeting['id']]) }}"
                   class="d-flex align-items-center px-3 py-2 border-bottom contact-item text-decoration-none text-dark
                          {{ isset($activeMeeting) && $activeMeeting['id'] == $meeting['id'] ? 'active' : '' }}">
                    {{-- Avatar --}}
                    <div class="rounded-circle bg-secondary mr-3 d-flex align-items-center justify-content-center text-white"
                         style="width: 44px; height: 44px; flex-shrink: 0; font-size: 14px;">
                        {{ strtoupper(substr($meeting['user']['name'] ?? 'U', 0, 1)) }}
                    </div>
                    {{-- Info --}}
                    <div style="flex: 1 1 0; min-width: 0; overflow: hidden;">
                        <div class="font-weight-bold text-truncate">{{ $meeting['user']['name'] ?? '-' }}</div>
                        <small class="text-muted text-truncate d-block">{{ $meeting['title'] ?? '-' }}</small>
                    </div>
                    {{-- Waktu --}}
                    <small class="text-muted ml-2" style="flex-shrink: 0;">{{ $meeting['last_time'] ?? '' }}</small>
                </a>
            @empty
                <div class="p-3 text-center text-muted">
                    <small>Belum ada chat tersedia.</small>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ========== PANEL CHAT KANAN ========== --}}
    <div class="bg-white d-flex flex-column" style="flex: 1 1 0; min-width: 0;">

        @if ($activeMeeting)

            {{-- Header Chat --}}
            <div class="d-flex align-items-center px-4 py-3 mt-2 border-bottom">
                <div class="rounded-circle bg-secondary mr-3 d-flex align-items-center justify-content-center text-white"
                     style="width: 44px; height: 44px; flex-shrink: 0; font-size: 16px;">
                    {{ strtoupper(substr($activeMeeting['user']['name'] ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <div class="font-weight-bold">{{ $activeMeeting['user']['name'] ?? '-' }}</div>
                    <small class="text-muted">{{ $activeMeeting['title'] ?? '-' }}</small>
                </div>
            </div>

            {{-- Area Chat --}}
            <div id="chatArea" class="px-4 py-3" style="flex: 1 1 0; overflow-y: auto; background-color: #f8f8f8;">

                @forelse ($messages as $msg)
                    @php
                        $isMe = $msg['sender']['id'] == session('user.id');
                    @endphp

                    @if ($isMe)
                        {{-- Pesan dari KITA (kanan) --}}
                        <div class="d-flex justify-content-end mb-3">
                            <div class="border px-3 py-2 chat-bubble-right"
                                 style="max-width: 60%; border-radius: 8px;">
                                {{ $msg['message'] }}
                                <div class="text-right mt-1">
                                    <small class="text-muted" style="font-size: 10px;">{{ $msg['time'] }}</small>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Pesan dari LAWAN (kiri) --}}
                        <div class="d-flex align-items-start mb-3">
                            <div class="rounded-circle bg-secondary mr-2 d-flex align-items-center justify-content-center text-white"
                                 style="width: 36px; height: 36px; flex-shrink: 0; font-size: 12px;">
                                {{ strtoupper(substr($msg['sender']['name'] ?? 'U', 0, 1)) }}
                            </div>
                            <div class="border px-3 py-2 chat-bubble-left"
                                 style="max-width: 60%; border-radius: 8px;">
                                {{ $msg['message'] }}
                                <div class="mt-1">
                                    <small class="text-muted" style="font-size: 10px;">{{ $msg['time'] }}</small>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="d-flex justify-content-center align-items-center h-100 text-center text-muted">
                        <div>
                            <i class="fas fa-comments fa-3x mb-3 d-block"></i>
                            <p>Belum ada pesan. Mulai percakapan!</p>
                        </div>
                    </div>
                @endforelse

            </div>

            {{-- Input Pesan --}}
            <div class="border-top px-4 py-3">
                <form method="POST"
                      action="{{ route('user-message.store', $activeMeeting['id']) }}"
                      class="d-flex">
                    @csrf
                    <input type="text"
                           name="message"
                           id="messageInput"
                           class="form-control mr-2"
                           placeholder="Tulis Pesan ..."
                           autocomplete="off"
                           style="border-radius: 4px;">
                    <button type="submit"
                            class="btn btn-amber px-4"
                            style="flex-shrink: 0; border-radius: 4px; white-space: nowrap;">
                        Kirim
                    </button>
                </form>
            </div>

        @else
            {{-- Belum pilih meeting --}}
            <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                <div class="text-center">
                    <i class="fas fa-comments fa-4x mb-3"></i>
                    <p>Pilih percakapan untuk memulai chat</p>
                </div>
            </div>
        @endif

    </div>

</div>
@endsection

@push('scripts')
<script>
    // Auto scroll ke bawah saat halaman load
    const chatArea = document.getElementById('chatArea');
    if (chatArea) {
        chatArea.scrollTop = chatArea.scrollHeight;
    }

    // Kirim pesan dengan Enter
    const input = document.getElementById('messageInput');
    if (input) {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.closest('form').submit();
            }
        });
    }
</script>
@endpush