{{-- Form teks untuk satu tab. Variabel: $tab, $s --}}
@php
  $fields = \App\Models\PpdbSetting::fieldsFor($tab);
  $lastGroup = null;
@endphp

<form action="{{ route('admin.ppdb.settings.update', $tab) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  @foreach($fields as $key => $f)
    @php
      [$ftab, $label, $type, $required, $max] = $f;
      $group = $f[5] ?? null;
      $hint  = $f[6] ?? null;
    @endphp

    @if($group && $group !== $lastGroup)
      <div class="st-sub">{{ $group }}</div>
      @php $lastGroup = $group; @endphp
    @endif

    <div class="db-form-group">
      <label>{{ $label }}</label>
      @if($type === 'textarea')
        <textarea name="{{ $key }}" class="db-form-control" rows="3" maxlength="{{ $max }}" @required($required)>{{ old($key, $s[$key]) }}</textarea>
      @else
        <input type="text" name="{{ $key }}" class="db-form-control" maxlength="{{ $max }}" @required($required) value="{{ old($key, $s[$key]) }}">
      @endif
      @if($hint)<div class="st-hint">{{ $hint }}</div>@endif
    </div>
  @endforeach

  @if($tab === 'definisi')
    <div class="st-sub">Gambar banner di sebelah kanan</div>
    <div class="st-photo-row">
      <div class="st-photo-preview" id="ppBannerBox">
        @if(\App\Models\PpdbSetting::imageUrl($s['intro_banner']))
          <img src="{{ \App\Models\PpdbSetting::imageUrl($s['intro_banner']) }}" alt="Banner saat ini">
        @else
          <i class="fas fa-image"></i>
        @endif
      </div>
      <div class="st-photo-side db-form-group">
        <label>Ganti banner (jpg / png / webp)</label>
        <input type="file" name="banner" id="ppBanner" class="db-form-control" accept="image/jpeg,image/png,image/webp">
        <div class="st-hint">Maksimal 5 MB. Gambar tampil penuh lebar kotak, tinggi menyesuaikan.</div>
        <label class="st-check">
          <input type="checkbox" name="reset_banner" value="1">
          Kembalikan ke gambar bawaan
        </label>
      </div>
    </div>
  @endif

  <div class="st-actions" style="justify-content:flex-end">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Perubahan</button>
  </div>
</form>

@if($tab === 'definisi')
@push('scripts')
<script>
(function () {
  var file = document.getElementById('ppBanner');
  var box  = document.getElementById('ppBannerBox');
  if (!file || !box) return;
  file.addEventListener('change', function () {
    var f = file.files && file.files[0];
    if (!f) return;
    box.innerHTML = '';
    var img = document.createElement('img');
    img.src = URL.createObjectURL(f);
    img.alt = 'Pratinjau banner baru';
    box.appendChild(img);
  });
})();
</script>
@endpush
@endif
