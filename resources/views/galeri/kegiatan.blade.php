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
  .kg-hero-inner{width:100%;padding:clamp(2.8rem,7vh,4rem) 1.25rem 2.8rem}
  .kg-hero::after{font-size:clamp(3.2rem,20vw,5.4rem);opacity:.6;left:-2%}
  .kg-title{font-size:clamp(2.4rem,11vw,3.6rem)}}
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
/* Saat filter kategori aktif (bukan "Semua") kartu dibuat seragam & berjajar rapi.
   Kategori "Semua" tetap pakai masonry asli (ukuran variatif) - TIDAK diubah. */
.kg-masonry.is-filtered .kg-card{grid-column:span 1!important;grid-row:span 3!important}
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
  .kg-sec{padding:clamp(3rem,6vw,4.5rem) clamp(1.2rem,4vw,3rem)}
  .kg-stats-row{grid-template-columns:repeat(2,1fr);gap:.85rem}
  .kg-masonry{grid-template-columns:repeat(2,1fr);grid-auto-rows:110px}
  .kg-timeline{grid-template-columns:repeat(2,1fr)}
  .kg-pick-side{grid-template-columns:1fr 1fr}
}
@media (max-width:640px){
  .kg-sec{padding:2.2rem 1rem}
  .kg-stats-row{grid-template-columns:1fr 1fr;gap:.65rem}
  .kg-stat{padding:.9rem .75rem;border-radius:14px}
  .kg-stat-num{font-size:1.45rem}
  .kg-stat-label{font-size:.6rem;letter-spacing:.08em;margin-top:.3rem}
  .kg-feat-media{aspect-ratio:16/10}
  .kg-feat-body{padding:1.2rem 1rem}
  .kg-feat-title{font-size:clamp(1.3rem,5vw,1.75rem);line-height:1.2;margin:.5rem 0 0}
  .kg-feat-desc{font-size:.85rem;line-height:1.65;margin:.4rem 0 0}
  .kg-feat-btn{margin-top:.9rem;padding:.6rem 1.1rem;font-size:.74rem}
  .kg-filters{flex-wrap:nowrap;overflow-x:auto;padding-bottom:.5rem;-webkit-overflow-scrolling:touch;margin:0 0 .5rem}
  .kg-fbtn{white-space:nowrap;padding:.45rem .85rem;font-size:.68rem}
  .kg-masonry{grid-template-columns:repeat(2,1fr);grid-auto-rows:auto;gap:.75rem}
  .kg-card{grid-column:span 1!important;grid-row:auto!important;min-height:220px;aspect-ratio:4/3;border-radius:14px}
  .kg-card--wide{grid-column:span 2!important}
  .kg-card-info{transform:translateY(0);opacity:1;padding:.85rem .9rem}
  .kg-card-title{font-size:.9rem;line-height:1.25}
  .kg-timeline{grid-template-columns:1fr;gap:.75rem}
  .kg-month{display:flex;align-items:flex-start;gap:.85rem;padding:1rem .9rem;border-radius:14px;border-left:3px solid #ffd54a}
  .kg-month-no{margin-bottom:0;flex-shrink:0;width:32px;height:32px;font-size:.64rem}
  .kg-month-name{font-size:.95rem}
  .kg-month-evt{font-size:.76rem;margin-top:.2rem}
  .kg-month-note{font-size:.64rem;margin-top:.2rem}
  .kg-picks{gap:1rem}
  .kg-pick-big{min-height:260px;aspect-ratio:16/10;border-radius:16px}
  .kg-pick-caption{left:1rem;right:1rem;bottom:1rem}
  .kg-pick-caption strong{font-size:1.05rem}
  .kg-pick-side{grid-template-columns:1fr 1fr;gap:.75rem}
  .kg-pick-small{min-height:140px;border-radius:14px}
  .kg-pick-small span{left:.75rem;bottom:.75rem;font-size:.65rem}
  .kg-cta{padding:2.2rem 1.1rem;border-radius:20px}
  .kg-cta h3{font-size:1.45rem;line-height:1.15}
  .kg-cta p{font-size:.88rem;line-height:1.65;margin-top:.75rem}
  .kg-cta-btn{width:100%;justify-content:center;margin-top:1.2rem;padding:.75rem 1.2rem;font-size:.78rem}
}
@media (max-width:480px){
  .kg-masonry{grid-template-columns:1fr;gap:.85rem}
  .kg-card,.kg-card--wide{grid-column:span 1!important;min-height:210px;aspect-ratio:16/10}
  .kg-pick-side{grid-template-columns:1fr 1fr}
}

/* ---------- LIGHTBOX ALBUM MODAL ---------- */
.kg-album-modal{position:fixed;inset:0;z-index:10000;display:flex;align-items:center;justify-content:center;
  background:rgba(7,22,42,.92);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);
  opacity:0;visibility:hidden;transition:opacity .35s ease,visibility .35s ease;padding:.75rem}
