@extends('layouts.app')

@section('title', 'Roadmap Skaneda — SMK Negeri 2 Mojokerto')
@section('description', 'Peta jalan pengembangan SMK Negeri 2 Mojokerto 2025–2030: fase, pilar strategis, dan target menjadi sekolah vokasi rujukan nasional.')

@push('styles')
<style>
/* =========================================================
   ROADMAP SKANEDA — PREMIUM EDITION
   Visual language: SENADA PERSIS dengan Guru & Staf, Sejarah
   Sekolah, Struktur Organisasi & Visi Misi — foto gedung +
   overlay, watermark typography, ornamen geometris (home-orn),
   glassmorphism, scroll-reveal, roadmap journey (fase 2025-2030).
   Warna: navy #0d3a66, biru #2f6fa8, putih, gold #ffd54a/#ffb300.
   ========================================================= */
.rm-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative;padding-bottom:12rem}
.rm-page *{box-sizing:border-box}
.rm-shell{width:100%}

/* ---------- HERO: foto gedung + overlay + watermark ---------- */
.rm-hero{position:relative;min-height:88vh;display:flex;align-items:flex-start;overflow:hidden;
  background-image:url('{{ asset('images/hero-sekolah.jpg') }}');
  background-size:cover;background-position:center;background-repeat:no-repeat;color:#fff}
.rm-hero::before{content:"";position:absolute;inset:0;z-index:1;
  background:linear-gradient(100deg,rgba(7,22,42,.90) 0%,rgba(9,30,54,.68) 45%,rgba(9,30,54,.32) 78%,rgba(9,30,54,.12) 100%)}
/* Watermark typography besar transparan */
.rm-hero::after{content:"ROADMAP";position:absolute;z-index:2;right:-2%;top:50%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(5rem,19vw,19rem);font-weight:900;line-height:.82;
  letter-spacing:.02em;color:rgba(255,255,255,.055);-webkit-text-stroke:1px rgba(255,255,255,.07);
  text-shadow:0 0 90px rgba(13,58,102,.16);pointer-events:none;white-space:nowrap;user-select:none}
.rm-hero-inner{position:relative;z-index:3;width:100%;max-width:none;margin:0 auto;
  padding:clamp(3.5rem,9vh,5.5rem) clamp(1.5rem,5vw,5.5rem);
  display:grid;grid-template-columns:minmax(0,1.05fr) minmax(340px,.95fr);gap:4rem;align-items:center}

.rm-kicker{display:inline-flex;transform:translateY(0);align-items:center;gap:.65rem;font-size:.74rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#ffd54a;margin-bottom:0.6rem}
.rm-kicker::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ffb300)}

/* ---------- TITLE: ROADMAP putih, SKANEDA kuning-oranye ---------- */
.rm-title{font-family:var(--font-display);font-size:clamp(2.9rem,6.6vw,6.2rem);line-height:.98;
  letter-spacing:.01em;margin:0;max-width:820px;text-transform:uppercase;
  text-shadow:0 2px 24px rgba(4,14,28,.35);animation:hdFadeUp .7s .1s var(--ease, ease) both}
.rm-title .rm-white{color:#ffffff;display:inline-block}
.rm-title .rm-gold{display:inline-block;
  background:linear-gradient(135deg,#ffe66d 0%,#ffc107 45%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ffc107;
  text-shadow:0 4px 24px rgba(255,174,0,.18);letter-spacing:.025em}
.rm-lead{font-size:1.02rem;line-height:1.85;color:rgba(235,245,253,.86);max-width:640px;
  margin:1.3rem 0 0;animation:hdFadeUp .7s .26s var(--ease, ease) both}
.rm-hero-meta{display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;animation:hdFadeUp .7s .4s var(--ease, ease) both}
.rm-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;
  border:1px solid rgba(255,255,255,.2);background:rgba(13,58,102,.30);border-radius:999px;
  font-size:.72rem;font-weight:800;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)}
