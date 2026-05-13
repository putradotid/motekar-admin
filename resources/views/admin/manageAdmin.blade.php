@extends('layouts.admin')

@section('content')
<div id="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="">
                <h1 class="h3 mb-0 text-gray-800">Manage Admin</h1>
                <p class="">Manage admin users who have access to the admin panel.</p>
            </div>
            <a href="{{ route('admin.create') }}" class="d-none d-sm-inline-block btn btn-amber btn-amber:hover shadow-sm"> + Add admin</a>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">

                    <div class="card-body">

                        <!-- Filter -->
                        <form method="GET" action="{{ route('admin.manage.admin') }}" 
                            class="d-flex align-items-center mb-3" style="gap: 8px;">
                            <select name="status" class="form-control" style="width: 180px;">
                                <option value="">All Status</option>
                                <option value="active" {{ $status == 'active'  ? 'selected' : '' }}>Active</option>
                                <option value="suspend" {{ $status == 'suspend'  ? 'selected' : '' }}>Suspend</option>
                            </select>
                            <input type="text" name="search" class="form-control" placeholder="Search . . ." value="{{ $search }}">
                            <button type="submit" class="btn btn-primary px-4">Filter</button>
                        </form>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="border-bottom">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (
                                        $users['data'] ?? [] as $user)
                                        <tr>
                                            <td>{{ $user['name'] ?? '-' }}</td>
                                            <td>{{ $user['email'] ?? '-' }}</td>
                                            <td>
                                                <span class="badge badge-{{ ($user['status'] ?? 'active') == 'active' ? 'success' : 'danger' }}">
                                                    {{ ucfirst($user['status'] ?? 'active') }}
                                                </span>
                                            </td>
                                            <td>
                                                @if (($user['status'] ?? 'active') == 'active')
                                                    <form method="POST"
                                                          action="{{ route('admin.users.suspend', $user['id']) }}">
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger">Suspend</button>
                                                    </form>
                                                @else
                                                    <form method="POST"
                                                          action="{{ route('admin.users.active', $user['id']) }}">
                                                        @csrf
                                                        <button class="btn btn-sm btn-success">Activate</button>
                                                    </form>
                                                @endif
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">
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
                                Showing {{ $users['from'] ?? 0 }}
                                to {{ $users['to'] ?? 0 }}
                                of {{ $users['total'] ?? 0 }} users
                            </small>
                            <div>
                                <a href="?page={{ ($users['current_page'] ?? 1) - 1 }}&search={{ $search }}&status={{ $status }}"
                                   class="btn btn-sm btn-light {{ ($users['current_page'] ?? 1) == 1 ? 'disabled' : '' }}">
                                    &lt; Prev
                                </a>

                                @for ($i = 1; $i <= ($users['last_page'] ?? 1); $i++)
                                    <a href="?page={{ $i }}&search={{ $search }}&status={{ $status }}"
                                       class="btn btn-sm {{ $i == ($users['current_page'] ?? 1) ? 'btn-primary' : 'btn-light' }}">
                                        {{ $i }}
                                    </a>
                                @endfor

                                <a href="?page={{ ($users['current_page'] ?? 1) + 1 }}&search={{ $search }}&status={{ $status }}"
                                   class="btn btn-sm btn-light {{ ($users['current_page'] ?? 1) == ($users['last_page'] ?? 1) ? 'disabled' : '' }}">
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