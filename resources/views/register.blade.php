@extends('admin.masterOut')

@section('title','BlueEagle.top访客注册')

@section('content')

<link rel="stylesheet" href="public/css/indexStyle.css">
<link rel="stylesheet" href="public/css/register.css">

<article class="page-container">
    <div>
        <br><br>
        <h1 style="color: #29d"><a style="color: #29d" href="./">BlueEagle.top</a>访客中心</h1>
        <h2><a class="choosed_title" href="register">注 册</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="color: #666" href="login"> 登 录 </a></h2><br><br>
    </div>
    <form action="" method="post"  class="form form-horizontal" id="form-member-add">
        {{ csrf_field() }}
        <div class="register">
            <div><label class="weui_label"></label></div>
            <div class="weui_cell_bd weui_cell_primary">
                称呼：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="register_input" type="text" placeholder="起个好听的名字吧" name='register_nickname'/>
            </div>
        </div>
        <div class="register">
            <div class="weui_cell_hd"><label class="weui_label"></label></div>
            <div class="weui_cell_bd weui_cell_primary">
                用户名：&nbsp;&nbsp;&nbsp;<input class="register_input" type="text" placeholder="用于登录" name='register_username'/>
            </div>
        </div>
        <div class="register">
            <div class="weui_cell_hd"><label class="weui_label"></label></div>
            <div class="weui_cell_bd weui_cell_primary">
                邮箱：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="register_input" type="text" placeholder="用于找回密码" name='register_email'/>
            </div>
        </div>
        <div class="register">
            <div class="weui_cell_hd"><label class="weui_label"></label></div>
            <div class="weui_cell_bd weui_cell_primary">
                密码：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="register_input" type="password" placeholder="不少于6位" name='register_password'>
            </div>
        </div>
        <div class="register">
            <div class="weui_cell_hd"><label class="weui_label"></label></div>
            <div class="weui_cell_bd weui_cell_primary">
                确认密码：<input class="register_input" type="password" placeholder="不少于6位" name='confirm'/>
            </div>
        </div>
        <div class="validate_code">
            <div>
                验证码：&nbsp;&nbsp;&nbsp;&nbsp;<input class="validate_code_input" type="text" placeholder="请输入验证码" name='validate_code'/>
            </div>
            <div style="line-height: 70px"><img src="service/validate_code/create" class="bk_validate_code"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
        </div>

        <div class="weui_cells_tips"><input name="Fruit" type="checkbox" value="" checked="checked"/> 我已阅读并同意<a style="color: blue" href="registerNotice">《BlueEagle.top注册须知》</a></div><br><br>
        <div class="register">
            <div style="position:absolute; left:50%; transform:translate(-50%);">
                <input class="input-bootom" type="submit" value="&nbsp;注&nbsp;&nbsp;册&nbsp;">
            </div>
        </div>
    </form>
</article>

@endsection

@section('my-js')

<script type="text/javascript">
    $('.bk_validate_code').click(function () {
        $(this).attr('src', 'service/validate_code/create?random=' + Math.random());
    });
</script>

<script type="text/javascript">
    $("#form-member-add").Validform({
        tiptype: 2,
        callback: function (form) {
            // form[0].submit();
            // var index = parent.layer.getFrameIndex(window.name);
            // parent.$('.btn-refresh').click();
            // parent.layer.close(index);
            $('#form-member-add').ajaxSubmit({
                type: 'post', // 提交方式 get/post
                url: 'service/register', // 需要提交的 url
                dataType: 'json',
                data: {
                    nickname: $('input[name=register_nickname]').val(),
                    username: $('input[name=register_username]').val(),
                    email: $('input[name=register_email]').val(),
                    password: $('input[name=register_password]').val(),
                    confirm: $('input[name=confirm]').val(),
                    validate_code: $('input[name=validate_code]').val(),
                    _token: "{{csrf_token()}}"
                },
                success: function (data) {
                    if (data == null) {
                        layer.msg('服务端错误', {icon: 2, time: 2000});
                        return;
                    }
                    if (data.status != 0) {
                        layer.msg(data.message, {icon: 2, time: 2000});
                        return;
                    }

                    layer.msg(data.message, {icon: 1, time: 2000});
                    parent.location.reload();
                    
                    location.href = "member/index";  
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                    layer.msg('注册成功，但发送邮件至注册邮箱失败。', {icon: 2, time: 9000});
                    
                    location.href = "member/index";  
                },
                beforeSend: function (xhr) {
                    layer.load(0, {shade: false});
                },
            });
            return false;
        }
    });
</script>
@endsection