{{-- Tab Penempatan. Variabel: $articles, $placements --}}
<form action="{{ route('admin.berita.placements.update') }}" method="POST">
  @csrf
  @method('PUT')

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="bn-slot-head">
      <h3><i class="fas fa-star"></i> Featured Besar</h3>
      <span>1 berita — ditampilkan besar di atas "Berita Terkini"</span>
    </div>
    <div class="bn-slot-rows">
      <div class="bn-slot-row">
        <span class="bn-no">01</span>
        <select name="featured[0]" class="db-form-control">
          <option value="">— Kosong —</option>
          @foreach($articles as $a)
            <option value="{{ $a->id }}" @selected((int) ($placements['featured'][0] ?? null) === $a->id)>{{ $a->title }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="bn-slot-head">
      <h3><i class="fas fa-list"></i> Berita Samping</h3>
      <span>4 berita — kolom kecil di sebelah featured</span>
    </div>
    <div class="bn-slot-rows">
      @for($i = 0; $i < 4; $i++)
        <div class="bn-slot-row">
          <span class="bn-no">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
          <select name="side[{{ $i }}]" class="db-form-control">
            <option value="">— Kosong —</option>
            @foreach($articles as $a)
              <option value="{{ $a->id }}" @selected((int) ($placements['side'][$i] ?? null) === $a->id)>{{ $a->title }}</option>
            @endforeach
          </select>
        </div>
      @endfor
    </div>
  </div>

  <div class="db-panel">
    <div class="bn-slot-head">
      <h3><i class="fas fa-ranking-star"></i> Artikel Pilihan (sidebar)</h3>
      <span>5 berita — daftar bernomor di samping "Berita Terbaru"</span>
    </div>
    <div class="bn-slot-rows">
      @for($i = 0; $i < 5; $i++)
        <div class="bn-slot-row">
          <span class="bn-no">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
          <select name="most_read[{{ $i }}]" class="db-form-control">
            <option value="">— Kosong —</option>
            @foreach($articles as $a)
              <option value="{{ $a->id }}" @selected((int) ($placements['most_read'][$i] ?? null) === $a->id)>{{ $a->title }}</option>
            @endforeach
          </select>
        </div>
      @endfor
    </div>
  </div>

  <div class="bn-hint" style="margin:1rem 0">
    Berita yang dipilih di sini tetap muncul juga di daftar "Berita Terbaru" biasa (kecuali featured, yang disembunyikan dari daftar supaya tidak dobel).
    Slot yang dikosongkan tidak akan tampil di halaman publik.
  </div>

  <div class="bn-actions">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Penempatan</button>
  </div>
</form>
