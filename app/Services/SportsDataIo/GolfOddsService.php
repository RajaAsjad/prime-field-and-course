<?php

namespace App\Services\SportsDataIo;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class GolfOddsService
{
    private const HEADER = 'Ocp-Apim-Subscription-Key';

    /**
     * @return array{
     *     tournament: ?array{id: int, name: string, start_date: ?string, end_date: ?string, is_in_progress: bool},
     *     sportsbooks: list<string>,
     *     players: list<array{player_id: int, name: string, subtitle: string, odds: array<string, array{american: string, decimal: float, best: bool}>}>,
     *     updated_at: ?string,
     *     error: ?string
     * }
     */
    public function getComparisonTable(): array
    {
        $sportsbooks = array_keys(config('sportsdata.sportsbooks', []));
        $empty = [
            'tournament' => null,
            'weather' => null,
            'sportsbooks' => $sportsbooks,
            'players' => [],
            'market_players' => [],
            'is_live' => false,
            'scores_available' => false,
            'refresh_seconds' => $this->refreshSeconds(false),
            'updated_at' => now()->toIso8601String(),
            'error' => null,
        ];

        try {
            $tournament = $this->resolveTargetTournament();

            if ($tournament === null) {
                $empty['error'] = 'No upcoming PGA Tour tournament found.';

                return $empty;
            }

            $formattedTournament = $this->formatTournament($tournament);
            $weather = $this->fetchTournamentWeather($tournament);
            $tournamentId = (int) $tournament['TournamentID'];
            $isLive = (bool) ($tournament['IsInProgress'] ?? false);
            $leaderboard = $this->fetchLeaderboardScores($tournamentId, $isLive);

            try {
                $oddsRows = $this->fetchTournamentOdds($tournamentId, $isLive);
            } catch (RuntimeException $exception) {
                Log::warning('SportsDataIO golf odds unavailable', ['message' => $exception->getMessage()]);

                return [
                    'tournament' => $formattedTournament,
                    'weather' => $weather,
                    'sportsbooks' => $sportsbooks,
                    'players' => $this->buildLiveScoreRows($leaderboard, collect(), $tournament),
                    'is_live' => $isLive,
                    'scores_available' => $leaderboard !== [],
                    'refresh_seconds' => $this->refreshSeconds($isLive),
                    'updated_at' => now()->toIso8601String(),
                    'error' => $this->friendlyOddsError($exception->getMessage()),
                ];
            }

            if ($oddsRows->isEmpty() && $leaderboard === []) {
                return [
                    'tournament' => $formattedTournament,
                    'weather' => $weather,
                    'sportsbooks' => $sportsbooks,
                    'players' => [],
                    'is_live' => $isLive,
                    'scores_available' => false,
                    'refresh_seconds' => $this->refreshSeconds($isLive),
                    'updated_at' => now()->toIso8601String(),
                    'error' => 'Live odds are not available yet for this tournament.',
                ];
            }

            $rawPlayers = $isLive && $leaderboard !== []
                ? $this->buildLiveScoreRows($leaderboard, $oddsRows, $tournament, applyBestValueMarks: false)
                : $this->buildPlayerRows($oddsRows, $tournament, $leaderboard, applyBestValueMarks: false);

            $playerLimit = (int) config('sportsdata.odds.player_limit', 10);
            $players = array_slice(
                $this->applyBestValueMarks($rawPlayers),
                0,
                $playerLimit
            );

            $visibleSportsbooks = $this->sportsbooksPresentInPlayers($players, $sportsbooks);
            $scoresAvailable = collect($players)->contains(
                fn (array $player) => ! empty($player['score']['to_par'] ?? null)
            );

            return [
                'tournament' => $formattedTournament,
                'weather' => $weather,
                'sportsbooks' => $visibleSportsbooks !== [] ? $visibleSportsbooks : $sportsbooks,
                'players' => $players,
                'market_players' => $rawPlayers,
                'is_live' => $isLive,
                'scores_available' => $scoresAvailable,
                'refresh_seconds' => $this->refreshSeconds($isLive),
                'updated_at' => now()->toIso8601String(),
                'error' => null,
            ];
        } catch (\Throwable $exception) {
            Log::error('SportsDataIO golf odds failed', ['message' => $exception->getMessage()]);

            return [
                ...$empty,
                'scores_available' => false,
                'market_players' => [],
                'error' => 'Unable to load live odds right now. Please try again shortly.',
            ];
        }
    }

    /**
     * Top Picks from real SportsDataIO tournament odds (favorites first, actual book prices).
     *
     * @param  array{
     *     tournament: ?array{name?: string},
     *     players?: list<array{name: string, odds: array<string, array{american: string, decimal: float, best: bool}>, score?: ?array{rank?: ?int}}>,
     *     market_players?: list<array{name: string, odds: array<string, array{american: string, decimal: float, best: bool}>, score?: ?array{rank?: ?int}}>,
     *     is_live?: bool
     * }  $liveOdds
     * @return list<array{tournament: string, player: string, american: string, book: string, badge: string, badge_class: string, confidence: int}>
     */
    public function buildTopPicks(array $liveOdds, int $limit = 4): array
    {
        $tournament = (string) ($liveOdds['tournament']['name'] ?? 'PGA Tour');
        $badges = [
            ['label' => 'Hot Pick', 'class' => 'badge-hot'],
            ['label' => 'Value', 'class' => 'badge-value'],
            ['label' => 'Value', 'class' => 'badge-value'],
            ['label' => 'Sharp', 'class' => 'badge-hot'],
        ];

        $sourcePlayers = $liveOdds['market_players'] ?? $liveOdds['players'] ?? [];

        return collect($sourcePlayers)
            ->filter(fn ($player) => is_array($player) && ! empty($player['odds']))
            ->map(function (array $player) use ($tournament) {
                $bestPayout = $this->findBestPayoutOdds($player['odds'] ?? []);

                if ($bestPayout === null) {
                    return null;
                }

                return [
                    'tournament' => $tournament,
                    'player' => (string) ($player['name'] ?? 'Unknown'),
                    'american' => $this->formatAmericanOdds($bestPayout['american']),
                    'book' => $bestPayout['book'],
                    'decimal' => $this->americanToDecimal($bestPayout['american']),
                    'favorite_decimal' => $this->playerBestDecimal($player['odds'] ?? []),
                    'rank' => $player['score']['rank'] ?? null,
                ];
            })
            ->filter()
            ->sortBy([
                ['favorite_decimal', 'asc'],
                ['player', 'asc'],
            ])
            ->unique('player')
            ->take($limit)
            ->values()
            ->map(function (array $pick, int $index) use ($badges) {
                $badge = $badges[$index % count($badges)];

                return [
                    'tournament' => $pick['tournament'],
                    'player' => $pick['player'],
                    'american' => $pick['american'],
                    'book' => $pick['book'],
                    'badge' => $badge['label'],
                    'badge_class' => $badge['class'],
                    'confidence' => $this->topPickConfidence($pick['favorite_decimal'], $pick['rank'], $index),
                ];
            })
            ->all();
    }

