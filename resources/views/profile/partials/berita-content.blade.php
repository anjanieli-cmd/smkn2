{{--
  Isi halaman Berita — teks, artikel, penempatan, Cerita Skaneda, dan kategori
  dibaca dari database (diatur di admin). CSS dan script filter/modal tetap di
  resources/views/profile/berita.blade.php (file lama kamu).
--}}
@php
  $bn         = \App\Support\BeritaContent::get();
  $s          = $bn['s'];
  $featured   = $bn['featured'];
  $side       = $bn['side'];
  $mostRead   = $bn['mostRead'];
  $list       = $bn['list'];
  $categories = $bn['categories'];
  $stories    = $bn['stories'];

  $catClass = fn ($key) => 'br-cat-' . ($key ?: 'sekolah');
  $catOf = fn ($key) => $categories->firstWhere('key', $key);
@endphp

<!-- ================= HERO ================= -->
<section class="br-hero">
  <div class="br-ref-ornaments" aria-hidden="true" style="background-image:url('{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}');background-size:cover;background-position:center center;">
    <img src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}" alt="" class="br-ref-ornament-image" aria-hidden="true">
  </div>
  <div class="br-hero-inner">
    <div>
      @if($s['hero_kicker'] !== '')
        <div class="br-kicker">{{ $s['hero_kicker'] }}</div>
      @endif
      <h1 class="br-title"><span class="br-white">{{ $s['hero_title_1'] }}</span><span class="br-gold">{{ $s['hero_title_2'] }}</span></h1>
      <div class="br-hero-meta">
        @if($s['hero_pill_1'] !== '')<span class="br-pill"><i class="fas fa-newspaper"></i> {{ $s['hero_pill_1'] }}</span>@endif
        @if($s['hero_pill_2'] !== '')<span class="br-pill"><i class="fas fa-database"></i> {{ $s['hero_pill_2'] }}</span>@endif
        @if($s['hero_pill_3'] !== '')<span class="br-pill"><i class="fas fa-bolt"></i> {{ $s['hero_pill_3'] }}</span>@endif
      </div>
    </div>
  </div>
</section>

<!-- ================= STRIP EDISI ================= -->
<div class="br-strip">
  <div class="br-strip-inner">
    <span class="br-strip-label"><i class="fas fa-bolt"></i> {{ $s['strip_label'] }}</span>
    <span class="br-strip-text">{{ $s['strip_text'] }}</span>
  </div>
</div>

<!-- ================= 1. BERITA TERKINI ================= -->
@if($featured || $side->isNotEmpty())
<section class="br-sec" style="padding-bottom:clamp(2.5rem,5vw,4rem)">
  <div class="home-orn" aria-hidden="true">
    <span class="ho-chevron"></span><span class="ho-dots"></span><span class="ho-ring"></span><span class="ho-gold"></span>
  </div>
  <div class="br-container">
    <div class="br-sec-head" data-reveal>
      <div>
        <span class="br-eyebrow">Headline Edition</span>
        <h2 class="br-sec-title">Berita <em>Terkini</em></h2>
        <div class="br-rule"></div>
      </div>
      <div class="br-num" aria-hidden="true">01</div>
    </div>

    <div class="br-latest">
      @if($featured)
        @php $fc = $catOf($featured->category_key); @endphp
        <article class="br-featured" data-reveal data-article-id="{{ $featured->id }}">
          <div class="br-featured-img">
            <img src="{{ $featured->photo_url }}" alt="{{ $featured->title }}" loading="eager">
            @if($fc)
              <div class="br-featured-tag"><span class="br-cat {{ $catClass($fc->key) }}"><i class="fas {{ $fc->icon }}"></i> {{ $fc->label }}</span></div>
            @endif
          </div>
          <div class="br-featured-body">
            <span class="br-featured-date"><i class="fas fa-calendar-alt"></i> {{ $featured->date_label ?: 'Data kegiatan Skaneda' }}</span>
            <h3><a href="#" data-news-trigger="{{ $featured->id }}">{{ $featured->title }}</a></h3>
            @if($featured->excerpt)<p class="br-featured-excerpt">{{ $featured->excerpt }}</p>@endif
            <div class="br-featured-meta">
              <span><i class="fas fa-school"></i> SMK Negeri 2 Mojokerto</span>
              @if($fc)<span><i class="fas fa-newspaper"></i> {{ $fc->label }}</span>@endif
            </div>
            <button type="button" class="br-readmore" data-news-trigger="{{ $featured->id }}">Baca Kisahnya <i class="fas fa-arrow-right"></i></button>
          </div>
        </article>
      @endif

      @if($side->isNotEmpty())
        <div class="br-side">
          @foreach($side as $sdArticle)
            @php $sc = $catOf($sdArticle->category_key); @endphp
            <article class="br-side-item" data-reveal data-article-id="{{ $sdArticle->id }}">
              <div class="br-side-thumb">
                <img src="{{ $sdArticle->photo_url }}" alt="{{ $sdArticle->title }}" loading="lazy">
              </div>
              <div class="br-side-body">
                @if($sc)<span class="br-cat {{ $catClass($sc->key) }}"><i class="fas {{ $sc->icon }}"></i> {{ $sc->label }}</span>@endif
                <h4><a href="#" data-news-trigger="{{ $sdArticle->id }}">{{ $sdArticle->title }}</a></h4>
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</section>
@endif

