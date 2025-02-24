<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\Hashtag;
use App\Http\Requests\TweetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\TweetResource;

class TweetController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Tweet::class);
        
        $tweets = Tweet::with(['user', 'likes', 'hashtags'])
            ->latest()
            ->paginate(10);

        return Inertia::render('Tweets/Index', [
            'tweets' => TweetResource::collection($tweets),
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Tweet::class);

        $validated = $request->validate([
            'content' => 'required|string|max:280',
        ]);

        $tweet = $request->user()->tweets()->create($validated);

        // Extract and save hashtags
        preg_match_all('/#(\w+)/', $validated['content'], $hashtags);
        if (!empty($hashtags[1])) {
            $hashtagIds = collect($hashtags[1])->map(function ($tagName) {
                return Hashtag::firstOrCreate(['name' => strtolower($tagName)])->id;
            });
            
            $tweet->hashtags()->sync($hashtagIds);
        }

        return redirect()->back();
    }

    public function show(Tweet $tweet)
    {
        $userId = request()->user()->id;
        
        $tweet->load(['user', 'comments.user'])
            ->loadCount(['likes', 'comments', 'retweets'])
            ->loadExists([
                'likes as liked' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                },
                'retweets as is_retweeted' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                }
            ]);

        return response()->json([
            'tweet' => $tweet,
            'comments' => $tweet->comments
        ]);
    }

    public function edit(Tweet $tweet)
    {
        Gate::authorize('update', $tweet);
        
        return Inertia::render('Tweets/Edit', [
            'tweet' => $tweet->load('hashtags')
        ]);
    }

    public function update(TweetRequest $request, Tweet $tweet)
    {
        Gate::authorize('update', $tweet);
        
        $validated = $request->validated();
        
        // Update the tweet
        $tweet->update([
            'content' => $validated['content']
        ]);

        // Handle hashtags
        if (!empty($validated['hashtags']) && is_array($validated['hashtags'])) {
            $hashtagIds = collect($validated['hashtags'])->map(function ($tagName) {
                return Hashtag::firstOrCreate(['name' => strtolower($tagName)])->id;
            });
            
            $tweet->hashtags()->sync($hashtagIds);
        }

        return redirect()->route('tweets.index');
    }

    public function like(Tweet $tweet)
    {
        Gate::authorize('like', $tweet);
        
        $user = request()->user();
        
        // Toggle like
        if ($tweet->likes()->where('user_id', $user->id)->exists()) {
            $tweet->likes()->detach($user->id);
            $liked = false;
        } else {
            $tweet->likes()->attach($user->id);
            $liked = true;
        }
        
        return response()->json([
            'liked' => $liked,
            'likes_count' => $tweet->likes()->count()
        ]);
    }

    public function retweet(Tweet $tweet)
    {
        Gate::authorize('retweet', $tweet);
        
        $user = request()->user();
        $isRetweeted = $tweet->retweets()->where('user_id', $user->id)->exists();
        
        if ($isRetweeted) {
            $tweet->retweets()->detach($user->id);
            $isRetweeted = false;
        } else {
            $tweet->retweets()->attach($user->id);
            $isRetweeted = true;
        }
        
        return response()->json([
            'is_retweeted' => $isRetweeted,
            'retweets_count' => $tweet->retweets()->count()
        ]);
    }
} 