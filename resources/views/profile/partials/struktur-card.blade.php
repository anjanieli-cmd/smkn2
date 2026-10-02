{{-- Satu kartu orang di bagan. Variabel: $m (App\Models\StrukturMember) --}}
<article class="so-card" tabindex="0"
         data-name="{{ $m->person ?: $m->position }}"
         data-role="{{ $m->position }}"
         data-unit="{{ $m->unit }}"
         data-filter="{{ $m->bidang }}"
         data-detail="m{{ $m->id }}">
  <div class="so-feed-head">
    <img src="{{ asset('images/logo_smkn2.png') }}" alt="Logo SKANEDA">
    <div class="so-feed-account"><strong>SKANEDA</strong><span>SMK Negeri 2 Mojokerto</span></div>
    <i class="fas fa-ellipsis-h so-feed-more" aria-hidden="true"></i>
  </div>
  <div class="so-photo-wrap">
    <span class="so-photo-ring" aria-hidden="true"></span>
    <div class="so-photo">
      @if($m->photo_url)
        <img src="{{ $m->photo_url }}" alt="Foto {{ $m->person ?: $m->position }}" loading="lazy">
      @else
        <span style="position:absolute;inset:0;display:grid;place-items:center;font-size:3.2rem;color:#9db6cc"><i class="fas fa-user"></i></span>
      @endif
    </div>
    <span class="so-photo-tag {{ $m->level === 1 ? 'is-gold' : '' }}"><i class="fas {{ $m->icon ?: 'fa-user' }}"></i></span>
  </div>
  <div class="so-feed-actions" aria-label="Interaksi postingan">
    <i class="far fa-heart" aria-hidden="true"></i>
    <i class="far fa-comment" aria-hidden="true"></i>
    <i class="far fa-paper-plane" aria-hidden="true"></i>
    <i class="far fa-bookmark so-bookmark" aria-hidden="true"></i>
  </div>
  <h3 class="so-card-name">{{ $m->position }}</h3>
  @if($m->person)<div class="so-card-person">{{ $m->person }}</div>@endif
  <div class="so-card-role"><i class="fas {{ $m->level === 1 ? 'fa-star' : 'fa-briefcase' }}"></i> {{ $m->badge ?: $m->position }}</div>
  @if($m->description)<p class="so-card-unit">{{ $m->description }}</p>@endif
</article>