<!-- ================= 2. BERITA TERBARU ================= -->
<section class="br-sec" id="berita-terbaru" style="padding-top:clamp(2.5rem,5vw,4rem)">
  <div class="br-gridbg" aria-hidden="true"></div>
  <span class="br-block" style="top:12%;right:8%" aria-hidden="true"></span>
  <span class="br-block" style="top:26%;left:4%" aria-hidden="true"></span>
  <span class="br-dots" style="top:10%;left:6%" aria-hidden="true"></span>
  <div class="br-container">
    <div class="br-sec-head" data-reveal>
      <div>
        <span class="br-eyebrow">Archive &amp; Reportase</span>
        <h2 class="br-sec-title">Berita <em>Terbaru</em></h2>
        <div class="br-rule"></div>
      </div>
      <div class="br-num" aria-hidden="true">02</div>
    </div>

    <div class="br-toolbar" data-reveal>
      <div class="br-filters" id="brFilters">
        <button type="button" class="br-filter-btn active" data-filter="semua"><i class="fas fa-layer-group"></i> Semua</button>
        @foreach($categories as $c)
          <button type="button" class="br-filter-btn" data-filter="{{ $c->key }}"><i class="fas {{ $c->icon }}"></i> {{ $c->label }}</button>
        @endforeach
      </div>
      <div class="br-search">
        <i class="fas fa-search"></i>
        <input type="search" id="brSearch" placeholder="Cari berita..." aria-label="Cari berita">
      </div>
    </div>

    <div class="br-main">
      <div class="br-list" id="brList">
        @forelse($list as $i => $a)
          @php $ac = $catOf($a->category_key); @endphp
          <article class="br-item {{ $a->show_in_initial_ten ? '' : 'br-extra' }}" data-reveal
                    data-article-id="{{ $a->id }}"
                    data-cat="{{ $a->category_key ?: 'semua' }}"
                    data-search="{{ strtolower($a->title . ' ' . $a->excerpt) }}">
            <div class="br-item-img"><img src="{{ $a->photo_url }}" alt="{{ $a->title }}" loading="lazy"></div>
            <div class="br-item-body">
              <div class="br-item-top">
                @if($ac)<span class="br-cat {{ $catClass($ac->key) }}"><i class="fas {{ $ac->icon }}"></i> {{ $ac->label }}</span>@endif
                @if($a->date_label)<span class="br-item-date"><i class="fas fa-calendar-alt"></i> {{ $a->date_label }}</span>@endif
              </div>
              <h3><a href="#" data-news-trigger="{{ $a->id }}">{{ $a->title }}</a></h3>
              @if($a->excerpt)<p class="br-item-excerpt">{{ $a->excerpt }}</p>@endif
            </div>
          </article>
        @empty
        @endforelse

        <div class="br-empty" id="brEmpty">
          <i class="fas fa-newspaper"></i>
          Tidak ada berita yang cocok dengan pencarian atau kategori ini. Coba kata kunci lain.
        </div>

        <div class="br-more-wrap">
          <button type="button" class="br-more-btn" id="brMoreBtn">
            <span>Lihat Semua</span><i class="fas fa-chevron-down"></i>
          </button>
        </div>
      </div>

      @if($mostRead->isNotEmpty())
        <aside class="br-most" data-reveal="right">
          <div class="br-most-head">
            <i class="fas fa-newspaper"></i>
            <div><h3>Artikel Pilihan</h3><span>Data Skaneda</span></div>
          </div>
          <div class="br-most-list">
            @foreach($mostRead as $mr)
              <a href="#" class="br-most-item" data-news-trigger="{{ $mr->id }}">
                <span class="br-most-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="br-most-body"><b>{{ $mr->title }}</b><span><i class="fas fa-newspaper"></i> Baca artikel</span></span>
              </a>
            @endforeach
          </div>
        </aside>
      @endif
    </div>
  </div>
</section>

