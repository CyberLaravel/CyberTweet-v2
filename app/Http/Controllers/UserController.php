<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Resources\TweetResource;

class UserController extends Controller
{
    public function show(User $user)
    {
        $tweets = $user->tweets()
            ->with(['user', 'likes'])
            ->latest()
            ->paginate(10);

        $currentUser = Auth::user();

        return Inertia::render('Users/Show', [
            'profile' => new UserResource($user->load(['followers', 'followings'])),
            'tweets' => TweetResource::collection($tweets),
            'stats' => [
                'tweets' => $user->tweets()->count(),
                'followers' => $user->followers()->count(),
                'following' => $user->followings()->count(),
            ],
            'isFollowing' => $currentUser ? $currentUser->followings()->where('following_id', $user->id)->exists() : false,
        ]);
    }

    public function follow(User $user)
    {
        $currentUser = Auth::user();
        
        if (!$currentUser) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($currentUser->id === $user->id) {
            return response()->json(['message' => 'Cannot follow yourself'], 400);
        }

        $currentUser->followings()->toggle($user->id);

        return back();
    }
} 