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
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

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
    // User profile routes (put these first)
    Route::get('/@{user:username}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/follow', [UserController::class, 'follow'])->name('users.follow');

    // Other routes...
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Achievement Routes
    Route::resource('achievements', AchievementController::class);

    // Hashtag Routes
    Route::get('/hashtags', [HashtagController::class, 'index'])->name('hashtags.index');
    Route::get('/hashtags/{hashtag}', [HashtagController::class, 'show'])->name('hashtags.show');
    Route::get('/hashtags/trending', [HashtagController::class, 'trending'])->name('hashtags.trending');

    // Notification Routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count');

    // Tweet Routes
    Route::resource('tweets', TweetController::class);
    Route::post('/tweets/{tweet}/like', [TweetController::class, 'like'])->name('tweets.like');
    Route::post('/tweets/{tweet}/retweet', [TweetController::class, 'retweet'])->name('tweets.retweet');
    Route::post('/tweets/{tweet}/comments', [CommentController::class, 'store'])->name('comments.store');

    // User Theme Routes
    Route::get('/theme/edit', [UserThemeController::class, 'edit'])->name('user-theme.edit');
    Route::put('/theme', [UserThemeController::class, 'update'])->name('user-theme.update');
});

// Optional: Public routes that might not require authentication
Route::get('/hashtags/trending', [HashtagController::class, 'trending'])->name('public.hashtags.trending');

Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
