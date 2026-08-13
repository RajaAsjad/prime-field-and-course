<?php

namespace App\Services\FieldLevelMedia;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RuntimeException;

class FlmContentService
{
    /**
     * @return array{
     *     items: list<array<string, mixed>>,
     *     refresh_seconds: int,
     *     updated_at: string,
     *     error: ?string
     * }
     */
    public function getFeed(): array
    {
        $refreshSeconds = (int) config('flm.cache.stories_ttl', 300);

        try {
            $items = $this->getStories();

            return [
                'items' => $items,
                'refresh_seconds' => $refreshSeconds,
                'updated_at' => now()->toIso8601String(),
                'error' => $items === [] ? 'No Field Level Media stories available right now.' : null,
            ];
        } catch (\Throwable $exception) {
            Log::error('FLM golf stories failed', ['message' => $exception->getMessage()]);

            return [
                'items' => [],
                'refresh_seconds' => $refreshSeconds,
                'updated_at' => now()->toIso8601String(),
                'error' => 'Unable to load Field Level Media stories right now. Please try again shortly.',
            ];
        }
    }

    /**
     * @return list<array{
     *     id: int,
     *     title: string,
     *     excerpt: string,
     *     content: string,
     *     category: string,
     *     league: string,
     *     image: ?string,
     *     byline: string,
     *     updated_at: ?string,
     *     url: string
     * }>
     */
    public function getHomepageStories(): array
    {
        $limit = max(1, (int) config('flm.homepage_limit', 4));

        return array_slice($this->getStories(), 0, $limit);
    }

    /**
     * @return array{
     *     id: int,
     *     title: string,
     *     excerpt: string,
     *     content: string,
     *     category: string,
     *     league: string,
     *     image: ?string,
     *     byline: string,
     *     updated_at: ?string,
     *     url: string
     * }|null
     */
    public function getStory(int $storyId): ?array
    {
        if ($storyId <= 0) {
            return null;
        }

        try {
            foreach ($this->getStories() as $story) {
                if ($story['id'] === $storyId) {
                    return $story;
                }
            }
        } catch (\Throwable $exception) {
            Log::error('FLM golf story lookup failed', [
                'story_id' => $storyId,
                'message' => $exception->getMessage(),
            ]);
        }

        return null;
    }

