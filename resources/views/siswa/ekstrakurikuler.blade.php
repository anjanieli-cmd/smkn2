@extends('layouts.app')

@section('title', 'Ekstrakurikuler — SMK Negeri 2 Mojokerto')
@section('description', 'Ekstrakurikuler SMK Negeri 2 Mojokerto — Pramuka, Paskibra, Pencak Silat, Futsal, Basket, Voli, PMR, Rohis, Seni Tari, Musik, English Club, dan KIR. Temukan bakatmu di Skaneda.')

@push('styles')
<style>
/* =========================================================
   EKSTRAKURIKULER — SKANEDA ACTIVITY FEED
   Halaman baru. Hero, header (layouts.app) & footer TIDAK
   diubah — identik dengan halaman referensi lain.
   Visual language: navy #0d3a66, biru #2f6fa8, gold
   #ffd54a/#ffb300, Sora display, editorial premium, ornamen
   geometris subtle. Fitur utama: galeri gaya Instagram feed
   (grid 1:1) + carousel swipe + flip card profil ekstra.
   ========================================================= */
.ek-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}
.ek-page *{box-sizing:border-box}

/* ---------- HERO: foto gedung + overlay + watermark (IDENTIK referensi — TIDAK DIUBAH) ---------- */
.ek-hero{position:relative;min-height:88vh;display:flex;align-items:flex-start;overflow:hidden;
  background-image:url('{{ asset('images/hero-sekolah.jpg') }}');
  background-size:cover;background-position:center;background-repeat:no-repeat;color:#fff}
.ek-hero::before{content:"";position:absolute;inset:0;z-index:1;
  background:linear-gradient(100deg,rgba(7,22,42,.90) 0%,rgba(9,30,54,.68) 45%,rgba(9,30,54,.32) 78%,rgba(9,30,54,.12) 100%)}
/* Watermark typography besar transparan */
.ek-hero::after{content:"EKSTRAKURIKULER";position:absolute;z-index:2;right:-2%;top:50%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(3.1rem,9.4vw,9.4rem);font-weight:900;line-height:.82;
  letter-spacing:.02em;color:rgba(255,255,255,.055);-webkit-text-stroke:1px rgba(255,255,255,.07);
  text-shadow:0 0 90px rgba(13,58,102,.16);pointer-events:none;white-space:nowrap;user-select:none}
.ek-hero-inner{position:relative;z-index:3;width:100%;max-width:none;margin:0 auto;
  padding:clamp(3.5rem,9vh,5.5rem) clamp(1.5rem,5vw,5.5rem);
  display:grid;grid-template-columns:minmax(0,1.05fr) minmax(340px,.95fr);gap:4rem;align-items:center}

.ek-kicker{display:inline-flex;align-items:center;gap:.65rem;font-size:.74rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#ffd54a;margin-bottom:0.6rem}
.ek-kicker::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ffb300)}

/* ---------- TITLE: EKSTRAKURIKULER putih, SKANEDA kuning-oranye ---------- */
.ek-title{font-family:var(--font-display);font-size:clamp(2.6rem,5.9vw,5.6rem);line-height:.98;
  letter-spacing:.01em;margin:0;max-width:820px;text-transform:uppercase;
  text-shadow:0 2px 24px rgba(4,14,28,.35);animation:hdFadeUp .7s .1s var(--ease, ease) both}
.ek-title .ek-white{color:#ffffff;display:inline-block}
.ek-title .ek-gold{display:inline-block;
  background:linear-gradient(135deg,#ffe66d 0%,#ffc107 45%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ffc107;
  text-shadow:0 4px 24px rgba(255,174,0,.18);letter-spacing:.025em}
.ek-lead{font-size:1.02rem;line-height:1.85;color:rgba(235,245,253,.86);max-width:640px;
  margin:1.3rem 0 0;animation:hdFadeUp .7s .26s var(--ease, ease) both}
.ek-hero-meta{display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;animation:hdFadeUp .7s .4s var(--ease, ease) both}
.ek-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;
  border:1px solid rgba(255,255,255,.2);background:rgba(13,58,102,.30);border-radius:999px;
  font-size:.72rem;font-weight:800;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)}
