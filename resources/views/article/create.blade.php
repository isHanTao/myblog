@extends('layout.nav')
@section('title','创建文章')

@section('content')
    <link rel="stylesheet" type="text/css" href="/css/editormd.css">

    <h1> 创建文章</h1>
    <form class="form-horizontal" method="post" action="/article/save">
        @csrf
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">题目</label>
            <div class="col-sm-10" style=" padding-right: 15px;padding-left: 15px; width: 75%">
                <input type="text" class="form-control" id="inputEmail3" name="title" placeholder="题目">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">类容</label>
            <div class="col-sm-10">
                <div id="content" style="margin: 0px;">
                    <textarea style="display: none" name="content"></textarea>
                </div>
            </div>

                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">提交</button>
                </div>
            </div>
    </form>
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
    <script type="text/javascript" src="/js/editormd.js"></script>
    <script type="text/javascript">
        $("#content").width('100%');
        var testEditor;
        $(function () {
            testEditor = editormd("content", {
                width: "90%",
                height: 640,
                syncScrolling: "single",
                path: "/lib/",
                emoji: true,//emoji表情，默认关闭
                taskList: true,
                tocm: true, // Using [TOCM]
                tex: true,// 开启科学公式TeX语言支持，默认关闭

                flowChart: true,//开启流程图支持，默认关闭
                sequenceDiagram: true,//开启时序/序列图支持，默认关闭,

                dialogLockScreen : false,//设置弹出层对话框不锁屏，全局通用，默认为true
                dialogShowMask : false,//设置弹出层对话框显示透明遮罩层，全局通用，默认为true
                dialogDraggable : false,//设置弹出层对话框不可拖动，全局通用，默认为true
                dialogMaskOpacity : 0.4, //设置透明遮罩层的透明度，全局通用，默认值为0.1
                dialogMaskBgColor : "#000",//设置透明遮罩层的背景颜色，全局通用，默认为#fff

                codeFold: true,

                imageUpload : true,
                imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                imageUploadURL : "/article/imageUpload",
                // 上传成功
                onload: function () {
                    //console.log('onload', this);
                    //this.fullscreen();
                    //this.unwatch();
                    //this.watch().fullscreen();
                    //this.width("100%");
                    //this.height(480);
                    //this.resize("100%", 640);
                },
            });
        });
    </script>
@endsection