.kg-album-modal.open{opacity:1;visibility:visible}
.kg-album-dialog{position:relative;width:min(1100px,94vw);max-height:92vh;background:#102744;border:1px solid rgba(255,255,255,.15);
  border-radius:20px;overflow:hidden;display:flex;flex-direction:column;box-shadow:0 30px 80px rgba(0,0,0,.6);color:#fff}
.kg-album-header{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.2rem;
  background:#0d213a;border-bottom:1px solid rgba(255,255,255,.08)}
.kg-album-title{font-family:var(--font-display);font-size:1.05rem;font-weight:900;margin:0;color:#fff}
.kg-album-meta{display:flex;align-items:center;gap:.7rem;margin-top:.25rem;font-size:.7rem;color:#8fa8c2}
.kg-album-close{width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,.1);border:0;color:#fff;
  font-size:1rem;display:grid;place-items:center;cursor:pointer;transition:all .25s ease}
.kg-album-close:hover{background:#ff7a00;color:#fff;transform:scale(1.08)}
.kg-album-body{position:relative;flex:1;min-height:280px;max-height:55vh;display:flex;align-items:center;justify-content:center;
  background:#061221;overflow:hidden}
.kg-album-img{max-width:100%;max-height:55vh;object-fit:contain;transition:transform .3s ease}
.kg-album-arrow{position:absolute;top:50%;transform:translateY(-50%);z-index:10;width:40px;height:40px;border-radius:50%;
  background:rgba(13,33,58,.8);border:1px solid rgba(255,255,255,.2);color:#fff;font-size:1rem;
  display:grid;place-items:center;cursor:pointer;transition:all .25s ease}
.kg-album-arrow:hover{background:#ffb300;color:#0d3a66}
.kg-album-arrow.prev{left:.6rem}
.kg-album-arrow.next{right:.6rem}
.kg-album-footer{padding:.8rem 1.2rem;background:#0d213a;border-top:1px solid rgba(255,255,255,.08);
  display:flex;align-items:center;justify-content:space-between;gap:.75rem}
.kg-album-caption{font-size:.8rem;color:#c9d8e8;margin:0}
.kg-album-counter{font-size:.74rem;font-weight:900;color:#ffd54a;letter-spacing:.1em}

/* =========================================================
   DARK MODE — KEGIATAN (body.kg-dark)
   Class kg-dark dipasang otomatis oleh JS setiap kali dark mode
   situs aktif. Semua selector memakai ID #kgPage supaya specificity-nya
   mengalahkan CSS dark mode global dan tidak tertimpa.
   Palet: halaman #060f1d · kartu #0a1a2e · panel #0c1c33 · input #0f2340
   ========================================================= */
body.kg-dark #kgPage{background:#060f1d!important;color:#e6eef8!important;color-scheme:dark}

/* ----- Hero ----- */
/* Hero: disamakan persis dengan hero halaman Berita (dark) */
body.kg-dark #kgPage .kg-hero{background:#08172a!important;color:#e6eef8!important}
body.kg-dark #kgPage .kg-hero::before{content:none!important;display:none!important}
body.kg-dark #kgPage .kg-hero::after{color:rgba(255,255,255,.04)!important;-webkit-text-stroke:1px rgba(255,179,0,.14)!important}
body.kg-dark #kgPage .kg-ref-ornaments{opacity:.45!important;background-image:none!important;filter:none!important}
body.kg-dark #kgPage .kg-ref-ornament-image{opacity:1!important;filter:invert(.92) hue-rotate(180deg) brightness(.9)!important}
body.kg-dark #kgPage .kg-kicker{background:rgba(255,111,0,.10)!important;border-color:rgba(255,111,0,.35)!important;color:#ff9a3d!important}
body.kg-dark #kgPage .kg-title .kg-white{color:#fff!important}
body.kg-dark #kgPage .kg-lead{color:#9db0c6!important}
body.kg-dark #kgPage .kg-pill{background:#0c1c33!important;border-color:rgba(255,255,255,.12)!important;color:#e6eef8!important;
  box-shadow:0 8px 24px rgba(0,0,0,.35)!important}

/* ----- Heading section ----- */
body.kg-dark #kgPage .kg-eyebrow{color:#6fd3ee!important}
body.kg-dark #kgPage .kg-eyebrow--gold{color:#ffd54a!important}
body.kg-dark #kgPage .kg-section-title{color:#fff!important}
body.kg-dark #kgPage .kg-section-sub{color:#9db0c6!important}

/* ----- Ornamen ----- */
body.kg-dark #kgPage .kg-orn .ko-circle{border-color:rgba(255,255,255,.12)!important}
body.kg-dark #kgPage .kg-orn .ko-dots{background-image:radial-gradient(rgba(255,255,255,.32) 1.5px,transparent 1.6px)!important}
body.kg-dark #kgPage .kg-orn .ko-line{background:rgba(255,255,255,.16)!important}
body.kg-dark #kgPage .kg-orn .ko-grid{background-image:linear-gradient(rgba(255,255,255,.08) 1px,transparent 1px),
  linear-gradient(90deg,rgba(255,255,255,.08) 1px,transparent 1px)!important}
body.kg-dark #kgPage .kg-orn .ko-stamp{background:rgba(255,255,255,.04)!important;border-color:rgba(255,255,255,.16)!important;color:rgba(255,255,255,.5)!important}

/* ----- Statistik & kutipan pembuka ----- */
body.kg-dark #kgPage .kg-stat{background:#0a1a2e!important;border-color:rgba(255,255,255,.08)!important;box-shadow:0 10px 26px rgba(0,0,0,.35)!important}
body.kg-dark #kgPage .kg-stat:hover{border-color:rgba(255,179,0,.45)!important;box-shadow:0 16px 34px rgba(0,0,0,.5)!important}
body.kg-dark #kgPage .kg-stat-num{color:#fff!important}
body.kg-dark #kgPage .kg-stat-label{color:#9db0c6!important}
body.kg-dark #kgPage .kg-intro-note blockquote p{color:#e6eef8!important}
body.kg-dark #kgPage .kg-intro-note blockquote footer{color:#ffd54a!important}

/* ----- Featured ----- */
body.kg-dark #kgPage .kg-feat{background:#0a1a2e!important;box-shadow:0 30px 70px rgba(0,0,0,.55)!important;border:1px solid rgba(255,255,255,.06)}

/* ----- Filter & search ----- */
body.kg-dark #kgPage .kg-fbtn{background:#0c1c33!important;border-color:rgba(255,255,255,.14)!important;color:#c3d1e2!important}
body.kg-dark #kgPage .kg-fbtn i{color:#ffd54a!important}
body.kg-dark #kgPage .kg-fbtn:hover{border-color:#ffd54a!important;color:#fff!important}
body.kg-dark #kgPage .kg-fbtn.active{background:linear-gradient(135deg,#ffd54a,#ffb300)!important;border-color:#ffb300!important;
  color:#0a2d52!important;box-shadow:0 8px 22px rgba(255,179,0,.28)!important}
body.kg-dark #kgPage .kg-fbtn.active i{color:#0a2d52!important}
body.kg-dark #kgPage #kgSearchInput{background:#0f2340!important;background-color:#0f2340!important;
  border:1.5px solid rgba(255,255,255,.14)!important;color:#fff!important;-webkit-text-fill-color:#fff!important;
  outline:none!important;box-shadow:none!important;-webkit-appearance:none!important;appearance:none!important}
body.kg-dark #kgPage #kgSearchInput::placeholder{color:#6d819a!important;-webkit-text-fill-color:#6d819a!important;opacity:1}
body.kg-dark #kgPage #kgSearchInput:focus{background:#12294a!important;border-color:#ffb300!important;box-shadow:0 0 0 4px rgba(255,179,0,.18)!important}
body.kg-dark #kgPage .kg-search-wrap i{color:#7f93ab!important}

/* ----- Kartu galeri ----- */
body.kg-dark #kgPage .kg-card{background:#0a1a2e!important;border:1px solid rgba(255,255,255,.07);box-shadow:0 10px 26px rgba(0,0,0,.45)!important}
body.kg-dark #kgPage .kg-card:hover{box-shadow:0 22px 46px rgba(0,0,0,.65)!important}

/* ----- Perjalanan satu tahun & CTA (sudah gelap, digelapkan sedikit) ----- */
body.kg-dark #kgPage .kg-year{background:#0a1a2e!important;background-image:none!important;
  border:1px solid rgba(255,255,255,.08)!important;box-shadow:0 24px 54px rgba(0,0,0,.45)!important}
body.kg-dark #kgPage .kg-month{background:#0c1c33!important;border:1px solid rgba(255,255,255,.08)!important;
  -webkit-backdrop-filter:none!important;backdrop-filter:none!important}
body.kg-dark #kgPage .kg-month:hover{background:#0f2340!important}
body.kg-dark #kgPage .kg-month-evt{color:#dbe6f3!important}
body.kg-dark #kgPage .kg-month-note{color:#8ea3bb!important}
body.kg-dark #kgPage .kg-section-sub[style]{color:#9db0c6!important}
body.kg-dark #kgPage .kg-cta{background:#0a1a2e!important;background-image:none!important;
  border:1px solid rgba(255,255,255,.08)!important;box-shadow:0 24px 54px rgba(0,0,0,.45)!important}
body.kg-dark #kgPage .kg-cta::before{opacity:.35!important}
body.kg-dark #kgPage .kg-cta p{color:#9db0c6!important}

/* ----- Search: pembungkus tanpa background putih, lebih panjang & besar ----- */
body.kg-dark #kgPage .kg-search-wrap{background:none!important;background-color:transparent!important;border:none!important;
  box-shadow:none!important;padding:0!important;outline:none!important}
body.kg-dark #kgPage .kg-search-wrap::before,body.kg-dark #kgPage .kg-search-wrap::after{content:none!important;display:none!important}

/* ----- Momen pilihan ----- */
body.kg-dark #kgPage .kg-pick-big{box-shadow:0 24px 54px rgba(0,0,0,.55)!important;border:1px solid rgba(255,255,255,.06)}
body.kg-dark #kgPage .kg-pick-small{box-shadow:0 14px 32px rgba(0,0,0,.5)!important;border:1px solid rgba(255,255,255,.06)}

@media(max-width:640px){
  .kg-search-wrap{min-width:100%!important;max-width:100%!important;flex:1 1 100%!important}
  #kgSearchInput{height:48px!important;font-size:.92rem!important}
}

/* transisi halus */
.kg-page,.kg-stat,.kg-fbtn,.kg-pill,.kg-card,.kg-kicker{transition:background-color .35s ease,color .35s ease,border-color .35s ease,transform .35s ease,box-shadow .35s ease}
</style>
@endpush

@section('content')
<div class="kg-page" id="kgPage">

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
        <span class="kg-pill" style="margin-top:.3rem"><i class="fas fa-leaf"></i> Sekolah Adiwiyata 2025</span>
        <div class="kg-stats-row">
          <div class="kg-stat"><div class="kg-stat-num"><span>20+</span></div><div class="kg-stat-label">Kegiatan per Tahun</div></div>
          <div class="kg-stat"><div class="kg-stat-num"><span>12</span></div><div class="kg-stat-label">Ekstrakurikuler Aktif</div></div>
          <div class="kg-stat"><div class="kg-stat-num"><span>5</span></div><div class="kg-stat-label">Kompetensi Raih Juara</div></div>
          <div class="kg-stat"><div class="kg-stat-num"><span>100%</span></div><div class="kg-stat-label">Siswa Ikut Kegiatan</div></div>
        </div>
      </div>
      <div class="kg-intro-note" data-reveal="right" style="position:relative">
        <div class="kg-orn" aria-hidden="true">
          <span class="ko-stamp" style="position:absolute;right:0;top:-2.6rem"><i class="fas fa-circle"></i> #SkanedaAktif</span>
          <span class="ko-circle" style="right:0;top:-2.4rem"></span>
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
        <img src="{{ asset('images/galeri/adiwiyata.jpeg') }}" alt="Penyerahan penghargaan juara lomba kepada siswa SMK Negeri 2 Mojokerto" loading="eager">
      </div>
      <div class="kg-feat-body">
        <span class="kg-feat-tag"><i class="fas fa-trophy"></i> Penghargaan • 25 Desember 2025</span>
        <h3 class="kg-feat-title">Sekolah Adiwiyata 2025</h3>
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

    <div style="display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin:clamp(1.6rem,3vw,2.4rem) 0 0">
      <div class="kg-filters" data-reveal style="margin:0">
        <button class="kg-fbtn active" data-filter="semua"><i class="fas fa-th-large"></i> Semua</button>
        <button class="kg-fbtn" data-filter="akademik"><i class="fas fa-book-open"></i> Akademik</button>
        <button class="kg-fbtn" data-filter="ekstrakurikuler"><i class="fas fa-running"></i> Ekstrakurikuler</button>
        <button class="kg-fbtn" data-filter="kesiswaan"><i class="fas fa-users"></i> Kesiswaan</button>
        <button class="kg-fbtn" data-filter="upacara"><i class="fas fa-flag"></i> Upacara</button>
        <button class="kg-fbtn" data-filter="kompetisi"><i class="fas fa-trophy"></i> Kompetisi</button>
        <button class="kg-fbtn" data-filter="kegiatan-sekolah"><i class="fas fa-school"></i> Kegiatan Sekolah</button>
        <button class="kg-fbtn" data-filter="kunjungan-industri"><i class="fas fa-industry"></i> Kunjungan/Industri</button>
      </div>
      <div class="kg-search-wrap" style="position:relative;min-width:320px;max-width:560px;flex:1 1 420px" data-reveal>
        <i class="fas fa-search" style="position:absolute;left:20px;top:50%;transform:translateY(-50%);color:#2f6fa8;font-size:1rem;z-index:2"></i>
        <input type="text" id="kgSearchInput" value="{{ request('search') }}" placeholder="Cari judul kegiatan..." style="width:100%;height:52px;padding:.85rem 1.4rem .85rem 3.2rem;border-radius:99px;border:1px solid rgba(13,58,102,.2);background:#fff;color:#0d3a66;font-size:.98rem;outline:none">
      </div>
    </div>

    <div class="kg-masonry" id="kgMasonry">
      @if(isset($albums) && count($albums) > 0)
        @foreach($albums as $index => $album)
          @php
            $catSlug = Str::slug($album->category ?? 'kegiatan-sekolah');
            $sizeClass = 'kg-card';
            if ($index % 5 == 0) $sizeClass = 'kg-card kg-card--lg';
            elseif ($index % 5 == 1) $sizeClass = 'kg-card kg-card--wide';
            elseif ($index % 5 == 3) $sizeClass = 'kg-card kg-card--tall';
            elseif ($index % 5 == 4) $sizeClass = 'kg-card kg-card--md';

            $allPhotos = [];
            if ($album->image_url) {
                $allPhotos[] = asset($album->image_url);
            }
            if ($album->photos) {
                foreach($album->photos as $p) {
                    $allPhotos[] = asset($p->photo_url);
                }
            }
          @endphp
          <article class="{{ $sizeClass }}" data-cat="{{ $catSlug }}" data-reveal
                   data-title="{{ $album->title }}"
                   data-category="{{ $album->category }}"
                   data-date="{{ $album->event_date ? \Carbon\Carbon::parse($album->event_date)->format('d M Y') : '2026' }}"
                   data-photos="{{ json_encode($allPhotos) }}"
                   data-desc="{{ $album->description ?? $album->title }}">
            <img src="{{ asset($album->image_url) }}" alt="{{ $album->title }}" loading="lazy" onerror="this.src='{{ asset('images/logo_smkn2.png') }}'">
            <div class="kg-card-info">
              <span class="kg-card-cat">{{ $album->category }}</span>
              <h4 class="kg-card-title">{{ $album->title }}</h4>
              <span class="kg-card-date"><i class="fas fa-circle"></i> {{ $album->event_date ? \Carbon\Carbon::parse($album->event_date)->format('d M Y') : '2026' }}</span>
            </div>
          </article>
        @endforeach
      @else
        <!-- AKADEMIK -->
        <article class="kg-card kg-card--lg" data-cat="akademik" data-reveal>
        <img src="{{ asset('images/galeri/ukk.jpeg') }}" alt="Pelaksanaan Ujian Kompetensi Keahlian (UKK) siswa SMK Negeri 2 Mojokerto" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Akademik</span>
          <h4 class="kg-card-title">Ujian Kompetensi Keahlian (UKK)</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card kg-card--wide" data-cat="akademik" data-reveal>
        <img src="{{ asset('images/galeri/pkl.jpg') }}" alt="Siswa menjalani Praktik Kerja Lapangan (PKL) di dunia industri" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Akademik</span>
          <h4 class="kg-card-title">Praktik Kerja Lapangan (PKL)</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card" data-cat="akademik" data-reveal>
        <img src="{{ asset('images/galeri/psaj.jpg') }}" alt="Pelaksanaan Penilaian Sumatif Akhir Jenjang (PSAJ)" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Akademik</span>
          <h4 class="kg-card-title">Penilaian Sumatif Akhir Jenjang (PSAJ)</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>

      <!-- EKSTRAKURIKULER -->
      <article class="kg-card kg-card--tall" data-cat="ekstrakurikuler" data-reveal>
        <img src="{{ asset('images/galeri/lacurva.jpg') }}" alt="Latihan ekstrakurikuler Lacurva" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Ekstrakurikuler</span>
          <h4 class="kg-card-title">Lacurva</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card kg-card--md" data-cat="ekstrakurikuler" data-reveal>
        <img src="{{ asset('images/galeri/tari.jpg') }}" alt="Latihan tari tradisional siswa SKANEDA" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Ekstrakurikuler</span>
          <h4 class="kg-card-title">Tari Tradisional</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card" data-cat="ekstrakurikuler" data-reveal>
        <img src="{{ asset('images/galeri/paskib.png') }}" alt="Latihan Pasukan Pengibar Bendera (Paskib)" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Ekstrakurikuler</span>
          <h4 class="kg-card-title">Paskib</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>

      <!-- KESISWAAN -->
      <article class="kg-card kg-card--wide" data-cat="kesiswaan" data-reveal>
        <img src="{{ asset('images/galeri/mpls.jpg') }}" alt="Masa Pengenalan Lingkungan Sekolah (MPLS) peserta didik baru" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kesiswaan</span>
          <h4 class="kg-card-title">MPLS Peserta Didik Baru</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card" data-cat="kesiswaan" data-reveal>
        <img src="{{ asset('images/galeri/ldkpd.jpg') }}" alt="Latihan Dasar Kepemimpinan Peserta Didik (LDKPD)" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kesiswaan</span>
          <h4 class="kg-card-title">LDKPD</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2025</span>
        </div>
      </article>
      <article class="kg-card kg-card--md" data-cat="kesiswaan" data-reveal>
        <img src="{{ asset('images/galeri/perjusa.jpg') }}" alt="Perkemahan Jumat Sabtu (Perjusa) siswa SKANEDA" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kesiswaan</span>
          <h4 class="kg-card-title">Perjusa</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>

      <!-- UPACARA -->
      <article class="kg-card kg-card--lg" data-cat="upacara" data-reveal>
        <img src="{{ asset('images/galeri/kemerdekaan.jpg') }}" alt="Upacara peringatan Hari Kemerdekaan Indonesia" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Upacara</span>
          <h4 class="kg-card-title">Hari Kemerdekaan</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card" data-cat="upacara" data-reveal>
        <img src="{{ asset('images/galeri/pramuka.jpg') }}" alt="Upacara peringatan Hari Pramuka" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Upacara</span>
          <h4 class="kg-card-title">Hari Pramuka</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2025</span>
        </div>
      </article>
      <article class="kg-card" data-cat="upacara" data-reveal>
        <img src="{{ asset('images/galeri/upacararutin.jpg') }}" alt="Upacara Rutin Hari Senin" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Upacara</span>
          <h4 class="kg-card-title">Rutin Hari Senin</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>

      <!-- KOMPETISI -->
      <article class="kg-card kg-card--wide" data-cat="kompetisi" data-reveal>
        <img src="{{ asset('images/galeri/festika.jpeg') }}" alt="Festival dan Lomba Karya (Festika) siswa SKANEDA" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kompetisi</span>
          <h4 class="kg-card-title">Festika</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2025</span>
        </div>
      </article>
      <article class="kg-card kg-card--tall" data-cat="kompetisi" data-reveal>
        <img src="{{ asset('images/galeri/lks2026.jpeg') }}" alt="Lomba Kompetensi Siswa (LKS) tingkat nasional" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kompetisi</span>
          <h4 class="kg-card-title">Lomba Kompetensi Siswa (LKS)</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card kg-card--md" data-cat="kompetisi" data-reveal>
        <img src="{{ asset('images/galeri/fiksi.jpg') }}" alt="Festival Inovasi dan Kewirausahaan Siswa Indonesia (FIKSI)" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kompetisi</span>
          <h4 class="kg-card-title">FIKSI</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2024</span>
        </div>
      </article>

      <!-- KEGIATAN SEKOLAH -->
      <article class="kg-card kg-card--lg" data-cat="kegiatan-sekolah" data-reveal>
        <img src="{{ asset('images/galeri/skrining.jpeg') }}" alt="Kegiatan skrining kesehatan siswa" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kegiatan Sekolah</span>
          <h4 class="kg-card-title">Skrining Kesehatan</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card" data-cat="kegiatan-sekolah" data-reveal>
        <img src="{{ asset('images/galeri/isramiraj.jpg') }}" alt="Peringatan hari besar keagamaan di sekolah" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kegiatan Sekolah</span>
          <h4 class="kg-card-title">Hari Besar Keagamaan</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card kg-card--md" data-cat="kegiatan-sekolah" data-reveal>
        <img src="{{ asset('images/galeri/classmeet.jpg') }}" alt="Classmeeting antar kelas SMK Negeri 2 Mojokerto" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kegiatan Sekolah</span>
          <h4 class="kg-card-title">Classmeet</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>

      <!-- KUNJUNGAN/INDUSTRI -->
      <article class="kg-card kg-card--wide" data-cat="kunjungan-industri" data-reveal>
        <img src="{{ asset('images/galeri/ki-aphp.jpeg') }}" alt="Kunjungan industri jurusan APHP" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kunjungan Industri</span>
          <h4 class="kg-card-title">Kunjungan Industri APHP</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card" data-cat="kunjungan-industri" data-reveal>
        <img src="{{ asset('images/galeri/ki-rpl.jpg') }}" alt="Kunjungan industri jurusan DKV" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kunjungan Industri</span>
          <h4 class="kg-card-title">Kunjungan Industri RPL</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card kg-card--md" data-cat="kunjungan-industri" data-reveal>
        <img src="{{ asset('images/galeri/ki-kuliner.jpeg') }}" alt="Kunjungan industri jurusan Kuliner" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kunjungan Industri</span>
          <h4 class="kg-card-title">Kunjungan Industri Kuliner</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      <article class="kg-card" data-cat="kunjungan-industri" data-reveal>
        <img src="{{ asset('images/galeri/ki-lps.jpg') }}" alt="Kunjungan industri jurusan LPS" loading="lazy" onerror="this.remove()">
        <div class="kg-card-info">
          <span class="kg-card-cat">Kunjungan Industri</span>
          <h4 class="kg-card-title">Kunjungan Industri LPS</h4>
          <span class="kg-card-date"><i class="fas fa-circle"></i> 2026</span>
        </div>
      </article>
      @endif
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
          <div class="kg-month-evt">Kunjungan Industri</div>
          <div class="kg-month-note">Belajar langsung ke dunia industri</div>
        </div>
        <div class="kg-month">
          <div class="kg-month-no">03</div>
          <div class="kg-month-name">MAR</div>
          <div class="kg-month-evt">Pembekalan PKL</div>
          <div class="kg-month-note">Membekali siswa sebelum terjun ke DUDI</div>
        </div>
        <div class="kg-month">
          <div class="kg-month-no">04</div>
          <div class="kg-month-name">APR</div>
          <div class="kg-month-evt">Pemberangkatan PKL</div>
          <div class="kg-month-note">Melepas siswa memulai praktik kerja lapangan</div>
        </div>
        <div class="kg-month">
          <div class="kg-month-no">05</div>
          <div class="kg-month-name">MEI</div>
          <div class="kg-month-evt">Pelepasan &amp; Wisuda Kelas XII</div>
          <div class="kg-month-note">Mengantar alumni menuju dunia kerja</div>
        </div>
        <div class="kg-month">
          <div class="kg-month-no">06</div>
          <div class="kg-month-name">JUN</div>
          <div class="kg-month-evt">Penerimaan Rapot</div>
          <div class="kg-month-note">Evaluasi hasil belajar satu semester</div>
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
          <div class="kg-month-evt">Penjemputan PKL</div>
          <div class="kg-month-note">Menyambut kembali siswa dari dunia industri</div>
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
        <img src="{{ asset('images/galeri/ukk.jpeg') }}" alt="Momen pelaksanaan Ujian Kompetensi Keahlian (UKK)" loading="lazy" onerror="this.remove()">
        <div class="kg-pick-caption">
          <span>Momen Pilihan</span>
          <strong>"Ujian Kompetensi Keahlian, bukti nyata dari setiap keterampilan yang diasah."</strong>
        </div>
      </div>
      <div class="kg-pick-side">
        <div class="kg-pick-small" data-reveal>
          <img src="{{ asset('images/galeri/ki-kuliner.jpeg') }}" alt="Kunjungan industri siswa SKANEDA" loading="lazy" onerror="this.remove()">
          <span><i class="fas fa-circle"></i> Kunjungan Industri</span>
        </div>
        <div class="kg-pick-small" data-reveal>
          <img src="{{ asset('images/galeri/lks.jpg') }}" alt="Lomba Kompetensi Siswa (LKS)" loading="lazy" onerror="this.remove()">
          <span><i class="fas fa-circle"></i> LKS</span>
        </div>
        <div class="kg-pick-small" data-reveal>
          <img src="{{ asset('images/galeri/fiksi.jpg') }}" alt="Festival Inovasi dan Kewirausahaan Siswa Indonesia (FIKSI)" loading="lazy" onerror="this.remove()">
          <span><i class="fas fa-circle"></i> FIKSI</span>
        </div>
        <div class="kg-pick-small" data-reveal>
          <img src="{{ asset('images/galeri/pkl.jpg') }}" alt="Praktik Kerja Lapangan (PKL) siswa" loading="lazy" onerror="this.remove()">
          <span><i class="fas fa-circle"></i> PKL</span>
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

<!-- ================= LIGHTBOX ALBUM MODAL ================= -->
<div class="kg-album-modal" id="kgAlbumModal" aria-hidden="true">
  <div class="kg-album-dialog" role="dialog" aria-modal="true">
    <div class="kg-album-header">
      <div>
        <h3 class="kg-album-title" id="kgAlbumTitle">Album Kegiatan</h3>
        <div class="kg-album-meta">
          <span id="kgAlbumCat">Dokumentasi</span>
          <span>•</span>
          <span id="kgAlbumDate">SMK Negeri 2 Mojokerto</span>
        </div>
      </div>
      <button type="button" class="kg-album-close" id="kgAlbumClose" aria-label="Tutup"><i class="fas fa-times"></i></button>
    </div>
    <div class="kg-album-body">
      <button type="button" class="kg-album-arrow prev" id="kgAlbumPrev" aria-label="Foto Sebelumnya"><i class="fas fa-chevron-left"></i></button>
      <img src="" alt="" class="kg-album-img" id="kgAlbumImg">
      <button type="button" class="kg-album-arrow next" id="kgAlbumNext" aria-label="Foto Berikutnya"><i class="fas fa-chevron-right"></i></button>
    </div>
    <div class="kg-album-footer">
      <p class="kg-album-caption" id="kgAlbumCaption">Dokumentasi momen kegiatan sekolah.</p>
      <span class="kg-album-counter" id="kgAlbumCounter">1 / 1</span>
    </div>
  </div>
</div>

</div>

@endsection

@push('scripts')
<script>
(function () {
  'use strict';

  /* ---------- SINKRON DARK MODE SITUS -> body.kg-dark ----------
     Dark mode layout situs punya class sendiri (bukan kg-dark). Fungsi ini
     membaca status dark mode situs (class/atribut di <html> & <body>, atau
     kecerahan background body sebagai cadangan) lalu memasang/melepas class
     "kg-dark" di <body> secara otomatis, termasuk saat tombol toggle ditekan. */
  (function syncDarkMode() {
    var html = document.documentElement;
    var body = document.body;
    var addedByUs = false;
    var ATTRS = ['data-theme', 'data-bs-theme', 'data-mode', 'data-color-scheme', 'data-color-mode'];

    function hasDarkToken(el) {
      var tokens = el.className && el.className.split ? el.className.split(/\s+/) : [];
      for (var i = 0; i < tokens.length; i++) {
        if (tokens[i] !== 'kg-dark' && tokens[i] !== 'fc-dark' && /dark|night/i.test(tokens[i])) return true;
      }
      for (var j = 0; j < ATTRS.length; j++) {
        var v = el.getAttribute(ATTRS[j]);
        if (v && /dark|night/i.test(v)) return true;
      }
      return false;
    }

    function bgIsDark(el) {
      var c = window.getComputedStyle(el).backgroundColor || '';
      var m = c.match(/rgba?\(\s*(\d+)[,\s]+(\d+)[,\s]+(\d+)(?:[,\s/]+([\d.]+))?/);
      if (!m) return null;
      var a = m[4] === undefined ? 1 : parseFloat(m[4]);
      if (a < 0.5) return null;
      var lum = (0.2126 * m[1] + 0.7152 * m[2] + 0.0722 * m[3]) / 255;
      return lum < 0.3;
    }

    function isSiteDark() {
      if (hasDarkToken(html) || hasDarkToken(body)) return true;
      var b = bgIsDark(body);
      if (b === null) b = bgIsDark(html);
      return b === true;
    }

    /* cadangan inline !important untuk kolom search (inline style asli berwarna putih) */
    function styleSearchInput(dark) {
      var si = document.getElementById('kgSearchInput');
      if (!si) return;
      var props = {
        'background': '#0f2340',
        'background-color': '#0f2340',
        'border': '1.5px solid rgba(255,255,255,.14)',
        'color': '#ffffff',
        '-webkit-text-fill-color': '#ffffff',
        'outline': 'none'
      };
      Object.keys(props).forEach(function (p) {
        if (dark) si.style.setProperty(p, props[p], 'important');
        else si.style.removeProperty(p);
      });
      var wrap = si.parentNode;
      if (wrap) {
        ['background', 'border', 'box-shadow', 'padding'].forEach(function (p) {
          if (dark) wrap.style.setProperty(p, p === 'padding' ? '0' : 'none', 'important');
          else wrap.style.removeProperty(p);
        });
      }
    }

    function apply() {
      var dark = isSiteDark();
      if (dark) {
        if (!body.classList.contains('kg-dark')) { body.classList.add('kg-dark'); addedByUs = true; }
      } else if (addedByUs) {
        body.classList.remove('kg-dark');
        addedByUs = false;
      }
      styleSearchInput(body.classList.contains('kg-dark'));
    }

    function applySoon() {
      apply();
      setTimeout(apply, 80);
      setTimeout(apply, 500);
    }

    try {
      var mo = new MutationObserver(function () { applySoon(); });
      var opts = { attributes: true, attributeFilter: ['class'].concat(ATTRS) };
      mo.observe(html, opts);
      mo.observe(body, opts);
    } catch (e) {}
    document.addEventListener('click', function () { setTimeout(apply, 120); setTimeout(apply, 520); });
    window.addEventListener('storage', applySoon);
    applySoon();
  })();

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
  var masonry = document.getElementById('kgMasonry');
  var cards = document.querySelectorAll('.kg-masonry .kg-card');
  var activeFilter = 'semua';

  var searchInput = document.getElementById('kgSearchInput');

  function applyFilter() {
    var searchQuery = (searchInput ? searchInput.value : '').toLowerCase().trim();

    cards.forEach(function (card) {
      var cat = (card.getAttribute('data-cat') || 'semua').toLowerCase();
      var title = (card.getAttribute('data-title') || card.querySelector('.kg-card-title, .kg-feat-title')?.textContent || '').toLowerCase();
      
      var matchesCat = (activeFilter === 'semua' || cat === activeFilter);
      var matchesSearch = (!searchQuery || title.indexOf(searchQuery) !== -1);

      var show = matchesCat && matchesSearch;
      card.style.display = show ? '' : 'none';
      if (show) {
        card.style.animation = 'none';
        void card.offsetWidth;
        card.style.animation = '';
      }
    });

    if (masonry) {
      masonry.classList.toggle('is-filtered', activeFilter !== 'semua' || searchQuery !== '');
    }
  }

  if (searchInput) {
    searchInput.addEventListener('input', applyFilter);
  }

  filterBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      filterBtns.forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');
      activeFilter = btn.getAttribute('data-filter') || 'semua';
      applyFilter();
    });
  });

  /* ---------- LIGHTBOX ALBUM MODAL INTERACTIVITY ---------- */
  var modal = document.getElementById('kgAlbumModal');
  var closeBtn = document.getElementById('kgAlbumClose');
  var titleEl = document.getElementById('kgAlbumTitle');
  var catEl = document.getElementById('kgAlbumCat');
  var dateEl = document.getElementById('kgAlbumDate');
  var imgEl = document.getElementById('kgAlbumImg');
  var captionEl = document.getElementById('kgAlbumCaption');
  var counterEl = document.getElementById('kgAlbumCounter');
  var prevBtn = document.getElementById('kgAlbumPrev');
  var nextBtn = document.getElementById('kgAlbumNext');

  var currentPhotos = [];
  var currentIndex = 0;

  function openAlbum(title, category, date, photos, caption) {
    if (!modal) return;
    currentPhotos = photos && photos.length ? photos : [];
    currentIndex = 0;
    titleEl.textContent = title || 'Dokumentasi Kegiatan';
    catEl.textContent = category || 'Kegiatan';
    dateEl.textContent = date || 'SMK Negeri 2 Mojokerto';
    captionEl.textContent = caption || title || '';
    updateModalImage();
    modal.classList.add('open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    if (!modal) return;
    modal.classList.remove('open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  function updateModalImage() {
    if (!currentPhotos.length) return;
    imgEl.src = currentPhotos[currentIndex];
    counterEl.textContent = (currentIndex + 1) + ' / ' + currentPhotos.length;
  }

  prevBtn && prevBtn.addEventListener('click', function (e) {
    e.stopPropagation();
    if (!currentPhotos.length) return;
    currentIndex = (currentIndex - 1 + currentPhotos.length) % currentPhotos.length;
    updateModalImage();
  });

  nextBtn && nextBtn.addEventListener('click', function (e) {
    e.stopPropagation();
    if (!currentPhotos.length) return;
    currentIndex = (currentIndex + 1) % currentPhotos.length;
    updateModalImage();
  });

  closeBtn && closeBtn.addEventListener('click', closeModal);
  modal && modal.addEventListener('click', function (e) {
    if (e.target === modal) closeModal();
  });

  document.addEventListener('keydown', function (e) {
    if (!modal || !modal.classList.contains('open')) return;
    if (e.key === 'Escape') closeModal();
    if (e.key === 'ArrowLeft') prevBtn.click();
    if (e.key === 'ArrowRight') nextBtn.click();
  });

  /* Attach click event to all cards */
  document.querySelectorAll('.kg-card, .kg-feat').forEach(function (card) {
    card.addEventListener('click', function () {
      var photosAttr = card.getAttribute('data-photos');
      if (photosAttr) {
        try {
          var photos = JSON.parse(photosAttr);
          var title = card.getAttribute('data-title') || 'Dokumentasi Kegiatan';
          var cat = card.getAttribute('data-category') || 'Kegiatan';
          var date = card.getAttribute('data-date') || '2026';
          var desc = card.getAttribute('data-desc') || title;
          if (photos && photos.length) {
            openAlbum(title, cat, date, photos, desc);
            return;
          }
        } catch(e) {}
      }

      var img = card.querySelector('img');
      var title = card.querySelector('.kg-card-title, .kg-feat-title');
      var cat = card.querySelector('.kg-card-cat, .kg-feat-tag');
      var date = card.querySelector('.kg-card-date');
      
      var imgSrc = img ? img.src : '';
      var titleText = title ? title.textContent : 'Dokumentasi Kegiatan';
      var catText = cat ? cat.textContent : 'Kegiatan';
      var dateText = date ? date.textContent : '2026';

      if (imgSrc) {
        openAlbum(titleText, catText, dateText, [imgSrc], titleText);
      }
    });
  });

})();
</script>
@endpush