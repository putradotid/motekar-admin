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
            <h1 class="h3 mb-0 text-gray-800">Edit Testimoni</h1>
            <p class="text-muted small">Edit and manage content displayed on the Testimoni page.</p>
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
        <button class="tab-btn" onclick="switchTab('featured')">
            <i class="fas fa-users mr-1"></i> Featured Customers
        </button>
        <button class="tab-btn" onclick="switchTab('testimonials')">
            <i class="fas fa-comment-dots mr-1"></i> Testimonials
        </button>
        <button class="tab-btn" onclick="switchTab('partners')">
            <i class="fas fa-handshake mr-1"></i> Client & Partners
        </button>
    </div>

    {{-- ==================== TAB: HERO ==================== --}}
    <div id="hero" class="tab-content active">
        <div class="section-card">
            <h5 class="font-weight-bold mb-3">Section 1 — Judul Halaman</h5>
            <form method="POST"
                  action="{{ $hero ? route('admin.testimoni.hero.update', $hero['id']) : route('admin.testimoni.hero.store') }}">
                @csrf
                @if ($hero) @method('PUT') @endif

                <div class="form-group">
                    <label class="font-weight-bold small">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control"
                           value="{{ $hero['title'] ?? 'Pelanggan Kami' }}" required>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold small">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3"
                              placeholder="Deskripsi singkat halaman...">{{ $hero['description'] ?? '' }}</textarea>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-amber btn-sm">
                        <i class="fas fa-save mr-1"></i> {{ $hero ? 'Simpan' : 'Buat' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ==================== TAB: FEATURED CUSTOMERS ==================== --}}
    <div id="featured" class="tab-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="font-weight-bold mb-0">Featured Customers — Grid di Hero</h5>
            <button class="btn btn-amber btn-sm" data-toggle="modal" data-target="#addFeaturedModal">
                <i class="fas fa-plus mr-1"></i> Tambah
            </button>
        </div>

        @if (count($featured_customers) > 0)
            <div class="row">
                @foreach ($featured_customers as $customer)
                    <div class="col-md-3 mb-3">
                        <div class="section-card h-100">

                            {{-- ✅ Foto Featured Customer — media picker --}}
                            @include('layouts.partials.media-input', [
                                'name'    => 'photo',
                                'value'   => $customer['photo'] ?? '',
                                'label'   => 'Foto',
                                'inputId' => 'fc-photo-' . $customer['id'],
                                'height'  => '120px',
                            ])

                            <form method="POST"
                                  action="{{ route('admin.testimoni.featured.update', $customer['id']) }}">
                                @csrf
                                @method('PUT')

                                {{-- Hidden input foto dari picker --}}
                                <input type="hidden" name="photo" id="fc-photo-val-{{ $customer['id'] }}"
                                       value="{{ $customer['photo'] ?? '' }}">

                                <div class="form-group mb-2">
                                    <label class="font-weight-bold small">Nama</label>
                                    <input type="text" name="name" class="form-control form-control-sm"
                                           value="{{ $customer['name'] }}" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold small">Jabatan</label>
                                    <input type="text" name="designation" class="form-control form-control-sm"
                                           value="{{ $customer['designation'] }}"
                                           placeholder="CEO, PT Motekar">
                                </div>
                                <div class="form-row align-items-center mb-2">
                                    <div class="col-6">
                                        <input type="number" name="order"
                                               class="form-control form-control-sm"
                                               value="{{ $customer['order'] }}" min="0"
                                               placeholder="Urutan">
                                    </div>
                                    <div class="col-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="fc-active-{{ $customer['id'] }}"
                                                   name="is_active"
                                                   {{ $customer['is_active'] ? 'checked' : '' }}>
                                            <label class="custom-control-label small"
                                                   for="fc-active-{{ $customer['id'] }}">Aktif</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-amber btn-sm btn-block">
                                    <i class="fas fa-save mr-1"></i> Simpan
                                </button>
                            </form>

                            <form method="POST"
                                  action="{{ route('admin.testimoni.featured.destroy', $customer['id']) }}"
                                  class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger btn-block"
                                        onclick="return confirm('Hapus?')">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <p>Belum ada featured customer</p>
                <button class="btn btn-amber btn-sm mt-3" data-toggle="modal" data-target="#addFeaturedModal">
                    <i class="fas fa-plus mr-1"></i> Tambah
                </button>
            </div>
        @endif
    </div>

    {{-- ==================== TAB: TESTIMONIALS ==================== --}}
    <div id="testimonials" class="tab-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="font-weight-bold mb-0">Section 2 — Testimoni Pelanggan</h5>
            <button class="btn btn-amber btn-sm" data-toggle="modal" data-target="#addTestimonialModal">
                <i class="fas fa-plus mr-1"></i> Tambah Testimoni
            </button>
        </div>

        @forelse ($testimonials as $item)
            <div class="section-card">
                <div class="section-header">
                    <div>
                        <h6 class="font-weight-bold mb-0">{{ $item['name'] }}</h6>
                        @if ($item['is_active'])
                            <small class="text-success"><i class="fas fa-check-circle mr-1"></i>Aktif</small>
                        @else
                            <small class="text-muted"><i class="fas fa-times-circle mr-1"></i>Nonaktif</small>
                        @endif
                    </div>
                    <form method="POST"
                          action="{{ route('admin.testimoni.testimonials.destroy', $item['id']) }}"
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Hapus?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>

                <form method="POST" action="{{ route('admin.testimoni.testimonials.update', $item['id']) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="font-weight-bold small">Headline / Kutipan</label>
                                <textarea name="title" class="form-control" rows="2" required>{{ $item['title'] }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold small">Ulasan Lengkap</label>
                                <textarea name="description" class="form-control" rows="4" required>{{ $item['description'] }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label class="font-weight-bold small">Nama</label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{ $item['name'] }}" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="font-weight-bold small">Akun Sosmed</label>
                                    <input type="text" name="social_handle" class="form-control"
                                           value="{{ $item['social_handle'] }}" placeholder="@username">
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="font-weight-bold small">Urutan</label>
                                    <input type="number" name="order" class="form-control"
                                           value="{{ $item['order'] }}" min="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input"
                                           id="testi-active-{{ $item['id'] }}"
                                           name="is_active"
                                           {{ $item['is_active'] ? 'checked' : '' }}>
                                    <label class="custom-control-label"
                                           for="testi-active-{{ $item['id'] }}">Tampilkan</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            {{-- ✅ Foto Testimoni — media picker --}}
                            @include('layouts.partials.media-input', [
                                'name'    => 'photo',
                                'value'   => $item['photo'] ?? '',
                                'label'   => 'Foto',
                                'inputId' => 'testi-photo-' . $item['id'],
                                'height'  => '140px',
                            ])
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
                <i class="fas fa-comment-dots"></i>
                <p>Belum ada testimoni</p>
                <button class="btn btn-amber btn-sm mt-3" data-toggle="modal" data-target="#addTestimonialModal">
                    <i class="fas fa-plus mr-1"></i> Tambah Testimoni
                </button>
            </div>
        @endforelse
    </div>

    {{-- ==================== TAB: CLIENT & PARTNERS ==================== --}}
    <div id="partners" class="tab-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="font-weight-bold mb-0">Section 3 — Client & Partners</h5>
            <button class="btn btn-amber btn-sm" data-toggle="modal" data-target="#addPartnerModal">
                <i class="fas fa-plus mr-1"></i> Tambah Logo
            </button>
        </div>

        @if (count($partners) > 0)
            <div class="row">
                @foreach ($partners as $partner)
                    <div class="col-md-3 mb-3">
                        <div class="section-card h-100">

                            {{-- ✅ Logo Partner — media picker --}}
                            @include('layouts.partials.media-input', [
                                'name'    => 'logo_image',
                                'value'   => $partner['logo_image'] ?? '',
                                'label'   => 'Logo',
                                'inputId' => 'partner-logo-' . $partner['id'],
                                'height'  => '80px',
                                'required' => true,
                            ])

                            <form method="POST"
                                  action="{{ route('admin.testimoni.partners.update', $partner['id']) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-2">
                                    <label class="font-weight-bold small">Nama</label>
                                    <input type="text" name="name" class="form-control form-control-sm"
                                           value="{{ $partner['name'] }}"
                                           placeholder="Nama perusahaan (opsional)">
                                </div>
                                <div class="form-row align-items-center mb-2">
                                    <div class="col-6">
                                        <input type="number" name="order"
                                               class="form-control form-control-sm"
                                               value="{{ $partner['order'] }}" min="0"
                                               placeholder="Urutan">
                                    </div>
                                    <div class="col-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="partner-active-{{ $partner['id'] }}"
                                                   name="is_active"
                                                   {{ $partner['is_active'] ? 'checked' : '' }}>
                                            <label class="custom-control-label small"
                                                   for="partner-active-{{ $partner['id'] }}">Aktif</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-amber btn-sm btn-block">
                                    <i class="fas fa-save mr-1"></i> Simpan
                                </button>
                            </form>

                            <form method="POST"
                                  action="{{ route('admin.testimoni.partners.destroy', $partner['id']) }}"
                                  class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger btn-block"
                                        onclick="return confirm('Hapus?')">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-handshake"></i>
                <p>Belum ada client/partner</p>
                <button class="btn btn-amber btn-sm mt-3" data-toggle="modal" data-target="#addPartnerModal">
                    <i class="fas fa-plus mr-1"></i> Tambah Logo
                </button>
            </div>
        @endif
    </div>

</div>
</div>

{{-- Modal Tambah Testimoni --}}
<div class="modal fade" id="addTestimonialModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Tambah Testimoni</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.testimoni.testimonials.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Headline / Kutipan</label>
                        <textarea name="title" class="form-control" rows="2"
                                  placeholder="Kutipan singkat dari pelanggan..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Ulasan Lengkap</label>
                        <textarea name="description" class="form-control" rows="4"
                                  placeholder="Ulasan lengkap..." required></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Nama</label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="Andi Pratama" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Akun Sosmed</label>
                            <input type="text" name="social_handle" class="form-control"
                                   placeholder="@andipratama">
                        </div>
                    </div>

                    {{-- ✅ Foto — media picker --}}
                    @include('layouts.partials.media-input', [
                        'name'    => 'photo',
                        'value'   => '',
                        'label'   => 'Foto',
                        'inputId' => 'new-testi-photo',
                        'height'  => '100px',
                    ])

                    <div class="form-group">
                        <label class="font-weight-bold">Urutan</label>
                        <input type="number" name="order" class="form-control"
                               value="{{ count($testimonials) + 1 }}" min="0">
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

{{-- Modal Tambah Partner --}}
<div class="modal fade" id="addPartnerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Tambah Client / Partner</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.testimoni.partners.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Perusahaan <small class="text-muted">(opsional)</small></label>
                        <input type="text" name="name" class="form-control" placeholder="Nama perusahaan">
                    </div>

                    {{-- ✅ Logo — media picker --}}
                    @include('layouts.partials.media-input', [
                        'name'     => 'logo_image',
                        'value'    => '',
                        'label'    => 'Logo Perusahaan',
                        'inputId'  => 'new-partner-logo',
                        'height'   => '80px',
                        'required' => true,
                    ])

                    <div class="form-group">
                        <label class="font-weight-bold">Urutan</label>
                        <input type="number" name="order" class="form-control"
                               value="{{ count($partners) + 1 }}" min="0">
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

{{-- Modal Tambah Featured Customer --}}
<div class="modal fade" id="addFeaturedModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Tambah Featured Customer</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.testimoni.featured.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control"
                               placeholder="John Doe" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Jabatan</label>
                        <input type="text" name="designation" class="form-control"
                               placeholder="CEO, PT Motekar">
                    </div>

                    {{-- ✅ Foto — media picker --}}
                    @include('layouts.partials.media-input', [
                        'name'    => 'photo',
                        'value'   => '',
                        'label'   => 'Foto',
                        'inputId' => 'new-featured-photo',
                        'height'  => '120px',
                    ])

                    <div class="form-group">
                        <label class="font-weight-bold">Urutan</label>
                        <input type="number" name="order" class="form-control"
                               value="{{ count($featured_customers) + 1 }}" min="0">
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
</script>
@endpush