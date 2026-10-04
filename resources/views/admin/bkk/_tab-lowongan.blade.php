{{-- Tab Lowongan. Variabel: $jobs, $counts, $statusFilter --}}
<div class="bk-stats">
  <a href="{{ route('admin.bkk.index', ['tab' => 'lowongan']) }}" class="bk-stat all {{ $statusFilter === '' ? 'active' : '' }}">
    <b>{{ $counts['ALL'] }}</b><span>Semua</span>
  </a>
  @foreach(\App\Models\BkkJobVacancy::STATUSES as $code => $full)
    <a href="{{ route('admin.bkk.index', ['tab' => 'lowongan', 'status' => $code]) }}" class="bk-stat {{ $code }} {{ $statusFilter === $code ? 'active' : '' }}">
      <b>{{ $counts[$code] }}</b><span>{{ $code }}</span>
    </a>
  @endforeach
</div>

<div class="db-panel">
  <div class="db-panel-head">
    <h2 style="font-size:.9rem">Daftar Lowongan ({{ $jobs->count() }})</h2>
    <span style="font-size:.72rem;color:var(--text-muted)">Urutan otomatis: OPEN, UPCOMING, SELESAI, lalu ARSIP. Lowongan OPEN yang batas daftarnya sudah lewat otomatis tampil sebagai SELESAI.</span>
  </div>

  <div class="bk-list">
    @forelse($jobs as $j)
      @php $eff = $j->effective_status; @endphp
      <div class="bk-item {{ $j->is_active ? '' : 'off' }}">
        <span class="bk-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

        <div class="bk-body">
          <strong title="{{ $j->title }}">{{ $j->title }}</strong>
          <small>
            <span class="bk-st {{ $eff }}">{{ $eff }}</span>{{ $j->company_name }}@if($j->location) · {{ $j->location }}@endif @if($j->employment_type) · {{ $j->employment_type }}@endif @if($j->deadline) · Batas {{ $j->deadline->format('d/m/Y') }}@endif
            @if($j->auto_closed)<span class="bk-badge">Otomatis selesai</span>@endif
            @unless($j->is_active)<span class="bk-badge">Disembunyikan</span>@endunless
          </small>
        </div>

        <div class="bk-row-actions">
          <form action="{{ route('admin.bkk.jobs.status', $j) }}" method="POST" class="bk-inline">
            @csrf
            @method('PUT')
            <select name="status" class="bk-quick" onchange="this.form.submit()" title="Ubah status cepat">
              @foreach(\App\Models\BkkJobVacancy::STATUSES as $code => $full)
                <option value="{{ $code }}" @selected(strtoupper($j->status) === $code)>{{ $code }}</option>
              @endforeach
            </select>
          </form>
          <form action="{{ route('admin.bkk.jobs.toggle', $j) }}" method="POST" class="bk-inline">
            @csrf
            <button type="submit" class="bk-mini" title="{{ $j->is_active ? 'Sembunyikan' : 'Tampilkan' }}">
              <i class="fas {{ $j->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
            </button>
          </form>
          <button type="button" class="bk-mini" title="Edit"
                  data-bk-edit
                  data-url="{{ route('admin.bkk.jobs.update', $j) }}"
                  data-title="{{ $j->title }}"
                  data-company="{{ $j->company_name }}"
                  data-location="{{ $j->location }}"
                  data-type="{{ $j->employment_type }}"
                  data-status="{{ strtoupper($j->status) }}"
                  data-deadline="{{ $j->deadline ? $j->deadline->format('Y-m-d') : '' }}"
                  data-apply="{{ $j->apply_url }}"
                  data-description="{{ $j->description }}"
                  data-active="{{ $j->is_active ? '1' : '0' }}">
            <i class="fas fa-pen"></i>
          </button>
          <form action="{{ route('admin.bkk.jobs.destroy', $j) }}" method="POST" class="bk-inline"
                onsubmit="return confirm('Hapus lowongan ini secara permanen? Kalau hanya ingin menyembunyikan, pakai tombol mata.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bk-mini danger" title="Hapus"><i class="fas fa-trash"></i></button>
          </form>
        </div>
      </div>
    @empty
      <div class="bk-empty">
        @if($statusFilter !== '') Tidak ada lowongan dengan status {{ $statusFilter }}. @else Belum ada lowongan. Klik "Tambah Lowongan" di bawah. @endif
      </div>
    @endforelse
  </div>

  <button type="button" class="bk-add" id="bkAddBtn"><i class="fas fa-plus"></i> Tambah Lowongan</button>
</div>

