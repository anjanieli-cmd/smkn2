{{-- Tab Daftar Karya. Variabel: $works, $categories --}}
<div class="db-panel">
  <div class="db-panel-head">
    <h2 style="font-size:.9rem">Daftar Karya ({{ $works->count() }})</h2>
    <span style="font-size:.72rem;color:var(--text-muted)">Satu karya bisa tampil di Slider "Galeri karya pilihan" dan/atau kartu "Produk nyata". Urutan di sini = urutan tampil.</span>
  </div>

  <div class="kr-filterbar">
    <input type="text" id="krSearch" class="db-form-control" placeholder="Cari judul karya...">
    <select id="krCatFilter" class="db-form-control" style="max-width:220px">
      <option value="">Semua bidang</option>
      @foreach($categories as $c)
        <option value="{{ $c->key }}">{{ $c->label }}</option>
      @endforeach
      <option value="__none">Tanpa kategori</option>
    </select>
    <select id="krPlaceFilter" class="db-form-control" style="max-width:220px">
      <option value="">Semua penempatan</option>
      <option value="slider">Tampil di Slider</option>
      <option value="products">Tampil di Produk</option>
      <option value="none">Tidak tampil di mana pun</option>
    </select>
  </div>

  <div class="kr-list" id="krList">
    @forelse($works as $w)
      @php
        $cat = $categories->firstWhere('key', $w->category_key);
        $place = ($w->show_in_slider ? 'slider ' : '') . ($w->show_in_products ? 'products ' : '');
      @endphp
      <div class="kr-item {{ $w->is_active ? '' : 'off' }}"
           data-title="{{ \Illuminate\Support\Str::lower($w->title) }}"
           data-cat="{{ $w->category_key ?: '__none' }}"
           data-place="{{ trim($place) ?: 'none' }}">
        <span class="kr-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

        <span class="kr-thumb"><img src="{{ $w->cover_url }}" alt="" loading="lazy"></span>

        <div class="kr-body">
          <strong title="{{ $w->title }}">{{ $w->title }}</strong>
          <small>
            {{ $cat ? $cat->label : 'Tanpa kategori' }}
            @if($w->major_short || $w->major_label) · {{ $w->major_short ?: $w->major_label }}@endif
            @if($w->year_label) · {{ $w->year_label }}@endif
            @if($w->show_in_slider)<span class="kr-badge blue">Slider</span>@endif
            @if($w->show_in_products)<span class="kr-badge">Produk</span>@endif
            @unless($w->show_in_slider || $w->show_in_products)<span class="kr-badge">Tidak tampil</span>@endunless
            @unless($w->is_active)<span class="kr-badge">Disembunyikan</span>@endunless
          </small>
        </div>

        <div class="kr-row-actions">
          <form action="{{ route('admin.karya.works.move', [$w, 'up']) }}" method="POST" class="kr-inline">
            @csrf
            <button type="submit" class="kr-mini" title="Naikkan" @disabled($loop->first)><i class="fas fa-arrow-up"></i></button>
          </form>
          <form action="{{ route('admin.karya.works.move', [$w, 'down']) }}" method="POST" class="kr-inline">
            @csrf
            <button type="submit" class="kr-mini" title="Turunkan" @disabled($loop->last)><i class="fas fa-arrow-down"></i></button>
          </form>
          <form action="{{ route('admin.karya.works.toggle', $w) }}" method="POST" class="kr-inline">
            @csrf
            <button type="submit" class="kr-mini" title="{{ $w->is_active ? 'Sembunyikan' : 'Tampilkan' }}">
              <i class="fas {{ $w->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
            </button>
          </form>
          <button type="button" class="kr-mini" title="Edit"
                  data-kr-edit
                  data-url="{{ route('admin.karya.works.update', $w) }}"
                  data-title="{{ $w->title }}"
                  data-desc="{{ $w->description }}"
                  data-category="{{ $w->category_key }}"
                  data-tag="{{ $w->tag_label }}"
                  data-tag-icon="{{ $w->tag_icon }}"
                  data-student="{{ $w->student_label }}"
                  data-major="{{ $w->major_label }}"
                  data-major-icon="{{ $w->major_icon }}"
                  data-major-short="{{ $w->major_short }}"
                  data-year="{{ $w->year_label }}"
                  data-cover="{{ $w->cover_url }}"
                  data-has-upload="{{ $w->hasUploadedCover() ? '1' : '0' }}"
                  data-slider="{{ $w->show_in_slider ? '1' : '0' }}"
                  data-products="{{ $w->show_in_products ? '1' : '0' }}"
                  data-active="{{ $w->is_active ? '1' : '0' }}">
            <i class="fas fa-pen"></i>
          </button>
          <form action="{{ route('admin.karya.works.destroy', $w) }}" method="POST" class="kr-inline"
                onsubmit="return confirm('Hapus karya ini beserta fotonya?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="kr-mini danger" title="Hapus"><i class="fas fa-trash"></i></button>
          </form>
        </div>
      </div>
    @empty
      <div class="kr-empty">Belum ada karya.</div>
    @endforelse
  </div>
  <div class="kr-empty" id="krNoMatch" style="display:none">Tidak ada karya yang cocok dengan pencarian.</div>

  <button type="button" class="kr-add" id="krAddBtn"><i class="fas fa-plus"></i> Tambah Karya</button>
