<?php

namespace App\Http\Controllers;

use App\Model\Article;
use App\Model\Comment;
use App\Model\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ArticleController extends Controller
{
    public function index(){
        return view('article/index')->with('articles',Article::orderBy('created_at','desc')->withCount(['comments','supports'])->paginate(6));
    }
    public function getArticleById($id){
        $article = Article::find($id);
        $article->load('comments');
        $article->load('user');
        if(empty($article)){
            return view('error');
        }else{
            return view('article/article')->with('article',$article);
        }
    }
    public function deleteArticleById($id){

        $article = Article::find($id);

        $this->authorize('delete',$article);
        $article->delete();
        return Redirect('/article');

    }
    public function createArticle(){
        return view('article/create');
    }
    public function saveArticle(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:100|min:1',
            'content' => 'required|string|min:10'
        ]);
        $user_id = Auth::id();
        $article = new Article();
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->user_id = $user_id;
        $article->save();
        return redirect('/article');
    }
    public function modifyArticleForm($id){
        $article = Article::find($id);
        if(empty($article)){
            return view('error');
        }else{
            return view('article.modify')->with('article',$article);
        }

    }
    public function imageUpload(Request $request){
        $path = $request->file('editormd-image-file')->store('img');
        return ['success'=>1,'message'=>'上传成功','url'=>asset("storage/$path")];
    }
    public function modifyArticle(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:100|min:1',
            'content' => 'required|string|min:10',
            'id'=>'required|numeric'
        ]);

        $article = Article::find($request->input('id'));
        $this->authorize('update',$article);
        $article->content = $request->input('content');
        $article->title = $request->input('title');
        $article->save();
        return Redirect::back();
    }

    public function comment(Article $article,Request $request){
        $this->validate($request,[
            'content'=>'required|min:3'
        ]);
        $comment = new Comment();
        $comment->user_id=Auth::id();
        $comment->content = $request->input('content');
        $article->comments()->save($comment);
        return Redirect::back();
    }

    public function support(Article $article){
        $param = [
            'user_id'=> Auth::id(),
            'article_id' => $article -> id,
        ];
        Support::firstOrCreate($param);
        return Redirect::back();
    }
    public function unSupport(Article $article){
        $article->support(Auth::id())->delete();
        return Redirect::back();
    }

}
