@extends('layouts.admin')

@section('title', 'Visi & Misi — Admin')

@push('styles')
<style>
  .vm-tabs{display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1.2rem}
  .vm-tab{display:inline-flex;align-items:center;gap:.5rem;padding:.65rem 1.05rem;border-radius:999px;text-decoration:none;
    font-size:.8rem;font-weight:800;color:rgba(255,255,255,.85);background:rgba(255,255,255,.05);
    border:1px solid rgba(255,255,255,.12);transition:all .2s var(--ease)}
  .vm-tab:hover{background:rgba(255,255,255,.12)}
  .vm-tab.active{background:linear-gradient(135deg,var(--gold-light),var(--gold));color:var(--ink);border-color:transparent}

  .vm-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.1rem}
  @media(max-width:760px){.vm-grid-2{grid-template-columns:1fr}}
  .vm-hint{font-size:.7rem;color:var(--text-muted);margin-top:.35rem;line-height:1.5}
  .vm-hint code{background:rgba(255,255,255,.08);padding:.05rem .35rem;border-radius:5px}
  .vm-sub{font-size:.72rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:var(--gold-light);margin:1.4rem 0 .8rem}
  .vm-sub:first-child{margin-top:0}
  .vm-actions{display:flex;justify-content:flex-end;margin-top:1.2rem}

  .vm-btn-ghost{display:inline-flex;align-items:center;gap:.45rem;padding:.6rem .9rem;border-radius:10px;font-size:.78rem;font-weight:700;
    background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.14);color:#fff;cursor:pointer;transition:all .2s var(--ease)}
  .vm-btn-ghost:hover{background:rgba(255,255,255,.14)}

  /* ---------- daftar kartu ---------- */
  .vm-list{display:flex;flex-direction:column;gap:.6rem;margin-bottom:1rem}
  .vm-item{display:flex;align-items:flex-start;gap:.9rem;padding:.9rem 1rem;border-radius:14px;
    border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04)}
  .vm-item.off{opacity:.5}
  .vm-no{font-family:var(--font-display);font-size:1.3rem;font-weight:900;color:var(--gold-light);width:2.1rem;flex-shrink:0;line-height:1.3}
  .vm-ico{width:38px;height:38px;border-radius:11px;background:rgba(255,255,255,.08);display:flex;align-items:center;
    justify-content:center;color:var(--gold-light);flex-shrink:0}
  .vm-body{flex:1;min-width:0}
  .vm-body strong{display:block;font-size:.88rem;color:#fff;line-height:1.3}
  .vm-body p{margin:.25rem 0 0;font-size:.76rem;line-height:1.55;color:var(--text-muted)}
  .vm-badge{display:inline-block;margin-left:.4rem;padding:.1rem .5rem;border-radius:99px;font-size:.62rem;font-weight:800;
    background:rgba(255,179,0,.16);color:var(--gold-light);vertical-align:middle}
  .vm-row-actions{display:flex;gap:.35rem;flex-shrink:0;flex-wrap:wrap;justify-content:flex-end}
  .vm-mini{width:32px;height:32px;border-radius:9px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:#fff;
    display:inline-flex;align-items:center;justify-content:center;cursor:pointer;font-size:.75rem;transition:all .2s var(--ease)}
  .vm-mini:hover{background:rgba(255,255,255,.16)}
  .vm-mini:disabled{opacity:.3;cursor:not-allowed}
  .vm-mini.danger{color:#ff7875;border-color:rgba(226,75,74,.3)}
  .vm-mini.danger:hover{background:rgba(226,75,74,.2)}
  .vm-inline{display:inline}
  .vm-empty{font-size:.82rem;color:var(--text-muted);padding:1rem 0}
  .vm-add{display:flex;align-items:center;justify-content:center;gap:.5rem;padding:.8rem 1rem;border-radius:11px;width:100%;
    background:rgba(255,179,0,.08);color:var(--gold-light);border:1px dashed rgba(255,179,0,.4);
    font-size:.82rem;font-weight:700;cursor:pointer;transition:all .2s var(--ease)}
  .vm-add:hover{background:rgba(255,179,0,.16);border-color:rgba(255,179,0,.6)}

  /* ---------- modal ---------- */
  .vm-modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:1rem;
    background:rgba(6,18,34,.72);backdrop-filter:blur(4px)}
  .vm-modal.show{display:flex}
  .vm-modal-box{width:min(560px,100%);max-height:92vh;overflow-y:auto;border-radius:18px;padding:1.4rem;
    background:#0d2a48;border:1px solid rgba(255,255,255,.16);box-shadow:0 30px 80px rgba(0,0,0,.5)}
  .vm-modal-box h3{margin:0 0 1rem;font-family:var(--font-display);font-size:1rem;color:#fff}
  .vm-icon-row{display:flex;gap:.6rem;align-items:center}
  .vm-icon-row .vm-ico{width:44px;height:44px;font-size:1.05rem}
  .vm-icon-row input{flex:1}
  .vm-check{display:flex;align-items:center;gap:.55rem;font-size:.8rem;color:rgba(255,255,255,.85);margin-top:.2rem}
  .vm-check input{width:16px;height:16px;accent-color:var(--gold)}
</style>
@endpush

@section('content')
<div class="db-panel-head">
  <h2>Visi &amp; Misi</h2>
  <span style="font-size:.75rem;color:var(--text-muted)">Kelola teks dan kartu di halaman Visi &amp; Misi sekolah</span>
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

<nav class="vm-tabs">
  @foreach($tabs as $key => [$label, $icon])
    <a href="{{ route('admin.visi-misi.index', ['tab' => $key]) }}" class="vm-tab {{ $tab === $key ? 'active' : '' }}">
      <i class="fas {{ $icon }}"></i> {{ $label }}
    </a>
  @endforeach
</nav>

@if($tab === 'hero')
  @include('admin.visi-misi._tab-hero')
@elseif($tab === 'visi')
  @include('admin.visi-misi._tab-visi')
@elseif($tab === 'misi')
  @include('admin.visi-misi._tab-list', ['withIcon' => true, 'itemLabel' => 'Misi', 'showHeadDesc' => true])
@elseif($tab === 'tujuan')
  @include('admin.visi-misi._tab-list', ['withIcon' => false, 'itemLabel' => 'Tujuan', 'showHeadDesc' => false])
@elseif($tab === 'nilai')
  @include('admin.visi-misi._tab-list', ['withIcon' => true, 'itemLabel' => 'Nilai', 'showHeadDesc' => true])
@endif
@endsection