</div>

{{-- ================= MODAL TAMBAH / EDIT ================= --}}
<div class="kr-modal" id="krModal" aria-hidden="true">
  <div class="kr-modal-box">
    <h3 id="krModalTitle">Tambah Karya</h3>

    <form id="krForm" method="POST" action="{{ route('admin.karya.works.store') }}" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="_method" value="PUT" id="krMethod" disabled>

      <div class="db-form-group">
        <label>Judul karya</label>
        <input type="text" name="title" id="krTitle" class="db-form-control" maxlength="255" required>
      </div>

      <div class="db-form-group">
        <label>Deskripsi singkat</label>
        <textarea name="description" id="krDesc" class="db-form-control" rows="3" maxlength="2000"></textarea>
        <div class="kr-hint">Tampil di slider dan di kartu produk. Boleh dikosongkan.</div>
      </div>

      <div class="kr-grid-2">
        <div class="db-form-group">
          <label>Bidang / kategori</label>
          <select name="category_key" id="krCategory" class="db-form-control">
            <option value="">— Tanpa kategori —</option>
            @foreach($categories as $c)
              <option value="{{ $c->key }}">{{ $c->label }}</option>
            @endforeach
          </select>
        </div>
        <div class="db-form-group">
          <label>Tahun</label>
          <input type="text" name="year_label" id="krYear" class="db-form-control" maxlength="60" placeholder="2025">
        </div>
      </div>

      <div class="kr-sub">Label di slider &amp; ikon kartu produk</div>
      <div class="kr-grid-2">
        <div class="db-form-group">
          <label>Label (mis. Makanan, Minuman)</label>
          <input type="text" name="tag_label" id="krTag" class="db-form-control" maxlength="100">
          <div class="kr-hint">Kosong = memakai nama bidang.</div>
        </div>
        <div class="db-form-group">
          <label>Ikon label</label>
          <div class="kr-iconrow">
            <span class="kr-iconprev"><i class="fas fa-star" id="krTagIconPrev"></i></span>
            <input type="text" name="tag_icon" id="krTagIcon" class="db-form-control" maxlength="60" placeholder="fa-utensils">
          </div>
          <div class="kr-hint">Class FontAwesome. Kosong = ikon bidang.</div>
        </div>
      </div>

      <div class="kr-sub">Pembuat &amp; jurusan</div>
      <div class="db-form-group">
        <label>Nama siswa / kelas / tim</label>
        <input type="text" name="student_label" id="krStudent" class="db-form-control" maxlength="150" placeholder="Kelas XII RPL">
      </div>
      <div class="kr-grid-2">
        <div class="db-form-group">
          <label>Nama jurusan (lengkap)</label>
          <input type="text" name="major_label" id="krMajor" class="db-form-control" maxlength="150" placeholder="Rekayasa Perangkat Lunak">
        </div>
        <div class="db-form-group">
          <label>Singkatan jurusan</label>
          <input type="text" name="major_short" id="krMajorShort" class="db-form-control" maxlength="60" placeholder="RPL">
          <div class="kr-hint">Dipakai di kartu produk: "RPL · 2025". Kosong = nama lengkap.</div>
        </div>
      </div>
      <div class="db-form-group">
        <label>Ikon jurusan</label>
        <div class="kr-iconrow">
          <span class="kr-iconprev"><i class="fas fa-graduation-cap" id="krMajorIconPrev"></i></span>
          <input type="text" name="major_icon" id="krMajorIcon" class="db-form-control" maxlength="60" placeholder="fa-laptop-code">
        </div>
      </div>

      <div class="db-form-group">
        <label>Foto karya</label>
        <div class="kr-photo-edit">
          <div class="kr-photo-preview"><img id="krCoverPreview" src="" alt=""></div>
          <div class="kr-photo-fields">
            <input type="file" name="photo" id="krCover" class="db-form-control" accept="image/png,image/jpeg,image/webp">
            <div class="kr-hint">JPG / PNG / WEBP, maksimal 4 MB. Kosong = logo sekolah.</div>
            <label class="kr-check" id="krRemoveWrap" style="display:none">
              <input type="checkbox" name="remove_photo" value="1" id="krRemoveCover"> Hapus foto yang diupload (kembali ke logo sekolah)
            </label>
          </div>
        </div>
      </div>

      <div class="kr-sub">Tampil di mana</div>
      <label class="kr-check">
        <input type="checkbox" name="show_in_slider" value="1" id="krSlider" checked>
        Slider "Galeri karya pilihan"
      </label>
      <label class="kr-check">
        <input type="checkbox" name="show_in_products" value="1" id="krProducts">
        Kartu "Produk nyata, karya siswa sendiri"
      </label>
      <label class="kr-check" style="margin-top:.7rem">
        <input type="checkbox" name="is_active" value="1" id="krActive" checked>
        Aktif (tampil di halaman publik)
      </label>

      <div class="kr-actions" style="justify-content:space-between">
        <button type="button" class="kr-btn-ghost" id="krCancel">Batal</button>
        <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
