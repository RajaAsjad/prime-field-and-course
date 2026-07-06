@extends('layouts.app')

@section('content')
  <main id="main">
    <section class="section-white">
      <div class="wrap">
        <div class="sec-head rev">
          <a href="{{ route('home') }}#strategy" class="read-more" style="display:inline-block;margin-bottom:18px;">&larr; Back to Tips</a>
          <div class="eyebrow">
            <span style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>
            Expert Knowledge
          </div>
          @if ($tip->tipsCategory)
            <span class="art-tag" style="position:static;display:inline-block;margin-bottom:14px;">{{ $tip->tipsCategory->title }}</span>
          @endif
          <h1 class="h-section" style="margin-bottom:16px;">{{ $tip->title }}</h1>
        </div>

        @if ($tip->imageUrl())
          <div class="art-img rev" style="position:relative;border-radius:var(--r-lg);overflow:hidden;margin-bottom:28px;aspect-ratio:21/9;background:linear-gradient(135deg,#edf7f0,#d4eddb);">
            <img
              src="{{ $tip->imageUrl() }}"
              alt="{{ $tip->title }}"
              width="1200"
              height="514"
              loading="eager"
              decoding="async"
            />
          </div>
        @endif

        @if ($tip->description)
          <div class="body-lg rev" style="max-width:760px;color:var(--tx-m);line-height:1.75;">
            {!! nl2br(e($tip->description)) !!}
          </div>
        @endif
      </div>
    </section>
  </main>
@endsection
