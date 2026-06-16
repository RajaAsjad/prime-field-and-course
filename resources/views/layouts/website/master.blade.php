<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="@yield('meta_description', $site['description'] ?? '')" name="description">
    <meta content="@yield('keywords', $site['name'] ?? '')" name="keywords">
    <meta name="theme-color" content="{{ $site['theme']['theme_color'] ?? '#1a5c1a' }}">
    <title>@yield('title', $site['name'] ?? 'Website')</title>
    @php
        $fav = trim($home_page_data['header_favicon'] ?? '');
    @endphp
    @if ($fav !== '')
        <link rel="icon" href="{{ asset('public/admin/assets/images/page/' . $fav) }}" type="image/png">
    @else
        <link rel="icon" href="{{ asset($site['assets']['favicon'] ?? 'assets/website/favicon.svg') }}" type="image/svg+xml">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @if (!empty($site['theme']['google_fonts']))
        <link href="{{ $site['theme']['google_fonts'] }}" rel="stylesheet">
    @endif
    @if (!empty($site['theme']['fontshare']))
        <link href="{{ $site['theme']['fontshare'] }}" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="{{ asset($site['assets']['css'] ?? 'assets/website/css/site.css') }}">
    @stack('styles')
</head>
<body>
    <a class="skip" href="#main">Skip to main content</a>

    @include('layouts.website.header')

    @yield('content')

    @include('layouts.website.footer')

    <button class="btt" id="btt" aria-label="Back to top of page">
        <svg viewBox="0 0 24 24" aria-hidden="true"><polyline points="18 15 12 9 6 15"/></svg>
    </button>

    @if (!empty($site['features']['audio_player']))
        @include('layouts.website.partials.player')
    @endif

    <script src="{{ asset($site['assets']['js'] ?? 'assets/website/js/site.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
