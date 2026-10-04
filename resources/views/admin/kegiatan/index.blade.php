@extends('layouts.admin')

@section('title', 'Kegiatan — Admin')

@push('styles')
<style>
  .kd-tabs{display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1.2rem}
  .kd-tab{display:inline-flex;align-items:center;gap:.5rem;padding:.65rem 1.05rem;border-radius:999px;text-decoration:none;
    font-size:.8rem;font-weight:800;color:rgba(255,255,255,.85);background:rgba(255,255,255,.05);
    border:1px solid rgba(255,255,255,.12);transition:all .2s var(--ease)}
  .kd-tab:hover{background:rgba(255,255,255,.12)}
  .kd-tab.active{background:linear-gradient(135deg,var(--gold-light),var(--gold));color:var(--ink);border-color:transparent}

  .kd-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.1rem}
  .kd-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:1.1rem}
  .kd-grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:1.1rem}
  @media(max-width:900px){.kd-grid-3,.kd-grid-4{grid-template-columns:1fr 1fr}}
  @media(max-width:620px){.kd-grid-2,.kd-grid-3,.kd-grid-4{grid-template-columns:1fr}}
  .kd-hint{font-size:.7rem;color:var(--text-muted);margin-top:.35rem;line-height:1.5}
  .kd-hint code{background:rgba(255,255,255,.08);padding:.05rem .35rem;border-radius:5px}
  .kd-sub{font-size:.72rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:var(--gold-light);margin:1.4rem 0 .8rem}
  .kd-sub:first-child{margin-top:0}
  .kd-actions{display:flex;justify-content:flex-end;margin-top:1.2rem}

  .kd-btn-ghost{display:inline-flex;align-items:center;gap:.45rem;padding:.6rem .9rem;border-radius:10px;font-size:.78rem;font-weight:700;
    background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.14);color:#fff;cursor:pointer;transition:all .2s var(--ease)}
  .kd-btn-ghost:hover{background:rgba(255,255,255,.14)}

  /* ---------- daftar ---------- */
  .kd-list{display:flex;flex-direction:column;gap:.6rem;margin-bottom:1rem}
  .kd-item{display:flex;align-items:center;gap:.9rem;padding:.8rem 1rem;border-radius:14px;
    border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04)}
  .kd-item.off{opacity:.5}
  .kd-no{font-family:var(--font-display);font-size:1.1rem;font-weight:900;color:var(--gold-light);width:1.9rem;flex-shrink:0}
  .kd-thumb{width:72px;height:52px;border-radius:9px;overflow:hidden;flex-shrink:0;background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.14)}
  .kd-thumb img{width:100%;height:100%;object-fit:cover;display:block}
  .kd-body{flex:1;min-width:0}
  .kd-body strong{display:block;font-size:.85rem;color:#fff;line-height:1.35;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
  .kd-body small{display:block;font-size:.68rem;color:var(--text-muted);margin-top:.25rem;line-height:1.7}
  .kd-badge{display:inline-block;margin-left:.4rem;padding:.1rem .5rem;border-radius:99px;font-size:.62rem;font-weight:800;
    background:rgba(255,179,0,.16);color:var(--gold-light);vertical-align:middle;white-space:nowrap}
  .kd-row-actions{display:flex;gap:.35rem;flex-shrink:0;flex-wrap:wrap;justify-content:flex-end}
  .kd-mini{width:32px;height:32px;border-radius:9px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:#fff;
    display:inline-flex;align-items:center;justify-content:center;cursor:pointer;font-size:.75rem;transition:all .2s var(--ease)}
  .kd-mini:hover{background:rgba(255,255,255,.16)}
  .kd-mini:disabled{opacity:.3;cursor:not-allowed}
  .kd-mini.danger{color:#ff7875;border-color:rgba(226,75,74,.3)}
  .kd-mini.danger:hover{background:rgba(226,75,74,.2)}
  .kd-inline{display:inline}
  .kd-empty{font-size:.82rem;color:var(--text-muted);padding:1rem 0}
  .kd-add{display:flex;align-items:center;justify-content:center;gap:.5rem;padding:.8rem 1rem;border-radius:11px;width:100%;
    background:rgba(255,179,0,.08);color:var(--gold-light);border:1px dashed rgba(255,179,0,.4);
    font-size:.82rem;font-weight:700;cursor:pointer;transition:all .2s var(--ease)}
  .kd-add:hover{background:rgba(255,179,0,.16);border-color:rgba(255,179,0,.6)}
  @media(max-width:680px){.kd-item{flex-wrap:wrap}.kd-row-actions{width:100%;justify-content:flex-start}}

  /* ---------- filter daftar album ---------- */
  .kd-filterbar{display:flex;gap:.6rem;flex-wrap:wrap;margin-bottom:1rem}
  .kd-filterbar .db-form-control{flex:1;min-width:180px}

  /* ---------- modal ---------- */
  .kd-modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:1rem;
    background:rgba(6,18,34,.72);backdrop-filter:blur(4px)}
  .kd-modal.show{display:flex}
  .kd-modal-box{width:min(780px,100%);max-height:92vh;overflow-y:auto;border-radius:18px;padding:1.4rem;
    background:#0d2a48;border:1px solid rgba(255,255,255,.16);box-shadow:0 30px 80px rgba(0,0,0,.5)}
  .kd-modal-box h3{margin:0 0 1rem;font-family:var(--font-display);font-size:1rem;color:#fff}
  .kd-check{display:flex;align-items:center;gap:.55rem;font-size:.8rem;color:rgba(255,255,255,.85);margin-top:.3rem}
  .kd-check input{width:16px;height:16px;accent-color:var(--gold)}
  .kd-photo-edit{display:flex;gap:1rem;align-items:flex-start}
  .kd-photo-preview{width:128px;height:90px;border-radius:12px;overflow:hidden;flex-shrink:0;background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.18)}
  .kd-photo-preview img{width:100%;height:100%;object-fit:cover;display:block}
  .kd-photo-edit .kd-photo-fields{flex:1;min-width:0}

  .kd-gallery{display:grid;grid-template-columns:repeat(auto-fill,minmax(92px,1fr));gap:.6rem;margin-bottom:.7rem}
  .kd-gal-item{position:relative;border-radius:10px;overflow:hidden;border:1px solid rgba(255,255,255,.16);background:rgba(255,255,255,.06);
    aspect-ratio:4/3;cursor:pointer}
  .kd-gal-item img{width:100%;height:100%;object-fit:cover;display:block;transition:opacity .2s}
  .kd-gal-item input{position:absolute;opacity:0;pointer-events:none}
  .kd-gal-item .kd-gal-x{position:absolute;right:5px;top:5px;width:22px;height:22px;border-radius:50%;display:flex;align-items:center;
    justify-content:center;font-size:.62rem;background:rgba(6,18,34,.75);color:#fff;border:1px solid rgba(255,255,255,.3)}
  .kd-gal-item.marked{border-color:#ff7875}
  .kd-gal-item.marked img{opacity:.3}
  .kd-gal-item.marked .kd-gal-x{background:#e24b4a;border-color:#e24b4a}
  .kd-newprev{display:flex;gap:.4rem;flex-wrap:wrap;margin-top:.6rem}
  .kd-newprev img{width:56px;height:42px;object-fit:cover;border-radius:7px;border:1px solid rgba(255,255,255,.2)}

  /* ---------- sorotan ---------- */
  .kd-slot-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:.8rem;gap:1rem;flex-wrap:wrap}
  .kd-slot-head h3{margin:0;font-size:.85rem;color:#fff}
  .kd-slot-head span{font-size:.7rem;color:var(--text-muted)}
  .kd-slot-rows{display:flex;flex-direction:column;gap:.8rem}
  .kd-slot-row{display:flex;align-items:flex-start;gap:.7rem}
  .kd-slot-row .kd-no{width:1.6rem;padding-top:.45rem}
  .kd-slot-fields{flex:1;display:grid;grid-template-columns:1fr 1fr;gap:.6rem}
  @media(max-width:700px){.kd-slot-fields{grid-template-columns:1fr}}

  /* ---------- kategori / kalender (baris edit) ---------- */
  .kd-edit-row{display:flex;align-items:center;gap:.6rem;flex-wrap:wrap}
  .kd-edit-row form.kd-edit{display:flex;align-items:center;gap:.5rem;flex:1;min-width:300px;flex-wrap:wrap}
  .kd-edit-row .db-form-control{flex:1;min-width:120px}
  .kd-key{font-size:.66rem;color:var(--text-muted);white-space:nowrap}
  .kd-key code{background:rgba(255,255,255,.08);padding:.05rem .35rem;border-radius:5px}
</style>
@endpush

@section('content')
<div class="db-panel-head">
  <h2>Kegiatan</h2>
  <span style="font-size:.75rem;color:var(--text-muted)">Kelola album foto, sorotan, kalender tahunan, kategori, dan teks halaman Kegiatan</span>
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

<nav class="kd-tabs">
  @foreach($tabs as $key => [$label, $icon])
    <a href="{{ route('admin.kegiatan.index', ['tab' => $key]) }}" class="kd-tab {{ $tab === $key ? 'active' : '' }}">
      <i class="fas {{ $icon }}"></i> {{ $label }}
    </a>
  @endforeach
  @if(\Illuminate\Support\Facades\Route::has('kegiatan'))
    <a href="{{ route('kegiatan') }}" target="_blank" rel="noopener" class="kd-tab" style="margin-left:auto">
      <i class="fas fa-arrow-up-right-from-square"></i> Lihat Halaman
    </a>
  @endif
</nav>

@if($tab === 'album')
  @include('admin.kegiatan._tab-album')
@elseif($tab === 'sorotan')
  @include('admin.kegiatan._tab-sorotan')
@elseif($tab === 'kalender')
  @include('admin.kegiatan._tab-kalender')
@elseif($tab === 'kategori')
  @include('admin.kegiatan._tab-kategori')
@else
  @include('admin.kegiatan._tab-teks')
@endif
@endsection
