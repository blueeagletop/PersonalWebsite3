@extends('master') 

@section('title', "蓝鹰的博客——BlueEagle's boke")

@section('content')
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
    <h3>< 共有 0条 评论 >&nbsp;&nbsp;&nbsp;&nbsp;<a style="color:#C00;">请勿发广告或人身攻击，一经发现将被永久禁言</a></h3>
    <p></p>
<br><br><br><br><br>

<div class="footer">
    Copyright@ 蓝鹰&nbsp;&nbsp;|&nbsp;&nbsp;E-mail:blueeagletop@163.com&nbsp;&nbsp;|&nbsp;&nbsp;蓝鹰的个人博客3.0
</div> 
</div>


@endsection 

@section('my-js')


        

@endsection 
