@extends('layouts.app')

@section('content')
  <main id="main" class="tip-detail-page">
    <section class="section-white tip-detail">
      <div class="wrap">
        <div class="sec-head rev">
          <div class="eyebrow">
            <span style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>
            Expert Knowledge
          </div>
          @if (!empty($story['category']))
            <span class="art-tag tip-detail__tag">{{ $story['category'] }}</span>
          @endif
          <h1 class="h-section tip-detail__title">{{ $story['title'] }}</h1>
          <p class="body-lg" style="margin-bottom:0;color:#9aaa9e;font-size:.84rem;">
            {{ $story['byline'] }}
            @if (!empty($story['league']))
              &middot; {{ $story['league'] }}
            @endif
            @if (!empty($story['updated_at']))
              &middot; {{ \Carbon\Carbon::parse($story['updated_at'])->format('M j, Y g:i A') }}
            @endif
          </p>
        </div>

        @if (!empty($story['image']))
          <div class="tip-detail__media rev">
            <img
              src="{{ $story['image'] }}"
              alt="{{ $story['title'] }}"
              width="1200"
              height="675"
              loading="eager"
              decoding="async"
            />
          </div>
        @endif

        @if (!empty($story['content']))
          <div class="body-lg tip-detail__body rev">
            {!! nl2br(e($story['content'])) !!}
          </div>
        @endif

        <a href="{{ route('home') }}#strategy" class="read-more tip-detail__back">&larr; Back to Tips</a>
      </div>
    </section>
  </main>
@endsection

@push('styles')
  <style>
    .tip-detail-page {
      padding-top: calc(var(--nav-h) + 28px);
    }

    .tip-detail__back {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      width: auto;
      margin: 36px auto 0;
      padding: 8px 0;
      color: var(--g-600);
      text-decoration: none;
      transition: color .2s ease, gap .2s ease, transform .2s ease;
    }

    .tip-detail__back:hover {
      color: var(--g-700);
      gap: 10px;
      transform: translateX(-3px);
    }

    .tip-detail .wrap {
      display: flex;
      flex-direction: column;
    }

    .tip-detail__tag {
      position: static;
      display: inline-block;
      margin-bottom: 14px;
    }

    .tip-detail__title {
      margin-bottom: 12px;
    }

    .tip-detail__media {
      position: relative;
      width: 100%;
      max-width: 920px;
      margin: 0 auto 28px;
      border-radius: var(--r-lg);
      overflow: hidden;
      aspect-ratio: 16 / 9;
      background: linear-gradient(135deg, #edf7f0, #d4eddb);
      border: 1px solid var(--bdr);
      box-shadow: 0 10px 30px rgba(13, 30, 16, .08);
    }

    .tip-detail__media img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center center;
    }

    .tip-detail__body {
      max-width: 760px;
      margin: 0 auto;
      color: var(--tx-m);
      line-height: 1.75;
    }
  </style>
@endpush
