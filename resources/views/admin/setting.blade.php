@extends('layouts.admin')

@section('content')
<div id="content">
<div class="container-fluid">

    {{-- Header --}}
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Setting Website</h1>
        <p class="text-muted small">Kelola semua informasi dan pengaturan website perusahaan.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle mr-1"></i> {{ $errors->first() }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.setting.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">

            {{-- ===================== KOLOM KIRI ===================== --}}
            <div class="col-lg-8">

                {{-- 1. INFORMASI PERUSAHAAN --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center">
                        <i class="fas fa-building text-warning mr-2"></i>
                        <h6 class="font-weight-bold m-0">1. Informasi Perusahaan</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">
                            Informasi dasar perusahaan yang tampil di berbagai halaman website.
                        </p>

                        <div class="form-group">
                            <label class="font-weight-bold small">
                                Nama Perusahaan <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="company_name" class="form-control"
                                   value="{{ $settings['company_name'] ?? '' }}"
                                   placeholder="PT Motekar Cipta Teknologi">
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold small">Alamat Lengkap</label>
                            <textarea name="company_address" class="form-control" rows="2"
                                      placeholder="Jl. Contoh No. 1, Kota, Provinsi">{{ $settings['company_address'] ?? '' }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold small">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" name="company_email" class="form-control"
                                           value="{{ $settings['company_email'] ?? '' }}"
                                           placeholder="info@perusahaan.com">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold small">Nomor Telepon</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="company_phone" class="form-control"
                                           value="{{ $settings['company_phone'] ?? '' }}"
                                           placeholder="0281-123456">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. JAM OPERASIONAL --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center">
                        <i class="fas fa-clock text-warning mr-2"></i>
                        <h6 class="font-weight-bold m-0">2. Jam Operasional</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">
                            Jam operasional digunakan untuk membatasi waktu pengajuan meeting oleh user.
                            Meeting hanya bisa diajukan pada jam ini.
                        </p>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold small">Jam Buka</label>
                                <input type="time" name="office_open" class="form-control"
                                       value="{{ $settings['office_open'] ?? '08:00' }}">
                                <small class="text-muted">Waktu mulai jam kerja</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold small">Jam Tutup</label>
                                <input type="time" name="office_close" class="form-control"
                                       value="{{ $settings['office_close'] ?? '17:00' }}">
                                <small class="text-muted">Waktu akhir jam kerja</small>
                            </div>
                        </div>

                        <div class="alert alert-info small mb-0">
                            <i class="fas fa-info-circle mr-1"></i>
                            Contoh: Jam Buka <strong>08:00</strong> dan Jam Tutup <strong>17:00</strong>
                            artinya user hanya bisa request meeting antara pukul 08.00 - 17.00 WIB.
                        </div>
                    </div>
                </div>

                {{-- 3. WHATSAPP --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center">
                        <i class="fab fa-whatsapp text-success mr-2"></i>
                        <h6 class="font-weight-bold m-0">3. WhatsApp</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">
                            Nomor WhatsApp yang tampil di halaman Kontak sebagai tombol "Chat Lewat WhatsApp".
                        </p>

                        <div class="form-group mb-0">
                            <label class="font-weight-bold small">Nomor WhatsApp</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-success text-white">
                                        <i class="fab fa-whatsapp mr-1"></i> +62
                                    </span>
                                </div>
                                <input type="text" name="company_whatsapp" class="form-control"
                                       value="{{ $settings['company_whatsapp'] ?? '' }}"
                                       placeholder="81234567890">
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-exclamation-triangle text-warning mr-1"></i>
                                <strong>Penting:</strong> Isi tanpa angka 0 di depan dan tanpa tanda +62.
                                Contoh: <strong>81234567890</strong> (bukan 081234567890 atau +6281234567890)
                            </small>
                        </div>

                        @if (!empty($settings['company_whatsapp']))
                            <div class="mt-3">
                                <a href="https://wa.me/62{{ ltrim($settings['company_whatsapp'], '0') }}"
                                   target="_blank"
                                   class="btn btn-success btn-sm">
                                    <i class="fab fa-whatsapp mr-1"></i> Test Link WhatsApp
                                </a>
                                <small class="text-muted ml-2">
                                    Link: https://wa.me/62{{ ltrim($settings['company_whatsapp'], '0') }}
                                </small>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- 4. SOSIAL MEDIA --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center">
                        <i class="fas fa-share-alt text-warning mr-2"></i>
                        <h6 class="font-weight-bold m-0">4. Sosial Media</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">
                            Link sosial media perusahaan yang tampil di halaman Kontak.
                            Isi URL lengkap termasuk https://.
                        </p>

                        <div class="form-group">
                            <label class="font-weight-bold small">
                                <i class="fab fa-facebook text-primary mr-1"></i> Facebook
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-primary">
                                        <i class="fab fa-facebook"></i>
                                    </span>
                                </div>
                                <input type="url" name="facebook_url" class="form-control"
                                       value="{{ $settings['facebook_url'] ?? '' }}"
                                       placeholder="https://facebook.com/namaperusahaan">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold small">
                                <i class="fab fa-instagram text-danger mr-1"></i> Instagram
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-danger">
                                        <i class="fab fa-instagram"></i>
                                    </span>
                                </div>
                                <input type="url" name="instagram_url" class="form-control"
                                       value="{{ $settings['instagram_url'] ?? '' }}"
                                       placeholder="https://instagram.com/namaperusahaan">
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label class="font-weight-bold small">
                                <i class="fab fa-youtube text-danger mr-1"></i> YouTube
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-danger">
                                        <i class="fab fa-youtube"></i>
                                    </span>
                                </div>
                                <input type="url" name="youtube_url" class="form-control"
                                       value="{{ $settings['youtube_url'] ?? '' }}"
                                       placeholder="https://youtube.com/@namaperusahaan">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 5. LOKASI & MAP --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center">
                        <i class="fas fa-map-marker-alt text-danger mr-2"></i>
                        <h6 class="font-weight-bold m-0">5. Lokasi & Map</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">
                            Koordinat lokasi perusahaan untuk embed Google Maps di halaman Kontak.
                        </p>

                        <div class="alert alert-light border mb-3 small">
                            <strong>Cara mendapatkan koordinat:</strong>
                            <ol class="mb-0 mt-1 pl-3">
                                <li>Buka <a href="https://maps.google.com" target="_blank">Google Maps</a></li>
                                <li>Cari lokasi perusahaan</li>
                                <li>Klik kanan pada titik lokasi</li>
                                <li>Salin angka koordinat yang muncul (contoh: <code>-7.3989, 109.6542</code>)</li>
                                <li>Angka pertama = Latitude, angka kedua = Longitude</li>
                            </ol>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold small">Latitude</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-arrows-alt-v"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="map_latitude"
                                           id="map_latitude"
                                           class="form-control"
                                           value="{{ $settings['map_latitude'] ?? '-7.398976461906811' }}"
                                           placeholder="-7.398976461906811"
                                           oninput="updateMapPreview()">
                                </div>
                                <small class="text-muted">Angka negatif untuk wilayah selatan Indonesia</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold small">Longitude</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-arrows-alt-h"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="map_longitude"
                                           id="map_longitude"
                                           class="form-control"
                                           value="{{ $settings['map_longitude'] ?? '109.65420204629316' }}"
                                           placeholder="109.65420204629316"
                                           oninput="updateMapPreview()">
                                </div>
                                <small class="text-muted">Angka positif untuk wilayah timur Greenwich</small>
                            </div>
                        </div>

                        {{-- Preview Map --}}
                        <div class="mt-3">
                            <label class="font-weight-bold small">Preview Map</label>
                            <iframe id="map-preview"
                                    src="https://www.google.com/maps?q={{ $settings['map_latitude'] ?? '-7.398976461906811' }},{{ $settings['map_longitude'] ?? '109.65420204629316' }}&hl=id;z=14&output=embed"
                                    class="w-100 rounded border"
                                    style="height: 250px; border:0;"
                                    loading="lazy">
                            </iframe>
                            <small class="text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Preview akan update setelah simpan. Pastikan koordinat sudah benar sebelum menyimpan.
                            </small>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ===================== KOLOM KANAN ===================== --}}
            <div class="col-lg-4">

                {{-- Logo --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center">
                        <i class="fas fa-image text-warning mr-2"></i>
                        <h6 class="font-weight-bold m-0">Logo Perusahaan</h6>
                    </div>
                    <div class="card-body text-center">
                        <p class="text-muted small mb-3">
                            Logo tampil di navbar dan beberapa halaman website.
                            Format: JPG, PNG, SVG. Maks 2MB.
                        </p>

                        @if (!empty($settings['logo']))
                            <img src="{{ rtrim(env('API_BASE_URL', 'http://127.0.0.1:8000'), '/') . '/storage/settings/' . $settings['logo'] }}"
                                 alt="Logo"
                                 class="img-fluid mb-3 rounded border p-2"
                                 style="max-height: 120px;">
                            <p class="text-muted small">Logo saat ini</p>
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3"
                                 style="height: 120px;">
                                <div class="text-center text-muted">
                                    <i class="fas fa-image fa-3x mb-2"></i>
                                    <p class="small mb-0">Belum ada logo</p>
                                </div>
                            </div>
                        @endif

                        <div class="form-group mb-0">
                            <label class="font-weight-bold small">
                                {{ !empty($settings['logo']) ? 'Ganti Logo' : 'Upload Logo' }}
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="logoFile"
                                       name="logo" accept=".jpg,.jpeg,.png,.svg"
                                       onchange="previewLogo(this)">
                                <label class="custom-file-label" for="logoFile">
                                    Pilih file...
                                </label>
                            </div>
                        </div>

                        {{-- Preview logo baru --}}
                        <div id="logo-new-preview" class="mt-3" style="display:none;">
                            <p class="small text-muted mb-1">Preview logo baru:</p>
                            <img id="logo-preview-img" src="" alt="preview"
                                 class="img-fluid rounded border p-2"
                                 style="max-height: 100px;">
                        </div>
                    </div>
                </div>

                {{-- Ringkasan --}}
                <div class="card shadow mb-4 border-left-warning">
                    <div class="card-body">
                        <h6 class="font-weight-bold text-warning mb-3">
                            <i class="fas fa-list-check mr-1"></i> Ringkasan Setting
                        </h6>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-2">
                                @if (!empty($settings['company_name']))
                                    <i class="fas fa-check-circle text-success mr-1"></i>
                                @else
                                    <i class="fas fa-times-circle text-danger mr-1"></i>
                                @endif
                                Nama Perusahaan
                            </li>
                            <li class="mb-2">
                                @if (!empty($settings['company_email']))
                                    <i class="fas fa-check-circle text-success mr-1"></i>
                                @else
                                    <i class="fas fa-times-circle text-danger mr-1"></i>
                                @endif
                                Email
                            </li>
                            <li class="mb-2">
                                @if (!empty($settings['company_whatsapp']))
                                    <i class="fas fa-check-circle text-success mr-1"></i>
                                @else
                                    <i class="fas fa-times-circle text-danger mr-1"></i>
                                @endif
                                WhatsApp
                            </li>
                            <li class="mb-2">
                                @if (!empty($settings['facebook_url']) || !empty($settings['instagram_url']) || !empty($settings['youtube_url']))
                                    <i class="fas fa-check-circle text-success mr-1"></i>
                                @else
                                    <i class="fas fa-times-circle text-danger mr-1"></i>
                                @endif
                                Sosial Media
                            </li>
                            <li class="mb-2">
                                @if (!empty($settings['map_latitude']))
                                    <i class="fas fa-check-circle text-success mr-1"></i>
                                @else
                                    <i class="fas fa-times-circle text-danger mr-1"></i>
                                @endif
                                Koordinat Map
                            </li>
                            <li>
                                @if (!empty($settings['logo']))
                                    <i class="fas fa-check-circle text-success mr-1"></i>
                                @else
                                    <i class="fas fa-times-circle text-danger mr-1"></i>
                                @endif
                                Logo
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Tombol Simpan --}}
                <div class="card shadow">
                    <div class="card-body">
                        <button type="submit" class="btn btn-amber btn-block btn-lg">
                            <i class="fas fa-save mr-1"></i> Simpan Semua Pengaturan
                        </button>
                        <p class="text-muted small text-center mt-2 mb-0">
                            Semua perubahan akan langsung tampil di website.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </form>

</div>
</div>
@endsection

@push('scripts')
<script>
    // Preview logo sebelum upload
    function previewLogo(input) {
        const preview = document.getElementById('logo-new-preview');
        const previewImg = document.getElementById('logo-preview-img');
        const label = input.nextElementSibling;

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
            label.textContent = input.files[0].name;
        }
    }

    // Update preview map (hanya label, preview update setelah simpan)
    function updateMapPreview() {
        // Preview map tidak bisa update real-time karena iframe,
        // tapi bisa tampilkan link Google Maps untuk verifikasi
        const lat = document.getElementById('map_latitude').value;
        const lng = document.getElementById('map_longitude').value;

        if (lat && lng) {
            const mapsUrl = `https://www.google.com/maps?q=${lat},${lng}&hl=id;z=14&output=embed`;
            // Update iframe setelah delay 1 detik agar tidak terlalu sering reload
            clearTimeout(window.mapUpdateTimer);
            window.mapUpdateTimer = setTimeout(function() {
                document.getElementById('map-preview').src = mapsUrl;
            }, 1500);
        }
    }
</script>
@endpush