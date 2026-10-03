@extends('layouts.admin')

@section('title', 'Konten Beranda — Admin')

@push('styles')
  @include('admin.partials.form-kit')
  <style>
    .ad-photo-row{display:flex;align-items:center;gap:1.2rem;flex-wrap:wrap}
    .ad-photo-box{width:110px;height:140px;border-radius:14px;overflow:hidden;border:1px solid rgba(255,255,255,.16);background:rgba(255,255,255,.06);flex-shrink:0}
    .ad-photo-box img{width:100%;height:100%;object-fit:cover;display:block}
    .ad-tabs .ad-tab-btn{white-space:nowrap}
  </style>
@endpush

@section('content')
@php
  $photoPath = $settings['sambutan_photo'] ?? '';
  $photoSrc  = $photoPath ? (str_starts_with($photoPath, 'http') ? $photoPath : asset($photoPath)) : null;
@endphp

<div class="db-panel-head">
  <div>
    <h2><i class="fas fa-house" style="color:var(--gold);margin-right:.5rem"></i> Konten Beranda</h2>
    <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Atur isi halaman beranda per bagian. Pilih tab di bawah, lalu klik Simpan di tab yang sama.</p>
  </div>
  <div class="db-panel-actions">
    <a href="{{ route('home') }}" target="_blank" rel="noopener" class="db-btn db-btn-ghost">
      <i class="fas fa-arrow-up-right-from-square"></i> Lihat Beranda
    </a>
  </div>
</div>

@include('admin.partials.flash')

<div class="ad-tabs">
  <button type="button" class="ad-tab-btn active" data-tab="hero"><i class="fas fa-star"></i> Hero</button>
  <button type="button" class="ad-tab-btn" data-tab="sambutan"><i class="fas fa-user-tie"></i> Sambutan Kepala Sekolah</button>
  <button type="button" class="ad-tab-btn" data-tab="industri"><i class="fas fa-handshake"></i> Kerja Sama Industri</button>
  <button type="button" class="ad-tab-btn" data-tab="prestasi"><i class="fas fa-trophy"></i> Prestasi Sekolah</button>
  <button type="button" class="ad-tab-btn" data-tab="kontak"><i class="fas fa-location-dot"></i> Kontak &amp; Lokasi</button>
</div>

{{-- =====================================================================
     FORM 1: Hero + Sambutan + Kontak (tiga tab ini disimpan bersamaan)
     ===================================================================== --}}
