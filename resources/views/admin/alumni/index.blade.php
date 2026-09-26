@extends('layouts.admin')

@section('title', 'Manajemen Alumni — SMK Negeri 2 Mojokerto')

@section('content')
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2>Data Alumni &amp; Peta Sebaran</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Kelola profil alumni, status (Bekerja / Kuliah / Wirausaha), &amp; lokasi koordinat sebaran.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Alumni Baru</button>
      </div>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Nama Alumni</th>
            <th>Tahun Lulus</th>
            <th>Jurusan</th>
            <th>Status Karir / Studi</th>
            <th>Kota / Perusahaan / Kampus</th>
            <th style="text-align:right">Aksi</th>
          </tr>
        </thead>
        <tbody id="alumniTableBody">
          @forelse($items as $item)
            <tr>
              <td><strong>{{ $item->name }}</strong></td>
              <td><span style="font-weight:700;color:var(--gold-light)">{{ $item->graduation_year }}</span></td>
              <td><span style="font-size:.78rem;color:var(--text-muted)">{{ $item->major->code ?? '-' }}</span></td>
              <td><span class="db-tag REVIEWING">{{ $item->status->value ?? $item->status }}</span></td>
              <td>
                <span style="font-size:.78rem;color:rgba(255,255,255,.85)">
                  {{ $item->company ?? $item->university ?? '-' }} ({{ $item->city ?? '-' }})
                </span>
              </td>
              <td style="text-align:right">
                <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteAlumni('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem">Belum ada data Alumni.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL CREATE / EDIT -->
  <div class="db-modal-overlay" id="alumniModal">
    <div class="db-modal">
      <div class="db-modal-head">
        <h3 id="modalTitle">Tambah Alumni Baru</h3>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <form id="alumniForm" onsubmit="saveAlumni(event)">
          <input type="hidden" id="alumniId">

          <div class="db-form-group">
            <label>Nama Alumni *</label>
            <input type="text" id="alumniName" class="db-form-control" placeholder="Contoh: Budi Santoso" required>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="db-form-group">
              <label>Tahun Lulus *</label>
              <input type="number" id="graduationYear" class="db-form-control" placeholder="2024" required>
            </div>
            <div class="db-form-group">
              <label>Jurusan</label>
              <select id="alumniMajorId" class="db-form-control">
                @foreach(\App\Models\Major::all() as $m)
                  <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->code }})</option>
                @endforeach
              </select>
            </div>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="db-form-group">
              <label>Status Saat Ini</label>
              <select id="alumniStatus" class="db-form-control">
                <option value="WORKING">Bekerja (WORKING)</option>
                <option value="STUDYING">Kuliah (STUDYING)</option>
                <option value="ENTREPRENEUR">Wirausaha (ENTREPRENEUR)</option>
                <option value="SEARCHING">Mencari Kerja (SEARCHING)</option>
              </select>
            </div>
            <div class="db-form-group">
              <label>Perusahaan / Kampus / Usaha</label>
              <input type="text" id="alumniCompany" class="db-form-control" placeholder="Contoh: Tokopedia / ITS / Kedai Kopi">
            </div>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="db-form-group">
              <label>Kota / Wilayah</label>
              <input type="text" id="alumniCity" class="db-form-control" placeholder="Contoh: Surabaya">
            </div>
            <div class="db-form-group">
              <label>Jabatan / Program Studi</label>
              <input type="text" id="alumniJobTitle" class="db-form-control" placeholder="Contoh: Software Engineer / S1 Informatika">
            </div>
          </div>

          <div style="display:flex;justify-content:flex-end;gap:.75rem;margin-top:1.5rem">
            <button type="button" class="db-btn db-btn-ghost" onclick="closeModal()">Batal</button>
            <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Alumni</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Alumni Baru';
    document.getElementById('alumniId').value = '';
    document.getElementById('alumniName').value = '';
    document.getElementById('graduationYear').value = new Date().getFullYear();
    document.getElementById('alumniStatus').value = 'WORKING';
    document.getElementById('alumniCompany').value = '';
    document.getElementById('alumniCity').value = '';
    document.getElementById('alumniJobTitle').value = '';
    document.getElementById('alumniModal').classList.add('active');
  }

  function openEditModal(item) {
    document.getElementById('modalTitle').textContent = 'Edit Data Alumni';
    document.getElementById('alumniId').value = item.id;
    document.getElementById('alumniName').value = item.name;
    document.getElementById('graduationYear').value = item.graduation_year;
    document.getElementById('alumniMajorId').value = item.major_id || '';
    document.getElementById('alumniStatus').value = item.status.value || item.status;
    document.getElementById('alumniCompany').value = item.company || item.university || '';
    document.getElementById('alumniCity').value = item.city || '';
    document.getElementById('alumniJobTitle').value = item.job_title || '';
    document.getElementById('alumniModal').classList.add('active');
  }

  function closeModal() {
    document.getElementById('alumniModal').classList.remove('active');
  }

  async function saveAlumni(e) {
    e.preventDefault();
    const id = document.getElementById('alumniId').value;
    const payload = {
      name: document.getElementById('alumniName').value,
      graduation_year: document.getElementById('graduationYear').value,
      major_id: document.getElementById('alumniMajorId').value,
      status: document.getElementById('alumniStatus').value,
      company: document.getElementById('alumniCompany').value,
      city: document.getElementById('alumniCity').value,
      job_title: document.getElementById('alumniJobTitle').value
    };

    const url = id ? `/api/admin/alumni/${id}` : '/api/admin/alumni';
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
        showToast(id ? 'Alumni berhasil diperbarui!' : 'Alumni baru berhasil ditambahkan!');
        closeModal();
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(data.message || 'Gagal menyimpan data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }

  async function deleteAlumni(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data alumni ini?')) return;
    try {
      const res = await fetch(`/api/admin/alumni/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Alumni berhasil dihapus!');
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
