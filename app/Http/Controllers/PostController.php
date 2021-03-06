<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    const PAGINATION_LIMIT = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(self::PAGINATION_LIMIT);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

       $request->validate(
            [
                'title' => 'required|string|max:30',
                'body'  => 'required|string'
            ],
            [
                'title.required' => 'タイトルは必須です。',
                'title.string'   => 'タイトルには文字列を入力してください。',
                'title.max'      => 'タイトルは30文字以下です。',
                'body.required'  => '記事は必須です。',
                'body.string'    => '記事には文字列を入力してください。',
            ]
        );

        Post::create([
            'title' => $request->title,
            'body'  => $request->body,
        ]);

        // リダイレクト
        // https://readouble.com/laravel/7.x/ja/responses.html

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\View\View
     * 
     * 
     * showメソッドでなぜこの書き方か？
     * https://readouble.com/laravel/7.x/ja/controllers.html
     * 
     * 暗黙の結合
     * https://qiita.com/KyuKyu/items/07326cd2146d5cd1cb2b 
     * https://qiita.com/KyuKyu/items/1b7359152ef174dee206
     * 
     * 
     * view 引数 
     * https://tektektech.com/views-helper
     */

    // public function show(Post $post)
    public function show($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('id',$id)->orderBy('created_at', 'desc')->get();

        // 暗黙の結合例
        // $comments = $post->comments()->orderBy('created_at', 'desc')->get();
        // Post::find($id)みたいなことを書くことなく{posts}を受け取ることができる

        return view('posts.show', [
            'post'     => $post,
            'comments' => $comments,
        ]);
    }
}
