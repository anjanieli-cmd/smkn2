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

<!-- ================= BACK TO TOP ================= -->
<button id="backToTop" aria-label="Kembali ke atas"><i class="fas fa-arrow-up"></i></button>

<style>
/* ============================================================
   FLOATING TOOLS — FINAL: ONE THEME + ONE SIBOT
   ============================================================ */
.sibot-fab,.theme-widget{position:fixed!important;right:0!important;z-index:950!important;font-family:var(--font-body,'Plus Jakarta Sans',sans-serif)}

/* SIBOT: kecil, sedikit masuk dari pojok, bentuk bubble chat */
.sibot-fab{right:24px!important;bottom:72px!important;width:auto!important;height:auto!important}
.sibot-toggle{position:relative!important;width:46px!important;height:38px!important;padding:0!important;border:0!important;border-radius:14px 14px 14px 5px!important;display:flex!important;align-items:center!important;justify-content:center!important;background:linear-gradient(135deg,#1d6fb8,#28a9e1)!important;color:#fff!important;box-shadow:0 8px 20px rgba(13,58,102,.28)!important;cursor:pointer!important;transition:transform .22s ease,box-shadow .22s ease!important}
.sibot-toggle::after{content:"";position:absolute!important;left:-6px!important;bottom:3px!important;width:11px!important;height:11px!important;background:#1d6fb8!important;clip-path:polygon(100% 0,100% 100%,0 100%)!important}
.sibot-toggle:hover{transform:translateY(-2px)!important;box-shadow:0 11px 25px rgba(13,58,102,.35)!important}
.sibot-toggle i{font-size:16px!important;line-height:1!important}
.sibot-badge{display:none!important}

.sibot-window{position:absolute!important;right:0!important;bottom:50px!important;width:min(340px,calc(100vw - 32px))!important;max-height:min(540px,calc(100vh - 130px))!important;overflow:hidden!important;border-radius:18px!important;background:#fff!important;border:1px solid rgba(29,111,184,.18)!important;box-shadow:0 20px 55px rgba(13,58,102,.24)!important;opacity:0!important;visibility:hidden!important;transform:translateY(10px) scale(.97)!important;pointer-events:none!important;transition:.2s ease!important}
.sibot-window.open{opacity:1!important;visibility:visible!important;transform:none!important;pointer-events:auto!important}
.sibot-header{min-height:56px!important;padding:10px 12px!important;display:flex!important;align-items:center!important;gap:9px!important;background:linear-gradient(135deg,#0d3a66,#1d6fb8)!important;color:#fff!important}
.sibot-avatar{width:31px!important;height:31px!important;flex:0 0 31px!important;border-radius:9px!important;display:flex!important;align-items:center!important;justify-content:center!important;background:rgba(255,255,255,.16)!important}
.sibot-avatar i{font-size:13px!important}.sibot-name{font-size:13px!important;font-weight:700!important}.sibot-status{font-size:10px!important;opacity:.75}.sibot-close{margin-left:auto!important;width:28px!important;height:28px!important;border:0!important;background:transparent!important;color:#fff!important;cursor:pointer!important}
.sibot-messages{padding:12px!important;max-height:260px!important;overflow-y:auto!important}.msg{display:flex!important;gap:7px!important;margin-bottom:10px!important}.msg-avatar{width:24px!important;height:24px!important;flex:0 0 24px!important;border-radius:8px!important;display:flex!important;align-items:center!important;justify-content:center!important;background:#eaf5fd!important;color:#1d6fb8!important;font-size:10px!important}.msg-bubble{max-width:250px!important;padding:8px 10px!important;border-radius:10px 10px 10px 3px!important;background:#f2f7fb!important;color:#33475c!important;font-size:11px!important;line-height:1.5!important}.msg-time{font-size:9px!important;color:#8a9aaa!important}.sibot-quick{display:flex!important;flex-wrap:wrap!important;gap:5px!important;padding:8px 12px!important;border-top:1px solid #edf2f6!important}.quick-btn{border:1px solid #dce8f2!important;background:#fff!important;color:#1d6fb8!important;border-radius:7px!important;padding:5px 7px!important;font-size:9px!important}.sibot-input-row{display:flex!important;gap:6px!important;padding:9px 12px 11px!important;border-top:1px solid #edf2f6!important}.sibot-input{min-width:0!important;flex:1!important;height:34px!important;border:1px solid #dce8f2!important;border-radius:9px!important;padding:0 9px!important;font-size:10px!important}.sibot-send{width:34px!important;height:34px!important;border:0!important;border-radius:9px!important;background:#1d6fb8!important;color:#fff!important}

/* THEME: satu saja, menempel sisi kanan, berada DI ATAS SIBOT */
.theme-widget{right:0!important;bottom:128px!important;width:42px!important;height:42px!important}
.theme-toggle{width:42px!important;height:42px!important;padding:0!important;border:1px solid rgba(255,255,255,.16)!important;border-right:0!important;border-radius:10px 0 0 10px!important;display:flex!important;align-items:center!important;justify-content:center!important;background:#737d87!important;color:#fff!important;cursor:pointer!important;transition:background .2s ease,transform .2s ease!important}
.theme-toggle:hover,.theme-widget:has(.theme-panel.open) .theme-toggle{background:#1d6fb8!important}
.theme-toggle i{font-size:15px!important}
.theme-panel{position:absolute!important;right:48px!important;bottom:0!important;width:235px!important;padding:12px!important;border-radius:13px!important;background:rgba(255,255,255,.98)!important;border:1px solid rgba(29,111,184,.18)!important;box-shadow:0 15px 40px rgba(13,58,102,.2)!important;opacity:0!important;visibility:hidden!important;transform:translateX(8px)!important;pointer-events:none!important;transition:.2s ease!important}
.theme-panel.open{opacity:1!important;visibility:visible!important;transform:none!important;pointer-events:auto!important}
.theme-panel-title{font-size:12px!important;font-weight:700!important;color:#17324d!important;margin-bottom:10px!important}.theme-panel-title i{color:#1d6fb8!important}.theme-section{margin-top:9px!important}.theme-label{display:block!important;font-size:9px!important;font-weight:700!important;color:#6b7b8a!important;margin-bottom:6px!important}.theme-btn-row{display:grid!important;grid-template-columns:repeat(3,1fr)!important;gap:4px!important}.theme-btn{border:1px solid #dce8f2!important;background:#fff!important;color:#526273!important;border-radius:7px!important;padding:6px 3px!important;font-size:9px!important}.theme-btn.active,.theme-btn:hover{background:#eaf5fd!important;color:#1d6fb8!important;border-color:#8fc8ea!important}.theme-colors{display:flex!important;gap:7px!important}.theme-color{width:20px!important;height:20px!important;padding:0!important;border:2px solid transparent!important;border-radius:50%!important}.theme-color.blue{background:#1d6fb8!important}.theme-color.purple{background:#7657c8!important}.theme-color.green{background:#2d9b78!important}.theme-color.rose{background:#d85b7a!important}.theme-color.gold{background:#d49a22!important}.theme-color.active{outline:2px solid #1d6fb8!important;outline-offset:2px!important}.theme-reset{width:100%!important;margin-top:11px!important;padding:7px!important;border:0!important;border-radius:7px!important;background:#f1f5f8!important;color:#526273!important;font-size:9px!important}

@media(max-width:600px){
  .sibot-fab{right:14px!important;bottom:72px!important}
  .theme-widget{bottom:122px!important}
  .sibot-window{width:min(320px,calc(100vw - 28px))!important;max-height:calc(100vh - 120px)!important}
  .theme-panel{width:215px!important;right:46px!important}
}
</style>
<!-- ================= CHATBOT SIBOT — FINAL ================= -->
<div class="sibot-fab" aria-label="Buka SIBOT">
  <div class="sibot-window" id="sibotWindow">
    <div class="sibot-header"><div class="sibot-avatar"><i class="fas fa-robot"></i></div><div><div class="sibot-name">SIBOT</div><div class="sibot-status">Asisten SMKN 2</div></div><button type="button" class="sibot-close" onclick="toggleSibot()" aria-label="Tutup SIBOT"><i class="fas fa-times"></i></button></div>
    <div class="sibot-messages" id="sibotMessages"><div class="msg msg-bot"><div class="msg-avatar"><i class="fas fa-robot"></i></div><div><div class="msg-bubble">Halo! Saya SIBOT. Ada yang bisa saya bantu tentang SMK Negeri 2 Mojokerto?</div><div class="msg-time">Sekarang</div></div></div></div>
    <div class="sibot-quick"><button type="button" class="quick-btn" onclick="sendQuick('Jurusan apa saja?')"><i class="fas fa-graduation-cap"></i> Jurusan</button><button type="button" class="quick-btn" onclick="sendQuick('Info PPDB')"><i class="fas fa-file-signature"></i> PPDB</button><button type="button" class="quick-btn" onclick="sendQuick('Ekskul apa saja?')"><i class="fas fa-people-group"></i> Ekskul</button><button type="button" class="quick-btn" onclick="sendQuick('Jadwal sekolah')"><i class="fas fa-calendar-days"></i> Jadwal</button><button type="button" class="quick-btn" onclick="sendQuick('Info PKL')"><i class="fas fa-building"></i> PKL</button><button type="button" class="quick-btn" onclick="sendQuick('Kontak sekolah')"><i class="fas fa-phone"></i> Kontak</button></div>
    <div class="sibot-input-row"><input type="text" class="sibot-input" id="sibotInput" placeholder="Ketik pertanyaan..." onkeydown="if(event.key==='Enter')sendMsg()"><button type="button" class="sibot-send" onclick="sendMsg()" aria-label="Kirim"><i class="fas fa-paper-plane"></i></button></div>
  </div>
  <button type="button" class="sibot-toggle" onclick="toggleSibot()" aria-label="Buka SIBOT"><i class="fas fa-robot" id="sibotIcon"></i></button>
</div>

<!-- ================= THEME WIDGET — FINAL ================= -->
<div class="theme-widget">
  <div class="theme-panel" id="themePanel" role="dialog" aria-label="Pengaturan tema">
    <div class="theme-panel-title"><i class="fas fa-palette"></i> Tampilan Website</div>
    <div class="theme-section"><span class="theme-label">Mode tampilan</span><div class="theme-btn-row"><button type="button" class="theme-btn" id="themeDefault" onclick="setThemeMode('default')"><i class="fas fa-desktop"></i> Default</button><button type="button" class="theme-btn" id="themeLight" onclick="setThemeMode('light')"><i class="fas fa-sun"></i> Light</button><button type="button" class="theme-btn" id="themeDark" onclick="setThemeMode('dark')"><i class="fas fa-moon"></i> Dark</button></div></div>
    <div class="theme-section"><span class="theme-label">Warna tema</span><div class="theme-colors"><button type="button" class="theme-color blue" data-color="blue" onclick="setThemeColor('blue')" title="Biru"></button><button type="button" class="theme-color purple" data-color="purple" onclick="setThemeColor('purple')" title="Ungu"></button><button type="button" class="theme-color green" data-color="green" onclick="setThemeColor('green')" title="Hijau"></button><button type="button" class="theme-color rose" data-color="rose" onclick="setThemeColor('rose')" title="Rose"></button><button type="button" class="theme-color gold" data-color="gold" onclick="setThemeColor('gold')" title="Gold"></button></div></div>
    <button type="button" class="theme-reset" onclick="resetTheme()"><i class="fas fa-rotate-left"></i> Kembalikan ke Default</button>
  </div>
  <button type="button" class="theme-toggle" id="themeToggle" onclick="toggleThemePanel()" aria-label="Pengaturan tema" title="Pengaturan tema"><i class="fas fa-palette" id="themeIcon"></i></button>
</div>

<!-- ================= JAVASCRIPT ================= -->
<script>
  /* ---------- Preloader ---------- */
  (function(){
    var pre = document.getElementById('preloader');
    function hide(){ if(pre) pre.classList.add('done'); }
    window.addEventListener('load', function(){ setTimeout(hide, 350); });
    setTimeout(hide, 2600); /* safety-net */
  })();

  /* ---- Intro Video ---- */
  (function() {
    var layer = document.getElementById('heroIntroLayer');
    var video = document.getElementById('introVideo');
    var skipBtn = document.getElementById('introSkipBtn');
    var finished = false;
    if (!layer || !video || !skipBtn) return;
    function endIntro() {
      if (finished) return;
      finished = true;
      layer.classList.add('intro-hide');
      setTimeout(function() { if (layer && layer.parentNode) layer.parentNode.removeChild(layer); }, 750);
    }
    video.addEventListener('ended', endIntro);
    video.addEventListener('error', endIntro);
    skipBtn.addEventListener('click', endIntro);
    video.addEventListener('stalled', endIntro);
    video.addEventListener('loadedmetadata', function() { if (!isFinite(video.duration) || video.duration <= 0) endIntro(); });
    var playPromise = video.play();
    if (playPromise !== undefined) { playPromise.catch(function(){}); }
    setTimeout(endIntro, 60000);
  })();

  /* ---- Intro layer styling (hidden until removed) ---- */
  (function(){
    var style = document.createElement('style');
    style.textContent = '.hero-intro-layer{position:fixed;inset:0;z-index:9990;background:#0d3a66;transition:opacity .75s ease,visibility .75s ease}.hero-intro-layer.intro-hide{opacity:0;visibility:hidden;pointer-events:none}.intro-video{width:100%;height:100%;object-fit:cover}.intro-skip-btn{position:absolute;right:22px;bottom:22px;display:flex;align-items:center;gap:.5rem;padding:.7rem 1.2rem;border-radius:99px;border:1px solid rgba(255,255,255,.3);background:rgba(255,255,255,.12);color:#fff;font-weight:700;font-size:.82rem;backdrop-filter:blur(8px);cursor:pointer;transition:all .3s}.intro-skip-btn:hover{background:rgba(255,255,255,.25)}';
    document.head.appendChild(style);
  })();

  /* ---- View Transitions API — intercept internal links ---- */
  if(document.startViewTransition) {
    document.addEventListener('click', function(e) {
      var a = e.target.closest('a[href]');
      if(!a) return;
      var href = a.getAttribute('href');
      if(!href || href.charAt(0) === '#' || href.indexOf('http') === 0 || href.indexOf('mailto') === 0 || href.indexOf('tel') === 0) return;
      e.preventDefault();
      document.startViewTransition(function(){ window.location.href = href; });
    });
  }

  /* ---- Sync hero background height to hero bottom edge (foto selalu sampai bawah hero) ---- */
  (function(){
    var bg = document.querySelector('.page-hero-bg');
    var heroEl = document.getElementById('beranda');
    function syncHeroBg(){
      if(!bg || !heroEl) return;
      var heroTop = heroEl.offsetTop || 0;
      var heroHeight = heroEl.offsetHeight || 0;
      bg.style.height = (heroTop + heroHeight + 4) + 'px';
      bg.style.top = '0px';
      bg.style.bottom = 'auto';
    }
    if(bg){
      syncHeroBg();
      window.addEventListener('load', syncHeroBg);
      window.addEventListener('resize', syncHeroBg);
      setTimeout(syncHeroBg, 400);
      setTimeout(syncHeroBg, 1500);
    }
  })();

  /* ---- Hero Canvas Particles (premium floating bubbles) ---- */
  (function(){
    var canvas = document.getElementById('heroCanvas');
    if(!canvas) return;
    var ctx = canvas.getContext('2d');
    var particles = [];
    var W, H, DPR = Math.min(window.devicePixelRatio || 1, 2);
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function resize(){
      var rect = canvas.parentElement.getBoundingClientRect();
      W = rect.width; H = rect.height;
      canvas.width = W * DPR; canvas.height = H * DPR;
      canvas.style.width = W + 'px'; canvas.style.height = H + 'px';
      ctx.setTransform(DPR,0,0,DPR,0,0);
      var count = Math.min(70, Math.floor(W / 16));
      particles = [];
      for(var i=0;i<count;i++){
        particles.push({
          x: Math.random()*W,
          y: Math.random()*H,
          r: Math.random()*3.2 + 1,
          vy: -(Math.random()*0.5 + 0.18),
          vx: (Math.random()-0.5)*0.25,
          a: Math.random()*0.5 + 0.12,
          tw: Math.random()*Math.PI*2,
          ts: Math.random()*0.02 + 0.005
        });
      }
    }

    function tick(){
      ctx.clearRect(0,0,W,H);
      for(var i=0;i<particles.length;i++){
        var p = particles[i];
        p.y += p.vy; p.x += p.vx; p.tw += p.ts;
        if(p.y < -12){ p.y = H + 12; p.x = Math.random()*W; }
        if(p.x < -12) p.x = W + 12;
        if(p.x > W + 12) p.x = -12;
        var alpha = p.a * (0.55 + 0.45*Math.sin(p.tw));
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.r, 0, Math.PI*2);
        ctx.fillStyle = 'rgba(40,169,225,' + alpha + ')';
        ctx.fill();
        /* soft glow */
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.r*3, 0, Math.PI*2);
        ctx.fillStyle = 'rgba(40,169,225,' + (alpha*0.12) + ')';
        ctx.fill();
      }
      if(!reduceMotion) requestAnimationFrame(tick);
    }

    window.addEventListener('resize', resize);
    resize();
    if(!reduceMotion) requestAnimationFrame(tick);
    else { ctx.clearRect(0,0,W,H); }
  })();

  /* ---- Floating Pill Navbar scroll ---- */
  var navbar = document.getElementById('navbar');
  window.addEventListener('scroll', function() {
    if(window.scrollY > 80) { navbar.classList.add('scrolled'); } else { navbar.classList.remove('scrolled'); }
    var btt = document.getElementById('backToTop');
    if(btt){ if(window.scrollY > 600) btt.classList.add('show'); else btt.classList.remove('show'); }
  }, { passive: true });

  /* ---- Back to top ---- */
  document.getElementById('backToTop').addEventListener('click', function(){
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  /* ---- Cursor glow ---- */
  (function(){
    var glow = document.getElementById('cursorGlow');
    if(!glow) return;
    if(window.matchMedia('(pointer: coarse)').matches) return;
    var raf = null;
    document.addEventListener('mousemove', function(e){
      if(raf) return;
      raf = requestAnimationFrame(function(){
        glow.style.left = e.clientX + 'px';
        glow.style.top = e.clientY + 'px';
        raf = null;
      });
    });
  })();

  /* ---- Mobile nav ---- */
  document.getElementById('navToggle').addEventListener('click', function() {
    document.getElementById('navMenu').classList.toggle('open');
  });

  /* ---- Dropdown Profil ---- */
  document.querySelectorAll('.nav-item').forEach(function(item) {
    var trigger = item.querySelector(':scope > a.nav-link');
    var menu = item.querySelector('.dropdown-menu');
    if(!trigger || !menu) return;
    trigger.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      var alreadyOpen = item.classList.contains('dropdown-open');
      document.querySelectorAll('.nav-item.dropdown-open').forEach(function(i){ i.classList.remove('dropdown-open'); });
      if(!alreadyOpen) item.classList.add('dropdown-open');
    });
  });
  document.addEventListener('click', function(e) {
    if(!e.target.closest('.nav-item')) {
      document.querySelectorAll('.nav-item.dropdown-open').forEach(function(i){ i.classList.remove('dropdown-open'); });
    }
  });

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

  /* ---- Countdown ---- */
  function updateCountdown() {
    var target = new Date('2025-07-31T23:59:59');
    var now = new Date();
    var diff = target - now;
    if(diff <= 0) { document.getElementById('countdown').innerHTML = '<div style="color:#fff;font-family:var(--font-display);font-weight:700;background:rgba(0,0,0,0.15);padding:0.6rem 1rem;border-radius:10px;">Pendaftaran Ditutup</div>'; return; }
    var d = Math.floor(diff/86400000);
    var h = Math.floor((diff%86400000)/3600000);
    var m = Math.floor((diff%3600000)/60000);
    var s = Math.floor((diff%60000)/1000);
    document.getElementById('cd-hari').textContent = String(d).padStart(2,'0');
    document.getElementById('cd-jam').textContent = String(h).padStart(2,'0');
    document.getElementById('cd-menit').textContent = String(m).padStart(2,'0');
    document.getElementById('cd-detik').textContent = String(s).padStart(2,'0');
  }
  updateCountdown(); setInterval(updateCountdown, 1000);

  /* ---- SIBOT ---- */
  var sibotResponses = {
    'jurusan': 'SMK Negeri 2 Mojokerto memiliki 5 program keahlian:\n1. Rekayasa Perangkat Lunak (RPL)\n2. Desain Komunikasi Visual (DKV)\n3. Tata Boga / Kuliner\n4. Agribisnis Pengolahan Hasil Pertanian (APHP)\n5. Layanan Perbankan Syariah (LPS)',
    'ppdb': 'PPDB 2025/2026 dibuka mulai 1 Juni 2025. Syarat: Ijazah/SKL SMP, rapor, KK, dan foto. Daftar online di portal PPDB kami. Kuota terbatas!',
    'ekskul': 'Kami memiliki 12 ekstrakurikuler: Basket, Futsal, Bola Voli, Pencak Silat, Paskibra, Pramuka, PMR, Jurnalistik, Banjari, PENA (Seni Mini Teater), Tari, dan Pasus (Pasukan Khusus). Kami juga punya organisasi OSIS.',
    'jadwal': 'Jam belajar: Senin–Jumat 07.00–15.30 WIB. Sabtu untuk kegiatan ekstrakurikuler. Kantor sekolah buka 07.00–16.00 WIB.',
    'pkl': 'PKL (Praktik Kerja Lapangan) dilaksanakan di Kelas XI selama 3–6 bulan. Kami memiliki 80+ mitra industri terpercaya. Lihat detail di halaman Portal PKL.',
    'kontak': 'Hubungi kami:\nAlamat: Jl. Raya Pulorejo, Kel. Pulorejo, Kec. Prajurit Kulon, Kota Mojokerto, Jawa Timur 61325\nTelepon: 0312 2292 9922\nEmail: info@smkn2mojokerto.sch.id\nJam operasional: Senin–Jumat 07.00–16.00 WIB',
    'roadmap': 'Roadmap Pengembangan SMKN 2 Mojokerto mencakup target 2020–2028+, dari renovasi lab hingga menjadi SMK rujukan nasional. Lihat detail di halaman Roadmap Sekolah!',
    'default': 'Terima kasih atas pertanyaannya. Untuk informasi lebih lanjut, silakan hubungi kami di 0312 2292 9922 atau kunjungi kantor kami. Saya hanya dapat menjawab pertanyaan seputar SMK Negeri 2 Mojokerto.'
  };

  function toggleSibot() {
    var w = document.getElementById('sibotWindow');
    var icon = document.getElementById('sibotIcon');
    w.classList.toggle('open');
    icon.className = w.classList.contains('open') ? 'fas fa-times' : 'fas fa-robot';
    document.querySelector('.sibot-badge').style.display = w.classList.contains('open') ? 'none' : 'flex';
  }

  function addMsg(text, isUser) {
    var msgs = document.getElementById('sibotMessages');
    var div = document.createElement('div');
    div.className = 'msg ' + (isUser ? 'msg-user' : 'msg-bot');
    var now = new Date().toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit'});
    div.innerHTML = '<div class="msg-avatar"><i class="fas fa-' + (isUser?'user':'robot') + '"></i></div><div><div class="msg-bubble">' + text.replace(/\n/g,'<br>') + '</div><div class="msg-time">' + now + '</div></div>';
    msgs.appendChild(div);
    msgs.scrollTop = msgs.scrollHeight;
  }

  function showTyping() {
    var msgs = document.getElementById('sibotMessages');
    var div = document.createElement('div');
    div.className = 'msg msg-bot'; div.id = 'typingIndicator';
    div.innerHTML = '<div class="msg-avatar"><i class="fas fa-robot"></i></div><div class="msg-bubble"><div class="typing-indicator"><div class="typing-dot"></div><div class="typing-dot"></div><div class="typing-dot"></div></div></div>';
    msgs.appendChild(div); msgs.scrollTop = msgs.scrollHeight;
  }

  function removeTyping() { var t = document.getElementById('typingIndicator'); if(t) t.remove(); }

  function getResponse(text) {
    var t = text.toLowerCase();
    if(t.indexOf('jurusan') !== -1 || t.indexOf('program') !== -1) return sibotResponses.jurusan;
    if(t.indexOf('ppdb') !== -1 || t.indexOf('daftar') !== -1 || t.indexOf('pendaftaran') !== -1) return sibotResponses.ppdb;
    if(t.indexOf('ekskul') !== -1 || t.indexOf('ekstrakurikuler') !== -1) return sibotResponses.ekskul;
    if(t.indexOf('jadwal') !== -1 || t.indexOf('jam') !== -1) return sibotResponses.jadwal;
    if(t.indexOf('pkl') !== -1 || t.indexOf('magang') !== -1 || t.indexOf('praktek') !== -1) return sibotResponses.pkl;
    if(t.indexOf('kontak') !== -1 || t.indexOf('alamat') !== -1 || t.indexOf('telepon') !== -1 || t.indexOf('hubungi') !== -1) return sibotResponses.kontak;
    if(t.indexOf('roadmap') !== -1 || t.indexOf('pengembangan') !== -1) return sibotResponses.roadmap;
    return sibotResponses.default;
  }

  function sendMsg() {
    var input = document.getElementById('sibotInput');
    var text = input.value.trim();
    if(!text) return;
    addMsg(text, true); input.value = '';
    showTyping();
    setTimeout(function(){ removeTyping(); addMsg(getResponse(text), false); }, 1200);
  }

  function sendQuick(text) { addMsg(text, true); showTyping(); setTimeout(function(){ removeTyping(); addMsg(getResponse(text), false); }, 1000); }

  /* ---- THEME SETTINGS ---- */
  function toggleThemePanel() {
    var panel = document.getElementById('themePanel');
    if(panel) panel.classList.toggle('open');
  }

  function applyThemeState(mode, color, silent) {
    document.body.classList.remove('theme-dark','theme-purple','theme-green','theme-rose','theme-gold');

    if(mode === 'dark') {
      document.body.classList.add('theme-dark');
    }

    if(color && color !== 'blue') {
      document.body.classList.add('theme-' + color);
    }

    document.querySelectorAll('.theme-btn').forEach(function(btn){ btn.classList.remove('active'); });
    var modeBtn = document.getElementById(
      mode === 'dark' ? 'themeDark' : (mode === 'light' ? 'themeLight' : 'themeDefault')
    );
    if(modeBtn) modeBtn.classList.add('active');

    document.querySelectorAll('.theme-color').forEach(function(btn){
      btn.classList.toggle('active', btn.dataset.color === (color || 'blue'));
    });

    if(!silent) {
      localStorage.setItem('smkn2Theme', JSON.stringify({
        mode: mode || 'default',
        color: color || 'blue'
      }));
    }
  }

  function setThemeMode(mode) {
    var saved = JSON.parse(localStorage.getItem('smkn2Theme') || '{"color":"blue"}');
    applyThemeState(mode, saved.color || 'blue', false);
  }

  function setThemeColor(color) {
    var saved = JSON.parse(localStorage.getItem('smkn2Theme') || '{"mode":"default"}');
    applyThemeState(saved.mode || 'default', color, false);
  }

  function resetTheme() {
    localStorage.removeItem('smkn2Theme');
    applyThemeState('default', 'blue', true);
  }

  (function loadThemeSettings(){
    var saved = JSON.parse(localStorage.getItem('smkn2Theme') || '{"mode":"default","color":"blue"}');
    applyThemeState(saved.mode || 'default', saved.color || 'blue', true);
  })();

  document.addEventListener('click', function(e) {
    var widget = document.querySelector('.theme-widget');
    var panel = document.getElementById('themePanel');
    if(widget && panel && !widget.contains(e.target)) {
      panel.classList.remove('open');
    }
  });

  /* Tutup mobile nav saat klik di luar */
  document.addEventListener('click', function(e) {
    var nav = document.querySelector('.nav-menu');
    var toggle = document.getElementById('navToggle');
    if (!nav.contains(e.target) && !toggle.contains(e.target)) {
      nav.classList.remove('open');
    }
  });
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
    })();
</script>
<script>
  // ---------- JURUSAN: FEATURED PROGRAM CAROUSEL (prev - active - next) ----------
  (function(){
    var stage = document.getElementById('carouselStage');
    if(!stage) return;
    var cards = Array.prototype.slice.call(stage.querySelectorAll('.carousel-card'));
    var prevBtn = document.getElementById('carouselPrev');
    var nextBtn = document.getElementById('carouselNext');
    var curEl = document.getElementById('carouselCur');
    var total = cards.length;
    var active = 4; // mulai dari RPL (index 4)
    var locked = false;

    var DUR = 650; // durasi transisi (ms) — harus sinkron dengan CSS .6s

    function computePos(i){
      if(i === active) return 'active';
      if(i === (active + 1) % total) return 'next';
      if(i === (active - 1 + total) % total) return 'prev';
      return 'hidden';
    }

    // Fase 1: kartu yang akan "pergi" dipindah ke hidden TERLEBIH DAHULU (tanpa transisi),
    // supaya kartu baru tidak berpindah melintasi stage (penyebab slide patah-patah).
    function setActive(idx){
      active = (idx + total) % total;
      cards.forEach(function(c, i){
        var pos = computePos(i);
        if(c.getAttribute('data-pos') === 'hidden' && pos !== 'hidden'){
          c.classList.add('no-anim');
          c.className = 'carousel-card hidden';
          void c.offsetWidth; // reflow: terapkan kelas hidden tanpa transisi
          c.classList.remove('no-anim');
        } else if(c.getAttribute('data-pos') !== 'hidden' && pos === 'hidden'){
          c.classList.add('no-anim');
          c.className = 'carousel-card hidden';
          void c.offsetWidth;
          c.classList.remove('no-anim');
        }
        c.className = 'carousel-card ' + pos;
        c.setAttribute('data-pos', pos);
      });
      if(curEl) curEl.textContent = ('0' + (active + 1)).slice(-2);
    }
    function goNext(){
      if(locked) return;
      locked = true;
      setActive(active + 1);
      setTimeout(function(){ locked = false; }, DUR);
    }
    function goPrev(){
      if(locked) return;
      locked = true;
      setActive(active - 1);
      setTimeout(function(){ locked = false; }, DUR);
    }

    cards.forEach(function(c){
      c.addEventListener('click', function(e){
        if(e.target.closest('a')) return; // biarkan link "Lihat Jurusan" bernavigasi
        var p = c.getAttribute('data-pos');
        if(p === 'next') goNext();
        else if(p === 'prev') goPrev();
      });
      c.addEventListener('keydown', function(e){
        if(e.key === 'Enter' || e.key === ' '){
          e.preventDefault();
          var p = c.getAttribute('data-pos');
          if(p === 'next') goNext(); else if(p === 'prev') goPrev();
        }
      });
    });
    if(prevBtn) prevBtn.addEventListener('click', goPrev);
    if(nextBtn) nextBtn.addEventListener('click', goNext);

    document.addEventListener('keydown', function(e){
      var s = document.getElementById('sambutan');
      if(s && s.classList.contains('open')) return; // jangan ganggu saat jendela terbuka
      if(e.key === 'ArrowLeft') goPrev();
      if(e.key === 'ArrowRight') goNext();
    });

    var startX = 0;
    stage.addEventListener('touchstart', function(e){ startX = e.touches[0].clientX; }, {passive:true});
    stage.addEventListener('touchend', function(e){
      var dx = e.changedTouches[0].clientX - startX;
      if(Math.abs(dx) > 40){ if(dx < 0) goNext(); else goPrev(); }
    }, {passive:true});

    setActive(active);
  })();

  /* ---- Berita filter tabs (Magazine) ---- */
  (function(){
    var tabs = Array.prototype.slice.call(document.querySelectorAll('.berita-tab'));
    if(!tabs.length) return;
    var feedItems = Array.prototype.slice.call(document.querySelectorAll('.berita-feed-item'));
    var gridCards = Array.prototype.slice.call(document.querySelectorAll('.berita-card'));
    var feedEmpty = document.getElementById('feedEmpty');
    var featured = document.querySelector('.berita-featured');
    function applyFilter(cat){
      var showAll = (cat === 'all');
      feedItems.forEach(function(it){
        var match = showAll || (it.getAttribute('data-cat') === cat);
        it.style.display = match ? '' : 'none';
      });
      gridCards.forEach(function(it){
        var match = showAll || (it.getAttribute('data-cat') === cat);
        it.style.display = match ? '' : 'none';
      });
      if(feedEmpty){
        var anyFeed = feedItems.some(function(it){ return it.style.display !== 'none'; });
        feedEmpty.style.display = anyFeed ? 'none' : 'block';
      }
      if(featured){
        var featMatch = showAll || (featured.getAttribute('data-cat') === cat);
        featured.style.display = featMatch ? '' : 'none';
      }
    }
    tabs.forEach(function(tab){
      tab.addEventListener('click', function(){
        tabs.forEach(function(t){ t.classList.remove('active'); });
        tab.classList.add('active');
        applyFilter(tab.getAttribute('data-cat'));
      });
    });
    applyFilter('all');
  })();

  /* ================= GALERI: FILTER PILLS + LIGHTBOX ================= */
  (function(){
    var pills = document.querySelectorAll('.galeri-pill');
    var cards = document.querySelectorAll('.gcard');
    var lightbox = document.getElementById('galeriLightbox');
    if(!lightbox || !cards.length) return;
    var lbImg = lightbox.querySelector('.lb-img');
    var lbCat = lightbox.querySelector('.lb-cat');
    var lbTitle = lightbox.querySelector('.lb-title');
    var lbDate = lightbox.querySelector('.lb-date-txt');
    var lbDots = lightbox.querySelector('.lb-dots');
    var lbClose = lightbox.querySelector('.lb-close');
    var lbPrev = lightbox.querySelector('.lb-prev');
    var lbNext = lightbox.querySelector('.lb-next');
    var current = [];
    var index = 0;

    function buildAlbum(card){
      var list = [];
      var cat = card.getAttribute('data-cat');
      var all = card.parentNode.querySelectorAll('.gcard');
      all.forEach(function(c){
        if(c.getAttribute('data-cat') === cat){ list.push(c); }
      });
      if(!list.length) list = [card];
      return list;
    }

    function render(){
      var c = current[index];
      var img = c.querySelector('.gcard-photo img');
      lbImg.src = img.getAttribute('src');
      lbImg.alt = img.getAttribute('alt') || '';
      lbCat.textContent = c.querySelector('.gcard-badge').textContent;
      lbCat.className = 'lb-cat ' + c.getAttribute('data-cat');
      lbTitle.textContent = c.querySelector('.gcard-title').textContent;
      lbDate.textContent = c.querySelector('.gcard-meta').textContent.trim();
      lbDots.innerHTML = '';
      current.forEach(function(_, i){
        var d = document.createElement('button');
        d.type = 'button';
        d.className = 'lb-dot' + (i === index ? ' active' : '');
        d.setAttribute('aria-label', 'Foto ' + (i + 1));
        d.addEventListener('click', function(){ index = i; render(); });
        lbDots.appendChild(d);
      });
    }

    function open(card){
      current = buildAlbum(card);
      index = current.indexOf(card);
      if(index < 0) index = 0;
      render();
      lightbox.classList.add('open');
      lightbox.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
    }

    function close(){
      lightbox.classList.remove('open');
      lightbox.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }

    function step(d){
      index = (index + d + current.length) % current.length;
      render();
    }

    cards.forEach(function(card){
      card.addEventListener('click', function(){ open(card); });
      card.addEventListener('keydown', function(e){
        if(e.key === 'Enter' || e.key === ' '){ e.preventDefault(); open(card); }
      });
    });
    lbClose.addEventListener('click', close);
    lbPrev.addEventListener('click', function(){ step(-1); });
    lbNext.addEventListener('click', function(){ step(1); });
    lightbox.addEventListener('click', function(e){ if(e.target === lightbox) close(); });
    document.addEventListener('keydown', function(e){
      if(!lightbox.classList.contains('open')) return;
      if(e.key === 'Escape') close();
      if(e.key === 'ArrowLeft') step(-1);
      if(e.key === 'ArrowRight') step(1);
    });

    pills.forEach(function(pill){
      pill.addEventListener('click', function(){
        pills.forEach(function(p){ p.classList.remove('active'); });
        pill.classList.add('active');
        var cat = pill.getAttribute('data-cat');
        cards.forEach(function(c){
          c.style.display = (cat === 'all' || c.getAttribute('data-cat') === cat) ? '' : 'none';
        });
      });
    });
  })();
</script>
<script>
/* ===== EKSKUL: ACTIVITY FEED (INSTAGRAM STYLE) — CARDS DATA ===== */
var FEED = [
  /* --- EKSTRAKURIKULER --- */
  {num:'01',img:'{{ asset('images/berita-robotik.png') }}',name:'Robotik',badge:'Teknologi',badgeCls:'teknologi',school:'SMKN 2 Mojokerto',cap:'Merakit mimpi jadi robot sungguhan.',tags:'#Robotik #SMKN2Mojokerto #Innovation',tagline:'Technology &amp; Innovation',about:'Eksplorasi teknologi, kreativitas, dan inovasi. Anggota merakit dan memprogram robot untuk kompetisi, dari KRCI hingga pameran sains.',members:'15',membersL:'Anggota',stats:['15','7','12'],statsL:['Anggota','Prestasi','Kegiatan'],act:['Rakit &amp; program robot KRCI','Workshop elektronika dasar','Kompetisi robotik pelajar'],desc:'Eksplorasi teknologi, kreativitas &amp; inovasi.',cta:'Lihat Profil Lengkap'},
  {num:'02',img:'{{ asset('images/berita-kuliner.png') }}',name:'Tata Boga',badge:'Seni',badgeCls:'seni',school:'SMKN 2 Mojokerto',cap:'Rasa yang lahir dari praktik, bukan teori.',tags:'#Kuliner #SMKN2Mojokerto #ChefMuda',tagline:'Culinary &amp; Creativity',about:'Mengasah keterampilan memasak, menghias hidangan, dan menyelenggarakan festival kuliner sekolah. Kreativitas dapur tanpa batas.',members:'22',membersL:'Anggota',stats:['22','5','14'],statsL:['Anggota','Prestasi','Kegiatan'],act:['Festival kuliner sekolah','Lomba memasak antar kelas','Praktik kue &amp; pastry'],desc:'Seni mengolah rasa dan kreativitas dapur.',cta:'Lihat Profil Lengkap'},
  {num:'03',img:'{{ asset('images/dkv.png') }}',name:'DKV',badge:'Seni',badgeCls:'seni',school:'SMKN 2 Mojokerto',cap:'Desain bukan sekadar gambar, tapi cerita.',tags:'#DKV #SMKN2Mojokerto #Design',tagline:'Design &amp; Visual Story',about:'Desain Komunikasi Visual: ilustrasi, poster, dan karya visual untuk event sekolah. Tempat menuangkan imajinasi menjadi karya nyata.',members:'18',membersL:'Anggota',stats:['18','6','10'],statsL:['Anggota','Prestasi','Kegiatan'],act:['Pameran karya DKV','Desain poster acara sekolah','Ilustrasi digital &amp; manual'],desc:'Karya visual, ilustrasi, dan desain grafis.',cta:'Lihat Profil Lengkap'},
  {num:'04',img:'{{ asset('images/berita-lks.png') }}',name:'Basket',badge:'Olahraga',badgeCls:'olahraga',school:'SMKN 2 Mojokerto',cap:'Satu bola, satu tim, satu tujuan.',tags:'#Basket #SMKN2Mojokerto #Sport',tagline:'Teamwork &amp; Sport',about:'Latihan basket membangun kerja sama tim, sportivitas, dan teknik dasar. Rutin mengikuti turnamen antar sekolah.',members:'18',membersL:'Anggota',stats:['18','3','9'],statsL:['Anggota','Prestasi','Kegiatan'],act:['Latihan rutin Rabu 15.30','Turnamen antar SMK','Sparring &amp; uji tanding'],desc:'Kerja sama tim dan sportivitas di lapangan.',cta:'Lihat Profil Lengkap'},
  {num:'05',img:'{{ asset('images/kuliner.png') }}',name:'Teater PENA',badge:'Seni',badgeCls:'seni',school:'SMKN 2 Mojokerto',cap:'Panggung tempat cerita kita hidup.',tags:'#Teater #SMKN2Mojokerto #SeniPanggung',tagline:'Stage &amp; Expression',about:'Seni mini teater: akting, penulisan naskah, dan manajemen panggung. Rutin pentas di acara sekolah dan luar sekolah.',members:'20',membersL:'Anggota',stats:['20','4','11'],statsL:['Anggota','Prestasi','Kegiatan'],act:['Pentas seni tahunan','Latihan akting &amp; improvisasi','Workshop penulisan naskah'],desc:'Akting, naskah, dan manajemen panggung.',cta:'Lihat Profil Lengkap'},
  {num:'06',img:'{{ asset('images/rpl.png') }}',name:'Jurnalistik',badge:'Teknologi',badgeCls:'teknologi',school:'SMKN 2 Mojokerto',cap:'Tulisan siswa, suara sekolah.',tags:'#Jurnalistik #SMKN2Mojokerto #MediaSekolah',tagline:'Writing &amp; Media',about:'Menulis berita, fotografi, dan pengelolaan media digital sekolah. Menjadi jembatan informasi warga sekolah.',members:'12',membersL:'Anggota',stats:['12','3','8'],statsL:['Anggota','Prestasi','Kegiatan'],act:['Liputan event sekolah','Majalah sekolah tahunan','Pelatihan fotografi'],desc:'Menulis, fotografi, dan media digital.',cta:'Lihat Profil Lengkap'},
  {num:'07',img:'{{ asset('images/berita-adiwiyata.png') }}',name:'Pramuka',badge:'Sosial',badgeCls:'sosial',school:'SMKN 2 Mojokerto',cap:'Siap jadi pribadi mandiri dan bermanfaat.',tags:'#Pramuka #SMKN2Mojokerto #Kemandirian',tagline:'Leadership &amp; Outdoor',about:'Kepramukaan membentuk kemandirian, kepemimpinan, dan cinta alam. Kegiatan meliputi perkemahan, keterampilan, dan pengabdian masyarakat.',members:'35',membersL:'Anggota',stats:['35','5','16'],statsL:['Anggota','Prestasi','Kegiatan'],act:['Perkemahan &amp; lomba tingkat','Latihan keterampilan kepramukaan','Aksi bakti lingkungan'],desc:'Kemandirian, kepemimpinan, cinta alam.',cta:'Lihat Profil Lengkap'},
  {num:'08',img:'{{ asset('images/berita-mou.png') }}',name:'Pencak Silat',badge:'Olahraga',badgeCls:'olahraga',school:'SMKN 2 Mojokerto',cap:'Disiplin diri, jaga budaya.',tags:'#PencakSilat #SMKN2Mojokerto #Beladiri',tagline:'Martial Arts &amp; Discipline',about:'Beladiri, disiplin, dan pembentukan karakter lewat pencak silat. Anggota dilatih jurus, teknik, dan nilai-nilai luhur.',members:'25',membersL:'Anggota',stats:['25','6','10'],statsL:['Anggota','Prestasi','Kegiatan'],act:['Latihan rutin Jumat 15.30','Kejuaraan silat pelajar','Latihan jurus &amp; teknik'],desc:'Beladiri, disiplin, dan pembentukan karakter.',cta:'Lihat Profil Lengkap'},
  {num:'09',img:'{{ asset('images/aphp.png') }}',name:'PMR',badge:'Sosial',badgeCls:'sosial',school:'SMKN 2 Mojokerto',cap:'Siaga menolong, berani berbagi.',tags:'#PMR #SMKN2Mojokerto #Sosial',tagline:'Health &amp; Humanity',about:'Palang Merah Remaja mengajarkan pertolongan pertama, kesehatan, dan aksi sosial kemanusiaan. Siap siaga di setiap event sekolah.',members:'28',membersL:'Anggota',stats:['28','4','13'],statsL:['Anggota','Prestasi','Kegiatan'],act:['P3K &amp; siaga event sekolah','Aksi donor darah','Pelatihan kesehatan remaja'],desc:'Pertolongan pertama &amp; aksi sosial.',cta:'Lihat Profil Lengkap'},
  {num:'10',img:'{{ asset('images/berita-kelulusan.png') }}',name:'BTQ',badge:'Keagamaan',badgeCls:'keagamaan',school:'SMKN 2 Mojokerto',cap:'Membaca, menulis, dan menghayati.',tags:'#BTQ #SMKN2Mojokerto #Spiritual',tagline:'Spiritual &amp; Akhlak',about:'Baca Tulis Qur\u2019an membangun akhlak dan spiritualitas siswa melalui pembelajaran membaca, menulis, dan memahami Al-Qur\u2019an.',members:'26',membersL:'Anggota',stats:['26','3','12'],statsL:['Anggota','Prestasi','Kegiatan'],act:['Khataman tahunan','Tahsin &amp; tahfidz','Kajian mingguan'],desc:'Baca Tulis Qur\u2019an &amp; pembinaan akhlak.',cta:'Lihat Profil Lengkap'},
  {num:'11',img:'{{ asset('images/smkn-guru.jpg') }}',name:'Paskibra',badge:'Sosial',badgeCls:'sosial',school:'SMKN 2 Mojokerto',cap:'Tegap melangkah, bangga mengibarkan.',tags:'#Paskibra #SMKN2Mojokerto #Disiplin',tagline:'Discipline &amp; Pride',about:'Latihan baris-berbaris dan pengibaran bendera upacara. Bertugas pada upacara bendera dan hari besar nasional.',members:'30',membersL:'Anggota',stats:['30','2','9'],statsL:['Anggota','Prestasi','Kegiatan'],act:['Upacara HUT RI','Latihan PBB rutin','Rekrutmen anggota baru'],desc:'Baris-berbaris &amp; pengibaran bendera.',cta:'Lihat Profil Lengkap'},
  {num:'12',img:'{{ asset('images/berita-ppdb.png') }}',name:'Banjari',badge:'Seni',badgeCls:'seni',school:'SMKN 2 Mojokerto',cap:'Tabuhan rebana, syahdu di hati.',tags:'#Banjari #SMKN2Mojokerto #Hadrah',tagline:'Hadrah &amp; Shalawat',about:'Seni hadrah dan shalawat dengan tabuhan rebana. Melatih kekompakan, vokal, dan penghayatan seni islami.',members:'22',membersL:'Anggota',stats:['22','2','8'],statsL:['Anggota','Prestasi','Kegiatan'],act:['Tampil di acara sekolah','Latihan vokal &amp; rebana','Tampil di PHBI'],desc:'Seni hadrah &amp; shalawat dengan rebana.',cta:'Lihat Profil Lengkap'},
  /* --- ORGANISASI --- */
  {num:'01',img:'{{ asset('images/berita-ppdb.png') }}',name:'OSIS',badge:'Organisasi',badgeCls:'sosial',school:'SMKN 2 Mojokerto',cap:'Ruang bagi siswa untuk belajar memimpin, berkolaborasi, dan mewujudkan kegiatan sekolah.',tags:'#OSIS #SMKN2Mojokerto #Leadership',tagline:'Student Council &amp; Leadership',about:'Organisasi induk siswa yang menaungi seluruh kegiatan siswa. Berperan dalam perencanaan event, aspirasi, dan pengembangan sekolah.',members:'40',membersL:'Pengurus',stats:['40','12','25'],statsL:['Pengurus','Program','Kegiatan'],act:['Menyusun program kerja tahunan','Menyelenggarakan event sekolah','Menyalurkan aspirasi siswa'],desc:'Organisasi induk kegiatan siswa.',cta:'Lihat Profil Lengkap'},
  {num:'02',img:'{{ asset('images/berita-mou.png') }}',name:'MPK',badge:'Organisasi',badgeCls:'sosial',school:'SMKN 2 Mojokerto',cap:'Suara kelas, didengar sekolah.',tags:'#MPK #SMKN2Mojokerto #Advokasi',tagline:'Representation &amp; Advocacy',about:'Majelis Perwakilan Kelas menjembatani aspirasi antar kelas dan mengawasi kinerja OSIS. Melatih advokasi dan kepemimpinan.',members:'30',membersL:'Anggota',stats:['30','8','15'],statsL:['Anggota','Program','Kegiatan'],act:['Rapat pleno pengawasan OSIS','Mengelola aspirasi kelas','Program kerja tahunan'],desc:'Wadah aspirasi &amp; pengawasan OSIS.',cta:'Lihat Profil Lengkap'},
  {num:'03',img:'{{ asset('images/berita-adiwiyata.png') }}',name:'Dewan Ambalan',badge:'Organisasi',badgeCls:'sosial',school:'SMKN 2 Mojokerto',cap:'Penegak yang siap berkarya dan mengabdi.',tags:'#DewanAmbalan #SMKN2Mojokerto #Pramuka',tagline:'Scouting &amp; Community',about:'Organisasi kepramukaan tingkat penegak. Mengelola kegiatan ambalan, pelantikan, dan pengabdian masyarakat.',members:'25',membersL:'Anggota',stats:['25','6','12'],statsL:['Anggota','Prestasi','Kegiatan'],act:['Pelantikan &amp; perkemahan','Pengabdian masyarakat','Kegiatan ambalan rutin'],desc:'Kepramukaan tingkat penegak.',cta:'Lihat Profil Lengkap'},
  {num:'04',img:'{{ asset('images/aphp.png') }}',name:'PMR',badge:'Organisasi',badgeCls:'sosial',school:'SMKN 2 Mojokerto',cap:'Relawan muda siap siaga.',tags:'#PMR #SMKN2Mojokerto #Relawan',tagline:'Volunteer &amp; Health',about:'Organisasi bergerak di bidang kesehatan dan sosial. Melatih anggota menjadi relawan siaga di lingkungan sekolah.',members:'28',membersL:'Anggota',stats:['28','4','13'],statsL:['Anggota','Prestasi','Kegiatan'],act:['Siaga kesehatan event','Aksi sosial rutin','Pelatihan relawan'],desc:'Kesehatan, sosial, dan kerelawanan.',cta:'Lihat Profil Lengkap'},
  {num:'05',img:'{{ asset('images/berita-kelulusan.png') }}',name:'Rohis',badge:'Organisasi',badgeCls:'keagamaan',school:'SMKN 2 Mojokerto',cap:'Menebar kebaikan lewat kajian.',tags:'#Rohis #SMKN2Mojokerto #Keagamaan',tagline:'Spiritual &amp; Community',about:'Rohani Islam menjadi wadah kegiatan keagamaan, kajian, dan pembinaan akhlak siswa muslim di sekolah.',members:'35',membersL:'Anggota',stats:['35','5','14'],statsL:['Anggota','Prestasi','Kegiatan'],act:['Kajian rutin Jumat','Peringatan hari besar islam','Bakti sosial'],desc:'Wadah kegiatan keagamaan siswa.',cta:'Lihat Profil Lengkap'},
  {num:'06',img:'{{ asset('images/kuliner.png') }}',name:'Kopsis',badge:'Organisasi',badgeCls:'sosial',school:'SMKN 2 Mojokerto',cap:'Belajar usaha sejak bangku sekolah.',tags:'#Kopsis #SMKN2Mojokerto #Wirausaha',tagline:'Entrepreneurship &amp; Economy',about:'Koperasi Siswa mengajarkan kewirausahaan dan ekonomi praktis. Mengelola kantin dan usaha kecil siswa.',members:'20',membersL:'Pengurus',stats:['20','4','10'],statsL:['Pengurus','Program','Kegiatan'],act:['Mengelola koperasi &amp; kantin','Pelatihan kewirausahaan','Bazar &amp; pasar siswa'],desc:'Kewirausahaan &amp; ekonomi praktis.',cta:'Lihat Profil Lengkap'}
];

var FEED_ROOT = null; /* kartu statis: dirender langsung di HTML (16 item) */
if(FEED_ROOT){
  FEED.forEach(function(d,i){
    var article = document.createElement('article');
    article.className = 'feed-card' + (i > 2 ? ' feed-extra' : '');
    article.tabIndex = 0;
    article.setAttribute('role','button');
    article.setAttribute('aria-label','Kartu ' + d.name + '. Klik untuk membalik kartu.');
    article.innerHTML =
      '<div class="feed-inner">' +
        '<div class="feed-face feed-front">' +
          '<div class="feed-post-head">' +
            '<img class="feed-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="SMKN 2 Mojokerto">' +
            '<div><div class="feed-school">skaneda</div><div class="feed-sub2">SMKN 2 Mojokerto</div></div>' +
            '<span class="feed-num">' + d.num + '</span>' +
          '</div>' +
          '<div class="feed-photo"><img src="' + d.img + '" alt="' + d.name + ' SMKN 2 Mojokerto" loading="lazy"></div>' +
          '<div class="feed-actions"><i class="fa-regular fa-heart feed-ic heart" aria-hidden="true"></i><i class="fa-regular fa-paper-plane feed-ic share"></i></div>' +
          '<div class="feed-caption">' +
            '<b>' + d.name + '</b>' +
            '<span class="fc-line">' + d.cap + '</span>' +
            '<span class="feed-tags">' + d.tags + '</span>' +
          '</div>' +
        '</div>' +
        '<div class="feed-face feed-back">' +
          '<div class="feed-back-top"><i class="fa-solid fa-arrow-left b-arrow" aria-hidden="true"></i><span class="b-name">' + d.name + '</span><span class="b-num">' + d.num + '</span></div>' +
          '<img class="feed-back-avatar" src="{{ asset('images/logo_smkn2.png') }}" alt="' + d.name + '">' +
          '<div class="feed-tagline">' + d.tagline + '</div>' +
          '<div class="divider"></div>' +
          '<h5>Tentang</h5>' +
          '<p class="feed-about">' + d.about + '</p>' +
          '<div class="feed-stats">' +
            '<div class="feed-stat"><b>' + d.stats[0] + '</b><span>' + d.statsL[0] + '</span></div>' +
            '<div class="feed-stat"><b>' + d.stats[1] + '</b><span>' + d.statsL[1] + '</span></div>' +
            '<div class="feed-stat"><b>' + d.stats[2] + '</b><span>' + d.statsL[2] + '</span></div>' +
          '</div>' +
          '<h5>Aktivitas</h5>' +
          '<ul class="feed-act">' +
            '<li>' + d.act[0] + '</li>' +
            '<li>' + d.act[1] + '</li>' +
            '<li>' + d.act[2] + '</li>' +
          '</ul>' +

        '</div>' +
      '</div>';
    FEED_ROOT.appendChild(article);
  });
}

/* ===== EKSKUL: ACTIVITY FEED (INSTAGRAM STYLE + FLIP) ===== */
(function(){
  var root = document.getElementById('ekskul');
  if(!root) return;

  /* FLIP interaction: click / tap / keyboard toggles front <-> back */
  var cards = root.querySelectorAll('.feed-card');
  cards.forEach(function(c){
    c.addEventListener('click', function(){
      c.classList.toggle('flipped');
    });
    c.addEventListener('keydown', function(e){
      if(e.key === 'Enter' || e.key === ' '){ e.preventDefault(); c.classList.toggle('flipped'); }
    });
  });

  /* "Lihat Semua" toggles (reveal hidden cards) */
  function setupToggle(btnId, gridId, label){
    var btn = document.getElementById(btnId);
    var grid = document.getElementById(gridId);
    if(!btn || !grid) return;
    btn.addEventListener('click', function(){
      var extras = grid.querySelectorAll('.feed-card.feed-extra');
      var nowShow = !grid.querySelector('.feed-card.feed-extra.show');
      extras.forEach(function(c){ c.classList.toggle('show', nowShow); });
      btn.innerHTML = nowShow ? 'Tutup <i class="fa-solid fa-arrow-up" aria-hidden="true"></i>' : label;
      if(nowShow){
        var first = extras[0];
        if(first) setTimeout(function(){ first.scrollIntoView({behavior:'smooth', block:'nearest'}); }, 120);
      }
    });
  }
  setupToggle('ekskulToggle', 'feedEkskul', 'Lihat Semua Ekstrakurikuler <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>');
  setupToggle('orgToggle', 'feedOrg', 'Lihat Semua Organisasi <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>');
})();
</script>
</body>
</html>