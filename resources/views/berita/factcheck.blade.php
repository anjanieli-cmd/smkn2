@extends('layouts.app')

@section('title', 'School FactCheck — Klarifikasi Informasi & Hoaks | SMK Negeri 2 Mojokerto')
@section('description', 'Periksa kebenaran informasi yang beredar tentang SMK Negeri 2 Mojokerto — PPDB, jadwal kegiatan, pengumuman, dan kebijakan sekolah — lengkap dengan status verifikasi, sumber resmi, dan tanggal pembaruan.')

@push('styles')
<style>
/* =========================================================
   SCHOOL FACTCHECK — Klarifikasi Informasi & Hoaks
   Langsung ke inti fungsi: cari/filter klaim yang beredar,
   lihat status verifikasinya (Terverifikasi / Tidak Benar /
   Belum Terkonfirmasi), sumber resmi, dan tanggal pembaruan.
   Frontend-only — data klarifikasi didefinisikan di JS agar
   mudah disambungkan ke backend/CMS nanti.
   Warna & tipografi mengikuti identitas situs: navy #0d3a66,
   gold #ffd54a/#ffb300, font-display, --ease. Tambahan warna
   status: hijau (benar), merah (tidak benar), amber (belum
   terkonfirmasi) — semua ikon dari Font Awesome, tanpa emoji.
   ========================================================= */
