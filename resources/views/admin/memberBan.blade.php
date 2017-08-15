@extends('admin.master')

@section('title','分类管理')

@section('content')

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 访客管理 <span class="c-gray en">&gt;</span> 小黑屋用户 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i>刷新</a></nav>
<div class="pd-30">
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
            <a href="javascript:;" onclick="addMember('添加会员', 'addMember')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加会员</a> 
            <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> </span> 
        <span class="r">共有< <strong>{{count($members)}}</strong> >个会员</span> </div>
    <table class="table table-border table-bordered table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="9">分类列表</th>
            </tr>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="20">ID</th>
                <th width="100">称呼</th>
                <th width="100">用户名</th>
                <th width="100">邮箱</th>
                <th width="100">QQ</th>
                <th width="100">微信</th>
                <th width="30">状态</th>
                <th width="80">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr class="text-c">
                <td><input type="checkbox" value="1" name=""></td>
                <td>{{$member->id}}</td>
                <td>{{$member->nickname}}</td>
                <td>{{$member->username}}</td>
                <td>{{$member->email}}</td>
                <td>{{$member->qq}}</td>
                <td>{{$member->weixin}}</td>
                <td>
                    @if($member->status == 0)
                    <span class="label label radius">小黑屋</span>
                    @elseif($member->status == 1)
                    <span class="label label-success radius">正常</span>
                    @elseif($member->status == 2)
                    <span class="label label-warning radius">未验证邮箱</span>
                    @else
                    <span class="label label-danger radius">状态异常</span>
                    @endif
                </td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="editMember('编辑访客', 'editMember={{$member->id}}', '1', '800', '500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i>编辑</a> 
                    <a title="删除" href="javascript:;" onclick='delMember("{{$member->nickname}}", "{{$member->id}}")' class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i>删除</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('my-js')
<script type="text/javascript">
    function addMember(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    function editMember(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    function delMember(name, id) {
        layer.confirm('确认要删除【' + name + '】吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: 'service/delMember', // 需要提交的 url
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