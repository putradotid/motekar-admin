@extends('layouts.admin')

@push('styles')
<style>
    .media-card {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #e3e6f0;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .media-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .media-card img {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }

    .media-card-info {
        padding: 8px 10px;
        background: #fff;
        border-top: 1px solid #f0f0f0;
    }

    .media-card-delete {
        position: absolute;
        top: 6px;
        right: 6px;
        background: rgba(220,53,69,0.85);
        color: white;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        display: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 12px;
    }

    .media-card:hover .media-card-delete {
        display: flex;
    }

    .tab-filter {
        cursor: pointer;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 14px;
        border: 1px solid #e3e6f0;
        background: #fff;
        transition: all 0.2s;
        text-decoration: none;
        color: #6e707e;
    }

    .tab-filter:hover,
    .tab-filter.active {
        background: #FF8C00;
        color: white;
        border-color: #FF8C00;
        text-decoration: none;
    }
</style>
@endpush

@section('content')
<div id="content">
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Media Library</h1>
            <p class="text-muted small">Kelola gambar untuk konten website.</p>
        </div>
        <button class="btn btn-amber px-4" data-toggle="modal" data-target="#uploadModal">
            <i class="fas fa-upload mr-1"></i> Upload
        </button>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <!-- Tab Filter -->
            <div class="d-flex flex-wrap mb-4" style="gap: 8px;">
                <a href="{{ route('admin.media') }}"
                   class="tab-filter {{ $category == '' ? 'active' : '' }}">
                    All Media
                </a>
                <a href="{{ route('admin.media', ['category' => 'image']) }}"
                   class="tab-filter {{ $category == 'image' ? 'active' : '' }}">
                    Image
                </a>
                <a href="{{ route('admin.media', ['category' => 'icon']) }}"
                   class="tab-filter {{ $category == 'icon' ? 'active' : '' }}">
                    Icon
                </a>
                <a href="{{ route('admin.media', ['category' => 'team']) }}"
                   class="tab-filter {{ $category == 'team' ? 'active' : '' }}">
                    Team
                </a>
                <a href="{{ route('admin.media', ['category' => 'clients']) }}"
                   class="tab-filter {{ $category == 'clients' ? 'active' : '' }}">
                    Clients
                </a>
                <a href="{{ route('admin.media', ['category' => 'background']) }}"
                   class="tab-filter {{ $category == 'background' ? 'active' : '' }}">
                    Background
                </a>
            </div>

            <!-- Grid Media -->
            <div class="row">
                @forelse ($media['data'] ?? [] as $item)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="media-card">
                            {{-- Gambar --}}
                            <a href="{{ route('admin.media.show', $item['id']) }}">
                                <img src="{{ config('api.base_url') . $item['url'] }}"
                                     alt="{{ $item['filename'] }}"
                                     loading="lazy">
                            </a>

                            {{-- Tombol hapus --}}
                            <form method="POST"
                                  action="{{ route('admin.media.destroy', $item['id']) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="media-card-delete"
                                        onclick="return confirm('Hapus gambar ini?')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>

                            {{-- Info --}}
                            <div class="media-card-info">
                                <div class="text-truncate small font-weight-bold">
                                    {{ $item['filename'] }}
                                </div>
                                <small class="text-muted">
                                    {{ round($item['size'] / 1024) }}kb
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        <i class="fas fa-photo-video fa-3x mb-3 d-block"></i>
                        <p>Belum ada media. Upload gambar pertama!</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if (($media['last_page'] ?? 1) > 1)
            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted">
                    Showing {{ $media['from'] ?? 0 }}
                    to {{ $media['to'] ?? 0 }}
                    of {{ $media['total'] ?? 0 }} media
                </small>
                <div>
                    <a href="?page={{ ($media['current_page'] ?? 1) - 1 }}&category={{ $category }}"
                       class="btn btn-sm btn-light {{ ($media['current_page'] ?? 1) == 1 ? 'disabled' : '' }}">
                        &lt; Prev
                    </a>

                    @for ($i = 1; $i <= ($media['last_page'] ?? 1); $i++)
                        <a href="?page={{ $i }}&category={{ $category }}"
                           class="btn btn-sm {{ $i == ($media['current_page'] ?? 1) ? 'btn-amber' : 'btn-light' }}">
                            {{ $i }}
                        </a>
                    @endfor

                    <a href="?page={{ ($media['current_page'] ?? 1) + 1 }}&category={{ $category }}"
                       class="btn btn-sm btn-light {{ ($media['current_page'] ?? 1) == ($media['last_page'] ?? 1) ? 'disabled' : '' }}">
                        Next &gt;
                    </a>
                </div>
            </div>
            @endif

        </div>
    </div>

</div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Upload Media</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form method="POST"
                  action="{{ route('admin.media.store') }}"
                  enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label>Kategori <span class="text-danger">*</span></label>
                        <select name="category" class="form-control" required>
                            <option value="">Pilih kategori...</option>
                            <option value="image">Image</option>
                            <option value="icon">Icon</option>
                            <option value="team">Team</option>
                            <option value="clients">Clients</option>
                            <option value="background">Background</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>File Gambar <span class="text-danger">*</span></label>
                        <input type="file"
                               name="file"
                               class="form-control-file"
                               accept=".jpg,.jpeg,.png,.webp,.svg"
                               required>
                        <small class="text-muted">
                            Format: JPG, JPEG, PNG, WEBP, SVG. Maks 3MB.
                        </small>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-amber px-4">
                        <i class="fas fa-upload mr-1"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection