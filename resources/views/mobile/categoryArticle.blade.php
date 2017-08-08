@extends('mobile.master') 

@section('title', "蓝鹰的博客——BlueEagle's boke")

@section('content')

<div class="page">
    <div class="content">
        @foreach($articles as $article)
        <h3><a href="article={{$article->id}}">{{$article->title}}</a></h3>
        <p style="font-size: small;color: #666">{{$article->created_at}}&nbsp;&nbsp;{{$article->category}}</p>
        <hr>
        @endforeach
    </div>
    <br><br>
</div>

@endsection 

@section('my-js')

@endsection 