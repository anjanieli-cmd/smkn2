@extends('layouts.admin')

@section('title', 'Sejarah Sekolah — Admin')

@push('styles')
<style>
  .sh-tabs{display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:1.5rem;border-bottom:1px solid rgba(255,255,255,.09);padding-bottom:1rem}
  .sh-tab-btn{
    display:inline-flex;align-items:center;gap:.5rem;
    padding:.6rem 1.05rem;border-radius:10px;border:1px solid rgba(255,255,255,.1);
    background:rgba(255,255,255,.04);color:rgba(255,255,255,.68);font-size:.82rem;font-weight:600;
    cursor:pointer;transition:all .2s var(--ease);
  }
  .sh-tab-btn i{font-size:.78rem;opacity:.75}
  .sh-tab-btn:hover{background:rgba(255,255,255,.09);color:#fff;border-color:rgba(255,255,255,.18)}
  .sh-tab-btn.active{
    background:linear-gradient(135deg,var(--gold-light),var(--gold));color:var(--ink);border-color:transparent;
    box-shadow:0 8px 20px rgba(255,179,0,.22);
  }
  .sh-tab-btn.active i{opacity:1}
  .sh-tab-panel{display:none;animation:sh-fade .25s var(--ease)}
  .sh-tab-panel.active{display:block}
  @keyframes sh-fade{from{opacity:0;transform:translateY(4px)}to{opacity:1;transform:translateY(0)}}

  .sh-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.1rem}
  .sh-grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:1.1rem}
  @media(max-width:900px){.sh-grid-2,.sh-grid-4{grid-template-columns:1fr 1fr}}
  @media(max-width:560px){.sh-grid-2,.sh-grid-4{grid-template-columns:1fr}}

  .sh-img-current{margin-top:.6rem;display:flex;align-items:center;gap:.8rem}
  .sh-img-current img{width:70px;height:70px;object-fit:cover;border-radius:10px;border:1px solid rgba(255,255,255,.14)}
  .sh-img-current span{font-size:.72rem;color:var(--text-muted)}

  .sh-repeater-item{
    background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.09);border-left:3px solid rgba(255,179,0,.35);
    border-radius:14px;padding:1.35rem;margin-bottom:1.1rem;position:relative;
    transition:border-color .2s var(--ease);
  }
  .sh-repeater-item:hover{border-left-color:var(--gold)}
  .sh-repeater-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.1rem;gap:.7rem;padding-bottom:.85rem;border-bottom:1px solid rgba(255,255,255,.06)}
  .sh-repeater-head strong{font-family:var(--font-display);font-weight:700;font-size:.82rem;color:#fff;letter-spacing:-.005em}
  .sh-repeater-controls{display:flex;gap:.4rem}
  .sh-icon-mini{
    width:30px;height:30px;border-radius:8px;border:1px solid rgba(255,255,255,.12);
    background:rgba(255,255,255,.05);color:#fff;display:flex;align-items:center;justify-content:center;
    cursor:pointer;font-size:.78rem;transition:all .2s var(--ease);
  }
  .sh-icon-mini:hover{background:rgba(255,255,255,.14);transform:translateY(-1px)}
  .sh-icon-mini.danger{color:#ff7875;border-color:rgba(226,75,74,.3)}
  .sh-icon-mini.danger:hover{background:rgba(226,75,74,.2)}

  .sh-checkbox-row{display:flex;align-items:center;gap:.55rem;font-size:.78rem;color:rgba(255,255,255,.8);margin-top:.7rem}
  .sh-checkbox-row input{width:16px;height:16px;accent-color:var(--gold)}

  .sh-add-btn{
    display:inline-flex;align-items:center;gap:.5rem;padding:.75rem 1.1rem;border-radius:11px;
    background:rgba(255,179,0,.08);color:var(--gold-light);border:1px dashed rgba(255,179,0,.4);
    font-size:.82rem;font-weight:700;cursor:pointer;width:100%;justify-content:center;
    transition:all .2s var(--ease);
  }
  .sh-add-btn:hover{background:rgba(255,179,0,.16);border-color:rgba(255,179,0,.6)}

  .sh-chip-input-row{display:flex;gap:.5rem;margin-bottom:.5rem}
  .sh-chip-input-row .db-form-control{flex:1}

  .sh-save-bar{
    position:sticky;bottom:0;margin-top:1.8rem;padding:1.05rem 1.4rem;border-radius:14px;
    background:rgba(12,40,70,.94);border:1px solid rgba(255,255,255,.12);
    display:flex;align-items:center;justify-content:space-between;gap:1rem;
    backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);
    box-shadow:0 -8px 28px rgba(0,0,0,.28);
  }
  .sh-save-bar span{font-size:.78rem;color:var(--text-muted);display:flex;align-items:center;gap:.5rem}
</style>
@endpush

@section('content')
<div class="db-panel-head">
  <h2>Sejarah Sekolah</h2>
</div>

@if(session('status'))
  <div class="db-panel" style="border-color:rgba(76,201,141,.4);background:rgba(76,201,141,.08);margin-bottom:1.2rem;padding:1rem 1.3rem">
    <span style="color:#5ce0a3;font-size:.85rem;font-weight:700"><i class="fas fa-circle-check"></i> {{ session('status') }}</span>
  </div>
@endif

<form action="{{ route('admin.school-history.update') }}" method="POST" enctype="multipart/form-data" id="shForm">
  @csrf
  @method('PUT')

  <div class="sh-tabs">
    <button type="button" class="sh-tab-btn active" data-tab="hero"><i class="fas fa-house"></i> Hero &amp; Intro</button>
    <button type="button" class="sh-tab-btn" data-tab="chapters"><i class="fas fa-book-open"></i> Bab Sejarah</button>
    <button type="button" class="sh-tab-btn" data-tab="story"><i class="fas fa-heart"></i> Manusia &amp; Semangat</button>
    <button type="button" class="sh-tab-btn" data-tab="gallery"><i class="fas fa-images"></i> Galeri</button>
    <button type="button" class="sh-tab-btn" data-tab="principals"><i class="fas fa-user-tie"></i> Kepala Sekolah</button>
    <button type="button" class="sh-tab-btn" data-tab="vt"><i class="fas fa-street-view"></i> Virtual Tour</button>
  </div>

  {{-- ================= TAB: HERO & INTRO ================= --}}
  <div class="sh-tab-panel active" data-panel="hero">
    <div class="db-panel" style="margin-bottom:1.2rem">
      <div class="db-panel-head"><h2 style="font-size:.9rem">Hero</h2></div>
      <div class="db-form-group">
        <label>Teks Kicker (badge kecil di atas judul)</label>
        <input type="text" name="hero_kicker" class="db-form-control" value="{{ old('hero_kicker', $history->hero_kicker) }}" placeholder="Contoh: Sejak 2013">
      </div>
      <div class="db-form-group">
        <label>Gambar Ornamen Hero</label>
        <input type="file" name="hero_image" class="db-form-control" accept="image/*">
        @if($history->hero_image)
          <div class="sh-img-current">
            <img src="{{ asset('storage/'.$history->hero_image) }}" alt="Hero saat ini">
            <span>Gambar saat ini — upload baru untuk mengganti</span>
          </div>
        @endif
      </div>
    </div>

    <div class="db-panel">
      <div class="db-panel-head"><h2 style="font-size:.9rem">Intro / Statistik</h2></div>
      <div class="sh-grid-2">
        <div class="db-form-group">
          <label>Eyebrow</label>
          <input type="text" name="intro_eyebrow" class="db-form-control" value="{{ old('intro_eyebrow', $history->intro_eyebrow) }}" placeholder="Dari masa ke masa">
        </div>
        <div class="db-form-group">
          <label>Judul</label>
          <input type="text" name="intro_title" class="db-form-control" value="{{ old('intro_title', $history->intro_title) }}" placeholder="2013 → HARI INI.">
        </div>
      </div>
      <div class="db-form-group">
        <label>Paragraf Intro</label>
        <textarea name="intro_desc" class="db-form-control">{{ old('intro_desc', $history->intro_desc) }}</textarea>
      </div>

      <div class="sh-grid-4">
        @for($n = 1; $n <= 4; $n++)
          <div class="db-form-group">
            <label>Statistik {{ $n }} — Angka</label>
            <input type="text" name="stat{{ $n }}_value" class="db-form-control" value="{{ old("stat{$n}_value", $history->{"stat{$n}_value"}) }}">
            <div style="height:.5rem"></div>
            <label>Statistik {{ $n }} — Label</label>
            <input type="text" name="stat{{ $n }}_label" class="db-form-control" value="{{ old("stat{$n}_label", $history->{"stat{$n}_label"}) }}">
          </div>
        @endfor
      </div>
    </div>
  </div>

  {{-- ================= TAB: BAB SEJARAH (REPEATER) ================= --}}
  <div class="sh-tab-panel" data-panel="chapters">
    <div class="db-panel">
      <div class="db-panel-head">
        <h2 style="font-size:.9rem">Bab-Bab Sejarah (Buku Interaktif)</h2>
        <span class="db-panel-actions" style="font-size:.75rem;color:var(--text-muted)">Urutan di sini = urutan tampil di buku</span>
      </div>

      <div id="chaptersList"></div>
      <button type="button" class="sh-add-btn" data-add="chapters"><i class="fas fa-plus"></i> Tambah Bab</button>
    </div>
  </div>

  {{-- ================= TAB: STORY BAND ================= --}}
  <div class="sh-tab-panel" data-panel="story">
    <div class="db-panel">
      <div class="db-panel-head"><h2 style="font-size:.9rem">Manusianya. Semangatnya.</h2></div>
      <div class="sh-grid-2">
        <div class="db-form-group">
          <label>Eyebrow</label>
          <input type="text" name="story_eyebrow" class="db-form-control" value="{{ old('story_eyebrow', $history->story_eyebrow) }}" placeholder="Yang tidak berubah">
        </div>
        <div class="db-form-group">
          <label>Judul</label>
          <input type="text" name="story_title" class="db-form-control" value="{{ old('story_title', $history->story_title) }}" placeholder="MANUSIANYA. SEMANGATNYA.">
        </div>
      </div>
      <div class="db-form-group">
        <label>Paragraf</label>
        <textarea name="story_desc" class="db-form-control">{{ old('story_desc', $history->story_desc) }}</textarea>
      </div>
      <div class="db-form-group">
        <label>Gambar</label>
        <input type="file" name="story_image" class="db-form-control" accept="image/*">
        @if($history->story_image)
          <div class="sh-img-current">
            <img src="{{ asset('storage/'.$history->story_image) }}" alt="Story saat ini">
            <span>Gambar saat ini — upload baru untuk mengganti</span>
          </div>
        @endif
      </div>
      <div class="db-form-group">
        <label>Chip / Poin Singkat (mis. "Berkarakter", "Kompeten")</label>
        <div id="storyChipsList"></div>
        <button type="button" class="sh-add-btn" data-add="story_chips"><i class="fas fa-plus"></i> Tambah Chip</button>
      </div>
    </div>
  </div>

  {{-- ================= TAB: GALERI (REPEATER) ================= --}}
  <div class="sh-tab-panel" data-panel="gallery">
    <div class="db-panel">
      <div class="db-panel-head">
        <h2 style="font-size:.9rem">Galeri Mosaic</h2>
        <span class="db-panel-actions" style="font-size:.75rem;color:var(--text-muted)">Tandai satu sebagai "Utama" untuk jadi kartu besar</span>
      </div>
      <div id="galleryList"></div>
      <button type="button" class="sh-add-btn" data-add="gallery"><i class="fas fa-plus"></i> Tambah Foto</button>
    </div>
  </div>

  {{-- ================= TAB: KEPALA SEKOLAH (REPEATER) ================= --}}
  <div class="sh-tab-panel" data-panel="principals">
    <div class="db-panel">
      <div class="db-panel-head"><h2 style="font-size:.9rem">Kepala Sekolah dari Masa ke Masa</h2></div>
      <div id="principalsList"></div>
      <button type="button" class="sh-add-btn" data-add="principals"><i class="fas fa-plus"></i> Tambah Kepala Sekolah</button>
    </div>
  </div>

  {{-- ================= TAB: VIRTUAL TOUR ================= --}}
  <div class="sh-tab-panel" data-panel="vt">
    <div class="db-panel">
      <div class="db-panel-head"><h2 style="font-size:.9rem">Virtual Tour 360°</h2></div>
      <div class="db-form-group">
        <label>Judul</label>
        <input type="text" name="vt_title" class="db-form-control" value="{{ old('vt_title', $history->vt_title) }}">
      </div>
      <div class="db-form-group">
        <label>Deskripsi</label>
        <textarea name="vt_desc" class="db-form-control">{{ old('vt_desc', $history->vt_desc) }}</textarea>
      </div>
      <div class="db-form-group">
        <label>Link Virtual Tour</label>
        <input type="text" name="vt_link" class="db-form-control" value="{{ old('vt_link', $history->vt_link) }}" placeholder="https://...">
      </div>
      <div class="db-form-group">
        <label>Gambar Preview</label>
        <input type="file" name="vt_image" class="db-form-control" accept="image/*">
        @if($history->vt_image)
          <div class="sh-img-current">
            <img src="{{ asset('storage/'.$history->vt_image) }}" alt="VT saat ini">
            <span>Gambar saat ini — upload baru untuk mengganti</span>
          </div>
        @endif
      </div>
    </div>
  </div>

  <div class="sh-save-bar">
    <span><i class="fas fa-circle-info" style="color:var(--gold)"></i> Perubahan berlaku setelah disimpan.</span>
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Semua Perubahan</button>
  </div>
</form>

{{-- ================= TEMPLATE (disembunyikan, dipakai JS untuk clone) ================= --}}
<template id="tpl-chapter">
  <div class="sh-repeater-item" data-item>
    <div class="sh-repeater-head">
      <strong>Bab __INDEX_LABEL__</strong>
      <div class="sh-repeater-controls">
        <button type="button" class="sh-icon-mini" data-move="up" title="Naikkan"><i class="fas fa-arrow-up"></i></button>
        <button type="button" class="sh-icon-mini" data-move="down" title="Turunkan"><i class="fas fa-arrow-down"></i></button>
        <button type="button" class="sh-icon-mini danger" data-remove title="Hapus"><i class="fas fa-trash"></i></button>
      </div>
    </div>
    <div class="sh-grid-4">
      <div class="db-form-group"><label>Kicker</label><input type="text" class="db-form-control" name="chapters[__I__][kicker]" placeholder="BAB PERTAMA"></div>
      <div class="db-form-group"><label>Tahun / Tanggal</label><input type="text" class="db-form-control" name="chapters[__I__][year_label]" placeholder="24 JUNI 2013"></div>
      <div class="db-form-group"><label>Icon (FontAwesome)</label><input type="text" class="db-form-control" name="chapters[__I__][icon]" placeholder="fa-flag"></div>
      <div class="db-form-group"><label>Tag</label><input type="text" class="db-form-control" name="chapters[__I__][tag]" placeholder="Fondasi"></div>
    </div>
    <div class="db-form-group"><label>Judul Singkat (sisi kiri buku)</label><input type="text" class="db-form-control" name="chapters[__I__][short_title]"></div>
    <div class="db-form-group"><label>Deskripsi Singkat</label><textarea class="db-form-control" name="chapters[__I__][short_desc]"></textarea></div>
    <div class="db-form-group"><label>Judul Panjang (halaman detail)</label><input type="text" class="db-form-control" name="chapters[__I__][long_title]"></div>
    <div class="db-form-group"><label>Lead / Kalimat Pembuka</label><input type="text" class="db-form-control" name="chapters[__I__][lead]"></div>
    <div class="db-form-group"><label>Isi Paragraf Lengkap</label><textarea class="db-form-control" name="chapters[__I__][body]"></textarea></div>
    <div class="db-form-group"><label>Catatan / Kutipan</label><textarea class="db-form-control" name="chapters[__I__][note]"></textarea></div>
  </div>
</template>

<template id="tpl-principal">
  <div class="sh-repeater-item" data-item>
    <div class="sh-repeater-head">
      <strong>Kepala Sekolah __INDEX_LABEL__</strong>
      <div class="sh-repeater-controls">
        <button type="button" class="sh-icon-mini" data-move="up" title="Naikkan"><i class="fas fa-arrow-up"></i></button>
        <button type="button" class="sh-icon-mini" data-move="down" title="Turunkan"><i class="fas fa-arrow-down"></i></button>
        <button type="button" class="sh-icon-mini danger" data-remove title="Hapus"><i class="fas fa-trash"></i></button>
      </div>
    </div>
    <div class="sh-grid-2">
      <div class="db-form-group"><label>Nama</label><input type="text" class="db-form-control" name="principals[__I__][name]"></div>
      <div class="db-form-group"><label>Periode</label><input type="text" class="db-form-control" name="principals[__I__][period_label]" placeholder="2014 – 2018"></div>
    </div>
    <div class="db-form-group"><label>Caption Singkat</label><textarea class="db-form-control" name="principals[__I__][caption]"></textarea></div>
    <div class="db-form-group">
      <label>Foto</label>
      <input type="file" class="db-form-control" name="principals[__I__][photo]" accept="image/*">
      <input type="hidden" name="principals[__I__][existing_photo]" value="" data-existing-photo>
      <div class="sh-img-current" data-preview style="display:none"><img src="" alt=""><span>Foto saat ini</span></div>
    </div>
    <label class="sh-checkbox-row">
      <input type="checkbox" name="principals[__I__][is_current]" value="1"> Tandai sebagai Kepala Sekolah saat ini
    </label>
  </div>
</template>

<template id="tpl-gallery">
  <div class="sh-repeater-item" data-item>
    <div class="sh-repeater-head">
      <strong>Foto __INDEX_LABEL__</strong>
      <div class="sh-repeater-controls">
        <button type="button" class="sh-icon-mini" data-move="up" title="Naikkan"><i class="fas fa-arrow-up"></i></button>
        <button type="button" class="sh-icon-mini" data-move="down" title="Turunkan"><i class="fas fa-arrow-down"></i></button>
        <button type="button" class="sh-icon-mini danger" data-remove title="Hapus"><i class="fas fa-trash"></i></button>
      </div>
    </div>
    <div class="db-form-group">
      <label>Gambar</label>
      <input type="file" class="db-form-control" name="galleries[__I__][image]" accept="image/*">
      <input type="hidden" name="galleries[__I__][existing_image]" value="" data-existing-image>
      <div class="sh-img-current" data-preview style="display:none"><img src="" alt=""><span>Gambar saat ini</span></div>
    </div>
    <div class="sh-grid-2">
      <div class="db-form-group"><label>Label Kecil</label><input type="text" class="db-form-control" name="galleries[__I__][small_label]" placeholder="Program keahlian"></div>
      <div class="db-form-group"><label>Label Besar</label><input type="text" class="db-form-control" name="galleries[__I__][big_label]" placeholder="APHP · Agribisnis..."></div>
    </div>
    <label class="sh-checkbox-row">
      <input type="checkbox" name="galleries[__I__][is_featured]" value="1"> Jadikan kartu utama (besar)
    </label>
  </div>
</template>

<template id="tpl-chip">
  <div class="sh-chip-input-row" data-item>
    <input type="text" class="db-form-control" name="story_chips[]" placeholder="Berkarakter">
    <button type="button" class="sh-icon-mini danger" data-remove title="Hapus"><i class="fas fa-trash"></i></button>
  </div>
</template>
@endsection

@push('scripts')
<script>
(function () {
  // ---------- TAB SWITCH ----------
  const tabBtns = document.querySelectorAll('.sh-tab-btn');
  const panels = document.querySelectorAll('.sh-tab-panel');
  tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      tabBtns.forEach(b => b.classList.remove('active'));
      panels.forEach(p => p.classList.remove('active'));
      btn.classList.add('active');
      document.querySelector(`.sh-tab-panel[data-panel="${btn.dataset.tab}"]`).classList.add('active');
    });
  });

  // ---------- REPEATER ENGINE ----------
  function setupRepeater({ listSelector, templateId, indexLabelPrefix = '' }) {
    const list = document.querySelector(listSelector);
    const tpl = document.getElementById(templateId);
    if (!list || !tpl) return null;

    function reindex() {
      list.querySelectorAll('[data-item]').forEach((item, i) => {
        item.querySelectorAll('[name]').forEach(el => {
          el.name = el.name.replace(/\[\d+\]|\[__I__\]/, `[${i}]`);
        });
        const label = item.querySelector('strong');
        if (label) label.textContent = label.textContent.replace(/\d+$/, '').trim() + ' ' + (i + 1);
      });
    }

    function addItem(data) {
      const html = tpl.innerHTML.replaceAll('__I__', String(list.children.length)).replaceAll('__INDEX_LABEL__', String(list.children.length + 1));
      const wrap = document.createElement('div');
      wrap.innerHTML = html.trim();
      const node = wrap.firstElementChild;
      list.appendChild(node);

      if (data) fillItem(node, data);

      node.querySelector('[data-remove]')?.addEventListener('click', () => { node.remove(); reindex(); });
      node.querySelector('[data-move="up"]')?.addEventListener('click', () => {
        const prev = node.previousElementSibling;
        if (prev) { list.insertBefore(node, prev); reindex(); }
      });
      node.querySelector('[data-move="down"]')?.addEventListener('click', () => {
        const next = node.nextElementSibling;
        if (next) { list.insertBefore(next, node); reindex(); }
      });
      return node;
    }

    function fillItem(node, data) {
      Object.keys(data).forEach(key => {
        const el = node.querySelector(`[name$="[${key}]"]`);
        if (!el) return;
        if (el.type === 'checkbox') el.checked = !!data[key];
        else el.value = data[key] ?? '';
      });
      if (data.existing_photo) {
        const hidden = node.querySelector('[data-existing-photo]');
        const preview = node.querySelector('[data-preview]');
        if (hidden) hidden.value = data.existing_photo;
        if (preview) { preview.style.display = 'flex'; preview.querySelector('img').src = data.photo_url; }
      }
      if (data.existing_image) {
        const hidden = node.querySelector('[data-existing-image]');
        const preview = node.querySelector('[data-preview]');
        if (hidden) hidden.value = data.existing_image;
        if (preview) { preview.style.display = 'flex'; preview.querySelector('img').src = data.image_url; }
      }
    }

    return { addItem, reindex };
  }

  const chapters   = setupRepeater({ listSelector: '#chaptersList',   templateId: 'tpl-chapter'   });
  const principals = setupRepeater({ listSelector: '#principalsList', templateId: 'tpl-principal' });
  const galleries  = setupRepeater({ listSelector: '#galleryList',    templateId: 'tpl-gallery'   });
  const chips      = setupRepeater({ listSelector: '#storyChipsList', templateId: 'tpl-chip'      });

  document.querySelectorAll('[data-add]').forEach(btn => {
    btn.addEventListener('click', () => {
      ({ chapters, principals, gallery: galleries, story_chips: chips })[btn.dataset.add]?.addItem();
    });
  });

  // ---------- PRE-FILL DATA DARI SERVER ----------
  const seedChapters = @json($history->chapters);
  const seedPrincipals = @json($history->principals);
  const seedGalleries = @json($history->galleries);

  seedChapters.forEach(c => chapters.addItem(c));
  seedPrincipals.forEach(p => principals.addItem({ ...p, existing_photo: p.photo, photo_url: p.photo ? '{{ asset('storage') }}/' + p.photo : '' }));
  seedGalleries.forEach(g => galleries.addItem({ ...g, existing_image: g.image, image_url: g.image ? '{{ asset('storage') }}/' + g.image : '' }));

  const seedChips = @json($history->story_chips ?? []);
  if (seedChips.length) {
    seedChips.forEach(c => chips.addItem({}).querySelector('input').value = c);
  } else {
    chips.addItem();
  }

  // Kalau semua kosong (data baru), beri 1 baris kosong biar gak bingung
  if (!seedChapters.length) chapters.addItem();
  if (!seedPrincipals.length) principals.addItem();
  if (!seedGalleries.length) galleries.addItem();
})();
</script>
@endpush