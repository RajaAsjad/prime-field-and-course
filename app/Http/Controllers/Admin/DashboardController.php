<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentPage;
use App\Models\Faq;
use App\Models\NavigationLink;
use App\Models\Promo;
use App\Models\Tip;
use App\Models\TipsCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $tipCount = Tip::query()->count();
        $promoCount = Promo::query()->count();
        $pageCount = ContentPage::query()->count();
        $faqCount = Faq::query()->count();
        $navCount = NavigationLink::query()->count();
        $categoryCount = TipsCategory::query()->count();

        $stats = [
            [
                'label' => 'Tips',
                'value' => $tipCount,
                'meta' => Tip::query()->where('status', true)->count().' published',
                'icon' => 'fa-solid fa-lightbulb',
                'url' => route('admin.tips.index'),
            ],
            [
                'label' => 'Promos',
                'value' => $promoCount,
                'meta' => Promo::query()->where('status', true)->count().' active',
                'icon' => 'fa-solid fa-gift',
                'url' => route('admin.promos.index'),
            ],
            [
                'label' => 'Content Pages',
                'value' => $pageCount,
                'meta' => ContentPage::query()->where('is_published', true)->count().' live',
                'icon' => 'fa-solid fa-file-lines',
                'url' => route('admin.content-pages.index'),
            ],
            [
                'label' => 'FAQs',
                'value' => $faqCount,
                'meta' => Faq::query()->where('is_active', true)->count().' visible',
                'icon' => 'fa-solid fa-circle-question',
                'url' => route('admin.faqs.index'),
            ],
            [
                'label' => 'Nav Links',
                'value' => $navCount,
                'meta' => NavigationLink::query()->where('is_active', true)->count().' active',
                'icon' => 'fa-solid fa-link',
                'url' => route('admin.navigation-links.index'),
            ],
            [
                'label' => 'Tip Categories',
                'value' => $categoryCount,
                'meta' => 'Organize weekly tips',
                'icon' => 'fa-solid fa-tags',
                'url' => route('admin.tips-categories.index'),
            ],
        ];

        $shortcuts = [
            [
                'label' => 'Edit Homepage',
                'desc' => 'Hero, bonuses, and premium block',
                'icon' => 'fa-solid fa-house-chimney',
                'url' => route('admin.homepage.edit'),
            ],
            [
                'label' => 'Add Promo',
                'desc' => 'Sportsbook offer cards',
                'icon' => 'fa-solid fa-plus',
                'url' => route('admin.promos.create'),
            ],
            [
                'label' => 'Write a Tip',
                'desc' => 'New strategy or betting note',
                'icon' => 'fa-solid fa-pen-to-square',
                'url' => route('admin.tips.create'),
            ],
            [
                'label' => 'Content Pages',
                'desc' => 'Glossary, apps, and guides',
                'icon' => 'fa-solid fa-file-lines',
                'url' => route('admin.content-pages.index'),
            ],
            [
                'label' => 'FAQs',
                'desc' => 'Answers shown on the homepage',
                'icon' => 'fa-solid fa-circle-question',
                'url' => route('admin.faqs.index'),
            ],
            [
                'label' => 'Site Settings',
                'desc' => 'Logo, contact, and social links',
                'icon' => 'fa-solid fa-gear',
                'url' => route('site-settings.edit'),
            ],
        ];

        $recentTips = Tip::query()->latest()->take(5)->get();
        $recentPromos = Promo::query()->orderBy('sort_order')->orderByDesc('id')->take(5)->get();

        return view('screens.admin.dashboard.index', compact(
            'user',
            'stats',
            'shortcuts',
            'recentTips',
            'recentPromos'
        ));
    }
}
