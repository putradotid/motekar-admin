@extends('layouts.user')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center pt-5">
        <div>
            <h2 class="font-weight-bold">Request Meeting</h2>
        </div>
    </div>

    <div class="card shadow-sm p-4 mt-2">

        <h4 class="font-weight-bold mb-4">Isi Detail Meeting Anda</h4>

        <form id="meetingForm">

            <!-- ROW 1 -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nama Anda</label>
                    <input type="text" class="form-control" placeholder="John Doe">
                </div>

                <div class="form-group col-md-6">
                    <label>Nomor WhatsApp</label>
                    <input type="text" class="form-control" placeholder="+62XXXX">
                </div>
            </div>

            <!-- ROW 2 -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="myemail@gmail.com">
                </div>

                <div class="form-group col-md-6">
                    <label>Subject</label>
                    <input type="text" class="form-control" placeholder="Aplikasi Kasir">
                </div>
            </div>

            <!-- ROW 3 -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Perusahaan</label>
                    <input type="text" class="form-control" placeholder="PT ...">
                </div>

                <div class="form-group col-md-3">
                    <label>Tanggal</label>
                    <input type="date" class="form-control">
                </div>

                <div class="form-group col-md-3">
                    <label>Pilih Jam</label>
                    <input type="time" class="form-control">
                </div>
            </div>

            <!-- TEXTAREA -->
            <div class="form-group">
                <label>Pesan Tambahan (Opsional)</label>
                <textarea class="form-control" rows="4"></textarea>
            </div>

            <!-- FILE -->
            <div class="form-group">
                <label>Lampiran</label>
                <input type="file" class="form-control-file border p-2">
                <small class="text-muted">
                    Ekstensi file : *.pdf, *.jpg, *.jpeg, *.png & max file 3MB
                </small>
            </div>

            <!-- BUTTON -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-amber px-5 py-2">
                    Ajukan Meeting
                </button>
            </div>

        </form>

        <!-- FOOTER INFO -->
        <div class="mt-4">
            <small class="d-block">Estimasi respon : 1 × 24 jam</small>
            <small class="d-block">jam operasional : 09:00 - 17:00</small>
        </div>

    </div>

</div>
@endsection