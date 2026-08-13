@extends('layouts.app')

@section('content')
  @php
    $paragraphs = preg_split('/\R{2,}|\n+/', trim((string) ($article['content'] ?? ''))) ?: [];
    $paragraphs = array_values(array_filter(array_map('trim', $paragraphs)));
    $wordCount = str_word_count(strip_tags((string) ($article['content'] ?? '')));
    $readMins = max(1, (int) ceil($wordCount / 200));
  @endphp
  <main id="main" class="article-page">
    <section class="article-hero">
      <div class="wrap article-wrap">
        <a href="{{ route('home') }}#rotoballer-news" class="article-back">&larr; Back to News Feed</a>

        <div class="article-kicker">
          <span class="eyebrow">
            <span style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>
            RotoBaller News
          </span>
          @if (!empty($article['category']))
            <span class="art-tag article-tag">{{ str_replace('-', ' ', $article['category']) }}</span>
          @endif
        </div>

        <h1 class="article-title">{{ $article['title'] }}</h1>

        <div class="article-meta">
          <span class="article-source">{{ $article['source'] ?: 'RotoBaller' }}</span>
          @if (!empty($article['author']))
            <span>{{ $article['author'] }}</span>
          @endif
          @if (!empty($article['updated_at']))
            <time datetime="{{ $article['updated_at'] }}">{{ \Carbon\Carbon::parse($article['updated_at'])->format('M j, Y g:i A') }}</time>
          @endif
          <span>{{ $readMins }} min read</span>
        </div>
      </div>
    </section>

    <section class="section-green-pale article-body-section">
      <div class="wrap article-wrap">
        <article class="article-paper">
          @if ($paragraphs !== [])
            <div class="article-body">
              @foreach ($paragraphs as $paragraph)
                <p>{{ $paragraph }}</p>
              @endforeach
            </div>
          @endif

          @if (!empty($article['url']))
            <a href="{{ $article['url'] }}" class="article-source-link" target="_blank" rel="noopener noreferrer">
              Read original on RotoBaller &rarr;
            </a>
          @endif
        </article>

        @if (!empty($related))
          <div class="article-related">
            <h2>More player news</h2>
            <div class="article-related-grid">
              @foreach ($related as $item)
                <a href="{{ $item['detail_url'] }}" class="article-related-card">
                  @if (!empty($item['category']))
                    <span class="art-tag">{{ str_replace('-', ' ', $item['category']) }}</span>
                  @endif
                  <h3>{{ $item['title'] }}</h3>
                  @if (!empty($item['updated_at']))
                    <time datetime="{{ $item['updated_at'] }}">{{ \Carbon\Carbon::parse($item['updated_at'])->format('M j, Y') }}</time>
                  @endif
                </a>
              @endforeach
            </div>
          </div>
        @endif
      </div>
    </section>
  </main>
@endsection

@push('styles')
  <style>
    .article-page {
      padding-top: var(--nav-h);
    }

    .article-wrap {
      max-width: 820px;
    }

    .article-hero {
      padding: 36px 0 28px;
      background: #fff;
      border-bottom: 1px solid var(--bdr);
    }

    .article-back {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 22px;
      font-size: .82rem;
      font-weight: 700;
      color: var(--g-600);
    }

    .article-kicker {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 16px;
    }

    .article-tag {
      position: static;
    }

    .article-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.7rem, 3.4vw, 2.6rem);
      font-weight: 900;
      line-height: 1.18;
      letter-spacing: -.02em;
      color: var(--tx-h);
      margin-bottom: 16px;
    }

    .article-meta {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 8px 14px;
      color: #6a8070;
      font-size: .82rem;
    }

    .article-meta span,
    .article-meta time {
      position: relative;
    }

    .article-meta > * + *:before {
      content: '·';
      margin-right: 14px;
      color: #c8a84b;
    }

    .article-source {
      font-weight: 800;
      letter-spacing: .06em;
      text-transform: uppercase;
      color: var(--g-600);
      font-size: .72rem;
    }

    .article-body-section {
      padding: 36px 0 80px;
    }

    .article-paper {
      background: #fff;
      border: 1.5px solid var(--bdr);
      border-radius: 20px;
      padding: clamp(22px, 4vw, 42px);
      box-shadow: 0 16px 40px rgba(13, 30, 16, .06);
    }

    .article-body {
      color: #243528;
      font-size: 1.05rem;
      line-height: 1.85;
    }

    .article-body p {
      margin: 0 0 1.15em;
    }

    .article-body p:first-child {
      font-size: 1.12rem;
      color: #1a2e1e;
    }

    .article-body p:last-child {
      margin-bottom: 0;
    }

    .article-source-link {
      display: inline-flex;
      margin-top: 28px;
      padding-top: 22px;
      border-top: 1px solid var(--bdr);
      font-size: .88rem;
      font-weight: 800;
      color: var(--g-600);
    }

    .article-related {
      margin-top: 36px;
    }

    .article-related h2 {
      font-family: 'Playfair Display', serif;
      font-size: 1.35rem;
      font-weight: 900;
      color: var(--tx-h);
      margin-bottom: 16px;
    }

    .article-related-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 14px;
    }

    .article-related-card {
      display: block;
      background: #fff;
      border: 1.5px solid var(--bdr);
      border-radius: 14px;
      padding: 16px;
      text-decoration: none;
      color: inherit;
      transition: transform .25s var(--ease-expo), box-shadow .25s var(--ease-expo), border-color .25s;
    }

    .article-related-card:hover {
      transform: translateY(-3px);
      border-color: #78c98a;
      box-shadow: 0 12px 28px rgba(26, 92, 40, .08);
    }

    .article-related-card .art-tag {
      position: static;
      display: inline-block;
      margin-bottom: 10px;
    }

    .article-related-card h3 {
      font-size: .92rem;
      font-weight: 800;
      line-height: 1.35;
      color: var(--tx-h);
      margin-bottom: 8px;
    }

    .article-related-card time {
      font-size: .72rem;
      color: #7a8a7e;
    }

    @media (max-width: 768px) {
      .article-related-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
@endpush
