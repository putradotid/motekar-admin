@extends('layouts.admin')

@section('content')
<div id="content">
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Detail Meeting Request</h1>
            <small class="text-muted">ID #{{ $meeting['id'] }}</small>
        </div>
        <a href="{{ route('admin.meetings') }}" class="btn btn-sm btn-light">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">

        {{-- detail meeting --}}
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="font-weight-bold m-0">Informasi Meeting</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-muted" style="width: 180px;">Nama Pemohon</td>
                            <td>: <strong>{{ $meeting['user']['name'] ?? '-' }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td>: {{ $meeting['user']['email'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Topik / Subject</td>
                            <td>: {{ $meeting['title'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal Meeting</td>
                            <td>:
                                @php
                                    [$date, $time] = explode(' ', ($meeting['date'] ?? '- -') . ' ');
                                    $shortTime = substr($time ?? '', 0, 5) ?: '-';
                                @endphp
                                {{ $date }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Jam Meeting</td>
                            <td>: {{ $shortTime }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status</td>
                            <td>:
                                @php
                                    $badgeMap = [
                                        'pending'  => 'warning',
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        'done'     => 'secondary',
                                    ];
                                    $badge = $badgeMap[$meeting['status'] ?? 'pending'] ?? 'info';
                                @endphp
                                <span class="badge badge-{{ $badge }}">
                                    {{ ucfirst($meeting['status'] ?? '-') }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal Request</td>
                            <td>: {{ isset($meeting['created_at']) ? substr(str_replace('T', ' ', $meeting['created_at']), 0, 19) : '-' }}</td>
                        </tr>
                    </table>

                    {{-- Deskripsi --}}
                    <div class="mt-3">
                        <p class="text-muted font-weight-bold mb-1">Pesan / Deskripsi:</p>
                        <div class="p-3 bg-light rounded">
                            {{ $meeting['description'] ?? 'Tidak ada pesan tambahan.' }}
                        </div>
                    </div>

                    {{-- Lampiran --}}
                    @if (!empty($meeting['attachment']))
                        <div class="mt-3">
                            <p class="text-muted font-weight-bold mb-1">Lampiran:</p>
                            @php
                                $ext = pathinfo($meeting['attachment'], PATHINFO_EXTENSION);
                                $url = rtrim(env('API_BASE_URL', 'http://127.0.0.1:8000'), '/') . '/storage/' . $meeting['attachment'];
                            @endphp

                            @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                                {{-- Tampilkan gambar --}}
                                <a href="{{ $url }}" target="_blank">
                                    <img src="{{ $url }}"
                                        alt="Lampiran"
                                        class="img-fluid rounded"
                                        style="max-height: 300px;">
                                </a>
                            @elseif (strtolower($ext) === 'pdf')
                                {{-- Tampilkan link PDF --}}
                                <a href="{{ $url }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-file-pdf mr-1"></i> Lihat PDF
                                </a>
                            @endif
                        </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- Aksi --}}
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="font-weight-bold m-0">Aksi</h6>
                </div>
                <div class="card-body">

                    {{-- Approve --}}
                    @if ($meeting['status'] == 'pending')
                        <form method="POST"
                              action="{{ route('admin.meetings.approved', $meeting['id']) }}"
                              class="mb-2">
                            @csrf
                            <button class="btn btn-success btn-block">
                                <i class="fas fa-check mr-1"></i> Approve
                            </button>
                        </form>
                    @endif

                    {{-- Done --}}
                    @if ($meeting['status'] == 'approved')
                        <form method="POST"
                              action="{{ route('admin.meetings.done', $meeting['id']) }}"
                              class="mb-2">
                            @csrf
                            <button class="btn btn-primary btn-block">
                                <i class="fas fa-flag mr-1"></i> Mark as Done
                            </button>
                        </form>
                    @endif

                    {{-- Reject --}}
                    @if (!in_array($meeting['status'], ['rejected', 'done']))
                        <form method="POST"
                              action="{{ route('admin.meetings.reject', $meeting['id']) }}">
                            @csrf
                            <button class="btn btn-danger btn-block">
                                <i class="fas fa-times mr-1"></i> Reject
                            </button>
                        </form>
                    @endif

                    {{-- Sudah final --}}
                    @if (in_array($meeting['status'], ['rejected', 'done']))
                        <div class="text-center text-muted">
                            <i class="fas fa-lock fa-2x mb-2"></i>
                            <p class="small">Meeting ini sudah final dan tidak dapat diubah.</p>
                        </div>
                    @endif

                </div>
            </div>

            {{-- Info User --}}
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="font-weight-bold m-0">Info Pemohon</h6>
                </div>
                <div class="card-body text-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2 text-white"
                         style="width:60px;height:60px;background:#FF8C00;font-size:20px;">
                        {{ strtoupper(substr($meeting['user']['name'] ?? 'U', 0, 1)) }}
                    </div>
                    <p class="font-weight-bold mb-1">{{ $meeting['user']['name'] ?? '-' }}</p>
                    <p class="text-muted small mb-0">{{ $meeting['user']['email'] ?? '-' }}</p>
                </div>
            </div>

        </div>
    </div>

</div>
</div>
@endsection