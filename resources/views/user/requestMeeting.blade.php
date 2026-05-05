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

        {{-- Notif --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success'); }}
            </div>
        @endif

        <form method="POST" action="{{  route('user-meeting.store') }}">
            @csrf

            <!-- beris 1 -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nama Anda</label>
                    <input type="text" class="form-control" value="{{ session('user.name') }}" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label>Nomor WhatsApp</label>
                    <input type="text" class="form-control" value="{{ session('user.phone') ?? '' }}" readonly>
                </div>
            </div>

            <!-- baris 2 -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="email" class="form-control" value="{{ session('user.email') }}" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label>Subject / Topik <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control"
                           placeholder="Aplikasi Kasir" value="{{ old('title') }}" required>
                </div>
            </div>

            <!-- baris 3 -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Perusahaan</label>
                    <input type="text" name="company" class="form-control"
                           placeholder="PT ..."
                           value="{{ old('company') }}">
                </div>

                <div class="form-group col-md-3">
                    <label>Tanggal</label>
                    <input type="date" name="date" class="form-control"
                           value="{{ old('date') }}" required>
                </div>

                <div class="form-group col-md-3">
                    <label>Pilih Jam <span class="text-danger">*</span></label>
                    <input type="time" name="time" class="form-control"
                           value="{{ old('time') }}" required>
                </div>
            </div>

            <!-- text -->
            <div class="form-group">
                <label>Pesan Tambahan (Opsional)</label>
                <textarea name="description" class="form-control" rows="4"
                          placeholder="Ceritakan kebutuhan Anda...">{{ old('description') }}</textarea>
            </div>

            <!-- file -->
            <div class="form-group">
                <label>Lampiran</label>
                <input type="file" name="attachment" class="form-control-file border p-2"
                       accept=".pdf,.jpg,.jpeg,.png">
                <small class="text-muted">
                    Ekstensi file : *.pdf, *.jpg, *.jpeg, *.png & max file 3MB
                </small>
            </div>

            <!-- tombol -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-amber px-5 py-2">
                    Ajukan Meeting
                </button>
            </div>

        </form>

        <!-- info -->
        <div class="mt-4">
            <small class="d-block">Estimasi respon : 1 × 24 jam</small>
            <small class="d-block">jam operasional : 09:00 - 17:00</small>
        </div>

    </div>

</div>
@endsection