<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

<title>@yield('title')</title>

<link href="../public/mobile/css/nav_sytle.css" rel="stylesheet">
<link href="../public/mobile/css/index.css" rel="stylesheet">
<script src="../public/mobile/js/jquery-2.1.1.min.js"></script>
<script src="../public/mobile/js/nav.js"></script>

</head>
<body>
<div class="con">
    <button class="nav1"><img src="../public/img/mobile/nav.png" style="width: 26px;" align="center"> 导航</button>
    <button class="nav2"><img src="../public/img/mobile/article.png" style="width: 24px;" align="center"> 文章</button>
    <button class="nav3"><img src="../public/img/mobile/message.png" style="width: 26px;" align="center"> 留言</button>
    <button class="nav4"><img src="../public/img/man.png" style="width: 20px;" align="center"> 访客</button>
</div>
    
<div class="bgDiv"></div>

<div class="firstNav1">
    <ul id="home">首页</ul>
    <ul id="article">全部文章</ul>
    <ul id="message">留言</ul>
    <ul id="github">GitHub</ul>
</div>
<div class="firstNav2">
    @foreach($nav_categories as $category)
    <ul><a href="category={{$category->id}}">{{$category->name}}</a></ul>
    @endforeach
    <ul><a href="index">全部文章</a></ul>
</div>
<!--<div class="firstNav3">
    <ul>一级菜单3</ul>
    <ul>一级菜单3</ul>
    <ul>一级菜单3</ul>
    <ul>一级菜单3</ul>
</div>
<div class="firstNav4">
    <ul>一级菜单4</ul>
    <ul>一级菜单4</ul>
    <ul>一级菜单4</ul>
    <ul>一级菜单4</ul>
</div>-->

@yield('content')
</body>

@yield('my-js')

</html>
