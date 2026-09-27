@extends('layouts.admin')

@section('title', 'Tambah Lowongan Pekerjaan — SMK Negeri 2 Mojokerto')

@section('content')
<!-- HEADER MATCHING SCHOOL-HISTORY PATTERN -->
<div class="db-panel-head">
  <div>
    <h2><i class="fas fa-briefcase" style="color:var(--gold);margin-right:.5rem"></i> Tambah Lowongan Pekerjaan Baru</h2>
    <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Isi formulir untuk mempublikasikan lowongan kerja atau rekrutmen BKK untuk alumni &amp; siswa.</p>
  </div>
  <div class="db-panel-actions">
    <a href="{{ route('admin.job-vacancies.index') }}" class="db-btn db-btn-ghost">
      <i class="fas fa-arrow-left"></i> Kembali ke Daftar
    </a>
  </div>
</div>

<div class="db-panel" style="padding:1.8rem">
  <form id="createJobForm" onsubmit="saveJob(event)">
    
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.2rem">
      <div class="db-form-group">
        <label><i class="fas fa-user-tie" style="color:var(--gold)"></i> Judul Lowongan / Posisi *</label>
        <input type="text" id="title" class="db-form-control" placeholder="Contoh: Junior Web Developer / Staff Admin" required>
      </div>

      <div class="db-form-group">
        <label><i class="fas fa-building" style="color:var(--gold)"></i> Perusahaan / Mitra BKK *</label>
        <input type="text" id="company_name" class="db-form-control" placeholder="Contoh: PT Telkom Indonesia" required>
      </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:1.2rem;margin-top:1rem">
      <div class="db-form-group">
        <label><i class="fas fa-location-dot" style="color:var(--gold)"></i> Lokasi Penempatan</label>
        <input type="text" id="location" class="db-form-control" placeholder="Contoh: Mojokerto / Surabaya">
      </div>

      <div class="db-form-group">
        <label><i class="fas fa-calendar-day" style="color:var(--gold)"></i> Batas Akhir Pendaftaran</label>
        <input type="date" id="deadline" class="db-form-control">
      </div>

      <div class="db-form-group">
        <label><i class="fas fa-toggle-on" style="color:var(--gold)"></i> Status Rekrutmen *</label>
        <select id="status" class="db-form-control">
          <option value="OPEN">OPEN (Pendaftaran Berlangsung)</option>
          <option value="UPCOMING">UPCOMING (Akan Datang)</option>
          <option value="SELESAI">SELESAI (Pendaftaran Berakhir)</option>
          <option value="ARSIP">ARSIP (Dokumentasi)</option>
        </select>
      </div>
    </div>

    <div class="db-form-group" style="margin-top:1rem">
      <label><i class="fas fa-link" style="color:var(--gold)"></i> URL Pendaftaran / Tautan Formulir (Opsional)</label>
      <input type="url" id="apply_url" class="db-form-control" placeholder="https://bit.ly/rekrutmen-smkn2">
    </div>

    <div class="db-form-group" style="margin-top:1rem">
      <label><i class="fas fa-file-lines" style="color:var(--gold)"></i> Deskripsi Kualifikasi &amp; Cara Melamar *</label>
      <textarea id="description" class="db-form-control" rows="6" placeholder="Persyaratan kualifikasi, berkas lamaran, deskripsi pekerjaan, &amp; petunjuk pendaftaran..." required></textarea>
    </div>

    <div style="display:flex;justify-content:flex-end;gap:.8rem;margin-top:2rem;padding-top:1.2rem;border-top:1px solid rgba(255,255,255,.08)">
      <a href="{{ route('admin.job-vacancies.index') }}" class="db-btn db-btn-ghost">Batal</a>
      <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Lowongan Kerja</button>
    </div>

  </form>
</div>
@endsection

@push('scripts')
<script>
  async function saveJob(e) {
    e.preventDefault();

    const payload = {
      title: document.getElementById('title').value,
      company_name: document.getElementById('company_name').value,
      location: document.getElementById('location').value,
      deadline: document.getElementById('deadline').value || null,
      status: document.getElementById('status').value,
      apply_url: document.getElementById('apply_url').value || null,
      description: document.getElementById('description').value
    };

    try {
      const res = await fetch('/api/admin/job-vacancies', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Lowongan pekerjaan baru berhasil ditambahkan!');
        setTimeout(() => window.location.href = "{{ route('admin.job-vacancies.index') }}", 800);
      } else {
        showToast(data.message || 'Gagal menyimpan data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }
</script>
@endpush
