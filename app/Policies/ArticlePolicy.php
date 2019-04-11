<?php

namespace App\Policies;

use App\User;
use App\Model\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    //修改
    public function update(User $user, Article $article){
        return $user->id == $article->user_id;
    }
    //删除
    public function delete(User $user, Article $article){
        return $user->id == $article->user_id;
    }
}
