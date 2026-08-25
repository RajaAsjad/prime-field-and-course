@extends('layouts.app')

@section('title', $page['title'] . ' | ' . site_settings()->displaySiteName())
@section('meta_description', $page['meta_description'])

@section('content')
  <main id="main" class="content-page apps-page">
    <section class="content-hero">
      <div class="wrap">
        <div class="content-kicker">
          <span class="eyebrow">
            <span style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>
            {{ $page['eyebrow'] }}
          </span>
        </div>
        <h1 class="content-title">{{ $page['title'] }}</h1>
        @if (!empty($page['subtitle']))
          <p class="content-subtitle">{{ $page['subtitle'] }}</p>
        @endif
        <p class="content-intro">{{ $page['intro'] }}</p>
      </div>
    </section>

    <section class="section-green-pale content-body-section">
      <div class="wrap">
        <div class="apps-grid">
          @foreach ($page['apps'] as $index => $app)
            <article class="app-card rev" style="--delay: {{ $index * 0.06 }}s">
              <div class="app-card__header">
                <div class="app-card__rank">{{ $index + 1 }}</div>
                <div>
                  <h2 class="app-card__name">{{ $app['name'] }}</h2>
                  <p class="app-card__tagline">{{ $app['tagline'] }}</p>
                </div>
              </div>
              <p class="app-card__desc">{{ $app['description'] }}</p>
              <div class="app-card__cols">
                <div class="app-card__pros">
                  <h3>Pros</h3>
                  <ul>
                    @foreach ($app['pros'] as $pro)
                      <li>{{ $pro }}</li>
                    @endforeach
                  </ul>
                </div>
                <div class="app-card__cons">
                  <h3>Cons</h3>
                  <ul>
                    @foreach ($app['cons'] as $con)
                      <li>{{ $con }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="app-card__tip">
                <span class="app-card__tip-label">Pro Tip</span>
                {{ $app['tip'] }}
              </div>
            </article>
          @endforeach
        </div>

        <div class="apps-tips content-paper rev">
          <h2 class="apps-tips__title">Missouri Golf Betting Tips</h2>
          <div class="apps-tips__grid">
            @foreach ($page['tips'] as $tip)
              <div class="apps-tip-item">
                <h3>{{ $tip['title'] }}</h3>
                <p>{{ $tip['text'] }}</p>
              </div>
            @endforeach
          </div>
        </div>

        @include('pages.content._related')
      </div>
    </section>
  </main>
@endsection

@push('styles')
  @include('pages.content._styles')
  <style>
    .apps-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 20px;
      margin-bottom: 28px;
    }

    .app-card {
      background: #fff;
      border: 1.5px solid var(--bdr);
      border-radius: 20px;
      padding: clamp(20px, 3vw, 28px);
      box-shadow: 0 12px 32px rgba(13, 30, 16, .05);
      transition: transform .3s var(--ease-expo), box-shadow .3s, border-color .3s;
    }

    .app-card:hover {
      transform: translateY(-4px);
      border-color: #78c98a;
      box-shadow: 0 18px 40px rgba(26, 92, 40, .09);
    }

    .app-card__header {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      margin-bottom: 14px;
    }

    .app-card__rank {
      flex-shrink: 0;
      width: 42px;
      height: 42px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 12px;
      background: linear-gradient(135deg, var(--g-600), var(--g-700));
      color: #fff;
      font-size: 1rem;
      font-weight: 900;
    }

    .app-card__name {
      font-family: 'Playfair Display', serif;
      font-size: 1.35rem;
      font-weight: 900;
      color: var(--tx-h);
      line-height: 1.2;
    }

    .app-card__tagline {
      font-size: .82rem;
      font-weight: 700;
      color: var(--au-500);
      margin-top: 4px;
    }

    .app-card__desc {
      font-size: .92rem;
      line-height: 1.7;
      color: #3a4f3e;
      margin-bottom: 18px;
    }

    .app-card__cols {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
      margin-bottom: 16px;
    }

    .app-card__pros h3,
    .app-card__cons h3 {
      font-size: .72rem;
      font-weight: 800;
      letter-spacing: .08em;
      text-transform: uppercase;
      margin-bottom: 8px;
    }

    .app-card__pros h3 { color: var(--g-600); }
    .app-card__cons h3 { color: #b45309; }

    .app-card__pros ul,
    .app-card__cons ul {
      list-style: none;
    }

    .app-card__pros li,
    .app-card__cons li {
      font-size: .84rem;
      line-height: 1.55;
      color: var(--tx-m);
      padding-left: 16px;
      position: relative;
      margin-bottom: 4px;
    }

    .app-card__pros li::before {
      content: '✓';
      position: absolute;
      left: 0;
      color: var(--g-600);
      font-weight: 800;
    }

    .app-card__cons li::before {
      content: '−';
      position: absolute;
      left: 0;
      color: #b45309;
      font-weight: 800;
    }

    .app-card__tip {
      padding: 14px 16px;
      background: linear-gradient(135deg, #faf6ea, #f5eed8);
      border-radius: 12px;
      border: 1px solid rgba(200, 168, 75, .25);
      font-size: .84rem;
      line-height: 1.6;
      color: #4a4020;
    }

    .app-card__tip-label {
      display: inline-block;
      font-size: .68rem;
      font-weight: 800;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: var(--au-500);
      margin-right: 6px;
    }

    .apps-tips__title {
      font-family: 'Playfair Display', serif;
      font-size: 1.4rem;
      font-weight: 900;
      color: var(--tx-h);
      margin-bottom: 20px;
    }

    .apps-tips__grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 18px;
    }

    .apps-tip-item h3 {
      font-size: .92rem;
      font-weight: 800;
      color: var(--g-600);
      margin-bottom: 6px;
    }

    .apps-tip-item p {
      font-size: .86rem;
      line-height: 1.65;
      color: var(--tx-m);
    }

    @media (max-width: 900px) {
      .apps-grid,
      .apps-tips__grid {
        grid-template-columns: 1fr;
      }

      .app-card__cols {
        grid-template-columns: 1fr;
      }
    }
  </style>
@endpush
