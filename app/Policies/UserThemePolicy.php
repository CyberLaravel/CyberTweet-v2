<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserTheme;

class UserThemePolicy
{
    public function view(User $user, ?UserTheme $userTheme = null): bool
    {
        return $user->hasPermissionTo('theme_view');
    }

    public function update(User $user, ?UserTheme $userTheme = null): bool
    {
        return $user->hasPermissionTo('theme_update');
    }
} 