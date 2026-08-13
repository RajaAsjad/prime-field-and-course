<?php

return [

    'api_key' => env('FLM_API_KEY'),

    'base_url' => env('FLM_BASE_URL', 'https://api.fieldlevelmedia.com/v1'),

    /*
     * Comma-separated league short names. Empty = all golf leagues on the feed.
     * Example: PGA   or   PGA,LPGA,LIV
     */
    'leagues' => env('FLM_LEAGUES', ''),

    'cache' => [
        'token_ttl' => (int) env('FLM_TOKEN_CACHE_TTL', 518400),
        'sports_ttl' => (int) env('FLM_SPORTS_CACHE_TTL', 86400),
        'stories_ttl' => (int) env('FLM_STORIES_CACHE_TTL', 300),
    ],

    'homepage_limit' => (int) env('FLM_HOMEPAGE_LIMIT', 4),

];
