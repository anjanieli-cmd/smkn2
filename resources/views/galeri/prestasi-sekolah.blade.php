@extends('layouts.app')

@section('title', 'Prestasi Sekolah — SMK Negeri 2 Mojokerto')
@section('description', 'Prestasi institusi SMK Negeri 2 Mojokerto — trophy cabinet, pencapaian utama, galeri penghargaan, dan arsip prestasi resmi sekolah dari tingkat kota hingga nasional.')

@push('styles')
<style>
/* =========================================================
   PRESTASI SEKOLAH — INSTITUTIONAL TROPHY CABINET
   Prestise, formal, monumental. Berbeda dari Prestasi Siswa
   (student hall of fame) — ini arsip pencapaian resmi sekolah.
   Header (layouts.app) & footer TIDAK diubah.
   HERO kini disamakan gayanya dengan HERO halaman Kegiatan
   (light theme, ornament image, tanpa foto besar di kanan).
   Visual language: navy #0d3a66, biru #2f6fa8, gold
   #ffd54a/#ffb300, Sora display, editorial premium, ornamen
   formal (thin frame, circle, star, medal, dotted, garis gold).
   ========================================================= */
.psk-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}
.psk-page *{box-sizing:border-box}

/* ---------- HERO: light theme, SAMA GAYA dengan hero Kegiatan ---------- */
.psk-hero{position:relative;min-height:clamp(560px,72vh,740px);display:flex;align-items:center;overflow:hidden;
  background:#fff;color:#0d3a66;isolation:isolate}
.psk-hero::after{content:"PRESTASI";position:absolute;z-index:0;left:2%;top:58%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(3.4rem,11.5vw,11.5rem);font-weight:900;line-height:.78;
  letter-spacing:.01em;color:rgba(13,58,102,.035);-webkit-text-stroke:1px rgba(255,179,0,.09);
  pointer-events:none;white-space:nowrap;user-select:none}
.psk-ref-ornaments{position:absolute!important;inset:0;z-index:1;overflow:hidden;pointer-events:none;opacity:1}
.psk-ref-ornament-image{position:absolute!important;inset:0;width:100%;height:100%;display:block;
  object-fit:cover;object-position:center center;max-width:none;opacity:1}
.psk-hero-inner{position:relative;z-index:4;width:100%;max-width:1500px;margin:0 auto;
  padding:clamp(3.6rem,9vh,6rem) clamp(1.25rem,4.2vw,4.5rem) clamp(3.2rem,7vh,5rem);display:block}

.psk-kicker{position:relative;z-index:5;display:inline-flex;align-items:center;gap:.65rem;font-size:.72rem;
  font-weight:900;letter-spacing:.18em;text-transform:uppercase;color:#ffb300;margin-bottom:1.2rem;
  padding:.55rem .85rem;border:1px solid rgba(255,179,0,.18);border-radius:999px;background:#fffaf0}
.psk-kicker::before{content:"";width:9px;height:9px;border-radius:50%;background:#ffb300;
  box-shadow:0 0 0 6px rgba(255,179,0,.10)}

.psk-title{position:relative;z-index:5;font-family:var(--font-display);font-size:clamp(3.6rem,9vw,8rem);
  line-height:.86;letter-spacing:-.03em;margin:0;max-width:900px;text-transform:uppercase;
  text-shadow:none;animation:hdFadeUp .7s .1s var(--ease, ease) both}
.psk-title .psk-white{color:#0d3a66;display:block}
.psk-title .psk-gold{display:block;
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent;
  text-shadow:none;letter-spacing:-.02em}
.psk-lead{position:relative;z-index:5;font-size:1rem;line-height:1.8;color:#52657a;max-width:640px;
  margin:1.6rem 0 0;animation:hdFadeUp .7s .26s var(--ease, ease) both}
.psk-hero-meta{position:relative;z-index:5;display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;
  animation:hdFadeUp .7s .4s var(--ease, ease) both}
.psk-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;
  border:1px solid rgba(13,58,102,.12);background:#fff;border-radius:999px;color:#0d3a66;
  font-size:.72rem;font-weight:800;box-shadow:0 8px 24px rgba(13,58,102,.06)}
.psk-pill i{color:#ffb300}

@media(min-width:1050px){.psk-hero-inner{padding-right:40%}}
@media(max-width:1050px){.psk-hero-inner{padding-right:1.25rem}.psk-ref-ornaments{opacity:.72}}
@media(max-width:900px){.psk-title{font-size:clamp(3.2rem,10.5vw,6rem)}.psk-ref-ornament-image{opacity:.88}}
@media(max-width:700px){.psk-hero{align-items:flex-start;min-height:0}
  .psk-hero-inner{width:90%;padding:clamp(3rem,8vh,4.5rem) 5% 3.2rem}
  .psk-hero::after{font-size:clamp(3.2rem,20vw,5.4rem);opacity:.6;left:-2%}
  .psk-title{font-size:clamp(2.6rem,12vw,3.8rem)}}
@media(max-width:560px){.psk-ref-ornament-image{opacity:.62}}

/* ---------- UTIL: reveal + layout dasar ---------- */
[data-reveal]{opacity:0;transform:translateY(28px);transition:opacity .75s var(--ease,ease),transform .75s var(--ease,ease)}
[data-reveal].revealed{opacity:1;transform:none}
[data-reveal=left]{transform:translateX(-30px)}
[data-reveal=right]{transform:translateX(30px)}
[data-reveal=left].revealed,[data-reveal=right].revealed{transform:none}

.psk-section{max-width:1240px;margin:0 auto;padding:clamp(4rem,8vw,6.5rem) clamp(1.5rem,5vw,3rem);position:relative}

/* ---------- EYEBROW + SECTION TITLE ---------- */
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
  border:1px solid rgba(13,58,102,.08);min-height:480px;display:flex;align-items:flex-end;
  background-image:url('{{ asset('images/ps-piala.jpg') }}');
  background-size:cover;background-position:center 30%;background-repeat:no-repeat;background-color:#0d3a66}
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
  aspect-ratio:4/3;border:1px solid rgba(13,58,102,.08);background:#0d3a66}
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

/* ---------- 3. PENCAPAIAN UTAMA (angka besar — dibuat ringkas, 3 kartu) ---------- */
.psk-stats{background:#0d3a66;color:#fff;position:relative;overflow:hidden}
.psk-stats::before{content:"";position:absolute;inset:0;opacity:.5;
  background-image:radial-gradient(rgba(255,213,74,.16) 1.5px,transparent 1.6px);background-size:26px 26px}
.psk-stats .psk-section{position:relative;z-index:2}
.psk-stats .psk-section-title{color:#fff}
.psk-stats .psk-subtitle{color:rgba(235,245,253,.75)}
.psk-stats-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.2rem;margin-top:2.6rem}
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

/* ---------- 4. GALERI PENGHARGAAN (slider + filter) ---------- */
.psk-gallery{background:#fff;position:relative}
.psk-gallery-tools{display:flex;justify-content:space-between;align-items:flex-end;gap:1.2rem;flex-wrap:wrap;margin-top:1.8rem}
.psk-gallery-tools-left{display:flex;flex-direction:column;gap:1rem}
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

/* slider arrows */
.psk-slider-arrows{display:flex;gap:.6rem;flex-shrink:0}
.psk-slider-arrow{width:48px;height:48px;border-radius:50%;display:flex;align-items:center;justify-content:center;
  font-size:1rem;color:#0d3a66;background:#fff;border:1px solid rgba(13,58,102,.16);cursor:pointer;
  box-shadow:0 10px 24px rgba(13,58,102,.1);transition:all .3s var(--ease,ease)}
.psk-slider-arrow:hover{background:#0d3a66;color:#ffd54a;border-color:#0d3a66;transform:translateY(-2px)}
.psk-slider-arrow:disabled{opacity:.32;cursor:not-allowed;transform:none;background:#fff;color:#0d3a66;border-color:rgba(13,58,102,.16)}

/* slider track */
.psk-slider-wrap{position:relative;margin-top:2.2rem}
.psk-slider-wrap::after{content:"";position:absolute;right:0;top:0;bottom:0;width:80px;pointer-events:none;
  background:linear-gradient(90deg,rgba(255,255,255,0),#fff 88%)}
.psk-masonry{display:flex;gap:1.2rem;overflow-x:auto;scroll-snap-type:x mandatory;padding:.3rem .3rem 1rem;
  scrollbar-width:none;-ms-overflow-style:none}
.psk-masonry::-webkit-scrollbar{display:none}
.psk-photo{position:relative;flex:0 0 clamp(220px,25vw,290px);aspect-ratio:3/4;scroll-snap-align:start;
  border-radius:20px;overflow:hidden;display:block;cursor:pointer;text-decoration:none;
  border:1px solid rgba(13,58,102,.08);background:#0d3a66;box-shadow:0 16px 36px rgba(13,58,102,.1)}
.psk-photo img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .8s var(--ease,ease)}
.psk-photo:hover img{transform:scale(1.06)}
.psk-photo::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,rgba(7,22,42,0) 45%,rgba(7,22,42,.82) 100%);
  opacity:.8;transition:opacity .4s var(--ease,ease)}
.psk-photo:hover::after{opacity:1}
.psk-photo-cap{position:absolute;z-index:3;left:1.1rem;right:1.1rem;bottom:1rem}
.psk-photo-cap strong{display:block;font-size:.92rem;font-weight:800;color:#fff;line-height:1.3}
.psk-photo-cap span{display:inline-flex;align-items:center;gap:.35rem;font-size:.68rem;font-weight:700;letter-spacing:.08em;
  text-transform:uppercase;color:#ffd54a;margin-top:.35rem}
.psk-photo-zoom{position:absolute;z-index:3;top:1rem;right:1rem;width:40px;height:40px;border-radius:12px;
  display:flex;align-items:center;justify-content:center;font-size:.85rem;color:#fff;
  background:rgba(7,22,42,.5);border:1px solid rgba(255,255,255,.25);backdrop-filter:blur(6px);
  opacity:0;transform:translateY(-6px);transition:all .35s var(--ease,ease)}
.psk-photo:hover .psk-photo-zoom{opacity:1;transform:none}
.psk-gallery-foot{display:flex;justify-content:center;margin-top:1rem}
.psk-note{display:inline-flex;align-items:center;gap:.6rem;font-size:.82rem;font-weight:700;color:#5a6f88;
  background:#f4f7fb;border:1px dashed rgba(13,58,102,.2);padding:.7rem 1.2rem;border-radius:999px}
.psk-note i{color:#ffb300}
@media(max-width:640px){.psk-slider-wrap::after{width:40px}}

/* ---------- 5. QUOTE / MOTO (background diperkaya — tidak polos lagi) ---------- */
.psk-quote{position:relative;overflow:hidden;background:linear-gradient(135deg,#0a2c4d 0%,#0d3a66 45%,#123f6e 100%)}
/* lapisan pattern dasar — selalu tampil walau foto belum ada */
.psk-quote::before{content:"";position:absolute;inset:0;z-index:0;opacity:.55;
  background-image:radial-gradient(rgba(255,213,74,.16) 1.6px,transparent 1.7px);background-size:26px 26px}
/* foto opsional, dicampur secara halus di atas pattern */
.psk-quote-bg{position:absolute;inset:0;z-index:1}
.psk-quote-bg img{width:100%;height:100%;object-fit:cover;display:block;opacity:.24;mix-blend-mode:luminosity}
.psk-quote-bg::after{content:"";position:absolute;inset:0;background:linear-gradient(100deg,rgba(7,22,42,.95) 0%,rgba(9,30,54,.8) 55%,rgba(9,30,54,.55) 100%)}
/* ornamen formal — ring, garis gold, bintang, corner brackets */
.psk-quote-orn{position:absolute;inset:0;z-index:1;pointer-events:none}
.psk-quote-orn .qo-ring1{position:absolute;width:240px;height:240px;left:-80px;top:-90px;
  border:1px solid rgba(255,213,74,.22);border-radius:50%}
.psk-quote-orn .qo-ring1::before{content:"";position:absolute;inset:28px;border:1px dashed rgba(255,213,74,.16);border-radius:50%}
.psk-quote-orn .qo-ring2{position:absolute;width:160px;height:160px;right:6%;bottom:-70px;
  border:1px solid rgba(255,255,255,.14);border-radius:50%}
.psk-quote-orn .qo-gold-l{position:absolute;left:8%;top:22%;width:64px;height:3px;border-radius:99px;
  background:linear-gradient(90deg,#ffd54a,#ffb300);opacity:.65}
.psk-quote-orn .qo-gold-r{position:absolute;right:9%;bottom:20%;width:64px;height:3px;border-radius:99px;
  background:linear-gradient(90deg,#ffb300,#ffd54a);opacity:.65}
.psk-quote-orn .qo-star{position:absolute;right:14%;top:16%;font-size:1.5rem;color:rgba(255,213,74,.4)}
.psk-quote-orn .qo-star2{position:absolute;left:12%;bottom:16%;font-size:1.1rem;color:rgba(255,213,74,.3)}
.psk-quote-orn .qo-corner{position:absolute;width:120px;height:120px;left:0;top:0;
  border-top:1px solid rgba(255,213,74,.3);border-left:1px solid rgba(255,213,74,.3);border-radius:22px 0 0 0}
.psk-quote-orn .qo-corner2{position:absolute;width:120px;height:120px;right:0;bottom:0;
  border-bottom:1px solid rgba(255,213,74,.3);border-right:1px solid rgba(255,213,74,.3);border-radius:0 0 22px 0}
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

/* ---------- 6. DAFTAR PRESTASI (arsip ringkas — mudah ditambah sendiri) ---------- */
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
.psk-row{display:flex;flex-direction:column;background:#fff;
  border:1px solid rgba(13,58,102,.09);border-radius:18px;padding:.9rem 1.3rem .9rem .9rem;transition:all .3s var(--ease,ease)}
.psk-row:hover{transform:translateY(-3px);box-shadow:0 14px 30px rgba(13,58,102,.1);border-color:rgba(255,179,0,.45)}
.psk-row-top{display:grid;grid-template-columns:76px 1fr auto;gap:1.1rem;align-items:center}
/* link "Lihat Berita" di bawah tiap kartu prestasi */
.psk-row-link{display:inline-flex;align-items:center;gap:.45rem;margin-top:.85rem;padding-top:.8rem;
  border-top:1px dashed rgba(13,58,102,.14);font-size:.78rem;font-weight:800;letter-spacing:.02em;
  color:#0d3a66;text-decoration:none;transition:gap .25s var(--ease,ease),color .25s var(--ease,ease)}
.psk-row-link i{color:#ffb300;font-size:.72rem;transition:transform .25s var(--ease,ease)}
.psk-row-link:hover{gap:.7rem;color:#ffb300}
.psk-row-link:hover i{transform:translateX(3px)}
/* foto per prestasi + badge rank menempel di sudut foto */
.psk-row-photo{position:relative;width:76px;height:76px;border-radius:14px;overflow:hidden;flex-shrink:0;background:#0d3a66}
.psk-row-photo img{width:100%;height:100%;object-fit:cover;display:block}
.psk-row-rank{position:absolute;left:-6px;bottom:-6px;width:30px;height:30px;border-radius:50%;display:flex;
  align-items:center;justify-content:center;font-size:.72rem;border:2px solid #fff;
  background:linear-gradient(135deg,rgba(255,213,74,.9),rgba(255,179,0,.9));color:#0d3a66;
  box-shadow:0 4px 10px rgba(13,58,102,.3)}
.psk-row-rank.gold{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66}
.psk-row-rank.silver{background:linear-gradient(135deg,#e3eaf1,#b7c2cf);color:#0d3a66}
.psk-row-rank.bronze{background:linear-gradient(135deg,#e8b78a,#c8875a);color:#3a2410}
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
  .psk-stats-grid{grid-template-columns:repeat(3,1fr)}
  .psk-archive-grid{grid-template-columns:1fr}
  .psk-cta-box{grid-template-columns:1fr;gap:1.5rem}
  .psk-cta-btn{justify-self:start}
}
@media (max-width:860px){
  .psk-opening .psk-section,.psk-featured .psk-section{grid-template-columns:1fr;gap:2.5rem}
  .psk-cabinet{min-height:420px}
  .psk-gallery-tools{flex-direction:column;align-items:flex-start}
  .psk-slider-arrows{align-self:flex-end}
  .psk-yearnav{width:100%;overflow-x:auto;padding-bottom:.4rem}
  .psk-archive-head{grid-template-columns:1fr;gap:1rem}
  .psk-archive-badge{justify-self:start}
}
@media (max-width:640px){
  .psk-stats-grid{grid-template-columns:1fr 1fr;gap:.8rem}
  .psk-stat{padding:1.5rem 1.1rem 1.3rem}
  .psk-photo{flex-basis:68vw}
  .psk-opening-meta{grid-template-columns:1fr 1fr}
  .psk-feat-meta{flex-direction:column;align-items:flex-start}
  .psk-filters{flex-wrap:nowrap;overflow-x:auto;width:100%;padding-bottom:.4rem}
  .psk-cta-box h3{font-size:clamp(1.5rem,7vw,2rem)}
  .psk-row{grid-template-columns:60px 1fr;row-gap:.5rem}
  .psk-row-photo{width:60px;height:60px}
  .psk-row-tag{grid-column:1/-1;justify-self:start;margin-top:.2rem}
}
</style>
@endpush

@section('content')
<div class="psk-page">

  <!-- ================= HERO (SAMA GAYA dengan hero Kegiatan) ================= -->
  <section class="psk-hero">
    <div class="psk-ref-ornaments" aria-hidden="true" style="background-image:url('{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}');background-size:cover;background-position:center center;">
      <img
        src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}"
        alt=""
        class="psk-ref-ornament-image"
        aria-hidden="true"
      >
    </div>
    <div class="psk-hero-inner">
      <div>
        <div class="psk-kicker">Trophy Cabinet Sekolah</div>
        <h1 class="psk-title">
          <span class="psk-white">Prestasi</span>
          <span class="psk-gold">Sekolah</span>
        </h1>
        <p class="psk-lead">Dari kota hingga panggung nasional — setiap penghargaan adalah bukti komitmen SMK Negeri 2 Mojokerto dalam membangun pendidikan vokasi yang unggul, disiplin, dan berdaya saing.</p>
        <div class="psk-hero-meta">
          <span class="psk-pill"><i class="fas fa-award"></i> Arsip Resmi Sekolah</span>
          <span class="psk-pill"><i class="fas fa-map-marked-alt"></i> Kota → Nasional</span>
          <span class="psk-pill"><i class="fas fa-building"></i> 5 Kompetensi Keahlian</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= 1. PEMBUKA: JEJAK PRESTASI SKANEDA ================= -->
  <section class="psk-opening">
    <div class="psk-section">
      <div data-reveal="left">
        <span class="psk-eyebrow">Institutional Achievement</span>
        <h2 class="psk-section-title">Jejak Prestasi<br><span class="psk-gold">Skaneda</span></h2>
        <p class="psk-opening-desc">Kumpulan pencapaian <strong>SMK Negeri 2 Mojokerto</strong> dalam membangun sekolah vokasi yang unggul dan berprestasi. Bukan hanya milik individu — setiap piala adalah hasil kerja sama seluruh warga sekolah: peserta didik, guru pembina, dan mitra industri.</p>
        <!-- Ganti angka di bawah sesuai data riil sekolah. Kalau prestasi belum banyak,
             pakai satuan yang tetap terasa "penuh" (mis. total penghargaan gabungan
             semua tingkat, bukan dipecah per-tingkat). -->
        <div class="psk-opening-meta">
          <div class="psk-om"><b><em data-count="12">0</em>+</b><span>Total Penghargaan</span></div>
          <div class="psk-om"><b>Provinsi</b><span>Level Tertinggi Diraih</span></div>
          <div class="psk-om"><b>3</b><span>Kompetensi Raih Juara</span></div>
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
            <p>Piala, medali, dan sertifikat dari berbagai ajang resmi — LKS, FLS2N, O2SN, hingga kompetisi industri — terpajang sebagai bukti nyata perjalanan institusi.</p>
            <div class="psk-cabinet-foot">
              <span><i class="fas fa-calendar-alt"></i> 2024 — 2025</span>
              <span><i class="fas fa-medal"></i> 12+ Penghargaan</span>
              <span><i class="fas fa-flag"></i> Provinsi</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= 2. FEATURED ACHIEVEMENT ================= -->
  <!-- Cukup 1 pencapaian terbaik yang paling dibanggakan sekolah — tidak perlu banyak. -->
  <section class="psk-featured">
    <div class="psk-section">
      <div class="psk-feat-photo" data-reveal="left">
        <img src="{{ asset('images/ps-juara-cloud.jpg') }}" alt="Peserta didik Skaneda memegang piala Juara 1 Cloud Computing" loading="eager">
        <span class="psk-feat-badge"><i class="fas fa-crown"></i> Featured Achievement</span>
        <span class="psk-feat-year">2025<small>Tahun Capaian</small></span>
      </div>
      <div class="psk-feat-info" data-reveal="right">
        <span class="psk-eyebrow">Capaian Utama Institusi</span>
        <span class="psk-feat-rank"><i class="fas fa-trophy"></i> Juara 1 — LKS Tingkat Provinsi</span>
        <h3>Cloud Computing <em>Jawa Timur</em></h3>
        <p class="psk-feat-desc">Peserta didik Rekayasa Perangkat Lunak mewakili sekolah di Lomba Kompetensi Siswa tingkat provinsi bidang Cloud Computing — pencapaian tertinggi sekolah sejauh ini dalam ajang bergengsi pendidikan vokasi.</p>
        <div class="psk-feat-meta">
          <span><i class="fas fa-flag"></i> Provinsi</span>
          <span><i class="fas fa-user-graduate"></i> Rekayasa Perangkat Lunak</span>
          <span><i class="fas fa-calendar-alt"></i> 2025</span>
          <span><i class="fas fa-medal"></i> Juara 1</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= 3. PENCAPAIAN UTAMA (3 kartu — angka yang tetap solid tanpa harus banyak data) ================= -->
  <section class="psk-stats">
    <div class="psk-section">
      <div data-reveal>
        <span class="psk-eyebrow">Angka Berbicara</span>
        <h2 class="psk-section-title">Pencapaian <span class="psk-gold">Utama</span></h2>
        <p class="psk-subtitle">Rekapitulasi capaian institusi yang terus tumbuh dari tahun ke tahun — dibina melalui program prestasi lintas kompetensi keahlian.</p>
      </div>
      <div class="psk-stats-grid">
        <div class="psk-stat" data-reveal>
          <div class="psk-stat-icon"><i class="fas fa-trophy"></i></div>
          <b><em data-count="12">0</em>+</b>
          <span>Total Penghargaan</span>
          <p class="psk-stat-note">Akumulasi seluruh juara dari berbagai ajang resmi yang diikuti sekolah.</p>
        </div>
        <div class="psk-stat" data-reveal style="--d:1">
          <div class="psk-stat-icon"><i class="fas fa-map-marked-alt"></i></div>
          <b>Provinsi</b>
          <span>Level Tertinggi Diraih</span>
          <p class="psk-stat-note">Jenjang kompetisi tertinggi yang berhasil dicapai peserta didik.</p>
        </div>
        <div class="psk-stat" data-reveal style="--d:2">
          <div class="psk-stat-icon"><i class="fas fa-star"></i></div>
          <b><em data-count="3">0</em></b>
          <span>Kompetensi Raih Juara</span>
          <p class="psk-stat-note">Kompetensi keahlian yang pernah menyumbang juara bagi sekolah.</p>
        </div>
      </div>
      <div class="psk-ajang" data-reveal><i class="fas fa-tags"></i> Ajang resmi yang rutin diikuti</div>
      <div class="psk-ajang-chips" data-reveal>
        <span class="psk-chip"><i class="fas fa-code"></i> LKS SMK</span>
        <span class="psk-chip"><i class="fas fa-palette"></i> FLS2N</span>
        <span class="psk-chip"><i class="fas fa-running"></i> O2SN</span>
        <span class="psk-chip"><i class="fas fa-fire"></i> Kompetisi Digital</span>
      </div>
    </div>
  </section>

  <!-- ================= 4. GALERI PENGHARGAAN (dipersingkat jadi 6 foto — tambahin sendiri kalau nambah dokumentasi) ================= -->
  <section class="psk-gallery">
    <div class="psk-section">
      <div data-reveal>
        <span class="psk-eyebrow">Dokumentasi Penghargaan</span>
        <h2 class="psk-section-title">Galeri <span class="psk-gold">Penghargaan</span></h2>
        <p class="psk-subtitle">Momen resmi sekolah — penyerahan penghargaan, apresiasi pembina, dan perayaan piala. Klik foto untuk memperbesar.</p>
      </div>

      <div class="psk-gallery-tools" data-reveal>
        <div class="psk-gallery-tools-left">
          <div class="psk-filters" id="pskFilters">
            <button class="psk-fbtn active" data-filter="all"><i class="fas fa-th-large"></i> Semua</button>
            <button class="psk-fbtn" data-filter="kota"><i class="fas fa-building"></i> Kota / Kabupaten</button>
            <button class="psk-fbtn" data-filter="prov"><i class="fas fa-map-marked-alt"></i> Provinsi</button>
          </div>
          <div class="psk-yearnav" id="pskYearNav">
            <span class="psk-yearnav-label"><i class="fas fa-calendar-alt"></i> Tahun</span>
            <button class="psk-ybtn active" data-year="all">ALL</button>
            <button class="psk-ybtn" data-year="2025">2025</button>
            <button class="psk-ybtn" data-year="2024">2024</button>
          </div>
        </div>
        <div class="psk-slider-arrows">
          <button class="psk-slider-arrow" id="pskSliderPrev" aria-label="Geser ke kiri"><i class="fas fa-chevron-left"></i></button>
          <button class="psk-slider-arrow" id="pskSliderNext" aria-label="Geser ke kanan"><i class="fas fa-chevron-right"></i></button>
        </div>
      </div>

      <!-- Slider (geser/scroll horizontal). Tinggal 6 foto — mau nambah? Copy 1 blok <a class="psk-photo">...</a>, ganti gambar & caption-nya. -->
      <div class="psk-slider-wrap">
        <div class="psk-masonry" id="pskMasonry" data-reveal>
          <a class="psk-photo" href="#" data-full="images/ps-penghargaan.jpg" data-cap="Penyerahan Penghargaan" data-sub="Apresiasi piala juara lomba" data-level="kota" data-year="2025">
            <img src="{{ asset('images/ps-penghargaan.jpg') }}" alt="Penyerahan penghargaan lomba" loading="eager">
            <span class="psk-photo-zoom"><i class="fas fa-search-plus"></i></span>
            <span class="psk-photo-cap"><strong>Penyerahan Penghargaan</strong><span><i class="fas fa-trophy"></i> Kota · 2025</span></span>
          </a>
          <a class="psk-photo" href="#" data-full="images/ps-piala.jpg" data-cap="Etalase Piala Sekolah" data-sub="Koleksi trofi kejuaraan" data-level="all" data-year="2024">
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
          <a class="psk-photo" href="#" data-full="images/ps-upacara.jpg" data-cap="Apresiasi Upacara" data-sub="Pengumuman prestasi saat upacara" data-level="all" data-year="2024">
            <img src="{{ asset('images/ps-upacara.jpg') }}" alt="Apresiasi prestasi saat upacara bendera" loading="eager">
            <span class="psk-photo-zoom"><i class="fas fa-search-plus"></i></span>
            <span class="psk-photo-cap"><strong>Apresiasi Upacara</strong><span><i class="fas fa-star"></i> Sekolah · 2024</span></span>
          </a>
          <a class="psk-photo" href="#" data-full="images/ps-juara-cloud.jpg" data-cap="Juara 1 Cloud Computing" data-sub="Piala LKS Cloud Computing" data-level="prov" data-year="2025">
            <img src="{{ asset('images/ps-juara-cloud.jpg') }}" alt="Piala Juara 1 Cloud Computing" loading="eager">
            <span class="psk-photo-zoom"><i class="fas fa-search-plus"></i></span>
            <span class="psk-photo-cap"><strong>Juara 1 Cloud Computing</strong><span><i class="fas fa-map-marked-alt"></i> Provinsi · 2025</span></span>
          </a>
        </div>
      </div>

      <div class="psk-gallery-foot" data-reveal>
        <span class="psk-note"><i class="fas fa-images"></i> Geser atau pakai tombol panah untuk melihat foto lainnya.</span>
      </div>
    </div>
  </section>

  <!-- ================= 5. QUOTE / MOTO (background sudah lebih berisi — pattern + ornamen + foto opsional) ================= -->
  <section class="psk-quote">
    <div class="psk-quote-bg">
      <img src="{{ asset('images/ps-kampus.jpg') }}" alt="Lingkungan sekolah SMK Negeri 2 Mojokerto" loading="eager">
    </div>
    <div class="psk-quote-orn" aria-hidden="true">
      <span class="qo-ring1"></span>
      <span class="qo-ring2"></span>
      <span class="qo-gold-l"></span>
      <span class="qo-gold-r"></span>
      <span class="qo-star"><i class="fas fa-star"></i></span>
      <span class="qo-star2"><i class="fas fa-star"></i></span>
      <span class="qo-corner"></span>
      <span class="qo-corner2"></span>
    </div>
    <div class="psk-section" data-reveal>
      <span class="psk-quote-mark">"</span>
      <p class="psk-quote-text">Prestasi bukan sekadar penghargaan, tetapi <em>bukti perjalanan sekolah</em> dalam memberikan pendidikan terbaik.</p>
      <span class="psk-quote-src">Moto Prestasi SMK Negeri 2 Mojokerto</span>
    </div>
  </section>

  <!-- ================= 6. DAFTAR PRESTASI (arsip ringkas 2 tahun — tambah blok <div class="psk-year-block"> kalau perlu) ================= -->
  <section class="psk-archive">
    <div class="psk-section">
      <div class="psk-archive-head" data-reveal>
        <div>
          <span class="psk-eyebrow">Official Achievement Archive</span>
          <h2 class="psk-section-title">Daftar <span class="psk-gold">Prestasi</span></h2>
          <p class="psk-subtitle">Arsip resmi pencapaian sekolah, dikelompokkan berdasarkan tahun penyelenggaraan. Setiap entri merekam nama penghargaan, tingkat, dan kompetensi keahlian.</p>
        </div>
        <span class="psk-archive-badge"><i class="fas fa-file-alt"></i> Arsip 2024 — 2025</span>
      </div>

      <div class="psk-year-block" data-reveal>
        <div class="psk-year-head">
          <span class="psk-year-num">2025<em>.</em></span>
          <span class="psk-year-line"></span>
          <span class="psk-year-count"><i class="fas fa-trophy"></i> 3 Prestasi</span>
        </div>
        <!-- Tiap prestasi punya foto sendiri. Ganti gambar & class rank (gold/silver/bronze) sesuai juara. -->
        <div class="psk-archive-grid">
          <div class="psk-row">
            <div class="psk-row-top">
              <div class="psk-row-photo">
                <img src="{{ asset('images/ps-juara-cloud.jpg') }}" alt="Juara 1 LKS Cloud Computing">
                <span class="psk-row-rank gold"><i class="fas fa-trophy"></i></span>
              </div>
              <div class="psk-row-info"><h4>LKS Cloud Computing</h4><span><i class="fas fa-user-graduate"></i> Rekayasa Perangkat Lunak · Juara 1</span></div>
              <span class="psk-row-tag t-prov"><i class="fas fa-map-marked-alt"></i> Provinsi</span>
            </div>
            <a href="#" class="psk-row-link">Lihat Berita <i class="fas fa-arrow-right"></i></a>
          </div>
          <div class="psk-row">
            <div class="psk-row-top">
              <div class="psk-row-photo">
                <img src="{{ asset('images/ps-piala.jpg') }}" alt="Juara 1 Lomba Cipta Menu Kuliner">
                <span class="psk-row-rank gold"><i class="fas fa-trophy"></i></span>
              </div>
              <div class="psk-row-info"><h4>Lomba Cipta Menu Kuliner</h4><span><i class="fas fa-user-graduate"></i> Kuliner · Juara 1</span></div>
              <span class="psk-row-tag"><i class="fas fa-building"></i> Kota</span>
            </div>
            <a href="#" class="psk-row-link">Lihat Berita <i class="fas fa-arrow-right"></i></a>
          </div>
          <div class="psk-row">
            <div class="psk-row-top">
              <div class="psk-row-photo">
                <img src="{{ asset('images/ps-juara.jpg') }}" alt="Juara 2 Festival Desain Poster">
                <span class="psk-row-rank silver"><i class="fas fa-medal"></i></span>
              </div>
              <div class="psk-row-info"><h4>Festival Desain Poster</h4><span><i class="fas fa-user-graduate"></i> DKV · Juara 2</span></div>
              <span class="psk-row-tag"><i class="fas fa-building"></i> Kota</span>
            </div>
            <a href="#" class="psk-row-link">Lihat Berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
      </div>

      <div class="psk-year-block" data-reveal>
        <div class="psk-year-head">
          <span class="psk-year-num">2024<em>.</em></span>
          <span class="psk-year-line"></span>
          <span class="psk-year-count"><i class="fas fa-trophy"></i> 2 Prestasi</span>
        </div>
        <div class="psk-archive-grid">
          <div class="psk-row">
            <div class="psk-row-top">
              <div class="psk-row-photo">
                <img src="{{ asset('images/ps-podium.jpg') }}" alt="Juara 1 Lomba Bakery & Pastry">
                <span class="psk-row-rank gold"><i class="fas fa-trophy"></i></span>
              </div>
              <div class="psk-row-info"><h4>Lomba Bakery &amp; Pastry</h4><span><i class="fas fa-user-graduate"></i> Kuliner · Juara 1</span></div>
              <span class="psk-row-tag t-prov"><i class="fas fa-map-marked-alt"></i> Provinsi</span>
            </div>
            <a href="#" class="psk-row-link">Lihat Berita <i class="fas fa-arrow-right"></i></a>
          </div>
          <div class="psk-row">
            <div class="psk-row-top">
              <div class="psk-row-photo">
                <img src="{{ asset('images/ps-upacara.jpg') }}" alt="Juara 3 O2SN Bulu Tangkis">
                <span class="psk-row-rank bronze"><i class="fas fa-medal"></i></span>
              </div>
              <div class="psk-row-info"><h4>O2SN Bulu Tangkis</h4><span><i class="fas fa-user-graduate"></i> Umum · Juara 3</span></div>
              <span class="psk-row-tag"><i class="fas fa-building"></i> Kota</span>
            </div>
            <a href="#" class="psk-row-link">Lihat Berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= 7. CTA ================= -->
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
  var sliderTrack = doc.getElementById('pskMasonry');
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
    if (sliderTrack) sliderTrack.scrollTo({ left: 0, behavior: 'smooth' });
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

  /* ---------- Slider: tombol panah geser foto ---------- */
  var sliderPrev = doc.getElementById('pskSliderPrev');
  var sliderNext = doc.getElementById('pskSliderNext');
  function visiblePhotoWidth() {
    var first = photos.filter(function (p) { return p.style.display !== 'none'; })[0];
    if (!first) return 300;
    var style = window.getComputedStyle(sliderTrack);
    var gap = parseFloat(style.columnGap || style.gap || 0) || 19;
    return first.getBoundingClientRect().width + gap;
  }
  if (sliderTrack && sliderPrev && sliderNext) {
    sliderPrev.addEventListener('click', function () {
      sliderTrack.scrollBy({ left: -visiblePhotoWidth(), behavior: 'smooth' });
    });
    sliderNext.addEventListener('click', function () {
      sliderTrack.scrollBy({ left: visiblePhotoWidth(), behavior: 'smooth' });
    });
  }

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