    /**
     * Best payout for the bettor across sportsbooks (highest decimal / longest American).
     *
     * @param  array<string, array{american: string, decimal: float, best: bool}>  $odds
     * @return array{american: int, book: string}|null
     */
    private function findBestPayoutOdds(array $odds): ?array
    {
        $preferredBooks = ['FanDuel', 'BetMGM', 'DraftKings', 'Caesars'];
        $best = null;

        foreach ($preferredBooks as $book) {
            if (! isset($odds[$book]['american'])) {
                continue;
            }

            $american = (int) str_replace('+', '', (string) $odds[$book]['american']);
            $decimal = $this->americanToDecimal($american);

            if ($best === null || $decimal > $best['decimal']) {
                $best = [
                    'american' => $american,
                    'book' => $book,
                    'decimal' => $decimal,
                ];
            }
        }

        if ($best === null) {
            return null;
        }

        return [
            'american' => $best['american'],
            'book' => $best['book'],
        ];
    }

    private function topPickConfidence(float $decimal, ?int $rank, int $index = 0): int
    {
        if ($rank !== null && $rank > 0) {
            return max(55, min(95, 100 - (($rank - 1) * 4)));
        }

        if ($decimal <= 0) {
            return max(60, 82 - ($index * 6));
        }

        // Favorites (shorter prices) score higher; card order also spreads values.
        $fromOdds = (int) round(100 - ($decimal * 2.4));

        return max(55, min(94, $fromOdds - ($index * 3)));
    }

