<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Tip extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'tips_category_id',
        'image',
        'description',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Tip $tip) {
            if ($tip->isDirty('title') || blank($tip->slug)) {
                $tip->slug = static::generateUniqueSlug($tip->title, $tip->id);
            }
        });

        static::deleting(function (Tip $tip) {
            $tip->deleteStoredImage();
        });
    }

    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title) ?: 'tip';
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
        if (! $this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        // Public folder assets (works with artisan serve / correct APP_URL).
        if (str_starts_with($this->image, 'assets/')) {
            return asset($this->image);
        }

        return Storage::disk('public')->url($this->image);
    }

    public function deleteStoredImage(): void
    {
        if (! $this->image || ! str_starts_with($this->image, 'tips/')) {
            return;
        }

        if (Storage::disk('public')->exists($this->image)) {
            Storage::disk('public')->delete($this->image);
        }
    }

    public function statusLabel(): string
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    public function tipsCategory()
    {
        return $this->belongsTo(TipsCategory::class, 'tips_category_id');
    }
}
