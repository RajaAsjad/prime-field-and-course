<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSiteSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SiteSettingController extends Controller
{
    public function edit(): View
    {
        $settings = SiteSetting::getSettings();

        return view('screens.admin.site-settings.edit', compact('settings'));
    }

    public function update(UpdateSiteSettingRequest $request): RedirectResponse
    {
        $settings = SiteSetting::query()->firstOrCreate(['id' => 1]);

        $data = $request->safe()->except([
            'site_logo',
            'footer_logo',
            'favicon',
        ]);

        $settings->fill($data);

        if ($request->hasFile('site_logo')) {
            $settings->deleteStoredFile($settings->site_logo);
            $settings->site_logo = $request->file('site_logo')->store('site-settings', 'public');
        }

        if ($request->hasFile('footer_logo')) {
            $settings->deleteStoredFile($settings->footer_logo);
            $settings->footer_logo = $request->file('footer_logo')->store('site-settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            $settings->deleteStoredFile($settings->favicon);
            $settings->favicon = $request->file('favicon')->store('site-settings', 'public');
        }

        $settings->save();
        SiteSetting::clearCache();

        return redirect()
            ->route('site-settings.edit')
            ->with('success', 'Site settings updated successfully.');
    }
}
