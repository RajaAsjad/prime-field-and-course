<?php

namespace App\Http\Controllers;

use App\Models\ContentPage;
use Illuminate\View\View;

class PageController extends Controller
{
    public function show(string $slug): View
    {
        $contentPage = ContentPage::query()->published()->where('slug', $slug)->firstOrFail();
        $page = $contentPage->toPublicArray();

        $viewMap = [
            'glossary' => 'pages.content.golf-glossary',
            'apps' => 'pages.content.best-golf-betting-apps',
            'guide' => 'pages.content.how-to-bet-on-golf',
            'legal' => 'pages.content.generic',
            'generic' => 'pages.content.generic',
        ];

        $view = $viewMap[$contentPage->type] ?? 'pages.content.generic';

        if ($contentPage->type === 'glossary') {
            $page['terms'] = $page['content']['terms'] ?? [];
        } elseif ($contentPage->type === 'apps') {
            $page['apps'] = $page['content']['apps'] ?? [];
            $page['tips'] = $page['content']['tips'] ?? [];
        } elseif ($contentPage->type === 'guide') {
            $page['sections'] = $page['content']['sections'] ?? [];
        }

        return view($view, [
            'page' => $page,
            'relatedPages' => ContentPage::query()
                ->published()
                ->where('id', '!=', $contentPage->id)
                ->orderBy('sort_order')
                ->get()
                ->map(fn (ContentPage $related) => [
                    'title' => $related->title,
                    'description' => $related->meta_description ?? '',
                    'url' => $related->publicUrl(),
                    'eyebrow' => $related->eyebrow ?? 'Guide',
                ])
                ->all(),
        ]);
    }
}
