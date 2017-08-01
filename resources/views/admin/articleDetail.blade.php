@extends('admin.master')

@section('content')


<div class="pd-30">
<table class="table table-border table-bordered table-bg">
    <thead>
        <tr class="text-c">
            <th width="50">名称</th>
            <th width="500">内容</th>
        </tr>
    </thead>
    <tbody>
<form class="form form-horizontal" action="" method="post">
    <div class="row cl">
        <tr class="text-c">
            <td><label class="form-label"><span class="c-red"></span>文章标题：</label>
            </td>
        <td>
            <div class="formControls" style="text-align: left">&nbsp;&nbsp;
            {{$article->title}}
        </div>
        </td>
        <div class="col-4"> </div>
        </tr>
    </div>
    <div class="row cl">
        <tr class="text-c">
        <td><label class="form-label"><span class="c-red"></span>文章分类：</label></td>
        <td>
            <div class="formControls" style="text-align: left">&nbsp;&nbsp;
            {{$article->category}}
            </div>
        </td>
        </tr>
    </div>
    <div class="row cl">
        <tr class="text-c">
        <td><label class="form-label"><span class="c-red"></span>文章标签：</label></td>
        <td>
            <div class="formControls" style="text-align: left">&nbsp;&nbsp;
                <span class="label label-success radius">{{$article->tag}}</span>
            </div>
        </td>
        <div class="col-4"> </div>
    </tr>
    </div>
    <div class="row cl">
        <tr class="text-c">
        <td><label class="form-label"><span class="c-red"></span>文章置顶：</label></td>
        <td><div class="formControls" style="text-align: left">&nbsp;&nbsp;
            @if($article->top == 0)
            不置顶
            @else
            置顶顺序(从大到小)：{{$article->top}}
            @endif
        </div></td>
        <div class="col-4"> </div>
        </tr>
    </div>
    <div class="row cl">
        <tr class="text-c">
        <td><label class="form-label"><span class="c-red"></span>文章状态：</label></td>
        <td><div class="formControls" style="text-align: left">&nbsp;&nbsp;
            @if($article->status == 1)
            已发布
            @elseif($article->status == 0)
            草稿
            @else
            状态异常
            @endif
        </div></td>
        <div class="col-4"> </div>
        </tr>
    </div>
    @if($articleDetail->source != null)
    <div class="row cl">
        <tr class="text-c">
        <td><label class="form-label"><span class="c-red"></span>文章转自：</label></td>
        <td><div class="formControls" style="text-align: left">&nbsp;&nbsp;
            {{$articleDetail->source}}
        </div></td>
        <div class="col-4"> </div>
        </tr>
    </div>
    @endif
    <div class="row cl">
        <tr class="text-c">
        <td><label class="form-label">详细内容：</label></td>
        <td><div style="text-align: left">
            {!! $articleDetail->detail !!}
        </div></td>
        </tr>
    </div>
    </tbody>
    
    </div>
    @endsection
