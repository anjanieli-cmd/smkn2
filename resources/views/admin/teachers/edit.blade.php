@extends('layouts.admin')

@section('title', 'Edit Data Guru / Staf — Admin')

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
    transition: all .3s var(--ease);
  }
  .adm-file-dropzone:hover {
    border-color: #ffd54a;
    background: rgba(255, 213, 74, .06);
    box-shadow: 0 10px 28px rgba(255, 179, 0, .14);
  }
  .adm-file-thumb {
    width: 76px;
    height: 76px;
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
  .adm-file-thumb img { width: 100%; height: 100%; object-fit: cover; }
  .adm-file-thumb i { font-size: 1.5rem; color: var(--gold); opacity: .7; }
  .adm-file-info { flex: 1; display: flex; flex-direction: column; gap: .35rem; }
  .adm-file-btn {
    display: inline-flex; align-items: center; gap: .45rem;
    padding: .48rem .9rem; border-radius: 10px;
    background: linear-gradient(135deg, rgba(255, 213, 74, .25), rgba(255, 179, 0, .15));
    border: 1px solid rgba(255, 213, 74, .4); color: #fff; font-size: .78rem; font-weight: 700;
    pointer-events: none;
  }
  .adm-file-name {
    display: inline-flex; align-items: center; gap: .35rem;
    padding: .32rem .65rem; border-radius: 8px;
    background: rgba(46, 204, 113, .15); border: 1px solid rgba(46, 204, 113, .35);
    color: #2ecc71; font-size: .72rem; font-weight: 700;
  }
</style>
@endpush

@php
  $isStaff = str_contains(strtolower($item->role_position), 'staf') || str_contains(strtolower($item->role_position), 'staff');
  $photoSrc = $item->photo_url ? (str_starts_with($item->photo_url, 'http') ? $item->photo_url : asset($item->photo_url)) : null;
@endphp

@section('content')
<!-- HEADER MATCHING SCHOOL-HISTORY PATTERN -->
<div class="db-panel-head">
  <div>
    <h2><i class="fas fa-user-pen" style="color:var(--gold);margin-right:.5rem"></i> Edit Data Guru / Staf: {{ $item->name }}</h2>
    <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Ubah profil pendidik, pasfoto formal, NIP, atau peranan pekerjaan.</p>
  </div>
  <div class="db-panel-actions">
    <a href="{{ route('admin.teachers.index') }}" class="db-btn db-btn-ghost">
      <i class="fas fa-arrow-left"></i> Kembali ke Daftar
    </a>
  </div>
</div>

<div class="db-panel" style="padding:1.8rem">
  <form id="teacherEditForm" onsubmit="updateTeacher(event)">
    <input type="hidden" id="teacherId" value="{{ $item->id }}">

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.2rem">
      <div class="db-form-group">
        <label><i class="fas fa-user-gear" style="color:var(--gold)"></i> Peranan Utama *</label>
        <select id="teacherStaffType" class="db-form-control" onchange="updateRolePlaceholder(this.value)">
          <option value="GURU" {{ !$isStaff ? 'selected' : '' }}>Guru Pendidik (Tenaga Pendidik)</option>
          <option value="STAF" {{ $isStaff ? 'selected' : '' }}>Staf / Tenaga Kependidikan</option>
        </select>
      </div>

      <div class="db-form-group">
        <label><i class="fas fa-id-card-clip" style="color:var(--gold)"></i> NIP (Nomor Induk Pegawai)</label>
        <input type="text" id="teacherNip" class="db-form-control" value="{{ $item->nip }}" placeholder="Contoh: 198503152010012011">
      </div>
    </div>

    <div class="db-form-group" style="margin-top:1rem">
      <label><i class="fas fa-user" style="color:var(--gold)"></i> Nama Lengkap (dengan Gelar) *</label>
      <input type="text" id="teacherName" class="db-form-control" value="{{ $item->name }}" placeholder="Contoh: Dra. Lugiati, M.Pd." required>
    </div>

    <div class="db-form-group" style="margin-top:1rem">
      <label><i class="fas fa-briefcase" style="color:var(--gold)"></i> Jabatan / Bidang Studi Spesifik *</label>
      <input type="text" id="teacherRole" class="db-form-control" value="{{ $item->role_position }}" placeholder="Contoh: Guru Produktif Kuliner" required>
    </div>

    <div class="db-form-group" style="margin-top:1rem">
      <label><i class="fas fa-camera" style="color:var(--gold)"></i> Pasfoto Formal</label>
      <div class="adm-file-dropzone" onclick="document.getElementById('teacherPhotoFile').click()">
        <div id="photoPreviewContainer" class="adm-file-thumb">
          <img id="photoPreview" src="{{ $photoSrc ?? '' }}" alt="Preview" style="{{ $photoSrc ? 'display:block' : 'display:none' }}">
          <i id="photoPlaceholderIcon" class="fas fa-camera" style="{{ $photoSrc ? 'display:none' : 'display:block' }}"></i>
        </div>
        <div class="adm-file-info">
          <div class="adm-file-actions">
            <button type="button" class="adm-file-btn">
              <i class="fas fa-cloud-arrow-up"></i> <span id="photoBtnLabel">{{ $photoSrc ? 'Ganti Pasfoto Komputer' : 'Pilih Pasfoto Komputer' }}</span>
            </button>
            <span id="photoFileName" class="adm-file-name" style="display:none"></span>
          </div>
          <small class="adm-file-hint">Klik di sini jika ingin memperbarui pasfoto formal (Format: JPG, PNG, WEBP &bull; Maks: 5MB)</small>
        </div>
        <input type="file" id="teacherPhotoFile" accept="image/*" style="display:none" onchange="previewSelectedImage(this)">
      </div>
    </div>

    <div class="db-form-group" style="margin-top:1rem">
      <label><i class="fas fa-toggle-on" style="color:var(--gold)"></i> Status Keaktifan</label>
      <select id="teacherStatus" class="db-form-control">
        <option value="1" {{ $item->is_active ? 'selected' : '' }}>Aktif (Tampil di Website Publik)</option>
        <option value="0" {{ !$item->is_active ? 'selected' : '' }}>Non-Aktif (Sembunyikan dari Publik)</option>
      </select>
    </div>

    <div style="display:flex;justify-content:flex-end;gap:.8rem;margin-top:2rem;padding-top:1.2rem;border-top:1px solid rgba(255,255,255,.08)">
      <a href="{{ route('admin.teachers.index') }}" class="db-btn db-btn-ghost">Batal</a>
      <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Perubahan Data</button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
  function updateRolePlaceholder(type) {
    const roleInput = document.getElementById('teacherRole');
    if (type === 'STAF') {
      if (!roleInput.value) roleInput.placeholder = 'Contoh: Staf Tata Usaha / Staf Keamanan';
    } else {
      if (!roleInput.value) roleInput.placeholder = 'Contoh: Guru Normatif - Matematika / Guru Produktif RPL';
    }
  }

  function previewSelectedImage(input) {
    const preview = document.getElementById('photoPreview');
    const icon = document.getElementById('photoPlaceholderIcon');
    const fileNameBadge = document.getElementById('photoFileName');
    const btnLabel = document.getElementById('photoBtnLabel');

    if (input.files && input.files[0]) {
      const file = input.files[0];
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
        if (icon) icon.style.display = 'none';
      }
      reader.readAsDataURL(file);

      if (fileNameBadge) {
        fileNameBadge.textContent = file.name;
        fileNameBadge.style.display = 'inline-flex';
      }
      if (btnLabel) btnLabel.textContent = 'Ganti Berkas Foto';
    }
  }

  async function updateTeacher(e) {
    e.preventDefault();
    const id = document.getElementById('teacherId').value;
    const staffType = document.getElementById('teacherStaffType').value;
    let rolePos = document.getElementById('teacherRole').value.trim();

    if (staffType === 'STAF' && !rolePos.toLowerCase().includes('staf') && !rolePos.toLowerCase().includes('staff')) {
      rolePos = 'Staf ' + rolePos;
    }

    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('name', document.getElementById('teacherName').value);
    formData.append('nip', document.getElementById('teacherNip').value);
    formData.append('role_position', rolePos);
    formData.append('is_active', document.getElementById('teacherStatus').value);

    const fileInput = document.getElementById('teacherPhotoFile');
    if (fileInput.files.length > 0) {
      formData.append('photo_file', fileInput.files[0]);
    }

    try {
      const res = await fetch(`/api/admin/teachers/${id}`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: formData
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Data Guru / Staf berhasil diperbarui!');
        setTimeout(() => location.href = "{{ route('admin.teachers.index') }}", 800);
      } else {
        showToast(data.message || 'Gagal memperbarui data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }
</script>
@endpush
