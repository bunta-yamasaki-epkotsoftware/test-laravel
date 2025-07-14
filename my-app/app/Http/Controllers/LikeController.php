<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Post $post)
    {
        //ログインしていなければ、ログインページにリダイレクト
        if(!Auth::check()) {
            return redirect()->route('login');
        }

        // 既にいいねしているか確認
        $user = Auth::user();
        $like = $post->likes()->where('user_id', $user->id);

        if($like->exists()) {
            $like->delete(); // いいねを削除
        } else {
            $post->likes()->create(['user_id' => $user->id]); // いいねを追加
        }

        return redirect()->back();
    }
}