<form action="{{ route('admin.general.update') }}" method="POST" enctype="multipart/form-data" id="generalForm">
  @csrf
  @method('PUT')
  <input type="hidden" name="_tab" id="generalTab" value="hero">

  {{-- ================= TAB: HERO ================= --}}
  <div class="ad-tab-panel active" data-panel="hero">
    <div class="db-panel">
      <div class="db-panel-head"><h2 style="font-size:.9rem">Hero Beranda</h2></div>
      <div class="db-form-group">
        <label>Teks kecil di atas judul</label>
        <input type="text" name="hero_eyebrow" class="db-form-control" maxlength="255" value="{{ old('hero_eyebrow', $settings['hero_eyebrow']) }}">
      </div>
      <div class="db-form-group">
        <label>Deskripsi Hero</label>
        <textarea name="hero_desc" class="db-form-control">{{ old('hero_desc', $settings['hero_desc']) }}</textarea>
      </div>
      <small class="ad-hint">Judul "SMKN 2 MOJOKERTO" dan tombol hero tetap tertulis di tampilan.</small>
    </div>
    <div class="ad-save-bar">
      <span><i class="fas fa-circle-info"></i> Tab Hero, Sambutan, dan Kontak disimpan bersamaan.</span>
      <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan</button>
    </div>
  </div>

  {{-- ================= TAB: SAMBUTAN ================= --}}
  <div class="ad-tab-panel" data-panel="sambutan">
    <div class="db-panel">
      <div class="db-panel-head"><h2 style="font-size:.9rem">Sambutan Kepala Sekolah</h2></div>

      <div class="db-form-group">
        <label>Foto Kepala Sekolah</label>
        <div class="ad-photo-row">
          <div class="ad-photo-box">
            <img id="sambutanPreview" src="{{ $photoSrc ?? '' }}" alt="Foto kepala sekolah" @if(!$photoSrc) style="display:none" @endif>
          </div>
          <div style="flex:1;min-width:220px">
            <input type="file" id="sambutanPhoto" name="sambutan_photo" class="db-form-control" accept="image/png,image/jpeg,image/webp">
            <small class="ad-hint">JPG, PNG, atau WEBP, maksimal 5 MB. Foto potret (berdiri) paling pas. Kosongkan kalau tidak ingin mengganti.</small>
          </div>
        </div>
      </div>

      <div class="ad-grid-2">
        <div class="db-form-group">
          <label>Nama Kepala Sekolah (dengan gelar)</label>
          <input type="text" name="sambutan_name" class="db-form-control" maxlength="255" value="{{ old('sambutan_name', $settings['sambutan_name']) }}">
        </div>
        <div class="db-form-group">
          <label>Jabatan</label>
          <input type="text" name="sambutan_role" class="db-form-control" maxlength="255" value="{{ old('sambutan_role', $settings['sambutan_role']) }}">
        </div>
      </div>

      <div class="db-form-group">
        <label>Kutipan (kalimat pendek yang disorot)</label>
        <textarea name="sambutan_quote" class="db-form-control" style="min-height:80px">{{ old('sambutan_quote', $settings['sambutan_quote']) }}</textarea>
        <small class="ad-hint">Tulis tanpa tanda kutip, tanda kutipnya ditambahkan otomatis di tampilan.</small>
      </div>

      <div class="db-form-group">
        <label>Isi Sambutan</label>
        <textarea name="sambutan_message" class="db-form-control" style="min-height:190px">{{ old('sambutan_message', $settings['sambutan_message']) }}</textarea>
      </div>
    </div>
    <div class="ad-save-bar">
      <span><i class="fas fa-circle-info"></i> Tab Hero, Sambutan, dan Kontak disimpan bersamaan.</span>
      <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan</button>
    </div>
  </div>

  {{-- ================= TAB: KONTAK ================= --}}
  <div class="ad-tab-panel" data-panel="kontak">
    <div class="db-panel">
      <div class="db-panel-head"><h2 style="font-size:.9rem">Kontak &amp; Lokasi ("Temukan Kami")</h2></div>
      <div class="ad-grid-2">
        <div class="db-form-group">
          <label>Kalimat sapaan</label>
          <input type="text" name="contact_sub" class="db-form-control" maxlength="255" value="{{ old('contact_sub', $settings['contact_sub']) }}">
        </div>
        <div class="db-form-group">
          <label>Kalimat penjelas</label>
          <input type="text" name="contact_line" class="db-form-control" maxlength="255" value="{{ old('contact_line', $settings['contact_line']) }}">
        </div>
      </div>
      <div class="db-form-group">
        <label>Alamat Lengkap</label>
        <textarea name="contact_address" class="db-form-control" style="min-height:80px">{{ old('contact_address', $settings['contact_address']) }}</textarea>
        <small class="ad-hint">Alamat ini juga dipakai untuk peta Google Maps dan tombol "Buka di Google Maps", jadi tulis selengkap mungkin.</small>
      </div>
      <div class="ad-grid-3">
        <div class="db-form-group">
          <label>Telepon</label>
          <input type="text" name="contact_phone" class="db-form-control" maxlength="50" value="{{ old('contact_phone', $settings['contact_phone']) }}">
        </div>
        <div class="db-form-group">
          <label>Email</label>
          <input type="email" name="contact_email" class="db-form-control" maxlength="255" value="{{ old('contact_email', $settings['contact_email']) }}">
        </div>
        <div class="db-form-group">
          <label>Jam Operasional</label>
          <input type="text" name="contact_hours" class="db-form-control" maxlength="255" value="{{ old('contact_hours', $settings['contact_hours']) }}">
        </div>
      </div>
    </div>
    <div class="ad-save-bar">
      <span><i class="fas fa-circle-info"></i> Tab Hero, Sambutan, dan Kontak disimpan bersamaan.</span>
      <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan</button>
    </div>
  </div>
</form>

{{-- =====================================================================
     FORM 2: Kerja Sama Industri (daftar logo)
     ===================================================================== --}}
<div class="ad-tab-panel" data-panel="industri">
  <form action="{{ route('admin.general.industry.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="db-panel">
      <div class="db-panel-head"><h2 style="font-size:.9rem">Kerja Sama Industri: Logo Berjalan</h2></div>
      <div id="industryList"></div>
      <button type="button" class="ad-add-btn" id="industryAdd"><i class="fas fa-plus"></i> Tambah Logo</button>
      <small class="ad-hint" style="margin-top:.8rem">
        Logo tampil berjalan otomatis di beranda, tanpa kotak dan tanpa nama. Nama hanya untuk teks alternatif gambar.
        Format PNG, JPG, WEBP, atau SVG, maksimal 4 MB. Sebaiknya berlatar transparan. Baris tanpa logo dihapus saat disimpan.
        Data ini terpisah dari halaman "DUDI &amp; Mitra Industri" milik BKK.
      </small>
    </div>

    <div class="ad-save-bar">
      <span><i class="fas fa-circle-info"></i> Hanya tab Kerja Sama Industri yang disimpan.</span>
      <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Kerja Sama Industri</button>
    </div>
  </form>
