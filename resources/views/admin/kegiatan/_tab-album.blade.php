{{-- Tab Album Kegiatan. Variabel: $albums, $categories --}}
<div class="db-panel">
  <div class="db-panel-head">
    <h2 style="font-size:.9rem">Album Kegiatan ({{ $albums->count() }})</h2>
    <span style="font-size:.72rem;color:var(--text-muted)">Urutan di sini = urutan kartu di galeri "Jejak Kegiatan". Satu album = satu kartu + popup foto.</span>
  </div>

  <div class="kd-filterbar">
    <input type="text" id="kdSearch" class="db-form-control" placeholder="Cari judul album...">
    <select id="kdCatFilter" class="db-form-control" style="max-width:240px">
      <option value="">Semua kategori</option>
      @foreach($categories as $c)
        <option value="{{ $c->key }}">{{ $c->label }}</option>
      @endforeach
      <option value="__none">Tanpa kategori</option>
    </select>
  </div>

  <div class="kd-list" id="kdList">
    @forelse($albums as $a)
      @php
        $catLabel = optional($categories->firstWhere('key', $a->category_key))->label;
        $extra = $a->photos->map(fn ($p) => ['id' => $p->id, 'url' => $p->url])->values();
      @endphp
      <div class="kd-item {{ $a->is_active ? '' : 'off' }}"
           data-title="{{ \Illuminate\Support\Str::lower($a->title) }}"
           data-cat="{{ $a->category_key ?: '__none' }}">
        <span class="kd-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

        <span class="kd-thumb"><img src="{{ $a->cover_url }}" alt="" loading="lazy"></span>

        <div class="kd-body">
          <strong title="{{ $a->title }}">{{ $a->title }}</strong>
          <small>
            {{ $catLabel ?: 'Tanpa kategori' }}@if($a->date_label) · {{ $a->date_label }}@endif
            · {{ $a->photos->count() + 1 }} foto
            @unless($a->is_active)<span class="kd-badge">Disembunyikan</span>@endunless
            @unless($a->show_in_gallery)<span class="kd-badge">Hanya Sorotan</span>@endunless
          </small>
        </div>

        <div class="kd-row-actions">
          <form action="{{ route('admin.kegiatan.albums.move', [$a, 'up']) }}" method="POST" class="kd-inline">
            @csrf
            <button type="submit" class="kd-mini" title="Naikkan" @disabled($loop->first)><i class="fas fa-arrow-up"></i></button>
          </form>
          <form action="{{ route('admin.kegiatan.albums.move', [$a, 'down']) }}" method="POST" class="kd-inline">
            @csrf
            <button type="submit" class="kd-mini" title="Turunkan" @disabled($loop->last)><i class="fas fa-arrow-down"></i></button>
          </form>
          <form action="{{ route('admin.kegiatan.albums.toggle', $a) }}" method="POST" class="kd-inline">
            @csrf
            <button type="submit" class="kd-mini" title="{{ $a->is_active ? 'Sembunyikan' : 'Tampilkan' }}">
              <i class="fas {{ $a->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
            </button>
          </form>
          <button type="button" class="kd-mini" title="Edit"
                  data-kd-edit
                  data-url="{{ route('admin.kegiatan.albums.update', $a) }}"
                  data-title="{{ $a->title }}"
                  data-category="{{ $a->category_key }}"
                  data-date="{{ $a->date_label }}"
                  data-desc="{{ $a->description }}"
                  data-size="{{ $a->size ?: 'auto' }}"
                  data-cover="{{ $a->cover_url }}"
                  data-has-upload="{{ $a->hasUploadedCover() ? '1' : '0' }}"
                  data-gallery="{{ $a->show_in_gallery ? '1' : '0' }}"
                  data-active="{{ $a->is_active ? '1' : '0' }}"
                  data-photos="{{ json_encode($extra, JSON_UNESCAPED_SLASHES) }}">
            <i class="fas fa-pen"></i>
          </button>
          <form action="{{ route('admin.kegiatan.albums.destroy', $a) }}" method="POST" class="kd-inline"
                onsubmit="return confirm('Hapus album ini beserta semua fotonya? Penempatannya di Sorotan juga ikut terhapus.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="kd-mini danger" title="Hapus"><i class="fas fa-trash"></i></button>
          </form>
        </div>
      </div>
    @empty
      <div class="kd-empty">Belum ada album.</div>
    @endforelse
  </div>
  <div class="kd-empty" id="kdNoMatch" style="display:none">Tidak ada album yang cocok dengan pencarian.</div>

  <button type="button" class="kd-add" id="kdAddBtn"><i class="fas fa-plus"></i> Tambah Album</button>
</div>

