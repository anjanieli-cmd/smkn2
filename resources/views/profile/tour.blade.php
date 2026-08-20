{{--
  resources/views/profil/tour-virtual.blade.php

  VIRTUAL TOUR 360° — SMK NEGERI 2 MOJOKERTO (FULLSCREEN)
  ============================================================
  Versi ini TIDAK ADA hero / peta ringkas / cara-menjelajah / CTA.
  Begitu halaman dibuka, langsung tampil viewer 360° FULL LAYAR —
  seperti referensi (sidebar navigasi kiri atas + hotspot 360°).

  - Panel "NAVIGASI" adalah overlay yang bisa ditutup (✕) dan
    dibuka lagi lewat tombol chip di kiri atas.
  - Tombol "Beranda" di kanan bawah membawa balik ke gerbang utama.
  - Viewer meng-overlay SELURUH viewport (position: fixed; inset:0)
    supaya benar-benar penuh layar dari detik pertama, terlepas dari
    header/footer bawaan layouts.app.

  ENGINE: Pannellum (open-source, MIT) via CDN — foto equirectangular
  asli (rasio 2:1) dengan drag-to-pan & hotspot pindah ruangan.

  ⚠️ PENTING — SEBELUM DIPAKAI:
  1) Siapkan foto 360° equirectangular (rasio 2:1, disarankan
     min. 4096×2048px) untuk tiap lokasi di daftar $vtScenes (JS).
  2) Taruh filenya di: public/images/vtour/nama-file.jpg
     (nama file mengikuti key scene, contoh: gerbang-utama.jpg)
  3) Kalau foto belum ada, halaman tetap jalan — muncul kondisi
     kosong ramah-pengguna ("Foto 360° belum tersedia").
  4) Koordinat hotspot (yaw/pitch) masih PERKIRAAN — sesuaikan lewat
     Pannellum config tool: https://pannellum.org/documentation/overview/config-tool/
  5) Tambahkan route GET '/profil/tour-virtual' di routes/web.php:
     Route::get('/profil/tour-virtual', fn () => view('profil.tour-virtual'))->name('profil.tour-virtual');
  ============================================================
--}}
@extends('layouts.app')

@section('title', 'Virtual Tour 360° — SMK Negeri 2 Mojokerto')
@section('description', 'Jelajahi lingkungan SMK Negeri 2 Mojokerto secara virtual 360° — gerbang, lapangan, ruang program keahlian, hingga fasilitas penunjang, langsung dari layar Anda.')

@push('styles')
<style>
/* =========================================================
   VIRTUAL TOUR 360° — FULLSCREEN VIEWER
   Palet & tipografi mewarisi layouts.app (navy #0d3a66, gold
   #f9a825, Archivo Black + Plus Jakarta Sans). Prefix kelas: vt360-
   ========================================================= */
html, body{overflow:hidden} /* halaman ini sendiri yang jadi "layar", bukan discroll */

