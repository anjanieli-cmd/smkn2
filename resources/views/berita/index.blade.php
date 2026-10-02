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
@include('profile.partials.berita-content')
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
  setTimeout(function () {
    revealEls.forEach(function (el) {
      var r = el.getBoundingClientRect();
      if (r.top < window.innerHeight) el.classList.add('revealed');
    });
  }, 300);

  /* =========================================================
     MODAL BACA KISAHNYA — dari window.BERITA_DATA (lihat
     resources/views/profile/partials/berita-content.blade.php)
     ========================================================= */
  var newsModal = document.getElementById('newsModal');
  var newsModalClose = document.getElementById('newsModalClose');
  var newsModalTitle = document.getElementById('newsModalTitle');
  var newsModalCategory = document.getElementById('newsModalCategory');
  var newsModalContent = document.getElementById('newsModalContent');
  var newsData = window.BERITA_DATA || {};

  function escapeHtml(value) {
    return String(value)
      .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;').replace(/'/g, '&#039;');
  }

  function openNewsStory(id) {
    var item = newsData[id];
    if (!item || !newsModal) return;

    newsModalTitle.textContent = item.title;
    newsModalCategory.innerHTML = item.category
      ? '<span class="br-cat ' + item.category.class + '"><i class="fas ' + item.category.icon + '"></i> ' + escapeHtml(item.category.label) + '</span>'
      : '<span class="br-cat br-cat-sekolah"><i class="fas fa-newspaper"></i> Berita</span>';
    newsModalContent.innerHTML = (item.content || []).map(function (p) {
      return '<p>' + escapeHtml(p) + '</p>';
    }).join('');

    newsModal.classList.add('show');
    document.body.classList.add('br-modal-open');
  }

  function closeNewsStory() {
    if (!newsModal) return;
    newsModal.classList.remove('show');
    document.body.classList.remove('br-modal-open');
  }

  function bindNewsTriggers() {
    document.querySelectorAll('[data-news-trigger]').forEach(function (el) {
      if (el.dataset.newsBound === '1') return;
      el.dataset.newsBound = '1';
      el.addEventListener('click', function (event) {
        event.preventDefault();
        openNewsStory(el.getAttribute('data-news-trigger'));
      });
    });
  }
  bindNewsTriggers();

  if (newsModalClose) newsModalClose.addEventListener('click', closeNewsStory);
  if (newsModal) {
    newsModal.addEventListener('click', function (event) {
      if (event.target === newsModal) closeNewsStory();
    });
  }

  /* =========================================================
     10 BERITA AWAL + LIHAT SEMUA + FILTER + SEARCH
     (logika sama seperti sebelumnya; hanya sumber datanya yang
     sekarang dirender oleh partial dari database)
     ========================================================= */
  var list = document.getElementById('brList');
  var moreBtn = document.getElementById('brMoreBtn');
  var expanded = false;
  var articles = list ? Array.prototype.slice.call(list.querySelectorAll('.br-item')) : [];
  var emptyBox = document.getElementById('brEmpty');

  function setArticleVisible(article, visible) {
    article.style.display = visible ? 'flex' : 'none';
    if (visible) { article.classList.add('br-show'); article.classList.add('revealed'); }
    else { article.classList.remove('br-show'); }
  }

  function applyFilter() {
    var searchInput = document.getElementById('brSearch');
    var q = (searchInput && searchInput.value ? searchInput.value : '').toLowerCase().trim();

    var activeButton = document.querySelector('.br-filter-btn.active');
    var activeFilter = activeButton ? (activeButton.getAttribute('data-filter') || 'semua') : 'semua';

    var normalMode = q === '' && activeFilter === 'semua';
    var visible = 0;

    articles.forEach(function (article, index) {
      var cat = (article.getAttribute('data-cat') || 'semua').toLowerCase();
      var text = (article.getAttribute('data-search') || article.textContent || '').toLowerCase();

      var categoryMatch = activeFilter === 'semua' || cat === activeFilter;
      var searchMatch = q === '' || text.indexOf(q) !== -1;
      var match = categoryMatch && searchMatch;

      if (!match) { setArticleVisible(article, false); return; }

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

    bindNewsTriggers();
  }

  if (moreBtn) {
    moreBtn.addEventListener('click', function () {
      expanded = !expanded;
      applyFilter();
      if (expanded) {
        var firstExtra = articles[10];
        if (firstExtra) {
          setTimeout(function () { firstExtra.scrollIntoView({ behavior: 'smooth', block: 'nearest' }); }, 60);
        }
      }
    });
  }

  document.querySelectorAll('.br-filter-btn').forEach(function (button) {
    button.addEventListener('click', function () {
      document.querySelectorAll('.br-filter-btn').forEach(function (b) { b.classList.remove('active'); });
      button.classList.add('active');
      expanded = false;
      applyFilter();
    });
  });

  var searchInput = document.getElementById('brSearch');
  if (searchInput) {
    var debounce;
    searchInput.addEventListener('input', function () {
      clearTimeout(debounce);
      debounce = setTimeout(function () { expanded = false; applyFilter(); }, 180);
    });
  }

  /* =========================================================
     MODAL CERITA SKANEDA — tidak berubah, masih per-ID dinamis
     ========================================================= */
  var storyButtons = document.querySelectorAll('[data-story]');
  var storyModals = document.querySelectorAll('.br-story-modal');

  function closeAllStories() {
    storyModals.forEach(function (modal) { modal.classList.remove('show'); });
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
    if (event.key === 'Escape') { closeNewsStory(); closeAllStories(); }
  });

  applyFilter();
})();
</script>
@endpush