{{-- ================= MODAL TAMBAH / EDIT ================= --}}
<div class="kd-modal" id="kdModal" aria-hidden="true">
  <div class="kd-modal-box">
    <h3 id="kdModalTitle">Tambah Album</h3>

    <form id="kdForm" method="POST" action="{{ route('admin.kegiatan.albums.store') }}" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="_method" value="PUT" id="kdMethod" disabled>

      <div class="db-form-group">
        <label>Judul kegiatan</label>
        <input type="text" name="title" id="kdTitle" class="db-form-control" maxlength="255" required>
      </div>

      <div class="kd-grid-2">
        <div class="db-form-group">
          <label>Kategori</label>
          <select name="category_key" id="kdCategory" class="db-form-control">
            <option value="">— Tanpa kategori —</option>
            @foreach($categories as $c)
              <option value="{{ $c->key }}">{{ $c->label }}</option>
            @endforeach
          </select>
        </div>
        <div class="db-form-group">
          <label>Label tanggal</label>
          <input type="text" name="date_label" id="kdDate" class="db-form-control" maxlength="120" placeholder="2026">
          <div class="kd-hint">Teks bebas — boleh "2026", "25 Desember 2025", atau dikosongkan.</div>
        </div>
      </div>

      <div class="db-form-group">
        <label>Keterangan (di popup album)</label>
        <textarea name="description" id="kdDesc" class="db-form-control" rows="2" maxlength="2000"></textarea>
        <div class="kd-hint">Kosong = memakai judul kegiatan sebagai keterangan foto.</div>
      </div>

      <div class="db-form-group">
        <label>Foto sampul (tampil di kartu galeri)</label>
        <div class="kd-photo-edit">
          <div class="kd-photo-preview"><img id="kdCoverPreview" src="" alt=""></div>
          <div class="kd-photo-fields">
            <input type="file" name="photo" id="kdCover" class="db-form-control" accept="image/png,image/jpeg,image/webp">
            <div class="kd-hint">JPG / PNG / WEBP, maksimal 4 MB. Kosong = logo sekolah.</div>
            <label class="kd-check" id="kdRemoveWrap" style="display:none">
              <input type="checkbox" name="remove_photo" value="1" id="kdRemoveCover"> Hapus foto sampul yang diupload (kembali ke logo sekolah)
            </label>
          </div>
        </div>
      </div>

      <div class="db-form-group">
        <label>Foto tambahan album (opsional)</label>
        <div class="kd-gallery" id="kdExisting"></div>
        <div class="kd-hint" id="kdExistingHint" style="display:none;margin:-.2rem 0 .6rem">Klik foto untuk menandainya dihapus (tanda merah), lalu Simpan.</div>
        <input type="file" name="photos[]" id="kdPhotos" class="db-form-control" accept="image/png,image/jpeg,image/webp" multiple>
        <div class="kd-hint">Bisa pilih banyak foto sekaligus (maks. 20 per upload, 4 MB per foto). Foto-foto ini muncul saat kartu diklik, setelah foto sampul.</div>
        <div class="kd-newprev" id="kdNewPrev"></div>
      </div>

      <div class="db-form-group">
        <label>Ukuran kartu di galeri</label>
        <select name="size" id="kdSize" class="db-form-control">
          @foreach(\App\Models\KegiatanAlbum::SIZES as $value => $text)
            <option value="{{ $value }}">{{ $text }}</option>
          @endforeach
        </select>
        <div class="kd-hint">Hanya berlaku di tampilan "Semua". Saat kategori dipilih, semua kartu otomatis seragam.</div>
      </div>

      <label class="kd-check">
        <input type="checkbox" name="show_in_gallery" value="1" id="kdGallery" checked>
        Tampilkan di galeri "Jejak Kegiatan"
      </label>
      <div class="kd-hint" style="margin:-.1rem 0 .3rem 1.6rem">Matikan jika album ini hanya dipakai di bagian Sorotan.</div>
      <label class="kd-check">
        <input type="checkbox" name="is_active" value="1" id="kdActive" checked>
        Aktif (tampil di halaman publik)
      </label>

      <div class="kd-actions" style="justify-content:space-between">
        <button type="button" class="kd-btn-ghost" id="kdCancel">Batal</button>
        <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
