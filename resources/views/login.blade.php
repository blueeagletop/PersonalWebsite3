<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>访客登录</title>
        <link rel="stylesheet" href="public/css/indexStyle.css">
        <link rel="stylesheet" href="public/css/register.css">
    </head>
    <body>
        <div>
            <div>
                <br><br>
                <h1 style="color: #29d">BlueEagle.top访客中心</h1>
                <h2><a style="color: #666" href="register">注 册</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="choosed_title" > 登 录 </a></h2>
            </div>
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
        </div>
        <br>
        <div class="bottom_area">
            <a style="color: #FFF" href="javascript:" onclick="onRegisterClick();"> 登&nbsp;&nbsp;&nbsp;&nbsp;录 </a>
        </div><br><br><br><br><br>
        <a href="register" style="color:#000">还没帐号? 去注册</a>

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
    </body>
</html>