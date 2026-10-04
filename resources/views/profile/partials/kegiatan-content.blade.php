{{--
  Isi halaman publik Kegiatan. Semua teks, album, sorotan, dan kalender
  berasal dari database (diatur lewat admin Kegiatan).
  Dipanggil dari resources/views/profile/kegiatan.blade.php
--}}
@php
  $k = \App\Support\KegiatanContent::get();
  $s = $k['s'];
  $statKeys = [1, 2, 3, 4];
  $hasStats = collect($statKeys)->contains(fn ($n) => trim($s["stat_{$n}_num"]) !== '');
  $json = fn ($v) => json_encode($v, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp

<div class="kg-page" id="kgPage">

<!-- ================= HERO ================= -->
<section class="kg-hero">
  <div class="kg-ref-ornaments" aria-hidden="true" style="background-image:url('{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}');background-size:cover;background-position:center center;">
    <img
      src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}"
      alt=""
      class="kg-ref-ornament-image"
      aria-hidden="true"
    >
  </div>
  <div class="kg-hero-inner">
    <div>
      @if(trim($s['hero_kicker']) !== '')
        <div class="kg-kicker">{{ $s['hero_kicker'] }}</div>
      @endif
      <h1 class="kg-title">
        <span class="kg-white">{{ $s['hero_title_1'] }}</span>
        <span class="kg-gold">{{ $s['hero_title_2'] }}</span>
      </h1>
      @if(trim($s['hero_lead']) !== '')
        <p class="kg-lead">{{ $s['hero_lead'] }}</p>
      @endif
      <div class="kg-hero-meta">
        @if(trim($s['hero_pill_1']) !== '')<span class="kg-pill"><i class="fas fa-camera"></i> {{ $s['hero_pill_1'] }}</span>@endif
        @if(trim($s['hero_pill_2']) !== '')<span class="kg-pill"><i class="fas fa-calendar-alt"></i> {{ $s['hero_pill_2'] }}</span>@endif
        @if(trim($s['hero_pill_3']) !== '')<span class="kg-pill"><i class="fas fa-users"></i> {{ $s['hero_pill_3'] }}</span>@endif
      </div>
    </div>
  </div>
</section>

<!-- ================= 1. AKTIVITAS SKANEDA (pembuka editorial) ================= -->
<section class="kg-sec" style="padding-bottom:clamp(2rem,4vw,3rem)">
  <div class="kg-orn" aria-hidden="true">
    <span class="ko-circle" style="right:4%;top:8%"></span>
    <span class="ko-dots" style="left:3%;bottom:6%"></span>
    <span class="ko-block" style="right:22%;top:18%"></span>
    <span class="ko-line" style="left:38%;top:0"></span>
  </div>
  <div class="kg-container">
    <div class="kg-intro">
      <div class="kg-intro-art" data-reveal>
        @if(trim($s['intro_eyebrow']) !== '')<span class="kg-eyebrow">{{ $s['intro_eyebrow'] }}</span>@endif
        <h2 class="kg-section-title">{{ $s['intro_title_1'] }}@if(trim($s['intro_title_2']) !== '' || trim($s['intro_title_em']) !== '')<br>{{ $s['intro_title_2'] }} @if(trim($s['intro_title_em']) !== '')<em>{{ $s['intro_title_em'] }}</em>@endif @endif</h2>
        <div class="kg-rule"></div>
        @if(trim($s['intro_text']) !== '')<p class="kg-section-sub">{{ $s['intro_text'] }}</p>@endif
        @if(trim($s['intro_pill']) !== '')
          <span class="kg-pill" style="margin-top:.3rem"><i class="fas fa-leaf"></i> {{ $s['intro_pill'] }}</span>
        @endif
        @if($hasStats)
          <div class="kg-stats-row">
            @foreach($statKeys as $n)
              @if(trim($s["stat_{$n}_num"]) !== '')
                <div class="kg-stat">
                  <div class="kg-stat-num"><span>{{ $s["stat_{$n}_num"] }}</span></div>
                  <div class="kg-stat-label">{{ $s["stat_{$n}_label"] }}</div>
                </div>
              @endif
            @endforeach
          </div>
        @endif
      </div>
      <div class="kg-intro-note" data-reveal="right" style="position:relative">
        <div class="kg-orn" aria-hidden="true">
          @if(trim($s['quote_stamp']) !== '')
            <span class="ko-stamp" style="position:absolute;right:0;top:-2.6rem"><i class="fas fa-circle"></i> {{ $s['quote_stamp'] }}</span>
          @endif
          <span class="ko-circle" style="right:0;top:-2.4rem"></span>
        </div>
        @if(trim($s['quote_text']) !== '')
          <blockquote style="border-left:4px solid #ffc107;padding-left:1.3rem;margin:0 0 1.4rem">
            <p style="font-size:1.05rem;line-height:1.85;color:#0d3a66;font-style:italic;margin:0">"{{ $s['quote_text'] }}"</p>
            @if(trim($s['quote_author']) !== '')
              <footer style="font-size:.72rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:#b8860b;margin-top:.7rem">{{ $s['quote_author'] }}</footer>
            @endif
          </blockquote>
        @endif
      </div>
    </div>
  </div>
