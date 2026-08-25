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
                'title' => 'BetMGM — First Bet Offer Up To $1,500 Paid Back in Bonus Bets If You Don\'t Win',
                'description' => 'New customers only. Must be 21+. Gambling problem? Call 1-800-GAMBLER.',
                'cta_url' => 'https://www.anrdoezrs.net/click-101764042-17337458',
                'pixel_url' => 'https://www.ftjcfx.com/image-101764042-17337458',
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
}
