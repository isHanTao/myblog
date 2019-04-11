<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    protected $fillable = ['star_id','user_id'];
    //获取粉丝用户信息
    public function fuser(){
        return $this->hasOne(\App\User::class,'id','fan_id');
    }
    //获取关注用户信息
    public function suser(){
        return $this->hasOne(\App\User::class,'id','star_id');
    }
}
