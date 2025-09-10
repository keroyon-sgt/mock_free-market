<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

// use Laravel\Fortify\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function index()
    {

// echo '<br />index get = ';
// var_dump($_GET);
// echo '<br />post = ';
// var_dump($_POST);

        return view('login');
    }

    public function loginForm()
    {

// echo '<br />login_view get = ';
// var_dump($_GET);

// echo '<br />post = ';
// var_dump($_POST);

        return view('login');
    }



    // public function store(LoginRequest $request)
    public function store(LoginRequest $request)
    {
// echo '<br />here4! ';
// echo '<br />request = ';
// var_dump($request->only('email', 'password'));

// echo '<br />get = ';
// var_dump($_GET);
// echo '<br />post = ';
// var_dump($_POST);

        return $this->loginPipeline($request)->then(function ($request) {
            return app(LoginResponse::class);
        });
    }


    public function login(LoginRequest $request)
    {

        /* Database Insert */
        $user = $request->only([
            'email',
            'password',
        ]);

        // $user = $request->validate([
        //     'email' => ['required', 'email'],
        //     'password' => ['required'],
        // ]);

        // ログインに成功したとき
        if (Auth::attempt($user)) {
            $request->session()->regenerate();
            
            // return redirect()->intended('/')->with('message', 'ログインしました');
            return redirect('/')->with('message', 'ログインしました');
        }

        // 上記のif文でログインに成功した人以外(=ログインに失敗した人)がここに来る
        return redirect()->back()->with('message', 'メールアドレスかパスワードが間違っています。');


// echo '<br />user = ';
// var_dump($user);

// $user = User::find(1);

// echo '<br />user = ';
// var_dump($user);

        // Auth::login($user);
        // Auth::attempt($user);
// exit;
        // return redirect('admin')->with('message', 'ログインしました');
        // return redirect('login');
        // return view('login')->with('message', 'メールアドレスかパスワードが間違っています。');
    }
    
    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'ログアウトしました');

    }

}
