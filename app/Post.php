<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // $fillable使い方
    // https://mebee.info/2020/05/12/post-11098/
    protected $fillable = [
        'title',
        'body',
    ];

    // laravelでのリレーションの説明
    // https://readouble.com/laravel/7.x/ja/eloquent-relationships.html
    // https://moripro.net/laravel-hasmany-belongsto/
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
