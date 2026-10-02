{{-- Gaya bersama untuk halaman admin bagian Pengaturan Situs & Roadmap.
     Dipakai lewat: @push('styles') @include('admin.partials.form-kit') @endpush --}}
<style>
  .ad-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.1rem}
  .ad-grid-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:1.1rem}
  .ad-grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:1.1rem}
  @media(max-width:900px){.ad-grid-3,.ad-grid-4{grid-template-columns:1fr 1fr}}
  @media(max-width:560px){.ad-grid-2,.ad-grid-3,.ad-grid-4{grid-template-columns:1fr}}

  .ad-hint{display:block;margin-top:.35rem;font-size:.7rem;color:var(--text-muted);line-height:1.5}
  .ad-hint a{color:var(--gold-light);text-decoration:underline}

  .ad-flash{border-radius:14px;padding:1rem 1.3rem;margin-bottom:1.2rem;font-size:.85rem;font-weight:700;display:flex;gap:.6rem;align-items:flex-start}
  .ad-flash.ok{border:1px solid rgba(76,201,141,.4);background:rgba(76,201,141,.08);color:#5ce0a3}
  .ad-flash.err{border:1px solid rgba(226,75,74,.4);background:rgba(226,75,74,.08);color:#ff9d9b;flex-direction:column;font-weight:600}
  .ad-flash.err ul{margin:.35rem 0 0 1.1rem}

  .ad-tabs{display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:1.5rem;border-bottom:1px solid rgba(255,255,255,.09);padding-bottom:1rem}
  .ad-tab-btn{
    display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.05rem;border-radius:10px;
    border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04);color:rgba(255,255,255,.68);
    font-size:.82rem;font-weight:600;cursor:pointer;transition:all .2s var(--ease);
  }
  .ad-tab-btn:hover{background:rgba(255,255,255,.09);color:#fff}
  .ad-tab-btn.active{background:linear-gradient(135deg,var(--gold-light),var(--gold));color:var(--ink);border-color:transparent;box-shadow:0 8px 20px rgba(255,179,0,.22)}
  .ad-tab-panel{display:none}
  .ad-tab-panel.active{display:block}

  .ad-repeater-item{
    background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.09);border-left:3px solid rgba(255,179,0,.35);
    border-radius:14px;padding:1.2rem 1.35rem;margin-bottom:1rem;transition:border-color .2s var(--ease);
  }
  .ad-repeater-item:hover{border-left-color:var(--gold)}
  .ad-repeater-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;gap:.7rem;padding-bottom:.8rem;border-bottom:1px solid rgba(255,255,255,.06)}
  .ad-repeater-head strong{font-family:var(--font-display);font-weight:700;font-size:.82rem;color:#fff}
  .ad-repeater-controls{display:flex;gap:.4rem}
  .ad-icon-mini{
    width:30px;height:30px;border-radius:8px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.05);
    color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:.78rem;transition:all .2s var(--ease);
  }
  .ad-icon-mini:hover{background:rgba(255,255,255,.14);transform:translateY(-1px)}
  .ad-icon-mini.danger{color:#ff7875;border-color:rgba(226,75,74,.3)}
  .ad-icon-mini.danger:hover{background:rgba(226,75,74,.2)}

  .ad-check-row{display:flex;align-items:center;gap:.55rem;font-size:.8rem;color:rgba(255,255,255,.85);margin-top:.4rem}
  .ad-check-row input{width:16px;height:16px;accent-color:var(--gold)}

  .ad-add-btn{
    display:inline-flex;align-items:center;gap:.5rem;padding:.75rem 1.1rem;border-radius:11px;
    background:rgba(255,179,0,.08);color:var(--gold-light);border:1px dashed rgba(255,179,0,.4);
    font-size:.82rem;font-weight:700;cursor:pointer;width:100%;justify-content:center;transition:all .2s var(--ease);
  }
  .ad-add-btn:hover{background:rgba(255,179,0,.16);border-color:rgba(255,179,0,.6)}

  .ad-logo-current{margin-top:.6rem;display:flex;align-items:center;gap:.8rem}
  .ad-logo-current .box{width:110px;height:56px;border-radius:10px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.08);display:flex;align-items:center;justify-content:center;padding:6px}
  .ad-logo-current img{max-width:100%;max-height:100%;object-fit:contain}
  .ad-logo-current span{font-size:.72rem;color:var(--text-muted)}

  .ad-save-bar{
    position:sticky;bottom:0;margin-top:1.8rem;padding:1.05rem 1.4rem;border-radius:14px;
    background:rgba(12,40,70,.94);border:1px solid rgba(255,255,255,.12);
    display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;
    backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);box-shadow:0 -8px 28px rgba(0,0,0,.28);
  }
  .ad-save-bar span{font-size:.78rem;color:var(--text-muted);display:flex;align-items:center;gap:.5rem}
</style>
