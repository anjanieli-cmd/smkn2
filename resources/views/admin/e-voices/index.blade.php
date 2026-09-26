@extends('layouts.admin')

@section('title', 'Manajemen E-Voice — SMK Negeri 2 Mojokerto')

@section('content')
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2>E-Voice Suara Siswa &amp; Aspirasi</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Tinjau, tambah, tindak lanjuti, dan berikan balasan admin pada pengaduan &amp; aspirasi siswa.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Aspirasi Baru</button>
      </div>
    </div>

    <!-- FILTER & SEARCH TOOLBAR -->
    <div style="display:flex;gap:1rem;margin-bottom:1.2rem;flex-wrap:wrap">
      <div style="flex:1;max-width:360px" class="db-search">
        <i class="fas fa-magnifying-glass"></i>
        <input type="text" id="evoiceSearch" placeholder="Cari kode tiket, judul, atau deskripsi..." onkeyup="filterEVoice()">
      </div>
      <select id="evoiceStatusFilter" class="db-form-control" style="width:200px" onchange="filterEVoice()">
        <option value="">Semua Status</option>
        <option value="SUBMITTED">SUBMITTED</option>
        <option value="REVIEWING">REVIEWING</option>
        <option value="IN_PROGRESS">IN_PROGRESS</option>
        <option value="RESOLVED">RESOLVED</option>
      </select>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Kode Tiket</th>
            <th>Judul &amp; Deskripsi</th>
            <th>Kategori</th>
            <th>Upvotes</th>
            <th>Status</th>
            <th style="text-align:right">Aksi</th>
          </tr>
        </thead>
        <tbody id="evoiceTableBody">
          @forelse($items as $item)
            <tr data-ticket="{{ strtolower($item->ticket_code) }}" data-title="{{ strtolower($item->title) }}" data-status="{{ $item->status }}">
              <td><strong style="color:var(--gold-light);font-family:monospace">{{ $item->ticket_code }}</strong></td>
              <td>
                <strong>{{ $item->title }}</strong>
                <p style="font-size:.75rem;color:var(--text-muted);margin-top:.2rem">{{ Str::limit($item->description, 70) }}</p>
              </td>
              <td><span style="font-size:.75rem;color:var(--text-muted)">{{ $item->category ?? 'Aspirasi' }}</span></td>
              <td><span style="font-weight:700;color:var(--gold)"><i class="fas fa-thumbs-up"></i> {{ $item->upvotes_count }}</span></td>
              <td><span class="db-tag {{ $item->status }}">{{ $item->status }}</span></td>
              <td style="text-align:right">
                <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Kelola / Balas</button>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteEVoice('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem">Belum ada data pengaduan / aspirasi E-Voice.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL CREATE / EDIT -->
  <div class="db-modal-overlay" id="evoiceModal">
    <div class="db-modal">
      <div class="db-modal-head">
        <h3 id="modalTitle">Buat Aspirasi / Pengaduan E-Voice</h3>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <form id="evoiceForm" onsubmit="saveEVoice(event)">
          <input type="hidden" id="evoiceId">

          <div class="db-form-group">
            <label>Judul Aspirasi / Keluhan *</label>
            <input type="text" id="evoiceTitle" class="db-form-control" placeholder="Judul pengaduan atau ide perbaikan" required>
          </div>

          <div class="db-form-group">
            <label>Kategori</label>
            <select id="evoiceCategory" class="db-form-control">
              <option value="ASPIRASI">Aspirasi</option>
              <option value="FASILITAS">Fasilitas Sekolah</option>
              <option value="AKADEMIK">Akademik &amp; KBM</option>
              <option value="KEGIATAN">Kegiatan &amp; Ekskul</option>
            </select>
          </div>

          <div class="db-form-group">
            <label>Deskripsi Lengkap *</label>
            <textarea id="evoiceDescription" class="db-form-control" placeholder="Tuliskan rincian aspirasi atau tanggapan..." required></textarea>
          </div>

          <div class="db-form-group">
            <label>Status Penanganan</label>
            <select id="evoiceStatus" class="db-form-control">
              <option value="SUBMITTED">SUBMITTED (Baru Masuk)</option>
              <option value="REVIEWING">REVIEWING (Dalam Peninjauan)</option>
              <option value="IN_PROGRESS">IN_PROGRESS (Dalam Proses)</option>
              <option value="RESOLVED">RESOLVED (Selesai Ditindaklanjuti)</option>
            </select>
          </div>

          <div class="db-form-group" id="adminResponseGroup">
            <label>Tanggapan / Balasan Resmi Admin</label>
            <textarea id="adminResponse" class="db-form-control" placeholder="Tanggapan resmi sekolah terhadap pengaduan ini..."></textarea>
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
  function filterEVoice() {
    const query = document.getElementById('evoiceSearch').value.toLowerCase();
    const status = document.getElementById('evoiceStatusFilter').value;
    const rows = document.querySelectorAll('#evoiceTableBody tr');
    rows.forEach(row => {
      const ticket = row.getAttribute('data-ticket') || '';
      const title = row.getAttribute('data-title') || '';
      const rowStatus = row.getAttribute('data-status') || '';
      const matchesSearch = ticket.includes(query) || title.includes(query);
      const matchesStatus = !status || rowStatus === status;
      row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
    });
  }

  function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Aspirasi / Pengaduan E-Voice';
    document.getElementById('evoiceId').value = '';
    document.getElementById('evoiceTitle').value = '';
    document.getElementById('evoiceCategory').value = 'ASPIRASI';
    document.getElementById('evoiceDescription').value = '';
    document.getElementById('evoiceStatus').value = 'REVIEWING';
    document.getElementById('adminResponse').value = '';
    document.getElementById('evoiceModal').classList.add('active');
  }

  function openEditModal(item) {
    document.getElementById('modalTitle').textContent = 'Kelola / Balas E-Voice (' + item.ticket_code + ')';
    document.getElementById('evoiceId').value = item.id;
    document.getElementById('evoiceTitle').value = item.title;
    document.getElementById('evoiceCategory').value = item.category || 'ASPIRASI';
    document.getElementById('evoiceDescription').value = item.description || '';
    document.getElementById('evoiceStatus').value = item.status;
    document.getElementById('adminResponse').value = item.admin_response || '';
    document.getElementById('evoiceModal').classList.add('active');
  }

  function closeModal() {
    document.getElementById('evoiceModal').classList.remove('active');
  }

  async function saveEVoice(e) {
    e.preventDefault();
    const id = document.getElementById('evoiceId').value;
    const isEdit = !!id;

    if (isEdit) {
      // Update status and response
      try {
        const res = await fetch(`/api/admin/e-voice/${id}/status`, {
          method: 'PATCH',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            status: document.getElementById('evoiceStatus').value,
            admin_response: document.getElementById('adminResponse').value
          })
        });
        const data = await res.json();
        if (res.ok && data.success) {
          showToast('Status & Balasan E-Voice berhasil diperbarui!');
          closeModal();
          setTimeout(() => location.reload(), 800);
        } else {
          showToast(data.message || 'Gagal memperbarui data.', 'error');
        }
      } catch (err) {
        showToast('Terjadi kesalahan koneksi server.', 'error');
      }
    } else {
      // Create new E-Voice
      try {
        const res = await fetch('/api/admin/e-voice', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            title: document.getElementById('evoiceTitle').value,
            category: document.getElementById('evoiceCategory').value,
            description: document.getElementById('evoiceDescription').value,
            status: document.getElementById('evoiceStatus').value
          })
        });
        const data = await res.json();
        if (res.ok && data.success) {
          showToast('Aspirasi E-Voice baru berhasil ditambahkan!');
          closeModal();
          setTimeout(() => location.reload(), 800);
        } else {
          showToast(data.message || 'Gagal menambahkan aspirasi.', 'error');
        }
      } catch (err) {
        showToast('Terjadi kesalahan koneksi server.', 'error');
      }
    }
  }

  async function deleteEVoice(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data E-Voice ini?')) return;
    try {
      const res = await fetch(`/api/admin/e-voice/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('E-Voice berhasil dihapus!');
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
