@extends('layouts.admin')

@push('styles')
<style>
    .section-card {
        border: 1px solid #e3e6f0;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 20px;
        background: #fff;
    }
    .section-card h5 {
        font-weight: 700;
        margin-bottom: 4px;
    }
    .section-card .section-desc {
        color: #6e707e;
        font-size: 13px;
        margin-bottom: 20px;
    }
    .img-preview {
        width: 100%;
        height: 160px;
        border-radius: 8px;
        border: 1px solid #e3e6f0;
        background-size: cover;
        background-position: center;
        background-color: #f8f9fc;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-size: 12px;
        margin-bottom: 12px;
    }
</style>
@endpush

@section('content')
<div id="content">
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Tentang Kami</h1>
            <p class="text-muted small">Edit and manage content displayed on the Tentang Kami page.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <form method="POST"
          action="{{ $page ? route('admin.tentang-kami.update', $page['id']) : route('admin.tentang-kami.store') }}">
        @csrf
        @if ($page)
            @method('PUT')
        @endif

        {{-- ==================== SECTION 1: HERO ==================== --}}
        <div class="section-card">
            <h5><i class="fas fa-heading mr-1 text-warning"></i> Section 1 — Judul Halaman</h5>
            <p class="section-desc">Judul dan deskripsi utama yang tampil di bagian atas halaman Tentang Kami.</p>

            <div class="form-group">
                <label class="font-weight-bold small">Judul <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ $page['title'] ?? 'Tentang Kami' }}" required>
            </div>
            <div class="form-group">
                <label class="font-weight-bold small">Deskripsi</label>
                <textarea name="description" class="form-control" rows="5" placeholder="Deskripsi perusahaan...">{{ $page['description'] ?? '' }}</textarea>
            </div>
        </div>

        {{-- ==================== SECTION 2: VISI & MISI ==================== --}}
        <div class="section-card">
            <h5><i class="fas fa-bullseye mr-1 text-warning"></i> Section 2 — Visi & Misi</h5>
            <p class="section-desc">Visi dan misi perusahaan, beserta 1 foto pendukung.</p>

            <div class="row">
                <div class="col-lg-4">
                    <label class="font-weight-bold small">Foto Visi & Misi</label>
                    <div class="img-preview" id="visi-misi-preview"
                         style="{{ !empty($page['visi_misi_image']) ? 'background-image:url(\''.$page['visi_misi_image'].'\')' : '' }}">
                        @if (empty($page['visi_misi_image']))
                            Belum ada gambar
                        @endif
                    </div>
                    <input type="text" name="visi_misi_image" id="visi-misi-input"
                           class="form-control form-control-sm"
                           value="{{ $page['visi_misi_image'] ?? '' }}"
                           placeholder="dari Media Library"
                           oninput="updatePreview(this, 'visi-misi-preview')">
                    <small class="text-muted"><a href="{{ route('admin.media') }}" target="_blank">Buka Media Library</a></small>
                </div>

                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">Visi</label>
                                <textarea name="vision" class="form-control" rows="6" placeholder="Tulis visi perusahaan...">{{ $page['vision'] ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">Misi</label>
                                <textarea name="mission" class="form-control" rows="6" placeholder="Tulis misi perusahaan...">{{ $page['mission'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">
                        <i class="fas fa-info-circle mr-1"></i>
                        Pada halaman publik, teks ini akan ditampilkan ringkas dengan tombol "Lihat Selengkapnya" (popup).
                    </small>
                </div>
            </div>
        </div>

        {{-- ==================== SECTION 3: FOUNDER ==================== --}}
        <div class="section-card">
            <h5><i class="fas fa-user-tie mr-1 text-warning"></i> Section 3 — Founder</h5>
            <p class="section-desc">Profil pendiri perusahaan beserta foto.</p>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label class="font-weight-bold small">Judul Section</label>
                        <input type="text" name="founder_title" class="form-control" value="{{ $page['founder_title'] ?? 'The Founder' }}" placeholder="The Founder">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold small">Deskripsi / Cerita Founder</label>
                        <textarea name="founder_description" class="form-control" rows="6" placeholder="Cerita tentang founder...">{{ $page['founder_description'] ?? '' }}</textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold small">Nama Pendiri</label>
                            <input type="text" name="founder_name" class="form-control" value="{{ $page['founder_name'] ?? '' }}" placeholder="John Doe">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold small">Jabatan</label>
                            <input type="text" name="founder_position" class="form-control" value="{{ $page['founder_position'] ?? '' }}" placeholder="Founder & Chief Executive Officer">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <label class="font-weight-bold small">Foto Founder</label>
                    <div class="img-preview" id="founder-preview"
                         style="{{ !empty($page['founder_image']) ? 'background-image:url(\''.$page['founder_image'].'\')' : '' }}">
                        @if (empty($page['founder_image']))
                            Belum ada gambar
                        @endif
                    </div>
                    <input type="text" name="founder_image" id="founder-input"
                           class="form-control form-control-sm"
                           value="{{ $page['founder_image'] ?? '' }}"
                           placeholder="dari Media Library"
                           oninput="updatePreview(this, 'founder-preview')">
                    <small class="text-muted"><a href="{{ route('admin.media') }}" target="_blank">Buka Media Library</a></small>
                </div>
            </div>
        </div>

        {{-- Save --}}
        <div class="text-right mb-4">
            <button type="submit" class="btn btn-amber px-5">
                <i class="fas fa-save mr-1"></i> {{ $page ? 'Simpan Perubahan' : 'Buat Halaman' }}
            </button>
        </div>

    </form>

</div>
</div>
@endsection

@push('scripts')
<script>
    function updatePreview(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.value) {
            preview.style.backgroundImage = "url('" + input.value + "')";
            preview.textContent = '';
        } else {
            preview.style.backgroundImage = 'none';
            preview.textContent = 'Belum ada gambar';
        }
    }
</script>
@endpush