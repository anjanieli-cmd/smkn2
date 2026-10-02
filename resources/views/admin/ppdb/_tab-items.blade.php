{{-- Tab daftar (satu section). Variabel: $tab, $cfg, $s, $items, $selected, $isNew --}}
@php
  $editing   = !$isNew && $selected;
  $showModal = $editing || $isNew;
  $hasOld    = session()->hasOldInput();
  $v = fn ($key, $default = null) => old($key, $selected?->{$key} ?? $default);
  $curActive = $hasOld ? (bool) old('is_active') : ($selected?->is_active ?? true);
  $listUrl   = route('admin.ppdb.index', ['tab' => $tab]);
  $newUrl    = route('admin.ppdb.index', ['tab' => $tab, 'new' => 1]);
@endphp

{{-- ================= 1. JUDUL & TEKS BAGIAN INI ================= --}}
<div class="db-panel" style="margin-bottom:1.2rem">
  <div class="db-panel-head"><h2 style="font-size:.9rem">Judul &amp; teks bagian ini</h2></div>
  @include('admin.ppdb._settings')
</div>

{{-- ================= 2. DAFTAR ================= --}}
<div class="db-panel">
  <div class="pp-head">
    <h2>{{ $cfg['tab'] }} ({{ $items->count() }})</h2>
    <a href="{{ $newUrl }}" class="st-add"><i class="fas fa-plus"></i> Tambah {{ $cfg['noun'] }}</a>
  </div>
  <p class="pp-intro">{{ $cfg['hint'] }} Klik <strong>Edit</strong> untuk mengubah. Panah menggeser urutan.</p>

  @if($items->isEmpty())
    <div class="pp-empty">Belum ada data. Klik <strong>Tambah {{ $cfg['noun'] }}</strong> untuk memulai.</div>
  @else
    <div class="pp-list">
      @foreach($items as $it)
        <div class="pp-row {{ $it->is_active ? '' : 'off' }}">
          <span class="pp-no">{{ $loop->iteration }}</span>

          @if($cfg['photo'])
            <span class="pp-thumb">@if($it->photo_url)<img src="{{ $it->photo_url }}" alt="" loading="lazy">@else<i class="fas fa-image"></i>@endif</span>
          @elseif($cfg['icon'])
            <span class="pp-thumb" style="width:44px"><i class="fas {{ $it->icon ?: 'fa-star' }}"></i></span>
          @endif

          <div class="pp-body">
            <strong>
              {{ $it->title }}
              @if($it->label)<span class="pp-chip">{{ $it->label }}</span>@endif
              @unless($it->is_active)<span class="pp-chip">Disembunyikan</span>@endunless
            </strong>
            @if($it->text)<span>{{ $it->text }}</span>@endif
          </div>

          <div class="pp-actions">
            <a class="st-btn-ghost" href="{{ route('admin.ppdb.index', ['tab' => $tab, 'item' => $it->id]) }}"><i class="fas fa-pen"></i> Edit</a>
            <form action="{{ route('admin.ppdb.items.move', [$it, 'up']) }}" method="POST" class="st-inline">
              @csrf
              <button type="submit" class="st-mini" title="Naikkan" @disabled($loop->first)><i class="fas fa-chevron-up"></i></button>
            </form>
            <form action="{{ route('admin.ppdb.items.move', [$it, 'down']) }}" method="POST" class="st-inline">
              @csrf
              <button type="submit" class="st-mini" title="Turunkan" @disabled($loop->last)><i class="fas fa-chevron-down"></i></button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>

