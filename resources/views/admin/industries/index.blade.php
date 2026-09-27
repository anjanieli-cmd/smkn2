@extends('layouts.admin')

@section('title', 'Manajemen DUDI & Kemitraan — SMK Negeri 2 Mojokerto')

@push('styles')
<style>
  .bkk-stat-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.2rem;
    margin-bottom: 1.8rem;
  }
  .bkk-stat-card {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.09);
    border-radius: 18px;
    padding: 1.3rem;
    position: relative;
    overflow: hidden;
    transition: all 0.3s var(--ease, ease);
  }
  .bkk-stat-card:hover {
    transform: translateY(-3px);
    border-color: rgba(255, 179, 0, 0.3);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.3);
  }
  .bkk-stat-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.9rem;
  }
  .bkk-stat-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
  }
  .bkk-stat-number {
    font-family: var(--font-display);
    font-size: 2rem;
    color: #fff;
    margin-bottom: 0.2rem;
    line-height: 1;
  }
  .bkk-stat-label {
    font-size: 0.78rem;
    color: var(--text-muted);
    font-weight: 600;
  }

  .bkk-filter-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1.4rem;
    padding: 1rem 1.2rem;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.07);
    border-radius: 14px;
  }
  .bkk-filter-tabs {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
  }
  .bkk-filter-btn {
    padding: 0.45rem 0.9rem;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--text-muted);
    font-size: 0.76rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  .bkk-filter-btn:hover, .bkk-filter-btn.active {
    background: var(--gold);
    color: var(--navy-bg);
    border-color: var(--gold);
  }

  .bkk-search-box {
    position: relative;
    min-width: 240px;
  }
  .bkk-search-box input {
    width: 100%;
    padding: 0.45rem 0.8rem 0.45rem 2.2rem;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    color: #fff;
    font-size: 0.78rem;
    outline: none;
  }
  .bkk-search-box i {
    position: absolute;
    left: 0.8rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 0.75rem;
  }

  @media (max-width: 768px) {
    .bkk-stat-grid {
      grid-template-columns: 1fr;
    }
  }
</style>
@endpush

