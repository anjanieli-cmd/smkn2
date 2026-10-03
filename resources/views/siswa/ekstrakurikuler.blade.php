@extends('layouts.app')

@section('title', 'Ekstrakurikuler — SMK Negeri 2 Mojokerto')
@section('description', 'Ekstrakurikuler dan organisasi siswa SMK Negeri 2 Mojokerto — Banjari, Basket, Voli, BTQ, Futsal, Jurnalistik, Paskib, Pramuka, Tari, PENA, Silat, PMR, PIK-R, OSIS, Lacurva, dan Pasus.')

@push('styles')
<style>
/* =========================================================
   EKSTRAKURIKULER — SKANEDA ACTIVITY EXPLORER
   Header & footer dari layouts.app (tidak diubah).
   Warna: navy #0d3a66, biru #2f6fa8, putih, gold #ffd54a/#ffb300.
   ========================================================= */
.ek-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}
.ek-page *{box-sizing:border-box}

/* ---------- HERO ---------- */
.ek-hero{position:relative;min-height:640px;display:flex;align-items:center;overflow:hidden;
  background:#fff;color:#0d3a66;isolation:isolate}
.ek-hero::after{content:"EKSTRAKURIKULER";position:absolute;z-index:0;left:2%;top:58%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(3.4rem,11.5vw,11.5rem);font-weight:900;line-height:.78;
  letter-spacing:.01em;color:rgba(13,58,102,.035);-webkit-text-stroke:1px rgba(255,122,0,.09);
  pointer-events:none;white-space:nowrap;user-select:none}
.ek-ref-ornaments{position:absolute!important;inset:0;z-index:1;overflow:hidden;pointer-events:none;opacity:1}
.ek-ref-ornament-image{position:absolute!important;inset:0;width:100%;height:100%;display:block;
  object-fit:cover;object-position:center center;max-width:none;opacity:1}
.ek-hero-inner{position:relative;z-index:4;width:100%;max-width:1600px;margin:0 auto;
  padding:clamp(5.5rem,12vh,8.5rem) clamp(1.5rem,4.2vw,4.5rem) clamp(5rem,10vh,7.5rem);display:block}

.ek-kicker{position:relative;z-index:5;display:inline-flex;align-items:center;gap:.65rem;font-size:.72rem;
  font-weight:900;letter-spacing:.18em;text-transform:uppercase;color:#ff6f00;margin-bottom:1.2rem;
  padding:.55rem .85rem;border:1px solid rgba(255,111,0,.18);border-radius:999px;background:#fffaf5}
.ek-kicker::before{content:"";width:9px;height:9px;border-radius:50%;background:#ff6f00;
  box-shadow:0 0 0 6px rgba(255,111,0,.10)}

.ek-title{position:relative;z-index:5;font-family:var(--font-display);font-size:clamp(3.2rem,7.5vw,6.4rem);
  line-height:.96;letter-spacing:-.02em;margin:0;max-width:900px;text-transform:uppercase;
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
@media(max-width:900px){.ek-title{font-size:clamp(2.8rem,9vw,5rem)}.ek-ref-ornament-image{opacity:.88}}
@media(max-width:700px){.ek-hero{align-items:flex-start;min-height:0}
  .ek-hero-inner{width:90%;padding:clamp(3rem,8vh,4.5rem) 5% 3.2rem}
  .ek-hero::after{font-size:clamp(3.2rem,20vw,5.4rem);opacity:.6;left:-2%}
  .ek-title{font-size:clamp(2.5rem,10.5vw,4.2rem)}}
@media(max-width:560px){.ek-ref-ornament-image{opacity:.62}}

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
.ek-section{width:min(1600px,94%);margin:0 auto}
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

/* ---------- 1. INTRO ---------- */
.ek-intro{position:relative;padding:120px 0 130px;background:#fff}
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

/* ---------- 2. STATS ---------- */
.ek-stats{background:#0d3a66;color:#fff;position:relative;padding:120px 0}
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

/* ---------- 3. EXPLORER ---------- */
.ek-explore{position:relative;padding:120px 0 140px;
  background-image:radial-gradient(rgba(13,58,102,.05) 1.4px,transparent 1.5px);background-size:22px 22px}
.ek-explore-head{display:flex;justify-content:space-between;align-items:flex-end;gap:2rem;flex-wrap:wrap}

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

/* kartu grid — INSTAGRAM FEED STYLE (CONSISTENT & UNIFORM) */
.ek-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:1.25rem;margin-top:2.2rem;width:100%}
.ek-item{display:flex;flex-direction:column;height:100%;min-width:0;transition:opacity .35s var(--ease,ease),transform .35s var(--ease,ease)}
.ek-item.ek-hidden{display:none}
.ek-empty{grid-column:1/-1;text-align:center;padding:2rem;color:#64748b}

.ek-card{position:relative;display:flex;flex-direction:column;width:100%;min-width:0;height:100%;flex:1 1 auto;background:#fff;border-radius:16px;
  border:1px solid rgba(13,58,102,.08);box-shadow:0 8px 22px rgba(13,58,102,.06);overflow:hidden;
  cursor:pointer;-webkit-tap-highlight-color:transparent;
  transition:transform .3s var(--ease,ease),box-shadow .3s var(--ease,ease)}
.ek-card:hover{transform:translateY(-4px);box-shadow:0 18px 36px rgba(13,58,102,.12)}

/* header ala akun Instagram (uniform height, zero-overflow flex) */
.ek-card-head{display:flex;align-items:center;gap:.45rem;padding:.55rem .75rem;height:48px;flex:0 0 48px;min-width:0}
.ek-card-avatar{flex:0 0 30px;width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;
  background:#fff;color:#0d3a66;box-shadow:0 3px 10px rgba(13,58,102,.14);border:1px solid rgba(13,58,102,.08);overflow:hidden}
.ek-card-avatar img{width:100%;height:100%;object-fit:cover;display:block}
.ek-card-idwrap{display:flex;flex-direction:column;line-height:1.2;min-width:0;flex:1 1 auto;overflow:hidden}
.ek-card-uname{font-size:.78rem;font-weight:800;color:#0d3a66;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;min-width:0}
.ek-card-usub{font-size:.58rem;font-weight:700;letter-spacing:.04em;color:#93a4b8;text-transform:uppercase;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;min-width:0}
.ek-card-menu{margin-left:auto;flex:0 0 auto;color:#b7c3d2;display:flex}
.ek-card-menu svg{width:15px;height:15px}

/* foto kegiatan 3:4 (portrait feed style) */
.ek-card-media{position:relative;aspect-ratio:3/4;width:100%;flex:0 0 auto;overflow:hidden;background:#eef3f8}
.ek-card-media img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block;
  transition:transform .6s var(--ease,ease)}
.ek-card-media::after{content:"";position:absolute;inset:0;background:rgba(7,22,42,.12);opacity:0;
  transition:opacity .35s var(--ease,ease)}
.ek-card:hover .ek-card-media img{transform:scale(1.045)}
.ek-card:hover .ek-card-media::after{opacity:1}

/* action bar */
.ek-card-actions{display:flex;align-items:center;gap:.7rem;padding:.45rem .75rem .2rem}
.ek-act{display:inline-flex;color:#42597a;transition:color .25s var(--ease,ease),transform .25s var(--ease,ease)}
.ek-act svg{width:17px;height:17px}
.ek-act:hover{color:#ff7a00;transform:translateY(-1px)}
.ek-act-save{margin-left:auto}

/* konten post (tanpa max-height buatan yang memotong teks) */
.ek-card-panel{padding:.45rem .75rem .85rem;flex:1 1 auto;display:flex;flex-direction:column;min-width:0}
.ek-card-caption{margin:0;font-size:.78rem;line-height:1.48;color:#3a4b60;
  display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.ek-card-caption .ek-card-name{font-weight:800;color:#0d3a66;margin-right:.3rem}
.ek-card-metaline{display:flex;align-items:center;flex-wrap:wrap;gap:.4rem;margin-top:auto;padding-top:.45rem}
.ek-card-tag{display:inline-flex;font-size:.56rem;font-weight:800;letter-spacing:.06em;text-transform:uppercase;
  color:#0d3a66;background:linear-gradient(135deg,#fff3d6,#ffe4a8);padding:.25rem .5rem;border-radius:999px}
.ek-card-sched{display:inline-flex;align-items:center;gap:.3rem;font-size:.66rem;font-weight:700;color:#718396}
.ek-card-sched svg{width:12px;height:12px;color:#ff9800;flex:0 0 12px}
.ek-card-more{display:inline-flex;align-items:center;gap:.28rem;margin-top:.55rem;font-size:.7rem;font-weight:800;
  color:#0d3a66;letter-spacing:.02em;transition:color .25s var(--ease,ease)}
.ek-card-more svg{width:11px;height:11px;transition:transform .3s var(--ease,ease)}
.ek-card:hover .ek-card-more,.ek-card.open .ek-card-more{color:#ff7a00}
.ek-card.open .ek-card-more svg{transform:rotate(180deg)}

/* panel detail (Pembina / Latihan / Kegiatan) */
.ek-card-detail{max-height:0;overflow:hidden;opacity:0;transition:max-height .5s var(--ease,ease),opacity .4s var(--ease,ease) .05s,margin-top .5s var(--ease,ease)}
.ek-card.open .ek-card-detail{max-height:220px;opacity:1;margin-top:.6rem}
.ek-card-meta{list-style:none;margin:0;padding:.65rem 0 0;border-top:1px dashed rgba(13,58,102,.14);display:grid;gap:.35rem}
.ek-card-meta li{display:flex;align-items:flex-start;gap:.4rem;font-size:.68rem;line-height:1.45;color:#5b6d82}
.ek-card-meta li svg{width:11px;height:11px;flex:0 0 11px;margin-top:.15rem;color:#ff9800}
.ek-card-meta li b{color:#0d3a66;font-weight:800}

/* ---------- 4. CTA ---------- */
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
@media(min-width:951px){
  .ek-section{width:min(1600px,94%)!important}
  .ek-grid{grid-template-columns:repeat(3,minmax(0,1fr))!important;gap:2.4rem!important}
  .ek-card-media{width:100%!important;height:auto!important;aspect-ratio:4/5!important;margin:0!important;padding:0!important}
  .ek-card-media img{width:100%!important;height:100%!important;object-fit:cover!important;object-position:center center!important}
}
@media(max-width:1200px){.ek-grid{grid-template-columns:repeat(3,minmax(0,1fr));gap:1.1rem}}
@media(max-width:950px){.ek-intro-grid{grid-template-columns:1fr;gap:3rem}.ek-intro-visual img{height:320px}
  .ek-grid{grid-template-columns:repeat(2,minmax(0,1fr));gap:1rem}
  .ek-card-media{width:100%!important;height:auto!important;aspect-ratio:4/5!important;margin:0!important;padding:0!important}
  .ek-card-media img{width:100%!important;height:100%!important;object-fit:cover!important;object-position:center center!important}
}
@media(max-width:768px){
  .ek-hero{align-items:flex-start;min-height:0}
  .ek-hero-inner{width:min(92%,100%);margin:0 auto;padding:clamp(2.8rem,7vh,4rem) 0 2.8rem}
  .ek-hero::after, .home-orn{display:none!important}
  .ek-title{font-size:clamp(2.5rem,10.5vw,4.2rem)}
  .ek-intro,.ek-explore,.ek-stats{padding:40px 0 46px}
  .ek-mini-stats{grid-template-columns:1fr;gap:.8rem}
  .ek-stats-grid{grid-template-columns:1fr 1fr;gap:.9rem}
  .ek-stat{padding:1.1rem .8rem;border-radius:16px}
  .ek-grid{grid-template-columns:repeat(2,minmax(0,1fr));gap:.6rem;width:100%;max-width:100%}
  .ek-card-head{padding:.5rem .55rem;height:44px;flex:0 0 44px;gap:.35rem}
  .ek-card-avatar{width:26px;height:26px;flex:0 0 26px}
  .ek-card-uname{font-size:.74rem}
  .ek-card-usub{font-size:.54rem}
  .ek-card-actions{padding:.4rem .55rem .2rem;gap:.6rem}
  .ek-card-panel{padding:.4rem .55rem .7rem}
  .ek-card-caption{font-size:.72rem;line-height:1.42}
  .ek-card-tag{font-size:.54rem;padding:.2rem .45rem}
  .ek-card-sched{font-size:.62rem}
  .ek-cta-wrap{padding:28px 1.1rem 32px;width:min(92%,100%);margin:0 auto 3rem;border-radius:18px}
  .ek-cta-title{font-size:clamp(1.35rem,5vw,2rem);line-height:1.25}
  .ek-cta-wrap p{font-size:.82rem;margin:.7rem auto 1.3rem;line-height:1.6}
  .ek-cta-btn{padding:.75rem 1.4rem;font-size:.84rem}
  [data-reveal]{opacity:1!important;transform:none!important}
}

/* =========================================================
   DARK MODE (satu blok, tanpa duplikat)
   Memakai CSS nesting (Chrome/Edge 120+, Safari 17.2+, Firefox 117+).
   Selector :is(...) menangkap berbagai cara layout menandai dark mode
   (di <html> maupun <body>). Hapus yang tidak dipakai kalau sudah tahu.
   ========================================================= */
:is([data-theme="dark"], [data-bs-theme="dark"], .dark, .dark-mode, .dark-theme, .theme-dark){

  & .ek-page{background:#081423;color:#e6eef8}

  /* Hero */
  & .ek-hero{background:#0a1a2e;color:#e6eef8}
  & .ek-hero::after{color:rgba(255,255,255,.04);-webkit-text-stroke:1px rgba(255,179,0,.14)}
  & .ek-ref-ornaments{opacity:.45}
  & .ek-ref-ornament-image{filter:invert(.92) hue-rotate(180deg) brightness(.9)}
  & .ek-kicker{background:rgba(255,111,0,.10);border-color:rgba(255,111,0,.35);color:#ff9a3d}
  & .ek-title .ek-white{color:#fff}
  & .ek-lead{color:#9db0c6}
  & .ek-pill{background:#12294a;border-color:rgba(255,255,255,.12);color:#e6eef8;box-shadow:none}

  /* Ornamen */
  & .home-orn .ho-chevron{border-color:rgba(255,255,255,.12)}
  & .home-orn .ho-chevron::after{border-color:rgba(120,170,220,.16)}
  & .home-orn .ho-line{background:rgba(255,255,255,.10)}
  & .home-orn .ho-line::after{background:rgba(120,170,220,.18)}
  & .home-orn .ho-dots{background-image:radial-gradient(rgba(255,255,255,.35) 1.6px,transparent 1.7px);opacity:.3}
  & .home-orn .ho-ring{border-color:rgba(255,255,255,.10)}
  & .home-orn .ho-ring::before{border-color:rgba(120,170,220,.2)}
  & .home-orn .ho-square::before{border-color:rgba(255,255,255,.15)}
  & .home-orn .ho-corner::after{background:rgba(255,255,255,.16)}

  /* Heading umum */
  & .big-heading{color:#fff}
  & .ek-eyebrow{color:#ffd54a}
  & .ek-desc{color:#9db0c6}

  /* Intro */
  & .ek-intro{background:#0b1b2f}
  & .ek-intro-note{color:#9db0c6}
  & .ek-mini{background:#12294a;border-color:rgba(255,255,255,.08)}
  & .ek-mini:hover{box-shadow:0 16px 36px rgba(0,0,0,.4)}
  & .ek-mini b{color:#fff}
  & .ek-mini span{color:#9db0c6}
  & .ek-intro-visual{box-shadow:0 30px 70px rgba(0,0,0,.5);border-color:rgba(255,179,0,.3)}

  /* Stats */
  & .ek-stats{background:#061121}
  & .ek-stat{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.10)}

  /* Explorer */
  & .ek-explore{background-color:#081423;background-image:radial-gradient(rgba(255,255,255,.05) 1.4px,transparent 1.5px)}
  & .ek-filter{background:#12294a;border-color:rgba(255,255,255,.10);color:#b8c8dc}
  & .ek-filter .ek-filter-count{background:rgba(255,255,255,.10);color:#b8c8dc}
  & .ek-filter:hover{border-color:rgba(255,213,74,.6)}
  & .ek-filter.active{background:linear-gradient(135deg,#ffd54a,#ffb300);border-color:#ffb300;color:#0a2d52;box-shadow:0 14px 30px rgba(255,179,0,.25)}
  & .ek-filter.active .ek-filter-count{background:rgba(10,45,82,.15);color:#0a2d52}
  & .ek-count-line{color:#9db0c6}
  & .ek-count-line b{color:#ffd54a}
  & .ek-empty{color:#9db0c6}

  /* Kartu */
  & .ek-card{background:#0f2340;border-color:rgba(255,255,255,.08);box-shadow:0 10px 26px rgba(0,0,0,.35)}
  & .ek-card:hover{box-shadow:0 20px 42px rgba(0,0,0,.55)}
  & .ek-card-avatar{border-color:rgba(255,255,255,.12)}
  & .ek-card-uname{color:#fff}
  & .ek-card-usub{color:#8fa3bb}
  & .ek-card-menu{color:#5f748e}
  & .ek-card-media{background:#0a1a2e}
  & .ek-act{color:#9db0c6}
  & .ek-card-caption{color:#c3d1e2}
  & .ek-card-caption .ek-card-name{color:#ffd54a}
  & .ek-card-tag{background:rgba(255,213,74,.16);color:#ffd54a}
  & .ek-card-sched{color:#b8c8dc}
  & .ek-card-more{color:#ffd54a}
  & .ek-card:hover .ek-card-more,
  & .ek-card.open .ek-card-more{color:#ff9a3d}
  & .ek-card-meta{border-top-color:rgba(255,255,255,.16)}
  & .ek-card-meta li{color:#c3d1e2}
  & .ek-card-meta li b{color:#fff}

  /* CTA */
  & .ek-cta-wrap{background:linear-gradient(135deg,#040c18 0%,#071a31 55%,#0a2340 100%);
    border:1px solid rgba(255,213,74,.16);
    box-shadow:0 34px 80px rgba(0,0,0,.6), inset 0 1px 0 rgba(255,255,255,.04)}
  & .ek-cta-wrap p{color:#a9bbd0}
  & .ek-cta-note{color:#8fa3bb}
  & .ek-cta-wrap .home-orn .ho-chevron,
  & .ek-cta-wrap .home-orn .ho-ring{border-color:rgba(255,255,255,.08)}
}

/* transisi halus saat ganti tema */
.ek-page,.ek-hero,.ek-intro,.ek-stats,.ek-explore,.ek-card,.ek-mini,.ek-filter,.ek-pill,.ek-cta-wrap{
  transition:background-color .35s ease,color .35s ease,border-color .35s ease}

/* Desktop Web Large Card Fix (> 950px) */
@media (min-width: 951px) {
  .ek-section {
    width: min(1440px, 94%) !important;
  }
  .ek-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    gap: 2rem !important;
  }
  .ek-card {
    border-radius: 24px !important;
    box-shadow: 0 16px 40px rgba(13, 58, 102, 0.11) !important;
  }
  .ek-card-head {
    height: 66px !important;
    padding: .85rem 1.2rem !important;
    gap: .75rem !important;
  }
  .ek-card-avatar {
    width: 44px !important;
    height: 44px !important;
    flex: 0 0 44px !important;
  }
  .ek-card-media {
    width: 100% !important;
    height: auto !important;
    aspect-ratio: 4 / 5 !important;
    margin: 0 !important;
    padding: 0 !important;
  }
  .ek-card-media img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    object-position: center center !important;
  }
  .ek-card-uname {
    font-size: 1.08rem !important;
    font-weight: 900 !important;
  }
  .ek-card-usub {
    font-size: .7rem !important;
    margin-top: .15rem !important;
  }
  .ek-card-panel {
    padding: .9rem 1.2rem 1.3rem !important;
  }
  .ek-card-caption {
    font-size: .98rem !important;
    line-height: 1.6 !important;
    -webkit-line-clamp: 3 !important;
  }
  .ek-card-caption .ek-card-name {
    font-size: 1.05rem !important;
    font-weight: 900 !important;
  }
  .ek-card-actions {
    padding: .7rem 1.2rem .35rem !important;
    gap: 1rem !important;
  }
  .ek-card-actions svg {
    width: 22px !important;
    height: 22px !important;
  }
  .ek-card-tag {
    font-size: .72rem !important;
    padding: .32rem .75rem !important;
  }
  .ek-card-sched {
    font-size: .8rem !important;
  }
  .ek-card-more {
    font-size: .82rem !important;
    margin-top: .75rem !important;
  }
  .ek-card-meta li {
    font-size: .82rem !important;
    line-height: 1.55 !important;
  }
}
</style>
@endpush

@section('content')
<div class="ek-page">

  <!-- HERO -->
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
          <img src="{{ asset('images/ekstra/paskibra.jpg') }}" alt="Pasukan pengibar bendera SMK Negeri 2 Mojokerto" loading="eager">
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

  <!-- 3. EXPLORER -->
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

@php
  $ekskulList = $extracurriculars->reject(fn($item) => $item->category === 'Organisasi');
  $orgList = $extracurriculars->filter(fn($item) => $item->category === 'Organisasi');
  $categories = $ekskulList->pluck('category')->filter()->unique()->values();
@endphp
      <div class="ek-filters" id="ekFilters" data-reveal>
        <button class="ek-filter active" data-filter="semua" type="button">Semua <span class="ek-filter-count">{{ $ekskulList->count() }}</span></button>
        @foreach($categories as $cat)
          @php
            $catCount = $ekskulList->where('category', $cat)->count();
          @endphp
          <button class="ek-filter" data-filter="{{ $cat }}" type="button">{{ $cat }} <span class="ek-filter-count">{{ $catCount }}</span></button>
        @endforeach
      </div>
      <p class="ek-count-line" id="ekCountLine"><b id="ekCountNum">{{ $ekskulList->count() }}</b> ekstrakurikuler ditemukan</p>

      <div class="ek-grid" id="ekGrid">
        @forelse($ekskulList as $index => $item)
          @php
            $attrs = $item->attributes ?? [];
            $schedule = $attrs['schedule'] ?? 'Sesuai Jadwal';
            $activities = $attrs['activities'] ?? 'Latihan rutin & kegiatan sekolah';
            $coach = $item->coach_name ?: 'Pembina Sekolah';
            $img = $item->image_url ? asset($item->image_url) : asset('images/logo_smkn2.png');
          @endphp
          <div class="ek-item" data-category="{{ $item->category }}" data-reveal style="--d:{{ $index }}">
            <article class="ek-card" data-toggle>
              <div class="ek-card-head">
                <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
                <div class="ek-card-idwrap">
                  <span class="ek-card-uname">{{ $item->name }}</span>
                  <span class="ek-card-usub">SMKN 2 Mojokerto</span>
                </div>
                <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
              </div>
              <div class="ek-card-media">
                <img src="{{ $img }}" alt="Kegiatan {{ $item->name }} SMKN 2 Mojokerto" loading="eager" onerror="this.src='{{ asset('images/logo_smkn2.png') }}'">
              </div>
              <div class="ek-card-actions" aria-hidden="true">
                <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
                <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
                <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
                <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
              </div>
              <div class="ek-card-panel">
                <div class="ek-card-peek">
                  <p class="ek-card-caption"><span class="ek-card-name">{{ $item->name }}</span>{{ $item->description }}</p>
                  <div class="ek-card-metaline">
                    <span class="ek-card-tag">{{ $item->category }}</span>
                    <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> {{ $schedule }}</span>
                  </div>
                  <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
                </div>
                <div class="ek-card-detail">
                  <ul class="ek-card-meta">
                    <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> {{ $coach }}</span></li>
                    <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Latihan:</b> {{ $schedule }}</span></li>
                    <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> {{ $activities }}</span></li>
                  </ul>
                </div>
              </div>
            </article>
          </div>
        @empty
          <p class="ek-empty">Belum ada data ekstrakurikuler.</p>
        @endforelse
      </div>

      <div style="margin-top:5.5rem" data-reveal>
        <span class="ek-eyebrow">Organisasi Siswa</span>
        <h2 class="big-heading">Bersama <span>Berkarya</span></h2>
        <p class="ek-desc">Organisasi siswa menjadi ruang untuk belajar memimpin, bekerja sama, berinisiatif, dan berkontribusi dalam kehidupan sekolah.</p>
      </div>
      <div class="ek-grid" id="ekOrgGrid">
        @forelse($orgList as $index => $item)
          @php
            $attrs = $item->attributes ?? [];
            $schedule = $attrs['schedule'] ?? 'Sesuai Agenda';
            $activities = $attrs['activities'] ?? 'Program kerja & kegiatan sekolah';
            $coach = $item->coach_name ?: 'Pembina Organisasi Sekolah';
            $img = $item->image_url ? asset($item->image_url) : asset('images/logo_smkn2.png');
          @endphp
          <div class="ek-item" data-category="Organisasi" data-reveal style="--d:{{ $index }}">
            <article class="ek-card" data-toggle>
              <div class="ek-card-head">
                <span class="ek-card-avatar"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto"></span>
                <div class="ek-card-idwrap">
                  <span class="ek-card-uname">{{ $item->name }}</span>
                  <span class="ek-card-usub">SMKN 2 Mojokerto</span>
                </div>
                <span class="ek-card-menu" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg></span>
              </div>
              <div class="ek-card-media">
                <img src="{{ $img }}" alt="Kegiatan {{ $item->name }} SMKN 2 Mojokerto" loading="eager" onerror="this.src='{{ asset('images/logo_smkn2.png') }}'">
              </div>
              <div class="ek-card-actions" aria-hidden="true">
                <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg></span>
                <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg></span>
                <span class="ek-act"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg></span>
                <span class="ek-act ek-act-save"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg></span>
              </div>
              <div class="ek-card-panel">
                <div class="ek-card-peek">
                  <p class="ek-card-caption"><span class="ek-card-name">{{ $item->name }}</span>{{ $item->description }}</p>
                  <div class="ek-card-metaline">
                    <span class="ek-card-tag">Organisasi</span>
                    <span class="ek-card-sched"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="16" rx="2.5"/><path d="M16 2.5v4M8 2.5v4M3 9.5h18"/></svg> {{ $schedule }}</span>
                  </div>
                  <span class="ek-card-more">Lihat detail <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
                </div>
                <div class="ek-card-detail">
                  <ul class="ek-card-meta">
                    <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Pembina:</b> {{ $coach }}</span></li>
                    <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Agenda:</b> {{ $schedule }}</span></li>
                    <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><span><b>Kegiatan:</b> {{ $activities }}</span></li>
                  </ul>
                </div>
              </div>
            </article>
          </div>
        @empty
          <p class="ek-empty">Belum ada data organisasi.</p>
        @endforelse
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

  /* ---- Kartu: klik/tap untuk membuka panel detail ---- */
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