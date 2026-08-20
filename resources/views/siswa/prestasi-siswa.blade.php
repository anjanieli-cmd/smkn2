@extends('layouts.app')

@section('title', 'Prestasi Siswa — SMK Negeri 2 Mojokerto')
@section('description', 'Prestasi siswa SMK Negeri 2 Mojokerto — juara lomba, medali, dan penghargaan tingkat kota, provinsi, hingga nasional dari 5 kompetensi keahlian.')

@push('styles')
<style>
/* =========================================================
   PRESTASI SISWA — DIGITAL HALL OF FAME · PRESTIGE JOURNEY
   Redesign v2 (hanya konten setelah hero).
   Hero, header (layouts.app) & footer TIDAK diubah.
   Visual language: navy #0d3a66, biru #2f6fa8, gold
   #ffd54a/#ffb300, Sora display, editorial premium, ornamen
   geometris subtle (opacity .08–.25). Judul section BESAR &
   BOLD mengikuti karakter heading "SEJARAH SKANEDA".
   ========================================================= */
.ps-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}
.ps-page *{box-sizing:border-box}

/* ---------- HERO: 100% MIRIP HALAMAN KARYA SISWA / PPDB (light theme + watermark + abstract ornamen) ---------- */
.ps-hero{position:relative;min-height:clamp(620px,78vh,790px);display:flex;align-items:center;overflow:hidden;
  background:#fff;color:#0d3a66;isolation:isolate}
.ps-hero::before{display:none}
/* Watermark typography besar transparan */
.ps-hero::after{content:"PRESTASI";position:absolute;z-index:0;left:2%;top:58%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(9rem,23vw,23rem);font-weight:900;line-height:.78;
  letter-spacing:.015em;color:rgba(13,58,102,.035);-webkit-text-stroke:1px rgba(255,122,0,.09);
  pointer-events:none;white-space:nowrap;user-select:none}
.ps-ref-ornaments{position:absolute!important;inset:0;z-index:1;overflow:hidden;pointer-events:none;opacity:1}
.ps-ref-ornament-image{position:absolute!important;inset:0;width:100%;height:100%;display:block;
  object-fit:cover;object-position:center center;max-width:none;opacity:1}
.ps-hero-inner{position:relative;z-index:4;width:100%;max-width:1500px;margin:0 auto;
  padding:clamp(4rem,10vh,7rem) clamp(1.25rem,4.2vw,4.5rem) clamp(4rem,9vh,6rem);display:block}

.ps-kicker{position:relative;z-index:5;display:inline-flex;align-items:center;gap:.65rem;font-size:.72rem;
  font-weight:900;letter-spacing:.18em;text-transform:uppercase;color:#ff6f00;margin-bottom:1.2rem;
  padding:.55rem .85rem;border:1px solid rgba(255,111,0,.18);border-radius:999px;background:#fffaf5}
.ps-kicker::before{content:"";width:9px;height:9px;border-radius:50%;background:#ff6f00;
  box-shadow:0 0 0 6px rgba(255,111,0,.10)}

/* ---------- TITLE: bertumpuk besar, 100% senada karya siswa / PPDB ---------- */
.ps-title{position:relative;z-index:5;font-family:var(--font-display);font-size:clamp(5.2rem,11.5vw,11rem);
  line-height:.82;letter-spacing:-.045em;margin:0;max-width:900px;text-transform:uppercase;
  text-shadow:none;animation:hdFadeUp .7s .1s var(--ease, ease) both}
.ps-title .ps-white{color:#0d3a66;display:block}
.ps-title .ps-gold{display:block;
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent;
  text-shadow:none;letter-spacing:-.025em}
.ps-lead{font-size:1rem;line-height:1.75;color:#52657a;max-width:720px;
  margin:1.7rem 0 0;animation:hdFadeUp .7s .26s var(--ease, ease) both}
.ps-hero-meta{display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;animation:hdFadeUp .7s .4s var(--ease, ease) both}
.ps-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;
  border:1px solid rgba(13,58,102,.12);background:#fff;border-radius:999px;color:#0d3a66;
  font-size:.72rem;font-weight:800;box-shadow:0 8px 24px rgba(13,58,102,.06)}
.ps-pill i{color:#ff7a00}

.hero-photo{display:none}
@media(min-width:1050px){.ps-hero-inner{padding-right:44%}}
@media(max-width:1050px){.ps-hero-inner{padding-right:1.25rem}.ps-ref-ornaments{opacity:.72}}
@media(max-width:900px){.ps-title{font-size:clamp(4.6rem,13vw,8rem)}.ps-ref-ornament-image{opacity:.88}}
@media(max-width:700px){.ps-hero{align-items:flex-start}.ps-hero-inner{width:90%}.ps-title{font-size:clamp(3.4rem,16vw,5.6rem)}}
@media(max-width:560px){.ps-ref-ornament-image{opacity:.62}}

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
.ps-hero .home-orn .ho-chevron{left:-150px;bottom:-60px;border-color:rgba(255,255,255,.10)}
.ps-hero .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.ps-hero .home-orn .ho-line{right:-80px;top:22%;opacity:.22}
.ps-hero .home-orn .ho-dots{right:6%;bottom:14%;opacity:.3}
.ps-hero .home-orn .ho-ring{left:44%;bottom:-90px;border-color:rgba(255,255,255,.12)}
.ps-hero .home-orn .ho-gold{right:16%;top:20%}
.ps-hero .home-orn .ho-square{left:12%;top:22%}
.ps-stats .home-orn .ho-chevron{right:-145px;top:45px}
.ps-stats .home-orn .ho-line{left:-80px;top:170px}
.ps-stats .home-orn .ho-dots{left:3%;bottom:100px}
.ps-stats .home-orn .ho-ring{right:8%;bottom:90px}
.ps-stats .home-orn .ho-gold{right:16%;top:22%}
.ps-stats .home-orn .ho-square{left:11%;top:15%}
.ps-stats .home-orn .ho-corner{right:3%;bottom:8%;transform:rotate(180deg)}
.ps-board .home-orn .ho-chevron{left:-145px;bottom:-60px}
.ps-board .home-orn .ho-line{right:-80px;bottom:170px}
.ps-board .home-orn .ho-dots{right:4%;top:90px}
.ps-board .home-orn .ho-ring{left:7%;top:70px}
.ps-board .home-orn .ho-gold{left:20%;top:30%}
.ps-galeri .home-orn .ho-chevron{right:-150px;top:-40px}
.ps-galeri .home-orn .ho-dots{left:5%;bottom:120px}
.ps-galeri .home-orn .ho-ring{right:6%;bottom:60px}
.ps-galeri .home-orn .ho-square{right:14%;top:18%}
.ps-galeri .home-orn .ho-gold{left:12%;top:34%}
.ps-cta .home-orn .ho-chevron{left:-120px;bottom:-80px;border-color:rgba(255,255,255,.10)}
.ps-cta .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.ps-cta .home-orn .ho-dots{left:8%;top:30%;opacity:.22}
.ps-cta .home-orn .ho-ring{right:-70px;top:20%;border-color:rgba(255,255,255,.10)}
.ps-cta .home-orn .ho-gold{left:20%;bottom:26%}

.ps-hero>*:not(.home-orn),
.ps-stats>*:not(.home-orn),
.ps-board>*:not(.home-orn),
.ps-galeri>*:not(.home-orn),
.ps-cta>*:not(.home-orn){position:relative;z-index:2}

/* =========================================================
   KONTEN REDESIGN v2 — DIGITAL HALL OF FAME
   Semua selector memakai class khusus .prestasi-* (tidak ada
   CSS global h1/h2/h3 agar header/hero/footer tidak berubah).
   ========================================================= */
.prestasi-section{width:min(1200px,92%);margin:0 auto;position:relative}

/* ---- JUDUL SECTION BESAR & BOLD (karakter "SEJARAH SKANEDA") ---- */
.prestasi-section-title{font-family:var(--font-display);font-weight:900;
  font-size:clamp(2.8rem,5.8vw,4.5rem);line-height:.98;letter-spacing:-.02em;margin:0;
  color:#0d3a66;text-transform:uppercase}
.prestasi-section-title .p-gold{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 60%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ffb300}
.prestasi-eyebrow{display:inline-flex;align-items:center;gap:.6rem;font-size:.72rem;font-weight:800;
  letter-spacing:.22em;text-transform:uppercase;color:#2f6fa8;margin-bottom:1.1rem}
.prestasi-eyebrow::before{content:"";width:36px;height:2px;background:linear-gradient(90deg,#ffd54a,#ffb300)}
.prestasi-eyebrow.light{color:#ffd54a}
.prestasi-subtitle{font-size:.95rem;line-height:1.85;color:#718396;max-width:560px;margin:1.2rem 0 0}

/* ---------- 1. SECTION PEMBUKA "PRESTASI SKANEDA" (editorial 2 kolom) ---------- */
.prestasi-opening{position:relative;padding:110px 0 90px;overflow:hidden;background:url('{{ asset('images/prestasi-4.jpg') }}') center/cover no-repeat}
.prestasi-opening::after{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(255,255,255,.96) 0%,rgba(255,255,255,.88) 48%,rgba(255,255,255,.55) 100%);z-index:0;pointer-events:none}.prestasi-opening::before{content:"PRESTASI";position:absolute;left:50%;top:12%;transform:translateX(-50%);
  font-family:var(--font-display);font-size:clamp(5rem,16vw,15rem);font-weight:900;line-height:1;white-space:nowrap;
  color:rgba(13,58,102,.045);-webkit-text-stroke:1px rgba(13,58,102,.07);pointer-events:none;z-index:1}
.prestasi-opening-grid{display:grid;position:relative;z-index:2;grid-template-columns:1.05fr .95fr;gap:clamp(2.5rem,5vw,5rem);align-items:center}
.prestasi-opening .prestasi-desc{font-size:1rem;line-height:1.95;color:#5b6c80;margin:1.6rem 0 0;max-width:560px}
.prestasi-opening .prestasi-desc strong{color:#0d3a66}
.prestasi-opening-meta{display:flex;gap:1.8rem;flex-wrap:wrap;margin-top:2.4rem;padding-top:1.8rem;
  border-top:1px solid #e3edf0}
.prestasi-opening-meta .om-item{display:flex;flex-direction:column;gap:.35rem}
.prestasi-opening-meta .om-item b{font-family:var(--font-display);font-size:1.35rem;font-weight:900;color:#0d3a66}
.prestasi-opening-meta .om-item b em{font-style:normal;color:#ffb300}
.prestasi-opening-meta .om-item span{font-size:.66rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:#718396}

/* Achievement Showcase (panel dekoratif kanan) — v2: lebih premium & berlapis */
.prestasi-showcase{position:relative;border-radius:28px;padding:clamp(2.2rem,4vw,3.4rem);
  background:linear-gradient(115deg,rgba(5,24,44,.48) 0%,rgba(8,38,70,.28) 45%,rgba(13,58,102,.12) 100%),
    url('{{ asset('images/prestasi-4.jpg') }}') center/cover no-repeat;color:#fff;overflow:hidden;
  box-shadow:0 30px 70px rgba(6,24,46,.3);border:1px solid rgba(255,255,255,.18);min-height:470px;display:flex;flex-direction:column;justify-content:center}
.prestasi-showcase::before{content:"";position:absolute;left:0;right:0;top:0;height:4px;z-index:2;
  background:linear-gradient(90deg,#ffd54a,#ffb300,#ff7a00)}
.prestasi-showcase::after{content:"";position:absolute;right:-70px;top:-70px;width:230px;height:230px;
  border:1px solid rgba(255,213,74,.22);border-radius:50%}
.prestasi-showcase .psh-dots{position:absolute;left:8%;bottom:16%;width:110px;height:110px;opacity:.35;z-index:1;
  background-image:radial-gradient(rgba(255,213,74,.5) 1.6px,transparent 1.7px);background-size:15px 15px}
.prestasi-showcase .psh-ring{position:absolute;left:-50px;bottom:-50px;width:160px;height:160px;z-index:1;
  border:1px dashed rgba(255,255,255,.10);border-radius:50%}
.prestasi-showcase-top{display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;position:relative;z-index:2}
.prestasi-showcase-label{display:inline-flex;align-items:center;gap:.55rem;font-size:.68rem;font-weight:800;
  letter-spacing:.2em;text-transform:uppercase;color:#ffd54a;position:relative;z-index:2}
.prestasi-showcase-label::before{content:"";width:7px;height:7px;border-radius:50%;background:#ffd54a;
  box-shadow:0 0 0 4px rgba(255,213,74,.18)}
.prestasi-showcase-icon{flex:0 0 58px;width:58px;height:58px;border-radius:16px;display:flex;align-items:center;
  justify-content:center;font-size:1.5rem;color:#5a3d00;background:linear-gradient(135deg,#ffe66d,#ffb300);
  box-shadow:0 14px 30px rgba(255,179,0,.4);position:relative;z-index:2}
.prestasi-showcase-stat{margin-top:1.8rem;position:relative;z-index:2}
.prestasi-showcase-num{display:flex;align-items:baseline;gap:.15rem;font-family:var(--font-display);
  font-weight:900;font-size:clamp(4rem,7.6vw,6.2rem);line-height:1;letter-spacing:-.03em}
.prestasi-showcase-num em{font-style:normal;background:linear-gradient(135deg,#ffe66d 0%,#ffc107 50%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.prestasi-showcase-num .psn-plus{color:#fff}
.prestasi-showcase-num-label{margin-top:.5rem;font-family:var(--font-display);font-weight:800;
  font-size:clamp(1rem,1.6vw,1.3rem);letter-spacing:.05em;text-transform:uppercase;color:rgba(235,245,253,.6)}
.prestasi-showcase-tag{display:inline-flex;align-items:center;gap:.5rem;margin-top:1.3rem;padding:.55rem 1.1rem;
  border:1px solid rgba(255,213,74,.3);border-radius:999px;font-size:.72rem;font-weight:800;color:rgba(255,255,255,.94);
  background:rgba(255,213,74,.1);backdrop-filter:blur(6px);position:relative;z-index:2}
.prestasi-showcase-tag i{color:#ffd54a}
.prestasi-showcase-list{margin:1.9rem 0 0;padding:1.2rem 0 0;list-style:none;display:grid;gap:.75rem;position:relative;z-index:2;
  border-top:1px solid rgba(255,255,255,.12)}
.prestasi-showcase-list li{display:flex;align-items:center;gap:.75rem;font-size:.82rem;color:rgba(235,245,253,.9);
  transition:transform .3s var(--ease, ease)}
.prestasi-showcase-list li:hover{transform:translateX(4px)}
.prestasi-showcase-list li i{flex:0 0 24px;width:24px;height:24px;border-radius:50%;display:flex;align-items:center;
  justify-content:center;font-size:.56rem;color:#5a3d00;background:linear-gradient(135deg,#ffe66d,#ffb300);
  box-shadow:0 6px 16px rgba(255,179,0,.3)}

/* ---------- 2. ACHIEVEMENT STATISTICS (data TETAP: 42+/35+/12/5) ---------- */
.prestasi-stats{position:relative;padding:96px 0;background:
  radial-gradient(rgba(13,58,102,.05) 1.4px,transparent 1.5px) 0 0/22px 22px,#f7f9fc}
.prestasi-stats-head{display:flex;justify-content:space-between;align-items:end;gap:2rem;flex-wrap:wrap;margin-bottom:2.6rem}
.prestasi-stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.1rem}
.prestasi-stat{position:relative;background:#fff;border:1px solid #e3edf0;border-radius:20px;padding:1.7rem 1.5rem;
  overflow:hidden;transition:transform .35s var(--ease, ease),box-shadow .35s var(--ease, ease),border-color .35s var(--ease, ease)}
.prestasi-stat::after{content:"";position:absolute;left:0;bottom:0;width:100%;height:3px;
  background:linear-gradient(90deg,#ffd54a,#ffb300);transform:scaleX(0);transform-origin:left;
  transition:transform .45s var(--ease, ease)}
.prestasi-stat:hover{transform:translateY(-6px);box-shadow:0 20px 44px rgba(13,58,102,.10);border-color:rgba(255,179,0,.35)}
.prestasi-stat:hover::after{transform:scaleX(1)}
.prestasi-stat-icon{width:46px;height:46px;border-radius:13px;display:flex;align-items:center;justify-content:center;
  font-size:1.1rem;color:#fff;margin-bottom:1.1rem}
.prestasi-stat-icon.gold{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#5a3d00}
.prestasi-stat-icon.silver{background:linear-gradient(135deg,#c9d4de,#94a7b8);color:#2c3e50}
.prestasi-stat-icon.blue{background:linear-gradient(135deg,#2f6fa8,#1b4f7e)}
.prestasi-stat-icon.bronze{background:linear-gradient(135deg,#e8a06c,#c96f36);color:#4a2500}
.prestasi-stat b{display:block;font-family:var(--font-display);font-size:2.4rem;font-weight:900;line-height:1;color:#0d3a66}
.prestasi-stat b em{font-style:normal;color:#ffb300}
.prestasi-stat span{display:block;margin-top:.55rem;font-size:.7rem;font-weight:800;letter-spacing:.1em;
  text-transform:uppercase;color:#718396}
.prestasi-stat-note{font-size:.72rem;color:#a0aec0;margin-top:.6rem;line-height:1.6}
.prestasi-ajang{display:flex;align-items:center;gap:.6rem;flex-wrap:wrap;margin-top:2.4rem;font-size:.74rem;font-weight:800;color:#2f6fa8}
.prestasi-ajang i{color:#ffb300}
.prestasi-ajang-chips{display:flex;flex-wrap:wrap;gap:.5rem;margin-top:.9rem}
.prestasi-chip{display:inline-flex;align-items:center;gap:.45rem;padding:.48rem .85rem;border-radius:999px;
  border:1px solid #e3edf0;background:#fff;font-size:.72rem;font-weight:800;color:#0d3a66;
  transition:border-color .3s var(--ease, ease),transform .3s var(--ease, ease)}
.prestasi-chip i{color:#ffb300}
.prestasi-chip:hover{border-color:rgba(255,179,0,.5);transform:translateY(-2px)}

/* ---------- 3. BUDAYA KOMPETISI (editorial 2 kolom + quote) ---------- */
.prestasi-culture{position:relative;padding:110px 0;background:#fff;overflow:hidden}
.prestasi-culture .prestasi-culture-grid{display:grid;grid-template-columns:1fr 1fr;gap:clamp(2.5rem,5vw,5rem);align-items:center}
.prestasi-culture-desc{font-size:.95rem;line-height:1.95;color:#5b6c80;margin:1.5rem 0 0}
.prestasi-culture-desc strong{color:#0d3a66}
.prestasi-culture-points{display:grid;gap:1rem;margin-top:2rem}
.prestasi-cpoint{display:flex;gap:1rem;align-items:flex-start}
.prestasi-cpoint-icon{flex:0 0 42px;width:42px;height:42px;border-radius:12px;display:flex;align-items:center;
  justify-content:center;font-size:.95rem;color:#5a3d00;background:linear-gradient(135deg,#ffe66d,#ffb300)}
.prestasi-cpoint b{display:block;font-family:var(--font-display);font-size:.98rem;font-weight:800;color:#0d3a66}
.prestasi-cpoint span{display:block;font-size:.78rem;line-height:1.7;color:#718396;margin-top:.25rem}
.prestasi-quote{position:relative;background:#f3f7fb;border-left:5px solid #ffb300;border-radius:0 22px 22px 0;
  padding:2rem 2.2rem}
.prestasi-quote p{margin:0;font-size:1.05rem;font-style:italic;color:#2f6fa8;line-height:1.9;font-weight:500}
.prestasi-quote span{display:block;margin-top:.8rem;font-size:.68rem;font-weight:800;letter-spacing:.12em;
  text-transform:uppercase;color:#718396}
.prestasi-quote .pq-mark{position:absolute;top:-22px;left:1.4rem;font-family:var(--font-display);font-size:4.6rem;
  font-weight:900;line-height:1;color:rgba(255,179,0,.18);pointer-events:none}

/* ---------- 4. PAPAN PRESTASI (focal point + featured + filter) ---------- */
.prestasi-board{position:relative;padding:110px 0 120px;overflow:hidden;
  background:linear-gradient(180deg,#f7f9fc 0%,#eef3f8 100%)}
.prestasi-board::before{content:"01";position:absolute;right:-40px;top:40px;font-family:var(--font-display);
  font-size:clamp(8rem,20vw,18rem);font-weight:900;line-height:1;color:rgba(13,58,102,.03);
  -webkit-text-stroke:1px rgba(13,58,102,.05);pointer-events:none}
.prestasi-board-head{display:grid;grid-template-columns:1.15fr .85fr;gap:clamp(2rem,4vw,3.5rem);
  align-items:center;margin-bottom:1.2rem}
.prestasi-board-photo{position:relative;border-radius:22px;overflow:hidden;box-shadow:0 26px 60px rgba(13,58,102,.22);
  aspect-ratio:16/10;min-height:240px}
.prestasi-board-photo img{width:100%;height:100%;object-fit:cover;object-position:center;display:block}
.prestasi-board-photo::after{content:"";position:absolute;inset:0;
  background:linear-gradient(180deg,rgba(5,35,65,.08) 0%,rgba(5,35,65,0) 45%,rgba(5,35,65,.28) 100%)}
.prestasi-board-photo .pbp-cap{position:absolute;z-index:2;left:1.1rem;bottom:1rem;display:inline-flex;align-items:center;
  gap:.5rem;padding:.45rem .85rem;border-radius:999px;background:rgba(5,35,65,.72);backdrop-filter:blur(6px);
  font-size:.66rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:#ffd54a}
.prestasi-board-photo .pbp-cap i{font-size:.7rem}
.prestasi-board-intro{max-width:560px}
.prestasi-board-sub{display:inline-flex;align-items:center;gap:.6rem;margin-top:1.2rem;font-size:.72rem;font-weight:800;
  letter-spacing:.22em;text-transform:uppercase;color:#2f6fa8}
.prestasi-board-sub::before{content:"";width:30px;height:2px;background:linear-gradient(90deg,#ffd54a,#ffb300)}

.prestasi-filters{display:flex;gap:.55rem;flex-wrap:wrap;margin:2.2rem 0}
.prestasi-fbtn{display:inline-flex;align-items:center;gap:.45rem;padding:.6rem 1.2rem;border-radius:999px;
  border:1px solid #dbe7ef;background:#fff;font-size:.76rem;font-weight:800;color:#2f6fa8;cursor:pointer;
  transition:all .3s var(--ease, ease);font-family:inherit}
.prestasi-fbtn i{color:#ffb300}
.prestasi-fbtn:hover{border-color:rgba(255,179,0,.55);transform:translateY(-2px)}
.prestasi-fbtn.active{background:#0d3a66;border-color:#0d3a66;color:#ffd54a;box-shadow:0 12px 26px rgba(13,58,102,.28)}
.prestasi-fbtn.active i{color:#ffd54a}

/* Featured Achievement — award plaque */
.prestasi-feat{position:relative;display:grid;grid-template-columns:minmax(0,1fr) minmax(0,.9fr);gap:2rem;
  align-items:center;background:linear-gradient(145deg,#0d3a66 0%,#123f6e 60%,#1b4f7e 100%);color:#fff;
  border-radius:28px;padding:clamp(2rem,4vw,3.2rem);margin-bottom:2rem;overflow:hidden;
  box-shadow:0 30px 70px rgba(13,58,102,.28)}
.prestasi-feat::before{content:"";position:absolute;right:-60px;top:-60px;width:210px;height:210px;
  border:1px solid rgba(255,213,74,.22);border-radius:50%}
.prestasi-feat::after{content:"";position:absolute;right:-32px;top:-32px;width:130px;height:130px;
  border:1px dashed rgba(255,213,74,.18);border-radius:50%}
.prestasi-feat .pf-num{position:absolute;left:1.6rem;bottom:-2.4rem;font-family:var(--font-display);
  font-size:clamp(7rem,16vw,13rem);font-weight:900;line-height:1;letter-spacing:-.04em;
  color:rgba(255,255,255,.045);-webkit-text-stroke:1px rgba(255,255,255,.07);pointer-events:none}
.prestasi-feat .pf-dots{position:absolute;right:10%;bottom:14%;width:100px;height:100px;opacity:.5;
  background-image:radial-gradient(rgba(255,213,74,.5) 1.6px,transparent 1.7px);background-size:15px 15px}
.prestasi-feat-left{position:relative;z-index:2}
.prestasi-feat-eyebrow{display:inline-flex;align-items:center;gap:.55rem;font-size:.68rem;font-weight:800;
  letter-spacing:.24em;text-transform:uppercase;color:#ffd54a;margin-bottom:1.2rem}
.prestasi-feat-eyebrow i{font-size:.8rem}
.prestasi-feat-rank{display:inline-flex;align-items:center;gap:.5rem;padding:.42rem .95rem;border-radius:999px;
  background:linear-gradient(135deg,#ffe66d,#ffb300);color:#5a3d00;font-size:.74rem;font-weight:900;
  letter-spacing:.06em;text-transform:uppercase;box-shadow:0 12px 28px rgba(255,179,0,.35)}
.prestasi-feat h3{font-family:var(--font-display);font-size:clamp(1.5rem,3vw,2.3rem);font-weight:900;line-height:1.1;
  letter-spacing:-.02em;margin:1.1rem 0 0;color:#fff}
.prestasi-feat h3 em{font-style:normal;background:linear-gradient(135deg,#ffe66d 0%,#ffc107 50%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.prestasi-feat p{font-size:.9rem;line-height:1.8;color:rgba(235,245,253,.82);margin:1rem 0 0;max-width:520px}
.prestasi-feat-meta{display:flex;gap:.6rem;flex-wrap:wrap;margin-top:1.5rem}
.prestasi-feat-meta .pfm{display:inline-flex;align-items:center;gap:.45rem;padding:.5rem .9rem;border-radius:999px;
  border:1px solid rgba(255,255,255,.22);background:rgba(255,255,255,.07);font-size:.7rem;font-weight:800;
  color:rgba(235,245,253,.92)}
.prestasi-feat-meta .pfm i{color:#ffd54a}
.prestasi-feat-right{position:relative;z-index:2;display:flex;justify-content:center;padding-bottom:1.6rem}
.prestasi-feat-photo{position:relative;width:240px;height:240px;border-radius:26px;overflow:hidden;
  box-shadow:0 30px 70px rgba(4,14,28,.5);border:1px solid rgba(255,255,255,.2)}
.prestasi-feat-photo img{width:100%;height:100%;object-fit:cover;display:block;
  transition:transform .5s var(--ease, ease)}
.prestasi-feat:hover .prestasi-feat-photo img{transform:scale(1.07)}
.prestasi-feat-photo::after{content:"";position:absolute;inset:0;
  background:linear-gradient(200deg,rgba(7,22,42,.05) 32%,rgba(7,22,42,.72) 100%)}
.prestasi-feat-medal{position:absolute;z-index:3;left:50%;bottom:-1.6rem;transform:translateX(-50%);
  width:118px;height:118px;border-radius:50%;display:flex;flex-direction:column;
  align-items:center;justify-content:center;text-align:center;
  background:radial-gradient(circle at 30% 25%,#ffe66d,#ffb300 70%);
  box-shadow:0 18px 40px rgba(255,179,0,.42);border:5px solid #123f6e}
.prestasi-feat-medal::before{content:"";position:absolute;inset:-11px;border:1px dashed rgba(255,213,74,.5);border-radius:50%}
.prestasi-feat-medal i{font-size:1.15rem;color:#5a3d00;margin-bottom:.25rem}
.prestasi-feat-medal b{font-family:var(--font-display);font-size:.78rem;font-weight:900;line-height:1.1;color:#5a3d00}
.prestasi-feat-medal span{font-size:.5rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:#7a5200;margin-top:.15rem}

/* Card prestasi lain — foto di atas + konten di bawah */
.prestasi-card{position:relative;background:#fff;border:1px solid #e3edf0;border-radius:20px;padding:0;
  display:flex;flex-direction:column;overflow:hidden;
  transition:transform .35s var(--ease, ease),box-shadow .35s var(--ease, ease),border-color .35s var(--ease, ease)}
.prestasi-card::after{content:"";position:absolute;left:0;right:0;bottom:0;height:4px;
  background:linear-gradient(90deg,#ffd54a,#ffb300);transform:scaleX(0);transform-origin:left;
  transition:transform .4s var(--ease, ease);z-index:3}
.prestasi-card:hover{transform:translateY(-6px);box-shadow:0 22px 48px rgba(13,58,102,.12);border-color:rgba(255,179,0,.4)}
.prestasi-card:hover::after{transform:scaleX(1)}
.prestasi-card-media{position:relative;height:260px;overflow:hidden;flex:0 0 auto}
.prestasi-card-media img{width:100%;height:100%;object-fit:cover;display:block;
  transition:transform .5s var(--ease, ease)}
.prestasi-card:hover .prestasi-card-media img{transform:scale(1.08)}
.prestasi-card-media::after{content:"";position:absolute;inset:0;
  background:linear-gradient(180deg,rgba(7,22,42,0) 42%,rgba(7,22,42,.62) 100%)}
.prestasi-card-body{position:relative;padding:1.15rem 1.4rem 1.35rem;display:flex;flex-direction:column;gap:.55rem}
.prestasi-card-top{position:absolute;z-index:2;top:.75rem;left:.9rem;right:.9rem;
  display:flex;align-items:center;justify-content:space-between;gap:.6rem}
.prestasi-card-rank{display:inline-flex;align-items:center;gap:.4rem;padding:.34rem .8rem;border-radius:999px;
  font-size:.66rem;font-weight:900;letter-spacing:.08em;text-transform:uppercase;
  box-shadow:0 8px 18px rgba(4,14,28,.18)}
.prestasi-card-rank.r-1{background:#fff6e0;color:#9a5b00}
.prestasi-card-rank.r-2{background:#eef3f7;color:#44596e}
.prestasi-card-rank.r-3{background:#fbeee4;color:#9a5b00}
.prestasi-card-rank.r-h{background:#e8f1fa;color:#1b4f7e}
.prestasi-card-tag{display:inline-flex;align-items:center;gap:.3rem;padding:.26rem .6rem;border-radius:999px;
  font-size:.6rem;font-weight:800;letter-spacing:.05em;text-transform:uppercase;
  background:rgba(255,255,255,.92);backdrop-filter:blur(4px)}
.prestasi-card-tag.t-kota{color:#1b4f7e}
.prestasi-card-tag.t-prov{color:#2e6b28}
.prestasi-card-tag.t-nas{color:#9a5b00}
.prestasi-card h4{font-family:var(--font-display);font-size:1rem;font-weight:800;line-height:1.4;margin:0;color:#0d3a66}
.prestasi-card p{font-size:.78rem;line-height:1.7;color:#718396;margin:0}
.prestasi-card-foot{display:flex;align-items:center;gap:.6rem;margin-top:.3rem;padding-top:.8rem;border-top:1px dashed #e3edf0;
  font-size:.7rem;font-weight:800;color:#2f6fa8}
.prestasi-card-foot i{color:#ffb300}
.prestasi-card-year{margin-left:auto;background:#f3f7fb;border:1px solid #e3edf0;border-radius:999px;padding:.26rem .7rem;
  font-size:.66rem;font-weight:800;color:#0d3a66}
.prestasi-card-link{display:inline-flex;align-items:center;gap:.4rem;margin-top:.15rem;
  font-size:.72rem;font-weight:800;color:#2f6fa8;text-decoration:none;transition:gap .3s var(--ease, ease),color .3s var(--ease, ease)}
.prestasi-card-link i{font-size:.64rem;transition:transform .3s var(--ease, ease)}
.prestasi-card-link:hover{color:#0d3a66;gap:.6rem}
.prestasi-card-link:hover i{transform:translateX(3px)}
.prestasi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.2rem}
.prestasi-board-more{display:flex;justify-content:center;margin-top:2.8rem}
.prestasi-board-more-btn{display:inline-flex;align-items:center;gap:.6rem;padding:.9rem 2rem;border-radius:999px;
  background:#fff;border:1.5px solid rgba(13,58,102,.16);color:#0d3a66;font-weight:800;font-size:.86rem;
  text-decoration:none;box-shadow:0 12px 30px rgba(13,58,102,.08);
  transition:transform .3s var(--ease, ease),box-shadow .3s var(--ease, ease),background .3s var(--ease, ease),color .3s var(--ease, ease)}
.prestasi-board-more-btn i{color:#ffb300;transition:transform .3s var(--ease, ease)}
.prestasi-board-more-btn:hover{transform:translateY(-3px);background:#0d3a66;color:#fff;
  box-shadow:0 20px 44px rgba(13,58,102,.24)}
.prestasi-board-more-btn:hover i{transform:translateX(3px);color:#ffd54a}

/* ---------- 5. PERJALANAN PRESTASI (timeline tahun nyata 2023–2025) ---------- */
.prestasi-journey{position:relative;padding:110px 0;background:#fff;overflow:hidden}
.prestasi-journey::before{content:"";position:absolute;right:-120px;bottom:-120px;width:340px;height:340px;
  border:1px solid rgba(13,58,102,.08);border-radius:50%}
.prestasi-journey::after{content:"";position:absolute;right:-80px;bottom:-80px;width:220px;height:220px;
  border:1px dashed rgba(47,111,168,.12);border-radius:50%}
.prestasi-timeline{position:relative;display:grid;grid-template-columns:repeat(3,1fr);gap:1.6rem;margin-top:3.2rem}
.prestasi-timeline::before{content:"";position:absolute;left:8%;right:8%;top:40px;height:2px;
  background:linear-gradient(90deg,#ffd54a,#ffb300)}
.prestasi-tnode{position:relative;text-align:center}
.prestasi-tnode-marker{position:relative;z-index:2;width:80px;height:80px;margin:0 auto;border-radius:50%;
  display:flex;flex-direction:column;align-items:center;justify-content:center;background:#0d3a66;color:#ffd54a;
  border:4px solid #fff;box-shadow:0 0 0 2px #ffb300,0 14px 30px rgba(13,58,102,.22)}
.prestasi-tnode-marker b{font-family:var(--font-display);font-size:1.05rem;font-weight:900;line-height:1}
.prestasi-tnode-marker span{font-size:.55rem;font-weight:800;letter-spacing:.1em;color:rgba(235,245,253,.8);margin-top:.2rem}
.prestasi-tnode-count{display:inline-flex;align-items:center;gap:.35rem;margin-top:1.1rem;padding:.34rem .8rem;
  border-radius:999px;background:#fff6e0;color:#9a5b00;font-size:.66rem;font-weight:900;letter-spacing:.06em;text-transform:uppercase}
.prestasi-tnode-list{list-style:none;margin:1.1rem 0 0;padding:0;text-align:left;display:grid;gap:.55rem}
.prestasi-tnode-list li{position:relative;padding:.7rem .9rem .7rem 2.2rem;background:#f7f9fc;border:1px solid #eef2f6;
  border-radius:14px;font-size:.76rem;line-height:1.55;color:#44596e}
.prestasi-tnode-list li::before{content:"\f005";font-family:"Font Awesome 6 Free";font-weight:900;position:absolute;
  left:.85rem;top:.8rem;font-size:.62rem;color:#ffb300}
.prestasi-tnode-list li b{display:block;color:#0d3a66;font-weight:800}
.prestasi-tnode-list li span{font-size:.66rem;color:#718396}
.prestasi-journey-note{display:flex;align-items:center;gap:.6rem;margin-top:2.6rem;font-size:.78rem;font-weight:800;
  color:#2f6fa8}
.prestasi-journey-note i{color:#ffb300}
.prestasi-journey-note .j-arrow{margin-left:auto;color:#ffb300;font-size:1rem}

/* ---------- 6. GALERI FOTO PRESTASI (masonry + lightbox — data TIDAK diubah) ---------- */
.prestasi-galeri{position:relative;padding:110px 0 120px;background:
  radial-gradient(rgba(13,58,102,.05) 1.4px,transparent 1.5px) 0 0/22px 22px,#f7f9fc}
.prestasi-galeri-head{display:flex;justify-content:space-between;align-items:end;gap:2rem;flex-wrap:wrap;margin-bottom:2.6rem}
.prestasi-masonry{columns:3;column-gap:1.2rem}
.prestasi-photo{position:relative;display:block;break-inside:avoid;margin:0 0 1.2rem;border-radius:18px;overflow:hidden;
  cursor:zoom-in;box-shadow:0 14px 34px rgba(13,58,102,.12);border:1px solid #e3edf0;
  transition:transform .4s var(--ease, ease),box-shadow .4s var(--ease, ease)}
.prestasi-photo:hover{transform:translateY(-6px) scale(1.01);box-shadow:0 22px 50px rgba(13,58,102,.18)}
.prestasi-photo img{width:100%;display:block;object-fit:cover}
.prestasi-photo::after{content:"";position:absolute;inset:0;z-index:2;
  background:linear-gradient(180deg,rgba(7,22,42,0) 45%,rgba(7,22,42,.78) 100%)}
.prestasi-photo-cap{position:absolute;z-index:3;left:1.1rem;right:1.1rem;bottom:.95rem}
.prestasi-photo-cap strong{display:block;font-family:var(--font-display);font-size:.92rem;font-weight:600;color:#fff}
.prestasi-photo-cap span{font-size:.66rem;color:rgba(255,255,255,.72)}
.prestasi-zoom{position:absolute;z-index:4;top:.9rem;right:.9rem;width:34px;height:34px;border-radius:50%;
  background:rgba(13,58,102,.55);border:1px solid rgba(255,255,255,.28);backdrop-filter:blur(6px);
  display:flex;align-items:center;justify-content:center;color:#fff;font-size:.75rem;opacity:0;transition:opacity .3s var(--ease, ease)}
.prestasi-photo:hover .prestasi-zoom{opacity:1}

/* lightbox */
.ps-lightbox{position:fixed;inset:0;z-index:99;display:none;align-items:center;justify-content:center;
  background:rgba(4,14,28,.88);backdrop-filter:blur(8px);padding:2rem}
.ps-lightbox.open{display:flex}
.ps-lightbox img{max-width:min(92vw,1000px);max-height:82vh;border-radius:18px;box-shadow:0 40px 90px rgba(0,0,0,.55)}
.ps-lb-cap{position:absolute;left:50%;bottom:1.6rem;transform:translateX(-50%);text-align:center;color:#fff;width:90%}
.ps-lb-cap strong{font-family:var(--font-display);font-size:1.05rem;display:block}
.ps-lb-cap span{font-size:.76rem;color:rgba(255,255,255,.72)}
.ps-lb-close,.ps-lb-nav{position:absolute;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.25);
  color:#fff;width:46px;height:46px;border-radius:50%;display:flex;align-items:center;justify-content:center;
  font-size:1rem;cursor:pointer;transition:background .3s var(--ease, ease);z-index:10}
.ps-lb-close:hover,.ps-lb-nav:hover{background:rgba(255,179,0,.85);color:#0d3a66}
.ps-lb-close{top:1.4rem;right:1.4rem}
.ps-lb-nav.prev{left:1.4rem;top:50%;transform:translateY(-50%)}
.ps-lb-nav.next{right:1.4rem;top:50%;transform:translateY(-50%)}

/* ---------- CTA ---------- */
.ps-cta{position:relative;width:min(1120px,88%);margin:0 auto 88px;padding:62px 42px 68px;text-align:center;color:#fff;overflow:hidden;
  background:linear-gradient(120deg,#0d3a66 0%,#123f6e 45%,#2f6fa8 100%);border-radius:30px;box-shadow:0 18px 45px rgba(13,58,102,.16)}
.ps-cta::before{content:"PRESTASI";position:absolute;left:50%;top:50%;transform:translate(-50%,-52%);
  font-family:var(--font-display);font-size:clamp(4rem,14vw,13rem);font-weight:900;line-height:1;
  color:rgba(255,255,255,.045);-webkit-text-stroke:1px rgba(255,255,255,.06);pointer-events:none;white-space:nowrap}
.prestasi-cta-title{position:relative;font-family:var(--font-display);font-size:clamp(1.8rem,3.8vw,3rem);font-weight:900;
  line-height:1.1;letter-spacing:-.02em;margin:0 auto;max-width:820px;color:#fff}
.prestasi-cta-title em{font-style:normal;background:linear-gradient(135deg,#ffe66d 0%,#ffc107 45%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.ps-cta p{position:relative;max-width:640px;margin:1.3rem auto 0;color:rgba(235,245,253,.82);font-size:.94rem;line-height:1.85}
.ps-cta-btn{position:relative;display:inline-flex;align-items:center;gap:.6rem;margin-top:1.7rem;padding:.85rem 1.8rem;
  border-radius:999px;background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;font-weight:900;font-size:.9rem;
  text-decoration:none;box-shadow:0 18px 40px rgba(255,179,0,.30);transition:transform .3s var(--ease, ease),box-shadow .3s var(--ease, ease)}
.ps-cta-btn:hover{transform:translateY(-4px);box-shadow:0 24px 54px rgba(255,179,0,.42)}
.ps-cta-note{position:relative;margin-top:1.05rem;font-size:.68rem;color:rgba(235,245,253,.6)}
.ps-cta-note i{color:#ffd54a;margin-right:.35rem}

/* ---------- REVEAL ---------- */
[data-reveal]{opacity:0;transform:translateY(26px);transition:opacity .7s var(--ease, ease),transform .7s var(--ease, ease)}
[data-reveal="left"]{transform:translateX(-30px)}
[data-reveal="right"]{transform:translateX(30px)}
[data-reveal].revealed{opacity:1;transform:none}

/* ---------- RESPONSIVE ---------- */
@media(max-width:1024px){
  .ps-hero-inner{grid-template-columns:1fr;gap:2rem}
  .hero-photo{height:360px;transform:translateY(-18px) rotate(1deg)}
  .prestasi-stats-grid{grid-template-columns:repeat(2,1fr)}
  .prestasi-grid{grid-template-columns:repeat(2,1fr)}
  .prestasi-card-media{height:230px}
  .prestasi-feat{grid-template-columns:1fr;text-align:left}
  .prestasi-feat-right{justify-content:flex-start}
  .prestasi-timeline{grid-template-columns:1fr;gap:2.2rem}
  .prestasi-timeline::before{display:none}
  .prestasi-tnode{text-align:left}
  .prestasi-tnode-marker{margin:0}
  .prestasi-culture-grid{grid-template-columns:1fr;gap:2.6rem}
}
@media(max-width:860px){
  .prestasi-opening-grid{grid-template-columns:1fr;gap:2.6rem}
  .prestasi-board-head{grid-template-columns:1fr;gap:1.6rem}
  .prestasi-board-photo{aspect-ratio:16/9;min-height:0}
  .prestasi-masonry{columns:2}
  .ps-hero{min-height:0;align-items:flex-start}
  .ps-hero-inner{padding:clamp(3rem,8vh,4.5rem) 5% 3.6rem;width:90%}
  .ps-hero::after{font-size:clamp(3.6rem,22vw,6rem);opacity:.6;right:-4%}
  .hero-photo{height:300px}
}
@media(max-width:640px){
  .prestasi-stats-grid{grid-template-columns:1fr}
  .prestasi-grid{grid-template-columns:1fr}
  .prestasi-card-media{height:200px}
  .prestasi-masonry{columns:1}
  .prestasi-filters{flex-wrap:nowrap;overflow-x:auto;padding-bottom:.5rem;-webkit-overflow-scrolling:touch}
  .prestasi-filters .prestasi-fbtn{flex:0 0 auto}
  .ps-hero .home-orn .ho-chevron{left:-120px;bottom:-40px}
}
</style>
@endpush

@section('content')
<div class="ps-page">

  <!-- HERO (100% mirip halaman Karya Siswa / PPDB: watermark + ornamen abstrak + judul besar bertumpuk) -->
  <section class="ps-hero">
    <div class="ps-ref-ornaments" aria-hidden="true" style="background-image:url('{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}');background-size:cover;background-position:center center;">
      <img
        src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}"
        alt=""
        class="ps-ref-ornament-image"
        aria-hidden="true"
      >
    </div>
    <div class="ps-hero-inner">
      <div>
        <div class="ps-kicker">Papan Prestasi Peserta Didik</div>
        <h1 class="ps-title">
          <span class="ps-white">Prestasi</span>
          <span class="ps-gold">Siswa</span>
        </h1>
      </div>
    </div>
  </section>

  <!-- 1. SECTION PEMBUKA "PRESTASI SKANEDA" (editorial 2 kolom) -->
  <section class="prestasi-opening">
    <div class="prestasi-section prestasi-opening-grid">
      <div data-reveal="left">
        <span class="prestasi-eyebrow">Jejak Prestasi &amp; Kompetensi</span>
        <h2 class="prestasi-section-title">Prestasi<br><span class="p-gold">Skaneda</span></h2>
        <p class="prestasi-desc">Bukan sekadar menang, tetapi tumbuh melalui disiplin, proses, dan keberanian untuk bersaing. Setiap penghargaan yang terpajang di etalase sekolah adalah jejak kerja keras peserta didik, guru pembina, dan kemitraan dunia usaha &amp; industri.</p>
        <div class="prestasi-opening-meta">
          <div class="om-item"><b><em data-count="120">0</em>+</b><span>Penghargaan</span></div>
          <div class="om-item"><b>5</b><span>Kompetensi</span></div>
          <div class="om-item"><b>3</b><span>Tingkat Lomba</span></div>
        </div>
      </div>
      <div data-reveal="right">
        <div class="prestasi-showcase">
          <span class="psh-dots" aria-hidden="true"></span>
          <span class="psh-ring" aria-hidden="true"></span>
          <div class="prestasi-showcase-top">
            <span class="prestasi-showcase-label">Etalase Prestasi</span>
            <span class="prestasi-showcase-icon"><i class="fas fa-trophy"></i></span>
          </div>
          <div class="prestasi-showcase-stat">
            <div class="prestasi-showcase-num"><em data-count="42">0</em><span class="psn-plus">+</span></div>
            <div class="prestasi-showcase-num-label">Juara 1</div>
          </div>
          <span class="prestasi-showcase-tag"><i class="fas fa-medal"></i> Medali Emas Peserta Didik</span>
          <ul class="prestasi-showcase-list">
            <li><i class="fas fa-check"></i> Kota Mojokerto — 6 prestasi juara</li>
            <li><i class="fas fa-check"></i> Provinsi Jawa Timur — 6 prestasi juara</li>
            <li><i class="fas fa-check"></i> Nasional — 4 prestasi terbaik</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. ACHIEVEMENT STATISTICS (data TETAP: 42+/35+/12/5) -->
  <section class="prestasi-stats">
    <div class="prestasi-section">
      <div class="prestasi-stats-head" data-reveal>
        <div>
          <span class="prestasi-eyebrow">Angka Berbicara</span>
          <h2 class="prestasi-section-title">Rekap <span class="p-gold">Juara</span></h2>
        </div>
        <p class="prestasi-subtitle">Capaian peserta didik Skaneda yang terus tumbuh dari tahun ke tahun — dibina lewat program prestasi lintas jurusan.</p>
      </div>
      <div class="prestasi-stats-grid">
        <div class="prestasi-stat" data-reveal>
          <div class="prestasi-stat-icon gold"><i class="fas fa-medal"></i></div>
          <b><em data-count="42">0</em>+</b>
          <span>Medali Juara 1</span>
          <p class="prestasi-stat-note">Raihan tertinggi di setiap ajang yang diikuti.</p>
        </div>
        <div class="prestasi-stat" data-reveal style="--d:1">
          <div class="prestasi-stat-icon silver"><i class="fas fa-award"></i></div>
          <b><em data-count="35">0</em>+</b>
          <span>Medali Juara 2–3</span>
          <p class="prestasi-stat-note">Posisi podium kedua &amp; ketiga berbagai lomba.</p>
        </div>
        <div class="prestasi-stat" data-reveal style="--d:2">
          <div class="prestasi-stat-icon blue"><i class="fas fa-flag"></i></div>
          <b><em data-count="12">0</em></b>
          <span>Lomba Tingkat Nasional</span>
          <p class="prestasi-stat-note">Melaju mewakili Jawa Timur hingga panggung nasional.</p>
        </div>
        <div class="prestasi-stat" data-reveal style="--d:3">
          <div class="prestasi-stat-icon bronze"><i class="fas fa-star"></i></div>
          <b><em data-count="5">0</em></b>
          <span>Kompetensi Raih Juara</span>
          <p class="prestasi-stat-note">Seluruh kompetensi keahlian pernah menyumbang juara.</p>
        </div>
      </div>
      <div class="prestasi-ajang" data-reveal>
        <i class="fas fa-tags"></i> Ajang yang rutin diikuti
      </div>
      <div class="prestasi-ajang-chips" data-reveal>
        <span class="prestasi-chip"><i class="fas fa-code"></i> LKS SMK</span>
        <span class="prestasi-chip"><i class="fas fa-palette"></i> FLS2N</span>
        <span class="prestasi-chip"><i class="fas fa-running"></i> O2SN</span>
        <span class="prestasi-chip"><i class="fas fa-microscope"></i> OSN</span>
        <span class="prestasi-chip"><i class="fas fa-robot"></i> PIMNAS</span>
        <span class="prestasi-chip"><i class="fas fa-fire"></i> Kompetisi Digital</span>
      </div>
    </div>
  </section>

  <!-- 3. BUDAYA KOMPETISI (editorial 2 kolom + quote) -->
  <section class="prestasi-culture">
    <div class="prestasi-section prestasi-culture-grid">
      <div data-reveal="left">
        <span class="prestasi-eyebrow">Filosofi Kami</span>
        <h2 class="prestasi-section-title">Budaya<br><span class="p-gold">Kompetisi</span></h2>
        <p class="prestasi-culture-desc"><strong>Budaya kompetisi dibangun sejak hari pertama.</strong> Skaneda menyiapkan peserta didik lewat program pembinaan prestasi lintas jurusan — bimbingan intensif dari guru pembina dan praktisi industri, jadwal latihan terjadwal, hingga pendampingan penuh saat bertanding. Hasilnya, puluhan piala dan ratusan sertifikat berjejer di etalase sekolah setiap tahunnya.</p>
        <p class="prestasi-culture-desc" style="margin-top:1rem">Prestasi diraih tidak hanya oleh siswa yang berbakat, tetapi juga yang <strong>konsisten berlatih</strong> — itulah nilai yang kami tanamkan: <strong>#DisiplinBerprestasi</strong>.</p>
        <div class="prestasi-culture-points">
          <div class="prestasi-cpoint">
            <div class="prestasi-cpoint-icon"><i class="fas fa-user-graduate"></i></div>
            <div><b>Pembinaan Intensif</b><span>Bimbingan guru pembina &amp; praktisi industri di setiap kompetensi.</span></div>
          </div>
          <div class="prestasi-cpoint">
            <div class="prestasi-cpoint-icon"><i class="fas fa-calendar-check"></i></div>
            <div><b>Latihan Terjadwal</b><span>Jam latihan rutin yang terstruktur menjelang setiap ajang.</span></div>
          </div>
          <div class="prestasi-cpoint">
            <div class="prestasi-cpoint-icon"><i class="fas fa-handshake"></i></div>
            <div><b>Pendampingan Penuh</b><span>Dampingan dari persiapan hingga hari pertandingan.</span></div>
          </div>
        </div>
      </div>
      <div data-reveal="right">
        <div class="prestasi-quote">
          <span class="pq-mark" aria-hidden="true">"</span>
          <p>&ldquo;Prestasi adalah hasil dari disiplin, kerja keras, dan doa — bukan kebetulan.&rdquo;</p>
          <span>— Moto Pembinaan Prestasi Skaneda</span>
        </div>
        <p class="prestasi-culture-desc" style="margin-top:2rem">Dari kelas, bengkel, dan dapur — peserta didik Skaneda dilatih untuk berkompetisi dan memenangkan ajang bergengsi, membawa nama sekolah ke panggung kota, provinsi, hingga nasional.</p>
      </div>
    </div>
  </section>

  <!-- 4. PAPAN PRESTASI (focal point — featured + filter + grid) -->
  <section class="prestasi-board">
    <div class="prestasi-section">
      <div class="prestasi-board-head" data-reveal>
        <figure class="prestasi-board-photo">
          <img src="{{ asset('images/prestasi-5.jpg') }}" alt="Siswa Skaneda memegang piala Juara 1 Cloud Computing" loading="eager">
          <span class="pbp-cap"><i class="fas fa-trophy"></i> Dokumentasi Lomba</span>
        </figure>
        <div class="prestasi-board-intro">
          <span class="prestasi-eyebrow">Hall of Fame</span>
          <h2 class="prestasi-section-title">Papan <span class="p-gold">Prestasi</span></h2>
          <span class="prestasi-board-sub">Jejak Kemenangan Siswa Skaneda</span>
        </div>
      </div>

      <div class="prestasi-filters" data-reveal>
        <button class="prestasi-fbtn active" data-filter="all"><i class="fas fa-th-large"></i> Semua</button>
        <button class="prestasi-fbtn" data-filter="kota"><i class="fas fa-building"></i> Kota / Kabupaten</button>
        <button class="prestasi-fbtn" data-filter="prov"><i class="fas fa-map-marked-alt"></i> Provinsi</button>
        <button class="prestasi-fbtn" data-filter="nas"><i class="fas fa-flag"></i> Nasional</button>
      </div>

      <!-- FEATURED ACHIEVEMENT (award plaque) -->
      <article class="prestasi-feat" data-level="kota" data-reveal>
        <span class="pf-num" aria-hidden="true">01</span>
        <span class="pf-dots" aria-hidden="true"></span>
        <div class="prestasi-feat-left">
          <span class="prestasi-feat-eyebrow"><i class="fas fa-crown"></i> Featured Achievement</span>
          <span class="prestasi-feat-rank"><i class="fas fa-trophy"></i> Juara 1</span>
          <h3>LKS Web <em>Technologies</em></h3>
          <p>Lomba Kompetensi Siswa bidang Web Technologies tingkat Kota Mojokerto — Tim RPL.</p>
          <div class="prestasi-feat-meta">
            <span class="pfm"><i class="fas fa-building"></i> Kota Mojokerto</span>
            <span class="pfm"><i class="fas fa-user-graduate"></i> Rekayasa Perangkat Lunak</span>
            <span class="pfm"><i class="fas fa-calendar"></i> 2025</span>
          </div>
        </div>
        <div class="prestasi-feat-right">
          <div class="prestasi-feat-photo">
            <img src="{{ asset('images/prestasi-5.jpg') }}" alt="Tim RPL memegang piala Juara 1 LKS Web Technologies" loading="eager">
          </div>
          <div class="prestasi-feat-medal">
            <i class="fas fa-trophy"></i>
            <b>Juara 1</b>
            <span>LKS 2025</span>
          </div>
        </div>
      </article>

      <!-- CARD PRESTASI LAINNYA (data TIDAK diubah, foto ditambahkan) -->
      <div class="prestasi-grid" id="prestasiGrid">
        <!-- Kota -->
        <article class="prestasi-card" data-level="kota" data-reveal>
          <div class="prestasi-card-media">
            <img src="{{ asset('images/prestasi-1.jpg') }}" alt="Siswa kuliner menyajikan menu lomba cipta menu" loading="lazy">
            <div class="prestasi-card-top">
              <span class="prestasi-card-rank r-1"><i class="fas fa-trophy"></i> Juara 1</span>
              <span class="prestasi-card-tag t-kota"><i class="fas fa-building"></i> Kota Mojokerto</span>
            </div>
          </div>
          <div class="prestasi-card-body">
            <h4>Lomba Cipta Menu Kuliner</h4>
            <p>Lomba cipta menu berbahan lokal dengan teknik fine dining — kompetensi Kuliner.</p>
            <div class="prestasi-card-foot"><i class="fas fa-user-graduate"></i> Kuliner<span class="prestasi-card-year">2025</span></div>
            <a href="{{ route('index') }}" class="prestasi-card-link">Lihat berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="prestasi-card" data-level="kota" data-reveal style="--d:1">
          <div class="prestasi-card-media">
            <img src="{{ asset('images/prestasi-2.jpg') }}" alt="Karya poster juara Festival Desain Poster" loading="lazy">
            <div class="prestasi-card-top">
              <span class="prestasi-card-rank r-1"><i class="fas fa-trophy"></i> Juara 1</span>
              <span class="prestasi-card-tag t-kota"><i class="fas fa-building"></i> Kota Mojokerto</span>
            </div>
          </div>
          <div class="prestasi-card-body">
            <h4>Festival Desain Poster</h4>
            <p>Festival desain poster digital tingkat kota — kompetensi Desain Komunikasi Visual.</p>
            <div class="prestasi-card-foot"><i class="fas fa-user-graduate"></i> DKV<span class="prestasi-card-year">2024</span></div>
            <a href="{{ route('index') }}" class="prestasi-card-link">Lihat berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="prestasi-card" data-level="kota" data-reveal style="--d:2">
          <div class="prestasi-card-media">
            <img src="{{ asset('images/prestasi-3.jpg') }}" alt="Produk olahan hasil pertanian inovasi APHP" loading="lazy">
            <div class="prestasi-card-top">
              <span class="prestasi-card-rank r-2"><i class="fas fa-medal"></i> Juara 2</span>
              <span class="prestasi-card-tag t-kota"><i class="fas fa-building"></i> Kota Mojokerto</span>
            </div>
          </div>
          <div class="prestasi-card-body">
            <h4>Lomba Inovasi Produk Olahan</h4>
            <p>Inovasi produk olahan hasil pertanian dengan kemasan modern — kompetensi APHP.</p>
            <div class="prestasi-card-foot"><i class="fas fa-user-graduate"></i> APHP<span class="prestasi-card-year">2024</span></div>
            <a href="{{ route('index') }}" class="prestasi-card-link">Lihat berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="prestasi-card" data-level="kota" data-reveal style="--d:3">
          <div class="prestasi-card-media">
            <img src="{{ asset('images/prestasi-4.jpg') }}" alt="Siswa juara O2SN cabang bulu tangkis" loading="lazy">
            <div class="prestasi-card-top">
              <span class="prestasi-card-rank r-3"><i class="fas fa-medal"></i> Juara 3</span>
              <span class="prestasi-card-tag t-kota"><i class="fas fa-building"></i> Kota Mojokerto</span>
            </div>
          </div>
          <div class="prestasi-card-body">
            <h4>O2SN Bulu Tangkis</h4>
            <p>Olimpiade Olahraga Siswa Nasional tingkat kota — cabang bulu tangkis putra.</p>
            <div class="prestasi-card-foot"><i class="fas fa-user-graduate"></i> Umum<span class="prestasi-card-year">2023</span></div>
            <a href="{{ route('index') }}" class="prestasi-card-link">Lihat berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="prestasi-card" data-level="kota" data-reveal style="--d:4">
          <div class="prestasi-card-media">
            <img src="{{ asset('images/prestasi-6.jpg') }}" alt="Tim produksi film pendek FLS2N" loading="lazy">
            <div class="prestasi-card-top">
              <span class="prestasi-card-rank r-h"><i class="fas fa-star"></i> Harapan 1</span>
              <span class="prestasi-card-tag t-kota"><i class="fas fa-building"></i> Kota Mojokerto</span>
            </div>
          </div>
          <div class="prestasi-card-body">
            <h4>FLS2N Film Pendek</h4>
            <p>Festival Lomba Seni Siswa Nasional tingkat kota — kategori film pendek.</p>
            <div class="prestasi-card-foot"><i class="fas fa-user-graduate"></i> DKV<span class="prestasi-card-year">2023</span></div>
            <a href="{{ route('index') }}" class="prestasi-card-link">Lihat berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>

        <!-- Provinsi -->
        <article class="prestasi-card" data-level="prov" data-reveal>
          <div class="prestasi-card-media">
            <img src="{{ asset('images/prestasi-5.jpg') }}" alt="Tim RPL juara LKS Cloud Computing tingkat provinsi" loading="lazy">
            <div class="prestasi-card-top">
              <span class="prestasi-card-rank r-1"><i class="fas fa-trophy"></i> Juara 1</span>
              <span class="prestasi-card-tag t-prov"><i class="fas fa-map-marked-alt"></i> Jawa Timur</span>
            </div>
          </div>
          <div class="prestasi-card-body">
            <h4>LKS Cloud Computing</h4>
            <p>Lomba Kompetensi Siswa bidang Cloud Computing tingkat Provinsi Jawa Timur — Tim RPL.</p>
            <div class="prestasi-card-foot"><i class="fas fa-user-graduate"></i> Rekayasa Perangkat Lunak<span class="prestasi-card-year">2025</span></div>
            <a href="{{ route('index') }}" class="prestasi-card-link">Lihat berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="prestasi-card" data-level="prov" data-reveal style="--d:1">
          <div class="prestasi-card-media">
            <img src="{{ asset('images/prestasi-7.jpg') }}" alt="Hasil karya lomba Bakery dan Pastry" loading="lazy">
            <div class="prestasi-card-top">
              <span class="prestasi-card-rank r-1"><i class="fas fa-trophy"></i> Juara 1</span>
              <span class="prestasi-card-tag t-prov"><i class="fas fa-map-marked-alt"></i> Jawa Timur</span>
            </div>
          </div>
          <div class="prestasi-card-body">
            <h4>Lomba Bakery &amp; Pastry</h4>
            <p>Lomba bakery dan pastry tingkat provinsi — kompetensi Kuliner.</p>
            <div class="prestasi-card-foot"><i class="fas fa-user-graduate"></i> Kuliner<span class="prestasi-card-year">2024</span></div>
            <a href="{{ route('index') }}" class="prestasi-card-link">Lihat berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="prestasi-card" data-level="prov" data-reveal style="--d:2">
          <div class="prestasi-card-media">
            <img src="{{ asset('images/prestasi-8.jpg') }}" alt="Siswa RPL juara LKS ITNSA tingkat provinsi" loading="lazy">
            <div class="prestasi-card-top">
              <span class="prestasi-card-rank r-2"><i class="fas fa-medal"></i> Juara 2</span>
              <span class="prestasi-card-tag t-prov"><i class="fas fa-map-marked-alt"></i> Jawa Timur</span>
            </div>
          </div>
          <div class="prestasi-card-body">
            <h4>LKS IT Network Systems Administration</h4>
            <p>Lomba Kompetensi Siswa bidang ITNSA tingkat provinsi — administrasi jaringan.</p>
            <div class="prestasi-card-foot"><i class="fas fa-user-graduate"></i> Rekayasa Perangkat Lunak<span class="prestasi-card-year">2024</span></div>
            <a href="{{ route('index') }}" class="prestasi-card-link">Lihat berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="prestasi-card" data-level="prov" data-reveal style="--d:3">
          <div class="prestasi-card-media">
            <img src="{{ asset('images/prestasi-9.jpg') }}" alt="Tim juara Lomba Bank Syariah dan Ekonomi Digital" loading="lazy">
            <div class="prestasi-card-top">
              <span class="prestasi-card-rank r-3"><i class="fas fa-medal"></i> Juara 3</span>
              <span class="prestasi-card-tag t-prov"><i class="fas fa-map-marked-alt"></i> Jawa Timur</span>
            </div>
          </div>
          <div class="prestasi-card-body">
            <h4>Lomba Bank Syariah &amp; Ekonomi Digital</h4>
            <p>Lomba kompetisi perbankan syariah dan ekonomi digital tingkat provinsi — LPS.</p>
            <div class="prestasi-card-foot"><i class="fas fa-user-graduate"></i> Perbankan Syariah<span class="prestasi-card-year">2024</span></div>
            <a href="{{ route('index') }}" class="prestasi-card-link">Lihat berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="prestasi-card" data-level="prov" data-reveal style="--d:4">
          <div class="prestasi-card-media">
            <img src="{{ asset('images/prestasi-1.jpg') }}" alt="Produk unggulan Lomba Inovasi Pangan Lokal" loading="lazy">
            <div class="prestasi-card-top">
              <span class="prestasi-card-rank r-1"><i class="fas fa-trophy"></i> Juara 1</span>
              <span class="prestasi-card-tag t-prov"><i class="fas fa-map-marked-alt"></i> Jawa Timur</span>
            </div>
          </div>
          <div class="prestasi-card-body">
            <h4>Lomba Inovasi Pangan Lokal</h4>
            <p>Inovasi pengolahan hasil pertanian tingkat provinsi — produk unggulan APHP.</p>
            <div class="prestasi-card-foot"><i class="fas fa-user-graduate"></i> APHP<span class="prestasi-card-year">2023</span></div>
            <a href="{{ route('index') }}" class="prestasi-card-link">Lihat berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="prestasi-card" data-level="prov" data-reveal style="--d:5">
          <div class="prestasi-card-media">
            <img src="{{ asset('images/prestasi-2.jpg') }}" alt="Karya juara FLS2N kategori Desain Komunikasi Visual" loading="lazy">
            <div class="prestasi-card-top">
              <span class="prestasi-card-rank r-2"><i class="fas fa-medal"></i> Juara 2</span>
              <span class="prestasi-card-tag t-prov"><i class="fas fa-map-marked-alt"></i> Jawa Timur</span>
            </div>
          </div>
          <div class="prestasi-card-body">
            <h4>FLS2N Kategori Desain Komunikasi Visual</h4>
            <p>Festival Lomba Seni Siswa Nasional tingkat provinsi — kategori DKV.</p>
            <div class="prestasi-card-foot"><i class="fas fa-user-graduate"></i> DKV<span class="prestasi-card-year">2023</span></div>
            <a href="{{ route('index') }}" class="prestasi-card-link">Lihat berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>

        <!-- Nasional -->
        <article class="prestasi-card" data-level="nas" data-reveal>
          <div class="prestasi-card-media">
            <img src="{{ asset('images/prestasi-3.jpg') }}" alt="Tim RPL juara LKS Nasional IT Software Solutions" loading="lazy">
            <div class="prestasi-card-top">
              <span class="prestasi-card-rank r-2"><i class="fas fa-medal"></i> Juara 2</span>
              <span class="prestasi-card-tag t-nas"><i class="fas fa-flag"></i> Nasional</span>
            </div>
          </div>
          <div class="prestasi-card-body">
            <h4>LKS Tingkat Nasional — IT Software Solutions</h4>
            <p>Lomba Kompetensi Siswa tingkat nasional bidang IT Software Solutions for Business.</p>
            <div class="prestasi-card-foot"><i class="fas fa-user-graduate"></i> Rekayasa Perangkat Lunak<span class="prestasi-card-year">2025</span></div>
            <a href="{{ route('index') }}" class="prestasi-card-link">Lihat berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="prestasi-card" data-level="nas" data-reveal style="--d:1">
          <div class="prestasi-card-media">
            <img src="{{ asset('images/prestasi-4.jpg') }}" alt="Hasil karya LKS Nasional Culinary Arts" loading="lazy">
            <div class="prestasi-card-top">
              <span class="prestasi-card-rank r-h"><i class="fas fa-star"></i> Harapan 1</span>
              <span class="prestasi-card-tag t-nas"><i class="fas fa-flag"></i> Nasional</span>
            </div>
          </div>
          <div class="prestasi-card-body">
            <h4>LKS Nasional — Culinary Arts</h4>
            <p>Lomba Kompetensi Siswa tingkat nasional bidang Culinary Arts — kompetensi Kuliner.</p>
            <div class="prestasi-card-foot"><i class="fas fa-user-graduate"></i> Kuliner<span class="prestasi-card-year">2024</span></div>
            <a href="{{ route('index') }}" class="prestasi-card-link">Lihat berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="prestasi-card" data-level="nas" data-reveal style="--d:2">
          <div class="prestasi-card-media">
            <img src="{{ asset('images/prestasi-5.jpg') }}" alt="Siswa finalis OSN Informatika tingkat nasional" loading="lazy">
            <div class="prestasi-card-top">
              <span class="prestasi-card-rank r-3"><i class="fas fa-medal"></i> Finalis</span>
              <span class="prestasi-card-tag t-nas"><i class="fas fa-flag"></i> Nasional</span>
            </div>
          </div>
          <div class="prestasi-card-body">
            <h4>OSN Informatika</h4>
            <p>Olimpiade Sains Nasional bidang Informatika — lolos hingga babak final nasional.</p>
            <div class="prestasi-card-foot"><i class="fas fa-user-graduate"></i> Rekayasa Perangkat Lunak<span class="prestasi-card-year">2024</span></div>
            <a href="{{ route('index') }}" class="prestasi-card-link">Lihat berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
        <article class="prestasi-card" data-level="nas" data-reveal style="--d:3">
          <div class="prestasi-card-media">
            <img src="{{ asset('images/prestasi-6.jpg') }}" alt="Aplikasi karya siswa RPL Kompetisi Inovasi Digital" loading="lazy">
            <div class="prestasi-card-top">
              <span class="prestasi-card-rank r-h"><i class="fas fa-star"></i> Top 10</span>
              <span class="prestasi-card-tag t-nas"><i class="fas fa-flag"></i> Nasional</span>
            </div>
          </div>
          <div class="prestasi-card-body">
            <h4>Kompetisi Inovasi Digital Siswa</h4>
            <p>Kompetisi inovasi digital tingkat nasional — aplikasi karya siswa RPL.</p>
            <div class="prestasi-card-foot"><i class="fas fa-user-graduate"></i> Rekayasa Perangkat Lunak<span class="prestasi-card-year">2023</span></div>
            <a href="{{ route('index') }}" class="prestasi-card-link">Lihat berita <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
      </div>

      <div class="prestasi-board-more" data-reveal>
        <a href="{{ route('prestasi-sekolah') }}" class="prestasi-board-more-btn">Lihat Selengkapnya <i class="fas fa-arrow-right"></i></a>
      </div>
    </div>
  </section>

  <!-- 5. PERJALANAN PRESTASI (timeline tahun nyata: 2023 → 2025) -->
  <section class="prestasi-journey">
    <div class="prestasi-section">
      <div data-reveal>
        <span class="prestasi-eyebrow">Prestige Journey</span>
        <h2 class="prestasi-section-title">Perjalanan<br><span class="p-gold">Prestasi</span></h2>
        <p class="prestasi-subtitle">Jejak kemenangan peserta didik Skaneda dari tahun ke tahun — setiap titik adalah kerja keras yang membuahkan hasil.</p>
      </div>

      <div class="prestasi-timeline">
        <div class="prestasi-tnode" data-reveal>
          <div class="prestasi-tnode-marker"><b>2023</b><span>TAHUN</span></div>
          <span class="prestasi-tnode-count"><i class="fas fa-trophy"></i> 5 Prestasi</span>
          <ul class="prestasi-tnode-list">
            <li><b>Juara 1 Lomba Inovasi Pangan Lokal</b><span>Provinsi · APHP</span></li>
            <li><b>Juara 2 FLS2N Kategori DKV</b><span>Provinsi · DKV</span></li>
            <li><b>Juara 3 O2SN Bulu Tangkis</b><span>Kota · Umum</span></li>
            <li><b>Harapan 1 FLS2N Film Pendek</b><span>Kota · DKV</span></li>
            <li><b>Top 10 Kompetisi Inovasi Digital</b><span>Nasional · RPL</span></li>
          </ul>
        </div>
        <div class="prestasi-tnode" data-reveal style="--d:1">
          <div class="prestasi-tnode-marker"><b>2024</b><span>TAHUN</span></div>
          <span class="prestasi-tnode-count"><i class="fas fa-trophy"></i> 7 Prestasi</span>
          <ul class="prestasi-tnode-list">
            <li><b>Juara 1 Lomba Bakery &amp; Pastry</b><span>Provinsi · Kuliner</span></li>
            <li><b>Juara 1 Festival Desain Poster</b><span>Kota · DKV</span></li>
            <li><b>Juara 2 LKS ITNSA</b><span>Provinsi · RPL</span></li>
            <li><b>Juara 2 Inovasi Produk Olahan</b><span>Kota · APHP</span></li>
            <li><b>Juara 3 Bank Syariah &amp; Ekonomi Digital</b><span>Provinsi · LPS</span></li>
            <li><b>Harapan 1 LKS Nasional Culinary Arts</b><span>Nasional · Kuliner</span></li>
            <li><b>Finalis OSN Informatika</b><span>Nasional · RPL</span></li>
          </ul>
        </div>
        <div class="prestasi-tnode" data-reveal style="--d:2">
          <div class="prestasi-tnode-marker"><b>2025</b><span>TAHUN</span></div>
          <span class="prestasi-tnode-count"><i class="fas fa-trophy"></i> 4 Prestasi</span>
          <ul class="prestasi-tnode-list">
            <li><b>Juara 1 LKS Web Technologies</b><span>Kota · RPL</span></li>
            <li><b>Juara 1 Lomba Cipta Menu Kuliner</b><span>Kota · Kuliner</span></li>
            <li><b>Juara 1 LKS Cloud Computing</b><span>Provinsi · RPL</span></li>
            <li><b>Juara 2 LKS Nasional IT Software Solutions</b><span>Nasional · RPL</span></li>
          </ul>
        </div>
      </div>

      <div class="prestasi-journey-note" data-reveal>
        <i class="fas fa-route"></i> Perjalanan prestasi terus berlanjut — setiap tahun menghadirkan babak baru.
        <span class="j-arrow"><i class="fas fa-arrow-right"></i></span>
      </div>
    </div>
  </section>

  <!-- 6. GALERI FOTO PRESTASI (masonry + lightbox — foto & caption TIDAK diubah) -->
  <section class="prestasi-galeri">
    <div class="prestasi-section">
      <div class="prestasi-galeri-head" data-reveal>
        <div>
          <span class="prestasi-eyebrow">Dokumentasi</span>
          <h2 class="prestasi-section-title">Momen <span class="p-gold">Kejayaan</span></h2>
          <p class="prestasi-subtitle">Klik foto untuk memperbesar. Dokumentasi sebagian momen penghargaan dan kompetisi peserta didik Skaneda.</p>
        </div>
      </div>

      <div class="prestasi-masonry" data-reveal>
        <a class="prestasi-photo" href="#" data-full="images/prestasi-1.jpg" data-cap="Siswa Skaneda meraih medali" data-sub="Penyerahan penghargaan lomba">
          <img src="{{ asset('images/prestasi-1.jpg') }}" alt="Siswa menerima medali" loading="eager">
          <span class="prestasi-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="prestasi-photo-cap"><strong>Penyerahan Medali</strong><span>Upacara penghargaan lomba</span></span>
        </a>
        <a class="prestasi-photo" href="#" data-full="images/prestasi-2.jpg" data-cap="Etalase Piala Juara" data-sub="Koleksi trofi kejuaraan">
          <img src="{{ asset('images/prestasi-2.jpg') }}" alt="Piala dan sertifikat juara" loading="eager">
          <span class="prestasi-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="prestasi-photo-cap"><strong>Etalase Piala Juara</strong><span>Koleksi trofi kejuaraan</span></span>
        </a>
        <a class="prestasi-photo" href="#" data-full="images/prestasi-3.jpg" data-cap="Penghargaan Lomba" data-sub="Siswa &amp; pembina merayakan">
          <img src="{{ asset('images/prestasi-3.jpg') }}" alt="Siswa dan pembina merayakan kemenangan" loading="eager">
          <span class="prestasi-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="prestasi-photo-cap"><strong>Penghargaan Lomba</strong><span>Siswa &amp; pembina merayakan</span></span>
        </a>
        <a class="prestasi-photo" href="#" data-full="images/prestasi-4.jpg" data-cap="Juara Bersama Guru" data-sub="Piala Juara 1 lomba">
          <img src="{{ asset('images/prestasi-4.jpg') }}" alt="Siswa berpose dengan piala juara" loading="eager">
          <span class="prestasi-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="prestasi-photo-cap"><strong>Juara Bersama Guru</strong><span>Piala Juara 1 lomba</span></span>
        </a>
        <a class="prestasi-photo" href="#" data-full="images/prestasi-5.jpg" data-cap="Juara 1 Cloud Computing" data-sub="LKS bidang cloud computing">
          <img src="{{ asset('images/prestasi-5.jpg') }}" alt="Siswa memegang piala juara 1 cloud computing" loading="eager">
          <span class="prestasi-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="prestasi-photo-cap"><strong>Juara 1 Cloud Computing</strong><span>LKS bidang cloud computing</span></span>
        </a>
        <a class="prestasi-photo" href="#" data-full="images/prestasi-6.jpg" data-cap="Penyerahan Hadiah" data-sub="Lomba olahraga pelajar">
          <img src="{{ asset('images/prestasi-6.jpg') }}" alt="Penyerahan hadiah lomba olahraga" loading="eager">
          <span class="prestasi-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="prestasi-photo-cap"><strong>Penyerahan Hadiah</strong><span>Lomba olahraga pelajar</span></span>
        </a>
        <a class="prestasi-photo" href="#" data-full="images/prestasi-7.jpg" data-cap="Piala Bergengsi" data-sub="Raihan juara nasional">
          <img src="{{ asset('images/prestasi-7.jpg') }}" alt="Siswa berpose dengan piala besar" loading="eager">
          <span class="prestasi-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="prestasi-photo-cap"><strong>Piala Bergengsi</strong><span>Raihan juara nasional</span></span>
        </a>
        <a class="prestasi-photo" href="#" data-full="images/prestasi-8.jpg" data-cap="Juara 1 Ganda" data-sub="Dua medali emas lomba">
          <img src="{{ asset('images/prestasi-8.jpg') }}" alt="Dua piala dan medali emas" loading="eager">
          <span class="prestasi-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="prestasi-photo-cap"><strong>Juara 1 Ganda</strong><span>Dua medali emas lomba</span></span>
        </a>
        <a class="prestasi-photo" href="#" data-full="images/prestasi-9.jpg" data-cap="Trofi LKS" data-sub="Piala 2 &amp; 3 LKS SMK">
          <img src="{{ asset('images/prestasi-9.jpg') }}" alt="Trofi juara dua dan tiga LKS" loading="eager">
          <span class="prestasi-zoom"><i class="fas fa-search-plus"></i></span>
          <span class="prestasi-photo-cap"><strong>Trofi LKS</strong><span>Piala 2 &amp; 3 LKS SMK</span></span>
        </a>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="ps-cta">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>
    <h2 class="prestasi-cta-title">Piala berikutnya bisa jadi <em>prestasimu.</em></h2>
    <p>Bergabunglah bersama SMK Negeri 2 Mojokerto dan raih prestasimu di panggung kota, provinsi, hingga nasional — didukung guru pembina, fasilitas lengkap, dan kemitraan dunia usaha &amp; industri.</p>
    <a href="{{ route('kontak') }}" class="ps-cta-btn"><i class="fas fa-paper-plane"></i> Hubungi Sekolah</a>
    <div class="ps-cta-note"><i class="fas fa-info-circle"></i> Informasi resmi: smkn2mojokerto.sch.id · #DisiplinBerprestasi</div>
  </section>

</div>

<!-- Lightbox -->
<div class="ps-lightbox" id="psLightbox" aria-hidden="true">
  <button class="ps-lb-close" id="psLbClose" aria-label="Tutup"><i class="fas fa-times"></i></button>
  <button class="ps-lb-nav prev" id="psLbPrev" aria-label="Sebelumnya"><i class="fas fa-chevron-left"></i></button>
  <img src="" alt="Foto prestasi diperbesar">
  <button class="ps-lb-nav next" id="psLbNext" aria-label="Berikutnya"><i class="fas fa-chevron-right"></i></button>
  <div class="ps-lb-cap"><strong id="psLbCap"></strong><span id="psLbSub"></span></div>
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
  })();

  /* ---- Count-up statistik medali ---- */
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

  /* ---- Filter papan prestasi (featured + cards) ---- */
  (function () {
    var btns = document.querySelectorAll('.prestasi-fbtn');
    var items = document.querySelectorAll('.prestasi-feat, .prestasi-card');
    btns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        btns.forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');
        var f = btn.getAttribute('data-filter');
        items.forEach(function (card) {
          var lvl = card.getAttribute('data-level');
          var show = (f === 'all' || lvl === f);
          card.style.display = show ? '' : 'none';
        });
      });
    });
  })();

  /* ---- Lightbox galeri ---- */
  (function () {
    var box = document.getElementById('psLightbox');
    var img = box.querySelector('img');
    var cap = document.getElementById('psLbCap');
    var sub = document.getElementById('psLbSub');
    var photos = Array.prototype.slice.call(document.querySelectorAll('.prestasi-photo'));
    var idx = 0;

    function openAt(i) {
      idx = (i + photos.length) % photos.length;
      var p = photos[idx];
      img.setAttribute('src', p.getAttribute('data-full'));
      cap.textContent = p.getAttribute('data-cap') || '';
      sub.textContent = p.getAttribute('data-sub') || '';
      box.classList.add('open');
      box.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
    }
    function close() {
      box.classList.remove('open');
      box.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }
    photos.forEach(function (p, i) {
      p.addEventListener('click', function (e) { e.preventDefault(); openAt(i); });
    });
    document.getElementById('psLbClose').addEventListener('click', close);
    document.getElementById('psLbPrev').addEventListener('click', function () { openAt(idx - 1); });
    document.getElementById('psLbNext').addEventListener('click', function () { openAt(idx + 1); });
    box.addEventListener('click', function (e) { if (e.target === box) close(); });
    document.addEventListener('keydown', function (e) {
      if (!box.classList.contains('open')) return;
      if (e.key === 'Escape') close();
      if (e.key === 'ArrowLeft') openAt(idx - 1);
      if (e.key === 'ArrowRight') openAt(idx + 1);
    });
  })();
</script>
@endpush