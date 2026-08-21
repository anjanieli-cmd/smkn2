@extends('layouts.app')

@section('title', 'Struktur Organisasi — SMK Negeri 2 Mojokerto')
@section('description', 'Struktur organisasi SMK Negeri 2 Mojokerto — pahami hierarki, peran, dan tanggung jawab setiap bagian dalam organisasi sekolah.')

@push('styles')
<style>
/* =========================================================
   STRUKTUR ORGANISASI — PREMIUM EDITION (buat ulang dari nol)
   Visual language: SENADA PERSIS dengan Sejarah Sekolah &
   Visi Misi — foto gedung + overlay, watermark typography,
   ornamen geometris gaya Beranda (home-orn), glassmorphism,
   kartu jabatan DENGAN FOTO ORANG, scroll-reveal.
   Warna: navy #0d3a66, biru #2f6fa8, putih, gold #ffd54a/#ffb300.
   ========================================================= */
.so-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}
.so-page *{box-sizing:border-box}
.so-shell{width:100%}

/* ---------- HERO: foto gedung + overlay + watermark ---------- */
.so-hero{position:relative;min-height:88vh;display:flex;align-items:flex-start;overflow:hidden;
  background-image:url('{{ asset('images/hero-sekolah.jpg') }}');
  background-size:cover;background-position:center;background-repeat:no-repeat;color:#fff}
.so-hero::before{content:"";position:absolute;inset:0;z-index:1;
  background:linear-gradient(100deg,rgba(7,22,42,.90) 0%,rgba(9,30,54,.68) 45%,rgba(9,30,54,.32) 78%,rgba(9,30,54,.12) 100%)}
/* Watermark typography besar transparan */
.so-hero::after{content:"STRUKTUR";position:absolute;z-index:2;right:-2%;top:50%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(5rem,19vw,19rem);font-weight:900;line-height:.82;
  letter-spacing:.02em;color:rgba(255,255,255,.055);-webkit-text-stroke:1px rgba(255,255,255,.07);
  text-shadow:0 0 90px rgba(13,58,102,.16);pointer-events:none;white-space:nowrap;user-select:none}
.so-hero-inner{position:relative;z-index:3;width:min(1400px,92%);margin:0 auto;
  padding:clamp(3.5rem,9vh,5.5rem) 0 clamp(4.5rem,8vh,5.5rem);
  display:grid;grid-template-columns:minmax(0,1.05fr) minmax(340px,.95fr);gap:4rem;align-items:center}

/* Komposisi hero disamakan dengan halaman Sejarah: judul besar kiri, foto kanan, dan CTA Virtual Tour di bawah judul. */
.so-lead{font-size:1.02rem;line-height:1.85;color:rgba(235,245,253,.86);max-width:640px;margin:1.3rem 0 0;animation:hdFadeUp .7s .26s var(--ease,ease) both}
.so-hero-meta{display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;animation:hdFadeUp .7s .4s var(--ease,ease) both}
.so-hero-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;border:1px solid rgba(255,255,255,.2);background:rgba(13,58,102,.30);border-radius:999px;font-size:.72rem;font-weight:800;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)}
.so-hero-pill i{color:#ffd54a}
.so-vt-hero-cta{display:inline-flex;align-items:center;gap:.8rem;margin-top:1.45rem;padding:.9rem 1.1rem;border-radius:18px;text-decoration:none;color:#fff;background:rgba(13,58,102,.42);border:1px solid rgba(255,255,255,.22);box-shadow:0 12px 30px rgba(0,0,0,.16);backdrop-filter:blur(9px);transition:transform .3s ease,background .3s ease,border-color .3s ease,box-shadow .3s ease}
.so-vt-hero-cta:hover{transform:translateY(-4px);background:rgba(13,58,102,.68);border-color:rgba(255,213,74,.5);box-shadow:0 18px 38px rgba(0,0,0,.24)}
.so-vt-hero-icon{width:46px;height:46px;border-radius:14px;display:grid;place-items:center;background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:.9rem}
.so-vt-hero-cta strong{display:block;font-size:1rem;line-height:1.15;font-weight:900;letter-spacing:.01em}
.so-vt-hero-cta small{display:block;margin-top:.25rem;color:rgba(255,255,255,.78);font-size:.72rem;font-weight:600}
.so-vt-hero-arrow{margin-left:.3rem;color:#ffd54a;font-size:1rem}

.so-kicker{display:inline-flex;transform:translateY(0);align-items:center;gap:.65rem;font-size:.74rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#ffd54a;margin-bottom:0.6rem}
.so-kicker::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ffb300)}

/* ---------- TITLE: STRUKTUR putih, ORGANISASI kuning-oranye ---------- */
.so-title{font-family:var(--font-display);font-size:clamp(2.9rem,7vw,6.4rem);line-height:.98;
  letter-spacing:.01em;margin:0;max-width:760px;text-transform:uppercase;
  text-shadow:0 2px 24px rgba(4,14,28,.35);animation:hdFadeUp .7s .1s var(--ease, ease) both}
.so-title .so-white{color:#ffffff;display:inline-block}
.so-title .so-gold{display:inline-block;
  background:linear-gradient(135deg,#ffe66d 0%,#ffc107 45%,#ff8a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ffc107;
  text-shadow:0 4px 24px rgba(255,174,0,.18);letter-spacing:.025em}

.hero-photo{position:relative;height:430px;border-radius:24px;overflow:hidden;
  border:1px solid rgba(255,255,255,.22);box-shadow:0 42px 85px rgba(4,20,38,.42),0 18px 34px rgba(0,0,0,.22);
  transform:rotate(1.5deg);animation:hdFadeUp .8s .35s var(--ease, ease) both}
.hero-photo::before{content:"";position:absolute;inset:0;z-index:2;
  background:linear-gradient(180deg,transparent 38%,rgba(4,20,38,.86) 100%)}
.hero-photo img{width:100%;height:100%;object-fit:cover;display:block;transform:scale(1.03)}
.hero-photo-caption{position:absolute;z-index:3;left:1.5rem;right:1.5rem;bottom:1.3rem}
.hero-photo-caption strong{display:block;font-family:var(--font-display);font-size:1.3rem;font-weight:600;color:#fff}
.hero-photo-caption span{font-size:.72rem;color:rgba(255,255,255,.74)}
@keyframes hdFadeUp{from{opacity:0;transform:translateY(26px)}to{opacity:1;transform:none}}

/* ---------- SECTION COMMON (keluarga Sejarah/Visi Misi) ---------- */
.so-wide{width:min(1380px,92%);margin:auto}
.eyebrow{display:inline-flex;align-items:center;gap:.5rem;font-size:.74rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#0d3a66;margin-bottom:.85rem}
.eyebrow::before{content:"";width:26px;height:3px;border-radius:99px;background:linear-gradient(90deg,#0d3a66,#2f6fa8)}
.big-heading{font-family:var(--font-display);font-size:clamp(2.1rem,4.4vw,4.2rem);line-height:1.02;
  letter-spacing:.01em;margin:0;color:#0d3a66;text-shadow:0 2px 10px rgba(13,58,102,.06)}
.big-heading span{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}

/* ---------- NAV LEVEL (strip pill) ---------- */
.so-eranav{position:relative;z-index:6;background:#0d3a66;border-bottom:1px solid rgba(255,255,255,.08);
  box-shadow:0 14px 34px rgba(13,58,102,.18)}
.so-eranav-inner{display:flex;gap:.6rem;flex-wrap:wrap;align-items:center;
  padding:1rem clamp(1rem,4vw,3rem)}
.so-nav-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.62rem 1.05rem;border-radius:999px;
  border:1px solid rgba(255,255,255,.22);background:rgba(255,255,255,.06);color:#d7e6f5;
  font-size:.75rem;font-weight:800;cursor:pointer;transition:all .3s ease}
.so-nav-pill i{color:#ffd54a;transition:color .3s ease}
.so-nav-pill:hover{background:rgba(255,255,255,.14);transform:translateY(-2px)}
.so-nav-pill.is-active{background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;border-color:transparent;
  box-shadow:0 10px 26px rgba(255,138,0,.35)}
.so-nav-pill.is-active i{color:#0d3a66}

/* ---------- SECTION BAGAN (bg dot pattern + gradient, ala misi-section) ---------- */
.so-chart-section{position:relative;padding:110px 0 130px;overflow:hidden;isolation:isolate;
  background:
    radial-gradient(circle at 8% 18%,rgba(47,111,168,.12) 0 2px,transparent 3px),
    radial-gradient(circle at 91% 27%,rgba(255,179,0,.16) 0 3px,transparent 4px),
    radial-gradient(circle at 13% 78%,rgba(47,111,168,.10) 0 2px,transparent 3px),
    linear-gradient(180deg,#f8fbfe 0%,#eef5fa 100%)}
.so-chart-section::after{content:"";position:absolute;left:-35px;top:180px;width:185px;height:185px;
  background-image:radial-gradient(circle,rgba(31,100,170,.45) 2.2px,transparent 3px);
  background-size:20px 20px;opacity:.65;pointer-events:none;z-index:0}
.so-chart-section::before{content:"";position:absolute;right:-20px;bottom:90px;width:175px;height:175px;
  background-image:radial-gradient(circle,rgba(255,179,0,.55) 2px,transparent 3px);
  background-size:19px 19px;opacity:.5;pointer-events:none;z-index:0}
.so-wrap{width:min(1380px,94%);margin:0 auto;position:relative;z-index:2}
.so-sec-head{text-align:center;margin:0 auto 1.6rem;position:relative;z-index:2}
.so-sec-head .eyebrow{justify-content:center}
.so-sec-head .eyebrow::after{content:"\2022 \2022 \2022";color:#ffb300;letter-spacing:5px;font-size:12px;margin-left:.4rem}
.so-sec-head .big-heading{margin:0 auto}

/* ---------- TOOLBAR SEARCH & FILTER ---------- */
.so-toolbar{display:flex;align-items:center;gap:.9rem;flex-wrap:wrap;
  background:rgba(255,255,255,.85);border:1px solid rgba(13,58,102,.16);border-radius:22px;
  padding:1rem 1.2rem;margin:0 auto 2rem;max-width:1180px;
  box-shadow:0 18px 44px rgba(13,58,102,.08);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px)}
.so-search{flex:1 1 100%;display:flex;align-items:center;gap:.7rem;
  background:#fff;border:1px solid rgba(13,58,102,.18);border-radius:16px;padding:.8rem 1.15rem}
.so-search i{color:#2f6fa8}
.so-search input{flex:1;border:none;outline:none;background:transparent;font-size:.86rem;color:#0d3a66;min-width:0}
.so-search input::placeholder{color:#8fa3b6}
.so-filter-label{font-size:.72rem;font-weight:800;text-transform:uppercase;letter-spacing:.1em;color:#6d7f91}
.so-filters{display:flex;gap:.5rem;flex-wrap:wrap}
.so-fchip{padding:.5rem .9rem;border-radius:999px;border:1px solid rgba(13,58,102,.18);
  background:#fff;color:#0d3a66;font-size:.72rem;font-weight:800;cursor:pointer;transition:all .3s ease}
.so-fchip:hover{border-color:rgba(255,179,0,.5);transform:translateY(-2px)}
.so-fchip.is-active{background:linear-gradient(135deg,#0d3a66,#2f6fa8);color:#fff;border-color:transparent;
  box-shadow:0 8px 20px rgba(13,58,102,.3)}
.so-empty{display:none;text-align:center;padding:3rem 1rem;color:#8fa3b6}
.so-empty.show{display:block}
.so-empty i{font-size:2rem;color:#c3d3e2;margin-bottom:.6rem;display:block}

/* ---------- GRID KARTU JABATAN (DENGAN FOTO) ---------- */
.so-chart{display:flex;flex-direction:column;gap:3.2rem;margin-top:1rem}
.so-level{position:relative}
.so-level-head{display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem}
.so-level-badge{display:inline-flex;align-items:center;gap:.5rem;padding:.5rem .95rem;border-radius:999px;
  background:linear-gradient(135deg,#0d3a66,#2f6fa8);color:#fff;font-size:.72rem;font-weight:800;
  letter-spacing:.06em;box-shadow:0 10px 24px rgba(13,58,102,.28)}
.so-level-badge i{color:#ffd54a}
.so-level-rule{flex:1;height:1px;background:linear-gradient(90deg,rgba(13,58,102,.22),transparent)}
.so-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.3rem}
.so-grid.cols-5{grid-template-columns:repeat(5,1fr)}
.so-grid.cols-3{grid-template-columns:repeat(3,1fr)}
.so-card{position:relative;background:#fff;border:1px solid rgba(13,58,102,.14);border-radius:22px;
  padding:1.5rem 1.3rem 1.3rem;text-align:center;cursor:pointer;overflow:hidden;
  box-shadow:0 16px 40px rgba(13,58,102,.09);
  transition:transform .4s cubic-bezier(.22,.61,.36,1),box-shadow .4s ease,border-color .3s ease;
  outline:none}
.so-card:hover,.so-card:focus-visible{transform:translateY(-9px);box-shadow:0 30px 62px rgba(13,58,102,.2);
  border-color:rgba(255,179,0,.45)}
.so-card::before{content:"";position:absolute;top:0;left:0;width:100%;height:4px;
  background:linear-gradient(90deg,#0d3a66,#2f6fa8,#ffb300);transform:scaleX(0);transform-origin:left;
  transition:transform .45s ease}
.so-card:hover::before,.so-card:focus-visible::before{transform:scaleX(1)}
.so-card::after{content:"";position:absolute;right:-22px;bottom:-26px;width:80px;height:80px;
  border:2px solid rgba(13,58,102,.18);transform:rotate(45deg);pointer-events:none}
.so-card.is-hidden{display:none}
.so-card.is-match{outline:3px solid rgba(255,179,0,.5);outline-offset:2px}
.so-photo-wrap{position:relative;width:150px;margin:0 auto 1.1rem;aspect-ratio:3/4}
.so-photo{position:relative;width:100%;height:100%;border-radius:18px;overflow:hidden;
  border:3px solid #fff;box-shadow:0 12px 28px rgba(13,58,102,.3);
  background:linear-gradient(135deg,#e8f1f9,#d4e4f3)}
.so-photo img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .6s ease}
.so-card:hover .so-photo img{transform:scale(1.06)}
.so-photo-ring{position:absolute;inset:-8px;border-radius:22px;pointer-events:none;
  border:2px solid rgba(255,179,0,.45);border-top-color:#ffd54a;
  transition:transform .55s ease}
.so-card:hover .so-photo-ring{transform:rotate(5deg)}
.so-photo-tag{position:absolute;right:-6px;bottom:-2px;width:34px;height:34px;border-radius:50%;
  background:linear-gradient(135deg,#0d3a66,#2f6fa8);color:#ffd54a;font-size:.85rem;
  display:flex;align-items:center;justify-content:center;border:2px solid #fff;
  box-shadow:0 6px 16px rgba(13,58,102,.35)}
.so-photo-tag.is-gold{background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66}
.so-card-name{font-family:var(--font-display);font-size:1.02rem;font-weight:800;color:#0d3a66;
  line-height:1.3;margin:0 0 .3rem}
.so-card-person{font-size:.8rem;font-weight:700;color:#2f6fa8;margin:0 0 .55rem}
.so-card-role{display:inline-flex;align-items:center;gap:.4rem;font-size:.68rem;font-weight:800;
  color:#8a5a00;background:rgba(255,179,0,.14);border:1px solid rgba(255,179,0,.3);
  padding:.28rem .7rem;border-radius:999px;margin-bottom:.6rem}
.so-card-role i{color:#ffb300}
.so-card-unit{font-size:.76rem;line-height:1.55;color:#718396;margin:0}
.so-card-hint{display:none}
.so-level-root .so-grid{grid-template-columns:1fr;max-width:340px;margin:0 auto}
.so-level-root .so-photo-wrap{width:172px}

/* ---------- LEGEND ---------- */
.so-legend{display:flex;gap:1.2rem;flex-wrap:wrap;justify-content:center;margin:2.6rem auto 0;
  max-width:1180px;font-size:.74rem;color:#6d7f91}
.so-legend span{display:inline-flex;align-items:center;gap:.45rem}
.lg-line{width:26px;height:0;border-top:2px dashed rgba(13,58,102,.45)}
.so-legend i.fa-circle{font-size:.6rem}

/* ---------- PERAN & TUGAS ---------- */
.so-sec-head-mid{margin-top:4.6rem}
.so-roles{display:grid;grid-template-columns:repeat(3,1fr);gap:1.4rem;margin-top:2.4rem}
.so-role-card{position:relative;background:#fff;border:1px solid rgba(13,58,102,.14);border-radius:22px;
  padding:2rem 1.7rem 1.9rem;overflow:hidden;box-shadow:0 18px 42px rgba(13,58,102,.10);
  transition:transform .4s cubic-bezier(.22,.61,.36,1),box-shadow .4s ease,border-color .3s ease}
.so-role-card:hover{transform:translateY(-9px);box-shadow:0 30px 62px rgba(13,58,102,.2);border-color:rgba(255,179,0,.45)}
.so-role-card::before{content:"";position:absolute;top:0;left:0;width:100%;height:4px;
  background:linear-gradient(90deg,#0d3a66,#2f6fa8,#ffb300)}
.so-role-icon{width:58px;height:58px;border-radius:17px;margin-bottom:1.1rem;
  background:linear-gradient(135deg,#0d3a66,#2f6fa8);color:#ffd54a;font-size:1.3rem;
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 12px 26px rgba(13,58,102,.26);transition:transform .35s ease}
.so-role-icon.is-gold{background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66}
.so-role-card:hover .so-role-icon{transform:rotate(-8deg) scale(1.08)}
.so-role-card h4{font-family:var(--font-display);font-size:1.18rem;font-weight:800;color:#0d3a66;
  line-height:1.3;margin:0 0 .55rem}
.so-role-card p{font-size:.86rem;line-height:1.8;color:#718396;margin:0}

/* ---------- CTA PENUTUP (ala visi-cta / future) ---------- */
.so-cta{position:relative;margin-top:4.6rem;padding:90px 0 100px;overflow:hidden;text-align:center;isolation:isolate;
  border-radius:28px;background:linear-gradient(135deg,#0b3558,#0d3a66 45%,#0d3a66);color:#fff}
.so-cta::after{content:"SKANEDA";position:absolute;left:50%;bottom:-34px;transform:translateX(-50%);
  font-family:var(--font-display);font-size:clamp(3.4rem,11vw,9rem);font-weight:900;line-height:1;
  letter-spacing:.05em;color:rgba(255,255,255,.045);-webkit-text-stroke:1px rgba(255,255,255,.06);
  pointer-events:none;white-space:nowrap;user-select:none}
.so-cta-inner{position:relative;z-index:2;width:min(800px,92%);margin:auto}
.so-cta h3{font-family:var(--font-display);font-size:clamp(1.9rem,4vw,3.2rem);line-height:1.08;margin:0 0 1rem}
.so-cta h3 span{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.so-cta p{color:rgba(235,245,253,.8);line-height:1.85;max-width:620px;margin:0 auto 2rem}
.so-cta-btn{display:inline-flex;align-items:center;gap:.6rem;padding:.95rem 2rem;border-radius:999px;
  background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:.92rem;font-weight:900;
  text-decoration:none;box-shadow:0 16px 36px rgba(255,138,0,.4);
  transition:transform .3s ease,box-shadow .3s ease}
.so-cta-btn:hover{transform:translateY(-4px);box-shadow:0 22px 46px rgba(255,138,0,.5)}
.so-cta-btn i{transition:transform .3s ease}
.so-cta-btn:hover i{transform:translateX(5px)}

/* ---------- SPACING & WIDTH POLISH ---------- */
/* Kartu "Bagaimana sekolah bekerja" dibuat lebih ramping agar tidak menempel ke tepi layar. */
.so-sec-head-mid{
  width:min(1100px,90%);
  margin-left:auto;
  margin-right:auto;
}
.so-roles{
  width:min(1240px,90%);
  margin-left:auto;
  margin-right:auto;
}
/* CTA dibuat lebih sempit dan diberi ruang bawah yang cukup sebelum footer. */
.so-cta{
  width:min(1240px,90%);
  margin-left:auto;
  margin-right:auto;
  margin-bottom:7rem;
}

/* ---------- MODAL DETAIL JABATAN ---------- */
.so-modal-overlay{position:fixed;inset:0;z-index:1000;display:flex;align-items:center;justify-content:center;
  background:rgba(6,18,34,.72);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);
  opacity:0;visibility:hidden;transition:opacity .35s ease,visibility .35s ease;padding:1.2rem}
.so-modal-overlay.open{opacity:1;visibility:visible}
.so-modal{position:relative;width:min(640px,100%);max-height:90vh;overflow:auto;border-radius:24px;
  background:#fff;box-shadow:0 44px 110px rgba(4,14,28,.5);transform:translateY(26px) scale(.97);
  transition:transform .4s cubic-bezier(.22,.61,.36,1)}
.so-modal-overlay.open .so-modal{transform:none}
.so-modal-close{position:absolute;top:14px;right:14px;z-index:5;width:40px;height:40px;border-radius:50%;
  border:none;background:rgba(255,255,255,.16);color:#fff;font-size:1.05rem;cursor:pointer;
  transition:background .3s ease,transform .3s ease}
.so-modal-close:hover{background:rgba(255,255,255,.3);transform:rotate(90deg)}
.so-modal-head{position:relative;padding:2.4rem 2rem 2rem;text-align:center;overflow:hidden;
  background:linear-gradient(135deg,#0b3558,#0d3a66 60%,#2f6fa8);color:#fff}
.so-modal-head::after{content:"";position:absolute;right:-40px;top:-50px;width:180px;height:180px;
  border:2px solid rgba(255,213,74,.28);transform:rotate(45deg)}
.so-modal-head::before{content:"";position:absolute;left:-30px;bottom:-60px;width:150px;height:150px;
  border-radius:50%;border:1px dashed rgba(255,255,255,.18)}
.so-modal-avatar{position:relative;z-index:2;width:92px;height:92px;margin:0 auto 1rem;border-radius:26px;
  background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:2.1rem;
  display:flex;align-items:center;justify-content:center;transform:rotate(45deg);
  box-shadow:0 18px 40px rgba(255,138,0,.4)}
.so-modal-avatar i{transform:rotate(-45deg)}
.so-modal-avatar.is-gold{background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66}
.so-modal-name{position:relative;z-index:2;font-family:var(--font-display);font-size:1.5rem;font-weight:800;line-height:1.25}
.so-modal-role{position:relative;z-index:2;display:inline-flex;align-items:center;gap:.45rem;margin-top:.5rem;
  font-size:.74rem;font-weight:800;color:#ffd54a;background:rgba(255,255,255,.12);
  border:1px solid rgba(255,255,255,.22);padding:.4rem .9rem;border-radius:999px}
.so-modal-body{padding:1.8rem 2rem 2.2rem}
.so-modal-section{margin-bottom:1.4rem}
.so-modal-label{display:flex;align-items:center;gap:.5rem;font-size:.72rem;font-weight:800;
  text-transform:uppercase;letter-spacing:.12em;color:#2f6fa8;margin-bottom:.7rem}
.so-modal-label i{color:#ffb300}
.so-modal-tags{display:flex;gap:.5rem;flex-wrap:wrap}
.so-tag{padding:.4rem .85rem;border-radius:999px;font-size:.72rem;font-weight:800;
  background:rgba(47,111,168,.1);border:1px solid rgba(47,111,168,.25);color:#0d3a66}
.so-tag.is-gold{background:rgba(255,179,0,.14);border-color:rgba(255,179,0,.35);color:#8a5a00}
.so-modal-tasks{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:.55rem}
.so-modal-tasks li{display:flex;gap:.7rem;font-size:.86rem;line-height:1.6;color:#4a5f74}
.so-modal-tasks li i{color:#ffb300;margin-top:.3rem;flex:none}
.so-modal-note{display:flex;gap:.6rem;font-size:.8rem;line-height:1.65;color:#8fa3b6;
  background:rgba(47,111,168,.07);border:1px dashed rgba(47,111,168,.25);
  padding:.8rem 1rem;border-radius:14px}
.so-modal-note i{color:#2f6fa8;margin-top:.15rem}

/* ---------- SCROLL REVEAL (senada Sejarah/Visi Misi) ---------- */
[data-reveal]{opacity:0;transform:translateY(36px);
  transition:opacity .85s cubic-bezier(.22,.61,.36,1),transform .85s cubic-bezier(.22,.61,.36,1);
  will-change:opacity,transform}
[data-reveal="left"]{transform:translateX(-46px)}
[data-reveal="right"]{transform:translateX(46px)}
[data-reveal].revealed{opacity:1;transform:none}
[data-reveal]{transition-delay:calc(var(--d,0)*90ms)}

/* ---------- ORNAMEN GAYA BERANDA (navy/gold) ---------- */
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

/* Posisi ornamen per section */
.so-hero .home-orn .ho-chevron{left:-150px;bottom:-60px;border-color:rgba(255,255,255,.10)}
.so-hero .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.so-hero .home-orn .ho-line{right:-80px;top:22%;opacity:.22}
.so-hero .home-orn .ho-dots{right:6%;bottom:14%;opacity:.3}
.so-hero .home-orn .ho-ring{left:44%;bottom:-90px;border-color:rgba(255,255,255,.12)}
.so-hero .home-orn .ho-gold{right:16%;top:20%}
.so-hero .home-orn .ho-square{left:12%;top:22%}

.so-chart-section .home-orn .ho-chevron{right:-145px;top:45px}
.so-chart-section .home-orn .ho-line{left:-80px;top:170px}
.so-chart-section .home-orn .ho-dots{left:3%;bottom:100px}
.so-chart-section .home-orn .ho-ring{right:8%;bottom:90px}
.so-chart-section .home-orn .ho-gold{right:16%;top:22%}
.so-chart-section .home-orn .ho-square{left:11%;top:15%}
.so-chart-section .home-orn .ho-corner{right:3%;bottom:8%;transform:rotate(180deg)}

.so-cta .home-orn .ho-chevron{left:-120px;bottom:-80px;border-color:rgba(255,255,255,.10)}
.so-cta .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.so-cta .home-orn .ho-dots{left:8%;top:30%;opacity:.22}
.so-cta .home-orn .ho-ring{right:-70px;top:20%;border-color:rgba(255,255,255,.10)}
.so-cta .home-orn .ho-gold{left:20%;bottom:26%}

/* Konten di atas ornamen */
.so-hero>*:not(.home-orn),
.so-chart-section>*:not(.home-orn),
.so-cta>*:not(.home-orn){position:relative;z-index:2}

/* ---------- HOVER LANGUAGE (keluarga Sejarah) ---------- */
.so-page .eyebrow,.so-page .so-card,.so-page .so-role-card,
.so-page .hero-photo,.so-page .big-heading,.so-page .so-title,.so-page .so-nav-pill{
  transition:transform .35s ease,box-shadow .35s ease,filter .35s ease,border-color .35s ease,background .35s ease}
.so-page .so-kicker:hover{transform:translateX(7px);filter:drop-shadow(0 5px 12px rgba(255,213,74,.2))}
.so-page .eyebrow:hover{transform:translateX(6px)}
.so-page .hero-photo:hover{transform:translateY(-6px) rotate(0deg) scale(1.015);
  box-shadow:0 45px 95px rgba(13,58,102,.35),0 18px 35px rgba(0,0,0,.22)}
.so-page .hero-photo:hover img{transform:scale(1.07)}
.so-page .big-heading:hover{transform:translateX(4px)}

/* ---------- ORNAMEN HALAMAN (fixed diamonds) ---------- */
.so-page::before{content:"";position:fixed;right:-110px;top:18%;width:230px;height:230px;
  border:2px solid rgba(13,58,102,.14);transform:rotate(45deg);z-index:0;pointer-events:none}
.so-page::after{content:"";position:fixed;left:-95px;bottom:10%;width:190px;height:190px;
  border:2px solid rgba(47,111,168,.14);border-radius:28px;transform:rotate(25deg);z-index:0;pointer-events:none}
.so-hero-inner::before{content:"";position:absolute;left:-28px;top:18%;width:12px;height:180px;
  border-left:3px solid #ffd54a;border-top:3px solid #ffd54a;opacity:.9}
.so-hero-inner::after{content:"";position:absolute;right:44%;top:8%;width:72px;height:72px;
  border:2px solid rgba(255,213,74,.55);transform:rotate(45deg);pointer-events:none}



/* =========================================================
   FINAL FIX — INSTAGRAM FEED STYLE v2
   Feed sosial yang clean: header akun, foto sebagai media utama,
   action bar, caption/info, dan ukuran foto tetap proporsional.
   ========================================================= */
.so-grid{align-items:start}
.so-card{
  position:relative;
  padding:0 0 1rem !important;
  border-radius:22px !important;
  text-align:left !important;
  background:#fff;
  border:1px solid rgba(13,58,102,.10);
  overflow:hidden;
  box-shadow:0 14px 34px rgba(13,58,102,.09);
}
.so-card:hover{transform:translateY(-7px);box-shadow:0 24px 48px rgba(13,58,102,.15)}
.so-card::before{height:3px;z-index:4}
.so-card::after{
  right:14px;bottom:14px;width:22px;height:22px;
  border-width:1px;opacity:.28;z-index:1;
}

/* Header ala Instagram */
.so-feed-head{
  display:flex;
  align-items:center;
  gap:.65rem;
  min-height:58px;
  margin:0;
  padding:.72rem .85rem;
  background:#fff;
}
.so-feed-head img{
  width:38px;height:38px;flex:0 0 38px;
  object-fit:contain;border-radius:50%;padding:2px;
  background:#fff;border:2px solid #ffb300;
  box-shadow:0 3px 10px rgba(13,58,102,.12);
}
.so-feed-account{min-width:0;display:flex;flex-direction:column;line-height:1.1}
.so-feed-account strong{
  font-family:var(--font-display);font-size:.76rem;font-weight:900;
  letter-spacing:.035em;color:#0d3a66;
}
.so-feed-account span{
  margin-top:.2rem;font-size:.58rem;color:#8a9bad;
  white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
}
.so-feed-more{margin-left:auto;color:#718396;font-size:.82rem;padding:.2rem}

/* Media post — lebar mengikuti card, tetapi tinggi dibatasi agar tidak kebesaran */
.so-photo-wrap{
  width:100% !important;
  max-width:none !important;
  height:270px;
  aspect-ratio:auto !important;
  margin:0 !important;
  padding:0 !important;
  position:relative;
  isolation:isolate;
  background:linear-gradient(180deg,#edf5fb,#dce9f4);
  border-top:1px solid rgba(13,58,102,.06);
  border-bottom:1px solid rgba(13,58,102,.08);
}
.so-photo-wrap::before{
  display:none;
}
.so-photo-wrap::after{
  width:34px;height:34px;right:12px;top:12px;border-radius:8px;
  border:1px solid rgba(255,179,0,.48);opacity:.75;z-index:3;
}
.so-photo{
  position:absolute !important;
  inset:0 !important;
  width:100% !important;
  height:100% !important;
  border:0 !important;
  border-radius:0 !important;
  box-shadow:none !important;
  background:linear-gradient(180deg,#eef6fc 0%,#dbe9f5 100%);
  overflow:hidden;
}
.so-photo img{
  width:100%;height:100%;
  object-fit:cover;
  object-position:center top;
  display:block;
  transition:transform .55s ease,filter .35s ease;
}
.so-card:hover .so-photo img{transform:scale(1.035);filter:saturate(1.04)}
.so-photo-ring{
  inset:10px !important;
  border-radius:14px !important;
  border:1px solid rgba(255,255,255,.45) !important;
  border-top-color:rgba(255,213,74,.8) !important;
  z-index:2;
  pointer-events:none;
}
.so-photo-tag{
  right:14px !important;bottom:12px !important;
  width:32px !important;height:32px !important;
  font-size:.68rem !important;
  border:2px solid #fff !important;
  box-shadow:0 6px 16px rgba(0,0,0,.18) !important;
  z-index:4;
}

/* Action bar Instagram */
.so-feed-actions{
  display:flex;
  align-items:center;
  gap:.9rem;
  padding:.65rem .85rem .25rem;
  color:#0d3a66;
  font-size:1rem;
}
.so-feed-actions i{transition:transform .2s ease,color .2s ease;cursor:pointer}
.so-feed-actions i:hover{transform:scale(1.16);color:#ff9f00}
.so-feed-actions .so-bookmark{margin-left:auto}

/* Isi postingan */
.so-card-name{
  font-size:1rem !important;
  line-height:1.3;
  text-align:left !important;
  margin:.25rem .85rem .22rem !important;
}
.so-card-person{
  font-size:.7rem !important;
  text-align:left !important;
  margin:0 .85rem .45rem !important;
  color:#6f8498;
}
.so-card-role{
  display:flex !important;
  width:max-content;max-width:calc(100% - 1.7rem);
  margin:.15rem .85rem .5rem !important;
  justify-content:center;
  font-size:.6rem;padding:.25rem .58rem;
}
.so-card-unit{
  font-size:.68rem;line-height:1.55;text-align:left;
  margin:0 .85rem !important;max-width:none;
  color:#718396;
}

/* Kepala Sekolah = featured post, tetapi tetap tidak memenuhi layar */
.so-level-root .so-grid{max-width:390px !important}
.so-level-root .so-card{padding-bottom:1.15rem !important;border-radius:24px !important}
.so-level-root .so-photo-wrap{height:320px !important;width:100% !important;max-width:none !important}
.so-level-root .so-card-name{font-size:1.08rem !important}
.so-level-root .so-card-unit{max-width:none}

.so-level:not(.so-level-root) .so-grid{gap:1.2rem}
.so-level:not(.so-level-root) .so-card{min-height:0}

@media(max-width:1100px){
  .so-photo-wrap{height:245px}
  .so-level-root .so-photo-wrap{height:290px !important}
}
@media(max-width:950px){
  .so-grid,.so-grid.cols-5,.so-grid.cols-3{grid-template-columns:repeat(2,minmax(0,1fr))}
}
@media(max-width:700px){
  .so-grid,.so-grid.cols-5,.so-grid.cols-3{grid-template-columns:repeat(2,minmax(0,1fr))}
  .so-photo-wrap{height:230px}
  .so-level-root .so-grid{max-width:340px !important}
  .so-level-root .so-photo-wrap{height:280px !important}
  .so-feed-head{min-height:52px;padding:.6rem .7rem}
  .so-feed-head img{width:34px;height:34px;flex-basis:34px}
}
@media(max-width:520px){
  .so-grid,.so-grid.cols-5,.so-grid.cols-3{grid-template-columns:1fr}
  .so-photo-wrap{height:300px}
  .so-level-root .so-photo-wrap{height:320px !important}
}
@media(max-width:420px){
  .so-photo-wrap{height:280px}
  .so-level-root .so-grid{max-width:100% !important}
  .so-level-root .so-photo-wrap{height:300px !important}
}

/* =========================================================
   VIRTUAL TOUR — EXACT SEJARAH PAGE STYLE
   ========================================================= */
/* =========================================================
   VIRTUAL TOUR 360 — mengikuti bahasa visual Beranda
   ========================================================= */
.vt-section{
  position:relative;overflow:hidden;isolation:isolate;padding:120px 0 130px;
  background:linear-gradient(180deg,#eef5fb 0%,#ffffff 48%,#f3f7fb 100%);
}
.vt-section::before{content:"";position:absolute;inset:0;pointer-events:none;opacity:.42;
  background-image:radial-gradient(circle,rgba(13,58,102,.18) 1.5px,transparent 2px);
  background-size:22px 22px;mask-image:linear-gradient(90deg,transparent 0%,#000 15%,#000 85%,transparent 100%);
}
.vt-watermark{position:absolute;right:-20px;top:40px;font-size:clamp(9rem,18vw,16rem);font-weight:900;line-height:.8;color:rgba(13,58,102,.035);letter-spacing:-.08em;z-index:0;user-select:none}
.vt-decor-ring{position:absolute;right:-70px;top:80px;width:300px;height:300px;border:1px solid rgba(13,58,102,.12);border-radius:50%;z-index:0}
.vt-decor-ring::before{content:"";position:absolute;inset:35px;border:1px dashed rgba(255,179,0,.3);border-radius:50%}
.vt-decor-dots{position:absolute;left:4%;bottom:65px;width:125px;height:125px;opacity:.42;background-image:radial-gradient(circle,#ffb300 2px,transparent 2.5px);background-size:18px 18px;z-index:0}
.vt-inner{position:relative;z-index:2;width:min(1180px,92%);margin:0 auto;display:grid;grid-template-columns:minmax(0,1.05fr) minmax(360px,.95fr);gap:4.5rem;align-items:center}
.vt-media{min-width:0}
.vt-frame{position:relative;overflow:hidden;border-radius:30px;background:#0d3a66;box-shadow:0 30px 75px rgba(13,58,102,.2);aspect-ratio:16/10;border:1px solid rgba(255,255,255,.65)}
.vt-frame::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 42%,rgba(5,25,48,.78) 100%);pointer-events:none}
.vt-frame img{width:100%;height:100%;display:block;object-fit:cover;transition:transform .7s cubic-bezier(.22,.61,.36,1)}
.vt-frame:hover img{transform:scale(1.045)}
.vt-badge{position:absolute;left:1.2rem;top:1.2rem;z-index:3;display:inline-flex;align-items:center;gap:.5rem;padding:.58rem .85rem;border-radius:999px;background:rgba(13,58,102,.86);color:#fff;font-size:.74rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;backdrop-filter:blur(8px)}
.vt-play{position:absolute;z-index:4;left:50%;top:50%;transform:translate(-50%,-50%);width:78px;height:78px;border-radius:50%;border:7px solid rgba(255,255,255,.22);background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:1.35rem;display:grid;place-items:center;cursor:pointer;box-shadow:0 18px 45px rgba(255,138,0,.38);transition:transform .3s ease,box-shadow .3s ease}
.vt-play:hover{transform:translate(-50%,-50%) scale(1.08);box-shadow:0 24px 55px rgba(255,138,0,.5)}
.vt-caption{position:absolute;left:1.4rem;right:1.4rem;bottom:1.25rem;z-index:3;display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;color:#fff}
.vt-caption strong{display:block;font-size:1.2rem;font-weight:900}.vt-caption span{display:block;margin-top:.22rem;color:rgba(255,255,255,.76);font-size:.78rem}
.vt-cam{display:inline-flex!important;align-items:center;gap:.4rem;padding:.48rem .7rem;border:1px solid rgba(255,255,255,.28);border-radius:999px!important;background:rgba(0,0,0,.18);white-space:nowrap}
.vt-chip{display:inline-flex;align-items:center;gap:.75rem;margin-top:1rem;padding:.75rem 1rem;border-radius:16px;background:#fff;border:1px solid rgba(13,58,102,.1);box-shadow:0 12px 30px rgba(13,58,102,.08)}
.vt-chip>i{width:40px;height:40px;border-radius:12px;display:grid;place-items:center;background:linear-gradient(135deg,#ffd54a,#ff9f00);color:#0d3a66}.vt-chip strong{display:block;color:#0d3a66;font-size:.85rem}.vt-chip span{display:block;color:#71839a;font-size:.68rem;margin-top:.15rem}
.vt-copy{position:relative}.vt-kicker{display:inline-flex;align-items:center;gap:.55rem;color:#0d3a66;font-size:.75rem;font-weight:900;letter-spacing:.16em;text-transform:uppercase}.vt-kicker::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ff8a00)}
.vt-title{margin:.8rem 0 1.1rem;color:#0d3a66;font-family:var(--font-display);font-size:clamp(2.8rem,5vw,4.8rem);font-weight:900;line-height:.98;letter-spacing:-.045em}.vt-gold{display:block;background:linear-gradient(90deg,#ffd54a,#ff8a00);-webkit-background-clip:text;background-clip:text;color:transparent}.vt-sub{display:block;margin-top:.55rem;font-size:.38em;line-height:1.1;letter-spacing:.02em;color:#315b80;font-weight:800}
.vt-desc{max-width:590px;color:#667b90;line-height:1.9;font-size:.98rem}.vt-feats{display:flex;flex-wrap:wrap;gap:.55rem;margin:1.25rem 0}.vt-feat{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem .75rem;border-radius:999px;background:#fff;border:1px solid rgba(13,58,102,.1);color:#315b80;font-size:.74rem;font-weight:800}.vt-feat i{color:#ff9f00}.vt-btn{display:inline-flex;align-items:center;justify-content:center;gap:.65rem;padding:.9rem 1.2rem;border-radius:14px;background:linear-gradient(135deg,#0d3a66,#164e80);color:#fff;text-decoration:none;font-weight:900;box-shadow:0 14px 32px rgba(13,58,102,.2);transition:transform .3s ease,box-shadow .3s ease}.vt-btn:hover{transform:translateY(-4px);box-shadow:0 20px 40px rgba(13,58,102,.28)}
@media(max-width:900px){.vt-inner{grid-template-columns:1fr;gap:2.5rem}.vt-copy{max-width:700px}.vt-title{font-size:clamp(2.6rem,10vw,4rem)}}
@media(max-width:600px){.vt-section{padding:85px 0 95px}.vt-inner{width:92%;gap:2rem}.vt-frame{aspect-ratio:4/3;border-radius:22px}.vt-play{width:64px;height:64px}.vt-caption{left:1rem;right:1rem;bottom:1rem}.vt-caption strong{font-size:1rem}.vt-caption span{font-size:.7rem}.vt-cam{display:none!important}.vt-title{font-size:clamp(2.35rem,12vw,3.3rem)}.vt-decor-ring{width:190px;height:190px;right:-80px}.vt-decor-dots{width:90px;height:90px;background-size:14px 14px}}

/* =========================================================
   KOORDINATOR — SAMAKAN UKURAN FEED DENGAN WAKIL KEPALA SEKOLAH
   Hanya Level 3 yang diubah.
   ========================================================= */
@media(min-width:951px){
  #level-3 .so-grid.cols-5{
    grid-template-columns:repeat(4,minmax(0,1fr)) !important;
    gap:1.3rem !important;
  }
}


/* ===== HERO DISESUAIKAN 1000% DENGAN HALAMAN SEJARAH ===== */

/* =========================================================
   SEJARAH SEKOLAH — PREMIUM EDITION
   Visual language: konsisten dengan Beranda (teal #0d3a66),
   foto gedung + overlay, watermark typography, glassmorphism,
   scroll-reveal, section-title gradient.
   Konten/informasi asli TIDAK diubah.
   ========================================================= */
.history-page{background:#f7f9fc;color:#0d3a66;overflow:hidden}
.history-page *{box-sizing:border-box}
.history-shell{width:100%}

/* ---------- HERO: clean editorial showcase, tanpa foto background ---------- */
.history-hero{position:relative;min-height:78vh;display:flex;align-items:center;overflow:hidden;
  background:#fff;color:#0d3a66}
.history-hero::before{display:none}
/* Watermark besar seperti referensi: sangat tipis, berada di belakang judul */
.history-hero::after{content:"SEJARAH";position:absolute;z-index:0;left:-2%;top:50%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(8rem,24vw,24rem);font-weight:900;line-height:.78;
  letter-spacing:.015em;color:rgba(13,58,102,.035);
  -webkit-text-stroke:1px rgba(255,122,0,.12);
  pointer-events:none;white-space:nowrap;user-select:none}

/* ---------- ORNAMEN HERO KHUSUS: GEOMETRIC NETWORK ---------- */
.history-hero-geometry{position:absolute;inset:0;z-index:1;pointer-events:none;overflow:hidden}
.history-hero-geometry svg{position:absolute;width:100%;height:100%;inset:0;display:block}
.history-hero-geometry .geo-line{fill:none;stroke:#ff7a00;stroke-width:1.8;vector-effect:non-scaling-stroke;opacity:.42}
.history-hero-geometry .geo-line-navy{fill:none;stroke:#0d3a66;stroke-width:1.5;vector-effect:non-scaling-stroke;opacity:.24}
.history-hero-geometry .geo-node{fill:#fff;stroke:#ff7a00;stroke-width:2;vector-effect:non-scaling-stroke}
.history-hero-geometry .geo-node-navy{fill:#fff;stroke:#0d3a66;stroke-width:2;vector-effect:non-scaling-stroke}
.history-hero-geometry .geo-ring{fill:none;stroke:#0d3a66;stroke-width:1.2;opacity:.16}
.history-hero-geometry .geo-ring-orange{fill:none;stroke:#ff7a00;stroke-width:1.5;opacity:.28}
.history-hero-geometry .geo-diamond{fill:none;stroke:#ff7a00;stroke-width:1.4;opacity:.30}
.history-hero-geometry .geo-dot{fill:#ff7a00;opacity:.52}
.history-hero-geometry .geo-square{fill:#ff7a00;opacity:.9}
.history-hero-geometry .geo-square-navy{fill:#0d3a66;opacity:.9}
.history-hero-geometry .geo-soft{fill:#ff7a00;opacity:.055}

/* Kiri atas: pola titik + orbit yang jelas */
.history-hero-geometry .geo-cluster-left{position:absolute;left:-70px;top:-58px;width:330px;height:250px}
/* Kanan atas: orbit + diamond sebagai focal decorative element */
.history-hero-geometry .geo-cluster-right{position:absolute;right:-55px;top:18px;width:360px;height:270px}
/* Kiri bawah: jalur jaringan dengan node */
.history-hero-geometry .geo-network-left{position:absolute;left:-35px;bottom:12px;width:500px;height:220px}
/* Kanan bawah: motif modular, bukan garis acak */
.history-hero-geometry .geo-modules{position:absolute;right:-25px;bottom:-8px;width:430px;height:210px;transform:rotate(-2deg)}

/* watermark tetap menjadi layer paling belakang */
.history-hero::after{z-index:0}

.history-hero-inner{position:relative;z-index:3;width:100%;max-width:1500px;margin:0 auto;
  padding:clamp(4rem,10vh,7rem) clamp(1.25rem,4vw,4.5rem) clamp(4rem,9vh,6rem);
  display:block}

.history-kicker{display:inline-flex;align-items:center;gap:.65rem;font-size:.72rem;font-weight:900;
  letter-spacing:.18em;text-transform:uppercase;color:#ff6f00;margin-bottom:1.05rem;
  padding:.55rem .85rem;border:1px solid rgba(255,111,0,.18);border-radius:999px;
  background:#fffaf5}
.history-kicker::before{content:"";width:9px;height:9px;border-radius:50%;
  background:#ff6f00;box-shadow:0 0 0 6px rgba(255,111,0,.10)}

/* ---------- TITLE: navy + orange, besar seperti referensi ---------- */
.history-title{font-family:var(--font-display);font-size:clamp(4rem,10vw,9.2rem);line-height:.84;
  letter-spacing:-.035em;margin:0;max-width:1250px;text-transform:uppercase;
  text-shadow:none;animation:hdFadeUp .7s .1s var(--ease, ease) both}
.history-title .sejarah-white{color:#0d3a66;display:block}
.history-title .skaneda-gold{display:block;
  background:linear-gradient(135deg,#ff7a00 0%,#ff6a00 55%,#f4511e 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:#ff6f00;
  text-shadow:none;letter-spacing:-.025em}

.history-lead{font-size:1rem;line-height:1.75;color:#52657a;max-width:720px;
  margin:1.7rem 0 0;animation:hdFadeUp .7s .26s var(--ease, ease) both}
.history-hero-meta{display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem;animation:hdFadeUp .7s .4s var(--ease, ease) both}
.history-pill{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .85rem;
  border:1px solid rgba(13,58,102,.12);background:#fff;border-radius:999px;color:#0d3a66;
  font-size:.72rem;font-weight:800;box-shadow:0 8px 24px rgba(13,58,102,.06)}
.history-pill i{color:#ff7a00}
.hero-photo{display:none}
.hero-photo::before,.hero-photo img,.hero-photo-caption{display:none}
@keyframes hdFadeUp{from{opacity:0;transform:translateY(26px)}to{opacity:1;transform:none}}

  .history-vt-cta{
    display:inline-flex;align-items:center;gap:.8rem;margin-top:1.7rem;
    padding:.8rem 1rem;border-radius:16px;text-decoration:none;color:#0d3a66;
    background:#fff;border:1px solid rgba(13,58,102,.12);
    box-shadow:0 12px 30px rgba(13,58,102,.08);
    transition:transform .3s ease,background .3s ease,border-color .3s ease,box-shadow .3s ease
  }
  .history-vt-cta:hover{
    transform:translateY(-4px);background:#fffaf5;
    border-color:rgba(255,122,0,.28);box-shadow:0 18px 38px rgba(13,58,102,.12)
  }
  .history-vt-icon{
    width:46px;height:46px;border-radius:14px;display:grid;place-items:center;
    background:linear-gradient(135deg,#ffd54a,#ff7a00);color:#0d3a66;font-size:.9rem
  }
  .history-vt-cta strong{display:block;font-size:1rem;line-height:1.15;font-weight:900;letter-spacing:.01em}
  .history-vt-cta small{display:block;margin-top:.25rem;color:#718096;font-size:.72rem;font-weight:600}
  .history-vt-arrow{margin-left:.3rem;color:#ffd54a;font-size:1rem}
/* ---------- SECTION COMMON (sama keluarga dengan Beranda) ---------- */
.history-wide{width:min(1380px,92%);margin:auto}
.eyebrow{display:inline-flex;align-items:center;gap:.5rem;font-size:.74rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#0d3a66;margin-bottom:.85rem}
.story-content .eyebrow{color:#ffb300;}
.story-content .eyebrow::before{background:linear-gradient(90deg,#ffd54a,#ff9800);}
.eyebrow::before{content:"";width:26px;height:3px;border-radius:99px;background:linear-gradient(90deg,#0d3a66,#2f6fa8)}
.big-heading{font-family:var(--font-display);font-size:clamp(2.1rem,4.4vw,4.2rem);line-height:1.02;
  letter-spacing:.01em;margin:0;color:#0d3a66;text-shadow:0 2px 10px rgba(13,58,102,.06)}
.big-heading span{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}

/* ---------- INTRO / STATS (glassmorphism) ---------- */
.history-intro{position:relative;padding:96px 0 110px;background:#fff}
.intro-grid{display:grid;grid-template-columns:1.1fr .9fr;gap:5rem;align-items:center}
.intro-copy{font-size:1rem;line-height:1.95;color:#5f7186;margin-top:1.25rem;max-width:720px}
.stat-strip{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem}
.stat-box{position:relative;padding:1.4rem;border-radius:22px;overflow:hidden;min-height:150px;
  background:rgba(255,255,255,.72);border:1px solid rgba(13,58,102,.16);
  box-shadow:0 18px 44px rgba(13,58,102,.08);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);
  transition:transform .35s ease,box-shadow .35s ease}
.stat-box:hover{transform:translateY(-5px);box-shadow:0 24px 52px rgba(13,58,102,.14)}
.stat-box::after{content:"";position:absolute;right:-25px;bottom:-30px;width:90px;height:90px;
  border:2px solid rgba(13,58,102,.22);transform:rotate(45deg)}
.stat-box::before{content:"";position:absolute;top:0;left:0;width:100%;height:4px;
  background:linear-gradient(90deg,#0d3a66,#2f6fa8)}
.stat-num{font-family:var(--font-display);font-size:2.8rem;line-height:1;color:#0d3a66;font-weight:900}
.stat-num.gold{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.stat-label{font-size:.74rem;font-weight:800;color:#6d7f91;margin-top:.55rem;
  text-transform:uppercase;letter-spacing:.08em}

/* ---------- TIMELINE (teal premium) ---------- */
.timeline-section{position:relative;padding:110px 0 130px;
  background:linear-gradient(180deg,#f7f9fc 0%,#eef5f8 100%)}
.timeline-section::before{content:"";position:absolute;left:0;right:0;top:0;height:1px;
  background:linear-gradient(90deg,transparent,#b7cce0,transparent)}
.timeline-head{width:min(1380px,92%);margin:0 auto 70px;display:flex;justify-content:space-between;
  align-items:end;gap:2rem}
.timeline-head .big-heading{max-width:900px}
.timeline-note{max-width:320px;color:#718396;font-size:.8rem;line-height:1.7;text-align:right}
.timeline{position:relative;width:min(1200px,92%);margin:auto}
.timeline::before{content:"";position:absolute;top:0;bottom:0;left:50%;width:3px;transform:translateX(-50%);
  background:linear-gradient(180deg,#0a2d52 0%,#0d3a66 48%,#ffb300 100%);
  box-shadow:0 0 0 8px rgba(13,58,102,.05)}
.timeline-item{position:relative;width:50%;padding:0 52px 70px}
.timeline-item.left{left:0;text-align:right}
.timeline-item.right{left:50%;text-align:left}
.timeline-marker{position:absolute;top:16px;width:56px;height:56px;border-radius:18px;
  background:linear-gradient(135deg,#0d3a66,#0a2d52);border:5px solid #eef5f8;color:#ffd54a;
  display:flex;align-items:center;justify-content:center;font-size:1rem;
  box-shadow:0 12px 28px rgba(13,58,102,.3);z-index:3;transform:rotate(45deg)}
.timeline-marker i{transform:rotate(-45deg)}
.timeline-item.left .timeline-marker{right:-28px}
.timeline-item.right .timeline-marker{left:-28px}
.timeline-card{position:relative;background:#fff;border:1px solid #e3edf0;border-radius:22px;
  padding:1.6rem 1.7rem;box-shadow:0 20px 45px rgba(13,58,102,.08);overflow:hidden;
  transition:transform .35s ease,box-shadow .35s ease}
.timeline-card:hover{transform:translateY(-7px);box-shadow:0 28px 60px rgba(13,58,102,.16)}
.timeline-card::before{content:"";position:absolute;top:0;bottom:0;width:5px;
  background:linear-gradient(180deg,#0d3a66,#2f6fa8)}
.timeline-item.left .timeline-card::before{right:0}
.timeline-item.right .timeline-card::before{left:0}
.timeline-year{font-family:var(--font-display);font-size:2.1rem;line-height:1;color:#0d3a66;font-weight:900}
.timeline-title{font-size:1.12rem;font-weight:900;color:#0d3a66;margin:.5rem 0 .6rem}
.timeline-text{font-size:.86rem;line-height:1.8;color:#718396}
.timeline-tag{display:inline-flex;margin-top:1rem;padding:.35rem .65rem;border-radius:999px;
  background:linear-gradient(135deg,#e8f1f8,#edf4fa);color:#0a2d52;font-size:.66rem;font-weight:900;
  text-transform:uppercase;letter-spacing:.08em;border:1px solid rgba(13,58,102,.18)}

/* ---------- STORY BAND (teal) ---------- */
.story-band{position:relative;min-height:520px;display:grid;grid-template-columns:1fr 1fr;
  background:#082744;color:#fff;overflow:hidden}
.story-image{position:relative;min-height:520px;overflow:hidden}
.story-image img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .8s ease}
.story-band:hover .story-image img{transform:scale(1.04)}
.story-image::after{content:"";position:absolute;inset:0;background:linear-gradient(90deg,transparent 45%,#082744 100%)}
.story-content{position:relative;display:flex;align-items:center;padding:70px clamp(2rem,7vw,7rem) 70px 4rem;overflow:hidden}
.story-content::before{content:"1968";position:absolute;right:-20px;bottom:-45px;
  font-family:var(--font-display);font-size:12rem;line-height:1;font-weight:900;
  color:rgba(255,255,255,.04);-webkit-text-stroke:1px rgba(255,255,255,.05)}
.story-content-inner{position:relative;z-index:2;max-width:560px}
.story-content h2{font-family:var(--font-display);font-size:clamp(2.2rem,4vw,4rem);line-height:.98;margin:0 0 1rem}
.story-content h2 span{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.story-content p{color:rgba(255,255,255,.76);line-height:1.9;font-size:.92rem}
.story-list{display:grid;grid-template-columns:1fr 1fr;gap:.8rem;margin-top:1.5rem}
.story-chip{padding:.8rem;border:1px solid rgba(255,255,255,.12);border-radius:14px;
  background:rgba(255,255,255,.05);font-size:.74rem;font-weight:800;backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px)}
.story-chip i{color:#ffd54a;margin-right:.4rem}

/* ---------- MOSAIC ---------- */
.mosaic-section{padding:110px 0;background:#fff}
.mosaic-head{width:min(1380px,92%);margin:0 auto 45px}
.mosaic{width:min(1380px,92%);margin:auto;display:grid;grid-template-columns:1.3fr .7fr .7fr;
  grid-template-rows:280px 280px;gap:14px}
.mosaic-card{position:relative;overflow:hidden;border-radius:22px;background:#0d3a66;
  box-shadow:0 18px 44px rgba(13,58,102,.12)}
.mosaic-card.big{grid-row:span 2}
.mosaic-card img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .7s ease}
.mosaic-card:hover img{transform:scale(1.06)}
.mosaic-card::after{content:"";position:absolute;inset:0;
  background:linear-gradient(180deg,transparent 35%,rgba(4,22,40,.88) 100%)}
.mosaic-label{position:absolute;z-index:2;left:1.2rem;right:1.2rem;bottom:1.1rem;color:#fff}
.mosaic-label small{display:block;color:#ffd54a;font-size:.64rem;font-weight:900;
  letter-spacing:.18em;text-transform:uppercase}
.mosaic-label strong{display:block;font-family:var(--font-display);font-size:1.22rem;margin-top:.25rem}

/* ---------- PRESENT / FUTURE (teal deep) ---------- */
.future{padding:110px 0 120px;position:relative;overflow:hidden;
  background:linear-gradient(135deg,#0b3558,#0d3a66 45%,#0d3a66);color:#fff}
.future::before{content:"";position:absolute;width:520px;height:520px;right:-210px;top:-230px;
  border:1px solid rgba(255,255,255,.14);transform:rotate(45deg);
  box-shadow:0 0 0 35px rgba(13,58,102,.08),0 0 0 70px rgba(255,255,255,.03)}
.future::after{content:"VOKASI";position:absolute;left:-1%;bottom:-40px;
  font-family:var(--font-display);font-size:clamp(5rem,16vw,15rem);font-weight:900;line-height:1;
  letter-spacing:.04em;color:rgba(255,255,255,.045);-webkit-text-stroke:1px rgba(255,255,255,.06);
  pointer-events:none;white-space:nowrap;user-select:none}
.future-inner{width:min(1180px,92%);margin:auto;position:relative;z-index:2;text-align:center}
.future .big-heading{color:#fff}
.future .big-heading span{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.future .eyebrow{color:#2f6fa8}
.future-copy{max-width:720px;margin:1rem auto 2rem;color:rgba(235,245,253,.8);line-height:1.8}
.future-points{display:flex;justify-content:center;gap:.8rem;flex-wrap:wrap}
.future-point{padding:.65rem .9rem;border:1px solid rgba(255,255,255,.16);
  background:rgba(255,255,255,.07);border-radius:999px;font-size:.72rem;font-weight:800;
  backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);transition:transform .3s ease,background .3s ease}
.future-point:hover{transform:translateY(-3px);background:rgba(255,255,255,.14)}
.future-point i{color:#ffd54a;margin-right:.35rem}

/* ---------- SCROLL REVEAL ---------- */
[data-reveal]{opacity:0;transform:translateY(36px);
  transition:opacity .85s cubic-bezier(.22,.61,.36,1),transform .85s cubic-bezier(.22,.61,.36,1);
  will-change:opacity,transform}
[data-reveal="left"]{transform:translateX(-46px)}
[data-reveal="right"]{transform:translateX(46px)}
[data-reveal].revealed{opacity:1;transform:none}
[data-reveal]{transition-delay:calc(var(--d,0)*90ms)}

/* ---------- FINAL HERO TUNING ---------- */
.history-hero-inner{width:100%;max-width:1500px}
.history-title{max-width:1250px}
@media(max-width:700px){
  .history-hero{min-height:70vh}
  .history-hero-inner{padding-top:3.5rem;padding-bottom:4rem}
  .history-title{font-size:clamp(3.5rem,16vw,6rem);line-height:.88}
  .history-hero::after{font-size:clamp(7rem,32vw,12rem);left:-8%}
}


/* ---------- VISIBLE NAVY ORNAMENTS + UNIVERSAL HOVER ---------- */
.history-page{position:relative}
.history-page::before{content:"";position:fixed;right:-110px;top:18%;width:230px;height:230px;border:2px solid rgba(13,58,102,.14);transform:rotate(45deg);z-index:0;pointer-events:none}
.history-page::after{content:"";position:fixed;left:-95px;bottom:10%;width:190px;height:190px;border:2px solid rgba(47,111,168,.14);border-radius:28px;transform:rotate(25deg);z-index:0;pointer-events:none}
.history-hero,.history-intro,.timeline-section,.story-band,.mosaic-section,.future{position:relative;z-index:1}
.history-hero-inner::before{content:"";position:absolute;left:-28px;top:18%;width:12px;height:180px;border-left:3px solid #ffd54a;border-top:3px solid #ffd54a;opacity:.9}
.history-hero-inner::after{content:"";position:absolute;right:44%;top:8%;width:72px;height:72px;border:2px solid rgba(255,213,74,.55);transform:rotate(45deg);pointer-events:none}
.timeline-section::after{content:"";position:absolute;right:5%;top:9%;width:90px;height:90px;border:3px solid rgba(13,58,102,.12);transform:rotate(45deg);pointer-events:none}
.mosaic-section::before{content:"";position:absolute;left:4%;top:70px;width:46px;height:46px;border-radius:50%;background:radial-gradient(circle,#ffd54a 0 4px,transparent 5px);background-size:15px 15px;opacity:.7}
.story-band::before{content:"";position:absolute;left:50%;top:22px;width:120px;height:4px;background:linear-gradient(90deg,transparent,#ffd54a,transparent);z-index:3;opacity:.8}
.future::before{border-color:rgba(255,255,255,.18)!important}

/* Hover language across all interactive/content blocks */
.history-page .history-kicker,
.history-page .history-pill,
.history-page .eyebrow,
.history-page .stat-box,
.history-page .timeline-card,
.history-page .timeline-marker,
.history-page .story-chip,
.history-page .mosaic-card,
.history-page .future-point,
.history-page .hero-photo,
.history-page .big-heading,
.history-page .history-title{
  transition:transform .35s ease,box-shadow .35s ease,filter .35s ease,border-color .35s ease,background .35s ease;
}
.history-page .history-pill:hover{transform:translateY(-4px);background:rgba(13,58,102,.55);border-color:rgba(255,213,74,.5)}
.history-page .history-kicker:hover{transform:translateX(7px);filter:drop-shadow(0 5px 12px rgba(255,213,74,.2))}
.history-page .eyebrow:hover{transform:translateX(6px)}
.history-page .stat-box:hover{transform:translateY(-9px) rotate(-.5deg);border-color:rgba(13,58,102,.32);box-shadow:0 28px 58px rgba(13,58,102,.18)}
.history-page .timeline-card:hover{transform:translateY(-9px) scale(1.015);border-color:rgba(13,58,102,.22);box-shadow:0 30px 65px rgba(13,58,102,.2)}
.history-page .timeline-card:hover::before{width:8px}
.history-page .timeline-marker:hover{transform:rotate(45deg) scale(1.1);box-shadow:0 16px 35px rgba(13,58,102,.38)}
.history-page .hero-photo:hover{transform:translateY(-42px) rotate(0deg) scale(1.015);box-shadow:0 45px 95px rgba(13,58,102,.35),0 18px 35px rgba(0,0,0,.22)}
.history-page .hero-photo:hover img{transform:scale(1.07)}
.history-page .story-chip:hover{transform:translateY(-5px);border-color:rgba(255,213,74,.4);background:rgba(255,255,255,.11)}
.history-page .mosaic-card:hover{transform:translateY(-7px);box-shadow:0 28px 58px rgba(13,58,102,.22)}
.history-page .future-point:hover{transform:translateY(-5px) scale(1.02);box-shadow:0 10px 24px rgba(13,58,102,.12)}
.history-page .big-heading:hover{transform:translateX(4px)}
@media(max-width:700px){
 .history-hero-inner::before{left:0;top:14%;height:110px}
 .history-hero-inner::after{right:5%;top:4%;width:48px;height:48px}
 .history-page::before,.history-page::after{opacity:.45}
}


/* =========================================================
   ORNAMEN STYLE BERANDA — GEOMETRIC, BESAR, TERLIHAT
   ========================================================= */
.history-page{overflow:hidden}
.home-orn{
  position:absolute;inset:0;z-index:0;pointer-events:none;overflow:hidden;
}
.home-orn .ho-chevron{
  position:absolute;width:360px;height:360px;
  border-top:2px solid rgba(13,58,102,.11);
  border-right:2px solid rgba(13,58,102,.11);
  transform:rotate(45deg);
}
.home-orn .ho-chevron::after{
  content:"";position:absolute;inset:34px;
  border-top:2px solid rgba(47,111,168,.09);
  border-right:2px solid rgba(47,111,168,.09);
}
.home-orn .ho-line{
  position:absolute;width:310px;height:2px;
  background:linear-gradient(90deg,transparent,#2f6fa8,transparent);
  opacity:.25;transform:rotate(-42deg);
}
.home-orn .ho-line::after{
  content:"";position:absolute;left:70px;top:11px;width:190px;height:1px;
  background:linear-gradient(90deg,transparent,#ffd54a,transparent);
}
.home-orn .ho-dots{
  position:absolute;width:125px;height:125px;
  background-image:radial-gradient(circle,#2f6fa8 2px,transparent 2.8px);
  background-size:18px 18px;opacity:.38;
}
.home-orn .ho-ring{
  position:absolute;width:170px;height:170px;border:1px solid rgba(13,58,102,.13);
  border-radius:50%;box-shadow:0 0 0 20px rgba(13,58,102,.025),0 0 0 42px rgba(255,213,74,.025);
}
.home-orn .ho-ring::before{
  content:"";position:absolute;inset:22px;border:1px dashed rgba(47,111,168,.18);border-radius:50%;
}
.home-orn .ho-gold{
  position:absolute;width:52px;height:8px;border-radius:99px;
  background:linear-gradient(90deg,#ffd54a,#ffb300,#ff7a00);
  box-shadow:0 8px 22px rgba(255,179,0,.18);
  transform:rotate(-35deg);
}
.home-orn .ho-square{
  position:absolute;width:58px;height:58px;border:2px solid rgba(255,179,0,.32);
  transform:rotate(45deg);
}
.home-orn .ho-square::before{
  content:"";position:absolute;inset:10px;border:1px solid rgba(13,58,102,.18);
}
.home-orn .ho-corner{
  position:absolute;width:110px;height:110px;
  border-left:3px solid rgba(13,58,102,.12);
  border-bottom:3px solid rgba(13,58,102,.12);
}
.home-orn .ho-corner::after{
  content:"";position:absolute;left:18px;bottom:18px;width:46px;height:3px;
  background:#ffd54a;border-radius:99px;transform:rotate(0deg);
}

/* Posisi tiap bagian dibuat seperti bahasa visual Beranda, tetapi berbeda */
.history-intro .home-orn .ho-chevron{right:-130px;top:70px}
.history-intro .home-orn .ho-line{left:-55px;bottom:75px}
.history-intro .home-orn .ho-dots{right:18%;bottom:55px}
.history-intro .home-orn .ho-ring{left:-80px;top:35%}
.history-intro .home-orn .ho-gold{right:12%;top:26%}
.history-intro .home-orn .ho-square{left:13%;bottom:18%}

.timeline-section .home-orn .ho-chevron{right:-145px;top:45px}
.timeline-section .home-orn .ho-line{left:-80px;top:170px}
.timeline-section .home-orn .ho-dots{left:3%;bottom:100px}
.timeline-section .home-orn .ho-ring{right:8%;bottom:90px}
.timeline-section .home-orn .ho-gold{right:16%;top:22%}
.timeline-section .home-orn .ho-square{left:11%;top:15%}
.timeline-section .home-orn .ho-corner{right:3%;bottom:8%;transform:rotate(180deg)}

.story-band .home-orn .ho-chevron{left:-150px;top:35px;border-color:rgba(255,255,255,.10)}
.story-band .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.09)}
.story-band .home-orn .ho-line{right:-80px;bottom:95px}
.story-band .home-orn .ho-dots{right:6%;top:90px;opacity:.25}
.story-band .home-orn .ho-ring{left:43%;bottom:-90px;border-color:rgba(255,255,255,.12)}
.story-band .home-orn .ho-gold{right:14%;top:28%}

.mosaic-section .home-orn .ho-chevron{right:-150px;top:20px}
.mosaic-section .home-orn .ho-line{left:-80px;bottom:100px}
.mosaic-section .home-orn .ho-dots{left:4%;top:125px}
.mosaic-section .home-orn .ho-ring{right:3%;bottom:70px}
.mosaic-section .home-orn .ho-gold{left:10%;top:24%}
.mosaic-section .home-orn .ho-square{right:15%;top:20%}

.future .home-orn .ho-chevron{right:-125px;top:-100px;border-color:rgba(255,255,255,.12)}
.future .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.future .home-orn .ho-line{left:-80px;bottom:80px;opacity:.22}
.future .home-orn .ho-dots{right:7%;bottom:80px;opacity:.2}
.future .home-orn .ho-ring{left:-80px;top:25%;border-color:rgba(255,255,255,.10)}
.future .home-orn .ho-gold{right:22%;bottom:18%}

/* KEPALA SEKOLAH: lebih premium dan jelas */
.future:first-of-type .home-orn .ho-chevron{right:-100px;top:30px}
.future:first-of-type .home-orn .ho-ring{left:-65px;bottom:-35px}
.future:first-of-type .home-orn .ho-dots{right:8%;top:35%}
.future:first-of-type .home-orn .ho-square{left:14%;top:18%}
.future:first-of-type .home-orn .ho-gold{right:18%;top:20%}

/* Bab-bab: ornamen ekstra di judul dan garis timeline */
.timeline-section .timeline-head{position:relative}
.timeline-section .timeline-head::before{
  content:"";position:absolute;left:-32px;top:-12px;width:26px;height:26px;
  border-left:3px solid #ffd54a;border-top:3px solid #ffd54a;
}
.timeline-section .timeline-head::after{
  content:"";position:absolute;right:30%;top:0;width:10px;height:10px;
  background:#ffd54a;border-radius:50%;box-shadow:18px 10px 0 rgba(47,111,168,.35),36px 0 0 rgba(47,111,168,.18);
}
.timeline-section .timeline-card{
  position:relative;overflow:visible;
}
.timeline-section .timeline-card::after{
  content:"";position:absolute;right:-8px;bottom:-8px;width:36px;height:36px;
  border-right:2px solid rgba(47,111,168,.20);
  border-bottom:2px solid rgba(47,111,168,.20);
}
.timeline-section .timeline-marker{
  position:relative;
}
.timeline-section .timeline-marker::after{
  content:"";position:absolute;inset:-9px;border:1px solid rgba(255,179,0,.30);
  border-radius:50%;transform:rotate(-12deg);
}

/* Jangan mengganggu konten */
.history-intro>*:not(.home-orn),
.timeline-section>*:not(.home-orn),
.story-band>*:not(.home-orn),
.mosaic-section>*:not(.home-orn),
.future>*:not(.home-orn){position:relative;z-index:2}

@media(max-width:700px){
  .home-orn .ho-chevron{width:220px;height:220px}
  .home-orn .ho-dots{width:80px;height:80px;background-size:14px 14px}
  .home-orn .ho-ring{width:110px;height:110px}
  .home-orn .ho-line{width:190px}
  .home-orn .ho-square{width:42px;height:42px}
  .home-orn .ho-corner{width:70px;height:70px}
  .timeline-section .timeline-head::before{left:0}
}


/* =========================================================
   BAB-BAB — ORNAMEN PENUH SEPERTI BERANDA/JURUSAN
   Mengisi ruang kosong kiri-kanan timeline
   ========================================================= */
.timeline-section{
  overflow:hidden;
  isolation:isolate;
  background:
    radial-gradient(circle at 8% 18%,rgba(47,111,168,.12) 0 2px,transparent 3px),
    radial-gradient(circle at 91% 27%,rgba(255,179,0,.16) 0 3px,transparent 4px),
    radial-gradient(circle at 13% 78%,rgba(47,111,168,.10) 0 2px,transparent 3px),
    linear-gradient(180deg,#f8fbfe 0%,#eef5fa 100%);
}
/* pola titik besar kiri */
.timeline-section::after{
  content:"";
  position:absolute;
  left:-35px;
  top:180px;
  width:185px;height:185px;
  background-image:radial-gradient(circle,rgba(31,100,170,.45) 2.2px,transparent 3px);
  background-size:20px 20px;
  opacity:.65;
  pointer-events:none;
  z-index:0;
}
/* pola titik kanan bawah */
.timeline-section::before{
  content:"";
  position:absolute;
  right:-20px;
  bottom:90px;
  width:175px;height:175px;
  background-image:radial-gradient(circle,rgba(255,179,0,.55) 2px,transparent 3px);
  background-size:19px 19px;
  opacity:.5;
  pointer-events:none;
  z-index:0;
}

/* dua lingkaran raksasa yang sengaja ditempatkan di area kosong */
.timeline{
  position:relative;
}
.timeline::after{
  content:"";
  position:absolute;
  right:-150px;
  top:50px;
  width:360px;height:360px;
  border:2px solid rgba(47,111,168,.15);
  border-radius:50%;
  box-shadow:
    0 0 0 24px rgba(47,111,168,.035),
    0 0 0 52px rgba(47,111,168,.025),
    0 0 0 82px rgba(255,179,0,.018);
  pointer-events:none;
  z-index:0;
}
.timeline::after{
  /* keep the large ring visible behind cards */
}

/* garis diagonal ala beranda */
.timeline-head::after{
  content:"";
  position:absolute;
  width:430px;height:3px;
  right:-80px;top:72px;
  background:linear-gradient(90deg,transparent,rgba(47,111,168,.22),rgba(255,179,0,.35),transparent);
  transform:rotate(-35deg);
  box-shadow:0 18px 0 rgba(47,111,168,.07),0 36px 0 rgba(47,111,168,.045);
  pointer-events:none;
}
/* dekorasi diagonal kiri */
.timeline-head::before{
  content:"";
  position:absolute;
  left:-40px;top:-20px;
  width:100px;height:100px;
  border-left:5px solid rgba(47,111,168,.16);
  border-bottom:5px solid rgba(47,111,168,.16);
  transform:rotate(45deg);
  box-shadow:12px 12px 0 rgba(255,179,0,.10);
  pointer-events:none;
}

/* titik-titik kecil menyebar di tiap ruang */
.timeline-item::after{
  content:"";
  position:absolute;
  width:7px;height:7px;border-radius:50%;
  background:#ffb300;
  box-shadow:
    24px 18px 0 rgba(47,111,168,.50),
    48px -4px 0 rgba(47,111,168,.28),
    72px 22px 0 rgba(255,179,0,.40);
  opacity:.8;
  z-index:0;
}
.timeline-item.left::after{left:8px;top:100px}
.timeline-item.right::after{right:8px;top:100px}

/* chevron raksasa di sisi kiri */
.timeline-item.left:nth-child(odd)::before,
.timeline-item.right:nth-child(even)::before{
  content:"";
  position:absolute;
  width:170px;height:170px;
  border-left:16px solid rgba(47,111,168,.065);
  border-bottom:16px solid rgba(47,111,168,.065);
  transform:rotate(45deg);
  pointer-events:none;
  z-index:0;
}
.timeline-item.left:nth-child(odd)::before{left:-125px;top:30px}
.timeline-item.right:nth-child(even)::before{right:-125px;top:25px}

/* aksen slashes warna gold di dekat card */
.timeline-item:nth-child(1) .timeline-card::after,
.timeline-item:nth-child(3) .timeline-card::after,
.timeline-item:nth-child(5) .timeline-card::after{
  content:"";
  position:absolute;
  right:24px;bottom:18px;
  width:64px;height:28px;
  background:
    linear-gradient(110deg,transparent 0 25%,#ffb300 26% 30%,transparent 31% 55%,#2f6fa8 56% 60%,transparent 61%);
  opacity:.55;
  pointer-events:none;
}
.timeline-item:nth-child(2) .timeline-card::after,
.timeline-item:nth-child(4) .timeline-card::after,
.timeline-item:nth-child(6) .timeline-card::after{
  content:"";
  position:absolute;
  left:24px;bottom:18px;
  width:64px;height:28px;
  background:
    linear-gradient(110deg,transparent 0 25%,#2f6fa8 26% 30%,transparent 31% 55%,#ffb300 56% 60%,transparent 61%);
  opacity:.55;
  pointer-events:none;
}

/* node timeline lebih dekoratif */
.timeline-marker{
  box-shadow:
    0 12px 28px rgba(13,58,102,.3),
    0 0 0 9px rgba(47,111,168,.08),
    0 0 0 16px rgba(255,179,0,.035);
}
.timeline-marker::after{
  content:"";
  position:absolute;
  inset:-12px;
  border:1px dashed rgba(255,179,0,.45);
  border-radius:50%;
  transform:rotate(-20deg);
}

/* ornamen kecil di header judul */
.timeline-head .eyebrow{
  position:relative;
  display:inline-flex;
  align-items:center;
  gap:10px;
}
.timeline-head .eyebrow::before{
  content:"";
  width:42px;height:3px;
  border-radius:99px;
  background:linear-gradient(90deg,#0d3a66,#ffb300);
}
.timeline-head .eyebrow::after{
  content:"• • •";
  color:#ffb300;
  letter-spacing:5px;
  font-size:12px;
}

/* supaya ornamen berada di belakang konten, tapi tetap terlihat */
.timeline-section > .timeline-head,
.timeline-section > .timeline{
  position:relative;
  z-index:2;
}

/* tambahan untuk layar lebar */
@media(min-width:1100px){
  .timeline-item.left::after{left:-18px}
  .timeline-item.right::after{right:-18px}
}

/* mobile: tetap ramai tapi tidak menutupi card */
@media(max-width:700px){
  .timeline-section::after{width:105px;height:105px;left:-45px;top:190px}
  .timeline-section::before{width:105px;height:105px;right:-45px;bottom:70px}
  .timeline::after{width:190px;height:190px;right:-120px}
  .timeline-head::after{width:220px;right:-100px}
  .timeline-item.left:nth-child(odd)::before,
  .timeline-item.right:nth-child(even)::before{width:110px;height:110px}
}

/* ---------- RESPONSIVE ---------- */
@media(max-width:950px){
  .history-hero-inner{grid-template-columns:1fr;gap:2rem}
  .hero-photo{height:360px}
  .intro-grid{grid-template-columns:1fr;gap:2.5rem}
  .timeline-head{display:block}
  .timeline-note{text-align:left;margin-top:1rem}
  .story-band{grid-template-columns:1fr}
  .story-image{min-height:360px}
  .story-image::after{background:linear-gradient(180deg,transparent 35%,#082744 100%)}
  .story-content{padding:55px 7% 70px}
  .mosaic{grid-template-columns:1fr 1fr;grid-template-rows:260px 260px}
  .mosaic-card.big{grid-row:auto;grid-column:span 2}
}
@media(max-width:700px){
  .history-hero{min-height:0;align-items:flex-start}
  .history-hero-inner{padding:clamp(3rem,8vh,4.5rem) 0 3.6rem;width:90%}
  .history-hero::after{font-size:clamp(4.5rem,26vw,7rem);opacity:.6}
  .history-title{font-size:clamp(2.5rem,12vw,4rem);margin-top:0}
  .hero-photo{height:300px}
  .stat-strip{grid-template-columns:1fr 1fr}
  .timeline{width:90%}
  .timeline::before{left:18px;transform:none}
  .timeline-item,.timeline-item.left,.timeline-item.right{width:100%;left:0;text-align:left;
    padding:0 0 42px 58px}
  .timeline-item.left .timeline-marker,.timeline-item.right .timeline-marker{left:-10px;right:auto;
    width:46px;height:46px}
  .timeline-card{padding:1.3rem 1.2rem}
  .timeline-year{font-size:1.8rem}
  .story-image{min-height:280px}
  .story-content{padding:45px 7% 60px}
  .story-list{grid-template-columns:1fr}
  .mosaic{grid-template-columns:1fr;grid-template-rows:230px 230px 230px}
  .mosaic-card.big{grid-column:auto}
  .future{padding:85px 0 90px}
  [data-reveal]{opacity:1;transform:none}
}
/* =========================================================
   KEPEMIMPINAN — INSTAGRAM-STYLE HISTORY
   Satu post dominan, foto 3:4, carousel halus, premium.
   ========================================================= */
.principal-section{
  position:relative;overflow:hidden;isolation:isolate;
  padding:120px 0 135px;
  background:
    radial-gradient(circle at 7% 20%,rgba(13,58,102,.10) 0 2px,transparent 3px),
    radial-gradient(circle at 93% 28%,rgba(255,179,0,.14) 0 3px,transparent 4px),
    linear-gradient(180deg,#ffffff 0%,#f5f8fc 55%,#edf3f8 100%);
  z-index:1;
}
.principal-section::before{
  content:"";position:absolute;left:-90px;bottom:70px;width:280px;height:280px;
  background-image:radial-gradient(circle,rgba(13,58,102,.25) 2px,transparent 3px);
  background-size:22px 22px;opacity:.42;pointer-events:none;z-index:0;
}
.principal-section::after{
  content:"";position:absolute;right:-80px;top:105px;width:260px;height:260px;
  border:1px solid rgba(13,58,102,.12);border-radius:50%;
  box-shadow:0 0 0 26px rgba(13,58,102,.025),0 0 0 56px rgba(255,179,0,.025);
  pointer-events:none;z-index:0;
}
.principal-section .home-orn .ho-chevron{left:-170px;top:20px;width:410px;height:410px}
.principal-section .home-orn .ho-chevron::after{inset:46px}
.principal-section .home-orn .ho-ring{right:-100px;top:22%;width:240px;height:240px}
.principal-section .home-orn .ho-dots{right:8%;bottom:55px;width:145px;height:145px;opacity:.46}
.principal-section .home-orn .ho-gold{left:15%;top:25%}
.principal-section .home-orn .ho-square{right:17%;top:31%}
.principal-section .home-orn .ho-corner{left:4%;bottom:7%;transform:rotate(180deg);width:125px;height:125px}
.principal-head{
  width:min(1080px,92%);margin:0 auto 3.8rem;text-align:center;
  position:relative;z-index:2;
}
.principal-head .eyebrow{justify-content:center}
.principal-head .eyebrow::after{
  content:"• • •";color:#ffb300;letter-spacing:5px;font-size:12px;margin-left:.35rem
}
.principal-head .big-heading{
  margin:0 auto;font-size:clamp(2.8rem,5.2vw,5rem);
  letter-spacing:-.035em;text-shadow:0 10px 28px rgba(13,58,102,.08)
}
.principal-head .big-heading span{
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;
  -webkit-text-fill-color:transparent;color:transparent;
}
.principal-desc{
  max-width:660px;margin:1rem auto 0;color:#687c90;
  font-size:.95rem;line-height:1.85
}
.principal-stage{
  position:relative;z-index:2;width:min(1050px,94%);margin:0 auto;
  display:flex;align-items:center;gap:1rem;
}
.principal-viewport{
  flex:1;min-width:0;overflow:hidden;border-radius:30px;
  padding:10px 8px 22px;
}
.principal-track{
  display:flex;gap:1.5rem;
  transition:transform .65s cubic-bezier(.22,.61,.36,1);
  will-change:transform;
}
.principal-post{
  flex:0 0 min(430px,82vw);
  background:#fff;border:1px solid rgba(13,58,102,.13);
  border-radius:24px;overflow:hidden;
  box-shadow:0 22px 58px rgba(13,58,102,.13),0 4px 12px rgba(13,58,102,.05);
  transition:transform .4s ease,box-shadow .4s ease,border-color .3s ease;
}
.principal-post:hover{
  transform:translateY(-8px);
  box-shadow:0 32px 75px rgba(13,58,102,.19);
  border-color:rgba(255,179,0,.42)
}
.principal-post-head{
  height:64px;padding:.75rem .9rem;
  display:flex;align-items:center;justify-content:space-between;gap:.8rem;
  border-bottom:1px solid #edf2f6;background:#fff
}
.principal-profile{display:flex;align-items:center;gap:.65rem;min-width:0}
.principal-avatar{
  width:38px;height:38px;flex:0 0 38px;border-radius:50%;
  display:grid;place-items:center;color:#ffd54a;
  background:linear-gradient(135deg,#0d3a66,#174f80);
  box-shadow:0 6px 15px rgba(13,58,102,.2)
}
.principal-profile strong{display:block;color:#0d3a66;font-size:.78rem;font-weight:900;line-height:1.15}
.principal-profile span{display:block;color:#8293a4;font-size:.64rem;margin-top:.15rem}
.principal-more{color:#7d8fa1;font-size:1rem}
.principal-photo{
  position:relative;width:100%;aspect-ratio:3/4;
  min-height:430px;max-height:620px;overflow:hidden;
  background:linear-gradient(160deg,#eef5fb 0%,#dce9f4 58%,#c9d9e7 100%);
  display:flex;align-items:flex-end;justify-content:center;
}
.principal-photo img{
  width:100%;height:100%;object-fit:contain;object-position:center bottom;
  display:block;padding:0 1.2rem 0;
  filter:drop-shadow(0 18px 20px rgba(13,58,102,.18));
  transition:transform .65s cubic-bezier(.22,.61,.36,1)
}
.principal-post:hover .principal-photo img{transform:scale(1.035) translateY(-3px)}
.principal-photo::after{
  content:"";position:absolute;inset:0;pointer-events:none;
  background:linear-gradient(180deg,transparent 62%,rgba(7,28,52,.18) 100%)
}
.principal-current{
  position:absolute;right:1rem;top:1rem;z-index:3;
  display:inline-flex;align-items:center;gap:.4rem;
  padding:.45rem .72rem;border-radius:999px;
  color:#fff;background:linear-gradient(135deg,#ffd54a,#ff8a00);
  font-size:.66rem;font-weight:900;letter-spacing:.08em;text-transform:uppercase;
  box-shadow:0 9px 22px rgba(255,138,0,.32)
}
.principal-current::before{
  content:"";width:7px;height:7px;border-radius:50%;background:#0d3a66;
  box-shadow:0 0 0 5px rgba(13,58,102,.08)
}
.principal-post-actions{
  display:flex;align-items:center;gap:1rem;padding:.8rem 1rem .45rem;color:#173f64;font-size:1.05rem
}
.principal-post-actions .spacer{margin-left:auto}
.principal-post-body{padding:0 1rem 1.15rem}
.principal-like{color:#0d3a66;font-size:.72rem;font-weight:900;margin-bottom:.45rem}
.principal-caption{color:#5f7186;font-size:.78rem;line-height:1.65;margin:0}
.principal-caption strong{color:#0d3a66}
.principal-period{
  display:inline-flex;align-items:center;gap:.5rem;margin-top:.75rem;
  padding:.42rem .68rem;border-radius:999px;
  color:#ff8a00;background:#fff7e8;border:1px solid rgba(255,179,0,.25);
  font-size:.68rem;font-weight:900;letter-spacing:.06em
}
.principal-period::before{
  content:"";width:20px;height:2px;border-radius:99px;
  background:linear-gradient(90deg,#ffd54a,#ff8a00)
}
.principal-arrow{
  flex:0 0 50px;width:50px;height:50px;border:0;border-radius:50%;
  cursor:pointer;display:grid;place-items:center;
  background:linear-gradient(135deg,#0d3a66,#173f64);color:#fff;
  font-size:1rem;box-shadow:0 12px 28px rgba(13,58,102,.28);
  transition:transform .3s ease,box-shadow .3s ease,background .3s ease
}
.principal-arrow:hover{
  transform:translateY(-3px) scale(1.06);
  background:linear-gradient(135deg,#ffb300,#ff8a00);
  box-shadow:0 18px 38px rgba(13,58,102,.3)
}
.principal-arrow:disabled{opacity:.35;cursor:default;transform:none}
.principal-dots{
  display:flex;justify-content:center;gap:.55rem;margin-top:1.35rem;
  position:relative;z-index:2
}
.principal-dots button{
  width:9px;height:9px;border:0;border-radius:99px;padding:0;cursor:pointer;
  background:rgba(13,58,102,.22);transition:all .3s ease
}
.principal-dots button.is-active{width:28px;background:linear-gradient(90deg,#ffd54a,#ff8a00)}
.principal-section > .principal-head,
.principal-section > .principal-stage,
.principal-section > .principal-dots{position:relative;z-index:2}
@media(max-width:700px){
  .principal-section{padding:85px 0 100px}
  .principal-head{margin-bottom:2.8rem}
  .principal-stage{width:100%;gap:.35rem}
  .principal-viewport{padding:8px 4px 18px}
  .principal-post{flex-basis:86vw;max-width:430px}
  .principal-photo{min-height:390px}
  .principal-arrow{flex-basis:42px;width:42px;height:42px;font-size:.9rem}
  .principal-section .home-orn .ho-chevron{width:260px;height:260px;left:-110px;top:30px}
  .principal-section .home-orn .ho-ring{width:150px;height:150px;right:-60px}
  .principal-section .home-orn .ho-dots{width:90px;height:90px;background-size:14px 14px}
}

/* =========================================================
   VIRTUAL TOUR 360 — mengikuti bahasa visual Beranda
   ========================================================= */
.vt-section{
  position:relative;overflow:hidden;isolation:isolate;padding:120px 0 130px;
  background:linear-gradient(180deg,#eef5fb 0%,#ffffff 48%,#f3f7fb 100%);
}
.vt-section::before{content:"";position:absolute;inset:0;pointer-events:none;opacity:.42;
  background-image:radial-gradient(circle,rgba(13,58,102,.18) 1.5px,transparent 2px);
  background-size:22px 22px;mask-image:linear-gradient(90deg,transparent 0%,#000 15%,#000 85%,transparent 100%);
}
.vt-watermark{position:absolute;right:-20px;top:40px;font-size:clamp(9rem,18vw,16rem);font-weight:900;line-height:.8;color:rgba(13,58,102,.035);letter-spacing:-.08em;z-index:0;user-select:none}
.vt-decor-ring{position:absolute;right:-70px;top:80px;width:300px;height:300px;border:1px solid rgba(13,58,102,.12);border-radius:50%;z-index:0}
.vt-decor-ring::before{content:"";position:absolute;inset:35px;border:1px dashed rgba(255,179,0,.3);border-radius:50%}
.vt-decor-dots{position:absolute;left:4%;bottom:65px;width:125px;height:125px;opacity:.42;background-image:radial-gradient(circle,#ffb300 2px,transparent 2.5px);background-size:18px 18px;z-index:0}
.vt-inner{position:relative;z-index:2;width:min(1180px,92%);margin:0 auto;display:grid;grid-template-columns:minmax(0,1.05fr) minmax(360px,.95fr);gap:4.5rem;align-items:center}
.vt-media{min-width:0}
.vt-frame{position:relative;overflow:hidden;border-radius:30px;background:#0d3a66;box-shadow:0 30px 75px rgba(13,58,102,.2);aspect-ratio:16/10;border:1px solid rgba(255,255,255,.65)}
.vt-frame::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 42%,rgba(5,25,48,.78) 100%);pointer-events:none}
.vt-frame img{width:100%;height:100%;display:block;object-fit:cover;transition:transform .7s cubic-bezier(.22,.61,.36,1)}
.vt-frame:hover img{transform:scale(1.045)}
.vt-badge{position:absolute;left:1.2rem;top:1.2rem;z-index:3;display:inline-flex;align-items:center;gap:.5rem;padding:.58rem .85rem;border-radius:999px;background:rgba(13,58,102,.86);color:#fff;font-size:.74rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;backdrop-filter:blur(8px)}
.vt-play{position:absolute;z-index:4;left:50%;top:50%;transform:translate(-50%,-50%);width:78px;height:78px;border-radius:50%;border:7px solid rgba(255,255,255,.22);background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:1.35rem;display:grid;place-items:center;cursor:pointer;box-shadow:0 18px 45px rgba(255,138,0,.38);transition:transform .3s ease,box-shadow .3s ease}
.vt-play:hover{transform:translate(-50%,-50%) scale(1.08);box-shadow:0 24px 55px rgba(255,138,0,.5)}
.vt-caption{position:absolute;left:1.4rem;right:1.4rem;bottom:1.25rem;z-index:3;display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;color:#fff}
.vt-caption strong{display:block;font-size:1.2rem;font-weight:900}.vt-caption span{display:block;margin-top:.22rem;color:rgba(255,255,255,.76);font-size:.78rem}
.vt-cam{display:inline-flex!important;align-items:center;gap:.4rem;padding:.48rem .7rem;border:1px solid rgba(255,255,255,.28);border-radius:999px!important;background:rgba(0,0,0,.18);white-space:nowrap}
.vt-chip{display:inline-flex;align-items:center;gap:.75rem;margin-top:1rem;padding:.75rem 1rem;border-radius:16px;background:#fff;border:1px solid rgba(13,58,102,.1);box-shadow:0 12px 30px rgba(13,58,102,.08)}
.vt-chip>i{width:40px;height:40px;border-radius:12px;display:grid;place-items:center;background:linear-gradient(135deg,#ffd54a,#ff9f00);color:#0d3a66}.vt-chip strong{display:block;color:#0d3a66;font-size:.85rem}.vt-chip span{display:block;color:#71839a;font-size:.68rem;margin-top:.15rem}
.vt-copy{position:relative}.vt-kicker{display:inline-flex;align-items:center;gap:.55rem;color:#0d3a66;font-size:.75rem;font-weight:900;letter-spacing:.16em;text-transform:uppercase}.vt-kicker::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ff8a00)}
.vt-title{margin:.8rem 0 1.1rem;color:#0d3a66;font-family:var(--font-display);font-size:clamp(2.8rem,5vw,4.8rem);font-weight:900;line-height:.98;letter-spacing:-.045em}.vt-gold{display:block;background:linear-gradient(90deg,#ffd54a,#ff8a00);-webkit-background-clip:text;background-clip:text;color:transparent}.vt-sub{display:block;margin-top:.55rem;font-size:.38em;line-height:1.1;letter-spacing:.02em;color:#315b80;font-weight:800}
.vt-desc{max-width:590px;color:#667b90;line-height:1.9;font-size:.98rem}.vt-feats{display:flex;flex-wrap:wrap;gap:.55rem;margin:1.25rem 0}.vt-feat{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem .75rem;border-radius:999px;background:#fff;border:1px solid rgba(13,58,102,.1);color:#315b80;font-size:.74rem;font-weight:800}.vt-feat i{color:#ff9f00}.vt-btn{display:inline-flex;align-items:center;justify-content:center;gap:.65rem;padding:.9rem 1.2rem;border-radius:14px;background:linear-gradient(135deg,#0d3a66,#164e80);color:#fff;text-decoration:none;font-weight:900;box-shadow:0 14px 32px rgba(13,58,102,.2);transition:transform .3s ease,box-shadow .3s ease}.vt-btn:hover{transform:translateY(-4px);box-shadow:0 20px 40px rgba(13,58,102,.28)}
@media(max-width:900px){.vt-inner{grid-template-columns:1fr;gap:2.5rem}.vt-copy{max-width:700px}.vt-title{font-size:clamp(2.6rem,10vw,4rem)}}
@media(max-width:600px){.vt-section{padding:85px 0 95px}.vt-inner{width:92%;gap:2rem}.vt-frame{aspect-ratio:4/3;border-radius:22px}.vt-play{width:64px;height:64px}.vt-caption{left:1rem;right:1rem;bottom:1rem}.vt-caption strong{font-size:1rem}.vt-caption span{font-size:.7rem}.vt-cam{display:none!important}.vt-title{font-size:clamp(2.35rem,12vw,3.3rem)}.vt-decor-ring{width:190px;height:190px;right:-80px}.vt-decor-dots{width:90px;height:90px;background-size:14px 14px}}

@media(max-width:700px){
  .principal-section{padding:85px 0 95px}
  .principal-head{margin-bottom:3.6rem}
  .principal-slider{width:100%;gap:.4rem}
  .principal-arrow{flex-basis:42px;width:42px;height:42px;font-size:.9rem}
  .principal-card{flex-basis:74vw;max-width:300px}
  .principal-photo{min-height:300px;aspect-ratio:3/4}
  .principal-section::before{width:150px;height:150px;left:-45px;bottom:70px}
  .principal-section::after{width:140px;height:140px;right:-45px;top:150px}
  .principal-section .home-orn .ho-chevron{width:260px;height:260px;left:-110px;top:30px}
  .principal-section .home-orn .ho-ring{width:150px;height:150px;right:-60px}
  .principal-section .home-orn .ho-dots{width:90px;height:90px;background-size:14px 14px}
}

  /* FINAL FIXES — no vertical rail, cleaner hero CTA and VT spacing */
  .history-hero-inner::before{display:none!important;content:none!important}
  .history-vt-cta{position:relative;z-index:4}
  .vt-section{scroll-margin-top:90px}
  .vt-inner{gap:clamp(2.5rem,5vw,4.5rem)}
  .vt-copy{padding-top:.25rem}
  .vt-title{max-width:620px}
  .vt-desc{margin-top:.2rem}
  @media(max-width:950px){
    .history-hero-inner{grid-template-columns:1fr;gap:2rem}
    .history-hero-inner>div:first-child{max-width:900px}
  }
  @media(max-width:700px){
    .history-vt-cta{width:min(100%,340px)}
    .history-vt-cta .history-vt-arrow{margin-left:auto}
  }


/* Hero ornament responsiveness — tetap ringan di layar kecil */
@media (max-width: 900px){
  .history-hero-geometry .hhg-path-a{width:240px;left:-70px;top:22%}
  .history-hero-geometry .hhg-path-b{width:280px;right:-110px;top:72%}
  .history-hero-geometry .hhg-path-c{left:10%;width:210px}
  .history-hero-geometry .hhg-diamond{width:52px;height:52px;right:8%;top:24%}
  .history-hero-geometry .hhg-corner{right:3%;top:8%;width:66px;height:66px}
  .history-hero-geometry .hhg-orbit{width:150px;height:66px;left:-48px;bottom:8%}
}
@media (max-width: 560px){
  .history-hero-geometry .hhg-node{width:9px;height:9px}
  .history-hero-geometry .hhg-node-a{left:8%;top:20%}
  .history-hero-geometry .hhg-node-b{left:18%;bottom:10%}
  .history-hero-geometry .hhg-node-c{right:11%;top:18%}
  .history-hero-geometry .hhg-node-d{right:5%;bottom:18%}
  .history-hero-geometry .hhg-diamond{right:5%;top:31%;width:38px;height:38px}
  .history-hero-geometry .hhg-dashes{left:4%;top:11%;width:60px;height:42px;background-size:10px 10px}
  .history-hero-geometry .hhg-corner{display:none}
  .history-hero-geometry .hhg-path-b{right:-145px}
}

/* =========================================================
   HERO ORNAMENT v2 — clean geometric network
   Hanya untuk Hero Sejarah. Tidak memakai ornamen hero lama.
   ========================================================= */
.history-hero > .home-orn{display:none}
.history-hero-inner::before,.history-hero-inner::after{display:none!important}
.history-hero-geometry{z-index:1;opacity:1}
.history-hero-geometry::before{
  content:"";position:absolute;left:-70px;top:-35px;width:300px;height:300px;border-radius:50%;
  background-image:radial-gradient(circle,rgba(13,58,102,.16) 1.5px,transparent 1.7px);
  background-size:18px 18px;opacity:.62;
  -webkit-mask-image:radial-gradient(circle at 52% 52%,#000 0 48%,transparent 72%);mask-image:radial-gradient(circle at 52% 52%,#000 0 48%,transparent 72%);
}
.history-hero-geometry::after{
  content:"";position:absolute;right:-30px;bottom:-40px;width:420px;height:190px;
  background:
    linear-gradient(135deg,transparent 47%,rgba(255,122,0,.62) 48%,rgba(255,122,0,.62) 49%,transparent 50%),
    linear-gradient(35deg,transparent 48%,rgba(13,58,102,.22) 49%,rgba(13,58,102,.22) 50%,transparent 51%);
  opacity:.75;transform:rotate(-5deg);
}
.history-hero-geometry .hhg-path{height:1.5px;opacity:.55;box-shadow:none}
.history-hero-geometry .hhg-path-a{width:430px;left:-95px;top:48%;background:#ff7a00;transform:rotate(30deg);opacity:.38}
.history-hero-geometry .hhg-path-b{width:470px;right:-150px;top:38%;background:#0d3a66;transform:rotate(-36deg);opacity:.22}
.history-hero-geometry .hhg-path-c{width:310px;left:auto;right:3%;bottom:15%;background:#ff7a00;transform:rotate(-13deg);opacity:.42}
.history-hero-geometry .hhg-node{width:11px;height:11px;border:2px solid #ff7a00;background:#fff;box-shadow:0 0 0 5px rgba(255,122,0,.08)}
.history-hero-geometry .hhg-node-a{left:8%;top:18%}
.history-hero-geometry .hhg-node-b{left:31%;bottom:12%}
.history-hero-geometry .hhg-node-c{right:22%;top:23%;border-color:#0d3a66;box-shadow:0 0 0 5px rgba(13,58,102,.06)}
.history-hero-geometry .hhg-node-d{right:8%;bottom:18%}
.history-hero-geometry .hhg-diamond{width:58px;height:58px;right:21%;top:18%;border:1px solid rgba(255,122,0,.34);background:transparent;box-shadow:none}
.history-hero-geometry .hhg-orbit{width:230px;height:100px;left:-75px;bottom:5%;border:1px solid rgba(13,58,102,.18);background:transparent;transform:rotate(-16deg)}
.history-hero-geometry .hhg-orbit::after{width:7px;height:7px;right:22px;top:9px;background:#ff7a00}
.history-hero-geometry .hhg-corner{right:2.5%;top:12%;width:110px;height:110px;border-top:1px solid rgba(255,122,0,.28);border-right:1px solid rgba(13,58,102,.18);border-radius:0 26px 0 0}
.history-hero-geometry .hhg-corner::after{width:45px;height:1.5px;right:-2px;top:46px;background:#ff7a00}
.history-hero-geometry .hhg-dashes{left:7%;top:11%;width:82px;height:54px;background-image:radial-gradient(circle,rgba(255,122,0,.32) 1.2px,transparent 1.4px);background-size:12px 12px;opacity:.75}
/* network joints: small connectors placed away from the headline */
.history-hero-geometry .hhg-node-a::after,.history-hero-geometry .hhg-node-b::after,.history-hero-geometry .hhg-node-c::after,.history-hero-geometry .hhg-node-d::after{content:"";position:absolute;width:72px;height:1px;background:rgba(255,122,0,.25);left:9px;top:5px;transform-origin:left center}
.history-hero-geometry .hhg-node-a::after{transform:rotate(28deg);width:95px}
.history-hero-geometry .hhg-node-b::after{transform:rotate(-18deg);width:110px}
.history-hero-geometry .hhg-node-c::after{transform:rotate(24deg);background:rgba(13,58,102,.20);width:90px}
.history-hero-geometry .hhg-node-d::after{transform:rotate(-34deg);width:70px}
@media(max-width:900px){
  .history-hero-geometry .hhg-path-a{width:250px;left:-90px;top:45%}
  .history-hero-geometry .hhg-path-b{width:300px;right:-150px;top:34%}
  .history-hero-geometry .hhg-diamond{right:8%;top:18%;width:42px;height:42px}
  .history-hero-geometry .hhg-corner{right:0;top:10%;width:75px;height:75px}
  .history-hero-geometry .hhg-orbit{width:160px;height:72px;left:-70px}
}
@media(max-width:560px){
  .history-hero-geometry::before{width:210px;height:210px;left:-70px;top:-25px;background-size:14px 14px}
  .history-hero-geometry::after{width:250px;height:120px;right:-80px;bottom:-20px}
  .history-hero-geometry .hhg-node-a{left:7%;top:16%}.history-hero-geometry .hhg-node-b{left:18%;bottom:10%}
  .history-hero-geometry .hhg-node-c{right:18%;top:20%}.history-hero-geometry .hhg-node-d{right:5%;bottom:15%}
  .history-hero-geometry .hhg-node::after{display:none}.history-hero-geometry .hhg-corner{display:none}
}



/* =========================================================
   HERO ORNAMENT v3 — ORNAMEN DI SISI KANAN JUDUL
   Fokus: ruang kosong di sebelah "SEJARAH SKANEDA".
   Tidak masuk ke area headline.
   ========================================================= */
.history-hero-geometry{
  z-index:1;
  pointer-events:none;
}

/* Matikan susunan kiri/bawah yang sebelumnya terlalu dekat dengan headline */
.history-hero-geometry .geo-cluster-left,
.history-hero-geometry .geo-network-left{
  display:none !important;
}

/* Cluster utama: orbit + diamond di kanan atas */
.history-hero-geometry .geo-cluster-right{
  display:block;
  left:auto;
  right:1.5%;
  top:7%;
  width:min(430px,38vw);
  height:min(320px,34vh);
  transform:none;
  opacity:.92;
}

/* Cluster modular: jalur + blok di kanan bawah */
.history-hero-geometry .geo-modules{
  display:block;
  left:auto;
  right:-1%;
  bottom:5%;
  width:min(420px,36vw);
  height:min(220px,24vh);
  transform:rotate(-2deg);
  opacity:.82;
}

/* Tambahan pola arsitektur di area kanan tengah */
.history-hero-geometry::before{
  left:auto;
  right:3%;
  top:31%;
  width:min(300px,25vw);
  height:min(300px,30vh);
  border-radius:50%;
  background-image:
    radial-gradient(circle,rgba(13,58,102,.18) 1.4px,transparent 1.7px);
  background-size:17px 17px;
  opacity:.42;
  -webkit-mask-image:radial-gradient(circle at 50% 50%,#000 0 43%,transparent 72%);
  mask-image:radial-gradient(circle at 50% 50%,#000 0 43%,transparent 72%);
}

/* Garis "jalur" terarah yang menghubungkan area kanan */
.history-hero-geometry::after{
  right:-25px;
  left:auto;
  bottom:4%;
  width:min(520px,44vw);
  height:180px;
  background:
    linear-gradient(135deg,transparent 47.5%,rgba(255,122,0,.52) 48%,rgba(255,122,0,.52) 48.7%,transparent 49.2%),
    linear-gradient(25deg,transparent 49%,rgba(13,58,102,.20) 49.5%,rgba(13,58,102,.20) 50.2%,transparent 50.7%);
  opacity:.62;
  transform:none;
}

/* Pastikan headline selalu berada di atas dan bebas ornamen */
.history-hero-inner{
  z-index:4;
}
.history-title,
.history-kicker,
.history-vt-cta{
  position:relative;
  z-index:5;
}

/* Desktop besar: beri ruang visual kanan yang jelas */
@media (min-width:1100px){
  .history-hero-inner{
    padding-right:clamp(1.25rem,4.2vw,4.5rem);
  }
  .history-title{
    max-width:1250px;
  }
}

/* Tablet */
@media (max-width:900px){
  .history-hero-inner{
    padding-right:1.25rem;
  }
  .history-hero-geometry .geo-cluster-right{
    right:-45px;
    top:8%;
    width:330px;
    height:260px;
    opacity:.58;
  }
  .history-hero-geometry .geo-modules{
    right:-55px;
    bottom:2%;
    width:330px;
    height:180px;
    opacity:.58;
  }
  .history-hero-geometry::before{
    right:-35px;
    top:34%;
    width:240px;
    height:240px;
  }
}

/* Mobile: tetap ada aksen di sisi kanan, tapi tidak mengganggu teks */
@media (max-width:560px){
  .history-hero-geometry .geo-cluster-right{
    right:-115px;
    top:10%;
    width:270px;
    height:220px;
    opacity:.34;
  }
  .history-hero-geometry .geo-modules{
    right:-120px;
    bottom:0;
    width:280px;
    height:150px;
    opacity:.30;
  }
  .history-hero-geometry::before{
    right:-90px;
    top:38%;
    width:210px;
    height:210px;
    opacity:.24;
  }
  .history-hero-geometry::after{
    right:-120px;
    width:300px;
    height:130px;
    opacity:.28;
  }
}



/* ---------- HERO ORNAMENT RESPONSIVE ---------- */
@media (max-width:900px){
  .history-hero-geometry .geo-cluster-left{left:-105px;top:-42px;transform:scale(.82);transform-origin:top left}
  .history-hero-geometry .geo-cluster-right{right:-130px;top:20px;transform:scale(.78);transform-origin:top right}
  .history-hero-geometry .geo-network-left{left:-120px;bottom:8px;transform:scale(.72);transform-origin:bottom left}
  .history-hero-geometry .geo-modules{right:-135px;bottom:-8px;transform:scale(.68) rotate(-2deg);transform-origin:bottom right}
}
@media (max-width:560px){
  .history-hero-geometry .geo-cluster-left{left:-150px;top:-38px;transform:scale(.62);opacity:.72}
  .history-hero-geometry .geo-cluster-right{right:-180px;top:14px;transform:scale(.58);opacity:.68}
  .history-hero-geometry .geo-network-left{left:-180px;bottom:4px;transform:scale(.52);opacity:.65}
  .history-hero-geometry .geo-modules{right:-205px;bottom:-12px;transform:scale(.50) rotate(-2deg);opacity:.72}
  .history-hero::after{font-size:clamp(7rem,31vw,11rem);opacity:.8}
}



/* =========================================================
   HERO SEJARAH — ORNAMEN 100% MENGIKUTI JURUSAN / INDUSTRI
   SVG dan nilai visual mengikuti ornament yang sudah ada.
   Scope hanya ke Hero Sejarah.
   ========================================================= */
.history-jurusan-industry-decor{
  position:absolute;
  inset:0;
  z-index:1;
  pointer-events:none;
  overflow:hidden;
}
.history-jurusan-industry-decor svg{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
.history-jurusan-industry-decor .jd-grid{
  stroke:#0d3a66;
  stroke-width:1.5px;
  opacity:.15;
}
.history-jurusan-industry-decor .jd-diag{
  fill:none;
  stroke:#ff9f00;
  stroke-width:3px;
  stroke-linecap:round;
  opacity:.48;
}
.history-jurusan-industry-decor .jd-diag-soft{
  fill:none;
  stroke:#0d3a66;
  stroke-width:1.9px;
  stroke-linecap:round;
  opacity:.24;
}
.history-jurusan-industry-decor .jd-square{
  fill:none;
  stroke:#ff9f00;
  stroke-width:2.8px;
  opacity:.68;
}
.history-jurusan-industry-decor .jd-square-fill{
  fill:#ffb300;
  opacity:.22;
}
.history-jurusan-industry-decor .jd-hex{
  fill:none;
  stroke:#0d3a66;
  stroke-width:2.8px;
  opacity:.34;
}
.history-jurusan-industry-decor .jd-node{
  fill:#ff9f00;
  opacity:.82;
}
.history-jurusan-industry-decor .jd-plus{
  stroke:#0d3a66;
  stroke-width:2.8px;
  stroke-linecap:round;
  opacity:.42;
}
.history-jurusan-industry-decor .jd-corner{
  fill:none;
  stroke:#ff9f00;
  stroke-width:4px;
  stroke-linecap:square;
  opacity:.52;
}

/* Fokuskan ornamen ke ruang kanan, tanpa mengubah bentuk aslinya. */
@media (min-width:1100px){
  .history-jurusan-industry-decor{
    left:28%;
  }
}
@media (max-width:1099px){
  .history-jurusan-industry-decor{
    left:18%;
    opacity:.82;
  }
}
@media (max-width:640px){
  .history-jurusan-industry-decor{
    left:5%;
    opacity:.68;
  }
}


/* =========================================================
   HERO SEJARAH — REFERENCE LOOK
   Clean editorial typography + structured tech geometry.
   Scoped to hero only.
   ========================================================= */
.history-hero{
  min-height:clamp(620px,78vh,790px)!important;
  background:#fff!important;
  position:relative;
  isolation:isolate;
}
.history-hero>.home-orn,
.history-hero>.history-hero-geometry{
  display:none!important;
}
.history-ref-ornaments{
  position:absolute;
  inset:0;
  z-index:1;
  pointer-events:none;
  overflow:hidden;
}
.history-ref-ornaments svg{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
.history-ref-ornaments path{
  fill:none;
  stroke:#0d3a66;
  stroke-width:1.8;
  vector-effect:non-scaling-stroke;
  opacity:.20;
}
.history-ref-ornaments .ref-soft path{
  stroke:#ff7a00;
  opacity:.28;
}
.history-ref-ornaments .ref-soft-bottom path{
  stroke:#0d3a66;
  opacity:.18;
}
.history-ref-ornaments .ref-left path{
  stroke:#0d3a66;
  opacity:.18;
}
.history-ref-ornaments .ref-right path,
.history-ref-ornaments .ref-bottom path{
  stroke:#0d3a66;
  opacity:.23;
}
.history-ref-ornaments .ref-diamond-orange{
  fill:none;
  stroke:#ff7a00;
  stroke-width:2;
  opacity:.52;
}
.history-ref-ornaments .ref-hex{
  fill:none;
  stroke:#0d3a66;
  stroke-width:2;
  opacity:.30;
}
.history-ref-ornaments .ref-fill-orange{
  fill:#ff7a00;
  opacity:.95;
}
.history-ref-ornaments .ref-fill-navy{
  fill:#0d3a66;
  opacity:.95;
}
.history-ref-ornaments .ref-node-orange{
  fill:#fff;
  stroke:#ff7a00;
  stroke-width:2;
}
.history-ref-ornaments .ref-node-navy{
  fill:#fff;
  stroke:#0d3a66;
  stroke-width:2;
}
.history-ref-ornaments .ref-orbit{
  fill:none;
  stroke:#0d3a66;
  stroke-width:1.6;
  opacity:.22;
}
.history-ref-ornaments .ref-orbit-orange{
  fill:none;
  stroke:#ff7a00;
  stroke-width:1.6;
  opacity:.30;
}
.history-ref-ornaments .ref-orbit-core{
  fill:none;
  stroke:#0d3a66;
  stroke-width:2.2;
  opacity:.50;
}
.history-ref-ornaments .ref-heavy-orange{
  fill:none;
  stroke:#ff7a00;
  stroke-width:7;
  opacity:.90;
}
.history-ref-ornaments .ref-heavy-navy{
  fill:none;
  stroke:#0d3a66;
  stroke-width:7;
  opacity:.90;
}
.history-ref-ornaments .ref-dots circle{
  fill:#0d3a66;
  opacity:.20;
}
.history-ref-ornaments .ref-soft rect,
.history-ref-ornaments .ref-soft-bottom rect{
  fill:none;
  stroke:#ff7a00;
  stroke-width:2;
  opacity:.45;
}
.history-hero::after{
  content:"STRUKTUR"!important;
  left:2%!important;
  top:58%!important;
  font-size:clamp(9rem,23vw,23rem)!important;
  color:rgba(13,58,102,.035)!important;
  -webkit-text-stroke:1px rgba(255,122,0,.09)!important;
  z-index:0!important;
}
.history-hero-inner{
  z-index:4!important;
  max-width:1500px!important;
  padding:clamp(4rem,10vh,7rem) clamp(1.25rem,4.2vw,4.5rem) clamp(4rem,9vh,6rem)!important;
}
.history-title{
  font-size:clamp(4.4rem,9.8vw,9.3rem)!important;
  line-height:.82!important;
  max-width:1250px!important;
  letter-spacing:-.045em!important;
}
.history-title .sejarah-white{
  color:#0d3a66!important;
}
.history-title .skaneda-gold{
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%)!important;
  -webkit-background-clip:text!important;
  background-clip:text!important;
  -webkit-text-fill-color:transparent!important;
  color:transparent!important;
}
.history-kicker{
  margin-bottom:1.2rem!important;
}
.history-vt-cta{
  margin-top:2rem!important;
}
@media(min-width:1050px){
  .history-hero-inner{
    padding-right:clamp(1.25rem,4.2vw,4.5rem)!important;
  }
}
@media(max-width:900px){
  .history-ref-ornaments{
    opacity:.72;
  }
  .history-title{
    font-size:clamp(4rem,11vw,7rem)!important;
  }
}
@media(max-width:560px){
  .history-ref-ornaments{
    opacity:.40;
  }
  .history-hero-inner{
    padding-right:1.25rem!important;
  }
  .history-title{
    font-size:clamp(3.3rem,16vw,5.5rem)!important;
  }
}

/* =========================================================
   FINAL HERO FIX — ORNAMEN JELAS DI SISI KANAN JUDUL
   Bentuk: network, diamond, hexagon, orbit, node, modular blocks.
   Tidak memakai gambar/background eksternal.
   ========================================================= */
.history-hero{
  background:#fff!important;
  overflow:hidden!important;
}
.history-hero>.history-ref-ornaments{
  display:block!important;
  position:absolute!important;
  inset:0!important;
  z-index:1!important;
  pointer-events:none!important;
}
.history-hero>.history-ref-ornaments svg{
  width:100%!important;
  height:100%!important;
}
.history-hero-inner{
  position:relative!important;
  z-index:4!important;
  padding-right:clamp(1.25rem,4.2vw,4.5rem)!important;
}
.history-title{
  position:relative!important;
  z-index:5!important;
  max-width:1250px!important;
}
.history-kicker,.history-vt-cta{
  position:relative!important;
  z-index:5!important;
}
/* Ornamen kanan dibuat lebih tegas seperti bahasa visual Jurusan/Industri. */
.history-ref-ornaments .ref-right path,
.history-ref-ornaments .ref-bottom path{
  opacity:.34!important;
}
.history-ref-ornaments .ref-diamond-orange{
  stroke-width:2.4!important;
  opacity:.72!important;
}
.history-ref-ornaments .ref-fill-orange,
.history-ref-ornaments .ref-fill-navy{
  opacity:.96!important;
}
.history-ref-ornaments .ref-hex{
  stroke-width:2.4!important;
  opacity:.48!important;
}
.history-ref-ornaments .ref-orbit{
  stroke-width:1.8!important;
  opacity:.30!important;
}
.history-ref-ornaments .ref-orbit-orange{
  stroke-width:1.8!important;
  opacity:.42!important;
}
.history-ref-ornaments .ref-heavy-orange,
.history-ref-ornaments .ref-heavy-navy{
  stroke-width:6!important;
  opacity:.72!important;
}
.history-ref-ornaments .ref-node-orange,
.history-ref-ornaments .ref-node-navy{
  stroke-width:2.2!important;
}
@media(max-width:1050px){
  .history-hero-inner{padding-right:1.25rem!important}
  .history-ref-ornaments{opacity:.72!important}
}
@media(max-width:700px){
  .history-hero-inner{padding-right:1.25rem!important}
  .history-ref-ornaments{opacity:.45!important}
  .history-title{font-size:clamp(3rem,14vw,5rem)!important}
}


/* =========================================================
   FINAL ORNAMENT IMAGE — GENERATED PNG
   Menggantikan SVG hero dengan gambar ornamen transparan.
   Ornamen berada DI BELAKANG teks, bukan sebagai background foto.
   ========================================================= */
.history-hero > .history-ref-ornaments{
  position:absolute!important;
  inset:0!important;
  z-index:1!important;
  overflow:hidden!important;
  pointer-events:none!important;
  opacity:1!important;
}
.history-ref-ornament-image{
  position:absolute!important;
  inset:0!important;
  width:100%!important;
  height:100%!important;
  display:block!important;
  object-fit:cover!important;
  object-position:center center!important;
  max-width:none!important;
  opacity:1!important;
}
.history-hero-inner{
  position:relative!important;
  z-index:4!important;
}
.history-title,.history-kicker,.history-vt-cta{
  position:relative!important;
  z-index:5!important;
}
@media(max-width:900px){
  .history-ref-ornament-image{object-position:center center!important;opacity:.88!important}
}
@media(max-width:560px){
  .history-ref-ornament-image{object-position:center center!important;opacity:.62!important}
}

/* ================= COMPACT HISTORY BOOK — CLOSED COVER / TRUE OPEN SPREAD ================= */
.history-book-section{padding:96px 0 112px;overflow:hidden}
.history-book-heading{margin-bottom:2rem}
.history-book-stage{display:flex;flex-direction:column;align-items:center;position:relative}
/* ===== ORNAMEN BACKGROUND SEJARAH — VISIBLE EDITORIAL DECOR ===== */
.history-book-stage{
  position:relative;
  isolation:isolate;
  padding:34px 0 28px;
}
.history-book-stage::before{
  content:"";
  position:absolute;
  z-index:0;
  width:250px;height:250px;
  left:-70px;top:70px;
  border:1px solid rgba(13,58,102,.16);
  border-radius:50%;
  box-shadow:
    0 0 0 20px rgba(13,58,102,.035),
    0 0 0 42px rgba(13,58,102,.025),
    0 0 0 64px rgba(255,179,0,.035);
  pointer-events:none;
}
.history-book-stage::after{
  content:"";
  position:absolute;
  z-index:0;
  width:190px;height:190px;
  right:-45px;bottom:35px;
  border:1px solid rgba(255,179,0,.26);
  border-radius:50%;
  box-shadow:
    0 0 0 18px rgba(255,179,0,.035),
    0 0 0 38px rgba(13,58,102,.025);
  pointer-events:none;
}

/* titik-titik kiri */
.history-book-stage .history-book::before{
  content:"";
  position:absolute;
  z-index:0;
  width:125px;height:125px;
  left:-175px;top:75px;
  opacity:.9;
  background-image:radial-gradient(circle,rgba(13,58,102,.28) 2px,transparent 2.4px);
  background-size:14px 14px;
  pointer-events:none;
}
/* titik-titik kanan */
.history-book-stage .history-book::after{
  content:"";
  position:absolute;
  z-index:0;
  width:125px;height:125px;
  right:-175px;bottom:75px;
  opacity:.85;
  background-image:radial-gradient(circle,rgba(255,179,0,.42) 2px,transparent 2.4px);
  background-size:15px 15px;
  pointer-events:none;
}

/* Diamond + garis dekoratif */
.history-book-stage .book-actions::before{
  content:"";
  position:absolute;
  z-index:0;
  width:58px;height:58px;
  left:-125px;top:-260px;
  border:1px solid rgba(255,179,0,.38);
  transform:rotate(45deg);
  border-radius:3px;
  pointer-events:none;
}
.history-book-stage .book-actions::after{
  content:"";
  position:absolute;
  z-index:0;
  width:110px;height:1px;
  right:-155px;top:-225px;
  background:linear-gradient(90deg,transparent,rgba(13,58,102,.22),rgba(255,179,0,.5));
  transform:rotate(-38deg);
  transform-origin:left center;
  box-shadow:0 18px 0 rgba(13,58,102,.09);
  pointer-events:none;
}

/* Pastikan buku selalu di atas ornamen */
.history-book-stage > .history-book{
  position:relative;
  z-index:3;
}
.history-book-stage > .book-actions{
  position:relative;
  z-index:4;
}

@media(max-width:820px){
  .history-book-stage::before{left:-125px;width:210px;height:210px}
  .history-book-stage::after{right:-90px;width:160px;height:160px}
  .history-book-stage .history-book::before{left:-105px}
  .history-book-stage .history-book::after{right:-105px}
}
@media(max-width:600px){
  .history-book-stage{padding-left:8px;padding-right:8px}
  .history-book-stage::before{left:-135px;width:170px;height:170px}
  .history-book-stage::after{right:-120px;width:140px;height:140px}
  .history-book-stage .history-book::before{left:-82px;opacity:.55}
  .history-book-stage .history-book::after{right:-82px;opacity:.5}
}

.history-book-stage{
  isolation:isolate;
}
.history-book-stage::before{
  content:"";
  position:absolute;
  z-index:-3;
  width:270px;
  height:270px;
  left:clamp(-170px,-13vw,-75px);
  top:18%;
  border-radius:50%;
  border:1px solid rgba(13,58,102,.10);
  box-shadow:
    0 0 0 22px rgba(13,58,102,.025),
    0 0 0 44px rgba(13,58,102,.018),
    0 0 0 66px rgba(255,179,0,.025);
}
.history-book-stage::after{
  content:"";
  position:absolute;
  z-index:-2;
  width:170px;
  height:170px;
  right:clamp(-105px,-9vw,-45px);
  bottom:8%;
  border-radius:50%;
  border:1px solid rgba(255,179,0,.20);
  box-shadow:
    0 0 0 18px rgba(255,179,0,.025),
    0 0 0 36px rgba(13,58,102,.018);
}
.history-book-stage .history-book{
  position:relative;
  z-index:2;
}
.history-book-stage .history-book::before{
  content:"";
  position:absolute;
  z-index:-2;
  width:145px;
  height:145px;
  left:-185px;
  top:20px;
  opacity:.72;
  background-image:radial-gradient(circle,rgba(13,58,102,.23) 1.4px,transparent 1.7px);
  background-size:14px 14px;
  mask-image:linear-gradient(135deg,black,transparent 78%);
  -webkit-mask-image:linear-gradient(135deg,black,transparent 78%);
}
.history-book-stage .history-book::after{
  content:"";
  position:absolute;
  z-index:-2;
  width:150px;
  height:150px;
  right:-190px;
  bottom:20px;
  opacity:.62;
  background-image:radial-gradient(circle,rgba(255,179,0,.32) 1.4px,transparent 1.8px);
  background-size:15px 15px;
  mask-image:linear-gradient(315deg,black,transparent 78%);
  -webkit-mask-image:linear-gradient(315deg,black,transparent 78%);
}
.history-book-stage .book-actions{
  position:relative;
  z-index:4;
}
.history-book-stage .history-book + .book-actions::before{
  content:"";
  position:absolute;
  width:42px;
  height:42px;
  left:-105px;
  top:-4px;
  border:1px solid rgba(255,179,0,.34);
  transform:rotate(45deg);
  border-radius:3px;
  pointer-events:none;
}
.history-book-stage .history-book + .book-actions::after{
  content:"";
  position:absolute;
  width:8px;
  height:8px;
  right:-92px;
  top:7px;
  border-radius:50%;
  background:#ffd04a;
  box-shadow:
    22px 13px 0 rgba(13,58,102,.18),
    44px -7px 0 rgba(255,179,0,.22);
  pointer-events:none;
}
@media(max-width:820px){
  .history-book-stage::before{left:-120px;width:210px;height:210px}
  .history-book-stage::after{right:-85px;width:130px;height:130px}
  .history-book-stage .history-book::before{left:-115px}
  .history-book-stage .history-book::after{right:-120px}
}
@media(max-width:600px){
  .history-book-stage::before{left:-135px;top:25%;width:180px;height:180px}
  .history-book-stage::after{right:-115px;bottom:12%;width:110px;height:110px}
  .history-book-stage .history-book::before{left:-95px;opacity:.48}
  .history-book-stage .history-book::after{right:-100px;opacity:.45}
  .history-book-stage .history-book + .book-actions::before{display:none}
}


/* Closed state: the book occupies exactly the cover size. The inner spread is hidden. */
.history-book{
  position:relative;width:590px;height:678px;max-width:calc(100vw - 48px);
  perspective:1800px;filter:drop-shadow(0 22px 30px rgba(13,58,102,.16));
  transition:width .72s cubic-bezier(.22,.75,.16,1);
}
.book-cover{
  position:absolute;left:0;top:0;width:590px;height:678px;
  transform:none;transform-origin:left center;z-index:20;border:0;
  border-radius:8px 15px 15px 8px;padding:0;overflow:hidden;cursor:pointer;
  color:#fff;background:linear-gradient(145deg,#0b477b,#0d3a66 65%,#092e50);
  box-shadow:inset 9px 0 18px rgba(0,0,0,.18),0 16px 30px rgba(13,58,102,.18);
  transition:transform .9s cubic-bezier(.2,.8,.15,1),opacity .45s ease;
}
.book-cover::before{content:"";position:absolute;inset:12px;border:1px solid rgba(255,213,74,.48);border-radius:5px;z-index:2}
.cover-frame{position:absolute;inset:22px;border:1px solid rgba(255,255,255,.11);border-radius:4px;z-index:2;pointer-events:none}
.cover-topline{position:absolute;top:30px;left:0;right:0;text-align:center;font-size:8px;font-weight:900;letter-spacing:.22em;color:#ffd54a;z-index:3}
.cover-photo{position:absolute;left:56px;right:56px;top:98px;height:294px;border-radius:7px;overflow:hidden;border:2px solid rgba(255,255,255,.35);z-index:1}
.cover-photo img{width:100%;height:100%;object-fit:cover;display:block;filter:saturate(.92)}
.cover-est{position:absolute;left:57px;top:414px;font-size:8px;font-weight:900;letter-spacing:.2em;color:#ffd54a;z-index:3}
.cover-title{position:absolute;left:56px;right:56px;top:447px;text-align:left;font-family:var(--font-display);font-size:35px;line-height:.93;font-weight:900;letter-spacing:-.02em;z-index:3}
.cover-title b{color:#ffd04a}
.cover-foot{position:absolute;left:56px;right:56px;bottom:26px;display:flex;justify-content:space-between;font-size:5.5px;font-weight:800;letter-spacing:.1em;color:rgba(255,255,255,.45);z-index:3}

/* The inside pages live inside the book. They do not show until the cover is opened. */
.book-spread{
  position:absolute;left:0;top:0;width:1180px;height:678px;display:grid;
  grid-template-columns:1fr 1fr;border-radius:10px;overflow:hidden;
  background:#f4ecda;box-shadow:inset 0 0 0 1px rgba(76,58,35,.13);
  opacity:0;visibility:hidden;pointer-events:none;
  transform:scale(.985);transform-origin:center;
  transition:opacity .3s ease .42s,transform .72s cubic-bezier(.22,.75,.16,1) .08s,visibility 0s linear .78s;
}
.book-spread::before{content:"";position:absolute;left:50%;top:0;bottom:0;width:18px;transform:translateX(-50%);z-index:8;background:linear-gradient(90deg,rgba(0,0,0,.06),rgba(255,255,255,.5) 42%,rgba(0,0,0,.07));opacity:.55;pointer-events:none}
.book-spread::after{content:"";position:absolute;inset:0;z-index:9;pointer-events:none;background:linear-gradient(90deg,rgba(255,255,255,.08),transparent 14%,transparent 86%,rgba(0,0,0,.025))}
.book-page{position:absolute;top:0;bottom:0;width:50%;padding:50px 50px 42px;display:none;color:#536474;background:repeating-linear-gradient(0deg,transparent 0 28px,rgba(91,72,44,.045) 29px,transparent 30px),linear-gradient(105deg,#f1e7d3,#fbf8ed 55%,#eee4d1);overflow:hidden}
.book-page.is-active{display:block}
.page-left{left:0;text-align:left;border-right:1px solid rgba(80,60,35,.09)}
.page-right{right:0}
.book-page::after{content:"";position:absolute;right:28px;bottom:24px;width:58px;height:58px;border:1px solid rgba(13,58,102,.07);border-radius:50%;box-shadow:0 0 0 10px rgba(255,179,0,.035),0 0 0 20px rgba(13,58,102,.025)}
.page-corner{position:absolute;top:22px;right:28px;font-size:8px;font-weight:900;color:#a49783;letter-spacing:.08em}
.page-kicker{font-size:7px;font-weight:900;letter-spacing:.2em;color:#0d3a66;margin-bottom:7px}
.page-year{font-family:var(--font-display);font-size:30px;line-height:1;color:#0d3a66;font-weight:900;letter-spacing:-.04em}
.page-rule{width:42px;height:2px;background:#ffb300;margin:10px 0 17px}
.page-icon{width:34px;height:34px;border-radius:50%;display:grid;place-items:center;background:#0d3a66;color:#ffd04a;font-size:12px;margin-bottom:13px;box-shadow:0 7px 14px rgba(13,58,102,.13)}
.book-page h3{margin:0 0 12px;font-family:var(--font-display);font-size:25px;line-height:.98;letter-spacing:-.025em;color:#0d3a66;font-weight:900}
.book-page h4{position:relative;margin:6px 0 12px;max-width:280px;font-family:var(--font-display);font-size:28px;line-height:.98;letter-spacing:-.03em;color:#0d3a66;font-weight:900}
.book-page p{position:relative;z-index:1;margin:0;max-width:280px;font-size:10px;line-height:1.75;color:#687888}
.book-page .lead{font-size:12px;line-height:1.55;color:#3f5568;font-weight:700;margin-bottom:11px}
.page-number-big{position:absolute;right:29px;top:47px;font-family:var(--font-display);font-size:68px;line-height:.8;font-weight:900;color:rgba(13,58,102,.08);letter-spacing:-.05em}
.quote-mark{font-family:Georgia,serif;font-size:54px;line-height:.6;color:#ffb300;margin:22px 0 4px}
.page-note{position:absolute;left:42px;right:40px;bottom:61px;padding:9px 10px 9px 12px;border-left:2px solid #ffb300;background:rgba(255,255,255,.55);font-size:8px;line-height:1.55;color:#4d6377;font-weight:700;z-index:2}
.page-tag{display:inline-block;margin-top:14px;padding:5px 8px;border-radius:99px;background:rgba(255,179,0,.13);color:#a77700;font-size:6px;font-weight:900;letter-spacing:.12em;text-transform:uppercase}
.page-footer{position:absolute;left:42px;right:42px;bottom:19px;padding-top:7px;border-top:1px solid rgba(80,60,35,.1);display:flex;justify-content:space-between;font-size:5.5px;font-weight:900;letter-spacing:.1em;color:#a49a8b;z-index:3}
.page-footer span:last-child{color:#0d3a66}

/* Open state: the spread grows out from behind the cover, then the cover turns like a real front cover. */
.history-book.is-open{width:1180px}
.history-book.is-open .book-spread{
  opacity:1;visibility:visible;pointer-events:auto;transform:scale(1);
  transition:opacity .32s ease .1s,transform .72s cubic-bezier(.22,.75,.16,1),visibility 0s linear 0s;
}
.history-book.is-open .book-cover{
  transform:rotateY(-165deg);opacity:0;pointer-events:none;
  box-shadow:inset 9px 0 18px rgba(0,0,0,.08),0 8px 16px rgba(13,58,102,.08);
}

.book-actions{display:flex;align-items:center;justify-content:center;gap:14px;margin-top:17px}
.book-nav{width:34px;height:34px;border-radius:50%;border:0;background:#0d3a66;color:#fff;cursor:pointer;display:grid;place-items:center;font-size:10px;box-shadow:0 8px 16px rgba(13,58,102,.13);transition:.2s ease}
.book-nav:hover{transform:translateY(-2px);background:#125084}
.book-nav:disabled{opacity:.28;cursor:default;transform:none}
.book-open{height:34px;padding:0 15px;border:0;border-radius:99px;background:#ffb300;color:#fff;font-size:8px;font-weight:900;letter-spacing:.06em;text-transform:uppercase;display:flex;gap:7px;align-items:center;cursor:pointer;box-shadow:0 8px 16px rgba(255,179,0,.18)}
.book-count{font-size:9px;color:#8994a0;font-weight:800;min-width:48px;text-align:center}.book-count b{font-size:14px;color:#0d3a66}

@media(max-width:820px){
  .history-book{width:calc(50vw - 12px);height:590px}
  .history-book.is-open{width:calc(100vw - 36px)}
  .book-cover{width:100%;height:590px}
  .book-spread{width:calc(100vw - 36px);height:590px}
  .cover-photo{left:25px;right:25px;height:170px}
  .cover-title{left:25px;right:25px;top:267px;font-size:20px}
  .cover-est{left:25px;top:240px}
  .cover-foot{left:25px;right:25px}
  .book-page{padding:42px 38px 34px}.book-page h3{font-size:22px}.book-page h4{font-size:24px}
  .page-note{left:30px;right:28px}.page-footer{left:30px;right:30px}
}
@media(max-width:600px){
  .history-book-section{padding-top:70px}
  .history-book{width:calc(100vw - 52px);height:390px}
  .history-book.is-open{width:calc(100vw - 24px)}
  .book-cover{width:100%;height:390px}
  .book-spread{width:calc(100vw - 24px);height:390px}
  .cover-photo{top:57px;height:145px}
  .cover-title{top:226px;font-size:17px}.cover-est{top:210px}
  .cover-foot{display:none}
  .book-page{padding:34px 25px 28px}.page-year{font-size:25px}
  .book-page h3{font-size:18px}.book-page h4{font-size:20px}
  .book-page p{font-size:8px;line-height:1.6}.book-page .lead{font-size:9px}
  .page-number-big{font-size:52px;right:20px}.page-note{left:22px;right:20px;bottom:50px;font-size:7px}
  .page-footer{left:22px;right:20px}.page-corner{right:18px}
  .page-icon{width:30px;height:30px;font-size:10px}
}


/* FINAL BOOK LAYOUT — TITLE BESIDE BOOK + COVER-SIZED OPEN PAGE */
.history-book-stage{
  width:min(1180px,94%);
  margin:0 auto;
  display:grid!important;
  grid-template-columns:280px 800px;
  grid-template-rows:auto auto;
  column-gap:68px;
  align-items:center;
  justify-content:center;
  justify-items:start;
  padding:54px 0 34px!important;
}
.history-book-side-title{
  grid-column:1;
  grid-row:1;
  align-self:center;
  position:relative;
  z-index:5;
  width:280px;
  max-width:280px;
  padding:8px 0;
  text-align:left;
  transform:translateX(-34px);
}
.side-title-kicker{display:inline-block;font-size:9px;font-weight:900;letter-spacing:.2em;color:#ff9f00;text-transform:uppercase;margin-bottom:14px}
.history-book-side-title h2{
  margin:0;
  font-family:var(--font-display);
  font-size:clamp(3.25rem,4.15vw,4.15rem);
  line-height:.86;
  letter-spacing:-.04em;
  color:#0d3a66;
}
.history-book-side-title h2 b{display:block;color:#0d3a66!important;background:none!important;-webkit-text-fill-color:#0d3a66!important}
.history-book-side-title p{margin:18px 0 0;max-width:250px;color:#718396;font-size:.78rem;line-height:1.75}
.side-title-line{display:block;width:54px;height:3px;margin-top:20px;border-radius:99px;background:linear-gradient(90deg,#0d3a66,#ffb300)}

/* CLOSED = exactly one cover. OPEN = cover-sized cover + cover-sized inside page. */
.history-book{
  grid-column:2;
  grid-row:1;
  position:relative;
  width:400px!important;
  height:540px!important;
  justify-self:start;
  transition:width .65s cubic-bezier(.22,.75,.16,1),height .45s ease;
}
.history-book.is-open{
  width:800px!important;
  height:540px!important;
  justify-self:start;
}
.book-cover{width:400px!important;height:540px!important}
.cover-photo{left:38px!important;right:38px!important;top:82px!important;height:230px!important}
.cover-topline{top:25px!important}
.cover-est{left:39px!important;top:329px!important}
.cover-title{left:38px!important;right:38px!important;top:360px!important;font-size:27px!important}
.cover-foot{left:38px!important;right:38px!important;bottom:21px!important}

/* Open spread is 800px total: left half = cover-sized page, right half = cover-sized page. */
.book-spread{
  width:800px!important;
  height:540px!important;
  grid-template-columns:400px 400px!important;
  border-radius:10px!important;
}
.book-spread::before{display:none!important}
.book-page{
  width:400px!important;
  padding:46px 46px 38px!important;
}
/* Only the right content page is shown beside the cover. The left duplicate page is hidden. */
.book-page.page-left{display:none!important}
.book-page.page-right.is-active{
  display:block!important;
  left:400px!important;
  right:auto!important;
  width:400px!important;
}
.book-page h4{max-width:305px!important;font-size:28px!important}
.book-page p{max-width:305px!important;font-size:10px!important;line-height:1.75!important}
.book-page .lead{max-width:305px!important;font-size:11px!important}
.page-note{left:46px!important;right:46px!important;max-width:none!important}
.page-footer{left:46px!important;right:46px!important}
.book-actions{grid-column:2;grid-row:2;justify-self:start;margin-top:18px!important;margin-left:180px!important}

@media(min-width:1200px){
  .history-book-stage{grid-template-columns:280px 800px;column-gap:68px}
  .history-book-side-title{width:280px;max-width:280px;transform:translateX(-34px)}
  .history-book-side-title h2{font-size:4.15rem}
}

@media(max-width:1180px){
  .history-book-stage{
    grid-template-columns:270px minmax(0,1fr);
    column-gap:28px;
    width:96%;
  }
  .history-book-side-title{width:270px;max-width:270px;transform:translateX(-22px)}
  .history-book-side-title h2{font-size:clamp(3rem,5vw,3.8rem)}
  .history-book{width:380px!important;height:520px!important}
  .history-book.is-open{width:760px!important;height:520px!important}
  .book-cover{width:380px!important;height:520px!important}
  .book-spread{width:760px!important;height:520px!important;grid-template-columns:380px 380px!important}
  .book-page{width:380px!important;padding:42px 40px 34px!important}
  .book-page.page-right.is-active{left:380px!important;width:380px!important}
  .cover-photo{left:36px!important;right:36px!important;top:78px!important;height:220px!important}
  .cover-est{left:37px!important;top:315px!important}
  .cover-title{left:36px!important;right:36px!important;top:344px!important;font-size:25px!important}
  .cover-foot{left:36px!important;right:36px!important}
  .book-page h4{font-size:26px!important;max-width:295px!important}
  .book-page p,.book-page .lead{max-width:295px!important}
  .book-actions{margin-left:160px!important}
}

@media(max-width:820px){
  .history-book-stage{
    width:94%!important;
    display:flex!important;
    flex-direction:column!important;
    align-items:center!important;
    gap:20px!important;
    padding:50px 0 28px!important;
  }
  .history-book-side-title{
    order:0;
    width:100%;
    max-width:520px;
    text-align:center;
    padding:0;
  }
  .history-book-side-title h2{font-size:clamp(2.2rem,9vw,3.4rem)}
  .history-book-side-title p{max-width:480px;margin:14px auto 0;font-size:.76rem}
  .side-title-line{margin:16px auto 0}
  .history-book{order:1;width:330px!important;height:440px!important}
  .history-book.is-open{width:660px!important;height:440px!important;max-width:94vw}
  .book-cover{width:330px!important;height:440px!important}
  .book-spread{width:660px!important;height:440px!important;grid-template-columns:330px 330px!important}
  .book-page{width:330px!important;padding:34px 30px 28px!important}
  .book-page.page-right.is-active{left:330px!important;width:330px!important}
  .cover-photo{left:30px!important;right:30px!important;top:64px!important;height:150px!important}
  .cover-topline{top:19px!important;font-size:6px!important}
  .cover-est{left:31px!important;top:226px!important;font-size:6px!important}
  .cover-title{left:30px!important;right:30px!important;top:250px!important;font-size:20px!important}
  .cover-foot{left:30px!important;right:30px!important;bottom:16px!important;font-size:4.5px!important}
  .book-page h4{font-size:22px!important;max-width:270px!important}
  .book-page p{font-size:8px!important;line-height:1.65!important;max-width:270px!important}
  .book-page .lead{font-size:9px!important;max-width:270px!important}
  .page-note{left:30px!important;right:30px!important;font-size:8px!important}
  .page-footer{left:30px!important;right:30px!important}
  .book-actions{order:2;grid-column:auto;grid-row:auto;margin:2px 0 0!important}
}

@media(max-width:700px){
  .history-book{width:300px!important;height:400px!important}
  .history-book.is-open{width:600px!important;height:400px!important;max-width:92vw}
  .book-cover{width:300px!important;height:400px!important}
  .book-spread{width:600px!important;height:400px!important;grid-template-columns:300px 300px!important}
  .book-page{width:300px!important;padding:29px 26px 25px!important}
  .book-page.page-right.is-active{left:300px!important;width:300px!important}
  .cover-photo{left:27px!important;right:27px!important;top:57px!important;height:135px!important}
  .cover-est{left:28px!important;top:202px!important}
  .cover-title{left:27px!important;right:27px!important;top:224px!important;font-size:18px!important}
  .book-page h4{font-size:19px!important;max-width:245px!important}
  .book-page p{font-size:7px!important;max-width:245px!important}
  .book-page .lead{font-size:8px!important;max-width:245px!important}
  .page-note{left:26px!important;right:26px!important;font-size:7px!important}
  .page-footer{left:26px!important;right:26px!important}
}

@media(max-width:430px){
  .history-book{width:280px!important;height:375px!important}
  .history-book.is-open{width:560px!important;height:375px!important;max-width:92vw}
  .book-cover{width:280px!important;height:375px!important}
  .book-spread{width:560px!important;height:375px!important;grid-template-columns:280px 280px!important}
  .book-page{width:280px!important;padding:27px 23px 23px!important}
  .book-page.page-right.is-active{left:280px!important;width:280px!important}
  .cover-photo{left:25px!important;right:25px!important;top:53px!important;height:126px!important}
  .cover-est{left:26px!important;top:190px!important}
  .cover-title{left:25px!important;right:25px!important;top:210px!important;font-size:17px!important}
}



/* =========================================================
   FEED ORNAMENT — GEOMETRIC NETWORK / 3 LAYER UNITY
   Terinspirasi komposisi visual referensi: orbit, node,
   garis diagonal, diamond, titik grid, dan focal shape.
   Hanya dekorasi; tidak mengganggu interaksi kartu.
   ========================================================= */
.so-chart-section{
  position:relative;
  isolation:isolate;
}
.so-feed-orn{
  position:absolute;
  inset:0;
  z-index:0;
  pointer-events:none;
  overflow:hidden;
  opacity:1;
}
.so-feed-orn svg{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
.so-feed-orn .orn-line{
  fill:none;
  stroke:#0d3a66;
  stroke-width:1.35;
  opacity:.20;
  vector-effect:non-scaling-stroke;
}
.so-feed-orn .orn-line-gold{
  fill:none;
  stroke:#ff8a00;
  stroke-width:1.25;
  opacity:.34;
  vector-effect:non-scaling-stroke;
}
.so-feed-orn .orn-dash{
  fill:none;
  stroke:#2f6fa8;
  stroke-width:1;
  stroke-dasharray:5 8;
  opacity:.22;
  vector-effect:non-scaling-stroke;
}
.so-feed-orn .orn-ring{
  fill:none;
  stroke:#0d3a66;
  stroke-width:1.15;
  opacity:.15;
  vector-effect:non-scaling-stroke;
}
.so-feed-orn .orn-ring-gold{
  fill:none;
  stroke:#ff9f00;
  stroke-width:1.35;
  opacity:.27;
  vector-effect:non-scaling-stroke;
}
.so-feed-orn .orn-diamond{
  fill:none;
  stroke:#ff8a00;
  stroke-width:1.45;
  opacity:.34;
  vector-effect:non-scaling-stroke;
}
.so-feed-orn .orn-diamond-navy{
  fill:none;
  stroke:#0d3a66;
  stroke-width:1.2;
  opacity:.17;
  vector-effect:non-scaling-stroke;
}
.so-feed-orn .orn-node{
  fill:#fff;
  stroke:#ff8a00;
  stroke-width:1.8;
  vector-effect:non-scaling-stroke;
}
.so-feed-orn .orn-node-navy{
  fill:#fff;
  stroke:#0d3a66;
  stroke-width:1.7;
  vector-effect:non-scaling-stroke;
}
.so-feed-orn .orn-dot{
  fill:#ff8a00;
  opacity:.65;
}
.so-feed-orn .orn-dot-navy{
  fill:#0d3a66;
  opacity:.72;
}
.so-feed-orn .orn-solid-gold{
  fill:#ff8a00;
  opacity:.88;
}
.so-feed-orn .orn-solid-navy{
  fill:#0d3a66;
  opacity:.92;
}
.so-feed-orn .orn-grid-dot{
  fill:#2f6fa8;
  opacity:.35;
}
.so-feed-orn .orn-soft{
  fill:#ff8a00;
  opacity:.045;
}
.so-feed-orn .orn-glow{
  fill:#0d3a66;
  opacity:.035;
}

/* Ornamen diletakkan di sisi luar agar feed tetap menjadi fokus. */
.so-feed-orn .orn-left-top{transform:translate(-28px,-12px)}
.so-feed-orn .orn-right-top{transform:translate(28px,8px)}
.so-feed-orn .orn-left-bottom{transform:translate(-12px,28px)}
.so-feed-orn .orn-right-bottom{transform:translate(26px,34px)}

.so-chart{
  position:relative;
  z-index:2;
}

/* Satu garis dekoratif menyatukan tiga level, hanya terlihat di ruang antar-card. */
@media(min-width:951px){
  .so-chart::before{
    content:"";
    position:absolute;
    left:50%;
    top:2.4rem;
    bottom:2.6rem;
    width:1px;
    transform:translateX(-50%);
    background:linear-gradient(
      180deg,
      transparent 0%,
      rgba(255,138,0,.22) 8%,
      rgba(13,58,102,.16) 38%,
      rgba(255,138,0,.22) 68%,
      transparent 100%
    );
    z-index:-1;
    pointer-events:none;
  }
  .so-chart::after{
    content:"";
    position:absolute;
    left:calc(50% - 5px);
    top:18%;
    width:9px;
    height:9px;
    border-radius:50%;
    background:#ff8a00;
    box-shadow:
      0 0 0 6px rgba(255,138,0,.08),
      0 0 0 12px rgba(255,138,0,.035);
    z-index:-1;
    pointer-events:none;
  }
}

/* Jangan tampilkan SVG terlalu dominan pada layar kecil. */
@media(max-width:950px){
  .so-feed-orn{opacity:.68}
  .so-feed-orn svg{transform:scale(1.08)}
}
@media(max-width:600px){
  .so-feed-orn{opacity:.48}
  .so-feed-orn .hide-mobile{display:none}
}

</style>
@endpush

@section('content')
<div class="so-page">
  <!-- HERO -->
  <section class="history-hero">
    <div class="history-ref-ornaments" aria-hidden="true">
      <img
        src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}"
        alt=""
        class="history-ref-ornament-image"
        aria-hidden="true"
      >
    </div>
    <div class="history-hero-inner">
      <div>
        <div class="history-kicker"></div>
        <h3 class="history-title">
          <span class="sejarah-white">STRUKTUR</span>
          <span class="skaneda-gold">ORGANISASI</span>
        </h3>
        <a class="history-vt-cta" href="#virtual-tour">
          <span class="history-vt-icon"><i class="fas fa-street-view"></i></span>
          <span><strong>Lihat Virtual Tour 360°</strong><small>Jelajahi SMK Negeri 2 Mojokerto</small></span>
          <i class="fas fa-arrow-right history-vt-arrow"></i>
        </a>
      </div>
    </div>
  </section>
<!-- SECTION BAGAN -->
  <section class="so-chart-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="so-feed-orn" aria-hidden="true">
      <svg viewBox="0 0 1440 1120" preserveAspectRatio="none" role="presentation">
        <defs>
          <radialGradient id="soOrnGlowNavy" cx="50%" cy="50%" r="50%">
            <stop offset="0%" stop-color="#0d3a66" stop-opacity=".10"/>
            <stop offset="100%" stop-color="#0d3a66" stop-opacity="0"/>
          </radialGradient>
          <radialGradient id="soOrnGlowGold" cx="50%" cy="50%" r="50%">
            <stop offset="0%" stop-color="#ff8a00" stop-opacity=".13"/>
            <stop offset="100%" stop-color="#ff8a00" stop-opacity="0"/>
          </radialGradient>
          <pattern id="soOrnDots" width="18" height="18" patternUnits="userSpaceOnUse">
            <circle cx="3" cy="3" r="1.5" class="orn-grid-dot"/>
          </pattern>
        </defs>

        <!-- KIRI ATAS: orbit + jalur jaringan -->
        <g class="orn-left-top">
          <circle cx="150" cy="170" r="112" class="orn-ring"/>
          <circle cx="150" cy="170" r="82" class="orn-ring-gold"/>
          <circle cx="150" cy="170" r="52" class="orn-ring"/>
          <circle cx="150" cy="170" r="22" class="orn-solid-gold"/>
          <circle cx="150" cy="170" r="72" class="orn-dash"/>
          <path d="M0 300 L92 208 L206 208 L286 126" class="orn-line"/>
          <path d="M18 332 L116 232 L238 232 L318 152" class="orn-line-gold"/>
          <path d="M45 80 L118 124 L184 76 L270 112" class="orn-dash"/>
          <circle cx="92" cy="208" r="5" class="orn-node-navy"/>
          <circle cx="206" cy="208" r="5" class="orn-node"/>
          <circle cx="286" cy="126" r="5" class="orn-dot"/>
          <circle cx="118" cy="124" r="4" class="orn-dot"/>
          <circle cx="184" cy="76" r="4" class="orn-node"/>
          <circle cx="270" cy="112" r="4" class="orn-dot-navy"/>
          <circle cx="150" cy="170" r="180" class="orn-soft"/>
        </g>

        <!-- KANAN ATAS: diamond modular + node -->
        <g class="orn-right-top">
          <rect x="1138" y="72" width="148" height="148" transform="rotate(45 1212 146)" class="orn-diamond"/>
          <rect x="1165" y="99" width="94" height="94" transform="rotate(45 1212 146)" class="orn-diamond-navy"/>
          <rect x="1192" y="119" width="54" height="54" transform="rotate(45 1219 146)" class="orn-solid-navy"/>
          <path d="M1060 242 L1130 172 L1212 242 L1290 164 L1380 238" class="orn-line"/>
          <path d="M1110 320 L1190 240 L1280 240 L1368 150" class="orn-line-gold"/>
          <circle cx="1060" cy="242" r="5" class="orn-node"/>
          <circle cx="1130" cy="172" r="4" class="orn-dot-navy"/>
          <circle cx="1290" cy="164" r="5" class="orn-node"/>
          <circle cx="1380" cy="238" r="6" class="orn-solid-gold"/>
          <circle cx="1110" cy="320" r="4" class="orn-dot"/>
          <circle cx="1368" cy="150" r="4" class="orn-node-navy"/>
          <rect x="1288" y="310" width="110" height="110" fill="url(#soOrnDots)" opacity=".75"/>
        </g>

        <!-- KIRI BAWAH: garis diagonal + diamond -->
        <g class="orn-left-bottom">
          <rect x="76" y="770" width="112" height="112" transform="rotate(45 132 826)" class="orn-diamond"/>
          <rect x="104" y="798" width="56" height="56" transform="rotate(45 132 826)" class="orn-diamond-navy"/>
          <path d="M0 960 L94 866 L184 866 L286 764 L376 764" class="orn-line"/>
          <path d="M0 1010 L126 884 L238 884 L338 784 L430 784" class="orn-line-gold"/>
          <path d="M64 1040 L164 940 L264 940 L364 840" class="orn-dash"/>
          <circle cx="94" cy="866" r="5" class="orn-node"/>
          <circle cx="184" cy="866" r="4" class="orn-dot-navy"/>
          <circle cx="286" cy="764" r="5" class="orn-node-navy"/>
          <circle cx="376" cy="764" r="4" class="orn-dot"/>
          <circle cx="126" cy="884" r="4" class="orn-dot"/>
          <circle cx="338" cy="784" r="5" class="orn-node"/>
          <circle cx="430" cy="784" r="4" class="orn-dot-navy"/>
          <rect x="-16" y="930" width="92" height="92" fill="url(#soOrnDots)" opacity=".62"/>
        </g>

        <!-- KANAN BAWAH: focal orbit + modular blocks -->
        <g class="orn-right-bottom">
          <circle cx="1225" cy="858" r="128" class="orn-ring"/>
          <circle cx="1225" cy="858" r="96" class="orn-ring-gold"/>
          <circle cx="1225" cy="858" r="62" class="orn-ring"/>
          <circle cx="1225" cy="858" r="28" class="orn-solid-gold"/>
          <path d="M1050 1012 L1148 914 L1234 914 L1320 828 L1428 828" class="orn-line"/>
          <path d="M1084 1056 L1184 956 L1268 956 L1360 864 L1440 864" class="orn-line-gold"/>
          <circle cx="1050" cy="1012" r="5" class="orn-node-navy"/>
          <circle cx="1148" cy="914" r="4" class="orn-dot"/>
          <circle cx="1234" cy="914" r="5" class="orn-node"/>
          <circle cx="1320" cy="828" r="4" class="orn-dot-navy"/>
          <circle cx="1428" cy="828" r="5" class="orn-solid-gold"/>
          <rect x="1280" y="950" width="126" height="126" transform="rotate(45 1343 1013)" class="orn-diamond-navy"/>
          <rect x="1306" y="976" width="74" height="74" transform="rotate(45 1343 1013)" class="orn-diamond"/>
          <circle cx="1225" cy="858" r="185" class="orn-glow"/>
        </g>

        <!-- titik aksen kecil di seluruh bidang -->
        <g class="hide-mobile">
          <circle cx="392" cy="144" r="4" class="orn-solid-gold"/>
          <circle cx="428" cy="182" r="3" class="orn-dot-navy"/>
          <circle cx="1010" cy="150" r="4" class="orn-dot"/>
          <circle cx="1050" cy="188" r="3" class="orn-dot-navy"/>
          <circle cx="334" cy="624" r="3" class="orn-dot"/>
          <circle cx="1090" cy="610" r="4" class="orn-solid-gold"/>
          <circle cx="1018" cy="690" r="3" class="orn-dot-navy"/>
          <circle cx="408" cy="920" r="4" class="orn-dot-navy"/>
        </g>
      </svg>
    </div>

    <div class="so-wrap">
      <div class="so-sec-head" data-reveal>
        <div class="eyebrow">Bagan Organisasi</div>
        <h2 class="big-heading">TIGA LAPISAN, <span>SATU KESATUAN.</span></h2>
      </div>

      <!-- TOOLBAR SEARCH & FILTER -->
      <div class="so-toolbar" data-reveal>
        <div class="so-search">
          <i class="fas fa-magnifying-glass"></i>
          <input type="text" id="soSearchInput" placeholder="Cari nama, jabatan, atau bidang..." aria-label="Cari dalam struktur organisasi">
        </div>
        <span class="so-filter-label">Bidang</span>
        <div class="so-filters" id="soFilters">
          <button class="so-fchip is-active" data-filter="*">Semua</button>
          <button class="so-fchip" data-filter="pimpinan">Pimpinan</button>
          <button class="so-fchip" data-filter="kurikulum">Kurikulum</button>
          <button class="so-fchip" data-filter="kesiswaan">Kesiswaan</button>
          <button class="so-fchip" data-filter="sapras">Sarana &amp; Prasarana</button>
          <button class="so-fchip" data-filter="humas">Humas &amp; Industri</button>
          <button class="so-fchip" data-filter="keuangan">Keuangan</button>
          <button class="so-fchip" data-filter="keahlian">Kompetensi Keahlian</button>
                  </div>
      </div>

      <div class="so-empty" id="soEmpty">
        <i class="fas fa-magnifying-glass"></i>
        <strong>Tidak ditemukan</strong><br>
        Coba kata kunci atau bidang lain.
      </div>

      <div class="so-chart" id="soChart" data-reveal>

        {{-- ===== LEVEL 1: PIMPINAN ===== --}}
        <div class="so-level so-level-root so-anchor" id="level-1" data-level="1">
          <div class="so-level-head">
            <span class="so-level-badge"><i class="fas fa-user-tie"></i> Level 1 &mdash; Pimpinan</span>
            <span class="so-level-rule"></span>
          </div>
          <div class="so-grid">
            <article class="so-card" tabindex="0" data-name="Kepala Sekolah" data-role="Pimpinan Sekolah" data-unit="Pimpinan" data-filter="pimpinan" data-detail="kepsek">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/pimpinan.png') }}" alt="Foto Kepala Sekolah" loading="lazy"></div>
                <span class="so-photo-tag is-gold"><i class="fas fa-star"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Kepala Sekolah</h3>
              <div class="so-card-person">Iswahyudi S.ST. M.Pd.</div>
              <div class="so-card-role"><i class="fas fa-star"></i> Pimpinan</div>
              <p class="so-card-unit">Pemimpin tertinggi organisasi sekolah</p>
            </article>
          </div>
        </div>

        {{-- ===== LEVEL 2: WAKIL KEPALA SEKOLAH ===== --}}
        <div class="so-level so-anchor" id="level-2" data-level="2">
          <div class="so-level-head">
            <span class="so-level-badge"><i class="fas fa-users-gear"></i> Level 2 &mdash; Wakil Kepala Sekolah</span>
            <span class="so-level-rule"></span>
          </div>
          <div class="so-grid">
            <article class="so-card" tabindex="0" data-name="MELATI PUSPITA SARI, S.Pd." data-role="Waka Kurikulum" data-unit="Kurikulum" data-filter="kurikulum" data-detail="waka-kurikulum">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/melati.png') }}" alt="Foto MELATI PUSPITA SARI, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-book-open"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Waka Kurikulum</h3>
              <div class="so-card-person">MELATI PUSPITA SARI, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Waka Kurikulum</div>
              <p class="so-card-unit">Perencanaan dan pengelolaan bidang kurikulum.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="AINUR ROFIK, M. Pd, Si." data-role="Waka Kesiswaan" data-unit="Kesiswaan" data-filter="kesiswaan" data-detail="waka-kesiswaan">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/ainur.png') }}" alt="Foto AINUR ROFIK, M. Pd, Si." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-users"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Waka Kesiswaan</h3>
              <div class="so-card-person">AINUR ROFIK, M. Pd, Si.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Waka Kesiswaan</div>
              <p class="so-card-unit">Pembinaan dan layanan peserta didik.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="M. WIRA HENDY HIMAWAN, M.Pd" data-role="Waka Sarana & Prasarana" data-unit="Sarana & Prasarana" data-filter="sapras" data-detail="waka-sapras">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/wira.png') }}" alt="Foto M. WIRA HENDY HIMAWAN, M.Pd" loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-building"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Waka Sarana & Prasarana</h3>
              <div class="so-card-person">M. WIRA HENDY HIMAWAN, M.Pd</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Waka Sarana & Prasarana</div>
              <p class="so-card-unit">Pengelolaan sarana, prasarana, dan fasilitas sekolah.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="ARIKAWWEKU CKRISNA, S.Pd." data-role="Waka Humastri" data-unit="Humastri" data-filter="humas" data-detail="waka-humas">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/arikawweku.png') }}" alt="Foto ARIKAWWEKU CKRISNA, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-handshake"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Waka Humastri</h3>
              <div class="so-card-person">ARIKAWWEKU CKRISNA, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Waka Humastri</div>
              <p class="so-card-unit">Hubungan sekolah dengan masyarakat dan dunia industri.</p>
            </article>
          </div>
        </div>

        {{-- ===== LEVEL 3: BENDAHARA, KETUA KOMPETENSI KEAHLIAN & KOORDINATOR ===== --}}
        <div class="so-level so-anchor" id="level-3" data-level="3">
          <div class="so-level-head">
            <span class="so-level-badge"><i class="fas fa-layer-group"></i> Level 3 &mdash; Unit Pelaksana &amp; Koordinator</span>
            <span class="so-level-rule"></span>
          </div>
          <div class="so-grid cols-5">
            <article class="so-card" tabindex="0" data-name="MEGA NOVINDA SARI, S.Pd." data-role="Bendahara BOS" data-unit="Keuangan" data-filter="keuangan" data-detail="bendahara-bos">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/mega.png') }}" alt="Foto MEGA NOVINDA SARI, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-money-bill-wave"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Bendahara BOS</h3>
              <div class="so-card-person">MEGA NOVINDA SARI, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Bendahara BOS</div>
              <p class="so-card-unit">Pengelolaan administrasi dan keuangan BOS sekolah.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="FAJAR DHILAMAYA, S.Pd." data-role="Bendahara BPOPP" data-unit="Keuangan" data-filter="keuangan" data-detail="bendahara-bpopp">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/fajar.png') }}" alt="Foto FAJAR DHILAMAYA, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-wallet"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Bendahara BPOPP</h3>
              <div class="so-card-person">FAJAR DHILAMAYA, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Bendahara BPOPP</div>
              <p class="so-card-unit">Pengelolaan administrasi dan keuangan BPOPP.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="DANANG TEGUH SANTOSO, S.Kom" data-role="Ketua Kompetensi Keahlian RPL" data-unit="Kompetensi Keahlian RPL" data-filter="keahlian" data-detail="kk-rpl">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/danang.png') }}" alt="Foto DANANG TEGUH SANTOSO, S.Kom" loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-code"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Ketua Kompetensi Keahlian RPL</h3>
              <div class="so-card-person">DANANG TEGUH SANTOSO, S.Kom</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Ketua Kompetensi Keahlian RPL</div>
              <p class="so-card-unit">Koordinasi pembelajaran dan pengembangan kompetensi RPL.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="DESY ANDINI DILIAWATI, S.T.P." data-role="Ketua Kompetensi Keahlian APHP" data-unit="Kompetensi Keahlian APHP" data-filter="keahlian" data-detail="kk-aphp">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/desy.png') }}" alt="Foto DESY ANDINI DILIAWATI, S.T.P." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-seedling"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Ketua Kompetensi Keahlian APHP</h3>
              <div class="so-card-person">DESY ANDINI DILIAWATI, S.T.P.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Ketua Kompetensi Keahlian APHP</div>
              <p class="so-card-unit">Koordinasi pembelajaran dan pengembangan kompetensi APHP.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="NURFALAH SEPTAYOGA S.Kom." data-role="Ketua Kompetensi Keahlian DKV" data-unit="Kompetensi Keahlian DKV" data-filter="keahlian" data-detail="kk-dkv">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/nurfalah.png') }}" alt="Foto NURFALAH SEPTAYOGA S.Kom." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-palette"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Ketua Kompetensi Keahlian DKV</h3>
              <div class="so-card-person">NURFALAH SEPTAYOGA S.Kom.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Ketua Kompetensi Keahlian DKV</div>
              <p class="so-card-unit">Koordinasi pembelajaran dan pengembangan kompetensi DKV.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="METIY ARIANA, S.Pd, M.Pd." data-role="Ketua Kompetensi Keahlian LPS" data-unit="Kompetensi Keahlian LPS" data-filter="keahlian" data-detail="kk-lps">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/metiy.png') }}" alt="Foto METIY ARIANA, S.Pd, M.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-landmark"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Ketua Kompetensi Keahlian LPS</h3>
              <div class="so-card-person">METIY ARIANA, S.Pd, M.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Ketua Kompetensi Keahlian LPS</div>
              <p class="so-card-unit">Koordinasi pembelajaran dan pengembangan kompetensi LPS.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="DHIYAH AMANATI KARTIKA SARI, S.Pd." data-role="Ketua Kompetensi Keahlian Kuliner" data-unit="Kompetensi Keahlian Kuliner" data-filter="keahlian" data-detail="kk-kuliner">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/dhiyah.png') }}" alt="Foto DHIYAH AMANATI KARTIKA SARI, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-utensils"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Ketua Kompetensi Keahlian Kuliner</h3>
              <div class="so-card-person">DHIYAH AMANATI KARTIKA SARI, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Ketua Kompetensi Keahlian Kuliner</div>
              <p class="so-card-unit">Koordinasi pembelajaran dan pengembangan kompetensi kuliner.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="MULAT ADITYAWIRANTI, S.Pd." data-role="Koordinator BKK" data-unit="BKK / Humastri" data-filter="humas" data-detail="koordinator-bkk">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/mulat.png') }}" alt="Foto MULAT ADITYAWIRANTI, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-briefcase"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Koordinator BKK</h3>
              <div class="so-card-person">MULAT ADITYAWIRANTI, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Koordinator BKK</div>
              <p class="so-card-unit">Koordinasi layanan BKK dan penyaluran lulusan.</p>
            </article>
          </div>
        </div>

      </div>

    </div>
  </section>



  <!-- VIRTUAL TOUR 360 — SAMA PERSIS DENGAN HALAMAN SEJARAH -->
  <section class="vt-section" id="virtual-tour" aria-label="Virtual Tour 360 SMK Negeri 2 Mojokerto">
    <span class="vt-watermark" aria-hidden="true">360°</span>
    <div class="vt-decor-ring" aria-hidden="true"></div>
    <div class="vt-decor-dots" aria-hidden="true"></div>
    <div class="vt-inner">
      <div class="vt-media" data-reveal="left">
        <div class="vt-frame">
          <img src="{{ asset('images/hero-sekolah.jpg') }}" alt="Lingkungan SMK Negeri 2 Mojokerto — Virtual Tour 360 derajat" loading="lazy">
          <span class="vt-badge"><i class="fa-solid fa-street-view"></i> 360° Tour</span>
          <button class="vt-play" type="button" aria-label="Mulai Virtual Tour 360 derajat" onclick="document.getElementById('vtTourLink')?.click()"><i class="fa-solid fa-play"></i></button>
          <div class="vt-caption">
            <div><strong>Jelajahi Sekolah</strong><span>SMK Negeri 2 Mojokerto</span></div>
            <span class="vt-cam"><i class="fa-solid fa-camera"></i> 360°</span>
          </div>
        </div>
        <div class="vt-chip"><i class="fa-solid fa-compass"></i><div><strong>Virtual Tour 360°</strong><span>Interactive Campus Experience</span></div></div>
      </div>
      <div class="vt-copy">
        <div class="vt-kicker" data-reveal>Virtual Experience</div>
        <h2 class="vt-title" data-reveal>Jelajahi <span class="vt-gold">SMKN 2 Mojokerto</span><span class="vt-sub">Lihat Virtual Tour 360°</span></h2>
        <p class="vt-desc" data-reveal>Jelajahi lingkungan SMK Negeri 2 Mojokerto secara interaktif melalui Virtual Tour 360°. Rasakan suasana sekolah dari sudut pandangmu dan lihat fasilitas sekolah secara lebih dekat.</p>
        <div class="vt-feats" data-reveal><span class="vt-feat"><i class="fa-solid fa-check"></i> Interaktif</span><span class="vt-feat"><i class="fa-solid fa-check"></i> Panorama 360°</span><span class="vt-feat"><i class="fa-solid fa-check"></i> Akses Mudah</span></div>
        <a href="#" id="vtTourLink" class="vt-btn" data-reveal>Mulai Virtual Tour <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </section>

  <!-- PERAN & TUGAS -->
  <div class="so-sec-head so-sec-head-mid" data-reveal>
    <div class="eyebrow">Alur Kerja Sekolah</div>
    <h2 class="big-heading">BAGAIMANA <span>SEKOLAH BEKERJA.</span></h2>
    <p class="so-sec-desc">Setiap bagian memiliki peran yang saling melengkapi — dari perencanaan kebijakan hingga layanan langsung kepada siswa.</p>
  </div>

  <div class="so-roles" data-reveal>
    <div class="so-role-card">
      <div class="so-role-icon"><i class="fas fa-flag-checkered"></i></div>
      <h4>Pimpinan Menetapkan Arah</h4>
      <p>Kepala Sekolah merumuskan kebijakan, program, dan target mutu sekolah, serta memimpin seluruh sumber daya menuju visi “SMK unggul, berkarakter, dan berdaya saing”.</p>
    </div>

    <div class="so-role-card">
      <div class="so-role-icon"><i class="fas fa-diagram-project"></i></div>
      <h4>Wakil Kepala Mengelola</h4>
      <p>Empat wakil kepala sekolah menerjemahkan kebijakan menjadi program kerja nyata di bidang kurikulum, kesiswaan, sarana prasarana, serta humas &amp; industri.</p>
    </div>

    <div class="so-role-card">
      <div class="so-role-icon is-gold"><i class="fas fa-graduation-cap"></i></div>
      <h4>KK &amp; GTK Melayani Siswa</h4>
      <p>Kompetensi keahlian, guru, dan tenaga kependidikan berada di garda terdepan: mengajar, membimbing, dan melayani peserta didik setiap hari.</p>
    </div>
  </div>

  <!-- CTA PENUTUP -->
  <div class="so-cta" data-reveal>
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="so-cta-inner">
      <h3>Ingin mengenal lebih dekat <span>keluarga besar sekolah?</span></h3>
      <p>Kenali para pendidik dan tenaga kependidikan yang membimbing siswa setiap harinya.</p>
      <a href="{{ route('profil.guru-staf') }}" class="so-cta-btn">
        Lihat Guru &amp; Staf <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div>

  <!-- MODAL DETAIL JABATAN -->
  <div class="so-modal-overlay" id="soModalOverlay" role="dialog" aria-modal="true" aria-labelledby="soModalTitle">
    <div class="so-modal" id="soModal">
      <button class="so-modal-close" id="soModalClose" aria-label="Tutup"><i class="fas fa-xmark"></i></button>
      <div class="so-modal-head">
        <div class="so-modal-avatar" id="soModalAvatar"><i class="fas fa-user-tie"></i></div>
        <div class="so-modal-name" id="soModalTitle">Kepala Sekolah</div>
        <div class="so-modal-role" id="soModalRole"><i class="fas fa-star"></i> Pimpinan Sekolah</div>
      </div>
      <div class="so-modal-body">
        <div class="so-modal-section">
          <div class="so-modal-label"><i class="fas fa-tags"></i> Bidang / Unit</div>
          <div class="so-modal-tags" id="soModalTags"></div>
        </div>
        <div class="so-modal-section">
          <div class="so-modal-label"><i class="fas fa-list-check"></i> Tugas &amp; Tanggung Jawab</div>
          <ul class="so-modal-tasks" id="soModalTasks"></ul>
        </div>
        <div class="so-modal-section">
          <div class="so-modal-label"><i class="fas fa-circle-info"></i> Catatan</div>
          <div class="so-modal-note" id="soModalNote"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
(function(){
  'use strict';

  /* ================= DATA JABATAN ================= */
  var DATA = {
    'kepsek': {
      name: 'Kepala Sekolah',
      role: 'Pimpinan Sekolah',
      unit: 'Pimpinan Sekolah',
      avatar: 'fas fa-user-tie',
      gold: false,
      tags: ['Pimpinan Sekolah'],
      tasks: [
        'Memimpin dan mengarahkan penyelenggaraan pendidikan sekolah.',
        'Menetapkan kebijakan, program kerja, dan target mutu sekolah.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'waka-kurikulum': {
      name: 'MELATI PUSPITA SARI, S.Pd.',
      role: 'Waka Kurikulum',
      unit: 'Kurikulum',
      avatar: 'fas fa-book-open',
      gold: false,
      tags: ['Kurikulum'],
      tasks: [
        'Mengelola dan mengoordinasikan pelaksanaan kurikulum sekolah.',
        'Mengatur program pembelajaran dan administrasi kurikulum.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'waka-kesiswaan': {
      name: 'AINUR ROFIK, M. Pd, Si.',
      role: 'Waka Kesiswaan',
      unit: 'Kesiswaan',
      avatar: 'fas fa-users',
      gold: false,
      tags: ['Kesiswaan'],
      tasks: [
        'Mengoordinasikan pembinaan peserta didik dan kegiatan kesiswaan.',
        'Mendukung pelaksanaan program pengembangan karakter siswa.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'waka-sapras': {
      name: 'M. WIRA HENDY HIMAWAN, M.Pd',
      role: 'Waka Sarana & Prasarana',
      unit: 'Sarana & Prasarana',
      avatar: 'fas fa-building',
      gold: false,
      tags: ['Sarana & Prasarana'],
      tasks: [
        'Mengoordinasikan pengelolaan sarana dan prasarana sekolah.',
        'Memastikan fasilitas pendukung pembelajaran tersedia dan terawat.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'waka-humas': {
      name: 'ARIKAWWEKU CKRISNA, S.Pd.',
      role: 'Waka Humastri',
      unit: 'Humastri',
      avatar: 'fas fa-handshake',
      gold: false,
      tags: ['Humastri'],
      tasks: [
        'Mengoordinasikan hubungan sekolah dengan masyarakat dan dunia industri.',
        'Mengembangkan kerja sama dan kemitraan sekolah.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'bendahara-bos': {
      name: 'MEGA NOVINDA SARI, S.Pd.',
      role: 'Bendahara BOS',
      unit: 'Keuangan',
      avatar: 'fas fa-money-bill-wave',
      gold: false,
      tags: ['Keuangan'],
      tasks: [
        'Mengelola administrasi dan pertanggungjawaban dana BOS.',
        'Menyiapkan pencatatan serta laporan keuangan sesuai ketentuan.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'bendahara-bpopp': {
      name: 'FAJAR DHILAMAYA, S.Pd.',
      role: 'Bendahara BPOPP',
      unit: 'Keuangan',
      avatar: 'fas fa-wallet',
      gold: false,
      tags: ['Keuangan'],
      tasks: [
        'Mengelola administrasi dan pertanggungjawaban dana BPOPP.',
        'Menyiapkan pencatatan serta laporan keuangan sesuai ketentuan.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'kk-rpl': {
      name: 'DANANG TEGUH SANTOSO, S.Kom',
      role: 'Ketua Kompetensi Keahlian RPL',
      unit: 'Kompetensi Keahlian RPL',
      avatar: 'fas fa-code',
      gold: false,
      tags: ['Kompetensi Keahlian RPL'],
      tasks: [
        'Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian RPL.',
        'Mengembangkan kompetensi siswa sesuai kebutuhan bidang perangkat lunak.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'kk-aphp': {
      name: 'DESY ANDINI DILIAWATI, S.T.P.',
      role: 'Ketua Kompetensi Keahlian APHP',
      unit: 'Kompetensi Keahlian APHP',
      avatar: 'fas fa-seedling',
      gold: false,
      tags: ['Kompetensi Keahlian APHP'],
      tasks: [
        'Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian APHP.',
        'Mengembangkan kompetensi siswa dalam pengolahan hasil pertanian.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'kk-dkv': {
      name: 'NURFALAH SEPTAYOGA S.Kom.',
      role: 'Ketua Kompetensi Keahlian DKV',
      unit: 'Kompetensi Keahlian DKV',
      avatar: 'fas fa-palette',
      gold: false,
      tags: ['Kompetensi Keahlian DKV'],
      tasks: [
        'Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian DKV.',
        'Mengembangkan kompetensi siswa dalam bidang desain komunikasi visual.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'kk-lps': {
      name: 'METIY ARIANA, S.Pd, M.Pd.',
      role: 'Ketua Kompetensi Keahlian LPS',
      unit: 'Kompetensi Keahlian LPS',
      avatar: 'fas fa-landmark',
      gold: false,
      tags: ['Kompetensi Keahlian LPS'],
      tasks: [
        'Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian LPS.',
        'Mengembangkan kompetensi siswa dalam layanan perbankan syariah.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'kk-kuliner': {
      name: 'DHIYAH AMANATI KARTIKA SARI, S.Pd.',
      role: 'Ketua Kompetensi Keahlian Kuliner',
      unit: 'Kompetensi Keahlian Kuliner',
      avatar: 'fas fa-utensils',
      gold: false,
      tags: ['Kompetensi Keahlian Kuliner'],
      tasks: [
        'Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian Kuliner.',
        'Mengembangkan kompetensi siswa dalam bidang kuliner dan tata boga.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'koordinator-bkk': {
      name: 'MULAT ADITYAWIRANTI, S.Pd.',
      role: 'Koordinator BKK',
      unit: 'BKK / Humastri',
      avatar: 'fas fa-briefcase',
      gold: false,
      tags: ['BKK / Humastri'],
      tasks: [
        'Mengoordinasikan layanan Bursa Kerja Khusus (BKK).',
        'Mendukung penyaluran lulusan dan hubungan dengan dunia kerja.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    }
  }

  /* ================= ELEMEN ================= */
  var cards = Array.prototype.slice.call(document.querySelectorAll('.so-card'));
  var overlay = document.getElementById('soModalOverlay');
  var modal = document.getElementById('soModal');
  var searchInput = document.getElementById('soSearchInput');
  var chips = Array.prototype.slice.call(document.querySelectorAll('.so-fchip'));
  var emptyBox = document.getElementById('soEmpty');
  var eraPills = Array.prototype.slice.call(document.querySelectorAll('.so-nav-pill'));

  /* ================= PILL NAVIGASI LEVEL (scroll spy) ================= */
  var levels = Array.prototype.slice.call(document.querySelectorAll('.so-level'));
  if(eraPills.length && levels.length){
    var levelMap = {};
    eraPills.forEach(function(p){ levelMap[p.getAttribute('data-target')] = p; });
    var levelObs = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          eraPills.forEach(function(p){ p.classList.remove('is-active'); });
          var pill = levelMap[entry.target.id];
          if(pill) pill.classList.add('is-active');
        }
      });
    }, { rootMargin: '-30% 0px -55% 0px', threshold: 0 });
    levels.forEach(function(l){ levelObs.observe(l); });
  }

  /* ================= MODAL ================= */
  function openModal(key){
    var d = DATA[key];
    if(!d) return;
    document.getElementById('soModalTitle').textContent = d.name;
    document.getElementById('soModalRole').innerHTML = '<i class="' + d.avatar + '"></i> ' + d.role;
    var avatar = document.getElementById('soModalAvatar');
    avatar.innerHTML = '<i class="' + d.avatar + '"></i>';
    avatar.classList.toggle('is-gold', !!d.gold);
    var tags = document.getElementById('soModalTags');
    tags.innerHTML = '';
    d.tags.forEach(function(t){
      var span = document.createElement('span');
      span.className = 'so-tag' + (d.gold ? ' is-gold' : '');
      span.textContent = t;
      tags.appendChild(span);
    });
    var tasks = document.getElementById('soModalTasks');
    tasks.innerHTML = '';
    d.tasks.forEach(function(t){
      var li = document.createElement('li');
      li.innerHTML = '<i class="fas fa-check"></i><span></span>';
      li.querySelector('span').textContent = t;
      tasks.appendChild(li);
    });
    document.getElementById('soModalNote').innerHTML = '<i class="fas fa-circle-info"></i><span></span>';
    document.getElementById('soModalNote').querySelector('span').textContent = d.note;
    overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
    document.querySelector('.so-modal-close').focus();
  }
  function closeModal(){
    overlay.classList.remove('open');
    document.body.style.overflow = '';
  }
  cards.forEach(function(card){
    card.addEventListener('click', function(){ openModal(card.getAttribute('data-detail')); });
    card.addEventListener('keydown', function(e){
      if(e.key === 'Enter' || e.key === ' '){ e.preventDefault(); openModal(card.getAttribute('data-detail')); }
    });
  });
  document.getElementById('soModalClose').addEventListener('click', closeModal);
  overlay.addEventListener('click', function(e){ if(e.target === overlay) closeModal(); });
  document.addEventListener('keydown', function(e){ if(e.key === 'Escape') closeModal(); });

  /* ================= SEARCH + FILTER ================= */
  function applyFilter(){
    var q = (searchInput.value || '').toLowerCase().trim();
    var activeFilter = '*';
    chips.forEach(function(c){ if(c.classList.contains('is-active')) activeFilter = c.getAttribute('data-filter'); });
    var visibleCount = 0;
    cards.forEach(function(card){
      var text = (card.getAttribute('data-name') + ' ' + card.getAttribute('data-role') + ' ' + card.getAttribute('data-unit')).toLowerCase();
      var matchFilter = (activeFilter === '*') || (card.getAttribute('data-filter') === activeFilter);
      var matchQuery = !q || text.indexOf(q) !== -1;
      if(matchFilter && matchQuery){
        card.classList.remove('is-hidden');
        card.classList.toggle('is-match', !!q);
        visibleCount++;
      } else {
        card.classList.add('is-hidden');
      }
    });
    emptyBox.classList.toggle('show', visibleCount === 0);
  }
  searchInput.addEventListener('input', applyFilter);
  chips.forEach(function(chip){
    chip.addEventListener('click', function(){
      chips.forEach(function(c){ c.classList.remove('is-active'); });
      chip.classList.add('is-active');
      applyFilter();
    });
  });
})();

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
  })();
</script>
@endpush

