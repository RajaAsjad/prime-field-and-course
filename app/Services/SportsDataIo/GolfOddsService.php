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
            'sportsbooks' => $sportsbooks,
            'players' => [],
            'is_live' => false,
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
            $tournamentId = (int) $tournament['TournamentID'];
            $isLive = (bool) ($tournament['IsInProgress'] ?? false);
            $leaderboard = $this->fetchLeaderboardScores($tournamentId, $isLive);

            try {
                $oddsRows = $this->fetchTournamentOdds($tournamentId, $isLive);
            } catch (RuntimeException $exception) {
                Log::warning('SportsDataIO golf odds unavailable', ['message' => $exception->getMessage()]);

                return [
                    'tournament' => $formattedTournament,
                    'sportsbooks' => $sportsbooks,
                    'players' => $this->buildLiveScoreRows($leaderboard, collect(), $tournament),
                    'is_live' => $isLive,
                    'refresh_seconds' => $this->refreshSeconds($isLive),
                    'updated_at' => now()->toIso8601String(),
                    'error' => $this->friendlyOddsError($exception->getMessage()),
                ];
            }

            if ($oddsRows->isEmpty() && $leaderboard === []) {
                return [
                    'tournament' => $formattedTournament,
                    'sportsbooks' => $sportsbooks,
                    'players' => [],
                    'is_live' => $isLive,
                    'refresh_seconds' => $this->refreshSeconds($isLive),
                    'updated_at' => now()->toIso8601String(),
                    'error' => 'Live odds are not available yet for this tournament.',
                ];
            }

            $players = $isLive && $leaderboard !== []
                ? $this->buildLiveScoreRows($leaderboard, $oddsRows, $tournament)
                : $this->buildPlayerRows($oddsRows, $tournament, $leaderboard);

            return [
                'tournament' => $formattedTournament,
                'sportsbooks' => $sportsbooks,
                'players' => $players,
                'is_live' => $isLive,
                'refresh_seconds' => $this->refreshSeconds($isLive),
                'updated_at' => now()->toIso8601String(),
                'error' => null,
            ];
        } catch (\Throwable $exception) {
            Log::error('SportsDataIO golf odds failed', ['message' => $exception->getMessage()]);

            return [
                ...$empty,
                'error' => 'Unable to load live odds right now. Please try again shortly.',
            ];
        }
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
    private function buildLiveScoreRows(array $leaderboard, Collection $oddsRows, array $tournament): array
    {
        $oddsByPlayer = $this->groupOddsByPlayer($oddsRows);
        $tournamentName = (string) ($tournament['Name'] ?? 'PGA Tour');
        $limit = config('sportsdata.odds.player_limit');

        return collect($leaderboard)
            ->sortBy(fn (array $entry) => $entry['rank'] ?? PHP_INT_MAX)
            ->take($limit)
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
            ->values()
            ->all();
    }

    /**
     * @param  Collection<int, array<string, mixed>>  $oddsRows
     * @param  array<string, mixed>  $tournament
     * @param  array<int, array{player_id: int, name: string, rank: ?int, to_par: ?string, through: ?int, label: ?string}>  $leaderboard
     * @return list<array{player_id: int, name: string, subtitle: string, score: ?array{rank: ?int, to_par: ?string, through: ?int, label: ?string}, odds: array<string, array{american: string, decimal: float, best: bool}>}>
     */
    private function buildPlayerRows(Collection $oddsRows, array $tournament, array $leaderboard = []): array
    {
        $sportsbookMap = config('sportsdata.sportsbooks', []);
        $tournamentName = (string) ($tournament['Name'] ?? 'PGA Tour');

        $grouped = $oddsRows
            ->map(function (array $row) use ($sportsbookMap) {
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

                if ($odds === []) {
                    return null;
                }

                $bestBook = collect($odds)->sortByDesc('decimal')->keys()->first();
                $odds[$bestBook]['best'] = true;

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
                    'sort_decimal' => min(array_column($odds, 'decimal')),
                ];
            })
            ->filter()
            ->sortBy('sort_decimal')
            ->take(config('sportsdata.odds.player_limit'))
            ->values()
            ->map(function (array $player) {
                unset($player['sort_decimal']);

                return $player;
            })
            ->all();

        return $players;
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

        foreach ($grouped as $playerId => $odds) {
            if ($odds === []) {
                continue;
            }

            $bestBook = collect($odds)->sortByDesc('decimal')->keys()->first();
            $grouped[$playerId][$bestBook]['best'] = true;
        }

        return $grouped;
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
     * @return array{id: int, name: string, start_date: ?string, end_date: ?string, is_in_progress: bool}
     */
    private function formatTournament(array $tournament): array
    {
        return [
            'id' => (int) $tournament['TournamentID'],
            'name' => (string) ($tournament['Name'] ?? 'PGA Tour'),
            'start_date' => isset($tournament['StartDate']) ? substr((string) $tournament['StartDate'], 0, 10) : null,
            'end_date' => isset($tournament['EndDate']) ? substr((string) $tournament['EndDate'], 0, 10) : null,
            'is_in_progress' => (bool) ($tournament['IsInProgress'] ?? false),
        ];
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

        $response = Http::timeout(20)
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
