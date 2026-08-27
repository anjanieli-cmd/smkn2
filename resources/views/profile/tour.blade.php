{{--
  resources/views/profil/tour-virtual.blade.php

  VIRTUAL TOUR 360° — SMK NEGERI 2 MOJOKERTO (FULLSCREEN, PANNELLUM)
  ============================================================
  Versi ini PINDAH dari embed iframe Momento360 ke PANNELLUM
  (viewer 360° yang jalan langsung di halamanmu, pakai file foto
  equirectangular yang kamu upload/hosting sendiri).

  KENAPA PINDAH:
  Di versi Momento360, tombol "menuju lokasi lain" cuma bisa
  ditaruh mengambang statis di atas iframe (karena iframe itu beda
  origin, JS-mu nggak bisa baca arah pandang kamera di dalamnya).
  Efeknya tombol itu diam di layar walau foto di baliknya diputar,
  jadi lama-lama "nyasar" nggak nempel ke objek yang dimaksud.

  Dengan Pannellum, foto dirender LANGSUNG di halamanmu (bukan
  iframe orang lain), jadi kita punya akses penuh ke sudut pandang
  kamera. Hotspot sekarang dikasih koordinat pitch/yaw (bukan top/
  left dalam %), dan Pannellum otomatis:
  - nempelin hotspot ke titik itu di foto (ikut muter pas di-drag)
  - nyembunyiin hotspot kalau titik itu lagi di belakang/luar pandangan

  ============================================================
  FIX (26 Agustus 2026): ICON HOTSPOT SEKARANG BENERAN NEMPEL
  ============================================================
  Sebelumnya class `.vt360-hotspot` punya:
      transition: width .28s var(--ease), background .2s var(--ease), transform .2s var(--ease)
  Elemen yang sama ini juga yang posisinya (transform: translate(...))
  di-update TERUS-MENERUS oleh Pannellum tiap frame (~60fps) supaya
  hotspot nempel ke titik pitch/yaw di foto pas kamera diputar.

  Karena ada `transition: transform`, browser nganggep tiap perubahan
  posisi itu harus di-ANIMASI pelan-pelan selama 200ms — padahal
  perubahannya datang lagi tiap 16ms. Hasilnya transisi keputus-putus
  terus dan icon jadi keliatan "nyangkut"/ nggak ngikutin muternya foto.

  FIX: `transform` dibuang dari daftar transition hotspot. Transisi
  yang tersisa cuma buat efek "mekar" pas expand (width) & warna hover.
  Efek scale pas hover dipindah ke ikon di dalamnya (bukan ke elemen
  pembungkus yang posisinya dikontrol Pannellum), biar dua transform
  (posisi dari Pannellum vs scale dari hover) nggak tabrakan.

  Koordinat hotspot "Menuju Lobi" juga sudah diupdate pakai hasil
  Mode Kalibrasi terbaru: pitch: 6.27, yaw: -84.00 (pas di tulisan
  "SMKN 2 KOTA MOJOKERTO").
  ============================================================

  CARA ISI FOTO:
  1) Siapkan foto 360° equirectangular (rasio 2:1, mis. 6000x3000px)
     per lokasi, format .jpg.
  2) Taruh filenya di folder public, misal: public/tour/gerbang-utama.jpg
  3) Isi field `panorama` pada scene yang sesuai di variabel vtScenes
     (cari komentar "GANTI DI SINI"), pakai helper asset(), contoh:
       panorama: '{{ asset("tour/gerbang-utama.jpg") }}'
  4) Kalau `panorama` masih kosong (''), halaman otomatis nampilin
     kondisi "Foto 360° belum tersedia".

  CARA CARI KOORDINAT HOTSPOT (pitch/yaw) DI FOTO:
  Waktu lagi buka scene yang fotonya sudah ada, tekan tombol
  SHIFT lalu klik titik di foto yang kamu mau kasih hotspot
  (misal pas di bangunan bertuliskan "SMKN 2"). Koordinat pitch &
  yaw titik itu otomatis muncul di console browser (F12 → Console).
  Copy angka itu ke field hotspots scene terkait. Atau pakai
  Mode Kalibrasi (tombol merah di pojok kiri bawah) buat naruh pin
  visual dan baca angkanya langsung di layar.

  Route tetap sama, contoh di routes/web.php:
  Route::get('/profil/tour-virtual', fn () => view('profil.tour-virtual'))->name('profil.tour-virtual');
  ============================================================
