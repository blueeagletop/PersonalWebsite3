@extends('admin.master')

@section('title','蓝鹰的博客——管理员后台')

@section('content')
<div class="pd-30">
	<p class="f-20 text-success">欢迎登录 < 蓝鹰的博客 > <span class="f-14">管理员后台</span></p>
	<p>以下是本项目的一些重要信息</p>
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
			<tr>
				<th colspan="2" scope="col">项目信息</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>开发语言</td>
				<td>PHP+MySQL</td>
			</tr>
			<tr>
				<td>所用到的框架</td>
				<td>laravel框架、后端H-ui.Admin框架</td>
			</tr>
			<tr>
				<td>开发环境</td>
				<td>WAMP</td>
			</tr>
			<tr>
				<td>适用环境</td>
				<td>PHP5.6版本以上</td>
			</tr>
			<tr>
				<td>上线前请查看</td>
				<td>开发文档.html</td>
			</tr>
			<tr>
				<td>开发软件环境</td>
				<td>NetBeans IDE8.2</td>
			</tr>
			<tr>
				<td>开发员</td>
				<td>BlueEagle</td>
			</tr>
			<tr>
				<td>开发员网站</td>
				<td>www.blueeagle.top</td>
			</tr>
			<tr>
				<td>开发员联系方式</td>
				<td>blueeagletop@163.com</td>
			</tr>
		</tbody>
	</table>
        <footer class="footer mt-20">
	<div class="container">
		<p>感谢jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch<br>
			Copyright &copy;2015-2017 H-ui.admin v3.0 All Rights Reserved.<br>
			本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持</p>
	</div>
</footer>
</div>
@endsection

@section('my-js')

@endsection