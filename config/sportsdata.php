<?php

return [

    'api_key' => env('SPORTSDATA_API_KEY'),

    'base_urls' => [
        'golf' => env('SPORTSDATA_GOLF_BASE_URL', 'https://api.sportsdata.io/golf/v2/json'),
        'odds' => env('SPORTSDATA_GOLF_ODDS_BASE_URL', 'https://api.sportsdata.io/v3/golf/odds/json'),
    ],

    'cache' => [
        'tournaments_ttl' => (int) env('SPORTSDATA_TOURNAMENTS_CACHE_TTL', 3600),
        'odds_ttl' => (int) env('SPORTSDATA_ODDS_CACHE_TTL', 120),
        'scores_ttl' => (int) env('SPORTSDATA_SCORES_CACHE_TTL', 30),
        'scores_ttl_idle' => (int) env('SPORTSDATA_SCORES_CACHE_TTL_IDLE', 300),
    ],

    'odds' => [
        'player_limit' => (int) env('SPORTSDATA_ODDS_PLAYER_LIMIT', 10),
        'refresh_seconds' => (int) env('SPORTSDATA_ODDS_REFRESH_SECONDS', 60),
        'live_refresh_seconds' => (int) env('SPORTSDATA_LIVE_REFRESH_SECONDS', 30),
        'best_value_american_min' => (int) env('SPORTSDATA_BEST_VALUE_AMERICAN_MIN', 2800),
    ],

    'news' => [
        'limit' => (int) env('SPORTSDATA_NEWS_LIMIT', 6),
        'cache_ttl' => (int) env('SPORTSDATA_NEWS_CACHE_TTL', 300),
        'refresh_seconds' => (int) env('SPORTSDATA_NEWS_REFRESH_SECONDS', 300),
    ],

    'sportsbook_group' => env('SPORTSDATA_SPORTSBOOK_GROUP', 'G1000'),

    'props' => [
        'player_limit' => (int) env('SPORTSDATA_PROPS_PLAYER_LIMIT', 8),
        'cache_ttl' => (int) env('SPORTSDATA_PROPS_CACHE_TTL', 120),
        'refresh_seconds' => (int) env('SPORTSDATA_PROPS_REFRESH_SECONDS', 120),
        'brackets' => [
            'top_5' => [
                'label' => 'Top 5',
                'bet_types' => ['Top 5 Finish'],
            ],
            'top_10' => [
                'label' => 'Top 10',
                'bet_types' => ['Top 10 Finish'],
            ],
            'top_20' => [
                'label' => 'Top 20',
                'bet_types' => ['Top 20 Finish'],
            ],
            'hole_in_one' => [
                'label' => 'One Hole in One',
                'bet_types' => ['To Make A Hole In One'],
                'market_filter' => 'yes_no_tournament',
            ],
        ],
    ],

    'sportsbooks' => [
        'DraftKings' => ['DraftKings', 'Draft Kings'],
        'FanDuel' => ['FanDuel', 'Fan Duel'],
        'BetMGM' => ['BetMGM', 'MGM', 'Bet MGM'],
        'Caesars' => ['Caesars', 'Caesars Sportsbook', 'Caesars Sportsbook by William Hill'],
    ],

];
