@extends('master') 

@section('title', "蓝鹰的博客——BlueEagle's boke")

@section('content')
<div class="presentLocation"><p>&nbsp;当前位置&nbsp;：&nbsp;<a href="./">全部文章</a>&nbsp;>>&nbsp;<a href="keyword={{$keyword}}">按关键词 “ {{$keyword}} ” 查找</a></p></div>
<div class="article">
        
    @foreach($articles as $ar)
    <br/>
    <h2><a href="article={{$ar->id}}">{{$ar->title}}</a></h2>
    <p><a style="color: #666" href="article={{$ar->id}}">&nbsp;&nbsp;>> 查看详情 </a></p>
    <samp style="color: #666">{{$ar->created_at}}&nbsp;&nbsp;文章分类：{{$ar->category}}&nbsp;&nbsp;</samp>
        
        @if($ar->tag != null)
        <a class="tag">{{$ar->tag->name}}</a>&nbsp;&nbsp;
        @endif
        
    <hr/>
    @endforeach

<br><br><br><br><br>

<div class="footer">
    Copyright@ 蓝鹰&nbsp;&nbsp;|&nbsp;&nbsp;E-mail:blueeagletop@163.com&nbsp;&nbsp;|&nbsp;&nbsp;蓝鹰的个人博客3.0
</div> 
</div>


@endsection 

@section('my-js')


        

@endsection 
