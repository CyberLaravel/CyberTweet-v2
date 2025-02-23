<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class UserPolicy
{
    use HandlesAuthorization;


    public function viewProfile(User $authenticatedUser, User $user): bool
    {
        return $authenticatedUser->hasPermissionTo('user_view') || 
               $authenticatedUser->id === $user->id;
    }

    public function editProfile(User $authenticatedUser, User $user): bool
    {
        return $authenticatedUser->hasPermissionTo('user_profile_edit') || 
               $authenticatedUser->id === $user->id;
    }

    public function follow(User $authenticatedUser, User $userToFollow): bool
    {
        return $authenticatedUser->id !== $userToFollow->id;
    }
} 