(function () {
  var modal   = document.getElementById('kdModal');
  var form    = document.getElementById('kdForm');
  var method  = document.getElementById('kdMethod');
  var heading = document.getElementById('kdModalTitle');
  var storeUrl = form.getAttribute('action');
  var fallback = {{ \Illuminate\Support\Js::from(asset(\App\Support\KegiatanMedia::FALLBACK)) }};

  var f = {
    title: document.getElementById('kdTitle'),
    category: document.getElementById('kdCategory'),
    date: document.getElementById('kdDate'),
    desc: document.getElementById('kdDesc'),
    cover: document.getElementById('kdCover'),
    size: document.getElementById('kdSize'),
    gallery: document.getElementById('kdGallery'),
    active: document.getElementById('kdActive'),
    removeCover: document.getElementById('kdRemoveCover'),
    photos: document.getElementById('kdPhotos')
  };
  var coverPreview = document.getElementById('kdCoverPreview');
  var removeWrap = document.getElementById('kdRemoveWrap');
  var existing = document.getElementById('kdExisting');
  var existingHint = document.getElementById('kdExistingHint');
  var newPrev = document.getElementById('kdNewPrev');

  function renderExisting(list) {
    existing.innerHTML = '';
    existingHint.style.display = list.length ? 'block' : 'none';
    list.forEach(function (p) {
      var label = document.createElement('label');
      label.className = 'kd-gal-item';
      var cb = document.createElement('input');
      cb.type = 'checkbox'; cb.name = 'remove_photos[]'; cb.value = p.id;
      var img = document.createElement('img');
      img.src = p.url; img.alt = ''; img.loading = 'lazy';
      var x = document.createElement('span');
      x.className = 'kd-gal-x'; x.innerHTML = '<i class="fas fa-xmark"></i>';
      label.appendChild(img); label.appendChild(x); label.appendChild(cb);
      cb.addEventListener('change', function () { label.classList.toggle('marked', cb.checked); });
      existing.appendChild(label);
    });
  }

  function openModal(btn) {
    f.cover.value = '';
    f.photos.value = '';
    f.removeCover.checked = false;
    newPrev.innerHTML = '';

    if (btn) {
      form.setAttribute('action', btn.getAttribute('data-url'));
      method.disabled = false;
      heading.textContent = 'Edit Album';
      f.title.value = btn.getAttribute('data-title') || '';
      f.category.value = btn.getAttribute('data-category') || '';
      f.date.value = btn.getAttribute('data-date') || '';
      f.desc.value = btn.getAttribute('data-desc') || '';
      f.size.value = btn.getAttribute('data-size') || 'auto';
      f.gallery.checked = btn.getAttribute('data-gallery') === '1';
      f.active.checked = btn.getAttribute('data-active') === '1';
      coverPreview.src = btn.getAttribute('data-cover') || fallback;
      removeWrap.style.display = btn.getAttribute('data-has-upload') === '1' ? 'flex' : 'none';
      var list = [];
      try { list = JSON.parse(btn.getAttribute('data-photos') || '[]'); } catch (e) {}
      renderExisting(list);
    } else {
      form.setAttribute('action', storeUrl);
      method.disabled = true;
      heading.textContent = 'Tambah Album';
      f.title.value = '';
      f.category.value = '';
      f.date.value = '';
      f.desc.value = '';
      f.size.value = 'auto';
      f.gallery.checked = true;
      f.active.checked = true;
      coverPreview.src = fallback;
      removeWrap.style.display = 'none';
      renderExisting([]);
    }

    modal.classList.add('show');
    modal.setAttribute('aria-hidden', 'false');
    setTimeout(function () { f.title.focus(); }, 30);
  }

  function closeModal() {
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
  }

  f.cover.addEventListener('change', function () {
    var file = f.cover.files && f.cover.files[0];
    if (file) { coverPreview.src = URL.createObjectURL(file); f.removeCover.checked = false; }
  });

  f.photos.addEventListener('change', function () {
    newPrev.innerHTML = '';
    Array.prototype.slice.call(f.photos.files || [], 0, 20).forEach(function (file) {
      var img = document.createElement('img');
      img.src = URL.createObjectURL(file);
      img.alt = '';
      newPrev.appendChild(img);
    });
  });

  document.getElementById('kdAddBtn').addEventListener('click', function () { openModal(null); });
  document.querySelectorAll('[data-kd-edit]').forEach(function (btn) {
    btn.addEventListener('click', function () { openModal(btn); });
  });
  document.getElementById('kdCancel').addEventListener('click', closeModal);
  modal.addEventListener('mousedown', function (e) { if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });

  /* ---------- cari & saring daftar ---------- */
  var search = document.getElementById('kdSearch');
  var catFilter = document.getElementById('kdCatFilter');
  var items = document.querySelectorAll('#kdList .kd-item');
  var noMatch = document.getElementById('kdNoMatch');

  function applyFilter() {
    var q = (search.value || '').toLowerCase().trim();
    var c = catFilter.value;
    var shown = 0;
    items.forEach(function (el) {
      var ok = (!q || (el.getAttribute('data-title') || '').indexOf(q) !== -1) &&
               (!c || el.getAttribute('data-cat') === c);
      el.style.display = ok ? '' : 'none';
      if (ok) shown++;
    });
    noMatch.style.display = (items.length && !shown) ? 'block' : 'none';
  }
  search.addEventListener('input', applyFilter);
  catFilter.addEventListener('change', applyFilter);
})();
</script>
@endpush
