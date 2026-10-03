@extends('layouts.admin')

@section('title', 'Konten Beranda — Admin')

@push('styles')
  @include('admin.partials.form-kit')
  <style>
    .ad-photo-row{display:flex;align-items:center;gap:1.2rem;flex-wrap:wrap}
    .ad-photo-box{width:110px;height:140px;border-radius:14px;overflow:hidden;border:1px solid rgba(255,255,255,.16);background:rgba(255,255,255,.06);flex-shrink:0}
    .ad-photo-box img{width:100%;height:100%;object-fit:cover;display:block}
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
    <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Atur teks hero, sambutan kepala sekolah, serta kontak &amp; lokasi pada halaman beranda.</p>
  </div>
  <div class="db-panel-actions">
    <a href="{{ route('home') }}" target="_blank" rel="noopener" class="db-btn db-btn-ghost">
      <i class="fas fa-arrow-up-right-from-square"></i> Lihat Beranda
    </a>
  </div>
</div>

@include('admin.partials.flash')

<form action="{{ route('admin.general.update') }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="ad-tabs">
    <button type="button" class="ad-tab-btn active" data-tab="hero"><i class="fas fa-star"></i> Hero</button>
    <button type="button" class="ad-tab-btn" data-tab="sambutan"><i class="fas fa-user-tie"></i> Sambutan Kepala Sekolah</button>
    <button type="button" class="ad-tab-btn" data-tab="kontak"><i class="fas fa-location-dot"></i> Kontak &amp; Lokasi</button>
  </div>

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
  </div>

  <div class="ad-save-bar">
    <span><i class="fas fa-circle-info"></i> Semua tab disimpan sekaligus. Perubahan tampil di beranda setelah klik Simpan.</span>
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Konten Beranda</button>
  </div>
</form>
@endsection

@push('scripts')
<script>
(function () {
  const btns = document.querySelectorAll('.ad-tab-btn');
  const panels = document.querySelectorAll('.ad-tab-panel');
  btns.forEach(btn => btn.addEventListener('click', () => {
    btns.forEach(b => b.classList.remove('active'));
    panels.forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.querySelector(`.ad-tab-panel[data-panel="${btn.dataset.tab}"]`).classList.add('active');
  }));

  // Pratinjau foto sambutan sebelum disimpan
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
})();
</script>
@endpush
