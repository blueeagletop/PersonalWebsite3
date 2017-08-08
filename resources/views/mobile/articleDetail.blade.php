@extends('mobile.master') 

@section('title', "蓝鹰的博客——BlueEagle's boke")

@section('content')

<div class="page">
    <div class="content">
        <h3><a href="article={{$article->id}}">{{$article->title}}</a></h3>
        <p style="font-size: small;color: #666">{{$article->created_at}}&nbsp;&nbsp;{{$article->category}}</p>
        <p>{!! $article->detail !!}</p>
        <hr>
        <p>共有 < {{count($comments)}} > 条评论</p>
        @foreach($comments as $comment)
        <p style="font-size: small;color: #666">{{$comment->nickname}}&nbsp;&nbsp;{{$comment->created_at}}</p>
        <p>{{$comment->detail}}</p>
        <hr style="height:1px;border:none;border-top:1px dashed #000;">
        @endforeach
    </div>
    <br><br>
</div>

@endsection 

@section('my-js')

@endsection 