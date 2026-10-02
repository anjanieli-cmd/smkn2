@extends('layouts.admin')

@section('title', 'Informasi Footer — Admin')

@push('styles')
  @include('admin.partials.form-kit')
@endpush

@section('content')
<div class="db-panel-head">
  <div>
    <h2><i class="fas fa-shoe-prints" style="color:var(--gold);margin-right:.5rem"></i> Informasi Footer</h2>
    <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Teks, media sosial, dan hak cipta yang tampil di bagian bawah semua halaman website publik.</p>
  </div>
</div>

@include('admin.partials.flash')

<form action="{{ route('admin.footer.update') }}" method="POST">
  @csrf
  @method('PUT')

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Identitas &amp; Tagline</h2></div>
    <div class="db-form-group">
      <label>Sub-judul (di bawah nama sekolah)</label>
      <input type="text" name="footer_sub" class="db-form-control" maxlength="255" value="{{ old('footer_sub', $settings['footer_sub']) }}">
    </div>
    <div class="db-form-group">
      <label>Tagline</label>
      <textarea name="footer_tagline" class="db-form-control">{{ old('footer_tagline', $settings['footer_tagline']) }}</textarea>
    </div>
  </div>

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Media Sosial</h2></div>
    <div class="db-form-group">
      <label>Judul bagian media sosial</label>
      <input type="text" name="footer_social_label" class="db-form-control" maxlength="100" value="{{ old('footer_social_label', $settings['footer_social_label']) }}">
    </div>
    <div class="ad-grid-3">
      <div class="db-form-group">
        <label><i class="fa-brands fa-instagram" style="color:var(--gold)"></i> Instagram</label>
        <input type="url" name="footer_instagram" class="db-form-control" placeholder="https://instagram.com/..." value="{{ old('footer_instagram', $settings['footer_instagram']) }}">
      </div>
      <div class="db-form-group">
        <label><i class="fa-brands fa-youtube" style="color:var(--gold)"></i> YouTube</label>
        <input type="url" name="footer_youtube" class="db-form-control" placeholder="https://youtube.com/..." value="{{ old('footer_youtube', $settings['footer_youtube']) }}">
      </div>
      <div class="db-form-group">
        <label><i class="fa-brands fa-facebook-f" style="color:var(--gold)"></i> Facebook</label>
        <input type="url" name="footer_facebook" class="db-form-control" placeholder="https://facebook.com/..." value="{{ old('footer_facebook', $settings['footer_facebook']) }}">
      </div>
    </div>
    <small class="ad-hint">Kolom yang dikosongkan akan menyembunyikan ikon media sosialnya di website. Kalau ketiganya kosong, seluruh bagian ini disembunyikan.</small>
  </div>

  <div class="db-panel">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Partner &amp; Hak Cipta</h2></div>
    <div class="db-form-group">
      <label>Judul bagian logo partner</label>
      <input type="text" name="footer_partners_label" class="db-form-control" maxlength="100" value="{{ old('footer_partners_label', $settings['footer_partners_label']) }}">
      <small class="ad-hint">Logonya sendiri diatur di menu <strong>Logo Partner / Mitra</strong>.</small>
    </div>
    <div class="ad-grid-2">
      <div class="db-form-group">
        <label>Teks hak cipta</label>
        <input type="text" name="footer_copyright" class="db-form-control" maxlength="255" value="{{ old('footer_copyright', $settings['footer_copyright']) }}">
      </div>
      <div class="db-form-group">
        <label>Slogan (di samping hak cipta)</label>
        <input type="text" name="footer_slogan" class="db-form-control" maxlength="255" value="{{ old('footer_slogan', $settings['footer_slogan']) }}">
      </div>
    </div>
  </div>

  <div class="ad-save-bar">
    <span><i class="fas fa-circle-info"></i> Perubahan tampil di footer website setelah klik Simpan.</span>
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Informasi Footer</button>
  </div>
</form>
@endsection
