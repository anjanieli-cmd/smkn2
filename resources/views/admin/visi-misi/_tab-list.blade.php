{{-- Tab Misi / Tujuan / Nilai. Variabel: $tab, $items, $s, $withIcon, $itemLabel, $showHeadDesc --}}

{{-- ================= JUDUL BAGIAN ================= --}}
<form action="{{ route('admin.visi-misi.settings.update', $tab) }}" method="POST" class="db-panel" style="margin-bottom:1.2rem">
  @csrf
  @method('PUT')
  <div class="db-panel-head"><h2 style="font-size:.9rem">Judul Bagian {{ $itemLabel }}</h2></div>

  <div class="db-form-group">
    <label>Label kecil di atas judul</label>
    <input type="text" name="{{ $tab }}_eyebrow" class="db-form-control" maxlength="120" value="{{ old($tab.'_eyebrow', $s[$tab.'_eyebrow']) }}">
  </div>

  <div class="vm-grid-2">
    <div class="db-form-group">
      <label>Judul (warna biru/putih)</label>
      <input type="text" name="{{ $tab }}_heading" class="db-form-control" maxlength="80" required value="{{ old($tab.'_heading', $s[$tab.'_heading']) }}">
    </div>
    <div class="db-form-group">
      <label>Lanjutan judul (emas)</label>
      <input type="text" name="{{ $tab }}_heading_gold" class="db-form-control" maxlength="80" value="{{ old($tab.'_heading_gold', $s[$tab.'_heading_gold']) }}">
    </div>
  </div>

  @if($showHeadDesc)
    <div class="db-form-group">
      <label>Paragraf pengantar</label>
      <textarea name="{{ $tab }}_desc" class="db-form-control" rows="3">{{ old($tab.'_desc', $s[$tab.'_desc']) }}</textarea>
    </div>
  @endif

  <div class="vm-actions" style="margin-top:.4rem">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Judul</button>
  </div>
</form>

{{-- ================= DAFTAR KARTU ================= --}}
<div class="db-panel">
  <div class="db-panel-head">
    <h2 style="font-size:.9rem">Daftar {{ $itemLabel }} ({{ $items->count() }})</h2>
    <span style="font-size:.72rem;color:var(--text-muted)">Nomor 01, 02, 03 dibuat otomatis mengikuti urutan</span>
  </div>

  <div class="vm-list">
    @forelse($items as $item)
      <div class="vm-item {{ $item->is_active ? '' : 'off' }}">
        <span class="vm-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

        @if($withIcon)
          <span class="vm-ico"><i class="fas {{ $item->icon ?: 'fa-star' }}"></i></span>
        @endif

        <div class="vm-body">
          <strong>
            {{ $item->title }}
            @unless($item->is_active)<span class="vm-badge">Disembunyikan</span>@endunless
          </strong>
          @if($item->text)<p>{{ $item->text }}</p>@endif
        </div>

        <div class="vm-row-actions">
          <form action="{{ route('admin.visi-misi.items.move', [$item, 'up']) }}" method="POST" class="vm-inline">
            @csrf
            <button type="submit" class="vm-mini" title="Naikkan" @disabled($loop->first)><i class="fas fa-arrow-up"></i></button>
          </form>
          <form action="{{ route('admin.visi-misi.items.move', [$item, 'down']) }}" method="POST" class="vm-inline">
            @csrf
            <button type="submit" class="vm-mini" title="Turunkan" @disabled($loop->last)><i class="fas fa-arrow-down"></i></button>
          </form>
          <form action="{{ route('admin.visi-misi.items.toggle', $item) }}" method="POST" class="vm-inline">
            @csrf
            <button type="submit" class="vm-mini" title="{{ $item->is_active ? 'Sembunyikan' : 'Tampilkan' }}">
              <i class="fas {{ $item->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
            </button>
          </form>
          <button type="button" class="vm-mini" title="Edit"
                  data-vm-edit
                  data-url="{{ route('admin.visi-misi.items.update', $item) }}"
                  data-title="{{ $item->title }}"
                  data-text="{{ $item->text }}"
                  data-icon="{{ $item->icon }}"
                  data-active="{{ $item->is_active ? '1' : '0' }}">
            <i class="fas fa-pen"></i>
          </button>
          <form action="{{ route('admin.visi-misi.items.destroy', $item) }}" method="POST" class="vm-inline"
                onsubmit="return confirm('Hapus item ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="vm-mini danger" title="Hapus"><i class="fas fa-trash"></i></button>
          </form>
        </div>
      </div>
    @empty
      <div class="vm-empty">Belum ada item. Bagian ini tidak akan tampil di halaman publik sampai ada minimal satu item aktif.</div>
    @endforelse
  </div>

  <button type="button" class="vm-add" id="vmAddBtn"><i class="fas fa-plus"></i> Tambah {{ $itemLabel }}</button>
