<?php

namespace App\Support;

class HomepageDefaults
{
    public static function all(): array
    {
        return [
            'hero' => [
                'headline_html' => '<span>Golf Betting</span> <span class="gold">Made Simple.</span> <span>Expert Picks & Exclusive Deals.</span>',
                'subtitle' => 'All your favourite sportsbooks, insider tips, and tournament updates in one place.',
                'image_url' => 'https://images.unsplash.com/photo-1535131749006-b7f58c99034b?auto=format&fit=crop&w=1920&q=85',
                'cta_primary' => ['label' => 'View Best Picks', 'url' => '#best-picks'],
                'cta_secondary' => ['label' => 'Sign Up & Get Bonuses', 'url' => 'https://www.anrdoezrs.net/click-101764042-17337458'],
                'disclaimer' => '21+ only. Gambling problem? Call 1-800-GAMBLER',
            ],
            'header_ctas' => [
                'primary' => ['label' => 'Get Insider Picks', 'url' => '#premium'],
                'secondary' => ['label' => 'Claim Bonus', 'url' => 'https://www.anrdoezrs.net/click-101764042-17337458'],
            ],
            'affiliate_banner' => [
                'enabled' => true,
                'brand_name' => 'BetMGM',
                'title' => 'BetMGM First Bet Offer: $1500 Paid Back in Bonus Bets, if You Don\'t Win*',
                'description' => '*Bonus Bets expire in 7 days. One New Customer Offer Only. Add\'l terms. Live in All States (minus NV, PR, NY).',
                'cta_label' => 'Claim Offer',
                'cta_url' => 'https://www.anrdoezrs.net/click-101764042-17337458',
                'pixel_url' => 'https://www.ftjcfx.com/image-101764042-17337458',
                'placements' => [
                    'after_strategy' => true,
                    'after_picks' => true,
                    'after_rankings' => true,
                    'after_odds' => true,
                    'after_guides' => true,
                ],
            ],
            'sections' => [
                'promos' => [
                    'eyebrow' => 'Partner Offers',
                    'title' => 'Exclusive Sign-Up Bonuses',
                    'subtitle' => 'Verified offers updated weekly. All bonuses for new users only. Must be 21+.',
                ],
                'faq' => [
                    'eyebrow' => 'Got Questions?',
                    'title' => 'Frequently Asked Questions',
                ],
            ],
            'premium' => [
                'title_html' => 'Unlock <span class="gold">Insider</span> Information',
                'subtitle' => 'Get exclusive weekly picks, deep analysis, and bonus alerts delivered straight to your inbox.',
                'price' => '9.99',
                'price_unit' => '/month',
                'features' => [
                    'Weekly expert picks every Tuesday',
                    'Deep tournament analysis & projections',
                    'Exclusive sportsbook bonus alerts',
                ],
                'form_title_html' => 'Start Your <span class="gold">Free Trial</span>',
                'form_note' => '7 days free, then $9.99/month. Cancel anytime.',
            ],
            'testimonials' => [
                ['quote' => 'Hit three of their top five picks last week. Completely changed how I approach betting.', 'author' => 'Marcus T.', 'stars' => 5],
                ['quote' => 'The DraftKings bonus alone paid for six months. Their odds table saves me hours weekly.', 'author' => 'Sarah K.', 'stars' => 5],
                ['quote' => 'Finally a golf betting site that goes beyond basic picks. I\'ve recommended it to everyone.', 'author' => 'Derek W.', 'stars' => 5],
            ],
        ];
    }

    public static function parseHighlightedHtml(?string $html): array
    {
        $html = trim((string) $html);

        if ($html !== '' && preg_match('/^(.*?)<span[^>]*class="[^"]*\bgold\b[^"]*"[^>]*>(.*?)<\/span>(.*)$/is', $html, $matches)) {
            return [
                'before' => self::plainText($matches[1]),
                'highlight' => self::plainText($matches[2]),
                'after' => self::plainText($matches[3]),
            ];
        }

        return [
            'before' => self::plainText($html),
            'highlight' => '',
            'after' => '',
        ];
    }

    public static function buildHighlightedHtml(string $before, string $highlight, string $after): string
    {
        $parts = [];

        foreach ([
            ['text' => trim($before), 'class' => null],
            ['text' => trim($highlight), 'class' => 'gold'],
            ['text' => trim($after), 'class' => null],
        ] as $part) {
            if ($part['text'] === '') {
                continue;
            }

            $class = $part['class'] ? ' class="'.$part['class'].'"' : '';
            $parts[] = '<span'.$class.'>'.e($part['text']).'</span>';
        }

        return implode(' ', $parts);
    }

    public const BANNER_PLACEMENTS = [
        'after_strategy' => 'After Strategy / latest stories',
        'after_picks' => 'After Best Picks',
        'after_rankings' => 'Inside Rankings (before schedule)',
        'after_odds' => 'After Live Odds',
        'after_guides' => 'After Golf Betting guides',
    ];

    public static function bannerVisible(array $homepage, string $placement): bool
    {
        $banner = $homepage['affiliate_banner'] ?? [];

        if (empty($banner['enabled'])) {
            return false;
        }

        return ! empty($banner['placements'][$placement]);
    }

    private static function plainText(string $value): string
    {
        return trim(html_entity_decode(strip_tags($value), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    }
}
