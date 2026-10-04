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
    <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Atur isi halaman beranda per bagian, urut seperti di beranda. Pilih tab, lalu klik Simpan di tab yang sama.</p>
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
  <button type="button" class="ad-tab-btn" data-tab="jurusan"><i class="fas fa-graduation-cap"></i> Jurusan Unggulan</button>
  <button type="button" class="ad-tab-btn" data-tab="alumni"><i class="fas fa-award"></i> Lulusan Terbaik</button>
  <button type="button" class="ad-tab-btn" data-tab="industri"><i class="fas fa-handshake"></i> Kerja Sama Industri</button>
  <button type="button" class="ad-tab-btn" data-tab="ptn"><i class="fas fa-building-columns"></i> Lulusan PTN</button>
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

{{-- =====================================================================
     FORM: Jurusan Unggulan (carousel)
     ===================================================================== --}}
<div class="ad-tab-panel" data-panel="jurusan">
  <form action="{{ route('admin.general.majors.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="db-panel">
      <div class="db-panel-head"><h2 style="font-size:.9rem">Jurusan Unggulan: Carousel Kartu</h2></div>
      <div id="majorList"></div>
      <button type="button" class="ad-add-btn" id="majorAdd"><i class="fas fa-plus"></i> Tambah Jurusan</button>
      <small class="ad-hint" style="margin-top:.8rem">
        Urutan kartu = urutan dari kiri ke kanan di carousel (kartu kedua dari atas tampil di tengah saat halaman dibuka).
        Warna memakai kode hex, contoh <code>#DB1320</code>. Link tombol boleh berupa alamat halaman (<code>/keahlian/rpl</code>) atau URL lengkap.
        Baris tanpa singkatan dihapus saat disimpan.
      </small>
    </div>

    <div class="ad-save-bar">
      <span><i class="fas fa-circle-info"></i> Hanya tab Jurusan Unggulan yang disimpan.</span>
      <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Jurusan Unggulan</button>
    </div>
  </form>
</div>

{{-- =====================================================================
     FORM: Lulusan Terbaik (satu lulusan per jurusan)
     ===================================================================== --}}
<div class="ad-tab-panel" data-panel="alumni">
  <form action="{{ route('admin.general.alumni.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="db-panel">
      <div class="db-panel-head"><h2 style="font-size:.9rem">Lulusan Terbaik: Kartu per Jurusan</h2></div>
      <div id="alumniList"></div>
      <button type="button" class="ad-add-btn" id="alumniAdd"><i class="fas fa-plus"></i> Tambah Lulusan</button>
      <small class="ad-hint" style="margin-top:.8rem">
        Tiap kartu menjadi satu tombol jurusan dan satu slide di beranda, sesuai urutan di sini.
        Kode kartu (mis. <code>RPL / 2024</code>) dibuat otomatis dari singkatan dan tahun kalau dikosongkan.
        Baris tanpa nama dihapus saat disimpan.
      </small>
    </div>

    <div class="ad-save-bar">
      <span><i class="fas fa-circle-info"></i> Hanya tab Lulusan Terbaik yang disimpan.</span>
      <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Lulusan Terbaik</button>
    </div>
  </form>
</div>

{{-- =====================================================================
     FORM: Lulusan PTN (perguruan tinggi + nama yang lolos)
     ===================================================================== --}}
