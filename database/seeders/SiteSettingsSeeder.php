<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Prime Field & Course',
                'site_tagline' => 'Solutions LLC',
                'footer_copyright' => '© '.date('Y').' Prime Field & Course Solutions LLC. All rights reserved.',
                'footer_description' => 'Expert picks, exclusive bonuses, smart strategies for serious golf bettors.',
                'homepage_content' => \App\Support\HomepageDefaults::all(),
            ]
        );

        SiteSetting::clearCache();
    }
}
