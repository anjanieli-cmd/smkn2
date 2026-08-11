<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'SMK Negeri 2 Mojokerto — Beranda')</title>
  <meta name="description" content="Website resmi SMK Negeri 2 Mojokerto — Sekolah Menengah Kejuruan unggulan di Kota Mojokerto, Jawa Timur." />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    /* ============================================================
       SMK NEGERI 2 MOJOKERTO — BERANDA (LIGHT MODE · BLUE & GOLD THEME) (v6)
       ============================================================ */
        :root{
      --teal:#1d6fb8;
      --teal-dark:#13518c;
      --teal-deep:#0d3a66;
      --teal-light:#28a9e1;
      --teal-glow:rgba(29,111,184,.5);
      --mint:#28a9e1;
      --mint-soft:#9bd3f5;
      --mint-glow:rgba(40,169,225,.35);
      --gold:#f9a825;
      --gold-dark:#c67d00;
      --ink:#17324d;
      --text:#33475c;
      --text-muted:#5d7288;
      --bg:#f5f9fd;
      --card:#ffffff;
      --border:#dce8f2;
      --font-display:'Archivo Black',sans-serif;
      --font-body:'Plus Jakarta Sans',sans-serif;
      --radius:20px;
      --shadow:0 10px 40px rgba(29,111,184,.12);
      --shadow-lg:0 24px 70px rgba(29,111,184,.2);
      --ease:cubic-bezier(.22,.61,.36,1);
    }

    *{margin:0;padding:0;box-sizing:border-box}
    html{scroll-behavior:smooth}
    body{
      font-family:var(--font-body);
      color:var(--text);
      background:var(--bg);
      line-height:1.7;
      overflow-x:hidden;
      -webkit-font-smoothing:antialiased;
      position:relative;
      isolation:isolate;
    }
    body.a11y-text-lg{font-size:1.1rem}
    body.a11y-text-xl{font-size:1.22rem}
    body.a11y-line-wide p,body.a11y-line-wide .section-desc,body.a11y-line-wide .vm-text{line-height:2}
    body.a11y-line-xwide p,body.a11y-line-xwide .section-desc,body.a11y-line-xwide .vm-text{line-height:2.3}
    body.a11y-dyslexic *{font-family:'Comic Sans MS','Trebuchet MS',sans-serif !important;letter-spacing:.03em}
    body.a11y-high-contrast{
      --bg:#000;--text:#fff;--text-muted:#ffd;--card:#111;--border:#444;
    }
    body.a11y-dark-mode{
      --bg:#0d3a66;--text:#d9f2ef;--text-muted:#8fb8b5;--card:#13518c;--border:#0d3a66;
    }
    body.a11y-dark-mode .section-desc{color:#8fb8b5}
    body.a11y-dark-mode .berita-featured,.body.a11y-dark-mode .feed-face{background:#13518c}
    ::selection{background:var(--teal);color:#fff}
    img{max-width:100%;display:block}
    a{text-decoration:none;color:inherit}
    button{font-family:inherit;cursor:pointer}
    .container{width:min(1180px,92%);margin:0 auto}
    .section-py{padding:96px 0}
    /* Tutup bawah hero: bg buram di section pertama agar foto hero berhenti tepat di tepi bawah hero */
    .profil-section{position:relative;background:#f5f9fd}
    body.a11y-dark-mode .profil-section{background:#0d3a66}
    body.a11y-high-contrast .profil-section{background:#000}

    /* ---------- PRELOADER ---------- */
    #preloader{
      position:fixed;inset:0;z-index:9999;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:22px;
      background:radial-gradient(1200px 600px at 50% 40%,#1d6fb8,#13518c 60%,#0d3a66);
      transition:opacity .7s ease,visibility .7s ease;
    }
    #preloader.done{opacity:0;visibility:hidden;pointer-events:none}
    .preloader-logo{
      width:92px;height:92px;border-radius:24px;display:flex;align-items:center;justify-content:center;
      background:rgba(255,255,255,.96);padding:14px;
      box-shadow:0 0 0 0 rgba(40,169,225,.5);animation:pulse-ring 1.6s infinite;
    }
    .preloader-logo img{width:100%;height:100%;object-fit:contain;display:block}
    @keyframes pulse-ring{
      0%{box-shadow:0 0 0 0 rgba(40,169,225,.55)}
      70%{box-shadow:0 0 0 26px rgba(40,169,225,0)}
      100%{box-shadow:0 0 0 0 rgba(40,169,225,0)}
    }
    .preloader-text{color:var(--mint-soft);font-weight:600;letter-spacing:.35em;text-transform:uppercase;font-size:.75rem;animation:blink 1.2s infinite}
    @keyframes blink{50%{opacity:.35}}
    .preloader-bar{width:200px;height:5px;border-radius:99px;background:rgba(255,255,255,.14);overflow:hidden}
    .preloader-bar span{display:block;height:100%;width:40%;border-radius:99px;background:linear-gradient(90deg,var(--mint),#fff);animation:loadslide 1.1s ease-in-out infinite}
    @keyframes loadslide{0%{transform:translateX(-110%)}100%{transform:translateX(510%)}}

    /* ---------- ANIMATED BG FX ---------- */
    .bg-fx{position:fixed;inset:0;z-index:-2;overflow:hidden;pointer-events:none}
    .bg-blob{position:absolute;border-radius:50%;filter:blur(90px);opacity:.5;animation:blobFloat 22s ease-in-out infinite}
    .bg-blob-1{width:520px;height:520px;background:var(--teal-glow);top:-140px;left:-120px}
    .bg-blob-2{width:460px;height:460px;background:var(--mint-glow);top:32%;right:-160px;animation-delay:-7s}
    .bg-blob-3{width:420px;height:420px;background:rgba(29,111,184,.4);bottom:-140px;left:30%;animation-delay:-14s}
    @keyframes blobFloat{
      0%,100%{transform:translate(0,0) scale(1)}
      33%{transform:translate(60px,-40px) scale(1.12)}
      66%{transform:translate(-40px,50px) scale(.94)}
    }

    /* ---------- CURSOR GLOW ---------- */
    #cursorGlow{
      position:fixed;width:440px;height:440px;border-radius:50%;pointer-events:none;z-index:1;
      background:radial-gradient(circle,rgba(29,111,184,.14),rgba(40,169,225,.05) 45%,transparent 70%);
      transform:translate(-50%,-50%);left:0;top:0;mix-blend-mode:screen;display:none;
    }
    @media(pointer:fine){#cursorGlow{display:block}}

    /* ---------- ANNOUNCE BAR ---------- */
    .announce-bar{background:linear-gradient(90deg,#0d3a66,#1d6fb8,#0d3a66);color:#fff;font-size:.8rem;position:relative;z-index:60;overflow:hidden;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);border-bottom:1px solid rgba(255,255,255,.18);text-shadow:0 1px 3px rgba(0,0,0,.35)}
    .announce-ticker{display:flex;gap:3rem;white-space:nowrap;padding:.45rem 0;animation:ticker 26s linear infinite;width:max-content}
    .announce-ticker:hover{animation-play-state:paused}
    @keyframes ticker{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
    .announce-item{display:flex;align-items:center;gap:.5rem;font-weight:500}
    .announce-item i{color:var(--gold);animation:tada 3s infinite}

    /* ---------- NAVBAR ---------- */
    #navbar{position:sticky;top:14px;z-index:100;width:min(1240px,94%);margin:0 auto;margin-top:14px;transition:all .4s var(--ease)}
    .nav-inner{
      display:flex;align-items:center;justify-content:space-between;gap:1rem;
      padding:.7rem 1.2rem;border-radius:18px;
      background:linear-gradient(135deg,#0d3a66,#1d6fb8);
      backdrop-filter:blur(18px) saturate(160%);-webkit-backdrop-filter:blur(18px) saturate(160%);
      border:2px solid rgba(255,255,255,.7);box-shadow:0 10px 34px rgba(13,58,102,.35),inset 0 1px 0 rgba(255,255,255,.25);
      transition:all .4s var(--ease);
    }
    #navbar.scrolled{top:8px}
    #navbar.scrolled .nav-inner{background:linear-gradient(135deg,#0a2f57,#13518c);box-shadow:0 14px 44px rgba(13,58,102,.5);padding:.55rem 1.2rem}
    .nav-brand{display:flex;align-items:center;gap:.7rem}
    .nav-logo{
      width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;
      background:rgba(255,255,255,.96);padding:5px;overflow:hidden;
      box-shadow:0 6px 16px rgba(13,58,102,.25),inset 0 0 0 1px rgba(255,255,255,.55);animation:logoFloat 4s ease-in-out infinite;
    }
    .nav-logo img{width:100%;height:100%;object-fit:contain;display:block}
    @keyframes logoFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-4px)}}
    .nav-brand-text strong{display:block;font-size:.95rem;color:#fff;line-height:1.2;text-shadow:0 1px 2px rgba(0,0,0,.25)}
    .nav-brand-text strong .num-2{color:#ffd54f;text-shadow:0 1px 3px rgba(0,0,0,.35)}
    .nav-brand-text span{font-size:.72rem;color:rgba(255,255,255,.88);font-weight:700}
    .num-2{color:#f9a825;font-style:normal}
    .nav-menu{display:flex;align-items:center;gap:.2rem;list-style:none}
    .nav-link{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem .85rem;border-radius:10px;font-size:.86rem;font-weight:600;color:rgba(255,255,255,.95);transition:all .25s var(--ease);position:relative}
    .nav-link:hover,.nav-link.active{color:#fff;background:rgba(255,255,255,.16)}
    .nav-link.active::after{content:"";position:absolute;bottom:2px;left:50%;transform:translateX(-50%);width:18px;height:3px;border-radius:99px;background:#fff}
    .nav-item{position:relative}
    .dropdown-menu{
      position:absolute;top:calc(100% + 10px);left:0;min-width:230px;padding:.55rem;border-radius:14px;
      background:rgba(255,255,255,.97);backdrop-filter:blur(14px);border:1px solid rgba(29,111,184,.25);
      box-shadow:0 20px 50px rgba(13,58,102,.18);opacity:0;visibility:hidden;transform:translateY(12px);
      transition:all .3s var(--ease);
    }
    .nav-item.dropdown-open .dropdown-menu{opacity:1;visibility:visible;transform:translateY(0)}
    .dropdown-menu a{display:flex;align-items:center;gap:.6rem;padding:.55rem .7rem;border-radius:9px;font-size:.84rem;font-weight:500;color:var(--ink);transition:all .2s}
    .dropdown-menu a i{width:18px;color:#1d6fb8}
    .dropdown-menu a:hover{background:rgba(29,111,184,.1);color:#0d3a66;transform:translateX(4px)}
    .nav-cta{
      background:linear-gradient(135deg,#ff6d00,#f4511e);color:#fff !important;
      box-shadow:0 8px 22px rgba(244,81,30,.5),inset 0 0 0 2px rgba(255,255,255,.7);position:relative;overflow:hidden;
      animation:ctaGlow 2.2s ease-in-out infinite;
    }
    .nav-cta:hover,.nav-cta.active{color:#fff !important;background:linear-gradient(135deg,#ff8f00,#ff5722);transform:translateY(-2px);box-shadow:0 14px 30px rgba(244,81,30,.65),inset 0 0 0 2px rgba(255,255,255,.9)}
    .nav-cta::after{content:"";position:absolute;inset:0;background:linear-gradient(110deg,transparent 30%,rgba(255,255,255,.4) 50%,transparent 70%);transform:translateX(-120%);transition:transform .6s}
    .nav-cta:hover::after{transform:translateX(120%)}
    @keyframes ctaGlow{
      0%,100%{box-shadow:0 8px 22px rgba(244,81,30,.45),inset 0 0 0 2px rgba(255,255,255,.65)}
      50%{box-shadow:0 8px 32px rgba(255,109,0,.8),inset 0 0 0 2px rgba(255,255,255,.95)}
    }
    .nav-toggle{display:none;flex-direction:column;gap:5px;background:none;border:0;padding:.5rem}
    .nav-toggle span{width:24px;height:2.6px;border-radius:99px;background:#fff;transition:all .3s}

    /* ---------- HERO ---------- */
    .hero{
      position:relative;min-height:100vh;display:flex;flex-direction:column;justify-content:center;overflow:hidden;isolation:isolate;
      background:transparent;
    }
    @keyframes heroShift{0%,100%{background-position:0% 50%}50%{background-position:100% 50%}}
    /* Foto gedung sebagai background hero + overlay teal (Ken Burns slow zoom) */
    /* Lapisan GLOBAL: menutupi dari paling atas halaman (announce bar + navbar + hero) sehingga tidak ada area putih */
    .page-hero-bg{
      position:absolute;top:0;left:0;right:0;width:100%;height:calc(100vh + 160px);z-index:-3;
      background:url('{{ asset('images/hero-sekolah.jpg') }}') 50% 0%/cover no-repeat;
      animation:heroKenburns 26s ease-in-out infinite alternate;will-change:transform;
    }
    .page-hero-bg::after{content:"";position:absolute;inset:0;background:linear-gradient(115deg,rgba(10,38,66,.82) 0%,rgba(13,58,102,.62) 42%,rgba(8,32,58,.6) 100%)}
    /* Lapisan lama di dalam .hero tetap sebagai fallback (transparan jika global aktif) */
    .hero-photo{position:absolute;inset:0;width:100%;height:100%;z-index:-4;background:url('{{ asset('images/hero-sekolah.jpg') }}') 50% 0%/cover no-repeat;animation:heroKenburns 26s ease-in-out infinite alternate;will-change:transform;display:none}
    .hero-photo::after{content:"";position:absolute;inset:0;background:linear-gradient(115deg,rgba(10,38,66,.8) 0%,rgba(13,58,102,.58) 42%,rgba(8,32,58,.55) 100%)}
    @keyframes heroKenburns{0%{transform:scale(1) translateY(0)}100%{transform:scale(1.14) translateY(-14px)}}
    .hero-bg{position:absolute;inset:0;z-index:-3;background:radial-gradient(900px 500px at 78% 18%,rgba(40,169,225,.16),transparent 60%),radial-gradient(700px 420px at 12% 82%,rgba(29,111,184,.2),transparent 60%)}
    .hero-grid{
      position:absolute;inset:0;z-index:-2;opacity:.5;
      background-image:linear-gradient(rgba(40,169,225,.07) 1px,transparent 1px),linear-gradient(90deg,rgba(40,169,225,.07) 1px,transparent 1px);
      background-size:56px 56px;mask-image:radial-gradient(ellipse at 50% 40%,#000 30%,transparent 75%);
    }
    .hero-orb{position:absolute;border-radius:50%;filter:blur(70px);z-index:-1;animation:orbFloat 14s ease-in-out infinite}
    .hero-orb-1{width:420px;height:420px;background:rgba(40,169,225,.22);top:-100px;right:-80px}
    .hero-orb-2{width:360px;height:360px;background:rgba(29,111,184,.3);bottom:12%;left:-120px;animation-delay:-5s}
    .hero-orb-3{width:240px;height:240px;background:rgba(249,168,37,.16);top:38%;right:22%;animation-delay:-9s}
    @keyframes orbFloat{0%,100%{transform:translate(0,0) scale(1)}50%{transform:translate(-30px,34px) scale(1.14)}}
    .hero-circles{position:absolute;inset:0;z-index:-1;pointer-events:none}
    .hero-circle{position:absolute;border:1.6px dashed rgba(40,169,225,.22);border-radius:50%;animation:spin 60s linear infinite}
    .hero-circle:nth-child(1){width:520px;height:520px;top:-140px;right:-120px}
    .hero-circle:nth-child(2){width:400px;height:400px;top:-90px;right:-80px;animation-duration:44s;animation-direction:reverse}
    .hero-circle:nth-child(3){width:640px;height:640px;bottom:-260px;left:-200px;animation-duration:80s}
    .hero-circle:nth-child(4){width:340px;height:340px;bottom:6%;left:18%;animation-duration:36s;animation-direction:reverse}
    .hero-circle:nth-child(5){width:220px;height:220px;top:30%;right:8%;animation-duration:30s}
    @keyframes spin{to{transform:rotate(360deg)}}
    #heroCanvas{position:absolute;inset:0;z-index:0;pointer-events:none}

    .hero-main{position:relative;z-index:5;flex:1;display:flex;align-items:center;justify-content:center;text-align:center;padding:1rem 4%}
    .hero-content-wrap{max-width:800px;display:flex;flex-direction:column;align-items:center}
    .hero-eyebrow{display:inline-flex;align-items:center;gap:.55rem;font-size:.8rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#ffffff;background:rgba(40,169,225,.1);border:1px solid rgba(40,169,225,.3);padding:.5rem 1rem;border-radius:99px;margin-bottom:1.4rem;animation:fadeUp .8s var(--ease) both}
    .hero-eyebrow .dot{width:9px;height:9px;border-radius:50%;background:var(--mint);box-shadow:0 0 12px var(--mint);animation:blink 1.4s infinite}
    .hero-headline{font-family:var(--font-display);font-size:clamp(2.6rem,6.2vw,4.6rem);line-height:1.06;color:#fff;text-transform:uppercase;letter-spacing:.01em;margin-bottom:1.2rem;filter:drop-shadow(0 10px 30px rgba(0,0,0,.35))}
    .hero-headline .line{display:block;overflow:hidden}
    .hero-headline .word{display:inline-block;animation:wordUp 1s var(--ease) both}
    @keyframes wordUp{from{transform:translateY(110%);opacity:0}to{transform:translateY(0);opacity:1}}
    .hero-headline .highlight{
      background:linear-gradient(100deg,#ffb300 10%,#ffe08a 50%,#ff8f00 90%);
      background-size:200% auto;-webkit-background-clip:text;background-clip:text;color:transparent;
      animation:shineText 3.4s linear infinite;
    }
    @keyframes shineText{to{background-position:200% center}}
    .hero-desc{font-size:clamp(.95rem,1.4vw,1.08rem);color:#ffffff;max-width:640px;margin-bottom:1.6rem;text-align:center;animation:fadeUp .9s .25s var(--ease) both}
    .hero-badges{display:flex;gap:.6rem;flex-wrap:wrap;margin-bottom:1.8rem;animation:fadeUp .9s .4s var(--ease) both}
    .hero-badge-pill{display:flex;align-items:center;gap:.5rem;font-size:.8rem;font-weight:600;color:#eef7ff;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.22);padding:.5rem .95rem;border-radius:99px;backdrop-filter:blur(8px);transition:all .3s var(--ease)}
    .hero-badge-pill i{color:var(--mint)}
    .hero-badge-pill:hover{transform:translateY(-3px);background:rgba(40,169,225,.16);border-color:var(--mint)}
    .hero-btns{display:flex;gap:.9rem;flex-wrap:wrap;animation:fadeUp .9s .55s var(--ease) both}
    .btn-hero-primary,.btn-hero-glass{display:inline-flex;align-items:center;gap:.6rem;padding:.95rem 1.7rem;border-radius:14px;font-weight:700;font-size:.95rem;transition:all .3s var(--ease);position:relative;overflow:hidden}
    .btn-hero-primary{background:linear-gradient(135deg,var(--mint),#9bd3f5);color:#0d3a66;box-shadow:0 14px 34px rgba(40,169,225,.35)}
    .btn-hero-primary::after{content:"";position:absolute;inset:0;background:linear-gradient(110deg,transparent 30%,rgba(255,255,255,.7) 50%,transparent 70%);transform:translateX(-130%);transition:transform .6s}
    .btn-hero-primary:hover{transform:translateY(-3px);box-shadow:0 20px 44px rgba(40,169,225,.5)}
    .btn-hero-primary:hover::after{transform:translateX(130%)}
    .btn-hero-glass{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.28);color:#fff;backdrop-filter:blur(8px)}
    .btn-hero-glass:hover{transform:translateY(-3px);background:rgba(255,255,255,.18)}
    .play-icon{width:34px;height:34px;border-radius:50%;background:var(--mint);color:#0d3a66;display:flex;align-items:center;justify-content:center;font-size:.8rem;animation:pulseRing 2s infinite}

    .hero-stats-bar{position:relative;z-index:5;padding:0 4% 2.6rem}
    .hero-stats-inner{
      display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;
      background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.18);border-radius:22px;
      padding:1.4rem;backdrop-filter:blur(14px);box-shadow:0 24px 60px rgba(0,0,0,.25);
      animation:fadeUp 1s .7s var(--ease) both;
    }
    .hero-stat-item{text-align:center;padding:.4rem;transition:all .3s var(--ease)}
    .hero-stat-item:hover{transform:translateY(-6px)}
    .hero-stat-num{font-family:var(--font-display);font-size:clamp(1.6rem,3.4vw,2.5rem);color:#fff;line-height:1.1}
    .hero-stat-num span{color:var(--mint);font-size:.7em}
    .hero-stat-label{font-size:.78rem;color:rgba(255,255,255,.78);margin-top:.3rem}

    /* wave divider */
    .wave-divider{position:absolute;bottom:-1px;left:0;width:100%;line-height:0;z-index:4}
    .wave-divider svg{width:100%;height:70px;display:block}

    /* ---------- SECTION COMMON ---------- */
    .section-label{display:inline-flex;align-items:center;gap:.5rem;font-size:.78rem;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:var(--teal);margin-bottom:.9rem}
    .section-label::before{content:"";width:26px;height:3px;border-radius:99px;background:linear-gradient(90deg,var(--teal),var(--mint))}
    .section-title{font-family:var(--font-display);font-size:clamp(1.7rem,3.4vw,2.5rem);color:var(--ink);line-height:1.2;margin-bottom:.8rem}
    .section-title .accent{background:linear-gradient(100deg,var(--teal),var(--teal-light));-webkit-background-clip:text;background-clip:text;color:transparent}
    .galeri-section .section-title .accent{background:linear-gradient(100deg,#ffd54a,#f5b82e);-webkit-background-clip:text;background-clip:text;color:transparent}
    .section-title .gold{background:linear-gradient(100deg,var(--gold),var(--gold-dark));-webkit-background-clip:text;background-clip:text;color:transparent}
    .section-desc{color:var(--text-muted);max-width:640px;font-size:.96rem}
    .section-header.center{text-align:center}
    .section-header.center .section-desc{margin:0 auto}
    .section-header.center .section-label::before{display:none}

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
    .window-section{position:relative;background:linear-gradient(140deg,#0b2d50,#114d84 55%,#114d84);color:#fff;padding:96px 0;overflow:hidden;transition:background .9s var(--ease)}
    .window-section::before{content:"";position:absolute;inset:0;background:
      repeating-linear-gradient(90deg,transparent 0 118px,rgba(255,255,255,.03) 118px 120px),
      repeating-linear-gradient(0deg,transparent 0 118px,rgba(255,255,255,.03) 118px 120px);pointer-events:none;z-index:1}
    .window-bg{position:absolute;inset:0;z-index:0;background:url('{{ asset('images/hero-sekolah.jpg') }}') center/cover no-repeat;
      filter:blur(9px) brightness(.55) saturate(.85);transform:scale(1.06);opacity:.5;pointer-events:none}
    .window-section .section-label,.window-section .section-title{color:#fff}
    .window-section .section-desc{color:rgba(255,255,255,.72)}
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
      background:linear-gradient(135deg,#0d3a66 0%,#114d84 62%,#15599a 100%)}
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
    .wk-title{font-family:var(--font-display);font-size:clamp(1.5rem,3.6vw,2.5rem);letter-spacing:.06em;color:#fff;line-height:1.15;
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
    /* ---------- JURUSAN: FEATURED PROGRAM CAROUSEL ---------- */
    .jurusan-section{position:relative;background:var(--bg);overflow:hidden}
    .jurusan-section::before{
      content:"";position:absolute;top:52%;left:50%;width:900px;height:560px;transform:translate(-50%,-50%);
      background:radial-gradient(ellipse at center,rgba(40,169,225,.10),rgba(40,169,225,0) 65%);
      pointer-events:none;z-index:0;
    }
    .jurusan-carousel{position:relative;z-index:1;margin-top:5.2rem}
    .carousel-stage{
      position:relative;height:600px;max-width:1240px;margin:0 auto;
      display:flex;align-items:flex-end;justify-content:center;gap:2.4rem;
      padding-top:110px; /* ruang untuk foto cutout yang menonjol ke atas */
    }
    .carousel-card{
      position:relative;flex-shrink:0;width:300px;height:560px;order:4;
      cursor:pointer;
      transition:transform .6s var(--ease),opacity .6s var(--ease),width .6s var(--ease);
      will-change:transform,opacity;
      display:flex;flex-direction:column;align-items:center;
    }
    .carousel-card .card-inner{position:relative;width:100%;height:100%;display:flex;flex-direction:column;align-items:center}
    /* --- states: previous — ACTIVE — next, terpisah jelas, tanpa saling menutupi --- */
    .carousel-card.active{
      width:390px;height:560px;transform:translateY(0) scale(1);opacity:1;z-index:3;order:2;
    }
    .carousel-card.prev,.carousel-card.next{
      transform:translateY(34px) scale(.84);opacity:.72;z-index:2;
    }
    .carousel-card.prev{order:1}
    .carousel-card.next{order:3}
    .carousel-card.hidden{display:none}
    .carousel-card.no-anim{transition:none!important}
    /* --- foto siswa: cutout transparan berdiri bebas, TANPA kotak/border/shadow box --- */
    .cc-photo{position:relative;width:100%;height:330px;flex-shrink:0;z-index:1;overflow:visible;display:flex;align-items:flex-end;justify-content:center}
    .cc-photo img{
      display:block;position:relative;
      height:auto;width:auto;max-height:408px;max-width:100%;object-fit:contain;
      filter:drop-shadow(0 20px 30px rgba(13,58,102,.22));
      transform:translateY(0) scale(1);
      transition:transform .6s var(--ease),opacity .6s var(--ease);
    }
    .carousel-card.active .cc-photo img{transform:translateY(0) scale(1);opacity:1}
    .carousel-card:not(.active) .cc-photo img{transform:translateY(-8px) scale(.84);opacity:.72}
    /* --- icon badge kecil (subtle) --- */
    
    /* --- teks di bawah foto (tanpa box) --- */
    .cc-body{
      position:relative;z-index:2;width:100%;padding:2.9rem 1rem .2rem;
      display:flex;flex-direction:column;align-items:center;text-align:center;flex:1;
    }
    
    .cc-abbr{position:relative;z-index:1;font-family:var(--font-display);font-size:1.55rem;color:#1796cb;letter-spacing:.02em;line-height:1.1}
    /* Brand color per jurusan — diambil dari warna dominan logo masing-masing */
    .carousel-card[data-index="0"] .cc-abbr{color:#E8A800}   /* APHP: kuning logo */
    .carousel-card[data-index="1"] .cc-abbr{color:#D80A86}   /* DKV: pink logo */
    .carousel-card[data-index="2"] .cc-abbr{color:#FE8D03}   /* KULINER: oranye logo */
    .carousel-card[data-index="3"] .cc-abbr{color:#049747}   /* LPS: hijau logo */
    .carousel-card[data-index="4"] .cc-abbr{color:#DB1320}   /* RPL: merah logo */
    .cc-line{width:36px;height:3px;border-radius:99px;background:linear-gradient(90deg,var(--gold),var(--gold-dark));margin:.5rem 0 .55rem}
    .cc-full{font-size:.85rem;font-weight:600;color:var(--text-muted);line-height:1.45}
    .cc-desc{font-size:.8rem;color:var(--text-muted);line-height:1.55;margin-top:.45rem;max-width:340px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .cc-stats{display:flex;gap:.55rem;margin-top:.8rem;flex-wrap:wrap;justify-content:center}
    .cc-stat{font-size:.68rem;font-weight:700;letter-spacing:.02em;padding:.32rem .65rem;border-radius:99px;background:#eef6fd;color:var(--teal-dark);border:1px solid #dcebf7}
    .cc-stat.gold{background:#fff7e0;color:#a56b00;border-color:#f5e2ae}
    .cc-cta{
      display:inline-flex;align-items:center;gap:.45rem;margin-top:.85rem;font-size:.82rem;font-weight:800;
      color:var(--teal);transition:all .3s var(--ease);text-decoration:none;
    }
    .cc-cta i{font-size:.74rem;transition:transform .3s var(--ease)}
    .carousel-card.active:hover .cc-cta i{transform:translateX(4px)}
    .cc-hint{font-size:.72rem;font-weight:600;color:var(--text-muted);margin-top:auto;padding-top:.7rem;letter-spacing:.04em;text-transform:uppercase}
    .carousel-card:not(.active) .cc-body{opacity:.9}
    .carousel-card.active .cc-body{opacity:1}
    /* --- nav & indicator --- */
    .carousel-nav{display:flex;align-items:center;justify-content:center;gap:1.3rem;margin-top:2.2rem}
    .carousel-nav-btn{
      width:46px;height:46px;border-radius:50%;border:1px solid var(--border);background:#fff;color:var(--teal);
      display:flex;align-items:center;justify-content:center;font-size:1rem;cursor:pointer;
      transition:all .3s var(--ease);box-shadow:var(--shadow);
    }
    .carousel-nav-btn:hover{background:var(--teal);color:#fff;border-color:var(--teal);transform:translateY(-2px)}
    .carousel-indicator{font-family:var(--font-display);font-size:1.05rem;color:var(--ink);letter-spacing:.06em;min-width:72px;text-align:center}
    .carousel-indicator em{font-style:normal;color:var(--gold-dark)}

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
    .j2k8-label{display:inline-block;font-size:.66rem;font-weight:800;letter-spacing:.3em;text-transform:uppercase;color:#29b6f6;margin-bottom:.95rem}
    .roadmap-preview-section .section-title{color:#fff;font-size:2.25rem;margin-bottom:.85rem}
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

    /* ---------- BERITA / MAGAZINE ---------- */
    .berita-mag{display:grid;grid-template-columns:1.45fr 1fr;gap:1.6rem;margin-top:2.4rem;align-items:stretch}
    .berita-tabs{display:flex;flex-wrap:wrap;justify-content:center;gap:.55rem;margin-top:1.5rem}
    .berita-tab{border:1px solid var(--border);background:#fff;color:var(--text-muted);font-size:.78rem;font-weight:700;letter-spacing:.04em;padding:.5rem 1.15rem;border-radius:99px;transition:all .3s var(--ease)}
    .berita-tab:hover{border-color:var(--teal);color:var(--teal)}
    .berita-tab.active{background:linear-gradient(135deg,var(--teal),var(--teal-light));color:#fff;border-color:transparent;box-shadow:0 8px 20px rgba(29,111,184,.3)}
    .berita-featured{position:relative;border-radius:24px;overflow:hidden;min-height:562px;display:flex;align-items:flex-end;box-shadow:var(--shadow-lg);background:linear-gradient(140deg,#13518c,#1d6fb8)}
    .berita-featured-img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
    .berita-featured-overlay{position:absolute;inset:0;background:linear-gradient(180deg,rgba(6,23,45,0) 28%,rgba(6,23,45,.34) 55%,rgba(6,23,45,.93) 100%)}
    .berita-featured-body{position:relative;z-index:2;padding:2.1rem;color:#fff;width:100%}
    .berita-featured-cat{display:inline-flex;align-items:center;gap:.4rem;font-size:.68rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:#fff;background:linear-gradient(135deg,var(--gold),var(--gold-dark));padding:.44rem 1rem;border-radius:99px;margin-bottom:1rem}
    .berita-featured-cat i{font-size:.7rem}
    .berita-featured-title{font-family:var(--font-display);font-weight:800;font-size:clamp(1.35rem,2.3vw,1.8rem);line-height:1.3;margin-bottom:.7rem;color:#fff;text-shadow:0 2px 18px rgba(0,0,0,.4)}
    .berita-featured-desc{font-size:.92rem;line-height:1.65;color:rgba(255,255,255,.88);max-width:56ch;margin-bottom:1.1rem}
    .berita-meta{display:flex;flex-wrap:wrap;gap:1.1rem;font-size:.78rem;color:rgba(255,255,255,.75);margin-bottom:1.1rem}
    .berita-meta i{color:var(--mint)}
    .berita-read{display:inline-flex;align-items:center;gap:.5rem;font-size:.82rem;font-weight:700;color:#fff;background:rgba(255,255,255,.14);border:1px solid rgba(255,255,255,.35);padding:.62rem 1.25rem;border-radius:99px;backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);transition:all .3s var(--ease)}
    .berita-read:hover{background:var(--gold);border-color:var(--gold);color:#0d3a66;transform:translateY(-2px)}
    .berita-feed{display:flex;flex-direction:column;gap:.9rem}
    .berita-feed-item{display:flex;gap:1rem;align-items:center;background:var(--card);border:1px solid var(--border);border-radius:18px;padding:.85rem;transition:all .3s var(--ease);cursor:pointer;position:relative;overflow:hidden}
    .berita-feed-item::before{content:"";position:absolute;left:0;top:0;bottom:0;width:4px;background:linear-gradient(180deg,var(--teal),var(--mint));opacity:0;transition:opacity .3s}
    .berita-feed-item:hover{transform:translateX(6px);border-color:var(--teal);box-shadow:var(--shadow)}
    .berita-feed-item:hover::before{opacity:1}
    .berita-feed-thumb{flex-shrink:0;width:116px;height:86px;border-radius:14px;object-fit:cover;box-shadow:0 4px 14px rgba(13,58,102,.18)}
    .berita-feed-cat{font-size:.64rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--teal)}
    .berita-feed-title{font-weight:700;font-size:.9rem;color:var(--ink);line-height:1.4;margin:.28rem 0 .35rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .berita-feed-date{font-size:.73rem;color:var(--text-muted);display:flex;align-items:center;gap:.35rem}
    .berita-feed-date i{color:var(--teal)}
    .berita-feed-arrow{margin-left:auto;align-self:center;color:var(--teal);font-size:.8rem;opacity:0;transform:translateX(-6px);transition:all .3s var(--ease)}
    .berita-feed-item:hover .berita-feed-arrow{opacity:1;transform:none}
    .berita-feed-empty{display:none;text-align:center;padding:2.4rem 1rem;color:var(--text-muted);font-size:.88rem;background:var(--card);border:1px dashed var(--border);border-radius:18px}
    .berita-more{margin-top:2.2rem}
    .berita-more-head{display:flex;align-items:center;gap:.8rem;margin-bottom:1.25rem}
    .berita-more-head::before{content:"";flex:1;height:1px;background:linear-gradient(90deg,transparent,var(--border))}
    .berita-more-head::after{content:"";flex:1;height:1px;background:linear-gradient(90deg,var(--border),transparent)}
    .berita-more-title{font-family:var(--font-display);font-size:.95rem;font-weight:700;color:var(--ink);letter-spacing:.06em;text-transform:uppercase;white-space:nowrap}
    .berita-more-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.3rem}
    .berita-card{background:var(--card);border:1px solid var(--border);border-radius:20px;overflow:hidden;transition:transform .35s var(--ease),box-shadow .35s;cursor:pointer;display:flex;flex-direction:column}
    .berita-card:hover{transform:translateY(-6px);box-shadow:var(--shadow-lg)}
    .berita-card-img{width:100%;height:158px;object-fit:cover;display:block}
    .berita-card-body{padding:1.05rem 1.15rem 1.2rem}
    .berita-card-cat{font-size:.64rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--gold-dark)}
    .berita-card-title{font-weight:700;font-size:.95rem;color:var(--ink);line-height:1.45;margin:.4rem 0 .5rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .berita-card-meta{font-size:.73rem;color:var(--text-muted);display:flex;align-items:center;gap:.4rem}
    .berita-card-meta i{color:var(--teal)}

    /* ---------- PPDB ---------- */
    .ppdb-section{position:relative;overflow:hidden;background:linear-gradient(160deg,#0d3a66,#13518c 55%,#0b2f57)}
    .ppdb-bg{position:absolute;inset:0;z-index:0;background-image:url('{{ asset('images/hero-sekolah.jpg') }}');background-size:cover;background-position:center;opacity:.10;filter:blur(2px) saturate(1.15)}
    .ppdb-pattern{position:absolute;inset:0;z-index:1;background-image:radial-gradient(rgba(255,255,255,.07) 1px,transparent 1px),linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);background-size:28px 28px,56px 56px,56px 56px;mask-image:radial-gradient(ellipse 75% 65% at 50% 42%,#000 25%,transparent 78%);-webkit-mask-image:radial-gradient(ellipse 75% 65% at 50% 42%,#000 25%,transparent 78%)}
    .ppdb-inner{position:relative;z-index:2;border-radius:30px;background:rgba(13,58,102,.42);border:1px solid rgba(255,255,255,.14);padding:3.6rem 3rem 3.2rem;color:#fff;box-shadow:var(--shadow-lg);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)}
    .ppdb-head .section-desc{color:rgba(255,255,255,.78);margin:0 auto}
    .ppdb-head .section-title{color:#fff}
    .ppdb-head .section-label{color:var(--mint)}
    .ppdb-status-badge{display:inline-flex;align-items:center;gap:.55rem;margin-top:1.15rem;padding:.5rem 1.1rem;border-radius:99px;font-size:.76rem;font-weight:800;letter-spacing:.09em;text-transform:uppercase}
    .ppdb-status-closed{color:#ffd9d9;background:rgba(231,76,60,.16);border:1px solid rgba(231,76,60,.5)}
    .ppdb-status-open{color:#d7f7e3;background:rgba(46,204,113,.16);border:1px solid rgba(46,204,113,.5)}
    .ppdb-status-dot{width:8px;height:8px;border-radius:50%;background:currentColor;animation:dotPulse 1.6s ease-in-out infinite}
    .ppdb-head-actions{display:flex;justify-content:center;align-items:center;gap:1rem;flex-wrap:wrap;margin-top:1.7rem}
    .ppdb-section .btn-primary{display:inline-flex;align-items:center;gap:.6rem;padding:.9rem 1.7rem;border-radius:14px;font-weight:700;font-size:.95rem;color:#5b3c00;background:linear-gradient(135deg,#f9a825,#f57c00);box-shadow:0 14px 34px rgba(249,168,37,.35);transition:all .3s var(--ease)}
    .ppdb-section .btn-primary:hover{transform:translateY(-3px);box-shadow:0 20px 44px rgba(249,168,37,.5)}
    .ppdb-section .btn-outline-white{display:inline-flex;align-items:center;gap:.6rem;padding:.9rem 1.7rem;border-radius:14px;font-weight:700;font-size:.95rem;color:#fff;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.35);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);transition:all .3s var(--ease)}
    .ppdb-section .btn-outline-white:hover{transform:translateY(-3px);background:rgba(255,255,255,.16);border-color:rgba(255,255,255,.6)}
    .ppdb-countdown{display:flex;justify-content:center;gap:.8rem;margin:1.9rem auto 0;flex-wrap:wrap}
    .countdown-item{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);border-radius:16px;padding:.9rem 1.2rem;min-width:82px;text-align:center;backdrop-filter:blur(8px);transition:all .3s var(--ease)}
    .countdown-item:hover{transform:translateY(-4px);background:rgba(40,169,225,.14)}
    .countdown-num{font-family:var(--font-display);font-size:1.9rem;color:var(--mint);line-height:1.1}
    .countdown-label{font-size:.68rem;color:rgba(255,255,255,.8);letter-spacing:.12em;text-transform:uppercase;margin-top:.3rem}

    /* ---------- PPDB JOURNEY ---------- */
    .ppdb-journey{position:relative;max-width:760px;margin:0 auto;padding:1.4rem 0 .5rem}
    .journey-line{position:absolute;left:29px;top:58px;bottom:66px;width:2px;background:linear-gradient(180deg,var(--teal-light),rgba(249,168,37,.85));opacity:.5}
    .journey-start{position:relative;z-index:2;display:inline-flex;align-items:center;gap:.5rem;margin-left:10px;padding:.42rem .95rem;border-radius:99px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.22);color:#cdeeff;font-size:.7rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase}
    .journey-start-dot{width:8px;height:8px;border-radius:50%;background:#2ecc71;animation:dotPulse 1.6s ease-in-out infinite}
    .journey-step{position:relative;z-index:2;display:flex;gap:1.25rem;align-items:flex-start;margin:1.05rem 0}
    .journey-node{flex-shrink:0;width:58px;height:58px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:1rem;color:#0d3a66;border:3px solid rgba(255,255,255,.25)}
    .journey-step.status-done .journey-node{background:linear-gradient(135deg,#2ecc71,#1fa55c);box-shadow:0 0 0 6px rgba(46,204,113,.16),0 10px 26px rgba(46,204,113,.35)}
    .journey-step.status-next .journey-node{background:linear-gradient(135deg,var(--mint),var(--teal-light));box-shadow:0 0 0 6px rgba(40,169,225,.18),0 10px 26px rgba(40,169,225,.4);animation:journeyPulse 2s ease-in-out infinite}
    .journey-step.status-wait .journey-node{background:linear-gradient(135deg,#f9a825,#f57c00);box-shadow:0 0 0 6px rgba(249,168,37,.16),0 10px 26px rgba(249,168,37,.35)}
    .journey-step.status-pending .journey-node{background:linear-gradient(135deg,#8a9bb0,#64748b);box-shadow:0 0 0 6px rgba(138,155,176,.14)}
    .journey-content{flex:1;padding:1.15rem 1.35rem;border-radius:18px;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.14);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);transition:transform .3s var(--ease),border-color .3s}
    .journey-step:hover .journey-content{transform:translateX(6px);border-color:rgba(255,255,255,.32)}
    .journey-step-top{margin-bottom:.35rem}
    .journey-status{display:inline-flex;align-items:center;gap:.4rem;padding:.28rem .7rem;border-radius:99px;font-size:.66rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase}
    .status-green{color:#8ff0b3;background:rgba(46,204,113,.15);border:1px solid rgba(46,204,113,.4)}
    .status-blue{color:#8fdcff;background:rgba(40,169,225,.15);border:1px solid rgba(40,169,225,.45)}
    .status-orange{color:#ffd08a;background:rgba(249,168,37,.15);border:1px solid rgba(249,168,37,.45)}
    .status-gray{color:#c3d0dd;background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.22)}
    .journey-step-title{font-weight:800;font-size:1.05rem;color:#fff;margin-bottom:.25rem}
    .journey-step-desc{font-size:.86rem;color:rgba(255,255,255,.75);line-height:1.6}
    .journey-welcome{position:relative;z-index:2;display:inline-flex;align-items:center;gap:.55rem;margin-top:.6rem;margin-left:10px;padding:.6rem 1.25rem;border-radius:99px;background:linear-gradient(135deg,#ffd54a,#f2b632);color:#5b3c00;font-weight:800;font-size:.86rem;box-shadow:0 12px 30px rgba(249,168,37,.35)}
    @keyframes journeyPulse{0%,100%{box-shadow:0 0 0 6px rgba(40,169,225,.18),0 10px 26px rgba(40,169,225,.4)}50%{box-shadow:0 0 0 12px rgba(40,169,225,.05),0 10px 30px rgba(40,169,225,.55)}}
    @keyframes dotPulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.45;transform:scale(.8)}}

    /* ---------- GALERI: EDITORIAL POLAROID ---------- */
    .galeri-filters{display:flex;flex-wrap:wrap;justify-content:center;gap:.6rem;margin:1.6rem auto 0;max-width:720px}
    .galeri-pill{padding:.5rem 1.15rem;border-radius:99px;font-size:.82rem;font-weight:700;letter-spacing:.03em;color:var(--ink);background:transparent;border:1.5px solid var(--border);cursor:pointer;transition:all .3s var(--ease)}
    .galeri-pill:hover{border-color:var(--teal);color:var(--teal-dark)}
    .galeri-pill.active{background:#1E5B92;border-color:#1E5B92;color:#fff;box-shadow:0 8px 20px rgba(30,91,146,.28)}
    .galeri-stage{position:relative;max-width:1200px;margin:3rem auto 0}
    .galeri-ghost{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-family:var(--font-display);font-size:clamp(6rem,16vw,13rem);line-height:1;letter-spacing:.06em;color:var(--teal-deep);opacity:.045;pointer-events:none;user-select:none;white-space:nowrap;z-index:0}
    .galeri-masonry{position:relative;z-index:1;display:grid;grid-template-columns:repeat(12,1fr);grid-auto-rows:auto;gap:26px}
    .gcard{position:relative;background:#fff;border-radius:12px;box-shadow:0 14px 34px rgba(13,58,102,.13);cursor:pointer;overflow:hidden;transform:rotate(0deg);transition:transform .3s var(--ease),box-shadow .3s var(--ease);outline:none;display:flex;flex-direction:column}
    .gcard-1{grid-column:1/8;grid-row:1/3;transform:rotate(-1deg)}
    .gcard-2{grid-column:8/13;transform:rotate(1deg)}
    .gcard-3{grid-column:8/13;transform:rotate(-.5deg)}
    .gcard-4{grid-column:1/7;transform:rotate(1deg)}
    .gcard-5{grid-column:7/13;transform:rotate(-.5deg)}
    .gcard-photo{position:relative;margin:8px 8px 0;border-radius:10px;overflow:hidden;background:#eef4fa;flex-shrink:0}
    .gcard-photo::after{content:"";display:block;padding-bottom:62.5%}
    .gcard-1 .gcard-photo::after{padding-bottom:100%}
    .gcard-5 .gcard-photo::after{padding-bottom:62.5%}
    .gcard-photo img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform .3s var(--ease)}
    .gcard:hover .gcard-photo img{transform:scale(1.03)}
    .gcard:hover{transform:translateY(-6px) rotate(0deg);box-shadow:0 26px 52px rgba(13,58,102,.24)}
    .gcard-num{position:absolute;top:12px;right:14px;font-size:.74rem;font-weight:300;letter-spacing:.22em;color:#fff;opacity:.95;text-shadow:0 1px 8px rgba(10,30,55,.55);z-index:3}
    .gcard-info{position:relative;background:#fff;padding:.95rem 1.1rem 1.05rem;display:flex;flex-direction:column;align-items:flex-start;gap:.28rem;flex:1}
    .gcard-badge{position:relative;z-index:2;margin-top:-1.55rem;margin-left:1.05rem;font-size:.6rem;font-weight:800;letter-spacing:.16em;text-transform:uppercase;color:#fff;padding:.32rem .8rem;border-radius:99px;box-shadow:0 6px 16px rgba(0,0,0,.16);align-self:flex-start}
    .gcard-badge.prestasi{background:#FF9D1C}
    .gcard-badge.akademik{background:#287CB8}
    .gcard-badge.kegiatan{background:#F26B21}
    .gcard-badge.ekskul{background:#1E5B92}
    .gcard-title{font-family:var(--font-display);font-size:1rem;line-height:1.3;color:var(--ink);letter-spacing:.02em;text-transform:uppercase;margin:0}
    .gcard-desc{font-size:.8rem;color:var(--text-muted);line-height:1.5;margin:0;max-width:44ch}
    .gcard-meta{font-size:.72rem;font-weight:600;color:#8ba3ba;display:inline-flex;align-items:center;gap:.4rem;margin-top:.15rem}
    .gcard-cta{display:inline-flex;align-items:center;gap:.5rem;margin-top:.5rem;font-size:.76rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--teal-dark);transition:color .3s var(--ease)}
    .gcard:hover .gcard-cta{color:#1d6fb8}
    .gcard-1 .gcard-title{font-size:1.22rem}
    .gcard-1 .gcard-desc{font-size:.9rem}
    .gcard-1 .gcard-meta{color:#5b7690}
    .gcard-1 .gcard-cta{color:#1d6fb8}
    .gcard-5 .gcard-title{font-size:1.05rem}
    .gcard-5 .gcard-desc{font-size:.85rem}
    .galeri-note{grid-column:1/7;align-self:center;display:flex;gap:1rem;align-items:flex-start;padding:1.4rem 1rem}
    .galeri-note i{font-size:1.6rem;color:var(--gold);opacity:.75;margin-top:.1rem}
    .galeri-note p{font-style:italic;color:var(--text-muted);font-size:.95rem;line-height:1.7;margin:0}
    .galeri-note strong{color:var(--gold-dark);font-style:normal}
    .galeri-footer{margin:3.2rem auto 0;text-align:center;max-width:640px}
    .galeri-divider{width:84px;height:2px;border-radius:99px;background:linear-gradient(90deg,var(--teal),var(--teal-light));margin:0 auto 1.1rem}
    .galeri-footer-text{font-size:.92rem;color:var(--text-muted);margin-bottom:1.2rem}
    .galeri-btn{display:inline-flex;align-items:center;gap:.6rem;padding:.85rem 1.7rem;border-radius:99px;font-size:.86rem;font-weight:800;letter-spacing:.06em;color:#fff;background:linear-gradient(135deg,#1d6fb8,#13518c);border:none;cursor:pointer;box-shadow:0 12px 28px rgba(29,111,184,.3);transition:all .3s var(--ease)}
    .galeri-btn:hover{transform:translateY(-3px);box-shadow:0 18px 38px rgba(29,111,184,.42)}
    /* ---------- LIGHTBOX ---------- */
    .galeri-lightbox{position:fixed;inset:0;z-index:999;display:none;align-items:center;justify-content:center;background:rgba(8,24,44,.92);backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);padding:2rem}
    .galeri-lightbox.open{display:flex;animation:fadeIn .25s var(--ease) both}
    .lb-stage{position:relative;max-width:min(880px,92vw);width:100%;margin:0;text-align:center}
    .lb-img{max-width:100%;max-height:72vh;border-radius:8px;box-shadow:0 30px 80px rgba(0,0,0,.5);background:#fff}
    .lb-cap{margin-top:1rem;color:#fff;display:flex;flex-direction:column;gap:.25rem;align-items:center}
    .lb-cat{font-size:.66rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase;padding:.3rem .8rem;border-radius:99px;color:#fff}
    .lb-cat.prestasi{background:#FF9D1C}
    .lb-cat.akademik{background:#287CB8}
    .lb-cat.kegiatan{background:#F26B21}
    .lb-cat.ekskul{background:#1E5B92}
    .lb-title{font-family:var(--font-display);font-size:1.05rem;letter-spacing:.03em}
    .lb-date{font-size:.78rem;font-weight:600;color:rgba(255,255,255,.7);display:inline-flex;align-items:center;gap:.4rem}
    .lb-nav{position:absolute;top:50%;transform:translateY(-50%);width:48px;height:48px;border-radius:50%;border:1px solid rgba(255,255,255,.25);background:rgba(255,255,255,.08);color:#fff;font-size:1rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .3s var(--ease);z-index:2}
    .lb-nav:hover{background:rgba(255,255,255,.2);border-color:rgba(255,255,255,.5)}
    .lb-prev{left:-64px}
    .lb-next{right:-64px}
    .lb-close{position:absolute;top:1.4rem;right:1.6rem;width:44px;height:44px;border-radius:50%;border:1px solid rgba(255,255,255,.25);background:rgba(255,255,255,.08);color:#fff;font-size:1rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .3s var(--ease);z-index:2}
    .lb-close:hover{background:rgba(255,255,255,.2);transform:rotate(90deg)}
    .lb-dots{position:absolute;bottom:1.2rem;left:50%;transform:translateX(-50%);display:flex;gap:.5rem;z-index:2}
    .lb-dot{width:9px;height:9px;border-radius:50%;background:rgba(255,255,255,.3);border:none;cursor:pointer;padding:0;transition:all .3s var(--ease)}
    .lb-dot.active{background:var(--gold);transform:scale(1.25)}
    @keyframes fadeIn{from{opacity:0}to{opacity:1}}

    /* ---------- EKSKUL: ACTIVITY HUB ---------- */
/* ---------- EKSKUL: ACTIVITY FEED (INSTAGRAM STYLE) ---------- */
    .feed-wrap{max-width:1200px;margin:0 auto}
    .feed-label{display:flex;align-items:center;gap:.8rem;justify-content:center;margin:2.6rem 0 .5rem;font-size:.72rem;font-weight:800;letter-spacing:.24em;text-transform:uppercase;color:var(--teal)}
    .feed-label::before,.feed-label::after{content:"";height:1px;width:64px;background:var(--border)}
    .feed-sub{text-align:center;color:var(--text-muted);font-size:.92rem;margin:0 0 2rem}
    .feed-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
    .feed-card{position:relative;perspective:1400px;height:100%}
    .feed-inner{position:relative;width:100%;height:100%;aspect-ratio:4/5;transform-style:preserve-3d;transition:transform .6s cubic-bezier(.4,.1,.2,1)}
    .feed-card.flipped .feed-inner{transform:rotateY(180deg)}
    .feed-face{position:absolute;inset:0;backface-visibility:hidden;-webkit-backface-visibility:hidden;border-radius:18px;overflow:hidden;background:var(--card);border:1px solid var(--border);box-shadow:0 10px 30px rgba(13,58,102,.08);transition:box-shadow .3s ease}
    .feed-front{display:flex;flex-direction:column}
    .feed-card:hover .feed-face{box-shadow:0 22px 46px rgba(13,58,102,.16)}
    .feed-back{transform:rotateY(180deg);display:flex;flex-direction:column;padding:1.05rem 1.15rem;overflow:hidden}
    .feed-post-head{display:flex;align-items:center;gap:.6rem;padding:.7rem .95rem .6rem}
    .feed-avatar{width:34px;height:34px;border-radius:50%;object-fit:cover;border:1.5px solid var(--border);flex-shrink:0;background:#eaf2f9}
    .feed-school{font-size:.8rem;font-weight:800;color:var(--ink);line-height:1.25;letter-spacing:.01em}
    .feed-sub2{font-size:.68rem;color:var(--text-muted);line-height:1.3}
    .feed-menu{margin-left:auto;font-size:1.05rem;color:var(--text-muted);line-height:1;cursor:default;letter-spacing:.1em}
    .feed-photo{position:relative;flex:1;min-height:0;overflow:hidden;background:#eaf2f9}
    .feed-photo img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform .3s ease}
    .feed-card:hover .feed-photo img{transform:scale(1.02)}
    .feed-actions{display:flex;align-items:center;gap:.95rem;padding:.55rem .95rem .2rem}
    .feed-ic{font-size:1.3rem;color:var(--ink);line-height:1;cursor:default}
    .feed-ic.heart{color:#f26b6b}.feed-ic.save{margin-left:auto}
    .feed-actions .fa-heart{font-size:1.45rem}.feed-actions .fa-comment{font-size:1.4rem}
    .feed-actions .fa-paper-plane{font-size:1.35rem}.feed-actions .fa-bookmark{font-size:1.35rem}
    .feed-menu.fa-ellipsis-vertical{font-size:1.15rem}
    .b-arrow.fa-arrow-left{font-size:.95rem}
    .feed-flip-hint .fa-rotate-right{font-size:.8rem}
    .feed-toggle-btn .fa-arrow-right{font-size:.8rem}
    .feed-caption{padding:.3rem .95rem .2rem;display:flex;flex-direction:column;gap:.22rem;flex:1}
    .feed-caption b{font-size:.78rem;color:var(--ink);font-weight:800}
    .feed-caption .fc-line{font-size:.74rem;color:var(--text-muted);line-height:1.5}
    .feed-tags{font-size:.7rem;color:var(--teal);font-weight:700;letter-spacing:.02em}
    .feed-likes{font-size:.72rem;color:var(--text-muted);padding:.25rem .95rem 0;line-height:1.4}.feed-likes b{color:var(--ink);font-weight:800}.feed-comments{font-size:.68rem;color:var(--text-muted);padding:.15rem .95rem 0;line-height:1.4}.feed-time{font-size:.6rem;letter-spacing:.08em;color:#9fb3c4;padding:.2rem .95rem .15rem;line-height:1.4}.feed-flip-hint{margin:.5rem .95rem .85rem;padding:.5rem;border:1px dashed var(--border);border-radius:10px;text-align:center;font-size:.62rem;font-weight:800;letter-spacing:.16em;color:var(--text-muted);cursor:pointer;transition:all .25s ease;background:#f8fbfe;text-transform:uppercase}
    .feed-card:hover .feed-flip-hint{border-color:var(--gold);color:var(--gold-dark)}
    .feed-back-top{display:flex;align-items:center;gap:.6rem;margin-bottom:.6rem}
    .feed-back-top .b-arrow{font-size:1rem;color:var(--teal)}
    .feed-back-top .b-name{font-family:var(--font-display);font-size:1.02rem;color:var(--ink);text-transform:uppercase;letter-spacing:.03em}
    .feed-back-top .b-num{margin-left:auto;font-size:.68rem;font-weight:800;color:var(--gold);letter-spacing:.12em}
    .feed-back-avatar{width:44px;height:44px;border-radius:50%;object-fit:cover;border:2px solid var(--teal);background:#eaf2f9;margin-bottom:.4rem}
    .feed-tagline{font-size:.64rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:var(--gold-dark);margin-bottom:.6rem}
    .feed-back .divider{height:1px;background:var(--border);margin:0 0 .6rem}
    .feed-back h5{font-size:.58rem;font-weight:800;letter-spacing:.16em;text-transform:uppercase;color:var(--teal);margin:0 0 .32rem}
    .feed-about{font-size:.74rem;color:var(--text-muted);line-height:1.5;margin:0 0 .6rem}
    .feed-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:.45rem;margin-bottom:.6rem}
    .feed-stat{background:#f2f8fd;border:1px solid var(--border);border-radius:10px;padding:.4rem .3rem;text-align:center}
    .feed-stat b{display:block;font-size:.8rem;color:var(--ink);line-height:1.2}
    .feed-stat span{font-size:.5rem;color:var(--text-muted);font-weight:700;letter-spacing:.05em;text-transform:uppercase}
    .feed-act{list-style:none;margin:0 0 .7rem;padding:0;display:flex;flex-direction:column;gap:.26rem}
    .feed-act li{font-size:.7rem;color:var(--text-muted);display:flex;gap:.4rem;align-items:flex-start;line-height:1.35}
    .feed-act li::before{content:"\25B8";color:var(--gold);font-weight:800}
    .feed-toggle{display:flex;justify-content:center;margin-top:2.1rem}
    .feed-toggle-btn{display:inline-flex;align-items:center;gap:.5rem;background:transparent;border:1.5px solid var(--teal-dark);color:var(--teal-dark);font-weight:800;font-size:.76rem;letter-spacing:.12em;text-transform:uppercase;padding:.7rem 1.6rem;border-radius:99px;cursor:pointer;transition:all .3s ease;font-family:var(--font-body)}
    .feed-toggle-btn:hover{background:var(--teal-dark);color:#fff;box-shadow:0 12px 26px rgba(19,81,140,.3)}
    .feed-extra{display:none}
    .feed-extra.show{display:grid}
    .feed-sec-divider{display:flex;align-items:center;gap:1.2rem;margin:3.2rem 0 .5rem}
    .feed-sec-divider::before,.feed-sec-divider::after{content:"";flex:1;height:1px;background:var(--border)}
    .feed-sec-divider span{font-size:.74rem;font-weight:800;letter-spacing:.24em;text-transform:uppercase;color:var(--teal)}
    @media(max-width:1024px){.feed-grid{grid-template-columns:repeat(2,1fr)}}
    @media(max-width:640px){.feed-grid{grid-template-columns:1fr}.feed-back{padding:1.05rem 1.1rem}.feed-flip-hint{margin:.45rem .85rem .75rem}}

    /* ---------- KONTAK : FIND US ---------- */
    .ft-wrap{max-width:1200px;margin:0 auto}
    .ft-head{text-align:center;margin-bottom:2.6rem}
    .ft-eyebrow{display:inline-flex;align-items:center;gap:.55rem;font-size:.78rem;font-weight:800;letter-spacing:.22em;text-transform:uppercase;color:var(--teal);margin-bottom:.9rem}
    .ft-eyebrow::before,.ft-eyebrow::after{content:"";width:22px;height:2px;border-radius:99px;background:linear-gradient(90deg,var(--gold),var(--gold-dark))}
    .ft-title{font-family:var(--font-display);font-size:clamp(1.7rem,3.4vw,2.5rem);color:var(--ink);line-height:1.2;margin-bottom:.6rem}
    .ft-title .ft-gold{background:linear-gradient(100deg,var(--gold),var(--gold-dark));-webkit-background-clip:text;background-clip:text;color:transparent}
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

    /* ---------- FOOTER (School Signature) ---------- */
    .footer-main{background:#092C4C;color:#fff;padding:72px 0 0;position:relative;overflow:hidden}
    .footer-main::before{content:"";position:absolute;width:520px;height:520px;border-radius:50%;background:radial-gradient(circle,rgba(40,169,225,.07),transparent 65%);top:-200px;right:-140px;pointer-events:none}
    .footer-main::after{content:"";position:absolute;width:380px;height:380px;border-radius:50%;background:radial-gradient(circle,rgba(245,158,11,.05),transparent 65%);bottom:-160px;left:-120px;pointer-events:none}
    .footer-accent{width:72px;height:4px;border-radius:99px;background:linear-gradient(90deg,#F59E0B,#fbbf24);margin-bottom:2.2rem}
    .footer-statement{text-align:center}
    .footer-sig-name{font-family:var(--font-display);font-size:clamp(2.4rem,6vw,4.2rem);line-height:1.06;letter-spacing:.01em;color:#fff;text-transform:uppercase}
    .footer-sig-name .num-2{color:#F59E0B;font-size:1.16em}
    .footer-sig-sub{font-size:1rem;font-weight:600;letter-spacing:.06em;color:rgba(255,255,255,.92);margin-top:.9rem;text-transform:uppercase}
    .footer-sig-tagline{font-size:.92rem;line-height:1.7;color:rgba(255,255,255,.65);max-width:560px;margin:.7rem auto 0}
    .footer-divider{height:1px;background:rgba(255,255,255,.12);margin:2.6rem auto;max-width:960px}
    .footer-nav{display:flex;flex-wrap:wrap;justify-content:center;align-items:flex-start;gap:2.2rem 3.2rem}
    .footer-nav-group{text-align:left}
    .footer-nav-group-title{font-size:.7rem;font-weight:800;letter-spacing:.22em;text-transform:uppercase;color:#F59E0B;margin-bottom:.8rem}
    .footer-nav-links{display:flex;flex-wrap:wrap;gap:.45rem 1.1rem}
    .footer-nav-links a{font-size:.9rem;color:rgba(255,255,255,.8);transition:color .25s}
    .footer-nav-links a:hover{color:#F59E0B}
    .footer-nav-links a::after{content:"";display:inline-block;width:3px;height:3px;border-radius:50%;background:rgba(255,255,255,.35);margin:0 0 .18rem .55rem}
    .footer-nav-links a:last-child::after{display:none}
    .footer-social{display:flex;flex-direction:column;align-items:center;gap:1rem;padding:2.6rem 0 0}
    .footer-social-label{font-size:.7rem;font-weight:800;letter-spacing:.28em;text-transform:uppercase;color:rgba(255,255,255,.55)}
    .footer-social-row{display:flex;gap:.9rem}
    .footer-social-row a{width:44px;height:44px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,.22);color:rgba(255,255,255,.85);font-size:1.05rem;transition:all .3s}
    .footer-social-row a:hover{background:#F59E0B;border-color:#F59E0B;color:#092C4C;transform:translateY(-3px)}
    .footer-bottom{border-top:1px solid rgba(255,255,255,.12);background:rgba(0,0,0,.18);color:rgba(255,255,255,.55);font-size:.8rem;padding:1.15rem 0;margin-top:3.2rem}
    .footer-bottom-inner{display:flex;justify-content:space-between;align-items:center;gap:1rem;flex-wrap:wrap}
    .footer-copy{display:flex;align-items:center;gap:.8rem;flex-wrap:wrap}
    .footer-copy-sign{font-style:italic;color:rgba(255,255,255,.72)}
    .footer-legal{display:flex;gap:1.2rem;flex-wrap:wrap}
    .footer-legal a{color:rgba(255,255,255,.6);transition:color .25s}
    .footer-legal a:hover{color:#F59E0B}

    /* ---------- SIBOT ---------- */
    .sibot-fab{position:fixed;right:22px;bottom:22px;z-index:900}
    .sibot-toggle{width:58px;height:58px;border-radius:50%;border:0;color:#0d3a66;font-size:1.3rem;background:linear-gradient(135deg,var(--mint),var(--teal-light));box-shadow:0 14px 34px rgba(29,111,184,.5);position:relative;transition:all .3s var(--ease);animation:pulseRing 2.4s infinite}
    .sibot-toggle:hover{transform:scale(1.1) rotate(8deg)}
    .sibot-badge{position:absolute;top:-3px;right:-3px;width:22px;height:22px;border-radius:50%;background:var(--gold);color:#4a2c00;font-size:.7rem;font-weight:800;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 10px rgba(0,0,0,.3)}
    .sibot-window{
      position:absolute;bottom:74px;right:0;width:340px;max-width:calc(100vw - 44px);border-radius:22px;overflow:hidden;
      background:var(--card);box-shadow:0 30px 80px rgba(0,0,0,.35);border:1px solid var(--border);
      opacity:0;visibility:hidden;transform:translateY(18px) scale(.96);transform-origin:bottom right;
      transition:all .35s var(--ease);
    }
    .sibot-window.open{opacity:1;visibility:visible;transform:none}
    .sibot-header{display:flex;align-items:center;gap:.8rem;padding:1rem 1.1rem;color:#fff;background:linear-gradient(135deg,var(--teal-dark),var(--teal));position:relative;overflow:hidden}
    .sibot-header::after{content:"";position:absolute;width:120px;height:120px;border:1.4px dashed rgba(40,169,225,.3);border-radius:50%;top:-50px;right:-40px}
    .sibot-avatar{width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,.16);font-size:1.05rem}
    .sibot-name{font-weight:800;font-size:.9rem}
    .sibot-status{font-size:.7rem;color:var(--mint);display:flex;align-items:center;gap:.35rem}
    .sibot-status::before{content:"";width:7px;height:7px;border-radius:50%;background:#4ade80;box-shadow:0 0 8px #4ade80}
    .sibot-close{margin-left:auto;cursor:pointer;opacity:.8;transition:all .2s}
    .sibot-close:hover{opacity:1;transform:rotate(90deg)}
    .sibot-messages{height:260px;overflow-y:auto;padding:1rem;display:flex;flex-direction:column;gap:.8rem;background:var(--bg)}
    .msg{display:flex;gap:.6rem;max-width:88%}
    .msg-user{margin-left:auto;flex-direction:row-reverse}
    .msg-avatar{flex-shrink:0;width:30px;height:30px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:.78rem;color:#0d3a66;background:linear-gradient(135deg,var(--mint),var(--teal-light))}
    .msg-user .msg-avatar{background:linear-gradient(135deg,#28a9e1,#1d6fb8);color:#fff}
    .msg-bubble{padding:.6rem .9rem;border-radius:14px 14px 14px 4px;font-size:.82rem;background:#fff;border:1px solid var(--border);box-shadow:0 4px 12px rgba(29,111,184,.08);line-height:1.55}
    .msg-user .msg-bubble{border-radius:14px 14px 4px 14px;background:linear-gradient(135deg,var(--teal),var(--teal-light));color:#fff;border:0}
    .msg-time{font-size:.62rem;color:var(--text-muted);margin-top:.25rem}
    .typing-indicator{display:flex;gap:4px;padding:.2rem 0}
    .typing-dot{width:7px;height:7px;border-radius:50%;background:var(--teal);animation:typing 1.2s infinite}
    .typing-dot:nth-child(2){animation-delay:.15s}
    .typing-dot:nth-child(3){animation-delay:.3s}
    @keyframes typing{0%,60%,100%{transform:translateY(0);opacity:.4}30%{transform:translateY(-5px);opacity:1}}
    .sibot-quick{display:flex;gap:.45rem;padding:.7rem .9rem;flex-wrap:wrap;border-top:1px solid var(--border);background:#fff}
    .quick-btn{font-size:.7rem;font-weight:700;border:1px solid var(--border);background:var(--bg);color:var(--text);border-radius:99px;padding:.4rem .75rem;transition:all .25s}
    .quick-btn i{color:var(--teal);margin-right:.25rem}
    .quick-btn:hover{border-color:var(--teal);color:var(--teal);transform:translateY(-2px)}
    .sibot-input-row{display:flex;gap:.5rem;padding:.85rem;background:#fff;border-top:1px solid var(--border)}
    .sibot-input{flex:1;border:1px solid var(--border);border-radius:12px;padding:.6rem .9rem;font-size:.84rem;font-family:inherit;outline:none;background:var(--bg);transition:border-color .25s}
    .sibot-input:focus{border-color:var(--teal)}
    .sibot-send{width:42px;height:42px;border-radius:12px;border:0;color:#0d3a66;background:linear-gradient(135deg,var(--mint),var(--teal-light));font-size:.95rem;transition:all .25s}
    .sibot-send:hover{transform:scale(1.08)}

    /* ---------- A11Y WIDGET ---------- */
    .a11y-widget{position:fixed;left:22px;bottom:22px;z-index:900}
    .a11y-toggle{width:58px;height:58px;border-radius:50%;border:0;color:#fff;font-size:1.25rem;background:linear-gradient(135deg,var(--teal-dark),var(--teal));box-shadow:0 14px 34px rgba(29,111,184,.45);transition:all .3s var(--ease)}
    .a11y-toggle:hover{transform:scale(1.1) rotate(-8deg)}
    .a11y-panel{
      position:absolute;bottom:74px;left:0;width:300px;max-width:calc(100vw - 44px);border-radius:20px;padding:1.3rem;
      background:var(--card);box-shadow:0 30px 80px rgba(0,0,0,.35);border:1px solid var(--border);
      opacity:0;visibility:hidden;transform:translateY(18px) scale(.96);transform-origin:bottom left;transition:all .35s var(--ease);
    }
    .a11y-panel.open{opacity:1;visibility:visible;transform:none}
    .a11y-panel-title{font-weight:800;font-size:.95rem;color:var(--ink);display:flex;align-items:center;gap:.5rem;margin-bottom:1.1rem}
    .a11y-panel-title i{color:var(--teal)}
    .a11y-group{margin-bottom:1.1rem}
    .a11y-group-label{font-size:.74rem;font-weight:700;color:var(--text-muted);margin-bottom:.5rem;display:flex;align-items:center;gap:.4rem}
    .a11y-group-label i{color:var(--teal)}
    .a11y-btn-row{display:flex;gap:.4rem}
    .a11y-btn{flex:1;border:1px solid var(--border);background:var(--bg);color:var(--text);font-size:.78rem;font-weight:700;padding:.5rem;border-radius:9px;transition:all .25s}
    .a11y-btn.active{background:var(--teal);color:#fff;border-color:var(--teal)}
    .a11y-toggle-row{display:flex;justify-content:space-between;align-items:center}
    .a11y-toggle-label{font-size:.82rem;color:var(--text)}
    .a11y-switch{position:relative;width:46px;height:26px;display:inline-block}
    .a11y-switch input{opacity:0;width:0;height:0}
    .a11y-slider{position:absolute;inset:0;border-radius:99px;background:var(--border);transition:all .3s;cursor:pointer}
    .a11y-slider::before{content:"";position:absolute;width:20px;height:20px;border-radius:50%;background:#fff;top:3px;left:3px;transition:all .3s;box-shadow:0 2px 6px rgba(0,0,0,.25)}
    .a11y-switch input:checked + .a11y-slider{background:var(--teal)}
    .a11y-switch input:checked + .a11y-slider::before{transform:translateX(20px)}
    .a11y-reset{width:100%;border:1px solid var(--border);background:var(--bg);color:var(--text-muted);font-size:.78rem;font-weight:700;padding:.6rem;border-radius:9px;transition:all .25s}
    .a11y-reset:hover{color:#fff;background:var(--gold);border-color:var(--gold)}

    /* ---------- BACK TO TOP ---------- */
    #backToTop{position:fixed;right:26px;bottom:96px;z-index:800;width:48px;height:48px;border-radius:14px;border:0;color:#0d3a66;font-size:1rem;background:linear-gradient(135deg,var(--mint),var(--teal-light));box-shadow:0 12px 28px rgba(29,111,184,.45);opacity:0;visibility:hidden;transform:translateY(16px);transition:all .35s var(--ease)}
    #backToTop.show{opacity:1;visibility:visible;transform:none}
    #backToTop:hover{transform:translateY(-4px)}

    /* ---------- RESPONSIVE ---------- */
    @media(max-width:1024px){
      .berita-mag{grid-template-columns:1fr}
      .berita-featured{min-height:460px}
      .berita-more-grid{grid-template-columns:repeat(3,1fr)}
      .book3d{aspect-ratio:1.95/1;min-height:400px}
      .flipbook-stage{gap:.7rem}
      .feed-grid{grid-template-columns:repeat(2,1fr)}
      .footer-nav{gap:1.8rem 2.2rem}
      .footer-nav-group{width:100%;text-align:center}
      .footer-nav-links{justify-content:center}
    }
    @media(max-width:900px){
      .section-py{padding:72px 0}
      .nav-menu{
        position:fixed;top:0;right:-320px;width:300px;height:100vh;flex-direction:column;align-items:flex-start;gap:.3rem;
        background:rgba(13,58,102,.96);padding:4.6rem 1.4rem 2rem;box-shadow:-20px 0 60px rgba(0,0,0,.45);transition:right .45s var(--ease);overflow-y:auto;backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);
      }
      .nav-menu.open{right:0}
      .nav-toggle{display:flex}
      .nav-item{width:100%}
      .nav-link{width:100%;justify-content:flex-start}
      .dropdown-menu{position:static;opacity:1;visibility:visible;transform:none;box-shadow:none;border:0;background:rgba(29,111,184,.05);margin-top:.3rem;display:none;min-width:0}
      .nav-item.dropdown-open .dropdown-menu{display:block}
      .hero-stats-inner{grid-template-columns:repeat(2,1fr)}
      .galeri-masonry{grid-template-columns:repeat(6,1fr);gap:22px}
      .gcard-1{grid-column:1/7;grid-row:auto}
      .gcard-2{grid-column:1/4}
      .gcard-3{grid-column:4/7}
      .gcard-4{grid-column:1/4}
      .gcard-5{grid-column:4/7}
      .galeri-note{grid-column:1/7;text-align:center;justify-content:center;flex-direction:column;align-items:center}
      .gcard-1 .gcard-photo::after{padding-bottom:78%}
      .gcard-5 .gcard-photo::after{padding-bottom:78%}
      .journey-name{min-height:0}
    }
    @media(max-width:600px){
      .section-py{padding:60px 0}
      .hero-headline{font-size:2.35rem}
      .berita-more-grid{grid-template-columns:1fr}
      .berita-featured{min-height:380px}
      .berita-featured-body{padding:1.4rem}
      .berita-feed-thumb{width:96px;height:74px}
      .hero-stats-inner{padding:1rem}
      .ppdb-inner{padding:2rem 1.4rem}
      .ppdb-journey{padding:.9rem 0 .2rem}
      .journey-line{left:24px}
      .journey-node{width:50px;height:50px;font-size:.88rem}
      .journey-step{gap:1rem;margin:.9rem 0}
      .journey-content{padding:1rem 1.1rem}
      .journey-step-desc{font-size:.82rem}
      .countdown-item{min-width:68px;padding:.7rem .8rem}
      .countdown-num{font-size:1.5rem}
      .feed-grid{grid-template-columns:1fr}
      .galeri-masonry{grid-template-columns:1fr;gap:20px;max-width:480px;margin:0 auto}
      .gcard-1,.gcard-2,.gcard-3,.gcard-4,.gcard-5{grid-column:1}
      .galeri-note{grid-column:1}
      .gcard-1 .gcard-photo::after{padding-bottom:100%}
      .gcard-5 .gcard-photo::after{padding-bottom:78%}
      .lb-nav.lb-prev{left:-10px}
      .lb-nav.lb-next{right:-10px}
      .galeri-lightbox{padding:1rem}
      .footer-nav{gap:1.5rem}
      .footer-bottom-inner{justify-content:center;text-align:center}
      .footer-copy{justify-content:center}
      .footer-legal{justify-content:center}
      .hero-stat-label{font-size:.68rem}
      .window-section,.roadmap-preview-section{padding:72px 0}
      .carousel-stage{height:560px;gap:1.4rem;padding-top:100px}
      .carousel-card{width:270px;height:540px}
      .carousel-card.active{width:360px;height:540px}
      .cc-photo{height:320px}
      .cc-photo img{max-height:398px}
    }

    @media(max-width:900px){
      .carousel-stage{height:540px;gap:1rem;padding-top:92px}
      .carousel-card{width:270px;height:520px}
      .carousel-card.active{width:340px;height:520px}
      .carousel-card.next{display:none}
      .cc-photo{height:310px}
      .cc-photo img{max-height:388px}
    }
    @media(max-width:640px){
      .carousel-stage{height:540px;padding-top:88px}
      .carousel-card{width:300px;height:540px}
      .carousel-card.prev,.carousel-card.next{display:none}
      .carousel-card.active{width:300px;height:540px;transform:none}
      .cc-photo{height:330px}
      .cc-photo img{max-height:408px}
    }
    @media(max-width:400px){
      .carousel-stage{height:520px;padding-top:84px}
      .carousel-card,.carousel-card.active{width:280px;height:520px}
      .cc-photo{height:320px}
      .cc-photo img{max-height:398px}
    }
    @media(min-width:641px) and (max-width:1024px){
      .carousel-stage{height:560px;gap:1.2rem;padding-top:100px}
      .carousel-card{width:280px;height:540px}
      .carousel-card.active{width:360px;height:540px}
      .carousel-card.next{display:none}
      .cc-photo{height:325px}
      .cc-photo img{max-height:403px}
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
  /* v35-spacing-final */</style>
</head>
<body>

<!-- ================= GLOBAL HERO BACKGROUND (foto gedung sampai ke atas) ================= -->
<div class="page-hero-bg" aria-hidden="true"></div>

<!-- ================= PRELOADER ================= -->
<div id="preloader">
  <div class="preloader-logo"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMK Negeri 2 Mojokerto" /></div>
  <div class="preloader-bar"><span></span></div>
  <div class="preloader-text">SMK Negeri <em class="num-2">2</em> Mojokerto</div>
</div>

<!-- ================= ANIMATED BG FX ================= -->
<div class="bg-fx" aria-hidden="true">
  <div class="bg-blob bg-blob-1"></div>
  <div class="bg-blob bg-blob-2"></div>
  <div class="bg-blob bg-blob-3"></div>
</div>

<!-- ================= CURSOR GLOW ================= -->
<div id="cursorGlow" aria-hidden="true"></div>

<!-- ================= ANNOUNCEMENT BAR ================= -->
<div class="announce-bar">
  <div class="container">
    <div class="announce-ticker" id="announceTicker">
      <div class="announce-item"><i class="fas fa-bullhorn"></i> PPDB 2025/2026 Dibuka — Daftar Sekarang!</div>
      <div class="announce-item"><i class="fas fa-trophy"></i> Juara 1 LKS Provinsi Jawa Timur 2024 — Selamat!</div>
      <div class="announce-item"><i class="fas fa-calendar"></i> Ujian Akhir Semester: 10–20 Juni 2025</div>
      <div class="announce-item"><i class="fas fa-star"></i> Akreditasi A — SMK Negeri 2 Mojokerto</div>
      <div class="announce-item"><i class="fas fa-bullhorn"></i> PPDB 2025/2026 Dibuka — Daftar Sekarang!</div>
      <div class="announce-item"><i class="fas fa-trophy"></i> Juara 1 LKS Provinsi Jawa Timur 2024 — Selamat!</div>
      <div class="announce-item"><i class="fas fa-calendar"></i> Ujian Akhir Semester: 10–20 Juni 2025</div>
      <div class="announce-item"><i class="fas fa-star"></i> Akreditasi A — SMK Negeri 2 Mojokerto</div>
    </div>
  </div>
</div>

<!-- ================= FLOATING PILL NAVBAR ================= -->
<nav id="navbar">
  <div class="nav-inner">
    <a href="index.html" class="nav-brand">
      <div class="nav-logo"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMK Negeri 2 Mojokerto" /></div>
      <div class="nav-brand-text">
        <strong>SMK Negeri <em class="num-2">2</em></strong>
        <span>Kota Mojokerto</span>
      </div>
    </a>
    <ul class="nav-menu" id="navMenu">
      <li class="nav-item"><a href="index.html" class="nav-link active">Beranda</a></li>
      <li class="nav-item">
        <a href="#" class="nav-link">Profil <i class="fas fa-chevron-down"></i></a>
        <div class="dropdown-menu">
          <a href="#"><i class="fas fa-history"></i> Sejarah Sekolah</a>
          <a href="#"><i class="fas fa-eye"></i> Visi &amp; Misi</a>
          <a href="#"><i class="fas fa-sitemap"></i> Struktur Organisasi</a>
          <a href="#"><i class="fas fa-certificate"></i> Akreditasi</a>
          <a href="guru.html"><i class="fas fa-chalkboard-user"></i> Guru &amp; Staf</a>
          <a href="school-roadmap.html"><i class="fas fa-road"></i> Roadmap Pengembangan</a>
        </div>
      </li>
      <li class="nav-item"><a href="career-roadmap.html" class="nav-link">Program Keahlian</a></li>
      <li class="nav-item"><a href="#ppdb" class="nav-link">PPDB</a></li>
      <li class="nav-item"><a href="#berita" class="nav-link">Berita</a></li>
      <li class="nav-item"><a href="#galeri" class="nav-link">Galeri</a></li>
      <li class="nav-item"><a href="karya-siswa.html" class="nav-link">Karya Siswa</a></li>
      <li class="nav-item"><a href="pkl-tracer.html" class="nav-link">PKL &amp; Alumni</a></li>
      <li class="nav-item"><a href="#ppdb" class="nav-link nav-cta">Daftar PPDB</a></li>
    </ul>
    <button class="nav-toggle" id="navToggle" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- ================= HERO SECTION ================= -->
<section class="hero" id="beranda">
  <!-- Intro video: tampil dulu di atas konten hero -->
  <div class="hero-intro-layer" id="heroIntroLayer">
    <video class="intro-video" id="introVideo" autoplay muted playsinline preload="auto">
      <source src="{{ asset('intro-video.mp4') }}" type="video/mp4">
    </video>
    <button class="intro-skip-btn" id="introSkipBtn" type="button">
      <span>Lewati Intro</span>
      <i class="fas fa-forward"></i>
    </button>
  </div>

  <!-- Background layers -->
  <div class="hero-bg"></div>
  <div class="hero-grid"></div>
  <div class="hero-orb hero-orb-1"></div>
  <div class="hero-orb hero-orb-2"></div>
  <div class="hero-orb hero-orb-3"></div>

  <!-- Concentric dashed circles -->
  <div class="hero-circles">
    <div class="hero-circle"></div>
    <div class="hero-circle"></div>
    <div class="hero-circle"></div>
    <div class="hero-circle"></div>
    <div class="hero-circle"></div>
  </div>

  <!-- Canvas particles -->
  <canvas id="heroCanvas" aria-hidden="true"></canvas>

  <!-- Main hero content -->
  <div class="hero-main">
    <div class="hero-content-wrap">
      <div class="hero-eyebrow">
        <span class="dot"></span>
        Disiplin, Berprestasi
      </div>
      <h1 class="hero-headline">
        <span class="line">
          <span class="word" style="animation-delay:0.1s">SMK</span>&nbsp;<span class="word" style="animation-delay:0.2s">Negeri</span>&nbsp;<span class="word highlight" style="animation-delay:0.3s">2</span>
        </span>
        <span class="line">
          <span class="word" style="animation-delay:0.4s">Mojokerto</span>
        </span>
      </h1>
      <p class="hero-desc">
        SMKN Unggulan Kota Mojokerto &mdash; membekali generasi muda dengan kompetensi teknis, kreativitas, dan karakter unggul untuk siap kerja, kuliah, dan berwirausaha.
      </p>
      <div class="hero-badges">
        <div class="hero-badge-pill"><i class="fas fa-certificate"></i> Akreditasi A</div>
        <div class="hero-badge-pill"><i class="fas fa-award"></i> Terakreditasi Unggul</div>
        <div class="hero-badge-pill"><i class="fas fa-industry"></i> 80+ Mitra Industri</div>
      </div>
      <div class="hero-btns">
        <a href="#ppdb" class="btn-hero-primary">
          <i class="fas fa-rocket"></i>
          <span>Daftar Sekarang</span>
        </a>
        <a href="career-roadmap.html" class="btn-hero-glass">
          <div class="play-icon"><i class="fas fa-play"></i></div>
          Pelajari Lebih Lanjut
        </a>
      </div>
    </div>
  </div>

  <!-- Stats bar -->
  <div class="hero-stats-bar">
    <div class="hero-stats-inner">
      <div class="hero-stat-item">
        <div class="hero-stat-num" data-count="1200">0<span>+</span></div>
        <div class="hero-stat-label">Siswa Aktif</div>
      </div>
      <div class="hero-stat-item">
        <div class="hero-stat-num" data-count="5">0</div>
        <div class="hero-stat-label">Program Keahlian</div>
      </div>
      <div class="hero-stat-item">
        <div class="hero-stat-num" data-count="95">0<span>%</span></div>
        <div class="hero-stat-label">Lulusan Terserap</div>
      </div>
      <div class="hero-stat-item">
        <div class="hero-stat-num" data-count="80">0<span>+</span></div>
        <div class="hero-stat-label">Mitra Industri</div>
      </div>
    </div>
  </div>

  <!-- Wave divider -->
  <div class="wave-divider" aria-hidden="true">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none"><path fill="#f5f9fd" d="M0,40 C240,80 480,0 720,24 C960,48 1200,72 1440,32 L1440,70 L0,70 Z"></path></svg>
  </div>
</section>

