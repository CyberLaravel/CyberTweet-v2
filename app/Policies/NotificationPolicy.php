<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Notification;

class NotificationPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // User can view their own notifications
    }

    public function markAsRead(User $user, ?Notification $notification = null): bool
    {
        // If no specific notification, user can mark all their notifications
        if ($notification === null) {
            return true;
        }

        // User can only mark their own notifications
        return $notification->notifiable_id === $user->id;
    }
} 