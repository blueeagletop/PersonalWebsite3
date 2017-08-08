@extends('master') 

@section('title', "蓝鹰的博客——BlueEagle's boke")

@section('content')

<?php

// 判断是否移动设备访问
function isMobile() {
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return true;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    elseif (isset($_SERVER['HTTP_VIA'])) {
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    // 脑残法，判断手机发送的客户端标志,兼容性差，放到第三步验证
    elseif (isset($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    // 协议法，因为有可能不准确，放到最后判断
    elseif (isset($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    } else {
        return false;
    }
}

//判断PC或移动设备
if (isMobile()) {
    echo "<script language=javascript>";
    echo "document.location='mobile/index'";
    echo "</script>";
} else {
//如果导向当前页面输出这步会陷入无限循环
}
?>

<div class="presentLocation"><p>&nbsp;当前位置&nbsp;：&nbsp;<a href="./">全部文章</a></p></div>
<div class="article">


    @foreach($articles as $ar)
    <br/>
    <h2><a href="article={{$ar->id}}">{{$ar->title}}</a></h2>
    <p><a style="color: #666" href="article={{$ar->id}}">&nbsp;&nbsp;>> 查看详情 </a></p>
    <samp style="color: #666">{{$ar->created_at}}&nbsp;&nbsp;文章分类：{{$ar->category->name}}&nbsp;&nbsp;</samp>

    @if($ar->tag != null)
    <a class="tag">{{$ar->tag->name}}</a>&nbsp;&nbsp;
    @endif

    <hr/>
    @endforeach


    <br><br><br><br><br>

    <div class="footer">
        Copyright@ 蓝鹰&nbsp;&nbsp;|&nbsp;&nbsp;E-mail:blueeagletop@163.com&nbsp;&nbsp;|&nbsp;&nbsp;蓝鹰的个人博客3.0
    </div> 
</div>


@endsection 

@section('my-js')


@endsection 
