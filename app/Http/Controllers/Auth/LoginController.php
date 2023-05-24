<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'mail' => 'required',
                'password' => 'required',
            ], [
                'mail.required' => 'メールアドレスは必須です。',
                'password.required' => 'パスワードは必須です。',
            ]);

            $data = $request->only('mail', 'password');
            if (Auth::attempt($data)) {
                $previousUrl = $request->session()->pull('previous_url');
                return redirect()->intended($previousUrl ?? '/top');
            } else {
                return back()->withErrors([
                    'login' => 'メールアドレスまたはパスワードが違います。',
                ]);
            }
        }

        if (Auth::check()) {
            return redirect('/top');
        }

        return view("auth.login");
    }

    protected function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
