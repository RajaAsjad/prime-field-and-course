<?php

namespace Database\Seeders;

use App\Models\ContentPage;
use Illuminate\Database\Seeder;

class GolfBettingHubSeeder extends Seeder
{
    public function run(): void
    {
        $cards = [
            [
                'title' => 'FedEx Cup Betting',
                'description' => 'Playoff pressure changes everything about how a leaderboard behaves, and FedEx Cup betting reflects that chaos better than almost any other stretch of the season. Odds swing hard round to round as seeding math, shrinking fields, and pure momentum collide against each other.',
                'url' => '/blog/why-fedex-cup-betting-odds-change',
            ],
            [
                'title' => 'Presidents Cup Betting',
                'description' => 'Match play flips the script on stroke play logic entirely. Presidents Cup betting rewards genuine pairing analysis and format-specific reads far more than raw world ranking ever will, especially once official session pairings actually get announced.',
                'url' => '',
            ],
            [
                'title' => 'Korn Ferry Tour Betting',
                'description' => 'Softer lines and considerably thinner betting volume make Korn Ferry Tour betting a genuine value hunting ground for patient bettors willing to dig past the recognizable names everyone else is chasing week after week.',
                'url' => '',
            ],
            [
                'title' => 'DP World Tour Betting',
                'description' => 'Two separate markets pricing the exact same field independently creates real cracks worth exploiting. DP World Tour betting during co-sanctioned weeks often reveals meaningful pricing gaps worth comparing carefully across multiple sportsbooks.',
                'url' => '',
            ],
            [
                'title' => 'Ryder Cup Betting',
                'description' => 'Team golf breaks every normal betting assumption you\'ve built up elsewhere. Ryder Cup betting demands genuinely understanding foursomes, fourballs, and shifting session structure before a single serious pick ever goes on the board.',
                'url' => '',
            ],
            [
                'title' => 'Players Championship Betting',
                'description' => 'The deepest field in golf meets the toughest, most unforgiving cut line anywhere on tour. Players Championship betting hinges heavily on simply surviving Sawgrass before the outright winner market even starts to matter much.',
                'url' => '',
            ],
            [
                'title' => 'PGA Live Betting',
                'description' => 'The outright market closing Wednesday night isn\'t the finish line at all. PGA live betting rewards bettors reacting quickly to real-time strokes gained shifts well before the actual leaderboard catches up to reality.',
                'url' => '',
            ],
            [
                'title' => 'Head-to-Head Golf Betting',
                'description' => 'Sample size changes absolutely everything in this market. Head-to-head golf betting behaves completely differently across a single round proposition versus a full 72-hole tournament matchup between the same two players.',
                'url' => '',
            ],
            [
                'title' => 'LPGA Betting',
                'description' => 'One truly dominant player can reshape an entire betting board around herself. LPGA betting right now means understanding exactly how a heavy, well-deserved favorite compresses value across the rest of the field beneath her.',
                'url' => '',
            ],
            [
                'title' => 'Golf Handicap Betting',
                'description' => 'The exact same line rarely prices identically across every platform. Golf handicap betting rewards the simple habit of shopping virtual stroke numbers across multiple sportsbooks before ever locking a wager in.',
                'url' => '',
            ],
            [
                'title' => 'Memorial Tournament Odds',
                'description' => 'A genuinely short favorite squeezes value out of the entire board around him. Memorial Tournament odds at Muirfield Village reveal real, exploitable value sitting quietly beneath a dominant, well-earned outright price.',
                'url' => '',
            ],
            [
                'title' => 'Golf Wagering Explained',
                'description' => 'New to all of this? Golf wagering covers everything from simple outright winners to futures markets and detailed props, and understanding these basics changes how every single other market on the board actually makes sense.',
                'url' => '',
            ],
            [
                'title' => 'Prop Bets Golf',
                'description' => 'Smaller markets consistently carry softer, more exploitable lines. Prop bets golf built specifically around stats like driving accuracy or approach play often carry considerably more value than the heavily crowded outright board.',
                'url' => '',
            ],
            [
                'title' => 'Golf Sportsbook Guide',
                'description' => 'Not every platform actually treats golf as a priority sport. Our golf sportsbook guide breaks down real market depth, live odds speed, and genuine features worth comparing before you commit serious money to one book.',
                'url' => '',
            ],
            [
                'title' => 'Masters Golf Tournament Picks',
                'description' => 'Augusta National rewards a very specific skill set year after year without fail. Masters golf tournament picks built on real, hard analytics consistently beat simple reputation-based guessing almost every single spring.',
                'url' => '',
            ],
        ];

        ContentPage::updateOrCreate(
            ['slug' => 'golf-betting-hub'],
            [
                'title' => 'Golf Betting Hub',
                'subtitle' => null,
                'meta_title' => 'Golf Betting Hub | Picks, Odds, Props & Betting Guides',
                'meta_description' => 'Explore golf betting with PinShot. Find tournament picks, live odds, golf props, matchup strategies, sportsbook guides, and expert betting insights in one hub.',
                'eyebrow' => 'Betting Hub',
                'intro' => 'Every golf betting decision starts somewhere, and this page is that starting point. Below you\'ll find quick breakdowns for every major event and betting angle we cover on the site, each one linking straight through to a full deep dive whenever you\'re ready to go further.',
                'type' => 'hub',
                'body' => 'Must be 21+. Gambling problem? Call 1-800-GAMBLER. This content is for informational and entertainment purposes only.',
                'content' => ['cards' => $cards],
                'is_published' => true,
                'show_in_footer' => true,
                'footer_label' => 'Golf Betting Hub',
                'sort_order' => 0,
            ]
        );
    }
}
