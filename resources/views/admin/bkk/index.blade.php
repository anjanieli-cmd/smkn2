@extends('layouts.admin')

@section('title', 'BKK & Loker — Admin')

@push('styles')
<style>
  .bk-tabs{display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1.2rem}
  .bk-tab{display:inline-flex;align-items:center;gap:.5rem;padding:.65rem 1.05rem;border-radius:999px;text-decoration:none;
    font-size:.8rem;font-weight:800;color:rgba(255,255,255,.85);background:rgba(255,255,255,.05);
    border:1px solid rgba(255,255,255,.12);transition:all .2s var(--ease)}
  .bk-tab:hover{background:rgba(255,255,255,.12)}
  .bk-tab.active{background:linear-gradient(135deg,var(--gold-light),var(--gold));color:var(--ink);border-color:transparent}

  .bk-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.1rem}
  .bk-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:1.1rem}
  @media(max-width:760px){.bk-grid-2,.bk-grid-3{grid-template-columns:1fr}}
  .bk-hint{font-size:.7rem;color:var(--text-muted);margin-top:.35rem;line-height:1.5}
  .bk-hint code{background:rgba(255,255,255,.08);padding:.05rem .35rem;border-radius:5px}
  .bk-sub{font-size:.72rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:var(--gold-light);margin:1.4rem 0 .8rem}
  .bk-sub:first-child{margin-top:0}
  .bk-actions{display:flex;justify-content:flex-end;margin-top:1.2rem}

  .bk-btn-ghost{display:inline-flex;align-items:center;gap:.45rem;padding:.6rem .9rem;border-radius:10px;font-size:.78rem;font-weight:700;
    background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.14);color:#fff;cursor:pointer;transition:all .2s var(--ease)}
  .bk-btn-ghost:hover{background:rgba(255,255,255,.14)}

  /* ---------- kartu ringkasan status (juga jadi filter) ---------- */
  .bk-stats{display:grid;grid-template-columns:repeat(5,1fr);gap:.7rem;margin-bottom:1.1rem}
  @media(max-width:860px){.bk-stats{grid-template-columns:repeat(3,1fr)}}
  @media(max-width:520px){.bk-stats{grid-template-columns:repeat(2,1fr)}}
  .bk-stat{display:flex;flex-direction:column;gap:.15rem;padding:.8rem 1rem;border-radius:14px;text-decoration:none;
    border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04);transition:all .2s var(--ease);border-left:4px solid var(--c,#8393a6)}
  .bk-stat:hover{background:rgba(255,255,255,.09)}
  .bk-stat.active{background:rgba(255,179,0,.12);border-color:rgba(255,179,0,.5);border-left-color:var(--c,#8393a6)}
  .bk-stat b{font-family:var(--font-display);font-size:1.5rem;font-weight:900;color:#fff;line-height:1}
  .bk-stat span{font-size:.68rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:var(--text-muted)}
  .bk-stat.all{--c:var(--gold)}
  .bk-stat.OPEN{--c:#1e9e55}.bk-stat.UPCOMING{--c:#e0a100}.bk-stat.SELESAI{--c:#d93025}.bk-stat.ARSIP{--c:#8393a6}

  /* ---------- daftar ---------- */
  .bk-list{display:flex;flex-direction:column;gap:.6rem;margin-bottom:1rem}
  .bk-item{display:flex;align-items:center;gap:.9rem;padding:.8rem 1rem;border-radius:14px;
    border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04)}
  .bk-item.off{opacity:.5}
  .bk-no{font-family:var(--font-display);font-size:1.1rem;font-weight:900;color:var(--gold-light);width:1.9rem;flex-shrink:0}
  .bk-letter{width:44px;height:44px;border-radius:13px 13px 13px 4px;flex-shrink:0;display:grid;place-items:center;
    background:linear-gradient(135deg,var(--gold-light),var(--gold));color:var(--ink);font-family:var(--font-display);font-size:1.2rem;font-weight:900}
  .bk-body{flex:1;min-width:0}
  .bk-body strong{display:block;font-size:.85rem;color:#fff;line-height:1.35;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
  .bk-body small{display:block;font-size:.68rem;color:var(--text-muted);margin-top:.25rem;line-height:1.5}
  .bk-badge{display:inline-block;margin-left:.4rem;padding:.1rem .5rem;border-radius:99px;font-size:.62rem;font-weight:800;
    background:rgba(255,179,0,.16);color:var(--gold-light);vertical-align:middle;white-space:nowrap}
  .bk-st{display:inline-block;margin-right:.4rem;padding:.12rem .55rem;border-radius:99px;font-size:.62rem;font-weight:900;letter-spacing:.04em;vertical-align:middle}
  .bk-st.OPEN{background:rgba(52,168,83,.18);color:#7fdca0}
  .bk-st.UPCOMING{background:rgba(255,213,74,.16);color:#ffd54a}
  .bk-st.SELESAI{background:rgba(234,67,53,.18);color:#f59a93}
  .bk-st.ARSIP{background:rgba(255,255,255,.09);color:#b8c5d4}
  .bk-row-actions{display:flex;gap:.35rem;flex-shrink:0;flex-wrap:wrap;justify-content:flex-end;align-items:center}
  .bk-mini{width:32px;height:32px;border-radius:9px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:#fff;
    display:inline-flex;align-items:center;justify-content:center;cursor:pointer;font-size:.75rem;transition:all .2s var(--ease)}
  .bk-mini:hover{background:rgba(255,255,255,.16)}
  .bk-mini:disabled{opacity:.3;cursor:not-allowed}
  .bk-mini.danger{color:#ff7875;border-color:rgba(226,75,74,.3)}
  .bk-mini.danger:hover{background:rgba(226,75,74,.2)}
  .bk-quick{height:32px;padding:0 .5rem;border-radius:9px;border:1px solid rgba(255,255,255,.14);background:#0d2a48;color:#fff;font-size:.7rem;font-weight:700;cursor:pointer}
  .bk-inline{display:inline}
  .bk-empty{font-size:.82rem;color:var(--text-muted);padding:1rem 0}
  .bk-add{display:flex;align-items:center;justify-content:center;gap:.5rem;padding:.8rem 1rem;border-radius:11px;width:100%;
    background:rgba(255,179,0,.08);color:var(--gold-light);border:1px dashed rgba(255,179,0,.4);
    font-size:.82rem;font-weight:700;cursor:pointer;transition:all .2s var(--ease)}
  .bk-add:hover{background:rgba(255,179,0,.16);border-color:rgba(255,179,0,.6)}
  @media(max-width:680px){.bk-item{flex-wrap:wrap}.bk-row-actions{width:100%;justify-content:flex-start}}

  /* ---------- modal ---------- */
  .bk-modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:1rem;
    background:rgba(6,18,34,.72);backdrop-filter:blur(4px)}
  .bk-modal.show{display:flex}
  .bk-modal-box{width:min(760px,100%);max-height:92vh;overflow-y:auto;border-radius:18px;padding:1.4rem;
    background:#0d2a48;border:1px solid rgba(255,255,255,.16);box-shadow:0 30px 80px rgba(0,0,0,.5)}
  .bk-modal-box h3{margin:0 0 1rem;font-family:var(--font-display);font-size:1rem;color:#fff}
  .bk-check{display:flex;align-items:center;gap:.55rem;font-size:.8rem;color:rgba(255,255,255,.85);margin-top:.3rem}
  .bk-check input{width:16px;height:16px;accent-color:var(--gold)}

  /* ---------- foto ---------- */
  .bk-photo-card{display:flex;flex-direction:column;gap:.7rem;padding:1rem;border-radius:14px;border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04)}
  .bk-photo-preview{width:100%;aspect-ratio:16/10;border-radius:12px;overflow:hidden;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.18)}
  .bk-photo-preview img{width:100%;height:100%;object-fit:cover;display:block}
  .bk-photo-card h4{margin:0;font-size:.78rem;color:#fff}
</style>
@endpush

@section('content')
<div class="db-panel-head">
  <h2>BKK &amp; Loker</h2>
  <span style="font-size:.75rem;color:var(--text-muted)">Kelola lowongan, mitra industri, bagian Tentang BKK, dan teks halaman BKK</span>
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

<nav class="bk-tabs">
  @foreach($tabs as $key => [$label, $icon])
    <a href="{{ route('admin.bkk.index', ['tab' => $key]) }}" class="bk-tab {{ $tab === $key ? 'active' : '' }}">
      <i class="fas {{ $icon }}"></i> {{ $label }}
    </a>
  @endforeach
</nav>

@if($tab === 'lowongan')
  @include('admin.bkk._tab-lowongan')
@elseif($tab === 'industri')
  @include('admin.bkk._tab-industri')
@elseif($tab === 'tentang')
  @include('admin.bkk._tab-tentang')
@else
  @include('admin.bkk._tab-teks')
@endif
@endsection
