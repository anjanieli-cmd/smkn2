{{-- Tab Teks Halaman. Variabel: $s --}}
<form action="{{ route('admin.berita.settings.update') }}" method="POST">
  @csrf
  @method('PUT')

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Hero (bagian paling atas)</h2></div>

    <div class="db-form-group">
      <label>Label kecil di atas judul</label>
      <input type="text" name="hero_kicker" class="db-form-control" maxlength="150" value="{{ old('hero_kicker', $s['hero_kicker']) }}">
    </div>
    <div class="bn-grid-2">
      <div class="db-form-group">
        <label>Judul baris 1 (biru)</label>
        <input type="text" name="hero_title_1" class="db-form-control" maxlength="60" required value="{{ old('hero_title_1', $s['hero_title_1']) }}">
      </div>
      <div class="db-form-group">
        <label>Judul baris 2 (emas)</label>
        <input type="text" name="hero_title_2" class="db-form-control" maxlength="60" required value="{{ old('hero_title_2', $s['hero_title_2']) }}">
      </div>
    </div>

    <div class="bn-sub">Tiga label kecil di hero</div>
    <div class="bn-grid-2" style="grid-template-columns:repeat(3,1fr)">
      <div class="db-form-group">
        <label><i class="fas fa-newspaper"></i> Label 1</label>
        <input type="text" name="hero_pill_1" class="db-form-control" maxlength="80" value="{{ old('hero_pill_1', $s['hero_pill_1']) }}">
      </div>
      <div class="db-form-group">
        <label><i class="fas fa-database"></i> Label 2</label>
        <input type="text" name="hero_pill_2" class="db-form-control" maxlength="80" value="{{ old('hero_pill_2', $s['hero_pill_2']) }}">
      </div>
      <div class="db-form-group">
        <label><i class="fas fa-bolt"></i> Label 3</label>
        <input type="text" name="hero_pill_3" class="db-form-control" maxlength="80" value="{{ old('hero_pill_3', $s['hero_pill_3']) }}">
      </div>
    </div>
    <div class="bn-hint">Ikon tiap label tetap. Label 3 biasanya diisi jumlah artikel, mis. "28 Artikel" — diketik manual, tidak otomatis mengikuti jumlah berita aktif.</div>
  </div>

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Strip Edisi (pita biru berjalan)</h2></div>

    <div class="db-form-group">
      <label>Label kecil (pil kuning)</label>
      <input type="text" name="strip_label" class="db-form-control" maxlength="60" required value="{{ old('strip_label', $s['strip_label']) }}">
    </div>
    <div class="db-form-group">
      <label>Teks strip</label>
      <textarea name="strip_text" class="db-form-control" rows="2">{{ old('strip_text', $s['strip_text']) }}</textarea>
      <div class="bn-hint">Boleh pakai tagar di awal teks, mis. "#SkanedaBerkegiatan — Dokumentasi kegiatan...".</div>
    </div>
  </div>

  <div class="db-panel">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Ajakan penutup (paling bawah)</h2></div>

    <div class="bn-grid-2">
      <div class="db-form-group">
        <label>Judul (putih)</label>
        <input type="text" name="cta_title" class="db-form-control" maxlength="120" required value="{{ old('cta_title', $s['cta_title']) }}">
      </div>
      <div class="db-form-group">
        <label>Lanjutan judul (emas)</label>
        <input type="text" name="cta_title_gold" class="db-form-control" maxlength="120" value="{{ old('cta_title_gold', $s['cta_title_gold']) }}">
      </div>
    </div>
    <div class="db-form-group">
      <label>Paragraf</label>
      <textarea name="cta_text" class="db-form-control" rows="2">{{ old('cta_text', $s['cta_text']) }}</textarea>
    </div>
    <div class="bn-grid-2">
      <div class="db-form-group">
        <label>Teks tombol</label>
        <input type="text" name="cta_btn_text" class="db-form-control" maxlength="80" required value="{{ old('cta_btn_text', $s['cta_btn_text']) }}">
      </div>
      <div class="db-form-group">
        <label>Link tombol</label>
        <input type="text" name="cta_btn_url" class="db-form-control" maxlength="255" placeholder="Kosong = halaman Kontak" value="{{ old('cta_btn_url', $s['cta_btn_url']) }}">
        <div class="bn-hint">Kosong = otomatis ke <code>route('kontak')</code>.</div>
      </div>
    </div>
    <div class="db-form-group">
      <label>Catatan kecil di bawah tombol</label>
      <input type="text" name="cta_note" class="db-form-control" maxlength="200" value="{{ old('cta_note', $s['cta_note']) }}">
    </div>
  </div>

  <div class="bn-actions">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Semua Teks</button>
  </div>
</form>
