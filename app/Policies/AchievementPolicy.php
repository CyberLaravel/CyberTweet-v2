<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Achievement;

class AchievementPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('achievement_view');
    }

    public function view(User $user, Achievement $achievement): bool
    {
        return $user->hasPermissionTo('achievement_view');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Achievement $achievement): bool
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Achievement $achievement): bool
    {
        return $user->hasRole('admin');
    }
} 