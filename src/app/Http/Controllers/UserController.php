<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Item;
use App\Models\Purchase;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\profileRequest;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

use App\Http\Controllers\Controller;




class UserController extends Controller
{
    
    public function registerForm()
    {
        
        return view('register');
    }

    public function register(RegisterRequest $request)
    {

        // $user = $request->only([
        //     'name',
        //     'email',
        //     'password',
        //     // 'password' => Hash::make($request->password),
        // ]);
        
        // $user['password']=Hash::make($request->password);

// echo '<br />user = ';
// var_dump($user);
// echo '<br />Hash:make = ';
// var_dump(Hash::make($request->password));
// echo '<br />register ';
// exit;

        // User::create($user);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // if (!Auth::check()) {
        //     $user = $request->only([
        //         'email',
        //         'password',
        //     ]);
        //     // return redirect('login'); // 未ログインの場合はログインページへリダイレクト
        //     if (Auth::attempt($user)) {
        //         $request->session()->regenerate();
        //         // return redirect()->intended('/')->with('message', 'ログインしました');
        //         return redirect('/')->with('message', 'ログインしました');
        //     }
        // }
        
        // return back();
        return redirect('verify')->with('message', '登録しました');
    }
    
public function verify()
    {
        // メールを送る処理
        return view('verify');
    }
    
public function verification()
    {
        
        return redirect('profile')->with('message', '認証しました');
    }
    

    public function profileForm()
    {
        if (Auth::check()) {
            $user = Auth::user(); // ログインユーザーのモデルを取得
        } else {
            return redirect('/login'); // 未ログインの場合はログインページへリダイレクト
        }

        if(!$user->portrait_path){ $user->portrait_path='unknown.jpg'; }
echo '<br />profileForm ';
// echo '<br /><br />get = ';
// var_dump($_GET);
// echo '<br /><br />post = ';
// var_dump($_POST);

        return view('profile', compact('user'));
    }

    public function profileSave(Request $request)   //profileRequest
    {
        if (Auth::check()) {
            $user = Auth::user(); // ログインユーザーのモデルを取得
        } else {
            return redirect('/login'); // 未ログインの場合はログインページへリダイレクト
        }
        
        if($request->file('portrait')){
            $image_path = $request->file('portrait')->store('public');
            $user->portrait_path = basename($image_path);
        }
        
// echo '<br />image_path = ';
// var_dump(basename($image_path));
// exit;

        $user->name = $request->name;
        $user->postal_code = $request->postal_code;
        $user->address = $request->address;
        $user->building = $request->building;

        if( $user->isDirty() ){ $user->save(); }
        
        // return back();
        return redirect('mypage');
    }

    //<div>{!! Form::file('document', ['class' => 'form-control']) !!}</div>

// echo '<br />user = ';
// var_dump($user);
// echo '<br />Hash:make = ';
// var_dump(Hash::make($request->password));

    public function mypage(Request $request)
    {
        
// echo '<br />session(user_id) = ';
// var_dump(session('user_id'));
        if (Auth::check()) {
            $user = Auth::user(); // ログインユーザーのモデルを取得
            // $user->id, $user->name, $user->email などでプロパティにアクセス可能
        } else {
            return redirect('login'); // 未ログインの場合はログインページへリダイレクト
        }

        if(!$user->portrait_path){ $user->portrait_path='unknown.jpg'; }

// echo '<br />user = ';
// var_dump($user);
// echo '<br />user->portrait_path = ';
// var_dump($user->portrait_path);
        
        if($request['page']=='buy'){
            $items = Purchase::with('Item')->where('user_id', $user['id'])->get();

        }else{
            $items = Item::where('user_id', $user['id'])->get();
        }
        
// echo '<br />items = ';
// var_dump($items);

        // $user =array('id'=>'id', 'name'=>'ユーザー名', 'portrait_path'=>'path');
        // $items =array();

// echo '<br /><br />request[item_id] = ';
// var_dump($request['page']);
// echo '<br /><br />get = ';
// var_dump($_GET);

        return view('mypage', compact('user', 'items', 'request'));
    }




}
