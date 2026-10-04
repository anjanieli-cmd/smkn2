{{-- Tab Bidang / Kategori. Variabel: $categories, $works --}}
<div class="db-panel">
  <div class="db-panel-head">
    <h2 style="font-size:.9rem">Bidang / Kategori ({{ $categories->count() }})</h2>
    <span style="font-size:.72rem;color:var(--text-muted)">Chip kecil di bagian pengantar dan kartu pada bagian "Lima bidang, ratusan karya"</span>
  </div>

  <div class="kr-list">
    @forelse($categories as $c)
      @php $used = $works->where('category_key', $c->key)->count(); @endphp
      <div class="kr-item">
        <span class="kr-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

        <div class="kr-body">
          <div class="kr-edit-row">
            <form action="{{ route('admin.karya.categories.update', $c) }}" method="POST" class="kr-edit">
              @csrf
              @method('PUT')
              <input type="text" name="label" class="db-form-control" maxlength="60" required value="{{ $c->label }}" style="min-width:150px">
              <input type="text" name="icon" class="db-form-control" maxlength="60" value="{{ $c->icon }}" placeholder="fa-star" style="min-width:120px;flex:0 0 140px">
              <input type="text" name="description" class="db-form-control" maxlength="255" value="{{ $c->description }}" placeholder="Teks kecil di kartu" style="min-width:220px;flex:2 1 260px">
              <button type="submit" class="kr-btn-ghost"><i class="fas fa-floppy-disk"></i> Simpan</button>
            </form>
            <span class="kr-key"><i class="fas {{ $c->icon }}"></i> <code>{{ $c->key }}</code> · {{ $used }} karya</span>
          </div>
        </div>

        <div class="kr-row-actions">
          <form action="{{ route('admin.karya.categories.move', [$c, 'up']) }}" method="POST" class="kr-inline">
            @csrf
            <button type="submit" class="kr-mini" title="Naikkan" @disabled($loop->first)><i class="fas fa-arrow-up"></i></button>
          </form>
          <form action="{{ route('admin.karya.categories.move', [$c, 'down']) }}" method="POST" class="kr-inline">
            @csrf
            <button type="submit" class="kr-mini" title="Turunkan" @disabled($loop->last)><i class="fas fa-arrow-down"></i></button>
          </form>
          <form action="{{ route('admin.karya.categories.destroy', $c) }}" method="POST" class="kr-inline"
                onsubmit="return confirm('Hapus bidang ini? Karya yang memakainya menjadi tanpa kategori.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="kr-mini danger" title="Hapus"><i class="fas fa-trash"></i></button>
          </form>
        </div>
      </div>
    @empty
      <div class="kr-empty">Belum ada bidang.</div>
    @endforelse
  </div>

  <div class="kr-sub">Tambah bidang baru</div>
  <form action="{{ route('admin.karya.categories.store') }}" method="POST" class="kr-edit-row">
    @csrf
    <input type="text" name="label" class="db-form-control" maxlength="60" required placeholder="Nama bidang, mis. Otomotif" style="flex:1;min-width:170px">
    <input type="text" name="icon" class="db-form-control" maxlength="60" placeholder="fa-star" style="flex:0 0 140px;min-width:120px">
    <input type="text" name="description" class="db-form-control" maxlength="255" placeholder="Teks kecil di kartu" style="flex:2;min-width:200px">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-plus"></i> Tambah</button>
  </form>

  <div class="kr-hint" style="margin-top:1rem">
    Ikon berupa nama class FontAwesome, mis. <code>fa-code</code>, <code>fa-utensils</code>. Semua bidang di sini
    otomatis tampil sebagai chip dan kartu di halaman publik. Judul "Lima bidang, ratusan karya" bisa disesuaikan
    di tab Teks Halaman bila jumlah bidang berubah.
  </div>
</div>
