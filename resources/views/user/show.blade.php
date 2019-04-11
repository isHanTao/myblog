@extends('layout.nav')
@section('title','个人主页')
@section('content')
    <h3 class="display-4">{{$user->name}}</h3>
    <p class="text text-danger">关注 {{$user->stars_count ?: 0}} | 粉丝 {{$user->fans_count ?: 0}} | 文章 {{$user->articles_count ?: 0}}</p>
    @include('layout.like',['target_user'=>$user])
    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#article" aria-controls="article" role="tab" data-toggle="tab">文章</a></li>
            <li role="presentation"><a href="#fans" aria-controls="fans" role="tab" data-toggle="tab">粉丝</a></li>
            <li role="presentation"><a href="#follow" aria-controls="follow" role="tab" data-toggle="tab">关注</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="article">
                <br>
                <br>
                @foreach($articles as $article)
                    <a class="title text-info" style="font-size: 20px;text-decoration:none; " href="/article/{{$article->id}}">{{$article->title}}</a><br>
                    <a class=" text-danger" href="/user/{{$article->user->id}}"> 作者：{{$article->user->name}}</a> &nbsp;&nbsp;
                    <span class="text text-info"> {{$article->created_at->diffForHumans()}}</span>
                    <span class="label label-success"> 标签</span>&nbsp;&nbsp;&nbsp;
                    <br>
                    <div class="text content">
                        {{mb_substr($article->content,0,90)}}...
                    </div>
                    <p class="text text-info">赞: {{$article->supports_count ?: 0}} | 评论：{{$article->comments_count ?:0}}</p>
                    <hr>
                @endforeach
            </div>
            <div role="tabpanel" class="tab-pane" id="fans">
                @foreach($fusers as $user)
                    <h4 class="text text-info">{{$user->name}}</h4>
                    <p class="text text-info">关注: {{$user->stars_count ?: 0}} | 粉丝：{{$user->fans_count ?:0}}</p>
                    @include('layout.like',['target_user'=>$user])
                @endforeach
            </div>
            <div role="tabpanel" class="tab-pane" id="follow">
                @foreach($susers as $follow)
                    <h4 class="text text-info">{{$follow->name}}</h4>
                    <p class="text text-info">关注: {{$follow->stars_count ?: 0}} | 粉丝：{{$follow->fans_count ?:0}}</p>
                    @include('layout.like',['target_user'=> $follow])
                @endforeach
            </div>
        </div>

    </div>
@endsection
