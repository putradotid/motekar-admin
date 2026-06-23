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
</style>
@endpush

@section('content')
<div id="content">
<div class="container-fluid">

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
                <input type="text" name="title" class="form-control"
                       value="{{ $page['title'] ?? 'Tentang Kami' }}" required>
            </div>
            <div class="form-group">
                <label class="font-weight-bold small">Deskripsi</label>
                <textarea name="description" class="form-control" rows="5"
                          placeholder="Deskripsi perusahaan...">{{ $page['description'] ?? '' }}</textarea>
            </div>
        </div>

        {{-- ==================== SECTION 2: VISI & MISI ==================== --}}
        <div class="section-card">
            <h5><i class="fas fa-bullseye mr-1 text-warning"></i> Section 2 — Visi & Misi</h5>
            <p class="section-desc">Visi dan misi perusahaan, beserta 1 foto pendukung.</p>

            <div class="row">
                <div class="col-lg-4">
                    {{-- Foto Visi & Misi — media picker --}}
                    @include('layouts.partials.media-input', [
                        'name'    => 'visi_misi_image',
                        'value'   => $page['visi_misi_image'] ?? '',
                        'label'   => 'Foto Visi & Misi',
                        'inputId' => 'visi-misi-image',
                        'height'  => '160px',
                        'hint'    => 'Foto yang tampil di samping visi & misi.',
                    ])
                </div>

                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">Visi</label>
                                <textarea name="vision" class="form-control" rows="6"
                                          placeholder="Tulis visi perusahaan...">{{ $page['vision'] ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">Misi</label>
                                <textarea name="mission" class="form-control" rows="6"
                                          placeholder="Tulis misi perusahaan...">{{ $page['mission'] ?? '' }}</textarea>
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
                        <input type="text" name="founder_title" class="form-control"
                               value="{{ $page['founder_title'] ?? 'The Founder' }}"
                               placeholder="The Founder">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold small">Deskripsi / Cerita Founder</label>
                        <textarea name="founder_description" class="form-control" rows="6"
                                  placeholder="Cerita tentang founder...">{{ $page['founder_description'] ?? '' }}</textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold small">Nama Pendiri</label>
                            <input type="text" name="founder_name" class="form-control"
                                   value="{{ $page['founder_name'] ?? '' }}"
                                   placeholder="John Doe">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold small">Jabatan</label>
                            <input type="text" name="founder_position" class="form-control"
                                   value="{{ $page['founder_position'] ?? '' }}"
                                   placeholder="Founder & Chief Executive Officer">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    {{-- Foto Founder — media picker --}}
                    @include('layouts.partials.media-input', [
                        'name'    => 'founder_image',
                        'value'   => $page['founder_image'] ?? '',
                        'label'   => 'Foto Founder',
                        'inputId' => 'founder-image',
                        'height'  => '200px',
                        'hint'    => 'Foto pendiri yang tampil di section The Founder.',
                    ])
                </div>
            </div>
        </div>

        {{-- Tombol Simpan --}}
        <div class="text-right mb-4">
            <button type="submit" class="btn btn-amber px-5">
                <i class="fas fa-save mr-1"></i>
                {{ $page ? 'Simpan Perubahan' : 'Buat Halaman' }}
            </button>
        </div>

    </form>

</div>
</div>
@endsection