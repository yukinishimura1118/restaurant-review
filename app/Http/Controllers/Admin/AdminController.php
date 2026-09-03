<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tweet;

class AdminController extends Controller
{
    public function index()
{
    $users = User::orderBy('id')->get();
    $tweets = Tweet::with('user')->latest()->get();

    return view('admin.index', compact('users', 'tweets'));
}

    public function ban(User $user)
    {
        $user->is_banned = true;
        $user->save();

        return redirect()
            ->route('admin.index')
            ->with('success', 'ユーザーをBANしました。');
    }
    public function deleteTweet(Tweet $tweet)
    {
        $tweet->delete();

        return redirect()
            ->route('admin.index')
            ->with('success', 'つぶやきを削除しました。');
    }
}
