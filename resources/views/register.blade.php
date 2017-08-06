<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>注册成为会员</title>
        <link rel="stylesheet" href="public/css/indexStyle.css">
        <link rel="stylesheet" href="public/css/register.css">
    </head>
    <body>
        <div>
            <div>
                <br><br>
                <h1 style="color: #29d">BlueEagle.top访客中心</h1>
                <h2><a class="choosed_title" href="register">注 册</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="color: #666" href="login"> 登 录 </a></h2>
            </div>
            <div class="register">
                <div><label class="weui_label"></label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    称呼：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="register_input" type="text" placeholder="起个好听的名字吧" name='nickname'/>
                </div>
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
                    邮箱：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="register_input" type="text" placeholder="用于找回密码" name='email'/>
                </div>
            </div>
            <div class="register">
                <div class="weui_cell_hd"><label class="weui_label"></label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    密码：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="register_input" type="password" placeholder="不少于6位" name='password'>
                </div>
            </div>
            <div class="register">
                <div class="weui_cell_hd"><label class="weui_label"></label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    确认密码：<input class="register_input" type="password" placeholder="不少于6位" name='confirmPassword'/>
                </div>
            </div>
            <div class="validate_code">
                <div>
                    验证码：&nbsp;&nbsp;&nbsp;&nbsp;<input class="validate_code_input" type="text" placeholder="请输入验证码" name='validateCode'/>
                </div>
                <div style="line-height: 100px"><img src="service/validate_code/create" class="bk_validate_code"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
            </div>
        </div>
        <div class="weui_cells_tips">我已阅读并同意<a style="color: blue">《BlueEagle.top注册协议》</a></div><br>
<!--        <div class="bottom_area" >
            <a style="color: #FFF" href="javascript:" onclick="onRegisterClick();"> 注&nbsp;&nbsp;&nbsp;&nbsp;册 </a>
        </div>-->
        <div class="bottom_area" style="background-color: #D3D6DA;width: 150px;">
            <a style="color: #FFF;font-size: small"> 暂 不 开 放 注 册 </a>
        </div>

        <br><br><br><br><br>
        <a href="login" style="color:#000">已有帐号? 去登录</a><br><br><br>

        <script src="public/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript">
                $('.bk_validate_code').click(function () {
                    $(this).attr('src', 'service/validate_code/create?random=' + Math.random());
                });
        </script>
        <script type="text/javascript">
            function onRegisterClick() {
                $('input:radio[name=register_type]').each(function (index, el) {
                    if ($(this).attr('checked') == 'checked') {
                        var email = '';
                        var phone = '';
                        var password = '';
                        var confirm = '';
                        var phone_code = '';
                        var validate_code = '';

                        var id = $(this).attr('id');
                        email = $('input[name=email]').val();
                        password = $('input[name=passwd_email]').val();
                        confirm = $('input[name=passwd_email_cfm]').val();
                        validate_code = $('input[name=validate_code]').val();
                        if (verifyEmail(email, password, confirm, validate_code) == false) {
                            return;
                        }
                        $.ajax({
                            type: "POST",
                            url: 'service/register',
                            dataType: 'json',
                            cache: false,
                            data: {
                                phone: phone,
                                email: email,
                                password: password,
                                confirm: confirm,
                                validate_code: validate_code,
                                _token: "{{csrf_token()}}"
                            },
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
                                $('.bk_toptips span').html('注册成功');
                                setTimeout(function () {
                                    $('.bk_toptips').hide();
                                }, 2000);
                            },
                            error: function (xhr, status, error) {
                                console.log(xhr);
                                console.log(status);
                                console.log(error);
                            }
                        });
                    }
                });
            }
            function verifyEmail(email, password, confirm, validate_code) {
                // 邮箱不为空
                if (email == '') {
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('请输入邮箱');
                    setTimeout(function () {
                        $('.bk_toptips').hide();
                    }, 2000);
                    return false;
                }
                // 邮箱格式
                if (email.indexOf('@') == -1 || email.indexOf('.') == -1) {
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('邮箱格式不正确');
                    setTimeout(function () {
                        $('.bk_toptips').hide();
                    }, 2000);
                    return false;
                }
                if (password == '' || confirm == '') {
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('密码不能为空');
                    setTimeout(function () {
                        $('.bk_toptips').hide();
                    }, 2000);
                    return false;
                }
                if (password.length < 6 || confirm.length < 6) {
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('密码不能少于6位');
                    setTimeout(function () {
                        $('.bk_toptips').hide();
                    }, 2000);
                    return false;
                }
                if (password != confirm) {
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('两次密码不相同!');
                    setTimeout(function () {
                        $('.bk_toptips').hide();
                    }, 2000);
                    return false;
                }
                if (validate_code == '') {
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('验证码不能为空!');
                    setTimeout(function () {
                        $('.bk_toptips').hide();
                    }, 2000);
                    return false;
                }
                if (validate_code.length != 4) {
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('验证码为4位!');
                    setTimeout(function () {
                        $('.bk_toptips').hide();
                    }, 2000);
                    return false;
                }
                return true;
            }
        </script>

    </body>
</html>
