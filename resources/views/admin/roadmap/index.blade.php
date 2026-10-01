@extends('layouts.admin')

@section('title', 'Roadmap Pengembangan — Admin')

@push('styles')
  @include('admin.partials.form-kit')
@endpush

@section('content')
<div class="db-panel-head">
  <div>
    <h2><i class="fas fa-road" style="color:var(--gold);margin-right:.5rem"></i> Roadmap Pengembangan</h2>
    <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">Kelola isi halaman Roadmap Skaneda: teks pengantar, statistik, pilar strategis, dan fase perjalanan.</p>
  </div>
  <div class="db-panel-actions">
    <a href="{{ route('profil.roadmap-pengembangan') }}" target="_blank" rel="noopener" class="db-btn db-btn-ghost">
      <i class="fas fa-arrow-up-right-from-square"></i> Lihat Halaman
    </a>
  </div>
</div>

@include('admin.partials.flash')

<form action="{{ route('admin.roadmap.update') }}" method="POST" id="rmForm">
  @csrf
  @method('PUT')

  <div class="ad-tabs">
    <button type="button" class="ad-tab-btn active" data-tab="intro"><i class="fas fa-chart-simple"></i> Intro &amp; Statistik</button>
    <button type="button" class="ad-tab-btn" data-tab="pillars"><i class="fas fa-layer-group"></i> Pilar Strategis</button>
    <button type="button" class="ad-tab-btn" data-tab="phases"><i class="fas fa-route"></i> Fase Perjalanan</button>
  </div>

  {{-- ================= TAB: INTRO & STATISTIK ================= --}}
  <div class="ad-tab-panel active" data-panel="intro">
    <div class="db-panel" style="margin-bottom:1.2rem">
      <div class="db-panel-head"><h2 style="font-size:.9rem">Teks Pengantar</h2></div>
      <div class="db-form-group">
        <label>Paragraf Pengantar Roadmap</label>
        <textarea name="roadmap_intro_copy" class="db-form-control" style="min-height:150px">{{ old('roadmap_intro_copy', $settings['roadmap_intro_copy']) }}</textarea>
      </div>
    </div>

    <div class="db-panel">
      <div class="db-panel-head"><h2 style="font-size:.9rem">Empat Kotak Statistik</h2></div>
      <small class="ad-hint" style="margin:-.4rem 0 1rem">Angka dan label ditulis manual (mis. "25+"), jadi tidak otomatis mengikuti jumlah fase atau pilar di tab lain.</small>
      <div class="ad-grid-2">
        @foreach([1, 2, 3, 4] as $n)
          <div class="ad-repeater-item" style="margin-bottom:0">
            <div class="ad-repeater-head"><strong>Statistik {{ $n }}</strong></div>
            <div style="display:grid;grid-template-columns:110px 1fr;gap:1rem">
              <div class="db-form-group" style="margin-bottom:0">
                <label>Angka</label>
                <input type="text" name="roadmap_stat{{ $n }}_value" class="db-form-control" maxlength="20"
                       value="{{ old("roadmap_stat{$n}_value", $settings["roadmap_stat{$n}_value"]) }}">
              </div>
              <div class="db-form-group" style="margin-bottom:0">
                <label>Label</label>
                <input type="text" name="roadmap_stat{{ $n }}_label" class="db-form-control" maxlength="60"
                       value="{{ old("roadmap_stat{$n}_label", $settings["roadmap_stat{$n}_label"]) }}">
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- ================= TAB: PILAR ================= --}}
  <div class="ad-tab-panel" data-panel="pillars">
    <div class="db-panel">
      <div id="pillarList"></div>
      <button type="button" class="ad-add-btn" id="pillarAdd"><i class="fas fa-plus"></i> Tambah Pilar</button>
      <small class="ad-hint" style="margin-top:.8rem">
        Nomor "Pilar 01, 02, ..." dibuat otomatis mengikuti urutan. Ikon memakai nama FontAwesome (mis. <code>fa-handshake</code>),
        cari di <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" rel="noopener">fontawesome.com/icons</a>.
      </small>
    </div>
  </div>

  {{-- ================= TAB: FASE ================= --}}
  <div class="ad-tab-panel" data-panel="phases">
    <div class="db-panel">
      <div id="phaseList"></div>
      <button type="button" class="ad-add-btn" id="phaseAdd"><i class="fas fa-plus"></i> Tambah Fase</button>
      <small class="ad-hint" style="margin-top:.8rem">
        Nomor fase ("Fase 1, 2, ...") dan letak kiri/kanan pada garis waktu dibuat otomatis mengikuti urutan.
        Tandai <strong>Fase target akhir</strong> untuk memberi lencana "Target &lt;tahun&gt;" dan tampilan khusus (biasanya hanya fase terakhir).
      </small>
    </div>
  </div>

  <div class="ad-save-bar">
    <span><i class="fas fa-circle-info"></i> Semua tab disimpan sekaligus. Perubahan tampil di halaman Roadmap setelah klik Simpan.</span>
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Roadmap</button>
  </div>
</form>

