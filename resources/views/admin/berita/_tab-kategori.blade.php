{{-- Tab Kategori. Variabel: $categories --}}
<div class="db-panel">
  <div class="db-panel-head">
    <h2 style="font-size:.9rem">Kategori ({{ $categories->count() }})</h2>
    <span style="font-size:.72rem;color:var(--text-muted)">Chip filter di "Berita Terbaru" dan label warna di setiap kartu</span>
  </div>

  <div class="bn-list">
    @forelse($categories as $c)
      <div class="bn-item">
        <span class="bn-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

        <div class="bn-body">
          <div class="bn-cat-row">
            <form action="{{ route('admin.berita.categories.update', $c) }}" method="POST" class="bn-cat-edit">
              @csrf
              @method('PUT')
              <input type="text" name="label" class="db-form-control" maxlength="60" required value="{{ $c->label }}" style="min-width:140px">
              <select name="color" class="db-form-control" style="min-width:150px">
                @foreach(\App\Models\BeritaCategory::COLORS as $color)
                  <option value="{{ $color }}" @selected($c->color === $color)><span class="bn-swatch {{ $color }}"></span>{{ ucfirst($color) }}</option>
                @endforeach
              </select>
              <input type="text" name="icon" class="db-form-control" maxlength="60" value="{{ $c->icon }}" placeholder="fa-newspaper" style="min-width:140px">
              <button type="submit" class="bn-btn-ghost"><i class="fas fa-floppy-disk"></i> Simpan</button>
            </form>
            <span class="bn-cat-key">
              <span class="bn-swatch {{ $c->color }}"></span><code>{{ $c->key }}</code>
            </span>
          </div>
        </div>

        <div class="bn-row-actions">
          <form action="{{ route('admin.berita.categories.move', [$c, 'up']) }}" method="POST" class="bn-inline">
            @csrf
            <button type="submit" class="bn-mini" title="Naikkan" @disabled($loop->first)><i class="fas fa-arrow-up"></i></button>
          </form>
          <form action="{{ route('admin.berita.categories.move', [$c, 'down']) }}" method="POST" class="bn-inline">
            @csrf
            <button type="submit" class="bn-mini" title="Turunkan" @disabled($loop->last)><i class="fas fa-arrow-down"></i></button>
          </form>
          <form action="{{ route('admin.berita.categories.destroy', $c) }}" method="POST" class="bn-inline"
                onsubmit="return confirm('Hapus kategori ini? Berita dan cerita yang memakainya menjadi tanpa kategori.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bn-mini danger" title="Hapus"><i class="fas fa-trash"></i></button>
          </form>
        </div>
      </div>
    @empty
      <div class="bn-empty">Belum ada kategori.</div>
    @endforelse
  </div>

  <form action="{{ route('admin.berita.categories.store') }}" method="POST" class="bn-cat-row" style="margin-top:.4rem">
    @csrf
    <input type="text" name="label" class="db-form-control" maxlength="60" required placeholder="Nama kategori baru, mis. Lomba" style="flex:1;min-width:160px">
    <select name="color" class="db-form-control" style="min-width:150px">
      @foreach(\App\Models\BeritaCategory::COLORS as $color)
        <option value="{{ $color }}">{{ ucfirst($color) }}</option>
      @endforeach
    </select>
    <input type="text" name="icon" class="db-form-control" maxlength="60" placeholder="fa-newspaper" style="min-width:140px">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-plus"></i> Tambah</button>
  </form>

  <div class="bn-hint" style="margin-top:1rem">
    Warna menentukan tampilan chip kategori di kartu berita (warna sudah disiapkan sesuai tema halaman).
    Ikon berupa nama class FontAwesome, mis. <code>fa-trophy</code>.
  </div>
</div>
