<?php

namespace App\Support;

use App\Models\ContentPage;

class AffiliateBannerPlacements
{
    public const HOME = [
        'home.after_strategy' => 'After Strategy / latest stories',
        'home.after_picks' => 'After Best Picks',
        'home.after_rankings' => 'Inside Rankings (before schedule)',
        'home.after_odds' => 'After Live Odds',
        'home.after_guides' => 'After Golf Betting guides',
    ];

    public const DETAIL = [
        'tips.after_content' => 'All tip articles',
        'blogs.after_content' => 'All blog articles',
        'stories.after_content' => 'All stories',
        'news.after_content' => 'All news articles',
    ];

    public static function contentPageKey(int $id): string
    {
        return 'content_page.'.$id.'.after_content';
    }

    public static function groups(): array
    {
        $pages = ContentPage::query()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get()
            ->mapWithKeys(fn (ContentPage $page) => [
                self::contentPageKey($page->id) => $page->title,
            ])
            ->all();

        return [
            'Homepage' => self::HOME,
            'Content Pages' => $pages,
            'Detail Pages' => self::DETAIL,
        ];
    }

    public static function keys(): array
    {
        return array_keys(array_merge(...array_values(self::groups())));
    }

    public static function fromLegacy(array $placements): array
    {
        $keys = [];

        foreach (array_keys(self::HOME) as $key) {
            $legacy = str_replace('home.', '', $key);

            if (! empty($placements[$legacy])) {
                $keys[] = $key;
            }
        }

        return $keys;
    }

    public static function labelsFor(array $keys): array
    {
        $catalog = [];

        foreach (self::groups() as $options) {
            $catalog = array_merge($catalog, $options);
        }

        return collect($keys)
            ->map(fn (string $key) => $catalog[$key] ?? $key)
            ->all();
    }
}
