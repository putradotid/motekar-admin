@php
    $inputId  = $inputId  ?? 'media-input-' . uniqid();
    $previewId = $inputId . '-preview';
    $required  = $required ?? false;
    $height    = $height   ?? '120px';
    $currentValue = $value ?? '';
@endphp

<div class="form-group">
    @if (!empty($label))
        <label class="font-weight-bold small">
            {{ $label }}
            @if ($required) <span class="text-danger">*</span> @endif
        </label>
    @endif

    {{-- Preview Gambar --}}
    <div id="{{ $previewId }}"
         class="media-input-preview mb-2"
         style="
             width: 100%;
             height: {{ $height }};
             border: 2px dashed #e3e6f0;
             border-radius: 8px;
             background-color: #f8f9fc;
             background-size: cover;
             background-position: center;
             background-repeat: no-repeat;
             display: flex;
             align-items: center;
             justify-content: center;
             overflow: hidden;
             {{ !empty($currentValue) ? 'background-image: url(\''.$currentValue.'\'); border-style: solid; border-color: #FF8C00;' : '' }}
         ">
        @if (empty($currentValue))
            <div class="text-center text-muted">
                <i class="fas fa-image fa-2x mb-1"></i>
                <p class="small mb-0">Belum ada gambar</p>
            </div>
        @endif
    </div>

    {{-- Input hidden untuk menyimpan URL --}}
    <input type="hidden"
           name="{{ $name }}"
           id="{{ $inputId }}"
           value="{{ $currentValue }}"
           {{ $required ? 'required' : '' }}>

    {{-- Tombol Pilih & Hapus --}}
    <div class="d-flex gap-2" style="gap: 8px;">
        <button type="button"
                class="btn btn-outline-warning btn-sm flex-grow-1"
                onclick="openMediaPicker('{{ $inputId }}', '{{ $previewId }}')">
            <i class="fas fa-images mr-1"></i>
            {{ !empty($currentValue) ? 'Ganti Gambar' : 'Pilih dari Media Library' }}
        </button>

        @if (!empty($currentValue))
            <button type="button"
                    class="btn btn-outline-danger btn-sm"
                    onclick="clearMediaInput('{{ $inputId }}', '{{ $previewId }}', this)"
                    title="Hapus gambar">
                <i class="fas fa-times"></i>
            </button>
        @endif
    </div>

    @if (!empty($hint))
        <small class="text-muted d-block mt-1">{{ $hint }}</small>
    @endif
</div>

@once
<script>
    // Fungsi clear gambar
    function clearMediaInput(inputId, previewId, btn) {
        const input   = document.getElementById(inputId);
        const preview = document.getElementById(previewId);

        input.value = '';
        preview.style.backgroundImage = 'none';
        preview.style.borderStyle     = 'dashed';
        preview.style.borderColor     = '#e3e6f0';
        preview.innerHTML = `
            <div class="text-center text-muted">
                <i class="fas fa-image fa-2x mb-1"></i>
                <p class="small mb-0">Belum ada gambar</p>
            </div>`;

        // Update tombol
        const pickBtn = btn.previousElementSibling;
        if (pickBtn) pickBtn.innerHTML = '<i class="fas fa-images mr-1"></i> Pilih dari Media Library';

        // Sembunyikan tombol hapus
        btn.style.display = 'none';
    }

    // Override selectMedia untuk update tombol juga
    const _origSelectMedia = window.selectMedia;
    window.selectMedia = function(url) {
        // Panggil original
        if (typeof _origSelectMedia === 'function') _origSelectMedia(url);

        // Update tombol pick menjadi "Ganti Gambar"
        if (window._pickerTargetInput) {
            const inputEl = document.getElementById(window._pickerTargetInput);
            if (inputEl) {
                // Cari tombol pick di parent
                const parent  = inputEl.closest('.form-group');
                if (parent) {
                    const pickBtn = parent.querySelector('.btn-outline-warning');
                    if (pickBtn) {
                        pickBtn.innerHTML = '<i class="fas fa-images mr-1"></i> Ganti Gambar';
                    }
                    // Tampilkan tombol hapus kalau ada
                    const clearBtn = parent.querySelector('.btn-outline-danger');
                    if (clearBtn) clearBtn.style.display = 'inline-flex';
                }

                // Update border preview
                const previewId = window._pickerTargetPreview;
                const preview   = document.getElementById(previewId);
                if (preview) {
                    preview.style.borderStyle = 'solid';
                    preview.style.borderColor = '#FF8C00';
                }
            }
        }
    };
</script>
@endonce