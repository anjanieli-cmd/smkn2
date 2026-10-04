@extends('layouts.admin')

@section('title', 'Manajemen Karya Siswa — SMK Negeri 2 Mojokerto')

@push('styles')
<style>
  /* =========================================================
     ADMIN KARYA SISWA — STYLES & LAYOUT POLISH
     ========================================================= */
  .sw-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.25rem;
    margin-bottom: 1.75rem;
  }
  .sw-stat-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    padding: 1.25rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 1.25rem;
    transition: transform 0.25s ease, border-color 0.25s ease;
  }
  .sw-stat-card:hover {
    transform: translateY(-3px);
    border-color: rgba(255, 179, 0, 0.3);
  }
  .sw-stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    background: rgba(255, 179, 0, 0.12);
    color: var(--gold);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
  }
  .sw-stat-info h4 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
  }
  .sw-stat-info p {
    margin: 0.25rem 0 0;
    font-size: 0.78rem;
    color: var(--text-muted);
    font-weight: 500;
  }

  /* TOOLBAR & FILTER */
  .sw-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.06);
    border-radius: 14px;
    padding: 0.85rem 1.25rem;
    margin-bottom: 1.5rem;
  }
  .sw-search-box {
    position: relative;
    flex: 1;
    min-width: 240px;
    max-width: 400px;
  }
  .sw-search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 0.85rem;
  }
  .sw-search-box input {
    width: 100%;
    padding: 0.55rem 1rem 0.55rem 2.6rem;
    background: rgba(0, 0, 0, 0.25);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 10px;
    color: #fff;
    font-size: 0.82rem;
    outline: none;
    transition: border-color 0.2s;
  }
  .sw-search-box input:focus {
    border-color: var(--gold);
  }
  .sw-filter-group {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }
  .sw-select {
    padding: 0.55rem 1rem;
    background: rgba(0, 0, 0, 0.25);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 10px;
    color: #fff;
    font-size: 0.82rem;
    outline: none;
    cursor: pointer;
  }
  .sw-select option {
    background: #0d233a;
    color: #fff;
  }
  .sw-view-toggle {
    display: flex;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 8px;
    padding: 3px;
    border: 1px solid rgba(255, 255, 255, 0.1);
  }
  .sw-view-btn {
    border: none;
    background: transparent;
    color: var(--text-muted);
    padding: 0.4rem 0.75rem;
    border-radius: 6px;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.2s;
  }
  .sw-view-btn.active {
    background: var(--gold);
    color: #0a1f33;
    font-weight: 700;
  }

  /* GRID CARDS VIEW */
  .sw-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
  }
  .sw-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 18px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
  }
  .sw-card:hover {
    transform: translateY(-5px);
    border-color: rgba(255, 179, 0, 0.35);
    box-shadow: 0 16px 36px rgba(0, 0, 0, 0.35);
  }
  .sw-card-media {
    position: relative;
    width: 100%;
    height: 190px;
    background: rgba(0, 0, 0, 0.4);
    overflow: hidden;
  }
  .sw-card-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
  }
  .sw-card:hover .sw-card-media img {
    transform: scale(1.06);
  }
  .sw-card-badge {
    position: absolute;
    top: 0.85rem;
    left: 0.85rem;
    padding: 0.35rem 0.75rem;
    border-radius: 999px;
    font-size: 0.7rem;
    font-weight: 800;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    background: rgba(13, 35, 58, 0.85);
    color: var(--gold-light);
    border: 1px solid rgba(255, 179, 0, 0.3);
    backdrop-filter: blur(8px);
  }
  .sw-card-body {
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    flex: 1;
  }
  .sw-card-title {
    font-size: 1.05rem;
    font-weight: 800;
    color: #fff;
    margin: 0 0 0.4rem;
    line-height: 1.35;
  }
  .sw-card-student {
    display: flex;
    align-items: center;
    gap: 0.45rem;
    font-size: 0.78rem;
    color: var(--gold-light);
    font-weight: 600;
    margin-bottom: 0.75rem;
  }
  .sw-card-desc {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.6;
    margin: 0 0 1.25rem;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .sw-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
    padding-top: 0.85rem;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
  }

  /* EMPTY STATE */
  .sw-empty {
    text-align: center;
    padding: 4rem 2rem;
    background: rgba(255, 255, 255, 0.02);
    border: 1px dashed rgba(255, 255, 255, 0.12);
    border-radius: 18px;
    grid-column: 1 / -1;
  }
  .sw-empty i {
    font-size: 3rem;
    color: rgba(255, 179, 0, 0.3);
    margin-bottom: 1rem;
  }
  .sw-empty h3 {
    color: #fff;
    font-size: 1.15rem;
    margin: 0 0 0.35rem;
  }
  .sw-empty p {
    color: var(--text-muted);
    font-size: 0.84rem;
    margin: 0;
  }
