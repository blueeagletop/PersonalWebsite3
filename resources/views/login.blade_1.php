@extends('admin.master')

@section('title','BlueEagle.top访客注册')

@section('content')

<link rel="stylesheet" href="public/css/indexStyle.css">
<link rel="stylesheet" href="public/css/register.css">

<article class="page-container">
    <div>
        <br><br>
        <h1 style="color: #29d">BlueEagle.top访客中心</h1>
        <h2><a style="color: #666" href="register">注 册</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="choosed_title" > 登 录 </a></h2><br><br>
    </div>
    <form action="" method="post"  class="form form-horizontal" id="form-member-add">
        {{ csrf_field() }}
        <div class="register">
            <div class="weui_cell_hd"><label class="weui_label"></label></div>
            <div class="weui_cell_bd weui_cell_primary">
                用户名：&nbsp;&nbsp;&nbsp;<input class="register_input" type="text" placeholder="用于登录" name='username'/>
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
                验证码：&nbsp;&nbsp;&nbsp;&nbsp;<input class="validate_code_input" type="text" placeholder="请输入验证码" name='validateCode'/>
            </div>
            <div style="line-height: 100px"><img src="service/validate_code/create" class="bk_validate_code"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
        </div>
        <br>
        <div class="register">
            <div style="position:absolute; left:50%; transform:translate(-50%);">
                <input class="input-bootom" type="submit" value="&nbsp;登&nbsp;&nbsp;录&nbsp;">
            </div>
        </div>
    </form>
</article>
<br><br><br><br><br>
<a href="register" style="color:#000">还没帐号? 去注册</a>

@endsection

@section('my-js')

<script type="text/javascript">

    $('.bk_validate_code').click(function () {
        $(this).attr('src', 'service/validate_code/create?random=' + Math.random());
    });

    function onLoginClick() {
        // 帐号
        var username = $('input[name=username]').val();
        if (username.length == 0) {
            $('.bk_toptips').show();
            $('.bk_toptips span').html('帐号不能为空');
            setTimeout(function () {
                $('.bk_toptips').hide();
            }, 2000);
            return;
        }
        if (username.indexOf('@') == -1) { //手机号
            if (username.length != 11 || username[0] != 1) {
                $('.bk_toptips').show();
                $('.bk_toptips span').html('帐号格式不对!');
                setTimeout(function () {
                    $('.bk_toptips').hide();
                }, 2000);
                return;
            }
        } else {
            if (username.indexOf('.') == -1) {
                $('.bk_toptips').show();
                $('.bk_toptips span').html('帐号格式不对!');
                setTimeout(function () {
                    $('.bk_toptips').hide();
                }, 2000);
                return;
            }
        }
        // 密码
        var password = $('input[name=password]').val();
        if (password.length == 0) {
            $('.bk_toptips').show();
            $('.bk_toptips span').html('密码不能为空!');
            setTimeout(function () {
                $('.bk_toptips').hide();
            }, 2000);
            return;
        }
        if (password.length < 6) {
            $('.bk_toptips').show();
            $('.bk_toptips span').html('密码不能少于6位!');
            setTimeout(function () {
                $('.bk_toptips').hide();
            }, 2000);
            return;
        }
        // 验证码
        var validate_code = $('input[name=validate_code]').val();
        if (validate_code.length == 0) {
            $('.bk_toptips').show();
            $('.bk_toptips span').html('验证码不能为空!');
            setTimeout(function () {
                $('.bk_toptips').hide();
            }, 2000);
            return;
        }
        if (validate_code.length < 4) {
            $('.bk_toptips').show();
            $('.bk_toptips span').html('验证码不能少于4位!');
            setTimeout(function () {
                $('.bk_toptips').hide();
            }, 2000);
            return;
        }

        $.ajax({
            type: "POST",
            url: 'service/login',
            dataType: 'json',
            cache: false,
            data: {username: username, password: password, validate_code: validate_code, _token: "{{csrf_token()}}"},
            success: function (data) {
                if (data == null) {
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('服务端错误');
                    setTimeout(function () {
                        $('.bk_toptips').hide();
                    }, 2000);
                    return;
                }
                if (data.status != 0) {
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html(data.message);
                    setTimeout(function () {
                        $('.bk_toptips').hide();
                    }, 2000);
                    return;
                }

                $('.bk_toptips').show();
                $('.bk_toptips span').html('登录成功');
                setTimeout(function () {
                    $('.bk_toptips').hide();
                }, 2000);

                location.href = "member/index";
            },
            error: function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    }

</script>
@endsection


