@extends('layouts.app')

@section('title', 'Sejarah Sekolah — SMK Negeri 2 Mojokerto')
@section('description', 'Perjalanan panjang SMK Negeri 2 Mojokerto sejak tahun 1968 hingga menjadi sekolah vokasi unggulan Kota Mojokerto.')

@push('styles')
<style>
  /* ============================================================
     PAGE HEADER — banner khusus halaman internal
  ============================================================ */
  .ph-banner{
    position:relative;overflow:hidden;
    background:linear-gradient(140deg,#0b2d50,#114d84 55%,#1d6fb8);
    padding:150px 0 70px;color:#fff;text-align:center;
  }
  .ph-banner::before{
    content:"";position:absolute;inset:0;
    background-image:radial-gradient(rgba(255,255,255,.07) 1px,transparent 1px);
    background-size:26px 26px;
    mask-image:radial-gradient(ellipse 70% 60% at 50% 30%,#000 30%,transparent 80%);
    -webkit-mask-image:radial-gradient(ellipse 70% 60% at 50% 30%,#000 30%,transparent 80%);
  }
  .ph-crumb{position:relative;z-index:2;font-size:.8rem;font-weight:600;color:rgba(255,255,255,.72);margin-bottom:1rem}
  .ph-crumb a{color:#fff;text-decoration:underline;text-underline-offset:3px}
  .ph-crumb a:hover{color:var(--gold)}
  .ph-title{position:relative;z-index:2;font-family:var(--font-display);font-size:clamp(1.9rem,3.8vw,2.9rem);line-height:1.2;margin-bottom:.7rem}
  .ph-title .num-2{color:#ffd54f}
  .ph-sub{position:relative;z-index:2;font-size:.98rem;color:rgba(255,255,255,.78);max-width:600px;margin:0 auto}

  /* ============================================================
     TIMELINE SEJARAH — vertikal, dengan titik & garis
  ============================================================ */
  .sj-wrap{max-width:820px;margin:0 auto}
  .sj-intro{font-size:.98rem;color:var(--text-muted);line-height:1.85;text-align:center;margin-bottom:3.4rem}
  .sj-timeline{position:relative;padding-left:2.6rem}
  .sj-timeline::before{
    content:"";position:absolute;left:11px;top:6px;bottom:6px;width:2px;
    background:linear-gradient(180deg,var(--teal),var(--gold) 90%);opacity:.4;
  }
  .sj-item{position:relative;padding-bottom:2.6rem}
  .sj-item:last-child{padding-bottom:0}
  .sj-dot{
    position:absolute;left:-2.6rem;top:2px;width:26px;height:26px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;font-size:.72rem;color:#fff;
    background:linear-gradient(135deg,var(--teal),var(--teal-light));
    box-shadow:0 0 0 5px rgba(29,111,184,.14),0 6px 16px rgba(13,58,102,.3);
    flex-shrink:0;z-index:1;
  }
  .sj-item.is-future .sj-dot{background:linear-gradient(135deg,var(--gold),var(--gold-dark));box-shadow:0 0 0 5px rgba(249,168,37,.16),0 6px 16px rgba(198,125,0,.3)}
  .sj-card{
    background:var(--card);border:1px solid var(--border);border-radius:16px;
    padding:1.25rem 1.5rem;box-shadow:var(--shadow);transition:transform .3s var(--ease),box-shadow .3s;
  }
  .sj-card:hover{transform:translateX(4px);box-shadow:var(--shadow-lg)}
  .sj-year{font-family:var(--font-display);font-size:1.05rem;color:var(--teal);margin-bottom:.35rem}
  .sj-item.is-future .sj-year{color:var(--gold-dark)}
  .sj-item-title{font-weight:700;font-size:1rem;color:var(--ink);margin-bottom:.35rem}
  .sj-item-text{font-size:.88rem;color:var(--text-muted);line-height:1.65}

  /* ============================================================
     KEPALA SEKOLAH DARI MASA KE MASA
  ============================================================ */
  .sj-kepsek-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.3rem;margin-top:2rem}
  .sj-kepsek-card{
    background:var(--card);border:1px solid var(--border);border-radius:18px;
    padding:1.6rem 1.2rem;text-align:center;box-shadow:var(--shadow);transition:transform .3s var(--ease)
  }
  .sj-kepsek-card:hover{transform:translateY(-5px);box-shadow:var(--shadow-lg)}
  .sj-kepsek-avatar{
    width:70px;height:70px;border-radius:50%;margin:0 auto .9rem;
    background:linear-gradient(135deg,var(--teal),var(--teal-light));
    display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.5rem;
  }
  .sj-kepsek-period{font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--gold-dark);margin-bottom:.3rem}
  .sj-kepsek-name{font-weight:700;font-size:.94rem;color:var(--ink);line-height:1.4}
  .sj-note{
    text-align:center;font-size:.8rem;color:var(--text-muted);
    background:var(--bg);border:1px dashed var(--border);border-radius:12px;
    padding:.9rem 1.2rem;margin-top:1.8rem
  }

  /* ============================================================
     CTA PENUTUP
  ============================================================ */
  .sj-cta{
    margin-top:3.5rem;text-align:center;padding:2.4rem 1.5rem;border-radius:20px;
    background:linear-gradient(135deg,var(--teal-dark),var(--teal));color:#fff;
  }
  .sj-cta p{font-size:.95rem;color:rgba(255,255,255,.85);margin-bottom:1.1rem}
  .sj-cta a{
    display:inline-flex;align-items:center;gap:.5rem;padding:.75rem 1.6rem;border-radius:12px;
    background:linear-gradient(135deg,var(--gold),var(--gold-dark));color:#3d2600;font-weight:700;font-size:.88rem;
  }

  @media(max-width:768px){
    .sj-kepsek-grid{grid-template-columns:1fr}
    .sj-timeline{padding-left:2.1rem}
    .sj-dot{left:-2.1rem;width:22px;height:22px;font-size:.62rem}
  }
</style>
@endpush

@section('content')

<!-- ================= PAGE HEADER ================= -->
<section class="ph-banner">
  <div class="container">
    <div class="ph-crumb"><a href="{{ route('home') }}">Beranda</a> / Profil / Sejarah Sekolah</div>
    <h1 class="ph-title">Sejarah SMK Negeri <span class="num-2">2</span> Mojokerto</h1>
    <p class="ph-sub">Perjalanan panjang sekolah vokasi unggulan Kota Mojokerto, sejak berdiri hingga menjadi rujukan pendidikan kejuruan.</p>
  </div>
</section>

<!-- ================= ISI SEJARAH ================= -->
<section class="section-py">
  <div class="container">
    <div class="sj-wrap">

      <p class="sj-intro" data-reveal>
        Berdiri sejak <strong>1968</strong>, SMK Negeri 2 Mojokerto telah menjadi pilihan utama keluarga Mojokerto dalam menyiapkan generasi vokasi yang kompeten, berkarakter, dan siap bersaing di era global. Dari masa ke masa, sekolah ini terus bertumbuh &mdash; membuka program keahlian baru, membangun kemitraan dengan dunia usaha dan industri, hingga meraih akreditasi A dan sederet prestasi tingkat provinsi maupun nasional.
      </p>

      <div class="sj-timeline">

        <div class="sj-item" data-reveal>
          <div class="sj-dot"><i class="fas fa-flag"></i></div>
          <div class="sj-card">
            <div class="sj-year">1968</div>
            <div class="sj-item-title">Awal Berdiri</div>
            <p class="sj-item-text">SMK Negeri 2 Mojokerto resmi berdiri dan membuka pendidikan kejuruan pertama bagi masyarakat Kota Mojokerto. <em>(Lengkapi dengan detail nama awal sekolah / SK pendirian jika ada.)</em></p>
          </div>
        </div>

        <div class="sj-item" data-reveal>
          <div class="sj-dot"><i class="fas fa-school"></i></div>
          <div class="sj-card">
            <div class="sj-year">2020&ndash;2022</div>
            <div class="sj-item-title">Fondasi Sekolah</div>
            <p class="sj-item-text">Renovasi laboratorium dan fasilitas belajar, serta penguatan kemitraan dengan dunia usaha dan industri (DUDI) sebagai fondasi menuju sekolah vokasi modern.</p>
          </div>
        </div>

        <div class="sj-item" data-reveal>
          <div class="sj-dot"><i class="fas fa-laptop-code"></i></div>
          <div class="sj-card">
            <div class="sj-year">2023</div>
            <div class="sj-item-title">Digitalisasi &amp; Akreditasi A</div>
            <p class="sj-item-text">Sekolah menerima Akreditasi A dari BAN-SM, bersamaan dengan digitalisasi perpustakaan dan penguatan program sertifikasi Cisco &amp; Oracle bagi siswa.</p>
          </div>
        </div>

        <div class="sj-item" data-reveal>
          <div class="sj-dot"><i class="fas fa-trophy"></i></div>
          <div class="sj-card">
            <div class="sj-year">2024</div>
            <div class="sj-item-title">Juara 1 LKS Provinsi Jawa Timur</div>
            <p class="sj-item-text">Siswa jurusan Rekayasa Perangkat Lunak meraih Juara 1 Lomba Kompetensi Siswa (LKS) tingkat Provinsi Jawa Timur kategori Web Technologies.</p>
          </div>
        </div>

        <div class="sj-item" data-reveal>
          <div class="sj-dot"><i class="fas fa-gear"></i></div>
          <div class="sj-card">
            <div class="sj-year">2025</div>
            <div class="sj-item-title">Transformasi Vokasi</div>
            <p class="sj-item-text">Penguatan pembelajaran berbasis industri, peluncuran website resmi sekolah, dan perluasan program keahlian yang relevan dengan kebutuhan pasar kerja.</p>
          </div>
        </div>

        <div class="sj-item is-future" data-reveal>
          <div class="sj-dot"><i class="fas fa-star"></i></div>
          <div class="sj-card">
            <div class="sj-year">2028 &middot; Target</div>
            <div class="sj-item-title">Sekolah Vokasi Rujukan Nasional</div>
            <p class="sj-item-text">Menjadi sekolah menengah kejuruan rujukan nasional dengan lulusan yang beriman, berkarakter, kompeten, dan mampu bersaing secara internasional.</p>
          </div>
        </div>

      </div>

      <!-- ================= KEPALA SEKOLAH DARI MASA KE MASA ================= -->
      <div class="section-header center" data-reveal style="margin-top:4rem">
        <div class="section-label">Kepemimpinan</div>
        <h2 class="section-title">Kepala Sekolah <span class="accent">dari Masa ke Masa</span></h2>
        <p class="section-desc">Para pemimpin yang telah membawa SMK Negeri 2 Mojokerto berkembang hingga hari ini.</p>
      </div>

      <div class="sj-kepsek-grid" data-reveal>
        <div class="sj-kepsek-card">
          <div class="sj-kepsek-avatar"><i class="fas fa-user-tie"></i></div>
          <div class="sj-kepsek-period">Periode ????&ndash;????</div>
          <div class="sj-kepsek-name">[Nama Kepala Sekolah]</div>
        </div>
        <div class="sj-kepsek-card">
          <div class="sj-kepsek-avatar"><i class="fas fa-user-tie"></i></div>
          <div class="sj-kepsek-period">Periode ????&ndash;????</div>
          <div class="sj-kepsek-name">[Nama Kepala Sekolah]</div>
        </div>
        <div class="sj-kepsek-card">
          <div class="sj-kepsek-avatar"><i class="fas fa-user-tie"></i></div>
          <div class="sj-kepsek-period">Periode 2023&ndash;sekarang</div>
          <div class="sj-kepsek-name">Iswahyudi, S.ST. M.Pd</div>
        </div>
      </div>
      <p class="sj-note"><i class="fas fa-circle-info"></i> Data kepala sekolah sebelumnya masih placeholder &mdash; kirimkan nama &amp; periode jabatannya supaya bisa dilengkapi.</p>

      <!-- ================= CTA PENUTUP ================= -->
      <div class="sj-cta" data-reveal>
        <p>Ingin tahu lebih lanjut tentang visi, misi, dan program keahlian kami?</p>
        <a href="{{ route('home') }}#profil">Lihat Profil Sekolah <i class="fas fa-arrow-right"></i></a>
      </div>

    </div>
  </div>
</section>

@endsection