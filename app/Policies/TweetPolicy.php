<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Auth\Access\HandlesAuthorization;

class TweetPolicy
{

        use HandlesAuthorization;


    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('tweet_view');
    }

    public function view(User $user, Tweet $tweet): bool
    {
        return $user->hasPermissionTo('tweet_view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('tweet_create');
    }

    public function update(User $user, Tweet $tweet): bool
    {
        return $user->id === $tweet->user_id || $user->hasRole(['admin', 'moderator']);
    }

    public function delete(User $user, Tweet $tweet): bool
    {
        return $user->id === $tweet->user_id || $user->hasRole('admin');
    }

    public function like(User $user, Tweet $tweet): bool
    {
        return $user->hasPermissionTo('tweet_like');
    }

    public function retweet(User $user, Tweet $tweet): bool
    {
        return $user->hasPermissionTo('tweet_retweet');
    }
} 