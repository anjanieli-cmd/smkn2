@extends('layouts.app')

@section('title', 'BKK & Loker — SMK Negeri 2 Mojokerto')
@section('description', 'Pusat informasi Bursa Kerja Khusus dan lowongan kerja SMK Negeri 2 Mojokerto untuk siswa dan alumni.')

@push('styles')
<style>
.bkk-page{background:#f7f9fc;color:#0d3a66;overflow:hidden;position:relative}.bkk-page *{box-sizing:border-box}
.bkk-hero{position:relative;min-height:clamp(480px,65vh,680px);display:flex;align-items:center;overflow:hidden;background:#fff;color:#0d3a66;isolation:isolate}
.bkk-hero:after{content:"BKK";position:absolute;z-index:0;left:2%;top:58%;transform:translateY(-50%);font-family:var(--font-display);font-size:clamp(3.4rem,11.5vw,11.5rem);font-weight:900;line-height:.78;letter-spacing:.01em;color:rgba(13,58,102,.035);-webkit-text-stroke:1px rgba(255,122,0,.09);pointer-events:none;white-space:nowrap;user-select:none}
.bkk-orn{position:absolute;inset:0;pointer-events:none;overflow:hidden;z-index:1}
.bkk-ring{position:absolute;width:330px;height:330px;border:1px solid rgba(13,58,102,.12);border-radius:50%;right:-80px;top:-100px}
.bkk-ring:before{content:"";position:absolute;inset:32px;border:1px dashed rgba(255,179,0,.28);border-radius:50%}
.bkk-dots{position:absolute;width:100px;height:100px;right:12%;bottom:12%;opacity:.45;background-image:radial-gradient(rgba(13,58,102,.35) 1.5px,transparent 1.6px);background-size:15px 15px}
.bkk-hero-inner{position:relative;z-index:4;width:100%;max-width:1400px;margin:0 auto;padding:clamp(3.2rem,8vh,5rem) clamp(1.25rem,4vw,4rem);display:block}
.bkk-kicker,.bkk-pill{display:inline-flex;align-items:center;gap:.5rem}
.bkk-kicker{position:relative;z-index:5;gap:.65rem;font-size:.72rem;font-weight:900;letter-spacing:.18em;text-transform:uppercase;color:#ff6f00;margin-bottom:1.2rem;padding:.55rem .85rem;border:1px solid rgba(255,111,0,.18);border-radius:999px;background:#fffaf5}
.bkk-kicker:before{content:"";width:9px;height:9px;border-radius:50%;background:#ff6f00;box-shadow:0 0 0 6px rgba(255,111,0,.10)}
.bkk-title{position:relative;z-index:5;font-family:var(--font-display);font-size:clamp(3.2rem,8vw,6.5rem);line-height:.9;letter-spacing:-.03em;margin:0;max-width:900px;text-transform:uppercase}
.bkk-ref-ornaments{position:absolute!important;inset:0;z-index:1;overflow:hidden;pointer-events:none;opacity:1}
.bkk-ref-ornament-image{position:absolute!important;inset:0;width:100%;height:100%;display:block;object-fit:cover;object-position:center center;max-width:none;opacity:1}
.bkk-title .navy{display:block;color:#0d3a66}
.bkk-title .gold{display:block;color:transparent;background:linear-gradient(135deg,#ffd54a 0%,#ffb300 48%,#ff7a00 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
.bkk-lead{position:relative;z-index:5;max-width:640px;margin:1.4rem 0 0;color:#52657a;font-size:1rem;line-height:1.8}
.bkk-pills{position:relative;z-index:5;display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.6rem}
.bkk-pill{padding:.55rem .85rem;border-radius:999px;background:#fff;border:1px solid rgba(13,58,102,.12);box-shadow:0 8px 24px rgba(13,58,102,.06);font-size:.72rem;font-weight:800;color:#0d3a66}
.bkk-pill i{color:#ff7a00}

.bkk-strip{background:#0d3a66;color:#fff;border-bottom:3px solid #ffc107;overflow:hidden}
.bkk-strip-inner{display:flex;align-items:center;gap:1rem;padding:.8rem clamp(1.25rem,5vw,5.5rem)}
.bkk-strip-label{padding:.42rem .8rem;border-radius:999px;background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;font-size:.67rem;font-weight:900;letter-spacing:.14em;text-transform:uppercase;white-space:nowrap}
.bkk-strip-text{font-size:.8rem;color:rgba(255,255,255,.86);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}

.bkk-section{position:relative;padding:clamp(3.5rem,6vw,5.5rem) clamp(1.25rem,5vw,5.5rem)}
.bkk-container{max-width:1240px;margin:0 auto;position:relative;z-index:2}
.bkk-head{display:flex;align-items:flex-end;justify-content:space-between;gap:2rem;margin-bottom:2.4rem}
.bkk-eyebrow{display:inline-flex;align-items:center;gap:.55rem;font-size:.7rem;font-weight:900;letter-spacing:.19em;text-transform:uppercase;color:#2f6fa8;margin-bottom:.65rem}
.bkk-eyebrow:before{content:"";width:26px;height:2px;background:linear-gradient(90deg,#ffd54a,#ffb300)}
.bkk-heading{font-family:var(--font-display);font-size:clamp(2rem,4vw,3.2rem);line-height:1;letter-spacing:-.025em;margin:0;color:#0d3a66}
.bkk-heading em{font-style:normal;color:transparent;background:linear-gradient(135deg,#ffd54a,#ff8a00);-webkit-background-clip:text;background-clip:text}
.bkk-sub{max-width:600px;margin:.85rem 0 0;color:#52657a;font-size:.92rem;line-height:1.75}
.bkk-num{font-family:var(--font-display);font-weight:900;font-size:clamp(3.5rem,6vw,5.5rem);line-height:1;color:rgba(13,58,102,.06);user-select:none}

.bkk-intro{display:grid;grid-template-columns:1.25fr .75fr;gap:1.4rem}
.bkk-card{background:#fff;border:1px solid rgba(13,58,102,.1);border-radius:22px;box-shadow:0 14px 40px rgba(13,58,102,.07);padding:1.7rem}
.bkk-card h3{font-family:var(--font-display);font-size:1.25rem;margin:0 0 .65rem;color:#0d3a66}
.bkk-card p{font-size:.86rem;line-height:1.8;color:#52657a;margin:0}
.bkk-vision{background:#0d3a66;color:#fff}
.bkk-vision h3{color:#fff}
.bkk-vision p{color:rgba(235,245,253,.82)}
.bkk-quote{margin-top:1.1rem;padding:1rem 1.1rem;border-left:3px solid #ffc107;background:rgba(255,255,255,.06);font-size:.86rem;line-height:1.7;color:#fff;font-weight:700}

/* DUDI MITRA INDUSTRI GRID */
.ind-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.2rem;
}
.ind-card {
  background: #fff;
  border: 1px solid rgba(13,58,102,.1);
  border-radius: 20px;
  padding: 1.5rem;
  box-shadow: 0 10px 28px rgba(13,58,102,.06);
  transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
  display: flex;
  flex-direction: column;
}
.ind-card:hover {
  transform: translateY(-5px);
  border-color: rgba(255,179,0,.4);
  box-shadow: 0 18px 42px rgba(13,58,102,.14);
}
.ind-icon {
  width: 46px;
  height: 46px;
  border-radius: 14px;
  display: grid;
  place-items: center;
  background: linear-gradient(135deg, rgba(255,213,74,.22), rgba(255,179,0,.12));
  color: #0d3a66;
  font-size: 1.1rem;
  margin-bottom: 1rem;
  border: 1px solid rgba(255,179,0,.3);
}
.ind-card h4 {
  font-family: var(--font-display);
  font-size: 1.05rem;
  margin: 0 0 .4rem;
  color: #0d3a66;
  line-height: 1.3;
}
.ind-field {
  font-size: .76rem;
  color: #ff6f00;
  font-weight: 800;
  margin-bottom: .4rem;
  display: inline-flex;
  align-items: center;
  gap: .3rem;
}
.ind-scope {
  font-size: .8rem;
  line-height: 1.6;
  color: #65788d;
  margin: 0;
}

/* DYNAMIC JOB CARDS */
.bkk-jobs{background:#f1f5f9}
.bkk-job-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1.2rem}
.bkk-job{background:#fff;border:1px solid rgba(13,58,102,.1);border-radius:20px;padding:1.5rem;box-shadow:0 10px 28px rgba(13,58,102,.06);display:flex;flex-direction:column;gap:.75rem;transition:transform .2s ease, box-shadow .2s ease}
.bkk-job:hover{transform:translateY(-3px);box-shadow:0 16px 36px rgba(13,58,102,.12)}
.bkk-job-top{display:flex;align-items:center;justify-content:space-between;gap:.7rem;flex-wrap:wrap}

.bkk-status{display:inline-flex;align-items:center;gap:.4rem;border-radius:999px;padding:.36rem .75rem;font-size:.65rem;font-weight:900;letter-spacing:.08em;text-transform:uppercase}
.bkk-status.open{background:#e6f4ea;color:#1e7e43;border:1px solid #b7e1cd}
.bkk-status.upcoming{background:#fff8e1;color:#b78103;border:1px solid #ffe082}
.bkk-status.selesai{background:#fce8e6;color:#c5221f;border:1px solid #f6aea9}
.bkk-status.archive{background:#eef1f4;color:#64778b;border:1px solid #cbd5e1}

.bkk-date{font-size:.72rem;color:#65788d;font-weight:700}
.bkk-job h3{font-family:var(--font-display);font-size:1.15rem;line-height:1.3;margin:0;color:#0d3a66}
.bkk-job p{font-size:.82rem;line-height:1.7;color:#596e83;margin:0}
.bkk-job-meta{display:flex;flex-wrap:wrap;gap:.45rem;margin-top:auto;padding-top:.5rem}
.bkk-tag{padding:.4rem .7rem;border-radius:999px;background:#f7f9fc;border:1px solid rgba(13,58,102,.09);font-size:.66rem;color:#0d3a66;font-weight:700;display:inline-flex;align-items:center;gap:.35rem}

.bkk-notice{margin-top:1.4rem;padding:1rem 1.2rem;border-radius:15px;background:#fffaf0;border:1px solid rgba(255,179,0,.3);color:#765d24;font-size:.78rem;line-height:1.65}
.bkk-notice i{color:#ffb300;margin-right:.35rem}
.bkk-status-key{display:flex;flex-wrap:wrap;gap:.6rem;margin-top:1.3rem}
.bkk-key{display:inline-flex;align-items:center;gap:.45rem;padding:.48rem .75rem;border-radius:999px;background:#fff;border:1px solid rgba(13,58,102,.1);font-size:.68rem;font-weight:800;color:#5c7085}
.bkk-key b{color:#0d3a66}

.bkk-photo-row{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-top:1.6rem}
.bkk-photo-row img{width:100%;height:190px;object-fit:cover;border-radius:18px;box-shadow:0 12px 30px rgba(13,58,102,.1)}

.bkk-cta{padding:0 clamp(1.25rem,5vw,5.5rem) clamp(3.5rem,7vw,5rem)}
.bkk-cta-box{max-width:1180px;margin:0 auto;background:#0d3a66;border-radius:27px;padding:clamp(2.5rem,5vw,4rem);color:#fff;text-align:center;box-shadow:0 28px 65px rgba(13,58,102,.22)}
.bkk-cta-box h2{font-family:var(--font-display);font-size:clamp(2rem,4vw,3.2rem);line-height:1.05;margin:0}
.bkk-cta-box h2 em{font-style:normal;color:#ffd54a}
.bkk-cta-box p{max-width:650px;margin:1rem auto 0;font-size:.88rem;line-height:1.8;color:rgba(235,245,253,.78)}

@media(max-width:1000px){.bkk-intro{grid-template-columns:1fr}}
@media(max-width:960px){.ind-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:860px){
  .bkk-section{padding:clamp(2.8rem,5vw,4rem) clamp(1.2rem,4vw,3rem)}
  .bkk-head{flex-direction:column;align-items:flex-start;gap:.5rem;margin-bottom:1.8rem}
  .bkk-num{display:none}
}
@media(max-width:720px){
  .bkk-job-grid{grid-template-columns:1fr}
  .bkk-photo-row{grid-template-columns:1fr;gap:.75rem}
  .bkk-photo-row img{height:170px}
}
@media(max-width:640px){
  .bkk-hero{min-height:0;align-items:flex-start}
  .bkk-hero-inner{width:100%;padding:clamp(2.8rem,7vh,4rem) 1.25rem 2.8rem}
  .bkk-hero::after{font-size:clamp(3.2rem,20vw,5.4rem);opacity:.6;left:-2%}
  .bkk-title{font-size:clamp(2.4rem,11vw,3.6rem)}
  .bkk-lead{font-size:.88rem;line-height:1.65;margin-top:1rem}
  .bkk-pills{gap:.4rem;margin-top:1.2rem}
  .bkk-pill{font-size:.7rem;padding:.4rem .75rem}
  .bkk-strip-inner{padding:.75rem 1rem;flex-direction:column;align-items:flex-start;gap:.4rem}
  .bkk-strip-text{white-space:normal;font-size:.76rem;line-height:1.5}
  .bkk-section{padding:2.2rem 1rem}
  .bkk-heading{font-size:clamp(1.6rem,6vw,2.2rem);line-height:1.15}
  .bkk-sub{font-size:.86rem;line-height:1.65}
  .bkk-card{padding:1.2rem 1.1rem;border-radius:16px}
  .bkk-card h3{font-size:1.1rem}
  .bkk-card p{font-size:.84rem;line-height:1.65}
  .ind-grid{grid-template-columns:1fr;gap:.85rem}
  .ind-card{padding:1.1rem;border-radius:16px}
  .ind-card h4{font-size:.98rem}
  .bkk-job{padding:1.1rem;border-radius:16px;gap:.6rem}
  .bkk-job-top{flex-direction:column;align-items:flex-start;gap:.4rem}
  .bkk-job h3{font-size:1.05rem}
  .bkk-job p{font-size:.82rem;line-height:1.6}
  .bkk-job-meta{margin-top:.4rem;gap:.4rem}
  .bkk-tag{font-size:.68rem;padding:.35rem .65rem}
  .bkk-notice{font-size:.75rem;padding:.85rem 1rem;border-radius:12px}
  .bkk-status-key{gap:.4rem;margin-top:1rem}
  .bkk-key{font-size:.64rem;padding:.35rem .65rem}
  .bkk-cta{padding:0 1rem 2.2rem}
  .bkk-cta-box{padding:2.2rem 1.1rem;border-radius:20px}
  .bkk-cta-box h2{font-size:1.45rem;line-height:1.15}
  .bkk-cta-box p{font-size:.86rem;line-height:1.65;margin-top:.75rem}
}
</style>
@endpush

@section('content')
<div class="bkk-page">
  <!-- HERO SECTION -->
  <section class="bkk-hero">
    <div class="bkk-ref-ornaments" aria-hidden="true" style="background-image:url('{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}');background-size:cover;background-position:center center;">
      <img src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}" alt="" class="bkk-ref-ornament-image" aria-hidden="true">
    </div>
    <div class="bkk-orn" aria-hidden="true"><span class="bkk-ring"></span><span class="bkk-dots"></span></div>
    <div class="bkk-hero-inner">
      <div>
        <div class="bkk-kicker">Pusat Informasi Karier Skaneda</div>
        <h1 class="bkk-title"><span class="navy">BKK &amp;</span><span class="gold">Loker</span></h1>
        <p class="bkk-lead">Bursa Kerja Khusus SMK Negeri 2 Mojokerto — membantu siswa dan alumni menuju dunia kerja lewat informasi karier, rekrutmen industri, persiapan kerja, dan jejaring dengan dunia usaha.</p>
        <div class="bkk-pills">
          <span class="bkk-pill"><i class="fas fa-briefcase"></i> Informasi Karier</span>
          <span class="bkk-pill"><i class="fas fa-building"></i> Rekrutmen Industri</span>
          <span class="bkk-pill"><i class="fas fa-user-graduate"></i> Siswa &amp; Alumni</span>
        </div>
      </div>
    </div>
  </section>

  <div class="bkk-strip">
    <div class="bkk-strip-inner">
      <span class="bkk-strip-label"><i class="fas fa-bolt"></i> BKK Skaneda</span>
      <span class="bkk-strip-text">Informasi lowongan, kegiatan BKK, rekrutmen industri, persiapan karier, dan penelusuran lulusan.</span>
    </div>
  </div>

  <!-- SECTION 01: TENTANG BKK -->
  <section class="bkk-section">
    <div class="bkk-container">
      <div class="bkk-head">
        <div>
          <span class="bkk-eyebrow">Tentang BKK</span>
          <h2 class="bkk-heading">Mengenal <em>BKK Skaneda</em></h2>
          <p class="bkk-sub">BKK merupakan layanan sekolah yang menghubungkan kompetensi siswa dan alumni dengan kebutuhan dunia kerja.</p>
        </div>
        <div class="bkk-num">01</div>
      </div>
      <div class="bkk-intro">
        <article class="bkk-card">
          <h3>Bursa Kerja Khusus SMK Negeri 2 Mojokerto</h3>
          <p>BKK membantu siswa dan alumni memperoleh informasi, akses, serta pendampingan menuju dunia kerja. Kegiatannya mencakup pelayanan informasi kerja, penempatan dan penyaluran tenaga kerja, kerja sama dengan dunia kerja/dunia industri, administrasi pencari kerja, bimbingan industri dan jabatan, serta pemantauan perkembangan karier lulusan.</p>
          <p style="margin-top:.8rem">Layanan BKK juga berkembang melalui rekrutmen industri, workshop dan seminar karier, simulasi psikotes, job fair/job matching, kegiatan Alumni Berbagi, penelusuran alumni, dan tracer vokasi.</p>
        </article>
        <article class="bkk-card bkk-vision">
          <h3>Visi BKK</h3>
          <p>Komitmen BKK dalam memberikan pelayanan karier bagi masyarakat pendidikan.</p>
          <div class="bkk-quote">“Kami siap melayani masyarakat pendidikan dan pembelajaran berbasis budaya Kerja, Disiplin dan Berprestasi.”</div>
        </article>
      </div>
      <div class="bkk-photo-row">
        <img src="{{ asset('images/bkk/rekruitment-tongtji.png') }}" alt="Dokumentasi kegiatan BKK 1">
        <img src="{{ asset('images/bkk/rekruitment-deabakery.png') }}" alt="Dokumentasi kegiatan BKK 2">
        <img src="{{ asset('images/bkk/rekruitment-btpn.png') }}" alt="Dokumentasi kegiatan BKK 3">
      </div>
    </div>
  </section>

  <!-- SECTION 02: DYNAMIC DUDI & MITRA INDUSTRI -->
  <section class="bkk-section" style="padding-top:1rem">
    <div class="bkk-container">
      <div class="bkk-head">
        <div>
          <span class="bkk-eyebrow">DUDI &amp; Kemitraan</span>
          <h2 class="bkk-heading">Mitra <em>Industri</em></h2>
          <p class="bkk-sub">Kerja sama strategis SMKN 2 Mojokerto dengan perusahaan mitra untuk PKL, Kelas Industri, &amp; Rekrutmen Lulusan.</p>
        </div>
        <div class="bkk-num">02</div>
      </div>

      <div class="ind-grid">
        @forelse($industries as $ind)
          <article class="ind-card">
            <div class="ind-icon"><i class="fas fa-building"></i></div>
            <h4>{{ $ind->company_name }}</h4>
            <span class="ind-field"><i class="fas fa-layer-group"></i> {{ $ind->field_of_work ?? 'Industri Umum' }}</span>
            <p class="ind-scope">{{ $ind->partnership_scope ?? 'PKL & Rekrutmen Lulusan' }}</p>
          </article>
        @empty
          <article class="ind-card"><div class="ind-icon"><i class="fas fa-building"></i></div><h4>PT Telkom Indonesia (Persero) Tbk</h4><span class="ind-field"><i class="fas fa-layer-group"></i> IT &amp; Telekomunikasi</span><p class="ind-scope">PKL, Kelas Industri &amp; Rekrutmen Lulusan</p></article>
          <article class="ind-card"><div class="ind-icon"><i class="fas fa-building"></i></div><h4>Bank Syariah Indonesia (BSI)</h4><span class="ind-field"><i class="fas fa-layer-group"></i> Keuangan &amp; Perbankan</span><p class="ind-scope">Magang Industri &amp; Rekrutmen Alumni</p></article>
          <article class="ind-card"><div class="ind-icon"><i class="fas fa-building"></i></div><h4>Hotel Vasa Surabaya</h4><span class="ind-field"><i class="fas fa-layer-group"></i> Hospitality &amp; Kuliner</span><p class="ind-scope">Praktik Kerja Lapangan Kuliner</p></article>
          <article class="ind-card"><div class="ind-icon"><i class="fas fa-building"></i></div><h4>PT Cheil Jedang Indonesia</h4><span class="ind-field"><i class="fas fa-layer-group"></i> Manufaktur &amp; Olahan Pangan</span><p class="ind-scope">Kemitraan Rekrutmen &amp; Kunjungan Industri</p></article>
          <article class="ind-card"><div class="ind-icon"><i class="fas fa-building"></i></div><h4>PT Perhutani Anugerah Kimia</h4><span class="ind-field"><i class="fas fa-layer-group"></i> Industri Hasil Hutan &amp; Kimia</span><p class="ind-scope">Kerja Sama Penyerapan Lulusan Vokasi</p></article>
        @endforelse
      </div>
    </div>
  </section>

  <!-- SECTION 03: DYNAMIC LOWONGAN KERJA -->
  <section class="bkk-section bkk-jobs">
    <div class="bkk-container">
      <div class="bkk-head">
        <div>
          <span class="bkk-eyebrow">Informasi Rekrutmen</span>
          <h2 class="bkk-heading">Loker &amp; <em>Rekrutmen</em></h2>
          <p class="bkk-sub">Daftar lowongan pekerjaan &amp; rekrutmen resmi BKK SMKN 2 Mojokerto.</p>
        </div>
        <div class="bkk-num">03</div>
      </div>

      <div class="bkk-job-grid">
        @forelse($jobVacancies as $job)
          @php
            $st = $job->status->value ?? $job->status;
            $statusClass = match($st) {
              'OPEN' => 'open',
              'UPCOMING' => 'upcoming',
              'SELESAI' => 'selesai',
              'ARSIP' => 'archive',
              default => 'open'
            };
            $statusIcon = match($st) {
              'OPEN' => 'fa-door-open',
              'UPCOMING' => 'fa-clock',
              'SELESAI' => 'fa-circle-check',
              'ARSIP' => 'fa-archive',
              default => 'fa-briefcase'
            };
            $statusLabel = match($st) {
              'OPEN' => 'OPEN (Pendaftaran Berlangsung)',
              'UPCOMING' => 'UPCOMING (Akan Datang)',
              'SELESAI' => 'SELESAI (Berakhir)',
              'ARSIP' => 'ARSIP (Dokumentasi)',
              default => $st
            };
          @endphp
          <article class="bkk-job">
            <div class="bkk-job-top">
              <span class="bkk-status {{ $statusClass }}">
                <i class="fas {{ $statusIcon }}"></i> {{ $statusLabel }}
              </span>
              @if($job->deadline)
                <span class="bkk-date"><i class="far fa-calendar-alt"></i> Batas: {{ \Carbon\Carbon::parse($job->deadline)->format('d M Y') }}</span>
              @endif
            </div>
            <h3>{{ $job->title }}</h3>
            <div style="font-size:.84rem;font-weight:700;color:#2f6fa8;margin-top:-.2rem">
              <i class="fas fa-building" style="color:#ff7a00;margin-right:.25rem"></i> {{ $job->company_name }}
              @if($job->location)
                &bull; <i class="fas fa-location-dot" style="color:#ff7a00;margin-right:.25rem"></i> {{ $job->location }}
              @endif
            </div>
            <p>{{ Str::limit($job->description, 170) }}</p>
            <div class="bkk-job-meta">
              <span class="bkk-tag"><i class="fas fa-user-clock"></i> {{ $job->employment_type ?? 'Full-Time' }}</span>
              @if($job->apply_url)
                <a href="{{ $job->apply_url }}" target="_blank" class="bkk-tag" style="background:#0d3a66;color:#fff;text-decoration:none">
                  Lamar Sekarang <i class="fas fa-arrow-up-right-from-square"></i>
                </a>
              @endif
            </div>
          </article>
        @empty
          <div style="grid-column:1/-1;text-align:center;padding:3rem;background:#fff;border-radius:20px;border:1px dashed rgba(13,58,102,.2)">
            <p style="color:#52657a;font-size:.9rem;margin:0">Belum ada lowongan pekerjaan yang dipublikasikan saat ini.</p>
          </div>
        @endforelse
      </div>

      <div class="bkk-notice">
        <i class="fas fa-circle-info"></i> Informasi rekrutmen BKK dipublikasikan secara resmi. Seluruh proses pendaftaran dan seleksi BKK SMKN 2 Mojokerto **TIDAK DIPUNGUT BIAYA (GRATIS)**.
      </div>
      <div class="bkk-status-key">
        <span class="bkk-key"><b>OPEN</b> pendaftaran masih berlangsung</span>
        <span class="bkk-key"><b>UPCOMING</b> rekrutmen akan datang</span>
        <span class="bkk-key"><b>SELESAI</b> pendaftaran telah berakhir</span>
        <span class="bkk-key"><b>ARSIP</b> dokumentasi rekrutmen/kegiatan</span>
      </div>
    </div>
  </section>

  <!-- CTA SECTION -->
  <section class="bkk-cta">
    <div class="bkk-cta-box">
      <h2>Siap melangkah menuju <em>dunia kerja?</em></h2>
      <p>Pantau informasi rekrutmen, kegiatan BKK, pembekalan karier, dan berbagai kesempatan yang dipublikasikan oleh SMK Negeri 2 Mojokerto.</p>
    </div>
  </section>
</div>
@endsection