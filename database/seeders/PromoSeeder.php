<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        $promos = [
            [
                'title' => 'DraftKings',
                'description' => 'Bet $5, get $200 in bonus bets instantly.',
                'image_url' => null,
                'price' => 5.00,
                'discount_price' => 200.00,
                'status' => true,
            ],
            [
                'title' => 'FanDuel',
                'description' => 'No Sweat First Bet up to $150.',
                'image_url' => null,
                'price' => null,
                'discount_price' => 150.00,
                'status' => true,
            ],
            [
                'title' => 'BetMGM',
                'description' => 'First bet insurance up to $1,500.',
                'image_url' => null,
                'price' => null,
                'discount_price' => 1500.00,
                'status' => true,
            ],
            [
                'title' => 'Caesars',
                'description' => 'First bet up to $1,000 back as bonus.',
                'image_url' => null,
                'price' => null,
                'discount_price' => 1000.00,
                'status' => true,
            ],
            [
                'title' => 'Bet365',
                'description' => 'Bet $5 and receive $200 in bonus bets.',
                'image_url' => null,
                'price' => 5.00,
                'discount_price' => 200.00,
                'status' => true,
            ],
        ];

        foreach ($promos as $promo) {
            $slug = $this->generateUniqueSlug($promo['title']);

            DB::table('promos')->updateOrInsert(
                ['slug' => $slug],
                [
                    'title' => $promo['title'],
                    'slug' => $slug,
                    'description' => $promo['description'],
                    'image_url' => $promo['image_url'],
                    'price' => $promo['price'],
                    'discount_price' => $promo['discount_price'],
                    'status' => $promo['status'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    private function generateUniqueSlug(string $title): string
    {
        $baseSlug = Str::slug($title) ?: 'promo';
        $slug = $baseSlug;
        $counter = 2;

        while (DB::table('promos')->where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
