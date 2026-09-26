@extends('layouts.admin')

@section('title', 'Manajemen BKK & Lowongan Kerja — SMK Negeri 2 Mojokerto')

@section('content')
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2>Bursa Kerja Khusus (BKK) &amp; Loker</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Publikasikan informasi lowongan pekerjaan &amp; penyaluran alumni SMKN 2 Mojokerto.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Lowongan Baru</button>
      </div>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Posisi / Judul Loker</th>
            <th>Perusahaan</th>
            <th>Lokasi</th>
            <th>Tipe Pekerjaan</th>
            <th>Status</th>
            <th style="text-align:right">Aksi</th>
          </tr>
        </thead>
        <tbody id="jobTableBody">
          @forelse($items as $item)
            <tr>
              <td><strong style="color:var(--gold-light)">{{ $item->title }}</strong></td>
              <td><strong>{{ $item->company_name }}</strong></td>
              <td><span style="font-size:.78rem;color:var(--text-muted)">{{ $item->location ?? '-' }}</span></td>
              <td><span style="font-size:.78rem;color:var(--text-muted)">{{ $item->employment_type ?? 'Full-Time' }}</span></td>
              <td><span class="db-tag {{ $item->status }}">{{ $item->status }}</span></td>
              <td style="text-align:right">
                <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteJob('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem">Belum ada lowongan pekerjaan BKK.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL CREATE / EDIT -->
  <div class="db-modal-overlay" id="jobModal">
    <div class="db-modal">
      <div class="db-modal-head">
        <h3 id="modalTitle">Tambah Lowongan Kerja Baru</h3>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <form id="jobForm" onsubmit="saveJob(event)">
          <input type="hidden" id="jobId">

          <div class="db-form-group">
            <label>Judul Lowongan / Posisi *</label>
            <input type="text" id="jobTitle" class="db-form-control" placeholder="Contoh: Junior Web Developer" required>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="db-form-group">
              <label>Perusahaan *</label>
              <input type="text" id="jobCompany" class="db-form-control" placeholder="Contoh: PT Telkom Indonesia" required>
            </div>
            <div class="db-form-group">
              <label>Lokasi Pekerjaan</label>
              <input type="text" id="jobLocation" class="db-form-control" placeholder="Contoh: Surabaya / Remote">
            </div>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="db-form-group">
              <label>Tipe Pekerjaan</label>
              <select id="jobType" class="db-form-control">
                <option value="Full-Time">Full-Time</option>
                <option value="Part-Time">Part-Time</option>
                <option value="Contract">Kontrak / Magang</option>
              </select>
            </div>
            <div class="db-form-group">
              <label>Status Lowongan</label>
              <select id="jobStatus" class="db-form-control">
                <option value="OPEN">OPEN (Buka)</option>
                <option value="CLOSED">CLOSED (Tutup)</option>
              </select>
            </div>
          </div>

          <div class="db-form-group">
            <label>Deskripsi &amp; Syarat Kualifikasi *</label>
            <textarea id="jobDescription" class="db-form-control" placeholder="Persyaratan, kualifikasi, &amp; cara melamar..." required></textarea>
          </div>

          <div style="display:flex;justify-content:flex-end;gap:.75rem;margin-top:1.5rem">
            <button type="button" class="db-btn db-btn-ghost" onclick="closeModal()">Batal</button>
            <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Lowongan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Lowongan Kerja Baru';
    document.getElementById('jobId').value = '';
    document.getElementById('jobTitle').value = '';
    document.getElementById('jobCompany').value = '';
    document.getElementById('jobLocation').value = '';
    document.getElementById('jobType').value = 'Full-Time';
    document.getElementById('jobStatus').value = 'OPEN';
    document.getElementById('jobDescription').value = '';
    document.getElementById('jobModal').classList.add('active');
  }

  function openEditModal(item) {
    document.getElementById('modalTitle').textContent = 'Edit Lowongan Kerja';
    document.getElementById('jobId').value = item.id;
    document.getElementById('jobTitle').value = item.title;
    document.getElementById('jobCompany').value = item.company_name;
    document.getElementById('jobLocation').value = item.location || '';
    document.getElementById('jobType').value = item.employment_type || 'Full-Time';
    document.getElementById('jobStatus').value = item.status;
    document.getElementById('jobDescription').value = item.description || '';
    document.getElementById('jobModal').classList.add('active');
  }

  function closeModal() {
    document.getElementById('jobModal').classList.remove('active');
  }

  async function saveJob(e) {
    e.preventDefault();
    const id = document.getElementById('jobId').value;
    const payload = {
      title: document.getElementById('jobTitle').value,
      company_name: document.getElementById('jobCompany').value,
      location: document.getElementById('jobLocation').value,
      employment_type: document.getElementById('jobType').value,
      status: document.getElementById('jobStatus').value,
      description: document.getElementById('jobDescription').value
    };

    const url = id ? `/api/admin/job-vacancies/${id}` : '/api/admin/job-vacancies';
    const method = id ? 'PUT' : 'POST';

    try {
      const res = await fetch(url, {
        method: method,
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast(id ? 'Loker berhasil diperbarui!' : 'Loker baru berhasil ditambahkan!');
        closeModal();
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(data.message || 'Gagal menyimpan data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }

  async function deleteJob(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus lowongan pekerjaan ini?')) return;
    try {
      const res = await fetch(`/api/admin/job-vacancies/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Lowongan berhasil dihapus!');
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(data.message || 'Gagal menghapus data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }
</script>
@endpush
