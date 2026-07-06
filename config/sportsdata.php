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
    ],

    'news' => [
        'limit' => (int) env('SPORTSDATA_NEWS_LIMIT', 6),
        'cache_ttl' => (int) env('SPORTSDATA_NEWS_CACHE_TTL', 300),
        'refresh_seconds' => (int) env('SPORTSDATA_NEWS_REFRESH_SECONDS', 300),
    ],

    'sportsbooks' => [
        'DraftKings' => ['DraftKings', 'Draft Kings'],
        'FanDuel' => ['FanDuel', 'Fan Duel'],
        'BetMGM' => ['BetMGM', 'MGM', 'Bet MGM'],
        'Caesars' => ['Caesars', 'Caesars Sportsbook', 'Caesars Sportsbook by William Hill'],
    ],

];
