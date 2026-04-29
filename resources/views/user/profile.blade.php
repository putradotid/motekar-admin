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
                    <form action="" id="updateForm">

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" class="form-control" value="Putra">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control" value="putra@gmail.com">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="telepon">Nomor Telepon</label>
                                <input type="text" id="telepon" class="form-control" value="+62 812 345 678">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" id="alamat" class="form-control" value="Jl. Jendral soedirman No, 4, Banjarnegara">
                        </div>

                    </form>
                </div>
            </div>

            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block">Estimasi respon : 1 × 24 jam</span>
                    <span class="d-block">jam operasional : 09:00 - 17:00</span>
                </div>
                <div>
                    <a href="#" class="btn btn-amber px-4">
                        Simpan Perubahan
                    </a>
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
                    <input type="password" class="form-control" value="password123" style="width: 250px;">
                </div>
                <div>
                    <a href="#" class="btn btn-amber px-4">
                        Ubah Password
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection