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

/* ---------- HERO: foto gedung + overlay + watermark (IDENTIK referensi — TIDAK DIUBAH) ---------- */
.br-hero{position:relative;min-height:88vh;display:flex;align-items:flex-start;overflow:hidden;
  background-image:url('{{ asset('images/hero-sekolah.jpg') }}');
  background-size:cover;background-position:center;background-repeat:no-repeat;color:#fff}
.br-hero::before{content:"";position:absolute;inset:0;z-index:1;
  background:linear-gradient(100deg,rgba(7,22,42,.90) 0%,rgba(9,30,54,.68) 45%,rgba(9,30,54,.32) 78%,rgba(9,30,54,.12) 100%)}
/* Watermark typography besar transparan */
.br-hero::after{content:"BERITA";position:absolute;z-index:2;right:-2%;top:50%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(3.1rem,9.4vw,9.4rem);font-weight:900;line-height:.82;
  letter-spacing:.02em;color:rgba(255,255,255,.055);-webkit-text-stroke:1px rgba(255,255,255,.07);
  text-shadow:0 0 90px rgba(13,58,102,.16);pointer-events:none;white-space:nowrap;user-select:none}
.br-hero-inner{position:relative;z-index:3;width:100%;max-width:none;margin:0 auto;
  padding:clamp(3.5rem,9vh,5.5rem) clamp(1.5rem,5vw,5.5rem);
  display:grid;grid-template-columns:minmax(0,1.05fr) minmax(340px,.95fr);gap:4rem;align-items:center}

.br-kicker{display:inline-flex;align-items:center;gap:.65rem;font-size:.74rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#ffd54a;margin-bottom:0.6rem}
.br-kicker::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ffb300)}

/* ---------- TITLE: BERITA putih, SKANEDA kuning-oranye ---------- */
.br-title{font-family:var(--font-display);font-size:clamp(2.6rem,5.9vw,5.6rem);line-height:.98;
  letter-spacing:.01em;margin:0;max-width:820px;text-transform:uppercase;
  text-shadow:0 2px 24px rgba(4,14,28,.35);animation:hdFadeUp .7s .1s var(--ease, ease) both}
.br-title .br-white{color:#ffffff;display:inline-block}
.br-title .br-gold{display:inline-block;
  background:linear-gradient(135deg,#ffe66d 0%,#ffc107 45%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ffc107;
  text-shadow:0 4px 24px rgba(255,174,0,.18);letter-spacing:.025em}
.br-lead{font-size:1.02rem;line-height:1.85;color:rgba(235,245,253,.86);max-width:640px;
  margin:1.3rem 0 0;animation:hdFadeUp .7s .26s var(--ease, ease) both}
.br-hero-meta{display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;animation:hdFadeUp .7s .4s var(--ease, ease) both}
.br-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;
  border:1px solid rgba(255,255,255,.2);background:rgba(13,58,102,.30);border-radius:999px;
  font-size:.72rem;font-weight:800;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)}
.br-pill i{color:#ffd54a}

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
  border-top:2px solid rgba(13,58,102,.22);border-left:2px solid rgba(13,58,102,.22)}
.home-orn .ho-corner::after{content:"";position:absolute;left:18px;bottom:18px;width:46px;height:3px;
  background:rgba(255,179,0,.4)}
.br-hero .home-orn .ho-chevron{left:-150px;bottom:-60px;border-color:rgba(255,255,255,.10)}
.br-hero .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.br-hero .home-orn .ho-line{right:-80px;top:22%;opacity:.22}
.br-hero .home-orn .ho-dots{right:6%;bottom:14%;opacity:.3}
.br-hero .home-orn .ho-ring{left:44%;bottom:-90px;border-color:rgba(255,255,255,.12)}
.br-hero .home-orn .ho-gold{right:16%;top:20%}
.br-hero .home-orn .ho-square{left:12%;top:22%}

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

