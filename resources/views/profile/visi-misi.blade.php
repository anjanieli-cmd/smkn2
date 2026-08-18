@extends('layouts.app')

@section('title', 'Visi & Misi — SMK Negeri 2 Mojokerto')
@section('description', 'Visi, misi, tujuan, dan nilai-nilai SMK Negeri 2 Mojokerto: sekolah vokasi unggulan yang beriman, berkarakter, kompeten, dan berdaya saing global.')

@push('styles')
<style>
/* =========================================================
   VISI & MISI — PREMIUM EDITION
   Visual language: konsisten dengan Sejarah (navy/gold),
   foto gedung + overlay, watermark typography, ornamen
   geometris gaya Beranda, glassmorphism, scroll-reveal.
   ========================================================= */
.visi-page{background:#f7f9fc;color:#0d3a66;overflow:hidden}
.visi-page *{box-sizing:border-box}
.visi-shell{width:100%}

/* ---------- HERO: SAMA GAYA DENGAN HERO SEJARAH SKANEDA ---------- */
.visi-hero{
  position:relative;
  min-height:clamp(650px,82vh,820px);
  background:#fff;
  display:flex;
  align-items:center;
  overflow:hidden;
  isolation:isolate;
}
.visi-hero::before{
  content:"";
  position:absolute;
  left:0;right:0;top:0;height:7px;
  background:linear-gradient(90deg,#0d3a66 0 62%,#ff7a00 62%);
  z-index:8;
}
/* Watermark besar di belakang judul */
.visi-hero::after{
  content:"VISI MISI";
  position:absolute;
  z-index:0;
  left:1%;
  bottom:-1.5%;
  font-family:var(--font-display);
  font-size:clamp(8rem,20vw,19rem);
  font-weight:950;
  line-height:.75;
  letter-spacing:-.07em;
  color:rgba(13,58,102,.032);
  -webkit-text-stroke:1px rgba(255,122,0,.08);
  white-space:nowrap;
  pointer-events:none;
  user-select:none;
}
/* Ornamen memakai aset yang sama dengan hero Sejarah */
.visi-hero .hero-ornament{
  position:absolute;
  inset:0;
  z-index:1;
  pointer-events:none;
  overflow:hidden;
}
.visi-hero .hero-ornament img{
  position:absolute;
  width:100%;
  height:100%;
  object-fit:cover;
  object-position:center;
  opacity:.84;
  mix-blend-mode:multiply;
}
.visi-hero-inner{
  position:relative;
  z-index:4;
  width:min(1180px,calc(100% - 40px));
  margin:auto;
  display:block;
  padding:95px 0 75px;
}
.visi-hero-copy{max-width:790px}
.visi-kicker{
  display:inline-flex;
  align-items:center;
  gap:10px;
  padding:9px 14px;
  border:1px solid #ffd5b0;
  background:#fffaf5;
  border-radius:999px;
  color:#ff7a00;
  font-size:.68rem;
  font-weight:900;
  letter-spacing:.16em;
  text-transform:uppercase;
}
.visi-kicker::before{
  content:"";
  width:9px;height:9px;
  background:#ff7a00;
  border-radius:50%;
  box-shadow:0 0 0 6px rgba(255,122,0,.1);
}
.visi-title{
  margin:20px 0 0;
  font-family:var(--font-display);
  font-size:clamp(4.4rem,9.5vw,8.8rem);
  line-height:.79;
  letter-spacing:-.065em;
  font-weight:950;
  text-transform:uppercase;
  position:relative;
  text-shadow:none;
  animation:hdFadeUp .7s .1s var(--ease,ease) both;
}
.visi-title .visi-white{
  display:block;
  color:#0d3a66;
}
.visi-title .visi-gold{
  display:block;
  color:#ff7a00;
  background:none;
  -webkit-text-fill-color:#ff7a00;
  letter-spacing:-.055em;
}
.visi-lead{
  max-width:650px;
  margin:27px 0 0;
  color:#607388;
  font-size:1rem;
  line-height:1.8;
  animation:hdFadeUp .7s .26s var(--ease,ease) both;
}
.visi-hero-meta{
  display:flex;
  align-items:center;
  gap:13px;
  flex-wrap:wrap;
  margin-top:27px;
  animation:hdFadeUp .7s .4s var(--ease,ease) both;
}
.visi-pill{
  display:inline-flex;
  align-items:center;
  gap:9px;
  padding:13px 17px;
  background:#0d3a66;
  color:#fff;
  border:0;
  border-radius:15px;
  font-size:.72rem;
  font-weight:900;
  box-shadow:0 14px 32px rgba(13,58,102,.16);
  backdrop-filter:none;
}
.visi-pill i{color:#ffd15a}
@keyframes hdFadeUp{from{opacity:0;transform:translateY(26px)}to{opacity:1;transform:none}}

/* ---------- SECTION COMMON ---------- */
.visi-wide{width:min(1380px,92%);margin:auto}
.eyebrow{display:inline-flex;align-items:center;gap:.5rem;font-size:.74rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#0d3a66;margin-bottom:.85rem}
.eyebrow::before{content:"";width:26px;height:3px;border-radius:99px;background:linear-gradient(90deg,#0d3a66,#2f6fa8)}
.big-heading{font-family:var(--font-display);font-size:clamp(2.1rem,4.4vw,4.2rem);line-height:1.02;
  letter-spacing:.01em;margin:0;color:#0d3a66;text-shadow:0 2px 10px rgba(13,58,102,.06)}
.big-heading span{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}

/* ---------- VISI: kartu besar glassmorphism ---------- */
.visi-section{position:relative;padding:96px 0 110px;background:#fff;isolation:isolate}
.visi-card{position:relative;width:min(1080px,92%);margin:auto;padding:clamp(2.2rem,5vw,4rem);
  border-radius:28px;overflow:hidden;background:rgba(255,255,255,.72);border:1px solid rgba(13,58,102,.16);
  box-shadow:0 24px 60px rgba(13,58,102,.10);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);
  transition:transform .4s ease,box-shadow .4s ease,border-color .4s ease}
.visi-card:hover{transform:translateY(-8px);box-shadow:0 34px 74px rgba(13,58,102,.18);border-color:rgba(255,179,0,.4)}
.visi-card::before{content:"";position:absolute;top:0;left:0;width:100%;height:5px;
  background:linear-gradient(90deg,#0d3a66,#2f6fa8,#ffb300)}
.visi-card::after{content:"VISI";position:absolute;right:-14px;bottom:-46px;
  font-family:var(--font-display);font-size:11rem;line-height:1;font-weight:900;letter-spacing:.02em;
  color:rgba(13,58,102,.045);-webkit-text-stroke:1px rgba(13,58,102,.06);pointer-events:none;user-select:none}
.visi-card-inner{position:relative;z-index:2;text-align:center}
.visi-card-icon{width:74px;height:74px;margin:0 auto 1.3rem;border-radius:22px;
  background:linear-gradient(135deg,#0d3a66,#2f6fa8);color:#ffd54a;font-size:1.7rem;
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 16px 34px rgba(13,58,102,.3);transform:rotate(45deg)}
.visi-card-icon i{transform:rotate(-45deg)}
.visi-statement{font-family:var(--font-display);font-size:clamp(1.5rem,3vw,2.3rem);line-height:1.5;
  font-weight:700;color:#0d3a66;max-width:860px;margin:0 auto}
.visi-statement em{font-style:italic;
  background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.visi-tags{display:flex;justify-content:center;gap:.6rem;flex-wrap:wrap;margin-top:1.8rem}
.visi-tag{padding:.5rem .9rem;border:1px solid rgba(13,58,102,.16);border-radius:999px;
  background:rgba(47,111,168,.07);color:#0d3a66;font-size:.72rem;font-weight:800}
.visi-tag i{color:#ffb300;margin-right:.35rem}

/* ---------- MISI: grid kartu ---------- */
.misi-section{position:relative;padding:110px 0 120px;isolation:isolate;overflow:hidden;
  background:
    radial-gradient(circle at 8% 18%,rgba(47,111,168,.12) 0 2px,transparent 3px),
    radial-gradient(circle at 91% 27%,rgba(255,179,0,.16) 0 3px,transparent 4px),
    radial-gradient(circle at 13% 78%,rgba(47,111,168,.10) 0 2px,transparent 3px),
    linear-gradient(180deg,#f8fbfe 0%,#eef5fa 100%)}
.misi-section::after{content:"";position:absolute;left:-35px;top:180px;width:185px;height:185px;
  background-image:radial-gradient(circle,rgba(31,100,170,.45) 2.2px,transparent 3px);
  background-size:20px 20px;opacity:.65;pointer-events:none;z-index:0}
.misi-section::before{content:"";position:absolute;right:-20px;bottom:90px;width:175px;height:175px;
  background-image:radial-gradient(circle,rgba(255,179,0,.55) 2px,transparent 3px);
  background-size:19px 19px;opacity:.5;pointer-events:none;z-index:0}
.misi-head{width:min(1380px,92%);margin:0 auto 3.4rem;text-align:center;position:relative;z-index:2}
.misi-head .eyebrow{justify-content:center}
.misi-head .eyebrow::after{content:"\2022 \2022 \2022";color:#ffb300;letter-spacing:5px;font-size:12px;margin-left:.4rem}
.misi-head .big-heading{margin:0 auto}
.misi-desc{max-width:720px;margin:1.1rem auto 0;color:#5f7186;font-size:1rem;line-height:1.9}
.misi-grid{width:min(1240px,94%);margin:0 auto;display:grid;grid-template-columns:repeat(3,1fr);gap:1.4rem;position:relative;z-index:2}
.misi-card{position:relative;background:#fff;border:1px solid rgba(13,58,102,.14);border-radius:22px;
  padding:2rem 1.7rem 1.9rem;overflow:hidden;box-shadow:0 18px 42px rgba(13,58,102,.10);
  transition:transform .4s cubic-bezier(.22,.61,.36,1),box-shadow .4s ease,border-color .3s ease}
.misi-card:hover{transform:translateY(-9px);box-shadow:0 30px 62px rgba(13,58,102,.2);border-color:rgba(255,179,0,.45)}
.misi-card::before{content:"";position:absolute;top:0;left:0;width:100%;height:4px;
  background:linear-gradient(90deg,#0d3a66,#2f6fa8,#ffb300)}
.misi-num{position:absolute;right:14px;top:6px;font-family:var(--font-display);font-size:4.6rem;line-height:1;
  font-weight:900;color:rgba(13,58,102,.06);-webkit-text-stroke:1px rgba(13,58,102,.08);user-select:none}
.misi-icon{width:58px;height:58px;border-radius:17px;margin-bottom:1.1rem;
  background:linear-gradient(135deg,#0d3a66,#2f6fa8);color:#ffd54a;font-size:1.3rem;
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 12px 26px rgba(13,58,102,.26);transition:transform .35s ease}
.misi-card:hover .misi-icon{transform:rotate(-8deg) scale(1.08)}
.misi-title{font-family:var(--font-display);font-size:1.18rem;font-weight:800;color:#0d3a66;line-height:1.3;margin:0 0 .55rem}
.misi-text{font-size:.86rem;line-height:1.8;color:#718396;margin:0}

/* ---------- TUJUAN: band teal deep ---------- */
.tujuan-section{position:relative;padding:110px 0 120px;overflow:hidden;
  background:linear-gradient(135deg,#0b3558,#0d3a66 45%,#0d3a66);color:#fff;isolation:isolate}
.tujuan-section::before{content:"";position:absolute;width:520px;height:520px;right:-210px;top:-230px;
  border:1px solid rgba(255,255,255,.14);transform:rotate(45deg);
  box-shadow:0 0 0 35px rgba(13,58,102,.08),0 0 0 70px rgba(255,255,255,.03)}
.tujuan-section::after{content:"TUJUAN";position:absolute;left:-1%;bottom:-40px;
  font-family:var(--font-display);font-size:clamp(5rem,16vw,15rem);font-weight:900;line-height:1;
  letter-spacing:.04em;color:rgba(255,255,255,.045);-webkit-text-stroke:1px rgba(255,255,255,.06);
  pointer-events:none;white-space:nowrap;user-select:none}
.tujuan-inner{width:min(1180px,92%);margin:auto;position:relative;z-index:2}
.tujuan-inner .big-heading{color:#fff}
.tujuan-inner .big-heading span{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.tujuan-inner .eyebrow{color:#6fa8d0}
.tujuan-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.2rem;margin-top:2.6rem}
.tujuan-card{position:relative;padding:1.7rem 1.4rem;border:1px solid rgba(255,255,255,.14);border-radius:20px;
  background:rgba(255,255,255,.06);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);
  transition:transform .35s ease,background .35s ease,border-color .35s ease;overflow:hidden}
.tujuan-card:hover{transform:translateY(-7px);background:rgba(255,255,255,.12);border-color:rgba(255,213,74,.45)}
.tujuan-num{font-family:var(--font-display);font-size:2rem;font-weight:900;line-height:1;
  background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.tujuan-title{font-family:var(--font-display);font-size:1.05rem;font-weight:800;color:#fff;margin:.8rem 0 .45rem}
.tujuan-text{font-size:.8rem;line-height:1.7;color:rgba(235,245,253,.78);margin:0}

/* ---------- NILAI: grid kartu ---------- */
.nilai-section{position:relative;padding:110px 0 120px;background:#fff;overflow:hidden;isolation:isolate}
.nilai-section::before{content:"";position:fixed;right:-110px;top:18%;width:230px;height:230px;
  border:2px solid rgba(13,58,102,.14);transform:rotate(45deg);z-index:0;pointer-events:none}
.nilai-section::after{content:"";position:fixed;left:-95px;bottom:10%;width:190px;height:190px;
  border:2px solid rgba(47,111,168,.14);border-radius:28px;transform:rotate(25deg);z-index:0;pointer-events:none}
.nilai-head{width:min(1380px,92%);margin:0 auto 3.2rem;text-align:center;position:relative;z-index:2}
.nilai-head .eyebrow{justify-content:center}
.nilai-head .eyebrow::after{content:"\2022 \2022 \2022";color:#ffb300;letter-spacing:5px;font-size:12px;margin-left:.4rem}
.nilai-head .big-heading{margin:0 auto}
.nilai-grid{width:min(1180px,92%);margin:auto;display:grid;grid-template-columns:repeat(3,1fr);gap:1.3rem;position:relative;z-index:2}
.nilai-card{position:relative;background:#fff;border:1px solid rgba(13,58,102,.14);border-radius:20px;
  padding:1.8rem 1.6rem;box-shadow:0 16px 38px rgba(13,58,102,.08);overflow:hidden;
  transition:transform .4s ease,box-shadow .4s ease,border-color .3s ease}
.nilai-card:hover{transform:translateY(-8px);box-shadow:0 28px 58px rgba(13,58,102,.18);border-color:rgba(255,179,0,.45)}
.nilai-card::after{content:"";position:absolute;right:-22px;bottom:-26px;width:80px;height:80px;
  border:2px solid rgba(13,58,102,.18);transform:rotate(45deg);pointer-events:none}
.nilai-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem}
.nilai-icon{width:52px;height:52px;border-radius:15px;background:rgba(47,111,168,.10);
  border:1px solid rgba(47,111,168,.2);color:#0d3a66;font-size:1.15rem;
  display:flex;align-items:center;justify-content:center;transition:transform .35s ease,background .35s ease}
.nilai-card:hover .nilai-icon{background:linear-gradient(135deg,#0d3a66,#2f6fa8);color:#ffd54a;transform:rotate(-8deg)}
.nilai-no{font-family:var(--font-display);font-size:1.6rem;font-weight:900;line-height:1;
  background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.nilai-title{font-family:var(--font-display);font-size:1.12rem;font-weight:800;color:#0d3a66;margin:0 0 .4rem}
.nilai-text{font-size:.83rem;line-height:1.75;color:#718396;margin:0}

/* ---------- CTA akhir ---------- */
.visi-cta{position:relative;padding:90px 0 100px;overflow:hidden;text-align:center;isolation:isolate;
  background:linear-gradient(135deg,#0b3558,#0d3a66 45%,#0d3a66);color:#fff}
.visi-cta::after{content:"#SMKN2BISA";position:absolute;left:50%;bottom:-34px;transform:translateX(-50%);
  font-family:var(--font-display);font-size:clamp(3.4rem,11vw,9rem);font-weight:900;line-height:1;
  letter-spacing:.05em;color:rgba(255,255,255,.045);-webkit-text-stroke:1px rgba(255,255,255,.06);
  pointer-events:none;white-space:nowrap;user-select:none}
.visi-cta-inner{position:relative;z-index:2;width:min(800px,92%);margin:auto}
.visi-cta h2{font-family:var(--font-display);font-size:clamp(1.9rem,4vw,3.4rem);line-height:1.05;margin:0 0 1rem}
.visi-cta h2 span{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.visi-cta p{color:rgba(235,245,253,.8);line-height:1.85;max-width:620px;margin:0 auto 2rem}
.visi-cta-btn{display:inline-flex;align-items:center;gap:.6rem;padding:.95rem 2rem;border-radius:999px;
  background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:.92rem;font-weight:900;
  text-decoration:none;box-shadow:0 16px 36px rgba(255,138,0,.4);
  transition:transform .3s ease,box-shadow .3s ease}
.visi-cta-btn:hover{transform:translateY(-4px);box-shadow:0 22px 46px rgba(255,138,0,.5)}
.visi-cta-btn i{transition:transform .3s ease}
.visi-cta-btn:hover i{transform:translateX(5px)}

/* ---------- SCROLL REVEAL ---------- */
[data-reveal]{opacity:0;transform:translateY(36px);
  transition:opacity .85s cubic-bezier(.22,.61,.36,1),transform .85s cubic-bezier(.22,.61,.36,1);
  will-change:opacity,transform}
[data-reveal="left"]{transform:translateX(-46px)}
[data-reveal="right"]{transform:translateX(46px)}
[data-reveal].revealed{opacity:1;transform:none}
[data-reveal]{transition-delay:calc(var(--d,0)*90ms)}

/* ---------- ORNAMEN STYLE BERANDA (navy/gold) ---------- */
.visi-page{position:relative}
.home-orn{position:absolute;inset:0;z-index:0;pointer-events:none;overflow:hidden}
.home-orn .ho-chevron{position:absolute;width:360px;height:360px;
  border-top:2px solid rgba(13,58,102,.11);border-right:2px solid rgba(13,58,102,.11);transform:rotate(45deg)}
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

/* Posisi ornamen per section */
.visi-hero .home-orn .ho-chevron{left:-150px;bottom:-60px;border-color:rgba(255,255,255,.10)}
.visi-hero .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.visi-hero .home-orn .ho-line{right:-80px;top:22%;opacity:.22}
.visi-hero .home-orn .ho-dots{right:6%;bottom:14%;opacity:.3}
.visi-hero .home-orn .ho-ring{left:44%;bottom:-90px;border-color:rgba(255,255,255,.12)}
.visi-hero .home-orn .ho-gold{right:16%;top:20%}
.visi-hero .home-orn .ho-square{left:12%;top:22%}

.visi-section .home-orn .ho-chevron{right:-130px;top:70px}
.visi-section .home-orn .ho-line{left:-55px;bottom:75px}
.visi-section .home-orn .ho-dots{right:18%;bottom:55px}
.visi-section .home-orn .ho-ring{left:-80px;top:35%}
.visi-section .home-orn .ho-gold{right:12%;top:26%}
.visi-section .home-orn .ho-square{left:13%;bottom:18%}

.misi-section .home-orn .ho-chevron{right:-145px;top:45px}
.misi-section .home-orn .ho-line{left:-80px;top:170px}
.misi-section .home-orn .ho-dots{left:3%;bottom:100px}
.misi-section .home-orn .ho-ring{right:8%;bottom:90px}
.misi-section .home-orn .ho-gold{right:16%;top:22%}
.misi-section .home-orn .ho-square{left:11%;top:15%}
.misi-section .home-orn .ho-corner{right:3%;bottom:8%;transform:rotate(180deg)}

.tujuan-section .home-orn .ho-chevron{right:-125px;top:-100px;border-color:rgba(255,255,255,.12)}
.tujuan-section .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.tujuan-section .home-orn .ho-line{left:-80px;bottom:80px;opacity:.22}
.tujuan-section .home-orn .ho-dots{right:7%;bottom:80px;opacity:.2}
.tujuan-section .home-orn .ho-ring{left:-80px;top:25%;border-color:rgba(255,255,255,.10)}
.tujuan-section .home-orn .ho-gold{right:22%;bottom:18%}
.tujuan-section .home-orn .ho-square{left:14%;top:16%;border-color:rgba(255,213,74,.25)}

.nilai-section .home-orn .ho-chevron{right:-150px;top:20px}
.nilai-section .home-orn .ho-line{left:-80px;bottom:100px}
.nilai-section .home-orn .ho-dots{left:4%;top:125px}
.nilai-section .home-orn .ho-ring{right:3%;bottom:70px}
.nilai-section .home-orn .ho-gold{left:10%;top:24%}
.nilai-section .home-orn .ho-square{right:15%;top:20%}

.visi-cta .home-orn .ho-chevron{left:-120px;bottom:-80px;border-color:rgba(255,255,255,.10)}
.visi-cta .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.visi-cta .home-orn .ho-dots{left:8%;top:30%;opacity:.22}
.visi-cta .home-orn .ho-ring{right:-70px;top:20%;border-color:rgba(255,255,255,.10)}
.visi-cta .home-orn .ho-gold{left:20%;bottom:26%}

/* ---------- CTA REDESIGN: CARD SEPERTI STRUKTUR ORGANISASI ---------- */
.visi-cta{
  position:relative;
  margin:0;
  padding:82px 0 96px;
  overflow:hidden;
  text-align:center;
  isolation:isolate;
  background:#f4f8fc;
  color:#fff;
}
.visi-cta::before{
  content:"";
  position:absolute;
  inset:0;
  background:
    linear-gradient(135deg,rgba(13,58,102,.025),transparent 55%),
    radial-gradient(circle at 8% 45%,rgba(13,58,102,.06),transparent 24%),
    radial-gradient(circle at 92% 35%,rgba(255,181,0,.07),transparent 22%);
  pointer-events:none;
}
.visi-cta::after{
  content:"#SMKN2BISA";
  position:absolute;
  left:50%;
  bottom:42px;
  transform:translateX(-50%);
  font-family:var(--font-display);
  font-size:clamp(4rem,12vw,10rem);
  font-weight:900;
  line-height:1;
  letter-spacing:.04em;
  color:rgba(13,58,102,.045);
  -webkit-text-stroke:1px rgba(13,58,102,.055);
  pointer-events:none;
  white-space:nowrap;
  user-select:none;
}
.visi-cta-inner{
  position:relative;
  z-index:3;
  width:min(1116px,84%);
  min-height:350px;
  margin:0 auto;
  padding:68px 7% 64px;
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:center;
  border-radius:28px;
  overflow:hidden;
  background:linear-gradient(135deg,#0b3558 0%,#0d3a66 48%,#123f6d 100%);
  box-shadow:0 24px 55px rgba(13,58,102,.18);
  border:1px solid rgba(255,255,255,.08);
}
.visi-cta-inner::before{
  content:"";
  position:absolute;
  width:230px;
  height:230px;
  right:-105px;
  top:48px;
  border-radius:50%;
  border:1px solid rgba(255,255,255,.08);
  box-shadow:0 0 0 28px rgba(255,255,255,.018),0 0 0 58px rgba(255,255,255,.012);
}
.visi-cta-inner::after{
  content:"";
  position:absolute;
  width:170px;
  height:170px;
  left:-65px;
  bottom:-70px;
  border-radius:50%;
  border:1px solid rgba(255,213,74,.12);
  box-shadow:0 0 0 24px rgba(255,213,74,.018);
}
.visi-cta h2{
  position:relative;
  z-index:2;
  font-family:var(--font-display);
  font-size:clamp(2.25rem,4.6vw,4rem);
  font-weight:900;
  line-height:1.08;
  letter-spacing:-.025em;
  margin:0 0 1rem;
  color:#fff;
}
.visi-cta h2 span{
  display:block;
  background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff8a00);
  -webkit-background-clip:text;
  background-clip:text;
  -webkit-text-fill-color:transparent;
  color:transparent;
}
.visi-cta p{
  position:relative;
  z-index:2;
  color:rgba(235,245,253,.82);
  line-height:1.8;
  max-width:690px;
  margin:0 auto 2rem;
  font-size:1rem;
}
.visi-cta-btn{
  position:relative;
  z-index:2;
  display:inline-flex;
  align-items:center;
  gap:.65rem;
  padding:1rem 2.1rem;
  border-radius:999px;
  background:linear-gradient(135deg,#ffd54a,#ff8a00);
  color:#0d3a66;
  font-size:.94rem;
  font-weight:900;
  text-decoration:none;
  box-shadow:0 14px 32px rgba(255,138,0,.34);
  transition:transform .3s ease,box-shadow .3s ease;
}
.visi-cta-btn:hover{
  transform:translateY(-4px) scale(1.02);
  box-shadow:0 20px 42px rgba(255,138,0,.46);
}
.visi-cta-btn i{transition:transform .3s ease}
.visi-cta-btn:hover i{transform:translateX(5px)}

/* Konten di atas ornamen */
.visi-section>*:not(.home-orn),
.misi-section>*:not(.home-orn),
.tujuan-section>*:not(.home-orn),
.nilai-section>*:not(.home-orn),
.visi-cta>*:not(.home-orn){position:relative;z-index:2}

/* ---------- RESPONSIVE ---------- */
@media(max-width:950px){
  .visi-hero-inner{width:min(100% - 40px,1180px)}
  .misi-grid{grid-template-columns:1fr 1fr}
  .tujuan-grid{grid-template-columns:1fr 1fr}
  .nilai-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:700px){
  .visi-cta{padding:60px 0 72px}
  .visi-cta-inner{width:88%;min-height:330px;padding:54px 8% 50px;border-radius:24px}
  .visi-cta h2{font-size:clamp(2rem,9vw,3rem)}
  .visi-cta p{font-size:.92rem;line-height:1.75}
  .visi-cta-btn{width:auto;max-width:100%;justify-content:center}

  .visi-hero{min-height:620px}
  .visi-hero-inner{width:min(100% - 28px,1180px);padding:85px 0 55px}
  .visi-hero::after{font-size:8rem;opacity:.7}
  .visi-title{font-size:clamp(3.5rem,16vw,6rem)}
  .visi-lead{font-size:.88rem}
  .misi-grid,.nilai-grid{grid-template-columns:1fr}
  .tujuan-grid{grid-template-columns:1fr 1fr;gap:.8rem}
  .visi-section,.misi-section,.tujuan-section,.nilai-section{padding:85px 0 90px}
  .visi-card{padding:2rem 1.4rem}
  .visi-card::after{font-size:7rem;right:0}
  .home-orn .ho-chevron{width:220px;height:220px}
  .home-orn .ho-dots{width:80px;height:80px;background-size:14px 14px}
  .home-orn .ho-ring{width:110px;height:110px}
  .home-orn .ho-line{width:190px}
  .home-orn .ho-square{width:42px;height:42px}
  .home-orn .ho-corner{width:70px;height:70px}
  .visi-hero .home-orn .ho-chevron{left:-120px;bottom:-40px}
  [data-reveal]{opacity:1;transform:none}
}
</style>
@endpush

@section('content')
<div class="visi-page">
  <!-- HERO -->
  <section class="visi-hero">
    <div class="hero-ornament" aria-hidden="true">
      <img src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}" alt="">
    </div>

    <div class="visi-hero-inner">
      <div class="visi-hero-copy" data-reveal>
        <div class="visi-kicker">Arah &amp; langkah kami</div>
        <h1 class="visi-title">
          <span class="visi-white">VISI &amp;</span>
          <span class="visi-gold">MISI SKANEDA</span>
        </h1>
        <p class="visi-lead">
          Landasan dan arah SMK Negeri 2 Mojokerto dalam menghasilkan sumber daya manusia yang berkarakter, kompeten, siap kerja, mampu berwirausaha, dan mampu bersaing di era globalisasi.
        </p>
        <div class="visi-hero-meta">
          <span class="visi-pill"><i class="fas fa-bullseye"></i> Visi &amp; Misi</span>
          <span class="visi-pill"><i class="fas fa-flag"></i> Tujuan Sekolah</span>
          <span class="visi-pill"><i class="fas fa-gem"></i> Nilai-nilai</span>
        </div>
      </div>
    </div>
  </section>

  <!-- VISI -->
  <section class="visi-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="visi-card" data-reveal>
      <div class="visi-card-inner">
        <div class="visi-card-icon"><i class="fas fa-eye"></i></div>
        <div class="eyebrow">Visi Sekolah</div>
        <p class="visi-statement">
          &ldquo;Menghasilkan Sumber Daya Manusia (SDM) yang <em>berkarakter, kompeten, siap kerja,</em> serta mampu <em>berwirausaha dan bersaing di era globalisasi.</em>&rdquo;
        </p>
        <div class="visi-tags">
          <span class="visi-tag"><i class="fas fa-check"></i> Berkarakter</span>
          <span class="visi-tag"><i class="fas fa-check"></i> Kompeten</span>
          <span class="visi-tag"><i class="fas fa-check"></i> Siap Kerja</span>
          <span class="visi-tag"><i class="fas fa-check"></i> Berwirausaha</span>
        </div>
      </div>
    </div>
  </section>

  <!-- MISI -->
  <section class="misi-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="misi-head" data-reveal>
      <div>
        <div class="eyebrow">Langkah kami</div>
        <h2 class="big-heading">Misi <span>Sekolah</span></h2>
      </div>
      <p class="misi-desc">Tiga langkah utama yang menjadi dasar SMK Negeri 2 Mojokerto dalam meningkatkan mutu pendidikan dan menyiapkan lulusan yang profesional.</p>
    </div>

    <div class="misi-grid">
      <article class="misi-card" data-reveal>
        <span class="misi-num">01</span>
        <div class="misi-icon"><i class="fas fa-book-open"></i></div>
        <h3 class="misi-title">Pendidikan Berorientasi Mutu</h3>
        <p class="misi-text">Mengembangkan sistem pendidikan yang berorientasi pada mutu, dengan tetap berakar pada norma dan nilai budaya bangsa Indonesia.</p>
      </article>
      <article class="misi-card" data-reveal style="--d:1">
        <span class="misi-num">02</span>
        <div class="misi-icon"><i class="fas fa-handshake"></i></div>
        <h3 class="misi-title">Sinergi dengan Dunia Usaha &amp; Industri</h3>
        <p class="misi-text">Meningkatkan layanan prima dan membangun sinergi dengan masyarakat serta dunia usaha dan industri untuk memenuhi kebutuhan tenaga kerja secara profesional.</p>
      </article>
      <article class="misi-card" data-reveal style="--d:2">
        <span class="misi-num">03</span>
        <div class="misi-icon"><i class="fas fa-user-graduate"></i></div>
        <h3 class="misi-title">Lulusan Cerdas &amp; Kompeten</h3>
        <p class="misi-text">Mewujudkan tamatan yang cerdas, kompeten, memiliki etos kerja, dan siap bersaing serta beradaptasi menghadapi tuntutan era globalisasi.</p>
      </article>
    </div>
  </section>

  <!-- TUJUAN -->
  <section class="tujuan-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="tujuan-inner">
      <div data-reveal>
        <div class="eyebrow">Yang ingin kami capai</div>
        <h2 class="big-heading">Tujuan <span>Sekolah</span></h2>
      </div>
      <div class="tujuan-grid">
        <div class="tujuan-card" data-reveal>
          <div class="tujuan-num">01</div>
          <div class="tujuan-title">Lulusan Siap Kerja</div>
          <p class="tujuan-text">Menghasilkan lulusan yang kompeten dan terserap di dunia kerja maupun melanjutkan ke jenjang pendidikan tinggi.</p>
        </div>
        <div class="tujuan-card" data-reveal style="--d:1">
          <div class="tujuan-num">02</div>
          <div class="tujuan-title">Layanan Vokasi Berkualitas</div>
          <p class="tujuan-text">Memberikan layanan pendidikan vokasi yang bermutu, profesional, dan berorientasi pada kebutuhan industri.</p>
        </div>
        <div class="tujuan-card" data-reveal style="--d:2">
          <div class="tujuan-num">03</div>
          <div class="tujuan-title">Digitalisasi &amp; Sarana Modern</div>
          <p class="tujuan-text">Mengembangkan sarana prasarana dan sistem digital sekolah yang mendukung pembelajaran modern.</p>
        </div>
        <div class="tujuan-card" data-reveal style="--d:3">
          <div class="tujuan-num">04</div>
          <div class="tujuan-title">Budaya Prestasi</div>
          <p class="tujuan-text">Menumbuhkan budaya berprestasi akademik, non-akademik, dan karya inovasi di kalangan siswa dan guru.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- NILAI -->
  <section class="nilai-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="nilai-head" data-reveal>
      <div>
        <div class="eyebrow">Budaya sekolah</div>
        <h2 class="big-heading">Nilai-nilai <span>Utama</span></h2>
      </div>
      <p class="misi-desc">Nilai-nilai yang menjadi budaya kerja seluruh warga sekolah.</p>
    </div>

    <div class="nilai-grid">
      <article class="nilai-card" data-reveal>
        <div class="nilai-top"><div class="nilai-icon"><i class="fas fa-mosque"></i></div><span class="nilai-no">01</span></div>
        <h3 class="nilai-title">Iman &amp; Takwa</h3>
        <p class="nilai-text">Menjadikan nilai keagamaan sebagai pondasi sikap dan perilaku sehari-hari.</p>
      </article>
      <article class="nilai-card" data-reveal style="--d:1">
        <div class="nilai-top"><div class="nilai-icon"><i class="fas fa-briefcase"></i></div><span class="nilai-no">02</span></div>
        <h3 class="nilai-title">Profesionalisme</h3>
        <p class="nilai-text">Bekerja dengan dedikasi, disiplin, dan tanggung jawab dalam setiap tugas.</p>
      </article>
      <article class="nilai-card" data-reveal style="--d:2">
        <div class="nilai-top"><div class="nilai-icon"><i class="fas fa-lightbulb"></i></div><span class="nilai-no">03</span></div>
        <h3 class="nilai-title">Kreativitas</h3>
        <p class="nilai-text">Berani berpikir baru, berinovasi, dan menghasilkan karya yang bermanfaat.</p>
      </article>
      <article class="nilai-card" data-reveal style="--d:3">
        <div class="nilai-top"><div class="nilai-icon"><i class="fas fa-people-group"></i></div><span class="nilai-no">04</span></div>
        <h3 class="nilai-title">Kolaborasi</h3>
        <p class="nilai-text">Membangun sinergi antarsiswa, guru, dan mitra industri untuk hasil terbaik.</p>
      </article>
      <article class="nilai-card" data-reveal style="--d:4">
        <div class="nilai-top"><div class="nilai-icon"><i class="fas fa-scale-balanced"></i></div><span class="nilai-no">05</span></div>
        <h3 class="nilai-title">Integritas</h3>
        <p class="nilai-text">Menjunjung kejujuran, konsistensi, dan etika dalam segala tindakan.</p>
      </article>
      <article class="nilai-card" data-reveal style="--d:5">
        <div class="nilai-top"><div class="nilai-icon"><i class="fas fa-seedling"></i></div><span class="nilai-no">06</span></div>
        <h3 class="nilai-title">Kewirausahaan</h3>
        <p class="nilai-text">Menanamkan keberanian mengambil peluang dan kemandirian ekonomi.</p>
      </article>
    </div>
  </section>

  <!-- CTA -->
  <section class="visi-cta">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="visi-cta-inner" data-reveal>
      <h2>Bergabunglah bersama <span>SKANEDA!</span></h2>
      <p>Wujudkan masa depanmu bersama SMK Negeri 2 Mojokerto — sekolah vokasi unggulan yang siap membentuk generasi beriman, berkarakter, dan berdaya saing global.</p>
      <a href="{{ route('home') }}#ppdb" class="visi-cta-btn"><i class="fas fa-graduation-cap"></i> Info PPDB 2026/2027 <i class="fas fa-arrow-right"></i></a>
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
@endpush