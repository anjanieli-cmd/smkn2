<form action="{{ route('admin.visi-misi.settings.update', 'hero') }}" method="POST">
  @csrf
  @method('PUT')

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Hero (bagian paling atas halaman)</h2></div>

    <div class="db-form-group">
      <label>Label kecil di atas judul</label>
      <input type="text" name="hero_kicker" class="db-form-control" maxlength="120" value="{{ old('hero_kicker', $s['hero_kicker']) }}">
    </div>

    <div class="vm-grid-2">
      <div class="db-form-group">
        <label>Judul baris 1 (warna biru)</label>
        <input type="text" name="hero_title_1" class="db-form-control" maxlength="60" required value="{{ old('hero_title_1', $s['hero_title_1']) }}">
      </div>
      <div class="db-form-group">
        <label>Judul baris 2 (warna emas)</label>
        <input type="text" name="hero_title_2" class="db-form-control" maxlength="60" required value="{{ old('hero_title_2', $s['hero_title_2']) }}">
      </div>
    </div>

    <div class="db-form-group">
      <label>Paragraf pembuka</label>
      <textarea name="hero_lead" class="db-form-control" rows="4">{{ old('hero_lead', $s['hero_lead']) }}</textarea>
    </div>

    <div class="vm-sub">Tiga label kecil di bawah paragraf</div>
    <div class="vm-grid-2" style="grid-template-columns:repeat(3,1fr)">
      <div class="db-form-group">
        <label><i class="fas fa-bullseye"></i> Label 1</label>
        <input type="text" name="hero_pill_1" class="db-form-control" maxlength="40" value="{{ old('hero_pill_1', $s['hero_pill_1']) }}">
      </div>
      <div class="db-form-group">
        <label><i class="fas fa-flag"></i> Label 2</label>
        <input type="text" name="hero_pill_2" class="db-form-control" maxlength="40" value="{{ old('hero_pill_2', $s['hero_pill_2']) }}">
      </div>
      <div class="db-form-group">
        <label><i class="fas fa-gem"></i> Label 3</label>
        <input type="text" name="hero_pill_3" class="db-form-control" maxlength="40" value="{{ old('hero_pill_3', $s['hero_pill_3']) }}">
      </div>
    </div>
    <div class="vm-hint">Ikon di setiap label tetap. Kosongkan teksnya kalau label ingin dikosongkan.</div>
  </div>

  <div class="db-panel">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Ajakan bergabung (bagian paling bawah halaman)</h2></div>

    <div class="vm-grid-2">
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
      <textarea name="cta_text" class="db-form-control" rows="3">{{ old('cta_text', $s['cta_text']) }}</textarea>
    </div>

    <div class="vm-grid-2">
      <div class="db-form-group">
        <label>Teks tombol</label>
        <input type="text" name="cta_button_text" class="db-form-control" maxlength="80" required value="{{ old('cta_button_text', $s['cta_button_text']) }}">
      </div>
      <div class="db-form-group">
        <label>Link tombol</label>
        <input type="text" name="cta_button_url" class="db-form-control" maxlength="255" placeholder="Kosongkan = ke beranda bagian PPDB" value="{{ old('cta_button_url', $s['cta_button_url']) }}">
        <div class="vm-hint">Boleh <code>https://...</code>, <code>/ppdb</code>, atau <code>#ppdb</code>. Kosong = otomatis ke beranda #ppdb.</div>
      </div>
    </div>
  </div>

  <div class="vm-actions">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan</button>
  </div>
</form>
