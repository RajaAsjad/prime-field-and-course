<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AffiliateBanner extends Model
{
    public const CACHE_KEY = 'affiliate_banners.active';

    protected $fillable = [
        'brand_name',
        'brand_image',
        'title',
        'description',
        'cta_label',
        'cta_url',
        'pixel_url',
        'placements',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'placements' => 'array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::clearCache());
        static::deleted(function (self $banner) {
            $banner->deleteStoredImage();
            static::clearCache();
        });
    }

    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    public static function cachedActive(): Collection
    {
        return Cache::rememberForever(self::CACHE_KEY, fn () => self::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get());
    }

    public static function forPlacement(string $placement): Collection
    {
        return static::cachedActive()
            ->filter(fn (self $banner) => in_array($placement, $banner->placements ?? [], true))
            ->values();
    }

    public function brandImageUrl(): ?string
    {
        if (! $this->brand_image) {
            return null;
        }

        if (str_starts_with($this->brand_image, 'http://') || str_starts_with($this->brand_image, 'https://')) {
            return $this->brand_image;
        }

        return asset('storage/'.$this->brand_image);
    }

    public function deleteStoredImage(): void
    {
        if (! $this->brand_image || ! str_starts_with($this->brand_image, 'affiliate-banners/')) {
            return;
        }

        if (Storage::disk('public')->exists($this->brand_image)) {
            Storage::disk('public')->delete($this->brand_image);
        }
    }
}
