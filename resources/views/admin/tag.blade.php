@extends('admin.master')

@section('title','分类管理')

@section('content')

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 文章管理 <span class="c-gray en">&gt;</span> 查看标签 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i>刷新</a></nav>
<div class="pd-30">
	<div class="text-c">
		<input type="text" class="input-text" style="width:250px" placeholder="输入标签" id="" name="">
		<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜标签</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
                <a href="javascript:;" onclick="addTag('添加标签','addTag')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加标签</a> 
                <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> </span> <span class="r">共有< <strong>{{count($tags)}}</strong> >个标签</span> </div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="9">分类列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="20">ID</th>
				<th width="150">标签名</th>
                                <th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
                    @foreach($tags as $tag)
			<tr class="text-c">
				<td><input type="checkbox" value="1" name=""></td>
				<td>{{$tag->id}}</td>
				<td class="td-status"><span class="label label-success radius">{{$tag->name}}</span></td>
				<td class="td-manage">
                                    <a title="编辑" href="javascript:;" onclick="editTag('编辑分类','editTag={{$tag->id}}','1','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i>编辑</a> 
                                    <a title="删除" href="javascript:;" onclick='delTag("{{$tag->name}}","{{$tag->id}}")' class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i>删除</a></td>
			</tr>
                    @endforeach
		</tbody>
	</table>
</div>

@endsection

@section('my-js')
<script type="text/javascript">
    function addTag(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    
    function editTag(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    
    function delTag(name, id) {
        layer.confirm('确认要删除【' + name + '】吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: 'service/delTag', // 需要提交的 url
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