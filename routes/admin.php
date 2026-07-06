<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TipController;
use App\Http\Controllers\Admin\TipsCategoryController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin routes — names must match cms_modules.route_name in seeders
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'role:admin|user'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/site-settings', [SiteSettingController::class, 'edit'])->name('site-settings.edit');
    Route::put('/site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');

    Route::resource('tips', TipController::class)
        ->names('admin.tips')
        ->except(['show']);

    Route::resource('tips-categories', TipsCategoryController::class)
        ->names('admin.tips-categories')
        ->except(['show']);

    Route::resource('promos', PromoController::class)
        ->names('admin.promos')
        ->except(['show']);
});
