@extends('layouts.admin')

@section('title', 'Edit Mitra Industri — ' . $item->company_name . ' — SMK Negeri 2 Mojokerto')

@push('styles')
<style>
  .adm-file-dropzone {
    display: flex;
    align-items: center;
    gap: 1.1rem;
    margin-top: .4rem;
    background: linear-gradient(135deg, rgba(15, 47, 82, .45), rgba(8, 27, 48, .65));
    border: 2px dashed rgba(255, 213, 74, .28);
    border-radius: 16px;
    padding: 1rem 1.2rem;
    cursor: pointer;
    transition: all .3s cubic-bezier(.22, .61, .36, 1);
    position: relative;
    user-select: none;
  }
  .adm-file-dropzone:hover {
    border-color: #ffd54a;
    background: rgba(255, 213, 74, .06);
    box-shadow: 0 10px 28px rgba(255, 179, 0, .14);
  }
  .adm-file-thumb {
    width: 72px;
    height: 72px;
    border-radius: 14px;
    background: rgba(8, 27, 48, .85);
    border: 1px solid rgba(255, 213, 74, .3);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    flex-shrink: 0;
    box-shadow: 0 8px 20px rgba(0, 0, 0, .35);
  }
  .adm-file-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .adm-file-thumb i {
    font-size: 1.4rem;
    color: #f9a825;
    opacity: .7;
  }
  .adm-file-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: .35rem;
  }
  .adm-file-actions {
    display: flex;
    align-items: center;
    gap: .65rem;
    flex-wrap: wrap;
  }
  .adm-file-btn {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    padding: .48rem .9rem;
    border-radius: 10px;
    background: linear-gradient(135deg, rgba(255, 213, 74, .25), rgba(255, 179, 0, .15));
    border: 1px solid rgba(255, 213, 74, .4);
    color: #fff;
    font-size: .78rem;
    font-weight: 700;
    pointer-events: none;
  }
  .adm-file-name {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    padding: .32rem .65rem;
    border-radius: 8px;
    background: rgba(46, 204, 113, .15);
    border: 1px solid rgba(46, 204, 113, .35);
    color: #2ecc71;
    font-size: .72rem;
    font-weight: 700;
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .adm-file-hint {
    font-size: .72rem;
    color: #8a9aad;
    line-height: 1.4;
  }
</style>
@endpush

@section('content')
<!-- HEADER MATCHING SCHOOL-HISTORY PATTERN -->
<div class="db-panel-head">
  <div>
    <h2><i class="fas fa-pen-to-square" style="color:var(--gold);margin-right:.5rem"></i> Edit Data Mitra Industri: {{ $item->company_name }}</h2>
    <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Perbarui informasi perusahaan, bidang usaha, cakupan kerja sama, atau logo.</p>
  </div>
  <div class="db-panel-actions">
    <a href="{{ route('admin.industries.index') }}" class="db-btn db-btn-ghost">
      <i class="fas fa-arrow-left"></i> Kembali ke Daftar
    </a>
  </div>
</div>

<div class="db-panel" style="padding:1.8rem">
  <form id="editIndustryForm" onsubmit="updateIndustry(event)">
    <input type="hidden" id="industryId" value="{{ $item->id }}">
    <input type="hidden" id="logoUrlExisting" value="{{ $item->logo_url }}">
    
    <div class="db-form-group">
      <label><i class="fas fa-building" style="color:var(--gold)"></i> Nama Perusahaan / Mitra *</label>
      <input type="text" id="company_name" class="db-form-control" value="{{ $item->company_name }}" required>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;margin-top:1rem">
      <div class="db-form-group">
        <label><i class="fas fa-layer-group" style="color:var(--gold)"></i> Bidang Usaha / Industri *</label>
        <input type="text" id="field_of_work" class="db-form-control" value="{{ $item->field_of_work }}" required>
      </div>

      <div class="db-form-group">
        <label><i class="fas fa-toggle-on" style="color:var(--gold)"></i> Status Kemitraan *</label>
        <select id="is_active" class="db-form-control">
          <option value="1" {{ $item->is_active ? 'selected' : '' }}>Aktif (Kerja sama berjalan)</option>
          <option value="0" {{ !$item->is_active ? 'selected' : '' }}>Non-Aktif (Kerja sama selesai / arsip)</option>
        </select>
      </div>
    </div>

    <div class="db-form-group" style="margin-top:1rem">
      <label><i class="fas fa-handshake" style="color:var(--gold)"></i> Cakupan Kerja Sama (Scope) *</label>
      <input type="text" id="partnership_scope" class="db-form-control" value="{{ $item->partnership_scope }}" required>
    </div>

    <!-- UPLOAD LOGO PERUSAHAAN -->
    <div class="db-form-group" style="margin-top:1rem">
      <label><i class="fas fa-image" style="color:var(--gold)"></i> Logo Perusahaan / Perguruan Tinggi</label>
      <div class="adm-file-dropzone" onclick="document.getElementById('logoFile').click()">
        <div id="imgPreviewWrap" class="adm-file-thumb">
          @if($item->logo_url)
            <img id="imgPreview" src="{{ asset($item->logo_url) }}" alt="Preview">
            <i id="imgPlaceholder" class="fas fa-building" style="display:none"></i>
          @else
            <img id="imgPreview" src="" alt="Preview" style="display:none">
            <i id="imgPlaceholder" class="fas fa-building"></i>
          @endif
        </div>
        <div class="adm-file-info">
          <div class="adm-file-actions">
            <button type="button" class="adm-file-btn">
              <i class="fas fa-cloud-arrow-up"></i> <span id="btnLabel">{{ $item->logo_url ? 'Ganti Logo' : 'Pilih Logo Komputer' }}</span>
            </button>
            <span id="fileNameBadge" class="adm-file-name" style="display:none"></span>
          </div>
          <small class="adm-file-hint">Klik di sini untuk mengunggah logo perusahaan baru (JPG, PNG, WEBP &bull; Maks: 5MB)</small>
        </div>
        <input type="file" id="logoFile" accept="image/*" style="display:none" onchange="previewImage(this)">
      </div>
    </div>

    <div style="display:flex;justify-content:flex-end;gap:.8rem;margin-top:2rem;padding-top:1.2rem;border-top:1px solid rgba(255,255,255,.08)">
      <a href="{{ route('admin.industries.index') }}" class="db-btn db-btn-ghost">Batal</a>
      <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Perubahan</button>
    </div>

  </form>
</div>
@endsection

@push('scripts')
<script>
  function previewImage(input) {
    const preview = document.getElementById('imgPreview');
    const placeholder = document.getElementById('imgPlaceholder');
    const fileNameBadge = document.getElementById('fileNameBadge');
    const btnLabel = document.getElementById('btnLabel');

    if (input.files && input.files[0]) {
      const file = input.files[0];
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
        if (placeholder) placeholder.style.display = 'none';
      };
      reader.readAsDataURL(file);

      if (fileNameBadge) {
        fileNameBadge.textContent = file.name;
        fileNameBadge.style.display = 'inline-flex';
      }
      if (btnLabel) btnLabel.textContent = 'Ganti Berkas Logo';
    }
  }

  async function updateIndustry(e) {
    e.preventDefault();
    const id = document.getElementById('industryId').value;
    const fileInput = document.getElementById('logoFile');

    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('company_name', document.getElementById('company_name').value);
    formData.append('field_of_work', document.getElementById('field_of_work').value);
    formData.append('partnership_scope', document.getElementById('partnership_scope').value);
    formData.append('is_active', document.getElementById('is_active').value);

    if (fileInput.files && fileInput.files[0]) {
      formData.append('logo_file', fileInput.files[0]);
    } else if (document.getElementById('logoUrlExisting').value) {
      formData.append('logo_url', document.getElementById('logoUrlExisting').value);
    }

    try {
      const res = await fetch(`/api/admin/industries/${id}`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: formData
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Data Mitra Industri berhasil diperbarui!');
        setTimeout(() => window.location.href = "{{ route('admin.industries.index') }}", 800);
      } else {
        showToast(data.message || 'Gagal menyimpan data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }
</script>
@endpush
