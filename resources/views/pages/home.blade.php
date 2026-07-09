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
        <div class="hero-btns"><a href="#best-picks" class="btn btn-gold">View Best Picks</a><a href="#promos"
            class="btn btn-outline-dark" style="color:#fff;border-color:rgba(255,255,255,.3);">Sign Up & Get Bonuses</a>
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
          <p class="body-lg">In-depth articles and guides from professional golf analysts.</p>
        </div>
        <div class="cards-grid-4">
          @forelse ($tips as $tip)
            <a
              href="{{ route('tips.show', $tip) }}"
              class="art-card rev rev-d{{ ($loop->iteration - 1) % 4 + 1 }}"
              style="text-decoration:none;color:inherit;"
            >
              <div
                class="art-img"
                style="position:relative;background:linear-gradient(135deg,{{ $loop->odd ? '#fdf8ec,#f5edcc' : '#edf7f0,#d4eddb' }})"
              >
                @if ($tip->imageUrl())
                  <img
                    src="{{ $tip->imageUrl() }}"
                    alt="{{ $tip->title }}"
                    width="800"
                    height="500"
                    loading="lazy"
                    decoding="async"
                  />
                @endif
                @if ($tip->tipsCategory)
                  <span class="art-tag{{ $loop->odd ? ' gold-tag' : '' }}">{{ $tip->tipsCategory->title }}</span>
                @endif
              </div>
              <div class="art-body">
                <h3 class="art-title">{{ $tip->title }}</h3>
                <p class="art-desc">{{ $tip->description }}</p>
              </div>
            </a>
          @empty
            <p class="body-lg">No tips available at the moment.</p>
          @endforelse
        </div>
      </div>
    </section>

    <section id="promos" class="section-white">
      <div class="wrap">
        <div class="sec-head rev">
          <div class="eyebrow"><span
              style="width:6px;height:6px;border-radius:50%;background:var(--au-500);display:inline-block;"></span>Partner
            Offers</div>
          <h2 class="h-section">Exclusive <em>Sign-Up Bonuses</em></h2>
          <p class="body-lg">Verified offers updated weekly. All bonuses for new users only. Must be 21+.</p>
        </div>
        <div class="promos-grid">
          <div class="promo-card featured rev rev-d1">
            <div class="promo-ribbon">TOP PICK</div>
            <div class="book-name dk">DraftKings</div>
            <div class="promo-bonus">$200 Bonus</div>
            <p class="promo-desc">Bet $5, get $200 in bonus bets instantly.</p><a href="#promos" class="btn btn-gold"
              style="width:100%;justify-content:center;">Claim Bonus â†’</a>
          </div>
          <div class="promo-card rev rev-d2">
            <div class="book-name fd">FanDuel</div>
            <div class="promo-bonus">$150 Back</div>
            <p class="promo-desc">No Sweat First Bet up to $150.</p><a href="#promos" class="btn btn-primary"
              style="width:100%;justify-content:center;">Claim Bonus â†’</a>
          </div>
          <div class="promo-card rev rev-d3">
            <div class="book-name mgm">BetMGM</div>
            <div class="promo-bonus">$1,500 Back</div>
            <p class="promo-desc">First bet insurance up to $1,500.</p><a href="#promos" class="btn btn-primary"
              style="width:100%;justify-content:center;">Claim Bonus â†’</a>
          </div>
          <div class="promo-card rev rev-d4">
            <div class="book-name cz">Caesars</div>
            <div class="promo-bonus">$1,000 Back</div>
            <p class="promo-desc">First bet up to $1,000 back as bonus.</p><a href="#promos" class="btn btn-primary"
              style="width:100%;justify-content:center;">Claim Bonus â†’</a>
          </div>
          <div class="promo-card rev rev-d5">
            <div class="book-name b365">Bet365</div>
            <div class="promo-bonus">$200 Bonus</div>
            <p class="promo-desc">Bet $5 and receive $200 in bonus bets.</p><a href="#promos" class="btn btn-primary"
              style="width:100%;justify-content:center;">Claim Bonus â†’</a>
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
          <p class="body-lg">Hand-selected by our analytics team with confidence ratings.</p>
        </div>
        <div class="picks-grid">
          <div class="pick-card rev rev-d1">
            <div class="pick-top"><span class="pick-tour">The Players Championship</span><span
                class="pick-badge badge-hot">ðŸ”¥ Hot Pick</span></div>
            <div class="pick-player">Scottie Scheffler</div>
            <div class="pick-stats">
              <div class="pick-stat-g"><span class="psl">Best Odds</span><span class="psv odds">+650</span></div>
              <div class="pick-stat-g"><span class="psl">Book</span><span class="psv">DraftKings</span></div>
            </div>
            <div class="conf-row"><span class="conf-lbl">Confidence</span>
              <div class="conf-bar-bg">
                <div class="conf-fill" style="--w:88%"></div>
              </div><span class="conf-pct">88%</span>
            </div>
          </div>
          <div class="pick-card rev rev-d2">
            <div class="pick-top"><span class="pick-tour">Valero Texas Open</span><span
                class="pick-badge badge-value">ðŸ’Ž Value</span></div>
            <div class="pick-player">Akshay Bhatia</div>
            <div class="pick-stats">
              <div class="pick-stat-g"><span class="psl">Best Odds</span><span class="psv odds">+2800</span></div>
              <div class="pick-stat-g"><span class="psl">Book</span><span class="psv">FanDuel</span></div>
            </div>
            <div class="conf-row"><span class="conf-lbl">Confidence</span>
              <div class="conf-bar-bg">
                <div class="conf-fill" style="--w:72%"></div>
              </div><span class="conf-pct">72%</span>
            </div>
          </div>
          <div class="pick-card rev rev-d3">
            <div class="pick-top"><span class="pick-tour">The Masters</span><span class="pick-badge badge-value">ðŸ’Ž
                Value</span></div>
            <div class="pick-player">Rory McIlroy</div>
            <div class="pick-stats">
              <div class="pick-stat-g"><span class="psl">Best Odds</span><span class="psv odds">+950</span></div>
              <div class="pick-stat-g"><span class="psl">Book</span><span class="psv">BetMGM</span></div>
            </div>
            <div class="conf-row"><span class="conf-lbl">Confidence</span>
              <div class="conf-bar-bg">
                <div class="conf-fill" style="--w:81%"></div>
              </div><span class="conf-pct">81%</span>
            </div>
          </div>
          <div class="pick-card rev rev-d4">
            <div class="pick-top"><span class="pick-tour">The Players Championship</span><span
                class="pick-badge badge-hot">âš¡ Sharp</span></div>
            <div class="pick-player">Xander Schauffele</div>
            <div class="pick-stats">
              <div class="pick-stat-g"><span class="psl">Best Odds</span><span class="psv odds">+1400</span></div>
              <div class="pick-stat-g"><span class="psl">Book</span><span class="psv">Bet365</span></div>
            </div>
            <div class="conf-row"><span class="conf-lbl">Confidence</span>
              <div class="conf-bar-bg">
                <div class="conf-fill" style="--w:76%"></div>
              </div><span class="conf-pct">76%</span>
            </div>
          </div>
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
                    <th>{{ $book }}</th>
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
                    <th>{{ $book }}</th>
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
          <p class="body-lg" id="rotoballer-news-desc">Latest PGA Tour player news and matchup outlooks from RotoBaller. Auto-refreshes every {{ $newsRefreshSeconds ?? 300 }} seconds.</p>
        </div>
        <div
          class="rev"
          id="rotoballer-news-feed"
          data-endpoint="{{ route('api.rotoballer-news') }}"
          data-refresh-ms="{{ ($newsRefreshSeconds ?? 300) * 1000 }}"
        >
          <div class="swiper rb-news-swiper">
            <div class="swiper-wrapper" id="rb-news-swiper-wrapper">
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
                    <p class="rb-news-excerpt">{{ \Illuminate\Support\Str::limit($item['content'], 220) }}</p>
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
                <div class="guide-meta">Beginner Â· 15 min</div>
              </div>
            </a><a href="#golf-betting" class="guide-row">
              <div class="guide-icon">🎯</div>
              <div>
                <div class="guide-title">Types of Golf Bets Explained</div>
                <div class="guide-meta">Beginner Â· 8 min</div>
              </div>
            </a><a href="#golf-betting" class="guide-row">
            <div class="guide-icon">📊</div>
              <div>
                <div class="guide-title">Line Shopping: Find Best Odds</div>
                <div class="guide-meta">Advanced Â· 10 min</div>
              </div>
            </a><a href="#golf-betting" class="guide-row">
            <div class="guide-icon">�</div>
              <div>
                <div class="guide-title">Live In-Play Betting Strategy</div>
                <div class="guide-meta">Advanced Â· 12 min</div>
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
                type="submit" class="btn btn-gold form-btn">Subscribe â€” It's Free</button>
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
          <p class="body-lg">Current and upcoming PGA Tour events with key contenders.</p>
        </div>
        <div class="carousel-outer rev">
          <div class="carousel-inner" id="c-inner">
            <div class="t-card">
              <div class="t-img"><img
                  src="https://images.unsplash.com/photo-1593111774240-d529f12cf4bb?auto=format&fit=crop&w=800&q=80"
                  alt="TPC Sawgrass" width="800" height="450" loading="lazy" decoding="async" /></div>
              <div class="t-body">
                <div class="t-date">🏆 Apr 8–13 Â· Ponte Vedra, FL</div>
                <h3 class="t-name">The Players Championship</h3>
                <div class="t-players"><span class="t-chip">Scheffler</span><span class="t-chip">McIlroy</span></div><a
                  href="#best-picks" class="btn btn-primary btn-xs">View Picks â†’</a>
              </div>
            </div>
            <div class="t-card">
              <div class="t-img"><img
                  src="https://images.unsplash.com/photo-1587174486073-ae5e5cff23aa?auto=format&fit=crop&w=800&q=80"
                  alt="Valero" width="800" height="450" loading="lazy" decoding="async" /></div>
              <div class="t-body">
                <div class="t-date">🏆 Mar 27–30 Â· San Antonio</div>
                <h3 class="t-name">Valero Texas Open</h3>
                <div class="t-players"><span class="t-chip">Bhatia</span><span class="t-chip">Harman</span></div><a
                  href="#best-picks" class="btn btn-primary btn-xs">View Picks â†’</a>
              </div>
            </div>
            <div class="t-card">
              <div class="t-img"><img
                  src="https://images.unsplash.com/photo-1590496793929-36417d3117de?auto=format&fit=crop&w=800&q=80"
                  alt="Masters" width="800" height="450" loading="lazy" decoding="async" /></div>
              <div class="t-body">
                <div class="t-date">🏆 Apr 10–13 Â· Augusta, GA</div>
                <h3 class="t-name">The Masters Tournament</h3>
                <div class="t-players"><span class="t-chip">McIlroy</span><span class="t-chip">Scheffler</span></div><a
                  href="#best-picks" class="btn btn-primary btn-xs">View Picks â†’</a>
              </div>
            </div>
          </div>
        </div>
        <div class="car-ctrl"><button class="car-btn" id="c-prev">◀</button>
          <div class="car-dots"><button class="car-dot on"></button><button class="car-dot"></button><button
              class="car-dot"></button></div><button class="car-btn" id="c-next">▶</button>
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
        <div class="faq-wrap rev">
          <div class="faq-item"><button class="faq-q">Is Single Swing Golf free?<span class="faq-icon"><svg
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <path d="M12 5v14M5 12h14" />
                </svg></span></button>
            <div class="faq-a">
              <div class="faq-a-inner">Yes! Core features are free. Premium subscription is $9.99/month for exclusive
                picks and analysis.</div>
            </div>
          </div>
          <div class="faq-item"><button class="faq-q">How do affiliate bonuses work?<span class="faq-icon"><svg
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <path d="M12 5v14M5 12h14" />
                </svg></span></button>
            <div class="faq-a">
              <div class="faq-a-inner">Click a "Claim Bonus" button and sign up. The bonus applies automatically. We
                earn commission at no cost to you.</div>
            </div>
          </div>
          <div class="faq-item"><button class="faq-q">How are picks selected?<span class="faq-icon"><svg
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <path d="M12 5v14M5 12h14" />
                </svg></span></button>
            <div class="faq-a">
              <div class="faq-a-inner">Using Strokes Gained data, course fit analysis, recent form, and weather
                projections. Every pick is reviewed by senior analysts.</div>
            </div>
          </div>
          <div class="faq-item"><button class="faq-q">How often are odds updated?<span class="faq-icon"><svg
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <path d="M12 5v14M5 12h14" />
                </svg></span></button>
            <div class="faq-a">
              <div class="faq-a-inner">Every 2 minutes during tournaments. Best odds highlighted in green for quick
                identification.</div>
            </div>
          </div>
          <div class="faq-item"><button class="faq-q">Can I cancel my subscription?<span class="faq-icon"><svg
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <path d="M12 5v14M5 12h14" />
                </svg></span></button>
            <div class="faq-a">
              <div class="faq-a-inner">Absolutely. Cancel anytime, no questions asked. No long-term contracts. Full
                access until billing cycle ends.</div>
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

    #rotoballer-news .rb-news-swiper {
      overflow: hidden;
      border-radius: var(--r-lg)
    }

    #rotoballer-news .swiper-slide {
      height: auto
    }

    #rotoballer-news .rb-news-controls {
      margin-top: 18px
    }

    #rotoballer-news .rb-news-controls .car-btn {
      position: static;
      font-size: .82rem;
      line-height: 1;
      cursor: pointer
    }

    #rotoballer-news .rb-news-controls .car-btn::after,
    #rotoballer-news .rb-news-controls .car-btn::before {
      display: none
    }

    #rotoballer-news .rb-news-pagination {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      position: static;
      width: auto
    }

    #rotoballer-news .rb-news-pagination .car-dot {
      margin: 0
    }

    #rotoballer-news .rb-news-card {
      background: #fff;
      border: 1.5px solid var(--bdr);
      border-radius: var(--r-lg);
      padding: 22px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      transition: all .3s var(--ease-expo);
      height: 100%;
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
      font-size: 1rem;
      font-weight: 800;
      line-height: 1.32;
      color: var(--tx-h)
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
  </style>
@endpush

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="{{ asset('assets/js/live-odds.js') }}?v={{ filemtime(public_path('assets/js/live-odds.js')) }}"></script>
  <script src="{{ asset('assets/js/hot-props.js') }}?v={{ filemtime(public_path('assets/js/hot-props.js')) }}"></script>
  <script src="{{ asset('assets/js/rotoballer-news.js') }}?v={{ filemtime(public_path('assets/js/rotoballer-news.js')) }}"></script>
@endpush

{{-- Main content end --}}
@endsection
