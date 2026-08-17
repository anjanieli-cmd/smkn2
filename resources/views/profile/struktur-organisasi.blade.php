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
</style>
@endpush

@section('content')
<div class="so-page">
  <!-- HERO -->
  <section class="so-hero">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="so-hero-inner">
      <div>
        <div class="so-kicker">PETA ORGANISASI</div>
        <h1 class="so-title">
          <span class="so-white">STRUKTUR</span> <span class="so-gold">ORGANISASI</span>
        </h1>
        <p class="so-lead">Kenali susunan organisasi SMK Negeri 2 Mojokerto — dari pimpinan, wakil kepala sekolah, hingga para koordinator yang bekerja bersama untuk membangun sekolah yang unggul, berkarakter, dan berdaya saing.</p>
        <div class="so-hero-meta">
          <span class="so-hero-pill"><i class="fas fa-sitemap"></i> Struktur Terorganisir</span>
          <span class="so-hero-pill"><i class="fas fa-users"></i> Keluarga Besar SKANEDA</span>
        </div>
        <a href="#virtual-tour" class="so-vt-hero-cta">
          <span class="so-vt-hero-icon"><i class="fas fa-street-view"></i></span>
          <span><strong>Lihat Virtual Tour 360°</strong><small>Jelajahi SMK Negeri 2 Mojokerto</small></span>
          <i class="fas fa-arrow-right so-vt-hero-arrow"></i>
        </a>
      </div>

      <div class="hero-photo" data-reveal="right">
        <img src="{{ asset('images/smkn-guru.jpg') }}" alt="Keluarga besar SMK Negeri 2 Mojokerto" loading="eager">
        <div class="hero-photo-caption"><strong>Keluarga besar SKANEDA</strong><span>Pimpinan, guru, dan tenaga kependidikan dalam satu kesatuan organisasi.</span></div>
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

    <div class="so-wrap">
      <div class="so-sec-head" data-reveal>
        <div class="eyebrow">Bagan Organisasi</div>
        <h2 class="big-heading">Tiga lapisan, <span>satu kesatuan.</span></h2>
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
              <div class="so-card-person">Nama Kepala Sekolah</div>
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
            <article class="so-card" tabindex="0" data-name="Wakil Kepala Sekolah Bidang Kurikulum" data-role="Wakil Kepala Sekolah" data-unit="Bidang Kurikulum" data-filter="kurikulum" data-detail="waka-kurikulum">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/waka-kurikulum.png') }}" alt="Foto Wakil Kepala Sekolah Bidang Kurikulum" loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-book-open"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Wakil Kepala Sekolah</h3>
              <div class="so-card-person">Nama Waka Kurikulum</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Bidang Kurikulum</div>
              <p class="so-card-unit">Merencanakan &amp; mengendalikan pembelajaran</p>
            </article>
            <article class="so-card" tabindex="0" data-name="Wakil Kepala Sekolah Bidang Kesiswaan" data-role="Wakil Kepala Sekolah" data-unit="Bidang Kesiswaan" data-filter="kesiswaan" data-detail="waka-kesiswaan">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/waka-kesiswaan.png') }}" alt="Foto Wakil Kepala Sekolah Bidang Kesiswaan" loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-users"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Wakil Kepala Sekolah</h3>
              <div class="so-card-person">Nama Waka Kesiswaan</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Bidang Kesiswaan</div>
              <p class="so-card-unit">Pembinaan &amp; layanan peserta didik</p>
            </article>
            <article class="so-card" tabindex="0" data-name="Wakil Kepala Sekolah Bidang Sarana &amp; Prasarana" data-role="Wakil Kepala Sekolah" data-unit="Bidang Sarana &amp; Prasarana" data-filter="sapras" data-detail="waka-sapras">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/waka-sapras.png') }}" alt="Foto Wakil Kepala Sekolah Bidang Sarana &amp; Prasarana" loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-building"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Wakil Kepala Sekolah</h3>
              <div class="so-card-person">Nama Waka Sapras</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Bidang Sarana &amp; Prasarana</div>
              <p class="so-card-unit">Pengelolaan fasilitas &amp; perlengkapan sekolah</p>
            </article>
            <article class="so-card" tabindex="0" data-name="Wakil Kepala Sekolah Bidang Humas &amp; Industri" data-role="Wakil Kepala Sekolah" data-unit="Bidang Humas &amp; Industri" data-filter="humas" data-detail="waka-humas">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/waka-humas.png') }}" alt="Foto Wakil Kepala Sekolah Bidang Humas &amp; Industri" loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-handshake"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Wakil Kepala Sekolah</h3>
              <div class="so-card-person">Nama Waka Humas</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Bidang Humas &amp; Industri</div>
              <p class="so-card-unit">Kemitraan dunia usaha/dunia industri</p>
            </article>
          </div>
        </div>

        {{-- ===== LEVEL 3: KOORDINATOR ===== --}}
        <div class="so-level so-anchor" id="level-3" data-level="3">
          <div class="so-level-head">
            <span class="so-level-badge"><i class="fas fa-layer-group"></i> Level 3 &mdash; Koordinator</span>
            <span class="so-level-rule"></span>
          </div>
          <div class="so-grid cols-5">
            <article class="so-card" tabindex="0" data-name="Koordinator Bidang Kurikulum" data-role="Koordinator" data-unit="Bidang Kurikulum" data-filter="kurikulum" data-detail="kor-kurikulum">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/kor-kurikulum.png') }}" alt="Foto Koordinator Bidang Kurikulum" loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-calendar-check"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Koordinator Bidang Kurikulum</h3>
              <div class="so-card-person">Nama Koordinator</div>
              <div class="so-card-role"><i class="fas fa-diagram-project"></i> Koordinator</div>
              <p class="so-card-unit">Penyusunan jadwal &amp; administrasi pembelajaran</p>
            </article>
            <article class="so-card" tabindex="0" data-name="Koordinator Bidang Kesiswaan" data-role="Koordinator" data-unit="Bidang Kesiswaan" data-filter="kesiswaan" data-detail="kor-kesiswaan">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/kor-kesiswaan.png') }}" alt="Foto Koordinator Bidang Kesiswaan" loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-shield-halved"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Koordinator Bidang Kesiswaan</h3>
              <div class="so-card-person">Nama Koordinator</div>
              <div class="so-card-role"><i class="fas fa-diagram-project"></i> Koordinator</div>
              <p class="so-card-unit">Tata tertib, OSIS, &amp; pembinaan karakter</p>
            </article>
            <article class="so-card" tabindex="0" data-name="Koordinator Bidang Sarana &amp; Prasarana" data-role="Koordinator" data-unit="Bidang Sarana &amp; Prasarana" data-filter="sapras" data-detail="kor-sapras">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/kor-sapras.png') }}" alt="Foto Koordinator Bidang Sarana &amp; Prasarana" loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-toolbox"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Koordinator Bidang Sarana &amp; Prasarana</h3>
              <div class="so-card-person">Nama Koordinator</div>
              <div class="so-card-role"><i class="fas fa-diagram-project"></i> Koordinator</div>
              <p class="so-card-unit">Inventarisasi, perawatan &amp; kelayakan ruang</p>
            </article>
            <article class="so-card" tabindex="0" data-name="Koordinator Hubin &amp; BKK" data-role="Koordinator" data-unit="Bidang Humas &amp; Industri" data-filter="humas" data-detail="kor-hubin">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/kor-hubin.png') }}" alt="Foto Koordinator Hubin &amp; BKK" loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-building-circle-check"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Koordinator Hubin &amp; BKK</h3>
              <div class="so-card-person">Nama Koordinator</div>
              <div class="so-card-role"><i class="fas fa-diagram-project"></i> Koordinator</div>
              <p class="so-card-unit">PKL, penyaluran kerja &amp; tracer study</p>
            </article>
            <article class="so-card" tabindex="0" data-name="Koordinator Bimbingan Konseling" data-role="Koordinator" data-unit="Bidang Kesiswaan" data-filter="kesiswaan" data-detail="kor-bk">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/kor-bk.png') }}" alt="Foto Koordinator Bimbingan Konseling" loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-comments"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Koordinator Bimbingan Konseling</h3>
              <div class="so-card-person">Nama Koordinator</div>
              <div class="so-card-role"><i class="fas fa-diagram-project"></i> Koordinator</div>
              <p class="so-card-unit">Layanan konseling &amp; bimbingan karier siswa</p>
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
            <div><strong>Jelajahi Sekolah</strong><span>Kampus SMK Negeri 2 Mojokerto</span></div>
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
    <h2 class="big-heading">Bagaimana <span>sekolah bekerja.</span></h2>
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
    kepsek: {
      name: 'Kepala Sekolah',
      role: 'Pimpinan Sekolah',
      unit: 'Pimpinan Sekolah',
      avatar: 'fas fa-user-tie',
      gold: true,
      tags: ['Pimpinan Sekolah'],
      tasks: [
        'Merumuskan visi, misi, kebijakan, dan program kerja sekolah.',
        'Memimpin, mengelola, dan mengembangkan seluruh sumber daya sekolah (SDM, sarana, keuangan).',
        'Menyusun rencana kerja dan anggaran sekolah (RKAS) bersama tim.',
        'Melaksanakan supervisi akademik dan manajerial terhadap guru dan tenaga kependidikan.',
        'Menjalin kemitraan dengan orang tua, komite sekolah, dan dunia usaha/dunia industri.',
        'Menetapkan target mutu dan memastikan tercapainya akreditasi serta capaian pembelajaran.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'waka-kurikulum': {
      name: 'Wakil Kepala Sekolah Bidang Kurikulum',
      role: 'Wakil Kepala Sekolah',
      unit: 'Bidang Kurikulum',
      avatar: 'fas fa-book-open',
      gold: false,
      tags: ['Wakil Kepala Sekolah', 'Kurikulum'],
      tasks: [
        'Menyusun dan mengembangkan kurikulum sekolah sesuai standar nasional.',
        'Mengelola proses pembelajaran: jadwal, pembagian tugas guru, dan kalender pendidikan.',
        'Mengkoordinasikan penilaian, asesmen, dan pelaporan hasil belajar siswa.',
        'Mengelola implementasi kurikulum merdeka dan program peningkatan mutu pembelajaran.',
        'Menyusun program supervisi pembelajaran bersama kepala sekolah.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'waka-kesiswaan': {
      name: 'Wakil Kepala Sekolah Bidang Kesiswaan',
      role: 'Wakil Kepala Sekolah',
      unit: 'Bidang Kesiswaan',
      avatar: 'fas fa-users',
      gold: false,
      tags: ['Wakil Kepala Sekolah', 'Kesiswaan'],
      tasks: [
        'Mengelola penerimaan peserta didik baru (PPDB) dan kegiatan MOS/LMPS.',
        'Membina OSIS, ekstrakurikuler, dan pengembangan karakter siswa.',
        'Menegakkan tata tertib dan kedisiplinan peserta didik.',
        'Mengelola data kesiswaan dan layanan konseling/BP.',
        'Menangani prestasi, penghargaan, dan kesejahteraan siswa.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'waka-sapras': {
      name: 'Wakil Kepala Sekolah Bidang Sarana & Prasarana',
      role: 'Wakil Kepala Sekolah',
      unit: 'Bidang Sarana & Prasarana',
      avatar: 'fas fa-building',
      gold: false,
      tags: ['Wakil Kepala Sekolah', 'Sarana & Prasarana'],
      tasks: [
        'Mengelola perencanaan, pengadaan, dan inventarisasi sarana prasarana.',
        'Memelihara gedung, ruang belajar, laboratorium, dan bengkel.',
        'Menjamin ketersediaan fasilitas pendukung pembelajaran.',
        'Mengelola tata ruang, kebersihan, dan keamanan lingkungan sekolah.',
        'Menyusun laporan penggunaan dan kebutuhan sarana prasarana.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'waka-humas': {
      name: 'Wakil Kepala Sekolah Bidang Humas & Industri',
      role: 'Wakil Kepala Sekolah',
      unit: 'Bidang Humas & Industri',
      avatar: 'fas fa-handshake',
      gold: false,
      tags: ['Wakil Kepala Sekolah', 'Humas & Industri'],
      tasks: [
        'Membangun kemitraan dengan dunia usaha, dunia industri, dan dunia kerja (DUDIKA).',
        'Mengelola hubungan masyarakat, publikasi, dan citra positif sekolah.',
        'Mengkoordinasikan pelaksanaan PKL dan penyaluran lulusan.',
        'Mengelola tracer study dan kerja sama MoU dengan mitra industri.',
        'Menjalin komunikasi dengan orang tua, komite, dan pemangku kepentingan.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'kor-kurikulum': {
      name: 'Koordinator Bidang Kurikulum',
      role: 'Koordinator',
      unit: 'Bidang Kurikulum',
      avatar: 'fas fa-calendar-check',
      gold: false,
      tags: ['Koordinator', 'Kurikulum'],
      tasks: [
        'Menyusun jadwal pelajaran dan pembagian tugas mengajar guru.',
        'Mengelola administrasi pembelajaran (kalender, RPP, modul ajar).',
        'Mengkoordinasikan kegiatan tengah semester dan akhir semester.',
        'Mendampingi guru dalam pengembangan perangkat pembelajaran.',
        'Menyiapkan data untuk pelaporan dan akreditasi bidang kurikulum.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'kor-kesiswaan': {
      name: 'Koordinator Bidang Kesiswaan',
      role: 'Koordinator',
      unit: 'Bidang Kesiswaan',
      avatar: 'fas fa-shield-halved',
      gold: false,
      tags: ['Koordinator', 'Kesiswaan'],
      tasks: [
        'Mengoordinasikan pelaksanaan tata tertib dan kedisiplinan siswa.',
        'Membina pengurus OSIS dan kegiatan ekstrakurikuler.',
        'Mengelola kegiatan pembinaan karakter dan keagamaan.',
        'Mendampingi kegiatan kesiswaan di tingkat kota, provinsi, dan nasional.',
        'Mengelola data kehadiran dan catatan pembinaan siswa.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'kor-sapras': {
      name: 'Koordinator Bidang Sarana & Prasarana',
      role: 'Koordinator',
      unit: 'Bidang Sarana & Prasarana',
      avatar: 'fas fa-toolbox',
      gold: false,
      tags: ['Koordinator', 'Sarana & Prasarana'],
      tasks: [
        'Melaksanakan inventarisasi dan pencatatan aset sekolah.',
        'Mengoordinasikan perawatan dan perbaikan fasilitas.',
        'Memastikan kelayakan ruang kelas, laboratorium, dan bengkel.',
        'Mengelola kebutuhan alat dan bahan praktik pembelajaran.',
        'Menyusun laporan kondisi dan kebutuhan sarana prasarana.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'kor-hubin': {
      name: 'Koordinator Hubin & BKK',
      role: 'Koordinator',
      unit: 'Bidang Humas & Industri',
      avatar: 'fas fa-building-circle-check',
      gold: false,
      tags: ['Koordinator', 'Humas & Industri'],
      tasks: [
        'Mengoordinasikan pelaksanaan Praktik Kerja Lapangan (PKL) siswa.',
        'Mengelola bursa kerja khusus (BKK) dan penyaluran lulusan.',
        'Menjalin komunikasi dengan mitra industri dan dunia kerja.',
        'Melaksanakan tracer study dan pendataan lulusan.',
        'Menyusun laporan kemitraan dan penempatan kerja.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'kor-bk': {
      name: 'Koordinator Bimbingan Konseling',
      role: 'Koordinator',
      unit: 'Bidang Kesiswaan',
      avatar: 'fas fa-comments',
      gold: false,
      tags: ['Koordinator', 'Bimbingan Konseling'],
      tasks: [
        'Mengoordinasikan layanan bimbingan dan konseling bagi siswa.',
        'Mengelola bimbingan karier, pribadi, sosial, dan belajar.',
        'Menangani permasalahan siswa dan rujukan konseling.',
        'Menyusun program dan laporan layanan BK.',
        'Berkolaborasi dengan wali kelas dan orang tua siswa.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'kk-kuliner': {
      name: 'Kepala Kompetensi Keahlian Kuliner',
      role: 'Kepala Kompetensi Keahlian',
      unit: 'Kuliner (Tata Boga)',
      avatar: 'fas fa-utensils',
      gold: false,
      tags: ['Kompetensi Keahlian', 'Kuliner'],
      tasks: [
        'Mengelola program pembelajaran keahlian kuliner/tata boga.',
        'Mengelola laboratorium pengolahan dan penyajian makanan.',
        'Membimbing siswa dalam praktik dan uji kompetensi keahlian.',
        'Menjalin kemitraan industri untuk PKL bidang kuliner.',
        'Mengembangkan inovasi produk dan kewirausahaan siswa.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'kk-pplg': {
      name: 'Kepala Kompetensi Keahlian PPLG',
      role: 'Kepala Kompetensi Keahlian',
      unit: 'PPLG (RPL)',
      avatar: 'fas fa-code',
      gold: false,
      tags: ['Kompetensi Keahlian', 'PPLG'],
      tasks: [
        'Mengelola program pembelajaran pengembangan perangkat lunak & gim.',
        'Mengelola laboratorium komputer dan lingkungan pengembangan.',
        'Membimbing siswa dalam proyek perangkat lunak dan gim.',
        'Menyiapkan siswa menghadapi sertifikasi dan lomba kompetensi.',
        'Menjalin kemitraan industri teknologi informasi.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'kk-dkv': {
      name: 'Kepala Kompetensi Keahlian DKV',
      role: 'Kepala Kompetensi Keahlian',
      unit: 'DKV',
      avatar: 'fas fa-palette',
      gold: false,
      tags: ['Kompetensi Keahlian', 'DKV'],
      tasks: [
        'Mengelola program pembelajaran desain komunikasi visual.',
        'Mengelola studio desain dan peralatan produksi media.',
        'Membimbing siswa dalam proyek desain grafis dan multimedia.',
        'Mengembangkan portofolio dan karya kreatif siswa.',
        'Menjalin kemitraan industri kreatif dan periklanan.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'kk-aphp': {
      name: 'Kepala Kompetensi Keahlian APHP',
      role: 'Kepala Kompetensi Keahlian',
      unit: 'APHP',
      avatar: 'fas fa-seedling',
      gold: false,
      tags: ['Kompetensi Keahlian', 'APHP'],
      tasks: [
        'Mengelola program pembelajaran agriteknologi pengolahan hasil pertanian.',
        'Mengelola laboratorium pengolahan pangan dan uji mutu.',
        'Membimbing siswa dalam praktik pengolahan hasil pertanian.',
        'Mengembangkan produk olahan dan kemasan bernilai jual.',
        'Menjalin kemitraan dengan industri pangan dan pertanian.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'kk-akl': {
      name: 'Kepala Kompetensi Keahlian AKL',
      role: 'Kepala Kompetensi Keahlian',
      unit: 'AKL',
      avatar: 'fas fa-calculator',
      gold: false,
      tags: ['Kompetensi Keahlian', 'AKL'],
      tasks: [
        'Mengelola program pembelajaran akuntansi dan keuangan lembaga.',
        'Mengelola laboratorium akuntansi dan perbankan.',
        'Membimbing siswa dalam praktik akuntansi dan pengelolaan keuangan.',
        'Menyiapkan siswa menghadapi sertifikasi dan uji kompetensi.',
        'Menjalin kemitraan dengan lembaga keuangan dan perbankan.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'guru-produktif': {
      name: 'Guru Produktif',
      role: 'Guru',
      unit: 'Guru & Tenaga Kependidikan',
      avatar: 'fas fa-chalkboard-user',
      gold: false,
      tags: ['Guru', 'Guru Produktif'],
      tasks: [
        'Mengampu mata pelajaran produktif/kejuruan sesuai kompetensinya.',
        'Menyusun perangkat pembelajaran dan asesmen.',
        'Membimbing praktik dan proyek siswa di laboratorium/bengkel.',
        'Melaksanakan penilaian dan pelaporan hasil belajar.',
        'Mengikuti pengembangan profesi dan sertifikasi keahlian.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'guru-normatif': {
      name: 'Guru Normatif & Adaptif',
      role: 'Guru',
      unit: 'Guru & Tenaga Kependidikan',
      avatar: 'fas fa-book',
      gold: false,
      tags: ['Guru', 'Guru Normatif & Adaptif'],
      tasks: [
        'Mengampu mata pelajaran normatif dan adaptif (umum).',
        'Menyusun perangkat pembelajaran dan asesmen.',
        'Membimbing pengembangan karakter dan literasi siswa.',
        'Melaksanakan penilaian dan pelaporan hasil belajar.',
        'Berkolaborasi dengan wali kelas dan orang tua.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'wali-kelas': {
      name: 'Wali Kelas',
      role: 'Guru',
      unit: 'Guru & Tenaga Kependidikan',
      avatar: 'fas fa-house-chimney-user',
      gold: false,
      tags: ['Guru', 'Wali Kelas'],
      tasks: [
        'Mendampingi dan memantau perkembangan siswa dalam kelasnya.',
        'Mengelola administrasi kelas: absensi, rapor, dan catatan siswa.',
        'Menjadi penghubung antara sekolah, siswa, dan orang tua.',
        'Membina kedisiplinan dan motivasi belajar siswa.',
        'Mengoordinasikan penyerahan rapor dan kegiatan kelas.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'guru-bk': {
      name: 'Guru Bimbingan Konseling',
      role: 'Guru',
      unit: 'Guru & Tenaga Kependidikan',
      avatar: 'fas fa-comments',
      gold: false,
      tags: ['Guru', 'Bimbingan Konseling'],
      tasks: [
        'Memberikan layanan konseling pribadi, sosial, belajar, dan karier.',
        'Melaksanakan bimbingan klasikal dan konseling individual.',
        'Mengelola data perkembangan dan permasalahan siswa.',
        'Mengoordinasikan bimbingan karier dan informasi studi lanjut.',
        'Berkolaborasi dengan wali kelas, orang tua, dan pihak terkait.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'ka-tu': {
      name: 'Kepala Tata Usaha',
      role: 'Tenaga Kependidikan',
      unit: 'Guru & Tenaga Kependidikan',
      avatar: 'fas fa-folder-open',
      gold: false,
      tags: ['Tenaga Kependidikan', 'Tata Usaha'],
      tasks: [
        'Memimpin dan mengelola layanan administrasi sekolah.',
        'Mengelola surat-menyurat, kearsipan, dan kepegawaian.',
        'Mengelola data pokok pendidikan (Dapodik).',
        'Mengoordinasikan layanan administrasi siswa dan guru.',
        'Menyusun laporan administrasi kepada kepala sekolah.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'staf-tu': {
      name: 'Bendahara & Staf Administrasi',
      role: 'Tenaga Kependidikan',
      unit: 'Guru & Tenaga Kependidikan',
      avatar: 'fas fa-money-check-dollar',
      gold: false,
      tags: ['Tenaga Kependidikan', 'Bendahara'],
      tasks: [
        'Mengelola keuangan sekolah sesuai peraturan yang berlaku.',
        'Membantu administrasi kepegawaian dan keuangan.',
        'Melayani administrasi siswa (ijazah, surat keterangan, dll).',
        'Mengelola inventaris dan kebutuhan operasional kantor.',
        'Menyusun laporan keuangan dan administrasi secara berkala.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    },
    'penjaga': {
      name: 'Penjaga Sekolah & Kebersihan',
      role: 'Tenaga Kependidikan',
      unit: 'Guru & Tenaga Kependidikan',
      avatar: 'fas fa-broom',
      gold: false,
      tags: ['Tenaga Kependidikan', 'Keamanan & Kebersihan'],
      tasks: [
        'Menjaga keamanan dan ketertiban lingkungan sekolah.',
        'Mengelola kebersihan ruang, halaman, dan fasilitas sekolah.',
        'Melakukan perawatan kecil fasilitas sekolah.',
        'Mendukung kelancaran kegiatan sekolah dan acara resmi.',
        'Melaporkan kondisi dan kebutuhan lingkungan sekolah.'
      ],
      note: 'Nama pejabat akan dilengkapi sesuai data resmi sekolah.'
    }
  };

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