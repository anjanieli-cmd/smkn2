@extends('layouts.admin')

@section('title', 'Manajemen Knowledge Base Chatbot NARA — SMK Negeri 2 Mojokerto')

@section('content')
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2>Knowledge Base Chatbot NARA AI</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Kelola basis pengetahuan AI NARA agar dapat menjawab pertanyaan seputar sekolah secara realtime.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Pengetahuan Baru</button>
      </div>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Judul Pengetahuan</th>
            <th>Kategori</th>
            <th>Konten Ringkas</th>
            <th>Kata Kunci / Keywords</th>
            <th>Status</th>
            <th style="text-align:right">Aksi</th>
          </tr>
        </thead>
        <tbody id="kbTableBody">
          @forelse($items as $item)
            <tr>
              <td><strong>{{ $item->title }}</strong></td>
              <td><span style="font-size:.75rem;color:var(--gold-light)">{{ $item->category }}</span></td>
              <td><span style="font-size:.78rem;color:rgba(255,255,255,.8)">{{ Str::limit($item->content, 60) }}</span></td>
              <td><span style="font-size:.72rem;font-family:monospace;color:var(--text-muted)">{{ is_array($item->keywords) ? implode(', ', $item->keywords) : $item->keywords }}</span></td>
              <td><span class="db-tag {{ strtolower($item->status->value ?? $item->status) }}">{{ $item->status->value ?? $item->status }}</span></td>
              <td style="text-align:right">
                <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteKb('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem">Belum ada basis pengetahuan AI.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL CREATE / EDIT -->
  <div class="db-modal-overlay" id="kbModal">
    <div class="db-modal">
      <div class="db-modal-head">
        <h3 id="modalTitle">Tambah Pengetahuan AI Baru</h3>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <form id="kbForm" onsubmit="saveKb(event)">
          <input type="hidden" id="kbId">

          <div class="db-form-group">
            <label>Judul Pengetahuan *</label>
            <input type="text" id="kbTitle" class="db-form-control" placeholder="Contoh: Lokasi dan Jam Belajar Sekolah" required>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="db-form-group">
              <label>Kategori *</label>
              <input type="text" id="kbCategory" class="db-form-control" placeholder="Profil / Jurusan / Ekskul / PPDB" required>
            </div>
            <div class="db-form-group">
              <label>Status</label>
              <select id="kbStatus" class="db-form-control">
                <option value="PUBLISHED">PUBLISHED</option>
                <option value="DRAFT">DRAFT</option>
              </select>
            </div>
          </div>

          <div class="db-form-group">
            <label>Kata Kunci / Keywords (Pisahkan dengan koma)</label>
            <input type="text" id="kbKeywords" class="db-form-control" placeholder="alamat, lokasi, jam masuk, jadwal, telepon">
          </div>

          <div class="db-form-group">
            <label>Penjelasan Konten AI *</label>
            <textarea id="kbContent" class="db-form-control" style="min-height:120px" placeholder="Tuliskan jawaban &amp; fakta lengkap yang dipahami oleh Chatbot AI NARA..." required></textarea>
          </div>

          <div style="display:flex;justify-content:flex-end;gap:.75rem;margin-top:1.5rem">
            <button type="button" class="db-btn db-btn-ghost" onclick="closeModal()">Batal</button>
            <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Pengetahuan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Pengetahuan AI Baru';
    document.getElementById('kbId').value = '';
    document.getElementById('kbTitle').value = '';
    document.getElementById('kbCategory').value = 'Profil';
    document.getElementById('kbStatus').value = 'PUBLISHED';
    document.getElementById('kbKeywords').value = '';
    document.getElementById('kbContent').value = '';
    document.getElementById('kbModal').classList.add('active');
  }

  function openEditModal(item) {
    document.getElementById('modalTitle').textContent = 'Edit Pengetahuan AI';
    document.getElementById('kbId').value = item.id;
    document.getElementById('kbTitle').value = item.title;
    document.getElementById('kbCategory').value = item.category || 'Profil';
    document.getElementById('kbStatus').value = item.status.value || item.status;
    document.getElementById('kbKeywords').value = Array.isArray(item.keywords) ? item.keywords.join(', ') : (item.keywords || '');
    document.getElementById('kbContent').value = item.content || '';
    document.getElementById('kbModal').classList.add('active');
  }

  function closeModal() {
    document.getElementById('kbModal').classList.remove('active');
  }

  async function saveKb(e) {
    e.preventDefault();
    const id = document.getElementById('kbId').value;
    const keywordsRaw = document.getElementById('kbKeywords').value;
    const keywordsArr = keywordsRaw.split(',').map(s => s.trim()).filter(Boolean);

    const payload = {
      title: document.getElementById('kbTitle').value,
      category: document.getElementById('kbCategory').value,
      status: document.getElementById('kbStatus').value,
      keywords: keywordsArr,
      content: document.getElementById('kbContent').value
    };

    const url = id ? `/api/admin/chatbot-knowledge/${id}` : '/api/admin/chatbot-knowledge';
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
        showToast(id ? 'Pengetahuan AI berhasil diperbarui!' : 'Pengetahuan AI baru berhasil ditambahkan!');
        closeModal();
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(data.message || 'Gagal menyimpan data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }

  async function deleteKb(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data pengetahuan ini?')) return;
    try {
      const res = await fetch(`/api/admin/chatbot-knowledge/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Pengetahuan AI berhasil dihapus!');
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
