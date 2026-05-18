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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">128</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">24</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">68</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">36</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Meeting + Stats Users -->
    <div class="row">

        <!-- Recent Meeting Requests -->
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="font-weight-bold m-0">Recent Meeting Requests</h6>
                        <a href="{{ route('admin.meetings') }}" class="btn btn-primary btn-sm px-3">→ View All</a>
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
                            <tr class="border-bottom">
                                <td class="py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-2 text-white"
                                             style="width:30px;height:30px;background:#6366F1;font-size:11px;flex-shrink:0;">JD</div>
                                        John Doe
                                    </div>
                                </td>
                                <td class="py-2">john.doe@gmail.com</td>
                                <td class="py-2">Mar 17</td>
                                <td class="py-2">10:00 AM</td>
                                <td class="py-2"><span class="badge badge-warning text-white">Pending</span></td>
                            </tr>
                            <tr class="border-bottom">
                                <td class="py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-2 text-white"
                                             style="width:30px;height:30px;background:#22C55E;font-size:11px;flex-shrink:0;">SL</div>
                                        Sarah Lee
                                    </div>
                                </td>
                                <td class="py-2">sarah.lee@gmail.com</td>
                                <td class="py-2">Mar 23</td>
                                <td class="py-2">2:30 PM</td>
                                <td class="py-2"><span class="badge badge-success">Approved</span></td>
                            </tr>
                            <tr class="border-bottom">
                                <td class="py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-2 text-white"
                                             style="width:30px;height:30px;background:#F97316;font-size:11px;flex-shrink:0;">AS</div>
                                        Adam Smith
                                    </div>
                                </td>
                                <td class="py-2">adam.smith@gmail.com</td>
                                <td class="py-2">Mar 18</td>
                                <td class="py-2">11:15 AM</td>
                                <td class="py-2"><span class="badge badge-info">Rescheduled</span></td>
                            </tr>
                            <tr class="border-bottom">
                                <td class="py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-2 text-white"
                                             style="width:30px;height:30px;background:#858796;font-size:11px;flex-shrink:0;">SA</div>
                                        Siti Ahmad
                                    </div>
                                </td>
                                <td class="py-2">siti.ahmad@gmail.com</td>
                                <td class="py-2">Mar 13</td>
                                <td class="py-2">3:00 PM</td>
                                <td class="py-2"><span class="badge badge-secondary">Completed</span></td>
                            </tr>
                            <tr>
                                <td class="py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-2 text-white"
                                             style="width:30px;height:30px;background:#E74A3B;font-size:11px;flex-shrink:0;">DT</div>
                                        David Tan
                                    </div>
                                </td>
                                <td class="py-2">david.tan@gmail.com</td>
                                <td class="py-2">Mar 13</td>
                                <td class="py-2">1:00 PM</td>
                                <td class="py-2"><span class="badge badge-danger">Cancelled</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center mt-2">
                        <small class="text-muted">Menampilkan 5 request terbaru</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Users -->
        <div class="col-lg-4">
            <div class="card shadow h-100">
                <div class="card-body py-3">
                    <h6 class="font-weight-bold mb-3">Stats Users</h6>

                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="card border p-2 text-center">
                                <div class="rounded-circle mx-auto mb-1 d-flex align-items-center justify-content-center"
                                     style="width:40px;height:40px;background:#EEF2FF;">
                                    <i class="fas fa-user" style="color:#6366F1;"></i>
                                </div>
                                <small class="text-muted">Total User</small>
                                <div class="h6 font-weight-bold mb-0">450</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card border p-2 text-center">
                                <div class="rounded-circle mx-auto mb-1 d-flex align-items-center justify-content-center"
                                     style="width:40px;height:40px;background:#F5F3FF;">
                                    <i class="fas fa-shield-alt" style="color:#8B5CF6;"></i>
                                </div>
                                <small class="text-muted">Total Admin</small>
                                <div class="h6 font-weight-bold mb-0">12</div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <i class="fas fa-users fa-4x text-gray-300 mb-2"></i>
                        <p class="font-weight-bold mb-1 small">Kelola pengguna sistem</p>
                        <small class="text-muted">Total pengguna dan admin terdaftar dalam sistem.</small>
                        <div class="mt-3">
                            <a href="{{ route('admin.manage.user') }}" class="btn btn-sm btn-outline-primary mr-2">Users</a>
                            <a href="{{ route('admin.manage.admin') }}" class="btn btn-sm btn-outline-secondary">Admins</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
</div>
@endsection