@extends('layout.layout')

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@section('content')
    <div class="container" style="max-width: 1000px;">
        <h1>Posts List</h1>
        <a href="{{route('posts.create')}}" class="btn btn-primary mb-3">新規投稿</a>
        <p>ここに投稿のリストが表示されます。</p>

        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->content}}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-secondary">詳細</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection