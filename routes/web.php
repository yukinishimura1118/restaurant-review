<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tweet\IndexController;
use App\Http\Controllers\Tweet\CreateController;
use App\Http\Controllers\Tweet\DeleteController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tweet\Update\IndexController as UpdateIndexController;
use App\Http\Controllers\Tweet\Update\PutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/restaurants/{restaurant}/reviews/create', [ReviewController::class, 'create'])
    ->middleware(['auth', 'banned'])
    ->name('reviews.create');

// レビュー編集画面
Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])
    ->middleware(['auth', 'banned'])
    ->name('reviews.edit');

// レビュー更新
Route::put('/reviews/{review}', [ReviewController::class, 'update'])
    ->middleware(['auth', 'banned'])
    ->name('reviews.update');



Route::post('/restaurants/{restaurant}/reviews', [ReviewController::class, 'store'])
    ->middleware(['auth', 'banned'])
    ->name('reviews.store');
Route::delete('/reviews/{review}',[ReviewController::class, 'destroy']
    )->name('reviews.destroy');
Route::get('/restaurants', [RestaurantController::class, 'index'])
    ->name('restaurants.index');
Route::get('/restaurants/create', [RestaurantController::class, 'create'])
    ->name('restaurants.create');
Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])
    ->name('restaurants.show');

Route::post('/restaurants', [RestaurantController::class, 'store'])
    ->name('restaurants.store');
// 飲食店編集画面
Route::get('/restaurants/{restaurant}/edit', [RestaurantController::class, 'edit'])
    ->name('restaurants.edit');

// 飲食店更新
Route::put('/restaurants/{restaurant}', [RestaurantController::class, 'update'])
    ->name('restaurants.update');

// 飲食店削除
Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy'])
    ->name('restaurants.destroy');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','banned'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/mypage', [ProfileController::class, 'mypage'])->name('mypage');
});

    Route::get('/tweet', IndexController::class)
    ->middleware(['auth','banned'])
    ->name('tweet.index');

    Route::middleware(['auth','banned'])->group(function(){
    Route::post('/tweet/create', CreateController::class)
    ->name('tweet.create');
    Route::get('/tweet/update/{tweetId}', UpdateIndexController::class)
    ->name('tweet.update.index');
    Route::get(
        '/tweet/{tweet}/comments',
        [\App\Http\Controllers\Tweet\CommentController::class, 'index']
    )->name('tweet.comments');

    Route::post(
        '/tweet/{tweet}/comments',
        [\App\Http\Controllers\Tweet\CommentController::class, 'store']
    )->name('tweet.comment.store');
    Route::delete('/tweet/delete/{tweetId}', DeleteController::class)
    ->name('tweet.delete');
    Route::post(
    '/tweet/{tweet}/like',
     \App\Http\Controllers\Tweet\LikeController::class
    )->name('tweet.like');
});


    Route::put('/tweet/update/{tweetId}', PutController::class)
    ->middleware(['auth','banned'])
    ->name('tweet.update.put');
require __DIR__.'/auth.php';

    Route::middleware(['auth', 'admin'])->group(function () {

    Route::delete('/admin/reviews/{review}', [AdminController::class, 'deleteReview'])
        ->name('admin.reviews.delete');

    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');

    Route::post('/admin/users/{user}/ban', [AdminController::class, 'ban'])
        ->name('admin.users.ban');

    Route::delete('/admin/tweets/{tweet}', [AdminController::class, 'deleteTweet'])
        ->name('admin.tweets.delete');

});

