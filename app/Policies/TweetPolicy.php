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
        return true; // Anyone can view tweets
    }

    public function view(User $user, Tweet $tweet): bool
    {
        return $user->hasPermissionTo('tweet_view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create tweets');
    }

    public function update(User $user, Tweet $tweet): bool
    {
        return $user->id === $tweet->user_id || $user->hasPermissionTo('edit tweets');
    }

    public function delete(User $user, Tweet $tweet): bool
    {
        return $user->id === $tweet->user_id || $user->hasPermissionTo('delete tweets');
    }

    public function like(User $user, Tweet $tweet): bool
    {
        return true; // Any authenticated user can like tweets
    }

    public function retweet(User $user, Tweet $tweet): bool
    {
        return true; // Any authenticated user can retweet
    }
} 