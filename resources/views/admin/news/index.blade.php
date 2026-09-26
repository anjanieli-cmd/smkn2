@extends('layouts.admin')

@section('title', 'Manajemen Berita & Artikel — SMK Negeri 2 Mojokerto')

@section('content')
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2>Berita &amp; Artikel Sekolah</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Kelola artikel pengumuman, liputan kegiatan, dan prestasi sekolah.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Berita Baru</button>
      </div>
    </div>

    <!-- SEARCH TOOLBAR -->
    <div style="display:flex;gap:1rem;margin-bottom:1.2rem">
      <div style="flex:1;max-width:360px" class="db-search">
        <i class="fas fa-magnifying-glass"></i>
        <input type="text" id="newsSearch" placeholder="Cari judul atau isi berita..." onkeyup="filterNews()">
      </div>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Gambar</th>
            <th>Judul Artikel</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Tanggal Dibuat</th>
            <th style="text-align:right">Aksi</th>
          </tr>
        </thead>
        <tbody id="newsTableBody">
          @forelse($items as $item)
            <tr data-title="{{ strtolower($item->title) }}">
              <td style="width:60px">
                @if($item->thumbnail_url)
                  <img src="{{ asset($item->thumbnail_url) }}" alt="" style="width:40px;height:40px;border-radius:10px;object-fit:cover">
                @else
                  <div style="width:40px;height:40px;border-radius:10px;background:rgba(255,179,0,.15);color:var(--gold);display:flex;align-items:center;justify-content:center"><i class="fas fa-newspaper"></i></div>
                @endif
              </td>
              <td><strong>{{ $item->title }}</strong></td>
              <td><span style="font-size:.78rem;color:var(--text-muted)">{{ $item->category }}</span></td>
              <td><span class="db-tag {{ strtolower($item->status ?? 'published') }}">{{ $item->status ?? 'PUBLISHED' }}</span></td>
              <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
              <td style="text-align:right">
                <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteNews('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem">Belum ada artikel berita.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL CREATE / EDIT -->
  <div class="db-modal-overlay" id="newsModal">
    <div class="db-modal">
      <div class="db-modal-head">
        <h3 id="modalTitle">Tambah Berita / Artikel Baru</h3>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <form id="newsForm" onsubmit="saveNews(event)">
          <input type="hidden" id="newsId">

          <div class="db-form-group">
            <label>Judul Artikel *</label>
            <input type="text" id="newsTitle" class="db-form-control" placeholder="Judul berita sekolah" required>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="db-form-group">
              <label>Kategori *</label>
              <input type="text" id="newsCategory" class="db-form-control" placeholder="Pengumuman / Kegiatan / Prestasi" required>
            </div>
            <div class="db-form-group">
              <label>Status Publikasi</label>
              <select id="newsStatus" class="db-form-control">
                <option value="PUBLISHED">PUBLISHED</option>
                <option value="DRAFT">DRAFT</option>
              </select>
            </div>
          </div>

          <div class="db-form-group">
            <label>Thumbnail Path / URL Gambar</label>
            <input type="text" id="newsImage" class="db-form-control" placeholder="images/berita/kegiatan-1.jpg">
          </div>

          <div class="db-form-group">
            <label>Konten Artikel *</label>
            <textarea id="newsContent" class="db-form-control" style="min-height:140px" placeholder="Tuliskan isi berita artikel secara detail..." required></textarea>
          </div>

          <div style="display:flex;justify-content:flex-end;gap:.75rem;margin-top:1.5rem">
            <button type="button" class="db-btn db-btn-ghost" onclick="closeModal()">Batal</button>
            <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Berita</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function filterNews() {
    const query = document.getElementById('newsSearch').value.toLowerCase();
    const rows = document.querySelectorAll('#newsTableBody tr');
    rows.forEach(row => {
      const title = row.getAttribute('data-title') || '';
      row.style.display = title.includes(query) ? '' : 'none';
    });
  }

  function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Berita / Artikel Baru';
    document.getElementById('newsId').value = '';
    document.getElementById('newsTitle').value = '';
    document.getElementById('newsCategory').value = 'Kegiatan';
    document.getElementById('newsStatus').value = 'PUBLISHED';
    document.getElementById('newsImage').value = '';
    document.getElementById('newsContent').value = '';
    document.getElementById('newsModal').classList.add('active');
  }

  function openEditModal(item) {
    document.getElementById('modalTitle').textContent = 'Edit Berita Artikel';
    document.getElementById('newsId').value = item.id;
    document.getElementById('newsTitle').value = item.title;
    document.getElementById('newsCategory').value = item.category || 'Kegiatan';
    document.getElementById('newsStatus').value = item.status || 'PUBLISHED';
    document.getElementById('newsImage').value = item.thumbnail_url || '';
    document.getElementById('newsContent').value = item.content || '';
    document.getElementById('newsModal').classList.add('active');
  }

  function closeModal() {
    document.getElementById('newsModal').classList.remove('active');
  }

  async function saveNews(e) {
    e.preventDefault();
    const id = document.getElementById('newsId').value;
    const payload = {
      title: document.getElementById('newsTitle').value,
      category: document.getElementById('newsCategory').value,
      status: document.getElementById('newsStatus').value,
      thumbnail_url: document.getElementById('newsImage').value,
      content: document.getElementById('newsContent').value
    };

    const url = id ? `/api/admin/news/${id}` : '/api/admin/news';
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
        showToast(id ? 'Berita berhasil diperbarui!' : 'Berita baru berhasil ditambahkan!');
        closeModal();
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(data.message || 'Gagal menyimpan berita.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }

  async function deleteNews(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus artikel berita ini?')) return;
    try {
      const res = await fetch(`/api/admin/news/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Berita berhasil dihapus!');
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(data.message || 'Gagal menghapus berita.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }
</script>
@endpush
