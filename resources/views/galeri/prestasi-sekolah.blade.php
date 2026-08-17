@extends('layouts.app')

@section('title', 'Prestasi Sekolah — SMK Negeri 2 Mojokerto')
@section('description', 'Prestasi institusi SMK Negeri 2 Mojokerto — trophy cabinet, pencapaian utama, galeri penghargaan, dan arsip prestasi resmi sekolah dari tingkat kota hingga nasional.')

@push('styles')
<style>
/* =========================================================
   PRESTASI SEKOLAH — INSTITUTIONAL TROPHY CABINET
   Prestise, formal, monumental. Berbeda dari Prestasi Siswa
   (student hall of fame) — ini arsip pencapaian resmi sekolah.
   Hero, header (layouts.app) & footer TIDAK diubah.
   Visual language: navy #0d3a66, biru #2f6fa8, gold
   #ffd54a/#ffb300, Sora display, editorial premium, ornamen
   formal (thin frame, circle, star, medal, dotted, garis gold).
   ========================================================= */
.psk-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}
.psk-page *{box-sizing:border-box}

/* ---------- HERO: foto gedung + overlay + watermark (IDENTIK referensi — TIDAK DIUBAH) ---------- */
.psk-hero{position:relative;min-height:88vh;display:flex;align-items:flex-start;overflow:hidden;
  background-image:url('{{ asset('images/hero-sekolah.jpg') }}');
  background-size:cover;background-position:center;background-repeat:no-repeat;color:#fff}
.psk-hero::before{content:"";position:absolute;inset:0;z-index:1;
  background:linear-gradient(100deg,rgba(7,22,42,.90) 0%,rgba(9,30,54,.68) 45%,rgba(9,30,54,.32) 78%,rgba(9,30,54,.12) 100%)}
/* Watermark typography besar transparan */
.psk-hero::after{content:"PRESTASI SEKOLAH";position:absolute;z-index:2;right:-2%;top:50%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(4rem,14vw,13.5rem);font-weight:900;line-height:.82;
  letter-spacing:.02em;color:rgba(255,255,255,.055);-webkit-text-stroke:1px rgba(255,255,255,.07);
  text-shadow:0 0 90px rgba(13,58,102,.16);pointer-events:none;white-space:nowrap;user-select:none}
.psk-hero-inner{position:relative;z-index:3;width:100%;max-width:none;margin:0 auto;
  padding:clamp(3.5rem,9vh,5.5rem) clamp(1.5rem,5vw,5.5rem);
  display:grid;grid-template-columns:minmax(0,1.05fr) minmax(340px,.95fr);gap:4rem;align-items:center}

.psk-kicker{display:inline-flex;align-items:center;gap:.65rem;font-size:.74rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#ffd54a;margin-bottom:0.6rem}
.psk-kicker::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ffb300)}

.psk-title{font-family:var(--font-display);font-size:clamp(2.9rem,6.6vw,6.2rem);line-height:.98;
  letter-spacing:.01em;margin:0;max-width:820px;text-transform:uppercase;
  text-shadow:0 2px 24px rgba(4,14,28,.35);animation:hdFadeUp .7s .1s var(--ease, ease) both}
.psk-title .psk-white{color:#ffffff;display:inline-block}
.psk-title .psk-gold{display:inline-block;
  background:linear-gradient(135deg,#ffe66d 0%,#ffc107 45%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ffc107;
  text-shadow:0 4px 24px rgba(255,174,0,.18);letter-spacing:.025em}
.psk-lead{font-size:1.02rem;line-height:1.85;color:rgba(235,245,253,.86);max-width:640px;
  margin:1.3rem 0 0;animation:hdFadeUp .7s .26s var(--ease, ease) both}
.psk-hero-meta{display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;animation:hdFadeUp .7s .4s var(--ease, ease) both}
.psk-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;
  border:1px solid rgba(255,255,255,.2);background:rgba(13,58,102,.30);border-radius:999px;
  font-size:.72rem;font-weight:800;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)}
