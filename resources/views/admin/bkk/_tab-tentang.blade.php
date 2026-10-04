{{-- Tab Tentang BKK. Variabel: $s --}}
<form action="{{ route('admin.bkk.settings.update') }}" method="POST">
  @csrf
  @method('PUT')
  <input type="hidden" name="_tab" value="tentang">

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Judul bagian "Tentang BKK"</h2></div>

    <div class="db-form-group">
      <label>Label kecil di atas judul</label>
      <input type="text" name="about_eyebrow" class="db-form-control" maxlength="80" value="{{ old('about_eyebrow', $s['about_eyebrow']) }}">
    </div>
    <div class="bk-grid-2">
      <div class="db-form-group">
        <label>Judul (biasa)</label>
        <input type="text" name="about_title" class="db-form-control" maxlength="80" required value="{{ old('about_title', $s['about_title']) }}">
      </div>
      <div class="db-form-group">
        <label>Lanjutan judul (diberi garis kuning)</label>
        <input type="text" name="about_title_em" class="db-form-control" maxlength="80" value="{{ old('about_title_em', $s['about_title_em']) }}">
      </div>
    </div>
    <div class="db-form-group">
      <label>Kalimat pengantar</label>
      <textarea name="about_sub" class="db-form-control" rows="2">{{ old('about_sub', $s['about_sub']) }}</textarea>
    </div>
  </div>

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Kartu penjelasan BKK (kiri)</h2></div>

    <div class="db-form-group">
      <label>Judul kartu</label>
      <input type="text" name="about_card_title" class="db-form-control" maxlength="150" required value="{{ old('about_card_title', $s['about_card_title']) }}">
    </div>
    <div class="db-form-group">
      <label>Paragraf 1</label>
      <textarea name="about_p1" class="db-form-control" rows="5">{{ old('about_p1', $s['about_p1']) }}</textarea>
    </div>
    <div class="db-form-group">
      <label>Paragraf 2</label>
      <textarea name="about_p2" class="db-form-control" rows="3">{{ old('about_p2', $s['about_p2']) }}</textarea>
      <div class="bk-hint">Boleh dikosongkan kalau hanya butuh satu paragraf.</div>
    </div>
  </div>

  <div class="db-panel">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Kartu Visi (kanan, latar biru)</h2></div>

    <div class="db-form-group">
      <label>Judul</label>
      <input type="text" name="vision_title" class="db-form-control" maxlength="80" required value="{{ old('vision_title', $s['vision_title']) }}">
    </div>
    <div class="db-form-group">
      <label>Kalimat pengantar</label>
      <textarea name="vision_text" class="db-form-control" rows="2">{{ old('vision_text', $s['vision_text']) }}</textarea>
    </div>
    <div class="db-form-group">
      <label>Kutipan visi</label>
      <textarea name="vision_quote" class="db-form-control" rows="3">{{ old('vision_quote', $s['vision_quote']) }}</textarea>
      <div class="bk-hint">Tanda kutip dipasang otomatis, tidak perlu diketik.</div>
    </div>
  </div>

  <div class="bk-actions">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Teks Tentang BKK</button>
  </div>
</form>

{{-- ================= FOTO DOKUMENTASI ================= --}}
<form action="{{ route('admin.bkk.photos.update') }}" method="POST" enctype="multipart/form-data" style="margin-top:1.6rem">
  @csrf

  <div class="db-panel">
    <div class="db-panel-head">
      <h2 style="font-size:.9rem">Foto Dokumentasi (3 foto di bawah kartu)</h2>
      <span style="font-size:.72rem;color:var(--text-muted)">Foto kedua tampil sedikit turun di halaman publik (susunan berundak), jadi tidak perlu disamakan tingginya.</span>
    </div>

    <div class="bk-grid-3">
      @foreach([1, 2, 3] as $n)
        @php $path = $s["photo_$n"]; @endphp
        <div class="bk-photo-card">
          <h4>Foto {{ $n }}</h4>
          <div class="bk-photo-preview"><img id="bkPhotoPreview{{ $n }}" src="{{ \App\Models\BkkSetting::mediaUrl($path) }}" alt=""></div>

          <div class="db-form-group" style="margin:0">
            <input type="file" name="photo_{{ $n }}" class="db-form-control" accept="image/png,image/jpeg,image/webp" data-bk-photo="{{ $n }}">
          </div>
          <div class="db-form-group" style="margin:0">
            <label style="font-size:.7rem">Deskripsi foto (untuk pembaca layar / SEO)</label>
            <input type="text" name="photo_{{ $n }}_alt" class="db-form-control" maxlength="150" value="{{ old("photo_{$n}_alt", $s["photo_{$n}_alt"]) }}">
          </div>

          @if(\App\Models\BkkSetting::isUploaded($path))
            <label class="bk-check">
              <input type="checkbox" name="remove_photo_{{ $n }}" value="1"> Hapus foto upload (kembali ke foto bawaan)
            </label>
          @endif
        </div>
      @endforeach
    </div>

    <div class="bk-hint" style="margin-top:.9rem">JPG / PNG / WEBP, maksimal 4 MB per foto. Disarankan foto mendatar. Kolom yang tidak diisi file tidak mengubah foto yang sekarang.</div>
  </div>

  <div class="bk-actions">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Foto</button>
  </div>
</form>

@push('scripts')
<script>
document.querySelectorAll('[data-bk-photo]').forEach(function (input) {
  input.addEventListener('change', function () {
    var file = input.files && input.files[0];
    var img = document.getElementById('bkPhotoPreview' + input.getAttribute('data-bk-photo'));
    if (file && img) { img.src = URL.createObjectURL(file); }
  });
});
</script>
@endpush
