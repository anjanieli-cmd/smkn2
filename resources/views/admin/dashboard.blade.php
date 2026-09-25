{{-- resources/views/admin/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="{{ asset('images/logo_smkn2.png') }}">
  <title>Dashboard Admin — SMK Negeri 2 Mojokerto</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet" />
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
      --font-display:'Archivo Black',sans-serif;
      --font-body:'Plus Jakarta Sans',sans-serif;
      --ease:cubic-bezier(.22,.61,.36,1);
      --sidebar-w:272px;
    }
    *{margin:0;padding:0;box-sizing:border-box}
    body{
      font-family:var(--font-body);
      background:var(--navy-bg);
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
    .db-side-brand img{width:42px;height:42px;object-fit:contain;flex:0 0 42px}
    .db-side-brand .name{
      font-family:var(--font-display);font-size:.98rem;color:#fff;
      text-transform:uppercase;line-height:1.2;white-space:nowrap;
    }
    .db-side-brand .name .num-2{color:var(--gold)}
    .db-side-brand .role{
      display:block;margin-top:.2rem;font-size:.62rem;font-weight:700;
      letter-spacing:.18em;text-transform:uppercase;color:rgba(255,213,74,.75);
    }

    .db-nav{flex:1;overflow-y:auto;padding:1.1rem .9rem 1.5rem}
    .db-nav-group{margin-bottom:1.3rem}
    .db-nav-title{
      font-size:.66rem;font-weight:800;letter-spacing:.16em;text-transform:uppercase;
      color:var(--text-dim);padding:0 .7rem;margin-bottom:.55rem;
    }
    .db-nav-item{
      display:flex;align-items:center;gap:.75rem;
      padding:.62rem .7rem;border-radius:11px;margin-bottom:.2rem;
      font-size:.85rem;font-weight:600;color:rgba(255,255,255,.72);
      transition:all .2s var(--ease);position:relative;
    }
    .db-nav-item i{width:18px;text-align:center;font-size:.92rem;color:rgba(255,255,255,.5);transition:color .2s var(--ease)}
    .db-nav-item:hover{background:rgba(255,255,255,.06);color:#fff}
    .db-nav-item:hover i{color:var(--gold-light)}
    .db-nav-item.active{
      background:linear-gradient(135deg,rgba(255,179,0,.18),rgba(255,179,0,.06));
      color:#fff;box-shadow:inset 0 0 0 1px rgba(255,179,0,.28);
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
    .db-search input:focus{border-color:var(--gold);background:rgba(255,255,255,.09)}

    .db-top-right{margin-left:auto;display:flex;align-items:center;gap:1.1rem}
    .db-icon-btn{
      position:relative;width:38px;height:38px;border-radius:10px;
      background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);
      display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.75);font-size:.9rem;
    }
    .db-icon-btn .dot{
      position:absolute;top:-3px;right:-3px;width:9px;height:9px;border-radius:50%;
      background:var(--gold);border:2px solid var(--navy-bg);
    }
    .db-profile{display:flex;align-items:center;gap:.65rem;padding-left:1rem;border-left:1px solid rgba(255,255,255,.1)}
    .db-avatar{
      width:38px;height:38px;border-radius:50%;
      background:linear-gradient(135deg,#f9a825,#f08c00);
      display:flex;align-items:center;justify-content:center;
      font-family:var(--font-display);font-size:.85rem;color:#0d3a66;
    }
    .db-profile-text{line-height:1.25}
    .db-profile-text strong{display:block;font-size:.82rem;font-weight:700;color:#fff}
    .db-profile-text span{display:block;font-size:.68rem;color:var(--text-muted)}

    .db-content{padding:2rem;flex:1}

    .db-page-head{display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:1.8rem}
    .db-page-head h1{font-family:var(--font-display);font-size:clamp(1.4rem,2.4vw,1.9rem);text-transform:uppercase;letter-spacing:.01em}
    .db-page-head p{color:var(--text-muted);font-size:.85rem;margin-top:.35rem}
    .db-btn-primary{
      display:inline-flex;align-items:center;gap:.55rem;padding:.7rem 1.2rem;border:0;border-radius:11px;
      background:linear-gradient(135deg,#f9a825,#f08c00);color:#0d3a66;font-weight:800;font-size:.82rem;
      letter-spacing:.02em;text-transform:uppercase;box-shadow:0 12px 28px rgba(249,168,37,.28);
      transition:all .25s var(--ease);
    }
    .db-btn-primary:hover{transform:translateY(-2px);box-shadow:0 16px 34px rgba(249,168,37,.38)}

    /* ===== Stat cards ===== */
    .db-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:1.2rem;margin-bottom:2rem}
    .db-stat-card{
      background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);border-radius:18px;
      padding:1.4rem 1.4rem 1.3rem;position:relative;overflow:hidden;
      transition:transform .25s var(--ease),border-color .25s var(--ease);
    }
    .db-stat-card:hover{transform:translateY(-3px);border-color:rgba(255,179,0,.35)}
    .db-stat-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem}
    .db-stat-icon{
      width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.05rem;
    }
    .db-stat-icon.gold{background:rgba(255,179,0,.14);color:var(--gold)}
    .db-stat-icon.blue{background:rgba(40,169,225,.14);color:#4fc3f7}
    .db-stat-icon.green{background:rgba(76,201,141,.14);color:#5ce0a3}
    .db-stat-icon.purple{background:rgba(179,136,255,.14);color:#c9a6ff}
    .db-stat-trend{font-size:.72rem;font-weight:700;padding:.22rem .55rem;border-radius:999px}
    .db-stat-trend.up{color:#5ce0a3;background:rgba(76,201,141,.12)}
    .db-stat-value{font-family:var(--font-display);font-size:1.9rem;color:#fff;margin-bottom:.3rem}
    .db-stat-label{font-size:.8rem;color:var(--text-muted);font-weight:500}

    /* ===== Modules grid ===== */
    .db-section-title{
      display:flex;align-items:center;justify-content:space-between;margin-bottom:1.1rem;
    }
    .db-section-title h2{font-family:var(--font-display);font-size:1.05rem;text-transform:uppercase;letter-spacing:.01em}
    .db-section-title a{font-size:.78rem;font-weight:700;color:var(--gold-light)}

    .db-modules{display:grid;grid-template-columns:repeat(4,1fr);gap:1.1rem;margin-bottom:2.2rem}
    .db-module-card{
      background:rgba(255,255,255,.035);border:1px solid rgba(255,255,255,.08);border-radius:16px;
      padding:1.2rem;display:flex;flex-direction:column;gap:.9rem;
      transition:all .25s var(--ease);
    }
    .db-module-card:hover{background:rgba(255,255,255,.06);border-color:rgba(255,179,0,.3);transform:translateY(-2px)}
    .db-module-icon{
      width:40px;height:40px;border-radius:11px;background:rgba(255,179,0,.12);color:var(--gold);
      display:flex;align-items:center;justify-content:center;font-size:.95rem;
    }
    .db-module-card h3{font-size:.86rem;font-weight:700;color:#fff}
    .db-module-card p{font-size:.72rem;color:var(--text-muted);line-height:1.5}
    .db-module-count{font-size:.7rem;font-weight:700;color:var(--gold-light);margin-top:auto}

    /* ===== Bottom split: table + side panel ===== */
    .db-split{display:grid;grid-template-columns:1.6fr 1fr;gap:1.4rem}
    .db-panel{
      background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);border-radius:18px;padding:1.5rem;
    }
    .db-panel-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.1rem}
    .db-panel-head h2{font-family:var(--font-display);font-size:.95rem;text-transform:uppercase}
    .db-panel-head a{font-size:.76rem;font-weight:700;color:var(--gold-light)}

    .db-table{width:100%;border-collapse:collapse}
    .db-table th{
      text-align:left;font-size:.68rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;
      color:var(--text-dim);padding:.6rem .5rem;border-bottom:1px solid rgba(255,255,255,.08);
    }
    .db-table td{padding:.75rem .5rem;font-size:.82rem;border-bottom:1px solid rgba(255,255,255,.05);color:rgba(255,255,255,.85)}
    .db-table tr:last-child td{border-bottom:none}
    .db-tag{font-size:.68rem;font-weight:700;padding:.22rem .55rem;border-radius:999px}
    .db-tag.published{background:rgba(76,201,141,.14);color:#5ce0a3}
    .db-tag.draft{background:rgba(255,179,0,.14);color:var(--gold)}
    .db-tag.review{background:rgba(79,195,247,.14);color:#4fc3f7}

    .db-activity{display:flex;flex-direction:column;gap:1rem}
    .db-activity-item{display:flex;gap:.8rem;align-items:flex-start}
    .db-activity-dot{
      width:34px;height:34px;border-radius:10px;flex:0 0 34px;display:flex;align-items:center;justify-content:center;
      background:rgba(255,179,0,.12);color:var(--gold);font-size:.82rem;
    }
    .db-activity-text p{font-size:.82rem;color:rgba(255,255,255,.85);line-height:1.5}
    .db-activity-text span{font-size:.7rem;color:var(--text-dim)}

    /* ===================== RESPONSIVE ===================== */
    @media(max-width:1180px){
      .db-modules{grid-template-columns:repeat(3,1fr)}
    }
    @media(max-width:1000px){
      .db-stats{grid-template-columns:repeat(2,1fr)}
      .db-split{grid-template-columns:1fr}
    }
    @media(max-width:860px){
      :root{--sidebar-w:250px}
      .db-sidebar{transform:translateX(-100%)}
      .db-sidebar.open{transform:translateX(0)}
      .db-main{margin-left:0}
      .db-burger{display:flex}
      .db-modules{grid-template-columns:repeat(2,1fr)}
    }
    @media(max-width:560px){
      .db-content{padding:1.2rem}
      .db-stats{grid-template-columns:1fr}
      .db-modules{grid-template-columns:1fr}
      .db-profile-text{display:none}
      .db-topbar{padding:.9rem 1.1rem}
    }
  </style>
</head>
<body>

  <div class="db-overlay" id="dbOverlay" style="display:none;position:fixed;inset:0;background:rgba(3,10,20,.6);z-index:35"></div>

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
        <a href="{{ route('admin.dashboard') }}" class="db-nav-item active"><i class="fas fa-gauge-high"></i> Dashboard</a>
      </div>

      <div class="db-nav-group">
        <div class="db-nav-title">Konten &amp; Publikasi</div>
        <a href="#" class="db-nav-item"><i class="fas fa-newspaper"></i> Berita / Artikel</a>
        <a href="#" class="db-nav-item"><i class="fas fa-images"></i> Galeri</a>
        <a href="#" class="db-nav-item"><i class="fas fa-calendar-days"></i> Kegiatan</a>
        <a href="#" class="db-nav-item"><i class="fas fa-palette"></i> Karya Siswa</a>
        <a href="#" class="db-nav-item"><i class="fas fa-trophy"></i> Prestasi</a>
      </div>

      <div class="db-nav-group">
        <div class="db-nav-title">Layanan Digital</div>
        <a href="#" class="db-nav-item"><i class="fas fa-comments"></i> E-Voice <span class="badge">5</span></a>
        <a href="#" class="db-nav-item"><i class="fas fa-shield-halved"></i> School Factcheck</a>
        <a href="#" class="db-nav-item"><i class="fas fa-user-plus"></i> PPDB <span class="badge">12</span></a>
        <a href="#" class="db-nav-item"><i class="fas fa-briefcase"></i> BKK</a>
      </div>

      <div class="db-nav-group">
        <div class="db-nav-title">Akademik</div>
        <a href="#" class="db-nav-item"><i class="fas fa-chalkboard-user"></i> Guru &amp; Staf</a>
        <a href="#" class="db-nav-item"><i class="fas fa-graduation-cap"></i> Jurusan</a>
        <a href="#" class="db-nav-item"><i class="fas fa-futbol"></i> Ekstrakurikuler</a>
      </div>

      <div class="db-nav-group">
        <div class="db-nav-title">Sistem</div>
        <a href="#" class="db-nav-item"><i class="fas fa-gear"></i> Pengaturan Halaman</a>
      </div>
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

  <!-- ===================== MAIN ===================== -->
  <div class="db-main">

    <header class="db-topbar">
      <button class="db-burger" id="dbBurger" aria-label="Buka menu"><i class="fas fa-bars"></i></button>

      <div class="db-search">
        <i class="fas fa-magnifying-glass"></i>
        <input type="text" placeholder="Cari berita, guru, pendaftar..." />
      </div>

      <div class="db-top-right">
        <button class="db-icon-btn" aria-label="Notifikasi"><i class="fas fa-bell"></i><span class="dot"></span></button>
        <button class="db-icon-btn" aria-label="Pesan"><i class="fas fa-envelope"></i></button>
        <div class="db-profile">
          <div class="db-avatar">A</div>
          <div class="db-profile-text">
            <strong>Admin SKANEDA</strong>
            <span>Super Admin</span>
          </div>
        </div>
      </div>
    </header>

    <main class="db-content">

      <div class="db-page-head">
        <div>
          <h1>Dashboard</h1>
          <p>Ringkasan aktivitas dan konten website SMK Negeri 2 Mojokerto.</p>
        </div>
        <a href="#" class="db-btn-primary"><i class="fas fa-plus"></i> Tambah Berita</a>
      </div>

      <!-- ===== Stat cards ===== -->
      <section class="db-stats">
        <div class="db-stat-card">
          <div class="db-stat-top">
            <div class="db-stat-icon gold"><i class="fas fa-newspaper"></i></div>
            <span class="db-stat-trend up"><i class="fas fa-arrow-up"></i> 8%</span>
          </div>
          <div class="db-stat-value">248</div>
          <div class="db-stat-label">Total berita dipublikasi</div>
        </div>

        <div class="db-stat-card">
          <div class="db-stat-top">
            <div class="db-stat-icon blue"><i class="fas fa-eye"></i></div>
            <span class="db-stat-trend up"><i class="fas fa-arrow-up"></i> 24%</span>
          </div>
          <div class="db-stat-value">18.4K</div>
          <div class="db-stat-label">Total pengunjung website</div>
        </div>

        <div class="db-stat-card">
          <div class="db-stat-top">
            <div class="db-stat-icon green"><i class="fas fa-user-plus"></i></div>
            <span class="db-stat-trend up"><i class="fas fa-arrow-up"></i> 12%</span>
          </div>
          <div class="db-stat-value">356</div>
          <div class="db-stat-label">Jumlah pendaftar PPDB</div>
        </div>

        <div class="db-stat-card">
          <div class="db-stat-top">
            <div class="db-stat-icon purple"><i class="fas fa-chalkboard-user"></i></div>
          </div>
          <div class="db-stat-value">86 / 9</div>
          <div class="db-stat-label">Guru aktif / Jurusan aktif</div>
        </div>
      </section>

      <!-- ===== Modules quick access ===== -->
      <div class="db-section-title">
        <h2>Modul Konten</h2>
        <a href="#">Lihat semua</a>
      </div>
      <section class="db-modules">
        <a href="#" class="db-module-card">
          <div class="db-module-icon"><i class="fas fa-images"></i></div>
          <h3>Galeri</h3>
          <p>Kelola foto kegiatan &amp; dokumentasi sekolah.</p>
          <span class="db-module-count">312 foto</span>
        </a>
        <a href="#" class="db-module-card">
          <div class="db-module-icon"><i class="fas fa-calendar-days"></i></div>
          <h3>Kegiatan</h3>
          <p>Jadwal dan laporan kegiatan sekolah.</p>
          <span class="db-module-count">14 kegiatan</span>
        </a>
        <a href="#" class="db-module-card">
          <div class="db-module-icon"><i class="fas fa-trophy"></i></div>
          <h3>Prestasi</h3>
          <p>Capaian siswa &amp; sekolah tingkat lomba.</p>
          <span class="db-module-count">57 prestasi</span>
        </a>
        <a href="#" class="db-module-card">
          <div class="db-module-icon"><i class="fas fa-palette"></i></div>
          <h3>Karya Siswa</h3>
          <p>Galeri hasil karya dan portofolio siswa.</p>
          <span class="db-module-count">129 karya</span>
        </a>
        <a href="#" class="db-module-card">
          <div class="db-module-icon"><i class="fas fa-comments"></i></div>
          <h3>E-Voice</h3>
          <p>Aspirasi &amp; masukan dari siswa dan wali murid.</p>
          <span class="db-module-count">5 belum dibaca</span>
        </a>
        <a href="#" class="db-module-card">
          <div class="db-module-icon"><i class="fas fa-shield-halved"></i></div>
          <h3>School Factcheck</h3>
          <p>Klarifikasi isu &amp; informasi seputar sekolah.</p>
          <span class="db-module-count">3 dalam proses</span>
        </a>
        <a href="#" class="db-module-card">
          <div class="db-module-icon"><i class="fas fa-briefcase"></i></div>
          <h3>BKK</h3>
          <p>Bursa Kerja Khusus &amp; lowongan mitra industri.</p>
          <span class="db-module-count">9 lowongan aktif</span>
        </a>
        <a href="#" class="db-module-card">
          <div class="db-module-icon"><i class="fas fa-futbol"></i></div>
          <h3>Ekstrakurikuler</h3>
          <p>Data ekskul, pembina, dan anggota aktif.</p>
          <span class="db-module-count">16 ekskul</span>
        </a>
      </section>

      <!-- ===== Table + activity ===== -->
      <div class="db-split">
        <div class="db-panel">
          <div class="db-panel-head">
            <h2>Berita Terbaru</h2>
            <a href="#">Kelola semua</a>
          </div>
          <table class="db-table">
            <thead>
              <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Pelepasan Siswa Kelas XII Angkatan 2026</td>
                <td>Kegiatan</td>
                <td>24 Sep 2026</td>
                <td><span class="db-tag published">Terbit</span></td>
              </tr>
              <tr>
                <td>Juara 1 LKS Tingkat Provinsi Jawa Timur</td>
                <td>Prestasi</td>
                <td>21 Sep 2026</td>
                <td><span class="db-tag published">Terbit</span></td>
              </tr>
              <tr>
                <td>Pembukaan Pendaftaran PPDB Gelombang 2</td>
                <td>PPDB</td>
                <td>19 Sep 2026</td>
                <td><span class="db-tag review">Ditinjau</span></td>
              </tr>
              <tr>
                <td>Kunjungan Industri Jurusan TKJ ke Surabaya</td>
                <td>Kegiatan</td>
                <td>16 Sep 2026</td>
                <td><span class="db-tag draft">Draf</span></td>
              </tr>
              <tr>
                <td>Workshop BKK: Persiapan Dunia Kerja</td>
                <td>BKK</td>
                <td>12 Sep 2026</td>
                <td><span class="db-tag published">Terbit</span></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="db-panel">
          <div class="db-panel-head">
            <h2>Aktivitas Terbaru</h2>
          </div>
          <div class="db-activity">
            <div class="db-activity-item">
              <div class="db-activity-dot"><i class="fas fa-user-plus"></i></div>
              <div class="db-activity-text">
                <p>12 pendaftar baru masuk di PPDB Gelombang 2</p>
                <span>15 menit lalu</span>
              </div>
            </div>
            <div class="db-activity-item">
              <div class="db-activity-dot"><i class="fas fa-comments"></i></div>
              <div class="db-activity-text">
                <p>Ada 3 masukan baru masuk di E-Voice</p>
                <span>1 jam lalu</span>
              </div>
            </div>
            <div class="db-activity-item">
              <div class="db-activity-dot"><i class="fas fa-newspaper"></i></div>
              <div class="db-activity-text">
                <p>Berita "Juara 1 LKS Tingkat Provinsi" diterbitkan</p>
                <span>3 jam lalu</span>
              </div>
            </div>
            <div class="db-activity-item">
              <div class="db-activity-dot"><i class="fas fa-briefcase"></i></div>
              <div class="db-activity-text">
                <p>Mitra industri baru menambahkan lowongan di BKK</p>
                <span>Kemarin, 16:20</span>
              </div>
            </div>
            <div class="db-activity-item">
              <div class="db-activity-dot"><i class="fas fa-images"></i></div>
              <div class="db-activity-text">
                <p>18 foto baru diunggah ke Galeri Kegiatan</p>
                <span>Kemarin, 09:05</span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>
  </div>

  <script>
    const burger = document.getElementById('dbBurger');
    const sidebar = document.getElementById('dbSidebar');
    const overlay = document.getElementById('dbOverlay');
    function toggleSidebar(open){
      sidebar.classList.toggle('open', open);
      overlay.style.display = open ? 'block' : 'none';
    }
    if (burger){
      burger.addEventListener('click', () => toggleSidebar(!sidebar.classList.contains('open')));
    }
    if (overlay){
      overlay.addEventListener('click', () => toggleSidebar(false));
    }
  </script>

</body>
</html>