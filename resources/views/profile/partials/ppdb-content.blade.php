{{--
  Isi halaman PPDB — semua teks, daftar, dan foto dibaca dari database (diatur di admin).
  CSS dan script (scroll-reveal, FAQ accordion) tetap ada di file halaman PPDB lamamu.
  Markup & class sama persis dengan versi sebelumnya, jadi tampilan tidak berubah.
--}}
@php
  $pp    = \App\Support\PpdbContent::get();
  $s     = $pp['s'];
  $items = $pp['items'];
  $get   = fn (string $section) => $items->get($section, collect());
@endphp

<div class="pd-page">

  <!-- HERO -->
  <section class="pd-hero">
    <div class="pd-ref-ornaments" aria-hidden="true" style="background-image:url('{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}');background-size:cover;background-position:center center;">
      <img
        src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}"
        alt=""
        class="pd-ref-ornament-image"
        aria-hidden="true"
      >
    </div>
    <div class="pd-hero-inner">
      <div>
        @if($s['hero_kicker'] !== '')<div class="pd-kicker">{{ $s['hero_kicker'] }}</div>@endif
        <h1 class="pd-title">
          <span class="pd-white">{{ $s['hero_title_1'] }}</span>
          <span class="pd-gold">{{ $s['hero_title_2'] }}</span>
        </h1>
      </div>
    </div>
  </section>

  <!-- 1. PENGERTIAN PPDB -->
  <section class="pd-intro">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>

    <div class="pd-section pd-intro-grid">
      <div data-reveal="left">
        <h2 class="big-heading">{{ $s['intro_heading'] }} @if($s['intro_heading_gold'] !== '')<span>{{ $s['intro_heading_gold'] }}</span>@endif</h2>
        @if($s['intro_note'] !== '')<p class="pd-intro-note">{{ $s['intro_note'] }}</p>@endif

        <div class="pd-def-stack" style="margin-top:2rem">
          @foreach($get('definisi') as $it)
            <div class="pd-def-row" data-reveal>
              <div class="pd-def-index">{{ $loop->iteration }}</div>
              <div class="pd-def-text">
                <h3>{{ $it->title }}</h3>
                @if($it->text)<p>{{ $it->text }}</p>@endif
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <div data-reveal="right">
        <div class="pd-banner">
          <img src="{{ $pp['banner'] }}" alt="Banner PPDB SMK Negeri 2 Mojokerto" loading="eager">
          <div class="pd-banner-flag"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. JALUR PENDAFTARAN -->
  <section class="pd-track">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
    </div>

    <div class="pd-section">
      <div class="pd-track-head" data-reveal>
        <h2 class="big-heading">{{ $s['track_heading'] }} @if($s['track_heading_gold'] !== '')<span>{{ $s['track_heading_gold'] }}</span>@endif</h2>
        @if($s['track_note'] !== '')<p class="pd-track-note">{{ $s['track_note'] }}</p>@endif
      </div>

      <div class="pd-track-grid">
        @foreach($get('jalur') as $it)
          <div class="pd-track-card" data-reveal style="--d:{{ $loop->index }}">
            <span class="pd-track-no">{{ sprintf('%02d', $loop->iteration) }}</span>
            <div class="pd-track-icon"><i class="fas {{ $it->icon ?: 'fa-star' }}"></i></div>
            <h3 class="pd-track-name">{{ $it->title }}</h3>
            @if($it->label)<span class="pd-track-kuota">{{ $it->label }}</span>@endif
            @if($it->text)<p class="pd-track-text">{{ $it->text }}</p>@endif
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- 3. PERSYARATAN PENDAFTARAN -->
  <section class="pd-req">
    <div class="pd-section">
      <div class="pd-req-card" data-reveal>
        <h2 class="big-heading">{{ $s['req_heading'] }} @if($s['req_heading_gold'] !== '')<span>{{ $s['req_heading_gold'] }}</span>@endif</h2>
        <div class="pd-req-grid">
          @foreach($get('syarat') as $it)
            <div class="pd-req-item">
              <i class="fas {{ $it->icon ?: 'fa-star' }}"></i>
              <div><strong>{{ $it->title }}</strong>@if($it->text)<span>{{ $it->text }}</span>@endif</div>
            </div>
          @endforeach
        </div>
        @if($s['req_note'] !== '')
          <div class="pd-req-note">
            <i class="fas fa-info-circle"></i>
            <span>{{ $s['req_note'] }}</span>
          </div>
        @endif
      </div>
    </div>
  </section>

  <!-- 4. ALUR PENDAFTARAN (timeline) -->
  <section class="pd-flow">
    <div class="pd-section">
      <div data-reveal>
        <h2 class="big-heading">{{ $s['flow_heading'] }} @if($s['flow_heading_gold'] !== '')<span>{{ $s['flow_heading_gold'] }}</span>@endif</h2>
      </div>
      <div class="pd-flow-track">
        <div class="pd-flow-grid">
          @foreach($get('alur') as $it)
            <div class="pd-flow-step" data-reveal style="--d:{{ $loop->index }}">
              <div class="pd-flow-dot">{{ $loop->iteration }}</div>
              <h3 class="pd-flow-title">{{ $it->title }}</h3>
              @if($it->text)<p class="pd-flow-text">{{ $it->text }}</p>@endif
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <!-- 5. JADWAL PENTING PPDB -->
  <section class="pd-jadwal">
    <div class="pd-section">
      <div data-reveal>
        <h2 class="big-heading">{{ $s['jadwal_heading'] }} @if($s['jadwal_heading_gold'] !== '')<span>{{ $s['jadwal_heading_gold'] }}</span>@endif</h2>
      </div>

      <div class="pd-jadwal-card" data-reveal>
        <div class="pd-jadwal-head">
          <h3><i class="fas fa-calendar-check"></i> {{ $s['jadwal_title'] }}</h3>
          @if($s['jadwal_badge'] !== '')<span class="pd-jadwal-badge"><i class="fas fa-clock"></i> {{ $s['jadwal_badge'] }}</span>@endif
        </div>
        <table class="pd-jadwal-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Kegiatan</th>
              <th>Waktu</th>
            </tr>
          </thead>
          <tbody>
            @foreach($get('jadwal') as $it)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $it->title }}</td>
                <td>{{ $it->label }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        @if($s['jadwal_foot'] !== '')
          <div class="pd-jadwal-foot"><i class="fas fa-info-circle"></i> {{ $s['jadwal_foot'] }}</div>
        @endif
      </div>
    </div>
  </section>

  <!-- 6. PROGRAM KEAHLIAN -->
  <section class="pd-jurusan">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
    </div>

    <div class="pd-section">
      <div class="pd-track-head" data-reveal>
        <h2 class="big-heading">{{ $s['jurusan_heading'] }} @if($s['jurusan_heading_gold'] !== '')<span>{{ $s['jurusan_heading_gold'] }}</span>@endif</h2>
        @if($s['jurusan_note'] !== '')<p class="pd-track-note">{{ $s['jurusan_note'] }}</p>@endif
      </div>

      <div class="pd-jurusan-grid">
        @foreach($get('jurusan') as $it)
          <div class="pd-jurusan-card" data-reveal style="--d:{{ $loop->index }}">
            <div class="pd-jurusan-photo">
              @if($it->photo_url)<img src="{{ $it->photo_url }}" alt="{{ $it->title }}" loading="eager">@endif
            </div>
            <div class="pd-jurusan-body">
              @if($it->label)<span class="pd-jurusan-tag">{{ $it->label }}</span>@endif
              <h3 class="pd-jurusan-name">{{ $it->title }}</h3>
              @if($it->text)<p class="pd-jurusan-text">{{ $it->text }}</p>@endif
              <span class="pd-jurusan-more">Selengkapnya <i class="fas fa-arrow-right"></i></span>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- 7. FAQ -->
  <section class="pd-faq">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
    </div>

    <div class="pd-section">
      <div class="pd-track-head" data-reveal>
        <h2 class="big-heading">{{ $s['faq_heading'] }} @if($s['faq_heading_gold'] !== '')<span>{{ $s['faq_heading_gold'] }}</span>@endif</h2>
        @if($s['faq_note'] !== '')<p class="pd-track-note">{{ $s['faq_note'] }}</p>@endif
      </div>

      <div class="pd-faq-list" data-reveal>
        @foreach($get('faq') as $it)
          <div class="pd-faq-item {{ $loop->first ? 'open' : '' }}">
            <button class="pd-faq-q" type="button">{{ $it->title }} <i class="fas fa-chevron-down"></i></button>
            <div class="pd-faq-a"><p>{{ $it->text }}</p></div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="pd-cta">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span>
      <span class="ho-line"></span>
      <span class="ho-dots"></span>
      <span class="ho-ring"></span>
      <span class="ho-gold"></span>
      <span class="ho-square"></span>
      <span class="ho-corner"></span>
    </div>
    <h2>{{ $s['cta_title'] }} @if($s['cta_title_gold'] !== '')<em>{{ $s['cta_title_gold'] }}</em>@endif</h2>
    @if($s['cta_text'] !== '')<p>{{ $s['cta_text'] }}</p>@endif
    <a href="{{ $pp['ctaUrl'] }}" class="pd-cta-btn"><i class="fas fa-paper-plane"></i> {{ $s['cta_button_text'] }}</a>
    @if($s['cta_note'] !== '')<div class="pd-cta-note"><i class="fas fa-info-circle"></i> {{ $s['cta_note'] }}</div>@endif
  </section>

</div>
