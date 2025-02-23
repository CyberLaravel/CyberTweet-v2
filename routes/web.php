<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Controllers
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\HashtagController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserThemeController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Authentication Routes (Jetstream/Fortify)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Achievement Routes
    Route::resource('achievements', AchievementController::class);

    // Hashtag Routes
    Route::get('/hashtags', [HashtagController::class, 'index'])->name('hashtags.index');
    Route::get('/hashtags/trending', [HashtagController::class, 'trending'])->name('hashtags.trending');
    Route::get('/hashtags/{hashtag}', [HashtagController::class, 'show'])->name('hashtags.show');

    // Notification Routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count');

    // Tweet Routes
    Route::resource('tweets', TweetController::class)->except(['edit', 'update']);
    Route::post('/tweets/{tweet}/like', [TweetController::class, 'like'])->name('tweets.like');
    Route::post('/tweets/{tweet}/retweet', [TweetController::class, 'retweet'])->name('tweets.retweet');

    // User Theme Routes
    Route::get('/theme/edit', [UserThemeController::class, 'edit'])->name('user-theme.edit');
    Route::put('/theme', [UserThemeController::class, 'update'])->name('user-theme.update');
});

// Optional: Public routes that might not require authentication
Route::get('/hashtags/trending', [HashtagController::class, 'trending'])->name('public.hashtags.trending');
