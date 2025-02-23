<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Hashtag;

class HashtagPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('hashtag_view');
    }

    public function view(User $user, Hashtag $hashtag): bool
    {
        return $user->hasPermissionTo('hashtag_view');
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'moderator']);
    }

    public function update(User $user, Hashtag $hashtag): bool
    {
        return $user->hasRole(['admin', 'moderator']);
    }

    public function delete(User $user, Hashtag $hashtag): bool
    {
        return $user->hasRole('admin');
    }
} 