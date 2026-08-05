@extends('layouts.app')

@section('content')
  <main id="main" class="tip-detail-page">
    <section class="section-white tip-detail">
      <div class="wrap">
        <div class="sec-head rev">
          <a href="{{ route('home') }}#strategy" class="read-more tip-detail__back">&larr; Back to Tips</a>
          <div class="eyebrow">
            <span style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>
            Expert Knowledge
          </div>
          @if ($tip->tipsCategory)
            <span class="art-tag tip-detail__tag">{{ $tip->tipsCategory->title }}</span>
          @endif
          <h1 class="h-section tip-detail__title">{{ $tip->title }}</h1>
        </div>

        @if ($tip->imageUrl())
          <div class="tip-detail__media rev">
            <img
              src="{{ $tip->imageUrl() }}"
              alt="{{ $tip->title }}"
              width="1200"
              height="675"
              loading="eager"
              decoding="async"
            />
          </div>
        @endif

        @if ($tip->description)
          <div class="body-lg tip-detail__body rev">
            {!! nl2br(e($tip->description)) !!}
          </div>
        @endif
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
      display: inline-block;
      margin-bottom: 18px;
    }

    .tip-detail__tag {
      position: static;
      display: inline-block;
      margin-bottom: 14px;
    }

    .tip-detail__title {
      margin-bottom: 20px;
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
      display: block;
    }

    .tip-detail__body {
      max-width: 760px;
      margin-left: auto;
      margin-right: auto;
      color: var(--tx-m);
      line-height: 1.75;
    }
  </style>
@endpush
