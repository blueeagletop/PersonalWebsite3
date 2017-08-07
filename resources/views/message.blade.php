@extends('master') 

@section('title', "蓝鹰的博客——BlueEagle's boke")

@section('content')

<script charset="utf-8" src="public/admin/plugins/kindeditor/kindeditor-all-min.js"></script>
<script charset="utf-8" src="public/admin/plugins/kindeditor/lang/zh-CN.js"></script>

<script>
    KindEditor.ready(function (K) {
        window.editor = K.create('#editor_id');
    });
</script>

<style type="text/css"> 
    .input-submit{
        font-size: medium;
        width: 60px;
        height: 30px;
        color:#FFFFFF;
        background-color: #0066cc;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        border:none;
    }
</style> 

<div class="presentLocation"><p>&nbsp;当前位置&nbsp;：&nbsp;<a href="./">全部文章</a>&nbsp;>>&nbsp;全部留言&nbsp;</p></div>
<div class="article">

    @foreach($allMessages as $message)
    <br>
    <h2>{{$message->title}}</h2>
    <samp style="color: #666">{{$message->nickname}}
        @if($message->nickname == 'BlueEagle')
        <a style="color: red">[ Blogger ]</a>
        @elseif($message->nickname == '蓝鹰')
        <a style="color: red">[ 博主 ]</a>
        @else
        <a style="color: red">[ 访客 ]</a>
        @endif
        &nbsp;{{$message->created_at}}</samp>
    <p>{{$message->detail}}</p>
    <br><hr/>
    @endforeach

    <br>
    <form action="" method="post" class="form form-horizontal" id="form-message-add">
        <div class="row cl">
            <label class="form-label col-2">
                <h3>留言<a style="color:#C00;">（请勿发广告或人身攻击，一经发现将被永久禁言）</a></h3>

            </label>
            <div class="formControls col-8">
                <textarea name="editor" id="editor_id" style="width:100%;height:200px"  placeholder="您可以在这里发表评论"></textarea>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                @if($member != null)
                <div>
                    <br>验证码：<input class="validate_code_input" style="width: 78px;height: 40px;" type="text" placeholder="输入验证码" name='validate_code'/><br><br>
                </div>
                <div><img src="service/validate_code/create" class="bk_validate_code"/></div>
                <br><input class="input-submit" type="submit" value="&nbsp;提&nbsp;交&nbsp;">&nbsp;&nbsp;<br><br>[ {{$member->nickname}} ] 您好，谢谢您的宝贵意见<br>
                @else
                <br>抱歉，您需要<a style="color: red" href="login"> < 登录 > </a>之后才能发表评论，点击<a style="color: red" href="login"> < 此处 > </a>去登录页面，登录后<a style="color: red">刷新</a>本页面即可评论。<br><br>
                @endif
            </div>
        </div>
    </form>

    <br><br><br><br><br>

    <div class="footer">
        Copyright@ 蓝鹰&nbsp;&nbsp;|&nbsp;&nbsp;E-mail:blueeagletop@163.com&nbsp;&nbsp;|&nbsp;&nbsp;蓝鹰的个人博客3.0
    </div> 
</div>


@endsection 

@section('my-js')

<script type="text/javascript">
    $('.bk_validate_code').click(function () {
        $(this).attr('src', 'service/validate_code/create?random=' + Math.random());
    });
</script>

<script type="text/javascript" src="/blueeagle/htdocs/public/admin/js/jquery.form.js"></script>

<script type="text/javascript">
  $("#form-message-add").Validform({
    tiptype:2,
    callback:function(form){
      // form[0].submit();
      // var index = parent.layer.getFrameIndex(window.name);
      // parent.$('.btn-refresh').click();
      // parent.layer.close(index);
      $('#form-message-add').ajaxSubmit({
          type: 'post', // 提交方式 get/post
          url: 'service/addMessage', // 需要提交的 url
          dataType: 'json',
          data: {
            detail: editor.html(),
            validate_code: $('input[name=validate_code]').val(),
            _token: "{{csrf_token()}}"
          },
          success: function(data) {
            if(data == null) {
              layer.msg('服务端错误', {icon:2, time:2000});
              return;
            }
            if(data.status != 0) {
              layer.msg(data.message, {icon:2, time:2000});
              return;
            }

            layer.msg(data.message, {icon:1, time:2000});
            parent.location.reload();
            
            location.href = "member/index";             
          },
          error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
            layer.msg('ajax error', {icon:2, time:2000});
          },
          beforeSend: function(xhr){
            layer.load(0, {shade: false});
          },
        });
        return false;
    }
  });
</script>

@endsection 
