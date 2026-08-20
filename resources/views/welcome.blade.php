{{-- ============================================================
     SMK NEGERI 2 MOJOKERTO — BERANDA (LAYOUT-AWARE VERSION)
     ============================================================
     File ini MEMAKAI layout layouts.app (app.blade.php), sehingga:
       • head + CSS global  → partials.header (di layout)
       • announce bar + navbar full-width → partials.header
       • hero section      → partials.header (di layout)
       • footer, SIBOT, a11y, back-to-top, JS global → partials.footer
     Bagian yang DIISI file ini (via @section):
       • title    → judul halaman
       • content  → Profil (flipbook), Sambutan (kepsek window),
                    Jurusan (carousel), Roadmap, Kontak + CSS-nya
       • scripts  → JS konten (reveal, journey map, counter, flipbook,
                    kepsek window, carousel jurusan)
     ------------------------------------------------------------
     CARA PAKAI:
       1. app.blade.php    → resources/views/layouts/app.blade.php
       2. header.blade.php → resources/views/partials/header.blade.php
       3. footer.blade.php → resources/views/partials/footer.blade.php
       4. file ini         → resources/views/welcome.blade.php
     ============================================================ --}}
@extends('layouts.app')

@section('title', 'SMK Negeri 2 Mojokerto — Beranda')