{{-- ================= 3. POPUP FORM ================= --}}
@if($showModal)
<div class="st-modal show" id="ppModal" data-close="{{ $listUrl }}">
  <div class="st-modal-box">
    <div class="pp-modal-head">
      <h3>{{ $editing ? 'Edit: '.$selected->title : 'Tambah '.$cfg['noun'] }}</h3>
      <a href="{{ $listUrl }}" class="pp-close" title="Tutup"><i class="fas fa-xmark"></i></a>
    </div>

    <form method="POST" enctype="multipart/form-data"
          action="{{ $editing ? route('admin.ppdb.items.update', $selected) : route('admin.ppdb.items.store', $tab) }}">
      @csrf
      @if($editing) @method('PUT') @endif

      <div class="db-form-group">
        <label>{{ $cfg['title'] }}</label>
        <input type="text" name="title" class="db-form-control" maxlength="255" required value="{{ $v('title') }}">
      </div>

      @if($cfg['label'])
        <div class="db-form-group">
          <label>{{ $cfg['label'] }}</label>
          <input type="text" name="label" class="db-form-control" maxlength="255" value="{{ $v('label') }}">
        </div>
      @endif

      @if($cfg['text'])
        <div class="db-form-group">
          <label>{{ $cfg['text'] }}</label>
          <textarea name="text" class="db-form-control" rows="4" maxlength="2000">{{ $v('text') }}</textarea>
        </div>
      @endif

      @if($cfg['icon'])
        <div class="db-form-group">
          <label>Ikon (FontAwesome)</label>
          <div class="st-icon-row">
            <span class="st-ico"><i class="fas {{ $v('icon', 'fa-star') }}" id="ppIconPreview"></i></span>
            <input type="text" name="icon" id="ppIcon" class="db-form-control" list="ppIcons" maxlength="60"
                   placeholder="fa-star" autocomplete="off" value="{{ $v('icon', 'fa-star') }}">
          </div>
          <datalist id="ppIcons">
            @foreach(['fa-map-marked-alt','fa-hand-holding-heart','fa-trophy','fa-briefcase','fa-id-card','fa-calendar-alt','fa-file-alt','fa-user-graduate','fa-image','fa-star','fa-certificate','fa-medal','fa-school','fa-clipboard-list','fa-file-signature','fa-house','fa-wheelchair','fa-people-group'] as $ic)
              <option value="{{ $ic }}">
            @endforeach
          </datalist>
          <div class="st-hint">Ketik nama ikon, mis. <code>fa-trophy</code>. Cari di fontawesome.com/icons (yang gratis / solid).</div>
        </div>
      @endif

      @if($cfg['photo'])
        <div class="st-sub">Foto</div>
        <div class="st-photo-row">
          <div>
            <div class="st-photo-preview" id="ppPhotoBox">
              @if($editing && $selected->photo_url)
                <img src="{{ $selected->photo_url }}" alt="Foto saat ini">
              @else
                <i class="fas fa-image"></i>
              @endif
            </div>
          </div>
          <div class="st-photo-side db-form-group">
            <label>Upload foto (jpg / png / webp)</label>
            <input type="file" name="photo" id="ppPhoto" class="db-form-control" accept="image/jpeg,image/png,image/webp">
            <div class="st-hint">Maksimal 5 MB. Foto landscape paling pas.</div>
            @if($editing && $selected->photo)
              <label class="st-check">
                <input type="checkbox" name="remove_photo" value="1" @checked(old('remove_photo'))>
                Hapus foto ini
              </label>
            @endif
          </div>
        </div>
      @endif

      <label class="st-check" style="margin-top:1rem">
        <input type="checkbox" name="is_active" value="1" @checked($curActive)>
        Tampilkan di halaman publik
      </label>

      <div class="st-actions">
        <div style="display:flex;gap:.5rem;flex-wrap:wrap">
          @if($editing)
            <button type="submit" form="ppDeleteForm" class="st-btn-ghost st-btn-danger"
                    onclick="return confirm('Hapus data ini? Foto yang diupload lewat admin ikut terhapus.')">
              <i class="fas fa-trash"></i> Hapus
            </button>
            <button type="submit" form="ppToggleForm" class="st-btn-ghost">
              <i class="fas {{ $selected->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
              {{ $selected->is_active ? 'Sembunyikan' : 'Tampilkan' }}
            </button>
          @endif
        </div>
        <div style="display:flex;gap:.5rem;flex-wrap:wrap">
          <a href="{{ $listUrl }}" class="st-btn-ghost">Batal</a>
          <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan</button>
        </div>
      </div>
    </form>

    @if($editing)
      <form id="ppDeleteForm" method="POST" action="{{ route('admin.ppdb.items.destroy', $selected) }}" style="display:none">
        @csrf
        @method('DELETE')
      </form>
      <form id="ppToggleForm" method="POST" action="{{ route('admin.ppdb.items.toggle', $selected) }}" style="display:none">
        @csrf
      </form>
    @endif
  </div>
</div>
@endif

@push('scripts')
<script>
(function () {
  var file  = document.getElementById('ppPhoto');
  var box   = document.getElementById('ppPhotoBox');
  var icon  = document.getElementById('ppIcon');
  var prev  = document.getElementById('ppIconPreview');
  var modal = document.getElementById('ppModal');

  if (file && box) {
    file.addEventListener('change', function () {
      var f = file.files && file.files[0];
      if (!f) return;
      box.innerHTML = '';
      var img = document.createElement('img');
      img.src = URL.createObjectURL(f);
      img.alt = 'Pratinjau foto baru';
      box.appendChild(img);
    });
  }

  if (icon && prev) {
    icon.addEventListener('input', function () {
      var m = icon.value.match(/fa-[a-z0-9-]+/gi) || [];
      var skip = ['fa-solid', 'fa-regular', 'fa-brands', 'fa-light', 'fa-fw'];
      var pick = m.filter(function (c) { return skip.indexOf(c.toLowerCase()) === -1; })[0];
      prev.className = 'fas ' + (pick ? pick.toLowerCase() : 'fa-star');
    });
  }

  if (modal) {
    var closeUrl = modal.getAttribute('data-close');
    modal.addEventListener('mousedown', function (e) { if (e.target === modal) window.location.href = closeUrl; });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') window.location.href = closeUrl; });
  }
})();
</script>
@endpush
