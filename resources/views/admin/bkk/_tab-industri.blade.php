{{-- Tab Mitra Industri. Variabel: $industries --}}
<div class="db-panel">
  <div class="db-panel-head">
    <h2 style="font-size:.9rem">Mitra Industri ({{ $industries->count() }})</h2>
    <span style="font-size:.72rem;color:var(--text-muted)">Urutan di sini = urutan kartu di halaman publik. Ikon huruf diambil otomatis dari nama perusahaan (tanpa PT / CV / UD).</span>
  </div>

  <div class="bk-list">
    @forelse($industries as $ind)
      <div class="bk-item {{ $ind->is_active ? '' : 'off' }}">
        <span class="bk-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
        <span class="bk-letter" aria-hidden="true">{{ $ind->initial }}</span>

        <div class="bk-body">
          <strong title="{{ $ind->company_name }}">{{ $ind->company_name }}</strong>
          <small>
            {{ $ind->field_of_work ?: 'Industri Umum' }} · {{ $ind->partnership_scope ?: 'PKL & Rekrutmen Lulusan' }}
            @unless($ind->is_active)<span class="bk-badge">Disembunyikan</span>@endunless
          </small>
        </div>

        <div class="bk-row-actions">
          <form action="{{ route('admin.bkk.industries.move', [$ind, 'up']) }}" method="POST" class="bk-inline">
            @csrf
            <button type="submit" class="bk-mini" title="Naikkan" @disabled($loop->first)><i class="fas fa-arrow-up"></i></button>
          </form>
          <form action="{{ route('admin.bkk.industries.move', [$ind, 'down']) }}" method="POST" class="bk-inline">
            @csrf
            <button type="submit" class="bk-mini" title="Turunkan" @disabled($loop->last)><i class="fas fa-arrow-down"></i></button>
          </form>
          <form action="{{ route('admin.bkk.industries.toggle', $ind) }}" method="POST" class="bk-inline">
            @csrf
            <button type="submit" class="bk-mini" title="{{ $ind->is_active ? 'Sembunyikan' : 'Tampilkan' }}">
              <i class="fas {{ $ind->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
            </button>
          </form>
          <button type="button" class="bk-mini" title="Edit"
                  data-bk-edit
                  data-url="{{ route('admin.bkk.industries.update', $ind) }}"
                  data-company="{{ $ind->company_name }}"
                  data-field="{{ $ind->field_of_work }}"
                  data-scope="{{ $ind->partnership_scope }}"
                  data-active="{{ $ind->is_active ? '1' : '0' }}">
            <i class="fas fa-pen"></i>
          </button>
          <form action="{{ route('admin.bkk.industries.destroy', $ind) }}" method="POST" class="bk-inline"
                onsubmit="return confirm('Hapus mitra industri ini secara permanen?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bk-mini danger" title="Hapus"><i class="fas fa-trash"></i></button>
          </form>
        </div>
      </div>
    @empty
      <div class="bk-empty">Belum ada mitra industri. Halaman publik akan menampilkan pesan kosong sampai ada yang ditambahkan.</div>
    @endforelse
  </div>

  <button type="button" class="bk-add" id="bkAddBtn"><i class="fas fa-plus"></i> Tambah Mitra Industri</button>
</div>

<div class="bk-modal" id="bkModal" aria-hidden="true">
  <div class="bk-modal-box" style="width:min(560px,100%)">
    <h3 id="bkModalTitle">Tambah Mitra Industri</h3>

    <form id="bkForm" method="POST" action="{{ route('admin.bkk.industries.store') }}">
      @csrf
      <input type="hidden" name="_method" value="PUT" id="bkMethod" disabled>

      <div class="db-form-group">
        <label>Nama perusahaan</label>
        <input type="text" name="company_name" id="bkCompany" class="db-form-control" maxlength="150" required>
      </div>
      <div class="db-form-group">
        <label>Bidang usaha</label>
        <input type="text" name="field_of_work" id="bkField" class="db-form-control" maxlength="120" placeholder="mis. IT &amp; Telekomunikasi">
        <div class="bk-hint">Kosong = tampil "Industri Umum".</div>
      </div>
      <div class="db-form-group">
        <label>Lingkup kerja sama</label>
        <input type="text" name="partnership_scope" id="bkScope" class="db-form-control" maxlength="200" placeholder="mis. PKL, Kelas Industri &amp; Rekrutmen Lulusan">
        <div class="bk-hint">Kosong = tampil "PKL &amp; Rekrutmen Lulusan".</div>
      </div>

      <label class="bk-check">
        <input type="checkbox" name="is_active" value="1" id="bkActive" checked>
        Tampilkan di halaman publik
      </label>

      <div class="bk-actions" style="justify-content:space-between">
        <button type="button" class="bk-btn-ghost" id="bkCancel">Batal</button>
        <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
(function () {
  var modal   = document.getElementById('bkModal');
  var form    = document.getElementById('bkForm');
  var method  = document.getElementById('bkMethod');
  var heading = document.getElementById('bkModalTitle');
  var storeUrl = form.getAttribute('action');

  var f = {
    company: document.getElementById('bkCompany'),
    field: document.getElementById('bkField'),
    scope: document.getElementById('bkScope'),
    active: document.getElementById('bkActive')
  };

  function openModal(btn) {
    if (btn) {
      form.setAttribute('action', btn.getAttribute('data-url'));
      method.disabled = false;
      heading.textContent = 'Edit Mitra Industri';
      f.company.value = btn.getAttribute('data-company') || '';
      f.field.value = btn.getAttribute('data-field') || '';
      f.scope.value = btn.getAttribute('data-scope') || '';
      f.active.checked = btn.getAttribute('data-active') === '1';
    } else {
      form.setAttribute('action', storeUrl);
      method.disabled = true;
      heading.textContent = 'Tambah Mitra Industri';
      f.company.value = '';
      f.field.value = '';
      f.scope.value = '';
      f.active.checked = true;
    }

    modal.classList.add('show');
    modal.setAttribute('aria-hidden', 'false');
    setTimeout(function () { f.company.focus(); }, 30);
  }

  function closeModal() {
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
  }

  document.getElementById('bkAddBtn').addEventListener('click', function () { openModal(null); });
  document.querySelectorAll('[data-bk-edit]').forEach(function (btn) {
    btn.addEventListener('click', function () { openModal(btn); });
  });
  document.getElementById('bkCancel').addEventListener('click', closeModal);
  modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });
})();
</script>
@endpush
