{{-- Tab Sorotan. Variabel: $albums, $placements (slot => position => KegiatanPlacement) --}}
@php
  $pl = fn ($slot, $pos) => optional(optional($placements->get($slot))->get($pos));
  $options = $albums->where('is_active', true);
@endphp

<form action="{{ route('admin.kegiatan.placements.update') }}" method="POST">
  @csrf
  @method('PUT')

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head">
      <h2 style="font-size:.9rem">Sorotan Besar (Featured)</h2>
      <span style="font-size:.72rem;color:var(--text-muted)">Foto lebar di bawah bagian pembuka. Kosongkan untuk menyembunyikan bagian ini.</span>
    </div>
    <div class="kd-slot-rows">
      <div class="kd-slot-row">
        <div class="kd-slot-fields">
          <div class="db-form-group" style="margin:0">
            <label>Album</label>
            <select name="featured[0][album_id]" class="db-form-control">
              <option value="">— Kosong —</option>
              @foreach($options as $a)
                <option value="{{ $a->id }}" @selected((int) $pl('featured', 0)->album_id === $a->id)>{{ $a->title }}@unless($a->show_in_gallery) (hanya sorotan)@endunless</option>
              @endforeach
            </select>
          </div>
          <div class="db-form-group" style="margin:0">
            <label>Label emas (tag)</label>
            <input type="text" name="featured[0][label]" class="db-form-control" maxlength="255"
                   value="{{ $pl('featured', 0)->label }}" placeholder="Penghargaan • 25 Desember 2025">
          </div>
        </div>
      </div>
    </div>
    <div class="kd-hint">Judul besar mengikuti judul album, foto mengikuti foto sampul album. Klik pada kartu membuka popup semua foto album.</div>
  </div>

  <div class="db-panel" style="margin-bottom:1.2rem">
    <div class="db-panel-head">
      <h2 style="font-size:.9rem">Momen Pilihan — Foto Besar</h2>
      <span style="font-size:.72rem;color:var(--text-muted)">Satu foto besar di sisi kiri</span>
    </div>
    <div class="kd-slot-rows">
      <div class="kd-slot-row">
        <div class="kd-slot-fields">
          <div class="db-form-group" style="margin:0">
            <label>Album</label>
            <select name="pick_big[0][album_id]" class="db-form-control">
              <option value="">— Kosong —</option>
              @foreach($options as $a)
                <option value="{{ $a->id }}" @selected((int) $pl('pick_big', 0)->album_id === $a->id)>{{ $a->title }}@unless($a->show_in_gallery) (hanya sorotan)@endunless</option>
              @endforeach
            </select>
          </div>
          <div class="db-form-group" style="margin:0">
            <label>Kutipan di atas foto</label>
            <input type="text" name="pick_big[0][label]" class="db-form-control" maxlength="255"
                   value="{{ $pl('pick_big', 0)->label }}" placeholder="Kosong = memakai judul album">
          </div>
        </div>
      </div>
    </div>
    <div class="kd-hint">Tanda kutip dipasang otomatis — cukup ketik kalimatnya saja.</div>
  </div>

  <div class="db-panel">
    <div class="db-panel-head">
      <h2 style="font-size:.9rem">Momen Pilihan — Foto Kecil (4)</h2>
      <span style="font-size:.72rem;color:var(--text-muted)">Empat foto di sisi kanan, urut kiri-atas ke kanan-bawah</span>
    </div>
    <div class="kd-slot-rows">
      @for($i = 0; $i < 4; $i++)
        <div class="kd-slot-row">
          <span class="kd-no">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
          <div class="kd-slot-fields">
            <div class="db-form-group" style="margin:0">
              <select name="pick_small[{{ $i }}][album_id]" class="db-form-control">
                <option value="">— Kosong —</option>
                @foreach($options as $a)
                  <option value="{{ $a->id }}" @selected((int) $pl('pick_small', $i)->album_id === $a->id)>{{ $a->title }}@unless($a->show_in_gallery) (hanya sorotan)@endunless</option>
                @endforeach
              </select>
            </div>
            <div class="db-form-group" style="margin:0">
              <input type="text" name="pick_small[{{ $i }}][label]" class="db-form-control" maxlength="255"
                     value="{{ $pl('pick_small', $i)->label }}" placeholder="Label pendek (kosong = judul album)">
            </div>
          </div>
        </div>
      @endfor
    </div>
  </div>

  <div class="kd-hint" style="margin-top:1rem">
    Sorotan tidak menggandakan data — hanya menunjuk ke album di tab <strong>Album Kegiatan</strong>.
    Kalau sebuah album dihapus, penempatannya ikut terhapus. Album yang dinonaktifkan tidak tampil di halaman publik.
  </div>

  <div class="kd-actions">
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Sorotan</button>
  </div>
</form>
