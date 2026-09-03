<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Tweet extends Model
{
    use HasFactory;

    protected $table ='tweets';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
    return $this->hasMany(Like::class);
    }
    public function comments()
    {
    return $this->hasMany(Comment::class);
    }
    public function images()
    {
        return $this->belongsToMany(Image::class,'tweet_images')
        ->using(TweetImage::class);
    }




}
