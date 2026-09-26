@extends('layouts.admin')

@section('title', 'Manajemen School FactCheck — SMK Negeri 2 Mojokerto')

@section('content')
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2>School FactCheck — Klarifikasi Hoaks &amp; Informasi</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Publikasikan klarifikasi resmi sekolah terhadap kabar burung atau isu seputar SMKN 2 Mojokerto.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah FactCheck Baru</button>
      </div>
    </div>

    <!-- FILTER & SEARCH TOOLBAR -->
    <div style="display:flex;gap:1rem;margin-bottom:1.2rem">
      <div style="flex:1;max-width:360px" class="db-search">
        <i class="fas fa-magnifying-glass"></i>
        <input type="text" id="factSearch" placeholder="Cari judul, isu, atau deskripsi..." onkeyup="filterFactCheck()">
      </div>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Judul Klarifikasi</th>
            <th>Klaim / Isu</th>
            <th>Hasil Verifikasi</th>
            <th>Status Info</th>
            <th style="text-align:right">Aksi</th>
          </tr>
        </thead>
        <tbody id="factTableBody">
          @forelse($items as $item)
            <tr data-title="{{ strtolower($item->title) }}" data-claim="{{ strtolower($item->claim) }}">
              <td><strong>{{ $item->title }}</strong></td>
              <td><span style="font-size:.78rem;color:var(--text-muted)">{{ Str::limit($item->claim, 60) }}</span></td>
              <td><span style="font-size:.78rem;color:var(--gold-light)">{{ Str::limit($item->verdict_explanation, 60) }}</span></td>
              <td><span class="db-tag {{ $item->status }}">{{ $item->status }}</span></td>
              <td style="text-align:right">
                <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteFactCheck('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:2rem">Belum ada data School FactCheck.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL CREATE / EDIT -->
  <div class="db-modal-overlay" id="factModal">
    <div class="db-modal">
      <div class="db-modal-head">
        <h3 id="modalTitle">Tambah Clarification FactCheck Baru</h3>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <form id="factForm" onsubmit="saveFactCheck(event)">
          <input type="hidden" id="factId">

          <div class="db-form-group">
            <label>Judul Klarifikasi *</label>
            <input type="text" id="factTitle" class="db-form-control" placeholder="Contoh: Klarifikasi Isu Biaya Pendaftaran PPDB" required>
          </div>

          <div class="db-form-group">
            <label>Isu / Klaim yang Beredar *</label>
            <textarea id="factClaim" class="db-form-control" placeholder="Tuliskan berita burung / kabar hoax yang beredar di masyarakat..." required></textarea>
          </div>

          <div class="db-form-group">
            <label>Penjelasan Verifikasi Resmi *</label>
            <textarea id="factVerdict" class="db-form-control" placeholder="Penjelasan fakta yang sebenarnya dari pihak sekolah..." required></textarea>
          </div>

          <div class="db-form-group">
            <label>Status Kategori Verifikasi</label>
            <select id="factStatus" class="db-form-control">
              <option value="FALSE">HOAKS / TIDAK BENAR (FALSE)</option>
              <option value="TRUE">BENAR / FAKTA (TRUE)</option>
              <option value="MISLEADING">MENYESATKAN / KELIRU (MISLEADING)</option>
            </select>
          </div>

          <div style="display:flex;justify-content:flex-end;gap:.75rem;margin-top:1.5rem">
            <button type="button" class="db-btn db-btn-ghost" onclick="closeModal()">Batal</button>
            <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan FactCheck</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function filterFactCheck() {
    const query = document.getElementById('factSearch').value.toLowerCase();
    const rows = document.querySelectorAll('#factTableBody tr');
    rows.forEach(row => {
      const title = row.getAttribute('data-title') || '';
      const claim = row.getAttribute('data-claim') || '';
      row.style.display = (title.includes(query) || claim.includes(query)) ? '' : 'none';
    });
  }

  function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah FactCheck Baru';
    document.getElementById('factId').value = '';
    document.getElementById('factTitle').value = '';
    document.getElementById('factClaim').value = '';
    document.getElementById('factVerdict').value = '';
    document.getElementById('factStatus').value = 'FALSE';
    document.getElementById('factModal').classList.add('active');
  }

  function openEditModal(item) {
    document.getElementById('modalTitle').textContent = 'Edit FactCheck';
    document.getElementById('factId').value = item.id;
    document.getElementById('factTitle').value = item.title;
    document.getElementById('factClaim').value = item.claim || '';
    document.getElementById('factVerdict').value = item.verdict_explanation || '';
    document.getElementById('factStatus').value = item.status;
    document.getElementById('factModal').classList.add('active');
  }

  function closeModal() {
    document.getElementById('factModal').classList.remove('active');
  }

  async function saveFactCheck(e) {
    e.preventDefault();
    const id = document.getElementById('factId').value;
    const payload = {
      title: document.getElementById('factTitle').value,
      claim: document.getElementById('factClaim').value,
      verdict_explanation: document.getElementById('factVerdict').value,
      status: document.getElementById('factStatus').value
    };

    const url = id ? `/api/admin/fact-check/${id}` : '/api/admin/fact-check';
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
        showToast(id ? 'FactCheck berhasil diperbarui!' : 'FactCheck baru berhasil dipublikasikan!');
        closeModal();
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(data.message || 'Gagal menyimpan data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }

  async function deleteFactCheck(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data FactCheck ini?')) return;
    try {
      const res = await fetch(`/api/admin/fact-check/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('FactCheck berhasil dihapus!');
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
