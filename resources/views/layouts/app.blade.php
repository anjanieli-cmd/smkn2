{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="{{ asset('images/logo_smkn2.png') }}">
  <title>@yield('title', 'SMK Negeri 2 Mojokerto — Beranda')</title>
  <meta name="description" content="@yield('description', 'Website resmi SMK Negeri 2 Mojokerto — Sekolah Menengah Kejuruan unggulan di Kota Mojokerto, Jawa Timur.')" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  {{-- CSS GLOBAL --}}
  <style>
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
    body.a11y-high-contrast{--bg:#000;--text:#fff;--text-muted:#ffd;--card:#111;--border:#444}
    body.a11y-dark-mode{--bg:#0d3a66;--text:#d9f2ef;--text-muted:#8fb8b5;--card:#13518c;--border:#0d3a66}
    body.a11y-dark-mode .section-desc{color:#8fb8b5}
    ::selection{background:var(--teal);color:#fff}
    img{max-width:100%;display:block}
    a{text-decoration:none;color:inherit}
    button{font-family:inherit;cursor:pointer}
    .container{width:min(1180px,92%);margin:0 auto}
    .section-py{padding:96px 0}

    #preloader{
      position:fixed;inset:0;z-index:9999;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:22px;
      background:radial-gradient(1200px 600px at 50% 40%,#1d6fb8,#13518c 60%,#0d3a66);
      transition:opacity .7s ease,visibility .7s ease;
    }
    #preloader.done{opacity:0;visibility:hidden;pointer-events:none}
    .preloader-logo{width:92px;height:92px;border-radius:24px;display:flex;align-items:center;justify-content:center;background:transparent;padding:0;box-shadow:0 0 0 0 rgba(40,169,225,.5);animation:pulse-ring 1.6s infinite}
    .preloader-logo img{width:100%;height:100%;object-fit:contain;display:block}
    @keyframes pulse-ring{0%{box-shadow:0 0 0 0 rgba(40,169,225,.55)}70%{box-shadow:0 0 0 26px rgba(40,169,225,0)}100%{box-shadow:0 0 0 0 rgba(40,169,225,0)}}
    .preloader-text{color:var(--mint-soft);font-weight:600;letter-spacing:.35em;text-transform:uppercase;font-size:.75rem;animation:blink 1.2s infinite}
    @keyframes blink{50%{opacity:.35}}
    .preloader-bar{width:200px;height:5px;border-radius:99px;background:rgba(255,255,255,.14);overflow:hidden}
    .preloader-bar span{display:block;height:100%;width:40%;border-radius:99px;background:linear-gradient(90deg,var(--mint),#fff);animation:loadslide 1.1s ease-in-out infinite}
    @keyframes loadslide{0%{transform:translateX(-110%)}100%{transform:translateX(510%)}}

    .bg-fx{position:fixed;inset:0;z-index:-2;overflow:hidden;pointer-events:none}
    .bg-blob{position:absolute;border-radius:50%;filter:blur(90px);opacity:.5;animation:blobFloat 22s ease-in-out infinite}
    .bg-blob-1{width:520px;height:520px;background:var(--teal-glow);top:-140px;left:-120px}
    .bg-blob-2{width:460px;height:460px;background:var(--mint-glow);top:32%;right:-160px;animation-delay:-7s}
    .bg-blob-3{width:420px;height:420px;background:rgba(29,111,184,.4);bottom:-140px;left:30%;animation-delay:-14s}
    @keyframes blobFloat{0%,100%{transform:translate(0,0) scale(1)}33%{transform:translate(60px,-40px) scale(1.12)}66%{transform:translate(-40px,50px) scale(.94)}}

    #cursorGlow{
      position:fixed;width:440px;height:440px;border-radius:50%;pointer-events:none;z-index:1;
      background:radial-gradient(circle,rgba(29,111,184,.14),rgba(40,169,225,.05) 45%,transparent 70%);
      transform:translate(-50%,-50%);left:0;top:0;mix-blend-mode:screen;display:none;
    }
    @media(pointer:fine){#cursorGlow{display:block}}

    .announce-bar {
      background: linear-gradient(90deg, #0d3a66, #1d6fb8, #0d3a66);
      color: #fff;font-size: .8rem;position: relative;z-index: 60;overflow: hidden;
      backdrop-filter: blur(8px);-webkit-backdrop-filter: blur(8px);
      border-bottom: 1px solid rgba(255,255,255,.12);
      text-shadow:0 1px 3px rgba(0,0,0,.35);width:100%;
    }
    .announce-bar .container{width:100%;max-width:100%;padding:0 2rem;margin:0}
    .announce-ticker{display:flex;gap:3rem;white-space:nowrap;padding:.45rem 0;animation:ticker 26s linear infinite;width:max-content}
    .announce-ticker:hover{animation-play-state:paused}
    @keyframes ticker{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
    .announce-item{display:flex;align-items:center;gap:.5rem;font-weight:500}
    .announce-item i{color:var(--gold);animation:tada 3s infinite}

    /* ============================================================
       NAVBAR — SEMUA LINK BOLD & FONT SAMA DENGAN "DISIPLIN, BERPRESTASI"
       ============================================================ */
    #navbar{position:sticky;top:0;left:0;z-index:100;width:100%;margin:0;padding:0;transition:all .4s var(--ease);background:transparent}
    #navbar.scrolled{top:0}
    .nav-inner{display:flex;align-items:center;justify-content:space-between;gap:1rem;padding:.95rem 2rem;border-radius:0;background:linear-gradient(135deg,#0d3a66,#1d6fb8);backdrop-filter:blur(18px) saturate(160%);-webkit-backdrop-filter:blur(18px) saturate(160%);border:0;border-bottom:1px solid rgba(255,255,255,.18);box-shadow:0 10px 34px rgba(13,58,102,.35),inset 0 1px 0 rgba(255,255,255,.25);transition:all .4s var(--ease);width:100%;max-width:100%;margin:0}
    #navbar.scrolled .nav-inner{background:linear-gradient(135deg,#0a2f57,#13518c);box-shadow:0 14px 44px rgba(13,58,102,.5);padding:.8rem 2rem;border-radius:0;border:0;border-bottom:1px solid rgba(255,255,255,.12)}
    #navbar::after{content:"";position:absolute;bottom:-1px;left:0;right:0;height:1px;background:rgba(255,255,255,.06);opacity:.4;pointer-events:none}
    .nav-inner > *{position:relative;z-index:1}
    .nav-brand{display:flex;align-items:center;gap:.7rem;flex-shrink:0}
    .nav-logo{background:transparent;border:none;padding:0;border-radius:0;display:flex;align-items:center;justify-content:center}
    .nav-logo img{width:56px;height:56px;object-fit:contain;background:transparent}
    .nav-brand-text{display:flex;flex-direction:column;line-height:1.08;white-space:nowrap}
    .nav-brand-text strong{display:block;font-family:'Poppins',sans-serif;font-size:1.28rem;color:#fff;line-height:1.12;font-weight:800;letter-spacing:.02em;text-shadow:0 1px 2px rgba(0,0,0,.25);white-space:nowrap}
    .nav-brand-text strong .num-2{color:#ffd54f;text-shadow:0 1px 3px rgba(0,0,0,.35)}
    .nav-brand-text .brand-sub{display:block;font-family:'Poppins',sans-serif;font-size:.8rem;font-weight:700;letter-spacing:.3em;text-transform:uppercase;color:var(--gold);text-shadow:0 1px 2px rgba(0,0,0,.35);white-space:nowrap;margin-top:2px}
    .nav-brand-text span{display:none}
    .num-2{color:#f9a825;font-style:normal}

    /* ============================================================
       NAVBAR LINK — BOLD, FONT Plus Jakarta Sans
       HOVER LANGSUNG MUNCUL KUNING-ORANYE + GARIS BAWAH DENGAN ANIMASI
       ============================================================ */
    .nav-menu{display:flex;align-items:center;gap:.12rem;list-style:none;margin:0;padding:0}
    .nav-link{
      display:inline-flex;align-items:center;gap:.4rem;padding:.6rem .8rem;border-radius:10px;
      font-family:var(--font-body);
      font-size:1rem;
      font-weight:700;
      color:rgba(255,255,255,.85);
      transition:all .25s var(--ease);position:relative;white-space:nowrap;
      letter-spacing:.02em;
      background:transparent !important;
    }
    .nav-link i{font-size:.7rem;transition:transform .25s var(--ease)}
    .nav-item.dropdown-open > .nav-link i{transform:rotate(180deg)}

    /* ============================================================
       GARIS BAWAH — DENGAN ANIMASI SLIDE IN
       ============================================================ */
    .nav-link::before,
    .nav-link::after{
      display:none !important;
      content:none !important;
    }

    /* HOVER — garis muncul dengan animasi slide in */
    .nav-link:hover{
      color:#f9a825 !important;
      background:transparent !important;
    }
    .nav-link:hover::after{
      display:none !important;
    }

    /* ============================================================
       AI MAJOR MATCHMAKER — NAVBAR FEATURE
       ============================================================ */
    .nav-ai-matchmaker{
      display:inline-flex !important;
      align-items:center !important;
      justify-content:center !important;
      gap:.55rem !important;
      position:relative !important;
      width:auto !important;
      min-width:205px !important;
      height:52px !important;
      box-sizing:border-box !important;
      padding:.65rem 1.15rem !important;
      /* Shine dibuat sebagai background di dalam tombol, bukan pseudo-element.
         Jadi badge AI tetap boleh keluar dari tombol tanpa membawa shine keluar. */
      background-image:
        linear-gradient(110deg,transparent 30%,rgba(255,255,255,.16) 50%,transparent 70%),
        linear-gradient(135deg,#ff8f00,#ff5722) !important;
      background-size:250% 100%,100% 100% !important;
      background-position:-100% 0,0 0 !important;
      background-repeat:no-repeat !important;
      border:2px solid rgba(255,213,79,.65) !important;
      color:#fff !important;
      border-radius:12px !important;
      font-family:var(--font-body);
      font-size:1rem !important;
      font-weight:800 !important;
      line-height:1 !important;
      white-space:nowrap !important;
      text-decoration:none !important;
      box-shadow:0 4px 16px rgba(244,81,30,.35),inset 0 0 0 1px rgba(255,255,255,.18) !important;
      overflow:visible !important;
      flex-shrink:0 !important;
      transition:background-position .6s ease, transform .3s ease, box-shadow .3s ease, border-color .3s ease !important;
    }
    .nav-ai-matchmaker:hover{
      background-image:
        linear-gradient(110deg,transparent 30%,rgba(255,255,255,.22) 50%,transparent 70%),
        linear-gradient(135deg,#ff9f1c,#ff681f) !important;
      background-position:120% 0,0 0 !important;
      color:#fff !important;
      border-color:rgba(255,213,79,.9) !important;
      transform:translateY(-2px);
      box-shadow:0 8px 24px rgba(244,81,30,.5),inset 0 0 0 1px rgba(255,255,255,.2) !important;
    }
    .nav-ai-matchmaker::after{display:none !important}
    .nav-ai-matchmaker .ai-icon{
      color:#ffd54f;
      filter:drop-shadow(0 0 7px rgba(255,213,79,.45));
      transition:transform .3s ease;
      flex:0 0 auto;
    }
    .nav-ai-matchmaker:hover .ai-icon{
      transform:rotate(-8deg) scale(1.12);
    }
    .nav-ai-matchmaker > span:not(.ai-nav-badge){
      display:inline-block;
      position:relative;
      z-index:2;
    }
    .ai-nav-badge{
      position:absolute !important;
      top:-9px !important;
      right:-8px !important;
      display:flex !important;
      align-items:center !important;
      justify-content:center !important;
      min-width:32px !important;
      height:25px !important;
      padding:0 7px !important;
      box-sizing:border-box !important;
      border-radius:999px !important;
      background:linear-gradient(135deg,#ff6d00,#f4511e) !important;
      color:#fff !important;
      font-size:.78rem !important;
      line-height:1 !important;
      font-weight:900 !important;
      letter-spacing:.02em !important;
      box-shadow:0 3px 9px rgba(244,81,30,.35) !important;
      border:1px solid rgba(255,255,255,.2) !important;
      z-index:20 !important;
      pointer-events:none !important;
    }

    /* ACTIVE — garis tetap terlihat */
    .nav-link.active{
      color:#f9a825 !important;
      background:transparent !important;
    }
    .nav-link.active::after{
      display:none !important;
    }

    /* DROPDOWN — tetap bold */
    .nav-item{position:relative}
    .dropdown-menu{position:absolute;top:calc(100% + 10px);left:0;min-width:260px;padding:.6rem;border-radius:14px;background:rgba(255,255,255,.97);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border:1px solid rgba(29,111,184,.25);box-shadow:0 20px 50px rgba(13,58,102,.18);opacity:0;visibility:hidden;transform:translateY(12px);transition:all .3s var(--ease);z-index:200}
    .nav-item.dropdown-open .dropdown-menu{opacity:1;visibility:visible;transform:translateY(0)}
    @media (min-width:901px){.nav-item:hover > .dropdown-menu{opacity:1;visibility:visible;transform:translateY(0)}}
    .dropdown-menu a{
      display:flex;align-items:center;gap:.65rem;padding:.62rem .8rem;border-radius:9px;
      font-family:var(--font-body);
      font-size:.88rem;
      font-weight:700;
      color:var(--ink);
      transition:all .2s;
      letter-spacing:.01em;
    }
    .dropdown-menu a i{width:20px;color:#1d6fb8;flex-shrink:0;font-size:.9rem}
    .dropdown-menu a:hover{background:rgba(29,111,184,.08);color:#0d3a66;transform:translateX(4px)}

    /* ============================================================
       CTA DAFTAR PPDB — TETAP BOLD (TANPA GARIS BAWAH)
       ============================================================ */
    .nav-cta{
      background:linear-gradient(135deg,#ff6d00,#f4511e) !important;
      color:#fff !important;
      box-shadow:0 4px 16px rgba(244,81,30,.35),inset 0 0 0 1.5px rgba(255,255,255,.4);
      position:relative;overflow:hidden;animation:ctaGlow 2.2s ease-in-out infinite;
      font-family:var(--font-body);
      font-size:1rem;
      font-weight:700;
      padding:.6rem 1.2rem !important;
      border-radius:10px !important;
    }
    .nav-cta::after{display:none !important} /* CTA tidak pakai garis bawah */
    .nav-cta:hover{
      color:#fff !important;
      background:linear-gradient(135deg,#ff8f00,#ff5722) !important;
      transform:translateY(-2px);
      box-shadow:0 8px 24px rgba(244,81,30,.5),inset 0 0 0 1.5px rgba(255,255,255,.6);
    }
    .nav-cta.active{
      color:#fff !important;
      background:linear-gradient(135deg,#ff8f00,#ff5722) !important;
    }
    .nav-cta .shine{content:"";position:absolute;inset:0;background:linear-gradient(110deg,transparent 30%,rgba(255,255,255,.3) 50%,transparent 70%);transform:translateX(-120%);transition:transform .6s}
    .nav-cta:hover .shine{transform:translateX(120%)}
    @keyframes ctaGlow{0%,100%{box-shadow:0 4px 16px rgba(244,81,30,.3),inset 0 0 0 1.5px rgba(255,255,255,.4)}50%{box-shadow:0 4px 24px rgba(255,109,0,.5),inset 0 0 0 1.5px rgba(255,255,255,.6)}}

    .nav-toggle{display:none;flex-direction:column;gap:5px;background:none;border:0;padding:.5rem}
    .nav-toggle span{width:24px;height:2.6px;border-radius:99px;background:#fff;transition:all .3s}

    .section-label{display:inline-flex;align-items:center;gap:.5rem;font-size:.78rem;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:var(--teal);margin-bottom:.9rem}
    .section-label::before{content:"";width:26px;height:3px;border-radius:99px;background:linear-gradient(90deg,var(--teal),var(--mint))}
    .section-title{font-family:var(--font-display);font-size:clamp(1.7rem,3.4vw,2.5rem);color:var(--ink);line-height:1.2;margin-bottom:.8rem}
    .section-title .accent{background:linear-gradient(100deg,var(--teal),var(--teal-light));-webkit-background-clip:text;background-clip:text;color:transparent}
    .section-title .gold{background:linear-gradient(100deg,var(--gold),var(--gold-dark));-webkit-background-clip:text;background-clip:text;color:transparent}
    .section-desc{color:var(--text-muted);max-width:640px;font-size:.96rem}
    .section-header.center{text-align:center}
    .section-header.center .section-desc{margin:0 auto}
    .section-header.center .section-label::before{display:none}

    [data-reveal]{opacity:0;transform:translateY(36px);transition:opacity .85s var(--ease),transform .85s var(--ease);will-change:opacity,transform}
    [data-reveal="left"]{transform:translateX(-46px)}
    [data-reveal="right"]{transform:translateX(46px)}
    [data-reveal].revealed{opacity:1;transform:none}
    [data-reveal]{transition-delay:calc(var(--d,0)*90ms)}

    /* ============================================================
       RESPONSIVE
       ============================================================ */
    @media(max-width:1024px){
      .announce-bar .container{padding:0 1.5rem}
      .nav-inner{padding:.9rem 1.5rem}
      #navbar.scrolled .nav-inner{padding:.75rem 1.5rem}
    }
    @media(max-width:900px){
      .section-py{padding:72px 0}
      .nav-menu{position:fixed;top:0;right:-320px;width:300px;height:100vh;flex-direction:column;align-items:flex-start;gap:.3rem;background:rgba(13,58,102,.96);padding:4.6rem 1.4rem 2rem;box-shadow:-20px 0 60px rgba(0,0,0,.45);transition:right .45s var(--ease);overflow-y:auto;backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px)}
      .nav-menu.open{right:0}
      .nav-toggle{display:flex}
      .nav-item{width:100%}
      .nav-link{width:100%;justify-content:flex-start;font-size:1.05rem;padding:.7rem .8rem}
      /* Pada mobile, garis bawah di kiri */
      .nav-link::after{
        left:20px;
        transform:scaleX(0);
        transform-origin:left;
      }
      .nav-link:hover::after,
      .nav-link.active::after{
        transform:scaleX(1);
      }
      .dropdown-menu{position:static;opacity:1;visibility:visible;transform:none;box-shadow:none;border:0;background:rgba(29,111,184,.05);margin-top:.3rem;display:none;min-width:0;padding:.3rem .5rem}
      .dropdown-menu a{font-size:.9rem;padding:.5rem .7rem}
      .nav-item.dropdown-open .dropdown-menu{display:block}
      .announce-bar .container{padding:0 1rem}
      .nav-inner{padding:.85rem 1rem;border-radius:0}
      #navbar.scrolled .nav-inner{padding:.7rem 1rem}
      .nav-cta{font-size:1.05rem;padding:.7rem 1rem !important}
      .nav-ai-matchmaker{width:100%;padding:.7rem .8rem !important;border-radius:10px !important}
      .ai-nav-badge{top:4px !important;right:10px !important;min-width:34px !important;height:27px !important;font-size:.9rem !important;}
    }
    @media(max-width:600px){
      .section-py{padding:60px 0}
      .announce-bar .container{padding:0 .8rem}
      .nav-inner{padding:.75rem .8rem;border-radius:0}
      #navbar.scrolled .nav-inner{padding:.65rem .8rem}
      .nav-link{font-size:1rem;padding:.6rem .7rem}
      .nav-cta{font-size:1rem;padding:.6rem .9rem !important}
    }
    @media(prefers-reduced-motion:reduce){
      *,*::before,*::after{animation-duration:.01ms !important;animation-iteration-count:1 !important;transition-duration:.01ms !important}
      [data-reveal]{opacity:1;transform:none}
      html{scroll-behavior:auto}
      .nav-link::after{transition:none !important}
    }
  
    /* ===== FOOTER DESIGN RESTORED ===== */
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

    
    /* ============================================================
       FLOATING UTILITIES — AKSESIBILITAS + NARA SKANEDA
       ============================================================ */
    .skn-stack{position:fixed;right:24px;bottom:24px;z-index:9999;display:flex;flex-direction:column;align-items:flex-end;gap:12px;font-family:var(--font-body,'Plus Jakarta Sans',sans-serif)}
    .skn-stack.skn-intro-safe{right:24px;bottom:170px;transition:bottom .35s var(--ease)}
    .acc-wrap,.nara-wrap{position:relative;display:flex}

    /* ---------- TOMBOL AKSESIBILITAS ---------- */
    .acc-fab{width:54px;height:54px;padding:0;border:0;border-radius:50%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#0d3a66,#1d6fb8);color:#fff;font-size:26px;line-height:1;cursor:pointer;box-shadow:0 10px 26px rgba(13,58,102,.38),inset 0 1px 0 rgba(255,255,255,.22);transition:transform .2s ease,box-shadow .2s ease;position:relative}
    .acc-fab:hover{transform:translateY(-2px) scale(1.04);box-shadow:0 14px 32px rgba(13,58,102,.46)}
    .acc-fab .acc-fab-icon{width:26px;height:26px;display:flex;align-items:center;justify-content:center;line-height:1}
    .acc-fab .acc-fab-icon i{font-size:26px;line-height:1}
    .acc-fab::after{content:"";position:absolute;inset:-5px;border-radius:50%;border:1.5px solid rgba(249,168,37,.5);opacity:0;transition:opacity .2s ease}
    .acc-fab:hover::after{opacity:1}
    .acc-fab .fab-tip{position:absolute;right:calc(100% + 12px);top:50%;transform:translateY(-50%) translateX(6px);background:#0d3a66;color:#fff;font-size:.68rem;font-weight:700;letter-spacing:.08em;padding:.4rem .7rem;border-radius:8px;white-space:nowrap;opacity:0;visibility:hidden;transition:all .2s ease;pointer-events:none;text-transform:uppercase}
    .acc-fab:hover .fab-tip{opacity:1;visibility:visible;transform:translateY(-50%) translateX(0)}
    /* ---------- TOMBOL NARA ---------- */
    .nara-fab{width:58px;height:58px;padding:0;border:0;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;background:linear-gradient(135deg,#f9a825,#fbbf24);box-shadow:0 12px 30px rgba(249,168,37,.45),inset 0 1px 0 rgba(255,255,255,.45);transition:transform .2s ease,box-shadow .2s ease;position:relative}
    .nara-fab:hover{transform:translateY(-2px) scale(1.04);box-shadow:0 16px 38px rgba(249,168,37,.55)}
    .nara-fab i{font-size:26px;color:#fff;display:block}
    .nara-fab .fab-tip{position:absolute;right:calc(100% + 12px);top:50%;transform:translateY(-50%) translateX(6px);background:#0d3a66;color:#fff;font-size:.68rem;font-weight:700;letter-spacing:.08em;padding:.4rem .7rem;border-radius:8px;white-space:nowrap;opacity:0;visibility:hidden;transition:all .2s ease;pointer-events:none;text-transform:uppercase}
    .nara-fab:hover .fab-tip{opacity:1;visibility:visible;transform:translateY(-50%) translateX(0)}
    .nara-fab .nara-status-dot{position:absolute;bottom:2px;right:2px;width:13px;height:13px;border-radius:50%;background:#22c55e;border:2px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,.3)}

    /* ---------- PANEL AKSESIBILITAS ---------- */
    .acc-panel{position:absolute;right:0;bottom:calc(100% + 12px);z-index:9999;width:min(312px,calc(100vw - 48px));max-width:calc(100vw - 32px);max-height:min(480px,calc(100vh - 160px));border-radius:16px;background:#fff;border:1px solid rgba(29,111,184,.18);box-shadow:0 24px 60px rgba(13,58,102,.26);overflow:hidden;display:flex;flex-direction:column;opacity:0;visibility:hidden;transform:translateX(10px) scale(.98);transform-origin:bottom right;pointer-events:none;transition:opacity .22s ease,transform .22s ease,visibility .22s}
    .acc-panel.open{opacity:1;visibility:visible;transform:translateX(0) scale(1);pointer-events:auto}
    .acc-head{display:flex;align-items:center;gap:10px;padding:11px 13px;background:linear-gradient(135deg,#0d3a66,#13518c);color:#fff;position:relative;overflow:hidden}
    .acc-head::after{content:"";position:absolute;width:86px;height:86px;border:1.4px dashed rgba(255,255,255,.16);border-radius:50%;top:-38px;right:-26px}
    .acc-head-icon{width:32px;height:32px;flex:0 0 32px;border-radius:10px;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,.16);color:#ffd54f;font-size:.95rem}
    .acc-title{font-size:.76rem;font-weight:800;letter-spacing:.12em;line-height:1.2}
    .acc-sub{font-size:.6rem;color:rgba(255,255,255,.72);margin-top:1px}
    .acc-close{margin-left:auto;width:24px;height:24px;border:0;border-radius:8px;background:rgba(255,255,255,.12);color:#fff;cursor:pointer;font-size:.7rem;transition:background .2s;flex:0 0 24px}
    .acc-close:hover{background:rgba(255,255,255,.26)}
    .acc-body{padding:10px 13px 12px;overflow-y:auto;flex:1 1 auto;min-height:0}
    .acc-section{margin-top:10px}
    .acc-section:first-child{margin-top:0}
    .acc-label{font-size:.6rem;font-weight:800;letter-spacing:.18em;color:#1d6fb8;margin-bottom:6px;display:flex;align-items:center;gap:6px;text-transform:uppercase}
    .acc-label::before{content:"";width:14px;height:2.5px;border-radius:99px;background:linear-gradient(90deg,#f9a825,#ffd54f)}
    .acc-row{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:5px 0}
    .acc-row-name-wrap{display:flex;align-items:center;gap:8px;min-width:0}
    .acc-row-name-wrap>i{width:24px;height:24px;flex:0 0 24px;border-radius:8px;background:#eef4fa;color:#1d6fb8;font-size:.68rem;display:flex;align-items:center;justify-content:center}
    .acc-row-name{font-size:.74rem;font-weight:700;color:#17324d}
    .acc-row-desc{font-size:.62rem;color:#7c8ea0;margin-top:1px}
    .acc-seg{display:flex;gap:4px;background:#eef4fa;border-radius:10px;padding:3px}
    .acc-seg-btn{width:32px;height:24px;border:0;border-radius:8px;background:transparent;color:#33475c;font-family:inherit;font-weight:700;cursor:pointer;transition:all .2s;font-size:.7rem}
    .acc-seg-btn:nth-child(2){font-size:.78rem}.acc-seg-btn:nth-child(3){font-size:.85rem}
    .acc-seg-btn.active{background:#fff;color:#1d6fb8;box-shadow:0 2px 8px rgba(29,111,184,.18)}
    .acc-toggle-row{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:6px 0}
    .acc-switch{width:38px;height:21px;flex:0 0 38px;border-radius:99px;border:0;background:#d7e2ec;position:relative;cursor:pointer;transition:background .2s ease}
    .acc-switch span{position:absolute;top:3px;left:3px;width:15px;height:15px;border-radius:50%;background:#fff;box-shadow:0 1px 4px rgba(0,0,0,.25);transition:left .2s ease}
    .acc-switch.on{background:#1d6fb8}
    .acc-switch.on span{left:20px}
    .mode-cards{display:grid;grid-template-columns:1fr 1fr;gap:8px}
    .mode-card{position:relative;border:1.5px solid #dce8f2;border-radius:12px;background:#fff;padding:7px 8px 6px;cursor:pointer;text-align:left;transition:all .2s ease;font-family:inherit}
    .mode-card:hover{border-color:#8fc8ea;transform:translateY(-1px)}
    .mode-card.active{border-color:#1d6fb8;background:#f2f8fd;box-shadow:0 0 0 3px rgba(29,111,184,.14)}
    .mode-card-preview{display:flex;flex-direction:column;gap:4px;height:40px;border-radius:8px;padding:6px;background:#eef4fa;margin-bottom:5px;overflow:hidden}
    .pv-dot{width:7px;height:7px;border-radius:50%;background:#f9a825;margin-bottom:2px}
    .pv-line{height:4px;border-radius:99px;background:#bcd3e6}
    .pv-line:nth-child(3){width:78%}.pv-line:nth-child(4){width:55%}
    .mode-card-preview i.fa-sun,.mode-card-preview i.fa-moon{display:block;margin:auto;font-size:1.15rem}
    .mode-card-preview i.fa-sun{color:#f9a825}
    .mode-card-preview i.fa-moon{color:#0d3a66}
    .mode-toggle-single{width:100%;display:flex;align-items:center;gap:.6rem;border:1.5px solid #dce8f2;border-radius:12px;background:#fff;padding:10px 14px;cursor:pointer;text-align:left;transition:all .2s ease;font-family:inherit}
    .mode-toggle-single:hover{border-color:#8fc8ea;transform:translateY(-1px)}
    .mode-toggle-icon{width:34px;height:34px;border-radius:10px;background:#eef4fa;display:flex;align-items:center;justify-content:center;font-size:1.05rem;flex-shrink:0}
    .mode-toggle-icon .fa-sun{color:#f9a825}
    .mode-toggle-icon .fa-moon{color:#0d3a66}
    .mode-toggle-name{font-size:.72rem;font-weight:800;letter-spacing:.08em;color:#33475c}
    .mode-card-name{font-size:.64rem;font-weight:800;letter-spacing:.08em;color:#33475c}
    .mode-card .mode-card-check{position:absolute;top:5px;right:5px;width:16px;height:16px;border-radius:50%;background:#1d6fb8;color:#fff;font-size:.5rem;display:flex;align-items:center;justify-content:center;opacity:0;transform:scale(.6);transition:all .2s ease}
    .mode-card.active .mode-card-check{opacity:1;transform:scale(1)}
    .acc-reset{width:100%;margin-top:10px;padding:7px;border:1px solid #dce8f2;border-radius:10px;background:#f5f9fd;color:#526273;font-size:.68rem;font-weight:700;cursor:pointer;transition:all .2s;font-family:inherit}
    .acc-reset:hover{border-color:#1d6fb8;color:#1d6fb8}

    /* ---------- PANEL NARA ---------- */
    .nara-window{position:absolute;right:0;bottom:calc(100% + 76px);width:min(360px,calc(100vw - 48px));max-width:calc(100vw - 32px);max-height:min(560px,calc(100vh - 160px));display:flex;flex-direction:column;border-radius:18px;background:#fff;border:1px solid rgba(29,111,184,.18);box-shadow:0 26px 64px rgba(13,58,102,.28);overflow:hidden;opacity:0;visibility:hidden;transform:translateX(10px) scale(.98);transform-origin:bottom right;pointer-events:none;transition:opacity .22s ease,transform .22s ease,visibility .22s}
    .nara-window.open{opacity:1;visibility:visible;transform:none;pointer-events:auto}
    .nara-window.edge-top{position:fixed;top:12px;right:24px;bottom:auto;transform-origin:top right}
    .nara-header{display:flex;align-items:center;gap:11px;padding:14px 15px;color:#fff;background:linear-gradient(135deg,#0d3a66,#1d6fb8);position:relative;overflow:hidden}
    .nara-header::after{content:"";position:absolute;width:110px;height:110px;border:1.4px dashed rgba(255,255,255,.18);border-radius:50%;top:-46px;right:-34px}
    .nara-avatar{width:48px;height:48px;flex:0 0 48px;border-radius:14px;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,.15);box-shadow:inset 0 0 0 1px rgba(255,255,255,.2)}
    .nara-avatar i{font-size:22px;color:#0d3a66;display:block}
    .nara-name{font-size:.92rem;font-weight:800;letter-spacing:.02em;line-height:1.15}
    .nara-name em{font-style:normal;color:#ffd54f}
    .nara-sub{font-size:.64rem;color:#a8d8f5;margin-top:2px}
    .nara-status{display:inline-flex;align-items:center;gap:.35rem;font-size:.6rem;font-weight:700;color:#bff0cf;background:rgba(34,197,94,.16);border:1px solid rgba(74,222,128,.28);border-radius:99px;padding:.14rem .5rem;margin-top:3px;width:fit-content}
    .nara-status::before{content:"";width:7px;height:7px;border-radius:50%;background:#4ade80;box-shadow:0 0 8px #4ade80}
    .nara-close{margin-left:auto;width:30px;height:30px;border:0;border-radius:10px;background:rgba(255,255,255,.13);color:#fff;cursor:pointer;font-size:.76rem;transition:all .2s;flex:0 0 30px}
    .nara-close:hover{background:rgba(255,255,255,.28);transform:rotate(90deg)}
    .nara-messages{height:250px;flex:1 1 auto;min-height:0;overflow-y:auto;padding:13px;display:flex;flex-direction:column;gap:10px;background:#f5f9fd}
    .nara-msg{display:flex;gap:7px;max-width:88%}
    .nara-msg.user{margin-left:auto;flex-direction:row-reverse}
    .nara-msg-avatar{flex-shrink:0;width:28px;height:28px;border-radius:9px;display:flex;align-items:center;justify-content:center;background:#eaf5fd;color:#1d6fb8}
    .nara-msg.user .nara-msg-avatar{background:linear-gradient(135deg,#1d6fb8,#28a9e1);color:#fff}
    .nara-bubble{padding:.62rem .9rem;border-radius:16px 16px 16px 4px;font-size:.8rem;background:#fff;border:1px solid #dce8f2;box-shadow:0 3px 10px rgba(29,111,184,.07);line-height:1.55;color:#33475c}
    .nara-msg.user .nara-bubble{border-radius:16px 16px 4px 16px;background:linear-gradient(135deg,#1d6fb8,#28a9e1);color:#fff;border:0}
    .nara-time{font-size:.6rem;color:#8a9aaa;margin-top:.22rem}
    .nara-quick{display:grid;grid-template-columns:repeat(3,1fr);gap:6px;padding:9px 12px;border-top:1px solid #e8eef4;background:#fff}
    .nara-quick-btn{font-size:.62rem;font-weight:700;border:1px solid #dce8f2;background:#fff;color:#1d6fb8;border-radius:10px;padding:.42rem .3rem;transition:all .22s;cursor:pointer;font-family:inherit;display:flex;align-items:center;justify-content:center;gap:.28rem;line-height:1.25;text-align:center;white-space:nowrap}
    .nara-quick-btn i{color:#f9a825;font-size:.62rem;flex:0 0 auto}
    .nara-quick-btn:hover{border-color:#1d6fb8;background:#f2f8fd;transform:translateY(-1px)}
    .nara-input-row{display:flex;gap:6px;padding:10px 12px 12px;background:#fff;border-top:1px solid #e8eef4}
    .nara-input{flex:1;min-width:0;border:1px solid #dce8f2;border-radius:11px;padding:.55rem .85rem;font-size:.78rem;font-family:inherit;outline:none;background:#f5f9fd;transition:border-color .22s}
    .nara-input:focus{border-color:#1d6fb8}
    .nara-send{width:38px;height:38px;flex:0 0 38px;border:0;border-radius:11px;background:linear-gradient(135deg,#f9a825,#fbbf24);color:#4a2c00;font-size:.85rem;cursor:pointer;transition:transform .2s ease,box-shadow .2s ease;display:flex;align-items:center;justify-content:center}
    .nara-send:hover{transform:scale(1.07)}

    /* ---------- CLASS AKSESIBILITAS ---------- */
    body.a11y-reduce-motion *,body.a11y-reduce-motion *::before,body.a11y-reduce-motion *::after{animation:none!important;transition:none!important;scroll-behavior:auto!important}
    body.a11y-focus-outline :focus{outline:3px solid #f9a825!important;outline-offset:2px!important}
    body.skn-display-2{--radius:26px;font-size:1.05rem}
    body.skn-display-2 .section-py{padding:108px 0}
    body.skn-display-2 .section-title{letter-spacing:.01em}
    body.skn-display-2 .card,body.skn-display-2 .sec-card,body.skn-display-2 .feature-card{border-radius:26px}

    /* ---------- DARK MODE ---------- */
    body.theme-dark{--bg:#0a1f33;--card:#102a45;--border:#1d3a5c;--ink:#eaf2fb;--text:#c9d8e8;--text-muted:#8fa8c2;--shadow:0 10px 40px rgba(0,0,0,.35);--shadow-lg:0 24px 70px rgba(0,0,0,.45)}
    body.theme-dark .section-title{color:#eaf2fb}
    body.theme-dark .footer-main{background:#081c30}
    body.theme-dark .acc-panel,body.theme-dark .nara-window{background:#102a45;border-color:#1d3a5c}
    body.theme-dark .acc-body,body.theme-dark .nara-messages{background:#0d2338}
    body.theme-dark .acc-row-name,body.theme-dark .mode-card-name{color:#eaf2fb}
    body.theme-dark .mode-card{background:#102a45;border-color:#1d3a5c}
    body.theme-dark .acc-seg{background:#0d2338}
    body.theme-dark .acc-seg-btn{color:#c9d8e8}
    body.theme-dark .nara-bubble{background:#15314f;border-color:#1d3a5c;color:#e3edf6}
    body.theme-dark .nara-input{background:#0d2338;border-color:#1d3a5c;color:#e3edf6}
    body.theme-dark .acc-reset{background:#0d2338;border-color:#1d3a5c;color:#c9d8e8}

    @media(max-width:600px){
      .skn-stack{right:12px;bottom:12px;gap:12px}
      .skn-stack.skn-intro-safe{right:12px;bottom:150px}
      .acc-fab{width:50px;height:50px;font-size:24px}
      .acc-fab .acc-fab-icon,.acc-fab .acc-fab-icon i{font-size:24px}
      .nara-fab{width:54px;height:54px}
      .nara-fab i{font-size:24px}
      .acc-panel{position:fixed;left:12px;right:12px;bottom:132px;width:auto;max-width:none;top:auto;transform:translateY(8px) scale(.98)}
      .acc-panel.open{transform:none}
      .nara-window{position:fixed;left:12px;right:12px;bottom:132px;width:auto;max-width:none;top:auto;max-height:calc(100vh - 160px);transform:translateY(8px) scale(.98)}
      .nara-window.open{transform:none}
      .acc-body{max-height:none}
      .nara-messages{height:220px}
      .nara-quick{grid-template-columns:repeat(3,1fr);gap:5px;padding:8px 10px}
      .nara-quick-btn{font-size:.6rem;padding:.4rem .2rem;white-space:nowrap}
      .fab-tip{display:none!important}
    }
</style>

  {{-- CSS tambahan khusus per halaman --}}
  @stack('styles')
</head>
<body>

  {{-- ================= PRELOADER ================= --}}
  <div id="preloader">
    <div class="preloader-logo"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMK Negeri 2 Mojokerto" /></div>
    <div class="preloader-bar"><span></span></div>
    <div class="preloader-text">SMK Negeri <em class="num-2">2</em> Mojokerto</div>
  </div>

  {{-- ================= ANIMATED BG FX ================= --}}
  <div class="bg-fx" aria-hidden="true">
    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>
    <div class="bg-blob bg-blob-3"></div>
  </div>

  {{-- ================= CURSOR GLOW ================= --}}
  <div id="cursorGlow" aria-hidden="true"></div>

  {{-- ================= ANNOUNCEMENT BAR (FULL WIDTH) ================= --}}
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

  {{-- ================= NAVBAR (FULL WIDTH) ================= --}}
  <nav id="navbar">
    <div class="nav-inner">
      <a href="{{ route('home') }}" class="nav-brand">
        <div class="nav-logo"><img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMK Negeri 2" /></div>
        <div class="nav-brand-text">
          <strong>SMK NEGERI <em class="num-2">2</em></strong>
          <span class="brand-sub">MOJOKERTO</span>
        </div>
      </a>

      <ul class="nav-menu" id="navMenu">
        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>

        <li class="nav-item">
          <a href="#" class="nav-link dropdown-trigger">Profil <i class="fas fa-chevron-down"></i></a>
          <div class="dropdown-menu">
            <a href="{{ route('profil.sejarah-sekolah') }}"><i class="fas fa-history"></i> Sejarah Sekolah</a>
            <a href="{{ route('profil.visi-misi') }}"><i class="fas fa-eye"></i> Visi &amp; Misi</a>
            <a href="{{ route('profil.struktur-organisasi') }}"><i class="fas fa-sitemap"></i> Struktur Organisasi</a>
            <a href="{{ route('profil.guru-staf') }}"><i class="fas fa-chalkboard-user"></i> Guru &amp; Staf</a>
            <a href="{{ route('profil.roadmap-pengembangan') }}"><i class="fas fa-road"></i> Roadmap Pengembangan</a>
            <a href="{{ route('profil.tour') }}"><i class="fas fa-street-view"></i> Tour Virtual 360°</a>
          </div>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link dropdown-trigger">Program Keahlian <i class="fas fa-chevron-down"></i></a>
          <div class="dropdown-menu">
            <a href="{{ route('aphp') }}"><i class="fas fa-wheat-awn"></i> Agribisnis Pengolahan Hasil Pertanian</a>
            <a href="{{ route('dkv') }}"><i class="fas fa-palette"></i> Desain Komunikasi Visual</a>
            <a href="{{ route('kuliner') }}"><i class="fas fa-utensils"></i> Kuliner</a>
            <a href="{{ route('lps') }}"><i class="fas fa-calculator"></i> Layanan Perbankan Syariah</a>
            <a href="{{ route('rpl') }}"><i class="fas fa-code"></i> Rekayasa Perangkat Lunak</a>
          </div>
        </li>

        <li class="nav-item"><a href="{{ route('ppdb') }}" class="nav-link {{ request()->routeIs('ppdb') ? 'active' : '' }}">PPDB</a></li>

        <li class="nav-item">
          <a href="#" class="nav-link dropdown-trigger">Siswa <i class="fas fa-chevron-down"></i></a>
          <div class="dropdown-menu">
            <a href="{{ url('/siswa/karya-siswa') }}"><i class="fas fa-lightbulb"></i> Karya Siswa</a>
            <a href="{{ url('/siswa/ekstrakurikuler') }}"><i class="fas fa-people-group"></i> Ekstrakurikuler</a>
            <a href="{{ url('/siswa/voice') }}"><i class="fas fa-comment-dots"></i> E-Voice</a>
          </div>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link dropdown-trigger">Berita <i class="fas fa-chevron-down"></i></a>
          <div class="dropdown-menu">
            <a href="{{ url('/berita/index') }}"><i class="fas fa-newspaper"></i> Semua Berita</a>
            <a href="{{ url('/berita/factcheck') }}"><i class="fas fa-shield-halved"></i> School FactCheck</a>
          </div>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link dropdown-trigger">Galeri <i class="fas fa-chevron-down"></i></a>
          <div class="dropdown-menu">
            <a href="{{ url('/galeri/kegiatan') }}"><i class="fas fa-school"></i> Kegiatan Sekolah</a>
            <a href="{{ url('/galeri/prestasi-sekolah') }}"><i class="fas fa-medal"></i> Prestasi</a>
          </div>
        </li>

        <li class="nav-item"><a href="{{ url('/bkk-loker') }}" class="nav-link {{ request()->is('bkk-loker*') ? 'active' : '' }}">BKK &amp; Loker</a></li>

        <li class="nav-item">
          <a href="{{ url('/ai') }}"
             class="nav-link nav-cta nav-ai-matchmaker {{ request()->is('ai*') ? 'active' : '' }}"
             aria-label="Cari Ekskulmu">
            <i class="fas fa-wand-magic-sparkles ai-icon"></i>
            <span>Cari Ekskulmu</span>
            <span class="ai-nav-badge">AI</span>
          </a>
        </li>
      </ul>

      <button class="nav-toggle" id="navToggle" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </nav>

  {{-- ================= KONTEN PER HALAMAN ================= --}}
  @yield('content')



  {{-- ================= FOOTER (DIGABUNG DARI PARTIAL) ================= --}}
<div class="footer-main">
  <div class="container">
    <div class="footer-accent"></div>
    <div class="footer-statement">
      <div class="footer-sig-name">SMK Negeri <span class="num-2">2</span><br>Mojokerto</div>
      <div class="footer-sig-sub">Sekolah Menengah Kejuruan Unggulan</div>
      <p class="footer-sig-tagline">Mencetak lulusan vokasi berkualitas, berkarakter, dan siap bersaing di era global.</p>
    </div>
    <div class="footer-divider"></div>
    <nav class="footer-nav" aria-label="Navigasi footer">
      <div class="footer-nav-group">
        <div class="footer-nav-group-title">Explore</div>
        <div class="footer-nav-links">
          <a href="#beranda">Beranda</a>
          <a href="#profil">Profil</a>
          <a href="#jurusan">Jurusan</a>
          <a href="#berita">Berita</a>
          <a href="#galeri">Galeri</a>
          <a href="school-roadmap.html">Roadmap Sekolah</a>
        </div>
      </div>
      <div class="footer-nav-group">
        <div class="footer-nav-group-title">Informasi</div>
        <div class="footer-nav-links">
          <a href="#ppdb">PPDB</a>
          <a href="#kontak">Kontak</a>
          <a href="#sitemap">Sitemap</a>
        </div>
      </div>
      <div class="footer-nav-group">
        <div class="footer-nav-group-title">Legal</div>
        <div class="footer-nav-links">
          <a href="#">Kebijakan Privasi</a>
          <a href="#">Syarat &amp; Ketentuan</a>
        </div>
      </div>
    </nav>
    <div class="footer-social">
      <div class="footer-social-label">Follow Our Journey</div>
      <div class="footer-social-row">
        <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
        <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="footer-bottom-inner">
        <div class="footer-copy">
          <span>&copy; 2026 SMK Negeri 2 Mojokerto</span>
          <span class="footer-copy-sign">Belajar hari ini, berkarya untuk masa depan.</span>
        </div>
        <div class="footer-legal">
          <a href="#">Kebijakan Privasi</a>
          <a href="#">Syarat &amp; Ketentuan</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ================= FLOATING UTILITIES: AKSESIBILITAS + NARA SKANEDA ================= -->
<div class="skn-stack">

  <!-- ===== TOGGLE MODE WARNA ===== -->
  <div class="acc-wrap">
    <button type="button" class="acc-fab" id="accFab" onclick="toggleColorMode()" aria-label="Ganti mode terang/gelap" title="Ganti Mode Terang/Gelap">
      <span class="acc-fab-icon"><i class="fas fa-sun" id="accIcon"></i></span>
      <span class="fab-tip">Mode Terang/Gelap</span>
    </button>
  </div>

  <!-- ===== NARA SKANEDA ===== -->
  <div class="nara-wrap">
    <div class="nara-window" id="naraWindow" role="dialog" aria-label="Nara Skaneda — Asisten Virtual">
      <div class="nara-header">
        <div class="nara-avatar">
          <i class="fas fa-robot"></i>
        </div>
        <div>
          <div class="nara-name">NARA <em>SKANEDA</em></div>
          <div class="nara-sub">Asisten Virtual SMK Negeri 2 Mojokerto</div>
          <div class="nara-status">Online</div>
        </div>
        <button type="button" class="nara-close" onclick="toggleNara()" aria-label="Tutup Nara Skaneda"><i class="fas fa-times"></i></button>
      </div>
      <div class="nara-messages" id="naraMessages">
        <div class="nara-msg">
          <div class="nara-msg-avatar"><i class="fas fa-user-graduate"></i></div>
          <div>
            <div class="nara-bubble">Halo! Saya <strong>NARA SKANEDA</strong> 👋 Asisten virtual SMK Negeri 2 Mojokerto. Ada yang bisa saya bantu?</div>
            <div class="nara-time">Sekarang</div>
          </div>
        </div>
      </div>
      <div class="nara-quick">
        <button type="button" class="nara-quick-btn" onclick="sendNaraQuick('Jurusan apa saja?')"><i class="fas fa-graduation-cap"></i> Jurusan</button>
        <button type="button" class="nara-quick-btn" onclick="sendNaraQuick('Info PPDB')"><i class="fas fa-file-signature"></i> PPDB</button>
        <button type="button" class="nara-quick-btn" onclick="sendNaraQuick('Ekskul apa saja?')"><i class="fas fa-people-group"></i> Ekskul</button>
        <button type="button" class="nara-quick-btn" onclick="sendNaraQuick('Jadwal sekolah')"><i class="fas fa-calendar-days"></i> Jadwal</button>
        <button type="button" class="nara-quick-btn" onclick="sendNaraQuick('Info PKL')"><i class="fas fa-building"></i> PKL</button>
        <button type="button" class="nara-quick-btn" onclick="sendNaraQuick('Kontak sekolah')"><i class="fas fa-phone"></i> Kontak</button>
      </div>
      <div class="nara-input-row">
        <input type="text" class="nara-input" id="naraInput" placeholder="Ketik pertanyaan..." aria-label="Ketik pertanyaan" onkeydown="if(event.key==='Enter')sendNaraMsg()">
        <button type="button" class="nara-send" onclick="sendNaraMsg()" aria-label="Kirim"><i class="fas fa-paper-plane"></i></button>
      </div>
    </div>
    <button type="button" class="nara-fab" id="naraFab" onclick="toggleNara()" aria-label="Buka Nara Skaneda" title="Nara Skaneda — Asisten Virtual">
      <i class="fas fa-robot"></i>
      <span class="nara-status-dot"></span>
      <span class="fab-tip">Nara Skaneda</span>
    </button>
  </div>

</div>

  {{-- ================= BACK TO TOP ================= --}}
  <button id="backToTop" aria-label="Kembali ke atas"><i class="fas fa-arrow-up"></i></button>

  {{-- ================= SCRIPT GLOBAL ================= --}}
  <script>
    window.addEventListener('load', () => {
      document.getElementById('preloader')?.classList.add('done');
    });

    const navbar = document.getElementById('navbar');
    let lastScroll = 0;
    window.addEventListener('scroll', () => {
      const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
      if (currentScroll > 50) navbar.classList.add('scrolled');
      else navbar.classList.remove('scrolled');
      lastScroll = currentScroll;
    });

    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');
    if (navToggle && navMenu) {
      navToggle.addEventListener('click', () => navMenu.classList.toggle('open'));
      navMenu.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', () => navMenu.classList.remove('open'));
      });
    }

    const dropdownTriggers = document.querySelectorAll('.dropdown-trigger');
    const dropdownItems = document.querySelectorAll('.nav-item');

    dropdownTriggers.forEach(trigger => {
      trigger.addEventListener('click', (e) => {
        e.preventDefault();
        const parent = trigger.closest('.nav-item');
        document.querySelectorAll('.nav-item.dropdown-open').forEach(item => {
          if (item !== parent) item.classList.remove('dropdown-open');
        });
        parent.classList.toggle('dropdown-open');
      });
    });

    document.addEventListener('click', (e) => {
      if (!e.target.closest('#navbar')) {
        document.querySelectorAll('.nav-item.dropdown-open').forEach(item => item.classList.remove('dropdown-open'));
      }
    });

    dropdownItems.forEach(item => {
      item.addEventListener('mouseenter', () => {
        document.querySelectorAll('.nav-item.dropdown-open').forEach(openItem => {
          if (openItem !== item) openItem.classList.remove('dropdown-open');
        });
      });
    });

    const backToTop = document.getElementById('backToTop');
    window.addEventListener('scroll', () => {
      if (window.pageYOffset > 400) backToTop.classList.add('show');
      else backToTop.classList.remove('show');
    });
    backToTop?.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    const revealElements = document.querySelectorAll('[data-reveal]');
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.classList.add('revealed');
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -30px 0px' });
    revealElements.forEach(el => revealObserver.observe(el));
    // Fallback: pastikan konten halaman profil/sejarah/struktur/guru tidak tetap opacity:0.
    setTimeout(() => revealElements.forEach(el => el.classList.add('revealed')), 250);
  </script>


<script>
(function(){
  /* ============================================================
     NARA SKANEDA — Asisten Virtual SMK Negeri 2 Mojokerto
     ============================================================ */
  const naraResponses = {
    jurusan:'SMK Negeri 2 Mojokerto memiliki 5 program keahlian: RPL, DKV, Kuliner, APHP, dan LPS.',
    ppdb:'Untuk informasi PPDB terbaru, silakan buka halaman PPDB pada menu website.',
    ekskul:'Informasi ekstrakurikuler tersedia pada menu Siswa → Ekstrakurikuler.',
    jadwal:'Informasi jadwal sekolah dapat dilihat pada layanan informasi sekolah.',
    pkl:'Informasi PKL tersedia pada menu PKL & Alumni.',
    kontak:'Silakan gunakan halaman Kontak untuk mendapatkan informasi kontak resmi sekolah.',
    default:'Terima kasih atas pertanyaannya. Silakan cari informasi melalui menu website SMK Negeri 2 Mojokerto.'
  };

  window.toggleNara = function(){
    const w = document.getElementById('naraWindow');
    if(!w) return;
    const opening = !w.classList.contains('open');
    if(opening) applyPanelEdgeSafe(w, 'nara');
    w.classList.toggle('open');
    if(w.classList.contains('open')){
      const inp = document.getElementById('naraInput');
      if(inp) setTimeout(()=>inp.focus(), 250);
    }
  };

  /* Safety: jika panel akan keluar viewport atas, alihkan ke posisi
     fixed kanan-atas (dipanggil SATU KALI saat toggle, bukan loop). */
  function applyPanelEdgeSafe(panel, kind){
    if(!panel) return;
    panel.classList.remove('edge-top');
    var need = false;
    var r = panel.getBoundingClientRect();
    if(r.top < 12 || r.bottom > (window.innerHeight - 60)){
      need = true;
    }
    if(kind === 'acc' && r.top < 12) need = true;
    if(need){
      panel.classList.add('edge-top');
      if(window.innerWidth <= 600){
        panel.style.top = '12px';
        panel.style.bottom = 'auto';
      }
    }
  }
  window.applyPanelEdgeSafe = applyPanelEdgeSafe;

  function naraGetResponse(text){
    const t = (text||'').toLowerCase();
    if(t.includes('jurusan')||t.includes('program')) return naraResponses.jurusan;
    if(t.includes('ppdb')||t.includes('daftar')) return naraResponses.ppdb;
    if(t.includes('ekskul')||t.includes('ekstrakurikuler')) return naraResponses.ekskul;
    if(t.includes('jadwal')||t.includes('jam')) return naraResponses.jadwal;
    if(t.includes('pkl')||t.includes('magang')) return naraResponses.pkl;
    if(t.includes('kontak')||t.includes('alamat')||t.includes('telepon')) return naraResponses.kontak;
    return naraResponses.default;
  }

  function naraAddMsg(text, isUser){
    const msgs = document.getElementById('naraMessages');
    if(!msgs) return;
    const div = document.createElement('div');
    div.className = 'nara-msg' + (isUser ? ' user' : '');
    const safe = String(text).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\n/g,'<br>');
    const icon = isUser ? 'user' : 'user-graduate';
    div.innerHTML = '<div class="nara-msg-avatar"><i class="fas fa-' + icon + '"></i></div><div><div class="nara-bubble">' + safe + '</div><div class="nara-time">Sekarang</div></div>';
    msgs.appendChild(div);
    msgs.scrollTop = msgs.scrollHeight;
  }

  window.sendNaraMsg = function(){
    const input = document.getElementById('naraInput');
    if(!input) return;
    const text = input.value.trim();
    if(!text) return;
    naraAddMsg(text, true);
    input.value = '';
    setTimeout(()=>naraAddMsg(naraGetResponse(text), false), 500);
  };

  window.sendNaraQuick = function(text){
    naraAddMsg(text, true);
    setTimeout(()=>naraAddMsg(naraGetResponse(text), false), 450);
  };

  /* ============================================================
     PENGATURAN TAMPILAN — Aksesibilitas & Mode
     ============================================================ */
  const A11Y_KEY = 'sknA11y';

  function getA11y(){
    let s = {};
    try{ s = Object.assign(s, JSON.parse(localStorage.getItem(A11Y_KEY)||'{}')); }catch(e){}
    return s;
  }
  function saveA11y(s){
    localStorage.setItem(A11Y_KEY, JSON.stringify(s));
  }

  function applyA11y(s){
    const b = document.body;
    b.classList.toggle('theme-dark', s.colorMode === 'dark');

    const colorIsDark = (s.colorMode||'light') === 'dark';
    const fabIcon = document.getElementById('accIcon');
    if(fabIcon){
      fabIcon.classList.toggle('fa-sun', !colorIsDark);
      fabIcon.classList.toggle('fa-moon', colorIsDark);
    }
  }

  window.toggleColorMode = function(){
    const s = getA11y();
    s.colorMode = (s.colorMode === 'dark') ? 'light' : 'dark';
    saveA11y(s); applyA11y(s);
  };

  document.addEventListener('DOMContentLoaded', function(){
    applyA11y(getA11y());
    document.addEventListener('click', function(e){
      const nara = document.querySelector('.nara-wrap');
      if(nara && !nara.contains(e.target)) document.getElementById('naraWindow')?.classList.remove('open');
    });
  });

  /* ============================================================
     COLLISION-SAFE: floating stack tidak boleh menutupi tombol
     "Lewati Intro" / CTA di hero saat intro video aktif.
     Pakai MutationObserver ringan (bukan scroll/interval) —
     otomatis disconnect setelah intro selesai.
     ============================================================ */
  (function(){
    var stack = document.querySelector('.skn-stack');
    var introEl = document.getElementById('hdIntro');
    if(!stack || !introEl || !('MutationObserver' in window)) return;
    var safeClass = 'skn-intro-safe';
    var done = false;
    function sync(){
      if(done) return;
      var active = !introEl.classList.contains('hd-hidden');
      stack.classList.toggle(safeClass, active);
      if(!active){ done = true; observer.disconnect(); }
    }
    var observer = new MutationObserver(sync);
    observer.observe(introEl, { attributes: true, attributeFilter: ['class'] });
    sync();
  })();
})();
</script>

  @stack('scripts')
</body>
</html>