@extends('layouts.admin')

@section('title', 'Manajemen Ekstrakurikuler & Organisasi — SMK Negeri 2 Mojokerto')

@section('content')
<style>
  .adm-ek-wrap {
    --a-gold: #f9a825;
    --a-gold-light: #ffd54a;
    --a-muted: #8a9aad;
    --a-card: rgba(255, 255, 255, .04);
    --a-card-hover: rgba(255, 255, 255, .065);
    --a-border: rgba(255, 255, 255, .09);
    --a-border-hover: rgba(255, 213, 74, .28);
    --a-ease: cubic-bezier(.22, .61, .36, 1);
  }

  /* Header Banner */
  .adm-ek-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    flex-wrap: wrap;
    padding: 1.5rem 1.8rem;
    background: linear-gradient(120deg, rgba(249, 168, 37, .12), rgba(255, 255, 255, .02) 60%);
    border: 1px solid var(--a-border);
    border-radius: 20px;
    margin-bottom: 1.8rem;
  }

  .adm-ek-header h1 {
    font-family: var(--font-display);
    font-size: 1.35rem;
    color: #fff;
    margin: 0 0 .3rem;
  }

  .adm-ek-header p {
    font-size: .82rem;
    color: var(--a-muted);
    margin: 0;
  }

  /* Stat Cards */
  .adm-ek-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.2rem;
    margin-bottom: 1.8rem;
  }

  .adm-ek-stat-card {
    background: var(--a-card);
    border: 1px solid var(--a-border);
    border-radius: 16px;
    padding: 1.25rem 1.4rem;
    transition: transform .3s var(--a-ease), border-color .3s var(--a-ease);
  }

  .adm-ek-stat-card:hover {
    transform: translateY(-3px);
    border-color: var(--a-border-hover);
  }

  .adm-ek-stat-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: .8rem;
  }

  .adm-ek-stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.05rem;
    background: var(--stat-bg);
    color: var(--stat-fg);
  }

  .adm-ek-stat-val {
    font-family: var(--font-display);
    font-size: 1.85rem;
    color: #fff;
    line-height: 1;
    margin-bottom: .3rem;
  }

  .adm-ek-stat-lbl {
    font-size: .76rem;
    color: var(--a-muted);
    font-weight: 600;
  }

  /* Filter & Controls */
  .adm-ek-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 1.4rem;
    background: var(--a-card);
    border: 1px solid var(--a-border);
    border-radius: 16px;
    padding: 1rem 1.2rem;
  }

  .adm-ek-tabs {
    display: flex;
    align-items: center;
    gap: .5rem;
    flex-wrap: wrap;
  }

  .adm-ek-tab {
    padding: .5rem .95rem;
    border-radius: 999px;
    background: rgba(255, 255, 255, .05);
    border: 1px solid rgba(255, 255, 255, .09);
    color: var(--a-muted);
    font-size: .78rem;
    font-weight: 700;
    cursor: pointer;
    transition: all .25s var(--a-ease);
  }

  .adm-ek-tab:hover {
    color: #fff;
    background: rgba(255, 255, 255, .1);
  }

  .adm-ek-tab.active {
    background: linear-gradient(135deg, rgba(255, 179, 0, .2), rgba(255, 179, 0, .08));
    color: var(--a-gold-light);
    border-color: rgba(255, 179, 0, .35);
  }

  .adm-ek-search {
    position: relative;
    min-width: 260px;
  }

  .adm-ek-search i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--a-muted);
    font-size: .85rem;
  }

  .adm-ek-search input {
    width: 100%;
    padding: .55rem .9rem .55rem 2.4rem;
    border-radius: 10px;
    background: rgba(255, 255, 255, .06);
    border: 1px solid rgba(255, 255, 255, .12);
    color: #fff;
    font-size: .82rem;
    outline: none;
  }

  .adm-ek-search input:focus {
    border-color: var(--a-gold);
  }

  /* Grid Cards */
  .adm-ek-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.4rem;
  }

  .adm-ek-card {
    background: var(--a-card);
    border: 1px solid var(--a-border);
    border-radius: 18px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform .3s var(--a-ease), border-color .3s var(--a-ease), box-shadow .3s var(--a-ease);
  }

  .adm-ek-card:hover {
    transform: translateY(-4px);
    border-color: var(--a-border-hover);
    box-shadow: 0 16px 36px rgba(0, 0, 0, .25);
  }

  .adm-ek-card-media {
    position: relative;
    height: 180px;
    background: rgba(15, 47, 82, .6);
    overflow: hidden;
  }

  .adm-ek-card-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .5s var(--a-ease);
  }

  .adm-ek-card:hover .adm-ek-card-media img {
    transform: scale(1.05);
  }

  .adm-ek-badge {
    position: absolute;
    top: .9rem;
    left: .9rem;
    padding: .3rem .65rem;
    border-radius: 999px;
    font-size: .66rem;
    font-weight: 800;
    letter-spacing: .04em;
    text-transform: uppercase;
    background: rgba(8, 27, 48, .85);
    color: var(--a-gold-light);
    border: 1px solid rgba(255, 213, 74, .3);
    backdrop-filter: blur(8px);
  }

  .adm-ek-card-body {
    padding: 1.2rem;
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .adm-ek-card-title {
    font-family: var(--font-display);
    font-size: 1.05rem;
    color: #fff;
    margin: 0 0 .4rem;
  }

  .adm-ek-card-desc {
    font-size: .78rem;
    color: var(--a-muted);
    line-height: 1.55;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .adm-ek-meta-list {
    list-style: none;
    margin: auto 0 1rem;
    padding: .75rem 0 0;
    border-top: 1px dashed rgba(255, 255, 255, .08);
    display: flex;
    flex-direction: column;
    gap: .4rem;
  }

  .adm-ek-meta-item {
    display: flex;
    align-items: center;
    gap: .55rem;
    font-size: .75rem;
    color: rgba(255, 255, 255, .8);
  }

  .adm-ek-meta-item i {
    font-size: .72rem;
    color: var(--a-gold);
    width: 16px;
    text-align: center;
  }

  .adm-ek-card-foot {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .5rem;
    padding-top: .8rem;
    border-top: 1px solid var(--a-border);
  }

  /* PREMIUM MODAL STYLING */
  .db-modal-header-banner {
    display: flex;
    align-items: center;
    gap: .85rem;
    padding: 1.25rem 1.5rem;
    background: linear-gradient(135deg, rgba(255,179,0,.15), rgba(12,40,70,.9));
    border-bottom: 1px solid rgba(255,255,255,.1);
  }
  .db-modal-header-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: linear-gradient(135deg, #ffd54a, #ffb300);
    color: #0c2846;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.15rem;
    box-shadow: 0 6px 16px rgba(255,179,0,.3);
  }

  @media(max-width: 1100px) {
    .adm-ek-stats {
      grid-template-columns: repeat(2, 1fr)
    }

    .adm-ek-grid {
      grid-template-columns: repeat(2, 1fr)
    }
  }

  @media(max-width: 700px) {
    .adm-ek-stats {
      grid-template-columns: 1fr
    }

    .adm-ek-grid {
      grid-template-columns: 1fr
    }

    .adm-ek-toolbar {
      flex-direction: column;
      align-items: stretch
    }
  }

  /* PREMIUM CUSTOM FILE UPLOAD DROPZONE */
  .adm-file-dropzone {
    display: flex;
    align-items: center;
    gap: 1.1rem;
    margin-top: .4rem;
    background: linear-gradient(135deg, rgba(15, 47, 82, .45), rgba(8, 27, 48, .65));
    border: 2px dashed rgba(255, 213, 74, .28);
    border-radius: 16px;
    padding: 1rem 1.2rem;
    cursor: pointer;
    transition: all .3s var(--a-ease);
    position: relative;
    user-select: none;
  }
  .adm-file-dropzone:hover {
    border-color: #ffd54a;
    background: rgba(255, 213, 74, .06);
    box-shadow: 0 10px 28px rgba(255, 179, 0, .14);
  }
  .adm-file-thumb {
    width: 72px;
    height: 72px;
    border-radius: 14px;
    background: rgba(8, 27, 48, .85);
    border: 1px solid rgba(255, 213, 74, .3);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    flex-shrink: 0;
    box-shadow: 0 8px 20px rgba(0, 0, 0, .35);
    transition: transform .3s ease, border-color .3s ease;
  }
  .adm-file-dropzone:hover .adm-file-thumb {
    transform: scale(1.05);
    border-color: #ffd54a;
  }
  .adm-file-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .adm-file-thumb i {
    font-size: 1.4rem;
    color: var(--a-gold);
    opacity: .7;
    transition: opacity .3s ease;
  }
  .adm-file-dropzone:hover .adm-file-thumb i {
    opacity: 1;
  }
  .adm-file-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: .35rem;
  }
  .adm-file-actions {
    display: flex;
    align-items: center;
    gap: .65rem;
    flex-wrap: wrap;
  }
  .adm-file-btn {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    padding: .48rem .9rem;
    border-radius: 10px;
    background: linear-gradient(135deg, rgba(255, 213, 74, .25), rgba(255, 179, 0, .15));
    border: 1px solid rgba(255, 213, 74, .4);
    color: #fff;
    font-size: .78rem;
    font-weight: 700;
    pointer-events: none;
    transition: all .25s ease;
  }
  .adm-file-dropzone:hover .adm-file-btn {
    background: linear-gradient(135deg, #ffd54a, #ffb300);
    color: #0c2846;
    box-shadow: 0 6px 16px rgba(255, 179, 0, .3);
  }
  .adm-file-name {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    padding: .32rem .65rem;
    border-radius: 8px;
    background: rgba(46, 204, 113, .15);
    border: 1px solid rgba(46, 204, 113, .35);
    color: #2ecc71;
    font-size: .72rem;
    font-weight: 700;
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .adm-file-hint {
    font-size: .72rem;
    color: var(--a-muted);
    line-height: 1.4;
  }
</style>

<div class="adm-ek-wrap">
  @php
    $totalEkskul = $items->reject(fn($i) => $i->category === 'Organisasi')->count();
    $totalOrg = $items->filter(fn($i) => $i->category === 'Organisasi')->count();
    $categories = $items->pluck('category')->filter()->unique()->values();
  @endphp

  <!-- HEADER MATCHING SCHOOL-HISTORY PATTERN -->
  <div class="db-panel-head">
    <div>
      <h2><i class="fas fa-futbol" style="color:var(--a-gold);margin-right:.5rem"></i> Ekstrakurikuler &amp; Organisasi Siswa</h2>
      <p style="font-size:.8rem;color:var(--a-muted);margin-top:.25rem">Kelola data kegiatan non-akademik, pembina, jadwal latihan, dan foto galeri untuk publik.</p>
    </div>
    <div class="db-panel-actions">
      <a href="{{ route('admin.extracurriculars.create') }}" class="db-btn db-btn-gold">
        <i class="fas fa-plus"></i> Tambah Kegiatan Baru
      </a>
    </div>
  </div>

  <!-- STAT CARDS -->
  <div class="adm-ek-stats">
    <div class="adm-ek-stat-card" style="--stat-bg:rgba(76,201,141,.14);--stat-fg:#5ce0a3">
      <div class="adm-ek-stat-top">
        <div class="adm-ek-stat-icon"><i class="fas fa-futbol"></i></div>
        <span class="db-tag active"><i class="fas fa-circle-check"></i> Terdata</span>
      </div>
      <div class="adm-ek-stat-val">{{ $items->count() }}</div>
      <div class="adm-ek-stat-lbl">Total Wadah Kegiatan</div>
    </div>

    <div class="adm-ek-stat-card" style="--stat-bg:rgba(255,179,0,.14);--stat-fg:#ffb300">
      <div class="adm-ek-stat-top">
        <div class="adm-ek-stat-icon"><i class="fas fa-bullseye"></i></div>
        <span class="db-tag PENDING"><i class="fas fa-star"></i> Ekstrakurikuler</span>
      </div>
      <div class="adm-ek-stat-val">{{ $totalEkskul }}</div>
      <div class="adm-ek-stat-lbl">Kegiatan Ekskul</div>
    </div>

    <div class="adm-ek-stat-card" style="--stat-bg:rgba(79,195,247,.14);--stat-fg:#4fc3f7">
      <div class="adm-ek-stat-top">
        <div class="adm-ek-stat-icon"><i class="fas fa-sitemap"></i></div>
        <span class="db-tag REVIEWING"><i class="fas fa-users-rectangle"></i> Organisasi</span>
      </div>
      <div class="adm-ek-stat-val">{{ $totalOrg }}</div>
      <div class="adm-ek-stat-lbl">Organisasi Siswa</div>
    </div>

    <div class="adm-ek-stat-card" style="--stat-bg:rgba(198,120,255,.14);--stat-fg:#c678ff">
      <div class="adm-ek-stat-top">
        <div class="adm-ek-stat-icon"><i class="fas fa-layer-group"></i></div>
        <span class="db-tag active"><i class="fas fa-shapes"></i> Variasi</span>
      </div>
      <div class="adm-ek-stat-val">{{ $categories->count() }}</div>
      <div class="adm-ek-stat-lbl">Bidang &amp; Kategori</div>
    </div>
  </div>

  <!-- TOOLBAR SEARCH & FILTER TABS -->
  <div class="adm-ek-toolbar">
    <div class="adm-ek-tabs" id="ekAdminTabs">
      <button class="adm-ek-tab active" data-filter="all">Semua Wadah ({{ $items->count() }})</button>
      <button class="adm-ek-tab" data-filter="ekskul">Ekstrakurikuler ({{ $totalEkskul }})</button>
      <button class="adm-ek-tab" data-filter="organisasi">Organisasi ({{ $totalOrg }})</button>
    </div>

    <div class="adm-ek-search">
      <i class="fas fa-magnifying-glass"></i>
      <input type="text" id="ekAdminSearch" placeholder="Cari nama, pembina, atau jadwal..." onkeyup="filterEkAdmin()">
    </div>
  </div>

  <!-- CARD GRID LIST -->
  <div class="adm-ek-grid" id="ekAdminGrid">
    @forelse($items as $item)
      @php
        $isOrg = $item->category === 'Organisasi';
        $attrs = $item->attributes ?? [];
        $schedule = $attrs['schedule'] ?? '-';
        $activities = $attrs['activities'] ?? '-';
        $coach = $item->coach_name ?: 'Pembina Sekolah';
        $img = $item->image_url ? asset($item->image_url) : asset('images/logo_smkn2.png');
      @endphp
      <div class="adm-ek-card" data-category="{{ $isOrg ? 'organisasi' : 'ekskul' }}" data-name="{{ strtolower($item->name) }}" data-coach="{{ strtolower($coach) }}" data-schedule="{{ strtolower($schedule) }}">
        <div class="adm-ek-card-media">
          <span class="adm-ek-badge">{{ $item->category }}</span>
          <img src="{{ $img }}" alt="{{ $item->name }}" onerror="this.src='{{ asset('images/logo_smkn2.png') }}'">
        </div>
        <div class="adm-ek-card-body">
          <h3 class="adm-ek-card-title">{{ $item->name }}</h3>
          <p class="adm-ek-card-desc">{{ $item->description }}</p>

          <ul class="adm-ek-meta-list">
            <li class="adm-ek-meta-item">
              <i class="fas fa-user-shield"></i>
              <span><b>Pembina:</b> {{ $coach }}</span>
            </li>
            <li class="adm-ek-meta-item">
              <i class="fas fa-calendar-check"></i>
              <span><b>Jadwal:</b> {{ $schedule }}</span>
            </li>
            @if(!empty($activities) && $activities !== '-')
              <li class="adm-ek-meta-item">
                <i class="fas fa-list-check"></i>
                <span><b>Kegiatan:</b> {{ Str::limit($activities, 40) }}</span>
              </li>
            @endif
          </ul>

          <div class="adm-ek-card-foot">
            <span class="db-tag active"><i class="fas fa-circle-check"></i> Aktif</span>
            <div style="display:flex;gap:.4rem">
              <a href="{{ route('admin.extracurriculars.edit', $item->id) }}" class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.74rem">
                <i class="fas fa-pen-to-square"></i> Edit
              </a>
              <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.74rem" onclick="deleteExtra('{{ $item->id }}')">
                <i class="fas fa-trash"></i> Hapus
              </button>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div style="grid-column:1/-1;text-align:center;padding:3rem 1rem;color:var(--a-muted)">
        <i class="fas fa-icons" style="font-size:2rem;margin-bottom:1rem;opacity:.5;display:block"></i>
        Belum ada data ekstrakurikuler atau organisasi.
      </div>
    @endforelse
  </div>

</div>
@endsection

@push('scripts')
<script>
  let activeCategoryFilter = 'all';

  // Filter Tabs
  document.querySelectorAll('#ekAdminTabs .adm-ek-tab').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('#ekAdminTabs .adm-ek-tab').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      activeCategoryFilter = btn.getAttribute('data-filter');
      filterEkAdmin();
    });
  });

  function filterEkAdmin() {
    const query = (document.getElementById('ekAdminSearch').value || '').toLowerCase().trim();
    const cards = document.querySelectorAll('#ekAdminGrid .adm-ek-card');

    cards.forEach(card => {
      const cat = card.getAttribute('data-category');
      const name = card.getAttribute('data-name') || '';
      const coach = card.getAttribute('data-coach') || '';
      const schedule = card.getAttribute('data-schedule') || '';

      const matchCat = (activeCategoryFilter === 'all') || (cat === activeCategoryFilter);
      const matchQuery = !query || name.includes(query) || coach.includes(query) || schedule.includes(query);

      card.style.display = (matchCat && matchQuery) ? '' : 'none';
    });
  }

  async function deleteExtra(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data ekstrakurikuler/organisasi ini?')) return;
    try {
      const res = await fetch(`/api/admin/extracurriculars/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Data berhasil dihapus!');
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
