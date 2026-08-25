<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateHomepageRequest;
use App\Models\SiteSetting;
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
        $settings->homepage_content = $this->buildHomepageContent($request);
        $settings->save();

        SiteSetting::clearCache();

        return redirect()
            ->route('admin.homepage.edit')
            ->with('success', 'Homepage updated successfully.');
    }

    private function buildHomepageContent(UpdateHomepageRequest $request): array
    {
        $features = array_values(array_filter($request->input('premium.features', [])));
        $testimonials = collect($request->input('testimonials', []))
            ->filter(fn ($item) => ! empty($item['quote']))
            ->values()
            ->all();

        return [
            'hero' => $request->input('hero', []),
            'header_ctas' => $request->input('header_ctas', []),
            'affiliate_banner' => array_merge(
                $request->input('affiliate_banner', []),
                ['enabled' => $request->boolean('affiliate_banner.enabled')]
            ),
            'sections' => $request->input('sections', []),
            'premium' => array_merge($request->input('premium', []), ['features' => $features]),
            'testimonials' => $testimonials,
        ];
    }
}
