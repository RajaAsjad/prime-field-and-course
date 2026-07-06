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
                'image' => 'https://images.unsplash.com/photo-1587174486073-ae5e5cff23aa?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'category_slug' => 'handicapping',
                'title' => 'Strokes Gained: The Key Metric',
                'description' => 'Translated into betting edges every week.',
                'image' => 'https://images.unsplash.com/photo-1560807707-8cc77767d783?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'category_slug' => 'tournament',
                'title' => 'The Players Championship 2025 Preview',
                'description' => 'Full field breakdown with course fits & projections.',
                'image' => 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'category_slug' => 'advanced',
                'title' => 'Weather & Wind: The Hidden Variable',
                'description' => 'Create systematic edges across all PGA Tour venues.',
                'image' => 'https://images.unsplash.com/photo-1590496793929-36417d3117de?auto=format&fit=crop&w=800&q=80',
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
