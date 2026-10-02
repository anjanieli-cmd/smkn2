{{-- Tab Hero & Teks Halaman. Variabel: $s --}}
<form action="{{ route('admin.struktur.settings.update', 'hero') }}" method="POST">
  @csrf
  @method('PUT')

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Hero (bagian paling atas halaman)</h2></div>

    <div class="st-grid-2">
      <div class="db-form-group">
        <label>Judul baris 1 (warna biru)</label>
        <input type="text" name="hero_title_1" class="db-form-control" maxlength="60" required value="{{ old('hero_title_1', $s['hero_title_1']) }}">
      </div>
      <div class="db-form-group">
        <label>Judul baris 2 (warna emas)</label>
        <input type="text" name="hero_title_2" class="db-form-control" maxlength="60" required value="{{ old('hero_title_2', $s['hero_title_2']) }}">
      </div>
    </div>

    <div class="st-sub">Tombol Virtual Tour di bawah judul</div>
    <div class="st-grid-2">
      <div class="db-form-group">
        <label>Teks utama tombol</label>
        <input type="text" name="hero_vt_title" class="db-form-control" maxlength="80" required value="{{ old('hero_vt_title', $s['hero_vt_title']) }}">
      </div>
      <div class="db-form-group">
        <label>Teks kecil di bawahnya</label>
        <input type="text" name="hero_vt_sub" class="db-form-control" maxlength="120" value="{{ old('hero_vt_sub', $s['hero_vt_sub']) }}">
      </div>
    </div>
    <div class="st-hint">Tombol ini menggulir halaman ke bagian Virtual Tour di bawah bagan.</div>
  </div>

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Judul Bagan Organisasi</h2></div>

    <div class="db-form-group">
      <label>Label kecil di atas judul</label>
      <input type="text" name="chart_eyebrow" class="db-form-control" maxlength="120" value="{{ old('chart_eyebrow', $s['chart_eyebrow']) }}">
    </div>
    <div class="st-grid-2">
      <div class="db-form-group">
        <label>Judul (warna biru)</label>
        <input type="text" name="chart_heading" class="db-form-control" maxlength="80" required value="{{ old('chart_heading', $s['chart_heading']) }}">
      </div>
      <div class="db-form-group">
        <label>Lanjutan judul (emas)</label>
        <input type="text" name="chart_heading_gold" class="db-form-control" maxlength="80" value="{{ old('chart_heading_gold', $s['chart_heading_gold']) }}">
      </div>
    </div>
  </div>

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Bagian Virtual Tour 360°</h2></div>

    <div class="db-form-group">
      <label>Label kecil</label>
      <input type="text" name="vt_kicker" class="db-form-control" maxlength="120" value="{{ old('vt_kicker', $s['vt_kicker']) }}">
    </div>
    <div class="st-grid-3">
      <div class="db-form-group">
        <label>Judul (biru)</label>
        <input type="text" name="vt_title" class="db-form-control" maxlength="80" required value="{{ old('vt_title', $s['vt_title']) }}">
      </div>
      <div class="db-form-group">
        <label>Lanjutan judul (emas)</label>
        <input type="text" name="vt_title_gold" class="db-form-control" maxlength="80" value="{{ old('vt_title_gold', $s['vt_title_gold']) }}">
      </div>
      <div class="db-form-group">
        <label>Anak judul (kecil)</label>
        <input type="text" name="vt_sub" class="db-form-control" maxlength="120" value="{{ old('vt_sub', $s['vt_sub']) }}">
      </div>
    </div>
    <div class="db-form-group">
      <label>Paragraf</label>
      <textarea name="vt_desc" class="db-form-control" rows="3">{{ old('vt_desc', $s['vt_desc']) }}</textarea>
    </div>
    <div class="st-grid-2">
      <div class="db-form-group">
        <label>Teks tombol</label>
        <input type="text" name="vt_button_text" class="db-form-control" maxlength="60" required value="{{ old('vt_button_text', $s['vt_button_text']) }}">
      </div>
      <div class="db-form-group">
        <label>Link tombol (opsional)</label>
        <input type="text" name="vt_button_url" class="db-form-control" maxlength="255" placeholder="kosong = otomatis ke halaman Virtual Tour" value="{{ old('vt_button_url', $s['vt_button_url']) }}">
        <div class="st-hint">Boleh <code>/profil/virtual-tour</code> atau alamat lengkap <code>https://…</code></div>
      </div>
    </div>
  </div>

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Ajakan Penutup (kotak biru paling bawah)</h2></div>

    <div class="st-grid-2">
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
    <div class="st-grid-2">
      <div class="db-form-group">
        <label>Teks tombol</label>
        <input type="text" name="cta_button_text" class="db-form-control" maxlength="60" required value="{{ old('cta_button_text', $s['cta_button_text']) }}">
      </div>
      <div class="db-form-group">
        <label>Link tombol (opsional)</label>
        <input type="text" name="cta_button_url" class="db-form-control" maxlength="255" placeholder="kosong = otomatis ke halaman Guru & Staf" value="{{ old('cta_button_url', $s['cta_button_url']) }}">
      </div>
    </div>
  </div>

  <div style="display:flex;justify-content:flex-end">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Perubahan</button>
  </div>
</form>
