<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Postモデルに対するクエリビルダーを作成
        $query = Post::query(); // これにより、柔軟な検索条件を追加できる
        // dd($request);

        //絞り込み検索
        // リクエストに "search" パラメータが存在し、値が空でない場合に処理を実行
        if($request->has('search') && $request->filled('search')) {
            $searchType = $request->input('search_type');
            // dd($searchType);
            $searchKeyword = $request->input('search');

            switch($searchType) {
                case 'prefix':
                    $query->where('title', 'like', $searchKeyword . '%');
                    break;
                case 'suffix':
                    $query->where('title', 'like', '%' . $searchKeyword);
                    break;
                case 'partial':
                    $query->where('title', 'like', '%' . $searchKeyword . '%');
                    break;
                default:
                    $query->where('title', 'like', '%' . $searchKeyword . '%');
                    break;
            }
        }

        //ソート処理
        // dd($request->input('sort', 'newest'));
        $sortType = $request->input('sort', 'newest');

        switch($sortType) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $posts = $query->paginate(3); // ページネーションを適用

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if(!Auth::check()){
            return redirect()->route('login');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // Post::create($request->all());
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(), //Auth::id()
        ]);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('comments.user')->findOrFail($id);
        // dd($post);
        $comments = $post->comments()->with('user')->paginate(1);
        return view('posts.show', ['post' => $post, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        // 認証されたユーザーが投稿の所有者であるかどうかを確認する
        if(Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access to edit this post.');
        }

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        // $post->update($request->all());
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return redirect()->route('posts.index', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        if(Auth::id() !== $post->user_id) {
            return redirect()->route('posts.index');
        }

        $post->delete();
        return redirect()->route('posts.index');
    }
}