.vt360-fullpage{position:fixed;inset:0;z-index:1000;background:#0a2038;overflow:hidden}
.vt360-fullpage *{box-sizing:border-box}
.vt360-pano{position:absolute;inset:0;width:100%;height:100%}

/* skin ulang total kontrol default Pannellum biar senada brand */
.vt360-fullpage .pnlm-container{background:#0a2038}
.vt360-fullpage .pnlm-load-box{background:transparent}
.vt360-fullpage .pnlm-loading{border-color:#f9a825 transparent #ffd54a transparent}
.vt360-fullpage .pnlm-load-box p{font-family:var(--font-body);color:#fff;font-weight:700}
.vt360-fullpage .pnlm-controls-container{right:.9rem;bottom:1.2rem}
.vt360-fullpage .pnlm-control{background:rgba(13,58,102,.72);backdrop-filter:blur(6px)}
.vt360-fullpage .pnlm-control:hover{background:#f9a825}
.vt360-fullpage .pnlm-about-msg,.vt360-fullpage .pnlm-title-box{display:none}
.vt360-fullpage .pnlm-hotspot-base{cursor:pointer}

/* penanda hotspot kustom (pin) — pengganti ikon default pannellum */
.vt360-hotspot{width:38px;height:38px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);
  background:linear-gradient(135deg,#ffd54a,#f9a825);display:flex;align-items:center;justify-content:center;
  box-shadow:0 8px 20px rgba(249,168,37,.5);border:2px solid #fff}
.vt360-hotspot i{transform:rotate(45deg);color:#0d3a66;font-size:.85rem}
.vt360-hotspot::after{content:"";position:absolute;inset:-8px;border-radius:50%;border:2px solid rgba(255,213,74,.55);
  animation:vtPulse 2.2s ease-out infinite}
@keyframes vtPulse{0%{transform:scale(.7);opacity:.9}100%{transform:scale(1.5);opacity:0}}
.vt360-hotspot-info{width:30px;height:30px;border-radius:50%;background:rgba(13,58,102,.85);
  display:flex;align-items:center;justify-content:center;border:2px solid #ffd54a;color:#ffd54a;font-size:.75rem;
  box-shadow:0 6px 16px rgba(0,0,0,.35)}

/* ---------- tombol keluar (balik ke halaman profil) ---------- */
.vt360-exit-btn{position:absolute;top:1.2rem;right:1.2rem;z-index:25;width:42px;height:42px;border-radius:50%;
  background:rgba(10,32,56,.72);backdrop-filter:blur(8px);border:1.5px solid rgba(255,255,255,.16);color:#fff;
  display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:1rem;
  transition:background .25s var(--ease),transform .25s var(--ease)}
.vt360-exit-btn:hover{background:#f9a825;color:#0d3a66;transform:rotate(90deg)}

/* ---------- kompas kustom (beneran ikut muter) ---------- */
.vt360-compass{position:absolute;top:1.2rem;left:50%;transform:translateX(-50%);z-index:20;width:60px;height:60px;
  border-radius:50%;background:rgba(10,32,56,.72);backdrop-filter:blur(8px);border:1.5px solid rgba(255,213,74,.4);
  display:flex;align-items:center;justify-content:center;pointer-events:none}
.vt360-compass::before{content:"U";position:absolute;top:5px;font-size:.6rem;font-weight:800;color:#ffd54a;
  letter-spacing:.05em}
.vt360-compass-needle{width:3px;height:22px;border-radius:99px;background:linear-gradient(180deg,#ff5a5a,rgba(255,255,255,.35));
  transform-origin:center 80%;transition:transform .15s linear}

/* ---------- hint cara pakai ---------- */
.vt360-hint{position:absolute;left:50%;bottom:1.2rem;transform:translateX(-50%);z-index:20;display:inline-flex;
  align-items:center;gap:.5rem;background:rgba(10,32,56,.65);backdrop-filter:blur(6px);color:rgba(255,255,255,.85);
  font-size:.72rem;font-weight:700;padding:.5rem .9rem;border-radius:999px;border:1px solid rgba(255,255,255,.14);
  pointer-events:none;white-space:nowrap}
.vt360-hint i{color:#ffd54a}

/* ---------- kartu info lokasi ---------- */
.vt360-info-card{position:absolute;right:1.2rem;bottom:1.2rem;z-index:20;max-width:280px;
  background:rgba(10,32,56,.8);backdrop-filter:blur(10px);border:1px solid rgba(255,213,74,.25);
  border-radius:18px;padding:1rem 1.2rem}
.vt360-info-eyebrow{display:block;font-size:.62rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;
  color:#ffd54a;margin-bottom:.3rem}
.vt360-info-card h3{font-family:var(--font-display);font-size:1.1rem;font-weight:900;color:#fff;margin:0 0 .3rem;
  text-transform:uppercase;line-height:1.1}
.vt360-info-card p{font-size:.78rem;line-height:1.6;color:rgba(235,245,253,.82);margin:0}

/* ---------- tombol kembali ke gerbang (Beranda) ---------- */
.vt360-home-btn{position:absolute;left:1.2rem;bottom:1.2rem;z-index:20;display:inline-flex;align-items:center;gap:.5rem;
  background:linear-gradient(135deg,#ffd54a,#f9a825);color:#0d3a66;font-size:.8rem;font-weight:900;
  padding:.75rem 1.15rem;border-radius:999px;border:0;cursor:pointer;box-shadow:0 10px 24px rgba(249,168,37,.4);
  transition:transform .25s var(--ease)}
.vt360-home-btn:hover{transform:translateY(-2px)}

/* ---------- PANEL NAVIGASI (overlay, bisa ditutup) ---------- */
.vt360-navtoggle{position:absolute;top:1.2rem;left:1.2rem;z-index:19;display:inline-flex;align-items:center;gap:.55rem;
  background:rgba(10,32,56,.78);backdrop-filter:blur(8px);border:1px solid rgba(255,213,74,.3);color:#ffd54a;
  font-family:var(--font-body);font-size:.8rem;font-weight:800;padding:.7rem 1.1rem;border-radius:999px;
  cursor:pointer;opacity:0;pointer-events:none;transform:translateY(-8px);transition:all .25s var(--ease)}
.vt360-navtoggle.show{opacity:1;pointer-events:auto;transform:translateY(0)}

.vt360-navpanel{position:absolute;top:1.2rem;left:1.2rem;z-index:21;width:min(300px,80vw);
  max-height:calc(100% - 2.4rem);background:rgba(9,26,46,.94);backdrop-filter:blur(16px);
  border:1px solid rgba(255,213,74,.22);border-radius:20px;overflow:hidden;display:flex;flex-direction:column;
  box-shadow:0 24px 60px rgba(0,0,0,.4);transition:transform .3s var(--ease),opacity .3s var(--ease)}
.vt360-navpanel.closed{transform:translateX(calc(-100% - 1.2rem));opacity:0;pointer-events:none}
.vt360-navpanel-head{display:flex;align-items:center;justify-content:space-between;padding:1.1rem 1.2rem;
  border-bottom:1px solid rgba(255,255,255,.08);flex-shrink:0}
.vt360-navpanel-head span{font-size:.7rem;font-weight:800;letter-spacing:.16em;text-transform:uppercase;color:#ffd54a}
.vt360-navpanel-close{width:30px;height:30px;border-radius:50%;background:#f9a825;color:#0d3a66;border:0;
  display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:.85rem;flex-shrink:0;
  transition:transform .2s var(--ease)}
.vt360-navpanel-close:hover{transform:rotate(90deg)}

.vt360-cat-tabs{display:flex;gap:.4rem;flex-wrap:wrap;padding:.9rem 1rem 0}
.vt360-cat-btn{font-family:var(--font-body);font-size:.7rem;font-weight:800;color:rgba(235,245,253,.7);
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);padding:.4rem .7rem;border-radius:999px;
  cursor:pointer;transition:all .25s var(--ease)}
.vt360-cat-btn:hover{color:#fff;border-color:rgba(249,168,37,.5)}
.vt360-cat-btn.active{background:linear-gradient(135deg,#ffd54a,#f9a825);border-color:transparent;color:#0d3a66}

.vt360-navlist{overflow-y:auto;padding:.7rem;display:flex;flex-direction:column;gap:.3rem;scrollbar-width:thin}
.vt360-navlist::-webkit-scrollbar{width:6px}
.vt360-navlist::-webkit-scrollbar-thumb{background:rgba(255,255,255,.15);border-radius:99px}
.vt360-navitem{display:flex;align-items:center;gap:.7rem;width:100%;text-align:left;background:transparent;
  border:0;color:rgba(235,245,253,.88);font-family:var(--font-body);font-size:.86rem;font-weight:700;
  padding:.75rem .85rem;border-radius:12px;cursor:pointer;transition:background .2s var(--ease)}
.vt360-navitem i{width:18px;text-align:center;color:#ffd54a;font-size:.85rem;flex-shrink:0}
.vt360-navitem:hover{background:rgba(255,255,255,.07)}
.vt360-navitem.active{background:linear-gradient(135deg,#ffd54a,#f9a825);color:#0d3a66}
.vt360-navitem.active i{color:#0d3a66}

/* ---------- kondisi kosong (foto belum tersedia) ---------- */
.vt360-empty{position:absolute;inset:0;z-index:15;display:none;flex-direction:column;align-items:center;
  justify-content:center;gap:.9rem;text-align:center;padding:2rem;
  background:linear-gradient(150deg,#0a2038,#13518c)}
.vt360-empty.show{display:flex}
.vt360-empty i{font-size:2.2rem;color:#ffd54a}
.vt360-empty h4{font-family:var(--font-display);color:#fff;font-size:1.15rem;text-transform:uppercase;margin:0}
.vt360-empty p{font-size:.82rem;color:rgba(235,245,253,.75);max-width:340px;margin:0;line-height:1.7}

/* ---------- responsive ---------- */
@media(max-width:700px){
  .vt360-compass{width:50px;height:50px}
  .vt360-hint{font-size:.64rem;padding:.4rem .7rem;max-width:88vw;white-space:normal;text-align:center}
  .vt360-info-card{max-width:calc(100% - 2.4rem);left:1.2rem;right:1.2rem;bottom:4.6rem}
  .vt360-home-btn{bottom:1.2rem}
  .vt360-navpanel{width:min(280px,84vw)}
}
@media(prefers-reduced-motion:reduce){
  .vt360-hotspot::after{animation:none}
  .vt360-compass-needle{transition:none}
}
</style>
@endpush

@section('content')
<div class="vt360-fullpage">
  <div id="panorama" class="vt360-pano"></div>

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

  <button class="vt360-exit-btn" onclick="window.location.href='{{ Route::has('home') ? route('home') : url('/') }}'" aria-label="Keluar dari tour">
    <i class="fas fa-xmark"></i>
  </button>

  <div class="vt360-hint"><i class="fas fa-arrows-up-down-left-right"></i> Seret untuk melihat sekeliling · Gulir untuk zoom</div>

  <div class="vt360-compass" id="vtCompass">
    <div class="vt360-compass-needle" id="vtNeedle"></div>
  </div>

  <div class="vt360-info-card">
    <span class="vt360-info-eyebrow">Sedang Menjelajah</span>
    <h3 id="vtInfoTitle">—</h3>
    <p id="vtInfoDesc">Memuat lokasi…</p>
  </div>

  <button class="vt360-home-btn" id="vtHomeBtn"><i class="fas fa-house"></i> Beranda</button>

  <div class="vt360-empty" id="vtEmpty">
    <i class="fas fa-camera-retro"></i>
    <h4 id="vtEmptyTitle">Foto 360° Belum Tersedia</h4>
    <p>Lokasi ini akan segera diperbarui dengan foto panorama asli. Sementara itu, silakan jelajahi lokasi lain yang sudah tersedia.</p>
  </div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
<script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
<script>
(function(){
  /* ============================================================
     DATA LOKASI — sesuaikan/tambah bebas.
     type kategori: 'area' | 'kelas' | 'fasilitas'
     hotspots: opsional, yaw/pitch masih perkiraan (lihat catatan
     di atas file ini untuk cara menyesuaikan setelah foto asli ada)
     ============================================================ */
  var vtScenes = {
    'gerbang-utama': {
      title: 'Gerbang Utama', category: 'area', icon: 'fa-archway',
      desc: 'Titik masuk utama SMK Negeri 2 Mojokerto, gerbang pertama yang menyambut siswa dan tamu setiap hari.',
      image: '{{ asset("images/vtour/gerbang-utama.jpg") }}',
      northOffset: 0,
      hotSpots: [
        { pitch: -2, yaw: 40, type: 'scene', text: 'Ke Lapangan Upacara', sceneId: 'lapangan-upacara' }
      ]
    },
    'lapangan-upacara': {
      title: 'Lapangan Upacara', category: 'area', icon: 'fa-flag',
      desc: 'Ruang terbuka untuk upacara bendera, olahraga, dan berbagai kegiatan siswa.',
      image: '{{ asset("images/vtour/lapangan-upacara.jpg") }}',
      northOffset: 0,
      hotSpots: [
        { pitch: -3, yaw: -150, type: 'scene', text: 'Kembali ke Gerbang', sceneId: 'gerbang-utama' },
        { pitch: -2, yaw: 60, type: 'scene', text: 'Ke Lobi Sekolah', sceneId: 'lobi-sekolah' },
        { pitch: 5, yaw: 10, type: 'info', text: 'Lapangan ini digunakan untuk upacara bendera setiap Senin dan kegiatan O2SN.' }
      ]
    },
    'lobi-sekolah': {
      title: 'Lobi & Ruang Tunggu', category: 'area', icon: 'fa-door-open',
      desc: 'Area penerima tamu sekolah, penghubung menuju gedung kelas dan ruang program keahlian.',
      image: '{{ asset("images/vtour/lobi-sekolah.jpg") }}',
      northOffset: 0,
      hotSpots: [
        { pitch: -3, yaw: -140, type: 'scene', text: 'Kembali ke Lapangan', sceneId: 'lapangan-upacara' },
        { pitch: -2, yaw: 80, type: 'scene', text: 'Ke Koridor Kelas RPL', sceneId: 'koridor-rpl' }
      ]
    },
    'koridor-rpl': {
      title: 'Koridor Kelas RPL', category: 'kelas', icon: 'fa-code',
      desc: 'Akses menuju ruang teori dan laboratorium Rekayasa Perangkat Lunak.',
      image: '{{ asset("images/vtour/koridor-rpl.jpg") }}',
      northOffset: 0
    },
    'studio-dkv': {
      title: 'Studio Desain DKV', category: 'kelas', icon: 'fa-palette',
      desc: 'Ruang praktik siswa Desain Komunikasi Visual, dilengkapi perangkat desain digital.',
      image: '{{ asset("images/vtour/studio-dkv.jpg") }}',
      northOffset: 0
    },
    'dapur-kuliner': {
      title: 'Dapur Praktik Kuliner', category: 'kelas', icon: 'fa-utensils',
      desc: 'Dapur produksi tempat siswa Kuliner mengasah keterampilan memasak dan tata boga.',
      image: '{{ asset("images/vtour/dapur-kuliner.jpg") }}',
      northOffset: 0
    },
    'bank-mini-lps': {
      title: 'Bank Mini LPS', category: 'kelas', icon: 'fa-building-columns',
      desc: 'Ruang simulasi perbankan syariah untuk praktik layanan nasabah siswa LPS.',
      image: '{{ asset("images/vtour/bank-mini-lps.jpg") }}',
      northOffset: 0
    },
    'griya-aphp': {
      title: 'Griya Produksi APHP', category: 'kelas', icon: 'fa-wheat-awn',
      desc: 'Fasilitas pengolahan hasil pertanian tempat siswa APHP mempraktikkan produksi pangan.',
      image: '{{ asset("images/vtour/griya-aphp.jpg") }}',
      northOffset: 0
    },
    'perpustakaan': {
      title: 'Perpustakaan', category: 'fasilitas', icon: 'fa-book',
      desc: 'Ruang baca dan koleksi referensi untuk mendukung kegiatan belajar siswa.',
      image: '{{ asset("images/vtour/perpustakaan.jpg") }}',
      northOffset: 0
    },
    'aula-serbaguna': {
      title: 'Aula Serbaguna', category: 'fasilitas', icon: 'fa-people-roof',
      desc: 'Ruang besar untuk acara sekolah, seminar, dan pertemuan wali murid.',
      image: '{{ asset("images/vtour/aula-serbaguna.jpg") }}',
      northOffset: 0
    }
  };

  var HOME_SCENE = 'gerbang-utama';

  /* ---------- bangun konfigurasi Pannellum dari data di atas ---------- */
  function buildPannellumScenes(){
    var out = {};
    Object.keys(vtScenes).forEach(function(id){
      var s = vtScenes[id];
      out[id] = {
        type: 'equirectangular',
        panorama: s.image,
        northOffset: s.northOffset || 0,
        hotSpots: (s.hotSpots || []).map(function(h){
          if (h.type === 'scene') {
            return { pitch: h.pitch, yaw: h.yaw, type: 'scene', text: h.text, sceneId: h.sceneId,
              cssClass: 'vt360-hotspot', createTooltipFunc: makeHotspotIcon('fa-arrow-right') };
          }
          return { pitch: h.pitch, yaw: h.yaw, type: 'info', text: h.text,
            cssClass: 'vt360-hotspot-info', createTooltipFunc: makeHotspotIcon('fa-info', true) };
        })
      };
    });
    return out;
  }

  function makeHotspotIcon(iconClass, isInfo){
    return function(hotSpotDiv, args){
      hotSpotDiv.classList.remove('pnlm-hotspot-base');
      var icon = document.createElement('i');
      icon.className = 'fas ' + iconClass;
      hotSpotDiv.appendChild(icon);
      if (args && typeof args === 'string' && !isInfo) return;
      if (args) {
        var span = document.createElement('span');
        span.className = 'pnlm-tooltip-span';
        span.style.cssText = 'font-family:var(--font-body);font-weight:700';
        span.textContent = args;
        hotSpotDiv.appendChild(span);
      }
    };
  }

  var viewer = pannellum.viewer('panorama', {
    default: {
      firstScene: HOME_SCENE,
      sceneFadeDuration: 900,
      autoLoad: true,
      compass: false,
      hotSpotDebug: false,
      showControls: true
    },
    scenes: buildPannellumScenes()
  });

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

  document.getElementById('vtHomeBtn').addEventListener('click', function(){ goToScene(HOME_SCENE); });

  /* ---------- kontrol scene aktif ---------- */
  var curScene = HOME_SCENE;
  var infoTitleEl = document.getElementById('vtInfoTitle');
  var infoDescEl = document.getElementById('vtInfoDesc');
  var emptyEl = document.getElementById('vtEmpty');
  var emptyTitleEl = document.getElementById('vtEmptyTitle');

  function updateInfoCard(id){
    var s = vtScenes[id];
    infoTitleEl.textContent = s.title;
    infoDescEl.textContent = s.desc;
  }

  function goToScene(id){
    if (!vtScenes[id]) return;
    curScene = id;
    emptyEl.classList.remove('show');
    updateInfoCard(id);
    renderNavList();
    try { viewer.loadScene(id); } catch (err) { showEmptyState(id); }
  }

  function showEmptyState(id){
    emptyTitleEl.textContent = 'Foto 360° "' + (vtScenes[id] ? vtScenes[id].title : '') + '" Belum Tersedia';
    emptyEl.classList.add('show');
  }

  viewer.on('scenechange', function(id){
    curScene = id;
    updateInfoCard(id);
    renderNavList();
  });

  viewer.on('error', function(){ showEmptyState(curScene); });
  viewer.on('errorcleared', function(){ emptyEl.classList.remove('show'); });

  /* ---------- kompas kustom: ikuti yaw asli viewer ---------- */
  var needleEl = document.getElementById('vtNeedle');
  setInterval(function(){
    try {
      var yaw = viewer.getYaw();
      needleEl.style.transform = 'rotate(' + (-yaw) + 'deg)';
    } catch (e) { /* viewer belum siap */ }
  }, 120);

  /* ---------- init ---------- */
  renderNavList();
  updateInfoCard(HOME_SCENE);
})();
</script>
@endpush