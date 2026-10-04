{{-- Tab Teks Halaman. Variabel: $s --}}
<form action="{{ route('admin.bkk.settings.update') }}" method="POST">
  @csrf
  @method('PUT')
  <input type="hidden" name="_tab" value="teks">

  {{-- ---------- HERO ---------- --}}
  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Hero (bagian paling atas)</h2></div>

    <div class="db-form-group">
      <label>Label kecil di atas judul</label>
      <input type="text" name="hero_kicker" class="db-form-control" maxlength="150" value="{{ old('hero_kicker', $s['hero_kicker']) }}">
    </div>
    <div class="bk-grid-2">
      <div class="db-form-group">
        <label>Judul baris 1 (biru)</label>
        <input type="text" name="hero_title_1" class="db-form-control" maxlength="60" required value="{{ old('hero_title_1', $s['hero_title_1']) }}">
      </div>
      <div class="db-form-group">
        <label>Judul baris 2 (emas)</label>
        <input type="text" name="hero_title_2" class="db-form-control" maxlength="60" required value="{{ old('hero_title_2', $s['hero_title_2']) }}">
      </div>
    </div>
    <div class="db-form-group">
      <label>Paragraf pengantar</label>
      <textarea name="hero_lead" class="db-form-control" rows="3">{{ old('hero_lead', $s['hero_lead']) }}</textarea>
    </div>

    <div class="bk-sub">Tiga label di panel samping hero</div>
    <div class="bk-grid-3">
      <div class="db-form-group">
        <label><i class="fas fa-briefcase"></i> Label 1</label>
        <input type="text" name="hero_pill_1" class="db-form-control" maxlength="80" value="{{ old('hero_pill_1', $s['hero_pill_1']) }}">
      </div>
      <div class="db-form-group">
        <label><i class="fas fa-building"></i> Label 2</label>
        <input type="text" name="hero_pill_2" class="db-form-control" maxlength="80" value="{{ old('hero_pill_2', $s['hero_pill_2']) }}">
      </div>
      <div class="db-form-group">
        <label><i class="fas fa-user-graduate"></i> Label 3</label>
        <input type="text" name="hero_pill_3" class="db-form-control" maxlength="80" value="{{ old('hero_pill_3', $s['hero_pill_3']) }}">
      </div>
    </div>
    <div class="bk-hint">Ikon tiap label tetap. Label yang dikosongkan tidak tampil; kalau ketiganya kosong, panel samping disembunyikan.</div>
  </div>

  {{-- ---------- STRIP ---------- --}}
  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Strip Biru (di bawah hero)</h2></div>

    <div class="db-form-group">
      <label>Label kecil (pil kuning)</label>
      <input type="text" name="strip_label" class="db-form-control" maxlength="60" required value="{{ old('strip_label', $s['strip_label']) }}">
    </div>
    <div class="db-form-group">
      <label>Teks strip</label>
      <textarea name="strip_text" class="db-form-control" rows="2">{{ old('strip_text', $s['strip_text']) }}</textarea>
    </div>
  </div>

  {{-- ---------- JUDUL BAGIAN ---------- --}}
  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head">
      <h2 style="font-size:.9rem">Judul Bagian Mitra Industri &amp; Lowongan</h2>
      <span style="font-size:.72rem;color:var(--text-muted)">Judul bagian "Tentang BKK" diatur di tab Tentang BKK.</span>
    </div>

    <div class="bk-sub">Bagian Mitra Industri</div>
    <div class="db-form-group">
      <label>Label kecil</label>
      <input type="text" name="partners_eyebrow" class="db-form-control" maxlength="80" value="{{ old('partners_eyebrow', $s['partners_eyebrow']) }}">
    </div>
    <div class="bk-grid-2">
      <div class="db-form-group">
        <label>Judul (biasa)</label>
        <input type="text" name="partners_title" class="db-form-control" maxlength="80" required value="{{ old('partners_title', $s['partners_title']) }}">
      </div>
      <div class="db-form-group">
        <label>Lanjutan judul (garis kuning)</label>
        <input type="text" name="partners_title_em" class="db-form-control" maxlength="80" value="{{ old('partners_title_em', $s['partners_title_em']) }}">
      </div>
    </div>
    <div class="db-form-group">
      <label>Kalimat pengantar</label>
      <textarea name="partners_sub" class="db-form-control" rows="2">{{ old('partners_sub', $s['partners_sub']) }}</textarea>
    </div>

    <div class="bk-sub">Bagian Lowongan</div>
    <div class="db-form-group">
      <label>Label kecil</label>
      <input type="text" name="jobs_eyebrow" class="db-form-control" maxlength="80" value="{{ old('jobs_eyebrow', $s['jobs_eyebrow']) }}">
    </div>
    <div class="bk-grid-2">
      <div class="db-form-group">
        <label>Judul (biasa)</label>
        <input type="text" name="jobs_title" class="db-form-control" maxlength="80" required value="{{ old('jobs_title', $s['jobs_title']) }}">
      </div>
      <div class="db-form-group">
        <label>Lanjutan judul (garis kuning)</label>
        <input type="text" name="jobs_title_em" class="db-form-control" maxlength="80" value="{{ old('jobs_title_em', $s['jobs_title_em']) }}">
      </div>
    </div>
    <div class="db-form-group">
      <label>Kalimat pengantar</label>
      <textarea name="jobs_sub" class="db-form-control" rows="2">{{ old('jobs_sub', $s['jobs_sub']) }}</textarea>
    </div>
  </div>

  {{-- ---------- CATATAN ---------- --}}
  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Kotak Catatan (di bawah daftar lowongan)</h2></div>

    <div class="db-form-group">
      <label>Teks catatan</label>
      <textarea name="notice_text" class="db-form-control" rows="2">{{ old('notice_text', $s['notice_text']) }}</textarea>
    </div>
    <div class="db-form-group">
      <label>Bagian yang ditebalkan (di akhir kalimat)</label>
      <input type="text" name="notice_bold" class="db-form-control" maxlength="150" value="{{ old('notice_bold', $s['notice_bold']) }}">
      <div class="bk-hint">Titik di ujung kalimat ditambahkan otomatis. Kedua kolom kosong = kotak catatan disembunyikan.</div>
    </div>
  </div>

  {{-- ---------- CTA ---------- --}}
  <div class="db-panel">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Ajakan Penutup (paling bawah)</h2></div>

    <div class="bk-grid-2">
      <div class="db-form-group">
        <label>Judul (putih)</label>
        <input type="text" name="cta_title" class="db-form-control" maxlength="120" required value="{{ old('cta_title', $s['cta_title']) }}">
      </div>
      <div class="db-form-group">
        <label>Lanjutan judul (emas)</label>
        <input type="text" name="cta_title_em" class="db-form-control" maxlength="120" value="{{ old('cta_title_em', $s['cta_title_em']) }}">
      </div>
    </div>
    <div class="db-form-group">
      <label>Paragraf</label>
      <textarea name="cta_text" class="db-form-control" rows="2">{{ old('cta_text', $s['cta_text']) }}</textarea>
    </div>
    <div class="bk-grid-2">
      <div class="db-form-group">
        <label>Teks tombol (opsional)</label>
        <input type="text" name="cta_btn_text" class="db-form-control" maxlength="80" placeholder="mis. Hubungi BKK" value="{{ old('cta_btn_text', $s['cta_btn_text']) }}">
      </div>
      <div class="db-form-group">
        <label>Link tombol</label>
        <input type="text" name="cta_btn_url" class="db-form-control" maxlength="255" placeholder="https://wa.me/62..., mailto:..., atau /kontak" value="{{ old('cta_btn_url', $s['cta_btn_url']) }}">
        <div class="bk-hint">Tombol hanya tampil kalau teks <b>dan</b> link sama-sama diisi.</div>
      </div>
    </div>
  </div>

  <div class="bk-actions">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Semua Teks</button>
  </div>
</form>