<div class="ad-tab-panel" data-panel="ptn">
  <form action="{{ route('admin.general.ptns.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="db-panel">
      <div class="db-panel-head"><h2 style="font-size:.9rem">Lulusan PTN: Perguruan Tinggi &amp; Nama yang Lolos</h2></div>
      <div id="ptnList"></div>
      <button type="button" class="ad-add-btn" id="ptnAdd"><i class="fas fa-plus"></i> Tambah Perguruan Tinggi</button>
      <small class="ad-hint" style="margin-top:.8rem">
        Satu kartu = satu perguruan tinggi, nomornya ("Destination 01, 02, ...") otomatis mengikuti urutan.
        Nama yang lolos ditulis <strong>satu baris per siswa</strong> dengan format
        <code>Nama | Program Studi | Kelas | Jalur</code>, contoh:
        <code>Lola Devina Amidjaja | Desain Produk | XII DKV 1 | SNBP</code>.
        Hanya nama yang wajib, bagian lain boleh dikosongkan.
      </small>
    </div>

    <div class="ad-save-bar">
      <span><i class="fas fa-circle-info"></i> Hanya tab Lulusan PTN yang disimpan.</span>
      <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Lulusan PTN</button>
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
<template id="tpl-major">
  <div class="ad-repeater-item" data-item>
      <div class="ad-repeater-head">
        <strong data-label="Jurusan">Jurusan</strong>
        <div class="ad-repeater-controls">
          <button type="button" class="ad-icon-mini" data-move="up" title="Naikkan"><i class="fas fa-arrow-up"></i></button>
          <button type="button" class="ad-icon-mini" data-move="down" title="Turunkan"><i class="fas fa-arrow-down"></i></button>
          <button type="button" class="ad-icon-mini danger" data-remove title="Hapus"><i class="fas fa-trash"></i></button>
        </div>
      </div>
    <div class="ad-grid-3">
      <div class="db-form-group">
        <label>Singkatan *</label>
        <input type="text" class="db-form-control" name="majors[__I__][abbr]" maxlength="30" placeholder="RPL">
      </div>
      <div class="db-form-group" style="grid-column:span 2">
        <label>Nama Lengkap Jurusan</label>
        <input type="text" class="db-form-control" name="majors[__I__][full_name]" maxlength="255" placeholder="Rekayasa Perangkat Lunak">
      </div>
    </div>
    <div class="ad-grid-2">
      <div class="db-form-group">
        <label>Link Tombol "Lihat Jurusan"</label>
        <input type="text" class="db-form-control" name="majors[__I__][url]" maxlength="255" placeholder="/keahlian/rpl">
      </div>
      <div class="db-form-group">
        <label>Warna Kartu (hex)</label>
        <input type="text" class="db-form-control" name="majors[__I__][color]" maxlength="7" placeholder="#DB1320">
      </div>
    </div>
    <div class="db-form-group">
      <label>Foto Jurusan</label>
      <input type="file" class="db-form-control" name="majors[__I__][image]" accept="image/png,image/jpeg,image/webp">
      <input type="hidden" name="majors[__I__][existing_image]" value="" data-existing>
      <div class="ad-logo-current" data-preview style="display:none">
        <div class="box" style="width:110px;height:90px"><img src="" alt=""></div>
        <span>Foto saat ini, pilih file baru untuk mengganti</span>
      </div>
    </div>
    <label class="ad-check-row">
      <input type="checkbox" name="majors[__I__][is_active]" value="1" checked> Tampilkan di beranda
    </label>
  </div>
</template>

<template id="tpl-alumni">
  <div class="ad-repeater-item" data-item>
      <div class="ad-repeater-head">
        <strong data-label="Lulusan">Lulusan</strong>
        <div class="ad-repeater-controls">
          <button type="button" class="ad-icon-mini" data-move="up" title="Naikkan"><i class="fas fa-arrow-up"></i></button>
          <button type="button" class="ad-icon-mini" data-move="down" title="Turunkan"><i class="fas fa-arrow-down"></i></button>
          <button type="button" class="ad-icon-mini danger" data-remove title="Hapus"><i class="fas fa-trash"></i></button>
        </div>
      </div>
    <div class="ad-grid-3">
      <div class="db-form-group">
        <label>Singkatan Jurusan</label>
        <input type="text" class="db-form-control" name="alumni[__I__][major_abbr]" maxlength="30" placeholder="RPL">
      </div>
      <div class="db-form-group" style="grid-column:span 2">
        <label>Nama Lengkap Jurusan</label>
        <input type="text" class="db-form-control" name="alumni[__I__][major_name]" maxlength="255" placeholder="Rekayasa Perangkat Lunak">
      </div>
    </div>
    <div class="db-form-group">
      <label>Nama Lulusan *</label>
      <input type="text" class="db-form-control" name="alumni[__I__][name]" maxlength="255" placeholder="Nama lengkap">
    </div>
    <div class="ad-grid-2">
      <div class="db-form-group">
        <label>Tahun Lulus</label>
        <input type="text" class="db-form-control" name="alumni[__I__][year]" maxlength="20" placeholder="2025">
      </div>
      <div class="db-form-group">
        <label>Kode Kartu (opsional)</label>
        <input type="text" class="db-form-control" name="alumni[__I__][code]" maxlength="50" placeholder="RPL / 2025">
      </div>
    </div>
    <div class="db-form-group">
      <label>Foto</label>
      <input type="file" class="db-form-control" name="alumni[__I__][photo]" accept="image/png,image/jpeg,image/webp">
      <input type="hidden" name="alumni[__I__][existing_photo]" value="" data-existing>
      <div class="ad-logo-current" data-preview style="display:none">
        <div class="box" style="width:90px;height:110px"><img src="" alt=""></div>
        <span>Foto saat ini, pilih file baru untuk mengganti</span>
      </div>
    </div>
    <label class="ad-check-row">
      <input type="checkbox" name="alumni[__I__][is_active]" value="1" checked> Tampilkan di beranda
    </label>
  </div>
</template>

