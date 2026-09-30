@extends('layouts.admin')

@section('title', 'Manajemen Galeri Kegiatan Sekolah — SMK Negeri 2 Mojokerto')

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
        <h2><i class="fas fa-images" style="color:var(--gold);margin-right:.5rem"></i> Galeri Kegiatan Sekolah (Album &amp; Foto)</h2>
        <p style="font-size:.78rem;color:var(--text-muted);margin-top:.2rem">Kelola album foto kegiatan, liputan momen sekolah, dan jurnal dokumentasi SKANEDA.</p>
      </div>
      <div class="db-panel-actions">
        <button class="db-btn db-btn-gold" onclick="openCreateAlbumModal()"><i class="fas fa-plus"></i> Tambah Album Baru</button>
      </div>
    </div>

    <!-- TOOLBAR SEARCH & FILTER -->
    <div style="display:flex;align-items:center;justify-content:space-between;gap:1rem;margin:1.2rem 1.4rem;flex-wrap:wrap;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);padding:.8rem 1.2rem;border-radius:14px">
      <div style="position:relative;flex:1;min-width:240px">
        <i class="fas fa-search" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:.85rem"></i>
        <input type="text" id="albumSearchInput" value="{{ request('search') }}" placeholder="Cari nama album atau deskripsi kegiatan..." onkeyup="filterAdminAlbums()" style="width:100%;padding:.55rem .9rem .55rem 2.4rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.14);color:#fff;font-size:.82rem">
      </div>
      <div style="display:flex;align-items:center;gap:.6rem">
        <label style="font-size:.78rem;color:var(--text-muted);font-weight:700">Filter Kategori:</label>
        <select id="albumCategoryFilter" onchange="filterAdminAlbums()" style="padding:.55rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.14);color:#fff;font-size:.82rem">
          <option value="">Semua Kategori</option>
          <option value="Akademik" {{ request('category') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
          <option value="Ekstrakurikuler" {{ request('category') == 'Ekstrakurikuler' ? 'selected' : '' }}>Ekstrakurikuler</option>
          <option value="Kesiswaan" {{ request('category') == 'Kesiswaan' ? 'selected' : '' }}>Kesiswaan</option>
          <option value="Upacara" {{ request('category') == 'Upacara' ? 'selected' : '' }}>Upacara</option>
          <option value="Kompetisi" {{ request('category') == 'Kompetisi' ? 'selected' : '' }}>Kompetisi</option>
          <option value="Kegiatan Sekolah" {{ request('category') == 'Kegiatan Sekolah' ? 'selected' : '' }}>Kegiatan Sekolah</option>
          <option value="Kunjungan Industri" {{ request('category') == 'Kunjungan Industri' ? 'selected' : '' }}>Kunjungan Industri</option>
        </select>
      </div>
    </div>

    <!-- TABLE ALBUM -->
    <div class="db-table-wrap">
      <table class="db-table">
        <thead>
          <tr>
            <th>Cover</th>
            <th>Nama Album Kegiatan</th>
            <th>Kategori</th>
            <th>Tanggal Kegiatan</th>
            <th>Jumlah Foto</th>
            <th style="text-align:right">Aksi</th>
          </tr>
        </thead>
        <tbody id="albumTableBody">
          @if(isset($albums) && count($albums) > 0)
            @foreach($albums as $album)
              <tr data-title="{{ strtolower($album->title ?? '') }}" data-category="{{ strtolower($album->category ?? '') }}">
                <td style="width:65px">
                  @if($album->image_url || $album->cover_image)
                    <img src="{{ asset($album->image_url ?? $album->cover_image) }}" alt="" style="width:48px;height:48px;border-radius:12px;object-fit:cover" onerror="this.src='{{ asset('images/logo_smkn2.png') }}'">
                  @else
                    <div style="width:48px;height:48px;border-radius:12px;background:rgba(255,179,0,.15);color:var(--gold);display:flex;align-items:center;justify-content:center"><i class="fas fa-images"></i></div>
                  @endif
                </td>
                <td>
                  <strong>{{ $album->title ?? $album->name }}</strong>
                  <div style="font-size:.72rem;color:var(--text-muted)">{{ Str::limit($album->description ?? '', 50) }}</div>
                </td>
                <td><span style="font-size:.75rem;padding:.25rem .55rem;border-radius:99px;background:rgba(29,111,184,.2);color:#5bb3ea;font-weight:700">{{ $album->category ?? 'Kegiatan Sekolah' }}</span></td>
                <td><span style="font-size:.78rem;color:var(--gold-light)">{{ $album->event_date ? \Carbon\Carbon::parse($album->event_date)->format('d M Y') : '—' }}</span></td>
                <td><span style="font-size:.78rem;font-weight:800;color:#fff">{{ $album->photos_count ?? (isset($album->photos) ? count($album->photos) : 0) }} foto</span></td>
                <td style="text-align:right">
                  <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openPhotoManagerModal({{ json_encode($album) }})"><i class="fas fa-photo-film"></i> Upload Foto</button>
                  <button class="db-btn db-btn-ghost" style="padding:.35rem .65rem;font-size:.75rem" onclick="openEditAlbumModal({{ json_encode($album) }})"><i class="fas fa-pen-to-square"></i> Edit</button>
                  <button class="db-btn db-btn-danger" style="padding:.35rem .65rem;font-size:.75rem" onclick="deleteAlbum('{{ $album->id }}')"><i class="fas fa-trash"></i> Hapus</button>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="6" style="text-align:center;padding:2.5rem;color:var(--text-muted)">
                <i class="fas fa-images" style="font-size:2.2rem;color:var(--gold);margin-bottom:.8rem;display:block"></i>
                <p style="margin:0;font-size:.9rem">Belum ada album kegiatan yang dibuat.</p>
                <p style="font-size:.78rem;margin-top:.3rem">Klik tombol <strong>"Tambah Album Baru"</strong> di atas untuk menambahkan album pertama.</p>
              </td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

  <!-- HIDDEN DELETE FORMS -->
  <form id="deleteAlbumForm" method="POST" action="" style="display:none">
    @csrf
    @method('DELETE')
  </form>

  <form id="deletePhotoForm" method="POST" action="" style="display:none">
    @csrf
    @method('DELETE')
  </form>

  <!-- MODAL CREATE / EDIT ALBUM -->
  <div id="albumModal" style="display:none;position:fixed;inset:0;z-index:999;background:rgba(3,10,20,.8);backdrop-filter:blur(8px);align-items:center;justify-content:center">
    <div style="width:min(520px,92vw);background:var(--navy-panel);border:1px solid rgba(255,255,255,.14);border-radius:20px;padding:1.8rem;box-shadow:0 24px 60px rgba(0,0,0,.5);color:#fff">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.2rem">
        <h3 id="albumModalTitle" style="font-size:1.15rem;margin:0"><i class="fas fa-images" style="color:var(--gold);margin-right:.5rem"></i> Tambah Album Kegiatan</h3>
        <button style="background:none;border:none;color:var(--text-muted);font-size:1.2rem;cursor:pointer" onclick="closeAlbumModal()">&times;</button>
      </div>
      <form id="albumForm" action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="albumFormMethod"></div>
        <div style="margin-bottom:1rem">
          <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Nama Album Kegiatan</label>
          <input type="text" name="title" id="albumTitle" class="form-control" placeholder="Contoh: MPLS Peserta Didik Baru 2026" required style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff">
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
          <div>
            <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Kategori</label>
            <select name="category" id="albumCategory" class="form-control" style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff">
              <option value="Akademik">Akademik</option>
              <option value="Ekstrakurikuler">Ekstrakurikuler</option>
              <option value="Kesiswaan">Kesiswaan</option>
              <option value="Upacara">Upacara</option>
              <option value="Kompetisi">Kompetisi</option>
              <option value="Kegiatan Sekolah">Kegiatan Sekolah</option>
              <option value="Kunjungan Industri">Kunjungan Industri</option>
            </select>
          </div>
          <div>
            <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Tanggal Kegiatan</label>
            <input type="date" name="event_date" id="albumDate" class="form-control" style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff;color-scheme:dark !important;">
          </div>
        </div>
        <div style="margin-bottom:1rem">
          <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Foto Cover Album</label>
          <input type="file" name="cover_image" accept="image/*" class="form-control" style="width:100%;padding:.5rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff">
        </div>
        <div style="margin-bottom:1.4rem">
          <label style="display:block;font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.4rem">Deskripsi Singkat Album</label>
          <textarea name="description" id="albumDesc" rows="3" class="form-control" placeholder="Jelaskan mengenai momen kegiatan ini..." style="width:100%;padding:.65rem .85rem;border-radius:10px;background:var(--navy-bg);border:1px solid rgba(255,255,255,.15);color:#fff"></textarea>
        </div>
        <div style="display:flex;justify-content:flex-end;gap:.7rem">
          <button type="button" class="db-btn db-btn-ghost" onclick="closeAlbumModal()">Batal</button>
          <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-save"></i> Simpan Album</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL MULTI-UPLOAD FOTO ALBUM -->
  <div id="photoModal" style="display:none;position:fixed;inset:0;z-index:999;background:rgba(3,10,20,.85);backdrop-filter:blur(10px);align-items:center;justify-content:center">
    <div style="width:min(720px,94vw);background:var(--navy-panel);border:1px solid rgba(255,255,255,.16);border-radius:24px;padding:2rem;box-shadow:0 30px 80px rgba(0,0,0,.6);color:#fff">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem">
        <div>
          <h3 id="photoModalAlbumTitle" style="font-size:1.2rem;margin:0"><i class="fas fa-photo-film" style="color:var(--gold);margin-right:.5rem"></i> Kelola Foto Album</h3>
          <p style="font-size:.75rem;color:var(--text-muted);margin-top:.2rem">Upload banyak foto kegiatan ke dalam album ini sekaligus.</p>
        </div>
        <button style="background:none;border:none;color:var(--text-muted);font-size:1.3rem;cursor:pointer" onclick="closePhotoModal()">&times;</button>
      </div>

      <!-- FORM UPLOAD FOTO MULTIPLE -->
      <form id="photoUploadForm" method="POST" action="" enctype="multipart/form-data">
        @csrf
        <div style="border:2px dashed rgba(255,179,0,.4);border-radius:16px;padding:1.5rem;text-align:center;background:rgba(255,179,0,.04);margin-bottom:1.5rem">
          <i class="fas fa-cloud-arrow-up" style="font-size:2.2rem;color:var(--gold);margin-bottom:.5rem"></i>
          <h4 style="font-size:.9rem;margin-bottom:.3rem">Pilih Foto Kegiatan</h4>
          <p style="font-size:.72rem;color:var(--text-muted);margin-bottom:1rem">Format JPG, PNG, WEBP (Bisa pilih banyak foto sekaligus)</p>
          <input type="file" name="photos[]" id="multiPhotoInput" multiple accept="image/*" style="display:none" onchange="document.getElementById('photoUploadForm').submit()">
          <button type="button" class="db-btn db-btn-gold" style="font-size:.8rem" onclick="document.getElementById('multiPhotoInput').click()"><i class="fas fa-plus"></i> Tambah Foto Baru</button>
        </div>
      </form>

      <!-- GRID PRATINJAU FOTO ALBUM -->
      <h4 style="font-size:.82rem;letter-spacing:.1em;text-transform:uppercase;color:var(--text-muted);margin-bottom:.8rem">Foto di Dalam Album Ini</h4>
      <div id="photoModalGrid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(110px,1fr));gap:.8rem;max-height:240px;overflow-y:auto;padding-right:.4rem">
        <!-- Photo thumbnails will be injected via JS -->
      </div>

      <div style="display:flex;justify-content:flex-end;margin-top:1.5rem">
        <button type="button" class="db-btn db-btn-ghost" onclick="closePhotoModal()">Selesai</button>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function openCreateAlbumModal() {
    document.getElementById('albumModalTitle').innerHTML = '<i class="fas fa-images" style="color:var(--gold);margin-right:.5rem"></i> Tambah Album Kegiatan';
    document.getElementById('albumForm').action = "{{ route('admin.gallery.store') }}";
    document.getElementById('albumFormMethod').innerHTML = '';
    document.getElementById('albumForm').reset();
    document.getElementById('albumModal').style.display = 'flex';
  }

  function openEditAlbumModal(album) {
    document.getElementById('albumModalTitle').innerHTML = '<i class="fas fa-pen-to-square" style="color:var(--gold);margin-right:.5rem"></i> Edit Album Kegiatan';
    document.getElementById('albumForm').action = "{{ url('admin/gallery') }}/" + album.id;
    document.getElementById('albumFormMethod').innerHTML = '<input type="hidden" name="_method" value="PUT">';
    document.getElementById('albumTitle').value = album.title || album.name || '';
    document.getElementById('albumCategory').value = album.category || 'Kegiatan Sekolah';

    if (album.event_date) {
      const d = new Date(album.event_date);
      if (!isNaN(d.getTime())) {
        document.getElementById('albumDate').value = d.toISOString().split('T')[0];
      } else {
        document.getElementById('albumDate').value = album.event_date;
      }
    } else {
      document.getElementById('albumDate').value = '';
    }

    document.getElementById('albumDesc').value = album.description || '';
    document.getElementById('albumModal').style.display = 'flex';
  }

  function closeAlbumModal() {
    document.getElementById('albumModal').style.display = 'none';
  }

  function deleteAlbum(id) {
    if (confirm('Apakah Anda yakin ingin menghapus album kegiatan ini beserta seluruh foto di dalamnya?')) {
      const form = document.getElementById('deleteAlbumForm');
      form.action = "{{ url('admin/gallery') }}/" + id;
      form.submit();
    }
  }

  function openPhotoManagerModal(album) {
    document.getElementById('photoModalAlbumTitle').innerHTML = '<i class="fas fa-photo-film" style="color:var(--gold);margin-right:.5rem"></i> Kelola Foto: ' + (album.title || 'Album Kegiatan');
    document.getElementById('photoUploadForm').action = "{{ url('admin/gallery') }}/" + album.id + "/photos";
    
    const grid = document.getElementById('photoModalGrid');
    grid.innerHTML = '';

    const photos = album.photos || [];
    if (photos.length > 0) {
      photos.forEach(photo => {
        const photoUrl = photo.photo_url.startsWith('http') ? photo.photo_url : "{{ asset('') }}" + photo.photo_url;
        grid.innerHTML += `
          <div style="position:relative;aspect-ratio:1;border-radius:12px;overflow:hidden;border:1px solid rgba(255,255,255,.15)">
            <img src="${photoUrl}" style="width:100%;height:100%;object-fit:cover" onerror="this.src='{{ asset('images/logo_smkn2.png') }}'">
            <button type="button" onclick="deletePhoto('${photo.id}')" title="Hapus foto" style="position:absolute;top:5px;right:5px;width:24px;height:24px;border-radius:50%;background:rgba(226,75,74,.9);color:#fff;border:0;font-size:.7rem;cursor:pointer;display:grid;place-items:center">&times;</button>
          </div>
        `;
      });
    } else {
      grid.innerHTML = `
        <div style="grid-column:1/-1;text-align:center;padding:1.5rem;color:var(--text-muted);font-size:.8rem">
          Belum ada foto tambahan di album ini. Upload foto menggunakan tombol di atas.
        </div>
      `;
    }

    document.getElementById('photoModal').style.display = 'flex';
  }

  function closePhotoModal() {
    document.getElementById('photoModal').style.display = 'none';
  }

  function deletePhoto(photoId) {
    if (confirm('Apakah Anda yakin ingin menghapus foto ini dari album?')) {
      const form = document.getElementById('deletePhotoForm');
      form.action = "{{ url('admin/gallery/photos') }}/" + photoId;
      form.submit();
    }
  }

  function filterAdminAlbums() {
    const query = (document.getElementById('albumSearchInput').value || '').toLowerCase().trim();
    const category = (document.getElementById('albumCategoryFilter').value || '').toLowerCase().trim();
    const rows = document.querySelectorAll('#albumTableBody tr');

    rows.forEach(row => {
      if (row.cells.length <= 1) return;

      const titleText = (row.getAttribute('data-title') || '').toLowerCase();
      const categoryText = (row.getAttribute('data-category') || '').toLowerCase();

      const matchesQuery = !query || titleText.includes(query);
      const matchesCategory = !category || categoryText.includes(category);

      if (matchesQuery && matchesCategory) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }
</script>
@endpush
