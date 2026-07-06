@extends('layouts.app')

@section('content')
  <main id="main">
    <section class="section-white">
      <div class="wrap">
        <div class="sec-head rev">
          <a href="{{ route('home') }}#rotoballer-news" class="read-more" style="display:inline-block;margin-bottom:18px;">&larr; Back to News Feed</a>
          <div class="eyebrow">
            <span style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>
            Rotoballer News
          </div>
          @if (!empty($article['category']))
            <span class="art-tag" style="position:static;display:inline-block;margin-bottom:14px;">{{ str_replace('-', ' ', $article['category']) }}</span>
          @endif
          <h1 class="h-section" style="margin-bottom:16px;">{{ $article['title'] }}</h1>
          <p class="body-lg" style="margin-bottom:0;color:#9aaa9e;font-size:.84rem;">
            {{ $article['source'] }}
            @if (!empty($article['author']))
              &middot; {{ $article['author'] }}
            @endif
            @if (!empty($article['updated_at']))
              &middot; {{ \Carbon\Carbon::parse($article['updated_at'])->format('M j, Y g:i A') }}
            @endif
          </p>
        </div>

        @if (!empty($article['content']))
          <div class="body-lg rev" style="max-width:760px;color:var(--tx-m);line-height:1.75;">
            {!! nl2br(e($article['content'])) !!}
          </div>
        @endif
      </div>
    </section>
  </main>
@endsection
