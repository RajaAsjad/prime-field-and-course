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

        $placements = [];
        foreach (array_keys(HomepageDefaults::BANNER_PLACEMENTS) as $placement) {
            $placements[$placement] = $request->boolean('affiliate_banner.placements.'.$placement);
        }

        return [
            'hero' => $hero,
            'header_ctas' => $request->input('header_ctas', []),
            'affiliate_banner' => [
                'enabled' => $request->boolean('affiliate_banner.enabled'),
                'brand_name' => $request->input('affiliate_banner.brand_name'),
                'title' => $request->input('affiliate_banner.title'),
                'description' => $request->input('affiliate_banner.description'),
                'cta_label' => $request->input('affiliate_banner.cta_label'),
                'cta_url' => $request->input('affiliate_banner.cta_url'),
                'pixel_url' => $request->input('affiliate_banner.pixel_url'),
                'placements' => $placements,
            ],
            'sections' => $request->input('sections', []),
            'premium' => array_merge($premium, ['features' => $features]),
            'testimonials' => $testimonials,
        ];
    }
}
