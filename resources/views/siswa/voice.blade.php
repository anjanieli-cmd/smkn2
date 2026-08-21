@extends('layouts.app')

@section('title', 'E-Voice — Layanan Aspirasi & Pengaduan | SMK Negeri 2 Mojokerto')
@section('description', 'Sampaikan aspirasi atau laporan secara mudah dan aman. Bisa dikirim anonim, dan setiap laporan mendapat Ticket ID untuk dipantau perkembangannya.')

@push('styles')
<style>
/* =========================================================
   E-VOICE — Layanan Aspirasi & Pengaduan
   Langsung ke inti fungsi (tanpa hero/section pengantar
   panjang): pilih kategori -> tulis laporan -> (opsional
   anonim) -> kirim -> dapat Ticket ID -> bisa dilacak kapan
   saja. Frontend-only, disimpan sementara di localStorage
   agar tetap interaktif sebelum backend disambungkan.
   Warna & tipografi mengikuti identitas situs: navy #0d3a66,
   gold #ffd54a/#ffb300, orange #ff7a00, font-display, --ease.
   ========================================================= */
.ev-page{background:#f4f8fc;color:#0d3a66;min-height:60vh;position:relative;overflow:hidden}
.ev-page *{box-sizing:border-box}
.ev-wrap{width:min(1440px,94%);margin:0 auto;padding:44px 0 100px;position:relative;z-index:2}

/* ---------- decorative background (full-bleed, tetap ringan) ---------- */
.ev-blob{position:absolute;border-radius:50%;filter:blur(60px);z-index:0;pointer-events:none}
.ev-blob-a{width:520px;height:520px;top:-220px;right:-140px;
  background:radial-gradient(circle,rgba(255,213,74,.28),rgba(255,213,74,0) 70%)}
.ev-blob-b{width:460px;height:460px;top:280px;left:-220px;
  background:radial-gradient(circle,rgba(13,58,102,.10),rgba(13,58,102,0) 70%)}
.ev-blob-c{width:380px;height:380px;bottom:-160px;right:12%;
  background:radial-gradient(circle,rgba(255,122,0,.14),rgba(255,122,0,0) 70%)}
.ev-dotfield{position:absolute;inset:0;z-index:1;pointer-events:none;opacity:.5;
  background-image:radial-gradient(rgba(13,58,102,.06) 1.3px,transparent 1.4px);background-size:20px 20px;
  -webkit-mask-image:linear-gradient(180deg,#000 0,#000 340px,transparent 480px);
  mask-image:linear-gradient(180deg,#000 0,#000 340px,transparent 480px)}

/* ---------- top banner (compact, bukan hero besar) ---------- */
.ev-top{position:relative;display:flex;align-items:center;justify-content:space-between;gap:1.5rem;flex-wrap:wrap;
  margin-bottom:2.4rem;padding:1.6rem clamp(1.2rem,3vw,2.2rem);border-radius:24px;overflow:hidden;
  background:linear-gradient(120deg,#0d3a66 0%,#123f6e 55%,#0d3a66 100%);color:#fff;
  box-shadow:0 24px 54px rgba(13,58,102,.22)}
.ev-top::before{content:"";position:absolute;inset:0;
  background-image:radial-gradient(rgba(255,255,255,.09) 1.3px,transparent 1.4px);background-size:18px 18px;opacity:.5}
.ev-top::after{content:"";position:absolute;top:-60px;right:-40px;width:220px;height:220px;border-radius:50%;
  background:radial-gradient(circle,rgba(255,213,74,.35),rgba(255,213,74,0) 70%)}
.ev-top>*{position:relative;z-index:2}
.ev-eyebrow{display:inline-flex;align-items:center;gap:.55rem;font-size:.7rem;font-weight:900;
  letter-spacing:.16em;text-transform:uppercase;color:#ffd54a;margin-bottom:.6rem}
.ev-eyebrow i{font-size:.68rem}
.ev-top h1{font-family:var(--font-display);font-weight:900;font-size:clamp(1.6rem,3.2vw,2.3rem);
  margin:0;color:#fff;letter-spacing:-.01em}
.ev-top p{margin:.5rem 0 0;font-size:.86rem;color:rgba(235,245,253,.8);max-width:520px;line-height:1.7}
.ev-shield{display:inline-flex;align-items:center;gap:.5rem;font-size:.72rem;font-weight:800;color:#0d3a66;
  background:#fff;border-radius:999px;padding:.6rem .95rem;white-space:nowrap;
  box-shadow:0 12px 26px rgba(4,14,28,.25)}
.ev-shield i{color:#ffb300}

/* ---------- layout dua kolom (full width) ---------- */
.ev-layout{display:grid;grid-template-columns:minmax(0,1fr) 360px;gap:1.8rem;align-items:start}
.ev-main{min-width:0}
.ev-side{position:sticky;top:24px;display:flex;flex-direction:column;gap:1.1rem}
.ev-side-card{background:#fff;border:1px solid #eef2f6;border-radius:20px;padding:1.4rem 1.3rem;
  box-shadow:0 14px 34px rgba(13,58,102,.06)}
.ev-side-card h3{display:flex;align-items:center;gap:.55rem;font-family:var(--font-display);font-size:.92rem;
  font-weight:800;color:#0d3a66;margin:0 0 1rem}
.ev-side-card h3 i{width:28px;height:28px;border-radius:9px;display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;font-size:.7rem;flex:0 0 28px}
.ev-steps-list{list-style:none;margin:0;padding:0;display:grid;gap:0}
.ev-steps-list li{position:relative;display:flex;gap:.85rem;padding-bottom:1.1rem;padding-left:2px}
.ev-steps-list li:last-child{padding-bottom:0}
.ev-steps-list li::before{content:"";position:absolute;left:13px;top:28px;bottom:0;width:2px;background:#eef2f6}
.ev-steps-list li:last-child::before{display:none}
.ev-steps-num{flex:0 0 28px;width:28px;height:28px;border-radius:50%;background:#eef3f8;color:#5a7086;
  display:flex;align-items:center;justify-content:center;font-size:.72rem;font-weight:900;position:relative;z-index:2}
.ev-steps-list li:nth-child(1) .ev-steps-num{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66}
.ev-steps-text strong{display:block;font-size:.78rem;font-weight:800;color:#0d3a66;margin-bottom:.15rem}
.ev-steps-text span{display:block;font-size:.72rem;color:#718396;line-height:1.55}

.ev-trust-list{list-style:none;margin:0;padding:0;display:grid;gap:.75rem}
.ev-trust-list li{display:flex;align-items:flex-start;gap:.65rem;font-size:.76rem;color:#33475a;line-height:1.6}
.ev-trust-list li i{color:#ffb300;margin-top:.2rem;flex:0 0 14px;font-size:.78rem}
.ev-side-note{background:linear-gradient(135deg,#0d3a66,#123f6e);color:#fff;border-radius:20px;padding:1.4rem 1.3rem;
  box-shadow:0 18px 40px rgba(13,58,102,.24)}
.ev-side-note h3{color:#fff}
.ev-side-note h3 i{background:rgba(255,255,255,.15);color:#ffd54a}
.ev-side-note p{font-size:.78rem;color:rgba(235,245,253,.82);line-height:1.65;margin:0}

/* ---------- tab switcher ---------- */
.ev-tabs{display:flex;gap:.5rem;background:#eef3f8;border-radius:14px;padding:.35rem;margin-bottom:1.8rem}
.ev-tab{flex:1;border:none;background:transparent;padding:.75rem 1rem;border-radius:10px;font-size:.82rem;
  font-weight:800;color:#5a7086;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;gap:.5rem;
  transition:background .25s var(--ease,ease),color .25s var(--ease,ease),box-shadow .25s var(--ease,ease)}
.ev-tab i{font-size:.82rem}
.ev-tab.active{background:#0d3a66;color:#fff;box-shadow:0 10px 24px rgba(13,58,102,.25)}
.ev-panel{display:none}
.ev-panel.active{display:block;animation:evFadeIn .4s var(--ease,ease) both}
@keyframes evFadeIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}

/* ---------- card shell ---------- */
.ev-card{background:#fff;border:1px solid #eef2f6;border-radius:22px;padding:clamp(1.4rem,3vw,2.2rem);
  box-shadow:0 18px 46px rgba(13,58,102,.07)}
.ev-card + .ev-card{margin-top:1.4rem}
.ev-card-head{margin-bottom:1.4rem}
.ev-card-head h2{font-family:var(--font-display);font-size:1.15rem;font-weight:800;margin:0 0 .3rem;color:#0d3a66}
.ev-card-head p{font-size:.8rem;color:#718396;margin:0;line-height:1.6}

/* ---------- form fields ---------- */
.ev-field{margin-bottom:1.4rem}
.ev-label{display:flex;align-items:center;justify-content:space-between;font-size:.78rem;font-weight:800;
  color:#0d3a66;margin-bottom:.55rem}
.ev-label small{font-weight:700;color:#a7b6c4;font-size:.68rem}
.ev-input,.ev-textarea{width:100%;border:1.5px solid #e3edf0;border-radius:12px;padding:.75rem .9rem;
  font-size:.85rem;font-family:inherit;color:#0d3a66;background:#fbfdff;
  transition:border-color .25s var(--ease,ease),box-shadow .25s var(--ease,ease)}
.ev-input:focus,.ev-textarea:focus{outline:none;border-color:#ffb300;box-shadow:0 0 0 4px rgba(255,179,0,.14)}
.ev-textarea{resize:vertical;min-height:130px;line-height:1.6}
.ev-hint{font-size:.7rem;color:#a7b6c4;margin-top:.4rem}
.ev-counter{font-size:.68rem;color:#a7b6c4}

/* ---------- kategori chips ---------- */
.ev-cat-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:.7rem}
.ev-cat{position:relative;border:1.5px solid #e3edf0;border-radius:14px;padding:1.05rem .7rem;background:#fbfdff;
  cursor:pointer;text-align:center;transition:all .25s var(--ease,ease)}
.ev-cat input{position:absolute;opacity:0;pointer-events:none}
.ev-cat-icon{width:38px;height:38px;margin:0 auto .5rem;border-radius:11px;display:flex;align-items:center;
  justify-content:center;background:#eef3f8;color:#5a7086;font-size:1rem;
  transition:background .25s var(--ease,ease),color .25s var(--ease,ease)}
.ev-cat-label{display:block;font-size:.72rem;font-weight:800;color:#33475a}
.ev-cat:hover{border-color:#ffd98a;transform:translateY(-2px)}
.ev-cat.is-selected{border-color:#ffb300;background:#fffaf0;box-shadow:0 10px 22px rgba(255,179,0,.16)}
.ev-cat.is-selected .ev-cat-icon{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66}
.ev-cat.is-selected .ev-cat-label{color:#0d3a66}
.ev-cat-check{position:absolute;top:.5rem;right:.5rem;width:16px;height:16px;border-radius:50%;
  background:#ffb300;color:#fff;display:flex;align-items:center;justify-content:center;font-size:.55rem;
  opacity:0;transform:scale(.5);transition:all .25s var(--ease,ease)}
.ev-cat.is-selected .ev-cat-check{opacity:1;transform:scale(1)}

/* ---------- toggle anonim ---------- */
.ev-switch-row{display:flex;align-items:center;justify-content:space-between;gap:1rem;
  background:#f3f7fb;border:1px solid #e3edf0;border-radius:14px;padding:.9rem 1rem}
.ev-switch-text strong{display:block;font-size:.82rem;color:#0d3a66;font-weight:800}
.ev-switch-text span{display:block;font-size:.72rem;color:#718396;margin-top:.2rem;line-height:1.5}
.ev-switch{position:relative;width:46px;height:26px;flex:0 0 46px;border-radius:999px;background:#c9d6e0;
  cursor:pointer;transition:background .3s var(--ease,ease)}
.ev-switch input{position:absolute;opacity:0;width:100%;height:100%;margin:0;cursor:pointer}
.ev-switch-knob{position:absolute;top:3px;left:3px;width:20px;height:20px;border-radius:50%;background:#fff;
  box-shadow:0 2px 6px rgba(13,58,102,.25);transition:transform .3s var(--ease,ease)}
.ev-switch.is-on{background:linear-gradient(135deg,#ffd54a,#ffb300)}
.ev-switch.is-on .ev-switch-knob{transform:translateX(20px)}

.ev-identity{max-height:0;overflow:hidden;opacity:0;transition:max-height .4s var(--ease,ease),opacity .3s var(--ease,ease),margin-top .4s var(--ease,ease)}
.ev-identity.is-open{max-height:260px;opacity:1;margin-top:1.1rem}
.ev-identity-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem}

/* ---------- submit ---------- */
.ev-submit-row{display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-top:.4rem}
.ev-privacy-note{display:flex;align-items:flex-start;gap:.5rem;font-size:.72rem;color:#a7b6c4;max-width:340px;line-height:1.6}
.ev-privacy-note i{color:#ffb300;margin-top:.15rem}
.ev-btn{display:inline-flex;align-items:center;gap:.55rem;padding:.85rem 1.7rem;border-radius:999px;border:none;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52;font-weight:800;font-size:.85rem;cursor:pointer;
  box-shadow:0 14px 30px rgba(255,179,0,.3);transition:transform .25s var(--ease,ease),box-shadow .25s var(--ease,ease)}
.ev-btn:hover{transform:translateY(-2px);box-shadow:0 18px 38px rgba(255,179,0,.4)}
.ev-btn:disabled{opacity:.5;cursor:not-allowed;transform:none;box-shadow:none}
.ev-btn.ev-btn-ghost{background:#fff;border:1.5px solid #e3edf0;color:#0d3a66;box-shadow:none}
.ev-btn.ev-btn-ghost:hover{border-color:#ffb300;transform:translateY(-2px)}
.ev-error{font-size:.72rem;color:#e0483b;margin-top:.4rem;display:none;align-items:center;gap:.4rem}
.ev-error.is-shown{display:flex}
.ev-field.has-error .ev-input,.ev-field.has-error .ev-textarea{border-color:#e0483b}

/* ---------- success state ---------- */
.ev-success{display:none;text-align:center}
.ev-success.is-shown{display:block;animation:evFadeIn .5s var(--ease,ease) both}
.ev-success-icon{width:64px;height:64px;margin:0 auto 1.1rem;border-radius:50%;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;display:flex;align-items:center;justify-content:center;
  font-size:1.6rem;box-shadow:0 16px 36px rgba(255,179,0,.3)}
.ev-success h2{font-family:var(--font-display);font-size:1.3rem;font-weight:800;margin:0 0 .5rem;color:#0d3a66}
.ev-success>p{font-size:.85rem;color:#718396;max-width:420px;margin:0 auto 1.4rem;line-height:1.7}
.ev-ticket-box{display:inline-flex;align-items:center;gap:.9rem;background:#0d3a66;color:#fff;border-radius:16px;
  padding:1rem 1.3rem;margin:0 auto}
.ev-ticket-box div{text-align:left}
.ev-ticket-box small{display:block;font-size:.62rem;letter-spacing:.1em;text-transform:uppercase;color:#ffd54a;font-weight:800}
.ev-ticket-box b{font-family:var(--font-display);font-size:1.25rem;letter-spacing:.04em;font-weight:800}
.ev-copy-btn{width:38px;height:38px;border-radius:10px;border:1px solid rgba(255,255,255,.25);background:rgba(255,255,255,.08);
  color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:.85rem;
  transition:background .25s var(--ease,ease)}
.ev-copy-btn:hover{background:rgba(255,255,255,.18)}
.ev-copy-btn.copied{color:#ffd54a}
.ev-success-actions{display:flex;gap:.7rem;justify-content:center;margin-top:1.6rem;flex-wrap:wrap}
.ev-success-tip{display:flex;align-items:flex-start;gap:.55rem;background:#fffaf0;border:1px solid #ffe9b0;
  border-radius:12px;padding:.85rem 1rem;margin-top:1.6rem;text-align:left;font-size:.74rem;color:#8a6a1a;line-height:1.6}
.ev-success-tip i{color:#ffb300;margin-top:.15rem;flex:0 0 14px}

/* ---------- lacak laporan ---------- */
.ev-track-row{display:flex;gap:.7rem}
.ev-track-row .ev-input{flex:1;font-family:var(--font-display);letter-spacing:.03em}
.ev-track-empty{text-align:center;padding:2rem 1rem;color:#a7b6c4}
.ev-track-empty i{font-size:1.8rem;margin-bottom:.8rem;color:#dbe6ee}
.ev-track-empty p{margin:0;font-size:.82rem}
.ev-track-notfound{text-align:center;padding:1.6rem 1rem;color:#e0483b;display:none}
.ev-track-notfound.is-shown{display:block}
.ev-track-notfound i{font-size:1.6rem;margin-bottom:.7rem}
.ev-track-notfound p{margin:0;font-size:.82rem}

.ev-result{display:none}
.ev-result.is-shown{display:block;animation:evFadeIn .4s var(--ease,ease) both}
.ev-result-head{display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;flex-wrap:wrap;
  padding-bottom:1.2rem;margin-bottom:1.4rem;border-bottom:1px solid #eef2f6}
.ev-result-tag{display:inline-flex;align-items:center;gap:.4rem;font-size:.68rem;font-weight:800;color:#0d3a66;
  background:#eef3f8;border-radius:999px;padding:.35rem .7rem;margin-bottom:.5rem}
.ev-result-head h3{font-family:var(--font-display);font-size:1.05rem;font-weight:800;margin:0;color:#0d3a66}
.ev-result-meta{font-size:.72rem;color:#a7b6c4;margin-top:.3rem}
.ev-result-badge{font-size:.7rem;font-weight:800;padding:.4rem .8rem;border-radius:999px;white-space:nowrap}
.ev-result-badge.anon{background:#eef3f8;color:#5a7086}
.ev-result-badge.named{background:#e8f5ee;color:#1f8a4c}
.ev-result-desc{font-size:.82rem;color:#33475a;line-height:1.75;background:#fbfdff;border:1px solid #eef2f6;
  border-radius:12px;padding:.9rem 1rem;margin-bottom:1.6rem}

/* stepper status */
.ev-steps{display:flex;align-items:flex-start}
.ev-step{flex:1;text-align:center;position:relative}
.ev-step-dot{width:34px;height:34px;border-radius:50%;background:#eef3f8;color:#a7b6c4;display:flex;
  align-items:center;justify-content:center;margin:0 auto .6rem;font-size:.85rem;position:relative;z-index:2;
  border:2px solid #eef3f8;transition:all .3s var(--ease,ease)}
.ev-step-line{position:absolute;top:17px;left:-50%;width:100%;height:2px;background:#eef3f8;z-index:1}
.ev-step:first-child .ev-step-line{display:none}
.ev-step-label{font-size:.66rem;font-weight:800;color:#a7b6c4;letter-spacing:.02em}
.ev-step.done .ev-step-dot{background:#0d3a66;border-color:#0d3a66;color:#ffd54a}
.ev-step.done .ev-step-line{background:#0d3a66}
.ev-step.done .ev-step-label{color:#0d3a66}
.ev-step.current .ev-step-dot{background:linear-gradient(135deg,#ffd54a,#ffb300);border-color:#ffb300;color:#0d3a66;
  box-shadow:0 0 0 5px rgba(255,179,0,.16)}
.ev-step.current .ev-step-label{color:#0d3a66}

/* ---------- responsive ---------- */
@media(max-width:1180px){
  .ev-layout{grid-template-columns:minmax(0,1fr) 320px;gap:1.4rem}
  .ev-cat-grid{grid-template-columns:repeat(3,1fr)}
}
@media(max-width:980px){
  .ev-layout{grid-template-columns:1fr}
  .ev-side{position:static;flex-direction:row;flex-wrap:wrap}
  .ev-side-card,.ev-side-note{flex:1 1 260px}
}
@media(max-width:700px){
  .ev-wrap{padding:32px 0 70px}
  .ev-top{padding:1.3rem 1.1rem;border-radius:20px}
  .ev-cat-grid{grid-template-columns:repeat(2,1fr)}
  .ev-identity-grid{grid-template-columns:1fr}
  .ev-track-row{flex-direction:column}
  .ev-step-label{font-size:.6rem}
  .ev-step-dot{width:28px;height:28px;font-size:.7rem}
  .ev-step-line{top:14px}
  .ev-side{flex-direction:column}
}
@media(max-width:480px){
  .ev-cat-grid{grid-template-columns:1fr 1fr}
  .ev-submit-row{flex-direction:column;align-items:stretch}
  .ev-btn{justify-content:center}
}
</style>
@endpush

@section('content')
<div class="ev-page">
  <span class="ev-blob ev-blob-a" aria-hidden="true"></span>
  <span class="ev-blob ev-blob-b" aria-hidden="true"></span>
  <span class="ev-blob ev-blob-c" aria-hidden="true"></span>
  <span class="ev-dotfield" aria-hidden="true"></span>

  <div class="ev-wrap">

    <div class="ev-top">
      <div>
        <span class="ev-eyebrow"><i class="fas fa-comment-dots"></i> E-Voice Skaneda</span>
        <h1>Sampaikan Aspirasi &amp; Laporan</h1>
        <p>Setiap suara didengar. Pilih kategori, ceritakan situasinya, dan lacak tindak lanjutnya kapan saja pakai Ticket ID.</p>
      </div>
      <span class="ev-shield"><i class="fas fa-shield-halved"></i> Identitas Anda aman</span>
    </div>

    <div class="ev-layout">
    <div class="ev-main">

    <div class="ev-tabs" role="tablist">
      <button class="ev-tab active" type="button" data-tab="kirim" role="tab" aria-selected="true">
        <i class="fas fa-paper-plane"></i> Sampaikan Laporan
      </button>
      <button class="ev-tab" type="button" data-tab="lacak" role="tab" aria-selected="false">
        <i class="fas fa-magnifying-glass"></i> Lacak Laporan
      </button>
    </div>

    <!-- ================= PANEL 1: KIRIM LAPORAN ================= -->
    <div class="ev-panel active" data-panel="kirim">

      <form class="ev-card" id="evForm" novalidate>

        <div class="ev-card-head">
          <h2>Detail Laporan</h2>
          <p>Isi sesuai kondisi sebenarnya. Semakin jelas, semakin cepat kami dapat menindaklanjuti.</p>
        </div>

        <div class="ev-field">
          <label class="ev-label">Kategori <small>Wajib dipilih</small></label>
          <div class="ev-cat-grid" id="evCatGrid">
            <label class="ev-cat" data-cat="Akademik">
              <input type="radio" name="kategori" value="Akademik">
              <span class="ev-cat-check"><i class="fas fa-check"></i></span>
              <span class="ev-cat-icon"><i class="fas fa-book"></i></span>
              <span class="ev-cat-label">Akademik</span>
            </label>
            <label class="ev-cat" data-cat="Fasilitas">
              <input type="radio" name="kategori" value="Fasilitas">
              <span class="ev-cat-check"><i class="fas fa-check"></i></span>
              <span class="ev-cat-icon"><i class="fas fa-toolbox"></i></span>
              <span class="ev-cat-label">Fasilitas</span>
            </label>
            <label class="ev-cat" data-cat="Kedisiplinan">
              <input type="radio" name="kategori" value="Kedisiplinan">
              <span class="ev-cat-check"><i class="fas fa-check"></i></span>
              <span class="ev-cat-icon"><i class="fas fa-gavel"></i></span>
              <span class="ev-cat-label">Kedisiplinan</span>
            </label>
            <label class="ev-cat" data-cat="Perundungan">
              <input type="radio" name="kategori" value="Perundungan">
              <span class="ev-cat-check"><i class="fas fa-check"></i></span>
              <span class="ev-cat-icon"><i class="fas fa-hand"></i></span>
              <span class="ev-cat-label">Perundungan</span>
            </label>
            <label class="ev-cat" data-cat="Layanan Sekolah">
              <input type="radio" name="kategori" value="Layanan Sekolah">
              <span class="ev-cat-check"><i class="fas fa-check"></i></span>
              <span class="ev-cat-icon"><i class="fas fa-concierge-bell"></i></span>
              <span class="ev-cat-label">Layanan</span>
            </label>
            <label class="ev-cat" data-cat="Lainnya">
              <input type="radio" name="kategori" value="Lainnya">
              <span class="ev-cat-check"><i class="fas fa-check"></i></span>
              <span class="ev-cat-icon"><i class="fas fa-ellipsis"></i></span>
              <span class="ev-cat-label">Lainnya</span>
            </label>
          </div>
          <div class="ev-error" id="evErrCat"><i class="fas fa-circle-exclamation"></i> Pilih salah satu kategori terlebih dahulu.</div>
        </div>

        <div class="ev-field" id="evFieldJudul">
          <label class="ev-label" for="evJudul">Judul Singkat</label>
          <input type="text" id="evJudul" class="ev-input" placeholder="Contoh: Keran air toilet lantai 2 rusak" maxlength="80">
          <div class="ev-error" id="evErrJudul"><i class="fas fa-circle-exclamation"></i> Judul laporan wajib diisi.</div>
        </div>

        <div class="ev-field" id="evFieldDesk">
          <label class="ev-label" for="evDeskripsi">Ceritakan Kejadiannya <span class="ev-counter"><span id="evCount">0</span>/600</span></label>
          <textarea id="evDeskripsi" class="ev-textarea" maxlength="600" placeholder="Jelaskan kapan, di mana, dan apa yang terjadi sedetail mungkin..."></textarea>
          <div class="ev-error" id="evErrDesk"><i class="fas fa-circle-exclamation"></i> Ceritakan kejadiannya minimal 20 karakter.</div>
        </div>

        <div class="ev-field">
          <div class="ev-switch-row">
            <div class="ev-switch-text">
              <strong>Kirim sebagai Anonim</strong>
              <span>Identitas Anda tidak akan disimpan maupun ditampilkan di mana pun.</span>
            </div>
            <span class="ev-switch is-on" id="evAnonSwitch">
              <input type="checkbox" id="evAnonInput" checked>
              <span class="ev-switch-knob"></span>
            </span>
          </div>

          <div class="ev-identity" id="evIdentity">
            <div class="ev-identity-grid">
              <div>
                <label class="ev-label" for="evNama">Nama</label>
                <input type="text" id="evNama" class="ev-input" placeholder="Nama lengkap">
              </div>
              <div>
                <label class="ev-label" for="evKontak">Kontak</label>
                <input type="text" id="evKontak" class="ev-input" placeholder="No. HP / email">
              </div>
            </div>
            <p class="ev-hint">Diisi hanya jika Anda ingin dihubungi langsung terkait laporan ini.</p>
          </div>
        </div>

        <div class="ev-submit-row">
          <p class="ev-privacy-note"><i class="fas fa-lock"></i> Laporan diproses secara rahasia dan hanya dapat dilihat oleh pihak sekolah yang berwenang.</p>
          <button type="submit" class="ev-btn" id="evSubmitBtn"><i class="fas fa-paper-plane"></i> Kirim Laporan</button>
        </div>
      </form>

      <div class="ev-card ev-success" id="evSuccess">
        <div class="ev-success-icon"><i class="fas fa-circle-check"></i></div>
        <h2>Laporan Berhasil Dikirim</h2>
        <p>Terima kasih sudah bersuara. Simpan Ticket ID di bawah ini untuk memantau perkembangan laporanmu kapan saja di halaman Lacak Laporan.</p>

        <div class="ev-ticket-box">
          <div>
            <small>Ticket ID</small>
            <b id="evTicketNumber">EVC-00000000</b>
          </div>
          <button class="ev-copy-btn" type="button" id="evCopyBtn" aria-label="Salin Ticket ID"><i class="fas fa-copy"></i></button>
        </div>

        <div class="ev-success-tip"><i class="fas fa-lightbulb"></i> Tips: catat atau screenshot Ticket ID ini. Tanpa Ticket ID, laporan tidak dapat dilacak kembali — terutama untuk laporan anonim.</div>

        <div class="ev-success-actions">
          <button type="button" class="ev-btn ev-btn-ghost" id="evNewReportBtn"><i class="fas fa-plus"></i> Kirim Laporan Lain</button>
          <button type="button" class="ev-btn" id="evGoTrackBtn"><i class="fas fa-magnifying-glass"></i> Lacak Laporan Ini</button>
        </div>
      </div>

    </div>

    <!-- ================= PANEL 2: LACAK LAPORAN ================= -->
    <div class="ev-panel" data-panel="lacak">
      <div class="ev-card">
        <div class="ev-card-head">
          <h2>Lacak Laporan</h2>
          <p>Masukkan Ticket ID yang kamu terima saat pertama kali mengirim laporan.</p>
        </div>

        <div class="ev-track-row">
          <input type="text" class="ev-input" id="evTrackInput" placeholder="Contoh: EVC-20260820-4821">
          <button type="button" class="ev-btn" id="evTrackBtn"><i class="fas fa-magnifying-glass"></i> Cari</button>
        </div>

        <div class="ev-track-empty" id="evTrackEmpty">
          <i class="fas fa-ticket"></i>
          <p>Belum ada laporan dicari. Masukkan Ticket ID di atas untuk melihat status terbaru.</p>
        </div>

        <div class="ev-track-notfound" id="evTrackNotfound">
          <i class="fas fa-circle-exclamation"></i>
          <p>Ticket ID tidak ditemukan. Periksa kembali penulisannya, ya.</p>
        </div>

        <div class="ev-result" id="evResult">
          <div class="ev-result-head">
            <div>
              <span class="ev-result-tag" id="evResultCat"><i class="fas fa-tag"></i> Kategori</span>
              <h3 id="evResultTitle">Judul laporan</h3>
              <div class="ev-result-meta" id="evResultMeta">Dikirim pada —</div>
            </div>
            <span class="ev-result-badge" id="evResultAnon">Anonim</span>
          </div>

          <p class="ev-result-desc" id="evResultDesc"></p>

          <div class="ev-steps" id="evSteps">
            <div class="ev-step" data-step="Diterima">
              <div class="ev-step-line"></div>
              <div class="ev-step-dot"><i class="fas fa-inbox"></i></div>
              <div class="ev-step-label">Diterima</div>
            </div>
            <div class="ev-step" data-step="Diproses">
              <div class="ev-step-line"></div>
              <div class="ev-step-dot"><i class="fas fa-gear"></i></div>
              <div class="ev-step-label">Diproses</div>
            </div>
            <div class="ev-step" data-step="Ditindaklanjuti">
              <div class="ev-step-line"></div>
              <div class="ev-step-dot"><i class="fas fa-clipboard-check"></i></div>
              <div class="ev-step-label">Ditindaklanjuti</div>
            </div>
            <div class="ev-step" data-step="Selesai">
              <div class="ev-step-line"></div>
              <div class="ev-step-dot"><i class="fas fa-flag-checkered"></i></div>
              <div class="ev-step-label">Selesai</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    </div>
    <!-- /.ev-main -->

    <aside class="ev-side">
      <div class="ev-side-card">
        <h3><i class="fas fa-route"></i> Alur Layanan</h3>
        <ul class="ev-steps-list">
          <li>
            <span class="ev-steps-num">1</span>
            <span class="ev-steps-text"><strong>Pilih Kategori</strong><span>Sesuaikan dengan jenis aspirasi atau kejadian.</span></span>
          </li>
          <li>
            <span class="ev-steps-num">2</span>
            <span class="ev-steps-text"><strong>Ceritakan Kejadian</strong><span>Tulis detail waktu, tempat, dan situasinya.</span></span>
          </li>
          <li>
            <span class="ev-steps-num">3</span>
            <span class="ev-steps-text"><strong>Kirim &amp; Dapatkan Ticket ID</strong><span>Bisa dikirim dengan identitas atau anonim.</span></span>
          </li>
          <li>
            <span class="ev-steps-num">4</span>
            <span class="ev-steps-text"><strong>Pantau Perkembangannya</strong><span>Cek status kapan saja lewat tab Lacak Laporan.</span></span>
          </li>
        </ul>
      </div>

      <div class="ev-side-card">
        <h3><i class="fas fa-lock"></i> Kerahasiaan Terjamin</h3>
        <ul class="ev-trust-list">
          <li><i class="fas fa-circle-check"></i> Laporan anonim tidak menyimpan nama maupun kontak.</li>
          <li><i class="fas fa-circle-check"></i> Hanya diakses pihak sekolah yang berwenang menangani.</li>
          <li><i class="fas fa-circle-check"></i> Tidak perlu login — cukup simpan Ticket ID.</li>
        </ul>
      </div>

      <div class="ev-side-note">
        <h3><i class="fas fa-circle-info"></i> Perlu Bantuan Segera?</h3>
        <p>Untuk situasi darurat atau butuh respons cepat, sampaikan langsung ke Guru BK / Tim Kesiswaan di sekolah selain melalui E-Voice.</p>
      </div>
    </aside>
    </div>
    <!-- /.ev-layout -->

  </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
  var STORAGE_KEY = 'evoice_reports_v1';

  /* ---------------- utils ---------------- */
  function loadReports() {
    try { return JSON.parse(localStorage.getItem(STORAGE_KEY)) || {}; }
    catch (e) { return {}; }
  }
  function saveReports(data) {
    try { localStorage.setItem(STORAGE_KEY, JSON.stringify(data)); } catch (e) {}
  }
  function generateTicketId() {
    var d = new Date();
    var y = d.getFullYear();
    var m = String(d.getMonth() + 1).padStart(2, '0');
    var day = String(d.getDate()).padStart(2, '0');
    var rand = Math.floor(1000 + Math.random() * 9000);
    return 'EVC-' + y + m + day + '-' + rand;
  }
  function formatDate(iso) {
    var d = new Date(iso);
    var opts = { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' };
    return d.toLocaleDateString('id-ID', opts) + ' WIB';
  }

  /* ---------------- tab switching ---------------- */
  var tabs = document.querySelectorAll('.ev-tab');
  var panels = document.querySelectorAll('.ev-panel');
  function activateTab(name) {
    tabs.forEach(function (t) {
      var on = t.getAttribute('data-tab') === name;
      t.classList.toggle('active', on);
      t.setAttribute('aria-selected', on ? 'true' : 'false');
    });
    panels.forEach(function (p) { p.classList.toggle('active', p.getAttribute('data-panel') === name); });
  }
  tabs.forEach(function (t) {
    t.addEventListener('click', function () { activateTab(t.getAttribute('data-tab')); });
  });

  /* ---------------- kategori chip select ---------------- */
  var catLabels = document.querySelectorAll('.ev-cat');
  catLabels.forEach(function (label) {
    var input = label.querySelector('input');
    input.addEventListener('change', function () {
      catLabels.forEach(function (l) { l.classList.remove('is-selected'); });
      label.classList.add('is-selected');
      document.getElementById('evErrCat').classList.remove('is-shown');
    });
  });

  /* ---------------- anonim switch ---------------- */
  var anonSwitch = document.getElementById('evAnonSwitch');
  var anonInput = document.getElementById('evAnonInput');
  var identityBox = document.getElementById('evIdentity');
  function syncAnon() {
    var isAnon = anonInput.checked;
    anonSwitch.classList.toggle('is-on', isAnon);
    identityBox.classList.toggle('is-open', !isAnon);
  }
  anonSwitch.addEventListener('click', function (e) {
    if (e.target === anonInput) return;
    anonInput.checked = !anonInput.checked;
    syncAnon();
  });
  anonInput.addEventListener('change', syncAnon);

  /* ---------------- textarea counter ---------------- */
  var deskripsi = document.getElementById('evDeskripsi');
  var countEl = document.getElementById('evCount');
  deskripsi.addEventListener('input', function () {
    countEl.textContent = deskripsi.value.length;
    if (deskripsi.value.trim().length >= 20) {
      document.getElementById('evFieldDesk').classList.remove('has-error');
      document.getElementById('evErrDesk').classList.remove('is-shown');
    }
  });

  var judul = document.getElementById('evJudul');
  judul.addEventListener('input', function () {
    if (judul.value.trim().length > 0) {
      document.getElementById('evFieldJudul').classList.remove('has-error');
      document.getElementById('evErrJudul').classList.remove('is-shown');
    }
  });

  /* ---------------- submit form ---------------- */
  var form = document.getElementById('evForm');
  var successCard = document.getElementById('evSuccess');
  var lastTicketId = null;

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var valid = true;

    var selectedCat = form.querySelector('input[name="kategori"]:checked');
    if (!selectedCat) {
      document.getElementById('evErrCat').classList.add('is-shown');
      valid = false;
    }

    if (judul.value.trim().length === 0) {
      document.getElementById('evFieldJudul').classList.add('has-error');
      document.getElementById('evErrJudul').classList.add('is-shown');
      valid = false;
    }

    if (deskripsi.value.trim().length < 20) {
      document.getElementById('evFieldDesk').classList.add('has-error');
      document.getElementById('evErrDesk').classList.add('is-shown');
      valid = false;
    }

    if (!valid) {
      var firstError = form.querySelector('.has-error, .ev-error.is-shown');
      if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
      return;
    }

    var ticketId = generateTicketId();
    var isAnon = anonInput.checked;
    var reports = loadReports();
    reports[ticketId] = {
      ticketId: ticketId,
      kategori: selectedCat.value,
      judul: judul.value.trim(),
      deskripsi: deskripsi.value.trim(),
      anonim: isAnon,
      nama: isAnon ? '' : (document.getElementById('evNama').value.trim()),
      kontak: isAnon ? '' : (document.getElementById('evKontak').value.trim()),
      status: 'Diterima',
      createdAt: new Date().toISOString()
    };
    saveReports(reports);
    lastTicketId = ticketId;

    document.getElementById('evTicketNumber').textContent = ticketId;
    form.style.display = 'none';
    successCard.classList.add('is-shown');
    successCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
  });

  document.getElementById('evNewReportBtn').addEventListener('click', function () {
    form.reset();
    catLabels.forEach(function (l) { l.classList.remove('is-selected'); });
    countEl.textContent = '0';
    anonInput.checked = true;
    syncAnon();
    form.style.display = '';
    successCard.classList.remove('is-shown');
    form.scrollIntoView({ behavior: 'smooth', block: 'start' });
  });

  document.getElementById('evGoTrackBtn').addEventListener('click', function () {
    activateTab('lacak');
    if (lastTicketId) {
      document.getElementById('evTrackInput').value = lastTicketId;
      runTrackSearch(lastTicketId);
    }
  });

  document.getElementById('evCopyBtn').addEventListener('click', function () {
    var btn = this;
    var text = document.getElementById('evTicketNumber').textContent;
    var done = function () {
      btn.classList.add('copied');
      btn.innerHTML = '<i class="fas fa-check"></i>';
      setTimeout(function () {
        btn.classList.remove('copied');
        btn.innerHTML = '<i class="fas fa-copy"></i>';
      }, 1600);
    };
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(text).then(done).catch(done);
    } else {
      done();
    }
  });

  /* ---------------- lacak laporan ---------------- */
  var trackInput = document.getElementById('evTrackInput');
  var trackBtn = document.getElementById('evTrackBtn');
  var trackEmpty = document.getElementById('evTrackEmpty');
  var trackNotfound = document.getElementById('evTrackNotfound');
  var resultBox = document.getElementById('evResult');

  var STEP_ORDER = ['Diterima', 'Diproses', 'Ditindaklanjuti', 'Selesai'];

  function renderResult(report) {
    document.getElementById('evResultCat').innerHTML = '<i class="fas fa-tag"></i> ' + report.kategori;
    document.getElementById('evResultTitle').textContent = report.judul;
    document.getElementById('evResultMeta').textContent = 'Dikirim pada ' + formatDate(report.createdAt) + ' \u00b7 Ticket ' + report.ticketId;
    document.getElementById('evResultDesc').textContent = report.deskripsi;

    var badge = document.getElementById('evResultAnon');
    if (report.anonim) {
      badge.textContent = 'Anonim';
      badge.className = 'ev-result-badge anon';
    } else {
      badge.textContent = 'Atas Nama ' + (report.nama || 'Pelapor');
      badge.className = 'ev-result-badge named';
    }

    var currentIndex = STEP_ORDER.indexOf(report.status);
    document.querySelectorAll('#evSteps .ev-step').forEach(function (stepEl, idx) {
      stepEl.classList.remove('done', 'current');
      if (idx < currentIndex) stepEl.classList.add('done');
      else if (idx === currentIndex) stepEl.classList.add('current');
    });

    trackEmpty.style.display = 'none';
    trackNotfound.classList.remove('is-shown');
    resultBox.classList.add('is-shown');
  }

  function runTrackSearch(rawValue) {
    var value = (rawValue || '').trim().toUpperCase();
    if (!value) return;
    var reports = loadReports();
    var report = reports[value];
    if (report) {
      renderResult(report);
    } else {
      trackEmpty.style.display = 'none';
      resultBox.classList.remove('is-shown');
      trackNotfound.classList.add('is-shown');
    }
  }

  trackBtn.addEventListener('click', function () { runTrackSearch(trackInput.value); });
  trackInput.addEventListener('keydown', function (e) {
    if (e.key === 'Enter') { e.preventDefault(); runTrackSearch(trackInput.value); }
  });
  trackInput.addEventListener('input', function () {
    if (trackInput.value.trim() === '') {
      trackNotfound.classList.remove('is-shown');
      resultBox.classList.remove('is-shown');
      trackEmpty.style.display = '';
    }
  });
})();
</script>
@endpush