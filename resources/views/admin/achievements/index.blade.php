@extends('layouts.admin')

@section('title', 'Manajemen Prestasi Sekolah — SMK Negeri 2 Mojokerto')

@section('content')
  <style>
    /* Datepicker Calendar Indicator Fix (Crisp White/Gold Icon) */
    input[type="date"]::-webkit-calendar-picker-indicator,
    input[type="datetime-local"]::-webkit-calendar-picker-indicator,
    input[type="time"]::-webkit-calendar-picker-indicator {
      filter: invert(1) brightness(2) !important;
      cursor: pointer !important;
      opacity: 1 !important;
    }
    input[type="date"] {
      color-scheme: dark !important;
    }
    input[type="file"]::file-selector-button {
      background: rgba(255, 255, 255, 0.15) !important;
      color: #fff !important;
      border: 1px solid rgba(255, 255, 255, 0.2) !important;
      border-radius: 6px !important;
      padding: .3rem .6rem !important;
      cursor: pointer !important;
      margin-right: .6rem !important;
    }
    input[type="file"]::file-selector-button:hover {
      background: var(--gold) !important;
      color: var(--ink) !important;
    }
  </style>

  @if(session('success'))
    <div style="background:rgba(16,185,129,.15);border:1px solid rgba(16,185,129,.4);color:#10b981;padding:.75rem 1.2rem;border-radius:12px;margin-bottom:1.2rem;font-size:.85rem;display:flex;align-items:center;gap:.6rem">
      <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  @if($errors->any())
    <div style="background:rgba(239,68,68,.15);border:1px solid rgba(239,68,68,.4);color:#ef4444;padding:.75rem 1.2rem;border-radius:12px;margin-bottom:1.2rem;font-size:.85rem">
      <ul style="margin:0;padding-left:1.2rem">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="db-panel">
    <div class="db-panel-head">
      <div>
        <h2><i class="fas fa-trophy" style="color:var(--gold);margin-right:.5rem"></i> Prestasi &amp; Penghargaan Sekolah</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Kelola arsip piala, sertifikat, dan dokumentasi kejuaraan resmi SMK Negeri 2 Mojokerto.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateAchvModal()"><i class="fas fa-plus"></i> Tambah Prestasi Baru</button>
      </div>
    </div>

    <!-- TOOLBAR SEARCH & FILTER -->
    <div style="display:flex;align-items:center;justify-content:space-between;gap:1rem;margin:1.2rem 1.4rem;flex-wrap:wrap;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);padding:.8rem 1.2rem;border-radius:14px">
      <div style="position:relative;flex:1;min-width:240px">
        <i class="fas fa-search" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:.85rem"></i>
        <input type="text" id="achvSearchInput" value="{{ request('search') }}" placeholder="Cari judul kejuaraan, pemenang, atau deskripsi..." onkeyup="filterAdminAchievements()" style="width:100%;padding:.55rem .9rem .55rem 2.4rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.14);color:#fff;font-size:.82rem">
      </div>
      <div style="display:flex;align-items:center;gap:.6rem">
        <label style="font-size:.78rem;color:var(--text-muted);font-weight:700">Tingkat Lomba:</label>
        <select id="achvLevelFilter" onchange="filterAdminAchievements()" style="padding:.55rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.14);color:#fff;font-size:.82rem">
          <option value="">Semua Tingkat</option>
          <option value="Kota/Kabupaten" {{ request('level') == 'Kota/Kabupaten' ? 'selected' : '' }}>Kota / Kabupaten</option>
          <option value="Provinsi" {{ request('level') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
          <option value="Nasional" {{ request('level') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
          <option value="Internasional" {{ request('level') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
        </select>
      </div>
    </div>

    <!-- TABLE PRESTASI SEKOLAH -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Dokumentasi</th>
            <th>Judul Prestasi / Kejuaraan</th>
            <th>Tingkat Lomba</th>
            <th>Tahun</th>
            <th>Pemenang / Tim</th>
            <th style="text-align:right">Aksi</th>
          </tr>
        </thead>
        <tbody id="achvTableBody">
          @if(isset($items) && count($items) > 0)
            @foreach($items as $item)
              <tr data-title="{{ strtolower($item->title ?? '') }}" data-winner="{{ strtolower($item->winner_name ?? '') }}" data-level="{{ strtolower($item->level ?? '') }}">
                <td style="width:65px">
                  @php
                    $img = $item->image_url ?? $item->image_path;
                    $hasValidImg = $img && file_exists(public_path($img));
                  @endphp
                  @if($hasValidImg)
                    <img src="{{ asset($img) }}" alt="" style="width:48px;height:48px;border-radius:12px;object-fit:cover">
                  @else
                    <div style="width:48px;height:48px;border-radius:12px;background:rgba(255,179,0,.15);color:var(--gold);display:flex;align-items:center;justify-content:center"><i class="fas fa-trophy" style="font-size:1.2rem"></i></div>
                  @endif
                </td>
                <td>
                  <strong>{{ $item->title }}</strong>
                  <div style="font-size:.72rem;color:var(--text-muted)">{{ Str::limit($item->description ?? '', 50) }}</div>
                </td>
                <td><span style="font-size:.75rem;padding:.25rem .55rem;border-radius:99px;background:rgba(255,179,0,.2);color:var(--gold-light);font-weight:700;text-transform:uppercase">{{ $item->level ?? 'Provinsi' }}</span></td>
                <td><span style="font-size:.78rem;color:var(--gold-light)">{{ $item->year ?? '2026' }}</span></td>
                <td><span style="font-size:.78rem;color:#fff">{{ $item->winner_name ?? '-' }}</span></td>
                <td style="text-align:right">
                  <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditAchvModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                  <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteAchv('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="6" style="text-align:center;padding:2.5rem;color:var(--text-muted)">
                <i class="fas fa-trophy" style="font-size:2.2rem;color:var(--gold);margin-bottom:.8rem;display:block"></i>
                <p style="margin:0;font-size:.9rem">Belum ada data prestasi yang ditambahkan.</p>
                <p style="font-size:.78rem;margin-top:.3rem">Klik tombol <strong>"Tambah Prestasi Baru"</strong> di atas untuk menambahkan data pertama.</p>
              </td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

  <!-- HIDDEN DELETE FORM -->
  <form id="deleteAchvForm" method="POST" action="" style="display:none">
    @csrf
    @method('DELETE')
  </form>

  <!-- MODAL CREATE / EDIT PRESTASI -->
  <div id="achvModal" style="display:none;position:fixed;inset:0;z-index:999;background:rgba(3,10,20,.8);backdrop-filter:blur(8px);align-items:center;justify-content:center">
    <div style="width:min(540px,92vw);background:var(--navy-panel);border:1px solid rgba(255,255,255,.14);border-radius:20px;padding:1.8rem;box-shadow:0 24px 60px rgba(0,0,0,.5);color:#fff">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.2rem">
        <h3 id="achvModalTitle" style="font-size:1.15rem;margin:0"><i class="fas fa-trophy" style="color:var(--gold);margin-right:.5rem"></i> Tambah Prestasi Sekolah</h3>
        <button style="background:none;border:none;color:var(--text-muted);font-size:1.2rem;cursor:pointer" onclick="closeAchvModal()">&times;</button>
      </div>
      <form id="achvForm" action="{{ route('admin.achievements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="achvFormMethod"></div>
        <div style="margin-bottom:1rem">
          <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Judul Prestasi / Kejuaraan</label>
          <input type="text" name="title" id="achvTitle" class="form-control" placeholder="Contoh: Juara 1 LKS Web Technologies" required style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff">
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
          <div>
            <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Tingkat Lomba</label>
            <select name="level" id="achvLevel" class="form-control" style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff">
              <option value="Kota/Kabupaten">Kota / Kabupaten</option>
              <option value="Provinsi">Provinsi</option>
              <option value="Nasional">Nasional</option>
              <option value="Internasional">Internasional</option>
            </select>
          </div>
          <div>
            <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Tahun</label>
            <input type="number" name="year" id="achvYear" value="2026" class="form-control" style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff">
          </div>
        </div>
        <div style="margin-bottom:1rem">
          <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Nama Siswa / Pemenang / Tim</label>
          <input type="text" name="winner_name" id="achvWinner" class="form-control" placeholder="Contoh: Rovino Ramadhani (XII RPL 1)" style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff">
        </div>
        <div style="margin-bottom:1rem">
          <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Dokumentasi (Foto Piala / Sertifikat)</label>
          <input type="file" name="image" accept="image/*" class="form-control" style="width:100%;padding:.5rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff">
        </div>
        <div style="margin-bottom:1.4rem">
          <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Deskripsi Singkat</label>
          <textarea name="description" id="achvDesc" rows="3" class="form-control" placeholder="Rincian mengenai kejuaraan..." style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff"></textarea>
        </div>
        <div style="display:flex;justify-content:flex-end;gap:.7rem">
          <button type="button" class="db-btn db-btn-ghost" onclick="closeAchvModal()">Batal</button>
          <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-save"></i> Simpan Prestasi</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function openCreateAchvModal() {
    document.getElementById('achvModalTitle').innerHTML = '<i class="fas fa-trophy" style="color:var(--gold);margin-right:.5rem"></i> Tambah Prestasi Sekolah';
    document.getElementById('achvForm').action = "{{ route('admin.achievements.store') }}";
    document.getElementById('achvFormMethod').innerHTML = '';
    document.getElementById('achvForm').reset();
    document.getElementById('achvModal').style.display = 'flex';
  }

  function openEditAchvModal(item) {
    document.getElementById('achvModalTitle').innerHTML = '<i class="fas fa-pen-to-square" style="color:var(--gold);margin-right:.5rem"></i> Edit Prestasi Sekolah';
    document.getElementById('achvForm').action = "{{ url('admin/achievements') }}/" + item.id;
    document.getElementById('achvFormMethod').innerHTML = '<input type="hidden" name="_method" value="PUT">';
    document.getElementById('achvTitle').value = item.title || '';
    document.getElementById('achvLevel').value = item.level || 'Provinsi';
    document.getElementById('achvYear').value = item.year || '2026';
    document.getElementById('achvWinner').value = item.winner_name || '';
    document.getElementById('achvDesc').value = item.description || '';
    document.getElementById('achvModal').style.display = 'flex';
  }

  function closeAchvModal() {
    document.getElementById('achvModal').style.display = 'none';
  }

  function deleteAchv(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data prestasi sekolah ini?')) {
      const form = document.getElementById('deleteAchvForm');
      form.action = "{{ url('admin/achievements') }}/" + id;
      form.submit();
    }
  }

  function filterAdminAchievements() {
    const query = (document.getElementById('achvSearchInput').value || '').toLowerCase().trim();
    const level = (document.getElementById('achvLevelFilter').value || '').toLowerCase().trim();
    const rows = document.querySelectorAll('#achvTableBody tr');

    rows.forEach(row => {
      if (row.cells.length <= 1) return;

      const titleText = (row.getAttribute('data-title') || '').toLowerCase();
      const winnerText = (row.getAttribute('data-winner') || '').toLowerCase();
      const levelText = (row.getAttribute('data-level') || '').toLowerCase();

      const matchesQuery = !query || titleText.includes(query) || winnerText.includes(query);
      const matchesLevel = !level || levelText.includes(level);

      if (matchesQuery && matchesLevel) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }
</script>
@endpush
