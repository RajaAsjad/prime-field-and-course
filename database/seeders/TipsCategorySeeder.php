<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TipsCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'title' => 'Strategy',
                'description' => 'In-depth strategy guides and course management tips from professional golf analysts.',
                'image_url' => null,
            ],
            [
                'title' => 'Handicapping',
                'description' => 'Strokes gained breakdowns, form analysis, and data-driven handicapping methods.',
                'image_url' => null,
            ],
            [
                'title' => 'Tournament',
                'description' => 'Tournament previews, field breakdowns, and weekly event coverage.',
                'image_url' => null,
            ],
            [
                'title' => 'Advanced',
                'description' => 'Weather edges, live betting tactics, and advanced line-shopping strategies.',
                'image_url' => null,
            ],
        ];

        foreach ($categories as $category) {
            $slug = $this->generateUniqueSlug($category['title']);

            DB::table('tips_category')->updateOrInsert(
                ['slug' => $slug],
                [
                    'title' => $category['title'],
                    'slug' => $slug,
                    'description' => $category['description'],
                    'image_url' => $category['image_url'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    private function generateUniqueSlug(string $title): string
    {
        $baseSlug = Str::slug($title) ?: 'category';
        $slug = $baseSlug;
        $counter = 2;

        while (DB::table('tips_category')->where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
