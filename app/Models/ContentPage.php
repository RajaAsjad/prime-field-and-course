<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ContentPage extends Model
{
    public const CACHE_KEY = 'content_pages.all';

    public const TYPES = [
        'glossary' => 'Glossary',
        'apps' => 'App Comparison',
        'guide' => 'Guide (with sections)',
        'legal' => 'Legal / Simple Page',
        'generic' => 'Generic Page',
    ];

    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'meta_description',
        'eyebrow',
        'intro',
        'type',
        'body',
        'content',
        'is_published',
        'show_in_footer',
        'footer_label',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'content' => 'array',
            'is_published' => 'boolean',
            'show_in_footer' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::clearCache());
        static::deleted(fn () => static::clearCache());

        static::saving(function (ContentPage $page) {
            if (blank($page->slug)) {
                $page->slug = static::generateUniqueSlug($page->title, $page->id);
            }
        });
    }

    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title) ?: 'page';
        $slug = $baseSlug;
        $counter = 2;

        while (
            static::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFooter($query)
    {
        return $query->published()->where('show_in_footer', true)->orderBy('sort_order');
    }

    public function publicUrl(): string
    {
        return url('/'.$this->slug);
    }

    public function toPublicArray(): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'meta_description' => $this->meta_description,
            'eyebrow' => $this->eyebrow,
            'intro' => $this->intro,
            'type' => $this->type,
            'body' => $this->body,
            'content' => $this->content ?? [],
        ];
    }
}
