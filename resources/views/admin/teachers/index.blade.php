@extends('layouts.admin')

@section('title', 'Manajemen Guru & Staf — SMK Negeri 2 Mojokerto')

@section('content')
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2>Data Guru &amp; Tenaga Kependidikan</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Kelola seluruh pendidik &amp; staf sekolah yang tampil di halaman Profil Guru &amp; Staf.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Guru / Staf</button>
      </div>
    </div>

    <!-- FILTER & SEARCH TOOLBAR -->
    <div style="display:flex;gap:1rem;margin-bottom:1.2rem">
      <div style="flex:1;max-width:360px" class="db-search">
        <i class="fas fa-magnifying-glass"></i>
        <input type="text" id="teacherSearch" placeholder="Cari nama, NIP, atau jabatan..." onkeyup="filterTeachers()">
      </div>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Foto</th>
            <th>Nama Lengkap</th>
            <th>NIP</th>
            <th>Jabatan / Peran</th>
            <th>Status</th>
            <th style="text-align:right">Aksi</th>
          </tr>
        </thead>
        <tbody id="teacherTableBody">
          @forelse($teachers as $item)
            <tr data-name="{{ strtolower($item->name) }}" data-nip="{{ strtolower($item->nip ?? '') }}" data-role="{{ strtolower($item->role_position ?? '') }}">
              <td style="width:60px">
                @if($item->photo_url)
                  <img src="{{ asset($item->photo_url) }}" alt="{{ $item->name }}" style="width:40px;height:40px;border-radius:10px;object-fit:cover">
                @else
                  <div style="width:40px;height:40px;border-radius:10px;background:rgba(255,179,0,.15);color:var(--gold);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.9rem">
                    {{ substr($item->name, 0, 1) }}
                  </div>
                @endif
              </td>
              <td><strong>{{ $item->name }}</strong></td>
              <td><span style="font-family:monospace;color:var(--text-muted)">{{ $item->nip ?? '-' }}</span></td>
              <td><span style="color:var(--gold-light)">{{ $item->role_position }}</span></td>
              <td>
                <span class="db-tag {{ $item->is_active ? 'active' : 'inactive' }}">
                  {{ $item->is_active ? 'Aktif' : 'Non-Aktif' }}
                </span>
              </td>
              <td style="text-align:right">
                <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteTeacher('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:2rem">Belum ada data Guru &amp; Staf.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL CREATE / EDIT -->
  <div class="db-modal-overlay" id="teacherModal">
    <div class="db-modal">
      <div class="db-modal-head">
        <h3 id="modalTitle">Tambah Guru / Staf Baru</h3>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <form id="teacherForm" onsubmit="saveTeacher(event)">
          <input type="hidden" id="teacherId" name="id">

          <div class="db-form-group">
            <label>Nama Lengkap (dengan Gelar) *</label>
            <input type="text" id="teacherName" class="db-form-control" placeholder="Contoh: Dra. Lugiati" required>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="db-form-group">
              <label>NIP (Opsional)</label>
              <input type="text" id="teacherNip" class="db-form-control" placeholder="198503152010012011">
            </div>
            <div class="db-form-group">
              <label>Jabatan / Bidang Studi *</label>
              <input type="text" id="teacherRole" class="db-form-control" placeholder="Contoh: Guru Produktif Kuliner" required>
            </div>
          </div>

          <div class="db-form-group">
            <label>Path Photo (URL / Upload Path)</label>
            <input type="text" id="teacherPhoto" class="db-form-control" placeholder="images/guru/iswahyudi.png">
          </div>

          <div class="db-form-group">
            <label>Status Keaktifan</label>
            <select id="teacherStatus" class="db-form-control">
              <option value="1">Aktif</option>
              <option value="0">Non-Aktif</option>
            </select>
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
  function filterTeachers() {
    const query = document.getElementById('teacherSearch').value.toLowerCase();
    const rows = document.querySelectorAll('#teacherTableBody tr');
    rows.forEach(row => {
      const name = row.getAttribute('data-name') || '';
      const nip = row.getAttribute('data-nip') || '';
      const role = row.getAttribute('data-role') || '';
      if (name.includes(query) || nip.includes(query) || role.includes(query)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Guru / Staf Baru';
    document.getElementById('teacherId').value = '';
    document.getElementById('teacherName').value = '';
    document.getElementById('teacherNip').value = '';
    document.getElementById('teacherRole').value = '';
    document.getElementById('teacherPhoto').value = '';
    document.getElementById('teacherStatus').value = '1';
    document.getElementById('teacherModal').classList.add('active');
  }

  function openEditModal(item) {
    document.getElementById('modalTitle').textContent = 'Edit Data Guru / Staf';
    document.getElementById('teacherId').value = item.id;
    document.getElementById('teacherName').value = item.name;
    document.getElementById('teacherNip').value = item.nip || '';
    document.getElementById('teacherRole').value = item.role_position || '';
    document.getElementById('teacherPhoto').value = item.photo_url || '';
    document.getElementById('teacherStatus').value = item.is_active ? '1' : '0';
    document.getElementById('teacherModal').classList.add('active');
  }

  function closeModal() {
    document.getElementById('teacherModal').classList.remove('active');
  }

  async function saveTeacher(e) {
    e.preventDefault();
    const id = document.getElementById('teacherId').value;
    const payload = {
      name: document.getElementById('teacherName').value,
      nip: document.getElementById('teacherNip').value,
      role_position: document.getElementById('teacherRole').value,
      photo_url: document.getElementById('teacherPhoto').value,
      is_active: document.getElementById('teacherStatus').value === '1'
    };

    const url = id ? `/api/admin/teachers/${id}` : '/api/admin/teachers';
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
        showToast(id ? 'Data Guru/Staf berhasil diperbarui!' : 'Guru/Staf baru berhasil ditambahkan!');
        closeModal();
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(data.message || 'Gagal menyimpan data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }

  async function deleteTeacher(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data guru/staf ini?')) return;
    try {
      const res = await fetch(`/api/admin/teachers/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Data guru/staf berhasil dihapus!');
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
