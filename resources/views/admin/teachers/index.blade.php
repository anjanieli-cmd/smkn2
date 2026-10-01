@extends('layouts.admin')

@section('title', 'Manajemen Guru & Staf — SMK Negeri 2 Mojokerto')

@section('content')
<style>
  .adm-tc-wrap {
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
  .adm-tc-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    flex-wrap: wrap;
    padding: 1.5rem 1.8rem;
    background: linear-gradient(120deg, rgba(76, 201, 141, .12), rgba(255, 255, 255, .02) 60%);
    border: 1px solid var(--a-border);
    border-radius: 20px;
    margin-bottom: 1.8rem;
  }

  .adm-tc-header h1 {
    font-family: var(--font-display);
    font-size: 1.35rem;
    color: #fff;
    margin: 0 0 .3rem;
  }

  .adm-tc-header p {
    font-size: .82rem;
    color: var(--a-muted);
    margin: 0;
  }

  /* Stat Cards */
  .adm-tc-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.2rem;
    margin-bottom: 1.8rem;
  }

  .adm-tc-stat-card {
    background: var(--a-card);
    border: 1px solid var(--a-border);
    border-radius: 16px;
    padding: 1.25rem 1.4rem;
    transition: transform .3s var(--a-ease), border-color .3s var(--a-ease);
  }

  .adm-tc-stat-card:hover {
    transform: translateY(-3px);
    border-color: var(--a-border-hover);
  }

  .adm-tc-stat-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: .8rem;
  }

  .adm-tc-stat-icon {
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

  .adm-tc-stat-val {
    font-family: var(--font-display);
    font-size: 1.85rem;
    color: #fff;
    line-height: 1;
    margin-bottom: .3rem;
  }

  .adm-tc-stat-lbl {
    font-size: .76rem;
    color: var(--a-muted);
    font-weight: 600;
  }

  /* Toolbar */
  .adm-tc-toolbar {
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

  .adm-tc-tabs {
    display: flex;
    align-items: center;
    gap: .5rem;
    flex-wrap: wrap;
  }

  .adm-tc-tab {
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

  .adm-tc-tab:hover {
    color: #fff;
    background: rgba(255, 255, 255, .1);
  }

  .adm-tc-tab.active {
    background: linear-gradient(135deg, rgba(76, 201, 141, .22), rgba(76, 201, 141, .08));
    color: #5ce0a3;
    border-color: rgba(76, 201, 141, .35);
  }

  .adm-tc-search {
    position: relative;
    min-width: 260px;
  }

  .adm-tc-search i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--a-muted);
    font-size: .85rem;
  }

  .adm-tc-search input {
    width: 100%;
    padding: .55rem .9rem .55rem 2.4rem;
    border-radius: 10px;
    background: rgba(255, 255, 255, .06);
    border: 1px solid rgba(255, 255, 255, .12);
    color: #fff;
    font-size: .82rem;
    outline: none;
  }

  .adm-tc-search input:focus {
    border-color: var(--a-gold);
  }

  /* Grid Cards */
  .adm-tc-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.4rem;
  }

  .adm-tc-card {
    background: var(--a-card);
    border: 1px solid var(--a-border);
    border-radius: 18px;
    padding: 1.3rem;
    position: relative;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    transition: transform .3s var(--a-ease), border-color .3s var(--a-ease), box-shadow .3s var(--a-ease);
  }

  .adm-tc-card:hover {
    transform: translateY(-4px);
    border-color: var(--a-border-hover);
    box-shadow: 0 16px 36px rgba(0, 0, 0, .25);
  }

  .adm-tc-card-top {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
  }

  .adm-tc-avatar {
    width: 64px;
    height: 64px;
    border-radius: 14px;
    object-fit: cover;
    border: 2px solid rgba(255, 255, 255, .15);
    background: rgba(15, 47, 82, .8);
    flex-shrink: 0;
    box-shadow: 0 8px 18px rgba(0, 0, 0, .3);
  }

  .adm-tc-avatar-fallback {
    width: 64px;
    height: 64px;
    border-radius: 14px;
    background: linear-gradient(135deg, rgba(255, 179, 0, .2), rgba(255, 179, 0, .05));
    border: 2px solid rgba(255, 179, 0, .3);
    color: var(--a-gold-light);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-display);
    font-size: 1.5rem;
    flex-shrink: 0;
  }

  .adm-tc-info {
    min-width: 0;
    flex: 1;
  }

  .adm-tc-name {
    font-family: var(--font-display);
    font-size: .98rem;
    color: #fff;
    margin: 0 0 .25rem;
    line-height: 1.35;
  }

  .adm-tc-role {
    font-size: .78rem;
    color: var(--a-gold-light);
    font-weight: 700;
    margin-bottom: .35rem;
  }

  .adm-tc-nip {
    font-family: monospace;
    font-size: .7rem;
    color: var(--a-muted);
    display: inline-block;
    background: rgba(255, 255, 255, .05);
    padding: .15rem .45rem;
    border-radius: 6px;
  }

  .adm-tc-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .5rem;
    padding-top: .75rem;
    border-top: 1px dashed rgba(255, 255, 255, .08);
  }

  .adm-tc-type-badge {
    font-size: .68rem;
    font-weight: 800;
    letter-spacing: .04em;
    text-transform: uppercase;
    color: #4fc3f7;
    background: rgba(40, 169, 225, .12);
    padding: .25rem .6rem;
    border-radius: 999px;
  }

  .adm-tc-card-foot {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .5rem;
    margin-top: auto;
  }

  /* PREMIUM MODAL STYLING */
  .db-modal-header-banner {
    display: flex;
    align-items: center;
    gap: .85rem;
    padding: 1.25rem 1.5rem;
    background: linear-gradient(135deg, rgba(76,201,141,.18), rgba(12,40,70,.9));
    border-bottom: 1px solid rgba(255,255,255,.1);
  }
  .db-modal-header-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: linear-gradient(135deg, #5ce0a3, #2eac75);
    color: #0c2846;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.15rem;
    box-shadow: 0 6px 16px rgba(76,201,141,.3);
  }

  @media(max-width: 1100px) {
    .adm-tc-stats {
      grid-template-columns: repeat(2, 1fr)
    }

    .adm-tc-grid {
      grid-template-columns: repeat(2, 1fr)
    }
  }

  @media(max-width: 700px) {
    .adm-tc-stats {
      grid-template-columns: 1fr
    }

    .adm-tc-grid {
      grid-template-columns: 1fr
    }

    .adm-tc-toolbar {
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

<div class="adm-tc-wrap">
  @php
    $totalTeachersCount = $teachers->count();
    $activeCount = $teachers->where('is_active', true)->count();
    $staffCount = $teachers->filter(fn($t) => str_contains(strtolower($t->role_position), 'staf') || str_contains(strtolower($t->role_position), 'staff'))->count();
    $guruCount = $totalTeachersCount - $staffCount;
  @endphp

  <!-- HEADER MATCHING SCHOOL-HISTORY PATTERN -->
  <div class="db-panel-head">
    <div>
      <h2><i class="fas fa-chalkboard-user" style="color:var(--a-gold);margin-right:.5rem"></i> Guru &amp; Tenaga Kependidikan</h2>
      <p style="font-size:.8rem;color:var(--a-muted);margin-top:.25rem">Kelola profil pendidik, foto formal, NIP, dan jabatan yang tampil di kartu digital publik.</p>
    </div>
    <div class="db-panel-actions">
      <a href="{{ route('admin.teachers.create') }}" class="db-btn db-btn-gold">
        <i class="fas fa-plus"></i> Tambah Guru / Staf Baru
      </a>
    </div>
  </div>

  <!-- STAT CARDS -->
  <div class="adm-tc-stats">
    <div class="adm-tc-stat-card" style="--stat-bg:rgba(76,201,141,.14);--stat-fg:#5ce0a3">
      <div class="adm-tc-stat-top">
        <div class="adm-tc-stat-icon"><i class="fas fa-chalkboard-user"></i></div>
        <span class="db-tag active"><i class="fas fa-circle-check"></i> Terdata</span>
      </div>
      <div class="adm-tc-stat-val">{{ $totalTeachersCount }}</div>
      <div class="adm-tc-stat-lbl">Total Guru &amp; Staf</div>
    </div>

    <div class="adm-tc-stat-card" style="--stat-bg:rgba(255,179,0,.14);--stat-fg:#ffb300">
      <div class="adm-tc-stat-top">
        <div class="adm-tc-stat-icon"><i class="fas fa-graduation-cap"></i></div>
        <span class="db-tag PENDING"><i class="fas fa-user-graduate"></i> Pendidik</span>
      </div>
      <div class="adm-tc-stat-val">{{ $guruCount }}</div>
      <div class="adm-tc-stat-lbl">Guru Pendidik</div>
    </div>

    <div class="adm-tc-stat-card" style="--stat-bg:rgba(79,195,247,.14);--stat-fg:#4fc3f7">
      <div class="adm-tc-stat-top">
        <div class="adm-tc-stat-icon"><i class="fas fa-users-gear"></i></div>
        <span class="db-tag REVIEWING"><i class="fas fa-building"></i> Kependidikan</span>
      </div>
      <div class="adm-tc-stat-val">{{ $staffCount }}</div>
      <div class="adm-tc-stat-lbl">Staf &amp; Tenaga Kependidikan</div>
    </div>
  </div>

  <!-- TOOLBAR TABS & SEARCH -->
  <div class="adm-tc-toolbar">
    <div class="adm-tc-tabs" id="tcAdminTabs">
      <button class="adm-tc-tab active" data-filter="all">Semua Data ({{ $totalTeachersCount }})</button>
      <button class="adm-tc-tab" data-filter="guru">Guru Pendidik ({{ $guruCount }})</button>
      <button class="adm-tc-tab" data-filter="staf">Staf &amp; Kependidikan ({{ $staffCount }})</button>
    </div>

    <div class="adm-tc-search">
      <i class="fas fa-magnifying-glass"></i>
      <input type="text" id="tcAdminSearch" placeholder="Cari nama, NIP, atau jabatan..." onkeyup="filterTcAdmin()">
    </div>
  </div>

  <!-- CARDS GRID -->
  <div class="adm-tc-grid" id="tcAdminGrid">
    @forelse($teachers as $item)
      @php
        $isStaff = str_contains(strtolower($item->role_position), 'staf') || str_contains(strtolower($item->role_position), 'staff');
        $catType = $isStaff ? 'staf' : 'guru';
        $photoSrc = $item->photo_url ? (str_starts_with($item->photo_url, 'http') ? $item->photo_url : asset($item->photo_url)) : null;
      @endphp
      <div class="adm-tc-card" data-category="{{ $catType }}" data-status="{{ $item->is_active ? 'aktif' : 'nonaktif' }}" data-name="{{ strtolower($item->name) }}" data-nip="{{ strtolower($item->nip ?? '') }}" data-role="{{ strtolower($item->role_position ?? '') }}">
        <div class="adm-tc-card-top">
          @if($photoSrc)
            <img src="{{ $photoSrc }}" alt="{{ $item->name }}" class="adm-tc-avatar" onerror="this.onerror=null;this.className='adm-tc-avatar-fallback';this.innerHTML='{{ substr($item->name, 0, 1) }}'">
          @else
            <div class="adm-tc-avatar-fallback">{{ substr($item->name, 0, 1) }}</div>
          @endif

          <div class="adm-tc-info">
            <h3 class="adm-tc-name">{{ $item->name }}</h3>
            <div class="adm-tc-role"><i class="fas {{ $isStaff ? 'fa-users-gear' : 'fa-chalkboard-user' }}"></i> {{ $item->role_position }}</div>
            <span class="adm-tc-nip">NIP: {{ $item->nip ?? '-' }}</span>
          </div>
        </div>

        <div class="adm-tc-meta">
          <span class="adm-tc-type-badge">{{ $isStaff ? 'Tenaga Kependidikan' : 'Tenaga Pendidik' }}</span>
          <span class="db-tag {{ $item->is_active ? 'active' : 'inactive' }}">
            <i class="fas {{ $item->is_active ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i> {{ $item->is_active ? 'Aktif' : 'Non-Aktif' }}
          </span>
        </div>

        <div class="adm-tc-card-foot">
          <span style="font-size:.7rem;color:var(--a-muted)">ID: {{ substr($item->id, 0, 8) }}</span>
          <div style="display:flex;gap:.4rem">
            <a href="{{ route('admin.teachers.edit', $item->id) }}" class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.74rem">
              <i class="fas fa-pen-to-square"></i> Edit
            </a>
            <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.74rem" onclick="deleteTeacher('{{ $item->id }}')">
              <i class="fas fa-trash"></i> Hapus
            </button>
          </div>
        </div>
      </div>
    @empty
      <div style="grid-column:1/-1;text-align:center;padding:3rem 1rem;color:var(--a-muted)">
        <i class="fas fa-chalkboard-user" style="font-size:2rem;margin-bottom:1rem;opacity:.5;display:block"></i>
        Belum ada data guru atau staf.
      </div>
    @endforelse
  </div>

</div>
@endsection

@push('scripts')
<script>
  let activeTcFilter = 'all';

  function updateRolePlaceholder(type) {
    const roleInput = document.getElementById('teacherRole');
    if (type === 'STAF') {
      if (!roleInput.value) roleInput.placeholder = 'Contoh: Staf Tata Usaha / Staf Keamanan';
    } else {
      if (!roleInput.value) roleInput.placeholder = 'Contoh: Guru Normatif - Matematika / Guru Produktif RPL';
    }
  }

  // Filter Tabs
  document.querySelectorAll('#tcAdminTabs .adm-tc-tab').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('#tcAdminTabs .adm-tc-tab').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      activeTcFilter = btn.getAttribute('data-filter');
      filterTcAdmin();
    });
  });

  function filterTcAdmin() {
    const query = (document.getElementById('tcAdminSearch').value || '').toLowerCase().trim();
    const cards = document.querySelectorAll('#tcAdminGrid .adm-tc-card');

    cards.forEach(card => {
      const cat = card.getAttribute('data-category');
      const status = card.getAttribute('data-status');
      const name = card.getAttribute('data-name') || '';
      const nip = card.getAttribute('data-nip') || '';
      const role = card.getAttribute('data-role') || '';

      let matchTab = false;
      if (activeTcFilter === 'all') matchTab = true;
      else if (activeTcFilter === 'guru') matchTab = (cat === 'guru');
      else if (activeTcFilter === 'staf') matchTab = (cat === 'staf');

      const matchQuery = !query || name.includes(query) || nip.includes(query) || role.includes(query);

      card.style.display = (matchTab && matchQuery) ? '' : 'none';
    });
  }

  function strContains(str, search) {
    return str.indexOf(search) !== -1;
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
