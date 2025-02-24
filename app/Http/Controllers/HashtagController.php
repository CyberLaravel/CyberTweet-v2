<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
use Inertia\Inertia;
use App\Http\Resources\HashtagResource;
use App\Http\Resources\TweetResource;
use Illuminate\Support\Facades\DB;

class HashtagController extends Controller
{
    public function index()
    {
        // Get all hashtags with pagination and proper counts
        $hashtags = Hashtag::select('hashtags.*')
            ->withCount('tweets')
            ->withCount(['tweets as users_count' => function($query) {
                $query->select(DB::raw('count(distinct user_id)'));
            }])
            ->orderBy('tweets_count', 'desc')
            ->paginate(12);

        // Get trending hashtags
        $trending = Hashtag::select('hashtags.*')
            ->leftJoin('hashtag_tweet', 'hashtags.id', '=', 'hashtag_tweet.hashtag_id')
            ->leftJoin('tweets', 'hashtag_tweet.tweet_id', '=', 'tweets.id')
            ->where('tweets.created_at', '>=', now()->subDays(7))
            ->groupBy('hashtags.id')
            ->havingRaw('COUNT(DISTINCT tweets.id) > 0')
            ->orderByRaw('COUNT(DISTINCT tweets.id) DESC')
            ->limit(6)
            ->get()
            ->each(function ($hashtag) {
                // Load counts for each hashtag
                $hashtag->loadCount('tweets');
                $hashtag->loadCount(['tweets as users_count' => function($query) {
                    $query->select(DB::raw('count(distinct user_id)'));
                }]);
            });

        return Inertia::render('Hashtags/Index', [
            'hashtags' => HashtagResource::collection($hashtags),
            'trending' => HashtagResource::collection($trending),
        ]);
    }

    public function show(Hashtag $hashtag)
    {
        $tweets = $hashtag->tweets()
            ->with(['user', 'likes', 'hashtags'])
            ->latest()
            ->paginate(10);

        $hashtag->loadCount('tweets');
        $hashtag->loadCount(['tweets as users_count' => function($query) {
            $query->select(DB::raw('count(distinct user_id)'));
        }]);

        return Inertia::render('Hashtags/Show', [
            'hashtag' => new HashtagResource($hashtag),
            'tweets' => TweetResource::collection($tweets),
        ]);
    }

    public function trending()
    {
        $trending = Hashtag::select('hashtags.*')
            ->leftJoin('hashtag_tweet', 'hashtags.id', '=', 'hashtag_tweet.hashtag_id')
            ->leftJoin('tweets', 'hashtag_tweet.tweet_id', '=', 'tweets.id')
            ->where('tweets.created_at', '>=', now()->subDays(7))
            ->groupBy('hashtags.id')
            ->havingRaw('COUNT(DISTINCT tweets.id) > 0')
            ->orderByRaw('COUNT(DISTINCT tweets.id) DESC')
            ->limit(10)
            ->get()
            ->each(function ($hashtag) {
                // Load counts for each hashtag
                $hashtag->loadCount('tweets');
                $hashtag->loadCount(['tweets as users_count' => function($query) {
                    $query->select(DB::raw('count(distinct user_id)'));
                }]);
            });

        return response()->json(HashtagResource::collection($trending));
    }
} 