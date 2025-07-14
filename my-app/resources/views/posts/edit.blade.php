@extends('layout.layout')

@section('content')
    <h1>edit</h1>
    <p>ここに変更したい内容が表示されます。</p>
    <a href="{{ route('posts.index') }}" class="btn btn-primary">一覧に戻る</a>
    <form action="{{ route('posts.update', ['post' => $post]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" class="form-control" value="{{$post->title}}" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">内容</label>
            <textarea class="form-control" id="content" name="content" rows="3" required>{{$post->content}}</textarea>
        </div>
        <button type="submit" class="btn btn-success">更新</button>
        <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-primary">戻る</a>
    </form>
@endsection