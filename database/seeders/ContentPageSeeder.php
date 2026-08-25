<?php

namespace Database\Seeders;

use App\Models\ContentPage;
use Illuminate\Database\Seeder;

class ContentPageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = config('content_pages', []);

        $footerMap = [
            'how-to-bet-on-golf' => 'How to Bet on Golf',
            'best-golf-betting-apps' => 'Best Betting Apps',
            'golf-glossary' => 'Golf Glossary',
        ];

        foreach ($pages as $key => $page) {
            $content = match ($key) {
                'golf-glossary' => ['terms' => $page['terms'] ?? []],
                'best-golf-betting-apps' => [
                    'apps' => $page['apps'] ?? [],
                    'tips' => $page['tips'] ?? [],
                ],
                'how-to-bet-on-golf' => ['sections' => $page['sections'] ?? []],
                default => $page['content'] ?? [],
            };

            $type = match ($key) {
                'golf-glossary' => 'glossary',
                'best-golf-betting-apps' => 'apps',
                'how-to-bet-on-golf' => 'guide',
                default => 'generic',
            };

            ContentPage::query()->where('slug', 'like', str_replace('-', '-%', $key).'%')->delete();

            ContentPage::updateOrCreate(
                ['slug' => $page['slug'] ?? $key],
                [
                    'title' => $page['title'],
                    'subtitle' => $page['subtitle'] ?? null,
                    'meta_description' => $page['meta_description'] ?? null,
                    'eyebrow' => $page['eyebrow'] ?? null,
                    'intro' => $page['intro'] ?? null,
                    'type' => $type,
                    'content' => $content,
                    'is_published' => true,
                    'show_in_footer' => isset($footerMap[$key]),
                    'footer_label' => $footerMap[$key] ?? null,
                    'sort_order' => array_search($key, array_keys($pages), true) + 1,
                ]
            );
        }
    }
}
