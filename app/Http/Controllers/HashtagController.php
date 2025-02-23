<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HashtagController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Hashtag::class);
        
        // Use raw DB query to avoid ambiguity with explicit ordering
        $hashtags = DB::table('hashtags')
            ->leftJoin('hashtag_tweet', 'hashtags.id', '=', 'hashtag_tweet.hashtag_id')
            ->select(
                'hashtags.id', 
                'hashtags.name', 
                'hashtags.created_at', 
                'hashtags.updated_at',
                DB::raw('COUNT(hashtag_tweet.tweet_id) as tweets_count')
            )
            ->groupBy(
                'hashtags.id', 
                'hashtags.name', 
                'hashtags.created_at', 
                'hashtags.updated_at'
            )
            ->orderBy('tweets_count', 'desc')
            ->get()
            ->map(function ($hashtag) {
                return [
                    'id' => $hashtag->id,
                    'name' => $hashtag->name,
                    'created_at' => $hashtag->created_at,
                    'updated_at' => $hashtag->updated_at,
                    'tweets_count' => $hashtag->tweets_count
                ];
            });

        return Inertia::render('Hashtags/Index', [
            'hashtags' => $hashtags
        ]);
    }

    public function show(Hashtag $hashtag)
    {
        Gate::authorize('view', $hashtag);
        $tweets = $hashtag->tweets()->with('user')->paginate(20);

        return Inertia::render('Hashtags/Show', [
            'hashtag' => $hashtag,
            'tweets' => $tweets
        ]);
    }

    public function trending()
    {
        Gate::authorize('viewAny', Hashtag::class);
        
        // Similar approach for trending hashtags
        $trendingHashtags = DB::table('hashtags')
            ->leftJoin('hashtag_tweet', 'hashtags.id', '=', 'hashtag_tweet.hashtag_id')
            ->select(
                'hashtags.id', 
                'hashtags.name', 
                'hashtags.created_at', 
                'hashtags.updated_at',
                DB::raw('COUNT(hashtag_tweet.tweet_id) as tweets_count')
            )
            ->groupBy(
                'hashtags.id', 
                'hashtags.name', 
                'hashtags.created_at', 
                'hashtags.updated_at'
            )
            ->orderBy('tweets_count', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($hashtag) {
                return [
                    'id' => $hashtag->id,
                    'name' => $hashtag->name,
                    'created_at' => $hashtag->created_at,
                    'updated_at' => $hashtag->updated_at,
                    'tweets_count' => $hashtag->tweets_count
                ];
            });

        return response()->json($trendingHashtags);
    }
} 