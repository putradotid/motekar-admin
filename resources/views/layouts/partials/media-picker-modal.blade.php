{{-- ============================================================
     MEDIA PICKER MODAL
     Include 1x di layouts/admin.blade.php sebelum </body>
     Dipanggil via: openMediaPicker('input-id', 'preview-id')
     ============================================================ --}}

<div class="modal fade" id="mediaPickerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <div class="d-flex align-items-center">
                    <i class="fas fa-images text-warning mr-2"></i>
                    <h5 class="modal-title font-weight-bold mb-0">Pilih dari Media Library</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">

                {{-- Filter Kategori --}}
                <div class="d-flex align-items-center mb-3 flex-wrap gap-2">
                    <span class="text-muted small mr-2">Filter:</span>
                    <button class="btn btn-sm btn-warning mr-1 media-filter-btn active" data-category="">
                        Semua
                    </button>
                    <button class="btn btn-sm btn-outline-secondary mr-1 media-filter-btn" data-category="image">
                        <i class="fas fa-image mr-1"></i> Image
                    </button>
                    <button class="btn btn-sm btn-outline-secondary mr-1 media-filter-btn" data-category="icon">
                        <i class="fas fa-icons mr-1"></i> Icon
                    </button>
                    <button class="btn btn-sm btn-outline-secondary mr-1 media-filter-btn" data-category="team">
                        <i class="fas fa-users mr-1"></i> Team
                    </button>
                    <button class="btn btn-sm btn-outline-secondary mr-1 media-filter-btn" data-category="clients">
                        <i class="fas fa-handshake mr-1"></i> Clients
                    </button>
                    <button class="btn btn-sm btn-outline-secondary media-filter-btn" data-category="background">
                        <i class="fas fa-panorama mr-1"></i> Background
                    </button>

                    {{-- Upload langsung dari modal --}}
                    <div class="ml-auto">
                        <label for="quickUploadFile" class="btn btn-sm btn-outline-primary mb-0">
                            <i class="fas fa-upload mr-1"></i> Upload Baru
                        </label>
                        <input type="file" id="quickUploadFile" accept="image/*" style="display:none"
                               onchange="quickUploadMedia(this)">
                        <select id="quickUploadCategory" class="form-control form-control-sm d-inline-block ml-1"
                                style="width: auto;">
                            <option value="image">Image</option>
                            <option value="icon">Icon</option>
                            <option value="team">Team</option>
                            <option value="clients">Clients</option>
                            <option value="background">Background</option>
                        </select>
                    </div>
                </div>

                {{-- Upload progress --}}
                <div id="uploadProgress" style="display:none;" class="mb-3">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                             style="width: 100%">
                            Mengupload...
                        </div>
                    </div>
                </div>

                {{-- Grid Media --}}
                <div id="mediaPickerGrid" class="row" style="max-height: 420px; overflow-y: auto;">
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-spinner fa-spin fa-2x text-muted"></i>
                        <p class="text-muted mt-2">Memuat media...</p>
                    </div>
                </div>

                {{-- Load more --}}
                <div class="text-center mt-3" id="mediaLoadMore" style="display:none;">
                    <button class="btn btn-outline-secondary btn-sm" onclick="loadMoreMedia()">
                        <i class="fas fa-plus mr-1"></i> Muat Lebih Banyak
                    </button>
                </div>

            </div>

            <div class="modal-footer justify-content-between">
                <small class="text-muted" id="mediaPickerCount">-</small>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    Batal
                </button>
            </div>

        </div>
    </div>
</div>

<style>
    .media-picker-item {
        cursor: pointer;
        border: 3px solid transparent;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.2s ease;
        background: #f8f9fc;
        position: relative;
    }
    .media-picker-item:hover {
        border-color: #FF8C00;
        transform: scale(1.02);
        box-shadow: 0 4px 12px rgba(255, 140, 0, 0.3);
    }
    .media-picker-item img {
        width: 100%;
        height: 100px;
        object-fit: cover;
        display: block;
    }
    .media-picker-item .media-name {
        font-size: 10px;
        color: #6e707e;
        padding: 4px 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        background: #fff;
    }
    .media-picker-item .media-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(255, 140, 0, 0.85);
        display: none;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
    }
    .media-picker-item:hover .media-overlay {
        display: flex;
    }
    .media-filter-btn.active {
        background-color: #FF8C00 !important;
        border-color: #FF8C00 !important;
        color: white !important;
    }
</style>

