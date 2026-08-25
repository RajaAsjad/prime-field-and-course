{{-- Footer include --}}
@php
  $homeUrl = route('home');
  $footHref = fn (string $url): string => str_starts_with($url, '#')
      ? (request()->routeIs('home') ? $url : $homeUrl.$url)
      : (str_starts_with($url, '/') ? url($url) : $url);
  $quickLinks = $navigationLinks['footer_quick'] ?? collect();
  $guideLinks = $navigationLinks['footer_guides'] ?? collect();
  $legalLinks = $navigationLinks['footer_legal'] ?? collect();
@endphp
  <footer>
    <div class="wrap">
      <div class="foot-grid">
        <div>
          <a href="{{ route('home') }}#hero" class="foot-logo" aria-label="{{ $siteSettings->displaySiteName() }} {{ $siteSettings->displayTagline() }}">
            @include('partials.site-brand', ['context' => 'footer'])
          </a>
          @if ($siteSettings->footer_description)
            <p class="foot-tag">{{ $siteSettings->footer_description }}</p>
          @endif

          @if ($siteSettings->contact_email || $siteSettings->contact_phone || $siteSettings->address)
            <div class="foot-contact">
              @if ($siteSettings->contact_email)
                <p><a href="mailto:{{ $siteSettings->contact_email }}">{{ $siteSettings->contact_email }}</a></p>
              @endif
              @if ($siteSettings->contact_phone)
                <p><a href="tel:{{ preg_replace('/\s+/', '', $siteSettings->contact_phone) }}">{{ $siteSettings->contact_phone }}</a></p>
              @endif
              @if ($siteSettings->address)
                <p>{{ $siteSettings->address }}</p>
              @endif
            </div>
          @endif

          @if ($siteSettings->hasSocialLinks())
            <div class="foot-social">
              @if ($siteSettings->facebook_url)
                <a href="{{ $siteSettings->facebook_url }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook">Facebook</a>
              @endif
              @if ($siteSettings->instagram_url)
                <a href="{{ $siteSettings->instagram_url }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram">Instagram</a>
              @endif
              @if ($siteSettings->linkedin_url)
                <a href="{{ $siteSettings->linkedin_url }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">LinkedIn</a>
              @endif
              @if ($siteSettings->youtube_url)
                <a href="{{ $siteSettings->youtube_url }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube">YouTube</a>
              @endif
              @if ($siteSettings->twitter_url)
                <a href="{{ $siteSettings->twitter_url }}" target="_blank" rel="noopener noreferrer" aria-label="Twitter">X</a>
              @endif
            </div>
          @endif
        </div>
        @if ($quickLinks->isNotEmpty())
          <div>
            <p class="foot-col-title">Quick Links</p>
            <ul class="foot-links">
              @foreach ($quickLinks as $link)
                <li><a href="{{ $footHref($link->url) }}" @if($link->open_new_tab) target="_blank" rel="noopener noreferrer" @endif>{{ $link->label }}</a></li>
              @endforeach
            </ul>
          </div>
        @endif
        @if ($guideLinks->isNotEmpty())
          <div>
            <p class="foot-col-title">Guides</p>
            <ul class="foot-links">
              @foreach ($guideLinks as $link)
                <li><a href="{{ $footHref($link->url) }}" @if($link->open_new_tab) target="_blank" rel="noopener noreferrer" @endif>{{ $link->label }}</a></li>
              @endforeach
            </ul>
          </div>
        @endif
        @if ($legalLinks->isNotEmpty())
          <div>
            <p class="foot-col-title">Legal</p>
            <ul class="foot-links">
              @foreach ($legalLinks as $link)
                <li><a href="{{ $footHref($link->url) }}" @if($link->open_new_tab) target="_blank" rel="noopener noreferrer" @endif>{{ $link->label }}</a></li>
              @endforeach
            </ul>
          </div>
        @endif
        <div>
          <p class="foot-col-title">Newsletter</p>
          <p style="font-size:.82rem;color:rgba(255,255,255,.4);line-height:1.62;margin-bottom:14px">Top 5 picks every
            Tuesday, free forever.</p>
          <form action="#" method="post">
            <div style="display:flex;gap:7px"><input type="email" placeholder="your@email.com"
                style="flex:1;height:42px;background:rgba(255,255,255,.06);border:1.5px solid rgba(255,255,255,.12);border-radius:10px;padding:0 13px;font-size:.84rem;color:#fff;font-family:inherit"
                required /><button type="submit"
                style="height:42px;padding:0 16px;background:var(--au-500);color:#0d1e10;font-weight:800;font-size:.78rem;border-radius:10px;font-family:inherit;flex-shrink:0">Join</button>
            </div>
          </form>
        </div>
      </div>
      <div class="foot-bottom">
        <p class="foot-copy">{{ $siteSettings->displayCopyright() }}</p>
      </div>
    </div>
  </footer>
