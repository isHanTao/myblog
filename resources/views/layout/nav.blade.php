<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title','Hant')</title>
    <link rel="stylesheet" type="text/css" href="/bootstrap-3.3.7-dist/css/bootstrap.css"/>
</head>
<body>

<div class="container-fluid">
    <div class="col-md-10 col-md-offset-1" style="margin-bottom: 25px">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
                <span class="glyphicon glyphicon-align-justify"></span>
            </button>
            <a href="/article" class="navbar-brand">HantBlog</a>
        </div>
        <nav id="bs-navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
            <ul class="nav navbar-nav">
                <li>
                <li class="active">
                    <a href="/article">主页</a>
                </li>
                <li>
                    <a href="/article/create">新建文章</a>
                </li>
                </li>
            </ul>
            <form class="navbar-form navbar-right" style="margin-right: 30px">
                <input type="text" style="width: 200px;">
                <button type="submit" class="btn btn-success">搜索</button>
            </form>
            <ul class="nav navbar-nav navbar-right" style="margin-right: 30px;">

                @if(\Illuminate\Support\Facades\Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/user/{{\Illuminate\Support\Facades\Auth::id()}}">我的主页</a></li>
                            <li><a href="#">个人设置</a></li>
                            <li><a href="/user/logout">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="/user/login">登陆</a></li>
                @endif
            </ul>
        </nav>
    </div>
    @if(\Illuminate\Support\Facades\Auth::check())
        <div class="col-md-2 " >
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class=" text text-success">个人信息</h4>
                </div>
                <div style="margin-left: 10%">
                    <h4 class="text text-info">Hant</h4>
                    <p class="text text-danger">关注 1 | 粉丝 1 | 文章 1</p>
                </div>

                <div class="panel-body">
                    <p class="text text-info"> 文章列表： </p>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-success">Dapibus ac facilisis in</a>
                        <a href="#" class="list-group-item list-group-item-info">Cras sit amet nibh libero</a>
                        <a href="#" class="list-group-item list-group-item-warning">Porta ac consectetur ac</a>
                        <a href="#" class="list-group-item list-group-item-danger">Vestibulum at eros</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @yield('content')
        </div>
    @else
        <div class="col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-2">
            @yield('content')
        </div>
    @endif




</div>
</body>
</html>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/bootstrap.js"></script>
@yield('script')

