<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TipSeeder extends Seeder
{
    public function run(): void
    {
        $tips = [
            [
                'category_slug' => 'strategy',
                'title' => 'Fade the Field: Finding Value Longshots',
                'description' => 'How sharp bettors find value by analyzing strokes gained data.',
                'image' => 'assets/images/tips/fade-the-field-finding-value-longshots.jpg',
            ],
            [
                'category_slug' => 'handicapping',
                'title' => 'Strokes Gained: The Key Metric',
                'description' => 'Translated into betting edges every week.',
                'image' => 'assets/images/tips/strokes-gained-the-key-metric.jpg',
            ],
            [
                'category_slug' => 'tournament',
                'title' => 'The Players Championship 2025 Preview',
                'description' => 'Full field breakdown with course fits & projections.',
                'image' => 'assets/images/tips/the-players-championship-2025-preview.jpg',
            ],
            [
                'category_slug' => 'advanced',
                'title' => 'Weather & Wind: The Hidden Variable',
                'description' => 'Create systematic edges across all PGA Tour venues.',
                'image' => 'assets/images/tips/weather-wind-the-hidden-variable.jpg',
            ],
        ];

        foreach ($tips as $tip) {
            $categoryId = DB::table('tips_category')
                ->where('slug', $tip['category_slug'])
                ->value('id');

            if (! $categoryId) {
                continue;
            }

            $slug = Str::slug($tip['title']) ?: 'tip';

            DB::table('tips')->updateOrInsert(
                ['title' => $tip['title']],
                [
                    'title' => $tip['title'],
                    'slug' => $slug,
                    'tips_category_id' => $categoryId,
                    'image' => $tip['image'],
                    'description' => $tip['description'],
                    'status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
