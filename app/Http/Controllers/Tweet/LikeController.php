<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __invoke(Tweet $tweet)
    {
        $user = Auth::user();

        $like = Like::where('user_id', $user->id)
            ->where('tweet_id', $tweet->id)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => $user->id,
                'tweet_id' => $tweet->id,
            ]);
        }

        return redirect()->route('tweet.index');
    }
}




