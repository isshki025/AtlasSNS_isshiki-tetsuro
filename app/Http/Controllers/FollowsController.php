<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //

    public function followList()
    {
        $user = Auth::user();
        $followings = $user->followings;

        $posts = [];
        foreach ($followings as $following) {
            if ($following->id !== $user->id) {
                foreach ($following->posts as $post) {
                    $posts[] = $post;
                }
            }
        }

        // Sort posts by created_at date
        usort($posts, function ($a, $b) {
            return $b->created_at <=> $a->created_at;
        });

        return view('follows.followList', ['posts' => $posts, 'followings' => $followings]);
    }

    public function followerList()
    {
        $user = Auth::user();
        $followers = $user->followers;

        $posts = [];
        foreach ($followers as $follower) {
            foreach ($follower->posts as $post) {
                if ($follower->id !== $user->id) {
                    $posts[] = $post;
                }
            }
        }

        // Sort posts by created_at date
        usort($posts, function ($a, $b) {
            return $b->created_at <=> $a->created_at;
        });

        return view('follows.followerList', ['posts' => $posts, 'followers' => $followers]);
    }
    public function followCount()
    {
        $user = Auth::user();
        $count = $user->followings()->count();
        return $count;
    }

    public function followerCount()
    {
        $user = Auth::user();
        $count = $user->followers()->count();
        return $count;
    }
    public function store(User $user)
    {
        Auth::user()->followings()->attach($user);
        return back();
    }

    public function destroy(User $user)
    {
        Auth::user()->followings()->detach($user);
        return back();
    }
}
