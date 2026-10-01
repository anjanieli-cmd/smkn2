@extends('layouts.admin')

@section('title', 'Konten Umum Website — Admin')

@push('styles')
  @include('admin.partials.form-kit')
@endpush

@section('content')
<div class="db-panel-head">
  <div>
    <h2><i class="fas fa-globe" style="color:var(--gold);margin-right:.5rem"></i> Konten Umum Website</h2>
    <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Teks hero beranda serta kontak &amp; lokasi sekolah yang tampil di halaman depan.</p>
  </div>
</div>

@include('admin.partials.flash')

<form action="{{ route('admin.general.update') }}" method="POST">
  @csrf
  @method('PUT')

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Hero Beranda</h2></div>
    <div class="db-form-group">
      <label>Teks kecil di atas judul</label>
      <input type="text" name="hero_eyebrow" class="db-form-control" maxlength="255" value="{{ old('hero_eyebrow', $settings['hero_eyebrow']) }}">
    </div>
    <div class="db-form-group">
      <label>Deskripsi Hero</label>
      <textarea name="hero_desc" class="db-form-control">{{ old('hero_desc', $settings['hero_desc']) }}</textarea>
    </div>
  </div>

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
      <small class="ad-hint">Alamat ini juga dipakai untuk menampilkan peta Google Maps dan tombol "Buka di Google Maps", jadi tulis selengkap mungkin.</small>
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
    <span><i class="fas fa-circle-info"></i> Perubahan tampil di halaman beranda setelah klik Simpan.</span>
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Konten Umum</button>
  </div>
</form>
@endsection