<script>
    // State
    let _pickerTargetInput  = null;
    let _pickerTargetPreview = null;
    let _currentPage        = 1;
    let _currentCategory    = '';
    let _totalMedia         = 0;

    // Buka modal picker
    function openMediaPicker(inputId, previewId) {
        _pickerTargetInput   = inputId;
        _pickerTargetPreview = previewId;
        _currentPage         = 1;
        _currentCategory     = '';

        // Reset filter button
        document.querySelectorAll('.media-filter-btn').forEach(btn => {
            btn.classList.remove('active', 'btn-warning');
            btn.classList.add('btn-outline-secondary');
        });
        const allBtn = document.querySelector('.media-filter-btn[data-category=""]');
        if (allBtn) {
            allBtn.classList.add('active', 'btn-warning');
            allBtn.classList.remove('btn-outline-secondary');
        }

        $('#mediaPickerModal').modal('show');
        loadMediaGrid(1, '');
    }

    // Load grid media dari API
    function loadMediaGrid(page, category) {
        const grid = document.getElementById('mediaPickerGrid');
        grid.innerHTML = `
            <div class="col-12 text-center py-5">
                <i class="fas fa-spinner fa-spin fa-2x text-muted"></i>
                <p class="text-muted mt-2">Memuat media...</p>
            </div>`;

        const token = document.querySelector('meta[name="api-token"]')?.content || '';
        const apiUrl = window.API_URL || '';
        let url = `${apiUrl}/admin/media?page=${page}&per_page=24`;
        if (category) url += `&category=${category}`;

        fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json',
            }
        })
        .then(res => res.json())
        .then(data => {
            const items = data.data || [];
            _totalMedia = data.total || 0;
            _currentPage = data.current_page || 1;

            document.getElementById('mediaPickerCount').textContent =
                `${_totalMedia} media tersedia`;

            if (items.length === 0) {
                grid.innerHTML = `
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada media. Upload dulu di Media Library.</p>
                        <a href="/admin/media" target="_blank" class="btn btn-sm btn-outline-warning">
                            Buka Media Library
                        </a>
                    </div>`;
                document.getElementById('mediaLoadMore').style.display = 'none';
                return;
            }

            grid.innerHTML = '';
            items.forEach(media => {
                const baseUrl = window.API_BASE_URL || '';
                const imgUrl  = baseUrl + media.url;
                const col     = document.createElement('div');
                col.className = 'col-6 col-md-3 col-lg-2 mb-3';
                col.innerHTML = `
                    <div class="media-picker-item" onclick="selectMedia('${imgUrl}')">
                        <img src="${imgUrl}" alt="${media.filename}" loading="lazy"
                             onerror="this.src='/sbadmin2/img/undraw_posting_photo.svg'">
                        <div class="media-overlay">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="media-name">${media.filename}</div>
                    </div>`;
                grid.appendChild(col);
            });

            // Load more button
            const loadMore = document.getElementById('mediaLoadMore');
            if (data.last_page > data.current_page) {
                loadMore.style.display = 'block';
            } else {
                loadMore.style.display = 'none';
            }
        })
        .catch(err => {
            grid.innerHTML = `
                <div class="col-12 text-center py-5 text-danger">
                    <i class="fas fa-exclamation-circle fa-2x mb-2"></i>
                    <p>Gagal memuat media. Coba lagi.</p>
                </div>`;
            console.error('Media picker error:', err);
        });
    }

    // Pilih gambar dari grid
    function selectMedia(url) {
        // Isi input
        if (_pickerTargetInput) {
            const input = document.getElementById(_pickerTargetInput);
            if (input) {
                input.value = url;
                // Trigger event supaya preview update
                input.dispatchEvent(new Event('input'));
            }
        }

        // Update preview
        if (_pickerTargetPreview) {
            const preview = document.getElementById(_pickerTargetPreview);
            if (preview) {
                if (preview.tagName === 'IMG') {
                    preview.src = url;
                    preview.style.display = 'block';
                } else {
                    preview.style.backgroundImage = `url('${url}')`;
                    preview.style.backgroundSize  = 'cover';
                    preview.style.backgroundPosition = 'center';
                    preview.textContent = '';
                }
            }
        }

        // Tutup modal
        $('#mediaPickerModal').modal('hide');
    }

    // Filter kategori
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.media-filter-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.media-filter-btn').forEach(b => {
                    b.classList.remove('active', 'btn-warning');
                    b.classList.add('btn-outline-secondary');
                });
                this.classList.add('active', 'btn-warning');
                this.classList.remove('btn-outline-secondary');

                _currentCategory = this.dataset.category;
                _currentPage     = 1;
                loadMediaGrid(1, _currentCategory);
            });
        });

        // Load saat modal dibuka
        $('#mediaPickerModal').on('show.bs.modal', function () {
            loadMediaGrid(1, _currentCategory);
        });
    });

    // Load more
    function loadMoreMedia() {
        _currentPage++;
        const grid    = document.getElementById('mediaPickerGrid');
        const token   = document.querySelector('meta[name="api-token"]')?.content || '';
        const apiUrl  = window.API_URL || '';
        let url = `${apiUrl}/admin/media?page=${_currentPage}&per_page=24`;
        if (_currentCategory) url += `&category=${_currentCategory}`;

        fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json',
            }
        })
        .then(res => res.json())
        .then(data => {
            const items = data.data || [];
            items.forEach(media => {
                const baseUrl = window.API_BASE_URL || '';
                const imgUrl  = baseUrl + media.url;
                const col     = document.createElement('div');
                col.className = 'col-6 col-md-3 col-lg-2 mb-3';
                col.innerHTML = `
                    <div class="media-picker-item" onclick="selectMedia('${imgUrl}')">
                        <img src="${imgUrl}" alt="${media.filename}" loading="lazy">
                        <div class="media-overlay">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="media-name">${media.filename}</div>
                    </div>`;
                grid.appendChild(col);
            });

            const loadMore = document.getElementById('mediaLoadMore');
            loadMore.style.display = data.last_page > data.current_page ? 'block' : 'none';
        });
    }

    // Quick upload dari modal
    function quickUploadMedia(input) {
        if (!input.files || !input.files[0]) return;

        const file     = input.files[0];
        const category = document.getElementById('quickUploadCategory').value;
        const token    = document.querySelector('meta[name="api-token"]')?.content || '';
        const apiUrl   = window.API_URL || '';

        const formData = new FormData();
        formData.append('file', file);
        formData.append('category', category);

        document.getElementById('uploadProgress').style.display = 'block';

        fetch(`${apiUrl}/admin/media`, {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('uploadProgress').style.display = 'none';
            input.value = '';

            if (data.data) {
                // Reload grid
                loadMediaGrid(_currentPage, _currentCategory);
            } else {
                alert('Upload gagal: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(err => {
            document.getElementById('uploadProgress').style.display = 'none';
            alert('Upload gagal. Coba lagi.');
            console.error(err);
        });
    }
</script>