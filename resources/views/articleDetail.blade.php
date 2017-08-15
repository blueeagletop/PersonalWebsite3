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

<script type="text/javascript" src="/blueeagle/htdocs/public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/blueeagle/htdocs/public/admin/js/jquery.form.js"></script>
<script type="text/javascript" src="/blueeagle/htdocs/public/admin/js/uploadFile.js"></script>
<script type="text/javascript" src="/blueeagle/htdocs/public/admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/blueeagle/htdocs/public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/blueeagle/htdocs/public/admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/blueeagle/htdocs/public/admin/lib/Validform/5.3.2/Validform.min.js"></script>

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

<div class="presentLocation"><p>&nbsp;当前位置&nbsp;：&nbsp;<a href="./">全部文章</a>&nbsp;>>&nbsp;{{$categoryF->name}}&nbsp;>>&nbsp;<a href="category={{$article->category->id}}">{{$article->category->name}}</a>&nbsp;>>&nbsp;文章详情</p></div>
<div class="article">

    <br/>
    <h2 style="font-size: large;">{{$article->title}}&nbsp;&nbsp;&nbsp;&nbsp;</h2>
    <samp style="color: #666">{{$article->created_at}}&nbsp;&nbsp;文章分类：{{$article->category->name}}&nbsp;&nbsp;</samp>

    @if($article->tag_id != null)
    <a class="tag">{{$article->tag->name}}</a>&nbsp;&nbsp;
    @endif

    <p>
        @if($articleDetail->source == null)
    <ul style="line-height:1.5">作者：蓝鹰 BlueEagle</ul>
    <ul style="line-height:1.5">本文地址：http://www.blueeagle.top/article={{$article->id}}</ul>
    <ul style="line-height:1.5">转载请注明出处</ul>
    @else
    <ul style="line-height:1.5">本文地址：http://www.blueeagle.top/article={{$article->id}}</ul>
    <ul style="line-height:1.5">文章转自：{{$articleDetail->source}}</ul>
    @endif
</p>
<div style="font-size: medium;line-height: 2.0">{!! $articleDetail->detail !!}</div>   
<hr/>
<h3>< 共有 {{count($articleComments)}}条 评论 >&nbsp;&nbsp;&nbsp;&nbsp;</h3>

@foreach($articleComments as $comment)
<div style="background-color: #EFEFEF;padding: 10px 10px;border-radius: 6px;">
    {{$comment->nickname}}
    @if($comment->nickname == 'BlueEagle')
    <a style="color: red">[ Blogger ]</a>
    @elseif($comment->nickname == '蓝鹰')
    <a style="color: red">[ 博主 ]</a>
    @else
    <a style="color: red">[ 访客 ]</a>
    @endif
    &nbsp;&nbsp;&nbsp;&nbsp;评论时间：{{$comment->created_at}}<a href="http://www.baidu.com" style="position: absolute;right: 20px;">回复</a><br><br>
    <p style="font-size: medium">{!! $comment->detail !!}</p>
</div>
<br>
@endforeach
<br><hr>
<form action="" method="post" class="form form-horizontal" id="form-comment-add">
    {{ csrf_field() }}
    <div class="row cl">
        <label class="form-label col-2">
            <h3>评论<a style="color:#C00;">（请勿发广告或人身攻击，一经发现将被永久禁言）</a></h3>
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



<script type="text/javascript">
    $("#form-comment-add").Validform({
        tiptype: 2,
        callback: function (form) {
            // form[0].submit();
            // var index = parent.layer.getFrameIndex(window.name);
            // parent.$('.btn-refresh').click();
            // parent.layer.close(index);
            $('#form-comment-add').ajaxSubmit({
                type: 'post', // 提交方式 get/post
                url: 'service/addComment', // 需要提交的 url
                dataType: 'json',
                data: {
                    member: "{{$member}}",
                    article_id: "{{$article->id}}",
                    detail: editor.html(),
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

                    location.href = "";
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
