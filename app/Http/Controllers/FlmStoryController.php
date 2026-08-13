<?php

namespace App\Http\Controllers;

use App\Services\FieldLevelMedia\FlmContentService;
use Illuminate\View\View;

class FlmStoryController extends Controller
{
    public function __construct(
        private readonly FlmContentService $flmContentService,
    ) {}

    public function show(int $storyId): View
    {
        $story = $this->flmContentService->getStory($storyId);

        abort_if($story === null, 404);

        return view('pages.stories.show', compact('story'));
    }
}
