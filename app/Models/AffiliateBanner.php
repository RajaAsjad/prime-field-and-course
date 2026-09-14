<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class AffiliateBanner extends Model
{
    public const CACHE_KEY = 'affiliate_banners.active';

    protected $fillable = [
        'brand_name',
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
        static::deleted(fn () => static::clearCache());
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
}