@section('content')
<style>
  /* ============================================================
     CSS KHUSUS KONTEN BERANDA
     (dipertahankan dari welcome.blade.php v4 — hanya bagian konten)
     ============================================================ */
    /* ---------- SECTION COMMON ---------- */
    .section-label{display:inline-flex;align-items:center;gap:.5rem;font-size:.78rem;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:var(--teal);margin-bottom:.9rem}
    .section-label::before{content:"";width:26px;height:3px;border-radius:99px;background:linear-gradient(90deg,var(--teal),var(--mint))}
    .section-title{font-family:var(--font-display);font-size:clamp(1.50rem,2.99vw,2.20rem);font-weight:800;font-style:normal;text-transform:none;letter-spacing:.015em;color:var(--ink);line-height:1.2;margin-bottom:.8rem;text-shadow:0 2px 10px rgba(13,58,102,.06)}
    .section-title .accent{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
    .section-title .gold{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}

    .section-desc{color:var(--text-muted);max-width:640px;font-size:.96rem}
    .section-header.center{text-align:center}
    .section-header.center .section-desc{margin:0 auto}
    .section-header.center .section-label::before{display:none}
    @media(max-width:640px){
      .section-title,.ft-title{font-size:clamp(1.65rem,7vw,2.2rem);line-height:1.12}
    }

    /* ---------- SCROLL REVEAL ----------
       Varian halus per jenis elemen (easing premium, hanya opacity+transform):
       default (section umum)   : translateY(35px)
       [data-reveal="title"]    : judul   translateY(25px)
       [data-reveal="text"]     : paragraf translateY(18px)
       [data-reveal="card"]     : kartu   translateY(30px) scale(.97)
       [data-reveal="img"]      : gambar  scale(.96)
       [data-reveal="left"|"right"] : geser samping
       Semua dijalankan SATU KALI oleh IntersectionObserver yang sama. */
    [data-reveal]{opacity:0;transform:translateY(35px);transition:opacity .85s cubic-bezier(.22,1,.36,1),transform .85s cubic-bezier(.22,1,.36,1);will-change:opacity,transform}
    [data-reveal="title"]{transform:translateY(25px)}
    [data-reveal="text"]{transform:translateY(18px)}
    [data-reveal="card"]{transform:translateY(30px) scale(.97)}
    [data-reveal="img"]{transform:scale(.96)}
    [data-reveal="left"]{transform:translateX(-46px)}
    [data-reveal="right"]{transform:translateX(46px)}
    [data-reveal].revealed,[data-reveal].is-visible{opacity:1;transform:none}
    [data-reveal]{transition-delay:var(--reveal-delay,calc(var(--d,0)*100ms))}

    /* Pengaman horizontal scroll (clip tidak membuat scroll container,
       sehingga sticky navbar di layout tetap berfungsi) */
    body{overflow-x:clip}

    /* Ornamen halus: rotasi sangat lambat / floating / pulse */
    @keyframes ornSpinSlow{to{transform:rotate(360deg)}}
    @keyframes ornFloatSoft{0%,100%{transform:translateY(0)}50%{transform:translateY(-6px)}}
    @keyframes ornPulseSoft{0%,100%{opacity:.55}50%{opacity:.85}}


    /* ---------- JENDELA KEPALA SEKOLAH (corporate glass window) ---------- */
    .window-section{position:relative;background:#f7f9fc;color:#0d2d50;padding:96px 0;overflow:hidden;transition:background .9s var(--ease)}
    .window-section::before{content:"";position:absolute;inset:0;background:
      repeating-linear-gradient(90deg,transparent 0 118px,rgba(255,255,255,.03) 118px 120px),
      repeating-linear-gradient(0deg,transparent 0 118px,rgba(255,255,255,.03) 118px 120px);pointer-events:none;z-index:1}
    .window-bg{position:absolute;inset:0;z-index:0;background:none!important;opacity:0!important;pointer-events:none}
    .window-section .section-label,.window-section .section-title{color:#0d2d50}.window-section .section-title .accent{color:#FFB300;background:none;-webkit-text-fill-color:#FFB300}
    .window-section .section-desc{color:#66788c}
    .window-section .accent{background:linear-gradient(100deg,#ffd54a,#f9a825);-webkit-background-clip:text;background-clip:text;color:transparent}

    .window-stage{position:relative;max-width:1120px;margin:2.2rem auto 0;z-index:2}
    .window-frame{position:relative;aspect-ratio:2.25/1;min-height:480px;border-radius:18px;overflow:hidden;
      background:#0a2747;
      border:1px solid rgba(255,255,255,.16);outline:1px solid rgba(249,168,37,.4);outline-offset:5px;
      box-shadow:0 34px 80px rgba(0,0,0,.45),0 0 0 1px rgba(255,255,255,.06);transition:box-shadow .9s var(--ease),outline-color .9s}
    .window-frame::before{content:"";position:absolute;inset:0;z-index:3;pointer-events:none;border-radius:18px;
      background:linear-gradient(90deg,rgba(255,255,255,.05) 0 49.7%,rgba(255,255,255,.14) 49.7% 50.3%,rgba(255,255,255,.05) 50.3% 100%);
      mix-blend-mode:overlay}
    .window-frame::after{content:"";position:absolute;inset:0;z-index:9;pointer-events:none;border-radius:18px;
      box-shadow:inset 0 0 0 1px rgba(255,255,255,.08),inset 0 16px 44px rgba(0,0,0,.22)}

    /* interior: isi sambutan (terlihat setelah jendela terbuka) */
    .window-scene{position:absolute;inset:0;z-index:2;overflow:hidden;transition:filter 1s var(--ease);
      background:transparent}
    .window-section.open .window-scene{filter:brightness(1.12)}
    .ws-inner{position:absolute;inset:0;display:grid;grid-template-columns:minmax(250px,34%) 1fr;gap:2.6rem;align-items:center;padding:3.2rem 3.6rem}

    /* foto kepala sekolah */
    .ws-left{display:flex;flex-direction:column;align-items:center;text-align:center;gap:.7rem}
    .ws-photo-frame{position:relative;width:min(240px,82%);aspect-ratio:3/3.6;border-radius:6px;padding:9px;
      background:rgba(255,255,255,.055);border:1px solid rgba(249,168,37,.55);
      box-shadow:0 20px 44px rgba(0,0,0,.35);display:flex;align-items:flex-end;justify-content:center;overflow:hidden}
    .ws-photo-frame::before{content:"";position:absolute;inset:9px;border:1px solid rgba(255,255,255,.16);border-radius:3px;pointer-events:none}
    .ws-photo{position:relative;height:100%;width:100%;object-fit:contain;filter:drop-shadow(0 14px 26px rgba(0,0,0,.3))}
    .ws-photo-cap{font-weight:800;font-size:1rem;color:#fff;letter-spacing:.02em}
    .ws-photo-role{font-size:.68rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase;color:#ffd54a}
    .ws-photo-role .num-2{color:#ffd54a}

    /* teks sambutan */
    .ws-right{text-align:left;color:#fff}
    .ws-kicker{display:flex;align-items:center;gap:.7rem;font-size:.72rem;font-weight:700;letter-spacing:.34em;text-transform:uppercase;color:#ffd54a;margin-bottom:1rem}
    .ws-kicker-line{width:44px;height:1px;background:linear-gradient(90deg,#ffd54a,transparent);flex-shrink:0}
    .ws-welcome{font-family:var(--font-display);font-size:clamp(1.7rem,3.4vw,2.6rem);line-height:1.08;color:#fff;text-transform:uppercase;letter-spacing:.02em}
    .ws-quote{margin-top:1rem;font-size:clamp(1rem,1.7vw,1.22rem);font-style:italic;color:#ffd54a;line-height:1.55;border-left:3px solid rgba(255,213,74,.55);padding-left:1rem}
    .ws-msg{margin-top:1rem;font-size:.88rem;line-height:1.8;color:rgba(255,255,255,.82);max-width:52ch}
    .ws-sign{margin-top:1.4rem;padding-top:1.1rem;border-top:1px solid rgba(255,255,255,.16)}
    .ws-sign-name{font-weight:800;font-size:1.05rem;color:#fff}
    .ws-sign-role{font-size:.68rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase;color:#ffd54a;margin-top:.2rem}
    .ws-sign-role .num-2{color:#ffd54a}

    /* kaca jendela (panel bergeser ke samping saat terbuka) */
    .window-glass{position:absolute;top:0;bottom:0;width:50.5%;z-index:5;transition:transform 1.05s var(--ease);will-change:transform}
    .window-glass.left{left:0}
    .window-glass.right{right:0}
    .window-pane-glass{position:absolute;inset:0;
      background:linear-gradient(120deg,rgba(178,216,255,.16),rgba(178,216,255,.05) 46%,rgba(255,255,255,.1));
      backdrop-filter:blur(5px) saturate(1.05);-webkit-backdrop-filter:blur(5px) saturate(1.05);
      box-shadow:inset 1px 0 0 rgba(255,255,255,.2),inset -1px 0 0 rgba(255,255,255,.12)}
    .window-glass.left .window-pane-glass{border-right:1px solid rgba(255,255,255,.18)}
    .window-glass.right .window-pane-glass{border-left:1px solid rgba(255,255,255,.18)}
    .window-glass::after{content:"";position:absolute;inset:0;pointer-events:none;
      background:linear-gradient(115deg,transparent 30%,rgba(255,255,255,.14) 44%,transparent 58%);
      animation:glassShine 9s ease-in-out infinite}
    .window-section.open .window-glass.left{transform:translateX(-104%) skewX(2deg)}
    .window-section.open .window-glass.right{transform:translateX(104%) skewX(-2deg)}

    /* state tertutup: FROM THE PRINCIPAL'S OFFICE */
    .window-knock{position:absolute;inset:0;z-index:7;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1rem;text-align:center;padding:1rem;
      background:linear-gradient(180deg,rgba(7,26,48,.42),rgba(7,26,48,.6));backdrop-filter:blur(2px);-webkit-backdrop-filter:blur(2px);
      transition:opacity .6s var(--ease),visibility .6s}
    .window-section.open .window-knock{opacity:0;visibility:hidden}
    .wk-label{display:flex;align-items:center;gap:.8rem;font-size:.72rem;font-weight:700;letter-spacing:.42em;text-transform:uppercase;color:#ffd54a}
    .wk-label::before,.wk-label::after{content:"";width:34px;height:1px;background:rgba(255,213,74,.5)}
    .wk-title{font-family:var(--font-display);font-size:clamp(1.5rem,3.6vw,2.5rem);font-weight:800;font-style:normal;text-transform:none;letter-spacing:.06em;color:#fff;line-height:1.15;
      text-shadow:0 6px 24px rgba(0,0,0,.45)}
    .wk-silhouette{width:88px;height:88px;border-radius:50%;overflow:hidden;border:1px solid rgba(255,213,74,.65);
      box-shadow:0 0 0 6px rgba(255,255,255,.05),0 14px 30px rgba(0,0,0,.35);margin-top:.2rem}
    .wk-silhouette img{width:100%;height:100%;object-fit:cover;filter:grayscale(1) brightness(.5) contrast(1.08)}
    .wk-btn{position:relative;display:inline-flex;align-items:center;gap:.9rem;margin-top:.7rem;padding:.85rem 2.1rem;border-radius:4px;
      border:1px solid #ffd54a;background:rgba(13,58,102,.35);color:#fff;font-weight:800;font-size:.82rem;letter-spacing:.22em;text-transform:uppercase;cursor:pointer;
      box-shadow:0 14px 30px rgba(0,0,0,.3);transition:all .35s var(--ease);backdrop-filter:blur(4px)}
    .wk-btn:hover{background:#ffd54a;color:#0d3a66;transform:translateY(-2px);box-shadow:0 18px 38px rgba(249,168,37,.35)}
    .wk-btn:active{transform:scale(.98)}

    /* tombol tutup jendela */
    .ws-close{position:absolute;right:16px;bottom:16px;z-index:8;display:inline-flex;align-items:center;gap:.45rem;padding:.55rem 1.15rem;border-radius:4px;
      border:1px solid rgba(255,213,74,.55);background:rgba(8,30,56,.6);color:#fff;font-size:.72rem;font-weight:700;letter-spacing:.08em;cursor:pointer;
      backdrop-filter:blur(5px);-webkit-backdrop-filter:blur(5px);opacity:0;visibility:hidden;transform:translateY(8px);transition:all .45s var(--ease)}
    .window-section.open .ws-close{opacity:1;visibility:visible;transform:none}
    .ws-close:hover{background:#ffd54a;color:#0d3a66}

    /* cahaya masuk saat jendela terbuka */
    .ws-glow{position:absolute;inset:0;z-index:4;pointer-events:none;background:linear-gradient(115deg,transparent 32%,rgba(255,236,170,.22) 47%,transparent 62%);transform:translateX(-120%);transition:transform 1.3s var(--ease)}
    .window-section.open .ws-glow{transform:translateX(120%)}
    .window-section.open .window-frame{outline-color:rgba(255,213,74,.75);box-shadow:0 34px 90px rgba(0,0,0,.5),0 0 70px rgba(255,213,74,.22),0 0 0 1px rgba(255,255,255,.1)}
    .window-section.open{background:linear-gradient(140deg,#114d84,#1d6fb8 55%,#1d6fb8)}

    @keyframes glassShine{0%,55%{opacity:.5;transform:translateX(-8%)}85%,100%{opacity:.9;transform:translateX(8%)}}

    @media(max-width:900px){
      .window-frame{aspect-ratio:auto;min-height:640px}
      .ws-inner{grid-template-columns:1fr;grid-template-rows:auto 1fr;gap:1.4rem;padding:2.2rem 2rem;text-align:center}
      .ws-left{gap:.4rem}
      .ws-photo-frame{width:min(190px,60%)}
      .ws-right{text-align:center}
      .ws-kicker{justify-content:center}
      .ws-kicker-line{display:none}
      .ws-quote{border-left:0;padding-left:0;border-top:1px solid rgba(255,213,74,.4);padding-top:.8rem}
      .ws-msg{margin-left:auto;margin-right:auto}
    }
    @media(max-width:600px){
      .window-frame{min-height:720px}
      .ws-inner{padding:1.6rem 1.2rem}
      .ws-photo-frame{width:min(160px,62%)}
      .ws-welcome{font-size:1.35rem}
      .ws-msg{font-size:.82rem}
      .wk-title{font-size:1.3rem;letter-spacing:.04em}
      .wk-label{font-size:.62rem;letter-spacing:.28em}
      .wk-btn{font-size:.72rem;letter-spacing:.16em;padding:.75rem 1.5rem}
    }
        /* ============================================================
       JURUSAN — FEATURED PROGRAMS (carousel 3 kartu — center active)
       Tampilan: kiri kecil — tengah besar (active) — kanan kecil, loop infinite
       ============================================================ */
    .jurusan-section{position:relative;background:#ffffff;overflow:hidden}
    .jurusan-section::before{content:"";position:absolute;inset:0;pointer-events:none;z-index:0;
      background:radial-gradient(ellipse 80% 55% at 50% 0%,rgba(255,170,60,.07),transparent 62%)}
    .jurusan-section>.container{position:relative;z-index:2}
    .jurusan-section .jurusan-carousel{position:relative;z-index:3}

    /* Dekor JURUSAN: bahasa visual geometris/teknologi — sengaja berbeda dari Profil */
    .jurusan-decor{position:absolute;inset:0;z-index:0;pointer-events:none;overflow:hidden}
    .jurusan-decor svg{position:absolute;inset:0;width:100%;height:100%;display:block}
    .jd-grid{stroke:#0d3a66;stroke-width:1;opacity:.08}
    .jd-diag{fill:none;stroke:#ff9f00;stroke-width:2.2;stroke-linecap:round;opacity:.24}
    .jd-diag-soft{fill:none;stroke:#0d3a66;stroke-width:1.4;stroke-linecap:round;opacity:.12}
    .jd-square{fill:none;stroke:#ff9f00;stroke-width:2;opacity:.42}
    .jd-square-fill{fill:#ffb300;opacity:.13}
    .jd-hex{fill:none;stroke:#0d3a66;stroke-width:2;opacity:.18}
    .jd-node{fill:#ff9f00;opacity:.55}
    .jd-plus{stroke:#0d3a66;stroke-width:2;stroke-linecap:round;opacity:.24}
    .jd-corner{fill:none;stroke:#ff9f00;stroke-width:3;stroke-linecap:square;opacity:.32}
    @media(max-width:640px){.jurusan-decor{opacity:.62}}

    /* Header section: JURUSAN UNGGULAN — disamakan dengan judul Sambutan Sekolah */
    .jurusan-section .section-label{
      color:#ff9f00!important;
      letter-spacing:.22em;
      font-weight:800;
    }
    .jurusan-section .section-title{
      color:#102f51!important;
      font-family:var(--font-display);
      font-size:clamp(2.5rem,5vw,4.3rem)!important;
      line-height:.98;
      text-transform:uppercase;
      letter-spacing:.015em;
      margin-top:.35rem;
    }
    .jurusan-section .section-title .accent{
      color:#ffb300!important;
      background:none!important;
      -webkit-text-fill-color:#ffb300!important;
    }
    .jurusan-section .section-desc{display:none!important}

    /* Stage: semua kartu absolute di tengah — posisi dikendalikan data-pos */
    .jurusan-carousel{margin-top:4.4rem}
    .carousel-stage{position:relative;width:100%;max-width:1180px;margin:0 auto;
      min-height:660px;touch-action:pan-y;user-select:none;-webkit-user-select:none}
    .carousel-card{position:absolute;left:50%;top:0;width:320px;margin-left:-160px;
      cursor:pointer;will-change:transform,opacity;pointer-events:none;
      transition:transform .6s cubic-bezier(.22,.61,.36,1),opacity .55s ease;
      visibility:hidden;opacity:0}
    .carousel-card .card-inner{position:relative;width:100%;display:flex;flex-direction:column;align-items:center}
    /* Posisi melingkar: active di tengah (scale 1), prev/next di samping (kecil + turun), lainnya jauh */
    .carousel-card[data-pos="active"]{transform:translateX(0) translateY(0) scale(1);
      z-index:3;opacity:1;visibility:visible;pointer-events:auto}
    .carousel-card[data-pos="next"]{transform:translateX(352px) translateY(30px) scale(.8);
      z-index:2;opacity:.92;visibility:visible;pointer-events:auto}
    .carousel-card[data-pos="prev"]{transform:translateX(-352px) translateY(30px) scale(.8);
      z-index:2;opacity:.92;visibility:visible;pointer-events:auto}
    .carousel-card[data-pos="far-r"]{transform:translateX(704px) translateY(30px) scale(.8);
      z-index:1;opacity:0;visibility:hidden}
    .carousel-card[data-pos="far-l"]{transform:translateX(-704px) translateY(30px) scale(.8);
      z-index:1;opacity:0;visibility:hidden}

    /* Foto cutout siswa + glow lingkaran warna tema */
    .cc-photo{position:relative;width:100%;height:400px;flex-shrink:0;z-index:1;
      display:flex;align-items:flex-end;justify-content:center;overflow:visible}
    .cc-photo::before{content:"";position:absolute;left:50%;bottom:8px;transform:translateX(-50%);
      width:92%;height:86%;border-radius:50%;
      background:radial-gradient(ellipse at center,var(--jur-glow) 0%,transparent 66%);
      filter:blur(10px);opacity:.95;pointer-events:none;z-index:0}
    .cc-photo img{position:relative;z-index:1;display:block;width:auto;height:400px;
      max-height:400px;max-width:100%;object-fit:contain;
      filter:drop-shadow(0 16px 26px var(--jur-shadow))}

    /* Brand color per jurusan */
    .carousel-card[data-index="0"]{--jur-color:#E8A800;--jur-glow:rgba(232,168,0,.50);--jur-shadow:rgba(232,168,0,.30)} /* APHP kuning */
    .carousel-card[data-index="1"]{--jur-color:#D80A86;--jur-glow:rgba(216,10,134,.45);--jur-shadow:rgba(216,10,134,.26)} /* DKV pink */
    .carousel-card[data-index="2"]{--jur-color:#FE8D03;--jur-glow:rgba(254,141,3,.50);--jur-shadow:rgba(254,141,3,.28)} /* KULINER oranye */
    .carousel-card[data-index="3"]{--jur-color:#049747;--jur-glow:rgba(4,151,71,.45);--jur-shadow:rgba(4,151,71,.26)} /* LPS hijau */
    .carousel-card[data-index="4"]{--jur-color:#DB1320;--jur-glow:rgba(219,19,32,.50);--jur-shadow:rgba(219,19,32,.28)} /* RPL merah */

    /* Box putih MENEMPEL LANGSUNG di bawah foto — isi: singkatan + nama lengkap + tombol */
    .cc-body{position:relative;z-index:2;width:100%;background:#fff;
      border-radius:0 0 18px 18px;padding:1.1rem 1.1rem 1.15rem;text-align:center;
      border:1px solid rgba(23,32,79,.06);border-top:0;
      box-shadow:0 20px 42px rgba(23,32,79,.15)}
    .cc-abbr{font-family:var(--font-display);font-size:1.45rem;font-weight:800;
      letter-spacing:.04em;color:var(--jur-color);line-height:1.1}
    .cc-full{font-size:.98rem;font-weight:700;color:#26344f;line-height:1.4;margin-top:.22rem}
    .cc-cta{display:flex;align-items:center;justify-content:center;gap:.45rem;margin-top:.85rem;
      padding:.62rem .9rem;border-radius:12px;font-size:.78rem;font-weight:800;color:#fff;
      background:var(--jur-color);text-decoration:none;letter-spacing:.02em;
      box-shadow:0 8px 18px var(--jur-shadow);
      transition:transform .3s var(--ease),gap .3s var(--ease),filter .3s var(--ease)}
    .cc-cta:hover{transform:translateY(-2px);filter:brightness(1.08);gap:.6rem}
    .cc-cta i{font-size:.68rem}

    /* Nav: panah bulat navy di sisi stage + dots oranye di bawah */
    .carousel-nav{display:flex;align-items:center;justify-content:center;gap:1.5rem;margin-top:2.4rem}
    .carousel-nav-btn{width:52px;height:52px;border-radius:50%;border:0;cursor:pointer;color:#fff;
      font-size:1.05rem;display:flex;align-items:center;justify-content:center;
      background:linear-gradient(135deg,#17204f,#0d3a66);
      box-shadow:0 10px 22px rgba(23,32,79,.32);transition:all .3s var(--ease)}
    .carousel-nav-btn:hover{transform:translateY(-3px);
      background:linear-gradient(135deg,#ff7a00,#ffb300);box-shadow:0 14px 30px rgba(255,122,0,.4)}
    .carousel-dots{display:flex;align-items:center;gap:.55rem}
    .carousel-dot{width:9px;height:9px;border-radius:99px;background:#d3dbea;border:0;padding:0;
      cursor:pointer;transition:all .3s var(--ease)}
    .carousel-dot.active{width:26px;background:linear-gradient(90deg,#ff7a00,#ffb300);
      box-shadow:0 3px 9px rgba(255,122,0,.42)}
    .carousel-dot:hover{background:#ffb300}

    /* Panah menyamping area foto */
    .carousel-stage .carousel-nav-btn{position:absolute;top:38%;transform:translateY(-50%);z-index:8;margin:0}
    .carousel-stage .carousel-nav-btn:hover{transform:translateY(-50%) translateY(-3px)}
    .carousel-stage #carouselPrev{left:-4px}
    .carousel-stage #carouselNext{right:-4px}

    /* Responsive */
    @media(max-width:1100px){
      .carousel-card{width:280px;margin-left:-140px}
      .carousel-card[data-pos="next"]{transform:translateX(308px) translateY(28px) scale(.8)}
      .carousel-card[data-pos="prev"]{transform:translateX(-308px) translateY(28px) scale(.8)}
      .carousel-card[data-pos="far-r"]{transform:translateX(616px) translateY(28px) scale(.8)}
      .carousel-card[data-pos="far-l"]{transform:translateX(-616px) translateY(28px) scale(.8)}
      .cc-photo{height:350px}
      .cc-photo img{height:350px;max-height:350px}
      .carousel-stage{min-height:600px}
    }
    @media(max-width:860px){
      .carousel-stage{min-height:510px}
      .carousel-stage .carousel-nav-btn{width:46px;height:46px;font-size:.95rem}
      .carousel-stage #carouselPrev{left:0}
      .carousel-stage #carouselNext{right:0}
    }
    @media(max-width:640px){
      .jurusan-carousel{margin-top:3.2rem}
      .carousel-stage{min-height:430px}
      .carousel-card{width:44vw;margin-left:-22vw}
      .carousel-card[data-pos="next"]{transform:translateX(40vw) translateY(22px) scale(.78)}
      .carousel-card[data-pos="prev"]{transform:translateX(-40vw) translateY(22px) scale(.78)}
      .carousel-card[data-pos="far-r"]{transform:translateX(80vw) translateY(22px) scale(.78)}
      .carousel-card[data-pos="far-l"]{transform:translateX(-80vw) translateY(22px) scale(.78)}
      .cc-photo{height:38vw;min-height:170px}
      .cc-photo img{height:38vw;min-height:170px;max-height:250px}
      .cc-body{padding:.9rem .85rem .95rem}
      .cc-abbr{font-size:1.18rem}
      .cc-full{font-size:.84rem}
      .cc-cta{font-size:.72rem;padding:.55rem .7rem;margin-top:.7rem}
      .carousel-stage .carousel-nav-btn{top:34%;width:42px;height:42px;font-size:.88rem}
      .carousel-nav{margin-top:1.8rem}
    }



    /* ---------- KONTAK : FIND US ---------- */
    .ft-wrap{max-width:1200px;margin:0 auto}
    .ft-head{text-align:center;margin-bottom:2.6rem}
    .ft-eyebrow{display:none}
    .ft-eyebrow::before,.ft-eyebrow::after{content:"";width:22px;height:2px;border-radius:99px;background:linear-gradient(90deg,var(--gold),var(--gold-dark))}
    .ft-title{font-family:var(--font-display);font-size:clamp(2.25rem,4.6vw,3.8rem);font-weight:800;font-style:normal;text-transform:uppercase;letter-spacing:.015em;color:var(--ink);line-height:1.05;margin-bottom:1rem;text-shadow:0 2px 10px rgba(13,58,102,.06)}
    .ft-title .ft-gold{color:#FA5E11;background:none;-webkit-text-fill-color:#FA5E11}
    .ft-sub{color:var(--text-muted);font-size:.96rem;margin-bottom:.3rem}
    .ft-line{color:var(--text-muted);font-size:.84rem;opacity:.85}
    .ft-map{position:relative;height:520px;border-radius:24px;overflow:hidden;box-shadow:var(--shadow-lg);background:#d7e5f2}
    .ft-map iframe{position:absolute;inset:0;width:100%;height:100%;border:0;display:block}
    .ft-map[data-reveal]{transform:scale(.98)}
    .ft-map[data-reveal].revealed{transform:none}
    .ft-pin{position:absolute;top:16%;left:50%;z-index:3;display:flex;flex-direction:column;align-items:center;pointer-events:none}
    .ft-pin-badge{position:relative;z-index:2;width:54px;height:54px;border-radius:50% 50% 50% 4px;transform:rotate(-45deg);background:linear-gradient(135deg,#f59e0b,#ffb43a);display:flex;align-items:center;justify-content:center;box-shadow:0 12px 26px rgba(245,158,11,.5);border:3px solid #fff}
    .ft-pin-badge img{width:28px;height:28px;transform:rotate(45deg);object-fit:contain}
    .ft-pin-ring{position:absolute;top:27px;left:0;width:54px;height:54px;border-radius:50%;background:rgba(245,158,11,.4);animation:ftPulse 2.8s cubic-bezier(.22,.61,.36,1) infinite}
    .ft-pin-ring.r2{animation-delay:1.4s}
    @keyframes ftPulse{0%{transform:scale(.35);opacity:.9}70%{transform:scale(1.9);opacity:0}100%{transform:scale(1.9);opacity:0}}
    .ft-card{position:absolute;left:0;right:0;bottom:26px;margin:0 auto;width:min(600px,calc(100% - 3rem));z-index:4;background:#fff;border-radius:20px;box-shadow:0 24px 60px rgba(18,59,96,.28);padding:1.25rem 1.5rem 0}
    .ft-card[data-reveal]{transform:translateY(20px)}
    .ft-card[data-reveal].revealed{transform:none}
    .ft-card-head{display:flex;align-items:center;gap:.85rem;margin-bottom:.9rem}
    .ft-card-logo{width:46px;height:46px;border-radius:13px;overflow:hidden;background:linear-gradient(135deg,#123b60,#1e5b92);display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .ft-card-logo img{width:34px;height:34px;object-fit:contain}
    .ft-card-title{font-family:var(--font-display);font-size:1.02rem;color:var(--ink);line-height:1.25}
    .ft-card-title small{display:block;font-size:.72rem;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:var(--gold)}
    .ft-card-div{height:1px;background:linear-gradient(90deg,var(--gold),#e8d5b0 55%,transparent);margin:0 0 .7rem}
    .ft-row{display:flex;align-items:flex-start;gap:.8rem;padding:.42rem 0}
    .ft-row-icon{flex-shrink:0;width:38px;height:38px;border-radius:11px;background:#f5f8fc;border:1px solid var(--border);color:var(--gold);display:flex;align-items:center;justify-content:center;font-size:.85rem}
    .ft-row-label{font-size:.68rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:var(--teal);margin-bottom:.1rem}
    .ft-row-value{font-size:.9rem;font-weight:600;color:var(--ink);line-height:1.45}
    .ft-row-value a{color:var(--ink);text-decoration:underline;text-underline-offset:3px;text-decoration-color:rgba(245,158,11,.55)}
    .ft-row-value a:hover{color:var(--gold)}
    .ft-stub{border:0;border-top:2px dashed #d5e2ee;margin:.9rem -1.5rem .9rem}
    .ft-map-btn{display:flex;align-items:center;justify-content:center;gap:.55rem;width:100%;border:0;border-radius:14px;background:linear-gradient(135deg,#123b60,#1e5b92);color:#fff;font-size:.9rem;font-weight:800;letter-spacing:.06em;padding:.95rem 1rem;cursor:pointer;transition:all .3s var(--ease)}
    .ft-map-btn:hover{background:linear-gradient(135deg,#0f3153,#185081);transform:translateY(-2px);box-shadow:0 14px 30px rgba(18,59,96,.35)}
    .ft-map-btn i{color:var(--gold);transition:transform .3s var(--ease)}
    .ft-map-btn:hover i{transform:translate(3px,-3px)}
    .ft-cta{display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:1.1rem;margin-top:2.4rem;text-align:center}
    .ft-cta p{margin:0;color:var(--text-muted);font-size:.92rem;max-width:520px}
    .ft-cta-btn{display:inline-flex;align-items:center;gap:.55rem;border:0;border-radius:99px;background:linear-gradient(135deg,var(--gold),var(--gold-dark));color:#123b60;font-weight:800;font-size:.86rem;letter-spacing:.05em;padding:.78rem 1.5rem;cursor:pointer;transition:all .3s var(--ease);box-shadow:0 12px 26px rgba(245,158,11,.35)}
    .ft-cta-btn:hover{transform:translateY(-3px);box-shadow:0 16px 32px rgba(245,158,11,.45)}
    .ft-cta-btn i{transition:transform .3s var(--ease)}
    .ft-cta-btn:hover i{transform:translateX(4px)}
    @media(max-width:768px){
      .ft-map{height:430px}
      .ft-card{position:static;width:100%;margin:1.3rem auto 0;box-shadow:0 18px 44px rgba(18,59,96,.2)}
      .ft-card[data-reveal],.ft-card[data-reveal].revealed{transform:none}
    }

    /* ---------- RESPONSIVE ---------- */
    @media(max-width:1024px){
      .footer-nav{gap:1.8rem 2.2rem}
      .footer-nav-group{width:100%;text-align:center}
      .footer-nav-links{justify-content:center}
    }
    @media(max-width:900px){
      .section-py{padding:72px 0}
      .hero-stats-inner{grid-template-columns:repeat(2,1fr)}
    }
    @media(max-width:600px){
      .section-py{padding:60px 0}
      .hero-headline{font-size:2.35rem}
      .hero-stats-inner{padding:1rem}
      .footer-nav{gap:1.5rem}
      .footer-bottom-inner{justify-content:center;text-align:center}
      .footer-copy{justify-content:center}
      .footer-legal{justify-content:center}
      .hero-stat-label{font-size:.68rem}
      .window-section{padding:72px 0}
    }


    @media(max-width:640px){
      .book-leaf{padding:1.05rem 1.1rem}
      .book-cover-photo img{height:112px}
      .book-cover-top{gap:.5rem}
      .profil-akreditasi{font-size:.6rem;padding:.32rem .6rem}
      .book-cover-kicker{font-size:.58rem}
      .book-cover-school{font-size:1.05rem}
      .book-cover-sub{font-size:.7rem}
      .book-page-head{margin-bottom:.6rem}
      .book-page-kicker{font-size:.58rem}
      .book-page-title{font-size:.95rem}
      .book-page-text{font-size:.74rem;line-height:1.65;margin-bottom:.5rem}
      .book-page-no{font-size:1.4rem}
      .book-timeline{margin:.5rem 0 .7rem;padding-top:.55rem;gap:.35rem}
      .book-year{font-size:.74rem;min-width:44px}
      .book-mile-text{font-size:.68rem}
      .book-stats{gap:.4rem}
      .book-stat{padding:.5rem .3rem}
      .book-stat strong{font-size:1rem}
      .book-stat span{font-size:.58rem}
      .vm-text{font-size:.78rem;padding:.45rem 0 .45rem .8rem}
      .misi-item{padding:.55rem .7rem;gap:.6rem}
      .misi-num{width:24px;height:24px;font-size:.72rem;border-radius:7px}
      .misi-text{font-size:.72rem;line-height:1.55}
    }

    /* ---------- REDUCED MOTION ---------- */
    @media(prefers-reduced-motion:reduce){
      *,*::before,*::after{animation-duration:.01ms !important;animation-iteration-count:1 !important;transition-duration:.01ms !important}
      [data-reveal]{opacity:1;transform:none}
      [data-reveal="left"],[data-reveal="right"]{transform:none}
      .hd-hero{animation:none !important}
      html{scroll-behavior:auto}
    }
    @media(prefers-reduced-motion:reduce){
      .vt-section .vt-decor-ring,
      .principal-section-ornament-left,.principal-section-ornament-right,.jd-node,
      .hd-hero-inner::after{animation:none !important}
    }
    @media(prefers-reduced-motion:reduce){
      .cc-photo img,
      .misi-item,.window-knock .wk-btn,
      .ft-card,.ft-map-btn,.ft-cta-btn,.carousel-card{transform:none !important;opacity:1 !important}
    }
  /* v35-spacing-final */

/* ============================================================
   HOVER ANIMATION HALUS (card, button, link, ornament)
   Ditambahkan agar senada dengan halaman Sejarah/Visi Misi.
   ============================================================ */
/* Card utama hover: naik halus + shadow bertambah + border subtle */
.carousel-card[data-pos="active"] .card-inner{transition:transform .3s ease,filter .3s ease}
.carousel-card[data-pos="active"] .card-inner:hover{transform:translateY(-6px)}
.carousel-card[data-pos="active"] .card-inner:hover .cc-body{box-shadow:0 28px 54px rgba(23,32,79,.22)}
.carousel-card[data-pos="active"] .cc-photo img{transition:transform .35s ease}
.carousel-card[data-pos="active"] .card-inner:hover .cc-photo img{transform:translateY(-4px) scale(1.02)}
.ft-card{transition:transform .3s ease,box-shadow .3s ease,border-color .3s ease;border:1px solid transparent}
.ft-card:hover{transform:translateY(-6px);box-shadow:0 32px 66px rgba(18,59,96,.32);border-color:rgba(245,158,11,.35)}
/* Ikon dalam card ikut scale halus saat hover */
.carousel-card[data-pos="active"] .card-inner:hover .cc-abbr{transform:scale(1.04)}
.cc-abbr{transition:transform .3s ease}
/* Tombol utama: arrow bergeser 4-6px ke kanan saat hover */
.hd-btn i,.vt-btn i,.ft-cta-btn i,.ft-map-btn i{transition:transform .3s ease}
.hd-btn:hover i,.vt-btn:hover i,.ft-cta-btn:hover i{transform:translateX(5px)}
/* Link nav: underline muncul smooth (hanya link konten, bukan navbar) */
.ft-row-value a{transition:color .2s ease}
.ft-row-value a::after{content:"";display:block;height:2px;width:0;background:linear-gradient(90deg,#ffd54a,#ffb300);transition:width .25s ease;border-radius:99px;margin-top:2px}
.ft-row-value a:hover::after{width:100%}
/* Ornamen subtle animation: ring berputar lambat, diamond mengambang, dots berdenyut halus */
.vt-section .vt-decor-ring{animation:ornSpin 26s linear infinite}
.principal-section-ornament-left{animation:ornFloat 11s ease-in-out infinite}
.principal-section-ornament-right{animation:ornFloat 13s ease-in-out infinite}
.jd-node{animation:ornPulse 4.5s ease-in-out infinite}
@keyframes ornSpin{to{transform:rotate(360deg)}}
@keyframes ornFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
@keyframes ornPulse{0%,100%{opacity:.35}50%{opacity:.85}}
@media(prefers-reduced-motion:reduce){
  .vt-section .vt-decor-ring,
  .principal-section-ornament-left,.principal-section-ornament-right,.jd-node,
  .hd-hero-inner::after{animation:none !important}
}
/* Virtual Tour foto: hover scale halus 1 -> 1.03 (overflow hidden sudah ada di .vt-frame) */
.vt-frame img{transition:transform .6s ease}
.vt-frame:hover img{transform:scale(1.03)}
</style>

<!-- ============================================================
     HERO BARU SMKN 2 MOJOKERTO — CINEMATIC + INTRO VIDEO
     (ditambahkan di halaman beranda; hero lama dari layout
      disembunyikan via CSS override scoped di bawah)
     ============================================================ -->
<style>
  /* -------- Sembunyikan hero lama dari layout (hanya halaman ini) -------- */
  .page-hero-bg, #beranda.hero { display:none !important; }

  /* -------- INTRO VIDEO FULLSCREEN --------
     Layer: header existing (announce-bar z-60, #navbar z-100) tetap DI ATAS
     intro (z-50) sehingga header tetap terlihat & bisa diklik saat intro. */
  .hd-intro{position:fixed;inset:0;z-index:50;background:#0a1622;overflow:hidden}
  .hd-intro video{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
  .hd-intro::after{content:"";position:absolute;inset:0;background:rgba(0,0,0,.2)}
  .hd-intro-skip{position:absolute;bottom:34px;right:40px;z-index:3;display:inline-flex;align-items:center;gap:.55rem;padding:.62rem 1.25rem;border:1px solid rgba(255,255,255,.55);border-radius:10px;background:rgba(255,255,255,.07);backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);color:#fff;font-family:var(--font-body);font-size:.84rem;font-weight:600;letter-spacing:.05em;cursor:pointer;transition:all .35s var(--ease)}
  .hd-intro-skip i{font-size:.7rem;transition:transform .35s var(--ease)}
  .hd-intro-skip:hover{background:rgba(255,255,255,.16);border-color:rgba(255,255,255,.9)}
  .hd-intro-skip:hover i{transform:translateX(4px)}
  .hd-intro.hd-hidden{opacity:0;visibility:hidden;pointer-events:none;transition:opacity .7s var(--ease),visibility 0s .7s}

  /* -------- HERO UTAMA (cinematic fullscreen, foto = background) -------- */
  .hd-hero{position:relative;min-height:100svh;display:flex;align-items:center;overflow:hidden;
    background-image:url('{{ asset('images/hero-sekolah.jpg') }}');
    background-size:cover;background-position:center;background-repeat:no-repeat;
    animation:hdHeroBg 1.6s cubic-bezier(.22,.61,.36,1) both}
  /* Subtle scale saat halaman dibuka: scale(1.03) -> scale(1) */
  @keyframes hdHeroBg{from{transform:scale(1.03)}to{transform:scale(1)}}
  .hd-hero::before{content:"";position:absolute;inset:0;z-index:1;
    background:linear-gradient(100deg,rgba(7,22,42,.88) 0%,rgba(9,30,54,.66) 45%,rgba(9,30,54,.30) 78%,rgba(9,30,54,.10) 100%)}
  /* Watermark typography besar transparan — konsisten dengan hero Sejarah */
  .hd-hero::after{content:"SKANEDA";position:absolute;z-index:2;right:-2%;top:50%;transform:translateY(-50%);
    font-family:var(--font-display);font-size:clamp(6rem,20vw,20rem);font-weight:900;line-height:.82;
    letter-spacing:.02em;color:rgba(255,255,255,.05);-webkit-text-stroke:1px rgba(255,255,255,.07);
    text-shadow:0 0 90px rgba(13,58,102,.16);pointer-events:none;white-space:nowrap;user-select:none}

  .hd-hero-inner{position:relative;z-index:3;max-width:none;margin:0;width:100%;padding:clamp(6rem,11vh,7.5rem) clamp(1.2rem,5.2vw,5.5rem)}
  /* Garis vertikal gold di kiri judul telah DIHAPUS total (tanpa pengganti).
     Ornamen lain (diamond gold kanan atas) tetap, dengan float halus. */
  .hd-hero-inner::after{content:"";position:absolute;right:12%;top:10%;width:64px;height:64px;
    border:2px solid rgba(255,213,74,.4);transform:rotate(45deg);pointer-events:none;
    animation:heroDiamond 7s ease-in-out infinite}
  @keyframes heroDiamond{0%,100%{transform:rotate(45deg) translateY(0);opacity:.45}50%{transform:rotate(45deg) translateY(-9px);opacity:.85}}

  .hd-hero-copy{max-width:640px}
  .hd-eyebrow{display:inline-flex;align-items:center;gap:.85rem;font-size:clamp(.82rem,1.05vw,1rem);font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:#fff7e3;padding:.62rem 1.15rem;border:1px solid rgba(255,255,255,.32);border-radius:999px;background:rgba(13,58,102,.30);backdrop-filter:blur(5px);margin-bottom:1.7rem;animation:hdFadeUp .65s .05s var(--ease) both}
  .hd-eyebrow::before{content:"";width:14px;height:14px;flex:0 0 14px;background:#ffb300;border-radius:50%;box-shadow:0 0 0 3px rgba(255,179,0,.10)}
  .hd-title{font-family:var(--font-display);font-size:clamp(3rem,7.2vw,6.3rem);line-height:1.03;font-weight:800;color:#fff;letter-spacing:.01em;margin-bottom:1.35rem;max-width:720px;text-shadow:0 2px 24px rgba(4,14,28,.3);animation:hdFadeUp .7s .15s var(--ease) both}
  .hd-title .hd-num{
    background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);
    -webkit-background-clip:text;
    background-clip:text;
    -webkit-text-fill-color:transparent;
    color:transparent;
  }
  .hd-title .hd-line-sub{color:rgba(255,255,255,.88);letter-spacing:.05em;display:inline-block}
  .hd-desc{color:rgba(235,245,253,.88);font-size:clamp(1.1rem,1.45vw,1.3rem);font-weight:700;max-width:540px;line-height:1.55;margin-bottom:2.6rem;animation:hdFadeUp .7s .3s var(--ease) both}
  .hd-actions{display:flex;align-items:center;gap:1.4rem;flex-wrap:wrap;animation:hdFadeUp .7s .42s var(--ease) both}
  .hd-btn{display:inline-flex;align-items:center;gap:.65rem;padding:1rem 2.15rem;border-radius:12px;font-family:var(--font-body);font-size:.9rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;text-decoration:none;transition:transform .35s var(--ease),box-shadow .35s var(--ease),background-color .35s var(--ease),border-color .35s var(--ease)}
  .hd-btn i{font-size:.8rem;transition:transform .35s var(--ease)}

  /* Reference-inspired hero controls: same site palette, no background redesign. */
  .hd-btn-secondary{
    background:rgba(8,35,62,.22);
    color:#fff;
    border:1px solid rgba(255,255,255,.55);
    box-shadow:0 8px 24px rgba(4,14,28,.12);
    backdrop-filter:blur(4px);
  }
  .hd-btn-secondary:hover{
    transform:translateY(-2px);
    background:rgba(8,35,62,.38);
    border-color:rgba(255,255,255,.8);
  }
  .hd-btn-secondary i{color:#ffb300}
  .hd-scroll-line{
    width:34px;
    height:1px;
    background:rgba(255,255,255,.6);
  }
  .hd-scroll-mouse{
    width:20px;
    height:30px;
    border:1.5px solid rgba(255,255,255,.8);
    border-radius:12px;
    position:relative;
    display:inline-block;
  }
  .hd-scroll-mouse::before{
    content:"";
    position:absolute;
    top:5px;
    left:50%;
    width:3px;
    height:6px;
    transform:translateX(-50%);
    border-radius:99px;
    background:#fff;
    opacity:.9;
  }

  .hd-btn-primary{background:#f9a825;color:#0d3a66;border:1px solid rgba(255,255,255,.16);box-shadow:0 12px 30px rgba(249,168,37,.26)}
  .hd-btn-primary:hover{transform:translateY(-2px);background:#ffb43a;box-shadow:0 18px 42px rgba(249,168,37,.36)}
  .hd-btn-primary:hover i{transform:translateX(5px)}
  @keyframes hdFadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:none}}

  /* ============================================================
     TOMBOL VIRTUAL TOUR 360° (hero, sejajar dengan Jelajahi Sekolah)
     ============================================================ */
  .hd-btn-vt{background:rgba(8,35,62,.22);color:#fff;border:1px solid rgba(255,255,255,.55);
    box-shadow:0 8px 24px rgba(4,14,28,.12);backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px)}
  .hd-btn-vt:hover{transform:translateY(-2px);background:rgba(8,35,62,.38);border-color:rgba(255,255,255,.8)}
  .hd-btn-vt i{font-size:.95rem;color:#ffb300;transition:transform .35s var(--ease)}
  .hd-btn-vt:hover i{transform:translateX(5px)}
  .hd-btn-vt .vt-pulse{width:9px;height:9px;border-radius:50%;background:#ffb300;flex:0 0 9px;
    box-shadow:0 0 0 0 rgba(255,179,0,.55);animation:vtPulse 2.2s infinite}
  @keyframes vtPulse{0%{box-shadow:0 0 0 0 rgba(255,179,0,.5)}70%{box-shadow:0 0 0 9px rgba(255,179,0,0)}100%{box-shadow:0 0 0 0 rgba(255,179,0,0)}}

  /* ============================================================
     SECTION VIRTUAL TOUR 360° — JELAJAHI SMKN 2 MOJOKERTO
     ============================================================ */
  .vt-section{position:relative;background:#f6f9fc;overflow:hidden;padding:clamp(4.5rem,9vw,7.5rem) 0}
  .vt-section .vt-watermark{position:absolute;z-index:0;right:-3%;top:50%;transform:translateY(-50%);
    font-family:var(--font-display);font-size:clamp(5rem,17vw,16rem);font-weight:900;line-height:.8;
    color:rgba(13,58,102,.045);white-space:nowrap;pointer-events:none;user-select:none}
  /* Ornamen geometris tipis (navy + gold) */
  .vt-section .vt-decor-ring{position:absolute;z-index:0;left:-70px;top:-70px;width:230px;height:230px;
    border:2px solid rgba(13,58,102,.10);border-radius:50%}
  .vt-section .vt-decor-ring::after{content:"";position:absolute;left:34px;top:34px;right:34px;bottom:34px;
    border:2px solid rgba(249,168,37,.35);border-radius:50%}
  .vt-section .vt-decor-dots{position:absolute;z-index:0;right:6%;bottom:8%;display:grid;
    grid-template-columns:repeat(3,6px);gap:10px}
  .vt-section .vt-decor-dots i{width:6px;height:6px;border-radius:50%;background:rgba(13,58,102,.22)}

  .vt-inner{position:relative;z-index:1;width:min(1400px,92%);margin:0 auto;
    display:grid;grid-template-columns:minmax(0,1.05fr) minmax(340px,.95fr);gap:clamp(2.5rem,5vw,5rem);align-items:center}

  /* ---- KIRI: preview foto / pintu masuk Virtual Tour ---- */
  .vt-media{position:relative}
  .vt-frame{position:relative;border-radius:26px;overflow:hidden;box-shadow:0 28px 70px rgba(13,58,102,.28);
    border:1px solid rgba(255,255,255,.6);background:#0d3a66}
  .vt-frame img{width:100%;height:clamp(320px,44vw,540px);object-fit:cover;display:block;transform:scale(1)}
  .vt-frame::before{content:"";position:absolute;inset:0;z-index:2;
    background:linear-gradient(200deg,rgba(7,22,42,.05) 30%,rgba(7,22,42,.55) 100%)}
  .vt-frame::after{content:"";position:absolute;inset:0;z-index:2;border-radius:26px;
    box-shadow:inset 0 0 0 1px rgba(255,255,255,.16)}
  /* Label 360° TOUR */
  .vt-badge{position:absolute;z-index:4;top:1.25rem;left:1.25rem;display:inline-flex;align-items:center;gap:.5rem;
    padding:.5rem .95rem;border-radius:999px;background:rgba(7,22,42,.55);border:1px solid rgba(255,255,255,.35);
    backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);color:#fff;font-size:.72rem;font-weight:800;
    letter-spacing:.14em;text-transform:uppercase}
  .vt-badge i{color:#ffb300;font-size:.9rem}
  /* Tombol play/explore tengah */
  .vt-play{position:absolute;z-index:4;top:50%;left:50%;transform:translate(-50%,-50%);
    width:76px;height:76px;border-radius:50%;border:0;cursor:pointer;display:flex;align-items:center;justify-content:center;
    background:rgba(255,255,255,.14);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);
    border:1.5px solid rgba(255,255,255,.65);color:#fff;font-size:1.4rem;
    box-shadow:0 16px 44px rgba(4,14,28,.35);transition:all .4s var(--ease)}
  .vt-play:hover{background:#f9a825;color:#0d3a66;transform:translate(-50%,-50%) scale(1.07);border-color:#f9a825}
  .vt-play::after{content:"";position:absolute;inset:-9px;border-radius:50%;border:1.5px solid rgba(255,255,255,.3);
    animation:vtRing 2.6s infinite}
  @keyframes vtRing{0%{transform:scale(.82);opacity:1}100%{transform:scale(1.25);opacity:0}}
  /* Caption bawah foto */
  .vt-caption{position:absolute;z-index:4;left:1.5rem;right:1.5rem;bottom:1.4rem;display:flex;align-items:center;justify-content:space-between;gap:1rem}
  .vt-caption strong{display:block;font-family:var(--font-display);font-size:1.25rem;font-weight:800;color:#fff;text-shadow:0 2px 14px rgba(4,14,28,.5)}
  .vt-caption span{font-size:.74rem;color:rgba(255,255,255,.78);font-weight:600;letter-spacing:.04em}
  .vt-caption .vt-cam{display:inline-flex;align-items:center;gap:.45rem;padding:.45rem .8rem;border-radius:99px;
    background:rgba(7,22,42,.5);border:1px solid rgba(255,255,255,.28);color:#ffd54a;font-size:.68rem;font-weight:800;letter-spacing:.12em}
  /* Kartu info melayang (sedikit menutupi foto, gaya editorial) */
  .vt-chip{position:absolute;z-index:4;right:-18px;bottom:56px;background:#0d3a66;color:#fff;border-radius:16px;
    padding:.85rem 1.1rem;box-shadow:0 18px 44px rgba(13,58,102,.38);border:1px solid rgba(255,255,255,.12);
    display:flex;align-items:center;gap:.8rem;animation:hdFadeUp .8s .35s var(--ease) both}
  .vt-chip i{font-size:1.3rem;color:#ffb300}
  .vt-chip strong{display:block;font-size:.95rem;line-height:1.2}
  .vt-chip span{font-size:.68rem;color:rgba(255,255,255,.72);font-weight:600;letter-spacing:.06em}

  /* ---- KANAN: teks ---- */
  .vt-kicker{display:inline-flex;align-items:center;gap:.65rem;font-size:.74rem;font-weight:800;
    letter-spacing:.22em;text-transform:uppercase;color:#2f6fa8;margin-bottom:1rem}
  .vt-kicker::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#0d3a66,#2f6fa8)}
  .vt-title{font-family:var(--font-display);font-size:clamp(2.2rem,4.6vw,3.9rem);font-weight:800;font-style:normal;
    line-height:1.06;letter-spacing:.01em;color:#0d3a66;text-transform:uppercase;margin:0 0 1.1rem;
    text-shadow:0 2px 10px rgba(13,58,102,.06)}
  .vt-title .vt-gold{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);
    -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
  .vt-sub{display:block;font-size:.78rem;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#f9a825;margin-top:.4rem}
  .vt-desc{font-size:1.02rem;line-height:1.85;color:#44576e;max-width:520px;margin:0 0 2rem}
  .vt-feats{display:flex;flex-wrap:wrap;gap:.7rem;margin-bottom:2.2rem}
  .vt-feat{display:inline-flex;align-items:center;gap:.5rem;padding:.55rem .9rem;border:1px solid rgba(13,58,102,.16);
    background:#fff;border-radius:999px;font-size:.76rem;font-weight:700;color:#1d4b7a;box-shadow:0 4px 14px rgba(13,58,102,.06)}
  .vt-feat i{color:#f9a825;font-size:.82rem}
  .vt-btn{display:inline-flex;align-items:center;gap:.7rem;padding:1rem 2.15rem;border-radius:12px;border:0;cursor:pointer;
    font-family:var(--font-body);font-size:.9rem;font-weight:800;letter-spacing:.06em;text-transform:uppercase;text-decoration:none;
    color:#fff;background:linear-gradient(135deg,#f9a825,#f08c00);box-shadow:0 14px 34px rgba(249,168,37,.38);
    transition:transform .35s var(--ease),box-shadow .35s var(--ease)}
  .vt-btn i{font-size:.85rem;transition:transform .35s var(--ease)}
  .vt-btn:hover{transform:translateY(-3px);box-shadow:0 20px 46px rgba(249,168,37,.48)}
  .vt-btn:hover i{transform:translateX(5px)}

  /* ---- Responsive: tablet ---- */
  @media(max-width:1024px){
    .vt-inner{grid-template-columns:minmax(0,1fr) minmax(320px,.9fr);gap:2.4rem}
    .vt-frame img{height:clamp(300px,46vw,480px)}
    .vt-chip{right:10px;bottom:44px;padding:.7rem .9rem}
    .vt-chip i{font-size:1.1rem}
    .vt-title{font-size:clamp(1.9rem,4vw,2.9rem)}
  }
  @media(max-width:820px){
    .vt-inner{grid-template-columns:1fr;gap:2.6rem}
    .vt-media{order:1}
    .vt-copy{order:2;text-align:left}
    .vt-frame img{height:clamp(280px,62vw,420px)}
    .vt-chip{right:14px;bottom:40px}
    .vt-decor-dots{right:4%;bottom:4%}
  }
  @media(max-width:600px){
    .vt-section{padding:3.6rem 0}
    .vt-inner{width:min(100% - 2.2rem,92%)}
    .vt-frame img{height:250px}
    .vt-play{width:62px;height:62px;font-size:1.15rem}
    .vt-badge{top:1rem;left:1rem;padding:.42rem .8rem;font-size:.64rem}
    .vt-caption{left:1.1rem;right:1.1rem;bottom:1.1rem}
    .vt-caption strong{font-size:1.05rem}
    .vt-chip{position:static;margin-top:1rem;width:100%;border-radius:14px}
    .vt-title{font-size:clamp(1.7rem,8vw,2.3rem)}
    .vt-desc{font-size:.95rem;line-height:1.75}
    .vt-feats{gap:.55rem}
    .vt-feat{font-size:.7rem;padding:.48rem .75rem}
    .vt-btn{width:100%;justify-content:center}
  }

  /* -------- RESPONSIVE -------- */
  @media(max-width:900px){
    .hd-hero{min-height:100svh;background-position:70% center}
    .hd-hero-inner{max-width:100%;padding:clamp(5.5rem,12vh,6.5rem) 1.3rem 4.5rem}
    .hd-title{font-size:clamp(2.6rem,10vw,3.9rem)}
    .hd-hero-copy{max-width:600px}
  }
  @media(max-width:600px){
    .hd-hero{background-position:72% center}
    .hd-hero-inner{padding:5.5rem 1.1rem 3.5rem}
    .hd-actions{gap:1rem}
    .hd-btn{width:100%;justify-content:center}
    .hd-intro-skip{bottom:24px;right:20px;padding:.58rem 1.1rem;font-size:.8rem}
    .hd-hero-bgtype{gap:.4rem;transform:translateY(5%)}
  }

</style>

<!-- ===== INTRO VIDEO FULLSCREEN ===== -->
<div class="hd-intro" id="hdIntro" aria-hidden="true">
  <video id="hdIntroVideo" autoplay muted playsinline preload="auto">
    <source src="{{ asset('images/videos/video-sekolah.mp4') }}" type="video/mp4">
  </video>
  <button class="hd-intro-skip" id="hdIntroSkip" type="button">
    Lewati Intro <i class="fa-solid fa-chevron-right"></i>
  </button>
</div>

<!-- ===== HERO UTAMA (foto sekolah = background fullscreen) ===== -->
<section class="hd-hero" id="home" aria-label="Beranda">
  <div class="hd-hero-inner">
    <div class="hd-hero-copy">
      <div class="hd-eyebrow">Disiplin, Berprestasi</div>
      <h1 class="hd-title">SMKN <span class="hd-num">2</span><br><span class="hd-line-sub">MOJOKERTO</span></h1>
      <p class="hd-desc">Mewujudkan pendidikan vokasi yang unggul, berkarakter, dan siap menghadapi masa depan.</p>
      <div class="hd-actions">
        <a href="#lulusan-terbaik" class="hd-btn hd-btn-primary">Jelajahi Sekolah <i class="fa-solid fa-arrow-right"></i></a>
        <a href="#virtual-tour" class="hd-btn hd-btn-vt"><span class="vt-pulse" aria-hidden="true"></span> Virtual Tour 360° <i class="fa-solid fa-street-view"></i></a>
      </div>
    </div>
  </div>
</section>

<!-- ===== SECTION VIRTUAL TOUR 360° — JELAJAHI SMKN 2 MOJOKERTO ===== -->
<section class="vt-section" id="virtual-tour" aria-label="Virtual Tour 360 SMK Negeri 2 Mojokerto">
  <span class="vt-watermark" aria-hidden="true">360°</span>
  <div class="vt-decor-ring" aria-hidden="true"></div>
  <div class="vt-decor-dots" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div>

  <div class="vt-inner">
    <!-- KIRI: preview foto sekolah sebagai pintu masuk Virtual Tour -->
    <div class="vt-media" data-reveal="left">
      <div class="vt-frame">
        <img src="{{ asset('images/hero-sekolah.jpg') }}" alt="Lingkungan SMK Negeri 2 Mojokerto — Virtual Tour 360 derajat" loading="lazy">
        <span class="vt-badge"><i class="fa-solid fa-street-view"></i> 360° Tour</span>
        <button class="vt-play" type="button" aria-label="Mulai Virtual Tour 360 derajat" onclick="document.getElementById('vtTourLink')?.click()">
          <i class="fa-solid fa-play"></i>
        </button>
        <div class="vt-caption">
          <div>
            <strong>Jelajahi Sekolah</strong>
            <span>Kampus SMK Negeri 2 Mojokerto</span>
          </div>
          <span class="vt-cam"><i class="fa-solid fa-camera"></i> 360°</span>
        </div>
      </div>
      <div class="vt-chip">
        <i class="fa-solid fa-compass"></i>
        <div><strong>Virtual Tour 360°</strong><span>Interactive Campus Experience</span></div>
      </div>
    </div>

    <!-- KANAN: heading, deskripsi, tombol -->
    <div class="vt-copy">
      <div class="vt-kicker" data-reveal style="--d:0">Virtual Experience</div>
      <h2 class="vt-title" data-reveal style="--d:1">Jelajahi <span class="vt-gold">SMKN 2 Mojokerto</span><span class="vt-sub">Lihat Virtual Tour 360°</span></h2>
      <p class="vt-desc" data-reveal style="--d:2">Jelajahi lingkungan SMK Negeri 2 Mojokerto secara interaktif melalui Virtual Tour 360°. Rasakan suasana kampus dari sudut pandangmu — laboratorium, ruang kelas, bengkel, dan fasilitas unggulan lainnya.</p>
      <div class="vt-feats" data-reveal style="--d:3">
        <span class="vt-feat"><i class="fa-solid fa-check"></i> Interaktif</span>
        <span class="vt-feat"><i class="fa-solid fa-check"></i> Panorama 360°</span>
        <span class="vt-feat"><i class="fa-solid fa-check"></i> Akses Mudah</span>
      </div>
      <a href="#" id="vtTourLink" class="vt-btn" data-reveal style="--d:4">Mulai Tour <i class="fa-solid fa-arrow-right"></i></a>
    </div>
  </div>
</section>


<style>
/* ===== KEPALA SEKOLAH — POLISHED PRINCIPAL SECTION ===== */
.window-section{
  position:relative;
  background:#f7f9fc;
  color:#0d2d50;
  padding:82px 0 92px;
  overflow:hidden;
}
.window-section::before{
  content:"";
  position:absolute;
  width:420px;height:420px;
  left:-250px;top:70px;
  border:1px solid rgba(255,179,0,.42);
  border-radius:50%;
  box-shadow:0 0 0 22px rgba(255,179,0,.05),0 0 0 44px rgba(13,58,102,.035);
  pointer-events:none;z-index:0;
}
.window-section::after{
  content:"";
  position:absolute;
  right:-85px;bottom:-120px;
  width:310px;height:310px;
  border:1px solid rgba(13,58,102,.18);
  border-radius:50%;
  box-shadow:0 0 0 24px rgba(13,58,102,.035),0 0 0 48px rgba(255,179,0,.045);
  pointer-events:none;z-index:0;
}
.window-bg{opacity:.035!important;filter:none!important;background-image:none!important}
.window-section .container{position:relative;z-index:2}
.window-section .section-header{position:relative;max-width:780px;margin-left:auto;margin-right:auto}
.window-section .section-header::after{
  content:"";
  display:block;
  width:56px;height:4px;
  margin:18px auto 0;
  border-radius:99px;
  background:#ffb300;
}
.window-section .section-label{
  color:#ff9f00!important;
  letter-spacing:.22em;
  font-weight:800;
}
.window-section .section-title{
  color:#102f51!important;
  font-family:var(--font-display);
  font-size:clamp(2.5rem,5vw,4.3rem)!important;
  line-height:.98;
  text-transform:uppercase;
  letter-spacing:.015em;
  margin-top:.35rem;
}
.window-section .section-title .accent{
  color:#ffb300!important;
  background:none!important;
  -webkit-text-fill-color:#ffb300!important;
}
.window-section .section-desc{display:none!important}
.window-stage{
  max-width:1180px;
  margin:3rem auto 0;
}
.window-stage::before{
  content:"";
  position:absolute;
  left:-34px;top:24px;
  width:74px;height:74px;
  border:2px solid rgba(255,179,0,.45);
  border-radius:18px;
  transform:rotate(45deg);
  pointer-events:none;
}
.window-stage::after{
  content:"";
  position:absolute;
  right:-24px;bottom:20px;
  width:92px;height:92px;
  border:1px dashed rgba(13,58,102,.28);
  border-radius:50%;
  pointer-events:none;
}
.window-frame{
  min-height:500px;
  aspect-ratio:2.15/1;
  border-radius:26px;
  background:#082b4e;
  border:1px solid rgba(255,255,255,.22);
  outline:1px solid rgba(255,179,0,.52);
  outline-offset:7px;
  box-shadow:0 28px 70px rgba(13,45,80,.22),0 8px 22px rgba(13,45,80,.10);
}
.window-scene{
  background:linear-gradient(135deg,#092c50 0%,#0d4778 58%,#115d91 100%);
}
.ws-inner{
  grid-template-columns:minmax(280px,31%) 1fr;
  gap:3rem;
  padding:3.2rem 4rem;
}
.ws-photo-frame{
  width:min(250px,88%);
  border-radius:18px;
  padding:8px;
  background:linear-gradient(145deg,rgba(255,255,255,.14),rgba(255,255,255,.025));
  border:1px solid rgba(255,179,0,.72);
  box-shadow:0 24px 50px rgba(0,0,0,.28),0 0 0 7px rgba(255,255,255,.035);
}
.ws-photo-frame::before{border-radius:11px;border-color:rgba(255,255,255,.2)}
.ws-photo-cap{font-size:1.05rem;margin-top:.1rem}
.ws-photo-role{color:#ffd45a}
.ws-kicker{color:#ffd45a;letter-spacing:.25em}
.ws-welcome{font-size:clamp(2rem,3.8vw,3.25rem);line-height:1.02}
.ws-quote{
  color:#ffd45a;
  border-left:3px solid #ffb300;
  background:rgba(255,179,0,.07);
  border-radius:0 12px 12px 0;
  padding:.9rem 1.15rem;
  max-width:650px;
}
.ws-msg{font-size:.94rem;line-height:1.85;max-width:62ch}
.ws-sign{border-top-color:rgba(255,255,255,.2)}
.ws-sign-role{color:#ffd45a}
.window-knock{
  background:linear-gradient(135deg,rgba(5,27,48,.82),rgba(8,42,74,.76));
}
/* Closed state: only the principal photo and Open Message remain. */
.window-knock .wk-label,
.window-knock .wk-title{display:none!important}
.window-knock{gap:1.15rem}
.window-knock .wk-silhouette{margin-bottom:.2rem}
.window-knock .wk-btn{margin-top:.15rem}
.wk-label{color:#ffd45a}
.wk-title{font-family:var(--font-display);font-size:clamp(2.2rem,4.5vw,4rem);line-height:.98;letter-spacing:.01em}
.wk-btn{
  background:#ffb300!important;
  color:#092c50!important;
  border-color:rgba(255,255,255,.35)!important;
  box-shadow:0 12px 28px rgba(255,179,0,.25)!important;
}
.wk-btn:hover{background:#ffc43d!important}
.ws-close{background:#ffb300!important;color:#092c50!important}

@media(max-width:900px){
  .window-section{padding:68px 0 76px}
  .window-frame{min-height:620px;aspect-ratio:auto}
  .ws-inner{grid-template-columns:1fr;gap:1.5rem;padding:2.4rem 2rem;text-align:center;overflow:auto}
  .ws-left{gap:.45rem}
  .ws-photo-frame{width:180px}
  .ws-right{text-align:center}
  .ws-kicker{justify-content:center}
  .ws-quote{margin-left:auto;margin-right:auto;text-align:left}
  .ws-sign{text-align:center}
  .window-stage::before{left:-16px;top:12px;width:48px;height:48px}
  .window-stage::after{right:-10px;bottom:10px;width:60px;height:60px}
}
@media(max-width:600px){
  .window-section{padding:58px 0 64px}
  .window-section .section-title{font-size:clamp(2.1rem,10vw,3rem)!important}
  .window-stage{margin-top:2.2rem}
  .window-frame{min-height:650px;border-radius:20px;outline-offset:5px}
  .ws-inner{padding:2rem 1.2rem 3.5rem}
  .ws-photo-frame{width:155px}
  .ws-welcome{font-size:2rem}
  .ws-msg{font-size:.82rem;line-height:1.7}
  .ws-quote{font-size:.9rem}
  .wk-title{font-size:2.4rem}
}

  /* ===== ORNAMEN KHUSUS SAMBUTAN KEPALA SEKOLAH — desain baru, ringan ===== */
  .principal-section-ornament{position:absolute;pointer-events:none;z-index:1;opacity:.78}

  /* kiri: orbit arc + garis pendek, bukan pola lingkaran seperti section lain */
  .principal-section-ornament-left{left:-72px;top:145px;width:210px;height:210px;border:1px solid rgba(13,58,102,.16);border-right-color:transparent;border-bottom-color:transparent;border-radius:50%;transform:rotate(-28deg)}
  .principal-section-ornament-left::before{content:"";position:absolute;left:30px;top:30px;width:150px;height:150px;border:1px solid rgba(255,179,0,.48);border-left-color:transparent;border-bottom-color:transparent;border-radius:50%;transform:rotate(18deg)}
  .principal-section-ornament-left::after{content:"";position:absolute;width:48px;height:6px;left:130px;top:27px;background:linear-gradient(90deg,#0d3a66 0 58%,#ffb300 58% 100%);transform:rotate(22deg);border-radius:10px}
  .principal-section-ornament-left span{position:absolute;width:8px;height:8px;background:#FFB300;border-radius:50%;left:142px;top:104px}
  .principal-section-ornament-left i{position:absolute;width:18px;height:1px;background:#0d3a66;left:45px;bottom:37px;transform:rotate(-35deg)}
  .principal-section-ornament-left b{position:absolute;width:6px;height:6px;border:1px solid #FFB300;border-radius:50%;left:75px;bottom:28px}

  /* kanan: tiga sweep line + aksen kotak kecil */
  .principal-section-ornament-right{right:-45px;bottom:90px;width:220px;height:145px;transform:rotate(-7deg)}
  .principal-section-ornament-right::before{content:"";position:absolute;right:0;bottom:12px;width:185px;height:95px;border-top:1px solid rgba(13,58,102,.18);border-radius:55% 45% 0 0;transform:rotate(-8deg)}
  .principal-section-ornament-right::after{content:"";position:absolute;right:24px;bottom:30px;width:120px;height:65px;border-top:1px solid rgba(255,179,0,.55);border-radius:55% 45% 0 0;transform:rotate(-8deg)}
  .principal-section-ornament-right span{position:absolute;width:12px;height:12px;border:1px solid #0d3a66;right:70px;top:23px;transform:rotate(45deg)}
  .principal-section-ornament-right i{position:absolute;width:7px;height:7px;background:#FFB300;border-radius:50%;right:42px;bottom:68px}
  .principal-section-ornament-right b{position:absolute;width:34px;height:1px;background:#0d3a66;right:106px;top:49px;transform:rotate(-18deg)}

  /* Ornamen saat jendela terbuka: hanya aksen sudut agar isi tetap fokus */
  .window-frame{position:relative;overflow:hidden}
  .principal-open-ornament{position:absolute;z-index:1;pointer-events:none;opacity:.62}
  .principal-open-ornament-left{left:24px;top:25px;width:82px;height:82px;border-left:1px solid rgba(255,179,0,.7);border-top:1px solid rgba(255,179,0,.7);border-radius:14px 0 0 0}
  .principal-open-ornament-left::before{content:"";position:absolute;left:18px;top:18px;width:30px;height:1px;background:#0d3a66;transform:rotate(45deg)}
  .principal-open-ornament-left span{position:absolute;width:7px;height:7px;border-radius:50%;background:#FFB300;left:38px;top:38px}
  .principal-open-ornament-left i{position:absolute;width:16px;height:16px;border:1px solid rgba(13,58,102,.5);right:4px;bottom:4px;transform:rotate(45deg)}

  .principal-open-ornament-right{right:24px;bottom:26px;width:88px;height:68px}
  .principal-open-ornament-right::before{content:"";position:absolute;right:0;bottom:0;width:62px;height:1px;background:#FFB300;transform:rotate(-24deg)}
  .principal-open-ornament-right::after{content:"";position:absolute;right:12px;bottom:12px;width:38px;height:38px;border:1px solid rgba(255,179,0,.45);border-left-color:transparent;border-radius:50%}
  .principal-open-ornament-right span{position:absolute;width:6px;height:6px;background:#0d3a66;border-radius:50%;right:45px;bottom:31px}
  .principal-open-ornament-right i{position:absolute;width:18px;height:1px;background:rgba(13,58,102,.55);right:55px;bottom:48px;transform:rotate(20deg)}

  /* Open state: area luar tetap putih, box utama tetap navy */
  .window-section.open{background:#f7f9fc!important;color:#0d2d50!important}
  .window-section.open .window-bg{opacity:0!important}
  .window-section.open::before{background:none!important}
  .window-section.open::after{background:none!important}

  /* State tertutup: cukup foto + Open Message */
  .wk-title{display:none!important}
  .wk-label{color:#FFB300}
  .wk-silhouette{width:104px;height:104px}
  .wk-btn{margin-top:.2rem}

  @media(max-width:600px){
    .principal-section-ornament-left{left:-105px;top:165px;transform:scale(.68) rotate(-28deg)}
    .principal-section-ornament-right{right:-105px;bottom:75px;transform:scale(.68) rotate(-7deg)}
    .principal-open-ornament-left{left:12px;top:14px;transform:scale(.72)}
    .principal-open-ornament-right{right:12px;bottom:14px;transform:scale(.72)}
  }

/* ---------- ORNAMEN SAMBUTAN + JURUSAN: LEBIH TERLIHAT ---------- */

/* Sambutan */
.sambutan-section .sambutan-decor,
.sambutan .sambutan-decor,
.sambutan-decor{
  opacity:1 !important;
}
.sambutan-decor .sd-ring{
  stroke-width:3px !important;
  opacity:.42 !important;
}
.sambutan-decor .sd-dot{
  opacity:.58 !important;
}
.sambutan-decor .sd-line{
  stroke-width:2.4px !important;
  opacity:.46 !important;
}
.sambutan-decor .sd-line.soft{
  opacity:.28 !important;
}

/* Jurusan */
.jurusan-decor{
  opacity:1 !important;
}
.jurusan-decor .jd-diag{
  stroke-width:3px !important;
  opacity:.48 !important;
}
.jurusan-decor .jd-diag-soft{
  stroke-width:1.9px !important;
  opacity:.24 !important;
}
.jurusan-decor .jd-square{
  stroke-width:2.8px !important;
  opacity:.68 !important;
}
.jurusan-decor .jd-square-fill{
  opacity:.22 !important;
}
.jurusan-decor .jd-hex{
  stroke-width:2.8px !important;
  opacity:.34 !important;
}
.jurusan-decor .jd-node{
  opacity:.82 !important;
}
.jurusan-decor .jd-plus{
  stroke-width:2.8px !important;
  opacity:.42 !important;
}
.jurusan-decor .jd-corner{
  stroke-width:4px !important;
  opacity:.52 !important;
}
.jurusan-decor .jd-grid{
  stroke-width:1.5px !important;
  opacity:.15 !important;
}

@media(max-width:640px){
  .sambutan-decor,
  .jurusan-decor{
    opacity:1 !important;
  }
}


    /* ============ HOVER & ORNAMEN PREMIUM (hanya animasi, tanpa ubah layout) ============ */

    /* --- Foto: zoom halus di dalam wrapper overflow:hidden --- */
    .ws-photo-frame .ws-photo{transition:transform .7s cubic-bezier(.22,1,.36,1)}
    .window-frame:hover .ws-photo-frame .ws-photo{transform:scale(1.04)}

    /* --- Jendela Kepsek: tombol knock lift --- */
    .window-knock .wk-btn{transition:transform .35s cubic-bezier(.22,1,.36,1),box-shadow .35s ease,background-color .35s ease,color .35s ease}

    /* --- Misi: lift naik (bukan geser) agar konsisten premium --- */
    .misi-item{transition:transform .35s cubic-bezier(.22,1,.36,1),box-shadow .35s ease,border-color .35s ease,background-color .35s ease}
    .misi-item:hover{transform:translateY(-5px)}

    /* --- Kontak: kartu info lift halus (transform dipakai reveal -> pakai margin-top) --- */
    .ft-card{transition:margin-top .35s cubic-bezier(.22,1,.36,1),box-shadow .35s ease}
    .ft-card:hover{margin-top:-6px;box-shadow:0 32px 66px rgba(18,59,96,.34)}

    /* --- Ornamen: rotasi/float/pulse sangat halus --- */
    .jurusan-decor .jd-square{animation:ornSpinSlow 90s linear infinite;transform-origin:center}
    .jurusan-decor .jd-square-fill{animation:ornPulseSoft 6s ease-in-out infinite}
    .jurusan-decor .jd-ring{animation:ornSpinSlow 70s linear infinite;transform-origin:center}
    .window-section::before,.window-section::after{animation:ornPulseSoft 9s ease-in-out infinite}

</style>

<!-- ================= JENDELA KEPALA SEKOLAH (corporate glass window) ================= -->
<section class="window-section" id="sambutan">
  <div class="window-bg"></div>
  <div class="principal-section-ornament principal-section-ornament-left" aria-hidden="true"><span></span><i></i><b></b></div>
  <div class="principal-section-ornament principal-section-ornament-right" aria-hidden="true"><span></span><i></i><b></b></div>
  <div class="container">
    <div class="section-header center" data-reveal="title" style="margin-bottom:1.2rem">
      <div class="section-label">Pesan Pimpinan</div>
      <h2 class="section-title">Sambutan <span class="accent">Sekolah</span></h2>
    </div>

    <div class="window-stage" data-reveal style="--d:2">
      <div class="window-frame" id="kepsekWindow">
        <!-- Ornamen minimal saat jendela terbuka -->
        <div class="principal-open-ornament principal-open-ornament-left" aria-hidden="true"><span></span><i></i></div>
        <div class="principal-open-ornament principal-open-ornament-right" aria-hidden="true"><span></span><i></i></div>
        <!-- INTERIOR: isi sambutan (terlihat setelah jendela terbuka) -->
        <div class="window-scene">
          <div class="ws-inner">
            <div class="ws-left">
              <div class="ws-photo-frame">
                <img class="ws-photo" src="{{ asset('images/pak-is.jpeg') }}" alt="Kepala Sekolah" loading="lazy" />
              </div>
              <div class="ws-photo-cap">Iswahyudi, S.ST. M.Pd</div>
              <div class="ws-photo-role">Kepala SMK Negeri <span class="num-2">2</span> Mojokerto</div>
            </div>
            <div class="ws-right">
              <div class="ws-kicker"><span class="ws-kicker-line"></span>Welcome Message</div>
              <div class="ws-welcome">Sambutan Kepala Sekolah</div>
              <div class="ws-quote">&ldquo;Satu langkah hari ini lebih berharga dari pada seribu rencana yang di tunda.&rdquo;</div>
              <p class="ws-msg">Assalamu&rsquo;alaikum warahmatullahi wabarakatuh. Selamat datang di website resmi SMK Negeri 2 Mojokerto. Kami berkomitmen mencetak generasi vokasi yang kompeten, berkarakter, dan siap bersaing di dunia industri global. Bersama seluruh civitas akademika, kami terus berinovasi demi masa depan pendidikan vokasi yang lebih baik.</p>
              <div class="ws-sign">
                <div class="ws-sign-name">Iswahyudi, S.ST. M.Pd</div>
                <div class="ws-sign-role">Kepala SMK Negeri <span class="num-2">2</span> Mojokerto</div>
              </div>
            </div>
          </div>
        </div>

        <!-- KACA JENDELA -->
        <div class="window-glass left">
          <div class="window-pane-glass"></div>
        </div>
        <div class="window-glass right">
          <div class="window-pane-glass"></div>
        </div>

        <!-- STATE TERTUTUP: FROM THE PRINCIPAL'S OFFICE -->
        <div class="window-knock">
          <div class="wk-label">From The Principal&rsquo;s Office</div>
          <div class="wk-title">Sambutan<br />Kepala Sekolah</div>
          <div class="wk-silhouette"><img src="{{ asset('images/pak-is.jpeg') }}" alt="" loading="lazy" /></div>
          <button class="wk-btn" id="kepsekKnockBtn">[ Open Message ] <i class="fas fa-arrow-right"></i></button>
        </div>

        <!-- CAHAYA MASUK -->
        <div class="ws-glow"></div>

        <button class="ws-close" id="kepsekCloseBtn"><i class="fas fa-times"></i> Tutup Jendela</button>
      </div>
    </div>
  </div>
</section>
<!-- ================= JURUSAN SECTION ================= -->
<section class="jurusan-section section-py" id="jurusan">
  <!-- Dekor: lingkaran oranye tipis (kiri atas), titik (kanan atas), garis lengkung (kanan bawah) -->
  <div class="jurusan-decor" aria-hidden="true">
    <svg viewBox="0 0 1440 760" preserveAspectRatio="none">
      <!-- Pojok kiri: pola diagonal + kotak bertingkat -->
      <path class="jd-diag" d="M-40 130 L180 -20 M-20 190 L240 -20 M20 250 L300 -20"/>
      <rect class="jd-square" x="76" y="86" width="62" height="62" transform="rotate(45 107 117)"/>
      <rect class="jd-square-fill" x="88" y="98" width="38" height="38" transform="rotate(45 107 117)"/>
      <path class="jd-corner" d="M46 214 H82 M46 214 V250"/>
      <circle class="jd-node" cx="46" cy="214" r="4"/>

      <!-- Kanan atas: rangkaian node kotak -->
      <path class="jd-diag-soft" d="M1180 64 H1270 V118 H1362"/>
      <path class="jd-diag-soft" d="M1218 30 V92 H1310 V150 H1410"/>
      <rect class="jd-square" x="1260" y="108" width="18" height="18"/>
      <rect class="jd-square" x="1352" y="140" width="18" height="18"/>
      <circle class="jd-node" cx="1180" cy="64" r="4"/>
      <circle class="jd-node" cx="1410" cy="150" r="4"/>

      <!-- Tengah kiri: hexagon ringan -->
      <polygon class="jd-hex" points="88,390 116,374 144,390 144,422 116,438 88,422"/>
      <path class="jd-plus" d="M164 388 V414 M151 401 H177"/>
      <path class="jd-diag-soft" d="M42 466 H170 L220 416"/>

      <!-- Kanan bawah: komposisi geometris baru -->
      <polygon class="jd-hex" points="1280,590 1320,567 1360,590 1360,636 1320,659 1280,636"/>
      <rect class="jd-square-fill" x="1368" y="604" width="22" height="22"/>
      <rect class="jd-square" x="1398" y="574" width="30" height="30"/>
      <path class="jd-diag" d="M1190 716 L1270 636 L1340 706 M1230 760 L1310 680 L1380 750"/>
      <path class="jd-corner" d="M1134 664 H1172 M1134 664 V702"/>
      <circle class="jd-node" cx="1134" cy="664" r="4"/>

      <!-- Grid diagonal sangat tipis sebagai tekstur, bukan ornamen utama -->
      <path class="jd-grid" d="M0 560 L250 310 M0 600 L290 310 M1090 760 L1440 410 M1150 760 L1440 470"/>
    </svg>
  </div>
  <div class="container">
    <div class="section-header center" data-reveal>
      <div class="section-label">Program Keahlian</div>
      <h2 class="section-title">Jurusan <span class="accent">Unggulan</span></h2>
    </div>

    <div class="jurusan-carousel" data-reveal style="--d:2">
            <div class="carousel-stage" id="carouselStage" role="region" aria-label="Carousel jurusan unggulan">
        <!-- 01 APHP -->
        <article class="carousel-card" data-index="0" tabindex="0" role="button" aria-label="Jurusan APHP">
          <div class="card-inner">
            <div class="cc-photo p-aphp">
              <img src="{{ asset('images/aphp.png') }}" alt="Siswa APHP SMK Negeri 2 Mojokerto" loading="lazy">
            </div>
            <div class="cc-body">
              <div class="cc-abbr">APHP</div>
              <div class="cc-full">Agribisnis Pengolahan Hasil Pertanian</div>
              <a href="{{ route('aphp') }}" class="cc-cta">Lihat Jurusan <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </article>
        <!-- 02 DKV -->
        <article class="carousel-card" data-index="1" tabindex="0" role="button" aria-label="Jurusan DKV">
          <div class="card-inner">
            <div class="cc-photo p-dkv">
              <img src="{{ asset('images/dkv.png') }}" alt="Siswa DKV SMK Negeri 2 Mojokerto" loading="lazy">
            </div>
            <div class="cc-body">
              <div class="cc-abbr">DKV</div>
              <div class="cc-full">Desain Komunikasi Visual</div>
              <a href="{{ route('dkv') }}" class="cc-cta">Lihat Jurusan <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </article>
        <!-- 03 KULINER -->
        <article class="carousel-card" data-index="2" tabindex="0" role="button" aria-label="Jurusan Kuliner">
          <div class="card-inner">
            <div class="cc-photo p-kuliner">
              <img src="{{ asset('images/kuliner.png') }}" alt="Siswa Kuliner SMK Negeri 2 Mojokerto" loading="lazy">
            </div>
            <div class="cc-body">
              <div class="cc-abbr">KULINER</div>
              <div class="cc-full">Kuliner</div>
              <a href="{{ route('kuliner') }}" class="cc-cta">Lihat Jurusan <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </article>
        <!-- 04 LPS -->
        <article class="carousel-card" data-index="3" tabindex="0" role="button" aria-label="Jurusan LPS">
          <div class="card-inner">
            <div class="cc-photo p-lps">
              <img src="{{ asset('images/lps.png') }}" alt="Siswa LPS SMK Negeri 2 Mojokerto" loading="lazy">
            </div>
            <div class="cc-body">
              <div class="cc-abbr">LPS</div>
              <div class="cc-full">Layanan Perbankan Syariah</div>
              <a href="{{ route('lps') }}" class="cc-cta">Lihat Jurusan <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </article>
        <!-- 05 RPL -->
        <article class="carousel-card" data-index="4" tabindex="0" role="button" aria-label="Jurusan RPL">
          <div class="card-inner">
            <div class="cc-photo p-rpl">
              <img src="{{ asset('images/rpl.png') }}" alt="Siswa RPL SMK Negeri 2 Mojokerto" loading="lazy">
            </div>
            <div class="cc-body">
              <div class="cc-abbr">RPL</div>
              <div class="cc-full">Rekayasa Perangkat Lunak</div>
              <a href="{{ route('rpl') }}" class="cc-cta">Lihat Jurusan <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </article>

        <button class="carousel-nav-btn" id="carouselPrev" aria-label="Jurusan sebelumnya"><i class="fas fa-chevron-left"></i></button>
        <button class="carousel-nav-btn" id="carouselNext" aria-label="Jurusan berikutnya"><i class="fas fa-chevron-right"></i></button>
      </div>

      <div class="carousel-nav">
        <div class="carousel-dots" id="carouselDots" aria-label="Pilih jurusan">
          <button class="carousel-dot" data-index="0" aria-label="Jurusan 1"></button>
          <button class="carousel-dot" data-index="1" aria-label="Jurusan 2"></button>
          <button class="carousel-dot active" data-index="2" aria-label="Jurusan 3"></button>
          <button class="carousel-dot" data-index="3" aria-label="Jurusan 4"></button>
          <button class="carousel-dot" data-index="4" aria-label="Jurusan 5"></button>
        </div>
      </div>
    </div>
  </div>
</section>







<style>
/* ============================================================
   SKANEDA OUTCOMES — 4 SECTION REDESIGN
   Hanya mengganti tampilan Lulusan Terbaik / Kerja Sama Industri /
   Lulusan PTN / Prestasi. Header, footer, hero, virtual tour,
   sambutan, jurusan, dan konten/data yang sudah ada tidak disentuh.
   ============================================================ */
.out-page{position:relative;overflow:hidden}
.out-sec{position:relative;overflow:hidden;padding:clamp(4.8rem,8vw,7rem) 0}
.out-wrap{width:min(1180px,92%);margin:0 auto;position:relative;z-index:2}
.out-kicker{display:inline-flex;align-items:center;gap:.65rem;color:#f6a900;font-size:.72rem;font-weight:900;letter-spacing:.22em;text-transform:uppercase;margin-bottom:.8rem}
.out-kicker::before{content:"";width:34px;height:3px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ff9d00)}
.out-title{font-family:var(--font-display);font-size:clamp(2.5rem,5vw,4.4rem);line-height:.98;font-weight:900;color:#0d3a66;letter-spacing:.01em;margin:0 0 1rem;text-transform:uppercase}
.out-title .gold{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
.out-desc{max-width:650px;color:#617389;font-size:.98rem;line-height:1.8;margin:0}
.out-orn{position:absolute;inset:0;pointer-events:none;z-index:0;overflow:hidden}
.out-orn::before{content:"";position:absolute;width:240px;height:240px;border:1px solid rgba(13,58,102,.11);border-radius:50%;left:-115px;top:8%}
.out-orn::after{content:"";position:absolute;width:150px;height:150px;border:1px solid rgba(255,179,0,.24);border-radius:50%;right:-70px;bottom:10%}
.out-dots{position:absolute;width:72px;height:72px;right:8%;top:12%;background-image:radial-gradient(circle,rgba(13,58,102,.16) 2px,transparent 2.5px);background-size:14px 14px;opacity:.7}
.out-diamond{position:absolute;width:48px;height:48px;border:1.5px solid rgba(255,179,0,.45);transform:rotate(45deg);left:7%;bottom:12%}

/* ---------- LULUSAN TERBAIK — ID CARD SWIPER ---------- */
.out-alumni{background:#fff}
.out-alumni-head{display:grid;grid-template-columns:minmax(280px,.82fr) minmax(420px,1.18fr);gap:clamp(2rem,5vw,5rem);align-items:center}
.out-jurusan-filter{margin:0 0 1rem;padding:.85rem 1rem 1rem;border:1px solid rgba(13,58,102,.10);border-radius:20px;background:rgba(255,255,255,.9);box-shadow:0 12px 30px rgba(13,58,102,.07);position:relative;z-index:3}
.out-jurusan-label{display:flex;align-items:baseline;justify-content:space-between;gap:1rem;margin:0 0 .65rem;padding:0 .15rem}
.out-jurusan-label span{font-size:.68rem;font-weight:950;letter-spacing:.2em;color:#0d3a66}
.out-jurusan-label small{font-size:.62rem;color:#8b99a8;font-weight:700}
.out-jurusan-list{display:flex;gap:.55rem;flex-wrap:wrap}
.out-jurusan-pill{appearance:none;border:1px solid rgba(13,58,102,.13);background:#f7f9fb;color:#31506b;border-radius:999px;padding:.7rem 1.15rem;min-width:78px;font:inherit;font-size:.72rem;font-weight:900;letter-spacing:.08em;cursor:pointer;transition:transform .22s ease,background .22s ease,color .22s ease,border-color .22s ease,box-shadow .22s ease}
.out-jurusan-pill:hover{transform:translateY(-2px);background:#fff;border-color:rgba(255,179,0,.55);box-shadow:0 8px 18px rgba(13,58,102,.08)}
.out-jurusan-pill.active{background:linear-gradient(135deg,#0d3a66,#174f82);color:#fff;border-color:#0d3a66;box-shadow:0 8px 20px rgba(13,58,102,.18)}
.out-id-stage{position:relative;min-width:0}
.out-id-viewport{position:relative;overflow:hidden;border-radius:28px;padding:8px;margin:0 auto;max-width:690px;background:linear-gradient(135deg,rgba(13,58,102,.08),rgba(255,179,0,.09));box-shadow:0 22px 60px rgba(13,58,102,.12)}
.out-id-track{display:flex;transition:transform .6s cubic-bezier(.22,1,.36,1);touch-action:pan-y;cursor:grab}
.out-id-track.dragging{transition:none;cursor:grabbing}
.out-id-slide{flex:0 0 100%;padding:0}
.out-id-card{position:relative;min-height:330px;border-radius:23px;overflow:hidden;background:#fff;border:1px solid rgba(13,58,102,.12);box-shadow:0 18px 46px rgba(13,58,102,.14);display:grid;grid-template-columns:39% 61%}
.out-id-card::before{content:"";position:absolute;left:0;right:0;top:0;height:9px;background:linear-gradient(90deg,#0b3157,#0d5b8f 55%,#ffb300)}
.out-id-photo{position:relative;margin:1.35rem 0 1.35rem 1.35rem;border-radius:17px;overflow:hidden;background:linear-gradient(160deg,#dbe8f3,#eef4f9);min-height:270px;border:1px solid rgba(13,58,102,.1)}
.out-id-photo img{width:100%;height:100%;object-fit:cover;display:block}
.out-id-photo .placeholder{height:100%;min-height:270px;display:grid;place-items:center;color:#0d3a66;font-size:.7rem;font-weight:900;letter-spacing:.14em;text-transform:uppercase;text-align:center;padding:1rem}
.out-id-photo::after{content:"";position:absolute;inset:10px;border:1px solid rgba(255,255,255,.65);border-radius:12px;pointer-events:none}
.out-id-info{padding:1.55rem 1.55rem 1.35rem 1.45rem;display:flex;flex-direction:column;justify-content:center;position:relative}
.out-id-brand{display:flex;align-items:center;gap:.55rem;color:#0d3a66;font-size:.74rem;font-weight:900;letter-spacing:.12em;text-transform:uppercase;margin-bottom:1.2rem}
.out-id-brand img{width:30px;height:30px;object-fit:contain;border-radius:50%;background:#fff}
.out-id-code{position:absolute;right:1.25rem;top:1.25rem;font-size:.6rem;font-weight:900;letter-spacing:.16em;color:#9aa9b9}
.out-id-name{font-family:var(--font-display);font-size:clamp(1.3rem,2.1vw,1.85rem);line-height:1.06;color:#0d3a66;font-weight:900;margin:0 0 .45rem}
.out-id-role{color:#ff9f00;font-size:.7rem;font-weight:900;letter-spacing:.12em;text-transform:uppercase;margin-bottom:1.05rem}
.out-id-line{height:1px;background:linear-gradient(90deg,#ffb300,rgba(13,58,102,.08));margin-bottom:1rem}
.out-id-meta{display:grid;grid-template-columns:1fr 1fr;gap:.65rem}
.out-id-meta div{background:#f6f9fc;border:1px solid rgba(13,58,102,.08);border-radius:11px;padding:.62rem .7rem}
.out-id-meta small{display:block;color:#8a99aa;font-size:.55rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;margin-bottom:.2rem}
.out-id-meta b{display:block;color:#183e63;font-size:.72rem;line-height:1.35}
.out-id-footer{display:flex;align-items:center;justify-content:space-between;gap:.7rem;margin-top:auto;padding-top:1rem}
.out-id-chip{display:inline-flex;align-items:center;gap:.4rem;border-radius:99px;padding:.42rem .7rem;background:#fff4cf;color:#9b6900;font-size:.62rem;font-weight:900}
.out-id-barcode{width:92px;height:25px;opacity:.5;background:repeating-linear-gradient(90deg,#0d3a66 0 2px,transparent 2px 4px,#0d3a66 4px 5px,transparent 5px 8px)}
.out-slider-controls{display:flex;align-items:center;justify-content:center;gap:1rem;margin-top:1rem}
.out-arrow{width:44px;height:44px;border-radius:50%;border:1px solid rgba(13,58,102,.14);background:#fff;color:#0d3a66;display:grid;place-items:center;cursor:pointer;box-shadow:0 8px 22px rgba(13,58,102,.1);transition:.25s ease}
.out-arrow:hover{background:#0d3a66;color:#fff;transform:translateY(-2px)}
.out-dots{position:static;width:auto;height:auto;display:flex;gap:.45rem;background:none;opacity:1}
.out-dot{width:8px;height:8px;border:0;border-radius:99px;background:#d4deea;padding:0;cursor:pointer;transition:.25s ease}
.out-dot.active{width:25px;background:linear-gradient(90deg,#ffb300,#ff7a00)}

/* ---------- INDUSTRI — AUTO LOGO MARQUEE ---------- */
.out-industry{background:#fff}

/* Ornamen INDUSTRI dibuat SAMA dengan ornamen section JURUSAN */
.industry-jurusan-decor{position:absolute;inset:0;z-index:0;pointer-events:none;overflow:hidden}
.industry-jurusan-decor svg{position:absolute;inset:0;width:100%;height:100%;display:block}
.industry-jurusan-decor .jd-diag{stroke-width:3px;opacity:.48}
.industry-jurusan-decor .jd-diag-soft{stroke-width:1.9px;opacity:.24}
.industry-jurusan-decor .jd-square{stroke-width:2.8px;opacity:.68}
.industry-jurusan-decor .jd-square-fill{opacity:.22}
.industry-jurusan-decor .jd-hex{stroke-width:2.8px;opacity:.34}
.industry-jurusan-decor .jd-node{opacity:.82}
.industry-jurusan-decor .jd-plus{stroke-width:2.8px;opacity:.42}
.industry-jurusan-decor .jd-corner{stroke-width:4px;opacity:.52}
.industry-jurusan-decor .jd-grid{stroke-width:1.5px;opacity:.15}

.out-center{text-align:center;max-width:760px;margin:0 auto}
.out-center .out-desc{margin:0 auto}
.out-logo-window{position:relative;overflow:hidden;margin-top:2.8rem;padding:1rem 0}
.out-logo-window::before,.out-logo-window::after{content:"";position:absolute;z-index:3;top:0;bottom:0;width:120px;pointer-events:none}
.out-logo-window::before{left:0;background:linear-gradient(90deg,#fff,transparent)}
.out-logo-window::after{right:0;background:linear-gradient(270deg,#fff,transparent)}
.out-logo-track{display:flex;width:max-content;animation:outLogoMove 28s linear infinite}
.out-logo-window:hover .out-logo-track{animation-play-state:paused}
.out-logo-group{display:flex;gap:1.1rem;padding-right:1.1rem}

/* Logo partner: TANPA BOX/BG — hanya logo + shadow halus + informasi di bawah */
.out-logo-card{width:190px;height:120px;border-radius:0;background:transparent!important;border:0!important;box-shadow:none!important;display:flex;align-items:center;justify-content:center;flex:0 0 auto;transition:transform .3s ease,filter .3s ease;padding:0;margin:0}
.out-logo-card:hover{transform:translateY(-6px);filter:drop-shadow(0 14px 20px rgba(23,32,79,.18))}
.out-logo-only{width:150px;height:100px;display:block;object-fit:contain;object-position:center;background:transparent!important;border:0!important;border-radius:0!important;box-shadow:none!important;padding:0;margin:0}
@keyframes outLogoMove{from{transform:translateX(0)}to{transform:translateX(-50%)}}
.out-ind-pills{display:flex;flex-wrap:wrap;justify-content:center;gap:.7rem;margin-top:1.2rem}
.out-ind-pills span{display:inline-flex;align-items:center;gap:.45rem;padding:.62rem 1rem;background:#fff;border:1px solid rgba(13,58,102,.1);border-radius:99px;color:#17446c;font-size:.72rem;font-weight:800;box-shadow:0 6px 16px rgba(13,58,102,.05)}
.out-ind-pills i{color:#ffb300}
@media(max-width:640px){.industry-jurusan-decor{opacity:1}.out-logo-card{width:132px;height:100px}.out-logo-only{width:110px;height:80px}}

/* ---------- LULUSAN PTN — EDITORIAL UNIVERSITY DESTINATIONS ---------- */
.out-ptn{position:relative;background:#fff;overflow:hidden}
.out-ptn::before{content:"";position:absolute;inset:0;background:linear-gradient(135deg,rgba(13,58,102,.025) 1px,transparent 1px),linear-gradient(45deg,rgba(255,179,0,.018) 1px,transparent 1px);background-size:52px 52px;mask-image:linear-gradient(to bottom,transparent,#000 15%,#000 85%,transparent);pointer-events:none}
.out-ptn .out-orn{z-index:0}
.out-ptn-layout{position:relative;z-index:1;display:grid;grid-template-columns:280px minmax(0,1fr);gap:clamp(3rem,7vw,7rem);align-items:center}
.out-ptn .out-copy{position:relative;z-index:2}
.out-ptn .out-copy::after{content:"PTN";position:absolute;left:-.4rem;bottom:-4.5rem;font-family:var(--font-display);font-size:9rem;font-weight:900;line-height:1;color:rgba(13,58,102,.035);letter-spacing:.04em;pointer-events:none}
.out-ptn .out-route{display:none}
.out-ptn-window{position:relative;min-width:0;padding:1rem 0 .5rem}
.out-ptn-window::before{content:"";position:absolute;right:4%;top:-2rem;width:150px;height:150px;border:1px solid rgba(255,179,0,.24);transform:rotate(45deg);pointer-events:none}
.out-ptn-window::after{content:"NEXT DESTINATION";position:absolute;right:1%;bottom:-.3rem;color:rgba(13,58,102,.075);font-size:.55rem;font-weight:900;letter-spacing:.25em;pointer-events:none}
.out-ptn-track{position:relative;z-index:2;display:flex;transition:transform .6s cubic-bezier(.22,1,.36,1);touch-action:pan-y}
.out-ptn-slide{flex:0 0 100%;padding:1rem .2rem 2rem}
.out-ptn-destination-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:0;align-items:stretch}
.out-ptn-destination{position:relative;min-height:380px;padding:1.15rem 2rem 1rem;display:flex;flex-direction:column;align-items:center;text-align:center;background:transparent!important;border:0!important;border-radius:0!important;box-shadow:none!important;overflow:visible;transition:transform .35s ease}
.out-ptn-destination:not(:last-child)::after{content:"";position:absolute;right:0;top:12%;height:76%;width:1px;background:linear-gradient(to bottom,transparent,rgba(13,58,102,.16) 20%,rgba(255,179,0,.5) 50%,rgba(13,58,102,.16) 80%,transparent)}
.out-ptn-destination::before{content:"";position:absolute;top:0;left:50%;width:46px;height:3px;transform:translateX(-50%);background:#ffb300;border-radius:10px}
.out-ptn-destination:hover{transform:translateY(-7px)}
.out-ptn-number{font-size:.5rem;font-weight:900;letter-spacing:.2em;color:#9aa7b5;margin:.05rem 0 1rem}
.out-ptn-logo-wrap{display:flex;flex-direction:column;align-items:center;position:relative;margin-bottom:1.15rem}
.out-ptn-logo{width:142px;height:142px;display:grid;place-items:center;background:transparent!important;border:0!important;border-radius:0!important;box-shadow:none!important;position:relative;overflow:visible;color:#0d3a66;text-align:center;font-size:.62rem;font-weight:900;letter-spacing:.08em}
.out-ptn-logo::before{content:"";position:absolute;width:126px;height:126px;border-radius:50%;border:1px solid rgba(13,58,102,.12);box-shadow:0 15px 30px rgba(13,58,102,.1),0 0 0 8px rgba(255,179,0,.035);z-index:-1}
.out-ptn-logo::after{content:"";position:absolute;width:105px;height:105px;border-radius:50%;border:1px dashed rgba(255,179,0,.45);z-index:-1}
.out-ptn-logo i{font-size:2.35rem;color:#ffb300;display:block;margin-bottom:.35rem}
.out-ptn-logo span{display:block;position:relative;z-index:1;color:#0d3a66;font-size:.6rem}
.out-ptn-logo-caption{font-size:.47rem;font-weight:900;letter-spacing:.15em;text-transform:uppercase;color:#9aa7b5;margin-top:.15rem}
.out-ptn-info{width:100%;position:relative;z-index:1}
.out-ptn-university{font-family:var(--font-display);font-size:clamp(1.05rem,1.5vw,1.35rem);font-weight:900;line-height:1.12;color:#0d3a66;margin:0 0 .7rem}
.out-ptn-status{display:none}
.out-ptn-students{width:100%;border-top:1px solid rgba(13,58,102,.1);padding-top:.8rem}
.out-ptn-students-label{font-size:.48rem;font-weight:900;letter-spacing:.16em;text-transform:uppercase;color:#ffb300;margin-bottom:.55rem}
.out-ptn-student-list{display:flex;flex-direction:column;gap:.28rem;align-items:center}
.out-ptn-student{display:block;width:100%;padding:.12rem .2rem;background:transparent!important;color:#315775;font-size:.67rem;font-weight:800;line-height:1.4;border:0!important}
.out-ptn-student i{color:#ffb300;margin-right:.25rem;font-size:.42rem}
.out-ptn-program{display:none}
.out-ptn .out-slider-controls{display:flex;justify-content:center;align-items:center;gap:1rem;margin-top:.2rem}
.out-ptn .out-arrow{width:44px;height:44px;border-radius:50%;border:1px solid rgba(13,58,102,.12);background:#fff;color:#0d3a66;box-shadow:0 10px 24px rgba(13,58,102,.09);cursor:pointer;transition:.25s ease}
.out-ptn .out-arrow:hover{background:#ffb300;color:#0d3a66;transform:translateY(-2px)}
.out-ptn .out-dots{display:flex;align-items:center;gap:.45rem}
.out-ptn .out-dot{width:7px;height:7px;padding:0;border:0;border-radius:50%;background:#c8d0d8;cursor:pointer;transition:.25s ease}
.out-ptn .out-dot.active{width:24px;border-radius:10px;background:#ffb300}
@media(max-width:960px){.out-ptn-layout{grid-template-columns:1fr;gap:2rem}.out-ptn-layout .out-copy{max-width:760px}.out-ptn-window{max-width:1000px}}
@media(max-width:700px){.out-ptn-destination-grid{grid-template-columns:repeat(2,1fr)}.out-ptn-destination{min-height:330px;padding-inline:1rem}.out-ptn-destination:nth-child(2)::after{display:none}.out-ptn-logo{width:120px;height:120px}.out-ptn-logo::before{width:108px;height:108px}.out-ptn-logo::after{width:90px;height:90px}}
@media(max-width:480px){.out-ptn-destination-grid{grid-template-columns:1fr}.out-ptn-destination{min-height:300px;padding-inline:1.25rem}.out-ptn-destination::after{display:none!important}.out-ptn-logo{width:126px;height:126px}.out-ptn .out-copy::after{font-size:6rem;bottom:-2rem}}
/* ---------- PRESTASI — INSTAGRAM FEED SHOWCASE (SCOPED) ---------- */
.prestasi-section{
  position:relative;
  background:linear-gradient(145deg,#092b4d 0%,#0d3a66 58%,#123f68 100%);
  color:#fff;
  padding:clamp(4.8rem,8vw,7rem) 0;
  overflow:hidden;
}
.prestasi-section .prestasi-ornament{
  position:absolute;inset:0;pointer-events:none;z-index:0;overflow:hidden;
}
.prestasi-section .prestasi-ornament::before{
  content:"";position:absolute;width:300px;height:300px;border:1px solid rgba(255,213,74,.18);
  border-radius:50%;left:-150px;top:5%;box-shadow:0 0 0 24px rgba(255,213,74,.025),0 0 0 48px rgba(255,213,74,.018);
}
.prestasi-section .prestasi-ornament::after{
  content:"";position:absolute;width:190px;height:190px;border:1px solid rgba(255,255,255,.10);
  border-radius:50%;right:-95px;bottom:8%;
}
.prestasi-section .prestasi-dots{
  position:absolute;width:84px;height:84px;right:7%;top:10%;
  background-image:radial-gradient(circle,rgba(255,213,74,.42) 2px,transparent 2.7px);
  background-size:14px 14px;opacity:.7;
}
.prestasi-section .prestasi-diamond{
  position:absolute;width:52px;height:52px;left:8%;bottom:11%;
  border:1.5px solid rgba(255,213,74,.42);transform:rotate(45deg);
}
.prestasi-section .prestasi-line{
  position:absolute;width:150px;height:1px;right:15%;bottom:17%;
  background:linear-gradient(90deg,transparent,rgba(255,213,74,.45),transparent);
  transform:rotate(-18deg);
}
.prestasi-section .prestasi-wrap{
  width:min(1220px,92%);margin:0 auto;position:relative;z-index:2;
}
.prestasi-section .prestasi-head{
  text-align:center;max-width:760px;margin:0 auto;
}
.prestasi-section .prestasi-kicker{
  display:inline-flex;align-items:center;justify-content:center;gap:.65rem;
  color:#ffd54a;font-size:.72rem;font-weight:900;letter-spacing:.22em;text-transform:uppercase;
  margin-bottom:.85rem;
}
.prestasi-section .prestasi-kicker::before,
.prestasi-section .prestasi-kicker::after{
  content:"";width:34px;height:2px;border-radius:99px;background:linear-gradient(90deg,#ffd54a,#ff9d00);
}
.prestasi-section .prestasi-title{
  font-family:var(--font-display);font-size:clamp(2.5rem,5vw,4.4rem);line-height:.98;
  font-weight:900;color:#fff;letter-spacing:.01em;margin:0 0 1rem;text-transform:uppercase;
}
.prestasi-section .prestasi-title .gold{
  background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent;
}
.prestasi-section .prestasi-desc{
  max-width:720px;margin:0 auto;color:rgba(255,255,255,.74);font-size:.98rem;line-height:1.8;
}
.prestasi-section .prestasi-feed-shell{
  position:relative;margin-top:2.8rem;padding:0 3.7rem;
}
.prestasi-section .prestasi-feed-viewport{
  overflow:hidden;border-radius:28px;
}
.prestasi-section .prestasi-feed-rail{
  display:flex;gap:1.15rem;overflow-x:auto;scroll-behavior:smooth;
  scrollbar-width:none;cursor:grab;touch-action:pan-x;user-select:none;
  padding:.45rem .15rem 1rem;
  -webkit-overflow-scrolling:touch;
}
.prestasi-section .prestasi-feed-rail::-webkit-scrollbar{display:none}
.prestasi-section .prestasi-feed-rail.is-dragging{cursor:grabbing;scroll-behavior:auto}
.prestasi-section .prestasi-feed{
  flex:0 0 calc((100% - 2.3rem)/3);min-width:0;background:#fff;color:#0d2d50;
  border:1px solid rgba(255,255,255,.65);border-radius:22px;overflow:hidden;
  box-shadow:0 24px 54px rgba(0,0,0,.22);transition:transform .3s ease,box-shadow .3s ease;
}
.prestasi-section .prestasi-feed:hover{
  transform:translateY(-6px);box-shadow:0 30px 64px rgba(0,0,0,.28);
}
.prestasi-section .prestasi-feed-head{
  display:flex;align-items:center;gap:.7rem;padding:.85rem .95rem;
  background:#fff;border-bottom:1px solid rgba(13,58,102,.08);
}
.prestasi-section .prestasi-feed-avatar{
  width:34px;height:34px;border-radius:50%;display:grid;place-items:center;flex:0 0 34px;
  background:linear-gradient(135deg,#123b60,#1e5b92);color:#ffd54a;font-size:.72rem;
  box-shadow:0 5px 14px rgba(13,58,102,.18);
}
.prestasi-section .prestasi-feed-account{min-width:0;line-height:1.2}
.prestasi-section .prestasi-feed-account strong{
  display:block;font-size:.78rem;font-weight:900;color:#0d2d50;
}
.prestasi-section .prestasi-feed-account span{
  display:block;margin-top:.15rem;font-size:.62rem;color:#7a8999;
}
.prestasi-section .prestasi-feed-more{
  margin-left:auto;color:#7a8999;font-size:.85rem;letter-spacing:.08em;
}
.prestasi-section .prestasi-feed-media{
  position:relative;aspect-ratio:4/3;overflow:hidden;background:linear-gradient(145deg,#0d3a66,#174e7c);
}
.prestasi-section .prestasi-feed-media::after{
  content:"";position:absolute;inset:0;border:1px solid rgba(255,255,255,.12);pointer-events:none;
}
.prestasi-section .prestasi-feed-photo-placeholder{
  position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;
  gap:.65rem;text-align:center;padding:1.5rem;color:rgba(255,255,255,.86);
  background:
    radial-gradient(circle at 30% 25%,rgba(255,213,74,.24),transparent 32%),
    radial-gradient(circle at 75% 75%,rgba(255,255,255,.10),transparent 34%),
    linear-gradient(145deg,#0d3a66,#123f68);
}
.prestasi-section .prestasi-feed-photo-placeholder i{
  width:74px;height:74px;border-radius:22px;display:grid;place-items:center;
  background:linear-gradient(135deg,#ffd54a,#ff9f00);color:#0d2d50;font-size:1.65rem;
  box-shadow:0 16px 34px rgba(255,179,0,.28);
}
.prestasi-section .prestasi-feed-photo-placeholder strong{
  font-size:.82rem;letter-spacing:.08em;text-transform:uppercase;color:#fff;
}
.prestasi-section .prestasi-feed-photo-placeholder small{
  max-width:26ch;color:rgba(255,255,255,.62);font-size:.68rem;line-height:1.5;
}
.prestasi-section .prestasi-feed-body{padding:.9rem .95rem 1.05rem}
.prestasi-section .prestasi-feed-actions{
  display:flex;align-items:center;gap:.9rem;margin-bottom:.65rem;color:#0d3a66;
}
.prestasi-section .prestasi-feed-actions i{font-size:.92rem}
.prestasi-section .prestasi-feed-actions .save{margin-left:auto}
.prestasi-section .prestasi-feed-tag{
  display:inline-flex;padding:.32rem .58rem;border-radius:99px;background:#fff3c8;color:#9a6200;
  font-size:.56rem;font-weight:900;letter-spacing:.09em;text-transform:uppercase;margin-bottom:.55rem;
}
.prestasi-section .prestasi-feed-body h3{
  font-family:var(--font-display);font-size:1.08rem;line-height:1.2;color:#0d2d50;margin:0 0 .45rem;font-weight:900;
}
.prestasi-section .prestasi-feed-body h3 span{color:#d98900}
.prestasi-section .prestasi-feed-body p{
  margin:0;color:#66788c;font-size:.72rem;line-height:1.65;
}
.prestasi-section .prestasi-feed-meta{
  display:flex;flex-wrap:wrap;gap:.45rem;margin-top:.8rem;
}
.prestasi-section .prestasi-feed-meta span{
  display:inline-flex;align-items:center;gap:.3rem;color:#6c7c8d;font-size:.6rem;font-weight:800;
}
.prestasi-section .prestasi-feed-meta i{color:#e39a00}
.prestasi-section .prestasi-feed-placeholder .prestasi-feed-media{
  background:linear-gradient(145deg,#f4f7fb,#e8eef5);
}
.prestasi-section .prestasi-feed-placeholder .prestasi-feed-photo-placeholder{
  background:
    linear-gradient(135deg,rgba(13,58,102,.04),rgba(255,179,0,.08)),
    #f5f8fc;
  color:#0d3a66;
}
.prestasi-section .prestasi-feed-placeholder .prestasi-feed-photo-placeholder i{
  background:#fff;border:1px solid rgba(255,179,0,.38);color:#ff9f00;box-shadow:0 12px 28px rgba(13,58,102,.10);
}
.prestasi-section .prestasi-feed-placeholder .prestasi-feed-photo-placeholder strong{color:#0d3a66}
.prestasi-section .prestasi-feed-placeholder .prestasi-feed-photo-placeholder small{color:#75869a}
.prestasi-section .prestasi-feed-placeholder .prestasi-feed-body h3{color:#0d3a66}
.prestasi-section .prestasi-feed-placeholder .prestasi-feed-tag{background:#edf3f8;color:#48627b}
.prestasi-section .prestasi-arrow{
  position:absolute;top:50%;z-index:5;width:48px;height:48px;border:1px solid rgba(255,255,255,.35);
  border-radius:50%;display:grid;place-items:center;cursor:pointer;color:#0d3a66;
  background:#fff;box-shadow:0 14px 30px rgba(0,0,0,.2);transition:transform .25s ease,background .25s ease,color .25s ease;
}
.prestasi-section .prestasi-arrow:hover{
  transform:translateY(-50%) scale(1.06);background:#ffd54a;color:#0d3a66;
}
.prestasi-section .prestasi-arrow:disabled{opacity:.38;cursor:default}
.prestasi-section .prestasi-arrow:disabled:hover{transform:translateY(-50%);background:#fff}
.prestasi-section .prestasi-arrow-left{left:.35rem;transform:translateY(-50%)}
.prestasi-section .prestasi-arrow-right{right:.35rem;transform:translateY(-50%)}
.prestasi-section .prestasi-note{
  text-align:center;margin:1.2rem auto 0;color:rgba(255,255,255,.48);font-size:.65rem;letter-spacing:.08em;
}
@media(max-width:980px){
  .prestasi-section .prestasi-feed{flex-basis:calc((100% - 1.15rem)/2)}
}
@media(max-width:700px){
  .prestasi-section{padding:4.2rem 0}
  .prestasi-section .prestasi-wrap{width:min(100%,94%)}
  .prestasi-section .prestasi-feed-shell{padding:0 2.5rem;margin-top:2.35rem}
  .prestasi-section .prestasi-feed-rail{gap:.85rem;padding-bottom:.75rem}
  .prestasi-section .prestasi-feed{flex-basis:86%}
  .prestasi-section .prestasi-arrow{width:42px;height:42px}
  .prestasi-section .prestasi-arrow-left{left:.1rem}
  .prestasi-section .prestasi-arrow-right{right:.1rem}
  .prestasi-section .prestasi-dots{right:3%;top:7%}
  .prestasi-section .prestasi-diamond{left:2%;bottom:7%}
}
@media(max-width:480px){
  .prestasi-section .prestasi-title{font-size:2.35rem}
  .prestasi-section .prestasi-kicker{font-size:.62rem;letter-spacing:.16em}
  .prestasi-section .prestasi-kicker::before,.prestasi-section .prestasi-kicker::after{width:22px}
  .prestasi-section .prestasi-desc{font-size:.86rem}
  .prestasi-section .prestasi-feed-shell{padding:0 2.25rem}
  .prestasi-section .prestasi-feed{flex-basis:88%}
}
@media(max-width:960px){
  .out-alumni-head,.out-ptn-layout{grid-template-columns:1fr}
  .out-achieve{grid-template-columns:1fr}
  .out-alumni-head .out-copy,.out-ptn-layout .out-copy{max-width:760px}
}
@media(max-width:700px){
  .out-sec{padding:4rem 0}
  .out-id-card{grid-template-columns:1fr;min-height:0}
  .out-id-photo{margin:1rem 1rem 0;height:240px;min-height:240px}
  .out-id-photo .placeholder{min-height:240px}
  .out-id-info{padding:1.1rem}
  .out-id-code{top:1rem;right:1rem}
  .out-id-meta{grid-template-columns:1fr 1fr}
  .out-logo-window::before,.out-logo-window::after{width:55px}
  .out-logo-card{width:128px;height:92px}.out-logo-only{width:105px;height:72px}
  .out-ptn-card{grid-template-columns:72px 1fr;gap:.8rem;padding:1rem;min-height:280px}
  .out-ptn-avatar{width:72px;height:92px}
  .out-ptn-name{font-size:1.2rem}
  .out-achieve-main{min-height:360px;padding:1.45rem}
  .out-stat{min-height:150px;padding:1rem}
}
@media(max-width:480px){
  .out-title{font-size:2.35rem}
  .out-id-meta{grid-template-columns:1fr}
  .out-stat-grid{grid-template-columns:1fr 1fr}
  .out-stat b{font-size:.9rem}
  .out-stat span{font-size:.62rem}
}
@media(prefers-reduced-motion:reduce){
  .out-logo-track{animation:none}
  .out-id-track,.out-ptn-track{transition:none}
}

/* ===== V3 VISUAL REFINEMENT: alumni archive / industry logos / PTN destination ===== */
.out-alumni{background:linear-gradient(180deg,#ffffff 0%,#f7fbff 100%)}
.out-alumni-head{grid-template-columns:minmax(260px,.7fr) minmax(520px,1.3fr);gap:clamp(2.2rem,5vw,5.5rem)}
.out-id-stage{padding-top:.4rem}
.out-id-viewport{max-width:820px;border-radius:30px;padding:10px;background:linear-gradient(135deg,rgba(13,58,102,.11),rgba(255,179,0,.16));box-shadow:0 28px 70px rgba(13,58,102,.15)}
.out-id-card{min-height:390px;grid-template-columns:42% 58%;border-radius:24px;box-shadow:0 20px 48px rgba(13,58,102,.14)}
.out-id-card::before{height:11px}
.out-id-photo{margin:1.55rem 0 1.55rem 1.55rem;min-height:325px;border-radius:20px;background:linear-gradient(160deg,#d8e8f5,#f8fbfd);box-shadow:inset 0 0 0 1px rgba(255,255,255,.7),0 12px 26px rgba(13,58,102,.12)}
.out-id-photo .placeholder{min-height:325px;font-size:.78rem}
.out-id-info{padding:1.75rem 1.8rem 1.5rem 1.6rem}
.out-id-brand{font-size:.78rem;margin-bottom:1.45rem}
.out-id-brand img{width:38px;height:38px}
.out-id-code{font-size:.62rem;top:1.45rem;right:1.45rem}
.out-id-name{font-size:clamp(1.45rem,2.4vw,2.05rem)}
.out-id-role{font-size:.72rem}
.out-id-meta div{padding:.72rem .78rem;border-radius:12px}
.out-id-meta b{font-size:.74rem}
.out-id-footer{padding-top:1.15rem}
.out-id-footer::before{content:'ARSIP LULUSAN TERBAIK';display:block;position:absolute;left:1.6rem;bottom:.65rem;color:#a3afbc;font-size:.48rem;font-weight:900;letter-spacing:.16em}
.out-alumni .out-slider-controls{margin-top:1.25rem}
.out-alumni .out-slider-controls::before{content:'Geser untuk melihat arsip lulusan berikutnya';font-size:.62rem;font-weight:800;color:#8797a8;letter-spacing:.04em;margin-right:.2rem}

/* department archive chips: visual index, data tetap berasal dari halaman */
.out-alumni .out-route{gap:.5rem}
.out-alumni .out-route-node{padding:.52rem .78rem;font-size:.65rem;border:1px solid rgba(13,58,102,.1);box-shadow:0 7px 16px rgba(13,58,102,.06)}

/* INDUSTRY: make partner marks visibly larger */
.out-logo-window{margin-top:3.2rem;padding:1.35rem 0}
.out-logo-group{gap:1.35rem;padding-right:1.35rem}
.out-logo-card{width:190px;height:120px;border-radius:0;background:transparent!important;border:0!important;box-shadow:none!important}
.out-logo-only{width:150px;height:100px}

/* PTN: destination-pass style instead of a basic profile card */
.out-ptn{background:linear-gradient(180deg,#fff 0%,#f6faff 100%)}
.out-ptn-layout{grid-template-columns:minmax(280px,.65fr) minmax(500px,1.35fr);gap:clamp(2.2rem,5vw,5.5rem)}
.out-ptn-window{padding:10px;border-radius:30px;background:linear-gradient(135deg,rgba(13,58,102,.09),rgba(255,179,0,.12));box-shadow:0 26px 64px rgba(13,58,102,.13)}
.out-ptn-slide{padding:0}
.out-ptn-card{min-height:370px;grid-template-columns:150px 1fr;gap:1.5rem;padding:1.55rem;border-radius:25px;box-shadow:0 18px 44px rgba(13,58,102,.11);background:linear-gradient(145deg,#fff 0%,#fafdff 100%)}
.out-ptn-card::before{content:'NEXT DESTINATION';right:-18px;top:12px;font-size:5.2rem;letter-spacing:.03em;transform:rotate(90deg);transform-origin:right top;color:rgba(13,58,102,.035)}
.out-ptn-avatar{width:150px;height:190px;border-radius:22px;border:1px solid rgba(13,58,102,.1);box-shadow:0 14px 30px rgba(13,58,102,.10);font-size:.66rem;position:relative;background:radial-gradient(circle at 50% 35%,#fff 0 20%,transparent 21%),linear-gradient(160deg,#d9e9f5,#f8fbfd)}
.out-ptn-avatar::after{content:'PTN';position:absolute;bottom:12px;left:50%;transform:translateX(-50%);padding:.35rem .65rem;border-radius:99px;background:#0d3a66;color:#fff;font-size:.55rem;letter-spacing:.16em;font-weight:900}
.out-ptn-content{padding:.2rem .4rem .2rem 0}
.out-ptn-badge{font-size:.62rem;padding:.42rem .78rem;margin-bottom:.9rem}
.out-ptn-name{font-size:clamp(1.55rem,2.6vw,2.15rem);margin-bottom:.45rem}
.out-ptn-uni{font-size:.86rem;max-width:34ch}
.out-ptn-field{font-size:.8rem;max-width:48ch;line-height:1.75}
.out-ptn-meta{margin-top:1.15rem;padding-top:.9rem;border-top:1px dashed rgba(13,58,102,.14)}
.out-ptn .out-slider-controls{margin-top:1.25rem}
.out-ptn .out-slider-controls::before{content:'Geser untuk melihat lulusan PTN lainnya';font-size:.62rem;font-weight:800;color:#8797a8;letter-spacing:.04em;margin-right:.2rem}

@media(max-width:960px){
  .out-alumni-head,.out-ptn-layout{grid-template-columns:1fr}
  .out-alumni-head .out-copy,.out-ptn-layout .out-copy{max-width:760px}
}
@media(max-width:700px){
  .out-jurusan-label{display:block}
  .out-jurusan-label small{display:block;margin-top:.2rem}
  .out-jurusan-list{display:grid;grid-template-columns:repeat(3,1fr)}
  .out-jurusan-pill{min-width:0;padding:.65rem .5rem}
  .out-id-card{grid-template-columns:1fr;min-height:0}
  .out-id-photo{margin:1rem 1rem 0;height:250px;min-height:250px}
  .out-id-photo .placeholder{min-height:250px}
  .out-id-info{padding:1.2rem}
  .out-id-footer::before{left:1.2rem}
  .out-logo-card{width:154px;height:126px}
  .out-logo-mark{width:70px;height:70px}
  .out-ptn-card{grid-template-columns:100px 1fr;min-height:310px;gap:1rem;padding:1rem}
  .out-ptn-avatar{width:100px;height:140px}
}
@media(max-width:480px){
  .out-ptn-card{grid-template-columns:1fr}
  .out-ptn-avatar{width:100%;height:150px}
  .out-alumni .out-slider-controls::before,.out-ptn .out-slider-controls::before{display:none}
}

/* ============================================================
   LULUSAN TERBAIK — PREMIUM ALUMNI HALL OF FAME OVERRIDE
   Visual/layout only. Existing alumni data and other sections stay intact.
   ============================================================ */
.out-alumni{
  background:
    radial-gradient(circle at 82% 20%,rgba(255,179,0,.10),transparent 24%),
    radial-gradient(circle at 8% 78%,rgba(13,58,102,.055),transparent 28%),
    linear-gradient(135deg,#fff 0%,#f9fbfd 58%,#f3f7fb 100%);
}
.out-alumni .out-wrap{width:min(1240px,92%)}
.out-alumni-head{grid-template-columns:minmax(310px,.78fr) minmax(560px,1.22fr);gap:clamp(2.5rem,5vw,6rem);align-items:center}
.out-alumni .out-copy{position:relative;padding:2.1rem 0 2.1rem 2rem}
.out-alumni .out-copy::before{content:"ALUMNI\A HALL OF FAME";white-space:pre;position:absolute;left:-.4rem;top:-1.3rem;font-family:var(--font-display);font-size:clamp(3.5rem,7vw,6.5rem);font-weight:900;line-height:.82;letter-spacing:-.055em;color:rgba(13,58,102,.035);pointer-events:none}
.out-alumni .out-copy::after{content:"";position:absolute;left:0;top:2.25rem;bottom:2.25rem;width:3px;border-radius:99px;background:linear-gradient(180deg,#ffb300,rgba(13,58,102,.08),#0d3a66)}
.out-alumni .out-kicker{position:relative;z-index:1;margin-bottom:1rem}
.out-alumni .out-title{position:relative;z-index:1;font-size:clamp(3rem,5.2vw,5rem);letter-spacing:-.025em;margin-bottom:1.25rem}
.out-alumni .out-desc{position:relative;z-index:1;max-width:520px;font-size:.94rem;line-height:1.9}
.out-alumni .out-route{position:relative;z-index:1;margin-top:1.5rem;gap:.55rem}
.out-alumni .out-route-node{padding:.62rem .9rem;background:rgba(13,58,102,.055);color:#345572;border:1px solid rgba(13,58,102,.09);box-shadow:none;transition:.25s ease}
.out-alumni .out-route-node:hover{transform:translateY(-2px);border-color:rgba(255,179,0,.5);background:#fff;box-shadow:0 8px 20px rgba(13,58,102,.08)}
.out-alumni .out-route-node.gold{background:#fff3c9;color:#875d00;border-color:rgba(255,179,0,.22)}
.out-alumni .out-route[aria-label="Indeks jurusan lulusan"]{margin-top:.8rem;padding-top:1rem;border-top:1px dashed rgba(13,58,102,.13);max-width:520px}
.out-alumni .out-route[aria-label="Indeks jurusan lulusan"]::before{content:"KOLEKSI JURUSAN";width:100%;font-size:.56rem;font-weight:900;letter-spacing:.18em;color:#92a0ae;margin-bottom:.15rem}
.out-alumni .out-route[aria-label="Indeks jurusan lulusan"] .out-route-node{background:#fff;color:#0d3a66;padding:.5rem .72rem;font-size:.6rem;letter-spacing:.08em;border-radius:10px}
.out-alumni .out-id-stage{padding:1rem 0 0;filter:drop-shadow(0 30px 40px rgba(13,58,102,.08))}
.out-alumni .out-id-stage::before{content:"FEATURED ALUMNI";position:absolute;right:2.2rem;top:-.15rem;z-index:4;padding:.48rem .78rem;border-radius:99px;background:#0d3a66;color:#fff;font-size:.55rem;font-weight:900;letter-spacing:.16em;box-shadow:0 8px 20px rgba(13,58,102,.18)}
.out-alumni .out-id-stage::after{content:"01 / 02";position:absolute;left:1.1rem;bottom:4.35rem;z-index:4;color:#ff9f00;font-size:.62rem;font-weight:900;letter-spacing:.16em}
.out-alumni .out-id-viewport{max-width:780px;padding:12px;border-radius:34px;background:linear-gradient(135deg,rgba(13,58,102,.12),rgba(255,179,0,.18));box-shadow:0 28px 75px rgba(13,58,102,.16)}
.out-alumni .out-id-card{min-height:390px;border-radius:25px;grid-template-columns:43% 57%;border:1px solid rgba(13,58,102,.1);box-shadow:0 18px 45px rgba(13,58,102,.11);background:linear-gradient(145deg,#fff 0%,#fff 72%,#f7fafc 100%)}
.out-alumni .out-id-card::before{height:7px}
.out-alumni .out-id-photo{margin:1.25rem 0 1.25rem 1.25rem;min-height:335px;border-radius:19px;background:#dce8f1;box-shadow:inset 0 0 0 1px rgba(255,255,255,.7),0 12px 28px rgba(13,58,102,.12)}
.out-alumni .out-id-photo img{object-position:center top}
.out-alumni .out-id-photo::before{content:"BEST GRADUATE";position:absolute;left:14px;bottom:14px;z-index:2;padding:.48rem .62rem;border-radius:7px;background:rgba(13,58,102,.9);color:#fff;font-size:.5rem;font-weight:900;letter-spacing:.15em}
.out-alumni .out-id-info{padding:1.7rem 1.8rem 1.45rem 1.55rem}
.out-alumni .out-id-brand{margin-bottom:1.4rem;color:#0d3a66;font-size:.68rem}
.out-alumni .out-id-brand img{width:34px;height:34px;box-shadow:0 4px 12px rgba(13,58,102,.12)}
.out-alumni .out-id-code{right:1.4rem;top:1.4rem;color:#9aa9b9}
.out-alumni .out-id-name{font-size:clamp(1.55rem,2.5vw,2.25rem);max-width:12ch;letter-spacing:-.015em}
.out-alumni .out-id-role{font-size:.64rem;margin-bottom:1.2rem}
.out-alumni .out-id-line{margin-bottom:1.1rem;background:linear-gradient(90deg,#ffb300 0%,rgba(255,179,0,.3) 45%,rgba(13,58,102,.07) 100%)}
.out-alumni .out-id-meta{gap:.55rem}
.out-alumni .out-id-meta div{padding:.68rem .72rem;border-radius:12px;background:rgba(246,249,252,.92);transition:.25s ease}
.out-alumni .out-id-meta div:hover{transform:translateY(-2px);background:#fff;box-shadow:0 7px 18px rgba(13,58,102,.07)}
.out-alumni .out-id-footer{padding-top:1.15rem}
.out-alumni .out-id-chip{padding:.48rem .75rem;box-shadow:inset 0 0 0 1px rgba(255,179,0,.12)}
.out-alumni .out-slider-controls{justify-content:flex-end;padding-right:1rem;margin-top:1.25rem;gap:.7rem}
.out-alumni .out-slider-controls::before{content:"GESER UNTUK MELIHAT LULUSAN LAINNYA";margin-right:auto;color:#8b9aab;font-size:.56rem;font-weight:900;letter-spacing:.13em}
.out-alumni .out-arrow{width:46px;height:46px;border-color:rgba(13,58,102,.13);box-shadow:0 10px 24px rgba(13,58,102,.1)}
.out-alumni .out-arrow:hover{background:#ffb300;color:#0d3a66;border-color:#ffb300}
.out-alumni .out-dot{height:7px;width:7px}
.out-alumni .out-dot.active{width:28px}
@media(max-width:1050px){
  .out-alumni-head{grid-template-columns:1fr;gap:2rem}
  .out-alumni .out-copy{max-width:760px;margin:0 auto;width:100%}
  .out-alumni .out-id-stage{max-width:820px;width:100%;margin:0 auto}
}
@media(max-width:700px){
  .out-alumni .out-copy{padding-left:1rem}
  .out-alumni .out-copy::after{left:0}
  .out-alumni .out-title{font-size:clamp(2.6rem,12vw,4rem)}
  .out-alumni .out-id-stage{padding-top:1.8rem}
  .out-alumni .out-id-stage::before{right:1rem;top:.15rem}
  .out-alumni .out-id-stage::after{display:none}
  .out-alumni .out-id-card{grid-template-columns:1fr;min-height:0}
  .out-alumni .out-id-photo{margin:1rem 1rem 0;height:300px;min-height:300px}
  .out-alumni .out-id-info{padding:1.25rem}
  .out-alumni .out-slider-controls{justify-content:center;padding-right:0}
  .out-alumni .out-slider-controls::before{display:none}
}
@media(max-width:480px){
  .out-alumni .out-route[aria-label="Indeks jurusan lulusan"] .out-route-node{padding:.46rem .58rem}
  .out-alumni .out-id-photo{height:260px;min-height:260px}
  .out-alumni .out-id-meta{grid-template-columns:1fr}
}

/* FINAL FIX — navigasi slider Lulusan Terbaik selalu terlihat */
.out-alumni .out-slider-controls{
  position:relative;
  z-index:20;
  display:flex !important;
  align-items:center;
  justify-content:center !important;
  gap:1rem;
  width:100%;
  min-height:52px;
  margin-top:1.35rem !important;
  padding:0 !important;
  visibility:visible !important;
  opacity:1 !important;
}
.out-alumni .out-slider-controls::before{
  content:'GESER UNTUK MELIHAT LULUSAN LAINNYA' !important;
  display:block !important;
  margin-right:.25rem !important;
  color:#8b9aab;
  font-size:.58rem;
  font-weight:900;
  letter-spacing:.12em;
}
.out-alumni .out-slider-controls .out-arrow{
  flex:0 0 46px;
  width:46px !important;
  height:46px !important;
  min-width:46px;
  min-height:46px;
  display:grid !important;
  place-items:center !important;
  visibility:visible !important;
  opacity:1 !important;
  position:relative;
  z-index:21;
}
.out-alumni .out-slider-controls .out-dots{
  display:flex !important;
  align-items:center;
  visibility:visible !important;
  opacity:1 !important;
}
.out-alumni .out-slider-controls .out-dot{
  display:block !important;
  visibility:visible !important;
  opacity:1 !important;
}
@media(max-width:700px){
  .out-alumni .out-slider-controls::before{display:none !important}
  .out-alumni .out-slider-controls{gap:.8rem}
}

/* ============================================================
   PTN CARD — RICH DESTINATION PASS / NOT BASIC CARD
   ============================================================ */
.out-ptn-window{
  background:
    radial-gradient(circle at 92% 8%,rgba(255,213,74,.22),transparent 20%),
    linear-gradient(135deg,#082b4b 0%,#0d3a66 62%,#164d78 100%);
  border:1px solid rgba(255,255,255,.16);
  box-shadow:0 30px 75px rgba(13,58,102,.24);
  padding:12px;
}
.out-ptn-window::before{
  width:260px;height:260px;right:-105px;top:-115px;
  border:1px solid rgba(255,213,74,.35);
  box-shadow:0 0 0 28px rgba(255,213,74,.045),0 0 0 58px rgba(255,213,74,.025);
}
.out-ptn-window::after{
  left:28px;bottom:18px;
  color:rgba(255,255,255,.38);
}
.out-ptn-card{
  min-height:390px;
  grid-template-columns:190px 1fr;
  gap:1.8rem;
  padding:1.5rem;
  border-radius:22px;
  background:
    linear-gradient(135deg,#ffffff 0%,#ffffff 68%,#f1f7fb 100%);
  border:1px solid rgba(255,255,255,.95);
  box-shadow:0 22px 48px rgba(0,0,0,.16),inset 0 0 0 1px rgba(13,58,102,.035);
}
.out-ptn-card::before{
  content:'PTN  /  NEXT DESTINATION';
  right:-8px;top:18px;
  font-family:var(--font-display);
  font-size:3.7rem;
  font-weight:900;
  letter-spacing:.08em;
  transform:rotate(90deg);
  transform-origin:right top;
  color:rgba(13,58,102,.045);
  white-space:nowrap;
}
.out-ptn-card::after{
  left:0;bottom:0;width:62%;height:6px;
  background:linear-gradient(90deg,#0d3a66 0%,#ffd54a 72%,transparent 100%);
}
.out-ptn-avatar{
  width:190px;height:250px;
  border-radius:18px;
  background:
    linear-gradient(145deg,rgba(13,58,102,.98),rgba(19,77,120,.94));
  border:7px solid #fff;
  outline:1px solid rgba(13,58,102,.16);
  box-shadow:0 18px 36px rgba(13,58,102,.20),0 0 0 8px rgba(255,213,74,.13);
  color:#fff;
  overflow:hidden;
}
.out-ptn-avatar::before{
  content:'ALUMNI PROFILE';
  left:12px;bottom:12px;
  padding:.42rem .62rem;
  border-radius:8px;
  background:#ffd54a;
  color:#0d3a66;
  box-shadow:0 5px 12px rgba(0,0,0,.14);
  font-size:.48rem;
  letter-spacing:.14em;
}
.out-ptn-avatar::after{
  content:'PTN';
  top:12px;bottom:auto;left:auto;right:12px;
  transform:none;
  padding:.38rem .55rem;
  border-radius:7px;
  background:rgba(255,255,255,.14);
  border:1px solid rgba(255,255,255,.28);
  color:#fff;
  font-size:.48rem;
}
.out-ptn-avatar img{filter:saturate(.98) contrast(1.02)}
.out-ptn-content{
  padding:1.05rem 2.4rem 1rem .25rem;
}
.out-ptn-badge{
  background:#0d3a66;
  color:#ffd54a;
  border:1px solid rgba(13,58,102,.1);
  box-shadow:0 8px 18px rgba(13,58,102,.13);
  letter-spacing:.15em;
}
.out-ptn-name{
  font-size:clamp(1.9rem,3.2vw,2.7rem);
  letter-spacing:-.025em;
  margin-bottom:.65rem;
}
.out-ptn-uni{
  display:inline-block;
  padding:.5rem .7rem;
  border-left:4px solid #ffd54a;
  background:linear-gradient(90deg,#fff7d7,rgba(255,247,215,.15));
  color:#d98700;
  font-size:.96rem;
  margin-bottom:.9rem;
}
.out-ptn-field{
  padding-top:.9rem;
  border-top:1px solid rgba(13,58,102,.10);
  color:#61758a;
}
.out-ptn-meta{
  background:#f4f7fa;
  border:1px solid rgba(13,58,102,.08);
  box-shadow:0 7px 16px rgba(13,58,102,.06);
}
.out-ptn .out-slider-controls{
  margin-top:1.35rem;
  justify-content:flex-end;
  padding-right:.3rem;
}
.out-ptn .out-slider-controls::before{
  margin-right:auto;
  color:rgba(255,255,255,.68);
}
.out-ptn .out-arrow{
  width:46px;height:46px;
  border:1px solid rgba(255,213,74,.55);
  background:#fff;
  box-shadow:0 9px 20px rgba(0,0,0,.16);
}
.out-ptn .out-arrow:hover{background:#ffd54a;transform:translateY(-3px) scale(1.04)}
.out-ptn .out-dot{background:rgba(255,255,255,.42)}
.out-ptn .out-dot.active{background:#ffd54a}
@media(max-width:700px){
  .out-ptn-card{grid-template-columns:120px 1fr;min-height:340px;gap:1.15rem;padding:1.1rem}
  .out-ptn-avatar{width:120px;height:180px;border-width:5px}
  .out-ptn-content{padding:.5rem 1.2rem .5rem .1rem}
  .out-ptn-name{font-size:1.55rem}
  .out-ptn-uni{font-size:.78rem}
  .out-ptn-field{font-size:.7rem}
}
@media(max-width:480px){
  .out-ptn-card{grid-template-columns:1fr;min-height:0}
  .out-ptn-avatar{width:100%;height:210px}
  .out-ptn-content{padding:.5rem .25rem 1rem}
  .out-ptn-card::before{font-size:2.6rem}
}

/* ---------- PTN REDESIGN: SAME COMPOSITION AS ALUMNI, DIFFERENT DESTINATION CARD ---------- */
.out-ptn{position:relative;background:linear-gradient(180deg,#ffffff 0%,#f8fbff 100%);overflow:hidden}
.out-ptn::before{content:"";position:absolute;inset:0;background:linear-gradient(135deg,rgba(13,58,102,.025) 1px,transparent 1px),linear-gradient(45deg,rgba(255,179,0,.02) 1px,transparent 1px);background-size:54px 54px;mask-image:linear-gradient(to bottom,transparent,#000 15%,#000 85%,transparent);pointer-events:none}
.out-ptn-layout{position:relative;z-index:1;display:grid;grid-template-columns:minmax(280px,.78fr) minmax(500px,1.22fr);gap:clamp(2rem,5vw,5rem);align-items:center}
.out-ptn .out-copy{position:relative;z-index:2}
.out-ptn .out-copy::after{content:"PTN";position:absolute;left:-.35rem;bottom:-4.7rem;font-family:var(--font-display);font-size:9rem;font-weight:900;line-height:1;color:rgba(13,58,102,.035);letter-spacing:.04em;pointer-events:none}
.out-ptn-route{display:flex;align-items:center;flex-wrap:wrap;gap:.55rem;margin-top:1.35rem;position:relative;z-index:2}
.out-ptn-route>span{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem .8rem;border-radius:999px;border:1px solid rgba(13,58,102,.1);background:rgba(255,255,255,.75);box-shadow:0 8px 18px rgba(13,58,102,.05);color:#315775;font-size:.62rem;font-weight:900}
.out-ptn-route>span.gold{color:#9a6800;border-color:rgba(255,179,0,.25);background:#fff9e8}
.out-ptn-route>i{color:#ffb300;font-size:.8rem}
.out-ptn-stage{position:relative;min-width:0}
.out-ptn-window{position:relative;overflow:hidden;padding:8px;border-radius:30px;background:linear-gradient(135deg,rgba(13,58,102,.08),rgba(255,179,0,.11));box-shadow:0 24px 64px rgba(13,58,102,.13)}
.out-ptn-window::before{content:"";position:absolute;right:3%;top:-38px;width:145px;height:145px;border:1px solid rgba(255,179,0,.28);transform:rotate(45deg);pointer-events:none}
.out-ptn-window::after{content:"NEXT DESTINATION";position:absolute;right:22px;bottom:16px;font-size:.52rem;font-weight:950;letter-spacing:.24em;color:rgba(13,58,102,.11);pointer-events:none}
.out-ptn-track{position:relative;z-index:2;display:flex;transition:transform .6s cubic-bezier(.22,1,.36,1);touch-action:pan-y;cursor:grab}
.out-ptn-track.dragging{transition:none;cursor:grabbing}
.out-ptn-slide{flex:0 0 100%;padding:0}
.out-ptn-destination-card{position:relative;min-height:370px;overflow:hidden;border-radius:23px;background:linear-gradient(145deg,#ffffff 0%,#f8fbff 100%);border:1px solid rgba(13,58,102,.12);box-shadow:0 18px 46px rgba(13,58,102,.13);display:flex;flex-direction:column}
.out-ptn-destination-card::before{content:"";position:absolute;left:0;right:0;top:0;height:8px;background:linear-gradient(90deg,#0b3157,#0d5b8f 55%,#ffb300)}
.out-ptn-destination-card::after{content:"";position:absolute;right:-80px;top:-80px;width:230px;height:230px;border:1px solid rgba(13,58,102,.08);border-radius:50%;box-shadow:0 0 0 18px rgba(255,179,0,.025),0 0 0 36px rgba(13,58,102,.018);pointer-events:none}
.out-ptn-card-top{display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.45rem .8rem;border-bottom:1px solid rgba(13,58,102,.07);position:relative;z-index:2}
.out-ptn-card-kicker{font-size:.54rem;font-weight:950;letter-spacing:.2em;color:#ff9f00}
.out-ptn-card-mark{font-size:.58rem;font-weight:950;letter-spacing:.18em;color:#0d3a66;padding:.35rem .55rem;border:1px solid rgba(13,58,102,.1);border-radius:8px;background:#fff}
.out-ptn-card-main{display:grid;grid-template-columns:38% 62%;gap:1.25rem;align-items:center;padding:1.35rem 1.45rem 1.15rem;position:relative;z-index:2;flex:1}
.out-ptn-logo-panel{display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;min-height:235px;border-right:1px solid rgba(13,58,102,.08);padding-right:1.2rem}
.out-ptn-logo{width:154px;height:154px;border-radius:50%;display:grid;place-items:center;position:relative;background:#fff;border:1px solid rgba(13,58,102,.1);box-shadow:0 18px 36px rgba(13,58,102,.12),0 0 0 9px rgba(255,179,0,.045)}
.out-ptn-logo::before{content:"";position:absolute;inset:10px;border:1px dashed rgba(255,179,0,.5);border-radius:50%}
.out-ptn-logo>i{font-size:2.7rem;color:#ffb300;margin-bottom:.25rem}
.out-ptn-logo span{display:block;color:#0d3a66;font-size:.58rem;font-weight:950;letter-spacing:.1em}
.out-ptn-logo-panel small{margin-top:.85rem;color:#8a99aa;font-size:.52rem;font-weight:900;letter-spacing:.14em;text-transform:uppercase}
.out-ptn-card-info{padding:.2rem .3rem .2rem 0}
.out-ptn-label{font-size:.52rem;font-weight:950;letter-spacing:.18em;text-transform:uppercase;color:#9aa7b5;margin-bottom:.5rem}
.out-ptn-card-info h3{font-family:var(--font-display);font-size:clamp(1.45rem,2.8vw,2.25rem);line-height:1.02;color:#0d3a66;font-weight:900;margin:0 0 .65rem}
.out-ptn-accent{height:2px;width:58px;background:linear-gradient(90deg,#ffb300,#ff7a00);margin-bottom:1rem}
.out-ptn-student{display:flex;align-items:center;gap:.55rem;padding:.65rem .75rem;border-radius:12px;background:#fff8e4;border:1px solid rgba(255,179,0,.2);color:#234c6d;font-size:.74rem;font-weight:900;box-shadow:0 7px 18px rgba(13,58,102,.05)}
.out-ptn-student i{color:#ffb300;font-size:.65rem}
.out-ptn-card-info p{color:#718399;font-size:.68rem;line-height:1.65;margin:.85rem 0 0;max-width:38ch}
.out-ptn-card-bottom{display:flex;align-items:center;justify-content:space-between;gap:1rem;padding:.8rem 1.45rem;border-top:1px solid rgba(13,58,102,.07);position:relative;z-index:2;color:#8797a8;font-size:.5rem;font-weight:950;letter-spacing:.15em}
.out-ptn-card-bottom span:first-child{color:#0d3a66}.out-ptn-card-bottom i{color:#ffb300;margin-right:.3rem}
.out-ptn .out-slider-controls{display:flex;align-items:center;justify-content:center;gap:1rem;margin-top:1.15rem}
.out-ptn .out-arrow{width:44px;height:44px;border-radius:50%;border:1px solid rgba(13,58,102,.14);background:#fff;color:#0d3a66;display:grid;place-items:center;cursor:pointer;box-shadow:0 8px 22px rgba(13,58,102,.1);transition:.25s ease}
.out-ptn .out-arrow:hover{background:#0d3a66;color:#fff;transform:translateY(-2px)}
.out-ptn .out-dots{position:static;width:auto;height:auto;display:flex;align-items:center;gap:.45rem;background:none;opacity:1}
.out-ptn .out-dot{width:8px;height:8px;border:0;border-radius:99px;background:#d4deea;padding:0;cursor:pointer;transition:.25s ease}
.out-ptn .out-dot.active{width:25px;background:linear-gradient(90deg,#ffb300,#ff7a00)}
@media(max-width:960px){.out-ptn-layout{grid-template-columns:1fr;gap:2.2rem}.out-ptn-layout .out-copy{max-width:760px}.out-ptn-stage{max-width:900px;width:100%}}
@media(max-width:700px){.out-ptn-card-main{grid-template-columns:1fr;gap:1rem}.out-ptn-logo-panel{min-height:0;border-right:0;border-bottom:1px solid rgba(13,58,102,.08);padding:0 0 1rem}.out-ptn-logo{width:130px;height:130px}.out-ptn-destination-card{min-height:0}.out-ptn-card-info{padding:0}.out-ptn-card-bottom{flex-direction:column;align-items:flex-start;gap:.35rem}.out-ptn .out-copy::after{font-size:6rem;bottom:-2rem}}
@media(max-width:480px){.out-ptn-window{padding:6px;border-radius:22px}.out-ptn-destination-card{border-radius:18px}.out-ptn-card-top{padding:1rem 1rem .7rem}.out-ptn-card-main{padding:1rem}.out-ptn-card-bottom{padding:.7rem 1rem}.out-ptn-route{gap:.35rem}.out-ptn-route>span{font-size:.56rem;padding:.5rem .65rem}}
</style>

<!-- ================= LULUSAN TERBAIK ================= -->
<section class="out-sec out-alumni" id="lulusan-terbaik" aria-label="Lulusan Terbaik SMK Negeri 2 Mojokerto">
  <div class="out-orn" aria-hidden="true"><span class="out-dots"></span><span class="out-diamond"></span></div>
  <div class="out-wrap out-alumni-head">
    <div class="out-copy" data-reveal="left">
      <div class="out-kicker">Featured Alumni</div>
      <h2 class="out-title">Lulusan <span class="gold">Terbaik</span></h2>
      <p class="out-desc">Lulusan terbaik SMK Negeri 2 Mojokerto dari berbagai program keahlian. Pilih jurusan untuk melihat lulusan terbaiknya, atau gunakan panah dan geser kartu untuk menjelajah.</p>
      <div class="out-route">
        <span class="out-route-node"><i class="fa-solid fa-briefcase"></i> Dunia Kerja</span>
        <span class="out-route-node gold"><i class="fa-solid fa-graduation-cap"></i> Pendidikan Tinggi</span>
      </div>
    </div>

    <div class="out-id-stage" data-reveal style="--d:1">
      <div class="out-jurusan-filter" aria-label="Koleksi jurusan lulusan">
        <div class="out-jurusan-label"><span>KOLEKSI JURUSAN</span><small>Pilih jurusan untuk melihat lulusan terbaik</small></div>
        <div class="out-jurusan-list">
          <button class="out-jurusan-pill active" type="button" data-alumni-index="0" aria-label="Lulusan terbaik RPL">RPL</button>
          <button class="out-jurusan-pill" type="button" data-alumni-index="1" aria-label="Lulusan terbaik DKV">DKV</button>
          <button class="out-jurusan-pill" type="button" data-alumni-index="2" aria-label="Lulusan terbaik Kuliner">KULINER</button>
          <button class="out-jurusan-pill" type="button" data-alumni-index="3" aria-label="Lulusan terbaik LPS">LPS</button>
          <button class="out-jurusan-pill" type="button" data-alumni-index="4" aria-label="Lulusan terbaik APHP">APHP</button>        </div>
      </div>

      <div class="out-id-viewport">
        <div class="out-id-track" id="alumniTrack">
          <div class="out-id-slide" data-alumni-slide="0" data-jurusan="RPL">
            <article class="out-id-card">
              <div class="out-id-photo"><img src="{{ asset('images/rovino.png') }}" alt="Lulusan terbaik RPL SMK Negeri 2 Mojokerto" loading="lazy"></div>
              <div class="out-id-info">
                <div class="out-id-brand"><img src="{{ asset('images/logo_smkn2.png') }}" alt="SKANEDA"> SKANEDA Alumni</div>
                <span class="out-id-code">RPL / 2024</span>
                <h3 class="out-id-name">Rovino Ramadhani</h3>
                <div class="out-id-role">Lulusan Terbaik — RPL</div>
                <div class="out-id-line"></div>
                <div class="out-id-meta">
                  <div><small>Tahun</small><b>2024</b></div>
                  <div><small>Status</small><b>Lulusan Terbaik</b></div>
                  <div><small>Jurusan</small><b>Rekayasa Perangkat Lunak</b></div>
                  <div><small>Institusi</small><b>SMK Negeri 2 Mojokerto</b></div>
                </div>
                <div class="out-id-footer"><span class="out-id-chip"><i class="fa-solid fa-star"></i> Featured Alumni</span><span class="out-id-barcode"></span></div>
              </div>
            </article>
          </div>
          <div class="out-id-slide" data-alumni-slide="1" data-jurusan="DKV">
            <article class="out-id-card">
              <div class="out-id-photo"><img src="{{ asset('images/lola.jpeg') }}" alt="Lulusan terbaik DKV SMK Negeri 2 Mojokerto" loading="lazy"></div>
              <div class="out-id-info">
                <div class="out-id-brand"><img src="{{ asset('images/logo_smkn2.png') }}" alt="SKANEDA"> SKANEDA Alumni</div>
                <span class="out-id-code">DKV / 2024</span>
                <h3 class="out-id-name">Lola Devina Amidjaja</h3>
                <div class="out-id-role">Lulusan Terbaik — DKV</div>
                <div class="out-id-line"></div>
                <div class="out-id-meta">
                  <div><small>Tahun</small><b>2024</b></div>
                  <div><small>Status</small><b>Lulusan Terbaik</b></div>
                  <div><small>Jurusan</small><b>Desain Komunikasi Visual</b></div>
                  <div><small>Institusi</small><b>SMK Negeri 2 Mojokerto</b></div>
                </div>
                <div class="out-id-footer"><span class="out-id-chip"><i class="fa-solid fa-star"></i> Featured Alumni</span><span class="out-id-barcode"></span></div>
              </div>
            </article>
          </div>
          <div class="out-id-slide" data-alumni-slide="2" data-jurusan="KULINER">
            <article class="out-id-card">
              <div class="out-id-photo"><img src="{{ asset('images/husein.png') }}" alt="Lulusan terbaik Kuliner SMK Negeri 2 Mojokerto" loading="lazy"></div>
              <div class="out-id-info">
                <div class="out-id-brand"><img src="{{ asset('images/logo_smkn2.png') }}" alt="SKANEDA"> SKANEDA Alumni</div>
                <span class="out-id-code">KUL / 2024</span>
                <h3 class="out-id-name">Ahmed Husein Jalili</h3>
                <div class="out-id-role">Lulusan Terbaik — KULINER</div>
                <div class="out-id-line"></div>
                <div class="out-id-meta">
                  <div><small>Tahun</small><b>2024</b></div>
                  <div><small>Status</small><b>Lulusan Terbaik</b></div>
                  <div><small>Jurusan</small><b>Kuliner</b></div>
                  <div><small>Institusi</small><b>SMK Negeri 2 Mojokerto</b></div>
                </div>
                <div class="out-id-footer"><span class="out-id-chip"><i class="fa-solid fa-star"></i> Featured Alumni</span><span class="out-id-barcode"></span></div>
              </div>
            </article>
          </div>
          <div class="out-id-slide" data-alumni-slide="3" data-jurusan="LPS">
            <article class="out-id-card">
              <div class="out-id-photo"><img src="{{ asset('images/zidan.png') }}" alt="Lulusan terbaik LPS SMK Negeri 2 Mojokerto" loading="lazy"></div>
              <div class="out-id-info">
                <div class="out-id-brand"><img src="{{ asset('images/logo_smkn2.png') }}" alt="SKANEDA"> SKANEDA Alumni</div>
                <span class="out-id-code">LPS / 2024</span>
                <h3 class="out-id-name">Zidana Khoiron Alif</h3>
                <div class="out-id-role">Lulusan Terbaik — LPS</div>
                <div class="out-id-line"></div>
                <div class="out-id-meta">
                  <div><small>Tahun</small><b>2024</b></div>
                  <div><small>Status</small><b>Lulusan Terbaik</b></div>
                  <div><small>Jurusan</small><b>Layanan Perbankan Syariah</b></div>
                  <div><small>Institusi</small><b>SMK Negeri 2 Mojokerto</b></div>
                </div>
                <div class="out-id-footer"><span class="out-id-chip"><i class="fa-solid fa-star"></i> Featured Alumni</span><span class="out-id-barcode"></span></div>
              </div>
            </article>
          </div>
          <div class="out-id-slide" data-alumni-slide="4" data-jurusan="APHP">
            <article class="out-id-card">
              <div class="out-id-photo"><img src="{{ asset('images/faisal.png') }}" alt="Lulusan terbaik APHP SMK Negeri 2 Mojokerto" loading="lazy"></div>
              <div class="out-id-info">
                <div class="out-id-brand"><img src="{{ asset('images/logo_smkn2.png') }}" alt="SKANEDA"> SKANEDA Alumni</div>
                <span class="out-id-code">APHP / 2024</span>
                <h3 class="out-id-name">Faisal Fikri Rushdi Shihab</h3>
                <div class="out-id-role">Lulusan Terbaik — APHP</div>
                <div class="out-id-line"></div>
                <div class="out-id-meta">
                  <div><small>Tahun</small><b>2024</b></div>
                  <div><small>Status</small><b>Lulusan Terbaik</b></div>
                  <div><small>Jurusan</small><b>Agribisnis Pengolahan Hasil Pangan</b></div>
                  <div><small>Institusi</small><b>SMK Negeri 2 Mojokerto</b></div>
                </div>
                <div class="out-id-footer"><span class="out-id-chip"><i class="fa-solid fa-star"></i> Featured Alumni</span><span class="out-id-barcode"></span></div>
              </div>
            </article>
          </div>
        </div>
      </div>

      <div class="out-slider-controls" aria-label="Navigasi lulusan terbaik">
        <button class="out-arrow" id="alumniPrev" type="button" aria-label="Lulusan sebelumnya"><i class="fa-solid fa-arrow-left"></i></button>
        <div class="out-dots" id="alumniDots" aria-label="Pilihan slide lulusan">
          <button class="out-dot active" type="button" data-index="0" aria-label="RPL"></button>
          <button class="out-dot" type="button" data-index="1" aria-label="DKV"></button>
          <button class="out-dot" type="button" data-index="2" aria-label="Kuliner"></button>
          <button class="out-dot" type="button" data-index="3" aria-label="LPS"></button>
          <button class="out-dot" type="button" data-index="4" aria-label="APHP"></button>
        </div>
        <button class="out-arrow" id="alumniNext" type="button" aria-label="Lulusan berikutnya"><i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>
  </div>
</section>

<style>
/* ===== LULUSAN TERBAIK: 5 JURUSAN / 5 SLIDE ===== */
.out-alumni .out-jurusan-pill{cursor:pointer}
.out-alumni .out-jurusan-pill.active{background:#0d3a66 !important;color:#fff !important;border-color:#0d3a66 !important;box-shadow:0 10px 22px rgba(13,58,102,.16)}
.out-alumni .out-id-viewport{overflow:hidden}
.out-alumni .out-id-track{display:flex !important;width:100% !important;transition:transform .58s cubic-bezier(.22,.61,.36,1);will-change:transform}
.out-alumni .out-id-slide{flex:0 0 100% !important;width:100% !important;min-width:100% !important}
.out-alumni .out-id-meta{grid-template-columns:repeat(2,minmax(0,1fr))}
.out-alumni .out-dot{cursor:pointer}
@media(max-width:700px){.out-alumni .out-id-meta{grid-template-columns:1fr}}
</style>

<script>
(function(){
  var stage=document.querySelector('.out-alumni');
  var track=document.getElementById('alumniTrack');
  if(!stage||!track) return;
  var slides=Array.prototype.slice.call(track.querySelectorAll('.out-id-slide'));
  var pills=Array.prototype.slice.call(stage.querySelectorAll('.out-jurusan-pill'));
  var dots=Array.prototype.slice.call(stage.querySelectorAll('#alumniDots .out-dot'));
  var prev=document.getElementById('alumniPrev'), next=document.getElementById('alumniNext');
  var total=slides.length,current=0,locked=false,duration=580;
  function syncUI(index){
    current=(index+total)%total;
    track.style.transform='translateX(-'+(current*100)+'%)';
    pills.forEach(function(btn,i){var active=i===current;btn.classList.toggle('active',active);btn.setAttribute('aria-pressed',active?'true':'false');});
    dots.forEach(function(dot,i){dot.classList.toggle('active',i===current);});
    slides.forEach(function(slide,i){slide.setAttribute('aria-hidden',i===current?'false':'true');});
  }
  function setActive(index){if(locked||total<2)return;locked=true;syncUI(index);setTimeout(function(){locked=false;},duration);}
  pills.forEach(function(btn){btn.addEventListener('click',function(){var i=parseInt(btn.dataset.alumniIndex,10);if(!isNaN(i))setActive(i);});});
  dots.forEach(function(dot){dot.addEventListener('click',function(){var i=parseInt(dot.dataset.index,10);if(!isNaN(i))setActive(i);});});
  prev&&prev.addEventListener('click',function(){setActive(current-1);});
  next&&next.addEventListener('click',function(){setActive(current+1);});
  var startX=0,startY=0,swiping=false;
  stage.addEventListener('pointerdown',function(e){swiping=true;startX=e.clientX;startY=e.clientY;});
  stage.addEventListener('pointerup',function(e){if(!swiping)return;swiping=false;var dx=e.clientX-startX,dy=e.clientY-startY;if(Math.abs(dx)>45&&Math.abs(dx)>Math.abs(dy)){if(dx<0)setActive(current+1);else setActive(current-1);}});
  stage.addEventListener('pointercancel',function(){swiping=false;});
  document.addEventListener('keydown',function(e){if(e.key==='ArrowLeft')setActive(current-1);if(e.key==='ArrowRight')setActive(current+1);});
  syncUI(0);
})();
</script>

<!-- ================= KERJA SAMA INDUSTRI ================= -->
<section class="out-sec out-industry" id="kerja-sama-industri" aria-label="Kerja Sama Industri SMK Negeri 2 Mojokerto">
  <div class="industry-jurusan-decor" aria-hidden="true">
    <svg viewBox="0 0 1440 760" preserveAspectRatio="none">
      <path class="jd-diag" d="M-40 130 L180 -20 M-20 190 L240 -20 M20 250 L300 -20"/>
      <rect class="jd-square" x="76" y="86" width="62" height="62" transform="rotate(45 107 117)"/>
      <rect class="jd-square-fill" x="88" y="98" width="38" height="38" transform="rotate(45 107 117)"/>
      <path class="jd-corner" d="M46 214 H82 M46 214 V250"/>
      <circle class="jd-node" cx="46" cy="214" r="4"/>

      <path class="jd-diag-soft" d="M1180 64 H1270 V118 H1362"/>
      <path class="jd-diag-soft" d="M1218 30 V92 H1310 V150 H1410"/>
      <rect class="jd-square" x="1260" y="108" width="18" height="18"/>
      <rect class="jd-square" x="1352" y="140" width="18" height="18"/>
      <circle class="jd-node" cx="1180" cy="64" r="4"/>
      <circle class="jd-node" cx="1410" cy="150" r="4"/>

      <polygon class="jd-hex" points="88,390 116,374 144,390 144,422 116,438 88,422"/>
      <path class="jd-plus" d="M164 388 V414 M151 401 H177"/>
      <path class="jd-diag-soft" d="M42 466 H170 L220 416"/>

      <polygon class="jd-hex" points="1280,590 1320,567 1360,590 1360,636 1320,659 1280,636"/>
      <rect class="jd-square-fill" x="1368" y="604" width="22" height="22"/>
      <rect class="jd-square" x="1398" y="574" width="30" height="30"/>
      <path class="jd-diag" d="M1190 716 L1270 636 L1340 706 M1230 760 L1310 680 L1380 750"/>
      <path class="jd-corner" d="M1134 664 H1172 M1134 664 V702"/>
      <circle class="jd-node" cx="1134" cy="664" r="4"/>

      <path class="jd-grid" d="M0 560 L250 310 M0 600 L290 310 M1090 760 L1440 410 M1150 760 L1440 470"/>
    </svg>
  </div>
  <div class="out-wrap">
    <div class="out-center" data-reveal="title">
      <div class="out-kicker" style="justify-content:center">Industry Network</div>
      <h2 class="out-title">Kerja Sama <span class="gold">Industri</span></h2>
    </div>

    <div class="out-logo-window" data-reveal style="--d:1">
      <div class="out-logo-track" id="industryTrack">
        <div class="out-logo-group">
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/hummatech.png') }}" alt="Logo Hummatech" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/primafood.png') }}" alt="Logo PrimaFood" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/anekapay.png') }}" alt="Logo AnekaPay" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/minarsih.png') }}" alt="Logo Minarsih" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/digiprosb.png') }}" alt="Logo DigiproSB" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/smartfren.png') }}" alt="Logo Smartfren" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/hsp.png') }}" alt="Logo HSP" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/sido-jodo.png') }}" alt="Logo Sido Jodo" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/maspion-it.png') }}" alt="Logo Maspion IT" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/media-tama.png') }}" alt="Logo MediaTama" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/otak-kanan.png') }}" alt="Logo Otak Kanan" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/apika-finance.png') }}" alt="Logo Apika Finance" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/rs-islam-sakinah-mojokerto.png') }}" alt="Logo Rumah Sakit Islam Sakinah Mojokerto" loading="lazy"></div>
        </div>
        <div class="out-logo-group" aria-hidden="true">
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/hummatech.png') }}" alt="Logo Hummatech" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/primafood.png') }}" alt="Logo PrimaFood" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/anekapay.png') }}" alt="Logo AnekaPay" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/minarsih.png') }}" alt="Logo Minarsih" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/digiprosb.png') }}" alt="Logo DigiproSB" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/smartfren.png') }}" alt="Logo Smartfren" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/hsp.png') }}" alt="Logo HSP" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/sido-jodo.png') }}" alt="Logo Sido Jodo" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/maspion-it.png') }}" alt="Logo Maspion IT" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/media-tama.png') }}" alt="Logo MediaTama" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/otak-kanan.png') }}" alt="Logo Otak Kanan" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/apika-finance.png') }}" alt="Logo Apika Finance" loading="lazy"></div>
          <div class="out-logo-card"><img class="out-logo-only" src="{{ asset('images/industri/rs-islam-sakinah-mojokerto.png') }}" alt="Logo Rumah Sakit Islam Sakinah Mojokerto" loading="lazy"></div>
        </div>
      </div>
    </div>

    <div class="out-ind-pills" data-reveal style="--d:2">
      <span><i class="fa-solid fa-check"></i> Praktik Kerja Lapangan</span>
      <span><i class="fa-solid fa-check"></i> Rekrutmen Bersama</span>
      <span><i class="fa-solid fa-check"></i> Kurikulum Link &amp; Match</span>
      <span><i class="fa-solid fa-check"></i> Sertifikasi Kompetensi</span>
    </div>
  </div>
</section>

<!-- ================= LULUSAN PTN ================= -->
<style>
/* FINAL PTN ONLY — logo asli, tanpa lingkaran dekoratif */
.out-ptn .out-ptn-logo{
  width:154px!important;height:154px!important;
  border-radius:0!important;
  display:flex!important;align-items:center!important;justify-content:center!important;
  position:relative!important;background:transparent!important;
  border:0!important;box-shadow:none!important;overflow:visible!important;
}
.out-ptn .out-ptn-logo::before,
.out-ptn .out-ptn-logo::after{display:none!important;content:none!important}
.out-ptn .out-ptn-logo img{
  width:138px!important;height:138px!important;
  object-fit:contain!important;display:block!important;
  filter:none!important;
}
.out-ptn .out-ptn-logo-panel small{
  margin-top:.7rem!important;
}
.out-ptn .out-ptn-card-info h3{
  font-family:var(--font-display);
  font-size:clamp(1.2rem,2.3vw,1.8rem);
  line-height:1.08;
  color:#0d3a66;
  font-weight:900;
  margin:0 0 .65rem;
}
.out-ptn .out-ptn-student{
  display:flex;align-items:center;gap:.5rem;
  font-weight:800;color:#0d3a66;
}
.out-ptn .out-ptn-student i{color:#ffb300}
@media(max-width:700px){
  .out-ptn .out-ptn-logo{width:120px!important;height:120px!important}
  .out-ptn .out-ptn-logo img{width:108px!important;height:108px!important}
}
</style>

<section class="out-sec out-ptn" id="lulusan-ptn" aria-label="Lulusan Perguruan Tinggi Negeri SMK Negeri 2 Mojokerto">
  <div class="out-orn" aria-hidden="true">
    <span class="out-dots"></span><span class="out-diamond"></span>
    <span class="out-hex"></span><span class="out-plus"></span>
  </div>

  <div class="out-wrap out-ptn-layout">
    <div class="out-copy" data-reveal="left">
      <div class="out-kicker">Next Destination</div>
      <h2 class="out-title">Lulusan <span class="gold">PTN</span></h2>
      <p class="out-desc">Lulusan SMK Negeri 2 Mojokerto melanjutkan studi ke Perguruan Tinggi Negeri sebagai salah satu bukti kesiapan akademik dan kompetensi mereka.</p>
      <div class="out-ptn-route">
        <span><i class="fa-solid fa-school"></i> SMKN 2 Mojokerto</span>
        <i class="fa-solid fa-arrow-right-long"></i>
        <span class="gold"><i class="fa-solid fa-building-columns"></i> Perguruan Tinggi Negeri</span>
      </div>
    </div>

    <div class="out-ptn-stage" data-reveal style="--d:1">
      <div class="out-ptn-window">
        <div class="out-ptn-track" id="ptnTrack">

          <!-- 01 ITS -->
          <div class="out-ptn-slide">
            <article class="out-ptn-destination-card">
              <div class="out-ptn-card-top">
                <span class="out-ptn-card-kicker">DESTINATION 01</span>
                <span class="out-ptn-card-mark">PTN</span>
              </div>
              <div class="out-ptn-card-main">
                <div class="out-ptn-logo-panel">
                  <div class="out-ptn-logo">
                    <img src="{{ asset('images/ptn/its.png') }}" alt="Logo Institut Teknologi Sepuluh Nopember" loading="lazy">
                  </div>
                  <small>Institut Teknologi Sepuluh Nopember</small>
                </div>
                <div class="out-ptn-card-info">
                  <div class="out-ptn-label">Universitas tujuan</div>
                  <h3>Institut Teknologi Sepuluh Nopember</h3>
                  <div class="out-ptn-accent"></div>
                  <div class="out-ptn-label">Nama yang lolos</div>
                  <div class="out-ptn-student"><i class="fa-solid fa-star"></i><span>Nama Lulusan</span></div>
                  <p>Program studi &amp; jalur masuk — data dapat dilengkapi kemudian.</p>
                </div>
              </div>
              <div class="out-ptn-card-bottom">
                <span><i class="fa-solid fa-graduation-cap"></i> Next Destination</span>
                <span>SMKN 2 MOJOKERTO</span>
              </div>
            </article>
          </div>

          <!-- 02 UB -->
          <div class="out-ptn-slide">
            <article class="out-ptn-destination-card">
              <div class="out-ptn-card-top">
                <span class="out-ptn-card-kicker">DESTINATION 02</span>
                <span class="out-ptn-card-mark">PTN</span>
              </div>
              <div class="out-ptn-card-main">
                <div class="out-ptn-logo-panel">
                  <div class="out-ptn-logo">
                    <img src="{{ asset('images/ptn/brawijaya.png') }}" alt="Logo Universitas Brawijaya" loading="lazy">
                  </div>
                  <small>Universitas Brawijaya</small>
                </div>
                <div class="out-ptn-card-info">
                  <div class="out-ptn-label">Universitas tujuan</div>
                  <h3>Universitas Brawijaya</h3>
                  <div class="out-ptn-accent"></div>
                  <div class="out-ptn-label">Nama yang lolos</div>
                  <div class="out-ptn-student"><i class="fa-solid fa-star"></i><span>Nama Lulusan</span></div>
                  <p>Program studi &amp; jalur masuk — data dapat dilengkapi kemudian.</p>
                </div>
              </div>
              <div class="out-ptn-card-bottom">
                <span><i class="fa-solid fa-graduation-cap"></i> Next Destination</span>
                <span>SMKN 2 MOJOKERTO</span>
              </div>
            </article>
          </div>

          <!-- 03 POLINEMA -->
          <div class="out-ptn-slide">
            <article class="out-ptn-destination-card">
              <div class="out-ptn-card-top">
                <span class="out-ptn-card-kicker">DESTINATION 03</span>
                <span class="out-ptn-card-mark">PTN</span>
              </div>
              <div class="out-ptn-card-main">
                <div class="out-ptn-logo-panel">
                  <div class="out-ptn-logo">
                    <img src="{{ asset('images/ptn/polinema.png') }}" alt="Logo Politeknik Negeri Malang" loading="lazy">
                  </div>
                  <small>Politeknik Negeri Malang</small>
                </div>
                <div class="out-ptn-card-info">
                  <div class="out-ptn-label">Perguruan tinggi tujuan</div>
                  <h3>Politeknik Negeri Malang</h3>
                  <div class="out-ptn-accent"></div>
                  <div class="out-ptn-label">Nama yang lolos</div>
                  <div class="out-ptn-student"><i class="fa-solid fa-star"></i><span>Nama Lulusan</span></div>
                  <p>Program studi &amp; jalur masuk — data dapat dilengkapi kemudian.</p>
                </div>
              </div>
              <div class="out-ptn-card-bottom">
                <span><i class="fa-solid fa-graduation-cap"></i> Next Destination</span>
                <span>SMKN 2 MOJOKERTO</span>
              </div>
            </article>
          </div>

          <!-- 04 UM -->
          <div class="out-ptn-slide">
            <article class="out-ptn-destination-card">
              <div class="out-ptn-card-top">
                <span class="out-ptn-card-kicker">DESTINATION 04</span>
                <span class="out-ptn-card-mark">PTN</span>
              </div>
              <div class="out-ptn-card-main">
                <div class="out-ptn-logo-panel">
                  <div class="out-ptn-logo">
                    <img src="{{ asset('images/ptn/um-malang.png') }}" alt="Logo Universitas Negeri Malang" loading="lazy">
                  </div>
                  <small>Universitas Negeri Malang</small>
                </div>
                <div class="out-ptn-card-info">
                  <div class="out-ptn-label">Universitas tujuan</div>
                  <h3>Universitas Negeri Malang</h3>
                  <div class="out-ptn-accent"></div>
                  <div class="out-ptn-label">Nama yang lolos</div>
                  <div class="out-ptn-student"><i class="fa-solid fa-star"></i><span>Nama Lulusan</span></div>
                  <p>Program studi &amp; jalur masuk — data dapat dilengkapi kemudian.</p>
                </div>
              </div>
              <div class="out-ptn-card-bottom">
                <span><i class="fa-solid fa-graduation-cap"></i> Next Destination</span>
                <span>SMKN 2 MOJOKERTO</span>
              </div>
            </article>
          </div>

          <!-- 05 UNESA -->
          <div class="out-ptn-slide">
            <article class="out-ptn-destination-card">
              <div class="out-ptn-card-top">
                <span class="out-ptn-card-kicker">DESTINATION 05</span>
                <span class="out-ptn-card-mark">PTN</span>
              </div>
              <div class="out-ptn-card-main">
                <div class="out-ptn-logo-panel">
                  <div class="out-ptn-logo">
                    <img src="{{ asset('images/ptn/unesa.png') }}" alt="Logo Universitas Negeri Surabaya" loading="lazy">
                  </div>
                  <small>Universitas Negeri Surabaya</small>
                </div>
                <div class="out-ptn-card-info">
                  <div class="out-ptn-label">Universitas tujuan</div>
                  <h3>Universitas Negeri Surabaya</h3>
                  <div class="out-ptn-accent"></div>
                  <div class="out-ptn-label">Nama yang lolos</div>
                  <div class="out-ptn-student"><i class="fa-solid fa-star"></i><span>Nama Lulusan</span></div>
                  <p>Program studi &amp; jalur masuk — data dapat dilengkapi kemudian.</p>
                </div>
              </div>
              <div class="out-ptn-card-bottom">
                <span><i class="fa-solid fa-graduation-cap"></i> Next Destination</span>
                <span>SMKN 2 MOJOKERTO</span>
              </div>
            </article>
          </div>

        </div>
      </div>

      <div class="out-slider-controls" aria-label="Navigasi lulusan PTN">
        <button class="out-arrow" id="ptnPrev" type="button" aria-label="PTN sebelumnya"><i class="fa-solid fa-arrow-left"></i></button>
        <div class="out-dots" id="ptnDots">
          <button class="out-dot active" type="button" data-index="0" aria-label="PTN 1"></button>
          <button class="out-dot" type="button" data-index="1" aria-label="PTN 2"></button>
          <button class="out-dot" type="button" data-index="2" aria-label="PTN 3"></button>
          <button class="out-dot" type="button" data-index="3" aria-label="PTN 4"></button>
          <button class="out-dot" type="button" data-index="4" aria-label="PTN 5"></button>
        </div>
        <button class="out-arrow" id="ptnNext" type="button" aria-label="PTN berikutnya"><i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>
  </div>
</section>

<script>
(function(){
  var track=document.getElementById('ptnTrack');
  var prev=document.getElementById('ptnPrev');
  var next=document.getElementById('ptnNext');
  var dotsWrap=document.getElementById('ptnDots');
  if(!track||!prev||!next||!dotsWrap) return;

  var slides=Array.prototype.slice.call(track.querySelectorAll('.out-ptn-slide'));
  var dots=Array.prototype.slice.call(dotsWrap.querySelectorAll('.out-dot'));
  var index=0;
  var dragging=false,startX=0,startScroll=0;

  function render(){
    track.style.transform='translateX(-'+(index*100)+'%)';
    dots.forEach(function(dot,i){dot.classList.toggle('active',i===index);});
    prev.disabled=index===0;
    next.disabled=index===slides.length-1;
  }
  function go(i){index=Math.max(0,Math.min(slides.length-1,i));render();}

  prev.addEventListener('click',function(){go(index-1);});
  next.addEventListener('click',function(){go(index+1);});
  dots.forEach(function(dot,i){dot.addEventListener('click',function(){go(i);});});

  track.addEventListener('pointerdown',function(e){
    dragging=true;startX=e.clientX;startScroll=track.scrollLeft;
    track.classList.add('dragging');
    try{track.setPointerCapture(e.pointerId);}catch(_){ }
  });
  track.addEventListener('pointermove',function(e){
    if(!dragging)return;
    var dx=e.clientX-startX;
    if(Math.abs(dx)>25) e.preventDefault();
    track.style.transform='translateX(calc(-'+(index*100)+'% + '+dx+'px))';
  });
  function finishDrag(e){
    if(!dragging)return;
    var dx=e.clientX-startX;
    dragging=false;track.classList.remove('dragging');
    if(Math.abs(dx)>55){go(index+(dx<0?1:-1));}else{render();}
  }
  track.addEventListener('pointerup',finishDrag);
  track.addEventListener('pointercancel',function(){dragging=false;track.classList.remove('dragging');render();});

  document.addEventListener('keydown',function(e){
    if(e.key==='ArrowLeft')go(index-1);
    if(e.key==='ArrowRight')go(index+1);
  });
  render();
})();
</script>

<!-- ================= PRESTASI ================= -->
<section class="prestasi-section" id="prestasi" aria-label="Prestasi Sekolah SMK Negeri 2 Mojokerto">
  <div class="prestasi-ornament" aria-hidden="true">
    <span class="prestasi-dots"></span>
    <span class="prestasi-diamond"></span>
    <span class="prestasi-line"></span>
  </div>

  <div class="prestasi-wrap">
    <header class="prestasi-head" data-reveal="title">
      <div class="prestasi-kicker">SKANEDA Achievement</div>
      <h2 class="prestasi-title">Prestasi <span class="gold">Sekolah</span></h2>
      <p class="prestasi-desc">
        Semangat disiplin dan berprestasi membawa SMK Negeri 2 Mojokerto meraih berbagai capaian
        di tingkat provinsi hingga nasional.
      </p>
    </header>

    <div class="prestasi-feed-shell" data-reveal style="--d:1">
      <button class="prestasi-arrow prestasi-arrow-left" id="prestasiPrev" type="button" aria-label="Prestasi sebelumnya">
        <i class="fa-solid fa-arrow-left"></i>
      </button>

      <div class="prestasi-feed-viewport">
        <div class="prestasi-feed-rail" id="prestasiFeedRail" aria-label="Prestasi sekolah">

          {{-- ================= LKS ================= --}}
          <article class="prestasi-feed">
            <div class="prestasi-feed-head">
              <div class="prestasi-feed-avatar"><i class="fa-solid fa-medal"></i></div>
              <div class="prestasi-feed-account">
                <strong>SKANEDA</strong>
                <span>SMK Negeri 2 Mojokerto</span>
              </div>
              <div class="prestasi-feed-more" aria-hidden="true">•••</div>
            </div>

            <div class="prestasi-feed-media">
              <img
                src="{{ asset('images/prestasi-lks.jpeg') }}"
                alt="Prestasi LKS SMK Negeri 2 Mojokerto"
                loading="lazy"
                style="width:100%;height:100%;object-fit:cover;display:block;"
              >
            </div>

            <div class="prestasi-feed-body">
              <div class="prestasi-feed-actions" aria-hidden="true">
                <i class="fa-regular fa-heart"></i>
                <i class="fa-regular fa-comment"></i>
                <i class="fa-regular fa-paper-plane"></i>
                <i class="fa-regular fa-bookmark save"></i>
              </div>
              <span class="prestasi-feed-tag">Medali Perak — Nasional</span>
              <h3>SMKN 2 Mojokerto Raih <span>Medali Perak LKS</span></h3>
              <p>
                Prestasi gemilang diraih pada Lomba Kompetensi Siswa SMK bidang Patisserie and Confectionery tingkat nasional.
              </p>
              <div class="prestasi-feed-meta">
                <span><i class="fa-solid fa-medal"></i> LKS Nasional</span>
                <span><i class="fa-solid fa-flag"></i> Tingkat Nasional</span>
              </div>
            </div>
          </article>

          {{-- ================= ADIWIYATA ================= --}}
          <article class="prestasi-feed">
            <div class="prestasi-feed-head">
              <div class="prestasi-feed-avatar"><i class="fa-solid fa-leaf"></i></div>
              <div class="prestasi-feed-account">
                <strong>SKANEDA</strong>
                <span>SMK Negeri 2 Mojokerto</span>
              </div>
              <div class="prestasi-feed-more" aria-hidden="true">•••</div>
            </div>

            <div class="prestasi-feed-media">
              <img
                src="{{ asset('images/prestasi-adiwiyata.jpeg') }}"
                alt="Penghargaan Adiwiyata SMK Negeri 2 Mojokerto"
                loading="lazy"
                style="width:100%;height:100%;object-fit:cover;display:block;"
              >
            </div>

            <div class="prestasi-feed-body">
              <div class="prestasi-feed-actions" aria-hidden="true">
                <i class="fa-regular fa-heart"></i>
                <i class="fa-regular fa-comment"></i>
                <i class="fa-regular fa-paper-plane"></i>
                <i class="fa-regular fa-bookmark save"></i>
              </div>
              <span class="prestasi-feed-tag">Adiwiyata — Provinsi</span>
              <h3>SMKN 2 Mojokerto Raih <span>Adiwiyata Provinsi</span></h3>
              <p>
                Sekolah berhasil meraih penghargaan Sekolah Adiwiyata Provinsi Jawa Timur setelah masuk Top 20 calon terbaik.
              </p>
              <div class="prestasi-feed-meta">
                <span><i class="fa-solid fa-leaf"></i> Adiwiyata</span>
                <span><i class="fa-solid fa-location-dot"></i> Jawa Timur</span>
              </div>
            </div>
          </article>

          {{-- ================= KLIC ================= --}}
          <article class="prestasi-feed">
            <div class="prestasi-feed-head">
              <div class="prestasi-feed-avatar"><i class="fa-solid fa-laptop-code"></i></div>
              <div class="prestasi-feed-account">
                <strong>SKANEDA</strong>
                <span>SMK Negeri 2 Mojokerto</span>
              </div>
              <div class="prestasi-feed-more" aria-hidden="true">•••</div>
            </div>

            <div class="prestasi-feed-media">
              <img
                src="{{ asset('images/prestasi-klic.jpeg') }}"
                alt="Prestasi Program Korea E-Learning Improvement Cooperation KLIC SMK Negeri 2 Mojokerto"
                loading="lazy"
                style="width:100%;height:100%;object-fit:cover;display:block;"
              >
            </div>

            <div class="prestasi-feed-body">
              <div class="prestasi-feed-actions" aria-hidden="true">
                <i class="fa-regular fa-heart"></i>
                <i class="fa-regular fa-comment"></i>
                <i class="fa-regular fa-paper-plane"></i>
                <i class="fa-regular fa-bookmark save"></i>
              </div>
              <span class="prestasi-feed-tag">Prestasi — Program KLIC</span>
              <h3>SMKN 2 Mojokerto Raih Prestasi di <span>Program KLIC</span></h3>
              <p>
                Luar biasa! SMK Negeri 2 Mojokerto kembali memahatkan prestasi terbaiknya di kancah pendidikan melalui program Korea E-Learning Improvement Cooperation (KLIC).
              </p>
              <div class="prestasi-feed-meta">
                <span><i class="fa-solid fa-calendar"></i> 2025</span>
                <span><i class="fa-solid fa-award"></i> Korea E-Learning Improvement Cooperation</span>
              </div>
            </div>
          </article>

        </div>
      </div>

      <button class="prestasi-arrow prestasi-arrow-right" id="prestasiNext" type="button" aria-label="Prestasi berikutnya">
        <i class="fa-solid fa-arrow-right"></i>
      </button>
    </div>

    <div class="prestasi-note">Geser atau drag untuk melihat prestasi lainnya</div>
  </div>

  <script>
  (function(){
    var rail = document.getElementById('prestasiFeedRail');
    var prev = document.getElementById('prestasiPrev');
    var next = document.getElementById('prestasiNext');
    if(!rail || !prev || !next) return;

    function getStep(){
      var card = rail.querySelector('.prestasi-feed');
      if(!card) return rail.clientWidth;
      var gap = parseFloat(getComputedStyle(rail).gap) || 0;
      return card.getBoundingClientRect().width + gap;
    }

    function updateButtons(){
      var max = rail.scrollWidth - rail.clientWidth - 2;
      prev.disabled = rail.scrollLeft <= 2;
      next.disabled = rail.scrollLeft >= max;
    }

    prev.addEventListener('click', function(){
      rail.scrollBy({left:-getStep(), behavior:'smooth'});
    });

    next.addEventListener('click', function(){
      rail.scrollBy({left:getStep(), behavior:'smooth'});
    });

    rail.addEventListener('scroll', updateButtons, {passive:true});
    window.addEventListener('resize', updateButtons, {passive:true});

    var dragging = false;
    var startX = 0;
    var startScroll = 0;

    rail.addEventListener('pointerdown', function(e){
      dragging = true;
      startX = e.clientX;
      startScroll = rail.scrollLeft;
      rail.classList.add('is-dragging');
      try{ rail.setPointerCapture(e.pointerId); }catch(_){}
    });

    rail.addEventListener('pointermove', function(e){
      if(!dragging) return;
      rail.scrollLeft = startScroll - (e.clientX - startX);
    });

    function stopDrag(){
      dragging = false;
      rail.classList.remove('is-dragging');
    }

    rail.addEventListener('pointerup', stopDrag);
    rail.addEventListener('pointercancel', stopDrag);
    rail.addEventListener('lostpointercapture', stopDrag);

    updateButtons();
  })();
  </script>
</section>

<!-- ================= KONTAK & FOOTER ================= -->
<section class="kontak-section section-py" id="kontak" aria-label="Kontak dan lokasi sekolah">
  <div class="container">
    <div class="ft-wrap">
      <div class="ft-head" data-reveal="title">
        <div class="ft-eyebrow">Temukan Kami</div>
        <h2 class="ft-title">Temukan <span class="gold">Kami</span></h2>
        <p class="ft-sub" data-reveal="text" style="--d:1">Kami siap membantu Anda.</p>
        <p class="ft-line" data-reveal="text" style="--d:2">Informasi sekolah, PPDB, dan program keahlian.</p>
      </div>
      <div class="ft-map" data-reveal style="--d:1">
        <div class="ft-pin" aria-hidden="true">
          <div class="ft-pin-badge"><img src="{{ asset('images/logo_smkn2.png') }}" alt="" /></div>
          <div class="ft-pin-ring"></div>
          <div class="ft-pin-ring r2"></div>
        </div>
        <iframe title="Lokasi SMK Negeri 2 Mojokerto" src="https://www.google.com/maps?q=Jl.%20Raya%20Pulorejo%2C%20Kel.%20Pulorejo%2C%20Kec.%20Prajurit%20Kulon%2C%20Kota%20Mojokerto%2C%20Jawa%20Timur%2061325&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
        <div class="ft-card" data-reveal style="--d:2">
          <div class="ft-card-head">
            <div class="ft-card-logo"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMKN 2 Mojokerto" /></div>
            <div class="ft-card-title">SMKN 2 MOJOKERTO<small>Kontak &amp; Informasi</small></div>
          </div>
          <div class="ft-card-div"></div>
          <div class="ft-row">
            <div class="ft-row-icon"><i class="fas fa-location-dot"></i></div>
            <div>
              <div class="ft-row-label">Alamat</div>
              <div class="ft-row-value">Jl. Raya Pulorejo, Kel. Pulorejo, Kec. Prajurit Kulon, Kota Mojokerto, Jawa Timur 61325</div>
            </div>
          </div>
          <div class="ft-row">
            <div class="ft-row-icon"><i class="fas fa-phone"></i></div>
            <div>
              <div class="ft-row-label">Telepon</div>
              <div class="ft-row-value"><a href="tel:031222929922">0312 2292 9922</a></div>
            </div>
          </div>
          <div class="ft-row">
            <div class="ft-row-icon"><i class="fas fa-envelope"></i></div>
            <div>
              <div class="ft-row-label">Email</div>
              <div class="ft-row-value"><a href="mailto:info@smkn2mojokerto.sch.id">info@smkn2mojokerto.sch.id</a></div>
            </div>
          </div>
          <div class="ft-row">
            <div class="ft-row-icon"><i class="fas fa-clock"></i></div>
            <div>
              <div class="ft-row-label">Jam Operasional</div>
              <div class="ft-row-value">Senin&ndash;Jumat &middot; 07.00&ndash;16.00 WIB</div>
            </div>
          </div>
          <hr class="ft-stub" />
          <a class="ft-map-btn" href="https://www.google.com/maps/search/?api=1&amp;query=Jalan+Raya+Pulorejo%2C+Kelurahan+Pulorejo%2C+Kecamatan+Prajurit+Kulon%2C+Kota+Mojokerto%2C+Jawa+Timur+61325" target="_blank" rel="noopener">
            Buka di Google Maps <i class="fa-solid fa-arrow-up-right-from-square"></i>
          </a>
        </div>
      </div>
      <div class="ft-cta" data-reveal style="--d:3">
        <p>Punya pertanyaan? Kami siap membantu memberikan informasi seputar sekolah dan PPDB.</p>
        <button type="button" class="ft-cta-btn" onclick="toggleSibot()">Hubungi Kami <i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  /* ============================================================
     JS KHUSUS KONTEN BERANDA
     (dipertahankan dari welcome.blade.php v4 — hanya bagian konten)
     ============================================================ */

  /* ---- Intro Video Fullscreen (skip + auto lanjut ke hero) ---- */
  (function() {
    var introEl  = document.getElementById('hdIntro');
    var introVid = document.getElementById('hdIntroVideo');
    var skipBtn  = document.getElementById('hdIntroSkip');
    if (!introEl || !introVid || !skipBtn) return;

    var done = false;
    function closeIntro() {
      if (done) return;               // hanya boleh jalan SATU KALI
      done = true;
      introEl.classList.add('hd-hidden');
      document.body.style.overflow = '';
      try { introVid.pause(); } catch(e) {}
    }
    skipBtn.addEventListener('click', closeIntro);
    introVid.addEventListener('ended', closeIntro);

    /* Kunci scroll selama intro; video diputar SATU KALI (tanpa loop).
       play() diberi fallback aman: jika autoplay diblokir, intro tetap bisa
       dilewati via tombol. Tidak ada interval/RAF berulang untuk video. */
    document.body.style.overflow = 'hidden';
    var p = introVid.play();
    if (p && p.catch) p.catch(function(){});
  })();

  /* ---- Scroll Reveal ---- */
  var revealEls = document.querySelectorAll('[data-reveal]');
  function revealMark(el){ el.classList.add('revealed'); el.classList.add('is-visible'); }
  var revealObs = new IntersectionObserver(function(entries) {
    entries.forEach(function(e) { if(e.isIntersecting) { revealMark(e.target); revealObs.unobserve(e.target); } });
  }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
  revealEls.forEach(function(el){ revealObs.observe(el); });

  /* Safety-net: elemen yang sebenarnya sudah masuk viewport wajib tampil
     (mencakup full-page capture / observer yang tidak sempat menembak) */
  (function(){
    var pending = Array.prototype.slice.call(revealEls);
    var checks = 0;
    var iv = setInterval(function(){
      checks++;
      var vh = window.innerHeight;
      pending = pending.filter(function(el){
        if(el.classList.contains('revealed')) return false;
        var r = el.getBoundingClientRect();
        if(r.top < vh + 220 && r.bottom > -40){ revealMark(el); return false; }
        return true;
      });
      /* Force reveal semua yang tersisa setelah ~3.6 detik agar konten
         tidak pernah selamanya tersembunyi (mis. hero lebih tinggi dari viewport) */
      if(checks >= 8){
        pending.forEach(function(el){ revealMark(el); });
        clearInterval(iv);
      } else if(pending.length === 0){
        clearInterval(iv);
      }
    }, 450);
  })();


    /* Parallax halus: konten hero bergeser perlahan saat scroll (efek depth di atas foto) */
    var heroMainEl = document.querySelector('.hero-main');
    var heroSectionEl = document.getElementById('beranda');
    function heroParallax(){
      if(!heroMainEl || !heroSectionEl) return;
      var r = heroSectionEl.getBoundingClientRect();
      if(r.bottom < 0 || r.top > window.innerHeight) return;
      var p = Math.min(Math.max(-r.top, 0), window.innerHeight);
      heroMainEl.style.transform = 'translateY(' + (p * 0.14).toFixed(1) + 'px)';
    }
    window.addEventListener('scroll', heroParallax, {passive:true});
    heroParallax();

  /* ---- Counter Animation ---- */
  function animateCounter(el, target) {
    var start = 0; var duration = 2000; var step = target / (duration/16);
    var hasSuffix = el.innerHTML.indexOf('+') !== -1 ? '+' : el.innerHTML.indexOf('%') !== -1 ? '%' : '';
    var timer = setInterval(function() {
      start += step;
      if(start >= target) { start = target; clearInterval(timer); }
      el.innerHTML = Math.floor(start) + (hasSuffix ? '<span>'+hasSuffix+'</span>' : '');
    }, 16);
  }
  var counterObs = new IntersectionObserver(function(entries) {
    entries.forEach(function(e) {
      if(e.isIntersecting) {
        var el = e.target;
        var target = parseInt(el.dataset.count, 10);
        animateCounter(el, target);
        counterObs.unobserve(el);
      }
    });
  }, { threshold: 0.5 });
  var counterEls = document.querySelectorAll('[data-count]');
  counterEls.forEach(function(el){ counterObs.observe(el); });

  /* safety-net counter: angka statistik harus terisi walau observer belum menembak */
  (function(){
    var pending = Array.prototype.slice.call(counterEls);
    var checks = 0;
    var iv = setInterval(function(){
      checks++;
      var vh = window.innerHeight;
      pending = pending.filter(function(el){
        if(el.dataset.animated) return false;
        var r = el.getBoundingClientRect();
        if(r.top < vh + 220 && r.bottom > -40){
          el.dataset.animated = '1';
          animateCounter(el, parseInt(el.dataset.count, 10));
          return false;
        }
        return true;
      });
      if(pending.length === 0 || checks > 20) clearInterval(iv);
    }, 450);
  })();

  /* ---- Flipbook Buku Sejarah ---- */


</script>
<script>
    // ---------- JENDELA KEPALA SEKOLAH (corporate glass window) ----------
    (function(){
      var winSection=document.getElementById('sambutan');
      var frame=document.getElementById('kepsekWindow');
      var btn=document.getElementById('kepsekKnockBtn');
      var closeBtn=document.getElementById('kepsekCloseBtn');
      if(!frame||!winSection)return;

      function openWindow(){
        if(winSection.classList.contains('open'))return;
        winSection.classList.add('open');
      }
      function closeWindow(){winSection.classList.remove('open');}

      if(btn){btn.addEventListener('click',function(e){e.stopPropagation();openWindow();});}
      if(closeBtn){closeBtn.addEventListener('click',function(e){e.stopPropagation();closeWindow();});}
      if(frame){frame.addEventListener('click',function(e){
        if(e.target===closeBtn)return;
        if(!winSection.classList.contains('open')){openWindow();}
      });}
      if(btn){btn.addEventListener('keydown',function(e){
        if(e.key==='Enter'||e.key===' '){e.preventDefault();openWindow();}
      });}

      // ---------- AUTO-OPEN SAAT SCROLL (IntersectionObserver) ----------
      // Buka jendela otomatis SEKALI saja ketika section sambutan masuk viewport (>= 30%).
      // Tidak memakai setInterval/scroll berulang; observer di-disconnect setelah trigger.
      if('IntersectionObserver' in window){
        var hasAutoOpened=false;
        var autoObs=new IntersectionObserver(function(entries){
          if(hasAutoOpened)return;
          if(!entries.length)return;
          if(!entries[0].isIntersecting)return;
          // Jika user sudah membuka manual lebih dulu, jangan jalankan animasi lagi.
          if(winSection.classList.contains('open')){hasAutoOpened=true;}
          else{openWindow();hasAutoOpened=true;}
          autoObs.disconnect();
        },{root:null,threshold:0.3});
        autoObs.observe(winSection);
      }
    })();
</script>
<script>
    // ---------- JURUSAN: CAROUSEL 3 KARTU (center active, loop infinite) ----------
  (function(){
    var stage = document.getElementById('carouselStage');
    if(!stage) return;
    var cards = Array.prototype.slice.call(stage.querySelectorAll('.carousel-card'));
    var prevBtn = document.getElementById('carouselPrev');
    var nextBtn = document.getElementById('carouselNext');
    var dotsWrap = document.getElementById('carouselDots');
    var dots = dotsWrap ? Array.prototype.slice.call(dotsWrap.querySelectorAll('.carousel-dot')) : [];
    var total = cards.length;
    // Urutan tampilan kiri→kanan: RPL, KULINER, LPS, DKV, APHP (index data)
    var ORDER = [4,2,3,1,0];
    var activeIdx = ORDER.indexOf(2); // awal: KULINER di tengah (RPL kiri, LPS kanan)
    var locked = false;
    var DUR = 620;

    function posName(j){
      var d = (ORDER.indexOf(j) - activeIdx + total) % total;
      if(d === 0) return 'active';
      if(d === 1) return 'next';
      if(d === total - 1) return 'prev';
      if(d === 2) return 'far-r';
      return 'far-l';
    }
    function render(){
      cards.forEach(function(c){
        var j = parseInt(c.getAttribute('data-index'), 10);
        var p = posName(j);
        c.className = 'carousel-card' + (p === 'active' ? ' active' : '');
        c.setAttribute('data-pos', p);
      });
      dots.forEach(function(d, i){ d.classList.toggle('active', ORDER[activeIdx] === i); });
    }
    function setActive(idx){
      activeIdx = (idx + total) % total;
      render();
    }
    function goNext(){
      if(locked) return;
      locked = true;
      setActive(activeIdx + 1);
      setTimeout(function(){ locked = false; }, DUR);
    }
    function goPrev(){
      if(locked) return;
      locked = true;
      setActive(activeIdx - 1);
      setTimeout(function(){ locked = false; }, DUR);
    }

    var suppressClick = false;
    cards.forEach(function(c){
      c.addEventListener('click', function(e){
        if(suppressClick){ suppressClick = false; return; }
        if(e.target.closest('a')) return; // link "Lihat Jurusan" tetap bernavigasi
        var p = c.getAttribute('data-pos');
        if(p === 'prev') setActive(activeIdx - 1);
        else if(p === 'next') setActive(activeIdx + 1);
      });
      c.addEventListener('keydown', function(e){
        if(e.key === 'Enter' || e.key === ' '){
          e.preventDefault();
          var p = c.getAttribute('data-pos');
          if(p === 'prev') setActive(activeIdx - 1);
          else if(p === 'next') setActive(activeIdx + 1);
        }
      });
    });
    if(prevBtn) prevBtn.addEventListener('click', goPrev);
    if(nextBtn) nextBtn.addEventListener('click', goNext);
    dots.forEach(function(d, i){
      d.addEventListener('click', function(){
        var j = ORDER.indexOf(i);
        if(j > -1) setActive(j);
      });
    });

    document.addEventListener('keydown', function(e){
      var s = document.getElementById('sambutan');
      if(s && s.classList.contains('open')) return;
      if(e.key === 'ArrowLeft') goPrev();
      if(e.key === 'ArrowRight') goNext();
    });

    // Swipe / drag — pointer events mencakup mouse & sentuhan
    var startX = 0, startY = 0, swiping = false, moved = false;
    stage.addEventListener('pointerdown', function(e){
      swiping = true; moved = false;
      startX = e.clientX; startY = e.clientY;
    });
    stage.addEventListener('pointermove', function(e){
      if(!swiping) return;
      var dx = e.clientX - startX, dy = e.clientY - startY;
      if(Math.abs(dx) > 12 && Math.abs(dx) > Math.abs(dy)) moved = true;
    });
    stage.addEventListener('pointerup', function(e){
      if(!swiping) return;
      swiping = false;
      if(!moved) return;
      var dx = e.clientX - startX;
      suppressClick = true;
      if(Math.abs(dx) > 40){ if(dx < 0) goNext(); else goPrev(); }
    });
    stage.addEventListener('pointercancel', function(){ swiping = false; moved = false; });

    render();
  })();
</script>

@endpush
