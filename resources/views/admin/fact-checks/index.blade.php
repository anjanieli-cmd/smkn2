@extends('layouts.admin')

@section('title', 'Manajemen School FactCheck — SMK Negeri 2 Mojokerto')

@push('styles')
<style>
  .fc-stat-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.2rem;
    margin-bottom: 1.8rem;
  }
  .fc-stat-card {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.09);
    border-radius: 18px;
    padding: 1.3rem;
    position: relative;
    overflow: hidden;
    transition: all 0.3s var(--ease, ease);
  }
  .fc-stat-card:hover {
    transform: translateY(-3px);
    border-color: rgba(255, 179, 0, 0.3);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.3);
  }
  .fc-stat-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.9rem;
  }
  .fc-stat-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
  }
  .fc-stat-number {
    font-family: var(--font-display);
    font-size: 2rem;
    color: #fff;
    margin-bottom: 0.2rem;
    line-height: 1;
  }
  .fc-stat-label {
    font-size: 0.78rem;
    color: var(--text-muted);
    font-weight: 600;
  }

  /* Status Badges */
  .tag-verified {
    background: rgba(76, 201, 141, 0.16);
    color: #5ce0a3;
    border: 1px solid rgba(76, 201, 141, 0.3);
  }
  .tag-false {
    background: rgba(255, 120, 117, 0.16);
    color: #ff7875;
    border: 1px solid rgba(255, 120, 117, 0.3);
  }
  .tag-unconfirmed {
    background: rgba(255, 179, 0, 0.16);
    color: #ffd54a;
    border: 1px solid rgba(255, 179, 0, 0.3);
  }

  .fc-status-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.32rem 0.75rem;
    border-radius: 999px;
    font-size: 0.68rem;
    font-weight: 800;
    letter-spacing: 0.05em;
    text-transform: uppercase;
  }

  /* Filter Bar & Tabs */
  .fc-filter-bar {
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
  .fc-filter-tabs {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
  }
  .fc-filter-btn {
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
  .fc-filter-btn:hover, .fc-filter-btn.active {
    background: var(--gold);
    color: var(--navy-bg);
    border-color: var(--gold);
  }

  .fc-search-box {
    position: relative;
    min-width: 250px;
  }
  .fc-search-box input {
    width: 100%;
    padding: 0.45rem 0.8rem 0.45rem 2.2rem;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    color: #fff;
    font-size: 0.78rem;
    outline: none;
  }
  .fc-search-box i {
    position: absolute;
    left: 0.8rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 0.75rem;
  }

  @media (max-width: 900px) {
    .fc-stat-grid {
      grid-template-columns: 1fr;
    }
    .fc-filter-bar {
      flex-direction: column;
      align-items: stretch;
    }
  }
</style>
@endpush

@section('content')
  @php
    $totalFacts = $items->count();
    $verifiedCount = $items->filter(fn($i) => ($i->status->value ?? $i->status) === 'VERIFIED')->count();
    $falseCount = $items->filter(fn($i) => ($i->status->value ?? $i->status) === 'FALSE')->count();
    $unconfirmedCount = $items->filter(fn($i) => ($i->status->value ?? $i->status) === 'UNCONFIRMED')->count();
  @endphp

  <!-- HEADER MATCHING SCHOOL-HISTORY PATTERN -->
  <div class="db-panel-head">
    <div>
      <h2><i class="fas fa-shield-halved" style="color:var(--gold);margin-right:.5rem"></i> School FactCheck — Klarifikasi Hoaks &amp; Informasi</h2>
      <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Publikasikan klarifikasi resmi sekolah terhadap kabar burung atau isu hoaks seputar SMKN 2 Mojokerto.</p>
    </div>
    <div class="db-panel-actions">
      <a href="{{ route('admin.fact-checks.create') }}" class="db-btn db-btn-gold">
        <i class="fas fa-plus"></i> Tambah FactCheck Baru
      </a>
    </div>
  </div>

  <!-- STAT CARDS SCHOOL FACTCHECK -->
  <div class="fc-stat-grid">
    <div class="fc-stat-card">
      <div class="fc-stat-head">
        <div class="fc-stat-icon" style="background:rgba(255,120,117,.14);color:#ff7875">
          <i class="fas fa-circle-xmark"></i>
        </div>
        <span class="fc-status-pill tag-false"><i class="fas fa-circle-xmark"></i> FALSE (HOAKS)</span>
      </div>
      <div class="fc-stat-number">{{ $falseCount }}</div>
      <div class="fc-stat-label">Informasi Tidak Benar / Hoaks Ditangkis</div>
    </div>

    <div class="fc-stat-card">
      <div class="fc-stat-head">
        <div class="fc-stat-icon" style="background:rgba(76,201,141,.14);color:#5ce0a3">
          <i class="fas fa-shield-halved"></i>
        </div>
        <span class="fc-status-pill tag-verified"><i class="fas fa-shield-halved"></i> VERIFIED (FAKTA)</span>
      </div>
      <div class="fc-stat-number">{{ $verifiedCount }}</div>
      <div class="fc-stat-label">Informasi Benar &amp; Terverifikasi Resmi</div>
    </div>

    <div class="fc-stat-card">
      <div class="fc-stat-head">
        <div class="fc-stat-icon" style="background:rgba(255,179,0,.14);color:#ffd54a">
          <i class="fas fa-triangle-exclamation"></i>
        </div>
        <span class="fc-status-pill tag-unconfirmed"><i class="fas fa-triangle-exclamation"></i> UNCONFIRMED</span>
      </div>
      <div class="fc-stat-number">{{ $unconfirmedCount }}</div>
      <div class="fc-stat-label">Klaim / Isu Dalam Penyelidikan Pihak Sekolah</div>
    </div>
  </div>

  <!-- MAIN PANEL TABLE -->
  <div class="db-panel">
    <!-- FILTER BAR & SEARCH -->
    <div class="fc-filter-bar">
      <div class="fc-filter-tabs">
        <button class="fc-filter-btn active" onclick="filterStatus('ALL', this)">Semua ({{ $totalFacts }})</button>
        <button class="fc-filter-btn" onclick="filterStatus('FALSE', this)"><i class="fas fa-circle-xmark" style="color:#e74c3c"></i> FALSE / Hoaks ({{ $falseCount }})</button>
        <button class="fc-filter-btn" onclick="filterStatus('VERIFIED', this)"><i class="fas fa-shield-halved" style="color:#2ecc71"></i> VERIFIED / Fakta ({{ $verifiedCount }})</button>
        <button class="fc-filter-btn" onclick="filterStatus('UNCONFIRMED', this)"><i class="fas fa-triangle-exclamation" style="color:#f39c12"></i> UNCONFIRMED ({{ $unconfirmedCount }})</button>
      </div>
      <div class="fc-search-box">
        <i class="fas fa-magnifying-glass"></i>
        <input type="text" id="factSearch" placeholder="Cari judul, klaim, atau klarifikasi..." onkeyup="searchFactChecks()">
      </div>
    </div>

    <!-- TABLE -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Judul Klarifikasi</th>
            <th>Klaim / Isu Beredar</th>
            <th>Penjelasan Verifikasi Resmi Sekolah</th>
            <th>Status Verifikasi</th>
            <th style="text-align:right">Aksi Management</th>
          </tr>
        </thead>
        <tbody id="factTableBody">
          @forelse($items as $item)
            @php
              $st = is_object($item->status) ? $item->status->value : $item->status;
              $badgeClass = match($st) {
                'VERIFIED' => 'tag-verified',
                'FALSE' => 'tag-false',
                'UNCONFIRMED' => 'tag-unconfirmed',
                default => 'tag-false'
              };
              $stIcon = match($st) {
                'VERIFIED' => 'fa-shield-halved',
                'FALSE' => 'fa-circle-xmark',
                'UNCONFIRMED' => 'fa-triangle-exclamation',
                default => 'fa-circle-xmark'
              };
              $stLabel = match($st) {
                'VERIFIED' => 'VERIFIED (Terverifikasi Benar)',
                'FALSE' => 'FALSE (Tidak Benar / Hoaks)',
                'UNCONFIRMED' => 'UNCONFIRMED (Belum Terkonfirmasi)',
                default => $st
              };
            @endphp
            <tr class="fact-row" data-status="{{ $st }}" data-search="{{ mb_strtolower($item->title . ' ' . $item->claim . ' ' . $item->verdict_explanation) }}">
              <td>
                <div style="display:flex;align-items:center;gap:.65rem">
                  <div style="width:36px;height:36px;border-radius:10px;background:rgba(255,179,0,.12);color:var(--gold);display:flex;align-items:center;justify-content:center;font-size:.9rem;flex-shrink:0">
                    <i class="fas fa-shield-cat"></i>
                  </div>
                  <div>
                    <strong style="color:var(--gold-light);font-size:.9rem;display:block">{{ $item->title }}</strong>
                  </div>
                </div>
              </td>
              <td>
                <span style="font-size:.78rem;color:rgba(255,255,255,.8);font-style:italic">"{{ Str::limit($item->claim, 75) }}"</span>
              </td>
              <td>
                <span style="font-size:.78rem;color:var(--text-muted)"><i class="fas fa-circle-info" style="color:var(--gold);margin-right:.25rem"></i> {{ Str::limit($item->verdict_explanation, 85) }}</span>
              </td>
              <td>
                <span class="fc-status-pill {{ $badgeClass }}">
                  <i class="fas {{ $stIcon }}"></i> {{ $stLabel }}
                </span>
              </td>
              <td style="text-align:right">
                <a href="{{ route('admin.fact-checks.edit', $item->id) }}" class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem">
                  <i class="fas fa-pen-to-square"></i> Edit
                </a>
                <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteFactCheck('{{ $item->id }}')">
                  <i class="fas fa-trash"></i> Hapus
                </button>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:2.5rem">Belum ada data School FactCheck.</td></tr>
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
    document.querySelectorAll('.fc-filter-btn').forEach(b => b.classList.remove('active'));
    if (btn) btn.classList.add('active');
    applyFilters();
  }

  function searchFactChecks() {
    applyFilters();
  }

  function applyFilters() {
    const q = document.getElementById('factSearch').value.toLowerCase().trim();
    const rows = document.querySelectorAll('.fact-row');

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

  async function deleteFactCheck(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data School FactCheck ini?')) return;
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
