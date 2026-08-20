@extends('layouts.app')

@section('title', 'PPDB — Penerimaan Peserta Didik Baru — SMK Negeri 2 Mojokerto')
@section('description', 'PPDB (Penerimaan Peserta Didik Baru) SMK Negeri 2 Mojokerto — jalur pendaftaran, persyaratan, alur, jadwal penting, program keahlian, dan FAQ.')

@push('styles')
<style>
/* =========================================================
   PPDB — PENERIMAAN PESERTA DIDIK BARU
   Visual language: SENADA PERSIS dengan Guru & Staf, Sejarah
   Sekolah, Struktur Organisasi & Visi Misi — foto gedung +
   overlay, watermark typography, ornamen geometris (home-orn),
   glassmorphism, scroll-reveal. Header & footer dari
   layouts.app (identik).
   KONTEN UTAMA UNIK (tidak meniru layout file referensi):
   banner resmi PPDB, jalur cards, persyaratan checklist,
   alur timeline, jadwal tabel, program keahlian cards,
   FAQ accordion.
   Warna: navy #0d3a66, biru #2f6fa8, putih, gold #ffd54a/#ffb300.
   ========================================================= */
.pd-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}
.pd-page *{box-sizing:border-box}
.pd-shell{width:100%}

/* ---------- HERO: 100% MIRIP HALAMAN SEJARAH SEKOLAH ---------- */
.pd-hero{position:relative;min-height:clamp(620px,78vh,790px);display:flex;align-items:center;overflow:hidden;background:#fff;color:#0d3a66;isolation:isolate}
.pd-hero::before{display:none}
.pd-hero::after{content:"PPDB";position:absolute;z-index:0;left:2%;top:58%;transform:translateY(-50%);font-family:var(--font-display);font-size:clamp(9rem,23vw,23rem);font-weight:900;line-height:.78;letter-spacing:.015em;color:rgba(13,58,102,.035);-webkit-text-stroke:1px rgba(255,122,0,.09);pointer-events:none;white-space:nowrap;user-select:none}
.pd-ref-ornaments{position:absolute!important;inset:0;z-index:1;overflow:hidden;pointer-events:none;opacity:1}
.pd-ref-ornament-image{position:absolute!important;inset:0;width:100%;height:100%;display:block;object-fit:cover;object-position:center center;max-width:none;opacity:1}
.pd-hero-inner{position:relative;z-index:4;width:100%;max-width:1500px;margin:0 auto;padding:clamp(4rem,10vh,7rem) clamp(1.25rem,4.2vw,4.5rem) clamp(4rem,9vh,6rem);display:block}
.pd-kicker{position:relative;z-index:5;display:inline-flex;align-items:center;gap:.65rem;font-size:.72rem;font-weight:900;letter-spacing:.18em;text-transform:uppercase;color:#ff6f00;margin-bottom:1.2rem;padding:.55rem .85rem;border:1px solid rgba(255,111,0,.18);border-radius:999px;background:#fffaf5}
.pd-kicker::before{content:"";width:9px;height:9px;border-radius:50%;background:#ff6f00;box-shadow:0 0 0 6px rgba(255,111,0,.10)}
.pd-title{position:relative;z-index:5;font-family:var(--font-display);font-size:clamp(4.4rem,9.8vw,9.3rem);line-height:.82;letter-spacing:-.045em;margin:0;max-width:900px;text-transform:uppercase;text-shadow:none;animation:hdFadeUp .7s .1s var(--ease,ease) both}
.pd-title .pd-white{color:#0d3a66;display:block}
.pd-title .pd-gold{display:block;background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent;text-shadow:none;letter-spacing:-.025em}
.pd-lead{font-size:1rem;line-height:1.75;color:#52657a;max-width:720px;margin:1.7rem 0 0;animation:hdFadeUp .7s .26s var(--ease,ease) both}
.pd-hero-meta{display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;animation:hdFadeUp .7s .4s var(--ease,ease) both}
.pd-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;border:1px solid rgba(13,58,102,.12);background:#fff;border-radius:999px;color:#0d3a66;font-size:.72rem;font-weight:800;box-shadow:0 8px 24px rgba(13,58,102,.06);backdrop-filter:none;-webkit-backdrop-filter:none}
.pd-pill i{color:#ff7a00}
.hero-photo{display:none}
.hero-photo::before,.hero-photo img,.hero-photo-caption{display:none}
@keyframes hdFadeUp{from{opacity:0;transform:translateY(26px)}to{opacity:1;transform:none}}
@media(min-width:1050px){.pd-hero-inner{padding-right:44%}}
@media(max-width:1050px){.pd-hero-inner{padding-right:1.25rem}.pd-ref-ornaments{opacity:.72}}
@media(max-width:900px){.pd-title{font-size:clamp(4rem,11vw,7rem)}.pd-ref-ornament-image{opacity:.88}}
@media(max-width:700px){.pd-hero{align-items:flex-start}.pd-hero-inner{width:90%}.pd-title{font-size:clamp(3rem,14vw,5rem)}}
@media(max-width:560px){.pd-ref-ornament-image{opacity:.62}}

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
.home-orn .ho-ring{position:absolute;width:170px;height:170px;border:1px solid rgba(13,58,102,.13);
  border-radius:50%}
.home-orn .ho-ring::before{content:"";position:absolute;inset:22px;border:1px dashed rgba(47,111,168,.18);border-radius:50%}
.home-orn .ho-gold{position:absolute;width:52px;height:8px;border-radius:99px;
  background:linear-gradient(90deg,#ffd54a,#ffb300)}
.home-orn .ho-square{position:absolute;width:58px;height:58px;border:2px solid rgba(255,179,0,.32);transform:rotate(45deg)}
.home-orn .ho-square::before{content:"";position:absolute;inset:10px;border:1px solid rgba(13,58,102,.18)}
.home-orn .ho-corner{position:absolute;width:110px;height:110px;
  border-top:2px solid rgba(255,179,0,.55);border-right:2px solid rgba(255,179,0,.55);border-radius:0 26px 0 0}
.home-orn .ho-corner::after{content:"";position:absolute;left:18px;bottom:18px;width:46px;height:3px;
  background:rgba(13,58,102,.16)}

/* posisi ornamen per section */
.pd-intro .home-orn .ho-chevron{right:-145px;top:45px}
.pd-intro .home-orn .ho-line{left:-80px;top:170px}
.pd-intro .home-orn .ho-dots{left:3%;bottom:100px}
.pd-intro .home-orn .ho-ring{right:8%;bottom:90px}
.pd-intro .home-orn .ho-gold{right:16%;top:22%}
.pd-intro .home-orn .ho-square{left:11%;top:15%}
.pd-intro .home-orn .ho-corner{right:3%;bottom:8%;transform:rotate(180deg)}
.pd-track .home-orn .ho-chevron{left:-145px;bottom:-60px}
.pd-track .home-orn .ho-line{right:-80px;bottom:170px}
.pd-track .home-orn .ho-dots{right:4%;top:90px}
.pd-track .home-orn .ho-ring{left:7%;top:70px}
.pd-track .home-orn .ho-gold{left:20%;top:30%}
.pd-jurusan .home-orn .ho-chevron{right:-150px;top:-40px}
.pd-jurusan .home-orn .ho-dots{left:5%;bottom:120px}
.pd-jurusan .home-orn .ho-ring{right:6%;bottom:60px}
.pd-jurusan .home-orn .ho-square{right:14%;top:18%}
.pd-jurusan .home-orn .ho-gold{left:12%;top:34%}
.pd-faq .home-orn .ho-chevron{left:-150px;top:30px}
.pd-faq .home-orn .ho-dots{right:5%;top:60px}
.pd-faq .home-orn .ho-ring{left:6%;bottom:70px}
.pd-faq .home-orn .ho-square{right:10%;bottom:12%}
.pd-faq .home-orn .ho-gold{right:20%;top:28%}
.pd-cta .home-orn .ho-chevron{left:-120px;bottom:-80px;border-color:rgba(255,255,255,.10)}
.pd-cta .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.pd-cta .home-orn .ho-dots{left:8%;top:30%;opacity:.22}
.pd-cta .home-orn .ho-ring{right:-70px;top:20%;border-color:rgba(255,255,255,.10)}
.pd-cta .home-orn .ho-gold{left:20%;bottom:26%}

.pd-hero>*:not(.home-orn):not(.pd-ref-ornaments),
.pd-intro>*:not(.home-orn),
.pd-track>*:not(.home-orn),
.pd-jurusan>*:not(.home-orn),
.pd-faq>*:not(.home-orn),
.pd-cta>*:not(.home-orn){position:relative;z-index:2}

/* ---------- SECTION SHELL & HEADING ---------- */
.pd-section{width:min(1180px,92%);margin:0 auto}
.pd-intro{position:relative;padding:96px 0 110px;background:#fff}
.pd-intro-grid{display:grid;grid-template-columns:.95fr 1.05fr;gap:4.5rem;align-items:center}

.big-heading{font-family:var(--font-display);font-size:clamp(1.7rem,3.4vw,2.6rem);font-weight:800;
  line-height:1.16;letter-spacing:.01em;margin:0;color:#0d3a66}
.big-heading span{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 60%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.pd-intro-note{max-width:420px;color:#718396;font-size:.84rem;line-height:1.8;margin-top:1rem}

/* ---------- 1. PENGERTIAN PPDB (banner + definition stack) ---------- */
.pd-def-stack{display:grid;gap:.8rem}
.pd-def-row{display:flex;align-items:center;gap:1.2rem;background:#f3f7fb;border:1px solid #e3edf0;
  border-radius:18px;padding:1.1rem 1.3rem;transition:transform .35s var(--ease, ease),box-shadow .35s var(--ease, ease)}
.pd-def-row:hover{transform:translateX(8px);box-shadow:0 14px 34px rgba(13,58,102,.10);border-color:rgba(13,58,102,.25)}
.pd-def-index{font-family:var(--font-display);font-size:1.35rem;font-weight:900;color:#fff;min-width:52px;height:52px;
  border-radius:14px;display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,#0d3a66,#2f6fa8)}
.pd-def-row:nth-child(2) .pd-def-index{background:linear-gradient(135deg,#2f6fa8,#0d3a66)}
.pd-def-row:nth-child(3) .pd-def-index{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52}
.pd-def-text h3{margin:0;font-family:var(--font-display);font-size:1.02rem;font-weight:800;color:#0d3a66}
.pd-def-text p{margin:.25rem 0 0;font-size:.82rem;line-height:1.7;color:#718396}

.pd-banner{position:relative;border-radius:24px;overflow:hidden;box-shadow:0 30px 70px rgba(13,58,102,.18);
  border:1px solid rgba(255,255,255,.25)}
.pd-banner img{width:100%;display:block;object-fit:cover}
.pd-banner-flag{position:absolute;left:0;bottom:0;right:0;z-index:2;padding:1.1rem 1.4rem;
  background:linear-gradient(180deg,transparent,rgba(7,22,42,.78));color:#fff}
.pd-banner-flag strong{display:block;font-family:var(--font-display);font-size:1.06rem;font-weight:800;color:#ffd54a}
.pd-banner-flag span{font-size:.76rem;color:rgba(235,245,253,.85)}

/* ---------- 2. JALUR PENDAFTARAN ---------- */
.pd-track{position:relative;padding:96px 0 110px;
  background-image:radial-gradient(rgba(13,58,102,.055) 1.4px,transparent 1.5px);background-size:22px 22px}
.pd-track-head{display:flex;justify-content:space-between;align-items:end;gap:2rem;flex-wrap:wrap}
.pd-track-note{max-width:360px;color:#718396;font-size:.8rem;line-height:1.7}
.pd-track-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.3rem;margin-top:3rem}
.pd-track-card{position:relative;background:#fff;border:1px solid #e3edf0;border-radius:22px;padding:1.7rem 1.5rem 1.6rem;
  transition:transform .35s var(--ease, ease),box-shadow .35s var(--ease, ease),border-color .35s var(--ease, ease)}
.pd-track-card:hover{transform:translateY(-8px);box-shadow:0 26px 55px rgba(13,58,102,.14);border-color:rgba(13,58,102,.22)}
.pd-track-card::after{content:"";position:absolute;right:-24px;bottom:-28px;width:80px;height:80px;
  background:radial-gradient(rgba(13,58,102,.09) 1.6px,transparent 1.7px);background-size:12px 12px;
  border-radius:50%;transition:transform .4s var(--ease, ease)}
.pd-track-card:hover::after{transform:rotate(90deg)}
.pd-track-no{position:absolute;top:1.1rem;right:1.3rem;font-family:var(--font-display);
  font-size:2.1rem;font-weight:900;line-height:1;color:rgba(13,58,102,.08)}
.pd-track-icon{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;
  font-size:1.35rem;color:#fff;background:linear-gradient(135deg,#0d3a66,#2f6fa8);
  transition:transform .35s var(--ease, ease)}
.pd-track-card:nth-child(2) .pd-track-icon{background:linear-gradient(135deg,#2f6fa8,#0d3a66)}
.pd-track-card:nth-child(3) .pd-track-icon{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52}
.pd-track-card:nth-child(4) .pd-track-icon{background:linear-gradient(135deg,#5a89b8,#2f6fa8)}
.pd-track-card:hover .pd-track-icon{transform:rotate(-8deg) scale(1.06)}
.pd-track-name{font-family:var(--font-display);font-size:1.08rem;font-weight:800;color:#0d3a66;margin:.95rem 0 .35rem}
.pd-track-kuota{display:inline-block;font-size:.7rem;font-weight:800;letter-spacing:.06em;color:#b45309;
  background:rgba(255,213,74,.28);border:1px solid rgba(255,179,0,.4);border-radius:999px;padding:.22rem .6rem;margin-bottom:.6rem}
.pd-track-text{font-size:.82rem;line-height:1.75;color:#718396;margin:0}

/* ---------- 3. PERSYARATAN ---------- */
.pd-req{position:relative;padding:100px 0 110px;background:#fff;overflow:hidden}
.pd-req::before{content:"SYARAT";position:absolute;left:-1%;top:8%;transform:rotate(-90deg);
  font-family:var(--font-display);font-size:clamp(4.5rem,11vw,9rem);font-weight:900;line-height:1;
  letter-spacing:.04em;color:rgba(13,58,102,.045);white-space:nowrap;pointer-events:none;user-select:none}
.pd-req-card{position:relative;background:#fff;border:1px solid #e3edf0;border-radius:24px;
  padding:2.2rem 2.4rem;box-shadow:0 18px 46px rgba(13,58,102,.07);overflow:hidden}
.pd-req-card::before{content:"";position:absolute;left:0;right:0;top:0;height:5px;
  background:linear-gradient(90deg,#0d3a66,#2f6fa8 45%,#ffd54a)}
.pd-req-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem 2.6rem;margin-top:1.6rem}
.pd-req-item{display:flex;gap:.9rem;align-items:flex-start;padding:.85rem 0;border-bottom:1px dashed #e3edf0}
.pd-req-item:last-child{border-bottom:none}
.pd-req-item i{color:#2f6fa8;font-size:1rem;margin-top:.2rem}
.pd-req-item strong{display:block;font-size:.88rem;color:#0d3a66;font-weight:800}
.pd-req-item span{font-size:.78rem;color:#718396;line-height:1.6}
.pd-req-note{display:flex;align-items:center;gap:.8rem;margin-top:1.6rem;padding:1rem 1.2rem;border-radius:14px;
  background:rgba(255,213,74,.14);border:1px solid rgba(255,179,0,.35);font-size:.8rem;line-height:1.7;color:#7a4b07}

/* ---------- 4. ALUR PENDAFTARAN (timeline) ---------- */
.pd-flow{position:relative;padding:96px 0 110px;
  background-image:radial-gradient(rgba(13,58,102,.055) 1.4px,transparent 1.5px);background-size:22px 22px}
.pd-flow-track{position:relative;margin-top:3.2rem}
.pd-flow-track::before{content:"";position:absolute;left:0;right:0;top:34px;height:3px;
  background:linear-gradient(90deg,#0d3a66,#2f6fa8 50%,#ffd54a);border-radius:99px}
.pd-flow-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:1rem}
.pd-flow-step{text-align:center;position:relative}
.pd-flow-dot{width:68px;height:68px;margin:0 auto;border-radius:50%;display:flex;align-items:center;justify-content:center;
  font-family:var(--font-display);font-size:1.3rem;font-weight:900;color:#fff;position:relative;z-index:2;
  background:linear-gradient(135deg,#0d3a66,#2f6fa8);box-shadow:0 12px 28px rgba(13,58,102,.3)}
.pd-flow-step:nth-child(2) .pd-flow-dot{background:linear-gradient(135deg,#2f6fa8,#0d3a66)}
.pd-flow-step:nth-child(3) .pd-flow-dot{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52}
.pd-flow-step:nth-child(4) .pd-flow-dot{background:linear-gradient(135deg,#2f6fa8,#0d3a66)}
.pd-flow-step:nth-child(5) .pd-flow-dot{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52}
.pd-flow-step:nth-child(6) .pd-flow-dot{background:linear-gradient(135deg,#5a89b8,#2f6fa8)}
.pd-flow-title{font-family:var(--font-display);font-size:.92rem;font-weight:800;color:#0d3a66;margin:.95rem 0 .25rem}
.pd-flow-text{font-size:.74rem;line-height:1.6;color:#718396;margin:0;max-width:150px;margin-left:auto;margin-right:auto}

/* ---------- 5. JADWAL PENTING (tabel) ---------- */
.pd-jadwal{position:relative;padding:100px 0 110px;background:#fff;overflow:hidden}
.pd-jadwal-card{position:relative;border-radius:26px;overflow:hidden;margin-top:3rem;
  background:linear-gradient(135deg,#0b3558,#0d3a66 55%,#123f6e);color:#fff;box-shadow:0 30px 70px rgba(13,58,102,.35)}
.pd-jadwal-card::before{content:"";position:absolute;left:0;right:0;top:0;height:4px;
  background:linear-gradient(90deg,#ffd54a,#ffb300)}
.pd-jadwal-card::after{content:"";position:absolute;right:-50px;bottom:-60px;width:180px;height:180px;
  border:2px solid rgba(255,213,74,.14);border-radius:50%}
.pd-jadwal-head{display:flex;justify-content:space-between;align-items:center;gap:1rem;padding:1.6rem 2.2rem;
  border-bottom:1px solid rgba(255,255,255,.12)}
.pd-jadwal-head h3{margin:0;font-family:var(--font-display);font-size:1.3rem;font-weight:800;color:#fff}
.pd-jadwal-head h3 i{color:#ffd54a;margin-right:.6rem}
.pd-jadwal-badge{display:inline-flex;align-items:center;gap:.5rem;padding:.45rem .8rem;border-radius:999px;
  background:rgba(255,213,74,.16);border:1px solid rgba(255,213,74,.4);color:#ffd54a;font-size:.72rem;font-weight:800}
.pd-jadwal-table{position:relative;z-index:2;width:100%;border-collapse:collapse}
.pd-jadwal-table th{font-family:var(--font-display);font-size:.76rem;font-weight:800;letter-spacing:.08em;
  text-transform:uppercase;color:rgba(255,213,74,.92);text-align:left;padding:1.1rem 2.2rem .7rem}
.pd-jadwal-table td{padding:.95rem 2.2rem;border-top:1px solid rgba(255,255,255,.09);
  font-size:.84rem;color:rgba(235,245,253,.9);vertical-align:top}
.pd-jadwal-table td:first-child{font-family:var(--font-display);font-weight:800;color:#fff;white-space:nowrap}
.pd-jadwal-table tr:hover td{background:rgba(255,255,255,.05)}
.pd-jadwal-foot{position:relative;z-index:2;padding:1.1rem 2.2rem;border-top:1px solid rgba(255,255,255,.12);
  font-size:.78rem;color:rgba(235,245,253,.7)}
.pd-jadwal-foot i{color:#ffd54a;margin-right:.45rem}

/* ---------- 6. PROGRAM KEAHLIAN ---------- */
.pd-jurusan{position:relative;padding:96px 0 110px;
  background-image:radial-gradient(rgba(13,58,102,.055) 1.4px,transparent 1.5px);background-size:22px 22px}
.pd-jurusan-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.3rem;margin-top:3rem}
.pd-jurusan-card{position:relative;background:#fff;border:1px solid #e3edf0;border-radius:22px;overflow:hidden;
  transition:transform .35s var(--ease, ease),box-shadow .35s var(--ease, ease)}
.pd-jurusan-card:hover{transform:translateY(-8px);box-shadow:0 26px 55px rgba(13,58,102,.14)}
.pd-jurusan-photo{position:relative;height:185px;overflow:hidden}
.pd-jurusan-photo img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .5s var(--ease, ease)}
.pd-jurusan-card:hover .pd-jurusan-photo img{transform:scale(1.07)}
.pd-jurusan-photo::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 45%,rgba(7,22,42,.55))}
.pd-jurusan-body{padding:1.3rem 1.4rem 1.5rem}
.pd-jurusan-tag{display:inline-block;font-size:.66rem;font-weight:800;letter-spacing:.08em;color:#2f6fa8;
  background:rgba(47,111,168,.1);border:1px solid rgba(47,111,168,.25);border-radius:999px;padding:.22rem .6rem;margin-bottom:.6rem}
.pd-jurusan-name{font-family:var(--font-display);font-size:1.04rem;font-weight:800;color:#0d3a66;margin:0 0 .4rem;line-height:1.3}
.pd-jurusan-text{font-size:.8rem;line-height:1.7;color:#718396;margin:0}
.pd-jurusan-more{display:inline-flex;align-items:center;gap:.45rem;margin-top:1rem;font-size:.8rem;font-weight:800;color:#0d3a66}
.pd-jurusan-more i{color:#ffb300;transition:transform .3s var(--ease, ease)}
.pd-jurusan-card:hover .pd-jurusan-more i{transform:translateX(5px)}

/* ---------- 7. FAQ ---------- */
.pd-faq{position:relative;padding:96px 0 110px;background:#fff}
.pd-faq-list{max-width:820px;margin:2.6rem auto 0;display:grid;gap:.85rem}
.pd-faq-item{background:#f7f9fc;border:1px solid #e3edf0;border-radius:16px;overflow:hidden;
  transition:border-color .3s var(--ease, ease),box-shadow .3s var(--ease, ease)}
.pd-faq-item.open{border-color:rgba(47,111,168,.4);box-shadow:0 14px 34px rgba(13,58,102,.09)}
.pd-faq-q{width:100%;display:flex;justify-content:space-between;align-items:center;gap:1rem;text-align:left;
  background:none;border:none;cursor:pointer;padding:1.15rem 1.4rem;font-family:var(--font-body);
  font-size:.92rem;font-weight:800;color:#0d3a66}
.pd-faq-q i{color:#ffb300;font-size:.85rem;transition:transform .3s var(--ease, ease);flex-shrink:0}
.pd-faq-item.open .pd-faq-q i{transform:rotate(180deg)}
.pd-faq-a{max-height:0;overflow:hidden;transition:max-height .35s var(--ease, ease)}
.pd-faq-a p{margin:0;padding:0 1.4rem 1.25rem;font-size:.84rem;line-height:1.8;color:#718396}

/* ---------- CTA ---------- */
.pd-cta{position:relative;width:min(1180px,92%);margin:0 auto 5.5rem;padding:64px 5% 68px;text-align:center;
  border-radius:28px;overflow:hidden;color:#fff;
  background:linear-gradient(135deg,#0a2d52,#0d3a66 55%,#123f6e);
  box-shadow:0 34px 80px rgba(13,58,102,.35)}
.pd-cta::before{content:"";position:absolute;left:0;right:0;top:0;height:4px;
  background:linear-gradient(90deg,#ffd54a,#ffb300)}
.pd-cta h2{font-family:var(--font-display);font-size:clamp(1.7rem,3.6vw,2.7rem);font-weight:800;margin:0;line-height:1.2}
.pd-cta h2 em{font-style:normal;background:linear-gradient(135deg,#ffe66d,#ffc107 55%,#ff8a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.pd-cta p{max-width:560px;margin:1.1rem auto 1.9rem;font-size:.92rem;line-height:1.85;color:rgba(235,245,253,.85)}
.pd-cta-btn{display:inline-flex;align-items:center;gap:.6rem;padding:.95rem 2rem;border-radius:999px;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52;font-weight:800;font-size:.92rem;
  text-decoration:none;box-shadow:0 16px 36px rgba(255,179,0,.32);transition:transform .3s var(--ease, ease),box-shadow .3s var(--ease, ease)}
.pd-cta-btn:hover{transform:translateY(-3px);box-shadow:0 22px 46px rgba(255,179,0,.42)}
.pd-cta-note{margin-top:1.1rem;font-size:.76rem;color:rgba(235,245,253,.65)}
.pd-cta-note i{color:#ffd54a;margin-right:.4rem}

/* ---------- SCROLL REVEAL ---------- */
[data-reveal]{opacity:0;transform:translateY(36px);
  transition:opacity .7s ease,transform .7s var(--ease, ease)}
[data-reveal="left"]{transform:translateX(-46px)}
[data-reveal="right"]{transform:translateX(46px)}
[data-reveal].revealed{opacity:1;transform:none}
[data-reveal]{transition-delay:calc(var(--d,0)*90ms)}

/* ---------- RESPONSIVE ---------- */
@media(max-width:1200px){
  .pd-track-grid{grid-template-columns:repeat(2,1fr)}
  .pd-jurusan-grid{grid-template-columns:repeat(2,1fr)}
  .pd-flow-grid{grid-template-columns:repeat(3,1fr);gap:2rem 1rem}
  .pd-flow-track::before{display:none}
}
@media(max-width:950px){
  .pd-intro-grid{grid-template-columns:1fr;gap:3rem}
  .pd-req-grid{grid-template-columns:1fr;gap:0 2.6rem}
}
@media(max-width:700px){
  .pd-section,.pd-intro,.pd-track{padding:85px 0 90px}
  .pd-req,.pd-jadwal,.pd-jurusan{padding:85px 0 90px}
  .pd-flow{padding:85px 0 90px}
  .pd-cta{padding:56px 5% 64px;margin-bottom:4.5rem;width:92%;margin-left:auto;margin-right:auto}
  .pd-track-grid{grid-template-columns:1fr}
  .pd-jurusan-grid{grid-template-columns:1fr}
  .pd-flow-grid{grid-template-columns:1fr 1fr;gap:1.4rem .8rem}
  .pd-req-card{padding:1.6rem 1.3rem}
  .pd-jadwal-table th,.pd-jadwal-table td{padding:.8rem 1.2rem}
  .pd-jadwal-head{flex-direction:column;align-items:flex-start;padding:1.3rem 1.2rem}
  .pd-def-row{flex-direction:column;align-items:flex-start;gap:.8rem}
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
<div class="pd-page">

  <!-- HERO (100% mirip halaman Sejarah Sekolah: watermark + ornamen foto + judul besar) -->
  <section class="pd-hero">
    <div class="pd-ref-ornaments" aria-hidden="true" style="background-image:url('{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}');background-size:cover;background-position:center center;">
      <img
        src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}"
        alt=""
        class="pd-ref-ornament-image"
        aria-hidden="true"
      >
    </div>
    <div class="pd-hero-inner">
      <div>
        <div class="pd-kicker">Penerimaan Peserta Didik Baru</div>
        <h1 class="pd-title">
          <span class="pd-white">PPDB</span>
          <span class="pd-gold">SKANEDA</span>
        </h1>
      </div>
    </div>
  </section>

  <!-- 1. PENGERTIAN PPDB (definition stack P-P-D-B + banner resmi) -->
  <section class="pd-intro">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="pd-section pd-intro-grid">
      <div data-reveal="left">
        <h2 class="big-heading">Empat kata, satu <span>masa depan.</span></h2>
        <p class="pd-intro-note">PPDB adalah pintu masuk resmi bagi calon peserta didik untuk bergabung menjadi bagian dari keluarga besar Skaneda.</p>

        <div class="pd-def-stack" style="margin-top:2rem">
          <div class="pd-def-row" data-reveal>
            <div class="pd-def-index">1</div>
            <div class="pd-def-text">
              <h3>Penerimaan</h3>
              <p>Proses seleksi resmi yang diselenggarakan oleh sekolah untuk menjaring calon peserta didik baru setiap tahun ajaran.</p>
            </div>
          </div>
          <div class="pd-def-row" data-reveal>
            <div class="pd-def-index">2</div>
            <div class="pd-def-text">
              <h3>Peserta</h3>
              <p>Lulusan SMP/MTs sederajat yang memenuhi persyaratan dan siap menempuh pendidikan menengah kejuruan.</p>
            </div>
          </div>
          <div class="pd-def-row" data-reveal>
            <div class="pd-def-index">3</div>
            <div class="pd-def-text">
              <h3>Didik</h3>
              <p>Setiap peserta didik dibina menjadi pribadi berkarakter, kompeten, dan siap kerja maupun berwirausaha.</p>
            </div>
          </div>
          <div class="pd-def-row" data-reveal>
            <div class="pd-def-index">4</div>
            <div class="pd-def-text">
              <h3>Baru</h3>
              <p>Generasi baru Skaneda yang siap menorehkan prestasi akademik maupun nonakademik di tingkat kota, provinsi, hingga nasional.</p>
            </div>
          </div>
        </div>
      </div>

      <div data-reveal="right">
        <div class="pd-banner">
          <img src="{{ asset('images/jurusan.jpeg') }}" alt="Banner PPDB SMK Negeri 2 Mojokerto" loading="eager">
          <div class="pd-banner-flag">
        </div>
      </div>
    </div>
  </section>

  <!-- 2. JALUR PENDAFTARAN -->
  <section class="pd-track">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
    </div>

    <div class="pd-section">
      <div class="pd-track-head" data-reveal>
        <h2 class="big-heading">Empat jalur menuju <span>Skaneda.</span></h2>
        <p class="pd-track-note">Setiap calon peserta didik dapat memilih jalur yang paling sesuai dengan kondisi dan potensinya.</p>
      </div>

      <div class="pd-track-grid">
        <div class="pd-track-card" data-reveal>
          <span class="pd-track-no">01</span>
          <div class="pd-track-icon"><i class="fas fa-map-marked-alt"></i></div>
          <h3 class="pd-track-name">Zonasi</h3>
          <span class="pd-track-kuota">Kuota ± 50%</span>
          <p class="pd-track-text">Bagi calon peserta didik yang berdomisili di dalam wilayah zonasi yang ditetapkan pemerintah daerah.</p>
        </div>
        <div class="pd-track-card" data-reveal style="--d:1">
          <span class="pd-track-no">02</span>
          <div class="pd-track-icon"><i class="fas fa-hand-holding-heart"></i></div>
          <h3 class="pd-track-name">Afirmasi</h3>
          <span class="pd-track-kuota">Kuota ± 15%</span>
          <p class="pd-track-text">Bagi peserta didik dari keluarga ekonomi tidak mampu dan anak penyandang disabilitas.</p>
        </div>
        <div class="pd-track-card" data-reveal style="--d:2">
          <span class="pd-track-no">03</span>
          <div class="pd-track-icon"><i class="fas fa-trophy"></i></div>
          <h3 class="pd-track-name">Prestasi</h3>
          <span class="pd-track-kuota">Kuota ± 25%</span>
          <p class="pd-track-text">Bagi peserta didik dengan prestasi akademik maupun nonakademik yang diakui pemerintah.</p>
        </div>
        <div class="pd-track-card" data-reveal style="--d:3">
          <span class="pd-track-no">04</span>
          <div class="pd-track-icon"><i class="fas fa-briefcase"></i></div>
          <h3 class="pd-track-name">Perpindahan Tugas</h3>
          <span class="pd-track-kuota">Kuota ± 5%</span>
          <p class="pd-track-text">Bagi anak dari orang tua/wali yang berpindah tugas, dengan bukti surat penugasan resmi.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. PERSYARATAN PENDAFTARAN -->
  <section class="pd-req">
    <div class="pd-section">
      <div class="pd-req-card" data-reveal>
        <h2 class="big-heading">Siapkan <span>berkasmu.</span></h2>
        <div class="pd-req-grid">
          <div class="pd-req-item">
            <i class="fas fa-id-card"></i>
            <div><strong>Kartu Keluarga (KK)</strong><span>Fotokopi KK terbaru yang masih berlaku.</span></div>
          </div>
          <div class="pd-req-item">
            <i class="fas fa-calendar-alt"></i>
            <div><strong>Akte Kelahiran</strong><span>Fotokopi akta kelahiran calon peserta didik.</span></div>
          </div>
          <div class="pd-req-item">
            <i class="fas fa-file-alt"></i>
            <div><strong>Ijazah / SKL</strong><span>Fotokopi ijazah SMP/MTs atau surat keterangan lulus.</span></div>
          </div>
          <div class="pd-req-item">
            <i class="fas fa-user-graduate"></i>
            <div><strong>Rapor Semester 1–5</strong><span>Fotokopi rapor untuk jalur prestasi nilai akademik.</span></div>
          </div>
          <div class="pd-req-item">
            <i class="fas fa-image"></i>
            <div><strong>Pas Foto 3×4</strong><span>Pas foto berwarna latar merah/biru, sebanyak 3 lembar.</span></div>
          </div>
          <div class="pd-req-item">
            <i class="fas fa-trophy"></i>
            <div><strong>Sertifikat Prestasi</strong><span>Untuk jalur prestasi: piagam/sertifikat lomba yang diakui.</span></div>
          </div>
        </div>
        <div class="pd-req-note">
          <i class="fas fa-info-circle"></i>
          <span>Jalur afirmasi wajib melampirkan bukti keikutsertaan program penanganan keluarga tidak mampu (KIP/PKH/DTKS). Berkas difotokopi sesuai ketentuan panitia resmi.</span>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. ALUR PENDAFTARAN (timeline) -->
  <section class="pd-flow">
    <div class="pd-section">
      <div data-reveal>
        <h2 class="big-heading">Enam langkah menuju <span>gerbang Skaneda.</span></h2>
      </div>
      <div class="pd-flow-track">
        <div class="pd-flow-grid">
          <div class="pd-flow-step" data-reveal>
            <div class="pd-flow-dot">1</div>
            <h3 class="pd-flow-title">Buat Akun</h3>
            <p class="pd-flow-text">Daftar akun dan ambil PIN pada portal PPDB resmi.</p>
          </div>
          <div class="pd-flow-step" data-reveal style="--d:1">
            <div class="pd-flow-dot">2</div>
            <h3 class="pd-flow-title">Isi Formulir</h3>
            <p class="pd-flow-text">Lengkapi data diri, pilih jalur, dan tentukan pilihan sekolah.</p>
          </div>
          <div class="pd-flow-step" data-reveal style="--d:2">
            <div class="pd-flow-dot">3</div>
            <h3 class="pd-flow-title">Unggah Berkas</h3>
            <p class="pd-flow-text">Upload dokumen persyaratan sesuai jalur yang dipilih.</p>
          </div>
          <div class="pd-flow-step" data-reveal style="--d:3">
            <div class="pd-flow-dot">4</div>
            <h3 class="pd-flow-title">Verifikasi</h3>
            <p class="pd-flow-text">Panitia memverifikasi dan memeringkatkan calon peserta didik.</p>
          </div>
          <div class="pd-flow-step" data-reveal style="--d:4">
            <div class="pd-flow-dot">5</div>
            <h3 class="pd-flow-title">Pengumuman</h3>
            <p class="pd-flow-text">Hasil seleksi diumumkan melalui portal dan papan informasi sekolah.</p>
          </div>
          <div class="pd-flow-step" data-reveal style="--d:5">
            <div class="pd-flow-dot">6</div>
            <h3 class="pd-flow-title">Daftar Ulang</h3>
            <p class="pd-flow-text">Calon yang diterima melakukan daftar ulang sesuai jadwal.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. JADWAL PENTING PPDB -->
  <section class="pd-jadwal">
    <div class="pd-section">
      <div data-reveal>
        <h2 class="big-heading">Catat tanggal <span>pentingnya.</span></h2>
      </div>

      <div class="pd-jadwal-card" data-reveal>
        <div class="pd-jadwal-head">
          <h3><i class="fas fa-calendar-check"></i> Jadwal PPDB SMK Negeri 2 Mojokerto</h3>
          <span class="pd-jadwal-badge"><i class="fas fa-clock"></i> Tahun Pelajaran 2026/2027</span>
        </div>
        <table class="pd-jadwal-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Kegiatan</th>
              <th>Waktu</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Pengumuman &amp; sosialisasi PPDB</td>
              <td>Maret – April 2026</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Pendaftaran akun &amp; pengambilan PIN</td>
              <td>Mei 2026</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Pendaftaran &amp; unggah berkas (semua jalur)</td>
              <td>Juni 2026</td>
            </tr>
            <tr>
              <td>4</td>
              <td>Verifikasi &amp; pemeringkatan berkas</td>
              <td>Juni 2026</td>
            </tr>
            <tr>
              <td>5</td>
              <td>Pengumuman hasil seleksi</td>
              <td>Awal Juli 2026</td>
            </tr>
            <tr>
              <td>6</td>
              <td>Daftar ulang peserta didik diterima</td>
              <td>Juli 2026</td>
            </tr>
            <tr>
              <td>7</td>
              <td>Masa Pengenalan Lingkungan Sekolah (MPLS)</td>
              <td>Juli 2026</td>
            </tr>
          </tbody>
        </table>
        <div class="pd-jadwal-foot"><i class="fas fa-info-circle"></i> Jadwal dapat berubah mengikuti ketetapan resmi Dinas Pendidikan Provinsi Jawa Timur — pantau terus pengumuman sekolah.</div>
      </div>
    </div>
  </section>

  <!-- 6. PROGRAM KEAHLIAN -->
  <section class="pd-jurusan">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
    </div>

    <div class="pd-section">
      <div class="pd-track-head" data-reveal>
        <h2 class="big-heading">Pilih kompetensi, raih <span>masa depanmu.</span></h2>
        <p class="pd-track-note">SMK Negeri 2 Mojokerto membuka 5 kompetensi keahlian yang selaras dengan kebutuhan dunia usaha dan dunia industri.</p>
      </div>

      <div class="pd-jurusan-grid">
        <div class="pd-jurusan-card" data-reveal>
          <div class="pd-jurusan-photo">
            <img src="{{ asset('images/gallery-rpl.jpg') }}" alt="Rekayasa Perangkat Lunak" loading="eager">
          </div>
          <div class="pd-jurusan-body">
            <span class="pd-jurusan-tag">TEKNOLOGI INFORMASI</span>
            <h3 class="pd-jurusan-name">Rekayasa Perangkat Lunak</h3>
            <p class="pd-jurusan-text">Mempelajari pembuatan aplikasi, pemrograman web &amp; mobile, hingga pengujian dan manajemen proyek perangkat lunak.</p>
            <span class="pd-jurusan-more">Selengkapnya <i class="fas fa-arrow-right"></i></span>
          </div>
        </div>
        <div class="pd-jurusan-card" data-reveal style="--d:1">
          <div class="pd-jurusan-photo">
            <img src="{{ asset('images/gallery-kuliner.jpg') }}" alt="Kuliner" loading="eager">
          </div>
          <div class="pd-jurusan-body">
            <span class="pd-jurusan-tag">PARIWISATA</span>
            <h3 class="pd-jurusan-name">Kuliner</h3>
            <p class="pd-jurusan-text">Menguasai seni memasak, pengolahan bahan makanan, tata hidang, hingga manajemen usaha kuliner dan pastry &amp; bakery.</p>
            <span class="pd-jurusan-more">Selengkapnya <i class="fas fa-arrow-right"></i></span>
          </div>
        </div>
        <div class="pd-jurusan-card" data-reveal style="--d:2">
          <div class="pd-jurusan-photo">
            <img src="{{ asset('images/gallery-aphp.jpg') }}" alt="Agribisnis Pengolahan Hasil Pertanian" loading="eager">
          </div>
          <div class="pd-jurusan-body">
            <span class="pd-jurusan-tag">AGRIBISNIS &amp; AGROTEKNOLOGI</span>
            <h3 class="pd-jurusan-name">Agribisnis Pengolahan Hasil Pertanian</h3>
            <p class="pd-jurusan-text">Mengolah hasil pertanian &amp; perikanan menjadi produk bernilai tambah: roti, samosa, es krim, dan aneka produk wirausaha.</p>
            <span class="pd-jurusan-more">Selengkapnya <i class="fas fa-arrow-right"></i></span>
          </div>
        </div>
        <div class="pd-jurusan-card" data-reveal style="--d:3">
          <div class="pd-jurusan-photo">
            <img src="{{ asset('images/gallery-dkv.jpg') }}" alt="Desain Komunikasi Visual" loading="eager">
          </div>
          <div class="pd-jurusan-body">
            <span class="pd-jurusan-tag">SENI &amp; EKONOMI KREATIF</span>
            <h3 class="pd-jurusan-name">Desain Komunikasi Visual</h3>
            <p class="pd-jurusan-text">Mengasah kreativitas desain grafis, ilustrasi, fotografi, videografi, dan branding untuk industri kreatif.</p>
            <span class="pd-jurusan-more">Selengkapnya <i class="fas fa-arrow-right"></i></span>
          </div>
        </div>
        <div class="pd-jurusan-card" data-reveal style="--d:4">
          <div class="pd-jurusan-photo">
            <img src="{{ asset('images/gallery-bank.jpg') }}" alt="Layanan Perbankan Syariah" loading="eager">
          </div>
          <div class="pd-jurusan-body">
            <span class="pd-jurusan-tag">BISNIS &amp; MANAJEMEN</span>
            <h3 class="pd-jurusan-name">Layanan Perbankan Syariah</h3>
            <p class="pd-jurusan-text">Mendalami operasional lembaga keuangan syariah, layanan perbankan, administrasi transaksi, dan literasi keuangan.</p>
            <span class="pd-jurusan-more">Selengkapnya <i class="fas fa-arrow-right"></i></span>
          </div>
        </div>
        <div class="pd-jurusan-card" data-reveal style="--d:5">
          <div class="pd-jurusan-photo">
            <img src="{{ asset('images/gallery-upacara.jpg') }}" alt="Lingkungan Sekolah" loading="eager">
          </div>
          <div class="pd-jurusan-body">
            <span class="pd-jurusan-tag">KARAKTER &amp; BUDAYA</span>
            <h3 class="pd-jurusan-name">Skaneda, Satu Keluarga</h3>
            <p class="pd-jurusan-text">Lingkungan kondusif, fasilitas lengkap, pengajar profesional, dan kemitraan luas bersama dunia usaha &amp; industri.</p>
            <span class="pd-jurusan-more">Selengkapnya <i class="fas fa-arrow-right"></i></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 7. FAQ -->
  <section class="pd-faq">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
    </div>

    <div class="pd-section">
      <div class="pd-track-head" data-reveal>
        <h2 class="big-heading">Masih ada <span>pertanyaan?</span></h2>
        <p class="pd-track-note">Jawaban singkat untuk pertanyaan yang paling sering ditanyakan calon peserta didik dan orang tua.</p>
      </div>

      <div class="pd-faq-list" data-reveal>
        <div class="pd-faq-item open">
          <button class="pd-faq-q" type="button">Kapan PPDB SMK Negeri 2 Mojokerto dibuka? <i class="fas fa-chevron-down"></i></button>
          <div class="pd-faq-a"><p>Pendaftaran biasanya dibuka pada bulan Mei–Juni setiap tahun ajaran baru. Jadwal resmi mengikuti ketetapan Dinas Pendidikan Provinsi Jawa Timur dan diumumkan melalui website serta media sosial sekolah.</p></div>
        </div>
        <div class="pd-faq-item">
          <button class="pd-faq-q" type="button">Apakah pendaftaran dilakukan secara online? <i class="fas fa-chevron-down"></i></button>
          <div class="pd-faq-a"><p>Ya. Pendaftaran dilakukan melalui portal PPDB resmi secara daring (online). Calon peserta didik membuat akun, mengambil PIN, mengisi formulir, dan mengunggah berkas persyaratan pada portal tersebut.</p></div>
        </div>
        <div class="pd-faq-item">
          <button class="pd-faq-q" type="button">Berapa kuota daya tampung SMK Negeri 2 Mojokerto? <i class="fas fa-chevron-down"></i></button>
          <div class="pd-faq-a"><p>Daya tampung disesuaikan dengan ketetapan resmi setiap tahun ajaran. Informasi kuota per kompetensi keahlian diumumkan panitia PPDB pada saat sosialisasi. Pantau terus pengumuman sekolah.</p></div>
        </div>
        <div class="pd-faq-item">
          <button class="pd-faq-q" type="button">Bagaimana cara memilih jalur yang tepat? <i class="fas fa-chevron-down"></i></button>
          <div class="pd-faq-a"><p>Sesuaikan dengan kondisi kamu: domisili (zonasi), kondisi ekonomi atau disabilitas (afirmasi), prestasi akademik/nonakademik (prestasi), atau perpindahan tugas orang tua. Konsultasikan dengan guru BK di sekolah asal.</p></div>
        </div>
        <div class="pd-faq-item">
          <button class="pd-faq-q" type="button">Apakah ada biaya pendaftaran? <i class="fas fa-chevron-down"></i></button>
          <div class="pd-faq-a"><p>Tidak ada. Pendaftaran PPDB di sekolah negeri GRATIS. Waspadai oknum yang meminta biaya pendaftaran dengan dalih apa pun dan laporkan ke panitia resmi sekolah.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="pd-cta">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>
    <h2>Siap menjadi bagian dari <em>keluarga Skaneda?</em></h2>
    <p>Jangan lewatkan kesempatanmu! Siapkan berkas, pilih kompetensi keahlian favoritmu, dan wujudkan masa depan yang lebih cerah bersama SMK Negeri 2 Mojokerto.</p>
    <a href="{{ route('kontak') }}" class="pd-cta-btn"><i class="fas fa-paper-plane"></i> Hubungi Panitia PPDB</a>
    <div class="pd-cta-note"><i class="fas fa-info-circle"></i> Informasi resmi: smkn2mojokerto.sch.id · #DisiplinBerprestasi</div>
  </section>

</div>
@endsection

@push('scripts')
<script>
  /* ---- Scroll Reveal (senada Sejarah Sekolah) ---- */
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

    /* Fallback: pastikan semua konten tampil walau observer tak pernah
       terpicu (mis. halaman panjang tanpa scroll / screenshot full-page). */
    setTimeout(function () {
      revealEls.forEach(function (el) { el.classList.add('revealed'); });
    }, 1200);

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

  /* ---- FAQ Accordion ---- */
  (function () {
    var items = document.querySelectorAll('.pd-faq-item');
    items.forEach(function (item) {
      var btn = item.querySelector('.pd-faq-q');
      var ans = item.querySelector('.pd-faq-a');
      btn.addEventListener('click', function () {
        var isOpen = item.classList.contains('open');
        items.forEach(function (o) {
          o.classList.remove('open');
          o.querySelector('.pd-faq-a').style.maxHeight = '0px';
        });
        if (!isOpen) {
          item.classList.add('open');
          ans.style.maxHeight = ans.scrollHeight + 'px';
        }
      });
    });
    /* buka item pertama secara default */
    var first = document.querySelector('.pd-faq-item.open .pd-faq-a');
    if (first) first.style.maxHeight = first.scrollHeight + 'px';
  })();
</script>
@endpush