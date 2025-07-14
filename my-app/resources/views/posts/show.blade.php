@extends('layout.layout')

@section('content')
    <h1>show</h1>
    <p>ここに記載内容が表示されます。</p>
    <a href="{{ route('posts.index') }}" class="btn btn-primary mb-3">一覧に戻る</a>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">{{$post->content}}</p>
            </div>
        </div>
        @if (Auth::check() && Auth::id() === $post->user_id)
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-info">編集</a>
            <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">削除</button>
            </form>
        @endif
    <!-- コメント一覧 -->
    <h3>コメント一覧</h3>
        @foreach ($post->comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <p class="card-text">{{ $comment->content }}</p>
                    <p class="text-muted">投稿者: {{ $comment->user->name }} | 投稿日: {{ $comment->created_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>
        @endforeach
    <!-- コメントフォーム -->
    <h3>コメントを投稿する</h3>
    @auth
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="content" class="form-label">コメント内容</label>
                <textarea name="content" id="conttent" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">コメント投稿</button>
        </form>
    @else
        <p>コメントを投稿するにはログインしてください。</p>
    @endauth
@endsection