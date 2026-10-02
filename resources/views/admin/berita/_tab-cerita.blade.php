{{-- Tab Cerita Skaneda. Variabel: $stories, $categories --}}
<div class="db-panel">
  <div class="db-panel-head">
    <h2 style="font-size:.9rem">Cerita Skaneda ({{ $stories->count() }})</h2>
    <span style="font-size:.72rem;color:var(--text-muted)">Long-read feature, maksimal cocok untuk 3 kartu di halaman publik</span>
  </div>

  <div class="bn-list">
    @forelse($stories as $st)
      <div class="bn-item {{ $st->is_active ? '' : 'off' }}">
        <span class="bn-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

        <div class="bn-body">
          <strong>
            {{ $st->title }}
            @unless($st->is_active)<span class="bn-badge">Disembunyikan</span>@endunless
          </strong>
          <small>
            @php $catLabel = optional($categories->firstWhere('key', $st->category_key))->label; @endphp
            {{ $catLabel ?: 'Tanpa kategori' }}@if($st->teaser) · {{ \Illuminate\Support\Str::limit($st->teaser, 60) }}@endif
          </small>
        </div>

        <div class="bn-row-actions">
          <form action="{{ route('admin.berita.stories.move', [$st, 'up']) }}" method="POST" class="bn-inline">
            @csrf
            <button type="submit" class="bn-mini" title="Naikkan" @disabled($loop->first)><i class="fas fa-arrow-up"></i></button>
          </form>
          <form action="{{ route('admin.berita.stories.move', [$st, 'down']) }}" method="POST" class="bn-inline">
            @csrf
            <button type="submit" class="bn-mini" title="Turunkan" @disabled($loop->last)><i class="fas fa-arrow-down"></i></button>
          </form>
          <form action="{{ route('admin.berita.stories.toggle', $st) }}" method="POST" class="bn-inline">
            @csrf
            <button type="submit" class="bn-mini" title="{{ $st->is_active ? 'Sembunyikan' : 'Tampilkan' }}">
              <i class="fas {{ $st->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
            </button>
          </form>
          <button type="button" class="bn-mini" title="Edit"
                  data-bs-edit
                  data-url="{{ route('admin.berita.stories.update', $st) }}"
                  data-category="{{ $st->category_key }}"
                  data-title="{{ $st->title }}"
                  data-teaser="{{ $st->teaser }}"
                  data-content="{{ $st->content }}"
                  data-active="{{ $st->is_active ? '1' : '0' }}">
            <i class="fas fa-pen"></i>
          </button>
          <form action="{{ route('admin.berita.stories.destroy', $st) }}" method="POST" class="bn-inline"
                onsubmit="return confirm('Hapus cerita ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bn-mini danger" title="Hapus"><i class="fas fa-trash"></i></button>
          </form>
        </div>
      </div>
    @empty
      <div class="bn-empty">Belum ada Cerita Skaneda.</div>
    @endforelse
  </div>

  <button type="button" class="bn-add" id="bsAddBtn"><i class="fas fa-plus"></i> Tambah Cerita</button>
</div>

<div class="bn-modal" id="bsModal" aria-hidden="true">
  <div class="bn-modal-box">
    <h3 id="bsModalTitle">Tambah Cerita</h3>

    <form id="bsForm" method="POST" action="{{ route('admin.berita.stories.store') }}">
      @csrf
      <input type="hidden" name="_method" value="PUT" id="bsMethod" disabled>

      <div class="bn-grid-2">
        <div class="db-form-group">
          <label>Kategori (label di kartu &amp; popup)</label>
          <select name="category_key" id="bsCategory" class="db-form-control">
            <option value="">— Tanpa kategori —</option>
            @foreach($categories as $c)
              <option value="{{ $c->key }}">{{ $c->label }}</option>
            @endforeach
          </select>
        </div>
        <div class="db-form-group">
          <label>Judul</label>
          <input type="text" name="title" id="bsTitle" class="db-form-control" maxlength="255" required>
        </div>
      </div>

      <div class="db-form-group">
        <label>Teaser (1-2 kalimat di kartu)</label>
        <textarea name="teaser" id="bsTeaser" class="db-form-control" rows="2" maxlength="500"></textarea>
      </div>

      <div class="db-form-group">
        <label>Isi lengkap (di popup)</label>
        <textarea name="content" id="bsContent" class="db-form-control" rows="6" maxlength="6000" placeholder="Satu paragraf per baris"></textarea>
        <div class="bn-hint">Tulis satu paragraf per baris. Isi ini biasanya lebih panjang dan naratif dibanding berita biasa.</div>
      </div>

      <label class="bn-check">
        <input type="checkbox" name="is_active" value="1" id="bsActive" checked>
        Tampilkan di halaman publik
      </label>

      <div class="bn-actions" style="justify-content:space-between">
        <button type="button" class="bn-btn-ghost" id="bsCancel">Batal</button>
        <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
(function () {
  var modal   = document.getElementById('bsModal');
  var form    = document.getElementById('bsForm');
  var method  = document.getElementById('bsMethod');
  var heading = document.getElementById('bsModalTitle');
  var storeUrl = form.getAttribute('action');

  var f = {
    category: document.getElementById('bsCategory'),
    title: document.getElementById('bsTitle'),
    teaser: document.getElementById('bsTeaser'),
    content: document.getElementById('bsContent'),
    active: document.getElementById('bsActive')
  };

  function openModal(btn) {
    if (btn) {
      form.setAttribute('action', btn.getAttribute('data-url'));
      method.disabled = false;
      heading.textContent = 'Edit Cerita';
      f.category.value = btn.getAttribute('data-category') || '';
      f.title.value = btn.getAttribute('data-title') || '';
      f.teaser.value = btn.getAttribute('data-teaser') || '';
      f.content.value = btn.getAttribute('data-content') || '';
      f.active.checked = btn.getAttribute('data-active') === '1';
    } else {
      form.setAttribute('action', storeUrl);
      method.disabled = true;
      heading.textContent = 'Tambah Cerita';
      f.category.value = '';
      f.title.value = '';
      f.teaser.value = '';
      f.content.value = '';
      f.active.checked = true;
    }
    modal.classList.add('show');
    modal.setAttribute('aria-hidden', 'false');
    setTimeout(function () { f.title.focus(); }, 30);
  }

  function closeModal() {
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
  }

  document.getElementById('bsAddBtn').addEventListener('click', function () { openModal(null); });
  document.querySelectorAll('[data-bs-edit]').forEach(function (btn) {
    btn.addEventListener('click', function () { openModal(btn); });
  });
  document.getElementById('bsCancel').addEventListener('click', closeModal);
  modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });
})();
</script>
@endpush