{{-- ================= MODAL TAMBAH / EDIT ================= --}}
<div class="bk-modal" id="bkModal" aria-hidden="true">
  <div class="bk-modal-box">
    <h3 id="bkModalTitle">Tambah Lowongan</h3>

    <form id="bkForm" method="POST" action="{{ route('admin.bkk.jobs.store') }}">
      @csrf
      <input type="hidden" name="_method" value="PUT" id="bkMethod" disabled>

      <div class="db-form-group">
        <label>Posisi / judul lowongan</label>
        <input type="text" name="title" id="bkTitle" class="db-form-control" maxlength="255" required placeholder="mis. Operator Produksi">
      </div>

      <div class="bk-grid-2">
        <div class="db-form-group">
          <label>Perusahaan</label>
          <input type="text" name="company_name" id="bkCompany" class="db-form-control" maxlength="255" required>
        </div>
        <div class="db-form-group">
          <label>Lokasi</label>
          <input type="text" name="location" id="bkLocation" class="db-form-control" maxlength="255" placeholder="mis. Mojokerto">
        </div>
      </div>

      <div class="bk-grid-3">
        <div class="db-form-group">
          <label>Status</label>
          <select name="status" id="bkStatus" class="db-form-control" required>
            @foreach(\App\Models\BkkJobVacancy::STATUSES as $code => $full)
              <option value="{{ $code }}">{{ $full }}</option>
            @endforeach
          </select>
        </div>
        <div class="db-form-group">
          <label>Jenis pekerjaan</label>
          <input type="text" name="employment_type" id="bkType" class="db-form-control" maxlength="60" list="bkTypeList" placeholder="Full-Time">
          <datalist id="bkTypeList">
            @foreach(\App\Models\BkkJobVacancy::EMPLOYMENT_TYPES as $t)<option value="{{ $t }}">@endforeach
          </datalist>
        </div>
        <div class="db-form-group">
          <label>Batas pendaftaran</label>
          <input type="date" name="deadline" id="bkDeadline" class="db-form-control">
        </div>
      </div>
      <div class="bk-hint" style="margin-top:-.4rem;margin-bottom:.9rem">Status OPEN dengan batas pendaftaran yang sudah lewat otomatis tampil sebagai SELESAI di halaman publik. Kosongkan batas jika tidak ada.</div>

      <div class="db-form-group">
        <label>Link lamaran</label>
        <input type="text" name="apply_url" id="bkApply" class="db-form-control" maxlength="500" placeholder="https://... atau mailto:hrd@perusahaan.com">
        <div class="bk-hint">Kosong = tombol "Lamar Sekarang" tidak tampil (cocok untuk status ARSIP).</div>
      </div>

      <div class="db-form-group">
        <label>Deskripsi singkat</label>
        <textarea name="description" id="bkDescription" class="db-form-control" rows="5" maxlength="3000" placeholder="Kualifikasi, jurusan yang dicari, tahapan seleksi, dst."></textarea>
        <div class="bk-hint">Di kartu publik hanya tampil sekitar 170 karakter pertama — taruh informasi terpenting di awal.</div>
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
    title: document.getElementById('bkTitle'),
    company: document.getElementById('bkCompany'),
    location: document.getElementById('bkLocation'),
    status: document.getElementById('bkStatus'),
    type: document.getElementById('bkType'),
    deadline: document.getElementById('bkDeadline'),
    apply: document.getElementById('bkApply'),
    description: document.getElementById('bkDescription'),
    active: document.getElementById('bkActive')
  };

  function openModal(btn) {
    if (btn) {
      form.setAttribute('action', btn.getAttribute('data-url'));
      method.disabled = false;
      heading.textContent = 'Edit Lowongan';
      f.title.value = btn.getAttribute('data-title') || '';
      f.company.value = btn.getAttribute('data-company') || '';
      f.location.value = btn.getAttribute('data-location') || '';
      f.status.value = btn.getAttribute('data-status') || 'OPEN';
      f.type.value = btn.getAttribute('data-type') || '';
      f.deadline.value = btn.getAttribute('data-deadline') || '';
      f.apply.value = btn.getAttribute('data-apply') || '';
      f.description.value = btn.getAttribute('data-description') || '';
      f.active.checked = btn.getAttribute('data-active') === '1';
    } else {
      form.setAttribute('action', storeUrl);
      method.disabled = true;
      heading.textContent = 'Tambah Lowongan';
      f.title.value = '';
      f.company.value = '';
      f.location.value = '';
      f.status.value = 'OPEN';
      f.type.value = 'Full-Time';
      f.deadline.value = '';
      f.apply.value = '';
      f.description.value = '';
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
