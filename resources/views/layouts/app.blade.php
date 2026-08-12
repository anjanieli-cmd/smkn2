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

    /* ---------- PRELOADER ---------- */
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

    /* ---------- ANIMATED BG FX ---------- */
    .bg-fx{position:fixed;inset:0;z-index:-2;overflow:hidden;pointer-events:none}
    .bg-blob{position:absolute;border-radius:50%;filter:blur(90px);opacity:.5;animation:blobFloat 22s ease-in-out infinite}
    .bg-blob-1{width:520px;height:520px;background:var(--teal-glow);top:-140px;left:-120px}
    .bg-blob-2{width:460px;height:460px;background:var(--mint-glow);top:32%;right:-160px;animation-delay:-7s}
    .bg-blob-3{width:420px;height:420px;background:rgba(29,111,184,.4);bottom:-140px;left:30%;animation-delay:-14s}
    @keyframes blobFloat{0%,100%{transform:translate(0,0) scale(1)}33%{transform:translate(60px,-40px) scale(1.12)}66%{transform:translate(-40px,50px) scale(.94)}}

    /* ---------- CURSOR GLOW ---------- */
    #cursorGlow{
      position:fixed;width:440px;height:440px;border-radius:50%;pointer-events:none;z-index:1;
      background:radial-gradient(circle,rgba(29,111,184,.14),rgba(40,169,225,.05) 45%,transparent 70%);
      transform:translate(-50%,-50%);left:0;top:0;mix-blend-mode:screen;display:none;
    }
    @media(pointer:fine){#cursorGlow{display:block}}

    /* ====================== ANNOUNCE BAR FULL WIDTH ====================== */
    .announce-bar {
      background: linear-gradient(90deg, #0d3a66, #1d6fb8, #0d3a66);
      color: #fff;
      font-size: .8rem;
      position: relative;
      z-index: 60;
      overflow: hidden;
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.12);
      text-shadow: 0 1px 3px rgba(0,0,0,.35);
      width: 100%;
    }
    .announce-bar .container {
      width: 100%;
      max-width: 100%;
      padding: 0 2rem;
      margin: 0;
    }
    .announce-ticker {
      display: flex;
      gap: 3rem;
      white-space: nowrap;
      padding: .45rem 0;
      animation: ticker 26s linear infinite;
      width: max-content;
    }
    .announce-ticker:hover{animation-play-state:paused}
    @keyframes ticker{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
    .announce-item{display:flex;align-items:center;gap:.5rem;font-weight:500}
    .announce-item i{color:var(--gold);animation:tada 3s infinite}

    /* ====================== NAVBAR FULL WIDTH ====================== */
    #navbar{position:sticky;top:0;left:0;z-index:100;width:100%;margin:0;padding:0;transition:all .4s var(--ease);background:transparent}
    #navbar.scrolled{top:0}
    .nav-inner{display:flex;align-items:center;justify-content:space-between;gap:1rem;padding:.7rem 2rem;border-radius:0;background:linear-gradient(135deg,#0d3a66,#1d6fb8);backdrop-filter:blur(18px) saturate(160%);-webkit-backdrop-filter:blur(18px) saturate(160%);border:0;border-bottom:1px solid rgba(255,255,255,.18);box-shadow:0 10px 34px rgba(13,58,102,.35),inset 0 1px 0 rgba(255,255,255,.25);transition:all .4s var(--ease);width:100%;max-width:100%;margin:0}
    #navbar.scrolled .nav-inner{background:linear-gradient(135deg,#0a2f57,#13518c);box-shadow:0 14px 44px rgba(13,58,102,.5);padding:.55rem 2rem;border-radius:0;border:0;border-bottom:1px solid rgba(255,255,255,.12)}
    #navbar::after{content:'';position:absolute;bottom:-1px;left:0;right:0;height:1px;background:rgba(255,255,255,.06);opacity:.4;pointer-events:none}
    .nav-inner > *{position:relative;z-index:1}
    .nav-brand{display:flex;align-items:center;gap:.7rem;flex-shrink:0}
    .nav-logo{background:transparent;border:none;padding:0;border-radius:0;display:flex;align-items:center;justify-content:center}
    .nav-logo img{width:48px;height:48px;object-fit:contain;background:transparent}
    .nav-brand-text strong{
      display:block;
      font-family:'Poppins',sans-serif;
      font-size:1.38rem;
      color:#fff;
      line-height:1.15;
      font-weight:700;
      letter-spacing:.01em;
      text-shadow:0 1px 2px rgba(0,0,0,.25);
      white-space:nowrap;
    }
    .nav-brand-text strong .num-2{color:#ffd54f;text-shadow:0 1px 3px rgba(0,0,0,.35)}
    .nav-brand-text span{display:none}
    .num-2{color:#f9a825;font-style:normal}
    .nav-menu{display:flex;align-items:center;gap:.12rem;list-style:none;margin:0;padding:0}
    .nav-link{display:inline-flex;align-items:center;gap:.4rem;padding:.58rem .72rem;border-radius:10px;font-size:.84rem;font-weight:600;color:rgba(255,255,255,.95);transition:all .25s var(--ease);position:relative;white-space:nowrap}
    .nav-link i{font-size:.65rem;transition:transform .25s var(--ease)}
    .nav-item.dropdown-open > .nav-link i{transform:rotate(180deg)}
    .nav-link:hover,.nav-link.active{color:#fff;background:rgba(255,255,255,.14)}
    .nav-link.active::after{content:"";position:absolute;bottom:2px;left:50%;transform:translateX(-50%);width:18px;height:2.5px;border-radius:99px;background:#fff}
    .nav-item{position:relative}
    .dropdown-menu{position:absolute;top:calc(100% + 10px);left:0;min-width:250px;padding:.55rem;border-radius:14px;background:rgba(255,255,255,.97);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border:1px solid rgba(29,111,184,.25);box-shadow:0 20px 50px rgba(13,58,102,.18);opacity:0;visibility:hidden;transform:translateY(12px);transition:all .3s var(--ease);z-index:200}
    .nav-item.dropdown-open .dropdown-menu{opacity:1;visibility:visible;transform:translateY(0)}
    .dropdown-menu a{display:flex;align-items:center;gap:.65rem;padding:.62rem .72rem;border-radius:9px;font-size:.82rem;font-weight:500;color:var(--ink);transition:all .2s}
    .dropdown-menu a i{width:19px;color:#1d6fb8;flex-shrink:0}
    .dropdown-menu a:hover{background:rgba(29,111,184,.1);color:#0d3a66;transform:translateX(4px)}
    .nav-cta{background:linear-gradient(135deg,#ff6d00,#f4511e);color:#fff!important;box-shadow:0 4px 16px rgba(244,81,30,.35),inset 0 0 0 1.5px rgba(255,255,255,.4);position:relative;overflow:hidden;animation:ctaGlow 2.2s ease-in-out infinite}
    .nav-cta:hover,.nav-cta.active{color:#fff!important;background:linear-gradient(135deg,#ff8f00,#ff5722);transform:translateY(-2px);box-shadow:0 8px 24px rgba(244,81,30,.5),inset 0 0 0 1.5px rgba(255,255,255,.6)}
    .nav-cta::after{content:"";position:absolute;inset:0;background:linear-gradient(110deg,transparent 30%,rgba(255,255,255,.3) 50%,transparent 70%);transform:translateX(-120%);transition:transform .6s}
    .nav-cta:hover::after{transform:translateX(120%)}
    @keyframes ctaGlow{0%,100%{box-shadow:0 4px 16px rgba(244,81,30,.3),inset 0 0 0 1.5px rgba(255,255,255,.4)}50%{box-shadow:0 4px 24px rgba(255,109,0,.5),inset 0 0 0 1.5px rgba(255,255,255,.6)}}
    .nav-toggle{display:none;flex-direction:column;gap:5px;background:none;border:0;padding:.5rem}
    .nav-toggle span{width:24px;height:2.6px;border-radius:99px;background:#fff;transition:all .3s}

    /* ---------- SECTION COMMON ---------- */
    .section-label{display:inline-flex;align-items:center;gap:.5rem;font-size:.78rem;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:var(--teal);margin-bottom:.9rem}
    .section-label::before{content:"";width:26px;height:3px;border-radius:99px;background:linear-gradient(90deg,var(--teal),var(--mint))}
    .section-title{font-family:var(--font-display);font-size:clamp(1.7rem,3.4vw,2.5rem);color:var(--ink);line-height:1.2;margin-bottom:.8rem}
    .section-title .accent{background:linear-gradient(100deg,var(--teal),var(--teal-light));-webkit-background-clip:text;background-clip:text;color:transparent}
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

    /* ---------- RESPONSIVE DASAR ---------- */
    @media(max-width:1024px){
      .announce-bar .container{padding:0 1.5rem}
      .nav-inner{padding:.7rem 1.5rem}
      #navbar.scrolled .nav-inner{padding:.55rem 1.5rem}
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
      .announce-bar .container{padding:0 1rem}
      .nav-inner{padding:.7rem 1rem;border-radius:0}
      #navbar.scrolled .nav-inner{padding:.55rem 1rem}
    }
    @media(max-width:600px){
      .section-py{padding:60px 0}
      .announce-bar .container{padding:0 .8rem}
      .nav-inner{padding:.6rem .8rem;border-radius:0}
      #navbar.scrolled .nav-inner{padding:.5rem .8rem}
    }

    @media(prefers-reduced-motion:reduce){
      *,*::before,*::after{animation-duration:.01ms !important;animation-iteration-count:1 !important;transition-duration:.01ms !important}
      [data-reveal]{opacity:1;transform:none}
      html{scroll-behavior:auto}
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
          <strong>SMK Negeri <em class="num-2">2</em></strong>
        </div>
      </a>

      <ul class="nav-menu" id="navMenu">
        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>

        <li class="nav-item">
          <a href="#" class="nav-link dropdown-trigger">Profil <i class="fas fa-chevron-down"></i></a>
          <div class="dropdown-menu">
            <a href="#"><i class="fas fa-history"></i> Sejarah Sekolah</a>
            <a href="#"><i class="fas fa-eye"></i> Visi &amp; Misi</a>
            <a href="#"><i class="fas fa-sitemap"></i> Struktur Organisasi</a>
            <a href="#"><i class="fas fa-chalkboard-user"></i> Guru &amp; Staf</a>
            <a href="#"><i class="fas fa-road"></i> Roadmap Pengembangan</a>
          </div>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link dropdown-trigger">Program Keahlian <i class="fas fa-chevron-down"></i></a>
          <div class="dropdown-menu">
            <a href="#"><i class="fas fa-seedling"></i> Agriteknologi Pengolahan Hasil Pertanian</a>
            <a href="#"><i class="fas fa-palette"></i> Desain Komunikasi Visual</a>
            <a href="#"><i class="fas fa-utensils"></i> Kuliner</a>
            <a href="#"><i class="fas fa-calculator"></i> Akuntansi dan Keuangan Lembaga</a>
            <a href="#"><i class="fas fa-code"></i> Pengembangan Perangkat Lunak dan Gim</a>
          </div>
        </li>

        <li class="nav-item"><a href="{{ route('ppdb') }}" class="nav-link {{ request()->routeIs('ppdb') ? 'active' : '' }}">PPDB</a></li>

        <li class="nav-item">
          <a href="#" class="nav-link dropdown-trigger">Siswa <i class="fas fa-chevron-down"></i></a>
          <div class="dropdown-menu">
            <a href="{{ route('karya-siswa') }}"><i class="fas fa-lightbulb"></i> Karya Siswa</a>
            <a href="#"><i class="fas fa-trophy"></i> Prestasi Siswa</a>
            <a href="#"><i class="fas fa-people-group"></i> Ekstrakurikuler</a>
          </div>
        </li>

        <li class="nav-item"><a href="#berita" class="nav-link">Berita</a></li>

        <li class="nav-item">
          <a href="#" class="nav-link dropdown-trigger">Galeri <i class="fas fa-chevron-down"></i></a>
          <div class="dropdown-menu">
            <a href="#galeri"><i class="fas fa-school"></i> Kegiatan Sekolah</a>
            <a href="#galeri"><i class="fas fa-medal"></i> Prestasi Sekolah</a>
          </div>
        </li>

        <li class="nav-item"><a href="{{ route('pkl-alumni') }}" class="nav-link {{ request()->routeIs('pkl-alumni') ? 'active' : '' }}">PKL &amp; Alumni</a></li>
        <li class="nav-item"><a href="{{ route('ppdb') }}" class="nav-link nav-cta">Daftar PPDB</a></li>
      </ul>

      <button class="nav-toggle" id="navToggle" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </nav>

  {{-- ================= KONTEN PER HALAMAN ================= --}}
  @yield('content')

  {{-- ================= FOOTER ================= --}}
  @include('partials.footer')

  {{-- ================= BACK TO TOP ================= --}}
  <button id="backToTop" aria-label="Kembali ke atas"><i class="fas fa-arrow-up"></i></button>

  {{-- ================= SCRIPT GLOBAL ================= --}}
  <script>
    // Preloader
    window.addEventListener('load', () => {
      document.getElementById('preloader')?.classList.add('done');
    });

    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    let lastScroll = 0;
    window.addEventListener('scroll', () => {
      const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
      if (currentScroll > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
      lastScroll = currentScroll;
    });

    // Mobile menu toggle
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');
    if (navToggle && navMenu) {
      navToggle.addEventListener('click', () => {
        navMenu.classList.toggle('open');
      });
      // Close menu on link click
      navMenu.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', () => {
          navMenu.classList.remove('open');
        });
      });
    }

    // Dropdown toggle untuk semua menu navbar
    const dropdownTriggers = document.querySelectorAll('.dropdown-trigger');
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

    // Tutup dropdown saat klik di luar navbar
    document.addEventListener('click', (e) => {
      if (!e.target.closest('#navbar')) {
        document.querySelectorAll('.nav-item.dropdown-open').forEach(item => {
          item.classList.remove('dropdown-open');
        });
      }
    });

    // Back to top
    const backToTop = document.getElementById('backToTop');
    window.addEventListener('scroll', () => {
      if (window.pageYOffset > 400) {
        backToTop.classList.add('show');
      } else {
        backToTop.classList.remove('show');
      }
    });
    backToTop?.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Scroll reveal
    const revealElements = document.querySelectorAll('[data-reveal]');
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('revealed');
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -30px 0px' });
    revealElements.forEach(el => revealObserver.observe(el));
  </script>

  @stack('scripts')
</body>
</html>