<!-- ================= 3. CERITA SKANEDA ================= -->
@if($stories->isNotEmpty())
<section class="br-story">
  <div class="br-story-inner">
    <span class="br-block" style="top:14%;right:10%" aria-hidden="true"></span>
    <span class="br-dots" style="bottom:12%;right:6%" aria-hidden="true"></span>
    <div class="br-sec-head" data-reveal>
      <div>
        <span class="br-eyebrow">Long Read · Feature</span>
        <h2 class="br-sec-title">Cerita <em>Skaneda</em></h2>
        <div class="br-rule"></div>
      </div>
      <div class="br-num" aria-hidden="true">03</div>
    </div>
    <div class="br-story-grid">
      @foreach($stories as $story)
        @php $stc = $catOf($story->category_key); @endphp
        <article class="br-story-card" data-reveal>
          @if($stc)<span class="br-cat {{ $catClass($stc->key) }}"><i class="fas {{ $stc->icon }}"></i> Feature</span>@endif
          <h4>{{ $story->title }}</h4>
          @if($story->teaser)<p>{{ $story->teaser }}</p>@endif
          <button type="button" class="br-story-link" data-story="{{ $story->id }}">Baca Kisahnya <i class="fas fa-arrow-right"></i></button>
        </article>
      @endforeach
    </div>
  </div>
</section>

@foreach($stories as $story)
  @php $stc = $catOf($story->category_key); @endphp
  <div class="br-story-modal" id="storyModal{{ $story->id }}" role="dialog" aria-modal="true" aria-labelledby="storyModalTitle{{ $story->id }}">
    <div class="br-story-modal-box">
      <button type="button" class="br-story-modal-close" data-close-story aria-label="Tutup"><i class="fas fa-times"></i></button>
      <div class="br-story-modal-category">
        @if($stc)<span class="br-cat {{ $catClass($stc->key) }}"><i class="fas {{ $stc->icon }}"></i> Feature</span>@endif
      </div>
      <h3 class="br-story-modal-title" id="storyModalTitle{{ $story->id }}">{{ $story->title }}</h3>
      <div class="br-story-modal-content">
        @foreach($story->content_paragraphs as $p)
          <p>{{ $p }}</p>
        @endforeach
      </div>
    </div>
  </div>
@endforeach
@endif

<!-- ================= CTA ================= -->
<section class="br-cta">
  <div class="br-cta-box">
    <div class="home-orn" aria-hidden="true">
      <span class="ho-chevron"></span><span class="ho-line"></span><span class="ho-dots"></span>
      <span class="ho-ring"></span><span class="ho-gold"></span><span class="ho-square"></span>
    </div>
    <h2 class="br-cta-title">{{ $s['cta_title'] }}@if($s['cta_title_gold'] !== '')<br><em>{{ $s['cta_title_gold'] }}</em>@endif</h2>
    @if($s['cta_text'] !== '')<p>{{ $s['cta_text'] }}</p>@endif
    <a href="{{ $bn['ctaUrl'] }}" class="br-cta-btn"><i class="fas fa-paper-plane"></i> {{ $s['cta_btn_text'] }}</a>
    @if($s['cta_note'] !== '')<div class="br-cta-note"><i class="fas fa-info-circle"></i> {{ $s['cta_note'] }}</div>@endif
  </div>
</section>

<!-- ================= MODAL DETAIL BERITA ================= -->
<div class="br-news-modal" id="newsModal" role="dialog" aria-modal="true" aria-labelledby="newsModalTitle">
  <div class="br-news-modal-box">
    <button type="button" class="br-news-modal-close" id="newsModalClose" aria-label="Tutup">
      <i class="fas fa-times"></i>
    </button>
    <div class="br-news-modal-category" id="newsModalCategory"></div>
    <h3 class="br-news-modal-title" id="newsModalTitle"></h3>
    <div class="br-news-modal-content" id="newsModalContent"></div>
    <div class="br-news-modal-source">
      <i class="fas fa-database"></i>
      <span>Informasi berdasarkan data berita pada dokumen sumber sekolah.</span>
    </div>
  </div>
</div>

{{--
  Data artikel untuk modal "Baca Kisahnya", dikirim sebagai JSON supaya
  script lama (filter/search/modal) tetap jalan tanpa perlu dirombak.
--}}
@php
  $beritaData = \App\Models\BeritaArticle::active()->get()->mapWithKeys(function ($a) use ($catOf) {
      $cat = $catOf($a->category_key);
      return [
          $a->id => [
              'title'    => $a->title,
              'category' => $cat ? ['label' => $cat->label, 'class' => 'br-cat-' . $cat->key, 'icon' => $cat->icon] : null,
              'content'  => $a->content_paragraphs,
          ],
      ];
  });
@endphp
<script>
  window.BERITA_DATA = @json($beritaData);
</script>