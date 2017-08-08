@extends('mobile.master') 

@section('title', "蓝鹰的博客——BlueEagle's boke")

@section('content')

<div class="page">
    <div class="content">
        @foreach($messages as $message)
        <h3><a>{{$message->title}}</a></h3>
        <p style="font-size: small;color: #666">{{$message->nickname}}&nbsp;&nbsp;{{$message->created_at}}</p>
        <p>{!! $message->detail !!}</p><br>
        <hr style="height:1px;border:none;border-top:1px dashed #000;">
        @endforeach
    </div>
    <br><br>
</div>

@endsection 

@section('my-js')

@endsection 