{{-- ================= TEMPLATE ================= --}}
<template id="tpl-pillar">
  <div class="ad-repeater-item" data-item>
    <div class="ad-repeater-head">
      <strong data-label="Pilar">Pilar</strong>
      <div class="ad-repeater-controls">
        <button type="button" class="ad-icon-mini" data-move="up" title="Naikkan"><i class="fas fa-arrow-up"></i></button>
        <button type="button" class="ad-icon-mini" data-move="down" title="Turunkan"><i class="fas fa-arrow-down"></i></button>
        <button type="button" class="ad-icon-mini danger" data-remove title="Hapus"><i class="fas fa-trash"></i></button>
      </div>
    </div>
    <div style="display:grid;grid-template-columns:190px 1fr;gap:1.1rem">
      <div class="db-form-group">
        <label>Ikon</label>
        <input type="text" class="db-form-control" name="pillars[__I__][icon]" placeholder="fa-book-open-reader">
      </div>
      <div class="db-form-group">
        <label>Judul Pilar *</label>
        <input type="text" class="db-form-control" name="pillars[__I__][title]" maxlength="255" placeholder="Digitalisasi Sekolah">
      </div>
    </div>
    <div class="db-form-group">
      <label>Deskripsi</label>
      <textarea class="db-form-control" name="pillars[__I__][text]"></textarea>
    </div>
  </div>
</template>

<template id="tpl-phase">
  <div class="ad-repeater-item" data-item>
    <div class="ad-repeater-head">
      <strong data-label="Fase">Fase</strong>
      <div class="ad-repeater-controls">
        <button type="button" class="ad-icon-mini" data-move="up" title="Naikkan"><i class="fas fa-arrow-up"></i></button>
        <button type="button" class="ad-icon-mini" data-move="down" title="Turunkan"><i class="fas fa-arrow-down"></i></button>
        <button type="button" class="ad-icon-mini danger" data-remove title="Hapus"><i class="fas fa-trash"></i></button>
      </div>
    </div>
    <div class="ad-grid-3">
      <div class="db-form-group">
        <label>Tahun *</label>
        <input type="text" class="db-form-control" name="phases[__I__][year]" maxlength="20" placeholder="2026">
      </div>
      <div class="db-form-group">
        <label>Ikon (titik di garis waktu)</label>
        <input type="text" class="db-form-control" name="phases[__I__][icon]" placeholder="fa-laptop-code">
      </div>
      <div class="db-form-group">
        <label>Tag (label kecil)</label>
        <input type="text" class="db-form-control" name="phases[__I__][tag]" maxlength="60" placeholder="Transformasi">
      </div>
    </div>
    <div class="db-form-group">
      <label>Judul Fase *</label>
      <input type="text" class="db-form-control" name="phases[__I__][title]" maxlength="255" placeholder="Digitalisasi Layanan">
    </div>
    <div class="db-form-group">
      <label>Deskripsi Singkat</label>
      <textarea class="db-form-control" name="phases[__I__][text]"></textarea>
    </div>
    <div class="db-form-group">
      <label>Poin Program (satu baris = satu poin)</label>
      <textarea class="db-form-control" name="phases[__I__][items]" style="min-height:120px" placeholder="Sistem informasi sekolah terpadu&#10;Perpustakaan digital&#10;Penerimaan peserta didik baru secara daring"></textarea>
    </div>
    <label class="ad-check-row">
      <input type="checkbox" name="phases[__I__][is_goal]" value="1"> Fase target akhir (lencana "Target" &amp; tampilan khusus)
    </label>
  </div>
</template>
@endsection

@push('scripts')
  @php
    $seedPillars = $pillars->map(function ($p) {
        return ['icon' => $p->icon, 'title' => $p->title, 'text' => $p->text];
    })->values();

    $seedPhases = $phases->map(function ($p) {
        return [
            'year' => $p->year, 'icon' => $p->icon, 'title' => $p->title, 'text' => $p->text,
            'tag' => $p->tag, 'is_goal' => $p->is_goal,
            'items' => implode("\n", $p->items ?? []),
        ];
    })->values();
  @endphp
  @include('admin.partials.repeater-js')
<script>
(function () {
  // ---------- TAB ----------
  const btns = document.querySelectorAll('.ad-tab-btn');
  const panels = document.querySelectorAll('.ad-tab-panel');
  btns.forEach(btn => btn.addEventListener('click', () => {
    btns.forEach(b => b.classList.remove('active'));
    panels.forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.querySelector(`.ad-tab-panel[data-panel="${btn.dataset.tab}"]`).classList.add('active');
  }));

  // ---------- REPEATER ----------
  const pillars = adSetupRepeater({ listSelector: '#pillarList', templateId: 'tpl-pillar' });
  const phases  = adSetupRepeater({ listSelector: '#phaseList',  templateId: 'tpl-phase'  });

  document.getElementById('pillarAdd').addEventListener('click', () => pillars.addItem());
  document.getElementById('phaseAdd').addEventListener('click', () => phases.addItem());

  const seedPillars = @json($seedPillars);
  const seedPhases  = @json($seedPhases);

  if (seedPillars.length) seedPillars.forEach(r => pillars.addItem(r)); else pillars.addItem();
  if (seedPhases.length)  seedPhases.forEach(r => phases.addItem(r));   else phases.addItem();
})();
</script>
@endpush
