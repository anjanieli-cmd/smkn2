{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="{{ asset('images/logo_smkn2.png') }}">
  <title>@yield('title', 'SMK Negeri 2 Mojokerto — Beranda')</title>
  <meta name="description" content="@yield('description', 'Website resmi SMK Negeri 2 Mojokerto — Sekolah Menengah Kejuruan unggulan di Kota Mojokerto, Jawa Timur.')" />

  <!-- Pre-render theme check to prevent white flash -->
  <script>
    (function(){
      try{
        var s = JSON.parse(localStorage.getItem('sknA11y')||'{}');
        if(s.colorMode === 'dark'){
          document.documentElement.classList.add('theme-dark');
        }
      }catch(e){}
    })();
  </script>

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
      transition:background-color .4s ease,color .4s ease;
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

    /* ---------- FOOTER PARTNERS / MITRA LOGO ---------- */
    .footer-partners{padding:2.4rem 0 0;text-align:center}
    .footer-partners-label{font-size:.7rem;font-weight:800;letter-spacing:.28em;text-transform:uppercase;color:rgba(255,255,255,.55);margin-bottom:1.2rem}
    .footer-partners-row{display:flex;flex-wrap:wrap;justify-content:center;align-items:center;gap:1.4rem 2.2rem}
    .footer-partner-logo{display:flex;align-items:center;justify-content:center;height:44px;padding:0 .4rem;opacity:.75;filter:grayscale(100%) brightness(1.8);transition:all .3s}
    .footer-partner-logo:hover{opacity:1;filter:none}
    .footer-partner-logo img{height:100%;width:auto;max-width:120px;object-fit:contain}

    .footer-bottom{border-top:1px solid rgba(255,255,255,.12);background:rgba(0,0,0,.18);color:rgba(255,255,255,.55);font-size:.8rem;padding:1.15rem 0;margin-top:3.2rem}
    .footer-bottom-inner{display:flex;justify-content:space-between;align-items:center;gap:1rem;flex-wrap:wrap}
    .footer-copy{display:flex;align-items:center;gap:.8rem;flex-wrap:wrap}
    .footer-copy-sign{font-style:italic;color:rgba(255,255,255,.72)}
    .footer-legal{display:flex;align-items:center;gap:1.2rem;flex-wrap:wrap}
    .footer-legal a{color:rgba(255,255,255,.6);transition:color .25s}
    .footer-legal a:hover{color:#F59E0B}
    .footer-admin-link{display:inline-flex;align-items:center;gap:.35rem;color:rgba(255,255,255,.45) !important;border:1px solid rgba(255,255,255,.18);border-radius:7px;padding:.28rem .6rem;font-size:.76rem}
    .footer-admin-link:hover{color:#F59E0B !important;border-color:rgba(245,158,11,.5)}

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
    .nara-fab .mascot-fab{width:34px;height:34px;display:block}
    .nara-fab .fab-tip{position:absolute;right:calc(100% + 12px);top:50%;transform:translateY(-50%) translateX(6px);background:#0d3a66;color:#fff;font-size:.68rem;font-weight:700;letter-spacing:.08em;padding:.4rem .7rem;border-radius:8px;white-space:nowrap;opacity:0;visibility:hidden;transition:all .2s ease;pointer-events:none;text-transform:uppercase}
    .nara-fab:hover .fab-tip{opacity:1;visibility:visible;transform:translateY(-50%) translateX(0)}
    .nara-fab .nara-status-dot{position:absolute;bottom:2px;right:2px;width:13px;height:13px;border-radius:50%;background:#22c55e;border:2px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,.3)}

    /* ============================================================
       MASKOT NARA — SVG animasi (float pelan + sesekali melambai)
       ============================================================ */
    .skn-mascot{overflow:visible}
    .skn-mascot{animation:mascotFloat 3.4s ease-in-out infinite;transform-origin:50% 90%}
    .skn-mascot .mascot-arm{transform-box:fill-box;transform-origin:100% 55%;animation:mascotWave 5.5s ease-in-out infinite}
    .skn-mascot .mascot-eye{transform-box:fill-box;transform-origin:center;animation:mascotBlink 4.6s ease-in-out infinite}
    .skn-mascot .mascot-antenna-ball{transform-box:fill-box;transform-origin:center;animation:mascotPing 2.6s ease-in-out infinite}

    @keyframes mascotFloat{
      0%,100%{transform:translateY(0) rotate(-1.5deg)}
      50%{transform:translateY(-5px) rotate(1.5deg)}
    }
    @keyframes mascotWave{
      0%,72%,100%{transform:rotate(0deg)}
      78%{transform:rotate(-22deg)}
      84%{transform:rotate(14deg)}
      90%{transform:rotate(-16deg)}
      96%{transform:rotate(4deg)}
    }
    @keyframes mascotBlink{
      0%,90%,100%{transform:scaleY(1)}
      93%{transform:scaleY(.15)}
      96%{transform:scaleY(1)}
    }
    @keyframes mascotPing{
      0%,100%{opacity:1;filter:drop-shadow(0 0 0 rgba(249,168,37,.6))}
      50%{opacity:.85;filter:drop-shadow(0 0 5px rgba(249,168,37,.8))}
    }
    @media(prefers-reduced-motion:reduce){
      .skn-mascot,.skn-mascot .mascot-arm,.skn-mascot .mascot-eye,.skn-mascot .mascot-antenna-ball{animation:none!important}
    }

    /* ============================================================
       BUBBLE SAPAAN OTOMATIS (gaya kartu "Hai! Aku..." TIVA)
       ============================================================ */
    .nara-greet-bubble{
      position:absolute;right:0;bottom:calc(100% + 14px);width:238px;max-width:calc(100vw - 48px);
      display:flex;gap:10px;align-items:flex-start;
      background:#fff;border-radius:16px;border:1px solid rgba(29,111,184,.16);
      box-shadow:0 18px 46px rgba(13,58,102,.22);padding:13px 30px 13px 13px;
      opacity:0;visibility:hidden;transform:translateY(10px) scale(.96);transform-origin:bottom right;
      transition:opacity .3s var(--ease),transform .3s var(--ease),visibility .3s;
      pointer-events:none;z-index:40;
    }
    .nara-greet-bubble.show{opacity:1;visibility:visible;transform:none;pointer-events:auto}
    .nara-greet-bubble::after{
      content:"";position:absolute;bottom:-7px;right:26px;width:14px;height:14px;background:#fff;
      border-right:1px solid rgba(29,111,184,.16);border-bottom:1px solid rgba(29,111,184,.16);transform:rotate(45deg);
    }
    .nara-greet-mascot{width:42px;height:42px;flex:0 0 42px}
    .nara-greet-mascot .skn-mascot{width:100%;height:100%}
    .nara-greet-text{font-size:.76rem;line-height:1.5;color:#33475c}
    .nara-greet-text strong{display:block;color:#0d3a66;font-size:.8rem;margin-bottom:2px}
    .nara-greet-close{
      position:absolute;top:8px;right:8px;width:20px;height:20px;border:0;border-radius:50%;
      background:#eef4fa;color:#7c8ea0;font-size:.8rem;line-height:1;cursor:pointer;
      display:flex;align-items:center;justify-content:center;transition:all .2s;
    }
    .nara-greet-close:hover{background:#dce8f2;color:#33475c}
    body.theme-dark .nara-greet-bubble{background:#102a45;border-color:#1d3a5c}
    body.theme-dark .nara-greet-bubble::after{background:#102a45;border-color:#1d3a5c}
    body.theme-dark .nara-greet-text{color:#c9d8e8}
    body.theme-dark .nara-greet-text strong{color:#eaf2fb}
    body.theme-dark .nara-greet-close{background:#0d2338;color:#8fa8c2}
    @media(max-width:600px){
      .nara-greet-bubble{right:-4px;bottom:calc(100% + 12px)}
    }

    /* Bubble chat masuk dengan sedikit animasi biar lebih hidup */
    .nara-msg{animation:naraMsgIn .32s var(--ease) both}
    @keyframes naraMsgIn{
      from{opacity:0;transform:translateY(6px)}
      to{opacity:1;transform:none}
    }
    @media(prefers-reduced-motion:reduce){
      .nara-msg{animation:none!important}
    }

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

    /* ---------- PANEL NARA (gaya kartu ala TIVA, warna sekolah) ---------- */
    .nara-window{position:fixed;right:24px;bottom:156px;z-index:99999;width:min(380px,calc(100vw - 32px));max-height:min(540px,calc(100vh - 175px));display:flex;flex-direction:column;border-radius:22px;background:linear-gradient(180deg,#eaf6fd,#dcedfa 55%,#eaf6fd);border:1px solid rgba(29,111,184,.14);box-shadow:0 26px 64px rgba(13,58,102,.28);overflow:hidden;opacity:0;visibility:hidden;transform:translateY(10px) scale(.98);transform-origin:bottom right;pointer-events:none;transition:opacity .22s ease,transform .22s ease,visibility .22s}
    .nara-window.open{opacity:1;visibility:visible;transform:none;pointer-events:auto}
    .nara-window.edge-top{position:fixed;top:12px;right:24px;bottom:auto;max-height:calc(100vh - 24px);transform-origin:top right}

    .nara-close-float{position:absolute;top:12px;right:12px;z-index:6;width:30px;height:30px;border:0;border-radius:50%;background:rgba(255,255,255,.85);color:#13518c;cursor:pointer;font-size:.78rem;box-shadow:0 6px 16px rgba(13,58,102,.2);transition:all .2s ease;display:flex;align-items:center;justify-content:center}
    .nara-close-float:hover{background:#fff;transform:rotate(90deg)}

    .nara-hero{position:relative;margin:16px 16px 14px;padding:20px 30px 20px 16px;border-radius:20px;background:#fff;box-shadow:0 16px 40px rgba(13,58,102,.16);display:flex;align-items:center;gap:14px}
    .nara-hero-mascot{flex:0 0 62px;width:62px;height:62px}
    .nara-hero-mascot .skn-mascot{width:100%;height:100%}
    .nara-hero-text{min-width:0;display:flex;flex-direction:column}
    .nara-hero-greet{font-size:.86rem;font-weight:800;color:#17324d;line-height:1.25}
    .nara-hero-name{font-size:.86rem;font-weight:800;color:var(--teal,#1d6fb8);line-height:1.35;margin-top:1px}
    .nara-hero-name span{font-weight:700;color:var(--teal,#1d6fb8);display:block;font-size:.78rem}
    .nara-hero-by{display:flex;align-items:center;gap:.35rem;font-size:.64rem;color:#7c8ea0;margin-top:5px;flex-wrap:wrap}
    .nara-hero-online{width:7px;height:7px;border-radius:50%;background:#22c55e;box-shadow:0 0 6px #22c55e;display:inline-block;animation:naraStatusPulse 1.8s ease-in-out infinite}
    @keyframes naraStatusPulse{0%,100%{opacity:1;box-shadow:0 0 8px #4ade80}50%{opacity:.55;box-shadow:0 0 3px #4ade80}}
    .nara-hero-spark{position:absolute;top:12px;right:14px;color:var(--gold,#f9a825);font-size:1rem;animation:naraSparkPulse 2.4s ease-in-out infinite}
    @keyframes naraSparkPulse{0%,100%{transform:scale(1) rotate(0deg);opacity:.85}50%{transform:scale(1.18) rotate(8deg);opacity:1}}

    .nara-messages{flex:1 1 auto;min-height:180px;overflow-y:auto;padding:10px 16px;display:flex;flex-direction:column;gap:14px;background:transparent;scrollbar-width:thin;scrollbar-color:#a9cbe6 transparent}
    .nara-messages::-webkit-scrollbar{width:6px}
    .nara-messages::-webkit-scrollbar-track{background:transparent}
    .nara-messages::-webkit-scrollbar-thumb{background:#a9cbe6;border-radius:99px}
    .nara-messages::-webkit-scrollbar-thumb:hover{background:#7fb3dd}

    .nara-msg{display:flex;align-items:flex-end;gap:8px;max-width:86%}
    .nara-msg.user{margin-left:auto;flex-direction:row-reverse}
    .nara-bubble{padding:.68rem 1rem;border-radius:18px;font-size:.8rem;line-height:1.5;background:linear-gradient(135deg,var(--teal,#1d6fb8),var(--teal-light,#28a9e1));color:#fff;box-shadow:0 6px 16px rgba(29,111,184,.22);transition:box-shadow .2s ease}
    .nara-msg:not(.user) .nara-bubble:hover{box-shadow:0 8px 20px rgba(29,111,184,.3)}
    .nara-msg.user .nara-bubble{background:#fff;color:#20364d;box-shadow:0 4px 14px rgba(13,58,102,.12)}
    .nara-time{font-size:.6rem;color:#6d84a0;white-space:nowrap;margin-bottom:2px}
    .nara-msg.user .nara-time{color:#8a9aaa}
    .nara-bubble .typing-dot{background:rgba(255,255,255,.85)}

    .nara-msg-content{display:flex;flex-direction:column;gap:8px;width:100%}
    .nara-quick-inchat{display:grid;grid-template-columns:repeat(2,1fr);gap:8px;margin-top:4px;width:100%}
    .nara-quick-card{display:flex;align-items:center;gap:8px;padding:8px 10px;background:#ffffff;border:1px solid #e2e8f0;border-radius:12px;cursor:pointer;transition:all .2s ease;text-align:left;box-shadow:0 2px 6px rgba(0,0,0,.03);font-family:inherit}
    .nara-quick-card:hover{border-color:var(--teal,#1d6fb8);background:#f0f7ff;transform:translateY(-1.5px);box-shadow:0 4px 12px rgba(29,111,184,.14)}
    .nara-quick-card:active{transform:translateY(0)}
    .nara-qc-icon{width:26px;height:26px;border-radius:8px;background:rgba(29,111,184,.08);color:var(--teal,#1d6fb8);display:flex;align-items:center;justify-content:center;font-size:.72rem;flex:0 0 26px;transition:all .2s ease}
    .nara-quick-card:hover .nara-qc-icon{background:var(--teal,#1d6fb8);color:#fff}
    .nara-qc-text{font-size:.72rem;font-weight:700;color:#1e293b;flex:1;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .nara-qc-arrow{font-size:.6rem;color:#cbd5e1;transition:transform .2s ease}
    .nara-quick-card:hover .nara-qc-arrow{color:var(--teal,#1d6fb8);transform:translateX(2px)}

    .nara-input-pill{display:flex;align-items:center;gap:2px;margin:14px 16px 18px;padding:6px 6px 6px 16px;background:#fff;border-radius:999px;box-shadow:0 14px 30px rgba(13,58,102,.18)}
    .nara-input{flex:1;min-width:0;border:0;outline:0;background:transparent;padding:.4rem 0;font-size:.8rem;font-family:inherit;color:#20364d}
    .nara-input::placeholder{color:#9db4c8}
    .nara-clear{width:32px;height:32px;flex:0 0 32px;border:0;border-radius:50%;background:transparent;color:#9db4c8;cursor:pointer;font-size:.8rem;display:flex;align-items:center;justify-content:center;transition:all .2s ease}
    .nara-clear:hover{color:#e0554a;background:rgba(224,85,74,.1)}
    .nara-send{width:40px;height:40px;flex:0 0 40px;border:0;border-radius:50%;background:linear-gradient(135deg,var(--gold,#f9a825),#fbbf24);color:#4a2c00;font-size:.9rem;cursor:pointer;transition:transform .2s ease,box-shadow .2s ease;display:flex;align-items:center;justify-content:center;animation:naraSendPulse 2.8s ease-in-out infinite}
    .nara-send:hover{transform:scale(1.09);animation-play-state:paused;box-shadow:0 6px 16px rgba(249,168,37,.5)}
    .nara-send:active{transform:scale(.94)}
    @keyframes naraSendPulse{0%,100%{box-shadow:0 0 0 0 rgba(249,168,37,.35)}50%{box-shadow:0 0 0 6px rgba(249,168,37,0)}}
    @media(prefers-reduced-motion:reduce){.nara-send{animation:none!important}.nara-hero-spark{animation:none!important}.nara-hero-online{animation:none!important}}

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
    body.theme-dark .acc-panel{background:#102a45;border-color:#1d3a5c}
    body.theme-dark .nara-window{background:linear-gradient(180deg,#0d2338,#0a1f33 55%,#0d2338);border-color:#1d3a5c}
    body.theme-dark .acc-body{background:#0d2338}
    body.theme-dark .acc-row-name,body.theme-dark .mode-card-name{color:#eaf2fb}
    body.theme-dark .mode-card{background:#102a45;border-color:#1d3a5c}
    body.theme-dark .acc-seg{background:#0d2338}
    body.theme-dark .acc-seg-btn{color:#c9d8e8}
    body.theme-dark .nara-hero{background:#15314f;box-shadow:0 16px 40px rgba(0,0,0,.35)}
    body.theme-dark .nara-hero-greet{color:#eaf2fb}
    body.theme-dark .nara-hero-by{color:#8fa8c2}
    body.theme-dark .nara-msg.user .nara-bubble{background:#1d3a5c;color:#e3edf6}
    body.theme-dark .nara-input-pill{background:#15314f;box-shadow:0 14px 30px rgba(0,0,0,.35)}
    body.theme-dark .nara-input{color:#e3edf6}
    body.theme-dark .nara-input::placeholder{color:#7c93ac}
    body.theme-dark .nara-quick-btn{background:#15314f;border-color:#1d3a5c;color:#bcd8ef}
    body.theme-dark .nara-close-float{background:rgba(21,49,79,.85);color:#eaf2fb}
    body.theme-dark .acc-reset{background:#0d2338;border-color:#1d3a5c;color:#c9d8e8}

    /* ---------- DARK MODE — PATCH LANJUTAN (elemen yang masih hardcode terang) ---------- */
    body.theme-dark .dropdown-menu{background:rgba(16,42,69,.98);border-color:rgba(255,255,255,.1);box-shadow:0 20px 50px rgba(0,0,0,.45)}
    body.theme-dark .dropdown-menu a{color:#dce8f2}
    body.theme-dark .dropdown-menu a i{color:#5bb3ea}
    body.theme-dark .dropdown-menu a:hover{background:rgba(255,255,255,.06);color:#ffd54f}

    body.theme-dark .acc-row-name-wrap>i{background:#0d2338;color:#5bb3ea}
    body.theme-dark .acc-row-desc{color:#8fa8c2}
    body.theme-dark .acc-switch{background:#1d3a5c}
    body.theme-dark .acc-switch span{background:#eaf2fb}
    body.theme-dark .acc-switch.on{background:#1d6fb8}

    body.theme-dark .mode-card:hover{border-color:#3f7fb8}
    body.theme-dark .mode-card.active{background:#0d2338;border-color:#28a9e1;box-shadow:0 0 0 3px rgba(40,169,225,.18)}
    body.theme-dark .mode-card-preview{background:#0d2338}
    body.theme-dark .pv-line{background:#2a4a68}
    body.theme-dark .mode-toggle-single{background:#102a45;border-color:#1d3a5c}
    body.theme-dark .mode-toggle-single:hover{border-color:#3f7fb8}
    body.theme-dark .mode-toggle-icon{background:#0d2338}
    body.theme-dark .mode-toggle-name{color:#eaf2fb}

    body.theme-dark .sibot-window{border-color:#1d3a5c}
    body.theme-dark .sibot-messages{background:#0a1f33}
    body.theme-dark .msg-bubble{background:#102a45;border-color:#1d3a5c;color:#dce8f2}
    body.theme-dark .msg-user .msg-bubble{color:#fff}
    body.theme-dark .sibot-quick,body.theme-dark .sibot-input-row{background:#102a45;border-color:#1d3a5c}
    body.theme-dark .quick-btn{background:#0d2338;border-color:#1d3a5c;color:#c9d8e8}
    body.theme-dark .sibot-input{background:#0d2338;border-color:#1d3a5c;color:#eaf2fb}

    body.theme-dark .bg-blob{opacity:.28}
    body.theme-dark #cursorGlow{opacity:.7}
    body.theme-dark .footer-partner-logo{filter:grayscale(100%) brightness(2.4) contrast(.85)}

    /* ---------- DARK MODE — NAVBAR & ANNOUNCE BAR ---------- */
    body.theme-dark .announce-bar{
      background:linear-gradient(90deg,#051019,#0d2338,#051019);
      border-bottom-color:rgba(255,255,255,.08);
    }
    body.theme-dark #navbar .nav-inner{
      background:linear-gradient(135deg,#081c30,#102a45);
      border-bottom-color:rgba(255,255,255,.1);
      box-shadow:0 10px 34px rgba(0,0,0,.45),inset 0 1px 0 rgba(255,255,255,.08);
    }
    body.theme-dark #navbar.scrolled .nav-inner{
      background:linear-gradient(135deg,#051019,#0d2338);
      box-shadow:0 14px 44px rgba(0,0,0,.55);
      border-bottom-color:rgba(255,255,255,.06);
    }
    body.theme-dark .nav-brand-text strong{color:#eaf2fb}
    body.theme-dark .nav-brand-text .brand-sub{color:#ffd54f}
    body.theme-dark .nav-link{color:rgba(255,255,255,.72)}
    body.theme-dark .nav-link:hover,
    body.theme-dark .nav-link.active{color:#ffd54f !important}
    @media(max-width:900px){
      body.theme-dark .nav-menu{background:rgba(5,16,25,.97)}
    }

    @media(max-width:600px){
      .skn-stack{right:12px;bottom:12px;gap:12px}
      .skn-stack.skn-intro-safe{right:12px;bottom:150px}
      .acc-fab{width:50px;height:50px;font-size:24px}
      .acc-fab .acc-fab-icon,.acc-fab .acc-fab-icon i{font-size:24px}
      .nara-fab{width:54px;height:54px}
      .nara-fab i{font-size:24px}
      .acc-panel{position:fixed;left:12px;right:12px;bottom:132px;width:auto;max-width:none;top:auto;transform:translateY(8px) scale(.98)}
      .acc-panel.open{transform:none}
      .nara-window{position:fixed;left:12px;right:12px;bottom:140px;width:auto;max-width:none;top:auto;max-height:calc(100vh - 155px);transform:translateY(8px) scale(.98)}
      .nara-window.open{transform:none}
      .acc-body{max-height:none}
      .nara-messages{height:280px}
      .nara-quick{grid-template-columns:repeat(3,1fr);gap:5px;padding:8px 10px}
      .nara-quick-btn{font-size:.6rem;padding:.4rem .2rem;white-space:nowrap}
      .fab-tip{display:none!important}
    }
</style>

  {{-- CSS tambahan khusus per halaman --}}
  @stack('styles')

  {{-- ================= GLOBAL DARK MODE STYLES (Supports ALL Pages) ================= --}}
  <style>
    /* Global Base Dark Mode Theme Overrides */
    body.theme-dark, html.theme-dark body {
      background-color: #061221 !important;
      color: #eaf2fb !important;
    }

    /* Headings, Titles & Accents */
    body.theme-dark h1, body.theme-dark h2, body.theme-dark h3, 
    body.theme-dark h4, body.theme-dark h5, body.theme-dark h6,
    body.theme-dark .section-title, body.theme-dark .big-heading, body.theme-dark .heading,
    body.theme-dark .bkk-heading, body.theme-dark .vt-title, body.theme-dark .cc-title,
    body.theme-dark .card-title, body.theme-dark .teacher-name, body.theme-dark .person-name,
    body.theme-dark .kg-card-title, body.theme-dark .br-card-title, body.theme-dark .news-title,
    body.theme-dark .fc-card h3, body.theme-dark .am-proc h2, body.theme-dark .am-podium-name,
    body.theme-dark .bkk-title .navy, body.theme-dark .ft-title, body.theme-dark .ft-row-title,
    body.theme-dark .vm-card h3, body.theme-dark .misi-item h4, body.theme-dark .bkk-card h3,
    body.theme-dark .bkk-service h4, body.theme-dark .bkk-job h3, body.theme-dark .bkk-year-head h3,
    body.theme-dark .bkk-person strong, body.theme-dark .bkk-tracer-card h4, body.theme-dark .side-title-text {
      color: #f4f8fc !important;
    }

    /* Paragraphs, Subtitles & Secondary Text */
    body.theme-dark p, body.theme-dark .section-desc, body.theme-dark .intro-copy,
    body.theme-dark .lead, body.theme-dark .sub-text, body.theme-dark .desc,
    body.theme-dark .bkk-lead, body.theme-dark .bkk-sub, body.theme-dark .bkk-card p,
    body.theme-dark .bkk-service p, body.theme-dark .bkk-job p, body.theme-dark .bkk-event p,
    body.theme-dark .bkk-person span, body.theme-dark .bkk-tracer-card p,
    body.theme-dark .teacher-subject, body.theme-dark .person-role, body.theme-dark .org-subtitle,
    body.theme-dark .cc-desc, body.theme-dark .vt-desc, body.theme-dark .news-excerpt,
    body.theme-dark .br-card-desc, body.theme-dark .fc-card p, body.theme-dark .ft-row-sub,
    body.theme-dark .misi-item p, body.theme-dark .tujuan-item p {
      color: #94b3d4 !important;
    }

    /* Strong text */
    body.theme-dark strong, body.theme-dark b {
      color: #ffffff !important;
    }

    /* Navbar & Preloader & Announce Bar */
    body.theme-dark #navbar {
      background: rgba(6, 18, 33, 0.96) !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    }
    body.theme-dark .nav-brand-text strong { color: #f4f8fc !important; }
    body.theme-dark .nav-link { color: #dce8f2 !important; }
    body.theme-dark .nav-link:hover, body.theme-dark .nav-link.active { color: #ffd54a !important; }
    body.theme-dark .announce-bar {
      background: #091a2e !important;
      color: #bcd8ef !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important;
    }
    body.theme-dark #preloader { background: #061221 !important; }
    body.theme-dark .preloader-text { color: #f4f8fc !important; }

    /* Page Section Containers */
    body.theme-dark section,
    body.theme-dark .section-py,
    body.theme-dark .hd-hero,
    body.theme-dark .vt-section,
    body.theme-dark .window-section,
    body.theme-dark .jurusan-section,
    body.theme-dark .fast-track-sec,
    body.theme-dark .out-sec,
    body.theme-dark .out-alumni,
    body.theme-dark .out-industry,
    body.theme-dark .out-ptn,
    body.theme-dark .prestasi-section,
    body.theme-dark .kontak-section,
    body.theme-dark .history-page,
    body.theme-dark .history-hero,
    body.theme-dark .history-intro,
    body.theme-dark .timeline-section,
    body.theme-dark .history-book-section,
    body.theme-dark .vm-page,
    body.theme-dark .vm-hero,
    body.theme-dark .vm-section,
    body.theme-dark .so-page,
    body.theme-dark .so-hero,
    body.theme-dark .so-section,
    body.theme-dark .gs-page,
    body.theme-dark .gs-hero,
    body.theme-dark .gs-section,
    body.theme-dark .tour-page,
    body.theme-dark .tour-hero,
    body.theme-dark .tour-sec,
    body.theme-dark .tentang-section,
    body.theme-dark .belajar-section,
    body.theme-dark .praktik-section,
    body.theme-dark .fasilitas-section,
    body.theme-dark .produk-section,
    body.theme-dark .kegiatan-section,
    body.theme-dark .prospek-section,
    body.theme-dark .industry-collab,
    body.theme-dark .vid-section,
    body.theme-dark .ppdb-page,
    body.theme-dark .ppdb-hero,
    body.theme-dark .ppdb-section,
    body.theme-dark .ek-page,
    body.theme-dark .ek-hero,
    body.theme-dark .ek-sec,
    body.theme-dark .karya-page,
    body.theme-dark .karya-hero,
    body.theme-dark .karya-sec,
    body.theme-dark .prestasi-page,
    body.theme-dark .prestasi-hero,
    body.theme-dark .prestasi-sec,
    body.theme-dark .voice-page,
    body.theme-dark .voice-hero,
    body.theme-dark .voice-sec,
    body.theme-dark .br-page,
    body.theme-dark .br-hero,
    body.theme-dark .br-sec,
    body.theme-dark .br-story,
    body.theme-dark .br-cta,
    body.theme-dark .fc-page,
    body.theme-dark .fc-hero,
    body.theme-dark .fc-sec,
    body.theme-dark .kg-page,
    body.theme-dark .kg-hero,
    body.theme-dark .kg-sec,
    body.theme-dark .bkk-page,
    body.theme-dark .bkk-hero,
    body.theme-dark .bkk-section,
    body.theme-dark .bkk-jobs,
    body.theme-dark .alumni-page,
    body.theme-dark .alumni-hero,
    body.theme-dark .alumni-sec,
    body.theme-dark .ai-page,
    body.theme-dark .am-page,
    body.theme-dark .am-hero,
    body.theme-dark .am-proc {
      background-color: #061221 !important;
      color: #eaf2fb !important;
    }

    /* Alternating section contrast backgrounds */
    body.theme-dark .vt-section,
    body.theme-dark .jurusan-section,
    body.theme-dark .out-sec,
    body.theme-dark .bkk-jobs,
    body.theme-dark .belajar-section,
    body.theme-dark .fasilitas-section,
    body.theme-dark .kegiatan-section,
    body.theme-dark .br-story,
    body.theme-dark .history-intro {
      background-color: #09182b !important;
    }

    /* Universal Cards, Panels & Boxes */
    body.theme-dark .card,
    body.theme-dark .sec-card,
    body.theme-dark .feature-card,
    body.theme-dark .info-card,
    body.theme-dark .stat-box,
    body.theme-dark .stat-card,
    body.theme-dark .item-card,
    body.theme-dark .shadow-card,
    body.theme-dark .glass-card,
    body.theme-dark .box,
    body.theme-dark .panel,
    body.theme-dark .cc-card,
    body.theme-dark .cc-body,
    body.theme-dark .ft-card,
    body.theme-dark .out-card,
    body.theme-dark .alumni-card,
    body.theme-dark .industry-card,
    body.theme-dark .ptn-card,
    body.theme-dark .prestasi-card,
    body.theme-dark .kontak-card,
    body.theme-dark .window-frame,
    body.theme-dark .ws-inner,
    body.theme-dark .ws-card,
    body.theme-dark .principal-quote-box,
    body.theme-dark .history-book,
    body.theme-dark .book-spread,
    body.theme-dark .book-page,
    body.theme-dark .book-cover,
    body.theme-dark .vm-card,
    body.theme-dark .misi-card,
    body.theme-dark .tujuan-card,
    body.theme-dark .misi-item,
    body.theme-dark .tujuan-item,
    body.theme-dark .so-card,
    body.theme-dark .person-card,
    body.theme-dark .tree-node,
    body.theme-dark .org-box,
    body.theme-dark .teacher-card,
    body.theme-dark .staff-card,
    body.theme-dark .gs-card,
    body.theme-dark .scene-card,
    body.theme-dark .hotspot-card,
    body.theme-dark .proli-card,
    body.theme-dark .competency-card,
    body.theme-dark .facility-card,
    body.theme-dark .career-card,
    body.theme-dark .product-card,
    body.theme-dark .head-card,
    body.theme-dark .collab-card,
    body.theme-dark .ppdb-card,
    body.theme-dark .step-card,
    body.theme-dark .requirement-card,
    body.theme-dark .faq-card,
    body.theme-dark .accordion-item,
    body.theme-dark .ek-card,
    body.theme-dark .karya-card,
    body.theme-dark .work-card,
    body.theme-dark .medal-box,
    body.theme-dark .voice-card,
    body.theme-dark .form-card,
    body.theme-dark .aspiration-card,
    body.theme-dark .br-card,
    body.theme-dark .br-featured,
    body.theme-dark .news-card,
    body.theme-dark .sidebar-card,
    body.theme-dark .fact-card,
    body.theme-dark .fc-card,
    body.theme-dark .fc-fact-card,
    body.theme-dark .kg-card,
    body.theme-dark .galeri-card,
    body.theme-dark .bkk-card,
    body.theme-dark .bkk-service,
    body.theme-dark .bkk-job,
    body.theme-dark .bkk-year,
    body.theme-dark .bkk-person,
    body.theme-dark .bkk-tracer-card,
    body.theme-dark .portfolio-card,
    body.theme-dark .story-card,
    body.theme-dark .am-card,
    body.theme-dark .ai-card {
      background-color: #102744 !important;
      border: 1px solid rgba(255, 255, 255, 0.09) !important;
      color: #eaf2fb !important;
      box-shadow: 0 14px 40px rgba(0, 0, 0, 0.4) !important;
    }

    /* Regular Form Controls & Textareas (Dark theme for standalone form fields) */
    body.theme-dark textarea,
    body.theme-dark select,
    body.theme-dark .form-control,
    body.theme-dark .db-form-control,
    body.theme-dark .ev-input {
      background-color: #0d213a !important;
      color: #eaf2fb !important;
      border: 1px solid rgba(40, 169, 225, 0.3) !important;
    }
    body.theme-dark textarea::placeholder,
    body.theme-dark select::placeholder,
    body.theme-dark .form-control::placeholder,
    body.theme-dark .db-form-control::placeholder,
    body.theme-dark .ev-input::placeholder {
      color: #7995b5 !important;
    }

    /* ALL SEARCH BARS & SEARCH INPUTS — ALWAYS CLEAN WHITE & DARK TEXT (NO BLUE COLOR BLOCK) */
    body.theme-dark .so-search,
    body.theme-dark .sg-search,
    body.theme-dark .br-search,
    body.theme-dark .fc-search,
    body.theme-dark .so-toolbar,
    body.theme-dark .sg-toolbar,
    body.theme-dark .search-box,
    body.theme-dark .search-wrapper,
    body.theme-dark .search-bar,
    body.theme-dark .search-group,
    body.theme-dark .search-container,
    body.theme-dark .br-search-box,
    body.theme-dark .fc-side-card .fc-search,
    body.theme-dark div[class*="search"],
    body.theme-dark div[class*="Search"] {
      background: #ffffff !important;
      background-color: #ffffff !important;
      border: 1px solid rgba(13, 58, 102, 0.18) !important;
    }

    body.theme-dark .so-search input,
    body.theme-dark .sg-search input,
    body.theme-dark .br-search input,
    body.theme-dark .fc-search input,
    body.theme-dark .so-toolbar input,
    body.theme-dark .sg-toolbar input,
    body.theme-dark .search-box input,
    body.theme-dark .search-wrapper input,
    body.theme-dark .search-bar input,
    body.theme-dark .search-group input,
    body.theme-dark .search-container input,
    body.theme-dark .br-search-box input,
    body.theme-dark [class*="search"] input,
    body.theme-dark [class*="Search"] input,
    body.theme-dark input#soSearchInput,
    body.theme-dark input#sgSearchInput,
    body.theme-dark input#brSearch,
    body.theme-dark input#fcSearchInput,
    body.theme-dark input#evoiceSearch,
    body.theme-dark input#factSearch,
    body.theme-dark input#teacherSearch,
    body.theme-dark input#dbSearchGlobal,
    body.theme-dark input[type="search"],
    body.theme-dark input[placeholder*="Cari"],
    body.theme-dark input[placeholder*="cari"],
    body.theme-dark input[placeholder*="Search"],
    body.theme-dark input[placeholder*="search"] {
      background: transparent !important;
      background-color: transparent !important;
      color: #0d3a66 !important;
      border: none !important;
      outline: none !important;
      box-shadow: none !important;
    }

    body.theme-dark .so-search input::placeholder,
    body.theme-dark .sg-search input::placeholder,
    body.theme-dark .br-search input::placeholder,
    body.theme-dark .fc-search input::placeholder,
    body.theme-dark .so-toolbar input::placeholder,
    body.theme-dark .sg-toolbar input::placeholder,
    body.theme-dark .search-box input::placeholder,
    body.theme-dark .search-wrapper input::placeholder,
    body.theme-dark .search-bar input::placeholder,
    body.theme-dark [class*="search"] input::placeholder,
    body.theme-dark input#soSearchInput::placeholder,
    body.theme-dark input#sgSearchInput::placeholder,
    body.theme-dark input#brSearch::placeholder,
    body.theme-dark input#fcSearchInput::placeholder,
    body.theme-dark input#evoiceSearch::placeholder,
    body.theme-dark input#factSearch::placeholder,
    body.theme-dark input#teacherSearch::placeholder,
    body.theme-dark input#dbSearchGlobal::placeholder,
    body.theme-dark input[type="search"]::placeholder,
    body.theme-dark input[placeholder*="Cari"]::placeholder,
    body.theme-dark input[placeholder*="cari"]::placeholder,
    body.theme-dark input[placeholder*="Search"]::placeholder,
    body.theme-dark input[placeholder*="search"]::placeholder {
      color: #8fa3b6 !important;
    }

    body.theme-dark .so-search i,
    body.theme-dark .sg-search i,
    body.theme-dark .br-search i,
    body.theme-dark .fc-search i,
    body.theme-dark .search-box i,
    body.theme-dark .search-bar i,
    body.theme-dark [class*="search"] i {
      color: #2f6fa8 !important;
    }

    body.theme-dark .so-fchip,
    body.theme-dark .sg-fchip,
    body.theme-dark .br-filter-btn {
      background: #ffffff !important;
      color: #0d3a66 !important;
      border: 1px solid rgba(13, 58, 102, 0.18) !important;
    }
    body.theme-dark .so-fchip.is-active,
    body.theme-dark .sg-fchip.is-active,
    body.theme-dark .br-filter-btn.active {
      background: linear-gradient(135deg, #0d3a66, #2f6fa8) !important;
      color: #ffffff !important;
      border-color: transparent !important;
    }

    /* Ekstra Matchmaker Quiz Stage Dark Theme */
    body.theme-dark .qz-stage {
      background: linear-gradient(145deg, #0d2338 0%, #102a45 100%) !important;
      border: 1px solid #1d3a5c !important;
      box-shadow: 0 24px 60px rgba(0, 0, 0, 0.45) !important;
    }
    body.theme-dark .qz-question {
      color: #f4f8fc !important;
    }
    body.theme-dark .qz-question-tag {
      background: rgba(136, 84, 208, 0.22) !important;
      color: #d6bbfb !important;
      border: 1px solid rgba(136, 84, 208, 0.35) !important;
    }
    body.theme-dark .qz-qcounter {
      background: #15314f !important;
      color: #d6bbfb !important;
      border: 1px solid #1d3a5c !important;
    }
    body.theme-dark .qz-qcounter i { color: #a879f9 !important; }
    body.theme-dark .qz-timer-track { stroke: #1d3a5c !important; }
    body.theme-dark .qz-timer span { color: #d6bbfb !important; }
    body.theme-dark .qz-progressbar { background: #15314f !important; }
    body.theme-dark .qz-back {
      background: #15314f !important;
      color: #c9d8e8 !important;
      border-color: #1d3a5c !important;
    }
    body.theme-dark .qz-back:hover {
      border-color: #a879f9 !important;
      color: #ffffff !important;
    }

    /* Tabs, Pills & Badges */
    body.theme-dark .ek-tab,
    body.theme-dark .filter-pill,
    body.theme-dark .category-pill,
    body.theme-dark .kg-filter-pill,
    body.theme-dark .filter-btn,
    body.theme-dark .bkk-tag,
    body.theme-dark .bkk-key,
    body.theme-dark .bkk-pill,
    body.theme-dark .vt-feat {
      background-color: #0d213a !important;
      color: #94b3d4 !important;
      border: 1px solid rgba(255, 255, 255, 0.1) !important;
    }
    body.theme-dark .ek-tab.active,
    body.theme-dark .filter-pill.active,
    body.theme-dark .category-pill.active,
    body.theme-dark .kg-filter-pill.active,
    body.theme-dark .filter-btn.active {
      background-color: #1d6fb8 !important;
      color: #ffffff !important;
      border-color: #28a9e1 !important;
    }

    /* Accordions & Tables */
    body.theme-dark .accordion-button {
      background-color: #0d213a !important;
      color: #f4f8fc !important;
    }
    body.theme-dark table,
    body.theme-dark .table,
    body.theme-dark .schedule-table,
    body.theme-dark .table-ppdb {
      background-color: #0d213a !important;
      color: #eaf2fb !important;
    }
    body.theme-dark table th,
    body.theme-dark .table th,
    body.theme-dark .schedule-table th,
    body.theme-dark .table-ppdb th {
      background-color: #07172b !important;
      color: #f4f8fc !important;
      border-color: rgba(255, 255, 255, 0.1) !important;
    }
    body.theme-dark table td,
    body.theme-dark .table td,
    body.theme-dark .schedule-table td,
    body.theme-dark .table-ppdb td {
      border-color: rgba(255, 255, 255, 0.06) !important;
      color: #eaf2fb !important;
    }

    /* BKK Special Component Overrides */
    body.theme-dark .bkk-kicker {
      background: #0d213a !important;
      color: #ffd54a !important;
      border-color: rgba(255,213,74,0.3) !important;
    }
    body.theme-dark .bkk-vision {
      background: #0d2746 !important;
      border-color: rgba(255,213,74,0.3) !important;
    }
    body.theme-dark .bkk-icon {
      background: #0d213a !important;
      color: #38bdf8 !important;
    }
    body.theme-dark .bkk-strip { background: #09182b !important; }

    /* Sejarah Book Section Tweaks */
    body.theme-dark .page-left, body.theme-dark .page-right {
      background: #0b1d33 !important;
    }

    /* -----------------------------------------------------------------
       DARK MODE FIXES — WELCOME PAGE (Jurusan Cards, Alumni, PTN, Industry)
       ----------------------------------------------------------------- */

    /* 1. Jurusan Card Subtitle Fix (Text under RPL, KULINER, etc.) */
    body.theme-dark .cc-full {
      color: #f4f8fc !important;
    }

    /* 2. Lulusan Terbaik / Featured Alumni Section Dark Mode */
    body.theme-dark .out-alumni,
    body.theme-dark .out-sec.out-alumni {
      background: #061221 !important;
      background-color: #061221 !important;
      color: #eaf2fb !important;
    }
    body.theme-dark .out-alumni .out-copy::before {
      color: rgba(255, 255, 255, 0.04) !important;
    }
    body.theme-dark .out-alumni .out-kicker {
      color: #ffb300 !important;
    }
    body.theme-dark .out-alumni .out-title {
      color: #f4f8fc !important;
    }
    body.theme-dark .out-alumni .out-desc {
      color: #c9d8e8 !important;
    }
    body.theme-dark .out-alumni .out-route-node {
      background: #0d213a !important;
      color: #c9d8e8 !important;
      border-color: rgba(255, 255, 255, 0.1) !important;
    }
    body.theme-dark .out-alumni .out-route-node.gold {
      background: rgba(255, 179, 0, 0.18) !important;
      color: #ffd54a !important;
      border-color: rgba(255, 179, 0, 0.3) !important;
    }
    body.theme-dark .out-alumni .out-jurusan-label span {
      color: #92a0ae !important;
    }
    body.theme-dark .out-alumni .out-jurusan-label small {
      color: #8198b0 !important;
    }
    body.theme-dark .out-alumni .out-jurusan-pill {
      background: #0d213a !important;
      color: #c9d8e8 !important;
      border-color: rgba(255, 255, 255, 0.1) !important;
    }
    body.theme-dark .out-alumni .out-jurusan-pill.active {
      background: #1d6fb8 !important;
      color: #ffffff !important;
      border-color: #28a9e1 !important;
      box-shadow: 0 10px 22px rgba(0, 0, 0, 0.4) !important;
    }
    body.theme-dark .out-alumni .out-id-viewport {
      background: linear-gradient(135deg, rgba(13, 58, 102, 0.5), rgba(29, 111, 184, 0.25)) !important;
      box-shadow: 0 28px 75px rgba(0, 0, 0, 0.5) !important;
    }
    body.theme-dark .out-alumni .out-id-card {
      background: linear-gradient(145deg, #102744 0%, #0d2338 100%) !important;
      border-color: rgba(255, 255, 255, 0.12) !important;
      color: #eaf2fb !important;
      box-shadow: 0 18px 45px rgba(0, 0, 0, 0.45) !important;
    }
    body.theme-dark .out-alumni .out-id-photo {
      background: #09182b !important;
      box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.1), 0 12px 28px rgba(0, 0, 0, 0.4) !important;
    }
    body.theme-dark .out-alumni .out-id-brand {
      color: #f4f8fc !important;
    }
    body.theme-dark .out-alumni .out-id-code {
      color: #8fa8c2 !important;
    }
    body.theme-dark .out-alumni .out-id-name {
      color: #ffffff !important;
    }
    body.theme-dark .out-alumni .out-id-role {
      color: #ffd54a !important;
    }
    body.theme-dark .out-alumni .out-id-meta div {
      background: #0d213a !important;
      border: 1px solid rgba(255, 255, 255, 0.08) !important;
    }
    body.theme-dark .out-alumni .out-id-meta div small {
      color: #8fa8c2 !important;
    }
    body.theme-dark .out-alumni .out-id-meta div b {
      color: #ffffff !important;
    }
    body.theme-dark .out-alumni .out-id-chip {
      background: #0d213a !important;
      color: #ffd54a !important;
      border-color: rgba(255, 213, 74, 0.3) !important;
    }
    body.theme-dark .out-alumni .out-arrow {
      background: #102744 !important;
      border-color: rgba(255, 255, 255, 0.15) !important;
      color: #ffffff !important;
      box-shadow: 0 8px 22px rgba(0, 0, 0, 0.3) !important;
    }
    body.theme-dark .out-alumni .out-arrow:hover {
      background: #1d6fb8 !important;
      color: #ffffff !important;
    }
    body.theme-dark .out-alumni .out-dot {
      background: rgba(255, 255, 255, 0.25) !important;
    }
    body.theme-dark .out-alumni .out-dot.active {
      background: #ffb300 !important;
    }

    /* 3. Lulusan PTN Section Dark Mode */
    body.theme-dark .out-ptn,
    body.theme-dark .out-sec.out-ptn {
      background: #061221 !important;
      background-color: #061221 !important;
      color: #eaf2fb !important;
    }
    body.theme-dark .out-ptn::before {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px), linear-gradient(45deg, rgba(255, 179, 0, 0.02) 1px, transparent 1px) !important;
    }
    body.theme-dark .out-ptn .out-copy::after {
      color: rgba(255, 255, 255, 0.04) !important;
    }
    body.theme-dark .out-ptn .out-kicker {
      color: #ffb300 !important;
    }
    body.theme-dark .out-ptn .out-title {
      color: #f4f8fc !important;
    }
    body.theme-dark .out-ptn .out-desc {
      color: #c9d8e8 !important;
    }
    body.theme-dark .out-ptn-route>span {
      background: #0d213a !important;
      color: #c9d8e8 !important;
      border-color: rgba(255, 255, 255, 0.1) !important;
    }
    body.theme-dark .out-ptn-route>span.gold {
      background: rgba(255, 179, 0, 0.18) !important;
      color: #ffd54a !important;
      border-color: rgba(255, 179, 0, 0.3) !important;
    }
    body.theme-dark .out-ptn-window {
      background: linear-gradient(135deg, rgba(13, 58, 102, 0.4), rgba(255, 179, 0, 0.15)) !important;
      box-shadow: 0 24px 64px rgba(0, 0, 0, 0.45) !important;
      border-color: rgba(255, 255, 255, 0.1) !important;
    }
    body.theme-dark .out-ptn-window::after {
      color: rgba(255, 255, 255, 0.1) !important;
    }
    body.theme-dark .out-ptn-destination-card {
      background: linear-gradient(145deg, #102744 0%, #0d2338 100%) !important;
      border-color: rgba(255, 255, 255, 0.12) !important;
      box-shadow: 0 18px 46px rgba(0, 0, 0, 0.45) !important;
    }
    body.theme-dark .out-ptn-card-top {
      border-bottom-color: rgba(255, 255, 255, 0.08) !important;
    }
    body.theme-dark .out-ptn-card-kicker {
      color: #ffb300 !important;
    }
    body.theme-dark .out-ptn-card-mark {
      background: #0d213a !important;
      color: #5bb3ea !important;
      border-color: rgba(255, 255, 255, 0.1) !important;
    }
    body.theme-dark .out-ptn-logo-panel {
      border-right-color: rgba(255, 255, 255, 0.08) !important;
      border-bottom-color: rgba(255, 255, 255, 0.08) !important;
    }
    body.theme-dark .out-ptn-logo-panel small {
      color: #8fa8c2 !important;
    }
    body.theme-dark .out-ptn-logo {
      background: #0d213a !important;
      border-color: rgba(255, 255, 255, 0.12) !important;
      box-shadow: 0 18px 36px rgba(0, 0, 0, 0.4), 0 0 0 9px rgba(255, 179, 0, 0.06) !important;
    }
    body.theme-dark .out-ptn-logo span {
      color: #f4f8fc !important;
    }
    body.theme-dark .out-ptn-label {
      color: #8fa8c2 !important;
    }
    body.theme-dark .out-ptn-card-info h3 {
      color: #ffffff !important;
    }
    body.theme-dark .out-ptn-card-info p {
      color: #c9d8e8 !important;
    }
    body.theme-dark .out-ptn-student {
      background: #0d213a !important;
      border-color: rgba(255, 179, 0, 0.25) !important;
      color: #f4f8fc !important;
      box-shadow: 0 7px 18px rgba(0, 0, 0, 0.3) !important;
    }
    body.theme-dark .ptn-student-slide .ptn-student-detail {
      color: #94b3d4 !important;
    }
    body.theme-dark .out-ptn-card-bottom {
      border-top-color: rgba(255, 255, 255, 0.08) !important;
      color: #8fa8c2 !important;
    }
    body.theme-dark .out-ptn-card-bottom span:first-child {
      color: #f4f8fc !important;
    }
    body.theme-dark .out-ptn .out-arrow {
      background: #102744 !important;
      border-color: rgba(255, 255, 255, 0.15) !important;
      color: #ffffff !important;
      box-shadow: 0 8px 22px rgba(0, 0, 0, 0.3) !important;
    }
    body.theme-dark .out-ptn .out-arrow:hover {
      background: #1d6fb8 !important;
      color: #ffffff !important;
    }
    body.theme-dark .out-ptn .out-dot {
      background: rgba(255, 255, 255, 0.25) !important;
    }
    body.theme-dark .out-ptn .out-dot.active {
      background: #ffb300 !important;
    }

    /* 4. Kerja Sama Industri Dark Mode */
    body.theme-dark .out-industry,
    body.theme-dark .out-sec.out-industry {
      background: #09182b !important;
      background-color: #09182b !important;
    }
    body.theme-dark .out-industry .out-title {
      color: #f4f8fc !important;
    }
    body.theme-dark .out-industry .out-desc {
      color: #c9d8e8 !important;
    }
    body.theme-dark .out-logo-card {
      background: #102744 !important;
      border-color: rgba(255, 255, 255, 0.1) !important;
    }
    body.theme-dark .out-ind-pills span {
      background: #0d213a !important;
      color: #eaf2fb !important;
      border-color: rgba(255, 255, 255, 0.1) !important;
    }

    /* 5. Marquee / Logo Window Side Fade Mask Overrides (Dark Mode) */
    body.theme-dark .out-logo-window::before,
    body.theme-dark .ic-marquee-wrap::before {
      background: linear-gradient(90deg, #09182b, transparent) !important;
    }
    body.theme-dark .out-logo-window::after,
    body.theme-dark .ic-marquee-wrap::after {
      background: linear-gradient(270deg, #09182b, transparent) !important;
    }

    /* 6. Sejarah & Page Hero Title (.sejarah-white) White Text in Dark Mode */
    body.theme-dark .history-title .sejarah-white,
    body.theme-dark .sejarah-white {
      color: #ffffff !important;
    }

    /* 7. Jurusan Card Text (White in Dark Mode, original in Light Mode) */
    body.theme-dark .cc-full,
    body.theme-dark .cc-abbr {
      color: #ffffff !important;
    }

    /* 8. Navbar "Cari Ekskulmu" Button Text (White in Dark Mode) */
    body.theme-dark .nav-ai-matchmaker,
    body.theme-dark .nav-ai-matchmaker > span,
    body.theme-dark .nav-ai-matchmaker span:not(.ai-nav-badge) {
      color: #ffffff !important;
    }

    /* 9. Homepage "Prestasi Sekolah" Cards Dark Mode */
    body.theme-dark .prestasi-section {
      background: #061221 !important;
      color: #eaf2fb !important;
    }
    body.theme-dark .prestasi-section .prestasi-title {
      color: #f4f8fc !important;
    }
    body.theme-dark .prestasi-section .prestasi-desc {
      color: #c9d8e8 !important;
    }
    body.theme-dark .prestasi-section .prestasi-feed {
      background: #102744 !important;
      border: 1px solid rgba(255, 255, 255, 0.1) !important;
      color: #eaf2fb !important;
      box-shadow: 0 24px 54px rgba(0, 0, 0, 0.45) !important;
    }
    body.theme-dark .prestasi-section .prestasi-feed-head {
      background: #0d213a !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    }
    body.theme-dark .prestasi-section .prestasi-feed-account strong {
      color: #ffffff !important;
    }
    body.theme-dark .prestasi-section .prestasi-feed-account span,
    body.theme-dark .prestasi-section .prestasi-feed-more,
    body.theme-dark .prestasi-section .prestasi-feed-meta span {
      color: #8fa8c2 !important;
    }
    body.theme-dark .prestasi-section .prestasi-feed-actions {
      color: #eaf2fb !important;
    }
    body.theme-dark .prestasi-section .prestasi-feed-tag {
      background: #0d213a !important;
      color: #ffd54a !important;
      border: 1px solid rgba(255, 213, 74, 0.3) !important;
    }
    body.theme-dark .prestasi-section .prestasi-feed-body h3 {
      color: #ffffff !important;
    }
    body.theme-dark .prestasi-section .prestasi-feed-body p {
      color: #c9d8e8 !important;
    }
    body.theme-dark .prestasi-section .prestasi-arrow {
      background: #102744 !important;
      border-color: rgba(255, 255, 255, 0.15) !important;
      color: #ffffff !important;
      box-shadow: 0 14px 30px rgba(0, 0, 0, 0.4) !important;
    }
    body.theme-dark .prestasi-section .prestasi-arrow:hover {
      background: #1d6fb8 !important;
      color: #ffffff !important;
    }

    /* 10. Visi & Misi Page Dark Mode & White Titles */
    body.theme-dark .visi-page,
    body.theme-dark .visi-section,
    body.theme-dark .nilai-section {
      background: #061221 !important;
      color: #eaf2fb !important;
    }
    body.theme-dark .visi-hero,
    body.theme-dark .misi-section,
    body.theme-dark .tujuan-section {
      background: #09182b !important;
      color: #eaf2fb !important;
    }
    body.theme-dark .misi-section::before,
    body.theme-dark .misi-section::after {
      opacity: 0.15 !important;
    }
    body.theme-dark .visi-card,
    body.theme-dark .misi-card,
    body.theme-dark .tujuan-card,
    body.theme-dark .nilai-card {
      background: #102744 !important;
      border-color: rgba(255, 255, 255, 0.1) !important;
      color: #eaf2fb !important;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.45) !important;
    }
    body.theme-dark .visi-title .visi-white,
    body.theme-dark .big-heading,
    body.theme-dark .visi-statement,
    body.theme-dark .misi-title,
    body.theme-dark .nilai-title,
    body.theme-dark .tujuan-title {
      color: #ffffff !important;
    }
    body.theme-dark .eyebrow {
      color: #5bb3ea !important;
    }
    body.theme-dark .eyebrow::before {
      background: linear-gradient(90deg, #5bb3ea, #2f6fa8) !important;
    }
    body.theme-dark .visi-lead,
    body.theme-dark .misi-desc,
    body.theme-dark .misi-text,
    body.theme-dark .nilai-text,
    body.theme-dark .tujuan-text {
      color: #c9d8e8 !important;
    }
    body.theme-dark .visi-tag {
      background: #0d213a !important;
      color: #ffffff !important;
      border-color: rgba(255, 255, 255, 0.1) !important;
    }
    body.theme-dark .visi-kicker {
      background: #0d213a !important;
      color: #ffd54a !important;
      border-color: rgba(255, 213, 74, 0.3) !important;
    }
    body.theme-dark .misi-num {
      color: rgba(255, 255, 255, 0.08) !important;
      -webkit-text-stroke: 1px rgba(255, 255, 255, 0.1) !important;
    }
    body.theme-dark .nilai-icon {
      background: #0d213a !important;
      color: #5bb3ea !important;
      border-color: rgba(255, 255, 255, 0.1) !important;
    }

    /* 11. Karya Siswa Card Titles (White in Dark Mode) */
    body.theme-dark .ks-hero,
    body.theme-dark .ks-page,
    body.theme-dark .ks-section {
      background: #061221 !important;
      color: #eaf2fb !important;
    }
    body.theme-dark .ks-title .ks-white {
      color: #ffffff !important;
    }
    body.theme-dark .ks-prestasi-card,
    body.theme-dark .karya-card,
    body.theme-dark .work-card {
      background: #102744 !important;
      border-color: rgba(255, 255, 255, 0.1) !important;
    }
    body.theme-dark .ks-prestasi-body h3,
    body.theme-dark .ks-prestasi-card h3,
    body.theme-dark .karya-card h3,
    body.theme-dark .work-card h3 {
      color: #ffffff !important;
    }
    body.theme-dark .ks-prestasi-body p,
    body.theme-dark .ks-prestasi-card p,
    body.theme-dark .karya-card p,
    body.theme-dark .work-card p {
      color: #c9d8e8 !important;
    }
    body.theme-dark .ks-prestasi-year {
      color: #8fa8c2 !important;
    }
  </style>
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

    {{-- ===== MITRA & PENDUKUNG (logo Garuda Spark, JHIC 2.0, Jagoan Hosting, Ngalup, Komdigi) ===== --}}
    <div class="footer-partners">
      <div class="footer-partners-label">Didukung Oleh</div>
      <div class="footer-partners-row">
        <div class="footer-partner-logo"><img src="{{ asset('images/partners/garuda-spark.png') }}" alt="Garuda Spark"></div>
        <div class="footer-partner-logo"><img src="{{ asset('images/partners/jhic.png') }}" alt="JHIC 2.0"></div>
        <div class="footer-partner-logo"><img src="{{ asset('images/partners/jagoan-hosting.png') }}" alt="Jagoan Hosting"></div>
        <div class="footer-partner-logo"><img src="{{ asset('images/partners/ngalup.png') }}" alt="Ngalup"></div>
        <div class="footer-partner-logo"><img src="{{ asset('images/partners/komdigi.png') }}" alt="Komdigi"></div>
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
          <a href="{{ route('admin.login') }}" class="footer-admin-link"><i class="fas fa-lock"></i> Admin login</a>
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

    <!-- Bubble sapaan otomatis (gaya TIVA) -->
    <div class="nara-greet-bubble" id="naraGreetBubble" role="status">
      <button type="button" class="nara-greet-close" onclick="hideNaraGreet(event)" aria-label="Tutup sapaan">&times;</button>
      <div class="nara-greet-mascot">
        <svg class="skn-mascot mascot-greet" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <defs>
            <linearGradient id="mascotGradGreet" x1="0" y1="0" x2="1" y2="1">
              <stop offset="0" stop-color="var(--teal-light,#28a9e1)"/>
              <stop offset="1" stop-color="var(--teal,#1d6fb8)"/>
            </linearGradient>
          </defs>
          <line x1="50" y1="8" x2="50" y2="18" stroke="var(--teal-dark,#13518c)" stroke-width="3" stroke-linecap="round"/>
          <circle class="mascot-antenna-ball" cx="50" cy="6" r="5" fill="var(--gold,#f9a825)"/>
          <rect x="20" y="18" width="60" height="52" rx="18" fill="url(#mascotGradGreet)"/>
          <rect x="28" y="30" width="44" height="28" rx="12" fill="#ffffff" opacity=".96"/>
          <circle class="mascot-eye" cx="42" cy="44" r="5" fill="var(--teal-dark,#13518c)"/>
          <circle class="mascot-eye" cx="58" cy="44" r="5" fill="var(--teal-dark,#13518c)"/>
          <path d="M40 52 Q50 58 60 52" stroke="var(--teal-dark,#13518c)" stroke-width="2.4" fill="none" stroke-linecap="round"/>
          <rect x="10" y="46" width="10" height="6" rx="3" fill="var(--teal-light,#28a9e1)"/>
          <g class="mascot-arm">
            <rect x="80" y="42" width="10" height="6" rx="3" fill="var(--teal-light,#28a9e1)"/>
          </g>
          <rect x="30" y="70" width="40" height="18" rx="8" fill="var(--teal,#1d6fb8)"/>
        </svg>
      </div>
      <div class="nara-greet-text">
        <strong>Hai! Aku NARA 👋</strong>
        Asisten virtual SMK Negeri 2 Mojokerto. Ada yang bisa dibantu?
      </div>
    </div>

    <div class="nara-window" id="naraWindow" role="dialog" aria-label="Nara Skaneda — Asisten Virtual">
      <button type="button" class="nara-close-float" onclick="toggleNara()" aria-label="Tutup Nara Skaneda"><i class="fas fa-times"></i></button>

      <div class="nara-hero">
        <i class="fas fa-wand-magic-sparkles nara-hero-spark" aria-hidden="true"></i>
        <div class="nara-hero-mascot">
          <svg class="skn-mascot mascot-header" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <defs>
              <linearGradient id="mascotGradHeader" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0" stop-color="var(--teal-light,#28a9e1)"/>
                <stop offset="1" stop-color="var(--teal,#1d6fb8)"/>
              </linearGradient>
            </defs>
            <line x1="50" y1="8" x2="50" y2="18" stroke="var(--teal-dark,#13518c)" stroke-width="3" stroke-linecap="round"/>
            <circle class="mascot-antenna-ball" cx="50" cy="6" r="5" fill="var(--gold,#f9a825)"/>
            <rect x="20" y="18" width="60" height="52" rx="18" fill="url(#mascotGradHeader)"/>
            <rect x="28" y="30" width="44" height="28" rx="12" fill="#ffffff" opacity=".96"/>
            <circle class="mascot-eye" cx="42" cy="44" r="5" fill="var(--teal-dark,#13518c)"/>
            <circle class="mascot-eye" cx="58" cy="44" r="5" fill="var(--teal-dark,#13518c)"/>
            <path d="M40 52 Q50 58 60 52" stroke="var(--teal-dark,#13518c)" stroke-width="2.4" fill="none" stroke-linecap="round"/>
            <rect x="10" y="46" width="10" height="6" rx="3" fill="var(--teal-light,#28a9e1)"/>
            <g class="mascot-arm">
              <rect x="80" y="42" width="10" height="6" rx="3" fill="var(--teal-light,#28a9e1)"/>
            </g>
            <rect x="30" y="70" width="40" height="18" rx="8" fill="var(--teal,#1d6fb8)"/>
          </svg>
        </div>
        <div class="nara-hero-text">
          <span class="nara-hero-greet">Hai! Aku Asisten</span>
          <span class="nara-hero-name">NARA <span>(Navigator Akademik Ramah &amp; Andal)</span></span>
          <span class="nara-hero-by"><i class="nara-hero-online" aria-hidden="true"></i> By SMK Negeri 2 Mojokerto</span>
        </div>
      </div>

      <div class="nara-messages" id="naraMessages">
        <div class="nara-msg">
          <div class="nara-msg-content">
            <div class="nara-bubble">Halo! Saya <strong>NARA</strong> — <em>Navigator Akademik Ramah &amp; Andal</em>. Ada yang bisa saya bantu?</div>
            <div class="nara-quick-inchat">
              <button type="button" class="nara-quick-card" onclick="sendNaraQuick('Apa saja jurusan di SMKN 2?')">
                <span class="nara-qc-icon"><i class="fas fa-graduation-cap"></i></span>
                <span class="nara-qc-text">Info Jurusan</span>
                <i class="fas fa-chevron-right nara-qc-arrow"></i>
              </button>
              <button type="button" class="nara-quick-card" onclick="sendNaraQuick('Bagaimana pendaftaran PPDB?')">
                <span class="nara-qc-icon"><i class="fas fa-id-card"></i></span>
                <span class="nara-qc-text">Info PPDB</span>
                <i class="fas fa-chevron-right nara-qc-arrow"></i>
              </button>
              <button type="button" class="nara-quick-card" onclick="sendNaraQuick('Apa saja ekstrakurikuler sekolah?')">
                <span class="nara-qc-icon"><i class="fas fa-users"></i></span>
                <span class="nara-qc-text">Info Ekskul</span>
                <i class="fas fa-chevron-right nara-qc-arrow"></i>
              </button>
              <button type="button" class="nara-quick-card" onclick="sendNaraQuick('Bagaimana jadwal jam belajar sekolah?')">
                <span class="nara-qc-icon"><i class="fas fa-clock"></i></span>
                <span class="nara-qc-text">Info Jadwal</span>
                <i class="fas fa-chevron-right nara-qc-arrow"></i>
              </button>
              <button type="button" class="nara-quick-card" onclick="sendNaraQuick('Bagaimana info BKK &amp; PKL magang?')">
                <span class="nara-qc-icon"><i class="fas fa-briefcase"></i></span>
                <span class="nara-qc-text">Info PKL</span>
                <i class="fas fa-chevron-right nara-qc-arrow"></i>
              </button>
              <button type="button" class="nara-quick-card" onclick="sendNaraQuick('Alamat dan kontak resmi sekolah?')">
                <span class="nara-qc-icon"><i class="fas fa-location-dot"></i></span>
                <span class="nara-qc-text">Info Kontak</span>
                <i class="fas fa-chevron-right nara-qc-arrow"></i>
              </button>
            </div>
          </div>
          <div class="nara-time">Sekarang</div>
        </div>
      </div>

      <div class="nara-input-pill">
        <input type="text" class="nara-input" id="naraInput" placeholder="Ketik pertanyaan kamu!" aria-label="Ketik pertanyaan" onkeydown="if(event.key==='Enter')sendNaraMsg()">
        <button type="button" class="nara-clear" onclick="clearNaraChat()" aria-label="Hapus percakapan"><i class="fas fa-trash"></i></button>
        <button type="button" class="nara-send" onclick="sendNaraMsg()" aria-label="Kirim"><i class="fas fa-paper-plane"></i></button>
      </div>
    </div>
    <button type="button" class="nara-fab" id="naraFab" onclick="toggleNara()" aria-label="Buka Nara Skaneda" title="Nara Skaneda — Asisten Virtual">
      <svg class="skn-mascot mascot-fab" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <defs>
          <linearGradient id="mascotGradFab" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0" stop-color="#ffffff"/>
            <stop offset="1" stop-color="#eaf5fd"/>
          </linearGradient>
        </defs>
        <line x1="50" y1="8" x2="50" y2="18" stroke="rgba(255,255,255,.9)" stroke-width="3" stroke-linecap="round"/>
        <circle class="mascot-antenna-ball" cx="50" cy="6" r="5" fill="#ffffff"/>
        <rect x="20" y="18" width="60" height="52" rx="18" fill="url(#mascotGradFab)"/>
        <rect x="28" y="30" width="44" height="28" rx="12" fill="var(--teal-dark,#13518c)" opacity=".95"/>
        <circle class="mascot-eye" cx="42" cy="44" r="5" fill="#ffffff"/>
        <circle class="mascot-eye" cx="58" cy="44" r="5" fill="#ffffff"/>
        <path d="M40 52 Q50 58 60 52" stroke="#ffffff" stroke-width="2.4" fill="none" stroke-linecap="round"/>
        <rect x="10" y="46" width="10" height="6" rx="3" fill="rgba(255,255,255,.9)"/>
        <g class="mascot-arm">
          <rect x="80" y="42" width="10" height="6" rx="3" fill="rgba(255,255,255,.9)"/>
        </g>
        <rect x="30" y="70" width="40" height="18" rx="8" fill="rgba(255,255,255,.9)"/>
      </svg>
      <span class="nara-status-dot"></span>
      <span class="fab-tip">Nara Skaneda</span>
    </button>
  </div>

</div>

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
     NARA SKANEDA — Asisten Virtual SMK Negeri 2 Mojokerto (Pure API Engine)
     ============================================================ */
  window.toggleNara = function(){
    const w = document.getElementById('naraWindow');
    if(!w) return;
    const opening = !w.classList.contains('open');
    w.classList.toggle('open');
    if(opening){
      requestAnimationFrame(() => applyPanelEdgeSafe(w, 'nara'));
      const inp = document.getElementById('naraInput');
      if(inp) setTimeout(()=>inp.focus(), 250);
      const greet = document.getElementById('naraGreetBubble');
      if(greet) greet.classList.remove('show');
    }
  };

  /* Safety: jika panel akan keluar viewport atas, alihkan ke posisi fixed kanan-atas */
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

  function naraNowLabel(){
    const now = new Date();
    const hh = String(now.getHours()).padStart(2,'0');
    const mm = String(now.getMinutes()).padStart(2,'0');
    return hh + '.' + mm;
  }

  function naraAddMsg(text, isUser){
    const msgs = document.getElementById('naraMessages');
    if(!msgs) return;
    const div = document.createElement('div');
    div.className = 'nara-msg' + (isUser ? ' user' : '');
    let safe = String(text).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    safe = safe.replace(/!\[([^\]]*)\]\(([^)]+)\)/g, function(match, alt, url) {
      return `<div style="margin-top:8px;margin-bottom:6px;"><img src="${url}" alt="${alt}" style="max-width:100%;border-radius:10px;border:1px solid rgba(13,58,102,0.15);display:block;cursor:pointer;" onclick="window.open('${url}', '_blank')"><span style="font-size:0.75rem;color:#64748b;display:block;margin-top:4px;">📷 ${alt}</span></div>`;
    });
    safe = safe.replace(/\*\*([^*]+)\*\*/g, '<strong>$1</strong>');
    safe = safe.replace(/\n/g,'<br>');
    div.innerHTML = '<div class="nara-bubble">' + safe + '</div><div class="nara-time">' + naraNowLabel() + '</div>';
    msgs.appendChild(div);
    msgs.scrollTop = msgs.scrollHeight;
  }

  function naraShowTyping(){
    const msgs = document.getElementById('naraMessages');
    if(!msgs || document.getElementById('naraTyping')) return;
    const div = document.createElement('div');
    div.className = 'nara-msg';
    div.id = 'naraTyping';
    div.innerHTML = '<div class="nara-bubble"><div class="typing-indicator"><div class="typing-dot"></div><div class="typing-dot"></div><div class="typing-dot"></div></div></div>';
    msgs.appendChild(div);
    msgs.scrollTop = msgs.scrollHeight;
  }

  function naraHideTyping(){
    const typing = document.getElementById('naraTyping');
    if(typing) typing.remove();
  }

  window.clearNaraChat = function(){
    const msgs = document.getElementById('naraMessages');
    if(!msgs) return;
    msgs.innerHTML = '<div class="nara-msg"><div class="nara-msg-content"><div class="nara-bubble">Halo lagi! Saya <strong>NARA</strong>. Ada yang bisa saya bantu?</div><div class="nara-quick-inchat"><button type="button" class="nara-quick-card" onclick="sendNaraQuick(\'Apa saja jurusan di SMKN 2?\')"><span class="nara-qc-icon"><i class="fas fa-graduation-cap"></i></span><span class="nara-qc-text">Info Jurusan</span><i class="fas fa-chevron-right nara-qc-arrow"></i></button><button type="button" class="nara-quick-card" onclick="sendNaraQuick(\'Bagaimana pendaftaran PPDB?\')"><span class="nara-qc-icon"><i class="fas fa-id-card"></i></span><span class="nara-qc-text">Info PPDB</span><i class="fas fa-chevron-right nara-qc-arrow"></i></button><button type="button" class="nara-quick-card" onclick="sendNaraQuick(\'Apa saja ekstrakurikuler sekolah?\')"><span class="nara-qc-icon"><i class="fas fa-users"></i></span><span class="nara-qc-text">Info Ekskul</span><i class="fas fa-chevron-right nara-qc-arrow"></i></button><button type="button" class="nara-quick-card" onclick="sendNaraQuick(\'Bagaimana jadwal jam belajar sekolah?\')"><span class="nara-qc-icon"><i class="fas fa-clock"></i></span><span class="nara-qc-text">Info Jadwal</span><i class="fas fa-chevron-right nara-qc-arrow"></i></button><button type="button" class="nara-quick-card" onclick="sendNaraQuick(\'Bagaimana info BKK & PKL magang?\')"><span class="nara-qc-icon"><i class="fas fa-briefcase"></i></span><span class="nara-qc-text">Info PKL</span><i class="fas fa-chevron-right nara-qc-arrow"></i></button><button type="button" class="nara-quick-card" onclick="sendNaraQuick(\'Alamat dan kontak resmi sekolah?\')"><span class="nara-qc-icon"><i class="fas fa-location-dot"></i></span><span class="nara-qc-text">Info Kontak</span><i class="fas fa-chevron-right nara-qc-arrow"></i></button></div></div><div class="nara-time">' + naraNowLabel() + '</div></div>';
  };

  const smartLocalAnswers = {
    jurusan: "SMK Negeri 2 Mojokerto memiliki 5 Konsentrasi Keahlian unggulan:\n1. Rekayasa Perangkat Lunak (RPL) - Software & Pemrograman\n2. Desain Komunikasi Visual (DKV) - Multimedia, Grafis & Animasi\n3. Agribisnis Pengolahan Hasil Pertanian (APHP) - Pangan Modern\n4. Kuliner (Tata Boga) - Seni Olah Rasa & Restoran\n5. Layanan Perbankan Syariah (LPS) - Keuangan Syariah",
    fasilitas: "Fasilitas & Virtual Tour 360° SMKN 2 Mojokerto:\nSekolah kami dilengkapi fasilitas lengkap seperti Gerbang Utama, Lobi Utama, Lapangan Olahraga, Aula Serbaguna, Kantin Sekolah, Musholla, Area Parkir, Perpustakaan Digital, serta Laboratorium Praktik (Lab RPL, DKV, LPS, APHP, Dapur Kuliner). Seluruh lokasi ini dapat dikunjungi dan dilihat 360° di menu Virtual Tour (/profile/tour).",
    ppdb: "Informasi PPDB SMKN 2 Mojokerto:\nPendaftaran dilakukan secara online melalui portal resmi PPDB Jawa Timur (Jalur Prestasi, Afirmasi, dan Zonasi). Pendaftaran TIDAK DIPUNGUT BIAYA (GRATIS).",
    ekskul: "Ekstrakurikuler SMKN 2 Mojokerto:\nPramuka (Wajib), Paskibra, Robotik & Coding Club, PMR, Olahraga (Futsal, Basket, Voli), Seni Musik & Tari, serta Kerohanian Islam.",
    jadwal: "Jam Belajar SMKN 2 Mojokerto:\nKegiatan Belajar Mengajar (KBM) berlangsung Senin hingga Jumat pukul 07.00 WIB - 15.30 WIB. Gerbang sekolah ditutup tepat pukul 07.00 WIB. Hari Sabtu dan Minggu libur.",
    pkl: "BKK & Kemitraan Industri SMKN 2 Mojokerto:\nUnit BKK memfasilitasi Praktek Kerja Lapangan (PKL) dan penyaluran lulusan ke mitra industri seperti PT Telkom, PT Astra International, Bank Syariah Indonesia, dan industri perhotelan/pangan.",
    kontak: "Alamat dan Kontak Resmi SMKN 2 Mojokerto:\nAlamat: Jl. Raden Wijaya No. 1, Kranggan, Kota Mojokerto, Jawa Timur\nTelepon: (0321) 321555\nEmail: info@smkn2mojokerto.sch.id",
    struktur: "Struktur Organisasi SMKN 2 Mojokerto:\n• Kepala Sekolah: Iswahyudi S.ST. M.Pd.\n• Waka Kurikulum: MELATI PUSPITA SARI, S.Pd.\n• Waka Kesiswaan: AINUR ROFIK, M. Pd, Si.\n• Waka Sarpras: M. WIRA HENDY HIMAWAN, M.Pd\n• Waka Humastri: ARIKAWWEKU CKRISNA, S.Pd.\n• Bendahara BOS: MEGA NOVINDA SARI, S.Pd.\n• Bendahara BPOPP: FAJAR DHILAMAYA, S.Pd.\n• Koordinator BKK: MULAT ADITYAWIRANTI, S.Pd.\n• Kaprog RPL: DANANG TEGUH SANTOSO, S.Kom\n• Kaprog DKV: NURFALAH SEPTAYOGA S.Kom.\n• Kaprog APHP: DESY ANDINI DILIAWATI, S.T.P.\n• Kaprog Kuliner: DHIYAH AMANATI KARTIKA SARI, S.Pd.\n• Kaprog LPS: METIY ARIANA, S.Pd, M.Pd.\nDetail lengkap dapat dilihat di menu Struktur Organisasi (/profile/structure).",
    waka: "Wakil Kepala Sekolah (Waka) SMKN 2 Mojokerto:\n1. Waka Kurikulum: MELATI PUSPITA SARI, S.Pd.\n2. Waka Kesiswaan: AINUR ROFIK, M. Pd, Si.\n3. Waka Sarana & Prasarana: M. WIRA HENDY HIMAWAN, M.Pd\n4. Waka Humastri: ARIKAWWEKU CKRISNA, S.Pd.",
    kaprog: "Ketua Program Keahlian (Kaprog/Kaprodi) SMKN 2 Mojokerto:\n• RPL (PPLG): DANANG TEGUH SANTOSO, S.Kom\n• DKV: NURFALAH SEPTAYOGA S.Kom.\n• APHP: DESY ANDINI DILIAWATI, S.T.P.\n• Kuliner: DHIYAH AMANATI KARTIKA SARI, S.Pd.\n• LPS: METIY ARIANA, S.Pd, M.Pd.",
    bendahara: "Bendahara SMKN 2 Mojokerto:\n• Bendahara BOS: MEGA NOVINDA SARI, S.Pd.\n• Bendahara BPOPP: FAJAR DHILAMAYA, S.Pd.",
    sejarah: "Sejarah SMKN 2 Mojokerto:\nBerdiri di kawasan Kranggan, Kota Mojokerto sebagai SMK Pusat Keunggulan (PK) dengan 5 konsentrasi keahlian berstandar nasional dan internasional. Selengkapnya di menu Sejarah Sekolah (/profile/history).",
    visi: "Visi SMKN 2 Mojokerto:\nTerwujudnya lulusan yang berakhlak mulia, kompeten, berjiwa wirausaha, dan berdaya saing global.",
    staf: "Tenaga Kependidikan / Staf SMKN 2 Mojokerto:\nSMK Negeri 2 Mojokerto memiliki 20+ Tenaga Kependidikan & Staf yang mengelola administrasi, keuangan, perpustakaan, dan layanan operasional sekolah:\n• Bendahara BOS: MEGA NOVINDA SARI, S.Pd.\n• Bendahara BPOPP: FAJAR DHILAMAYA, S.Pd.\n• Koordinator BKK: MULAT ADITYAWIRANTI, S.Pd.\n• Staf TU, Perpustakaan Digital, Teknisi Lab & Pengelola Sarana.\nDetail selengkapnya di menu Staff & Guru (/profile/staff-guru).",
    guru: "Tenaga Pendidik / Guru SMKN 2 Mojokerto:\nSMK Negeri 2 Mojokerto didukung oleh 67+ Guru Profesional bersertifikasi di bidang produktif keahlian (RPL, DKV, APHP, Kuliner, LPS) maupun normatif-adaptif.\nDetail selengkapnya di menu Staff & Guru (/profile/staff-guru).",
    karya: "Karya & Produk Inovatif Siswa SMKN 2 Kota Mojokerto:\n1. MultiMie & Sari Bunga Telang (Produk Olahan Pangan APHP & Kuliner)\n2. Aplikasi Tambal Ban Express (Mobile App Karya Siswa RPL)\n3. Nirmana 3D & Visual Branding (Desain Grafis & Fotografi Studio DKV)\n4. Pastry & Bakery TEFA (Roti & Cake Teaching Factory Kuliner)\n5. Maja Mojo & Bei Mie (Inovasi Pangan APHP)\n6. Layanan Mini Bank Syariah (Praktik Keuangan Syariah LPS)\nDetail selengkapnya di menu Karya Siswa (/siswa/karya).",
    kegiatan: "Jurnal Kegiatan & Agenda SMKN 2 Kota Mojokerto:\n• Uji Kompetensi Keahlian (UKK) Bersama Penguji DUDIKA\n• Program Budaya Kawi Laras (Pelestarian Busana Tradisional)\n• PKL & Rekrutmen Bursa Kerja Khusus (BKK)\n• Pentas Seni (Pensi), TEFA Expo, & Pameran Karya Siswa\n• Gerakan Sekolah Sehat (GSS) & Imtaq Masjid Al-Ikhlas\nDetail selengkapnya di menu Kegiatan (/galeri/kegiatan).",
    berita: "Berita & Kabar Terbaru SMKN 2 Kota Mojokerto:\n• Pelatihan Web Framework Laravel 2024\n• Pelaksanaan Uji Kompetensi Keahlian (UKK)\n• Edukasi & Literasi Keuangan Syariah bersama BSI\n• Program Budaya Kawi Laras\n• Program Gerakan Sekolah Sehat (GSS)\nDetail artikel lengkap di menu Berita (/berita).",
    prestasi: "Prestasi Unggulan Siswa SMKN 2 Kota Mojokerto:\n• Juara FESTIKA Jatim 2025\n• Juara 1 Pencak Silat KONI Championship (Dhiva Alennia)\n• Juara 1 Web Development Polinema (Tim Penerbang Roket RPL)\n• Medali Perak LKS Nasional Bidang Kuliner\n• Juara 3 LKS Jawa Timur 2026\n• Finalis FIKSI Nasional 2025\nDetail selengkapnya di menu Prestasi Siswa (/siswa/prestasi).",
    default: "Saya NARA SKANEDA (SMKN 2 Kota Mojokerto Assistance & Resource Agent). Maaf, informasi tersebut belum tersedia dalam basis pengetahuan resmi SMKN 2 Kota Mojokerto."
  };

  function getSmartLocalAnswer(text){
    const t = (text||'').toLowerCase();
    if(t.includes('waka')||t.includes('wakil')) return smartLocalAnswers.waka;
    if(t.includes('kaprog')||t.includes('kaprodi')||t.includes('ketua program')||t.includes('ketua jurusan')) return smartLocalAnswers.kaprog;
    if(t.includes('bendahara')||t.includes('bos')||t.includes('bpopp')) return smartLocalAnswers.bendahara;
    if(t.includes('struktur')||t.includes('organisasi')||t.includes('bagan')||t.includes('komite')) return smartLocalAnswers.struktur;
    if(t.includes('sejarah')||t.includes('berdiri')) return smartLocalAnswers.sejarah;
    if(t.includes('visi')||t.includes('misi')) return smartLocalAnswers.visi;
    if(t.includes('staf')||t.includes('staff')||t.includes('kependidikan')||t.includes('tata usaha')||t.includes('tu')) return smartLocalAnswers.staf;
    if(t.includes('guru')||t.includes('pendidik')||t.includes('pengajar')||t.includes('kepsek')||t.includes('iswahyudi')) return smartLocalAnswers.guru;
    if(t.includes('karya')||t.includes('produk')) return smartLocalAnswers.karya;
    if(t.includes('kegiatan')||t.includes('acara')||t.includes('agenda')) return smartLocalAnswers.kegiatan;
    if(t.includes('berita')||t.includes('kabar')||t.includes('artikel')) return smartLocalAnswers.berita;
    if(t.includes('prestasi')||t.includes('juara')||t.includes('lks')||t.includes('lomba')) return smartLocalAnswers.prestasi;
    if(t.includes('jurusan')||t.includes('proli')||t.includes('keahlian')||t.includes('rpl')||t.includes('dkv')||t.includes('aphp')||t.includes('kuliner')||t.includes('lps')) return smartLocalAnswers.jurusan;
    if(t.includes('fasilitas')||t.includes('gerbang')||t.includes('kantin')||t.includes('musholla')||t.includes('masjid')||t.includes('lobi')||t.includes('aula')||t.includes('lapangan')||t.includes('parkir')||t.includes('tour')||t.includes('360')||t.includes('tempat')||t.includes('sarana')) return smartLocalAnswers.fasilitas;
    if(t.includes('ppdb')||t.includes('daftar')||t.includes('masuk')) return smartLocalAnswers.ppdb;
    if(t.includes('ekskul')||t.includes('ekstrakurikuler')||t.includes('ekstra')) return smartLocalAnswers.ekskul;
    if(t.includes('jadwal')||t.includes('jam')||t.includes('masuk')||t.includes('pulang')) return smartLocalAnswers.jadwal;
    if(t.includes('pkl')||t.includes('magang')||t.includes('bkk')||t.includes('kerja')) return smartLocalAnswers.pkl;
    if(t.includes('kontak')||t.includes('alamat')||t.includes('telepon')||t.includes('email')) return smartLocalAnswers.kontak;
    return smartLocalAnswers.default;
  }

  function callChatbotApi(text){
    naraShowTyping();

    fetch('/api/chatbot/message', {
      method: 'POST',
      headers: { 
        'Content-Type': 'application/json', 
        'Accept': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}' 
      },
      body: JSON.stringify({ message: text })
    })
    .then(res => res.json())
    .then(data => {
      naraHideTyping();
      if(data && data.success && data.data && data.data.message) {
        naraAddMsg(data.data.message, false);
      } else if(data && data.message) {
        naraAddMsg(data.message, false);
      } else {
        naraAddMsg(getSmartLocalAnswer(text), false);
      }
    })
    .catch(() => {
      naraHideTyping();
      naraAddMsg(getSmartLocalAnswer(text), false);
    });
  }

  window.sendNaraMsg = function(){
    const input = document.getElementById('naraInput');
    if(!input) return;
    const text = input.value.trim();
    if(!text) return;
    naraAddMsg(text, true);
    input.value = '';
    callChatbotApi(text);
  };

  window.sendNaraQuick = function(text){
    naraAddMsg(text, true);
    callChatbotApi(text);
  };

  /* ============================================================
     BUBBLE SAPAAN OTOMATIS — gaya TIVA (muncul berkala, bisa ditutup)
     ============================================================ */
  (function(){
    const bubble = document.getElementById('naraGreetBubble');
    const fab = document.getElementById('naraFab');
    const win = document.getElementById('naraWindow');
    if(!bubble || !fab) return;
    let hideTimer = null;
    let showInterval = null;
    let dismissed = false;

    function showGreet(){
      if(dismissed) return;
      if(win && win.classList.contains('open')) return;
      bubble.classList.add('show');
      clearTimeout(hideTimer);
      hideTimer = setTimeout(() => bubble.classList.remove('show'), 6500);
    }

    window.hideNaraGreet = function(e){
      if(e) e.stopPropagation();
      bubble.classList.remove('show');
      dismissed = true;
      clearTimeout(hideTimer);
      clearInterval(showInterval);
    };

    fab.addEventListener('click', () => {
      bubble.classList.remove('show');
      clearTimeout(hideTimer);
    });

    setTimeout(showGreet, 1800);
    showInterval = setInterval(showGreet, 18000);
  })();

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
    const colorIsDark = (s.colorMode || 'light') === 'dark';
    document.body.classList.toggle('theme-dark', colorIsDark);
    document.documentElement.classList.toggle('theme-dark', colorIsDark);

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