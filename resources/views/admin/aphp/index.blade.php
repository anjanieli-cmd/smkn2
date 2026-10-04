@extends('layouts.admin')

@section('title', 'Program Keahlian APHP — Admin')

@push('styles')
<style>
  .mj-back{display:inline-flex;align-items:center;gap:.45rem;font-size:.78rem;font-weight:700;color:var(--gold-light);text-decoration:none;margin-bottom:.9rem}
  .mj-back:hover{text-decoration:underline}
  .mj-code{display:inline-block;padding:.25rem .7rem;border-radius:8px;font-weight:800;font-size:.8rem;letter-spacing:.06em;
    background:rgba(255,179,0,.15);color:var(--gold-light);border:1px solid rgba(255,179,0,.3);margin-right:.4rem}

  .mj-tabs{display:flex;flex-wrap:wrap;gap:.45rem;margin:0 0 1.3rem;padding-bottom:1rem;border-bottom:1px solid rgba(255,255,255,.09)}
  .mj-tab{display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1rem;border-radius:999px;text-decoration:none;
    font-size:.78rem;font-weight:800;color:rgba(255,255,255,.85);background:rgba(255,255,255,.05);
    border:1px solid rgba(255,255,255,.12);transition:all .2s var(--ease)}
  .mj-tab:hover{background:rgba(255,255,255,.12)}
  .mj-tab.active{background:linear-gradient(135deg,var(--gold-light),var(--gold));color:var(--ink);border-color:transparent}

  .mj-intro{display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.2rem;
    padding:1rem 1.2rem;border-radius:14px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1)}
  .mj-intro strong{display:block;color:#fff;font-size:.95rem}
  .mj-intro span{display:block;font-size:.76rem;color:var(--text-muted);margin-top:.25rem;line-height:1.5}

  .mj-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem .85rem;border-radius:10px;font-size:.76rem;font-weight:700;text-decoration:none;
    background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.14);color:#fff;cursor:pointer;transition:all .2s var(--ease)}
  .mj-btn:hover{background:rgba(255,255,255,.14)}

  .mj-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
  .mj-grid-2 .wide,.mj-row-grid .wide{grid-column:1/-1}
  @media(max-width:760px){.mj-grid-2,.mj-row-grid{grid-template-columns:1fr!important}}
  .mj-hint{font-size:.7rem;color:var(--text-muted);margin-top:.35rem;line-height:1.5}
  .mj-hint code{background:rgba(255,255,255,.08);padding:.05rem .35rem;border-radius:5px}
  .mj-check{display:flex;align-items:center;gap:.55rem;font-size:.82rem;font-weight:700;color:#fff;cursor:pointer;
    padding:.7rem .9rem;border-radius:10px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08)}
  .mj-check input{width:17px;height:17px;accent-color:var(--gold);cursor:pointer}

  .mj-icon-wrap{display:flex;align-items:center;gap:.6rem}
  .mj-icon-prev{width:40px;height:40px;border-radius:11px;flex-shrink:0;display:grid;place-items:center;
    background:rgba(255,179,0,.15);color:var(--gold-light);border:1px solid rgba(255,179,0,.3)}
  .mj-icon-wrap .db-form-control{flex:1;min-width:0}

  .mj-media{display:flex;gap:1rem;align-items:flex-start}
  .mj-media-prev{width:128px;height:90px;border-radius:12px;overflow:hidden;flex-shrink:0;display:grid;place-items:center;
    background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.16);color:rgba(255,255,255,.35);font-size:1.4rem}
  .mj-media-prev img,.mj-media-prev video{width:100%;height:100%;object-fit:cover;display:block}
  .mj-media-fields{flex:1;min-width:0}
  @media(max-width:560px){.mj-media{flex-direction:column}}

  .mj-rows{display:flex;flex-direction:column;gap:.8rem;margin-bottom:.9rem}
  .mj-row{padding:1rem;border-radius:14px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.1)}
  .mj-row-head{display:flex;align-items:center;justify-content:space-between;gap:.6rem;margin-bottom:.8rem}
  .mj-row-title{font-size:.78rem;font-weight:800;color:var(--gold-light);letter-spacing:.04em}
  .mj-row-title i{opacity:.6;margin-right:.35rem}
  .mj-row-title b{font-family:var(--font-display);margin-left:.15rem}
  .mj-row-actions{display:flex;gap:.35rem}
  .mj-row-grid{display:grid;grid-template-columns:1fr 1fr;gap:.9rem}
  .mj-mini{width:32px;height:32px;border-radius:9px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:#fff;
    display:inline-flex;align-items:center;justify-content:center;cursor:pointer;font-size:.75rem;transition:all .2s var(--ease)}
  .mj-mini:hover{background:rgba(255,255,255,.16)}
  .mj-mini:disabled{opacity:.3;cursor:not-allowed}
  .mj-mini.danger{color:#ff7875;border-color:rgba(226,75,74,.3)}
  .mj-mini.danger:hover{background:rgba(226,75,74,.2)}
  .mj-add{display:flex;align-items:center;justify-content:center;gap:.5rem;padding:.8rem 1rem;border-radius:11px;width:100%;
    background:rgba(255,179,0,.08);color:var(--gold-light);border:1px dashed rgba(255,179,0,.4);font-size:.82rem;font-weight:700;cursor:pointer;transition:all .2s var(--ease)}
  .mj-add:hover{background:rgba(255,179,0,.16);border-color:rgba(255,179,0,.6)}
  .mj-add:disabled{opacity:.35;cursor:not-allowed}

  .mj-savebar{position:sticky;bottom:14px;margin-top:1.6rem;padding:1rem 1.3rem;border-radius:14px;z-index:100;
    background:rgba(12,40,70,.96);border:1px solid rgba(255,255,255,.16);display:flex;align-items:center;justify-content:space-between;gap:1rem;
    backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);box-shadow:0 -8px 28px rgba(0,0,0,.35)}
  .mj-savebar span{font-size:.8rem;color:rgba(255,255,255,.85);display:flex;align-items:center;gap:.5rem;font-weight:600}
