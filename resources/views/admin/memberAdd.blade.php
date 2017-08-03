@extends('admin.master')

@section('title','添加分类')

@section('content')

<article class="page-container">
    <form action="" method="post"  class="form form-horizontal" id="form-admin-add">
        {{ csrf_field() }}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>称呼：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" style="width: 50%" value="" placeholder="" name="nickname">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>注册账号：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" style="width: 50%" value="" placeholder="" name="username">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>密码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="password" class="input-text" style="width: 50%" value="" placeholder="" name="password">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>邮箱（用于找回密码）：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="email" class="input-text" style="width: 50%" value="" placeholder="" name="email">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>qq：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" style="width: 50%" value="" placeholder="" name="qq">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>weixin：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" style="width: 50%" value="" placeholder="" name="weixin">
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</article>

@endsection

@section('my-js')
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
                url: 'service/addMember', // 需要提交的 url
                dataType: 'json',
                data: {
                    nickname: $('input[name=nickname]').val(),
                    username: $('input[name=username]').val(),
                    password: $('input[name=password]').val(),
                    email: $('input[name=email]').val(),
                    qq: $('input[name=qq]').val(),
                    weixin: $('input[name=weixin]').val(),
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
@endsection