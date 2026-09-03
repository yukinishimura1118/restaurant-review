<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // レビュー投稿画面
    public function create(Restaurant $restaurant)
    {
        return view('reviews.create', [
            'restaurant' => $restaurant,
        ]);
    }

    // レビューを保存
    public function store(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|max:1000',
            'image' => 'nullable|image|max:2048',
        ], [
            'rating.required' => '評価を選択してください。',
            'rating.integer' => '評価は数字で入力してください。',
            'rating.min' => '評価は1以上にしてください。',
            'rating.max' => '評価は5以下にしてください。',
            'comment.required' => 'レビューを入力してください。',
            'comment.max' => 'レビューは1000文字以内で入力してください。',
            'image.image' => '画像ファイルを選択してください。',
            'image.max' => '画像は2MB以内にしてください。',
        ]);

        // 画像を保存
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reviews', 'public');
        }

        Review::create([
            'restaurant_id' => $restaurant->id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'image' => $imagePath,
        ]);

        return redirect()->route('restaurants.show', $restaurant);
    }

    // レビュー編集画面
    public function edit(Review $review)
    {
        if (auth()->id() !== $review->user_id) {
            abort(403);
        }

        return view('reviews.edit', [
            'review' => $review,
        ]);
    }

    // レビュー更新
public function update(Request $request, Review $review)
{
    if (auth()->id() !== $review->user_id) {
        abort(403);
    }

    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|max:1000',
        'image' => 'nullable|image|max:2048',
    ], [
        'rating.required' => '評価を選択してください。',
        'rating.integer' => '評価は数字で入力してください。',
        'rating.min' => '評価は1以上にしてください。',
        'rating.max' => '評価は5以下にしてください。',
        'comment.required' => 'レビューを入力してください。',
        'comment.max' => 'レビューは1000文字以内で入力してください。',
        'image.image' => '画像ファイルを選択してください。',
        'image.max' => '画像は2MB以内にしてください。',
    ]);

    // 画像を削除する場合
    if ($request->delete_image && $review->image) {
        \Storage::disk('public')->delete($review->image);

        $review->image = null;
    }

    // 新しい画像を選択した場合
    if ($request->hasFile('image')) {

        // 古い画像を削除
        if ($review->image) {
            \Storage::disk('public')->delete($review->image);
        }

        // 新しい画像を保存
        $review->image = $request->file('image')->store('reviews', 'public');
    }

    $review->rating = $request->rating;
    $review->comment = $request->comment;

    $review->save();

    return redirect()->route(
        'restaurants.show',
        $review->restaurant_id
    );
}

    // レビュー削除
    public function destroy(Review $review)
    {
        if (auth()->id() !== $review->user_id) {
            abort(403);
        }

        $restaurantId = $review->restaurant_id;

        $review->delete();

        return redirect()->route(
            'restaurants.show',
            $restaurantId
        );
    }
}
