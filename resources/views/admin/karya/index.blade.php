@extends('layouts.admin')

@section('title', 'Karya Siswa — Admin')

@push('styles')
<style>
  .kr-tabs{display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1.2rem}
  .kr-tab{display:inline-flex;align-items:center;gap:.5rem;padding:.65rem 1.05rem;border-radius:999px;text-decoration:none;
    font-size:.8rem;font-weight:800;color:rgba(255,255,255,.85);background:rgba(255,255,255,.05);
    border:1px solid rgba(255,255,255,.12);transition:all .2s var(--ease)}
  .kr-tab:hover{background:rgba(255,255,255,.12)}
  .kr-tab.active{background:linear-gradient(135deg,var(--gold-light),var(--gold));color:var(--ink);border-color:transparent}

  .kr-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.1rem}
  .kr-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:1.1rem}
  @media(max-width:900px){.kr-grid-3{grid-template-columns:1fr 1fr}}
  @media(max-width:620px){.kr-grid-2,.kr-grid-3{grid-template-columns:1fr}}
  .kr-hint{font-size:.7rem;color:var(--text-muted);margin-top:.35rem;line-height:1.5}
  .kr-hint code{background:rgba(255,255,255,.08);padding:.05rem .35rem;border-radius:5px}
  .kr-sub{font-size:.72rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:var(--gold-light);margin:1.4rem 0 .8rem}
  .kr-sub:first-child{margin-top:0}
  .kr-actions{display:flex;justify-content:flex-end;margin-top:1.2rem}

  .kr-btn-ghost{display:inline-flex;align-items:center;gap:.45rem;padding:.6rem .9rem;border-radius:10px;font-size:.78rem;font-weight:700;
    background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.14);color:#fff;cursor:pointer;transition:all .2s var(--ease)}
  .kr-btn-ghost:hover{background:rgba(255,255,255,.14)}

  /* ---------- daftar ---------- */
  .kr-list{display:flex;flex-direction:column;gap:.6rem;margin-bottom:1rem}
  .kr-item{display:flex;align-items:center;gap:.9rem;padding:.8rem 1rem;border-radius:14px;
    border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04)}
  .kr-item.off{opacity:.5}
  .kr-no{font-family:var(--font-display);font-size:1.1rem;font-weight:900;color:var(--gold-light);width:1.9rem;flex-shrink:0}
  .kr-thumb{width:72px;height:52px;border-radius:9px;overflow:hidden;flex-shrink:0;background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.14)}
  .kr-thumb img{width:100%;height:100%;object-fit:cover;display:block}
  .kr-body{flex:1;min-width:0}
  .kr-body strong{display:block;font-size:.85rem;color:#fff;line-height:1.35;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
  .kr-body small{display:block;font-size:.68rem;color:var(--text-muted);margin-top:.25rem;line-height:1.8}
  .kr-badge{display:inline-block;margin-left:.4rem;padding:.1rem .5rem;border-radius:99px;font-size:.62rem;font-weight:800;
    background:rgba(255,179,0,.16);color:var(--gold-light);vertical-align:middle;white-space:nowrap}
  .kr-badge.blue{background:rgba(96,165,250,.16);color:#9cc9ff}
  .kr-row-actions{display:flex;gap:.35rem;flex-shrink:0;flex-wrap:wrap;justify-content:flex-end}
  .kr-mini{width:32px;height:32px;border-radius:9px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:#fff;
    display:inline-flex;align-items:center;justify-content:center;cursor:pointer;font-size:.75rem;transition:all .2s var(--ease)}
  .kr-mini:hover{background:rgba(255,255,255,.16)}
  .kr-mini:disabled{opacity:.3;cursor:not-allowed}
  .kr-mini.danger{color:#ff7875;border-color:rgba(226,75,74,.3)}
  .kr-mini.danger:hover{background:rgba(226,75,74,.2)}
  .kr-inline{display:inline}
  .kr-empty{font-size:.82rem;color:var(--text-muted);padding:1rem 0}
  .kr-add{display:flex;align-items:center;justify-content:center;gap:.5rem;padding:.8rem 1rem;border-radius:11px;width:100%;
    background:rgba(255,179,0,.08);color:var(--gold-light);border:1px dashed rgba(255,179,0,.4);
    font-size:.82rem;font-weight:700;cursor:pointer;transition:all .2s var(--ease)}
  .kr-add:hover{background:rgba(255,179,0,.16);border-color:rgba(255,179,0,.6)}
  @media(max-width:680px){.kr-item{flex-wrap:wrap}.kr-row-actions{width:100%;justify-content:flex-start}}

  .kr-filterbar{display:flex;gap:.6rem;flex-wrap:wrap;margin-bottom:1rem}
  .kr-filterbar .db-form-control{flex:1;min-width:180px}

  /* ---------- modal ---------- */
  .kr-modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:1rem;
    background:rgba(6,18,34,.72);backdrop-filter:blur(4px)}
  .kr-modal.show{display:flex}
  .kr-modal-box{width:min(780px,100%);max-height:92vh;overflow-y:auto;border-radius:18px;padding:1.4rem;
    background:#0d2a48;border:1px solid rgba(255,255,255,.16);box-shadow:0 30px 80px rgba(0,0,0,.5)}
  .kr-modal-box h3{margin:0 0 1rem;font-family:var(--font-display);font-size:1rem;color:#fff}
  .kr-check{display:flex;align-items:center;gap:.55rem;font-size:.8rem;color:rgba(255,255,255,.85);margin-top:.3rem}
  .kr-check input{width:16px;height:16px;accent-color:var(--gold)}
  .kr-photo-edit{display:flex;gap:1rem;align-items:flex-start}
  .kr-photo-preview{width:128px;height:90px;border-radius:12px;overflow:hidden;flex-shrink:0;background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.18)}
  .kr-photo-preview img{width:100%;height:100%;object-fit:cover;display:block}
  .kr-photo-fields{flex:1;min-width:0}
  .kr-iconprev{display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:9px;flex-shrink:0;
    background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);color:var(--gold-light);font-size:.85rem}
  .kr-iconrow{display:flex;gap:.5rem;align-items:center}
  .kr-iconrow .db-form-control{flex:1;min-width:0}

  /* ---------- baris edit kategori ---------- */
  .kr-edit-row{display:flex;align-items:center;gap:.6rem;flex-wrap:wrap}
  .kr-edit-row form.kr-edit{display:flex;align-items:center;gap:.5rem;flex:1;min-width:300px;flex-wrap:wrap}
  .kr-edit-row .db-form-control{flex:1;min-width:120px}
  .kr-key{font-size:.66rem;color:var(--text-muted);white-space:nowrap}
  .kr-key code{background:rgba(255,255,255,.08);padding:.05rem .35rem;border-radius:5px}
</style>
@endpush

@section('content')
<div class="db-panel-head">
  <h2>Karya Siswa</h2>
  <span style="font-size:.75rem;color:var(--text-muted)">Kelola karya (slider &amp; produk), bidang, dan teks halaman Karya Siswa</span>
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

<nav class="kr-tabs">
  @foreach($tabs as $key => [$label, $icon])
    <a href="{{ route('admin.karya.index', ['tab' => $key]) }}" class="kr-tab {{ $tab === $key ? 'active' : '' }}">
      <i class="fas {{ $icon }}"></i> {{ $label }}
    </a>
  @endforeach
  @php $publicRoute = collect(['karya-siswa', 'karya'])->first(fn ($r) => \Illuminate\Support\Facades\Route::has($r)); @endphp
  @if($publicRoute)
    <a href="{{ route($publicRoute) }}" target="_blank" rel="noopener" class="kr-tab" style="margin-left:auto">
      <i class="fas fa-arrow-up-right-from-square"></i> Lihat Halaman
    </a>
  @endif
</nav>

@if($tab === 'karya')
  @include('admin.karya._tab-karya')
@elseif($tab === 'kategori')
  @include('admin.karya._tab-kategori')
@else
  @include('admin.karya._tab-teks')
@endif
@endsection
