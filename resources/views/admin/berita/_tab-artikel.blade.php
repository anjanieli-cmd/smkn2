{{-- Tab Daftar Berita. Variabel: $articles, $categories --}}
<div class="db-panel">
  <div class="db-panel-head">
    <h2 style="font-size:.9rem">Daftar Berita ({{ $articles->count() }})</h2>
    <span style="font-size:.72rem;color:var(--text-muted)">Urutan di sini = urutan di "Berita Terbaru". 10 teratas yang bertanda "Awal" tampil sebelum tombol Lihat Semua ditekan.</span>
  </div>

  <div class="bn-list">
    @forelse($articles as $a)
      <div class="bn-item {{ $a->is_active ? '' : 'off' }}">
        <span class="bn-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

        <span class="bn-thumb"><img src="{{ $a->photo_url }}" alt="" loading="lazy"></span>

        <div class="bn-body">
          <strong title="{{ $a->title }}">
            {{ $a->title }}
          </strong>
          <small>
            @php $catLabel = optional($categories->firstWhere('key', $a->category_key))->label; @endphp
            {{ $catLabel ?: 'Tanpa kategori' }}@if($a->date_label) · {{ $a->date_label }}@endif
            @unless($a->is_active)<span class="bn-badge">Disembunyikan</span>@endunless
            @if($a->show_in_initial_ten)<span class="bn-badge">Awal</span>@endif
          </small>
        </div>

        <div class="bn-row-actions">
          <form action="{{ route('admin.berita.articles.move', [$a, 'up']) }}" method="POST" class="bn-inline">
            @csrf
            <button type="submit" class="bn-mini" title="Naikkan" @disabled($loop->first)><i class="fas fa-arrow-up"></i></button>
          </form>
          <form action="{{ route('admin.berita.articles.move', [$a, 'down']) }}" method="POST" class="bn-inline">
            @csrf
            <button type="submit" class="bn-mini" title="Turunkan" @disabled($loop->last)><i class="fas fa-arrow-down"></i></button>
          </form>
          <form action="{{ route('admin.berita.articles.toggle', $a) }}" method="POST" class="bn-inline">
            @csrf
            <button type="submit" class="bn-mini" title="{{ $a->is_active ? 'Sembunyikan' : 'Tampilkan' }}">
              <i class="fas {{ $a->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
            </button>
          </form>
          <button type="button" class="bn-mini" title="Edit"
                  data-bn-edit
                  data-url="{{ route('admin.berita.articles.update', $a) }}"
                  data-title="{{ $a->title }}"
                  data-category="{{ $a->category_key }}"
                  data-date="{{ $a->date_label }}"
                  data-excerpt="{{ $a->excerpt }}"
                  data-content="{{ $a->content }}"
                  data-photo="{{ $a->photo_url }}"
                  data-has-upload="{{ $a->hasUploadedPhoto() ? '1' : '0' }}"
                  data-initial="{{ $a->show_in_initial_ten ? '1' : '0' }}"
                  data-active="{{ $a->is_active ? '1' : '0' }}">
            <i class="fas fa-pen"></i>
          </button>
          <form action="{{ route('admin.berita.articles.destroy', $a) }}" method="POST" class="bn-inline"
                onsubmit="return confirm('Hapus berita ini? Penempatannya (featured/samping/pilihan) juga ikut terhapus.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bn-mini danger" title="Hapus"><i class="fas fa-trash"></i></button>
          </form>
        </div>
      </div>
    @empty
      <div class="bn-empty">Belum ada berita.</div>
    @endforelse
  </div>

  <button type="button" class="bn-add" id="bnAddBtn"><i class="fas fa-plus"></i> Tambah Berita</button>
</div>