/* ---------- CERITA SKANEDA ---------- */
.br-story{position:relative;overflow:hidden;color:#fff;margin-top:clamp(2rem,4vw,3rem)}
.br-story-bg{position:absolute;inset:0;background-image:url('{{ asset('images/berita-kampus.jpg') }}');
  background-size:cover;background-position:center;background-attachment:scroll}
.br-story-bg::after{content:"";position:absolute;inset:0;
  background:linear-gradient(100deg,rgba(5,25,48,.96) 0%,rgba(7,30,56,.86) 48%,rgba(9,38,70,.72) 100%)}
.br-story-inner{position:relative;z-index:2;max-width:1240px;margin:0 auto;
  padding:clamp(4.5rem,9vw,7rem) clamp(1.5rem,5vw,5.5rem)}
.br-story .br-eyebrow::before{background:linear-gradient(90deg,#ffd54a,#ff8a00)}
.br-story .br-sec-title{color:#fff}
.br-story-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.4rem;margin-top:clamp(2rem,4vw,2.8rem)}
.br-story-card{background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.16);border-radius:18px;
  padding:1.6rem;backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);
  transition:transform .4s var(--ease,ease),background .4s var(--ease,ease),border-color .4s var(--ease,ease)}
.br-story-card:hover{transform:translateY(-6px);background:rgba(255,255,255,.12);border-color:rgba(255,213,74,.55)}
.br-story-card .br-cat{margin-bottom:.9rem}
.br-story-card h4{font-family:var(--font-display);font-size:1.14rem;font-weight:800;line-height:1.3;margin:0 0 .6rem}
.br-story-card p{font-size:.84rem;line-height:1.7;color:rgba(235,245,253,.82);margin:0 0 1.1rem}
.br-story-link{display:inline-flex;align-items:center;gap:.45rem;font-size:.78rem;font-weight:800;color:#ffd54a;
  text-decoration:none;border-bottom:2px solid rgba(255,213,74,.4);padding-bottom:.2rem;transition:gap .3s var(--ease,ease)}
.br-story-link:hover{gap:.8rem;border-color:#ffd54a}

/* ---------- CTA ---------- */
.br-cta{background:#0d3a66;color:#fff;text-align:center;position:relative;overflow:hidden;
  padding:clamp(4.5rem,8vw,6.5rem) clamp(1.5rem,5vw,5.5rem)}
.br-cta>*:not(.home-orn){position:relative;z-index:1}
.br-cta .home-orn .ho-chevron{left:-150px;bottom:-60px;border-color:rgba(255,255,255,.10)}
.br-cta .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.br-cta .home-orn .ho-line{right:-80px;top:22%;opacity:.22}
.br-cta .home-orn .ho-dots{right:6%;bottom:14%;opacity:.3}
.br-cta .home-orn .ho-ring{left:44%;bottom:-90px;border-color:rgba(255,255,255,.12)}
.br-cta .home-orn .ho-gold{right:16%;top:20%}
.br-cta .home-orn .ho-square{left:12%;top:22%}
.br-cta-title{font-family:var(--font-display);font-weight:900;font-size:clamp(2.4rem,5vw,4.4rem);line-height:.98;
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
  .br-hero-inner{grid-template-columns:1fr;gap:2.5rem}
  .hero-photo{height:340px;max-width:560px}
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
</style>
@endpush

@section('content')

<!-- ================= HERO (IDENTIK referensi — TIDAK DIUBAH) ================= -->
<section class="br-hero">
  <div class="home-orn" aria-hidden="true">
    <span class="ho-chevron"></span>
    <span class="ho-line"></span>
    <span class="ho-dots"></span>
    <span class="ho-ring"></span>
    <span class="ho-gold"></span>
    <span class="ho-square"></span>
    <span class="ho-corner"></span>
  </div>

  <div class="br-hero-inner">
    <div>
      <div class="br-kicker">Kanal Berita &amp; Informasi Resmi Sekolah</div>
      <h1 class="br-title">
        <span class="br-white">Berita</span> <span class="br-gold">Skaneda</span>
      </h1>
      <p class="br-lead">Kabar terbaru dari SMK Negeri 2 Mojokerto — prestasi, kegiatan, akademik, hingga ekstrakurikuler. Disajikan jujur, cepat, dan dekat dengan para peserta didik.</p>
      <div class="br-hero-meta">
        <span class="br-pill"><i class="fas fa-newspaper"></i> Edisi Agustus 2026</span>
        <span class="br-pill"><i class="fas fa-pen-nib"></i> Redaksi Digital Skaneda</span>
        <span class="br-pill"><i class="fas fa-bolt"></i> Terbit Berkala</span>
      </div>
    </div>

    <div class="hero-photo" data-reveal="right">
      <img src="{{ asset('images/berita-kampus.jpg') }}" alt="Lingkungan kampus SMK Negeri 2 Mojokerto" loading="eager">
      <div class="hero-photo-caption"><strong>Ruang Redaksi Skaneda</strong><span>Mengabarkan setiap langkah prestasi.</span></div>
    </div>
  </div>
</section>

<!-- ================= STRIP EDISI ================= -->
<div class="br-strip">
  <div class="br-strip-inner">
    <span class="br-strip-label"><i class="fas fa-bolt"></i> Terkini</span>
    <span class="br-strip-text"><b>#SkanedaBerprestasi</b> — Siswa RPL Skaneda sabet Juara 1 LKS Web Technologies Tingkat Kota Mojokerto. Baca selengkapnya di bawah.</span>
  </div>
</div>

<!-- ================= 1. BERITA TERKINI ================= -->
<section class="br-sec" style="padding-bottom:clamp(2.5rem,5vw,4rem)">
  <div class="home-orn" aria-hidden="true">
    <span class="ho-chevron"></span>
    <span class="ho-dots"></span>
    <span class="ho-ring"></span>
    <span class="ho-gold"></span>
  </div>
  <div class="br-container">
    <div class="br-sec-head" data-reveal>
      <div>
        <span class="br-eyebrow">Headline Edition</span>
        <h2 class="br-sec-title">Berita <em>Terkini</em></h2>
        <div class="br-rule"></div>
        <p class="br-sec-sub">Sorotan utama minggu ini — berita paling penting dari lingkungan SMKN 2 Mojokerto.</p>
      </div>
      <div class="br-num" aria-hidden="true">01</div>
    </div>

    <div class="br-latest">
      <!-- FEATURED NEWS -->
      <article class="br-featured" data-reveal data-cat="prestasi" data-search="Siswa RPL Skaneda sabet Juara 1 LKS Web Technologies tingkat Kota Mojokerto Rekayasa Perangkat Lunak">
        <div class="br-featured-img">
          <img src="{{ asset('images/berita-juara-lks.jpg') }}" alt="Siswa SMK Negeri 2 Mojokerto menerima penghargaan Juara 1 LKS Web Technologies" loading="eager">
          <div class="br-featured-tag"><span class="br-cat br-cat-prestasi"><i class="fas fa-trophy"></i> Prestasi</span></div>
        </div>
        <div class="br-featured-body">
          <span class="br-featured-date"><i class="fas fa-calendar-alt"></i> 12 Agustus 2026</span>
          <h3><a href="#">Siswa RPL Skaneda Sabet Juara 1 LKS Web Technologies Tingkat Kota Mojokerto</a></h3>
          <p class="br-featured-excerpt">Dengan proyek aplikasi PPDB online yang dikerjakan selama tiga bulan, tim Rekayasa Perangkat Lunak SMKN 2 Mojokerto berhasil mengalahkan 14 tim dari sekolah lain dan membawa pulang medali emas.</p>
          <div class="br-featured-meta">
            <span><i class="fas fa-user-graduate"></i> RPL · Kelas XII</span>
            <span><i class="fas fa-map-marker-alt"></i> Kota Mojokerto</span>
            <span><i class="fas fa-eye"></i> 1.284 dibaca</span>
          </div>
          <a href="#" class="br-readmore">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
        </div>
      </article>

      <!-- SIDE STACK -->
      <div class="br-side">
        <article class="br-side-item" data-reveal data-cat="sekolah" data-search="Penerimaan Peserta Didik Baru PPDB 2026 2027 resmi dibuka kuota 540 kursi jalur zonasi afirmasi">
          <div class="br-side-thumb">
            <img src="{{ asset('images/berita-ppdb.jpg') }}" alt="Penerimaan Peserta Didik Baru SMK Negeri 2 Mojokerto" loading="eager">
          </div>
          <div class="br-side-body">
            <span class="br-cat br-cat-sekolah"><i class="fas fa-school"></i> Sekolah</span>
            <h4><a href="#">PPDB 2026/2027 Resmi Dibuka, Kuota 540 Kursi</a></h4>
            <span class="br-side-date"><i class="fas fa-calendar-alt"></i> 08 Agustus 2026</span>
          </div>
        </article>

        <article class="br-side-item" data-reveal data-cat="kegiatan" data-search="Gelar Karya P5 produk kuliner dan aplikasi digital karya siswa dipamerkan Projek Penguatan Profil">
          <div class="br-side-thumb">
            <img src="{{ asset('images/berita-kuliner.jpg') }}" alt="Gelar Karya P5 siswa SMK Negeri 2 Mojokerto" loading="eager">
          </div>
          <div class="br-side-body">
            <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
            <h4><a href="#">Gelar Karya P5: Kuliner &amp; Aplikasi Digital Dipamerkan</a></h4>
            <span class="br-side-date"><i class="fas fa-calendar-alt"></i> 02 Agustus 2026</span>
          </div>
        </article>

        <article class="br-side-item" data-reveal data-cat="prestasi" data-search="Tim Futsal Skaneda raih Juara 2 turnamen antar SMK se Jawa Timur olahraga">
          <div class="br-side-thumb">
            <img src="{{ asset('images/berita-futsal.jpg') }}" alt="Tim futsal SMK Negeri 2 Mojokerto" loading="eager">
          </div>
          <div class="br-side-body">
            <span class="br-cat br-cat-prestasi"><i class="fas fa-trophy"></i> Prestasi</span>
            <h4><a href="#">Tim Futsal Skaneda Raih Juara 2 Antar-SMK Se-Jatim</a></h4>
            <span class="br-side-date"><i class="fas fa-calendar-alt"></i> 28 Juli 2026</span>
          </div>
        </article>

        <article class="br-side-item" data-reveal data-cat="ekstrakurikuler" data-search="Paskibra Skaneda latihan intensif menyambut HUT ke 81 Republik Indonesia baris berbaris">
          <div class="br-side-thumb">
            <img src="{{ asset('images/berita-paskibra.jpg') }}" alt="Latihan Paskibra SMK Negeri 2 Mojokerto" loading="eager">
          </div>
          <div class="br-side-body">
            <span class="br-cat br-cat-ekstrakurikuler"><i class="fas fa-flag"></i> Ekstrakurikuler</span>
            <h4><a href="#">Paskibra Skaneda Latihan Intensif Sambut HUT RI</a></h4>
            <span class="br-side-date"><i class="fas fa-calendar-alt"></i> 20 Juli 2026</span>
          </div>
        </article>
      </div>
    </div>
  </div>
</section>

<!-- ================= 2. ARSIP: TOOLBAR + BERITA TERBARU + MOST READ ================= -->
<section class="br-sec" style="padding-top:clamp(2.5rem,5vw,4rem)">
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
        <p class="br-sec-sub">Kumpulan liputan lengkap — saring berdasarkan kategori atau cari topik favoritmu.</p>
      </div>
      <div class="br-num" aria-hidden="true">02</div>
    </div>

    <!-- FILTER + SEARCH -->
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
      <!-- LIST BERITA TERBARU -->
      <div class="br-list" id="brList">
        <article class="br-item" data-reveal data-cat="akademik" data-search="Lab RPL Skaneda dilengkapi 30 unit PC baru untuk pengembangan aplikasi pembelajaran">
          <div class="br-item-img"><img src="{{ asset('images/berita-rpl.jpg') }}" alt="Lab RPL SMK Negeri 2 Mojokerto" loading="eager"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-akademik"><i class="fas fa-book-open"></i> Akademik</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 25 Juli 2026</span>
            </div>
            <h3><a href="#">Lab RPL Skaneda Dilengkapi 30 Unit PC Baru untuk Pengembangan Aplikasi</a></h3>
            <p class="br-item-excerpt">Pembaruan perangkat ini mendukung praktik pemrograman siswa agar semakin dekat dengan standar industri.</p>
          </div>
        </article>

        <article class="br-item" data-reveal data-cat="siswa" data-search="ratusan siswa kelas XII mengikuti uji kompetensi keahlian serentak sertifikasi">
          <div class="br-item-img"><img src="{{ asset('images/berita-cloud.jpg') }}" alt="Uji kompetensi keahlian siswa SMK Negeri 2 Mojokerto" loading="eager"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-siswa"><i class="fas fa-user-graduate"></i> Siswa</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 18 Juli 2026</span>
            </div>
            <h3><a href="#">Ratusan Siswa Kelas XII Ikuti Uji Kompetensi Keahlian Serentak</a></h3>
            <p class="br-item-excerpt">Asesmen langsung oleh asesor industri memastikan lulusan Skaneda benar-benar siap kerja.</p>
          </div>
        </article>

        <article class="br-item" data-reveal data-cat="prestasi" data-search="tim DKV Skaneda juara 2 lomba desain poster tingkat provinsi Jawa Timur">
          <div class="br-item-img"><img src="{{ asset('images/berita-dkv.jpg') }}" alt="Karya desain siswa DKV SMK Negeri 2 Mojokerto" loading="eager"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-prestasi"><i class="fas fa-trophy"></i> Prestasi</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 10 Juli 2026</span>
            </div>
            <h3><a href="#">Tim DKV Skaneda Juara 2 Lomba Desain Poster Tingkat Provinsi</a></h3>
            <p class="br-item-excerpt">Poster kampanye literasi digital karya siswa kelas XI DKV mencuri perhatian juri dari 38 sekolah.</p>
          </div>
        </article>

        <article class="br-item" data-reveal data-cat="kegiatan" data-search="kunjungan industri siswa APHP ke pabrik pengolahan pangan di Sidoarjo">
          <div class="br-item-img"><img src="{{ asset('images/berita-aphp.jpg') }}" alt="Kunjungan industri siswa APHP SMK Negeri 2 Mojokerto" loading="eager"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 05 Juli 2026</span>
            </div>
            <h3><a href="#">Kunjungan Industri Siswa APHP ke Pabrik Pengolahan Pangan</a></h3>
            <p class="br-item-excerpt">Belajar langsung rantai produksi modern — dari bahan baku, pengemasan, hingga standar mutu pangan.</p>
          </div>
        </article>

        <article class="br-item" data-reveal data-cat="akademik" data-search="jurusan perbankan syariah menggelar seminar literasi keuangan bagi siswa LPS">
          <div class="br-item-img"><img src="{{ asset('images/berita-digital.jpg') }}" alt="Seminar literasi keuangan SMK Negeri 2 Mojokerto" loading="eager"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-akademik"><i class="fas fa-book-open"></i> Akademik</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 28 Juni 2026</span>
            </div>
            <h3><a href="#">Perbankan Syariah Gelar Seminar Literasi Keuangan bagi Siswa</a></h3>
            <p class="br-item-excerpt">Praktisi bank syariah berbagi kiat mengelola keuangan sejak dini di hadapan 200 peserta didik.</p>
          </div>
        </article>

        <article class="br-item" data-reveal data-cat="ekstrakurikuler" data-search="perkemahan pramuka Skaneda melatih kemandirian dan cinta alam sabtu minggu">
          <div class="br-item-img"><img src="{{ asset('images/berita-pramuka.jpg') }}" alt="Kegiatan Pramuka SMK Negeri 2 Mojokerto" loading="eager"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-ekstrakurikuler"><i class="fas fa-users"></i> Ekstrakurikuler</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 22 Juni 2026</span>
            </div>
            <h3><a href="#">Perkemahan Pramuka Skaneda: Melatih Kemandirian dan Cinta Alam</a></h3>
            <p class="br-item-excerpt">120 anggota pramuka mengikuti perkemahan Sabtu–Minggu di Bumi Perkemahan Mojokerto.</p>
          </div>
        </article>

        <article class="br-item" data-reveal data-cat="ekstrakurikuler" data-search="sanggar tari Skaneda meriahkan festival budaya kota Mojokerto seni tari">
          <div class="br-item-img"><img src="{{ asset('images/berita-tari.jpg') }}" alt="Penampilan sanggar tari SMK Negeri 2 Mojokerto" loading="eager"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-ekstrakurikuler"><i class="fas fa-users"></i> Ekstrakurikuler</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 18 Juni 2026</span>
            </div>
            <h3><a href="#">Sanggar Tari Skaneda Meriahkan Festival Budaya Kota Mojokerto</a></h3>
            <p class="br-item-excerpt">Penampilan Tari Remo kolosal membuka rangkaian acara dan mendapat tepuk tangan meriah.</p>
          </div>
        </article>

        <article class="br-item" data-reveal data-cat="sekolah" data-search="upacara bendera rutin pembina menekankan nilai kedisiplinan dan integritas">
          <div class="br-item-img"><img src="{{ asset('images/berita-upacara.jpg') }}" alt="Upacara bendera SMK Negeri 2 Mojokerto" loading="eager"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-sekolah"><i class="fas fa-school"></i> Sekolah</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 12 Juni 2026</span>
            </div>
            <h3><a href="#">Upacara Bendera: Pembina Tekankan Kedisiplinan dan Integritas</a></h3>
            <p class="br-item-excerpt">Amanat pembina upacara mengingatkan pentingnya karakter sebelum kompetensi di dunia kerja.</p>
          </div>
        </article>

        <article class="br-item" data-reveal data-cat="sekolah" data-search="Skaneda menggelar simulasi baris berbaris PBB bagi anggota baru kedisiplinan">
          <div class="br-item-img"><img src="{{ asset('images/berita-pbb.jpg') }}" alt="Latihan baris berbaris siswa SMK Negeri 2 Mojokerto" loading="eager"></div>
          <div class="br-item-body">
            <div class="br-item-top">
              <span class="br-cat br-cat-sekolah"><i class="fas fa-school"></i> Sekolah</span>
              <span class="br-item-date"><i class="fas fa-calendar-alt"></i> 08 Juni 2026</span>
            </div>
            <h3><a href="#">Simulasi Baris-Berbaris: Membangun Disiplin Anggota Baru</a></h3>
            <p class="br-item-excerpt">Rangkaian pelatihan PBB bertujuan menanamkan ketertiban, kerja sama, dan rasa bangga sekolah.</p>
          </div>
        </article>

        <div class="br-empty" id="brEmpty">
          <i class="fas fa-newspaper"></i>
          Tidak ada berita yang cocok dengan pencarian atau kategori ini. Coba kata kunci lain.
        </div>
      </div>

      <!-- MOST READ -->
      <aside class="br-most" data-reveal="right">
        <div class="br-most-head">
          <i class="fas fa-fire"></i>
          <div>
            <h3>Paling Banyak Dibaca</h3>
            <span>Most Read · Minggu Ini</span>
          </div>
        </div>
        <div class="br-most-list">
          <a href="#" class="br-most-item">
            <span class="br-most-num">01</span>
            <span class="br-most-body"><b>Jadwal, Syarat &amp; Jalur PPDB SMKN 2 Mojokerto 2026/2027</b><span><i class="fas fa-eye"></i> 2.410 dibaca</span></span>
          </a>
          <a href="#" class="br-most-item">
            <span class="br-most-num">02</span>
            <span class="br-most-body"><b>Siswa RPL Sabet Juara 1 LKS Web Technologies Kota Mojokerto</b><span><i class="fas fa-eye"></i> 1.284 dibaca</span></span>
          </a>
          <a href="#" class="br-most-item">
            <span class="br-most-num">03</span>
            <span class="br-most-body"><b>Gelar Karya P5: Kuliner &amp; Aplikasi Digital Dipamerkan</b><span><i class="fas fa-eye"></i> 986 dibaca</span></span>
          </a>
          <a href="#" class="br-most-item">
            <span class="br-most-num">04</span>
            <span class="br-most-body"><b>Paskibra Skaneda Latihan Intensif Sambut HUT RI</b><span><i class="fas fa-eye"></i> 742 dibaca</span></span>
          </a>
          <a href="#" class="br-most-item">
            <span class="br-most-num">05</span>
            <span class="br-most-body"><b>Uji Kompetensi Keahlian Siswa Kelas XII Serentak</b><span><i class="fas fa-eye"></i> 655 dibaca</span></span>
          </a>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ================= 3. CERITA SKANEDA ================= -->
<section class="br-story">
  <div class="br-story-bg" aria-hidden="true"></div>
  <div class="br-story-inner">
    <span class="br-block" style="top:14%;right:10%" aria-hidden="true"></span>
    <span class="br-dots" style="bottom:12%;right:6%" aria-hidden="true"></span>
    <div class="br-sec-head" data-reveal>
      <div>
        <span class="br-eyebrow">Long Read · Feature</span>
        <h2 class="br-sec-title">Cerita <em>Skaneda</em></h2>
        <div class="br-rule"></div>
        <p class="br-sec-sub" style="color:rgba(235,245,253,.78)">Liputan mendalam tentang orang-orang dan perjalanan di balik setiap pencapaian.</p>
      </div>
      <div class="br-num" style="color:rgba(255,255,255,.1)" aria-hidden="true">03</div>
    </div>

    <div class="br-story-grid">
      <article class="br-story-card" data-reveal>
        <span class="br-cat br-cat-prestasi"><i class="fas fa-trophy"></i> Feature</span>
        <h4>Trofi demi Trofi: Perjalanan Panjang Tim LKS Skaneda</h4>
        <p>Dari latihan seleksi hingga panggung nasional — bagaimana pembina dan siswa membangun budaya juara yang konsisten.</p>
        <a href="#" class="br-story-link">Baca Kisahnya <i class="fas fa-arrow-right"></i></a>
      </article>
      <article class="br-story-card" data-reveal style="--d:.1s">
        <span class="br-cat br-cat-kegiatan"><i class="fas fa-flag"></i> Kegiatan</span>
        <h4>Dari Dapur Praktik ke Meja Panitia: Kuliner Skaneda</h4>
        <p>Dibalik hidangan yang selalu habis saat Gelar Karya, ada ratusan jam latihan, resep turun-temurun, dan kerja tim.</p>
        <a href="#" class="br-story-link">Baca Kisahnya <i class="fas fa-arrow-right"></i></a>
      </article>
      <article class="br-story-card" data-reveal style="--d:.2s">
        <span class="br-cat br-cat-sekolah"><i class="fas fa-school"></i> Tradisi</span>
        <h4>Disiplin yang Menjadi Tradisi: Profil Keseharian Skaneda</h4>
        <p>Bel masuk pukul 06.45, salam budaya, dan budaya antre — nilai-nilai kecil yang membentuk lulusan berkarakter.</p>
        <a href="#" class="br-story-link">Baca Kisahnya <i class="fas fa-arrow-right"></i></a>
      </article>
    </div>
  </div>
</section>

<!-- ================= CTA ================= -->
<section class="br-cta">
  <div class="home-orn" aria-hidden="true">
    <span class="ho-chevron"></span>
    <span class="ho-line"></span>
    <span class="ho-dots"></span>
    <span class="ho-ring"></span>
    <span class="ho-gold"></span>
    <span class="ho-square"></span>
  </div>
  <h2 class="br-cta-title">Punya kabar menarik<br>dari <em>Skaneda?</em></h2>
  <p>Kirim liputan, dokumentasi kegiatan, atau karya jurnalistikmu untuk dimuat di kanal Berita Skaneda — redaksi terbuka untuk seluruh warga sekolah.</p>
  <a href="{{ route('kontak') }}" class="br-cta-btn"><i class="fas fa-paper-plane"></i> Kirim ke Redaksi</a>
  <div class="br-cta-note"><i class="fas fa-info-circle"></i> Informasi resmi: smkn2mojokerto.sch.id · #DisiplinBerprestasi</div>
</section>

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
  /* Fallback: pastikan elemen di atas fold langsung tampil */
  setTimeout(function () {
    revealEls.forEach(function (el) {
      var r = el.getBoundingClientRect();
      if (r.top < window.innerHeight) el.classList.add('revealed');
    });
  }, 300);

  /* ---------- FILTER KATEGORI + SEARCH ---------- */
  var filterBtns = document.querySelectorAll('.br-filter-btn');
  var searchInput = document.getElementById('brSearch');
  var articles = document.querySelectorAll('.br-list .br-item, .br-latest .br-featured, .br-latest .br-side-item');
  var emptyBox = document.getElementById('brEmpty');
  var activeFilter = 'semua';

  function applyFilter() {
    var q = (searchInput && searchInput.value ? searchInput.value.toLowerCase().trim() : '');
    var visible = 0;
    articles.forEach(function (art) {
      var cat = (art.getAttribute('data-cat') || 'semua').toLowerCase();
      var text = (art.getAttribute('data-search') || art.textContent || '').toLowerCase();
      var catOk = (activeFilter === 'semua' || cat === activeFilter);
      var qOk = (q === '' || text.indexOf(q) !== -1);
      var show = catOk && qOk;
      art.style.display = show ? '' : 'none';
      if (show) visible++;
    });
    if (emptyBox) emptyBox.classList.toggle('show', visible === 0);
  }

  filterBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      filterBtns.forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');
      activeFilter = btn.getAttribute('data-filter') || 'semua';
      applyFilter();
    });
  });

  if (searchInput) {
    var debounce;
    searchInput.addEventListener('input', function () {
      clearTimeout(debounce);
      debounce = setTimeout(applyFilter, 220);
    });
  }
})();
</script>
@endpush
