@extends('layout.layout')

@section('content')
    <div class="container" style="max-width: 1000px;">
        <h1>show</h1>
        <p>ここに記載内容が表示されます。</p>
        <a href="{{ route('posts.index') }}" class="btn btn-primary mb-3">一覧に戻る</a>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->content}}</p>
                </div>
            </div>
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-info">編集</a>
    </div>
@endsection