<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
  <link href="public/admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
  <link href="public/admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
  <link href="public/admin/lib/Hui-iconfont/1.0.6/iconfont.css" rel="stylesheet" type="text/css" />
  <link href="public/admin/skin/default/skin.css" rel="stylesheet" type="text/css" id="skin" />
  <link href="public/admin/css/style.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>@yield('title')</title>
<meta name="keywords" content="云产品,云服务,一键建站,建站服务">
<meta name="description" content="云产品,云服务,一键建站,建站服务">
</head>
<body>
    @yield('content')
    
</body>

<script type="text/javascript" src="public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="public/admin/js/jquery.form.js"></script>
<script type="text/javascript" src="public/admin/js/uploadFile.js"></script>
<script type="text/javascript" src="public/admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="public/admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="public/admin/lib/Validform/5.3.2/Validform.min.js"></script>
<!--<script type="text/javascript" src="public/admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="public/admin/lib/ueditor/1.4.3/ueditor.all.min.js"></script>
<script type="text/javascript" src="public/admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>-->

<script charset="utf-8" src="public/admin/plugins/kindeditor/kindeditor-all-min.js"></script>
<script charset="utf-8" src="public/admin/plugins/kindeditor/lang/zh-CN.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
</script>


@yield('my-js')
</html>