@extends('layouts.admin')

@section('title', 'Berita — Admin')

@push('styles')
<style>
  .bn-tabs{display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1.2rem}
  .bn-tab{display:inline-flex;align-items:center;gap:.5rem;padding:.65rem 1.05rem;border-radius:999px;text-decoration:none;
    font-size:.8rem;font-weight:800;color:rgba(255,255,255,.85);background:rgba(255,255,255,.05);
    border:1px solid rgba(255,255,255,.12);transition:all .2s var(--ease)}
  .bn-tab:hover{background:rgba(255,255,255,.12)}
  .bn-tab.active{background:linear-gradient(135deg,var(--gold-light),var(--gold));color:var(--ink);border-color:transparent}

  .bn-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.1rem}
  @media(max-width:760px){.bn-grid-2{grid-template-columns:1fr}}
  .bn-hint{font-size:.7rem;color:var(--text-muted);margin-top:.35rem;line-height:1.5}
  .bn-hint code{background:rgba(255,255,255,.08);padding:.05rem .35rem;border-radius:5px}
  .bn-sub{font-size:.72rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:var(--gold-light);margin:1.4rem 0 .8rem}
  .bn-sub:first-child{margin-top:0}
  .bn-actions{display:flex;justify-content:flex-end;margin-top:1.2rem}

  .bn-btn-ghost{display:inline-flex;align-items:center;gap:.45rem;padding:.6rem .9rem;border-radius:10px;font-size:.78rem;font-weight:700;
    background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.14);color:#fff;cursor:pointer;transition:all .2s var(--ease)}
  .bn-btn-ghost:hover{background:rgba(255,255,255,.14)}

  /* ---------- daftar ---------- */
  .bn-list{display:flex;flex-direction:column;gap:.6rem;margin-bottom:1rem}
  .bn-item{display:flex;align-items:center;gap:.9rem;padding:.8rem 1rem;border-radius:14px;
    border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04)}
  .bn-item.off{opacity:.5}
  .bn-no{font-family:var(--font-display);font-size:1.1rem;font-weight:900;color:var(--gold-light);width:1.9rem;flex-shrink:0}
  .bn-thumb{width:64px;height:48px;border-radius:9px;overflow:hidden;flex-shrink:0;background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.14)}
  .bn-thumb img{width:100%;height:100%;object-fit:cover;display:block}
  .bn-body{flex:1;min-width:0}
  .bn-body strong{display:block;font-size:.85rem;color:#fff;line-height:1.35;
    overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
  .bn-body small{display:block;font-size:.68rem;color:var(--text-muted);margin-top:.25rem}
  .bn-badge{display:inline-block;margin-left:.4rem;padding:.1rem .5rem;border-radius:99px;font-size:.62rem;font-weight:800;
    background:rgba(255,179,0,.16);color:var(--gold-light);vertical-align:middle;white-space:nowrap}
  .bn-row-actions{display:flex;gap:.35rem;flex-shrink:0;flex-wrap:wrap;justify-content:flex-end}
  .bn-mini{width:32px;height:32px;border-radius:9px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:#fff;
    display:inline-flex;align-items:center;justify-content:center;cursor:pointer;font-size:.75rem;transition:all .2s var(--ease)}
  .bn-mini:hover{background:rgba(255,255,255,.16)}
  .bn-mini:disabled{opacity:.3;cursor:not-allowed}
  .bn-mini.danger{color:#ff7875;border-color:rgba(226,75,74,.3)}
  .bn-mini.danger:hover{background:rgba(226,75,74,.2)}
  .bn-inline{display:inline}
  .bn-empty{font-size:.82rem;color:var(--text-muted);padding:1rem 0}
  .bn-add{display:flex;align-items:center;justify-content:center;gap:.5rem;padding:.8rem 1rem;border-radius:11px;width:100%;
    background:rgba(255,179,0,.08);color:var(--gold-light);border:1px dashed rgba(255,179,0,.4);
    font-size:.82rem;font-weight:700;cursor:pointer;transition:all .2s var(--ease)}
  .bn-add:hover{background:rgba(255,179,0,.16);border-color:rgba(255,179,0,.6)}
  @media(max-width:680px){.bn-item{flex-wrap:wrap}.bn-row-actions{width:100%;justify-content:flex-start}}

  /* ---------- modal ---------- */
  .bn-modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:1rem;
    background:rgba(6,18,34,.72);backdrop-filter:blur(4px)}
  .bn-modal.show{display:flex}
  .bn-modal-box{width:min(760px,100%);max-height:92vh;overflow-y:auto;border-radius:18px;padding:1.4rem;
    background:#0d2a48;border:1px solid rgba(255,255,255,.16);box-shadow:0 30px 80px rgba(0,0,0,.5)}
  .bn-modal-box h3{margin:0 0 1rem;font-family:var(--font-display);font-size:1rem;color:#fff}
  .bn-check{display:flex;align-items:center;gap:.55rem;font-size:.8rem;color:rgba(255,255,255,.85);margin-top:.3rem}
  .bn-check input{width:16px;height:16px;accent-color:var(--gold)}
  .bn-photo-edit{display:flex;gap:1rem;align-items:flex-start}
  .bn-photo-preview{width:118px;height:84px;border-radius:12px;overflow:hidden;flex-shrink:0;background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.18)}
  .bn-photo-preview img{width:100%;height:100%;object-fit:cover;display:block}
  .bn-photo-edit .bn-photo-fields{flex:1;min-width:0}

  /* ---------- penempatan ---------- */
  .bn-slot-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:.8rem}
  .bn-slot-head h3{margin:0;font-size:.85rem;color:#fff}
  .bn-slot-head span{font-size:.7rem;color:var(--text-muted)}
  .bn-slot-rows{display:flex;flex-direction:column;gap:.6rem}
  .bn-slot-row{display:flex;align-items:center;gap:.7rem}
  .bn-slot-row .bn-no{width:1.6rem}
  .bn-slot-row select{flex:1}

  /* ---------- kategori ---------- */
  .bn-cat-row{display:flex;align-items:center;gap:.6rem;flex-wrap:wrap}
  .bn-cat-row form.bn-cat-edit{display:flex;align-items:center;gap:.5rem;flex:1;min-width:300px;flex-wrap:wrap}
  .bn-cat-row .db-form-control{flex:1;min-width:120px}
  .bn-cat-key{font-size:.66rem;color:var(--text-muted);white-space:nowrap}
  .bn-cat-key code{background:rgba(255,255,255,.08);padding:.05rem .35rem;border-radius:5px}
  .bn-swatch{display:inline-block;width:14px;height:14px;border-radius:4px;margin-right:.35rem;vertical-align:-2px}
  .bn-swatch.sekolah{background:#0d3a66}.bn-swatch.siswa{background:#1d7a4f}.bn-swatch.prestasi{background:#b8860b}
  .bn-swatch.kegiatan{background:#5b3db8}.bn-swatch.akademik{background:#0e7c9e}.bn-swatch.ekstrakurikuler{background:#c2491b}
  .bn-swatch.humas{background:#5b6472}
</style>
@endpush

@section('content')
<div class="db-panel-head">
  <h2>Berita</h2>
  <span style="font-size:.75rem;color:var(--text-muted)">Kelola artikel, penempatan, Cerita Skaneda, kategori, dan teks halaman Berita</span>
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

<nav class="bn-tabs">
  @foreach($tabs as $key => [$label, $icon])
    <a href="{{ route('admin.berita.index', ['tab' => $key]) }}" class="bn-tab {{ $tab === $key ? 'active' : '' }}">
      <i class="fas {{ $icon }}"></i> {{ $label }}
    </a>
  @endforeach
</nav>

@if($tab === 'artikel')
  @include('admin.berita._tab-artikel')
@elseif($tab === 'penempatan')
  @include('admin.berita._tab-penempatan')
@elseif($tab === 'cerita')
  @include('admin.berita._tab-cerita')
@elseif($tab === 'kategori')
  @include('admin.berita._tab-kategori')
@else
  @include('admin.berita._tab-teks')
@endif
@endsection
