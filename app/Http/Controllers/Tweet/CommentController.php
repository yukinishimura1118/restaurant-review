<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Tweet $tweet)
    {
        $comments = $tweet->comments()
            ->with('user')
            ->latest()
            ->get();

        return view('tweet.comments', [
            'tweet' => $tweet,
            'comments' => $comments,
        ]);
    }

    public function store(Request $request, Tweet $tweet)
    {
        $request->validate([
            'content' => 'required|max:500',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'tweet_id' => $tweet->id,
            'content' => $request->content,
        ]);

        return redirect()->route('tweet.comments', $tweet);
    }
}
