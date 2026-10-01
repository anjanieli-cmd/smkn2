{{-- Field form lokasi — dipakai bersama oleh form Tambah dan form Edit. $scene = null saat tambah baru. --}}
@php
  $v = fn ($key, $default = null) => old($key, $scene?->{$key} ?? $default);
@endphp

<div class="tr-grid-2">
  <div class="db-form-group">
    <label>Nama Lokasi</label>
    <input type="text" name="title" class="db-form-control" value="{{ $v('title') }}" placeholder="Gerbang Utama" required maxlength="255">
  </div>
  <div class="db-form-group">
    <label>Kategori</label>
    <select name="category" class="db-form-control" required>
      @foreach(['area' => 'Area Sekolah', 'kelas' => 'Program Keahlian', 'fasilitas' => 'Fasilitas'] as $val => $lbl)
        <option value="{{ $val }}" @selected($v('category', 'area') === $val)>{{ $lbl }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="tr-grid-2">
  <div class="db-form-group">
    <label>Ikon (FontAwesome)</label>
    <input type="text" name="icon" class="db-form-control" value="{{ $v('icon', 'fa-archway') }}" placeholder="fa-archway">
    <div class="tr-hint">Tulis nama ikonnya saja, mis. <code>fa-flag</code> atau <code>fa-flask</code>. Cari di fontawesome.com/icons.</div>
  </div>
  <div class="db-form-group">
    <label>Lokasi Awal Tour</label>
    <label class="tr-check">
      <input type="checkbox" name="is_home" value="1" @checked(old('is_home', $scene?->is_home))>
      Jadikan lokasi pertama yang dibuka saat tour dimulai
    </label>
  </div>
</div>

<div class="db-form-group">
  <label>Deskripsi</label>
  <textarea name="description" class="db-form-control" rows="3" placeholder="Keterangan singkat yang tampil di kartu info lokasi">{{ $v('description') }}</textarea>
</div>

<div class="db-form-group">
  <label>Foto Panorama 360° (equirectangular)</label>
  <input type="file" name="panorama" class="db-form-control" accept="image/*">
  <div class="tr-hint">Format .jpg/.png, maksimal 30 MB. Nilai <code>vaov</code> dihitung otomatis dari dimensi foto.</div>
  @if($scene && $scene->panorama_url)
    <div class="tr-current">
      <img src="{{ $scene->panorama_url }}" alt="Panorama saat ini">
      <span>Foto saat ini — upload baru untuk mengganti</span>
    </div>
  @endif
</div>

<details class="tr-adv">
  <summary>Pengaturan lanjutan (biasanya tidak perlu diubah)</summary>
  <div class="tr-grid-3">
    <div class="db-form-group">
      <label>haov (sudut horizontal)</label>
      <input type="number" name="haov" class="db-form-control" min="1" max="360" value="{{ $v('haov', 360) }}">
    </div>
    <div class="db-form-group">
      <label>vaov (sudut vertikal)</label>
      <input type="number" step="0.01" name="vaov" class="db-form-control" min="1" max="360" value="{{ $v('vaov') }}" placeholder="otomatis">
    </div>
    <div class="db-form-group">
      <label>vOffset (geser horizon)</label>
      <input type="number" name="v_offset" class="db-form-control" min="-90" max="90" value="{{ $v('v_offset', 0) }}">
    </div>
  </div>
  <div class="tr-hint">Kosongkan <code>vaov</code> supaya dihitung otomatis: 360 × tinggi ÷ lebar foto. Foto bola penuh (rasio 2:1) = 180.</div>
</details>
