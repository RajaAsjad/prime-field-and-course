@extends('layouts.app')

@section('title', $page['title'] . ' | ' . site_settings()->displaySiteName())
@section('meta_description', $page['meta_description'])

@section('content')
  <main id="main" class="content-page guide-page">
    <section class="content-hero">
      <div class="wrap">
        <div class="content-kicker">
          <span class="eyebrow">
            <span style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>
            {{ $page['eyebrow'] }}
          </span>
        </div>
        <h1 class="content-title">{{ $page['title'] }}</h1>
        <p class="content-intro">{{ $page['intro'] }}</p>
      </div>
    </section>

    <section class="section-green-pale content-body-section">
      <div class="wrap">
        <div class="guide-layout">
          <aside class="guide-toc rev" aria-label="Table of contents">
            <p class="guide-toc__label">On this page</p>
            <nav>
              <ol class="guide-toc__list">
                @foreach ($page['sections'] as $section)
                  <li><a href="#{{ $section['id'] }}">{{ $section['title'] }}</a></li>
                @endforeach
              </ol>
            </nav>
          </aside>

          <div class="guide-content">
            @foreach ($page['sections'] as $section)
              <article id="{{ $section['id'] }}" class="guide-section content-paper rev">
                <h2 class="guide-section__title">{{ $section['title'] }}</h2>

                @if (!empty($section['content']))
                  <p class="guide-section__text">{{ $section['content'] }}</p>
                @endif

                @foreach ($section['paragraphs'] ?? [] as $paragraph)
                  <p class="guide-section__text">{{ $paragraph }}</p>
                @endforeach

                @if (!empty($section['list']))
                  <ul class="guide-section__list">
                    @foreach ($section['list'] as $item)
                      <li>{{ $item }}</li>
                    @endforeach
                  </ul>
                @endif
              </article>
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
    .guide-layout {
      display: grid;
      grid-template-columns: 220px minmax(0, 1fr);
      gap: 28px;
      align-items: start;
    }

    .guide-toc {
      position: sticky;
      top: calc(var(--nav-h) + 24px);
      background: #fff;
      border: 1.5px solid var(--bdr);
      border-radius: 16px;
      padding: 20px 18px;
      box-shadow: 0 8px 24px rgba(13, 30, 16, .05);
    }

    .guide-toc__label {
      font-size: .68rem;
      font-weight: 800;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--au-500);
      margin-bottom: 12px;
    }

    .guide-toc__list {
      list-style: none;
      counter-reset: toc;
    }

    .guide-toc__list li {
      counter-increment: toc;
      margin-bottom: 6px;
    }

    .guide-toc__list a {
      display: block;
      font-size: .8rem;
      font-weight: 600;
      line-height: 1.4;
      color: var(--tx-m);
      padding: 6px 10px;
      border-radius: 8px;
      transition: background .2s, color .2s;
    }

    .guide-toc__list a:hover,
    .guide-toc__list a.is-active {
      background: #edf7f0;
      color: var(--g-600);
    }

    .guide-content {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .guide-section {
      scroll-margin-top: calc(var(--nav-h) + 20px);
    }

    .guide-section__title {
      font-family: 'Playfair Display', serif;
      font-size: 1.35rem;
      font-weight: 900;
      color: var(--tx-h);
      margin-bottom: 14px;
      padding-bottom: 12px;
      border-bottom: 2px solid rgba(200, 168, 75, .3);
    }

    .guide-section__text {
      font-size: .95rem;
      line-height: 1.8;
      color: #3a4f3e;
      margin-bottom: 12px;
    }

    .guide-section__text:last-of-type {
      margin-bottom: 0;
    }

    .guide-section__list {
      list-style: none;
      margin-top: 8px;
    }

    .guide-section__list li {
      position: relative;
      padding-left: 20px;
      font-size: .92rem;
      line-height: 1.65;
      color: var(--tx-m);
      margin-bottom: 8px;
    }

    .guide-section__list li::before {
      content: '';
      position: absolute;
      left: 0;
      top: .55em;
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: var(--au-500);
    }

    @media (max-width: 900px) {
      .guide-layout {
        grid-template-columns: 1fr;
      }

      .guide-toc {
        position: static;
      }

      .guide-toc__list {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
      }

      .guide-toc__list li {
        margin-bottom: 0;
      }
    }
  </style>
@endpush

@push('scripts')
  <script>
    (function () {
      const links = document.querySelectorAll('.guide-toc__list a');
      const sections = Array.from(document.querySelectorAll('.guide-section'));

      function updateActive() {
        let current = sections[0]?.id || '';
        sections.forEach(section => {
          const rect = section.getBoundingClientRect();
          if (rect.top <= calcNav() + 40) current = section.id;
        });
        links.forEach(link => link.classList.toggle('is-active', link.getAttribute('href') === '#' + current));
      }

      function calcNav() {
        return parseInt(getComputedStyle(document.documentElement).getPropertyValue('--nav-h')) || 72;
      }

      window.addEventListener('scroll', updateActive, { passive: true });
      updateActive();
    })();
  </script>
@endpush
