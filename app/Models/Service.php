<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug', 'tag', 'title', 'description', 'bullets', 'image', 'icon', 'sort_order', 'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getImageUrlAttribute(): string
    {
        return self::resolveImageUrl($this->image, 'services');
    }

    public function getBulletListAttribute(): array
    {
        if (empty($this->bullets)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $this->bullets))));
    }

    public static function resolveImageUrl(?string $image, string $folder): string
    {
        if (empty($image)) {
            return asset('assets/website/images/svc-golf.jpg');
        }

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        $adminPath = public_path("admin/assets/images/{$folder}/{$image}");
        if (file_exists($adminPath)) {
            return asset("public/admin/assets/images/{$folder}/{$image}");
        }

        return asset("assets/website/images/{$image}");
    }
}
