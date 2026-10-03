@extends('layouts.app')

@section('title', 'Program Keahlian ' . $major->name . ' — SMK Negeri 2 Mojokerto')
@section('description', 'Program Keahlian ' . $major->name . ' (' . $major->code . ') SMK Negeri 2 Mojokerto: profil, kompetensi, fasilitas, dan prospek karir.')

@section('content')
<style>
  .major-detail-page { background: #081b30; color: #fff; min-height: 100vh; padding-bottom: 5rem; }
  .major-hero {
    position: relative; padding: 6rem 1.5rem 4rem; text-align: center;
    background: radial-gradient(1000px 400px at 50% 0%, rgba(29, 111, 184, 0.25), transparent 70%);
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }
  .major-badge {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .4rem .9rem; border-radius: 999px; font-size: .75rem; font-weight: 800;
    letter-spacing: .15em; text-transform: uppercase; background: rgba(255, 179, 0, 0.15);
    color: #ffd54a; border: 1px solid rgba(255, 179, 0, 0.3); margin-bottom: 1.2rem;
  }
  .major-title { font-family: var(--font-display, inherit); font-size: clamp(2.2rem, 5vw, 3.8rem); font-weight: 800; line-height: 1.1; margin: 0 0 1rem; color: #fff; }
  .major-sub { font-size: 1.05rem; color: #8ea3ba; max-width: 720px; margin: 0 auto 2rem; line-height: 1.6; }
  .major-container { width: min(1200px, 92%); margin: 0 auto; padding-top: 3rem; }
  .grid-3 { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.2rem; }
  .card-panel { background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.09); border-radius: 18px; padding: 1.4rem; display: flex; flex-direction: column; }
  .card-panel h3 { font-size: 1.1rem; color: #fff; margin-top: 0; margin-bottom: .6rem; font-weight: 800; display: flex; align-items: center; gap: .6rem; }
  .card-panel h3 i { color: #ffd54a; }
  .card-panel p { color: #8ea3ba; font-size: .85rem; line-height: 1.6; margin: 0; }
  .sec-head { margin-bottom: 1.5rem; border-left: 4px solid #ffd54a; padding-left: 1rem; }
  .sec-head h2 { font-size: 1.4rem; font-weight: 800; margin: 0; color: #fff; }
  .sec-head p { color: #8ea3ba; margin: .2rem 0 0; font-size: .82rem; }

  @media(max-width: 768px) {
    .grid-3 {
      display: flex !important;
      overflow-x: auto !important;
      scroll-snap-type: x mandatory !important;
      -webkit-overflow-scrolling: touch !important;
      padding-bottom: .8rem !important;
      gap: 1rem !important;
      scrollbar-width: none;
    }
    .grid-3::-webkit-scrollbar { display: none; }
    .card-panel {
      flex: 0 0 84% !important;
      scroll-snap-align: center !important;
      max-height: 360px !important;
      overflow-y: auto !important;
    }
  }
</style>

<div class="major-detail-page">
  <!-- HERO SECTION -->
  <header class="major-hero">
    <div class="major-badge">
      <i class="{{ $major->icon_url ?? 'fas fa-graduation-cap' }}"></i> PROGRAM KEAHLIAN {{ $major->code }}
    </div>
    <h1 class="major-title">{{ $major->name }}</h1>
    <p class="major-sub">{{ $major->getDetail('hero_subtitle', $major->description ?? 'Konsentrasi Keahlian Unggulan SMK Negeri 2 Mojokerto.') }}</p>

    @if($major->getDetail('video_url'))
      <div style="margin-top: 1.5rem">
        <a href="{{ $major->getDetail('video_url') }}" target="_blank" class="db-btn db-btn-gold" style="padding: .75rem 1.4rem; border-radius: 12px; font-weight: 800; display: inline-flex; align-items: center; gap: .5rem">
          <i class="fas fa-play"></i> Tonton Video Profil Jurusan
        </a>
      </div>
    @endif
  </header>

  <main class="major-container">

    <!-- PROFIL & MOOTTO -->
    <div style="margin-bottom: 3.5rem">
      <div class="sec-head">
        <h2>Profil &amp; Konsentrasi Keahlian</h2>
        <p>Gambaran umum kompetensi yang dipelajari di jurusan {{ $major->name }}</p>
      </div>
      <div class="card-panel">
        <p style="font-size: 1rem; line-height: 1.75; color: #d7dee6">
          {{ $major->description ?? 'Program Keahlian ' . $major->name . ' membekali peserta didik dengan pengetahuan teori dan keterampilan praktis berstandar industri modern.' }}
        </p>
      </div>
    </div>

    <!-- KOMPETENSI / KURIKULUM UTAGMA -->
    @php
      $competencies = $major->getDetail('competencies', []);
    @endphp
    @if(!empty($competencies))
      <div style="margin-bottom: 3.5rem">
        <div class="sec-head">
          <h2>Kompetensi Keahlian Utama</h2>
          <p>Materi inti &amp; spesialisasi keahlian peserta didik</p>
        </div>
        <div class="grid-3">
          @foreach($competencies as $comp)
            <div class="card-panel">
              <h3><i class="fas {{ $comp['icon'] ?? 'fa-check-circle' }}"></i> {{ $comp['title'] ?? 'Kompetensi' }}</h3>
              <p>{{ $comp['desc'] ?? '' }}</p>
            </div>
          @endforeach
        </div>
      </div>
    @endif

    <!-- FASILITAS & LAB -->
    @php
      $facilities = $major->getDetail('facilities', []);
    @endphp
    @if(!empty($facilities))
      <div style="margin-bottom: 3.5rem">
        <div class="sec-head">
          <h2>Fasilitas &amp; Laboratorium Praktik</h2>
          <p>Sarana dan prasarana pendukung kegiatan belajar mengajar</p>
        </div>
        <div class="grid-3">
          @foreach($facilities as $fac)
            <div class="card-panel">
              @if(!empty($fac['image']))
                <img src="{{ asset($fac['image']) }}" alt="{{ $fac['title'] ?? '' }}" style="width: 100%; height: 160px; object-fit: cover; border-radius: 12px; margin-bottom: 1rem; border: 1px solid rgba(255,255,255,.1)">
              @endif
              <h3><i class="fas fa-building"></i> {{ $fac['title'] ?? 'Fasilitas' }}</h3>
              <p>{{ $fac['desc'] ?? '' }}</p>
            </div>
          @endforeach
        </div>
      </div>
    @endif

    <!-- PROSPEK KERJA & KARIER -->
    @php
      $careers = $major->getDetail('careers', []);
    @endphp
    @if(!empty($careers))
      <div style="margin-bottom: 3.5rem">
        <div class="sec-head">
          <h2>Prospek Kerja &amp; Karir Alumni</h2>
          <p>Peluang karir lulusan di Dunia Usaha &amp; Dunia Industri (DUDI)</p>
        </div>
        <div class="grid-3">
          @foreach($careers as $car)
            <div class="card-panel">
              <h3><i class="fas fa-briefcase"></i> {{ $car['title'] ?? 'Karir' }}</h3>
              <p>{{ $car['desc'] ?? '' }}</p>
            </div>
          @endforeach
        </div>
      </div>
    @endif

    <!-- KARYA SISWA TERKAIT -->
    @if($studentWorks->isNotEmpty())
      <div style="margin-bottom: 3.5rem">
        <div class="sec-head">
          <h2>Karya &amp; Proyek Siswa {{ $major->code }}</h2>
          <p>Hasil karya inovasi ciptaan siswa jurusan {{ $major->name }}</p>
        </div>
        <div class="grid-3">
          @foreach($studentWorks as $work)
            <div class="card-panel">
              @if($work->image_url)
                <img src="{{ asset($work->image_url) }}" alt="{{ $work->title }}" style="width: 100%; height: 160px; object-fit: cover; border-radius: 12px; margin-bottom: 1rem">
              @endif
              <h3>{{ $work->title }}</h3>
              <p style="font-size: .8rem; color: #ffd54a; margin-bottom: .4rem">Oleh: {{ $work->student_name }}</p>
              <p>{{ Str::limit($work->description, 90) }}</p>
            </div>
          @endforeach
        </div>
      </div>
    @endif

  </main>
</div>
@endsection
