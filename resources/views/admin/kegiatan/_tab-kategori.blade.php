{{-- Tab Kategori. Variabel: $categories, $albums --}}
<div class="db-panel">
  <div class="db-panel-head">
    <h2 style="font-size:.9rem">Kategori ({{ $categories->count() }})</h2>
    <span style="font-size:.72rem;color:var(--text-muted)">Tombol filter di "Jejak Kegiatan" dan label kecil di setiap kartu foto</span>
  </div>

  <div class="kd-list">
    @forelse($categories as $c)
      @php $used = $albums->where('category_key', $c->key)->count(); @endphp
      <div class="kd-item">
        <span class="kd-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

        <div class="kd-body">
          <div class="kd-edit-row">
            <form action="{{ route('admin.kegiatan.categories.update', $c) }}" method="POST" class="kd-edit">
              @csrf
              @method('PUT')
              <input type="text" name="label" class="db-form-control" maxlength="60" required value="{{ $c->label }}" style="min-width:160px">
              <input type="text" name="icon" class="db-form-control" maxlength="60" value="{{ $c->icon }}" placeholder="fa-flag" style="min-width:140px">
              <button type="submit" class="kd-btn-ghost"><i class="fas fa-floppy-disk"></i> Simpan</button>
            </form>
            <span class="kd-key"><i class="fas {{ $c->icon }}"></i> <code>{{ $c->key }}</code> · {{ $used }} album</span>
          </div>
        </div>

        <div class="kd-row-actions">
          <form action="{{ route('admin.kegiatan.categories.move', [$c, 'up']) }}" method="POST" class="kd-inline">
            @csrf
            <button type="submit" class="kd-mini" title="Naikkan" @disabled($loop->first)><i class="fas fa-arrow-up"></i></button>
          </form>
          <form action="{{ route('admin.kegiatan.categories.move', [$c, 'down']) }}" method="POST" class="kd-inline">
            @csrf
            <button type="submit" class="kd-mini" title="Turunkan" @disabled($loop->last)><i class="fas fa-arrow-down"></i></button>
          </form>
          <form action="{{ route('admin.kegiatan.categories.destroy', $c) }}" method="POST" class="kd-inline"
                onsubmit="return confirm('Hapus kategori ini? Album yang memakainya menjadi tanpa kategori.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="kd-mini danger" title="Hapus"><i class="fas fa-trash"></i></button>
          </form>
        </div>
      </div>
    @empty
      <div class="kd-empty">Belum ada kategori.</div>
    @endforelse
  </div>

  <div class="kd-sub">Tambah kategori baru</div>
  <form action="{{ route('admin.kegiatan.categories.store') }}" method="POST" class="kd-edit-row">
    @csrf
    <input type="text" name="label" class="db-form-control" maxlength="60" required placeholder="Nama kategori baru, mis. Bakti Sosial" style="flex:1;min-width:180px">
    <input type="text" name="icon" class="db-form-control" maxlength="60" placeholder="fa-flag" style="min-width:140px;flex:0 0 160px">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-plus"></i> Tambah</button>
  </form>

  <div class="kd-hint" style="margin-top:1rem">
    Ikon berupa nama class FontAwesome, mis. <code>fa-trophy</code>, <code>fa-industry</code>. Tombol filter hanya muncul
    untuk kategori yang punya minimal satu album tampil di galeri. Urutan di sini = urutan tombol filter.
  </div>
</div>
