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

  <!-- HEADER MATCHING SCHOOL-HISTORY PATTERN -->
  <div class="db-panel-head">
    <div>
      <h2><i class="fas fa-briefcase" style="color:var(--gold);margin-right:.5rem"></i> Bursa Kerja Khusus (BKK) &amp; Loker</h2>
      <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Publikasikan dan kelola informasi lowongan pekerjaan &amp; rekrutmen alumni SMKN 2 Mojokerto.</p>
    </div>
    <div class="db-panel-actions">
      <a href="{{ route('admin.job-vacancies.create') }}" class="db-btn db-btn-gold">
        <i class="fas fa-plus"></i> Tambah Lowongan Baru
      </a>
    </div>
  </div>

  <!-- STAT CARDS -->
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
        <span class="status-pill badge-upcoming"><i class="fas fa-clock"></i> UPCOMING</span>
      </div>
      <div class="bkk-stat-number">{{ $upcomingCount }}</div>
      <div class="bkk-stat-label">Rekrutmen Akan Datang</div>
    </div>

    <div class="bkk-stat-card">
      <div class="bkk-stat-head">
        <div class="bkk-stat-icon" style="background:rgba(255,120,117,.14);color:#ff7875">
          <i class="fas fa-circle-check"></i>
        </div>
        <span class="status-pill badge-selesai"><i class="fas fa-flag-checkered"></i> SELESAI</span>
      </div>
      <div class="bkk-stat-number">{{ $selesaiCount }}</div>
      <div class="bkk-stat-label">Pendaftaran Telah Berakhir</div>
    </div>

    <div class="bkk-stat-card">
      <div class="bkk-stat-head">
        <div class="bkk-stat-icon" style="background:rgba(142,163,186,.14);color:#c4d4e4">
          <i class="fas fa-archive"></i>
        </div>
        <span class="status-pill badge-arsip"><i class="fas fa-box-archive"></i> ARSIP</span>
      </div>
      <div class="bkk-stat-number">{{ $arsipCount }}</div>
      <div class="bkk-stat-label">Dokumentasi Rekrutmen BKK</div>
    </div>
  </div>

  <!-- MAIN PANEL TABLE -->
  <div class="db-panel">
    <!-- FILTER BAR & SEARCH -->
    <div class="bkk-filter-bar">
      <div class="bkk-filter-tabs">
        <button class="bkk-filter-btn active" onclick="filterStatus('ALL', this)">Semua ({{ $totalJobs }})</button>
        <button class="bkk-filter-btn" onclick="filterStatus('OPEN', this)"><i class="fas fa-door-open" style="color:#2ecc71"></i> OPEN ({{ $openCount }})</button>
        <button class="bkk-filter-btn" onclick="filterStatus('UPCOMING', this)"><i class="fas fa-clock" style="color:#f39c12"></i> UPCOMING ({{ $upcomingCount }})</button>
        <button class="bkk-filter-btn" onclick="filterStatus('SELESAI', this)"><i class="fas fa-circle-xmark" style="color:#e74c3c"></i> SELESAI ({{ $selesaiCount }})</button>
        <button class="bkk-filter-btn" onclick="filterStatus('ARSIP', this)"><i class="fas fa-box-archive" style="color:#95a5a6"></i> ARSIP ({{ $arsipCount }})</button>
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
                <span class="status-pill {{ $badgeClass }}">
                  @if($st === 'OPEN') <span class="pulse-dot"></span> @endif
                  {{ $stLabel }}
                </span>
              </td>
              <td style="text-align:right">
                <a href="{{ route('admin.job-vacancies.edit', $item->id) }}" class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem">
                  <i class="fas fa-pen-to-square"></i> Edit
                </a>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteJob('{{ $item->id }}')">
                  <i class="fas fa-trash"></i> Hapus
                </button>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:2.5rem">Belum ada lowongan pekerjaan BKK.</td></tr>
          @endforelse
        </tbody>
      </table>
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
