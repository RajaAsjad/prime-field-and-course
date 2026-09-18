@extends('layouts.app')

@section('title', $blog->seoTitle() . ' | ' . site_settings()->displaySiteName())
@section('meta_description', $blog->meta_description ?: ($blog->excerpt ?: 'Golf betting insights from PinShot.'))

@section('content')
  <main id="main" class="content-page blog-detail-page">
    <section class="content-hero">
      <div class="wrap">
        <a href="{{ route('blogs.index') }}" class="content-back">&larr; Back to Blog</a>
        <div class="content-kicker">
          <span class="eyebrow">
            <span style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>
            Blog
          </span>
          @if ($blog->published_at)
            <time class="blog-detail__date" datetime="{{ $blog->published_at->toDateString() }}">
              {{ $blog->published_at->format('F j, Y') }}
            </time>
          @endif
        </div>
        <h1 class="content-title">{{ $blog->title }}</h1>
        @if ($blog->excerpt)
          <p class="content-intro">{{ $blog->excerpt }}</p>
        @endif
      </div>
    </section>

    <section class="section-green-pale content-body-section">
      <div class="wrap">
        <article class="content-paper blog-detail__article rev">
          @if ($blog->imageUrl())
            <div class="blog-detail__media">
              <img
                src="{{ $blog->imageUrl() }}"
                alt="{{ $blog->title }}"
                width="1200"
                height="675"
                loading="eager"
                decoding="async"
              />
            </div>
          @endif

          @if ($blog->body)
            <div class="blog-detail__body">
              {!! $blog->body !!}
            </div>
          @endif
        </article>

        @if ($related->isNotEmpty())
          <div class="content-related rev">
            <h2>More from the blog</h2>
            <div class="content-related-grid">
              @foreach ($related as $item)
                <a href="{{ $item->publicUrl() }}" class="content-related-card">
                  <span class="content-related-eyebrow">Blog</span>
                  <h3>{{ $item->title }}</h3>
                  <p>{{ \Illuminate\Support\Str::limit($item->excerpt ?: strip_tags($item->body ?? ''), 120) }}</p>
                </a>
              @endforeach
            </div>
          </div>
        @endif
      </div>
    </section>
    @include('pages.partials.affiliate-banner', ['placement' => 'blogs.after_content', 'spacingClass' => 'betmgm-offer-mt'])
  </main>
@endsection

@push('styles')
  @include('pages.content._styles')
  <style>
    .blog-detail__date {
      font-size: .78rem;
      font-weight: 700;
      color: var(--tx-m);
    }

    .blog-detail__media {
      width: 100%;
      max-width: 920px;
      margin: 0 auto 28px;
      border-radius: 16px;
      overflow: hidden;
      aspect-ratio: 16 / 9;
      background: linear-gradient(135deg, #edf7f0, #d4eddb);
    }

    .blog-detail__media img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .blog-detail__body {
      font-size: 1.02rem;
      line-height: 1.8;
      color: #2f4334;
      max-width: 760px;
      margin: 0 auto;
    }

    .blog-detail__body h2 {
      font-family: 'Playfair Display', serif;
      font-size: 1.45rem;
      font-weight: 900;
      color: var(--tx-h);
      margin: 1.75em 0 .7em;
      line-height: 1.25;
    }

    .blog-detail__body h2:first-child {
      margin-top: 0;
    }

    .blog-detail__body p {
      margin: 0 0 1.1em;
    }

    .blog-detail__body ul,
    .blog-detail__body ol {
      margin: 0 0 1.1em;
      padding-left: 1.25em;
    }

    .blog-detail__body li {
      margin-bottom: .4em;
    }
  </style>
@endpush
