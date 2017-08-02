@extends('admin.master')

@section('title','添加分类')

@section('content')

<?php
$htmlData = $comment->detail;
if (!empty($_POST['editor'])) {
    if (get_magic_quotes_gpc()) {
        $htmlData = stripslashes($_POST['editor']);
    } else {
        $htmlData = $_POST['editor'];
    }
}
?>

<script charset="utf-8" src="/blueeagle/htdocs/public/admin/plugins/kindeditor/plugins/code/prettify.js"></script>
<script>
    KindEditor.ready(function (K) {
        var editor1 = K.create('textarea[name="editor"]', {
            uploadJson: '/blueeagle/htdocs/public/admin/plugins/kindeditor/php/upload_json.php',
            fileManagerJson: '/blueeagle/htdocs/public/admin/plugins/kindeditor/php/file_manager_json.php',
            allowFileManager: true,
            afterCreate: function () {
                var self = this;
                K.ctrl(document, 13, function () {
                    self.sync();
                    K('form[name=editArticle]')[0].submit();
                });
                K.ctrl(self.edit.doc, 13, function () {
                    self.sync();
                    K('form[name=editArticle]')[0].submit();
                });
            }
        });
        prettyPrint();
    });
</script>

<article class="page-container">
    <form action="" method="post"  class="form form-horizontal" id="form-category-edit">
        {{ csrf_field() }}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">对应的文章标题：</label>
            <div class="formControls col-xs-8 col-sm-9">
                {{$comment->article_title}}
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">评论者：</label>
            <div class="formControls col-xs-8 col-sm-9">
                {{$comment->member_nickname}}
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>评论内容:</label>
            <div class="formControls col-8">
            <textarea name="editor" id="editor_id" style="width:100%;height:500px;"><?php echo htmlspecialchars($htmlData); ?></textarea>
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
    $("#form-category-edit").Validform({
        tiptype: 2,
        callback: function (form) {
            // form[0].submit();
            // var index = parent.layer.getFrameIndex(window.name);
            // parent.$('.btn-refresh').click();
            // parent.layer.close(index);
            $('#form-category-edit').ajaxSubmit({
                type: 'post', // 提交方式 get/post
                url: 'service/editComment', // 需要提交的 url
                dataType: 'json',
                data: {
                    id:"{{$comment->id}}",
                    detail: editor.html(),
//            preview: ($('#preview_id').attr('src')!='images/icon-add.png'?$('#preview_id').attr('src'):''),
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
                    parent.location.reload();
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                    layer.msg('ajax error', {icon: 2, time: 2000});
                },
                beforeSend: function (xhr) {
                    layer.load(0, {shade: false});
                },
            });
            return false;
        }
    });
</script>
@endsection