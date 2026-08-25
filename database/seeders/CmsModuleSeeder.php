<?php

namespace Database\Seeders;

use App\Models\CmsModule;
use Illuminate\Database\Seeder;

class CmsModuleSeeder extends Seeder
{
    /**
     * Sidebar modules for this project.
     */
    public function run(): void
    {
        CmsModule::updateOrCreate(
            ['route_name' => 'admin.dashboard'],
            [
                'name' => 'Dashboard',
                'icon' => 'fa-solid fa-house',
                'sort_order' => 1,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'users.index'],
            [
                'name' => 'Users',
                'icon' => 'fa-solid fa-users',
                'sort_order' => 2,
                'status' => 'inactive',
                'parent_id' => 0,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'site-settings.edit'],
            [
                'name' => 'Site Settings',
                'icon' => 'fa-solid fa-gear',
                'sort_order' => 3,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        $tipsManagement = CmsModule::updateOrCreate(
            ['route_name' => 'admin.tips-management'],
            [
                'name' => 'Tips Management',
                'icon' => 'fa-solid fa-lightbulb',
                'sort_order' => 4,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'admin.tips.index'],
            [
                'name' => 'Tip',
                'icon' => 'fa-solid fa-lightbulb',
                'sort_order' => 1,
                'status' => 'active',
                'parent_id' => $tipsManagement->id,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'admin.tips-categories.index'],
            [
                'name' => 'Tips Category',
                'icon' => 'fa-solid fa-tags',
                'sort_order' => 2,
                'status' => 'active',
                'parent_id' => $tipsManagement->id,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'admin.promos.index'],
            [
                'name' => 'Promos',
                'icon' => 'fa-solid fa-gift',
                'sort_order' => 5,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        $websiteContent = CmsModule::updateOrCreate(
            ['route_name' => 'admin.website-content'],
            [
                'name' => 'Website Content',
                'icon' => 'fa-solid fa-globe',
                'sort_order' => 6,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'admin.homepage.edit'],
            [
                'name' => 'Homepage',
                'icon' => 'fa-solid fa-house-chimney',
                'sort_order' => 1,
                'status' => 'active',
                'parent_id' => $websiteContent->id,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'admin.content-pages.index'],
            [
                'name' => 'Content Pages',
                'icon' => 'fa-solid fa-file-lines',
                'sort_order' => 2,
                'status' => 'active',
                'parent_id' => $websiteContent->id,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'admin.navigation-links.index'],
            [
                'name' => 'Navigation Links',
                'icon' => 'fa-solid fa-link',
                'sort_order' => 3,
                'status' => 'active',
                'parent_id' => $websiteContent->id,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'admin.faqs.index'],
            [
                'name' => 'FAQs',
                'icon' => 'fa-solid fa-circle-question',
                'sort_order' => 4,
                'status' => 'active',
                'parent_id' => $websiteContent->id,
            ]
        );

        $allowed = [
            'admin.dashboard',
            'users.index',
            'site-settings.edit',
            'admin.tips-management',
            'admin.tips.index',
            'admin.tips-categories.index',
            'admin.promos.index',
            'admin.website-content',
            'admin.homepage.edit',
            'admin.content-pages.index',
            'admin.navigation-links.index',
            'admin.faqs.index',
        ];

        CmsModule::query()
            ->where(function ($q) use ($allowed) {
                $q->whereNotIn('route_name', $allowed)
                    ->orWhereNull('route_name');
            })
            ->delete();
    }
}
