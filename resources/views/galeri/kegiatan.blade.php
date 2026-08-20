@extends('layouts.app')

@section('title', 'Kegiatan — SMK Negeri 2 Mojokerto')
@section('description', 'Kegiatan SKANEDA — School Activity Journal SMK Negeri 2 Mojokerto. Dokumentasi momen, kegiatan, dan pengalaman yang membentuk keluarga besar sekolah.')

@push('styles')
<style>
/* =========================================================
   KEGIATAN SKANEDA — SCHOOL ACTIVITY JOURNAL
   Halaman baru. Hero, header (layouts.app) & footer TIDAK
   diubah — identik dengan halaman referensi lain.
   Visual language: navy #0d3a66, biru #2f6fa8, gold
   #ffd54a/#ffb300, Sora display. Konsep: photo journal +
   school magazine + activity gallery — fokus FOTO kegiatan.
   ========================================================= */
.kg-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}
.kg-page *{box-sizing:border-box}

/* ---------- HERO: identik 100% dengan hero Ekstrakurikuler (light theme, watermark) ---------- */
.kg-hero{position:relative;min-height:clamp(560px,72vh,740px);display:flex;align-items:center;overflow:hidden;
  background:#fff;color:#0d3a66;isolation:isolate}
.kg-hero::after{content:"KEGIATAN";position:absolute;z-index:0;left:2%;top:58%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(3.4rem,11.5vw,11.5rem);font-weight:900;line-height:.78;
  letter-spacing:.01em;color:rgba(13,58,102,.035);-webkit-text-stroke:1px rgba(255,122,0,.09);
  pointer-events:none;white-space:nowrap;user-select:none}
.kg-ref-ornaments{position:absolute!important;inset:0;z-index:1;overflow:hidden;pointer-events:none;opacity:1}
.kg-ref-ornament-image{position:absolute!important;inset:0;width:100%;height:100%;display:block;
  object-fit:cover;object-position:center center;max-width:none;opacity:1}
.kg-hero-inner{position:relative;z-index:4;width:100%;max-width:1500px;margin:0 auto;
  padding:clamp(3.6rem,9vh,6rem) clamp(1.25rem,4.2vw,4.5rem) clamp(3.2rem,7vh,5rem);display:block}

.kg-kicker{position:relative;z-index:5;display:inline-flex;align-items:center;gap:.65rem;font-size:.72rem;
  font-weight:900;letter-spacing:.18em;text-transform:uppercase;color:#ff6f00;margin-bottom:1.2rem;
  padding:.55rem .85rem;border:1px solid rgba(255,111,0,.18);border-radius:999px;background:#fffaf5}
.kg-kicker::before{content:"";width:9px;height:9px;border-radius:50%;background:#ff6f00;
  box-shadow:0 0 0 6px rgba(255,111,0,.10)}

/* ---------- TITLE: Kegiatan navy, Skaneda kuning-oranye ---------- */
.kg-title{position:relative;z-index:5;font-family:var(--font-display);font-size:clamp(3.6rem,9vw,8rem);
  line-height:.86;letter-spacing:-.03em;margin:0;max-width:900px;text-transform:uppercase;
  text-shadow:none;animation:hdFadeUp .7s .1s var(--ease, ease) both}
.kg-title .kg-white{color:#0d3a66;display:block}
.kg-title .kg-gold{display:block;
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent;
  text-shadow:none;letter-spacing:-.02em}
.kg-lead{position:relative;z-index:5;font-size:1rem;line-height:1.8;color:#52657a;max-width:640px;
  margin:1.6rem 0 0;animation:hdFadeUp .7s .26s var(--ease, ease) both}
.kg-hero-meta{position:relative;z-index:5;display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;
  animation:hdFadeUp .7s .4s var(--ease, ease) both}
.kg-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;
  border:1px solid rgba(13,58,102,.12);background:#fff;border-radius:999px;color:#0d3a66;
  font-size:.72rem;font-weight:800;box-shadow:0 8px 24px rgba(13,58,102,.06)}
.kg-pill i{color:#ff7a00}

@media(min-width:1050px){.kg-hero-inner{padding-right:40%}}
@media(max-width:1050px){.kg-hero-inner{padding-right:1.25rem}.kg-ref-ornaments{opacity:.72}}
@media(max-width:900px){.kg-title{font-size:clamp(3.2rem,10.5vw,6rem)}.kg-ref-ornament-image{opacity:.88}}
@media(max-width:700px){.kg-hero{align-items:flex-start;min-height:0}
  .kg-hero-inner{width:90%;padding:clamp(3rem,8vh,4.5rem) 5% 3.2rem}
  .kg-hero::after{font-size:clamp(3.2rem,20vw,5.4rem);opacity:.6;left:-2%}
  .kg-title{font-size:clamp(2.6rem,12vw,3.8rem)}}
@media(max-width:560px){.kg-ref-ornament-image{opacity:.62}}

/* ---------- HOME-ORN (ornamen geometris, IDENTIK referensi) ---------- */
.home-orn{position:absolute;inset:0;z-index:0;pointer-events:none;overflow:hidden}
.home-orn .ho-chevron{position:absolute;width:360px;height:360px;
  border:1px solid rgba(13,58,102,.16);transform:rotate(45deg);border-radius:18px}
.home-orn .ho-chevron::after{content:"";position:absolute;inset:34px;
  border:1px solid rgba(47,111,168,.16);border-radius:12px}
.home-orn .ho-line{position:absolute;width:310px;height:2px;background:rgba(13,58,102,.12)}
.home-orn .ho-line::after{content:"";position:absolute;left:70px;top:11px;width:190px;height:1px;background:rgba(47,111,168,.16)}
.home-orn .ho-dots{position:absolute;width:125px;height:125px;opacity:.5;
  background-image:radial-gradient(rgba(13,58,102,.4) 1.6px,transparent 1.7px);background-size:16px 16px}
.home-orn .ho-ring{position:absolute;width:170px;height:170px;border:1px solid rgba(13,58,102,.13);border-radius:50%}
.home-orn .ho-ring::before{content:"";position:absolute;inset:22px;border:1px dashed rgba(47,111,168,.18);border-radius:50%}
.home-orn .ho-gold{position:absolute;width:52px;height:8px;border-radius:99px;
  background:linear-gradient(90deg,#ffd54a,#ffb300)}
.home-orn .ho-square{position:absolute;width:58px;height:58px;border:2px solid rgba(255,179,0,.32);transform:rotate(45deg)}
.home-orn .ho-square::before{content:"";position:absolute;inset:10px;border:1px solid rgba(13,58,102,.18)}
.home-orn .ho-corner{position:absolute;width:110px;height:110px;
  border-top:2px solid rgba(13,58,102,.22);border-left:2px solid rgba(13,58,102,.22)}
.home-orn .ho-corner::after{content:"";position:absolute;left:18px;bottom:18px;width:46px;height:3px;
  background:rgba(255,179,0,.4)}
/* ---------- SHELL SECTION ---------- */
.kg-sec{position:relative;padding:clamp(4.5rem,9vw,7.5rem) clamp(1.5rem,5vw,5.5rem)}
.kg-container{max-width:1240px;margin:0 auto;position:relative;z-index:2}
.kg-eyebrow{display:inline-flex;align-items:center;gap:.6rem;font-size:.72rem;font-weight:800;
  letter-spacing:.2em;text-transform:uppercase;color:#2f6fa8;margin-bottom:.7rem}
.kg-eyebrow::before{content:"";width:26px;height:2px;background:linear-gradient(90deg,#ffd54a,#ffb300)}
.kg-eyebrow--gold{color:#b8860b}
.kg-section-title{font-family:var(--font-display);font-weight:900;font-size:clamp(2.2rem,4vw,3.8rem);
  line-height:.98;letter-spacing:-.02em;color:#0d3a66;margin:0}
.kg-section-title em{font-style:normal;color:transparent;background:linear-gradient(135deg,#ffd54a,#ff8a00);
  -webkit-background-clip:text;background-clip:text}
.kg-section-sub{font-size:.95rem;line-height:1.75;color:#4a6079;max-width:600px;margin-top:.9rem}
.kg-rule{height:3px;width:74px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ffb300);margin:1rem 0 0}

/* ---------- ORNAMEN EDITORIAL (playful — berbeda dari Roadmap/Sejarah) ---------- */
.kg-orn{position:absolute;inset:0;pointer-events:none;overflow:hidden;z-index:0}
.kg-orn .ko-circle{position:absolute;width:120px;height:120px;border:1px solid rgba(13,58,102,.14);border-radius:50%}
.kg-orn .ko-circle::after{content:"";position:absolute;inset:18px;border:1px dashed rgba(255,179,0,.30);border-radius:50%}
.kg-orn .ko-dots{position:absolute;width:110px;height:110px;opacity:.55;
  background-image:radial-gradient(rgba(13,58,102,.35) 1.5px,transparent 1.6px);background-size:14px 14px}
.kg-orn .ko-block{position:absolute;width:46px;height:10px;border-radius:2px;
  background:linear-gradient(90deg,#ffd54a,#ffb300);opacity:.8}
.kg-orn .ko-stamp{position:absolute;display:flex;align-items:center;gap:.55rem;
  font-size:.64rem;font-weight:900;letter-spacing:.22em;text-transform:uppercase;color:rgba(13,58,102,.35);
  border:1px solid rgba(13,58,102,.16);border-radius:99px;padding:.45rem .9rem;background:rgba(255,255,255,.5)}
.kg-orn .ko-stamp i{color:#b8860b}
.kg-orn .ko-grid{position:absolute;width:180px;height:140px;opacity:.5;
  background-image:linear-gradient(rgba(13,58,102,.12) 1px,transparent 1px),
    linear-gradient(90deg,rgba(13,58,102,.12) 1px,transparent 1px);background-size:22px 22px}
.kg-orn .ko-line{position:absolute;width:230px;height:1px;background:rgba(13,58,102,.2)}
.kg-orn .ko-line::after{content:"";position:absolute;left:70px;top:8px;width:150px;height:1px;background:rgba(255,179,0,.5)}

/* =========================================================
   1. PEMBUKA AKTIVITAS SKANEDA (editorial 2 kolom)
   ========================================================= */
.kg-intro{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,.85fr);gap:clamp(2rem,5vw,5rem);align-items:center}
.kg-intro-art{position:relative;display:flex;flex-direction:column;gap:1.4rem;align-items:flex-start}
.kg-intro-art .kg-eyebrow{margin-bottom:0}
.kg-stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-top:.5rem}
.kg-stat{background:#fff;border:1px solid rgba(13,58,102,.10);border-radius:18px;padding:1.15rem 1rem;
  position:relative;overflow:hidden;transition:transform .35s ease,box-shadow .35s ease,border-color .35s ease}
.kg-stat::before{content:"";position:absolute;left:0;top:0;bottom:0;width:4px;
  background:linear-gradient(180deg,#ffd54a,#ffb300);opacity:0;transition:opacity .35s ease}
.kg-stat:hover{transform:translateY(-5px);box-shadow:0 16px 34px rgba(13,58,102,.10);border-color:rgba(255,179,0,.45)}
.kg-stat:hover::before{opacity:1}
.kg-stat-num{font-family:var(--font-display);font-weight:900;font-size:clamp(1.7rem,3vw,2.4rem);
  line-height:1;color:#0d3a66;letter-spacing:-.02em}
.kg-stat-num span{color:transparent;background:linear-gradient(135deg,#ffd54a,#ff8a00);
  -webkit-background-clip:text;background-clip:text}
.kg-stat-label{font-size:.66rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase;
  color:#4a6079;margin-top:.5rem;line-height:1.5}

/* =========================================================
   2. FEATURED ACTIVITY (editorial besar)
   ========================================================= */
.kg-feat{position:relative;border-radius:26px;overflow:hidden;box-shadow:0 30px 70px rgba(13,58,102,.22);
  background:#0d3a66}
.kg-feat-media{position:relative;aspect-ratio:16/8.2;overflow:hidden}
.kg-feat-media img{width:100%;height:100%;object-fit:cover;object-position:center;display:block;
  transition:transform 1.1s cubic-bezier(.2,.6,.2,1)}
.kg-feat:hover .kg-feat-media img{transform:scale(1.04)}
.kg-feat-media::after{content:"";position:absolute;inset:0;
  background:linear-gradient(180deg,rgba(7,22,42,0) 30%,rgba(7,22,42,.30) 62%,rgba(7,22,42,.88) 100%)}
.kg-feat-body{position:absolute;z-index:3;left:0;right:0;bottom:0;
  padding:clamp(1.4rem,3.4vw,2.6rem);color:#fff}
.kg-feat-tag{display:inline-flex;align-items:center;gap:.5rem;padding:.42rem .85rem;border-radius:999px;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;font-size:.66rem;font-weight:900;
  letter-spacing:.14em;text-transform:uppercase}
.kg-feat-tag i{font-size:.62rem}
.kg-feat-title{font-family:var(--font-display);font-weight:900;font-size:clamp(1.6rem,3.2vw,2.9rem);
  line-height:1.04;letter-spacing:-.01em;margin:.95rem 0 0;max-width:760px}
.kg-feat-desc{font-size:.95rem;line-height:1.75;color:rgba(235,245,253,.88);max-width:640px;margin:.7rem 0 0}
.kg-feat-btn{display:inline-flex;align-items:center;gap:.55rem;margin-top:1.2rem;padding:.72rem 1.3rem;
  border-radius:999px;background:#fff;color:#0d3a66;font-size:.78rem;font-weight:800;letter-spacing:.05em;
  text-decoration:none;transition:transform .3s ease,box-shadow .3s ease,background .3s ease}
.kg-feat-btn i{transition:transform .3s ease}
.kg-feat-btn:hover{background:#ffd54a;transform:translateY(-2px);box-shadow:0 12px 28px rgba(255,179,0,.35)}
.kg-feat-btn:hover i{transform:translateX(4px)}

/* =========================================================
   3. JEJAK KEGIATAN — masonry asymmetric gallery + filter
   ========================================================= */
.kg-filters{display:flex;gap:.55rem;flex-wrap:wrap;margin:clamp(1.6rem,3vw,2.4rem) 0 0}
.kg-fbtn{padding:.55rem 1.05rem;border-radius:999px;border:1px solid rgba(13,58,102,.22);
  background:#fff;color:#0d3a66;font-size:.72rem;font-weight:800;letter-spacing:.06em;text-transform:uppercase;
  cursor:pointer;transition:all .28s ease}
.kg-fbtn i{margin-right:.35rem;color:#b8860b}
.kg-fbtn:hover{border-color:rgba(255,179,0,.6);transform:translateY(-2px)}
.kg-fbtn.active{background:#0d3a66;color:#fff;border-color:#0d3a66;box-shadow:0 8px 22px rgba(13,58,102,.28)}
.kg-fbtn.active i{color:#ffd54a}

.kg-masonry{display:grid;grid-template-columns:repeat(4,1fr);grid-auto-rows:88px;gap:1rem;margin-top:1.8rem;
  grid-auto-flow:dense}
.kg-card{position:relative;border-radius:18px;overflow:hidden;grid-row:span 2;cursor:pointer;
  background:#0d3a66;box-shadow:0 10px 26px rgba(13,58,102,.14);transition:transform .45s ease,box-shadow .45s ease;
  animation:kgPop .5s var(--ease,ease) both}
.kg-card img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;
  transition:transform .8s cubic-bezier(.2,.6,.2,1)}
.kg-card::after{content:"";position:absolute;inset:0;
  background:linear-gradient(180deg,rgba(7,22,42,0) 42%,rgba(7,22,42,.78) 100%);
  opacity:.85;transition:opacity .4s ease}
.kg-card:hover{transform:translateY(-6px);box-shadow:0 22px 46px rgba(13,58,102,.26)}
.kg-card:hover img{transform:scale(1.06)}
.kg-card:hover::after{opacity:1}
.kg-card-info{position:absolute;z-index:2;left:0;right:0;bottom:0;padding:1rem 1.1rem;color:#fff;
  transform:translateY(6px);transition:transform .4s ease}
.kg-card:hover .kg-card-info{transform:translateY(0)}
.kg-card-cat{display:inline-block;font-size:.58rem;font-weight:900;letter-spacing:.16em;text-transform:uppercase;
  color:#ffd54a;margin-bottom:.3rem}
.kg-card-title{font-family:var(--font-display);font-weight:700;font-size:.98rem;line-height:1.25}
.kg-card-date{font-size:.66rem;color:rgba(255,255,255,.72);margin-top:.35rem;display:flex;align-items:center;gap:.4rem}
.kg-card-date i{color:#ffd54a;font-size:.6rem}
/* variasi ukuran focal point */
.kg-card--lg{grid-row:span 4}
.kg-card--md{grid-row:span 3}
.kg-card--wide{grid-column:span 2;grid-row:span 3}
.kg-card--tall{grid-row:span 5}
@keyframes kgPop{from{opacity:0;transform:translateY(22px) scale(.97)}to{opacity:1;transform:translateY(0) scale(1)}}

/* =========================================================
   4. PERJALANAN SATU TAHUN — activity calendar
   ========================================================= */
.kg-year{position:relative;padding:clamp(1.6rem,3vw,2.6rem);border-radius:26px;
  background:linear-gradient(140deg,#0d3a66 0%,#123f74 55%,#1b4e8c 100%);color:#fff;overflow:hidden}
.kg-year .kg-orn .ko-circle{border-color:rgba(255,255,255,.10);right:6%;top:12%}
.kg-year .kg-orn .ko-dots{right:18%;bottom:14%;opacity:.35}
.kg-year .kg-orn .ko-block{left:14%;top:8%}
.kg-timeline{display:grid;grid-template-columns:repeat(5,1fr);gap:1rem;margin-top:2rem;position:relative}
.kg-timeline::before{content:"";position:absolute;left:0;right:0;top:17px;height:2px;
  background:linear-gradient(90deg,rgba(255,255,255,0),rgba(255,213,74,.5) 15%,rgba(255,213,74,.5) 85%,rgba(255,255,255,0))}
.kg-month{position:relative;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.12);
  border-radius:16px;padding:1.2rem 1rem 1rem;backdrop-filter:blur(4px);transition:transform .35s ease,background .35s ease}
.kg-month:hover{transform:translateY(-6px);background:rgba(255,255,255,.10)}
.kg-month-no{position:relative;width:34px;height:34px;border-radius:50%;display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;font-size:.68rem;font-weight:900;
  font-family:var(--font-display);margin-bottom:.8rem;box-shadow:0 0 0 5px rgba(255,213,74,.14)}
.kg-month-name{font-family:var(--font-display);font-weight:900;font-size:1.05rem;letter-spacing:.1em;color:#ffd54a}
.kg-month-evt{font-size:.78rem;line-height:1.6;color:rgba(235,245,253,.9);margin-top:.45rem}
.kg-month-note{font-size:.66rem;color:rgba(235,245,253,.55);margin-top:.35rem}

/* =========================================================
   5. MOMEN PILIHAN — 1 foto besar + foto kecil
   ========================================================= */
.kg-picks{display:grid;grid-template-columns:minmax(0,1.55fr) minmax(0,1fr);gap:1.1rem;margin-top:2rem}
.kg-pick-big{position:relative;border-radius:22px;overflow:hidden;min-height:520px;box-shadow:0 24px 54px rgba(13,58,102,.2)}
.kg-pick-big img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;
  transition:transform 1s cubic-bezier(.2,.6,.2,1)}
.kg-pick-big:hover img{transform:scale(1.05)}
.kg-pick-big::after{content:"";position:absolute;inset:0;
  background:linear-gradient(180deg,rgba(7,22,42,0) 40%,rgba(7,22,42,.85) 100%)}
.kg-pick-caption{position:absolute;z-index:2;left:1.6rem;right:1.6rem;bottom:1.5rem;color:#fff}
.kg-pick-caption strong{font-family:var(--font-display);font-size:clamp(1.2rem,2.4vw,1.8rem);font-weight:800;
  line-height:1.25;display:block}
.kg-pick-caption span{display:block;font-size:.72rem;letter-spacing:.16em;text-transform:uppercase;
  color:#ffd54a;font-weight:800;margin-bottom:.4rem}
.kg-pick-side{display:grid;grid-template-columns:1fr 1fr;grid-template-rows:1fr 1fr;gap:1.1rem}
.kg-pick-small{position:relative;border-radius:18px;overflow:hidden;min-height:250px;box-shadow:0 14px 32px rgba(13,58,102,.16)}
.kg-pick-small img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;
  transition:transform .8s cubic-bezier(.2,.6,.2,1)}
.kg-pick-small:hover img{transform:scale(1.07)}
.kg-pick-small::after{content:"";position:absolute;inset:0;
  background:linear-gradient(180deg,rgba(7,22,42,0) 50%,rgba(7,22,42,.66) 100%)}
.kg-pick-small span{position:absolute;z-index:2;left:1rem;bottom:.9rem;color:#fff;font-size:.72rem;
  font-weight:800;letter-spacing:.06em;display:flex;align-items:center;gap:.45rem}
.kg-pick-small span i{color:#ffd54a}

/* =========================================================
   CTA
   ========================================================= */
.kg-cta{position:relative;border-radius:26px;overflow:hidden;text-align:center;
  padding:clamp(3rem,6vw,5rem) clamp(1.4rem,4vw,3.5rem);color:#fff;
  background:linear-gradient(140deg,#0d3a66 0%,#123f74 55%,#1b4e8c 100%)}
.kg-cta::before{content:"";position:absolute;inset:0;opacity:.5;
  background-image:radial-gradient(rgba(255,213,74,.28) 1.4px,transparent 1.5px);background-size:20px 20px}
.kg-cta h3{font-family:var(--font-display);font-weight:900;font-size:clamp(1.8rem,3.6vw,3rem);line-height:1.05;
  margin:0;position:relative;letter-spacing:-.01em}
.kg-cta h3 em{font-style:normal;color:transparent;background:linear-gradient(135deg,#ffe66d,#ffb300);
  -webkit-background-clip:text;background-clip:text}
.kg-cta p{position:relative;font-size:.95rem;line-height:1.75;color:rgba(235,245,253,.85);max-width:520px;margin:1rem auto 0}
.kg-cta-btn{position:relative;display:inline-flex;align-items:center;gap:.55rem;margin-top:1.6rem;
  padding:.85rem 1.7rem;border-radius:999px;background:linear-gradient(135deg,#ffd54a,#ffb300);
  color:#0d3a66;font-size:.82rem;font-weight:900;letter-spacing:.06em;text-decoration:none;
  transition:transform .3s ease,box-shadow .3s ease}
.kg-cta-btn i{transition:transform .3s ease}
.kg-cta-btn:hover{transform:translateY(-3px);box-shadow:0 16px 34px rgba(255,179,0,.4)}
.kg-cta-btn:hover i{transform:translateX(4px)}

/* ---------- REVEAL ---------- */
[data-reveal]{opacity:0;transform:translateY(30px);transition:opacity .8s ease,transform .8s cubic-bezier(.2,.6,.2,1)}
[data-reveal].revealed{opacity:1;transform:translateY(0)}

/* ---------- RESPONSIVE ---------- */
@media (max-width:1024px){
  .kg-intro{grid-template-columns:1fr;gap:2.4rem}
  .kg-masonry{grid-template-columns:repeat(3,1fr)}
  .kg-timeline{grid-template-columns:repeat(3,1fr)}
  .kg-timeline::before{display:none}
  .kg-picks{grid-template-columns:1fr}
  .kg-pick-big{min-height:440px}
}
@media (max-width:860px){
  .kg-stats-row{grid-template-columns:repeat(2,1fr)}
  .kg-masonry{grid-template-columns:repeat(2,1fr);grid-auto-rows:110px}
  .kg-timeline{grid-template-columns:repeat(2,1fr)}
  .kg-pick-side{grid-template-columns:1fr 1fr}
}
@media (max-width:640px){
  .kg-stats-row{grid-template-columns:1fr 1fr}
  .kg-masonry{grid-template-columns:1fr 1fr;grid-auto-rows:120px;gap:.75rem}
  .kg-card--wide{grid-column:span 2}
  .kg-timeline{grid-template-columns:1fr}
  .kg-pick-side{grid-template-columns:1fr;grid-template-rows:auto}
  .kg-pick-small{min-height:220px}
  .kg-feat-media{aspect-ratio:4/4.6}
  .kg-filters{flex-wrap:nowrap;overflow-x:auto;padding-bottom:.5rem;-webkit-overflow-scrolling:touch}
  .kg-fbtn{white-space:nowrap}
}
</style>
@endpush

@section('content')

<!-- ================= HERO (identik 100% dengan hero Ekstrakurikuler) ================= -->
<section class="kg-hero">
  <div class="kg-ref-ornaments" aria-hidden="true" style="background-image:url('{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}');background-size:cover;background-position:center center;">
    <img
      src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}"
      alt=""
      class="kg-ref-ornament-image"
      aria-hidden="true"
    >
  </div>
  <div class="kg-hero-inner">
    <div>
      <div class="kg-kicker">School Activity Journal</div>
      <h1 class="kg-title">
        <span class="kg-white">Kegiatan</span>
        <span class="kg-gold">Skaneda</span>
      </h1>
      <p class="kg-lead">Momen, kegiatan, dan pengalaman yang membentuk keluarga besar SMK Negeri 2 Mojokerto — didokumentasikan dalam satu jurnal aktivitas sekolah.</p>
      <div class="kg-hero-meta">
        <span class="kg-pill"><i class="fas fa-camera"></i> Photo Journal</span>
        <span class="kg-pill"><i class="fas fa-calendar-alt"></i> Sepanjang Tahun</span>
        <span class="kg-pill"><i class="fas fa-users"></i> Semua Warga Sekolah</span>
      </div>
    </div>
  </div>
</section>

<!-- ================= 1. AKTIVITAS SKANEDA (pembuka editorial) ================= -->
<section class="kg-sec" style="padding-bottom:clamp(2rem,4vw,3rem)">
  <div class="kg-orn" aria-hidden="true">
    <span class="ko-circle" style="right:4%;top:8%"></span>
    <span class="ko-dots" style="left:3%;bottom:6%"></span>
    <span class="ko-block" style="right:22%;top:18%"></span>
    <span class="ko-line" style="left:38%;top:0"></span>
  </div>
  <div class="kg-container">
    <div class="kg-intro">
      <div class="kg-intro-art" data-reveal>
        <span class="kg-eyebrow">Aktivitas Skaneda</span>
        <h2 class="kg-section-title">Hidup Sekolah<br>yang <em>Bergerak</em></h2>
        <div class="kg-rule"></div>
        <p class="kg-section-sub">Di SMK Negeri 2 Mojokerto, belajar tidak pernah berhenti di dalam kelas. Lomba, latihan, karya, upacara, dan kunjungan industri menjadi irama harian yang membentuk karakter, keterampilan, dan kebersamaan.</p>
        <div class="kg-stats-row">
          <div class="kg-stat"><div class="kg-stat-num"><span>20+</span></div><div class="kg-stat-label">Kegiatan per Tahun</div></div>
          <div class="kg-stat"><div class="kg-stat-num"><span>12</span></div><div class="kg-stat-label">Ekstrakurikuler Aktif</div></div>
          <div class="kg-stat"><div class="kg-stat-num"><span>5</span></div><div class="kg-stat-label">Kompetensi Raih Juara</div></div>
          <div class="kg-stat"><div class="kg-stat-num"><span>100%</span></div><div class="kg-stat-label">Siswa Ikut Kegiatan</div></div>
        </div>
      </div>
      <div class="kg-intro-note" data-reveal="right" style="position:relative">
        <div class="kg-orn" aria-hidden="true">
          <span class="ko-stamp"><i class="fas fa-circle"></i> #SkanedaAktif</span>
          <span class="ko-circle" style="right:0;top:0"></span>
        </div>
        <blockquote style="border-left:4px solid #ffc107;padding-left:1.3rem;margin:0 0 1.4rem">
          <p style="font-size:1.05rem;line-height:1.85;color:#0d3a66;font-style:italic;margin:0">"Sekolah bukan hanya tempat belajar, tetapi juga tempat bertumbuh — lewat setiap kegiatan, siswa belajar bekerja sama, memimpin, dan memberi."</p>
          <footer style="font-size:.72rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:#b8860b;margin-top:.7rem">— Pembina Kesiswaan SKANEDA</footer>
        </blockquote>
      </div>
    </div>
  </div>
</section>

<!-- ================= 2. FEATURED ACTIVITY ================= -->
<section class="kg-sec" style="padding-top:0;padding-bottom:clamp(2.5rem,5vw,4rem)">
  <div class="kg-container">
    <div class="kg-feat" data-reveal>
      <div class="kg-feat-media">
        <img src="{{ asset('images/kg-penghargaan.jpg') }}" alt="Penyerahan penghargaan juara lomba kepada siswa SMK Negeri 2 Mojokerto" loading="eager">
      </div>
      <div class="kg-feat-body">
        <span class="kg-feat-tag"><i class="fas fa-trophy"></i> Kegiatan • 16 Agustus 2026</span>
        <h3 class="kg-feat-title">Penghargaan Prestasi Siswa — Apresiasi di Hadapan Seluruh Warga Sekolah</h3>
        <p class="kg-feat-desc">Momen puncak kegiatan sekolah: penyerahan penghargaan kepada siswa berprestasi di hadapan keluarga besar SKANEDA. Apresiasi ini menjadi penyemangat bagi seluruh peserta didik untuk terus berkarya dan berkompetisi secara sehat.</p>
        <a href="{{ url('/siswa/prestasi-siswa') }}" class="kg-feat-btn">Lihat Prestasi Siswa <i class="fas fa-arrow-right"></i></a>
      </div>
    </div>
  </div>
</section>

<!-- ================= 3. JEJAK KEGIATAN — masonry gallery + filter ================= -->
<section class="kg-sec" style="padding-top:0">
  <div class="kg-orn" aria-hidden="true">
    <span class="ko-dots" style="right:5%;top:10%"></span>
    <span class="ko-circle" style="left:2%;bottom:12%"></span>
    <span class="ko-block" style="left:28%;top:0"></span>
  </div>
  <div class="kg-container">
    <div data-reveal>
      <span class="kg-eyebrow">Photo Journal</span>
      <h2 class="kg-section-title">Jejak <em>Kegiatan</em></h2>
      <div class="kg-rule"></div>
      <p class="kg-section-sub">Koleksi foto kegiatan siswa — dari ruang praktik hingga panggung penghargaan. Pilih kategori untuk menyaring momen favoritmu.</p>
    </div>

    <div class="kg-filters" data-reveal>
      <button class="kg-fbtn active" data-filter="semua"><i class="fas fa-th-large"></i> Semua</button>
      <button class="kg-fbtn" data-filter="akademik"><i class="fas fa-book-open"></i> Akademik</button>
      <button class="kg-fbtn" data-filter="ekstrakurikuler"><i class="fas fa-running"></i> Ekstrakurikuler</button>
      <button class="kg-fbtn" data-filter="kesiswaan"><i class="fas fa-users"></i> Kesiswaan</button>
      <button class="kg-fbtn" data-filter="upacara"><i class="fas fa-flag"></i> Upacara</button>
      <button class="kg-fbtn" data-filter="kompetisi"><i class="fas fa-trophy"></i> Kompetisi</button>
      <button class="kg-fbtn" data-filter="kegiatan-sekolah"><i class="fas fa-school"></i> Kegiatan Sekolah</button>
      <button class="kg-fbtn" data-filter="kunjungan-industri"><i class="fas fa-industry"></i> Kunjungan/Industri</button>
    </div>

    <div class="kg-masonry" id="kgMasonry">
      <!-- KOMPETISI -->
      <article class="kg-card kg-card--lg" data-cat="kompetisi" data-reveal>
        <img src="{{ asset('images/kg-juara-1.jpg') }}" alt="Siswa menerima medali juara" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kompetisi</span>
          <h4 class="kg-card-title">Penganugerahan Medali Juara 1</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card" data-cat="kompetisi" data-reveal>
        <img src="{{ asset('images/kg-trofi.jpg') }}" alt="Trofi juara lomba" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kompetisi</span>
          <h4 class="kg-card-title">Trofi Kebanggaan Skaneda</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card kg-card--md" data-cat="kompetisi" data-reveal>
        <img src="{{ asset('images/kg-podium.jpg') }}" alt="Siswa di podium lomba" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kompetisi</span>
          <h4 class="kg-card-title">Naik Podium</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2025</span>
        </div>
      </article>

      <!-- AKADEMIK -->
      <article class="kg-card kg-card--wide" data-cat="akademik" data-reveal>
        <img src="{{ asset('images/kg-coding.jpg') }}" alt="Siswa praktik coding di lab RPL" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Akademik</span>
          <h4 class="kg-card-title">Praktik Coding di Lab RPL</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card kg-card--tall" data-cat="akademik" data-reveal>
        <img src="{{ asset('images/kg-rpl.jpg') }}" alt="Pengembangan aplikasi siswa RPL" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Akademik</span>
          <h4 class="kg-card-title">Pengembangan Aplikasi</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2025</span>
        </div>
      </article>
      <article class="kg-card" data-cat="akademik" data-reveal>
        <img src="{{ asset('images/kg-dkv.jpg') }}" alt="Karya desain siswa DKV" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Akademik</span>
          <h4 class="kg-card-title">Sesi Desain Visual DKV</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card kg-card--md" data-cat="akademik" data-reveal>
        <img src="{{ asset('images/kg-pastry.jpg') }}" alt="Siswa membuat pastry di dapur kuliner" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Akademik</span>
          <h4 class="kg-card-title">Pastry &amp; Bakery</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2025</span>
        </div>
      </article>

      <!-- EKSTRAKURIKULER -->
      <article class="kg-card kg-card--wide" data-cat="ekstrakurikuler" data-reveal>
        <img src="{{ asset('images/kg-pramuka.jpg') }}" alt="Kegiatan pramuka di lapangan" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Ekstrakurikuler</span>
          <h4 class="kg-card-title">Latihan Pramuka</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card kg-card--tall" data-cat="ekstrakurikuler" data-reveal>
        <img src="{{ asset('images/kg-paskibra.jpg') }}" alt="Pasukan pengibar bendera berlatih" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Ekstrakurikuler</span>
          <h4 class="kg-card-title">Latihan Paskibra</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card" data-cat="ekstrakurikuler" data-reveal>
        <img src="{{ asset('images/kg-futsal.jpg') }}" alt="Pertandingan futsal antar kelas" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Ekstrakurikuler</span>
          <h4 class="kg-card-title">Futsal Skaneda</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card kg-card--md" data-cat="ekstrakurikuler" data-reveal>
        <img src="{{ asset('images/kg-tari.jpg') }}" alt="Latihan seni tari tradisional" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Ekstrakurikuler</span>
          <h4 class="kg-card-title">Sanggar Tari</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2025</span>
        </div>
      </article>
      <article class="kg-card" data-cat="ekstrakurikuler" data-reveal>
        <img src="{{ asset('images/kg-musik.jpg') }}" alt="Latihan band siswa" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Ekstrakurikuler</span>
          <h4 class="kg-card-title">Latihan Musik</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>

      <!-- KESISWAAN -->
      <article class="kg-card kg-card--md" data-cat="kesiswaan" data-reveal>
        <img src="{{ asset('images/kg-bersama.jpg') }}" alt="Foto bersama siswa berprestasi" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kesiswaan</span>
          <h4 class="kg-card-title">Foto Bersama Juara</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card" data-cat="kesiswaan" data-reveal>
        <img src="{{ asset('images/kg-tim.jpg') }}" alt="Tim siswa berprestasi" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kesiswaan</span>
          <h4 class="kg-card-title">Tim Prestasi</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2025</span>
        </div>
      </article>

      <!-- UPACARA -->
      <article class="kg-card kg-card--wide" data-cat="upacara" data-reveal>
        <img src="{{ asset('images/kg-upacara.jpg') }}" alt="Upacara bendera di halaman sekolah" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Upacara</span>
          <h4 class="kg-card-title">Upacara Bendera</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card" data-cat="upacara" data-reveal>
        <img src="{{ asset('images/kg-piala.jpg') }}" alt="Etalase piala penghargaan" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Upacara</span>
          <h4 class="kg-card-title">Etalase Piala</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>

      <!-- KEGIATAN SEKOLAH -->
      <article class="kg-card kg-card--lg" data-cat="kegiatan-sekolah" data-reveal>
        <img src="{{ asset('images/kg-ppdb.jpg') }}" alt="Kegiatan PPDB SMK Negeri 2 Mojokerto" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kegiatan Sekolah</span>
          <h4 class="kg-card-title">Gelaran PPDB Skaneda</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card kg-card--md" data-cat="kegiatan-sekolah" data-reveal>
        <img src="{{ asset('images/kg-kuliner.jpg') }}" alt="Produksi kuliner siswa" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kegiatan Sekolah</span>
          <h4 class="kg-card-title">Produksi Kuliner</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2025</span>
        </div>
      </article>

      <!-- KUNJUNGAN/INDUSTRI -->
      <article class="kg-card kg-card--wide" data-cat="kunjungan-industri" data-reveal>
        <img src="{{ asset('images/kg-kampus.jpg') }}" alt="Kunjungan industri ke kampus" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kunjungan/Industri</span>
          <h4 class="kg-card-title">Kunjungan Industri &amp; Kampus</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card kg-card--md" data-cat="kunjungan-industri" data-reveal>
        <img src="{{ asset('images/kg-aphp.jpg') }}" alt="Kegiatan siswa APHP" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kunjungan/Industri</span>
          <h4 class="kg-card-title">Praktik Lapangan APHP</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2025</span>
        </div>
      </article>
      <article class="kg-card" data-cat="kunjungan-industri" data-reveal>
        <img src="{{ asset('images/kg-digital.jpg') }}" alt="Kegiatan digital siswa" loading="eager">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kunjungan/Industri</span>
          <h4 class="kg-card-title">Kelas Industri Digital</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
    </div>
  </div>
</section>

<!-- ================= 4. PERJALANAN SATU TAHUN ================= -->
<section class="kg-sec" style="padding-top:0">
  <div class="kg-container">
    <div class="kg-year" data-reveal>
      <div class="kg-orn" aria-hidden="true">
        <span class="ko-circle"></span>
        <span class="ko-dots"></span>
        <span class="ko-block"></span>
      </div>
      <div style="position:relative;z-index:2">
        <span class="kg-eyebrow kg-eyebrow--gold" style="color:#ffd54a">Activity Calendar</span>
        <h2 class="kg-section-title" style="color:#fff">Perjalanan <em>Satu Tahun</em></h2>
        <div class="kg-rule" style="background:linear-gradient(90deg,#ffd54a,#ff8a00)"></div>
        <p class="kg-section-sub" style="color:rgba(235,245,253,.82)">Irama kegiatan SKANEDA sepanjang tahun ajaran — dari MPLS hingga pelepasan, dari ruang kelas hingga panggung penghargaan.</p>
      </div>

      <div class="kg-timeline">
        <div class="kg-month">
          <div class="kg-month-no">01</div>
          <div class="kg-month-name">JAN</div>
          <div class="kg-month-evt">Awal Semester Genap &amp; Rapat Kerja Program</div>
          <div class="kg-month-note">Menyusun rencana kegiatan semester</div>
        </div>
        <div class="kg-month">
          <div class="kg-month-no">02</div>
          <div class="kg-month-name">FEB</div>
          <div class="kg-month-evt">Seleksi &amp; Lomba Siswa Tingkat Sekolah</div>
          <div class="kg-month-note">Menjaring calon utusan sekolah</div>
        </div>
        <div class="kg-month">
          <div class="kg-month-no">03</div>
          <div class="kg-month-name">MAR</div>
          <div class="kg-month-evt">Kunjungan Industri &amp; Dunia Kerja</div>
          <div class="kg-month-note">Pembelajaran kontekstual di DUDI</div>
        </div>
        <div class="kg-month">
          <div class="kg-month-no">04</div>
          <div class="kg-month-name">APR</div>
          <div class="kg-month-evt">Panen Karya P5 &amp; Bazar Kewirausahaan</div>
          <div class="kg-month-note">Menampilkan hasil proyek siswa</div>
        </div>
        <div class="kg-month">
          <div class="kg-month-no">05</div>
          <div class="kg-month-name">MEI</div>
          <div class="kg-month-evt">Ujian &amp; Asesmen Akhir Semester</div>
          <div class="kg-month-note">Evaluasi capaian pembelajaran</div>
        </div>
        <div class="kg-month">
          <div class="kg-month-no">06</div>
          <div class="kg-month-name">JUN</div>
          <div class="kg-month-evt">Pelepasan &amp; Wisuda Kelas XII</div>
          <div class="kg-month-note">Mengantar alumni menuju dunia kerja</div>
        </div>
        <div class="kg-month">
          <div class="kg-month-no">07</div>
          <div class="kg-month-name">JUL</div>
          <div class="kg-month-evt">MPLS Peserta Didik Baru</div>
          <div class="kg-month-note">Menyambut keluarga baru SKANEDA</div>
        </div>
        <div class="kg-month">
          <div class="kg-month-no">08</div>
          <div class="kg-month-name">AGU</div>
          <div class="kg-month-evt">Lomba 17-an &amp; HUT Kemerdekaan</div>
          <div class="kg-month-note">Memeriahkan bulan kemerdekaan</div>
        </div>
        <div class="kg-month">
          <div class="kg-month-no">09</div>
          <div class="kg-month-name">SEP</div>
          <div class="kg-month-evt">Peringatan Hari Besar &amp; Latihan Gabungan</div>
          <div class="kg-month-note">Momen kebersamaan seluruh siswa</div>
        </div>
        <div class="kg-month">
          <div class="kg-month-no">10</div>
          <div class="kg-month-name">OKT</div>
          <div class="kg-month-evt">Pekan Karya &amp; Ekspo Kompetensi</div>
          <div class="kg-month-note">Pameran karya seluruh jurusan</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================= 5. MOMEN PILIHAN ================= -->
<section class="kg-sec" style="padding-top:0">
  <div class="kg-orn" aria-hidden="true">
    <span class="ko-circle" style="left:6%;top:14%"></span>
    <span class="ko-dots" style="right:4%;bottom:10%"></span>
    <span class="ko-block" style="right:30%;top:6%"></span>
  </div>
  <div class="kg-container">
    <div data-reveal>
      <span class="kg-eyebrow">Curated Moments</span>
      <h2 class="kg-section-title">Momen <em>Pilihan</em></h2>
      <div class="kg-rule"></div>
      <p class="kg-section-sub">Beberapa momen yang paling membekas — dipilih dari ribuan foto kegiatan di sepanjang tahun.</p>
    </div>

    <div class="kg-picks">
      <div class="kg-pick-big" data-reveal>
        <img src="{{ asset('images/kg-lomba.jpg') }}" alt="Suasana lomba siswa SMK Negeri 2 Mojokerto" loading="eager">
        <div class="kg-pick-caption">
          <span>Momen Pilihan</span>
          <strong>"Belajar tidak selalu terjadi di dalam kelas."</strong>
        </div>
      </div>
      <div class="kg-pick-side">
        <div class="kg-pick-small" data-reveal>
          <img src="{{ asset('images/kg-tari.jpg') }}" alt="Latihan seni tari" loading="eager">
          <span><i class="fas fa-circle"></i> Sanggar Tari</span>
        </div>
        <div class="kg-pick-small" data-reveal>
          <img src="{{ asset('images/kg-futsal.jpg') }}" alt="Pertandingan futsal" loading="eager">
          <span><i class="fas fa-circle"></i> Futsal Skaneda</span>
        </div>
        <div class="kg-pick-small" data-reveal>
          <img src="{{ asset('images/kg-pramuka.jpg') }}" alt="Kegiatan pramuka" loading="eager">
          <span><i class="fas fa-circle"></i> Pramuka</span>
        </div>
        <div class="kg-pick-small" data-reveal>
          <img src="{{ asset('images/kg-coding.jpg') }}" alt="Praktik coding" loading="eager">
          <span><i class="fas fa-circle"></i> Lab RPL</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================= CTA ================= -->
<section class="kg-sec" style="padding-top:0">
  <div class="kg-container">
    <div class="kg-cta" data-reveal>
      <h3>Ikuti Terus <em>Setiap Langkah Kami</em></h3>
      <p>Jadilah bagian dari cerita SMK Negeri 2 Mojokerto. Kabar kegiatan terbaru selalu kami sampaikan lewat kanal resmi sekolah.</p>
      <a href="{{ route('kontak') }}" class="kg-cta-btn">Hubungi Sekolah <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
  'use strict';

  /* ---------- REVEAL ON SCROLL ---------- */
  var revealEls = document.querySelectorAll('[data-reveal]');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('revealed');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    revealEls.forEach(function (el) { io.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('revealed'); });
  }
  /* Fallback: pastikan elemen di atas fold langsung tampil */
  setTimeout(function () {
    revealEls.forEach(function (el) {
      var r = el.getBoundingClientRect();
      if (r.top < window.innerHeight) el.classList.add('revealed');
    });
  }, 300);

  /* ---------- FILTER KATEGORI JEJAK KEGIATAN ---------- */
  var filterBtns = document.querySelectorAll('.kg-fbtn');
  var cards = document.querySelectorAll('.kg-masonry .kg-card');
  var activeFilter = 'semua';

  function applyFilter() {
    cards.forEach(function (card) {
      var cat = (card.getAttribute('data-cat') || 'semua').toLowerCase();
      var show = (activeFilter === 'semua' || cat === activeFilter);
      card.style.display = show ? '' : 'none';
      if (show) {
        card.style.animation = 'none';
        void card.offsetWidth;
        card.style.animation = '';
      }
    });
  }

  filterBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      filterBtns.forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');
      activeFilter = btn.getAttribute('data-filter') || 'semua';
      applyFilter();
    });
  });

  /* ---------- HOVER ZOOM (CSS handles; JS hanya memastikan tidak ada konflik) ---------- */
  document.querySelectorAll('.kg-card, .kg-pick-big, .kg-pick-small, .kg-feat').forEach(function (el) {
    el.addEventListener('mouseenter', function () {});
  });
})();
</script>
@endpush