.fc-page{background:#f4f8fc;color:#0d3a66;min-height:60vh;position:relative;overflow:hidden}
.fc-page *{box-sizing:border-box}
.fc-wrap{width:min(1440px,94%);margin:0 auto;padding:44px 0 100px;position:relative;z-index:2}

/* decorative background */
.fc-blob{position:absolute;border-radius:50%;filter:blur(60px);z-index:0;pointer-events:none}
.fc-blob-a{width:520px;height:520px;top:-220px;right:-140px;
  background:radial-gradient(circle,rgba(255,213,74,.26),rgba(255,213,74,0) 70%)}
.fc-blob-b{width:460px;height:460px;top:340px;left:-220px;
  background:radial-gradient(circle,rgba(13,58,102,.10),rgba(13,58,102,0) 70%)}
.fc-blob-c{width:380px;height:380px;bottom:-160px;right:10%;
  background:radial-gradient(circle,rgba(31,138,76,.10),rgba(31,138,76,0) 70%)}
.fc-dotfield{position:absolute;inset:0;z-index:1;pointer-events:none;opacity:.5;
  background-image:radial-gradient(rgba(13,58,102,.06) 1.3px,transparent 1.4px);background-size:20px 20px;
  -webkit-mask-image:linear-gradient(180deg,#000 0,#000 340px,transparent 480px);
  mask-image:linear-gradient(180deg,#000 0,#000 340px,transparent 480px)}

/* top banner */
.fc-top{position:relative;display:flex;align-items:center;justify-content:space-between;gap:1.5rem;flex-wrap:wrap;
  margin-bottom:1.8rem;padding:1.6rem clamp(1.2rem,3vw,2.2rem);border-radius:24px;overflow:hidden;
  background:linear-gradient(120deg,#0d3a66 0%,#123f6e 55%,#0d3a66 100%);color:#fff;
  box-shadow:0 24px 54px rgba(13,58,102,.22)}
.fc-top::before{content:"";position:absolute;inset:0;
  background-image:radial-gradient(rgba(255,255,255,.09) 1.3px,transparent 1.4px);background-size:18px 18px;opacity:.5}
.fc-top::after{content:"";position:absolute;top:-60px;right:-40px;width:220px;height:220px;border-radius:50%;
  background:radial-gradient(circle,rgba(255,213,74,.35),rgba(255,213,74,0) 70%)}
.fc-top>*{position:relative;z-index:2}
.fc-eyebrow{display:inline-flex;align-items:center;gap:.55rem;font-size:.7rem;font-weight:900;
  letter-spacing:.16em;text-transform:uppercase;color:#ffd54a;margin-bottom:.6rem}
.fc-eyebrow i{font-size:.68rem}
.fc-top h1{font-family:var(--font-display);font-weight:900;font-size:clamp(1.6rem,3.2vw,2.3rem);
  margin:0;color:#fff;letter-spacing:-.01em}
.fc-top p{margin:.5rem 0 0;font-size:.86rem;color:rgba(235,245,253,.8);max-width:560px;line-height:1.7}
.fc-shield{display:inline-flex;align-items:center;gap:.5rem;font-size:.72rem;font-weight:800;color:#0d3a66;
  background:#fff;border-radius:999px;padding:.6rem .95rem;white-space:nowrap;
  box-shadow:0 12px 26px rgba(4,14,28,.25)}
.fc-shield i{color:#ffb300}

/* stats strip */
.fc-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:.9rem;margin-bottom:1.8rem}
.fc-stat{background:#fff;border:1px solid #eef2f6;border-radius:16px;padding:1rem 1.1rem;display:flex;align-items:center;gap:.8rem;
  box-shadow:0 10px 26px rgba(13,58,102,.05)}
.fc-stat-icon{width:38px;height:38px;border-radius:11px;flex:0 0 38px;display:flex;align-items:center;justify-content:center;font-size:.9rem}
.fc-stat b{display:block;font-family:var(--font-display);font-size:1.35rem;font-weight:900;line-height:1;color:#0d3a66}
.fc-stat span{display:block;font-size:.66rem;font-weight:800;letter-spacing:.03em;color:#8698a9;margin-top:.25rem;text-transform:uppercase}
.fc-stat.total .fc-stat-icon{background:#eef3f8;color:#5a7086}
.fc-stat.verified .fc-stat-icon{background:#e8f5ee;color:#1f8a4c}
.fc-stat.false .fc-stat-icon{background:#fdeceb;color:#e0483b}
.fc-stat.pending .fc-stat-icon{background:#fff6e0;color:#b98a12}

/* layout */
.fc-layout{display:grid;grid-template-columns:290px minmax(0,1fr);gap:1.8rem;align-items:start}
.fc-side{position:sticky;top:24px;display:flex;flex-direction:column;gap:1.1rem}
.fc-side-card{background:#fff;border:1px solid #eef2f6;border-radius:20px;padding:1.3rem 1.2rem;
  box-shadow:0 14px 34px rgba(13,58,102,.06)}
.fc-side-card h3{display:flex;align-items:center;gap:.55rem;font-family:var(--font-display);font-size:.88rem;
  font-weight:800;color:#0d3a66;margin:0 0 1rem}
.fc-side-card h3 i{width:26px;height:26px;border-radius:8px;display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0d3a66;font-size:.66rem;flex:0 0 26px}

.fc-search{position:relative;margin-bottom:.2rem}
.fc-search input{width:100%;border:1.5px solid #e3edf0;border-radius:12px;padding:.7rem .9rem .7rem 2.4rem;
  font-size:.82rem;color:#0d3a66;background:#fbfdff;transition:border-color .25s var(--ease,ease),box-shadow .25s var(--ease,ease)}
.fc-search input:focus{outline:none;border-color:#ffb300;box-shadow:0 0 0 4px rgba(255,179,0,.14)}
.fc-search i{position:absolute;left:.85rem;top:50%;transform:translateY(-50%);color:#a7b6c4;font-size:.8rem}

.fc-cat-list{list-style:none;margin:0;padding:0;display:grid;gap:.35rem}
.fc-cat-btn{width:100%;display:flex;align-items:center;justify-content:space-between;gap:.6rem;border:none;background:transparent;
  padding:.6rem .65rem;border-radius:10px;cursor:pointer;font-size:.78rem;font-weight:700;color:#5a7086;text-align:left;
  transition:background .25s var(--ease,ease),color .25s var(--ease,ease)}
.fc-cat-btn i{width:16px;text-align:center;color:#a7b6c4;font-size:.76rem;transition:color .25s var(--ease,ease)}
.fc-cat-btn .fc-cat-count{font-size:.66rem;font-weight:800;color:#a7b6c4;background:#eef3f8;border-radius:999px;padding:.15rem .5rem}
.fc-cat-btn:hover{background:#f3f7fb;color:#0d3a66}
.fc-cat-btn.active{background:#0d3a66;color:#fff}
.fc-cat-btn.active i{color:#ffd54a}
.fc-cat-btn.active .fc-cat-count{background:rgba(255,213,74,.22);color:#ffd54a}

.fc-legend{list-style:none;margin:0;padding:0;display:grid;gap:.7rem}
.fc-legend li{display:flex;align-items:flex-start;gap:.6rem;font-size:.74rem;color:#33475a;line-height:1.55}
.fc-legend-dot{width:20px;height:20px;border-radius:50%;flex:0 0 20px;display:flex;align-items:center;justify-content:center;font-size:.6rem;margin-top:.05rem}
.fc-legend-dot.verified{background:#e8f5ee;color:#1f8a4c}
.fc-legend-dot.false{background:#fdeceb;color:#e0483b}
.fc-legend-dot.pending{background:#fff6e0;color:#b98a12}
.fc-legend b{display:block;color:#0d3a66;font-weight:800;margin-bottom:.1rem}

.fc-side-note{background:linear-gradient(135deg,#0d3a66,#123f6e);color:#fff;border-radius:20px;padding:1.3rem 1.2rem;
  box-shadow:0 18px 40px rgba(13,58,102,.24)}
.fc-side-note h3{color:#fff}
.fc-side-note h3 i{background:rgba(255,255,255,.15);color:#ffd54a}
.fc-side-note p{font-size:.76rem;color:rgba(235,245,253,.82);line-height:1.65;margin:0 0 .9rem}
.fc-side-note a{display:inline-flex;align-items:center;gap:.45rem;font-size:.76rem;font-weight:800;color:#ffd54a;text-decoration:none}
.fc-side-note a i{font-size:.66rem;transition:transform .3s var(--ease,ease)}
.fc-side-note a:hover i{transform:translateX(4px)}

/* main */
.fc-main{min-width:0}
.fc-toolbar{display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.3rem}
.fc-status-pills{display:flex;gap:.5rem;flex-wrap:wrap}
.fc-pill{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem .85rem;border-radius:999px;border:1.5px solid #e3edf0;
  background:#fff;font-size:.72rem;font-weight:800;color:#5a7086;cursor:pointer;transition:all .25s var(--ease,ease)}
.fc-pill i{font-size:.7rem}
.fc-pill:hover{border-color:#ffd98a;transform:translateY(-1px)}
.fc-pill.active{color:#fff}
.fc-pill[data-status="semua"].active{background:#0d3a66;border-color:#0d3a66}
.fc-pill[data-status="Terverifikasi"].active{background:#1f8a4c;border-color:#1f8a4c}
.fc-pill[data-status="Tidak Benar"].active{background:#e0483b;border-color:#e0483b}
.fc-pill[data-status="Belum Terkonfirmasi"].active{background:#b98a12;border-color:#b98a12}
.fc-result-count{font-size:.76rem;color:#8698a9;font-weight:700;white-space:nowrap}
.fc-result-count b{color:#0d3a66}

/* card grid */
.fc-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.2rem}
.fc-card{background:#fff;border:1px solid #eef2f6;border-radius:18px;padding:1.3rem;position:relative;overflow:hidden;
  box-shadow:0 12px 30px rgba(13,58,102,.06);transition:transform .3s var(--ease,ease),box-shadow .3s var(--ease,ease)}
.fc-card:hover{transform:translateY(-4px);box-shadow:0 20px 42px rgba(13,58,102,.1)}
.fc-card::before{content:"";position:absolute;top:0;left:0;bottom:0;width:4px}
.fc-card.status-verified::before{background:#1f8a4c}
.fc-card.status-false::before{background:#e0483b}
.fc-card.status-pending::before{background:#ffb300}

.fc-card-head{display:flex;align-items:center;justify-content:space-between;gap:.6rem;flex-wrap:wrap;margin-bottom:.9rem}
.fc-badge{display:inline-flex;align-items:center;gap:.4rem;font-size:.66rem;font-weight:900;letter-spacing:.03em;
  text-transform:uppercase;padding:.36rem .7rem;border-radius:999px}
.fc-badge.status-verified{background:#e8f5ee;color:#1f8a4c}
.fc-badge.status-false{background:#fdeceb;color:#e0483b}
.fc-badge.status-pending{background:#fff6e0;color:#b98a12}
.fc-cat-tag{font-size:.66rem;font-weight:800;color:#5a7086;background:#eef3f8;border-radius:999px;padding:.34rem .68rem}

.fc-claim{display:flex;gap:.55rem;font-size:.86rem;font-weight:700;color:#0d3a66;line-height:1.55;margin-bottom:.7rem}
.fc-claim i{color:#dbe6ee;font-size:.9rem;margin-top:.15rem;flex:0 0 14px}

.fc-explain{font-size:.78rem;color:#5a7086;line-height:1.7;margin:0 0 .3rem;
  display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
.fc-card.open .fc-explain{-webkit-line-clamp:unset;overflow:visible}

.fc-more{display:inline-flex;align-items:center;gap:.35rem;background:none;border:none;padding:0;margin-top:.15rem;
  font-size:.72rem;font-weight:800;color:#0d3a66;cursor:pointer}
.fc-more i{font-size:.6rem;transition:transform .3s var(--ease,ease)}
.fc-more:hover{color:#ff7a00}
.fc-card.open .fc-more i{transform:rotate(180deg)}

.fc-card-foot{display:flex;align-items:center;justify-content:space-between;gap:.7rem;flex-wrap:wrap;
  margin-top:1rem;padding-top:.85rem;border-top:1px solid #eef2f6}
.fc-source{display:inline-flex;align-items:center;gap:.4rem;font-size:.7rem;font-weight:700;color:#2f6fa8;text-decoration:none;
  max-width:60%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.fc-source i{font-size:.7rem;flex:0 0 auto}
.fc-source:hover{color:#0d3a66;text-decoration:underline}
.fc-source.is-empty{color:#a7b6c4;pointer-events:none}
.fc-date{display:inline-flex;align-items:center;gap:.35rem;font-size:.68rem;color:#a7b6c4;font-weight:700;white-space:nowrap}
.fc-date i{font-size:.66rem}

/* empty state */
.fc-empty{display:none;text-align:center;padding:3.5rem 1rem;background:#fff;border:1px dashed #dbe6ee;border-radius:20px}
.fc-empty.is-shown{display:block}
.fc-empty i{font-size:2rem;color:#dbe6ee;margin-bottom:.9rem}
.fc-empty p{margin:0;font-size:.85rem;color:#8698a9}
.fc-empty span{display:block;font-size:.76rem;color:#a7b6c4;margin-top:.3rem}

/* CTA */
.fc-cta{margin-top:2.2rem;background:#fff;border:1px solid #eef2f6;border-radius:22px;padding:1.8rem 2rem;
  display:flex;align-items:center;justify-content:space-between;gap:1.5rem;flex-wrap:wrap;
  box-shadow:0 16px 38px rgba(13,58,102,.06)}
.fc-cta-text h3{font-family:var(--font-display);font-size:1.05rem;font-weight:800;color:#0d3a66;margin:0 0 .35rem}
.fc-cta-text p{font-size:.8rem;color:#718396;margin:0;max-width:460px;line-height:1.6}
.fc-cta-btn{display:inline-flex;align-items:center;gap:.55rem;padding:.85rem 1.6rem;border-radius:999px;border:none;
  background:linear-gradient(135deg,#ffd54a,#ffb300);color:#0a2d52;font-weight:800;font-size:.83rem;text-decoration:none;
  white-space:nowrap;box-shadow:0 14px 30px rgba(255,179,0,.3);transition:transform .25s var(--ease,ease),box-shadow .25s var(--ease,ease)}
.fc-cta-btn:hover{transform:translateY(-2px);box-shadow:0 18px 38px rgba(255,179,0,.4)}
.fc-cta-btn i{font-size:.72rem}

/* responsive */
@media(max-width:1180px){
  .fc-layout{grid-template-columns:260px minmax(0,1fr);gap:1.4rem}
}
@media(max-width:980px){
  .fc-layout{grid-template-columns:1fr}
  .fc-side{position:static;flex-direction:row;flex-wrap:wrap}
  .fc-side-card,.fc-side-note{flex:1 1 260px}
  .fc-stats{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:700px){
  .fc-wrap{padding:32px 0 70px}
  .fc-top{padding:1.3rem 1.1rem;border-radius:20px}
  .fc-side{flex-direction:column}
  .fc-grid{grid-template-columns:1fr}
  .fc-toolbar{align-items:flex-start}
  .fc-cta{flex-direction:column;align-items:stretch;text-align:center}
  .fc-cta-btn{justify-content:center}
}
@media(max-width:480px){
  .fc-stats{grid-template-columns:1fr 1fr}
}
</style>
@endpush

@section('content')
<div class="fc-page">
  <span class="fc-blob fc-blob-a" aria-hidden="true"></span>
  <span class="fc-blob fc-blob-b" aria-hidden="true"></span>
  <span class="fc-blob fc-blob-c" aria-hidden="true"></span>
  <span class="fc-dotfield" aria-hidden="true"></span>

  <div class="fc-wrap">

    <div class="fc-top">
      <div>
        <span class="fc-eyebrow"><i class="fas fa-search"></i> School FactCheck</span>
        <h1>Klarifikasi Informasi &amp; Hoaks</h1>
        <p>Cek kebenaran informasi yang beredar seputar PPDB, jadwal kegiatan, pengumuman, dan kebijakan SMK Negeri 2 Mojokerto sebelum kamu percaya atau menyebarkannya.</p>
      </div>
      <span class="fc-shield"><i class="fas fa-certificate"></i> Diverifikasi Sumber Resmi</span>
    </div>

    <div class="fc-stats" id="fcStats">
      <div class="fc-stat total"><span class="fc-stat-icon"><i class="fas fa-layer-group"></i></span><div><b id="fcStatTotal">0</b><span>Total Klarifikasi</span></div></div>
      <div class="fc-stat verified"><span class="fc-stat-icon"><i class="fas fa-check-circle"></i></span><div><b id="fcStatVerified">0</b><span>Terverifikasi</span></div></div>
      <div class="fc-stat false"><span class="fc-stat-icon"><i class="fas fa-times-circle"></i></span><div><b id="fcStatFalse">0</b><span>Tidak Benar</span></div></div>
      <div class="fc-stat pending"><span class="fc-stat-icon"><i class="fas fa-question-circle"></i></span><div><b id="fcStatPending">0</b><span>Belum Terkonfirmasi</span></div></div>
    </div>

    <div class="fc-layout">

      <aside class="fc-side">
        <div class="fc-side-card">
          <h3><i class="fas fa-filter"></i> Cari &amp; Saring</h3>
          <div class="fc-search">
            <i class="fas fa-search"></i>
            <input type="text" id="fcSearchInput" placeholder="Cari kata kunci, mis. PPDB, MPLS...">
          </div>
        </div>

        <div class="fc-side-card">
          <h3><i class="fas fa-list-ul"></i> Kategori</h3>
          <ul class="fc-cat-list" id="fcCatList">
            <li><button class="fc-cat-btn active" type="button" data-cat="semua"><span><i class="fas fa-th"></i> Semua Kategori</span><span class="fc-cat-count" data-count-cat="semua">0</span></button></li>
            <li><button class="fc-cat-btn" type="button" data-cat="PPDB"><span><i class="fas fa-graduation-cap"></i> PPDB</span><span class="fc-cat-count" data-count-cat="PPDB">0</span></button></li>
            <li><button class="fc-cat-btn" type="button" data-cat="Jadwal"><span><i class="fas fa-calendar-alt"></i> Jadwal Kegiatan</span><span class="fc-cat-count" data-count-cat="Jadwal">0</span></button></li>
            <li><button class="fc-cat-btn" type="button" data-cat="Pengumuman"><span><i class="fas fa-bullhorn"></i> Pengumuman</span><span class="fc-cat-count" data-count-cat="Pengumuman">0</span></button></li>
            <li><button class="fc-cat-btn" type="button" data-cat="Kebijakan"><span><i class="fas fa-balance-scale"></i> Kebijakan Sekolah</span><span class="fc-cat-count" data-count-cat="Kebijakan">0</span></button></li>
          </ul>
        </div>

        <div class="fc-side-card">
          <h3><i class="fas fa-info-circle"></i> Arti Status</h3>
          <ul class="fc-legend">
            <li><span class="fc-legend-dot verified"><i class="fas fa-check"></i></span><span><b>Terverifikasi</b>Informasi sudah dikonfirmasi kebenarannya oleh pihak sekolah.</span></li>
            <li><span class="fc-legend-dot false"><i class="fas fa-times"></i></span><span><b>Tidak Benar</b>Informasi terbukti keliru atau menyesatkan.</span></li>
            <li><span class="fc-legend-dot pending"><i class="fas fa-question"></i></span><span><b>Belum Terkonfirmasi</b>Masih dalam proses pengecekan pihak sekolah.</span></li>
          </ul>
        </div>

        <div class="fc-side-note">
          <h3><i class="fas fa-exclamation-triangle"></i> Menemukan Info Meragukan?</h3>
          <p>Laporkan informasi yang belum ada klarifikasinya di sini agar segera kami tindak lanjuti dan verifikasi kebenarannya.</p>
          <a href="{{ route('kontak') }}">Laporkan Sekarang <i class="fas fa-arrow-right"></i></a>
        </div>
      </aside>

      <div class="fc-main">

        <div class="fc-toolbar">
          <div class="fc-status-pills" id="fcStatusPills">
            <button class="fc-pill active" type="button" data-status="semua"><i class="fas fa-th"></i> Semua Status</button>
            <button class="fc-pill" type="button" data-status="Terverifikasi"><i class="fas fa-check-circle"></i> Terverifikasi</button>
            <button class="fc-pill" type="button" data-status="Tidak Benar"><i class="fas fa-times-circle"></i> Tidak Benar</button>
            <button class="fc-pill" type="button" data-status="Belum Terkonfirmasi"><i class="fas fa-question-circle"></i> Belum Terkonfirmasi</button>
          </div>
          <span class="fc-result-count"><b id="fcResultNum">0</b> klarifikasi ditemukan</span>
        </div>

        <div class="fc-grid" id="fcGrid"></div>

        <div class="fc-empty" id="fcEmpty">
          <i class="fas fa-folder-open"></i>
          <p>Tidak ada klarifikasi yang cocok dengan pencarianmu.</p>
          <span>Coba kata kunci lain atau ubah filter kategori/status.</span>
        </div>

        <div class="fc-cta">
          <div class="fc-cta-text">
            <h3>Belum menemukan klarifikasi yang kamu cari?</h3>
            <p>Sampaikan isu atau kabar yang beredar dan tim sekolah akan segera menelusuri kebenarannya.</p>
          </div>
          <a href="{{ route('kontak') }}" class="fc-cta-btn"><i class="fas fa-paper-plane"></i> Ajukan Klarifikasi</a>
        </div>

      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
  /* ---------------- data klarifikasi ----------------
     Frontend-only: mudah diganti menjadi hasil fetch API
     saat backend/CMS sudah tersedia. */
  var FACTS = [
    {
      status: 'Tidak Benar',
      kategori: 'PPDB',
      klaim: 'PPDB SMK Negeri 2 Mojokerto tahun ajaran baru dibuka mulai Januari.',
      penjelasan: 'Jadwal resmi PPDB ditentukan oleh Dinas Pendidikan Provinsi Jawa Timur dan biasanya diumumkan pertengahan tahun, bukan Januari. Calon peserta didik diimbau hanya merujuk pada jadwal resmi PPDB Jatim dan pengumuman sekolah, bukan pesan berantai.',
      sumber: 'ppdbjatim.net',
      sumberUrl: 'https://ppdbjatim.net',
      tanggal: '2026-08-15'
    },
    {
      status: 'Terverifikasi',
      kategori: 'Jadwal',
      klaim: 'Kegiatan MPLS (Masa Pengenalan Lingkungan Sekolah) tahun ajaran baru dilaksanakan tanggal 14–16 Juli.',
      penjelasan: 'Jadwal ini sesuai dengan Surat Edaran resmi Kepala Sekolah tentang kalender pendidikan tahun ajaran berjalan yang telah dibagikan ke wali kelas dan orang tua/wali peserta didik baru.',
      sumber: 'Surat Edaran Kepala Sekolah No. 421/1032',
      sumberUrl: '',
      tanggal: '2026-07-01'
    },
    {
      status: 'Belum Terkonfirmasi',
      kategori: 'Kebijakan',
      klaim: 'Sekolah akan menerapkan sistem full day school mulai semester depan.',
      penjelasan: 'Wacana ini masih dalam tahap kajian internal dan belum ada Surat Keputusan resmi yang diterbitkan. Informasi akan diperbarui begitu ada keputusan final dari pihak sekolah.',
      sumber: '',
      sumberUrl: '',
      tanggal: '2026-08-10'
    },
    {
      status: 'Tidak Benar',
      kategori: 'Pengumuman',
      klaim: 'Ujian Praktik Kejuruan ditiadakan pada tahun ajaran ini.',
      penjelasan: 'Ujian Praktik Kejuruan tetap dilaksanakan sesuai kalender akademik dan menjadi salah satu syarat kelulusan sesuai ketentuan kurikulum. Jadwal lengkap dapat dilihat pada pengumuman resmi sekolah.',
      sumber: 'Pengumuman Akademik Sekolah',
      sumberUrl: '',
      tanggal: '2026-08-05'
    },
    {
      status: 'Tidak Benar',
      kategori: 'Kebijakan',
      klaim: 'Seragam pramuka wajib dibeli di koperasi sekolah dengan harga yang ditentukan sekolah.',
      penjelasan: 'Peserta didik diperbolehkan membeli perlengkapan pramuka di tempat mana pun selama memenuhi standar atribut yang berlaku. Sekolah tidak mewajibkan pembelian di koperasi tertentu.',
      sumber: 'Klarifikasi Kesiswaan',
      sumberUrl: '',
      tanggal: '2026-07-20'
    },
    {
      status: 'Terverifikasi',
      kategori: 'Jadwal',
      klaim: 'Libur semester ganjil dimulai tanggal 20 Desember.',
      penjelasan: 'Sesuai kalender pendidikan resmi yang diterbitkan Dinas Pendidikan Provinsi Jawa Timur dan telah disesuaikan dengan kalender akademik sekolah.',
      sumber: 'Kalender Pendidikan Jatim 2026/2027',
      sumberUrl: '',
      tanggal: '2026-08-01'
    },
    {
      status: 'Terverifikasi',
      kategori: 'PPDB',
      klaim: 'SMK Negeri 2 Mojokerto membuka jalur afirmasi khusus bagi calon peserta didik penyandang disabilitas.',
      penjelasan: 'Jalur afirmasi ini merupakan bagian dari kebijakan PPDB inklusif yang berlaku sesuai petunjuk teknis PPDB Jatim dan telah diterapkan sekolah pada penerimaan tahun ajaran berjalan.',
      sumber: 'Juknis PPDB Jatim',
      sumberUrl: 'https://ppdbjatim.net',
      tanggal: '2026-06-18'
    },
    {
      status: 'Tidak Benar',
      kategori: 'Pengumuman',
      klaim: 'Setiap peserta didik dikenakan sumbangan wajib Rp500.000 untuk kegiatan MPLS.',
      penjelasan: 'Sekolah tidak memungut biaya wajib untuk kegiatan MPLS. Jika ada pihak yang meminta sejumlah uang dengan mengatasnamakan sekolah, peserta didik dan orang tua diimbau segera melapor ke pihak sekolah.',
      sumber: 'Klarifikasi Humas Sekolah',
      sumberUrl: '',
      tanggal: '2026-07-10'
    },
    {
      status: 'Belum Terkonfirmasi',
      kategori: 'Pengumuman',
      klaim: 'Pembagian rapor semester ini ditunda dari jadwal semula.',
      penjelasan: 'Isu ini masih ditelusuri kebenarannya. Jadwal resmi pembagian rapor akan diinformasikan melalui wali kelas dan kanal resmi sekolah begitu dikonfirmasi.',
      sumber: '',
      sumberUrl: '',
      tanggal: '2026-08-18'
    },
    {
      status: 'Terverifikasi',
      kategori: 'PPDB',
      klaim: 'SMK Negeri 2 Mojokerto menambah kuota jurusan Rekayasa Perangkat Lunak (RPL) pada PPDB tahun ajaran baru.',
      penjelasan: 'Penambahan kuota ini telah disetujui dan tercantum dalam daftar rombongan belajar resmi yang diumumkan pada laman PPDB Jatim menjelang pembukaan pendaftaran.',
      sumber: 'ppdbjatim.net',
      sumberUrl: 'https://ppdbjatim.net',
      tanggal: '2026-05-22'
    }
  ];

  var STATUS_CLASS = {
    'Terverifikasi': 'status-verified',
    'Tidak Benar': 'status-false',
    'Belum Terkonfirmasi': 'status-pending'
  };
  var STATUS_ICON = {
    'Terverifikasi': 'fa-check-circle',
    'Tidak Benar': 'fa-times-circle',
    'Belum Terkonfirmasi': 'fa-question-circle'
  };

  var state = { search: '', kategori: 'semua', status: 'semua' };

  var grid = document.getElementById('fcGrid');
  var empty = document.getElementById('fcEmpty');
  var resultNum = document.getElementById('fcResultNum');

  function formatDate(iso) {
    var d = new Date(iso);
    return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
  }

  function escapeHtml(str) {
    return String(str).replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
  }

  function cardHtml(item, idx) {
    var cls = STATUS_CLASS[item.status];
    var icon = STATUS_ICON[item.status];
    var sourceHtml = item.sumber
      ? (item.sumberUrl
          ? '<a class="fc-source" href="' + item.sumberUrl + '" target="_blank" rel="noopener"><i class="fas fa-link"></i>' + escapeHtml(item.sumber) + '</a>'
          : '<span class="fc-source is-empty"><i class="fas fa-university"></i>' + escapeHtml(item.sumber) + '</span>')
      : '<span class="fc-source is-empty"><i class="fas fa-hourglass-half"></i>Sumber menyusul</span>';

    return (
      '<article class="fc-card ' + cls + '" data-idx="' + idx + '">' +
        '<div class="fc-card-head">' +
          '<span class="fc-badge ' + cls + '"><i class="fas ' + icon + '"></i>' + item.status + '</span>' +
          '<span class="fc-cat-tag">' + item.kategori + '</span>' +
        '</div>' +
        '<p class="fc-claim"><i class="fas fa-quote-left"></i><span>' + escapeHtml(item.klaim) + '</span></p>' +
        '<p class="fc-explain">' + escapeHtml(item.penjelasan) + '</p>' +
        '<button class="fc-more" type="button" data-toggle-explain>' +
          '<span class="fc-more-label">Baca Selengkapnya</span><i class="fas fa-chevron-down"></i>' +
        '</button>' +
        '<div class="fc-card-foot">' +
          sourceHtml +
          '<span class="fc-date"><i class="fas fa-calendar"></i>' + formatDate(item.tanggal) + '</span>' +
        '</div>' +
      '</article>'
    );
  }

  function updateCounts(list) {
    var total = FACTS.length;
    var vCount = 0, fCount = 0, pCount = 0;
    var catCounts = { semua: total, PPDB: 0, Jadwal: 0, Pengumuman: 0, Kebijakan: 0 };
    FACTS.forEach(function (item) {
      if (item.status === 'Terverifikasi') vCount++;
      else if (item.status === 'Tidak Benar') fCount++;
      else pCount++;
      if (catCounts.hasOwnProperty(item.kategori)) catCounts[item.kategori]++;
    });
    document.getElementById('fcStatTotal').textContent = total;
    document.getElementById('fcStatVerified').textContent = vCount;
    document.getElementById('fcStatFalse').textContent = fCount;
    document.getElementById('fcStatPending').textContent = pCount;
    Object.keys(catCounts).forEach(function (key) {
      var el = document.querySelector('[data-count-cat="' + key + '"]');
      if (el) el.textContent = catCounts[key];
    });
    resultNum.textContent = list.length;
  }

  function render() {
    var q = state.search.trim().toLowerCase();
    var filtered = FACTS.filter(function (item) {
      var matchCat = state.kategori === 'semua' || item.kategori === state.kategori;
      var matchStatus = state.status === 'semua' || item.status === state.status;
      var matchSearch = !q ||
        item.klaim.toLowerCase().indexOf(q) !== -1 ||
        item.penjelasan.toLowerCase().indexOf(q) !== -1 ||
        item.kategori.toLowerCase().indexOf(q) !== -1;
      return matchCat && matchStatus && matchSearch;
    });

    grid.innerHTML = filtered.map(function (item) {
      var realIdx = FACTS.indexOf(item);
      return cardHtml(item, realIdx);
    }).join('');

    empty.classList.toggle('is-shown', filtered.length === 0);
    grid.style.display = filtered.length === 0 ? 'none' : '';
    updateCounts(filtered);
    bindCardEvents();
  }

  function bindCardEvents() {
    grid.querySelectorAll('[data-toggle-explain]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var card = btn.closest('.fc-card');
        var isOpen = card.classList.toggle('open');
        btn.querySelector('.fc-more-label').textContent = isOpen ? 'Tutup' : 'Baca Selengkapnya';
      });
    });
  }

  /* ---- events: search, kategori, status ---- */
  document.getElementById('fcSearchInput').addEventListener('input', function (e) {
    state.search = e.target.value;
    render();
  });

  document.querySelectorAll('#fcCatList .fc-cat-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('#fcCatList .fc-cat-btn').forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');
      state.kategori = btn.getAttribute('data-cat');
      render();
    });
  });

  document.querySelectorAll('#fcStatusPills .fc-pill').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('#fcStatusPills .fc-pill').forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');
      state.status = btn.getAttribute('data-status');
      render();
    });
  });

  render();
})();
</script>
@endpush