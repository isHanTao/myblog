<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function loginForm(){
        return view('auth.login');
    }
    public function login(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required|min:5|max:20'
        ]);
        $user = ['email'=>$request->input('email'),'password'=>$request->input('password')];
        $is_remember = boolval($request->input('is_remember'));
        if (Auth::attempt($user, $is_remember)){
            return Redirect('/article');
        }
        return Redirect::back()->withErrors('邮箱密码不匹配');
    }
    public function logout(){
        Auth::logout();
        return Redirect('/user/login');
    }
    public function register(Request $request){
        $this->validate($request,[
            'name'=>'required|min:1|unique:users,name',
            'email'=>'required|unique:users,email|email',
            'password'=>'required|min:5|max:10|confirmed',
        ]);
        $name = $request->input('name');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $user = new User();
        $user->name = $name;
        $user->email= $email;
        $user->password = $password;
        $user->save();
        return view('auth.login')->with('email',$email);
    }
}
