@extends('layout.layout')

@section('content')
    <h1>Create List</h1>
    <p>ここに追加したい内容が表示されます。</p>
    <a href="{{ route('posts.index') }}" class="btn btn-primary">一覧に戻る</a>
        <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">内容</label>
            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">投稿</button>
    </form>
@endsection