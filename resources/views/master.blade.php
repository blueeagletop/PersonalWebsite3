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
                            <li><a href="http://www.blueeaglefly.com">首页</a></li>
                            <li><a href="./"><img src="public/img/boke.png" style="width: 30px;"><br/>博客</a></li>
                            <li><a href="https://github.com/blueeagletop" target="_black"><img src="public/img/GitHub.png" style="width: 30px"><br/>GitHub</a></li>
                            <li><a href="../message/"><img src="public/img/message.png" style="width: 30px"><br/>社交</a></li>
                            <li><a href="../message/"><img src="public/img/message.png" style="width: 30px"><br/>留言</a></li>
                        </ul>
                        <div class="hamburgermenuText"><a href="#">访客中心</a></div>
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
                        <p><a style="color: red;font-weight: bold;"> 中 文 </a> | <a style="color: #666"> English </a></p>
                        <p><a>收藏本站</a></p>
                    </div>
                </div>
                <div id="content">
                    <div class="leftContent">
                        <h2>< 文章分类 ></h2>
                        <p>一级分类</p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;⊙&nbsp;二级分类</p>
                        <br>
                    </div>
                    <br>
                    <div class="leftContent">
                        <h2>< 标签搜索 ></h2>
                        <br /><br /><br /><br /><br /></div>
                    <br>
                    <div class="leftContent">
                        <h2>< 最新评论 ><samp> </samp></h2>
                        <p><b>用户昵称：</b>评论内容</p>
                        <br>
                        <a> >>查看全部 </a>
                        <br><br>
                    </div>
                    <br>
                    <div class="leftContent">
                        <h2>< 最近留言 ></h2>
                        <p><b>用户昵称：</b>留言内容</p>
                        <br>
                        <a> >>查看全部 </a>
                        <br><br>
                    </div>
                    <br>
                    <div class="rightContent">@yield('content')</div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript"></script>
    @yield('my-js')
</html>
