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
    .img-preview {
        width: 100%;
        height: 100px;
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
            <h1 class="h3 mb-0 text-gray-800">Edit Produk & Layanan</h1>
            <p class="text-muted small">Edit and manage content displayed on the Produk & Layanan page.</p>
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
            <i class="fas fa-heading mr-1"></i> Hero
        </button>
        <button class="tab-btn" onclick="switchTab('products')">
            <i class="fas fa-box mr-1"></i> Produk
        </button>
        <button class="tab-btn" onclick="switchTab('services')">
            <i class="fas fa-concierge-bell mr-1"></i> Layanan
        </button>
    </div>

    {{-- ==================== TAB: HERO (Section 1) ==================== --}}
    <div id="hero" class="tab-content active">
        <div class="section-card">
            <h5 class="font-weight-bold mb-3">Section 1 — Judul Halaman</h5>

            <form method="POST"
                  action="{{ $hero ? route('admin.produk-layanan.hero.update', $hero['id']) : route('admin.produk-layanan.hero.store') }}">
                @csrf
                @if ($hero)
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label class="font-weight-bold small">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ $hero['title'] ?? 'Produk Kami' }}" required>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold small">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat halaman...">{{ $hero['description'] ?? '' }}</textarea>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-amber btn-sm">
                        <i class="fas fa-save mr-1"></i> {{ $hero ? 'Simpan' : 'Buat' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ==================== TAB: PRODUCTS (Section 2) ==================== --}}
    <div id="products" class="tab-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="font-weight-bold mb-0">Section 2 — Produk Kami</h5>
            <button class="btn btn-amber btn-sm" data-toggle="modal" data-target="#addProductModal">
                <i class="fas fa-plus mr-1"></i> Tambah Produk
            </button>
        </div>

        @forelse ($products as $product)
            <div class="section-card">
                <div class="section-header">
                    <div>
                        <h6 class="font-weight-bold mb-0">{{ $product['title'] }}</h6>
                        @if ($product['is_active'])
                            <small class="text-success"><i class="fas fa-check-circle mr-1"></i>Aktif</small>
                        @else
                            <small class="text-muted"><i class="fas fa-times-circle mr-1"></i>Nonaktif</small>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('admin.produk-layanan.products.destroy', $product['id']) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>

                <form method="POST" action="{{ route('admin.produk-layanan.products.update', $product['id']) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="font-weight-bold small">Judul</label>
                                <input type="text" name="title" class="form-control" value="{{ $product['title'] }}" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold small">Deskripsi Singkat <small class="text-muted">(tampil di card)</small></label>
                                <textarea name="description" class="form-control" rows="2">{{ $product['description'] }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold small">Deskripsi Lengkap <small class="text-muted">(tampil di popup)</small></label>
                                <textarea name="detail_description" class="form-control" rows="3">{{ $product['detail_description'] }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="font-weight-bold small">Urutan</label>
                                    <input type="number" name="order" class="form-control form-control-sm" value="{{ $product['order'] }}" min="0">
                                </div>
                                <div class="form-group col-md-8 d-flex align-items-end">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="product-active-{{ $product['id'] }}" name="is_active" {{ $product['is_active'] ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="product-active-{{ $product['id'] }}">Tampilkan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label class="font-weight-bold small">Gambar</label>
                            <div class="img-preview" id="product-preview-{{ $product['id'] }}"
                                 style="{{ !empty($product['image_url']) ? 'background-image:url(\''.$product['image_url'].'\')' : '' }}">
                                @if (empty($product['image_url']))
                                    Belum ada gambar
                                @endif
                            </div>
                            <input type="text" name="image_url" class="form-control form-control-sm"
                                   value="{{ $product['image_url'] }}" placeholder="dari Media Library"
                                   oninput="updatePreview(this, 'product-preview-{{ $product['id'] }}')">
                            <small class="text-muted"><a href="{{ route('admin.media') }}" target="_blank">Buka Media Library</a></small>
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
                <i class="fas fa-box"></i>
                <p>Belum ada produk</p>
                <button class="btn btn-amber btn-sm mt-3" data-toggle="modal" data-target="#addProductModal">
                    <i class="fas fa-plus mr-1"></i> Tambah Produk
                </button>
            </div>
        @endforelse
    </div>

    {{-- ==================== TAB: SERVICES (Section 3) ==================== --}}
    <div id="services" class="tab-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="font-weight-bold mb-0">Section 3 — Layanan Kami</h5>
            <button class="btn btn-amber btn-sm" data-toggle="modal" data-target="#addServiceModal">
                <i class="fas fa-plus mr-1"></i> Tambah Layanan
            </button>
        </div>

        @forelse ($services as $service)
            <div class="section-card">
                <div class="section-header">
                    <div>
                        <h6 class="font-weight-bold mb-0">{{ $service['title'] }}</h6>
                        @if ($service['is_active'])
                            <small class="text-success"><i class="fas fa-check-circle mr-1"></i>Aktif</small>
                        @else
                            <small class="text-muted"><i class="fas fa-times-circle mr-1"></i>Nonaktif</small>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('admin.produk-layanan.services.destroy', $service['id']) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>

                <form method="POST" action="{{ route('admin.produk-layanan.services.update', $service['id']) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="font-weight-bold small">Judul</label>
                                <input type="text" name="title" class="form-control" value="{{ $service['title'] }}" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold small">Deskripsi Singkat <small class="text-muted">(tampil di card)</small></label>
                                <textarea name="description" class="form-control" rows="2">{{ $service['description'] }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold small">Deskripsi Lengkap <small class="text-muted">(tampil di popup)</small></label>
                                <textarea name="detail_description" class="form-control" rows="3">{{ $service['detail_description'] }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="font-weight-bold small">Urutan</label>
                                    <input type="number" name="order" class="form-control form-control-sm" value="{{ $service['order'] }}" min="0">
                                </div>
                                <div class="form-group col-md-8 d-flex align-items-end">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="service-active-{{ $service['id'] }}" name="is_active" {{ $service['is_active'] ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="service-active-{{ $service['id'] }}">Tampilkan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label class="font-weight-bold small">Icon</label>
                            <div class="img-preview" id="service-preview-{{ $service['id'] }}"
                                 style="{{ !empty($service['icon_url']) ? 'background-image:url(\''.$service['icon_url'].'\')' : '' }}">
                                @if (empty($service['icon_url']))
                                    Belum ada icon
                                @endif
                            </div>
                            <input type="text" name="icon_url" class="form-control form-control-sm"
                                   value="{{ $service['icon_url'] }}" placeholder="dari Media Library"
                                   oninput="updatePreview(this, 'service-preview-{{ $service['id'] }}')">
                            <small class="text-muted"><a href="{{ route('admin.media') }}" target="_blank">Buka Media Library</a></small>
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
                <i class="fas fa-concierge-bell"></i>
                <p>Belum ada layanan</p>
                <button class="btn btn-amber btn-sm mt-3" data-toggle="modal" data-target="#addServiceModal">
                    <i class="fas fa-plus mr-1"></i> Tambah Layanan
                </button>
            </div>
        @endforelse
    </div>

</div>
</div>

{{-- Modal Tambah Produk --}}
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.produk-layanan.products.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Judul</label>
                        <input type="text" name="title" class="form-control" placeholder="Nama produk" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Deskripsi Singkat</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Tampil di card..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Deskripsi Lengkap</label>
                        <textarea name="detail_description" class="form-control" rows="3" placeholder="Tampil di popup..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">URL Gambar</label>
                        <input type="text" name="image_url" class="form-control" placeholder="dari Media Library">
                        <small class="text-muted"><a href="{{ route('admin.media') }}" target="_blank">Buka Media Library</a></small>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Urutan</label>
                        <input type="number" name="order" class="form-control" value="{{ count($products) + 1 }}" min="0">
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

{{-- Modal Tambah Layanan --}}
<div class="modal fade" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Tambah Layanan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.produk-layanan.services.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Judul</label>
                        <input type="text" name="title" class="form-control" placeholder="Nama layanan" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Deskripsi Singkat</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Tampil di card..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Deskripsi Lengkap</label>
                        <textarea name="detail_description" class="form-control" rows="3" placeholder="Tampil di popup..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">URL Icon</label>
                        <input type="text" name="icon_url" class="form-control" placeholder="dari Media Library">
                        <small class="text-muted"><a href="{{ route('admin.media') }}" target="_blank">Buka Media Library</a></small>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Urutan</label>
                        <input type="number" name="order" class="form-control" value="{{ count($services) + 1 }}" min="0">
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