</section>

<!-- ================= 2. FEATURED ACTIVITY ================= -->
@if($k['featured'])
  @php $ft = $k['featured']; @endphp
  <section class="kg-sec" style="padding-top:0;padding-bottom:clamp(2.5rem,5vw,4rem)">
    <div class="kg-container">
      <div class="kg-feat" data-reveal tabindex="0" role="button" aria-label="Buka album {{ $ft->title }}"
           data-title="{{ $ft->title }}"
           data-category="{{ $ft->cat_label }}"
           data-date="{{ $ft->date }}"
           data-photos="{{ $json($ft->photos) }}"
           data-desc="{{ $ft->desc }}">
        <div class="kg-feat-media">
          <img src="{{ $ft->cover }}" alt="{{ $ft->title }}" loading="eager" onerror="this.onerror=null;this.src='{{ $k['fallback'] }}'">
        </div>
        <div class="kg-feat-body">
          <span class="kg-feat-tag"><i class="fas fa-trophy"></i> {{ $ft->label !== '' ? $ft->label : $ft->cat_label }}</span>
          <h3 class="kg-feat-title">{{ $ft->title }}</h3>
        </div>
      </div>
    </div>
  </section>
@endif

<!-- ================= 3. JEJAK KEGIATAN — masonry gallery + filter ================= -->
<section class="kg-sec" style="padding-top:0">
  <div class="kg-orn" aria-hidden="true">
    <span class="ko-dots" style="right:5%;top:10%"></span>
    <span class="ko-circle" style="left:2%;bottom:12%"></span>
    <span class="ko-block" style="left:28%;top:0"></span>
  </div>
  <div class="kg-container">
    <div data-reveal>
      @if(trim($s['gallery_eyebrow']) !== '')<span class="kg-eyebrow">{{ $s['gallery_eyebrow'] }}</span>@endif
      <h2 class="kg-section-title">{{ $s['gallery_title'] }} @if(trim($s['gallery_title_em']) !== '')<em>{{ $s['gallery_title_em'] }}</em>@endif</h2>
      <div class="kg-rule"></div>
      @if(trim($s['gallery_text']) !== '')<p class="kg-section-sub">{{ $s['gallery_text'] }}</p>@endif
    </div>

    <div style="display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin:clamp(1.6rem,3vw,2.4rem) 0 0">
      <div class="kg-filters" data-reveal style="margin:0">
        <button type="button" class="kg-fbtn active" data-filter="semua"><i class="fas fa-th-large"></i> Semua</button>
        @foreach($k['filterCategories'] as $c)
          <button type="button" class="kg-fbtn" data-filter="{{ $c->key }}"><i class="fas {{ $c->icon ?: 'fa-flag' }}"></i> {{ $c->label }}</button>
        @endforeach
      </div>
      <div class="kg-search-wrap" style="position:relative;min-width:320px;max-width:560px;flex:1 1 420px" data-reveal>
        <i class="fas fa-search" style="position:absolute;left:20px;top:50%;transform:translateY(-50%);color:#2f6fa8;font-size:1rem;z-index:2"></i>
        <input type="text" id="kgSearchInput" value="{{ request('search') }}" placeholder="{{ $s['gallery_search_hint'] }}" aria-label="Cari kegiatan" autocomplete="off" style="width:100%;height:52px;padding:.85rem 1.4rem .85rem 3.2rem;border-radius:99px;border:1px solid rgba(13,58,102,.2);background:#fff;color:#0d3a66;font-size:.98rem;outline:none">
      </div>
    </div>

    <div class="kg-masonry" id="kgMasonry">
      @foreach($k['gallery'] as $g)
        <article class="kg-card {{ $g->size_class }}" data-cat="{{ $g->cat_key }}" data-reveal
                 tabindex="0" role="button" aria-label="Buka album {{ $g->title }}"
                 data-title="{{ $g->title }}"
                 data-category="{{ $g->cat_label }}"
                 data-date="{{ $g->date }}"
                 data-photos="{{ $json($g->photos) }}"
                 data-desc="{{ $g->desc }}">
          <img src="{{ $g->cover }}" alt="{{ $g->title }}" loading="lazy" onerror="this.onerror=null;this.src='{{ $k['fallback'] }}'">
          <div class="kg-card-info">
            <span class="kg-card-cat">{{ $g->cat_label }}</span>
            <h4 class="kg-card-title">{{ $g->title }}</h4>
            @if($g->date !== '')<span class="kg-card-date"><i class="fas fa-circle"></i> {{ $g->date }}</span>@endif
          </div>
        </article>
      @endforeach
    </div>

    <div class="kg-empty" id="kgEmpty" @if($k['gallery']->isNotEmpty()) hidden @endif>
      <i class="fas fa-camera-retro"></i>
      <strong id="kgEmptyTitle">{{ $k['gallery']->isEmpty() ? 'Belum ada kegiatan yang ditampilkan.' : 'Tidak ada kegiatan yang cocok.' }}</strong>
      <span id="kgEmptyHint">{{ $k['gallery']->isEmpty() ? 'Dokumentasi kegiatan akan segera hadir.' : 'Coba kata kunci lain atau pilih kategori "Semua".' }}</span>
    </div>
  </div>
