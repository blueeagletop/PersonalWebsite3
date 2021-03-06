<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>@yield('title')</title>

        <link rel="stylesheet" href="public/css/indexStyle.css">
        <link rel="stylesheet" type="text/css" href="public/css/search-form.css">

        <script type="text/javascript" src="public/js/jquery.min.js"></script>
        <script type="text/javascript" src="public/js/menu.js"></script><!-- 左侧导航栏 -->
        <script type="text/javascript" src="public/js/toTop.js"></script><!-- 回到顶部 -->
        <script type="text/javascript" src="public/js/search.js"></script><!-- 动态搜索按钮 -->

        <!--        文章分类导航栏特效-->
        <style type="text/css">
            .leftContent{height:auto !important;overflow:visible !important;height:100% !important;}
            a{color:#000000;}
            .leftContent dd{display: none}
            dt.on{font-size: larger;color: #31708f}
        </style>
        
    </head>
    <body>

        <div id="pgcontainer">
            <header>
                <div id="navbar">
                    <form onsubmit="submitFn(this, event);" method="get">
                        <div class="search-wrapper">
                            <div class="input-holder">
                                <input type="text" class="search-input" placeholder="请输入你要搜索的内容" />
                                <button class="search-icon" onclick="searchToggle(this, event);"><span></span></button>
                            </div>
                            <span type="submit" class="close" target="mainFrame" onclick="searchToggle(this, event);"></span>
                            <div class="result-container">
                            </div>
                        </div>
                    </form>
                    <a href="#" class="menubtn" style="left: -52px">导航</a>
                    <!-- use captain icon for toggle menu -->
                    <div id="hamburgermenu">
                        <ul>
                            <li><a href="./">首页</a></li>
                            <li><a href="./"><img src="public/img/boke.png" style="width: 30px;"><br/>文章</a></li>
                            <li><a href="https://github.com/blueeagletop" target="_black"><img src="public/img/GitHub.png" style="width: 30px"><br/>GitHub</a></li>
<!--                            <li><a href="./sociality"><img src="public/img/sociality.png" style="width: 30px"><br/>社交</a></li>-->
                            <li><a href="./message"><img src="public/img/message.png" style="width: 30px"><br/>留言</a></li>
                        </ul>
                        <div class="hamburgermenuText"><a href="member/index">访客中心</a></div>
                    </div>
                </div>
                <div class="overlay"></div>
            </header>
            <div id="share">    
                <a id="totop" title="">返回顶部</a>
            </div>

            <div class="page">
                <div class="bokeHeader">
                    <img src="public/img/portrait.png" style="width: 100px;right: 0px">
                    <div class="leftHeader"><h1>蓝鹰 BlueEagle</h1>正努力成为全栈工程师的PHP程序员。人生格言：生命不息，追梦不止。</div>
                    <div class="rightHeader">
<!--                        <p><a style="color: red;font-weight: bold;"> 中 文 </a> | <a style="color: #666"> English </a></p>-->
                        <p><a href="http://www.blueeaglefly.com">旧版入口</a></p>
                    </div>
                </div>
                <div id="content">
                    <div class="leftContent" id="leftContent">
                        <h2>< 文章分类 ></h2>
                        @foreach($categoriesFirst as $CF)
                        <dl>
                            <dt><h3><a href="#">{{$CF->name}}</a></h3></dt>
                                @foreach($categories as $ca)
                                    @if($ca->parent_id == $CF->id)
                                    <dd class="first_dd"><p><a href="category={{$ca->id}}">⊙&nbsp;{{$ca->name}}</a></p></dd>
                                    @endif
                                @endforeach
                        </dl>
                        @endforeach
                        <br>
                    </div>
                    <br>
                    <div class="leftContent">
                        <h2>< 按标签查看 ></h2>
                        <p>
                        @foreach($tags as $tag)
                            <a class="tag" style="background-color: #add8e6" href="tag={{$tag->id}}">{{$tag->name}}</a>&nbsp;&nbsp;
                        @endforeach
                        </p>
                        <br /></div>
                    <br>
                    <div class="leftContent">
                        <h2>< 最新评论 ><samp> </samp></h2>
                        @foreach($comments as $com)
                        <p class="line_height"><a href="article={{$com->article_id}}"><b>{{$com->nickname}}：</b>{!! mb_substr($com->detail,0,26) !!}......</a></p>
                        @endforeach
                    </div>
                    <br>
                    <div class="leftContent">
                        <h2>< 最近留言 ></h2>
                        @foreach($messages as $mes)
                        <p class="line_height"><b>{{$mes->nickname}}：</b>{!! mb_substr($mes->detail,0,26) !!}......</p>
                        @endforeach
                        <a style="color: #666" href="message"> >>查看全部 </a>
                        <br><br>
                    </div>
                    <br>
                    <div class="rightContent">@yield('content')</div>
                </div>
            </div>
        </div>
        
<script type="text/javascript">//文章分类导航栏特效
    $(function() {
        $("#leftContent").find("dt").click(function() { //一级菜单点击
            if (!$(this).hasClass("on")) { //当前一级菜单不选中状态才切换
                $("#leftContent").find("dt").removeClass("on");//所有的一级菜单去除选中样式
                $(this).addClass("on");//当前一级菜单去除选中样式
                $('dd').slideUp();//所有二级菜单隐藏
                $(this).nextAll('dd').slideToggle();//当前所有二级菜单切换
            }
        });
    })
</script>
    </body>

    @yield('my-js')
</html>
