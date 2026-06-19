@extends('layouts.admin')

@push('styles')
<style>
    .tab-nav {
        display: flex;
        gap: 0;
        border-bottom: 2px solid #e3e6f0;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }
    .tab-nav button {
        padding: 12px 20px;
        border: none;
        background: transparent;
        font-size: 14px;
        font-weight: 500;
        color: #6e707e;
        cursor: pointer;
        border-bottom: 2px solid transparent;
        margin-bottom: -2px;
        transition: all 0.3s ease;
    }
    .tab-nav button.active {
        color: #FF8C00;
        border-bottom-color: #FF8C00;
        background: #fff8f0;
    }
    .tab-nav button:hover:not(.active) {
        color: #495057;
    }

    .tab-content {
        display: none;
    }
    .tab-content.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .section-card {
        border: 1px solid #e3e6f0;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 20px;
        background: #fff;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f0f0f0;
    }

    .bg-preview {
        width: 100%;
        height: 100px;
        border-radius: 8px;
        border: 1px solid #e3e6f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        overflow: hidden;
        color: #999;
        background-color: #eee;
    }

    .img-preview {
        width: 100%;
        border-radius: 8px;
        border: 1px solid #e3e6f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        overflow: hidden;
        color: #999;
        background-color: #f8f9fc;
    }

    .empty-state {
        text-align: center;
        color: #6e707e;
        padding: 40px 20px;
    }
    .empty-state i {
        font-size: 48px;
        margin-bottom: 16px;
        color: #d1d5db;
    }
</style>
@endpush

@section('content')
<div id="content">
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Home Page</h1>
            <p class="text-muted small">Edit and manage all sections of your homepage.</p>
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

    {{-- Tab Navigation --}}
    <div class="tab-nav">
        <button class="tab-btn active" onclick="switchTab('hero')">
            <i class="fas fa-images mr-1"></i> Hero
        </button>
        <button class="tab-btn" onclick="switchTab('about')">
            <i class="fas fa-info-circle mr-1"></i> About
        </button>
        <button class="tab-btn" onclick="switchTab('stats')">
            <i class="fas fa-chart-line mr-1"></i> Stats
        </button>
        <button class="tab-btn" onclick="switchTab('services')">
            <i class="fas fa-cogs mr-1"></i> Services
        </button>
        <button class="tab-btn" onclick="switchTab('cta')">
            <i class="fas fa-bullhorn mr-1"></i> Call to Action
        </button>
    </div>

    {{-- ==================== TAB: HERO ==================== --}}
    <div id="hero" class="tab-content active">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="font-weight-bold">Hero Sections</h4>
            <button class="btn btn-amber btn-sm" data-toggle="modal" data-target="#addHeroModal">
                <i class="fas fa-plus mr-1"></i> Tambah Hero
            </button>
        </div>

        @forelse ($slides as $index => $slide)
            <div class="section-card">
                <div class="section-header">
                    <div>
                        <h6 class="font-weight-bold mb-0">
                            <span class="badge badge-warning mr-2">{{ $index + 1 }}</span>
                            {{ $slide['title'] }}
                        </h6>
                        @if ($slide['is_active'])
                            <small class="text-success"><i class="fas fa-check-circle mr-1"></i>Aktif</small>
                        @else
                            <small class="text-muted"><i class="fas fa-times-circle mr-1"></i>Nonaktif</small>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('admin.homepage.hero.destroy', $slide['id']) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>

                <form method="POST" action="{{ route('admin.homepage.hero.update', $slide['id']) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-group">
                                <label class="font-weight-bold small">Judul <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control"
                                       value="{{ $slide['title'] }}" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold small">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="3">{{ $slide['description'] }}</textarea>
                            </div>
                            {{-- ✅ Hanya 1 input icon_url --}}
                            <div class="form-group">
                                <label class="font-weight-bold small">URL Icon <small class="text-muted">(opsional)</small></label>
                                <input type="text" name="icon_url" class="form-control form-control-sm"
                                       value="{{ $slide['icon_url'] ?? '' }}"
                                       placeholder="dari Media Library">
                                <small class="text-muted">
                                    <a href="{{ route('admin.media') }}" target="_blank">
                                        <i class="fas fa-external-link-alt mr-1"></i>Buka Media Library
                                    </a>
                                </small>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold small">Teks Tombol</label>
                                    <input type="text" name="button_text" class="form-control"
                                           value="{{ $slide['button_text'] }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold small">URL Tombol</label>
                                    <input type="text" name="button_url" class="form-control"
                                           value="{{ $slide['button_url'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input"
                                           id="hero-active-{{ $slide['id'] }}"
                                           name="is_active"
                                           {{ $slide['is_active'] ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="hero-active-{{ $slide['id'] }}">
                                        Tampilkan di website
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <label class="font-weight-bold small">Preview</label>
                            <div class="bg-preview mb-3" id="preview-{{ $slide['id'] }}"
                                 style="background: {{ $slide['background_type'] === 'color' ? $slide['background_value'] : 'url('.$slide['background_value'].') center/cover' }};">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold small">Tipe Background</label>
                                <select name="background_type" class="form-control form-control-sm"
                                        onchange="toggleHeroBg(this, {{ $slide['id'] }})">
                                    <option value="color" {{ $slide['background_type'] === 'color' ? 'selected' : '' }}>Warna</option>
                                    <option value="image" {{ $slide['background_type'] === 'image' ? 'selected' : '' }}>Gambar</option>
                                </select>
                            </div>

                            {{-- Input Warna --}}
                            <div class="form-group" id="color-input-{{ $slide['id'] }}"
                                 style="{{ $slide['background_type'] === 'image' ? 'display:none' : '' }}">
                                <label class="font-weight-bold small">Warna</label>
                                <input type="color" name="background_value"
                                       class="form-control p-1" style="height:40px;"
                                       value="{{ $slide['background_type'] === 'color' ? $slide['background_value'] : '#D1D5DB' }}"
                                       oninput="syncHeroPreview(this, {{ $slide['id'] }})"
                                       {{ $slide['background_type'] === 'image' ? 'disabled' : '' }}>
                            </div>

                            {{-- Input Gambar --}}
                            <div class="form-group" id="image-input-{{ $slide['id'] }}"
                                 style="{{ $slide['background_type'] === 'color' ? 'display:none' : '' }}">
                                <label class="font-weight-bold small">URL Gambar</label>
                                <input type="text" name="background_value"
                                       class="form-control form-control-sm"
                                       value="{{ $slide['background_type'] === 'image' ? $slide['background_value'] : '' }}"
                                       placeholder="dari Media Library"
                                       oninput="syncHeroPreviewImage(this, {{ $slide['id'] }})"
                                       {{ $slide['background_type'] === 'color' ? 'disabled' : '' }}>
                                <small class="text-muted">
                                    <a href="{{ route('admin.media') }}" target="_blank">Buka Media Library</a>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-amber btn-sm">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-image"></i>
                <p>Belum ada hero section</p>
                <button class="btn btn-amber btn-sm mt-3" data-toggle="modal" data-target="#addHeroModal">
                    <i class="fas fa-plus mr-1"></i> Tambah Hero
                </button>
            </div>
        @endforelse
    </div>

    {{-- ==================== TAB: ABOUT ==================== --}}
    <div id="about" class="tab-content">
        <div class="section-card">
            <h5 class="font-weight-bold mb-1">Tentang Kami</h5>
            <p class="text-muted small mb-4">Konten section Tentang Kami di homepage.</p>

            <form method="POST"
                action="{{ $about ? route('admin.homepage.about.update', $about['id']) : route('admin.homepage.about.store') }}">
                @csrf

                @if($about)
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-lg-12">

                        <div class="form-group">
                            <label class="font-weight-bold">Judul</label>
                            <input type="text"
                                name="title"
                                class="form-control"
                                value="{{ $about['title'] ?? '' }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Deskripsi</label>
                            <textarea name="description"
                                    class="form-control"
                                    rows="5">{{ $about['description'] ?? '' }}</textarea>
                        </div>

                        <label class="font-weight-bold">Galeri About (6 Foto)</label>
                        <small class="text-muted d-block mb-3">
                            Foto akan digunakan pada section Tentang Kami.
                        </small>

                        <div class="row">
                            @for ($i = 1; $i <= 6; $i++)
                                <div class="col-md-4 mb-4">
                                    <label class="small font-weight-bold">
                                        Gambar {{ $i }}
                                    </label>

                                    <div class="img-preview mb-2"
                                        id="about-img-preview-{{ $i }}"
                                        style="
                                            height:150px;
                                            {{ !empty($about['image_'.$i] ?? null)
                                                ? 'background-image:url(\''.$about['image_'.$i].'\');
                                                background-size:cover;
                                                background-position:center;'
                                                : '' }}
                                        ">

                                        @if(empty($about['image_'.$i] ?? null))
                                            <small>Belum ada</small>
                                        @endif
                                    </div>

                                    <input type="text"
                                        name="image_{{ $i }}"
                                        class="form-control form-control-sm"
                                        value="{{ $about['image_'.$i] ?? '' }}"
                                        placeholder="URL dari Media Library"
                                        oninput="updatePreviewAbout(this, {{ $i }})">
                                </div>
                            @endfor
                        </div>

                        <small class="text-muted">
                            <a href="{{ route('admin.media') }}" target="_blank">
                                <i class="fas fa-external-link-alt mr-1"></i>
                                Buka Media Library
                            </a>
                        </small>

                    </div>
                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-amber btn-sm">
                        <i class="fas fa-save mr-1"></i>
                        {{ $about ? 'Simpan' : 'Buat' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ==================== TAB: STATS ==================== --}}
    <div id="stats" class="tab-content">
        <div class="section-card">
            <h5 class="font-weight-bold mb-1">Statistik</h5>
            <p class="text-muted small mb-4">
                Data statistik otomatis dari database — tidak perlu input manual.
            </p>

            <div class="row">
                @foreach ($stats ?? [] as $stat)
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-4 text-center">
                            <h3 class="font-weight-bold text-warning" style="font-size: 2.5rem;">
                                {{ $stat['value'] }}
                            </h3>
                            <p class="text-muted small font-weight-bold text-uppercase mb-0">
                                {{ $stat['label'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="alert alert-info mt-3 mb-0 small">
                <i class="fas fa-info-circle mr-1"></i>
                Stats diambil otomatis: Request Meeting & Meeting Selesai dari tabel meeting,
                Tenaga Profesional dari tabel Tim Kami, Mitra Kolaborasi dari tabel Client Partners.
            </div>
        </div>
    </div>

    {{-- ==================== TAB: SERVICES ==================== --}}
    <div id="services" class="tab-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="font-weight-bold">Layanan / Produk</h4>
            <button class="btn btn-amber btn-sm" data-toggle="modal" data-target="#addServiceModal">
                <i class="fas fa-plus mr-1"></i> Tambah Layanan
            </button>
        </div>

        @forelse ($services as $service)
            <div class="section-card">
                <div class="section-header">
                    <div>
                        <h6 class="font-weight-bold mb-0">{{ $service['name'] }}</h6>
                        <small class="text-muted">{{ \Illuminate\Support\Str::limit($service['description'] ?? '', 60) }}</small>
                    </div>
                    <form method="POST" action="{{ route('admin.homepage.services.destroy', $service['id']) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>

                <form method="POST" action="{{ route('admin.homepage.services.update', $service['id']) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="font-weight-bold small">Nama Layanan</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{ $service['name'] }}" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold small">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="2">{{ $service['description'] }}</textarea>
                            </div>

                            {{-- 4 Foto Collage --}}
                            <label class="font-weight-bold small">4 Foto Collage</label>
                            <div class="row mt-2">
                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="col-md-6 mb-3">
                                        <label class="small text-muted">Foto {{ $i }}</label>
                                        <div class="img-preview mb-1"
                                             id="service-img-{{ $service['id'] }}-{{ $i }}"
                                             style="height:80px;{{ !empty($service['image_'.$i]) ? 'background-image:url(\''.$service['image_'.$i].'\');background-size:cover;background-position:center;' : '' }}">
                                            @if (empty($service['image_'.$i]))
                                                <small>Belum ada</small>
                                            @endif
                                        </div>
                                        <input type="text"
                                               name="image_{{ $i }}"
                                               class="form-control form-control-sm"
                                               value="{{ $service['image_'.$i] ?? '' }}"
                                               placeholder="URL dari Media Library"
                                               oninput="updateServiceImg(this, {{ $service['id'] }}, {{ $i }})">
                                    </div>
                                @endfor
                            </div>
                            <small class="text-muted mb-3 d-block">
                                <a href="{{ route('admin.media') }}" target="_blank">
                                    <i class="fas fa-external-link-alt mr-1"></i>Buka Media Library
                                </a>
                            </small>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="font-weight-bold small">Urutan</label>
                                    <input type="number" name="order" class="form-control form-control-sm"
                                           value="{{ $service['order'] }}" min="0">
                                </div>
                                <div class="form-group col-md-8 d-flex align-items-end">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="service-active-{{ $service['id'] }}"
                                               name="is_active"
                                               {{ $service['is_active'] ? 'checked' : '' }}>
                                        <label class="custom-control-label"
                                               for="service-active-{{ $service['id'] }}">Tampilkan</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Icon --}}
                        <div class="col-lg-4">
                            <label class="font-weight-bold small">URL Icon <small class="text-muted">(opsional)</small></label>
                            <div class="img-preview mb-1"
                                 id="service-icon-{{ $service['id'] }}"
                                 style="height:100px;{{ !empty($service['icon_url']) ? 'background-image:url(\''.$service['icon_url'].'\');background-size:contain;background-repeat:no-repeat;background-position:center;' : '' }}">
                                @if (empty($service['icon_url']))
                                    <small>Belum ada icon</small>
                                @endif
                            </div>
                            <input type="text" name="icon_url"
                                   class="form-control form-control-sm mt-1"
                                   value="{{ $service['icon_url'] ?? '' }}"
                                   placeholder="dari Media Library"
                                   oninput="updatePreview(this, 'service-icon-{{ $service['id'] }}')">
                            <small class="text-muted">
                                <a href="{{ route('admin.media') }}" target="_blank">Buka Media Library</a>
                            </small>
                        </div>
                    </div>

                    <div class="text-right mt-2">
                        <button type="submit" class="btn btn-amber btn-sm">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-cogs"></i>
                <p>Belum ada layanan</p>
                <button class="btn btn-amber btn-sm mt-3" data-toggle="modal" data-target="#addServiceModal">
                    <i class="fas fa-plus mr-1"></i> Tambah Layanan
                </button>
            </div>
        @endforelse
    </div>

    {{-- ==================== TAB: CTA ==================== --}}
    <div id="cta" class="tab-content">
        <div class="section-card">
            <h4 class="font-weight-bold mb-3">Call to Action</h4>

            @if ($cta)
                <form method="POST" action="{{ route('admin.homepage.cta.update', $cta['id']) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="font-weight-bold">Judul</label>
                        <input type="text" name="title" class="form-control"
                               value="{{ $cta['title'] }}" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3">{{ $cta['description'] }}</textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Teks Tombol</label>
                            <input type="text" name="button_text" class="form-control"
                                   value="{{ $cta['button_text'] }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">URL Tombol</label>
                            <input type="text" name="button_url" class="form-control"
                                   value="{{ $cta['button_url'] }}">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-amber btn-sm">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                    </div>
                </form>
            @else
                <form method="POST" action="{{ route('admin.homepage.cta.store') }}">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold">Judul</label>
                        <input type="text" name="title" class="form-control"
                               placeholder="Anda Berminat?" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3"
                                  placeholder="Deskripsi call to action..."></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Teks Tombol</label>
                            <input type="text" name="button_text" class="form-control"
                                   placeholder="Hubungi Kami">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">URL Tombol</label>
                            <input type="text" name="button_url" class="form-control"
                                   placeholder="/hubungi-kami">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-amber btn-sm">
                            <i class="fas fa-save mr-1"></i> Buat
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>

</div>
</div>

{{-- Modal Tambah Hero --}}
<div class="modal fade" id="addHeroModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Tambah Hero Section</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.homepage.hero.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Judul</label>
                        <input type="text" name="title" class="form-control" placeholder="Judul hero" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">URL Icon <small class="text-muted">(opsional)</small></label>
                        <input type="text" name="icon_url" class="form-control" placeholder="dari Media Library">
                        <small class="text-muted">
                            <a href="{{ route('admin.media') }}" target="_blank">Buka Media Library</a>
                        </small>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Teks Tombol</label>
                            <input type="text" name="button_text" class="form-control" placeholder="Hubungi Kami">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">URL Tombol</label>
                            <input type="text" name="button_url" class="form-control" placeholder="/hubungi-kami">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Tipe Background</label>
                        <select id="new-hero-bg-type" name="background_type" class="form-control"
                                onchange="toggleNewHeroBg(this)">
                            <option value="color">Warna Solid</option>
                            <option value="image">Gambar (URL)</option>
                        </select>
                    </div>
                    <div id="new-hero-color" class="form-group">
                        <label class="font-weight-bold">Warna</label>
                        <input type="color" name="background_value" id="new-hero-color-input"
                               class="form-control p-1" style="height:40px;" value="#D1D5DB">
                    </div>
                    <div id="new-hero-image" class="form-group" style="display:none;">
                        <label class="font-weight-bold">URL Gambar</label>
                        <input type="text" name="background_value_image" id="new-hero-image-input"
                               class="form-control" placeholder="dari Media Library">
                        <small class="text-muted">
                            <a href="{{ route('admin.media') }}" target="_blank">Buka Media Library</a>
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-amber btn-sm" onclick="return prepareNewHeroSubmit()">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Tambah Service --}}
<div class="modal fade" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Tambah Layanan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.homepage.services.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Layanan</label>
                        <input type="text" name="name" class="form-control" placeholder="Nama layanan" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi layanan..."></textarea>
                    </div>

                    {{-- 4 Foto Collage --}}
                    <label class="font-weight-bold">4 Foto Collage</label>
                    <div class="row mt-2">
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted">Foto {{ $i }}</label>
                                <input type="text" name="image_{{ $i }}"
                                       class="form-control form-control-sm"
                                       placeholder="URL dari Media Library">
                            </div>
                        @endfor
                    </div>
                    <small class="text-muted mb-3 d-block">
                        <a href="{{ route('admin.media') }}" target="_blank">
                            <i class="fas fa-external-link-alt mr-1"></i>Buka Media Library
                        </a>
                    </small>

                    <div class="form-group">
                        <label class="font-weight-bold">URL Icon <small class="text-muted">(opsional)</small></label>
                        <input type="text" name="icon_url" class="form-control" placeholder="dari Media Library">
                        <small class="text-muted">
                            <a href="{{ route('admin.media') }}" target="_blank">Buka Media Library</a>
                        </small>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Urutan</label>
                        <input type="number" name="order" class="form-control" value="0" min="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-amber btn-sm">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function switchTab(tabName) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
        document.getElementById(tabName).classList.add('active');
        event.target.classList.add('active');
    }

    // Toggle background type — edit hero
    function toggleHeroBg(select, id) {
        const colorInput = document.getElementById('color-input-' + id);
        const imageInput = document.getElementById('image-input-' + id);
        const colorField = colorInput.querySelector('input');
        const imageField = imageInput.querySelector('input');
        const preview = document.getElementById('preview-' + id);

        if (select.value === 'color') {
            colorInput.style.display = 'block';
            imageInput.style.display = 'none';
            colorField.disabled = false;
            imageField.disabled = true;
            preview.style.background = colorField.value;
        } else {
            colorInput.style.display = 'none';
            imageInput.style.display = 'block';
            colorField.disabled = true;
            imageField.disabled = false;
            if (imageField.value) {
                preview.style.background = 'url(' + imageField.value + ') center/cover';
            } else {
                preview.style.background = '#eee';
            }
        }
    }

    function syncHeroPreview(input, id) {
        document.getElementById('preview-' + id).style.background = input.value;
    }

    function syncHeroPreviewImage(input, id) {
        const preview = document.getElementById('preview-' + id);
        preview.style.background = input.value ? 'url(' + input.value + ') center/cover' : '#eee';
    }

    // Toggle background type — modal tambah hero
    function toggleNewHeroBg(select) {
        document.getElementById('new-hero-color').style.display = select.value === 'color' ? 'block' : 'none';
        document.getElementById('new-hero-image').style.display = select.value === 'image' ? 'block' : 'none';
    }

    function prepareNewHeroSubmit() {
        const type = document.getElementById('new-hero-bg-type').value;
        const colorField = document.getElementById('new-hero-color-input');
        const imageField = document.getElementById('new-hero-image-input');
        if (type === 'color') {
            colorField.setAttribute('name', 'background_value');
            imageField.removeAttribute('name');
        } else {
            imageField.setAttribute('name', 'background_value');
            colorField.removeAttribute('name');
        }
        return true;
    }

    // Preview About collage
    function updatePreviewAbout(input, index) {
        const preview = document.getElementById('about-img-preview-' + index);
        if (input.value) {
            preview.style.backgroundImage = "url('" + input.value + "')";
            preview.style.backgroundSize = 'cover';
            preview.style.backgroundPosition = 'center';
            preview.textContent = '';
        } else {
            preview.style.backgroundImage = 'none';
            preview.textContent = 'Belum ada';
        }
    }

    // Preview Service collage
    function updateServiceImg(input, serviceId, index) {
        const preview = document.getElementById('service-img-' + serviceId + '-' + index);
        if (input.value) {
            preview.style.backgroundImage = "url('" + input.value + "')";
            preview.style.backgroundSize = 'cover';
            preview.style.backgroundPosition = 'center';
            preview.textContent = '';
        } else {
            preview.style.backgroundImage = 'none';
            preview.textContent = 'Belum ada';
        }
    }

    // Preview umum (gambar utama about, icon service)
    function updatePreview(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.value) {
            preview.style.backgroundImage = "url('" + input.value + "')";
            preview.style.backgroundSize = 'cover';
            preview.style.backgroundPosition = 'center';
            preview.textContent = '';
        } else {
            preview.style.backgroundImage = 'none';
            preview.textContent = 'Belum ada gambar';
        }
    }
</script>
@endpush