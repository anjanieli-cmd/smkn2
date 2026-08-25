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
.psk-feat-photo img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block;z-index:2;transition:transform .9s var(--ease,ease)}
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

/* ---------- 3. PENCAPAIAN PRESTASI (artikel + filter tingkat) ---------- */
.psk-achv{background:#f4f7fb;position:relative}
.psk-achv-filters{display:flex;gap:.6rem;flex-wrap:wrap;margin-top:2rem}
.psk-achv-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.4rem;margin-top:2.2rem}
.psk-achv-card{display:flex;flex-direction:column;background:#fff;border:1px solid rgba(13,58,102,.08);
  border-radius:20px;overflow:hidden;cursor:pointer;box-shadow:0 12px 30px rgba(13,58,102,.06);
  transition:transform .35s var(--ease,ease),box-shadow .35s var(--ease,ease),border-color .35s var(--ease,ease)}
.psk-achv-card:hover{transform:translateY(-6px);box-shadow:0 22px 46px rgba(13,58,102,.14);border-color:rgba(255,179,0,.4)}
.psk-achv-card.is-hidden{display:none}
.psk-achv-photo{position:relative;aspect-ratio:16/10;background:linear-gradient(135deg,#0d3a66,#2f6fa8);
  display:flex;align-items:center;justify-content:center;overflow:hidden}
.psk-achv-photo i{font-size:1.6rem;color:rgba(255,213,74,.5)}
.psk-achv-photo img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block;transition:transform .7s var(--ease,ease)}
.psk-achv-card:hover .psk-achv-photo img{transform:scale(1.06)}
.psk-achv-rank{position:absolute;z-index:2;top:.8rem;left:.8rem;display:inline-flex;align-items:center;gap:.4rem;
  background:rgba(13,58,102,.55);border:1.5px solid #ffd54a;color:#ffd54a;font-size:.68rem;font-weight:900;letter-spacing:.04em;
  padding:.4rem .75rem;border-radius:999px;backdrop-filter:blur(6px);box-shadow:0 6px 16px rgba(0,0,0,.22)}
