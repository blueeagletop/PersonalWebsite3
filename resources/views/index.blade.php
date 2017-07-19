@extends('master') 

@section('title', "蓝鹰的博客——BlueEagle's boke")

@section('content')
<div class="presentLocation"><p>&nbsp;当前位置&nbsp;：&nbsp;全部文章&nbsp;>>&nbsp;{{$categoryF->title}}&nbsp;>>&nbsp;{{$category->title}}</p></div>
<div class="article">
    
    
    @foreach($articles as $ar)
    <br/>
    <h2>{{$ar->title}}&nbsp;&nbsp;&nbsp;&nbsp;</h2>
    <p><a style="color: #666" href="{{$ar->id}}">&nbsp;&nbsp;>> 查看详情 </a></p>
    <samp style="color: #666">{{$ar->created_at}}&nbsp;&nbsp;文章分类：{{$category->title}}&nbsp;&nbsp;</samp>
        @foreach($tags as $tag)
        <a class="tag">{{$tag->name}}</a>&nbsp;&nbsp;
        @endforeach
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
