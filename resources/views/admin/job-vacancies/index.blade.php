@extends('layouts.admin')

@section('title', 'Manajemen BKK & Lowongan Kerja — SMK Negeri 2 Mojokerto')

@push('styles')
<style>
  .bkk-stat-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
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

  /* Status Badges */
  .badge-open {
    background: rgba(76, 201, 141, 0.16);
    color: #5ce0a3;
    border: 1px solid rgba(76, 201, 141, 0.3);
  }
  .badge-upcoming {
    background: rgba(255, 179, 0, 0.16);
    color: #ffd54a;
    border: 1px solid rgba(255, 179, 0, 0.3);
  }
  .badge-selesai {
    background: rgba(255, 120, 117, 0.16);
    color: #ff7875;
    border: 1px solid rgba(255, 120, 117, 0.3);
  }
  .badge-arsip {
    background: rgba(142, 163, 186, 0.16);
    color: #c4d4e4;
    border: 1px solid rgba(142, 163, 186, 0.3);
  }

  .status-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.3rem 0.7rem;
    border-radius: 999px;
    font-size: 0.68rem;
    font-weight: 800;
    letter-spacing: 0.05em;
    text-transform: uppercase;
  }
  .status-pill .pulse-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
    box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
  }

  /* Filter Tabs Bar */
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

  @media (max-width: 900px) {
    .bkk-stat-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  @media (max-width: 560px) {
    .bkk-stat-grid {
      grid-template-columns: 1fr;
    }
    .bkk-filter-bar {
      flex-direction: column;
      align-items: stretch;
    }
  }
</style>
@endpush

@section('content')
  @php
    $totalJobs = $items->count();
    $openCount = $items->filter(fn($i) => ($i->status->value ?? $i->status) === 'OPEN')->count();
    $upcomingCount = $items->filter(fn($i) => ($i->status->value ?? $i->status) === 'UPCOMING')->count();
    $selesaiCount = $items->filter(fn($i) => ($i->status->value ?? $i->status) === 'SELESAI')->count();
    $arsipCount = $items->filter(fn($i) => ($i->status->value ?? $i->status) === 'ARSIP')->count();
  @endphp

  <!-- STAT CARDS (SESUAI HALAMAN USER PUBLIC BKK) -->
  <div class="bkk-stat-grid">
    <div class="bkk-stat-card">
      <div class="bkk-stat-head">
        <div class="bkk-stat-icon" style="background:rgba(76,201,141,.14);color:#5ce0a3">
          <i class="fas fa-door-open"></i>
        </div>
        <span class="status-pill badge-open"><span class="pulse-dot"></span> OPEN</span>
      </div>
      <div class="bkk-stat-number">{{ $openCount }}</div>
      <div class="bkk-stat-label">Pendaftaran Masih Berlangsung</div>
    </div>

    <div class="bkk-stat-card">
      <div class="bkk-stat-head">
        <div class="bkk-stat-icon" style="background:rgba(255,179,0,.14);color:#ffd54a">
          <i class="fas fa-business-time"></i>
        </div>
        <span class="status-pill badge-upcoming">UPCOMING</span>
      </div>
      <div class="bkk-stat-number">{{ $upcomingCount }}</div>
      <div class="bkk-stat-label">Rekrutmen Akan Datang</div>
    </div>

    <div class="bkk-stat-card">
      <div class="bkk-stat-head">
        <div class="bkk-stat-icon" style="background:rgba(255,120,117,.14);color:#ff7875">
          <i class="fas fa-circle-check"></i>
        </div>
        <span class="status-pill badge-selesai">SELESAI</span>
      </div>
      <div class="bkk-stat-number">{{ $selesaiCount }}</div>
      <div class="bkk-stat-label">Pendaftaran Telah Berakhir</div>
    </div>

    <div class="bkk-stat-card">
      <div class="bkk-stat-head">
        <div class="bkk-stat-icon" style="background:rgba(142,163,186,.14);color:#c4d4e4">
          <i class="fas fa-archive"></i>
        </div>
        <span class="status-pill badge-arsip">ARSIP</span>
      </div>
      <div class="bkk-stat-number">{{ $arsipCount }}</div>
      <div class="bkk-stat-label">Dokumentasi Rekrutmen BKK</div>
    </div>
  </div>

  <!-- MAIN PANEL TABLE -->
  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2 style="font-family:var(--font-display);font-size:1.15rem;color:#fff"><i class="fas fa-briefcase" style="color:var(--gold);margin-right:.4rem"></i> Bursa Kerja Khusus (BKK) &amp; Loker</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Publikasikan dan kelola informasi lowongan pekerjaan &amp; rekrutmen alumni SMKN 2 Mojokerto.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Lowongan Baru</button>
      </div>
    </div>

    <!-- FILTER BAR & SEARCH -->
    <div class="bkk-filter-bar">
      <div class="bkk-filter-tabs">
        <button class="bkk-filter-btn active" onclick="filterStatus('ALL', this)">Semua ({{ $totalJobs }})</button>
        <button class="bkk-filter-btn" onclick="filterStatus('OPEN', this)">🟢 OPEN ({{ $openCount }})</button>
        <button class="bkk-filter-btn" onclick="filterStatus('UPCOMING', this)">🟡 UPCOMING ({{ $upcomingCount }})</button>
        <button class="bkk-filter-btn" onclick="filterStatus('SELESAI', this)">🔴 SELESAI ({{ $selesaiCount }})</button>
        <button class="bkk-filter-btn" onclick="filterStatus('ARSIP', this)">📦 ARSIP ({{ $arsipCount }})</button>
      </div>
      <div class="bkk-search-box">
        <i class="fas fa-magnifying-glass"></i>
        <input type="text" id="searchInput" placeholder="Cari posisi atau perusahaan..." onkeyup="searchJobs()">
      </div>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Posisi / Judul Loker</th>
            <th>Perusahaan Mitra</th>
            <th>Lokasi</th>
            <th>Tipe Pekerjaan</th>
            <th>Status Pendaftaran</th>
            <th style="text-align:right">Aksi Management</th>
          </tr>
        </thead>
        <tbody id="jobTableBody">
          @forelse($items as $item)
            @php
              $st = $item->status->value ?? $item->status;
              $badgeClass = match($st) {
                'OPEN' => 'badge-open',
                'UPCOMING' => 'badge-upcoming',
                'SELESAI' => 'badge-selesai',
                'ARSIP' => 'badge-arsip',
                default => 'badge-open'
              };
              $stLabel = match($st) {
                'OPEN' => 'OPEN (Berlangsung)',
                'UPCOMING' => 'UPCOMING (Akan Datang)',
                'SELESAI' => 'SELESAI (Berakhir)',
                'ARSIP' => 'ARSIP (Dokumentasi)',
                default => $st
              };
            @endphp
            <tr class="job-row" data-status="{{ $st }}" data-search="{{ mb_strtolower($item->title . ' ' . $item->company_name . ' ' . ($item->location ?? '')) }}">
              <td>
                <div style="display:flex;align-items:center;gap:.65rem">
                  <div style="width:36px;height:36px;border-radius:10px;background:rgba(255,179,0,.12);color:var(--gold);display:flex;align-items:center;justify-content:center;font-size:.9rem;flex-shrink:0">
                    <i class="fas fa-briefcase"></i>
                  </div>
                  <div>
                    <strong style="color:var(--gold-light);font-size:.9rem;display:block">{{ $item->title }}</strong>
                    @if($item->deadline)
                      <span style="font-size:.7rem;color:var(--text-muted)"><i class="far fa-calendar-alt"></i> Batas: {{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}</span>
                    @endif
                  </div>
                </div>
              </td>
              <td>
                <div style="font-size:.85rem;font-weight:700;color:#fff">{{ $item->company_name }}</div>
              </td>
              <td>
                <span style="font-size:.78rem;color:var(--text-muted)"><i class="fas fa-location-dot" style="color:#ffb300;margin-right:.25rem"></i> {{ $item->location ?? 'Mojokerto' }}</span>
              </td>
              <td>
                <span style="font-size:.75rem;padding:.2rem .5rem;border-radius:6px;background:rgba(255,255,255,.06);color:rgba(255,255,255,.8)">{{ $item->employment_type ?? 'Full-Time' }}</span>
              </td>
              <td>
                <span class="status-pill {{ $badgeClass }}">
                  @if($st === 'OPEN') <span class="pulse-dot"></span> @endif
                  {{ $stLabel }}
                </span>
              </td>
              <td style="text-align:right">
                <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteJob('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:2.5rem">Belum ada lowongan pekerjaan BKK.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL CREATE / EDIT (PREMIUM REFINED UI) -->
  <div class="db-modal-overlay" id="jobModal">
    <div class="db-modal" style="max-width:680px">
      <div style="display:flex;align-items:center;gap:.85rem;padding:1.25rem 1.5rem;background:linear-gradient(135deg,rgba(255,179,0,.18),rgba(12,40,70,.9));border-bottom:1px solid rgba(255,255,255,.1)">
        <div style="width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0c2846;display:flex;align-items:center;justify-content:center;font-size:1.15rem;box-shadow:0 6px 16px rgba(255,179,0,.3)">
          <i class="fas fa-briefcase"></i>
        </div>
        <div style="flex:1">
          <h3 id="modalTitle" style="font-family:var(--font-display);font-size:1.15rem;color:#fff;margin:0">Tambah Lowongan Kerja Baru</h3>
          <p style="font-size:.76rem;color:var(--text-muted);margin:.15rem 0 0">Publikasikan informasi rekrutmen kerja BKK untuk alumni &amp; siswa.</p>
        </div>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <form id="jobForm" onsubmit="saveJob(event)">
          <input type="hidden" id="jobId">

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.1rem">
            <div class="db-form-group">
              <label><i class="fas fa-user-tie" style="color:var(--gold)"></i> Judul Lowongan / Posisi *</label>
              <input type="text" id="jobTitle" class="db-form-control" placeholder="Contoh: Junior Web Developer / Staff Admin" required>
            </div>

            <div class="db-form-group">
              <label><i class="fas fa-building" style="color:var(--gold)"></i> Perusahaan / Mitra BKK *</label>
              <input type="text" id="jobCompany" class="db-form-control" placeholder="Contoh: PT Telkom Indonesia" required>
            </div>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.1rem;margin-top:.4rem">
            <div class="db-form-group">
              <label><i class="fas fa-location-dot" style="color:var(--gold)"></i> Lokasi Penempatan</label>
              <input type="text" id="jobLocation" class="db-form-control" placeholder="Contoh: Mojokerto / Surabaya">
            </div>

            <div class="db-form-group">
              <label><i class="fas fa-clock" style="color:var(--gold)"></i> Tipe Pekerjaan</label>
              <select id="jobType" class="db-form-control">
                <option value="Full-Time">Full-Time (Penuh Waktu)</option>
                <option value="Part-Time">Part-Time (Paruh Waktu)</option>
                <option value="Contract">Kontrak / Magang (PKL)</option>
                <option value="Walk-in Interview">Walk-in Interview</option>
              </select>
            </div>
          </div>

          <div class="db-form-group" style="margin-top:.4rem">
            <label><i class="fas fa-toggle-on" style="color:var(--gold)"></i> Status Rekrutmen BKK *</label>
            <select id="jobStatus" class="db-form-control">
              <option value="OPEN">🟢 OPEN (Pendaftaran masih berlangsung)</option>
              <option value="UPCOMING">🟡 UPCOMING (Rekrutmen akan datang)</option>
              <option value="SELESAI">🔴 SELESAI (Pendaftaran telah berakhir)</option>
              <option value="ARSIP">📦 ARSIP (Dokumentasi rekrutmen/kegiatan)</option>
            </select>
          </div>

          <div class="db-form-group" style="margin-top:.4rem">
            <label><i class="fas fa-file-lines" style="color:var(--gold)"></i> Deskripsi Kualifikasi &amp; Cara Melamar *</label>
            <textarea id="jobDescription" class="db-form-control" rows="4" placeholder="Persyaratan kualifikasi, berkas lamaran, &amp; cara mendaftar..." required></textarea>
          </div>

          <div style="display:flex;justify-content:flex-end;gap:.75rem;margin-top:1.5rem;padding-top:1rem;border-top:1px solid rgba(255,255,255,.08)">
            <button type="button" class="db-btn db-btn-ghost" onclick="closeModal()">Batal</button>
            <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Lowongan</button>
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

  function searchJobs() {
    applyFilters();
  }

  function applyFilters() {
    const q = document.getElementById('searchInput').value.toLowerCase().trim();
    const rows = document.querySelectorAll('.job-row');

    rows.forEach(row => {
      const rowStatus = row.getAttribute('data-status');
      const rowSearch = row.getAttribute('data-search');

      const matchStatus = (currentFilter === 'ALL' || rowStatus === currentFilter);
      const matchSearch = (!q || rowSearch.includes(q));

      if (matchStatus && matchSearch) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Lowongan Kerja Baru';
    document.getElementById('jobId').value = '';
    document.getElementById('jobTitle').value = '';
    document.getElementById('jobCompany').value = '';
    document.getElementById('jobLocation').value = '';
    document.getElementById('jobType').value = 'Full-Time';
    document.getElementById('jobStatus').value = 'OPEN';
    document.getElementById('jobDescription').value = '';
    document.getElementById('jobModal').classList.add('active');
  }

  function openEditModal(item) {
    document.getElementById('modalTitle').textContent = 'Edit Lowongan Kerja';
    document.getElementById('jobId').value = item.id;
    document.getElementById('jobTitle').value = item.title;
    document.getElementById('jobCompany').value = item.company_name;
    document.getElementById('jobLocation').value = item.location || '';
    document.getElementById('jobType').value = item.employment_type || 'Full-Time';
    document.getElementById('jobStatus').value = item.status.value || item.status;
    document.getElementById('jobDescription').value = item.description || '';
    document.getElementById('jobModal').classList.add('active');
  }

  function closeModal() {
    document.getElementById('jobModal').classList.remove('active');
  }

  async function saveJob(e) {
    e.preventDefault();
    const id = document.getElementById('jobId').value;
    const payload = {
      title: document.getElementById('jobTitle').value,
      company_name: document.getElementById('jobCompany').value,
      location: document.getElementById('jobLocation').value,
      employment_type: document.getElementById('jobType').value,
      status: document.getElementById('jobStatus').value,
      description: document.getElementById('jobDescription').value
    };

    const url = id ? `/api/admin/job-vacancies/${id}` : '/api/admin/job-vacancies';
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
        showToast(id ? 'Loker berhasil diperbarui!' : 'Loker baru berhasil ditambahkan!');
        closeModal();
        setTimeout(() => location.reload(), 800);
      } else {
        showToast(data.message || 'Gagal menyimpan data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }

  async function deleteJob(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus lowongan pekerjaan ini?')) return;
    try {
      const res = await fetch(`/api/admin/job-vacancies/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Lowongan berhasil dihapus!');
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
