<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'meta_title',
        'meta_description',
        'excerpt',
        'image',
        'body',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Blog $blog) {
            if (blank($blog->slug)) {
                $blog->slug = static::generateUniqueSlug($blog->title, $blog->id);
            }

            if ($blog->status && blank($blog->published_at)) {
                $blog->published_at = now();
            }
        });

        static::deleting(function (Blog $blog) {
            $blog->deleteStoredImage();
        });
    }

    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title) ?: 'blog';
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

    public function scopePublished($query)
    {
        return $query->where('status', true)
            ->where(function ($builder) {
                $builder->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function imageUrl(): ?string
    {
        if (! $this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        if (str_starts_with($this->image, 'assets/')) {
            return asset($this->image);
        }

        return Storage::disk('public')->url($this->image);
    }

    public function deleteStoredImage(): void
    {
        if (! $this->image || ! str_starts_with($this->image, 'blogs/')) {
            return;
        }

        if (Storage::disk('public')->exists($this->image)) {
            Storage::disk('public')->delete($this->image);
        }
    }

    public function publicUrl(): string
    {
        return route('blogs.show', $this);
    }

    public function seoTitle(): string
    {
        return $this->meta_title ?: $this->title;
    }

    public function statusLabel(): string
    {
        return $this->status ? 'Published' : 'Draft';
    }
}