</div>

{{-- =====================================================================
     FORM 3: Prestasi Sekolah (kartu feed)
     ===================================================================== --}}
<div class="ad-tab-panel" data-panel="prestasi">
  <form action="{{ route('admin.general.achievements.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="db-panel">
      <div class="db-panel-head"><h2 style="font-size:.9rem">Prestasi Sekolah: Kartu Feed</h2></div>
      <div id="achievementList"></div>
      <button type="button" class="ad-add-btn" id="achievementAdd"><i class="fas fa-plus"></i> Tambah Kartu Prestasi</button>
      <small class="ad-hint" style="margin-top:.8rem">
        Urutan kartu sama dengan urutan di sini (kartu paling atas tampil paling kiri). Kartu tanpa judul dihapus saat disimpan.
        Gambar JPG, PNG, atau WEBP, maksimal 5 MB. Data ini terpisah dari halaman Prestasi Sekolah milik Galeri.
      </small>
    </div>

    <div class="ad-save-bar">
      <span><i class="fas fa-circle-info"></i> Hanya tab Prestasi Sekolah yang disimpan.</span>
      <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Prestasi Sekolah</button>
    </div>
  </form>
</div>

{{-- ================= TEMPLATE ================= --}}
<template id="tpl-industry">
  <div class="ad-repeater-item" data-item>
    <div class="ad-repeater-head">
      <strong data-label="Logo">Logo</strong>
      <div class="ad-repeater-controls">
        <button type="button" class="ad-icon-mini" data-move="up" title="Naikkan"><i class="fas fa-arrow-up"></i></button>
        <button type="button" class="ad-icon-mini" data-move="down" title="Turunkan"><i class="fas fa-arrow-down"></i></button>
        <button type="button" class="ad-icon-mini danger" data-remove title="Hapus"><i class="fas fa-trash"></i></button>
      </div>
    </div>
    <div class="db-form-group">
      <label>Nama Perusahaan</label>
      <input type="text" class="db-form-control" name="items[__I__][name]" placeholder="Contoh: Telkom Indonesia">
    </div>
    <div class="db-form-group">
      <label>Logo *</label>
      <input type="file" class="db-form-control" name="items[__I__][logo]" accept="image/png,image/jpeg,image/webp,image/svg+xml">
      <input type="hidden" name="items[__I__][existing_logo]" value="" data-existing>
      <div class="ad-logo-current" data-preview style="display:none">
        <div class="box"><img src="" alt=""></div>
        <span>Logo saat ini, pilih file baru untuk mengganti</span>
      </div>
    </div>
    <label class="ad-check-row">
      <input type="checkbox" name="items[__I__][is_active]" value="1" checked> Tampilkan di beranda
    </label>
  </div>
</template>

<template id="tpl-achievement">
  <div class="ad-repeater-item" data-item>
    <div class="ad-repeater-head">
      <strong data-label="Kartu">Kartu</strong>
      <div class="ad-repeater-controls">
        <button type="button" class="ad-icon-mini" data-move="up" title="Naikkan"><i class="fas fa-arrow-up"></i></button>
        <button type="button" class="ad-icon-mini" data-move="down" title="Turunkan"><i class="fas fa-arrow-down"></i></button>
        <button type="button" class="ad-icon-mini danger" data-remove title="Hapus"><i class="fas fa-trash"></i></button>
      </div>
    </div>

    <div class="db-form-group">
      <label>Gambar</label>
      <input type="file" class="db-form-control" name="cards[__I__][image]" accept="image/png,image/jpeg,image/webp">
      <input type="hidden" name="cards[__I__][existing_image]" value="" data-existing>
      <div class="ad-logo-current" data-preview style="display:none">
        <div class="box" style="width:150px;height:90px"><img src="" alt=""></div>
        <span>Gambar saat ini, pilih file baru untuk mengganti</span>
      </div>
    </div>

    <div class="ad-grid-2">
      <div class="db-form-group">
        <label>Tag (label kecil di atas judul)</label>
        <input type="text" class="db-form-control" name="cards[__I__][tag]" maxlength="255" placeholder="Medali Perak — Nasional">
      </div>
      <div class="db-form-group">
        <label>Tahun</label>
        <input type="text" class="db-form-control" name="cards[__I__][year]" maxlength="20" placeholder="2025">
      </div>
    </div>

    <div class="ad-grid-2">
      <div class="db-form-group">
        <label>Judul *</label>
        <input type="text" class="db-form-control" name="cards[__I__][title]" maxlength="255" placeholder="LKS Nasional">
      </div>
      <div class="db-form-group">
        <label>Sub-judul (berwarna emas)</label>
        <input type="text" class="db-form-control" name="cards[__I__][subtitle]" maxlength="255" placeholder="Patisserie &amp; Confectionery">
      </div>
    </div>

    <div class="db-form-group">
      <label>Deskripsi</label>
      <textarea class="db-form-control" name="cards[__I__][description]" maxlength="1000"></textarea>
    </div>

    <div class="db-form-group">
      <label>Keterangan (di samping tahun)</label>
      <input type="text" class="db-form-control" name="cards[__I__][meta_label]" maxlength="100" placeholder="Tingkat Nasional">
    </div>

    <label class="ad-check-row">
      <input type="checkbox" name="cards[__I__][is_active]" value="1" checked> Tampilkan di beranda
    </label>
  </div>
