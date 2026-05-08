@extends('layouts.admin')

@section('content')
<div id="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="">
            <h1 class="h3 mb-0 text-gray-800">Meeting Requests</h1>
            <p class="">Manage and track all meeting requests submitted by user</p>
        </div>

        {{-- allert --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <!-- tabel -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">

                    <!-- Tab Bar -->
                    <div class="card-header py-2 d-flex align-items-center justify-content-between flex-wrap" style="gap: 8px;">
                        <div class="d-flex flex-wrap" style="gap: 4px;">
                            <a href="?tab=all"
                               class="btn btn-sm {{ ($tab ?? 'all') == 'all' ? 'btn-primary' : 'btn-light' }}">
                                All ({{ $stats['total'] ?? 0 }})
                            </a>
                            <a href="?tab=pending"
                                class="btn btn-sm {{ ($tab ?? '') == 'pending' ? 'btn-primary' : 'btn-light' }}">
                                Pending ({{ $stats['pending'] ?? 0 }})
                            </a>
                            <a href="?tab=approved" 
                                class="btn btn-sm {{ ($tab ?? '') == 'approved' ? 'btn-success' : 'btn-light' }}">
                                Approved ({{ $stats['approved'] ?? 0 }})
                            </a>
                            <a href="?tab=rejected" 
                                class="btn btn-sm {{ ($tab ?? '') == 'rejected' ? 'btn-danger' : 'btn-light' }}">
                                Rescheduled ({{ $stats['rejected'] ?? 0 }})
                            </a>
                            <a href="?tab=done" 
                                class="btn btn-sm {{ ($tab ?? '') == 'done' ? 'btn-primary' : 'btn-light' }} ">
                                Complete ({{ $stats['done'] ?? 0 }})
                            </a>
                        </div>
                        <a href="#" class="btn btn-sm btn-light">
                            <i class="fas fa-calendar-alt mr-1"></i> Calendar View
                        </a>
                    </div>

                    <div class="card-body">

                        <!-- Filter -->
                        <form method="GET" action="{{ route('admin.meetings') }}" 
                            class="d-flex align-items-center mb-3" style="gap: 8px;">
                            <input type="hidden" name="tab" value="{{ $tab ?? 'all' }}">
                            <span class="font-weight-bold mr-1">Status:</span>
                            <select name="status" class="form-control" style="width: 150px;">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="done" {{ $status == 'done' ? 'selected' : '' }}>Complete</option>
                            </select>
                            <input type="date" name="date" class="form-control" style="width: 180px; " value="{{ request('date') }}">
                            <input type="text" name="search" class="form-control" placeholder="Search . . ." value="{{ $search }}">
                            <button type="submit" class="btn btn-primary px-4">Filter</button>
                        </form>

                        <!-- Jumlah data -->
                        <small class="text-muted d-block mb-2">{{ $meetings['total'] ?? 0 }} items</small>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="border-bottom">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($meetings['data'] ?? [] as $item)
                                        @php
                                            [$date, $time] = explode(' ', ($item['date'] ?? '- -') . ' ');
                                            $shortTime = substr($time ?? '', 0, 5) ?: '-';
                                        @endphp
                                        <tr class="border-bottom">
                                            <td>{{ $item['user']['name'] ?? '-' }}</td>
                                            <td>{{ $item['user']['email'] ?? '-' }}</td>
                                            <td>{{ $date ?? '-' }}</td>
                                            <td>{{ $shortTime }}</td>
                                            <td>{{ ucfirst($item['status'] ?? '-') }}</td>
                                            <td>
                                                <div class="d-flex" style="gap: 4px;">

                                                    {{-- Approved --}}
                                                    @if ($item['status'] == 'pending')
                                                        <form method="POST" 
                                                            action="{{ route('admin.meetings.approve', $item['id']) }}">
                                                            @csrf
                                                            <button class="btn btn-sm btn-success">Approve</button>
                                                        </form>
                                                    @endif
                                                    
                                                    {{-- Done --}}
                                                    @if ($item['status'] == 'approved')
                                                        <form method="POST" 
                                                            action="{{ route('admin.meetings.done', $item['id']) }}">
                                                            @csrf
                                                            <button class="btn btn-sm btn-success">Complete</button>
                                                        </form>
                                                    @endif

                                                    {{-- Reject --}}
                                                    @if (!in_array($item['status'], ['rejected', 'done']))
                                                        <form method="POST"
                                                            action="{{ route('admin.meetings.reject', $item['id']) }}">
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger">Cancel</button>
                                                        </form>
                                                    @endif

                                                    {{-- Sudah selesai/ditolak --}}
                                                    @if (in_array($item['status'], ['rejected', 'done']))
                                                        <span class="text-muted">-</span>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
                                    
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                Tidak ada data.
                                            </td>
                                        </tr>
                                        
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small>
                                Showing {{ $meetings['from'] ?? 0 }} 
                                to {{ $meetings['to'] ?? 0 }} 
                                of {{ $meetings['total'] ?? 0 }} request
                            </small>
                            <div>
                                <a href="?page={{ ($meetings['current_page'] ?? 1) - 1 }}&tab={{ $tab }}&search={{ $search }}&status={{ $status }}" 
                                    class="btn btn-sm btn-light {{ ($meetings['current_page'] ?? 1) == 1 ? 'disabled' : '' }}">
                                        &lt; Prev
                                </a>
                                @for ($i = 1; $i <= ($meetings['last_page'] ?? 1); $i++)
                                    <a href="?page={{ $i }}
                                        &tab={{ $tab }}
                                        &search={{ $search }}
                                        &status={{ $status }}"
                                       class="btn btn-sm {{ $i == ($meetings['current_page'] ?? 1) ? 'btn-primary' : 'btn-light' }}">
                                        {{ $i }}
                                    </a>
                                @endfor
                                
                                <a href="?page={{ ($meetings['current_page'] ?? 1) + 1 }}&tab={{ $tab }}&search={{ $search }}&status={{ $status }}" 
                                    class="btn btn-sm btn-light {{ ($meetings['current_page'] ?? 1) == ($meetings['last_page'] ?? 1) ? 'disabled' : '' }}">
                                        Next &gt;
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection