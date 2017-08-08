<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\M3Result;
use App\ORM\Admin;

class LoginController extends Controller
{
    public function toLogin(){
        return view('admin.login');
    }
    public function doLogin(Request $request){
    $username = $request->get('username', '');
    $password = $request->get('password', '');
    $validate_code = $request->get('validate_code', '');

    $m3_result=new M3Result();
    //校验
    //...
    
    //判断
    $validate_code_session = $request->session()->get('validate_code');
    if($validate_code != $validate_code_session){
        $m3_result->status=1;
        $m3_result->message="验证码不正确";
        return $m3_result->toJson();
    }
    $admin=null;
    $admin= Admin::where('username',$username)->first();
    if($admin==null){
        $m3_result->status=2;
        $m3_result->message="该用户不存在";
        return $m3_result->toJson();
    }else{
        if(md5($password) != $admin->password){
            $m3_result->status=3;
            $m3_result->message="密码不正确";
            return $m3_result->toJson();
        }
    }
    $request->session()->put('admin',$admin);
    
    $m3_result->status=0;
    $m3_result->message="登录成功";
    return $m3_result->toJson();
    }
    
    public function logout(){
        session()->put('admin',null);
        return view('admin.login');
    }
}
