<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    // 飲食店一覧
    public function index(Request $request)
    {
        $query = Restaurant::with('reviews');
        //店名検索
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

         // ジャンル検索
    if ($request->filled('genre')) {
        $query->where('genre', $request->genre);
    }

    // 住所検索
    if ($request->filled('address')) {
        $query->where('address', 'like', '%' . $request->address . '%');
    }

        $restaurants = $query->get();

        return view('restaurants.index', [
            'restaurants' => $restaurants,
        ]);
    }

    // 飲食店登録画面
    public function create()
    {
        return view('restaurants.create');
    }

    // 飲食店を登録
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'address' => 'required|max:255',
            'genre' => 'required|max:50',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurants', 'public');
        }

        Restaurant::create([
            'name' => $request->name,
            'address' => $request->address,
            'genre' => $request->genre,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('restaurants.index');
    }

    // 飲食店詳細画面
    public function show(Request $request, Restaurant $restaurant)
{
    $sort = $request->input('sort', 'newest');

    $reviewsQuery = $restaurant->reviews()->with('user');

    if ($sort === 'highest') {
        $reviewsQuery->orderBy('rating', 'desc');
    } elseif ($sort === 'lowest') {
        $reviewsQuery->orderBy('rating', 'asc');
    } else {
        $reviewsQuery->latest();
    }

    $reviews = $reviewsQuery->get();

    $averageRating = $restaurant->reviews->avg('rating');

    return view('restaurants.show', [
        'restaurant' => $restaurant,
        'averageRating' => $averageRating,
        'reviews' => $reviews,
        'sort' => $sort,
    ]);
}

    // 飲食店編集画面
    public function edit(Restaurant $restaurant)
    {
        return view('restaurants.edit', [
            'restaurant' => $restaurant,
        ]);
    }

    // 飲食店を更新

// 飲食店を更新
public function update(Request $request, Restaurant $restaurant)
{
    $request->validate([
        'name' => 'required|max:100',
        'address' => 'required|max:255',
        'genre' => 'required|max:50',
        'description' => 'nullable',
        'image' => 'nullable|image|max:2048',
    ]);

    // 画像が選択された場合
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('restaurants', 'public');

        $restaurant->image = $imagePath;
    }

    $restaurant->name = $request->name;
    $restaurant->address = $request->address;
    $restaurant->genre = $request->genre;
    $restaurant->description = $request->description;

    $restaurant->save();

    return redirect()->route('restaurants.index');
}



    // public function update(Request $request, Restaurant $restaurant)
    // {
    //     $request->validate([
    //         'name' => 'required|max:100',
    //         'address' => 'required|max:255',
    //         'genre' => 'required|max:50',
    //         'description' => 'nullable',
    //         'image' => 'nullable|image|max:2048',
    //     ]);

    //     $restaurant->update([
    //         'name' => $request->name,
    //         'address' => $request->address,
    //         'genre' => $request->genre,
    //         'description' => $request->description,
    //     ]);

    //     return redirect()->route('restaurants.index');
    // }

    // 飲食店を削除
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return redirect()->route('restaurants.index');
    }
}