.psk-pill i{color:#ffd54a}

/* hero-photo (IDENTIK gaya referensi) */
.hero-photo{position:relative;height:430px;border-radius:24px;overflow:hidden;
  transform:translateY(-18px) rotate(2deg);box-shadow:0 34px 80px rgba(4,14,28,.45);
  border:1px solid rgba(255,255,255,.18);animation:hdFadeUp .7s .34s var(--ease, ease) both}
.hero-photo::before{content:"";position:absolute;inset:0;z-index:2;
  background:linear-gradient(200deg,rgba(7,22,42,.08) 0%,rgba(9,30,54,.55) 100%)}
.hero-photo img{width:100%;height:100%;object-fit:cover;display:block;transform:scale(1.03)}
.hero-photo-caption{position:absolute;z-index:3;left:1.5rem;right:1.5rem;bottom:1.3rem}
.hero-photo-caption strong{display:block;font-family:var(--font-display);font-size:1.3rem;font-weight:600;color:#fff}
.hero-photo-caption span{font-size:.72rem;color:rgba(255,255,255,.74)}

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
  border-top:2px solid rgba(255,179,0,.55);border-right:2px solid rgba(255,179,0,.55);border-radius:0 26px 0 0}
.home-orn .ho-corner::after{content:"";position:absolute;left:18px;bottom:18px;width:46px;height:3px;
  background:rgba(13,58,102,.16)}

/* posisi ornamen per section */
.psk-hero .home-orn .ho-chevron{left:-150px;bottom:-60px;border-color:rgba(255,255,255,.10)}
.psk-hero .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.psk-hero .home-orn .ho-line{right:-80px;top:22%;opacity:.22}
.psk-hero .home-orn .ho-dots{right:6%;bottom:14%;opacity:.3}
.psk-hero .home-orn .ho-ring{left:44%;bottom:-90px;border-color:rgba(255,255,255,.12)}
.psk-hero .home-orn .ho-gold{right:16%;top:20%}
.psk-hero .home-orn .ho-square{left:12%;top:22%}

/* ---------- UTIL: reveal + layout dasar ---------- */
[data-reveal]{opacity:0;transform:translateY(28px);transition:opacity .75s var(--ease,ease),transform .75s var(--ease,ease)}
[data-reveal].revealed{opacity:1;transform:none}
[data-reveal=left]{transform:translateX(-30px)}
[data-reveal=right]{transform:translateX(30px)}
[data-reveal=left].revealed,[data-reveal=right].revealed{transform:none}

.psk-section{max-width:1240px;margin:0 auto;padding:clamp(4rem,8vw,6.5rem) clamp(1.5rem,5vw,3rem);position:relative}

/* ---------- EYEBROW + SECTION TITLE (BESAR & BOLD — karakter SEJARAH SKANEDA) ---------- */
.psk-eyebrow{display:inline-flex;align-items:center;gap:.6rem;font-size:.74rem;font-weight:800;
  letter-spacing:.2em;text-transform:uppercase;color:#ffb300;margin-bottom:1rem}
.psk-eyebrow::before{content:"";width:30px;height:2px;background:linear-gradient(90deg,#ffd54a,#ffb300)}
.psk-section-title{font-family:var(--font-display);font-weight:900;font-size:clamp(2.5rem,5vw,4.5rem);
  line-height:.95;letter-spacing:-.03em;margin:0;color:#0d3a66;text-transform:uppercase}
.psk-section-title .psk-gold{
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 60%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ffb300}
.psk-subtitle{font-size:1.02rem;line-height:1.85;color:#5a6f88;max-width:620px;margin:1.2rem 0 0}

/* ---------- 1. PEMBUKA: JEJAK PRESTASI SKANEDA (editorial) ---------- */
.psk-opening{background:#fff;position:relative}
.psk-opening .psk-section{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,.9fr);gap:clamp(2.5rem,5vw,5rem);align-items:center}
.psk-opening-desc{font-size:1.06rem;line-height:1.9;color:#44586f;margin:1.5rem 0 0;max-width:560px}
.psk-opening-desc strong{color:#0d3a66}
.psk-opening-meta{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-top:2.2rem}
.psk-om{border-left:3px solid #ffd54a;padding:1rem 1.2rem;background:#f8fafd;border-radius:0 16px 16px 0}
.psk-om b{font-family:var(--font-display);font-size:1.9rem;font-weight:900;color:#0d3a66;display:block;line-height:1}
.psk-om b em{font-style:normal}
.psk-om span{font-size:.72rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#7a8ba1;display:block;margin-top:.4rem}
/* Trophy cabinet visual utama */
.psk-cabinet{position:relative;border-radius:28px;overflow:hidden;box-shadow:0 30px 70px rgba(13,58,102,.22);
  border:1px solid rgba(13,58,102,.08);min-height:520px;display:flex;align-items:flex-end;
  background-image:url('{{ asset('images/ps-piala.jpg') }}');
  background-size:cover;background-position:center 30%;background-repeat:no-repeat}
.psk-cabinet::before{content:"";position:absolute;inset:0;z-index:1;
  background:linear-gradient(180deg,rgba(7,22,42,.05) 0%,rgba(7,22,42,.25) 45%,rgba(7,22,42,.88) 100%)}
.psk-cabinet::after{content:"";position:absolute;inset:0;z-index:2;border:1px solid rgba(255,213,74,.35);
  border-radius:28px;margin:14px;pointer-events:none}
.psk-cabinet-orn{position:absolute;z-index:2;pointer-events:none}
.psk-cabinet-orn .co-ring{position:absolute;width:130px;height:130px;border:1px solid rgba(255,213,74,.4);border-radius:50%;top:-30px;right:-20px}
.psk-cabinet-orn .co-ring::before{content:"";position:absolute;inset:18px;border:1px dashed rgba(255,213,74,.3);border-radius:50%}
.psk-cabinet-orn .co-dots{position:absolute;width:110px;height:110px;opacity:.5;top:40px;left:-20px;
  background-image:radial-gradient(rgba(255,213,74,.7) 1.6px,transparent 1.7px);background-size:15px 15px}
.psk-cabinet-orn .co-star{position:absolute;right:18%;top:26%;font-size:1.6rem;color:rgba(255,213,74,.5)}
.psk-cabinet-orn .co-gold{position:absolute;left:14%;top:44%;width:56px;height:7px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ffb300);opacity:.7}
.psk-cabinet-body{position:relative;z-index:3;padding:2.2rem 2.2rem 2rem;width:100%}
.psk-cabinet-tag{display:inline-flex;align-items:center;gap:.5rem;font-size:.68rem;font-weight:800;letter-spacing:.16em;
  text-transform:uppercase;color:#ffd54a;background:rgba(7,22,42,.55);border:1px solid rgba(255,213,74,.35);
  padding:.45rem .8rem;border-radius:999px;backdrop-filter:blur(6px)}
.psk-cabinet-body h3{font-family:var(--font-display);font-size:clamp(1.7rem,3vw,2.5rem);font-weight:900;
  color:#fff;margin:.9rem 0 .3rem;line-height:1.05;text-transform:uppercase}
.psk-cabinet-body p{font-size:.9rem;line-height:1.7;color:rgba(235,245,253,.85);margin:0;max-width:480px}
.psk-cabinet-foot{display:flex;gap:.6rem;flex-wrap:wrap;margin-top:1.2rem}
.psk-cabinet-foot span{display:inline-flex;align-items:center;gap:.45rem;font-size:.72rem;font-weight:700;color:#fff;
  background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.22);padding:.4rem .7rem;border-radius:999px;backdrop-filter:blur(6px)}
.psk-cabinet-foot i{color:#ffd54a}

/* ---------- 2. FEATURED ACHIEVEMENT (editorial 2 kolom) ---------- */
.psk-featured{background:#f4f7fb;position:relative}
.psk-featured .psk-section{display:grid;grid-template-columns:minmax(0,1.05fr) minmax(0,.95fr);gap:clamp(2.5rem,5vw,4.5rem);align-items:center}
.psk-feat-photo{position:relative;border-radius:24px;overflow:hidden;box-shadow:0 26px 60px rgba(13,58,102,.2);
  aspect-ratio:4/3;border:1px solid rgba(13,58,102,.08)}
.psk-feat-photo img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .9s var(--ease,ease)}
.psk-feat-photo:hover img{transform:scale(1.04)}
.psk-feat-photo::after{content:"";position:absolute;inset:0;background:linear-gradient(200deg,rgba(7,22,42,0) 40%,rgba(7,22,42,.45) 100%)}
.psk-feat-badge{position:absolute;z-index:3;top:1.2rem;left:1.2rem;display:inline-flex;align-items:center;gap:.5rem;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;font-size:.7rem;font-weight:900;letter-spacing:.1em;
  text-transform:uppercase;padding:.5rem .9rem;border-radius:999px;box-shadow:0 8px 22px rgba(255,179,0,.4)}
.psk-feat-badge i{font-size:.8rem}
.psk-feat-year{position:absolute;z-index:3;right:1.4rem;bottom:1rem;font-family:var(--font-display);
  font-size:clamp(2.6rem,5vw,4rem);font-weight:900;line-height:1;color:rgba(255,255,255,.9);text-shadow:0 3px 16px rgba(4,14,28,.5)}
.psk-feat-year small{display:block;font-size:.7rem;font-weight:800;letter-spacing:.22em;color:#ffd54a;text-transform:uppercase}
.psk-feat-info .psk-eyebrow{margin-bottom:.8rem}
.psk-feat-rank{display:inline-flex;align-items:center;gap:.5rem;margin:.9rem 0 .4rem;
  background:#0d3a66;color:#ffd54a;font-size:.74rem;font-weight:900;letter-spacing:.14em;text-transform:uppercase;
  padding:.5rem 1rem;border-radius:999px}
.psk-feat-rank i{color:#ffd54a}
.psk-feat-info h3{font-family:var(--font-display);font-size:clamp(1.6rem,3vw,2.4rem);font-weight:900;color:#0d3a66;
  line-height:1.1;margin:0;text-transform:uppercase}
.psk-feat-info h3 em{font-style:normal;color:#ffb300}
.psk-feat-desc{font-size:.98rem;line-height:1.85;color:#44586f;margin:1rem 0 1.4rem;max-width:520px}
.psk-feat-meta{display:flex;gap:.6rem;flex-wrap:wrap}
.psk-feat-meta span{display:inline-flex;align-items:center;gap:.45rem;font-size:.76rem;font-weight:700;color:#0d3a66;
  background:#fff;border:1px solid rgba(13,58,102,.14);padding:.5rem .85rem;border-radius:12px;box-shadow:0 4px 14px rgba(13,58,102,.06)}
.psk-feat-meta i{color:#ffb300}

/* ---------- 3. PENCAPAIAN UTAMA (angka besar) ---------- */
.psk-stats{background:#0d3a66;color:#fff;position:relative;overflow:hidden}
.psk-stats::before{content:"";position:absolute;inset:0;opacity:.5;
  background-image:radial-gradient(rgba(255,213,74,.16) 1.5px,transparent 1.6px);background-size:26px 26px}
.psk-stats .psk-section{position:relative;z-index:2}
.psk-stats .psk-section-title{color:#fff}
.psk-stats .psk-subtitle{color:rgba(235,245,253,.75)}
.psk-stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.2rem;margin-top:2.6rem}
.psk-stat{position:relative;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.12);
  border-radius:22px;padding:2rem 1.5rem 1.7rem;text-align:left;transition:transform .35s var(--ease,ease),box-shadow .35s var(--ease,ease),border-color .35s var(--ease,ease)}
.psk-stat:hover{transform:translateY(-6px);box-shadow:0 22px 44px rgba(4,14,28,.35);border-color:rgba(255,213,74,.45)}
.psk-stat-icon{width:52px;height:52px;border-radius:16px;display:flex;align-items:center;justify-content:center;
  font-size:1.3rem;margin-bottom:1.1rem;background:linear-gradient(135deg,rgba(255,213,74,.2),rgba(255,179,0,.1));
  border:1px solid rgba(255,213,74,.35);color:#ffd54a}
.psk-stat b{font-family:var(--font-display);font-size:clamp(2.6rem,4.6vw,3.9rem);font-weight:900;line-height:1;display:block;
  background:linear-gradient(135deg,#ffe66d 0%,#ffc107 50%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.psk-stat b em{font-style:normal}
.psk-stat>span{display:block;font-size:.82rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;
  color:#fff;margin-top:.7rem}
.psk-stat-note{font-size:.78rem;line-height:1.6;color:rgba(235,245,253,.6);margin:.6rem 0 0}
.psk-stat::after{content:"";position:absolute;left:1.5rem;bottom:0;width:46px;height:3px;border-radius:99px;
  background:linear-gradient(90deg,#ffd54a,#ffb300);opacity:.85}
.psk-ajang{display:flex;align-items:center;gap:.7rem;margin-top:2.4rem;font-size:.85rem;font-weight:800;letter-spacing:.08em;
  text-transform:uppercase;color:rgba(235,245,253,.85)}
.psk-ajang i{color:#ffd54a}
.psk-ajang-chips{display:flex;gap:.6rem;flex-wrap:wrap;margin-top:1rem}
.psk-chip{display:inline-flex;align-items:center;gap:.45rem;font-size:.78rem;font-weight:700;color:#eaf2fb;
  background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.16);padding:.5rem .9rem;border-radius:999px;transition:all .3s var(--ease,ease)}
.psk-chip:hover{background:rgba(255,213,74,.15);border-color:rgba(255,213,74,.4);color:#ffd54a}
.psk-chip i{color:#ffd54a}

/* ---------- 4. GALERI PENGHARGAAN (masonry + filter + year nav) ---------- */
.psk-gallery{background:#fff;position:relative}
.psk-gallery-tools{display:flex;justify-content:space-between;align-items:flex-end;gap:2rem;flex-wrap:wrap;margin-top:1.8rem}
.psk-filters{display:flex;gap:.5rem;flex-wrap:wrap}
.psk-fbtn{display:inline-flex;align-items:center;gap:.45rem;font-size:.78rem;font-weight:800;letter-spacing:.04em;
  color:#0d3a66;background:#fff;border:1px solid rgba(13,58,102,.18);padding:.55rem 1rem;border-radius:999px;
  cursor:pointer;transition:all .3s var(--ease,ease)}
.psk-fbtn i{font-size:.82rem;color:#ffb300}
.psk-fbtn:hover{border-color:#ffb300;transform:translateY(-2px)}
.psk-fbtn.active{background:#0d3a66;color:#fff;border-color:#0d3a66;box-shadow:0 8px 20px rgba(13,58,102,.25)}
.psk-fbtn.active i{color:#ffd54a}
.psk-yearnav{display:flex;gap:.45rem;align-items:center}
.psk-yearnav-label{font-size:.72rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:#7a8ba1;margin-right:.3rem}
.psk-ybtn{min-width:46px;height:46px;display:inline-flex;align-items:center;justify-content:center;
  font-family:var(--font-display);font-weight:900;font-size:.95rem;color:#0d3a66;background:#f4f7fb;
  border:1px solid rgba(13,58,102,.14);border-radius:14px;cursor:pointer;transition:all .3s var(--ease,ease)}
.psk-ybtn:hover{border-color:#ffb300;transform:translateY(-2px)}
.psk-ybtn.active{background:#0d3a66;color:#ffd54a;border-color:#0d3a66;box-shadow:0 8px 20px rgba(13,58,102,.25)}

/* masonry */
.psk-masonry{display:grid;grid-template-columns:repeat(4,1fr);grid-auto-rows:150px;grid-auto-flow:dense;gap:1rem;margin-top:2.2rem}
.psk-photo{position:relative;border-radius:18px;overflow:hidden;display:block;cursor:pointer;text-decoration:none;
  border:1px solid rgba(13,58,102,.08);grid-row:span 2}
.psk-photo.lg{grid-row:span 3;grid-column:span 2}
.psk-photo.wide{grid-column:span 2;grid-row:span 2}
.psk-photo.tall{grid-row:span 4}
.psk-photo img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .8s var(--ease,ease)}
.psk-photo:hover img{transform:scale(1.05)}
.psk-photo::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,rgba(7,22,42,0) 45%,rgba(7,22,42,.78) 100%);
  opacity:.75;transition:opacity .4s var(--ease,ease)}
.psk-photo:hover::after{opacity:1}
.psk-photo-cap{position:absolute;z-index:3;left:1rem;right:1rem;bottom:.9rem}
.psk-photo-cap strong{display:block;font-size:.86rem;font-weight:800;color:#fff;line-height:1.3}
.psk-photo-cap span{display:inline-flex;align-items:center;gap:.35rem;font-size:.66rem;font-weight:700;letter-spacing:.08em;
  text-transform:uppercase;color:#ffd54a;margin-top:.3rem}
.psk-photo-zoom{position:absolute;z-index:3;top:.9rem;right:.9rem;width:38px;height:38px;border-radius:12px;
  display:flex;align-items:center;justify-content:center;font-size:.85rem;color:#fff;
  background:rgba(7,22,42,.5);border:1px solid rgba(255,255,255,.25);backdrop-filter:blur(6px);
  opacity:0;transform:translateY(-6px);transition:all .35s var(--ease,ease)}
.psk-photo:hover .psk-photo-zoom{opacity:1;transform:none}
.psk-gallery-foot{display:flex;justify-content:center;margin-top:2rem}
.psk-note{display:inline-flex;align-items:center;gap:.6rem;font-size:.82rem;font-weight:700;color:#5a6f88;
  background:#f4f7fb;border:1px dashed rgba(13,58,102,.2);padding:.7rem 1.2rem;border-radius:999px}
.psk-note i{color:#ffb300}

/* ---------- 5. QUOTE STATEMENT (foto + overlay) ---------- */
.psk-quote{position:relative;overflow:hidden;background:#0d3a66}
.psk-quote-bg{position:absolute;inset:0}
.psk-quote-bg img{width:100%;height:100%;object-fit:cover;display:block;opacity:.32}
.psk-quote-bg::after{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(7,22,42,.92) 0%,rgba(9,30,54,.72) 60%,rgba(9,30,54,.45) 100%)}
.psk-quote .psk-section{position:relative;z-index:2;text-align:center;padding-top:clamp(5rem,10vw,8rem);padding-bottom:clamp(5rem,10vw,8rem)}
.psk-quote-mark{font-family:var(--font-display);font-size:clamp(5rem,9vw,8rem);font-weight:900;line-height:.6;
  display:block;background:linear-gradient(135deg,#ffe66d,#ffb300);-webkit-background-clip:text;background-clip:text;
  -webkit-text-fill-color:transparent;opacity:.9}
.psk-quote-text{font-family:var(--font-display);font-size:clamp(1.6rem,3.4vw,2.7rem);font-weight:800;line-height:1.25;
  color:#fff;max-width:900px;margin:1.6rem auto 0}
.psk-quote-text em{font-style:normal;color:#ffd54a}
.psk-quote-src{display:inline-flex;align-items:center;gap:.6rem;margin-top:1.8rem;font-size:.78rem;font-weight:800;
  letter-spacing:.16em;text-transform:uppercase;color:rgba(235,245,253,.75)}
.psk-quote-src::before{content:"";width:38px;height:2px;background:linear-gradient(90deg,#ffd54a,#ffb300)}

/* ---------- 6. DAFTAR PRESTASI (official archive, group by tahun) ---------- */
.psk-archive{background:#f4f7fb;position:relative}
.psk-archive-head{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,.9fr);gap:2rem;align-items:end;margin-bottom:2.6rem}
.psk-archive-head .psk-subtitle{margin-top:1rem}
.psk-archive-badge{justify-self:end;display:inline-flex;align-items:center;gap:.6rem;font-size:.74rem;font-weight:800;
  letter-spacing:.1em;text-transform:uppercase;color:#0d3a66;background:#fff;border:1px solid rgba(13,58,102,.14);
  padding:.65rem 1.1rem;border-radius:999px;box-shadow:0 8px 20px rgba(13,58,102,.06)}
.psk-archive-badge i{color:#ffb300}
.psk-year-block{margin-bottom:2rem}
.psk-year-head{display:flex;align-items:center;gap:1.2rem;margin-bottom:1.2rem}
.psk-year-num{font-family:var(--font-display);font-size:clamp(2rem,4vw,3rem);font-weight:900;line-height:1;color:#0d3a66}
.psk-year-num em{font-style:normal;color:rgba(13,58,102,.25)}
.psk-year-line{flex:1;height:1px;background:linear-gradient(90deg,rgba(13,58,102,.25),rgba(13,58,102,.04))}
.psk-year-count{font-size:.74rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:#ffb300;
  background:#fff;border:1px solid rgba(255,179,0,.35);padding:.4rem .8rem;border-radius:999px}
.psk-archive-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem}
.psk-row{display:grid;grid-template-columns:auto 1fr auto;gap:1.1rem;align-items:center;background:#fff;
  border:1px solid rgba(13,58,102,.09);border-radius:18px;padding:1.1rem 1.3rem;transition:all .3s var(--ease,ease)}
.psk-row:hover{transform:translateY(-3px);box-shadow:0 14px 30px rgba(13,58,102,.1);border-color:rgba(255,179,0,.45)}
.psk-row-rank{width:52px;height:52px;border-radius:16px;display:flex;align-items:center;justify-content:center;
  font-size:1.15rem;background:linear-gradient(135deg,rgba(255,213,74,.25),rgba(255,179,0,.1));
  border:1px solid rgba(255,179,0,.4);color:#b97c00;flex-shrink:0}
.psk-row-rank.gold{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;border-color:#ffb300}
.psk-row-info h4{font-size:.98rem;font-weight:800;color:#0d3a66;margin:0;line-height:1.35}
.psk-row-info span{font-size:.76rem;color:#7a8ba1;display:block;margin-top:.25rem}
.psk-row-info span i{color:#ffb300;margin-right:.3rem}
.psk-row-tag{display:inline-flex;align-items:center;gap:.4rem;font-size:.7rem;font-weight:800;letter-spacing:.06em;
  text-transform:uppercase;color:#0d3a66;background:#f4f7fb;border:1px solid rgba(13,58,102,.14);
  padding:.4rem .75rem;border-radius:999px;white-space:nowrap}
.psk-row-tag.t-prov{color:#0d3a66}
.psk-row-tag.t-nas{background:#0d3a66;color:#ffd54a;border-color:#0d3a66}

/* ---------- 7. CTA ---------- */
.psk-cta{background:#fff;position:relative}
.psk-cta-box{position:relative;overflow:hidden;border-radius:30px;background:#0d3a66;color:#fff;
  padding:clamp(3rem,6vw,4.5rem) clamp(2rem,5vw,4rem);display:grid;grid-template-columns:minmax(0,1fr) auto;gap:2.5rem;align-items:center}
.psk-cta-box::before{content:"";position:absolute;inset:0;opacity:.4;
  background-image:radial-gradient(rgba(255,213,74,.14) 1.5px,transparent 1.6px);background-size:24px 24px}
.psk-cta-box::after{content:"SKANEDA";position:absolute;right:-1%;bottom:-8%;font-family:var(--font-display);
  font-size:clamp(4rem,10vw,8.5rem);font-weight:900;line-height:.8;color:rgba(255,255,255,.05);pointer-events:none;white-space:nowrap}
.psk-cta-inner{position:relative;z-index:2}
.psk-cta-eyebrow{display:inline-flex;align-items:center;gap:.5rem;font-size:.7rem;font-weight:800;letter-spacing:.18em;
  text-transform:uppercase;color:#ffd54a;margin-bottom:.9rem}
.psk-cta-box h3{font-family:var(--font-display);font-size:clamp(1.7rem,3.6vw,2.8rem);font-weight:900;line-height:1.08;
  margin:0;max-width:620px;text-transform:uppercase}
.psk-cta-box p{font-size:.95rem;line-height:1.8;color:rgba(235,245,253,.8);margin:1rem 0 0;max-width:560px}
.psk-cta-btn{position:relative;z-index:2;display:inline-flex;align-items:center;gap:.6rem;justify-self:end;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;font-size:.86rem;font-weight:900;letter-spacing:.06em;
  text-transform:uppercase;padding:1rem 1.8rem;border-radius:999px;text-decoration:none;
  box-shadow:0 16px 40px rgba(255,179,0,.35);transition:transform .3s var(--ease,ease),box-shadow .3s var(--ease,ease)}
.psk-cta-btn:hover{transform:translateY(-3px);box-shadow:0 22px 50px rgba(255,179,0,.45)}

/* ---------- LIGHTBOX ---------- */
.psk-lightbox{position:fixed;inset:0;z-index:9999;background:rgba(4,14,28,.92);display:flex;align-items:center;
  justify-content:center;opacity:0;visibility:hidden;transition:opacity .35s var(--ease,ease),visibility .35s var(--ease,ease)}
.psk-lightbox.open{opacity:1;visibility:visible}
.psk-lb-close{position:absolute;top:1.4rem;right:1.6rem;width:46px;height:46px;border-radius:50%;display:flex;
  align-items:center;justify-content:center;font-size:1.1rem;color:#fff;background:rgba(255,255,255,.1);
  border:1px solid rgba(255,255,255,.2);cursor:pointer;transition:all .3s var(--ease,ease)}
.psk-lb-close:hover{background:#ffb300;color:#0d3a66;transform:rotate(90deg)}
.psk-lb-frame{max-width:min(920px,92vw);max-height:86vh;border-radius:20px;overflow:hidden;
  border:1px solid rgba(255,213,74,.3);box-shadow:0 40px 120px rgba(0,0,0,.55);background:#0d3a66}
.psk-lb-frame img{max-width:100%;max-height:72vh;object-fit:contain;display:block;background:#0d3a66}
.psk-lb-cap{padding:1rem 1.4rem 1.2rem}
.psk-lb-cap strong{display:block;font-size:1rem;font-weight:800;color:#fff}
.psk-lb-cap span{display:inline-flex;align-items:center;gap:.4rem;font-size:.72rem;font-weight:700;letter-spacing:.1em;
  text-transform:uppercase;color:#ffd54a;margin-top:.3rem}
.psk-lb-nav{position:absolute;top:50%;transform:translateY(-50%);width:48px;height:48px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;font-size:1rem;color:#fff;background:rgba(255,255,255,.1);
  border:1px solid rgba(255,255,255,.2);cursor:pointer;transition:all .3s var(--ease,ease)}
.psk-lb-nav:hover{background:#ffb300;color:#0d3a66}
.psk-lb-prev{left:1.4rem}
.psk-lb-next{right:1.4rem}

/* ---------- RESPONSIVE ---------- */
@media (max-width:1080px){
  .psk-hero-inner{grid-template-columns:1fr;gap:2.5rem}
  .psk-stats-grid{grid-template-columns:repeat(2,1fr)}
  .psk-masonry{grid-template-columns:repeat(3,1fr)}
  .psk-archive-grid{grid-template-columns:1fr}
  .psk-cta-box{grid-template-columns:1fr;gap:1.5rem}
  .psk-cta-btn{justify-self:start}
}
@media (max-width:860px){
  .psk-opening .psk-section,.psk-featured .psk-section{grid-template-columns:1fr;gap:2.5rem}
  .psk-cabinet{min-height:440px}
  .psk-gallery-tools{flex-direction:column;align-items:flex-start}
  .psk-yearnav{width:100%;overflow-x:auto;padding-bottom:.4rem}
  .psk-archive-head{grid-template-columns:1fr;gap:1rem}
  .psk-archive-badge{justify-self:start}
}
@media (max-width:640px){
  .psk-hero{min-height:78vh}
  .psk-stats-grid{grid-template-columns:1fr 1fr;gap:.8rem}
  .psk-stat{padding:1.5rem 1.1rem 1.3rem}
  .psk-masonry{grid-template-columns:1fr 1fr;grid-auto-rows:130px;gap:.7rem}
  .psk-photo.lg{grid-column:span 2;grid-row:span 2}
  .psk-opening-meta{grid-template-columns:1fr 1fr}
  .psk-feat-meta{flex-direction:column;align-items:flex-start}
  .psk-filters{flex-wrap:nowrap;overflow-x:auto;width:100%;padding-bottom:.4rem}
  .psk-cta-box h3{font-size:clamp(1.5rem,7vw,2rem)}
}
</style>
@endpush

@section('content')
<div class="psk-page">

  <!-- HERO (IDENTIK referensi — TIDAK DIUBAH) -->
  <section class="psk-hero">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="psk-hero-inner">
      <div>
        <div class="psk-kicker">Trophy Cabinet Sekolah</div>
        <h1 class="psk-title">
          <span class="psk-white">Prestasi</span> <span class="psk-gold">Sekolah</span>
        </h1>
        <p class="psk-lead">Dari kota hingga panggung nasional — setiap penghargaan adalah bukti komitmen SMK Negeri 2 Mojokerto dalam membangun pendidikan vokasi yang unggul, disiplin, dan berdaya saing.</p>
        <div class="psk-hero-meta">
          <span class="psk-pill"><i class="fas fa-award"></i> Arsip Resmi Sekolah</span>
          <span class="psk-pill"><i class="fas fa-map-marked-alt"></i> Kota → Nasional</span>
          <span class="psk-pill"><i class="fas fa-building"></i> 5 Kompetensi Keahlian</span>
        </div>
      </div>

      <div class="hero-photo" data-reveal="right">
        <img src="{{ asset('images/ps-penghargaan.jpg') }}" alt="Penghargaan dan piala prestasi SMK Negeri 2 Mojokerto" loading="eager">
        <div class="hero-photo-caption"><strong>Jejak Prestasi Skaneda</strong><span>Dokumentasi penghargaan resmi sekolah.</span></div>
      </div>
    </div>
  </section>

  <!-- 1. PEMBUKA: JEJAK PRESTASI SKANEDA -->
  <section class="psk-opening">
    <div class="psk-section">
      <div data-reveal="left">
        <span class="psk-eyebrow">Institutional Achievement</span>
        <h2 class="psk-section-title">Jejak Prestasi<br><span class="psk-gold">Skaneda</span></h2>
        <p class="psk-opening-desc">Kumpulan pencapaian <strong>SMK Negeri 2 Mojokerto</strong> dalam membangun sekolah vokasi yang unggul dan berprestasi. Bukan hanya milik individu — setiap piala adalah hasil kerja sama seluruh warga sekolah: peserta didik, guru pembina, dan mitra industri.</p>
        <div class="psk-opening-meta">
          <div class="psk-om"><b><em data-count="42">0</em>+</b><span>Penghargaan Juara 1</span></div>
          <div class="psk-om"><b><em data-count="12">0</em></b><span>Tingkat Nasional</span></div>
          <div class="psk-om"><b>5</b><span>Kompetensi Raih Juara</span></div>
        </div>
      </div>
      <div data-reveal="right">
        <div class="psk-cabinet">
          <span class="psk-cabinet-orn" aria-hidden="true">
            <span class="co-ring"></span>
            <span class="co-dots"></span>
            <span class="co-star"><i class="fas fa-star"></i></span>
            <span class="co-gold"></span>
          </span>
          <div class="psk-cabinet-body">
            <span class="psk-cabinet-tag"><i class="fas fa-trophy"></i> Trophy Cabinet</span>
            <h3>Etalase Kehormatan<br>Sekolah</h3>
            <p>Piala, medali, dan sertifikat dari berbagai ajang resmi — LKS, FLS2N, O2SN, OSN, hingga kompetisi industri — terpajang sebagai bukti nyata perjalanan institusi.</p>
            <div class="psk-cabinet-foot">
              <span><i class="fas fa-calendar-alt"></i> 2023 — 2025</span>
              <span><i class="fas fa-medal"></i> 42+ Juara 1</span>
              <span><i class="fas fa-flag"></i> Nasional</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. FEATURED ACHIEVEMENT (editorial 2 kolom) -->
  <section class="psk-featured">
    <div class="psk-section">
      <div class="psk-feat-photo" data-reveal="left">
        <img src="{{ asset('images/ps-juara-cloud.jpg') }}" alt="Peserta didik Skaneda memegang piala Juara 1 Cloud Computing" loading="eager">
        <span class="psk-feat-badge"><i class="fas fa-crown"></i> Featured Achievement</span>
        <span class="psk-feat-year">2025<small>Tahun Capaian</small></span>
      </div>
      <div class="psk-feat-info" data-reveal="right">
        <span class="psk-eyebrow">Capaian Utama Institusi</span>
        <span class="psk-feat-rank"><i class="fas fa-trophy"></i> Juara 2 — LKS Tingkat Nasional</span>
        <h3>IT Software <em>Solutions for Business</em></h3>
        <p class="psk-feat-desc">Peserta didik Rekayasa Perangkat Lunak mewakili Jawa Timur di panggung Lomba Kompetensi Siswa tingkat nasional bidang IT Software Solutions — pencapaian tertinggi sekolah dalam ajang bergengsi pendidikan vokasi.</p>
        <div class="psk-feat-meta">
          <span><i class="fas fa-flag"></i> Nasional</span>
          <span><i class="fas fa-user-graduate"></i> Rekayasa Perangkat Lunak</span>
          <span><i class="fas fa-calendar-alt"></i> 2025</span>
          <span><i class="fas fa-medal"></i> Medali Perak</span>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. PENCAPAIAN UTAMA (angka besar — data project) -->
  <section class="psk-stats">
    <div class="psk-section">
      <div data-reveal>
        <span class="psk-eyebrow">Angka Berbicara</span>
        <h2 class="psk-section-title">Pencapaian <span class="psk-gold">Utama</span></h2>
        <p class="psk-subtitle">Rekapitulasi capaian institusi yang terus tumbuh dari tahun ke tahun — dibina melalui program prestasi lintas kompetensi keahlian.</p>
      </div>
      <div class="psk-stats-grid">
        <div class="psk-stat" data-reveal>
          <div class="psk-stat-icon"><i class="fas fa-medal"></i></div>
          <b><em data-count="42">0</em>+</b>
          <span>Medali Juara 1</span>
          <p class="psk-stat-note">Raihan tertinggi di setiap ajang resmi yang diikuti sekolah.</p>
        </div>
        <div class="psk-stat" data-reveal style="--d:1">
          <div class="psk-stat-icon"><i class="fas fa-award"></i></div>
          <b><em data-count="35">0</em>+</b>
          <span>Medali Juara 2–3</span>
          <p class="psk-stat-note">Posisi podium kedua dan ketiga berbagai lomba.</p>
        </div>
        <div class="psk-stat" data-reveal style="--d:2">
          <div class="psk-stat-icon"><i class="fas fa-flag"></i></div>
          <b><em data-count="12">0</em></b>
          <span>Lomba Tingkat Nasional</span>
          <p class="psk-stat-note">Melaju mewakili Jawa Timur hingga panggung nasional.</p>
        </div>
        <div class="psk-stat" data-reveal style="--d:3">
          <div class="psk-stat-icon"><i class="fas fa-star"></i></div>
          <b><em data-count="5">0</em></b>
          <span>Kompetensi Raih Juara</span>
          <p class="psk-stat-note">Seluruh kompetensi keahlian pernah menyumbang juara.</p>
        </div>
      </div>
      <div class="psk-ajang" data-reveal><i class="fas fa-tags"></i> Ajang resmi yang rutin diikuti</div>
      <div class="psk-ajang-chips" data-reveal>
        <span class="psk-chip"><i class="fas fa-code"></i> LKS SMK</span>
        <span class="psk-chip"><i class="fas fa-palette"></i> FLS2N</span>
        <span class="psk-chip"><i class="fas fa-running"></i> O2SN</span>
        <span class="psk-chip"><i class="fas fa-microscope"></i> OSN</span>
        <span class="psk-chip"><i class="fas fa-robot"></i> PIMNAS</span>
        <span class="psk-chip"><i class="fas fa-fire"></i> Kompetisi Digital</span>
      </div>
    </div>
  </section>

  <!-- 4. GALERI PENGHARGAAN (masonry + filter + year nav) -->
  <section class="psk-gallery">
    <div class="psk-section">
      <div data-reveal>
        <span class="psk-eyebrow">Dokumentasi Penghargaan</span>
        <h2 class="psk-section-title">Galeri <span class="psk-gold">Penghargaan</span></h2>
        <p class="psk-subtitle">Momen resmi sekolah — penyerahan penghargaan, apresiasi pembina, dan perayaan piala. Klik foto untuk memperbesar.</p>
      </div>

      <div class="psk-gallery-tools" data-reveal>
        <div class="psk-filters" id="pskFilters">
          <button class="psk-fbtn active" data-filter="all"><i class="fas fa-th-large"></i> Semua</button>
          <button class="psk-fbtn" data-filter="kota"><i class="fas fa-building"></i> Kota / Kabupaten</button>
          <button class="psk-fbtn" data-filter="prov"><i class="fas fa-map-marked-alt"></i> Provinsi</button>
          <button class="psk-fbtn" data-filter="nas"><i class="fas fa-flag"></i> Nasional</button>
        </div>
        <div class="psk-yearnav" id="pskYearNav">
          <span class="psk-yearnav-label"><i class="fas fa-calendar-alt"></i> Tahun</span>
          <button class="psk-ybtn active" data-year="all">ALL</button>
          <button class="psk-ybtn" data-year="2025">2025</button>
          <button class="psk-ybtn" data-year="2024">2024</button>
          <button class="psk-ybtn" data-year="2023">2023</button>
        </div>
      </div>

      <div class="psk-masonry" id="pskMasonry" data-reveal>
        <a class="psk-photo lg" href="#" data-full="images/ps-penghargaan.jpg" data-cap="Penyerahan Penghargaan" data-sub="Apresiasi piala juara lomba" data-level="kota" data-year="2025">
          <img src="{{ asset('images/ps-penghargaan.jpg') }}" alt="Penyerahan penghargaan lomba" loading="eager">
          <span class="psk-photo-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="psk-photo-cap"><strong>Penyerahan Penghargaan</strong><span><i class="fas fa-trophy"></i> Kota · 2025</span></span>
        </a>
        <a class="psk-photo tall" href="#" data-full="images/ps-piala.jpg" data-cap="Etalase Piala Sekolah" data-sub="Koleksi trofi kejuaraan" data-level="all" data-year="2024">
          <img src="{{ asset('images/ps-piala.jpg') }}" alt="Etalase piala sekolah" loading="eager">
          <span class="psk-photo-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="psk-photo-cap"><strong>Etalase Piala Sekolah</strong><span><i class="fas fa-award"></i> Arsip Trofi</span></span>
        </a>
        <a class="psk-photo" href="#" data-full="images/ps-juara.jpg" data-cap="Juara Bersama Guru" data-sub="Piala juara 1 lomba" data-level="prov" data-year="2025">
          <img src="{{ asset('images/ps-juara.jpg') }}" alt="Siswa berpose dengan piala juara" loading="eager">
          <span class="psk-photo-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="psk-photo-cap"><strong>Juara Bersama Guru</strong><span><i class="fas fa-map-marked-alt"></i> Provinsi · 2025</span></span>
        </a>
        <a class="psk-photo" href="#" data-full="images/ps-podium.jpg" data-cap="Momen Podium" data-sub="Peserta didik di atas podium" data-level="prov" data-year="2024">
          <img src="{{ asset('images/ps-podium.jpg') }}" alt="Peserta didik di atas podium" loading="eager">
          <span class="psk-photo-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="psk-photo-cap"><strong>Momen Podium</strong><span><i class="fas fa-map-marked-alt"></i> Provinsi · 2024</span></span>
        </a>
        <a class="psk-photo wide" href="#" data-full="images/ps-upacara.jpg" data-cap="Apresiasi Upacara" data-sub="Pengumuman prestasi saat upacara" data-level="all" data-year="2023">
          <img src="{{ asset('images/ps-upacara.jpg') }}" alt="Apresiasi prestasi saat upacara bendera" loading="eager">
          <span class="psk-photo-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="psk-photo-cap"><strong>Apresiasi Upacara</strong><span><i class="fas fa-star"></i> Sekolah · 2023</span></span>
        </a>
        <a class="psk-photo" href="#" data-full="images/ps-juara-cloud.jpg" data-cap="Juara 1 Cloud Computing" data-sub="Piala LKS Cloud Computing" data-level="prov" data-year="2025">
          <img src="{{ asset('images/ps-juara-cloud.jpg') }}" alt="Piala Juara 1 Cloud Computing" loading="eager">
          <span class="psk-photo-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="psk-photo-cap"><strong>Juara 1 Cloud Computing</strong><span><i class="fas fa-map-marked-alt"></i> Provinsi · 2025</span></span>
        </a>
        <a class="psk-photo" href="#" data-full="images/ps-bersama.jpg" data-cap="Perayaan Bersama" data-sub="Siswa dan pembina merayakan" data-level="kota" data-year="2024">
          <img src="{{ asset('images/ps-bersama.jpg') }}" alt="Perayaan kemenangan bersama" loading="eager">
          <span class="psk-photo-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="psk-photo-cap"><strong>Perayaan Bersama</strong><span><i class="fas fa-building"></i> Kota · 2024</span></span>
        </a>
        <a class="psk-photo" href="#" data-full="images/ps-lomba.jpg" data-cap="Saat Bertanding" data-sub="Peserta didik saat lomba" data-level="nas" data-year="2025">
          <img src="{{ asset('images/ps-lomba.jpg') }}" alt="Peserta didik saat bertanding lomba" loading="eager">
          <span class="psk-photo-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="psk-photo-cap"><strong>Saat Bertanding</strong><span><i class="fas fa-flag"></i> Nasional · 2025</span></span>
        </a>
        <a class="psk-photo" href="#" data-full="images/ps-tim.jpg" data-cap="Tim Prestasi" data-sub="Tim perwakilan sekolah" data-level="nas" data-year="2024">
          <img src="{{ asset('images/ps-tim.jpg') }}" alt="Tim perwakilan sekolah" loading="eager">
          <span class="psk-photo-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="psk-photo-cap"><strong>Tim Prestasi</strong><span><i class="fas fa-flag"></i> Nasional · 2024</span></span>
        </a>
        <a class="psk-photo" href="#" data-full="images/ps-trofi.jpg" data-cap="Koleksi Trofi" data-sub="Piala dan medali juara" data-level="all" data-year="2025">
          <img src="{{ asset('images/ps-trofi.jpg') }}" alt="Koleksi trofi juara" loading="eager">
          <span class="psk-photo-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="psk-photo-cap"><strong>Koleksi Trofi</strong><span><i class="fas fa-award"></i> Arsip</span></span>
        </a>
      </div>

      <div class="psk-gallery-foot" data-reveal>
        <span class="psk-note"><i class="fas fa-images"></i> Foto menampilkan sebagian dokumentasi penghargaan sekolah.</span>
      </div>
    </div>
  </section>

  <!-- 5. QUOTE STATEMENT (foto + overlay navy) -->
  <section class="psk-quote">
    <div class="psk-quote-bg">
      <img src="{{ asset('images/ps-kampus.jpg') }}" alt="Lingkungan sekolah SMK Negeri 2 Mojokerto" loading="eager">
    </div>
    <div class="psk-section" data-reveal>
      <span class="psk-quote-mark">"</span>
      <p class="psk-quote-text">Prestasi bukan sekadar penghargaan, tetapi <em>bukti perjalanan sekolah</em> dalam memberikan pendidikan terbaik.</p>
      <span class="psk-quote-src">Moto Prestasi SMK Negeri 2 Mojokerto</span>
    </div>
  </section>

  <!-- 6. DAFTAR PRESTASI (official archive, group by tahun — data project) -->
  <section class="psk-archive">
    <div class="psk-section">
      <div class="psk-archive-head" data-reveal>
        <div>
          <span class="psk-eyebrow">Official Achievement Archive</span>
          <h2 class="psk-section-title">Daftar <span class="psk-gold">Prestasi</span></h2>
          <p class="psk-subtitle">Arsip resmi pencapaian sekolah, dikelompokkan berdasarkan tahun penyelenggaraan. Setiap entri merekam nama penghargaan, tingkat, dan kompetensi keahlian.</p>
        </div>
        <span class="psk-archive-badge"><i class="fas fa-file-alt"></i> Arsip 2023 — 2025</span>
      </div>

      <div class="psk-year-block" data-reveal>
        <div class="psk-year-head">
          <span class="psk-year-num">2025<em>.</em></span>
          <span class="psk-year-line"></span>
          <span class="psk-year-count"><i class="fas fa-trophy"></i> 4 Prestasi</span>
        </div>
        <div class="psk-archive-grid">
          <div class="psk-row">
            <div class="psk-row-rank gold"><i class="fas fa-trophy"></i></div>
            <div class="psk-row-info"><h4>LKS Web Technologies</h4><span><i class="fas fa-user-graduate"></i> Rekayasa Perangkat Lunak · Juara 1</span></div>
            <span class="psk-row-tag"><i class="fas fa-building"></i> Kota</span>
          </div>
          <div class="psk-row">
            <div class="psk-row-rank gold"><i class="fas fa-trophy"></i></div>
            <div class="psk-row-info"><h4>Lomba Cipta Menu Kuliner</h4><span><i class="fas fa-user-graduate"></i> Kuliner · Juara 1</span></div>
            <span class="psk-row-tag"><i class="fas fa-building"></i> Kota</span>
          </div>
          <div class="psk-row">
            <div class="psk-row-rank gold"><i class="fas fa-trophy"></i></div>
            <div class="psk-row-info"><h4>LKS Cloud Computing</h4><span><i class="fas fa-user-graduate"></i> Rekayasa Perangkat Lunak · Juara 1</span></div>
            <span class="psk-row-tag t-prov"><i class="fas fa-map-marked-alt"></i> Provinsi</span>
          </div>
          <div class="psk-row">
            <div class="psk-row-rank gold"><i class="fas fa-medal"></i></div>
            <div class="psk-row-info"><h4>LKS IT Software Solutions</h4><span><i class="fas fa-user-graduate"></i> Rekayasa Perangkat Lunak · Juara 2</span></div>
            <span class="psk-row-tag t-nas"><i class="fas fa-flag"></i> Nasional</span>
          </div>
        </div>
      </div>

      <div class="psk-year-block" data-reveal>
        <div class="psk-year-head">
          <span class="psk-year-num">2024<em>.</em></span>
          <span class="psk-year-line"></span>
          <span class="psk-year-count"><i class="fas fa-trophy"></i> 7 Prestasi</span>
        </div>
        <div class="psk-archive-grid">
          <div class="psk-row">
            <div class="psk-row-rank gold"><i class="fas fa-trophy"></i></div>
            <div class="psk-row-info"><h4>Lomba Bakery &amp; Pastry</h4><span><i class="fas fa-user-graduate"></i> Kuliner · Juara 1</span></div>
            <span class="psk-row-tag t-prov"><i class="fas fa-map-marked-alt"></i> Provinsi</span>
          </div>
          <div class="psk-row">
            <div class="psk-row-rank gold"><i class="fas fa-trophy"></i></div>
            <div class="psk-row-info"><h4>Festival Desain Poster</h4><span><i class="fas fa-user-graduate"></i> DKV · Juara 1</span></div>
            <span class="psk-row-tag"><i class="fas fa-building"></i> Kota</span>
          </div>
          <div class="psk-row">
            <div class="psk-row-rank"><i class="fas fa-medal"></i></div>
            <div class="psk-row-info"><h4>LKS IT Network Systems Administration</h4><span><i class="fas fa-user-graduate"></i> Rekayasa Perangkat Lunak · Juara 2</span></div>
            <span class="psk-row-tag t-prov"><i class="fas fa-map-marked-alt"></i> Provinsi</span>
          </div>
          <div class="psk-row">
            <div class="psk-row-rank"><i class="fas fa-medal"></i></div>
            <div class="psk-row-info"><h4>Lomba Inovasi Produk Olahan</h4><span><i class="fas fa-user-graduate"></i> APHP · Juara 2</span></div>
            <span class="psk-row-tag"><i class="fas fa-building"></i> Kota</span>
          </div>
          <div class="psk-row">
            <div class="psk-row-rank"><i class="fas fa-medal"></i></div>
            <div class="psk-row-info"><h4>Lomba Bank Syariah &amp; Ekonomi Digital</h4><span><i class="fas fa-user-graduate"></i> Perbankan Syariah · Juara 3</span></div>
            <span class="psk-row-tag t-prov"><i class="fas fa-map-marked-alt"></i> Provinsi</span>
          </div>
          <div class="psk-row">
            <div class="psk-row-rank"><i class="fas fa-star"></i></div>
            <div class="psk-row-info"><h4>LKS Nasional Culinary Arts</h4><span><i class="fas fa-user-graduate"></i> Kuliner · Harapan 1</span></div>
            <span class="psk-row-tag t-nas"><i class="fas fa-flag"></i> Nasional</span>
          </div>
          <div class="psk-row">
            <div class="psk-row-rank"><i class="fas fa-star"></i></div>
            <div class="psk-row-info"><h4>OSN Informatika</h4><span><i class="fas fa-user-graduate"></i> Rekayasa Perangkat Lunak · Finalis</span></div>
            <span class="psk-row-tag t-nas"><i class="fas fa-flag"></i> Nasional</span>
          </div>
        </div>
      </div>

      <div class="psk-year-block" data-reveal>
        <div class="psk-year-head">
          <span class="psk-year-num">2023<em>.</em></span>
          <span class="psk-year-line"></span>
          <span class="psk-year-count"><i class="fas fa-trophy"></i> 5 Prestasi</span>
        </div>
        <div class="psk-archive-grid">
          <div class="psk-row">
            <div class="psk-row-rank gold"><i class="fas fa-trophy"></i></div>
            <div class="psk-row-info"><h4>Lomba Inovasi Pangan Lokal</h4><span><i class="fas fa-user-graduate"></i> APHP · Juara 1</span></div>
            <span class="psk-row-tag t-prov"><i class="fas fa-map-marked-alt"></i> Provinsi</span>
          </div>
          <div class="psk-row">
            <div class="psk-row-rank"><i class="fas fa-medal"></i></div>
            <div class="psk-row-info"><h4>FLS2N Kategori Desain Komunikasi Visual</h4><span><i class="fas fa-user-graduate"></i> DKV · Juara 2</span></div>
            <span class="psk-row-tag t-prov"><i class="fas fa-map-marked-alt"></i> Provinsi</span>
          </div>
          <div class="psk-row">
            <div class="psk-row-rank"><i class="fas fa-medal"></i></div>
            <div class="psk-row-info"><h4>O2SN Bulu Tangkis</h4><span><i class="fas fa-user-graduate"></i> Umum · Juara 3</span></div>
            <span class="psk-row-tag"><i class="fas fa-building"></i> Kota</span>
          </div>
          <div class="psk-row">
            <div class="psk-row-rank"><i class="fas fa-star"></i></div>
            <div class="psk-row-info"><h4>FLS2N Film Pendek</h4><span><i class="fas fa-user-graduate"></i> DKV · Harapan 1</span></div>
            <span class="psk-row-tag"><i class="fas fa-building"></i> Kota</span>
          </div>
          <div class="psk-row">
            <div class="psk-row-rank"><i class="fas fa-star"></i></div>
            <div class="psk-row-info"><h4>Kompetisi Inovasi Digital Siswa</h4><span><i class="fas fa-user-graduate"></i> Rekayasa Perangkat Lunak · Top 10</span></div>
            <span class="psk-row-tag t-nas"><i class="fas fa-flag"></i> Nasional</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 7. CTA -->
  <section class="psk-cta">
    <div class="psk-section">
      <div class="psk-cta-box" data-reveal>
        <div class="psk-cta-inner">
          <span class="psk-cta-eyebrow"><i class="fas fa-handshake"></i> Mari Bergabung</span>
          <h3>Jadilah Bagian dari Perjalanan Prestasi Skaneda</h3>
          <p>Bergabunglah bersama keluarga besar SMK Negeri 2 Mojokerto — tempat disiplin, karya, dan prestasi tumbuh menjadi kebanggaan.</p>
        </div>
        <a class="psk-cta-btn" href="{{ route('kontak') }}"><i class="fas fa-arrow-right"></i> Hubungi Sekolah</a>
      </div>
    </div>
  </section>

  <!-- LIGHTBOX -->
  <div class="psk-lightbox" id="pskLightbox" aria-hidden="true">
    <button class="psk-lb-close" id="pskLbClose" aria-label="Tutup"><i class="fas fa-times"></i></button>
    <button class="psk-lb-nav psk-lb-prev" id="pskLbPrev" aria-label="Sebelumnya"><i class="fas fa-chevron-left"></i></button>
    <button class="psk-lb-nav psk-lb-next" id="pskLbNext" aria-label="Berikutnya"><i class="fas fa-chevron-right"></i></button>
    <div class="psk-lb-frame">
      <img src="" alt="Pratinjau penghargaan">
      <div class="psk-lb-cap">
        <strong id="pskLbCap"></strong>
        <span id="pskLbSub"></span>
      </div>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
(function () {
  'use strict';
  var doc = document;

  /* ---------- Reveal on scroll ---------- */
  var revealEls = doc.querySelectorAll('[data-reveal]');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) {
          en.target.classList.add('revealed');
          io.unobserve(en.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    revealEls.forEach(function (el) { io.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('revealed'); });
  }

  /* ---------- Counter animasi ---------- */
  function animateCount(el) {
    var target = parseInt(el.getAttribute('data-count'), 10);
    if (isNaN(target)) return;
    var dur = 1400, start = null;
    function step(ts) {
      if (!start) start = ts;
      var p = Math.min((ts - start) / dur, 1);
      var eased = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.round(target * eased);
      if (p < 1) requestAnimationFrame(step);
      else el.textContent = target;
    }
    requestAnimationFrame(step);
  }
  var counters = doc.querySelectorAll('[data-count]');
  if ('IntersectionObserver' in window) {
    var co = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) {
          animateCount(en.target);
          co.unobserve(en.target);
        }
      });
    }, { threshold: 0.5 });
    counters.forEach(function (el) { co.observe(el); });
  } else {
    counters.forEach(animateCount);
  }

  /* ---------- Filter galeri (kategori + tahun) ---------- */
  var photos = Array.prototype.slice.call(doc.querySelectorAll('#pskMasonry .psk-photo'));
  var fbtns = Array.prototype.slice.call(doc.querySelectorAll('#pskFilters .psk-fbtn'));
  var ybtns = Array.prototype.slice.call(doc.querySelectorAll('#pskYearNav .psk-ybtn'));
  var curFilter = 'all', curYear = 'all';

  function applyFilter() {
    photos.forEach(function (p) {
      var lvl = p.getAttribute('data-level') || 'all';
      var yr = p.getAttribute('data-year') || 'all';
      var okLvl = (curFilter === 'all' || lvl === 'all' || lvl === curFilter);
      var okYear = (curYear === 'all' || yr === 'all' || yr === curYear);
      p.style.display = (okLvl && okYear) ? '' : 'none';
    });
  }
  fbtns.forEach(function (b) {
    b.addEventListener('click', function () {
      fbtns.forEach(function (x) { x.classList.remove('active'); });
      b.classList.add('active');
      curFilter = b.getAttribute('data-filter');
      applyFilter();
    });
  });
  ybtns.forEach(function (b) {
    b.addEventListener('click', function () {
      ybtns.forEach(function (x) { x.classList.remove('active'); });
      b.classList.add('active');
      curYear = b.getAttribute('data-year');
      applyFilter();
    });
  });

  /* ---------- Lightbox ---------- */
  var box = doc.getElementById('pskLightbox');
  var lbImg = box.querySelector('img');
  var lbCap = doc.getElementById('pskLbCap');
  var lbSub = doc.getElementById('pskLbSub');
  var idx = 0;

  function openAt(i) {
    idx = (i + photos.length) % photos.length;
    var p = photos[idx];
    lbImg.setAttribute('src', p.getAttribute('data-full'));
    lbCap.textContent = p.getAttribute('data-cap') || '';
    lbSub.textContent = p.getAttribute('data-sub') || '';
    box.classList.add('open');
    box.setAttribute('aria-hidden', 'false');
    doc.body.style.overflow = 'hidden';
  }
  function closeLb() {
    box.classList.remove('open');
    box.setAttribute('aria-hidden', 'true');
    doc.body.style.overflow = '';
  }
  photos.forEach(function (p, i) {
    p.addEventListener('click', function (e) {
      e.preventDefault();
      if (p.style.display === 'none') return;
      openAt(i);
    });
  });
  doc.getElementById('pskLbClose').addEventListener('click', closeLb);
  doc.getElementById('pskLbPrev').addEventListener('click', function () { openAt(idx - 1); });
  doc.getElementById('pskLbNext').addEventListener('click', function () { openAt(idx + 1); });
  box.addEventListener('click', function (e) { if (e.target === box) closeLb(); });
  doc.addEventListener('keydown', function (e) {
    if (!box.classList.contains('open')) return;
    if (e.key === 'Escape') closeLb();
    if (e.key === 'ArrowLeft') openAt(idx - 1);
    if (e.key === 'ArrowRight') openAt(idx + 1);
  });
})();
</script>
@endpush