</section>

<!-- ================= 4. PERJALANAN SATU TAHUN ================= -->
@if($k['months']->isNotEmpty())
  <section class="kg-sec" style="padding-top:0">
    <div class="kg-container">
      <div class="kg-year" data-reveal>
        <div class="kg-orn" aria-hidden="true">
          <span class="ko-circle"></span>
          <span class="ko-dots"></span>
          <span class="ko-block"></span>
        </div>
        <div style="position:relative;z-index:2">
          @if(trim($s['year_eyebrow']) !== '')<span class="kg-eyebrow kg-eyebrow--gold" style="color:#ffd54a">{{ $s['year_eyebrow'] }}</span>@endif
          <h2 class="kg-section-title" style="color:#fff">{{ $s['year_title'] }} @if(trim($s['year_title_em']) !== '')<em>{{ $s['year_title_em'] }}</em>@endif</h2>
          <div class="kg-rule" style="background:linear-gradient(90deg,#ffd54a,#ff8a00)"></div>
          @if(trim($s['year_text']) !== '')<p class="kg-section-sub" style="color:rgba(235,245,253,.82)">{{ $s['year_text'] }}</p>@endif
        </div>

        <div class="kg-timeline">
          @foreach($k['months'] as $m)
            <div class="kg-month">
              <div class="kg-month-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
              <div class="kg-month-text">
                <div class="kg-month-name">{{ $m->label }}</div>
                <div class="kg-month-evt">{{ $m->event }}</div>
                @if(trim((string) $m->note) !== '')<div class="kg-month-note">{{ $m->note }}</div>@endif
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endif