--}}
@extends('layouts.app')

@section('title', 'Virtual Tour 360° — SMK Negeri 2 Mojokerto')
@section('description', 'Jelajahi lingkungan SMK Negeri 2 Mojokerto secara virtual 360° — gerbang, lapangan, ruang program keahlian, hingga fasilitas penunjang, langsung dari layar Anda.')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css">
<style>
/* =========================================================
   VIRTUAL TOUR 360° — FULLSCREEN VIEWER (PANNELLUM)
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

/* wadah viewer pannellum */
.vt360-embed-wrap{position:absolute;inset:0;width:100%;height:100%;background:#0a2038}
#vtPano{position:absolute;inset:0;width:100%;height:100%}

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

/* ---------- hotspot NAVIGASI — nempel beneran ke titik foto (via Pannellum) ---------- */
/* Bentuknya sama kayak sebelumnya: default ikon bulat -> klik 1x "mekar"
   nampilin label -> klik lagi baru pindah scene. Posisinya dihitung &
   di-update TERUS sama Pannellum berdasarkan pitch/yaw yang kamu set —
   makanya elemen ini TIDAK BOLEH punya `transition: transform`, karena
   posisinya di-update lewat inline `transform` tiap frame oleh Pannellum.
   Kalau ada transition di transform, browser nyoba nge-animasi tiap
   perubahan posisi itu dan hasilnya icon "nyangkut"/telat ngikutin foto. */
.vt360-hotspot{display:inline-flex;align-items:center;background:rgba(13,58,102,.88);
  color:#fff;font-family:var(--font-body);font-size:.78rem;font-weight:800;
  border-radius:999px;border:1px solid rgba(255,255,255,.25);
  cursor:pointer;white-space:nowrap;box-shadow:0 10px 26px rgba(10,32,56,.35);
  width:42px;height:42px;justify-content:center;gap:0;padding:0;
  /* FIX: `transform` DIHAPUS dari daftar transition di bawah ini.
     Sebelumnya ada `transform .2s var(--ease)` di sini — itu penyebab
     icon nggak ngikutin arah pandang pas kamera diputar. */
  transition:width .28s var(--ease),background .2s var(--ease)}
.vt360-hotspot i{color:#ffd54a;font-size:.9rem;flex-shrink:0;transition:transform .2s var(--ease)}
.vt360-hotspot .vt360-hotspot-label{max-width:0;overflow:hidden;opacity:0;
  transition:max-width .28s var(--ease),opacity .2s var(--ease)}
.vt360-hotspot.expanded{width:auto;gap:.5rem;padding:.55rem 1rem}
.vt360-hotspot.expanded .vt360-hotspot-label{max-width:160px;opacity:1}
/* Efek "membesar" pas hover DIPINDAH ke icon di dalamnya saja (bukan ke
   elemen pembungkus yang posisinya dikontrol Pannellum), biar transform
   dari Pannellum (posisi) dan transform dari hover (scale) nggak tabrakan
   di elemen yang sama. */
.vt360-hotspot:hover{background:#f9a825;color:#0d3a66}
.vt360-hotspot:hover i{color:#0d3a66;transform:scale(1.18)}
/* Pannellum bungkus hotspot custom kita dalam .pnlm-hotspot-base, matikan
   style bawaannya biar nggak bentrok sama styling kita sendiri */
.pnlm-hotspot-base.pnlm-scene{background:none;width:auto;height:auto}

/* ---------- loading state saat ganti scene ---------- */
.vt360-loading{position:absolute;inset:0;z-index:12;display:none;align-items:center;justify-content:center;
  background:#0a2038}
.vt360-loading.show{display:flex}
.vt360-loading i{font-size:1.6rem;color:#ffd54a;animation:vtSpin .5s linear infinite}
@keyframes vtSpin{to{transform:rotate(360deg)}}

/* ---------- MODE KALIBRASI (khusus proses setting titik hotspot) ---------- */
.vt360-calib-btn{position:absolute;bottom:1.2rem;left:1.2rem;z-index:22;display:inline-flex;align-items:center;gap:.5rem;
  background:rgba(13,58,102,.92);color:#fff;font-family:var(--font-body);font-size:.78rem;font-weight:800;
  border:1px solid rgba(255,255,255,.2);padding:.65rem 1rem;border-radius:999px;cursor:pointer;
  box-shadow:0 10px 26px rgba(10,32,56,.35);transition:background .2s var(--ease)}
.vt360-calib-btn i{color:#ffd54a}
.vt360-calib-btn.active{background:#e64545}
.vt360-calib-info{position:absolute;bottom:4.2rem;left:1.2rem;z-index:22;max-width:280px;
  background:rgba(255,255,255,.97);border-radius:14px;padding:.8rem 1rem;font-family:var(--font-body);
  font-size:.78rem;color:#0d3a66;box-shadow:0 16px 40px rgba(13,58,102,.2);display:none;line-height:1.6}
.vt360-calib-info.show{display:block}
.vt360-calib-info code{background:#f2f6fb;padding:.1rem .4rem;border-radius:6px;font-weight:700;user-select:all}
/* Pin kalibrasi juga TIDAK BOLEH punya transition di transform, dengan
   alasan yang sama seperti .vt360-hotspot di atas. */
.vt360-calib-pin{width:20px;height:20px;border-radius:50%;background:#e64545;border:3px solid #fff;
  box-shadow:0 0 0 4px rgba(230,69,69,.35),0 6px 16px rgba(0,0,0,.4)}

/* ---------- responsive ---------- */
@media(max-width:700px){
  .vt360-info-card{max-width:calc(100% - 2.4rem);left:1.2rem;right:1.2rem;bottom:1.2rem}
  .vt360-navpanel{width:min(280px,84vw)}
}
</style>
@endpush

@section('content')
<div class="vt360-fullpage">
  <div class="vt360-embed-wrap">
    <div id="vtPano"></div>
  </div>

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

  {{-- tombol mode kalibrasi hotspot (khusus buat proses setting titik, boleh dihapus nanti) --}}
  <button class="vt360-calib-btn" id="vtCalibBtn"><i class="fas fa-crosshairs"></i> Mode Kalibrasi: OFF</button>
  <div class="vt360-calib-info" id="vtCalibInfo"></div>

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
<script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
<script>
(function(){
  /* ============================================================
     DATA LOKASI — sesuaikan/tambah bebas.
     category  : 'area' | 'kelas' | 'fasilitas'
     panorama  : URL foto equirectangular (pakai asset()). Kosongkan
                 ('') kalau foto lokasi itu belum ada — halaman
                 otomatis munculin kondisi "belum tersedia".
     hotspots  : array tombol navigasi yang NEMPEL ke titik foto,
                 { pitch, yaw, to, label, icon }. Cara cari angka
                 pitch/yaw: buka scene ybs, tekan SHIFT + klik titik
                 di foto, lihat console browser (F12), atau pakai
                 Mode Kalibrasi (tombol merah kiri bawah).
     ============================================================ */
  var vtScenes = {
    'gerbang-utama': {
      title: 'Gerbang Utama', category: 'area', icon: 'fa-archway',
      desc: 'Titik masuk utama SMK Negeri 2 Mojokerto, gerbang pertama yang menyambut siswa dan tamu setiap hari.',
      panorama: '{{ asset("tour/gerbang-utama.jpg") }}?v={{ time() }}',
      // Foto ini panorama SEBAGIAN (bukan bola 360 penuh), makanya perlu haov/vaov
      // manual. Angka vaov ini dihitung dari rasio lebar:tinggi file aslinya
      // (8000x2023px). Kalau kamu ganti foto lain nanti, hitung ulang:
      // vaov = 360 * (tinggi_px / lebar_px)
      haov: 360,
      vaov: 91,
      vOffset: 0,
      // Posisi tombol "Menuju Lobi" — HASIL KALIBRASI TERBARU (Mode
      // Kalibrasi, pin merah), pas nempel di tulisan
      // "SMKN 2 KOTA MOJOKERTO" pada foto.
      hotspots: [
        { pitch: 6.27, yaw: -84.00, to: 'lobi-sekolah', label: 'Menuju Lobi', icon: 'fa-plus' }
      ]
    },
    'lapangan-upacara': {
      title: 'Lapangan Upacara', category: 'area', icon: 'fa-flag',
      desc: 'Ruang terbuka untuk upacara bendera, olahraga, dan berbagai kegiatan siswa.',
      panorama: '' // GANTI DI SINI
    },
    'lobi-sekolah': {
      title: 'Lobi & Ruang Tunggu', category: 'area', icon: 'fa-door-open',
      desc: 'Area penerima tamu sekolah, penghubung menuju gedung kelas dan ruang program keahlian.',
      panorama: '{{ asset("tour/lobi-sekolah.jpg") }}',
      // Foto ini juga panorama sebagian (8000x2713px) — vaov dihitung sama
      // seperti scene gerbang-utama di atas.
      haov: 360,
      vaov: 122,
      vOffset: 0
    },
    'koridor-rpl': {
      title: 'Koridor Kelas RPL', category: 'kelas', icon: 'fa-code',
      desc: 'Akses menuju ruang teori dan laboratorium Rekayasa Perangkat Lunak.',
      panorama: '' // GANTI DI SINI
    },
    'studio-dkv': {
      title: 'Studio Desain DKV', category: 'kelas', icon: 'fa-palette',
      desc: 'Ruang praktik siswa Desain Komunikasi Visual, dilengkapi perangkat desain digital.',
      panorama: '' // GANTI DI SINI
    },
    'dapur-kuliner': {
      title: 'Dapur Praktik Kuliner', category: 'kelas', icon: 'fa-utensils',
      desc: 'Dapur produksi tempat siswa Kuliner mengasah keterampilan memasak dan tata boga.',
      panorama: '' // GANTI DI SINI
    },
    'bank-mini-lps': {
      title: 'Bank Mini LPS', category: 'kelas', icon: 'fa-building-columns',
      desc: 'Ruang simulasi perbankan syariah untuk praktik layanan nasabah siswa LPS.',
      panorama: '' // GANTI DI SINI
    },
    'griya-aphp': {
      title: 'Griya Produksi APHP', category: 'kelas', icon: 'fa-wheat-awn',
      desc: 'Fasilitas pengolahan hasil pertanian tempat siswa APHP mempraktikkan produksi pangan.',
      panorama: '' // GANTI DI SINI
    },
    'perpustakaan': {
      title: 'Perpustakaan', category: 'fasilitas', icon: 'fa-book',
      desc: 'Ruang baca dan koleksi referensi untuk mendukung kegiatan belajar siswa.',
      panorama: '' // GANTI DI SINI
    },
    'aula-serbaguna': {
      title: 'Aula Serbaguna', category: 'fasilitas', icon: 'fa-people-roof',
      desc: 'Ruang besar untuk acara sekolah, seminar, dan pertemuan wali murid.',
      panorama: '' // GANTI DI SINI
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
  var pannellumViewer = null;
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

  function destroyViewer(){
    if (pannellumViewer) { pannellumViewer.destroy(); pannellumViewer = null; }
  }

  function showEmptyState(id){
    emptyTitleEl.textContent = 'Foto 360° "' + (vtScenes[id] ? vtScenes[id].title : '') + '" Belum Tersedia';
    emptyEl.classList.add('show');
    destroyViewer();
  }

  // render tombol hotspot custom (ikon bulat -> klik mekar -> klik lagi pindah)
  // dipanggil oleh Pannellum lewat opsi createTooltipFunc tiap hotspot dibuat.
  function createNavHotspot(hotSpotDiv, args){
    hotSpotDiv.classList.add('vt360-hotspot');
    hotSpotDiv.innerHTML = '<i class="fas ' + (args.icon || 'fa-plus') + '"></i>' +
      '<span class="vt360-hotspot-label">' + args.label + '</span>';
    hotSpotDiv.addEventListener('click', function(e){
      e.stopPropagation();
      if (!hotSpotDiv.classList.contains('expanded')) {
        document.querySelectorAll('.vt360-hotspot.expanded').forEach(function(other){
          other.classList.remove('expanded');
        });
        hotSpotDiv.classList.add('expanded');
        return;
      }
      goToScene(args.to);
    });
  }

  function goToScene(id){
    if (!vtScenes[id]) return;
    curScene = id;
    updateInfoCard(id);
    renderNavList();

    var s = vtScenes[id];
    if (!s.panorama) { showEmptyState(id); return; }

    emptyEl.classList.remove('show');
    loadingEl.classList.add('show');
    destroyViewer();

    var hotSpots = (s.hotspots || []).map(function(h){
      return {
        pitch: h.pitch, yaw: h.yaw, type: 'custom',
        cssClass: 'vt360-hotspot-wrap',
        createTooltipFunc: createNavHotspot,
        createTooltipArgs: { to: h.to, label: h.label, icon: h.icon }
      };
    });

    pannellumViewer = pannellum.viewer('vtPano', {
      type: 'equirectangular',
      panorama: s.panorama,
      haov: s.haov, // sudut pandang horizontal foto (derajat). 360 = sapuan penuh keliling
      vaov: s.vaov, // sudut pandang vertikal foto (derajat). Isi kalau foto BUKAN bola 360 penuh
      vOffset: s.vOffset || 0, // geser pusat vertikal foto kalau horizonnya nggak pas di tengah
      // Kamera dipaksa langsung menghadap titik hotspot pertama (kalau ada)
      // pas scene dibuka, biar ikonnya PASTI kelihatan dari awal tanpa
      // perlu muter-muter cari dulu.
      yaw: (hotSpots[0] ? hotSpots[0].yaw : 0),
      pitch: (hotSpots[0] ? hotSpots[0].pitch : 0),
      autoLoad: true,
      showZoomCtrl: false,
      showFullscreenCtrl: false,
      compass: false,
      hotSpotDebug: false,
      hotSpots: hotSpots
    });

    pannellumViewer.on('load', function(){ loadingEl.classList.remove('show'); });

    // ---------- MODE KALIBRASI: klik di foto pas mode aktif -> naruh pin
    // MERAH beneran di titik itu (bukan cuma angka di console), biar
    // kelihatan visual pas apa nggak sebelum angkanya di-commit ke kode.
    var calibActive = false;
    var calibBtn = document.getElementById('vtCalibBtn');
    var calibInfoEl = document.getElementById('vtCalibInfo');
    var CALIB_PIN_ID = 'calibPin';

    function calibCreateTooltip(div){
      div.classList.add('vt360-calib-pin');
    }

    function placeCalibPin(pitch, yaw){
      try { pannellumViewer.removeHotSpot(CALIB_PIN_ID); } catch(e){}
      pannellumViewer.addHotSpot({
        id: CALIB_PIN_ID,
        pitch: pitch, yaw: yaw, type: 'custom',
        createTooltipFunc: calibCreateTooltip
      });
      calibInfoEl.classList.add('show');
      calibInfoEl.innerHTML = 'Pin merah = titik yang barusan diklik.<br>' +
        '<code>pitch: ' + pitch.toFixed(2) + ', yaw: ' + yaw.toFixed(2) + '</code><br>' +
        'Kalau udah pas, kirim angka ini ke chat.';
    }

    calibBtn.addEventListener('click', function(){
      calibActive = !calibActive;
      calibBtn.classList.toggle('active', calibActive);
      calibBtn.innerHTML = '<i class="fas fa-crosshairs"></i> Mode Kalibrasi: ' + (calibActive ? 'ON' : 'OFF');
      if (!calibActive) {
        calibInfoEl.classList.remove('show');
        try { pannellumViewer.removeHotSpot(CALIB_PIN_ID); } catch(e){}
      }
    });

    pannellumViewer.on('mousedown', function(e){
      if (!calibActive) return;
      var coords = pannellumViewer.mouseEventToCoords(e);
      placeCalibPin(coords[0], coords[1]);
    });
  }

  /* ---------- init ---------- */
  renderNavList();
  goToScene(HOME_SCENE);
})();
</script>
@endpush