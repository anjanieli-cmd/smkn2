@extends('layouts.admin')

@section('title', 'Manajemen Jurusan & Program Keahlian — SMK Negeri 2 Mojokerto')

@section('content')
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2>Jurusan &amp; Program Keahlian</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Kelola daftar konsentrasi keahlian sekolah (RPL, DKV, APHP, Kuliner, LPS).</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Jurusan Baru</button>
      </div>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama Program Keahlian</th>
            <th>Slug</th>
            <th>Deskripsi Singkat</th>
            <th style="text-align:right">Aksi</th>
          </tr>
        </thead>
        <tbody id="majorTableBody">
          @forelse($items as $item)
            <tr>
              <td><strong style="color:var(--gold-light);font-family:monospace">{{ $item->code }}</strong></td>
              <td><strong>{{ $item->name }}</strong></td>
              <td><span style="font-size:.75rem;color:var(--text-muted)">{{ $item->slug }}</span></td>
              <td><span style="font-size:.78rem;color:rgba(255,255,255,.8)">{{ Str::limit($item->description, 60) }}</span></td>
              <td style="text-align:right">
                <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteMajor('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:2rem">Belum ada data Jurusan.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL CREATE / EDIT -->
  <div class="db-modal-overlay" id="majorModal">
    <div class="db-modal">
      <div class="db-modal-head">
        <h3 id="modalTitle">Tambah Jurusan Baru</h3>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <form id="majorForm" onsubmit="saveMajor(event)">
          <input type="hidden" id="majorId">

          <div style="display:grid;grid-template-columns:1fr 2fr;gap:1rem">
            <div class="db-form-group">
              <label>Kode Singkat *</label>
              <input type="text" id="majorCode" class="db-form-control" placeholder="Contoh: RPL" required>
            </div>
            <div class="db-form-group">
              <label>Nama Konsentrasi Keahlian *</label>
              <input type="text" id="majorName" class="db-form-control" placeholder="Contoh: Rekayasa Perangkat Lunak" required>
            </div>
          </div>

          <div class="db-form-group">
            <label>Slug URL (Opsional)</label>
            <input type="text" id="majorSlug" class="db-form-control" placeholder="rekayasa-perangkat-lunak">
          </div>

          <div class="db-form-group">
            <label>Deskripsi *</label>
            <textarea id="majorDescription" class="db-form-control" placeholder="Penjelasan bidang keahlian &amp; prospek karir..." required></textarea>
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
    document.getElementById('modalTitle').textContent = 'Tambah Jurusan Baru';
    document.getElementById('majorId').value = '';
    document.getElementById('majorCode').value = '';
    document.getElementById('majorName').value = '';
    document.getElementById('majorSlug').value = '';
    document.getElementById('majorDescription').value = '';
    document.getElementById('majorModal').classList.add('active');
  }

  function openEditModal(item) {
    document.getElementById('modalTitle').textContent = 'Edit Data Jurusan';
    document.getElementById('majorId').value = item.id;
    document.getElementById('majorCode').value = item.code;
    document.getElementById('majorName').value = item.name;
    document.getElementById('majorSlug').value = item.slug || '';
    document.getElementById('majorDescription').value = item.description || '';
    document.getElementById('majorModal').classList.add('active');
  }

  function closeModal() {
    document.getElementById('majorModal').classList.remove('active');
  }

  async function saveMajor(e) {
    e.preventDefault();
    const id = document.getElementById('majorId').value;
    const payload = {
      code: document.getElementById('majorCode').value,
      name: document.getElementById('majorName').value,
      slug: document.getElementById('majorSlug').value,
      description: document.getElementById('majorDescription').value
    };

    const url = id ? `/api/admin/majors/${id}` : '/api/admin/majors';
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
        showToast(id ? 'Jurusan berhasil diperbarui!' : 'Jurusan baru berhasil ditambahkan!');
        closeModal();
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(data.message || 'Gagal menyimpan data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }

  async function deleteMajor(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus jurusan ini?')) return;
    try {
      const res = await fetch(`/api/admin/majors/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Jurusan berhasil dihapus!');
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
