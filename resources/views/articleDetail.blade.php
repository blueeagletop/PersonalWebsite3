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
    <li>作者：蓝鹰 BlueEagle</li>
    <li>本文地址：http://www.blueeagle.top/article={{$article->id}}</li>
    <li>转载请注明出处</li>
    @else
    <li>本文地址：http://www.blueeagle.top/article={{$article->id}}</li>
    <li>文章转自：{{$articleDetail->source}}</li>
    @endif
</p>
<div style="font-size: medium;line-height: 2.0">{!! $articleDetail->detail !!}</div>   
<hr/>
<h3>< 共有 {{count($articleComments)}}条 评论 >&nbsp;&nbsp;&nbsp;&nbsp;</h3>

@foreach($articleComments as $comment)
<div style="background-color: #EFEFEF;padding: 10px 10px;border-radius: 6px;">
    {{$comment->nickname}}
    @if($comment->nickname == 'blueealge')
    <a style="color: red">[ Blogger ]</a>
    @elseif($comment->nickname == '蓝鹰')
    <a style="color: red">[ 博主 ]</a>
    @else
    <a style="color: red">[ 访客 ]</a>
    @endif
    &nbsp;&nbsp;&nbsp;&nbsp;评论时间：{{$comment->created_at}}<a href="http://www.baidu.com" style="position: absolute;right: 20px;">回复</a><br><br>
    <p style="font-size: medium">{!! $comment->detail !!}</p>
</div>

@endforeach
<br><hr>
<form action="" method="post" class="form form-horizontal" id="form-article-add">
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
<!--            <br><input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;"><a>&nbsp;&nbsp;XXX，谢谢您的评论。</a><br><br>-->
            <br>抱歉，您需要<a style="color: red" href="login"> < 登录 > </a>之后才能发表评论。点击<a style="color: red" href="login"> < 此处去登录页面 > </a><br><br>
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

<script type="text/javascript" src="public/admin/lib/My97DatePicker/WdatePicker.js"></script> 


@endsection 
