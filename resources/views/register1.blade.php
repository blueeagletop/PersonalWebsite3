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
            <form action="" method="post"  class="form form-horizontal" id="form-admin-add">
                {{ csrf_field() }}
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
                        验证码：&nbsp;&nbsp;&nbsp;&nbsp;<input class="validate_code_input" type="text" placeholder="请输入验证码" name='validate_code'/>
                    </div>
                    <div style="line-height: 100px"><img src="service/validate_code/create" class="bk_validate_code"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                </div>

                <div class="weui_cells_tips">我已阅读并同意<a style="color: blue">《BlueEagle.top注册协议》</a></div>
                <!--        <div class="bottom_area" >
                            <a style="color: #FFF" href="javascript:" onclick="onRegisterClick();"> 注&nbsp;&nbsp;&nbsp;&nbsp;册 </a>
                        </div>-->
                <!--        <div class="bottom_area" style="background-color: #D3D6DA;width: 150px;">
                            <a style="color: #FFF;font-size: small"> 暂 不 开 放 注 册 </a>
                        </div>-->
                <div class="row cl">
                    <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                        <input class="input-bootom" type="submit" value="&nbsp;注&nbsp;&nbsp;册&nbsp;">
                    </div>
                </div>
            </form>
        </div>
        <br><br>
        <a href="login" style="color:#000">已有帐号? 去登录</a><br><br><br>

        <script src="public/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript">
            $('.bk_validate_code').click(function () {
                $(this).attr('src', 'service/validate_code/create?random=' + Math.random());
            });
        </script>

        <script type="text/javascript" src="public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="public/admin/js/jquery.form.js"></script>

        <script type="text/javascript">
            $("#form-admin-add").Validform({
                tiptype: 2,
                callback: function (form) {
                    // form[0].submit();
                    // var index = parent.layer.getFrameIndex(window.name);
                    // parent.$('.btn-refresh').click();
                    // parent.layer.close(index);
                    $('#form-admin-add').ajaxSubmit({
                        type: 'post', // 提交方式 get/post
                        url: 'service/register', // 需要提交的 url
                        dataType: 'json',
                        data: {
                            username: $('input[name=username]').val(),
                            password: $('input[name=password]').val(),
                            email: $('input[name=email]').val(),
                            phone: $('input[name=phone]').val(),
                            //            preview: ($('#preview_id').attr('src')!='images/icon-add.png'?$('#preview_id').attr('src'):''),
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
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr);
                            console.log(status);
                            console.log(error);
                            layer.msg('ajax error', {icon: 2, time: 2000});
                        },
                        beforeSend: function (xhr) {
                            layer.load(0, {shade: false});
                        },
                    });
                    return false;
                }
            });
        </script>

    </body>
</html>