{{-- ================= MODAL TAMBAH / EDIT ================= --}}
<div class="bn-modal" id="bnModal" aria-hidden="true">
  <div class="bn-modal-box">
    <h3 id="bnModalTitle">Tambah Berita</h3>

    <form id="bnForm" method="POST" action="{{ route('admin.berita.articles.store') }}" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="_method" value="PUT" id="bnMethod" disabled>

      <div class="db-form-group">
        <label>Judul</label>
        <input type="text" name="title" id="bnTitle" class="db-form-control" maxlength="255" required>
      </div>

      <div class="bn-grid-2">
        <div class="db-form-group">
          <label>Kategori</label>
          <select name="category_key" id="bnCategory" class="db-form-control">
            <option value="">— Tanpa kategori —</option>
            @foreach($categories as $c)
              <option value="{{ $c->key }}">{{ $c->label }}</option>
            @endforeach
          </select>
        </div>
        <div class="db-form-group">
          <label>Label tanggal</label>
          <input type="text" name="date_label" id="bnDate" class="db-form-control" maxlength="120" placeholder="23 Juli 2025">
          <div class="bn-hint">Teks bebas — boleh "September 2024", "Program budaya", atau dikosongkan.</div>
        </div>
      </div>

      <div class="db-form-group">
        <label>Ringkasan singkat (di kartu)</label>
        <textarea name="excerpt" id="bnExcerpt" class="db-form-control" rows="2" maxlength="1000"></textarea>
      </div>

      <div class="db-form-group">
        <label>Isi lengkap (di popup "Baca Kisahnya")</label>
        <textarea name="content" id="bnContent" class="db-form-control" rows="6" maxlength="8000" placeholder="Satu paragraf per baris"></textarea>
        <div class="bn-hint">Tulis satu paragraf per baris.</div>
      </div>

      <div class="db-form-group">
        <label>Foto</label>
        <div class="bn-photo-edit">
          <div class="bn-photo-preview"><img id="bnPhotoPreview" src="" alt=""></div>
          <div class="bn-photo-fields">
            <input type="file" name="photo" id="bnPhoto" class="db-form-control" accept="image/png,image/jpeg,image/webp">
            <div class="bn-hint">JPG / PNG / WEBP, maksimal 4 MB. Disarankan foto mendatar. Kosong = logo sekolah.</div>
            <label class="bn-check" id="bnRemoveWrap" style="display:none">
              <input type="checkbox" name="remove_photo" value="1" id="bnRemovePhoto"> Hapus foto yang diupload (kembali ke logo sekolah)
            </label>
          </div>
        </div>
      </div>

      <label class="bn-check">
        <input type="checkbox" name="show_in_initial_ten" value="1" id="bnInitial" checked>
        Tampilkan sebelum tombol "Lihat Semua" ditekan
      </label>
      <label class="bn-check">
        <input type="checkbox" name="is_active" value="1" id="bnActive" checked>
        Tampilkan di halaman publik
      </label>

      <div class="bn-actions" style="justify-content:space-between">
        <button type="button" class="bn-btn-ghost" id="bnCancel">Batal</button>
        <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
(function () {
  var modal   = document.getElementById('bnModal');
  var form    = document.getElementById('bnForm');
  var method  = document.getElementById('bnMethod');
  var heading = document.getElementById('bnModalTitle');
  var storeUrl = form.getAttribute('action');
  var fallback = {{ \Illuminate\Support\Js::from(asset(\App\Models\BeritaArticle::FALLBACK_PHOTO)) }};

  var f = {
    title: document.getElementById('bnTitle'),
    category: document.getElementById('bnCategory'),
    date: document.getElementById('bnDate'),
    excerpt: document.getElementById('bnExcerpt'),
    content: document.getElementById('bnContent'),
    photo: document.getElementById('bnPhoto'),
    initial: document.getElementById('bnInitial'),
    active: document.getElementById('bnActive'),
    remove: document.getElementById('bnRemovePhoto')
  };
  var photoPreview = document.getElementById('bnPhotoPreview');
  var removeWrap = document.getElementById('bnRemoveWrap');

  function openModal(btn) {
    f.photo.value = '';
    f.remove.checked = false;

    if (btn) {
      form.setAttribute('action', btn.getAttribute('data-url'));
      method.disabled = false;
      heading.textContent = 'Edit Berita';
      f.title.value = btn.getAttribute('data-title') || '';
      f.category.value = btn.getAttribute('data-category') || '';
      f.date.value = btn.getAttribute('data-date') || '';
      f.excerpt.value = btn.getAttribute('data-excerpt') || '';
      f.content.value = btn.getAttribute('data-content') || '';
      f.initial.checked = btn.getAttribute('data-initial') === '1';
      f.active.checked = btn.getAttribute('data-active') === '1';
      photoPreview.src = btn.getAttribute('data-photo') || fallback;
      removeWrap.style.display = btn.getAttribute('data-has-upload') === '1' ? 'flex' : 'none';
    } else {
      form.setAttribute('action', storeUrl);
      method.disabled = true;
      heading.textContent = 'Tambah Berita';
      f.title.value = '';
      f.category.value = '';
      f.date.value = '';
      f.excerpt.value = '';
      f.content.value = '';
      f.initial.checked = true;
      f.active.checked = true;
      photoPreview.src = fallback;
      removeWrap.style.display = 'none';
    }

    modal.classList.add('show');
    modal.setAttribute('aria-hidden', 'false');
    setTimeout(function () { f.title.focus(); }, 30);
  }

  function closeModal() {
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
  }

  f.photo.addEventListener('change', function () {
    var file = f.photo.files && f.photo.files[0];
    if (file) { photoPreview.src = URL.createObjectURL(file); f.remove.checked = false; }
  });

  document.getElementById('bnAddBtn').addEventListener('click', function () { openModal(null); });
  document.querySelectorAll('[data-bn-edit]').forEach(function (btn) {
    btn.addEventListener('click', function () { openModal(btn); });
  });
  document.getElementById('bnCancel').addEventListener('click', closeModal);
  modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });
})();
</script>
@endpush
