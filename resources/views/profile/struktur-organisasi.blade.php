@extends('layouts.app')

@section('title', 'Struktur Organisasi — SMK Negeri 2 Mojokerto')

@include('profile.partials.struktur-styles')

@section('content')
<div class="so-page">
  <!-- HERO -->
  <section class="history-hero">
    <div class="history-ref-ornaments" aria-hidden="true">
      <img
        src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}"
        alt=""
        class="history-ref-ornament-image"
        aria-hidden="true"
      >
    </div>
    <div class="history-hero-inner">
      <div>
        <div class="history-kicker"></div>
        <h3 class="history-title">
          <span class="sejarah-white">STRUKTUR</span>
          <span class="skaneda-gold">ORGANISASI</span>
        </h3>
        <a class="history-vt-cta" href="#virtual-tour">
          <span class="history-vt-icon"><i class="fas fa-street-view"></i></span>
          <span><strong>Lihat Virtual Tour 360°</strong><small>Jelajahi SMK Negeri 2 Mojokerto</small></span>
          <i class="fas fa-arrow-right history-vt-arrow"></i>
        </a>
      </div>
    </div>
  </section>
<!-- SECTION BAGAN -->
  <section class="so-chart-section">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="so-feed-orn" aria-hidden="true">
      <svg viewBox="0 0 1440 1120" preserveAspectRatio="none" role="presentation">
        <defs>
          <radialGradient id="soOrnGlowNavy" cx="50%" cy="50%" r="50%">
            <stop offset="0%" stop-color="#0d3a66" stop-opacity=".10"/>
            <stop offset="100%" stop-color="#0d3a66" stop-opacity="0"/>
          </radialGradient>
          <radialGradient id="soOrnGlowGold" cx="50%" cy="50%" r="50%">
            <stop offset="0%" stop-color="#ff8a00" stop-opacity=".13"/>
            <stop offset="100%" stop-color="#ff8a00" stop-opacity="0"/>
          </radialGradient>
          <pattern id="soOrnDots" width="18" height="18" patternUnits="userSpaceOnUse">
            <circle cx="3" cy="3" r="1.5" class="orn-grid-dot"/>
          </pattern>
        </defs>

        <!-- KIRI ATAS: orbit + jalur jaringan -->
        <g class="orn-left-top">
          <circle cx="150" cy="170" r="112" class="orn-ring"/>
          <circle cx="150" cy="170" r="82" class="orn-ring-gold"/>
          <circle cx="150" cy="170" r="52" class="orn-ring"/>
          <circle cx="150" cy="170" r="22" class="orn-solid-gold"/>
          <circle cx="150" cy="170" r="72" class="orn-dash"/>
          <path d="M0 300 L92 208 L206 208 L286 126" class="orn-line"/>
          <path d="M18 332 L116 232 L238 232 L318 152" class="orn-line-gold"/>
          <path d="M45 80 L118 124 L184 76 L270 112" class="orn-dash"/>
          <circle cx="92" cy="208" r="5" class="orn-node-navy"/>
          <circle cx="206" cy="208" r="5" class="orn-node"/>
          <circle cx="286" cy="126" r="5" class="orn-dot"/>
          <circle cx="118" cy="124" r="4" class="orn-dot"/>
          <circle cx="184" cy="76" r="4" class="orn-node"/>
          <circle cx="270" cy="112" r="4" class="orn-dot-navy"/>
          <circle cx="150" cy="170" r="180" class="orn-soft"/>
        </g>

        <!-- KANAN ATAS: diamond modular + node -->
        <g class="orn-right-top">
          <rect x="1138" y="72" width="148" height="148" transform="rotate(45 1212 146)" class="orn-diamond"/>
          <rect x="1165" y="99" width="94" height="94" transform="rotate(45 1212 146)" class="orn-diamond-navy"/>
          <rect x="1192" y="119" width="54" height="54" transform="rotate(45 1219 146)" class="orn-solid-navy"/>
          <path d="M1060 242 L1130 172 L1212 242 L1290 164 L1380 238" class="orn-line"/>
          <path d="M1110 320 L1190 240 L1280 240 L1368 150" class="orn-line-gold"/>
          <circle cx="1060" cy="242" r="5" class="orn-node"/>
          <circle cx="1130" cy="172" r="4" class="orn-dot-navy"/>
          <circle cx="1290" cy="164" r="5" class="orn-node"/>
          <circle cx="1380" cy="238" r="6" class="orn-solid-gold"/>
          <circle cx="1110" cy="320" r="4" class="orn-dot"/>
          <circle cx="1368" cy="150" r="4" class="orn-node-navy"/>
          <rect x="1288" y="310" width="110" height="110" fill="url(#soOrnDots)" opacity=".75"/>
        </g>

        <!-- KIRI BAWAH: garis diagonal + diamond -->
        <g class="orn-left-bottom">
          <rect x="76" y="770" width="112" height="112" transform="rotate(45 132 826)" class="orn-diamond"/>
          <rect x="104" y="798" width="56" height="56" transform="rotate(45 132 826)" class="orn-diamond-navy"/>
          <path d="M0 960 L94 866 L184 866 L286 764 L376 764" class="orn-line"/>
          <path d="M0 1010 L126 884 L238 884 L338 784 L430 784" class="orn-line-gold"/>
          <path d="M64 1040 L164 940 L264 940 L364 840" class="orn-dash"/>
          <circle cx="94" cy="866" r="5" class="orn-node"/>
          <circle cx="184" cy="866" r="4" class="orn-dot-navy"/>
          <circle cx="286" cy="764" r="5" class="orn-node-navy"/>
          <circle cx="376" cy="764" r="4" class="orn-dot"/>
          <circle cx="126" cy="884" r="4" class="orn-dot"/>
          <circle cx="338" cy="784" r="5" class="orn-node"/>
          <circle cx="430" cy="784" r="4" class="orn-dot-navy"/>
          <rect x="-16" y="930" width="92" height="92" fill="url(#soOrnDots)" opacity=".62"/>
        </g>

        <!-- KANAN BAWAH: focal orbit + modular blocks -->
        <g class="orn-right-bottom">
          <circle cx="1225" cy="858" r="128" class="orn-ring"/>
          <circle cx="1225" cy="858" r="96" class="orn-ring-gold"/>
          <circle cx="1225" cy="858" r="62" class="orn-ring"/>
          <circle cx="1225" cy="858" r="28" class="orn-solid-gold"/>
          <path d="M1050 1012 L1148 914 L1234 914 L1320 828 L1428 828" class="orn-line"/>
          <path d="M1084 1056 L1184 956 L1268 956 L1360 864 L1440 864" class="orn-line-gold"/>
          <circle cx="1050" cy="1012" r="5" class="orn-node-navy"/>
          <circle cx="1148" cy="914" r="4" class="orn-dot"/>
          <circle cx="1234" cy="914" r="5" class="orn-node"/>
          <circle cx="1320" cy="828" r="4" class="orn-dot-navy"/>
          <circle cx="1428" cy="828" r="5" class="orn-solid-gold"/>
          <rect x="1280" y="950" width="126" height="126" transform="rotate(45 1343 1013)" class="orn-diamond-navy"/>
          <rect x="1306" y="976" width="74" height="74" transform="rotate(45 1343 1013)" class="orn-diamond"/>
          <circle cx="1225" cy="858" r="185" class="orn-glow"/>
        </g>

        <!-- titik aksen kecil di seluruh bidang -->
        <g class="hide-mobile">
          <circle cx="392" cy="144" r="4" class="orn-solid-gold"/>
          <circle cx="428" cy="182" r="3" class="orn-dot-navy"/>
          <circle cx="1010" cy="150" r="4" class="orn-dot"/>
          <circle cx="1050" cy="188" r="3" class="orn-dot-navy"/>
          <circle cx="334" cy="624" r="3" class="orn-dot"/>
          <circle cx="1090" cy="610" r="4" class="orn-solid-gold"/>
          <circle cx="1018" cy="690" r="3" class="orn-dot-navy"/>
          <circle cx="408" cy="920" r="4" class="orn-dot-navy"/>
        </g>
      </svg>
    </div>

    <div class="so-wrap">
      <div class="so-sec-head" data-reveal>
        <div class="eyebrow">Bagan Organisasi</div>
        <h2 class="big-heading">TIGA LAPISAN, <span>SATU KESATUAN.</span></h2>
      </div>

      <!-- TOOLBAR SEARCH & FILTER -->
      <div class="so-toolbar" data-reveal>
        <div class="so-search">
          <i class="fas fa-magnifying-glass"></i>
          <input type="text" id="soSearchInput" placeholder="Cari nama, jabatan, atau bidang..." aria-label="Cari dalam struktur organisasi">
        </div>
        <span class="so-filter-label">Bidang</span>
        <div class="so-filters" id="soFilters">
          <button class="so-fchip is-active" data-filter="*">Semua</button>
          <button class="so-fchip" data-filter="pimpinan">Pimpinan</button>
          <button class="so-fchip" data-filter="kurikulum">Kurikulum</button>
          <button class="so-fchip" data-filter="kesiswaan">Kesiswaan</button>
          <button class="so-fchip" data-filter="sapras">Sarana &amp; Prasarana</button>
          <button class="so-fchip" data-filter="humas">Humas &amp; Industri</button>
          <button class="so-fchip" data-filter="keuangan">Keuangan</button>
          <button class="so-fchip" data-filter="keahlian">Kompetensi Keahlian</button>
                  </div>
      </div>

      <div class="so-empty" id="soEmpty">
        <i class="fas fa-magnifying-glass"></i>
        <strong>Tidak ditemukan</strong><br>
        Coba kata kunci atau bidang lain.
      </div>

      <div class="so-chart" id="soChart" data-reveal>

        {{-- ===== LEVEL 1: PIMPINAN ===== --}}
        <div class="so-level so-level-root so-anchor" id="level-1" data-level="1">
          <div class="so-level-head">
            <span class="so-level-badge"><i class="fas fa-user-tie"></i> Level 1 &mdash; Pimpinan</span>
            <span class="so-level-rule"></span>
          </div>
          <div class="so-grid">
            <article class="so-card" tabindex="0" data-name="Kepala Sekolah" data-role="Pimpinan Sekolah" data-unit="Pimpinan" data-filter="pimpinan" data-detail="kepsek">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/pimpinan.png') }}" alt="Foto Kepala Sekolah" loading="lazy"></div>
                <span class="so-photo-tag is-gold"><i class="fas fa-star"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Kepala Sekolah</h3>
              <div class="so-card-person">Iswahyudi S.ST. M.Pd.</div>
              <div class="so-card-role"><i class="fas fa-star"></i> Pimpinan</div>
              <p class="so-card-unit">Pemimpin tertinggi organisasi sekolah</p>
            </article>
          </div>
        </div>

        {{-- ===== LEVEL 2: WAKIL KEPALA SEKOLAH ===== --}}
        <div class="so-level so-anchor" id="level-2" data-level="2">
          <div class="so-level-head">
            <span class="so-level-badge"><i class="fas fa-users-gear"></i> Level 2 &mdash; Wakil Kepala Sekolah</span>
            <span class="so-level-rule"></span>
          </div>
          <div class="so-grid">
            <article class="so-card" tabindex="0" data-name="MELATI PUSPITA SARI, S.Pd." data-role="Waka Kurikulum" data-unit="Kurikulum" data-filter="kurikulum" data-detail="waka-kurikulum">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/melati.png') }}" alt="Foto MELATI PUSPITA SARI, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-book-open"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Waka Kurikulum</h3>
              <div class="so-card-person">MELATI PUSPITA SARI, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Waka Kurikulum</div>
              <p class="so-card-unit">Perencanaan dan pengelolaan bidang kurikulum.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="AINUR ROFIK, M. Pd, Si." data-role="Waka Kesiswaan" data-unit="Kesiswaan" data-filter="kesiswaan" data-detail="waka-kesiswaan">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/ainur.png') }}" alt="Foto AINUR ROFIK, M. Pd, Si." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-users"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Waka Kesiswaan</h3>
              <div class="so-card-person">AINUR ROFIK, M. Pd, Si.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Waka Kesiswaan</div>
              <p class="so-card-unit">Pembinaan dan layanan peserta didik.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="M. WIRA HENDY HIMAWAN, M.Pd" data-role="Waka Sarana & Prasarana" data-unit="Sarana & Prasarana" data-filter="sapras" data-detail="waka-sapras">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/wira.png') }}" alt="Foto M. WIRA HENDY HIMAWAN, M.Pd" loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-building"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Waka Sarana & Prasarana</h3>
              <div class="so-card-person">M. WIRA HENDY HIMAWAN, M.Pd</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Waka Sarana & Prasarana</div>
              <p class="so-card-unit">Pengelolaan sarana, prasarana, dan fasilitas sekolah.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="ARIKAWWEKU CKRISNA, S.Pd." data-role="Waka Humastri" data-unit="Humastri" data-filter="humas" data-detail="waka-humas">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/arikawweku.png') }}" alt="Foto ARIKAWWEKU CKRISNA, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-handshake"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Waka Humastri</h3>
              <div class="so-card-person">ARIKAWWEKU CKRISNA, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Waka Humastri</div>
              <p class="so-card-unit">Hubungan sekolah dengan masyarakat dan dunia industri.</p>
            </article>
          </div>
        </div>

        {{-- ===== LEVEL 3: BENDAHARA, KETUA KOMPETENSI KEAHLIAN & KOORDINATOR ===== --}}
        <div class="so-level so-anchor" id="level-3" data-level="3">
          <div class="so-level-head">
            <span class="so-level-badge"><i class="fas fa-layer-group"></i> Level 3 &mdash; Unit Pelaksana &amp; Koordinator</span>
            <span class="so-level-rule"></span>
          </div>
          <div class="so-grid cols-5">
            <article class="so-card" tabindex="0" data-name="MEGA NOVINDA SARI, S.Pd." data-role="Bendahara BOS" data-unit="Keuangan" data-filter="keuangan" data-detail="bendahara-bos">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/mega.png') }}" alt="Foto MEGA NOVINDA SARI, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-money-bill-wave"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Bendahara BOS</h3>
              <div class="so-card-person">MEGA NOVINDA SARI, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Bendahara BOS</div>
              <p class="so-card-unit">Pengelolaan administrasi dan keuangan BOS sekolah.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="FAJAR DHILAMAYA, S.Pd." data-role="Bendahara BPOPP" data-unit="Keuangan" data-filter="keuangan" data-detail="bendahara-bpopp">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/fajar.png') }}" alt="Foto FAJAR DHILAMAYA, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-wallet"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Bendahara BPOPP</h3>
              <div class="so-card-person">FAJAR DHILAMAYA, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Bendahara BPOPP</div>
              <p class="so-card-unit">Pengelolaan administrasi dan keuangan BPOPP.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="DANANG TEGUH SANTOSO, S.Kom" data-role="Ketua Kompetensi Keahlian RPL" data-unit="Kompetensi Keahlian RPL" data-filter="keahlian" data-detail="kk-rpl">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/danang.png') }}" alt="Foto DANANG TEGUH SANTOSO, S.Kom" loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-code"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Ketua Kompetensi Keahlian RPL</h3>
              <div class="so-card-person">DANANG TEGUH SANTOSO, S.Kom</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Ketua Kompetensi Keahlian RPL</div>
              <p class="so-card-unit">Koordinasi pembelajaran dan pengembangan kompetensi RPL.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="DESY ANDINI DILIAWATI, S.T.P." data-role="Ketua Kompetensi Keahlian APHP" data-unit="Kompetensi Keahlian APHP" data-filter="keahlian" data-detail="kk-aphp">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/desy.png') }}" alt="Foto DESY ANDINI DILIAWATI, S.T.P." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-seedling"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Ketua Kompetensi Keahlian APHP</h3>
              <div class="so-card-person">DESY ANDINI DILIAWATI, S.T.P.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Ketua Kompetensi Keahlian APHP</div>
              <p class="so-card-unit">Koordinasi pembelajaran dan pengembangan kompetensi APHP.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="NURFALAH SEPTAYOGA S.Kom." data-role="Ketua Kompetensi Keahlian DKV" data-unit="Kompetensi Keahlian DKV" data-filter="keahlian" data-detail="kk-dkv">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/nurfalah.png') }}" alt="Foto NURFALAH SEPTAYOGA S.Kom." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-palette"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Ketua Kompetensi Keahlian DKV</h3>
              <div class="so-card-person">NURFALAH SEPTAYOGA S.Kom.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Ketua Kompetensi Keahlian DKV</div>
              <p class="so-card-unit">Koordinasi pembelajaran dan pengembangan kompetensi DKV.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="METIY ARIANA, S.Pd, M.Pd." data-role="Ketua Kompetensi Keahlian LPS" data-unit="Kompetensi Keahlian LPS" data-filter="keahlian" data-detail="kk-lps">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/metiy.png') }}" alt="Foto METIY ARIANA, S.Pd, M.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-landmark"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Ketua Kompetensi Keahlian LPS</h3>
              <div class="so-card-person">METIY ARIANA, S.Pd, M.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Ketua Kompetensi Keahlian LPS</div>
              <p class="so-card-unit">Koordinasi pembelajaran dan pengembangan kompetensi LPS.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="DHIYAH AMANATI KARTIKA SARI, S.Pd." data-role="Ketua Kompetensi Keahlian Kuliner" data-unit="Kompetensi Keahlian Kuliner" data-filter="keahlian" data-detail="kk-kuliner">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/dhiyah.png') }}" alt="Foto DHIYAH AMANATI KARTIKA SARI, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-utensils"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Ketua Kompetensi Keahlian Kuliner</h3>
              <div class="so-card-person">DHIYAH AMANATI KARTIKA SARI, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Ketua Kompetensi Keahlian Kuliner</div>
              <p class="so-card-unit">Koordinasi pembelajaran dan pengembangan kompetensi kuliner.</p>
            </article>
            <article class="so-card" tabindex="0" data-name="MULAT ADITYAWIRANTI, S.Pd." data-role="Koordinator BKK" data-unit="BKK / Humastri" data-filter="humas" data-detail="koordinator-bkk">
              <div class="so-feed-head">
                <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
                <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
                <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
              </div>
              <div class="so-photo-wrap">
                <span class="so-photo-ring" aria-hidden="true"></span>
                <div class="so-photo"><img src="{{ asset('images/struktur/mulat.png') }}" alt="Foto MULAT ADITYAWIRANTI, S.Pd." loading="lazy"></div>
                <span class="so-photo-tag"><i class="fas fa-briefcase"></i></span>
              </div>
              <div class="so-feed-actions" aria-label="Interaksi postingan">
                <i class="far fa-heart" aria-hidden="true"></i>
                <i class="far fa-comment" aria-hidden="true"></i>
                <i class="far fa-paper-plane" aria-hidden="true"></i>
                <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
              </div>
              <h3 class="so-card-name">Koordinator BKK</h3>
              <div class="so-card-person">MULAT ADITYAWIRANTI, S.Pd.</div>
              <div class="so-card-role"><i class="fas fa-briefcase"></i> Koordinator BKK</div>
              <p class="so-card-unit">Koordinasi layanan BKK dan penyaluran lulusan.</p>
            </article>
          </div>
        </div>

      </div>

    </div>
  </section>



  <!-- VIRTUAL TOUR 360 — SAMA PERSIS DENGAN HALAMAN SEJARAH -->
  <section class="vt-section" id="virtual-tour" aria-label="Virtual Tour 360 SMK Negeri 2 Mojokerto">
    <span class="vt-watermark" aria-hidden="true">360°</span>
    <div class="vt-decor-ring" aria-hidden="true"></div>
    <div class="vt-decor-dots" aria-hidden="true"></div>
    <div class="vt-inner">
      <div class="vt-media" data-reveal="left">
        <div class="vt-frame">
          <img src="{{ asset('images/hero-sekolah.jpg') }}" alt="Lingkungan SMK Negeri 2 Mojokerto — Virtual Tour 360 derajat" loading="lazy">
          <span class="vt-badge"><i class="fa-solid fa-street-view"></i> 360° Tour</span>
          <button class="vt-play" type="button" aria-label="Mulai Virtual Tour 360 derajat" onclick="document.getElementById('vtTourLink')?.click()"><i class="fa-solid fa-play"></i></button>
          <div class="vt-caption">
            <div><strong>Jelajahi Sekolah</strong><span>SMK Negeri 2 Mojokerto</span></div>
            <span class="vt-cam"><i class="fa-solid fa-camera"></i> 360°</span>
          </div>
        </div>
        <div class="vt-chip"><i class="fa-solid fa-compass"></i><div><strong>Virtual Tour 360°</strong><span>Interactive Campus Experience</span></div></div>
      </div>
      <div class="vt-copy">
        <div class="vt-kicker" data-reveal>Virtual Experience</div>
        <h2 class="vt-title" data-reveal>Jelajahi <span class="vt-gold">SMKN 2 Mojokerto</span><span class="vt-sub">Lihat Virtual Tour 360°</span></h2>
        <p class="vt-desc" data-reveal>Jelajahi lingkungan SMK Negeri 2 Mojokerto secara interaktif melalui Virtual Tour 360°. Rasakan suasana sekolah dari sudut pandangmu dan lihat fasilitas sekolah secara lebih dekat.</p>
        <div class="vt-feats" data-reveal><span class="vt-feat"><i class="fa-solid fa-check"></i> Interaktif</span><span class="vt-feat"><i class="fa-solid fa-check"></i> Panorama 360°</span><span class="vt-feat"><i class="fa-solid fa-check"></i> Akses Mudah</span></div>
        <a href="#" id="vtTourLink" class="vt-btn" data-reveal>Mulai Virtual Tour <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </section>

  <!-- PERAN & TUGAS -->
  <div class="so-sec-head so-sec-head-mid" data-reveal>
    <div class="eyebrow">Alur Kerja Sekolah</div>
    <h2 class="big-heading">BAGAIMANA <span>SEKOLAH BEKERJA.</span></h2>
    <p class="so-sec-desc">Setiap bagian memiliki peran yang saling melengkapi — dari perencanaan kebijakan hingga layanan langsung kepada siswa.</p>
  </div>

  <div class="so-roles" data-reveal>
    <div class="so-role-card">
      <div class="so-role-icon"><i class="fas fa-flag-checkered"></i></div>
      <h4>Pimpinan Menetapkan Arah</h4>
      <p>Kepala Sekolah merumuskan kebijakan, program, dan target mutu sekolah, serta memimpin seluruh sumber daya menuju visi “SMK unggul, berkarakter, dan berdaya saing”.</p>
    </div>

    <div class="so-role-card">
      <div class="so-role-icon"><i class="fas fa-diagram-project"></i></div>
      <h4>Wakil Kepala Mengelola</h4>
      <p>Empat wakil kepala sekolah menerjemahkan kebijakan menjadi program kerja nyata di bidang kurikulum, kesiswaan, sarana prasarana, serta humas &amp; industri.</p>
    </div>

    <div class="so-role-card">
      <div class="so-role-icon is-gold"><i class="fas fa-graduation-cap"></i></div>
      <h4>KK &amp; GTK Melayani Siswa</h4>
      <p>Kompetensi keahlian, guru, dan tenaga kependidikan berada di garda terdepan: mengajar, membimbing, dan melayani peserta didik setiap hari.</p>
    </div>
  </div>

  <!-- CTA PENUTUP -->
  <div class="so-cta" data-reveal>
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="so-cta-inner">
      <h3>Ingin mengenal lebih dekat <span>keluarga besar sekolah?</span></h3>
      <p>Kenali para pendidik dan tenaga kependidikan yang membimbing siswa setiap harinya.</p>
      <a href="{{ route('profil.guru-staf') }}" class="so-cta-btn">
        Lihat Guru &amp; Staf <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div>

  <!-- MODAL DETAIL JABATAN -->
  <div class="so-modal-overlay" id="soModalOverlay" role="dialog" aria-modal="true" aria-labelledby="soModalTitle">
    <div class="so-modal" id="soModal">
      <button class="so-modal-close" id="soModalClose" aria-label="Tutup"><i class="fas fa-xmark"></i></button>
      <div class="so-modal-head">
        <div class="so-modal-avatar" id="soModalAvatar"><i class="fas fa-user-tie"></i></div>
        <div class="so-modal-name" id="soModalTitle">Kepala Sekolah</div>
        <div class="so-modal-role" id="soModalRole"><i class="fas fa-star"></i> Pimpinan Sekolah</div>
      </div>
      <div class="so-modal-body">
        <div class="so-modal-section">
          <div class="so-modal-label"><i class="fas fa-tags"></i> Bidang / Unit</div>
          <div class="so-modal-tags" id="soModalTags"></div>
        </div>
        <div class="so-modal-section">
          <div class="so-modal-label"><i class="fas fa-list-check"></i> Tugas &amp; Tanggung Jawab</div>
          <ul class="so-modal-tasks" id="soModalTasks"></ul>
        </div>
        <div class="so-modal-section">
          <div class="so-modal-label"><i class="fas fa-circle-info"></i> Catatan</div>
          <div class="so-modal-note" id="soModalNote"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