</template>
@endsection

@push('scripts')
  @php
    $seedIndustry = $industryLogos->map(function ($l) {
        return [
            'name' => $l->name, 'is_active' => $l->is_active,
            'existing_logo' => $l->logo, 'logo_url' => $l->logo_url,
        ];
    })->values();

    $seedAchievements = $achievements->map(function ($a) {
        return [
            'tag' => $a->tag, 'title' => $a->title, 'subtitle' => $a->subtitle,
            'description' => $a->description, 'year' => $a->year, 'meta_label' => $a->meta_label,
            'is_active' => $a->is_active,
            'existing_image' => $a->image, 'image_url' => $a->image_url,
        ];
    })->values();
  @endphp
  @include('admin.partials.repeater-js')
<script>
(function () {
  // ---------- TAB (ikut hash di URL supaya kembali ke tab yang sama setelah simpan) ----------
  const btns   = document.querySelectorAll('.ad-tab-btn');
  const panels = document.querySelectorAll('.ad-tab-panel');
  const generalTabs  = ['hero', 'sambutan', 'kontak'];
  const generalInput = document.getElementById('generalTab');

  function showTab(key) {
    const btn = document.querySelector(`.ad-tab-btn[data-tab="${key}"]`);
    if (!btn) key = 'hero';
    btns.forEach(b => b.classList.toggle('active', b.dataset.tab === key));
    panels.forEach(p => p.classList.toggle('active', p.dataset.panel === key));
    if (generalInput && generalTabs.includes(key)) generalInput.value = key;
  }

  btns.forEach(btn => btn.addEventListener('click', () => {
    showTab(btn.dataset.tab);
    history.replaceState(null, '', '#' + btn.dataset.tab);
  }));
  showTab((location.hash || '').replace('#', '') || 'hero');

  // ---------- PRATINJAU FOTO SAMBUTAN ----------
  const input = document.getElementById('sambutanPhoto');
  const preview = document.getElementById('sambutanPreview');
  if (input && preview) {
    input.addEventListener('change', () => {
      const file = input.files && input.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
      reader.readAsDataURL(file);
    });
  }

  // ---------- REPEATER ----------
  function fillPreview(node, existingValue, url) {
    if (!existingValue) return;
    node.querySelector('[data-existing]').value = existingValue;
    const box = node.querySelector('[data-preview]');
    box.style.display = 'flex';
    box.querySelector('img').src = url;
  }

  const industry = adSetupRepeater({
    listSelector: '#industryList',
    templateId: 'tpl-industry',
    onFill(node, data) { fillPreview(node, data.existing_logo, data.logo_url); },
  });

  const achievements = adSetupRepeater({
    listSelector: '#achievementList',
    templateId: 'tpl-achievement',
    onFill(node, data) { fillPreview(node, data.existing_image, data.image_url); },
  });

  document.getElementById('industryAdd').addEventListener('click', () => industry.addItem());
  document.getElementById('achievementAdd').addEventListener('click', () => achievements.addItem());

  const seedIndustry     = @json($seedIndustry);
  const seedAchievements = @json($seedAchievements);

  if (seedIndustry.length) seedIndustry.forEach(r => industry.addItem(r)); else industry.addItem();
  if (seedAchievements.length) seedAchievements.forEach(r => achievements.addItem(r)); else achievements.addItem();
})();
</script>
@endpush