</div>

{{-- ================= MODAL TAMBAH / EDIT ================= --}}
<div class="vm-modal" id="vmModal" aria-hidden="true">
  <div class="vm-modal-box">
    <h3 id="vmModalTitle">Tambah {{ $itemLabel }}</h3>

    <form id="vmForm" method="POST" action="{{ route('admin.visi-misi.items.store') }}">
      @csrf
      <input type="hidden" name="_method" value="PUT" id="vmMethod" disabled>
      <input type="hidden" name="type" value="{{ $tab }}">

      <div class="db-form-group">
        <label>Judul</label>
        <input type="text" name="title" id="vmTitle" class="db-form-control" maxlength="255" required>
      </div>

      <div class="db-form-group">
        <label>Keterangan</label>
        <textarea name="text" id="vmText" class="db-form-control" rows="4" maxlength="2000"></textarea>
      </div>

      @if($withIcon)
        <div class="db-form-group">
          <label>Ikon (FontAwesome)</label>
          <div class="vm-icon-row">
            <span class="vm-ico"><i class="fas fa-star" id="vmIconPreview"></i></span>
            <input type="text" name="icon" id="vmIcon" class="db-form-control" list="vmIcons" maxlength="60" placeholder="fa-star" autocomplete="off">
          </div>
          <datalist id="vmIcons">
            @foreach(['fa-book-open','fa-handshake','fa-user-graduate','fa-graduation-cap','fa-mosque','fa-briefcase','fa-lightbulb','fa-people-group','fa-scale-balanced','fa-seedling','fa-star','fa-heart','fa-shield-halved','fa-award','fa-trophy','fa-medal','fa-rocket','fa-gears','fa-laptop-code','fa-microchip','fa-chalkboard-user','fa-users','fa-globe','fa-leaf','fa-flag','fa-bullseye','fa-gem','fa-fire','fa-hand-holding-heart','fa-comments','fa-clock','fa-check-double'] as $ic)
              <option value="{{ $ic }}">
            @endforeach
          </datalist>
          <div class="vm-hint">Pilih dari saran atau ketik nama ikon, mis. <code>fa-rocket</code>. Cari lainnya di fontawesome.com/icons (yang gratis / solid).</div>
        </div>
      @endif

      <label class="vm-check">
        <input type="checkbox" name="is_active" value="1" id="vmActive" checked>
        Tampilkan di halaman publik
      </label>

      <div class="vm-actions" style="justify-content:space-between">
        <button type="button" class="vm-btn-ghost" id="vmCancel">Batal</button>
        <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
(function () {
  var modal   = document.getElementById('vmModal');
  var form    = document.getElementById('vmForm');
  var method  = document.getElementById('vmMethod');
  var title   = document.getElementById('vmTitle');
  var text    = document.getElementById('vmText');
  var icon    = document.getElementById('vmIcon');
  var preview = document.getElementById('vmIconPreview');
  var active  = document.getElementById('vmActive');
  var heading = document.getElementById('vmModalTitle');
  var storeUrl = form.getAttribute('action');
  var label = {{ \Illuminate\Support\Js::from($itemLabel) }};

  function setPreview() {
    if (!icon || !preview) return;
    var v = icon.value.trim();
    preview.className = 'fas ' + (/^fa-[a-z0-9-]+$/.test(v) ? v : 'fa-star');
  }

  function openModal(editBtn) {
    if (editBtn) {
      form.setAttribute('action', editBtn.getAttribute('data-url'));
      method.disabled = false;
      heading.textContent = 'Edit ' + label;
      title.value = editBtn.getAttribute('data-title') || '';
      text.value = editBtn.getAttribute('data-text') || '';
      if (icon) icon.value = editBtn.getAttribute('data-icon') || '';
      active.checked = editBtn.getAttribute('data-active') === '1';
    } else {
      form.setAttribute('action', storeUrl);
      method.disabled = true;
      heading.textContent = 'Tambah ' + label;
      title.value = '';
      text.value = '';
      if (icon) icon.value = '';
      active.checked = true;
    }
    setPreview();
    modal.classList.add('show');
    modal.setAttribute('aria-hidden', 'false');
    setTimeout(function () { title.focus(); }, 30);
  }

  function closeModal() {
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
  }

  document.getElementById('vmAddBtn').addEventListener('click', function () { openModal(null); });
  document.querySelectorAll('[data-vm-edit]').forEach(function (btn) {
    btn.addEventListener('click', function () { openModal(btn); });
  });
  document.getElementById('vmCancel').addEventListener('click', closeModal);
  modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });
  if (icon) icon.addEventListener('input', setPreview);
})();
</script>
@endpush
