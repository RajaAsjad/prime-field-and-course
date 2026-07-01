@php
    $settings = $siteSettings ?? site_settings();
    $context = $context ?? 'header';
    $logoUrl = $context === 'footer' ? $settings->footerLogoUrl() : $settings->siteLogoUrl();
    $name = $siteName ?? $settings->displaySiteName();
@endphp

@if ($logoUrl)
    <img
        src="{{ $logoUrl }}"
        alt="{{ $name }}"
        class="site-logo-img {{ $context === 'footer' ? 'site-logo-img--footer' : 'site-logo-img--header' }}"
        style="height:{{ $context === 'footer' ? '48' : '52' }}px;width:auto;max-width:220px;object-fit:contain;display:block;"
    />
@else
<span class="logo-mark" aria-hidden="true">
  <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
    <rect width="40" height="40" rx="9" fill="#1a5c28" />
    <path d="M14 28V11.5" stroke="#fff" stroke-width="2" stroke-linecap="round" />
    <path d="M14 11.5L22.5 15L14 18.5V11.5Z" fill="#fff" />
    <path d="M10 28H28" stroke="#fff" stroke-width="2" stroke-linecap="round" />
    <circle cx="22" cy="28" r="1.5" fill="#fff" />
  </svg>
</span>
    <span class="logo-text">
        <span class="logo-name">{{ $name }}</span>
        <span class="logo-tag">{{ $settings->displayTagline() }}</span>
    </span>
@endif
