@extends('layouts.app')

@section('title', 'Ekstrakurikuler — SMK Negeri 2 Mojokerto')
@section('description', 'Ekstrakurikuler dan organisasi siswa SMK Negeri 2 Mojokerto — Banjari, Basket, Voli, BTQ, Futsal, Jurnalistik, Paskib, Pramuka, Tari, PENA, Silat, PMR, PIK-R, OSIS, Lacurva, dan Pasus.')

@push('styles')
<style>
/* =========================================================
   EKSTRAKURIKULER — SKANEDA ACTIVITY EXPLORER
   Hero: 100% senada Karya Siswa (light theme, watermark
   typography, ornamen abstrak, judul besar bertumpuk).
   Header & footer dari layouts.app (identik, tidak diubah).
   Konten baru: filter kategori interaktif + grid kartu
   "reveal panel" (bukan carousel flip lagi) — lebih mudah
   dijelajahi, lebih informatif, tampilan lebih premium & unik.
   Warna: navy #0d3a66, biru #2f6fa8, putih, gold #ffd54a/#ffb300.
   ========================================================= */
.ek-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}
.ek-page *{box-sizing:border-box}

/* ---------- HERO (identik gaya Karya Siswa) ---------- */
.ek-hero{position:relative;min-height:clamp(560px,72vh,740px);display:flex;align-items:center;overflow:hidden;
  background:#fff;color:#0d3a66;isolation:isolate}
.ek-hero::after{content:"EKSTRAKURIKULER";position:absolute;z-index:0;left:2%;top:58%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(3.4rem,11.5vw,11.5rem);font-weight:900;line-height:.78;
  letter-spacing:.01em;color:rgba(13,58,102,.035);-webkit-text-stroke:1px rgba(255,122,0,.09);
  pointer-events:none;white-space:nowrap;user-select:none}
.ek-ref-ornaments{position:absolute!important;inset:0;z-index:1;overflow:hidden;pointer-events:none;opacity:1}
.ek-ref-ornament-image{position:absolute!important;inset:0;width:100%;height:100%;display:block;
  object-fit:cover;object-position:center center;max-width:none;opacity:1}
.ek-hero-inner{position:relative;z-index:4;width:100%;max-width:1500px;margin:0 auto;
  padding:clamp(3.6rem,9vh,6rem) clamp(1.25rem,4.2vw,4.5rem) clamp(3.2rem,7vh,5rem);display:block}

.ek-kicker{position:relative;z-index:5;display:inline-flex;align-items:center;gap:.65rem;font-size:.72rem;
  font-weight:900;letter-spacing:.18em;text-transform:uppercase;color:#ff6f00;margin-bottom:1.2rem;
  padding:.55rem .85rem;border:1px solid rgba(255,111,0,.18);border-radius:999px;background:#fffaf5}
.ek-kicker::before{content:"";width:9px;height:9px;border-radius:50%;background:#ff6f00;
  box-shadow:0 0 0 6px rgba(255,111,0,.10)}

.ek-title{position:relative;z-index:5;font-family:var(--font-display);font-size:clamp(3.6rem,9vw,8rem);
  line-height:.86;letter-spacing:-.03em;margin:0;max-width:900px;text-transform:uppercase;
  text-shadow:none;animation:hdFadeUp .7s .1s var(--ease, ease) both}
.ek-title .ek-white{color:#0d3a66;display:block}
.ek-title .ek-gold{display:block;
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent;
  text-shadow:none;letter-spacing:-.02em}
.ek-lead{position:relative;z-index:5;font-size:1rem;line-height:1.8;color:#52657a;max-width:640px;
  margin:1.6rem 0 0;animation:hdFadeUp .7s .26s var(--ease, ease) both}
.ek-hero-meta{position:relative;z-index:5;display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;
  animation:hdFadeUp .7s .4s var(--ease, ease) both}
.ek-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;
  border:1px solid rgba(13,58,102,.12);background:#fff;border-radius:999px;color:#0d3a66;
  font-size:.72rem;font-weight:800;box-shadow:0 8px 24px rgba(13,58,102,.06)}
.ek-pill i{color:#ff7a00}

@media(min-width:1050px){.ek-hero-inner{padding-right:40%}}
@media(max-width:1050px){.ek-hero-inner{padding-right:1.25rem}.ek-ref-ornaments{opacity:.72}}
@media(max-width:900px){.ek-title{font-size:clamp(3.2rem,10.5vw,6rem)}.ek-ref-ornament-image{opacity:.88}}
@media(max-width:700px){.ek-hero{align-items:flex-start;min-height:0}
  .ek-hero-inner{width:90%;padding:clamp(3rem,8vh,4.5rem) 5% 3.2rem}
  .ek-hero::after{font-size:clamp(3.2rem,20vw,5.4rem);opacity:.6;left:-2%}
  .ek-title{font-size:clamp(2.6rem,12vw,3.8rem)}}
@media(max-width:560px){.ek-ref-ornament-image{opacity:.62}}

/* ---------- HOME-ORN (ornamen geometris, identik sistem situs) ---------- */
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
.ek-explore .home-orn .ho-chevron{right:-150px;top:-40px}
.ek-explore .home-orn .ho-dots{left:5%;bottom:120px}
.ek-explore .home-orn .ho-ring{right:6%;bottom:60px}
.ek-explore .home-orn .ho-square{right:14%;top:18%}
.ek-explore .home-orn .ho-gold{left:12%;top:34%}
.ek-cta-wrap .home-orn .ho-chevron{left:-120px;bottom:-80px}
.ek-cta-wrap .home-orn .ho-dots{left:8%;top:30%;opacity:.22}
.ek-cta-wrap .home-orn .ho-ring{right:-70px;top:20%}
.ek-cta-wrap .home-orn .ho-gold{left:20%;bottom:26%}

.ek-intro>*:not(.home-orn),
.ek-stats>*:not(.home-orn),
.ek-explore>*:not(.home-orn),
.ek-cta-wrap>*:not(.home-orn){position:relative;z-index:2}

/* ---------- Reveal ---------- */
[data-reveal]{opacity:0;transform:translateY(30px);transition:opacity .7s var(--ease,ease),transform .7s var(--ease,ease)}
[data-reveal="left"]{transform:translateX(-36px)}
[data-reveal="right"]{transform:translateX(36px)}
[data-reveal].revealed{opacity:1;transform:none}
[data-reveal]{transition-delay:calc(var(--d,0)*80ms)}
@media (prefers-reduced-motion:reduce){
  [data-reveal]{opacity:1;transform:none;transition:none}
  .ek-title,.ek-lead,.ek-hero-meta{animation:none!important}
}

/* ---------- SECTION SHELL & HEADING ---------- */
.ek-section{width:min(1180px,92%);margin:0 auto}
.ek-eyebrow{display:inline-flex;align-items:center;gap:.65rem;font-size:.74rem;font-weight:800;
  letter-spacing:.2em;text-transform:uppercase;color:#b98a12;margin-bottom:1rem}
.ek-eyebrow::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ffb300)}
.ek-stats .ek-eyebrow{color:#ffd54a}
.big-heading{font-family:var(--font-display);font-size:clamp(2.2rem,4.6vw,3.6rem);font-weight:800;
  line-height:1.16;letter-spacing:.01em;margin:0;color:#0d3a66;text-transform:uppercase}
.big-heading span{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 60%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.ek-stats .big-heading{color:#fff}
.ek-desc{font-size:.94rem;line-height:1.85;color:#718396;max-width:560px;margin-top:1.1rem}
.ek-stats .ek-desc{color:rgba(235,245,253,.75)}

/* ---------- 1. INTRO (editorial 2 kolom) ---------- */
.ek-intro{position:relative;padding:96px 0 100px;background:#fff}
.ek-intro-grid{display:grid;grid-template-columns:.95fr 1.05fr;gap:4.5rem;align-items:center}
.ek-intro-note{max-width:440px;color:#718396;font-size:.86rem;line-height:1.85;margin-top:1rem}
.ek-mini-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-top:2.2rem}
.ek-mini{position:relative;background:#f3f7fb;border:1px solid #e3edf0;border-radius:18px;padding:1.1rem 1rem;text-align:center;
  transition:transform .35s var(--ease, ease),box-shadow .35s var(--ease, ease)}
.ek-mini:hover{transform:translateY(-6px);box-shadow:0 16px 36px rgba(13,58,102,.10)}
.ek-mini b{display:block;font-family:var(--font-display);font-size:1.7rem;font-weight:900;line-height:1;color:#0d3a66}
.ek-mini b em{font-style:normal;color:#ffb300}
.ek-mini span{display:block;font-size:.68rem;font-weight:800;letter-spacing:.07em;text-transform:uppercase;color:#718396;margin-top:.45rem}

.ek-intro-visual{position:relative;border-radius:24px;overflow:hidden;box-shadow:0 30px 70px rgba(13,58,102,.18);border:1px solid rgba(255,179,0,.35)}
.ek-intro-visual img{width:100%;height:420px;object-fit:cover;display:block}
.ek-intro-visual::after{content:"";position:absolute;inset:0;background:linear-gradient(200deg,rgba(7,22,42,.05) 0%,rgba(13,58,102,.52) 100%)}
.ek-intro-cap{position:absolute;z-index:2;left:1.4rem;right:1.4rem;bottom:1.2rem;color:#fff}
.ek-intro-cap strong{display:block;font-family:var(--font-display);font-size:1.25rem;font-weight:700}
.ek-intro-cap span{font-size:.74rem;color:rgba(255,255,255,.78)}
.ek-intro-badge{position:absolute;z-index:3;top:1.2rem;left:1.2rem;display:inline-flex;align-items:center;gap:.45rem;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;font-size:.7rem;font-weight:900;
  letter-spacing:.1em;text-transform:uppercase;padding:.5rem .8rem;border-radius:999px;box-shadow:0 10px 24px rgba(255,179,0,.35)}

/* ---------- 2. STATS band ---------- */
.ek-stats{background:#0d3a66;color:#fff;position:relative;padding:96px 0}
.ek-stats-head{display:flex;align-items:flex-end;justify-content:space-between;gap:2rem;flex-wrap:wrap;margin-bottom:3rem}
.ek-stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.4rem}
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

/* ---------- 3. EXPLORER (fitur utama: filter kategori + kartu reveal-panel) ---------- */
.ek-explore{position:relative;padding:100px 0 110px;
  background-image:radial-gradient(rgba(13,58,102,.05) 1.4px,transparent 1.5px);background-size:22px 22px}
.ek-explore-head{display:flex;justify-content:space-between;align-items:flex-end;gap:2rem;flex-wrap:wrap}

/* filter chips */
.ek-filters{display:flex;flex-wrap:wrap;gap:.6rem;margin-top:2.4rem}
.ek-filter{display:inline-flex;align-items:center;gap:.5rem;padding:.62rem 1.05rem;border-radius:999px;
  border:1px solid #e3edf0;background:#fff;font-size:.76rem;font-weight:800;color:#48688a;cursor:pointer;
  transition:all .3s var(--ease,ease);white-space:nowrap}
.ek-filter .ek-filter-count{display:inline-flex;align-items:center;justify-content:center;min-width:18px;height:18px;
  padding:0 .3rem;border-radius:999px;background:rgba(13,58,102,.08);color:#48688a;font-size:.64rem;font-weight:900}
.ek-filter:hover{border-color:rgba(255,179,0,.5);transform:translateY(-2px)}
.ek-filter.active{background:linear-gradient(135deg,#0d3a66,#123f6e);border-color:#0d3a66;color:#fff;
  box-shadow:0 14px 30px rgba(13,58,102,.22)}
.ek-filter.active .ek-filter-count{background:rgba(255,213,74,.22);color:#ffd54a}

.ek-count-line{display:flex;align-items:center;gap:.5rem;margin-top:1.6rem;font-size:.8rem;font-weight:700;color:#718396}
.ek-count-line b{color:#0d3a66;font-family:var(--font-display);font-weight:900}

/* kartu grid — INSTAGRAM FEED STYLE */
.ek-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.75rem;margin-top:2.2rem}
.ek-item{transition:opacity .35s var(--ease,ease),transform .35s var(--ease,ease)}
.ek-item.ek-hidden{display:none}

.ek-card{position:relative;display:flex;flex-direction:column;background:#fff;border-radius:18px;
  border:1px solid rgba(13,58,102,.08);box-shadow:0 10px 26px rgba(13,58,102,.06);overflow:hidden;
  cursor:pointer;-webkit-tap-highlight-color:transparent;
  transition:transform .3s var(--ease,ease),box-shadow .3s var(--ease,ease)}
.ek-card:hover{transform:translateY(-4px);box-shadow:0 20px 42px rgba(13,58,102,.14)}

/* header ala akun Instagram */
.ek-card-head{display:flex;align-items:center;gap:.65rem;padding:.85rem .95rem}
.ek-card-avatar{flex:0 0 38px;width:38px;height:38px;border-radius:50%;display:flex;align-items:center;justify-content:center;
  background:#fff;color:#0d3a66;box-shadow:0 4px 12px rgba(13,58,102,.18);border:1px solid rgba(13,58,102,.08);overflow:hidden}
.ek-card-avatar img{width:100%;height:100%;object-fit:cover;display:block}
.ek-card-idwrap{display:flex;flex-direction:column;line-height:1.25;min-width:0}
.ek-card-uname{font-size:.86rem;font-weight:800;color:#0d3a66;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.ek-card-usub{font-size:.64rem;font-weight:700;letter-spacing:.04em;color:#93a4b8;text-transform:uppercase}
.ek-card-menu{margin-left:auto;flex:0 0 auto;color:#b7c3d2;display:flex}
.ek-card-menu svg{width:18px;height:18px}

/* foto kegiatan 1:1 (feed) */
.ek-card-media{position:relative;aspect-ratio:1/1;overflow:hidden;background:#eef3f8}
.ek-card-media img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block;
  transition:transform .6s var(--ease,ease)}
.ek-card-media::after{content:"";position:absolute;inset:0;background:rgba(7,22,42,.12);opacity:0;
  transition:opacity .35s var(--ease,ease)}
.ek-card:hover .ek-card-media img{transform:scale(1.045)}
.ek-card:hover .ek-card-media::after{opacity:1}

/* action bar */
.ek-card-actions{display:flex;align-items:center;gap:.95rem;padding:.7rem .95rem .3rem}
.ek-act{display:inline-flex;color:#42597a;transition:color .25s var(--ease,ease),transform .25s var(--ease,ease)}
.ek-act svg{width:20px;height:20px}
.ek-act:hover{color:#ff7a00;transform:translateY(-1px)}
.ek-act-save{margin-left:auto}

/* konten post */
.ek-card-panel{padding:.35rem .95rem 1.05rem}
.ek-card-caption{margin:0;font-size:.82rem;line-height:1.55;color:#3a4b60;
  display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.ek-card-caption .ek-card-name{font-weight:800;color:#0d3a66;margin-right:.35rem}
.ek-card-metaline{display:flex;align-items:center;flex-wrap:wrap;gap:.55rem;margin-top:.65rem}
.ek-card-tag{display:inline-flex;font-size:.62rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;
  color:#0d3a66;background:linear-gradient(135deg,#fff3d6,#ffe4a8);padding:.32rem .62rem;border-radius:999px}
.ek-card-sched{display:inline-flex;align-items:center;gap:.35rem;font-size:.72rem;font-weight:700;color:#718396}
.ek-card-sched svg{width:13px;height:13px;color:#ff9800;flex:0 0 13px}
.ek-card-more{display:inline-flex;align-items:center;gap:.32rem;margin-top:.7rem;font-size:.74rem;font-weight:800;
  color:#0d3a66;letter-spacing:.02em;transition:color .25s var(--ease,ease)}
.ek-card-more svg{width:12px;height:12px;transition:transform .3s var(--ease,ease)}
.ek-card:hover .ek-card-more,.ek-card.open .ek-card-more{color:#ff7a00}
.ek-card.open .ek-card-more svg{transform:rotate(180deg)}

/* panel detail (Pembina / Latihan / Kegiatan) — tetap dibuka lewat klik, tidak diubah datanya */
.ek-card-detail{max-height:0;overflow:hidden;opacity:0;transition:max-height .5s var(--ease,ease),opacity .4s var(--ease,ease) .05s,margin-top .5s var(--ease,ease)}
.ek-card.open .ek-card-detail{max-height:220px;opacity:1;margin-top:.7rem}
.ek-card-meta{list-style:none;margin:0;padding:.75rem 0 0;border-top:1px dashed rgba(13,58,102,.14);display:grid;gap:.4rem}
.ek-card-meta li{display:flex;align-items:flex-start;gap:.45rem;font-size:.72rem;line-height:1.5;color:#5b6d82}
.ek-card-meta li svg{width:12px;height:12px;flex:0 0 12px;margin-top:.2rem;color:#ff9800}
.ek-card-meta li b{color:#0d3a66;font-weight:800}

/* ---------- 4. CTA (kartu kontras, senada CTA lain di situs) ---------- */
.ek-cta-wrap{position:relative;width:min(1180px,92%);margin:0 auto 5.5rem;padding:64px 5% 68px;text-align:center;
  border-radius:28px;overflow:hidden;color:#fff;
  background:linear-gradient(135deg,#0a2d52,#0d3a66 55%,#123f6e);
  box-shadow:0 34px 80px rgba(13,58,102,.35)}
.ek-cta-wrap::before{content:"";position:absolute;left:0;right:0;top:0;height:4px;
  background:linear-gradient(90deg,#ffd54a,#ffb300)}
.ek-cta-title{font-family:var(--font-display);font-size:clamp(1.7rem,3.6vw,2.7rem);font-weight:800;margin:0 auto;
  line-height:1.2;max-width:720px}
.ek-cta-title em{font-style:normal;background:linear-gradient(135deg,#ffe66d,#ffc107 55%,#ff8a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.ek-cta-wrap p{max-width:560px;margin:1.1rem auto 1.9rem;font-size:.92rem;line-height:1.85;color:rgba(235,245,253,.85)}
.ek-cta-btn{display:inline-flex;align-items:center;gap:.6rem;padding:.95rem 2rem;border-radius:999px;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52;font-weight:800;font-size:.92rem;
  text-decoration:none;box-shadow:0 16px 36px rgba(255,179,0,.32);transition:transform .3s var(--ease, ease),box-shadow .3s var(--ease, ease)}
.ek-cta-btn:hover{transform:translateY(-3px);box-shadow:0 22px 46px rgba(255,179,0,.42)}
.ek-cta-note{margin-top:1.1rem;font-size:.76rem;color:rgba(235,245,253,.65)}
.ek-cta-note i{color:#ffd54a;margin-right:.4rem}

/* ---------- RESPONSIVE ---------- */
@media(max-width:1200px){.ek-stats-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:950px){.ek-intro-grid{grid-template-columns:1fr;gap:3rem}.ek-intro-visual img{height:320px}
  .ek-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:700px){
  .ek-intro,.ek-explore{padding:85px 0 90px}
  .ek-stats{padding:80px 0}
  .ek-mini-stats{grid-template-columns:1fr 1fr 1fr;gap:.6rem}
  .ek-stats-grid{grid-template-columns:1fr 1fr;gap:.9rem}
  .ek-stat{padding:1.4rem 1rem}
  .ek-grid{grid-template-columns:1fr;gap:1.15rem;max-width:420px;margin-left:auto;margin-right:auto}
  .ek-card-uname{font-size:.82rem}
  .ek-card-caption{font-size:.8rem}
  .ek-card-meta li{font-size:.68rem}
  .ek-cta-wrap{padding:56px 5% 64px;width:92%}
  .home-orn .ho-chevron{width:220px;height:220px}
  .home-orn .ho-dots{width:80px;height:80px;background-size:14px 14px}
  .home-orn .ho-ring{width:110px;height:110px}
  .home-orn .ho-line{width:190px}
  .home-orn .ho-square{width:42px;height:42px}
  .home-orn .ho-corner{width:70px;height:70px}
}
</style>
@endpush

@section('content')
<div class="ek-page">

  <!-- HERO (senada 100% dengan hero Karya Siswa) -->
  <section class="ek-hero">
    <div class="ek-ref-ornaments" aria-hidden="true" style="background-image:url('{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}');background-size:cover;background-position:center center;">
      <img
        src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}"
        alt=""
        class="ek-ref-ornament-image"
        aria-hidden="true"
      >
    </div>
    <div class="ek-hero-inner">
      <div>
        <div class="ek-kicker">Kegiatan Non-Akademik Peserta Didik</div>
        <h1 class="ek-title">
          <span class="ek-white">Ekstra</span>
          <span class="ek-gold">Kurikuler</span>
        </h1>
        </div>
      </div>
    </div>
  </section>

  <!-- 1. PENGANTAR -->
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
        <h2 class="big-heading">Bakat tak berhenti, <span>di luar kelas.</span></h2>
        <p class="ek-intro-note">Ekstrakurikuler adalah laboratorium karakter Skaneda. Lewat kegiatan rutin, pembinaan intensif, dan ajang kompetisi, peserta didik belajar disiplin, kerja sama, kepemimpinan, serta keberanian untuk tampil — bekal yang tidak kalah penting dari keterampilan vokasi.</p>
        <div class="ek-mini-stats">
          <div class="ek-mini" data-reveal>
            <b><em>13</em></b>
            <span>Ekstrakurikuler</span>
          </div>
          <div class="ek-mini" data-reveal style="--d:1">
            <b>3</b>
            <span>Organisasi Siswa</span>
          </div>
          <div class="ek-mini" data-reveal style="--d:2">
            <b><em>16</em></b>
            <span>Wadah Kegiatan</span>
          </div>
        </div>
      </div>
      <div data-reveal="right">
        <div class="ek-intro-visual">
          <span class="ek-intro-badge"><i class="fas fa-camera"></i> #SkanedaBerkarakter</span>
          <img src="{{ asset('images/ekstra/paskibra.jpeg') }}" alt="Pasukan pengibar bendera SMK Negeri 2 Mojokerto" loading="eager">
          <div class="ek-intro-cap"><strong>Skaneda Berkarakter</strong><span>Latihan Paskibra — kedisiplinan baris-berbaris.</span></div>
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
          <h2 class="big-heading">Ruang <span>Bertumbuh</span></h2>
        </div>
        <p class="ek-desc">Kegiatan ekstrakurikuler Skaneda diikuti lintas jurusan — setiap minggu, ratusan peserta didik berlatih dan berkarya di luar jam belajar.</p>
      </div>
      <div class="ek-stats-grid">
        <div class="ek-stat" data-reveal>
          <div class="ek-stat-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76" fill="currentColor" stroke="none"/></svg>
          </div>
          <b><em data-count="13">0</em></b>
          <span>Ekstrakurikuler</span>
          <p>Beragam kegiatan untuk mengembangkan bakat, minat, karakter, dan prestasi siswa.</p>
        </div>
        <div class="ek-stat" data-reveal style="--d:1">
          <div class="ek-stat-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
          </div>
          <b><em data-count="16">0</em></b>
          <span>Wadah Kegiatan</span>
          <p>Ekstrakurikuler dan organisasi siswa yang menjadi ruang belajar di luar kelas.</p>
        </div>
        <div class="ek-stat" data-reveal style="--d:2">
          <div class="ek-stat-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 010-5H6"/><path d="M18 9h1.5a2.5 2.5 0 000-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0012 0V2z"/></svg>
          </div>
          <b><em data-count="20">0</em>+</b>
          <span>Prestasi</span>
          <p>Ruang tumbuh untuk meraih prestasi di berbagai bidang.</p>
        </div>
        <div class="ek-stat" data-reveal style="--d:3">
          <div class="ek-stat-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3 6 6 .9-4.5 4.2 1.1 6.4L12 16.7 6.4 19.5l1.1-6.4L3 8.9 9 8z"/></svg>
          </div>
          <b>8</b>
          <span>Bidang Kegiatan</span>
          <p>Olahraga, seni, keagamaan, kepemimpinan, kesehatan, media, dan lainnya.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. EXPLORER: filter kategori + grid kartu (fitur utama, baru) -->
  <section class="ek-explore" id="ek-explore">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span><span class="ho-dots"></span><span class="ho-ring"></span><span class="ho-square"></span><span class="ho-gold"></span>
    </div>
    <div class="ek-section">
      <div class="ek-explore-head" data-reveal>
        <div>
          <span class="ek-eyebrow">Jelajahi Ekstrakurikuler</span>
          <h2 class="big-heading">Pilih <span>Wadahmu</span></h2>
          <p class="ek-desc">Temukan kegiatan yang sesuai dengan minatmu. Klik kategori untuk menyaring dan klik kartu untuk melihat detail kegiatan.</p>
        </div>
      </div>

      <div class="ek-filters" id="ekFilters" data-reveal>
        <button class="ek-filter active" data-filter="semua" type="button">Semua <span class="ek-filter-count">13</span></button>
        <button class="ek-filter" data-filter="Keagamaan" type="button">Keagamaan <span class="ek-filter-count">2</span></button>
        <button class="ek-filter" data-filter="Olahraga" type="button">Olahraga <span class="ek-filter-count">3</span></button>
        <button class="ek-filter" data-filter="Media & Literasi" type="button">Media & Literasi <span class="ek-filter-count">1</span></button>
        <button class="ek-filter" data-filter="Kedisiplinan" type="button">Kedisiplinan <span class="ek-filter-count">1</span></button>
        <button class="ek-filter" data-filter="Kepanduan" type="button">Kepanduan <span class="ek-filter-count">1</span></button>
        <button class="ek-filter" data-filter="Seni & Budaya" type="button">Seni & Budaya <span class="ek-filter-count">2</span></button>
        <button class="ek-filter" data-filter="Bela Diri" type="button">Bela Diri <span class="ek-filter-count">1</span></button>
        <button class="ek-filter" data-filter="Kesehatan" type="button">Kesehatan <span class="ek-filter-count">2</span></button>
      </div>
      <p class="ek-count-line" id="ekCountLine"><b id="ekCountNum">13</b> ekstrakurikuler ditemukan</p>

      <div class="ek-grid" id="ekGrid">
        <!-- 1. BANJARI -->
        <div class="ek-item" data-category="Keagamaan" data-reveal>
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">Banjari</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/banjari.jpg') }}" alt="Kegiatan Banjari SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">Banjari</span>Mengembangkan seni musik Islami melalui lantunan shalawat, kekompakan, dan penampilan dalam kegiatan sekolah.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Keagamaan</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Jumat</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina kegiatan keagamaan</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Jumat</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Latihan vokal, rebana, shalawat, dan penampilan sekolah</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
        <!-- 2. BASKET -->
        <div class="ek-item" data-category="Olahraga" data-reveal style="--d:1">
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">Basket</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/basket.jpg') }}" alt="Kegiatan Basket SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">Basket</span>Melatih teknik permainan, kebugaran, sportivitas, dan kerja sama tim melalui latihan serta pertandingan pelajar.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Olahraga</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Selasa & Jumat</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina olahraga sekolah</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Selasa & Jumat</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Latihan teknik, sparing, dan turnamen pelajar</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
        <!-- 3. BOLA VOLI -->
        <div class="ek-item" data-category="Olahraga" data-reveal style="--d:2">
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">Bola Voli</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/voly.jpg') }}" alt="Kegiatan Bola Voli SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">Bola Voli</span>Membangun kekompakan tim melalui latihan teknik dasar, strategi permainan, dan kompetisi antarpelajar.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Olahraga</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Kamis & Sabtu</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina olahraga sekolah</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Kamis & Sabtu</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Passing, servis, smash, sparing, dan turnamen</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
        <!-- 4. BTQ -->
        <div class="ek-item" data-category="Keagamaan" data-reveal style="--d:3">
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">BTQ</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/btq.jpg') }}" alt="Kegiatan BTQ SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">BTQ</span>Meningkatkan kemampuan membaca Al-Qur’an dengan baik serta membangun kebiasaan belajar agama secara rutin.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Keagamaan</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Jumat</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina kegiatan keagamaan</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Jumat</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Tilawah, tahsin, hafalan, dan pembinaan keagamaan</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
        <!-- 5. FUTSAL -->
        <div class="ek-item" data-category="Olahraga" data-reveal style="--d:4">
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">Futsal</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/futsal.jpg') }}" alt="Kegiatan Futsal SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">Futsal</span>Mengasah kecepatan, strategi, disiplin, dan kerja sama tim melalui latihan futsal dan pertandingan pelajar.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Olahraga</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Senin & Rabu</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina olahraga sekolah</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Senin & Rabu</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Latihan teknik, sparing, dan turnamen antarsekolah</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
        <!-- 6. JURNALISTIK -->
        <div class="ek-item" data-category="Media & Literasi" data-reveal style="--d:5">
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">Jurnalistik</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/jurnalistik.jpg') }}" alt="Kegiatan Jurnalistik SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">Jurnalistik</span>Menjadi ruang bagi siswa untuk menulis, meliput kegiatan sekolah, mengolah informasi, dan menghasilkan karya media.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Media & Literasi</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Rabu</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina jurnalistik sekolah</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Rabu</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Menulis berita, wawancara, fotografi, dan publikasi sekolah</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
        <!-- 7. PASKIB -->
        <div class="ek-item" data-category="Kedisiplinan" data-reveal style="--d:0">
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">Paskib</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/paskibra.jpg') }}" alt="Kegiatan Paskib SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">Paskib</span>Membentuk kedisiplinan, keteguhan, tanggung jawab, dan kekompakan melalui latihan baris-berbaris.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Kedisiplinan</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Rabu & Sabtu</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina Paskib sekolah</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Rabu & Sabtu</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> PBB, formasi, upacara, dan kegiatan kebangsaan</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
        <!-- 8. PRAMUKA -->
        <div class="ek-item" data-category="Kepanduan" data-reveal style="--d:1">
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">Pramuka</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/pramuka.jpg') }}" alt="Kegiatan Pramuka SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">Pramuka</span>Membentuk kemandirian, kepemimpinan, kepedulian lingkungan, dan keterampilan melalui kegiatan kepanduan.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Kepanduan</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Jumat</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina Pramuka sekolah</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Jumat</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Latihan kepramukaan, kemah, keterampilan, dan kegiatan sosial</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
        <!-- 9. TARI -->
        <div class="ek-item" data-category="Seni & Budaya" data-reveal style="--d:2">
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">Tari</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/tari.jpg') }}" alt="Kegiatan Tari SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">Tari</span>Melestarikan budaya melalui tari tradisional dan kreasi serta memberikan ruang untuk tampil dan berkarya.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Seni & Budaya</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Rabu & Sabtu</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina seni sekolah</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Rabu & Sabtu</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Latihan tari tradisional, tari kreasi, dan pentas seni</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
        <!-- 10. PENA -->
        <div class="ek-item" data-category="Seni & Budaya" data-reveal style="--d:3">
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">PENA</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/pena.jpg') }}" alt="Kegiatan PENA SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">PENA</span>Wadah mini teater untuk melatih ekspresi, kepercayaan diri, penulisan naskah, dan kemampuan tampil di depan publik.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Seni & Budaya</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Kamis</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina seni dan teater sekolah</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Kamis</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Latihan akting, olah vokal, naskah, dan pementasan</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
        <!-- 11. SILAT -->
        <div class="ek-item" data-category="Bela Diri" data-reveal style="--d:4">
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">Silat</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/silat.jpg') }}" alt="Kegiatan Silat SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">Silat</span>Melatih bela diri, ketahanan fisik, kedisiplinan, dan sikap percaya diri melalui latihan pencak silat.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Bela Diri</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Selasa & Kamis</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina bela diri sekolah</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Selasa & Kamis</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Teknik dasar, jurus, sparing, dan kejuaraan</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
        <!-- 12. PMR -->
        <div class="ek-item" data-category="Kesehatan" data-reveal style="--d:5">
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">PMR</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/pmr.jpg') }}" alt="Kegiatan PMR SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">PMR</span>Membekali siswa dengan kepedulian kemanusiaan, pertolongan pertama, dan kesiapsiagaan dalam kegiatan sekolah.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Kesehatan</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Sabtu</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina PMR sekolah</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Sabtu</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> P3K, kesehatan remaja, kegiatan sosial, dan siaga bencana</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
        <!-- 13. PIK-R -->
        <div class="ek-item" data-category="Kesehatan" data-reveal style="--d:0">
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">PIK-R</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/pik-r.jpg') }}" alt="Kegiatan PIK-R SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">PIK-R</span>Menjadi ruang edukasi dan konseling sebaya untuk membangun remaja yang sehat, bertanggung jawab, dan berencana.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Kesehatan</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Kamis</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina PIK-R sekolah</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Kamis</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Edukasi remaja, konseling sebaya, kampanye kesehatan, dan kegiatan sosial</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
      </div>

      <div style="margin-top:5.5rem" data-reveal>
        <span class="ek-eyebrow">Organisasi Siswa</span>
        <h2 class="big-heading">Bersama <span>Berkarya</span></h2>
        <p class="ek-desc">Organisasi siswa menjadi ruang untuk belajar memimpin, bekerja sama, berinisiatif, dan berkontribusi dalam kehidupan sekolah.</p>
      </div>
      <div class="ek-grid" id="ekOrgGrid">
        <!-- 1. OSIS -->
        <div class="ek-item" data-category="Organisasi" data-reveal>
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">OSIS</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/osis.jpg') }}" alt="Kegiatan OSIS SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">OSIS</span>Wadah utama kepemimpinan siswa untuk merancang dan menjalankan berbagai program kegiatan sekolah.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Organisasi</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Sesuai program kerja</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina OSIS sekolah</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Sesuai program kerja</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Program kerja siswa, kegiatan sekolah, kepemimpinan, dan bakti sosial</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
        <!-- 2. LACURVA -->
        <div class="ek-item" data-category="Organisasi" data-reveal style="--d:1">
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">Lacurva</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/lacurva.jpg') }}" alt="Kegiatan Lacurva SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">Lacurva</span>Komunitas suporter Skaneda yang membangun semangat, kreativitas, dan dukungan positif untuk kegiatan serta prestasi siswa.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Organisasi</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Sesuai agenda pertandingan</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina kegiatan siswa</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Sesuai agenda pertandingan</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Dukungan pertandingan, koreografi, kreativitas suporter, dan solidaritas</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
        <!-- 3. PASUS -->
        <div class="ek-item" data-category="Organisasi" data-reveal style="--d:2">
          <article class="ek-card" data-toggle>
            <div class="ek-card-head">
              <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
              <div class="ek-card-idwrap">
                <span class="ek-card-uname">Pasus</span>
                <span class="ek-card-usub">SMKN 2 Mojokerto</span>
              </div>
              <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
            </div>
            <div class="ek-card-media">
              <img src="{{ asset('images/ekstra/pasus.jpg') }}" alt="Kegiatan Pasus SMKN 2 Mojokerto" loading="eager">
            </div>
            <div class="ek-card-actions" aria-hidden="true">
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
              <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
              <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
            </div>
            <div class="ek-card-panel">
              <div class="ek-card-peek">
                <p class="ek-card-caption"><span class="ek-card-name">Pasus</span>Organisasi siswa yang menumbuhkan kedisiplinan, tanggung jawab, kekompakan, dan kesiapan membantu kegiatan sekolah.</p>
                <div class="ek-card-metaline">
                  <span class="ek-card-tag">Organisasi</span>
                  <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> Sesuai agenda sekolah</span>
                </div>
                <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </div>
              <div class="ek-card-detail">
                <ul class="ek-card-meta">
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> Pembina Pasus sekolah</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> Sesuai agenda sekolah</span></li>
                  <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> Pengamanan kegiatan, kedisiplinan, ketertiban, dan dukungan acara sekolah</span></li>
                </ul>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="ek-cta-wrap" data-reveal>
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
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

  /* ---- Kartu: klik/tap untuk membuka panel detail (desktop tetap bisa hover) ---- */
  (function () {
    document.querySelectorAll('[data-toggle]').forEach(function (card) {
      card.addEventListener('click', function () {
        var wasOpen = card.classList.contains('open');
        document.querySelectorAll('.ek-card.open').forEach(function (c) {
          if (c !== card) c.classList.remove('open');
        });
        card.classList.toggle('open', !wasOpen);
      });
    });
  })();

  /* ---- Filter kategori ---- */
  (function () {
    var filters = document.querySelectorAll('#ekFilters .ek-filter');
    var items = document.querySelectorAll('#ekGrid .ek-item');
    var countNum = document.getElementById('ekCountNum');
    if (!filters.length || !items.length) return;

    filters.forEach(function (btn) {
      btn.addEventListener('click', function () {
        filters.forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');
        var cat = btn.getAttribute('data-filter');
        var visible = 0;
        items.forEach(function (item) {
          var match = (cat === 'semua') || (item.getAttribute('data-category') === cat);
          item.classList.toggle('ek-hidden', !match);
          if (match) visible++;
        });
        if (countNum) countNum.textContent = visible;
      });
    });
  })();
</script>
@endpush