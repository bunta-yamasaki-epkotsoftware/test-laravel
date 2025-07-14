@extends('layout.layout')

@section('content')
    <h2>お問い合わせ完了</h2>
    <p>メールが正常に送信されました</p>
    <p>ご利用ありがとうございました。</p>
    <a href="{{ route('posts.index') }}" class="btn btn-primary">投稿一覧に戻る</a>
@endsection