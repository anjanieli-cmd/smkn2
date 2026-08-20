@extends('layouts.app')

@section('title', 'Karya Siswa — SMK Negeri 2 Mojokerto')
@section('description', 'Galeri karya siswa SMK Negeri 2 Mojokerto — hasil karya kompetensi keahlian RPL, Kuliner, APHP, DKV, dan Layanan Perbankan Syariah.')

@push('styles')
<style>
/* =========================================================
   KARYA SISWA — GALERI KARYA PESERTA DIDIK
   Visual language: SENADA PERSIS dengan Guru & Staf, Sejarah
   Sekolah, Struktur Organisasi & Visi Misi — foto gedung +
   overlay, watermark typography, ornamen geometris (home-orn),
   glassmorphism, scroll-reveal. Header & footer dari
   layouts.app (identik).
   KONTEN UTAMA UNIK (tidak meniru layout file referensi):
   carousel slider karya siswa (foto + judul + nama + jurusan
   + tahun, panah prev/next + dot indicator), kategori karya,
   strip prestasi, CTA.
   Warna: navy #0d3a66, biru #2f6fa8, putih, gold #ffd54a/#ffb300.
   ========================================================= */
.ks-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}
.ks-page *{box-sizing:border-box}

/* ---------- HERO: 100% MIRIP HALAMAN PPDB (light theme + watermark + abstract ornamen) ---------- */
.ks-hero{position:relative;min-height:clamp(620px,78vh,790px);display:flex;align-items:center;overflow:hidden;
  background:#fff;color:#0d3a66;isolation:isolate}
.ks-hero::before{display:none}
/* Watermark typography besar transparan */
.ks-hero::after{content:"KARYA";position:absolute;z-index:0;left:2%;top:58%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(9rem,23vw,23rem);font-weight:900;line-height:.78;
  letter-spacing:.015em;color:rgba(13,58,102,.035);-webkit-text-stroke:1px rgba(255,122,0,.09);
  pointer-events:none;white-space:nowrap;user-select:none}
.ks-ref-ornaments{position:absolute!important;inset:0;z-index:1;overflow:hidden;pointer-events:none;opacity:1}
.ks-ref-ornament-image{position:absolute!important;inset:0;width:100%;height:100%;display:block;
  object-fit:cover;object-position:center center;max-width:none;opacity:1}
.ks-hero-inner{position:relative;z-index:4;width:100%;max-width:1500px;margin:0 auto;
  padding:clamp(4rem,10vh,7rem) clamp(1.25rem,4.2vw,4.5rem) clamp(4rem,9vh,6rem);display:block}

.ks-kicker{position:relative;z-index:5;display:inline-flex;align-items:center;gap:.65rem;font-size:.72rem;
  font-weight:900;letter-spacing:.18em;text-transform:uppercase;color:#ff6f00;margin-bottom:1.2rem;
  padding:.55rem .85rem;border:1px solid rgba(255,111,0,.18);border-radius:999px;background:#fffaf5}
.ks-kicker::before{content:"";width:9px;height:9px;border-radius:50%;background:#ff6f00;
  box-shadow:0 0 0 6px rgba(255,111,0,.10)}

/* ---------- TITLE: bertumpuk besar, 100% senada PPDB ---------- */
.ks-title{position:relative;z-index:5;font-family:var(--font-display);font-size:clamp(5.2rem,11.5vw,11rem);
  line-height:.82;letter-spacing:-.045em;margin:0;max-width:900px;text-transform:uppercase;
  text-shadow:none;animation:hdFadeUp .7s .1s var(--ease, ease) both}
.ks-title .ks-white{color:#0d3a66;display:block}
.ks-title .ks-gold{display:block;
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent;
  text-shadow:none;letter-spacing:-.025em}
.ks-lead{font-size:1rem;line-height:1.75;color:#52657a;max-width:720px;
  margin:1.7rem 0 0;animation:hdFadeUp .7s .26s var(--ease, ease) both}
.ks-hero-meta{display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;animation:hdFadeUp .7s .4s var(--ease, ease) both}
.ks-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;
  border:1px solid rgba(13,58,102,.12);background:#fff;border-radius:999px;color:#0d3a66;
  font-size:.72rem;font-weight:800;box-shadow:0 8px 24px rgba(13,58,102,.06)}
.ks-pill i{color:#ff7a00}

.hero-photo{display:none}
@media(min-width:1050px){.ks-hero-inner{padding-right:44%}}
@media(max-width:1050px){.ks-hero-inner{padding-right:1.25rem}.ks-ref-ornaments{opacity:.72}}
@media(max-width:900px){.ks-title{font-size:clamp(4.6rem,13vw,8rem)}.ks-ref-ornament-image{opacity:.88}}
@media(max-width:700px){.ks-hero{align-items:flex-start}.ks-hero-inner{width:90%}.ks-title{font-size:clamp(3.4rem,16vw,5.6rem)}}
@media(max-width:560px){.ks-ref-ornament-image{opacity:.62}}

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
.ks-hero .home-orn .ho-chevron{left:-150px;bottom:-60px;border-color:rgba(255,255,255,.10)}
.ks-hero .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.ks-hero .home-orn .ho-line{right:-80px;top:22%;opacity:.22}
.ks-hero .home-orn .ho-dots{right:6%;bottom:14%;opacity:.3}
.ks-hero .home-orn .ho-ring{left:44%;bottom:-90px;border-color:rgba(255,255,255,.12)}
.ks-hero .home-orn .ho-gold{right:16%;top:20%}
.ks-hero .home-orn .ho-square{left:12%;top:22%}
.ks-intro .home-orn .ho-chevron{right:-145px;top:45px}
.ks-intro .home-orn .ho-line{left:-80px;top:170px}
.ks-intro .home-orn .ho-dots{left:3%;bottom:100px}
.ks-intro .home-orn .ho-ring{right:8%;bottom:90px}
.ks-intro .home-orn .ho-gold{right:16%;top:22%}
.ks-intro .home-orn .ho-square{left:11%;top:15%}
.ks-intro .home-orn .ho-corner{right:3%;bottom:8%;transform:rotate(180deg)}
.ks-slider .home-orn .ho-chevron{left:-145px;bottom:-60px}
.ks-slider .home-orn .ho-line{right:-80px;bottom:170px}
.ks-slider .home-orn .ho-dots{right:4%;top:90px}
.ks-slider .home-orn .ho-ring{left:7%;top:70px}
.ks-slider .home-orn .ho-gold{left:20%;top:30%}
.ks-kategori .home-orn .ho-chevron{right:-150px;top:-40px}
.ks-kategori .home-orn .ho-dots{left:5%;bottom:120px}
.ks-kategori .home-orn .ho-ring{right:6%;bottom:60px}
.ks-kategori .home-orn .ho-square{right:14%;top:18%}
.ks-kategori .home-orn .ho-gold{left:12%;top:34%}
.ks-prestasi .home-orn .ho-chevron{left:-150px;top:30px}
.ks-prestasi .home-orn .ho-dots{right:5%;top:60px}
.ks-prestasi .home-orn .ho-ring{left:6%;bottom:70px}
.ks-prestasi .home-orn .ho-square{right:10%;bottom:12%}
.ks-prestasi .home-orn .ho-gold{right:20%;top:28%}
.ks-cta .home-orn .ho-chevron{left:-120px;bottom:-80px;border-color:rgba(255,255,255,.10)}
.ks-cta .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.ks-cta .home-orn .ho-dots{left:8%;top:30%;opacity:.22}
.ks-cta .home-orn .ho-ring{right:-70px;top:20%;border-color:rgba(255,255,255,.10)}
.ks-cta .home-orn .ho-gold{left:20%;bottom:26%}

.ks-hero>*:not(.home-orn),
.ks-intro>*:not(.home-orn),
.ks-slider>*:not(.home-orn),
.ks-kategori>*:not(.home-orn),
.ks-prestasi>*:not(.home-orn),
.ks-cta>*:not(.home-orn){position:relative;z-index:2}

/* ---------- SECTION SHELL & HEADING ---------- */
.ks-section{width:min(1180px,92%);margin:0 auto}
.ks-intro{position:relative;padding:96px 0 110px;background:#fff}
.ks-intro-grid{display:grid;grid-template-columns:.95fr 1.05fr;gap:4.5rem;align-items:center}

.big-heading{font-family:var(--font-display);font-size:clamp(2.2rem,4.6vw,3.6rem);font-weight:800;
  line-height:1.16;letter-spacing:.01em;margin:0;color:#0d3a66;text-transform:uppercase}
.big-heading span{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 60%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.ks-intro-note{max-width:420px;color:#718396;font-size:.84rem;line-height:1.8;margin-top:1rem}

/* ---------- 1. PENGANTAR (stats kilat + blurb) ---------- */
.ks-blurb{font-size:.92rem;line-height:1.9;color:#718396;margin:0}
.ks-blurb strong{color:#0d3a66}
.ks-mini-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-top:2.2rem}
.ks-mini{position:relative;background:#f3f7fb;border:1px solid #e3edf0;border-radius:18px;padding:1.1rem 1rem;text-align:center;
  transition:transform .35s var(--ease, ease),box-shadow .35s var(--ease, ease)}
.ks-mini:hover{transform:translateY(-6px);box-shadow:0 16px 36px rgba(13,58,102,.10)}
.ks-mini b{display:block;font-family:var(--font-display);font-size:1.7rem;font-weight:900;line-height:1;color:#0d3a66}
.ks-mini b em{font-style:normal;color:#ffb300}
.ks-mini span{display:block;font-size:.7rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:#718396;margin-top:.45rem}

.ks-cat-line{display:flex;align-items:center;gap:.6rem;font-size:.78rem;font-weight:800;color:#2f6fa8;margin-top:2.4rem}
.ks-cat-line i{color:#ffb300}
.ks-cat-chips{display:flex;flex-wrap:wrap;gap:.55rem;margin-top:.8rem}
.ks-chip{display:inline-flex;align-items:center;gap:.45rem;padding:.5rem .85rem;border-radius:999px;
  border:1px solid #e3edf0;background:#fff;font-size:.74rem;font-weight:800;color:#0d3a66;
  transition:border-color .3s var(--ease, ease),transform .3s var(--ease, ease)}
.ks-chip i{color:#ffb300}
.ks-chip:hover{border-color:rgba(255,179,0,.5);transform:translateY(-2px)}

/* ---------- 2. CAROUSEL / SLIDER KARYA SISWA ---------- */
.ks-slider{position:relative;padding:96px 0 110px;
  background-image:radial-gradient(rgba(13,58,102,.055) 1.4px,transparent 1.5px);background-size:22px 22px}
.ks-slider-head{display:flex;justify-content:space-between;align-items:end;gap:2rem;flex-wrap:wrap}
.ks-slider-note{max-width:360px;color:#718396;font-size:.8rem;line-height:1.7}

.ks-carousel{position:relative;margin-top:3.2rem;max-width:1000px;margin-left:auto;margin-right:auto}
.ks-viewport{position:relative;overflow:hidden;border-radius:26px;
  box-shadow:0 34px 80px rgba(13,58,102,.22);border:1px solid rgba(255,255,255,.25)}
.ks-track{display:flex;transition:transform .65s var(--ease, ease)}
.ks-slide{position:relative;flex:0 0 100%;min-width:100%;height:clamp(380px,52vw,520px);overflow:hidden;background:#0d3a66}
.ks-slide img{width:100%;height:100%;object-fit:cover;display:block;transform:scale(1.02)}
.ks-slide::after{content:"";position:absolute;inset:0;z-index:2;
  background:linear-gradient(180deg,rgba(7,22,42,0) 34%,rgba(7,22,42,.30) 58%,rgba(7,22,42,.86) 100%)}
.ks-slide-tag{position:absolute;top:1.3rem;left:1.3rem;z-index:3;display:inline-flex;align-items:center;gap:.5rem;
  padding:.5rem .9rem;border-radius:999px;background:rgba(7,22,42,.55);border:1px solid rgba(255,213,74,.5);
  color:#ffd54a;font-size:.7rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;
  backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)}
.ks-slide-tag i{color:#ffd54a}
.ks-slide-no{position:absolute;top:1.2rem;right:1.4rem;z-index:3;font-family:var(--font-display);
  font-size:1rem;font-weight:900;color:rgba(255,255,255,.55)}
.ks-slide-cap{position:absolute;left:0;right:0;bottom:0;z-index:3;padding:0 2.2rem 2rem}
.ks-slide-cap h3{margin:0;font-family:var(--font-display);font-size:clamp(1.25rem,2.6vw,1.7rem);font-weight:800;color:#fff;line-height:1.25}
.ks-slide-cap p{margin:.45rem 0 0;font-size:.86rem;line-height:1.6;color:rgba(235,245,253,.82);max-width:640px}
.ks-slide-meta{display:flex;flex-wrap:wrap;gap:.6rem;margin-top:1rem}
.ks-slide-meta span{display:inline-flex;align-items:center;gap:.45rem;font-size:.72rem;font-weight:800;color:#fff;
  background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.22);border-radius:999px;padding:.38rem .75rem;
  backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px)}
.ks-slide-meta span i{color:#ffd54a}

.ks-arrow{position:absolute;top:50%;transform:translateY(-50%);z-index:6;width:54px;height:54px;border-radius:50%;
  border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1.05rem;color:#0a2d52;
  background:linear-gradient(135deg,#ffd54a,#ffb300);box-shadow:0 14px 34px rgba(255,179,0,.42);
  transition:transform .3s var(--ease, ease),box-shadow .3s var(--ease, ease)}
.ks-arrow:hover{transform:translateY(-50%) scale(1.08);box-shadow:0 18px 42px rgba(255,179,0,.5)}
.ks-arrow.ks-prev{left:-27px}
.ks-arrow.ks-next{right:-27px}

.ks-dots{display:flex;justify-content:center;gap:.55rem;margin-top:1.6rem}
.ks-dot{width:10px;height:10px;border-radius:99px;border:none;cursor:pointer;padding:0;
  background:rgba(13,58,102,.22);transition:all .35s var(--ease, ease)}
.ks-dot.active{width:34px;background:linear-gradient(90deg,#ffd54a,#ffb300)}

.ks-counter{display:flex;justify-content:center;gap:.5rem;margin-top:1.1rem;
  font-family:var(--font-display);font-size:.82rem;font-weight:800;color:#718396;letter-spacing:.1em}
.ks-counter b{color:#0d3a66}

/* ---------- 3. KATEGORI KARYA ---------- */
.ks-kategori{position:relative;padding:96px 0 110px;background:#fff}
.ks-kat-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:1.2rem;margin-top:3rem}
.ks-kat-card{position:relative;background:#fff;border:1px solid #e3edf0;border-radius:22px;padding:1.7rem 1.3rem 1.5rem;
  text-align:center;transition:transform .35s var(--ease, ease),box-shadow .35s var(--ease, ease),border-color .35s var(--ease, ease)}
.ks-kat-card:hover{transform:translateY(-8px);box-shadow:0 26px 55px rgba(13,58,102,.14);border-color:rgba(13,58,102,.22)}
.ks-kat-icon{width:60px;height:60px;margin:0 auto;border-radius:18px;display:flex;align-items:center;justify-content:center;
  font-size:1.4rem;color:#fff;background:linear-gradient(135deg,#0d3a66,#2f6fa8);
  transition:transform .35s var(--ease, ease)}
.ks-kat-card:nth-child(2) .ks-kat-icon{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52}
.ks-kat-card:nth-child(3) .ks-kat-icon{background:linear-gradient(135deg,#2f6fa8,#0d3a66)}
.ks-kat-card:nth-child(4) .ks-kat-icon{background:linear-gradient(135deg,#5a89b8,#2f6fa8)}
.ks-kat-card:nth-child(5) .ks-kat-icon{background:linear-gradient(135deg,#ffb300,#ff8a00);color:#0a2d52}
.ks-kat-card:hover .ks-kat-icon{transform:rotate(-8deg) scale(1.06)}
.ks-kat-name{font-family:var(--font-display);font-size:1rem;font-weight:800;color:#0d3a66;margin:.95rem 0 .3rem}
.ks-kat-text{font-size:.76rem;line-height:1.65;color:#718396;margin:0}

/* ---------- 4. PRESTASI KARYA ---------- */
.ks-prestasi{position:relative;padding:100px 0 110px;
  background-image:radial-gradient(rgba(13,58,102,.055) 1.4px,transparent 1.5px);background-size:22px 22px;overflow:hidden}
.ks-prestasi::before{content:"PRODUK";position:absolute;left:-1%;top:8%;transform:rotate(-90deg);
  font-family:var(--font-display);font-size:clamp(4.5rem,11vw,9rem);font-weight:900;line-height:1;
  letter-spacing:.04em;color:rgba(13,58,102,.045);white-space:nowrap;pointer-events:none;user-select:none}
.ks-prestasi-head{display:flex;justify-content:space-between;align-items:end;gap:2rem;flex-wrap:wrap}
.ks-prestasi-note{max-width:360px;color:#718396;font-size:.8rem;line-height:1.7}
.ks-prestasi-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1.2rem;margin-top:3rem}
.ks-prestasi-card{position:relative;display:flex;gap:1.1rem;align-items:flex-start;background:#fff;border:1px solid #e3edf0;
  border-radius:20px;padding:1.1rem 1.5rem 1.1rem 1.1rem;overflow:hidden;
  transition:transform .35s var(--ease, ease),box-shadow .35s var(--ease, ease)}
.ks-prestasi-card:hover{transform:translateY(-6px);box-shadow:0 22px 48px rgba(13,58,102,.12)}
.ks-prestasi-media{position:relative;flex:0 0 86px;width:86px;height:86px;border-radius:16px;overflow:hidden}
.ks-prestasi-media img{width:100%;height:100%;object-fit:cover;display:block;
  transition:transform .5s var(--ease, ease)}
.ks-prestasi-card:hover .ks-prestasi-media img{transform:scale(1.1)}
.ks-prestasi-medal{position:absolute;z-index:2;right:-7px;bottom:-7px;width:32px;height:32px;border-radius:10px;
  display:flex;align-items:center;justify-content:center;font-size:.8rem;color:#fff;
  background:linear-gradient(135deg,#ffd54a,#ffb300);box-shadow:0 8px 18px rgba(4,14,28,.28);border:2.5px solid #fff}
.ks-prestasi-card:nth-child(2) .ks-prestasi-medal{background:linear-gradient(135deg,#9db2c8,#5a89b8)}
.ks-prestasi-card:nth-child(3) .ks-prestasi-medal{background:linear-gradient(135deg,#d99a5b,#b06f2c)}
.ks-prestasi-card:nth-child(4) .ks-prestasi-medal{background:linear-gradient(135deg,#2f6fa8,#0d3a66)}
.ks-prestasi-card:nth-child(5) .ks-prestasi-medal{background:linear-gradient(135deg,#ffb300,#ff8a00);color:#0a2d52}
.ks-prestasi-card:nth-child(6) .ks-prestasi-medal{background:linear-gradient(135deg,#0d3a66,#5a89b8)}
.ks-prestasi-body h3{margin:0;font-family:var(--font-display);font-size:1.02rem;font-weight:800;color:#0d3a66;line-height:1.3}
.ks-prestasi-body p{margin:.4rem 0 0;font-size:.8rem;line-height:1.7;color:#718396}
.ks-prestasi-year{display:inline-block;margin-top:.55rem;font-size:.68rem;font-weight:800;letter-spacing:.06em;color:#b45309;
  background:rgba(255,213,74,.28);border:1px solid rgba(255,179,0,.4);border-radius:999px;padding:.22rem .6rem}

/* ---------- CTA ---------- */
.ks-cta{position:relative;width:min(1180px,92%);margin:0 auto 5.5rem;padding:64px 5% 68px;text-align:center;
  border-radius:28px;overflow:hidden;color:#fff;
  background:linear-gradient(135deg,#0a2d52,#0d3a66 55%,#123f6e);
  box-shadow:0 34px 80px rgba(13,58,102,.35)}
.ks-cta::before{content:"";position:absolute;left:0;right:0;top:0;height:4px;
  background:linear-gradient(90deg,#ffd54a,#ffb300)}
.ks-cta h2{font-family:var(--font-display);font-size:clamp(1.7rem,3.6vw,2.7rem);font-weight:800;margin:0;line-height:1.2}
.ks-cta h2 em{font-style:normal;background:linear-gradient(135deg,#ffe66d,#ffc107 55%,#ff8a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.ks-cta p{max-width:560px;margin:1.1rem auto 1.9rem;font-size:.92rem;line-height:1.85;color:rgba(235,245,253,.85)}
.ks-cta-btn{display:inline-flex;align-items:center;gap:.6rem;padding:.95rem 2rem;border-radius:999px;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52;font-weight:800;font-size:.92rem;
  text-decoration:none;box-shadow:0 16px 36px rgba(255,179,0,.32);transition:transform .3s var(--ease, ease),box-shadow .3s var(--ease, ease)}
.ks-cta-btn:hover{transform:translateY(-3px);box-shadow:0 22px 46px rgba(255,179,0,.42)}
.ks-cta-note{margin-top:1.1rem;font-size:.76rem;color:rgba(235,245,253,.65)}
.ks-cta-note i{color:#ffd54a;margin-right:.4rem}

/* ---------- SCROLL REVEAL ---------- */
[data-reveal]{opacity:0;transform:translateY(36px);
  transition:opacity .7s ease,transform .7s var(--ease, ease)}
[data-reveal="left"]{transform:translateX(-46px)}
[data-reveal="right"]{transform:translateX(46px)}
[data-reveal].revealed{opacity:1;transform:none}
[data-reveal]{transition-delay:calc(var(--d,0)*90ms)}

/* ---------- RESPONSIVE ---------- */
@media(max-width:1200px){
  .ks-kat-grid{grid-template-columns:repeat(3,1fr)}
  .ks-prestasi-grid{grid-template-columns:1fr}
}
@media(max-width:950px){
  .ks-hero-inner{grid-template-columns:1fr;gap:2rem}
  .hero-photo{height:360px;transform:translateY(-18px) rotate(1deg)}
  .ks-intro-grid{grid-template-columns:1fr;gap:3rem}
}
@media(max-width:700px){
  .ks-hero{min-height:0;align-items:flex-start}
  .ks-hero-inner{padding:clamp(3rem,8vh,4.5rem) 5% 3.6rem;width:90%}
  .ks-hero::after{font-size:clamp(3.6rem,22vw,6rem);opacity:.6;right:-4%}
  .ks-title{font-size:clamp(2.8rem,13vw,4.2rem);margin-top:0}
  .hero-photo{height:300px}
  .ks-section,.ks-intro,.ks-slider{padding:85px 0 90px}
  .ks-kategori,.ks-prestasi{padding:85px 0 90px}
  .ks-cta{padding:56px 5% 64px;margin-bottom:4.5rem;width:92%;margin-left:auto;margin-right:auto}
  .ks-kat-grid{grid-template-columns:1fr 1fr;gap:1rem}
  .ks-mini-stats{grid-template-columns:1fr 1fr 1fr;gap:.6rem}
  .ks-arrow{width:44px;height:44px;font-size:.9rem}
  .ks-arrow.ks-prev{left:-8px}
  .ks-arrow.ks-next{right:-8px}
  .ks-slide{height:clamp(400px,115vw,470px)}
  .ks-slide-cap{padding:0 1.2rem 1.4rem}
  .ks-slide-meta span{font-size:.66rem;padding:.32rem .6rem}
  .home-orn .ho-chevron{width:220px;height:220px}
  .home-orn .ho-dots{width:80px;height:80px;background-size:14px 14px}
  .home-orn .ho-ring{width:110px;height:110px}
  .home-orn .ho-line{width:190px}
  .home-orn .ho-square{width:42px;height:42px}
  .home-orn .ho-corner{width:70px;height:70px}
  .ks-hero .home-orn .ho-chevron{left:-120px;bottom:-40px}
  [data-reveal]{opacity:1;transform:none}
}
</style>
@endpush

@section('content')
<div class="ks-page">

  <!-- HERO (100% mirip halaman PPDB: watermark + ornamen abstrak + judul besar bertumpuk) -->
  <section class="ks-hero">
    <div class="ks-ref-ornaments" aria-hidden="true" style="background-image:url('{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}');background-size:cover;background-position:center center;">
      <img
        src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}"
        alt=""
        class="ks-ref-ornament-image"
        aria-hidden="true"
      >
    </div>
    <div class="ks-hero-inner">
      <div>
        <div class="ks-kicker">Galeri Karya Peserta Didik</div>
        <h1 class="ks-title">
          <span class="ks-white">Karya</span>
          <span class="ks-gold">Siswa</span>
        </h1>
      </div>
    </div>
  </section>

  <!-- 1. PENGANTAR KARYA SISWA -->
  <section class="ks-intro">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="ks-section ks-intro-grid">
      <div data-reveal="left">
        <h2 class="big-heading">Karya nyata, <span>buah dari belajar.</span></h2>
        <p class="ks-intro-note">Karya siswa adalah wujud nyata dari pembelajaran berbasis proyek dan kearifan lokal yang dikembangkan SMK Negeri 2 Mojokerto.</p>

        <div class="ks-mini-stats" style="margin-top:2rem">
          <div class="ks-mini" data-reveal>
            <b><em>25+</em></b>
            <span>Karya Per Tahun</span>
          </div>
          <div class="ks-mini" data-reveal style="--d:1">
            <b><em>5</em></b>
            <span>Kompetensi Keahlian</span>
          </div>
          <div class="ks-mini" data-reveal style="--d:2">
            <b><em>3</em></b>
            <span>Kategori Unggulan</span>
          </div>
        </div>

        <div class="ks-cat-line" data-reveal><i class="fas fa-layer-group"></i> Kategori karya yang dikembangkan</div>
        <div class="ks-cat-chips" data-reveal>
          <span class="ks-chip"><i class="fas fa-code"></i> Aplikasi &amp; IT</span>
          <span class="ks-chip"><i class="fas fa-utensils"></i> Kuliner</span>
          <span class="ks-chip"><i class="fas fa-palette"></i> Desain</span>
          <span class="ks-chip"><i class="fas fa-seedling"></i> Produk Olahan</span>
          <span class="ks-chip"><i class="fas fa-chart-line"></i> Bisnis &amp; Keuangan</span>
        </div>
      </div>

      <div data-reveal="right">
        <p class="ks-blurb">Setiap kompetensi keahlian di Skaneda menghasilkan <strong>karya yang nyata dan aplikatif</strong> — dari aplikasi digital, produk kuliner, desain visual, hingga olahan hasil pertanian bernilai tambah. Karya-karya ini lahir dari <strong>praktik langsung, kerja sama industri, dan ajang lomba</strong>, sehingga peserta didik tidak hanya unggul secara teori, tetapi juga <strong>siap berkarya dan siap bekerja</strong> setelah lulus.</p>
        <p class="ks-blurb" style="margin-top:1.2rem">Lewat galeri ini, kami mempersembahkan sebagian kecil dari <strong>kebanggaan Skaneda</strong> — bukti bahwa peserta didik SMK bisa menghasilkan karya yang membanggakan sekolah, keluarga, dan daerah.</p>
      </div>
    </div>
  </section>

  <!-- 2. CAROUSEL / SLIDER GALERI KARYA SISWA -->
  <section class="ks-slider">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
    </div>

    <div class="ks-section">
      <div class="ks-slider-head" data-reveal>
        <h2 class="big-heading">Galeri karya <span>pilihan.</span></h2>
        <p class="ks-slider-note">Geser atau gunakan tombol panah untuk menjelajahi karya — setiap slide memuat foto, judul karya, nama siswa, jurusan, dan tahun.</p>
      </div>

      <div class="ks-carousel" data-reveal>
        <div class="ks-viewport">
          <div class="ks-track" id="ksTrack">
            <div class="ks-slide">
              <img src="{{ asset('images/karya-rpl.jpg') }}" alt="Karya RPL: Aplikasi PPDB Online" loading="eager">
              <span class="ks-slide-tag"><i class="fas fa-code"></i> Aplikasi &amp; IT</span>
              <span class="ks-slide-no">01 / 08</span>
              <div class="ks-slide-cap">
                <h3>Aplikasi PPDB Online Skaneda</h3>
                <p>Platform pendaftaran peserta didik baru berbasis web yang dibangun penuh oleh siswa jurusan RPL — dari desain antarmuka hingga sistem database.</p>
                <div class="ks-slide-meta">
                  <span><i class="fas fa-user"></i> Tim RPL Angkatan 2023</span>
                  <span><i class="fas fa-laptop-code"></i> Rekayasa Perangkat Lunak</span>
                  <span><i class="fas fa-calendar-alt"></i> 2025</span>
                </div>
              </div>
            </div>

            <div class="ks-slide">
              <img src="{{ asset('images/karya-coding.jpg') }}" alt="Karya RPL: Pengembangan Aplikasi di Lab Komputer" loading="lazy">
              <span class="ks-slide-tag"><i class="fas fa-code"></i> Aplikasi &amp; IT</span>
              <span class="ks-slide-no">02 / 08</span>
              <div class="ks-slide-cap">
                <h3>Pengembangan Aplikasi di Lab RPL</h3>
                <p>Proses pengembangan aplikasi mobile &amp; web oleh siswa RPL di laboratorium komputer — kolaborasi tim, coding, dan pengujian produk digital.</p>
                <div class="ks-slide-meta">
                  <span><i class="fas fa-user"></i> Kelas XI RPL</span>
                  <span><i class="fas fa-laptop-code"></i> Rekayasa Perangkat Lunak</span>
                  <span><i class="fas fa-calendar-alt"></i> 2025</span>
                </div>
              </div>
            </div>

            <div class="ks-slide">
              <img src="{{ asset('images/karya-kuliner.jpg') }}" alt="Karya Kuliner: Hidangan Khas Nusantara" loading="lazy">
              <span class="ks-slide-tag"><i class="fas fa-utensils"></i> Kuliner</span>
              <span class="ks-slide-no">03 / 08</span>
              <div class="ks-slide-cap">
                <h3>Hidangan Khas Nusantara</h3>
                <p>Kreasi hidangan utama khas Indonesia dengan teknik modern — hasil praktik tata boga siswa jurusan Kuliner untuk uji kompetensi.</p>
                <div class="ks-slide-meta">
                  <span><i class="fas fa-user"></i> Kelas XII Kuliner</span>
                  <span><i class="fas fa-utensils"></i> Kuliner</span>
                  <span><i class="fas fa-calendar-alt"></i> 2025</span>
                </div>
              </div>
            </div>

            <div class="ks-slide">
              <img src="{{ asset('images/karya-cake.jpg') }}" alt="Karya Kuliner: Pastry &amp; Bakery" loading="lazy">
              <span class="ks-slide-tag"><i class="fas fa-cake-candles"></i> Kuliner</span>
              <span class="ks-slide-no">04 / 08</span>
              <div class="ks-slide-cap">
                <h3>Pastry &amp; Bakery Kreatif</h3>
                <p>Kue dan roti dekoratif dengan teknik pastry modern — karya siswa jurusan Kuliner yang siap bersaing di industri bakery.</p>
                <div class="ks-slide-meta">
                  <span><i class="fas fa-user"></i> Kelas XI Kuliner</span>
                  <span><i class="fas fa-cake-candles"></i> Kuliner</span>
                  <span><i class="fas fa-calendar-alt"></i> 2024</span>
                </div>
              </div>
            </div>

            <div class="ks-slide">
              <img src="{{ asset('images/karya-dkv.jpg') }}" alt="Karya DKV: Desain Visual" loading="lazy">
              <span class="ks-slide-tag"><i class="fas fa-palette"></i> Desain</span>
              <span class="ks-slide-no">05 / 08</span>
              <div class="ks-slide-cap">
                <h3>Desain Visual &amp; Branding</h3>
                <p>Karya desain grafis, ilustrasi, dan branding yang dibuat siswa DKV — dari identitas visual produk hingga materi promosi digital.</p>
                <div class="ks-slide-meta">
                  <span><i class="fas fa-user"></i> Kelas XI DKV</span>
                  <span><i class="fas fa-palette"></i> Desain Komunikasi Visual</span>
                  <span><i class="fas fa-calendar-alt"></i> 2025</span>
                </div>
              </div>
            </div>

            <div class="ks-slide">
              <img src="{{ asset('images/karya-poster.jpg') }}" alt="Karya DKV: Poster Kreatif" loading="lazy">
              <span class="ks-slide-tag"><i class="fas fa-palette"></i> Desain</span>
              <span class="ks-slide-no">06 / 08</span>
              <div class="ks-slide-cap">
                <h3>Poster Kreatif &amp; Media Visual</h3>
                <p>Poster kampanye dan media visual karya siswa DKV — mengombinasikan tipografi, ilustrasi, dan warna untuk pesan yang kuat.</p>
                <div class="ks-slide-meta">
                  <span><i class="fas fa-user"></i> Tim DKV</span>
                  <span><i class="fas fa-palette"></i> Desain Komunikasi Visual</span>
                  <span><i class="fas fa-calendar-alt"></i> 2024</span>
                </div>
              </div>
            </div>

            <div class="ks-slide">
              <img src="{{ asset('images/karya-olahan.jpg') }}" alt="Karya APHP: Produk Olahan Pertanian" loading="lazy">
              <span class="ks-slide-tag"><i class="fas fa-seedling"></i> Produk Olahan</span>
              <span class="ks-slide-no">07 / 08</span>
              <div class="ks-slide-cap">
                <h3>Produk Olahan Hasil Pertanian</h3>
                <p>Inovasi pengolahan hasil pertanian menjadi produk bernilai tambah — roti, samosa, es krim, hingga aneka cemilan wirausaha.</p>
                <div class="ks-slide-meta">
                  <span><i class="fas fa-user"></i> Kelas XII APHP</span>
                  <span><i class="fas fa-seedling"></i> Agribisnis Pengolahan Hasil Pertanian</span>
                  <span><i class="fas fa-calendar-alt"></i> 2025</span>
                </div>
              </div>
            </div>

            <div class="ks-slide">
              <img src="{{ asset('images/karya-bank.jpg') }}" alt="Karya Perbankan Syariah: Layanan &amp; Administrasi" loading="lazy">
              <span class="ks-slide-tag"><i class="fas fa-chart-line"></i> Bisnis &amp; Keuangan</span>
              <span class="ks-slide-no">08 / 08</span>
              <div class="ks-slide-cap">
                <h3>Layanan &amp; Administrasi Perbankan Syariah</h3>
                <p>Simulasi layanan perbankan syariah — administrasi transaksi, kas, dan literasi keuangan yang dipraktikkan langsung oleh siswa.</p>
                <div class="ks-slide-meta">
                  <span><i class="fas fa-user"></i> Kelas XI Perbankan</span>
                  <span><i class="fas fa-chart-line"></i> Layanan Perbankan Syariah</span>
                  <span><i class="fas fa-calendar-alt"></i> 2025</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <button class="ks-arrow ks-prev" id="ksPrev" type="button" aria-label="Karya sebelumnya"><i class="fas fa-chevron-left"></i></button>
        <button class="ks-arrow ks-next" id="ksNext" type="button" aria-label="Karya berikutnya"><i class="fas fa-chevron-right"></i></button>

        <div class="ks-dots" id="ksDots"></div>
        <div class="ks-counter"><span id="ksCur">1</span> / <b id="ksTotal">8</b></div>
      </div>
    </div>
  </section>

  <!-- 3. KATEGORI KARYA -->
  <section class="ks-kategori">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
    </div>

    <div class="ks-section">
      <div class="ks-slider-head" data-reveal>
        <h2 class="big-heading">Lima bidang, <span>ratusan karya.</span></h2>
        <p class="ks-slider-note">Karya siswa tersebar di seluruh kompetensi keahlian — semuanya lahir dari praktik nyata dan kemitraan industri.</p>
      </div>

      <div class="ks-kat-grid">
        <div class="ks-kat-card" data-reveal>
          <div class="ks-kat-icon"><i class="fas fa-code"></i></div>
          <h3 class="ks-kat-name">Aplikasi &amp; IT</h3>
          <p class="ks-kat-text">Aplikasi web, mobile, dan sistem informasi buatan siswa RPL.</p>
        </div>
        <div class="ks-kat-card" data-reveal style="--d:1">
          <div class="ks-kat-icon"><i class="fas fa-utensils"></i></div>
          <h3 class="ks-kat-name">Kuliner</h3>
          <p class="ks-kat-text">Hidangan nusantara, pastry &amp; bakery, dan inovasi menu.</p>
        </div>
        <div class="ks-kat-card" data-reveal style="--d:2">
          <div class="ks-kat-icon"><i class="fas fa-palette"></i></div>
          <h3 class="ks-kat-name">Desain Visual</h3>
          <p class="ks-kat-text">Desain grafis, ilustrasi, branding, dan media promosi.</p>
        </div>
        <div class="ks-kat-card" data-reveal style="--d:3">
          <div class="ks-kat-icon"><i class="fas fa-seedling"></i></div>
          <h3 class="ks-kat-name">Produk Olahan</h3>
          <p class="ks-kat-text">Pengolahan hasil pertanian &amp; perikanan bernilai tambah.</p>
        </div>
        <div class="ks-kat-card" data-reveal style="--d:4">
          <div class="ks-kat-icon"><i class="fas fa-chart-line"></i></div>
          <h3 class="ks-kat-name">Bisnis &amp; Keuangan</h3>
          <p class="ks-kat-text">Layanan perbankan syariah &amp; administrasi keuangan.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. PRODUK KARYA SISWA -->
  <section class="ks-prestasi">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
    </div>

    <div class="ks-section">
      <div class="ks-prestasi-head" data-reveal>
        <h2 class="big-heading">Produk nyata, <span>karya siswa sendiri.</span></h2>
        <p class="ks-prestasi-note">Sebagian produk hasil tangan peserta didik Skaneda — dari aplikasi, kuliner, desain, hingga olahan pertanian dan layanan keuangan syariah.</p>
      </div>

      <div class="ks-prestasi-grid">
        <div class="ks-prestasi-card" data-reveal>
          <div class="ks-prestasi-media">
            <img src="{{ asset('images/karya-coding.jpg') }}" alt="Aplikasi Kasir Digital UMKM Skaneda karya siswa RPL" loading="lazy">
            <div class="ks-prestasi-medal"><i class="fas fa-laptop-code"></i></div>
          </div>
          <div class="ks-prestasi-body">
            <h3>Aplikasi Kasir Digital UMKM</h3>
            <p>Aplikasi kasir berbasis web untuk UMKM binaan sekolah, dibangun penuh oleh siswa jurusan RPL.</p>
            <span class="ks-prestasi-year">RPL &middot; 2025</span>
          </div>
        </div>
        <div class="ks-prestasi-card" data-reveal style="--d:1">
          <div class="ks-prestasi-media">
            <img src="{{ asset('images/karya-cake.jpg') }}" alt="Kue kering kemasan modern karya siswa Kuliner" loading="lazy">
            <div class="ks-prestasi-medal"><i class="fas fa-cookie"></i></div>
          </div>
          <div class="ks-prestasi-body">
            <h3>Kue Kering Kemasan Modern</h3>
            <p>Produk kue kering dengan kemasan siap jual, hasil praktik tata boga siswa jurusan Kuliner.</p>
            <span class="ks-prestasi-year">Kuliner &middot; 2025</span>
          </div>
        </div>
        <div class="ks-prestasi-card" data-reveal style="--d:2">
          <div class="ks-prestasi-media">
            <img src="{{ asset('images/karya-dkv.jpg') }}" alt="Ilustrasi maskot dan identitas visual sekolah karya siswa DKV" loading="lazy">
            <div class="ks-prestasi-medal"><i class="fas fa-palette"></i></div>
          </div>
          <div class="ks-prestasi-body">
            <h3>Maskot &amp; Identitas Visual Sekolah</h3>
            <p>Karakter maskot dan panduan identitas visual sekolah, dirancang siswa jurusan Desain Komunikasi Visual.</p>
            <span class="ks-prestasi-year">DKV &middot; 2024</span>
          </div>
        </div>
        <div class="ks-prestasi-card" data-reveal style="--d:3">
          <div class="ks-prestasi-media">
            <img src="{{ asset('images/karya-olahan.jpg') }}" alt="Keripik buah kemasan vakum karya siswa APHP" loading="lazy">
            <div class="ks-prestasi-medal"><i class="fas fa-seedling"></i></div>
          </div>
          <div class="ks-prestasi-body">
            <h3>Keripik Buah Kemasan Vakum</h3>
            <p>Produk olahan buah lokal jadi keripik siap jual, buah tangan siswa jurusan APHP.</p>
            <span class="ks-prestasi-year">APHP &middot; 2024</span>
          </div>
        </div>
        <div class="ks-prestasi-card" data-reveal style="--d:4">
          <div class="ks-prestasi-media">
            <img src="{{ asset('images/karya-bank.jpg') }}" alt="Simulasi tabungan pelajar syariah karya siswa LPS" loading="lazy">
            <div class="ks-prestasi-medal"><i class="fas fa-landmark"></i></div>
          </div>
          <div class="ks-prestasi-body">
            <h3>Simulasi Tabungan Pelajar Syariah</h3>
            <p>Produk layanan simulasi tabungan &amp; administrasi syariah, dipraktikkan langsung siswa jurusan LPS.</p>
            <span class="ks-prestasi-year">LPS &middot; 2025</span>
          </div>
        </div>
        <div class="ks-prestasi-card" data-reveal style="--d:5">
          <div class="ks-prestasi-media">
            <img src="{{ asset('images/karya-kuliner.jpg') }}" alt="Puding lapis rempah nusantara karya siswa Kuliner" loading="lazy">
            <div class="ks-prestasi-medal"><i class="fas fa-utensils"></i></div>
          </div>
          <div class="ks-prestasi-body">
            <h3>Puding Lapis Rempah Nusantara</h3>
            <p>Kreasi dessert bercita rasa rempah khas Indonesia, hasil inovasi menu siswa jurusan Kuliner.</p>
            <span class="ks-prestasi-year">Kuliner &middot; 2023 &ndash; 2025</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="ks-cta">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>
    <h2>Karya berikutnya bisa jadi <em>karyamu.</em></h2>
    <p>Bergabunglah bersama SMK Negeri 2 Mojokerto dan wujudkan kreativitasmu menjadi karya nyata — didukung guru profesional, fasilitas lengkap, dan kemitraan dunia usaha &amp; industri.</p>
    <a href="{{ route('kontak') }}" class="ks-cta-btn"><i class="fas fa-paper-plane"></i> Hubungi Sekolah</a>
    <div class="ks-cta-note"><i class="fas fa-info-circle"></i> Informasi resmi: smkn2mojokerto.sch.id · #DisiplinBerprestasi</div>
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

  /* ---- CAROUSEL / SLIDER KARYA SISWA ---- */
  (function () {
    var track = document.getElementById('ksTrack');
    var slides = track.children;
    var total = slides.length;
    var cur = 0;
    var dotsWrap = document.getElementById('ksDots');
    var curLabel = document.getElementById('ksCur');
    var totalLabel = document.getElementById('ksTotal');
    var autoTimer = null;

    totalLabel.textContent = total;

    /* build dots */
    for (var i = 0; i < total; i++) {
      var d = document.createElement('button');
      d.className = 'ks-dot' + (i === 0 ? ' active' : '');
      d.type = 'button';
      d.setAttribute('aria-label', 'Karya ke-' + (i + 1));
      d.addEventListener('click', (function (idx) { return function () { go(idx); }; })(i));
      dotsWrap.appendChild(d);
    }
    var dots = dotsWrap.children;

    function go(idx) {
      cur = (idx + total) % total;
      track.style.transform = 'translateX(-' + (cur * 100) + '%)';
      for (var i = 0; i < total; i++) {
        dots[i].className = 'ks-dot' + (i === cur ? ' active' : '');
      }
      curLabel.textContent = cur + 1;
    }

    document.getElementById('ksPrev').addEventListener('click', function () { go(cur - 1); restart(); });
    document.getElementById('ksNext').addEventListener('click', function () { go(cur + 1); restart(); });

    function restart() {
      if (autoTimer) clearInterval(autoTimer);
      autoTimer = setInterval(function () { go(cur + 1); }, 6000);
    }
    restart();

    /* swipe untuk layar sentuh */
    var startX = null;
    var vp = track.parentElement;
    vp.addEventListener('touchstart', function (e) { startX = e.touches[0].clientX; }, { passive: true });
    vp.addEventListener('touchend', function (e) {
      if (startX === null) return;
      var dx = e.changedTouches[0].clientX - startX;
      if (Math.abs(dx) > 48) { go(cur + (dx < 0 ? 1 : -1)); restart(); }
      startX = null;
    }, { passive: true });

    /* gambar slider di-eager kan agar tidak placeholder saat autoplay */
    slides[0].querySelector('img').loading = 'eager';
  })();
</script>
@endpush