<template id="tpl-ptn">
  <div class="ad-repeater-item" data-item>
      <div class="ad-repeater-head">
        <strong data-label="Perguruan Tinggi">Perguruan Tinggi</strong>
        <div class="ad-repeater-controls">
          <button type="button" class="ad-icon-mini" data-move="up" title="Naikkan"><i class="fas fa-arrow-up"></i></button>
          <button type="button" class="ad-icon-mini" data-move="down" title="Turunkan"><i class="fas fa-arrow-down"></i></button>
          <button type="button" class="ad-icon-mini danger" data-remove title="Hapus"><i class="fas fa-trash"></i></button>
        </div>
      </div>
    <div class="db-form-group">
      <label>Nama Perguruan Tinggi *</label>
      <input type="text" class="db-form-control" name="ptns[__I__][name]" maxlength="255" placeholder="Institut Teknologi Sepuluh Nopember">
    </div>
    <div class="db-form-group">
      <label>Logo</label>
      <input type="file" class="db-form-control" name="ptns[__I__][logo]" accept="image/png,image/jpeg,image/webp,image/svg+xml">
      <input type="hidden" name="ptns[__I__][existing_logo]" value="" data-existing>
      <div class="ad-logo-current" data-preview style="display:none">
        <div class="box"><img src="" alt=""></div>
        <span>Logo saat ini, pilih file baru untuk mengganti</span>
      </div>
    </div>
    <div class="db-form-group">
      <label>Nama yang Lolos (satu baris = satu siswa)</label>
      <textarea class="db-form-control" name="ptns[__I__][students]" style="min-height:120px"
        placeholder="Nama | Program Studi | Kelas | Jalur&#10;Lola Devina Amidjaja | Desain Produk | XII DKV 1 | SNBP"></textarea>
      <small class="ad-hint">Format: <code>Nama | Program Studi | Kelas | Jalur</code>. Hanya nama yang wajib.</small>
    </div>
    <label class="ad-check-row">
      <input type="checkbox" name="ptns[__I__][is_active]" value="1" checked> Tampilkan di beranda
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

    $seedMajors = $majors->map(function ($m) {
        return [
            'abbr' => $m->abbr, 'full_name' => $m->full_name, 'url' => $m->url, 'color' => $m->color,
            'is_active' => $m->is_active, 'existing_image' => $m->image, 'image_url' => $m->image_url,
        ];
    })->values();

    $seedAlumni = $bestAlumni->map(function ($a) {
        return [
            'major_abbr' => $a->major_abbr, 'major_name' => $a->major_name, 'name' => $a->name,
            'year' => $a->year, 'code' => $a->code, 'is_active' => $a->is_active,
            'existing_photo' => $a->photo, 'photo_url' => $a->photo_url,
        ];
    })->values();

    $seedPtns = $ptns->map(function ($p) {
        return [
            'name' => $p->name, 'students' => $p->students_text, 'is_active' => $p->is_active,
            'existing_logo' => $p->logo, 'logo_url' => $p->logo_url,
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

  const majors = adSetupRepeater({
    listSelector: '#majorList',
    templateId: 'tpl-major',
    onFill(node, data) { fillPreview(node, data.existing_image, data.image_url); },
  });

  const alumni = adSetupRepeater({
    listSelector: '#alumniList',
    templateId: 'tpl-alumni',
    onFill(node, data) { fillPreview(node, data.existing_photo, data.photo_url); },
  });

  const ptns = adSetupRepeater({
    listSelector: '#ptnList',
    templateId: 'tpl-ptn',
    onFill(node, data) { fillPreview(node, data.existing_logo, data.logo_url); },
  });

  document.getElementById('majorAdd').addEventListener('click', () => majors.addItem());
  document.getElementById('alumniAdd').addEventListener('click', () => alumni.addItem());
  document.getElementById('ptnAdd').addEventListener('click', () => ptns.addItem());

  const seedMajors       = @json($seedMajors);
  const seedAlumni       = @json($seedAlumni);
  const seedPtns         = @json($seedPtns);
  const seedIndustry     = @json($seedIndustry);
  const seedAchievements = @json($seedAchievements);

  if (seedMajors.length) seedMajors.forEach(r => majors.addItem(r)); else majors.addItem();
  if (seedAlumni.length) seedAlumni.forEach(r => alumni.addItem(r)); else alumni.addItem();
  if (seedPtns.length) seedPtns.forEach(r => ptns.addItem(r)); else ptns.addItem();
  if (seedIndustry.length) seedIndustry.forEach(r => industry.addItem(r)); else industry.addItem();
  if (seedAchievements.length) seedAchievements.forEach(r => achievements.addItem(r)); else achievements.addItem();
})();
</script>
@endpush
