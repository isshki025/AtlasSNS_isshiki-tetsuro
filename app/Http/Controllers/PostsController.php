<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;

class PostsController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user(); // 現在ログインしているユーザー
        $followingsCount = $user->followings()->count(); // フォロー数
        $followersCount = $user->followers()->count(); // フォロワー数
        $following_ids = $user->followings()->pluck('users.id')->toArray();
        $following_ids[] = $user->id;
        $posts = Post::whereIn('user_id', $following_ids)->orderBy('created_at', 'desc')->get();


        return view('posts.index', [
            'user' => $user,
            'followingsCount' => $followingsCount,
            'followersCount' => $followersCount,
            'posts' => $posts,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'post' => 'required|max:150',
        ], [
            'post.required' => '投稿内容は必須です。',
            'post.max' => '投稿内容は150文字以内で入力してください。',
        ]);

        $post = new Post;
        $post->user_id = Auth::id();
        $post->post = $request->post;
        $post->save();

        return redirect('/top');
    }
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'post' => 'required|max:150',
        ], [
            'post.required' => '投稿内容は必須です。',
            'post.max' => '投稿内容は150文字以内で入力してください。',
        ]);

        $post->post = $request->post;
        $post->save();

        return redirect('/top');
    }
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/top');
    }
}