</style>
@endpush

@section('content')
  <!-- PANEL HEADER -->
  <div class="db-panel" style="margin-bottom:1.5rem">
    <div class="db-panel-head">
      <div>
        <h2><i class="fas fa-palette" style="color:var(--gold);margin-right:.5rem"></i> Karya &amp; Inovasi Siswa</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Kelola galeri portofolio, karya aplikasi, desain, &amp; hasil produk kreatif siswa SKANEDA.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateModal()"><i class="fas fa-plus"></i> Tambah Karya Siswa</button>
      </div>
    </div>
  </div>

  <!-- STATS SUMMARY CARDS -->
  @php
    $totalWorks = count($items);
    $uniqueMajorsCount = $items->pluck('major_id')->unique()->filter()->count();
    $latestWork = $items->first();
  @endphp
  <div class="sw-stats-grid">
    <div class="sw-stat-card">
      <div class="sw-stat-icon"><i class="fas fa-layer-group"></i></div>
      <div class="sw-stat-info">
        <h4>{{ $totalWorks }}</h4>
        <p>Total Karya Terdaftar</p>
      </div>
    </div>
    <div class="sw-stat-card">
      <div class="sw-stat-icon" style="background:rgba(47,111,168,.15);color:#2f6fa8"><i class="fas fa-graduation-cap"></i></div>
      <div class="sw-stat-info">
        <h4>{{ $uniqueMajorsCount > 0 ? $uniqueMajorsCount : count(\App\Models\Major::all()) }}</h4>
        <p>Kompetensi Keahlian</p>
      </div>
    </div>
    <div class="sw-stat-card">
      <div class="sw-stat-icon" style="background:rgba(46,204,113,.15);color:#2ecc71"><i class="fas fa-sparkles"></i></div>
      <div class="sw-stat-info">
        <h4 style="font-size:1rem;word-break:break-word">{{ $latestWork ? Str::limit($latestWork->title, 18) : 'Belum Ada' }}</h4>
        <p>Karya Siswa Terbaru</p>
      </div>
    </div>
  </div>

  <!-- TOOLBAR: SEARCH, FILTER, VIEW SWITCH -->
  <div class="sw-toolbar">
    <div class="sw-search-box">
      <i class="fas fa-magnifying-glass"></i>
      <input type="text" id="searchInput" placeholder="Cari judul karya atau nama siswa..." oninput="applyFilters()">
    </div>

    <div class="sw-filter-group">
      <select id="majorFilter" class="sw-select" onchange="applyFilters()">
        <option value="">Semua Jurusan</option>
        @foreach(\App\Models\Major::all() as $m)
          <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->code }})</option>
        @endforeach
      </select>

      <div class="sw-view-toggle">
        <button type="button" class="sw-view-btn active" id="btnViewGrid" onclick="switchView('grid')" title="Tampilan Kartu Grid"><i class="fas fa-border-all"></i></button>
        <button type="button" class="sw-view-btn" id="btnViewTable" onclick="switchView('table')" title="Tampilan Tabel"><i class="fas fa-list"></i></button>
      </div>
    </div>
  </div>

  <!-- CONTAINER KONTEN (GRID VIEW & TABLE VIEW) -->
  <div id="gridContainer" class="sw-grid">
    @forelse($items as $item)
      <div class="sw-card work-item-card" data-title="{{ strtolower($item->title) }}" data-student="{{ strtolower($item->student_name) }}" data-major="{{ $item->major_id }}">
        <div class="sw-card-media">
          @if($item->media_url || $item->image_url)
            <img src="{{ asset($item->media_url ?? $item->image_url) }}" alt="{{ $item->title }}" loading="lazy">
          @else
            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--gold);font-size:2.5rem;background:rgba(255,179,0,.08)">
              <i class="fas fa-palette"></i>
            </div>
          @endif
          <span class="sw-card-badge"><i class="fas fa-graduation-cap"></i> {{ $item->major->code ?? 'Karya' }}</span>
        </div>

        <div class="sw-card-body">
          <h3 class="sw-card-title">{{ $item->title }}</h3>
          <div class="sw-card-student">
            <i class="fas fa-user-pen"></i> {{ $item->student_name }}
          </div>
          <p class="sw-card-desc">{{ $item->description }}</p>

          <div class="sw-card-footer">
            <span style="font-size:.72rem;color:var(--text-muted)">
              <i class="fas fa-building-columns"></i> {{ $item->major->name ?? 'SMK Negeri 2' }}
            </span>
            <div style="display:flex;gap:.4rem">
              <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})">
                <i class="fas fa-pen-to-square"></i> Edit
              </button>
              <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteWork('{{ $item->id }}')">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="sw-empty">
        <i class="fas fa-folder-open"></i>
        <h3>Belum Ada Data Karya Siswa</h3>
        <p>Klik tombol "Tambah Karya Siswa" di kanan atas untuk menambahkan portofolio baru.</p>
      </div>
    @endforelse
  </div>

  <!-- TABLE VIEW (HIDDEN BY DEFAULT) -->
  <div id="tableContainer" class="db-table-wrap" style="display:none">
    <table class="db-table">
      <thead>
        <tr>
          <th>Gambar</th>
          <th>Judul Karya</th>
          <th>Siswa Pembuat</th>
          <th>Jurusan</th>
          <th>Deskripsi</th>
          <th style="text-align:right">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $item)
          <tr class="work-item-row" data-title="{{ strtolower($item->title) }}" data-student="{{ strtolower($item->student_name) }}" data-major="{{ $item->major_id }}">
            <td style="width:64px">
              @if($item->media_url || $item->image_url)
                <img src="{{ asset($item->media_url ?? $item->image_url) }}" alt="" style="width:48px;height:48px;border-radius:10px;object-fit:cover;border:1px solid rgba(255,255,255,.1)">
              @else
                <div style="width:48px;height:48px;border-radius:10px;background:rgba(255,179,0,.15);color:var(--gold);display:flex;align-items:center;justify-content:center"><i class="fas fa-palette"></i></div>
              @endif
            </td>
            <td>
              <strong style="color:#fff;font-size:.9rem">{{ $item->title }}</strong>
            </td>
            <td><span style="font-size:.8rem;color:var(--gold-light)"><i class="fas fa-user-pen" style="font-size:.72rem"></i> {{ $item->student_name }}</span></td>
            <td><span style="font-size:.78rem;color:var(--text-muted);background:rgba(255,255,255,.06);padding:.25rem .6rem;border-radius:6px;border:1px solid rgba(255,255,255,.1)">{{ $item->major->code ?? '-' }}</span></td>
            <td><span style="font-size:.78rem;color:rgba(255,255,255,.8)">{{ Str::limit($item->description, 60) }}</span></td>
            <td style="text-align:right">
              <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditModal({{ json_encode($item) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
              <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteWork('{{ $item->id }}')"><i class="fas fa-trash"></i> Hapus</button>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:3rem">Belum ada data karya siswa.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- MODAL CREATE / EDIT -->
  <div class="db-modal-overlay" id="workModal">
    <div class="db-modal" style="max-width:560px">
      <div class="db-modal-head">
        <h3 id="modalTitle"><i class="fas fa-plus-circle" style="color:var(--gold)"></i> Tambah Karya Siswa Baru</h3>
        <button class="db-modal-close" onclick="closeModal()">&times;</button>
      </div>
      <div class="db-modal-body">
        <form id="workForm" onsubmit="saveWork(event)" enctype="multipart/form-data">
          <input type="hidden" id="workId">

          <div class="db-form-group">
            <label>Judul Karya Siswa *</label>
            <input type="text" id="workTitle" class="db-form-control" placeholder="Contoh: Aplikasi Smart System SMKN 2" required>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="db-form-group">
              <label>Nama Siswa / Pembuat *</label>
              <input type="text" id="studentName" class="db-form-control" placeholder="Contoh: Ahmad Rizky (XII RPL)" required>
            </div>
            <div class="db-form-group">
              <label>Jurusan / Kompetensi *</label>
              <select id="workMajorId" class="db-form-control" required>
                @foreach(\App\Models\Major::all() as $m)
                  <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->code }})</option>
                @endforeach
              </select>
            </div>
          </div>

          <!-- UPLOAD FOTO / GAMBAR KARYA -->
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div class="db-form-group">
              <label>Upload File Foto Karya</label>
              <input type="file" id="workFile" accept="image/*" class="db-form-control" style="padding:.45rem .9rem" onchange="previewSelectedImage(this)">
            </div>
            <div class="db-form-group">
              <label>atau Path / URL Gambar</label>
              <input type="text" id="workImage" class="db-form-control" placeholder="images/karya/multimie.jpeg" oninput="updateUrlPreview(this.value)">
            </div>
          </div>

          <!-- IMAGE PREVIEW -->
          <div id="imagePreviewContainer" style="display:none;margin-bottom:1rem;align-items:center;gap:1rem;background:rgba(255,255,255,.05);padding:.8rem 1rem;border-radius:12px;border:1px solid rgba(255,255,255,.1)">
            <img id="imagePreview" src="" alt="Preview Foto Karya" style="width:64px;height:64px;border-radius:10px;object-fit:cover;border:1px solid rgba(255,255,255,.2)">
            <div>
              <strong style="font-size:.82rem;color:#fff;display:block">Preview Gambar Karya</strong>
              <span id="previewText" style="font-size:.74rem;color:var(--text-muted)">Foto siap disimpan</span>
            </div>
          </div>

          <div class="db-form-group">
            <label>Deskripsi &amp; Pengenalan Karya *</label>
            <textarea id="workDescription" class="db-form-control" rows="4" placeholder="Penjelasan mengenai fitur, keunggulan, &amp; konsep karya siswa..." required></textarea>
          </div>

          <div style="display:flex;justify-content:flex-end;gap:.75rem;margin-top:1.5rem">
            <button type="button" class="db-btn db-btn-ghost" onclick="closeModal()">Batal</button>
            <button type="submit" class="db-btn db-btn-gold" id="btnSaveSubmit"><i class="fas fa-floppy-disk"></i> Simpan Karya</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  let currentView = 'grid';

  function switchView(view) {
    currentView = view;
    const gridContainer = document.getElementById('gridContainer');
    const tableContainer = document.getElementById('tableContainer');
    const btnGrid = document.getElementById('btnViewGrid');
    const btnTable = document.getElementById('btnViewTable');

    if (view === 'grid') {
      gridContainer.style.display = 'grid';
      tableContainer.style.display = 'none';
      btnGrid.classList.add('active');
      btnTable.classList.remove('active');
    } else {
      gridContainer.style.display = 'none';
      tableContainer.style.display = 'block';
      btnTable.classList.add('active');
      btnGrid.classList.remove('active');
    }
  }

  function applyFilters() {
    const searchVal = document.getElementById('searchInput').value.toLowerCase().trim();
    const majorVal = document.getElementById('majorFilter').value;

    // Filter Grid Cards
    const cards = document.querySelectorAll('.work-item-card');
    cards.forEach(card => {
      const title = card.getAttribute('data-title') || '';
      const student = card.getAttribute('data-student') || '';
      const major = card.getAttribute('data-major') || '';

      const matchesSearch = title.includes(searchVal) || student.includes(searchVal);
      const matchesMajor = !majorVal || major === majorVal;

      if (matchesSearch && matchesMajor) {
        card.style.display = 'flex';
      } else {
        card.style.display = 'none';
      }
    });

    // Filter Table Rows
    const rows = document.querySelectorAll('.work-item-row');
    rows.forEach(row => {
      const title = row.getAttribute('data-title') || '';
      const student = row.getAttribute('data-student') || '';
      const major = row.getAttribute('data-major') || '';

      const matchesSearch = title.includes(searchVal) || student.includes(searchVal);
      const matchesMajor = !majorVal || major === majorVal;

      if (matchesSearch && matchesMajor) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  function previewSelectedImage(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('imagePreview').src = e.target.result;
        document.getElementById('imagePreviewContainer').style.display = 'flex';
        document.getElementById('previewText').textContent = 'File foto terpilih: ' + input.files[0].name;
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  function updateUrlPreview(url) {
    if (url && url.trim() !== '') {
      let finalUrl = url.trim();
      if (!finalUrl.startsWith('http://') && !finalUrl.startsWith('https://') && !finalUrl.startsWith('/')) {
        finalUrl = '/' + finalUrl;
      }
      document.getElementById('imagePreview').src = finalUrl;
      document.getElementById('imagePreviewContainer').style.display = 'flex';
      document.getElementById('previewText').textContent = 'Path/URL gambar';
    } else {
      if (!document.getElementById('workFile').files.length) {
        document.getElementById('imagePreviewContainer').style.display = 'none';
      }
    }
  }

  function openCreateModal() {
    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-plus-circle" style="color:var(--gold)"></i> Tambah Karya Siswa Baru';
    document.getElementById('workId').value = '';
    document.getElementById('workTitle').value = '';
    document.getElementById('studentName').value = '';
    document.getElementById('workImage').value = '';
    document.getElementById('workFile').value = '';
    document.getElementById('workDescription').value = '';
    document.getElementById('imagePreviewContainer').style.display = 'none';
    document.getElementById('workModal').classList.add('active');
  }

  function openEditModal(item) {
    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-pen-to-square" style="color:var(--gold)"></i> Edit Karya Siswa';
    document.getElementById('workId').value = item.id;
    document.getElementById('workTitle').value = item.title;
    document.getElementById('studentName').value = item.student_name;
    document.getElementById('workMajorId').value = item.major_id || '';
    const imgPath = item.media_url || item.image_url || '';
    document.getElementById('workImage').value = imgPath;
    document.getElementById('workFile').value = '';
    document.getElementById('workDescription').value = item.description || '';

    if (imgPath) {
      updateUrlPreview(imgPath);
    } else {
      document.getElementById('imagePreviewContainer').style.display = 'none';
    }

    document.getElementById('workModal').classList.add('active');
  }

  function closeModal() {
    document.getElementById('workModal').classList.remove('active');
  }

  async function saveWork(e) {
    e.preventDefault();
    const id = document.getElementById('workId').value;
    const btnSubmit = document.getElementById('btnSaveSubmit');
    const originalBtnText = btnSubmit.innerHTML;

    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

    const formData = new FormData();
    formData.append('title', document.getElementById('workTitle').value);
    formData.append('student_name', document.getElementById('studentName').value);
    formData.append('major_id', document.getElementById('workMajorId').value);
    formData.append('description', document.getElementById('workDescription').value);
    formData.append('image_url', document.getElementById('workImage').value);

    const fileInput = document.getElementById('workFile');
    if (fileInput.files.length > 0) {
      formData.append('image_file', fileInput.files[0]);
    }

    if (id) {
      formData.append('_method', 'PUT');
    }

    const url = id ? `/api/admin/student-works/${id}` : '/api/admin/student-works';

    try {
      const res = await fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: formData
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast(id ? 'Karya berhasil diperbarui!' : 'Karya baru berhasil ditambahkan!');
        closeModal();
        setTimeout(() => location.reload(), 700);
      } else {
        showToast(data.message || 'Gagal menyimpan karya.', 'error');
        btnSubmit.disabled = false;
        btnSubmit.innerHTML = originalBtnText;
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
      btnSubmit.disabled = false;
      btnSubmit.innerHTML = originalBtnText;
    }
  }

  async function deleteWork(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data karya ini?')) return;
    try {
      const res = await fetch(`/api/admin/student-works/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      if (res.ok && data.success) {
        showToast('Karya berhasil dihapus!');
        setTimeout(() => location.reload(), 700);
      } else {
        showToast(data.message || 'Gagal menghapus data.', 'error');
      }
    } catch (err) {
      showToast('Terjadi kesalahan koneksi server.', 'error');
    }
  }
</script>
@endpush