.rm-pill i{color:#ffd54a}

.hero-photo{position:relative;height:430px;border-radius:24px;overflow:hidden;
  border:1px solid rgba(255,255,255,.22);box-shadow:0 35px 90px rgba(0,0,0,.38);
  transform:translateY(-34px) rotate(1.5deg);animation:hdFadeUp .8s .35s var(--ease, ease) both}
.hero-photo::before{content:"";position:absolute;inset:0;z-index:2;
  background:linear-gradient(180deg,transparent 38%,rgba(4,20,38,.86) 100%)}
.hero-photo img{width:100%;height:100%;object-fit:cover;display:block;transform:scale(1.03)}
.hero-photo-caption{position:absolute;z-index:3;left:1.5rem;right:1.5rem;bottom:1.3rem}
.hero-photo-caption strong{display:block;font-family:var(--font-display);font-size:1.3rem;font-weight:600;color:#fff}
.hero-photo-caption span{font-size:.72rem;color:rgba(255,255,255,.74)}
@keyframes hdFadeUp{from{opacity:0;transform:translateY(26px)}to{opacity:1;transform:none}}

/* ---------- SECTION COMMON (keluarga Beranda) ---------- */
.rm-wide{width:min(1380px,92%);margin:auto}
.rm-section{position:relative;padding:96px 0 110px;background:#fff}
.eyebrow{display:inline-flex;align-items:center;gap:.5rem;font-size:.74rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#0d3a66;margin-bottom:.85rem}
.eyebrow::before{content:"";width:26px;height:3px;border-radius:99px;background:linear-gradient(90deg,#0d3a66,#2f6fa8)}
.big-heading{font-family:var(--font-display);font-size:clamp(2.1rem,4.4vw,4.2rem);line-height:1.02;
  letter-spacing:.01em;margin:0;color:#0d3a66;text-shadow:0 2px 10px rgba(13,58,102,.06)}
.big-heading span{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.rm-sec-desc{font-size:.98rem;line-height:1.9;color:#5f7186;margin:1rem 0 0;max-width:640px}

/* ---------- INTRO / STATS (glassmorphism) ---------- */
.rm-intro{position:relative;padding:96px 0 110px;background:#fff}
.intro-grid{display:grid;grid-template-columns:1.1fr .9fr;gap:5rem;align-items:center}
.intro-copy{font-size:1rem;line-height:1.95;color:#5f7186;margin-top:1.25rem;max-width:720px}
.stat-strip{display:grid;grid-template-columns:repeat(2,1fr);gap:1.1rem}
.stat-box{position:relative;padding:1.4rem;border-radius:22px;overflow:hidden;min-height:150px;
  background:rgba(255,255,255,.72);border:1px solid rgba(13,58,102,.16);
  box-shadow:0 18px 44px rgba(13,58,102,.08);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px)}
.stat-box::after{content:"";position:absolute;right:-26px;bottom:-30px;width:90px;height:90px;
  border:2px solid rgba(255,179,0,.25);transform:rotate(45deg)}
.stat-num{font-family:var(--font-display);font-size:clamp(2.2rem,4vw,3.1rem);font-weight:800;line-height:1;
  background:linear-gradient(135deg,#0d3a66,#2f6fa8);-webkit-background-clip:text;background-clip:text;
  -webkit-text-fill-color:transparent;color:#0d3a66}
.stat-label{font-size:.78rem;font-weight:800;letter-spacing:.04em;text-transform:uppercase;color:#5f7186;margin-top:.6rem}
.stat-label i{color:#ffb300;margin-right:.3rem}

/* ---------- PILAR STRATEGIS ---------- */
.rm-pillars{position:relative;padding:96px 0 110px;background:#fff}
.rm-pillars-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:1.2rem;margin-top:3rem}
.pillar-card{position:relative;background:#f7f9fc;border:1px solid #e3edf0;border-radius:22px;
  padding:1.7rem 1.4rem;overflow:hidden;transition:transform .35s ease,box-shadow .35s ease,border-color .35s ease;
  grid-column:span 2}
.pillar-card:nth-child(1),
.pillar-card:nth-child(2),
.pillar-card:nth-child(3){grid-column:span 2}
.pillar-card:nth-child(4),
.pillar-card:nth-child(5){grid-column:span 3}
.pillar-card::after{content:"";position:absolute;right:-24px;bottom:-28px;width:80px;height:80px;
  border:2px solid rgba(255,179,0,.22);transform:rotate(45deg);transition:transform .35s ease}
.pillar-card:hover{transform:translateY(-8px);box-shadow:0 26px 55px rgba(13,58,102,.14);border-color:rgba(13,58,102,.22)}
.pillar-card:hover::after{transform:rotate(90deg)}
.pillar-icon{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,#0d3a66,#2f6fa8);color:#ffd54a;font-size:1.3rem;
  box-shadow:0 12px 26px rgba(13,58,102,.28);margin-bottom:1.1rem;transition:transform .35s ease}
.pillar-card:hover .pillar-icon{transform:rotate(-8deg) scale(1.06)}
.pillar-no{font-size:.66rem;font-weight:900;letter-spacing:.14em;text-transform:uppercase;color:#ffb300}
.pillar-title{font-family:var(--font-display);font-size:1.12rem;font-weight:800;color:#0d3a66;margin:.4rem 0 .55rem}
.pillar-text{font-size:.83rem;line-height:1.75;color:#718396;margin:0}

/* ---------- ROADMAP JOURNEY — Enam Fase 2025→2030 (ALTERNATING TIMELINE) ---------- */
.rm-timeline-section{position:relative;padding:96px 0 120px;
  background:linear-gradient(180deg,#f7f9fc 0%,#eef5f8 100%)}
.rm-timeline-section::before{content:"";position:absolute;left:0;right:0;top:0;height:1px;
  background:linear-gradient(90deg,transparent,#b7cce0,transparent)}
.timeline-head{width:min(1240px,92%);margin:0 auto 64px;display:flex;justify-content:space-between;
  align-items:end;gap:2rem}
.timeline-head .big-heading{max-width:820px;font-size:clamp(2.6rem,5vw,5rem);line-height:1.04}
.timeline-head .eyebrow{color:#0d3a66}
.timeline-head .eyebrow::before{background:linear-gradient(90deg,#ffd54a,#ffb300)}
.timeline-note{max-width:340px;color:#718396;font-size:.8rem;line-height:1.7;text-align:right}

/* Journey container: satu garis vertikal pusat sebagai penghubung semua fase */
.rm-route{position:relative;width:min(1240px,92%);margin:auto;padding:10px 0 8px}
.rm-route::before{content:"";position:absolute;left:50%;top:0;bottom:0;width:3px;
  transform:translateX(-50%) scaleY(0);transform-origin:50% 0;
  background:linear-gradient(180deg,#0d3a66 0%,#2f6fa8 58%,#ffb300 100%);
  border-radius:99px;box-shadow:0 0 0 6px rgba(13,58,102,.05);
  transition:transform 1.4s cubic-bezier(.22,.61,.36,1) .15s}
.rm-route.rm-route--go::before{transform:translateX(-50%) scaleY(1)}

/* Phase: alternating — ganjil kiri, genap kanan, node di garis pusat */
.rm-phase{position:relative;display:grid;grid-template-columns:1fr 84px 1fr;
  column-gap:2rem;align-items:center;margin-bottom:2.1rem}
.rm-phase:last-child{margin-bottom:0}
.rm-phase-side{min-width:0}
.rm-phase-side--card{grid-column:1;grid-row:1}
.rm-phase-side--empty{grid-column:3;grid-row:1}
.rm-phase--even .rm-phase-side--card{grid-column:3}
.rm-phase--even .rm-phase-side--empty{grid-column:1}

/* Node tahun di garis pusat */
.rm-phase-node{position:relative;grid-column:2;grid-row:1;justify-self:center;z-index:3;
  width:62px;height:62px;border-radius:50%;
  background:linear-gradient(135deg,#0d3a66,#0a2d52);
  border:3px solid #eef5f8;color:#ffd54a;
  display:flex;flex-direction:column;align-items:center;justify-content:center;
  box-shadow:0 10px 24px rgba(13,58,102,.32)}
.rm-phase-node i{font-size:1.1rem;line-height:1}
.rm-phase-node span{font-size:.54rem;font-weight:900;letter-spacing:.08em;margin-top:3px;color:rgba(255,213,74,.92)}
.rm-phase--goal .rm-phase-node{width:74px;height:74px;
  background:linear-gradient(135deg,#ffd54a,#ffb300 55%,#ff8a00);
  border-color:#fff;color:#0a2d52;
  box-shadow:0 0 0 8px rgba(255,179,0,.14),0 16px 36px rgba(255,138,0,.4)}
.rm-phase--goal .rm-phase-node span{color:#0a2d52}

/* Card fase */
.rm-phase-card{position:relative;display:flex;flex-direction:column;
  background:#fff;border:1px solid #e3edf0;border-radius:22px;
  padding:1.6rem 1.6rem 1.45rem;overflow:hidden;
  box-shadow:0 14px 34px rgba(13,58,102,.07);
  backdrop-filter:blur(2px);-webkit-backdrop-filter:blur(2px);
  transition:transform .35s ease,box-shadow .35s ease,border-color .35s ease}
.rm-phase-card::before{content:"";position:absolute;top:0;left:0;right:0;height:4px;
  background:linear-gradient(90deg,#0d3a66,#2f6fa8)}
.rm-phase-card:hover{transform:translateY(-6px);box-shadow:0 24px 50px rgba(13,58,102,.15);border-color:rgba(13,58,102,.22)}
.rm-phase-no{position:absolute;top:.45rem;right:1.1rem;font-family:var(--font-display);
  font-size:clamp(2.4rem,3.6vw,3.9rem);font-weight:900;line-height:1;color:rgba(13,58,102,.08);pointer-events:none}
.rm-phase-meta{display:flex;align-items:center;gap:.6rem;margin-bottom:.45rem}
.rm-phase-kick{font-size:.66rem;font-weight:900;letter-spacing:.14em;text-transform:uppercase;color:#0a2d52;
  background:linear-gradient(135deg,#e8f1f8,#edf4fa);border:1px solid rgba(13,58,102,.14);
  padding:.3rem .6rem;border-radius:999px}
.rm-phase-year{font-family:var(--font-display);font-size:1.15rem;font-weight:900;color:#ffb300}
.rm-phase-title{font-family:var(--font-display);font-size:1.16rem;font-weight:800;color:#0d3a66;
  margin:0 0 .55rem;padding-right:2.6rem}
.rm-phase-text{font-size:.85rem;line-height:1.78;color:#718396;margin:0}
.rm-phase-list{list-style:none;margin:.7rem 0 0;padding:0;display:grid;gap:.35rem}
.rm-phase-list li{position:relative;padding-left:1.2rem;font-size:.79rem;line-height:1.65;color:#5f7186}
.rm-phase-list li::before{content:"\f00c";font-family:"Font Awesome 6 Free";font-weight:900;
  position:absolute;left:0;top:.08rem;font-size:.62rem;color:#ffb300}
.rm-phase-tag{display:inline-flex;margin-top:1rem;padding:.35rem .68rem;border-radius:999px;
  background:linear-gradient(135deg,#e8f1f8,#edf4fa);color:#0a2d52;font-size:.66rem;font-weight:900;
  text-transform:uppercase;letter-spacing:.08em;border:1px solid rgba(13,58,102,.18);align-self:flex-start}
.rm-phase--goal .rm-phase-card{border-color:rgba(255,179,0,.42);
  background:linear-gradient(180deg,#fff,#fff8ea);box-shadow:0 20px 50px rgba(255,138,0,.13)}
.rm-phase--goal .rm-phase-card::before{background:linear-gradient(90deg,#ffd54a,#ff8a00)}
.rm-phase--goal .rm-phase-no{color:rgba(255,138,0,.13)}
.rm-phase--goal .rm-phase-tag{background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52;border-color:transparent}
.rm-phase-goal-badge{display:inline-flex;align-items:center;gap:.45rem;margin-bottom:.7rem;
  padding:.34rem .7rem;border-radius:999px;font-size:.66rem;font-weight:900;letter-spacing:.1em;
  text-transform:uppercase;color:#0a2d52;background:linear-gradient(135deg,#ffe66d,#ffc107 55%,#ff9d00);
  box-shadow:0 8px 20px rgba(255,138,0,.3);align-self:flex-start}

/* Destination marker 2030 — endpoint besar di akhir roadmap */
.rm-dest{position:relative;display:flex;flex-direction:column;align-items:center;margin-top:3.4rem;text-align:center}
.rm-dest::before{content:"";position:absolute;top:-2.9rem;left:50%;transform:translateX(-50%);
  width:3px;height:2.9rem;border-radius:99px;
  background:linear-gradient(180deg,#ffb300,#ff8a00);box-shadow:0 0 12px rgba(255,138,0,.35)}
.rm-dest::after{content:"";position:absolute;top:calc(50% - 116px);left:50%;transform:translate(-50%,-50%);
  width:232px;height:232px;border:1px dashed rgba(255,179,0,.32);border-radius:50%;pointer-events:none}
.rm-dest-node{position:relative;z-index:2;width:150px;height:150px;border-radius:50%;
  background:radial-gradient(circle at 32% 26%,#ffe66d 0%,#ffc107 48%,#ff8a00 100%);
  border:4px solid #fff;color:#0a2d52;
  display:flex;flex-direction:column;align-items:center;justify-content:center;
  font-family:var(--font-display);font-weight:900;line-height:1;
  box-shadow:0 0 0 12px rgba(255,179,0,.12),0 0 0 26px rgba(255,179,0,.05),0 24px 60px rgba(255,138,0,.38);
  animation:rmPulse 3s ease-in-out infinite}
.rm-dest-node b{font-size:2.7rem;letter-spacing:.01em}
.rm-dest-node span{font-size:.6rem;font-weight:900;letter-spacing:.24em;margin-top:6px;text-transform:uppercase;color:#0a2d52;opacity:.72}
@keyframes rmPulse{
  0%,100%{box-shadow:0 0 0 12px rgba(255,179,0,.12),0 0 0 26px rgba(255,179,0,.05),0 24px 60px rgba(255,138,0,.38)}
  50%{box-shadow:0 0 0 16px rgba(255,179,0,.17),0 0 0 34px rgba(255,179,0,.07),0 24px 66px rgba(255,138,0,.46)}}
.rm-dest-label{margin-top:1.4rem;font-size:.8rem;font-weight:900;letter-spacing:.16em;text-transform:uppercase;color:#0d3a66}
.rm-dest-label span{color:#ff8a00}
.rm-dest-sub{font-size:.92rem;color:#5f7186;line-height:1.7;margin-top:.4rem;max-width:420px}

/* ---------- FUTURE BAND (target 2030) ---------- */
.rm-future{position:relative;padding:100px 0 110px;background:#fff;overflow:hidden}
.rm-future::after{content:"2030";position:absolute;right:-1%;top:50%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(7rem,24vw,22rem);font-weight:900;line-height:.8;
  color:rgba(13,58,102,.045);-webkit-text-stroke:1px rgba(13,58,102,.06);
  pointer-events:none;white-space:nowrap;user-select:none}
.rm-future-inner{position:relative;z-index:2;width:min(1200px,92%);margin:auto;
  display:grid;grid-template-columns:1.05fr .95fr;gap:4rem;align-items:center}
.rm-future-card{position:relative;background:linear-gradient(135deg,#0b3558,#0d3a66 55%,#123f6e);color:#fff;
  border-radius:26px;padding:2.6rem;overflow:hidden;box-shadow:0 34px 80px rgba(13,58,102,.28)}
.rm-future-card::after{content:"";position:absolute;right:-40px;bottom:-46px;width:150px;height:150px;
  border:3px solid rgba(255,213,74,.22);transform:rotate(45deg)}
.rm-future-card .eyebrow{color:#6fa8d0}
.rm-future-card .eyebrow::before{background:linear-gradient(90deg,#ffd54a,#ffb300)}
.rm-future-card h3{font-family:var(--font-display);font-size:clamp(1.7rem,3.4vw,2.7rem);line-height:1.08;margin:0 0 1rem}
.rm-future-card h3 span{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.rm-future-card p{color:rgba(235,245,253,.82);line-height:1.85;font-size:.95rem}
.rm-future-targets{display:grid;gap:1rem;margin-top:1.6rem}
.rm-target{display:flex;gap:.9rem;align-items:flex-start;background:rgba(255,255,255,.07);
  border:1px solid rgba(255,255,255,.14);border-radius:16px;padding:.95rem 1.1rem;
  backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);transition:transform .3s ease,background .3s ease}
.rm-target:hover{transform:translateX(6px);background:rgba(255,255,255,.11)}
.rm-target i{color:#ffd54a;font-size:1rem;margin-top:.15rem}
.rm-target strong{display:block;font-size:.9rem;font-weight:900}
.rm-target span{font-size:.78rem;color:rgba(235,245,253,.72);line-height:1.6}
.rm-future-visual{position:relative}
.rm-goal{position:relative;background:#f7f9fc;border:1px solid #e3edf0;border-radius:24px;padding:2.2rem;
  box-shadow:0 24px 55px rgba(13,58,102,.09);overflow:hidden}
.rm-goal::after{content:"";position:absolute;left:-30px;top:-30px;width:110px;height:110px;
  border:2px solid rgba(255,179,0,.3);transform:rotate(45deg)}
.rm-goal-num{font-family:var(--font-display);font-size:clamp(4rem,9vw,6.6rem);font-weight:900;line-height:.9;
  background:linear-gradient(135deg,#0d3a66,#2f6fa8);-webkit-background-clip:text;background-clip:text;
  -webkit-text-fill-color:transparent;color:#0d3a66}
.rm-goal-label{font-size:.78rem;font-weight:900;letter-spacing:.14em;text-transform:uppercase;color:#ffb300;margin-top:.6rem}
.rm-goal h4{font-family:var(--font-display);font-size:1.4rem;color:#0d3a66;margin:1rem 0 .6rem}
.rm-goal p{font-size:.88rem;line-height:1.8;color:#5f7186;margin:0}
.rm-goal-metrics{display:grid;grid-template-columns:1fr 1fr;gap:.8rem;margin-top:1.5rem}
.rm-goal-metric{background:#fff;border:1px solid #e3edf0;border-radius:14px;padding:.85rem 1rem}
.rm-goal-metric b{display:block;font-family:var(--font-display);font-size:1.25rem;color:#0d3a66}
.rm-goal-metric span{font-size:.68rem;font-weight:800;letter-spacing:.06em;text-transform:uppercase;color:#718396}

/* ---------- CTA PENUTUP (compact closing invitation) ---------- */
.rm-cta{position:relative;width:min(1000px,92%);margin:4.6rem auto 0;padding:54px 40px 62px;overflow:hidden;text-align:center;isolation:isolate;
  border-radius:26px;background:linear-gradient(135deg,#0b3558,#0d3a66 45%,#0d3a66);color:#fff;box-shadow:0 28px 70px rgba(13,58,102,.18)}
.rm-cta::after{content:"SKANEDA";position:absolute;left:50%;bottom:-16px;transform:translateX(-50%);
  font-family:var(--font-display);font-size:clamp(2.4rem,6.5vw,5.6rem);font-weight:900;line-height:1;
  letter-spacing:.05em;color:rgba(255,255,255,.04);-webkit-text-stroke:1px rgba(255,255,255,.05);
  pointer-events:none;white-space:nowrap;user-select:none}
.rm-cta-inner{position:relative;z-index:2;width:min(1140px,92%);margin:auto}
.rm-cta h3{font-family:var(--font-display);font-size:clamp(2rem,4vw,3.8rem);line-height:1.1;margin:0 0 .9rem}
.rm-cta h3 span{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.rm-cta p{color:rgba(235,245,253,.8);line-height:1.75;max-width:660px;font-size:1.02rem;margin:0 auto 1.7rem}
.rm-cta-btn{display:inline-flex;align-items:center;gap:.6rem;padding:.88rem 1.7rem;border-radius:999px;
  background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:.9rem;font-weight:900;
  text-decoration:none;box-shadow:0 14px 34px rgba(255,138,0,.35);transition:transform .3s ease,box-shadow .3s ease}
.rm-cta-btn:hover{transform:translateY(-4px);box-shadow:0 20px 40px rgba(255,138,0,.48)}
.rm-cta-btn i{transition:transform .3s ease}
.rm-cta-btn:hover i{transform:translateX(5px)}
.rm-cta-btn:hover i{transform:translateX(5px)}

/* ---------- ORNAMEN (home-orn) ---------- */
.home-orn{position:absolute;inset:0;z-index:0;pointer-events:none;overflow:hidden}
.home-orn .ho-chevron{position:absolute;width:360px;height:360px;
  border-top:2px solid rgba(13,58,102,.11);border-right:2px solid rgba(13,58,102,.11);transform:rotate(45deg)}
.home-orn .ho-chevron::after{content:"";position:absolute;inset:34px;
  border-top:2px solid rgba(47,111,168,.09);border-right:2px solid rgba(47,111,168,.09)}
.home-orn .ho-line{position:absolute;width:310px;height:2px;
  background:linear-gradient(90deg,transparent,#2f6fa8,transparent);opacity:.25;transform:rotate(-42deg)}
.home-orn .ho-line::after{content:"";position:absolute;left:70px;top:11px;width:190px;height:1px;
  background:linear-gradient(90deg,transparent,#ffd54a,transparent)}
.home-orn .ho-dots{position:absolute;width:125px;height:125px;
  background-image:radial-gradient(circle,#2f6fa8 2px,transparent 2.8px);
  background-size:18px 18px;opacity:.38}
.home-orn .ho-ring{position:absolute;width:170px;height:170px;border:1px solid rgba(13,58,102,.13);
  border-radius:50%;box-shadow:0 0 0 20px rgba(13,58,102,.025),0 0 0 42px rgba(255,213,74,.025)}
.home-orn .ho-ring::before{content:"";position:absolute;inset:22px;border:1px dashed rgba(47,111,168,.18);border-radius:50%}
.home-orn .ho-gold{position:absolute;width:52px;height:8px;border-radius:99px;
  background:linear-gradient(90deg,#ffd54a,#ffb300,#ff7a00);
  box-shadow:0 8px 22px rgba(255,179,0,.18);transform:rotate(-35deg)}
.home-orn .ho-square{position:absolute;width:58px;height:58px;border:2px solid rgba(255,179,0,.32);transform:rotate(45deg)}
.home-orn .ho-square::before{content:"";position:absolute;inset:10px;border:1px solid rgba(13,58,102,.18)}
.home-orn .ho-corner{position:absolute;width:110px;height:110px;
  border-left:3px solid rgba(13,58,102,.12);border-bottom:3px solid rgba(13,58,102,.12)}
.home-orn .ho-corner::after{content:"";position:absolute;left:18px;bottom:18px;width:46px;height:3px;
  background:#ffd54a;border-radius:99px}

.rm-hero .home-orn .ho-chevron{left:-150px;bottom:-60px;border-color:rgba(255,255,255,.10)}
.rm-hero .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.rm-hero .home-orn .ho-line{right:-80px;top:22%;opacity:.22}
.rm-hero .home-orn .ho-dots{right:6%;bottom:14%;opacity:.3}
.rm-hero .home-orn .ho-ring{left:44%;bottom:-90px;border-color:rgba(255,255,255,.12)}
.rm-hero .home-orn .ho-gold{right:16%;top:20%}
.rm-hero .home-orn .ho-square{left:12%;top:22%}

.rm-intro .home-orn .ho-chevron{right:-145px;top:45px}
.rm-intro .home-orn .ho-line{left:-80px;top:170px}
.rm-intro .home-orn .ho-dots{left:3%;bottom:100px}
.rm-intro .home-orn .ho-ring{right:8%;bottom:90px}
.rm-intro .home-orn .ho-gold{right:16%;top:22%}
.rm-intro .home-orn .ho-square{left:11%;top:15%}
.rm-intro .home-orn .ho-corner{right:3%;bottom:8%;transform:rotate(180deg)}

.rm-pillars .home-orn .ho-chevron{left:-145px;bottom:-60px}
.rm-pillars .home-orn .ho-line{right:-80px;bottom:170px}
.rm-pillars .home-orn .ho-dots{right:4%;top:90px}
.rm-pillars .home-orn .ho-ring{left:7%;top:70px}
.rm-pillars .home-orn .ho-gold{left:20%;top:30%}
.rm-pillars .home-orn .ho-square{right:12%;bottom:20%}
.rm-pillars .home-orn .ho-corner{left:3%;bottom:8%}

.rm-timeline-section .home-orn .ho-chevron{right:-145px;top:45px}
.rm-timeline-section .home-orn .ho-line{left:-80px;top:170px}
.rm-timeline-section .home-orn .ho-dots{left:3%;bottom:100px}
.rm-timeline-section .home-orn .ho-ring{right:8%;bottom:90px}
.rm-timeline-section .home-orn .ho-gold{right:16%;top:22%}
.rm-timeline-section .home-orn .ho-square{left:11%;top:15%}
.rm-timeline-section .home-orn .ho-corner{right:3%;bottom:8%;transform:rotate(180deg)}

.rm-future .home-orn .ho-chevron{left:-130px;bottom:-60px}
.rm-future .home-orn .ho-dots{right:6%;top:24%;opacity:.25}
.rm-future .home-orn .ho-ring{left:5%;top:20%}
.rm-future .home-orn .ho-gold{left:16%;bottom:18%}
.rm-future .home-orn .ho-square{right:14%;bottom:14%}

.rm-cta .home-orn .ho-chevron{left:-120px;bottom:-80px;border-color:rgba(255,255,255,.07)}
.rm-cta .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.06)}
.rm-cta .home-orn .ho-dots{left:8%;top:30%;opacity:.14}
.rm-cta .home-orn .ho-ring{right:-70px;top:20%;border-color:rgba(255,255,255,.07)}
.rm-cta .home-orn .ho-gold{left:20%;bottom:26%}
.rm-cta .home-orn .ho-gold{left:20%;bottom:26%}

.rm-hero>*:not(.home-orn),
.rm-intro>*:not(.home-orn),
.rm-pillars>*:not(.home-orn),
.rm-timeline-section>*:not(.home-orn),
.rm-future>*:not(.home-orn),
.rm-cta>*:not(.home-orn){position:relative;z-index:2}

/* ---------- ORNAMEN HALAMAN (fixed diamonds) ---------- */
.rm-page::before{content:"";position:fixed;right:-110px;top:18%;width:230px;height:230px;
  border:2px solid rgba(13,58,102,.14);transform:rotate(45deg);z-index:0;pointer-events:none}
.rm-page::after{content:"";position:fixed;left:-95px;bottom:10%;width:190px;height:190px;
  border:2px solid rgba(47,111,168,.14);border-radius:28px;transform:rotate(25deg);z-index:0;pointer-events:none}

/* ---------- HOVER LANGUAGE (keluarga Sejarah) ---------- */
.rm-page .eyebrow,.rm-page .hero-photo,.rm-page .big-heading,
.rm-page .rm-title,.rm-page .stat-box,.rm-page .rm-phase-card,.rm-page .pillar-card{transition:transform .35s ease,box-shadow .35s ease,
  filter .35s ease,border-color .35s ease,background .35s ease}
.rm-page .rm-kicker:hover{transform:translateX(7px);filter:drop-shadow(0 5px 12px rgba(255,213,74,.2))}
.rm-page .eyebrow:hover{transform:translateX(6px)}
.rm-page .hero-photo:hover{transform:translateY(-42px) rotate(0deg) scale(1.015);
  box-shadow:0 45px 95px rgba(13,58,102,.35),0 18px 35px rgba(0,0,0,.22)}
.rm-page .hero-photo:hover img{transform:scale(1.07)}
.rm-page .big-heading:hover{transform:translateX(4px)}
.rm-page .rm-phase-card:hover{transform:translateY(-9px) scale(1.015);border-color:rgba(13,58,102,.22);box-shadow:0 30px 65px rgba(13,58,102,.2)}
.rm-page .rm-phase-card:hover::before{height:6px}
.rm-page .rm-phase-node i{transition:transform .3s ease}
.rm-page .rm-phase-node:hover i{transform:scale(1.18)}

/* ---------- SCROLL REVEAL (keluarga Sejarah) ---------- */
[data-reveal]{opacity:0;transform:translateY(36px);
  transition:opacity .7s ease,transform .7s var(--ease, ease)}
[data-reveal="left"]{transform:translateX(-46px)}
[data-reveal="right"]{transform:translateX(46px)}
[data-reveal].revealed{opacity:1;transform:none}
[data-reveal]{transition-delay:calc(var(--d,0)*90ms)}

/* ---------- RESPONSIVE ---------- */
@media(max-width:1200px){
  .rm-pillars-grid{grid-template-columns:repeat(2,1fr)}
  .pillar-card,.pillar-card:nth-child(n){grid-column:span 1}
  .rm-future-inner{grid-template-columns:1fr;gap:2.5rem}
}
@media(max-width:1100px){
  .rm-route::before{left:28px;transform:scaleY(0);transform-origin:50% 0}
  .rm-route.rm-route--go::before{transform:scaleY(1)}
  .rm-phase{grid-template-columns:56px 1fr;column-gap:1rem;align-items:start;margin-bottom:1.5rem}
  .rm-phase-side--card{grid-column:2;grid-row:1}
  .rm-phase-side--empty{display:none}
  .rm-phase--even .rm-phase-side--card{grid-column:2}
  .rm-phase-node{position:relative;grid-column:1;grid-row:1;margin-top:1.1rem;width:56px;height:56px;justify-self:center}
  .rm-phase--goal .rm-phase-node{width:64px;height:64px;margin-top:1.05rem}
  .rm-dest{display:grid;grid-template-columns:56px 1fr;column-gap:1rem;align-items:center;margin-top:1.4rem;text-align:left}
  .rm-dest::before,.rm-dest::after{display:none}
  .rm-dest-node{grid-column:1;grid-row:1;justify-self:center;width:64px;height:64px;border-width:3px;animation:none}
  .rm-dest-node b{font-size:1.35rem}
  .rm-dest-node span{display:none}
  .rm-dest-label{grid-column:2;grid-row:1;margin:0;font-size:.72rem;letter-spacing:.14em}
  .rm-dest-sub{grid-column:2;grid-row:2;margin:.25rem 0 0;font-size:.86rem;max-width:100%}
}
@media(max-width:950px){
  .rm-hero-inner{grid-template-columns:1fr;gap:2rem}
  .hero-photo{height:360px;transform:translateY(-18px) rotate(1deg)}
  .intro-grid{grid-template-columns:1fr;gap:3rem}
  .timeline-head{flex-direction:column;align-items:flex-start;gap:1rem}
  .timeline-note{text-align:left}
}
@media(max-width:700px){
  .rm-hero{min-height:0;align-items:flex-start}
  .rm-hero-inner{padding:clamp(3rem,8vh,4.5rem) 5% 3.6rem;width:90%}
  .rm-hero::after{font-size:clamp(3.6rem,22vw,6rem);opacity:.6;right:-4%}
  .rm-title{font-size:clamp(2.4rem,11vw,3.6rem);margin-top:0}
  .hero-photo{height:300px}
  .rm-section,.rm-intro,.rm-pillars{padding:85px 0 90px}
  .rm-timeline-section{padding:85px 0 90px}
  .rm-future{padding:80px 0 90px}
  .rm-page{padding-bottom:9rem}
  .rm-cta{margin-top:3.2rem;padding:46px 22px 54px;margin-bottom:0;width:92%;border-radius:22px}
  .rm-cta h3{font-size:clamp(1.9rem,8vw,2.5rem)}
  .rm-cta p{font-size:.95rem;line-height:1.7;max-width:100%}
  .rm-cta-btn{padding:.8rem 1.45rem;font-size:.86rem}
  .rm-cta::after{font-size:clamp(1.9rem,9vw,3.4rem);bottom:-10px}

  .rm-pillars-grid{grid-template-columns:1fr}
  .pillar-card,.pillar-card:nth-child(n){grid-column:span 1}
  .stat-strip{grid-template-columns:repeat(2,1fr)}
  .rm-timeline-section{padding:70px 0 84px}
  .timeline-head{margin-bottom:46px}
  .timeline-head .big-heading{font-size:clamp(2rem,8.5vw,2.8rem)}
  .rm-route::before{left:26px}
  .rm-phase{grid-template-columns:52px 1fr;column-gap:.85rem;margin-bottom:1.3rem}
  .rm-phase-node{width:48px;height:48px;margin-top:1.05rem}
  .rm-phase-node i{font-size:.95rem}
  .rm-phase-node span{font-size:.48rem}
  .rm-phase--goal .rm-phase-node{width:56px;height:56px;margin-top:.95rem}
  .rm-phase-card{padding:1.2rem 1.1rem 1.1rem;border-radius:20px}
  .rm-phase-no{font-size:2.2rem;top:.4rem;right:.7rem}
  .rm-dest{grid-template-columns:52px 1fr;margin-top:1rem}
  .rm-dest-node{width:60px;height:60px}
  .rm-dest-node b{font-size:1.25rem}
  .rm-dest-sub{font-size:.82rem}
  .rm-phase-title{font-size:1.02rem;padding-right:2rem}
  .rm-phase-text{font-size:.8rem}
  .rm-phase-list li{font-size:.75rem}
  .rm-phase-meta{margin-bottom:.35rem}
  .rm-future-inner{grid-template-columns:1fr}
  .home-orn .ho-chevron{width:220px;height:220px}
  .home-orn .ho-dots{width:80px;height:80px;background-size:14px 14px}
  .home-orn .ho-ring{width:110px;height:110px}
  .home-orn .ho-line{width:190px}
  .home-orn .ho-square{width:42px;height:42px}
  .home-orn .ho-corner{width:70px;height:70px}
  .rm-hero .home-orn .ho-chevron{left:-120px;bottom:-40px}
  [data-reveal]{opacity:1;transform:none}
}
@media(max-width:460px){
  .stat-strip{grid-template-columns:1fr}
  .rm-goal-metrics{grid-template-columns:1fr}
}
</style>
@endpush

@section('content')
<div class="rm-page">

  <!-- HERO -->
  <section class="rm-hero">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="rm-hero-inner">
      <div>
        <div class="rm-kicker">Peta Jalan Pengembangan Sekolah</div>
        <h1 class="rm-title">
          <span class="rm-white">ROADMAP</span> <span class="rm-gold">SKANEDA</span>
        </h1>
        <div class="rm-hero-meta" aria-label="Ringkasan roadmap">
          <span class="rm-pill"><i class="fas fa-route"></i> Roadmap 2025&ndash;2030</span>
          <span class="rm-pill"><i class="fas fa-layer-group"></i> 6 Fase Pengembangan</span>
          <span class="rm-pill"><i class="fas fa-flag-checkered"></i> Target 2030</span>
        </div>
      </div>

      <div class="hero-photo" data-reveal="right">
        <img src="{{ asset('images/smkn-guru.jpg') }}" alt="Keluarga besar SMK Negeri 2 Mojokerto" loading="eager">
        <div class="hero-photo-caption"><strong>Roadmap Skaneda</strong><span>Bersama melangkah menuju vokasi unggul.</span></div>
      </div>
    </div>
  </section>

  <!-- INTRO / STATS -->
  <section class="rm-intro">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="rm-wide">
      <div class="intro-grid">
        <div data-reveal>
          <div class="eyebrow">Arah pengembangan</div>
          <h2 class="big-heading">Melangkah pasti, <span>berkarya nyata.</span></h2>
          <p class="intro-copy">Roadmap ini menjadi penunjuk arah bersama bagi seluruh warga sekolah: guru, tenaga kependidikan, peserta didik, orang tua, hingga mitra dunia usaha dan industri. Setiap fase dirancang dengan target konkret, indikator keberhasilan, dan semangat gotong royong — agar setiap langkah kecil hari ini bermuara pada lompatan besar di masa depan.</p>
        </div>
        <div class="stat-strip" data-reveal="right">
          <div class="stat-box">
            <div class="stat-num">6</div>
            <div class="stat-label"><i class="fas fa-route"></i> Fase Pengembangan</div>
          </div>
          <div class="stat-box">
            <div class="stat-num">5</div>
            <div class="stat-label"><i class="fas fa-layer-group"></i> Pilar Strategis</div>
          </div>
          <div class="stat-box">
            <div class="stat-num">2030</div>
            <div class="stat-label"><i class="fas fa-flag-checkered"></i> Target Nasional</div>
          </div>
          <div class="stat-box">
            <div class="stat-num">25+</div>
            <div class="stat-label"><i class="fas fa-bullseye"></i> Program Prioritas</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PILAR STRATEGIS -->
  <section class="rm-pillars">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="rm-wide">
      <div data-reveal>
        <div class="eyebrow">Pilar strategis</div>
        <h2 class="big-heading">Lima pilar yang <span>menopang perjalanan.</span></h2>
        <p class="rm-sec-desc">Seluruh program dalam roadmap bertumpu pada lima pilar strategis yang saling memperkuat — dari mutu pembelajaran hingga budaya sekolah.</p>
      </div>

      <div class="rm-pillars-grid">
        <article class="pillar-card" data-reveal>
          <div class="pillar-icon"><i class="fas fa-book-open-reader"></i></div>
          <div class="pillar-no">Pilar 01</div>
          <h3 class="pillar-title">Mutu Pembelajaran &amp; Kurikulum</h3>
          <p class="pillar-text">Kurikulum merdeka yang diselaraskan dengan kebutuhan industri, pembelajaran berbasis proyek nyata, serta asesmen yang mendorong kompetensi dan karakter.</p>
        </article>

        <article class="pillar-card" data-reveal style="--d:1">
          <div class="pillar-icon"><i class="fas fa-laptop-code"></i></div>
          <div class="pillar-no">Pilar 02</div>
          <h3 class="pillar-title">Digitalisasi Sekolah</h3>
          <p class="pillar-text">Layanan administrasi digital, pembelajaran berbasis teknologi, perpustakaan elektronik, serta data terpadu untuk pengambilan keputusan yang lebih baik.</p>
        </article>

        <article class="pillar-card" data-reveal style="--d:2">
          <div class="pillar-icon"><i class="fas fa-handshake"></i></div>
          <div class="pillar-no">Pilar 03</div>
          <h3 class="pillar-title">Kemitraan DUDI</h3>
          <p class="pillar-text">Penguatan teaching factory, magang industri, guru tamu dari praktisi, serta sertifikasi kompetensi bersama dunia usaha dan industri.</p>
        </article>

        <article class="pillar-card" data-reveal style="--d:3">
          <div class="pillar-icon"><i class="fas fa-users-gear"></i></div>
          <div class="pillar-no">Pilar 04</div>
          <h3 class="pillar-title">Penguatan SDM</h3>
          <p class="pillar-text">Pengembangan profesional guru dan tenaga kependidikan, sertifikasi keahlian, serta budaya belajar sepanjang hayat bagi seluruh warga sekolah.</p>
        </article>

        <article class="pillar-card" data-reveal style="--d:4">
          <div class="pillar-icon"><i class="fas fa-heart"></i></div>
          <div class="pillar-no">Pilar 05</div>
          <h3 class="pillar-title">Budaya &amp; Karakter</h3>
          <p class="pillar-text">Penguatan profil pelajar Pancasila, lingkungan sekolah yang aman dan menyenangkan, serta budaya gotong royong yang menyehatkan.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- TIMELINE FASE 2025-2030 (ROADMAP JOURNEY) -->
  <section class="rm-timeline-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="timeline-head" data-reveal>
      <div><div class="eyebrow">The roadmap</div><h2 class="big-heading">Enam fase menuju <span>2030.</span></h2></div>
      <div class="timeline-note">Geser ke bawah untuk menelusuri setiap fase pengembangan &mdash; dari fondasi yang kuat hingga target menjadi sekolah vokasi rujukan nasional.</div>
    </div>

    <div class="rm-route" id="rmRoute">
      <article class="rm-phase rm-phase--odd" data-reveal="left">
        <div class="rm-phase-side rm-phase-side--card">
          <div class="rm-phase-card">
            <span class="rm-phase-no">01</span>
            <div class="rm-phase-meta"><span class="rm-phase-kick">Fase 1</span><span class="rm-phase-year">2025</span></div>
            <h3 class="rm-phase-title">Fondasi Penguatan</h3>
            <p class="rm-phase-text">Memperkuat fondasi layanan pendidikan: tata kelola, mutu pembelajaran, dan kesiapan seluruh warga sekolah menghadapi transformasi.</p>
            <ul class="rm-phase-list">
              <li>Penyusunan rencana strategis &amp; evaluasi diri sekolah</li>
              <li>Penguatan kurikulum merdeka di seluruh kompetensi keahlian</li>
              <li>Peremajaan sarana prasarana pendukung pembelajaran</li>
            </ul>
            <span class="rm-phase-tag">Fondasi</span>
          </div>
        </div>
        <div class="rm-phase-node"><i class="fas fa-seedling"></i><span>2025</span></div>
        <div class="rm-phase-side rm-phase-side--empty" aria-hidden="true"></div>
      </article>

      <article class="rm-phase rm-phase--even" data-reveal="right" style="--d:1">
        <div class="rm-phase-side rm-phase-side--card">
          <div class="rm-phase-card">
            <span class="rm-phase-no">02</span>
            <div class="rm-phase-meta"><span class="rm-phase-kick">Fase 2</span><span class="rm-phase-year">2026</span></div>
            <h3 class="rm-phase-title">Digitalisasi Layanan</h3>
            <p class="rm-phase-text">Menghadirkan layanan sekolah berbasis digital yang cepat, transparan, dan mudah diakses oleh peserta didik, orang tua, dan masyarakat.</p>
            <ul class="rm-phase-list">
              <li>Sistem informasi sekolah terpadu (akademik &amp; administrasi)</li>
              <li>Perpustakaan digital &amp; pembelajaran berbasis LMS</li>
              <li>Penerimaan peserta didik baru secara daring</li>
            </ul>
            <span class="rm-phase-tag">Transformasi</span>
          </div>
        </div>
        <div class="rm-phase-node"><i class="fas fa-laptop-code"></i><span>2026</span></div>
        <div class="rm-phase-side rm-phase-side--empty" aria-hidden="true"></div>
      </article>

      <article class="rm-phase rm-phase--odd" data-reveal="left" style="--d:2">
        <div class="rm-phase-side rm-phase-side--card">
          <div class="rm-phase-card">
            <span class="rm-phase-no">03</span>
            <div class="rm-phase-meta"><span class="rm-phase-kick">Fase 3</span><span class="rm-phase-year">2027</span></div>
            <h3 class="rm-phase-title">Penguatan Kemitraan DUDI</h3>
            <p class="rm-phase-text">Menjadikan dunia usaha dan industri sebagai mitra sejati &mdash; dari perancangan kurikulum hingga penyerapan lulusan.</p>
            <ul class="rm-phase-list">
              <li>Teaching factory berjalan di seluruh kompetensi keahlian</li>
              <li>Magang industri &amp; guru tamu dari praktisi</li>
              <li>Sertifikasi kompetensi bersama mitra DUDI</li>
            </ul>
            <span class="rm-phase-tag">Kemitraan</span>
          </div>
        </div>
        <div class="rm-phase-node"><i class="fas fa-handshake"></i><span>2027</span></div>
        <div class="rm-phase-side rm-phase-side--empty" aria-hidden="true"></div>
      </article>

      <article class="rm-phase rm-phase--even" data-reveal="right" style="--d:3">
        <div class="rm-phase-side rm-phase-side--card">
          <div class="rm-phase-card">
            <span class="rm-phase-no">04</span>
            <div class="rm-phase-meta"><span class="rm-phase-kick">Fase 4</span><span class="rm-phase-year">2028</span></div>
            <h3 class="rm-phase-title">Peningkatan Mutu &amp; Prestasi</h3>
            <p class="rm-phase-text">Mendorong budaya unggul: prestasi akademik dan non-akademik, inovasi guru, serta capaian kompetensi lulusan yang diakui industri.</p>
            <ul class="rm-phase-list">
              <li>Pembinaan intensif lomba &amp; kompetisi siswa (LKS, OSN)</li>
              <li>Sertifikasi keahlian guru &amp; program guru penggerak</li>
              <li>Kemitraan kampus &amp; program link and match lanjutan</li>
            </ul>
            <span class="rm-phase-tag">Prestasi</span>
          </div>
        </div>
        <div class="rm-phase-node"><i class="fas fa-trophy"></i><span>2028</span></div>
        <div class="rm-phase-side rm-phase-side--empty" aria-hidden="true"></div>
      </article>

      <article class="rm-phase rm-phase--odd" data-reveal="left" style="--d:4">
        <div class="rm-phase-side rm-phase-side--card">
          <div class="rm-phase-card">
            <span class="rm-phase-no">05</span>
            <div class="rm-phase-meta"><span class="rm-phase-kick">Fase 5</span><span class="rm-phase-year">2029</span></div>
            <h3 class="rm-phase-title">Menuju Sekolah Pusat Keunggulan</h3>
            <p class="rm-phase-text">Memantapkan posisi sebagai sekolah menengah kejuruan pusat keunggulan dengan layanan, fasilitas, dan hasil yang berstandar nasional.</p>
            <ul class="rm-phase-list">
              <li>Akreditasi unggul &amp; penjaminan mutu berkelanjutan</li>
              <li>Fasilitas laboratorium &amp; bengkel berstandar industri</li>
              <li>Publikasi praktik baik &amp; berbagi ke sekolah lain</li>
            </ul>
            <span class="rm-phase-tag">Keunggulan</span>
          </div>
        </div>
        <div class="rm-phase-node"><i class="fas fa-medal"></i><span>2029</span></div>
        <div class="rm-phase-side rm-phase-side--empty" aria-hidden="true"></div>
      </article>

      <article class="rm-phase rm-phase--even rm-phase--goal" data-reveal="right" style="--d:5">
        <div class="rm-phase-side rm-phase-side--card">
          <div class="rm-phase-card">
            <span class="rm-phase-no">06</span>
            <div class="rm-phase-goal-badge"><i class="fas fa-flag-checkered"></i> Target 2030</div>
            <div class="rm-phase-meta"><span class="rm-phase-kick">Fase 6</span><span class="rm-phase-year">2030</span></div>
            <h3 class="rm-phase-title">Sekolah Vokasi Rujukan Nasional</h3>
            <p class="rm-phase-text">Menjadi sekolah menengah kejuruan rujukan dengan lulusan yang beriman, berkarakter, kompeten, dan mampu bersaing di tingkat nasional maupun internasional.</p>
            <ul class="rm-phase-list">
              <li>Lulusan terserap industri, berwirausaha, atau lanjut studi</li>
              <li>Sekolah rujukan &amp; pusat pelatihan vokasi masyarakat</li>
              <li>Ekosistem vokasi yang berkelanjutan dan inklusif</li>
            </ul>
            <span class="rm-phase-tag">Next chapter</span>
          </div>
        </div>
        <div class="rm-phase-node"><i class="fas fa-star"></i><span>2030</span></div>
        <div class="rm-phase-side rm-phase-side--empty" aria-hidden="true"></div>
      </article>

      <div class="rm-dest" data-reveal>
        <div class="rm-dest-node"><b>2030</b><span>Destination</span></div>
        <div class="rm-dest-label">Tujuan <span>2030</span></div>
        <p class="rm-dest-sub">Seluruh fase mengarah pada satu titik: menjadi Sekolah Vokasi Rujukan Nasional.</p>
      </div>
    </div>
  </section>

  <!-- FUTURE BAND: TARGET 2030 -->
  <section class="rm-future">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="rm-future-inner">
      <div class="rm-future-card" data-reveal>
        <div class="eyebrow">Yang kita kejar</div>
        <h3>Target besar, <span>langkah kecil yang pasti.</span></h3>
        <p>Roadmap bukan sekadar dokumen — ia adalah komitmen bersama. Setiap warga sekolah memiliki peran dalam mewujudkan target 2030.</p>
        <div class="rm-future-targets">
          <div class="rm-target">
            <i class="fas fa-check"></i>
            <div><strong>Lulusan siap kerja &amp; berdaya saing</strong><span>Terserap industri, berwirausaha, atau melanjutkan studi.</span></div>
          </div>
          <div class="rm-target">
            <i class="fas fa-check"></i>
            <div><strong>Ekosistem digital yang utuh</strong><span>Layanan, pembelajaran, dan data terintegrasi.</span></div>
          </div>
          <div class="rm-target">
            <i class="fas fa-check"></i>
            <div><strong>Kemitraan yang saling menguatkan</strong><span>DUDI, kampus, orang tua, dan masyarakat.</span></div>
          </div>
        </div>
      </div>

      <div class="rm-future-visual" data-reveal="right">
        <div class="rm-goal">
          <div class="rm-goal-num">2030</div>
          <div class="rm-goal-label">Target akhir roadmap</div>
          <h4>Sekolah Vokasi Rujukan Nasional</h4>
          <p>SMK Negeri 2 Mojokerto menjadi rujukan bagi sekolah menengah kejuruan lain dalam mutu pembelajaran, kemitraan industri, dan tata kelola.</p>
          <div class="rm-goal-metrics">
            <div class="rm-goal-metric"><b>100%</b><span>Guru bersertifikat</span></div>
            <div class="rm-goal-metric"><b>9</b><span>Kompetensi keahlian unggul</span></div>
            <div class="rm-goal-metric"><b>90%+</b><span>Lulusan terserap kerja</span></div>
            <div class="rm-goal-metric"><b>A</b><span>Akreditasi unggul</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA PENUTUP -->
  <div class="rm-cta" data-reveal>
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="rm-cta-inner">
      <h3>Mari melangkah bersama <span>menuju 2030.</span></h3>
      <p>Roadmap Skaneda adalah perjalanan kita bersama. Dukungan orang tua, mitra industri, dan masyarakat sangat berarti dalam mewujudkan setiap fase pengembangan.</p>
      <a href="{{ route('kontak') }}" class="rm-cta-btn">
        Hubungi Sekolah <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div>

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

    var pending = Array.prototype.slice.call(revealEls);
    var checks = 0;
    var iv = setInterval(function () {
      checks++;
      var vh = window.innerHeight;
      pending = pending.filter(function (el) {
        if (el.classList.contains('revealed')) return false;
        var r = el.getBoundingClientRect();
        if (r.top < vh + 220 && r.bottom > -40) { el.classList.add('revealed'); return false; }
        return true;
      });
      if (checks >= 8) {
        pending.forEach(function (el) { el.classList.add('revealed'); });
        clearInterval(iv);
      } else if (pending.length === 0) {
        clearInterval(iv);
      }
    }, 450);

    /* ---- Roadmap journey line progress reveal ---- */
    var route = document.getElementById('rmRoute');
    if (route) {
      if (!('IntersectionObserver' in window)) {
        route.classList.add('rm-route--go');
      } else {
        var ro = new IntersectionObserver(function (entries) {
          entries.forEach(function (e) {
            if (e.isIntersecting) { route.classList.add('rm-route--go'); ro.disconnect(); }
          });
        }, { threshold: 0.06 });
        ro.observe(route);
      }
    }
  })();
</script>
@endpush