<!-- ================= 5. MOMEN PILIHAN ================= -->
@if($k['pickBig'] || $k['pickSmall']->isNotEmpty())
  <section class="kg-sec" style="padding-top:0">
    <div class="kg-orn" aria-hidden="true">
      <span class="ko-circle" style="left:6%;top:14%"></span>
      <span class="ko-dots" style="right:4%;bottom:10%"></span>
      <span class="ko-block" style="right:30%;top:6%"></span>
    </div>
    <div class="kg-container">
      <div data-reveal>
        @if(trim($s['picks_eyebrow']) !== '')<span class="kg-eyebrow">{{ $s['picks_eyebrow'] }}</span>@endif
        <h2 class="kg-section-title">{{ $s['picks_title'] }} @if(trim($s['picks_title_em']) !== '')<em>{{ $s['picks_title_em'] }}</em>@endif</h2>
        <div class="kg-rule"></div>
        @if(trim($s['picks_text']) !== '')<p class="kg-section-sub">{{ $s['picks_text'] }}</p>@endif
      </div>

      <div class="kg-picks {{ ($k['pickBig'] && $k['pickSmall']->isNotEmpty()) ? '' : 'kg-picks--single' }}">
        @if($k['pickBig'])
          @php $pb = $k['pickBig']; @endphp
          <div class="kg-pick-big" data-reveal tabindex="0" role="button" aria-label="Buka album {{ $pb->title }}"
               data-title="{{ $pb->title }}" data-category="{{ $pb->cat_label }}" data-date="{{ $pb->date }}"
               data-photos="{{ $json($pb->photos) }}" data-desc="{{ $pb->desc }}">
            <img src="{{ $pb->cover }}" alt="{{ $pb->title }}" loading="lazy" onerror="this.onerror=null;this.src='{{ $k['fallback'] }}'">
            <div class="kg-pick-caption">
              <span>Momen Pilihan</span>
              <strong>"{{ $pb->label !== '' ? $pb->label : $pb->title }}"</strong>
            </div>
          </div>
        @endif
        @if($k['pickSmall']->isNotEmpty())
          <div class="kg-pick-side">
            @foreach($k['pickSmall'] as $ps)
              <div class="kg-pick-small" data-reveal tabindex="0" role="button" aria-label="Buka album {{ $ps->title }}"
                   data-title="{{ $ps->title }}" data-category="{{ $ps->cat_label }}" data-date="{{ $ps->date }}"
                   data-photos="{{ $json($ps->photos) }}" data-desc="{{ $ps->desc }}">
                <img src="{{ $ps->cover }}" alt="{{ $ps->title }}" loading="lazy" onerror="this.onerror=null;this.src='{{ $k['fallback'] }}'">
                <span><i class="fas fa-circle"></i> {{ $ps->label !== '' ? $ps->label : $ps->title }}</span>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </section>
@endif

<!-- ================= CTA ================= -->
<section class="kg-sec" style="padding-top:0">
  <div class="kg-container">
    <div class="kg-cta" data-reveal>
      <h3>{{ $s['cta_title'] }} @if(trim($s['cta_title_em']) !== '')<em>{{ $s['cta_title_em'] }}</em>@endif</h3>
      @if(trim($s['cta_text']) !== '')<p>{{ $s['cta_text'] }}</p>@endif
      <a href="{{ $k['ctaUrl'] }}" class="kg-cta-btn">{{ $s['cta_btn_text'] }} <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- ================= LIGHTBOX ALBUM MODAL ================= -->
<div class="kg-album-modal" id="kgAlbumModal" aria-hidden="true">
  <div class="kg-album-dialog" role="dialog" aria-modal="true" aria-labelledby="kgAlbumTitle">
    <div class="kg-album-header">
      <div>
        <h3 class="kg-album-title" id="kgAlbumTitle">Album Kegiatan</h3>
        <div class="kg-album-meta">
          <span id="kgAlbumCat">Dokumentasi</span>
          <span id="kgAlbumSep">•</span>
          <span id="kgAlbumDate">SMK Negeri 2 Mojokerto</span>
        </div>
      </div>
      <button type="button" class="kg-album-close" id="kgAlbumClose" aria-label="Tutup"><i class="fas fa-times"></i></button>
    </div>
    <div class="kg-album-body" id="kgAlbumBody">
      <button type="button" class="kg-album-arrow prev" id="kgAlbumPrev" aria-label="Foto Sebelumnya"><i class="fas fa-chevron-left"></i></button>
      <img src="" alt="" class="kg-album-img" id="kgAlbumImg">
      <button type="button" class="kg-album-arrow next" id="kgAlbumNext" aria-label="Foto Berikutnya"><i class="fas fa-chevron-right"></i></button>
    </div>
    <div class="kg-album-footer">
      <p class="kg-album-caption" id="kgAlbumCaption">Dokumentasi momen kegiatan sekolah.</p>
      <span class="kg-album-counter" id="kgAlbumCounter">1 / 1</span>
    </div>
  </div>
</div>

</div>
