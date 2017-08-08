<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>BlueEagle.top访客中心</title>

        <link rel="stylesheet" href="../public/css/indexStyle.css">
        <link rel="stylesheet" type="text/css" href="../public/css/search-form.css">

        <script type="text/javascript" src="../public/js/jquery.min.js"></script>
        <script type="text/javascript" src="../public/js/menu.js"></script><!-- 左侧导航栏 -->
        <script type="text/javascript" src="../public/js/toTop.js"></script><!-- 回到顶部 -->

    </head>
    <body>

        <div id="pgcontainer">
            <header>
                <div id="navbar">
                    <a href="#" class="menubtn" style="left: -52px">导航</a>
                    <!-- use captain icon for toggle menu -->
                    <div id="hamburgermenu">
                        <ul>
                            <li><a href="../">首页</a></li>
                            <li><a href="../"><img src="../public/img/boke.png" style="width: 30px;"><br/>博客</a></li>
                            <li><a href="https://github.com/blueeagletop" target="_black"><img src="../public/img/GitHub.png" style="width: 30px"><br/>GitHub</a></li>
<!--                            <li><a href="../sociality"><img src="public/img/sociality.png" style="width: 30px"><br/>社交</a></li>-->
                            <li><a href="../message"><img src="../public/img/message.png" style="width: 30px"><br/>留言</a></li>
                        </ul>
                        <div class="hamburgermenuText"><a href="../member/index">访客中心</a></div>
                    </div>
                </div>
                <div class="overlay"></div>
            </header>
            <div class="page">
                <div class="bokeHeader">
                    <div class="leftHeader" style="left: 20px;top: 10px;"><h1>欢迎您：{{$member->nickname}} <a href="../logout" style="font-size:small;font-weight: normal;color: #666;">点击退出登录</a></h1></div>
                </div>
                <div id="content">
                    <h2>您的称呼：{{$member->nickname}}</h2>
                    <h2>您的用户名：{{$member->username}}</h2>
                    <h2>
                        您的邮箱：{{$member->email}}
                        @if($member->status == 2)
                        <a style="color: red;font-size: small">×邮箱未验证</a>
                        @else
                        <a style="color: green;font-size: small">√ 邮箱已验证</a>
                        @endif
                    </h2>
                    <h2>您的QQ：{{$member->qq}}</h2>
                    <h2>您的微信：{{$member->weixin}}</h2>
                    <a href="#">完善您的信息，博主将更容易与你联系和交流</a>

                    <hr>
                    <h3>以下是您的评论&nbsp;&nbsp;&nbsp;&nbsp;总< {{count($comments)}} >条评论</h3>
                    <br>
                    @foreach($comments as $comment)
                    <p>{!! $comment->detail !!}</p>
                    <br>
                    @endforeach
                    <hr>
                    <h3>以下是您的留言&nbsp;&nbsp;&nbsp;&nbsp;总< {{count($messages)}} >条评论</h3>
                    <br>
                    @foreach($messages as $message)
                    <h3>{{$message->title}}</h3>
                    <p>{!! $message->detail !!}</p>
                    <br>
                    @endforeach
                    <hr>
                </div>
            </div>
        </div>
    </body>
</html>