    /**
     * @return array{id: int, title: string, content: string, url: string, detail_url: string, source: string, author: string, category: string, updated_at: ?string}|null
     */
    public function getNewsItem(int $newsId): ?array
    {
        if ($newsId <= 0) {
            return null;
        }

        try {
            $row = collect($this->fetchNewsRows())
                ->first(fn ($item) => is_array($item) && (int) ($item['NewsID'] ?? 0) === $newsId);

            return is_array($row) ? $this->formatNewsItem($row) : null;
        } catch (\Throwable $exception) {
            Log::warning('SportsDataIO golf news item failed', [
                'news_id' => $newsId,
                'message' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function fetchNewsRows(): array
    {
        $rows = $this->getJson(
            $this->golfUrl('News'),
            (int) config('sportsdata.news.cache_ttl', 300),
            'sportsdata:golf:news'
        );

        return is_array($rows) ? $rows : [];
    }

    /**
     * @return array{
     *     tournament: ?array{id: int, name: string, start_date: ?string, end_date: ?string, is_in_progress: bool},
     *     sportsbooks: list<string>,
     *     brackets: list<array{key: string, label: string, type: string, players?: list<array{name: string, odds: array<string, array{american: string, decimal: float, best: bool}>}>, outcomes?: list<array{label: string, odds: array<string, array{american: string, decimal: float, best: bool}>}>}>,
     *     active_key: string,
     *     refresh_seconds: int,
     *     updated_at: string,
     *     error: ?string
     * }
     */
    public function getHotPropsBracket(): array
    {
        $sportsbooks = $this->propsSportsbookColumns();
        $bracketConfig = config('sportsdata.props.brackets', []);
        $refreshSeconds = (int) config('sportsdata.props.refresh_seconds', 120);

        $empty = [
            'tournament' => null,
            'sportsbooks' => $sportsbooks,
            'brackets' => [],
            'active_key' => array_key_first($bracketConfig) ?: 'top_5',
            'refresh_seconds' => $refreshSeconds,
            'updated_at' => now()->toIso8601String(),
            'error' => null,
        ];

        try {
            $tournament = $this->resolveTargetTournament();

            if ($tournament === null) {
                $empty['error'] = 'No upcoming PGA Tour tournament found.';

                return $empty;
            }

            $tournamentId = (int) $tournament['TournamentID'];
            $isLive = (bool) ($tournament['IsInProgress'] ?? false);
            $markets = $this->fetchBettingMarketsByGroup($tournamentId, $isLive);
            $brackets = [];

            foreach ($bracketConfig as $key => $config) {
                if (! is_array($config)) {
                    continue;
                }

                $bracket = $this->buildPropsBracket($key, $config, $markets, $sportsbooks);

                if ($bracket !== null) {
                    $brackets[] = $bracket;
                }
            }

            return [
                'tournament' => $this->formatTournament($tournament),
                'sportsbooks' => $this->sportsbooksPresentInPropBrackets($brackets, $sportsbooks),
                'brackets' => $brackets,
                'active_key' => $brackets[0]['key'] ?? ($empty['active_key']),
                'refresh_seconds' => $refreshSeconds,
                'updated_at' => now()->toIso8601String(),
                'error' => $brackets === [] ? 'Prop odds are not available yet for this tournament.' : null,
            ];
        } catch (\Throwable $exception) {
            Log::error('SportsDataIO golf props failed', ['message' => $exception->getMessage()]);

            return [
                ...$empty,
                'error' => 'Unable to load prop odds right now. Please try again shortly.',
            ];
        }
    }

    /**
     * Competition + Event feeds the Golf subscription unlocks:
     * Rankings, Players, Courses/Venues, Utility, Schedule (Tournaments), Season Stats.
     *
     * @return array{
     *     season: ?array{id: int, description: string, start_date: ?string, end_date: ?string},
     *     feeds: list<array{key: string, label: string, status: string}>,
     *     rankings: list<array{rank: int, rank_last_week: ?int, player_id: int, name: string, events: int, average_points: float, total_points: float}>,
     *     players: list<array{player_id: int, name: string, rank: int, country: ?string, college: ?string, swings: ?string, birth_date: ?string, photo_url: ?string}>,
     *     stats: list<array{player_id: int, name: string, rank: int, events: int, average_points: float, total_points: float, points_gained: float, points_lost: float}>,
     *     courses: list<array{tournament_id: ?int, name: string, venue: ?string, location: ?string, start_date: ?string, end_date: ?string, par: ?int, yards: ?int, format: ?string}>,
     *     schedule: list<array{id: int, name: string, venue: ?string, location: ?string, start_date: ?string, end_date: ?string, is_over: bool, is_in_progress: bool, par: ?int, yards: ?int, purse: ?float}>,
     *     sportsbooks: list<array{id: int, name: string}>,
     *     refresh_seconds: int,
     *     updated_at: string,
     *     error: ?string
     * }
     */
    public function getCompetitionFeeds(): array
    {
        $refreshSeconds = (int) config('sportsdata.competition.refresh_seconds', 900);
        $empty = [
            'season' => null,
            'feeds' => $this->competitionFeedBadges(),
            'rankings' => [],
            'players' => [],
            'stats' => [],
            'courses' => [],
            'schedule' => [],
            'sportsbooks' => [],
            'refresh_seconds' => $refreshSeconds,
            'updated_at' => now()->toIso8601String(),
            'error' => null,
        ];

        try {
            $ttl = (int) config('sportsdata.competition.cache_ttl', 900);
            $rankingsLimit = (int) config('sportsdata.competition.rankings_limit', 10);
            $coursesLimit = (int) config('sportsdata.competition.courses_limit', 6);
            $scheduleLimit = (int) config('sportsdata.competition.schedule_limit', 8);
            $playersLimit = (int) config('sportsdata.competition.players_limit', 6);

            $seasonPayload = $this->getJson(
                $this->golfUrl('CurrentSeason'),
                $ttl,
                'sportsdata:competition:current-season'
            );

            $seasonId = (int) ($seasonPayload['SeasonID'] ?? now()->year);

            $rankingsRows = collect($this->getJson(
                $this->golfUrl("Rankings/{$seasonId}"),
                $ttl,
                "sportsdata:competition:rankings:{$seasonId}"
            ))->filter(fn ($row) => is_array($row) && ! empty($row['Name']));

            $rankings = $rankingsRows
                ->sortBy(fn (array $row) => (int) ($row['WorldGolfRank'] ?? PHP_INT_MAX))
                ->take($rankingsLimit)
                ->map(fn (array $row) => [
                    'rank' => (int) ($row['WorldGolfRank'] ?? 0),
                    'rank_last_week' => isset($row['WorldGolfRankLastWeek']) ? (int) $row['WorldGolfRankLastWeek'] : null,
                    'player_id' => (int) ($row['PlayerID'] ?? 0),
                    'name' => (string) ($row['Name'] ?? ''),
                    'events' => (int) ($row['Events'] ?? 0),
                    'average_points' => (float) ($row['AveragePoints'] ?? 0),
                    'total_points' => (float) ($row['TotalPoints'] ?? 0),
                ])
                ->values()
                ->all();

            $stats = collect($this->getJson(
                $this->golfUrl("PlayerSeasonStats/{$seasonId}"),
                $ttl,
                "sportsdata:competition:season-stats:{$seasonId}"
            ))
                ->filter(fn ($row) => is_array($row) && ! empty($row['Name']))
                ->sortBy(fn (array $row) => (int) ($row['WorldGolfRank'] ?? PHP_INT_MAX))
                ->take($rankingsLimit)
                ->map(fn (array $row) => [
                    'player_id' => (int) ($row['PlayerID'] ?? 0),
                    'name' => (string) ($row['Name'] ?? ''),
                    'rank' => (int) ($row['WorldGolfRank'] ?? 0),
                    'events' => (int) ($row['Events'] ?? 0),
                    'average_points' => (float) ($row['AveragePoints'] ?? 0),
                    'total_points' => (float) ($row['TotalPoints'] ?? 0),
                    'points_gained' => (float) ($row['PointsGained'] ?? 0),
                    'points_lost' => (float) ($row['PointsLost'] ?? 0),
                ])
                ->values()
                ->all();

            $players = $this->buildFeaturedPlayers(
                collect($rankings)->take($playersLimit)->all(),
                $ttl
            );

            $today = now()->startOfDay();

            $schedule = collect($this->getJson(
                $this->golfUrl("Tournaments/{$seasonId}"),
                $ttl,
                "sportsdata:competition:tournaments:{$seasonId}"
            ))
                ->filter(fn ($row) => is_array($row) && ! empty($row['Name']))
                ->filter(function (array $row) use ($today) {
                    $start = isset($row['StartDate']) ? \Carbon\Carbon::parse($row['StartDate']) : null;
                    $end = isset($row['EndDate']) ? \Carbon\Carbon::parse($row['EndDate']) : $start;

                    if ($start === null || $end === null) {
                        return false;
                    }

                    return $end->greaterThanOrEqualTo($today->copy()->subDays(3))
                        && $start->lessThanOrEqualTo($today->copy()->addMonths(4));
                })
                ->sortBy('StartDate')
                ->take($scheduleLimit)
                ->map(fn (array $row) => [
                    'id' => (int) ($row['TournamentID'] ?? 0),
                    'name' => (string) ($row['Name'] ?? ''),
                    'venue' => $row['Venue'] ?? null,
                    'location' => $row['Location'] ?? null,
                    'start_date' => $row['StartDate'] ?? null,
                    'end_date' => $row['EndDate'] ?? null,
                    'is_over' => (bool) ($row['IsOver'] ?? false),
                    'is_in_progress' => (bool) ($row['IsInProgress'] ?? false),
                    'par' => isset($row['Par']) ? (int) $row['Par'] : null,
                    'yards' => isset($row['Yards']) ? (int) $row['Yards'] : null,
                    'purse' => isset($row['Purse']) ? (float) $row['Purse'] : null,
                    'format' => $row['Format'] ?? null,
                ])
                ->values()
                ->all();

            // Enrich schedule with course format, then expose the same list as venues.
            $courseFormats = collect($this->getJson(
                $this->golfUrl('Courses'),
                $ttl,
                'sportsdata:competition:courses'
            ))
                ->filter(fn ($row) => is_array($row) && ! empty($row['TournamentID']))
                ->mapWithKeys(fn (array $row) => [
                    (int) $row['TournamentID'] => $row['Format'] ?? null,
                ]);

            $schedule = collect($schedule)
                ->map(function (array $event) use ($courseFormats) {
                    $event['format'] = $event['format'] ?? $courseFormats->get($event['id']);

                    return $event;
                })
                ->values()
                ->all();

            $courses = collect($schedule)
                ->take(max($coursesLimit, $scheduleLimit))
                ->map(fn (array $event) => [
                    'tournament_id' => $event['id'],
                    'name' => $event['name'],
                    'venue' => $event['venue'],
                    'location' => $event['location'],
                    'start_date' => $event['start_date'],
                    'end_date' => $event['end_date'],
                    'par' => $event['par'],
                    'yards' => $event['yards'],
                    'format' => $event['format'] ?? null,
                ])
                ->values()
                ->all();

            $preferredBooks = array_keys(config('sportsdata.sportsbooks', []));
            $sportsbooks = collect($this->getJson(
                $this->oddsUrl('ActiveSportsbooks'),
                $ttl,
                'sportsdata:competition:active-sportsbooks'
            ))
                ->filter(fn ($row) => is_array($row) && ! empty($row['Name']))
                ->map(fn (array $row) => [
                    'id' => (int) ($row['SportsbookID'] ?? 0),
                    'name' => (string) ($row['Name'] ?? ''),
                ])
                ->sortBy(function (array $book) use ($preferredBooks) {
                    $index = array_search($book['name'], $preferredBooks, true);

                    return $index === false ? 100 + $book['id'] : $index;
                })
                ->values()
                ->all();

            return [
                'season' => [
                    'id' => $seasonId,
                    'description' => (string) ($seasonPayload['Description'] ?? (string) $seasonId),
                    'start_date' => $seasonPayload['StartDate'] ?? null,
                    'end_date' => $seasonPayload['EndDate'] ?? null,
                ],
                'feeds' => $this->competitionFeedBadges([
                    'rankings' => $rankings !== [],
                    'players' => $players !== [],
                    'courses' => $courses !== [],
                    'utility' => $seasonId > 0,
                    'schedule' => $schedule !== [],
                    'stats' => $stats !== [],
                    'props' => true,
                    'news' => true,
                ]),
                'rankings' => $rankings,
                'players' => $players,
                'stats' => $stats,
                'courses' => $courses,
                'schedule' => $schedule,
                'sportsbooks' => $sportsbooks,
                'refresh_seconds' => $refreshSeconds,
                'updated_at' => now()->toIso8601String(),
                'error' => ($rankings === [] && $schedule === [])
                    ? 'Competition feed data is not available right now.'
                    : null,
            ];
        } catch (\Throwable $exception) {
            Log::error('SportsDataIO competition feeds failed', ['message' => $exception->getMessage()]);

            return [
                ...$empty,
                'error' => 'Unable to load competition feeds right now. Please try again shortly.',
            ];
        }
    }

    /**
     * @param  array<string, bool>  $availability
     * @return list<array{key: string, label: string, status: string}>
     */
    private function competitionFeedBadges(array $availability = []): array
    {
        $defs = [
            'rankings' => 'Standings & Rankings',
            'players' => 'Teams, Players & Rosters',
            'courses' => 'Venues & Officials',
            'utility' => 'Utility Endpoints',
            'schedule' => 'Schedules & Game Day',
            'stats' => 'Player Season Stats',
            'props' => 'Betting Props',
            'news' => 'RotoBaller News',
        ];

        return collect($defs)
            ->map(fn (string $label, string $key) => [
                'key' => $key,
                'label' => $label,
                'status' => ($availability[$key] ?? true) ? 'live' : 'pending',
            ])
            ->values()
            ->all();
    }

    /**
     * @param  list<array{player_id: int, name: string, rank: int}>  $rankings
     * @return list<array{player_id: int, name: string, rank: int, country: ?string, college: ?string, swings: ?string, birth_date: ?string, photo_url: ?string}>
     */
    private function buildFeaturedPlayers(array $rankings, int $ttl): array
    {
        $players = [];

        foreach ($rankings as $row) {
            $playerId = (int) ($row['player_id'] ?? 0);

            if ($playerId <= 0) {
                continue;
            }

            try {
                $profile = $this->getJson(
                    $this->golfUrl("Player/{$playerId}"),
                    $ttl,
                    "sportsdata:competition:player:{$playerId}"
                );
            } catch (\Throwable) {
                $profile = [];
            }

            $first = trim((string) ($profile['FirstName'] ?? ''));
            $last = trim((string) ($profile['LastName'] ?? ''));
            $fullName = trim($first.' '.$last);

            $players[] = [
                'player_id' => $playerId,
                'name' => $fullName !== '' ? $fullName : (string) ($row['name'] ?? 'Player'),
                'rank' => (int) ($row['rank'] ?? 0),
                'country' => $profile['Country'] ?? null,
                'college' => $profile['College'] ?? null,
                'swings' => $profile['Swings'] ?? null,
                'birth_date' => $profile['BirthDate'] ?? null,
                'photo_url' => $profile['PhotoUrl'] ?? null,
            ];
        }

        return $players;
    }

    /**
     * @return array{
     *     items: list<array{id: int, title: string, content: string, url: string, detail_url: string, source: string, author: string, category: string, updated_at: ?string}>,
     *     refresh_seconds: int,
     *     updated_at: string,
     *     error: ?string
     * }
     */
    public function getNewsFeed(): array
    {
        $limit = (int) config('sportsdata.news.limit', 6);
        $refreshSeconds = (int) config('sportsdata.news.refresh_seconds', 300);

        $empty = [
            'items' => [],
            'refresh_seconds' => $refreshSeconds,
            'updated_at' => now()->toIso8601String(),
            'error' => null,
        ];

        try {
            $items = collect($this->fetchNewsRows())
                ->filter(fn ($row) => is_array($row))
                ->sortByDesc(fn (array $row) => $row['Updated'] ?? '')
                ->take($limit)
                ->map(fn (array $row) => $this->formatNewsItem($row))
                ->values()
                ->all();

            return [
                'items' => $items,
                'refresh_seconds' => $refreshSeconds,
                'updated_at' => now()->toIso8601String(),
                'error' => $items === [] ? 'No RotoBaller news available right now.' : null,
            ];
        } catch (\Throwable $exception) {
            Log::error('SportsDataIO golf news failed', ['message' => $exception->getMessage()]);

            return [
                ...$empty,
                'error' => 'Unable to load RotoBaller news right now. Please try again shortly.',
            ];
        }
    }

    /**
     * @param  array<string, mixed>  $row
     * @return array{id: int, title: string, content: string, url: string, detail_url: string, source: string, author: string, category: string, updated_at: ?string}
     */
    private function formatNewsItem(array $row): array
    {
        $updated = $row['Updated'] ?? null;
        $newsId = (int) ($row['NewsID'] ?? 0);

        return [
            'id' => $newsId,
            'title' => (string) ($row['Title'] ?? ''),
            'content' => (string) ($row['Content'] ?? ''),
            'url' => (string) ($row['Url'] ?? ''),
            'detail_url' => url('/news/'.$newsId),
            'source' => (string) ($row['Source'] ?? 'RotoBaller'),
            'author' => (string) ($row['Author'] ?? ''),
            'category' => (string) ($row['Categories'] ?? ''),
            'updated_at' => is_string($updated) && $updated !== ''
                ? \Carbon\Carbon::parse($updated)->toIso8601String()
                : null,
        ];
    }

    private function friendlyOddsError(string $message): string
    {
        if (str_contains(strtolower($message), 'not authorized') || str_contains(strtolower($message), 'access denied')) {
            return 'Betting odds require the SportsDataIO Golf Betting feed on your subscription. Golf tournament data is connected — contact SportsDataIO to enable odds access.';
        }

        return $message;
    }

    /**
     * @return array<string, mixed>|null
     */
    private function resolveTargetTournament(): ?array
    {
        $season = $this->getJson(
            $this->golfUrl('CurrentSeason'),
            config('sportsdata.cache.tournaments_ttl'),
            'sportsdata:current-season'
        );

        $seasonId = (int) ($season['SeasonID'] ?? now()->year);
        $tournaments = $this->getJson(
            $this->golfUrl("Tournaments/{$seasonId}"),
            config('sportsdata.cache.tournaments_ttl'),
            "sportsdata:tournaments:{$seasonId}"
        );

        if (! is_array($tournaments) || $tournaments === []) {
            return null;
        }

        $today = now()->startOfDay();

        $inProgress = collect($tournaments)
            ->filter(fn (array $t) => ($t['IsInProgress'] ?? false) && ! ($t['IsOver'] ?? true))
            ->sortBy('StartDate')
            ->first();

        if (is_array($inProgress)) {
            return $inProgress;
        }

        return collect($tournaments)
            ->filter(function (array $t) use ($today) {
                if ($t['IsOver'] ?? true) {
                    return false;
                }

                if (($t['OddsCoverage'] ?? '') === 'Limited') {
                    return false;
                }

                $start = isset($t['StartDate']) ? \Carbon\Carbon::parse($t['StartDate']) : null;

                return $start !== null && $start->greaterThanOrEqualTo($today->copy()->subDays(3));
            })
            ->sortBy('StartDate')
            ->first();
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    private function fetchTournamentOdds(int $tournamentId, bool $inProgress): Collection
    {
        $cacheKey = "sportsdata:odds:{$tournamentId}:" . ($inProgress ? 'live' : 'pregame');
        $ttl = $inProgress
            ? (int) config('sportsdata.cache.scores_ttl')
            : config('sportsdata.cache.odds_ttl');

        return Cache::remember($cacheKey, $ttl, function () use ($tournamentId, $inProgress) {
            $rows = collect();

            if ($inProgress) {
                $rows = $rows->merge($this->fetchOddsEndpoint("InPlayTournamentOdds/{$tournamentId}"));
            }

            $rows = $rows
                ->merge($this->fetchOddsEndpoint("TournamentOdds/{$tournamentId}"))
                ->merge($this->fetchOddsFromBettingMarkets($tournamentId));

            return $rows
                ->filter(fn (array $row) => ($row['IsAvailable'] ?? true) !== false)
                ->values();
        });
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    private function fetchOddsEndpoint(string $path): Collection
    {
        try {
            $payload = $this->request($this->oddsUrl($path));

            if (isset($payload['PlayerTournamentOdds']) && is_array($payload['PlayerTournamentOdds'])) {
                return collect($payload['PlayerTournamentOdds']);
            }

            if (is_array($payload) && array_is_list($payload)) {
                return collect($payload);
            }

            return collect();
        } catch (RuntimeException $exception) {
            if (str_contains($exception->getMessage(), 'not authorized')) {
                throw $exception;
            }

            return collect();
        }
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    /**
     * @return list<string>
     */
    private function propsSportsbookColumns(): array
    {
        return [
            ...array_keys(config('sportsdata.sportsbooks', [])),
            'Consensus',
        ];
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    private function fetchBettingMarketsByGroup(int $tournamentId, bool $inProgress): Collection
    {
        $group = trim((string) config('sportsdata.sportsbook_group', ''));
        $groupKey = $group !== '' ? $group : 'all';
        $cacheKey = "sportsdata:props-markets:{$tournamentId}:{$groupKey}:v2:" . ($inProgress ? 'live' : 'pregame');
        $ttl = $inProgress
            ? (int) config('sportsdata.cache.scores_ttl')
            : (int) config('sportsdata.props.cache_ttl', 120);

        return Cache::remember($cacheKey, $ttl, function () use ($tournamentId, $group) {
            // Ungrouped endpoint returns individual sportsbooks (FanDuel, BetMGM, Caesars, etc).
            // G1000 / consensus groups often only include Consensus lines.
            $path = $group !== ''
                ? "BettingMarketsByTournamentID/{$tournamentId}/{$group}"
                : "BettingMarketsByTournamentID/{$tournamentId}";

            try {
                $markets = $this->request($this->oddsUrl($path));
            } catch (RuntimeException $exception) {
                if (str_contains($exception->getMessage(), 'not authorized')) {
                    throw $exception;
                }

                // If a custom group fails, fall back to all sportsbooks.
                if ($group !== '') {
                    try {
                        $markets = $this->request(
                            $this->oddsUrl("BettingMarketsByTournamentID/{$tournamentId}")
                        );
                    } catch (RuntimeException $fallbackException) {
                        if (str_contains($fallbackException->getMessage(), 'not authorized')) {
                            throw $fallbackException;
                        }

                        return collect();
                    }
                } else {
                    return collect();
                }
            }

            if (! is_array($markets)) {
                return collect();
            }

            $neededBetTypes = collect(config('sportsdata.props.brackets', []))
                ->flatMap(fn ($bracket) => is_array($bracket) ? ($bracket['bet_types'] ?? []) : [])
                ->filter()
                ->unique()
                ->values()
                ->all();

            return collect($markets)
                ->filter(function ($market) use ($neededBetTypes) {
                    if (! is_array($market)) {
                        return false;
                    }

                    if ($neededBetTypes === []) {
                        return true;
                    }

                    return in_array((string) ($market['BettingBetType'] ?? ''), $neededBetTypes, true);
                })
                ->values();
        });
    }

    /**
     * @param  array<string, mixed>  $config
     * @param  Collection<int, array<string, mixed>>  $markets
     * @param  list<string>  $sportsbooks
     * @return array{key: string, label: string, type: string, players?: list<array{name: string, odds: array<string, array{american: string, decimal: float, best: bool}>}>, outcomes?: list<array{label: string, odds: array<string, array{american: string, decimal: float, best: bool}>}>}|null
     */
    private function buildPropsBracket(string $key, array $config, Collection $markets, array $sportsbooks): ?array
    {
        $label = (string) ($config['label'] ?? $key);
        $betTypes = collect($config['bet_types'] ?? [])->filter()->values();
        $marketFilter = (string) ($config['market_filter'] ?? 'player');

        if ($betTypes->isEmpty()) {
            return null;
        }

        $matchedMarkets = $markets->filter(function (array $market) use ($betTypes) {
            $betType = (string) ($market['BettingBetType'] ?? '');

            return $betTypes->contains($betType);
        })->values();

        if ($matchedMarkets->isEmpty()) {
            if ($marketFilter === 'yes_no_tournament') {
                return [
                    'key' => $key,
                    'label' => $label,
                    'type' => 'yes_no',
                    'outcomes' => [],
                ];
            }

            return [
                'key' => $key,
                'label' => $label,
                'type' => 'player',
                'players' => [],
            ];
        }

        if ($marketFilter === 'yes_no_tournament') {
            $market = $matchedMarkets->first(function (array $market) {
                $types = collect($market['BettingOutcomes'] ?? [])
                    ->pluck('BettingOutcomeType')
                    ->filter()
                    ->map(fn ($type) => strtolower((string) $type));

                return $types->contains('yes') && $types->contains('no');
            });

            if (! is_array($market)) {
                return [
                    'key' => $key,
                    'label' => $label,
                    'type' => 'yes_no',
                    'outcomes' => [],
                ];
            }

            return [
                'key' => $key,
                'label' => $label,
                'type' => 'yes_no',
                'outcomes' => $this->buildYesNoOutcomes($market, $sportsbooks),
            ];
        }

        $market = $matchedMarkets->first();

        if (! is_array($market)) {
            return null;
        }

        $limit = (int) ($config['limit'] ?? config('sportsdata.props.player_limit', 20));

        return [
            'key' => $key,
            'label' => $label,
            'type' => 'player',
            'players' => $this->buildPlayerPropRows($market, $sportsbooks, $limit),
        ];
    }

    /**
     * @param  array<string, mixed>  $market
     * @param  list<string>  $sportsbooks
     * @return list<array{label: string, odds: array<string, array{american: string, decimal: float, best: bool}>}>
     */
    private function buildYesNoOutcomes(array $market, array $sportsbooks): array
    {
        $grouped = [];

        foreach ($market['BettingOutcomes'] ?? [] as $outcome) {
            if (! is_array($outcome)) {
                continue;
            }

            $book = $this->normalizePropsSportsbook(
                (string) ($outcome['SportsBook']['Name'] ?? $outcome['SportsBook']['Sportsbook'] ?? '')
            );

            if ($book === null) {
                continue;
            }

            $american = $outcome['PayoutAmerican'] ?? null;

            if ($american === null || ! is_numeric($american)) {
                continue;
            }

            $label = ucfirst(strtolower((string) ($outcome['BettingOutcomeType'] ?? 'Outcome')));
            $grouped[$label][$book] = [
                'american' => $this->formatAmericanOdds((int) $american),
                'decimal' => $this->americanToDecimal((int) $american),
                'best' => false,
            ];
        }

        return collect($grouped)
            ->map(function (array $odds, string $label) {
                if ($odds !== []) {
                    $bestBook = collect($odds)->sortByDesc('decimal')->keys()->first();
                    $odds[$bestBook]['best'] = true;
                }

                return [
                    'label' => $label,
                    'odds' => $odds,
                ];
            })
            ->sortBy(fn (array $row) => $row['label'] === 'Yes' ? 0 : 1)
            ->values()
            ->all();
    }

    /**
     * @param  array<string, mixed>  $market
     * @param  list<string>  $sportsbooks
     * @return list<array{name: string, odds: array<string, array{american: string, decimal: float, best: bool}>}>
     */
    private function buildPlayerPropRows(array $market, array $sportsbooks, ?int $limit = null): array
    {
        $limit = max(1, $limit ?? (int) config('sportsdata.props.player_limit', 20));
        $grouped = [];

        foreach ($market['BettingOutcomes'] ?? [] as $outcome) {
            if (! is_array($outcome)) {
                continue;
            }

            $name = trim((string) ($outcome['Participant'] ?? $market['PlayerName'] ?? ''));

            if ($name === '') {
                continue;
            }

            $book = $this->normalizePropsSportsbook(
                (string) ($outcome['SportsBook']['Name'] ?? $outcome['SportsBook']['Sportsbook'] ?? '')
            );

            if ($book === null) {
                continue;
            }

            $american = $outcome['PayoutAmerican'] ?? null;

            if ($american === null || ! is_numeric($american)) {
                continue;
            }

            $grouped[$name][$book] = [
                'american' => $this->formatAmericanOdds((int) $american),
                'decimal' => $this->americanToDecimal((int) $american),
                'best' => false,
            ];
        }

        return collect($grouped)
            ->map(function (array $odds, string $name) {
                if ($odds !== []) {
                    // Highlight best payout for the bettor (longest price).
                    $bestBook = collect($odds)->sortByDesc('decimal')->keys()->first();
                    $odds[$bestBook]['best'] = true;
                }

                $hasConsensus = isset($odds['Consensus']['decimal']);
                $fallbackDecimal = $odds === []
                    ? PHP_FLOAT_MAX
                    : (float) min(array_column($odds, 'decimal'));

                return [
                    'name' => $name,
                    'odds' => $odds,
                    // Favorites first: Consensus ASC, then players missing Consensus by shortest book price.
                    'sort_group' => $hasConsensus ? 0 : 1,
                    'sort_decimal' => $hasConsensus
                        ? (float) $odds['Consensus']['decimal']
                        : $fallbackDecimal,
                ];
            })
            ->sortBy([
                ['sort_group', 'asc'],
                ['sort_decimal', 'asc'],
                ['name', 'asc'],
            ])
            ->take($limit)
            ->map(function (array $player) {
                unset($player['sort_group'], $player['sort_decimal']);

                return $player;
            })
            ->values()
            ->all();
    }

    private function normalizePropsSportsbook(string $name): ?string
    {
        if (strtolower(trim($name)) === 'consensus') {
            return 'Consensus';
        }

        return $this->normalizeSportsbook($name);
    }

    private function fetchOddsFromBettingMarkets(int $tournamentId): Collection
    {
        try {
            $markets = $this->request($this->oddsUrl("BettingMarketsByTournamentID/{$tournamentId}"));
        } catch (RuntimeException) {
            return collect();
        }

        if (! is_array($markets)) {
            return collect();
        }

        $rows = collect();

        foreach ($markets as $market) {
            if (! is_array($market)) {
                continue;
            }

            $betType = strtolower((string) ($market['BettingBetType'] ?? ''));
            $period = strtolower((string) ($market['BettingPeriodType'] ?? ''));

            if (! str_contains($betType, 'tournament winner') && ! str_contains($betType, 'outright')) {
                continue;
            }

            if ($period !== '' && $period !== 'tournament') {
                continue;
            }

            foreach ($market['BettingOutcomes'] ?? [] as $outcome) {
                if (! is_array($outcome)) {
                    continue;
                }

                $american = $outcome['PayoutAmerican'] ?? null;

                if ($american === null) {
                    continue;
                }

                $sportsbook = $outcome['SportsBook']['Name'] ?? $outcome['SportsBook']['Sportsbook'] ?? null;

                $rows->push([
                    'PlayerId' => $outcome['PlayerID'] ?? null,
                    'Name' => $outcome['Participant'] ?? $market['PlayerName'] ?? 'Unknown',
                    'SportbookName' => $sportsbook,
                    'OddsToWin' => (int) $american,
                    'IsAvailable' => $outcome['IsAvailable'] ?? true,
                ]);
            }
        }

        return $rows;
    }

    /**
     * @return array<int, array{player_id: int, name: string, rank: ?int, to_par: ?string, through: ?int, label: ?string}>
     */
    private function fetchLeaderboardScores(int $tournamentId, bool $inProgress): array
    {
        $ttl = $inProgress
            ? config('sportsdata.cache.scores_ttl')
            : config('sportsdata.cache.scores_ttl_idle');

        $payload = Cache::remember(
            "sportsdata:leaderboard:{$tournamentId}",
            $ttl,
            function () use ($tournamentId) {
                try {
                    return $this->request($this->golfUrl("Leaderboard/{$tournamentId}"));
                } catch (\Throwable) {
                    return [];
                }
            }
        );

        $scores = [];

        foreach ($payload['Players'] ?? [] as $player) {
            if (! is_array($player)) {
                continue;
            }

            $playerId = (int) ($player['PlayerID'] ?? 0);

            if ($playerId === 0) {
                continue;
            }

            $rank = $player['Rank'] ?? null;
            $totalScore = $player['TotalScore'] ?? null;
            $through = $player['TotalThrough'] ?? null;

            if ($rank === null && $totalScore === null) {
                continue;
            }

            $scores[$playerId] = [
                'player_id' => $playerId,
                'name' => (string) ($player['Name'] ?? 'Unknown'),
                'rank' => is_numeric($rank) ? (int) $rank : null,
                'to_par' => $this->formatScoreToPar($totalScore),
                'through' => is_numeric($through) ? (int) $through : null,
                'label' => $this->formatScoreLabel($rank, $totalScore, $through),
            ];
        }

        return $scores;
    }

    /**
     * @param  array<int, array{player_id: int, name: string, rank: ?int, to_par: ?string, through: ?int, label: ?string}>  $leaderboard
     * @param  Collection<int, array<string, mixed>>  $oddsRows
     * @param  array<string, mixed>  $tournament
     * @return list<array{player_id: int, name: string, subtitle: string, score: ?array{rank: ?int, to_par: ?string, through: ?int, label: ?string}, odds: array<string, array{american: string, decimal: float, best: bool}>}>
     */
    private function buildLiveScoreRows(
        array $leaderboard,
        Collection $oddsRows,
        array $tournament,
        bool $applyBestValueMarks = true
    ): array {
        $oddsByPlayer = $this->groupOddsByPlayer($oddsRows);
        $tournamentName = (string) ($tournament['Name'] ?? 'PGA Tour');
        $limit = (int) config('sportsdata.odds.player_limit', 10);

        $players = collect($leaderboard)
            ->map(function (array $entry) use ($oddsByPlayer, $tournamentName) {
                $playerId = $entry['player_id'];
                $odds = $oddsByPlayer[$playerId] ?? [];

                return [
                    'player_id' => $playerId,
                    'name' => $entry['name'],
                    'subtitle' => $tournamentName,
                    'score' => [
                        'rank' => $entry['rank'],
                        'to_par' => $entry['to_par'],
                        'through' => $entry['through'],
                        'label' => $entry['label'],
                    ],
                    'odds' => $odds,
                ];
            })
            ->filter(fn (array $player) => $player['score']['label'] !== null || $player['odds'] !== [])
            ->sortBy(fn (array $player) => $player['score']['rank'] ?? PHP_INT_MAX)
            ->values()
            ->all();

        if (! $applyBestValueMarks) {
            return $players;
        }

        return array_slice(
            $this->applyBestValueMarks($players),
            0,
            $limit
        );
    }

    /**
     * @param  Collection<int, array<string, mixed>>  $oddsRows
     * @param  array<string, mixed>  $tournament
     * @param  array<int, array{player_id: int, name: string, rank: ?int, to_par: ?string, through: ?int, label: ?string}>  $leaderboard
     * @return list<array{player_id: int, name: string, subtitle: string, score: ?array{rank: ?int, to_par: ?string, through: ?int, label: ?string}, odds: array<string, array{american: string, decimal: float, best: bool}>}>
     */
    private function buildPlayerRows(
        Collection $oddsRows,
        array $tournament,
        array $leaderboard = [],
        bool $applyBestValueMarks = true
    ): array {
        $sportsbookMap = config('sportsdata.sportsbooks', []);
        $tournamentName = (string) ($tournament['Name'] ?? 'PGA Tour');

        $grouped = $oddsRows
            ->map(function (array $row) {
                $book = $this->normalizeSportsbook(
                    (string) ($row['SportbookName'] ?? $row['SportsBook']['Name'] ?? '')
                );

                if ($book === null) {
                    return null;
                }

                $american = (int) ($row['OddsToWin'] ?? $row['PayoutAmerican'] ?? 0);

                if ($american === 0) {
                    return null;
                }

                return [
                    'player_id' => (int) ($row['PlayerId'] ?? $row['PlayerID'] ?? 0),
                    'name' => (string) ($row['Name'] ?? 'Unknown'),
                    'book' => $book,
                    'american' => $american,
                    'decimal' => $this->americanToDecimal($american),
                ];
            })
            ->filter()
            ->groupBy('player_id');

        $players = $grouped
            ->map(function (Collection $entries, int|string $playerId) use ($sportsbookMap, $tournamentName, $leaderboard) {
                $name = (string) $entries->first()['name'];
                $odds = [];

                foreach (array_keys($sportsbookMap) as $book) {
                    $match = $entries->firstWhere('book', $book);

                    if ($match === null) {
                        continue;
                    }

                    $odds[$book] = [
                        'american' => $this->formatAmericanOdds($match['american']),
                        'decimal' => $match['decimal'],
                        'best' => false,
                    ];
                }

                if ($odds !== []) {
                    $bestBook = collect($odds)->sortByDesc('decimal')->keys()->first();
                    $odds[$bestBook]['best'] = true;
                }

                if ($odds === []) {
                    return null;
                }

                $score = $leaderboard[$playerId] ?? null;

                return [
                    'player_id' => (int) $playerId,
                    'name' => $name,
                    'subtitle' => $tournamentName,
                    'score' => $score ? [
                        'rank' => $score['rank'],
                        'to_par' => $score['to_par'],
                        'through' => $score['through'],
                        'label' => $score['label'],
                    ] : null,
                    'odds' => $odds,
                ];
            })
            ->filter()
            ->sort(function (array $a, array $b) {
                $aBest = $this->playerBestDecimal($a['odds'] ?? []);
                $bBest = $this->playerBestDecimal($b['odds'] ?? []);

                return $aBest <=> $bBest;
            })
            ->values()
            ->all();

        if (! $applyBestValueMarks) {
            return $players;
        }

        return array_slice(
            $this->applyBestValueMarks($players),
            0,
            (int) config('sportsdata.odds.player_limit', 10)
        );
    }

    /**
     * FanDuel / BetMGM Best Value board: only show players at or above the marks,
     * and display only +2800, +3000, +3300 (rotated). Odds below those are excluded.
     *
     * @param  list<array{odds: array<string, array{american: string, decimal: float, best: bool}>}>  $players
     * @return list<array{odds: array<string, array{american: string, decimal: float, best: bool}>}>
     */
    private function applyBestValueMarks(array $players): array
    {
        $marks = array_values(array_map(
            'intval',
            config('sportsdata.odds.best_value_american', [2800, 3000, 3300])
        ));

        if ($marks === []) {
            return $players;
        }

        $minMark = min($marks);
        $cursor = 0;
        $filtered = [];

        foreach ($players as $player) {
            $hasBestValueBook = false;

            foreach (['FanDuel', 'BetMGM'] as $book) {
                if (! isset($player['odds'][$book]['american'])) {
                    continue;
                }

                $american = (int) str_replace('+', '', (string) $player['odds'][$book]['american']);

                if ($american >= $minMark) {
                    $hasBestValueBook = true;
                    break;
                }
            }

            if (! $hasBestValueBook) {
                continue;
            }

            foreach (['FanDuel', 'BetMGM'] as $book) {
                if (! isset($player['odds'][$book]['american'])) {
                    continue;
                }

                $american = (int) str_replace('+', '', (string) $player['odds'][$book]['american']);

                if ($american < $minMark) {
                    unset($player['odds'][$book]);

                    continue;
                }

                $mark = $marks[$cursor % count($marks)];
                $cursor++;

                $player['odds'][$book] = [
                    'american' => $this->formatAmericanOdds($mark),
                    'best' => true,
                    'decimal' => $this->americanToDecimal($mark),
                ];
            }

            if ($player['odds'] === []) {
                continue;
            }

            $filtered[] = $player;
        }

        return $filtered;
    }

    /**
     * @param  array<string, array{american: string, decimal: float, best: bool}>  $odds
     */
    private function playerBestDecimal(array $odds): float
    {
        $decimals = array_column($odds, 'decimal');

        return $decimals === [] ? PHP_FLOAT_MAX : (float) min($decimals);
    }

    /**
     * @param  Collection<int, array<string, mixed>>  $oddsRows
     * @return array<int, array<string, array{american: string, decimal: float, best: bool}>>
     */
    private function groupOddsByPlayer(Collection $oddsRows): array
    {
        $sportsbookMap = config('sportsdata.sportsbooks', []);
        $grouped = [];

        foreach ($oddsRows as $row) {
            $book = $this->normalizeSportsbook(
                (string) ($row['SportbookName'] ?? $row['SportsBook']['Name'] ?? '')
            );

            if ($book === null) {
                continue;
            }

            $american = (int) ($row['OddsToWin'] ?? $row['PayoutAmerican'] ?? 0);
            $playerId = (int) ($row['PlayerId'] ?? $row['PlayerID'] ?? 0);

            if ($american === 0 || $playerId === 0) {
                continue;
            }

            $grouped[$playerId][$book] = [
                'american' => $this->formatAmericanOdds($american),
                'decimal' => $this->americanToDecimal($american),
                'best' => false,
            ];
        }

        return $grouped;
    }

    private function isBestValueOdds(int $american): bool
    {
        $marks = config('sportsdata.odds.best_value_american', [2800, 3000, 3300]);

        return in_array($american, array_map('intval', $marks), true);
    }

    private function formatScoreToPar(mixed $totalScore): ?string
    {
        if ($totalScore === null || $totalScore === '') {
            return null;
        }

        $value = (float) $totalScore;

        if ($value === 0.0) {
            return 'E';
        }

        if ($value > 0) {
            return '+' . (int) $value;
        }

        return (string) (int) $value;
    }

    private function formatScoreLabel(mixed $rank, mixed $totalScore, mixed $through): ?string
    {
        $toPar = $this->formatScoreToPar($totalScore);

        if ($toPar === null) {
            return null;
        }

        $parts = [];

        if (is_numeric($rank)) {
            $parts[] = 'T' . (int) $rank;
        }

        $parts[] = $toPar;

        if (is_numeric($through) && (int) $through > 0) {
            $parts[] = ((int) $through >= 18) ? 'F' : 'thru ' . (int) $through;
        }

        return implode(' · ', $parts);
    }

    private function refreshSeconds(bool $isLive): int
    {
        return $isLive
            ? (int) config('sportsdata.odds.live_refresh_seconds')
            : (int) config('sportsdata.odds.refresh_seconds');
    }

    /**
     * @param  array<string, mixed>  $tournament
     * @return array{id: int, name: string, start_date: ?string, end_date: ?string, is_in_progress: bool, venue: string, location: string, city: string, state: string}
     */
    private function formatTournament(array $tournament): array
    {
        return [
            'id' => (int) $tournament['TournamentID'],
            'name' => (string) ($tournament['Name'] ?? 'PGA Tour'),
            'start_date' => isset($tournament['StartDate']) ? substr((string) $tournament['StartDate'], 0, 10) : null,
            'end_date' => isset($tournament['EndDate']) ? substr((string) $tournament['EndDate'], 0, 10) : null,
            'is_in_progress' => (bool) ($tournament['IsInProgress'] ?? false),
            'venue' => (string) ($tournament['Venue'] ?? ''),
            'location' => (string) ($tournament['Location'] ?? ''),
            'city' => (string) ($tournament['City'] ?? ''),
            'state' => (string) ($tournament['State'] ?? ''),
        ];
    }

    /**
     * @return array{location: string, venue: string, temperature: int, condition: string, icon: string, wind_mph: int, humidity: ?int}|null
     */
    private function fetchTournamentWeather(array $tournament): ?array
    {
        $searchQuery = $this->weatherSearchQuery($tournament);

        if ($searchQuery === null) {
            return null;
        }

        return Cache::remember(
            'sportsdata:weather:' . md5($searchQuery),
            1800,
            function () use ($searchQuery, $tournament) {
                try {
                    $geoResponse = Http::timeout(10)->get('https://geocoding-api.open-meteo.com/v1/search', array_filter([
                        'name' => $searchQuery,
                        'count' => 1,
                        'language' => 'en',
                        'format' => 'json',
                        'country_code' => strtoupper((string) ($tournament['Country'] ?? '')) === 'USA' ? 'US' : null,
                    ]));

                    if (! $geoResponse->successful()) {
                        return null;
                    }

                    $result = $geoResponse->json('results.0');

                    if (! is_array($result)) {
                        return null;
                    }

                    $forecastResponse = Http::timeout(10)->get('https://api.open-meteo.com/v1/forecast', [
                        'latitude' => $result['latitude'],
                        'longitude' => $result['longitude'],
                        'current' => 'temperature_2m,weather_code,wind_speed_10m,relative_humidity_2m',
                        'temperature_unit' => 'fahrenheit',
                        'wind_speed_unit' => 'mph',
                        'timezone' => 'auto',
                    ]);

                    if (! $forecastResponse->successful()) {
                        return null;
                    }

                    $current = $forecastResponse->json('current');

                    if (! is_array($current)) {
                        return null;
                    }

                    $condition = $this->weatherConditionFromCode((int) ($current['weather_code'] ?? 0));

                    return [
                        'location' => (string) ($tournament['Location'] ?: ($result['name'] ?? $searchQuery)),
                        'venue' => (string) ($tournament['Venue'] ?? ''),
                        'temperature' => (int) round((float) ($current['temperature_2m'] ?? 0)),
                        'condition' => $condition['label'],
                        'icon' => $condition['icon'],
                        'wind_mph' => (int) round((float) ($current['wind_speed_10m'] ?? 0)),
                        'humidity' => isset($current['relative_humidity_2m'])
                            ? (int) $current['relative_humidity_2m']
                            : null,
                    ];
                } catch (\Throwable $exception) {
                    Log::warning('Tournament weather lookup failed', ['message' => $exception->getMessage()]);

                    return null;
                }
            }
        );
    }

    private function weatherSearchQuery(array $tournament): ?string
    {
        $city = trim((string) ($tournament['City'] ?? ''));

        if ($city !== '') {
            return $city;
        }

        $location = trim((string) ($tournament['Location'] ?? ''));

        if ($location === '') {
            return null;
        }

        $parts = array_map('trim', explode(',', $location));

        return $parts[0] !== '' ? $parts[0] : $location;
    }

    /**
     * @return array{label: string, icon: string}
     */
    private function weatherConditionFromCode(int $code): array
    {
        return match (true) {
            $code === 0 => ['label' => 'Clear', 'icon' => 'clear'],
            in_array($code, [1, 2, 3], true) => ['label' => 'Partly Cloudy', 'icon' => 'partly-cloudy'],
            in_array($code, [45, 48], true) => ['label' => 'Foggy', 'icon' => 'fog'],
            in_array($code, [51, 53, 55, 56, 57, 61, 63, 65, 66, 67, 80, 81, 82], true) => ['label' => 'Rain', 'icon' => 'rain'],
            in_array($code, [71, 73, 75, 77, 85, 86], true) => ['label' => 'Snow', 'icon' => 'snow'],
            in_array($code, [95, 96, 99], true) => ['label' => 'Thunderstorm', 'icon' => 'storm'],
            default => ['label' => 'Cloudy', 'icon' => 'cloudy'],
        };
    }

    private function normalizeSportsbook(string $name): ?string
    {
        $needle = strtolower(trim($name));

        if ($needle === '' || $needle === 'consensus') {
            return null;
        }

        foreach (config('sportsdata.sportsbooks', []) as $canonical => $aliases) {
            foreach ($aliases as $alias) {
                if ($needle === strtolower($alias)) {
                    return $canonical;
                }
            }
        }

        return null;
    }

    /**
     * Keep only sportsbook columns that currently have at least one odds value.
     *
     * @param  list<array{odds?: array<string, mixed>}>  $players
     * @param  list<string>  $configured
     * @return list<string>
     */
    private function sportsbooksPresentInPlayers(array $players, array $configured): array
    {
        $present = [];

        foreach ($configured as $book) {
            foreach ($players as $player) {
                if (! empty($player['odds'][$book]['american'] ?? null)) {
                    $present[] = $book;
                    break;
                }
            }
        }

        return $present;
    }

    /**
     * @param  list<array{type?: string, players?: list<array{odds?: array<string, mixed>}>, outcomes?: list<array{odds?: array<string, mixed>}>}>  $brackets
     * @param  list<string>  $configured
     * @return list<string>
     */
    private function sportsbooksPresentInPropBrackets(array $brackets, array $configured): array
    {
        $rows = [];

        foreach ($brackets as $bracket) {
            foreach ($bracket['players'] ?? [] as $player) {
                $rows[] = $player;
            }

            foreach ($bracket['outcomes'] ?? [] as $outcome) {
                $rows[] = $outcome;
            }
        }

        $present = $this->sportsbooksPresentInPlayers($rows, $configured);

        return $present !== [] ? $present : $configured;
    }

    private function americanToDecimal(int $american): float
    {
        if ($american > 0) {
            return round(1 + ($american / 100), 4);
        }

        if ($american < 0) {
            return round(1 + (100 / abs($american)), 4);
        }

        return 0.0;
    }

    private function formatAmericanOdds(int $american): string
    {
        return $american > 0 ? '+' . $american : (string) $american;
    }

    /**
     * @return array<string, mixed>|list<mixed>
     */
    private function getJson(string $url, int $ttl, string $cacheKey): array
    {
        return Cache::remember($cacheKey, $ttl, fn () => $this->request($url));
    }

    /**
     * @return array<string, mixed>|list<mixed>
     */
    private function request(string $url): array
    {
        $apiKey = config('sportsdata.api_key');

        if (empty($apiKey)) {
            throw new RuntimeException('SportsDataIO API key is not configured.');
        }

        $response = Http::timeout(45)
            ->withHeaders([self::HEADER => $apiKey])
            ->get($url);

        if ($response->status() === 401) {
            $message = $response->json('Description') ?? 'SportsDataIO API access denied.';

            throw new RuntimeException($message);
        }

        if (! $response->successful()) {
            throw new RuntimeException('SportsDataIO request failed with status ' . $response->status() . '.');
        }

        $json = $response->json();

        return is_array($json) ? $json : [];
    }

    private function golfUrl(string $path): string
    {
        return rtrim((string) config('sportsdata.base_urls.golf'), '/') . '/' . ltrim($path, '/');
    }

    private function oddsUrl(string $path): string
    {
        return rtrim((string) config('sportsdata.base_urls.odds'), '/') . '/' . ltrim($path, '/');
    }
}
