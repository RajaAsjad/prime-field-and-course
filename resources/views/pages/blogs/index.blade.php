@extends('layouts.app')

@section('title', 'Golf Betting Blog | ' . site_settings()->displaySiteName())
@section('meta_description', 'Expert golf betting insights, FedEx Cup analysis, odds movement breakdowns, and strategy guides from PinShot.')

@section('content')
  <main id="main" class="content-page blogs-index-page">
    <section class="content-hero">
      <div class="wrap">
        <div class="content-kicker">
          <span class="eyebrow">
            <span style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>
            Insights
          </span>
        </div>
        <h1 class="content-title">Golf Betting Blog</h1>
        <p class="content-intro">Deep dives on odds movement, tournament strategy, and how the golf betting board really behaves.</p>
      </div>
    </section>

    <section class="section-green-pale content-body-section">
      <div class="wrap">
        <div class="blogs-grid">
          @forelse ($blogs as $blog)
            <a href="{{ $blog->publicUrl() }}" class="blog-card rev">
              @if ($blog->imageUrl())
                <div class="blog-card__media">
                  <img src="{{ $blog->imageUrl() }}" alt="{{ $blog->title }}" loading="lazy" decoding="async">
                </div>
              @endif
              <div class="blog-card__body">
                @if ($blog->published_at)
                  <time class="blog-card__date" datetime="{{ $blog->published_at->toDateString() }}">
                    {{ $blog->published_at->format('M j, Y') }}
                  </time>
                @endif
                <h2 class="blog-card__title">{{ $blog->title }}</h2>
                @if ($blog->excerpt)
                  <p class="blog-card__excerpt">{{ $blog->excerpt }}</p>
                @endif
                <span class="blog-card__cta">Read article &rarr;</span>
              </div>
            </a>
          @empty
            <p class="blogs-empty">No blog posts published yet.</p>
          @endforelse
        </div>

        @if ($blogs->hasPages())
          <div class="blogs-pagination">
            {{ $blogs->links('pagination.blogs') }}
          </div>
        @endif
      </div>
    </section>
  </main>
@endsection

@push('styles')
  @include('pages.content._styles')
  <style>
    .blogs-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 22px;
    }

    .blog-card {
      display: flex;
      flex-direction: column;
      background: #fff;
      border: 1.5px solid var(--bdr);
      border-radius: 18px;
      overflow: hidden;
      text-decoration: none;
      color: inherit;
      box-shadow: 0 10px 28px rgba(13, 30, 16, .05);
      transition: transform .2s ease, box-shadow .2s ease;
    }

    .blog-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 16px 36px rgba(13, 30, 16, .1);
    }

    .blog-card__media {
      aspect-ratio: 16 / 9;
      background: linear-gradient(135deg, #edf7f0, #d4eddb);
      overflow: hidden;
    }

    .blog-card__media img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .blog-card__body {
      padding: 20px 18px 22px;
      display: flex;
      flex-direction: column;
      gap: 8px;
      flex: 1;
    }

    .blog-card__date {
      font-size: .72rem;
      font-weight: 700;
      letter-spacing: .06em;
      text-transform: uppercase;
      color: var(--au-500);
    }

    .blog-card__title {
      font-family: 'Playfair Display', serif;
      font-size: 1.2rem;
      font-weight: 900;
      line-height: 1.25;
      color: var(--tx-h);
      margin: 0;
    }

    .blog-card__excerpt {
      font-size: .92rem;
      line-height: 1.6;
      color: #3a4f3e;
      margin: 0;
      flex: 1;
    }

    .blog-card__cta {
      margin-top: 8px;
      font-size: .85rem;
      font-weight: 700;
      color: var(--g-600);
    }

    .blogs-empty {
      grid-column: 1 / -1;
      text-align: center;
      color: var(--tx-m);
      padding: 40px 0;
    }

    .blogs-pagination {
      margin-top: 36px;
      display: flex;
      justify-content: center;
    }

    .blogs-pagination nav {
      width: 100%;
    }

    .blogs-pagination .pagination {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
      gap: 8px;
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .blogs-pagination .page-item {
      margin: 0;
    }

    .blogs-pagination .page-link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 40px;
      height: 40px;
      padding: 0 12px;
      border: 1.5px solid var(--bdr);
      border-radius: 10px;
      background: #fff;
      color: var(--g-700);
      font-size: .9rem;
      font-weight: 700;
      text-decoration: none;
      box-shadow: 0 4px 12px rgba(13, 30, 16, .04);
      transition: background .15s ease, border-color .15s ease, color .15s ease;
    }

    .blogs-pagination .page-link:hover {
      border-color: #b7d4be;
      color: var(--g-700);
      background: #f3faf5;
    }

    .blogs-pagination .page-item.active .page-link {
      background: var(--g-600, #1a5c28);
      border-color: var(--g-600, #1a5c28);
      color: #fff;
    }

    .blogs-pagination .page-item.disabled .page-link {
      opacity: .45;
      pointer-events: none;
      background: #f7faf8;
    }

    .blogs-pagination__info {
      width: 100%;
      text-align: center;
      margin: 0 0 14px;
      color: var(--tx-m);
      font-size: .85rem;
    }

    .blogs-pagination__info strong {
      color: var(--g-700);
      font-weight: 800;
    }

    @media (max-width: 980px) {
      .blogs-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    @media (max-width: 640px) {
      .blogs-grid { grid-template-columns: 1fr; }
    }
  </style>
@endpush