</style>
@endpush

@section('content')
<div class="db-panel-head" style="margin-bottom:1.3rem">
  <div>
    <h2><span class="mj-code">{{ $major->code }}</span> {{ $major->name }}</h2>
    <p style="font-size:.8rem;color:var(--text-muted);margin-top:.25rem">
      Halaman admin khusus APHP — atur isi halaman publik section demi section.
      @unless($major->is_active)<strong style="color:#ff7875"> · Saat ini disembunyikan dari website publik.</strong>@endunless
    </p>
  </div>
  <div class="db-panel-actions">
    <a href="{{ url('/keahlian/' . $major->slug) }}" target="_blank" class="mj-btn"><i class="fas fa-up-right-from-square"></i> Lihat Halaman Publik</a>
  </div>
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

<nav class="mj-tabs">
  @foreach($sections as $key => $s)
    <a href="{{ route('admin.aphp.index', ['tab' => $key]) }}" class="mj-tab {{ $tab === $key ? 'active' : '' }}">
      <i class="fas {{ $s['icon'] }}"></i> {{ $s['label'] }}
    </a>
  @endforeach
</nav>

@include('admin.aphp._section')
@endsection

@push('scripts')
<script>
(function () {
  'use strict';

  /* ---------- pratinjau ikon ---------- */
  document.addEventListener('input', function (e) {
    var el = e.target;
    if (!el.matches || !el.matches('input[data-icon]')) return;
    var i = el.closest('.mj-icon-wrap').querySelector('.mj-icon-prev i');
    var v = el.value.trim();
    i.className = 'fas ' + (/^fa-[a-z0-9-]+$/.test(v) ? v : 'fa-circle');
  });

  /* ---------- pratinjau file yang baru dipilih ---------- */
  document.addEventListener('change', function (e) {
    var el = e.target;
    if (!el.matches || !el.matches('input[data-file]')) return;
    var box = el.closest('.mj-media').querySelector('[data-media-prev]');
    var file = el.files && el.files[0];
    if (!file) return;
    var url = URL.createObjectURL(file);
    box.innerHTML = box.getAttribute('data-type') === 'video'
      ? '<video src="' + url + '" muted preload="metadata"></video>'
      : '<img src="' + url + '" alt="">';
  });

  /* ---------- repeater ---------- */
  function renumber(list) {
    var rows = list.querySelectorAll(':scope > [data-row]');
    var max = parseInt(list.getAttribute('data-max') || '99', 10);
    rows.forEach(function (row, idx) {
      var n = row.querySelector('[data-num]');
      if (n) n.textContent = '#' + (idx + 1);
      var up = row.querySelector('[data-move="up"]');
      var down = row.querySelector('[data-move="down"]');
      if (up) up.disabled = idx === 0;
      if (down) down.disabled = idx === rows.length - 1;
    });
    var addBtn = list.parentElement.querySelector('[data-add]');
    if (addBtn) addBtn.disabled = rows.length >= max;
  }

  document.querySelectorAll('[data-rows]').forEach(function (list) {
    renumber(list);

    var addBtn = list.parentElement.querySelector('[data-add]');
    if (addBtn) {
      addBtn.addEventListener('click', function () {
        var max = parseInt(list.getAttribute('data-max') || '99', 10);
        if (list.querySelectorAll(':scope > [data-row]').length >= max) return;
        var tpl = document.getElementById(list.getAttribute('data-tpl'));
        var next = parseInt(list.getAttribute('data-next'), 10);
        list.setAttribute('data-next', next + 1);
        list.insertAdjacentHTML('beforeend', tpl.innerHTML.split('__i__').join(String(next)));
        renumber(list);
        var added = list.lastElementChild;
        if (added) added.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      });
    }

    list.addEventListener('click', function (e) {
      var btn = e.target.closest('button');
      if (!btn) return;
      var row = btn.closest('[data-row]');
      if (!row || row.parentElement !== list) return;

      if (btn.hasAttribute('data-remove')) {
        if (confirm('Hapus baris ini? (Baru benar-benar terhapus setelah kamu menekan Simpan.)')) {
          row.remove();
          renumber(list);
        }
      } else if (btn.getAttribute('data-move') === 'up' && row.previousElementSibling) {
        list.insertBefore(row, row.previousElementSibling);
        renumber(list);
      } else if (btn.getAttribute('data-move') === 'down' && row.nextElementSibling) {
        list.insertBefore(row.nextElementSibling, row);
        renumber(list);
      }
    });
  });
})();
</script>
@endpush