@section('content')
  @php
    $totalMitra = $items->count();
    $activeMitra = $items->where('is_active', true)->count();
    $inactiveMitra = $items->where('is_active', false)->count();
  @endphp

  <!-- STAT CARDS MITRA INDUSTRI -->
  <div class="bkk-stat-grid">
    <div class="bkk-stat-card">
      <div class="bkk-stat-head">
        <div class="bkk-stat-icon" style="background:rgba(255,179,0,.14);color:#ffd54a">
          <i class="fas fa-handshake"></i>
        </div>
        <span class="db-tag active">MITRA UTAMA</span>
      </div>
      <div class="bkk-stat-number">{{ $totalMitra }}</div>
      <div class="bkk-stat-label">Total Perusahaan Mitra DUDI</div>
    </div>

    <div class="bkk-stat-card">
      <div class="bkk-stat-head">
        <div class="bkk-stat-icon" style="background:rgba(76,201,141,.14);color:#5ce0a3">
          <i class="fas fa-building-circle-check"></i>
        </div>
        <span class="db-tag active">AKTIF</span>
      </div>
      <div class="bkk-stat-number">{{ $activeMitra }}</div>
      <div class="bkk-stat-label">Kemitraan Kerja Sama Aktif</div>
    </div>

    <div class="bkk-stat-card">
      <div class="bkk-stat-head">
        <div class="bkk-stat-icon" style="background:rgba(255,120,117,.14);color:#ff7875">
          <i class="fas fa-building-circle-xmark"></i>
        </div>
        <span class="db-tag inactive">NON-AKTIF</span>
      </div>
      <div class="bkk-stat-number">{{ $inactiveMitra }}</div>
      <div class="bkk-stat-label">Kemitraan Tidak Aktif / Arsip</div>
    </div>
  </div>

  <!-- MAIN PANEL TABLE -->
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2 style="font-family:var(--font-display);font-size:1.15rem;color:#fff"><i class="fas fa-city" style="color:var(--gold);margin-right:.4rem"></i> DUDI &amp; Kemitraan Industri</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Kelola kerja sama perusahaan mitra, tempat PKL, kelas industri, &amp; penyaluran lulusan.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Mitra Industri</button>
      </div>
    </div>

    <!-- FILTER BAR & SEARCH -->
    <div class="bkk-filter-bar">
      <div class="bkk-filter-tabs">
        <button class="bkk-filter-btn active" onclick="filterStatus('ALL', this)">Semua Mitra ({{ $totalMitra }})</button>
        <button class="bkk-filter-btn" onclick="filterStatus('1', this)">🟢 Aktif ({{ $activeMitra }})</button>
        <button class="bkk-filter-btn" onclick="filterStatus('0', this)">🔴 Non-Aktif ({{ $inactiveMitra }})</button>
      </div>
      <div class="bkk-search-box">
        <i class="fas fa-magnifying-glass"></i>
        <input type="text" id="searchInput" placeholder="Cari perusahaan atau bidang..." onkeyup="searchIndustries()">
      </div>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Perusahaan / Mitra</th>
            <th>Bidang Usaha / Industri</th>
            <th>Cakupan Kerja Sama (Scope)</th>
            <th>Status Kemitraan</th>
            <th style="text-align:right">Aksi Management</th>
          </tr>
        </thead>
        <tbody id="industryTableBody">
          @forelse($items as $item)
            <tr class="industry-row" data-active="{{ $item->is_active ? '1' : '0' }}" data-search="{{ mb_strtolower($item->company_name . ' ' . ($item->field_of_work ?? '') . ' ' . ($item->partnership_scope ?? '')) }}">
              <td>
                <div style="display:flex;align-items:center;gap:.65rem">
                  <div style="width:36px;height:36px;border-radius:10px;background:rgba(255,179,0,.12);color:var(--gold);display:flex;align-items:center;justify-content:center;font-size:.9rem;flex-shrink:0">
                    <i class="fas fa-building"></i>
                  </div>
                  <div>
                    <strong style="color:var(--gold-light);font-size:.9rem;display:block">{{ $item->company_name }}</strong>
                  </div>
                </div>
              </td>
              <td><span style="font-size:.82rem;color:rgba(255,255,255,.9);font-weight:600"><i class="fas fa-layer-group" style="color:var(--gold);margin-right:.25rem"></i> {{ $item->field_of_work ?? 'Industri Umum' }}</span></td>
              <td><span style="font-size:.78rem;color:var(--text-muted)"><i class="fas fa-handshake" style="color:#5ce0a3;margin-right:.25rem"></i> {{ $item->partnership_scope ?? 'PKL & Rekrutmen' }}</span></td>
              <td><span class="db-tag {{ $item->is_active ? 'active' : 'inactive' }}">{{ $item->is_active ? '🟢 Aktif' : '🔴 Non-Aktif' }}</span></td>
              <td style="text-align:right">
                <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteIndustry('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:2.5rem">Belum ada data DUDI &amp; Kemitraan Industri.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL CREATE / EDIT (PREMIUM REFINED UI) -->
  <div class="db-modal-overlay" id="industryModal">
    <div class="db-modal" style="max-width:660px">
      <div style="display:flex;align-items:center;gap:.85rem;padding:1.25rem 1.5rem;background:linear-gradient(135deg,rgba(255,179,0,.18),rgba(12,40,70,.9));border-bottom:1px solid rgba(255,255,255,.1)">
        <div style="width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0c2846;display:flex;align-items:center;justify-content:center;font-size:1.15rem;box-shadow:0 6px 16px rgba(255,179,0,.3)">
          <i class="fas fa-handshake"></i>
        </div>
        <div style="flex:1">
          <h3 id="modalTitle" style="font-family:var(--font-display);font-size:1.15rem;color:#fff;margin:0">Tambah Perusahaan Mitra Baru</h3>
          <p style="font-size:.76rem;color:var(--text-muted);margin:.15rem 0 0">Kelola data kerja sama mitra industri DUDI, tempat PKL, &amp; rekrutmen.</p>
        </div>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <form id="industryForm" onsubmit="saveIndustry(event)">
          <input type="hidden" id="industryId">

          <div class="db-form-group">
            <label><i class="fas fa-building" style="color:var(--gold)"></i> Nama Perusahaan / Mitra *</label>
            <input type="text" id="companyName" class="db-form-control" placeholder="Contoh: PT Telkom Indonesia (Persero) Tbk" required>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.1rem;margin-top:.4rem">
            <div class="db-form-group">
              <label><i class="fas fa-layer-group" style="color:var(--gold)"></i> Bidang Usaha / Industri *</label>
              <input type="text" id="fieldOfWork" class="db-form-control" placeholder="Contoh: IT &amp; Telekomunikasi" required>
            </div>

            <div class="db-form-group">
              <label><i class="fas fa-toggle-on" style="color:var(--gold)"></i> Status Kemitraan</label>
              <select id="industryStatus" class="db-form-control">
                <option value="1">🟢 Aktif (Kerja sama aktif)</option>
                <option value="0">🔴 Non-Aktif (Kerja sama selesai/arsip)</option>
              </select>
            </div>
          </div>

          <div class="db-form-group" style="margin-top:.4rem">
            <label><i class="fas fa-handshake" style="color:var(--gold)"></i> Cakupan Kerja Sama (Scope) *</label>
            <input type="text" id="partnershipScope" class="db-form-control" placeholder="Contoh: PKL, Kelas Industri, Rekrutmen Lulusan" required>
          </div>

          <div style="display:flex;justify-content:flex-end;gap:.75rem;margin-top:1.5rem;padding-top:1rem;border-top:1px solid rgba(255,255,255,.08)">
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
  let currentFilter = 'ALL';

  function filterStatus(status, btn) {
    currentFilter = status;
    document.querySelectorAll('.bkk-filter-btn').forEach(b => b.classList.remove('active'));
    if (btn) btn.classList.add('active');
    applyFilters();
  }

  function searchIndustries() {
    applyFilters();
  }

  function applyFilters() {
    const q = document.getElementById('searchInput').value.toLowerCase().trim();
    const rows = document.querySelectorAll('.industry-row');

    rows.forEach(row => {
      const rowActive = row.getAttribute('data-active');
      const rowSearch = row.getAttribute('data-search');

      const matchStatus = (currentFilter === 'ALL' || rowActive === currentFilter);
      const matchSearch = (!q || rowSearch.includes(q));

      if (matchStatus && matchSearch) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

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
