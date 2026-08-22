{{--
  resources/views/profil/tour-virtual.blade.php

  VIRTUAL TOUR 360° — SMK NEGERI 2 MOJOKERTO (FULLSCREEN, MOMENTO360)
  ============================================================
  Versi ini pakai embed iframe MOMENTO360 (bukan Pannellum lagi),
  jadi kamu TIDAK perlu upload file foto equirectangular sendiri —
  cukup upload panorama ke akun Momento360 kamu, lalu tempel link
  embed-nya di daftar $vtScenes (JS) di bawah.

  CARA ISI FOTO:
  1) Upload foto 360° ke momento360.com → buka foto itu → tombol
     "Share" → "Embed" → copy src dari <iframe> yang muncul.
  2) Tempel URL itu ke field `embed` pada scene yang sesuai di
     variabel vtScenes (cari komentar "GANTI DI SINI").
  3) Kalau field `embed` masih kosong ('' ), halaman otomatis
     menampilkan kondisi "Foto 360° belum tersedia" — jadi aman
     dipublish walau belum semua lokasi difoto.
  4) Query string di URL Momento360 (heading, pitch, field-of-view,
     size, display-plan) boleh kamu ubah manual per lokasi kalau mau
     sudut pandang awal beda-beda.

  CATATAN PENTING vs versi Pannellum sebelumnya:
  - Hotspot "klik buat loncat ke ruangan lain" DI DALAM foto sudah
    tidak ada (itu fitur khusus Pannellum, gak bisa disuntik ke iframe
    Momento360 yang beda origin). Pindah lokasi sekarang sepenuhnya
    lewat panel "Navigasi" di kiri atas.
  - Kompas custom juga dilepas karena kita tidak bisa membaca arah
    pandang dari dalam iframe pihak ketiga.
  - Kontrol drag-to-pan & zoom sepenuhnya bawaan viewer Momento360.

  Route tetap sama, contoh di routes/web.php:
  Route::get('/profil/tour-virtual', fn () => view('profil.tour-virtual'))->name('profil.tour-virtual');
  ============================================================
--}}
@extends('layouts.app')

@section('title', 'Virtual Tour 360° — SMK Negeri 2 Mojokerto')
@section('description', 'Jelajahi lingkungan SMK Negeri 2 Mojokerto secara virtual 360° — gerbang, lapangan, ruang program keahlian, hingga fasilitas penunjang, langsung dari layar Anda.')

@push('styles')
<style>
/* =========================================================
   VIRTUAL TOUR 360° — FULLSCREEN VIEWER (MOMENTO360)
   Palet & tipografi mewarisi layouts.app (navy #0d3a66, gold
   #f9a825, Archivo Black + Plus Jakarta Sans). Prefix kelas: vt360-
   ========================================================= */
html, body{overflow:hidden} /* halaman ini sendiri yang jadi "layar", bukan discroll */

