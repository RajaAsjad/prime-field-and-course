@php
    $settings = $siteSettings ?? site_settings();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>@yield('title', $settings->displaySiteName() . ' & Promotions')</title>
  <meta name="description"
    content="@yield('meta_description', 'Golf betting tips, expert picks, exclusive sportsbook bonuses, live odds comparison.')" />
  @include('partials.favicon')
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
