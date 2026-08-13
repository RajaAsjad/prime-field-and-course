@extends('layouts.app')

@section('content')
{{-- Main content start --}}
  <main id="main">

    <section id="hero">
      <div class="hero-bg"><img
          src="https://images.unsplash.com/photo-1535131749006-b7f58c99034b?auto=format&fit=crop&w=1920&q=85"
          alt="Golf course" width="1920" height="1080" loading="eager" fetchpriority="high" /></div>
      <div class="hero-overlay"></div>
      <div class="hero-content">
        <h1 class="hero-h1"><span>Golf Betting</span> <span class="gold">Made Simple.</span> <span>Expert Picks &
            Exclusive Deals.</span></h1>
        <p class="hero-sub">All your favourite sportsbooks, insider tips, and tournament updates in one place.</p>
        <div class="hero-btns"><a href="#best-picks" class="btn btn-gold">View Best Picks</a><a href="#promos" class="btn btn-outline-hero">Sign Up & Get Bonuses</a></div>
        </div>
      </div>
    </section>

    <section id="strategy" class="section-white">
      <div class="wrap">
        <div class="sec-head rev">
          <div class="eyebrow"><span
              style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>Expert
            Knowledge</div>
          <h2 class="h-section">Expert Strategy & <em>Tips</em></h2>
          <p class="body-lg" id="flm-stories-desc">Latest golf coverage from Field Level Media — previews, recaps, and news.</p>
        </div>
        <div
          id="flm-stories-feed"
          data-endpoint="{{ route('api.flm-stories') }}"
          data-refresh-ms="{{ (int) config('flm.cache.stories_ttl', 300) * 1000 }}"
        >
          <div class="swiper flm-stories-swiper">
            <div class="swiper-wrapper" id="flm-stories-wrapper">
              @forelse ($flmFeed['items'] ?? [] as $story)
                <div class="swiper-slide">
                  <a
                    href="{{ $story['url'] }}"
                    class="art-card"
                    style="text-decoration:none;color:inherit;"
                  >
                    <div
                      class="art-img"
                      style="position:relative;background:linear-gradient(135deg,{{ $loop->odd ? '#fdf8ec,#f5edcc' : '#edf7f0,#d4eddb' }})"
                    >
                      @if (!empty($story['image']))
                        <img
                          src="{{ $story['image'] }}"
                          alt="{{ $story['title'] }}"
                          width="800"
                          height="500"
                          loading="lazy"
                          decoding="async"
                        />
                      @endif
                      @if (!empty($story['category']))
                        <span class="art-tag{{ $loop->odd ? ' gold-tag' : '' }}">{{ $story['category'] }}</span>
                      @endif
                    </div>
                    <div class="art-body">
                      <h3 class="art-title">{{ $story['title'] }}</h3>
                      <p class="art-desc">{{ $story['excerpt'] }}</p>
                    </div>
                  </a>
                </div>
              @empty
                <div class="swiper-slide">
                  <p class="body-lg" id="flm-stories-loading">{{ $flmFeed['error'] ?? 'Loading golf stories…' }}</p>
                </div>
              @endforelse
            </div>
          </div>
          <div class="car-ctrl flm-stories-controls">
            <button type="button" class="car-btn flm-stories-prev" aria-label="Previous stories">&#9664;</button>
            <div class="swiper-pagination flm-stories-pagination"></div>
            <button type="button" class="car-btn flm-stories-next" aria-label="Next stories">&#9654;</button>
          </div>
        </div>
        <p id="flm-stories-updated" style="margin-top:12px;font-size:.78rem;color:#9aaa9e;text-align:right;">
          Updating automatically…
        </p>
      </div>
    </section>

    <section class="section-white betmgm-offer">
      <div class="wrap">
        <a
          href="https://www.anrdoezrs.net/click-101764042-17337458"
          class="betmgm-banner" 
          target="_blank"
          rel="sponsored noopener noreferrer">
          <span class="betmgm-banner__logo">BetMGM</span>
          <span class="betmgm-banner__copy">
            <span class="betmgm-banner__title">BetMGM First Bet Offer: $1500 Paid Back in Bonus Bets, if You Don't Win*</span>
            <span class="betmgm-banner__terms">*Bonus Bets expire in 7 days. One New Customer Offer Only. Add'l terms. Live in All States (minus NV, PR, NY).</span>
          </span>
          <span class="betmgm-banner__cta">Claim Offer <span aria-hidden="true">&rarr;</span></span>
        </a>
        <img class="betmgm-banner__pixel" src="https://www.ftjcfx.com/image-101764042-17337458" width="1" height="1" border="0" alt="" />
      </div>
    </section>



    <section id="promos" class="section-white">
      <div class="wrap">
        <div class="sec-head rev">
          <div class="eyebrow"><span
              style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>Partner Offers</div>
          <h2 class="h-section">Exclusive <em>Sign-Up Bonuses</em></h2>
          <p class="body-lg">Verified offers updated weekly. All bonuses for new users only. Must be 21+.</p>
        </div>
        <div class="promos-grid">
          <div class="promo-card featured rev rev-d1">
            <div class="promo-ribbon">TOP PICK</div>
            <div class="book-name mgm"><span>BetMGM</span></div>
            <div class="promo-bonus">$1,500 Back</div>
            <p class="promo-desc">First bet insurance up to $1,500.</p><a href="#promos" class="btn btn-gold"
              style="width:100%;justify-content:center;">Claim Bonus &rarr;</a>
          </div>
          <div class="promo-card rev rev-d2">
            <div class="book-name fd">FanDuel</div>
            <div class="promo-bonus">$150 Back</div>
            <p class="promo-desc">No Sweat First Bet up to $150.</p><a href="#promos" class="btn btn-primary"
            style="width:100%;justify-content:center;">Claim Bonus &rarr;</a>
          </div>
          <div class="promo-card rev rev-d3"> 
            <div class="book-name dk">DraftKings</div>
            <div class="promo-bonus">$200 Bonus</div>
            <p class="promo-desc">Bet $5, get $200 in bonus bets instantly.</p><a href="#promos" class="btn btn-primary"
              style="width:100%;justify-content:center;">Claim Bonus &rarr;</a>
          </div>
          <div class="promo-card rev rev-d4">
            <div class="book-name cz">Caesars</div>
            <div class="promo-bonus">$1,000 Back</div>
            <p class="promo-desc">First bet up to $1,000 back as bonus.</p><a href="#promos" class="btn btn-primary"
              style="width:100%;justify-content:center;">Claim Bonus &rarr;</a>
          </div>
          <div class="promo-card rev rev-d5">
            <div class="book-name b365">Bet365</div>
            <div class="promo-bonus">$200 Bonus</div>
            <p class="promo-desc">Bet $5 and receive $200 in bonus bets.</p><a href="#promos" class="btn btn-primary"
              style="width:100%;justify-content:center;">Claim Bonus &rarr;</a>
          </div>
        </div>
      </div>
    </section>

    <section id="best-picks" class="section-green-pale">
      <div class="wrap">
        <div class="sec-head rev">
          <div class="eyebrow"><span
              style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>Weekly
            Selections</div>
          <h2 class="h-section">Top Picks <em>This Week</em></h2>
          <p class="body-lg">Live SportsDataIO odds with confidence ratings for this week's top contenders.</p>
        </div>
        <div class="picks-grid">
          @forelse ($topPicks ?? [] as $pick)
            <div class="pick-card rev rev-d{{ ($loop->iteration - 1) % 4 + 1 }}">
              <div class="pick-top">
                <span class="pick-tour">{{ $pick['tournament'] }}</span>
                <span class="pick-badge {{ $pick['badge_class'] }}">{{ $pick['badge'] }}</span>
              </div>
              <div class="pick-player">{{ $pick['player'] }}</div>
              <div class="pick-stats">
                <div class="pick-stat-g"><span class="psl">Best Odds</span><span class="psv odds">{{ $pick['american'] }}</span></div>
                <div class="pick-stat-g"><span class="psl">Book</span><span class="psv">{{ $pick['book'] }}</span></div>
              </div>
              <div class="conf-row">
                <span class="conf-lbl">Confidence</span>
                <div class="conf-bar-bg">
                  <div class="conf-fill" style="--w:{{ $pick['confidence'] }}%"></div>
                </div>
                <span class="conf-pct">{{ $pick['confidence'] }}%</span>
              </div>
            </div>
          @empty
            <p class="body-lg" style="grid-column:1/-1;text-align:center;color:#7a8a7e;">
              {{ $liveOdds['error'] ?? 'Top picks will appear when odds are available for this tournament.' }}
            </p>
          @endforelse
        </div>
      </div>
    </section>

    <section id="hot-props" class="section-white">
      <div class="wrap">
        <div class="sec-head rev">
          <div class="eyebrow"><span
              style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>Odds
            &amp; Sportsbooks</div>
          <h2 class="h-section">This Week's <em>Hot Props</em></h2>
          <p class="body-lg" id="hot-props-desc">Consensus and sportsbook prop odds via SportsDataIO Sportsbook Group. Auto-refreshes every {{ $propsRefreshSeconds ?? 120 }} seconds.</p>
        </div>
        @if (!empty($hotProps['tournament']['name']))
          <p class="body-lg hot-props-tournament rev" id="hot-props-tournament">
            {{ $hotProps['tournament']['name'] }}
            @if (!empty($hotProps['tournament']['start_date']))
              &middot; {{ \Carbon\Carbon::parse($hotProps['tournament']['start_date'])->format('M j') }}
              @if (!empty($hotProps['tournament']['end_date']))
                &ndash; {{ \Carbon\Carbon::parse($hotProps['tournament']['end_date'])->format('M j, Y') }}
              @endif
            @endif
          </p>
        @endif
        <div
          class="rev"
          id="hot-props-panel"
          data-endpoint="{{ route('api.hot-props') }}"
          data-refresh-ms="{{ ($propsRefreshSeconds ?? 120) * 1000 }}"
          data-active-key="{{ $hotProps['active_key'] ?? 'top_5' }}"
          data-sportsbooks='@json($hotProps['sportsbooks'] ?? [])'
        >
          <div class="hot-props-tabs" id="hot-props-tabs" role="tablist" aria-label="Prop brackets">
            @foreach ($hotProps['brackets'] ?? [] as $bracket)
              <button
                type="button"
                class="hot-props-tab{{ ($hotProps['active_key'] ?? '') === $bracket['key'] ? ' is-active' : '' }}"
                data-bracket-key="{{ $bracket['key'] }}"
                role="tab"
                aria-selected="{{ ($hotProps['active_key'] ?? '') === $bracket['key'] ? 'true' : 'false' }}"
              >{{ $bracket['label'] }}</button>
            @endforeach
          </div>
          <div class="table-wrap">
            <table class="odds-tbl" id="hot-props-table">
              <thead id="hot-props-thead">
                <tr>
                  <th style="min-width:180px;">Selection</th>
                  @foreach ($hotProps['sportsbooks'] ?? [] as $book)
                    <th @class(['th-book-mgm' => strcasecmp($book, 'BetMGM') === 0])>{{ $book }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody id="hot-props-body">
                <tr id="hot-props-loading">
                  <td colspan="{{ count($hotProps['sportsbooks'] ?? []) + 1 }}" style="text-align:center;padding:28px;color:#7a8a7e;">
                    Loading prop odds…
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <p id="hot-props-updated" style="margin-top:12px;font-size:.78rem;color:#9aaa9e;text-align:right;">
            Updating automatically…
          </p>
        </div>
      </div>
    </section>

    <section id="competition-feeds" class="section-warm">
      <div class="wrap">
        <div class="sec-head rev">
          <div class="eyebrow"><span
              style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>Golf API
            Feeds</div>
          <h2 class="h-section">Competition &amp; <em>Event Data</em></h2>
          <p class="body-lg">
            Live SportsDataIO Golf feeds unlocked on your subscription — rankings, players, venues, schedule, stats, props &amp; news.
            @if (!empty($competitionFeeds['season']['description']))
              Season {{ $competitionFeeds['season']['description'] }}.
            @endif
          </p>
        </div>

        @if (!empty($competitionFeeds['error']))
          <p class="body-lg rev" style="text-align:center;color:#7a8a7e;">{{ $competitionFeeds['error'] }}</p>
        @endif

        @if (!empty($competitionFeeds['players']))
          <div class="comp-players rev">
            @foreach ($competitionFeeds['players'] as $player)
              <article class="comp-player-card">
                <div class="comp-player-card__rank">#{{ $player['rank'] }}</div>
                <div class="comp-player-card__body">
                  <h4>{{ $player['name'] }}</h4>
                  <p>
                    @if (!empty($player['country'])) {{ $player['country'] }} @endif
                    @if (!empty($player['swings'])) &middot; {{ $player['swings'] }} @endif
                    @if (!empty($player['college'])) &middot; {{ $player['college'] }} @endif
                  </p>
                </div>
              </article>
            @endforeach
          </div>
        @endif

        <div class="comp-grid rev">
          <div class="comp-panel">
            <div class="comp-panel__head">
              <h3 class="comp-panel__title">OWGR Top {{ count($competitionFeeds['rankings'] ?? []) }}</h3>
              <span class="comp-panel__meta">Standings &amp; Rankings</span>
            </div>
            <div class="table-wrap">
              <table class="odds-tbl comp-rank-tbl">
                <thead>
                  <tr>
                    <th style="width:64px;">Rank</th>
                    <th>Player</th>
                    <th>Avg Pts</th>
                    <th>Events</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($competitionFeeds['rankings'] ?? [] as $row)
                    <tr>
                      <td>
                        <span class="comp-rank">{{ $row['rank'] }}</span>
                        @if (!empty($row['rank_last_week']) && $row['rank_last_week'] !== $row['rank'])
                          <span class="comp-rank-delta {{ $row['rank'] < $row['rank_last_week'] ? 'is-up' : 'is-down' }}">
                            {{ $row['rank'] < $row['rank_last_week'] ? '▲' : '▼' }}{{ abs($row['rank'] - $row['rank_last_week']) }}
                          </span>
                        @endif
                      </td>
                      <td><strong>{{ $row['name'] }}</strong></td>
                      <td>{{ number_format((float) $row['average_points'], 2) }}</td>
                      <td>{{ $row['events'] }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="4" style="text-align:center;padding:28px;color:#7a8a7e;">Rankings unavailable.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>

          <div class="comp-panel">
            <div class="comp-panel__head">
              <h3 class="comp-panel__title">Season Stats</h3>
              <span class="comp-panel__meta">Player Stats (Final)</span>
            </div>
            <div class="table-wrap">
              <table class="odds-tbl">
                <thead>
                  <tr>
                    <th>Player</th>
                    <th>Total Pts</th>
                    <th>Gained</th>
                    <th>Lost</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($competitionFeeds['stats'] ?? [] as $row)
                    <tr>
                      <td><strong>#{{ $row['rank'] }} {{ $row['name'] }}</strong></td>
                      <td>{{ number_format((float) $row['total_points'], 1) }}</td>
                      <td style="color:#1f7a1f;">{{ number_format((float) $row['points_gained'], 1) }}</td>
                      <td style="color:#b45309;">{{ number_format((float) $row['points_lost'], 1) }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="4" style="text-align:center;padding:28px;color:#7a8a7e;">Season stats unavailable.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="comp-grid rev" style="margin-top:22px;">
          <div class="comp-panel" style="grid-column:1 / -1;">
            <div class="comp-panel__head">
              <h3 class="comp-panel__title">Tournament Schedule &amp; Venues</h3>
              <span class="comp-panel__meta">Schedules &amp; Courses</span>
            </div>
            <div class="comp-courses comp-courses--grid">
              @forelse ($competitionFeeds['schedule'] ?? [] as $event)
                <article class="comp-course-card">
                  <div class="comp-course-card__top">
                    <h4>{{ $event['name'] }}</h4>
                    @if (!empty($event['is_in_progress']))
                      <span class="comp-live-pill">Live</span>
                    @elseif (!empty($event['is_over']))
                      <span class="comp-done-pill">Final</span>
                    @elseif (!empty($event['start_date']))
                      <time datetime="{{ $event['start_date'] }}">
                        {{ \Carbon\Carbon::parse($event['start_date'])->format('M j') }}
                        @if (!empty($event['end_date']))
                          – {{ \Carbon\Carbon::parse($event['end_date'])->format('M j, Y') }}
                        @endif
                      </time>
                    @endif
                  </div>
                  @if (!empty($event['venue']))
                    <p class="comp-course-venue">{{ $event['venue'] }}</p>
                  @endif
                  @if (!empty($event['location']))
                    <p class="comp-course-loc">{{ $event['location'] }}</p>
                  @endif
                  <div class="comp-course-meta">
                    @if (!empty($event['par']))
                      <span>Par {{ $event['par'] }}</span>
                    @endif
                    @if (!empty($event['yards']))
                      <span>{{ number_format($event['yards']) }} yds</span>
                    @endif
                    @if (!empty($event['format']))
                      <span>{{ $event['format'] }}</span>
                    @endif
                    @if (!empty($event['purse']))
                      <span>${{ number_format($event['purse'] / 1000000, 1) }}M</span>
                    @endif
                  </div>
                </article>
              @empty
                <p class="body-lg" style="color:#7a8a7e;">Schedule unavailable.</p>
              @endforelse
            </div>
          </div>
        </div>

        <p style="margin-top:12px;font-size:.78rem;color:#9aaa9e;text-align:right;">
          Last updated {{ \Carbon\Carbon::parse($competitionFeeds['updated_at'] ?? now())->timezone(config('app.timezone'))->format('g:i A') }}.
          Competition feeds refresh every {{ $competitionRefreshSeconds ?? 900 }} seconds.
        </p>
      </div>
    </section>

    <section id="running-odds" class="section-white">
      <div class="wrap">
        <div class="sec-head rev">
          <div class="eyebrow"><span
              style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>Real-Time
            Data</div>
          <h2 class="h-section">Compare <em>Live Odds</em></h2>
          <p class="body-lg" id="live-odds-desc">Best available odds across top sportsbooks. Green highlights best value. Auto-refreshes every {{ $oddsRefreshSeconds ?? 60 }} seconds.</p>
        </div>
        @if (!empty($liveOdds['tournament']['name']))
          <div class="tournament-meta rev">
            <div class="tournament-meta__inner">
              <p class="body-lg tournament-meta__event" id="live-odds-tournament">
                {{ $liveOdds['tournament']['name'] }}
                @if (!empty($liveOdds['tournament']['start_date']))
                  &middot; {{ \Carbon\Carbon::parse($liveOdds['tournament']['start_date'])->format('M j') }}
                  @if (!empty($liveOdds['tournament']['end_date']))
                    &ndash; {{ \Carbon\Carbon::parse($liveOdds['tournament']['end_date'])->format('M j, Y') }}
                  @endif
                @endif
                @if (!empty($liveOdds['tournament']['is_in_progress']))
                  &middot; <span class="tournament-meta__live">Live</span>
                @endif
              </p>
              <div id="tournament-weather" class="tournament-weather">
                @if (!empty($liveOdds['weather']))
                  <div class="tournament-weather__icon tournament-weather__icon--{{ $liveOdds['weather']['icon'] }}" aria-hidden="true"></div>
                  <div class="tournament-weather__body">
                    <div class="tournament-weather__temp">{{ $liveOdds['weather']['temperature'] }}&deg;F</div>
                    <div class="tournament-weather__condition">{{ $liveOdds['weather']['condition'] }}</div>
                    <div class="tournament-weather__meta">
                      {{ $liveOdds['weather']['location'] }}
                      @if (!empty($liveOdds['weather']['venue']))
                        &middot; {{ $liveOdds['weather']['venue'] }}
                      @endif
                      &middot; Wind {{ $liveOdds['weather']['wind_mph'] }} mph
                      @if (!empty($liveOdds['weather']['humidity']))
                        &middot; {{ $liveOdds['weather']['humidity'] }}% humidity
                      @endif
                    </div>
                  </div>
                @else
                  <span class="tournament-weather__loading">Loading course weather…</span>
                @endif
              </div>
            </div>
          </div>
        @endif
        <div class="rev">
          <div class="table-wrap">
            <table class="odds-tbl" id="live-odds-table"
              data-endpoint="{{ route('api.live-odds') }}"
              data-refresh-ms="{{ ($oddsRefreshSeconds ?? 60) * 1000 }}"
              data-sportsbooks='@json($liveOdds['sportsbooks'])'>
              <thead>
                <tr>
                  <th style="min-width:180px;">Player / Tournament</th>
                  <th class="score-col">Score</th>
                  @foreach ($liveOdds['sportsbooks'] as $book)
                    <th @class(['th-book-mgm' => strcasecmp($book, 'BetMGM') === 0])>{{ $book }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody id="live-odds-body">
                <tr id="live-odds-loading">
                  <td colspan="{{ count($liveOdds['sportsbooks']) + 2 }}" style="text-align:center;padding:28px;color:#7a8a7e;">
                    Loading live odds &amp; scores…
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <p id="live-odds-updated" style="margin-top:12px;font-size:.78rem;color:#9aaa9e;text-align:right;">
            Updating automatically…
          </p>
        </div>
      </div>
    </section>

    <section id="rotoballer-news" class="section-green-pale">
      <div class="wrap">
        <div class="sec-head rev">
          <div class="eyebrow"><span
              style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>Player
            News</div>
          <h2 class="h-section">Rotoballer <em>News Feed</em></h2>
          <p class="body-lg" id="rotoballer-news-desc">Latest PGA Tour player news and matchup outlooks from RotoBaller. Showing stories from the last 2 weeks. Auto-refreshes every {{ $newsRefreshSeconds ?? 300 }} seconds.</p>
        </div>
        <div
          class="rev"
          id="rotoballer-news-feed"
          data-endpoint="{{ route('api.rotoballer-news') }}"
          data-refresh-ms="{{ ($newsRefreshSeconds ?? 300) * 1000 }}"
        >
          <div class="swiper rb-news-swiper">
            <div class="swiper-wrapper" id="rb-news-wrapper">
              @forelse ($newsFeed['items'] ?? [] as $item)
                <div class="swiper-slide">
                  <article class="rb-news-card">
                    <div class="rb-news-card__top">
                      @if (!empty($item['category']))
                        <span class="rb-news-tag">{{ str_replace('-', ' ', $item['category']) }}</span>
                      @endif
                      @if (!empty($item['updated_at']))
                        <time class="rb-news-date" datetime="{{ $item['updated_at'] }}">{{ \Carbon\Carbon::parse($item['updated_at'])->format('M j, Y g:i A') }}</time>
                      @endif
                    </div>
                    <h3 class="rb-news-title">{{ $item['title'] }}</h3>
                    <p class="rb-news-excerpt">{{ \Illuminate\Support\Str::limit($item['content'], 160) }}</p>
                    <div class="rb-news-card__foot">
                      <span class="rb-news-source">{{ $item['source'] }}</span>
                      @if (!empty($item['id']))
                        <a href="{{ route('news.show', $item['id']) }}" class="read-more">Read full story &rarr;</a>
                      @endif
                    </div>
                  </article>
                </div>
              @empty
                <div class="swiper-slide">
                  <p class="body-lg rb-news-empty" id="rotoballer-news-loading">Loading RotoBaller news…</p>
                </div>
              @endforelse
            </div>
          </div>
          <div class="car-ctrl rb-news-controls">
            <button type="button" class="car-btn rb-news-prev" aria-label="Previous news">&#9664;</button>
            <div class="swiper-pagination rb-news-pagination"></div>
            <button type="button" class="car-btn rb-news-next" aria-label="Next news">&#9654;</button>
          </div>
        </div>
        <p id="rotoballer-news-updated" style="margin-top:12px;font-size:.78rem;color:#9aaa9e;text-align:right;">
          @if (!empty($newsFeed['error']))
            {{ $newsFeed['error'] }}
          @else
            Updating automatically…
          @endif
        </p>
      </div>
    </section>

    <section id="golf-betting" class="section-warm">
      <div class="wrap">
        <div class="sec-head rev">
          <div class="eyebrow"><span
              style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>Education
            Hub</div>
          <h2 class="h-section">Learn & Bet <em>Smarter</em></h2>
          <p class="body-lg">Guides, tactics, and video breakdowns to sharpen your game.</p>
        </div>
        <div class="split-2">
          <div class="guide-rows rev"><a href="#golf-betting" class="guide-row">
            <div class="guide-icon">📖</div>
              <div>
                <div class="guide-title">Complete Beginner's Guide</div>
                <div class="guide-meta">Beginner &middot; 15 min</div>
              </div>
            </a><a href="#golf-betting" class="guide-row">
              <div class="guide-icon">🎯</div>
              <div>
                <div class="guide-title">Types of Golf Bets Explained</div>
                <div class="guide-meta">Beginner &middot; 8 min</div>
              </div>
            </a><a href="#golf-betting" class="guide-row">
            <div class="guide-icon">📊</div>
              <div>
                <div class="guide-title">Line Shopping: Find Best Odds</div>
                <div class="guide-meta">Advanced &middot; 10 min</div>
              </div>
            </a><a href="#golf-betting" class="guide-row">
            <div class="guide-icon">⚡</div>
              <div>
                <div class="guide-title">Live In-Play Betting Strategy</div>
                <div class="guide-meta">Advanced &middot; 12 min</div>
              </div>
            </a></div>
          <div class="news-card rev rev-d2">
            <div class="eyebrow"><span
                style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>Free
              Newsletter</div>
            <h3 class="news-h">Unlock Insider Tips</h3>
            <p class="news-sub">Weekly expert picks every Tuesday. Free forever.</p>
            <form action="#" method="post">
              <div class="form-grp"><label class="form-lbl" for="n-email">Email Address</label><input class="form-inp"
                  type="email" id="n-email" name="email" placeholder="your@email.com" required /></div><button
                type="submit" class="btn btn-gold form-btn">Subscribe &mdash; It's Free</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <section id="tournaments" class="section-white">
      <div class="wrap">
        <div class="sec-head rev">
          <div class="eyebrow"><span
              style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>Live
            Schedule</div>
          <h2 class="h-section">Tournament Updates & <em>Major Events</em></h2>
          <p class="body-lg">Current and upcoming PGA Tour events from SportsDataIO Schedules feed.</p>
        </div>
        <div class="carousel-outer rev">
          <div class="carousel-inner" id="c-inner">
            @forelse ($competitionFeeds['schedule'] ?? [] as $event)
              <div class="t-card">
                <div class="t-img"><img
                    src="https://images.unsplash.com/photo-1587174486073-ae5e5cff23aa?auto=format&fit=crop&w=800&q=80"
                    alt="{{ $event['name'] }}" width="800" height="450" loading="lazy" decoding="async" /></div>
                <div class="t-body">
                  <div class="t-date">
                    @if (!empty($event['is_in_progress']))
                      Live
                    @elseif (!empty($event['is_over']))
                      Final
                    @elseif (!empty($event['start_date']))
                      {{ \Carbon\Carbon::parse($event['start_date'])->format('M j') }}
                      @if (!empty($event['end_date']))
                        – {{ \Carbon\Carbon::parse($event['end_date'])->format('M j') }}
                      @endif
                    @endif
                    @if (!empty($event['location']))
                      &middot; {{ $event['location'] }}
                    @endif
                  </div>
                  <h3 class="t-name">{{ $event['name'] }}</h3>
                  <div class="t-players">
                    @if (!empty($event['venue']))
                      <span class="t-chip">{{ $event['venue'] }}</span>
                    @endif
                    @if (!empty($event['purse']))
                      <span class="t-chip">${{ number_format($event['purse'] / 1000000, 1) }}M</span>
                    @endif
                  </div>
                  <a href="#best-picks" class="btn btn-primary btn-xs">View Picks &rarr;</a>
                </div>
              </div>
            @empty
              <div class="t-card">
                <div class="t-body">
                  <h3 class="t-name">Schedule loading…</h3>
                  <p class="body-lg">Tournament schedule will appear when the feed is available.</p>
                </div>
              </div>
            @endforelse
          </div>
        </div>
        <div class="car-ctrl"><button class="car-btn" id="c-prev">◀</button>
          <div class="car-dots">
            @foreach ($competitionFeeds['schedule'] ?? [1] as $i => $event)
              <button class="car-dot{{ $i === 0 ? ' on' : '' }}"></button>
            @endforeach
          </div><button class="car-btn" id="c-next">▶</button>
        </div>
      </div>
    </section>

    <section id="premium" class="cta-band">
      <div class="wrap">
        <div class="cta-grid-2">
          <div class="rev">
            <h2 class="cta-h">Unlock <span class="gold">Insider</span> Information</h2>
            <p class="cta-p">Get exclusive weekly picks, deep analysis, and bonus alerts delivered straight to your inbox.</p>
            <div class="cta-price-row">
              <span class="price-big">$9.99</span><span class="price-unit">/month</span>
            </div>
            <div class="cta-feats">
              <div class="cta-feat"><span class="cta-feat-check">✅</span>Weekly expert picks every Tuesday</div>
              <div class="cta-feat"><span class="cta-feat-check">✅</span>Deep tournament analysis &amp; projections</div>
              <div class="cta-feat"><span class="cta-feat-check">✅</span>Exclusive sportsbook bonus alerts</div>
            </div>
          </div>
          <div class="rev rev-d2">
            <div class="cta-form-card">
              <h3 class="cta-form-h">Start Your <span class="gold">Free Trial</span></h3>
              <p class="cta-form-note">7 days free, then $9.99/month. Cancel anytime.</p>
              <form action="#" method="post">
                <div class="form-grp">
                  <label class="form-lbl cta-form-lbl" for="p-email">Email</label>
                  <input class="form-inp dark-inp" type="email" id="p-email" name="email" placeholder="your@email.com" required />
                </div>
                <button type="submit" class="btn btn-gold form-btn" style="width:100%;">Subscribe — 7 Days Free</button>
              </form>
            </div>
          </div>
        </div>
        <div class="testi-grid">
          <div class="testi-card rev rev-d1">
            <div class="testi-stars">⭐⭐⭐⭐⭐</div>
            <p class="testi-q">"Hit three of their top five picks last week. Completely changed how I approach betting."
            </p>
            <div class="testi-auth">
              <div>
                <div class="testi-name">Marcus T.</div>
              </div>
            </div>
          </div>
          <div class="testi-card rev rev-d2">
            <div class="testi-stars">⭐⭐⭐⭐⭐</div>
            <p class="testi-q">"The DraftKings bonus alone paid for six months. Their odds table saves me hours weekly."
            </p>
            <div class="testi-auth">
              <div>
                <div class="testi-name">Sarah K.</div>
              </div>
            </div>
          </div>
          <div class="testi-card rev rev-d3">
            <div class="testi-stars">⭐⭐⭐⭐⭐</div>
            <p class="testi-q">"Finally a golf betting site that goes beyond basic picks. I've recommended it to
              everyone."</p>
            <div class="testi-auth">
              <div>
                <div class="testi-name">Derek W.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="faq" class="section-white">
      <div class="wrap">
        <div class="sec-head rev">
          <div class="eyebrow"><span
              style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>Got
            Questions?</div>
          <h2 class="h-section">Frequently Asked <em>Questions</em></h2>
        </div>
        <div class="faq-wrap rev" role="list">
          <div class="faq-item open" role="listitem">
            <button type="button" class="faq-q" aria-expanded="true">
              <span class="faq-q-text">Is Prime Field &amp; Course free?</span>
              <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14" /></svg></span>
            </button>
            <div class="faq-a">
              <div class="faq-a-inner">Yes. Core picks, odds, and news are free. Premium is optional for exclusive analysis and early access.</div>
            </div>
          </div>
          <div class="faq-item" role="listitem">
            <button type="button" class="faq-q" aria-expanded="false">
              <span class="faq-q-text">How do affiliate bonuses work?</span>
              <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14" /></svg></span>
            </button>
            <div class="faq-a">
              <div class="faq-a-inner">Click a Claim Bonus button and complete signup with the partner. The offer applies automatically at no extra cost to you.</div>
            </div>
          </div>
          <div class="faq-item" role="listitem">
            <button type="button" class="faq-q" aria-expanded="false">
              <span class="faq-q-text">How are picks selected?</span>
              <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14" /></svg></span>
            </button>
            <div class="faq-a">
              <div class="faq-a-inner">We combine course fit, recent form, weather, and SportsDataIO odds/value signals. Every pick is reviewed before it goes live.</div>
            </div>
          </div>
          <div class="faq-item" role="listitem">
            <button type="button" class="faq-q" aria-expanded="false">
              <span class="faq-q-text">How often are odds updated?</span>
              <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14" /></svg></span>
            </button>
            <div class="faq-a">
              <div class="faq-a-inner">Live odds refresh about every 30–120 seconds depending on the feed. Best available prices are highlighted in green.</div>
            </div>
          </div>
          <div class="faq-item" role="listitem">
            <button type="button" class="faq-q" aria-expanded="false">
              <span class="faq-q-text">Can I cancel my subscription?</span>
              <span class="faq-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14" /></svg></span>
            </button>
            <div class="faq-a">
              <div class="faq-a-inner">Yes. Cancel anytime with no long-term contract. You keep access through the end of your billing period.</div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <style>
    #running-odds .tournament-meta {
      width: 100%;
      margin: -28px 0 24px;
      text-align: left
    }

    #running-odds .tournament-meta__inner {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      gap: 16px 24px;
      width: 100%;
      padding: 16px 20px;
      background: #f7faf8;
      border: 1.5px solid var(--bdr);
      border-radius: var(--r-lg);
      box-shadow: 0 2px 12px rgba(0, 0, 0, .04)
    }

    #running-odds .tournament-meta__event {
      flex: 1 1 260px;
      margin: 0;
      font-size: .92rem;
      color: #5a6b5e;
      line-height: 1.5
    }

    #running-odds .tournament-meta__live {
      color: var(--g-600);
      font-weight: 700
    }

    #running-odds .tournament-weather {
      display: flex;
      align-items: center;
      gap: 12px;
      flex: 0 1 360px;
      min-width: min(100%, 280px);
      padding: 12px 14px;
      background: #fff;
      border: 1.5px solid var(--bdr);
      border-radius: 10px
    }

    #running-odds .tournament-weather__icon {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: linear-gradient(135deg, #edf7f0, #d4eddb);
      position: relative;
      flex-shrink: 0
    }

    #running-odds .tournament-weather__icon::after {
      content: '';
      position: absolute;
      inset: 0;
      margin: auto;
      width: 22px;
      height: 22px
    }

    #running-odds .tournament-weather__icon--clear::after {
      content: '☀';
      font-size: 1.2rem;
      line-height: 22px;
      text-align: center;
      width: 22px
    }

    #running-odds .tournament-weather__icon--partly-cloudy::after {
      content: '⛅';
      font-size: 1.1rem;
      line-height: 22px;
      text-align: center;
      width: 22px
    }

    #running-odds .tournament-weather__icon--cloudy::after,
    #running-odds .tournament-weather__icon--fog::after {
      content: '☁';
      font-size: 1.1rem;
      line-height: 22px;
      text-align: center;
      width: 22px
    }

    #running-odds .tournament-weather__icon--rain::after,
    #running-odds .tournament-weather__icon--storm::after {
      content: '🌧';
      font-size: 1rem;
      line-height: 22px;
      text-align: center;
      width: 22px
    }

    #running-odds .tournament-weather__icon--snow::after {
      content: '❄';
      font-size: 1rem;
      line-height: 22px;
      text-align: center;
      width: 22px
    }

    #running-odds .tournament-weather__body {
      min-width: 0
    }

    #running-odds .tournament-weather__temp {
      font-size: 1.15rem;
      font-weight: 800;
      color: var(--tx-h);
      line-height: 1.2
    }

    #running-odds .tournament-weather__condition {
      font-size: .82rem;
      font-weight: 700;
      color: var(--g-600);
      margin-top: 2px
    }

    #running-odds .tournament-weather__meta,
    #running-odds .tournament-weather__loading {
      font-size: .72rem;
      color: #7a8a7e;
      line-height: 1.45;
      margin-top: 4px
    }

    @media (max-width: 768px) {
      #running-odds .tournament-meta__inner {
        flex-direction: column;
        align-items: stretch
      }

      #running-odds .tournament-meta__event {
        text-align: center
      }

      #running-odds .tournament-weather {
        flex: 1 1 auto;
        width: 100%
      }
    }

    #strategy .flm-stories-swiper {
      overflow: hidden;
      padding: 14px 8px 24px;
      margin: 0 -8px
    }

    #strategy .flm-stories-swiper .swiper-slide {
      height: auto
    }

    #strategy .flm-stories-swiper .art-card {
      height: 100%
    }

    #strategy .flm-stories-controls,
    #rotoballer-news .rb-news-controls {
      margin-top: 18px
    }

    #strategy .flm-stories-controls .car-btn,
    #rotoballer-news .rb-news-controls .car-btn {
      position: static;
      font-size: .82rem;
      line-height: 1;
      cursor: pointer
    }

    #strategy .flm-stories-controls .car-btn::after,
    #strategy .flm-stories-controls .car-btn::before,
    #rotoballer-news .rb-news-controls .car-btn::after,
    #rotoballer-news .rb-news-controls .car-btn::before {
      display: none
    }

    #strategy .flm-stories-pagination,
    #rotoballer-news .rb-news-pagination {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      position: static;
      width: auto
    }

    #strategy .flm-stories-pagination .car-dot,
    #rotoballer-news .rb-news-pagination .car-dot {
      margin: 0
    }

    #rotoballer-news .rb-news-swiper {
      overflow: hidden;
      padding: 14px 8px 24px;
      margin: 0 -8px
    }

    #rotoballer-news .rb-news-swiper .swiper-slide {
      height: auto
    }

    #rotoballer-news .rb-news-card {
      background: #fff;
      border: 1.5px solid var(--bdr);
      border-radius: 14px;
      padding: 16px 18px;
      display: flex;
      flex-direction: column;
      gap: 8px;
      transition: all .3s var(--ease-expo);
      height: 100%
    }

    #rotoballer-news .rb-news-card:hover {
      transform: translateY(-4px);
      border-color: #78c98a;
      box-shadow: 0 16px 40px rgba(26, 92, 40, .1)
    }

    #rotoballer-news .rb-news-card__top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      flex-wrap: wrap
    }

    #rotoballer-news .rb-news-tag {
      display: inline-block;
      padding: 4px 12px;
      background: var(--g-600);
      color: #fff;
      font-size: .67rem;
      font-weight: 800;
      letter-spacing: .07em;
      text-transform: uppercase;
      border-radius: var(--r-full)
    }

    #rotoballer-news .rb-news-date {
      font-size: .72rem;
      color: #9aaa9e
    }

    #rotoballer-news .rb-news-title {
      font-size: .95rem;
      font-weight: 800;
      line-height: 1.32;
      color: var(--tx-h);
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden
    }

    #rotoballer-news .rb-news-excerpt {
      font-size: .84rem;
      color: var(--tx-m);
      line-height: 1.64;
      flex: 1
    }

    #rotoballer-news .rb-news-card__foot {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      flex-wrap: wrap;
      margin-top: auto
    }

    #rotoballer-news .rb-news-source {
      font-size: .72rem;
      font-weight: 700;
      color: var(--g-600);
      text-transform: uppercase;
      letter-spacing: .05em
    }

    #rotoballer-news .rb-news-empty {
      text-align: center;
      color: #7a8a7e;
      padding: 28px 0
    }

    #hot-props .hot-props-tournament {
      margin: -8px 0 24px;
      color: var(--g-600);
      font-weight: 700
    }

    #hot-props .hot-props-tabs {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 18px
    }

    #hot-props .hot-props-tab {
      border: 1.5px solid var(--bdr);
      background: #fff;
      color: var(--tx-m);
      border-radius: var(--r-full);
      padding: 8px 16px;
      font-size: .74rem;
      font-weight: 800;
      letter-spacing: .04em;
      text-transform: uppercase;
      cursor: pointer;
      transition: all .25s var(--ease-expo)
    }

    #hot-props .hot-props-tab:hover,
    #hot-props .hot-props-tab.is-active {
      border-color: var(--g-600);
      color: var(--g-600);
      background: rgba(26, 92, 40, .06)
    }

    #hot-props .odds-cell-best {
      color: var(--g-600);
      font-weight: 800
    }

    #hot-props .odds-tbl {
      table-layout: fixed;
    }

    #hot-props .odds-tbl th:first-child,
    #hot-props .odds-tbl td:first-child {
      width: 22%;
    }

    #competition-feeds .comp-books {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin: 0 0 28px
    }

    #competition-feeds .comp-feed-badges {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin: 0 0 18px
    }

    #competition-feeds .comp-feed-badge {
      display: inline-flex;
      align-items: center;
      padding: 7px 12px;
      border-radius: 999px;
      border: 1px solid var(--bdr);
      background: rgba(255,255,255,.7);
      font-size: .72rem;
      font-weight: 700;
      color: var(--tx-m)
    }

    #competition-feeds .comp-feed-badge.is-live {
      color: var(--g-700);
      border-color: rgba(26, 92, 40, .25);
      background: rgba(26, 92, 40, .08)
    }

    #competition-feeds .comp-players {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 12px;
      margin: 0 0 22px
    }

    #competition-feeds .comp-player-card {
      display: flex;
      gap: 12px;
      align-items: center;
      background: #fff;
      border: 1px solid var(--bdr);
      border-radius: 14px;
      padding: 12px 14px
    }

    #competition-feeds .comp-player-card__rank {
      min-width: 42px;
      height: 42px;
      border-radius: 12px;
      display: grid;
      place-items: center;
      background: rgba(26, 92, 40, .1);
      color: var(--g-600);
      font-weight: 800
    }

    #competition-feeds .comp-player-card h4 {
      margin: 0 0 4px;
      font-size: .92rem;
      font-weight: 800;
      color: var(--tx-h)
    }

    #competition-feeds .comp-player-card p {
      margin: 0;
      font-size: .75rem;
      color: var(--tx-m)
    }

    #competition-feeds .comp-live-pill,
    #competition-feeds .comp-done-pill {
      font-size: .68rem;
      font-weight: 800;
      letter-spacing: .06em;
      text-transform: uppercase;
      border-radius: 999px;
      padding: 4px 8px
    }

    #competition-feeds .comp-live-pill {
      color: #fff;
      background: var(--g-600)
    }

    #competition-feeds .comp-done-pill {
      color: var(--tx-m);
      background: #eef2ef
    }

    #competition-feeds .comp-book-chip {
      display: inline-flex;
      align-items: center;
      padding: 7px 12px;
      border-radius: 999px;
      border: 1px solid var(--bdr);
      background: #fff;
      font-size: .74rem;
      font-weight: 700;
      color: var(--g-700);
      letter-spacing: .01em
    }

    #competition-feeds {
      overflow-x: clip
    }

    #competition-feeds > .wrap {
      max-width: var(--container);
      width: 100%;
      margin-left: auto;
      margin-right: auto;
      box-sizing: border-box
    }

    #competition-feeds .comp-grid {
      display: grid;
      grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
      gap: 22px;
      align-items: start;
      width: 100%;
      min-width: 0
    }

    #competition-feeds .comp-panel {
      background: #fff;
      border: 1px solid var(--bdr);
      border-radius: 18px;
      padding: 18px;
      box-shadow: 0 8px 28px rgba(13, 30, 16, .04);
      height: auto;
      min-width: 0;
      max-width: 100%;
      overflow: hidden
    }

    #competition-feeds .comp-panel .table-wrap {
      width: 100%;
      max-width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch
    }

    #competition-feeds .comp-panel .odds-tbl {
      min-width: 0;
      width: 100%;
      table-layout: fixed
    }

    #competition-feeds .comp-panel .odds-tbl th,
    #competition-feeds .comp-panel .odds-tbl td {
      padding: 12px 10px;
      word-break: break-word;
      overflow-wrap: anywhere
    }

    #competition-feeds .comp-panel__head {
      display: flex;
      align-items: baseline;
      justify-content: space-between;
      gap: 12px;
      margin-bottom: 14px;
      flex-wrap: wrap;
      min-width: 0
    }

    #competition-feeds .comp-panel__title {
      font-size: 1.05rem;
      font-weight: 800;
      color: var(--tx-h);
      margin: 0
    }

    #competition-feeds .comp-panel__meta {
      font-size: .72rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: var(--tx-m)
    }

    #competition-feeds .comp-rank {
      display: inline-flex;
      min-width: 28px;
      height: 28px;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      background: rgba(26, 92, 40, .1);
      color: var(--g-600);
      font-weight: 800;
      font-size: .82rem
    }

    #competition-feeds .comp-rank-delta {
      margin-left: 6px;
      font-size: .68rem;
      font-weight: 700
    }

    #competition-feeds .comp-rank-delta.is-up { color: #1f7a1f }
    #competition-feeds .comp-rank-delta.is-down { color: #b45309 }

    #competition-feeds .comp-courses {
      display: grid;
      gap: 12px
    }

    #competition-feeds .comp-courses--grid {
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 12px
    }

    #competition-feeds .comp-course-card {
      border: 1px solid var(--bdr);
      border-radius: 14px;
      padding: 14px 14px 12px;
      background: linear-gradient(180deg, #fff 0%, #f7faf7 100%)
    }

    #competition-feeds .comp-course-card__top {
      display: flex;
      justify-content: space-between;
      gap: 10px;
      align-items: flex-start
    }

    #competition-feeds .comp-course-card h4 {
      margin: 0;
      font-size: .95rem;
      font-weight: 800;
      color: var(--tx-h)
    }

    #competition-feeds .comp-course-card time {
      font-size: .72rem;
      font-weight: 700;
      color: var(--g-600);
      white-space: nowrap
    }

    #competition-feeds .comp-course-venue {
      margin: 8px 0 2px;
      font-size: .84rem;
      font-weight: 600;
      color: var(--tx-b)
    }

    #competition-feeds .comp-course-loc {
      margin: 0;
      font-size: .78rem;
      color: var(--tx-m)
    }

    #competition-feeds .comp-course-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-top: 10px
    }

    #competition-feeds .comp-course-meta span {
      font-size: .7rem;
      font-weight: 700;
      letter-spacing: .04em;
      text-transform: uppercase;
      color: var(--g-700);
      background: rgba(26, 92, 40, .08);
      border-radius: 999px;
      padding: 5px 9px
    }

    @media (max-width: 920px) {
      #competition-feeds .comp-grid {
        grid-template-columns: 1fr
      }

      #competition-feeds .comp-players {
        grid-template-columns: 1fr
      }

      #competition-feeds .comp-courses--grid {
        grid-template-columns: 1fr
      }
    }

    .betmgm-offer {
      padding: 8px 0 28px
    }

    .betmgm-banner__pixel {
      position: absolute;
      width: 1px;
      height: 1px;
      border: 0;
      overflow: hidden;
      clip: rect(0, 0, 0, 0)
    }

    .betmgm-banner {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 18px 20px 18px 22px;
      background: #152816;
      border-radius: 22px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, .16);
      text-decoration: none;
      color: inherit;
      transition: transform .25s var(--ease-expo), box-shadow .25s var(--ease-expo)
    }

    .betmgm-banner:hover {
      transform: translateY(-1px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, .22)
    }

    .betmgm-banner__logo {
      flex-shrink: 0;
      padding: 8px 14px;
      border: 1.5px solid #e8c05d;
      border-radius: 8px;
      color: #e8c15f;
      font-weight: 700;
      background-color: #0a140b;
      font-size: .95rem;
      letter-spacing: .01em;
      line-height: 1.1
    }

    .betmgm-banner__copy {
      flex: 1;
      min-width: 0;
      display: flex;
      flex-direction: column;
      gap: 4px
    }

    .betmgm-banner__title {
      color: #fff;
      font-size: 1rem;
      font-weight: 700;
      line-height: 1.3
    }

    .betmgm-banner__terms {
      color: #f9cf7f;
      font-size: .75rem;
      font-weight: 400;
      line-height: 1.35
    }

    .betmgm-banner__cta {
      flex-shrink: 0;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      padding: 13px 26px;
      border-radius: 9999px;
      background: linear-gradient(90deg, #ca8e13 0%, #ebc666 100%);
      color: #1a1610;
      font-weight: 700;
      font-size: .95rem;
      white-space: nowrap;
      box-shadow: 0 4px 20px rgba(200, 168, 75, .3);
      transition: filter .2s ease, box-shadow .2s ease
    }

    .betmgm-banner:hover .betmgm-banner__cta {
      filter: brightness(1.05);
      box-shadow: 0 8px 24px rgba(200, 168, 75, .4)
    }

    @media (max-width: 900px) {
      .betmgm-banner {
        flex-wrap: wrap;
        padding: 16px
      }

      .betmgm-banner__cta {
        width: 100%;
        margin-top: 4px
      }
    }
  </style>
@endpush

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="{{ asset('assets/js/live-odds.js') }}?v={{ filemtime(public_path('assets/js/live-odds.js')) }}"></script>
  <script src="{{ asset('assets/js/hot-props.js') }}?v={{ filemtime(public_path('assets/js/hot-props.js')) }}"></script>
  <script src="{{ asset('assets/js/rotoballer-news.js') }}?v={{ filemtime(public_path('assets/js/rotoballer-news.js')) }}"></script>
  <script src="{{ asset('assets/js/flm-stories.js') }}?v={{ filemtime(public_path('assets/js/flm-stories.js')) }}"></script>
@endpush

{{-- Main content end --}}
@endsection
