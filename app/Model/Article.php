<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Article extends Model
{
    //指定数据库名
    protected $table='article';

    //可注入的属性
    protected $fillable = ['title','content'];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    public function comments(){
        return $this->hasMany('App\Model\Comment')->orderBy('created_at','desc');
    }
    public function support($user_id){
        return $this->hasOne('App\Model\Support')->where('user_id',$user_id);
    }
    public function supports(){
        return $this->hasMany('App\Model\Support');
    }
}