{{-- CSS foto di modal. Tidak mengubah tampilan lain. --}}
@push('styles')
<style>
.so-modal-avatar.has-photo{width:112px;height:112px;border-radius:50%;transform:none;overflow:hidden;
  border:4px solid rgba(255,255,255,.85);background:#dbe9f5}
.so-modal-avatar.has-photo img{width:100%;height:100%;object-fit:cover;object-position:center top;display:block}
</style>
@endpush

@push('scripts')
<script>
(function(){
  'use strict';

  /* ================= DATA JABATAN =================
     Kalau paket admin menyediakan window.SO_DATA, itu yang dipakai.
     Kalau tidak, pakai data bawaan di bawah (sama seperti file asli). */
  var FALLBACK_DATA = {
    'kepsek': {
      name: 'Kepala Sekolah',
      role: 'Pimpinan Sekolah',
      unit: 'Pimpinan Sekolah',
      avatar: 'fas fa-user-tie',
      gold: false,
      tags: ['Pimpinan Sekolah'],
      tasks: [
        'Memimpin dan mengarahkan penyelenggaraan pendidikan sekolah.',
        'Menetapkan kebijakan, program kerja, dan target mutu sekolah.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'waka-kurikulum': {
      name: 'MELATI PUSPITA SARI, S.Pd.',
      role: 'Waka Kurikulum',
      unit: 'Kurikulum',
      avatar: 'fas fa-book-open',
      gold: false,
      tags: ['Kurikulum'],
      tasks: [
        'Mengelola dan mengoordinasikan pelaksanaan kurikulum sekolah.',
        'Mengatur program pembelajaran dan administrasi kurikulum.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'waka-kesiswaan': {
      name: 'AINUR ROFIK, M. Pd, Si.',
      role: 'Waka Kesiswaan',
      unit: 'Kesiswaan',
      avatar: 'fas fa-users',
      gold: false,
      tags: ['Kesiswaan'],
      tasks: [
        'Mengoordinasikan pembinaan peserta didik dan kegiatan kesiswaan.',
        'Mendukung pelaksanaan program pengembangan karakter siswa.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'waka-sapras': {
      name: 'M. WIRA HENDY HIMAWAN, M.Pd',
      role: 'Waka Sarana & Prasarana',
      unit: 'Sarana & Prasarana',
      avatar: 'fas fa-building',
      gold: false,
      tags: ['Sarana & Prasarana'],
      tasks: [
        'Mengoordinasikan pengelolaan sarana dan prasarana sekolah.',
        'Memastikan fasilitas pendukung pembelajaran tersedia dan terawat.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'waka-humas': {
      name: 'ARIKAWWEKU CKRISNA, S.Pd.',
      role: 'Waka Humastri',
      unit: 'Humastri',
      avatar: 'fas fa-handshake',
      gold: false,
      tags: ['Humastri'],
      tasks: [
        'Mengoordinasikan hubungan sekolah dengan masyarakat dan dunia industri.',
        'Mengembangkan kerja sama dan kemitraan sekolah.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'bendahara-bos': {
      name: 'MEGA NOVINDA SARI, S.Pd.',
      role: 'Bendahara BOS',
      unit: 'Keuangan',
      avatar: 'fas fa-money-bill-wave',
      gold: false,
      tags: ['Keuangan'],
      tasks: [
        'Mengelola administrasi dan pertanggungjawaban dana BOS.',
        'Menyiapkan pencatatan serta laporan keuangan sesuai ketentuan.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'bendahara-bpopp': {
      name: 'FAJAR DHILAMAYA, S.Pd.',
      role: 'Bendahara BPOPP',
      unit: 'Keuangan',
      avatar: 'fas fa-wallet',
      gold: false,
      tags: ['Keuangan'],
      tasks: [
        'Mengelola administrasi dan pertanggungjawaban dana BPOPP.',
        'Menyiapkan pencatatan serta laporan keuangan sesuai ketentuan.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'kk-rpl': {
      name: 'DANANG TEGUH SANTOSO, S.Kom',
      role: 'Ketua Kompetensi Keahlian RPL',
      unit: 'Kompetensi Keahlian RPL',
      avatar: 'fas fa-code',
      gold: false,
      tags: ['Kompetensi Keahlian RPL'],
      tasks: [
        'Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian RPL.',
        'Mengembangkan kompetensi siswa sesuai kebutuhan bidang perangkat lunak.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'kk-aphp': {
      name: 'DESY ANDINI DILIAWATI, S.T.P.',
      role: 'Ketua Kompetensi Keahlian APHP',
      unit: 'Kompetensi Keahlian APHP',
      avatar: 'fas fa-seedling',
      gold: false,
      tags: ['Kompetensi Keahlian APHP'],
      tasks: [
        'Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian APHP.',
        'Mengembangkan kompetensi siswa dalam pengolahan hasil pertanian.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'kk-dkv': {
      name: 'NURFALAH SEPTAYOGA S.Kom.',
      role: 'Ketua Kompetensi Keahlian DKV',
      unit: 'Kompetensi Keahlian DKV',
      avatar: 'fas fa-palette',
      gold: false,
      tags: ['Kompetensi Keahlian DKV'],
      tasks: [
        'Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian DKV.',
        'Mengembangkan kompetensi siswa dalam bidang desain komunikasi visual.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'kk-lps': {
      name: 'METIY ARIANA, S.Pd, M.Pd.',
      role: 'Ketua Kompetensi Keahlian LPS',
      unit: 'Kompetensi Keahlian LPS',
      avatar: 'fas fa-landmark',
      gold: false,
      tags: ['Kompetensi Keahlian LPS'],
      tasks: [
        'Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian LPS.',
        'Mengembangkan kompetensi siswa dalam layanan perbankan syariah.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'kk-kuliner': {
      name: 'DHIYAH AMANATI KARTIKA SARI, S.Pd.',
      role: 'Ketua Kompetensi Keahlian Kuliner',
      unit: 'Kompetensi Keahlian Kuliner',
      avatar: 'fas fa-utensils',
      gold: false,
      tags: ['Kompetensi Keahlian Kuliner'],
      tasks: [
        'Mengoordinasikan pelaksanaan pembelajaran kompetensi keahlian Kuliner.',
        'Mengembangkan kompetensi siswa dalam bidang kuliner dan tata boga.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    },
    'koordinator-bkk': {
      name: 'MULAT ADITYAWIRANTI, S.Pd.',
      role: 'Koordinator BKK',
      unit: 'BKK / Humastri',
      avatar: 'fas fa-briefcase',
      gold: false,
      tags: ['BKK / Humastri'],
      tasks: [
        'Mengoordinasikan layanan Bursa Kerja Khusus (BKK).',
        'Mendukung penyaluran lulusan dan hubungan dengan dunia kerja.',
      ],
      note: 'Data disesuaikan dengan struktur organisasi resmi yang diberikan.'
    }
  };
  var DATA = window.SO_DATA || FALLBACK_DATA;

  /* ================= ELEMEN ================= */
  var cards = Array.prototype.slice.call(document.querySelectorAll('.so-card'));
  var overlay = document.getElementById('soModalOverlay');
  var modal = document.getElementById('soModal');
  var searchInput = document.getElementById('soSearchInput');
  var chips = Array.prototype.slice.call(document.querySelectorAll('.so-fchip'));
  var emptyBox = document.getElementById('soEmpty');
  var eraPills = Array.prototype.slice.call(document.querySelectorAll('.so-nav-pill'));

  /* ================= PILL NAVIGASI LEVEL (scroll spy) ================= */
  var levels = Array.prototype.slice.call(document.querySelectorAll('.so-level'));
  if(eraPills.length && levels.length){
    var levelMap = {};
    eraPills.forEach(function(p){ levelMap[p.getAttribute('data-target')] = p; });
    var levelObs = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          eraPills.forEach(function(p){ p.classList.remove('is-active'); });
          var pill = levelMap[entry.target.id];
          if(pill) pill.classList.add('is-active');
        }
      });
    }, { rootMargin: '-30% 0px -55% 0px', threshold: 0 });
    levels.forEach(function(l){ levelObs.observe(l); });
  }

  /* ================= MODAL ================= */
  function toggleSection(el, show){
    var sec = el && el.closest ? el.closest('.so-modal-section') : null;
    if(sec) sec.style.display = show ? '' : 'none';
  }

  function openModal(key, card){
    var d = DATA[key];
    if(!d) return;

    var icon = d.avatar || 'fas fa-user-tie';

    /* Foto: dari data kalau ada, kalau tidak ambil dari foto di kartu */
    var photo = d.photo || d.image || d.img || '';
    if(!photo && card){
      var cardImg = card.querySelector('.so-photo img');
      if(cardImg) photo = cardImg.getAttribute('src') || '';
    }

    document.getElementById('soModalTitle').textContent = d.name || '';
    var roleEl = document.getElementById('soModalRole');
    roleEl.innerHTML = '<i class="' + icon + '"></i> ';
    roleEl.appendChild(document.createTextNode(d.role || ''));

    var avatar = document.getElementById('soModalAvatar');
    avatar.innerHTML = '';
    if(photo){
      var img = document.createElement('img');
      img.src = photo;
      img.alt = 'Foto ' + (d.name || '');
      img.onerror = function(){
        avatar.classList.remove('has-photo');
        avatar.innerHTML = '<i class="' + icon + '"></i>';
      };
      avatar.appendChild(img);
      avatar.classList.add('has-photo');
    } else {
      avatar.classList.remove('has-photo');
      avatar.innerHTML = '<i class="' + icon + '"></i>';
    }
    avatar.classList.toggle('is-gold', !!d.gold);

    var tags = document.getElementById('soModalTags');
    tags.innerHTML = '';
    var tagList = Array.isArray(d.tags) ? d.tags.filter(Boolean) : [];
    tagList.forEach(function(t){
      var span = document.createElement('span');
      span.className = 'so-tag' + (d.gold ? ' is-gold' : '');
      span.textContent = t;
      tags.appendChild(span);
    });
    toggleSection(tags, tagList.length > 0);

    var tasks = document.getElementById('soModalTasks');
    tasks.innerHTML = '';
    var taskList = Array.isArray(d.tasks) ? d.tasks.filter(Boolean) : [];
    taskList.forEach(function(t){
      var li = document.createElement('li');
      li.innerHTML = '<i class="fas fa-check"></i><span></span>';
      li.querySelector('span').textContent = t;
      tasks.appendChild(li);
    });
    toggleSection(tasks, taskList.length > 0);

    var noteEl = document.getElementById('soModalNote');
    if(d.note){
      noteEl.innerHTML = '<i class="fas fa-circle-info"></i><span></span>';
      noteEl.querySelector('span').textContent = d.note;
    } else {
      noteEl.innerHTML = '';
    }
    toggleSection(noteEl, !!d.note);

    overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
    document.querySelector('.so-modal-close').focus();
  }
  function closeModal(){
    overlay.classList.remove('open');
    document.body.style.overflow = '';
  }
  cards.forEach(function(card){
    card.addEventListener('click', function(){ openModal(card.getAttribute('data-detail'), card); });
    card.addEventListener('keydown', function(e){
      if(e.key === 'Enter' || e.key === ' '){ e.preventDefault(); openModal(card.getAttribute('data-detail'), card); }
    });
  });
  document.getElementById('soModalClose').addEventListener('click', closeModal);
  overlay.addEventListener('click', function(e){ if(e.target === overlay) closeModal(); });
  document.addEventListener('keydown', function(e){ if(e.key === 'Escape') closeModal(); });

  /* ================= SEARCH + FILTER ================= */
  function applyFilter(){
    var q = (searchInput.value || '').toLowerCase().trim();
    var activeFilter = '*';
    chips.forEach(function(c){ if(c.classList.contains('is-active')) activeFilter = c.getAttribute('data-filter'); });
    var visibleCount = 0;
    cards.forEach(function(card){
      var text = (card.getAttribute('data-name') + ' ' + card.getAttribute('data-role') + ' ' + card.getAttribute('data-unit')).toLowerCase();
      var matchFilter = (activeFilter === '*') || (card.getAttribute('data-filter') === activeFilter);
      var matchQuery = !q || text.indexOf(q) !== -1;
      if(matchFilter && matchQuery){
        card.classList.remove('is-hidden');
        card.classList.toggle('is-match', !!q);
        visibleCount++;
      } else {
        card.classList.add('is-hidden');
      }
    });
    emptyBox.classList.toggle('show', visibleCount === 0);
  }
  searchInput.addEventListener('input', applyFilter);
  chips.forEach(function(chip){
    chip.addEventListener('click', function(){
      chips.forEach(function(c){ c.classList.remove('is-active'); });
      chip.classList.add('is-active');
      applyFilter();
    });
  });
})();

  /* ---- Scroll Reveal (senada Sejarah Sekolah) ---- */
  (function () {
    var revealEls = document.querySelectorAll('[data-reveal]');
    if (!('IntersectionObserver' in window)) {
      revealEls.forEach(function (el) { el.classList.add('revealed'); });
      return;
    }
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add('revealed'); obs.unobserve(e.target); }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
    revealEls.forEach(function (el) { obs.observe(el); });

    var pending = Array.prototype.slice.call(revealEls);
    var checks = 0;
    var iv = setInterval(function () {
      checks++;
      var vh = window.innerHeight;
      pending = pending.filter(function (el) {
        if (el.classList.contains('revealed')) return false;
        var r = el.getBoundingClientRect();
        if (r.top < vh + 220 && r.bottom > -40) { el.classList.add('revealed'); return false; }
        return true;
      });
      if (checks >= 8) {
        pending.forEach(function (el) { el.classList.add('revealed'); });
        clearInterval(iv);
      } else if (pending.length === 0) {
        clearInterval(iv);
      }
    }, 450);
  })();
</script>
@endpush