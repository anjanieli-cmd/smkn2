{{-- Tab Teks Halaman. Variabel: $s --}}
@php
  $in = fn ($key, $max = 200, $req = false) => '<input type="text" name="'.$key.'" class="db-form-control" maxlength="'.$max.'" '.($req ? 'required ' : '').'value="'.e(old($key, $s[$key])).'">';
@endphp

<form action="{{ route('admin.kegiatan.settings.update') }}" method="POST">
  @csrf
  @method('PUT')

  {{-- ================= HERO ================= --}}
  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Hero (bagian paling atas)</h2></div>

    <div class="db-form-group">
      <label>Label kecil di atas judul</label>
      {!! $in('hero_kicker', 150) !!}
    </div>
    <div class="kd-grid-2">
      <div class="db-form-group">
        <label>Judul baris 1 (biru tua)</label>
        {!! $in('hero_title_1', 60, true) !!}
      </div>
      <div class="db-form-group">
        <label>Judul baris 2 (emas)</label>
        {!! $in('hero_title_2', 60, true) !!}
      </div>
    </div>
    <div class="db-form-group">
      <label>Paragraf pembuka</label>
      <textarea name="hero_lead" class="db-form-control" rows="2" maxlength="2000">{{ old('hero_lead', $s['hero_lead']) }}</textarea>
    </div>

    <div class="kd-sub">Tiga label kecil di hero</div>
    <div class="kd-grid-3">
      <div class="db-form-group">
        <label><i class="fas fa-camera"></i> Label 1</label>
        {!! $in('hero_pill_1', 80) !!}
      </div>
      <div class="db-form-group">
        <label><i class="fas fa-calendar-alt"></i> Label 2</label>
        {!! $in('hero_pill_2', 80) !!}
      </div>
      <div class="db-form-group">
        <label><i class="fas fa-users"></i> Label 3</label>
        {!! $in('hero_pill_3', 80) !!}
      </div>
    </div>
    <div class="kd-hint">Ikon tiap label tetap. Tulisan besar "KEGIATAN" di latar hero adalah bagian desain dan tidak diubah dari sini.</div>
  </div>

  {{-- ================= PEMBUKA ================= --}}
  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Pembuka "Aktivitas Skaneda"</h2></div>

    <div class="db-form-group">
      <label>Label kecil (eyebrow)</label>
      {!! $in('intro_eyebrow', 100) !!}
    </div>
    <div class="kd-grid-3">
      <div class="db-form-group">
        <label>Judul baris 1</label>
        {!! $in('intro_title_1', 80, true) !!}
      </div>
      <div class="db-form-group">
        <label>Judul baris 2 (awal)</label>
        {!! $in('intro_title_2', 80) !!}
      </div>
      <div class="db-form-group">
        <label>Kata emas (akhir baris 2)</label>
        {!! $in('intro_title_em', 80) !!}
      </div>
    </div>
    <div class="db-form-group">
      <label>Paragraf</label>
      <textarea name="intro_text" class="db-form-control" rows="3" maxlength="2000">{{ old('intro_text', $s['intro_text']) }}</textarea>
    </div>
    <div class="db-form-group">
      <label><i class="fas fa-leaf"></i> Label penghargaan (pil kecil)</label>
      {!! $in('intro_pill', 100) !!}
      <div class="kd-hint">Kosongkan untuk menyembunyikan pil ini.</div>
    </div>

    <div class="kd-sub">Empat angka statistik</div>
    <div class="kd-grid-4">
      @foreach([1, 2, 3, 4] as $n)
        <div class="db-form-group">
          <label>Statistik {{ $n }}</label>
          {!! $in("stat_{$n}_num", 20) !!}
          <div style="height:.45rem"></div>
          {!! $in("stat_{$n}_label", 60) !!}
          <div class="kd-hint">Angka di atas, keterangan di bawah.</div>
        </div>
      @endforeach
    </div>
    <div class="kd-hint">Angka diketik manual (mis. "20+", "100%") — tidak otomatis menghitung jumlah album. Kosongkan angka untuk menyembunyikan satu statistik.</div>

    <div class="kd-sub">Kutipan</div>
    <div class="db-form-group">
      <label>Isi kutipan</label>
      <textarea name="quote_text" class="db-form-control" rows="2" maxlength="2000">{{ old('quote_text', $s['quote_text']) }}</textarea>
      <div class="kd-hint">Kosongkan untuk menyembunyikan kutipan. Tanda kutip dipasang otomatis.</div>
    </div>
    <div class="kd-grid-2">
      <div class="db-form-group">
        <label>Nama / jabatan penutur</label>
        {!! $in('quote_author', 120) !!}
      </div>
      <div class="db-form-group">
        <label>Stempel hashtag (pojok kanan)</label>
        {!! $in('quote_stamp', 60) !!}
      </div>
    </div>
  </div>

  {{-- ================= GALERI ================= --}}
  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Judul bagian "Jejak Kegiatan" (galeri)</h2></div>
    <div class="db-form-group">
      <label>Label kecil (eyebrow)</label>
      {!! $in('gallery_eyebrow', 100) !!}
    </div>
    <div class="kd-grid-2">
      <div class="db-form-group">
        <label>Judul (biru tua)</label>
        {!! $in('gallery_title', 80, true) !!}
      </div>
      <div class="db-form-group">
        <label>Lanjutan judul (emas)</label>
        {!! $in('gallery_title_em', 80) !!}
      </div>
    </div>
    <div class="db-form-group">
      <label>Paragraf</label>
      <textarea name="gallery_text" class="db-form-control" rows="2" maxlength="2000">{{ old('gallery_text', $s['gallery_text']) }}</textarea>
    </div>
    <div class="db-form-group">
      <label>Teks bantuan kolom pencarian</label>
      {!! $in('gallery_search_hint', 80) !!}
    </div>
  </div>

  {{-- ================= KALENDER ================= --}}
  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head">
      <h2 style="font-size:.9rem">Judul bagian "Perjalanan Satu Tahun"</h2>
      <span style="font-size:.72rem;color:var(--text-muted)">Kartu bulannya diatur di tab Kalender Tahunan</span>
    </div>
    <div class="db-form-group">
      <label>Label kecil (eyebrow)</label>
      {!! $in('year_eyebrow', 100) !!}
    </div>
    <div class="kd-grid-2">
      <div class="db-form-group">
        <label>Judul (putih)</label>
        {!! $in('year_title', 80, true) !!}
      </div>
      <div class="db-form-group">
        <label>Lanjutan judul (emas)</label>
        {!! $in('year_title_em', 80) !!}
      </div>
    </div>
    <div class="db-form-group">
      <label>Paragraf</label>
      <textarea name="year_text" class="db-form-control" rows="2" maxlength="2000">{{ old('year_text', $s['year_text']) }}</textarea>
    </div>
  </div>

  {{-- ================= MOMEN PILIHAN ================= --}}
  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head">
      <h2 style="font-size:.9rem">Judul bagian "Momen Pilihan"</h2>
      <span style="font-size:.72rem;color:var(--text-muted)">Fotonya diatur di tab Sorotan</span>
    </div>
    <div class="db-form-group">
      <label>Label kecil (eyebrow)</label>
      {!! $in('picks_eyebrow', 100) !!}
    </div>
    <div class="kd-grid-2">
      <div class="db-form-group">
        <label>Judul (biru tua)</label>
        {!! $in('picks_title', 80, true) !!}
      </div>
      <div class="db-form-group">
        <label>Lanjutan judul (emas)</label>
        {!! $in('picks_title_em', 80) !!}
      </div>
    </div>
    <div class="db-form-group">
      <label>Paragraf</label>
      <textarea name="picks_text" class="db-form-control" rows="2" maxlength="2000">{{ old('picks_text', $s['picks_text']) }}</textarea>
    </div>
  </div>

  {{-- ================= CTA ================= --}}
  <div class="db-panel">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Ajakan penutup (paling bawah)</h2></div>

    <div class="kd-grid-2">
      <div class="db-form-group">
        <label>Judul (putih)</label>
        {!! $in('cta_title', 120, true) !!}
      </div>
      <div class="db-form-group">
        <label>Lanjutan judul (emas)</label>
        {!! $in('cta_title_em', 120) !!}
      </div>
    </div>
    <div class="db-form-group">
      <label>Paragraf</label>
      <textarea name="cta_text" class="db-form-control" rows="2" maxlength="2000">{{ old('cta_text', $s['cta_text']) }}</textarea>
    </div>
    <div class="kd-grid-2">
      <div class="db-form-group">
        <label>Teks tombol</label>
        {!! $in('cta_btn_text', 80, true) !!}
      </div>
      <div class="db-form-group">
        <label>Link tombol</label>
        <input type="text" name="cta_btn_url" class="db-form-control" maxlength="255" placeholder="Kosong = halaman Kontak" value="{{ old('cta_btn_url', $s['cta_btn_url']) }}">
        <div class="kd-hint">Kosong = otomatis ke <code>route('kontak')</code>. Boleh diawali <code>http://</code>, <code>https://</code>, <code>/</code> atau <code>#</code>.</div>
      </div>
    </div>
  </div>

  <div class="kd-actions">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Semua Teks</button>
  </div>
</form>
