<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PostController@index');


// onlyについての解説
// http://raining.bear-life.com/laravel/routeresource%E3%81%AE%E3%80%8Conly%E3%80%8D%E3%81%A8%E3%80%8Cexcept%E3%80%8D%E3%81%A7%E3%83%AA%E3%82%AF%E3%82%A8%E3%82%B9%E3%83%88%E3%82%92%E5%88%B6%E9%99%90%E3%81%99%E3%82%8B

Route::resource('posts', 'PostController')->only([
    'index',
    'store',
    'show',
]);


Route::resource('comments', 'CommentController')->only([
    'store',
    'destroy',
]);
