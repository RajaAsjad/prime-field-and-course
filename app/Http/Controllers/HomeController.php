<?php

namespace App\Http\Controllers;

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

        return view('pages.home', [
            'liveOdds' => $liveOdds,
            'oddsRefreshSeconds' => $liveOdds['refresh_seconds'] ?? config('sportsdata.odds.refresh_seconds'),
        ]);
    }

    public function liveOdds(): JsonResponse
    {
        return response()
            ->json($this->golfOddsService->getComparisonTable())
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
            ->header('Pragma', 'no-cache');
    }
}
