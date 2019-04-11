<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(User $user){
        $user = User::withCount(['stars','fans','articles'])->find($user->id);
        $articles = $user->articles()->orderBy('created_at','desc')->withCount(['comments','supports'])->take(10)->get();

        $fans = $user->fans;
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','articles'])->get();

        $stars = $user->stars;
        $follows = [];
        foreach ($stars as $star){
            array_push($follows,$star->star_id);
        }
        $susers = User::whereIn('id',$follows)->withCount(['stars','fans','articles'])->get();
        return view('user.show',compact(['user','articles','susers','fusers']));
    }

    public function setting(){

    }

    public function settingStore(){

    }
    public function fan(User $user){
        $me = Auth::user();
        $me->doFan($user->id);
        return [
            'error' => 0,
            'msg' => '关注成功'
        ];
    }
    public function unfan(User $user){
        $me = Auth::user();
        $me->doUnFan($user->id);
        return [
            'error' => 0,
            'msg' => '取消关注成功'
        ];
    }
}
