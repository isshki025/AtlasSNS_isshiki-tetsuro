<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            $request->validate(
                [
                    'username' => 'required|min:2|max:12',
                    'mail' => 'required|email|min:5|max:40|unique:users',
                    'password' => 'required|string|between:8,20',
                    'password_confirmation' => 'required|same:password'
                ],
                [
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
                    'password_confirmation.required' => 'パスワード確認用の入力は必須です。',
                    'password_confirmation.same' => 'パスワード確認用の入力がパスワードと一致しません。',
                ]
            );

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

            return redirect('added')->with('username', $username);
        }
        return view('auth.register');
    }

    public function added()
    {
        return view('auth.added');
    }
}