(function () {
  var modal   = document.getElementById('krModal');
  var form    = document.getElementById('krForm');
  var method  = document.getElementById('krMethod');
  var heading = document.getElementById('krModalTitle');
  var storeUrl = form.getAttribute('action');
  var fallback = {{ \Illuminate\Support\Js::from(asset(\App\Support\KaryaMedia::FALLBACK)) }};

  var f = {
    title: document.getElementById('krTitle'), desc: document.getElementById('krDesc'),
    category: document.getElementById('krCategory'), year: document.getElementById('krYear'),
    tag: document.getElementById('krTag'), tagIcon: document.getElementById('krTagIcon'),
    student: document.getElementById('krStudent'), major: document.getElementById('krMajor'),
    majorShort: document.getElementById('krMajorShort'), majorIcon: document.getElementById('krMajorIcon'),
    cover: document.getElementById('krCover'), removeCover: document.getElementById('krRemoveCover'),
    slider: document.getElementById('krSlider'), products: document.getElementById('krProducts'),
    active: document.getElementById('krActive')
  };
  var coverPreview = document.getElementById('krCoverPreview');
  var removeWrap = document.getElementById('krRemoveWrap');
  var tagIconPrev = document.getElementById('krTagIconPrev');
  var majorIconPrev = document.getElementById('krMajorIconPrev');

  function previewIcon(input, el, dflt) {
    var v = (input.value || '').trim();
    el.className = 'fas ' + (/^fa-[a-z0-9-]+$/.test(v) ? v : dflt);
  }
  f.tagIcon.addEventListener('input', function () { previewIcon(f.tagIcon, tagIconPrev, 'fa-star'); });
  f.majorIcon.addEventListener('input', function () { previewIcon(f.majorIcon, majorIconPrev, 'fa-graduation-cap'); });

  function openModal(btn) {
    f.cover.value = '';
    f.removeCover.checked = false;
    var a = function (n) { return btn ? (btn.getAttribute(n) || '') : ''; };

    if (btn) {
      form.setAttribute('action', btn.getAttribute('data-url'));
      method.disabled = false;
      heading.textContent = 'Edit Karya';
    } else {
      form.setAttribute('action', storeUrl);
      method.disabled = true;
      heading.textContent = 'Tambah Karya';
    }

    f.title.value = a('data-title');
    f.desc.value = a('data-desc');
    f.category.value = a('data-category');
    f.year.value = a('data-year');
    f.tag.value = a('data-tag');
    f.tagIcon.value = a('data-tag-icon');
    f.student.value = a('data-student');
    f.major.value = a('data-major');
    f.majorShort.value = a('data-major-short');
    f.majorIcon.value = a('data-major-icon');
    f.slider.checked = btn ? a('data-slider') === '1' : true;
    f.products.checked = btn ? a('data-products') === '1' : false;
    f.active.checked = btn ? a('data-active') === '1' : true;
    coverPreview.src = (btn && a('data-cover')) || fallback;
    removeWrap.style.display = a('data-has-upload') === '1' ? 'flex' : 'none';
    previewIcon(f.tagIcon, tagIconPrev, 'fa-star');
    previewIcon(f.majorIcon, majorIconPrev, 'fa-graduation-cap');

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

  document.getElementById('krAddBtn').addEventListener('click', function () { openModal(null); });
  document.querySelectorAll('[data-kr-edit]').forEach(function (btn) {
    btn.addEventListener('click', function () { openModal(btn); });
  });
  document.getElementById('krCancel').addEventListener('click', closeModal);
  modal.addEventListener('mousedown', function (e) { if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });

  /* ---------- cari & saring daftar ---------- */
  var search = document.getElementById('krSearch');
  var catFilter = document.getElementById('krCatFilter');
  var placeFilter = document.getElementById('krPlaceFilter');
  var items = document.querySelectorAll('#krList .kr-item');
  var noMatch = document.getElementById('krNoMatch');

  function applyFilter() {
    var q = (search.value || '').toLowerCase().trim();
    var c = catFilter.value, p = placeFilter.value;
    var shown = 0;
    items.forEach(function (el) {
      var places = (el.getAttribute('data-place') || '').split(' ');
      var ok = (!q || (el.getAttribute('data-title') || '').indexOf(q) !== -1) &&
               (!c || el.getAttribute('data-cat') === c) &&
               (!p || places.indexOf(p) !== -1);
      el.style.display = ok ? '' : 'none';
      if (ok) shown++;
    });
    noMatch.style.display = (items.length && !shown) ? 'block' : 'none';
  }
  search.addEventListener('input', applyFilter);
  catFilter.addEventListener('change', applyFilter);
  placeFilter.addEventListener('change', applyFilter);
})();
</script>
@endpush
