<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateHomepageRequest;
use App\Models\SiteSetting;
use App\Support\HomepageDefaults;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class HomepageController extends Controller
{
    public function edit(): View
    {
        $settings = SiteSetting::getSettings();

        return view('screens.admin.homepage.edit', [
            'settings' => $settings,
            'homepage' => $settings->homepage(),
        ]);
    }

    public function update(UpdateHomepageRequest $request): RedirectResponse
    {
        $settings = SiteSetting::query()->firstOrCreate(['id' => 1]);

        $settings->site_tagline = $request->input('site_tagline');
        $settings->homepage_content = $this->buildHomepageContent($request, $settings);
        $settings->save();

        SiteSetting::clearCache();

        return redirect()
            ->route('admin.homepage.edit')
            ->with('success', 'Homepage updated successfully.');
    }

    private function buildHomepageContent(UpdateHomepageRequest $request, SiteSetting $settings): array
    {
        $features = array_values(array_filter($request->input('premium.features', [])));
        $testimonials = collect($request->input('testimonials', []))
            ->filter(fn ($item) => ! empty($item['quote']))
            ->values()
            ->all();

        $hero = $request->input('hero', []);
        $hero['headline_html'] = HomepageDefaults::buildHighlightedHtml(
            (string) $request->input('hero.headline_before', ''),
            (string) $request->input('hero.headline_highlight', ''),
            (string) $request->input('hero.headline_after', '')
        );
        unset($hero['headline_before'], $hero['headline_highlight'], $hero['headline_after']);

        $currentImage = $settings->homepage_content['hero']['image_url'] ?? null;

        if ($request->hasFile('hero_image')) {
            $settings->deleteStoredFile($currentImage);
            $hero['image_url'] = $request->file('hero_image')->store('homepage', 'public');
        } else {
            $hero['image_url'] = $currentImage;
        }

        $premium = $request->input('premium', []);
        $premium['title_html'] = HomepageDefaults::buildHighlightedHtml(
            (string) $request->input('premium.title_before', ''),
            (string) $request->input('premium.title_highlight', ''),
            (string) $request->input('premium.title_after', '')
        );
        $premium['form_title_html'] = HomepageDefaults::buildHighlightedHtml(
            (string) $request->input('premium.form_title_before', ''),
            (string) $request->input('premium.form_title_highlight', ''),
            (string) $request->input('premium.form_title_after', '')
        );
        unset(
            $premium['title_before'],
            $premium['title_highlight'],
            $premium['title_after'],
            $premium['form_title_before'],
            $premium['form_title_highlight'],
            $premium['form_title_after']
        );

        $sections = $request->input('sections', []);
        if (isset($sections['golf_betting']['guides']) && is_array($sections['golf_betting']['guides'])) {
            $sections['golf_betting']['guides'] = collect($sections['golf_betting']['guides'])
                ->map(function ($guide) {
                    $guide = is_array($guide) ? $guide : [];

                    return [
                        'icon' => trim((string) ($guide['icon'] ?? '')),
                        'title' => trim((string) ($guide['title'] ?? '')),
                        'meta' => trim((string) ($guide['meta'] ?? '')),
                        'url' => trim((string) ($guide['url'] ?? '')),
                    ];
                })
                ->filter(fn ($guide) => $guide['title'] !== '')
                ->values()
                ->all();
        }

        return [
            'hero' => $hero,
            'header_ctas' => $request->input('header_ctas', []),
            'sections' => $sections,
            'premium' => array_merge($premium, ['features' => $features]),
            'testimonials' => $testimonials,
            'seo' => [
                'meta_title' => trim((string) $request->input('seo.meta_title', '')),
                'meta_description' => trim((string) $request->input('seo.meta_description', '')),
            ],
        ];
    }
}
