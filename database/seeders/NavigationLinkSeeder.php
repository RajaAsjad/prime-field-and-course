<?php

namespace Database\Seeders;

use App\Models\NavigationLink;
use Illuminate\Database\Seeder;

class NavigationLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            ['label' => 'Strategy', 'url' => '#strategy', 'location' => 'header', 'sort_order' => 1],
            ['label' => 'Promos', 'url' => '#promos', 'location' => 'header', 'sort_order' => 2],
            ['label' => 'Best Picks', 'url' => '#best-picks', 'location' => 'header', 'sort_order' => 3],
            ['label' => 'Rankings', 'url' => '#competition-feeds', 'location' => 'header', 'sort_order' => 4],
            ['label' => 'Live Odds', 'url' => '#running-odds', 'location' => 'header', 'sort_order' => 5],
            ['label' => 'Golf Betting', 'url' => '#golf-betting', 'location' => 'header', 'sort_order' => 6],
            ['label' => 'Tournaments', 'url' => '#tournaments', 'location' => 'header', 'sort_order' => 7],
            ['label' => 'FAQ', 'url' => '#faq', 'location' => 'header', 'sort_order' => 8],

            ['label' => 'Strategy', 'url' => '#strategy', 'location' => 'footer_quick', 'sort_order' => 1],
            ['label' => 'Promos', 'url' => '#promos', 'location' => 'footer_quick', 'sort_order' => 2],
            ['label' => 'Best Picks', 'url' => '#best-picks', 'location' => 'footer_quick', 'sort_order' => 3],
            ['label' => 'Live Odds', 'url' => '#running-odds', 'location' => 'footer_quick', 'sort_order' => 4],
            ['label' => 'Golf Betting', 'url' => '#golf-betting', 'location' => 'footer_quick', 'sort_order' => 5],
            ['label' => 'Tournaments', 'url' => '#tournaments', 'location' => 'footer_quick', 'sort_order' => 6],
            ['label' => 'FAQ', 'url' => '#faq', 'location' => 'footer_quick', 'sort_order' => 7],

            ['label' => 'How to Bet on Golf', 'url' => '/how-to-bet-on-golf', 'location' => 'footer_guides', 'sort_order' => 1],
            ['label' => 'Best Betting Apps', 'url' => '/best-golf-betting-apps', 'location' => 'footer_guides', 'sort_order' => 2],
            ['label' => 'Golf Glossary', 'url' => '/golf-glossary', 'location' => 'footer_guides', 'sort_order' => 3],

            ['label' => 'Terms & Conditions', 'url' => '#', 'location' => 'footer_legal', 'sort_order' => 1],
            ['label' => 'Privacy Policy', 'url' => '#', 'location' => 'footer_legal', 'sort_order' => 2],
            ['label' => 'Responsible Gambling', 'url' => '#', 'location' => 'footer_legal', 'sort_order' => 3],
            ['label' => 'Contact', 'url' => '#', 'location' => 'footer_legal', 'sort_order' => 4],
        ];

        foreach ($links as $link) {
            NavigationLink::updateOrCreate(
                ['label' => $link['label'], 'location' => $link['location']],
                array_merge($link, ['is_active' => true, 'open_new_tab' => false])
            );
        }
    }
}
