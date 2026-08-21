@extends('layouts.app')

@section('title', 'Berita — SMK Negeri 2 Mojokerto')
@section('description', 'Berita SKANEDA — portal berita resmi SMK Negeri 2 Mojokerto. Kabar terbaru sekolah, prestasi siswa, kegiatan, akademik, dan ekstrakurikuler.')

@push('styles')
<style>
/* =========================================================
   BERITA SKANEDA — DIGITAL SCHOOL NEWSPAPER
   Halaman baru. Hero, header (layouts.app) & footer TIDAK
   diubah — identik dengan halaman referensi lain.
   Visual language: navy #0d3a66, biru #2f6fa8, gold
   #ffd54a/#ffb300, Sora display. Konsep: editorial news
   portal / digital newspaper — layout asimetris, featured
   news besar, most-read bernomor, ornamen editorial tipis.
   ========================================================= */
.br-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}
.br-page *{box-sizing:border-box}

/* ---------- HERO: senada 100% dengan hero Ekstrakurikuler (light theme, watermark) ---------- */
.br-hero{position:relative;min-height:clamp(560px,72vh,740px);display:flex;align-items:center;overflow:hidden;
  background:#fff;color:#0d3a66;isolation:isolate}
.br-hero::after{content:"BERITA";position:absolute;z-index:0;left:2%;top:58%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(3.4rem,11.5vw,11.5rem);font-weight:900;line-height:.78;
  letter-spacing:.01em;color:rgba(13,58,102,.035);-webkit-text-stroke:1px rgba(255,122,0,.09);
  pointer-events:none;white-space:nowrap;user-select:none}
.br-ref-ornaments{position:absolute!important;inset:0;z-index:1;overflow:hidden;pointer-events:none;opacity:1}
.br-ref-ornament-image{position:absolute!important;inset:0;width:100%;height:100%;display:block;
  object-fit:cover;object-position:center center;max-width:none;opacity:1}
.br-hero-inner{position:relative;z-index:4;width:100%;max-width:1500px;margin:0 auto;
  padding:clamp(3.6rem,9vh,6rem) clamp(1.25rem,4.2vw,4.5rem) clamp(3.2rem,7vh,5rem);display:block}

.br-kicker{position:relative;z-index:5;display:inline-flex;align-items:center;gap:.65rem;font-size:.72rem;
  font-weight:900;letter-spacing:.18em;text-transform:uppercase;color:#ff6f00;margin-bottom:1.2rem;
  padding:.55rem .85rem;border:1px solid rgba(255,111,0,.18);border-radius:999px;background:#fffaf5}
.br-kicker::before{content:"";width:9px;height:9px;border-radius:50%;background:#ff6f00;
  box-shadow:0 0 0 6px rgba(255,111,0,.10)}

/* ---------- TITLE: BERITA navy, SKANEDA kuning-oranye ---------- */
.br-title{position:relative;z-index:5;font-family:var(--font-display);font-size:clamp(3.6rem,9vw,8rem);
  line-height:.86;letter-spacing:-.03em;margin:0;max-width:900px;text-transform:uppercase;
  text-shadow:none;animation:hdFadeUp .7s .1s var(--ease, ease) both}
.br-title .br-white{color:#0d3a66;display:block}
.br-title .br-gold{display:block;
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent;
  text-shadow:none;letter-spacing:-.02em}
.br-lead{position:relative;z-index:5;font-size:1rem;line-height:1.8;color:#52657a;max-width:640px;
  margin:1.6rem 0 0;animation:hdFadeUp .7s .26s var(--ease, ease) both}
.br-hero-meta{position:relative;z-index:5;display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;
  animation:hdFadeUp .7s .4s var(--ease, ease) both}
.br-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;
  border:1px solid rgba(13,58,102,.12);background:#fff;border-radius:999px;color:#0d3a66;
  font-size:.72rem;font-weight:800;box-shadow:0 8px 24px rgba(13,58,102,.06)}
.br-pill i{color:#ff7a00}

@media(min-width:1050px){.br-hero-inner{padding-right:40%}}
@media(max-width:1050px){.br-hero-inner{padding-right:1.25rem}.br-ref-ornaments{opacity:.72}}
@media(max-width:900px){.br-title{font-size:clamp(3.2rem,10.5vw,6rem)}.br-ref-ornament-image{opacity:.88}}
@media(max-width:700px){.br-hero{align-items:flex-start;min-height:0}
  .br-hero-inner{width:90%;padding:clamp(3rem,8vh,4.5rem) 5% 3.2rem}
  .br-hero::after{font-size:clamp(3.2rem,20vw,5.4rem);opacity:.6;left:-2%}
  .br-title{font-size:clamp(2.6rem,12vw,3.8rem)}}
@media(max-width:560px){.br-ref-ornament-image{opacity:.62}}

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
/* ---------- STRIP EDISI (editorial ticker) ---------- */
.br-strip{background:#0d3a66;color:#fff;position:relative;overflow:hidden;border-bottom:3px solid #ffc107}
.br-strip-inner{display:flex;align-items:center;gap:1.1rem;padding:.8rem clamp(1.5rem,5vw,5.5rem)}
.br-strip-label{display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,#ffd54a,#ffb300);
  color:#0d3a66;font-size:.68rem;font-weight:900;letter-spacing:.14em;text-transform:uppercase;
  padding:.42rem .8rem;border-radius:999px;white-space:nowrap}
.br-strip-label i{font-size:.7rem}
.br-strip-text{font-size:.82rem;color:rgba(255,255,255,.85);letter-spacing:.02em;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.br-strip-text b{color:#ffd54a;font-weight:800}

/* ---------- SHELL SECTION ---------- */
.br-sec{position:relative;padding:clamp(4.5rem,9vw,7.5rem) clamp(1.5rem,5vw,5.5rem)}
.br-container{max-width:1240px;margin:0 auto;position:relative;z-index:2}
.br-sec-head{display:flex;align-items:flex-end;justify-content:space-between;gap:2rem;margin-bottom:clamp(2rem,4vw,3.2rem)}
.br-eyebrow{display:inline-flex;align-items:center;gap:.6rem;font-size:.72rem;font-weight:800;
  letter-spacing:.2em;text-transform:uppercase;color:#2f6fa8;margin-bottom:.7rem}
.br-eyebrow::before{content:"";width:26px;height:2px;background:linear-gradient(90deg,#ffd54a,#ffb300)}
.br-eyebrow--gold{color:#b8860b}
.br-sec-title{font-family:var(--font-display);font-weight:900;font-size:clamp(2rem,4vw,3.5rem);
  line-height:.98;letter-spacing:-.02em;color:#0d3a66;margin:0}
.br-sec-title em{font-style:normal;color:transparent;background:linear-gradient(135deg,#ffd54a,#ff8a00);
  -webkit-background-clip:text;background-clip:text}
.br-sec-sub{font-size:.95rem;line-height:1.75;color:#4a6079;max-width:560px;margin-top:.9rem}
.br-rule{height:3px;width:74px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ffb300);margin:1rem 0 0}
.br-rule--dark{background:linear-gradient(90deg,#ffd54a,#ff8a00)}

/* Ornamen editorial: numbering, thin lines, gold block, dots, subtle grid */
.br-num{font-family:var(--font-display);font-weight:800;font-size:clamp(4rem,8vw,7rem);line-height:1;
  color:rgba(13,58,102,.07);letter-spacing:-.03em;user-select:none;pointer-events:none}
.br-block{position:absolute;width:9px;height:9px;background:#ffc107;opacity:.5}
.br-dots{position:absolute;width:88px;height:88px;opacity:.4;
  background-image:radial-gradient(rgba(13,58,102,.35) 1.5px,transparent 1.6px);background-size:14px 14px}
.br-gridbg{position:absolute;inset:0;pointer-events:none;opacity:.5;
  background-image:linear-gradient(rgba(13,58,102,.05) 1px,transparent 1px),
  linear-gradient(90deg,rgba(13,58,102,.05) 1px,transparent 1px);background-size:56px 56px}

/* ---------- KATEGORI PILL ---------- */
.br-cat{display:inline-flex;align-items:center;gap:.4rem;padding:.34rem .72rem;border-radius:999px;
  font-size:.66rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase;white-space:nowrap}
.br-cat i{font-size:.62rem}
.br-cat-sekolah{background:#e8f0fa;color:#0d3a66;border:1px solid rgba(13,58,102,.16)}
.br-cat-siswa{background:#eafaf1;color:#1d7a4f;border:1px solid rgba(29,122,79,.2)}
.br-cat-prestasi{background:#fff7e0;color:#b8860b;border:1px solid rgba(255,193,7,.4)}
.br-cat-kegiatan{background:#f0ecff;color:#5b3db8;border:1px solid rgba(91,61,184,.18)}
.br-cat-akademik{background:#e3f5fb;color:#0e7c9e;border:1px solid rgba(14,124,158,.2)}
.br-cat-ekstrakurikuler{background:#fff0ec;color:#c2491b;border:1px solid rgba(194,73,27,.2)}
.br-cat-humas{background:#f1f1f5;color:#5b6472;border:1px solid rgba(91,100,114,.22)}

/* ---------- BERITA TERKINI: featured besar + side stack ---------- */
.br-latest{display:grid;grid-template-columns:minmax(0,1.85fr) minmax(300px,1fr);gap:2.2rem;align-items:stretch}
.br-featured{position:relative;border-radius:22px;overflow:hidden;display:flex;flex-direction:column;
  background:#fff;border:1px solid rgba(13,58,102,.1);box-shadow:0 18px 50px rgba(13,58,102,.12);
  transition:transform .45s var(--ease,ease),box-shadow .45s var(--ease,ease)}
.br-featured:hover{transform:translateY(-6px);box-shadow:0 30px 70px rgba(13,58,102,.2)}
.br-featured-img{position:relative;height:min(52vh,430px);overflow:hidden}
.br-featured-img img{width:100%;height:100%;object-fit:cover;object-position:center;display:block;
  transition:transform .8s var(--ease,ease)}
.br-featured:hover .br-featured-img img{transform:scale(1.045)}
.br-featured-img::after{content:"";position:absolute;inset:0;
  background:linear-gradient(180deg,rgba(7,22,42,0) 42%,rgba(7,22,42,.78) 100%)}
.br-featured-tag{position:absolute;z-index:3;top:1.3rem;left:1.3rem;display:flex;gap:.5rem;align-items:center}
.br-featured-body{padding:1.9rem 2rem 2.1rem;position:relative;display:flex;flex-direction:column;gap:.8rem;flex:1}
.br-featured-date{display:inline-flex;align-items:center;gap:.5rem;font-size:.74rem;font-weight:700;
  color:#4a6079;letter-spacing:.06em;text-transform:uppercase}
.br-featured-date i{color:#ffb300}
.br-featured h3{font-family:var(--font-display);font-size:clamp(1.45rem,2.6vw,2.15rem);font-weight:800;
  line-height:1.14;letter-spacing:-.01em;color:#0d3a66;margin:0}
.br-featured h3 a{color:inherit;text-decoration:none}
.br-featured h3 a:hover{color:#2f6fa8}
.br-featured-excerpt{font-size:.95rem;line-height:1.75;color:#4a6079;margin:0}
.br-featured-meta{display:flex;align-items:center;gap:1.1rem;margin-top:auto;padding-top:1rem;
  border-top:1px solid rgba(13,58,102,.1);font-size:.76rem;color:#5b6472}
.br-featured-meta span{display:inline-flex;align-items:center;gap:.45rem}
.br-featured-meta i{color:#ffb300}
.br-readmore{display:inline-flex;align-items:center;gap:.5rem;margin-top:.5rem;align-self:flex-start;
  font-size:.8rem;font-weight:800;color:#0d3a66;text-decoration:none;letter-spacing:.04em;
  border-bottom:2px solid #ffc107;padding-bottom:.25rem;transition:gap .3s var(--ease,ease),color .3s}
.br-readmore:hover{gap:.85rem;color:#b8860b}

/* side stack berita kecil */
.br-side{display:flex;flex-direction:column;gap:1.1rem}
.br-side-item{display:flex;gap:1rem;background:#fff;border:1px solid rgba(13,58,102,.1);
  border-radius:16px;padding:.85rem;align-items:center;transition:transform .35s var(--ease,ease),box-shadow .35s var(--ease,ease)}
.br-side-item:hover{transform:translateY(-3px);box-shadow:0 16px 40px rgba(13,58,102,.14)}
.br-side-thumb{flex:0 0 118px;height:96px;border-radius:11px;overflow:hidden;position:relative}
.br-side-thumb img{width:100%;height:100%;object-fit:cover;object-position:center;display:block}
.br-side-thumb::after{content:"";position:absolute;inset:0;border:1px solid rgba(13,58,102,.06);border-radius:11px}
.br-side-body{min-width:0;display:flex;flex-direction:column;gap:.35rem}
.br-side-body .br-cat{align-self:flex-start}
.br-side-body h4{font-family:var(--font-display);font-size:.92rem;font-weight:700;line-height:1.3;color:#0d3a66;margin:0}
.br-side-body h4 a{color:inherit;text-decoration:none}
.br-side-body h4 a:hover{color:#2f6fa8}
.br-side-date{font-size:.7rem;color:#5b6472;display:inline-flex;align-items:center;gap:.4rem}
.br-side-date i{color:#ffb300}

/* ---------- TOOLBAR: filter + search ---------- */
.br-toolbar{display:flex;align-items:center;justify-content:space-between;gap:1.2rem;flex-wrap:wrap;
  background:#fff;border:1px solid rgba(13,58,102,.1);border-left:4px solid #ffc107;
  border-radius:16px;padding:1rem 1.3rem;margin-bottom:2.2rem;
  box-shadow:0 10px 30px rgba(13,58,102,.07)}
.br-filters{display:flex;gap:.5rem;flex-wrap:wrap}
.br-filter-btn{appearance:none;border:1px solid rgba(13,58,102,.16);background:#fff;color:#0d3a66;
  font-family:inherit;font-size:.76rem;font-weight:700;padding:.52rem .95rem;border-radius:999px;
  cursor:pointer;transition:all .28s var(--ease,ease);display:inline-flex;align-items:center;gap:.4rem}
.br-filter-btn i{font-size:.68rem;opacity:.6}
.br-filter-btn:hover{border-color:#2f6fa8;color:#2f6fa8;transform:translateY(-1px)}
.br-filter-btn.active{background:#0d3a66;color:#fff;border-color:#0d3a66;
  box-shadow:0 8px 20px rgba(13,58,102,.28)}
.br-filter-btn.active i{color:#ffd54a;opacity:1}
.br-search{position:relative;min-width:230px}
.br-search i{position:absolute;left:.95rem;top:50%;transform:translateY(-50%);color:#7c8fa3;font-size:.85rem;pointer-events:none}
.br-search input{width:100%;appearance:none;border:1px solid rgba(13,58,102,.16);border-radius:999px;
  padding:.62rem 1rem .62rem 2.5rem;font-family:inherit;font-size:.82rem;color:#0d3a66;
  background:#f7f9fc;outline:none;transition:border .3s,box-shadow .3s}
.br-search input::placeholder{color:#8ba0b4}
.br-search input:focus{border-color:#ffc107;box-shadow:0 0 0 3px rgba(255,193,7,.18);background:#fff}

/* ---------- BERITA TERBARU: list kiri + most read kanan ---------- */
.br-main{display:grid;grid-template-columns:minmax(0,1.9fr) minmax(300px,1fr);gap:2.4rem;align-items:start}
.br-list{display:flex;flex-direction:column;gap:1.4rem}
.br-item{display:flex;gap:1.3rem;background:#fff;border:1px solid rgba(13,58,102,.1);border-radius:18px;
  padding:1rem;align-items:center;transition:transform .35s var(--ease,ease),box-shadow .35s var(--ease,ease),
  border-color .35s var(--ease,ease)}
.br-item:hover{transform:translateY(-4px);box-shadow:0 18px 46px rgba(13,58,102,.14);border-color:rgba(255,193,7,.55)}
.br-item-img{flex:0 0 158px;height:132px;border-radius:13px;overflow:hidden;position:relative}
.br-item-img img{width:100%;height:100%;object-fit:cover;object-position:center;display:block}
.br-item-body{min-width:0;display:flex;flex-direction:column;gap:.5rem}
.br-item-top{display:flex;align-items:center;gap:.7rem;flex-wrap:wrap}
.br-item-date{font-size:.7rem;color:#5b6472;display:inline-flex;align-items:center;gap:.4rem}
.br-item-date i{color:#ffb300}
.br-item-body h3{font-family:var(--font-display);font-size:1.06rem;font-weight:800;line-height:1.28;
  color:#0d3a66;margin:0}
.br-item-body h3 a{color:inherit;text-decoration:none}
.br-item-body h3 a:hover{color:#2f6fa8}
.br-item-excerpt{font-size:.84rem;line-height:1.65;color:#4a6079;margin:0;
  display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.br-empty{display:none;text-align:center;padding:3.5rem 1rem;background:#fff;border:1px dashed rgba(13,58,102,.2);
  border-radius:18px;color:#5b6472;font-size:.9rem}
.br-empty.show{display:block}
.br-empty i{display:block;font-size:2rem;color:#ffc107;margin-bottom:.8rem}

/* panel most read */
.br-most{position:sticky;top:110px;background:#0d3a66;color:#fff;border-radius:22px;overflow:hidden;
  padding:2rem 1.7rem;box-shadow:0 24px 60px rgba(13,58,102,.3)}
.br-most-head{display:flex;align-items:center;gap:.7rem;margin-bottom:1.5rem}
.br-most-head i{color:#ffd54a;font-size:1.05rem}
.br-most-head h3{font-family:var(--font-display);font-size:1.18rem;font-weight:800;letter-spacing:.02em;margin:0}
.br-most-head span{display:block;font-size:.64rem;font-weight:700;letter-spacing:.2em;text-transform:uppercase;
  color:rgba(255,213,74,.85)}
.br-most-list{display:flex;flex-direction:column}
.br-most-item{display:flex;gap:1rem;align-items:flex-start;padding:1.05rem 0;border-bottom:1px solid rgba(255,255,255,.12);
  text-decoration:none;transition:background .3s}
.br-most-item:last-child{border-bottom:none;padding-bottom:.2rem}
.br-most-item:hover{background:rgba(255,255,255,.05);border-radius:10px;padding-left:.5rem;padding-right:.5rem}
.br-most-num{font-family:var(--font-display);font-weight:800;font-size:1.9rem;line-height:1;color:transparent;
  -webkit-text-stroke:1px rgba(255,213,74,.85);flex:0 0 44px;letter-spacing:-.02em}
.br-most-body{min-width:0}
.br-most-body b{display:block;font-family:var(--font-display);font-size:.85rem;font-weight:700;line-height:1.32;
  color:#fff;margin-bottom:.3rem}
.br-most-body span{font-size:.68rem;color:rgba(235,245,253,.65);display:inline-flex;align-items:center;gap:.4rem}
.br-most-body span i{color:#ffd54a;font-size:.62rem}

/* ---------- CERITA SKANEDA (tanpa background biru, senada light theme) ---------- */
.br-story{position:relative;overflow:hidden;margin-top:clamp(2rem,4vw,3rem)}
.br-story-inner{position:relative;z-index:2;max-width:1240px;margin:0 auto;
  padding:clamp(4.5rem,9vw,7rem) clamp(1.5rem,5vw,5.5rem)}
.br-story .br-eyebrow::before{background:linear-gradient(90deg,#ffd54a,#ff8a00)}
.br-story-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.4rem;margin-top:clamp(2rem,4vw,2.8rem)}
.br-story-card{background:#fff;border:1px solid rgba(13,58,102,.1);border-radius:18px;
  padding:1.6rem;box-shadow:0 10px 26px rgba(13,58,102,.06);
  transition:transform .4s var(--ease,ease),box-shadow .4s var(--ease,ease),border-color .4s var(--ease,ease)}
.br-story-card:hover{transform:translateY(-6px);box-shadow:0 20px 42px rgba(13,58,102,.14);border-color:rgba(255,193,7,.5)}
.br-story-card .br-cat{margin-bottom:.9rem}
.br-story-card h4{font-family:var(--font-display);font-size:1.14rem;font-weight:800;line-height:1.3;margin:0 0 .6rem;color:#0d3a66}
.br-story-card p{font-size:.84rem;line-height:1.7;color:#4a6079;margin:0 0 1.1rem}
.br-story-link{display:inline-flex;align-items:center;gap:.45rem;font-size:.78rem;font-weight:800;color:#b8860b;
  text-decoration:none;border-bottom:2px solid rgba(255,193,7,.4);padding-bottom:.2rem;transition:gap .3s var(--ease,ease)}
.br-story-link:hover{gap:.8rem;border-color:#ffc107}

/* ---------- CTA (card, tidak mentok tepi, jarak ke footer) ---------- */
.br-cta{padding:0 clamp(1.5rem,5vw,5.5rem) clamp(3.5rem,7vw,5rem);margin-top:clamp(1.5rem,3vw,2.5rem)}
.br-cta-box{background:#0d3a66;color:#fff;text-align:center;position:relative;overflow:hidden;
  max-width:1180px;margin:0 auto;border-radius:28px;
  padding:clamp(2.8rem,5.5vw,4rem) clamp(1.5rem,5vw,3.5rem);
  box-shadow:0 30px 70px rgba(13,58,102,.22)}
.br-cta-box>*:not(.home-orn){position:relative;z-index:1}
.br-cta-box .home-orn .ho-chevron{left:-150px;bottom:-60px;border-color:rgba(255,255,255,.10)}
.br-cta-box .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.br-cta-box .home-orn .ho-line{right:-80px;top:22%;opacity:.22}
.br-cta-box .home-orn .ho-dots{right:6%;bottom:14%;opacity:.3}
.br-cta-box .home-orn .ho-ring{left:44%;bottom:-90px;border-color:rgba(255,255,255,.12)}
.br-cta-box .home-orn .ho-gold{right:16%;top:20%}
.br-cta-box .home-orn .ho-square{left:12%;top:22%}
.br-cta-title{font-family:var(--font-display);font-weight:900;font-size:clamp(2.1rem,4.2vw,3.4rem);line-height:1.02;
  letter-spacing:-.01em;margin:0}
.br-cta-title em{font-style:normal;color:transparent;background:linear-gradient(135deg,#ffe66d,#ff8a00);
  -webkit-background-clip:text;background-clip:text}
.br-cta p{font-size:1rem;line-height:1.85;color:rgba(235,245,253,.8);max-width:620px;margin:1.3rem auto 0}
.br-cta-btn{display:inline-flex;align-items:center;gap:.6rem;margin-top:2rem;padding:.95rem 2rem;border-radius:999px;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;font-weight:900;font-size:.88rem;
  text-decoration:none;letter-spacing:.03em;transition:transform .3s var(--ease,ease),box-shadow .3s var(--ease,ease)}
.br-cta-btn:hover{transform:translateY(-3px);box-shadow:0 24px 50px rgba(255,179,0,.45)}
.br-cta-note{display:inline-flex;align-items:center;gap:.5rem;margin-top:1.2rem;font-size:.78rem;color:rgba(235,245,253,.6)}
.br-cta-note i{color:#ffd54a}


/* ---------- LIHAT SEMUA BERITA ---------- */
.br-more-wrap{display:flex;justify-content:center;margin-top:2rem}
.br-more-btn{appearance:none;border:0;cursor:pointer;display:inline-flex;align-items:center;gap:.6rem;
  padding:.85rem 1.5rem;border-radius:999px;background:#0d3a66;color:#fff;font-family:inherit;
  font-size:.82rem;font-weight:800;box-shadow:0 12px 28px rgba(13,58,102,.18);
  transition:transform .3s ease,box-shadow .3s ease,background .3s ease}
.br-more-btn:hover{transform:translateY(-3px);box-shadow:0 18px 36px rgba(13,58,102,.25);background:#2f6fa8}
.br-more-btn i{color:#ffd54a}

/* ---------- BERITA TERSEMBUNYI ---------- */
.br-item.br-extra{display:none}
.br-item.br-extra.br-show{display:flex}

/* ---------- MODAL CERITA SKANEDA ---------- */
.br-story-modal{position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;
  padding:1.2rem;background:rgba(7,22,42,.72);backdrop-filter:blur(6px)}
.br-story-modal.show{display:flex}
.br-story-modal-box{position:relative;width:min(900px,100%);max-height:88vh;overflow:auto;
  background:#fff;border-radius:24px;padding:clamp(1.5rem,4vw,2.8rem);
  box-shadow:0 30px 90px rgba(0,0,0,.3);animation:storyModalIn .3s ease}
.br-story-modal-close{position:absolute;right:1rem;top:1rem;width:40px;height:40px;border:0;
  border-radius:50%;background:#f0f3f7;color:#0d3a66;cursor:pointer;font-size:1rem;
  display:flex;align-items:center;justify-content:center;transition:.25s}
.br-story-modal-close:hover{background:#0d3a66;color:#fff}
.br-story-modal-category{margin-bottom:.9rem}
.br-story-modal-title{font-family:var(--font-display);font-size:clamp(1.6rem,3vw,2.6rem);
  line-height:1.12;color:#0d3a66;margin:0 3rem 1.2rem 0}
.br-story-modal-content{font-size:.95rem;line-height:1.85;color:#4a6079}
.br-story-modal-content p{margin:0 0 1rem}
body.br-modal-open{overflow:hidden}
@keyframes storyModalIn{from{opacity:0;transform:translateY(18px) scale(.98)}
  to{opacity:1;transform:none}}
@media(max-width:640px){
  .br-more-btn{width:100%;justify-content:center}
  .br-story-modal{padding:.7rem}
  .br-story-modal-box{border-radius:18px;padding:1.3rem}
}

/* ---------- REVEAL ---------- */
[data-reveal]{opacity:0;transform:translateY(26px);transition:opacity .7s var(--ease,ease),transform .7s var(--ease,ease)}
[data-reveal="left"]{transform:translateX(-30px)}
[data-reveal="right"]{transform:translateX(30px)}
[data-reveal].revealed{opacity:1;transform:none}
@media (prefers-reduced-motion:reduce){
  [data-reveal]{opacity:1;transform:none;transition:none}
}

/* ---------- RESPONSIVE ---------- */
@media (max-width:1024px){
  .br-latest{grid-template-columns:1fr}
  .br-main{grid-template-columns:1fr}
  .br-most{position:static;margin-top:1rem}
  .br-story-grid{grid-template-columns:repeat(2,1fr)}
}
@media (max-width:860px){
  .br-sec-head{flex-direction:column;align-items:flex-start;gap:1rem}
  .br-story-grid{grid-template-columns:1fr}
  .br-toolbar{flex-direction:column;align-items:stretch}
  .br-search{min-width:0}
}
@media (max-width:640px){
  .br-item{flex-direction:column;align-items:flex-start}
  .br-item-img{flex:none;width:100%;height:190px}
  .br-side-item{flex-direction:column;align-items:flex-start}
  .br-side-thumb{flex:none;width:100%;height:170px}
  .br-featured-img{height:300px}
  .br-strip-inner{flex-wrap:wrap}
}

/* ---------- TOMBOL BACA KISAHNYA ---------- */
.br-readmore,
.br-story-link{
  appearance:none;
  -webkit-appearance:none;
  border:0;
  background:transparent;
  font-family:inherit;
  cursor:pointer;
}
.br-side-readmore,
.br-item-readmore{
  margin-top:.45rem;
}
.br-readmore:focus-visible,
.br-story-link:focus-visible{
  outline:3px solid rgba(255,193,7,.35);
  outline-offset:4px;
  border-radius:6px;
}

/* ---------- MODAL DETAIL BERITA ---------- */
.br-news-modal{
  position:fixed;
  inset:0;
  z-index:10000;
  display:none;
  align-items:center;
  justify-content:center;
  padding:1rem;
  background:rgba(7,22,42,.76);
  backdrop-filter:blur(7px);
}
.br-news-modal.show{display:flex}
.br-news-modal-box{
  position:relative;
  width:min(900px,100%);
  max-height:88vh;
  overflow:auto;
  background:#fff;
  border-radius:24px;
  padding:clamp(1.5rem,4vw,2.8rem);
  box-shadow:0 30px 90px rgba(0,0,0,.32);
  animation:newsModalIn .3s ease;
}
.br-news-modal-close{
  position:absolute;
  right:1rem;
  top:1rem;
  width:40px;
  height:40px;
  border:0;
  border-radius:50%;
  background:#f0f3f7;
  color:#0d3a66;
  cursor:pointer;
  font-size:1rem;
  display:flex;
  align-items:center;
  justify-content:center;
  transition:.25s;
}
.br-news-modal-close:hover{background:#0d3a66;color:#fff}
.br-news-modal-category{margin-bottom:.9rem}
.br-news-modal-title{
  font-family:var(--font-display);
  font-size:clamp(1.6rem,3vw,2.6rem);
  line-height:1.12;
  color:#0d3a66;
  margin:0 3rem 1.2rem 0;
}
.br-news-modal-content{
  font-size:.95rem;
  line-height:1.85;
  color:#4a6079;
}
.br-news-modal-content p{margin:0 0 1rem}
.br-news-modal-source{
  display:flex;
  align-items:center;
  gap:.5rem;
  margin-top:1.4rem;
  padding-top:1rem;
  border-top:1px solid rgba(13,58,102,.1);
  color:#7b8da0;
  font-size:.72rem;
  font-weight:700;
}
@keyframes newsModalIn{
  from{opacity:0;transform:translateY(18px) scale(.98)}
  to{opacity:1;transform:none}
}
@media(max-width:640px){
  .br-news-modal{padding:.7rem}
  .br-news-modal-box{border-radius:18px;padding:1.3rem}
}

</style>
@endpush

@section('content')

<!-- ================= HERO ================= -->
<section class="br-hero">
  <div class="br-ref-ornaments" aria-hidden="true" style="background-image:url('{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}');background-size:cover;background-position:center center;">
    <img src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}" alt="" class="br-ref-ornament-image" aria-hidden="true">
  </div>
  <div class="br-hero-inner">
    <div>
      <div class="br-kicker">Kanal Berita &amp; Informasi Resmi Sekolah</div>
      <h1 class="br-title"><span class="br-white">Berita</span><span class="br-gold">Skaneda</span></h1>
      <div class="br-hero-meta">
        <span class="br-pill"><i class="fas fa-newspaper"></i> Arsip Kegiatan Skaneda</span>
        <span class="br-pill"><i class="fas fa-database"></i> Data Bersumber dari Dokumen Sekolah</span>
        <span class="br-pill"><i class="fas fa-bolt"></i> 28 Artikel</span>
      </div>
    </div>
  </div>
</section>

<!-- ================= STRIP EDISI ================= -->
<div class="br-strip">
  <div class="br-strip-inner">
    <span class="br-strip-label"><i class="fas fa-bolt"></i> Terkini</span>
    <span class="br-strip-text"><b>#SkanedaBerkegiatan</b> — Dokumentasi kegiatan, prestasi, dan perjalanan siswa SMK Negeri 2 Mojokerto.</span>
  </div>
</div>

<!-- ================= 1. BERITA TERKINI ================= -->
<section class="br-sec" style="padding-bottom:clamp(2.5rem,5vw,4rem)">
  <div class="home-orn" aria-hidden="true">
    <span class="ho-chevron"></span><span class="ho-dots"></span><span class="ho-ring"></span><span class="ho-gold"></span>
  </div>
  <div class="br-container">
    <div class="br-sec-head" data-reveal>
      <div>
        <span class="br-eyebrow">Headline Edition</span>
        <h2 class="br-sec-title">Berita <em>Terkini</em></h2>
        <div class="br-rule"></div>
      </div>
      <div class="br-num" aria-hidden="true">01</div>
    </div>

    <div class="br-latest">
      <article class="br-featured" data-reveal data-cat="kegiatan" data-search="Uji Kompetensi Keahlian (UKK) Jurusan APHP Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Agribisnis Pengolahan Hasil Pertanian (APHP) dengan melakukan praktik pembuatan produk roti.">
        <div class="br-featured-img">
          <img src="{{ asset('images/berita/ukk-aphp.jpeg') }}" alt="Uji Kompetensi Keahlian (UKK) Jurusan APHP" loading="eager">
          <div class="br-featured-tag"><span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span></div>
        </div>
        <div class="br-featured-body">
          <span class="br-featured-date"><i class="fas fa-calendar-alt"></i> Data kegiatan Skaneda</span>
          <h3><a href="#">Uji Kompetensi Keahlian (UKK) Jurusan APHP</a></h3>
          <p class="br-featured-excerpt">Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Agribisnis Pengolahan Hasil Pertanian (APHP) dengan melakukan praktik pembuatan produk roti.</p>
          <div class="br-featured-meta">
            <span><i class="fas fa-school"></i> SMK Negeri 2 Mojokerto</span>
            <span><i class="fas fa-newspaper"></i> Kegiatan</span>
          </div>
          <a href="#brList" class="br-readmore">Baca Kisahnya <i class="fas fa-arrow-right"></i></a>
        </div>
      </article>

      <div class="br-side">
        <article class="br-side-item" data-reveal data-cat="kegiatan" data-search="Uji Kompetensi Keahlian (UKK) Jurusan DKV Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Desain Komunikasi Visual (DKV) dengan membuat dan menampilkan cosplay berdasarkan karakter yang disukai.">
          <div class="br-side-thumb">
            <img src="{{ asset('images/berita/ukk-dkv.jpeg') }}" alt="Uji Kompetensi Keahlian (UKK) Jurusan DKV" loading="lazy">
          </div>
          <div class="br-side-body">
            <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
            <h4><a href="#">Uji Kompetensi Keahlian (UKK) Jurusan DKV</a></h4>
            
          </div>
        </article>
        <article class="br-side-item" data-reveal data-cat="kegiatan" data-search="Uji Kompetensi Keahlian (UKK) Jurusan Kuliner Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Kuliner dengan melakukan praktik pengolahan dan penyajian makanan.">
          <div class="br-side-thumb">
            <img src="{{ asset('images/berita/ukk-kuliner.jpeg') }}" alt="Uji Kompetensi Keahlian (UKK) Jurusan Kuliner" loading="lazy">
          </div>
          <div class="br-side-body">
            <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
            <h4><a href="#">Uji Kompetensi Keahlian (UKK) Jurusan Kuliner</a></h4>
            
          </div>
        </article>
        <article class="br-side-item" data-reveal data-cat="kegiatan" data-search="Uji Kompetensi Keahlian (UKK) Jurusan LPS Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Layanan Perbankan Syariah (LPS) dengan melakukan praktik yang berkaitan dengan pelayanan di bidang perbankan.">
          <div class="br-side-thumb">
            <img src="{{ asset('images/berita/ukk-lps.jpeg') }}" alt="Uji Kompetensi Keahlian (UKK) Jurusan LPS" loading="lazy">
          </div>
          <div class="br-side-body">
            <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
            <h4><a href="#">Uji Kompetensi Keahlian (UKK) Jurusan LPS</a></h4>
            
          </div>
        </article>
        <article class="br-side-item" data-reveal data-cat="prestasi" data-search="Sukses! Rekayasa Perangkat Lunak (RPL) SMK Negeri 2 Mojokerto Laksanakan Uji Kompetensi Keahlian Kegiatan Uji Kompetensi Kelulusan Kompetensi Keahlian Rekayasa Perangkat Lunak (RPL) dilaksanakan pada 18–20 Februari 2025 dan diikuti oleh siswa kelas XII RPL SMK Negeri 2 Mojokerto.">
          <div class="br-side-thumb">
            <img src="{{ asset('images/berita/ukk-rpl.jpeg') }}" alt="Sukses! Rekayasa Perangkat Lunak (RPL) SMK Negeri 2 Mojokerto Laksanakan Uji Kompetensi Keahlian" loading="lazy">
          </div>
          <div class="br-side-body">
            <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
            <h4><a href="#">Uji Kompetensi Keahlian (UKK) Jurusan RPL</a></h4>
            <a href="#brList" class="br-readmore"> Baca Kisahnya <i class="fas fa-arrow-right"></i></a>
            
          </div>
        </article>
      </div>
    </div>
  </div>
</section>

<!-- ================= 2. BERITA TERBARU ================= -->
<section class="br-sec" id="berita-terbaru" style="padding-top:clamp(2.5rem,5vw,4rem)">
  <div class="br-gridbg" aria-hidden="true"></div>
  <span class="br-block" style="top:12%;right:8%" aria-hidden="true"></span>
  <span class="br-block" style="top:26%;left:4%" aria-hidden="true"></span>
  <span class="br-dots" style="top:10%;left:6%" aria-hidden="true"></span>
  <div class="br-container">
    <div class="br-sec-head" data-reveal>
      <div>
        <span class="br-eyebrow">Archive &amp; Reportase</span>
        <h2 class="br-sec-title">Berita <em>Terbaru</em></h2>
        <div class="br-rule"></div>
      </div>
      <div class="br-num" aria-hidden="true">02</div>
    </div>

    <div class="br-toolbar" data-reveal>
      <div class="br-filters" id="brFilters">
        <button type="button" class="br-filter-btn active" data-filter="semua"><i class="fas fa-layer-group"></i> Semua</button>
        <button type="button" class="br-filter-btn" data-filter="sekolah"><i class="fas fa-school"></i> Sekolah</button>
        <button type="button" class="br-filter-btn" data-filter="siswa"><i class="fas fa-user-graduate"></i> Siswa</button>
        <button type="button" class="br-filter-btn" data-filter="prestasi"><i class="fas fa-trophy"></i> Prestasi</button>
        <button type="button" class="br-filter-btn" data-filter="kegiatan"><i class="fas fa-flag"></i> Kegiatan</button>
        <button type="button" class="br-filter-btn" data-filter="akademik"><i class="fas fa-book-open"></i> Akademik</button>
        <button type="button" class="br-filter-btn" data-filter="ekstrakurikuler"><i class="fas fa-users"></i> Ekstrakurikuler</button>
      </div>
      <div class="br-search">
        <i class="fas fa-search"></i>
        <input type="search" id="brSearch" placeholder="Cari berita..." aria-label="Cari berita">
      </div>
    </div>

    <div class="br-main">
      <div class="br-list" id="brList">
<article class="br-item" data-reveal data-cat="kegiatan" data-search="P5: Praktik Simulasi Pernikahan Melaksanakan kegiatan Projek Penguatan Profil Pelajar Pancasila (P5) melalui praktik simulasi pernikahan yang dilakukan oleh siswa kelas XI.">
          <div class="br-item-img"><img src="{{ asset('images/berita/nikah.jpeg') }}" alt="P5: Praktik Simulasi Pernikahan" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
              
            </div>
            <h3><a href="#">P5: Praktik Simulasi Pernikahan</a></h3>
            <p class="br-item-excerpt">Melaksanakan kegiatan Projek Penguatan Profil Pelajar Pancasila (P5) melalui praktik simulasi pernikahan yang dilakukan oleh siswa kelas XI.</p>
          </div>
        </article>

<article class="br-item" data-reveal data-cat="kegiatan" data-search="Paduan Suara Skaneda Melaksanakan kegiatan paduan suara yang diikuti oleh seluruh angkatan sebagai bagian dari kegiatan sekolah.">
          <div class="br-item-img"><img src="{{ asset('images/berita/padus.jpeg') }}" alt="Paduan Suara Skaneda" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
              
            </div>
            <h3><a href="#">Paduan Suara Skaneda</a></h3>
            <p class="br-item-excerpt">Melaksanakan kegiatan paduan suara yang diikuti oleh seluruh angkatan sebagai bagian dari kegiatan sekolah.</p>
          </div>
        </article>

<article class="br-item" data-reveal data-cat="akademik" data-search="SMKN 2 Mojokerto Jadi Tuan Rumah Pelatihan Pembelajaran Mendalam Batch 2 untuk Meningkatkan Kompetensi Guru Kegiatan Pelatihan Pembelajaran Mendalam bagi Guru Jenjang SMK Batch 2 dilaksanakan selama enam hari, mulai tanggal 11 hingga 16 Agustus 2025, bertempat di Aula SMK Negeri 2 Mojokerto.">
          <div class="br-item-img"><img src="{{ asset('images/berita/tuan-rumah.jpeg') }}" alt="SMKN 2 Mojokerto Jadi Tuan Rumah Pelatihan Pembelajaran Mendalam Batch 2 untuk Meningkatkan Kompetensi Guru" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-akademik"><i class="fas fa-book-open"></i> Akademik</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 11–16 Agustus 2025</span>
            </div>
            <h3><a href="#">SMKN 2 Mojokerto Jadi Tuan Rumah Pelatihan Pembelajaran Mendalam Batch 2 untuk Meningkatkan Kompetensi Guru</a></h3>
            <p class="br-item-excerpt">Kegiatan Pelatihan Pembelajaran Mendalam bagi Guru Jenjang SMK Batch 2 dilaksanakan selama enam hari, mulai tanggal 11 hingga 16 Agustus 2025, bertempat di Aula SMK Negeri 2 Mojokerto.</p>
          </div>
        </article>

<article class="br-item" data-reveal data-cat="kegiatan" data-search="Sosialisasi Genre Goes To School Ciptakan Harmonisasi di Kalangan Siswa di SMK Negeri 2 Mojokerto Kegiatan Sosialisasi Genre Goes To School dilaksanakan di Aula SMK Negeri 2 Mojokerto pada Rabu, 6 Agustus 2025.">
          <div class="br-item-img"><img src="{{ asset('images/berita/genre.jpeg') }}" alt="Sosialisasi Genre Goes To School Ciptakan Harmonisasi di Kalangan Siswa di SMK Negeri 2 Mojokerto" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 6 Agustus 2025</span>
            </div>
            <h3><a href="#">Sosialisasi Genre Goes To School Ciptakan Harmonisasi di Kalangan Siswa di SMK Negeri 2 Mojokerto</a></h3>
            <p class="br-item-excerpt">Kegiatan Sosialisasi Genre Goes To School dilaksanakan di Aula SMK Negeri 2 Mojokerto pada Rabu, 6 Agustus 2025.</p>
          </div>
        </article>

<article class="br-item" data-reveal data-cat="sekolah" data-search="SMK Negeri 2 Mojokerto Sukses Laksanakan Rekrutmen Pramuniaga Toko Emas Wahyu Redjo Kegiatan Rekrutmen Pramuniaga Toko Emas Wahyu Redjo dilaksanakan bekerja sama dengan BKK SMK Negeri 2 Mojokerto pada Rabu, 23 Juli 2025.">
          <div class="br-item-img"><img src="{{ asset('images/berita/wahyu-redjo.jpeg') }}" alt="SMK Negeri 2 Mojokerto Sukses Laksanakan Rekrutmen Pramuniaga Toko Emas Wahyu Redjo" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-sekolah"><i class="fas fa-school"></i> Sekolah</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 23 Juli 2025</span>
            </div>
            <h3><a href="#">SMK Negeri 2 Mojokerto Sukses Laksanakan Rekrutmen Pramuniaga Toko Emas Wahyu Redjo</a></h3>
            <p class="br-item-excerpt">Kegiatan Rekrutmen Pramuniaga Toko Emas Wahyu Redjo dilaksanakan bekerja sama dengan BKK SMK Negeri 2 Mojokerto pada Rabu, 23 Juli 2025.</p>
          </div>
        </article>

<article class="br-item" data-reveal data-cat="akademik" data-search="LPS SMKN 2 Mojokerto Gelar Literasi Keuangan Bersama FIF Group Kegiatan Literasi Keuangan dan Edukasi Pembiayaan bersama FIF Group dilaksanakan oleh jurusan Layanan Perbankan Syariah (LPS) SMK Negeri 2 Mojokerto pada Kamis, 24 Juli 2025, di Aula SMK Negeri 2 Mojokerto.">
          <div class="br-item-img"><img src="{{ asset('images/berita/literasikeuangan.jpeg') }}" alt="LPS SMKN 2 Mojokerto Gelar Literasi Keuangan Bersama FIF Group" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-akademik"><i class="fas fa-book-open"></i> Akademik</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 24 Juli 2025</span>
            </div>
            <h3><a href="#">LPS SMKN 2 Mojokerto Gelar Literasi Keuangan Bersama FIF Group</a></h3>
            <p class="br-item-excerpt">Kegiatan Literasi Keuangan dan Edukasi Pembiayaan bersama FIF Group dilaksanakan oleh jurusan Layanan Perbankan Syariah (LPS) SMK Negeri 2 Mojokerto pada Kamis, 24 Juli 2025, di Aula SMK Negeri 2 Mojokerto.</p>
          </div>
        </article>

<article class="br-item" data-reveal data-cat="akademik" data-search="RPL SMKN 2 Mojokerto Gelar Pelatihan Web dengan Framework Laravel 2024 Kegiatan Pelatihan Web dengan Framework Laravel dilaksanakan pada September 2024 dan diikuti oleh 37 perwakilan siswa kelas XII SMK Negeri 2 Mojokerto.">
          <div class="br-item-img"><img src="{{ asset('images/berita/pelatihan-web.jpeg') }}" alt="RPL SMKN 2 Mojokerto Gelar Pelatihan Web dengan Framework Laravel 2024" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-akademik"><i class="fas fa-book-open"></i> Akademik</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> September 2024</span>
            </div>
            <h3><a href="#">RPL SMKN 2 Mojokerto Gelar Pelatihan Web dengan Framework Laravel 2024</a></h3>
            <p class="br-item-excerpt">Kegiatan Pelatihan Web dengan Framework Laravel dilaksanakan pada September 2024 dan diikuti oleh 37 perwakilan siswa kelas XII SMK Negeri 2 Mojokerto.</p>
          </div>
        </article>

<article class="br-item" data-reveal data-cat="sekolah" data-search="Istimewa! SMKN 2 Mojokerto Berhasil Menggelar Pemilihan Ketua OSIS Periode 2024–2025 Kegiatan Pemilihan Ketua OSIS Periode 2024–2025 dilaksanakan pada 19 September 2024 dan diikuti oleh 1.216 siswa SMK Negeri 2 Mojokerto.">
          <div class="br-item-img"><img src="{{ asset('images/berita/pemilos.jpeg') }}" alt="Istimewa! SMKN 2 Mojokerto Berhasil Menggelar Pemilihan Ketua OSIS Periode 2024–2025" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-sekolah"><i class="fas fa-school"></i> Sekolah</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 19 September 2024</span>
            </div>
            <h3><a href="#">Istimewa! SMKN 2 Mojokerto Berhasil Menggelar Pemilihan Ketua OSIS Periode 2024–2025</a></h3>
            <p class="br-item-excerpt">Kegiatan Pemilihan Ketua OSIS Periode 2024–2025 dilaksanakan pada 19 September 2024 dan diikuti oleh 1.216 siswa SMK Negeri 2 Mojokerto.</p>
          </div>
        </article>

<article class="br-item" data-reveal data-cat="sekolah" data-search="Skaneda Kawi Laras (Kamis Wiwitan Laku Adab Lan Rasa Sayekti) Program Kawi Laras (Kamis Wiwitan Laku Adab Lan Rasa Sayekti) merupakan program budaya yang dilaksanakan SMKN 2 Mojokerto setiap minggu kedua dalam satu bulan.">
          <div class="br-item-img"><img src="{{ asset('images/berita/kawi-laras.jpeg') }}" alt="Skaneda Kawi Laras (Kamis Wiwitan Laku Adab Lan Rasa Sayekti)" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-sekolah"><i class="fas fa-school"></i> Sekolah</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> Program budaya</span>
            </div>
            <h3><a href="#">Skaneda Kawi Laras (Kamis Wiwitan Laku Adab Lan Rasa Sayekti)</a></h3>
            <p class="br-item-excerpt">Program Kawi Laras (Kamis Wiwitan Laku Adab Lan Rasa Sayekti) merupakan program budaya yang dilaksanakan SMKN 2 Mojokerto setiap minggu kedua dalam satu bulan.</p>
          </div>
        </article>

<article class="br-item" data-reveal data-cat="akademik" data-search="Sukses! SMK Negeri 2 Mojokerto Laksanakan Survei Lingkungan Belajar Kegiatan Survei Lingkungan Belajar (Sulingjar) dilaksanakan pada 19 September 2024 dan diikuti oleh seluruh guru SMK Negeri 2 Mojokerto.">
          <div class="br-item-img"><img src="{{ asset('images/berita/survei-lb.jpeg') }}" alt="Sukses! SMK Negeri 2 Mojokerto Laksanakan Survei Lingkungan Belajar" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-akademik"><i class="fas fa-book-open"></i> Akademik</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 19 September 2024</span>
            </div>
            <h3><a href="#">Sukses! SMK Negeri 2 Mojokerto Laksanakan Survei Lingkungan Belajar</a></h3>
            <p class="br-item-excerpt">Kegiatan Survei Lingkungan Belajar (Sulingjar) dilaksanakan pada 19 September 2024 dan diikuti oleh seluruh guru SMK Negeri 2 Mojokerto.</p>
          </div>
        </article>

<article class="br-item br-extra" data-reveal data-cat="kegiatan" data-search="P5: Bazar Makanan Tradisional Melaksanakan kegiatan Projek Penguatan Profil Pelajar Pancasila (P5) melalui kegiatan bazar makanan tradisional.">
          <div class="br-item-img"><img src="{{ asset('images/berita/bazar.jpeg') }}" alt="P5: Bazar Makanan Tradisional" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> Projek P5</span>
            </div>
            <h3><a href="#">P5: Bazar Makanan Tradisional</a></h3>
            <p class="br-item-excerpt">Melaksanakan kegiatan Projek Penguatan Profil Pelajar Pancasila (P5) melalui kegiatan bazar makanan tradisional.</p>
          </div>
        </article>

<article class="br-item br-extra" data-reveal data-cat="kegiatan" data-search="Tes Kebugaran Sehat: Program Unggulan Gerakan Sekolah Sehat SMK Negeri 2 Mojokerto Kegiatan Tes Kebugaran sebagai bagian dari Program Gerakan Sekolah Sehat dilaksanakan pada 21 Agustus 2024 di SMK Negeri 2 Mojokerto.">
          <div class="br-item-img"><img src="{{ asset('images/berita/tes-kebugaran.jpeg') }}" alt="Tes Kebugaran Sehat: Program Unggulan Gerakan Sekolah Sehat SMK Negeri 2 Mojokerto" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 21 Agustus 2024</span>
            </div>
            <h3><a href="#">Tes Kebugaran Sehat: Program Unggulan Gerakan Sekolah Sehat SMK Negeri 2 Mojokerto</a></h3>
            <p class="br-item-excerpt">Kegiatan Tes Kebugaran sebagai bagian dari Program Gerakan Sekolah Sehat dilaksanakan pada 21 Agustus 2024 di SMK Negeri 2 Mojokerto.</p>
          </div>
        </article>

<article class="br-item br-extra" data-reveal data-cat="kegiatan" data-search="SMK Negeri 2 Mojokerto: Sekolah Pioneer, Gerakan Sekolah Sehat 2024 SMK Negeri 2 Mojokerto ditunjuk sebagai perwakilan Kota Mojokerto dalam Program Gerakan Sekolah Sehat yang dicanangkan oleh pemerintah melalui Dinas Pendidikan Provinsi Jawa Timur.">
          <div class="br-item-img"><img src="{{ asset('images/berita/sekolah-pioneer.jpeg') }}" alt="SMK Negeri 2 Mojokerto: Sekolah Pioneer, Gerakan Sekolah Sehat 2024" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 2024</span>
            </div>
            <h3><a href="#">SMK Negeri 2 Mojokerto: Sekolah Pioneer, Gerakan Sekolah Sehat 2024</a></h3>
            <p class="br-item-excerpt">SMK Negeri 2 Mojokerto ditunjuk sebagai perwakilan Kota Mojokerto dalam Program Gerakan Sekolah Sehat yang dicanangkan oleh pemerintah melalui Dinas Pendidikan Provinsi Jawa Timur.</p>
          </div>
        </article>

<article class="br-item br-extra" data-reveal data-cat="akademik" data-search="Sukses! SMKN 2 Mojokerto Berhasil Laksanakan Tes Asesmen Nasional Berbasis Komputer 2024 Kegiatan Asesmen Nasional Berbasis Komputer (ANBK) dilaksanakan pada 21–22 Agustus 2024 di Lab RPL SMK Negeri 2 Mojokerto.">
          <div class="br-item-img"><img src="{{ asset('images/berita/anbk.jpeg') }}" alt="Sukses! SMKN 2 Mojokerto Berhasil Laksanakan Tes Asesmen Nasional Berbasis Komputer 2024" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-akademik"><i class="fas fa-book-open"></i> Akademik</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 21–22 Agustus 2024</span>
            </div>
            <h3><a href="#">Sukses! SMKN 2 Mojokerto Berhasil Laksanakan Tes Asesmen Nasional Berbasis Komputer 2024</a></h3>
            <p class="br-item-excerpt">Kegiatan Asesmen Nasional Berbasis Komputer (ANBK) dilaksanakan pada 21–22 Agustus 2024 di Lab RPL SMK Negeri 2 Mojokerto.</p>
          </div>
        </article>

<article class="br-item br-extra" data-reveal data-cat="kegiatan" data-search="Khidmat! SMK Negeri 2 Mojokerto Peringati Hari Pramuka Ke-63 Tahun 2024 Kegiatan Peringatan Hari Pramuka ke-63 dilaksanakan pada 14 Agustus 2024 dan diikuti oleh seluruh siswa kelas X, XI, dan XII SMK Negeri 2 Mojokerto.">
          <div class="br-item-img"><img src="{{ asset('images/berita/haripramuka.jpeg') }}" alt="Khidmat! SMK Negeri 2 Mojokerto Peringati Hari Pramuka Ke-63 Tahun 2024" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 14 Agustus 2024</span>
            </div>
            <h3><a href="#">Khidmat! SMK Negeri 2 Mojokerto Peringati Hari Pramuka Ke-63 Tahun 2024</a></h3>
            <p class="br-item-excerpt">Kegiatan Peringatan Hari Pramuka ke-63 dilaksanakan pada 14 Agustus 2024 dan diikuti oleh seluruh siswa kelas X, XI, dan XII SMK Negeri 2 Mojokerto.</p>
          </div>
        </article>

<article class="br-item br-extra" data-reveal data-cat="kegiatan" data-search="Istighosah Akbar, Program Unggulan Keagamaan di SMK Negeri 2 Mojokerto Kegiatan Istighosah Akbar dilaksanakan pada Jumat, 9 Agustus 2024 dan diikuti oleh seluruh siswa kelas X, XI, dan XII SMK Negeri 2 Mojokerto.">
          <div class="br-item-img"><img src="{{ asset('images/berita/istighosah.jpeg') }}" alt="Istighosah Akbar, Program Unggulan Keagamaan di SMK Negeri 2 Mojokerto" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 9 Agustus 2024</span>
            </div>
            <h3><a href="#">Istighosah Akbar, Program Unggulan Keagamaan di SMK Negeri 2 Mojokerto</a></h3>
            <p class="br-item-excerpt">Kegiatan Istighosah Akbar dilaksanakan pada Jumat, 9 Agustus 2024 dan diikuti oleh seluruh siswa kelas X, XI, dan XII SMK Negeri 2 Mojokerto.</p>
          </div>
        </article>

<article class="br-item br-extra" data-reveal data-cat="akademik" data-search="SMKN 2 Mojokerto Gelar Kerjasama dengan Program Bakti BCA yang Didukung oleh OJK Kegiatan Program Bakti BCA dilaksanakan pada 8 Agustus 2024 di Aula SMK Negeri 2 Mojokerto dan diikuti oleh siswa kelas XII Layanan Perbankan Syariah (LPS).">
          <div class="br-item-img"><img src="{{ asset('images/berita/bakti-bca.jpeg') }}" alt="SMKN 2 Mojokerto Gelar Kerjasama dengan Program Bakti BCA yang Didukung oleh OJK" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-akademik"><i class="fas fa-book-open"></i> Akademik</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 8 Agustus 2024</span>
            </div>
            <h3><a href="#">SMKN 2 Mojokerto Gelar Kerjasama dengan Program Bakti BCA yang Didukung oleh OJK</a></h3>
            <p class="br-item-excerpt">Kegiatan Program Bakti BCA dilaksanakan pada 8 Agustus 2024 di Aula SMK Negeri 2 Mojokerto dan diikuti oleh siswa kelas XII Layanan Perbankan Syariah (LPS).</p>
          </div>
        </article>

<article class="br-item br-extra" data-reveal data-cat="akademik" data-search="Sukses! SMKN 2 Mojokerto Berhasil Menggelar Tes TOEIC 2024 Kegiatan Tes TOEIC 2024 dilaksanakan pada 7 Agustus 2024 di Lab DKV SMK Negeri 2 Mojokerto dan diikuti oleh 24 siswa perwakilan dari berbagai jurusan.">
          <div class="br-item-img"><img src="{{ asset('images/berita/tes-toeic.jpeg') }}" alt="Sukses! SMKN 2 Mojokerto Berhasil Menggelar Tes TOEIC 2024" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-akademik"><i class="fas fa-book-open"></i> Akademik</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 7 Agustus 2024</span>
            </div>
            <h3><a href="#">Sukses! SMKN 2 Mojokerto Berhasil Menggelar Tes TOEIC 2024</a></h3>
            <p class="br-item-excerpt">Kegiatan Tes TOEIC 2024 dilaksanakan pada 7 Agustus 2024 di Lab DKV SMK Negeri 2 Mojokerto dan diikuti oleh 24 siswa perwakilan dari berbagai jurusan.</p>
          </div>
        </article>

<article class="br-item br-extra" data-reveal data-cat="akademik" data-search="Treasury Goes To School SMK Negeri 2 Mojokerto Dua Dekade Indonesian Treasury, Terus Berinovasi Melayani Negeri Kegiatan Treasury Goes To School dilaksanakan pada 25 Juli 2024 di Aula SMK Negeri 2 Mojokerto dan diikuti oleh siswa jurusan Layanan Perbankan Syariah (LPS).">
          <div class="br-item-img"><img src="{{ asset('images/berita/treasury.jpeg') }}" alt="Treasury Goes To School SMK Negeri 2 Mojokerto Dua Dekade Indonesian Treasury, Terus Berinovasi Melayani Negeri" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-akademik"><i class="fas fa-book-open"></i> Akademik</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 25 Juli 2024</span>
            </div>
            <h3><a href="#">Treasury Goes To School SMK Negeri 2 Mojokerto Dua Dekade Indonesian Treasury, Terus Berinovasi Melayani Negeri</a></h3>
            <p class="br-item-excerpt">Kegiatan Treasury Goes To School dilaksanakan pada 25 Juli 2024 di Aula SMK Negeri 2 Mojokerto dan diikuti oleh siswa jurusan Layanan Perbankan Syariah (LPS).</p>
          </div>
        </article>

<article class="br-item br-extra" data-reveal data-cat="kegiatan" data-search="LDKPD SMKN 2 Mojokerto: Membangun Jiwa Kepemimpinan dan Kesiapan Pengurus OSIS Kegiatan Latihan Dasar Kepemimpinan Peserta Didik (LDKPD) dilaksanakan pada 13–14 Oktober 2023 di Royal Hotel Trawas Mojokerto dan diikuti oleh sekitar 65 peserta.">
          <div class="br-item-img"><img src="{{ asset('images/berita/ldkpd.jpeg') }}" alt="LDKPD SMKN 2 Mojokerto: Membangun Jiwa Kepemimpinan dan Kesiapan Pengurus OSIS" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 13–14 Oktober 2023</span>
            </div>
            <h3><a href="#">LDKPD SMKN 2 Mojokerto: Membangun Jiwa Kepemimpinan dan Kesiapan Pengurus OSIS</a></h3>
            <p class="br-item-excerpt">Kegiatan Latihan Dasar Kepemimpinan Peserta Didik (LDKPD) dilaksanakan pada 13–14 Oktober 2023 di Royal Hotel Trawas Mojokerto dan diikuti oleh sekitar 65 peserta.</p>
          </div>
        </article>

<article class="br-item br-extra" data-reveal data-cat="kegiatan" data-search="Pentingnya Kegiatan Kunjungan Industri bagi Siswa SMK Kegiatan Kunjungan Industri (KI) dilaksanakan oleh siswa kelas X RPL SMK Negeri 2 Mojokerto pada 13 Desember 2022 di Maspion IT.">
          <div class="br-item-img"><img src="{{ asset('images/berita/KI.jpeg') }}" alt="Pentingnya Kegiatan Kunjungan Industri bagi Siswa SMK" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 13 Desember 2022</span>
            </div>
            <h3><a href="#">Pentingnya Kegiatan Kunjungan Industri bagi Siswa SMK</a></h3>
            <p class="br-item-excerpt">Kegiatan Kunjungan Industri (KI) dilaksanakan oleh siswa kelas X RPL SMK Negeri 2 Mojokerto pada 13 Desember 2022 di Maspion IT.</p>
          </div>
        </article>

<article class="br-item br-extra" data-reveal data-cat="sekolah" data-search="BKK SMKN 2 Mojokerto Berinovasi Adakan Kegiatan Temu Alumni untuk Siswa Baru Data isi artikel tidak tercantum pada dokumen Word yang tersedia.">
          <div class="br-item-img"><img src="{{ asset('images/berita/temu-alumni.jpeg') }}" alt="BKK SMKN 2 Mojokerto Berinovasi Adakan Kegiatan Temu Alumni untuk Siswa Baru" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-sekolah"><i class="fas fa-school"></i> Sekolah</span>
              
            </div>
            <h3><a href="#">BKK SMKN 2 Mojokerto Berinovasi Adakan Kegiatan Temu Alumni untuk Siswa Baru</a></h3>
            <p class="br-item-excerpt">Data isi artikel tidak tercantum pada dokumen Word yang tersedia.</p>
          </div>
        </article>

<article class="br-item br-extra" data-reveal data-cat="sekolah" data-search="BKK SMKN 2 Mojokerto Bekerjasama dengan PT.SAI Selenggarakan Rekrutmen Lulusan SMK BKK SMKN 2 Mojokerto bekerja sama dengan PT. Surabaya Autocomp Indonesia (PT. SAI) dalam kegiatan rekrutmen lulusan SMK yang dilaksanakan di Aula SMKN 2 Mojokerto. Kegiatan ini bertujuan membantu alumni memperoleh kesempatan kerja, khususnya sebagai operator produksi di bidang komponen otomotif Wiring Harness.">
          <div class="br-item-img"><img src="{{ asset('images/berita/pt-sai.jpeg') }}" alt="BKK SMKN 2 Mojokerto Bekerjasama dengan PT.SAI Selenggarakan Rekrutmen Lulusan SMK" loading="lazy"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-sekolah"><i class="fas fa-school"></i> Sekolah</span>
            </div>
            <h3><a href="#">BKK SMKN 2 Mojokerto Bekerjasama dengan PT.SAI Selenggarakan Rekrutmen Lulusan SMK</a></h3>
            <p class="br-item-excerpt">BKK SMKN 2 Mojokerto bekerja sama dengan PT. Surabaya Autocomp Indonesia (PT. SAI) dalam kegiatan rekrutmen lulusan SMK yang dilaksanakan di Aula SMKN 2 Mojokerto.</p>
          </div>
        </article>

        <div class="br-empty" id="brEmpty">
          <i class="fas fa-newspaper"></i>
          Tidak ada berita yang cocok dengan pencarian atau kategori ini. Coba kata kunci lain.
        </div>

        <div class="br-more-wrap">
          <button type="button" class="br-more-btn" id="brMoreBtn">
            <span>Lihat Semua</span><i class="fas fa-chevron-down"></i>
          </button>
        </div>
      </div>

      <aside class="br-most" data-reveal="right">
        <div class="br-most-head">
          <i class="fas fa-newspaper"></i>
          <div><h3>Artikel Pilihan</h3><span>Data Skaneda</span></div>
        </div>
        <div class="br-most-list">
          <a href="#" class="br-most-item" data-news-story="Istighosah Akbar, Program Unggulan Keagamaan di SMK Negeri 2 Mojokerto">
            <span class="br-most-num">01</span>
            <span class="br-most-body"><b>Istighosah Akbar, Program Unggulan Keagamaan di SMK Negeri 2 Mojokerto</b><span><i class="fas fa-newspaper"></i> Baca artikel</span></span>
          </a>
          <a href="#" class="br-most-item" data-news-story="SMKN 2 Mojokerto Gelar Kerjasama dengan Program Bakti BCA yang Didukung oleh OJK">
            <span class="br-most-num">02</span>
            <span class="br-most-body"><b>SMKN 2 Mojokerto Gelar Kerjasama dengan Program Bakti BCA yang Didukung oleh OJK</b><span><i class="fas fa-newspaper"></i> Baca artikel</span></span>
          </a>
          <a href="#" class="br-most-item" data-news-story="LDKPD SMKN 2 Mojokerto: Membangun Jiwa Kepemimpinan dan Kesiapan Pengurus OSIS">
            <span class="br-most-num">03</span>
            <span class="br-most-body"><b>LDKPD SMKN 2 Mojokerto: Membangun Jiwa Kepemimpinan dan Kesiapan Pengurus OSIS</b><span><i class="fas fa-newspaper"></i> Baca artikel</span></span>
          </a>
          <a href="#" class="br-most-item" data-news-story="MAGANG/PRAKERIN SEMAKIN ASYIK BERSAMA JURUSAN PERBANKAN SYARIAH SKANEDA">
            <span class="br-most-num">04</span>
            <span class="br-most-body"><b>Magang/Prakerin Semakin Asyik Bersama Jurusan Perbankan Syariah Skaneda</b><span><i class="fas fa-newspaper"></i> Baca artikel</span></span>
          </a>
          <a href="#" class="br-most-item" data-news-story="BKK SMKN 2 Mojokerto Bekerjasama dengan PT.SAI Selenggarakan Rekrutmen Lulusan SMK">
            <span class="br-most-num">05</span>
            <span class="br-most-body"><b>BKK SMKN 2 Mojokerto Bekerjasama dengan PT.SAI Selenggarakan Rekrutmen Lulusan SMK</b><span><i class="fas fa-newspaper"></i> Baca artikel</span></span>
          </a>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ================= 3. CERITA SKANEDA ================= -->
<section class="br-story">
  <div class="br-story-inner">
    <span class="br-block" style="top:14%;right:10%" aria-hidden="true"></span>
    <span class="br-dots" style="bottom:12%;right:6%" aria-hidden="true"></span>
    <div class="br-sec-head" data-reveal>
      <div>
        <span class="br-eyebrow">Long Read · Feature</span>
        <h2 class="br-sec-title">Cerita <em>Skaneda</em></h2>
        <div class="br-rule"></div>
      </div>
      <div class="br-num" aria-hidden="true">03</div>
    </div>
    <div class="br-story-grid">
      <article class="br-story-card" data-reveal>
        <span class="br-cat br-cat-prestasi"><i class="fas fa-trophy"></i> Feature</span>
        <h4>Uji Kompetensi RPL: Mengasah Kompetensi untuk Dunia Industri</h4>
        <p>UKK RPL menjadi ruang bagi siswa untuk menerapkan keterampilan pemrograman melalui proyek aplikasi berbasis web.</p>
        <button type="button" class="br-story-link" data-story="1">Baca Kisahnya <i class="fas fa-arrow-right"></i></button>
      </article>
      <article class="br-story-card" data-reveal>
        <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Feature</span>
        <h4>Skaneda Kawi Laras: Menjaga Adab dan Rasa Sayekti</h4>
        <p>Kawi Laras menjadi program budaya sekolah yang mengajak warga Skaneda mengenakan busana tradisional Jawa dan menerapkan nilai unggah-ungguh.</p>
        <button type="button" class="br-story-link" data-story="2">Baca Kisahnya <i class="fas fa-arrow-right"></i></button>
      </article>
      <article class="br-story-card" data-reveal>
        <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Feature</span>
        <h4>Magang/Prakerin Perbankan Syariah: Belajar Langsung di Dunia Kerja</h4>
        <p>Program Prakerin memberi kesempatan siswa Perbankan Syariah memperoleh pengalaman kerja langsung di berbagai instansi dan perusahaan mitra.</p>
        <button type="button" class="br-story-link" data-story="3">Baca Kisahnya <i class="fas fa-arrow-right"></i></button>
      </article>
    </div>
  </div>
</section>

    <div class="br-story-modal" id="storyModal1" role="dialog" aria-modal="true" aria-labelledby="storyModalTitle1">
      <div class="br-story-modal-box">
        <button type="button" class="br-story-modal-close" data-close-story aria-label="Tutup"><i class="fas fa-times"></i></button>
        <div class="br-story-modal-category">
          <span class="br-cat br-cat-prestasi"><i class="fas fa-trophy"></i> Feature</span>
        </div>
        <h3 class="br-story-modal-title" id="storyModalTitle1">Uji Kompetensi RPL: Mengasah Kompetensi untuk Dunia Industri</h3>
        <div class="br-story-modal-content">
          <p>Kegiatan ini bertujuan untuk mengukur kemampuan dan pencapaian kompetensi siswa sesuai dengan bidang keahlian yang dipelajari. Pelaksanaan ujian bekerja sama dengan PT Otak Kanan Surabaya dan Khofie Soft dengan melibatkan dewan penguji dari dunia industri serta alumni RPL. Dalam ujian ini, siswa mengerjakan project pembuatan aplikasi berbasis web menggunakan Laravel, seperti aplikasi toko online, perpustakaan digital, dan aplikasi kasir. Melalui kegiatan ini, siswa diharapkan mampu menerapkan keterampilan pemrograman yang telah dipelajari sekaligus mempersiapkan diri untuk menghadapi dunia kerja dan industri. Kegiatan ini juga menjadi kesempatan bagi siswa untuk mengukur dan mengembangkan kemampuan dalam pembuatan aplikasi berbasis web maupun mobile.</p>
        </div>
      </div>
    </div>
    <div class="br-story-modal" id="storyModal2" role="dialog" aria-modal="true" aria-labelledby="storyModalTitle2">
      <div class="br-story-modal-box">
        <button type="button" class="br-story-modal-close" data-close-story aria-label="Tutup"><i class="fas fa-times"></i></button>
        <div class="br-story-modal-category">
          <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Feature</span>
        </div>
        <h3 class="br-story-modal-title" id="storyModalTitle2">Skaneda Kawi Laras: Menjaga Adab dan Rasa Sayekti</h3>
        <div class="br-story-modal-content">
          <p>Kegiatan ini mengajak seluruh siswa, guru, dan karyawan untuk mengenakan pakaian tradisional Jawa seperti lurik dan kebaya serta menerapkan nilai-nilai budaya Jawa dalam kehidupan sehari-hari. Program ini bertujuan untuk melestarikan budaya dan mengenalkan kembali nilai unggah-ungguh, sopan santun, rasa hormat, serta tepa selira kepada siswa. Kegiatan Kawi Laras mendapat dukungan dari seluruh keluarga besar SMKN 2 Mojokerto dan diharapkan dapat membentuk siswa yang berkarakter, santun, serta tetap menghargai budaya Jawa.</p>
        </div>
      </div>
    </div>
    <div class="br-story-modal" id="storyModal3" role="dialog" aria-modal="true" aria-labelledby="storyModalTitle3">
      <div class="br-story-modal-box">
        <button type="button" class="br-story-modal-close" data-close-story aria-label="Tutup"><i class="fas fa-times"></i></button>
        <div class="br-story-modal-category">
          <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Feature</span>
        </div>
        <h3 class="br-story-modal-title" id="storyModalTitle3">Magang/Prakerin Perbankan Syariah: Belajar Langsung di Dunia Kerja</h3>
        <div class="br-story-modal-content">
          <p>Kegiatan ini dilaksanakan oleh siswa kelas XI selama enam bulan sebagai bentuk penerapan kompetensi yang telah dipelajari di sekolah. Pada Januari 2023, siswa kelas XI Perbankan Syariah diberangkatkan ke berbagai instansi dan perusahaan mitra, seperti Bank Muamalat, Bank Syariah Indonesia, Bank Jatim, BPRS, KPPN, BAZNAS, dan beberapa instansi lainnya. Sebelum melaksanakan Prakerin, siswa dibekali keterampilan sesuai bidang keahlian, kemampuan beradaptasi, serta karakter dan etos kerja. Melalui kegiatan Prakerin, siswa diharapkan dapat meningkatkan keterampilan, kedisiplinan, tanggung jawab, kepercayaan diri, serta memahami secara langsung dunia kerja sesuai dengan kompetensi yang dimiliki.</p>
        </div>
      </div>
    </div>


<!-- ================= CTA ================= -->
<section class="br-cta">
  <div class="br-cta-box">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span><span class="ho-line"></span><span class="ho-dots"></span>
      <span class="ho-ring"></span><span class="ho-gold"></span><span class="ho-square"></span>
    </div>
    <h2 class="br-cta-title">Punya kabar menarik<br>dari <em>Skaneda?</em></h2>
    <p>Kirim liputan, dokumentasi kegiatan, atau karya jurnalistikmu untuk dimuat di kanal Berita Skaneda — redaksi terbuka untuk seluruh warga sekolah.</p>
    <a href="{{ route('kontak') }}" class="br-cta-btn"><i class="fas fa-paper-plane"></i> Kirim ke Redaksi</a>
    <div class="br-cta-note"><i class="fas fa-info-circle"></i> Informasi resmi: smkn2mojokerto.sch.id · #DisiplinBerprestasi</div>
  </div>
</section>


<!-- ================= MODAL DETAIL BERITA ================= -->
<div class="br-news-modal" id="newsModal" role="dialog" aria-modal="true" aria-labelledby="newsModalTitle">
  <div class="br-news-modal-box">
    <button type="button" class="br-news-modal-close" id="newsModalClose" aria-label="Tutup">
      <i class="fas fa-times"></i>
    </button>
    <div class="br-news-modal-category" id="newsModalCategory"></div>
    <h3 class="br-news-modal-title" id="newsModalTitle"></h3>
    <div class="br-news-modal-content" id="newsModalContent"></div>
    <div class="br-news-modal-source">
      <i class="fas fa-database"></i>
      <span>Informasi berdasarkan data berita pada dokumen sumber sekolah.</span>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
(function () {
  'use strict';

  /* =========================================================
     DATA BERITA
     Bersumber dari dokumen Word yang dikirim bersama halaman.
     Setiap tombol "Baca Kisahnya" mengambil isi lengkap dari
     data ini dan menampilkannya dalam modal.
     ========================================================= */
  var newsData = {"Uji Kompetensi Keahlian (UKK) Jurusan APHP":["Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Agribisnis Pengolahan Hasil Pertanian (APHP) dengan melakukan praktik pembuatan produk roti. Kegiatan dimulai dari menyiapkan dan menimbang bahan sesuai takaran, mencampurkan bahan hingga menjadi adonan, melakukan proses pengulenan dan fermentasi, kemudian membentuk adonan sesuai ukuran. Setelah itu, adonan dipanggang hingga matang, kemudian dilakukan pengecekan hasil dan pengemasan produk roti agar siap disajikan."],"Uji Kompetensi Keahlian (UKK) Jurusan DKV":["Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Desain Komunikasi Visual (DKV) dengan membuat dan menampilkan cosplay berdasarkan karakter yang disukai. Selain itu, kegiatan juga meliputi pembuatan desain flyer sebagai media visual untuk memperkenalkan karakter atau konsep yang dipilih. Setelah desain selesai, hasil flyer dan konsep cosplay dipresentasikan di depan untuk menjelaskan ide, proses pembuatan, serta konsep desain yang digunakan."],"Uji Kompetensi Keahlian (UKK) Jurusan Kuliner":["Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Kuliner dengan melakukan praktik pengolahan dan penyajian makanan. Kegiatan tidak hanya mencakup proses persiapan bahan dan pembuatan makanan, tetapi juga penataan hidangan agar terlihat menarik dan sesuai standar penyajian. Setelah makanan siap, peserta melakukan pelayanan kepada tamu seperti pada pelayanan di hotel, mulai dari menyiapkan meja, menyajikan hidangan, hingga memberikan pelayanan dengan sikap yang ramah dan profesional."],"Uji Kompetensi Keahlian (UKK) Jurusan LPS":["Melaksanakan kegiatan Uji Kompetensi Keahlian (UKK) pada jurusan Layanan Perbankan Syariah (LPS) dengan melakukan praktik yang berkaitan dengan pelayanan di bidang perbankan. Kegiatan meliputi persiapan dan penyampaian informasi kepada nasabah serta praktik komunikasi dan pelayanan secara langsung. Peserta juga mempresentasikan hasil atau materi yang telah dipersiapkan di depan penguji sebagai bagian dari penilaian kompetensi, dengan memperhatikan sikap, komunikasi, ketelitian, dan profesionalitas dalam memberikan pelayanan.","Acara P5 (tahun 2024)"],"P5: Bazar Makanan Tradisional":["Melaksanakan kegiatan Projek Penguatan Profil Pelajar Pancasila (P5) melalui kegiatan bazar makanan tradisional. Setiap jurusan dan seluruh angkatan bekerja sama dalam satu stan bazar dengan menjual berbagai macam makanan tradisional. Kegiatan ini meliputi persiapan produk, penataan stan, pelayanan kepada pembeli, hingga proses penjualan. Melalui kegiatan ini, siswa dapat belajar bekerja sama, berkomunikasi, mengelola penjualan, serta meningkatkan kreativitas dan jiwa kewirausahaan."],"P5: Praktik Simulasi Pernikahan":["Melaksanakan kegiatan Projek Penguatan Profil Pelajar Pancasila (P5) melalui praktik simulasi pernikahan yang dilakukan oleh siswa kelas XI. Kegiatan ini merupakan penerapan dari materi pembelajaran tentang pernikahan yang telah dipelajari di kelas. Dalam praktiknya, siswa melakukan simulasi rangkaian prosesi pernikahan dengan pembagian peran sesuai tugas masing-masing. Kegiatan ini bertujuan untuk memberikan pengalaman secara langsung serta meningkatkan pemahaman siswa mengenai proses dan ketentuan dalam pernikahan."],"Paduan Suara Skaneda":["Melaksanakan kegiatan paduan suara yang diikuti oleh seluruh angkatan sebagai bagian dari kegiatan sekolah. Setiap kelas mengirimkan empat perwakilan yang terdiri dari dua siswa laki-laki dan dua siswa perempuan. Para peserta berlatih bersama untuk menyatukan suara, menjaga kekompakan, serta mempersiapkan penampilan paduan suara. Kegiatan ini bertujuan untuk meningkatkan kerja sama, kedisiplinan, dan rasa percaya diri siswa dalam bernyanyi secara berkelompok.","Event"],"SMKN 2 Mojokerto Jadi Tuan Rumah Pelatihan Pembelajaran Mendalam Batch 2 untuk Meningkatkan Kompetensi Guru":["Kegiatan Pelatihan Pembelajaran Mendalam bagi Guru Jenjang SMK Batch 2 dilaksanakan selama enam hari, mulai tanggal 11 hingga 16 Agustus 2025, bertempat di Aula SMK Negeri 2 Mojokerto. Kegiatan ini diikuti oleh 25 guru, yang terdiri dari 12 guru dari Kabupaten Mojokerto dan 13 guru dari Kota Mojokerto, serta dibuka secara resmi oleh Bapak Mudianto, S.Pd., M.M.","Pelatihan ini bertujuan untuk meningkatkan pemahaman dan kompetensi guru mengenai pembelajaran mendalam sehingga nantinya dapat menjadi fasilitator dan menyebarluaskan ilmu yang diperoleh ke sekolah masing-masing maupun sekolah lainnya. Dalam kegiatan tersebut, guru mendapatkan pembekalan mengenai perencanaan, pelaksanaan, dan evaluasi pembelajaran, serta pentingnya meningkatkan potensi dan profesionalitas sebagai seorang pendidik.","Kegiatan ini mendapat dukungan dari pihak SMK Negeri 2 Mojokerto, termasuk kepala sekolah, wakil kepala sekolah bidang kurikulum, dewan guru, staf, dan karyawan. Melalui pelatihan ini, diharapkan para guru dapat bersinergi dan menerapkan pembelajaran mendalam secara lebih baik dalam proses pembelajaran di sekolah."],"Sosialisasi Genre Goes To School Ciptakan Harmonisasi di Kalangan Siswa di SMK Negeri 2 Mojokerto":["Kegiatan Sosialisasi Genre Goes To School dilaksanakan di Aula SMK Negeri 2 Mojokerto pada Rabu, 6 Agustus 2025. Kegiatan ini diselenggarakan oleh Dinas Kesehatan Kota Mojokerto melalui Duta Genre yang bekerja sama dengan ekstrakurikuler PIK-R dan diikuti oleh 40 siswa anggota PIK-R.","Kegiatan ini bertujuan untuk meningkatkan pemahaman dan peran anggota PIK-R sebagai konselor sebaya yang dapat menjadi teman serta tempat berbagi bagi siswa lainnya. Selain itu, kegiatan ini juga mendukung upaya SMK Negeri 2 Mojokerto dalam mewujudkan Sekolah Siaga Kependudukan. Melalui sosialisasi ini, siswa diharapkan mampu memberikan motivasi, dukungan, dan informasi yang bermanfaat bagi teman sebaya."],"SMK Negeri 2 Mojokerto Sukses Laksanakan Rekrutmen Pramuniaga Toko Emas Wahyu Redjo":["Kegiatan Rekrutmen Pramuniaga Toko Emas Wahyu Redjo dilaksanakan bekerja sama dengan BKK SMK Negeri 2 Mojokerto pada Rabu, 23 Juli 2025. Kegiatan ini diikuti oleh 131 siswa kelas XII dan bertempat di Lab RPL SMK Negeri 2 Mojokerto.","Kegiatan rekrutmen ini bertujuan untuk memberikan kesempatan kepada lulusan SMK Negeri 2 Mojokerto agar dapat memperoleh pekerjaan sesuai dengan kualifikasi dan kompetensi yang dimiliki. Melalui kegiatan ini, peserta mengikuti proses seleksi untuk mendapatkan kesempatan bekerja sebagai pramuniaga di Toko Emas Wahyu Redjo.","Kegiatan ini mendapat dukungan dari pihak sekolah dan BKK SMK Negeri 2 Mojokerto. Diharapkan melalui kegiatan rekrutmen seperti ini, semakin banyak lulusan yang dapat langsung memasuki dunia kerja setelah menyelesaikan pendidikan serta memiliki pengalaman dalam mengikuti proses seleksi kerja."],"LPS SMKN 2 Mojokerto Gelar Literasi Keuangan Bersama FIF Group":["Kegiatan Literasi Keuangan dan Edukasi Pembiayaan bersama FIF Group dilaksanakan oleh jurusan Layanan Perbankan Syariah (LPS) SMK Negeri 2 Mojokerto pada Kamis, 24 Juli 2025, di Aula SMK Negeri 2 Mojokerto. Kegiatan ini diikuti oleh 72 siswa kelas XI LPS 1 dan XI LPS 2.","Kegiatan ini bertujuan untuk meningkatkan pemahaman siswa mengenai literasi keuangan, konsep pembiayaan, serta Industri Keuangan Non Bank (IKNB) melalui kerja sama dengan DUDI FIF Group Mojokerto. Selain memperoleh materi dari praktisi, siswa juga mendapatkan wawasan tentang dunia kerja dan peluang pengembangan kompetensi di bidang perbankan syariah. Diharapkan kegiatan ini dapat memperkuat kerja sama antara sekolah dan dunia industri serta mempersiapkan siswa menghadapi dunia kerja maupun kewirausahaan."],"RPL SMKN 2 Mojokerto Gelar Pelatihan Web dengan Framework Laravel 2024":["Kegiatan Pelatihan Web dengan Framework Laravel dilaksanakan pada September 2024 dan diikuti oleh 37 perwakilan siswa kelas XII SMK Negeri 2 Mojokerto. Pelatihan ini bertujuan untuk meningkatkan kompetensi siswa di bidang pengembangan perangkat lunak, khususnya penggunaan framework Laravel sebagai persiapan menghadapi UKK dan dunia kerja.","Kegiatan dibimbing langsung oleh guru tamu yang merupakan alumni SMK Negeri 2 Mojokerto, yaitu Khafid Ilham dan Bachtiar Affandy. Melalui pelatihan ini, siswa mendapatkan pengalaman dan pengetahuan tambahan dalam coding serta pengerjaan proyek menggunakan Laravel sehingga dapat lebih siap dalam menghadapi UKK dan mengembangkan keterampilan di bidang pemrograman."],"Istimewa! SMKN 2 Mojokerto Berhasil Menggelar Pemilihan Ketua OSIS Periode 2024–2025":["Kegiatan Pemilihan Ketua OSIS Periode 2024–2025 dilaksanakan pada 19 September 2024 dan diikuti oleh 1.216 siswa SMK Negeri 2 Mojokerto. Kegiatan ini merupakan agenda rutin sekolah yang bertujuan untuk memberikan kesempatan kepada siswa dalam memilih pemimpin serta menjadi bagian dari proses kaderisasi kepemimpinan di lingkungan sekolah.","Dalam pemilihan tersebut, terdapat tiga pasangan calon yang menyampaikan visi dan misi sebelum proses pencoblosan. Berdasarkan hasil penghitungan suara, Paslon 2, yaitu Lola Devia dan Carla Nur, memperoleh suara terbanyak dengan 481 suara. Kegiatan ini didukung oleh pihak sekolah, dewan guru, dan Pembina OSIS serta dilaksanakan dengan mengedepankan kekompakan, solidaritas, dan integritas."],"Skaneda Kawi Laras (Kamis Wiwitan Laku Adab Lan Rasa Sayekti)":["Program Kawi Laras (Kamis Wiwitan Laku Adab Lan Rasa Sayekti) merupakan program budaya yang dilaksanakan SMKN 2 Mojokerto setiap minggu kedua dalam satu bulan. Kegiatan ini mengajak seluruh siswa, guru, dan karyawan untuk mengenakan pakaian tradisional Jawa seperti lurik dan kebaya serta menerapkan nilai-nilai budaya Jawa dalam kehidupan sehari-hari.","Program ini bertujuan untuk melestarikan budaya dan mengenalkan kembali nilai unggah-ungguh, sopan santun, rasa hormat, serta tepa selira kepada siswa. Kegiatan Kawi Laras mendapat dukungan dari seluruh keluarga besar SMKN 2 Mojokerto dan diharapkan dapat membentuk siswa yang berkarakter, santun, serta tetap menghargai budaya Jawa."],"Sukses! SMK Negeri 2 Mojokerto Laksanakan Survei Lingkungan Belajar":["Kegiatan Survei Lingkungan Belajar (Sulingjar) dilaksanakan pada 19 September 2024 dan diikuti oleh seluruh guru SMK Negeri 2 Mojokerto. Sulingjar merupakan survei yang digunakan untuk mengevaluasi dan memetakan berbagai aspek yang mendukung kualitas pembelajaran di lingkungan sekolah.","Melalui kegiatan ini, sekolah dapat mengetahui kondisi lingkungan belajar, kualitas pembelajaran, serta faktor-faktor yang dapat memengaruhi hasil belajar siswa. Sulingjar juga mencakup aspek keamanan, kebinekaan, kesetaraan, inklusivitas, kepemimpinan sekolah, serta dukungan orang tua dan siswa. Kegiatan ini diharapkan dapat membantu menciptakan lingkungan belajar yang aman, nyaman, dan menyenangkan."],"Sukses! Rekayasa Perangkat Lunak (RPL) SMK Negeri 2 Mojokerto Laksanakan Uji Kompetensi Keahlian":["Kegiatan Uji Kompetensi Kelulusan Kompetensi Keahlian Rekayasa Perangkat Lunak (RPL) dilaksanakan pada 18–20 Februari 2025 dan diikuti oleh siswa kelas XII RPL SMK Negeri 2 Mojokerto. Kegiatan ini bertujuan untuk mengukur kemampuan dan pencapaian kompetensi siswa sesuai dengan bidang keahlian yang dipelajari.","Pelaksanaan ujian bekerja sama dengan PT Otak Kanan Surabaya dan Khofie Soft dengan melibatkan dewan penguji dari dunia industri serta alumni RPL. Dalam ujian ini, siswa mengerjakan project pembuatan aplikasi berbasis web menggunakan Laravel, seperti aplikasi toko online, perpustakaan digital, dan aplikasi kasir.","Melalui kegiatan ini, siswa diharapkan mampu menerapkan keterampilan pemrograman yang telah dipelajari sekaligus mempersiapkan diri untuk menghadapi dunia kerja dan industri. Kegiatan ini juga menjadi kesempatan bagi siswa untuk mengukur dan mengembangkan kemampuan dalam pembuatan aplikasi berbasis web maupun mobile."],"Sukses dan Kompeten! Kuliner SMK Negeri 2 Mojokerto Laksanakan Uji Kompetensi Keahlian":["Kegiatan Uji Kompetensi Keahlian (UKK) Kuliner dilaksanakan pada 17–21 Februari 2025 dan diikuti oleh siswa kelas XII Kompetensi Keahlian Kuliner SMK Negeri 2 Mojokerto. Kegiatan ini bertujuan untuk menguji kemampuan siswa dalam bidang Pastry dan Cookery dengan melibatkan penguji dari Hotel Vasa Surabaya dan SHS Surabaya.","Materi yang diujikan meliputi pembuatan roti, choux paste, dan cake pada bidang Pastry, serta pembuatan masakan kontinental seperti appetizer, sandwich, soup, dan main course pada bidang Cookery. Melalui kegiatan ini, siswa dapat menerapkan keterampilan yang telah dipelajari, meningkatkan kepercayaan diri, serta mempersiapkan diri untuk menghadapi dunia kerja di bidang kuliner."],"Selamat dan Sukses! Desain Komunikasi Visual SMK Negeri 2 Mojokerto Laksanakan Uji Kompetensi Keahlian":["Kegiatan Uji Kompetensi Keahlian (UKK) Desain Komunikasi Visual dilaksanakan pada 24–26 Februari 2025 dan diikuti oleh siswa kelas XII Kompetensi Keahlian DKV SMK Negeri 2 Mojokerto. Kegiatan ini bertujuan untuk mengukur pencapaian kompetensi siswa setelah menyelesaikan pembelajaran sesuai bidang keahlian yang ditempuh.","Dalam UKK ini, siswa mengerjakan proyek rebranding potensi yang ada di Kota Mojokerto, seperti kuliner, fasilitas olahraga, wisata budaya, wisata religi, dan ruang terbuka hijau. Hasil karya yang dibuat meliputi logo, fotografi, poster, desain feed Instagram, serta video vlog atau reels. Melalui kegiatan ini, siswa dapat mengembangkan kreativitas dan kemampuan desain sebagai bekal untuk melanjutkan pendidikan, bekerja, maupun berwirausaha."],"Sukses! Layanan Perbankan Syariah (LPS) SMK Negeri 2 Mojokerto Laksanakan Uji Kompetensi Keahlian (UKK)":["Kegiatan Uji Kompetensi Keahlian (UKK) Layanan Perbankan Syariah dilaksanakan pada 18–20 Februari 2025 dan diikuti oleh siswa kelas XII LPS SMK Negeri 2 Mojokerto. Kegiatan ini bertujuan untuk mengukur dan meningkatkan kompetensi siswa dalam bidang layanan keuangan syariah dengan bekerja sama bersama BPD Jatim Cabang Jayanegara Kota Mojokerto.","Materi yang diujikan meliputi praktik dan teori layanan keuangan syariah, pembuatan laporan akuntansi manual syariah, serta praktik komputer syariah. Melalui kegiatan ini, siswa diharapkan mampu menerapkan kompetensi yang telah dipelajari, meningkatkan keterampilan, serta mempersiapkan diri untuk menghadapi dunia kerja dan bidang kewirausahaan."],"Tes Kebugaran Sehat: Program Unggulan Gerakan Sekolah Sehat SMK Negeri 2 Mojokerto":["Kegiatan Tes Kebugaran sebagai bagian dari Program Gerakan Sekolah Sehat dilaksanakan pada 21 Agustus 2024 di SMK Negeri 2 Mojokerto. Kegiatan ini diawali dengan pengambilan sampel 30 siswa dari berbagai jurusan, terdiri dari 15 siswa laki-laki dan 15 siswa perempuan.","Tes ini bertujuan untuk memetakan tingkat kebugaran siswa dan mengetahui kondisi kebugaran fisik mereka. Beberapa tes yang dilakukan meliputi Hand Eye Coordination Test, Standing Broad Jump Test, Dipping Test, T-Test, dan Bleep Test. Kegiatan ini diharapkan dapat dilaksanakan secara rutin agar sekolah dapat memantau dan meningkatkan tingkat kebugaran siswa."],"SMK Negeri 2 Mojokerto: Sekolah Pioneer, Gerakan Sekolah Sehat 2024":["SMK Negeri 2 Mojokerto ditunjuk sebagai perwakilan Kota Mojokerto dalam Program Gerakan Sekolah Sehat yang dicanangkan oleh pemerintah melalui Dinas Pendidikan Provinsi Jawa Timur. Program ini bertujuan untuk membudayakan pola hidup sehat bagi seluruh warga sekolah, meliputi kesehatan fisik, kesehatan jiwa, kesehatan lingkungan, dan imunisasi.","Pelaksanaan program melibatkan seluruh warga sekolah serta bekerja sama dengan pihak luar seperti Puskesmas dan BKKBN. Berbagai kegiatan yang telah dilakukan antara lain sosialisasi gizi seimbang, membawa bekal sehat, penyediaan air minum, senam bersama, dan tes kebugaran siswa. Melalui program ini, diharapkan tercipta lingkungan sekolah yang sehat, nyaman, dan mendukung proses pembelajaran."],"Sukses! SMKN 2 Mojokerto Berhasil Laksanakan Tes Asesmen Nasional Berbasis Komputer 2024":["Kegiatan Asesmen Nasional Berbasis Komputer (ANBK) dilaksanakan pada 21–22 Agustus 2024 di Lab RPL SMK Negeri 2 Mojokerto. Kegiatan ini diikuti oleh 50 siswa perwakilan dari berbagai jurusan, terdiri dari 45 siswa utama dan 5 siswa cadangan.","ANBK merupakan program evaluasi pendidikan yang bertujuan untuk mengetahui dan meningkatkan mutu pembelajaran di sekolah. Asesmen ini mencakup Literasi dan Numerasi, Survei Karakter, serta Survei Lingkungan Belajar.","Untuk mempersiapkan siswa, sekolah memberikan bimbingan dan latihan secara intensif selama beberapa minggu dengan melibatkan wali kelas dan guru terkait. Melalui kegiatan ini, diharapkan siswa dapat mengikuti asesmen dengan baik dan memperoleh hasil yang mendukung peningkatan kualitas pendidikan serta Rapor Pendidikan SMK Negeri 2 Mojokerto."],"Khidmat! SMK Negeri 2 Mojokerto Peringati Hari Pramuka Ke-63 Tahun 2024":["Kegiatan Peringatan Hari Pramuka ke-63 dilaksanakan pada 14 Agustus 2024 dan diikuti oleh seluruh siswa kelas X, XI, dan XII SMK Negeri 2 Mojokerto. Kegiatan berupa upacara dengan tema “Pramuka Berjiwa Pancasila, Menjaga NKRI” yang dipimpin oleh Kepala SMK Negeri 2 Mojokerto, Bapak Drs. Akhmad Mukhlason.","Dalam amanatnya, disampaikan pentingnya menjaga persatuan, mencintai bangsa dan negara, melestarikan budaya Indonesia, serta menerapkan nilai-nilai Dasa Dharma Pramuka dalam kehidupan sehari-hari. Seluruh warga sekolah juga mengenakan seragam Pramuka lengkap sebagai bentuk kedisiplinan dan keteladanan sesuai dengan nilai “Disiplin dan Berprestasi” yang menjadi ikon SMK Negeri 2 Mojokerto."],"Istighosah Akbar, Program Unggulan Keagamaan di SMK Negeri 2 Mojokerto":["Kegiatan Istighosah Akbar dilaksanakan pada Jumat, 9 Agustus 2024 dan diikuti oleh seluruh siswa kelas X, XI, dan XII SMK Negeri 2 Mojokerto. Kegiatan ini merupakan salah satu program unggulan keagamaan sekolah yang bertujuan untuk meningkatkan keimanan serta membentuk sikap spiritual dan karakter siswa.","Acara diawali dengan pembacaan Ratibul Hadad, dilanjutkan Mahalul Qiyam, Istighosah, tausiyah, dan doa bersama. Kegiatan ini juga diisi dengan program Jumat Curhat bersama Polsek Prajuritkulon yang memberikan edukasi mengenai keselamatan dan kepatuhan terhadap peraturan lalu lintas. Melalui kegiatan ini, diharapkan siswa dapat meningkatkan ketakwaan, kedisiplinan, serta menerapkan nilai-nilai kebaikan dalam kehidupan sehari-hari."],"SMKN 2 Mojokerto Gelar Kerjasama dengan Program Bakti BCA yang Didukung oleh OJK":["Kegiatan Program Bakti BCA dilaksanakan pada 8 Agustus 2024 di Aula SMK Negeri 2 Mojokerto dan diikuti oleh siswa kelas XII Layanan Perbankan Syariah (LPS). Kegiatan ini merupakan kerja sama SMK Negeri 2 Mojokerto dengan Bank Central Asia (BCA) yang didukung oleh Otoritas Jasa Keuangan (OJK) dalam memberikan edukasi dan literasi keuangan kepada siswa.","Melalui kegiatan ini, siswa mendapatkan wawasan mengenai dunia perbankan, produk perbankan, perkembangan industri keuangan, serta pentingnya literasi keuangan. Selain itu, Program Bakti BCA juga memberikan informasi mengenai kesempatan beasiswa bagi siswa SMK berprestasi. Kegiatan ini diharapkan dapat menambah pengetahuan dan keterampilan siswa sebagai bekal untuk melanjutkan pendidikan maupun menghadapi dunia kerja."],"Sukses! SMKN 2 Mojokerto Berhasil Menggelar Tes TOEIC 2024":["Kegiatan Tes TOEIC 2024 dilaksanakan pada 7 Agustus 2024 di Lab DKV SMK Negeri 2 Mojokerto dan diikuti oleh 24 siswa perwakilan dari berbagai jurusan. Tes TOEIC merupakan agenda rutin sekolah yang bertujuan untuk mengukur kemampuan Bahasa Inggris siswa dalam konteks dunia kerja melalui sertifikasi berstandar internasional.","Pelaksanaan tes merupakan kerja sama antara Kemendikbud dan International Test Center (ITC). Melalui kegiatan ini, siswa diharapkan dapat meningkatkan kemampuan Bahasa Inggris serta mempersiapkan diri untuk melanjutkan pendidikan maupun memasuki dunia kerja. Siswa juga didorong untuk berlatih secara disiplin dan meningkatkan motivasi agar memperoleh hasil yang maksimal."],"Treasury Goes To School SMK Negeri 2 Mojokerto Dua Dekade Indonesian Treasury, Terus Berinovasi Melayani Negeri":["Kegiatan Treasury Goes To School dilaksanakan pada 25 Juli 2024 di Aula SMK Negeri 2 Mojokerto dan diikuti oleh siswa jurusan Layanan Perbankan Syariah (LPS). Kegiatan ini merupakan kerja sama antara Kantor Pelayanan Perbendaharaan Negara (KPPN) Mojokerto dengan SMK Negeri 2 Mojokerto dalam rangka memperingati Hari Bakti Perbendaharaan.","Kegiatan ini bertujuan untuk menambah wawasan siswa mengenai APBN, tugas dan pengelolaan KPPN, serta pentingnya menghindari gratifikasi. Antusiasme siswa terlihat dari sesi tanya jawab yang berlangsung aktif. Kegiatan ditutup dengan pemberian apresiasi dari KPPN Mojokerto sebagai bentuk penghargaan atas kerja sama yang telah terjalin dengan SMK Negeri 2 Mojokerto."],"LDKPD SMKN 2 Mojokerto: Membangun Jiwa Kepemimpinan dan Kesiapan Pengurus OSIS":["Kegiatan Latihan Dasar Kepemimpinan Peserta Didik (LDKPD) dilaksanakan pada 13–14 Oktober 2023 di Royal Hotel Trawas Mojokerto dan diikuti oleh sekitar 65 peserta. Kegiatan ini merupakan pelatihan dasar kepemimpinan bagi calon pengurus OSIS periode 2023–2024 sebagai bekal dalam menjalankan organisasi dan menjadi pemimpin yang bertanggung jawab.","Dalam kegiatan ini, peserta mendapatkan berbagai materi dan pengalaman mengenai dasar-dasar kepemimpinan, teknik komunikasi, kewirausahaan, penyusunan program kerja, kerja sama tim, serta kegiatan pengembangan diri melalui games dan pentas ekstrakurikuler. Melalui LDKPD, peserta diharapkan mampu meningkatkan kemampuan kepemimpinan, membangun kerja sama, serta memiliki mental dan karakter yang baik dalam menjalankan tugas sebagai pengurus OSIS."],"MAGANG/PRAKERIN SEMAKIN ASYIK BERSAMA JURUSAN PERBANKAN SYARIAH SKANEDA":["Kegiatan Magang/Prakerin merupakan program pembelajaran yang memberikan kesempatan kepada siswa untuk memperoleh pengalaman kerja secara langsung di Dunia Usaha/Dunia Industri (DU/DI). Kegiatan ini dilaksanakan oleh siswa kelas XI selama enam bulan sebagai bentuk penerapan kompetensi yang telah dipelajari di sekolah.","Pada Januari 2023, siswa kelas XI Perbankan Syariah diberangkatkan ke berbagai instansi dan perusahaan mitra, seperti Bank Muamalat, Bank Syariah Indonesia, Bank Jatim, BPRS, KPPN, BAZNAS, dan beberapa instansi lainnya. Sebelum melaksanakan Prakerin, siswa dibekali keterampilan sesuai bidang keahlian, kemampuan beradaptasi, serta karakter dan etos kerja.","Melalui kegiatan Prakerin, siswa diharapkan dapat meningkatkan keterampilan, kedisiplinan, tanggung jawab, kepercayaan diri, serta memahami secara langsung dunia kerja sesuai dengan kompetensi yang dimiliki."],"Pentingnya Kegiatan Kunjungan Industri bagi Siswa SMK":["Kegiatan Kunjungan Industri (KI) dilaksanakan oleh siswa kelas X RPL SMK Negeri 2 Mojokerto pada 13 Desember 2022 di Maspion IT. Kegiatan ini diikuti oleh 100 siswa dari kelas X RPL 1, X RPL 2, dan X RPL 3 sebagai bentuk pembelajaran di luar sekolah untuk mengenal dunia industri secara langsung.","Dalam kunjungan ini, siswa mendapatkan materi mengenai dunia software dan perkembangan teknologi informasi dari pihak Maspion IT. Selain itu, siswa juga diperkenalkan dengan Maspion Group dan diajak melihat berbagai produk elektronik yang tersedia di Maspion Square.","Melalui kegiatan ini, siswa diharapkan dapat menambah wawasan tentang dunia industri, memahami perkembangan teknologi, serta meningkatkan kompetensi, kedisiplinan, sikap, dan kesiapan menghadapi dunia kerja."],"BKK SMKN 2 Mojokerto Berinovasi Adakan Kegiatan Temu Alumni untuk Siswa Baru":["Kegiatan Temu Alumni diselenggarakan oleh BKK SMK Negeri 2 Mojokerto sebagai upaya memberikan motivasi dan gambaran mengenai dunia kerja serta perguruan tinggi kepada siswa baru tahun pelajaran 2022–2023. Kegiatan ini menghadirkan alumni yang bekerja atau melanjutkan pendidikan sesuai dengan jurusan masing-masing.","Dalam kegiatan ini, alumni berbagi pengalaman, tips, saran, dan informasi mengenai peluang setelah lulus SMK. Siswa juga diberikan kesempatan untuk berdiskusi dan bertanya secara langsung mengenai dunia kerja, perkuliahan, maupun persiapan PKL. Melalui kegiatan ini, diharapkan siswa semakin termotivasi untuk mengembangkan keterampilan sesuai jurusannya serta memiliki gambaran dan persiapan untuk masa depan."],"BKK SMKN 2 Mojokerto Bekerjasama dengan PT.SAI Selenggarakan Rekrutmen Lulusan SMK":["BKK SMKN 2 Mojokerto bekerja sama dengan PT. Surabaya Autocomp Indonesia (PT. SAI) dalam kegiatan rekrutmen lulusan SMK yang dilaksanakan di Aula SMKN 2 Mojokerto. Kegiatan ini bertujuan membantu alumni memperoleh kesempatan kerja, khususnya sebagai operator produksi di bidang komponen otomotif Wiring Harness.","Rekrutmen diikuti oleh alumni SMKN 2 Mojokerto dan masyarakat umum. Proses seleksi meliputi administrasi, tes fisik, tes tulis, wawancara, hingga tes kesehatan. Kegiatan ini juga menjadi bentuk upaya BKK dalam memperluas kerja sama dengan dunia industri serta meningkatkan penyerapan lulusan SMK di dunia kerja.","Melalui kegiatan ini, BKK SMKN 2 Mojokerto berharap semakin banyak alumni yang mendapatkan kesempatan bekerja sesuai dengan kemampuan dan kualifikasinya."]};

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

  setTimeout(function () {
    revealEls.forEach(function (el) {
      var r = el.getBoundingClientRect();
      if (r.top < window.innerHeight) el.classList.add('revealed');
    });
  }, 300);

  /* =========================================================
     MODAL BACA KISAHNYA
     - Featured Berita Terkini
     - 4 berita samping Berita Terkini
     - Semua kartu Berita Terbaru
     ========================================================= */
  var newsModal = document.getElementById('newsModal');
  var newsModalClose = document.getElementById('newsModalClose');
  var newsModalTitle = document.getElementById('newsModalTitle');
  var newsModalCategory = document.getElementById('newsModalCategory');
  var newsModalContent = document.getElementById('newsModalContent');

  function escapeHtml(value) {
    return String(value)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  function getCategoryMarkup(card) {
    var cat = card ? card.querySelector('.br-cat') : null;
    return cat ? cat.outerHTML : '<span class="br-cat br-cat-sekolah"><i class="fas fa-newspaper"></i> Berita</span>';
  }

  function openNewsStory(id) {
    var item = newsData[id];
    if (!item || !newsModal) return;

    newsModalTitle.textContent = id;
    newsModalCategory.innerHTML = getCategoryMarkup(document.querySelector('[data-news-id="' + CSS.escape(id) + '"]'));
    newsModalContent.innerHTML = item.map(function (paragraph) {
      return '<p>' + escapeHtml(paragraph) + '</p>';
    }).join('');

    newsModal.classList.add('show');
    document.body.classList.add('br-modal-open');
  }

  function closeNewsStory() {
    if (!newsModal) return;
    newsModal.classList.remove('show');
    document.body.classList.remove('br-modal-open');
  }

  /*
   * Urutan DOM sengaja sama dengan urutan data:
   * 1 featured + 4 side + seluruh list berita.
   */
  var newsCards = Array.prototype.slice.call(
    document.querySelectorAll('.br-featured, .br-side-item, #brList .br-item')
  );

  newsCards.forEach(function (card, index) {
    var titleEl = card.querySelector('.br-featured h3 a, .br-side-body h4 a, .br-item-body h3 a');
    if (!titleEl) return;

    var title = titleEl.textContent.trim();

    /*
     * Pastikan kartu memakai judul yang sama persis dengan data.
     * Jika tidak ditemukan, tombol tetap tidak dibuat agar tidak
     * menampilkan data yang salah.
     */
    if (!Object.prototype.hasOwnProperty.call(newsData, title)) return;

    card.setAttribute('data-news-id', title);

    var existingReadMore = card.querySelector('.br-readmore');
    if (existingReadMore) {
      existingReadMore.textContent = '';
      existingReadMore.appendChild(document.createTextNode('Baca Kisahnya '));
      var icon = document.createElement('i');
      icon.className = 'fas fa-arrow-right';
      existingReadMore.appendChild(icon);
      existingReadMore.setAttribute('href', '#');
      existingReadMore.setAttribute('data-news-story', title);
    } else {
      var button = document.createElement('button');
      button.type = 'button';
      button.className = 'br-readmore ' +
        (card.classList.contains('br-side-item') ? 'br-side-readmore' : 'br-item-readmore');
      button.setAttribute('data-news-story', title);
      button.innerHTML = 'Baca Kisahnya <i class="fas fa-arrow-right"></i>';

      var body = card.querySelector('.br-side-body, .br-item-body');
      if (body) body.appendChild(button);
    }
  });

  function bindNewsStoryButtons() {
    document.querySelectorAll('[data-news-story]').forEach(function (button) {
      if (button.dataset.newsBound === '1') return;

      button.dataset.newsBound = '1';
      button.addEventListener('click', function (event) {
        event.preventDefault();
        openNewsStory(button.getAttribute('data-news-story'));
      });
    });
  }

  bindNewsStoryButtons();

  if (newsModalClose) newsModalClose.addEventListener('click', closeNewsStory);

  if (newsModal) {
    newsModal.addEventListener('click', function (event) {
      if (event.target === newsModal) closeNewsStory();
    });
  }

  /* =========================================================
     10 BERITA AWAL + LIHAT SEMUA
     FIX:
     - klik "Lihat Semua" benar-benar menampilkan semua berita
       tambahan ke bawah
     - filter/search tetap bekerja
     - berita tambahan tidak tertahan oleh CSS display:none
     ========================================================= */
  var list = document.getElementById('brList');
  var moreBtn = document.getElementById('brMoreBtn');
  var expanded = false;
  var articles = list ? Array.prototype.slice.call(list.querySelectorAll('.br-item')) : [];
  var emptyBox = document.getElementById('brEmpty');

  function setArticleVisible(article, visible) {
    article.style.display = visible ? 'flex' : 'none';

    if (visible) {
      article.classList.add('br-show');
      article.classList.add('revealed');
    } else {
      article.classList.remove('br-show');
    }
  }

  function applyFilter() {
    var searchInput = document.getElementById('brSearch');
    var q = (searchInput && searchInput.value ? searchInput.value : '').toLowerCase().trim();

    var activeButton = document.querySelector('.br-filter-btn.active');
    var activeFilter = activeButton
      ? (activeButton.getAttribute('data-filter') || 'semua')
      : 'semua';

    var normalMode = q === '' && activeFilter === 'semua';
    var visible = 0;

    articles.forEach(function (article, index) {
      var cat = (article.getAttribute('data-cat') || 'semua').toLowerCase();
      var text = (article.getAttribute('data-search') || article.textContent || '').toLowerCase();

      var categoryMatch = activeFilter === 'semua' || cat === activeFilter;
      var searchMatch = q === '' || text.indexOf(q) !== -1;
      var match = categoryMatch && searchMatch;

      if (!match) {
        setArticleVisible(article, false);
        return;
      }

      /*
       * Mode normal:
       *   - 10 berita pertama tampil
       *   - berita ke-11 dan seterusnya tampil setelah Lihat Semua
       *
       * Mode filter/search:
       *   - semua hasil yang cocok langsung tampil
       */
      if (!normalMode || expanded || index < 10) {
        setArticleVisible(article, true);
      } else {
        setArticleVisible(article, false);
      }

      visible++;
    });

    if (emptyBox) emptyBox.classList.toggle('show', visible === 0);

    if (moreBtn) {
      moreBtn.style.display = normalMode && articles.length > 10 ? 'inline-flex' : 'none';

      var label = moreBtn.querySelector('span');
      var icon = moreBtn.querySelector('i');

      if (label) label.textContent = expanded ? 'Tampilkan Lebih Sedikit' : 'Lihat Semua';
      if (icon) icon.className = expanded ? 'fas fa-chevron-up' : 'fas fa-chevron-down';
    }

    bindNewsStoryButtons();
  }

  if (moreBtn) {
    moreBtn.addEventListener('click', function () {
      expanded = !expanded;
      applyFilter();

      if (expanded) {
        var firstExtra = articles[10];
        if (firstExtra) {
          setTimeout(function () {
            firstExtra.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
          }, 60);
        }
      }
    });
  }

  /* ---------- FILTER ---------- */
  document.querySelectorAll('.br-filter-btn').forEach(function (button) {
    button.addEventListener('click', function () {
      document.querySelectorAll('.br-filter-btn').forEach(function (b) {
        b.classList.remove('active');
      });

      button.classList.add('active');
      expanded = false;
      applyFilter();
    });
  });

  /* ---------- SEARCH ---------- */
  var searchInput = document.getElementById('brSearch');
  if (searchInput) {
    var debounce;
    searchInput.addEventListener('input', function () {
      clearTimeout(debounce);
      debounce = setTimeout(function () {
        expanded = false;
        applyFilter();
      }, 180);
    });
  }

  /* =========================================================
     MODAL CERITA SKANEDA LAMA
     Tetap dipertahankan agar bagian Cerita Skaneda tidak rusak.
     ========================================================= */
  var storyButtons = document.querySelectorAll('[data-story]');
  var storyModals = document.querySelectorAll('.br-story-modal');

  function closeAllStories() {
    storyModals.forEach(function (modal) {
      modal.classList.remove('show');
    });
    document.body.classList.remove('br-modal-open');
  }

  storyButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      var id = button.getAttribute('data-story');
      var modal = document.getElementById('storyModal' + id);
      if (!modal) return;

      modal.classList.add('show');
      document.body.classList.add('br-modal-open');
    });
  });

  document.querySelectorAll('[data-close-story]').forEach(function (button) {
    button.addEventListener('click', closeAllStories);
  });

  storyModals.forEach(function (modal) {
    modal.addEventListener('click', function (event) {
      if (event.target === modal) closeAllStories();
    });
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      closeNewsStory();
      closeAllStories();
    }
  });

  /* ---------- JALANKAN FILTER PERTAMA KALI ---------- */
  applyFilter();
})();
</script>
@endpush