@extends('admin.master')

@section('title','分类管理')

@section('content')

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i>刷新</a></nav>
<div class="pd-30">
    <div class="text-c">
        <input type="text" class="input-text" style="width:250px" placeholder="输入关键词" id="" name="">
        <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜评论</button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> 
        <span class="r">共有< <strong>{{count($messages)}}</strong> >条留言</span> </div>
    <table class="table table-border table-bordered table-bg">
        <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="20">ID</th>
                <th width="100">留言标题</th>
                <th width="350">内容</th>
                <th width="50">留言者</th>
                <th width="50">置顶序列</th>
                <th width="20">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $mes)
            <tr class="text-c">
                <td><input type="checkbox" value="1" name=""></td>
                <td>{{$mes->id}}</td>
                <td style="text-align: left">{{$mes->title}}</td>
                <td style="text-align: left">{{$mes->detail}}</td>
                <td>{{$mes->member_nickname}}</td>
                <td>
                    @if($mes->top == 0)
                    <span class="label label radius">不置顶</span>
                    @else
                    <span class="label label-success radius">{{$mes->top}}</span>
                    @endif
                </td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="editMessage('编辑留言', 'editMessage={{$mes->id}}', '1', '800', '500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i>编辑</a> <br>
                    <a title="删除" href="javascript:;" onclick='delMessage("{{mb_substr($mes->detail,0,15)}}...","{{$mes->id}}")' class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i>删除</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('my-js')
<script type="text/javascript">
    function editMessage(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    function delMessage(name, id) {
        layer.confirm('确认要删除【' + name + '】吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: 'service/delMessage', // 需要提交的 url
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