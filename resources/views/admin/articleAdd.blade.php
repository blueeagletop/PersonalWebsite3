@extends('admin.master')

@section('title','添加首页导航')

@section('content')

<form action="" method="post" class="form form-horizontal" id="form-article-add">
    {{ csrf_field() }}
    <div class="row cl">
        <label class="form-label col-2">标题：</label>
        <div class="formControls col-5">
            <input type="text" class="input-text" value="" placeholder="" id="title" name="title">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-2">所属分类：</label>
        <div class="formControls col-5"> <span class="select-box" style="width:150px;">
                <select class="select" name="category_id" size="1">
                    @foreach($categories as $cate)
                    <option value="{{$cate->id}}" >{{$cate->name}}</option>
                    @endforeach
                </select>
            </span> 
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-2">标签(以英文 , 分割)：</label>
        <div class="formControls col-5">
            <input type="text" class="input-text" value="" placeholder="" id="url" name="tag">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-2">置顶顺序(从大到小)：</label>
        <div class="formControls col-5">
            <input type="number" class="input-text" value="" placeholder="" id="url" name="top">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-2">详细内容：</label>
        <div class="formControls col-8">
            <script name="editor" id="editor" type="text/plain" style="width:100%; height:500px;"></script>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-3"><span class="c-red">*</span>是否发布：</label>
        <div class="formControls col-5 skin-minimal">
            <div class="radio-box">
                <input type="radio" id="sex-1" name="sex" datatype="*" nullmsg="请选择状态！">
                <label for="sex-1">发布</label>
            </div>
            <div class="radio-box">
                <input type="radio" id="sex-2" name="sex">
                <label for="sex-2">存放草稿箱中</label>
            </div>
        </div>
        <div class="col-4"> </div>
    </div>
    <!--        <div class="row cl">
                <label class="form-label col-2"><span class="c-red">*</span>是否发布：</label>
                <div class="formControls col-5 skin-minimal">
                    <div class="radio-box">
                        <input name="status" type="radio" id="1" checked>
                        <label for="1">发布</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" id="0" name="status">
                        <label for="0">储存至草稿，暂不发布</label>
                    </div>
                </div>
            </div>-->

    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
            <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
        </div>
    </div>
</form><br>

@endsection

@section('my-js')
<script type="text/javascript">
    var ue = UE.getEditor('editor');
    ue.execCommand("getlocaldata");

    $("#form-article-add").Validform({
        tiptype: 2,
        callback: function (form) {
            // form[0].submit();
            // var index = parent.layer.getFrameIndex(window.name);
            // parent.$('.btn-refresh').click();
            // parent.layer.close(index);
            $('#form-article-add').ajaxSubmit({
                type: 'post', // 提交方式 get/post
                url: 'service/addArticle', // 需要提交的 url
                dataType: 'json',
                data: {
                    title: $('input[name=title]').val(),
                    category_id: $('input[name=category_id]').val(),
                    top: $('input[name=top]').val(),
                    detail: ue.getContent(),
                    tag: $('input[name=tag]').val(),
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

                    layer.msg(data.message, {icon: 1, time: 3000});
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