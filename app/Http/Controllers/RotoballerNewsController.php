<?php

namespace App\Http\Controllers;

use App\Services\SportsDataIo\GolfOddsService;
use Illuminate\View\View;

class RotoballerNewsController extends Controller
{
    public function __construct(
        private readonly GolfOddsService $golfOddsService,
    ) {}

    public function show(int $newsId): View
    {
        $article = $this->golfOddsService->getNewsItem($newsId);

        abort_if($article === null, 404);

        $related = collect($this->golfOddsService->getNewsFeed()['items'] ?? [])
            ->reject(fn (array $item) => (int) ($item['id'] ?? 0) === $newsId)
            ->take(3)
            ->values()
            ->all();

        return view('pages.news.show', compact('article', 'related'));
    }
}
