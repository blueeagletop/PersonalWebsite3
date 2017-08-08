@extends('admin.master')

@section('title','BlueEagle.top后台登录')

@section('content')

<link rel="stylesheet" href="../public/css/indexStyle.css">
<link rel="stylesheet" href="../public/css/register.css">

<article class="page-container">
    <div>
        <br><br>
        <h1 style="color: #29d"><a style="color: #29d" href="./">BlueEagle.top</a>后台登录</h1><br><br>
    </div>
    
	<form action="" method="post"  class="form form-horizontal" id="form-login">
            {{ csrf_field() }}
	<div class="register">
            <div class="weui_cell_hd"><label class="weui_label"></label></div>
            <div class="weui_cell_bd weui_cell_primary">
                账号：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="register_input" type="text" placeholder="请输入用户名或邮箱" name='username'/>
            </div>
        </div>
        <div class="register">
            <div class="weui_cell_hd"><label class="weui_label"></label></div>
            <div class="weui_cell_bd weui_cell_primary">
                密码：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="register_input" type="password" placeholder="不少于6位" name='password'>
            </div>
        </div>
        <div class="validate_code">
            <div>
                验证码：&nbsp;&nbsp;&nbsp;&nbsp;<input class="validate_code_input" type="text" placeholder="请输入验证码" name='validate_code'/>
            </div>
            <div style="line-height: 100px"><img src="../service/validate_code/create" class="bk_validate_code"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
        </div>
        <br>
        <div class="register">
            <div style="position:absolute; left:50%; transform:translate(-50%);">
                <input class="input-bootom" type="submit" value="&nbsp;登&nbsp;&nbsp;录&nbsp;">
            </div>
        </div>
	</form>
</article>

@endsection

@section('my-js')

<script type="text/javascript">
    $('.bk_validate_code').click(function () {
        $(this).attr('src', '../service/validate_code/create?random=' + Math.random());
    });
</script>

<script type="text/javascript">
  $("#form-login").Validform({
    tiptype:2,
    callback:function(form){
      // form[0].submit();
      // var index = parent.layer.getFrameIndex(window.name);
      // parent.$('.btn-refresh').click();
      // parent.layer.close(index);
      $('#form-login').ajaxSubmit({
          type: 'post', // 提交方式 get/post
          url: 'doLogin', // 需要提交的 url
          dataType: 'json',
          data: {
            username: $('input[name=username]').val(),
            password: $('input[name=password]').val(),
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
            
            location.href = "index";             
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


