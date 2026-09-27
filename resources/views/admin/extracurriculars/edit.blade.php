@extends('layouts.admin')

@section('title', 'Edit Kegiatan / Organisasi — Admin')

@push('styles')
<style>
  .adm-file-dropzone {
    display: flex; align-items: center; gap: 1.1rem; margin-top: .4rem;
    background: linear-gradient(135deg, rgba(15, 47, 82, .45), rgba(8, 27, 48, .65));
    border: 2px dashed rgba(255, 213, 74, .28); border-radius: 16px; padding: 1rem 1.2rem;
    cursor: pointer; transition: all .3s var(--ease);
  }
  .adm-file-dropzone:hover {
    border-color: #ffd54a; background: rgba(255, 213, 74, .06);
    box-shadow: 0 10px 28px rgba(255, 179, 0, .14);
  }
  .adm-file-thumb {
    width: 76px; height: 76px; border-radius: 14px; background: rgba(8, 27, 48, .85);
    border: 1px solid rgba(255, 213, 74, .3); display: flex; align-items: center;
    justify-content: center; overflow: hidden; flex-shrink: 0; box-shadow: 0 8px 20px rgba(0, 0, 0, .35);
  }
  .adm-file-thumb img { width: 100%; height: 100%; object-fit: cover; }
  .adm-file-thumb i { font-size: 1.5rem; color: var(--gold); opacity: .7; }
  .adm-file-info { flex: 1; display: flex; flex-direction: column; gap: .35rem; }
  .adm-file-btn {
    display: inline-flex; align-items: center; gap: .45rem; padding: .48rem .9rem;
    border-radius: 10px; background: linear-gradient(135deg, rgba(255, 213, 74, .25), rgba(255, 179, 0, .15));
    border: 1px solid rgba(255, 213, 74, .4); color: #fff; font-size: .78rem; font-weight: 700; pointer-events: none;
  }
  .adm-file-name {
    display: inline-flex; align-items: center; gap: .35rem; padding: .32rem .65rem;
    border-radius: 8px; background: rgba(46, 204, 113, .15); border: 1px solid rgba(46, 204, 113, .35);
    color: #2ecc71; font-size: .72rem; font-weight: 700;
  }
</style>
@endpush

@php
  $isOrg = ($item->category === 'Organisasi');
  $attrs = $item->attributes ?? [];
  $schedule = $attrs['schedule'] ?? '';
  $activities = $attrs['activities'] ?? '';
  $imgSrc = $item->image_url ? (str_starts_with($item->image_url, 'http') ? $item->image_url : asset($item->image_url)) : null;
@endphp

@section('content')
<!-- HEADER MATCHING SCHOOL-HISTORY PATTERN -->
<div class="db-panel-head">
  <div>
    <h2><i class="fas fa-edit" style="color:var(--gold);margin-right:.5rem"></i> Edit Data Kegiatan / Organisasi: {{ $item->name }}</h2>
    <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Ubah rincian informasi {{ $item->name }}.</p>
  </div>
  <div class="db-panel-actions">
    <a href="{{ route('admin.extracurriculars.index') }}" class="db-btn db-btn-ghost">
      <i class="fas fa-arrow-left"></i> Kembali ke Daftar
    </a>
  </div>
</div>

