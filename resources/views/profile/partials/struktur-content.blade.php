{{--
  Isi halaman Struktur Organisasi — semua teks, orang, dan foto dibaca dari database (diatur di admin).
  CSS dan script (search, filter, modal, scroll-reveal) tetap ada di
  resources/views/profile/struktur-organisasi.blade.php (file lama kamu).
--}}
@php
  $so      = \App\Support\StrukturContent::get();
  $s       = $so['s'];
  $levels  = $so['levels'];
  $chips   = $so['chips'];
  $roles   = $so['roles'];
  $lvlMeta = \App\Models\StrukturMember::LEVELS;
@endphp

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
          <span class="sejarah-white">{{ $s['hero_title_1'] }}</span>
          <span class="skaneda-gold">{{ $s['hero_title_2'] }}</span>
        </h3>
        <a class="history-vt-cta" href="#virtual-tour">
          <span class="history-vt-icon"><i class="fas fa-street-view"></i></span>
          <span>
            <strong>{{ $s['hero_vt_title'] }}</strong>
            @if($s['hero_vt_sub'] !== '')<small>{{ $s['hero_vt_sub'] }}</small>@endif
          </span>
          <i class="fas fa-arrow-right history-vt-arrow"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- SECTION BAGAN -->
  <section class="so-chart-section">
    @include('profile.partials.struktur-orn')

    <div class="so-wrap">
      <div class="so-sec-head" data-reveal>
        @if($s['chart_eyebrow'] !== '')<div class="eyebrow">{{ $s['chart_eyebrow'] }}</div>@endif
        <h2 class="big-heading">{{ $s['chart_heading'] }} @if($s['chart_heading_gold'] !== '')<span>{{ $s['chart_heading_gold'] }}</span>@endif</h2>
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
          @foreach($chips as $key => $label)
            <button class="so-fchip" data-filter="{{ $key }}">{{ $label }}</button>
          @endforeach
        </div>
      </div>

      <div class="so-empty" id="soEmpty">
        <i class="fas fa-magnifying-glass"></i>
        <strong>Tidak ditemukan</strong><br>
        Coba kata kunci atau bidang lain.
      </div>

      <div class="so-chart" id="soChart" data-reveal>
        @foreach($lvlMeta as $lvl => [$lvlLabel, $lvlIcon])
          @if($levels->has($lvl))
            <div class="so-level {{ $lvl === 1 ? 'so-level-root ' : '' }}so-anchor" id="level-{{ $lvl }}" data-level="{{ $lvl }}">
              <div class="so-level-head">
                <span class="so-level-badge"><i class="fas {{ $lvlIcon }}"></i> {{ $lvlLabel }}</span>
                <span class="so-level-rule"></span>
              </div>
              <div class="so-grid {{ $lvl === 3 ? 'cols-5' : '' }}">
                @foreach($levels[$lvl] as $m)
                  @include('profile.partials.struktur-card', ['m' => $m])
                @endforeach
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </section>

  <!-- VIRTUAL TOUR 360 -->
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
        @if($s['vt_kicker'] !== '')<div class="vt-kicker" data-reveal>{{ $s['vt_kicker'] }}</div>@endif
        <h2 class="vt-title" data-reveal>
          {{ $s['vt_title'] }}
          @if($s['vt_title_gold'] !== '')<span class="vt-gold">{{ $s['vt_title_gold'] }}</span>@endif
          @if($s['vt_sub'] !== '')<span class="vt-sub">{{ $s['vt_sub'] }}</span>@endif
        </h2>
        @if($s['vt_desc'] !== '')<p class="vt-desc" data-reveal>{{ $s['vt_desc'] }}</p>@endif
        <div class="vt-feats" data-reveal><span class="vt-feat"><i class="fa-solid fa-check"></i> Interaktif</span><span class="vt-feat"><i class="fa-solid fa-check"></i> Panorama 360°</span><span class="vt-feat"><i class="fa-solid fa-check"></i> Akses Mudah</span></div>
        <a href="{{ $so['vtUrl'] }}" id="vtTourLink" class="vt-btn" data-reveal>{{ $s['vt_button_text'] }} <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </section>

  <!-- PERAN & TUGAS (ALUR KERJA) -->
  @if($roles->isNotEmpty())
    <div class="so-sec-head so-sec-head-mid" data-reveal>
      @if($s['roles_eyebrow'] !== '')<div class="eyebrow">{{ $s['roles_eyebrow'] }}</div>@endif
      <h2 class="big-heading">{{ $s['roles_heading'] }} @if($s['roles_heading_gold'] !== '')<span>{{ $s['roles_heading_gold'] }}</span>@endif</h2>
      @if($s['roles_desc'] !== '')<p class="so-sec-desc">{{ $s['roles_desc'] }}</p>@endif
    </div>

    <div class="so-roles" data-reveal>
      @foreach($roles as $role)
        <div class="so-role-card">
          <div class="so-role-icon {{ $loop->last && $loop->count > 1 ? 'is-gold' : '' }}"><i class="fas {{ $role->icon ?: 'fa-star' }}"></i></div>
          <h4>{{ $role->title }}</h4>
          @if($role->text)<p>{{ $role->text }}</p>@endif
        </div>
      @endforeach
    </div>
  @endif

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
      <h3>{{ $s['cta_title'] }} @if($s['cta_title_gold'] !== '')<span>{{ $s['cta_title_gold'] }}</span>@endif</h3>
      @if($s['cta_text'] !== '')<p>{{ $s['cta_text'] }}</p>@endif
      <a href="{{ $so['ctaUrl'] }}" class="so-cta-btn">
        {{ $s['cta_button_text'] }} <i class="fas fa-arrow-right"></i>
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
        <div class="so-modal-section" id="soModalTagsSection">
          <div class="so-modal-label"><i class="fas fa-tags"></i> Bidang / Unit</div>
          <div class="so-modal-tags" id="soModalTags"></div>
        </div>
        <div class="so-modal-section" id="soModalTasksSection">
          <div class="so-modal-label"><i class="fas fa-list-check"></i> Tugas &amp; Tanggung Jawab</div>
          <ul class="so-modal-tasks" id="soModalTasks"></ul>
        </div>
        <div class="so-modal-section" id="soModalNoteSection">
          <div class="so-modal-label"><i class="fas fa-circle-info"></i> Catatan</div>
          <div class="so-modal-note" id="soModalNote"></div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Data modal dari database; dibaca script di halaman (var DATA = window.SO_DATA). --}}
<script>window.SO_DATA = @json($so['modal'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE);</script>
