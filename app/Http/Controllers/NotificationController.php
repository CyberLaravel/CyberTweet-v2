<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Notification::class);
        $notifications = $request->user()->notifications()
            ->with('actor')
            ->latest()
            ->paginate(20);

        return Inertia::render('Notifications/Index', [
            'notifications' => $notifications
        ]);
    }

    public function markAsRead(NotificationRequest $request)
    {
        $notificationId = $request->input('notification_id');

        if ($notificationId) {
            $notification = $request->user()->notifications()->findOrFail($notificationId);
            Gate::authorize('markAsRead', $notification);
            $notification->update(['read_at' => now()]);
        } else {
            Gate::authorize('markAsRead', null);
            $request->user()->notifications()->update(['read_at' => now()]);
        }

        return response()->json(['success' => true]);
    }

    public function unreadCount(Request $request)
    {
        Gate::authorize('viewAny', Notification::class);
        $unreadCount = $request->user()->notifications()->whereNull('read_at')->count();

        return response()->json(['unread_count' => $unreadCount]);
    }
} 