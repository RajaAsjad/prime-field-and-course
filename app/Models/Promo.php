<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Promo extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'book_name',
        'book_class',
        'bonus_text',
        'description',
        'image_url',
        'price',
        'discount_price',
        'cta_url',
        'cta_label',
        'status',
        'is_featured',
        'ribbon_text',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'discount_price' => 'decimal:2',
            'status' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Promo $promo) {
            if ($promo->isDirty('title') || blank($promo->slug)) {
                $promo->slug = static::generateUniqueSlug($promo->title, $promo->id);
            }
        });

        static::deleting(function (Promo $promo) {
            $promo->deleteStoredImage();
        });
    }

    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title) ?: 'promo';
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

    public function imageUrl(): ?string
    {
        if (! $this->image_url) {
            return null;
        }

        if (str_starts_with($this->image_url, 'http://') || str_starts_with($this->image_url, 'https://')) {
            return $this->image_url;
        }

        return Storage::disk('public')->url($this->image_url);
    }

    public function deleteStoredImage(): void
    {
        if (! $this->image_url || ! str_starts_with($this->image_url, 'promos/')) {
            return;
        }

        if (Storage::disk('public')->exists($this->image_url)) {
            Storage::disk('public')->delete($this->image_url);
        }
    }

    public function statusLabel(): string
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    public function scopeHomepage($query)
    {
        return $query->where('status', true)->orderBy('sort_order')->orderByDesc('is_featured');
    }

    public function displayBookName(): string
    {
        return $this->book_name ?: $this->title;
    }

    public function displayBonus(): string
    {
        return $this->bonus_text ?: ($this->discount_price ? '$'.$this->discount_price.' Bonus' : $this->title);
    }
}
