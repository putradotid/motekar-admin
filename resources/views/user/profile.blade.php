@extends('layouts.user')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center pt-5">
        <div>
            <h2 class="font-weight-bold">Profile Saya</h2>
        </div>
    </div>

    {{-- Card Informasi Pribadi --}}
    <div class="card shadow-sm mt-2">
        <div class="card-body">

            <h5 class="font-weight-bold mb-4">Informasi Pribadi</h5>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <div class="row">

                {{-- Foto --}}
                <div class="col-md-3 text-center">
                    <img
                        src="{{ asset('storage/motekar-logo.png') }}"
                        class="rounded-circle mb-3"
                        width="150"
                        height="150"
                        style="object-fit: cover; background-color: #ccc;"
                        alt="foto-profil"
                    >
                    <br>
                    <button type="button" class="btn btn-amber px-4">
                        Ubah Foto
                    </button>
                </div>

                {{-- Form --}}
                <div class="col-md-9">
                    <form method="POST" action="{{ route('user-profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $profile['name'] ?? '') }}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ old('email', $profile['email'] ?? '') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nomor Telepon</label>
                                <input type="text" name="phone" class="form-control"
                                       placeholder="+62..."
                                       value="{{ old('phone', $profile['phone'] ?? '') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="address" class="form-control"
                                   placeholder="Jl. ..."
                                   value="{{ old('address', $profile['address'] ?? '') }}">
                        </div>

                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div>
                                <span class="d-block">Estimasi respon : 1 × 24 jam</span>
                                <span class="d-block">jam operasional : 09:00 - 17:00</span>
                            </div>
                            <button type="submit" class="btn btn-amber px-4">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

    {{-- Card Keamanan Akun --}}
    <div class="card shadow-sm mt-5">
        <div class="card-body">
            <h5 class="font-weight-bold p-3">Keamanan Akun</h5>
            <div class="d-flex justify-content-between align-items-center m-3">
                <div class="d-flex align-items-center">
                    <label class="mb-0 mr-3">Password</label>
                    <input type="password" class="form-control"
                           value="password123" style="width: 250px;">
                </div>
                <a href="#" class="btn btn-amber px-4">Ubah Password</a>
            </div>
        </div>
    </div>

</div>
@endsection