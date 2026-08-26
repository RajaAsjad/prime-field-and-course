@php
    $settings = $siteSettings ?? site_settings();
    $favicon = $settings->faviconUrl();
    $faviconHref = $favicon
        ? $favicon.(str_contains($favicon, '?') ? '&' : '?').'v='.($settings->updated_at?->timestamp ?? time())
        : '/assets/images/favicon.svg';
    $faviconType = $favicon ? $settings->faviconType() : 'image/svg+xml';
@endphp
<link rel="icon" href="{{ $faviconHref }}" type="{{ $faviconType }}" />
<link rel="shortcut icon" href="{{ $faviconHref }}" type="{{ $faviconType }}" />
<link rel="apple-touch-icon" href="{{ $faviconHref }}" />
