@extends('layouts.admin')

@section('title', 'Dashboard Admin — SMK Negeri 2 Mojokerto')

@section('content')
  <!-- STAT CARDS -->
  <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:1.2rem;margin-bottom:2.2rem">
    <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);border-radius:18px;padding:1.4rem">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem">
        <div style="width:44px;height:44px;border-radius:12px;background:rgba(76,201,141,.14);color:#5ce0a3;display:flex;align-items:center;justify-content:center;font-size:1.1rem"><i class="fas fa-chalkboard-user"></i></div>
        <span style="font-size:.72rem;font-weight:700;color:#5ce0a3;background:rgba(76,201,141,.12);padding:.2rem .5rem;border-radius:999px">Aktif</span>
      </div>
      <div style="font-family:var(--font-display);font-size:1.9rem;color:#fff;margin-bottom:.3rem">{{ $stats['total_teachers'] ?? 0 }}</div>
      <div style="font-size:.8rem;color:var(--text-muted)">Guru &amp; Staf Pendidik</div>
    </div>

    <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);border-radius:18px;padding:1.4rem">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem">
        <div style="width:44px;height:44px;border-radius:12px;background:rgba(40,169,225,.14);color:#4fc3f7;display:flex;align-items:center;justify-content:center;font-size:1.1rem"><i class="fas fa-comments"></i></div>
        <span style="font-size:.72rem;font-weight:700;color:#ffb300;background:rgba(255,179,0,.12);padding:.2rem .5rem;border-radius:999px">{{ $stats['total_evoice_unread'] ?? 0 }} belum diulas</span>
      </div>
      <div style="font-family:var(--font-display);font-size:1.9rem;color:#fff;margin-bottom:.3rem">{{ $stats['total_evoice'] ?? 0 }}</div>
      <div style="font-size:.8rem;color:var(--text-muted)">Total E-Voice Aspirasi</div>
    </div>
  </div>

  <!-- SHORTCUT MODULE CARDS (DIRECT LINK TO MODULE PAGES) -->
  <div style="margin-bottom:2rem">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.1rem">
      <h2 style="font-family:var(--font-display);font-size:1.05rem;text-transform:uppercase;letter-spacing:.01em">Modul Manajemen Admin</h2>
      <span style="font-size:.78rem;color:var(--text-muted)">Klik modul untuk mengelola data di halaman khusus</span>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.1rem">

      <a href="{{ route('admin.teachers.index') }}" class="db-module-card">
        <div style="width:40px;height:40px;border-radius:11px;background:rgba(255,179,0,.12);color:var(--gold);display:flex;align-items:center;justify-content:center"><i class="fas fa-chalkboard-user"></i></div>
        <div>
          <h3 style="font-size:.9rem;font-weight:700;color:#fff;margin-bottom:.2rem">Guru &amp; Staf</h3>
          <p style="font-size:.72rem;color:var(--text-muted);line-height:1.4">Kelola data pendidik, foto, jabatan &amp; NIP.</p>
        </div>
        <span style="font-size:.72rem;font-weight:700;color:var(--gold-light);margin-top:auto">Buka Halaman &rarr;</span>
      </a>

      <a href="{{ route('admin.extracurriculars.index') }}" class="db-module-card">
        <div style="width:40px;height:40px;border-radius:11px;background:rgba(255,179,0,.12);color:var(--gold);display:flex;align-items:center;justify-content:center"><i class="fas fa-futbol"></i></div>
        <div>
          <h3 style="font-size:.9rem;font-weight:700;color:#fff;margin-bottom:.2rem">Ekstrakurikuler</h3>
          <p style="font-size:.72rem;color:var(--text-muted);line-height:1.4">Kelola 13 ekskul &amp; 3 organisasi sekolah.</p>
        </div>
        <span style="font-size:.72rem;font-weight:700;color:var(--gold-light);margin-top:auto">Buka Halaman &rarr;</span>
      </a>

      <a href="{{ route('admin.e-voices.index') }}" class="db-module-card">
        <div style="width:40px;height:40px;border-radius:11px;background:rgba(255,179,0,.12);color:var(--gold);display:flex;align-items:center;justify-content:center"><i class="fas fa-comments"></i></div>
        <div>
          <h3 style="font-size:.9rem;font-weight:700;color:#fff;margin-bottom:.2rem">E-Voice Aspirasi</h3>
          <p style="font-size:.72rem;color:var(--text-muted);line-height:1.4">Tinjau, tambah &amp; tindak lanjuti suara siswa.</p>
        </div>
        <span style="font-size:.72rem;font-weight:700;color:var(--gold-light);margin-top:auto">Buka Halaman &rarr;</span>
      </a>

      <a href="{{ route('admin.fact-checks.index') }}" class="db-module-card">
        <div style="width:40px;height:40px;border-radius:11px;background:rgba(255,179,0,.12);color:var(--gold);display:flex;align-items:center;justify-content:center"><i class="fas fa-shield-halved"></i></div>
        <div>
          <h3 style="font-size:.9rem;font-weight:700;color:#fff;margin-bottom:.2rem">School Factcheck</h3>
          <p style="font-size:.72rem;color:var(--text-muted);line-height:1.4">Publikasi &amp; klarifikasi kabar hoaks sekolah.</p>
        </div>
        <span style="font-size:.72rem;font-weight:700;color:var(--gold-light);margin-top:auto">Buka Halaman &rarr;</span>
      </a>

      <a href="{{ route('admin.job-vacancies.index') }}" class="db-module-card">
        <div style="width:40px;height:40px;border-radius:11px;background:rgba(255,179,0,.12);color:var(--gold);display:flex;align-items:center;justify-content:center"><i class="fas fa-briefcase"></i></div>
        <div>
          <h3 style="font-size:.9rem;font-weight:700;color:#fff;margin-bottom:.2rem">BKK &amp; Loker</h3>
          <p style="font-size:.72rem;color:var(--text-muted);line-height:1.4">Kelola lowongan kerja &amp; karir alumni.</p>
        </div>
        <span style="font-size:.72rem;font-weight:700;color:var(--gold-light);margin-top:auto">Buka Halaman &rarr;</span>
      </a>
    </div>
  </div>

  <!-- RECENT TABLES SPLIT -->
  <div style="display:grid;grid-template-columns:1.6fr 1fr;gap:1.4rem">
    <!-- RECENT TEACHERS TABLE -->
    <div class="db-panel">
      <div class="db-panel-head">
        <h2>Guru &amp; Staf Pendidik Terbaru</h2>
        <a href="{{ route('admin.teachers.index') }}" style="font-size:.78rem;color:var(--gold-light);font-weight:700">Lihat Semua &rarr;</a>
      </div>
      <div class="db-table-wrap">
        <table class="db-table">
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
              <tr>
                <td style="width:50px">
                  @if($item->photo_url)
                    <img src="{{ asset($item->photo_url) }}" alt="{{ $item->name }}" style="width:36px;height:36px;border-radius:10px;object-fit:cover">
                  @else
                    <div style="width:36px;height:36px;border-radius:10px;background:rgba(255,179,0,.15);color:var(--gold);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.85rem">
                      {{ substr($item->name, 0, 1) }}
                    </div>
                  @endif
                </td>
                <td><strong>{{ $item->name }}</strong></td>
                <td><span style="font-size:.75rem;color:var(--text-muted)">{{ $item->role_position }}</span></td>
                <td><span class="db-tag active">{{ $item->nip ?? 'Staf' }}</span></td>
              </tr>
            @empty
              <tr><td colspan="4" style="text-align:center;color:var(--text-muted);padding:1.5rem">Belum ada data guru.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- RECENT E-VOICE TABLE -->
    <div class="db-panel">
      <div class="db-panel-head">
        <h2>Aspirasi E-Voice Terbaru</h2>
        <a href="{{ route('admin.e-voices.index') }}" style="font-size:.78rem;color:var(--gold-light);font-weight:700">Lihat Semua &rarr;</a>
      </div>
      <div class="db-table-wrap">
        <table class="db-table">
          <thead>
            <tr>
              <th>Kode / Judul</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse($recentEVoices ?? [] as $item)
              <tr>
                <td>
                  <strong style="color:var(--gold-light);font-size:.78rem">{{ $item->ticket_code }}</strong><br>
                  <span style="font-size:.8rem">{{ Str::limit($item->title, 35) }}</span>
                </td>
                <td><span class="db-tag {{ is_object($item->status) ? strtolower($item->status->value) : strtolower($item->status) }}">{{ is_object($item->status) ? $item->status->value : $item->status }}</span></td>
              </tr>
            @empty
              <tr><td colspan="2" style="text-align:center;color:var(--text-muted);padding:1.5rem">Belum ada aspirasi E-Voice.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection