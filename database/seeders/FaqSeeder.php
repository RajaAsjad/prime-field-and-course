<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Is Prime Field & Course free?',
                'answer' => 'Yes. Core picks, odds, and news are free. Premium is optional for exclusive analysis and early access.',
                'open_by_default' => true,
            ],
            [
                'question' => 'How do affiliate bonuses work?',
                'answer' => 'Click a Claim Bonus button and complete signup with the partner. The offer applies automatically at no extra cost to you.',
            ],
            [
                'question' => 'How are picks selected?',
                'answer' => 'We combine course fit, recent form, weather, and SportsDataIO odds/value signals. Every pick is reviewed before it goes live.',
            ],
            [
                'question' => 'How often are odds updated?',
                'answer' => 'Live odds refresh about every 30–120 seconds depending on the feed. Best available prices are highlighted in green.',
            ],
            [
                'question' => 'Can I cancel my subscription?',
                'answer' => 'Yes. Cancel anytime with no long-term contract. You keep access through the end of your billing period.',
            ],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                [
                    'answer' => $faq['answer'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                    'open_by_default' => $faq['open_by_default'] ?? false,
                ]
            );
        }
    }
}
