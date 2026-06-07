@extends('layouts.admin')

@section('content')
<div id="content">
<div class="container-fluid">

    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Setting Website</h1>
        <p class="text-muted small">Kelola informasi dan pengaturan website.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.setting.update') }}"
          enctype="multipart/form-data">
        @csrf

        <div class="row">

            {{-- Informasi Perusahaan --}}
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold m-0">Informasi Perusahaan</h6>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Nama Perusahaan</label>
                            <input type="text" name="company_name" class="form-control"
                                   value="{{ $settings['company_name'] ?? '' }}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" name="company_email" class="form-control"
                                       value="{{ $settings['company_email'] ?? '' }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nomor Telepon</label>
                                <input type="text" name="company_phone" class="form-control"
                                       value="{{ $settings['company_phone'] ?? '' }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>WhatsApp</label>
                                <input type="text" name="company_whatsapp" class="form-control"
                                       value="{{ $settings['company_whatsapp'] ?? '' }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Alamat</label>
                                <input type="text" name="company_address" class="form-control"
                                       value="{{ $settings['company_address'] ?? '' }}">
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Jam Operasional --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold m-0">Jam Operasional</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Jam Buka</label>
                                <input type="time" name="office_open" class="form-control"
                                       value="{{ $settings['office_open'] ?? '08:00' }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Jam Tutup</label>
                                <input type="time" name="office_close" class="form-control"
                                       value="{{ $settings['office_close'] ?? '17:00' }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Social Media --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold m-0">Social Media</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label><i class="fab fa-facebook mr-1 text-primary"></i> Facebook URL</label>
                            <input type="text" name="facebook_url" class="form-control"
                                   value="{{ $settings['facebook_url'] ?? '' }}"
                                   placeholder="https://facebook.com/...">
                        </div>
                        <div class="form-group">
                            <label><i class="fab fa-instagram mr-1 text-danger"></i> Instagram URL</label>
                            <input type="text" name="instagram_url" class="form-control"
                                   value="{{ $settings['instagram_url'] ?? '' }}"
                                   placeholder="https://instagram.com/...">
                        </div>
                        <div class="form-group">
                            <label><i class="fab fa-youtube mr-1 text-danger"></i> YouTube URL</label>
                            <input type="text" name="youtube_url" class="form-control"
                                   value="{{ $settings['youtube_url'] ?? '' }}"
                                   placeholder="https://youtube.com/...">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Logo --}}
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="font-weight-bold m-0">Logo Perusahaan</h6>
                    </div>
                    <div class="card-body text-center">
                        @if (!empty($settings['logo']))
                            <img src="{{ rtrim(env('API_BASE_URL', 'http://127.0.0.1:8000'), '/') . '/storage/settings/' . $settings['logo'] }}"
                                 alt="Logo"
                                 class="img-fluid mb-3 rounded"
                                 style="max-height: 150px;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3"
                                 style="height: 150px;">
                                <i class="fas fa-image fa-3x text-gray-300"></i>
                            </div>
                        @endif

                        <div class="form-group">
                            <input type="file" name="logo" class="form-control-file"
                                   accept=".jpg,.jpeg,.png,.svg">
                            <small class="text-muted">Format: JPG, PNG, SVG. Maks 2MB.</small>
                        </div>
                    </div>
                </div>

                {{-- Tombol Simpan --}}
                <div class="card shadow">
                    <div class="card-body">
                        <button type="submit" class="btn btn-amber btn-block">
                            <i class="fas fa-save mr-1"></i> Simpan Pengaturan
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>

</div>
</div>
@endsection