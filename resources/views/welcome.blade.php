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

    /* ---------- PROFIL: decorative language berbeda dari Jurusan ---------- */
    .profil-section{position:relative;overflow:hidden;background:var(--bg)}
    .profil-section>.container{position:relative;z-index:2}
    .profil-section .section-title{font-size:clamp(2.35rem,5vw,4.2rem);line-height:1.02;letter-spacing:.01em;margin-bottom:1rem;font-style:normal}
    .profil-section .section-title .accent{background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent}
    .profil-decor{position:absolute;inset:0;z-index:0;pointer-events:none;overflow:hidden}
    .profil-decor svg{position:absolute;width:100%;height:100%;inset:0}
    /* Profil memakai lingkaran konsentris + grid titik + aksen sudut, bukan pola garis Jurusan */
    .pd-ring{fill:none;stroke:#0d3a66;stroke-width:2;opacity:.16}
    .pd-ring-gold{fill:none;stroke:#ffb300;stroke-width:2.4;opacity:.42}
    .pd-dot{fill:#0d3a66;opacity:.30}
    .pd-dot-gold{fill:#ffb300;opacity:.62}
    .pd-bar{fill:url(#profileGold);opacity:.72}
    .pd-bar-navy{fill:#0d3a66;opacity:.78}
    .pd-corner{fill:none;stroke:#0d3a66;stroke-width:3;opacity:.18}
    @media(max-width:640px){
      .profil-section .section-title{font-size:clamp(2rem,10vw,3rem)}
      .profil-decor{opacity:.68}
    }
    .section-desc{color:var(--text-muted);max-width:640px;font-size:.96rem}
    .section-header.center{text-align:center}
    .section-header.center .section-desc{margin:0 auto}
    .section-header.center .section-label::before{display:none}
    @media(max-width:640px){
      .section-title,.ft-title{font-size:clamp(1.65rem,7vw,2.2rem);line-height:1.12}
    }

    /* ---------- SCROLL REVEAL ---------- */
    [data-reveal]{opacity:0;transform:translateY(36px);transition:opacity .85s var(--ease),transform .85s var(--ease);will-change:opacity,transform}
    [data-reveal="left"]{transform:translateX(-46px)}
    [data-reveal="right"]{transform:translateX(46px)}
    [data-reveal].revealed{opacity:1;transform:none}
    [data-reveal]{transition-delay:calc(var(--d,0)*90ms)}

        /* ---------- PROFIL: FLIPBOOK BUKU SEJARAH ---------- */
    .flipbook{position:relative}
    .flipbook-stage{position:relative;display:flex;align-items:stretch;gap:1.1rem}
    .flip-nav{flex-shrink:0;width:54px;height:54px;border-radius:50%;border:0;cursor:pointer;color:#fff;font-size:1.05rem;background:linear-gradient(135deg,var(--teal),var(--teal-dark));box-shadow:0 12px 26px rgba(13,58,102,.35);transition:all .3s var(--ease);z-index:6;align-self:center}
    .flip-nav:hover{transform:translateY(-3px) scale(1.06);box-shadow:0 16px 34px rgba(13,58,102,.45)}
    .flip-nav:disabled{opacity:.35;cursor:not-allowed;transform:none;box-shadow:none}
    .book3d{position:relative;flex:1;min-width:0;aspect-ratio:2.05/1;min-height:430px;perspective:2400px;border-radius:20px;overflow:hidden;box-shadow:0 40px 90px rgba(13,58,102,.28)}
    .book-sheet{position:absolute;inset:0;display:grid;grid-template-columns:1fr 1fr;border-radius:20px;visibility:hidden;opacity:0;transform-style:preserve-3d;backface-visibility:hidden;-webkit-backface-visibility:hidden}
    .book-sheet.active{visibility:visible;opacity:1;z-index:2}
    .book-sheet.reveal-under{visibility:visible;opacity:1;z-index:1}
    .book-sheet.turning-fwd{position:absolute;z-index:4;visibility:visible;opacity:1;transform-origin:left center;animation:flipFwd .9s var(--ease) forwards}
    .book-sheet.turning-bwd{position:absolute;z-index:4;visibility:visible;opacity:1;transform-origin:right center;animation:flipBwd .9s var(--ease) forwards}
    @keyframes flipFwd{0%{transform:rotateY(0)}100%{transform:rotateY(-180deg)}}
    @keyframes flipBwd{0%{transform:rotateY(0)}100%{transform:rotateY(180deg)}}
    .book-spine{position:absolute;left:50%;top:0;bottom:0;width:26px;transform:translateX(-50%);z-index:3;pointer-events:none;background:linear-gradient(90deg,rgba(0,0,0,.18),rgba(255,255,255,.12) 30%,rgba(0,0,0,.06) 50%,rgba(255,255,255,.12) 70%,rgba(0,0,0,.18));box-shadow:0 0 16px rgba(0,0,0,.14)}
    .book-spine::after{content:"";position:absolute;left:50%;top:6px;bottom:6px;width:1px;background:rgba(0,0,0,.28)}
    .book-leaf{position:relative;display:flex;flex-direction:column;overflow:hidden;padding:1.8rem 2.1rem;height:100%;min-height:0}
    .book-leaf:first-child{border-radius:20px 4px 4px 20px}
    .book-leaf:last-child{border-radius:4px 20px 20px 4px}
    .book-leaf.cover,.book-leaf.back{background:linear-gradient(150deg,#0d3a66 0%,#15569c 55%,#1d6fb8 100%);color:#fff}
    .book-leaf.cover{box-shadow:inset -3px 0 6px rgba(0,0,0,.18)}
    .book-leaf.back{box-shadow:inset 3px 0 6px rgba(0,0,0,.18);align-items:center;justify-content:center;text-align:center;gap:.9rem}
    .book-leaf.paper{background:linear-gradient(115deg,#fdf9ec,#f8efdc 55%,#f5ead2);color:#44403a;box-shadow:inset 3px 0 6px rgba(0,0,0,.08)}
    .book-leaf.paper::before{content:"";position:absolute;inset:0;pointer-events:none;background:repeating-linear-gradient(180deg,transparent 0 26px,rgba(120,100,60,.09) 26px 27px)}
    .book-leaf.paper:last-child::after{content:"";position:absolute;right:0;bottom:0;width:64px;height:64px;background:linear-gradient(225deg,transparent 50%,rgba(120,100,60,.14) 50%,rgba(120,100,60,.24));border-radius:0 0 12px 0}
    .book-cover-top{position:relative;z-index:2;display:flex;align-items:center;justify-content:space-between;gap:.8rem}
    .profil-akreditasi{display:inline-flex;align-items:center;gap:.5rem;font-size:.72rem;font-weight:700;color:#0d3a66;background:linear-gradient(135deg,var(--gold),#ffd54f);padding:.4rem .85rem;border-radius:99px;box-shadow:0 8px 20px rgba(249,168,37,.4)}
    .book-cover-kicker{font-size:.68rem;letter-spacing:.28em;text-transform:uppercase;color:rgba(255,255,255,.75);white-space:nowrap}
    .book-cover-photo{position:relative;z-index:2;flex:1;min-height:0;display:flex;margin:1rem 0;border-radius:14px;overflow:hidden;border:3px solid rgba(255,255,255,.85);box-shadow:0 18px 36px rgba(0,0,0,.35)}
    .book-cover-photo img{width:100%;height:100%;object-fit:cover;display:block}
    .book-cover-photo::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 52%,rgba(13,58,102,.5))}
    .book-cover-title{position:relative;z-index:2}
    .book-cover-eyebrow{font-size:.74rem;letter-spacing:.4em;text-transform:uppercase;color:var(--gold);font-weight:800}
    .book-cover-school{font-family:var(--font-display);font-size:clamp(1.3rem,2.1vw,1.8rem);line-height:1.15;text-transform:uppercase;margin:.35rem 0 .4rem}
    .book-cover-school .num-2{color:#ffb300}
    .book-cover-sub{font-size:.8rem;color:rgba(255,255,255,.78)}
    .book-page-head{position:relative;z-index:2;display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;margin-bottom:1rem}
    .book-page-kicker{font-size:.66rem;letter-spacing:.26em;text-transform:uppercase;color:var(--teal);font-weight:800;margin-bottom:.3rem}
    .book-page-title{font-family:var(--font-display);font-size:clamp(1rem,1.7vw,1.35rem);color:#234a75;line-height:1.2}
    .book-page-title .num-2{color:#f57c00}
    .book-page-no{font-family:var(--font-display);font-size:2rem;color:rgba(120,100,60,.35);line-height:1}
    .book-page-text{position:relative;z-index:2;font-size:.84rem;line-height:1.82;color:#4d463c;margin-bottom:.65rem;text-align:justify}
    .book-page-text:first-of-type::first-letter{font-family:var(--font-display);font-size:2.3em;float:left;line-height:.9;padding:0 .18em 0 0;color:var(--teal);font-weight:800}
    .book-timeline{position:relative;z-index:2;margin:.7rem 0 .9rem;border-top:1px dashed rgba(120,100,60,.35);padding-top:.75rem;display:flex;flex-direction:column;gap:.45rem}
    .book-milestone{display:flex;gap:.8rem;align-items:baseline}
    .book-year{flex-shrink:0;font-family:var(--font-display);font-weight:800;font-size:.82rem;color:var(--teal);min-width:50px}
    .book-mile-text{font-size:.75rem;color:#4d463c;line-height:1.5}
    .book-stats{position:relative;z-index:2;display:grid;grid-template-columns:repeat(3,1fr);gap:.55rem;margin-top:auto}
    .book-stat{background:rgba(255,255,255,.78);border:1px solid rgba(120,100,60,.18);border-radius:12px;padding:.6rem .35rem;text-align:center;box-shadow:0 6px 14px rgba(120,100,60,.12)}
    .book-stat strong{display:block;font-family:var(--font-display);font-size:1.2rem;color:var(--teal)}
    .book-stat span{font-size:.64rem;color:#6b6255}
    .book-quote{position:relative;z-index:2;margin-top:auto;background:rgba(255,255,255,.72);border-left:4px solid var(--gold);border-radius:0 12px 12px 0;padding:.7rem .9rem;font-style:italic;font-size:.8rem;color:#5b5244;box-shadow:0 8px 18px rgba(120,100,60,.14)}
    .book-quote strong{color:var(--teal);font-style:normal}
    .vm-text{position:relative;z-index:2;font-size:.94rem;color:#3d3a34;font-style:italic;border-left:4px solid var(--teal);padding:.6rem 0 .6rem 1rem;background:linear-gradient(90deg,rgba(29,111,184,.08),transparent);border-radius:0 12px 12px 0;margin-bottom:1rem}
    .misi-list{position:relative;z-index:2;display:flex;flex-direction:column;gap:.6rem}
    .misi-item{display:flex;gap:.85rem;align-items:flex-start;background:rgba(255,255,255,.82);border:1px solid rgba(120,100,60,.18);border-radius:12px;padding:.7rem .85rem;transition:all .3s var(--ease)}
    .misi-item:hover{transform:translateX(6px);border-color:var(--teal);box-shadow:0 10px 22px rgba(120,100,60,.16)}
    .misi-num{flex-shrink:0;width:27px;height:27px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.78rem;color:#0d3a66;background:linear-gradient(135deg,var(--mint),var(--teal-light))}
    .misi-text{position:relative;z-index:2;font-size:.8rem;color:#4d463c;line-height:1.55}
    .book-back-logo img{width:96px;filter:drop-shadow(0 10px 22px rgba(0,0,0,.3))}
    .book-back-title{font-family:var(--font-display);font-size:1.15rem;text-transform:uppercase;line-height:1.3}
    .book-back-title .num-2{color:#ffb300}
    .book-back-sub{font-size:.78rem;color:rgba(255,255,255,.78);max-width:300px}
    .book-back-badge{display:inline-flex;align-items:center;gap:.5rem;font-size:.68rem;font-weight:700;color:#0d3a66;background:linear-gradient(135deg,var(--gold),#ffd54f);padding:.35rem .8rem;border-radius:99px;box-shadow:0 8px 18px rgba(249,168,37,.35)}
    .flip-controls{display:flex;align-items:center;justify-content:center;gap:1.3rem;margin-top:1.7rem;flex-wrap:wrap}
    .flip-restart{display:inline-flex;align-items:center;gap:.5rem;border:0;cursor:pointer;font-weight:700;font-size:.82rem;color:#fff;background:linear-gradient(135deg,var(--gold),var(--gold-dark));padding:.6rem 1.2rem;border-radius:99px;box-shadow:0 10px 24px rgba(249,168,37,.4);transition:all .3s var(--ease)}
    .flip-restart:hover{transform:translateY(-2px);box-shadow:0 14px 30px rgba(249,168,37,.5)}
    .flip-dots{display:flex;gap:.5rem}
    .flip-dot{width:11px;height:11px;border-radius:50%;background:var(--border);border:0;cursor:pointer;padding:0;transition:all .3s var(--ease)}
    .flip-dot.active{background:linear-gradient(135deg,var(--gold),var(--gold-dark));transform:scale(1.25);box-shadow:0 4px 10px rgba(249,168,37,.45)}
    .flip-counter{font-size:.82rem;font-weight:700;color:var(--text-muted)}
    .flip-hint{text-align:center;font-size:.72rem;color:var(--text-muted);margin-top:.7rem;letter-spacing:.04em}

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

    /* ---------- ROADMAP ---------- */
    /* ============ JOURNEY TO 2028 MAP ============ */
    .roadmap-preview-section{position:relative;background:linear-gradient(180deg,rgba(11,61,104,.88) 0%,rgba(14,78,125,.85) 55%,rgba(8,56,95,.92) 100%),url('{{ asset('images/hero-sekolah.jpg') }}') center/cover no-repeat;color:#fff;padding:110px 0 120px;overflow:hidden}
    .j2k8-map{position:absolute;inset:0;pointer-events:none;opacity:.38}
    .j2k8-contours{position:absolute;inset:0;background:
      radial-gradient(ellipse 46% 42% at 12% 22%,transparent 58%,rgba(255,255,255,.10) 60%,transparent 62%),
      radial-gradient(ellipse 52% 48% at 12% 22%,transparent 60%,rgba(255,255,255,.08) 62%,transparent 64%),
      radial-gradient(ellipse 60% 56% at 12% 22%,transparent 62%,rgba(255,255,255,.06) 64%,transparent 66%),
      radial-gradient(ellipse 40% 38% at 84% 78%,transparent 58%,rgba(255,255,255,.09) 60%,transparent 62%),
      radial-gradient(ellipse 48% 44% at 84% 78%,transparent 60%,rgba(255,255,255,.07) 62%,transparent 64%),
      radial-gradient(ellipse 58% 54% at 84% 78%,transparent 62%,rgba(255,255,255,.05) 64%,transparent 66%),
      radial-gradient(ellipse 36% 34% at 55% 95%,transparent 56%,rgba(255,255,255,.07) 58%,transparent 60%);
      opacity:.32}
    .j2k8-grid{position:absolute;inset:0;background-image:linear-gradient(rgba(160,210,255,.045) 1px,transparent 1px),linear-gradient(90deg,rgba(160,210,255,.045) 1px,transparent 1px);background-size:44px 44px;mask-image:radial-gradient(ellipse 78% 72% at 50% 44%,#000 55%,transparent 100%);-webkit-mask-image:radial-gradient(ellipse 78% 72% at 50% 44%,#000 55%,transparent 100%)}
    .j2k8-coords{position:absolute;inset:0}
    .j2k8-coords i{position:absolute;font-style:normal;font-family:ui-monospace,SFMono-Regular,Menlo,monospace;font-size:.6rem;letter-spacing:.18em;color:rgba(170,215,255,.16)}
    .j2k8-coords .cd-dot{position:absolute;width:5px;height:5px;border-radius:50%;background:rgba(170,215,255,.20)}
    .j2k8-coords .cd-dash{position:absolute;width:26px;height:1px;background:rgba(170,215,255,.15)}
    .j2k8-compass{position:absolute;top:26px;right:28px;width:52px;height:52px;opacity:.92;color:#bfe6ff}
    .j2k8-compass svg{width:100%;height:100%;display:block}
    .j2k8-compass .n{fill:#7fd4ff}
    .roadmap-preview-inner{position:relative;z-index:2}
    .roadmap-preview-header{max-width:820px;margin:0 auto .4rem;text-align:center}
    .j2k8-label{display:inline-block;font-size:.66rem;font-weight:800;letter-spacing:.3em;text-transform:uppercase;color:#ffab00;margin-bottom:.95rem}
    .roadmap-preview-section .section-title{color:#fff;font-size:clamp(1.7rem,3.4vw,2.5rem);margin-bottom:.85rem}
    .roadmap-preview-section .accent{background:linear-gradient(100deg,#ffd54a,#f2b632);-webkit-background-clip:text;background-clip:text;color:transparent}
    .roadmap-preview-section .section-desc{color:rgba(255,255,255,.75);font-size:.95rem;line-height:1.75;max-width:640px;margin:0 auto}
    .j2k8-legend{display:flex;align-items:center;justify-content:center;gap:1.6rem;flex-wrap:wrap;margin-top:.85rem;font-size:.72rem;color:rgba(255,255,255,.72)}
    .j2k8-legend span{display:inline-flex;align-items:center;gap:.45rem}
    .j2k8-legend .lg-ic{display:inline-flex;align-items:center;justify-content:center;width:20px;height:20px;border-radius:50%;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.18);font-size:.62rem;color:#fff}
    .j2k8-legend .lg-done{color:#7ee2a8}
    .j2k8-legend .lg-running{color:#7cc9ff}
    .j2k8-legend .lg-goal{color:#ffd54f}
    .j2k8-stage{position:relative;min-height:1150px;margin-top:.1rem}
    .j2k8-route{position:absolute;inset:0;width:100%;height:100%;pointer-events:none;z-index:1}
    .j2k8-route .route-base{stroke:rgba(255,255,255,.13);stroke-width:4;fill:none;stroke-linecap:round}
    .j2k8-route .route-dash{stroke:#29b6f6;stroke-width:3.5;fill:none;stroke-linecap:round;stroke-dasharray:10 14;opacity:.5;animation:routeDashMove 22s linear infinite}
    .j2k8-route .route-glow{stroke:#29b6f6;stroke-width:5;fill:none;stroke-linecap:round;filter:drop-shadow(0 0 6px rgba(41,182,246,.6));opacity:0;stroke-dasharray:2800;stroke-dashoffset:2800;transition:stroke-dashoffset 1.6s cubic-bezier(.4,0,.2,1)}
    .j2k8-stage.drawn .j2k8-route .route-glow{opacity:1;stroke-dashoffset:0}
    @keyframes routeDashMove{to{stroke-dashoffset:-48}}
    .j2k8-checkpoint{position:absolute;z-index:3;display:flex;flex-direction:column;align-items:center;transform:translate(-50%,-50%);opacity:0;transition:opacity .5s ease,transform .5s ease}
    .j2k8-stage.drawn .j2k8-checkpoint{opacity:1}
    .j2k8-node{width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:rgba(10,38,64,.88);border:2px solid rgba(41,182,246,.55);color:#7fd4ff;font-size:1rem;box-shadow:0 0 0 5px rgba(41,182,246,.14),0 6px 18px rgba(0,0,0,.4);transition:transform .3s var(--ease),border-color .3s,box-shadow .3s}
    .j2k8-checkpoint:hover .j2k8-node,.j2k8-checkpoint:focus-visible .j2k8-node{transform:scale(1.22);border-color:#29b6f6;box-shadow:0 0 0 8px rgba(41,182,246,.2),0 0 26px rgba(41,182,246,.65)}
    .j2k8-node .fas{filter:drop-shadow(0 0 6px rgba(41,182,246,.6))}
    .j2k8-cp-year{margin-top:.55rem;font-weight:800;font-size:.8rem;letter-spacing:.08em;color:#fff;text-shadow:0 2px 10px rgba(0,0,0,.6)}
    .j2k8-cp-tag{margin-top:.15rem;font-size:.58rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase;color:rgba(255,255,255,.55)}
    .j2k8-start .j2k8-node{border-color:rgba(126,226,168,.6);color:#7ee2a8;box-shadow:0 0 0 5px rgba(46,204,113,.16),0 6px 18px rgba(0,0,0,.4)}
    .j2k8-goal .j2k8-node{width:56px;height:56px;background:linear-gradient(135deg,rgba(255,213,79,.22),rgba(242,182,50,.14));border:2px solid #f2b632;color:#ffd54f;font-size:1.35rem;box-shadow:0 0 0 8px rgba(242,182,50,.18),0 0 34px rgba(242,182,50,.55);animation:goalPulse 3s ease-in-out infinite}
    .j2k8-goal .j2k8-cp-year{color:#ffd54f;font-size:.95rem}
    .j2k8-goal .j2k8-cp-tag{color:#ffd54f}
    .j2k8-card{position:absolute;z-index:4;width:312px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:18px;padding:1.15rem 1.2rem 1.25rem;backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);box-shadow:0 16px 40px rgba(0,0,0,.28);transition:transform .35s var(--ease),border-color .35s,background .35s,box-shadow .35s;opacity:0}
    .j2k8-stage.drawn .j2k8-card{animation:cardIn .6s cubic-bezier(.22,1,.36,1) forwards}
    .j2k8-card:hover{transform:translateY(-6px);border-color:rgba(41,182,246,.55);background:rgba(255,255,255,.13);box-shadow:0 24px 52px rgba(0,0,0,.4)}
    .j2k8-connector{position:absolute;z-index:2;height:1px;background:linear-gradient(90deg,rgba(41,182,246,.55),rgba(41,182,246,.12));transform-origin:left center;pointer-events:none}
    .j2k8-connector::after{content:"";position:absolute;right:-5px;top:-3px;width:7px;height:7px;border-radius:50%;background:#29b6f6;opacity:.8}
    .j2k8-connector.v{width:1px;height:44px;background:linear-gradient(180deg,rgba(41,182,246,.55),rgba(41,182,246,.12))}
    .j2k8-connector.v::after{right:auto;left:-3px;top:auto;bottom:-3px}
    .j2k8-arrow{position:absolute;z-index:2;width:0;height:0;border-left:7px solid transparent;border-right:7px solid transparent;border-bottom:13px solid rgba(41,182,246,.75);filter:drop-shadow(0 0 6px rgba(41,182,246,.5));pointer-events:none}
    .j2k8-card-top{display:flex;align-items:center;justify-content:space-between;gap:.5rem;margin-bottom:.5rem}
    .j2k8-num{font-size:.7rem;font-weight:800;letter-spacing:.16em;color:rgba(255,255,255,.5)}
    .j2k8-status{display:inline-flex;align-items:center;gap:.4rem;font-size:.58rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;padding:.3rem .62rem;border-radius:99px;background:rgba(255,255,255,.12);white-space:nowrap}
    .j2k8-status-dot{width:7px;height:7px;border-radius:50%}
    .s-done{color:#7ee2a8;background:rgba(46,204,113,.16)}
    .s-done .j2k8-status-dot{background:#2ecc71;box-shadow:0 0 8px rgba(46,204,113,.8)}
    .s-running{color:#7cc9ff;background:rgba(37,184,242,.16)}
    .s-running .j2k8-status-dot{background:#25b8f2;box-shadow:0 0 8px rgba(37,184,242,.8);animation:journeyBlink 1.6s ease-in-out infinite}
    .s-goal{color:#ffd54f;background:rgba(242,182,50,.18)}
    .s-goal .j2k8-status-dot{background:#f2b632;box-shadow:0 0 8px rgba(242,182,50,.85)}
    .j2k8-year{font-size:.78rem;font-weight:800;letter-spacing:.06em;color:#fff;margin-bottom:.3rem}
    .j2k8-name{font-family:var(--font-display);font-size:.95rem;line-height:1.35;color:#fff;margin-bottom:.4rem}
    .j2k8-desc{font-size:.74rem;line-height:1.6;color:rgba(255,255,255,.72)}
    .j2k8-goal-card{width:352px;border-color:rgba(242,182,50,.5);background:rgba(242,182,50,.1);box-shadow:0 0 0 1px rgba(242,182,50,.22),0 20px 48px rgba(0,0,0,.34)}
    .j2k8-goal-card .j2k8-year{color:#ffd54f;font-size:.86rem}
    .j2k8-goal-card .j2k8-name{color:#ffd54f;font-size:1.05rem}
    .j2k8-goal-card:hover{border-color:rgba(242,182,50,.75);background:rgba(242,182,50,.16)}
    .j2k8-start-flag{position:absolute;z-index:4;display:flex;align-items:center;gap:.5rem;font-size:.6rem;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#7ee2a8;background:rgba(46,204,113,.12);border:1px solid rgba(126,226,168,.35);padding:.34rem .8rem;border-radius:99px;white-space:nowrap}
    .j2k8-cta{display:inline-flex;align-items:center;gap:.55rem;padding:.7rem 1.3rem;border-radius:99px;font-weight:700;font-size:.82rem;color:#dff2ff;background:rgba(41,182,246,.16);border:1px solid rgba(41,182,246,.4);backdrop-filter:blur(8px);transition:all .3s var(--ease)}
    .j2k8-cta:hover{background:rgba(41,182,246,.28);transform:translateY(-2px);box-shadow:0 12px 30px rgba(41,182,246,.3)}
    @keyframes journeyBlink{0%,100%{opacity:1}50%{opacity:.35}}
    @keyframes goalPulse{0%,100%{box-shadow:0 0 0 8px rgba(242,182,50,.18),0 0 34px rgba(242,182,50,.55)}50%{box-shadow:0 0 0 13px rgba(242,182,50,.1),0 0 48px rgba(242,182,50,.75)}}
    @keyframes cardIn{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}

    @media(max-width:1100px){
      .j2k8-stage{display:flex;flex-direction:column;gap:2.4rem;min-height:0;padding-left:8px}
      .j2k8-stage::before{content:"";position:absolute;left:31px;top:6px;bottom:6px;width:3px;border-radius:99px;background:linear-gradient(180deg,#29b6f6,rgba(41,182,246,.25));opacity:.55}
      .j2k8-route{display:none}
      .j2k8-connector{display:none}
      .j2k8-arrow{display:none}
      .j2k8-milestone{position:relative;display:grid;grid-template-columns:64px 1fr;gap:1.1rem;align-items:start;min-height:0}
      .j2k8-checkpoint{position:static;transform:none;opacity:1;flex-direction:row;align-items:center;gap:0}
      .j2k8-stage.drawn .j2k8-checkpoint{opacity:1}
      .j2k8-checkpoint .j2k8-cp-year{margin-top:0;margin-left:.6rem;font-size:.82rem}
      .j2k8-checkpoint .j2k8-cp-tag{display:none}
      .j2k8-node{width:44px;height:44px}
      .j2k8-goal .j2k8-node{width:52px;height:52px}
      .j2k8-card{position:static;opacity:1;animation:none;width:100%;transform:none}
      .j2k8-stage.drawn .j2k8-card{animation:none;opacity:1}
      .j2k8-goal-card{width:100%}
      .j2k8-start-flag{position:static;justify-content:flex-start;margin:0 0 .2rem 74px}
      .j2k8-compass{display:none}
      .roadmap-preview-header{margin-bottom:.4rem}
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
      .book3d{aspect-ratio:1.95/1;min-height:400px}
      .flipbook-stage{gap:.7rem}
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
      .window-section,.roadmap-preview-section{padding:72px 0}
    }


    @media(max-width:640px){
      .book3d{aspect-ratio:auto;min-height:420px}
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
      .flip-nav{display:none}
      .flipbook-stage{gap:0}
      .flip-controls{gap:.8rem;margin-top:1.2rem}
      .flip-counter{font-size:.74rem}
      .book-back-logo img{width:74px}
      .book-back-title{font-size:1rem}
      .book-back-sub{font-size:.72rem}
    }

    /* ---------- REDUCED MOTION ---------- */
    @media(prefers-reduced-motion:reduce){
      *,*::before,*::after{animation-duration:.01ms !important;animation-iteration-count:1 !important;transition-duration:.01ms !important}
      [data-reveal]{opacity:1;transform:none}
      html{scroll-behavior:auto}
    }
  /* v35-spacing-final */
/* ---------- ROADMAP — COMPACT & RAPI ---------- */
.roadmap-preview-section{
  padding:82px 0 88px;
}
.roadmap-preview-header{
  max-width:760px;
  margin:0 auto .2rem;
}
.roadmap-preview-section .section-title{
  font-size:clamp(1.9rem,3.6vw,3rem);
  line-height:1.08;
  margin-bottom:.65rem;
}
.roadmap-preview-section .section-desc{
  font-size:.88rem;
  line-height:1.6;
}
.j2k8-legend{margin-top:.65rem}
.j2k8-stage{
  min-height:940px;
  margin-top:0;
}
.j2k8-card{
  width:286px;
  padding:1rem 1.05rem 1.08rem;
  border-radius:16px;
}
.j2k8-goal-card{width:320px}
.j2k8-name{font-size:.9rem}
.j2k8-desc{font-size:.7rem;line-height:1.5}
.j2k8-node{width:40px;height:40px}
.j2k8-goal .j2k8-node{width:50px;height:50px}
.j2k8-cp-year{font-size:.75rem}

@media(max-width:900px){
  .roadmap-preview-section{padding:68px 0 74px}
  .j2k8-stage{min-height:900px}
  .j2k8-card{width:260px}
  .j2k8-goal-card{width:290px}
}
@media(max-width:640px){
  .roadmap-preview-section{padding:58px 0 64px}
  .roadmap-preview-section .section-title{
    font-size:clamp(1.75rem,8vw,2.35rem);
  }
  .j2k8-stage{
    min-height:0;
    margin-top:.8rem;
  }
  .j2k8-card,.j2k8-goal-card{width:100%}
  .j2k8-node{width:40px;height:40px}
}

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
    background-size:cover;background-position:center;background-repeat:no-repeat}
  .hd-hero::before{content:"";position:absolute;inset:0;z-index:1;
    background:linear-gradient(100deg,rgba(7,22,42,.85) 0%,rgba(9,30,54,.6) 42%,rgba(9,30,54,.22) 75%,rgba(9,30,54,.08) 100%)}

  .hd-hero-inner{position:relative;z-index:2;max-width:none;margin:0;width:100%;padding:clamp(6rem,11vh,7.5rem) clamp(1.2rem,5.2vw,5.5rem)}

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
        <a href="#profil" class="hd-btn hd-btn-primary">Jelajahi Sekolah <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </div>
</section>

<section class="profil-section section-py" id="profil">
  <!-- Ornamen profil: ringan, berbeda dari ornamen Jurusan, dan tetap di area background -->
  <!-- Ornamen profil: sengaja berbeda dari Jurusan, ringan dan tidak menutupi konten -->
  <div class="profil-decor" aria-hidden="true">
    <svg viewBox="0 0 1440 620" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="profileGold" x1="0" y1="0" x2="1" y2="1">
          <stop offset="0%" stop-color="#ffd54a"/>
          <stop offset="45%" stop-color="#ffb300"/>
          <stop offset="100%" stop-color="#ff7a00"/>
        </linearGradient>
      </defs>

      <!-- Kiri atas: lingkaran konsentris, bukan gelombang -->
      <circle class="pd-ring" cx="-8" cy="110" r="78"/>
      <circle class="pd-ring-gold" cx="-8" cy="110" r="52"/>
      <circle class="pd-ring" cx="-8" cy="110" r="26"/>
      <circle class="pd-dot-gold" cx="48" cy="62" r="5"/>

      <!-- Kiri bawah: grid titik + aksen batang -->
      <g class="pd-dot">
        <circle cx="58" cy="450" r="3"/><circle cx="78" cy="450" r="3"/><circle cx="98" cy="450" r="3"/>
        <circle cx="58" cy="470" r="3"/><circle cx="78" cy="470" r="3"/><circle cx="98" cy="470" r="3"/>
        <circle cx="58" cy="490" r="3"/><circle cx="78" cy="490" r="3"/><circle cx="98" cy="490" r="3"/>
      </g>
      <rect class="pd-bar" x="115" y="520" width="70" height="9" rx="4.5" transform="rotate(-28 115 520)"/>
      <rect class="pd-bar-navy" x="78" y="548" width="44" height="7" rx="3.5" transform="rotate(-28 78 548)"/>

      <!-- Kanan atas: frame sudut minimal -->
      <path class="pd-corner" d="M1280 70 H1370 V160"/>
      <path class="pd-corner" d="M1320 40 H1400 V120"/>
      <circle class="pd-dot-gold" cx="1370" cy="160" r="6"/>

      <!-- Kanan bawah: lingkaran target + dua aksen kecil -->
      <circle class="pd-ring-gold" cx="1390" cy="505" r="66"/>
      <circle class="pd-ring" cx="1390" cy="505" r="42"/>
      <circle class="pd-dot" cx="1390" cy="505" r="7"/>
      <rect class="pd-bar" x="1260" y="555" width="52" height="10" rx="5" transform="rotate(32 1260 555)"/>
      <rect class="pd-bar-navy" x="1310" y="575" width="30" height="7" rx="3.5" transform="rotate(32 1310 575)"/>
    </svg>
  </div>
  <div class="container">
    <div class="section-header center" data-reveal>
      <div class="section-label">Buku Sejarah SMKN 2</div>
      <h2 class="section-title">Profil <span class="accent">Sekolah</span></h2>
    </div>

    <div class="flipbook" data-reveal style="margin-top:2.6rem">
      <div class="flipbook-stage" id="flipbook">
        <button class="flip-nav flip-prev" aria-label="Halaman sebelumnya"><i class="fas fa-chevron-left"></i></button>

        <div class="book3d">
          <div class="book-spine"></div>

          <!-- Sheet 1: Cover + Tentang Kami -->
          <div class="book-sheet active" data-sheet="0">
            <div class="book-leaf cover">
              <div class="book-cover-top">
                <div class="profil-akreditasi"><i class="fas fa-certificate"></i> Akreditasi A &mdash; BAN-SM 2023</div>
                <div class="book-cover-kicker">Buku Sejarah</div>
              </div>
              <div class="book-cover-photo">
                <img src="{{ asset('images/smkn-guru.jpg') }}" alt="Para Guru dan Staf SMK Negeri 2 Mojokerto">
              </div>
              <div class="book-cover-title">
                <div class="book-cover-eyebrow">Est. 1968</div>
                <div class="book-cover-school">SMK Negeri <em class="num-2">2</em><br>Kota Mojokerto</div>
                <div class="book-cover-sub">Kisah perjalanan sekolah vokasi unggulan Kota Mojokerto sejak tahun 1968.</div>
              </div>
            </div>
            <div class="book-leaf paper">
              <div class="book-page-head">
                <div>
                  <div class="book-page-kicker">Tentang Kami</div>
                  <div class="book-page-title">Profil <span class="num-2">Sekolah</span></div>
                </div>
                <div class="book-page-no">01</div>
              </div>
              <p class="book-page-text">Mengenal lebih dekat visi, misi, dan komitmen SMK Negeri <em class="num-2">2</em> Mojokerto dalam mencetak lulusan vokasi berkualitas.</p>
              <p class="book-page-text">Selamat datang di Buku Sejarah SMK Negeri 2 Mojokerto. Susuri perjalanan sekolah vokasi unggulan Kota Mojokerto ini halaman demi halaman &mdash; dari fondasi pendidikan kejuruan, program keahlian, hingga prestasi di tingkat provinsi dan nasional.</p>
              <div class="book-quote"><strong>&ldquo;Membentuk generasi vokasi yang beriman, berkarakter, dan berdaya saing global.&rdquo;</strong></div>
            </div>
          </div>

          <!-- Sheet 2: Sejarah -->
          <div class="book-sheet" data-sheet="1">
            <div class="book-leaf paper">
              <div class="book-page-head">
                <div>
                  <div class="book-page-kicker">BAB I &mdash; Sejarah</div>
                  <div class="book-page-title">Merintis Generasi Vokasi Sejak 1968</div>
                </div>
                <div class="book-page-no">02</div>
              </div>
              <p class="book-page-text">Berdiri sejak 1968, SMK Negeri <em class="num-2">2</em> Mojokerto telah menjadi pilihan utama keluarga Mojokerto dalam menyiapkan generasi vokasi yang kompeten, berkarakter, dan siap bersaing di era global.</p>
              <p class="book-page-text">Dari masa ke masa, sekolah ini terus bertumbuh: membuka program keahlian baru, membangun kemitraan dengan dunia usaha dan industri, hingga meraih akreditasi A dan sederet prestasi tingkat provinsi maupun nasional.</p>
              <div class="book-timeline">
                <div class="book-milestone"><span class="book-year">1968</span><span class="book-mile-text">Berdiri dan membuka pendidikan kejuruan pertama</span></div>
                <div class="book-milestone"><span class="book-year">2023</span><span class="book-mile-text">Meraih Akreditasi A dari BAN-SM</span></div>
                <div class="book-milestone"><span class="book-year">2024</span><span class="book-mile-text">Juara 1 LKS Provinsi Jawa Timur</span></div>
              </div>
            </div>
            <div class="book-leaf paper">
              <div class="book-page-head">
                <div>
                  <div class="book-page-kicker">BAB I &mdash; Sejarah (Lanjutan)</div>
                  <div class="book-page-title">Tumbuh, Berprestasi, dan Mendunia</div>
                </div>
                <div class="book-page-no">03</div>
              </div>
              <p class="book-page-text">SMK Negeri 2 Mojokerto kini menjadi sekolah kejuruan yang dinamis dengan berbagai program keahlian yang relevan dengan kebutuhan industri &mdash; mulai dari teknologi rekayasa hingga ekonomi kreatif.</p>
              <p class="book-page-text">Dukungan 80+ pendidik dan tenaga kependidikan yang kompeten serta lingkungan belajar yang modern menjadikan sekolah ini rumah bagi lebih dari 1200 siswa aktif.</p>
              <div class="book-stats">
                <div class="book-stat"><strong>57+</strong><span>Tahun Berdiri</span></div>
                <div class="book-stat"><strong>80+</strong><span>Guru &amp; Staff</span></div>
                <div class="book-stat"><strong>1200+</strong><span>Siswa Aktif</span></div>
              </div>
            </div>
          </div>

          <!-- Sheet 3: Visi & Misi -->
          <div class="book-sheet" data-sheet="2">
            <div class="book-leaf paper">
              <div class="book-page-head">
                <div>
                  <div class="book-page-kicker">BAB II &mdash; Visi</div>
                  <div class="book-page-title">Visi Sekolah</div>
                </div>
                <div class="book-page-no">04</div>
              </div>
              <p class="book-page-text" style="margin-bottom:1rem">Visi SMK Negeri <em class="num-2">2</em> Mojokerto:</p>
              <div class="vm-text">&ldquo;Menjadi sekolah menengah kejuruan yang menghasilkan lulusan beriman, bertaqwa, berkarakter, kompeten, berwawasan lingkungan, dan mampu bersaing di tingkat nasional maupun internasional.&rdquo;</div>
              <div class="book-quote">Visi ini menjadi kompas bagi seluruh program dan kegiatan sekolah dalam mencetak lulusan yang siap kerja, siap kuliah, dan berkarakter.</div>
            </div>
            <div class="book-leaf paper">
              <div class="book-page-head">
                <div>
                  <div class="book-page-kicker">BAB II &mdash; Misi</div>
                  <div class="book-page-title">Misi Sekolah</div>
                </div>
                <div class="book-page-no">05</div>
              </div>
              <div class="misi-list">
                <div class="misi-item"><div class="misi-num">1</div><div class="misi-text">Menyelenggarakan pendidikan dan pelatihan berbasis kompetensi yang relevan dengan kebutuhan industri</div></div>
                <div class="misi-item"><div class="misi-num">2</div><div class="misi-text">Mengembangkan karakter siswa yang berakhlak mulia, disiplin, dan bertanggung jawab</div></div>
                <div class="misi-item"><div class="misi-num">3</div><div class="misi-text">Membangun kemitraan strategis dengan dunia usaha dan industri untuk peningkatan kualitas lulusan</div></div>
                <div class="misi-item"><div class="misi-num">4</div><div class="misi-text">Menciptakan lingkungan belajar yang inovatif, kreatif, dan berwawasan teknologi</div></div>
              </div>
            </div>
          </div>

          <!-- Sheet 4: Penutup + Back Cover -->
          <div class="book-sheet" data-sheet="3">
            <div class="book-leaf paper">
              <div class="book-page-head">
                <div>
                  <div class="book-page-kicker">Penutup</div>
                  <div class="book-page-title">Komitmen Kami</div>
                </div>
                <div class="book-page-no">06</div>
              </div>
              <p class="book-page-text">Buku ini adalah awal dari perjalanan panjang. SMK Negeri <em class="num-2">2</em> Mojokerto terus berkomitmen mencetak lulusan yang beriman, bertaqwa, berkarakter, kompeten, berwawasan lingkungan, dan siap bersaing di tingkat nasional maupun internasional.</p>
              <p class="book-page-text">Terima kasih telah membaca buku sejarah kami. Mari bersama mencetak generasi vokasi unggulan Kota Mojokerto.</p>
              <div class="book-quote"><strong>Disiplin, Berprestasi &mdash; SMK Negeri 2 Mojokerto.</strong></div>
            </div>
            <div class="book-leaf back">
              <div class="book-back-logo"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMK Negeri 2 Mojokerto"></div>
              <div class="book-back-title">SMK Negeri <em class="num-2">2</em><br>Kota Mojokerto</div>
              <div class="book-back-sub">Terima kasih telah membaca Buku Sejarah kami.</div>
              <div class="book-back-badge"><i class="fas fa-award"></i> Akreditasi A &mdash; Est. 1968</div>
            </div>
          </div>
        </div>

        <button class="flip-nav flip-next" aria-label="Halaman berikutnya"><i class="fas fa-chevron-right"></i></button>
      </div>

      <div class="flip-controls">
        <button class="flip-restart" onclick="flipRestart()"><i class="fas fa-book-open"></i> Baca dari Awal</button>
        <div class="flip-dots">
          <button class="flip-dot active" data-dot="0" aria-label="Halaman 1-2"></button>
          <button class="flip-dot" data-dot="1" aria-label="Halaman 3-4"></button>
          <button class="flip-dot" data-dot="2" aria-label="Halaman 5-6"></button>
          <button class="flip-dot" data-dot="3" aria-label="Halaman 7-8"></button>
        </div>
        <div class="flip-counter">Halaman <span id="flip-cur">1&ndash;2</span> dari <span id="flip-total">8</span></div>
      </div>
      <div class="flip-hint"><i class="fas fa-hand-pointer"></i> Klik sisi kiri/kanan buku atau gunakan tombol panah untuk membalik halaman</div>
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


/* ROADMAP — timeline modern + typography section */
.roadmap-preview-section{padding:78px 0 88px}
.roadmap-preview-section .section-title,
.roadmap-preview-section h2{
  font-size:clamp(2rem,4.2vw,4.2rem)!important;
  line-height:1.08!important;
  font-weight:800!important;
  letter-spacing:-.035em!important;
  margin:0 0 1rem!important;
}
.roadmap-preview-section .section-desc{display:none!important}
.roadmap-preview-section .roadmap-preview-header{margin-bottom:1.5rem}
.roadmap-preview-section .j2k8-stage{
  position:relative;
  min-height:760px;
  margin-top:1.2rem;
}
.roadmap-preview-section .j2k8-card{
  width:278px;
  padding:1rem 1.05rem 1.08rem;
  border-radius:17px;
}
.roadmap-preview-section .j2k8-name{font-size:.92rem;line-height:1.25}
.roadmap-preview-section .j2k8-desc{font-size:.7rem;line-height:1.5}
.roadmap-preview-section .j2k8-node{width:42px;height:42px}
.roadmap-preview-section .j2k8-goal-card{width:305px}
.roadmap-preview-section .j2k8-stage::before{
  content:"";
  position:absolute;
  left:7%;right:7%;top:50%;height:2px;
  background:linear-gradient(90deg,transparent,rgba(255,159,0,.45),rgba(13,58,102,.35),rgba(255,159,0,.45),transparent);
  pointer-events:none;opacity:.7;
}
@media(max-width:900px){
  .roadmap-preview-section{padding:64px 0 74px}
  .roadmap-preview-section .j2k8-stage{min-height:700px}
  .roadmap-preview-section .j2k8-card{width:250px}
}
@media(max-width:640px){
  .roadmap-preview-section{padding:56px 0 64px}
  .roadmap-preview-section .section-title,
  .roadmap-preview-section h2{font-size:clamp(1.9rem,8vw,2.7rem)!important}
  .roadmap-preview-section .j2k8-stage{min-height:0}
  .roadmap-preview-section .j2k8-stage::before{display:none}
  .roadmap-preview-section .j2k8-card,
  .roadmap-preview-section .j2k8-goal-card{width:100%}
}


/* Label kecil Roadmap */
.roadmap-preview-section .roadmap-eyebrow,
.roadmap-preview-section .eyebrow,
.roadmap-preview-section .section-kicker,
.roadmap-preview-section .overline{
  color:#f59e0b !important;
}


/* Paksa label kecil Roadmap menjadi kuning-oranye */
.roadmap-preview-section :is(.roadmap-eyebrow,.eyebrow,.section-kicker,.overline){
  color:#ffab00 !important;
  -webkit-text-fill-color:#ffab00 !important;
}
.roadmap-preview-section [class*="eyebrow"],
.roadmap-preview-section [class*="kicker"],
.roadmap-preview-section [class*="overline"]{
  color:#ffab00 !important;
  -webkit-text-fill-color:#ffab00 !important;
}


.j2k8-label{color:#ffab00 !important;-webkit-text-fill-color:#ffab00 !important;}

/* ===== PRESTASI SISWA / YEARBOOK EDITORIAL ===== */
.prestasi-siswa-section{position:relative;overflow:hidden;padding:92px 6%;background:#f7f9fc;color:#12375d}
.prestasi-inner,.tour-inner{max-width:1180px;margin:auto;position:relative;z-index:2}
.prestasi-heading,.tour-heading{text-align:center;margin-bottom:38px}
.prestasi-label,.tour-label{color:#ffab00;font-size:.68rem;font-weight:800;letter-spacing:.28em;text-transform:uppercase;margin-bottom:10px}
.prestasi-heading h2,.tour-heading h2{margin:0;font-size:clamp(2rem,4.2vw,4.2rem);line-height:1.08;font-weight:800;letter-spacing:-.035em}
.prestasi-heading p{max-width:620px;margin:15px auto 0;color:#718096;font-size:.78rem;line-height:1.7}
.prestasi-rule,.tour-rule{width:52px;height:3px;background:#ffab00;margin:16px auto 0;border-radius:10px}

/* Ornamen unik: koordinat, frame, garis editorial */
.prestasi-decor{position:absolute;inset:0;pointer-events:none}
.pdec{position:absolute;display:block}
.pdec-1{width:125px;height:125px;border:2px solid #ffab00;left:-55px;top:120px;transform:rotate(45deg);opacity:.34}
.pdec-2{width:75px;height:75px;border:2px solid #12375d;right:7%;top:75px;transform:rotate(45deg);opacity:.15}
.pdec-3{width:8px;height:8px;border-radius:50%;background:#ffab00;right:15%;bottom:22%;box-shadow:24px -16px 0 #12375d,50px 6px 0 #ffab00;opacity:.6}
.pdec-4{width:45px;height:45px;border-left:3px solid #ffab00;border-bottom:3px solid #ffab00;right:-4px;bottom:90px;opacity:.48}
.pdec-line{position:absolute;height:1px;background:#12375d;opacity:.1;transform:rotate(-28deg)}
.pdec-line-1{width:310px;left:-40px;bottom:90px}.pdec-line-2{width:250px;right:-45px;top:180px}

.achievement-editorial{position:relative;max-width:1030px;min-height:610px;margin:auto}
.achievement-main{position:absolute;left:5%;top:12px;width:59%;height:425px;background:#fff;padding:8px;border-radius:20px;box-shadow:0 20px 48px rgba(18,55,93,.14);transform:rotate(-1.5deg);z-index:2}
.achievement-photo{position:relative;overflow:hidden;background:linear-gradient(135deg,#12375d,#2c6a94)}
.photo-placeholder{height:100%;display:grid;place-items:center;text-align:center;background:linear-gradient(135deg,#0d3557,#1e587e);color:#fff}
.photo-placeholder:before{content:"";position:absolute;inset:9%;border:1px dashed rgba(255,255,255,.3)}
.photo-placeholder span{position:relative;font-size:.64rem;font-weight:800;letter-spacing:.2em}
.photo-placeholder small{position:absolute;bottom:18px;left:20px;right:20px;color:rgba(255,255,255,.55);font-size:.57rem}
.achievement-caption{position:absolute;left:23px;right:23px;bottom:20px;background:rgba(9,37,62,.91);padding:15px 17px;border-radius:12px;color:#fff}
.achievement-badge{color:#12375d;background:#ffab00;border-radius:4px;padding:4px 7px;font-size:.52rem;font-weight:900;letter-spacing:.12em}
.achievement-year{font-size:.58rem;margin-left:9px;color:rgba(255,255,255,.55);letter-spacing:.12em}
.achievement-caption h3{margin:7px 0 3px;font-size:1.18rem}.achievement-caption p{margin:0;font-size:.67rem;color:rgba(255,255,255,.65)}
.achievement-side{position:absolute;right:4%;top:0;width:30%;z-index:3}
.achievement-small{background:#fff;padding:7px;border-radius:16px;box-shadow:0 14px 30px rgba(18,55,93,.13);margin-bottom:20px}
.achievement-small:nth-child(2){transform:rotate(-3deg);margin-left:-28px}
.achievement-small:first-child{transform:rotate(3deg)}
.achievement-small .achievement-photo{height:165px}
.small-caption{padding:9px 7px 6px;display:flex;flex-direction:column;gap:3px}.small-caption b{font-size:.72rem}.small-caption span{font-size:.55rem;color:#ffab00;font-weight:800;letter-spacing:.1em}
.achievement-stats{position:absolute;left:17%;bottom:20px;display:flex;gap:10px;z-index:5;transform:rotate(2deg)}
.achievement-stats div{width:115px;height:100px;background:#ffab00;color:#12375d;border-radius:12px;padding:13px;display:flex;flex-direction:column;justify-content:center;box-shadow:0 12px 26px rgba(18,55,93,.13)}
.achievement-stats strong{font-size:2rem;line-height:1}.achievement-stats strong span{font-size:1rem}.achievement-stats small{font-size:.52rem;font-weight:900;letter-spacing:.13em;margin-top:6px}

    /* ===== PRESTASI SLIDER — clean seperti Jurusan, tapi khusus foto prestasi ===== */
.prestasi-siswa-section{position:relative;overflow:hidden;padding:92px 6%;background:#f7f9fc;color:#12375d}
.prestasi-inner{max-width:1120px;margin:auto;position:relative;z-index:2}
.prestasi-heading{text-align:center;margin-bottom:34px}
.prestasi-label{color:#ffab00;font-size:.68rem;font-weight:800;letter-spacing:.28em;text-transform:uppercase;margin-bottom:10px}
.prestasi-heading h2{margin:0;font-size:clamp(2rem,4.2vw,4.2rem);line-height:1.08;font-weight:800;letter-spacing:-.035em}
.prestasi-rule{width:52px;height:3px;background:#ffab00;margin:16px auto 0;border-radius:10px}

/* Ornamen berbeda dari Jurusan */
.prestasi-decor{position:absolute;inset:0;pointer-events:none}
.pdec{position:absolute}
.pdec-1{width:120px;height:120px;border:2px solid #ffab00;left:-58px;top:120px;transform:rotate(45deg);opacity:.28}
.pdec-2{width:65px;height:65px;border:2px solid #12375d;right:7%;top:90px;transform:rotate(45deg);opacity:.14}
.pdec-3{width:8px;height:8px;background:#ffab00;border-radius:50%;right:13%;bottom:20%;box-shadow:24px 0 #12375d,48px 0 #ffab00;opacity:.5}
.pdec-line{position:absolute;width:270px;height:1px;background:#12375d;opacity:.09;transform:rotate(-24deg);right:-45px;bottom:100px}

/* Slider */
.prestasi-slider-wrap{position:relative;max-width:920px;margin:auto;padding:0 58px 42px}
.prestasi-slider{position:relative;min-height:445px;overflow:hidden;border-radius:24px}
.prestasi-slide{position:absolute;inset:0;display:grid;grid-template-columns:1.35fr .8fr;background:#fff;border:1px solid rgba(18,55,93,.09);border-radius:24px;box-shadow:0 18px 42px rgba(18,55,93,.09);opacity:0;transform:translateX(35px);pointer-events:none;transition:opacity .35s ease,transform .35s ease}
.prestasi-slide.is-active{opacity:1;transform:translateX(0);pointer-events:auto}
.prestasi-photo{position:relative;margin:12px;border-radius:16px;overflow:hidden;display:grid;place-items:center;background:linear-gradient(135deg,#12375d,#2c6a94);color:#fff}
.prestasi-photo:before{content:"";position:absolute;inset:10%;border:1px dashed rgba(255,255,255,.3)}
.prestasi-photo span{font-size:.68rem;font-weight:800;letter-spacing:.2em;position:relative}
.prestasi-photo small{position:absolute;right:17px;top:15px;font-size:.65rem;color:#ffab00;font-weight:800}
.prestasi-slide-info{padding:45px 35px;display:flex;flex-direction:column;justify-content:center}
.prestasi-badge{align-self:flex-start;background:#ffab00;color:#12375d;border-radius:4px;padding:5px 8px;font-size:.53rem;font-weight:900;letter-spacing:.12em}
.prestasi-year{font-size:.62rem;color:#8a98a8;font-weight:700;letter-spacing:.12em;margin-top:12px}
.prestasi-slide-info h3{font-size:1.8rem;line-height:1.1;margin:7px 0 8px}
.prestasi-slide-info p{font-size:.76rem;line-height:1.6;color:#718096;margin:0}
.prestasi-arrow{position:absolute;top:50%;transform:translateY(-50%);z-index:5;width:44px;height:44px;border-radius:50%;border:1px solid rgba(18,55,93,.13);background:#fff;color:#12375d;font-size:30px;line-height:1;cursor:pointer;box-shadow:0 8px 20px rgba(18,55,93,.1);transition:.2s}
.prestasi-arrow:hover{background:#ffab00;border-color:#ffab00}
.prestasi-prev{left:0}.prestasi-next{right:0}
.prestasi-dots{position:absolute;bottom:5px;left:0;right:0;display:flex;justify-content:center;gap:7px}
.prestasi-dots button{width:25px;height:4px;border:0;border-radius:10px;background:#cbd5df;cursor:pointer;padding:0}
.prestasi-dots button.active{background:#ffab00;width:38px}

/* Responsive */
@media(max-width:700px){
  .prestasi-slider-wrap{padding:0 42px 42px}
  .prestasi-slider{min-height:520px}
  .prestasi-slide{grid-template-columns:1fr;grid-template-rows:290px 1fr}
  .prestasi-photo{margin:10px 10px 0}
  .prestasi-slide-info{padding:24px 25px}
  .prestasi-slide-info h3{font-size:1.45rem}
  .prestasi-arrow{width:38px;height:38px;font-size:25px}
}


    /* ===== PRESTASI — TYPOGRAPHY + ORNAMEN ===== */
    .prestasi-siswa-section{position:relative;isolation:isolate}
    .prestasi-siswa-section>.prestasi-decor{z-index:0}
    .prestasi-siswa-section>.prestasi-inner{z-index:2}
    .prestasi-heading.section-header{margin-bottom:2.4rem}
    .prestasi-heading .section-label{color:#ffb300;letter-spacing:.22em;font-weight:800}
    .prestasi-heading .section-title{
      font-family:var(--font-display);
      font-size:clamp(2.35rem,5vw,4.2rem);
      line-height:1.02;
      font-weight:800;
      font-style:normal;
      text-transform:uppercase;
      letter-spacing:.01em;
      color:#102f51;
      margin:.35rem 0 0;
      text-shadow:0 2px 10px rgba(13,58,102,.06);
    }
    .prestasi-heading .section-title .accent{
      color:#ffb300!important;background:none!important;-webkit-text-fill-color:#ffb300!important;
    }

    /* Ornamen lebih rame tetapi tetap clean */
    .prestasi-decor{opacity:1}
    .prestasi-decor::before,.prestasi-decor::after{content:"";position:absolute;pointer-events:none}
    .prestasi-decor::before{
      width:250px;height:250px;left:-105px;top:55px;
      border:1px solid rgba(13,58,102,.16);border-radius:50%;
      box-shadow:0 0 0 22px rgba(255,179,0,.045),0 0 0 48px rgba(13,58,102,.035);
    }
    .prestasi-decor::after{
      width:180px;height:180px;right:-70px;bottom:65px;
      border:1px solid rgba(255,179,0,.30);border-radius:50%;
      box-shadow:0 0 0 18px rgba(255,179,0,.035),0 0 0 42px rgba(13,58,102,.03);
    }
    .prestasi-decor .pdec-1{
      width:115px;height:115px;left:3%;top:34%;
      border:1px solid rgba(255,179,0,.42);transform:rotate(45deg);opacity:.65;
    }
    .prestasi-decor .pdec-2{
      width:72px;height:72px;right:8%;top:22%;
      border:1px solid rgba(13,58,102,.25);transform:rotate(45deg);opacity:.7;
    }
    .prestasi-decor .pdec-3{
      width:9px;height:9px;right:17%;bottom:23%;background:#ffb300;border-radius:50%;
      box-shadow:25px -15px 0 #12375d,50px 3px 0 #ffb300,74px -18px 0 rgba(13,58,102,.42);
      opacity:.72;
    }
    .prestasi-decor .pdec-line-1{
      width:330px;left:-90px;bottom:85px;height:1px;
      background:linear-gradient(90deg,transparent,#12375d,transparent);transform:rotate(-24deg);opacity:.16;
    }
    .prestasi-decor .pdec-line-2{
      width:300px;right:-95px;top:145px;height:1px;
      background:linear-gradient(90deg,transparent,#12375d,transparent);transform:rotate(-24deg);opacity:.13;
    }
    .prestasi-decor .pdec-4{
      display:block;position:absolute;right:3%;top:48%;width:38px;height:38px;
      border-top:2px solid #ffb300;border-right:2px solid #ffb300;opacity:.5;
    }
    .prestasi-decor .pdec-4::before,.prestasi-decor .pdec-4::after{
      content:"";position:absolute;width:5px;height:5px;border-radius:50%;background:#12375d;
    }
    .prestasi-decor .pdec-4::before{right:-3px;top:-3px}
    .prestasi-decor .pdec-4::after{left:-3px;bottom:-3px;background:#ffb300}
    .prestasi-decor .pdec-5{
      position:absolute;left:12%;top:15%;width:6px;height:6px;border-radius:50%;
      background:#12375d;box-shadow:18px 10px 0 #ffb300,36px -4px 0 rgba(13,58,102,.45);opacity:.6;
    }
    .prestasi-decor .pdec-6{
      position:absolute;right:19%;top:9%;width:52px;height:1px;background:#ffb300;
      transform:rotate(28deg);opacity:.48;box-shadow:12px 8px 0 rgba(13,58,102,.45);
    }
    @media(max-width:640px){
      .prestasi-heading .section-title{font-size:clamp(2rem,10vw,3rem)}
      .prestasi-decor::before{left:-155px}
      .prestasi-decor::after{right:-125px}
      .prestasi-decor .pdec-5,.prestasi-decor .pdec-6{opacity:.35}
    }

</style>

<!-- ================= JENDELA KEPALA SEKOLAH (corporate glass window) ================= -->
<section class="window-section" id="sambutan">
  <div class="window-bg"></div>
  <div class="principal-section-ornament principal-section-ornament-left" aria-hidden="true"><span></span><i></i><b></b></div>
  <div class="principal-section-ornament principal-section-ornament-right" aria-hidden="true"><span></span><i></i><b></b></div>
  <div class="container">
    <div class="section-header center" data-reveal style="margin-bottom:1.2rem">
      <div class="section-label">Pesan Pimpinan</div>
      <h2 class="section-title">Sambutan <span class="accent">Sekolah</span></h2>
    </div>

    <div class="window-stage" data-reveal>
      <div class="window-frame" id="kepsekWindow">
        <!-- Ornamen minimal saat jendela terbuka -->
        <div class="principal-open-ornament principal-open-ornament-left" aria-hidden="true"><span></span><i></i></div>
        <div class="principal-open-ornament principal-open-ornament-right" aria-hidden="true"><span></span><i></i></div>
        <!-- INTERIOR: isi sambutan (terlihat setelah jendela terbuka) -->
        <div class="window-scene">
          <div class="ws-inner">
            <div class="ws-left">
              <div class="ws-photo-frame">
                <img class="ws-photo" src="{{ asset('images/kepsek-nobg.png') }}" alt="Kepala Sekolah" loading="lazy" />
              </div>
              <div class="ws-photo-cap">Iswahyudi, S.ST. M.Pd</div>
              <div class="ws-photo-role">Kepala SMK Negeri <span class="num-2">2</span> Mojokerto</div>
            </div>
            <div class="ws-right">
              <div class="ws-kicker"><span class="ws-kicker-line"></span>Welcome Message</div>
              <div class="ws-welcome">Sambutan Kepala Sekolah</div>
              <div class="ws-quote">&ldquo;Pendidikan adalah proses untuk menyiapkan generasi menghadapi masa depan.&rdquo;</div>
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
          <div class="wk-silhouette"><img src="{{ asset('images/kepsek-nobg.png') }}" alt="" loading="lazy" /></div>
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

    <div class="jurusan-carousel" data-reveal>
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
              <a href="career-roadmap.html" class="cc-cta">Lihat Jurusan <i class="fas fa-arrow-right"></i></a>
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
              <a href="career-roadmap.html" class="cc-cta">Lihat Jurusan <i class="fas fa-arrow-right"></i></a>
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
              <a href="career-roadmap.html" class="cc-cta">Lihat Jurusan <i class="fas fa-arrow-right"></i></a>
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
              <a href="career-roadmap.html" class="cc-cta">Lihat Jurusan <i class="fas fa-arrow-right"></i></a>
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
              <a href="career-roadmap.html" class="cc-cta">Lihat Jurusan <i class="fas fa-arrow-right"></i></a>
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

<!-- ================= JOURNEY TIMELINE / ROADMAP ================= -->
<section class="roadmap-preview-section" id="roadmap-preview">
  <!-- Map background: contours + blueprint grid + coords + compass -->
  <div class="j2k8-map" aria-hidden="true">
    <div class="j2k8-grid"></div>
    <div class="j2k8-contours"></div>
    <div class="j2k8-coords">
      <i style="top:11%;left:4%">122.42&deg; E</i>
      <i style="top:16%;right:6%">07.47&deg; S</i>
      <i style="bottom:8%;left:13%">GRID 4B</i>
      <span class="cd-dot" style="top:20%;left:23%"></span>
      <span class="cd-dot" style="top:66%;left:84%"></span>
      <span class="cd-dot" style="top:40%;left:47%"></span>
      <span class="cd-dash" style="top:30%;left:58%"></span>
      <span class="cd-dash" style="top:76%;left:32%"></span>
    </div>
    <div class="j2k8-compass">
      <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="46" fill="none" stroke="currentColor" stroke-width="2.5" opacity=".7"/>
        <circle cx="50" cy="50" r="38" fill="none" stroke="currentColor" stroke-width="1" opacity=".4"/>
        <path d="M50 14 L56 44 L50 38 L44 44 Z" fill="currentColor" opacity=".85"/>
        <path d="M50 86 L44 56 L50 62 L56 56 Z" fill="currentColor" opacity=".4"/>
        <text x="50" y="11" text-anchor="middle" font-size="13" font-weight="700" fill="#7fd4ff" font-family="ui-monospace,monospace">N</text>
      </svg>
    </div>
  </div>

  <div class="container roadmap-preview-inner">
    <div class="roadmap-preview-header">
      <span class="j2k8-label">Perjalanan Sekolah</span>
      <h2 class="section-title">ROADMAP <span class="accent">PENGEMBANGAN</span> SEKOLAH</h2>
<div class="j2k8-legend">
        <span><span class="lg-ic lg-done"><i class="fas fa-check"></i></span> Selesai</span>
        <span><span class="lg-ic lg-running"><i class="fas fa-circle"></i></span> Berjalan</span>
        <span><span class="lg-ic lg-goal"><i class="fas fa-star"></i></span> Target</span>
      </div>
    </div>

    <div class="j2k8-stage" id="j2k8Stage">
      <svg class="j2k8-route" viewBox="0 0 1200 1150" preserveAspectRatio="none" aria-hidden="true">
        <path class="route-base" d="M120,934 C192,790.3 268,532.2 336,503 C404,473.8 468,739.3 528,759 C588,778.7 612,709.2 696,621 C780,532.8 912,230 1032,230"/>
        <path class="route-dash" d="M120,934 C192,790.3 268,532.2 336,503 C404,473.8 468,739.3 528,759 C588,778.7 612,709.2 696,621 C780,532.8 912,230 1032,230"/>
        <path class="route-glow" d="M120,934 C192,790.3 268,532.2 336,503 C404,473.8 468,739.3 528,759 C588,778.7 612,709.2 696,621 C780,532.8 912,230 1032,230"/>
      </svg>
      <span class="j2k8-arrow" style="left:19%;top:60%"></span>
      <span class="j2k8-arrow" style="left:47%;top:65%"></span>
      <span class="j2k8-arrow" style="left:72%;top:37%"></span>

      <!-- 01 | 2020-2022 | Fondasi Sekolah (START - bottom-left) -->
      <div class="j2k8-milestone j2k8-start">
        <span class="j2k8-start-flag" style="left:3%;top:71.9%"><i class="fas fa-flag-checkered"></i> Awal Perjalanan</span>
        <div class="j2k8-checkpoint" style="left:10%;top:81.25%" tabindex="0" role="button" aria-label="2020, awal perjalanan">
          <div class="j2k8-node"><i class="fas fa-school"></i></div>
          <span class="j2k8-cp-year">2020</span>
        </div>
        <span class="j2k8-connector v" style="left:10%;top:82.3%;height:55px"></span>
        <div class="j2k8-card" style="left:1%;top:86.25%">
          <div class="j2k8-card-top">
            <span class="j2k8-num">01</span>
            <span class="j2k8-status s-done"><span class="j2k8-status-dot"></span> Selesai</span>
          </div>
          <div class="j2k8-year">2020&ndash;2022</div>
          <h3 class="j2k8-name">Fondasi Sekolah</h3>
          <p class="j2k8-desc">Renovasi laboratorium, Akreditasi A, dan penguatan kemitraan industri.</p>
        </div>
      </div>

      <!-- 02 | 2023-2024 | Digitalisasi Sekolah (top-left) -->
      <div class="j2k8-milestone">
        <div class="j2k8-checkpoint" style="left:28%;top:43.75%" tabindex="0" role="button" aria-label="2023, digitalisasi sekolah">
          <div class="j2k8-node"><i class="fas fa-laptop-code"></i></div>
          <span class="j2k8-cp-year">2023</span>
        </div>
        <span class="j2k8-connector v" style="left:28%;top:38.35%;height:40px"></span>
        <div class="j2k8-card" style="left:12%;top:24%">
          <div class="j2k8-card-top">
            <span class="j2k8-num">02</span>
            <span class="j2k8-status s-done"><span class="j2k8-status-dot"></span> Selesai</span>
          </div>
          <div class="j2k8-year">2023&ndash;2024</div>
          <h3 class="j2k8-name">Digitalisasi Sekolah</h3>
          <p class="j2k8-desc">Digitalisasi perpustakaan serta penguatan sertifikasi Cisco &amp; Oracle.</p>
        </div>
      </div>

      <!-- 03 | 2025 | Transformasi Vokasi (middle-left) -->
      <div class="j2k8-milestone">
        <div class="j2k8-checkpoint" style="left:44%;top:66%" tabindex="0" role="button" aria-label="2025, transformasi vokasi">
          <div class="j2k8-node"><i class="fas fa-gear"></i></div>
          <span class="j2k8-cp-year">2025</span>
        </div>
        <span class="j2k8-connector v" style="left:44%;top:68.8%;height:60px"></span>
        <div class="j2k8-card" style="left:28%;top:73%">
          <div class="j2k8-card-top">
            <span class="j2k8-num">03</span>
            <span class="j2k8-status s-running"><span class="j2k8-status-dot"></span> Berjalan</span>
          </div>
          <div class="j2k8-year">2025</div>
          <h3 class="j2k8-name">Transformasi Vokasi</h3>
          <p class="j2k8-desc">Penguatan pembelajaran berbasis industri dan kompetensi siswa.</p>
        </div>
      </div>

      <!-- 04 | 2026 | Penguatan Ekosistem (middle-right) -->
      <div class="j2k8-milestone">
        <div class="j2k8-checkpoint" style="left:58%;top:54%" tabindex="0" role="button" aria-label="2026, penguatan ekosistem">
          <div class="j2k8-node"><i class="fas fa-handshake"></i></div>
          <span class="j2k8-cp-year">2026</span>
        </div>
        <span class="j2k8-connector v" style="left:58%;top:47.5%;height:36px"></span>
        <div class="j2k8-card" style="left:40%;top:36%">
          <div class="j2k8-card-top">
            <span class="j2k8-num">04</span>
            <span class="j2k8-status s-running"><span class="j2k8-status-dot"></span> Berjalan</span>
          </div>
          <div class="j2k8-year">2026</div>
          <h3 class="j2k8-name">Penguatan Ekosistem</h3>
          <p class="j2k8-desc">Pengembangan program keahlian, fasilitas, dan kemitraan industri.</p>
        </div>
      </div>

      <!-- 05 | 2028 | Destination (right) -->
      <div class="j2k8-milestone j2k8-goal">
        <div class="j2k8-checkpoint" style="left:86%;top:20%" tabindex="0" role="button" aria-label="2028, target sekolah vokasi rujukan nasional">
          <div class="j2k8-node"><i class="fas fa-star"></i></div>
          <span class="j2k8-cp-year">2028</span>
          <span class="j2k8-cp-tag">Target</span>
        </div>
        <span class="j2k8-connector v" style="left:86%;top:22.7%;height:95px"></span>
        <div class="j2k8-card j2k8-goal-card" style="left:70%;top:29%">
          <div class="j2k8-card-top">
            <span class="j2k8-num">05</span>
            <span class="j2k8-status s-goal"><span class="j2k8-status-dot"></span> Target</span>
          </div>
          <div class="j2k8-year">2028</div>
          <h3 class="j2k8-name">Sekolah Vokasi Rujukan Nasional</h3>
          <p class="j2k8-desc">Target utama perjalanan transformasi SMK Negeri 2 Mojokerto.</p>
        </div>
      </div>
    </div>

    <div style="display:flex;justify-content:center;margin-top:4.5rem">
      <a href="school-roadmap.html" class="j2k8-cta">Jelajahi Perjalanan <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<section class="prestasi-siswa-section" id="prestasi">
  <div class="prestasi-decor" aria-hidden="true">
    <span class="pdec pdec-1"></span><span class="pdec pdec-2"></span>
    <span class="pdec pdec-3"></span><span class="pdec pdec-4"></span><span class="pdec pdec-5"></span><span class="pdec pdec-6"></span><span class="pdec-line pdec-line-1"></span><span class="pdec-line pdec-line-2"></span>
  </div>

  <div class="prestasi-inner">
    <div class="prestasi-heading section-header center">
      <div class="section-label">Produk Ungggulan Setiap Jurusan</div>
      <h2 class="section-title">Produk <span class="accent">Unggulan</span></h2>
    </div>

    <div class="prestasi-slider-wrap">
      <button class="prestasi-arrow prestasi-prev" type="button" aria-label="Prestasi sebelumnya">‹</button>
      <div class="prestasi-slider" id="prestasiSlider">
        <article class="prestasi-slide is-active">
          <div class="prestasi-photo"><span>FOTO PRESTASI</span><small>01</small></div>
          <div class="prestasi-slide-info">
            <span class="prestasi-badge">NASIONAL</span>
            <span class="prestasi-year">2026</span>
            <h3>Juara Nasional</h3>
            <p>Nama siswa atau tim • Nama kompetisi</p>
          </div>
        </article>

        <article class="prestasi-slide">
          <div class="prestasi-photo"><span>FOTO PRESTASI</span><small>02</small></div>
          <div class="prestasi-slide-info">
            <span class="prestasi-badge">REGIONAL</span>
            <span class="prestasi-year">2026</span>
            <h3>Karya Kreatif Terbaik</h3>
            <p>Nama siswa atau tim • Bidang kreatif</p>
          </div>
        </article>

        <article class="prestasi-slide">
          <div class="prestasi-photo"><span>FOTO PRESTASI</span><small>03</small></div>
          <div class="prestasi-slide-info">
            <span class="prestasi-badge">KEAHLIAN</span>
            <span class="prestasi-year">2026</span>
            <h3>Kompetisi Keahlian</h3>
            <p>Nama siswa atau tim • Bidang teknologi</p>
          </div>
        </article>

        <article class="prestasi-slide">
          <div class="prestasi-photo"><span>FOTO PRESTASI</span><small>04</small></div>
          <div class="prestasi-slide-info">
            <span class="prestasi-badge">SEKOLAH</span>
            <span class="prestasi-year">2026</span>
            <h3>Prestasi Unggulan</h3>
            <p>Nama siswa atau tim • Kegiatan sekolah</p>
          </div>
        </article>
      </div>
      <button class="prestasi-arrow prestasi-next" type="button" aria-label="Prestasi berikutnya">›</button>

      <div class="prestasi-dots" id="prestasiDots">
        <button class="active" type="button" aria-label="Prestasi 1"></button>
        <button type="button" aria-label="Prestasi 2"></button>
        <button type="button" aria-label="Prestasi 3"></button>
        <button type="button" aria-label="Prestasi 4"></button>
      </div>
    </div>
  </div>
</section>





<!-- ================= KONTAK & FOOTER ================= -->
<section class="kontak-section section-py" id="kontak" aria-label="Kontak dan lokasi sekolah">
  <div class="container">
    <div class="ft-wrap">
      <div class="ft-head" data-reveal>
        <div class="ft-eyebrow">Temukan Kami</div>
        <h2 class="ft-title">Temukan <span class="ft-gold">Kami</span></h2>
        <p class="ft-sub">Kami siap membantu Anda.</p>
        <p class="ft-line">Informasi sekolah, PPDB, dan program keahlian.</p>
      </div>
      <div class="ft-map" data-reveal>
        <div class="ft-pin" aria-hidden="true">
          <div class="ft-pin-badge"><img src="{{ asset('images/logo_smkn2.png') }}" alt="" /></div>
          <div class="ft-pin-ring"></div>
          <div class="ft-pin-ring r2"></div>
        </div>
        <iframe title="Lokasi SMK Negeri 2 Mojokerto" src="https://www.google.com/maps?q=Jl.%20Raya%20Pulorejo%2C%20Kel.%20Pulorejo%2C%20Kec.%20Prajurit%20Kulon%2C%20Kota%20Mojokerto%2C%20Jawa%20Timur%2061325&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
        <div class="ft-card" data-reveal>
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
      <div class="ft-cta" data-reveal>
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
  var revealObs = new IntersectionObserver(function(entries) {
    entries.forEach(function(e) { if(e.isIntersecting) { e.target.classList.add('revealed'); revealObs.unobserve(e.target); } });
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
        if(r.top < vh + 220 && r.bottom > -40){ el.classList.add('revealed'); return false; }
        return true;
      });
      /* Force reveal semua yang tersisa setelah ~3.6 detik agar konten
         tidak pernah selamanya tersembunyi (mis. hero lebih tinggi dari viewport) */
      if(checks >= 8){
        pending.forEach(function(el){ el.classList.add('revealed'); });
        clearInterval(iv);
      } else if(pending.length === 0){
        clearInterval(iv);
      }
    }, 450);
  })();

  /* ---- Journey to 2028 Map reveal + route draw ---- */
  var j2k8Stage = document.getElementById('j2k8Stage');
  if (j2k8Stage) {
    var j2k8Obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(e) {
        if (e.isIntersecting) {
          j2k8Stage.classList.add('drawn');
          var glow = j2k8Stage.querySelector('.route-glow');
          if (glow) {
            var len = glow.getTotalLength ? glow.getTotalLength() : 1200;
            glow.style.strokeDasharray = len;
            glow.style.strokeDashoffset = len;
            requestAnimationFrame(function(){ requestAnimationFrame(function(){ glow.style.strokeDashoffset = '0'; }); });
          }
          j2k8Obs.unobserve(j2k8Stage);
        }
      });
    }, { threshold: 0.18 });
    j2k8Obs.observe(j2k8Stage);
  }

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
  (function(){
    var stage = document.getElementById('flipbook');
    if(!stage) return;
    var sheets = Array.prototype.slice.call(stage.querySelectorAll('.book-sheet'));
    var book = stage.querySelector('.book3d');
    var prevBtn = stage.querySelector('.flip-prev');
    var nextBtn = stage.querySelector('.flip-next');
    var dots = Array.prototype.slice.call(stage.querySelectorAll('.flip-dot'));
    var cur = 0, turning = false, total = sheets.length;
    var curEl = document.getElementById('flip-cur');
    var totEl = document.getElementById('flip-total');
    if(totEl) totEl.textContent = total * 2;
    function render(){
      sheets.forEach(function(s,i){
        s.classList.toggle('active', i === cur);
        s.classList.remove('reveal-under','turning-fwd','turning-bwd');
      });
      if(prevBtn) prevBtn.disabled = (cur === 0);
      if(nextBtn) nextBtn.disabled = (cur === total - 1);
      dots.forEach(function(d,i){ d.classList.toggle('active', i === cur); });
      if(curEl) curEl.innerHTML = (cur*2+1) + '&ndash;' + (cur*2+2);
    }
    function go(n){
      if(turning || n < 0 || n >= total || n === cur) return;
      turning = true;
      var from = sheets[cur];
      var dir = n > cur ? 'fwd' : 'bwd';
      if(sheets[n]) sheets[n].classList.add('reveal-under');
      from.classList.add('turning-' + dir);
      window.setTimeout(function(){
        from.classList.remove('turning-' + dir);
        cur = n;
        render();
        turning = false;
      }, 900);
    }
    window.flipRestart = function(){ go(0); };
    if(prevBtn) prevBtn.addEventListener('click', function(e){ e.stopPropagation(); go(cur - 1); });
    if(nextBtn) nextBtn.addEventListener('click', function(e){ e.stopPropagation(); go(cur + 1); });
    dots.forEach(function(d,i){ d.addEventListener('click', function(e){ e.stopPropagation(); go(i); }); });
    document.addEventListener('keydown', function(e){
      if(e.key === 'ArrowRight') go(cur + 1);
      if(e.key === 'ArrowLeft') go(cur - 1);
    });
    if(book) book.addEventListener('click', function(e){
      if(e.target.closest('a,button,.flip-nav')) return;
      var r = book.getBoundingClientRect();
      var x = e.clientX - r.left;
      if(x < r.width * 0.45){ go(cur - 1); } else { go(cur + 1); }
    });
    render();
  })();


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

<script>
document.addEventListener('DOMContentLoaded',function(){
  const slides=[...document.querySelectorAll('.prestasi-slide')];
  const dots=[...document.querySelectorAll('#prestasiDots button')];
  let current=0;
  function show(i){
    current=(i+slides.length)%slides.length;
    slides.forEach((s,n)=>s.classList.toggle('is-active',n===current));
    dots.forEach((d,n)=>d.classList.toggle('active',n===current));
  }
  document.querySelector('.prestasi-prev')?.addEventListener('click',()=>show(current-1));
  document.querySelector('.prestasi-next')?.addEventListener('click',()=>show(current+1));
  dots.forEach((d,n)=>d.addEventListener('click',()=>show(n)));
});
</script>
