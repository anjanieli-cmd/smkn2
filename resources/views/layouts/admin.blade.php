{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="{{ asset('images/logo_smkn2.png') }}">
  <title>@yield('title', 'Admin Panel — SMK Negeri 2 Mojokerto')</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    :root{
      --teal:#1d6fb8;
      --teal-dark:#13518c;
      --teal-deep:#0d3a66;
      --navy-bg:#081b30;
      --navy-panel:#0c2846;
      --navy-panel-2:#0f2f52;
      --gold:#ffb300;
      --gold-light:#ffd54a;
      --ink:#0d2d50;
      --text-muted:#8ea3ba;
      --text-dim:#5d7288;
      --font-display:'Poppins',sans-serif;
      --font-body:'Plus Jakarta Sans',sans-serif;
      --ease:cubic-bezier(.22,.61,.36,1);
      --sidebar-w:272px;
    }
    html{font-size:17px}
    *{margin:0;padding:0;box-sizing:border-box}
    body{
      font-family:var(--font-body);
      background:var(--navy-bg);
      background-image:radial-gradient(1100px 500px at 100% -10%, rgba(29,111,184,.16), transparent 60%);
      color:#fff;
      min-height:100vh;
      -webkit-font-smoothing:antialiased;
    }
    img{max-width:100%;display:block}
    a{text-decoration:none;color:inherit}
    button{font-family:inherit;cursor:pointer}
    ::-webkit-scrollbar{width:8px;height:8px}
    ::-webkit-scrollbar-thumb{background:rgba(255,255,255,.14);border-radius:8px}

    /* ===================== SIDEBAR ===================== */
    .db-sidebar{
      position:fixed;top:0;left:0;bottom:0;width:var(--sidebar-w);
      background:linear-gradient(180deg,#0a2036 0%,#081729 100%);
      border-right:1px solid rgba(255,255,255,.08);
      display:flex;flex-direction:column;
      z-index:40;transition:transform .3s var(--ease);
    }
    .db-side-brand{
      display:flex;align-items:center;gap:.85rem;
      padding:1.5rem 1.4rem;border-bottom:1px solid rgba(255,255,255,.08);
    }
    .db-side-brand img{width:42px;height:42px;object-fit:contain;flex:0 0 42px;border-radius:9px}
    .db-side-brand .name{
      font-family:var(--font-display);font-weight:700;font-size:1.15rem;color:#fff;
      letter-spacing:0;line-height:1.25;white-space:nowrap;
    }
    .db-side-brand .name .num-2{color:var(--gold)}
    .db-side-brand .role{
      display:block;margin-top:.25rem;font-size:.62rem;font-weight:700;
      letter-spacing:.18em;text-transform:uppercase;color:rgba(255,213,74,.75);
    }

    .db-nav{flex:1;overflow-y:auto;padding:1.1rem .9rem 1.5rem}
    .db-nav-group{margin-bottom:1.3rem}
    .db-nav-title{
      display:flex;align-items:center;gap:.4rem;
      font-size:.66rem;font-weight:800;letter-spacing:.16em;text-transform:uppercase;
      color:var(--text-dim);padding:0 .7rem;margin-bottom:.55rem;
    }
    .db-nav-title i{font-size:.62rem;opacity:.7}
    .db-nav-item{
      display:flex;align-items:center;gap:.75rem;
      padding:.62rem .7rem;border-radius:11px;margin-bottom:.2rem;
      font-size:.85rem;font-weight:600;color:rgba(255,255,255,.72);
      transition:all .2s var(--ease);position:relative;cursor:pointer;
    }
    .db-nav-item i{width:18px;text-align:center;font-size:.92rem;color:rgba(255,255,255,.5);transition:color .2s var(--ease)}
    .db-nav-item:hover{background:rgba(255,255,255,.06);color:#fff;transform:translateX(2px)}
    .db-nav-item:hover i{color:var(--gold-light)}
    .db-nav-item.active{
      background:linear-gradient(135deg,rgba(255,179,0,.18),rgba(255,179,0,.06));
      color:#fff;box-shadow:inset 0 0 0 1px rgba(255,179,0,.28);
    }
    .db-nav-item.active::before{
      content:'';position:absolute;left:-.9rem;top:50%;transform:translateY(-50%);
      width:3px;height:60%;border-radius:3px;background:var(--gold);
    }
    .db-nav-item.active i{color:var(--gold)}
    .db-nav-item .badge{
      margin-left:auto;background:rgba(226,75,74,.85);color:#fff;font-size:.66rem;
      font-weight:800;padding:.12rem .45rem;border-radius:999px;line-height:1.4;
    }

    .db-side-foot{padding:1rem 1.1rem;border-top:1px solid rgba(255,255,255,.08)}
    .db-logout{
      display:flex;align-items:center;gap:.7rem;padding:.65rem .7rem;border-radius:11px;
      font-size:.85rem;font-weight:700;color:#ffb4b1;background:rgba(226,75,74,.1);
      transition:background .2s var(--ease);
    }
    .db-logout:hover{background:rgba(226,75,74,.2)}

    /* ===================== MAIN ===================== */
    .db-main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}

    .db-topbar{
      position:sticky;top:0;z-index:30;
      display:flex;align-items:center;gap:1rem;
      padding:1rem 2rem;background:rgba(8,27,48,.78);
      backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);
      border-bottom:1px solid rgba(255,255,255,.08);
    }
    .db-burger{
      display:none;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);
      color:#fff;width:38px;height:38px;border-radius:10px;font-size:.95rem;
      align-items:center;justify-content:center;flex:0 0 38px;
    }
    .db-search{
      flex:1;max-width:420px;position:relative;display:flex;align-items:center;
    }
    .db-search i{position:absolute;left:14px;color:var(--text-muted);font-size:.85rem}
    .db-search input{
      width:100%;padding:.65rem .9rem .65rem 2.4rem;border-radius:10px;
      background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);
      color:#fff;font-size:.84rem;outline:none;transition:all .2s var(--ease);
    }
    .db-search input::placeholder{color:var(--text-muted)}
    .db-search input:focus{border-color:var(--gold);background:rgba(255,255,255,.09);box-shadow:0 0 0 3px rgba(255,179,0,.12)}

    .db-top-right{margin-left:auto;display:flex;align-items:center;gap:1.1rem;position:relative}
    .db-icon-btn{
      position:relative;width:38px;height:38px;border-radius:10px;
      background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);
      display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.75);font-size:.9rem;
      cursor:pointer;transition:all .2s var(--ease);
    }
    .db-icon-btn:hover{background:rgba(255,255,255,.12);color:#fff;transform:translateY(-1px)}
    .db-icon-btn .dot{
      position:absolute;top:-3px;right:-3px;width:9px;height:9px;border-radius:50%;
      background:var(--gold);border:2px solid var(--navy-bg);
    }

    /* DROPDOWNS FOR BELL & ENVELOPE */
    .db-dropdown{
      position:absolute;top:50px;right:0;width:340px;
      background:#0c2846;border:1px solid rgba(255,255,255,.14);
      border-radius:16px;box-shadow:0 24px 60px rgba(0,0,0,.55);
      padding:1.2rem;z-index:100;display:none;
    }
    .db-dropdown.active{display:block}
    .db-dropdown-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:.6rem;border-bottom:1px solid rgba(255,255,255,.08)}
    .db-dropdown-head h4{font-family:var(--font-display);font-weight:600;letter-spacing:0;font-size:.92rem;color:#fff}
    .db-dropdown-list{display:flex;flex-direction:column;gap:.75rem;max-height:260px;overflow-y:auto}
    .db-dropdown-item{display:flex;gap:.75rem;font-size:.8rem;color:rgba(255,255,255,.8);align-items:flex-start}
    .db-dropdown-item i{color:var(--gold);margin-top:.2rem}

    .db-profile{display:flex;align-items:center;gap:.75rem;padding-left:.5rem;border-left:1px solid rgba(255,255,255,.1)}
    .db-avatar{
      width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,var(--gold-light),var(--gold));
      color:var(--ink);font-weight:900;display:flex;align-items:center;justify-content:center;font-size:.9rem;
      box-shadow:0 4px 12px rgba(255,179,0,.25);
    }
    .db-profile-text .name{font-size:.82rem;font-weight:700;color:#fff}
    .db-profile-text .role{font-size:.68rem;color:var(--text-muted)}

    .db-content{flex:1;padding:2rem;max-width:1440px;width:100%;margin:0 auto}

    /* ===== TABLES & BADGES ===== */
    .db-panel{
      background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);border-radius:18px;padding:1.5rem;
      box-shadow:0 12px 32px rgba(0,0,0,.16);
    }
    .db-panel-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.1rem;flex-wrap:wrap;gap:1rem}
    .db-panel-head h2{font-family:var(--font-display);font-weight:800;letter-spacing:0;font-size:2rem;color:#fff}
    .db-panel-actions{display:flex;align-items:center;gap:.75rem}

    .db-btn{
      display:inline-flex;align-items:center;gap:.55rem;padding:.55rem 1.1rem;border-radius:10px;
      font-size:.82rem;font-weight:700;border:none;cursor:pointer;transition:all .2s var(--ease);
    }
    .db-btn-gold{background:linear-gradient(135deg,var(--gold-light),var(--gold));color:var(--ink);box-shadow:0 8px 20px rgba(255,179,0,.2)}
    .db-btn-gold:hover{filter:brightness(1.08);transform:translateY(-1px);box-shadow:0 10px 24px rgba(255,179,0,.3)}
    .db-btn-ghost{background:rgba(255,255,255,.06);color:#fff;border:1px solid rgba(255,255,255,.12)}
    .db-btn-ghost:hover{background:rgba(255,255,255,.12)}
    .db-btn-danger{background:rgba(226,75,74,.2);color:#ff7875;border:1px solid rgba(226,75,74,.3)}
    .db-btn-danger:hover{background:rgba(226,75,74,.35)}

    .db-table-wrap{width:100%;overflow-x:auto}
    .db-table{width:100%;border-collapse:collapse}
    .db-table th{
      text-align:left;font-size:.68rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;
      color:var(--text-dim);padding:.75rem .6rem;border-bottom:1px solid rgba(255,255,255,.08);
    }
    .db-table td{padding:.85rem .6rem;font-size:.82rem;border-bottom:1px solid rgba(255,255,255,.05);color:rgba(255,255,255,.85);vertical-align:middle}
    .db-table tr{transition:background .15s var(--ease)}
    .db-table tr:hover{background:rgba(255,255,255,.025)}
    .db-table tr:last-child td{border-bottom:none}
    .db-tag{font-size:.68rem;font-weight:700;padding:.22rem .55rem;border-radius:999px;display:inline-block}
    .db-tag.published, .db-tag.OPEN, .db-tag.RESOLVED, .db-tag.TRUE, .db-tag.APPROVED, .db-tag.active{background:rgba(76,201,141,.14);color:#5ce0a3}
    .db-tag.draft, .db-tag.SUBMITTED, .db-tag.DRAFT, .db-tag.UNVERIFIED, .db-tag.PENDING{background:rgba(255,179,0,.14);color:var(--gold)}
    .db-tag.review, .db-tag.REVIEWING, .db-tag.IN_PROGRESS{background:rgba(79,195,247,.14);color:#4fc3f7}
    .db-tag.CLOSED, .db-tag.FALSE, .db-tag.MISLEADING, .db-tag.ARCHIVED, .db-tag.inactive{background:rgba(226,75,74,.14);color:#ff7875}

    /* ===== MODAL & TOAST ===== */
    .db-modal-overlay{
      position:fixed;inset:0;background:rgba(3,10,20,.78);backdrop-filter:blur(6px);
      z-index:100;display:none;align-items:center;justify-content:center;padding:1.5rem;
    }
    .db-modal-overlay.active{display:flex}
    .db-modal{
      background:#0c2846;border:1px solid rgba(255,255,255,.14);border-radius:20px;
      width:100%;max-width:760px;max-height:90vh;overflow-y:auto;box-shadow:0 24px 60px rgba(0,0,0,.55);
    }
    .db-modal-head{
      padding:1.4rem 1.6rem;border-bottom:1px solid rgba(255,255,255,.09);
      display:flex;align-items:center;justify-content:space-between;
    }
    .db-modal-head h3{font-family:var(--font-display);font-weight:700;letter-spacing:0;font-size:1.35rem;color:#fff}
    .db-modal-close{
      background:rgba(255,255,255,.06);border:0;color:var(--text-muted);width:32px;height:32px;
      border-radius:8px;font-size:1rem;display:flex;align-items:center;justify-content:center;cursor:pointer;
    }
    .db-modal-close:hover{color:#fff;background:rgba(255,255,255,.12)}
    .db-modal-body{padding:1.6rem}
    .db-form-group{margin-bottom:1.2rem}
    .db-form-group label{display:block;font-size:.78rem;font-weight:700;color:rgba(255,255,255,.8);margin-bottom:.45rem}
    .db-form-control{
      width:100%;padding:.7rem .9rem;border-radius:10px;background:rgba(255,255,255,.06);
      border:1px solid rgba(255,255,255,.12);color:#fff;font-size:.85rem;outline:none;
      font-family:inherit;transition:all .2s var(--ease);
    }
    .db-form-control:focus{border-color:var(--gold);background:rgba(255,255,255,.1);box-shadow:0 0 0 3px rgba(255,179,0,.1)}
    textarea.db-form-control{min-height:100px;resize:vertical}
    select.db-form-control{background:#0a2036;color:#fff}
    select.db-form-control option{background:#0a2036;color:#fff}

    /* Datepicker Calendar Indicator Fix (Bright White Icon for Dark Panel) */
    input[type="date"]::-webkit-calendar-picker-indicator,
    input[type="datetime-local"]::-webkit-calendar-picker-indicator,
    input[type="time"]::-webkit-calendar-picker-indicator {
      filter: invert(1) brightness(2) !important;
      cursor: pointer !important;
      opacity: 1 !important;
    }
    input[type="date"],
    input[type="datetime-local"],
    input[type="time"] {
      color-scheme: dark !important;
    }

    .db-toast{
      position:fixed;bottom:24px;right:24px;z-index:110;
      background:#0f2f52;border:1px solid var(--gold);color:#fff;
      padding:.9rem 1.4rem;border-radius:12px;font-size:.85rem;font-weight:600;
      box-shadow:0 16px 36px rgba(0,0,0,.45);display:none;align-items:center;gap:.7rem;
    }
    .db-toast.success{border-color:#5ce0a3}
    .db-toast.error{border-color:#ff7875}

    @media(max-width:860px){
      :root{--sidebar-w:250px}
      .db-sidebar{transform:translateX(-100%)}
      .db-sidebar.open{transform:translateX(0)}
      .db-main{margin-left:0}
      .db-burger{display:flex}
    }
    @media(max-width:560px){
      .db-content{padding:1.2rem}
      .db-profile-text{display:none}
      .db-topbar{padding:.9rem 1.1rem}
    }
  </style>
  @stack('styles')
</head>
<body>

  <div class="db-overlay" id="dbOverlay" style="display:none;position:fixed;inset:0;background:rgba(3,10,20,.6);z-index:35"></div>

  {{--
    Peta menu sidebar admin.
    Setiap item: [route_name, icon_fa, label].
    route_name boleh null (untuk item non-CRUD seperti "Pengaturan Chatbot NARA"
    yang mungkin belum punya route sama sekali).
    Kalau route_name diisi tapi belum terdaftar di routes/web.php (php artisan route:list
    belum ada namanya), link otomatis nonaktif + badge "Segera" — tidak akan error 404
    atau RouteNotFoundException.
  --}}
  @php
    $adminMenu = [
      'Profil Sekolah' => [
        ['admin.school-history.index',  'fa-landmark',          'Sejarah Sekolah'],
        ['admin.vision-mission.index',  'fa-bullseye',          'Visi &amp; Misi'],
        ['admin.org-structure.index',   'fa-sitemap',           'Struktur Organisasi'],
        ['admin.teachers.index',        'fa-chalkboard-user',   'Guru &amp; Staf'],
        ['admin.roadmap.index',         'fa-road',              'Roadmap Pengembangan'],
        ['admin.virtual-tour.index',    'fa-street-view',       'Tour Virtual 360°'],
      ],
      'Program Keahlian' => [
        ['admin.majors.index',          'fa-graduation-cap',    'Jurusan / Program Keahlian'],
      ],
      'PPDB' => [
        ['admin.ppdb.index',            'fa-file-signature',    'Jalur &amp; Kuota Pendaftaran'],
      ],
      'Siswa' => [
        ['admin.student-works.index',   'fa-palette',           'Karya Siswa'],
        ['admin.extracurriculars.index','fa-futbol',            'Ekstrakurikuler'],
        ['admin.e-voices.index',        'fa-comments',          'E-Voice Aspirasi'],
      ],
      'Berita' => [
        ['admin.news.index',            'fa-newspaper',         'Berita &amp; Artikel'],
        ['admin.fact-checks.index',     'fa-shield-halved',     'School Factcheck'],
      ],
      'Galeri' => [
        ['admin.gallery.index',         'fa-images',            'Kegiatan Sekolah'],
        ['admin.achievements.index',    'fa-trophy',            'Prestasi Sekolah'],
      ],
      'BKK & Kemitraan' => [
        ['admin.job-vacancies.index',   'fa-briefcase',         'Lowongan Kerja'],
        ['admin.industries.index',      'fa-handshake',         'DUDI &amp; Mitra Industri'],
      ],
      'AI &amp; Chatbot' => [
        ['admin.ai-matchmaker.index',   'fa-robot',             'AI Matchmaker Ekskul'],
        ['admin.chatbot-nara.index',    'fa-message',           'Isi Jawaban Chatbot NARA'],
      ],
      'Pengaturan Situs' => [
        ['admin.announcement.index',    'fa-bullhorn',          'Announcement Bar'],
        ['admin.partners.index',        'fa-building',          'Logo Partner / Mitra'],
        ['admin.users.index',           'fa-user-shield',       'Manajemen User &amp; Admin'],
      ],
    ];
  @endphp

  <!-- ===================== SIDEBAR ===================== -->
  <aside class="db-sidebar" id="dbSidebar">
    <div class="db-side-brand">
      <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SMK Negeri 2 Mojokerto" />
      <div>
        <div class="name">SMKN <span class="num-2">2</span> Mojokerto</div>
        <span class="role">Panel Administrator</span>
      </div>
    </div>

    <nav class="db-nav">
      <div class="db-nav-group">
        <div class="db-nav-title">Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="db-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <i class="fas fa-gauge-high"></i> Dashboard
        </a>
      </div>

      @foreach($adminMenu as $groupTitle => $items)
        <div class="db-nav-group">
          <div class="db-nav-title">{!! $groupTitle !!}</div>
          @foreach($items as [$routeName, $icon, $label])
            @php
              // route() dipanggil aman: kalau nama route belum terdaftar, fallback ke '#'
              // supaya tidak melempar RouteNotFoundException saat halaman dirender.
              $routeExists = \Illuminate\Support\Facades\Route::has($routeName);
              $href        = $routeExists ? route($routeName) : '#';
              $isActive    = $routeExists && request()->routeIs(str_replace('.index', '.*', $routeName));
            @endphp
            <a href="{{ $href }}" class="db-nav-item {{ $isActive ? 'active' : '' }}">
              <i class="fas {{ $icon }}"></i> {!! $label !!}
            </a>
          @endforeach
        </div>
      @endforeach
    </nav>

    <div class="db-side-foot">
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="db-logout" style="width:100%;border:0">
          <i class="fas fa-right-from-bracket"></i> Keluar
        </button>
      </form>
    </div>
  </aside>

  <!-- ===================== MAIN CONTENT ===================== -->
  <main class="db-main">
    <header class="db-topbar">
      <button class="db-burger" id="dbBurger" type="button"><i class="fas fa-bars"></i></button>

      <div class="db-search">
        <i class="fas fa-magnifying-glass"></i>
        <input type="text" id="dbSearchGlobal" placeholder="Cari di admin..." />
      </div>

      <div class="db-top-right">
        <!-- BELL NOTIFICATIONS DROPDOWN -->
        <button class="db-icon-btn" id="dbBtnBell" title="Notifikasi" type="button">
          <i class="fas fa-bell"></i>
          <span class="dot"></span>
        </button>
        <div class="db-dropdown" id="dbDropBell">
          <div class="db-dropdown-head">
            <h4>Notifikasi Terkini</h4>
            <span style="font-size:.7rem;color:var(--gold-light)">Baru</span>
          </div>
          <div class="db-dropdown-list">
            <div class="db-dropdown-item">
              <i class="fas fa-circle-exclamation"></i>
              <div>
                <strong>Pengaduan E-Voice Baru</strong>
                <p style="font-size:.72rem;color:var(--text-muted)">Permintaan fasilitas WiFi di perpustakaan.</p>
              </div>
            </div>
            <div class="db-dropdown-item">
              <i class="fas fa-shield-halved"></i>
              <div>
                <strong>Laporan FactCheck</strong>
                <p style="font-size:.72rem;color:var(--text-muted)">Klarifikasi isu PPDB 2026.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- ENVELOPE MESSAGES DROPDOWN -->
        <button class="db-icon-btn" id="dbBtnMail" title="Pesan Masuk" type="button">
          <i class="fas fa-envelope"></i>
          <span class="dot"></span>
        </button>
        <div class="db-dropdown" id="dbDropMail">
          <div class="db-dropdown-head">
            <h4>Pesan &amp; Pertanyaan</h4>
            <span style="font-size:.7rem;color:var(--gold-light)">2 Belum Dibaca</span>
          </div>
          <div class="db-dropdown-list">
            <div class="db-dropdown-item">
              <i class="fas fa-user"></i>
              <div>
                <strong>Orang Tua Siswa</strong>
                <p style="font-size:.72rem;color:var(--text-muted)">Menanyakan jadwal PPDB Gelombang 2.</p>
              </div>
            </div>
            <div class="db-dropdown-item">
              <i class="fas fa-handshake"></i>
              <div>
                <strong>PT Telkom Indonesia</strong>
                <p style="font-size:.72rem;color:var(--text-muted)">Pengajuan kerja sama PKL jurusan RPL.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="db-profile">
          <div class="db-avatar">A</div>
          <div class="db-profile-text">
            <div class="name">Administrator</div>
            <div class="role">Super Admin</div>
          </div>
        </div>
      </div>
    </header>

    <div class="db-content">
      @yield('content')
    </div>
  </main>

  <!-- TOAST NOTIFICATION -->
  <div class="db-toast" id="dbToast">
    <i class="fas fa-circle-check" id="dbToastIcon"></i>
    <span id="dbToastMsg">Pesan notifikasi</span>
  </div>

  <script>
    // Responsive sidebar toggle
    const burger = document.getElementById('dbBurger');
    const sidebar = document.getElementById('dbSidebar');
    const overlay = document.getElementById('dbOverlay');
    if (burger && sidebar && overlay) {
      burger.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        overlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
      });
      overlay.addEventListener('click', () => {
        sidebar.classList.remove('open');
        overlay.style.display = 'none';
      });
    }

    // Topbar dropdown toggles
    const btnBell = document.getElementById('dbBtnBell');
    const dropBell = document.getElementById('dbDropBell');
    const btnMail = document.getElementById('dbBtnMail');
    const dropMail = document.getElementById('dbDropMail');

    if (btnBell && dropBell) {
      btnBell.addEventListener('click', (e) => {
        e.stopPropagation();
        dropBell.classList.toggle('active');
        if (dropMail) dropMail.classList.remove('active');
      });
    }
    if (btnMail && dropMail) {
      btnMail.addEventListener('click', (e) => {
        e.stopPropagation();
        dropMail.classList.toggle('active');
        if (dropBell) dropBell.classList.remove('active');
      });
    }
    document.addEventListener('click', () => {
      if (dropBell) dropBell.classList.remove('active');
      if (dropMail) dropMail.classList.remove('active');
    });

    // Toast function
    window.showToast = function(msg, type = 'success') {
      const toast = document.getElementById('dbToast');
      const toastMsg = document.getElementById('dbToastMsg');
      const toastIcon = document.getElementById('dbToastIcon');
      if (!toast) return;

      toast.className = 'db-toast ' + type;
      toastMsg.textContent = msg;
      toastIcon.className = type === 'success' ? 'fas fa-circle-check' : 'fas fa-triangle-exclamation';

      toast.style.display = 'flex';
      setTimeout(() => { toast.style.display = 'none'; }, 3500);
    };
  </script>
  @stack('scripts')
</body>
</html>