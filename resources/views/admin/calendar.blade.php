@extends('layouts.admin')

@section('content')
<div id="content">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Calendar</h1>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/calendar.js')
@endpush

@push('styles')
<style>
    /* Tombol navigasi & toolbar */
    .fc .fc-button-primary {
        background-color: #FF8C00 !important;
        border-color: #FF8C00 !important;
        color: white !important;
    }

    /* Hover */
    .fc .fc-button-primary:hover {
        background-color: #e07b00 !important;
        border-color: #e07b00 !important;
    }

    /* Tombol aktif (misal: month sedang dipilih) */
    .fc .fc-button-primary:not(:disabled).fc-button-active,
    .fc .fc-button-primary:not(:disabled):active {
        background-color: #cc6f00 !important;
        border-color: #cc6f00 !important;
    }

    /* Tanggal hari ini */
    .fc .fc-daygrid-day.fc-day-today {
        background-color: #fff3e0 !important;
    }
</style>
@endpush