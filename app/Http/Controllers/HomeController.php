<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use App\Services\SportsDataIo\GolfOddsService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private readonly GolfOddsService $golfOddsService,
    ) {}

    public function index(): View
    {
        $liveOdds = $this->golfOddsService->getComparisonTable();
        $hotProps = $this->golfOddsService->getHotPropsBracket();
        $newsFeed = $this->golfOddsService->getNewsFeed();

        $tips = Tip::query()
            ->with('tipsCategory')
            ->where('status', true)
            ->orderBy('id')
            ->get();

        return view('pages.home', [
            'liveOdds' => $liveOdds,
            'oddsRefreshSeconds' => $liveOdds['refresh_seconds'] ?? config('sportsdata.odds.refresh_seconds'),
            'hotProps' => $hotProps,
            'propsRefreshSeconds' => $hotProps['refresh_seconds'] ?? config('sportsdata.props.refresh_seconds'),
            'newsFeed' => $newsFeed,
            'newsRefreshSeconds' => $newsFeed['refresh_seconds'] ?? config('sportsdata.news.refresh_seconds'),
            'tips' => $tips,
        ]);
    }

    public function liveOdds(): JsonResponse
    {
        return response()
            ->json($this->golfOddsService->getComparisonTable())
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
            ->header('Pragma', 'no-cache');
    }

    public function rotoballerNews(): JsonResponse
    {
        return response()
            ->json($this->golfOddsService->getNewsFeed())
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
            ->header('Pragma', 'no-cache');
    }

    public function hotProps(): JsonResponse
    {
        return response()
            ->json($this->golfOddsService->getHotPropsBracket())
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
            ->header('Pragma', 'no-cache');
    }
}
