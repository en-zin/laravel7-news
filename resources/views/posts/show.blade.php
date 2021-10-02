@extends('layouts.app')

@section('title', 'News ' . $post->id)

@section('content')
    <section class="post-detail">
        <h3 class="post-title">{!! nl2br(e($post->title)) !!}</h3>
        <p class="post-body">{!! nl2br(e($post->body)) !!}</p>
    </section>
    <hr>
    @include('common.validation_errors')
    <section class="comments">
    @php
        $colors = ['blue', 'red', 'yellow'];
    @endphp
        <div class="form-comment">
            {{ Form::open(['route' => 'comments.store']) }}
                <div class="input-body">
                    {{ Form::hidden('post_id', $post->id) }}
                    <textarea name="body" class="post-it post-it-{{ $colors[array_rand($colors)] }}"></textarea>
                    {{ Form::submit('コメントを書く', ['class' => 'btn-submit']) }}
                </div>
            {{ Form::close() }}
        </div>
        @if (count($comments) > 0)
            @foreach ($comments as $comment)
                {{ Form::model($comment, ['route' => ['comments.destroy', $comment->id], 'method' => 'delete', 'class' => 'comment']) }}
                    <div class="input-body">
                        <div class="post-it post-it-{{ $colors[array_rand($colors)] }}">{!! nl2br(e($comment->body)) !!}</div>
                        {{ Form::submit('コメントを消す', ['class' => 'btn-submit']) }}
                    </div>
                {{ Form::close() }}
            @endforeach
        @endif
    </section>
@endsection
