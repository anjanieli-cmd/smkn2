{{--
  Isi halaman publik jurusan. Markup & class sama persis dengan halaman DKV lama,
  tetapi semua teks/gambar dibaca dari $content (diatur di Admin > Program Keahlian).
  Variabel: $major (dari MajorPublicController)
--}}
@php
  use App\Support\DkvContent as MC;
  use Illuminate\Support\Facades\Route;

  $c = MC::get($major);
  $tourOk = !empty($c['tour_show']) && !empty($c['tour_scene']) && Route::has('profil.tour');
  $tourUrl = $tourOk ? route('profil.tour') . '?scene=' . urlencode($c['tour_scene']) : null;
  $ctaUrl = trim((string) $c['cta_btn_url']) !== '' ? $c['cta_btn_url'] : (Route::has('ppdb') ? route('ppdb') : '#');

  $partners = $c['partners'] ?? [];
  $categories = collect($c['product_items'] ?? [])->pluck('category')->filter()->unique()->values();
@endphp

<style>
/* tulisan raksasa transparan sekarang diambil dari admin (data-wm) */
.aphp-page .history-hero::after{content:attr(data-wm)!important}
.aphp-page .tentang-section::after{content:attr(data-wm)}
.aphp-page .aphp-cta::after{content:attr(data-wm)}
</style>

