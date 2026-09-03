<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Review;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $tweets = Tweet::with('user')->get();
        $reviews = Review::with(['user', 'restaurant'])->get();

        return view('admin.index', [
            'users' => $users,
            'tweets' => $tweets,
            'reviews' => $reviews,
        ]);
    }

    public function ban(User $user)
    {
        if ($user->is_admin) {
            abort(403);
        }

        $user->is_banned = true;
        $user->save();

        return redirect()->route('admin.index');
    }

        public function deleteTweet(Tweet $tweet)
       {
         $tweet->delete();

         return redirect()->route('admin.index');
       }
       public function deleteReview(Review $review)
       {
        $review->delete();

         return redirect()->route('admin.index');
        }
}
