@extends('layouts.admin')

@section('content')
<div id="content">
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-3">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card shadow py-2">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center">
                        <div class="rounded p-2 mr-3" style="background-color:#EEF2FF;">
                            <i class="fas fa-calendar-alt fa-lg" style="color:#6366F1;"></i>
                        </div>
                        <div>
                            <div class="text-xs font-weight-bold text-muted text-uppercase mb-1">Total Meeting</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card shadow py-2">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center">
                        <div class="rounded p-2 mr-3" style="background-color:#FFF7ED;">
                            <i class="fas fa-clock fa-lg" style="color:#F97316;"></i>
                        </div>
                        <div>
                            <div class="text-xs font-weight-bold text-muted text-uppercase mb-1">Pending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card shadow py-2">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center">
                        <div class="rounded p-2 mr-3" style="background-color:#F0FDF4;">
                            <i class="fas fa-check-circle fa-lg" style="color:#22C55E;"></i>
                        </div>
                        <div>
                            <div class="text-xs font-weight-bold text-muted text-uppercase mb-1">Approved</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['approved'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card shadow py-2">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center">
                        <div class="rounded p-2 mr-3" style="background-color:#F5F3FF;">
                            <i class="fas fa-flag fa-lg" style="color:#8B5CF6;"></i>
                        </div>
                        <div>
                            <div class="text-xs font-weight-bold text-muted text-uppercase mb-1">Done</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['done'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Meeting + Stats Users & view -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="font-weight-bold m-0">Recent Meeting Requests</h6>
                        <a href="{{ route('admin.meetings') }}" class="btn btn-primary btn-sm px-3">View All</a>
                    </div>

                    <table class="table table-borderless mb-0" style="font-size: 13px;">
                        <thead class="border-bottom">
                            <tr>
                                <th class="py-2">Name</th>
                                <th class="py-2">Email</th>
                                <th class="py-2">Date</th>
                                <th class="py-2">Time</th>
                                <th class="py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recent ?? [] as $item)
                                @php
                                    [$date, $time] = explode(' ', ($item['date'] ?? '- -') . ' ');
                                    $shortTime = substr($time ?? '', 0, 5) ?: '-';
                                    $name      = $item['user']['name'] ?? '-';
                                    $initials  = strtoupper(substr($name, 0, 1) . (strpos($name, ' ') !== false ? substr($name, strpos($name, ' ') + 1, 1) : ''));
                                    $colors    = ['#6366F1','#22C55E','#F97316','#858796','#E74A3B','#3B82F6','#8B5CF6'];
                                    $color     = $colors[$loop->index % count($colors)];
                                    $badgeMap  = [
                                        'pending'  => 'warning',
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        'done'     => 'secondary',
                                    ];
                                    $badge = $badgeMap[$item['status']] ?? 'info';
                                @endphp
                                <tr class="{{ !$loop->last ? 'border-bottom' : '' }}">
                                    <td class="py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center mr-2 text-white"
                                                style="width:30px;height:30px;background:{{ $color }};font-size:11px;flex-shrink:0;">
                                                {{ $initials }}
                                            </div>
                                            {{ $name }}
                                        </div>
                                    </td>
                                    <td class="py-2">{{ $item['user']['email'] ?? '-' }}</td>
                                    <td class="py-2">{{ $date }}</td>
                                    <td class="py-2">{{ $shortTime }}</td>
                                    <td class="py-2">
                                        <span class="badge badge-{{ $badge }} text-white">
                                            {{ ucfirst($item['status'] ?? '-') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">Belum ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="text-center mt-2">
                        <small class="text-muted">Menampilkan {{ count($recent ?? []) }} request terbaru</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Users & View -->
        <div class="col-lg-4">
            <div class="card shadow h-100">
                <div class="card-body py-3">
                    <h6 class="font-weight-bold mb-2">Stats Users & View</h6>

                    {{-- Info singkat --}}
                    <div class="d-flex justify-content-between mb-1">
                        <small class="text-muted">Meetings Today</small>
                        <small class="font-weight-bold">
                            {{ $meetingsToday ?? 0 }}
                        </small>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <small class="text-muted">Total Meeting</small>
                        <small class="font-weight-bold">{{ $stats['total'] ?? 0 }}</small>
                    </div>

                    {{-- Chart --}}
                    <div style="position: relative; height: 150px;">
                        <canvas id="meetingChart"></canvas>
                    </div>

                    {{-- Stats User --}}
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="card border p-2 text-center">
                                <a href="{{ route('admin.manage.user') }}" class="text-decoration-none">
                                    <div class="rounded-circle mx-auto mb-1 d-flex align-items-center justify-content-center"
                                        style="width:40px;height:40px;background:#EEF2FF;">
                                        <i class="fas fa-user" style="color:#6366F1;"></i>
                                    </div>
                                    <small class="text-muted">Total User</small>
                                    <div class="h6 font-weight-bold mb-0 text-dark">
                                        {{ $users['total'] ?? 0 }}
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card border p-2 text-center">
                                <a href="{{ route('admin.manage.admin') }}" class="text-decoration-none">
                                    <div class="rounded-circle mx-auto mb-1 d-flex align-items-center justify-content-center"
                                        style="width:40px;height:40px;background:#F5F3FF;">
                                        <i class="fas fa-shield-alt" style="color:#8B5CF6;"></i>
                                    </div>
                                    <small class="text-muted">Total Admin</small>
                                    <div class="h6 font-weight-bold mb-0 text-dark">
                                        {{ $admins['total'] ?? 0 }}
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
</div>
@endsection

@push('scripts')
<script>

// mengambil data
const monthlyData = @json($monthly ?? []);

// merubah format bulan
const bulanNama = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
const labels = monthlyData.map(function(item) {
    return bulanNama[item.month - 1];
});

const values = monthlyData.map(function(item) {
    return item.total;
});

const ctx = document.getElementById("meetingChart");

const meetingChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels.length > 0 ? labels : ["Oct", "Nov", "Dec", "Jan", "Feb", "Mar"],
        datasets: [{
            label: "Meetings",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.08)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 4,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 4,
            pointBorderWidth: 2,

            data: values.length > 0 ? values : [3, 7, 12, 8, 15, 20],
        }],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: { left: 5, right: 5, top: 5, bottom: 0 }
        },
        scales: {
            xAxes: [{
                gridLines: { display: false, drawBorder: false },
                ticks: { fontSize: 10 }
            }],
            yAxes: [{
                ticks: {
                    maxTicksLimit: 4,
                    padding: 5,
                    fontSize: 10,
                    callback: function(value) { return value; }
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                }
            }],
        },
        legend: { display: false },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleFontColor: '#6e707e',
            borderColor: '#dddfeb',
            borderWidth: 1,
            displayColors: false,
            intersect: false,
            mode: 'index',
            callbacks: {
                label: function(tooltipItem) {
                    return 'Meetings: ' + tooltipItem.yLabel;
                }
            }
        }
    }
});
</script>
@endpush