@extends('layouts.admin')

@push('styles')
<style>
    .chat-wrapper {
        height: calc(100vh - 140px);
        display: flex;
        overflow: hidden;
        border: 1px solid #e3e6f0;
        border-radius: 8px;
    }

    .avatar-circle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background-color: #858796;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 16px;
        flex-shrink: 0;
    }

    .avatar-mini {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background-color: #858796;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 12px;
        flex-shrink: 0;
    }

    .contact-item {
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
    }

    .contact-item:hover {
        background-color: #f8f9fa;
        color: inherit;
        text-decoration: none;
    }

    .active-contact {
        background-color: #f0f0f0;
    }

    .chat-left {
        background: #ffffff;
        border: 1px solid #e3e6f0;
        border-radius: 0 12px 12px 12px;
        padding: 10px 14px;
        max-width: 60%;
        font-size: 14px;
    }

    .chat-right {
        background: #ffffff;
        border: 1px solid #e3e6f0;
        border-radius: 12px 0 12px 12px;
        padding: 10px 14px;
        max-width: 60%;
        font-size: 14px;
    }

    .chat-time {
        font-size: 10px;
        color: #aaa;
        margin-top: 4px;
    }
</style>
@endpush

@section('content')
<div id="content">
<div class="container-fluid">

    <div class="chat-wrapper">

        {{-- ========== SIDEBAR KIRI ========== --}}
        <div class="bg-white border-right d-flex flex-column"
             style="width: 320px; flex-shrink: 0;">

            {{-- Header --}}
            <div class="p-3 border-bottom">
                <h5 class="font-weight-bold mb-3">Messages</h5>
                <input type="text" class="form-control" placeholder="Cari pesan...">
            </div>

            {{-- Contact List --}}
            <div style="overflow-y: auto; flex: 1;">
                @forelse ($meetings ?? [] as $meeting)
                    <a href="{{ route('admin.messages', ['meeting' => $meeting['id']]) }}"
                       class="contact-item px-3 py-3 border-bottom
                              {{ isset($activeMeeting) && $activeMeeting['id'] == $meeting['id'] ? 'active-contact' : '' }}">
                        <div class="avatar-circle mr-3">
                            {{ strtoupper(substr($meeting['user']['name'] ?? 'U', 0, 1)) }}
                        </div>
                        <div style="flex: 1; min-width: 0;">
                            <div class="font-weight-bold text-truncate">{{ $meeting['user']['name'] ?? '-' }}</div>
                            <small class="text-muted text-truncate d-block">{{ $meeting['title'] ?? '-' }}</small>
                        </div>
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
        <div class="d-flex flex-column bg-light" style="flex: 1; min-width: 0;">

            @if (isset($activeMeeting) && $activeMeeting)

                {{-- Chat Header --}}
                <div class="bg-white border-bottom px-4 py-3 d-flex align-items-center">
                    <div class="avatar-circle mr-3">
                        {{ strtoupper(substr($activeMeeting['user']['name'] ?? 'U', 0, 1)) }}
                    </div>
                    <div>
                        <div class="font-weight-bold">{{ $activeMeeting['user']['name'] ?? '-' }}</div>
                        <small class="text-muted">{{ $activeMeeting['title'] ?? '-' }}</small>
                    </div>
                </div>

                {{-- Chat Content --}}
                <div id="chatArea" class="px-4 py-4" style="overflow-y: auto; flex: 1;">
                    @forelse ($messages ?? [] as $msg)
                        @php
                            $isMe = $msg['sender']['role'] === 'admin';
                        @endphp

                        @if ($isMe)
                            <div class="d-flex justify-content-end mb-4">
                                <div class="chat-right">
                                    {{ $msg['message'] }}
                                    <div class="chat-time text-right">{{ $msg['time'] }}</div>
                                </div>
                            </div>
                        @else
                            <div class="d-flex mb-4">
                                <div class="avatar-mini mr-2">
                                    {{ strtoupper(substr($msg['sender']['name'] ?? 'U', 0, 1)) }}
                                </div>
                                <div class="chat-left">
                                    {{ $msg['message'] }}
                                    <div class="chat-time">{{ $msg['time'] }}</div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center text-muted mt-5">
                            <i class="fas fa-comments fa-3x mb-3"></i>
                            <p>Belum ada pesan. Mulai percakapan!</p>
                        </div>
                    @endforelse
                </div>

                {{-- Input --}}
                <div class="bg-white border-top p-3">
                    <form method="POST"
                          action="{{ route('admin.messages.store', $activeMeeting['id']) }}"
                          class="d-flex">
                        @csrf
                        <input type="text"
                               name="message"
                               id="messageInput"
                               class="form-control mr-2"
                               placeholder="Tulis pesan..."
                               autocomplete="off">
                        <button type="submit" class="btn btn-amber px-4">Kirim</button>
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

</div>
</div>
@endsection

@push('scripts')
<script>
    const chatArea = document.getElementById('chatArea');
    if (chatArea) chatArea.scrollTop = chatArea.scrollHeight;

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