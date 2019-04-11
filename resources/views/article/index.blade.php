@extends('layout/nav')
@section('title','首页')
@section('content')
    <link rel="stylesheet" type="text/css" href="/css/index.css">
        @foreach($articles as $article)
        <a class="title text-info" href="/article/{{$article->id}}">{{$article->title}}</a><br>
        <span class="text text-info"> {{$article->created_at->toFormattedDateString()}}</span> &nbsp;&nbsp;
        <a class=" text-danger" href="/user/{{$article->user->id}}"> 作者：{{$article->user->name}}</a>
        <span class="label label-success"> 标签</span>&nbsp;&nbsp;
        <br>
        <div class="text content">
            {{mb_substr($article->content,0,90)}}...
        </div>
        <p class="text text-info">赞:  {{$article->supports_count ?: 0}} | 评论：{{$article->comments_count}}</p>
        <hr>
        <hr>
    @endforeach
    {{$articles->links()}}
@endsection


