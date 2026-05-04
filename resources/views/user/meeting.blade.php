@extends('layouts.user')

@section('content')
<div class="container mt-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 pt-5">
        <div>
            <h2 class="font-weight-bold">Hi, {{ session('user.name') ?? 'User' }}!</h2>
            <p class="text-muted">Anda dapat memantau status dan progres request meeting Anda di sini.</p>
        </div>
        <a href="{{ route('request-meeting') }}" class="btn btn-amber px-4">
            Tambah Meeting
        </a>
    </div>

    <!-- Alert -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border shadow-sm">
                <div class="card-body">
                    <small>Pending</small>
                    <h4>{{ collect($meetings['data'] ?? [])->where('status', 'pending')->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border shadow-sm">
                <div class="card-body">
                    <small>Approved</small>
                    <h4>{{ collect($meetings['data'] ?? [])->where('status', 'approved')->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border shadow-sm">
                <div class="card-body">
                    <small>Rejected</small>
                    <h4>{{ collect($meetings['data'] ?? [])->where('status', 'rejected')->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border shadow-sm">
                <div class="card-body">
                    <small>Completed</small>
                    <h4>{{ collect($meetings['data'] ?? [])->where('status', 'done')->count() }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Table Header + Search -->
            <div class="d-flex justify-content-between mb-3">
                <h5 class="font-weight-bold">Daftar Request Meeting</h5>
                <form method="GET" action="{{ route('user-meeting') }}" class="d-flex">
                    <input type="text" name="search" class="form-control mr-2"
                           placeholder="Search . . ." value="{{ $search }}">
                    <button class="btn btn-primary">Cari</button>
                </form>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Topik</th>
                            <th>Status</th>
                            <th>Tanggal Meeting</th>
                            <th>Jam Meeting</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($meetings['data'] ?? [] as $item)
                            @php
                                [$date, $time] = explode(' ', ($item['date'] ?? '- -') . ' ');
                                $shortTime = substr($time ?? '', 0, 5) ?: '-';
                                $createdAt = isset($item['created_at'])
                                    ? substr(str_replace('T', ' ', $item['created_at']), 0, 19)
                                    : '-';
                            @endphp
                            <tr>
                                <td>{{ $createdAt }}</td>
                                <td>{{ $item['title'] ?? '-' }}</td>
                                <td>{{ $item['status'] ?? '-' }}</td>
                                <td>{{ $date ?? '-' }}</td>
                                <td>{{ $shortTime }}</td>
                                <td>
                                    <form method="POST"
                                          action="{{ route('user-meeting.cancel', $item['id']) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between mt-3">
                <small>
                    Showing {{ $meetings['from'] ?? 0 }}
                    to {{ $meetings['to'] ?? 0 }}
                    of {{ $meetings['total'] ?? 0 }} request
                </small>
                <div>
                    <a href="?page={{ ($meetings['current_page'] ?? 1) - 1 }}&search={{ $search }}"
                       class="btn btn-sm btn-light {{ ($meetings['current_page'] ?? 1) == 1 ? 'disabled' : '' }}">
                        Prev
                    </a>

                    @for ($i = 1; $i <= ($meetings['last_page'] ?? 1); $i++)
                        <a href="?page={{ $i }}&search={{ $search }}"
                           class="btn btn-sm {{ $i == ($meetings['current_page'] ?? 1) ? 'btn-amber' : 'btn-light' }}">
                            {{ $i }}
                        </a>
                    @endfor

                    <a href="?page={{ ($meetings['current_page'] ?? 1) + 1 }}&search={{ $search }}"
                       class="btn btn-sm btn-light {{ ($meetings['current_page'] ?? 1) == ($meetings['last_page'] ?? 1) ? 'disabled' : '' }}">
                        Next
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection