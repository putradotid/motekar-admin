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

        <!-- Content Row -->

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">

                    <!-- Tab Bar -->
                    <div class="card-header py-2 d-flex align-items-center justify-content-between flex-wrap" style="gap: 8px;">
                        <div class="d-flex flex-wrap" style="gap: 4px;">
                            <a href="#" class="btn btn-sm btn-primary">All (78)</a>
                            <a href="#" class="btn btn-sm btn-light">Pending (14)</a>
                            <a href="#" class="btn btn-sm btn-light">Approved (42)</a>
                            <a href="#" class="btn btn-sm btn-light">Rescheduled (6)</a>
                            <a href="#" class="btn btn-sm btn-light">Complete (14)</a>
                            <a href="#" class="btn btn-sm btn-light">Cancelled (6)</a>
                        </div>
                        <a href="#" class="btn btn-sm btn-light">
                            <i class="fas fa-calendar-alt mr-1"></i> Calendar View
                        </a>
                    </div>

                    <div class="card-body">

                        <!-- Filter -->
                        <div class="d-flex align-items-center mb-3" style="gap: 8px;">
                            <span class="font-weight-bold mr-1">Status:</span>
                            <select class="form-control" style="width: 150px;">
                                <option>All Statuses</option>
                                <option>Pending</option>
                                <option>Approved</option>
                                <option>Rejected</option>
                                <option>Complete</option>
                            </select>
                            <input type="date" class="form-control" style="width: 180px;">
                            <input type="text" class="form-control" placeholder="Search . . .">
                            <button class="btn btn-primary px-4">Filter</button>
                        </div>

                        <!-- Jumlah data -->
                        <small class="text-muted d-block mb-2">6 items</small>

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
                                    <tr class="border-bottom">
                                        <td>Putra</td>
                                        <td>putra@gmail.com</td>
                                        <td>Senin, Maret 7</td>
                                        <td>10:00 AM</td>
                                        <td>Pending</td>
                                        <td>
                                            <div class="d-flex" style="gap: 4px;">
                                                <button class="btn btn-sm btn-success">Approve</button>
                                                <button class="btn btn-sm btn-danger">Cancel</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>Sarah</td>
                                        <td>sarah@gmail.com</td>
                                        <td>Senin, Maret 8</td>
                                        <td>2:30 PM</td>
                                        <td>Approved</td>
                                        <td>
                                            <div class="d-flex" style="gap: 4px;">
                                                <button class="btn btn-sm btn-primary">Complete</button>
                                                <button class="btn btn-sm btn-danger">Cancel</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>Doni</td>
                                        <td>doni@gmail.com</td>
                                        <td>Senin, Maret 9</td>
                                        <td>11:15 AM</td>
                                        <td>Rescheduled</td>
                                        <td>
                                            <div class="d-flex" style="gap: 4px;">
                                                <button class="btn btn-sm btn-primary">Complete</button>
                                                <button class="btn btn-sm btn-danger">Cancel</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>Adam</td>
                                        <td>adam@gmail.com</td>
                                        <td>Selasa, Maret 10</td>
                                        <td>3:15 PM</td>
                                        <td>Rescheduled</td>
                                        <td>
                                            <div class="d-flex" style="gap: 4px;">
                                                <button class="btn btn-sm btn-primary">Complete</button>
                                                <button class="btn btn-sm btn-danger">Cancel</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>David</td>
                                        <td>david@gmail.com</td>
                                        <td>Jumat, Maret 13</td>
                                        <td>1:00 PM</td>
                                        <td>Complete</td>
                                        <td>
                                            <span class="text-muted">-</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small>Showing 1 to 5 of 78 request</small>
                            <div>
                                <a href="#" class="btn btn-sm btn-light">&lt; Prev</a>
                                <a href="#" class="btn btn-sm btn-primary">1</a>
                                <a href="#" class="btn btn-sm btn-light">2</a>
                                <a href="#" class="btn btn-sm btn-light">3</a>
                                <a href="#" class="btn btn-sm btn-light">Next &gt;</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection