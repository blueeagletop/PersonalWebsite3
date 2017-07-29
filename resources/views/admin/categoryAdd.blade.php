@extends('admin.master')

@section('title','添加分类')

@section('content')

<article class="page-container">
	<form action="" method="post"  class="form form-horizontal" id="form-category-add">
            {{ csrf_field() }}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>分类名</label>
		<div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" style="width: 50%" value="" placeholder="" name="name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">父类别</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="parent_id" size="1">
				<option value="">无</option>
                                @foreach($categories as $cate)
                                <option value="{{$cate->id}}" >{{$cate->name}}</option>
                                @endforeach
			</select>
			</span> 
                </div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>排序号：（从小到大）</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="number" class="input-text" style="width: 50%" value="" placeholder="" name="compositor">
		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
</article>

@endsection

@section('my-js')
<script type="text/javascript">
  $("#form-category-add").Validform({
    tiptype:2,
    callback:function(form){
      // form[0].submit();
      // var index = parent.layer.getFrameIndex(window.name);
      // parent.$('.btn-refresh').click();
      // parent.layer.close(index);
      $('#form-category-add').ajaxSubmit({
          type: 'post', // 提交方式 get/post
          url: 'service/addCategory', // 需要提交的 url
          dataType: 'json',
          data: {
            name: $('input[name=name]').val(),
            compositor: $('input[name=compositor]').val(),
            parent_id: $('select[name=parent_id] option:selected').val(),
//            preview: ($('#preview_id').attr('src')!='images/icon-add.png'?$('#preview_id').attr('src'):''),
            _token: "{{csrf_token()}}"
          },
          success: function(data) {
            if(data == null) {
              layer.msg('服务端错误', {icon:2, time:2000});
              return;
            }
            if(data.status != 0) {
              layer.msg(data.message, {icon:2, time:2000});
              return;
            }

            layer.msg(data.message, {icon:1, time:2000});
  					parent.location.reload();
          },
          error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
            layer.msg('ajax error', {icon:2, time:2000});
          },
          beforeSend: function(xhr){
            layer.load(0, {shade: false});
          },
        });
        return false;
    }
  });
</script>
@endsection