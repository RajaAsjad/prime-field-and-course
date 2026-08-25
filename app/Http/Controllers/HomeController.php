<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Promo;
use App\Models\SiteSetting;
use App\Services\FieldLevelMedia\FlmContentService;
use App\Services\SportsDataIo\GolfOddsService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private readonly GolfOddsService $golfOddsService,
        private readonly FlmContentService $flmContentService,
    ) {}

    public function index(): View
    {
        $liveOdds = $this->golfOddsService->getComparisonTable();
        $topPicks = $this->golfOddsService->buildTopPicks($liveOdds);
        $hotProps = $this->golfOddsService->getHotPropsBracket();
        $competitionFeeds = $this->golfOddsService->getCompetitionFeeds();
        $newsFeed = $this->golfOddsService->getNewsFeed();
        $flmFeed = $this->flmContentService->getFeed();
        $settings = SiteSetting::getSettings();
        $homepage = $settings->homepage();

        return view('pages.home', [
            'liveOdds' => $liveOdds,
            'oddsRefreshSeconds' => $liveOdds['refresh_seconds'] ?? config('sportsdata.odds.refresh_seconds'),
            'topPicks' => $topPicks,
            'hotProps' => $hotProps,
            'propsRefreshSeconds' => $hotProps['refresh_seconds'] ?? config('sportsdata.props.refresh_seconds'),
            'competitionFeeds' => $competitionFeeds,
            'competitionRefreshSeconds' => $competitionFeeds['refresh_seconds'] ?? config('sportsdata.competition.refresh_seconds'),
            'newsFeed' => $newsFeed,
            'newsRefreshSeconds' => $newsFeed['refresh_seconds'] ?? config('sportsdata.news.refresh_seconds'),
            'flmFeed' => $flmFeed,
            'homepage' => $homepage,
            'promos' => Promo::query()->homepage()->get(),
            'faqs' => Faq::activeList(),
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

    public function flmStories(): JsonResponse
    {
        return response()
            ->json($this->flmContentService->getFeed())
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

    public function competitionFeeds(): JsonResponse
    {
        return response()
            ->json($this->golfOddsService->getCompetitionFeeds())
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
            ->header('Pragma', 'no-cache');
    }
}
