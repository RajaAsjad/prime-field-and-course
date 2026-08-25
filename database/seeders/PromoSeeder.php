<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        $affiliateUrl = 'https://www.anrdoezrs.net/click-101764042-17337458';

        $promos = [
            [
                'title' => 'BetMGM Promo',
                'book_name' => 'BetMGM',
                'book_class' => 'mgm',
                'bonus_text' => '$1,500 Back',
                'description' => 'First bet insurance up to $1,500.',
                'cta_url' => $affiliateUrl,
                'is_featured' => true,
                'ribbon_text' => 'TOP PICK',
                'sort_order' => 1,
            ],
            [
                'title' => 'FanDuel Promo',
                'book_name' => 'FanDuel',
                'book_class' => 'fd',
                'bonus_text' => '$150 Back',
                'description' => 'No Sweat First Bet up to $150.',
                'cta_url' => $affiliateUrl,
                'sort_order' => 2,
            ],
            [
                'title' => 'DraftKings Promo',
                'book_name' => 'DraftKings',
                'book_class' => 'dk',
                'bonus_text' => '$200 Bonus',
                'description' => 'Bet $5, get $200 in bonus bets instantly.',
                'cta_url' => $affiliateUrl,
                'sort_order' => 3,
            ],
            [
                'title' => 'Caesars Promo',
                'book_name' => 'Caesars',
                'book_class' => 'cz',
                'bonus_text' => '$1,000 Back',
                'description' => 'First bet up to $1,000 back as bonus.',
                'cta_url' => $affiliateUrl,
                'sort_order' => 4,
            ],
            [
                'title' => 'Bet365 Promo',
                'book_name' => 'Bet365',
                'book_class' => 'b365',
                'bonus_text' => '$200 Bonus',
                'description' => 'Bet $5 and receive $200 in bonus bets.',
                'cta_url' => $affiliateUrl,
                'sort_order' => 5,
            ],
        ];

        foreach ($promos as $promo) {
            Promo::updateOrCreate(
                ['book_name' => $promo['book_name']],
                array_merge($promo, [
                    'status' => true,
                    'cta_label' => 'Claim Bonus →',
                    'disclaimer' => Promo::DEFAULT_DISCLAIMER,
                ])
            );
        }
    }
}
