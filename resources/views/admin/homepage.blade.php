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
    .tab-nav button:hover:not(.active) { color: #495057; }

    .tab-content { display: none; }
    .tab-content.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

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

    {{-- tab hero --}}
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

                            {{-- Icon URL — pakai media picker --}}
                            @include('layouts.partials.media-input', [
                                'name'    => 'icon_url',
                                'value'   => $slide['icon_url'] ?? '',
                                'label'   => 'Icon (opsional)',
                                'inputId' => 'hero-icon-' . $slide['id'],
                                'height'  => '80px',
                                'hint'    => 'Icon kecil yang tampil di atas judul hero.',
                            ])

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
                            <label class="font-weight-bold small">Preview Background</label>
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

                            {{-- Input Gambar Background — pakai media picker --}}
                            <div id="image-input-{{ $slide['id'] }}"
                                 style="{{ $slide['background_type'] === 'color' ? 'display:none' : '' }}">
                                @include('layouts.partials.media-input', [
                                    'name'    => 'background_value',
                                    'value'   => $slide['background_type'] === 'image' ? $slide['background_value'] : '',
                                    'label'   => 'Gambar Background',
                                    'inputId' => 'hero-bg-' . $slide['id'],
                                    'height'  => '80px',
                                ])
                                {{-- Sync preview saat dipilih --}}
                                <script>
                                    document.getElementById('hero-bg-{{ $slide['id'] }}')
                                        ?.addEventListener('change', function() {
                                            document.getElementById('preview-{{ $slide['id'] }}').style.background =
                                                this.value ? 'url(' + this.value + ') center/cover' : '#eee';
                                        });
                                </script>
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

    {{-- tab about --}}
    <div id="about" class="tab-content">
        <div class="section-card">
            <h5 class="font-weight-bold mb-1">Tentang Kami</h5>
            <p class="text-muted small mb-4">Konten section Tentang Kami di homepage.</p>

            <form method="POST"
                action="{{ $about ? route('admin.homepage.about.update', $about['id']) : route('admin.homepage.about.store') }}">
                @csrf
                @if ($about) @method('PUT') @endif

                <div class="form-group">
                    <label class="font-weight-bold">Judul</label>
                    <input type="text" name="title" class="form-control"
                        value="{{ $about['title'] ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="5">{{ $about['description'] ?? '' }}</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        @include('layouts.partials.media-input', [
                            'name'    => 'image_url',
                            'value'   => $about['image_url'] ?? '',
                            'label'   => 'Gambar Utama (tampil besar di kanan)',
                            'inputId' => 'about-image-url',
                            'height'  => '160px',
                            'hint'    => 'Gambar besar yang tampil di kolom kanan section Tentang Kami.',
                        ])
                    </div>
                </div>

                {{-- 5 Foto Galeri --}}
                <label class="font-weight-bold">Galeri About (5 Foto)</label>
                <small class="text-muted d-block mb-3">
                    Foto kecil yang tampil di kolom kiri section Tentang Kami.
                </small>

                <div class="row">
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="col-md-4 mb-2">
                            @include('layouts.partials.media-input', [
                                'name'    => 'image_' . $i,
                                'value'   => $about['image_' . $i] ?? '',
                                'label'   => 'Foto ' . $i,
                                'inputId' => 'about-image-' . $i,
                                'height'  => '120px',
                            ])
                        </div>
                    @endfor
                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-amber btn-sm">
                        <i class="fas fa-save mr-1"></i> {{ $about ? 'Simpan' : 'Buat' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ==================== TAB: STATS ==================== --}}
    <div id="stats" class="tab-content">
        <div class="section-card">
            <h5 class="font-weight-bold mb-1">Statistik</h5>
            <p class="text-muted small mb-4">Data statistik otomatis dari database — tidak perlu input manual.</p>
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
                Stats diambil otomatis dari database.
            </div>
        </div>
    </div>

    {{-- ==================== TAB: SERVICES ==================== --}}
    <div id="services" class="tab-content">
        <div class="section-card">
            <h5 class="font-weight-bold mb-1">Section Layanan</h5>
            <p class="text-muted small mb-1">Judul, deskripsi, dan 4 gambar collage untuk section layanan di beranda.</p>
            <small class="text-muted d-block mb-4">
                <i class="fas fa-info-circle mr-1"></i>
                Hanya 4 layanan teratas yang tampil di beranda.
            </small>

            @php $ss = $service_section; @endphp

            <form method="POST"
                  action="{{ $ss ? route('admin.homepage.services.update', $ss['id']) : route('admin.homepage.services.store') }}">
                @csrf
                @if ($ss) @method('PUT') @endif

                <div class="form-group">
                    <label class="font-weight-bold small">Judul</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ $ss['title'] ?? 'Solusi & Layanan Kami' }}" required>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold small">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3">{{ $ss['description'] ?? '' }}</textarea>
                </div>

                <label class="font-weight-bold small">4 Foto Collage</label>
                <div class="row mt-2">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="col-md-6 mb-2">
                            {{-- Pakai media picker --}}
                            @include('layouts.partials.media-input', [
                                'name'    => 'image_' . $i,
                                'value'   => $ss['image_' . $i] ?? '',
                                'label'   => 'Foto ' . $i,
                                'inputId' => 'ss-image-' . $i,
                                'height'  => '100px',
                            ])
                        </div>
                    @endfor
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-amber btn-sm">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ==================== TAB: CTA ==================== --}}
    <div id="cta" class="tab-content">
        <div class="section-card">
            <h4 class="font-weight-bold mb-3">Call to Action</h4>

            @if ($cta)
                <form method="POST" action="{{ route('admin.homepage.cta.update', $cta['id']) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-lg-8">
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
                        </div>

                        <div class="col-lg-4">
                            @include('layouts.partials.media-input', [
                                'name'    => 'icon_url',
                                'value'   => $cta['icon_url'] ?? '',
                                'label'   => 'Icon / Gambar',
                                'inputId' => 'cta-icon-url',
                                'height'  => '120px',
                                'hint'    => 'Gambar/icon yang tampil di section CTA.',
                            ])
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
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="font-weight-bold">Judul</label>
                                <input type="text" name="title" class="form-control"
                                    placeholder="Anda Berminat?" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
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
                        </div>
                        <div class="col-lg-4">
                            @include('layouts.partials.media-input', [
                                'name'    => 'icon_url',
                                'value'   => '',
                                'label'   => 'Icon / Gambar',
                                'inputId' => 'cta-icon-url-new',
                                'height'  => '120px',
                                'hint'    => 'Gambar/icon yang tampil di section CTA.',
                            ])
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
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>

                    {{-- Icon URL --}}
                    @include('layouts.partials.media-input', [
                        'name'    => 'icon_url',
                        'value'   => '',
                        'label'   => 'Icon (opsional)',
                        'inputId' => 'new-hero-icon',
                        'height'  => '80px',
                    ])

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
                            <option value="image">Gambar</option>
                        </select>
                    </div>

                    {{-- Warna --}}
                    <div id="new-hero-color" class="form-group">
                        <label class="font-weight-bold">Warna</label>
                        <input type="color" name="background_value" id="new-hero-color-input"
                               class="form-control p-1" style="height:40px;" value="#D1D5DB">
                    </div>

                    {{-- Gambar Background --}}
                    <div id="new-hero-image" style="display:none;">
                        @include('layouts.partials.media-input', [
                            'name'    => 'background_value_image',
                            'value'   => '',
                            'label'   => 'Gambar Background',
                            'inputId' => 'new-hero-bg-image',
                            'height'  => '80px',
                        ])
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
        const colorField = colorInput.querySelector('input[type="color"]');
        const preview    = document.getElementById('preview-' + id);

        if (select.value === 'color') {
            colorInput.style.display = 'block';
            imageInput.style.display = 'none';
            colorField.disabled = false;
            preview.style.background = colorField.value;
        } else {
            colorInput.style.display = 'none';
            imageInput.style.display = 'block';
            colorField.disabled = true;
            const bgInput = document.getElementById('hero-bg-' + id);
            if (bgInput && bgInput.value) {
                preview.style.background = 'url(' + bgInput.value + ') center/cover';
            } else {
                preview.style.background = '#eee';
            }
        }
    }

    function syncHeroPreview(input, id) {
        document.getElementById('preview-' + id).style.background = input.value;
    }

    // Toggle background type — modal tambah hero
    function toggleNewHeroBg(select) {
        document.getElementById('new-hero-color').style.display = select.value === 'color' ? 'block' : 'none';
        document.getElementById('new-hero-image').style.display = select.value === 'image'  ? 'block' : 'none';
    }

    function prepareNewHeroSubmit() {
        const type       = document.getElementById('new-hero-bg-type').value;
        const colorField = document.getElementById('new-hero-color-input');
        const imageField = document.getElementById('new-hero-bg-image');
        if (type === 'color') {
            colorField.setAttribute('name', 'background_value');
            if (imageField) imageField.removeAttribute('name');
        } else {
            if (imageField) imageField.setAttribute('name', 'background_value');
            colorField.removeAttribute('name');
        }
        return true;
    }
</script>
@endpush