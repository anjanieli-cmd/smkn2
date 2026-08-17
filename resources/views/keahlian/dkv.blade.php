@extends('layouts.app')

@section('title', 'Program Keahlian DKV — SMK Negeri 2 Mojokerto')
@section('description', 'Program Keahlian Desain Komunikasi Visual (DKV) SMK Negeri 2 Mojokerto: profil, kompetensi, karya unggulan, dan fasilitas praktik.')

@push('styles')
<style>
/* =========================================================
   PROGRAM KEAHLIAN DKV — PREMIUM EDITION
   Visual language: konsisten dengan APHP / Sejarah / Visi-Misi
   (navy #0d3a66 + gold), foto studio + overlay, watermark
   typography, ornamen geometris gaya Beranda, glassmorphism,
   scroll-reveal. Palet: navy, blue, light blue, white, gold.
   ========================================================= */
.dkv-page{background:#f7f9fc;color:#0d3a66;overflow:hidden}
.dkv-page *{box-sizing:border-box}
.dkv-shell{width:100%}

/* ---------- HERO: foto + overlay + watermark ---------- */
.dkv-hero{position:relative;min-height:88vh;display:flex;align-items:flex-start;overflow:hidden;
  background-image:url('{{ asset('images/dkv.png') }}');
  background-size:cover;background-position:center;background-repeat:no-repeat;color:#fff}
.dkv-hero::before{content:"";position:absolute;inset:0;z-index:1;
  background:linear-gradient(100deg,rgba(7,22,42,.92) 0%,rgba(9,30,54,.70) 45%,rgba(9,30,54,.34) 78%,rgba(9,30,54,.14) 100%)}
/* Watermark typography besar transparan (elemen grafis background) */
.dkv-hero::after{content:"DKV";position:absolute;z-index:2;right:-2%;top:50%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(6rem,24vw,24rem);font-weight:900;line-height:.82;
  letter-spacing:.02em;color:rgba(255,255,255,.055);-webkit-text-stroke:1px rgba(255,255,255,.07);
  text-shadow:0 0 90px rgba(13,58,102,.16);pointer-events:none;white-space:nowrap;user-select:none}
.dkv-hero-inner{position:relative;z-index:3;width:100%;max-width:none;margin:0 auto;
  padding:clamp(3.5rem,9vh,5.5rem) clamp(1.5rem,5vw,5.5rem);
  display:grid;grid-template-columns:minmax(0,1.05fr) minmax(340px,.95fr);gap:4rem;align-items:center}

.dkv-kicker{display:inline-flex;transform:translateY(0);align-items:center;gap:.65rem;font-size:.74rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#ffd54a;margin-bottom:0.6rem}
.dkv-kicker::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ffb300)}

/* ---------- TITLE: DKV putih, nama lengkap kuning-oranye ---------- */
.dkv-title{font-family:var(--font-display);font-size:clamp(2.9rem,6.6vw,6.2rem);line-height:.98;
  letter-spacing:.01em;margin:0;max-width:820px;text-transform:uppercase;
  text-shadow:0 2px 24px rgba(4,14,28,.35);animation:hdFadeUp .7s .1s var(--ease, ease) both}
.dkv-title .dkv-white{color:#ffffff;display:inline-block}
.dkv-title .dkv-gold{display:inline-block;
  background:linear-gradient(135deg,#ffe66d 0%,#ffc107 45%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ffc107;
  text-shadow:0 4px 24px rgba(255,174,0,.18);letter-spacing:.025em}

.dkv-lead{font-size:1.05rem;line-height:1.9;color:rgba(235,245,253,.88);max-width:600px;
  margin:1.3rem 0 0;animation:hdFadeUp .7s .18s var(--ease, ease) both}
.dkv-lead strong{color:#ffd54a;font-weight:700}

/* ---------- CTA BOX VIRTUAL TOUR (pengganti badge) ---------- */
.vt-hero-box{position:relative;max-width:540px;margin-top:2rem;padding:1.45rem 1.5rem;
  border-radius:22px;overflow:hidden;isolation:isolate;text-align:left;color:#fff;
  background:linear-gradient(135deg,#0a2c50 0%,#0d3a66 55%,#13437a 100%);
  border:1px solid rgba(255,213,74,.38);
  box-shadow:0 26px 60px rgba(3,16,32,.45),inset 0 1px 0 rgba(255,255,255,.08);
  display:flex;align-items:center;gap:1.15rem;animation:hdFadeUp .7s .4s var(--ease, ease) both;
  transition:transform .35s ease,box-shadow .35s ease,border-color .35s ease}
.vt-hero-box:hover{transform:translateY(-6px);border-color:rgba(255,213,74,.8);
  box-shadow:0 34px 74px rgba(3,16,32,.55),0 0 0 1px rgba(255,213,74,.28),inset 0 1px 0 rgba(255,255,255,.1)}
.vt-hero-box .vth-chevron{position:absolute;right:-46px;top:-46px;width:128px;height:128px;
  border-top:2px solid rgba(255,213,74,.22);border-right:2px solid rgba(255,213,74,.22);transform:rotate(45deg)}
.vt-hero-box .vth-chevron::after{content:"";position:absolute;inset:16px;
  border-top:1px solid rgba(255,255,255,.14);border-right:1px solid rgba(255,255,255,.14)}
.vt-hero-box .vth-dots{position:absolute;right:14px;bottom:12px;width:66px;height:66px;opacity:.5;
  background-image:radial-gradient(rgba(255,213,74,.55) 1.5px,transparent 1.5px);background-size:12px 12px}
.vt-hero-box .vth-ring{position:absolute;left:-56px;bottom:-56px;width:124px;height:124px;
  border:1px solid rgba(47,111,168,.5);border-radius:50%}
.vt-hero-box .vth-ring::before{content:"";position:absolute;inset:14px;
  border:1px dashed rgba(255,255,255,.16);border-radius:50%}
.vt-hero-box .vth-gold{position:absolute;left:0;top:0;width:5px;height:100%;
  background:linear-gradient(180deg,#ffe66d,#ffb300 55%,#ff7a00)}
.vt-hero-icon{flex:0 0 76px;width:76px;height:76px;border-radius:20px;position:relative;z-index:1;
  display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,#ffd54a,#ffb300,#ff8a00);color:#0d3a66;font-size:1.75rem;
  box-shadow:0 14px 32px rgba(255,138,0,.42);transition:transform .4s ease}
.vt-hero-box:hover .vt-hero-icon{transform:rotate(-8deg) scale(1.08)}
.vt-hero-body{position:relative;z-index:1;min-width:0}
.vt-hero-title{display:block;font-family:var(--font-display);font-size:1.06rem;font-weight:800;
  letter-spacing:.05em;text-transform:uppercase;color:#fff;margin:0 0 .2rem;line-height:1.25}
.vt-hero-sub{display:block;font-size:.72rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase;
  color:#ffd54a;margin-bottom:.4rem}
.vt-hero-body p{margin:0 0 .8rem;font-size:.8rem;line-height:1.7;color:rgba(235,245,253,.8)}
.vt-hero-btn{display:inline-flex;align-items:center;gap:.5rem;font-size:.83rem;font-weight:800;
  color:#ffd54a;text-decoration:none;letter-spacing:.02em;transition:gap .3s ease,color .3s ease}
.vt-hero-btn:hover{color:#fff;gap:.8rem}
.vt-hero-btn i{font-size:.8rem}
.hero-photo{position:relative;height:430px;border-radius:24px;overflow:hidden;
  border:1px solid rgba(255,255,255,.22);box-shadow:0 35px 90px rgba(0,0,0,.38);
  transform:translateY(-34px) rotate(1.5deg);animation:hdFadeUp .8s .35s var(--ease, ease) both}
.hero-photo::before{content:"";position:absolute;inset:0;z-index:2;
  background:linear-gradient(180deg,transparent 38%,rgba(4,20,38,.86) 100%)}
.hero-photo img{width:100%;height:100%;object-fit:cover;display:block;transform:scale(1.03)}
.hero-photo-caption{position:absolute;z-index:3;left:1.5rem;right:1.5rem;bottom:1.3rem}
.hero-photo-caption strong{display:block;font-family:var(--font-display);font-size:1.3rem;font-weight:600;color:#fff}
.hero-photo-caption span{font-size:.72rem;color:rgba(255,255,255,.74)}
@keyframes hdFadeUp{from{opacity:0;transform:translateY(26px)}to{opacity:1;transform:none}}

/* ---------- SECTION COMMON ---------- */
.dkv-wide{width:min(1380px,92%);margin:auto}
.eyebrow{display:inline-flex;align-items:center;gap:.5rem;font-size:.74rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#0d3a66;margin-bottom:.85rem}
.eyebrow::before{content:"";width:26px;height:3px;border-radius:99px;background:linear-gradient(90deg,#0d3a66,#2f6fa8)}
.big-heading{font-family:var(--font-display);font-size:clamp(2.1rem,4.4vw,4.2rem);line-height:1.02;
  letter-spacing:.01em;margin:0;color:#0d3a66;text-shadow:0 2px 10px rgba(13,58,102,.06)}
.big-heading span{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}

/* ---------- ORNAMEN STYLE BERANDA ---------- */
.home-orn{position:absolute;inset:0;z-index:0;pointer-events:none;overflow:hidden}
.home-orn .ho-chevron{position:absolute;width:360px;height:360px;
  border-top:2px solid rgba(13,58,102,.11);border-right:2px solid rgba(13,58,102,.11);
  transform:rotate(45deg)}
.home-orn .ho-chevron::after{content:"";position:absolute;inset:34px;
  border-top:2px solid rgba(47,111,168,.09);border-right:2px solid rgba(47,111,168,.09)}
.home-orn .ho-line{position:absolute;width:310px;height:2px;
  background:linear-gradient(90deg,transparent,#2f6fa8,transparent);opacity:.25;transform:rotate(-42deg)}
.home-orn .ho-line::after{content:"";position:absolute;left:70px;top:11px;width:190px;height:1px;
  background:linear-gradient(90deg,transparent,#ffd54a,transparent)}
.home-orn .ho-dots{position:absolute;width:125px;height:125px;
  background-image:radial-gradient(circle,#2f6fa8 2px,transparent 2.8px);
  background-size:18px 18px;opacity:.38}
.home-orn .ho-ring{position:absolute;width:170px;height:170px;border:1px solid rgba(13,58,102,.13);
  border-radius:50%;box-shadow:0 0 0 20px rgba(13,58,102,.025),0 0 0 42px rgba(255,213,74,.025)}
.home-orn .ho-ring::before{content:"";position:absolute;inset:22px;border:1px dashed rgba(47,111,168,.18);border-radius:50%}
.home-orn .ho-gold{position:absolute;width:52px;height:8px;border-radius:99px;
  background:linear-gradient(90deg,#ffd54a,#ffb300,#ff7a00);
  box-shadow:0 8px 22px rgba(255,179,0,.18);transform:rotate(-35deg)}
.home-orn .ho-square{position:absolute;width:58px;height:58px;border:2px solid rgba(255,179,0,.32);transform:rotate(45deg)}
.home-orn .ho-square::before{content:"";position:absolute;inset:10px;border:1px solid rgba(13,58,102,.18)}
.home-orn .ho-corner{position:absolute;width:110px;height:110px;
  border-left:3px solid rgba(13,58,102,.12);border-bottom:3px solid rgba(13,58,102,.12)}
.home-orn .ho-corner::after{content:"";position:absolute;left:18px;bottom:18px;width:46px;height:3px;
  background:#ffd54a;border-radius:99px}

/* ---------- PROFIL ---------- */
.profil-section{position:relative;padding:96px 0 110px;background:#fff;isolation:isolate}
.profil-grid{display:grid;grid-template-columns:1.1fr .9fr;gap:5rem;align-items:center}
.profil-copy{font-size:1rem;line-height:1.95;color:#5f7186;margin-top:1.25rem;max-width:720px}
.profil-copy strong{color:#0d3a66}
.stat-strip{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem}
.stat-box{position:relative;padding:1.4rem;border-radius:22px;overflow:hidden;min-height:150px;
  background:rgba(255,255,255,.72);border:1px solid rgba(13,58,102,.16);
  box-shadow:0 18px 44px rgba(13,58,102,.08);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);
  transition:transform .35s ease,box-shadow .35s ease}
.stat-box:hover{transform:translateY(-5px);box-shadow:0 24px 52px rgba(13,58,102,.14)}
.stat-box::after{content:"";position:absolute;right:-25px;bottom:-30px;width:90px;height:90px;
  border:2px solid rgba(13,58,102,.22);transform:rotate(45deg)}
.stat-box::before{content:"";position:absolute;top:0;left:0;width:100%;height:4px;
  background:linear-gradient(90deg,#0d3a66,#2f6fa8)}
.stat-num{font-family:var(--font-display);font-size:2.8rem;line-height:1;color:#0d3a66;font-weight:900}
.stat-num.gold{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.stat-label{font-size:.74rem;font-weight:800;color:#6d7f91;margin-top:.55rem;
  text-transform:uppercase;letter-spacing:.08em}
.profil-section .home-orn .ho-chevron{right:-130px;top:70px}
.profil-section .home-orn .ho-line{left:-55px;bottom:75px}
.profil-section .home-orn .ho-dots{right:18%;bottom:55px}
.profil-section .home-orn .ho-ring{left:-80px;top:35%}
.profil-section .home-orn .ho-gold{right:12%;top:26%}
.profil-section .home-orn .ho-square{left:13%;bottom:18%}

/* ---------- KOMPETENSI ---------- */
.kompetensi-section{position:relative;padding:110px 0 130px;isolation:isolate;overflow:hidden;
  background:linear-gradient(180deg,#f7f9fc 0%,#eef5fa 100%)}
.kompetensi-head{width:min(1380px,92%);margin:0 auto 60px;display:flex;justify-content:space-between;
  align-items:end;gap:2rem}
.kompetensi-note{max-width:320px;color:#718396;font-size:.8rem;line-height:1.7;text-align:right}
.kompetensi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.6rem;width:min(1200px,92%);margin:auto}
.kompetensi-card{position:relative;background:#fff;border:1px solid rgba(13,58,102,.14);border-radius:22px;
  padding:1.9rem 1.7rem;box-shadow:0 20px 45px rgba(13,58,102,.08);overflow:hidden;
  transition:transform .35s ease,box-shadow .35s ease,border-color .35s ease}
.kompetensi-card:hover{transform:translateY(-9px);box-shadow:0 30px 62px rgba(13,58,102,.2);border-color:rgba(255,179,0,.45)}
.kompetensi-card::before{content:"";position:absolute;top:0;left:0;width:100%;height:4px;
  background:linear-gradient(90deg,#0d3a66,#2f6fa8)}
.kompetensi-card::after{content:attr(data-num);position:absolute;right:14px;bottom:-12px;
  font-family:var(--font-display);font-size:4.6rem;font-weight:900;line-height:1;color:rgba(13,58,102,.05);pointer-events:none}
.kompetensi-icon{width:62px;height:62px;border-radius:18px;display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,#0d3a66,#2f6fa8);color:#ffd54a;font-size:1.35rem;
  margin-bottom:1.2rem;transition:transform .35s ease}
.kompetensi-card:hover .kompetensi-icon{transform:rotate(-8deg) scale(1.08)}
.kompetensi-card h3{font-family:var(--font-display);font-size:1.12rem;font-weight:800;color:#0d3a66;margin:0 0 .55rem}
.kompetensi-card p{font-size:.85rem;line-height:1.8;color:#718396;margin:0}
.kompetensi-section .home-orn .ho-chevron{right:-145px;top:45px}
.kompetensi-section .home-orn .ho-line{left:-80px;top:170px}
.kompetensi-section .home-orn .ho-dots{left:3%;bottom:100px}
.kompetensi-section .home-orn .ho-ring{right:8%;bottom:90px}
.kompetensi-section .home-orn .ho-gold{right:16%;top:22%}
.kompetensi-section .home-orn .ho-square{left:11%;top:15%}
.kompetensi-section .home-orn .ho-corner{right:3%;bottom:8%;transform:rotate(180deg)}

/* ---------- PRODUK UNGGULAN (spotlight slider) ---------- */
.produk-section{position:relative;padding:110px 0 130px;background:#fff;isolation:isolate;overflow:hidden}
.produk-head{width:min(1380px,92%);margin:0 auto 60px;display:flex;justify-content:space-between;
  align-items:end;gap:2rem}
.produk-note{max-width:320px;color:#718396;font-size:.8rem;line-height:1.7;text-align:right}

/* Container dikecilin di sini (bukan lewat max-height foto) */
.produk-slider{position:relative;width:min(780px,92%);margin:auto}
.produk-viewport{overflow:hidden;border-radius:26px}
.produk-track{display:flex;transition:transform .55s cubic-bezier(.4,0,.2,1)}
.produk-track.no-transition{transition:none}

.produk-card{position:relative;flex:0 0 100%;width:100%;background:#fff;
  border:1px solid rgba(13,58,102,.14);border-radius:26px;overflow:hidden;
  box-shadow:0 24px 55px rgba(13,58,102,.12)}

/* FIX: hanya pakai aspect-ratio, TANPA max-height, supaya lebar foto selalu 100% container (tidak menyusut) */
.produk-photo{position:relative;width:100%;aspect-ratio:16/9;overflow:hidden;isolation:isolate;
  background:linear-gradient(135deg,var(--p1,#0d3a66),var(--p2,#2f6fa8));
  display:flex;align-items:center;justify-content:center}
.produk-photo::before{content:"";position:absolute;inset:0;z-index:0;opacity:.5;
  background-image:radial-gradient(rgba(255,255,255,.18) 1.5px,transparent 1.5px);
  background-size:20px 20px}
.produk-photo::after{content:"";position:absolute;top:-40px;right:-40px;width:140px;height:140px;
  border:2px solid rgba(255,213,74,.4);transform:rotate(45deg);z-index:0}
.produk-photo i{position:relative;z-index:1;font-size:4rem;color:#ffd54a;
  filter:drop-shadow(0 14px 26px rgba(4,26,48,.4))}

.produk-overlay{position:absolute;inset:0;z-index:2;
  background:linear-gradient(180deg,rgba(8,39,68,0) 40%,rgba(8,39,68,.88) 100%);
  display:flex;align-items:flex-end;padding:1.6rem}
.produk-overlay-inner{background:#fff;border-radius:16px;padding:1.1rem 1.3rem;
  display:flex;align-items:center;justify-content:space-between;gap:1.1rem;
  width:100%;box-shadow:0 18px 40px rgba(8,39,68,.25)}
.produk-overlay-inner h3{font-family:var(--font-display);font-size:1.1rem;font-weight:800;color:#0d3a66;margin:0 0 .28rem}
.produk-overlay-inner p{margin:0;font-size:.76rem;color:#718396}
.produk-badge{flex-shrink:0;font-size:.6rem;font-weight:900;letter-spacing:.06em;text-transform:uppercase;color:#b26a00;
  background:linear-gradient(135deg,#fff7e0,#ffe9b8);border:1px solid rgba(255,179,0,.35);
  padding:.38rem .75rem;border-radius:999px;white-space:nowrap}

.produk-arrow{position:absolute;top:50%;translate:0 -50%;width:52px;height:52px;border-radius:50%;
  background:#0d3a66;border:none;display:flex;align-items:center;justify-content:center;
  color:#fff;font-size:1.1rem;cursor:pointer;z-index:6;box-shadow:0 12px 26px rgba(13,58,102,.4);
  transition:background .25s ease,transform .25s ease,opacity .25s ease}
.produk-arrow:hover{background:#ffb300;transform:translateY(-50%) scale(1.08)}
.produk-arrow.prev{left:-70px}
.produk-arrow.next{right:-70px}
.produk-arrow:disabled{opacity:.35;cursor:default;pointer-events:none}

.produk-dots{display:flex;justify-content:center;gap:.5rem;margin-top:1.8rem}
.produk-dots button{width:9px;height:9px;border-radius:50%;border:none;background:rgba(13,58,102,.2);
  cursor:pointer;padding:0;transition:background .25s ease,width .25s ease}
.produk-dots button.active{background:#ffb300;width:26px;border-radius:6px}
.produk-dots.hidden{display:none}

/* --- Responsive: tablet --- */
@media (max-width:900px){
  .produk-slider{width:94%}
  .produk-photo{aspect-ratio:4/3}
  .produk-overlay{padding:1.3rem}
  .produk-arrow{width:46px;height:46px;font-size:1rem}
  .produk-arrow.prev{left:-12px}
  .produk-arrow.next{right:-12px}
}

/* --- Responsive: mobile --- */
@media (max-width:600px){
  .produk-photo{aspect-ratio:1/1}
  .produk-photo i{font-size:3rem}
  .produk-overlay{padding:1rem}
  .produk-overlay-inner{flex-direction:column;align-items:flex-start;gap:.6rem;padding:1rem 1.15rem;border-radius:14px}
  .produk-overlay-inner h3{font-size:1rem}
  .produk-overlay-inner p{font-size:.72rem}
  .produk-arrow{width:40px;height:40px;font-size:.9rem}
  .produk-arrow.prev{left:-2px}
  .produk-arrow.next{right:-2px}
  .produk-viewport{border-radius:18px}
  .produk-card{border-radius:18px}
}

.produk-section .home-orn .ho-chevron{right:-150px;top:20px}
.produk-section .home-orn .ho-line{left:-80px;bottom:100px}
.produk-section .home-orn .ho-dots{left:4%;top:125px}
.produk-section .home-orn .ho-ring{right:3%;bottom:70px}
.produk-section .home-orn .ho-gold{left:10%;top:24%}
.produk-section .home-orn .ho-square{right:15%;top:20%}

/* ---------- FASILITAS ---------- */
.fasilitas-section{position:relative;padding:110px 0 130px;isolation:isolate;overflow:hidden;
  background:#082744;color:#fff}
.fasilitas-head{width:min(1380px,92%);margin:0 auto 60px;text-align:center}
.fasilitas-head .eyebrow{color:#ffd54a}
.fasilitas-head .big-heading{color:#fff}
.fasilitas-head .big-heading span{background:linear-gradient(135deg,#ffe66d 0%,#ffc107 45%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.fasilitas-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.4rem;width:min(1200px,92%);margin:auto}
.fasilitas-card{position:relative;padding:1.9rem 1.5rem;border:1px solid rgba(255,255,255,.14);border-radius:20px;
  background:rgba(255,255,255,.05);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);
  text-align:center;transition:transform .35s ease,background .35s ease,border-color .35s ease}
.fasilitas-card:hover{transform:translateY(-7px);background:rgba(255,255,255,.12);border-color:rgba(255,213,74,.45)}
.fasilitas-icon{width:58px;height:58px;margin:0 auto 1rem;border-radius:16px;display:flex;align-items:center;
  justify-content:center;background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;
  font-size:1.25rem;transition:transform .35s ease}
.fasilitas-card:hover .fasilitas-icon{transform:rotate(-8deg) scale(1.08)}
.fasilitas-card h3{font-family:var(--font-display);font-size:1rem;font-weight:800;color:#fff;margin:0 0 .45rem}
.fasilitas-card p{font-size:.78rem;line-height:1.7;color:rgba(235,245,253,.72);margin:0}
.fasilitas-section .home-orn .ho-chevron{left:-150px;top:35px;border-color:rgba(255,255,255,.10)}
.fasilitas-section .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.09)}
.fasilitas-section .home-orn .ho-line{right:-80px;bottom:95px}
.fasilitas-section .home-orn .ho-dots{right:6%;top:90px;opacity:.25}
.fasilitas-section .home-orn .ho-ring{left:43%;bottom:-90px;border-color:rgba(255,255,255,.12)}
.fasilitas-section .home-orn .ho-gold{right:14%;top:28%}

/* ---------- VIRTUAL TOUR SECTION ---------- */
.vtour-section{position:relative;padding:120px 0 130px;isolation:isolate;overflow:hidden;
  background:linear-gradient(180deg,#ffffff 0%,#eef5fb 100%)}
.vtour-head{width:min(860px,92%);margin:0 auto 62px;text-align:center;position:relative;z-index:2}
.vtour-head .eyebrow{justify-content:center}
.vtour-head .eyebrow::before{display:none}
.vtour-head .eyebrow::after{content:"";width:26px;height:3px;border-radius:99px;
  background:linear-gradient(90deg,#ffd54a,#ffb300)}
.vtour-head p{margin:1.1rem auto 0;max-width:640px;color:#5f7186;font-size:1rem;line-height:1.9}
.vtour-card{position:relative;width:min(1120px,92%);margin:0 auto;border-radius:30px;overflow:hidden;
  isolation:isolate;background:linear-gradient(135deg,#081f3a 0%,#0d3a66 58%,#15497f 100%);
  color:#fff;box-shadow:0 45px 110px rgba(8,31,58,.38);z-index:2;
  transition:transform .45s ease,box-shadow .45s ease}
.vtour-card:hover{transform:translateY(-8px);box-shadow:0 55px 130px rgba(8,31,58,.48)}
.vtour-card .vtc-chevron{position:absolute;right:-64px;top:-64px;width:190px;height:190px;
  border-top:2px solid rgba(255,213,74,.25);border-right:2px solid rgba(255,213,74,.25);transform:rotate(45deg)}
.vtour-card .vtc-chevron::after{content:"";position:absolute;inset:26px;
  border-top:1px solid rgba(255,255,255,.14);border-right:1px solid rgba(255,255,255,.14)}
.vtour-card .vtc-dots{position:absolute;left:22px;bottom:20px;width:92px;height:92px;opacity:.5;
  background-image:radial-gradient(rgba(255,213,74,.5) 1.5px,transparent 1.5px);background-size:14px 14px}
.vtour-card .vtc-ring{position:absolute;left:-64px;top:-64px;width:200px;height:200px;
  border:1px solid rgba(47,111,168,.55);border-radius:50%}
.vtour-card .vtc-ring::before{content:"";position:absolute;inset:20px;
  border:1px dashed rgba(255,255,255,.16);border-radius:50%}
.vtour-card .vtc-gold{position:absolute;left:0;top:0;width:6px;height:100%;
  background:linear-gradient(180deg,#ffe66d,#ffb300 55%,#ff7a00)}
.vtour-card .vtc-diag{position:absolute;right:-40px;bottom:60px;width:260px;height:2px;opacity:.5;
  background:linear-gradient(90deg,transparent,#2f6fa8,transparent);transform:rotate(-38deg)}
.vtour-card .vtc-diag::after{content:"";position:absolute;left:60px;top:12px;width:150px;height:1px;
  background:linear-gradient(90deg,transparent,#ffd54a,transparent)}
.vtour-card .vtc-square{position:absolute;left:8%;bottom:14%;width:52px;height:52px;
  border:2px solid rgba(255,179,0,.3);transform:rotate(45deg)}
.vtour-card .vtc-square::before{content:"";position:absolute;inset:8px;border:1px solid rgba(255,255,255,.14)}
.vtour-card-inner{position:relative;z-index:2;display:grid;grid-template-columns:1.02fr .98fr;gap:2.6rem;
  align-items:center;padding:clamp(2.2rem,5vw,3.6rem)}
.vtour-card-copy .vtc-kicker{display:inline-flex;align-items:center;gap:.55rem;font-size:.72rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#ffd54a;margin-bottom:.9rem}
.vtour-card-copy .vtc-kicker::before{content:"";width:28px;height:3px;border-radius:99px;
  background:linear-gradient(90deg,#ffd54a,#ffb300)}
.vtour-card-copy h3{font-family:var(--font-display);font-size:clamp(1.8rem,3.6vw,2.9rem);line-height:1.05;
  margin:0 0 1rem;color:#fff}
.vtour-card-copy h3 span{background:linear-gradient(135deg,#ffe66d,#ffc107 45%,#ff8a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.vtour-card-copy p{margin:0 0 1.8rem;color:rgba(235,245,253,.82);line-height:1.9;font-size:.98rem;max-width:480px}
.vtour-cta-btn{display:inline-flex;align-items:center;gap:.65rem;padding:1rem 2rem;border-radius:999px;
  background:linear-gradient(135deg,#ffd54a,#ffb300,#ff8a00);color:#0d3a66;font-weight:800;font-size:.95rem;
  text-decoration:none;box-shadow:0 20px 44px rgba(255,138,0,.38);
  transition:transform .3s ease,box-shadow .3s ease}
.vtour-cta-btn:hover{transform:translateY(-4px);box-shadow:0 26px 54px rgba(255,138,0,.52)}
.vtour-cta-btn i{transition:transform .3s ease}
.vtour-cta-btn:hover i{transform:translateX(6px)}
.vtour-visual{position:relative;height:360px;border-radius:24px;overflow:hidden;isolation:isolate;
  background:radial-gradient(120% 130% at 30% 20%,#123f73 0%,#0a2a4e 55%,#071c36 100%);
  border:1px solid rgba(255,255,255,.16);
  box-shadow:inset 0 0 80px rgba(3,14,28,.6),0 24px 50px rgba(3,14,28,.4)}
.vtour-map{position:absolute;inset:26px 26px 30px;border:1.5px dashed rgba(255,213,74,.4);border-radius:18px;
  z-index:1;background:linear-gradient(rgba(255,255,255,.045) 1px,transparent 1px),
  linear-gradient(90deg,rgba(255,255,255,.045) 1px,transparent 1px);
  background-size:34px 34px}
.vtour-map::before{content:"STUDIO DKV";position:absolute;top:12px;left:16px;font-size:.56rem;font-weight:900;
  letter-spacing:.22em;color:rgba(255,213,74,.6)}
.vtour-line{position:absolute;height:2px;background:linear-gradient(90deg,rgba(255,213,74,.7),rgba(47,111,168,.4));
  transform-origin:left center;z-index:2}
.vtour-line::after{content:"";position:absolute;right:0;top:-3px;width:8px;height:8px;border-radius:50%;
  background:#ffd54a;box-shadow:0 0 0 4px rgba(255,213,74,.22)}
.vtour-pin{position:absolute;z-index:3;transform:translate(-50%,-50%);text-align:center;width:92px}
.vtour-pin .pin-ic{width:46px;height:46px;margin:0 auto 6px;border-radius:14px;display:flex;align-items:center;
  justify-content:center;font-size:1.05rem;color:#0d3a66;
  background:linear-gradient(135deg,#ffd54a,#ffb300);box-shadow:0 10px 22px rgba(3,14,28,.45);
  animation:pinFloat 3.6s ease-in-out infinite;transition:transform .3s ease}
.vtour-pin:nth-child(3n) .pin-ic{background:linear-gradient(135deg,#ffffff,#cfdff0);animation-delay:.9s}
.vtour-pin:nth-child(3n+1) .pin-ic{animation-delay:1.8s}
.vtour-card:hover .vtour-pin .pin-ic{transform:scale(1.12)}
@keyframes pinFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-6px)}}
.vtour-pin span{display:block;font-size:.58rem;font-weight:800;letter-spacing:.06em;text-transform:uppercase;
  color:#fff;background:rgba(4,18,36,.55);padding:.28rem .5rem;border-radius:999px;
  border:1px solid rgba(255,255,255,.18);backdrop-filter:blur(4px)}
.vtour-360{position:absolute;top:14px;right:14px;z-index:4;display:flex;align-items:center;gap:.4rem;
  padding:.42rem .75rem;border-radius:999px;font-size:.66rem;font-weight:900;letter-spacing:.12em;color:#ffd54a;
  background:rgba(4,18,36,.55);border:1px solid rgba(255,213,74,.4);backdrop-filter:blur(4px)}
.vtour-360 i{font-size:.8rem}
.vtour-fac{position:absolute;z-index:3;font-size:.58rem;font-weight:800;letter-spacing:.04em;
  text-transform:uppercase;color:rgba(255,255,255,.85);background:rgba(47,111,168,.22);
  border:1px solid rgba(255,255,255,.14);padding:.3rem .55rem;border-radius:8px;backdrop-filter:blur(3px)}
.vtour-section .home-orn .ho-chevron{left:-150px;top:60px}
.vtour-section .home-orn .ho-line{right:-90px;bottom:110px}
.vtour-section .home-orn .ho-dots{right:7%;top:110px;opacity:.45}
.vtour-section .home-orn .ho-ring{right:-80px;top:34%;border-color:rgba(13,58,102,.15)}
.vtour-section .home-orn .ho-gold{left:9%;top:22%}
.vtour-section .home-orn .ho-square{left:6%;bottom:12%}
.vtour-section .home-orn .ho-corner{right:3%;bottom:9%;transform:rotate(180deg)}

/* ---------- CTA ---------- */
.dkv-cta{position:relative;padding:90px 0 100px;overflow:hidden;text-align:center;isolation:isolate;
  background:linear-gradient(135deg,#071a33 0%,#0d3a66 60%,#17497f 100%)}
.dkv-cta::after{content:"#SMKN2BISA";position:absolute;left:50%;bottom:-34px;transform:translateX(-50%);
  font-family:var(--font-display);font-size:clamp(6rem,18vw,16rem);font-weight:900;line-height:1;
  color:rgba(255,255,255,.04);pointer-events:none;white-space:nowrap;user-select:none}
.dkv-cta-inner{position:relative;z-index:2;width:min(800px,92%);margin:auto}
.dkv-cta h2{font-family:var(--font-display);font-size:clamp(1.9rem,4vw,3.4rem);line-height:1.05;margin:0 0 1rem;color:#fff}
.dkv-cta h2 span{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.dkv-cta p{color:rgba(235,245,253,.8);line-height:1.85;max-width:620px;margin:0 auto 2rem}
.dkv-cta-btn{display:inline-flex;align-items:center;gap:.6rem;padding:.95rem 2rem;border-radius:999px;
  background:linear-gradient(135deg,#ffd54a,#ffb300,#ff8a00);color:#0d3a66;font-weight:800;font-size:.95rem;
  text-decoration:none;box-shadow:0 18px 40px rgba(255,138,0,.35);
  transition:transform .3s ease,box-shadow .3s ease}
.dkv-cta-btn:hover{transform:translateY(-4px);box-shadow:0 22px 46px rgba(255,138,0,.5)}
.dkv-cta-btn i{transition:transform .3s ease}
.dkv-cta-btn:hover i{transform:translateX(5px)}
.dkv-cta .home-orn .ho-chevron{left:-120px;bottom:-80px;border-color:rgba(255,255,255,.10)}
.dkv-cta .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.dkv-cta .home-orn .ho-dots{left:8%;top:30%;opacity:.22}
.dkv-cta .home-orn .ho-ring{right:-70px;top:20%;border-color:rgba(255,255,255,.10)}
.dkv-cta .home-orn .ho-gold{left:20%;bottom:26%}

/* z-index konten di atas ornamen */
.profil-section>*:not(.home-orn),.kompetensi-section>*:not(.home-orn),
.produk-section>*:not(.home-orn),.fasilitas-section>*:not(.home-orn),
.vtour-section>*:not(.home-orn),
.dkv-cta>*:not(.home-orn){position:relative;z-index:2}

/* ---------- SCROLL REVEAL ---------- */
[data-reveal]{opacity:0;transform:translateY(36px);transition:opacity .7s var(--ease, cubic-bezier(.22,.61,.36,1)),transform .7s var(--ease, cubic-bezier(.22,.61,.36,1))}
[data-reveal="left"]{transform:translateX(-46px)}
[data-reveal="right"]{transform:translateX(46px)}
[data-reveal].revealed{opacity:1;transform:none}
[data-reveal]{transition-delay:calc(var(--d,0)*90ms)}

/* ---------- RESPONSIVE ---------- */
@media(max-width:950px){
  .dkv-hero-inner{grid-template-columns:1fr;gap:2.5rem}
  .hero-photo{height:330px;transform:none}
  .profil-grid{grid-template-columns:1fr;gap:2.5rem}
  .kompetensi-head,.produk-head{flex-direction:column;align-items:flex-start;gap:1rem}
  .kompetensi-note,.produk-note{text-align:left;max-width:100%}
  .kompetensi-grid{grid-template-columns:repeat(2,1fr)}
  .fasilitas-grid{grid-template-columns:repeat(2,1fr)}
  .vtour-card-inner{grid-template-columns:1fr;gap:2rem}
  .vtour-visual{height:320px}
}
@media(max-width:700px){
  .dkv-hero{min-height:auto}
  .dkv-hero::after{font-size:clamp(4.5rem,26vw,9rem);opacity:.8}
  .hero-photo{height:240px}
  .kompetensi-grid{grid-template-columns:1fr}
  .fasilitas-grid{grid-template-columns:1fr}
  .stat-strip{grid-template-columns:1fr}
  .vtour-visual{height:270px}
  .vtour-map{inset:16px 16px 22px}
  .vtour-pin{width:70px}
  .vtour-pin .pin-ic{width:38px;height:38px;font-size:.9rem}
  .vtour-fac{display:none}
  .vtour-360{top:10px;right:10px;font-size:.58rem}
  .home-orn .ho-chevron{width:220px;height:220px}
  .home-orn .ho-dots{width:80px;height:80px;background-size:14px 14px}
  .home-orn .ho-ring{width:110px;height:110px}
  .home-orn .ho-line{width:190px}
  .home-orn .ho-square{width:42px;height:42px}
  .home-orn .ho-corner{width:70px;height:70px}
  [data-reveal]{opacity:1;transform:none}
}
</style>
@endpush

@section('content')
<div class="dkv-page">
  <!-- HERO -->
  <section class="dkv-hero">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="dkv-hero-inner">
      <div>
        <div class="dkv-kicker">Salah Satu jurusan di SKANEDA</div>
        <h1 class="dkv-title">
          <span class="dkv-white">PROGRAM</span><br>
          <span class="dkv-white">KEAHLIAN</span><br>
          <span class="dkv-gold">DKV</span>
        </h1>
        <a href="#virtual-tour-dkv" class="vt-hero-box" aria-label="Lihat Virtual Tour Studio DKV">
          <span class="vth-chevron" aria-hidden="true"></span>
          <span class="vth-dots" aria-hidden="true"></span>
          <span class="vth-ring" aria-hidden="true"></span>
          <span class="vth-gold" aria-hidden="true"></span>
          <span class="vt-hero-icon"><i class="fas fa-vr-cardboard"></i></span>
          <span class="vt-hero-body">
            <span class="vt-hero-title">Virtual Tour Studio DKV</span>
            <span class="vt-hero-btn">Lihat Virtual Tour <i class="fas fa-arrow-right"></i></span>
          </span>
        </a>
      </div>
      <div class="hero-photo" data-reveal="right">
        <img src="{{ asset('images/dkv.png') }}" alt="Praktik siswa program keahlian DKV" loading="eager">
        <div class="hero-photo-caption"><strong>DKV SKANEDA</strong><span>Mengubah ide menjadi karya visual yang bicara.</span></div>
      </div>
    </div>
  </section>

  <!-- PROFIL -->
  <section class="profil-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
    </div>
    <div class="dkv-wide profil-grid">
      <div data-reveal>
        <div class="eyebrow">Tentang Jurusan</div>
        <h2 class="big-heading">Profil <span>DKV</span></h2>
        <p class="profil-copy">Kompetensi Keahlian <strong>Desain Komunikasi Visual (DKV)</strong> membekali peserta didik dengan keterampilan menyampaikan pesan melalui elemen visual secara informatif, komunikatif, dan kreatif. Pembelajaran mencakup seni rupa, gambar, sketsa, desain publikasi, komputer grafis, fotografi, dan videografi.</p>
        <p class="profil-copy">Peserta didik juga dibekali kemampuan mengembangkan ide, mengelola usaha, serta memasarkan produk desain. Lulusan DKV dipersiapkan untuk bekerja di industri kreatif, menjadi freelancer, mengembangkan usaha mandiri, maupun melanjutkan pendidikan ke jenjang yang lebih tinggi.</p>
      </div>
      <div class="stat-strip" data-reveal="right">
        <div class="stat-box"><div class="stat-num">4</div><div class="stat-label">Tahun Belajar</div></div>
        <div class="stat-box"><div class="stat-num gold">10+</div><div class="stat-label">Jenis Karya Visual</div></div>
        <div class="stat-box"><div class="stat-num">100%</div><div class="stat-label">Berbasis Praktik</div></div>
        <div class="stat-box"><div class="stat-num gold">DUDI</div><div class="stat-label">Kemitraan Industri Kreatif</div></div>
      </div>
    </div>
  </section>

  <!-- KOMPETENSI -->
  <section class="kompetensi-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>
    <div class="kompetensi-head" data-reveal>
      <div>
        <div class="eyebrow">Apa yang dipelajari</div>
        <h2 class="big-heading">Kompetensi <span>Keahlian</span></h2>
      </div>
      <div class="kompetensi-note">Kurikulum berbasis proyek kreatif — siswa menguasai seluruh proses produksi visual, dari konsep hingga karya final siap pakai.</div>
    </div>
    <div class="kompetensi-grid">
      <article class="kompetensi-card" data-num="01" data-reveal>
        <div class="kompetensi-icon"><i class="fas fa-pen-nib"></i></div>
        <h3>Dasar Seni & Kreativitas</h3>
        <p>Mempelajari dasar-dasar kreativitas, seni rupa, serta penerapannya dalam komunikasi visual.</p>
      </article>
      <article class="kompetensi-card" data-num="02" data-reveal style="--d:1">
        <div class="kompetensi-icon"><i class="fas fa-camera-retro"></i></div>
        <h3>Desain Publikasi</h3>
        <p>Mempelajari perancangan desain publikasi dan tata letak berbagai media visual.</p>
      </article>
      <article class="kompetensi-card" data-num="03" data-reveal style="--d:2">
        <div class="kompetensi-icon"><i class="fas fa-film"></i></div>
        <h3>Gambar & Sketsa</h3>
        <p>Mengembangkan kemampuan menggambar dan membuat sketsa sebagai dasar visualisasi ide.</p>
      </article>
      <article class="kompetensi-card" data-num="04" data-reveal>
        <div class="kompetensi-icon"><i class="fas fa-palette"></i></div>
        <h3>Komputer Grafis</h3>
        <p>Mengolah dan menghasilkan karya desain menggunakan teknologi komputer grafis.</p>
      </article>
      <article class="kompetensi-card" data-num="05" data-reveal style="--d:1">
        <div class="kompetensi-icon"><i class="fas fa-desktop"></i></div>
        <h3>Fotografi & Videografi</h3>
        <p>Mengembangkan keterampilan fotografi dan videografi untuk kebutuhan komunikasi visual.</p>
      </article>
      <article class="kompetensi-card" data-num="06" data-reveal style="--d:2">
        <div class="kompetensi-icon"><i class="fas fa-lightbulb"></i></div>
        <h3>Kreatif & Kewirausahaan</h3>
        <p>Mengembangkan produk kreatif serta kemampuan mengelola dan memasarkan usaha desain.</p>
      </article>
    </div>
  </section>

  <!-- PRODUK UNGGULAN -->
  <section class="produk-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
    </div>
    <div class="produk-head" data-reveal>
      <div>
        <div class="eyebrow">Karya siswa</div>
        <h2 class="big-heading">Produk <span>Unggulan</span></h2>
      </div>
      <div class="produk-note">Hasil karya visual siswa DKV — diproduksi di studio sekolah dengan standar kreatif dan profesional.</div>
    </div>

    <div class="produk-slider" data-reveal>
      <button class="produk-arrow prev" id="produkPrev" aria-label="Sebelumnya">
        <i class="fas fa-chevron-left"></i>
      </button>

      <div class="produk-viewport">
        <div class="produk-track" id="produkTrack">

          <article class="produk-card">
            <div class="produk-photo">
              <img src="{{ asset('images/produk/tambalbanexpres.jpeg') }}" alt="TambalBanExpres">
              <div class="produk-overlay">
                <div class="produk-overlay-inner">
                  <div>
                    <h3>Tambal Ban Express</h3>
                    <p>Desain UI/UX inovatif untuk aplikasi digital.</p>
                  </div>
                  <span class="produk-badge">Desain</span>
                </div>
              </div>
            </div>
          </article>

          <!--
            Tambah karya baru: copy 1 blok <article class="produk-card">...</article> di sini.
            Slider & dots akan otomatis menyesuaikan.
          -->

        </div>
      </div>

      <button class="produk-arrow next" id="produkNext" aria-label="Selanjutnya">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>

    <div class="produk-dots" id="produkDots"></div>
  </section>

  <!-- FASILITAS -->
  <section class="fasilitas-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
    </div>
    <div class="fasilitas-head" data-reveal>
      <div class="eyebrow">Sarana pendukung belajar</div>
      <h2 class="big-heading">Fasilitas <span>Praktik</span></h2>
    </div>
    <div class="fasilitas-grid">
      <div class="fasilitas-card" data-reveal>
        <div class="fasilitas-icon"><i class="fas fa-desktop"></i></div>
        <h3>Lab. Komputer Desain</h3>
        <p>Ruang praktik dengan perangkat desain lengkap: Adobe Creative Suite dan software pendukung lainnya.</p>
      </div>
      <div class="fasilitas-card" data-reveal style="--d:1">
        <div class="fasilitas-icon"><i class="fas fa-camera"></i></div>
        <h3>Studio Foto & Video</h3>
        <p>Studio dengan pencahayaan dan peralatan produksi foto/video berstandar profesional.</p>
      </div>
      <div class="fasilitas-card" data-reveal style="--d:2">
        <div class="fasilitas-icon"><i class="fas fa-print"></i></div>
        <h3>Ruang Cetak & Finishing</h3>
        <p>Fasilitas cetak dan finishing untuk mewujudkan karya desain dalam bentuk fisik.</p>
      </div>
      <div class="fasilitas-card" data-reveal style="--d:3">
        <div class="fasilitas-icon"><i class="fas fa-store"></i></div>
        <h3>Galeri / Showroom Karya</h3>
        <p>Ruang pameran karya siswa sekaligus simulasi bisnis jasa desain secara nyata.</p>
      </div>
    </div>
  </section>

  <!-- VIRTUAL TOUR STUDIO DKV -->
  <section class="vtour-section" id="virtual-tour-dkv">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>
    <div class="vtour-head" data-reveal>
      <div class="eyebrow">Virtual Tour</div>
      <h2 class="big-heading">Jelajahi <span>Studio DKV</span></h2>
      <p>Kenali lebih dekat ruang praktik, fasilitas, dan lingkungan pembelajaran Desain Komunikasi Visual melalui virtual tour.</p>
    </div>
    <div class="vtour-card" data-reveal>
      <span class="vtc-chevron" aria-hidden="true"></span>
      <span class="vtc-dots" aria-hidden="true"></span>
      <span class="vtc-ring" aria-hidden="true"></span>
      <span class="vtc-gold" aria-hidden="true"></span>
      <span class="vtc-diag" aria-hidden="true"></span>
      <span class="vtc-square" aria-hidden="true"></span>
      <div class="vtour-card-inner">
        <div class="vtour-card-copy">
          <span class="vtc-kicker"><i class="fas fa-vr-cardboard"></i> Interaktif &amp; Menyeluruh</span>
          <h3>Virtual Tour <span>Studio DKV</span></h3>

          <a href="#virtual-tour-dkv" class="vtour-cta-btn">Mulai Virtual Tour <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="vtour-visual" aria-hidden="true">
          <div class="vtour-map"></div>
          <span class="vtour-line" style="left:18%;top:52%;width:30%"></span>
          <span class="vtour-line" style="left:50%;top:52%;width:30%"></span>
          <span class="vtour-pin" style="left:26%;top:34%">
            <span class="pin-ic"><i class="fas fa-desktop"></i></span>
            <span>Lab Komputer</span>
          </span>
          <span class="vtour-pin" style="left:62%;top:30%">
            <span class="pin-ic"><i class="fas fa-camera"></i></span>
            <span>Studio Foto</span>
          </span>
          <span class="vtour-pin" style="left:50%;top:68%">
            <span class="pin-ic"><i class="fas fa-print"></i></span>
            <span>Ruang Cetak</span>
          </span>
          <span class="vtour-fac" style="left:12%;top:70%">Rak Karya</span>
          <span class="vtour-fac" style="right:10%;top:66%">Finishing</span>
          <span class="vtour-fac" style="left:40%;top:12%">Pencahayaan</span>
          <span class="vtour-360"><i class="fas fa-sync-alt"></i> 360°</span>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="dkv-cta">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
    </div>
    <div class="dkv-cta-inner" data-reveal>
      <h2>Wujudkan kreativitasmu di <span>DKV SKANEDA</span></h2>
      <p>Bergabunglah dengan Program Keahlian Desain Komunikasi Visual dan jadilah generasi kreator visual yang inovatif, ekspresif, dan siap bersaing di industri kreatif digital.</p>
      <a href="{{ route('home') }}#ppdb" class="dkv-cta-btn"><i class="fas fa-arrow-right"></i> Info PPDB 2026/2027</a>
    </div>
  </section>
</div>
@endsection

@push('scripts')
<script>
  /* ---- Scroll Reveal ---- */
  (function () {
    var revealEls = document.querySelectorAll('[data-reveal]');
    if (!('IntersectionObserver' in window)) {
      revealEls.forEach(function (el) { el.classList.add('revealed'); });
      return;
    }
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add('revealed'); obs.unobserve(e.target); }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
    revealEls.forEach(function (el) { obs.observe(el); });

    var pending = Array.prototype.slice.call(revealEls);
    var checks = 0;
    var iv = setInterval(function () {
      checks++;
      var vh = window.innerHeight;
      pending = pending.filter(function (el) {
        if (el.classList.contains('revealed')) return false;
        var r = el.getBoundingClientRect();
        if (r.top < vh + 220 && r.bottom > -40) { el.classList.add('revealed'); return false; }
        return true;
      });
      if (checks >= 8) {
        pending.forEach(function (el) { el.classList.add('revealed'); });
        clearInterval(iv);
      } else if (pending.length === 0) {
        clearInterval(iv);
      }
    }, 450);
  })();
</script>

<script>
  /* ---- Karya Unggulan Spotlight Slider ---- */
(function(){
  const track   = document.getElementById('produkTrack');
  const prevBtn = document.getElementById('produkPrev');
  const nextBtn = document.getElementById('produkNext');
  const dotsWrap = document.getElementById('produkDots');
  if(!track) return;

  let index = 0;
  const cards = () => Array.from(track.children);

  function buildDots(){
    dotsWrap.innerHTML = '';
    const total = cards().length;
    if(total <= 1){
      dotsWrap.classList.add('hidden');
      return;
    }
    dotsWrap.classList.remove('hidden');
    for(let i=0;i<total;i++){
      const b = document.createElement('button');
      if(i === index) b.classList.add('active');
      b.addEventListener('click', () => goTo(i));
      dotsWrap.appendChild(b);
    }
  }

  function update(){
    track.style.transform = `translateX(-${index * 100}%)`;
    const total = cards().length;

    prevBtn.disabled = total <= 1 || index <= 0;
    nextBtn.disabled = total <= 1 || index >= total - 1;

    Array.from(dotsWrap.children).forEach((d,i)=> d.classList.toggle('active', i===index));
  }

  function goTo(i){
    const total = cards().length;
    index = Math.min(Math.max(i,0), total - 1);
    update();
  }

  prevBtn.addEventListener('click', () => goTo(index - 1));
  nextBtn.addEventListener('click', () => goTo(index + 1));

  buildDots();
  update();
})();
</script>
@endpush