    /**
     * @return list<array{
     *     id: int,
     *     title: string,
     *     excerpt: string,
     *     content: string,
     *     category: string,
     *     league: string,
     *     image: ?string,
     *     byline: string,
     *     updated_at: ?string,
     *     url: string
     * }>
     */
    public function getStories(): array
    {
        if (empty(config('flm.api_key'))) {
            return [];
        }

        $leagueKey = $this->leagueFilterKey();

        try {
            return Cache::remember(
                'flm:stories:'.$leagueKey,
                (int) config('flm.cache.stories_ttl', 300),
                fn () => $this->fetchAndFormatStories()
            );
        } catch (\Throwable $exception) {
            Log::error('FLM golf stories failed', ['message' => $exception->getMessage()]);

            throw $exception;
        }
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function fetchAndFormatStories(): array
    {
        $leagueIds = $this->golfLeagueIds();

        if ($leagueIds === []) {
            return [];
        }

        $token = $this->token();
        $baseUrl = rtrim((string) config('flm.base_url'), '/');

        $responses = Http::pool(function ($pool) use ($leagueIds, $token, $baseUrl) {
            foreach ($leagueIds as $leagueId) {
                $pool->as((string) $leagueId)
                    ->timeout(30)
                    ->withHeaders([
                        'Authorization' => 'Bearer '.$token,
                        'Content-Type' => 'application/x-www-form-urlencoded',
                        'Accept' => 'application/json',
                    ])
                    ->get($baseUrl.'/story/'.$leagueId);
            }
        });

        $rows = [];

        foreach ($responses as $response) {
            if (! $response instanceof \Illuminate\Http\Client\Response) {
                continue;
            }

            if ($response->status() === 401) {
                Cache::forget('flm:token');
                throw new RuntimeException('FLM authentication expired.');
            }

            if (! $response->successful()) {
                continue;
            }

            foreach ($this->decodeJson($response->json()) as $row) {
                if (is_array($row) && ! empty($row['storyId'])) {
                    $rows[] = $this->formatStory($row);
                }
            }
        }

        usort($rows, function (array $a, array $b) {
            return strcmp((string) ($b['updated_at'] ?? ''), (string) ($a['updated_at'] ?? ''));
        });

        $unique = [];

        foreach ($rows as $row) {
            $unique[$row['id']] = $row;
        }

        return array_values($unique);
    }

    /**
     * @param  array<string, mixed>  $row
     * @return array{
     *     id: int,
     *     title: string,
     *     excerpt: string,
     *     content: string,
     *     category: string,
     *     league: string,
     *     image: ?string,
     *     byline: string,
     *     updated_at: ?string,
     *     url: string
     * }
     */
    private function formatStory(array $row): array
    {
        $storyId = (int) ($row['storyId'] ?? 0);
        $content = trim((string) ($row['storyText'] ?? ''));
        $images = is_array($row['images'] ?? null) ? $row['images'] : [];
        $image = $images[0]['previewUrl'] ?? $images[0]['thumbUrl'] ?? null;
        $exported = $row['lastExportedDate'] ?? null;

        return [
            'id' => $storyId,
            'title' => (string) ($row['headline'] ?? ''),
            'excerpt' => Str::limit(preg_replace('/\s+/', ' ', $content) ?? '', 140),
            'content' => $content,
            'category' => (string) ($row['storyType'] ?? ($row['league']['shortName'] ?? 'Golf')),
            'league' => (string) ($row['league']['shortName'] ?? 'Golf'),
            'image' => is_string($image) && $image !== '' ? $image : null,
            'byline' => (string) ($row['byline'] ?? 'Field Level Media'),
            'updated_at' => is_string($exported) && $exported !== ''
                ? \Carbon\Carbon::parse($exported)->toIso8601String()
                : null,
            'url' => url('/stories/'.$storyId),
        ];
    }

    /**
     * @return list<string>
     */
    private function golfLeagueIds(): array
    {
        return Cache::remember(
            'flm:golf-league-ids:'.$this->leagueFilterKey(),
            (int) config('flm.cache.sports_ttl', 86400),
            function () {
                $sports = $this->getJson('sport');
                $wanted = $this->requestedLeagueShortNames();
                $ids = [];

                foreach ($sports as $sport) {
                    if (! is_array($sport) || strcasecmp((string) ($sport['name'] ?? ''), 'Golf') !== 0) {
                        continue;
                    }

                    foreach ($sport['leagues'] ?? [] as $league) {
                        if (! is_array($league)) {
                            continue;
                        }

                        $shortName = strtoupper((string) ($league['shortName'] ?? ''));
                        $leagueId = (string) ($league['leagueId'] ?? '');

                        if ($leagueId === '') {
                            continue;
                        }

                        if ($wanted === [] || in_array($shortName, $wanted, true)) {
                            $ids[] = $leagueId;
                        }
                    }
                }

                return array_values(array_unique($ids));
            }
        );
    }

    /**
     * @return list<string>
     */
    private function requestedLeagueShortNames(): array
    {
        $raw = trim((string) config('flm.leagues', ''));

        if ($raw === '') {
            return [];
        }

        return array_values(array_filter(array_map(
            fn (string $name) => strtoupper(trim($name)),
            explode(',', $raw)
        )));
    }

    private function leagueFilterKey(): string
    {
        $wanted = $this->requestedLeagueShortNames();

        return $wanted === [] ? 'golf-all' : strtolower(implode('-', $wanted));
    }

    /**
     * @return list<mixed>|array<string, mixed>
     */
    private function getJson(string $path, bool $retried = false): array
    {
        $response = Http::timeout(30)
            ->withHeaders([
                'Authorization' => 'Bearer '.$this->token(),
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json',
            ])
            ->get(rtrim((string) config('flm.base_url'), '/').'/'.$path);

        if ($response->status() === 401 && ! $retried) {
            Cache::forget('flm:token');

            return $this->getJson($path, true);
        }

        if (! $response->successful()) {
            throw new RuntimeException('FLM request failed with status '.$response->status().' for '.$path);
        }

        $json = $response->json();

        return $this->decodeJson($json);
    }

    /**
     * @param  mixed  $json
     * @return list<mixed>|array<string, mixed>
     */
    private function decodeJson(mixed $json): array
    {
        if (! is_array($json)) {
            return [];
        }

        if (array_key_exists('value', $json) && is_array($json['value'])) {
            return $json['value'];
        }

        return $json;
    }

    private function token(): string
    {
        $apiKey = (string) config('flm.api_key');

        if ($apiKey === '') {
            throw new RuntimeException('FLM API key is not configured.');
        }

        return Cache::remember(
            'flm:token',
            (int) config('flm.cache.token_ttl', 518400),
            function () use ($apiKey) {
                $response = Http::timeout(20)
                    ->asForm()
                    ->post(rtrim((string) config('flm.base_url'), '/').'/Token', [
                        'apiKey' => $apiKey,
                    ]);

                if (! $response->successful()) {
                    throw new RuntimeException('FLM authentication failed with status '.$response->status());
                }

                $token = (string) $response->json('token');

                if ($token === '') {
                    throw new RuntimeException('FLM authentication did not return a token.');
                }

                return $token;
            }
        );
    }
}
