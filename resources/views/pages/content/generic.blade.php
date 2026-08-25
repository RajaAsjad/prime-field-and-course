@extends('layouts.app')

@section('title', ($page['title'] ?? 'Page') . ' | ' . site_settings()->displaySiteName())
@section('meta_description', $page['meta_description'] ?? '')

@section('content')
  <main id="main" class="content-page">
    <section class="content-hero">
      <div class="wrap">
        <a href="{{ route('home') }}" class="content-back">&larr; Back to Home</a>
        <div class="content-kicker">
          <span class="eyebrow">
            <span style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>
            {{ $page['eyebrow'] ?? 'Page' }}
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
        <article class="content-paper">
          <div class="guide-section__text">{!! nl2br(e($page['body'] ?? '')) !!}</div>
        </article>
        @include('pages.content._related')
      </div>
    </section>
  </main>
@endsection

@push('styles')
  @include('pages.content._styles')
@endpush
