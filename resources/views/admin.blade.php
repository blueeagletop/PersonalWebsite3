@extends('admin.master')

@section('title','分类管理')

@section('content')

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i>刷新</a></nav>
<div class="pd-30">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
                <a href="javascript:;" onclick="addAdmin('添加管理员','addAdmin')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a> 
                <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> </span> 
                <span class="r">共有< <strong>{{count($admins)}}</strong> >个管理员</span> </div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="9">分类列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="20">ID</th>
				<th width="150">用户名</th>
				<th width="150">邮箱</th>
				<th width="50">电话</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
                    @foreach($admins as $admin)
			<tr class="text-c">
				<td><input type="checkbox" value="1" name=""></td>
				<td>{{$admin->id}}</td>
				<td>{{$admin->username}}</td>
				<td>{{$admin->email}}</td>
				<td class="td-status">{{$admin->phone}}</td>
				<td class="td-manage">
                                    <a title="编辑" href="javascript:;" onclick="editAdmin('编辑分类','editAdmin={{$admin->id}}','1','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i>编辑</a> 
                                    <a title="删除" href="javascript:;" onclick='delAdmin("{{$admin->username}}","{{$admin->id}}")' class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i>删除</a></td>
			</tr>
                    @endforeach
		</tbody>
	</table>
</div>

@endsection

@section('my-js')
<script type="text/javascript">
    function addAdmin(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    
    function editAdmin(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    
    function delAdmin(name, id) {
        layer.confirm('确认要删除【' + name + '】吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: 'service/delAdmin', // 需要提交的 url
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