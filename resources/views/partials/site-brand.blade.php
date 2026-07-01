@php
    $settings = $siteSettings ?? site_settings();
    $context = $context ?? 'header';
    $logoUrl = $context === 'footer' ? $settings->footerLogoUrl() : $settings->siteLogoUrl();
@endphp

@if ($logoUrl)
    <img
        src="{{ $logoUrl }}"
        alt="{{ $settings->displaySiteName() }}"
        class="site-logo-img {{ $context === 'footer' ? 'site-logo-img--footer' : 'site-logo-img--header' }}"
    />
@else
    @include('partials.brand-logo', ['siteName' => $settings->displaySiteName()])
@endif
