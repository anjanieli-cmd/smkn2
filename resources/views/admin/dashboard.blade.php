@extends('layouts.admin')

@section('title', 'Dashboard Admin — SMK Negeri 2 Mojokerto')

@section('content')
<style>
  /* ============================================================
     DASHBOARD ADMIN — REFRESH VISUAL v2
     Scoped di bawah .adm-dash supaya tidak bentrok dengan style
     layout admin yang sudah ada. Semua variabel warna mengikuti
     tema admin (navy gelap + aksen emas) yang sudah dipakai.
     ============================================================ */
  .adm-dash{
    --a-gold:var(--gold,#f9a825);
    --a-gold-light:var(--gold-light,#ffd54a);
    --a-muted:var(--text-muted,#8a9aad);
    --a-card:rgba(255,255,255,.04);
    --a-card-hover:rgba(255,255,255,.065);
    --a-border:rgba(255,255,255,.09);
    --a-border-hover:rgba(255,213,74,.28);
    --a-ease:cubic-bezier(.22,.61,.36,1);
    position:relative;
  }

  /* ---------- HEADER SAPAAN ---------- */
  .adm-hero{
    position:relative;overflow:hidden;
    display:flex;align-items:center;justify-content:space-between;gap:1.5rem;flex-wrap:wrap;
    padding:1.6rem 1.8rem;border-radius:20px;margin-bottom:1.8rem;
    background:linear-gradient(120deg,rgba(249,168,37,.10),rgba(255,255,255,.03) 55%);
    border:1px solid var(--a-border);
  }
  .adm-hero::after{
    content:"";position:absolute;right:-60px;top:-60px;width:200px;height:200px;border-radius:50%;
    background:radial-gradient(circle,rgba(249,168,37,.16),transparent 70%);pointer-events:none;
  }
  .adm-hero-kicker{display:flex;align-items:center;gap:.5rem;font-size:.68rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase;color:var(--a-gold);margin-bottom:.5rem}
  .adm-hero-kicker i{font-size:.62rem;animation:admPulse 2.4s ease-in-out infinite}
  @keyframes admPulse{0%,100%{opacity:1}50%{opacity:.4}}
  .adm-hero-title{font-family:var(--font-body,inherit);font-weight:800;font-size:1.4rem;color:#fff;margin:0 0 .35rem;line-height:1.3;display:flex;align-items:center;gap:.55rem}
  .adm-hero-title span{color:var(--a-gold-light)}
  .adm-hero-title i{color:var(--a-gold);font-size:1.15rem}
  .adm-hero-sub{font-size:.82rem;color:var(--a-muted);margin:0;max-width:520px;line-height:1.6}
  .adm-hero-date{
    position:relative;z-index:1;display:flex;flex-direction:column;align-items:flex-end;gap:.3rem;
    padding:.9rem 1.2rem;border-radius:14px;background:rgba(255,255,255,.035);border:1px solid var(--a-border);
    text-align:right;flex-shrink:0;
  }
  .adm-hero-date small{font-size:.6rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:var(--a-muted)}
  .adm-hero-date strong{font-family:var(--font-display);font-size:1rem;color:#fff}

  /* ---------- STAT CARDS ---------- */
  .adm-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:1.2rem;margin-bottom:2.2rem}
  .adm-stat-card{
    position:relative;overflow:hidden;
    background:var(--a-card);border:1px solid var(--a-border);border-radius:18px;padding:1.4rem;
    transition:transform .35s var(--a-ease),border-color .35s var(--a-ease),background .35s var(--a-ease);
  }
  .adm-stat-card:hover{transform:translateY(-4px);border-color:var(--a-border-hover);background:var(--a-card-hover)}
  .adm-stat-card::after{
    content:"";position:absolute;right:-30px;bottom:-30px;width:120px;height:120px;border-radius:50%;
    background:radial-gradient(circle,var(--adm-stat-glow,rgba(255,255,255,.03)),transparent 70%);pointer-events:none;
  }
  .adm-stat-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem}
  .adm-stat-icon{
    width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;
    font-size:1.05rem;background:var(--adm-stat-bg);color:var(--adm-stat-fg);
    box-shadow:0 8px 18px var(--adm-stat-shadow,transparent);
  }
  .adm-stat-badge{font-size:.64rem;font-weight:800;padding:.26rem .6rem;border-radius:999px;letter-spacing:.02em;white-space:nowrap}
  .adm-stat-badge.ok{color:#5ce0a3;background:rgba(76,201,141,.14)}
  .adm-stat-badge.warn{color:#ffb300;background:rgba(255,179,0,.14)}
  .adm-stat-badge.info{color:#4fc3f7;background:rgba(40,169,225,.14)}
  .adm-stat-value{font-family:var(--font-display);font-size:1.9rem;color:#fff;line-height:1;margin-bottom:.4rem;display:flex;align-items:baseline;gap:.4rem}
  .adm-stat-value small{font-size:.7rem;font-weight:700;color:var(--a-muted)}
  .adm-stat-label{font-size:.78rem;color:var(--a-muted);font-weight:600}

  /* ---------- MODUL MANAJEMEN ---------- */
  .adm-section-head{display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.1rem}
  .adm-section-eyebrow{display:flex;align-items:center;gap:.55rem;font-size:.68rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase;color:var(--a-gold);margin-bottom:.35rem}
  .adm-section-eyebrow::before{content:"";width:20px;height:2px;border-radius:99px;background:linear-gradient(90deg,var(--a-gold),var(--a-gold-light))}
  .adm-section-head h2{font-family:var(--font-display);font-size:1.05rem;color:#fff;text-transform:uppercase;letter-spacing:.01em;margin:0}
  .adm-section-hint{font-size:.76rem;color:var(--a-muted)}

  .adm-modules{display:grid;grid-template-columns:repeat(3,1fr);gap:1.1rem;margin-bottom:2.2rem}
  .adm-module-card{
    position:relative;display:flex;flex-direction:column;gap:.85rem;
    background:var(--a-card);border:1px solid var(--a-border);border-radius:17px;padding:1.3rem 1.35rem;
    text-decoration:none;overflow:hidden;
    transition:transform .35s var(--a-ease),border-color .35s var(--a-ease),background .35s var(--a-ease),box-shadow .35s var(--a-ease);
  }
  .adm-module-card:hover{
    transform:translateY(-5px);
    border-color:var(--a-border-hover);
    background:var(--a-card-hover);
    box-shadow:0 20px 40px rgba(0,0,0,.25);
  }
  .adm-module-icon{
    width:42px;height:42px;border-radius:12px;flex-shrink:0;
    background:rgba(255,179,0,.12);color:var(--a-gold);
    display:flex;align-items:center;justify-content:center;font-size:1.05rem;
    transition:transform .35s var(--a-ease),background .35s var(--a-ease),color .35s var(--a-ease);
  }
  .adm-module-card:hover .adm-module-icon{background:var(--a-gold);color:#1a1305;transform:scale(1.08) rotate(-4deg)}
  .adm-module-card h3{font-size:.92rem;font-weight:800;color:#fff;margin:0}
  .adm-module-card p{font-size:.74rem;color:var(--a-muted);line-height:1.5;margin:0}
  .adm-module-cta{
    margin-top:auto;display:inline-flex;align-items:center;gap:.4rem;
    font-size:.72rem;font-weight:800;color:var(--a-gold-light);letter-spacing:.01em;
  }
  .adm-module-cta i{font-size:.66rem;transition:transform .3s var(--a-ease)}
  .adm-module-card:hover .adm-module-cta i{transform:translateX(4px)}

  /* ---------- PANEL TABEL & AKTIVITAS ---------- */
  .adm-tables{display:grid;grid-template-columns:1.6fr 1fr;gap:1.4rem}
  .adm-panel{background:var(--a-card);border:1px solid var(--a-border);border-radius:18px;overflow:hidden;transition:border-color .35s var(--a-ease)}
  .adm-panel:hover{border-color:var(--a-border-hover)}
  .adm-panel-head{
    display:flex;align-items:center;justify-content:space-between;gap:1rem;
    padding:1.15rem 1.4rem;border-bottom:1px solid var(--a-border);
  }
  .adm-panel-head h2{font-size:.9rem;font-weight:800;color:#fff;margin:0;letter-spacing:.01em}
  .adm-panel-head a{font-size:.76rem;color:var(--a-gold-light);font-weight:800;text-decoration:none;display:inline-flex;align-items:center;gap:.3rem;transition:gap .3s var(--a-ease)}
  .adm-panel-head a:hover{gap:.5rem}

  .adm-table-wrap{overflow-x:auto}
  .adm-table{width:100%;border-collapse:collapse}
  .adm-table thead th{
    text-align:left;font-size:.64rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;
    color:var(--a-muted);padding:.7rem 1.4rem;border-bottom:1px solid var(--a-border);white-space:nowrap;
  }
  .adm-table tbody tr{transition:background .25s ease}
  .adm-table tbody tr:hover{background:rgba(255,255,255,.03)}
  .adm-table tbody td{padding:.8rem 1.4rem;border-bottom:1px solid rgba(255,255,255,.045);font-size:.82rem;color:#e7ecf2;vertical-align:middle}
  .adm-table tbody tr:last-child td{border-bottom:0}

  .adm-avatar-photo{width:38px;height:38px;border-radius:11px;object-fit:cover;box-shadow:0 4px 10px rgba(0,0,0,.25)}
  .adm-avatar-fallback{
    width:38px;height:38px;border-radius:11px;background:rgba(255,179,0,.15);color:var(--a-gold);
    display:flex;align-items:center;justify-content:center;font-weight:900;font-size:.9rem;
  }
  .adm-name{font-weight:800;color:#fff}
  .adm-sub{font-size:.75rem;color:var(--a-muted)}
  .adm-tag{
    display:inline-flex;align-items:center;font-size:.68rem;font-weight:800;padding:.32rem .65rem;
    border-radius:999px;letter-spacing:.02em;text-transform:capitalize;
    background:rgba(255,255,255,.06);color:#d7dee6;
  }
  .adm-tag.active{background:rgba(76,201,141,.14);color:#5ce0a3}
  .adm-tag.pending,.adm-tag.menunggu{background:rgba(255,179,0,.14);color:#ffb300}
  .adm-tag.closed,.adm-tag.selesai{background:rgba(255,255,255,.08);color:var(--a-muted)}
  .adm-ticket{color:var(--a-gold-light);font-size:.72rem;font-weight:900;letter-spacing:.03em}
  .adm-empty{text-align:center;color:var(--a-muted);padding:2.2rem 1rem;font-size:.82rem}
  .adm-empty i{display:block;font-size:1.4rem;margin-bottom:.6rem;opacity:.55}

  /* ---------- FEED AKTIVITAS TERBARU ---------- */
  .adm-feed{list-style:none;margin:0;padding:.4rem 0}
  .adm-feed-item{display:flex;gap:.85rem;padding:.85rem 1.4rem;position:relative}
  .adm-feed-item:not(:last-child)::after{
    content:"";position:absolute;left:2.55rem;top:2.6rem;bottom:-.1rem;width:1px;background:var(--a-border);
  }
  .adm-feed-dot{
    width:34px;height:34px;flex-shrink:0;border-radius:10px;display:flex;align-items:center;justify-content:center;
    font-size:.85rem;background:var(--adm-feed-bg);color:var(--adm-feed-fg);
  }
  .adm-feed-body p{margin:0;font-size:.82rem;color:#e7ecf2;line-height:1.45}
  .adm-feed-body p b{color:#fff}
  .adm-feed-time{font-size:.7rem;color:var(--a-muted);margin-top:.15rem;display:block}

  @media(max-width:1100px){
    .adm-stats{grid-template-columns:repeat(2,1fr)}
  }
  @media(max-width:960px){
    .adm-modules{grid-template-columns:repeat(2,1fr)}
    .adm-tables{grid-template-columns:1fr}
    .adm-hero{flex-direction:column;align-items:flex-start}
    .adm-hero-date{align-items:flex-start;text-align:left}
  }
  @media(max-width:600px){
    .adm-stats{grid-template-columns:1fr}
    .adm-modules{grid-template-columns:1fr}
    .adm-hero{padding:1.3rem}
    .adm-hero-title{font-size:1.25rem}
  }
</style>

@php
  $jam = (int) now()->format('H');
  $sapaan = $jam < 11 ? 'Selamat pagi' : ($jam < 15 ? 'Selamat siang' : ($jam < 19 ? 'Selamat sore' : 'Selamat malam'));

  // Gabungkan beberapa sumber jadi satu feed aktivitas terbaru (opsional, aman kalau kosong)
  $feedItems = collect();
  foreach (($recentTeachers ?? []) as $t) {
      $tName = is_object($t) ? $t->name : ($t['name'] ?? '');
      $tPos  = is_object($t) ? ($t->role_position ?? 'staf') : ($t['role_position'] ?? 'staf');
      $tTime = is_object($t) ? ($t->created_at ?? null) : ($t['created_at'] ?? null);
      $feedItems->push(['type' => 'teacher', 'title' => $tName, 'desc' => 'ditambahkan sebagai '.$tPos, 'time' => $tTime]);
  }
  foreach (($recentEVoices ?? []) as $e) {
      $eCode  = is_object($e) ? $e->ticket_code : ($e['ticket_code'] ?? '');
      $eTitle = is_object($e) ? ($e->title ?? '') : ($e['title'] ?? '');
      $eTime  = is_object($e) ? ($e->created_at ?? null) : ($e['created_at'] ?? null);
      $feedItems->push(['type' => 'evoice', 'title' => $eCode, 'desc' => Str::limit($eTitle, 40), 'time' => $eTime]);
  }
  $feedItems = $feedItems->sortByDesc('time')->take(5);
@endphp

<div class="adm-dash">

  <!-- HEADER SAPAAN -->
  <div class="adm-hero">
    <div>
      <div class="adm-hero-kicker"><i class="fas fa-circle"></i> Admin Panel — SMK Negeri 2 Mojokerto</div>
      <h1 class="adm-hero-title">{{ $sapaan }}, <span>Admin</span> <i class="fas fa-hand-sparkles"></i></h1>
      <p class="adm-hero-sub">Pantau ringkasan data sekolah dan kelola konten website dari satu tempat. Klik salah satu modul di bawah untuk mulai mengelola.</p>
    </div>
    <div class="adm-hero-date">
      <small>Hari ini</small>
      <strong>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</strong>
    </div>
  </div>

  <!-- STAT CARDS -->
  <div class="adm-stats">
    <div class="adm-stat-card" style="--adm-stat-bg:rgba(76,201,141,.14);--adm-stat-fg:#5ce0a3;--adm-stat-shadow:rgba(76,201,141,.18);--adm-stat-glow:rgba(76,201,141,.06)">
      <div class="adm-stat-top">
        <div class="adm-stat-icon"><i class="fas fa-chalkboard-user"></i></div>
        <span class="adm-stat-badge ok">Aktif</span>
      </div>
      <div class="adm-stat-value">{{ $stats['total_teachers'] ?? 0 }}</div>
      <div class="adm-stat-label">Guru &amp; Staf Pendidik</div>
    </div>

    <div class="adm-stat-card" style="--adm-stat-bg:rgba(40,169,225,.14);--adm-stat-fg:#4fc3f7;--adm-stat-shadow:rgba(40,169,225,.18);--adm-stat-glow:rgba(40,169,225,.06)">
      <div class="adm-stat-top">
        <div class="adm-stat-icon"><i class="fas fa-comments"></i></div>
        <span class="adm-stat-badge warn">{{ $stats['total_evoice_unread'] ?? 0 }} belum diulas</span>
      </div>
      <div class="adm-stat-value">{{ $stats['total_evoice'] ?? 0 }}</div>
      <div class="adm-stat-label">Total E-Voice Aspirasi</div>
    </div>

    <div class="adm-stat-card" style="--adm-stat-bg:rgba(255,179,0,.14);--adm-stat-fg:#ffb300;--adm-stat-shadow:rgba(255,179,0,.18);--adm-stat-glow:rgba(255,179,0,.06)">
      <div class="adm-stat-top">
        <div class="adm-stat-icon"><i class="fas fa-futbol"></i></div>
        <span class="adm-stat-badge info">{{ $stats['total_extracurriculars'] ?? 0 }} total</span>
      </div>
      <div class="adm-stat-value">{{ $stats['total_extracurriculars'] ?? 0 }}</div>
      <div class="adm-stat-label">Ekskul &amp; Organisasi</div>
    </div>

    <div class="adm-stat-card" style="--adm-stat-bg:rgba(198,120,255,.14);--adm-stat-fg:#c678ff;--adm-stat-shadow:rgba(198,120,255,.18);--adm-stat-glow:rgba(198,120,255,.06)">
      <div class="adm-stat-top">
        <div class="adm-stat-icon"><i class="fas fa-briefcase"></i></div>
        <span class="adm-stat-badge ok">Dibuka</span>
      </div>
      <div class="adm-stat-value">{{ $stats['total_job_vacancies_open'] ?? $stats['total_jobs'] ?? 0 }}</div>
      <div class="adm-stat-label">Lowongan BKK Aktif</div>
    </div>
  </div>

  <!-- SHORTCUT MODULE CARDS -->
  <div style="margin-bottom:2rem">
    <div class="adm-section-head">
      <div>
        <div class="adm-section-eyebrow">Kelola Konten</div>
        <h2>Modul Manajemen Admin</h2>
      </div>
      <span class="adm-section-hint">Klik modul untuk mengelola data di halaman khusus</span>
    </div>

    <div class="adm-modules">

      <a href="{{ route('admin.teachers.index') }}" class="adm-module-card">
        <div class="adm-module-icon"><i class="fas fa-chalkboard-user"></i></div>
        <div>
          <h3>Guru &amp; Staf</h3>
          <p>Kelola data pendidik, foto, jabatan &amp; NIP.</p>
        </div>
        <span class="adm-module-cta">Buka Halaman <i class="fas fa-arrow-right"></i></span>
      </a>

      <a href="{{ route('admin.extracurriculars.index') }}" class="adm-module-card">
        <div class="adm-module-icon"><i class="fas fa-futbol"></i></div>
        <div>
          <h3>Ekstrakurikuler</h3>
          <p>Kelola 13 ekskul &amp; 3 organisasi sekolah.</p>
        </div>
        <span class="adm-module-cta">Buka Halaman <i class="fas fa-arrow-right"></i></span>
      </a>

      <a href="{{ route('admin.e-voices.index') }}" class="adm-module-card">
        <div class="adm-module-icon"><i class="fas fa-comments"></i></div>
        <div>
          <h3>E-Voice Aspirasi</h3>
          <p>Tinjau, tambah &amp; tindak lanjuti suara siswa.</p>
        </div>
        <span class="adm-module-cta">Buka Halaman <i class="fas fa-arrow-right"></i></span>
      </a>

      <a href="{{ route('admin.fact-checks.index') }}" class="adm-module-card">
        <div class="adm-module-icon"><i class="fas fa-shield-halved"></i></div>
        <div>
          <h3>School Factcheck</h3>
          <p>Publikasi &amp; klarifikasi kabar hoaks sekolah.</p>
        </div>
        <span class="adm-module-cta">Buka Halaman <i class="fas fa-arrow-right"></i></span>
      </a>

      <a href="{{ route('admin.job-vacancies.index') }}" class="adm-module-card">
        <div class="adm-module-icon"><i class="fas fa-briefcase"></i></div>
        <div>
          <h3>BKK &amp; Loker</h3>
          <p>Kelola lowongan kerja &amp; karir alumni.</p>
        </div>
        <span class="adm-module-cta">Buka Halaman <i class="fas fa-arrow-right"></i></span>
      </a>

      <a href="{{ route('admin.majors.index') }}" class="adm-module-card">
        <div class="adm-module-icon"><i class="fas fa-graduation-cap"></i></div>
        <div>
          <h3>Program Keahlian</h3>
          <p>Kelola 5 Jurusan, deskripsi &amp; ikon.</p>
        </div>
        <span class="adm-module-cta">Buka Halaman <i class="fas fa-arrow-right"></i></span>
      </a>
    </div>
  </div>

  <!-- RECENT TABLES + FEED SPLIT -->
  <div class="adm-tables">
    <!-- RECENT TEACHERS TABLE -->
    <div class="adm-panel">
      <div class="adm-panel-head">
        <h2>Guru &amp; Staf Pendidik Terbaru</h2>
        <a href="{{ route('admin.teachers.index') }}">Lihat Semua <i class="fas fa-arrow-right"></i></a>
      </div>
      <div class="adm-table-wrap">
        <table class="adm-table">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nama Lengkap</th>
              <th>Jabatan</th>
              <th>NIP / Kode</th>
            </tr>
          </thead>
          <tbody>
            @forelse($recentTeachers ?? [] as $item)
              @php
                $itemPhoto = is_object($item) ? $item->photo_url : ($item['photo_url'] ?? null);
                $itemName  = is_object($item) ? $item->name : ($item['name'] ?? '');
                $itemRole  = is_object($item) ? ($item->role_position ?? '') : ($item['role_position'] ?? '');
                $itemNip   = is_object($item) ? ($item->nip ?? 'Staf') : ($item['nip'] ?? 'Staf');
              @endphp
              <tr>
                <td style="width:54px">
                  @if($itemPhoto)
                    <img src="{{ asset($itemPhoto) }}" alt="{{ $itemName }}" class="adm-avatar-photo">
                  @else
                    <div class="adm-avatar-fallback">{{ substr($itemName, 0, 1) }}</div>
                  @endif
                </td>
                <td><span class="adm-name">{{ $itemName }}</span></td>
                <td><span class="adm-sub">{{ $itemRole }}</span></td>
                <td><span class="adm-tag active">{{ $itemNip }}</span></td>
              </tr>
            @empty
              <tr>
                <td colspan="4">
                  <div class="adm-empty"><i class="fas fa-chalkboard-user"></i>Belum ada data guru.</div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- FEED AKTIVITAS TERBARU -->
    <div class="adm-panel">
      <div class="adm-panel-head">
        <h2>Aktivitas Terbaru</h2>
        <span class="adm-section-hint">Ringkasan gabungan</span>
      </div>

      @if($feedItems->isNotEmpty())
        <ul class="adm-feed">
          @foreach($feedItems as $f)
            <li class="adm-feed-item">
              @if($f['type'] === 'teacher')
                <div class="adm-feed-dot" style="--adm-feed-bg:rgba(76,201,141,.14);--adm-feed-fg:#5ce0a3">
                  <i class="fas fa-chalkboard-user"></i>
                </div>
                <div class="adm-feed-body">
                  <p><b>{{ $f['title'] }}</b> {{ $f['desc'] }}</p>
                  @if($f['time'])<span class="adm-feed-time">{{ \Carbon\Carbon::parse($f['time'])->diffForHumans() }}</span>@endif
                </div>
              @else
                <div class="adm-feed-dot" style="--adm-feed-bg:rgba(40,169,225,.14);--adm-feed-fg:#4fc3f7">
                  <i class="fas fa-comments"></i>
                </div>
                <div class="adm-feed-body">
                  <p>Aspirasi baru <b>{{ $f['title'] }}</b> — {{ $f['desc'] }}</p>
                  @if($f['time'])<span class="adm-feed-time">{{ \Carbon\Carbon::parse($f['time'])->diffForHumans() }}</span>@endif
                </div>
              @endif
            </li>
          @endforeach
        </ul>
      @else
        <div class="adm-empty"><i class="fas fa-bell"></i>Belum ada aktivitas terbaru.</div>
      @endif
    </div>
  </div>

</div>
@endsection