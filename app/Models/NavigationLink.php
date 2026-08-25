<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class NavigationLink extends Model
{
    public const CACHE_KEY = 'navigation_links.all';

    public const LOCATIONS = [
        'header' => 'Header Menu',
        'footer_quick' => 'Footer — Quick Links',
        'footer_guides' => 'Footer — Guides',
        'footer_legal' => 'Footer — Legal',
    ];

    protected $fillable = [
        'label',
        'url',
        'location',
        'sort_order',
        'open_new_tab',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'open_new_tab' => 'boolean',
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

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForLocation($query, string $location)
    {
        return $query->active()->where('location', $location)->orderBy('sort_order');
    }

    public static function grouped(): array
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            $grouped = [];

            foreach (array_keys(self::LOCATIONS) as $location) {
                $grouped[$location] = self::query()->forLocation($location)->get();
            }

            return $grouped;
        });
    }

    public function resolvedUrl(): string
    {
        if (str_starts_with($this->url, '#') && ! request()->routeIs('home')) {
            return route('home').$this->url;
        }

        return $this->url;
    }
}
