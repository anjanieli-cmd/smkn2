@extends('layouts.admin')

@section('title', 'Manajemen DUDI & Kemitraan — SMK Negeri 2 Mojokerto')

@section('content')
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2>DUDI &amp; Kemitraan Industri</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Kelola kerja sama perusahaan mitra, tempat PKL, &amp; penyaluran lulusan.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Mitra Industri</button>
      </div>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Perusahaan / Mitra</th>
            <th>Bidang Usaha</th>
            <th>Cakupan Kerja Sama</th>
            <th>Status</th>
            <th style="text-align:right">Aksi</th>
          </tr>
        </thead>
        <tbody id="industryTableBody">
          @forelse($items as $item)
            <tr>
              <td><strong style="color:var(--gold-light)">{{ $item->company_name }}</strong></td>
              <td><span style="font-size:.78rem;color:var(--text-muted)">{{ $item->field_of_work }}</span></td>
              <td><span style="font-size:.78rem;color:rgba(255,255,255,.8)">{{ $item->partnership_scope }}</span></td>
              <td><span class="db-tag {{ $item->is_active ? 'active' : 'inactive' }}">{{ $item->is_active ? 'Aktif' : 'Non-Aktif' }}</span></td>
              <td style="text-align:right">
                <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteIndustry('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:2rem">Belum ada data DUDI &amp; Kemitraan Industri.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL CREATE / EDIT -->
  <div class="db-modal-overlay" id="industryModal">
    <div class="db-modal">
      <div class="db-modal-head">
        <h3 id="modalTitle">Tambah Perusahaan Mitra Baru</h3>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <form id="industryForm" onsubmit="saveIndustry(event)">
          <input type="hidden" id="industryId">

          <div class="db-form-group">
            <label>Nama Perusahaan / Mitra *</label>
            <input type="text" id="companyName" class="db-form-control" placeholder="Contoh: PT Telkom Indonesia (Persero) Tbk" required>
          </div>

          <div class="db-form-group">
            <label>Bidang Usaha / Industri *</label>
            <input type="text" id="fieldOfWork" class="db-form-control" placeholder="Contoh: Telekomunikasi & IT" required>
          </div>

          <div class="db-form-group">
            <label>Cakupan Kerjasama / Scope *</label>
            <input type="text" id="partnershipScope" class="db-form-control" placeholder="PKL, Kelas Industri, Rekrutmen Lulusan" required>
          </div>

          <div class="db-form-group">
            <label>Status Kemitraan</label>
            <select id="industryStatus" class="db-form-control">
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
  function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Perusahaan Mitra Baru';
    document.getElementById('industryId').value = '';
    document.getElementById('companyName').value = '';
    document.getElementById('fieldOfWork').value = '';
    document.getElementById('partnershipScope').value = '';
    document.getElementById('industryStatus').value = '1';
    document.getElementById('industryModal').classList.add('active');
  }

  function openEditModal(item) {
    document.getElementById('modalTitle').textContent = 'Edit Data Perusahaan Mitra';
    document.getElementById('industryId').value = item.id;
    document.getElementById('companyName').value = item.company_name;
    document.getElementById('fieldOfWork').value = item.field_of_work || '';
    document.getElementById('partnershipScope').value = item.partnership_scope || '';
    document.getElementById('industryStatus').value = item.is_active ? '1' : '0';
    document.getElementById('industryModal').classList.add('active');
  }

  function closeModal() {
    document.getElementById('industryModal').classList.remove('active');
  }

  async function saveIndustry(e) {
    e.preventDefault();
    const id = document.getElementById('industryId').value;
    const payload = {
      company_name: document.getElementById('companyName').value,
      field_of_work: document.getElementById('fieldOfWork').value,
      partnership_scope: document.getElementById('partnershipScope').value,
      is_active: document.getElementById('industryStatus').value === '1'
    };

    const url = id ? `/api/admin/industries/${id}` : '/api/admin/industries';
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
        showToast(id ? 'Data Mitra berhasil diperbarui!' : 'Mitra Baru berhasil ditambahkan!');
        closeModal();
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(data.message || 'Gagal menyimpan data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }

  async function deleteIndustry(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data mitra industri ini?')) return;
    try {
      const res = await fetch(`/api/admin/industries/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Mitra berhasil dihapus!');
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
