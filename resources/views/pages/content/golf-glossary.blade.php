@extends('layouts.app')

@section('title', $page['title'] . ' | ' . site_settings()->displaySiteName())
@section('meta_description', $page['meta_description'])

@section('content')
  <main id="main" class="content-page glossary-page">
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
        <div class="glossary-toolbar rev">
          <div class="glossary-search-wrap">
            <svg class="glossary-search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            <input type="search" id="glossary-search" class="glossary-search" placeholder="Search terms…" autocomplete="off" />
          </div>
          <div class="glossary-alpha" id="glossary-alpha" role="navigation" aria-label="Filter by letter"></div>
        </div>

        <div class="glossary-grid" id="glossary-grid">
          @foreach ($page['terms'] as $item)
            @php
              $letter = strtoupper(substr($item['term'], 0, 1));
            @endphp
            <article class="glossary-card rev" data-term="{{ strtolower($item['term']) }}" data-letter="{{ $letter }}">
              <div class="glossary-card__head">
                <span class="glossary-card__letter">{{ $letter }}</span>
                <div>
                  <h2 class="glossary-card__term">{{ $item['term'] }}</h2>
                  @if (!empty($item['alias']))
                    <p class="glossary-card__alias">Also known as: {{ $item['alias'] }}</p>
                  @endif
                </div>
              </div>
              <p class="glossary-card__def">{{ $item['definition'] }}</p>
              @if (!empty($item['example']))
                <p class="glossary-card__example"><strong>Example:</strong> {{ $item['example'] }}</p>
              @endif
            </article>
          @endforeach
        </div>

        <p class="glossary-empty" id="glossary-empty" hidden>No terms match your search.</p>

        @include('pages.content._related')
      </div>
    </section>
  </main>
@endsection

@push('styles')
  @include('pages.content._styles')
  <style>
    .glossary-toolbar {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 16px;
      margin-bottom: 12px;
    }

    .glossary-search-wrap {
      position: relative;
      flex: 1;
      min-width: 220px;
    }

    .glossary-search-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #8a9a8e;
      pointer-events: none;
    }

    .glossary-search {
      width: 100%;
      height: 48px;
      padding: 0 16px 0 44px;
      border: 1.5px solid var(--bdr);
      border-radius: 12px;
      font-family: inherit;
      font-size: .92rem;
      color: var(--tx-h);
      background: #fff;
      transition: border-color .2s, box-shadow .2s;
    }

    .glossary-search:focus {
      outline: none;
      border-color: #78c98a;
      box-shadow: 0 0 0 3px rgba(120, 201, 138, .18);
    }

    .glossary-alpha {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
    }

    .glossary-alpha-btn {
      width: 34px;
      height: 34px;
      border-radius: 8px;
      font-size: .78rem;
      font-weight: 800;
      color: var(--g-600);
      background: #fff;
      border: 1.5px solid var(--bdr);
      transition: all .2s;
    }

    .glossary-alpha-btn:hover,
    .glossary-alpha-btn.is-active {
      background: var(--g-600);
      color: #fff;
      border-color: var(--g-600);
    }

    .glossary-alpha-btn.is-disabled {
      opacity: .35;
      pointer-events: none;
    }

    .glossary-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 16px;
    }

    .glossary-card {
      background: #fff;
      border: 1.5px solid var(--bdr);
      border-radius: 16px;
      padding: 20px;
      transition: transform .25s var(--ease-expo), box-shadow .25s, border-color .25s;
    }

    .glossary-card:hover {
      transform: translateY(-2px);
      border-color: #78c98a;
      box-shadow: 0 10px 28px rgba(26, 92, 40, .07);
    }

    .glossary-card.is-hidden {
      display: none;
    }

    .glossary-card__head {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      margin-bottom: 12px;
    }

    .glossary-card__letter {
      flex-shrink: 0;
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      background: linear-gradient(135deg, #edf7f0, #d4eddb);
      font-size: .85rem;
      font-weight: 900;
      color: var(--g-600);
    }

    .glossary-card__term {
      font-size: 1.05rem;
      font-weight: 800;
      color: var(--tx-h);
      line-height: 1.25;
    }

    .glossary-card__alias {
      font-size: .75rem;
      color: var(--au-500);
      font-weight: 600;
      margin-top: 2px;
    }

    .glossary-card__def {
      font-size: .9rem;
      line-height: 1.65;
      color: #3a4f3e;
      margin-bottom: 10px;
    }

    .glossary-card__example {
      font-size: .82rem;
      line-height: 1.6;
      color: var(--tx-m);
      padding-top: 10px;
      border-top: 1px dashed var(--bdr);
    }

    .glossary-empty {
      text-align: center;
      padding: 40px 20px;
      color: var(--tx-m);
      font-size: .95rem;
    }
  </style>
@endpush

@push('scripts')
  <script>
    (function () {
      const cards = Array.from(document.querySelectorAll('.glossary-card'));
      const search = document.getElementById('glossary-search');
      const alphaNav = document.getElementById('glossary-alpha');
      const emptyEl = document.getElementById('glossary-empty');
      const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');
      const available = new Set(cards.map(c => c.dataset.letter));
      let activeLetter = '';

      letters.forEach(letter => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'glossary-alpha-btn' + (available.has(letter) ? '' : ' is-disabled');
        btn.textContent = letter;
        btn.dataset.letter = letter;
        btn.addEventListener('click', () => {
          activeLetter = activeLetter === letter ? '' : letter;
          alphaNav.querySelectorAll('.glossary-alpha-btn').forEach(b => b.classList.toggle('is-active', b.dataset.letter === activeLetter));
          filter();
        });
        alphaNav.appendChild(btn);
      });

      function filter() {
        const q = search.value.trim().toLowerCase();
        let visible = 0;
        cards.forEach(card => {
          const matchSearch = !q || card.dataset.term.includes(q) || card.textContent.toLowerCase().includes(q);
          const matchLetter = !activeLetter || card.dataset.letter === activeLetter;
          const show = matchSearch && matchLetter;
          card.classList.toggle('is-hidden', !show);
          if (show) visible++;
        });
        emptyEl.hidden = visible > 0;
      }

      search.addEventListener('input', filter);
    })();
  </script>
@endpush
