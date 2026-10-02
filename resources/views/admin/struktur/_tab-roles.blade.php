{{-- Tab Alur Kerja. Variabel: $roles, $s --}}

{{-- ================= JUDUL BAGIAN ================= --}}
<form action="{{ route('admin.struktur.settings.update', 'peran') }}" method="POST" class="db-panel" style="margin-bottom:1.2rem">
  @csrf
  @method('PUT')
  <div class="db-panel-head"><h2 style="font-size:.9rem">Judul Bagian Alur Kerja</h2></div>

  <div class="db-form-group">
    <label>Label kecil di atas judul</label>
    <input type="text" name="roles_eyebrow" class="db-form-control" maxlength="120" value="{{ old('roles_eyebrow', $s['roles_eyebrow']) }}">
  </div>

  <div class="st-grid-2">
    <div class="db-form-group">
      <label>Judul (warna biru)</label>
      <input type="text" name="roles_heading" class="db-form-control" maxlength="80" required value="{{ old('roles_heading', $s['roles_heading']) }}">
    </div>
    <div class="db-form-group">
      <label>Lanjutan judul (emas)</label>
      <input type="text" name="roles_heading_gold" class="db-form-control" maxlength="80" value="{{ old('roles_heading_gold', $s['roles_heading_gold']) }}">
    </div>
  </div>

  <div class="db-form-group">
    <label>Paragraf pengantar</label>
    <textarea name="roles_desc" class="db-form-control" rows="3">{{ old('roles_desc', $s['roles_desc']) }}</textarea>
  </div>

  <div style="display:flex;justify-content:flex-end;margin-top:.4rem">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Judul</button>
  </div>
</form>

{{-- ================= DAFTAR KARTU ================= --}}
<div class="db-panel">
  <div class="db-panel-head">
    <h2 style="font-size:.9rem">Kartu Alur Kerja ({{ $roles->count() }})</h2>
    <span style="font-size:.72rem;color:var(--text-muted)">Kartu terakhir otomatis berikon emas. Bagian disembunyikan kalau tidak ada kartu aktif.</span>
  </div>

  <div class="st-cards">
    @forelse($roles as $role)
      <div class="st-card {{ $role->is_active ? '' : 'off' }}">
        <span class="st-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
        <span class="st-ico"><i class="fas {{ $role->icon ?: 'fa-star' }}"></i></span>

        <div class="st-cbody">
          <strong>
            {{ $role->title }}
            @unless($role->is_active)<span class="st-badge">Disembunyikan</span>@endunless
          </strong>
          @if($role->text)<p>{{ $role->text }}</p>@endif
        </div>

        <div class="st-row-actions">
          <form action="{{ route('admin.struktur.roles.move', [$role, 'up']) }}" method="POST" class="st-inline">
            @csrf
            <button type="submit" class="st-mini" title="Naikkan" @disabled($loop->first)><i class="fas fa-arrow-up"></i></button>
          </form>
          <form action="{{ route('admin.struktur.roles.move', [$role, 'down']) }}" method="POST" class="st-inline">
            @csrf
            <button type="submit" class="st-mini" title="Turunkan" @disabled($loop->last)><i class="fas fa-arrow-down"></i></button>
          </form>
          <form action="{{ route('admin.struktur.roles.toggle', $role) }}" method="POST" class="st-inline">
            @csrf
            <button type="submit" class="st-mini" title="{{ $role->is_active ? 'Sembunyikan' : 'Tampilkan' }}">
              <i class="fas {{ $role->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
            </button>
          </form>
          <button type="button" class="st-mini" title="Edit"
                  data-st-edit
                  data-url="{{ route('admin.struktur.roles.update', $role) }}"
                  data-title="{{ $role->title }}"
                  data-text="{{ $role->text }}"
                  data-icon="{{ $role->icon }}"
                  data-active="{{ $role->is_active ? '1' : '0' }}">
            <i class="fas fa-pen"></i>
          </button>
          <form action="{{ route('admin.struktur.roles.destroy', $role) }}" method="POST" class="st-inline"
                onsubmit="return confirm('Hapus kartu ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="st-mini danger" title="Hapus"><i class="fas fa-trash"></i></button>
          </form>
        </div>
      </div>
    @empty
      <div class="st-empty">Belum ada kartu. Bagian Alur Kerja tidak tampil di halaman publik sampai ada minimal satu kartu aktif.</div>
    @endforelse
  </div>

  <button type="button" class="st-add" id="stRoleAdd"><i class="fas fa-plus"></i> Tambah Kartu</button>
