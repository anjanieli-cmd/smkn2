{{-- Tab Struktur: kartu per level + popup edit. Variabel: $members, $selected, $isNew, $newLevel --}}
@php
  $levels  = \App\Models\StrukturMember::LEVELS;
  $bidang  = \App\Models\StrukturMember::BIDANG;
  $editing = !$isNew && $selected;                       // sedang mengedit orang yang sudah ada
  $showModal = $editing || $isNew;
  $hasOld  = session()->hasOldInput();
  $v = fn ($key, $default = null) => old($key, $selected?->{$key} ?? $default);
  $curLevel  = (int) $v('level', $newLevel);
  $curActive = $hasOld ? (bool) old('is_active') : ($selected?->is_active ?? true);
  $grouped   = $members->groupBy('level');
  $listUrl   = route('admin.struktur.index', ['tab' => 'struktur']);
  $advOpen   = $errors->any() || ($editing && ($selected->tasks || $selected->note || $selected->unit || $selected->badge || $selected->description));
@endphp

@push('styles')
<style>
  .sm-intro{font-size:.8rem;color:var(--text-muted);margin:0 0 1.2rem;line-height:1.6}
  .sm-level{margin-bottom:1.6rem}
  .sm-level-head{display:flex;align-items:center;justify-content:space-between;gap:.8rem;margin-bottom:.8rem;
    padding-bottom:.6rem;border-bottom:1px solid rgba(255,255,255,.1)}
  .sm-level-head h3{margin:0;font-size:.82rem;font-weight:800;letter-spacing:.06em;text-transform:uppercase;color:var(--gold-light)}
  .sm-level-head .st-add{width:auto;padding:.5rem .9rem;font-size:.76rem}
  .sm-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));gap:.9rem}
  .sm-card{display:flex;flex-direction:column;border-radius:14px;overflow:hidden;
    border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04)}
  .sm-card.off{opacity:.55}
  .sm-photo{position:relative;aspect-ratio:300/230;background:linear-gradient(180deg,#edf5fb,#dce9f4);
    display:flex;align-items:center;justify-content:center;color:#9db6cc;font-size:2.2rem}
  .sm-photo img{width:100%;height:100%;object-fit:cover;object-position:center top;display:block}
  .sm-flag{position:absolute;top:.5rem;left:.5rem;padding:.15rem .55rem;border-radius:99px;font-size:.62rem;font-weight:800;
    background:rgba(0,0,0,.65);color:#fff}
  .sm-flag.warn{background:#ffb86b;color:#3a2200}
  .sm-body{padding:.75rem .85rem .5rem;flex:1}
  .sm-body strong{display:block;font-size:.85rem;color:#fff;line-height:1.3}
  .sm-body span{display:block;margin-top:.2rem;font-size:.74rem;color:var(--text-muted);line-height:1.4}
  .sm-foot{display:flex;align-items:center;gap:.4rem;padding:.6rem .85rem .8rem}
  .sm-edit{flex:1;justify-content:center;text-decoration:none}
  .sm-foot .st-inline{display:inline-flex}
  .sm-empty{font-size:.8rem;color:var(--text-muted);padding:.4rem 0}

  .sm-modal-box{width:min(680px,100%)}
  .sm-modal-head{display:flex;align-items:center;justify-content:space-between;gap:1rem;margin-bottom:1rem}
  .sm-modal-head h3{margin:0}
  .sm-close{width:34px;height:34px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;
    border:1px solid rgba(255,255,255,.18);background:rgba(255,255,255,.06);color:#fff;text-decoration:none}
  .sm-close:hover{background:rgba(255,255,255,.16)}
  .sm-adv{margin-top:1rem;border:1px solid rgba(255,255,255,.12);border-radius:12px;padding:.2rem 1rem}
  .sm-adv summary{cursor:pointer;padding:.7rem 0;font-size:.8rem;font-weight:800;color:var(--gold-light);list-style:none}
  .sm-adv summary::-webkit-details-marker{display:none}
  .sm-adv summary::before{content:'\25B8';display:inline-block;margin-right:.5rem;transition:transform .2s}
  .sm-adv[open] summary::before{transform:rotate(90deg)}
  .sm-adv-body{padding-bottom:.6rem}
</style>
@endpush

<div class="db-panel">
  <p class="sm-intro">
    Klik <strong>Edit</strong> pada kartu untuk mengubah nama, jabatan, atau foto. Tombol <strong>+ Tambah</strong>
    di tiap level untuk menambah orang baru. Panah menggeser urutan di dalam level yang sama.
  </p>

  @foreach($levels as $lvl => [$lvlLabel, $lvlIcon])
    @php $group = $grouped->get($lvl, collect())->values(); @endphp
    <section class="sm-level">
      <div class="sm-level-head">
        <h3><i class="fas {{ $lvlIcon }}"></i> {{ $lvlLabel }}</h3>
        <a class="st-add" href="{{ route('admin.struktur.index', ['tab' => 'struktur', 'new' => 1, 'level' => $lvl]) }}">
          <i class="fas fa-plus"></i> Tambah
        </a>
      </div>

      @if($group->isEmpty())
        <div class="sm-empty">Belum ada orang di level ini.</div>
      @else
        <div class="sm-grid">
          @foreach($group as $m)
            <article class="sm-card {{ $m->is_active ? '' : 'off' }}">
              <div class="sm-photo">
                @if($m->photo_url)<img src="{{ $m->photo_url }}" alt="" loading="lazy">@else<i class="fas fa-user"></i>@endif
                @if(!$m->is_active)
                  <span class="sm-flag">Disembunyikan</span>
                @elseif(!$m->photo)
                  <span class="sm-flag warn"><i class="fas fa-triangle-exclamation"></i> Belum ada foto</span>
                @endif
              </div>
              <div class="sm-body">
                <strong>{{ $m->position }}</strong>
                <span>{{ $m->person ?: '— nama belum diisi —' }}</span>
              </div>
              <div class="sm-foot">
                <a class="st-btn-ghost sm-edit" href="{{ route('admin.struktur.index', ['tab' => 'struktur', 'member' => $m->id]) }}">
                  <i class="fas fa-pen"></i> Edit
                </a>
                <form action="{{ route('admin.struktur.members.move', [$m, 'up']) }}" method="POST" class="st-inline">
                  @csrf
                  <button type="submit" class="st-mini" title="Geser ke kiri/atas" @disabled($loop->first)><i class="fas fa-chevron-left"></i></button>
                </form>
                <form action="{{ route('admin.struktur.members.move', [$m, 'down']) }}" method="POST" class="st-inline">
                  @csrf
                  <button type="submit" class="st-mini" title="Geser ke kanan/bawah" @disabled($loop->last)><i class="fas fa-chevron-right"></i></button>
                </form>
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </section>
  @endforeach
</div>

{{-- ================= POPUP FORM ================= --}}
@if($showModal)
<div class="st-modal show" id="smModal" data-close="{{ $listUrl }}">
  <div class="st-modal-box sm-modal-box">
    <div class="sm-modal-head">
      <h3>{{ $editing ? 'Edit: '.$selected->position : 'Tambah Orang Baru' }}</h3>
      <a href="{{ $listUrl }}" class="sm-close" title="Tutup"><i class="fas fa-xmark"></i></a>
    </div>

    <form id="stForm" method="POST" enctype="multipart/form-data"
          action="{{ $editing ? route('admin.struktur.members.update', $selected) : route('admin.struktur.members.store') }}">
      @csrf
      @if($editing) @method('PUT') @endif

      <div class="st-sub">Data utama</div>

      <div class="st-grid-2">
        <div class="db-form-group">
          <label>Jabatan (judul kartu)</label>
          <input type="text" name="position" class="db-form-control" maxlength="255" required
                 placeholder="Waka Kurikulum" value="{{ $v('position') }}">
        </div>
        <div class="db-form-group">
          <label>Nama lengkap + gelar</label>
          <input type="text" name="person" class="db-form-control" maxlength="255"
                 placeholder="Nama, S.Pd." value="{{ $v('person') }}">
        </div>
      </div>

      <div class="st-grid-2">
        <div class="db-form-group">
          <label>Level di bagan</label>
          <select name="level" class="db-form-control" required>
            @foreach($levels as $lvl => [$lvlLabel])
              <option value="{{ $lvl }}" @selected($curLevel === $lvl)>{{ $lvlLabel }}</option>
            @endforeach
          </select>
        </div>
        <div class="db-form-group">
          <label>Bidang (untuk chip filter)</label>
          <select name="bidang" class="db-form-control" required>
            @foreach($bidang as $key => $label)
              <option value="{{ $key }}" @selected($v('bidang', $curLevel === 1 ? 'pimpinan' : 'kurikulum') === $key)>{{ $label }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="st-photo-row">
        <div>
          <div class="st-photo-preview" id="stPhotoBox">
            @if($editing && $selected->photo_url)
              <img src="{{ $selected->photo_url }}" alt="Foto saat ini">
            @else
              <i class="fas fa-user"></i>
            @endif
          </div>
          <div class="st-hint" style="text-align:center">Pratinjau potongan di kartu</div>
        </div>
        <div class="st-photo-side db-form-group">
          <label>Foto (jpg / png / webp)</label>
          <input type="file" name="photo" id="stPhoto" class="db-form-control" accept="image/jpeg,image/png,image/webp">
          <div class="st-hint">
            Maksimal 5 MB. Kartu memotong dari <strong>bagian atas</strong>, jadi pakai foto potret
            dengan wajah di area atas.
          </div>
          @if($editing && $selected->photo)
            <label class="st-check">
              <input type="checkbox" name="remove_photo" value="1" @checked(old('remove_photo'))>
              Hapus foto ini
            </label>
          @endif
        </div>
      </div>

      <label class="st-check" style="margin-top:1rem">
        <input type="checkbox" name="is_active" value="1" @checked($curActive)>
        Tampilkan di halaman publik
      </label>

      <details class="sm-adv" @if($advOpen) open @endif>
        <summary>Isi popup detail &amp; pengaturan lain (opsional)</summary>
        <div class="sm-adv-body">

          <div class="db-form-group">
            <label>Keterangan singkat di kartu</label>
            <textarea name="description" class="db-form-control" rows="2" maxlength="500"
                      placeholder="Satu kalimat tentang peran jabatan ini">{{ $v('description') }}</textarea>
          </div>

          <div class="st-grid-2">
            <div class="db-form-group">
              <label>Teks pil kecil</label>
              <input type="text" name="badge" class="db-form-control" maxlength="120"
                     placeholder="kosong = sama dengan jabatan" value="{{ $v('badge') }}">
            </div>
            <div class="db-form-group">
              <label>Unit / bagian (pencarian &amp; tag)</label>
              <input type="text" name="unit" class="db-form-control" maxlength="255"
                     placeholder="Kurikulum" value="{{ $v('unit') }}">
            </div>
          </div>

          <div class="db-form-group">
            <label>Ikon lencana di foto (FontAwesome)</label>
            <div class="st-icon-row">
              <span class="st-ico"><i class="fas {{ $v('icon', 'fa-user') }}" id="stIconPreview"></i></span>
              <input type="text" name="icon" id="stIcon" class="db-form-control" list="stIcons" maxlength="60"
                     placeholder="fa-user" autocomplete="off" value="{{ $v('icon', 'fa-user') }}">
            </div>
            <datalist id="stIcons">
              @foreach(['fa-star','fa-user-tie','fa-book-open','fa-users','fa-building','fa-handshake','fa-money-bill-wave','fa-wallet','fa-code','fa-seedling','fa-palette','fa-landmark','fa-utensils','fa-briefcase','fa-graduation-cap','fa-chalkboard-user','fa-gears','fa-shield-halved','fa-flask','fa-camera','fa-laptop-code','fa-microchip','fa-heart-pulse','fa-scale-balanced','fa-people-group','fa-clipboard-list','fa-user-graduate','fa-flag'] as $ic)
                <option value="{{ $ic }}">
              @endforeach
            </datalist>
            <div class="st-hint">Ketik nama ikon, mis. <code>fa-code</code>.</div>
          </div>

          <div class="db-form-group">
            <label>Tugas &amp; tanggung jawab (satu tugas per baris)</label>
            <textarea name="tasks" class="db-form-control" rows="5" maxlength="4000"
                      placeholder="Memimpin dan mengarahkan…&#10;Menetapkan kebijakan…">{{ $v('tasks') }}</textarea>
            <div class="st-hint">Tampil sebagai daftar centang saat kartu diklik di halaman publik.</div>
          </div>

          <div class="db-form-group">
            <label>Catatan di popup</label>
            <input type="text" name="note" class="db-form-control" maxlength="500"
                   placeholder="Kosong = kotak catatan tidak ditampilkan" value="{{ $v('note') }}">
          </div>
        </div>
      </details>

      <div class="st-actions">
        <div style="display:flex;gap:.5rem;flex-wrap:wrap">
          @if($editing)
            <button type="submit" form="stDeleteForm" class="st-btn-ghost st-btn-danger"
                    onclick="return confirm('Hapus data ini dari bagan? Foto yang diupload lewat admin ikut terhapus.')">
              <i class="fas fa-trash"></i> Hapus
            </button>
            <button type="submit" form="stToggleForm" class="st-btn-ghost">
              <i class="fas {{ $selected->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
              {{ $selected->is_active ? 'Sembunyikan' : 'Tampilkan' }}
            </button>
          @endif
        </div>
        <div style="display:flex;gap:.5rem;flex-wrap:wrap">
          <a href="{{ $listUrl }}" class="st-btn-ghost" style="text-decoration:none">Batal</a>
          <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan</button>
        </div>
      </div>
    </form>

    @if($editing)
      <form id="stDeleteForm" method="POST" action="{{ route('admin.struktur.members.destroy', $selected) }}" style="display:none">
        @csrf
        @method('DELETE')
      </form>
      <form id="stToggleForm" method="POST" action="{{ route('admin.struktur.members.toggle', $selected) }}" style="display:none">
        @csrf
      </form>
    @endif
  </div>
</div>
@endif

@push('scripts')
<script>
(function () {
  var file = document.getElementById('stPhoto');
  var box  = document.getElementById('stPhotoBox');
  var icon = document.getElementById('stIcon');
  var prev = document.getElementById('stIconPreview');
  var modal = document.getElementById('smModal');

  if (file && box) {
    file.addEventListener('change', function () {
      var f = file.files && file.files[0];
      if (!f) return;
      var url = URL.createObjectURL(f);
      box.innerHTML = '';
      var img = document.createElement('img');
      img.src = url;
      img.alt = 'Pratinjau foto baru';
      box.appendChild(img);
    });
  }

  function setPreview() {
    if (!icon || !prev) return;
    var m = icon.value.match(/fa-[a-z0-9-]+/gi) || [];
    var skip = ['fa-solid', 'fa-regular', 'fa-brands', 'fa-light', 'fa-fw'];
    var pick = m.filter(function (c) { return skip.indexOf(c.toLowerCase()) === -1; })[0];
    prev.className = 'fas ' + (pick ? pick.toLowerCase() : 'fa-user');
  }
  if (icon) icon.addEventListener('input', setPreview);

  /* Tutup popup: klik area gelap atau tekan Esc */
  if (modal) {
    var closeUrl = modal.getAttribute('data-close');
    modal.addEventListener('mousedown', function (e) { if (e.target === modal) window.location.href = closeUrl; });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') window.location.href = closeUrl; });
  }
})();
</script>
@endpush