{{-- resources/views/admin/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="{{ asset('images/logo_smkn2.png') }}">
  <title>Admin Login — SMK Negeri 2 Mojokerto</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    :root{
      --teal:#1d6fb8;
      --teal-dark:#13518c;
      --teal-deep:#0d3a66;
      --teal-light:#28a9e1;
      --gold:#ffb300;
      --ink:#0d2d50;
      --text-muted:#5d7288;
      --font-display:'Archivo Black',sans-serif;
      --font-body:'Plus Jakarta Sans',sans-serif;
      --ease:cubic-bezier(.22,.61,.36,1);
    }
    *{margin:0;padding:0;box-sizing:border-box}
    html{scroll-behavior:smooth}
    body{
      font-family:var(--font-body);
      color:#fff;
      min-height:100vh;
      position:relative;
      overflow-x:hidden;
      -webkit-font-smoothing:antialiased;
      isolation:isolate;
    }
    img{max-width:100%;display:block}
    a{text-decoration:none;color:inherit}
    button{font-family:inherit;cursor:pointer}

    /* ===== CINEMATIC BACKGROUND (sama seperti hero beranda) ===== */
    .al-bg{
      position:fixed;inset:0;z-index:-2;
      background-image:url('{{ asset('images/hero-sekolah.jpg') }}');
      background-size:cover;background-position:center;background-repeat:no-repeat;
      animation:alBgIn 1.8s cubic-bezier(.22,.61,.36,1) both;
    }
    @keyframes alBgIn{from{transform:scale(1.05)}to{transform:scale(1)}}
    .al-bg::before{
      content:"";position:absolute;inset:0;
      background:linear-gradient(160deg,rgba(6,18,34,.92) 0%,rgba(8,30,54,.88) 42%,rgba(9,33,58,.82) 70%,rgba(9,33,58,.9) 100%);
    }
    .al-bg::after{
      content:"ADMIN";position:absolute;z-index:1;left:50%;top:50%;transform:translate(-50%,-52%);
      font-family:var(--font-display);font-size:clamp(6rem,22vw,22rem);font-weight:900;line-height:.82;
      letter-spacing:.02em;color:rgba(255,255,255,.035);-webkit-text-stroke:1px rgba(255,255,255,.05);
      pointer-events:none;white-space:nowrap;user-select:none;
    }

    /* ===== Ornamen ring & diamond gold (identik dengan section Sambutan) ===== */
    .al-orn{position:fixed;inset:0;z-index:-1;pointer-events:none;overflow:hidden}
    .al-orn::before{
      content:"";position:absolute;width:420px;height:420px;left:-220px;top:8%;
      border:1px solid rgba(255,179,0,.16);border-radius:50%;
      box-shadow:0 0 0 26px rgba(255,179,0,.02),0 0 0 52px rgba(13,58,102,.05);
    }
    .al-orn::after{
      content:"";position:absolute;width:300px;height:300px;right:-140px;bottom:6%;
      border:1px solid rgba(255,255,255,.08);border-radius:50%;
    }
    .al-diamond{position:fixed;z-index:-1;width:60px;height:60px;right:9%;top:14%;
      border:2px solid rgba(255,213,74,.32);transform:rotate(45deg);
      animation:alDiamond 8s ease-in-out infinite;pointer-events:none}
    @keyframes alDiamond{0%,100%{transform:rotate(45deg) translateY(0);opacity:.5}50%{transform:rotate(45deg) translateY(-10px);opacity:.9}}
    .al-dots{position:fixed;z-index:-1;width:80px;height:80px;left:8%;bottom:12%;
      background-image:radial-gradient(circle,rgba(255,213,74,.28) 2px,transparent 2.6px);
      background-size:14px 14px;opacity:.6;pointer-events:none}

    @media(prefers-reduced-motion:reduce){.al-bg,.al-diamond{animation:none}}

    /* ===== LAYOUT: dua kolom — info kiri, card kanan ===== */
    .al-page{position:relative;z-index:2;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:2.4rem 1.4rem}
    .al-wrap{
      width:100%;max-width:980px;
      display:flex;align-items:center;gap:3.6rem;
    }
    .al-info{flex:1 1 46%;min-width:0}
    .al-form-col{flex:0 0 452px;max-width:452px}

    /* ===== Eyebrow badge, sama gaya hd-eyebrow ===== */
    .al-eyebrow{
      display:inline-flex;align-items:center;gap:.75rem;margin:0 0 1.6rem;
      font-size:.72rem;font-weight:700;letter-spacing:.2em;text-transform:uppercase;color:#fff7e3;
      padding:.55rem 1.1rem;border:1px solid rgba(255,255,255,.28);border-radius:999px;
      background:rgba(13,58,102,.32);backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);
    }
    .al-eyebrow-dot{width:8px;height:8px;flex:0 0 8px;background:var(--gold);border-radius:50%;box-shadow:0 0 0 3px rgba(255,179,0,.16)}

    /* ===== Brand lockup (rapi, satu baris, tidak pecah) ===== */
    .al-brand-row{
      display:flex;align-items:center;gap:1.1rem;
      margin-bottom:1.8rem;
    }
    .al-brand-row img{width:64px;height:64px;object-fit:contain;flex:0 0 64px}
    .al-brand-name{
      text-align:left;line-height:1.15;
      padding-left:1.1rem;
      border-left:2px solid rgba(255,213,74,.35);
    }
    .al-brand-name .al-school-line{
      display:block;font-family:var(--font-display);
      font-size:1.7rem;letter-spacing:.01em;color:#fff;
      text-transform:uppercase;white-space:nowrap;
    }
    .al-brand-name .num-2{color:var(--gold)}
    .al-brand-name .al-role-line{
      display:block;margin-top:.4rem;
      font-size:.8rem;font-weight:700;letter-spacing:.22em;
      text-transform:uppercase;color:rgba(255,213,74,.8);
    }

    .al-head{text-align:left;margin-bottom:0}
    .al-title{
      font-family:var(--font-display);font-size:clamp(2rem,3.2vw,2.9rem);line-height:1.05;
      color:#fff;text-transform:uppercase;letter-spacing:.01em;margin-bottom:.9rem;
    }
    .al-title .gold{
      background:linear-gradient(135deg,#ffd54a 0%,#ffb300 45%,#ff7a00 100%);
      -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent;
    }
    .al-desc{color:rgba(235,245,253,.68);font-size:.92rem;line-height:1.7;max-width:400px}

    /* ===== Kartu glass, senada window-frame ===== */
    .al-card{
      position:relative;border-radius:24px;overflow:hidden;
      background:rgba(10,38,66,.55);
      backdrop-filter:blur(18px) saturate(140%);-webkit-backdrop-filter:blur(18px) saturate(140%);
      border:1px solid rgba(255,255,255,.14);
      outline:1px solid rgba(255,179,0,.32);outline-offset:6px;
      box-shadow:0 30px 80px rgba(3,12,24,.5),inset 0 1px 0 rgba(255,255,255,.06);
      padding:2.3rem 2.1rem;
    }
    .al-card::before{
      content:"";position:absolute;inset:0;z-index:0;pointer-events:none;
      background:linear-gradient(120deg,rgba(255,255,255,.05) 0%,transparent 40%);
    }
    .al-card>*{position:relative;z-index:1}

    .al-group{margin-bottom:1.2rem}
    .al-label{display:block;font-size:.76rem;font-weight:700;color:rgba(255,255,255,.85);margin-bottom:.5rem;letter-spacing:.03em}
    .al-input-wrap{position:relative;display:flex;align-items:center}
    .al-input-wrap i.al-icon{position:absolute;left:15px;color:var(--gold);font-size:.9rem;z-index:2}
    .al-input{
      width:100%;padding:.85rem 1rem .85rem 2.6rem;
      border:1.5px solid rgba(255,255,255,.16);border-radius:13px;
      font-family:inherit;font-size:.92rem;color:#fff;
      background:rgba(255,255,255,.06);
      transition:all .25s var(--ease);outline:none;
    }
    .al-input::placeholder{color:rgba(255,255,255,.38)}
    .al-input:focus{
      border-color:var(--gold);background:rgba(255,255,255,.1);
      box-shadow:0 0 0 4px rgba(255,179,0,.14);
    }
    .al-toggle-pass{position:absolute;right:14px;z-index:2;background:none;border:0;color:rgba(255,255,255,.55);font-size:.9rem;padding:.2rem;line-height:1}
    .al-toggle-pass:hover{color:var(--gold)}

    .al-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.6rem;gap:.8rem}
    .al-remember{display:flex;align-items:center;gap:.5rem}
    .al-remember input[type="checkbox"]{width:16px;height:16px;accent-color:var(--gold);cursor:pointer}
    .al-remember label{font-size:.79rem;color:rgba(255,255,255,.65);cursor:pointer}
    .al-forgot{font-size:.79rem;color:#ffd54a;font-weight:600;white-space:nowrap}
    .al-forgot:hover{color:#fff}

    .al-btn{
      width:100%;padding:.9rem 1rem;border:0;border-radius:13px;
      background:linear-gradient(135deg,#f9a825,#f08c00);
      color:#0d3a66;font-weight:800;font-size:.92rem;letter-spacing:.02em;
      text-transform:uppercase;
      box-shadow:0 14px 34px rgba(249,168,37,.32);
      transition:all .3s var(--ease);
      display:flex;align-items:center;justify-content:center;gap:.6rem;
    }
    .al-btn:hover{transform:translateY(-2px);box-shadow:0 18px 42px rgba(249,168,37,.42);background:linear-gradient(135deg,#ffb43a,#ff9d0e)}
    .al-btn:active{transform:translateY(0)}
    .al-btn i{transition:transform .3s var(--ease)}
    .al-btn:hover i{transform:translateX(4px)}

    .al-alert{
      display:flex;align-items:flex-start;gap:.65rem;
      background:rgba(226,75,74,.14);border:1px solid rgba(226,75,74,.4);color:#ffd7d5;
      font-size:.82rem;border-radius:12px;padding:.8rem .95rem;margin-bottom:1.4rem;line-height:1.55;
    }
    .al-alert i{margin-top:2px;flex-shrink:0;color:#ff9d9b}

    .al-field-error{color:#ffb4b1;font-size:.73rem;margin-top:.45rem;display:flex;align-items:center;gap:.35rem}

    .al-divider{height:1px;background:rgba(255,255,255,.1);margin:1.9rem 0 1.5rem}

    .al-back{
      display:flex;align-items:center;justify-content:center;gap:.5rem;
      font-size:.82rem;color:rgba(255,255,255,.55);font-weight:600;
      transition:color .25s var(--ease);
    }
    .al-back:hover{color:#fff}
    .al-back i{transition:transform .25s var(--ease)}
    .al-back:hover i{transform:translateX(-3px)}

    .al-footnote{text-align:center;font-size:.68rem;color:rgba(255,255,255,.32);margin-top:1.8rem;letter-spacing:.03em}

    @media(max-width:860px){
      .al-wrap{flex-direction:column;gap:2.2rem;max-width:452px}
      .al-info{text-align:center;width:100%}
      .al-eyebrow{margin:0 auto 1.6rem}
      .al-brand-row{justify-content:center}
      .al-head{text-align:center}
      .al-desc{margin:0 auto}
      .al-form-col{flex:1 1 auto;width:100%;max-width:452px}
    }
    @media(max-width:480px){
      .al-card{padding:1.9rem 1.5rem;border-radius:20px}
      .al-brand-row{gap:.85rem}
      .al-brand-row img{width:52px;height:52px;flex:0 0 52px}
      .al-brand-name{padding-left:.85rem}
      .al-brand-name .al-school-line{font-size:1.4rem}
      .al-brand-name .al-role-line{font-size:.68rem}
    }
  </style>
</head>
<body>

  <div class="al-bg" aria-hidden="true"></div>
  <div class="al-orn" aria-hidden="true"></div>
  <div class="al-diamond" aria-hidden="true"></div>
  <div class="al-dots" aria-hidden="true"></div>

  <div class="al-page">
    <div class="al-wrap">

      <div class="al-info">
        <div class="al-eyebrow"><span class="al-eyebrow-dot"></span> Area Terbatas</div>

        <div class="al-brand-row">
          <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMK Negeri 2 Mojokerto" />
          <div class="al-brand-name">
            <span class="al-school-line">SMKN <span class="num-2">2</span> Mojokerto</span>
            <span class="al-role-line">Panel Administrator</span>
          </div>
        </div>

        <div class="al-head">
          <h1 class="al-title">Masuk ke <span class="gold">Dashboard</span></h1>
          <p class="al-desc">Khusus staf dan pengelola website SKANEDA. Masukkan kredensial untuk melanjutkan.</p>
        </div>
      </div>

      <div class="al-form-col">
      <div class="al-card">

        @if (session('error'))
          <div class="al-alert">
            <i class="fas fa-circle-exclamation"></i>
            <span>{{ session('error') }}</span>
          </div>
        @endif

        @if ($errors->any() && !$errors->has('email') && !$errors->has('password'))
          <div class="al-alert">
            <i class="fas fa-circle-exclamation"></i>
            <span>{{ $errors->first() }}</span>
          </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" novalidate>
          @csrf

          <div class="al-group">
            <label class="al-label" for="email">Email</label>
            <div class="al-input-wrap">
              <i class="fas fa-envelope al-icon"></i>
              <input
                type="email"
                id="email"
                name="email"
                class="al-input"
                placeholder="admin@smkn2mojokerto.sch.id"
                value="{{ old('email') }}"
                autocomplete="username"
                autofocus
                required
              />
            </div>
            @error('email')
              <div class="al-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
            @enderror
          </div>

          <div class="al-group">
            <label class="al-label" for="password">Kata sandi</label>
            <div class="al-input-wrap">
              <i class="fas fa-lock al-icon"></i>
              <input
                type="password"
                id="password"
                name="password"
                class="al-input"
                placeholder="Masukkan kata sandi"
                autocomplete="current-password"
                required
              />
              <button type="button" class="al-toggle-pass" id="togglePass" aria-label="Tampilkan kata sandi">
                <i class="fas fa-eye" id="togglePassIcon"></i>
              </button>
            </div>
            @error('password')
              <div class="al-field-error"><i class="fas fa-circle-exclamation"></i> {{ $message }}</div>
            @enderror
          </div>

          <div class="al-row">
            <div class="al-remember">
              <input type="checkbox" id="remember" name="remember" />
              <label for="remember">Ingat saya</label>
            </div>
            <a href="#" class="al-forgot">Lupa sandi?</a>
          </div>

          <button type="submit" class="al-btn">
            <i class="fas fa-right-to-bracket"></i>
            Masuk
          </button>
        </form>

        <div class="al-divider"></div>

        <a href="{{ route('home') }}" class="al-back">
          <i class="fas fa-arrow-left"></i> Kembali ke beranda
        </a>
      </div>

      <div class="al-footnote">&copy; {{ date('Y') }} SMK Negeri 2 Mojokerto &middot; Akses ini dipantau dan dibatasi</div>
      </div>

    </div>
  </div>

  <script>
    const togglePass = document.getElementById('togglePass');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('togglePassIcon');
    if (togglePass && passwordInput && toggleIcon) {
      togglePass.addEventListener('click', () => {
        const isHidden = passwordInput.type === 'password';
        passwordInput.type = isHidden ? 'text' : 'password';
        toggleIcon.classList.toggle('fa-eye', !isHidden);
        toggleIcon.classList.toggle('fa-eye-slash', isHidden);
        togglePass.setAttribute('aria-label', isHidden ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
      });
    }
  </script>

</body>
</html>