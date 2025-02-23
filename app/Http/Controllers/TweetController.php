<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\Hashtag;
use App\Http\Requests\TweetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class TweetController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Tweet::class);
        $tweets = Tweet::with(['user', 'hashtags'])
            ->latest()
            ->paginate(20);

        return Inertia::render('Tweets/Index', [
            'tweets' => $tweets
        ]);
    }

    public function store(TweetRequest $request)
    {
        Gate::authorize('create', Tweet::class);
        
        $validated = $request->validated();
        
        // Create the tweet
        $tweet = $request->user()->tweets()->create([
            'content' => $validated['content']
        ]);

        // Handle hashtags
        if (!empty($validated['hashtags']) && is_array($validated['hashtags'])) {
            // Find or create hashtags
            $hashtagIds = collect($validated['hashtags'])->map(function ($tagName) {
                return Hashtag::firstOrCreate(['name' => strtolower($tagName)])->id;
            });

            // Attach hashtags to the tweet
            $tweet->hashtags()->sync($hashtagIds);
        }

        return redirect()->route('tweets.index');
    }

    public function show(Tweet $tweet)
    {
        Gate::authorize('view', $tweet);
        return Inertia::render('Tweets/Show', [
            'tweet' => $tweet->load(['user', 'likes', 'retweets', 'hashtags'])
        ]);
    }

    public function like(Request $request, Tweet $tweet)
    {
        Gate::authorize('like', $tweet);
        $request->user()->likes()->toggle($tweet);
        return back();
    }

    public function retweet(Request $request, Tweet $tweet)
    {
        Gate::authorize('retweet', $tweet);
        $request->user()->retweets()->toggle($tweet);
        return back();
    }
} 