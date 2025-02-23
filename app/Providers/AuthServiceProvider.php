<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Achievement;
use App\Models\Hashtag;
use App\Models\Tweet;
use App\Models\UserTheme;
use App\Models\User;
use App\Policies\AchievementPolicy;
use App\Policies\HashtagPolicy;
use App\Policies\TweetPolicy;
use App\Policies\UserThemePolicy;
use App\Policies\NotificationPolicy;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Achievement::class => AchievementPolicy::class,
        Hashtag::class => HashtagPolicy::class,
        Tweet::class => TweetPolicy::class,
        UserTheme::class => UserThemePolicy::class,
        Notification::class => NotificationPolicy::class,
        User::class => UserPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
} 