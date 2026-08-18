
<style id="staff-guru-card-back-text-final">
/* Ukuran teks belakang kartu diperbesar agar terbaca jelas saat kartu dibalik */
.idcard-h .idback-head .id-school{
  font-size:clamp(.82rem,1.15vw,.98rem) !important;
  letter-spacing:.045em !important;
}
.idcard-h .idback-head .id-school-sub{
  font-size:clamp(.56rem,.78vw,.68rem) !important;
  letter-spacing:.12em !important;
}
.idcard-h .idback-label{
  font-size:clamp(.62rem,.82vw,.72rem) !important;
}
.idcard-h .idback-bio{
  font-size:clamp(.72rem,1vw,.84rem) !important;
  line-height:1.5 !important;
}
.idcard-h .idback-quote p{
  font-size:clamp(.68rem,.92vw,.78rem) !important;
  line-height:1.5 !important;
}
.idcard-h .idback-foot span{
  font-size:clamp(.54rem,.72vw,.64rem) !important;
}
</style>

<style id="staff-guru-gold-final">
.history-title .skaneda-gold{
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%) !important;
  -webkit-background-clip:text !important;
  background-clip:text !important;
  -webkit-text-fill-color:transparent !important;
  color:#ffc107 !important;
  text-shadow:none !important;
}
</style>
@extends('layouts.app')

@section('title', 'Staff & Guru — SMK Negeri 2 Mojokerto')
@section('description', 'Mengenal para pendidik dan tenaga kependidikan SMK Negeri 2 Mojokerto — guru dan staf yang membimbing peserta didik setiap hari.')

@push('styles')
<style>
/* =========================================================
   STAFF & GURU — HERO 100% mengikuti Struktur Organisasi
   GURU & STAF — PREMIUM EDITION
   Visual language: SENADA PERSIS dengan Sejarah Sekolah,
   Struktur Organisasi & Visi Misi — foto gedung + overlay,
   watermark typography, ornamen geometris (home-orn),
   glassmorphism, scroll-reveal.
   Kartu: ID card lanyard design (flip 3D) — depan identitas
   + pas foto 3x4, belakang profil & motto.
   Warna: navy #0d3a66, biru #2f6fa8, putih, gold #ffd54a/#ffb300.
   ========================================================= */
.sg-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}
.sg-page *{box-sizing:border-box}
.sg-shell{width:100%}

