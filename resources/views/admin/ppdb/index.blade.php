@extends('layouts.admin')

@section('title', 'PPDB — Admin')

@push('styles')
<style>
  .st-tabs{display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1.2rem}
  .st-tab{display:inline-flex;align-items:center;gap:.5rem;padding:.65rem 1.05rem;border-radius:999px;text-decoration:none;
    font-size:.8rem;font-weight:800;color:rgba(255,255,255,.85);background:rgba(255,255,255,.05);
    border:1px solid rgba(255,255,255,.12);transition:all .2s var(--ease)}
  .st-tab:hover{background:rgba(255,255,255,.12)}
  .st-tab.active{background:linear-gradient(135deg,var(--gold-light),var(--gold));color:var(--ink);border-color:transparent}

  .st-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.1rem}
  @media(max-width:760px){.st-grid-2{grid-template-columns:1fr}}
  .st-hint{font-size:.7rem;color:var(--text-muted);margin-top:.35rem;line-height:1.5}
  .st-hint code{background:rgba(255,255,255,.08);padding:.05rem .35rem;border-radius:5px}
  .st-sub{font-size:.72rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:var(--gold-light);margin:1.4rem 0 .8rem}
  .st-sub:first-child{margin-top:0}
  .st-actions{display:flex;flex-wrap:wrap;gap:.6rem;align-items:center;justify-content:space-between;margin-top:1.3rem}
  .st-check{display:flex;align-items:center;gap:.55rem;font-size:.8rem;color:rgba(255,255,255,.85);margin-top:.4rem}
  .st-check input{width:16px;height:16px;accent-color:var(--gold)}

  .st-btn-ghost{display:inline-flex;align-items:center;gap:.45rem;padding:.6rem .9rem;border-radius:10px;font-size:.78rem;font-weight:700;
    background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.14);color:#fff;cursor:pointer;text-decoration:none;transition:all .2s var(--ease)}
  .st-btn-ghost:hover{background:rgba(255,255,255,.14)}
  .st-btn-danger{color:#ff7875;border-color:rgba(226,75,74,.35)}
  .st-btn-danger:hover{background:rgba(226,75,74,.2)}
  .st-mini{width:32px;height:32px;border-radius:9px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:#fff;
    display:inline-flex;align-items:center;justify-content:center;cursor:pointer;font-size:.75rem;transition:all .2s var(--ease)}
  .st-mini:hover{background:rgba(255,255,255,.16)}
  .st-mini:disabled{opacity:.3;cursor:not-allowed}
  .st-inline{display:inline-flex}
  .st-add{display:inline-flex;align-items:center;justify-content:center;gap:.5rem;padding:.55rem 1rem;border-radius:11px;
    background:rgba(255,179,0,.08);color:var(--gold-light);border:1px dashed rgba(255,179,0,.4);
    font-size:.8rem;font-weight:700;text-decoration:none;cursor:pointer;transition:all .2s var(--ease)}
  .st-add:hover{background:rgba(255,179,0,.16);border-color:rgba(255,179,0,.6)}

  .st-photo-row{display:flex;gap:1.2rem;align-items:flex-start;flex-wrap:wrap}
  .st-photo-preview{width:220px;aspect-ratio:16/10;border-radius:14px;overflow:hidden;border:1px solid rgba(255,255,255,.16);
    background:linear-gradient(180deg,#edf5fb,#dce9f4);display:flex;align-items:center;justify-content:center;color:#9db6cc;font-size:2.2rem;flex-shrink:0}
  .st-photo-preview img{width:100%;height:100%;object-fit:cover;display:block}
  .st-photo-side{flex:1;min-width:220px}
  .st-icon-row{display:flex;gap:.6rem;align-items:center}
  .st-ico{width:44px;height:44px;border-radius:11px;background:rgba(255,255,255,.08);display:flex;align-items:center;
    justify-content:center;color:var(--gold-light);flex-shrink:0;font-size:1.05rem}
  .st-icon-row input{flex:1}

  /* daftar baris */
  .pp-head{display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:.4rem}
  .pp-head h2{font-size:.9rem;margin:0}
  .pp-intro{font-size:.78rem;color:var(--text-muted);margin:0 0 1rem;line-height:1.6}
  .pp-list{display:flex;flex-direction:column;gap:.55rem}
  .pp-row{display:flex;align-items:center;gap:.9rem;padding:.7rem .9rem;border-radius:13px;
    border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04)}
  .pp-row.off{opacity:.5}
  .pp-no{font-family:var(--font-display);font-size:1.1rem;font-weight:900;color:var(--gold-light);width:1.8rem;flex-shrink:0;text-align:center}
  .pp-thumb{width:64px;height:44px;border-radius:9px;overflow:hidden;flex-shrink:0;background:rgba(255,255,255,.1);
    display:flex;align-items:center;justify-content:center;color:var(--gold-light)}
  .pp-thumb img{width:100%;height:100%;object-fit:cover;display:block}
  .pp-body{flex:1;min-width:0}
  .pp-body strong{display:block;font-size:.84rem;color:#fff;line-height:1.35}
  .pp-body > span{margin-top:.15rem;font-size:.72rem;color:var(--text-muted);line-height:1.45;
    overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical}
  .pp-chip{display:inline-block;margin-left:.4rem;padding:.1rem .5rem;border-radius:99px;font-size:.62rem;font-weight:800;
    background:rgba(255,179,0,.16);color:var(--gold-light);vertical-align:middle}
  .pp-actions{display:flex;gap:.35rem;flex-shrink:0;align-items:center}
  .pp-empty{font-size:.82rem;color:var(--text-muted);padding:.8rem 0}
  @media(max-width:640px){.pp-row{flex-wrap:wrap}.pp-actions{width:100%;justify-content:flex-end}}

  .st-modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:1rem;
    background:rgba(6,18,34,.72);backdrop-filter:blur(4px)}
  .st-modal.show{display:flex}
  .st-modal-box{width:min(620px,100%);max-height:92vh;overflow-y:auto;border-radius:18px;padding:1.4rem;
    background:#0d2a48;border:1px solid rgba(255,255,255,.16);box-shadow:0 30px 80px rgba(0,0,0,.5)}
  .pp-modal-head{display:flex;align-items:center;justify-content:space-between;gap:1rem;margin-bottom:1rem}
  .pp-modal-head h3{margin:0;font-family:var(--font-display);font-size:1rem;color:#fff}
  .pp-close{width:34px;height:34px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;
    border:1px solid rgba(255,255,255,.18);background:rgba(255,255,255,.06);color:#fff;text-decoration:none}
  .pp-close:hover{background:rgba(255,255,255,.16)}
</style>
@endpush

@section('content')
<div class="db-panel-head">
  <h2>PPDB</h2>
  <span style="font-size:.75rem;color:var(--text-muted)">Kelola teks, jalur, persyaratan, jadwal, program keahlian, dan FAQ di halaman PPDB</span>
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
    <a href="{{ route('admin.ppdb.index', ['tab' => $key]) }}" class="st-tab {{ $tab === $key ? 'active' : '' }}">
      <i class="fas {{ $icon }}"></i> {{ $label }}
    </a>
  @endforeach
</nav>

@if($tab === 'teks')
  <div class="db-panel">
    @include('admin.ppdb._settings')
  </div>
@else
  @include('admin.ppdb._tab-items')
@endif
@endsection
