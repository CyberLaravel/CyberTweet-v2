<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function store(Request $request, Tweet $tweet)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500'
        ]);

        $comment = $tweet->comments()->create([
            'content' => $validated['content'],
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'comment' => $comment->load('user'),
            'comments_count' => $tweet->comments()->count()
        ]);
    }

    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);
        
        $tweet = $comment->tweet;
        $comment->delete();

        return response()->json([
            'comments_count' => $tweet->comments()->count()
        ]);
    }
} 