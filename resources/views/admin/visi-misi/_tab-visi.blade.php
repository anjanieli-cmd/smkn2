<form action="{{ route('admin.visi-misi.settings.update', 'visi') }}" method="POST">
  @csrf
  @method('PUT')

  <div class="db-panel">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Visi Sekolah</h2></div>

    <div class="db-form-group">
      <label>Kalimat Visi</label>
      <textarea name="visi_statement" class="db-form-control" rows="5" required>{{ old('visi_statement', $s['visi_statement']) }}</textarea>
      <div class="vm-hint">
        Apit kata dengan tanda bintang untuk memberi <strong>penekanan bergradasi emas</strong>, contoh:
        <code>Menghasilkan SDM yang *berkarakter, kompeten* dan berdaya saing</code>.
        Tanda kutip di awal dan akhir ditambahkan otomatis.
      </div>
    </div>

    <div class="db-form-group">
      <label>Tag di bawah Visi</label>
      <textarea name="visi_tags" class="db-form-control" rows="5" placeholder="Satu tag per baris">{{ old('visi_tags', $s['visi_tags']) }}</textarea>
      <div class="vm-hint">Tulis satu tag per baris. Kosongkan semua kalau tag tidak ingin ditampilkan.</div>
    </div>
  </div>

  <div class="vm-actions">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Visi</button>
  </div>
</form>
