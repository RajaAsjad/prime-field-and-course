{{-- Header include: navigation + mobile menu --}}
@php
  $isHome = request()->routeIs('home');
  $homeUrl = route('home');
  $headerLinks = ($navigationLinks['header'] ?? collect());
  $headerCtas = $siteSettings->homepage()['header_ctas'] ?? [];
  $resolveNavUrl = function (string $url) use ($isHome, $homeUrl): string {
      if (str_starts_with($url, '#')) {
          return $isHome ? $url : $homeUrl.$url;
      }

      if (str_starts_with($url, '/')) {
          return url($url);
      }

      return $url;
  };
@endphp
  <nav id="nav" class="{{ $isHome ? '' : 'solid' }}" @if (! $isHome) data-force-solid="1" @endif>
    <div class="wrap">
      <div class="nav-wrap">
        <a href="{{ $homeUrl }}#hero" class="nav-logo" aria-label="{{ $siteSettings->displaySiteName() }} {{ $siteSettings->displayTagline() }}">
          @include('partials.site-brand', ['context' => 'header'])
        </a>
        <ul class="nav-links" role="list">
          @foreach ($headerLinks as $link)
            <li>
              <a href="{{ $resolveNavUrl($link->url) }}" class="nv"
                @if ($link->open_new_tab) target="_blank" rel="noopener noreferrer" @endif>{{ $link->label }}</a>
            </li>
          @endforeach
        </ul>
        <div class="nav-cta">
          @if (!empty($headerCtas['primary']['label']))
            <a href="{{ $resolveNavUrl($headerCtas['primary']['url'] ?? '#premium') }}" class="btn btn-primary btn-sm">{{ $headerCtas['primary']['label'] }}</a>
          @endif
          @if (!empty($headerCtas['secondary']['label']))
            <a href="{{ $headerCtas['secondary']['url'] ?? '#' }}" target="_blank" rel="sponsored noopener noreferrer" class="btn btn-gold btn-sm">{{ $headerCtas['secondary']['label'] }}</a>
          @endif
        </div>
        <button class="ham" id="ham" aria-expanded="false"><span></span><span></span><span></span></button>
      </div>
    </div>
  </nav>

  <div id="mob" role="dialog">
    <ul class="mob-links" role="list">
      @foreach ($headerLinks as $link)
        <li>
          <a href="{{ $resolveNavUrl($link->url) }}" class="mob-nv"
            @if ($link->open_new_tab) target="_blank" rel="noopener noreferrer" @endif>{{ $link->label }}</a>
        </li>
      @endforeach
    </ul>
    <div class="mob-cta">
      @if (!empty($headerCtas['primary']['label']))
        <a href="{{ $resolveNavUrl($headerCtas['primary']['url'] ?? '#premium') }}" class="btn btn-primary">{{ $headerCtas['primary']['label'] }}</a>
      @endif
      @if (!empty($headerCtas['secondary']['label']))
        <a href="{{ $headerCtas['secondary']['url'] ?? '#' }}" target="_blank" rel="sponsored noopener noreferrer" class="btn btn-gold">{{ $headerCtas['secondary']['label'] }}</a>
      @endif
    </div>
  </div>