.psk-achv-rank i{color:#ffd54a}
.psk-achv-level{position:absolute;z-index:2;top:.8rem;right:.8rem;display:inline-flex;align-items:center;gap:.35rem;
  background:rgba(7,22,42,.62);color:#fff;font-size:.64rem;font-weight:800;letter-spacing:.05em;text-transform:uppercase;
  padding:.4rem .7rem;border-radius:999px;backdrop-filter:blur(6px)}
.psk-achv-level i{color:#ffd54a}
.psk-achv-body{display:flex;flex-direction:column;gap:.6rem;padding:1.2rem 1.3rem 1.4rem;flex:1}
.psk-achv-body h3{font-size:1.05rem;font-weight:800;color:#0d3a66;line-height:1.35;margin:0}
.psk-achv-body p{font-size:.85rem;line-height:1.65;color:#5a6f88;margin:0;
  display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.psk-achv-foot{display:flex;align-items:center;justify-content:space-between;gap:.6rem;margin-top:auto;padding-top:.4rem}
.psk-achv-tag{display:inline-flex;align-items:center;gap:.4rem;font-size:.72rem;font-weight:700;color:#0d3a66}
.psk-achv-tag i{color:#ffb300}
.psk-achv-year{font-size:.72rem;font-weight:800;color:#7a8ba1;background:#f4f7fb;padding:.3rem .6rem;border-radius:999px}
.psk-achv-link{display:inline-flex;align-items:center;gap:.4rem;font-size:.8rem;font-weight:800;color:#0d3a66}
.psk-achv-link i{font-size:.72rem;color:#ffb300;transition:transform .3s var(--ease,ease)}
.psk-achv-card:hover .psk-achv-link i{transform:translateX(4px)}
.psk-achv-more{display:flex;flex-direction:column;align-items:center;gap:.8rem;margin-top:2.4rem}
.psk-more-btn{display:inline-flex;align-items:center;gap:.6rem;font-size:.85rem;font-weight:800;color:#0d3a66;
  background:#fff;border:1px solid rgba(13,58,102,.16);padding:.85rem 1.5rem;border-radius:999px;cursor:pointer;
  box-shadow:0 10px 24px rgba(13,58,102,.08);transition:all .3s var(--ease,ease)}
.psk-more-btn:hover{border-color:#ffb300;transform:translateY(-2px)}
.psk-more-btn[hidden]{display:none}
.psk-achv-empty{font-size:.82rem;font-weight:700;color:#7a8ba1}
.psk-achv-empty[hidden]{display:none}
@media(max-width:900px){.psk-achv-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:600px){.psk-achv-grid{grid-template-columns:1fr}.psk-achv-filters{flex-wrap:nowrap;overflow-x:auto;padding-bottom:.3rem}}

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
.psk-moment-grid{display:grid;grid-template-columns:repeat(4,1fr);grid-auto-rows:180px;gap:1.2rem}
.psk-photo{position:relative;border-radius:20px;overflow:hidden;display:block;cursor:pointer;text-decoration:none;
  border:1px solid rgba(13,58,102,.08);background:#0d3a66;box-shadow:0 16px 36px rgba(13,58,102,.1);height:100%}
/* Susunan bento: satu foto besar, satu foto tinggi (portrait), dua foto kecil — supaya tidak gepeng/seragam */
.psk-photo.psk-mo-a{grid-column:1/3;grid-row:1/3}
.psk-photo.psk-mo-b{grid-column:3/4;grid-row:1/2}
.psk-photo.psk-mo-c{grid-column:4/5;grid-row:1/3}
.psk-photo.psk-mo-d{grid-column:3/4;grid-row:2/3}
@media(max-width:900px){
  .psk-moment-grid{grid-template-columns:repeat(2,1fr);grid-auto-rows:200px}
  .psk-photo.psk-mo-a{grid-column:1/3;grid-row:1/2}
  .psk-photo.psk-mo-b{grid-column:1/2;grid-row:2/3}
  .psk-photo.psk-mo-c{grid-column:2/3;grid-row:2/4}
  .psk-photo.psk-mo-d{grid-column:1/2;grid-row:3/4}
}
@media(max-width:640px){
  .psk-moment-grid{grid-template-columns:1fr;grid-auto-rows:auto}
  .psk-photo.psk-mo-a,.psk-photo.psk-mo-b,.psk-photo.psk-mo-c,.psk-photo.psk-mo-d{grid-column:1/2;grid-row:auto;aspect-ratio:16/9;height:auto}
}
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

/* ---------- 6. PERJALANAN PRESTASI (timeline tahun, bergeser otomatis) ---------- */
.psk-archive{background:#fff;position:relative}
.psk-archive-head{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,.9fr);gap:2rem;align-items:end;margin-bottom:1rem}
.psk-archive-head .psk-subtitle{margin-top:1rem}
.psk-archive-badge{justify-self:end;display:inline-flex;align-items:center;gap:.6rem;font-size:.74rem;font-weight:800;
  letter-spacing:.1em;text-transform:uppercase;color:#0d3a66;background:#f4f7fb;border:1px solid rgba(13,58,102,.14);
  padding:.65rem 1.1rem;border-radius:999px}
.psk-archive-badge i{color:#ffb300}
@keyframes pskMarquee{from{transform:translateX(0)}to{transform:translateX(-50%)}}

/* ---- strip tahun bergeser otomatis, berulang 2022→2026 ---- */
.psk-timeline-wrap{position:relative;overflow:hidden;margin-top:2.6rem;
  -webkit-mask-image:linear-gradient(90deg,transparent 0,#000 3%,#000 97%,transparent 100%);
  mask-image:linear-gradient(90deg,transparent 0,#000 3%,#000 97%,transparent 100%)}
.psk-timeline-track{display:flex;gap:2.2rem;width:max-content;padding:.6rem .2rem 1rem;
  animation:pskMarquee 55s linear infinite}
.psk-timeline-wrap:hover .psk-timeline-track{animation-play-state:paused}

.psk-tl-node{position:relative;flex:0 0 auto;width:clamp(250px,24vw,300px);display:flex;flex-direction:column;align-items:center;padding-top:.4rem}
.psk-tl-node::before{content:"";position:absolute;left:calc(-1.1rem - 1px);right:calc(-1.1rem - 1px);top:44px;
  height:2px;background:linear-gradient(90deg,#ffd54a,#ffb300);z-index:0}
.psk-tl-circle{position:relative;z-index:1;width:68px;height:68px;border-radius:50%;display:flex;flex-direction:column;
  align-items:center;justify-content:center;background:#0d3a66;border:3px solid #ffd54a;box-shadow:0 10px 26px rgba(13,58,102,.25)}
.psk-tl-circle span{font-family:var(--font-display);font-size:1.15rem;font-weight:900;color:#fff;line-height:1}
.psk-tl-circle em{font-style:normal;font-size:.55rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:#ffd54a;margin-top:.15rem}
.psk-tl-count{margin-top:.8rem;display:inline-flex;align-items:center;gap:.4rem;font-size:.72rem;font-weight:800;
  letter-spacing:.05em;text-transform:uppercase;color:#0d3a66;background:#fff8e6;border:1px solid rgba(255,179,0,.35);
  padding:.4rem .8rem;border-radius:999px}
.psk-tl-count i{color:#ffb300}
.psk-tl-list{margin-top:1.2rem;width:100%;display:flex;flex-direction:column;gap:.55rem;max-height:230px;overflow-y:auto;padding-right:.3rem}
.psk-tl-list::-webkit-scrollbar{width:5px}
.psk-tl-list::-webkit-scrollbar-thumb{background:rgba(13,58,102,.18);border-radius:99px}
.psk-tl-item{display:flex;align-items:flex-start;gap:.55rem;width:100%;text-align:left;background:#f4f7fb;
  border:1px solid rgba(13,58,102,.08);border-radius:12px;padding:.6rem .75rem;cursor:pointer;font-family:inherit;
  transition:all .25s var(--ease,ease)}
.psk-tl-item:hover{background:#fff;border-color:rgba(255,179,0,.5);transform:translateX(3px);box-shadow:0 8px 18px rgba(13,58,102,.1)}
.psk-tl-item i{color:#ffb300;font-size:.7rem;margin-top:.3rem;flex-shrink:0}
.psk-tl-item strong{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;
  font-size:.8rem;font-weight:800;color:#0d3a66;line-height:1.35}
.psk-tl-item small{display:block;font-size:.68rem;font-weight:700;color:#7a8ba1;margin-top:.25rem}
.psk-tl-empty{display:flex;align-items:center;gap:.5rem;font-size:.76rem;color:#7a8ba1;background:#f4f7fb;
  border:1px dashed rgba(13,58,102,.18);border-radius:12px;padding:.9rem .8rem;width:100%}
.psk-tl-empty i{color:#ffb300}
@media(max-width:640px){.psk-tl-node{width:78vw}}

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


/* ---------- ARTICLE MODAL ---------- */
.psk-article-modal{position:fixed;inset:0;z-index:10000;display:flex;align-items:center;justify-content:center;
  padding:1.2rem;background:rgba(4,14,28,.68);backdrop-filter:blur(8px);opacity:0;visibility:hidden;
  transition:opacity .3s ease,visibility .3s ease}
.psk-article-modal.open{opacity:1;visibility:visible}
.psk-article-dialog{position:relative;width:min(900px,94vw);max-height:min(82vh,820px);overflow:auto;
  background:#fff;border-radius:26px;border:1px solid rgba(13,58,102,.12);box-shadow:0 35px 100px rgba(4,14,28,.35);
  padding:clamp(1.5rem,4vw,2.8rem)}
.psk-article-close{position:sticky;float:right;top:0;width:42px;height:42px;border:0;border-radius:50%;
  background:#f1f5f9;color:#0d3a66;display:flex;align-items:center;justify-content:center;cursor:pointer;
  transition:all .25s ease;z-index:2}
.psk-article-close:hover{background:#ffb300;transform:rotate(90deg)}
.psk-article-date{display:inline-flex;align-items:center;gap:.45rem;color:#ffb300;font-size:.72rem;font-weight:900;
  letter-spacing:.12em;text-transform:uppercase;margin-bottom:.8rem}
.psk-article-dialog h3{font-family:var(--font-display);font-size:clamp(1.55rem,3vw,2.35rem);line-height:1.12;
  color:#0d3a66;margin:0 3rem 1.4rem 0}
.psk-article-body{font-size:.98rem;line-height:1.85;color:#44586f}
.psk-article-body p{margin:0 0 1rem}
.psk-article-body p:last-child{margin-bottom:0}
.psk-featured-read{display:inline-flex;align-items:center;gap:.55rem;margin-top:1.2rem;padding:.75rem 1.1rem;
  border:0;border-radius:999px;background:#0d3a66;color:#fff;font-weight:800;cursor:pointer}
.psk-featured-read i{color:#ffd54a}
.psk-featured-read:hover{background:#ffb300;color:#0d3a66}
.psk-moment-placeholder{height:100%;display:flex;align-items:center;justify-content:center;text-align:center;
  padding:2rem;background:linear-gradient(135deg,#eef3f8,#dfe7ef);color:#7a8ba1}
.psk-moment-placeholder div{max-width:280px}
.psk-moment-placeholder i{font-size:2rem;color:#ffb300;margin-bottom:.6rem}
.psk-moment-placeholder strong{display:block;color:#0d3a66;font-size:.95rem}
.psk-moment-placeholder span{display:block;font-size:.72rem;margin-top:.25rem;line-height:1.5}

/* ---------- RESPONSIVE ---------- */
@media (max-width:1080px){
  .psk-cta-box{grid-template-columns:1fr;gap:1.5rem}
  .psk-cta-btn{justify-self:start}
}
@media (max-width:860px){
  .psk-opening .psk-section,.psk-featured .psk-section{grid-template-columns:1fr;gap:2.5rem}
  .psk-cabinet{min-height:420px}
  .psk-gallery-tools{flex-direction:column;align-items:flex-start}
  .psk-slider-arrows{align-self:flex-end}
  .psk-archive-head{grid-template-columns:1fr;gap:1rem}
  .psk-archive-badge{justify-self:start}
}
@media (max-width:640px){
  .psk-opening-meta{grid-template-columns:1fr 1fr}
  .psk-feat-meta{flex-direction:column;align-items:flex-start}
  .psk-cta-box h3{font-size:clamp(1.5rem,7vw,2rem)}
}
@media (prefers-reduced-motion:reduce){
  .psk-timeline-track{animation:none}
  .psk-timeline-wrap{overflow-x:auto}
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
        <p class="psk-lead">Arsip prestasi siswa, guru, dan alumni SMK Negeri 2 Mojokerto yang terdokumentasi dalam berbagai ajang dari tingkat kota hingga capaian internasional.</p>
        <div class="psk-hero-meta">
          <span class="psk-pill"><i class="fas fa-award"></i> Arsip Resmi Sekolah</span>
          <span class="psk-pill"><i class="fas fa-map-marked-alt"></i> Kota → Internasional</span>
          <span class="psk-pill"><i class="fas fa-calendar-alt"></i> 2022 — 2026</span>
        </div>
      </div>
    </div>
  </section>

  @php
    /* =========================================================
       SUMBER DATA TUNGGAL PRESTASI
       Dipakai bersama oleh section "Pencapaian Prestasi" (kartu
       artikel + filter tingkat) dan section "Perjalanan Prestasi"
       (timeline per tahun), serta modal artikel di bagian bawah.
       Tambah/edit prestasi cukup di array ini saja.
       level      : bucket filter -> kota | provinsi | nasional | internasional
       levelLabel : label tampilan yang lebih spesifik
       rank       : label singkat untuk badge di kartu (mis. "Juara 1")
       image      : nama file JPG di /public/images/prestasi/ (upload manual,
                    nama file bebas asal cocok dengan yang ditulis di sini)
       ========================================================= */
    $prestasi = [
      ['id'=>'a1','date'=>'01 September 2022','year'=>2022,'level'=>'kota','levelLabel'=>'Kota Mojokerto','tag'=>'Perbankan Syariah','rank'=>'Duta Koperasi','title'=>'Siswi Perbankan Syariah Dinobatkan sebagai Duta Koperasi Bertalenta 2022','desc'=>'Cantika Putri Hapsari, siswi Perbankan Syariah SMKN 2 Mojokerto, berhasil meraih kategori Duta Koperasi Bertalenta Kota Mojokerto 2022. Prestasi ini menjadi bukti kemampuan dan kepeduliannya dalam mengembangkan literasi perkoperasian di kalangan generasi muda.','image'=>'a1.jpg'],
      ['id'=>'a2','date'=>'11 September 2022','year'=>2022,'level'=>'kota','levelLabel'=>'Kota Mojokerto & Jombang','tag'=>'Umum','rank'=>'Duta GenRe','title'=>'Siswa SMKN 2 Mojokerto Raih Prestasi di Ajang Duta GenRe 2022','desc'=>'Siswa SMKN 2 Mojokerto berhasil menorehkan prestasi dalam ajang Duta GenRe 2022. Riska Kurniaila meraih Duta GenRe Sosial Media Inspiratif Kabupaten Jombang, sementara Muhammad Zulkifli dan Siti Nur Kholifah menjadi finalis Duta GenRe Kota Mojokerto.','image'=>'a2.jpg'],
      ['id'=>'a3','date'=>'27 Juli 2024','year'=>2024,'level'=>'kota','levelLabel'=>'Kota Mojokerto','tag'=>'Perbankan Syariah','rank'=>'Juara 3','title'=>'Skaneda Raih Juara 3 Lomba Cerdas Cermat DISKOPUKMPERINDAG','desc'=>'Tim Layanan Perbankan Syariah SMKN 2 Mojokerto berhasil meraih Juara 3 Lomba Cerdas Cermat Tingkat SMA/SMK/MA se-Kota Mojokerto. Prestasi ini diraih berkat ketekunan, disiplin waktu, literasi yang luas, serta bimbingan dari para guru.','image'=>'a3.jpg'],
      ['id'=>'a4','date'=>'03 Agustus 2024','year'=>2024,'level'=>'kota','levelLabel'=>'Kota Mojokerto','tag'=>'Umum','rank'=>'Juara Favorit','title'=>'Skaneda Raih Juara Favorit Duta Koperasi 2024','desc'=>'Naura Rahma Putri berhasil meraih Juara Favorit Duta Koperasi Kota Mojokerto 2024, sementara Zidana Khoiron dan Lahriria Amanah Muarta menjadi finalis. Prestasi ini didukung kekompakan tim, sosialisasi koperasi, serta dukungan warga sekolah.','image'=>'a4.jpg'],
      ['id'=>'a5','date'=>'14 Agustus 2024','year'=>2024,'level'=>'nasional','levelLabel'=>'Nasional','tag'=>'Paskibraka','rank'=>'Multi Juara','title'=>'Skaneda Sapu Bersih Juara Lomba Paskibraka Tingkat Nasional 2024','desc'=>'Tim Paskibraka SMKN 2 Mojokerto berhasil meraih berbagai penghargaan dalam lomba LKBB Mahapatih Se-Nasional. Prestasi yang diraih meliputi juara variasi, formasi, pasukan, kostum, make-up, serta beberapa kategori lainnya.','image'=>'a5.jpg'],
      ['id'=>'a7','date'=>'18 Agustus 2024','year'=>2024,'level'=>'nasional','levelLabel'=>'Nasional','tag'=>'Program','rank'=>'Program Terpilih','title'=>'Skaneda Terpilih dalam Program Korea E-Learning Improvement Cooperation (KLIC)','desc'=>'SMKN 2 Mojokerto menjadi salah satu sekolah terpilih dalam program Korea E-Learning Improvement Cooperation (KLIC). Melalui program ini, guru mendapatkan pelatihan teknologi pembelajaran, termasuk Artificial Intelligence dan Robotic Programming dari para pengajar Korea.','image'=>'a7.jpg'],
      ['id'=>'a8','date'=>'23 Agustus 2024','year'=>2024,'level'=>'nasional','levelLabel'=>'Nasional','tag'=>'Kuliner','rank'=>'Juara 2','title'=>'Tim Kuliner Skaneda Raih Medali Perak LKS Nasional','desc'=>'Ahmed Husein Jalili dan Mohammad Dzakaa Irawan berhasil meraih Medali Perak atau Juara 2 Nasional dalam LKS XXXII bidang Patisserie and Confectionery di Lampung. Prestasi ini merupakan hasil latihan intensif selama hampir 10 bulan dan dukungan dari para pembimbing.','image'=>'a8.jpg'],
      ['id'=>'a9','date'=>'21 September 2024','year'=>2024,'level'=>'provinsi','levelLabel'=>'Jawa Timur','tag'=>'Umum','rank'=>'Juara Favorit','title'=>'Skaneda Raih Juara Favorit Lomba Koperasi Tingkat Jawa Timur','desc'=>'Tim Layanan Perbankan Syariah SMKN 2 Mojokerto berhasil meraih Juara Favorit Lomba Koperasi Tingkat Jawa Timur 2024. Prestasi ini diraih melalui kekompakan tim, kreativitas, inovasi produk, serta kolaborasi Kopsis Dewantara dengan berbagai jurusan.','image'=>'a9.jpg'],
      ['id'=>'a10','date'=>'21 September 2024','year'=>2024,'level'=>'nasional','levelLabel'=>'Nasional','tag'=>'RPL & DKV','rank'=>'6 & 10 Besar','title'=>'Dua Tim RPL dan DKV Lolos 6 dan 10 Besar Nasional FIKSI','desc'=>'Dua tim SMKN 2 Mojokerto berhasil lolos dalam FIKSI Tingkat Nasional 2024. Tim Saqran Cakra menempati 6 besar melalui inovasi desain kaos Majapahit, sedangkan Tim Skaneda Mojokerto masuk 10 besar melalui produk Tambal Express.','image'=>'a10.jpg'],
      ['id'=>'a11','date'=>'16 Oktober 2024','year'=>2024,'level'=>'kota','levelLabel'=>'Mojokerto Raya','tag'=>'Olahraga','rank'=>'Juara 1','title'=>'Tim Futsal Skaneda Raih Juara 1 Tingkat Mojokerto Raya','desc'=>'Tim Futsal SMKN 2 Mojokerto berhasil menjadi Juara 1 Pertandingan Futsal Pelajar Tingkat SMA/SMK se-Mojokerto Raya. Kemenangan ini diraih melalui permainan kompak dan strategi yang diterapkan bersama pelatih serta dukungan keluarga besar Skaneda.','image'=>'a11.jpg'],
      ['id'=>'a12','date'=>'16 Oktober 2024','year'=>2024,'level'=>'kota','levelLabel'=>'Mojokerto Raya','tag'=>'Umum','rank'=>'Juara 2','title'=>'PMR Skaneda Raih Juara 2 Lomba Poster dan Video Kreatif','desc'=>'Tim PMR SMKN 2 Mojokerto berhasil meraih Juara 2 Lomba Video Kreatif dan Poster dalam rangka HUT ke-79 PMI. Prestasi ini menjadi hasil dari kreativitas, disiplin, latihan, serta bimbingan pembina PMR Skaneda.','image'=>'a12.jpg'],
      ['id'=>'a13','date'=>'19 Oktober 2024','year'=>2024,'level'=>'nasional','levelLabel'=>'Nasional','tag'=>'RPL','rank'=>'10 Besar','title'=>'Tim Maja Force RPL Lolos 10 Besar MEA Tingkat Nasional','desc'=>'Tim Maja Force dari RPL SMKN 2 Mojokerto berhasil masuk 10 besar Madani Entrepreneur Academy (MEA) Tingkat Nasional. Tim mengembangkan inovasi minuman berbahan buah maja dan mempersiapkan produk melalui berbagai tahapan seleksi serta pembinaan.','image'=>'a13.jpg'],
      ['id'=>'a14','date'=>'03 Maret 2025','year'=>2025,'level'=>'kota','levelLabel'=>'Kota Mojokerto','tag'=>'Akuntansi','rank'=>'Juara 1','title'=>'Skaneda Raih Juara 1 LKS DIKMEN Bidang Akuntansi','desc'=>'Putra Ananda Rifky Noviansyah Hardianto berhasil meraih Juara 1 LKS DIKMEN Bidang Akuntansi Tingkat Kabupaten/Kota Mojokerto. Prestasi ini diraih melalui latihan intensif, tryout, evaluasi, serta pendalaman materi akuntansi dan pajak.','image'=>'a14.jpg'],
      ['id'=>'a15','date'=>'25 Desember 2025','year'=>2025,'level'=>'provinsi','levelLabel'=>'Jawa Timur','tag'=>'Lingkungan','rank'=>'Penghargaan','title'=>'SMKN 2 Mojokerto Raih Penghargaan Sekolah Adiwiyata Provinsi','desc'=>'SMKN 2 Mojokerto berhasil meraih penghargaan sebagai Sekolah Adiwiyata Provinsi Jawa Timur setelah sebelumnya masuk dalam Top 20 dari 238 sekolah calon Adiwiyata. Capaian ini menjadi bukti komitmen sekolah dalam membangun lingkungan pendidikan yang berkelanjutan.','image'=>'a15.jpg'],
      ['id'=>'a16','date'=>'26 Desember 2025','year'=>2025,'level'=>'provinsi','levelLabel'=>'Jawa Timur','tag'=>'RPL','rank'=>'Juara 2 & 3','title'=>'Talenta Muda Skaneda Bersinar, Dua Tim Raih Juara FESTIKA Jatim 2025','desc'=>'Dua tim SMKN 2 Mojokerto, Outsider dan Jayashima, berhasil meraih Juara 2 dan Juara 3 dalam FESTIKA Jawa Timur 2025 kategori AREK-AI Aplikasi Python. Prestasi ini menunjukkan kemampuan siswa dalam mengembangkan teknologi dan berinovasi di era digital.','image'=>'a16.jpg'],
      ['id'=>'a17','date'=>'04 Juli 2026','year'=>2026,'level'=>'kota','levelLabel'=>'Kota Mojokerto','tag'=>'Olahraga','rank'=>'Juara 2','title'=>'Skaneda Raih Juara 2 Tolak Peluru pada POPKOTA Mojokerto 2026','desc'=>'Dawwas, siswa SMKN 2 Mojokerto, berhasil meraih Juara 2 Tolak Peluru Putra dalam Pekan Olahraga Pelajar Kota Mojokerto 2026. Prestasi ini menjadi bukti semangat, disiplin, dan sportivitas siswa Skaneda dalam bidang olahraga.','image'=>'a17.jpg'],
      ['id'=>'a18','date'=>'26 Mei 2026','year'=>2026,'level'=>'kota','levelLabel'=>'Kota Mojokerto','tag'=>'Seni','rank'=>'Juara 2 & 3','title'=>'Skaneda Raih Prestasi pada FLS3N Kota Mojokerto 2026','desc'=>'SMKN 2 Mojokerto berhasil menorehkan prestasi dalam FLS3N Kota Mojokerto 2026. Gracia meraih Juara 2 Solo Putri, sedangkan Fauziyah meraih Juara 3 Komik Digital, bersama peserta lainnya yang turut memberikan penampilan terbaik.','image'=>'a18.jpg'],
      ['id'=>'a19','date'=>'10 Mei 2026','year'=>2026,'level'=>'kota','levelLabel'=>'Kota Mojokerto','tag'=>'Olahraga','rank'=>'Juara 3','title'=>'Skaneda Raih Medali Perunggu Cabang Dayung','desc'=>'Ayu Pinky berhasil meraih Medali Perunggu Cabang Olahraga Dayung pada Pekan Olahraga Pelajar Kota Mojokerto 2026. Prestasi ini menjadi bukti kerja keras, kedisiplinan, dan semangat pantang menyerah dalam mencapai prestasi olahraga.','image'=>'a19.jpg'],
      ['id'=>'a20','date'=>'21 April 2026','year'=>2026,'level'=>'kota','levelLabel'=>'Internal Sekolah','tag'=>'Inspirasi','rank'=>'Inspiratif','title'=>'Inspiratif! Kak Carla, Bukti Semangat Skaneda Menuju Prestasi','desc'=>'Perjalanan inspiratif Kak Carla menjadi gambaran bahwa kerja keras, konsistensi, dan semangat belajar dapat membuka berbagai kesempatan. Kisah tersebut diharapkan mampu memotivasi siswa Skaneda untuk berani mengembangkan potensi dan meraih cita-cita.','image'=>'a20.jpg'],
      ['id'=>'a21','date'=>'13 April 2026','year'=>2026,'level'=>'provinsi','levelLabel'=>'Jawa Timur','tag'=>'DKV & Kuliner','rank'=>'Juara 3','title'=>'Skaneda Raih Juara 3 pada Dua Bidang LKS Jawa Timur 2026','desc'=>'SMKN 2 Mojokerto berhasil meraih Juara 3 Graphic Design Technology dan Juara 3 Patisserie and Confectionery dalam LKS Jawa Timur 2026. Prestasi ini menjadi hasil dari kerja keras, dedikasi, latihan, serta dukungan para pembimbing.','image'=>'a21.jpg'],
      ['id'=>'a22','date'=>'05 Mei 2026','year'=>2026,'level'=>'kota','levelLabel'=>'Kota Mojokerto','tag'=>'Umum','rank'=>'Partisipasi','title'=>'Skaneda Raih Prestasi pada Ajang Duta GenRe Kota Mojokerto 2026','desc'=>'SMKN 2 Mojokerto kembali berpartisipasi dalam Duta GenRe Kota Mojokerto 2026. Keikutsertaan ini menjadi bukti komitmen sekolah dalam membentuk generasi muda yang sehat, berkarakter, memiliki kepedulian sosial, serta mampu menjadi teladan bagi lingkungan.','image'=>'a22.jpg'],
      ['id'=>'a23','date'=>'29 Juli 2026','year'=>2026,'level'=>'internasional','levelLabel'=>'Internasional','tag'=>'Beasiswa','rank'=>'Beasiswa','title'=>'Alumni Skaneda Raih Beasiswa di Huaqiao University, China','desc'=>'Kameela Masyayu Ananda Apsari, alumni SMKN 2 Mojokerto, berhasil memperoleh Beasiswa Keguruan Bahasa Tionghoa dari LKPBT Jatim di Huaqiao University, China. Pencapaian ini menjadi bukti bahwa lulusan Skaneda mampu melanjutkan pendidikan dan meraih kesempatan hingga tingkat internasional.','image'=>'a23.jpg'],
      ['id'=>'a24','date'=>'17 Agustus 2026','year'=>2026,'level'=>'kota','levelLabel'=>'Kabupaten Mojokerto','tag'=>'Olahraga','rank'=>'Juara 1','title'=>'Dhiva Alennia Raih Juara 1 Pencak Silat KONI Championship','desc'=>'Dhiva Alennia berhasil meraih Juara 1 Pencak Silat KONI Championship yang diselenggarakan di GOR Dinas Pendidikan Kabupaten Mojokerto. Prestasi ini menjadi bukti kerja keras, keberanian, disiplin, dan semangat pantang menyerah dalam meraih podium.','image'=>'a24.jpg'],
      ['id'=>'a25','date'=>'29 November 2024','year'=>2024,'level'=>'provinsi','levelLabel'=>'Malang (Regional)','tag'=>'RPL','rank'=>'Juara 1','title'=>'Tim Penerbang Roket Raih Juara 1 Web Development di Polinema','desc'=>'Tim Penerbang Roket SMKN 2 Mojokerto berhasil meraih Juara 1 Lomba Web Development yang diselenggarakan di Politeknik Negeri Malang. Prestasi ini menunjukkan kreativitas, kemampuan teknologi, kerja sama, serta semangat belajar siswa dalam bidang pengembangan web.','image'=>'a25.jpg'],
      ['id'=>'a26','date'=>'18 Oktober 2025','year'=>2025,'level'=>'nasional','levelLabel'=>'Nasional','tag'=>'APHP','rank'=>'Finalis','title'=>'Tim APHP Skaneda Melaju ke Babak Final FIKSI 2025','desc'=>'Tim APHP (Agribisnis Pengolahan Hasil Pertanian) SMKN 2 Mojokerto kembali menorehkan prestasi dengan berhasil lolos sebagai finalis dalam ajang Festival Inovasi dan Kewirausahaan Siswa Indonesia (FIKSI) 2025. Pencapaian ini menjadi bukti atas kreativitas, inovasi, dan kerja keras tim APHP Skaneda dalam mengembangkan ide kewirausahaan di bidang pengolahan hasil pertanian. Keberhasilan melaju ke tahap final menjadi kesempatan bagi Tim APHP Skaneda untuk terus menunjukkan potensi dan membawa nama SMKN 2 Mojokerto pada ajang bergengsi tersebut.','image'=>'a26.jpg'],
    ];
    $prestasiByYear = collect($prestasi)->groupBy('year');
    // Hanya tahun yang benar-benar punya data prestasi yang ditampilkan di
    // timeline "Perjalanan Prestasi" — tahun kosong (mis. 2023) otomatis
    // dilewati tanpa perlu diedit manual kalau data prestasi berubah.
    $timelineYears = $prestasiByYear->keys()->sort()->values()->all();
    // Aktifkan filter Internasional otomatis kalau ada datanya
    $hasInternasional = collect($prestasi)->contains('level', 'internasional');

    // Data siap-pakai untuk modal artikel di JS. Dibuat dengan foreach biasa
    // (bukan closure/fluent chain) supaya aman dipakai langsung di dalam
    // @json(...) satu baris — closure multi-baris di dalam @json() bisa
    // membuat parser Blade salah hitung tanda kurung/bracket.
    $articleDataJs = [];
    foreach ($prestasi as $p) {
        $articleDataJs[] = [
            'id' => $p['id'],
            'date' => $p['date'],
            'title' => $p['title'],
            'level' => $p['levelLabel'],
            'body' => [$p['desc']],
        ];
    }
  @endphp

  <!-- ================= 1. PEMBUKA: JEJAK PRESTASI SKANEDA ================= -->
  <section class="psk-opening">
    <div class="psk-section">
      <div data-reveal="left">
        <span class="psk-eyebrow">Institutional Achievement</span>
        <h2 class="psk-section-title">Jejak Prestasi<br><span class="psk-gold">Skaneda</span></h2>
        <p class="psk-opening-desc">Kumpulan artikel prestasi <strong>SMK Negeri 2 Mojokerto</strong> yang dihimpun dari dokumen prestasi siswa, guru, dan alumni. Setiap artikel memuat pencapaian sesuai informasi dan tingkat yang tercantum pada sumber.</p>
        <!-- Angka di bawah dihitung otomatis dari array $prestasi (didefinisikan
             sebelum section "Pencapaian Prestasi"). Tambah data di sana, angka
             ini menyesuaikan sendiri. -->
        <div class="psk-opening-meta">
          <div class="psk-om"><b><em data-count="{{ count($prestasi ?? []) ?: 25 }}">0</em></b><span>Artikel Prestasi</span></div>
          <div class="psk-om"><b>Internasional</b><span>Jangkauan Terluas di Data</span></div>
          <div class="psk-om"><b>{{ $prestasiByYear->count() }}</b><span>Tahun Tercatat</span></div>
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
            <p>Piala, medali, penghargaan, dan pencapaian dari berbagai ajang menjadi bukti nyata perjalanan prestasi Skaneda.</p>
            <div class="psk-cabinet-foot">
              <span><i class="fas fa-calendar-alt"></i> 2022 — 2026</span>
              <span><i class="fas fa-medal"></i> {{ count($prestasi) }} Artikel Prestasi</span>
              <span><i class="fas fa-flag"></i> Kota · Provinsi · Nasional · Internasional</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= 2. FEATURED ACHIEVEMENT ================= -->
  <section class="psk-featured">
    <div class="psk-section">
      <div class="psk-feat-photo" data-reveal="left">
        <div class="psk-moment-placeholder">
          <div><i class="fas fa-image"></i><strong>Foto dokumentasi akan ditambahkan</strong><span>Biarkan kosong terlebih dahulu dan tambahkan foto asli FESTIKA Jatim 2025 nanti.</span></div>
        </div>
        <img src="{{ asset('images/prestasi/festika.jpeg') }}" alt="Tim Outsider dan Jayashima juara FESTIKA Jatim 2025" loading="eager" onerror="this.remove()">
        <span class="psk-feat-badge"><i class="fas fa-crown"></i> Featured Achievement</span>
        <span class="psk-feat-year">2025<small>Tahun Capaian</small></span>
      </div>
      <div class="psk-feat-info" data-reveal="right">
        <span class="psk-eyebrow">Capaian Utama Institusi</span>
        <span class="psk-feat-rank"><i class="fas fa-trophy"></i> Juara 2 &amp; Juara 3 — FESTIKA Jatim</span>
        <h3>Talenta Muda Skaneda Bersinar, Dua Tim Raih Juara FESTIKA Jatim 2025</h3>
        <p class="psk-feat-desc">Dua tim dari SMKN 2 Mojokerto sukses memboyong gelar juara di ajang Festival Teknologi Informasi dan Komunikasi (FESTIKA) Jawa Timur 2025. Outsider meraih peringkat kedua dan Jayashima peringkat ketiga pada nominasi AREK-AI Aplikasi Phyton.</p>
        <div class="psk-feat-meta">
          <span><i class="fas fa-map-marked-alt"></i> Provinsi</span>
          <span><i class="fas fa-code"></i> AREK-AI Aplikasi Phyton</span>
          <span><i class="fas fa-calendar-alt"></i> 2025</span>
          <span><i class="fas fa-medal"></i> Juara 2 &amp; 3</span>
        </div>
        <button type="button" class="psk-featured-read" data-article-id="a16"><i class="fas fa-book-open"></i> Baca selengkapnya</button>
      </div>
    </div>
  </section>

  <!-- ================= 3. PENCAPAIAN PRESTASI (artikel + filter tingkat) ================= -->
  <section class="psk-achv" id="pencapaian-prestasi">
    <div class="psk-section">
      <div data-reveal>
        <span class="psk-eyebrow">Dokumentasi Resmi</span>
        <h2 class="psk-section-title">Pencapaian <span class="psk-gold">Prestasi</span></h2>
        <p class="psk-subtitle">Kumpulan berita pencapaian siswa, guru, dan alumni Skaneda — lengkap dengan foto, judul, dan isi artikelnya, dari tingkat kota hingga internasional.</p>
      </div>

      <div class="psk-achv-filters" data-reveal>
        <button type="button" class="psk-fbtn active" data-filter="all"><i class="fas fa-border-all"></i> Semua</button>
        <button type="button" class="psk-fbtn" data-filter="kota"><i class="fas fa-building"></i> Kota/Kabupaten</button>
        <button type="button" class="psk-fbtn" data-filter="provinsi"><i class="fas fa-map-marked-alt"></i> Provinsi</button>
        <button type="button" class="psk-fbtn" data-filter="nasional"><i class="fas fa-globe-asia"></i> Nasional</button>
        @if ($hasInternasional)
          <button type="button" class="psk-fbtn" data-filter="internasional"><i class="fas fa-globe"></i> Internasional</button>
        @endif
      </div>

      <!-- Simpan foto di public/images/prestasi/ -->
      <div class="psk-achv-grid" id="pskAchvGrid" data-reveal>
        <article class="psk-achv-card" data-level="kota" data-article-id="a24">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/pencaksilat.jpeg') }}" alt="Dhiva Alennia Raih Juara 1 Pencak Silat KONI Championship" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Juara 1</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Kabupaten Mojokerto</span>
          </div>
          <div class="psk-achv-body">
            <h3>Dhiva Alennia Raih Juara 1 Pencak Silat KONI Championship</h3>
            <p>Dhiva Alennia berhasil meraih Juara 1 Pencak Silat KONI Championship yang diselenggarakan di GOR Dinas Pendidikan Kabupaten Mojokerto. Prestasi ini menjadi bukti kerja keras, keberanian, disiplin, dan semangat pantang menyerah dalam meraih podium.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Olahraga</span>
              <span class="psk-achv-year">2026</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="internasional" data-article-id="a23">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/china.jpeg') }}" alt="Alumni Skaneda Raih Beasiswa di Huaqiao University, China" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Beasiswa</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Internasional</span>
          </div>
          <div class="psk-achv-body">
            <h3>Alumni Skaneda Raih Beasiswa di Huaqiao University, China</h3>
            <p>Kameela Masyayu Ananda Apsari, alumni SMKN 2 Mojokerto, berhasil memperoleh Beasiswa Keguruan Bahasa Tionghoa dari LKPBT Jatim di Huaqiao University, China. Pencapaian ini menjadi bukti bahwa lulusan Skaneda mampu melanjutkan pendidikan dan meraih kesempatan hingga tingkat internasional.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Beasiswa</span>
              <span class="psk-achv-year">2026</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="kota" data-article-id="a17">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/tolakpeluru.jpeg') }}" alt="Skaneda Raih Juara 2 Tolak Peluru pada POPKOTA Mojokerto 2026" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Juara 2</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Kota Mojokerto</span>
          </div>
          <div class="psk-achv-body">
            <h3>Skaneda Raih Juara 2 Tolak Peluru pada POPKOTA Mojokerto 2026</h3>
            <p>Dawwas, siswa SMKN 2 Mojokerto, berhasil meraih Juara 2 Tolak Peluru Putra dalam Pekan Olahraga Pelajar Kota Mojokerto 2026. Prestasi ini menjadi bukti semangat, disiplin, dan sportivitas siswa Skaneda dalam bidang olahraga.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Olahraga</span>
              <span class="psk-achv-year">2026</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="kota" data-article-id="a18">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/fls3n.jpeg') }}" alt="Skaneda Raih Prestasi pada FLS3N Kota Mojokerto 2026" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Juara 2 &amp; 3</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Kota Mojokerto</span>
          </div>
          <div class="psk-achv-body">
            <h3>Skaneda Raih Prestasi pada FLS3N Kota Mojokerto 2026</h3>
            <p>SMKN 2 Mojokerto berhasil menorehkan prestasi dalam FLS3N Kota Mojokerto 2026. Gracia meraih Juara 2 Solo Putri, sedangkan Fauziyah meraih Juara 3 Komik Digital, bersama peserta lainnya yang turut memberikan penampilan terbaik.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Seni</span>
              <span class="psk-achv-year">2026</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="kota" data-article-id="a19">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/dayung.jpeg') }}" alt="Skaneda Raih Medali Perunggu Cabang Dayung" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Juara 3</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Kota Mojokerto</span>
          </div>
          <div class="psk-achv-body">
            <h3>Skaneda Raih Medali Perunggu Cabang Dayung</h3>
            <p>Ayu Pinky berhasil meraih Medali Perunggu Cabang Olahraga Dayung pada Pekan Olahraga Pelajar Kota Mojokerto 2026. Prestasi ini menjadi bukti kerja keras, kedisiplinan, dan semangat pantang menyerah dalam mencapai prestasi olahraga.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Olahraga</span>
              <span class="psk-achv-year">2026</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="kota" data-article-id="a22">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/dugen26.jpeg') }}" alt="Skaneda Raih Prestasi pada Ajang Duta GenRe Kota Mojokerto 2026" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Partisipasi</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Kota Mojokerto</span>
          </div>
          <div class="psk-achv-body">
            <h3>Skaneda Raih Prestasi pada Ajang Duta GenRe Kota Mojokerto 2026</h3>
            <p>SMKN 2 Mojokerto kembali berpartisipasi dalam Duta GenRe Kota Mojokerto 2026. Keikutsertaan ini menjadi bukti komitmen sekolah dalam membentuk generasi muda yang sehat, berkarakter, memiliki kepedulian sosial, serta mampu menjadi teladan bagi lingkungan.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Umum</span>
              <span class="psk-achv-year">2026</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="kota" data-article-id="a20">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/carla.jpeg') }}" alt="Inspiratif! Kak Carla, Bukti Semangat Skaneda Menuju Prestasi" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Inspiratif</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Internal Sekolah</span>
          </div>
          <div class="psk-achv-body">
            <h3>Inspiratif! Kak Carla, Bukti Semangat Skaneda Menuju Prestasi</h3>
            <p>Perjalanan inspiratif Kak Carla menjadi gambaran bahwa kerja keras, konsistensi, dan semangat belajar dapat membuka berbagai kesempatan. Kisah tersebut diharapkan mampu memotivasi siswa Skaneda untuk berani mengembangkan potensi dan meraih cita-cita.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Inspirasi</span>
              <span class="psk-achv-year">2026</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="provinsi" data-article-id="a21">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/lks26.jpg') }}" alt="Skaneda Raih Juara 3 pada Dua Bidang LKS Jawa Timur 2026" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Juara 3</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Jawa Timur</span>
          </div>
          <div class="psk-achv-body">
            <h3>Skaneda Raih Juara 3 pada Dua Bidang LKS Jawa Timur 2026</h3>
            <p>SMKN 2 Mojokerto berhasil meraih Juara 3 Graphic Design Technology dan Juara 3 Patisserie and Confectionery dalam LKS Jawa Timur 2026. Prestasi ini menjadi hasil dari kerja keras, dedikasi, latihan, serta dukungan para pembimbing.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> DKV &amp; Kuliner</span>
              <span class="psk-achv-year">2026</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="provinsi" data-article-id="a16">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/festika.jpeg') }}" alt="Talenta Muda Skaneda Bersinar, Dua Tim Raih Juara FESTIKA Jatim 2025" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Juara 2 &amp; 3</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Jawa Timur</span>
          </div>
          <div class="psk-achv-body">
            <h3>Talenta Muda Skaneda Bersinar, Dua Tim Raih Juara FESTIKA Jatim 2025</h3>
            <p>Dua tim SMKN 2 Mojokerto, Outsider dan Jayashima, berhasil meraih Juara 2 dan Juara 3 dalam FESTIKA Jawa Timur 2025 kategori AREK-AI Aplikasi Python. Prestasi ini menunjukkan kemampuan siswa dalam mengembangkan teknologi dan berinovasi di era digital.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> RPL</span>
              <span class="psk-achv-year">2025</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="provinsi" data-article-id="a15">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/adiwiyata.jpeg') }}" alt="SMKN 2 Mojokerto Raih Penghargaan Sekolah Adiwiyata Provinsi" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Penghargaan</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Jawa Timur</span>
          </div>
          <div class="psk-achv-body">
            <h3>SMKN 2 Mojokerto Raih Penghargaan Sekolah Adiwiyata Provinsi</h3>
            <p>SMKN 2 Mojokerto berhasil meraih penghargaan sebagai Sekolah Adiwiyata Provinsi Jawa Timur setelah sebelumnya masuk dalam Top 20 dari 238 sekolah calon Adiwiyata. Capaian ini menjadi bukti komitmen sekolah dalam membangun lingkungan pendidikan yang berkelanjutan.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Lingkungan</span>
              <span class="psk-achv-year">2025</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="nasional" data-article-id="a26">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/fiksi25.jpg') }}" alt="Tim APHP Skaneda Melaju ke Babak Final FIKSI 2025" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Finalis </span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Nasional</span>
          </div>
          <div class="psk-achv-body">
            <h3>Tim APHP Skaneda Melaju ke Babak Final FIKSI 2025</h3>
            <p>Tim APHP (Agribisnis Pengolahan Hasil Pertanian) SMKN 2 Mojokerto kembali menorehkan prestasi dengan berhasil lolos sebagai finalis dalam ajang Festival Inovasi dan Kewirausahaan Siswa Indonesia (FIKSI) 2025. Pencapaian ini menjadi bukti atas kreativitas, inovasi, dan kerja keras tim APHP Skaneda dalam mengembangkan ide kewirausahaan di bidang pengolahan hasil pertanian. Keberhasilan melaju ke tahap final menjadi kesempatan bagi Tim APHP Skaneda untuk terus menunjukkan potensi dan membawa nama SMKN 2 Mojokerto pada ajang bergengsi tersebut.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> APHP</span>
              <span class="psk-achv-year">2025</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="kota" data-article-id="a14">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/lksakuntansi.jpg') }}" alt="Skaneda Raih Juara 1 LKS DIKMEN Bidang Akuntansi" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Juara 1</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Kota Mojokerto</span>
          </div>
          <div class="psk-achv-body">
            <h3>Skaneda Raih Juara 1 LKS DIKMEN Bidang Akuntansi</h3>
            <p>Putra Ananda Rifky Noviansyah Hardianto berhasil meraih Juara 1 LKS DIKMEN Bidang Akuntansi Tingkat Kabupaten/Kota Mojokerto. Prestasi ini diraih melalui latihan intensif, tryout, evaluasi, serta pendalaman materi akuntansi dan pajak.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Akuntansi</span>
              <span class="psk-achv-year">2025</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="provinsi" data-article-id="a25">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/goldentiket.jpeg') }}" alt="Tim Penerbang Roket Raih Juara 1 Web Development di Polinema" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Juara 1</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Malang (Regional)</span>
          </div>
          <div class="psk-achv-body">
            <h3>Tim Penerbang Roket Raih Juara 1 Web Development di Polinema</h3>
            <p>Tim Penerbang Roket SMKN 2 Mojokerto berhasil meraih Juara 1 Lomba Web Development yang diselenggarakan di Politeknik Negeri Malang. Prestasi ini menunjukkan kreativitas, kemampuan teknologi, kerja sama, serta semangat belajar siswa dalam bidang pengembangan web.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> RPL</span>
              <span class="psk-achv-year">2024</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="nasional" data-article-id="a13">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/mea.jpg') }}" alt="Tim Maja Force RPL Lolos 10 Besar MEA Tingkat Nasional" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> 10 Besar</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Nasional</span>
          </div>
          <div class="psk-achv-body">
            <h3>Tim Maja Force RPL Lolos 10 Besar MEA Tingkat Nasional</h3>
            <p>Tim Maja Force dari RPL SMKN 2 Mojokerto berhasil masuk 10 besar Madani Entrepreneur Academy (MEA) Tingkat Nasional. Tim mengembangkan inovasi minuman berbahan buah maja dan mempersiapkan produk melalui berbagai tahapan seleksi serta pembinaan.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> RPL</span>
              <span class="psk-achv-year">2024</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="kota" data-article-id="a11">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/lombafutsal.jpg') }}" alt="Tim Futsal Skaneda Raih Juara 1 Tingkat Mojokerto Raya" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Juara 1</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Mojokerto Raya</span>
          </div>
          <div class="psk-achv-body">
            <h3>Tim Futsal Skaneda Raih Juara 1 Tingkat Mojokerto Raya</h3>
            <p>Tim Futsal SMKN 2 Mojokerto berhasil menjadi Juara 1 Pertandingan Futsal Pelajar Tingkat SMA/SMK se-Mojokerto Raya. Kemenangan ini diraih melalui permainan kompak dan strategi yang diterapkan bersama pelatih serta dukungan keluarga besar Skaneda.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Olahraga</span>
              <span class="psk-achv-year">2024</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="kota" data-article-id="a12">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/juarapmr.jpg') }}" alt="PMR Skaneda Raih Juara 2 Lomba Poster dan Video Kreatif" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Juara 2</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Mojokerto Raya</span>
          </div>
          <div class="psk-achv-body">
            <h3>PMR Skaneda Raih Juara 2 Lomba Poster dan Video Kreatif</h3>
            <p>Tim PMR SMKN 2 Mojokerto berhasil meraih Juara 2 Lomba Video Kreatif dan Poster dalam rangka HUT ke-79 PMI. Prestasi ini menjadi hasil dari kreativitas, disiplin, latihan, serta bimbingan pembina PMR Skaneda.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Umum</span>
              <span class="psk-achv-year">2024</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="provinsi" data-article-id="a9">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/lombakoperasi.jpg') }}" alt="Skaneda Raih Juara Favorit Lomba Koperasi Tingkat Jawa Timur" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Juara Favorit</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Jawa Timur</span>
          </div>
          <div class="psk-achv-body">
            <h3>Skaneda Raih Juara Favorit Lomba Koperasi Tingkat Jawa Timur</h3>
            <p>Tim Layanan Perbankan Syariah SMKN 2 Mojokerto berhasil meraih Juara Favorit Lomba Koperasi Tingkat Jawa Timur 2024. Prestasi ini diraih melalui kekompakan tim, kreativitas, inovasi produk, serta kolaborasi Kopsis Dewantara dengan berbagai jurusan.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Umum</span>
              <span class="psk-achv-year">2024</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="nasional" data-article-id="a10">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/fiksi.jpg') }}" alt="Dua Tim RPL dan DKV Lolos 6 dan 10 Besar Nasional FIKSI" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> 6 &amp; 10 Besar</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Nasional</span>
          </div>
          <div class="psk-achv-body">
            <h3>Dua Tim RPL dan DKV Lolos 6 dan 10 Besar Nasional FIKSI</h3>
            <p>Dua tim SMKN 2 Mojokerto berhasil lolos dalam FIKSI Tingkat Nasional 2024. Tim Saqran Cakra menempati 6 besar melalui inovasi desain kaos Majapahit, sedangkan Tim Skaneda Mojokerto masuk 10 besar melalui produk Tambal Express.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> RPL &amp; DKV</span>
              <span class="psk-achv-year">2024</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="nasional" data-article-id="a8">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/lkslampung.jpg') }}" alt="Tim Kuliner Skaneda Raih Medali Perak LKS Nasional" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Juara 2</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Nasional</span>
          </div>
          <div class="psk-achv-body">
            <h3>Tim Kuliner Skaneda Raih Medali Perak LKS Nasional</h3>
            <p>Ahmed Husein Jalili dan Mohammad Dzakaa Irawan berhasil meraih Medali Perak atau Juara 2 Nasional dalam LKS XXXII bidang Patisserie and Confectionery di Lampung. Prestasi ini merupakan hasil latihan intensif selama hampir 10 bulan dan dukungan dari para pembimbing.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Kuliner</span>
              <span class="psk-achv-year">2024</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="nasional" data-article-id="a7">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/klic.jpg') }}" alt="Skaneda Terpilih dalam Program Korea E-Learning Improvement Cooperation (KLIC)" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Program Terpilih</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Nasional</span>
          </div>
          <div class="psk-achv-body">
            <h3>Skaneda Terpilih dalam Program Korea E-Learning Improvement Cooperation (KLIC)</h3>
            <p>SMKN 2 Mojokerto menjadi salah satu sekolah terpilih dalam program Korea E-Learning Improvement Cooperation (KLIC). Melalui program ini, guru mendapatkan pelatihan teknologi pembelajaran, termasuk Artificial Intelligence dan Robotic Programming dari para pengajar Korea.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Program</span>
              <span class="psk-achv-year">2024</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="nasional" data-article-id="a5">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/paskib24.jpg') }}" alt="Skaneda Sapu Bersih Juara Lomba Paskibraka Tingkat Nasional 2024" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Multi Juara</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Nasional</span>
          </div>
          <div class="psk-achv-body">
            <h3>Skaneda Sapu Bersih Juara Lomba Paskibraka Tingkat Nasional 2024</h3>
            <p>Tim Paskibraka SMKN 2 Mojokerto berhasil meraih berbagai penghargaan dalam lomba LKBB Mahapatih Se-Nasional. Prestasi yang diraih meliputi juara variasi, formasi, pasukan, kostum, make-up, serta beberapa kategori lainnya.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Paskibraka</span>
              <span class="psk-achv-year">2024</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="kota" data-article-id="a4">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/dutkop24.jpg') }}" alt="Skaneda Raih Juara Favorit Duta Koperasi 2024" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Juara Favorit</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Kota Mojokerto</span>
          </div>
          <div class="psk-achv-body">
            <h3>Skaneda Raih Juara Favorit Duta Koperasi 2024</h3>
            <p>Naura Rahma Putri berhasil meraih Juara Favorit Duta Koperasi Kota Mojokerto 2024, sementara Zidana Khoiron dan Lahriria Amanah Muarta menjadi finalis. Prestasi ini didukung kekompakan tim, sosialisasi koperasi, serta dukungan warga sekolah.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Umum</span>
              <span class="psk-achv-year">2024</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="kota" data-article-id="a3">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/cerdascermat.jpg') }}" alt="Skaneda Raih Juara 3 Lomba Cerdas Cermat DISKOPUKMPERINDAG" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Juara 3</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Kota Mojokerto</span>
          </div>
          <div class="psk-achv-body">
            <h3>Skaneda Raih Juara 3 Lomba Cerdas Cermat DISKOPUKMPERINDAG</h3>
            <p>Tim Layanan Perbankan Syariah SMKN 2 Mojokerto berhasil meraih Juara 3 Lomba Cerdas Cermat Tingkat SMA/SMK/MA se-Kota Mojokerto. Prestasi ini diraih berkat ketekunan, disiplin waktu, literasi yang luas, serta bimbingan dari para guru.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Perbankan Syariah</span>
              <span class="psk-achv-year">2024</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="kota" data-article-id="a2">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/dugen22.jpg') }}" alt="Siswa SMKN 2 Mojokerto Raih Prestasi di Ajang Duta GenRe 2022" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Duta GenRe</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Kota Mojokerto</span>
          </div>
          <div class="psk-achv-body">
            <h3>Siswa SMKN 2 Mojokerto Raih Prestasi di Ajang Duta GenRe 2022</h3>
            <p>Siswa SMKN 2 Mojokerto berhasil menorehkan prestasi dalam ajang Duta GenRe 2022. Riska Kurniaila meraih Duta GenRe Sosial Media Inspiratif Kabupaten Jombang, sementara Muhammad Zulkifli dan Siti Nur Kholifah menjadi finalis Duta GenRe Kota Mojokerto.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Umum</span>
              <span class="psk-achv-year">2022</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>

        <article class="psk-achv-card" data-level="kota" data-article-id="a1">
          <div class="psk-achv-photo">
            <i class="fas fa-image"></i>
            <img src="{{ asset('images/prestasi/dutkop22.jpg') }}" alt="Siswi Perbankan Syariah Dinobatkan sebagai Duta Koperasi Bertalenta 2022" loading="lazy" onerror="this.remove()">
            <span class="psk-achv-rank"><i class="fas fa-trophy"></i> Duta Koperasi</span>
            <span class="psk-achv-level"><i class="fas fa-map-marker-alt"></i> Kota Mojokerto</span>
          </div>
          <div class="psk-achv-body">
            <h3>Siswi Perbankan Syariah Dinobatkan sebagai Duta Koperasi Bertalenta 2022</h3>
            <p>Cantika Putri Hapsari, siswi Perbankan Syariah SMKN 2 Mojokerto, berhasil meraih kategori Duta Koperasi Bertalenta Kota Mojokerto 2022. Prestasi ini menjadi bukti kemampuan dan kepeduliannya dalam mengembangkan literasi perkoperasian di kalangan generasi muda.</p>
            <div class="psk-achv-foot">
              <span class="psk-achv-tag"><i class="fas fa-tag"></i> Perbankan Syariah</span>
              <span class="psk-achv-year">2022</span>
            </div>
            <span class="psk-achv-link">Lihat berita <i class="fas fa-arrow-right"></i></span>
          </div>
        </article>
      <div class="psk-achv-more" data-reveal>
        <button type="button" class="psk-more-btn" id="pskAchvMore">Muat Prestasi Lainnya <i class="fas fa-chevron-down"></i></button>
        <span class="psk-achv-empty" id="pskAchvEmpty" hidden><i class="fas fa-info-circle"></i> Belum ada prestasi pada kategori ini.</span>
      </div>
    </div>
  </section>

  <!-- ================= 4. MOMEN KEJAYAAN ================= -->
<section class="psk-gallery">
  <div class="psk-section">

    <div data-reveal>
      <span class="psk-eyebrow">Dokumentasi Prestasi</span>

      <h2 class="psk-section-title">
        Momen <span class="psk-gold">Kejayaan</span>
      </h2>

      <p class="psk-subtitle">
        Ruang dokumentasi untuk foto-foto asli pencapaian Skaneda,
        disusun dalam grid bento dengan ukuran yang bervariasi.
      </p>
    </div>

    <div class="psk-moment-grid" style="margin-top:2.2rem;" data-reveal>

      <!-- FESTIKA JATIM 2025 -->
      <div class="psk-photo psk-mo-a">
        <img
          src="{{ asset('images/prestasi/adiwiyata.jpeg') }}"
          alt="Dokumentasi FESTIKA Jatim 2025">
        <span class="psk-photo-cap">
          <strong>Sekolah Adiwiyata Provinsi Jawa Timur</strong>
          <span>
            <i class="fas fa-map-marked-alt"></i>
            Provinsi · 2025
          </span>
        </span>
      </div>

      <!-- LKS NASIONAL 2024 -->
      <div class="psk-photo psk-mo-b">
        <img
          src="{{ asset('images/prestasi/lkslampung.jpg') }}"
          alt="Dokumentasi LKS Nasional 2024">
        <span class="psk-photo-cap">
          <strong>LKS Patisserie And Confectionery</strong>
          <span>
            <i class="fas fa-globe-asia"></i>
            Nasional · 2024
          </span>
        </span>
      </div>


      <!-- PASKIBRAKA 2024 -->
      <div class="psk-photo psk-mo-c">
        <img
          src="{{ asset('images/prestasi/paskib24.jpg') }}"
          alt="Dokumentasi Paskibraka 2024">
        <span class="psk-photo-cap">
          <strong>Paskibraka Skaneda</strong>
          <span>
            <i class="fas fa-globe-asia"></i>
            Nasional · 2024
          </span>
        </span>
      </div>


      <!-- LKS JAWA TIMUR 2026 -->
      <div class="psk-photo psk-mo-d">
        <img
          src="{{ asset('images/prestasi/lks26.jpg') }}"
          alt="Dokumentasi LKS Jawa Timur 2026">
        <span class="psk-photo-cap">
          <strong>LKS Jawa Timur</strong>
          <span>
            <i class="fas fa-map-marked-alt"></i>
            Provinsi · 2026
          </span>
        </span>
      </div>
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

  <!-- ================= 6. PERJALANAN PRESTASI (timeline poin, bergeser otomatis 2022→2026) ================= -->
  <section class="psk-archive">
    <div class="psk-section">
      <div class="psk-archive-head" data-reveal>
        <div>
          <span class="psk-eyebrow">Prestige Journey</span>
          <h2 class="psk-section-title">Perjalanan <span class="psk-gold">Prestasi</span></h2>
          <p class="psk-subtitle">Jejak kemenangan peserta didik Skaneda dari tahun ke tahun — setiap titik adalah kerja keras yang membuahkan hasil. Klik salah satu judul untuk membaca artikel lengkapnya.</p>
        </div>
        <span class="psk-archive-badge"><i class="fas fa-file-alt"></i> Arsip 2022 — 2026</span>
      </div>

      <div class="psk-timeline-wrap">
        <div class="psk-timeline-track">
          @for ($tlLoop = 0; $tlLoop < 2; $tlLoop++)
            @foreach ($timelineYears as $tlYear)
              @php $tlItems = $prestasiByYear->get($tlYear, collect()); @endphp
              <div class="psk-tl-node" data-reveal>
                <div class="psk-tl-circle">
                  <span>{{ $tlYear }}</span>
                  <em>Tahun</em>
                </div>
                <span class="psk-tl-count">
                  <i class="fas fa-trophy"></i>
                  {{ $tlItems->count() ? $tlItems->count().' Prestasi' : 'Belum Ada' }}
                </span>
                <div class="psk-tl-list">
                  @forelse ($tlItems as $tlItem)
                    <button type="button" class="psk-tl-item" data-article-id="{{ $tlItem['id'] }}">
                      <i class="fas fa-star"></i>
                      <span>
                        <strong>{{ $tlItem['title'] }}</strong>
                        <small>{{ $tlItem['levelLabel'] }} · {{ $tlItem['tag'] }}</small>
                      </span>
                    </button>
                  @empty
                    <div class="psk-tl-empty"><i class="fas fa-hourglass-half"></i> Arsip prestasi tahun ini belum tersedia.</div>
                  @endforelse
                </div>
              </div>
            @endforeach
          @endfor
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

  <!-- ARTICLE MODAL -->
  <div class="psk-article-modal" id="pskArticleModal" aria-hidden="true">
    <div class="psk-article-dialog" role="dialog" aria-modal="true" aria-labelledby="pskArticleTitle">
      <button type="button" class="psk-article-close" id="pskArticleClose" aria-label="Tutup"><i class="fas fa-times"></i></button>
      <div class="psk-article-date" id="pskArticleDate"><i class="fas fa-calendar-alt"></i></div>
      <h3 id="pskArticleTitle"></h3>
      <div class="psk-article-body" id="pskArticleBody"></div>
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

  /* ---------- Artikel: modal "Baca selengkapnya" ----------
     Data diambil langsung dari array $prestasi (PHP) supaya tidak
     ada duplikasi data antara section Pencapaian Prestasi, section
     Perjalanan Prestasi, dan modal ini. Tambah/edit prestasi cukup
     di satu tempat: array $prestasi pada bagian atas file. */
  var articleData = @json($articleDataJs);
  var articleModal = doc.getElementById('pskArticleModal');
  var articleClose = doc.getElementById('pskArticleClose');
  var articleDate = doc.getElementById('pskArticleDate');
  var articleTitle = doc.getElementById('pskArticleTitle');
  var articleBody = doc.getElementById('pskArticleBody');

  function openArticle(id) {
    var article = articleData.find(function (item) { return item.id === id; });
    if (!article) return;
    articleDate.innerHTML = '<i class="fas fa-calendar-alt"></i> ' + article.date + ' · ' + article.level;
    articleTitle.textContent = article.title;
    articleBody.innerHTML = '';
    article.body.forEach(function (paragraph) {
      var p = doc.createElement('p');
      p.textContent = paragraph;
      articleBody.appendChild(p);
    });
    articleModal.classList.add('open');
    articleModal.setAttribute('aria-hidden', 'false');
    doc.body.style.overflow = 'hidden';
  }

  function closeArticle() {
    articleModal.classList.remove('open');
    articleModal.setAttribute('aria-hidden', 'true');
    doc.body.style.overflow = '';
  }

  doc.querySelectorAll('[data-article-id]').forEach(function (button) {
    button.addEventListener('click', function () {
      openArticle(button.getAttribute('data-article-id'));
    });
  });

  articleClose.addEventListener('click', closeArticle);
  articleModal.addEventListener('click', function (e) {
    if (e.target === articleModal) closeArticle();
  });
  doc.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && articleModal.classList.contains('open')) closeArticle();
  });

  /* ---------- Pencapaian Prestasi: filter tingkat + muat lebih ---------- */
  var achvGrid = doc.getElementById('pskAchvGrid');
  if (achvGrid) {
    var achvCards = Array.prototype.slice.call(achvGrid.querySelectorAll('.psk-achv-card'));
    var achvFbtns = Array.prototype.slice.call(doc.querySelectorAll('.psk-achv-filters .psk-fbtn'));
    var achvMoreBtn = doc.getElementById('pskAchvMore');
    var achvEmpty = doc.getElementById('pskAchvEmpty');
    var PAGE_SIZE = 6;
    var currentFilter = 'all';
    var visibleCount = PAGE_SIZE;

    function achvRender() {
      var matched = achvCards.filter(function (card) {
        return currentFilter === 'all' || card.getAttribute('data-level') === currentFilter;
      });

      achvCards.forEach(function (card) { card.classList.add('is-hidden'); });
      matched.slice(0, visibleCount).forEach(function (card) { card.classList.remove('is-hidden'); });

      var hasMore = matched.length > visibleCount;
      if (achvMoreBtn) achvMoreBtn.hidden = !hasMore;
      if (achvEmpty) achvEmpty.hidden = matched.length !== 0;
    }

    achvFbtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        achvFbtns.forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');
        currentFilter = btn.getAttribute('data-filter');
        visibleCount = PAGE_SIZE;
        achvRender();
      });
    });

    if (achvMoreBtn) {
      achvMoreBtn.addEventListener('click', function () {
        visibleCount += PAGE_SIZE;
        achvRender();
      });
    }

    achvRender();
  }
})();
</script>
@endpush