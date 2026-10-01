@extends('layouts.admin')

@section('title', 'Virtual Tour 360° — Admin')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css">
<style>
  .tr-grid{display:grid;grid-template-columns:300px minmax(0,1fr);gap:1.2rem;align-items:start}
  @media(max-width:980px){.tr-grid{grid-template-columns:1fr}}

  /* ---------- daftar lokasi ---------- */
  .tr-list{display:flex;flex-direction:column;gap:.35rem;margin-bottom:1rem;max-height:62vh;overflow-y:auto;padding-right:.2rem}
  .tr-item{display:flex;align-items:center;gap:.75rem;padding:.7rem .8rem;border-radius:12px;text-decoration:none;
    border:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.03);color:rgba(255,255,255,.85);
    transition:all .2s var(--ease)}
  .tr-item:hover{background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.18)}
  .tr-item.active{background:linear-gradient(135deg,var(--gold-light),var(--gold));color:var(--ink);border-color:transparent}
  .tr-item-icon{width:34px;height:34px;border-radius:10px;display:flex;align-items:center;justify-content:center;
    background:rgba(255,255,255,.08);font-size:.85rem;flex-shrink:0}
  .tr-item.active .tr-item-icon{background:rgba(13,58,102,.15)}
  .tr-item strong{display:block;font-size:.82rem;line-height:1.2}
  .tr-item small{display:block;font-size:.66rem;opacity:.7;margin-top:.15rem}
  .tr-nophoto{color:#ffb86b;margin-left:.35rem}

  /* ---------- form ---------- */
  .tr-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.1rem}
  .tr-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:1.1rem}
  @media(max-width:700px){.tr-grid-2,.tr-grid-3{grid-template-columns:1fr}}
  .tr-hint{font-size:.7rem;color:var(--text-muted);margin-top:.35rem;line-height:1.5}
  .tr-hint code{background:rgba(255,255,255,.08);padding:.05rem .35rem;border-radius:5px}
  .tr-current{margin-top:.6rem;display:flex;align-items:center;gap:.8rem}
  .tr-current img{width:120px;height:60px;object-fit:cover;border-radius:10px;border:1px solid rgba(255,255,255,.14)}
  .tr-current span{font-size:.72rem;color:var(--text-muted)}
  .tr-check{display:flex;align-items:center;gap:.55rem;font-size:.8rem;color:rgba(255,255,255,.85);margin-top:.4rem}
  .tr-check input{width:16px;height:16px;accent-color:var(--gold)}
  details.tr-adv{margin-top:1rem;border:1px dashed rgba(255,255,255,.14);border-radius:12px;padding:.8rem 1rem}
  details.tr-adv summary{cursor:pointer;font-size:.78rem;font-weight:700;color:rgba(255,255,255,.75)}
  details.tr-adv[open] summary{margin-bottom:.9rem}

  .tr-actions{display:flex;flex-wrap:wrap;gap:.6rem;align-items:center;justify-content:space-between;margin-top:1.3rem}
  .tr-actions-left{display:flex;gap:.5rem;flex-wrap:wrap}
  .tr-btn-ghost{display:inline-flex;align-items:center;gap:.45rem;padding:.6rem .9rem;border-radius:10px;font-size:.78rem;font-weight:700;
    background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.14);color:#fff;cursor:pointer;transition:all .2s var(--ease)}
  .tr-btn-ghost:hover{background:rgba(255,255,255,.14)}
  .tr-btn-danger{color:#ff7875;border-color:rgba(226,75,74,.35)}
  .tr-btn-danger:hover{background:rgba(226,75,74,.2)}

  .tr-add-btn{display:flex;align-items:center;justify-content:center;gap:.5rem;padding:.75rem 1rem;border-radius:11px;width:100%;
    background:rgba(255,179,0,.08);color:var(--gold-light);border:1px dashed rgba(255,179,0,.4);
    font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s var(--ease)}
  .tr-add-btn:hover{background:rgba(255,179,0,.16);border-color:rgba(255,179,0,.6)}

  /* ---------- preview pannellum ---------- */
  .tr-preview-wrap{position:relative;border-radius:16px;overflow:hidden;border:1px solid rgba(255,255,255,.12);background:#0a2038}
  #trPano{width:100%;height:420px}
  .tr-toolbar{display:flex;flex-wrap:wrap;align-items:center;gap:.6rem;margin:.9rem 0}
  .tr-mode-btn{display:inline-flex;align-items:center;gap:.5rem;padding:.65rem 1rem;border-radius:999px;font-size:.78rem;font-weight:800;
    background:rgba(13,58,102,.9);color:#fff;border:1px solid rgba(255,255,255,.2);cursor:pointer;transition:background .2s var(--ease)}
  .tr-mode-btn i{color:#ffd54a}
  .tr-mode-btn.on{background:#e64545}
  .tr-mode-btn.on i{color:#fff}
  .tr-mode-text{font-size:.74rem;color:var(--text-muted)}
  .tr-crosshair-on #trPano .pnlm-render-container{cursor:crosshair !important}

  /* pin hotspot di preview — TANPA transition transform (Pannellum yang mengatur posisi) */
  .tr-hs{display:inline-flex;align-items:center;gap:.45rem;background:rgba(13,58,102,.92);color:#fff;font-size:.72rem;font-weight:800;
    padding:.4rem .7rem;border-radius:999px;border:1px solid rgba(255,255,255,.3);white-space:nowrap;cursor:pointer;
    box-shadow:0 8px 20px rgba(10,32,56,.4)}
  .tr-hs i{color:#ffd54a}
  .tr-hs:hover{background:#f9a825;color:#0d3a66}
  .tr-hs:hover i{color:#0d3a66}
  .tr-hs.selected{background:#f9a825;color:#0d3a66}
  .tr-hs.selected i{color:#0d3a66}
  .tr-pin{width:22px;height:22px;border-radius:50%;background:#e64545;border:3px solid #fff;
    box-shadow:0 0 0 5px rgba(230,69,69,.35),0 6px 16px rgba(0,0,0,.45)}

  .tr-noPano{padding:2.2rem 1rem;text-align:center;color:var(--text-muted);font-size:.85rem;
    border:1px dashed rgba(255,255,255,.18);border-radius:14px}
  .tr-noPano i{display:block;font-size:1.6rem;color:var(--gold-light);margin-bottom:.6rem}

  /* ---------- panel form hotspot ---------- */
  .tr-hsform{display:none;margin-top:1rem;background:rgba(255,179,0,.06);border:1px solid rgba(255,179,0,.3);
    border-radius:14px;padding:1.2rem}
  .tr-hsform.show{display:block}
  .tr-hsform h4{margin:0 0 1rem;font-size:.85rem;color:#fff;font-family:var(--font-display)}
  .tr-hs-table{width:100%;border-collapse:collapse;margin-top:.4rem}
  .tr-hs-table th{font-size:.66rem;text-transform:uppercase;letter-spacing:.1em;color:var(--text-muted);text-align:left;
    padding:.5rem .6rem;border-bottom:1px solid rgba(255,255,255,.1)}
  .tr-hs-table td{padding:.65rem .6rem;font-size:.8rem;border-bottom:1px solid rgba(255,255,255,.06);vertical-align:middle}
  .tr-hs-table code{font-size:.72rem;color:var(--gold-light)}
  .tr-hs-row-actions{display:flex;gap:.35rem}
  .tr-mini{width:30px;height:30px;border-radius:8px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:#fff;
    display:inline-flex;align-items:center;justify-content:center;cursor:pointer;font-size:.75rem;transition:all .2s var(--ease)}
  .tr-mini:hover{background:rgba(255,255,255,.16)}
  .tr-mini.danger{color:#ff7875;border-color:rgba(226,75,74,.3)}
  .tr-mini.danger:hover{background:rgba(226,75,74,.2)}
  .tr-empty{font-size:.8rem;color:var(--text-muted);padding:.8rem 0}
</style>
@endpush

@section('content')
<div class="db-panel-head">
  <h2>Virtual Tour 360°</h2>
  <span style="font-size:.75rem;color:var(--text-muted)">Kelola lokasi, foto panorama, dan tombol navigasi antar lokasi</span>
</div>

@if(session('status'))
  <div class="db-panel" style="border-color:rgba(76,201,141,.4);background:rgba(76,201,141,.08);margin-bottom:1.2rem;padding:1rem 1.3rem">
    <span style="color:#5ce0a3;font-size:.85rem;font-weight:700"><i class="fas fa-circle-check"></i> {{ session('status') }}</span>
  </div>
@endif

@if($errors->any())
  <div class="db-panel" style="border-color:rgba(226,75,74,.4);background:rgba(226,75,74,.08);margin-bottom:1.2rem;padding:1rem 1.3rem">
    <strong style="color:#ff7875;font-size:.85rem"><i class="fas fa-triangle-exclamation"></i> Ada yang perlu diperbaiki:</strong>
    <ul style="margin:.5rem 0 0 1.1rem;color:#ffb3b1;font-size:.8rem">
      @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
    </ul>
  </div>
@endif

<div class="tr-grid">

  {{-- ================= KIRI: DAFTAR LOKASI ================= --}}
  <div class="db-panel">
    <div class="db-panel-head"><h2 style="font-size:.9rem">Daftar Lokasi ({{ $scenes->count() }})</h2></div>

    <div class="tr-list">
      @forelse($scenes as $s)
        <a href="{{ route('admin.tour.index', ['scene' => $s->id]) }}"
           class="tr-item {{ $selected && $selected->id === $s->id ? 'active' : '' }}">
          <span class="tr-item-icon"><i class="fas {{ $s->icon }}"></i></span>
          <span>
            <strong>{{ $s->title }}</strong>
            <small>
              {{ ['area' => 'Area Sekolah', 'kelas' => 'Program Keahlian', 'fasilitas' => 'Fasilitas'][$s->category] ?? $s->category }}
              @if($s->is_home) · Lokasi Awal @endif
              @if(!$s->panorama)<i class="fas fa-triangle-exclamation tr-nophoto" title="Belum ada foto"></i>@endif
            </small>
          </span>
        </a>
      @empty
        <div class="tr-empty">Belum ada lokasi.</div>
      @endforelse
    </div>

    <a href="{{ route('admin.tour.index', ['new' => 1]) }}" class="tr-add-btn"><i class="fas fa-plus"></i> Tambah Lokasi</a>
  </div>

  {{-- ================= KANAN: EDITOR ================= --}}
  <div>
    @if($isNew)
      {{-- ---------- FORM TAMBAH LOKASI ---------- --}}
      <div class="db-panel">
        <div class="db-panel-head"><h2 style="font-size:.9rem">Tambah Lokasi Baru</h2></div>
        <form action="{{ route('admin.tour.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @include('admin.tour._scene-fields', ['scene' => null])
          <div class="tr-actions">
            <a href="{{ route('admin.tour.index') }}" class="tr-btn-ghost">Batal</a>
            <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Lokasi</button>
          </div>
        </form>
        <p class="tr-hint" style="margin-top:1rem">Setelah lokasi tersimpan, kamu bisa menambahkan tombol navigasi (hotspot) langsung di atas foto panoramanya.</p>
      </div>

    @elseif($selected)
      {{-- ---------- FORM EDIT LOKASI ---------- --}}
      <div class="db-panel" style="margin-bottom:1.2rem">
        <div class="db-panel-head">
          <h2 style="font-size:.9rem">Edit: {{ $selected->title }}</h2>
          <span style="font-size:.7rem;color:var(--text-muted)">slug: <code>{{ $selected->slug }}</code></span>
        </div>

        <form action="{{ route('admin.tour.update', $selected) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          @include('admin.tour._scene-fields', ['scene' => $selected])
          <div class="tr-actions">
            <div class="tr-actions-left">
              <button type="submit" form="trMoveUp" class="tr-btn-ghost"><i class="fas fa-arrow-up"></i> Naikkan</button>
              <button type="submit" form="trMoveDown" class="tr-btn-ghost"><i class="fas fa-arrow-down"></i> Turunkan</button>
              <button type="submit" form="trDeleteScene" class="tr-btn-ghost tr-btn-danger"
                      onclick="return confirm('Hapus lokasi ini? Hotspot yang menuju ke lokasi ini juga akan ikut terhapus.')">
                <i class="fas fa-trash"></i> Hapus Lokasi
              </button>
            </div>
            <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Perubahan</button>
          </div>
        </form>

        {{-- form terpisah (tidak boleh nested) --}}
        <form id="trMoveUp" action="{{ route('admin.tour.move', [$selected, 'up']) }}" method="POST" style="display:none">@csrf</form>
        <form id="trMoveDown" action="{{ route('admin.tour.move', [$selected, 'down']) }}" method="POST" style="display:none">@csrf</form>
        <form id="trDeleteScene" action="{{ route('admin.tour.destroy', $selected) }}" method="POST" style="display:none">@csrf @method('DELETE')</form>
      </div>

      {{-- ---------- PREVIEW + HOTSPOT ---------- --}}
      <div class="db-panel">
        <div class="db-panel-head">
          <h2 style="font-size:.9rem">Tombol Navigasi (Hotspot)</h2>
          <span style="font-size:.72rem;color:var(--text-muted)">Klik langsung di foto untuk menaruh tombol — tanpa hitung koordinat manual</span>
        </div>

        @if($selected->panorama_url)
          <div class="tr-preview-wrap"><div id="trPano"></div></div>

          <div class="tr-toolbar">
            <button type="button" class="tr-mode-btn" id="trModeBtn"><i class="fas fa-location-crosshairs"></i> <span>Tambah Hotspot: OFF</span></button>
            <span class="tr-mode-text" id="trModeText">Geser foto untuk melihat sekeliling. Nyalakan mode tambah, lalu klik titik yang diinginkan.</span>
          </div>

          {{-- form tambah / edit hotspot (dipakai bergantian oleh JS) --}}
          <div class="tr-hsform" id="trHsForm">
            <h4 id="trHsTitle">Hotspot Baru</h4>
            <form id="trHsFormEl" action="{{ route('admin.tour.hotspots.store', $selected) }}" method="POST">
              @csrf
              <input type="hidden" name="_method" id="trHsMethod" value="POST" disabled>
              <div class="tr-grid-2">
                <div class="db-form-group">
                  <label>Menuju Lokasi</label>
                  <select name="target_scene_id" id="trHsTarget" class="db-form-control" required>
                    <option value="">— pilih lokasi tujuan —</option>
                    @foreach($scenes as $s)
                      @if($s->id !== $selected->id)
                        <option value="{{ $s->id }}">{{ $s->title }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="db-form-group">
                  <label>Label Tombol</label>
                  <input type="text" name="label" id="trHsLabel" class="db-form-control" placeholder="Menuju Lobi" required maxlength="120">
                </div>
              </div>
              <div class="tr-grid-3">
                <div class="db-form-group">
                  <label>Pitch (vertikal)</label>
                  <input type="number" step="0.01" name="pitch" id="trHsPitch" class="db-form-control" required>
                </div>
                <div class="db-form-group">
                  <label>Yaw (horizontal)</label>
                  <input type="number" step="0.01" name="yaw" id="trHsYaw" class="db-form-control" required>
                </div>
                <div class="db-form-group">
                  <label>Ikon (FontAwesome)</label>
                  <input type="text" name="icon" id="trHsIcon" class="db-form-control" placeholder="fa-plus" value="fa-plus">
                </div>
              </div>
              <p class="tr-hint">Pitch &amp; yaw terisi otomatis saat kamu klik di foto. Kamu juga bisa menyesuaikannya manual, lalu lihat hasilnya di preview setelah disimpan.</p>
              <div class="tr-actions" style="margin-top:1rem">
                <div class="tr-actions-left">
                  <button type="button" class="tr-btn-ghost" id="trHsCancel">Batal</button>
                  <button type="submit" form="trHsDelete" class="tr-btn-ghost tr-btn-danger" id="trHsDeleteBtn" style="display:none"
                          onclick="return confirm('Hapus hotspot ini?')"><i class="fas fa-trash"></i> Hapus</button>
                </div>
                <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan Hotspot</button>
              </div>
            </form>
            <form id="trHsDelete" method="POST" style="display:none">@csrf @method('DELETE')</form>
          </div>

          {{-- daftar hotspot --}}
          @if($selected->hotspots->count())
            <table class="tr-hs-table">
              <thead><tr><th>Label</th><th>Menuju</th><th>Pitch / Yaw</th><th style="width:80px"></th></tr></thead>
              <tbody>
                @foreach($selected->hotspots as $h)
                  <tr>
                    <td><i class="fas {{ $h->icon }}" style="color:var(--gold-light);margin-right:.4rem"></i>{{ $h->label }}</td>
                    <td>{{ $h->target->title ?? '—' }}</td>
                    <td><code>{{ rtrim(rtrim(number_format($h->pitch, 2, '.', ''), '0'), '.') }} / {{ rtrim(rtrim(number_format($h->yaw, 2, '.', ''), '0'), '.') }}</code></td>
                    <td>
                      <div class="tr-hs-row-actions">
                        <button type="button" class="tr-mini" data-edit-hs="{{ $h->id }}" title="Edit"><i class="fas fa-pen"></i></button>
                        <button type="button" class="tr-mini" data-goto-hs="{{ $h->id }}" title="Lihat di foto"><i class="fas fa-eye"></i></button>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <div class="tr-empty">Belum ada hotspot di lokasi ini.</div>
          @endif
        @else
          <div class="tr-noPano">
            <i class="fas fa-camera-retro"></i>
            Lokasi ini belum punya foto panorama.<br>
            Upload foto 360° (equirectangular) di formulir di atas dulu, baru hotspot bisa ditambahkan.
          </div>
        @endif
      </div>

    @else
      <div class="db-panel">
        <div class="tr-empty">Belum ada lokasi. Klik <strong>Tambah Lokasi</strong> di sebelah kiri untuk memulai.</div>
      </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
@if(!$isNew && $selected && $selected->panorama_url)
@php
  $sceneData = [
    'panorama' => $selected->panorama_url,
    'haov'     => $selected->haov,
    'vaov'     => $selected->vaov,
    'vOffset'  => $selected->v_offset,
  ];
  $hotspotData = $selected->hotspots->map(fn ($h) => [
    'id'              => $h->id,
    'pitch'           => $h->pitch,
    'yaw'             => $h->yaw,
    'label'           => $h->label,
    'icon'            => $h->icon,
    'target_scene_id' => $h->target_scene_id,
  ])->values();
@endphp
<script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
<script>
(function () {
  var scene = @json($sceneData);
  var hotspots = @json($hotspotData);

  var storeUrl  = @json(route('admin.tour.hotspots.store', $selected));
  var updateUrl = @json(url('admin/tour/hotspots')) + '/';   // + id
  var PIN_ID = 'trCalibPin';

  var wrap      = document.querySelector('.tr-preview-wrap');
  var modeBtn   = document.getElementById('trModeBtn');
  var modeText  = document.getElementById('trModeText');
  var formBox   = document.getElementById('trHsForm');
  var formEl    = document.getElementById('trHsFormEl');
  var methodEl  = document.getElementById('trHsMethod');
  var titleEl   = document.getElementById('trHsTitle');
  var fPitch    = document.getElementById('trHsPitch');
  var fYaw      = document.getElementById('trHsYaw');
  var fLabel    = document.getElementById('trHsLabel');
  var fTarget   = document.getElementById('trHsTarget');
  var fIcon     = document.getElementById('trHsIcon');
  var delForm   = document.getElementById('trHsDelete');
  var delBtn    = document.getElementById('trHsDeleteBtn');
  var addMode   = false;
  var editingId = null;

  function esc(s){ var d = document.createElement('div'); d.textContent = s; return d.innerHTML; }

  function hsTooltip(div, args) {
    div.classList.add('tr-hs');
    div.setAttribute('data-hs', args.id);
    div.innerHTML = '<i class="fas ' + esc(args.icon || 'fa-plus') + '"></i>' + esc(args.label);
    div.addEventListener('click', function (e) { e.stopPropagation(); openEdit(args.id); });
  }
  function pinTooltip(div) { div.classList.add('tr-pin'); }

  var viewer = pannellum.viewer('trPano', {
    type: 'equirectangular',
    panorama: scene.panorama,
    haov: scene.haov,
    vaov: scene.vaov,
    vOffset: scene.vOffset || 0,
    yaw:   hotspots[0] ? hotspots[0].yaw : 0,
    pitch: hotspots[0] ? hotspots[0].pitch : 0,
    hfov: 100,
    autoLoad: true,
    showZoomCtrl: true,
    showFullscreenCtrl: true,
    compass: false,
    hotSpots: hotspots.map(function (h) {
      return { id: 'hs' + h.id, pitch: h.pitch, yaw: h.yaw, type: 'custom',
               createTooltipFunc: hsTooltip,
               createTooltipArgs: { id: h.id, label: h.label, icon: h.icon } };
    })
  });

  /* ---------- mode tambah hotspot ---------- */
  function setMode(on) {
    addMode = on;
    modeBtn.classList.toggle('on', on);
    modeBtn.querySelector('span').textContent = 'Tambah Hotspot: ' + (on ? 'ON' : 'OFF');
    wrap.classList.toggle('tr-crosshair-on', on);
    modeText.textContent = on
      ? 'Klik titik di foto tempat tombol akan ditaruh (mis. di pintu / tulisan).'
      : 'Geser foto untuk melihat sekeliling. Nyalakan mode tambah, lalu klik titik yang diinginkan.';
    if (!on) removePin();
  }
  function removePin() { try { viewer.removeHotSpot(PIN_ID); } catch (e) {} }
  function placePin(pitch, yaw) {
    removePin();
    viewer.addHotSpot({ id: PIN_ID, pitch: pitch, yaw: yaw, type: 'custom', createTooltipFunc: pinTooltip });
  }

  modeBtn.addEventListener('click', function () { setMode(!addMode); });

  // bedakan "klik" dan "geser/drag" supaya memutar foto tidak menaruh pin
  var down = null;
  wrap.addEventListener('mousedown', function (e) { down = { x: e.clientX, y: e.clientY }; });
  wrap.addEventListener('click', function (e) {
    if (!addMode || !down) return;
    if (e.target.closest('.tr-hs, .pnlm-controls-container, .pnlm-controls')) return;
    var moved = Math.abs(e.clientX - down.x) + Math.abs(e.clientY - down.y);
    if (moved > 6) return;
    var c = viewer.mouseEventToCoords(e);   // [pitch, yaw]
    openAdd(c[0], c[1]);
  });

  /* ---------- form hotspot ---------- */
  function showForm() { formBox.classList.add('show'); formBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' }); }

  function openAdd(pitch, yaw) {
    editingId = null;
    titleEl.textContent = 'Hotspot Baru';
    formEl.action = storeUrl;
    methodEl.disabled = true;
    delBtn.style.display = 'none';
    fPitch.value = pitch.toFixed(2);
    fYaw.value = yaw.toFixed(2);
    fLabel.value = '';
    fTarget.value = '';
    fIcon.value = 'fa-plus';
    placePin(pitch, yaw);
    showForm();
    fTarget.focus();
  }

  function openEdit(id) {
    var h = hotspots.filter(function (x) { return x.id === id; })[0];
    if (!h) return;
    editingId = id;
    setMode(false);
    titleEl.textContent = 'Edit Hotspot: ' + h.label;
    formEl.action = updateUrl + id;
    methodEl.value = 'PUT';
    methodEl.disabled = false;
    delForm.action = updateUrl + id;
    delBtn.style.display = '';
    fPitch.value = h.pitch;
    fYaw.value = h.yaw;
    fLabel.value = h.label;
    fTarget.value = h.target_scene_id;
    fIcon.value = h.icon;
    viewer.lookAt(h.pitch, h.yaw, 100, 600);
    document.querySelectorAll('.tr-hs').forEach(function (el) {
      el.classList.toggle('selected', Number(el.getAttribute('data-hs')) === id);
    });
    showForm();
  }

  document.getElementById('trHsCancel').addEventListener('click', function () {
    formBox.classList.remove('show');
    removePin();
    editingId = null;
    document.querySelectorAll('.tr-hs.selected').forEach(function (el) { el.classList.remove('selected'); });
  });

  // ubah pitch/yaw manual -> pin ikut bergeser
  function syncPinFromInputs() {
    if (editingId !== null) return;
    var p = parseFloat(fPitch.value), y = parseFloat(fYaw.value);
    if (!isNaN(p) && !isNaN(y)) placePin(p, y);
  }
  fPitch.addEventListener('change', syncPinFromInputs);
  fYaw.addEventListener('change', syncPinFromInputs);

  /* ---------- tombol di tabel ---------- */
  document.querySelectorAll('[data-edit-hs]').forEach(function (b) {
    b.addEventListener('click', function () { openEdit(Number(b.getAttribute('data-edit-hs'))); });
  });
  document.querySelectorAll('[data-goto-hs]').forEach(function (b) {
    b.addEventListener('click', function () {
      var h = hotspots.filter(function (x) { return x.id === Number(b.getAttribute('data-goto-hs')); })[0];
      if (h) { viewer.lookAt(h.pitch, h.yaw, 100, 600); wrap.scrollIntoView({ behavior: 'smooth', block: 'nearest' }); }
    });
  });
})();
</script>
@endif
@endpush
