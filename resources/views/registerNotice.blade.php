@extends('admin.master')

@section('title','BlueEagle.top访客注册')

@section('content')

<link rel="stylesheet" href="public/css/indexStyle.css">
<link rel="stylesheet" href="public/css/register.css">

<article class="page-container">
    <div>
        <br><br>
        <h1 style="color: #29d"><a style="color: #29d" href="./">BlueEagle.top</a>注册须知</h1>
    </div>
    <div class="register" style="width: 1000px;">
            <div style="position: absolute;width: 1000px;left:50%; transform:translate(-50%);text-align: left">
                <h3 style="line-height: 1.5">1.由于这是个人的博客，维护者也只有博主一人，难免有疏漏之处。<a style="color: red">因此注册时请设置独立的密码，切勿与其他账号密码相同。</a></h3>
                <h3 style="line-height: 1.5">2.博主在此承诺不主动泄露访客的数据，但由于非博主主观意愿导致的数据泄露而造成访客其他账号被盗，责任及结果由访客自己承担。</h3>
                <h3 style="line-height: 1.5">3.如果访客有以下但不限于如人身攻击、发布广告、无意义的灌水、散布谣言、冒充博主以及其他不道德或违法等行为，博主有权删除、停用该访客账号，并保留追究其法律责任的权利。</h3>
                <h3 style="line-height: 1.5">4.访客的言论只代表访客个人，与本博客及博主无关。访客的言论所造成的一切后果，均由访客自己承担。</h3>
                <h3 style="line-height: 1.5">5.由于本博客不定时升级更新，因此而造成的访客的数据丢失，本博客及博主无需承担任何责任，如果你有重要的评论或留言，请自觉做好备份。</h3>
                <h3 style="line-height: 1.5">6.对于一年以上未登录过的账号，博主有权收回该账号。</h3>
                <h3 style="line-height: 1.5">7.本页面解释权归博主所有。</h3>
                <br><br>
                <a href="register">点击此处去注册页面</a>
            </div>
        </div>
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
                    layer.msg('注册成功，但邮件发送失败，请登录后重新验证邮箱', {icon: 2, time: 2000});
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