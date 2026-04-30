@extends('layouts.user')

@section('content')
<div class="container mt-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 pt-5">
        <div>
            <h2 class="font-weight-bold">Hi, User!</h2>
            <p class="text-muted">Anda dapat memantau status dan progres request meeting Anda di sini.</p>
        </div>
        <a href="#" class="btn btn-amber px-4">
            Tambah Meeting
        </a>
    </div>

    <!-- Stats -->
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card border shadow-sm">
                <div class="card-body">
                    <small>Pending</small>
                    <h4>3</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border shadow-sm">
                <div class="card-body">
                    <small>Approved</small>
                    <h4>1</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border shadow-sm">
                <div class="card-body">
                    <small>Rejected</small>
                    <h4>0</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border shadow-sm">
                <div class="card-body">
                    <small>Completed</small>
                    <h4>1</h4>
                </div>
            </div>
        </div>

    </div>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Table Header -->
            <div class="d-flex justify-content-between mb-3">
                <h5 class="font-weight-bold">Daftar Request Meeting</h5>
                <div class="d-flex">
                    <input type="text" class="form-control mr-2" placeholder="Search . . .">
                    <button class="btn btn-primary">Cari</button>
                </div>
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
                    <tbody id="meetingBody">
                        <tr>
                            <td>Senin, Maret 7</td>
                            <td>Build Website POS</td>
                            <td>Pending</td>
                            <td>Senin, Maret 7</td>
                            <td>10:00 AM</td>
                            <td><button class="btn btn-sm btn-danger">Cancel</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between mt-3">
                <small>Showing 1 to 5 of 78 request</small>
                <div>
                    <button class="btn btn-sm btn-light">Prev</button>
                    <button class="btn btn-sm btn-light">1</button>
                    <button class="btn btn-sm btn-light">2</button>
                    <button class="btn btn-sm btn-light">3</button>
                    <button class="btn btn-sm btn-light">Next</button>
                </div>
            </div>

        </div>
    </div>

</div>

<script src="/js/api.js"></script>

<script>
async function loadMeetings() {
    try {
        const data = await api.get('/my-meetings');

        const tbody = document.getElementById('meetingBody');
        tbody.innerHTML = '';

        data.forEach(item => {
            tbody.innerHTML += `
                <tr>
                    <td>${item.date}</td>
                    <td>${item.title}</td> <!-- FIX -->
                    <td>${item.status}</td>
                    <td>${item.meeting_date ?? '-'}</td>
                    <td>${item.meeting_time ?? '-'}</td>
                    <td>
                        <button class="btn btn-sm btn-danger">Cancel</button>
                    </td>
                </tr>
            `;
        });

    } catch (err) {
        console.error(err);
    }
}

// jalan saat page load
document.addEventListener('DOMContentLoaded', loadMeetings);
</script>
@endsection