@if(!\Illuminate\Support\Facades\Auth::check())
    <a class="btn btn-default" href="/user/login" >
        登陆后可关注
    </a>
@elseif($target_user->id != \Illuminate\Support\Facades\Auth::id())
    <div>
        @if(!\Illuminate\Support\Facades\Auth::user()->hasStar($target_user->id))
            <div class="btn btn-default like-button" like-value="1" like-user="{{$target_user->id}}">
                关注
            </div>
        @else
            <div class="btn btn-default like-button" like-value="0" like-user="{{$target_user->id}}">
                取消关注
            </div>
        @endif
    </div>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('.like-button').off().on('click',function (event) {
                alert('操作成功');
                var target = $(event.target);
                var current_like = target.attr('like-value');
                var user_id = target.attr('like-user');
                if (current_like == 0){
                    $.ajax({
                        url:"/user/"+user_id+"/unfan",
                        method: 'POST',
                        dataType: 'json',
                        success:function (data) {
                            target.attr('like-value',1);
                            target.text('关注');
                        }
                    })
                }else {
                    $.ajax({
                        url:"/user/"+user_id+"/fan",
                        method: 'POST',
                        dataType: 'json',
                        success:function (data) {
                            target.attr('like-value',0);
                            target.text('取消关注');
                        }
                    })
                }
            });
        })
    </script>
@endif