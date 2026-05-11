@extends('layouts.admin')

@section('content')
<div id="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="">
                <h1 class="h3 mb-0 text-gray-800">Manage User</h1>
                <p class="">Manage users who have access or suspend.</p>
            </div>
            <a href="#" class="d-none d-sm-inline-block btn btn-amber btn-amber:hover shadow-sm"> + Add user</a>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">

                    <div class="card-body">

                        <!-- Filter -->
                        <form method="GET" action="#" 
                            class="d-flex align-items-center mb-3" style="gap: 8px;">

                            <input type="hidden" name="tab" value="{{ $tab ?? 'all' }}">

                            <select name="status" class="form-control" style="width: 180px;">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="suspend">Suspend</option>
                            </select>
                            <input type="text" name="search" class="form-control" placeholder="Search . . .">
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
                                    <tr>
                                        <td>Putra</td>
                                        <td>admin@gmail.com</td>
                                        <td>Active</td>
                                        <td>
                                            <a href="?#" 
                                                class="btn btn-sm btn-danger ">
                                                Suspend
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        {{-- <div class="d-flex justify-content-between align-items-center mt-3">
                            <small>
                                Showing {{ $meetings['from'] ?? 0 }} 
                                to {{ $meetings['to'] ?? 0 }} 
                                of {{ $meetings['total'] ?? 0 }} request
                            </small>
                            <div>
                                <a href="?page={{ ($meetings['current_page'] ?? 1) - 1 }}&tab={{ $tab }}&search={{ $search }}" 
                                    class="btn btn-sm btn-light {{ ($meetings['current_page'] ?? 1) == 1 ? 'disabled' : '' }}">
                                        &lt; Prev
                                </a>
                                @for ($i = 1; $i <= ($meetings['last_page'] ?? 1); $i++)
                                    <a href="?page={{ $i }}&tab={{ $tab }}&search={{ $search }}"
                                       class="btn btn-sm {{ $i == ($meetings['current_page'] ?? 1) ? 'btn-primary' : 'btn-light' }}">
                                        {{ $i }}
                                    </a>
                                @endfor
                                
                                <a href="?page={{ ($meetings['current_page'] ?? 1) + 1 }}&tab={{ $tab }}&search={{ $search }}" 
                                    class="btn btn-sm btn-light {{ ($meetings['current_page'] ?? 1) == ($meetings['last_page'] ?? 1) ? 'disabled' : '' }}">
                                        Next &gt;
                                </a>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection