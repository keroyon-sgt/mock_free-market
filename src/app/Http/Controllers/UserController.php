<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function profile()
    {
        
        return view('profile');
    }

    public function storeProfile(UserRequest $request)
    {
        $user = $request->only([
            'name',
            'email',
            'password',
            // 'password' => Hash::make($request->password),
        ]);
        
        $user['password']=Hash::make($request->password);

// echo '<br />user = ';
// var_dump($user);
// echo '<br />Hash:make = ';
// var_dump(Hash::make($request->password));

        User::create($user);

        return redirect('login');
    }
}
