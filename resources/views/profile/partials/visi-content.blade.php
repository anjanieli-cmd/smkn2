{{--
  Isi halaman Visi & Misi — semua teks/kartu dibaca dari database (diatur di admin).
  CSS dan script tetap ada di resources/views/profile/visi.blade.php (file lama kamu).
--}}
@php
  $vm     = \App\Support\VisiMisiContent::get();
  $s      = $vm['s'];
  $tags   = $vm['tags'];
  $misi   = $vm['misi'];
  $tujuan = $vm['tujuan'];
  $nilai  = $vm['nilai'];
@endphp

<div class="visi-page">
  <!-- HERO -->
  <section class="visi-hero">
    <div class="hero-ornament" aria-hidden="true">
      <img src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}" alt="">
    </div>

    <div class="visi-hero-inner">
      <div class="visi-hero-copy" data-reveal>
        @if($s['hero_kicker'] !== '')
          <div class="visi-kicker">{{ $s['hero_kicker'] }}</div>
        @endif
        <h1 class="visi-title">
          <span class="visi-white">{{ $s['hero_title_1'] }}</span>
          <span class="visi-gold">{{ $s['hero_title_2'] }}</span>
        </h1>
        @if($s['hero_lead'] !== '')
          <p class="visi-lead">{{ $s['hero_lead'] }}</p>
        @endif
        <div class="visi-hero-meta">
          @if($s['hero_pill_1'] !== '')<span class="visi-pill"><i class="fas fa-bullseye"></i> {{ $s['hero_pill_1'] }}</span>@endif
          @if($s['hero_pill_2'] !== '')<span class="visi-pill"><i class="fas fa-flag"></i> {{ $s['hero_pill_2'] }}</span>@endif
          @if($s['hero_pill_3'] !== '')<span class="visi-pill"><i class="fas fa-gem"></i> {{ $s['hero_pill_3'] }}</span>@endif
        </div>
      </div>
    </div>
  </section>

  <!-- VISI -->
  <section class="visi-section">
    @include('profile.partials.visi-orn')

    <div class="visi-card" data-reveal>
      <div class="visi-card-inner">
        <div class="visi-card-icon"><i class="fas fa-eye"></i></div>
        <div class="eyebrow">Visi Sekolah</div>
        <p class="visi-statement">&ldquo;{{ \App\Support\VisiMisiContent::em($s['visi_statement']) }}&rdquo;</p>
        @if(count($tags))
          <div class="visi-tags">
            @foreach($tags as $tag)
              <span class="visi-tag"><i class="fas fa-check"></i> {{ $tag }}</span>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </section>

  <!-- MISI -->
  @if($misi->isNotEmpty())
  <section class="misi-section">
    @include('profile.partials.visi-orn')

    <div class="misi-head" data-reveal>
      <div>
        <div class="eyebrow">{{ $s['misi_eyebrow'] }} <span class="eyebrow-dots"><i class="fas fa-circle"></i><i class="fas fa-circle"></i><i class="fas fa-circle"></i></span></div>
        <h2 class="big-heading">{{ $s['misi_heading'] }} <span>{{ $s['misi_heading_gold'] }}</span></h2>
      </div>
      @if($s['misi_desc'] !== '')<p class="misi-desc">{{ $s['misi_desc'] }}</p>@endif
    </div>

    <div class="misi-grid">
      @foreach($misi as $m)
        <article class="misi-card" data-reveal style="--d:{{ $loop->index % 3 }}">
          <span class="misi-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
          <div class="misi-icon"><i class="fas {{ $m->icon ?: 'fa-star' }}"></i></div>
          <h3 class="misi-title">{{ $m->title }}</h3>
          @if($m->text)<p class="misi-text">{{ $m->text }}</p>@endif
        </article>
      @endforeach
    </div>
  </section>
  @endif

  <!-- TUJUAN -->
  @if($tujuan->isNotEmpty())
  <section class="tujuan-section">
    @include('profile.partials.visi-orn')

    <div class="tujuan-inner">
      <div data-reveal>
        <div class="eyebrow">{{ $s['tujuan_eyebrow'] }}</div>
        <h2 class="big-heading">{{ $s['tujuan_heading'] }} <span>{{ $s['tujuan_heading_gold'] }}</span></h2>
      </div>
      <div class="tujuan-grid">
        @foreach($tujuan as $t)
          <div class="tujuan-card" data-reveal style="--d:{{ $loop->index % 4 }}">
            <div class="tujuan-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
            <div class="tujuan-title">{{ $t->title }}</div>
            @if($t->text)<p class="tujuan-text">{{ $t->text }}</p>@endif
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- NILAI -->
  @if($nilai->isNotEmpty())
  <section class="nilai-section">
    @include('profile.partials.visi-orn')

    <div class="nilai-head" data-reveal>
      <div>
        <div class="eyebrow">{{ $s['nilai_eyebrow'] }} <span class="eyebrow-dots"><i class="fas fa-circle"></i><i class="fas fa-circle"></i><i class="fas fa-circle"></i></span></div>
        <h2 class="big-heading">{{ $s['nilai_heading'] }} <span>{{ $s['nilai_heading_gold'] }}</span></h2>
      </div>
      @if($s['nilai_desc'] !== '')<p class="misi-desc">{{ $s['nilai_desc'] }}</p>@endif
    </div>

    <div class="nilai-grid">
      @foreach($nilai as $n)
        <article class="nilai-card" data-reveal style="--d:{{ $loop->index % 3 }}">
          <div class="nilai-top">
            <div class="nilai-icon"><i class="fas {{ $n->icon ?: 'fa-star' }}"></i></div>
            <span class="nilai-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
          </div>
          <h3 class="nilai-title">{{ $n->title }}</h3>
          @if($n->text)<p class="nilai-text">{{ $n->text }}</p>@endif
        </article>
      @endforeach
    </div>
  </section>
  @endif

  <!-- CTA -->
  <section class="visi-cta">
    @include('profile.partials.visi-orn')

    <div class="visi-cta-inner" data-reveal>
      <h2>{{ $s['cta_title'] }} @if($s['cta_title_gold'] !== '')<span>{{ $s['cta_title_gold'] }}</span>@endif</h2>
      @if($s['cta_text'] !== '')<p>{{ $s['cta_text'] }}</p>@endif
      <a href="{{ $vm['ctaUrl'] }}" class="visi-cta-btn"><i class="fas fa-graduation-cap"></i> {{ $s['cta_button_text'] }} <i class="fas fa-arrow-right"></i></a>
    </div>
  </section>
</div>
