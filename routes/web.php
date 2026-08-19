<?php

use App\Http\Controllers\FlmStoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RotoballerNewsController;
use App\Http\Controllers\TipController;
use Illuminate\Support\Facades\Route;



// web routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tips/{tip:slug}', [TipController::class, 'show'])->name('tips.show');
Route::get('/stories/{storyId}', [FlmStoryController::class, 'show'])->name('stories.show');
Route::get('/news/{newsId}', [RotoballerNewsController::class, 'show'])->name('news.show');
Route::get('/api/live-odds', [HomeController::class, 'liveOdds'])->name('api.live-odds');
Route::get('/api/hot-props', [HomeController::class, 'hotProps'])->name('api.hot-props');
Route::get('/api/competition-feeds', [HomeController::class, 'competitionFeeds'])->name('api.competition-feeds');
Route::get('/api/rotoballer-news', [HomeController::class, 'rotoballerNews'])->name('api.rotoballer-news');
Route::get('/api/flm-stories', [HomeController::class, 'flmStories'])->name('api.flm-stories');



Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// dashboard routes
require __DIR__.'/admin.php';

require __DIR__.'/auth.php';
