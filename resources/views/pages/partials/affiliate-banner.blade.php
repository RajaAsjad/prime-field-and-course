@php
  $banner = $homepage['affiliate_banner'] ?? [];
  $spacingClass = $spacingClass ?? '';
@endphp
@if (\App\Support\HomepageDefaults::bannerVisible($homepage, $placement))
  <section class="betmgm-offer {{ $spacingClass }}">
    <div class="wrap">
      <div class="betmgm-banner">
        @if (!empty($banner['brand_name']))
          <span class="betmgm-banner__logo">{{ $banner['brand_name'] }}</span>
        @endif
        <span class="betmgm-banner__copy">
          @if (!empty($banner['title']))
            <span class="betmgm-banner__title">{{ $banner['title'] }}</span>
          @endif
          @if (!empty($banner['description']))
            <span class="betmgm-banner__terms">{{ $banner['description'] }}</span>
          @endif
        </span>
        @if (!empty($banner['cta_url']))
          <a href="{{ $banner['cta_url'] }}"
            class="betmgm-banner__cta"
            target="_blank"
            rel="sponsored noopener noreferrer"><span class="betmgm-banner__cta-label">{{ $banner['cta_label'] ?: 'Claim Offer' }}</span><span class="betmgm-banner__cta-arrow" aria-hidden="true">&rarr;</span></a>
        @endif
      </div>
      @if (!empty($banner['pixel_url']))
        <img class="betmgm-banner__pixel" src="{{ $banner['pixel_url'] }}" width="1" height="1" border="0" alt="" />
      @endif
    </div>
  </section>
@endif
