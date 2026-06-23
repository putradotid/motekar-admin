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

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Tim Kami</h1>
            <p class="text-muted small">Edit and manage content displayed on the Tim Kami page.</p>
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
        <button class="tab-btn" onclick="switchTab('leaders')">
            <i class="fas fa-crown mr-1"></i> The Leader
        </button>
        <button class="tab-btn" onclick="switchTab('client_support')">
            <i class="fas fa-headset mr-1"></i> Client Support
        </button>
        <button class="tab-btn" onclick="switchTab('developers')">
            <i class="fas fa-code mr-1"></i> Developer
        </button>
    </div>

    {{-- ==================== TAB: HERO ==================== --}}
    <div id="hero" class="tab-content active">
        <div class="section-card">
            <h5 class="font-weight-bold mb-1">Section 1 & 2 — Hero + Label</h5>
            <p class="text-muted small mb-4">Judul halaman, deskripsi, dan label section "Meet Our Team".</p>

            <form method="POST"
                  action="{{ $hero ? route('admin.tim-kami.hero.update', $hero['id']) : route('admin.tim-kami.hero.store') }}">
                @csrf
                @if ($hero) @method('PUT') @endif

                <div class="form-group">
                    <label class="font-weight-bold small">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control"
                           value="{{ $hero['title'] ?? 'Tim Kami' }}" required>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold small">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4"
                              placeholder="Deskripsi singkat halaman...">{{ $hero['description'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold small">Label Section 2</label>
                    <input type="text" name="section2_label" class="form-control"
                           value="{{ $hero['section2_label'] ?? 'Meet Our Team' }}"
                           placeholder="Meet Our Team">
                    <small class="text-muted">Teks besar yang tampil setelah hero (contoh: "Meet Our Team")</small>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-amber btn-sm">
                        <i class="fas fa-save mr-1"></i> {{ $hero ? 'Simpan' : 'Buat' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ==================== TAB: THE LEADER ==================== --}}
    <div id="leaders" class="tab-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="font-weight-bold mb-0">Section 3 — The Leader</h5>
            <button class="btn btn-amber btn-sm" data-toggle="modal"
                    data-target="#addMemberModal" onclick="setDivision('leader')">
                <i class="fas fa-plus mr-1"></i> Tambah Leader
            </button>
        </div>
        @include('admin.partials.team-member-list', ['members' => $leaders, 'division' => 'leader'])
    </div>

    {{-- ==================== TAB: CLIENT SUPPORT ==================== --}}
    <div id="client_support" class="tab-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="font-weight-bold mb-0">Section 4 — Client Support</h5>
            <button class="btn btn-amber btn-sm" data-toggle="modal"
                    data-target="#addMemberModal" onclick="setDivision('client_support')">
                <i class="fas fa-plus mr-1"></i> Tambah Client Support
            </button>
        </div>
        @include('admin.partials.team-member-list', ['members' => $client_support, 'division' => 'client_support'])
    </div>

    {{-- ==================== TAB: DEVELOPER ==================== --}}
    <div id="developers" class="tab-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="font-weight-bold mb-0">Section 5 — Developer</h5>
            <button class="btn btn-amber btn-sm" data-toggle="modal"
                    data-target="#addMemberModal" onclick="setDivision('developer')">
                <i class="fas fa-plus mr-1"></i> Tambah Developer
            </button>
        </div>
        @include('admin.partials.team-member-list', ['members' => $developers, 'division' => 'developer'])
    </div>

</div>
</div>

{{-- Modal Tambah Member --}}
<div class="modal fade" id="addMemberModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Tambah Team Member</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.tim-kami.members.store') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="division" id="modal-division" value="leader">
                    <div class="form-group">
                        <label class="font-weight-bold">Divisi</label>
                        <input type="text" id="modal-division-label" class="form-control"
                               readonly style="background:#f8f9fc;">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control"
                               placeholder="John Doe" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Jabatan</label>
                        <input type="text" name="designation" class="form-control"
                               placeholder="CEO, Backend Developer, dll">
                    </div>

                    {{-- ✅ Foto — media picker --}}
                    @include('layouts.partials.media-input', [
                        'name'    => 'photo',
                        'value'   => '',
                        'label'   => 'Foto',
                        'inputId' => 'new-member-photo',
                        'height'  => '120px',
                    ])

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

    function setDivision(division) {
        document.getElementById('modal-division').value = division;
        const labels = {
            'leader': 'The Leader',
            'client_support': 'Client Support',
            'developer': 'Developer'
        };
        document.getElementById('modal-division-label').value = labels[division] || division;
    }
</script>
@endpush