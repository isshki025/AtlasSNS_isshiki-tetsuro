<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\User;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            $posts = $user->posts()->orderBy('created_at', 'desc')->get();
            return view('users.other_profile', ['user' => $user, 'posts' => $posts]);
        } else {
            return redirect('/')->with('error', 'User not found');
        }
    }
    public function edit()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|min:2|max:12',
            'mail' => ['required', 'email', 'min:5', 'max:40', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|alpha_num|between:8,20|confirmed',
            'bio' => 'max:150',
            'images' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg',
        ], [
            'username.required' => 'ユーザー名は必須です。',
            'username.min' => 'ユーザー名は2文字以上入力してください。',
            'username.max' => 'ユーザー名は12文字以内で入力してください。',
            'mail.required' => 'メールアドレスは必須です。',
            'mail.email' => '正しいメールアドレスの形式で入力してください。',
            'mail.min' => 'メールアドレスは5文字以上入力してください。',
            'mail.max' => 'メールアドレスは40文字以内で入力してください。',
            'mail.unique' => '既に登録済みのメールアドレスです。',
            'password.required' => 'パスワードは必須です。',
            'password.string' => 'パスワードは文字列で入力してください。',
            'password.between' => 'パスワードは8文字以上、20文字以内で入力してください。',
            'password.alpha_num' => 'パスワードは英数字のみで入力してください。',
            'password.confirmed' => 'パスワードが確認用の入力と一致しません。',
            'password_confirmation.required' => 'パスワード確認用の入力は必須です。',
            'password_confirmation.same' => 'パスワード確認用の入力がパスワードと一致しません。',
            'bio.max' => '自己紹介文は150文字以内で入力してください。',
            'images.image' => '画像ファイルが対応していません。',
            'images.mimes:jpg,jpeg,png,bmp,gif,svg'  => '画像ファイルが対応していません。'
        ]);

        $user->username = $request->input('username');
        $user->mail = $request->input('mail');
        $user->bio = $request->input('bio');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('images')) {
            $path = $request->file('images')->store('public/images');
            $filename = basename($path);
            $user->images = $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function search(Request $request)
    {
        session()->put('return_url', url()->current());
        $keyword = $request->input('keyword');

        if (
            $keyword != ""
        ) {
            $users = User::where('username', 'LIKE', "%{$keyword}%")
                ->where('id', '!=', Auth::id())
                ->get();
        } else {
            $users = User::where('id', '!=', Auth::id())->get();
        }

        return view('users.search', ['users' => $users]);
    }

    // UsersController.php

    public function follow(Request $request, User $user)
    {
        $request->user()->followings()->attach($user->id);

        // Check if a return URL exists in the session
        if (session()->has('return_url')) {
            return redirect(session()->get('return_url'));
        }

        return back();
    }

    public function unfollow(Request $request, User $user)
    {
        $request->user()->followings()->detach($user->id);

        // Check if a return URL exists in the session
        if (session()->has('return_url')) {
            return redirect(session()->get('return_url'));
        }

        return back();
    }
    // public function unfollow(Request $request, User $user)
    // {
    //     $request->user()->following()->detach($user->id);

    //     return back();
    // }
}
