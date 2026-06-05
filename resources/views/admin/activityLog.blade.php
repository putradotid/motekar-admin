@extends('layouts.admin')

@section('content')
<div id="content">
<div class="container-fluid">

    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Activity Log</h1>
        <p class="text-muted small">Riwayat aktivitas admin dalam sistem.</p>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">

            <!-- Filter Module -->
            <div class="d-flex flex-wrap mb-4" style="gap: 8px;">
                @php
                    $modules = [
                        ''        => 'Semua',
                        'meeting' => 'Meeting',
                        'user'    => 'User',
                        'website' => 'Website',
                        'media'   => 'Media',
                        'setting' => 'Setting',
                    ];
                @endphp
                @foreach ($modules as $key => $label)
                    <a href="{{ route('admin.activity-logs', ['module' => $key]) }}"
                       class="btn btn-sm {{ $module == $key ? 'btn-amber' : 'btn-light' }}
                              rounded-pill">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead class="border-bottom">
                        <tr>
                            <th>Waktu</th>
                            <th>Admin</th>
                            <th>Modul</th>
                            <th>Aksi</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs['data'] ?? [] as $log)
                            <tr class="border-bottom">
                                <td class="text-muted small">
                                    {{ isset($log['created_at'])
                                        ? substr(str_replace('T', ' ', $log['created_at']), 0, 16)
                                        : '-' }}
                                </td>
                                <td>{{ $log['user']['name'] ?? '-' }}</td>
                                <td>
                                    <span class="badge badge-light text-capitalize">
                                        {{ $log['module'] ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $actionColors = [
                                            'approve_meeting' => 'success',
                                            'reject_meeting'  => 'danger',
                                            'done_meeting'    => 'primary',
                                            'suspend_user'    => 'warning',
                                            'activate_user'   => 'success',
                                            'upload_media'    => 'info',
                                            'delete_media'    => 'danger',
                                        ];
                                        $color = $actionColors[$log['action'] ?? ''] ?? 'secondary';
                                    @endphp
                                    <span class="badge badge-{{ $color }}">
                                        {{ str_replace('_', ' ', $log['action'] ?? '-') }}
                                    </span>
                                </td>
                                <td class="small">{{ $log['description'] ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Belum ada activity log.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted">
                    Showing {{ $logs['from'] ?? 0 }}
                    to {{ $logs['to'] ?? 0 }}
                    of {{ $logs['total'] ?? 0 }} logs
                </small>
                <div>
                    <a href="?page={{ ($logs['current_page'] ?? 1) - 1 }}&module={{ $module }}"
                       class="btn btn-sm btn-light {{ ($logs['current_page'] ?? 1) == 1 ? 'disabled' : '' }}">
                        &lt; Prev
                    </a>
                    @for ($i = 1; $i <= ($logs['last_page'] ?? 1); $i++)
                        <a href="?page={{ $i }}&module={{ $module }}"
                           class="btn btn-sm {{ $i == ($logs['current_page'] ?? 1) ? 'btn-amber' : 'btn-light' }}">
                            {{ $i }}
                        </a>
                    @endfor
                    <a href="?page={{ ($logs['current_page'] ?? 1) + 1 }}&module={{ $module }}"
                       class="btn btn-sm btn-light {{ ($logs['current_page'] ?? 1) == ($logs['last_page'] ?? 1) ? 'disabled' : '' }}">
                        Next &gt;
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>
</div>
@endsection