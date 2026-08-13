@extends('layouts.app')

@section('title', 'Sejarah Sekolah — SMK Negeri 2 Mojokerto')
@section('description', 'Jejak perjalanan SMK Negeri 2 Mojokerto sejak 1968 hingga menjadi sekolah vokasi unggulan.')

@push('styles')
<style>
/* =========================================================
   SEJARAH SEKOLAH — PREMIUM EDITION
   Visual language: konsisten dengan Beranda (teal #0d3a66),
   foto gedung + overlay, watermark typography, glassmorphism,
   scroll-reveal, section-title gradient.
   Konten/informasi asli TIDAK diubah.
   ========================================================= */
.history-page{background:#f7f9fc;color:#0d3a66;overflow:hidden}
.history-page *{box-sizing:border-box}
.history-shell{width:100%}

/* ---------- HERO: foto gedung + overlay + watermark ---------- */
.history-hero{position:relative;min-height:88vh;display:flex;align-items:flex-start;overflow:hidden;
  background-image:url('{{ asset('images/hero-sekolah.jpg') }}');
  background-size:cover;background-position:center;background-repeat:no-repeat;color:#fff}
.history-hero::before{content:"";position:absolute;inset:0;z-index:1;
  background:linear-gradient(100deg,rgba(7,22,42,.88) 0%,rgba(9,30,54,.66) 45%,rgba(9,30,54,.30) 78%,rgba(9,30,54,.10) 100%)}
/* Watermark typography besar transparan (elemen grafis background) */
.history-hero::after{content:"SEJARAH";position:absolute;z-index:2;right:-2%;top:50%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(6rem,22vw,22rem);font-weight:900;line-height:.82;
  letter-spacing:.02em;color:rgba(255,255,255,.055);-webkit-text-stroke:1px rgba(255,255,255,.07);
  text-shadow:0 0 90px rgba(13,58,102,.16);pointer-events:none;white-space:nowrap;user-select:none}
.history-hero-inner{position:relative;z-index:3;width:min(1400px,92%);margin:0 auto;
  padding:clamp(3.5rem,9vh,5.5rem) 0 clamp(4.5rem,8vh,5.5rem);
  display:grid;grid-template-columns:minmax(0,1.05fr) minmax(340px,.95fr);gap:4rem;align-items:center}

.history-kicker{display:inline-flex;transform:translateY(0);align-items:center;gap:.65rem;font-size:.74rem;font-weight:800;
  letter-spacing:.22em;text-transform:uppercase;color:#ffd54a;margin-bottom:0.6rem}
.history-kicker::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ffb300)}

/* ---------- TITLE: SEJARAH putih, SKANEDA kuning-oranye ---------- */
.history-title{font-family:var(--font-display);font-size:clamp(2.9rem,7vw,6.4rem);line-height:.98;
  letter-spacing:.01em;margin:0;max-width:760px;text-transform:uppercase;
  text-shadow:0 2px 24px rgba(4,14,28,.35);animation:hdFadeUp .7s .1s var(--ease, ease) both}
.history-title .sejarah-white{color:#ffffff;display:inline-block}
.history-title .skaneda-gold{display:inline-block;
  background:linear-gradient(135deg,#ffe66d 0%,#ffc107 45%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ffc107;
  text-shadow:0 4px 24px rgba(255,174,0,.18);letter-spacing:.025em}

.history-lead{font-size:1.02rem;line-height:1.85;color:rgba(235,245,253,.86);max-width:640px;
  margin:1.3rem 0 0;animation:hdFadeUp .7s .26s var(--ease, ease) both}
.history-hero-meta{display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;animation:hdFadeUp .7s .4s var(--ease, ease) both}
.history-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;
  border:1px solid rgba(255,255,255,.2);background:rgba(13,58,102,.30);border-radius:999px;
  font-size:.72rem;font-weight:800;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)}
.history-pill i{color:#ffd54a}
.hero-photo{position:relative;height:430px;border-radius:24px;overflow:hidden;
   box-shadow:0 42px 85px rgba(4,20,38,.42),0 18px 34px rgba(0,0,0,.22);
  border:1px solid rgba(255,255,255,.22);box-shadow:0 35px 90px rgba(0,0,0,.38);
  transform:rotate(1.5deg);animation:hdFadeUp .8s .35s var(--ease, ease) both}
.hero-photo::before{content:"";position:absolute;inset:0;z-index:2;
  background:linear-gradient(180deg,transparent 38%,rgba(4,20,38,.86) 100%)}
.hero-photo img{width:100%;height:100%;object-fit:cover;display:block;transform:scale(1.03)}
.hero-photo-caption{position:absolute;z-index:3;left:1.5rem;right:1.5rem;bottom:1.3rem}
.hero-photo-caption strong{display:block;font-family:var(--font-display);font-size:1.3rem;font-weight:600;color:#fff}
.hero-photo-caption span{font-size:.72rem;color:rgba(255,255,255,.74)}
@keyframes hdFadeUp{from{opacity:0;transform:translateY(26px)}to{opacity:1;transform:none}}

/* ---------- SECTION COMMON (sama keluarga dengan Beranda) ---------- */
.history-wide{width:min(1380px,92%);margin:auto}
.eyebrow{display:inline-flex;align-items:center;gap:.5rem;font-size:.74rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#0d3a66;margin-bottom:.85rem}
.eyebrow::before{content:"";width:26px;height:3px;border-radius:99px;background:linear-gradient(90deg,#0d3a66,#2f6fa8)}
.big-heading{font-family:var(--font-display);font-size:clamp(2.1rem,4.4vw,4.2rem);line-height:1.02;
  letter-spacing:.01em;margin:0;color:#0d3a66;text-shadow:0 2px 10px rgba(13,58,102,.06)}
.big-heading span{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}

/* ---------- INTRO / STATS (glassmorphism) ---------- */
.history-intro{position:relative;padding:96px 0 110px;background:#fff}
.intro-grid{display:grid;grid-template-columns:1.1fr .9fr;gap:5rem;align-items:center}
.intro-copy{font-size:1rem;line-height:1.95;color:#5f7186;margin-top:1.25rem;max-width:720px}
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

/* ---------- TIMELINE (teal premium) ---------- */
.timeline-section{position:relative;padding:110px 0 130px;
  background:linear-gradient(180deg,#f7f9fc 0%,#eef5f8 100%)}
.timeline-section::before{content:"";position:absolute;left:0;right:0;top:0;height:1px;
  background:linear-gradient(90deg,transparent,#b7cce0,transparent)}
.timeline-head{width:min(1380px,92%);margin:0 auto 70px;display:flex;justify-content:space-between;
  align-items:end;gap:2rem}
.timeline-head .big-heading{max-width:760px}
.timeline-note{max-width:320px;color:#718396;font-size:.8rem;line-height:1.7;text-align:right}
.timeline{position:relative;width:min(1200px,92%);margin:auto}
.timeline::before{content:"";position:absolute;top:0;bottom:0;left:50%;width:3px;transform:translateX(-50%);
  background:linear-gradient(180deg,#0a2d52 0%,#0d3a66 48%,#ffb300 100%);
  box-shadow:0 0 0 8px rgba(13,58,102,.05)}
.timeline-item{position:relative;width:50%;padding:0 52px 70px}
.timeline-item.left{left:0;text-align:right}
.timeline-item.right{left:50%;text-align:left}
.timeline-marker{position:absolute;top:16px;width:56px;height:56px;border-radius:18px;
  background:linear-gradient(135deg,#0d3a66,#0a2d52);border:5px solid #eef5f8;color:#ffd54a;
  display:flex;align-items:center;justify-content:center;font-size:1rem;
  box-shadow:0 12px 28px rgba(13,58,102,.3);z-index:3;transform:rotate(45deg)}
.timeline-marker i{transform:rotate(-45deg)}
.timeline-item.left .timeline-marker{right:-28px}
.timeline-item.right .timeline-marker{left:-28px}
.timeline-card{position:relative;background:#fff;border:1px solid #e3edf0;border-radius:22px;
  padding:1.6rem 1.7rem;box-shadow:0 20px 45px rgba(13,58,102,.08);overflow:hidden;
  transition:transform .35s ease,box-shadow .35s ease}
.timeline-card:hover{transform:translateY(-7px);box-shadow:0 28px 60px rgba(13,58,102,.16)}
.timeline-card::before{content:"";position:absolute;top:0;bottom:0;width:5px;
  background:linear-gradient(180deg,#0d3a66,#2f6fa8)}
.timeline-item.left .timeline-card::before{right:0}
.timeline-item.right .timeline-card::before{left:0}
.timeline-year{font-family:var(--font-display);font-size:2.1rem;line-height:1;color:#0d3a66;font-weight:900}
.timeline-title{font-size:1.12rem;font-weight:900;color:#0d3a66;margin:.5rem 0 .6rem}
.timeline-text{font-size:.86rem;line-height:1.8;color:#718396}
.timeline-tag{display:inline-flex;margin-top:1rem;padding:.35rem .65rem;border-radius:999px;
  background:linear-gradient(135deg,#e8f1f8,#edf4fa);color:#0a2d52;font-size:.66rem;font-weight:900;
  text-transform:uppercase;letter-spacing:.08em;border:1px solid rgba(13,58,102,.18)}

/* ---------- STORY BAND (teal) ---------- */
.story-band{position:relative;min-height:520px;display:grid;grid-template-columns:1fr 1fr;
  background:#082744;color:#fff;overflow:hidden}
.story-image{position:relative;min-height:520px;overflow:hidden}
.story-image img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .8s ease}
.story-band:hover .story-image img{transform:scale(1.04)}
.story-image::after{content:"";position:absolute;inset:0;background:linear-gradient(90deg,transparent 45%,#082744 100%)}
.story-content{position:relative;display:flex;align-items:center;padding:70px clamp(2rem,7vw,7rem) 70px 4rem;overflow:hidden}
.story-content::before{content:"1968";position:absolute;right:-20px;bottom:-45px;
  font-family:var(--font-display);font-size:12rem;line-height:1;font-weight:900;
  color:rgba(255,255,255,.04);-webkit-text-stroke:1px rgba(255,255,255,.05)}
.story-content-inner{position:relative;z-index:2;max-width:560px}
.story-content h2{font-family:var(--font-display);font-size:clamp(2.2rem,4vw,4rem);line-height:.98;margin:0 0 1rem}
.story-content h2 span{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.story-content p{color:rgba(255,255,255,.76);line-height:1.9;font-size:.92rem}
.story-list{display:grid;grid-template-columns:1fr 1fr;gap:.8rem;margin-top:1.5rem}
.story-chip{padding:.8rem;border:1px solid rgba(255,255,255,.12);border-radius:14px;
  background:rgba(255,255,255,.05);font-size:.74rem;font-weight:800;backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px)}
.story-chip i{color:#ffd54a;margin-right:.4rem}

/* ---------- MOSAIC ---------- */
.mosaic-section{padding:110px 0;background:#fff}
.mosaic-head{width:min(1380px,92%);margin:0 auto 45px}
.mosaic{width:min(1380px,92%);margin:auto;display:grid;grid-template-columns:1.3fr .7fr .7fr;
  grid-template-rows:280px 280px;gap:14px}
.mosaic-card{position:relative;overflow:hidden;border-radius:22px;background:#0d3a66;
  box-shadow:0 18px 44px rgba(13,58,102,.12)}
.mosaic-card.big{grid-row:span 2}
.mosaic-card img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .7s ease}
.mosaic-card:hover img{transform:scale(1.06)}
.mosaic-card::after{content:"";position:absolute;inset:0;
  background:linear-gradient(180deg,transparent 35%,rgba(4,22,40,.88) 100%)}
.mosaic-label{position:absolute;z-index:2;left:1.2rem;right:1.2rem;bottom:1.1rem;color:#fff}
.mosaic-label small{display:block;color:#ffd54a;font-size:.64rem;font-weight:900;
  letter-spacing:.18em;text-transform:uppercase}
.mosaic-label strong{display:block;font-family:var(--font-display);font-size:1.22rem;margin-top:.25rem}

/* ---------- PRESENT / FUTURE (teal deep) ---------- */
.future{padding:110px 0 120px;position:relative;overflow:hidden;
  background:linear-gradient(135deg,#0b3558,#0d3a66 45%,#0d3a66);color:#fff}
.future::before{content:"";position:absolute;width:520px;height:520px;right:-210px;top:-230px;
  border:1px solid rgba(255,255,255,.14);transform:rotate(45deg);
  box-shadow:0 0 0 35px rgba(13,58,102,.08),0 0 0 70px rgba(255,255,255,.03)}
.future::after{content:"VOKASI";position:absolute;left:-1%;bottom:-40px;
  font-family:var(--font-display);font-size:clamp(5rem,16vw,15rem);font-weight:900;line-height:1;
  letter-spacing:.04em;color:rgba(255,255,255,.045);-webkit-text-stroke:1px rgba(255,255,255,.06);
  pointer-events:none;white-space:nowrap;user-select:none}
.future-inner{width:min(1180px,92%);margin:auto;position:relative;z-index:2;text-align:center}
.future .big-heading{color:#fff}
.future .big-heading span{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.future .eyebrow{color:#2f6fa8}
.future-copy{max-width:720px;margin:1rem auto 2rem;color:rgba(235,245,253,.8);line-height:1.8}
.future-points{display:flex;justify-content:center;gap:.8rem;flex-wrap:wrap}
.future-point{padding:.65rem .9rem;border:1px solid rgba(255,255,255,.16);
  background:rgba(255,255,255,.07);border-radius:999px;font-size:.72rem;font-weight:800;
  backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);transition:transform .3s ease,background .3s ease}
.future-point:hover{transform:translateY(-3px);background:rgba(255,255,255,.14)}
.future-point i{color:#ffd54a;margin-right:.35rem}

/* ---------- SCROLL REVEAL ---------- */
[data-reveal]{opacity:0;transform:translateY(36px);
  transition:opacity .85s cubic-bezier(.22,.61,.36,1),transform .85s cubic-bezier(.22,.61,.36,1);
  will-change:opacity,transform}
[data-reveal="left"]{transform:translateX(-46px)}
[data-reveal="right"]{transform:translateX(46px)}
[data-reveal].revealed{opacity:1;transform:none}
[data-reveal]{transition-delay:calc(var(--d,0)*90ms)}

/* ---------- FINAL VISUAL TUNING ---------- */
.history-hero-inner{
  width:100%;
  max-width:none;
  padding-left:clamp(1.5rem,5vw,5.5rem);
  padding-right:clamp(1.5rem,5vw,5.5rem);
}
.history-kicker{
  margin-left:0;
  color:#ffd54a;
  letter-spacing:.18em;
}
.history-title{
  max-width:900px;
  margin-top:0;
}
.hero-photo{
  transform:translateY(-34px) rotate(1.5deg);
}
@media(max-width:950px){
  .hero-photo{transform:translateY(-18px) rotate(1deg)}
}


/* ---------- VISIBLE NAVY ORNAMENTS + UNIVERSAL HOVER ---------- */
.history-page{position:relative}
.history-page::before{content:"";position:fixed;right:-110px;top:18%;width:230px;height:230px;border:2px solid rgba(13,58,102,.14);transform:rotate(45deg);z-index:0;pointer-events:none}
.history-page::after{content:"";position:fixed;left:-95px;bottom:10%;width:190px;height:190px;border:2px solid rgba(47,111,168,.14);border-radius:28px;transform:rotate(25deg);z-index:0;pointer-events:none}
.history-hero,.history-intro,.timeline-section,.story-band,.mosaic-section,.future{position:relative;z-index:1}
.history-hero-inner::before{content:"";position:absolute;left:-28px;top:18%;width:12px;height:180px;border-left:3px solid #ffd54a;border-top:3px solid #ffd54a;opacity:.9}
.history-hero-inner::after{content:"";position:absolute;right:44%;top:8%;width:72px;height:72px;border:2px solid rgba(255,213,74,.55);transform:rotate(45deg);pointer-events:none}
.timeline-section::after{content:"";position:absolute;right:5%;top:9%;width:90px;height:90px;border:3px solid rgba(13,58,102,.12);transform:rotate(45deg);pointer-events:none}
.mosaic-section::before{content:"";position:absolute;left:4%;top:70px;width:46px;height:46px;border-radius:50%;background:radial-gradient(circle,#ffd54a 0 4px,transparent 5px);background-size:15px 15px;opacity:.7}
.story-band::before{content:"";position:absolute;left:50%;top:22px;width:120px;height:4px;background:linear-gradient(90deg,transparent,#ffd54a,transparent);z-index:3;opacity:.8}
.future::before{border-color:rgba(255,255,255,.18)!important}

/* Hover language across all interactive/content blocks */
.history-page .history-kicker,
.history-page .history-pill,
.history-page .eyebrow,
.history-page .stat-box,
.history-page .timeline-card,
.history-page .timeline-marker,
.history-page .story-chip,
.history-page .mosaic-card,
.history-page .future-point,
.history-page .hero-photo,
.history-page .big-heading,
.history-page .history-title{
  transition:transform .35s ease,box-shadow .35s ease,filter .35s ease,border-color .35s ease,background .35s ease;
}
.history-page .history-pill:hover{transform:translateY(-4px);background:rgba(13,58,102,.55);border-color:rgba(255,213,74,.5)}
.history-page .history-kicker:hover{transform:translateX(7px);filter:drop-shadow(0 5px 12px rgba(255,213,74,.2))}
.history-page .eyebrow:hover{transform:translateX(6px)}
.history-page .stat-box:hover{transform:translateY(-9px) rotate(-.5deg);border-color:rgba(13,58,102,.32);box-shadow:0 28px 58px rgba(13,58,102,.18)}
.history-page .timeline-card:hover{transform:translateY(-9px) scale(1.015);border-color:rgba(13,58,102,.22);box-shadow:0 30px 65px rgba(13,58,102,.2)}
.history-page .timeline-card:hover::before{width:8px}
.history-page .timeline-marker:hover{transform:rotate(45deg) scale(1.1);box-shadow:0 16px 35px rgba(13,58,102,.38)}
.history-page .hero-photo:hover{transform:translateY(-42px) rotate(0deg) scale(1.015);box-shadow:0 45px 95px rgba(13,58,102,.35),0 18px 35px rgba(0,0,0,.22)}
.history-page .hero-photo:hover img{transform:scale(1.07)}
.history-page .story-chip:hover{transform:translateY(-5px);border-color:rgba(255,213,74,.4);background:rgba(255,255,255,.11)}
.history-page .mosaic-card:hover{transform:translateY(-7px);box-shadow:0 28px 58px rgba(13,58,102,.22)}
.history-page .future-point:hover{transform:translateY(-5px) scale(1.02);box-shadow:0 10px 24px rgba(13,58,102,.12)}
.history-page .big-heading:hover{transform:translateX(4px)}
@media(max-width:700px){
 .history-hero-inner::before{left:0;top:14%;height:110px}
 .history-hero-inner::after{right:5%;top:4%;width:48px;height:48px}
 .history-page::before,.history-page::after{opacity:.45}
}


/* =========================================================
   ORNAMEN STYLE BERANDA — GEOMETRIC, BESAR, TERLIHAT
   ========================================================= */
.history-page{overflow:hidden}
.home-orn{
  position:absolute;inset:0;z-index:0;pointer-events:none;overflow:hidden;
}
.home-orn .ho-chevron{
  position:absolute;width:360px;height:360px;
  border-top:2px solid rgba(13,58,102,.11);
  border-right:2px solid rgba(13,58,102,.11);
  transform:rotate(45deg);
}
.home-orn .ho-chevron::after{
  content:"";position:absolute;inset:34px;
  border-top:2px solid rgba(47,111,168,.09);
  border-right:2px solid rgba(47,111,168,.09);
}
.home-orn .ho-line{
  position:absolute;width:310px;height:2px;
  background:linear-gradient(90deg,transparent,#2f6fa8,transparent);
  opacity:.25;transform:rotate(-42deg);
}
.home-orn .ho-line::after{
  content:"";position:absolute;left:70px;top:11px;width:190px;height:1px;
  background:linear-gradient(90deg,transparent,#ffd54a,transparent);
}
.home-orn .ho-dots{
  position:absolute;width:125px;height:125px;
  background-image:radial-gradient(circle,#2f6fa8 2px,transparent 2.8px);
  background-size:18px 18px;opacity:.38;
}
.home-orn .ho-ring{
  position:absolute;width:170px;height:170px;border:1px solid rgba(13,58,102,.13);
  border-radius:50%;box-shadow:0 0 0 20px rgba(13,58,102,.025),0 0 0 42px rgba(255,213,74,.025);
}
.home-orn .ho-ring::before{
  content:"";position:absolute;inset:22px;border:1px dashed rgba(47,111,168,.18);border-radius:50%;
}
.home-orn .ho-gold{
  position:absolute;width:52px;height:8px;border-radius:99px;
  background:linear-gradient(90deg,#ffd54a,#ffb300,#ff7a00);
  box-shadow:0 8px 22px rgba(255,179,0,.18);
  transform:rotate(-35deg);
}
.home-orn .ho-square{
  position:absolute;width:58px;height:58px;border:2px solid rgba(255,179,0,.32);
  transform:rotate(45deg);
}
.home-orn .ho-square::before{
  content:"";position:absolute;inset:10px;border:1px solid rgba(13,58,102,.18);
}
.home-orn .ho-corner{
  position:absolute;width:110px;height:110px;
  border-left:3px solid rgba(13,58,102,.12);
  border-bottom:3px solid rgba(13,58,102,.12);
}
.home-orn .ho-corner::after{
  content:"";position:absolute;left:18px;bottom:18px;width:46px;height:3px;
  background:#ffd54a;border-radius:99px;transform:rotate(0deg);
}

/* Posisi tiap bagian dibuat seperti bahasa visual Beranda, tetapi berbeda */
.history-intro .home-orn .ho-chevron{right:-130px;top:70px}
.history-intro .home-orn .ho-line{left:-55px;bottom:75px}
.history-intro .home-orn .ho-dots{right:18%;bottom:55px}
.history-intro .home-orn .ho-ring{left:-80px;top:35%}
.history-intro .home-orn .ho-gold{right:12%;top:26%}
.history-intro .home-orn .ho-square{left:13%;bottom:18%}

.timeline-section .home-orn .ho-chevron{right:-145px;top:45px}
.timeline-section .home-orn .ho-line{left:-80px;top:170px}
.timeline-section .home-orn .ho-dots{left:3%;bottom:100px}
.timeline-section .home-orn .ho-ring{right:8%;bottom:90px}
.timeline-section .home-orn .ho-gold{right:16%;top:22%}
.timeline-section .home-orn .ho-square{left:11%;top:15%}
.timeline-section .home-orn .ho-corner{right:3%;bottom:8%;transform:rotate(180deg)}

.story-band .home-orn .ho-chevron{left:-150px;top:35px;border-color:rgba(255,255,255,.10)}
.story-band .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.09)}
.story-band .home-orn .ho-line{right:-80px;bottom:95px}
.story-band .home-orn .ho-dots{right:6%;top:90px;opacity:.25}
.story-band .home-orn .ho-ring{left:43%;bottom:-90px;border-color:rgba(255,255,255,.12)}
.story-band .home-orn .ho-gold{right:14%;top:28%}

.mosaic-section .home-orn .ho-chevron{right:-150px;top:20px}
.mosaic-section .home-orn .ho-line{left:-80px;bottom:100px}
.mosaic-section .home-orn .ho-dots{left:4%;top:125px}
.mosaic-section .home-orn .ho-ring{right:3%;bottom:70px}
.mosaic-section .home-orn .ho-gold{left:10%;top:24%}
.mosaic-section .home-orn .ho-square{right:15%;top:20%}

.future .home-orn .ho-chevron{right:-125px;top:-100px;border-color:rgba(255,255,255,.12)}
.future .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.future .home-orn .ho-line{left:-80px;bottom:80px;opacity:.22}
.future .home-orn .ho-dots{right:7%;bottom:80px;opacity:.2}
.future .home-orn .ho-ring{left:-80px;top:25%;border-color:rgba(255,255,255,.10)}
.future .home-orn .ho-gold{right:22%;bottom:18%}

/* KEPALA SEKOLAH: lebih premium dan jelas */
.future:first-of-type .home-orn .ho-chevron{right:-100px;top:30px}
.future:first-of-type .home-orn .ho-ring{left:-65px;bottom:-35px}
.future:first-of-type .home-orn .ho-dots{right:8%;top:35%}
.future:first-of-type .home-orn .ho-square{left:14%;top:18%}
.future:first-of-type .home-orn .ho-gold{right:18%;top:20%}

/* Bab-bab: ornamen ekstra di judul dan garis timeline */
.timeline-section .timeline-head{position:relative}
.timeline-section .timeline-head::before{
  content:"";position:absolute;left:-32px;top:-12px;width:26px;height:26px;
  border-left:3px solid #ffd54a;border-top:3px solid #ffd54a;
}
.timeline-section .timeline-head::after{
  content:"";position:absolute;right:30%;top:0;width:10px;height:10px;
  background:#ffd54a;border-radius:50%;box-shadow:18px 10px 0 rgba(47,111,168,.35),36px 0 0 rgba(47,111,168,.18);
}
.timeline-section .timeline-card{
  position:relative;overflow:visible;
}
.timeline-section .timeline-card::after{
  content:"";position:absolute;right:-8px;bottom:-8px;width:36px;height:36px;
  border-right:2px solid rgba(47,111,168,.20);
  border-bottom:2px solid rgba(47,111,168,.20);
}
.timeline-section .timeline-marker{
  position:relative;
}
.timeline-section .timeline-marker::after{
  content:"";position:absolute;inset:-9px;border:1px solid rgba(255,179,0,.30);
  border-radius:50%;transform:rotate(-12deg);
}

/* Jangan mengganggu konten */
.history-intro>*:not(.home-orn),
.timeline-section>*:not(.home-orn),
.story-band>*:not(.home-orn),
.mosaic-section>*:not(.home-orn),
.future>*:not(.home-orn){position:relative;z-index:2}

@media(max-width:700px){
  .home-orn .ho-chevron{width:220px;height:220px}
  .home-orn .ho-dots{width:80px;height:80px;background-size:14px 14px}
  .home-orn .ho-ring{width:110px;height:110px}
  .home-orn .ho-line{width:190px}
  .home-orn .ho-square{width:42px;height:42px}
  .home-orn .ho-corner{width:70px;height:70px}
  .timeline-section .timeline-head::before{left:0}
}


/* =========================================================
   BAB-BAB — ORNAMEN PENUH SEPERTI BERANDA/JURUSAN
   Mengisi ruang kosong kiri-kanan timeline
   ========================================================= */
.timeline-section{
  overflow:hidden;
  isolation:isolate;
  background:
    radial-gradient(circle at 8% 18%,rgba(47,111,168,.12) 0 2px,transparent 3px),
    radial-gradient(circle at 91% 27%,rgba(255,179,0,.16) 0 3px,transparent 4px),
    radial-gradient(circle at 13% 78%,rgba(47,111,168,.10) 0 2px,transparent 3px),
    linear-gradient(180deg,#f8fbfe 0%,#eef5fa 100%);
}
/* pola titik besar kiri */
.timeline-section::after{
  content:"";
  position:absolute;
  left:-35px;
  top:180px;
  width:185px;height:185px;
  background-image:radial-gradient(circle,rgba(31,100,170,.45) 2.2px,transparent 3px);
  background-size:20px 20px;
  opacity:.65;
  pointer-events:none;
  z-index:0;
}
/* pola titik kanan bawah */
.timeline-section::before{
  content:"";
  position:absolute;
  right:-20px;
  bottom:90px;
  width:175px;height:175px;
  background-image:radial-gradient(circle,rgba(255,179,0,.55) 2px,transparent 3px);
  background-size:19px 19px;
  opacity:.5;
  pointer-events:none;
  z-index:0;
}

/* dua lingkaran raksasa yang sengaja ditempatkan di area kosong */
.timeline{
  position:relative;
}
.timeline::after{
  content:"";
  position:absolute;
  right:-150px;
  top:50px;
  width:360px;height:360px;
  border:2px solid rgba(47,111,168,.15);
  border-radius:50%;
  box-shadow:
    0 0 0 24px rgba(47,111,168,.035),
    0 0 0 52px rgba(47,111,168,.025),
    0 0 0 82px rgba(255,179,0,.018);
  pointer-events:none;
  z-index:0;
}
.timeline::after{
  /* keep the large ring visible behind cards */
}

/* garis diagonal ala beranda */
.timeline-head::after{
  content:"";
  position:absolute;
  width:430px;height:3px;
  right:-80px;top:72px;
  background:linear-gradient(90deg,transparent,rgba(47,111,168,.22),rgba(255,179,0,.35),transparent);
  transform:rotate(-35deg);
  box-shadow:0 18px 0 rgba(47,111,168,.07),0 36px 0 rgba(47,111,168,.045);
  pointer-events:none;
}
/* dekorasi diagonal kiri */
.timeline-head::before{
  content:"";
  position:absolute;
  left:-40px;top:-20px;
  width:100px;height:100px;
  border-left:5px solid rgba(47,111,168,.16);
  border-bottom:5px solid rgba(47,111,168,.16);
  transform:rotate(45deg);
  box-shadow:12px 12px 0 rgba(255,179,0,.10);
  pointer-events:none;
}

/* titik-titik kecil menyebar di tiap ruang */
.timeline-item::after{
  content:"";
  position:absolute;
  width:7px;height:7px;border-radius:50%;
  background:#ffb300;
  box-shadow:
    24px 18px 0 rgba(47,111,168,.50),
    48px -4px 0 rgba(47,111,168,.28),
    72px 22px 0 rgba(255,179,0,.40);
  opacity:.8;
  z-index:0;
}
.timeline-item.left::after{left:8px;top:100px}
.timeline-item.right::after{right:8px;top:100px}

/* chevron raksasa di sisi kiri */
.timeline-item.left:nth-child(odd)::before,
.timeline-item.right:nth-child(even)::before{
  content:"";
  position:absolute;
  width:170px;height:170px;
  border-left:16px solid rgba(47,111,168,.065);
  border-bottom:16px solid rgba(47,111,168,.065);
  transform:rotate(45deg);
  pointer-events:none;
  z-index:0;
}
.timeline-item.left:nth-child(odd)::before{left:-125px;top:30px}
.timeline-item.right:nth-child(even)::before{right:-125px;top:25px}

/* aksen slashes warna gold di dekat card */
.timeline-item:nth-child(1) .timeline-card::after,
.timeline-item:nth-child(3) .timeline-card::after,
.timeline-item:nth-child(5) .timeline-card::after{
  content:"";
  position:absolute;
  right:24px;bottom:18px;
  width:64px;height:28px;
  background:
    linear-gradient(110deg,transparent 0 25%,#ffb300 26% 30%,transparent 31% 55%,#2f6fa8 56% 60%,transparent 61%);
  opacity:.55;
  pointer-events:none;
}
.timeline-item:nth-child(2) .timeline-card::after,
.timeline-item:nth-child(4) .timeline-card::after,
.timeline-item:nth-child(6) .timeline-card::after{
  content:"";
  position:absolute;
  left:24px;bottom:18px;
  width:64px;height:28px;
  background:
    linear-gradient(110deg,transparent 0 25%,#2f6fa8 26% 30%,transparent 31% 55%,#ffb300 56% 60%,transparent 61%);
  opacity:.55;
  pointer-events:none;
}

/* node timeline lebih dekoratif */
.timeline-marker{
  box-shadow:
    0 12px 28px rgba(13,58,102,.3),
    0 0 0 9px rgba(47,111,168,.08),
    0 0 0 16px rgba(255,179,0,.035);
}
.timeline-marker::after{
  content:"";
  position:absolute;
  inset:-12px;
  border:1px dashed rgba(255,179,0,.45);
  border-radius:50%;
  transform:rotate(-20deg);
}

/* ornamen kecil di header judul */
.timeline-head .eyebrow{
  position:relative;
  display:inline-flex;
  align-items:center;
  gap:10px;
}
.timeline-head .eyebrow::before{
  content:"";
  width:42px;height:3px;
  border-radius:99px;
  background:linear-gradient(90deg,#0d3a66,#ffb300);
}
.timeline-head .eyebrow::after{
  content:"• • •";
  color:#ffb300;
  letter-spacing:5px;
  font-size:12px;
}

/* supaya ornamen berada di belakang konten, tapi tetap terlihat */
.timeline-section > .timeline-head,
.timeline-section > .timeline{
  position:relative;
  z-index:2;
}

/* tambahan untuk layar lebar */
@media(min-width:1100px){
  .timeline-item.left::after{left:-18px}
  .timeline-item.right::after{right:-18px}
}

/* mobile: tetap ramai tapi tidak menutupi card */
@media(max-width:700px){
  .timeline-section::after{width:105px;height:105px;left:-45px;top:190px}
  .timeline-section::before{width:105px;height:105px;right:-45px;bottom:70px}
  .timeline::after{width:190px;height:190px;right:-120px}
  .timeline-head::after{width:220px;right:-100px}
  .timeline-item.left:nth-child(odd)::before,
  .timeline-item.right:nth-child(even)::before{width:110px;height:110px}
}

/* ---------- RESPONSIVE ---------- */
@media(max-width:950px){
  .history-hero-inner{grid-template-columns:1fr;gap:2rem}
  .hero-photo{height:360px}
  .intro-grid{grid-template-columns:1fr;gap:2.5rem}
  .timeline-head{display:block}
  .timeline-note{text-align:left;margin-top:1rem}
  .story-band{grid-template-columns:1fr}
  .story-image{min-height:360px}
  .story-image::after{background:linear-gradient(180deg,transparent 35%,#082744 100%)}
  .story-content{padding:55px 7% 70px}
  .mosaic{grid-template-columns:1fr 1fr;grid-template-rows:260px 260px}
  .mosaic-card.big{grid-row:auto;grid-column:span 2}
}
@media(max-width:700px){
  .history-hero{min-height:0;align-items:flex-start}
  .history-hero-inner{padding:clamp(3rem,8vh,4.5rem) 0 3.6rem;width:90%}
  .history-hero::after{font-size:clamp(4.5rem,26vw,7rem);opacity:.6}
  .history-title{font-size:clamp(2.5rem,12vw,4rem);margin-top:0}
  .hero-photo{height:300px}
  .stat-strip{grid-template-columns:1fr 1fr}
  .timeline{width:90%}
  .timeline::before{left:18px;transform:none}
  .timeline-item,.timeline-item.left,.timeline-item.right{width:100%;left:0;text-align:left;
    padding:0 0 42px 58px}
  .timeline-item.left .timeline-marker,.timeline-item.right .timeline-marker{left:-10px;right:auto;
    width:46px;height:46px}
  .timeline-card{padding:1.3rem 1.2rem}
  .timeline-year{font-size:1.8rem}
  .story-image{min-height:280px}
  .story-content{padding:45px 7% 60px}
  .story-list{grid-template-columns:1fr}
  .mosaic{grid-template-columns:1fr;grid-template-rows:230px 230px 230px}
  .mosaic-card.big{grid-column:auto}
  .future{padding:85px 0 90px}
  [data-reveal]{opacity:1;transform:none}
}
/* =========================================================
   KEPEMIMPINAN — KEPALA SEKOLAH DARI MASA KE MASA
   Slider kartu + ornamen navy/gold penuh (gaya Beranda)
   ========================================================= */
.principal-section{
  position:relative;overflow:hidden;padding:110px 0 130px;isolation:isolate;
  background:
    radial-gradient(circle at 6% 22%,rgba(13,58,102,.10) 0 2px,transparent 3px),
    radial-gradient(circle at 93% 30%,rgba(255,179,0,.14) 0 3px,transparent 4px),
    radial-gradient(circle at 10% 82%,rgba(47,111,168,.10) 0 2px,transparent 3px),
    linear-gradient(180deg,#ffffff 0%,#f2f7fb 55%,#eaf1f8 100%);
  z-index:1;
}
.principal-section::before{content:"";position:absolute;left:-70px;bottom:110px;width:260px;height:260px;
  background-image:radial-gradient(circle,rgba(13,58,102,.28) 2px,transparent 3px);
  background-size:22px 22px;opacity:.45;pointer-events:none;z-index:0}
.principal-section::after{content:"";position:absolute;right:-60px;top:120px;width:240px;height:240px;
  background-image:radial-gradient(circle,rgba(255,179,0,.38) 2px,transparent 3px);
  background-size:20px 20px;opacity:.4;pointer-events:none;z-index:0}

/* ornamen besar kiri-kanan section (gaya Beranda) */
.principal-section .home-orn .ho-chevron{left:-150px;top:40px;width:400px;height:400px}
.principal-section .home-orn .ho-chevron::after{inset:44px}
.principal-section .home-orn .ho-ring{right:-95px;top:22%;width:230px;height:230px}
.principal-section .home-orn .ho-ring::before{inset:30px}
.principal-section .home-orn .ho-dots{right:8%;bottom:60px;width:150px;height:150px;opacity:.5}
.principal-section .home-orn .ho-line{left:-70px;bottom:120px;width:340px;transform:rotate(-42deg)}
.principal-section .home-orn .ho-gold{left:16%;top:24%}
.principal-section .home-orn .ho-square{right:17%;top:30%}
.principal-section .home-orn .ho-corner{left:4%;bottom:8%;transform:rotate(180deg);width:130px;height:130px}
.principal-section .home-orn .ho-corner::after{background:#ffd54a}

/* heading + deskripsi */
.principal-head{width:min(1180px,92%);margin:0 auto 3.4rem;text-align:center;position:relative;z-index:2}
.principal-head .eyebrow{justify-content:center}
.principal-head .eyebrow::after{content:"\2022 \2022 \2022";color:#ffb300;letter-spacing:5px;font-size:12px;margin-left:.4rem}
.principal-head .big-heading{margin:0 auto}
.principal-desc{max-width:720px;margin:1.1rem auto 0;color:#5f7186;font-size:1rem;line-height:1.9}

/* layout slider */
.principal-slider{position:relative;z-index:2;width:min(1240px,94%);margin:0 auto;display:flex;align-items:center;gap:1.1rem}
.principal-viewport{flex:1;min-width:0;overflow:hidden}
.principal-track{display:flex;gap:1.4rem;transition:transform .62s cubic-bezier(.22,.61,.36,1);will-change:transform}
.principal-card{
  flex:0 0 300px;background:#fff;border:1px solid rgba(13,58,102,.14);border-radius:24px;overflow:hidden;
  box-shadow:0 18px 42px rgba(13,58,102,.12),0 4px 12px rgba(13,58,102,.06);
  transition:transform .45s cubic-bezier(.22,.61,.36,1),box-shadow .45s ease,border-color .3s ease}
.principal-card:hover{transform:translateY(-9px);box-shadow:0 30px 66px rgba(13,58,102,.2),0 10px 22px rgba(13,58,102,.1);border-color:rgba(255,179,0,.45)}

/* foto */
.principal-photo{position:relative;height:252px;overflow:hidden;background:linear-gradient(160deg,#eef5fb,#dce9f4)}
.principal-photo img{width:100%;height:100%;object-fit:cover;object-position:top center;display:block;transition:transform .6s ease}
.principal-card:hover .principal-photo img{transform:scale(1.05)}
.principal-photo::after{content:"";position:absolute;inset:0;
  background:linear-gradient(180deg,transparent 55%,rgba(7,28,52,.32) 100%)}
.principal-orn-diamond{position:absolute;left:1rem;top:1rem;width:22px;height:22px;z-index:2;
  border:2px solid rgba(255,213,74,.85);transform:rotate(45deg);border-radius:4px}
.principal-now{position:absolute;z-index:3;top:1rem;right:1rem;display:inline-flex;align-items:center;gap:.35rem;
  padding:.42rem .8rem;border-radius:999px;font-size:.7rem;font-weight:900;letter-spacing:.06em;text-transform:uppercase;
  color:#fff;background:linear-gradient(135deg,#ffd54a,#ff8a00);
  box-shadow:0 8px 20px rgba(255,138,0,.4)}
.principal-now::before{content:"";width:7px;height:7px;border-radius:50%;background:#0d3a66;animation:prinPulse 1.6s infinite}
@keyframes prinPulse{0%,100%{box-shadow:0 0 0 0 rgba(13,58,102,.45)}50%{box-shadow:0 0 0 6px rgba(13,58,102,0)}}

/* body kartu */
.principal-body{padding:1.35rem 1.4rem 1.5rem;border-top:4px solid;position:relative;
  background:linear-gradient(180deg,#fff, #fbfdff);
  border-image:linear-gradient(90deg,#0d3a66,#2f6fa8,#ffb300) 1}
.principal-badge{display:inline-block;font-size:.66rem;font-weight:800;letter-spacing:.16em;text-transform:uppercase;
  color:#2f6fa8;background:rgba(47,111,168,.10);border:1px solid rgba(47,111,168,.18);
  padding:.28rem .6rem;border-radius:999px;margin-bottom:.6rem}
.principal-name{font-family:var(--font-display);font-size:1.22rem;font-weight:800;color:#0d3a66;line-height:1.25;margin:0}
.principal-period{display:inline-flex;align-items:center;gap:.45rem;margin-top:.55rem;font-size:.9rem;font-weight:800;color:#ff8a00}
.principal-period::before{content:"";width:26px;height:2px;background:linear-gradient(90deg,#ffd54a,#ff8a00);border-radius:99px}

/* tombol panah */
.principal-arrow{
  flex:0 0 52px;width:52px;height:52px;border-radius:50%;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,#17204f,#0d3a66);color:#fff;font-size:1.05rem;
  box-shadow:0 12px 28px rgba(13,58,102,.32);transition:transform .3s ease,box-shadow .3s ease,background .3s ease}
.principal-arrow:hover{transform:translateY(-3px) scale(1.05);box-shadow:0 18px 38px rgba(13,58,102,.4);background:linear-gradient(135deg,#ffb300,#ff8a00)}
.principal-arrow:active{transform:scale(.95)}
.principal-arrow:disabled{opacity:.4;cursor:default;transform:none}

/* dots */
.principal-dots{display:flex;justify-content:center;gap:.55rem;margin-top:2rem;position:relative;z-index:2}
.principal-dots button{width:10px;height:10px;border-radius:99px;border:none;cursor:pointer;padding:0;
  background:rgba(13,58,102,.25);transition:all .35s ease}
.principal-dots button.is-active{width:30px;background:linear-gradient(90deg,#ffd54a,#ff8a00)}

/* ornamen belakang konten */
.principal-section > .principal-head,
.principal-section > .principal-slider,
.principal-section > .principal-dots{position:relative;z-index:2}
.principal-section > *:not(.home-orn){position:relative;z-index:2}

/* responsive */
@media(max-width:950px){
  .principal-track{gap:1rem}
  .principal-card{flex-basis:280px}
  .principal-photo{height:230px}
}
@media(max-width:700px){
  .principal-section{padding:85px 0 95px}
  .principal-head{margin-bottom:2.4rem}
  .principal-slider{width:100%;gap:.4rem}
  .principal-arrow{flex-basis:42px;width:42px;height:42px;font-size:.9rem}
  .principal-card{flex-basis:74vw;max-width:300px}
  .principal-photo{height:218px}
  .principal-section::before{width:150px;height:150px;left:-45px;bottom:70px}
  .principal-section::after{width:140px;height:140px;right:-45px;top:150px}
  .principal-section .home-orn .ho-chevron{width:260px;height:260px;left:-110px;top:30px}
  .principal-section .home-orn .ho-ring{width:150px;height:150px;right:-60px}
  .principal-section .home-orn .ho-dots{width:90px;height:90px;background-size:14px 14px}
}
</style>
@endpush

@section('content')
<div class="history-page">
  <!-- HERO -->
  <section class="history-hero">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="history-hero-inner">
      <div>
        <div class="history-kicker">Jejak Perjalanan</div>
        <h1 class="history-title">
          <span class="sejarah-white">SEJARAH</span>
          <span class="skaneda-gold">SKANEDA</span>
        </h1>
      </div>
      <div class="hero-photo" data-reveal="right">
        <img src="{{ asset('images/smkn-guru.jpg') }}" alt="Guru dan staf SMK Negeri 2 Mojokerto" loading="eager">
        <div class="hero-photo-caption"><strong>Orang-orang di balik perjalanan</strong><span>Guru, tenaga kependidikan, dan keluarga besar SMKN 2 Mojokerto.</span></div>
      </div>
    </div>
  </section>

  <!-- INTRO -->
  <section class="history-intro">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="history-wide intro-grid">
      <div data-reveal>
        <div class="eyebrow">Dari masa ke masa</div>
        <h2 class="big-heading">1968 → <span>hari ini.</span></h2>
        <p class="intro-copy">Berdiri sejak 1968, SMK Negeri 2 Mojokerto terus berkembang untuk menyiapkan generasi vokasi yang kompeten, berkarakter, dan siap menghadapi dunia kerja maupun pendidikan lanjutan. Perjalanan itu hadir dalam perubahan fasilitas, program keahlian, kemitraan industri, digitalisasi, hingga prestasi siswa.</p>
      </div>
      <div class="stat-strip" data-reveal="right">
        <div class="stat-box"><div class="stat-num gold">1968</div><div class="stat-label">Tahun berdiri</div></div>
        <div class="stat-box"><div class="stat-num">A</div><div class="stat-label">Akreditasi</div></div>
        <div class="stat-box"><div class="stat-num gold">1200+</div><div class="stat-label">Siswa aktif</div></div>
        <div class="stat-box"><div class="stat-num">80+</div><div class="stat-label">Pendidik & tenaga kependidikan</div></div>
      </div>
    </div>
  </section>

  <!-- TIMELINE -->
  <section class="timeline-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="timeline-head" data-reveal>
      <div><div class="eyebrow">The timeline</div><h2 class="big-heading">Bab-bab yang <span>membentuk kami.</span></h2></div>
      <div class="timeline-note">Geser ke bawah untuk mengikuti jejak dari fondasi sekolah, transformasi modern, sampai target menjadi sekolah vokasi rujukan.</div>
    </div>
    <div class="timeline">
      <article class="timeline-item left" data-reveal><div class="timeline-marker"><i class="fas fa-flag"></i></div><div class="timeline-card"><div class="timeline-year">1968</div><div class="timeline-title">Awal Berdiri</div><p class="timeline-text">SMK Negeri 2 Mojokerto resmi berdiri dan membuka pendidikan kejuruan pertama bagi masyarakat Kota Mojokerto.</p><span class="timeline-tag">Fondasi</span></div></article>
      <article class="timeline-item right" data-reveal style="--d:1"><div class="timeline-marker"><i class="fas fa-school"></i></div><div class="timeline-card"><div class="timeline-year">2020—2022</div><div class="timeline-title">Fondasi Sekolah Modern</div><p class="timeline-text">Renovasi laboratorium dan fasilitas belajar berjalan beriringan dengan penguatan kemitraan dunia usaha dan industri (DUDI).</p><span class="timeline-tag">Pengembangan</span></div></article>
      <article class="timeline-item left" data-reveal style="--d:2"><div class="timeline-marker"><i class="fas fa-laptop-code"></i></div><div class="timeline-card"><div class="timeline-year">2023</div><div class="timeline-title">Digitalisasi & Akreditasi A</div><p class="timeline-text">Sekolah memasuki fase digital dengan penguatan perpustakaan dan program sertifikasi, sekaligus meraih Akreditasi A.</p><span class="timeline-tag">Transformasi</span></div></article>
      <article class="timeline-item right" data-reveal style="--d:3"><div class="timeline-marker"><i class="fas fa-trophy"></i></div><div class="timeline-card"><div class="timeline-year">2024</div><div class="timeline-title">Prestasi LKS Provinsi</div><p class="timeline-text">Siswa Rekayasa Perangkat Lunak meraih Juara 1 LKS tingkat Provinsi Jawa Timur kategori Web Technologies.</p><span class="timeline-tag">Prestasi</span></div></article>
      <article class="timeline-item left" data-reveal style="--d:4"><div class="timeline-marker"><i class="fas fa-gears"></i></div><div class="timeline-card"><div class="timeline-year">2025</div><div class="timeline-title">Transformasi Vokasi</div><p class="timeline-text">Pembelajaran berbasis industri diperkuat, layanan digital sekolah berkembang, dan program keahlian terus diselaraskan dengan kebutuhan pasar kerja.</p><span class="timeline-tag">Vokasi 4.0</span></div></article>
      <article class="timeline-item right" data-reveal style="--d:5"><div class="timeline-marker"><i class="fas fa-star"></i></div><div class="timeline-card"><div class="timeline-year">2028 · Target</div><div class="timeline-title">Sekolah Vokasi Rujukan Nasional</div><p class="timeline-text">Menjadi sekolah menengah kejuruan rujukan dengan lulusan yang beriman, berkarakter, kompeten, dan mampu bersaing secara internasional.</p><span class="timeline-tag">Next chapter</span></div></article>
    </div>
  </section>

  <!-- VISUAL STORY -->
  <section class="story-band">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="story-image" data-reveal="left"><img src="{{ asset('images/smkn-guru.jpg') }}" alt="Keluarga besar SMKN 2 Mojokerto" loading="lazy"></div>
    <div class="story-content" data-reveal="right"><div class="story-content-inner"><div class="eyebrow">Yang tidak berubah</div><h2>Manusianya.<br><span>Semangatnya.</span></h2><p>Teknologi dan fasilitas boleh berubah. Program keahlian terus berkembang. Namun inti perjalanan sekolah tetap sama: membentuk siswa yang siap berkarya, berkarakter, dan punya keberanian untuk melangkah lebih jauh.</p><div class="story-list"><div class="story-chip"><i class="fas fa-check"></i> Berkarakter</div><div class="story-chip"><i class="fas fa-check"></i> Kompeten</div><div class="story-chip"><i class="fas fa-check"></i> Adaptif</div><div class="story-chip"><i class="fas fa-check"></i> Berdaya saing</div></div></div></div>
  </section>

  <!-- MOSAIC -->
  <section class="mosaic-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="mosaic-head" data-reveal><div class="eyebrow">Wajah vokasi hari ini</div><h2 class="big-heading">Dari sejarah, lahir <span>karya baru.</span></h2></div>
    <div class="mosaic">
      <div class="mosaic-card big" data-reveal><img src="{{ asset('images/aphp.png') }}" alt="Siswa program APHP" loading="lazy"><div class="mosaic-label"><small>Program keahlian</small><strong>APHP · Agribisnis Pengolahan Hasil Pertanian</strong></div></div>
      <div class="mosaic-card" data-reveal style="--d:1"><img src="{{ asset('images/dkv.png') }}" alt="Siswa program DKV" loading="lazy"><div class="mosaic-label"><small>Kreatif</small><strong>Desain Komunikasi Visual</strong></div></div>
      <div class="mosaic-card" data-reveal style="--d:2"><img src="{{ asset('images/kuliner.png') }}" alt="Siswa program Kuliner" loading="lazy"><div class="mosaic-label"><small>Industri kreatif</small><strong>Kuliner</strong></div></div>
      <div class="mosaic-card" data-reveal style="--d:3"><img src="{{ asset('images/rpl.png') }}" alt="Siswa program RPL" loading="lazy"><div class="mosaic-label"><small>Teknologi</small><strong>Rekayasa Perangkat Lunak</strong></div></div>
      <div class="mosaic-card" data-reveal style="--d:4"><img src="{{ asset('images/lps.png') }}" alt="Siswa program LPS" loading="lazy"><div class="mosaic-label"><small>Ekonomi</small><strong>Layanan Perbankan Syariah</strong></div></div>
    </div>
  </section>

  <!-- KEPEMIMPINAN: Kepala Sekolah dari Masa ke Masa -->
  <section class="principal-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="principal-head" data-reveal>
      <div>
        <div class="eyebrow">Kepemimpinan</div>
        <h2 class="big-heading">
    Kepala Sekolah<br>
    <span>dari Masa ke Masa</span>
</h2> 

    <div class="principal-slider" id="principalSlider">
      <button class="principal-arrow principal-prev" type="button" aria-label="Kepala sekolah sebelumnya">
        <i class="fas fa-chevron-left"></i>
      </button>

      <div class="principal-viewport">
        <div class="principal-track" id="principalTrack">
          <article class="principal-card" data-principal>
            <div class="principal-photo">
              <img src="{{ asset('images/kepsek-nobg.png') }}" alt="Kepala Sekolah 1" loading="lazy">
              <span class="principal-orn-diamond" aria-hidden="true"></span>
            </div>
            <div class="principal-body">
              <span class="principal-badge">Periode</span>
              <h3 class="principal-name">Kepala Sekolah 1</h3>
              <div class="principal-period">1968 &ndash; 1985</div>
            </div>
          </article>

          <article class="principal-card" data-principal>
            <div class="principal-photo">
              <img src="{{ asset('images/kepsek-nobg.png') }}" alt="Kepala Sekolah 2" loading="lazy">
              <span class="principal-orn-diamond" aria-hidden="true"></span>
            </div>
            <div class="principal-body">
              <span class="principal-badge">Periode</span>
              <h3 class="principal-name">Kepala Sekolah 2</h3>
              <div class="principal-period">1985 &ndash; 2000</div>
            </div>
          </article>

          <article class="principal-card" data-principal>
            <div class="principal-photo">
              <img src="{{ asset('images/kepsek-nobg.png') }}" alt="Kepala Sekolah 3" loading="lazy">
              <span class="principal-orn-diamond" aria-hidden="true"></span>
            </div>
            <div class="principal-body">
              <span class="principal-badge">Periode</span>
              <h3 class="principal-name">Kepala Sekolah 3</h3>
              <div class="principal-period">2000 &ndash; 2015</div>
            </div>
          </article>

          <article class="principal-card" data-principal data-current>
            <div class="principal-photo">
              <img src="{{ asset('images/kepsek-nobg.png') }}" alt="Iswahyudi, S.ST. M.Pd" loading="lazy">
              <span class="principal-orn-diamond" aria-hidden="true"></span>
              <span class="principal-now">Saat Ini</span>
            </div>
            <div class="principal-body">
              <span class="principal-badge">Periode</span>
              <h3 class="principal-name">Iswahyudi, S.ST. M.Pd</h3>
              <div class="principal-period">2015 &ndash; Sekarang</div>
            </div>
          </article>
        </div>
      </div>

      <button class="principal-arrow principal-next" type="button" aria-label="Kepala sekolah berikutnya">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>

    <div class="principal-dots" id="principalDots" role="tablist" aria-label="Navigasi kepala sekolah"></div>
  </section>
</div>
@endsection

@push('scripts')
<script>
  /* ---- Slider Kepala Sekolah ---- */
  (function () {
    var slider = document.getElementById('principalSlider');
    if (!slider) return;
    var track = document.getElementById('principalTrack');
    var cards = track.querySelectorAll('.principal-card');
    var dotsWrap = document.getElementById('principalDots');
    var prevBtn = slider.querySelector('.principal-prev');
    var nextBtn = slider.querySelector('.principal-next');
    var idx = 0, n = cards.length, locked = false;

    /* build dots */
    for (var i = 0; i < n; i++) {
      var b = document.createElement('button');
      b.type = 'button';
      b.setAttribute('aria-label', 'Ke kepala sekolah ' + (i + 1));
      (function (k) {
        b.addEventListener('click', function () { go(k); });
      })(i);
      dotsWrap.appendChild(b);
    }
    var dots = dotsWrap.querySelectorAll('button');

    function update() {
      var wrap = track.parentElement;
      var cw = cards[0].getBoundingClientRect().width;
      var gap = parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap) || 0;
      var visible = Math.max(1, Math.round(wrap.clientWidth / (cw + gap)));
      var maxShift = Math.max(0, n - visible);
      var offset = Math.min(idx, maxShift) * (cw + gap);
      track.style.transform = 'translateX(' + (-offset) + 'px)';
      dots.forEach(function (d, k) {
        d.classList.toggle('is-active', k === idx);
        d.setAttribute('aria-selected', k === idx ? 'true' : 'false');
      });
      prevBtn.disabled = idx <= 0;
      nextBtn.disabled = idx >= maxShift;
    }

    function go(k) {
      if (locked) return;
      idx = Math.max(0, Math.min(n - 1, k));
      update();
    }
    function step(dir) {
      var wrap = track.parentElement;
      var cw = cards[0].getBoundingClientRect().width;
      var gap = parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap) || 0;
      var visible = Math.max(1, Math.round(wrap.clientWidth / (cw + gap)));
      var maxShift = Math.max(0, n - visible);
      go(Math.max(0, Math.min(maxShift, idx + dir)));
      locked = true;
      setTimeout(function () { locked = false; }, 640);
    }

    prevBtn.addEventListener('click', function () { step(-1); });
    nextBtn.addEventListener('click', function () { step(1); });

    /* keyboard */
    document.addEventListener('keydown', function (e) {
      var r = slider.getBoundingClientRect();
      if (r.top < window.innerHeight && r.bottom > 0 &&
          (e.key === 'ArrowLeft' || e.key === 'ArrowRight')) {
        e.preventDefault();
        step(e.key === 'ArrowLeft' ? -1 : 1);
      }
    });

    /* swipe / drag */
    var startX = 0, startY = 0, dragging = false, moved = 0;
    track.addEventListener('pointerdown', function (e) {
      dragging = true; moved = 0;
      startX = e.clientX; startY = e.clientY;
    });
    window.addEventListener('pointermove', function (e) {
      if (!dragging) return;
      moved = Math.max(moved, Math.abs(e.clientX - startX));
    });
    window.addEventListener('pointerup', function (e) {
      if (!dragging) return;
      dragging = false;
      var dx = e.clientX - startX, dy = e.clientY - startY;
      if (Math.abs(dx) > 42 && Math.abs(dx) > Math.abs(dy)) step(dx < 0 ? 1 : -1);
    });
    track.addEventListener('click', function (e) {
      if (moved > 8) { e.preventDefault(); e.stopPropagation(); }
    });

    window.addEventListener('resize', function () { update(); });
    update();
  })();

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
@endpush