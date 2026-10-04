{{-- Tab Teks Halaman. Variabel: $s --}}
@php
  $in = fn ($key, $max = 200, $req = false) => '<input type="text" name="'.$key.'" class="db-form-control" maxlength="'.$max.'" '.($req ? 'required ' : '').'value="'.e(old($key, $s[$key])).'">';
  $ta = fn ($key, $rows = 3) => '<textarea name="'.$key.'" class="db-form-control" rows="'.$rows.'" maxlength="2000">'.e(old($key, $s[$key])).'</textarea>';
@endphp

<form action="{{ route('admin.karya.settings.update') }}" method="POST">
  @csrf
  @method('PUT')

  {{-- ================= HERO ================= --}}
  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Hero (bagian paling atas)</h2></div>

    <div class="db-form-group">
      <label>Label kecil di atas judul</label>
      {!! $in('hero_kicker', 150) !!}
    </div>
    <div class="kr-grid-2">
      <div class="db-form-group">
        <label>Judul baris 1 (biru tua)</label>
        {!! $in('hero_title_1', 60, true) !!}
      </div>
      <div class="db-form-group">
        <label>Judul baris 2 (emas)</label>
        {!! $in('hero_title_2', 60, true) !!}
      </div>
    </div>
    <div class="kr-hint">Tulisan besar "KARYA" di latar hero adalah bagian desain dan tidak diubah dari sini.</div>
  </div>

  {{-- ================= PENGANTAR ================= --}}
  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Pengantar "Karya nyata, buah dari belajar"</h2></div>

    <div class="kr-grid-2">
      <div class="db-form-group">
        <label>Judul (biru tua)</label>
        {!! $in('intro_title', 100, true) !!}
      </div>
      <div class="db-form-group">
        <label>Lanjutan judul (emas)</label>
        {!! $in('intro_title_em', 100) !!}
      </div>
    </div>
    <div class="db-form-group">
      <label>Catatan di bawah judul</label>
      {!! $ta('intro_note', 3) !!}
    </div>

    <div class="kr-sub">Tiga angka statistik</div>
    <div class="kr-grid-3">
      @foreach([1, 2, 3] as $n)
        <div class="db-form-group">
          <label>Statistik {{ $n }}</label>
          {!! $in("stat_{$n}_num", 20) !!}
          <div style="height:.45rem"></div>
          {!! $in("stat_{$n}_label", 60) !!}
          <div class="kr-hint">Angka di atas, keterangan di bawah. Kosongkan angka untuk menyembunyikan.</div>
        </div>
      @endforeach
    </div>

    <div class="kr-sub">Teks di sisi kanan</div>
    <div class="db-form-group">
      <label>Judul kecil di atas chip bidang</label>
      {!! $in('cat_line', 120) !!}
      <div class="kr-hint">Chip bidang dibuat otomatis dari tab Bidang / Kategori. Kosongkan untuk menyembunyikan chip.</div>
    </div>
    <div class="db-form-group">
      <label>Paragraf 1</label>
      {!! $ta('blurb_1', 5) !!}
      <div class="kr-hint">Apit kata dengan <code>**dua bintang**</code> agar tampil tebal.</div>
    </div>
    <div class="db-form-group">
      <label>Paragraf 2</label>
      {!! $ta('blurb_2', 4) !!}
    </div>
  </div>

  {{-- ================= SLIDER ================= --}}
  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Slider "Galeri karya pilihan"</h2></div>
    <div class="kr-grid-2">
      <div class="db-form-group">
        <label>Judul (biru tua)</label>
        {!! $in('slider_title', 100, true) !!}
      </div>
      <div class="db-form-group">
        <label>Lanjutan judul (emas)</label>
        {!! $in('slider_title_em', 100) !!}
      </div>
    </div>
    <div class="db-form-group">
      <label>Catatan di sebelah judul</label>
      {!! $ta('slider_note', 2) !!}
    </div>
  </div>

  {{-- ================= BIDANG ================= --}}
  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Bagian "Lima bidang, ratusan karya"</h2></div>
    <div class="kr-grid-2">
      <div class="db-form-group">
        <label>Judul (biru tua)</label>
        {!! $in('kat_title', 100, true) !!}
      </div>
      <div class="db-form-group">
        <label>Lanjutan judul (emas)</label>
        {!! $in('kat_title_em', 100) !!}
      </div>
    </div>
    <div class="db-form-group">
      <label>Catatan di sebelah judul</label>
      {!! $ta('kat_note', 2) !!}
    </div>
  </div>

  {{-- ================= PRODUK ================= --}}
  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Bagian "Produk nyata, karya siswa sendiri"</h2></div>
    <div class="kr-grid-2">
      <div class="db-form-group">
        <label>Judul (biru tua)</label>
        {!! $in('prod_title', 100, true) !!}
      </div>
      <div class="db-form-group">
        <label>Lanjutan judul (emas)</label>
        {!! $in('prod_title_em', 100) !!}
      </div>
    </div>
    <div class="db-form-group">
      <label>Catatan di sebelah judul</label>
      {!! $ta('prod_note', 2) !!}
    </div>
  </div>

  {{-- ================= CTA ================= --}}
  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Ajakan penutup (CTA)</h2></div>
    <div class="kr-grid-2">
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
      {!! $ta('cta_text', 3) !!}
    </div>
    <div class="kr-grid-2">
      <div class="db-form-group">
        <label>Teks tombol</label>
        {!! $in('cta_btn_text', 60, true) !!}
      </div>
      <div class="db-form-group">
        <label>Link tombol</label>
        {!! $in('cta_btn_url', 255) !!}
        <div class="kr-hint">Kosong = halaman Kontak. Boleh <code>/kontak</code>, <code>https://…</code> atau <code>#</code>.</div>
      </div>
    </div>
    <div class="db-form-group">
      <label><i class="fas fa-info-circle"></i> Catatan kecil di bawah tombol</label>
      {!! $in('cta_note', 200) !!}
      <div class="kr-hint">Kosongkan untuk menyembunyikan.</div>
    </div>
  </div>

  <div class="kr-actions">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Semua Teks</button>
  </div>
</form>