.ek-pill i{color:#ffd54a}

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
.ek-hero .home-orn .ho-chevron{left:-150px;bottom:-60px;border-color:rgba(255,255,255,.10)}
.ek-hero .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.ek-hero .home-orn .ho-line{right:-80px;top:22%;opacity:.22}
.ek-hero .home-orn .ho-dots{right:6%;bottom:14%;opacity:.3}
.ek-hero .home-orn .ho-ring{left:44%;bottom:-90px;border-color:rgba(255,255,255,.12)}
.ek-hero .home-orn .ho-gold{right:16%;top:20%}
.ek-hero .home-orn .ho-square{left:12%;top:22%}
.ek-intro .home-orn .ho-chevron{right:-145px;top:45px}
.ek-intro .home-orn .ho-line{left:-80px;top:170px}
.ek-intro .home-orn .ho-dots{left:3%;bottom:100px}
.ek-intro .home-orn .ho-ring{right:8%;bottom:90px}
.ek-intro .home-orn .ho-gold{right:16%;top:22%}
.ek-intro .home-orn .ho-square{left:11%;top:15%}
.ek-intro .home-orn .ho-corner{right:3%;bottom:8%;transform:rotate(180deg)}
.ek-stats .home-orn .ho-chevron{left:-145px;bottom:-60px}
.ek-stats .home-orn .ho-line{right:-80px;bottom:170px}
.ek-stats .home-orn .ho-dots{right:4%;top:90px}
.ek-stats .home-orn .ho-ring{left:7%;top:70px}
.ek-stats .home-orn .ho-gold{left:20%;top:30%}
.ek-feed .home-orn .ho-chevron{right:-150px;top:-40px}
.ek-feed .home-orn .ho-dots{left:5%;bottom:120px}
.ek-feed .home-orn .ho-ring{right:6%;bottom:60px}
.ek-feed .home-orn .ho-square{right:14%;top:18%}
.ek-feed .home-orn .ho-gold{left:12%;top:34%}
.ek-cta .home-orn .ho-chevron{left:-120px;bottom:-80px;border-color:rgba(255,255,255,.10)}
.ek-cta .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.ek-cta .home-orn .ho-dots{left:8%;top:30%;opacity:.22}
.ek-cta .home-orn .ho-ring{right:-70px;top:20%;border-color:rgba(255,255,255,.10)}
.ek-cta .home-orn .ho-gold{left:20%;bottom:26%}

.ek-hero>*:not(.home-orn),
.ek-intro>*:not(.home-orn),
.ek-stats>*:not(.home-orn),
.ek-feed>*:not(.home-orn),
.ek-cta>*:not(.home-orn){position:relative;z-index:1}

/* ---------- Reveal ---------- */
[data-reveal]{opacity:0;transform:translateY(26px);transition:opacity .7s var(--ease,ease),transform .7s var(--ease,ease)}
[data-reveal="left"]{transform:translateX(-30px)}
[data-reveal="right"]{transform:translateX(30px)}
[data-reveal].revealed{opacity:1;transform:none}
@media (prefers-reduced-motion:reduce){
  [data-reveal]{opacity:1;transform:none;transition:none}
  .ek-title,.ek-lead,.ek-hero-meta,.hero-photo{animation:none!important}
}

/* ---------- SECTION SHARED ---------- */
.ek-section{padding:clamp(4.5rem,9vw,8rem) clamp(1.5rem,5vw,5.5rem)}
.ek-eyebrow{display:inline-flex;align-items:center;gap:.65rem;font-size:.74rem;font-weight:800;
  letter-spacing:.2em;text-transform:uppercase;color:#b98a12;margin-bottom:1rem}
.ek-eyebrow::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ffb300)}
.ek-section-title{font-family:var(--font-display);font-weight:900;
  font-size:clamp(2.5rem,5vw,4.5rem);line-height:.95;letter-spacing:-.03em;margin:0;color:#0d3a66}
.ek-section-title .ek-gold-txt{display:inline-block;
  background:linear-gradient(135deg,#ffe66d 0%,#ffc107 45%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ffc107}
.ek-desc{font-size:1rem;line-height:1.85;color:#48688a;max-width:560px;margin-top:1.1rem}

/* ---------- 1. INTRO (editorial 2 kolom) ---------- */
.ek-intro{background:#f7f9fc;position:relative}
.ek-intro-grid{display:grid;grid-template-columns:minmax(0,1.15fr) minmax(320px,.85fr);gap:4.5rem;align-items:center;max-width:1320px;margin:0 auto}
.ek-intro-meta{display:flex;gap:2.2rem;flex-wrap:wrap;margin-top:2rem}
.ek-intro-meta .im-item b{display:block;font-family:var(--font-display);font-size:2rem;font-weight:900;color:#0d3a66;line-height:1}
.ek-intro-meta .im-item b em{font-style:normal;color:#ffb300}
.ek-intro-meta .im-item span{font-size:.78rem;font-weight:700;letter-spacing:.06em;color:#48688a;text-transform:uppercase}
.ek-intro-visual{position:relative;border-radius:24px;overflow:hidden;box-shadow:0 30px 70px rgba(13,58,102,.18);border:1px solid rgba(255,179,0,.35)}
.ek-intro-visual img{width:100%;height:420px;object-fit:cover;display:block}
.ek-intro-visual::after{content:"";position:absolute;inset:0;background:linear-gradient(200deg,rgba(7,22,42,.05) 0%,rgba(13,58,102,.52) 100%)}
.ek-intro-cap{position:absolute;z-index:2;left:1.4rem;right:1.4rem;bottom:1.2rem;color:#fff}
.ek-intro-cap strong{display:block;font-family:var(--font-display);font-size:1.25rem;font-weight:700}
.ek-intro-cap span{font-size:.74rem;color:rgba(255,255,255,.78)}
.ek-intro-badge{position:absolute;z-index:3;top:1.2rem;left:1.2rem;display:inline-flex;align-items:center;gap:.45rem;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;font-size:.7rem;font-weight:900;
  letter-spacing:.12em;text-transform:uppercase;padding:.5rem .8rem;border-radius:999px;box-shadow:0 10px 24px rgba(255,179,0,.35)}

/* ---------- 2. STATS ---------- */
.ek-stats{background:#0d3a66;color:#fff;position:relative}
.ek-stats .ek-eyebrow{color:#ffd54a}
.ek-stats .ek-section-title{color:#fff}
.ek-stats-head{display:flex;align-items:flex-end;justify-content:space-between;gap:2rem;flex-wrap:wrap;max-width:1320px;margin:0 auto 3rem}
.ek-stats-head .ek-desc{color:rgba(235,245,253,.75);max-width:520px}
.ek-stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.4rem;max-width:1320px;margin:0 auto}
.ek-stat{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-radius:20px;
  padding:2rem 1.6rem;text-align:center;position:relative;overflow:hidden;
  transition:transform .35s var(--ease,ease),box-shadow .35s var(--ease,ease),border-color .35s var(--ease,ease)}
.ek-stat::before{content:"";position:absolute;top:0;left:0;right:0;height:4px;
  background:linear-gradient(90deg,#ffd54a,#ffb300);opacity:.85}
.ek-stat:hover{transform:translateY(-6px);box-shadow:0 24px 50px rgba(4,14,28,.4);border-color:rgba(255,213,74,.5)}
.ek-stat-icon{width:56px;height:56px;margin:0 auto 1.1rem;border-radius:16px;display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,rgba(255,213,74,.22),rgba(255,179,0,.12));color:#ffd54a;border:1px solid rgba(255,213,74,.35)}
.ek-stat-icon svg{width:26px;height:26px}
.ek-stat b{display:block;font-family:var(--font-display);font-size:clamp(2.2rem,3.6vw,3.4rem);font-weight:900;line-height:1;color:#fff}
.ek-stat b em{font-style:normal;color:#ffd54a}
.ek-stat>span{display:block;margin-top:.55rem;font-size:.82rem;font-weight:800;letter-spacing:.09em;text-transform:uppercase;color:#ffd54a}
.ek-stat>p{font-size:.82rem;line-height:1.6;color:rgba(235,245,253,.7);margin:.6rem 0 0}

/* ---------- 3. GALERI INSTAGRAM FEED (fitur utama) ---------- */
.ek-feed{background:#f7f9fc;position:relative}
.ek-feed-inner{max-width:1320px;margin:0 auto}
.ek-feed-head{display:flex;align-items:flex-end;justify-content:space-between;gap:2rem;flex-wrap:wrap;margin-bottom:1.6rem}
.ek-feed-hint{display:inline-flex;align-items:center;gap:.55rem;font-size:.8rem;font-weight:700;color:#48688a;
  background:#fff;border:1px solid rgba(13,58,102,.14);padding:.55rem .95rem;border-radius:999px;
  box-shadow:0 8px 20px rgba(13,58,102,.06)}
.ek-feed-hint svg{width:16px;height:16px;color:#ffb300}

/* ---- Carousel ---- */
.ek-carousel{position:relative}
.ek-viewport{overflow:hidden;border-radius:26px;background:#fff;box-shadow:0 30px 70px rgba(13,58,102,.12);
  border:1px solid rgba(13,58,102,.08);padding:1.4rem}
.ek-track{display:flex;width:100%;transition:transform .62s cubic-bezier(.22,1,.36,1);will-change:transform}
.ek-slide{flex:0 0 100%;min-width:100%;max-width:100%;display:grid;grid-template-columns:repeat(3,1fr);gap:1.1rem;padding:.15rem}

/* ---- Flip card ---- */
.ek-card{position:relative;perspective:1400px;aspect-ratio:1/1;cursor:pointer;-webkit-tap-highlight-color:transparent;min-width:0}
.ek-card-inner{position:relative;width:100%;height:100%;transition:transform .68s cubic-bezier(.22,1,.36,1);
  transform-style:preserve-3d;border-radius:18px}
.ek-card.flipped .ek-card-inner{transform:rotateY(180deg)}
.ek-card-face{position:absolute;inset:0;backface-visibility:hidden;-webkit-backface-visibility:hidden;
  border-radius:18px;overflow:hidden}
/* DEPAN: foto persegi gaya feed Instagram */
.ek-card-front{background:#0d3a66}
.ek-card-front img{width:100%;height:100%;object-fit:cover;object-position:center;display:block;
  transition:transform .6s var(--ease,ease)}
.ek-card:hover .ek-card-front img{transform:scale(1.06)}
.ek-card-front::after{content:"";position:absolute;inset:0;
  background:linear-gradient(180deg,rgba(7,22,42,0) 46%,rgba(7,22,42,.72) 100%)}
.ek-card-front .ek-fr-icon{position:absolute;z-index:2;top:.8rem;left:.8rem;width:38px;height:38px;border-radius:12px;
  display:flex;align-items:center;justify-content:center;color:#0d3a66;
  background:linear-gradient(135deg,#ffd54a,#ffb300);box-shadow:0 8px 20px rgba(4,14,28,.35)}
.ek-card-front .ek-fr-icon svg{width:19px;height:19px}
.ek-card-front .ek-fr-cap{position:absolute;z-index:2;left:1rem;right:1rem;bottom:.9rem;color:#fff}
.ek-card-front .ek-fr-cap strong{display:block;font-family:var(--font-display);font-size:1.12rem;font-weight:800;line-height:1.15}
.ek-card-front .ek-fr-cap span{font-size:.7rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#ffd54a}
.ek-card-front .ek-fr-flip{position:absolute;z-index:2;top:.8rem;right:.8rem;width:34px;height:34px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;background:rgba(7,22,42,.45);color:#fff;
  border:1px solid rgba(255,255,255,.28);backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px)}
.ek-card-front .ek-fr-flip svg{width:15px;height:15px}
/* BELAKANG: profil/about ekstra */
.ek-card-back{background:linear-gradient(160deg,#0d3a66 0%,#123f6e 55%,#0a2c50 100%);color:#fff;
  transform:rotateY(180deg);display:flex;flex-direction:column;padding:1.15rem;border:1px solid rgba(255,213,74,.35)}
.ek-card-back .ek-bk-top{display:flex;align-items:center;gap:.7rem;margin-bottom:.55rem}
.ek-card-back .ek-bk-icon{width:44px;height:44px;flex:0 0 44px;border-radius:13px;display:flex;align-items:center;justify-content:center;
  color:#0d3a66;background:linear-gradient(135deg,#ffd54a,#ffb300)}
.ek-card-back .ek-bk-icon svg{width:22px;height:22px}
.ek-card-back .ek-bk-name{font-family:var(--font-display);font-size:1.02rem;font-weight:800;line-height:1.15}
.ek-card-back .ek-bk-name small{display:block;font-family:var(--font-body,inherit);font-size:.64rem;font-weight:700;
  letter-spacing:.14em;text-transform:uppercase;color:#ffd54a;margin-top:.15rem}
.ek-card-back .ek-bk-desc{font-size:.8rem;line-height:1.6;color:rgba(235,245,253,.88);margin:0 0 .7rem}
.ek-card-back .ek-bk-list{list-style:none;margin:0 0 auto;padding:0;display:grid;gap:.4rem}
.ek-card-back .ek-bk-list li{display:flex;align-items:flex-start;gap:.5rem;font-size:.74rem;line-height:1.45;color:rgba(235,245,253,.9)}
.ek-card-back .ek-bk-list li svg{width:13px;height:13px;flex:0 0 13px;margin-top:.18rem;color:#ffd54a}
.ek-card-back .ek-bk-list li b{color:#fff;font-weight:800}
.ek-card-back .ek-bk-tag{margin-top:.65rem;display:inline-flex;align-self:flex-start;font-size:.62rem;font-weight:900;
  letter-spacing:.12em;text-transform:uppercase;color:#0d3a66;background:linear-gradient(135deg,#ffe66d,#ffb300);
  padding:.32rem .6rem;border-radius:999px}

/* ---- Nav arrows & dots ---- */
.ek-nav{position:absolute;top:50%;transform:translateY(-50%);z-index:6;width:48px;height:48px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;cursor:pointer;border:none;color:#0d3a66;
  background:linear-gradient(135deg,#ffd54a,#ffb300);box-shadow:0 14px 30px rgba(255,179,0,.4);
  transition:transform .25s var(--ease,ease),box-shadow .25s var(--ease,ease),background .25s var(--ease,ease)}
.ek-nav:hover{transform:translateY(-50%) scale(1.08);box-shadow:0 18px 38px rgba(255,179,0,.5)}
.ek-nav svg{width:20px;height:20px}
.ek-nav.ek-prev{left:-14px}
.ek-nav.ek-next{right:-14px}
.ek-nav:disabled{opacity:.35;cursor:default;transform:translateY(-50%) scale(1)}
.ek-feed-dots{display:flex;align-items:center;justify-content:center;gap:.6rem;margin-top:1.4rem}
.ek-dot{width:10px;height:10px;border-radius:99px;border:none;padding:0;cursor:pointer;background:rgba(13,58,102,.2);
  transition:width .3s var(--ease,ease),background .3s var(--ease,ease)}
.ek-dot.active{width:34px;background:linear-gradient(90deg,#ffd54a,#ffb300)}
.ek-feed-counter{display:inline-flex;align-items:center;gap:.5rem;margin-left:auto;font-size:.8rem;font-weight:800;
  color:#48688a;letter-spacing:.1em}
.ek-feed-counter b{color:#0d3a66;font-family:var(--font-display);font-size:1.05rem}
.ek-feed-bottom{display:flex;align-items:center;gap:1rem;margin-top:1.5rem}

/* ---------- 4. CTA ---------- */
.ek-cta{background:#0d3a66;color:#fff;text-align:center;position:relative;overflow:hidden;
  padding:clamp(4.5rem,9vw,7.5rem) clamp(1.5rem,5vw,5.5rem)}
.ek-cta-title{font-family:var(--font-display);font-weight:900;font-size:clamp(2.4rem,5vw,4.4rem);line-height:.98;
  letter-spacing:-.02em;margin:0 auto;max-width:820px;color:#fff}
.ek-cta-title em{font-style:normal;
  background:linear-gradient(135deg,#ffe66d 0%,#ffc107 45%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ffc107}
.ek-cta p{font-size:1rem;line-height:1.85;color:rgba(235,245,253,.8);max-width:620px;margin:1.3rem auto 0}
.ek-cta-btn{display:inline-flex;align-items:center;gap:.6rem;margin-top:2rem;padding:.95rem 2rem;border-radius:999px;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;font-weight:900;font-size:.92rem;letter-spacing:.04em;
  text-decoration:none;box-shadow:0 18px 40px rgba(255,179,0,.35);transition:transform .25s var(--ease,ease),box-shadow .25s var(--ease,ease)}
.ek-cta-btn:hover{transform:translateY(-3px);box-shadow:0 24px 50px rgba(255,179,0,.45)}
.ek-cta-note{display:inline-flex;align-items:center;gap:.5rem;margin-top:1.2rem;font-size:.78rem;color:rgba(235,245,253,.6)}

/* ---------- RESPONSIVE ---------- */
@media (max-width:1080px){
  .ek-hero-inner{grid-template-columns:minmax(0,1.15fr) minmax(300px,.85fr);gap:2.6rem}
  .ek-slide{grid-template-columns:repeat(3,1fr)}
}
@media (max-width:900px){
  .ek-hero-inner{grid-template-columns:1fr;gap:2.4rem}
  .hero-photo{height:340px;max-width:560px}
  .ek-intro-grid{grid-template-columns:1fr;gap:2.6rem}
  .ek-intro-visual img{height:320px}
  .ek-stats-grid{grid-template-columns:repeat(2,1fr)}
  .ek-slide{grid-template-columns:repeat(2,1fr)}
  .ek-nav.ek-prev{left:-8px}
  .ek-nav.ek-next{right:-8px}
}
@media (max-width:600px){
  .ek-stats-grid{grid-template-columns:1fr 1fr;gap:.9rem}
  .ek-stat{padding:1.4rem 1rem}
  .ek-slide{grid-template-columns:repeat(2,1fr);gap:.7rem}
  .ek-viewport{padding:.8rem;border-radius:20px}
  .ek-card-back{padding:.85rem}
  .ek-card-back .ek-bk-name{font-size:.86rem}
  .ek-card-back .ek-bk-desc{font-size:.72rem}
  .ek-card-back .ek-bk-list li{font-size:.66rem}
  .ek-card-front .ek-fr-cap strong{font-size:.95rem}
  .ek-card-front .ek-fr-icon{width:32px;height:32px}
  .ek-nav{width:42px;height:42px}
  .ek-feed-hint{font-size:.72rem}
}
</style>
@endpush

@section('content')
<div class="ek-page">

  <!-- HERO (IDENTIK referensi — TIDAK DIUBAH) -->
  <section class="ek-hero">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="ek-hero-inner">
      <div>
        <div class="ek-kicker">Kegiatan Non-Akademik Peserta Didik</div>
        <h1 class="ek-title">
          <span class="ek-white">Ekstra</span> <span class="ek-gold">Kurikuler</span>
        </h1>
        <p class="ek-lead">Di luar jam pelajaran, bakat menemukan panggungnya. SMK Negeri 2 Mojokerto menyediakan belasan wadah pengembangan diri — dari kepanduan, olahraga, seni, hingga riset — untuk membentuk generasi yang berkarakter, terampil, dan siap bersaing.</p>
        <div class="ek-hero-meta">
          <span class="ek-pill"><i class="fas fa-star"></i> 12+ Ekstrakurikuler</span>
          <span class="ek-pill"><i class="fas fa-users"></i> 800+ Anggota Aktif</span>
          <span class="ek-pill"><i class="fas fa-trophy"></i> 20+ Prestasi</span>
        </div>
      </div>

      <div class="hero-photo" data-reveal="right">
        <img src="{{ asset('images/paskibra.jpg') }}" alt="Pasukan pengibar bendera SMK Negeri 2 Mojokerto" loading="eager">
        <div class="hero-photo-caption"><strong>Skaneda Berkarakter</strong><span>Latihan Paskibra — kedisiplinan baris-berbaris.</span></div>
      </div>
    </div>
  </section>

  <!-- 1. PENGANTAR (editorial 2 kolom) -->
  <section class="ek-intro">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>
    <div class="ek-section ek-intro-grid">
      <div data-reveal="left">
        <span class="ek-eyebrow">Tumbuh di Luar Kelas</span>
        <h2 class="ek-section-title">Bakat Tak<br><span class="ek-gold-txt">Berhenti di Kelas</span></h2>
        <p class="ek-desc">Ekstrakurikuler adalah laboratorium karakter Skaneda. Lewat kegiatan rutin, pembinaan intensif, dan ajang kompetisi, peserta didik belajar disiplin, kerja sama, kepemimpinan, serta keberanian untuk tampil — bekal yang tidak kalah penting dari keterampilan vokasi.</p>
        <div class="ek-intro-meta">
          <div class="im-item"><b>12<em>+</em></b><span>Ekstrakurikuler</span></div>
          <div class="im-item"><b>5</b><span>Bidang Minat</span></div>
          <div class="im-item"><b>6<em>×</em></b><span>Latihan / Pekan</span></div>
        </div>
      </div>
      <div data-reveal="right">
        <div class="ek-intro-visual">
          <span class="ek-intro-badge"><i class="fas fa-camera"></i> #SkanedaBerkarya</span>
          <img src="{{ asset('images/seni-tari.jpg') }}" alt="Penari tradisional dari ekstrakurikuler Seni Tari SMKN 2 Mojokerto" loading="eager">
          <div class="ek-intro-cap"><strong>Seni Tari Skaneda</strong><span>Tampil di festival budaya pelajar — melestarikan warisan lewat gerak.</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. STATISTIK -->
  <section class="ek-stats">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>
    <div class="ek-section">
      <div class="ek-stats-head" data-reveal>
        <div>
          <span class="ek-eyebrow">Angka Berbicara</span>
          <h2 class="ek-section-title">Ruang <span class="ek-gold-txt">Bertumbuh</span></h2>
        </div>
        <p class="ek-desc">Kegiatan ekstrakurikuler Skaneda diikuti lintas jurusan — setiap minggu, ratusan peserta didik berlatih dan berkarya di luar jam belajar.</p>
      </div>
      <div class="ek-stats-grid">
        <div class="ek-stat" data-reveal>
          <div class="ek-stat-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76" fill="currentColor" stroke="none"/></svg>
          </div>
          <b><em data-count="12">0</em>+</b>
          <span>Ekstrakurikuler</span>
          <p>Wadah aktif yang dibina guru &amp; pelatih profesional.</p>
        </div>
        <div class="ek-stat" data-reveal style="--d:1">
          <div class="ek-stat-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
          </div>
          <b><em data-count="800">0</em>+</b>
          <span>Anggota Aktif</span>
          <p>Peserta didik terlibat setiap pekan lintas jurusan.</p>
        </div>
        <div class="ek-stat" data-reveal style="--d:2">
          <div class="ek-stat-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 010-5H6"/><path d="M18 9h1.5a2.5 2.5 0 000-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0012 0V2z"/></svg>
          </div>
          <b><em data-count="20">0</em>+</b>
          <span>Prestasi</span>
          <p>Juara lomba &amp; festival tingkat kota hingga nasional.</p>
        </div>
        <div class="ek-stat" data-reveal style="--d:3">
          <div class="ek-stat-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3 6 6 .9-4.5 4.2 1.1 6.4L12 16.7 6.4 19.5l1.1-6.4L3 8.9 9 8z"/></svg>
          </div>
          <b>5</b>
          <span>Bidang Minat</span>
          <p>Kepanduan, olahraga, seni &amp; budaya, keagamaan, riset.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. GALERI INSTAGRAM FEED (fitur utama: grid 1:1 + carousel + flip card) -->
  <section class="ek-feed">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>
    <div class="ek-section ek-feed-inner">
      <div class="ek-feed-head" data-reveal>
        <div>
          <span class="ek-eyebrow">Skaneda Activity Feed</span>
          <h2 class="ek-section-title">Galeri <span class="ek-gold-txt">Ekstrakurikuler</span></h2>
        </div>
        <span class="ek-feed-hint">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="4"/><circle cx="12" cy="12" r="4"/><circle cx="17.2" cy="6.8" r=".6" fill="currentColor" stroke="none"/></svg>
          Klik kartu untuk membalik · Geser untuk lihat lainnya
        </span>
      </div>

      <div class="ek-carousel" data-reveal>
        <div class="ek-viewport">
          <div class="ek-track" id="ekTrack">

            <!-- ===== HALAMAN 1 (6 ekstra) ===== -->
            <div class="ek-slide">

              <!-- 1. PRAMUKA -->
              <div class="ek-card" data-flip>
                <div class="ek-card-inner">
                  <div class="ek-card-face ek-card-front">
                    <span class="ek-fr-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76" fill="currentColor" stroke="none"/></svg>
                    </span>
                    <span class="ek-fr-flip">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 1l4 4-4 4"/><path d="M3 11V9a4 4 0 014-4h14"/><path d="M7 23l-4-4 4-4"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
                    </span>
                    <img src="{{ asset('images/pramuka.jpg') }}" alt="Kegiatan Pramuka SMKN 2 Mojokerto" loading="eager">
                    <div class="ek-fr-cap"><strong>Pramuka</strong><span>Kepanduan · Jumat</span></div>
                  </div>
                  <div class="ek-card-face ek-card-back">
                    <div class="ek-bk-top">
                      <span class="ek-bk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76" fill="currentColor" stroke="none"/></svg>
                      </span>
                      <div class="ek-bk-name">Pramuka<small>Gerakan Pramuka Skaneda</small></div>
                    </div>
                    <p class="ek-bk-desc">Membentuk jiwa kepanduan: disiplin, mandiri, cinta alam, dan siap berkarya untuk negeri.</p>
                    <ul class="ek-bk-list">
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Kak Budi Santoso, S.Pd</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Jumat 14.00–16.30 WIB</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Barung, ambalan, kemah, lomba kwartir</span></li>
                    </ul>
                    <span class="ek-bk-tag">Kepanduan</span>
                  </div>
                </div>
              </div>

              <!-- 2. PASKIBRA -->
              <div class="ek-card" data-flip>
                <div class="ek-card-inner">
                  <div class="ek-card-face ek-card-front">
                    <span class="ek-fr-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 21V4"/><path d="M5 5h11l-2.2 2.6L16 10H5"/></svg>
                    </span>
                    <span class="ek-fr-flip">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 1l4 4-4 4"/><path d="M3 11V9a4 4 0 014-4h14"/><path d="M7 23l-4-4 4-4"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
                    </span>
                    <img src="{{ asset('images/paskibra.jpg') }}" alt="Latihan Paskibra SMKN 2 Mojokerto" loading="eager">
                    <div class="ek-fr-cap"><strong>Paskibra</strong><span>Baris-Berbaris · Rabu &amp; Sabtu</span></div>
                  </div>
                  <div class="ek-card-face ek-card-back">
                    <div class="ek-bk-top">
                      <span class="ek-bk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 21V4"/><path d="M5 5h11l-2.2 2.6L16 10H5"/></svg>
                      </span>
                      <div class="ek-bk-name">Paskibra<small>Pasukan Pengibar Bendera</small></div>
                    </div>
                    <p class="ek-bk-desc">Kedisiplinan baris-berbaris, formasi, dan pengibaran Sang Saka Merah Putih di setiap upacara.</p>
                    <ul class="ek-bk-list">
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Rudi Hartono, S.Or</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Rabu &amp; Sabtu 15.00–17.00 WIB</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> PBB, formasi, pengibaran upacara</span></li>
                    </ul>
                    <span class="ek-bk-tag">Kedisiplinan</span>
                  </div>
                </div>
              </div>

              <!-- 3. PENCAK SILAT -->
              <div class="ek-card" data-flip>
                <div class="ek-card-inner">
                  <div class="ek-card-face ek-card-front">
                    <span class="ek-fr-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6z"/><path d="M9.5 12.5l2 2 3.5-4"/></svg>
                    </span>
                    <span class="ek-fr-flip">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 1l4 4-4 4"/><path d="M3 11V9a4 4 0 014-4h14"/><path d="M7 23l-4-4 4-4"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
                    </span>
                    <img src="{{ asset('images/pencak-silat.jpg') }}" alt="Latihan Pencak Silat SMKN 2 Mojokerto" loading="eager">
                    <div class="ek-fr-cap"><strong>Pencak Silat</strong><span>Bela Diri · Selasa &amp; Kamis</span></div>
                  </div>
                  <div class="ek-card-face ek-card-back">
                    <div class="ek-bk-top">
                      <span class="ek-bk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6z"/><path d="M9.5 12.5l2 2 3.5-4"/></svg>
                      </span>
                      <div class="ek-bk-name">Pencak Silat<small>Bela Diri Warisan Budaya</small></div>
                    </div>
                    <p class="ek-bk-desc">Bela diri asli Nusantara — membentuk jiwa kesatria, percaya diri, dan ketahanan fisik.</p>
                    <ul class="ek-bk-list">
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> M. Fajar Ramadhan</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Selasa &amp; Kamis 15.30–17.30 WIB</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Jurus, sparring, kejuaraan silat</span></li>
                    </ul>
                    <span class="ek-bk-tag">Bela Diri</span>
                  </div>
                </div>
              </div>

              <!-- 4. FUTSAL -->
              <div class="ek-card" data-flip>
                <div class="ek-card-inner">
                  <div class="ek-card-face ek-card-front">
                    <span class="ek-fr-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 3v18M3 12h18M5.6 5.6l12.8 12.8M18.4 5.6L5.6 18.4"/></svg>
                    </span>
                    <span class="ek-fr-flip">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 1l4 4-4 4"/><path d="M3 11V9a4 4 0 014-4h14"/><path d="M7 23l-4-4 4-4"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
                    </span>
                    <img src="{{ asset('images/futsal.jpg') }}" alt="Latihan Futsal SMKN 2 Mojokerto" loading="eager">
                    <div class="ek-fr-cap"><strong>Futsal</strong><span>Olahraga · Senin &amp; Rabu</span></div>
                  </div>
                  <div class="ek-card-face ek-card-back">
                    <div class="ek-bk-top">
                      <span class="ek-bk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 3v18M3 12h18M5.6 5.6l12.8 12.8M18.4 5.6L5.6 18.4"/></svg>
                      </span>
                      <div class="ek-bk-name">Futsal<small>Tim Futsal Skaneda</small></div>
                    </div>
                    <p class="ek-bk-desc">Kecepatan, strategi, dan kerja sama tim — berlatih rutin dan berlaga di turnamen antar-SMK.</p>
                    <ul class="ek-bk-list">
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Andik Prasetyo, S.Pd</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Senin &amp; Rabu 15.00–17.00 WIB</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Liga pelajar, turnamen antar-SMK</span></li>
                    </ul>
                    <span class="ek-bk-tag">Olahraga</span>
                  </div>
                </div>
              </div>

              <!-- 5. BASKET -->
              <div class="ek-card" data-flip>
                <div class="ek-card-inner">
                  <div class="ek-card-face ek-card-front">
                    <span class="ek-fr-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M3.6 8.5h16.8M3.6 15.5h16.8M12 3a9.5 9.5 0 010 18M7.5 3.8c3 3.5 3 12.9 0 16.4M16.5 3.8c-3 3.5-3 12.9 0 16.4"/></svg>
                    </span>
                    <span class="ek-fr-flip">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 1l4 4-4 4"/><path d="M3 11V9a4 4 0 014-4h14"/><path d="M7 23l-4-4 4-4"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
                    </span>
                    <img src="{{ asset('images/basket.jpg') }}" alt="Latihan Basket SMKN 2 Mojokerto" loading="eager">
                    <div class="ek-fr-cap"><strong>Basket</strong><span>Olahraga · Selasa &amp; Jumat</span></div>
                  </div>
                  <div class="ek-card-face ek-card-back">
                    <div class="ek-bk-top">
                      <span class="ek-bk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M3.6 8.5h16.8M3.6 15.5h16.8M12 3a9.5 9.5 0 010 18M7.5 3.8c3 3.5 3 12.9 0 16.4M16.5 3.8c-3 3.5-3 12.9 0 16.4"/></svg>
                      </span>
                      <div class="ek-bk-name">Basket<small>Tim Basket Skaneda</small></div>
                    </div>
                    <p class="ek-bk-desc">Tinggi lompatanmu, tinggi pula semangatmu — berkompetisi di Honda DBL &amp; antar-SMK.</p>
                    <ul class="ek-bk-list">
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Yoga Pratama, S.Or</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Selasa &amp; Jumat 15.30–17.30 WIB</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> DBL, turnamen antar-SMK</span></li>
                    </ul>
                    <span class="ek-bk-tag">Olahraga</span>
                  </div>
                </div>
              </div>

              <!-- 6. VOLI -->
              <div class="ek-card" data-flip>
                <div class="ek-card-inner">
                  <div class="ek-card-face ek-card-front">
                    <span class="ek-fr-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 3c4.2 4.2 4.2 13.8 0 18M12 3c-4.2 4.2-4.2 13.8 0 18M3 12c4.5-1.5 13.5-1.5 18 0"/></svg>
                    </span>
                    <span class="ek-fr-flip">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 1l4 4-4 4"/><path d="M3 11V9a4 4 0 014-4h14"/><path d="M7 23l-4-4 4-4"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
                    </span>
                    <img src="{{ asset('images/voli.jpg') }}" alt="Ekstrakurikuler Bola Voli SMKN 2 Mojokerto" loading="eager">
                    <div class="ek-fr-cap"><strong>Bola Voli</strong><span>Olahraga · Kamis &amp; Sabtu</span></div>
                  </div>
                  <div class="ek-card-face ek-card-back">
                    <div class="ek-bk-top">
                      <span class="ek-bk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 3c4.2 4.2 4.2 13.8 0 18M12 3c-4.2 4.2-4.2 13.8 0 18M3 12c4.5-1.5 13.5-1.5 18 0"/></svg>
                      </span>
                      <div class="ek-bk-name">Bola Voli<small>Tim Voli Skaneda</small></div>
                    </div>
                    <p class="ek-bk-desc">Smash keras, tim solid — latihan rutin dan unjuk gigi di POPDA serta turnamen pelajar.</p>
                    <ul class="ek-bk-list">
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Dimas Arya, S.Pd</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Kamis &amp; Sabtu 15.00–17.00 WIB</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> POPDA, turnamen antar-SMK</span></li>
                    </ul>
                    <span class="ek-bk-tag">Olahraga</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- ===== HALAMAN 2 (6 ekstra) ===== -->
            <div class="ek-slide">

              <!-- 7. PMR -->
              <div class="ek-card" data-flip>
                <div class="ek-card-inner">
                  <div class="ek-card-face ek-card-front">
                    <span class="ek-fr-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M12 3v18M3 12h18"/></svg>
                    </span>
                    <span class="ek-fr-flip">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 1l4 4-4 4"/><path d="M3 11V9a4 4 0 014-4h14"/><path d="M7 23l-4-4 4-4"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
                    </span>
                    <img src="{{ asset('images/pmr.jpg') }}" alt="Latihan PMR Palang Merah Remaja SMKN 2 Mojokerto" loading="eager">
                    <div class="ek-fr-cap"><strong>PMR</strong><span>Palang Merah Remaja · Sabtu</span></div>
                  </div>
                  <div class="ek-card-face ek-card-back">
                    <div class="ek-bk-top">
                      <span class="ek-bk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M12 3v18M3 12h18"/></svg>
                      </span>
                      <div class="ek-bk-name">PMR<small>Palang Merah Remaja</small></div>
                    </div>
                    <p class="ek-bk-desc">Siap menolong, siap siaga — belajar pertolongan pertama, donor darah, dan siaga bencana.</p>
                    <ul class="ek-bk-list">
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> dr. Nia Rahmawati (UKS)</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Sabtu 08.00–11.00 WIB</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> P3K, donor darah, siaga bencana</span></li>
                    </ul>
                    <span class="ek-bk-tag">Kesehatan</span>
                  </div>
                </div>
              </div>

              <!-- 8. ROHIS -->
              <div class="ek-card" data-flip>
                <div class="ek-card-inner">
                  <div class="ek-card-face ek-card-front">
                    <span class="ek-fr-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 21v-7a4 4 0 018 0v7"/><path d="M3 21h18"/><path d="M12 7l3 4H9z"/><path d="M9 7V5l3-2 3 2v2"/></svg>
                    </span>
                    <span class="ek-fr-flip">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 1l4 4-4 4"/><path d="M3 11V9a4 4 0 014-4h14"/><path d="M7 23l-4-4 4-4"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
                    </span>
                    <img src="{{ asset('images/rohis.jpg') }}" alt="Kegiatan Rohis Kerohanian Islam SMKN 2 Mojokerto" loading="eager">
                    <div class="ek-fr-cap"><strong>Rohis</strong><span>Kerohanian Islam · Jumat</span></div>
                  </div>
                  <div class="ek-card-face ek-card-back">
                    <div class="ek-bk-top">
                      <span class="ek-bk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 21v-7a4 4 0 018 0v7"/><path d="M3 21h18"/><path d="M12 7l3 4H9z"/><path d="M9 7V5l3-2 3 2v2"/></svg>
                      </span>
                      <div class="ek-bk-name">Rohis<small>Kerohanian Islam</small></div>
                    </div>
                    <p class="ek-bk-desc">Membangun akhlak mulia generasi beriman — kajian, tahfidz, peringatan hari besar, dan aksi sosial.</p>
                    <ul class="ek-bk-list">
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Ust. Ahmad Zainuddin, S.Pd.I</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Jumat 13.30–15.00 WIB</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Kajian, tahfidz, PHBI, aksi sosial</span></li>
                    </ul>
                    <span class="ek-bk-tag">Keagamaan</span>
                  </div>
                </div>
              </div>

              <!-- 9. SENI TARI -->
              <div class="ek-card" data-flip>
                <div class="ek-card-inner">
                  <div class="ek-card-face ek-card-front">
                    <span class="ek-fr-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="4.5" r="2"/><path d="M12 7.5v6M12 9l-4.5 3.5M12 9l4.5 3.5M12 13.5L9 20M12 13.5l3 6.5"/></svg>
                    </span>
                    <span class="ek-fr-flip">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 1l4 4-4 4"/><path d="M3 11V9a4 4 0 014-4h14"/><path d="M7 23l-4-4 4-4"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
                    </span>
                    <img src="{{ asset('images/seni-tari.jpg') }}" alt="Penampilan Seni Tari SMKN 2 Mojokerto" loading="eager">
                    <div class="ek-fr-cap"><strong>Seni Tari</strong><span>Seni &amp; Budaya · Rabu &amp; Sabtu</span></div>
                  </div>
                  <div class="ek-card-face ek-card-back">
                    <div class="ek-bk-top">
                      <span class="ek-bk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="4.5" r="2"/><path d="M12 7.5v6M12 9l-4.5 3.5M12 9l4.5 3.5M12 13.5L9 20M12 13.5l3 6.5"/></svg>
                      </span>
                      <div class="ek-bk-name">Seni Tari<small>Tari Tradisional &amp; Kreasi</small></div>
                    </div>
                    <p class="ek-bk-desc">Melestarikan budaya melalui gerak — menari tradisional dan kreasi, tampil di festival pelajar.</p>
                    <ul class="ek-bk-list">
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Lailatul Fajriyah, S.Sn</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Rabu &amp; Sabtu 14.30–16.30 WIB</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Tari tradisional, tari kreasi, festival</span></li>
                    </ul>
                    <span class="ek-bk-tag">Seni &amp; Budaya</span>
                  </div>
                </div>
              </div>

              <!-- 10. MUSIK / BAND -->
              <div class="ek-card" data-flip>
                <div class="ek-card-inner">
                  <div class="ek-card-face ek-card-front">
                    <span class="ek-fr-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="17" cy="17" r="4.5"/><path d="M13.5 13.5L20 7M17 4l3 3-1.5 1.5-3-3z"/></svg>
                    </span>
                    <span class="ek-fr-flip">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 1l4 4-4 4"/><path d="M3 11V9a4 4 0 014-4h14"/><path d="M7 23l-4-4 4-4"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
                    </span>
                    <img src="{{ asset('images/musik.jpg') }}" alt="Band siswa SMKN 2 Mojokerto tampil" loading="eager">
                    <div class="ek-fr-cap"><strong>Musik / Band</strong><span>Seni Musik · Senin &amp; Kamis</span></div>
                  </div>
                  <div class="ek-card-face ek-card-back">
                    <div class="ek-bk-top">
                      <span class="ek-bk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="17" cy="17" r="4.5"/><path d="M13.5 13.5L20 7M17 4l3 3-1.5 1.5-3-3z"/></svg>
                      </span>
                      <div class="ek-bk-name">Musik / Band<small>Band Skaneda</small></div>
                    </div>
                    <p class="ek-bk-desc">Nada, harmoni, dan ekspresi — band sekolah tampil di pentas seni dan acara resmi sekolah.</p>
                    <ul class="ek-bk-list">
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Rendra Kurniawan, S.Sn</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Senin &amp; Kamis 15.00–17.30 WIB</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Pentas seni, acara sekolah, festival</span></li>
                    </ul>
                    <span class="ek-bk-tag">Seni Musik</span>
                  </div>
                </div>
              </div>

              <!-- 11. ENGLISH CLUB -->
              <div class="ek-card" data-flip>
                <div class="ek-card-inner">
                  <div class="ek-card-face ek-card-front">
                    <span class="ek-fr-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.5 8.5 0 01-12.8 7.3L4 20l1.2-4.2A8.5 8.5 0 1121 11.5z"/><circle cx="9" cy="11.5" r="1" fill="currentColor" stroke="none"/><circle cx="12.5" cy="11.5" r="1" fill="currentColor" stroke="none"/><circle cx="16" cy="11.5" r="1" fill="currentColor" stroke="none"/></svg>
                    </span>
                    <span class="ek-fr-flip">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 1l4 4-4 4"/><path d="M3 11V9a4 4 0 014-4h14"/><path d="M7 23l-4-4 4-4"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
                    </span>
                    <img src="{{ asset('images/english-club.jpg') }}" alt="English Club SMKN 2 Mojokerto" loading="eager">
                    <div class="ek-fr-cap"><strong>English Club</strong><span>Bahasa · Selasa</span></div>
                  </div>
                  <div class="ek-card-face ek-card-back">
                    <div class="ek-bk-top">
                      <span class="ek-bk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.5 8.5 0 01-12.8 7.3L4 20l1.2-4.2A8.5 8.5 0 1121 11.5z"/><circle cx="9" cy="11.5" r="1" fill="currentColor" stroke="none"/><circle cx="12.5" cy="11.5" r="1" fill="currentColor" stroke="none"/><circle cx="16" cy="11.5" r="1" fill="currentColor" stroke="none"/></svg>
                      </span>
                      <div class="ek-bk-name">English Club<small>Speak Up, Go Global</small></div>
                    </div>
                    <p class="ek-bk-desc">Berani bicara dan go global — speaking, debate, dan persiapan TOEIC untuk dunia kerja.</p>
                    <ul class="ek-bk-list">
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Nurul Aini, S.Pd., M.Pd</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Selasa 14.30–16.00 WIB</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Speaking, debate, TOEIC prep</span></li>
                    </ul>
                    <span class="ek-bk-tag">Bahasa</span>
                  </div>
                </div>
              </div>

              <!-- 12. KIR -->
              <div class="ek-card" data-flip>
                <div class="ek-card-inner">
                  <div class="ek-card-face ek-card-front">
                    <span class="ek-fr-icon">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3h6M10 3v5l-5 9a2 2 0 002 3h10a2 2 0 002-3l-5-9V3"/><path d="M8.5 14h7"/></svg>
                    </span>
                    <span class="ek-fr-flip">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 1l4 4-4 4"/><path d="M3 11V9a4 4 0 014-4h14"/><path d="M7 23l-4-4 4-4"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
                    </span>
                    <img src="{{ asset('images/kir.jpg') }}" alt="Kegiatan Karya Ilmiah Remaja SMKN 2 Mojokerto" loading="eager">
                    <div class="ek-fr-cap"><strong>KIR</strong><span>Karya Ilmiah Remaja · Sabtu</span></div>
                  </div>
                  <div class="ek-card-face ek-card-back">
                    <div class="ek-bk-top">
                      <span class="ek-bk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3h6M10 3v5l-5 9a2 2 0 002 3h10a2 2 0 002-3l-5-9V3"/><path d="M8.5 14h7"/></svg>
                      </span>
                      <div class="ek-bk-name">KIR<small>Karya Ilmiah Remaja</small></div>
                    </div>
                    <p class="ek-bk-desc">Riset muda untuk masa depan — meneliti, menulis karya ilmiah, dan berlomba di LKIR.</p>
                    <ul class="ek-bk-list">
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Drs. Suharto, M.Pd</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Sabtu 09.00–12.00 WIB</span></li>
                      <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Riset, karya tulis, LKIR</span></li>
                    </ul>
                    <span class="ek-bk-tag">Riset</span>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <button class="ek-nav ek-prev" id="ekPrev" aria-label="Sebelumnya">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <button class="ek-nav ek-next" id="ekNext" aria-label="Berikutnya">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>
        </button>
      </div>

      <div class="ek-feed-bottom" data-reveal>
        <div class="ek-feed-dots" id="ekDots"></div>
        <span class="ek-feed-counter"><b id="ekCounter">1</b> / <span id="ekTotal">2</span></span>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="ek-cta">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>
    <h2 class="ek-cta-title">Temukan bakatmu, <em>tumbuh bersama.</em></h2>
    <p>Dari lapangan, panggung, hingga laboratorium riset — ekstrakurikuler Skaneda adalah rumah kedua bagi bakatmu. Pilih wadahmu dan mulailah perjalananmu hari ini.</p>
    <a href="{{ route('kontak') }}" class="ek-cta-btn"><i class="fas fa-paper-plane"></i> Hubungi Sekolah</a>
    <div class="ek-cta-note"><i class="fas fa-info-circle"></i> Informasi resmi: smkn2mojokerto.sch.id · #DisiplinBerprestasi</div>
  </section>

</div>
@endsection

@push('scripts')
<script>
  /* ---- Scroll Reveal (senada halaman lain) ---- */
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

    /* Fallback: pastikan semua konten tampil walau observer tak pernah terpicu. */
    setTimeout(function () {
      revealEls.forEach(function (el) { el.classList.add('revealed'); });
    }, 1200);
  })();

  /* ---- Count-up statistik ---- */
  (function () {
    var nums = document.querySelectorAll('[data-count]');
    if (!nums.length) return;
    function animate(el) {
      var target = parseInt(el.getAttribute('data-count'), 10) || 0;
      var dur = 1400, start = null;
      function step(ts) {
        if (!start) start = ts;
        var p = Math.min((ts - start) / dur, 1);
        el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3)));
        if (p < 1) requestAnimationFrame(step);
      }
      requestAnimationFrame(step);
    }
    if ('IntersectionObserver' in window) {
      var obs = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
          if (e.isIntersecting) { animate(e.target); obs.unobserve(e.target); }
        });
      }, { threshold: 0.4 });
      nums.forEach(function (el) { obs.observe(el); });
      setTimeout(function () { nums.forEach(function (el) { el.textContent = el.getAttribute('data-count'); }); }, 1600);
    } else {
      nums.forEach(function (el) { el.textContent = el.getAttribute('data-count'); });
    }
  })();

  /* ---- Flip card (klik untuk membalik) ---- */
  (function () {
    document.querySelectorAll('[data-flip]').forEach(function (card) {
      card.addEventListener('click', function (e) {
        if (e.target.closest('a')) return;
        card.classList.toggle('flipped');
      });
    });
  })();

  /* ---- Carousel: halaman, dots, arrows, autoplay, swipe ---- */
  (function () {
    var track = document.getElementById('ekTrack');
    if (!track) return;
    var pages = track.children;
    if (!pages.length) return;
    var total = pages.length;
    var idx = 0;
    var dotsWrap = document.getElementById('ekDots');
    var counter = document.getElementById('ekCounter');
    var totalEl = document.getElementById('ekTotal');
    var prevBtn = document.getElementById('ekPrev');
    var nextBtn = document.getElementById('ekNext');
    var timer = null;
    var dragging = false, startX = 0, moved = false;

    if (totalEl) totalEl.textContent = total;

    function goTo(i) {
      idx = (i + total) % total;
      track.style.transform = 'translateX(-' + (idx * 100) + '%)';
      var dots = dotsWrap ? dotsWrap.children : [];
      for (var d = 0; d < dots.length; d++) dots[d].classList.toggle('active', d === idx);
      if (counter) counter.textContent = idx + 1;
      if (prevBtn) prevBtn.disabled = idx === 0;
      if (nextBtn) nextBtn.disabled = idx === total - 1;
    }

    /* dots */
    if (dotsWrap) {
      for (var i = 0; i < total; i++) {
        var b = document.createElement('button');
        b.className = 'ek-dot' + (i === 0 ? ' active' : '');
        b.setAttribute('aria-label', 'Halaman ' + (i + 1));
        (function (n) {
          b.addEventListener('click', function () { stopAuto(); goTo(n); startAuto(); });
        })(i);
        dotsWrap.appendChild(b);
      }
    }

    /* arrows */
    if (prevBtn) prevBtn.addEventListener('click', function () { stopAuto(); goTo(idx - 1); startAuto(); });
    if (nextBtn) nextBtn.addEventListener('click', function () { stopAuto(); goTo(idx + 1); startAuto(); });

    /* autoplay 6 detik — berhenti saat hover/touch */
    function startAuto() {
      stopAuto();
      timer = setInterval(function () { goTo(idx + 1); }, 6000);
    }
    function stopAuto() { if (timer) { clearInterval(timer); timer = null; } }
    var viewport = track.parentElement;
    viewport.addEventListener('mouseenter', stopAuto);
    viewport.addEventListener('mouseleave', startAuto);
    viewport.addEventListener('touchstart', function () { stopAuto(); }, { passive: true });
    viewport.addEventListener('touchend', function () { startAuto(); }, { passive: true });

    /* swipe / drag */
    viewport.addEventListener('mousedown', function (e) {
      dragging = true; moved = false; startX = e.pageX;
      viewport.style.cursor = 'grabbing';
    });
    window.addEventListener('mousemove', function (e) {
      if (!dragging) return;
      if (Math.abs(e.pageX - startX) > 12) moved = true;
    });
    window.addEventListener('mouseup', function (e) {
      if (!dragging) return;
      dragging = false;
      viewport.style.cursor = '';
      var dx = e.pageX - startX;
      if (moved && Math.abs(dx) > 45) { stopAuto(); goTo(dx < 0 ? idx + 1 : idx - 1); startAuto(); }
    });
    viewport.addEventListener('touchstart', function (e) {
      moved = false; startX = e.touches[0].pageX;
    }, { passive: true });
    viewport.addEventListener('touchend', function (e) {
      var dx = e.changedTouches[0].pageX - startX;
      if (Math.abs(dx) > 45) { stopAuto(); goTo(dx < 0 ? idx + 1 : idx - 1); startAuto(); }
    }, { passive: true });

    goTo(0);
    startAuto();
  })();
</script>
@endpush