@extends('admin.master')

@section('title','文章标题')

@section('content')

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

<div class="pd-20">
    <div class="page-container">
        <div class="text-c"> 日期范围：
            <input type="text" onfocus="WdatePicker({maxDate: '#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:120px;">
            -
            <input type="text" onfocus="WdatePicker({minDate: '#F{$dp.$D(\'datemin\')}', maxDate: '%y-%M-%d'})" id="datemax" class="input-text Wdate" style="width:120px;">
            <input type="text" class="input-text" style="width:250px" placeholder="输入关键词" id="" name="">
            <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜文章</button>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
                <a href="javascript:;" onclick="addArticle('添加管理员', 'addArticle', '800', '500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加文章</a> 
                <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
            </span> <span class="r">共有数据：<strong>{{count($articles)}}</strong> 条</span> </div>
        <table class="table table-border table-bordered table-bg">
            <thead>
                <tr>
                    <th scope="col" colspan="9">文章列表</th>
                </tr>
                <tr class="text-c">
                    <th width="25"><input type="checkbox" name="" value=""></th>
                    <th width="150">文章标题</th>
                    <th width="90">所属分类</th>
                    <th width="150">标签</th>
                    <th width="130">置顶顺序</th>
                    <th width="100">状态</th>
                    <th width="100">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $ar)
                <tr class="text-c">
                    <td><input type="checkbox" value="1" name=""></td>
                    <td>{{$ar->title}}</td>
                    <td>{{$ar->category}}</td>
                    <td>
                        <span class="label label-success radius">{{$ar->tag}}</span>
                    </td>
                    <td>
                        @if($ar->top == 0)
                        不置顶
                        @else
                        {{$ar->top}}
                        @endif
                    </td>
                    <td class="td-status">
                        @if($ar->status == 1)
                        <span class="label label-success radius">已发布</span>
                        @else
                        <span class="label label radius">草稿</span>
                        @endif
                    </td>
                    <td class="td-manage">
                        <a title="详情" href="javascript:;" onclick="news_detail('资讯详情', 'newsDetail={{$ar->id}}', '1', '800', '500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe695;</i> 详情</a><br>
                        <a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑', 'editNews={{$ar->id}}', '1', '800', '500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i> 编辑</a><br>
                        <a title="删除" href="javascript:;" onclick="admin_del(this, '1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i> 删除</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('my-js')

<script type="text/javascript" src="../public/admin/lib/My97DatePicker/WdatePicker.js"></script> 

<script type="text/javascript">
    function addArticle(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    function news_detail(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    function news_edit(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    function news_del(name, id) {
        layer.confirm('确认要删除【' + name + '】吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: 'service/delNews', // 需要提交的 url
                dataType: 'json',
                data: {
                    id: id,
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
                    location.replace(location.href);
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                    layer.msg('ajax error', {icon: 2, time: 2000});
                },
                beforeSend: function (xhr) {
                    layer.load(0, {shade: false});
                }
            });
        });
    }
</script>

@endsection