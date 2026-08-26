<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SiteSetting extends Model
{
    public const CACHE_KEY = 'site_settings.singleton';

    protected $fillable = [
        'site_name',
        'site_tagline',
        'site_logo',
        'footer_logo',
        'favicon',
        'footer_copyright',
        'footer_description',
        'contact_email',
        'contact_phone',
        'address',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
        'twitter_url',
        'homepage_content',
    ];

    protected function casts(): array
    {
        return [
            'homepage_content' => 'array',
        ];
    }

    public static function getSettings(): self
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return self::query()->firstOrCreate(
                ['id' => 1],
                [
                    'site_name' => 'Prime Field & Course',
                    'footer_copyright' => '© '.date('Y').' Prime Field & Course Solutions LLC. All rights reserved.',
                    'footer_description' => 'Expert picks, exclusive bonuses, smart strategies for serious golf bettors.',
                ]
            );
        });
    }

    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    public function siteLogoUrl(): ?string
    {
        return $this->assetUrl($this->site_logo);
    }

    public function footerLogoUrl(): ?string
    {
        return $this->assetUrl($this->footer_logo);
    }

    public function faviconUrl(): ?string
    {
        return $this->assetUrl($this->favicon);
    }

    public function faviconType(): string
    {
        $url = $this->faviconUrl();
        if (! $url) {
            return 'image/svg+xml';
        }

        $extension = strtolower(pathinfo(parse_url($url, PHP_URL_PATH) ?: '', PATHINFO_EXTENSION));

        return match ($extension) {
            'ico' => 'image/x-icon',
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'webp' => 'image/webp',
            default => 'image/svg+xml',
        };
    }

    public function displaySiteName(): string
    {
        return $this->site_name ?: 'Prime Field & Course';
    }

    public function displayTagline(): string
    {
        return $this->site_tagline ?: 'Solutions LLC';
    }

    public function homepage(): array
    {
        $homepage = array_replace_recursive(
            \App\Support\HomepageDefaults::all(),
            $this->homepage_content ?? []
        );

        $homepage['hero']['image_url'] = $this->heroImageUrl();
        $homepage['affiliate_banner'] = $this->normalizedAffiliateBanner($this->homepage_content['affiliate_banner'] ?? []);

        return $homepage;
    }

    public function heroImageUrl(): string
    {
        $stored = $this->homepage_content['hero']['image_url'] ?? null;
        $fallback = \App\Support\HomepageDefaults::all()['hero']['image_url'];

        return $this->assetUrl($stored) ?: $fallback;
    }

    public function homepageSection(string $key): array
    {
        $homepage = $this->homepage();

        return $homepage['sections'][$key] ?? [];
    }

    public function displayCopyright(): string
    {
        return $this->footer_copyright ?: '© '.date('Y').' '. $this->displaySiteName() .'. All rights reserved.';
    }

    public function hasSocialLinks(): bool
    {
        return collect([
            $this->facebook_url,
            $this->instagram_url,
            $this->linkedin_url,
            $this->youtube_url,
            $this->twitter_url,
        ])->filter()->isNotEmpty();
    }

    public function deleteStoredFile(?string $path): void
    {
        if (! $path || (! str_starts_with($path, 'site-settings/') && ! str_starts_with($path, 'homepage/'))) {
            return;
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    protected function assetUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    }

    private function normalizedAffiliateBanner(array $banner): array
    {
        $defaults = \App\Support\HomepageDefaults::all()['affiliate_banner'];

        if (trim((string) ($banner['title'] ?? '')) === '' && trim((string) ($banner['cta_url'] ?? '')) === '') {
            return $defaults;
        }

        $banner['placements'] = array_replace(
            $defaults['placements'],
            $banner['placements'] ?? []
        );

        return array_replace($defaults, $banner);
    }
}
