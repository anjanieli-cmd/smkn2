@extends('layouts.admin')

@section('title', 'Struktur Organisasi — Admin')

@push('styles')
<style>
  .st-tabs{display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1.2rem}
  .st-tab{display:inline-flex;align-items:center;gap:.5rem;padding:.65rem 1.05rem;border-radius:999px;text-decoration:none;
    font-size:.8rem;font-weight:800;color:rgba(255,255,255,.85);background:rgba(255,255,255,.05);
    border:1px solid rgba(255,255,255,.12);transition:all .2s var(--ease)}
  .st-tab:hover{background:rgba(255,255,255,.12)}
  .st-tab.active{background:linear-gradient(135deg,var(--gold-light),var(--gold));color:var(--ink);border-color:transparent}

  .st-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.1rem}
  .st-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:1.1rem}
  @media(max-width:760px){.st-grid-2,.st-grid-3{grid-template-columns:1fr}}
  .st-hint{font-size:.7rem;color:var(--text-muted);margin-top:.35rem;line-height:1.5}
  .st-hint code{background:rgba(255,255,255,.08);padding:.05rem .35rem;border-radius:5px}
  .st-sub{font-size:.72rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:var(--gold-light);margin:1.4rem 0 .8rem}
  .st-sub:first-child{margin-top:0}
  .st-actions{display:flex;flex-wrap:wrap;gap:.6rem;align-items:center;justify-content:space-between;margin-top:1.3rem}
  .st-check{display:flex;align-items:center;gap:.55rem;font-size:.8rem;color:rgba(255,255,255,.85);margin-top:.4rem}
  .st-check input{width:16px;height:16px;accent-color:var(--gold)}

  .st-btn-ghost{display:inline-flex;align-items:center;gap:.45rem;padding:.6rem .9rem;border-radius:10px;font-size:.78rem;font-weight:700;
    background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.14);color:#fff;cursor:pointer;transition:all .2s var(--ease)}
  .st-btn-ghost:hover{background:rgba(255,255,255,.14)}
  .st-btn-danger{color:#ff7875;border-color:rgba(226,75,74,.35)}
  .st-btn-danger:hover{background:rgba(226,75,74,.2)}

  .st-mini{width:32px;height:32px;border-radius:9px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:#fff;
    display:inline-flex;align-items:center;justify-content:center;cursor:pointer;font-size:.75rem;transition:all .2s var(--ease)}
  .st-mini:hover{background:rgba(255,255,255,.16)}
  .st-mini:disabled{opacity:.3;cursor:not-allowed}
  .st-mini.danger{color:#ff7875;border-color:rgba(226,75,74,.3)}
  .st-mini.danger:hover{background:rgba(226,75,74,.2)}
  .st-inline{display:inline}

  .st-add{display:flex;align-items:center;justify-content:center;gap:.5rem;padding:.75rem 1rem;border-radius:11px;width:100%;
    background:rgba(255,179,0,.08);color:var(--gold-light);border:1px dashed rgba(255,179,0,.4);
    font-size:.82rem;font-weight:700;text-decoration:none;cursor:pointer;transition:all .2s var(--ease)}
  .st-add:hover{background:rgba(255,179,0,.16);border-color:rgba(255,179,0,.6)}

  /* ---------- master-detail (tab Struktur) ---------- */
  .st-layout{display:grid;grid-template-columns:330px minmax(0,1fr);gap:1.2rem;align-items:start}
  @media(max-width:980px){.st-layout{grid-template-columns:1fr}}
  .st-list{display:flex;flex-direction:column;gap:.3rem;margin-bottom:1rem;max-height:66vh;overflow-y:auto;padding-right:.2rem}
  .st-group{display:flex;align-items:center;justify-content:space-between;gap:.5rem;margin:.9rem 0 .35rem;
    font-size:.66rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:var(--gold-light)}
  .st-group:first-child{margin-top:0}
  .st-group a{color:var(--gold-light);text-decoration:none;font-size:.7rem;padding:.15rem .5rem;border-radius:99px;border:1px solid rgba(255,179,0,.35)}
  .st-group a:hover{background:rgba(255,179,0,.16)}
  .st-row{display:flex;align-items:center;gap:.35rem}
  .st-item{flex:1;min-width:0;display:flex;align-items:center;gap:.7rem;padding:.55rem .7rem;border-radius:12px;text-decoration:none;
    border:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.03);color:rgba(255,255,255,.88);transition:all .2s var(--ease)}
  .st-item:hover{background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.18)}
  .st-item.active{background:linear-gradient(135deg,var(--gold-light),var(--gold));color:var(--ink);border-color:transparent}
  .st-item.off{opacity:.5}
  .st-thumb{width:38px;height:38px;border-radius:50%;flex-shrink:0;overflow:hidden;background:rgba(255,255,255,.1);
    display:flex;align-items:center;justify-content:center;font-size:.85rem}
  .st-thumb img{width:100%;height:100%;object-fit:cover;object-position:center top;display:block}
  .st-item strong{display:block;font-size:.78rem;line-height:1.25;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
  .st-item small{display:block;font-size:.64rem;opacity:.72;margin-top:.12rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
  .st-item .st-body{min-width:0}
  .st-warn{color:#ffb86b;margin-left:.3rem}
  .st-arrows{display:flex;flex-direction:column;gap:2px}
  .st-arrows .st-mini{width:24px;height:16px;border-radius:5px;font-size:.55rem}
  .st-badge{display:inline-block;margin-left:.4rem;padding:.1rem .5rem;border-radius:99px;font-size:.62rem;font-weight:800;
    background:rgba(255,179,0,.16);color:var(--gold-light);vertical-align:middle}
  .st-item.active .st-badge{background:rgba(13,58,102,.15);color:var(--ink)}

  .st-photo-row{display:flex;gap:1.2rem;align-items:flex-start;flex-wrap:wrap}
  .st-photo-preview{width:220px;aspect-ratio:300/270;border-radius:14px;overflow:hidden;border:1px solid rgba(255,255,255,.16);
    background:linear-gradient(180deg,#edf5fb,#dce9f4);display:flex;align-items:center;justify-content:center;color:#9db6cc;font-size:2.4rem;flex-shrink:0}
  .st-photo-preview img{width:100%;height:100%;object-fit:cover;object-position:center top;display:block}
  .st-photo-side{flex:1;min-width:220px}
  .st-icon-row{display:flex;gap:.6rem;align-items:center}
  .st-ico{width:44px;height:44px;border-radius:11px;background:rgba(255,255,255,.08);display:flex;align-items:center;
    justify-content:center;color:var(--gold-light);flex-shrink:0;font-size:1.05rem}
  .st-icon-row input{flex:1}

  /* ---------- daftar kartu (tab Alur Kerja) ---------- */
  .st-cards{display:flex;flex-direction:column;gap:.6rem;margin-bottom:1rem}
  .st-card{display:flex;align-items:flex-start;gap:.9rem;padding:.9rem 1rem;border-radius:14px;
    border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04)}
  .st-card.off{opacity:.5}
  .st-card .st-no{font-family:var(--font-display);font-size:1.3rem;font-weight:900;color:var(--gold-light);width:2.1rem;flex-shrink:0;line-height:1.3}
  .st-card .st-ico{width:38px;height:38px;font-size:.95rem}
  .st-card .st-cbody{flex:1;min-width:0}
  .st-card .st-cbody strong{display:block;font-size:.88rem;color:#fff;line-height:1.3}
  .st-card .st-cbody p{margin:.25rem 0 0;font-size:.76rem;line-height:1.55;color:var(--text-muted)}
  .st-row-actions{display:flex;gap:.35rem;flex-shrink:0;flex-wrap:wrap;justify-content:flex-end}
  .st-empty{font-size:.82rem;color:var(--text-muted);padding:1rem 0}

  .st-modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:1rem;
    background:rgba(6,18,34,.72);backdrop-filter:blur(4px)}
  .st-modal.show{display:flex}
  .st-modal-box{width:min(560px,100%);max-height:92vh;overflow-y:auto;border-radius:18px;padding:1.4rem;
    background:#0d2a48;border:1px solid rgba(255,255,255,.16);box-shadow:0 30px 80px rgba(0,0,0,.5)}
  .st-modal-box h3{margin:0 0 1rem;font-family:var(--font-display);font-size:1rem;color:#fff}
</style>
@endpush

@section('content')
<div class="db-panel-head">
  <h2>Struktur Organisasi</h2>
  <span style="font-size:.75rem;color:var(--text-muted)">Kelola bagan, foto, dan teks di halaman Struktur Organisasi sekolah</span>
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

<nav class="st-tabs">
  @foreach($tabs as $key => [$label, $icon])
    <a href="{{ route('admin.struktur.index', ['tab' => $key]) }}" class="st-tab {{ $tab === $key ? 'active' : '' }}">
      <i class="fas {{ $icon }}"></i> {{ $label }}
    </a>
  @endforeach
</nav>

@if($tab === 'hero')
  @include('admin.struktur._tab-hero')
@elseif($tab === 'struktur')
  @include('admin.struktur._tab-members')
@elseif($tab === 'peran')
  @include('admin.struktur._tab-roles')
@endif
@endsection