<div class="db-panel" style="padding:1.8rem">
  <form id="extraEditForm" onsubmit="updateExtra(event)">
    <input type="hidden" id="extraId" value="{{ $item->id }}">

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.2rem">
      <div class="db-form-group">
        <label><i class="fas fa-layer-group" style="color:var(--gold)"></i> Tipe Wadah *</label>
        <select id="extraType" class="db-form-control" onchange="toggleCategoryType(this.value)">
          <option value="EKSTRAKURIKULER" {{ !$isOrg ? 'selected' : '' }}>Ekstrakurikuler Sekolah</option>
          <option value="ORGANISASI" {{ $isOrg ? 'selected' : '' }}>Organisasi Siswa (OSIS, Pasus, dll)</option>
        </select>
      </div>

      <div class="db-form-group" id="bidangGroup" style="{{ $isOrg ? 'opacity:0.4;pointer-events:none' : '' }}">
        <label><i class="fas fa-tags" style="color:var(--gold)"></i> Bidang Ekstrakurikuler</label>
        <select id="extraCategory" class="db-form-control">
          <option value="Teknologi" {{ $item->category === 'Teknologi' ? 'selected' : '' }}>Teknologi &amp; Coding</option>
          <option value="Olahraga" {{ $item->category === 'Olahraga' ? 'selected' : '' }}>Olahraga &amp; Kebugaran</option>
          <option value="Seni & Budaya" {{ $item->category === 'Seni & Budaya' ? 'selected' : '' }}>Seni, Musik &amp; Budaya</option>
          <option value="Keagamaan" {{ $item->category === 'Keagamaan' ? 'selected' : '' }}>Keagamaan &amp; Kerohanian</option>
          <option value="Kedisiplinan" {{ $item->category === 'Kedisiplinan' ? 'selected' : '' }}>Kedisiplinan &amp; Paskibra</option>
          <option value="Kepanduan" {{ $item->category === 'Kepanduan' ? 'selected' : '' }}>Kepanduan &amp; Pramuka</option>
          <option value="Kesehatan" {{ $item->category === 'Kesehatan' ? 'selected' : '' }}>Kesehatan (PMR / PIK-R)</option>
          <option value="Media & Literasi" {{ $item->category === 'Media & Literasi' ? 'selected' : '' }}>Media &amp; Jurnalistik</option>
          <option value="Bela Diri" {{ $item->category === 'Bela Diri' ? 'selected' : '' }}>Bela Diri &amp; Pencak Silat</option>
          <option value="Lainnya" {{ $item->category === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
        </select>
      </div>
    </div>

    <div class="db-form-group" style="margin-top:1rem">
      <label><i class="fas fa-signature" style="color:var(--gold)"></i> Nama Kegiatan / Organisasi *</label>
      <input type="text" id="extraName" class="db-form-control" value="{{ $item->name }}" placeholder="Contoh: Robotik &amp; Coding Club" required>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;margin-top:1rem">
      <div class="db-form-group">
        <label><i class="fas fa-user-shield" style="color:var(--gold)"></i> Nama Pembina / Pelatih</label>
        <input type="text" id="extraCoach" class="db-form-control" value="{{ $item->coach_name }}" placeholder="Contoh: Pembina Olahraga Sekolah">
      </div>

      <div class="db-form-group">
        <label><i class="fas fa-calendar-alt" style="color:var(--gold)"></i> Jadwal Latihan / Pertemuan</label>
        <input type="text" id="extraSchedule" class="db-form-control" value="{{ $schedule }}" placeholder="Contoh: Setiap Jumat Selesai KBM">
      </div>
    </div>

    <div class="db-form-group" style="margin-top:1rem">
      <label><i class="fas fa-list-check" style="color:var(--gold)"></i> Fokus Kegiatan Utama (Koma Separated)</label>
      <input type="text" id="extraActivities" class="db-form-control" value="{{ $activities }}" placeholder="Contoh: Latihan PBB, pengibaran bendera">
    </div>

    <div class="db-form-group" style="margin-top:1rem">
      <label><i class="fas fa-align-left" style="color:var(--gold)"></i> Deskripsi Singkat *</label>
      <textarea id="extraDescription" class="db-form-control" rows="3" required>{{ $item->description }}</textarea>
    </div>

    <div class="db-form-group" style="margin-top:1rem">
      <label><i class="fas fa-image" style="color:var(--gold)"></i> Foto Kegiatan / Logo</label>
      <div class="adm-file-dropzone" onclick="document.getElementById('extraImageFile').click()">
        <div id="extraImgPreviewWrap" class="adm-file-thumb">
          <img id="extraImgPreview" src="{{ $imgSrc ?? '' }}" alt="Preview" style="{{ $imgSrc ? 'display:block' : 'display:none' }}">
          <i id="extraImgPlaceholder" class="fas fa-camera" style="{{ $imgSrc ? 'display:none' : 'display:block' }}"></i>
        </div>
        <div class="adm-file-info">
          <div class="adm-file-actions">
            <button type="button" class="adm-file-btn">
              <i class="fas fa-cloud-arrow-up"></i> <span id="extraBtnLabel">{{ $imgSrc ? 'Ganti Gambar Komputer' : 'Pilih Gambar Komputer' }}</span>
            </button>
            <span id="extraFileName" class="adm-file-name" style="display:none"></span>
          </div>
          <small class="adm-file-hint">Klik di sini jika ingin memperbarui foto kegiatan (Format: JPG, PNG, WEBP &bull; Maks: 5MB)</small>
        </div>
        <input type="file" id="extraImageFile" accept="image/*" style="display:none" onchange="previewExtraImage(this)">
      </div>
    </div>

    <div style="display:flex;justify-content:flex-end;gap:.8rem;margin-top:2rem;padding-top:1.2rem;border-top:1px solid rgba(255,255,255,.08)">
      <a href="{{ route('admin.extracurriculars.index') }}" class="db-btn db-btn-ghost">Batal</a>
      <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Perubahan Data</button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
  function toggleCategoryType(type) {
    const bidangGroup = document.getElementById('bidangGroup');
    if (type === 'ORGANISASI') {
      bidangGroup.style.opacity = '0.4';
      bidangGroup.style.pointerEvents = 'none';
    } else {
      bidangGroup.style.opacity = '1';
      bidangGroup.style.pointerEvents = 'auto';
    }
  }

  function previewExtraImage(input) {
    const preview = document.getElementById('extraImgPreview');
    const placeholder = document.getElementById('extraImgPlaceholder');
    const fileNameBadge = document.getElementById('extraFileName');
    const btnLabel = document.getElementById('extraBtnLabel');

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
      if (btnLabel) btnLabel.textContent = 'Ganti Berkas Gambar';
    }
  }

  async function updateExtra(e) {
    e.preventDefault();
    const id = document.getElementById('extraId').value;
    const fileInput = document.getElementById('extraImageFile');
    const extraType = document.getElementById('extraType').value;
    const categoryValue = (extraType === 'ORGANISASI') ? 'Organisasi' : document.getElementById('extraCategory').value;

    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('name', document.getElementById('extraName').value);
    formData.append('category', categoryValue);
    formData.append('coach_name', document.getElementById('extraCoach').value);
    formData.append('schedule', document.getElementById('extraSchedule').value);
    formData.append('activities', document.getElementById('extraActivities').value);
    formData.append('description', document.getElementById('extraDescription').value);

    if (fileInput.files.length > 0) {
      formData.append('image_file', fileInput.files[0]);
    }

    try {
      const res = await fetch(`/api/admin/extracurriculars/${id}`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: formData
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Data kegiatan berhasil diperbarui!');
        setTimeout(() => location.href = "{{ route('admin.extracurriculars.index') }}", 800);
      } else {
        showToast(data.message || 'Gagal memperbarui data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }
</script>
@endpush
