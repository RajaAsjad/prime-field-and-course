@php
    $settings = $siteSettings ?? site_settings();
    $dbFavicon = $settings->faviconUrl();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>@yield('title', $settings->displaySiteName() . ' & Promotions')</title>
  <meta name="description"
    content="@yield('meta_description', 'Golf betting tips, expert picks, exclusive sportsbook bonuses, live odds comparison.')" />
  @if ($dbFavicon)
    @php
        $faviconExt = strtolower(pathinfo(parse_url($dbFavicon, PHP_URL_PATH) ?: '', PATHINFO_EXTENSION));
        $faviconType = match ($faviconExt) {
            'ico' => 'image/x-icon',
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'webp' => 'image/webp',
            default => 'image/svg+xml',
        };
    @endphp
    <link rel="icon" href="{{ $dbFavicon }}" type="{{ $faviconType }}" />
    <link rel="apple-touch-icon" href="{{ $dbFavicon }}" />
  @else
    <link rel="icon" href="/assets/images/favicon.svg" type="image/svg+xml" />
    <link rel="apple-touch-icon" href="/assets/images/favicon.svg" />
  @endif
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="/assets/css/style.css?v={{ filemtime(public_path('assets/css/style.css')) }}" />
  @stack('styles')
</head>

<body>
  {{-- Header include --}}
  @include('partials.header')

  @yield('content')

  {{-- Footer include --}}
  @include('partials.footer')

  {{-- Global scripts --}}
  <script src="/assets/js/main.js"></script>
  @stack('scripts')
</body>

</html>
