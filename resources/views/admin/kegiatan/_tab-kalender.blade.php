{{-- Tab Kalender Tahunan. Variabel: $months --}}
<div class="db-panel">
  <div class="db-panel-head">
    <h2 style="font-size:.9rem">Kalender Tahunan ({{ $months->count() }})</h2>
    <span style="font-size:.72rem;color:var(--text-muted)">Kartu bulan di bagian "Perjalanan Satu Tahun". Nomor 01, 02, ... mengikuti urutan di sini.</span>
  </div>

  <div class="kd-list">
    @forelse($months as $m)
      <div class="kd-item {{ $m->is_active ? '' : 'off' }}">
        <span class="kd-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

        <div class="kd-body">
          <div class="kd-edit-row">
            <form action="{{ route('admin.kegiatan.months.update', $m) }}" method="POST" class="kd-edit">
              @csrf
              @method('PUT')
              <input type="text" name="label" class="db-form-control" maxlength="20" required value="{{ $m->label }}" style="max-width:90px;min-width:70px;flex:0 0 90px" placeholder="JAN">
              <input type="text" name="event" class="db-form-control" maxlength="255" required value="{{ $m->event }}" style="min-width:200px;flex:2" placeholder="Nama kegiatan">
              <input type="text" name="note" class="db-form-control" maxlength="255" value="{{ $m->note }}" style="min-width:200px;flex:2" placeholder="Catatan singkat">
              <button type="submit" class="kd-btn-ghost"><i class="fas fa-floppy-disk"></i> Simpan</button>
            </form>
          </div>
        </div>

        <div class="kd-row-actions">
          <form action="{{ route('admin.kegiatan.months.move', [$m, 'up']) }}" method="POST" class="kd-inline">
            @csrf
            <button type="submit" class="kd-mini" title="Naikkan" @disabled($loop->first)><i class="fas fa-arrow-up"></i></button>
          </form>
          <form action="{{ route('admin.kegiatan.months.move', [$m, 'down']) }}" method="POST" class="kd-inline">
            @csrf
            <button type="submit" class="kd-mini" title="Turunkan" @disabled($loop->last)><i class="fas fa-arrow-down"></i></button>
          </form>
          <form action="{{ route('admin.kegiatan.months.toggle', $m) }}" method="POST" class="kd-inline">
            @csrf
            <button type="submit" class="kd-mini" title="{{ $m->is_active ? 'Sembunyikan' : 'Tampilkan' }}">
              <i class="fas {{ $m->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
            </button>
          </form>
          <form action="{{ route('admin.kegiatan.months.destroy', $m) }}" method="POST" class="kd-inline"
                onsubmit="return confirm('Hapus bulan ini dari kalender?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="kd-mini danger" title="Hapus"><i class="fas fa-trash"></i></button>
          </form>
        </div>
      </div>
    @empty
      <div class="kd-empty">Belum ada bulan. Bagian kalender akan kosong di halaman publik.</div>
    @endforelse
  </div>

  <div class="kd-sub">Tambah bulan baru</div>
  <form action="{{ route('admin.kegiatan.months.store') }}" method="POST" class="kd-edit-row">
    @csrf
    <input type="text" name="label" class="db-form-control" maxlength="20" required placeholder="NOV" style="max-width:90px;min-width:70px;flex:0 0 90px">
    <input type="text" name="event" class="db-form-control" maxlength="255" required placeholder="Nama kegiatan, mis. Asesmen Akhir Semester" style="min-width:200px;flex:2">
    <input type="text" name="note" class="db-form-control" maxlength="255" placeholder="Catatan singkat (opsional)" style="min-width:200px;flex:2">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-plus"></i> Tambah</button>
  </form>

  <div class="kd-hint" style="margin-top:1rem">
    Tulis singkatan bulan huruf besar (JAN, FEB, MAR, ... AGU, SEP, OKT). Boleh lebih atau kurang dari 12 bulan — susunan kartu menyesuaikan otomatis.
  </div>
</div>
