<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('affiliate_banners', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name')->nullable();
            $table->string('title', 500);
            $table->text('description')->nullable();
            $table->string('cta_label')->nullable();
            $table->string('cta_url', 500)->nullable();
            $table->string('pixel_url', 500)->nullable();
            $table->json('placements')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });

        $this->seedFromHomepageSettings();
    }

    public function down(): void
    {
        Schema::dropIfExists('affiliate_banners');
    }

    private function seedFromHomepageSettings(): void
    {
        $defaults = [
            'enabled' => true,
            'brand_name' => 'BetMGM',
            'title' => 'BetMGM First Bet Offer: $1500 Paid Back in Bonus Bets, if You Don\'t Win*',
            'description' => '*Bonus Bets expire in 7 days. One New Customer Offer Only. Add\'l terms. Live in All States (minus NV, PR, NY).',
            'cta_label' => 'Claim Offer',
            'cta_url' => 'https://www.anrdoezrs.net/click-101764042-17337458',
            'pixel_url' => 'https://www.ftjcfx.com/image-101764042-17337458',
            'placements' => [
                'after_strategy' => true,
                'after_picks' => true,
                'after_rankings' => true,
                'after_odds' => true,
                'after_guides' => true,
            ],
        ];

        $row = DB::table('site_settings')->where('id', 1)->first();
        $content = $row && $row->homepage_content
            ? json_decode($row->homepage_content, true)
            : [];
        $stored = is_array($content['affiliate_banner'] ?? null)
            ? $content['affiliate_banner']
            : [];

        $isEmpty = trim((string) ($stored['title'] ?? '')) === ''
            && trim((string) ($stored['cta_url'] ?? '')) === '';

        $banner = $isEmpty ? $defaults : array_replace($defaults, $stored);

        $legacyPlacements = is_array($banner['placements'] ?? null) ? $banner['placements'] : $defaults['placements'];
        $placementMap = [
            'after_strategy' => 'home.after_strategy',
            'after_picks' => 'home.after_picks',
            'after_rankings' => 'home.after_rankings',
            'after_odds' => 'home.after_odds',
            'after_guides' => 'home.after_guides',
        ];

        $placements = [];
        foreach ($placementMap as $legacy => $key) {
            if (! empty($legacyPlacements[$legacy])) {
                $placements[] = $key;
            }
        }

        if ($placements === []) {
            $placements = array_values($placementMap);
        }

        DB::table('affiliate_banners')->insert([
            'brand_name' => $banner['brand_name'] ?? null,
            'title' => $banner['title'] ?: $defaults['title'],
            'description' => $banner['description'] ?? null,
            'cta_label' => $banner['cta_label'] ?? 'Claim Offer',
            'cta_url' => $banner['cta_url'] ?? null,
            'pixel_url' => $banner['pixel_url'] ?? null,
            'placements' => json_encode($placements),
            'sort_order' => 0,
            'is_active' => ! empty($banner['enabled']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
};