.vt360-fullpage{position:fixed;inset:0;z-index:99999;background:#0a2038;overflow:hidden}
/* jaga-jaga kalau layouts.app punya navbar/header fixed dengan z-index tinggi
   (mis. "Settings" & logo/nama sekolah di navbar) — paksa sembunyi selama di
   halaman tour ini. Kalau markup header kamu pakai selector lain, sesuaikan
   daftar di bawah ini. */
body:has(.vt360-fullpage) > header,
body:has(.vt360-fullpage) > nav,
body:has(.vt360-fullpage) .navbar,
body:has(.vt360-fullpage) .site-header,
body:has(.vt360-fullpage) .main-header,
body:has(.vt360-fullpage) .app-header{display:none !important}
.vt360-fullpage *{box-sizing:border-box}

/* wadah iframe momento360 */
.vt360-embed-wrap{position:absolute;inset:0;width:100%;height:100%;background:#0a2038}
.vt360-embed-wrap iframe{position:absolute;inset:0;width:100%;height:100%;border:0;display:block}

/* ---------- kartu info lokasi ---------- */
.vt360-info-card{position:absolute;right:1.2rem;bottom:1.2rem;z-index:20;max-width:280px;
  background:rgba(255,255,255,.96);backdrop-filter:blur(10px);border:1px solid rgba(13,58,102,.12);
  box-shadow:0 16px 40px rgba(13,58,102,.18);border-radius:18px;padding:1rem 1.2rem;pointer-events:none}
.vt360-info-eyebrow{display:block;font-size:.62rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;
  color:#f9a825;margin-bottom:.3rem}
.vt360-info-card h3{font-family:var(--font-display);font-size:1.1rem;font-weight:900;color:#0d3a66;margin:0 0 .3rem;
  text-transform:uppercase;line-height:1.1}
.vt360-info-card p{font-size:.78rem;line-height:1.6;color:#5a6f88;margin:0}

/* ---------- PANEL NAVIGASI (overlay, bisa ditutup) — tema LIGHT ---------- */
.vt360-navtoggle{position:absolute;top:1.2rem;left:1.2rem;z-index:19;display:inline-flex;align-items:center;gap:.55rem;
  background:rgba(255,255,255,.95);backdrop-filter:blur(8px);border:1px solid rgba(13,58,102,.14);color:#0d3a66;
  font-family:var(--font-body);font-size:.8rem;font-weight:800;padding:.7rem 1.1rem;border-radius:999px;
  box-shadow:0 10px 24px rgba(13,58,102,.15);
  cursor:pointer;opacity:0;pointer-events:none;transform:translateY(-8px);transition:all .25s var(--ease)}
.vt360-navtoggle i{color:#f9a825}
.vt360-navtoggle.show{opacity:1;pointer-events:auto;transform:translateY(0)}

.vt360-navpanel{position:absolute;top:1.2rem;left:1.2rem;z-index:21;width:min(300px,80vw);
  max-height:calc(100% - 2.4rem);background:rgba(255,255,255,.97);backdrop-filter:blur(16px);
  border:1px solid rgba(13,58,102,.12);border-radius:20px;overflow:hidden;display:flex;flex-direction:column;
  box-shadow:0 24px 60px rgba(13,58,102,.22);transition:transform .3s var(--ease),opacity .3s var(--ease)}
.vt360-navpanel.closed{transform:translateX(calc(-100% - 1.2rem));opacity:0;pointer-events:none}
.vt360-navpanel-head{display:flex;align-items:center;justify-content:space-between;padding:1.1rem 1.2rem;
  border-bottom:1px solid rgba(13,58,102,.08);flex-shrink:0}
.vt360-navpanel-head span{font-size:.7rem;font-weight:800;letter-spacing:.16em;text-transform:uppercase;color:#0d3a66}
.vt360-navpanel-close{width:30px;height:30px;border-radius:50%;background:#f9a825;color:#0d3a66;border:0;
  display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:.85rem;flex-shrink:0;
  transition:transform .2s var(--ease)}
.vt360-navpanel-close:hover{transform:rotate(90deg)}

.vt360-cat-tabs{display:flex;gap:.4rem;flex-wrap:wrap;padding:.9rem 1rem 0}
.vt360-cat-btn{font-family:var(--font-body);font-size:.7rem;font-weight:800;color:#5a6f88;
  background:#f2f6fb;border:1px solid rgba(13,58,102,.1);padding:.4rem .7rem;border-radius:999px;
  cursor:pointer;transition:all .25s var(--ease)}
.vt360-cat-btn:hover{color:#0d3a66;border-color:rgba(249,168,37,.5)}
.vt360-cat-btn.active{background:linear-gradient(135deg,#ffd54a,#f9a825);border-color:transparent;color:#0d3a66}

.vt360-navlist{overflow-y:auto;padding:.7rem;display:flex;flex-direction:column;gap:.3rem;scrollbar-width:thin}
.vt360-navlist::-webkit-scrollbar{width:6px}
.vt360-navlist::-webkit-scrollbar-thumb{background:rgba(13,58,102,.15);border-radius:99px}
.vt360-navitem{display:flex;align-items:center;gap:.7rem;width:100%;text-align:left;background:transparent;
  border:0;color:#0d3a66;font-family:var(--font-body);font-size:.86rem;font-weight:700;
  padding:.75rem .85rem;border-radius:12px;cursor:pointer;transition:background .2s var(--ease)}
.vt360-navitem i{width:18px;text-align:center;color:#f9a825;font-size:.85rem;flex-shrink:0}
.vt360-navitem:hover{background:rgba(13,58,102,.06)}
.vt360-navitem.active{background:linear-gradient(135deg,#ffd54a,#f9a825);color:#0d3a66}
.vt360-navitem.active i{color:#0d3a66}

/* ---------- tombol keluar (silang, kanan atas) ---------- */
.vt360-exit-btn{position:absolute;top:1.2rem;right:1.2rem;z-index:25;width:42px;height:42px;border-radius:50%;
  background:rgba(255,255,255,.95);backdrop-filter:blur(8px);border:1px solid rgba(13,58,102,.14);color:#0d3a66;
  display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:1rem;text-decoration:none;
  box-shadow:0 10px 24px rgba(13,58,102,.15);
  transition:background .25s var(--ease),color .25s var(--ease),transform .25s var(--ease)}
.vt360-exit-btn:hover{background:#f9a825;color:#0d3a66;transform:rotate(90deg)}


/* ---------- kondisi kosong (foto belum tersedia) ---------- */
.vt360-empty{position:absolute;inset:0;z-index:15;display:none;flex-direction:column;align-items:center;
  justify-content:center;gap:.9rem;text-align:center;padding:2rem;
  background:linear-gradient(150deg,#0a2038,#13518c)}
.vt360-empty.show{display:flex}
.vt360-empty i{font-size:2.2rem;color:#ffd54a}
.vt360-empty h4{font-family:var(--font-display);color:#fff;font-size:1.15rem;text-transform:uppercase;margin:0}
.vt360-empty p{font-size:.82rem;color:rgba(235,245,253,.75);max-width:340px;margin:0;line-height:1.7}

/* ---------- loading state saat iframe ganti scene ---------- */
.vt360-loading{position:absolute;inset:0;z-index:12;display:none;align-items:center;justify-content:center;
  background:#0a2038}
.vt360-loading.show{display:flex}
.vt360-loading i{font-size:1.6rem;color:#ffd54a;animation:vtSpin .5s linear infinite}
@keyframes vtSpin{to{transform:rotate(360deg)}}

/* ---------- responsive ---------- */
@media(max-width:700px){
  .vt360-info-card{max-width:calc(100% - 2.4rem);left:1.2rem;right:1.2rem;bottom:1.2rem}
  .vt360-navpanel{width:min(280px,84vw)}
}
</style>
@endpush

@section('content')
<div class="vt360-fullpage">
  <div class="vt360-embed-wrap" id="vtEmbedWrap"></div>

  <div class="vt360-loading" id="vtLoading"><i class="fas fa-circle-notch"></i></div>

  {{-- ================= PANEL NAVIGASI (overlay, kiri atas) ================= --}}
  <div class="vt360-navpanel" id="vtNavPanel">
    <div class="vt360-navpanel-head">
      <span>Navigasi</span>
      <button class="vt360-navpanel-close" id="vtNavClose" aria-label="Tutup navigasi"><i class="fas fa-xmark"></i></button>
    </div>
    <div class="vt360-cat-tabs" id="vtCatTabs">
      <button class="vt360-cat-btn active" data-cat="all">Semua</button>
      <button class="vt360-cat-btn" data-cat="area">Area Sekolah</button>
      <button class="vt360-cat-btn" data-cat="kelas">Program Keahlian</button>
      <button class="vt360-cat-btn" data-cat="fasilitas">Fasilitas</button>
    </div>
    <div class="vt360-navlist" id="vtNavList"></div>
  </div>

  {{-- chip kecil buat buka lagi panel navigasi kalau ditutup --}}
  <button class="vt360-navtoggle" id="vtNavToggle"><i class="fas fa-bars"></i> Navigasi</button>

  <a class="vt360-exit-btn" href="{{ Route::has('home') ? route('home') : url('/') }}" aria-label="Kembali ke Beranda">
    <i class="fas fa-xmark"></i>
  </a>

  <div class="vt360-info-card">
    <span class="vt360-info-eyebrow">Sedang Menjelajah</span>
    <h3 id="vtInfoTitle">—</h3>
    <p id="vtInfoDesc">Memuat lokasi…</p>
  </div>

  <div class="vt360-empty" id="vtEmpty">
    <i class="fas fa-camera-retro"></i>
    <h4 id="vtEmptyTitle">Foto 360° Belum Tersedia</h4>
    <p>Lokasi ini akan segera diperbarui dengan foto panorama asli. Sementara itu, silakan jelajahi lokasi lain yang sudah tersedia.</p>
  </div>
</div>
@endsection

@push('scripts')
<script>
(function(){
  /* ============================================================
     DATA LOKASI — sesuaikan/tambah bebas.
     category: 'area' | 'kelas' | 'fasilitas'
     embed   : URL src dari iframe embed Momento360 (Share → Embed).
               Kosongkan ('') kalau foto lokasi itu belum ada —
               halaman otomatis munculin kondisi "belum tersedia".
     ============================================================ */
  var vtScenes = {
    'gerbang-utama': {
      title: 'Gerbang Utama', category: 'area', icon: 'fa-archway',
      desc: 'Titik masuk utama SMK Negeri 2 Mojokerto, gerbang pertama yang menyambut siswa dan tamu setiap hari.',
      embed: 'https://momento360.com/e/u/17f7a2150e244ef9a26902f9dadede7a?utm_campaign=embed&utm_source=other&utm_medium=embed&heading=-83.63&pitch=14.36&field-of-view=98.25&size=medium&display-plan=true'
    },
    'lapangan-upacara': {
      title: 'Lapangan Upacara', category: 'area', icon: 'fa-flag',
      desc: 'Ruang terbuka untuk upacara bendera, olahraga, dan berbagai kegiatan siswa.',
      embed: '' // GANTI DI SINI
    },
    'lobi-sekolah': {
      title: 'Lobi & Ruang Tunggu', category: 'area', icon: 'fa-door-open',
      desc: 'Area penerima tamu sekolah, penghubung menuju gedung kelas dan ruang program keahlian.',
      embed: '' // GANTI DI SINI
    },
    'koridor-rpl': {
      title: 'Koridor Kelas RPL', category: 'kelas', icon: 'fa-code',
      desc: 'Akses menuju ruang teori dan laboratorium Rekayasa Perangkat Lunak.',
      embed: '' // GANTI DI SINI
    },
    'studio-dkv': {
      title: 'Studio Desain DKV', category: 'kelas', icon: 'fa-palette',
      desc: 'Ruang praktik siswa Desain Komunikasi Visual, dilengkapi perangkat desain digital.',
      embed: '' // GANTI DI SINI
    },
    'dapur-kuliner': {
      title: 'Dapur Praktik Kuliner', category: 'kelas', icon: 'fa-utensils',
      desc: 'Dapur produksi tempat siswa Kuliner mengasah keterampilan memasak dan tata boga.',
      embed: '' // GANTI DI SINI
    },
    'bank-mini-lps': {
      title: 'Bank Mini LPS', category: 'kelas', icon: 'fa-building-columns',
      desc: 'Ruang simulasi perbankan syariah untuk praktik layanan nasabah siswa LPS.',
      embed: '' // GANTI DI SINI
    },
    'griya-aphp': {
      title: 'Griya Produksi APHP', category: 'kelas', icon: 'fa-wheat-awn',
      desc: 'Fasilitas pengolahan hasil pertanian tempat siswa APHP mempraktikkan produksi pangan.',
      embed: '' // GANTI DI SINI
    },
    'perpustakaan': {
      title: 'Perpustakaan', category: 'fasilitas', icon: 'fa-book',
      desc: 'Ruang baca dan koleksi referensi untuk mendukung kegiatan belajar siswa.',
      embed: '' // GANTI DI SINI
    },
    'aula-serbaguna': {
      title: 'Aula Serbaguna', category: 'fasilitas', icon: 'fa-people-roof',
      desc: 'Ruang besar untuk acara sekolah, seminar, dan pertemuan wali murid.',
      embed: '' // GANTI DI SINI
    }
  };

  var HOME_SCENE = 'gerbang-utama';

  /* ---------- render daftar navigasi ---------- */
  var navListEl = document.getElementById('vtNavList');
  var curCat = 'all';

  function renderNavList(){
    navListEl.innerHTML = '';
    Object.keys(vtScenes).forEach(function(id){
      var s = vtScenes[id];
      if (curCat !== 'all' && s.category !== curCat) return;
      var item = document.createElement('button');
      item.className = 'vt360-navitem' + (id === curScene ? ' active' : '');
      item.innerHTML = '<i class="fas ' + s.icon + '"></i>' + s.title;
      item.addEventListener('click', function(){ goToScene(id); });
      navListEl.appendChild(item);
    });
  }

  document.getElementById('vtCatTabs').addEventListener('click', function(e){
    var btn = e.target.closest('.vt360-cat-btn');
    if (!btn) return;
    document.querySelectorAll('.vt360-cat-btn').forEach(function(b){ b.classList.remove('active'); });
    btn.classList.add('active');
    curCat = btn.dataset.cat;
    renderNavList();
  });

  /* ---------- buka / tutup panel navigasi ---------- */
  var navPanelEl = document.getElementById('vtNavPanel');
  var navToggleEl = document.getElementById('vtNavToggle');

  document.getElementById('vtNavClose').addEventListener('click', function(){
    navPanelEl.classList.add('closed');
    navToggleEl.classList.add('show');
  });
  navToggleEl.addEventListener('click', function(){
    navPanelEl.classList.remove('closed');
    navToggleEl.classList.remove('show');
  });

  /* ---------- kontrol scene aktif ---------- */
  var curScene = null;
  var embedWrapEl = document.getElementById('vtEmbedWrap');
  var loadingEl = document.getElementById('vtLoading');
  var infoTitleEl = document.getElementById('vtInfoTitle');
  var infoDescEl = document.getElementById('vtInfoDesc');
  var emptyEl = document.getElementById('vtEmpty');
  var emptyTitleEl = document.getElementById('vtEmptyTitle');

  function updateInfoCard(id){
    var s = vtScenes[id];
    infoTitleEl.textContent = s.title;
    infoDescEl.textContent = s.desc;
  }

  function showEmptyState(id){
    emptyTitleEl.textContent = 'Foto 360° "' + (vtScenes[id] ? vtScenes[id].title : '') + '" Belum Tersedia';
    emptyEl.classList.add('show');
    embedWrapEl.innerHTML = '';
  }

  function goToScene(id){
    if (!vtScenes[id]) return;
    curScene = id;
    updateInfoCard(id);
    renderNavList();

    var s = vtScenes[id];
    if (!s.embed) { showEmptyState(id); return; }

    emptyEl.classList.remove('show');
    loadingEl.classList.add('show');
    embedWrapEl.innerHTML = '';

    var iframe = document.createElement('iframe');
    iframe.src = s.embed;
    iframe.setAttribute('allowfullscreen', 'true');
    iframe.setAttribute('frameborder', '0');
    iframe.setAttribute('marginheight', '0');
    iframe.setAttribute('marginwidth', '0');
    iframe.addEventListener('load', function(){ loadingEl.classList.remove('show'); });
    embedWrapEl.appendChild(iframe);
  }

  /* ---------- init ---------- */
  renderNavList();
  goToScene(HOME_SCENE);
})();
</script>
@endpush