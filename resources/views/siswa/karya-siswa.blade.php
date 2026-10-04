@extends('layouts.app')

@section('title', 'Karya Siswa — SMK Negeri 2 Mojokerto')
@section('description', 'Galeri karya siswa SMK Negeri 2 Mojokerto — hasil karya kompetensi keahlian RPL, Kuliner, APHP, DKV, dan Layanan Perbankan Syariah.')

@push('styles')
<style>
/* =========================================================
   KARYA SISWA — GALERI KARYA PESERTA DIDIK
   Warna: navy #0d3a66, biru #2f6fa8, putih, gold #ffd54a/#ffb300.
   Isi halaman dikelola dari admin Karya Siswa (App\Support\KaryaContent).
   ========================================================= */
.ks-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}
.ks-page *{box-sizing:border-box}

/* ---------- HERO ---------- */
.ks-hero{position:relative;min-height:clamp(620px,78vh,790px);display:flex;align-items:center;overflow:hidden;
  background:#fff;color:#0d3a66;isolation:isolate}
.ks-hero::before{display:none}
.ks-hero::after{content:"KARYA";position:absolute;z-index:0;left:2%;top:58%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(11rem,26vw,28rem);font-weight:900;line-height:.78;
  letter-spacing:.015em;color:rgba(13,58,102,.035);-webkit-text-stroke:1px rgba(255,122,0,.09);
  pointer-events:none;white-space:nowrap;user-select:none}
.ks-ref-ornaments{position:absolute!important;inset:0;z-index:1;overflow:hidden;pointer-events:none;opacity:1}
.ks-ref-ornament-image{position:absolute!important;inset:0;width:100%;height:100%;display:block;
  object-fit:cover;object-position:center center;max-width:none;opacity:1}
.ks-hero-inner{position:relative;z-index:4;width:100%;max-width:1500px;margin:0 auto;
  padding:clamp(4rem,10vh,7rem) clamp(1.25rem,4.2vw,4.5rem) clamp(4rem,9vh,6rem);display:block}

.ks-kicker{position:relative;z-index:5;display:inline-flex;align-items:center;gap:.65rem;font-size:.85rem;
  font-weight:900;letter-spacing:.18em;text-transform:uppercase;color:#ff6f00;margin-bottom:1.2rem;
  padding:.6rem 1.05rem;border:1px solid rgba(255,111,0,.18);border-radius:999px;background:#fffaf5}
.ks-kicker::before{content:"";width:9px;height:9px;border-radius:50%;background:#ff6f00;
  box-shadow:0 0 0 6px rgba(255,111,0,.10)}

/* ---------- TITLE: bertumpuk besar, senada PPDB ---------- */
.ks-title{position:relative;z-index:5;font-family:var(--font-display);font-size:clamp(5.5rem,13vw,11.5rem);
  line-height:.84;letter-spacing:-.035em;margin:0;max-width:900px;text-transform:uppercase;
  text-shadow:none;animation:hdFadeUp .7s .1s var(--ease, ease) both}
.ks-title .ks-white{color:#0d3a66;display:block}
.ks-title .ks-gold{display:block;
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent;
  text-shadow:none;letter-spacing:-.025em}

@media(min-width:1050px){.ks-hero-inner{padding-right:44%}}
@media(max-width:1050px){.ks-hero-inner{padding-right:1.25rem}.ks-ref-ornaments{opacity:.72}}
@media(max-width:900px){.ks-title{font-size:clamp(4.2rem,12vw,8.5rem)}.ks-ref-ornament-image{opacity:.88}}
@media(max-width:560px){.ks-ref-ornament-image{opacity:.62}}

/* ---------- HOME-ORN (ornamen geometris) ---------- */
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

.ks-intro>*:not(.home-orn),
.ks-slider>*:not(.home-orn),
.ks-kategori>*:not(.home-orn),
.ks-prestasi>*:not(.home-orn),
.ks-cta>*:not(.home-orn){position:relative;z-index:2}

/* ---------- SECTION SHELL & HEADING ---------- */
.ks-section{width:min(1180px,92%);margin:0 auto}
.ks-intro{position:relative;padding:96px 0 110px;background:#fff}
.ks-intro-grid{display:grid;grid-template-columns:.95fr 1.05fr;gap:4.5rem;align-items:center}
.ks-intro-grid.is-single{grid-template-columns:1fr}

.big-heading{font-family:var(--font-display);font-size:clamp(2.2rem,4.6vw,3.6rem);font-weight:800;
  line-height:1.16;letter-spacing:.01em;margin:0;color:#0d3a66;text-transform:uppercase}
.big-heading span{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 60%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.ks-intro-note{max-width:420px;color:#718396;font-size:.84rem;line-height:1.8;margin-top:1rem}

/* ---------- 1. PENGANTAR ---------- */
.ks-blurb{font-size:.92rem;line-height:1.9;color:#718396;margin:0}
.ks-blurb+.ks-blurb{margin-top:1.2rem}
.ks-blurb strong{color:#0d3a66}
.ks-mini-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-top:2rem}
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

/* ---------- 2. CAROUSEL ---------- */
.ks-slider{position:relative;padding:96px 0 110px;
  background-image:radial-gradient(rgba(13,58,102,.055) 1.4px,transparent 1.5px);background-size:22px 22px}
.ks-slider-head{display:flex;justify-content:space-between;align-items:end;gap:2rem;flex-wrap:wrap}
.ks-slider-note{max-width:360px;color:#718396;font-size:.8rem;line-height:1.7}

.ks-carousel{position:relative;margin-top:3.2rem;max-width:1000px;margin-left:auto;margin-right:auto}
.ks-viewport{position:relative;overflow:hidden;border-radius:26px;touch-action:pan-y;
  box-shadow:0 34px 80px rgba(13,58,102,.22);border:1px solid rgba(255,255,255,.25)}
.ks-viewport:focus-visible{outline:3px solid #ffb300;outline-offset:4px}
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
.ks-arrow:focus-visible,.ks-dot:focus-visible{outline:3px solid #0d3a66;outline-offset:3px}
.ks-arrow.ks-prev{left:-27px}
.ks-arrow.ks-next{right:-27px}
.ks-carousel.is-single .ks-arrow,.ks-carousel.is-single .ks-dots,.ks-carousel.is-single .ks-counter{display:none}

.ks-dots{display:flex;justify-content:center;flex-wrap:wrap;gap:.55rem;margin-top:1.6rem}
.ks-dot{width:10px;height:10px;border-radius:99px;border:none;cursor:pointer;padding:0;
  background:rgba(13,58,102,.22);transition:all .35s var(--ease, ease)}
.ks-dot.active{width:34px;background:linear-gradient(90deg,#ffd54a,#ffb300)}

.ks-counter{display:flex;justify-content:center;gap:.5rem;margin-top:1.1rem;
  font-family:var(--font-display);font-size:.82rem;font-weight:800;color:#718396;letter-spacing:.1em}
.ks-counter b{color:#0d3a66}

/* ---------- 3. BIDANG / KATEGORI ---------- */
.ks-kategori{position:relative;padding:96px 0 110px;background:#fff}
.ks-kat-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.2rem;margin-top:3rem}
.ks-kat-card{position:relative;background:#fff;border:1px solid #e3edf0;border-radius:22px;padding:1.7rem 1.3rem 1.5rem;
  text-align:center;transition:transform .35s var(--ease, ease),box-shadow .35s var(--ease, ease),border-color .35s var(--ease, ease)}
.ks-kat-card:hover{transform:translateY(-8px);box-shadow:0 26px 55px rgba(13,58,102,.14);border-color:rgba(13,58,102,.22)}
.ks-kat-icon{width:60px;height:60px;margin:0 auto;border-radius:18px;display:flex;align-items:center;justify-content:center;
  font-size:1.4rem;color:#fff;background:linear-gradient(135deg,#0d3a66,#2f6fa8);
  transition:transform .35s var(--ease, ease)}
.ks-kat-card:nth-child(5n+2) .ks-kat-icon{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52}
.ks-kat-card:nth-child(5n+3) .ks-kat-icon{background:linear-gradient(135deg,#2f6fa8,#0d3a66)}
.ks-kat-card:nth-child(5n+4) .ks-kat-icon{background:linear-gradient(135deg,#5a89b8,#2f6fa8)}
.ks-kat-card:nth-child(5n+5) .ks-kat-icon{background:linear-gradient(135deg,#ffb300,#ff8a00);color:#0a2d52}
.ks-kat-card:hover .ks-kat-icon{transform:rotate(-8deg) scale(1.06)}
.ks-kat-name{font-family:var(--font-display);font-size:1rem;font-weight:800;color:#0d3a66;margin:.95rem 0 .3rem}
.ks-kat-text{font-size:.76rem;line-height:1.65;color:#718396;margin:0}

/* ---------- 4. PRODUK KARYA ---------- */
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
.ks-prestasi-card:nth-child(6n+2) .ks-prestasi-medal{background:linear-gradient(135deg,#9db2c8,#5a89b8)}
.ks-prestasi-card:nth-child(6n+3) .ks-prestasi-medal{background:linear-gradient(135deg,#d99a5b,#b06f2c)}
.ks-prestasi-card:nth-child(6n+4) .ks-prestasi-medal{background:linear-gradient(135deg,#2f6fa8,#0d3a66)}
.ks-prestasi-card:nth-child(6n+5) .ks-prestasi-medal{background:linear-gradient(135deg,#ffb300,#ff8a00);color:#0a2d52}
.ks-prestasi-card:nth-child(6n+6) .ks-prestasi-medal{background:linear-gradient(135deg,#0d3a66,#5a89b8)}
.ks-prestasi-body{min-width:0}
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
  .ks-intro-grid{grid-template-columns:1fr;gap:3rem}
}
@media(max-width:768px){
  .ks-hero{min-height:0;align-items:flex-start}
  .ks-hero-inner{padding:clamp(3rem,8vh,4.5rem) 5% 3.6rem;width:100%}
  .ks-hero::after{display:none!important}
  .ks-title{font-size:clamp(3.6rem,13vw,6.2rem);margin-top:0}
  .ks-intro,.ks-slider,.ks-kategori,.ks-prestasi{padding:48px 0 54px}
  .ks-intro-grid{gap:2rem}
  .ks-cta{padding:42px 1.2rem 48px;margin-bottom:3.5rem;width:100%;border-radius:20px}
  .ks-kat-grid{grid-template-columns:1fr 1fr;gap:.8rem}
  .ks-kat-grid .ks-kat-card:last-child:nth-child(odd){grid-column:1/-1}
  .ks-mini-stats{grid-template-columns:1fr;gap:.8rem}
  .ks-arrow{width:40px;height:40px;font-size:.85rem}
  .ks-arrow.ks-prev{left:6px}
  .ks-arrow.ks-next{right:6px}
  .ks-slide{height:clamp(320px,95vw,420px)}
  .ks-slide-cap{padding:0 1rem 1.2rem}
  .ks-slide-cap h3{font-size:1.35rem}
  .ks-slide-meta span{font-size:.72rem;padding:.35rem .7rem}
  .home-orn,.ks-prestasi::before{display:none!important}
  [data-reveal]{opacity:1!important;transform:none!important}
}
@media(prefers-reduced-motion:reduce){
  .ks-track,.ks-prestasi-media img,.ks-kat-icon,.ks-mini,.ks-kat-card,.ks-prestasi-card{transition:none!important}
  [data-reveal]{opacity:1!important;transform:none!important;transition:none!important}
}
</style>

<style id="karya-dark-mode">
/* =========================================================
   KARYA SISWA — DARK MODE
   Aktif saat <body> punya class "theme-dark".
   ========================================================= */
html body.theme-dark .ks-page{background:#08131f!important;color:#e6eef7;color-scheme:dark}

/* ---------- Container tidak boleh punya kotak background sendiri ---------- */
html body.theme-dark .ks-page .ks-section,
html body.theme-dark .ks-page .ks-intro-grid,
html body.theme-dark .ks-page .ks-slider-head,
html body.theme-dark .ks-page .ks-prestasi-head,
html body.theme-dark .ks-page .ks-carousel,
html body.theme-dark .ks-page .ks-kat-grid,
html body.theme-dark .ks-page .ks-prestasi-grid,
html body.theme-dark .ks-page .ks-mini-stats,
html body.theme-dark .ks-page .ks-cat-chips,
html body.theme-dark .ks-page .ks-hero-inner{
  background:transparent!important;
  background-image:none!important;
  box-shadow:none!important;
  border:0!important;
  backdrop-filter:none!important;
  -webkit-backdrop-filter:none!important;
}

/* ---------- UMUM ---------- */
html body.theme-dark .ks-page .big-heading{color:#fff}
html body.theme-dark .ks-page .home-orn .ho-chevron{border-color:rgba(143,189,235,.16)}
html body.theme-dark .ks-page .home-orn .ho-chevron::after{border-color:rgba(143,189,235,.12)}
html body.theme-dark .ks-page .home-orn .ho-line{background:rgba(143,189,235,.14)}
html body.theme-dark .ks-page .home-orn .ho-line::after{background:rgba(143,189,235,.12)}
html body.theme-dark .ks-page .home-orn .ho-dots{background-image:radial-gradient(rgba(143,189,235,.5) 1.6px,transparent 1.7px);opacity:.3}
html body.theme-dark .ks-page .home-orn .ho-ring{border-color:rgba(143,189,235,.16)}
html body.theme-dark .ks-page .home-orn .ho-ring::before{border-color:rgba(143,189,235,.18)}
html body.theme-dark .ks-page .home-orn .ho-square::before{border-color:rgba(143,189,235,.22)}
html body.theme-dark .ks-page .home-orn .ho-corner::after{background:rgba(143,189,235,.2)}

/* ---------- HERO ---------- */
html body.theme-dark .ks-page .ks-hero{background:linear-gradient(180deg,#0b1d31 0%,#08131f 100%)!important;color:#e6eef7}
html body.theme-dark .ks-page .ks-hero::after{color:rgba(255,255,255,.035)!important;-webkit-text-stroke:1px rgba(255,179,0,.14)!important}
html body.theme-dark .ks-page .ks-ref-ornaments{
  background-image:none!important;
  mix-blend-mode:screen;
  opacity:.6;
}
html body.theme-dark .ks-page .ks-ref-ornament-image{
  filter:invert(1) hue-rotate(180deg);
  mix-blend-mode:normal;
  opacity:1;
}
html body.theme-dark .ks-page .ks-title .ks-white{color:#fff}
html body.theme-dark .ks-page .ks-kicker{background:rgba(255,111,0,.1);border-color:rgba(255,179,0,.3);color:#ffb347}

/* ---------- 1. PENGANTAR ---------- */
html body.theme-dark .ks-page .ks-intro{background:#0a1928}
html body.theme-dark .ks-page .ks-intro-note{color:#9fb2c6}
html body.theme-dark .ks-page .ks-blurb{color:#a9bbcd}
html body.theme-dark .ks-page .ks-blurb strong{color:#fff}
html body.theme-dark .ks-page .ks-mini{background:rgba(255,255,255,.05);border-color:rgba(255,255,255,.1)}
html body.theme-dark .ks-page .ks-mini:hover{box-shadow:0 16px 36px rgba(0,0,0,.45)}
html body.theme-dark .ks-page .ks-mini b{color:#fff}
html body.theme-dark .ks-page .ks-mini span{color:#9fb2c6}
html body.theme-dark .ks-page .ks-cat-line{color:#8fbdeb}
html body.theme-dark .ks-page .ks-chip{background:rgba(255,255,255,.06);border-color:rgba(255,255,255,.14);color:#e6eef7}
html body.theme-dark .ks-page .ks-chip:hover{border-color:rgba(255,213,74,.5)}

/* ---------- 2. CAROUSEL ---------- */
html body.theme-dark .ks-page .ks-slider,
html body.theme-dark .ks-page .ks-prestasi{background-color:#08131f;background-image:radial-gradient(rgba(143,189,235,.07) 1.4px,transparent 1.5px)}
html body.theme-dark .ks-page .ks-slider-note{color:#9fb2c6}
html body.theme-dark .ks-page .ks-viewport{box-shadow:0 34px 80px rgba(0,0,0,.6);border-color:rgba(255,255,255,.12)}
html body.theme-dark .ks-page .ks-dot{background:rgba(255,255,255,.22)}
html body.theme-dark .ks-page .ks-dot.active{background:linear-gradient(90deg,#ffd54a,#ffb300)}
html body.theme-dark .ks-page .ks-arrow:focus-visible,html body.theme-dark .ks-page .ks-dot:focus-visible{outline-color:#ffd54a}
html body.theme-dark .ks-page .ks-counter{color:#8fa3b8}
html body.theme-dark .ks-page .ks-counter b{color:#fff}

/* ---------- 3. BIDANG ---------- */
html body.theme-dark .ks-page .ks-kategori{background:#0a1928}
html body.theme-dark .ks-page .ks-kat-card{background:#0f2236;border-color:rgba(255,255,255,.1)}
html body.theme-dark .ks-page .ks-kat-card:hover{border-color:rgba(255,213,74,.35);box-shadow:0 26px 55px rgba(0,0,0,.55)}
html body.theme-dark .ks-page .ks-kat-name{color:#fff}
html body.theme-dark .ks-page .ks-kat-text{color:#9fb2c6}

/* ---------- 4. PRODUK KARYA ---------- */
html body.theme-dark .ks-page .ks-prestasi::before{color:rgba(255,255,255,.04)}
html body.theme-dark .ks-page .ks-prestasi-note{color:#9fb2c6}
html body.theme-dark .ks-page .ks-prestasi-card{background:#0f2236;border-color:rgba(255,255,255,.1)}
html body.theme-dark .ks-page .ks-prestasi-card:hover{box-shadow:0 22px 48px rgba(0,0,0,.55)}
html body.theme-dark .ks-page .ks-prestasi-medal{border-color:#0f2236}
html body.theme-dark .ks-page .ks-prestasi-body h3{color:#fff}
html body.theme-dark .ks-page .ks-prestasi-body p{color:#9fb2c6}
html body.theme-dark .ks-page .ks-prestasi-year{color:#ffd54a;background:rgba(255,213,74,.12);border-color:rgba(255,213,74,.35)}

/* ---------- CTA ---------- */
html body.theme-dark .ks-page .ks-cta{background:linear-gradient(135deg,#0a1a2c 0%,#0c2038 55%,#0e2542 100%);border:1px solid rgba(255,255,255,.08);box-shadow:0 34px 80px rgba(0,0,0,.6)}
</style>
@endpush

@section('content')
@php
  $k = \App\Support\KaryaContent::get();
  $s = $k['s'];
  $slides = $k['slides'];
  $products = $k['products'];
  $cats = $k['categories'];
  $fallback = $k['fallback'];
  $has = fn ($key) => trim($s[$key]) !== '';
  $stats = collect([1, 2, 3])->filter(fn ($n) => $has("stat_{$n}_num"));
  $hasRight = $has('blurb_1') || $has('blurb_2');
  $orn = '<div class="home-orn" aria-hidden="true"><span class="ho-chevron"></span><span class="ho-line"></span><span class="ho-dots"></span><span class="ho-ring"></span><span class="ho-gold"></span><span class="ho-square"></span></div>';
@endphp

<div class="ks-page" id="ksPage">

  <!-- HERO -->
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
        @if($has('hero_kicker'))<div class="ks-kicker">{{ $s['hero_kicker'] }}</div>@endif
        <h1 class="ks-title">
          <span class="ks-white">{{ $s['hero_title_1'] }}</span>
          <span class="ks-gold">{{ $s['hero_title_2'] }}</span>
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

    <div class="ks-section ks-intro-grid {{ $hasRight ? '' : 'is-single' }}">
      <div data-reveal="left">
        <h2 class="big-heading">{{ $s['intro_title'] }}@if($has('intro_title_em')) <span>{{ $s['intro_title_em'] }}</span>@endif</h2>
        @if($has('intro_note'))<p class="ks-intro-note">{{ $s['intro_note'] }}</p>@endif

        @if($stats->isNotEmpty())
          <div class="ks-mini-stats">
            @foreach($stats as $n)
              <div class="ks-mini" data-reveal style="--d:{{ $loop->index }}">
                <b><em>{{ $s["stat_{$n}_num"] }}</em></b>
                @if($has("stat_{$n}_label"))<span>{{ $s["stat_{$n}_label"] }}</span>@endif
              </div>
            @endforeach
          </div>
        @endif

        @if($cats->isNotEmpty())
          @if($has('cat_line'))<div class="ks-cat-line" data-reveal><i class="fas fa-layer-group"></i> {{ $s['cat_line'] }}</div>@endif
          <div class="ks-cat-chips" data-reveal>
            @foreach($cats as $c)
              <span class="ks-chip"><i class="fas {{ $c->icon }}"></i> {{ $c->label }}</span>
            @endforeach
          </div>
        @endif
      </div>

      @if($hasRight)
        <div data-reveal="right">
          @if($has('blurb_1'))<p class="ks-blurb">{{ \App\Support\KaryaContent::rich($s['blurb_1']) }}</p>@endif
          @if($has('blurb_2'))<p class="ks-blurb">{{ \App\Support\KaryaContent::rich($s['blurb_2']) }}</p>@endif
        </div>
      @endif
    </div>
  </section>

  <!-- 2. CAROUSEL / SLIDER GALERI KARYA SISWA -->
  @if($slides->isNotEmpty())
  <section class="ks-slider">
    {!! $orn !!}

    <div class="ks-section">
      <div class="ks-slider-head" data-reveal>
        <h2 class="big-heading">{{ $s['slider_title'] }}@if($has('slider_title_em')) <span>{{ $s['slider_title_em'] }}</span>@endif</h2>
        @if($has('slider_note'))<p class="ks-slider-note">{{ $s['slider_note'] }}</p>@endif
      </div>

      <div class="ks-carousel {{ $slides->count() < 2 ? 'is-single' : '' }}" data-reveal>
        <div class="ks-viewport" id="ksViewport" tabindex="0" role="region" aria-roledescription="carousel" aria-label="Galeri karya siswa pilihan">
          <div class="ks-track" id="ksTrack">
            @foreach($slides as $w)
              <div class="ks-slide" role="group" aria-roledescription="slide" aria-label="Karya {{ $loop->iteration }} dari {{ $slides->count() }}">
                <img src="{{ $w->cover }}" alt="Karya: {{ $w->title }}" loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                     onerror="this.onerror=null;this.src='{{ $fallback }}'">
                <span class="ks-slide-tag"><i class="fas {{ $w->tag_icon }}"></i> {{ $w->tag_label }}</span>
                <span class="ks-slide-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} / {{ str_pad($slides->count(), 2, '0', STR_PAD_LEFT) }}</span>
                <div class="ks-slide-cap">
                  <h3>{{ $w->title }}</h3>
                  @if($w->desc !== '')<p>{{ $w->desc }}</p>@endif
                  @if($w->student !== '' || $w->major !== '' || $w->year !== '')
                    <div class="ks-slide-meta">
                      @if($w->student !== '')<span><i class="fas fa-user"></i> {{ $w->student }}</span>@endif
                      @if($w->major !== '')<span><i class="fas {{ $w->major_icon }}"></i> {{ $w->major }}</span>@endif
                      @if($w->year !== '')<span><i class="fas fa-calendar-alt"></i> {{ $w->year }}</span>@endif
                    </div>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <button class="ks-arrow ks-prev" id="ksPrev" type="button" aria-label="Karya sebelumnya"><i class="fas fa-chevron-left"></i></button>
        <button class="ks-arrow ks-next" id="ksNext" type="button" aria-label="Karya berikutnya"><i class="fas fa-chevron-right"></i></button>

        <div class="ks-dots" id="ksDots"></div>
        <div class="ks-counter" aria-live="polite"><span id="ksCur">1</span> / <b id="ksTotal">{{ $slides->count() }}</b></div>
      </div>
    </div>
  </section>
  @endif

  <!-- 3. BIDANG / KATEGORI KARYA -->
  @if($cats->isNotEmpty())
  <section class="ks-kategori">
    {!! $orn !!}

    <div class="ks-section">
      <div class="ks-slider-head" data-reveal>
        <h2 class="big-heading">{{ $s['kat_title'] }}@if($has('kat_title_em')) <span>{{ $s['kat_title_em'] }}</span>@endif</h2>
        @if($has('kat_note'))<p class="ks-slider-note">{{ $s['kat_note'] }}</p>@endif
      </div>

      <div class="ks-kat-grid">
        @foreach($cats as $c)
          <div class="ks-kat-card" data-reveal style="--d:{{ $loop->index % 6 }}">
            <div class="ks-kat-icon"><i class="fas {{ $c->icon }}"></i></div>
            <h3 class="ks-kat-name">{{ $c->label }}</h3>
            @if(trim((string) $c->description) !== '')<p class="ks-kat-text">{{ $c->description }}</p>@endif
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- 4. PRODUK KARYA SISWA -->
  @if($products->isNotEmpty())
  <section class="ks-prestasi">
    {!! $orn !!}

    <div class="ks-section">
      <div class="ks-prestasi-head" data-reveal>
        <h2 class="big-heading">{{ $s['prod_title'] }}@if($has('prod_title_em')) <span>{{ $s['prod_title_em'] }}</span>@endif</h2>
        @if($has('prod_note'))<p class="ks-prestasi-note">{{ $s['prod_note'] }}</p>@endif
      </div>

      <div class="ks-prestasi-grid">
        @foreach($products as $w)
          <div class="ks-prestasi-card" data-reveal style="--d:{{ $loop->index % 6 }}">
            <div class="ks-prestasi-media">
              <img src="{{ $w->cover }}" alt="{{ $w->title }}" loading="lazy" onerror="this.onerror=null;this.src='{{ $fallback }}'">
              <div class="ks-prestasi-medal"><i class="fas {{ $w->tag_icon }}"></i></div>
            </div>
            <div class="ks-prestasi-body">
              <h3>{{ $w->title }}</h3>
              @if($w->desc !== '')<p>{{ $w->desc }}</p>@endif
              @if($w->pill !== '')<span class="ks-prestasi-year">{{ $w->pill }}</span>@endif
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

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
    <h2>{{ $s['cta_title'] }}@if($has('cta_title_em')) <em>{{ $s['cta_title_em'] }}</em>@endif</h2>
    @if($has('cta_text'))<p>{{ $s['cta_text'] }}</p>@endif
    <a href="{{ $k['ctaUrl'] }}" class="ks-cta-btn"><i class="fas fa-paper-plane"></i> {{ $s['cta_btn_text'] }}</a>
    @if($has('cta_note'))<div class="ks-cta-note"><i class="fas fa-info-circle"></i> {{ $s['cta_note'] }}</div>@endif
  </section>

</div>
@endsection

@push('scripts')
<script>
(function () {
  'use strict';

  /* ---------- SCROLL REVEAL ---------- */
  var revealEls = document.querySelectorAll('[data-reveal]');
  if ('IntersectionObserver' in window) {
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add('revealed'); obs.unobserve(e.target); }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
    revealEls.forEach(function (el) { obs.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('revealed'); });
  }

  /* ---------- CAROUSEL KARYA SISWA ---------- */
  var track = document.getElementById('ksTrack');
  if (!track || !track.children.length) return;

  var slides = track.children;
  var total = slides.length;
  var cur = 0;
  var viewport = document.getElementById('ksViewport');
  var dotsWrap = document.getElementById('ksDots');
  var curLabel = document.getElementById('ksCur');
  var autoTimer = null;
  var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var dots = [];
  for (var i = 0; i < total; i++) {
    var d = document.createElement('button');
    d.className = 'ks-dot' + (i === 0 ? ' active' : '');
    d.type = 'button';
    d.setAttribute('aria-label', 'Karya ke-' + (i + 1));
    d.addEventListener('click', (function (idx) { return function () { go(idx); restart(); }; })(i));
    dotsWrap.appendChild(d);
    dots.push(d);
  }

  function go(idx) {
    cur = (idx + total) % total;
    track.style.transform = 'translateX(-' + (cur * 100) + '%)';
    for (var i = 0; i < total; i++) {
      dots[i].classList.toggle('active', i === cur);
      slides[i].setAttribute('aria-hidden', i === cur ? 'false' : 'true');
    }
    curLabel.textContent = cur + 1;
  }

  function stop() { if (autoTimer) { clearInterval(autoTimer); autoTimer = null; } }
  function restart() {
    stop();
    if (total < 2 || reduceMotion || document.hidden) return;
    autoTimer = setInterval(function () { go(cur + 1); }, 6000);
  }

  document.getElementById('ksPrev').addEventListener('click', function () { go(cur - 1); restart(); });
  document.getElementById('ksNext').addEventListener('click', function () { go(cur + 1); restart(); });

  /* jeda saat kursor di atas slider / fokus keyboard / tab tidak aktif */
  var box = viewport.parentNode;
  box.addEventListener('mouseenter', stop);
  box.addEventListener('mouseleave', restart);
  box.addEventListener('focusin', stop);
  box.addEventListener('focusout', restart);
  document.addEventListener('visibilitychange', function () { document.hidden ? stop() : restart(); });

  /* panah keyboard saat slider difokuskan */
  viewport.addEventListener('keydown', function (e) {
    if (e.key === 'ArrowLeft') { e.preventDefault(); go(cur - 1); }
    if (e.key === 'ArrowRight') { e.preventDefault(); go(cur + 1); }
  });

  /* geser jari kiri/kanan di HP */
  var startX = null;
  viewport.addEventListener('touchstart', function (e) { startX = e.touches[0].clientX; stop(); }, { passive: true });
  viewport.addEventListener('touchend', function (e) {
    if (startX !== null) {
      var dx = e.changedTouches[0].clientX - startX;
      if (Math.abs(dx) > 48) go(cur + (dx < 0 ? 1 : -1));
      startX = null;
    }
    restart();
  }, { passive: true });

  go(0);
  restart();
})();
</script>
@endpush