<div class="aphp-page">

  {{-- ===== HERO ===== --}}
  <section class="history-hero" data-wm="{{ $c['hero_watermark'] }}">
    <div class="history-ref-ornaments" aria-hidden="true">
      <img src="{{ asset('images/wide_minimalist_abstract_technology_background_des.png') }}" alt="" class="history-ref-ornament-image" aria-hidden="true">
    </div>
    <div class="history-hero-inner">
      <div>
        <div class="history-kicker"><i class="fas {{ MC::icon($c['hero_icon'], 'fa-graduation-cap') }}"></i> {{ $c['hero_kicker'] }}</div>
        <h1 class="history-title">
          <span class="sejarah-white">{{ $c['hero_title_1'] }}</span>
          <span class="skaneda-gold">{{ $c['hero_title_2'] }}</span>
        </h1>
        @if($tourOk)
          <a class="history-vt-cta" href="{{ $tourUrl }}">
            <span class="history-vt-icon"><i class="fas fa-vector-square"></i></span>
            <span><strong>{{ $c['tour_title'] }}</strong><small>{{ $c['tour_sub'] }}</small></span>
            <i class="fas fa-arrow-right history-vt-arrow"></i>
          </a>
        @endif
      </div>
    </div>
  </section>

  {{-- ===== VIDEO PENGENALAN ===== --}}
  @if(!empty($c['show_video']) && !empty($c['video_file']))
    @php $videoUrl = MC::url($c['video_file']); @endphp
    <section class="vid-section" id="video">
      <div class="orn" aria-hidden="true">
        <span class="o-dots"></span><span class="o-line"></span>
        <span class="o-ring"></span><span class="o-hex"></span>
        <span class="o-gold"></span><i class="fas fa-palette o-wheat"></i>
        <i class="fas fa-vector-square o-flask"></i>
      </div>
      <div class="vid-wrap">
        <div class="vid-copy" data-reveal="left">
          <div class="vc-eyebrow">
            <span class="vc-num">01</span>
            <span class="vc-line"></span>
            <span class="vc-label">Pengenalan Program Keahlian</span>
          </div>
          <h2><span class="sejarah-white">{{ $c['video_title_1'] }}</span><span class="t-gold"> {{ $c['video_title_gold'] }}</span></h2>
          <p class="vc-desc">{{ $c['video_desc'] }}</p>
          @if(!empty($c['video_cards']))
            <div class="vid-cards">
              @foreach($c['video_cards'] as $card)
                <div class="vid-card">
                  <span class="vc-ic {{ MC::tone($card['tone'] ?? '') }}"><i class="fas {{ MC::icon($card['icon'] ?? '') }}"></i></span>
                  <b>{{ $card['title'] ?? '' }}</b>
                  <span>{{ $card['desc'] ?? '' }}</span>
                </div>
              @endforeach
            </div>
          @endif
        </div>
        <div class="vid-stage" data-reveal="right">
          <span class="vid-side">{{ $c['video_side'] }}</span>
          <div class="vid-player" role="button" tabindex="0" aria-label="Putar video pengenalan {{ $major->code }}"
               onclick="document.getElementById('majorVideoModal').style.display='flex'; document.getElementById('majorVideoPlayer').play();">
            <video class="vid-preview" muted playsinline preload="auto" aria-hidden="true">
              <source src="{{ $videoUrl }}">
            </video>
            <div class="vid-bg" aria-hidden="true"></div>
            <span class="vid-ring" aria-hidden="true"></span>
            <span class="vid-hex" aria-hidden="true"></span>
            <span class="vid-diag" aria-hidden="true"></span>
            <span class="vid-play"><i class="fas fa-circle-play"></i></span>
            <span class="vid-brand"><b>{{ $major->code }}</b><span>{{ $c['video_brand_sub'] }}</span></span>
            <span class="vid-label"><i class="fas fa-play"></i> {{ $c['video_label'] }}</span>
          </div>
        </div>
      </div>
    </section>

    <div id="majorVideoModal" style="display:none;position:fixed;inset:0;z-index:99999;background:rgba(7,27,51,.88);align-items:center;justify-content:center;padding:20px;"
         onclick="if(event.target===this){document.getElementById('majorVideoPlayer').pause();document.getElementById('majorVideoPlayer').currentTime=0;this.style.display='none';}">
      <div style="position:relative;width:min(430px,92vw);max-height:92vh;background:#0d3a66;border-radius:20px;padding:10px;box-shadow:0 30px 80px rgba(0,0,0,.35);display:flex;align-items:center;justify-content:center;">
        <button type="button" aria-label="Tutup video"
          onclick="document.getElementById('majorVideoPlayer').pause();document.getElementById('majorVideoPlayer').currentTime=0;document.getElementById('majorVideoModal').style.display='none';"
          style="position:absolute;right:-10px;top:-10px;width:38px;height:38px;border:0;border-radius:50%;background:#FFD54A;color:#0d3a66;font-size:22px;font-weight:900;line-height:1;cursor:pointer;z-index:2;">&times;</button>
        <video id="majorVideoPlayer" controls playsinline preload="metadata"
          style="display:block;width:auto;max-width:100%;height:auto;max-height:88vh;border-radius:14px;background:#06192e;object-fit:contain;">
          <source src="{{ $videoUrl }}">
          Browser kamu tidak mendukung pemutaran video.
        </video>
      </div>
    </div>
  @endif

  {{-- ===== TENTANG ===== --}}
  @if(!empty($c['show_tentang']))
    <section class="tentang-section section-pad" id="tentang" data-wm="{{ $c['hero_watermark'] }}">
      <div class="orn" aria-hidden="true">
        <span class="o-chevron"></span><span class="o-line"></span><span class="o-dots"></span>
        <span class="o-ring"></span><span class="o-gold"></span><span class="o-square"></span>
      </div>

      <div class="aphp-wide tentang-grid">
        <div class="tentang-copy" data-reveal="left">
          <div class="tc-top">
            <span class="tc-num">02</span>
            <span class="tc-line"></span>
            <span class="tc-label">Tentang Program Keahlian</span>
          </div>

          @if($c['about_eyebrow'])<div class="eyebrow gold">{{ $c['about_eyebrow'] }}</div>@endif
          <h2 class="big-heading">{{ $c['about_h1'] }}@if($c['about_hgold'])<span> {{ $c['about_hgold'] }}</span>@endif @if(!empty($c['about_h2'])){{ $c['about_h2'] }}@endif</h2>

          @if($c['about_lead'])<p class="tc-lead">{!! MC::rich($c['about_lead']) !!}</p>@endif
          @if($c['about_sub'])<p class="tc-sub">{!! MC::rich($c['about_sub']) !!}</p>@endif

          @if(!empty($c['about_minis']))
            <div class="tentang-mini">
              @foreach($c['about_minis'] as $mini)
                <div class="tentang-mini-card">
                  <span class="tm-ic {{ MC::tone($mini['tone'] ?? '') }}"><i class="fas {{ MC::icon($mini['icon'] ?? '') }}"></i></span>
                  <span>{{ $mini['text'] ?? '' }}</span>
                </div>
              @endforeach
            </div>
          @endif
        </div>

        <div class="tentang-visual" data-reveal="right">
          <div class="tv-panel">
            <div class="tv-top">
              <div class="tv-top-label"><i class="fas fa-layer-group"></i> {{ $c['flow_label'] }}</div>
              <div class="tv-top-code">02 / {{ $major->code }}</div>
            </div>

            <div class="tv-center">
              <div class="tv-core">
                <i class="fas {{ MC::icon($c['flow_core_icon'], 'fa-graduation-cap') }}"></i>
                <strong>{{ $c['flow_core_title'] }}</strong>
                <small>{{ $c['flow_core_sub'] }}</small>
              </div>
            </div>

            @if(!empty($c['flow_steps']))
              <div class="tv-flow">
                @foreach($c['flow_steps'] as $step)
                  <div class="tv-step">
                    <span class="ts-ic {{ MC::tone($step['tone'] ?? '') }}"><i class="fas {{ MC::icon($step['icon'] ?? '') }}"></i></span>
                    <span class="ts-copy"><strong>{{ $step['title'] ?? '' }}</strong><small>{{ $step['desc'] ?? '' }}</small></span>
                    <i class="fas fa-arrow-right tv-arrow"></i>
                  </div>
                @endforeach
              </div>
            @endif

            <div class="tv-bottom">
              <span>{{ $c['flow_bottom'] }}</span>
              <span class="tv-status"><i class="fas fa-circle"></i> Program Keahlian</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif

  {{-- ===== MITRA INDUSTRI ===== --}}
  @if(!empty($c['show_mitra']) && count($partners))
    <section class="industry-collab section-pad" id="industri">
      <div class="orn" aria-hidden="true">
        <span class="o-chevron"></span><span class="o-dots"></span>
        <span class="o-ring"></span><span class="o-gold"></span>
        <span class="o-hex"></span>
      </div>
      <div class="ic-head" data-reveal>
        @if($c['partners_eyebrow'])<div class="eyebrow">{{ $c['partners_eyebrow'] }}</div>@endif
        <h2 class="big-heading">{{ $c['partners_h1'] }} @if($c['partners_hgold'])<span>{{ $c['partners_hgold'] }}</span>@endif</h2>
      </div>
      <div class="ic-marquee-wrap" data-reveal aria-label="Mitra industri {{ $major->code }}">
        <div class="ic-marquee">
          @foreach([false, true] as $isClone)
            <div class="ic-logo-group" @if($isClone) aria-hidden="true" @endif>
              @foreach($partners as $p)
                @if(!empty($p['image']))
                  <div class="ic-logo"><img class="ic-logo-only" src="{{ MC::url($p['image']) }}" alt="{{ $isClone ? '' : 'Logo ' . ($p['name'] ?? '') }}" loading="lazy"></div>
                @endif
              @endforeach
            </div>
          @endforeach
        </div>
      </div>
      @if($c['partners_footer'])<div class="ic-footer" data-reveal><span>{{ $c['partners_footer'] }}</span></div>@endif
    </section>
  @endif

  {{-- ===== PEMBELAJARAN ===== --}}
  @if(!empty($c['show_belajar']) && !empty($c['learn_items']))
    <section class="belajar-section section-pad" id="pembelajaran">
      <div class="orn" aria-hidden="true">
        <span class="o-chevron"></span><span class="o-dots"></span>
        <span class="o-ring"></span><span class="o-gold"></span><span class="o-corner"></span>
      </div>
      <div class="belajar-head" data-reveal>
        @if($c['learn_eyebrow'])<div class="eyebrow gold">{{ $c['learn_eyebrow'] }}</div>@endif
        <h2 class="big-heading">{{ $c['learn_h1'] }} @if($c['learn_hgold'])<span>{{ $c['learn_hgold'] }}</span>@endif</h2>
      </div>
      <div class="belajar-grid">
        @foreach($c['learn_items'] as $n => $it)
          <div class="belajar-card" data-num="{{ str_pad($n + 1, 2, '0', STR_PAD_LEFT) }}" data-reveal style="--d:{{ $n % 6 }}">
            <div class="bc-ic {{ MC::tone($it['tone'] ?? '') }}"><i class="fas {{ MC::icon($it['icon'] ?? '') }}"></i></div>
            <h4>{{ $it['title'] ?? '' }}</h4>
            <p>{{ $it['desc'] ?? '' }}</p>
          </div>
        @endforeach
      </div>
    </section>
  @endif

  {{-- ===== PRAKTIK ===== --}}
  @if(!empty($c['show_praktik']) && !empty($c['practice_items']))
    <section class="praktik-section section-pad" id="praktik">
      <div class="praktik-head" data-reveal>
        @if($c['practice_eyebrow'])<div class="eyebrow gold">{{ $c['practice_eyebrow'] }}</div>@endif
        <h2 class="big-heading">{{ $c['practice_h1'] }} @if($c['practice_hgold'])<span>{{ $c['practice_hgold'] }}</span>@endif</h2>
      </div>
      <div class="praktik-grid">
        @foreach($c['practice_items'] as $n => $it)
          <div class="praktik-card" data-reveal style="--d:{{ $n % 3 }}">
            @if(!empty($it['image']))<img src="{{ MC::url($it['image']) }}" alt="{{ $it['title'] ?? '' }}" loading="lazy">@endif
            @if(!empty($it['badge']))<span class="pc-badge"><i class="fas {{ MC::icon($it['icon'] ?? '', 'fa-vector-square') }}"></i> {{ $it['badge'] }}</span>@endif
            <div class="pc-body">
              <h4>{{ $it['title'] ?? '' }}</h4>
              <p>{{ $it['desc'] ?? '' }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  @endif

  {{-- ===== FASILITAS ===== --}}
  @if(!empty($c['show_fasilitas']) && !empty($c['facility_items']))
    <section class="fasilitas-section section-pad" id="fasilitas">
      <div class="orn" aria-hidden="true">
        <span class="o-chevron"></span><span class="o-line"></span><span class="o-dots"></span>
        <span class="o-ring"></span><span class="o-gold"></span>
      </div>
      <div class="fasilitas-head" data-reveal>
        @if($c['facility_eyebrow'])<div class="eyebrow gold">{{ $c['facility_eyebrow'] }}</div>@endif
        <h2 class="big-heading">{{ $c['facility_h1'] }} @if($c['facility_hgold'])<span>{{ $c['facility_hgold'] }}</span>@endif</h2>
      </div>
      <div class="fasilitas-grid">
        @foreach($c['facility_items'] as $n => $it)
          <div class="fasilitas-card" data-reveal style="--d:{{ $n % 6 }}">
            <div class="fc-ic {{ MC::tone($it['tone'] ?? '') }}"><i class="fas {{ MC::icon($it['icon'] ?? '') }}"></i></div>
            <h4>{{ $it['title'] ?? '' }}</h4>
            <p>{{ $it['desc'] ?? '' }}</p>
          </div>
        @endforeach
      </div>
    </section>
  @endif

  {{-- ===== KARYA SISWA ===== --}}
  @if(!empty($c['show_produk']) && !empty($c['product_items']))
    <section class="produk-section section-pad" id="produk">
      <div class="orn" aria-hidden="true">
        <span class="o-chevron"></span><span class="o-line"></span><span class="o-dots"></span>
        <span class="o-ring"></span><span class="o-gold"></span><span class="o-square"></span>
      </div>
      <div class="produk-head" data-reveal>
        <div>
          @if($c['product_eyebrow'])<div class="eyebrow">{{ $c['product_eyebrow'] }}</div>@endif
          <h2 class="big-heading">{{ $c['product_h1'] }} @if($c['product_hgold'])<span>{{ $c['product_hgold'] }}</span>@endif</h2>
        </div>
        @if($c['product_note'])<div class="produk-note">{{ $c['product_note'] }}</div>@endif
      </div>

      @if($categories->count() > 1)
        <div class="produk-filters" data-reveal>
          <button class="pf-btn active" data-f="all">SEMUA</button>
          @foreach($categories as $cat)
            <button class="pf-btn" data-f="{{ MC::slug($cat) }}">{{ strtoupper($cat) }}</button>
          @endforeach
        </div>
      @endif

      <div class="produk-slider" data-reveal>
        <button class="produk-arrow prev" id="produkPrev" aria-label="Sebelumnya"><i class="fas fa-chevron-left"></i></button>
        <div class="produk-viewport">
          <div class="produk-track" id="produkTrack">
            @foreach($c['product_items'] as $it)
              <article class="produk-card" data-cat="{{ MC::slug($it['category'] ?? '') }}">
                <div class="produk-photo">
                  @if(!empty($it['image']))<img src="{{ MC::url($it['image']) }}" alt="{{ $it['title'] ?? '' }}" loading="lazy">@endif
                  @if(!empty($it['category']))<span class="produk-badge">{{ $it['category'] }}</span>@endif
                </div>
                <div class="pc-body">
                  <h3>{{ $it['title'] ?? '' }}</h3>
                  <p>{{ $it['desc'] ?? '' }}</p>
                  <div class="pc-foot"><span>{{ $it['foot'] ?? '' }}</span><span><i class="fas fa-arrow-right"></i></span></div>
                </div>
              </article>
            @endforeach
          </div>
        </div>
        <button class="produk-arrow next" id="produkNext" aria-label="Selanjutnya"><i class="fas fa-chevron-right"></i></button>
      </div>
      <div class="produk-dots" id="produkDots"></div>
    </section>
  @endif

  {{-- ===== KEGIATAN & PRESTASI ===== --}}
  @if(!empty($c['show_kegiatan']) && !empty($c['activity_items']))
    <section class="kegiatan-section section-pad" id="kegiatan">
      <div class="orn" aria-hidden="true">
        <span class="o-chevron"></span><span class="o-dots"></span>
        <span class="o-ring"></span><span class="o-gold"></span><span class="o-corner"></span>
      </div>
      <div class="kegiatan-head" data-reveal>
        @if($c['activity_eyebrow'])<div class="eyebrow gold">{{ $c['activity_eyebrow'] }}</div>@endif
        <h2 class="big-heading">{{ $c['activity_h1'] }} @if($c['activity_hgold'])<span>{{ $c['activity_hgold'] }}</span>@endif</h2>
      </div>
      <div class="kegiatan-grid">
        @foreach($c['activity_items'] as $n => $it)
          <div class="kegiatan-card {{ !empty($it['tall']) ? 'tall' : '' }}" data-reveal style="--d:{{ $n % 3 }}">
            @if(!empty($it['image']))<img src="{{ MC::url($it['image']) }}" alt="{{ $it['title'] ?? '' }}" loading="lazy">@endif
            @if(!empty($it['badge']))<span class="kg-badge"><i class="fas {{ MC::icon($it['icon'] ?? '', 'fa-trophy') }}"></i> {{ $it['badge'] }}</span>@endif
            <div class="kg-body"><h4>{{ $it['title'] ?? '' }}</h4><span>{{ $it['desc'] ?? '' }}</span></div>
          </div>
        @endforeach
      </div>
    </section>
  @endif

  {{-- ===== PROSPEK LULUSAN ===== --}}
  @if(!empty($c['show_prospek']) && !empty($c['prospect_items']))
    <section class="prospek-section section-pad" id="prospek">
      <div class="prospek-head" data-reveal>
        @if($c['prospect_eyebrow'])<div class="eyebrow gold">{{ $c['prospect_eyebrow'] }}</div>@endif
        <h2 class="big-heading">{{ $c['prospect_h1'] }} @if($c['prospect_hgold'])<span>{{ $c['prospect_hgold'] }}</span>@endif</h2>
      </div>
      <div class="prospek-grid">
        @foreach($c['prospect_items'] as $n => $it)
          <div class="prospek-card" data-reveal style="--d:{{ $n % 3 }}">
            <div class="ps-photo">
              <span class="ps-num">{{ str_pad($n + 1, 2, '0', STR_PAD_LEFT) }}</span>
              @if(!empty($it['image']))<img src="{{ MC::url($it['image']) }}" alt="{{ $it['title'] ?? '' }}" loading="lazy">@endif
              <i class="fas {{ MC::icon($it['icon'] ?? '') }} {{ MC::tone($it['tone'] ?? '') }}"></i>
            </div>
            <div class="ps-body">
              <h4>{{ $it['title'] ?? '' }}</h4>
              <p>{{ $it['desc'] ?? '' }}</p>
              @php $tags = MC::tags($it['tags'] ?? ''); @endphp
              @if($tags)<div class="ps-tags">@foreach($tags as $tag)<span>{{ $tag }}</span>@endforeach</div>@endif
            </div>
          </div>
        @endforeach
      </div>
    </section>
  @endif

  {{-- ===== LAB TOUR ===== --}}
  @if(!empty($c['show_lab']) && $tourOk)
    <section class="vt-section" id="lab-tour" aria-label="Studio Tour {{ $major->code }} SMK Negeri 2 Mojokerto">
      <span class="vt-watermark" aria-hidden="true">{{ $c['lab_watermark'] }}</span>
      <div class="vt-decor-ring" aria-hidden="true"></div>
      <div class="vt-decor-dots" aria-hidden="true"></div>
      <div class="vt-inner">
        <div class="vt-media" data-reveal="left">
          <div class="vt-frame">
            @if(!empty($c['lab_image']))<img src="{{ MC::url($c['lab_image']) }}" alt="Studio {{ $major->code }} — Studio Tour" loading="lazy">@endif
            <span class="vt-badge"><i class="fa-solid fa-vector-square"></i> {{ $c['lab_badge'] }}</span>
            <button class="vt-play" type="button" aria-label="Mulai Studio Tour {{ $major->code }}" onclick="document.getElementById('labTourLink')?.click()"><i class="fa-solid fa-play"></i></button>
            <div class="vt-caption">
              <div><strong>{{ $c['lab_caption_title'] }}</strong><span>{{ $c['lab_caption_sub'] }}</span></div>
              <span class="vt-cam"><i class="fa-solid fa-camera"></i> LAB</span>
            </div>
          </div>
          <div class="vt-chip"><i class="fa-solid fa-compass"></i><div><strong>{{ $c['lab_chip_title'] }}</strong><span>{{ $c['lab_chip_sub'] }}</span></div></div>
        </div>
        <div class="vt-copy">
          <div class="vt-kicker" data-reveal>{{ $c['lab_kicker'] }}</div>
          <h2 class="vt-title" data-reveal>{{ $c['lab_h1'] }} <span class="vt-gold">{{ $c['lab_hgold'] }}</span>@if($c['lab_sub'])<span class="vt-sub">{{ $c['lab_sub'] }}</span>@endif</h2>
          @if($c['lab_desc'])<p class="vt-desc" data-reveal>{{ $c['lab_desc'] }}</p>@endif
          @php $feats = MC::tags($c['lab_feats']); @endphp
          @if($feats)<div class="vt-feats" data-reveal>@foreach($feats as $feat)<span class="vt-feat"><i class="fa-solid fa-check"></i> {{ $feat }}</span>@endforeach</div>@endif
          <a href="{{ $tourUrl }}" id="labTourLink" class="vt-btn" data-reveal>{{ $c['lab_btn'] }} <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
    </section>
  @endif

  {{-- ===== CTA PENUTUP ===== --}}
  <section class="aphp-cta" data-wm="{{ $c['cta_watermark'] }}">
    @if(!empty($c['cta_bg']))
      <div class="cta-bg" aria-hidden="true"><img src="{{ MC::url($c['cta_bg']) }}" alt="" loading="lazy"></div>
    @endif
    <div class="orn" aria-hidden="true">
      <span class="o-chevron"></span><span class="o-dots"></span>
      <span class="o-ring"></span><span class="o-gold"></span>
      <i class="fas fa-palette o-wheat"></i>
    </div>
    <div class="aphp-cta-inner" data-reveal>
      <h2>{{ $c['cta_h1'] }} @if($c['cta_hgold'])<span>{{ $c['cta_hgold'] }}</span>@endif</h2>
      @if($c['cta_desc'])<p>{{ $c['cta_desc'] }}</p>@endif
      <div class="aphp-cta-actions">
        <a href="{{ $ctaUrl }}" class="aphp-cta-btn"><i class="fas fa-pen"></i> {{ $c['cta_btn_text'] }}</a>
      </div>
    </div>
  </section>
</div>