</div>

{{-- ================= MODAL TAMBAH / EDIT ================= --}}
<div class="st-modal" id="stRoleModal" aria-hidden="true">
  <div class="st-modal-box">
    <h3 id="stRoleModalTitle">Tambah Kartu</h3>

    <form id="stRoleForm" method="POST" action="{{ route('admin.struktur.roles.store') }}">
      @csrf
      <input type="hidden" name="_method" value="PUT" id="stRoleMethod" disabled>

      <div class="db-form-group">
        <label>Judul</label>
        <input type="text" name="title" id="stRoleTitle" class="db-form-control" maxlength="255" required>
      </div>

      <div class="db-form-group">
        <label>Keterangan</label>
        <textarea name="text" id="stRoleText" class="db-form-control" rows="4" maxlength="2000"></textarea>
      </div>

      <div class="db-form-group">
        <label>Ikon (FontAwesome)</label>
        <div class="st-icon-row">
          <span class="st-ico"><i class="fas fa-star" id="stRoleIconPreview"></i></span>
          <input type="text" name="icon" id="stRoleIcon" class="db-form-control" list="stRoleIcons" maxlength="60" placeholder="fa-star" autocomplete="off">
        </div>
        <datalist id="stRoleIcons">
          @foreach(['fa-flag-checkered','fa-diagram-project','fa-graduation-cap','fa-star','fa-users','fa-handshake','fa-gears','fa-bullseye','fa-lightbulb','fa-shield-halved','fa-chalkboard-user','fa-people-group','fa-rocket','fa-award'] as $ic)
            <option value="{{ $ic }}">
          @endforeach
        </datalist>
        <div class="st-hint">Ketik nama ikon, mis. <code>fa-rocket</code>.</div>
      </div>

      <label class="st-check">
        <input type="checkbox" name="is_active" value="1" id="stRoleActive" checked>
        Tampilkan di halaman publik
      </label>

      <div class="st-actions">
        <button type="button" class="st-btn-ghost" id="stRoleCancel">Batal</button>
        <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
(function () {
  var modal   = document.getElementById('stRoleModal');
  var form    = document.getElementById('stRoleForm');
  var method  = document.getElementById('stRoleMethod');
  var title   = document.getElementById('stRoleTitle');
  var text    = document.getElementById('stRoleText');
  var icon    = document.getElementById('stRoleIcon');
  var preview = document.getElementById('stRoleIconPreview');
  var active  = document.getElementById('stRoleActive');
  var heading = document.getElementById('stRoleModalTitle');
  var storeUrl = form.getAttribute('action');

  function setPreview() {
    var m = icon.value.match(/fa-[a-z0-9-]+/gi) || [];
    var skip = ['fa-solid', 'fa-regular', 'fa-brands', 'fa-light', 'fa-fw'];
    var pick = m.filter(function (c) { return skip.indexOf(c.toLowerCase()) === -1; })[0];
    preview.className = 'fas ' + (pick ? pick.toLowerCase() : 'fa-star');
  }

  function openModal(btn) {
    if (btn) {
      form.setAttribute('action', btn.getAttribute('data-url'));
      method.disabled = false;
      heading.textContent = 'Edit Kartu';
      title.value = btn.getAttribute('data-title') || '';
      text.value = btn.getAttribute('data-text') || '';
      icon.value = btn.getAttribute('data-icon') || '';
      active.checked = btn.getAttribute('data-active') === '1';
    } else {
      form.setAttribute('action', storeUrl);
      method.disabled = true;
      heading.textContent = 'Tambah Kartu';
      title.value = '';
      text.value = '';
      icon.value = '';
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

  document.getElementById('stRoleAdd').addEventListener('click', function () { openModal(null); });
  document.querySelectorAll('[data-st-edit]').forEach(function (b) {
    b.addEventListener('click', function () { openModal(b); });
  });
  document.getElementById('stRoleCancel').addEventListener('click', closeModal);
  modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });
  icon.addEventListener('input', setPreview);
})();
</script>
@endpush
