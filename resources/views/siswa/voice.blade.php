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

/* ---------- hero (senada dengan School FactCheck) ---------- */
.ev-hero{position:relative;margin-bottom:2.2rem;padding:clamp(1.9rem,4vw,2.7rem) clamp(1.5rem,3.4vw,2.7rem);
  border-radius:28px;overflow:hidden;z-index:3;
  background:linear-gradient(120deg,#082846 0%,#0d3a66 48%,#0a3155 100%);color:#fff;
  box-shadow:0 30px 64px rgba(8,40,70,.36)}
.ev-hero::before{content:"";position:absolute;inset:0;pointer-events:none;z-index:0;
  background-image:radial-gradient(rgba(255,255,255,.08) 1.3px,transparent 1.4px);background-size:20px 20px;opacity:.6}
.ev-hero-glow-a{position:absolute;top:-90px;right:-50px;width:280px;height:280px;border-radius:50%;z-index:0;pointer-events:none;
  background:radial-gradient(circle,rgba(255,122,0,.30),rgba(255,122,0,0) 70%)}
.ev-hero-glow-b{position:absolute;bottom:-100px;left:-70px;width:240px;height:240px;border-radius:50%;z-index:0;pointer-events:none;
  background:radial-gradient(circle,rgba(255,213,74,.22),rgba(255,213,74,0) 70%)}
.ev-hero canvas.ev-hero-net{display:block;position:absolute;inset:0;width:100%;height:100%;z-index:0;pointer-events:none;opacity:.5}
.ev-hero-main{position:relative;z-index:2;max-width:820px;text-align:left}
.ev-badge-ai{display:inline-flex;align-items:center;gap:.55rem;font-size:.68rem;font-weight:900;letter-spacing:.16em;
  text-transform:uppercase;color:#ffd08a;margin-bottom:1.1rem;padding:.55rem .95rem;border-radius:999px;
  border:1px solid rgba(255,208,138,.35);background:rgba(255,208,138,.1)}
.ev-badge-ai i{font-size:.75rem;animation:evPulseIcon 2.4s ease-in-out infinite}
@keyframes evPulseIcon{0%,100%{opacity:1}50%{opacity:.4}}
.ev-hero h1{font-family:var(--font-display);font-weight:900;font-size:clamp(2.1rem,4.6vw,3.6rem);line-height:1.08;
  margin:0;color:#fff;letter-spacing:-.015em;text-align:left}
.ev-hero h1 .ev-title-line{display:block}
.ev-hero h1 .ev-title-gold{color:#ffd54a}
.ev-hero p{margin:1.3rem 0 0;font-size:.87rem;color:rgba(230,242,253,.82);line-height:1.85;max-width:520px;text-align:left}
.ev-hero-cta{display:inline-flex;align-items:center;gap:.8rem;margin-top:1.7rem;padding:.8rem 1rem;border-radius:16px;
  text-decoration:none;color:#fff;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.16);cursor:pointer;
  box-shadow:0 12px 30px rgba(4,14,28,.22);transition:transform .3s ease,background .3s ease,border-color .3s ease,box-shadow .3s ease}
.ev-hero-cta:hover{transform:translateY(-4px);background:rgba(255,255,255,.1);
  border-color:rgba(255,213,74,.4);box-shadow:0 18px 38px rgba(4,14,28,.3)}
.ev-hero-cta-icon{width:46px;height:46px;border-radius:14px;display:grid;place-items:center;flex:0 0 46px;
  background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:.9rem}
.ev-hero-cta strong{display:block;font-size:.92rem;line-height:1.15;font-weight:900;letter-spacing:.01em}
.ev-hero-cta small{display:block;margin-top:.25rem;color:rgba(230,242,253,.65);font-size:.72rem;font-weight:600}
.ev-hero-cta-arrow{margin-left:.3rem;color:#ffd54a;font-size:1rem;transition:transform .3s ease}
.ev-hero-cta:hover .ev-hero-cta-arrow{transform:translateX(4px)}
.ev-hero-live{position:absolute;top:clamp(1.5rem,3vw,2.1rem);right:clamp(1.5rem,3vw,2.1rem);z-index:3;
  display:inline-flex;align-items:center;gap:.65rem;font-size:.74rem;font-weight:800;color:#0d3a66;
  background:#fff;border-radius:999px;padding:.55rem .95rem;white-space:nowrap;box-shadow:0 16px 34px rgba(4,14,28,.32)}
.ev-hero-live i{color:#ffb300}
@media(max-width:640px){
  .ev-hero-live{position:static;display:inline-flex;margin-top:1.2rem}
  .ev-hero h1{font-size:clamp(1.8rem,8vw,2.5rem)}
  .ev-hero-cta{width:100%}
}

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

/* ---------- typography import (heading khusus E-Voice) ---------- */
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800;900&display=swap');

/* ---------- card shell ---------- */
.ev-card{background:#fff;border:1px solid #eef2f6;border-radius:22px;padding:clamp(1.4rem,3vw,2.2rem);
  box-shadow:0 18px 46px rgba(13,58,102,.07)}
.ev-card + .ev-card{margin-top:1.4rem}
.ev-card-head{margin-bottom:1.6rem}
.ev-card-head h2{font-family:'Plus Jakarta Sans',var(--font-display),sans-serif;font-size:clamp(1.5rem,2.6vw,1.9rem);
  font-weight:900;margin:0 0 .5rem;color:#0d3a66;letter-spacing:-.01em;line-height:1.2}
.ev-card-head p{font-size:.86rem;color:#718396;margin:0;line-height:1.65}

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
.ev-warn{font-size:.72rem;color:#b3760a;background:#fff6e0;border:1px solid #ffe2a8;border-radius:10px;
  padding:.5rem .7rem;margin-top:.4rem;display:none;align-items:flex-start;gap:.45rem;line-height:1.5}
.ev-warn.is-shown{display:flex}
.ev-warn i{margin-top:.15rem;flex:0 0 auto}

/* ---------- success state ---------- */
.ev-success{display:none;text-align:center}
.ev-success.is-shown{display:block;animation:evFadeIn .5s var(--ease,ease) both}
.ev-success-icon{width:64px;height:64px;margin:0 auto 1.1rem;border-radius:50%;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;display:flex;align-items:center;justify-content:center;
  font-size:1.6rem;box-shadow:0 16px 36px rgba(255,179,0,.3)}
.ev-success h2{font-family:'Plus Jakarta Sans',var(--font-display),sans-serif;font-size:clamp(1.6rem,2.8vw,2rem);
  font-weight:900;margin:0 0 .6rem;color:#0d3a66;letter-spacing:-.01em;line-height:1.2}
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
.ev-track-row{display:flex;gap:.8rem;margin-bottom:1.8rem}
.ev-track-row .ev-input{flex:1;font-family:var(--font-display);letter-spacing:.03em;padding:.9rem 1.1rem;font-size:.92rem}
.ev-track-row .ev-btn{padding:.9rem 1.6rem;font-size:.88rem}
.ev-track-empty{text-align:center;padding:2.8rem 1.2rem;color:#a7b6c4;background:#fbfdff;border:1px dashed #dbe6ee;border-radius:16px}
.ev-track-empty i{font-size:2rem;margin-bottom:1rem;color:#dbe6ee}
.ev-track-empty p{margin:0;font-size:.85rem}
.ev-track-notfound{text-align:center;padding:1.8rem 1.2rem;color:#e0483b;display:none;background:#fdeceb;border-radius:16px;margin-top:.2rem}
.ev-track-notfound.is-shown{display:block}
.ev-track-notfound i{font-size:1.7rem;margin-bottom:.8rem}
.ev-track-notfound p{margin:0;font-size:.85rem}

.ev-result{display:none;margin-top:.2rem}
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

/* ---------- ulasan publik (saran & kritik) ---------- */
.ev-ulasan-list-head{display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;flex-wrap:wrap}
.ev-ulasan-sort{display:flex;gap:.4rem;background:#eef3f8;border-radius:999px;padding:.3rem;flex:0 0 auto}
.ev-ulasan-sort-btn{border:none;background:transparent;color:#5a7086;font-size:.72rem;font-weight:800;
  padding:.45rem .9rem;border-radius:999px;cursor:pointer;transition:all .25s var(--ease,ease)}
.ev-ulasan-sort-btn.active{background:#0d3a66;color:#fff;box-shadow:0 8px 18px rgba(13,58,102,.22)}
.ev-ulasan-list{display:grid;gap:1rem}
.ev-ulasan-item{border:1px solid #eef2f6;border-radius:16px;padding:1.1rem 1.2rem;background:#fbfdff;
  animation:evFadeIn .35s var(--ease,ease) both}
.ev-ulasan-item-head{display:flex;align-items:center;gap:.7rem;margin-bottom:.7rem}
.ev-ulasan-avatar{width:36px;height:36px;border-radius:50%;flex:0 0 36px;display:flex;align-items:center;
  justify-content:center;font-family:var(--font-display);font-weight:900;font-size:.9rem;color:#0d3a66;
  background:linear-gradient(135deg,#ffd54a,#ffb300)}
.ev-ulasan-item-meta{display:flex;flex-direction:column;line-height:1.35;flex:1;min-width:0}
.ev-ulasan-item-meta strong{font-size:.82rem;color:#0d3a66;font-weight:800}
.ev-ulasan-item-meta span{font-size:.68rem;color:#a7b6c4}
.ev-ulasan-delete-btn{flex:0 0 auto;border:1.5px solid #f4d6d2;background:#fff;color:#c94a3d;
  width:32px;height:32px;border-radius:10px;display:flex;align-items:center;justify-content:center;
  font-size:.78rem;cursor:pointer;transition:all .2s var(--ease,ease)}
.ev-ulasan-delete-btn:hover{background:#e0483b;border-color:#e0483b;color:#fff}
.ev-ulasan-mine-badge{display:inline-block;margin-left:.5rem;font-size:.6rem;font-weight:800;
  color:#ffb300;background:rgba(255,179,0,.12);border:1px solid rgba(255,179,0,.3);
  border-radius:999px;padding:.15rem .5rem;vertical-align:middle;text-transform:uppercase;letter-spacing:.03em}
.ev-ulasan-head-actions{display:flex;align-items:center;gap:.6rem;flex-wrap:wrap}
.ev-admin-toggle-btn{display:inline-flex;align-items:center;gap:.4rem;border:1.5px solid #e3edf0;
  background:#fff;color:#5a7086;font-size:.72rem;font-weight:800;padding:.5rem .85rem;
  border-radius:999px;cursor:pointer;transition:all .2s var(--ease,ease)}
.ev-admin-toggle-btn:hover{border-color:#0d3a66;color:#0d3a66}
.ev-admin-toggle-btn.is-active{background:#0d3a66;color:#fff;border-color:#0d3a66}
.ev-admin-banner{display:none;align-items:center;gap:.6rem;font-size:.76rem;font-weight:700;color:#0d3a66;
  background:linear-gradient(135deg,#fff6e0,#ffedc2);border:1px solid #ffe2a8;border-radius:14px;
  padding:.75rem 1rem;margin-bottom:1.1rem}
.ev-admin-banner.is-shown{display:flex}
.ev-admin-banner i{color:#ffb300}
.ev-admin-banner button{margin-left:auto;border:none;background:#0d3a66;color:#fff;font-size:.68rem;
  font-weight:800;padding:.4rem .8rem;border-radius:999px;cursor:pointer}

/* ---------- modal kustom (pengganti confirm()/prompt() bawaan browser) ---------- */
.ev-modal-overlay{position:fixed;inset:0;z-index:9999;display:flex;align-items:center;justify-content:center;
  padding:1.2rem;background:rgba(8,32,58,.55);backdrop-filter:blur(3px);opacity:0;
  transition:opacity .22s var(--ease,ease)}
.ev-modal-overlay.is-open{opacity:1}
.ev-modal{width:100%;max-width:380px;background:#fff;border-radius:22px;padding:1.8rem 1.6rem 1.6rem;
  box-shadow:0 30px 70px rgba(4,14,28,.35);transform:translateY(14px) scale(.96);opacity:0;
  transition:transform .25s var(--ease,ease),opacity .25s var(--ease,ease);text-align:center}
.ev-modal-overlay.is-open .ev-modal{transform:translateY(0) scale(1);opacity:1}
.ev-modal-icon{width:52px;height:52px;margin:0 auto .9rem;border-radius:16px;display:flex;align-items:center;
  justify-content:center;font-size:1.25rem;background:rgba(255,179,0,.12);color:#ffb300}
.ev-modal-icon.is-danger{background:rgba(224,72,59,.1);color:#e0483b}
.ev-modal-icon.is-admin{background:rgba(13,58,102,.1);color:#0d3a66}
.ev-modal-title{font-family:var(--font-display);font-size:1.05rem;font-weight:900;color:#0d3a66;margin:0 0 .5rem}
.ev-modal-message{font-size:.82rem;color:#5a7086;line-height:1.65;margin:0 0 1.3rem}
.ev-modal-input-wrap{margin:0 0 .4rem;text-align:left}
.ev-modal-input{width:100%;border:1.5px solid #e3edf0;border-radius:12px;padding:.75rem .9rem;
  font-size:.95rem;letter-spacing:.15em;text-align:center;color:#0d3a66;background:#fbfdff;
  transition:border-color .2s var(--ease,ease),box-shadow .2s var(--ease,ease)}
.ev-modal-input:focus{outline:none;border-color:#ffb300;box-shadow:0 0 0 4px rgba(255,179,0,.14)}
.ev-modal-error{font-size:.72rem;color:#e0483b;margin-top:.5rem;min-height:1em;font-weight:700}
.ev-modal-actions{display:flex;gap:.7rem;margin-top:1.4rem}
.ev-modal-btn{flex:1;border:none;border-radius:12px;padding:.75rem 1rem;font-size:.82rem;font-weight:800;
  cursor:pointer;transition:transform .2s var(--ease,ease),box-shadow .2s var(--ease,ease)}
.ev-modal-btn-ghost{background:#f2f6f9;color:#5a7086}
.ev-modal-btn-ghost:hover{background:#e7edf2}
.ev-modal-btn-primary{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52;
  box-shadow:0 12px 26px rgba(255,179,0,.32)}
.ev-modal-btn-primary:hover{transform:translateY(-2px)}
.ev-modal-btn-danger{background:linear-gradient(135deg,#f0685a,#e0483b);color:#fff;
  box-shadow:0 12px 26px rgba(224,72,59,.32)}
.ev-modal-btn-danger:hover{transform:translateY(-2px)}
.ev-ulasan-item-text{font-size:.85rem;color:#33475a;line-height:1.7;margin:0 0 .9rem;word-break:break-word}
.ev-ulasan-votes{display:flex;gap:.6rem;flex-wrap:wrap}
.ev-vote-btn{display:inline-flex;align-items:center;gap:.45rem;border:1.5px solid #e3edf0;background:#fff;
  color:#5a7086;font-size:.74rem;font-weight:800;padding:.5rem .9rem;border-radius:999px;cursor:pointer;
  transition:all .2s var(--ease,ease)}
.ev-vote-btn span{font-family:var(--font-display);font-size:.78rem}
.ev-vote-agree:hover{border-color:#3fb87a;color:#1f8a4c;background:#eefaf2}
.ev-vote-disagree:hover{border-color:#e0483b;color:#c0392b;background:#fdeceb}
.ev-vote-btn.is-pulsing{transform:scale(1.08)}
.ev-vote-btn:disabled{cursor:not-allowed}
.ev-vote-btn:disabled:not(.is-selected){opacity:.45}
.ev-vote-agree.is-selected{border-color:#3fb87a;color:#1f8a4c;background:#eefaf2;box-shadow:0 0 0 2px rgba(63,184,122,.18)}
.ev-vote-disagree.is-selected{border-color:#e0483b;color:#c0392b;background:#fdeceb;box-shadow:0 0 0 2px rgba(224,72,59,.18)}
.ev-ulasan-voted-note{display:flex;align-items:center;gap:.4rem;margin-top:.7rem;font-size:.68rem;
  font-weight:800;color:#a7b6c4}
.ev-ulasan-voted-note i{color:#3fb87a;font-size:.7rem}
.ev-ulasan-empty{display:none;text-align:center;padding:2.8rem 1.2rem;color:#a7b6c4;background:#fbfdff;
  border:1px dashed #dbe6ee;border-radius:16px}
.ev-ulasan-empty i{font-size:2rem;margin-bottom:1rem;color:#dbe6ee}
.ev-ulasan-empty p{margin:0;font-size:.85rem}
@media(max-width:480px){
  .ev-ulasan-votes{flex-direction:column;align-items:stretch}
  .ev-vote-btn{justify-content:center}
}

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

    <div class="ev-hero">
      <span class="ev-hero-glow-a" aria-hidden="true"></span>
      <span class="ev-hero-glow-b" aria-hidden="true"></span>
      <canvas class="ev-hero-net" id="evHeroNet" style="position:absolute;inset:0;width:100%;height:100%" aria-hidden="true"></canvas>
      <div class="ev-hero-main">
        <span class="ev-badge-ai"><i class="fas fa-comment-dots"></i> E-Voice Skaneda</span>
        <h1>
          <span class="ev-title-line">SAMPAIKAN ASPIRASI</span>
          <span class="ev-title-line ev-title-gold">&amp; LAPORAN</span>
        </h1>
        <p>Setiap suara didengar. Pilih kategori, ceritakan situasinya secara aman — bisa anonim — lalu lacak tindak lanjutnya kapan saja pakai Ticket ID.</p>
        <a class="ev-hero-cta" id="evHeroCta" href="#evForm">
          <span class="ev-hero-cta-icon"><i class="fas fa-paper-plane"></i></span>
          <span><strong>Sampaikan Laporan Sekarang</strong><small>Pilih kategori dan ceritakan kejadiannya</small></span>
          <i class="fas fa-arrow-right ev-hero-cta-arrow"></i>
        </a>
      </div>
      <span class="ev-hero-live"><i class="fas fa-shield-halved"></i> Identitas Anda Aman</span>
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
      <button class="ev-tab" type="button" data-tab="ulasan" role="tab" aria-selected="false">
        <i class="fas fa-comments"></i> Saran &amp; Kritik
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
          <div class="ev-warn" id="evWarnJudul"><i class="fas fa-triangle-exclamation"></i> Terdeteksi kata kasar/tidak pantas. Ganti dulu sebelum bisa dikirim.</div>
        </div>

        <div class="ev-field" id="evFieldDesk">
          <label class="ev-label" for="evDeskripsi">Ceritakan Kejadiannya <span class="ev-counter"><span id="evCount">0</span>/600</span></label>
          <textarea id="evDeskripsi" class="ev-textarea" maxlength="600" placeholder="Jelaskan kapan, di mana, dan apa yang terjadi sedetail mungkin..."></textarea>
          <div class="ev-error" id="evErrDesk"><i class="fas fa-circle-exclamation"></i> Ceritakan kejadiannya minimal 20 karakter.</div>
          <div class="ev-warn" id="evWarnDesk"><i class="fas fa-triangle-exclamation"></i> Terdeteksi kata kasar/tidak pantas. Ganti dulu sebelum bisa dikirim.</div>
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

    <!-- ================= PANEL 3: SARAN & KRITIK (ULASAN PUBLIK) ================= -->
    <div class="ev-panel" data-panel="ulasan">

      <div class="ev-card">
        <div class="ev-card-head">
          <h2>Saran &amp; Kritik Terbuka</h2>
          <p>Beda dengan laporan di atas yang privat, ulasan di sini bersifat publik — bisa dilihat dan divoting oleh siapa saja yang membuka halaman ini. Tidak ada Ticket ID untuk ulasan.</p>
        </div>

        <form id="evUlasanForm" novalidate>
          <div class="ev-field">
            <label class="ev-label" for="evUlasanTeks">Tulis Saran / Kritik <span class="ev-counter"><span id="evUlasanCount">0</span>/300</span></label>
            <textarea id="evUlasanTeks" class="ev-textarea" maxlength="300" style="min-height:110px" placeholder="Tulis pendapatmu tentang sekolah, fasilitas, kegiatan, dan lainnya..."></textarea>
            <div class="ev-error" id="evErrUlasan"><i class="fas fa-circle-exclamation"></i> Tulis dulu saran/kritikmu, minimal 10 karakter.</div>
            <div class="ev-warn" id="evWarnUlasan"><i class="fas fa-triangle-exclamation"></i> Terdeteksi kata kasar/tidak pantas. Ganti dulu sebelum bisa dikirim.</div>
          </div>

          <div class="ev-field">
            <div class="ev-switch-row">
              <div class="ev-switch-text">
                <strong>Kirim sebagai Anonim</strong>
                <span>Kalau dimatikan, nama kamu akan tampil di ulasan publik ini.</span>
              </div>
              <span class="ev-switch is-on" id="evUlasanAnonSwitch">
                <input type="checkbox" id="evUlasanAnonInput" checked>
                <span class="ev-switch-knob"></span>
              </span>
            </div>

            <div class="ev-identity" id="evUlasanIdentity">
              <label class="ev-label" for="evUlasanNama">Nama</label>
              <input type="text" id="evUlasanNama" class="ev-input" placeholder="Nama yang ditampilkan" maxlength="40">
            </div>
          </div>

          <div class="ev-submit-row">
            <p class="ev-privacy-note"><i class="fas fa-eye"></i> Ulasan ini tampil untuk semua pengunjung website, bukan hanya pihak sekolah.</p>
            <button type="submit" class="ev-btn" id="evUlasanSubmitBtn"><i class="fas fa-paper-plane"></i> Kirim Ulasan</button>
          </div>
        </form>
      </div>

      <div class="ev-card">
        <div class="ev-card-head ev-ulasan-list-head">
          <div>
            <h2>Semua Ulasan</h2>
            <p><span id="evUlasanTotal">0</span> ulasan dari pengunjung.</p>
          </div>
          <div class="ev-ulasan-head-actions">
            <div class="ev-ulasan-sort" role="group" aria-label="Urutkan ulasan">
              <button type="button" class="ev-ulasan-sort-btn active" data-sort="terbaru">Terbaru</button>
              <button type="button" class="ev-ulasan-sort-btn" data-sort="populer">Terpopuler</button>
            </div>
            <button type="button" class="ev-admin-toggle-btn" id="evAdminToggleBtn" title="Mode Admin">
              <i class="fas fa-user-shield"></i> <span id="evAdminToggleLabel">Admin</span>
            </button>
          </div>
        </div>

        <div class="ev-admin-banner" id="evAdminBanner">
          <i class="fas fa-shield-halved"></i> Mode Admin aktif — kamu bisa menghapus semua ulasan.
          <button type="button" id="evAdminExitBtn">Keluar</button>
        </div>

        <div class="ev-ulasan-list" id="evUlasanList"></div>

        <div class="ev-ulasan-empty" id="evUlasanEmpty">
          <i class="fas fa-comments"></i>
          <p>Belum ada ulasan. Jadilah yang pertama menyampaikan saran atau kritik!</p>
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

  /* ---------------- filter kata kasar & SARA ----------------
     Dipakai di semua field teks bebas (judul & deskripsi laporan,
     teks ulasan). Bukan daftar lengkap/final — tambah/kurangi
     sesuai kebutuhan moderasi sekolah. Idealnya validasi yang
     sama juga dijalankan ulang di backend saat data disimpan,
     supaya tidak bisa dilewati lewat DevTools/console. */
  var evForbiddenWords = [
    /* kata kasar / umpatan umum + varian slang/typo yang sering dipakai */
    'anjing','anjir','anjrit','anjay','anjeng','anjg','anjr','njir','njr',
    'asu','asuu','babi','babii','bangsat','bgst','bgsd','bego','bgo',
    'bodoh','goblok','goblog','gblk','tolol','tolool','kontol','kntl',
    'kntol','memek','mmk','ngentot','ngntd','jancok','jancuk','cok',
    'kampret','sialan','brengsek','tai','taik','sinting','idiot','pantek',
    'bacot','kunyuk','monyet','setan','keparat','bajingan','pecun','lonte',
    'fuck','fucking','shit','bitch','asshole','bastard','dick','pussy',
    /* istilah bernuansa SARA (suku/agama/ras/antargolongan) —
       ejekan berbasis etnis, agama, atau ras */
    'cina','cino','pribumi','kafir','kristen anjing','islam teroris',
    'teroris','komunis','pki','pki babi','yahudi babi','arab kampungan',
    'jawa tolol','madura tolol','batak tolol','ambon monyet','papua monyet',
    'negro','nigger','cebong','kampret tolol','antek asing'
  ];
  function containsForbiddenWord(text) {
    var normalized = (' ' + String(text).toLowerCase() + ' ')
      .replace(/[^a-z0-9\s]/g, ' ')
      .replace(/(.)\1+/g, '$1'); // "anjingggg"/"jelekkk" -> "anjing"/"jelek" biar variasi huruf berulang tetap kena
    return evForbiddenWords.some(function (bad) {
      return normalized.indexOf(' ' + bad + ' ') !== -1;
    });
  }
  function toggleWordWarning(inputEl, warnEl) {
    var flagged = containsForbiddenWord(inputEl.value);
    warnEl.classList.toggle('is-shown', flagged);
    return flagged;
  }

  /* ---------------- modal kustom (pengganti confirm()/prompt() bawaan browser) ---------------- */
  function closeEvModal(overlay) {
    overlay.classList.remove('is-open');
    setTimeout(function () { if (overlay.parentNode) overlay.parentNode.removeChild(overlay); }, 200);
    document.removeEventListener('keydown', overlay._escHandler);
  }

  function openEvConfirmModal(opts) {
    // opts: { title, message, confirmLabel, cancelLabel, danger }
    return new Promise(function (resolve) {
      var overlay = document.createElement('div');
      overlay.className = 'ev-modal-overlay';
      overlay.innerHTML =
        '<div class="ev-modal" role="alertdialog" aria-modal="true">' +
          '<div class="ev-modal-icon' + (opts.danger ? ' is-danger' : '') + '">' +
            '<i class="fas ' + (opts.danger ? 'fa-trash' : 'fa-circle-question') + '"></i>' +
          '</div>' +
          '<h3 class="ev-modal-title">' + escapeHtml(opts.title || 'Konfirmasi') + '</h3>' +
          '<p class="ev-modal-message">' + escapeHtml(opts.message || '') + '</p>' +
          '<div class="ev-modal-actions">' +
            '<button type="button" class="ev-modal-btn ev-modal-btn-ghost" data-act="cancel">' + escapeHtml(opts.cancelLabel || 'Batal') + '</button>' +
            '<button type="button" class="ev-modal-btn ' + (opts.danger ? 'ev-modal-btn-danger' : 'ev-modal-btn-primary') + '" data-act="confirm">' + escapeHtml(opts.confirmLabel || 'Ya') + '</button>' +
          '</div>' +
        '</div>';
      document.body.appendChild(overlay);
      document.body.style.overflow = 'hidden';
      requestAnimationFrame(function () { overlay.classList.add('is-open'); });

      function finish(result) {
        document.body.style.overflow = '';
        closeEvModal(overlay);
        resolve(result);
      }
      overlay.addEventListener('click', function (e) {
        if (e.target === overlay) finish(false);
        var act = e.target.closest('[data-act]');
        if (!act) return;
        finish(act.getAttribute('data-act') === 'confirm');
      });
      overlay._escHandler = function (e) { if (e.key === 'Escape') finish(false); };
      document.addEventListener('keydown', overlay._escHandler);
      var confirmBtn = overlay.querySelector('[data-act="confirm"]');
      if (confirmBtn) confirmBtn.focus();
    });
  }

  function openEvPinModal(opts) {
    // opts: { title, message, validate: function(pin) -> boolean }
    return new Promise(function (resolve) {
      var overlay = document.createElement('div');
      overlay.className = 'ev-modal-overlay';
      overlay.innerHTML =
        '<div class="ev-modal" role="alertdialog" aria-modal="true">' +
          '<div class="ev-modal-icon is-admin"><i class="fas fa-user-shield"></i></div>' +
          '<h3 class="ev-modal-title">' + escapeHtml(opts.title || 'Mode Admin') + '</h3>' +
          '<p class="ev-modal-message">' + escapeHtml(opts.message || 'Masukkan PIN admin untuk melanjutkan.') + '</p>' +
          '<div class="ev-modal-input-wrap">' +
            '<input type="password" inputmode="numeric" class="ev-modal-input" id="evModalPinInput" placeholder="••••••" autocomplete="off">' +
            '<div class="ev-modal-error" id="evModalPinError"></div>' +
          '</div>' +
          '<div class="ev-modal-actions">' +
            '<button type="button" class="ev-modal-btn ev-modal-btn-ghost" data-act="cancel">Batal</button>' +
            '<button type="button" class="ev-modal-btn ev-modal-btn-primary" data-act="confirm">Masuk</button>' +
          '</div>' +
        '</div>';
      document.body.appendChild(overlay);
      document.body.style.overflow = 'hidden';
      requestAnimationFrame(function () { overlay.classList.add('is-open'); });

      var input = overlay.querySelector('#evModalPinInput');
      var errEl = overlay.querySelector('#evModalPinError');
      setTimeout(function () { input.focus(); }, 220);

      function finish(result) {
        document.body.style.overflow = '';
        closeEvModal(overlay);
        resolve(result);
      }
      function trySubmit() {
        var val = input.value.trim();
        if (!val) { errEl.textContent = 'PIN tidak boleh kosong.'; input.focus(); return; }
        if (opts.validate(val)) { finish(true); }
        else { errEl.textContent = 'PIN salah, coba lagi.'; input.value = ''; input.focus(); }
      }
      overlay.addEventListener('click', function (e) {
        if (e.target === overlay) { finish(false); return; }
        var act = e.target.closest('[data-act]');
        if (!act) return;
        if (act.getAttribute('data-act') === 'cancel') finish(false);
        else trySubmit();
      });
      input.addEventListener('keydown', function (e) { if (e.key === 'Enter') trySubmit(); });
      overlay._escHandler = function (e) { if (e.key === 'Escape') finish(false); };
      document.addEventListener('keydown', overlay._escHandler);
    });
  }

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
  var deskWarnEl = document.getElementById('evWarnDesk');
  deskripsi.addEventListener('input', function () {
    countEl.textContent = deskripsi.value.length;
    if (deskripsi.value.trim().length >= 20) {
      document.getElementById('evFieldDesk').classList.remove('has-error');
      document.getElementById('evErrDesk').classList.remove('is-shown');
    }
    toggleWordWarning(deskripsi, deskWarnEl);
  });

  var judul = document.getElementById('evJudul');
  var judulWarnEl = document.getElementById('evWarnJudul');
  judul.addEventListener('input', function () {
    if (judul.value.trim().length > 0) {
      document.getElementById('evFieldJudul').classList.remove('has-error');
      document.getElementById('evErrJudul').classList.remove('is-shown');
    }
    toggleWordWarning(judul, judulWarnEl);
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

    if (toggleWordWarning(judul, judulWarnEl)) {
      document.getElementById('evFieldJudul').classList.add('has-error');
      valid = false;
    }

    if (toggleWordWarning(deskripsi, deskWarnEl)) {
      document.getElementById('evFieldDesk').classList.add('has-error');
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

  /* ---------------- ULASAN PUBLIK (saran & kritik) ---------------- */
  var ULASAN_KEY = 'evoice_ulasan_v1';
  var ULASAN_MYVOTES_KEY = 'evoice_ulasan_myvotes_v1'; // simpan pilihan vote milik browser ini per ulasan
  var ULASAN_MINE_KEY = 'evoice_ulasan_mine_v1'; // id ulasan yang dikirim dari browser ini
  var ADMIN_SESSION_KEY = 'evoice_admin_mode_v1'; // aktif hanya untuk tab/sesi ini
  /* PIN admin sementara (prototype, client-side saja).
     GANTI PIN INI dan pindahkan ke backend begitu sistem auth Laravel sudah siap —
     siapapun yang buka DevTools bisa lihat/ubah nilai ini di kode. */
  var ADMIN_PIN = '260826';

  function loadUlasan() {
    try { return JSON.parse(localStorage.getItem(ULASAN_KEY)) || []; }
    catch (e) { return []; }
  }
  function saveUlasan(list) {
    try { localStorage.setItem(ULASAN_KEY, JSON.stringify(list)); } catch (e) {}
  }
  function loadMyVotes() {
    try { return JSON.parse(localStorage.getItem(ULASAN_MYVOTES_KEY)) || {}; }
    catch (e) { return {}; }
  }
  function saveMyVotes(votes) {
    try { localStorage.setItem(ULASAN_MYVOTES_KEY, JSON.stringify(votes)); } catch (e) {}
  }
  function loadMineIds() {
    try { return JSON.parse(localStorage.getItem(ULASAN_MINE_KEY)) || []; }
    catch (e) { return []; }
  }
  function saveMineIds(ids) {
    try { localStorage.setItem(ULASAN_MINE_KEY, JSON.stringify(ids)); } catch (e) {}
  }
  function markAsMine(id) {
    var ids = loadMineIds();
    ids.push(id);
    saveMineIds(ids);
  }
  function isAdminMode() {
    try { return sessionStorage.getItem(ADMIN_SESSION_KEY) === '1'; }
    catch (e) { return false; }
  }
  function setAdminMode(on) {
    try { sessionStorage.setItem(ADMIN_SESSION_KEY, on ? '1' : '0'); } catch (e) {}
  }
  function generateUlasanId() {
    return 'u' + Date.now().toString(36) + Math.random().toString(36).slice(2, 7);
  }
  function formatUlasanDate(iso) {
    var d = new Date(iso);
    var opts = { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' };
    return d.toLocaleDateString('id-ID', opts) + ' WIB';
  }
  function escapeHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;').replace(/</g, '&lt;')
      .replace(/>/g, '&gt;').replace(/"/g, '&quot;');
  }

  var ulasanSortMode = 'terbaru';
  var ulasanListEl = document.getElementById('evUlasanList');
  var ulasanEmptyEl = document.getElementById('evUlasanEmpty');
  var ulasanTotalEl = document.getElementById('evUlasanTotal');

  function renderUlasan() {
    var list = loadUlasan();
    ulasanTotalEl.textContent = list.length;

    if (list.length === 0) {
      ulasanListEl.innerHTML = '';
      ulasanEmptyEl.style.display = '';
      return;
    }
    ulasanEmptyEl.style.display = 'none';

    var sorted = list.slice();
    if (ulasanSortMode === 'populer') {
      sorted.sort(function (a, b) {
        return (b.setuju - b.tidakSetuju) - (a.setuju - a.tidakSetuju);
      });
    } else {
      sorted.sort(function (a, b) { return new Date(b.createdAt) - new Date(a.createdAt); });
    }

    var myVotes = loadMyVotes();
    var mineIds = loadMineIds();
    var adminOn = isAdminMode();

    ulasanListEl.innerHTML = sorted.map(function (item) {
      var displayName = item.anonim ? 'Anonim' : (item.nama || 'Pengunjung');
      var initial = displayName.trim().charAt(0).toUpperCase() || '?';
      var myVote = myVotes[item.id]; // 'setuju' | 'tidak' | undefined
      var locked = !!myVote;
      var agreeCls = 'ev-vote-btn ev-vote-agree' + (myVote === 'setuju' ? ' is-selected' : '');
      var disagreeCls = 'ev-vote-btn ev-vote-disagree' + (myVote === 'tidak' ? ' is-selected' : '');
      var disabledAttr = locked ? ' disabled' : '';
      var isMine = mineIds.indexOf(item.id) !== -1;
      var canDelete = isMine || adminOn;
      var deleteBtnHtml = canDelete
        ? '<button type="button" class="ev-ulasan-delete-btn" data-id="' + item.id + '" title="Hapus ulasan ini" aria-label="Hapus ulasan ini">' +
            '<i class="fas fa-trash"></i>' +
          '</button>'
        : '';
      var mineBadge = isMine ? '<span class="ev-ulasan-mine-badge">Ulasanmu</span>' : '';
      return '' +
        '<div class="ev-ulasan-item" data-item-id="' + item.id + '">' +
          '<div class="ev-ulasan-item-head">' +
            '<div class="ev-ulasan-avatar">' + escapeHtml(initial) + '</div>' +
            '<div class="ev-ulasan-item-meta">' +
              '<strong>' + escapeHtml(displayName) + mineBadge + '</strong>' +
              '<span>' + formatUlasanDate(item.createdAt) + '</span>' +
            '</div>' +
            deleteBtnHtml +
          '</div>' +
          '<p class="ev-ulasan-item-text">' + escapeHtml(item.teks) + '</p>' +
          '<div class="ev-ulasan-votes">' +
            '<button type="button" class="' + agreeCls + '" data-id="' + item.id + '" data-vote="setuju"' + disabledAttr + '>' +
              '<i class="fas fa-thumbs-up"></i> Setuju <span>' + (item.setuju || 0) + '</span>' +
            '</button>' +
            '<button type="button" class="' + disagreeCls + '" data-id="' + item.id + '" data-vote="tidak"' + disabledAttr + '>' +
              '<i class="fas fa-thumbs-down"></i> Tidak Setuju <span>' + (item.tidakSetuju || 0) + '</span>' +
            '</button>' +
          '</div>' +
          (locked ? '<div class="ev-ulasan-voted-note"><i class="fas fa-check"></i> Kamu sudah memilih: ' + (myVote === 'setuju' ? 'Setuju' : 'Tidak Setuju') + '</div>' : '') +
        '</div>';
    }).join('');
  }

  document.querySelectorAll('.ev-ulasan-sort-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.ev-ulasan-sort-btn').forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');
      ulasanSortMode = btn.getAttribute('data-sort');
      renderUlasan();
    });
  });

  /* mode admin: PIN-gate sederhana di sisi client (prototype).
     Sekali aktif, berlaku untuk tab ini saja (sessionStorage) dan
     tombol hapus akan muncul di semua ulasan, bukan cuma milik sendiri. */
  var adminToggleBtn = document.getElementById('evAdminToggleBtn');
  var adminToggleLabel = document.getElementById('evAdminToggleLabel');
  var adminBanner = document.getElementById('evAdminBanner');
  var adminExitBtn = document.getElementById('evAdminExitBtn');

  function syncAdminUI() {
    var on = isAdminMode();
    adminToggleBtn.classList.toggle('is-active', on);
    adminToggleLabel.textContent = on ? 'Admin Aktif' : 'Admin';
    adminBanner.classList.toggle('is-shown', on);
  }

  adminToggleBtn.addEventListener('click', function () {
    if (isAdminMode()) return; // sudah aktif, keluar lewat tombol "Keluar" di banner
    openEvPinModal({
      title: 'Masuk Mode Admin',
      message: 'Masukkan PIN admin untuk mengelola dan menghapus semua ulasan.',
      validate: function (pin) { return pin === ADMIN_PIN; }
    }).then(function (success) {
      if (!success) return;
      setAdminMode(true);
      syncAdminUI();
      renderUlasan();
    });
  });

  adminExitBtn.addEventListener('click', function () {
    setAdminMode(false);
    syncAdminUI();
    renderUlasan();
  });

  syncAdminUI();

  /* hapus ulasan */
  ulasanListEl.addEventListener('click', function (e) {
    var delBtn = e.target.closest('.ev-ulasan-delete-btn');
    if (!delBtn) return;

    var id = delBtn.getAttribute('data-id');
    openEvConfirmModal({
      title: 'Hapus ulasan ini?',
      message: 'Tindakan ini tidak bisa dibatalkan. Ulasan akan hilang secara permanen.',
      confirmLabel: 'Hapus',
      cancelLabel: 'Batal',
      danger: true
    }).then(function (confirmed) {
      if (!confirmed) return;

      var list = loadUlasan().filter(function (it) { return it.id !== id; });
      saveUlasan(list);

      var mineIds = loadMineIds().filter(function (mid) { return mid !== id; });
      saveMineIds(mineIds);

      var myVotes = loadMyVotes();
      if (myVotes[id]) {
        delete myVotes[id];
        saveMyVotes(myVotes);
      }

      renderUlasan();
    });
  });

  /* voting: 1 orang (1 browser) cuma bisa vote 1x per ulasan, dan gak bisa ganti pilihan */
  ulasanListEl.addEventListener('click', function (e) {
    var btn = e.target.closest('.ev-vote-btn');
    if (!btn || btn.disabled) return;

    var id = btn.getAttribute('data-id');
    var voteType = btn.getAttribute('data-vote');

    var myVotes = loadMyVotes();
    if (myVotes[id]) return; // sudah pernah vote di ulasan ini, abaikan

    var list = loadUlasan();
    var item = list.find(function (it) { return it.id === id; });
    if (!item) return;

    if (voteType === 'setuju') item.setuju = (item.setuju || 0) + 1;
    else item.tidakSetuju = (item.tidakSetuju || 0) + 1;
    saveUlasan(list);

    myVotes[id] = voteType;
    saveMyVotes(myVotes);

    renderUlasan();
  });

  /* toggle anonim di form ulasan */
  var ulasanAnonSwitch = document.getElementById('evUlasanAnonSwitch');
  var ulasanAnonInput = document.getElementById('evUlasanAnonInput');
  var ulasanIdentityBox = document.getElementById('evUlasanIdentity');
  function syncUlasanAnon() {
    var isAnon = ulasanAnonInput.checked;
    ulasanAnonSwitch.classList.toggle('is-on', isAnon);
    ulasanIdentityBox.classList.toggle('is-open', !isAnon);
  }
  ulasanAnonSwitch.addEventListener('click', function (e) {
    if (e.target === ulasanAnonInput) return;
    ulasanAnonInput.checked = !ulasanAnonInput.checked;
    syncUlasanAnon();
  });
  ulasanAnonInput.addEventListener('change', syncUlasanAnon);

  /* counter karakter textarea ulasan */
  var ulasanTeks = document.getElementById('evUlasanTeks');
  var ulasanCountEl = document.getElementById('evUlasanCount');
  var ulasanWarnEl = document.getElementById('evWarnUlasan');
  ulasanTeks.addEventListener('input', function () {
    ulasanCountEl.textContent = ulasanTeks.value.length;
    if (ulasanTeks.value.trim().length >= 10) {
      document.getElementById('evErrUlasan').classList.remove('is-shown');
    }
    toggleWordWarning(ulasanTeks, ulasanWarnEl);
  });

  /* submit ulasan baru */
  var ulasanForm = document.getElementById('evUlasanForm');
  ulasanForm.addEventListener('submit', function (e) {
    e.preventDefault();
    var errEl = document.getElementById('evErrUlasan');

    if (ulasanTeks.value.trim().length < 10) {
      errEl.innerHTML = '<i class="fas fa-circle-exclamation"></i> Tulis dulu saran/kritikmu, minimal 10 karakter.';
      errEl.classList.add('is-shown');
      ulasanTeks.focus();
      ulasanTeks.scrollIntoView({ behavior: 'smooth', block: 'center' });
      return;
    }

    if (toggleWordWarning(ulasanTeks, ulasanWarnEl)) {
      errEl.innerHTML = '<i class="fas fa-circle-exclamation"></i> Ulasan mengandung kata kasar/SARA yang tidak pantas. Mohon gunakan bahasa yang sopan.';
      errEl.classList.add('is-shown');
      ulasanTeks.focus();
      ulasanTeks.scrollIntoView({ behavior: 'smooth', block: 'center' });
      return;
    }

    errEl.classList.remove('is-shown');

    var list = loadUlasan();
    var isAnon = ulasanAnonInput.checked;
    var newId = generateUlasanId();
    list.push({
      id: newId,
      nama: isAnon ? '' : document.getElementById('evUlasanNama').value.trim(),
      anonim: isAnon,
      teks: ulasanTeks.value.trim(),
      setuju: 0,
      tidakSetuju: 0,
      createdAt: new Date().toISOString()
    });
    saveUlasan(list);
    markAsMine(newId);

    ulasanForm.reset();
    ulasanCountEl.textContent = '0';
    ulasanAnonInput.checked = true;
    syncUlasanAnon();

    ulasanSortMode = 'terbaru';
    document.querySelectorAll('.ev-ulasan-sort-btn').forEach(function (b) {
      b.classList.toggle('active', b.getAttribute('data-sort') === 'terbaru');
    });

    renderUlasan();
  });

  renderUlasan();

  /* ---------------- hero neural-network background ---------------- */
  function initHeroNet() {
    var canvas = document.getElementById('evHeroNet');
    if (!canvas || !canvas.getContext) return;
    var ctx = canvas.getContext('2d');
    var dpr = Math.min(window.devicePixelRatio || 1, 2);
    var hero = canvas.closest('.ev-hero');
    var nodes = [];
    var raf = null;

    function size() {
      var w = hero.clientWidth, h = hero.clientHeight;
      canvas.width = w * dpr;
      canvas.height = h * dpr;
      canvas.style.width = w + 'px';
      canvas.style.height = h + 'px';
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
      var count = Math.max(14, Math.min(34, Math.floor((w * h) / 16000)));
      nodes = [];
      for (var i = 0; i < count; i++) {
        nodes.push({
          x: Math.random() * w,
          y: Math.random() * h,
          vx: (Math.random() - 0.5) * 0.18,
          vy: (Math.random() - 0.5) * 0.18,
          r: 1.4 + Math.random() * 1.6
        });
      }
    }

    function frame() {
      var w = hero.clientWidth, h = hero.clientHeight;
      ctx.clearRect(0, 0, w, h);
      nodes.forEach(function (n) {
        n.x += n.vx; n.y += n.vy;
        if (n.x < 0 || n.x > w) n.vx *= -1;
        if (n.y < 0 || n.y > h) n.vy *= -1;
      });
      for (var i = 0; i < nodes.length; i++) {
        for (var j = i + 1; j < nodes.length; j++) {
          var dx = nodes[i].x - nodes[j].x, dy = nodes[i].y - nodes[j].y;
          var dist = Math.sqrt(dx * dx + dy * dy);
          if (dist < 130) {
            ctx.strokeStyle = 'rgba(255,255,255,' + (0.14 * (1 - dist / 130)) + ')';
            ctx.lineWidth = 1;
            ctx.beginPath();
            ctx.moveTo(nodes[i].x, nodes[i].y);
            ctx.lineTo(nodes[j].x, nodes[j].y);
            ctx.stroke();
          }
        }
      }
      nodes.forEach(function (n) {
        ctx.beginPath();
        ctx.arc(n.x, n.y, n.r, 0, Math.PI * 2);
        ctx.fillStyle = 'rgba(255,213,74,.55)';
        ctx.fill();
      });
      raf = requestAnimationFrame(frame);
    }

    size();
    if (raf) cancelAnimationFrame(raf);
    raf = requestAnimationFrame(frame);
    window.addEventListener('resize', function () { size(); });
  }

  initHeroNet();
})();
</script>
@endpush