/* ---------- HERO: clean editorial showcase, tanpa foto background ---------- */
.history-hero{position:relative;min-height:78vh;display:flex;align-items:center;overflow:hidden;
  background:#fff;color:#0d3a66}
.history-hero::before{display:none}
/* Watermark besar seperti referensi: sangat tipis, berada di belakang judul */
.history-hero::after{content:"STAFF & GURU";position:absolute;z-index:0;left:-2%;top:50%;transform:translateY(-50%);
  font-family:var(--font-display);font-size:clamp(10rem,30vw,30rem);font-weight:900;line-height:.78;
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
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);
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

  /* ---------- BRAND CARD: SKANEDA ---------- */
  .sg-brand-card{
    width:min(100%,520px);
    min-height:108px;
    display:grid !important;
    grid-template-columns:92px minmax(0,1fr) 38px;
    align-items:center;
    gap:1.1rem;
    margin-top:1.7rem;
    padding:1rem 1.15rem !important;
    border-radius:24px !important;
    text-decoration:none;
    color:#0d3a66;
    background:rgba(255,255,255,.94) !important;
    border:1px solid rgba(13,58,102,.10) !important;
    box-shadow:0 18px 45px rgba(13,58,102,.12),0 4px 16px rgba(255,170,0,.08) !important;
    backdrop-filter:blur(12px);
    -webkit-backdrop-filter:blur(12px);
  }
  .sg-brand-card:hover{
    transform:translateY(-4px);
    background:#fff !important;
    border-color:rgba(255,180,0,.25) !important;
    box-shadow:0 24px 55px rgba(13,58,102,.16),0 8px 22px rgba(255,170,0,.10) !important;
  }
  .sg-brand-logo{
    width:78px;height:78px;
    display:grid;place-items:center;
    border-radius:20px;
    background:linear-gradient(145deg,#fff,#f4f8fc);
    border:1px solid rgba(13,58,102,.08);
    box-shadow:0 8px 20px rgba(13,58,102,.10);
    overflow:hidden;
  }
  .sg-brand-logo img{
    width:64px;height:64px;object-fit:contain;display:block;
  }
  .sg-brand-copy{
    display:flex;flex-direction:column;gap:.22rem;
    min-width:0;
  }
  .sg-brand-copy strong{
    font-family:var(--font-display);
    font-size:1.18rem;
    line-height:1.15;
    font-weight:900;
    color:#0d3a66;
    white-space:nowrap;
  }
  .sg-brand-copy small{
    font-size:.92rem;
    line-height:1.35;
    font-weight:700;
    color:#5d7893;
  }
  .sg-brand-card .history-vt-arrow{
    color:#ffb300;
    font-size:1.25rem;
    justify-self:end;
  }

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

/* ---------- STAFF & GURU HERO RESPONSIVE (same as Struktur Organisasi) ---------- */
@media(max-width:700px){
  .sg-brand-card{
    width:100%;
    grid-template-columns:68px minmax(0,1fr) 28px;
    min-height:86px;
    padding:.75rem .85rem !important;
    gap:.75rem;
    border-radius:18px !important;
  }
  .sg-brand-logo{width:58px;height:58px;border-radius:15px}
  .sg-brand-logo img{width:48px;height:48px}
  .sg-brand-copy strong{font-size:.92rem;white-space:normal}
  .sg-brand-copy small{font-size:.72rem}
  .sg-brand-card .history-vt-arrow{font-size:1rem}

  .history-hero{min-height:70vh}
  .history-hero-inner{padding-top:3.5rem;padding-bottom:4rem}
  .history-title{font-size:clamp(3.5rem,16vw,6rem);line-height:.88}
  .history-hero::after{font-size:clamp(7rem,32vw,12rem);left:-8%}
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
/* ---------- SECTION COMMON (keluarga Beranda) ---------- */
.sg-wide{width:min(1380px,92%);margin:auto}
.sg-section{position:relative;padding:96px 0 110px;background:#fff}
.eyebrow{display:inline-flex;align-items:center;gap:.5rem;font-size:.74rem;font-weight:800;
  letter-spacing:.18em;text-transform:uppercase;color:#0d3a66;margin-bottom:.85rem}
.eyebrow::before{content:"";width:26px;height:3px;border-radius:99px;background:linear-gradient(90deg,#0d3a66,#2f6fa8)}
.big-heading{font-family:var(--font-display);font-size:clamp(2.1rem,4.4vw,4.2rem);line-height:1.02;
  letter-spacing:.01em;margin:0;color:#0d3a66;text-shadow:0 2px 10px rgba(13,58,102,.06)}
.big-heading span{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.sg-sec-desc{font-size:.98rem;line-height:1.9;color:#5f7186;margin:1rem 0 0;max-width:640px}

/* ---------- INTRO / STATS (glassmorphism) ---------- */
.sg-intro{position:relative;padding:96px 0 110px;background:#fff}
.intro-grid{display:grid;grid-template-columns:1.1fr .9fr;gap:5rem;align-items:center}
.intro-copy{font-size:1rem;line-height:1.95;color:#5f7186;margin-top:1.25rem;max-width:720px}
.stat-strip{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem}
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

/* ---------- GURU & STAF SECTION ---------- */
.sg-catalog{position:relative;padding:96px 0 110px;background:#fff}
.sg-wrap{width:min(1380px,92%);margin:auto}
.sg-sec-head{max-width:720px}
.sg-toolbar{display:flex;flex-wrap:wrap;gap:.8rem;align-items:center;margin:2.2rem 0 2.6rem;
  background:rgba(255,255,255,.85);border:1px solid rgba(13,58,102,.14);border-radius:20px;
  padding:1rem 1.2rem;box-shadow:0 14px 36px rgba(13,58,102,.07);
  backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px)}
.sg-search{display:flex;align-items:center;gap:.6rem;flex:1;min-width:220px;padding:.55rem .95rem;
  border:1px solid rgba(13,58,102,.16);border-radius:12px;background:#f7f9fc;color:#5f7186}
.sg-search i{color:#2f6fa8}
.sg-search input{border:none;outline:none;background:transparent;flex:1;font-size:.9rem;color:#0d3a66;
  font-family:inherit;min-width:0}
.sg-search input::placeholder{color:#93a5b8}
.sg-filter-label{font-size:.72rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:#5f7186}
.sg-filters{display:flex;flex-wrap:wrap;gap:.5rem}
.sg-fchip{border:1px solid rgba(13,58,102,.2);background:#fff;color:#0d3a66;font-size:.78rem;font-weight:800;
  padding:.5rem 1rem;border-radius:999px;cursor:pointer;font-family:inherit;
  transition:all .3s ease;display:inline-flex;align-items:center;gap:.4rem}
.sg-fchip i{color:#2f6fa8}
.sg-fchip:hover{border-color:rgba(255,179,0,.5);transform:translateY(-2px)}
.sg-fchip.is-active{background:linear-gradient(135deg,#0d3a66,#2f6fa8);color:#fff;border-color:transparent;
  box-shadow:0 10px 22px rgba(13,58,102,.3)}
.sg-fchip.is-active i{color:#ffd54a}

.sg-empty{display:none;text-align:center;padding:3.5rem 1rem;color:#5f7186}
.sg-empty.show{display:block}
.sg-empty i{font-size:2.4rem;color:#c7d3e0;margin-bottom:.9rem}
.sg-empty strong{display:block;font-family:var(--font-display);font-size:1.3rem;color:#0d3a66;margin-bottom:.4rem}

.sg-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.8rem}
.sg-card.is-hidden{display:none}

/* =========================================================
   KARTU ID DIGITAL — DIGITAL IDENTITY CARD (LANDSCAPE / HORIZONTAL)
   Mengikuti struktur contoh ID Card: header atas (logo + nama sekolah),
   foto portrait di kiri (±1/3 lebar), informasi identitas di kanan,
   nomor registrasi + barcode sebagai detail kartu.
   Bahasa visual SKANEDA: navy #0d3a66, gold #ffd54a/#ffb300, putih.
   Flip 3D dipertahankan: depan = identitas, belakang = profil + motto.
   ========================================================= */
.idwrap{perspective:1600px;width:100%}
.idcard{position:relative;width:100%;aspect-ratio:4/5;transform-style:preserve-3d;
  transition:transform .75s cubic-bezier(.23,.7,.35,1);cursor:pointer;outline:none}
.idcard.flipped{transform:rotateY(180deg)}
.idface{position:absolute;inset:0;backface-visibility:hidden;-webkit-backface-visibility:hidden;
  border-radius:22px;overflow:hidden;display:flex;flex-direction:column;background:#fff;
  border:1px solid rgba(13,58,102,.12);
  box-shadow:0 18px 44px rgba(13,58,102,.12),0 2px 8px rgba(13,58,102,.06)}
.idcard:hover .idface{box-shadow:0 28px 62px rgba(13,58,102,.22),0 4px 12px rgba(13,58,102,.08);
  border-color:rgba(255,179,0,.4)}
.idfront{transform:rotateY(0deg)}
.idback{transform:rotateY(180deg)}

/* --- Kartu LANDSCAPE (rasio kartu identitas horizontal) --- */
.idcard-h{aspect-ratio:1.58/1;min-height:0}

/* Watermark SKANEDA — samar, tidak mengganggu informasi */
.idcard-h .idfront::before{content:"SKANEDA";position:absolute;right:-8px;bottom:14%;z-index:1;pointer-events:none;
  font-family:var(--font-display);font-size:clamp(1.9rem,3.2vw,2.7rem);font-weight:900;line-height:1;
  letter-spacing:.06em;color:rgba(13,58,102,.045);-webkit-text-stroke:1px rgba(13,58,102,.06);
  white-space:nowrap;user-select:none;transform:rotate(-90deg);transform-origin:right center}
.idcard-h .idfront::after{content:"";position:absolute;right:-14px;top:-14px;width:52px;height:52px;z-index:1;
  border:2px solid rgba(255,179,0,.2);transform:rotate(45deg);pointer-events:none}

/* --- Header kartu: logo + nama sekolah + chip --- */
.idh-head{position:relative;z-index:2;display:flex;align-items:center;gap:.6rem;padding:.5rem .78rem .48rem;
  background:linear-gradient(135deg,#0b3558,#0d3a66 55%,#164e80);color:#fff;overflow:hidden}
.idh-head::after{content:"";position:absolute;left:0;right:0;bottom:0;height:3px;
  background:linear-gradient(90deg,#ffd54a,#ffb300,#ff7a00)}
.idh-head::before{content:"";position:absolute;right:-18px;top:-26px;width:64px;height:64px;
  border:2px solid rgba(255,213,74,.18);transform:rotate(45deg)}
.idh-logo{
  flex:0 0 auto;
  width:32px;
  height:32px;
  min-width:32px;
  min-height:32px;
  border-radius:9px;
  display:flex;
  align-items:center;
  justify-content:center;
  overflow:hidden;
  background:linear-gradient(135deg,#ffd54a,#ffb300);
  box-shadow:0 6px 14px rgba(255,179,0,.38);
}
.idh-logo img{
  display:block;
  width:25px;
  height:25px;
  max-width:25px;
  max-height:25px;
  object-fit:contain;
  object-position:center;
  opacity:1;
  visibility:visible;
}
.idh-brand{min-width:0}
.idh-school{font-family:var(--font-display);font-size:.7rem;font-weight:900;letter-spacing:.08em;
  text-transform:uppercase;line-height:1.18;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.idh-sub{font-size:.48rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase;
  color:rgba(255,255,255,.66);margin-top:.08rem;white-space:nowrap}
.idh-chip{margin-left:auto;position:relative;z-index:2;display:inline-flex;align-items:center;gap:.3rem;
  font-size:.52rem;font-weight:900;letter-spacing:.14em;text-transform:uppercase;color:#0d3a66;
  background:linear-gradient(135deg,#ffd54a,#ffc107 55%,#ffb300);padding:.2rem .55rem;border-radius:999px;
  box-shadow:0 4px 10px rgba(255,179,0,.3);white-space:nowrap}
.idh-chip i{font-size:.56rem}

/* --- Body: foto kiri + info kanan (layout horizontal ID card) --- */
.idh-body{position:relative;z-index:2;flex:1;display:flex;gap:.85rem;padding:.62rem .78rem .66rem;min-height:0}
.idh-photo-wrap{flex:0 0 31%;max-width:122px;display:flex;flex-direction:column;align-items:center;
  justify-content:center;gap:.32rem;min-height:0}
.idh-photo{width:100%;aspect-ratio:3/4;border-radius:10px;overflow:hidden;
  border:2.5px solid #fff;background:linear-gradient(135deg,#e8f1f9,#d4e4f3);
  box-shadow:0 10px 22px rgba(13,58,102,.26),0 0 0 1px rgba(13,58,102,.12)}
.idh-photo img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .55s ease}
.idcard:hover .idh-photo img{transform:scale(1.05)}
.idh-photo::after{content:"";position:absolute;inset:0;pointer-events:none;border-radius:10px;
  box-shadow:inset 0 0 0 1px rgba(13,58,102,.14),inset 0 -18px 24px -16px rgba(13,58,102,.35)}
.idh-serial{font-size:.46rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:#5f7186;
  white-space:nowrap;max-width:100%;overflow:hidden;text-overflow:ellipsis}
.idh-barcode{display:flex;flex-direction:column;gap:2px;width:74%;opacity:.8}
.idh-barcode div{height:2.5px;background:#0d3a66;border-radius:2px}

/* --- Info kanan --- */
.idh-info{flex:1;display:flex;flex-direction:column;min-width:0;padding-top:.05rem}
.idh-cat{display:inline-flex;align-items:center;gap:.3rem;align-self:flex-start;
  font-size:.48rem;font-weight:900;letter-spacing:.16em;text-transform:uppercase;color:#8a5a00;
  background:rgba(255,179,0,.14);border:1px solid rgba(255,179,0,.32);padding:.16rem .5rem;border-radius:6px;
  max-width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.idh-cat i{color:#ffb300;font-size:.5rem}
.idh-name{font-family:var(--font-display);font-size:clamp(.84rem,1.05vw,1rem);font-weight:800;color:#0d3a66;
  line-height:1.24;margin:.4rem 0 .48rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;
  overflow:hidden;min-height:0}
.idh-rows{display:flex;flex-direction:column;gap:.34rem;margin-bottom:auto}
.idh-row{display:flex;align-items:baseline;gap:.5rem;min-width:0}
.idh-lbl{flex:0 0 46px;font-size:.46rem;font-weight:900;letter-spacing:.12em;color:#8aa0b4;text-transform:uppercase}
.idh-val{font-size:.63rem;font-weight:800;color:#0d3a66;line-height:1.35;min-width:0;
  display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}
.idh-meta{display:inline-flex;align-items:center;gap:.32rem;margin-top:.44rem;
  font-size:.5rem;font-weight:800;color:#2f6fa8;letter-spacing:.06em;text-transform:uppercase}
.idh-meta i{color:#ffb300}
.idh-foot{display:flex;align-items:center;justify-content:space-between;margin-top:.42rem;padding-top:.36rem;
  border-top:1px dashed rgba(13,58,102,.18);gap:.4rem}
.idh-id{font-size:.48rem;font-weight:900;letter-spacing:.14em;color:#5f7186;text-transform:uppercase;
  white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.idh-flip{display:inline-flex;align-items:center;gap:.28rem;font-size:.48rem;font-weight:900;
  letter-spacing:.1em;text-transform:uppercase;color:#ff8a00;white-space:nowrap}
.idh-flip i{font-size:.52rem}

/* --- Hint flip --- */
.id-hint{position:absolute;right:.55rem;top:.55rem;z-index:5;width:24px;height:24px;border-radius:50%;
  background:rgba(255,255,255,.94);color:#0d3a66;font-size:.64rem;display:flex;align-items:center;
  justify-content:center;box-shadow:0 4px 10px rgba(4,14,28,.24);transition:transform .4s ease}
.idcard:hover .id-hint{transform:rotate(180deg)}

/* --- Belakang: profil & motto premium navy/gold --- */
.idback{background:linear-gradient(160deg,#0b3558,#0d3a66 58%,#123f6e);color:#fff}
.idback::after{content:"";position:absolute;right:-20px;top:-20px;width:90px;height:90px;
  border:2px solid rgba(255,213,74,.18);transform:rotate(45deg);pointer-events:none}
.idback-head{position:relative;z-index:2;display:flex;align-items:center;justify-content:space-between;padding:.62rem .9rem .5rem;
  border-bottom:1px solid rgba(255,255,255,.12)}
.idback-head .id-school{font-size:.88rem;font-weight:800;letter-spacing:.05em;text-transform:uppercase;line-height:1.2;font-family:var(--font-display)}
.idback-head .id-school-sub{font-size:.62rem;letter-spacing:.14em;text-transform:uppercase;color:rgba(255,255,255,.72);margin-top:.14rem;font-weight:700}
.idback-body{flex:1;overflow:auto;padding:.62rem .85rem .7rem;display:flex;flex-direction:column}
.idback-label{display:inline-flex;align-items:center;gap:.35rem;font-size:.52rem;font-weight:800;
  letter-spacing:.2em;text-transform:uppercase;color:#ffd54a;margin-bottom:.4rem}
.idback-label::before{content:"";width:16px;height:2px;border-radius:99px;
  background:linear-gradient(90deg,#ffd54a,#ffb300)}
.idback-bio{font-size:.78rem;line-height:1.55;color:rgba(235,245,253,.9);margin:0 0 .6rem;
  display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
.idback-quote{position:relative;margin-top:auto;padding:.55rem .7rem;border-radius:10px;
  background:rgba(255,255,255,.07);border:1px solid rgba(255,213,74,.22)}
.idback-quote::before{content:"\201C";position:absolute;top:-.3rem;left:.5rem;font-family:Georgia,serif;
  font-size:1.5rem;color:#ffd54a;line-height:1}
.idback-quote p{font-size:.72rem;line-height:1.5;color:#f3e9d6;font-style:italic;margin:0}
.idback-quote p::after{content:"\201D";color:#ffd54a;font-style:normal}
.idback-foot{position:relative;z-index:2;display:flex;align-items:center;justify-content:space-between;padding:.45rem .85rem .6rem;
  border-top:1px solid rgba(255,255,255,.1)}
.idback-foot span{font-size:.58rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;
  color:rgba(255,255,255,.62)}
.idback-foot i{color:#ffd54a;font-size:.56rem}

/* --- Responsive kartu ID --- */
@media(max-width:1200px){
  .idcard-h{aspect-ratio:1.5/1}
}
@media(max-width:950px){
  .idcard-h{aspect-ratio:1.62/1}
}
@media(max-width:700px){
  .idcard-h{aspect-ratio:1.55/1}
  .idh-body{gap:.7rem;padding:.55rem .65rem .6rem}
  .idh-head{padding:.45rem .65rem .44rem;gap:.5rem}
  .idh-logo{width:28px;height:28px;font-size:.85rem}
  .idh-school{font-size:.62rem}
  .idh-sub{font-size:.44rem;letter-spacing:.16em}
  .idh-chip{font-size:.48rem;padding:.18rem .48rem}
  .idh-photo-wrap{max-width:104px}
  .idh-name{font-size:.82rem;margin:.34rem 0 .4rem}
  .idh-lbl{flex-basis:40px;font-size:.44rem}
  .idh-val{font-size:.58rem}
  .idh-cat{font-size:.44rem;letter-spacing:.12em}
  .idh-meta{font-size:.46rem;margin-top:.36rem}
  .idh-foot{margin-top:.34rem;padding-top:.3rem}
  .idh-id{font-size:.44rem;letter-spacing:.1em}
  .idh-flip{font-size:.44rem}
  .idh-barcode{width:70%}
  .idh-serial{font-size:.42rem}
}
/* =========================================================
   VIRTUAL TOUR 360 — 100% mengikuti Sejarah Sekolah
   ========================================================= */
.vt-section{
  position:relative;overflow:hidden;isolation:isolate;padding:120px 0 130px;
  background:linear-gradient(180deg,#eef5fb 0%,#ffffff 48%,#f3f7fb 100%);
}
.vt-section::before{content:"";position:absolute;inset:0;pointer-events:none;opacity:.42;
  background-image:radial-gradient(circle,rgba(13,58,102,.18) 1.5px,transparent 2px);
  background-size:22px 22px;mask-image:linear-gradient(90deg,transparent 0%,#000 15%,#000 85%,transparent 100%)}
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

/* ---------- CTA PENUTUP ---------- */
.sg-cta{position:relative;margin-top:4.6rem;padding:90px 0 100px;overflow:hidden;text-align:center;isolation:isolate;
  border-radius:28px;background:linear-gradient(135deg,#0b3558,#0d3a66 45%,#0d3a66);color:#fff}
.sg-cta::after{content:"SKANEDA";position:absolute;left:50%;bottom:-34px;transform:translateX(-50%);
  font-family:var(--font-display);font-size:clamp(3.4rem,11vw,9rem);font-weight:900;line-height:1;
  letter-spacing:.05em;color:rgba(255,255,255,.045);-webkit-text-stroke:1px rgba(255,255,255,.06);
  pointer-events:none;white-space:nowrap;user-select:none}
.sg-cta-inner{position:relative;z-index:2;width:min(800px,92%);margin:auto}
.sg-cta h3{font-family:var(--font-display);font-size:clamp(1.9rem,4vw,3.2rem);line-height:1.08;margin:0 0 1rem}
.sg-cta h3 span{background:linear-gradient(135deg,#ffd54a,#ffb300 50%,#ff7a00);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.sg-cta p{color:rgba(235,245,253,.8);line-height:1.85;max-width:620px;margin:0 auto 2rem}
.sg-cta-btn{display:inline-flex;align-items:center;gap:.6rem;padding:.95rem 2rem;border-radius:999px;
  background:linear-gradient(135deg,#ffd54a,#ff8a00);color:#0d3a66;font-size:.92rem;font-weight:900;
  text-decoration:none;box-shadow:0 16px 36px rgba(255,138,0,.4);
  transition:transform .3s ease,box-shadow .3s ease}
.sg-cta-btn:hover{transform:translateY(-4px);box-shadow:0 22px 46px rgba(255,138,0,.5)}
.sg-cta-btn i{transition:transform .3s ease}
.sg-cta-btn:hover i{transform:translateX(5px)}

/* ---------- CTA PENUTUP: DIPERKECIL + JARAK FOOTER ---------- */
.sg-cta{
  width:min(1100px,92%) !important;
  margin:4.6rem auto 7rem !important;
  padding:62px 34px 70px !important;
  box-sizing:border-box !important;
}
.sg-cta-inner{width:min(680px,90%) !important}
.sg-cta h3{
  font-size:clamp(1.65rem,3.2vw,2.65rem) !important;
  line-height:1.1 !important;
  margin-bottom:.9rem !important;
}
.sg-cta p{
  max-width:560px !important;
  font-size:.9rem !important;
  line-height:1.7 !important;
  margin-bottom:1.55rem !important;
}
.sg-cta-btn{
  padding:.82rem 1.7rem !important;
  font-size:.86rem !important;
}
.sg-cta::after{font-size:clamp(3rem,9vw,7rem) !important;bottom:-28px !important}
@media(max-width:700px){
  .sg-cta{
    margin-top:3rem !important;
    margin-bottom:5.5rem !important;
    padding:54px 0 62px !important;
  }
  .sg-cta h3{font-size:clamp(1.5rem,7.5vw,2.15rem) !important}
  .sg-cta p{font-size:.82rem !important;line-height:1.65 !important}
}

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

.sg-hero .home-orn .ho-chevron{left:-150px;bottom:-60px;border-color:rgba(255,255,255,.10)}
.sg-hero .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.sg-hero .home-orn .ho-line{right:-80px;top:22%;opacity:.22}
.sg-hero .home-orn .ho-dots{right:6%;bottom:14%;opacity:.3}
.sg-hero .home-orn .ho-ring{left:44%;bottom:-90px;border-color:rgba(255,255,255,.12)}
.sg-hero .home-orn .ho-gold{right:16%;top:20%}
.sg-hero .home-orn .ho-square{left:12%;top:22%}

.sg-catalog .home-orn .ho-chevron{right:-145px;top:45px}
.sg-catalog .home-orn .ho-line{left:-80px;top:170px}
.sg-catalog .home-orn .ho-dots{left:3%;bottom:100px}
.sg-catalog .home-orn .ho-ring{right:8%;bottom:90px}
.sg-catalog .home-orn .ho-gold{right:16%;top:22%}
.sg-catalog .home-orn .ho-square{left:11%;top:15%}
.sg-catalog .home-orn .ho-corner{right:3%;bottom:8%;transform:rotate(180deg)}

.sg-cta .home-orn .ho-chevron{left:-120px;bottom:-80px;border-color:rgba(255,255,255,.10)}
.sg-cta .home-orn .ho-chevron::after{border-color:rgba(255,213,74,.08)}
.sg-cta .home-orn .ho-dots{left:8%;top:30%;opacity:.22}
.sg-cta .home-orn .ho-ring{right:-70px;top:20%;border-color:rgba(255,255,255,.10)}
.sg-cta .home-orn .ho-gold{left:20%;bottom:26%}

.sg-hero>*:not(.home-orn),
.sg-catalog>*:not(.home-orn),
.sg-cta>*:not(.home-orn){position:relative;z-index:2}

/* ---------- ORNAMEN HALAMAN (fixed diamonds) ---------- */
.sg-page::before{content:"";position:fixed;right:-110px;top:18%;width:230px;height:230px;
  border:2px solid rgba(13,58,102,.14);transform:rotate(45deg);z-index:0;pointer-events:none}
.sg-page::after{content:"";position:fixed;left:-95px;bottom:10%;width:190px;height:190px;
  border:2px solid rgba(47,111,168,.14);border-radius:28px;transform:rotate(25deg);z-index:0;pointer-events:none}

/* ---------- HOVER LANGUAGE (keluarga Sejarah) ---------- */
.sg-page .eyebrow,.sg-page .sg-card,.sg-page .hero-photo,.sg-page .big-heading,
.sg-page .sg-title,.sg-page .sg-fchip{transition:transform .35s ease,box-shadow .35s ease,
  filter .35s ease,border-color .35s ease,background .35s ease}
.sg-page .sg-kicker:hover{transform:translateX(7px);filter:drop-shadow(0 5px 12px rgba(255,213,74,.2))}
.sg-page .eyebrow:hover{transform:translateX(6px)}
.sg-page .hero-photo:hover{transform:translateY(-42px) rotate(0deg) scale(1.015);
  box-shadow:0 45px 95px rgba(13,58,102,.35),0 18px 35px rgba(0,0,0,.22)}
.sg-page .hero-photo:hover img{transform:scale(1.07)}
.sg-page .big-heading:hover{transform:translateX(4px)}

/* ---------- SCROLL REVEAL (keluarga Sejarah) ---------- */
[data-reveal]{opacity:0;transform:translateY(36px);
  transition:opacity .7s ease,transform .7s var(--ease, ease)}
[data-reveal="left"]{transform:translateX(-46px)}
[data-reveal="right"]{transform:translateX(46px)}
[data-reveal].revealed{opacity:1;transform:none}
[data-reveal]{transition-delay:calc(var(--d,0)*90ms)}

/* ---------- RESPONSIVE ---------- */
@media(max-width:1200px){
  .sg-grid{grid-template-columns:repeat(3,1fr)}
}
@media(max-width:950px){
  .sg-hero-inner{grid-template-columns:1fr;gap:2rem}
  .hero-photo{height:360px;transform:translateY(-18px) rotate(1deg)}
  .sg-grid{grid-template-columns:repeat(2,1fr)}
  .intro-grid{grid-template-columns:1fr;gap:3rem}
}
@media(max-width:700px){
  .sg-hero{min-height:0;align-items:flex-start}
  .sg-hero-inner{padding:clamp(3rem,8vh,4.5rem) 5% 3.6rem;width:90%}
  .sg-hero-inner::after{right:5%;top:4%;width:48px;height:48px}
  .sg-hero::after{font-size:clamp(3.6rem,22vw,6rem);opacity:.6;right:-4%}
  .sg-title{font-size:clamp(2.4rem,11vw,3.6rem);margin-top:0}
  .hero-photo{height:300px}
  .history-vt-cta{width:min(100%,340px)}
  .sg-grid{grid-template-columns:1fr;max-width:340px;margin:0 auto}
  .sg-section,.sg-intro,.sg-catalog{padding:85px 0 90px}
  .sg-cta{width:92%;margin:3rem auto 5.5rem !important;padding:54px 22px 62px !important;box-sizing:border-box !important}
  .sg-toolbar{padding:.9rem}
  .sg-wrap{width:92%}
  .home-orn .ho-chevron{width:220px;height:220px}
  .home-orn .ho-dots{width:80px;height:80px;background-size:14px 14px}
  .home-orn .ho-ring{width:110px;height:110px}
  .home-orn .ho-line{width:190px}
  .home-orn .ho-square{width:42px;height:42px}
  .home-orn .ho-corner{width:70px;height:70px}
  .sg-hero .home-orn .ho-chevron{left:-120px;bottom:-40px}
  [data-reveal]{opacity:1;transform:none}
}

/* ---------- HERO STAFF & GURU: FINAL COLOR / LAYER FIX ---------- */
.sg-title .sg-gold{
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%) !important;
  -webkit-background-clip:text !important;
  background-clip:text !important;
  -webkit-text-fill-color:transparent !important;
  color:#ffc107 !important;
  text-shadow:0 4px 24px rgba(255,174,0,.18) !important;
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

</style>


<style id="staff-guru-virtual-tour-hero-final">
  .history-vt-cta{width:max-content;max-width:100%}
  .history-vt-cta .history-vt-icon{flex:0 0 46px}
  @media(max-width:700px){
    .history-vt-cta{width:min(100%,340px)}
    .history-vt-cta .history-vt-arrow{margin-left:auto}
  }
</style>

@endpush

@section('content')
@php
    /* =====================================================
       DATA CONTOH GURU & STAF
       Ganti/blok hapus bagian ini jika data berasal dari
       controller ($guruList, $staffList) atau database.
       Foto: pas foto 3x4 di folder public/images/guru-staf/
       ===================================================== */
    $guruList = [
        ['nama' => 'Drs. H. Ahmad Fauzi, M.Pd.', 'jabatan' => 'Kepala Sekolah', 'mapel' => 'Kepemimpinan & Manajemen Sekolah', 'foto' => 'images/guru-staf/guru-1.jpg', 'profil' => 'Memimpin SMK Negeri 2 Mojokerto sejak 2021 dengan visi sekolah vokasi unggulan. Berpengalaman lebih dari 20 tahun di dunia pendidikan menengah kejuruan.', 'motto' => 'Pemimpin yang baik adalah yang melayani, bukan dilayani.'],
        ['nama' => 'Siti Nurhaliza, S.Pd., M.Pd.', 'jabatan' => 'Guru Produktif', 'mapel' => 'Rekayasa Perangkat Lunak', 'foto' => 'images/guru-staf/guru-2.jpg', 'profil' => 'Pengajar pemrograman dan pengembangan aplikasi. Sertifikasi kompetensi nasional bidang software development. Pembina ekstrakurikuler coding club.', 'motto' => 'Setiap baris kode adalah langkah kecil menuju mimpi besar siswa.'],
        ['nama' => 'Budi Santoso, S.Kom.', 'jabatan' => 'Guru Produktif', 'mapel' => 'Teknik Komputer & Jaringan', 'foto' => 'images/guru-staf/guru-3.jpg', 'profil' => 'Spesialis jaringan komputer dan keamanan siber. Pengalaman industri 8 tahun sebelum mengabdi menjadi guru. Aktif membina tim lomba jaringan tingkat provinsi.', 'motto' => 'Jaringan yang kuat dimulai dari koneksi antarmanusia, bukan hanya kabel.'],
        ['nama' => 'Dra. Rina Kartika', 'jabatan' => 'Guru Normatif', 'mapel' => 'Bahasa Indonesia', 'foto' => 'images/guru-staf/guru-4.jpg', 'profil' => 'Pengajar Bahasa Indonesia selama 15 tahun. Pecinta literasi dan pembina jurnalistik sekolah. Karyanya sering menghiasi majalah dinding sekolah.', 'motto' => 'Bahasa adalah jendela dunia — ajari siswa membukanya lebar-lebar.'],
        ['nama' => 'Muhammad Iqbal, S.Pd.', 'jabatan' => 'Guru Adaptif', 'mapel' => 'Matematika', 'foto' => 'images/guru-staf/guru-5.jpg', 'profil' => 'Pengajar matematika dengan pendekatan kontekstual dan menyenangkan. Alumni UNESA, aktif mengikuti pelatihan pembelajaran berdiferensiasi.', 'motto' => 'Matematika bukan tentang menghafal rumus, tapi tentang cara berpikir.'],
        ['nama' => 'Nur Aini, S.Pd.', 'jabatan' => 'Guru BK', 'mapel' => 'Bimbingan Konseling', 'foto' => 'images/guru-staf/guru-6.jpg', 'profil' => 'Konselor sekolah yang hangat dan terbuka. Mendampingi perkembangan karier dan pribadi siswa, serta menjadi sahabat bagi siswa yang membutuhkan.', 'motto' => 'Setiap anak punya cerita — dengarkan sebelum menilai.'],
    ];

    $staffList = [
        ['nama' => 'Dewi Lestari, A.Md.', 'jabatan' => 'Staff Tata Usaha', 'unit' => 'Administrasi Umum & Kesiswaan', 'foto' => 'images/guru-staf/staff-1.jpg', 'profil' => 'Mengelola administrasi kesiswaan dan kepegawaian. Ramah dan teliti, menjadi garda depan layanan administrasi sekolah.', 'motto' => 'Layanan yang tulus adalah senyum yang tiba sebelum kata.'],
        ['nama' => 'Fitria Rahma, S.E.', 'jabatan' => 'Staff Keuangan', 'unit' => 'Bendahara Sekolah', 'foto' => 'images/guru-staf/staff-2.jpg', 'profil' => 'Mengelola keuangan dan pelaporan sekolah secara transparan dan akuntabel. Bersertifikat pengelola keuangan daerah.', 'motto' => 'Kejujuran adalah mata uang yang tidak pernah terdepresiasi.'],
        ['nama' => 'Andi Prasetyo', 'jabatan' => 'Staff Perpustakaan', 'unit' => 'Perpustakaan SKANEDA', 'foto' => 'images/guru-staf/staff-3.jpg', 'profil' => 'Pengelola perpustakaan yang penuh semangat. Mendigitalisasi koleksi buku dan menggerakkan gerakan literasi sekolah.', 'motto' => 'Perpustakaan adalah ruang di mana mimpi-mimpi mulai dijilid.'],
        ['nama' => 'Bagus Wicaksono', 'jabatan' => 'Staff Sarpras', 'unit' => 'Sarana & Prasarana', 'foto' => 'images/guru-staf/staff-4.jpg', 'profil' => 'Mengawal kebersihan, keamanan, dan kesiapan fasilitas sekolah. Berpengalaman 12 tahun merawat lingkungan sekolah.', 'motto' => 'Sekolah yang nyaman adalah buah dari kerja yang tak terlihat.'],
        ['nama' => 'Yuli Astutik', 'jabatan' => 'Staff Laboran', 'unit' => 'Laboratorium Komputer', 'foto' => 'images/guru-staf/staff-6.jpg', 'profil' => 'Menjaga kesiapan laboratorium komputer dan jaringan sekolah. Terampil dalam perawatan perangkat keras dan instalasi sistem.', 'motto' => 'Perangkat boleh rusak, tetapi semangat melayani tidak.'],
        ['nama' => 'Slamet Riyadi', 'jabatan' => 'Staff Sarpras', 'unit' => 'Sarana & Prasarana', 'foto' => 'images/guru-staf/staff-5.jpg', 'profil' => 'Mengawal kebersihan, keamanan, dan kesiapan fasilitas sekolah. Berpengalaman 12 tahun merawat lingkungan sekolah.', 'motto' => 'Sekolah yang nyaman adalah buah dari kerja yang tak terlihat.'],
    ];
@endphp
<div class="sg-page">

  <!-- HERO — visual 100% mengikuti Hero halaman Sejarah -->
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
          <span class="sejarah-white">STAFF &amp;</span>
          <span class="skaneda-gold">GURU</span>
        </h3>
        <a class="history-vt-cta" href="#virtual-tour" aria-label="Lihat Virtual Tour 360 derajat SMK Negeri 2 Mojokerto">
          <span class="history-vt-icon"><i class="fas fa-street-view"></i></span>
          <span><strong>Lihat Virtual Tour 360°</strong><small>Jelajahi SMK Negeri 2 Mojokerto</small></span>
          <i class="fas fa-arrow-right history-vt-arrow" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- INTRO / STATS -->
  <section class="sg-intro">
    <div class="sg-wide">
      <div class="intro-grid">
        <div data-reveal>
          <div class="eyebrow">Siapa Mereka</div>
          <h2 class="big-heading">PILAR PENDIDIKAN <span>YANG TAK</span></h2>
          <p class="intro-copy">Guru dan staf adalah ujung tombak layanan pendidikan di SMK Negeri 2 Mojokerto. Mereka tidak hanya mengajar di kelas — tetapi juga membimbing, melayani, dan menginspirasi peserta didik setiap hari. Ketuk kartu di bawah untuk mengenal lebih dekat profil dan semangat mereka.</p>
        </div>
        <div class="stat-strip" data-reveal="right">
          <div class="stat-box">
            <div class="stat-num">{{ $jumlahGuru ?? 60 }}+</div>
            <div class="stat-label"><i class="fas fa-chalkboard-user"></i> Guru Profesional</div>
          </div>
          <div class="stat-box">
            <div class="stat-num">{{ $jumlahStaf ?? 25 }}+</div>
            <div class="stat-label"><i class="fas fa-users-gear"></i> Tenaga Kependidikan</div>
          </div>
          <div class="stat-box">
            <div class="stat-num">{{ $jumlahBersertifikat ?? 45 }}+</div>
            <div class="stat-label"><i class="fas fa-certificate"></i> Guru Bersertifikat</div>
          </div>
          <div class="stat-box">
            <div class="stat-num">{{ $jumlahKompetensi ?? 9 }}</div>
            <div class="stat-label"><i class="fas fa-industry"></i> Kompetensi Keahlian</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- KATALOG GURU & STAF -->
  <section class="sg-catalog">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="sg-wrap">
      <div class="sg-sec-head" data-reveal>
        <div class="eyebrow">Kartu Identitas</div>
        <h2 class="big-heading">KETUK KARTU, <span>KENALI PRIBADINYA</span></h2>
        <p class="sg-sec-desc">Setiap kartu dapat dibalik — bagian depan menampilkan identitas, sedangkan bagian belakang berisi profil singkat dan motto dari masing-masing guru dan staf.</p>
      </div>

      <!-- TOOLBAR SEARCH & FILTER -->
      <div class="sg-toolbar" data-reveal>
        <div class="sg-search">
          <i class="fas fa-magnifying-glass"></i>
          <input type="text" id="sgSearchInput" placeholder="Cari nama, jabatan, atau mata pelajaran..." aria-label="Cari guru atau staf">
        </div>
        <span class="sg-filter-label">Kategori</span>
        <div class="sg-filters" id="sgFilters">
          <button class="sg-fchip is-active" data-filter="*"><i class="fas fa-layer-group"></i> Semua</button>
          <button class="sg-fchip" data-filter="guru"><i class="fas fa-chalkboard-user"></i> Guru</button>
          <button class="sg-fchip" data-filter="staf"><i class="fas fa-users-gear"></i> Staff</button>
        </div>
      </div>

      <div class="sg-empty" id="sgEmpty">
        <i class="fas fa-magnifying-glass"></i>
        <strong>Tidak ditemukan</strong>
        Coba kata kunci atau kategori lain.
      </div>

      <div class="sg-grid" id="sgGrid">

        {{-- ============ GURU ============ --}}
        @foreach ($guruList ?? [] as $g)
        <article class="sg-card" tabindex="0" data-name="{{ $g['nama'] }}" data-role="{{ $g['jabatan'] }} {{ $g['mapel'] }}" data-filter="guru">
          <div class="idwrap">
            <div class="idcard idcard-h" role="button" aria-label="Balik kartu {{ $g['nama'] }}">
              <span class="id-hint" aria-hidden="true"><i class="fas fa-rotate"></i></span>

              {{-- DEPAN --}}
              <div class="idface idfront">
                <div class="idh-head">
                  <span class="idh-logo" aria-hidden="true">
  <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto">
</span>
                  <div class="idh-brand">
                    <div class="idh-school">SMK Negeri 2 Mojokerto</div>
                    <div class="idh-sub">Sekolah Vokasi Unggulan</div>
                  </div>
                  <span class="idh-chip"><i class="fas fa-chalkboard-user"></i> Guru</span>
                </div>
                <div class="idh-body">
                  <div class="idh-photo-wrap">
                    <div class="idh-photo">
                      <img src="{{ asset($g['foto']) }}" alt="Foto {{ $g['nama'] }}" loading="lazy">
                    </div>
                    <span class="idh-serial" aria-hidden="true">No. {{ str_pad($loop->index + 1, 3, '0', STR_PAD_LEFT) }}</span>
                    <div class="idh-barcode" aria-hidden="true">
                      <div style="width:100%"></div><div style="width:82%"></div><div style="width:94%"></div>
                      <div style="width:70%"></div><div style="width:88%"></div><div style="width:100%"></div>
                    </div>
                  </div>
                  <div class="idh-info">
                    <span class="idh-cat"><i class="fas fa-chalkboard-user"></i> Tenaga Pendidik</span>
                    <h3 class="idh-name">{{ $g['nama'] }}</h3>
                    <div class="idh-rows">
                      <div class="idh-row"><span class="idh-lbl">Jabatan</span><span class="idh-val">{{ $g['jabatan'] }}</span></div>
                      <div class="idh-row"><span class="idh-lbl">Bidang</span><span class="idh-val">{{ $g['mapel'] }}</span></div>
                    </div>
                    <div class="idh-meta"><i class="fas fa-certificate"></i> Pendidik Profesional</div>
                    <div class="idh-foot">
                      <span class="idh-id">SKN-{{ str_pad($loop->index + 1, 3, '0', STR_PAD_LEFT) }}-G</span>
                      <span class="idh-flip"><i class="fas fa-rotate"></i> Balik</span>
                    </div>
                  </div>
                </div>
              </div>

              {{-- BELAKANG --}}
              <div class="idface idback">
                <div class="idback-head">
                  <div>
                    <div class="id-school">SMK Negeri 2 Mojokerto</div>
                    <div class="id-school-sub">Sekolah Vokasi Unggulan</div>
                  </div>
                  <i class="fas fa-graduation-cap" style="color:#ffd54a;font-size:1.05rem"></i>
                </div>
                <div class="idback-body">
                  <div class="idback-label">Profil Singkat</div>
                  <p class="idback-bio">{{ $g['profil'] }}</p>
                  <div class="idback-quote">
                    <p>{{ $g['motto'] }}</p>
                  </div>
                </div>
                <div class="idback-foot">
                  <span><i class="fas fa-rotate"></i> Balik Kartu</span>
                  <span>SKANEDA</span>
                </div>
              </div>
            </div>
          </div>
        </article>
        @endforeach

        {{-- ============ STAFF ============ --}}
        @foreach ($staffList ?? [] as $s)
        <article class="sg-card" tabindex="0" data-name="{{ $s['nama'] }}" data-role="{{ $s['jabatan'] }} {{ $s['unit'] }}" data-filter="staf">
          <div class="idwrap">
            <div class="idcard idcard-h" role="button" aria-label="Balik kartu {{ $s['nama'] }}">
              <span class="id-hint" aria-hidden="true"><i class="fas fa-rotate"></i></span>

              {{-- DEPAN --}}
              <div class="idface idfront">
                <div class="idh-head">
                  <span class="idh-logo" aria-hidden="true">
                    <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto">
                  </span>
                  <div class="idh-brand">
                    <div class="idh-school">SMK Negeri 2 Mojokerto</div>
                    <div class="idh-sub">Sekolah Vokasi Unggulan</div>
                  </div>
                  <span class="idh-chip"><i class="fas fa-users-gear"></i> Staff</span>
                </div>
                <div class="idh-body">
                  <div class="idh-photo-wrap">
                    <div class="idh-photo">
                      <img src="{{ asset($s['foto']) }}" alt="Foto {{ $s['nama'] }}" loading="lazy">
                    </div>
                    <span class="idh-serial" aria-hidden="true">No. {{ str_pad($loop->index + 1, 3, '0', STR_PAD_LEFT) }}</span>
                    <div class="idh-barcode" aria-hidden="true">
                      <div style="width:100%"></div><div style="width:82%"></div><div style="width:94%"></div>
                      <div style="width:70%"></div><div style="width:88%"></div><div style="width:100%"></div>
                    </div>
                  </div>
                  <div class="idh-info">
                    <span class="idh-cat"><i class="fas fa-users-gear"></i> Tenaga Kependidikan</span>
                    <h3 class="idh-name">{{ $s['nama'] }}</h3>
                    <div class="idh-rows">
                      <div class="idh-row"><span class="idh-lbl">Jabatan</span><span class="idh-val">{{ $s['jabatan'] }}</span></div>
                      <div class="idh-row"><span class="idh-lbl">Unit</span><span class="idh-val">{{ $s['unit'] }}</span></div>
                    </div>
                    <div class="idh-meta"><i class="fas fa-certificate"></i> Tenaga Kependidikan</div>
                    <div class="idh-foot">
                      <span class="idh-id">SKN-{{ str_pad($loop->index + 1, 3, '0', STR_PAD_LEFT) }}-S</span>
                      <span class="idh-flip"><i class="fas fa-rotate"></i> Balik</span>
                    </div>
                  </div>
                </div>
              </div>

              {{-- BELAKANG --}}
              <div class="idface idback">
                <div class="idback-head">
                  <div>
                    <div class="id-school">SMK Negeri 2 Mojokerto</div>
                    <div class="id-school-sub">Sekolah Vokasi Unggulan</div>
                  </div>
                  <i class="fas fa-building-columns" style="color:#ffd54a;font-size:1.05rem"></i>
                </div>
                <div class="idback-body">
                  <div class="idback-label">Profil Singkat</div>
                  <p class="idback-bio">{{ $s['profil'] }}</p>
                  <div class="idback-quote">
                    <p>{{ $s['motto'] }}</p>
                  </div>
                </div>
                <div class="idback-foot">
                  <span><i class="fas fa-rotate"></i> Balik Kartu</span>
                  <span>SKANEDA</span>
                </div>
              </div>
            </div>
          </div>
        </article>
        @endforeach

      </div>
    </div>
  </section>

  <!-- VIRTUAL TOUR 360° — JELAJAHI, SAMA DENGAN HALAMAN SEJARAH -->
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

  <!-- CTA PENUTUP -->
  <div class="sg-cta" data-reveal>
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="sg-cta-inner">
      <h3>Ingin bergabung menjadi bagian <span>keluarga besar SKANEDA?</span></h3>
      <p>Kami selalu terbuka bagi pendidik dan tenaga kependidikan yang memiliki semangat mengabdi untuk kemajuan pendidikan vokasi.</p>
      <a href="{{ route('kontak') }}" class="sg-cta-btn">
        Hubungi Sekolah <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
  (function () {
    /* ---- Flip Kartu (klik / Enter / ketuk) ---- */
    var cards = document.querySelectorAll('.idcard');
    cards.forEach(function (card) {
      card.addEventListener('click', function (e) {
        if (e.target.closest('a')) return;
        card.classList.toggle('flipped');
      });
      card.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); card.classList.toggle('flipped'); }
      });
    });

    /* ---- Search & Filter Guru/Staf ---- */
    var searchInput = document.getElementById('sgSearchInput');
    var chips = document.querySelectorAll('.sg-fchip');
    var gridCards = document.querySelectorAll('.sg-card');
    var emptyBox = document.getElementById('sgEmpty');

    function applyFilter() {
      var q = (searchInput.value || '').toLowerCase().trim();
      var activeFilter = '*';
      chips.forEach(function (c) { if (c.classList.contains('is-active')) activeFilter = c.getAttribute('data-filter'); });
      var visibleCount = 0;
      gridCards.forEach(function (card) {
        var text = (card.getAttribute('data-name') + ' ' + card.getAttribute('data-role')).toLowerCase();
        var matchFilter = (activeFilter === '*') || (card.getAttribute('data-filter') === activeFilter);
        var matchQuery = !q || text.indexOf(q) !== -1;
        if (matchFilter && matchQuery) {
          card.classList.remove('is-hidden');
          visibleCount++;
        } else {
          card.classList.add('is-hidden');
        }
      });
      emptyBox.classList.toggle('show', visibleCount === 0);
    }
    searchInput.addEventListener('input', applyFilter);
    chips.forEach(function (chip) {
      chip.addEventListener('click', function () {
        chips.forEach(function (c) { c.classList.remove('is-active'); });
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
