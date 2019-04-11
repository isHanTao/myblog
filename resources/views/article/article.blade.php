@extends('layout/nav')
@section('content')
    <link rel="stylesheet" type="text/css" href="/css/article.css">
    <link rel="stylesheet" href="/css/editormd.preview.css" />
        <h2 style="display: inline">{{$article->title}}</h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         @can('delete',$article)
            <a class="glyphicon glyphicon-remove" data-toggle="modal" href="#modal-id"></a>
            <div class="modal fade" id="modal-id">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">删除文章</h4>
                        </div>
                        <div class="modal-body">
                            文章得来不易，是否要删除该文章
                        </div>
                        <div class="modal-footer">
                            <a href="/article/delete/{{$article->id}}" class="" style="text-decoration:none;">残忍删除</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#" data-dismiss="modal" style="text-decoration:none;">再想想</a>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        @endcan
        @can('update',$article)
            <a href="/article/modify/{{$article->id}}" class="glyphicon glyphicon-pencil" style="text-decoration:none;"></a>
        @endcan
       <br><br>
        <span class="text text-info"> {{$article->created_at->toFormattedDateString()}}</span> &nbsp;&nbsp;
        <a class=" text text-danger" href="/user/{{$article->user->id}}"> 作者：{{$article->user->name}}</a>&nbsp;&nbsp;
        @if(!$article->support(\Illuminate\Support\Facades\Auth::id())->exists())
            <a class="text label label-success" href="/article/{{$article->id}}/support"> 赞</a>&nbsp;&nbsp;
        @else
            <a class="text label label-primary" href="/article/{{$article->id}}/unSupport"> 取消赞</a>&nbsp;&nbsp;
        @endif
        <br>
        <div id="test-editormd-view2">
            <textarea id="append-test" style="display:none;">{{$article->content}}</textarea>
        </div>
        <hr>
        <hr>
        <div class="col-md-10 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">评论</h3>
                </div>

                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            @foreach($article->comments as $comment)
                                <h5 class="text text-danger">{{$comment->created_at->toFormattedDateString()}} by {{$comment->user->name}}: </h5>
                                <div>&nbsp;&nbsp;&nbsp;&nbsp;{{$comment->content}}</div>
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">发表评论</h3>
                </div>
                <div class="panel-body">

                    <form action="/article/{{$article->id}}/comment" method="post" role="form">
                        @csrf
                        <div class="form-group">
                            <label for=""></label>
                            <textarea  rows="12" name="content" placeholder="发表评论..." style="width: 100%;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">发表</button>
                    </form>
                </div>
            </div>
        </div>
        @if(count($errors)>0)
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        @endif



@endsection
@section('script')
<script src="/js/jquery.min.js"></script>
<script src="/lib/marked.min.js"></script>
<script src="/lib/prettify.min.js"></script>

<script src="/lib/raphael.min.js"></script>
<script src="/lib/underscore.min.js"></script>
<script src="/lib/sequence-diagram.min.js"></script>
<script src="/lib/flowchart.min.js"></script>
<script src="/lib/jquery.flowchart.min.js"></script>
<script type="text/javascript" src="/js/editormd.js"></script>

<script>

    $(function() {
        var testEditormdView2;

        // $.get("test.md", function(markdown) {
        //
        //     testEditormdView = editormd.markdownToHTML("test-editormd-view", {
        //         markdown        : markdown ,//+ "\r\n" + $("#append-test").text(),
        //         //htmlDecode      : true,       // 开启 HTML 标签解析，为了安全性，默认不开启
        //         htmlDecode      : "style,script,iframe",  // you can filter tags decode
        //         //toc             : false,
        //         tocm            : true,    // Using [TOCM]
        //         //tocContainer    : "#custom-toc-container", // 自定义 ToC 容器层
        //         //gfm             : false,
        //         //tocDropdown     : true,
        //         // markdownSourceCode : true, // 是否保留 Markdown 源码，即是否删除保存源码的 Textarea 标签
        //         emoji           : true,
        //         taskList        : true,
        //         tex             : true,  // 默认不解析
        //         flowChart       : true,  // 默认不解析
        //         sequenceDiagram : true,  // 默认不解析
        //     });

            //console.log("返回一个 jQuery 实例 =>", testEditormdView);

            // 获取Markdown源码
            //console.log(testEditormdView.getMarkdown());

            //alert(testEditormdView.getMarkdown());
        // });

        testEditormdView2 = editormd.markdownToHTML("test-editormd-view2", {
            htmlDecode      : "style,script,iframe",  // you can filter tags decode
            emoji           : true,
            taskList        : true,
            tex             : true,  // 默认不解析
            flowChart       : true,  // 默认不解析
            sequenceDiagram : true,  // 默认不解析
            path: "/lib/",
        });
    });
</script>
@endsection