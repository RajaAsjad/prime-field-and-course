{{-- Header include: navigation + mobile menu --}}
@php
  $isHome = request()->routeIs('home');
  $homeUrl = route('home');
  $navHref = fn (string $hash): string => $isHome ? $hash : $homeUrl . $hash;
@endphp
  <nav id="nav" class="{{ $isHome ? '' : 'solid' }}" @if (! $isHome) data-force-solid="1" @endif>
    <div class="wrap">
      <div class="nav-wrap">
        <a href="{{ $homeUrl }}#hero" class="nav-logo" aria-label="{{ $siteSettings->displaySiteName() }} {{ $siteSettings->displayTagline() }}">
          @include('partials.site-brand', ['context' => 'header'])
        </a>
        <ul class="nav-links" role="list">
          <li><a href="{{ $navHref('#strategy') }}" class="nv">Strategy</a></li>
          <li><a href="{{ $navHref('#promos') }}" class="nv">Promos</a></li>
          <li><a href="{{ $navHref('#best-picks') }}" class="nv">Best Picks</a></li>
          <li><a href="{{ $navHref('#competition-feeds') }}" class="nv">Rankings</a></li>
          <li><a href="{{ $navHref('#running-odds') }}" class="nv">Live Odds</a></li>
          <li><a href="{{ $navHref('#golf-betting') }}" class="nv">Golf Betting</a></li>
          <li><a href="{{ $navHref('#tournaments') }}" class="nv">Tournaments</a></li>
          <li><a href="{{ $navHref('#faq') }}" class="nv">FAQ</a></li>
        </ul>
        <div class="nav-cta"><a href="{{ $navHref('#premium') }}" class="btn btn-primary btn-sm">Get Insider Picks</a><a href="https://www.anrdoezrs.net/click-101764042-17337458" 
            target="_blank" rel="sponsored noopener noreferrer" class="btn btn-gold btn-sm">Claim Bonus</a></div><button class="ham" id="ham"
          aria-expanded="false"><span></span><span></span><span></span></button>
      </div>
    </div>
  </nav>

  <div id="mob" role="dialog">
    <ul class="mob-links" role="list">
      <li><a href="{{ $navHref('#strategy') }}" class="mob-nv">Strategy</a></li>
      <li><a href="{{ $navHref('#promos') }}" class="mob-nv">Promos</a></li>
      <li><a href="{{ $navHref('#best-picks') }}" class="mob-nv">Best Picks</a></li>
      <li><a href="{{ $navHref('#competition-feeds') }}" class="mob-nv">Rankings</a></li>
      <li><a href="{{ $navHref('#running-odds') }}" class="mob-nv">Live Odds</a></li>
      <li><a href="{{ $navHref('#golf-betting') }}" class="mob-nv">Golf Betting</a></li>
      <li><a href="{{ $navHref('#tournaments') }}" class="mob-nv">Tournaments</a></li>
      <li><a href="{{ $navHref('#faq') }}" class="mob-nv">FAQ</a></li>
    </ul>
    <div class="mob-cta"><a href="{{ $navHref('#premium') }}" class="btn btn-primary">Get Insider Picks</a><a href="https://www.anrdoezrs.net/click-101764042-17337458" 
            target="_blank" rel="sponsored noopener noreferrer" class="btn btn-gold">Claim Bonus</a></div>
  </div>
