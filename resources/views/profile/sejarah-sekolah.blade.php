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

/* ---------- HERO: clean editorial showcase, tanpa foto background ---------- */
.history-hero{position:relative;min-height:78vh;display:flex;align-items:center;overflow:hidden;
  background:#fff;color:#0d3a66}
.history-hero::before{display:none}
/* Watermark besar seperti referensi: sangat tipis, berada di belakang judul */
.history-hero::after{content:"SEJARAH";position:absolute;z-index:0;left:-2%;top:50%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(8rem,24vw,24rem);font-weight:900;line-height:.78;
  letter-spacing:.015em;color:rgba(13,58,102,.035);
  -webkit-text-stroke:1px rgba(255,122,0,.12);
  pointer-events:none;white-space:nowrap;user-select:none}

/* ---------- ORNAMEN HERO KHUSUS: GEOMETRIC NETWORK ---------- */
.history-hero-geometry{position:absolute;inset:0;z-index:1;pointer-events:none;overflow:hidden}
.history-hero-geometry svg{position:absolute;width:100%;height:100%;inset:0;display:block}
.history-hero-geometry .geo-line{fill:none;stroke:#ff7a00;stroke-width:1.8;vector-effect:non-scaling-stroke;opacity:.42}
.history-hero-geometry .geo-line-navy{fill:none;stroke:#0d3a66;stroke-width:1.5;vector-effect:non-scaling-stroke;opacity:.24}
.history-hero-geometry .geo-node{fill:#fff;stroke:#ff7a00;stroke-width:2;vector-effect:non-scaling-stroke}
.history-hero-geometry .geo-node-navy{fill:#fff;stroke:#0d3a66;stroke-width:2;vector-effect:non-scaling-stroke}
.history-hero-geometry .geo-ring{fill:none;stroke:#0d3a66;stroke-width:1.2;opacity:.16}
.history-hero-geometry .geo-ring-orange{fill:none;stroke:#ff7a00;stroke-width:1.5;opacity:.28}
.history-hero-geometry .geo-diamond{fill:none;stroke:#ff7a00;stroke-width:1.4;opacity:.30}
.history-hero-geometry .geo-dot{fill:#ff7a00;opacity:.52}
.history-hero-geometry .geo-square{fill:#ff7a00;opacity:.9}
.history-hero-geometry .geo-square-navy{fill:#0d3a66;opacity:.9}
.history-hero-geometry .geo-soft{fill:#ff7a00;opacity:.055}

/* Kiri atas: pola titik + orbit yang jelas */
.history-hero-geometry .geo-cluster-left{position:absolute;left:-70px;top:-58px;width:330px;height:250px}
/* Kanan atas: orbit + diamond sebagai focal decorative element */
.history-hero-geometry .geo-cluster-right{position:absolute;right:-55px;top:18px;width:360px;height:270px}
/* Kiri bawah: jalur jaringan dengan node */
.history-hero-geometry .geo-network-left{position:absolute;left:-35px;bottom:12px;width:500px;height:220px}
/* Kanan bawah: motif modular, bukan garis acak */
.history-hero-geometry .geo-modules{position:absolute;right:-25px;bottom:-8px;width:430px;height:210px;transform:rotate(-2deg)}

/* watermark tetap menjadi layer paling belakang */
.history-hero::after{z-index:0}

.history-hero-inner{position:relative;z-index:3;width:100%;max-width:1500px;margin:0 auto;
  padding:clamp(4rem,10vh,7rem) clamp(1.25rem,4vw,4.5rem) clamp(4rem,9vh,6rem);
  display:block}

.history-kicker{display:inline-flex;align-items:center;gap:.65rem;font-size:.72rem;font-weight:900;
  letter-spacing:.18em;text-transform:uppercase;color:#ff6f00;margin-bottom:1.05rem;
  padding:.55rem .85rem;border:1px solid rgba(255,111,0,.18);border-radius:999px;
  background:#fffaf5}
.history-kicker::before{content:"";width:9px;height:9px;border-radius:50%;
  background:#ff6f00;box-shadow:0 0 0 6px rgba(255,111,0,.10)}

/* ---------- TITLE: navy + orange, besar seperti referensi ---------- */
.history-title{font-family:var(--font-display);font-size:clamp(4rem,10vw,9.2rem);line-height:.84;
  letter-spacing:-.035em;margin:0;max-width:1250px;text-transform:uppercase;
  text-shadow:none;animation:hdFadeUp .7s .1s var(--ease, ease) both}
.history-title .sejarah-white{color:#0d3a66;display:block}
.history-title .skaneda-gold{display:block;
  background:linear-gradient(135deg,#ff7a00 0%,#ff6a00 55%,#f4511e 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ff6f00;
  text-shadow:none;letter-spacing:-.025em}

.history-lead{font-size:1rem;line-height:1.75;color:#52657a;max-width:720px;
  margin:1.7rem 0 0;animation:hdFadeUp .7s .26s var(--ease, ease) both}
.history-hero-meta{display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;animation:hdFadeUp .7s .4s var(--ease, ease) both}
.history-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;
  border:1px solid rgba(13,58,102,.12);background:#fff;border-radius:999px;color:#0d3a66;
  font-size:.72rem;font-weight:800;box-shadow:0 8px 24px rgba(13,58,102,.06)}
.history-pill i{color:#ff7a00}
.hero-photo{display:none}
.hero-photo::before,.hero-photo img,.hero-photo-caption{display:none}
@keyframes hdFadeUp{from{opacity:0;transform:translateY(26px)}to{opacity:1;transform:none}}

  .history-vt-cta{
    display:inline-flex;align-items:center;gap:.8rem;margin-top:1.7rem;
    padding:.8rem 1rem;border-radius:16px;text-decoration:none;color:#0d3a66;
    background:#fff;border:1px solid rgba(13,58,102,.12);
    box-shadow:0 12px 30px rgba(13,58,102,.08);
    transition:transform .3s ease,background .3s ease,border-color .3s ease,box-shadow .3s ease
  }
  .history-vt-cta:hover{
    transform:translateY(-4px);background:#fffaf5;
    border-color:rgba(255,122,0,.28);box-shadow:0 18px 38px rgba(13,58,102,.12)
  }
  .history-vt-icon{
    width:46px;height:46px;border-radius:14px;display:grid;place-items:center;
    background:linear-gradient(135deg,#ffd54a,#ff7a00);color:#0d3a66;font-size:.9rem
  }
  .history-vt-cta strong{display:block;font-size:1rem;line-height:1.15;font-weight:900;letter-spacing:.01em}
  .history-vt-cta small{display:block;margin-top:.25rem;color:#718096;font-size:.72rem;font-weight:600}
  .history-vt-arrow{margin-left:.3rem;color:#ffd54a;font-size:1rem}
/* ---------- SECTION COMMON (sama keluarga dengan Beranda) ---------- */
.history-wide{width:min(1380px,92%);margin:auto}
.eyebrow{display:inline-flex;align-items:center;gap:.5rem;font-size:.74rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#0d3a66;margin-bottom:.85rem}
.story-content .eyebrow{color:#ffb300;}
.story-content .eyebrow::before{background:linear-gradient(90deg,#ffd54a,#ff9800);}
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

/* ---------- FINAL HERO TUNING ---------- */
.history-hero-inner{width:100%;max-width:1500px}
.history-title{max-width:1250px}
@media(max-width:700px){
  .history-hero{min-height:70vh}
  .history-hero-inner{padding-top:3.5rem;padding-bottom:4rem}
  .history-title{font-size:clamp(3.5rem,16vw,6rem);line-height:.88}
  .history-hero::after{font-size:clamp(7rem,32vw,12rem);left:-8%}
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
   KEPEMIMPINAN — INSTAGRAM-STYLE HISTORY
   Satu post dominan, foto 3:4, carousel halus, premium.
   ========================================================= */
.principal-section{
  position:relative;overflow:hidden;isolation:isolate;
  padding:120px 0 135px;
  background:
    radial-gradient(circle at 7% 20%,rgba(13,58,102,.10) 0 2px,transparent 3px),
    radial-gradient(circle at 93% 28%,rgba(255,179,0,.14) 0 3px,transparent 4px),
    linear-gradient(180deg,#ffffff 0%,#f5f8fc 55%,#edf3f8 100%);
  z-index:1;
}
.principal-section::before{
  content:"";position:absolute;left:-90px;bottom:70px;width:280px;height:280px;
  background-image:radial-gradient(circle,rgba(13,58,102,.25) 2px,transparent 3px);
  background-size:22px 22px;opacity:.42;pointer-events:none;z-index:0;
}
.principal-section::after{
  content:"";position:absolute;right:-80px;top:105px;width:260px;height:260px;
  border:1px solid rgba(13,58,102,.12);border-radius:50%;
  box-shadow:0 0 0 26px rgba(13,58,102,.025),0 0 0 56px rgba(255,179,0,.025);
  pointer-events:none;z-index:0;
}
.principal-section .home-orn .ho-chevron{left:-170px;top:20px;width:410px;height:410px}
.principal-section .home-orn .ho-chevron::after{inset:46px}
.principal-section .home-orn .ho-ring{right:-100px;top:22%;width:240px;height:240px}
.principal-section .home-orn .ho-dots{right:8%;bottom:55px;width:145px;height:145px;opacity:.46}
.principal-section .home-orn .ho-gold{left:15%;top:25%}
.principal-section .home-orn .ho-square{right:17%;top:31%}
.principal-section .home-orn .ho-corner{left:4%;bottom:7%;transform:rotate(180deg);width:125px;height:125px}
.principal-head{
  width:min(1080px,92%);margin:0 auto 3.8rem;text-align:center;
  position:relative;z-index:2;
}
.principal-head .eyebrow{justify-content:center}
.principal-head .eyebrow::after{
  content:"• • •";color:#ffb300;letter-spacing:5px;font-size:12px;margin-left:.35rem
}
.principal-head .big-heading{
  margin:0 auto;font-size:clamp(2.8rem,5.2vw,5rem);
  letter-spacing:-.035em;text-shadow:0 10px 28px rgba(13,58,102,.08)
}
.principal-head .big-heading span{
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;
  -webkit-text-fill-color:transparent;color:transparent;
}
.principal-desc{
  max-width:660px;margin:1rem auto 0;color:#687c90;
  font-size:.95rem;line-height:1.85
}
.principal-stage{
  position:relative;z-index:2;width:min(1050px,94%);margin:0 auto;
  display:flex;align-items:center;gap:1rem;
}
.principal-viewport{
  flex:1;min-width:0;overflow:hidden;border-radius:30px;
  padding:10px 8px 22px;
}
.principal-track{
  display:flex;gap:1.5rem;
  transition:transform .65s cubic-bezier(.22,.61,.36,1);
  will-change:transform;
}
.principal-post{
  flex:0 0 min(430px,82vw);
  background:#fff;border:1px solid rgba(13,58,102,.13);
  border-radius:24px;overflow:hidden;
  box-shadow:0 22px 58px rgba(13,58,102,.13),0 4px 12px rgba(13,58,102,.05);
  transition:transform .4s ease,box-shadow .4s ease,border-color .3s ease;
}
.principal-post:hover{
  transform:translateY(-8px);
  box-shadow:0 32px 75px rgba(13,58,102,.19);
  border-color:rgba(255,179,0,.42)
}
.principal-post-head{
  height:64px;padding:.75rem .9rem;
  display:flex;align-items:center;justify-content:space-between;gap:.8rem;
  border-bottom:1px solid #edf2f6;background:#fff
}
.principal-profile{display:flex;align-items:center;gap:.65rem;min-width:0}
.principal-avatar{
  width:38px;height:38px;flex:0 0 38px;border-radius:50%;
  display:grid;place-items:center;color:#ffd54a;
  background:linear-gradient(135deg,#0d3a66,#174f80);
  box-shadow:0 6px 15px rgba(13,58,102,.2)
}
.principal-profile strong{display:block;color:#0d3a66;font-size:.78rem;font-weight:900;line-height:1.15}
.principal-profile span{display:block;color:#8293a4;font-size:.64rem;margin-top:.15rem}
.principal-more{color:#7d8fa1;font-size:1rem}
.principal-photo{
  position:relative;width:100%;aspect-ratio:3/4;
  min-height:430px;max-height:620px;overflow:hidden;
  background:linear-gradient(160deg,#eef5fb 0%,#dce9f4 58%,#c9d9e7 100%);
  display:flex;align-items:flex-end;justify-content:center;
}
.principal-photo img{
  width:100%;height:100%;object-fit:contain;object-position:center bottom;
  display:block;padding:0 1.2rem 0;
  filter:drop-shadow(0 18px 20px rgba(13,58,102,.18));
  transition:transform .65s cubic-bezier(.22,.61,.36,1)
}
.principal-post:hover .principal-photo img{transform:scale(1.035) translateY(-3px)}
.principal-photo::after{
  content:"";position:absolute;inset:0;pointer-events:none;
  background:linear-gradient(180deg,transparent 62%,rgba(7,28,52,.18) 100%)
}
.principal-current{
  position:absolute;right:1rem;top:1rem;z-index:3;
  display:inline-flex;align-items:center;gap:.4rem;
  padding:.45rem .72rem;border-radius:999px;
  color:#fff;background:linear-gradient(135deg,#ffd54a,#ff8a00);
  font-size:.66rem;font-weight:900;letter-spacing:.08em;text-transform:uppercase;
  box-shadow:0 9px 22px rgba(255,138,0,.32)
}
.principal-current::before{
  content:"";width:7px;height:7px;border-radius:50%;background:#0d3a66;
  box-shadow:0 0 0 5px rgba(13,58,102,.08)
}
.principal-post-actions{
  display:flex;align-items:center;gap:1rem;padding:.8rem 1rem .45rem;color:#173f64;font-size:1.05rem
}
.principal-post-actions .spacer{margin-left:auto}
.principal-post-body{padding:0 1rem 1.15rem}
.principal-like{color:#0d3a66;font-size:.72rem;font-weight:900;margin-bottom:.45rem}
.principal-caption{color:#5f7186;font-size:.78rem;line-height:1.65;margin:0}
.principal-caption strong{color:#0d3a66}
.principal-period{
  display:inline-flex;align-items:center;gap:.5rem;margin-top:.75rem;
  padding:.42rem .68rem;border-radius:999px;
  color:#ff8a00;background:#fff7e8;border:1px solid rgba(255,179,0,.25);
  font-size:.68rem;font-weight:900;letter-spacing:.06em
}
.principal-period::before{
  content:"";width:20px;height:2px;border-radius:99px;
  background:linear-gradient(90deg,#ffd54a,#ff8a00)
}
.principal-arrow{
  flex:0 0 50px;width:50px;height:50px;border:0;border-radius:50%;
  cursor:pointer;display:grid;place-items:center;
  background:linear-gradient(135deg,#0d3a66,#173f64);color:#fff;
  font-size:1rem;box-shadow:0 12px 28px rgba(13,58,102,.28);
  transition:transform .3s ease,box-shadow .3s ease,background .3s ease
}
.principal-arrow:hover{
  transform:translateY(-3px) scale(1.06);
  background:linear-gradient(135deg,#ffb300,#ff8a00);
  box-shadow:0 18px 38px rgba(13,58,102,.3)
}
.principal-arrow:disabled{opacity:.35;cursor:default;transform:none}
.principal-dots{
  display:flex;justify-content:center;gap:.55rem;margin-top:1.35rem;
  position:relative;z-index:2
}
.principal-dots button{
  width:9px;height:9px;border:0;border-radius:99px;padding:0;cursor:pointer;
  background:rgba(13,58,102,.22);transition:all .3s ease
}
.principal-dots button.is-active{width:28px;background:linear-gradient(90deg,#ffd54a,#ff8a00)}
.principal-section > .principal-head,
.principal-section > .principal-stage,
.principal-section > .principal-dots{position:relative;z-index:2}
@media(max-width:700px){
  .principal-section{padding:85px 0 100px}
  .principal-head{margin-bottom:2.8rem}
  .principal-stage{width:100%;gap:.35rem}
  .principal-viewport{padding:8px 4px 18px}
  .principal-post{flex-basis:86vw;max-width:430px}
  .principal-photo{min-height:390px}
  .principal-arrow{flex-basis:42px;width:42px;height:42px;font-size:.9rem}
  .principal-section .home-orn .ho-chevron{width:260px;height:260px;left:-110px;top:30px}
  .principal-section .home-orn .ho-ring{width:150px;height:150px;right:-60px}
  .principal-section .home-orn .ho-dots{width:90px;height:90px;background-size:14px 14px}
}

/* =========================================================
   VIRTUAL TOUR 360 — mengikuti bahasa visual Beranda
   ========================================================= */
.vt-section{
  position:relative;overflow:hidden;isolation:isolate;padding:120px 0 130px;
  background:linear-gradient(180deg,#eef5fb 0%,#ffffff 48%,#f3f7fb 100%);
}
.vt-section::before{content:"";position:absolute;inset:0;pointer-events:none;opacity:.42;
  background-image:radial-gradient(circle,rgba(13,58,102,.18) 1.5px,transparent 2px);
  background-size:22px 22px;mask-image:linear-gradient(90deg,transparent 0%,#000 15%,#000 85%,transparent 100%);
}
.vt-watermark{position:absolute;right:-20px;top:40px;font-size:clamp(9rem,18vw,16rem);font-weight:900;line-height:.8;color:rgba(13,58,102,.035);letter-spacing:-.08em;z-index:0;user-select:none}
.vt-decor-ring{position:absolute;right:-70px;top:80px;width:300px;height:300px;border:1px solid rgba(13,58,102,.12);border-radius:50%;z-index:0}
.vt-decor-ring::before{content:"";position:absolute;inset:35px;border:1px dashed rgba(255,179,0,.3);border-radius:50%}
.vt-decor-dots{position:absolute;left:4%;bottom:65px;width:125px;height:125px;opacity:.42;background-image:radial-gradient(circle,#ffb300 2px,transparent 2.5px);background-size:18px 18px;z-index:0}
.vt-inner{position:relative;z-index:2;width:min(1180px,92%);margin:0 auto;display:grid;grid-template-columns:minmax(0,1.05fr) minmax(360px,.95fr);gap:4.5rem;align-items:center}
.vt-media{min-width:0}
.vt-frame{position:relative;overflow:hidden;border-radius:30px;background:#0d3a66;box-shadow:0 30px 75px rgba(13,58,102,.2);aspect-ratio:16/10;border:1px solid rgba(255,255,255,.65)}
.vt-frame::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 42%,rgba(5,25,48,.78) 100%);pointer-events:none}
.vt-frame img{width:100%;height:100%;display:block;object-fit:cover;transition:transform .7s cubic-bezier(.22,.61,.36,1)}
.vt-frame:hover img{transform:scale(1.045)}
.vt-badge{position:absolute;left:1.2rem;top:1.2rem;z-index:3;display:inline-flex;align-items:center;gap:.5rem;padding:.58rem .85rem;border-radius:999px;background:rgba(13,58,102,.86);color:#fff;font-size:.74rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;backdrop-filter:blur(8px)}
.vt-play{position:absolute;z-index:4;left:50%;top:50%;transform:translate(-50%,-50%);width:78px;height:78px;border-radius:50%;border:7px solid rgba(255,255,255,.22);background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:1.35rem;display:grid;place-items:center;cursor:pointer;box-shadow:0 18px 45px rgba(255,138,0,.38);transition:transform .3s ease,box-shadow .3s ease}
.vt-play:hover{transform:translate(-50%,-50%) scale(1.08);box-shadow:0 24px 55px rgba(255,138,0,.5)}
.vt-caption{position:absolute;left:1.4rem;right:1.4rem;bottom:1.25rem;z-index:3;display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;color:#fff}
.vt-caption strong{display:block;font-size:1.2rem;font-weight:900}.vt-caption span{display:block;margin-top:.22rem;color:rgba(255,255,255,.76);font-size:.78rem}
.vt-cam{display:inline-flex!important;align-items:center;gap:.4rem;padding:.48rem .7rem;border:1px solid rgba(255,255,255,.28);border-radius:999px!important;background:rgba(0,0,0,.18);white-space:nowrap}
.vt-chip{display:inline-flex;align-items:center;gap:.75rem;margin-top:1rem;padding:.75rem 1rem;border-radius:16px;background:#fff;border:1px solid rgba(13,58,102,.1);box-shadow:0 12px 30px rgba(13,58,102,.08)}
.vt-chip>i{width:40px;height:40px;border-radius:12px;display:grid;place-items:center;background:linear-gradient(135deg,#ffd54a,#ff9f00);color:#0d3a66}.vt-chip strong{display:block;color:#0d3a66;font-size:.85rem}.vt-chip span{display:block;color:#71839a;font-size:.68rem;margin-top:.15rem}
.vt-copy{position:relative}.vt-kicker{display:inline-flex;align-items:center;gap:.55rem;color:#0d3a66;font-size:.75rem;font-weight:900;letter-spacing:.16em;text-transform:uppercase}.vt-kicker::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ff8a00)}
.vt-title{margin:.8rem 0 1.1rem;color:#0d3a66;font-family:var(--font-display);font-size:clamp(2.8rem,5vw,4.8rem);font-weight:900;line-height:.98;letter-spacing:-.045em}.vt-gold{display:block;background:linear-gradient(90deg,#ffd54a,#ff8a00);-webkit-background-clip:text;background-clip:text;color:transparent}.vt-sub{display:block;margin-top:.55rem;font-size:.38em;line-height:1.1;letter-spacing:.02em;color:#315b80;font-weight:800}
.vt-desc{max-width:590px;color:#667b90;line-height:1.9;font-size:.98rem}.vt-feats{display:flex;flex-wrap:wrap;gap:.55rem;margin:1.25rem 0}.vt-feat{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem .75rem;border-radius:999px;background:#fff;border:1px solid rgba(13,58,102,.1);color:#315b80;font-size:.74rem;font-weight:800}.vt-feat i{color:#ff9f00}.vt-btn{display:inline-flex;align-items:center;justify-content:center;gap:.65rem;padding:.9rem 1.2rem;border-radius:14px;background:linear-gradient(135deg,#0d3a66,#164e80);color:#fff;text-decoration:none;font-weight:900;box-shadow:0 14px 32px rgba(13,58,102,.2);transition:transform .3s ease,box-shadow .3s ease}.vt-btn:hover{transform:translateY(-4px);box-shadow:0 20px 40px rgba(13,58,102,.28)}
@media(max-width:900px){.vt-inner{grid-template-columns:1fr;gap:2.5rem}.vt-copy{max-width:700px}.vt-title{font-size:clamp(2.6rem,10vw,4rem)}}
@media(max-width:600px){.vt-section{padding:85px 0 95px}.vt-inner{width:92%;gap:2rem}.vt-frame{aspect-ratio:4/3;border-radius:22px}.vt-play{width:64px;height:64px}.vt-caption{left:1rem;right:1rem;bottom:1rem}.vt-caption strong{font-size:1rem}.vt-caption span{font-size:.7rem}.vt-cam{display:none!important}.vt-title{font-size:clamp(2.35rem,12vw,3.3rem)}.vt-decor-ring{width:190px;height:190px;right:-80px}.vt-decor-dots{width:90px;height:90px;background-size:14px 14px}}

@media(max-width:700px){
  .principal-section{padding:85px 0 95px}
  .principal-head{margin-bottom:3.6rem}
  .principal-slider{width:100%;gap:.4rem}
  .principal-arrow{flex-basis:42px;width:42px;height:42px;font-size:.9rem}
  .principal-card{flex-basis:74vw;max-width:300px}
  .principal-photo{min-height:300px;aspect-ratio:3/4}
  .principal-section::before{width:150px;height:150px;left:-45px;bottom:70px}
  .principal-section::after{width:140px;height:140px;right:-45px;top:150px}
  .principal-section .home-orn .ho-chevron{width:260px;height:260px;left:-110px;top:30px}
  .principal-section .home-orn .ho-ring{width:150px;height:150px;right:-60px}
  .principal-section .home-orn .ho-dots{width:90px;height:90px;background-size:14px 14px}
}

  /* FINAL FIXES — no vertical rail, cleaner hero CTA and VT spacing */
  .history-hero-inner::before{display:none!important;content:none!important}
  .history-vt-cta{position:relative;z-index:4}
  .vt-section{scroll-margin-top:90px}
  .vt-inner{gap:clamp(2.5rem,5vw,4.5rem)}
  .vt-copy{padding-top:.25rem}
  .vt-title{max-width:620px}
  .vt-desc{margin-top:.2rem}
  @media(max-width:950px){
    .history-hero-inner{grid-template-columns:1fr;gap:2rem}
    .history-hero-inner>div:first-child{max-width:760px}
  }
  @media(max-width:700px){
    .history-vt-cta{width:min(100%,340px)}
    .history-vt-cta .history-vt-arrow{margin-left:auto}
  }


/* Hero ornament responsiveness — tetap ringan di layar kecil */
@media (max-width: 900px){
  .history-hero-geometry .hhg-path-a{width:240px;left:-70px;top:22%}
  .history-hero-geometry .hhg-path-b{width:280px;right:-110px;top:72%}
  .history-hero-geometry .hhg-path-c{left:10%;width:210px}
  .history-hero-geometry .hhg-diamond{width:52px;height:52px;right:8%;top:24%}
  .history-hero-geometry .hhg-corner{right:3%;top:8%;width:66px;height:66px}
  .history-hero-geometry .hhg-orbit{width:150px;height:66px;left:-48px;bottom:8%}
}
@media (max-width: 560px){
  .history-hero-geometry .hhg-node{width:9px;height:9px}
  .history-hero-geometry .hhg-node-a{left:8%;top:20%}
  .history-hero-geometry .hhg-node-b{left:18%;bottom:10%}
  .history-hero-geometry .hhg-node-c{right:11%;top:18%}
  .history-hero-geometry .hhg-node-d{right:5%;bottom:18%}
  .history-hero-geometry .hhg-diamond{right:5%;top:31%;width:38px;height:38px}
  .history-hero-geometry .hhg-dashes{left:4%;top:11%;width:60px;height:42px;background-size:10px 10px}
  .history-hero-geometry .hhg-corner{display:none}
  .history-hero-geometry .hhg-path-b{right:-145px}
}

/* =========================================================
   HERO ORNAMENT v2 — clean geometric network
   Hanya untuk Hero Sejarah. Tidak memakai ornamen hero lama.
   ========================================================= */
.history-hero > .home-orn{display:none}
.history-hero-inner::before,.history-hero-inner::after{display:none!important}
.history-hero-geometry{z-index:1;opacity:1}
.history-hero-geometry::before{
  content:"";position:absolute;left:-70px;top:-35px;width:300px;height:300px;border-radius:50%;
  background-image:radial-gradient(circle,rgba(13,58,102,.16) 1.5px,transparent 1.7px);
  background-size:18px 18px;opacity:.62;
  -webkit-mask-image:radial-gradient(circle at 52% 52%,#000 0 48%,transparent 72%);mask-image:radial-gradient(circle at 52% 52%,#000 0 48%,transparent 72%);
}
.history-hero-geometry::after{
  content:"";position:absolute;right:-30px;bottom:-40px;width:420px;height:190px;
  background:
    linear-gradient(135deg,transparent 47%,rgba(255,122,0,.62) 48%,rgba(255,122,0,.62) 49%,transparent 50%),
    linear-gradient(35deg,transparent 48%,rgba(13,58,102,.22) 49%,rgba(13,58,102,.22) 50%,transparent 51%);
  opacity:.75;transform:rotate(-5deg);
}
.history-hero-geometry .hhg-path{height:1.5px;opacity:.55;box-shadow:none}
.history-hero-geometry .hhg-path-a{width:430px;left:-95px;top:48%;background:#ff7a00;transform:rotate(30deg);opacity:.38}
.history-hero-geometry .hhg-path-b{width:470px;right:-150px;top:38%;background:#0d3a66;transform:rotate(-36deg);opacity:.22}
.history-hero-geometry .hhg-path-c{width:310px;left:auto;right:3%;bottom:15%;background:#ff7a00;transform:rotate(-13deg);opacity:.42}
.history-hero-geometry .hhg-node{width:11px;height:11px;border:2px solid #ff7a00;background:#fff;box-shadow:0 0 0 5px rgba(255,122,0,.08)}
.history-hero-geometry .hhg-node-a{left:8%;top:18%}
.history-hero-geometry .hhg-node-b{left:31%;bottom:12%}
.history-hero-geometry .hhg-node-c{right:22%;top:23%;border-color:#0d3a66;box-shadow:0 0 0 5px rgba(13,58,102,.06)}
.history-hero-geometry .hhg-node-d{right:8%;bottom:18%}
.history-hero-geometry .hhg-diamond{width:58px;height:58px;right:21%;top:18%;border:1px solid rgba(255,122,0,.34);background:transparent;box-shadow:none}
.history-hero-geometry .hhg-orbit{width:230px;height:100px;left:-75px;bottom:5%;border:1px solid rgba(13,58,102,.18);background:transparent;transform:rotate(-16deg)}
.history-hero-geometry .hhg-orbit::after{width:7px;height:7px;right:22px;top:9px;background:#ff7a00}
.history-hero-geometry .hhg-corner{right:2.5%;top:12%;width:110px;height:110px;border-top:1px solid rgba(255,122,0,.28);border-right:1px solid rgba(13,58,102,.18);border-radius:0 26px 0 0}
.history-hero-geometry .hhg-corner::after{width:45px;height:1.5px;right:-2px;top:46px;background:#ff7a00}
.history-hero-geometry .hhg-dashes{left:7%;top:11%;width:82px;height:54px;background-image:radial-gradient(circle,rgba(255,122,0,.32) 1.2px,transparent 1.4px);background-size:12px 12px;opacity:.75}
/* network joints: small connectors placed away from the headline */
.history-hero-geometry .hhg-node-a::after,.history-hero-geometry .hhg-node-b::after,.history-hero-geometry .hhg-node-c::after,.history-hero-geometry .hhg-node-d::after{content:"";position:absolute;width:72px;height:1px;background:rgba(255,122,0,.25);left:9px;top:5px;transform-origin:left center}
.history-hero-geometry .hhg-node-a::after{transform:rotate(28deg);width:95px}
.history-hero-geometry .hhg-node-b::after{transform:rotate(-18deg);width:110px}
.history-hero-geometry .hhg-node-c::after{transform:rotate(24deg);background:rgba(13,58,102,.20);width:90px}
.history-hero-geometry .hhg-node-d::after{transform:rotate(-34deg);width:70px}
@media(max-width:900px){
  .history-hero-geometry .hhg-path-a{width:250px;left:-90px;top:45%}
  .history-hero-geometry .hhg-path-b{width:300px;right:-150px;top:34%}
  .history-hero-geometry .hhg-diamond{right:8%;top:18%;width:42px;height:42px}
  .history-hero-geometry .hhg-corner{right:0;top:10%;width:75px;height:75px}
  .history-hero-geometry .hhg-orbit{width:160px;height:72px;left:-70px}
}
@media(max-width:560px){
  .history-hero-geometry::before{width:210px;height:210px;left:-70px;top:-25px;background-size:14px 14px}
  .history-hero-geometry::after{width:250px;height:120px;right:-80px;bottom:-20px}
  .history-hero-geometry .hhg-node-a{left:7%;top:16%}.history-hero-geometry .hhg-node-b{left:18%;bottom:10%}
  .history-hero-geometry .hhg-node-c{right:18%;top:20%}.history-hero-geometry .hhg-node-d{right:5%;bottom:15%}
  .history-hero-geometry .hhg-node::after{display:none}.history-hero-geometry .hhg-corner{display:none}
}



/* =========================================================
   HERO ORNAMENT v3 — ORNAMEN DI SISI KANAN JUDUL
   Fokus: ruang kosong di sebelah "SEJARAH SKANEDA".
   Tidak masuk ke area headline.
   ========================================================= */
.history-hero-geometry{
  z-index:1;
  pointer-events:none;
}

/* Matikan susunan kiri/bawah yang sebelumnya terlalu dekat dengan headline */
.history-hero-geometry .geo-cluster-left,
.history-hero-geometry .geo-network-left{
  display:none !important;
}

/* Cluster utama: orbit + diamond di kanan atas */
.history-hero-geometry .geo-cluster-right{
  display:block;
  left:auto;
  right:1.5%;
  top:7%;
  width:min(430px,38vw);
  height:min(320px,34vh);
  transform:none;
  opacity:.92;
}

/* Cluster modular: jalur + blok di kanan bawah */
.history-hero-geometry .geo-modules{
  display:block;
  left:auto;
  right:-1%;
  bottom:5%;
  width:min(420px,36vw);
  height:min(220px,24vh);
  transform:rotate(-2deg);
  opacity:.82;
}

/* Tambahan pola arsitektur di area kanan tengah */
.history-hero-geometry::before{
  left:auto;
  right:3%;
  top:31%;
  width:min(300px,25vw);
  height:min(300px,30vh);
  border-radius:50%;
  background-image:
    radial-gradient(circle,rgba(13,58,102,.18) 1.4px,transparent 1.7px);
  background-size:17px 17px;
  opacity:.42;
  -webkit-mask-image:radial-gradient(circle at 50% 50%,#000 0 43%,transparent 72%);
  mask-image:radial-gradient(circle at 50% 50%,#000 0 43%,transparent 72%);
}

/* Garis "jalur" terarah yang menghubungkan area kanan */
.history-hero-geometry::after{
  right:-25px;
  left:auto;
  bottom:4%;
  width:min(520px,44vw);
  height:180px;
  background:
    linear-gradient(135deg,transparent 47.5%,rgba(255,122,0,.52) 48%,rgba(255,122,0,.52) 48.7%,transparent 49.2%),
    linear-gradient(25deg,transparent 49%,rgba(13,58,102,.20) 49.5%,rgba(13,58,102,.20) 50.2%,transparent 50.7%);
  opacity:.62;
  transform:none;
}

/* Pastikan headline selalu berada di atas dan bebas ornamen */
.history-hero-inner{
  z-index:4;
}
.history-title,
.history-kicker,
.history-vt-cta{
  position:relative;
  z-index:5;
}

/* Desktop besar: beri ruang visual kanan yang jelas */
@media (min-width:1100px){
  .history-hero-inner{
    padding-right:42%;
  }
  .history-title{
    max-width:820px;
  }
}

/* Tablet */
@media (max-width:900px){
  .history-hero-inner{
    padding-right:1.25rem;
  }
  .history-hero-geometry .geo-cluster-right{
    right:-45px;
    top:8%;
    width:330px;
    height:260px;
    opacity:.58;
  }
  .history-hero-geometry .geo-modules{
    right:-55px;
    bottom:2%;
    width:330px;
    height:180px;
    opacity:.58;
  }
  .history-hero-geometry::before{
    right:-35px;
    top:34%;
    width:240px;
    height:240px;
  }
}

/* Mobile: tetap ada aksen di sisi kanan, tapi tidak mengganggu teks */
@media (max-width:560px){
  .history-hero-geometry .geo-cluster-right{
    right:-115px;
    top:10%;
    width:270px;
    height:220px;
    opacity:.34;
  }
  .history-hero-geometry .geo-modules{
    right:-120px;
    bottom:0;
    width:280px;
    height:150px;
    opacity:.30;
  }
  .history-hero-geometry::before{
    right:-90px;
    top:38%;
    width:210px;
    height:210px;
    opacity:.24;
  }
  .history-hero-geometry::after{
    right:-120px;
    width:300px;
    height:130px;
    opacity:.28;
  }
}



/* ---------- HERO ORNAMENT RESPONSIVE ---------- */
@media (max-width:900px){
  .history-hero-geometry .geo-cluster-left{left:-105px;top:-42px;transform:scale(.82);transform-origin:top left}
  .history-hero-geometry .geo-cluster-right{right:-130px;top:20px;transform:scale(.78);transform-origin:top right}
  .history-hero-geometry .geo-network-left{left:-120px;bottom:8px;transform:scale(.72);transform-origin:bottom left}
  .history-hero-geometry .geo-modules{right:-135px;bottom:-8px;transform:scale(.68) rotate(-2deg);transform-origin:bottom right}
}
@media (max-width:560px){
  .history-hero-geometry .geo-cluster-left{left:-150px;top:-38px;transform:scale(.62);opacity:.72}
  .history-hero-geometry .geo-cluster-right{right:-180px;top:14px;transform:scale(.58);opacity:.68}
  .history-hero-geometry .geo-network-left{left:-180px;bottom:4px;transform:scale(.52);opacity:.65}
  .history-hero-geometry .geo-modules{right:-205px;bottom:-12px;transform:scale(.50) rotate(-2deg);opacity:.72}
  .history-hero::after{font-size:clamp(7rem,31vw,11rem);opacity:.8}
}



/* =========================================================
   HERO SEJARAH — ORNAMEN 100% MENGIKUTI JURUSAN / INDUSTRI
   SVG dan nilai visual mengikuti ornament yang sudah ada.
   Scope hanya ke Hero Sejarah.
   ========================================================= */
.history-jurusan-industry-decor{
  position:absolute;
  inset:0;
  z-index:1;
  pointer-events:none;
  overflow:hidden;
}
.history-jurusan-industry-decor svg{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
.history-jurusan-industry-decor .jd-grid{
  stroke:#0d3a66;
  stroke-width:1.5px;
  opacity:.15;
}
.history-jurusan-industry-decor .jd-diag{
  fill:none;
  stroke:#ff9f00;
  stroke-width:3px;
  stroke-linecap:round;
  opacity:.48;
}
.history-jurusan-industry-decor .jd-diag-soft{
  fill:none;
  stroke:#0d3a66;
  stroke-width:1.9px;
  stroke-linecap:round;
  opacity:.24;
}
.history-jurusan-industry-decor .jd-square{
  fill:none;
  stroke:#ff9f00;
  stroke-width:2.8px;
  opacity:.68;
}
.history-jurusan-industry-decor .jd-square-fill{
  fill:#ffb300;
  opacity:.22;
}
.history-jurusan-industry-decor .jd-hex{
  fill:none;
  stroke:#0d3a66;
  stroke-width:2.8px;
  opacity:.34;
}
.history-jurusan-industry-decor .jd-node{
  fill:#ff9f00;
  opacity:.82;
}
.history-jurusan-industry-decor .jd-plus{
  stroke:#0d3a66;
  stroke-width:2.8px;
  stroke-linecap:round;
  opacity:.42;
}
.history-jurusan-industry-decor .jd-corner{
  fill:none;
  stroke:#ff9f00;
  stroke-width:4px;
  stroke-linecap:square;
  opacity:.52;
}

/* Fokuskan ornamen ke ruang kanan, tanpa mengubah bentuk aslinya. */
@media (min-width:1100px){
  .history-jurusan-industry-decor{
    left:28%;
  }
}
@media (max-width:1099px){
  .history-jurusan-industry-decor{
    left:18%;
    opacity:.82;
  }
}
@media (max-width:640px){
  .history-jurusan-industry-decor{
    left:5%;
    opacity:.68;
  }
}


/* =========================================================
   HERO SEJARAH — REFERENCE LOOK
   Clean editorial typography + structured tech geometry.
   Scoped to hero only.
   ========================================================= */
.history-hero{
  min-height:clamp(620px,78vh,790px)!important;
  background:#fff!important;
  position:relative;
  isolation:isolate;
}
.history-hero>.home-orn,
.history-hero>.history-hero-geometry{
  display:none!important;
}
.history-ref-ornaments{
  position:absolute;
  inset:0;
  z-index:1;
  pointer-events:none;
  overflow:hidden;
}
.history-ref-ornaments svg{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
.history-ref-ornaments path{
  fill:none;
  stroke:#0d3a66;
  stroke-width:1.8;
  vector-effect:non-scaling-stroke;
  opacity:.20;
}
.history-ref-ornaments .ref-soft path{
  stroke:#ff7a00;
  opacity:.28;
}
.history-ref-ornaments .ref-soft-bottom path{
  stroke:#0d3a66;
  opacity:.18;
}
.history-ref-ornaments .ref-left path{
  stroke:#0d3a66;
  opacity:.18;
}
.history-ref-ornaments .ref-right path,
.history-ref-ornaments .ref-bottom path{
  stroke:#0d3a66;
  opacity:.23;
}
.history-ref-ornaments .ref-diamond-orange{
  fill:none;
  stroke:#ff7a00;
  stroke-width:2;
  opacity:.52;
}
.history-ref-ornaments .ref-hex{
  fill:none;
  stroke:#0d3a66;
  stroke-width:2;
  opacity:.30;
}
.history-ref-ornaments .ref-fill-orange{
  fill:#ff7a00;
  opacity:.95;
}
.history-ref-ornaments .ref-fill-navy{
  fill:#0d3a66;
  opacity:.95;
}
.history-ref-ornaments .ref-node-orange{
  fill:#fff;
  stroke:#ff7a00;
  stroke-width:2;
}
.history-ref-ornaments .ref-node-navy{
  fill:#fff;
  stroke:#0d3a66;
  stroke-width:2;
}
.history-ref-ornaments .ref-orbit{
  fill:none;
  stroke:#0d3a66;
  stroke-width:1.6;
  opacity:.22;
}
.history-ref-ornaments .ref-orbit-orange{
  fill:none;
  stroke:#ff7a00;
  stroke-width:1.6;
  opacity:.30;
}
.history-ref-ornaments .ref-orbit-core{
  fill:none;
  stroke:#0d3a66;
  stroke-width:2.2;
  opacity:.50;
}
.history-ref-ornaments .ref-heavy-orange{
  fill:none;
  stroke:#ff7a00;
  stroke-width:7;
  opacity:.90;
}
.history-ref-ornaments .ref-heavy-navy{
  fill:none;
  stroke:#0d3a66;
  stroke-width:7;
  opacity:.90;
}
.history-ref-ornaments .ref-dots circle{
  fill:#0d3a66;
  opacity:.20;
}
.history-ref-ornaments .ref-soft rect,
.history-ref-ornaments .ref-soft-bottom rect{
  fill:none;
  stroke:#ff7a00;
  stroke-width:2;
  opacity:.45;
}
.history-hero::after{
  content:"SEJARAH"!important;
  left:2%!important;
  top:58%!important;
  font-size:clamp(9rem,23vw,23rem)!important;
  color:rgba(13,58,102,.035)!important;
  -webkit-text-stroke:1px rgba(255,122,0,.09)!important;
  z-index:0!important;
}
.history-hero-inner{
  z-index:4!important;
  max-width:1500px!important;
  padding:clamp(4rem,10vh,7rem) clamp(1.25rem,4.2vw,4.5rem) clamp(4rem,9vh,6rem)!important;
}
.history-title{
  font-size:clamp(4.4rem,9.8vw,9.3rem)!important;
  line-height:.82!important;
  max-width:900px!important;
  letter-spacing:-.045em!important;
}
.history-title .sejarah-white{
  color:#0d3a66!important;
}
.history-title .skaneda-gold{
  color:#ff7a00!important;
  background:none!important;
  -webkit-text-fill-color:#ff7a00!important;
}
.history-kicker{
  margin-bottom:1.2rem!important;
}
.history-vt-cta{
  margin-top:2rem!important;
}
@media(min-width:1050px){
  .history-hero-inner{
    padding-right:44%!important;
  }
}
@media(max-width:900px){
  .history-ref-ornaments{
    opacity:.72;
  }
  .history-title{
    font-size:clamp(4rem,11vw,7rem)!important;
  }
}
@media(max-width:560px){
  .history-ref-ornaments{
    opacity:.40;
  }
  .history-hero-inner{
    padding-right:1.25rem!important;
  }
  .history-title{
    font-size:clamp(3.3rem,16vw,5.5rem)!important;
  }
}

/* =========================================================
   FINAL HERO FIX — ORNAMEN JELAS DI SISI KANAN JUDUL
   Bentuk: network, diamond, hexagon, orbit, node, modular blocks.
   Tidak memakai gambar/background eksternal.
   ========================================================= */
.history-hero{
  background:#fff!important;
  overflow:hidden!important;
}
.history-hero>.history-ref-ornaments{
  display:block!important;
  position:absolute!important;
  inset:0!important;
  z-index:1!important;
  pointer-events:none!important;
}
.history-hero>.history-ref-ornaments svg{
  width:100%!important;
  height:100%!important;
}
.history-hero-inner{
  position:relative!important;
  z-index:4!important;
  padding-right:44%!important;
}
.history-title{
  position:relative!important;
  z-index:5!important;
  max-width:900px!important;
}
.history-kicker,.history-vt-cta{
  position:relative!important;
  z-index:5!important;
}
/* Ornamen kanan dibuat lebih tegas seperti bahasa visual Jurusan/Industri. */
.history-ref-ornaments .ref-right path,
.history-ref-ornaments .ref-bottom path{
  opacity:.34!important;
}
.history-ref-ornaments .ref-diamond-orange{
  stroke-width:2.4!important;
  opacity:.72!important;
}
.history-ref-ornaments .ref-fill-orange,
.history-ref-ornaments .ref-fill-navy{
  opacity:.96!important;
}
.history-ref-ornaments .ref-hex{
  stroke-width:2.4!important;
  opacity:.48!important;
}
.history-ref-ornaments .ref-orbit{
  stroke-width:1.8!important;
  opacity:.30!important;
}
.history-ref-ornaments .ref-orbit-orange{
  stroke-width:1.8!important;
  opacity:.42!important;
}
.history-ref-ornaments .ref-heavy-orange,
.history-ref-ornaments .ref-heavy-navy{
  stroke-width:6!important;
  opacity:.72!important;
}
.history-ref-ornaments .ref-node-orange,
.history-ref-ornaments .ref-node-navy{
  stroke-width:2.2!important;
}
@media(max-width:1050px){
  .history-hero-inner{padding-right:1.25rem!important}
  .history-ref-ornaments{opacity:.72!important}
}
@media(max-width:700px){
  .history-hero-inner{padding-right:1.25rem!important}
  .history-ref-ornaments{opacity:.45!important}
  .history-title{font-size:clamp(3rem,14vw,5rem)!important}
}


/* =========================================================
   FINAL ORNAMENT IMAGE — GENERATED PNG
   Menggantikan SVG hero dengan gambar ornamen transparan.
   Ornamen berada DI BELAKANG teks, bukan sebagai background foto.
   ========================================================= */
.history-hero > .history-ref-ornaments{
  position:absolute!important;
  inset:0!important;
  z-index:1!important;
  overflow:hidden!important;
  pointer-events:none!important;
  opacity:1!important;
}
.history-ref-ornament-image{
  position:absolute!important;
  inset:0!important;
  width:100%!important;
  height:100%!important;
  display:block!important;
  object-fit:cover!important;
  object-position:center center!important;
  max-width:none!important;
  opacity:1!important;
}
.history-hero-inner{
  position:relative!important;
  z-index:4!important;
}
.history-title,.history-kicker,.history-vt-cta{
  position:relative!important;
  z-index:5!important;
}
@media(max-width:900px){
  .history-ref-ornament-image{object-position:center center!important;opacity:.88!important}
}
@media(max-width:560px){
  .history-ref-ornament-image{object-position:center center!important;opacity:.62!important}
}
</style>

@endpush

@section('content')
<div class="history-page">
  <!-- HERO -->
  <section class="history-hero">
    <div class="history-ref-ornaments" aria-hidden="true">
      <img
        src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}"
        alt=""
        class="history-ref-ornament-image"
        aria-hidden="true"
      >
    </div>
<div class="history-hero-inner">
      <div>
        <div class="history-kicker">Jejak Perjalanan</div>
        <h1 class="history-title">
          <span class="sejarah-white">SEJARAH</span>
          <span class="skaneda-gold">SKANEDA</span>
        </h1>
        <a class="history-vt-cta" href="#virtual-tour">
          <span class="history-vt-icon"><i class="fas fa-street-view"></i></span>
          <span><strong>Lihat Virtual Tour 360°</strong><small>Jelajahi SMK Negeri 2 Mojokerto</small></span>
          <i class="fas fa-arrow-right history-vt-arrow"></i>
        </a>
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
      <div class="eyebrow">Kepemimpinan</div>
      <h2 class="big-heading">Kepala Sekolah<br><span>dari Masa ke Masa</span></h2>
      <p class="principal-desc">Jejak kepemimpinan SKANEDA dalam satu rangkaian cerita — setiap periode membawa warna, perubahan, dan semangat yang berbeda.</p>
    </div>

    <div class="principal-stage" id="principalSlider">
      <button class="principal-arrow principal-prev" type="button" aria-label="Kepala sekolah sebelumnya">
        <i class="fas fa-chevron-left"></i>
      </button>

      <div class="principal-viewport">
        <div class="principal-track" id="principalTrack">

          <article class="principal-post" data-principal data-reveal>
            <div class="principal-post-head">
              <div class="principal-profile">
                <span class="principal-avatar"><i class="fas fa-school"></i></span>
                <div><strong>SMKN 2 Mojokerto</strong><span>Kepemimpinan · 1968—1985</span></div>
              </div>
              <span class="principal-more"><i class="fas fa-ellipsis-h"></i></span>
            </div>
            <div class="principal-photo">
              <img src="{{ asset('images/kepsek-nobg.png') }}" alt="Kepala Sekolah 1" loading="lazy">
            </div>
            <div class="principal-post-actions">
              <i class="far fa-heart"></i><i class="far fa-comment"></i><i class="far fa-paper-plane"></i>
              <i class="far fa-bookmark spacer"></i>
            </div>
            <div class="principal-post-body">
              <div class="principal-like">Kepala Sekolah 1</div>
              <p class="principal-caption"><strong>Periode kepemimpinan.</strong> Salah satu bagian awal dari perjalanan panjang SMK Negeri 2 Mojokerto.</p>
              <span class="principal-period">1968 &ndash; 1985</span>
            </div>
          </article>

          <article class="principal-post" data-principal data-reveal style="--d:1">
            <div class="principal-post-head">
              <div class="principal-profile">
                <span class="principal-avatar"><i class="fas fa-school"></i></span>
                <div><strong>SMKN 2 Mojokerto</strong><span>Kepemimpinan · 1985—2000</span></div>
              </div>
              <span class="principal-more"><i class="fas fa-ellipsis-h"></i></span>
            </div>
            <div class="principal-photo">
              <img src="{{ asset('images/kepsek-nobg.png') }}" alt="Kepala Sekolah 2" loading="lazy">
            </div>
            <div class="principal-post-actions">
              <i class="far fa-heart"></i><i class="far fa-comment"></i><i class="far fa-paper-plane"></i>
              <i class="far fa-bookmark spacer"></i>
            </div>
            <div class="principal-post-body">
              <div class="principal-like">Kepala Sekolah 2</div>
              <p class="principal-caption"><strong>Periode kepemimpinan.</strong> Melanjutkan fondasi dan pertumbuhan sekolah dari masa ke masa.</p>
              <span class="principal-period">1985 &ndash; 2000</span>
            </div>
          </article>

          <article class="principal-post" data-principal data-reveal style="--d:2">
            <div class="principal-post-head">
              <div class="principal-profile">
                <span class="principal-avatar"><i class="fas fa-school"></i></span>
                <div><strong>SMKN 2 Mojokerto</strong><span>Kepemimpinan · 2000—2015</span></div>
              </div>
              <span class="principal-more"><i class="fas fa-ellipsis-h"></i></span>
            </div>
            <div class="principal-photo">
              <img src="{{ asset('images/kepsek-nobg.png') }}" alt="Kepala Sekolah 3" loading="lazy">
            </div>
            <div class="principal-post-actions">
              <i class="far fa-heart"></i><i class="far fa-comment"></i><i class="far fa-paper-plane"></i>
              <i class="far fa-bookmark spacer"></i>
            </div>
            <div class="principal-post-body">
              <div class="principal-like">Kepala Sekolah 3</div>
              <p class="principal-caption"><strong>Periode kepemimpinan.</strong> Fase penting menuju sekolah vokasi yang semakin modern dan adaptif.</p>
              <span class="principal-period">2000 &ndash; 2015</span>
            </div>
          </article>

          <article class="principal-post" data-principal data-current data-reveal style="--d:3">
            <div class="principal-post-head">
              <div class="principal-profile">
                <span class="principal-avatar"><i class="fas fa-school"></i></span>
                <div><strong>SMKN 2 Mojokerto</strong><span>Kepemimpinan · 2015—Sekarang</span></div>
              </div>
              <span class="principal-more"><i class="fas fa-ellipsis-h"></i></span>
            </div>
            <div class="principal-photo">
              <img src="{{ asset('images/kepsek-nobg.png') }}" alt="Iswahyudi, S.ST. M.Pd" loading="lazy">
              <span class="principal-current">Saat Ini</span>
            </div>
            <div class="principal-post-actions">
              <i class="far fa-heart"></i><i class="far fa-comment"></i><i class="far fa-paper-plane"></i>
              <i class="far fa-bookmark spacer"></i>
            </div>
            <div class="principal-post-body">
              <div class="principal-like">Iswahyudi, S.ST. M.Pd</div>
              <p class="principal-caption"><strong>Kepala sekolah saat ini.</strong> Membawa SKANEDA terus bergerak menuju pendidikan vokasi yang unggul.</p>
              <span class="principal-period">2015 &ndash; Sekarang</span>
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

  <!-- VIRTUAL TOUR 360 — gaya Beranda -->
  <section class="vt-section" id="virtual-tour" aria-label="Virtual Tour 360 SMK Negeri 2 Mojokerto">
    <span class="vt-watermark" aria-hidden="true">360°</span>
    <div class="vt-decor-ring" aria-hidden="true"></div>
    <div class="vt-decor-dots" aria-hidden="true"></div>
    <div class="vt-inner">
      <div class="vt-media" data-reveal="left">
        <div class="vt-frame">
          <img src="{{ asset('images/hero-sekolah.jpg') }}" alt="Lingkungan SMK Negeri 2 Mojokerto — Virtual Tour 360 derajat" loading="lazy">
          <span class="vt-badge"><i class="fa-solid fa-street-view"></i> 360° Tour</span>
          <button class="vt-play" type="button" aria-label="Mulai Virtual Tour 360 derajat" onclick="document.getElementById('vtTourLink')?.click()"><i class="fa-solid fa-play"></i></button>
          <div class="vt-caption">
            <div><strong>Jelajahi Sekolah</strong><span>Kampus SMK Negeri 2 Mojokerto</span></div>
            <span class="vt-cam"><i class="fa-solid fa-camera"></i> 360°</span>
          </div>
        </div>
        <div class="vt-chip"><i class="fa-solid fa-compass"></i><div><strong>Virtual Tour 360°</strong><span>Interactive Campus Experience</span></div></div>
      </div>
      <div class="vt-copy">
        <div class="vt-kicker" data-reveal>Virtual Experience</div>
        <h2 class="vt-title" data-reveal>Jelajahi <span class="vt-gold">SMKN 2 Mojokerto</span><span class="vt-sub">Lihat Virtual Tour 360°</span></h2>
        <p class="vt-desc" data-reveal>Jelajahi lingkungan SMK Negeri 2 Mojokerto secara interaktif melalui Virtual Tour 360°. Rasakan suasana sekolah dari sudut pandangmu dan lihat fasilitas sekolah secara lebih dekat.</p>
        <div class="vt-feats" data-reveal><span class="vt-feat"><i class="fa-solid fa-check"></i> Interaktif</span><span class="vt-feat"><i class="fa-solid fa-check"></i> Panorama 360°</span><span class="vt-feat"><i class="fa-solid fa-check"></i> Akses Mudah</span></div>
        <a href="#" id="vtTourLink" class="vt-btn" data-reveal>Mulai Virtual Tour <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
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
    var cards = track.querySelectorAll('.principal-post');
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