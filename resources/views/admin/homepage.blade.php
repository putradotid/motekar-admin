@extends('layouts.admin')

@push('styles')
<style>
    .slide-card {
        border: 1px solid #e3e6f0;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 20px;
        background: #fff;
    }
    .slide-card-header {
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
    }
    .tab-nav {
        display: flex;
        gap: 4px;
        border-bottom: 2px solid #e3e6f0;
        margin-bottom: 24px;
    }
    .tab-nav a {
        padding: 8px 20px;
        border-radius: 6px 6px 0 0;
        font-size: 14px;
        font-weight: 500;
        color: #6e707e;
        text-decoration: none;
        border-bottom: 2px solid transparent;
        margin-bottom: -2px;
    }
    .tab-nav a.active {
        color: #FF8C00;
        border-bottom-color: #FF8C00;
        background: #fff8f0;
    }
    .color-preview {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        border: 1px solid #e3e6f0;
        flex-shrink: 0;
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
            <p class="text-muted small">Edit and manage content displayed on the homepage.</p>
        </div>
        <button class="btn btn-amber px-4" data-toggle="modal" data-target="#addSlideModal">
            <i class="fas fa-plus mr-1"></i> Tambah Hero
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- Tab Navigation --}}
    <div class="tab-nav">
        <a href="#" class="active">Hero</a>
        <a href="#">About</a>
        <a href="#">Stats</a>
        <a href="#">Services</a>
        <a href="#">Call to Action</a>
    </div>

    {{-- Hero Slides --}}
    @forelse ($slides as $index => $slide)
        <div class="slide-card shadow-sm">

            {{-- Header --}}
            <div class="slide-card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white mr-2"
                         style="width:28px;height:28px;background:#FF8C00;font-size:12px;flex-shrink:0;">
                        {{ $index + 1 }}
                    </div>
                    <h6 class="font-weight-bold mb-0">Hero Section {{ $index + 1 }}</h6>
                    @if (!$slide['is_active'])
                        <span class="badge badge-secondary ml-2">Nonaktif</span>
                    @else
                        <span class="badge badge-success ml-2">Aktif</span>
                    @endif
                </div>
                <form method="POST"
                      action="{{ route('admin.homepage.destroy', $slide['id']) }}"
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Hapus slide ini?')">
                        <i class="fas fa-trash mr-1"></i> Hapus
                    </button>
                </form>
            </div>

            {{-- Form langsung terbuka --}}
            <form method="POST"
                  action="{{ route('admin.homepage.update', $slide['id']) }}">
                @csrf
                <div class="row">

                    {{-- Kiri — konten --}}
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="font-weight-bold small">Main Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ $slide['title'] }}" required
                                   placeholder="Judul utama hero">
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold small">Subtitle / Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3"
                                      placeholder="Deskripsi singkat...">{{ $slide['description'] }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold small">Teks Tombol</label>
                                <input type="text" name="button_text" class="form-control"
                                       value="{{ $slide['button_text'] }}"
                                       placeholder="Contoh: Hubungi Kami">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold small">URL Tombol</label>
                                <input type="text" name="button_url" class="form-control"
                                       value="{{ $slide['button_url'] }}"
                                       placeholder="/hubungi-kami">
                            </div>
                        </div>
                    </div>

                    {{-- Kanan — background & preview --}}
                    <div class="col-md-5">

                        {{-- Preview --}}
                        <label class="font-weight-bold small">Preview Background</label>
                        <div class="bg-preview mb-3"
                             id="preview-{{ $slide['id'] }}"
                             style="
                                @if ($slide['background_type'] === 'color')
                                    background-color: {{ $slide['background_value'] }};
                                @else
                                    background-image: url('{{ $slide['background_value'] }}');
                                    background-size: cover;
                                    background-position: center;
                                @endif
                             ">
                            <span class="text-muted small"
                                  id="preview-text-{{ $slide['id'] }}">
                                {{ $slide['title'] }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold small">Tipe Background</label>
                            <select name="background_type" class="form-control form-control-sm"
                                    onchange="toggleBgInput(this, {{ $slide['id'] }})">
                                <option value="color"  {{ $slide['background_type'] === 'color'  ? 'selected' : '' }}>Warna Solid</option>
                                <option value="image"  {{ $slide['background_type'] === 'image'  ? 'selected' : '' }}>Gambar (URL)</option>
                            </select>
                        </div>

                        {{-- Input warna --}}
                        <div id="color-input-{{ $slide['id'] }}"
                             {{ $slide['background_type'] === 'image' ? 'style=display:none' : '' }}>
                            <label class="font-weight-bold small">Pilih Warna</label>
                            <div class="d-flex align-items-center" style="gap: 8px;">
                                <input type="color"
                                       class="p-0 border-0"
                                       style="width:38px;height:38px;cursor:pointer;"
                                       value="{{ $slide['background_type'] === 'color' ? $slide['background_value'] : '#D1D5DB' }}"
                                       oninput="syncColorEdit(this, {{ $slide['id'] }})">
                                <input type="text"
                                       name="background_value"
                                       id="bg-text-{{ $slide['id'] }}"
                                       class="form-control form-control-sm"
                                       value="{{ $slide['background_type'] === 'color' ? $slide['background_value'] : '#D1D5DB' }}"
                                       oninput="syncTextEdit(this, {{ $slide['id'] }})"
                                       placeholder="#D1D5DB">
                            </div>
                        </div>

                        {{-- Input gambar --}}
                        <div id="image-input-{{ $slide['id'] }}"
                             {{ $slide['background_type'] === 'color' ? 'style=display:none' : '' }}>
                            <label class="font-weight-bold small">URL Gambar</label>
                            <input type="text"
                                   name="background_value"
                                   class="form-control form-control-sm"
                                   value="{{ $slide['background_type'] === 'image' ? $slide['background_value'] : '' }}"
                                   placeholder="Salin URL dari Media Library"
                                   oninput="previewImage(this, {{ $slide['id'] }})">
                            <small class="text-muted">
                                <a href="{{ route('admin.media') }}" target="_blank">
                                    <i class="fas fa-external-link-alt mr-1"></i>Buka Media Library
                                </a>
                            </small>
                        </div>

                        {{-- Status --}}
                        <div class="form-group mt-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                       id="active-{{ $slide['id'] }}"
                                       name="is_active"
                                       {{ $slide['is_active'] ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold small"
                                       for="active-{{ $slide['id'] }}">
                                    Tampilkan di website
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Save button --}}
                <div class="d-flex justify-content-end mt-2 pt-3 border-top">
                    <button type="submit" class="btn btn-amber px-5">
                        <i class="fas fa-save mr-1"></i> Simpan Section {{ $index + 1 }}
                    </button>
                </div>

            </form>
        </div>
    @empty
        <div class="text-center text-muted py-5">
            <i class="fas fa-image fa-3x mb-3 d-block"></i>
            <p>Belum ada hero section. Klik "Tambah Hero" untuk memulai!</p>
            <button class="btn btn-amber px-4 mt-2"
                    data-toggle="modal" data-target="#addSlideModal">
                <i class="fas fa-plus mr-1"></i> Tambah Hero
            </button>
        </div>
    @endforelse

</div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="addSlideModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Tambah Hero Section</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.homepage.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label class="font-weight-bold small">Main Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control"
                                       placeholder="Judul utama" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold small">Subtitle</label>
                                <textarea name="description" class="form-control" rows="3"
                                          placeholder="Deskripsi..."></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold small">Teks Tombol</label>
                                    <input type="text" name="button_text" class="form-control"
                                           placeholder="Hubungi Kami">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold small">URL Tombol</label>
                                    <input type="text" name="button_url" class="form-control"
                                           placeholder="/hubungi-kami">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold small">Urutan</label>
                                <input type="number" name="order" class="form-control"
                                       value="{{ count($slides) + 1 }}" min="1">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="font-weight-bold small">Tipe Background</label>
                                <select name="background_type" class="form-control"
                                        onchange="toggleNewBg(this)">
                                    <option value="color">Warna Solid</option>
                                    <option value="image">Gambar (URL)</option>
                                </select>
                            </div>
                            <div id="new-color-input">
                                <label class="font-weight-bold small">Pilih Warna</label>
                                <div class="d-flex align-items-center" style="gap: 8px;">
                                    <input type="color" class="p-0 border-0"
                                           style="width:38px;height:38px;"
                                           value="#D1D5DB"
                                           oninput="document.getElementById('new-bg-text').value=this.value">
                                    <input type="text" name="background_value"
                                           id="new-bg-text" class="form-control"
                                           value="#D1D5DB" placeholder="#D1D5DB">
                                </div>
                            </div>
                            <div id="new-image-input" style="display:none;">
                                <label class="font-weight-bold small">URL Gambar</label>
                                <input type="text" name="background_value"
                                       class="form-control"
                                       placeholder="Salin URL dari Media Library">
                                <small class="text-muted">
                                    <a href="{{ route('admin.media') }}" target="_blank">
                                        Buka Media Library
                                    </a>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-amber px-4">
                        <i class="fas fa-plus mr-1"></i> Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Toggle bg type saat edit
    function toggleBgInput(select, id) {
        const colorInput = document.getElementById('color-input-' + id);
        const imageInput = document.getElementById('image-input-' + id);
        colorInput.style.display = select.value === 'color' ? 'block' : 'none';
        imageInput.style.display = select.value === 'image' ? 'block' : 'none';
    }

    // Sync color picker → text input + preview
    function syncColorEdit(picker, id) {
        document.getElementById('bg-text-' + id).value = picker.value;
        document.getElementById('preview-' + id).style.backgroundColor = picker.value;
        document.getElementById('preview-' + id).style.backgroundImage = 'none';
    }

    // Sync text input → preview
    function syncTextEdit(input, id) {
        const preview = document.getElementById('preview-' + id);
        preview.style.backgroundColor = input.value;
        preview.style.backgroundImage = 'none';
    }

    // Preview gambar dari URL
    function previewImage(input, id) {
        const preview = document.getElementById('preview-' + id);
        preview.style.backgroundImage = 'url(' + input.value + ')';
        preview.style.backgroundSize  = 'cover';
        preview.style.backgroundPosition = 'center';
        preview.style.backgroundColor = 'transparent';
    }

    // Toggle bg type di modal tambah
    function toggleNewBg(select) {
        document.getElementById('new-color-input').style.display =
            select.value === 'color' ? 'block' : 'none';
        document.getElementById('new-image-input').style.display =
            select.value === 'image' ? 'block' : 'none';
    }
</script>
@endpush