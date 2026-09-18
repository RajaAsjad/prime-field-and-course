@extends('layouts.app')

@section('title', ($page['meta_title'] ?? $page['title']) . ' | ' . site_settings()->displaySiteName())
@section('meta_description', $page['meta_description'])

@section('content')
  <main id="main" class="content-page hub-page">
    <section class="content-hero">
      <div class="wrap">
        <div class="content-kicker">
          <span class="eyebrow">
            <span style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>
            {{ $page['eyebrow'] ?? 'Hub' }}
          </span>
        </div>
        <h1 class="content-title">{{ $page['title'] }}</h1>
        @if (!empty($page['intro']))
          <p class="content-intro">{{ $page['intro'] }}</p>
        @endif
      </div>
    </section>

    <section class="section-green-pale content-body-section">
      <div class="wrap">
        <div class="hub-grid">
          @foreach ($page['cards'] ?? [] as $card)
            @php
              $url = trim((string) ($card['url'] ?? ''));
              $hasLink = $url !== '';
              $tag = $hasLink ? 'a' : 'div';
            @endphp
            <{{ $tag }}
              @if ($hasLink) href="{{ $url }}" @endif
              class="hub-card rev {{ $hasLink ? '' : 'hub-card--static' }}"
            >
              <h2 class="hub-card__title">{{ $card['title'] }}</h2>
              @if (!empty($card['description']))
                <p class="hub-card__text">{{ $card['description'] }}</p>
              @endif
              @if ($hasLink)
                <span class="hub-card__cta">Explore &rarr;</span>
              @endif
            </{{ $tag }}>
          @endforeach
        </div>

        @if (!empty($page['body']))
          <p class="hub-disclaimer rev">{{ $page['body'] }}</p>
        @endif

        @include('pages.content._related')
      </div>
    </section>
    @include('pages.partials.affiliate-banner', ['placement' => $affiliateBannerPlacement, 'spacingClass' => 'betmgm-offer-mt'])
  </main>
@endsection

@push('styles')
  @include('pages.content._styles')
  <style>
    .hub-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 18px;
    }

    .hub-card {
      display: flex;
      flex-direction: column;
      gap: 10px;
      background: #fff;
      border: 1.5px solid var(--bdr);
      border-radius: 18px;
      padding: 22px 20px 20px;
      text-decoration: none;
      color: inherit;
      box-shadow: 0 10px 28px rgba(13, 30, 16, .05);
      transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
      min-height: 100%;
    }

    a.hub-card:hover {
      transform: translateY(-3px);
      border-color: #b7d4be;
      box-shadow: 0 16px 36px rgba(13, 30, 16, .1);
    }

    .hub-card__title {
      font-family: 'Playfair Display', serif;
      font-size: 1.2rem;
      font-weight: 900;
      line-height: 1.25;
      color: var(--tx-h);
      margin: 0;
    }

    .hub-card__text {
      font-size: .92rem;
      line-height: 1.65;
      color: #3a4f3e;
      margin: 0;
      flex: 1;
    }

    .hub-card__cta {
      margin-top: 6px;
      font-size: .85rem;
      font-weight: 700;
      color: var(--g-600);
    }

    .hub-disclaimer {
      margin-top: 36px;
      font-size: .82rem;
      line-height: 1.6;
      color: var(--tx-m);
      text-align: center;
      max-width: 720px;
      margin-left: auto;
      margin-right: auto;
    }

    @media (max-width: 980px) {
      .hub-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    @media (max-width: 640px) {
      .hub-grid { grid-template-columns: 1fr; }
    }
  </style>
@endpush
