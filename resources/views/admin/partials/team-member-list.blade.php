@forelse ($members as $member)
    <div class="section-card">
        <div class="section-header">
            <div>
                <h6 class="font-weight-bold mb-0">{{ $member['name'] }}</h6>
                <small class="text-muted">{{ $member['designation'] ?? '-' }}</small>
            </div>
            <div class="d-flex align-items-center" style="gap: 8px;">
                @if ($member['is_active'])
                    <small class="text-success"><i class="fas fa-check-circle mr-1"></i>Aktif</small>
                @else
                    <small class="text-muted"><i class="fas fa-times-circle mr-1"></i>Nonaktif</small>
                @endif
                <form method="POST" action="{{ route('admin.tim-kami.members.destroy', $member['id']) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.tim-kami.members.update', $member['id']) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="division" value="{{ $division }}">

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label class="font-weight-bold small">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control"
                               value="{{ $member['name'] }}" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold small">Jabatan</label>
                        <input type="text" name="designation" class="form-control"
                               value="{{ $member['designation'] }}"
                               placeholder="CEO, Backend Developer, dll">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold small">Urutan</label>
                            <input type="number" name="order" class="form-control form-control-sm"
                                   value="{{ $member['order'] }}" min="0">
                        </div>
                        <div class="form-group col-md-8 d-flex align-items-end">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"
                                       id="member-active-{{ $member['id'] }}"
                                       name="is_active"
                                       {{ $member['is_active'] ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                       for="member-active-{{ $member['id'] }}">Tampilkan</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <label class="font-weight-bold small">Foto</label>
                    <div class="img-preview" id="member-preview-{{ $member['id'] }}"
                         style="{{ !empty($member['photo']) ? 'background-image:url(\''.$member['photo'].'\')' : '' }}">
                        @if (empty($member['photo']))
                            Belum ada foto
                        @endif
                    </div>
                    <input type="text" name="photo" class="form-control form-control-sm"
                           value="{{ $member['photo'] }}"
                           placeholder="dari Media Library"
                           oninput="updatePreview(this, 'member-preview-{{ $member['id'] }}')">
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
        <i class="fas fa-users"></i>
        <p>Belum ada member di divisi ini</p>
        <button class="btn btn-amber btn-sm mt-3" data-toggle="modal"
                data-target="#addMemberModal" onclick="setDivision('{{ $division }}')">
            <i class="fas fa-plus mr-1"></i> Tambah
        </button>
    </div>
@endforelse