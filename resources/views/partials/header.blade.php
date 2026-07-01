{{-- Header include: navigation + mobile menu --}}
  <nav id="nav">
    <div class="wrap">
      <div class="nav-wrap">
        <a href="{{ route('home') }}#hero" class="nav-logo" aria-label="{{ $siteSettings->displaySiteName() }} {{ $siteSettings->displayTagline() }}">
          @include('partials.site-brand', ['context' => 'header'])
        </a>
        <ul class="nav-links" role="list">
          <li><a href="#strategy" class="nv">Strategy</a></li>
          <li><a href="#promos" class="nv">Promos</a></li>
          <li><a href="#best-picks" class="nv">Best Picks</a></li>
          <li><a href="#running-odds" class="nv">Live Odds</a></li>
          <li><a href="#golf-betting" class="nv">Golf Betting</a></li>
          <li><a href="#tournaments" class="nv">Tournaments</a></li>
          <li><a href="#faq" class="nv">FAQ</a></li>
        </ul>
        <div class="nav-cta"><a href="#premium" class="btn btn-primary btn-sm">Get Insider Picks</a><a href="#promos"
            class="btn btn-gold btn-sm">Claim Bonus</a></div><button class="ham" id="ham"
          aria-expanded="false"><span></span><span></span><span></span></button>
      </div>
    </div>
  </nav>

  <div id="mob" role="dialog">
    <ul class="mob-links" role="list">
      <li><a href="#strategy" class="mob-nv">Strategy</a></li>
      <li><a href="#promos" class="mob-nv">Promos</a></li>
      <li><a href="#best-picks" class="mob-nv">Best Picks</a></li>
      <li><a href="#running-odds" class="mob-nv">Live Odds</a></li>
      <li><a href="#golf-betting" class="mob-nv">Golf Betting</a></li>
      <li><a href="#tournaments" class="mob-nv">Tournaments</a></li>
      <li><a href="#faq" class="mob-nv">FAQ</a></li>
    </ul>
    <div class="mob-cta"><a href="#premium" class="btn btn-primary">Get Insider Picks</a><a href="#promos"
        class="btn btn-gold">Claim Bonus</a></div>
  </div>
