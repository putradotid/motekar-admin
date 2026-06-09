@extends('layouts.admin')

@section('content')
<div id="content">
<div class="container-fluid">

    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Contact Messages</h1>
        <p class="text-muted small">Pesan masuk dari form kontak website publik.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">

            <!-- Filter -->
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex" style="gap: 8px;">
                    @foreach ([''=>'Semua', 'unread'=>'Unread', 'read'=>'Read', 'replied'=>'Replied'] as $key => $label)
                        <a href="{{ route('admin.contacts', ['status' => $key, 'search' => $search]) }}"
                           class="btn btn-sm {{ $status == $key ? 'btn-amber' : 'btn-light' }} rounded-pill">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
                <form method="GET" action="{{ route('admin.contacts') }}" class="d-flex" style="gap: 8px;">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <input type="text" name="search" class="form-control form-control-sm"
                           placeholder="Search..." value="{{ $search }}">
                    <button class="btn btn-sm btn-primary">Cari</button>
                </form>
            </div>

            <!-- Jumlah -->
            <small class="text-muted d-block mb-2">{{ $contacts['total'] ?? 0 }} pesan</small>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead class="border-bottom">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts['data'] ?? [] as $contact)
                            <tr class="border-bottom {{ $contact['status'] == 'unread' ? 'font-weight-bold' : '' }}">
                                <td>{{ $contact['name'] }}</td>
                                <td>{{ $contact['email'] }}</td>
                                <td>{{ $contact['subject'] }}</td>
                                <td>
                                    @php
                                        $badgeMap = [
                                            'unread'  => 'danger',
                                            'read'    => 'warning',
                                            'replied' => 'success',
                                        ];
                                    @endphp
                                    <span class="badge badge-{{ $badgeMap[$contact['status']] ?? 'secondary' }}">
                                        {{ ucfirst($contact['status']) }}
                                    </span>
                                </td>
                                <td class="small text-muted">
                                    {{ substr($contact['created_at'], 0, 10) }}
                                </td>
                                <td>
                                    <div class="d-flex" style="gap: 4px;">
                                        <a href="{{ route('admin.contacts.show', $contact['id']) }}"
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form method="POST"
                                              action="{{ route('admin.contacts.destroy', $contact['id']) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Hapus pesan ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada pesan masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted">
                    Showing {{ $contacts['from'] ?? 0 }}
                    to {{ $contacts['to'] ?? 0 }}
                    of {{ $contacts['total'] ?? 0 }} pesan
                </small>
                <div>
                    <a href="?page={{ ($contacts['current_page'] ?? 1) - 1 }}&status={{ $status }}&search={{ $search }}"
                       class="btn btn-sm btn-light {{ ($contacts['current_page'] ?? 1) == 1 ? 'disabled' : '' }}">
                        &lt; Prev
                    </a>
                    @for ($i = 1; $i <= ($contacts['last_page'] ?? 1); $i++)
                        <a href="?page={{ $i }}&status={{ $status }}&search={{ $search }}"
                           class="btn btn-sm {{ $i == ($contacts['current_page'] ?? 1) ? 'btn-amber' : 'btn-light' }}">
                            {{ $i }}
                        </a>
                    @endfor
                    <a href="?page={{ ($contacts['current_page'] ?? 1) + 1 }}&status={{ $status }}&search={{ $search }}"
                       class="btn btn-sm btn-light {{ ($contacts['current_page'] ?? 1) == ($contacts['last_page'] ?? 1) ? 'disabled' : '' }}">
                        Next &gt;
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>
</div>
@endsection