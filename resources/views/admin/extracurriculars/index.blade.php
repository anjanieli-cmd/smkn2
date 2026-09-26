@extends('layouts.admin')

@section('title', 'Manajemen Ekstrakurikuler — SMK Negeri 2 Mojokerto')

@section('content')
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2>Ekstrakurikuler &amp; Organisasi Siswa</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Kelola 13 kegiatan ekstrakurikuler &amp; 3 organisasi siswa SMKN 2 Mojokerto.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Ekskul Baru</button>
      </div>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Nama Ekskul / Organisasi</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th style="text-align:right">Aksi</th>
          </tr>
        </thead>
        <tbody id="extraTableBody">
          @forelse($items as $item)
            <tr>
              <td><strong style="color:var(--gold-light)">{{ $item->name }}</strong></td>
              <td><span class="db-tag REVIEWING">{{ $item->category }}</span></td>
              <td><span style="font-size:.78rem;color:rgba(255,255,255,.8)">{{ Str::limit($item->description, 70) }}</span></td>
              <td style="text-align:right">
                <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteExtra('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="4" style="text-align:center;color:var(--text-muted);padding:2rem">Belum ada data Ekstrakurikuler.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL CREATE / EDIT -->
  <div class="db-modal-overlay" id="extraModal">
    <div class="db-modal">
      <div class="db-modal-head">
        <h3 id="modalTitle">Tambah Ekstrakurikuler Baru</h3>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <form id="extraForm" onsubmit="saveExtra(event)">
          <input type="hidden" id="extraId">

          <div class="db-form-group">
            <label>Nama Ekstrakurikuler / Organisasi *</label>
            <input type="text" id="extraName" class="db-form-control" placeholder="Contoh: Robotik & Coding Club" required>
          </div>

          <div class="db-form-group">
            <label>Kategori *</label>
            <select id="extraCategory" class="db-form-control">
              <option value="Teknologi">Teknologi</option>
              <option value="Olahraga">Olahraga</option>
              <option value="Seni & Budaya">Seni &amp; Budaya</option>
              <option value="Keagamaan">Keagamaan</option>
              <option value="Kedisiplinan">Kedisiplinan</option>
              <option value="Kepanduan">Kepanduan</option>
              <option value="Kesehatan">Kesehatan</option>
              <option value="Media & Literasi">Media &amp; Literasi</option>
              <option value="Bela Diri">Bela Diri</option>
              <option value="Organisasi">Organisasi</option>
            </select>
          </div>

          <div class="db-form-group">
            <label>Deskripsi *</label>
            <textarea id="extraDescription" class="db-form-control" placeholder="Penjelasan kegiatan, tujuan, &amp; jadwal..." required></textarea>
          </div>

          <div style="display:flex;justify-content:flex-end;gap:.75rem;margin-top:1.5rem">
            <button type="button" class="db-btn db-btn-ghost" onclick="closeModal()">Batal</button>
            <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Ekstrakurikuler Baru';
    document.getElementById('extraId').value = '';
    document.getElementById('extraName').value = '';
    document.getElementById('extraCategory').value = 'Teknologi';
    document.getElementById('extraDescription').value = '';
    document.getElementById('extraModal').classList.add('active');
  }

  function openEditModal(item) {
    document.getElementById('modalTitle').textContent = 'Edit Data Ekstrakurikuler';
    document.getElementById('extraId').value = item.id;
    document.getElementById('extraName').value = item.name;
    document.getElementById('extraCategory').value = item.category || 'Teknologi';
    document.getElementById('extraDescription').value = item.description || '';
    document.getElementById('extraModal').classList.add('active');
  }

  function closeModal() {
    document.getElementById('extraModal').classList.remove('active');
  }

  async function saveExtra(e) {
    e.preventDefault();
    const id = document.getElementById('extraId').value;
    const payload = {
      name: document.getElementById('extraName').value,
      category: document.getElementById('extraCategory').value,
      description: document.getElementById('extraDescription').value
    };

    const url = id ? `/api/admin/extracurriculars/${id}` : '/api/admin/extracurriculars';
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
        showToast(id ? 'Ekskul berhasil diperbarui!' : 'Ekskul baru berhasil ditambahkan!');
        closeModal();
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(data.message || 'Gagal menyimpan data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }

  async function deleteExtra(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data ekstrakurikuler ini?')) return;
    try {
      const res = await fetch(`/api/admin/extracurriculars/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Ekskul berhasil dihapus!');
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
