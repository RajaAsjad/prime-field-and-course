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
            'sections' => [
                'strategy' => [
                    'eyebrow' => 'Expert Knowledge',
                    'title' => 'Expert Strategy &',
                    'title_em' => 'Tips',
                    'subtitle' => 'Latest golf coverage from Field Level Media — previews, recaps, and news.',
                ],
                'promos' => [
                    'eyebrow' => 'Partner Offers',
                    'title' => 'Exclusive',
                    'title_em' => 'Sign-Up Bonuses',
                    'subtitle' => 'Verified offers updated weekly. All bonuses for new users only. Must be 21+.',
                ],
                'best_picks' => [
                    'eyebrow' => 'Weekly Selections',
                    'title' => 'Top Picks',
                    'title_em' => 'This Week',
                    'subtitle' => 'Live SportsDataIO odds with confidence ratings for this week\'s top contenders.',
                ],
                'hot_props' => [
                    'eyebrow' => 'Odds & Sportsbooks',
                    'title' => "This Week's",
                    'title_em' => 'Hot Props',
                    'subtitle' => 'Consensus and sportsbook prop odds via SportsDataIO Sportsbook Group.',
                ],
                'competition_feeds' => [
                    'eyebrow' => 'Golf API Feeds',
                    'title' => 'Competition &',
                    'title_em' => 'Event Data',
                    'subtitle' => 'Live SportsDataIO Golf feeds unlocked on your subscription — rankings, players, venues, schedule, stats, props & news.',
                ],
                'live_odds' => [
                    'eyebrow' => 'Real-Time Data',
                    'title' => 'Compare',
                    'title_em' => 'Live Odds',
                    'subtitle' => 'Best available odds across top sportsbooks. Green highlights best value.',
                ],
                'rotoballer_news' => [
                    'eyebrow' => 'Player News',
                    'title' => 'Rotoballer',
                    'title_em' => 'News Feed',
                    'subtitle' => 'Latest PGA Tour player news and matchup outlooks from RotoBaller. Showing stories from the last 2 weeks.',
                ],
                'golf_betting' => [
                    'eyebrow' => 'Education Hub',
                    'title' => 'Learn & Bet',
                    'title_em' => 'Smarter',
                    'subtitle' => 'Guides, tactics, and video breakdowns to sharpen your game.',
                    'newsletter_eyebrow' => 'Free Newsletter',
                    'newsletter_title' => 'Unlock Insider Tips',
                    'newsletter_subtitle' => 'Weekly expert picks every Tuesday. Free forever.',
                    'newsletter_button' => "Subscribe — It's Free",
                    'guides' => [
                        ['icon' => '📖', 'title' => "Complete Beginner's Guide", 'meta' => 'Beginner · 15 min', 'url' => '#golf-betting'],
                        ['icon' => '🎯', 'title' => 'Types of Golf Bets Explained', 'meta' => 'Beginner · 8 min', 'url' => '#golf-betting'],
                        ['icon' => '📊', 'title' => 'Line Shopping: Find Best Odds', 'meta' => 'Advanced · 10 min', 'url' => '#golf-betting'],
                        ['icon' => '⚡', 'title' => 'Live In-Play Betting Strategy', 'meta' => 'Advanced · 12 min', 'url' => '#golf-betting'],
                    ],
                ],
                'tournaments' => [
                    'eyebrow' => 'Live Schedule',
                    'title' => 'Tournament Updates &',
                    'title_em' => 'Major Events',
                    'subtitle' => 'Current and upcoming PGA Tour events from SportsDataIO Schedules feed.',
                ],
                'faq' => [
                    'eyebrow' => 'Got Questions?',
                    'title' => 'Frequently Asked',
                    'title_em' => 'Questions',
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
            'seo' => [
                'meta_title' => 'PinShot | Golf Betting Tips, Odds & Exclusive Bonuses',
                'meta_description' => 'Golf betting tips, expert picks, exclusive sportsbook bonuses, live odds comparison.',
            ],
        ];
    }

    public static function sectionKeys(): array
    {
        return [
            'strategy' => 'Strategy / Tips',
            'promos' => 'Promos',
            'best_picks' => 'Best Picks',
            'hot_props' => 'Hot Props',
            'competition_feeds' => 'Competition / Rankings',
            'live_odds' => 'Live Odds',
            'rotoballer_news' => 'RotoBaller News',
            'golf_betting' => 'Golf Betting Guides',
            'tournaments' => 'Tournaments',
            'faq' => 'FAQ',
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

    private static function plainText(string $value): string
    {
        return trim(html_entity_decode(strip_tags($value), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    }
}
