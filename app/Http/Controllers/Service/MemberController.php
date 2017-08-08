<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\M3Result;
use App\ORM\Member;
use App\ORM\ValidateEmail;
use App\Models\M3Email;
use App\Tool\UUID;
use Mail;

class MemberController extends Controller {

    public function register(Request $request) {
        $nickname=$request->input('nickname','');
        $username=$request->input('username','');
        $email = $request->input('email', '');
        $password = $request->input('password', '');
        $confirm = $request->input('confirm', '');
        $validate_code = $request->input('validate_code', '');

        $m3_result = new M3Result;
        
        if ($email == '') {
            $m3_result->status = 1;
            $m3_result->message = '邮箱不能为空';
            return $m3_result->toJson();
        }
        if ($password == '' || strlen($password) < 6) {
            $m3_result->status = 2;
            $m3_result->message = '密码不少于6位';
            return $m3_result->toJson();
        }
        if ($confirm == '' || strlen($confirm) < 6) {
            $m3_result->status = 3;
            $m3_result->message = '确认密码不少于6位';
            return $m3_result->toJson();
        }
        if ($password != $confirm) {
            $m3_result->status = 4;
            $m3_result->message = '两次密码不相同';
            return $m3_result->toJson();
        }

        if ($validate_code == '' || strlen($validate_code) != 4) {
            $m3_result->status = 6;
            $m3_result->message = '验证码为4位';
            return $m3_result->toJson();
        }

        $validate_code_session = $request->session()->get('validate_code', '');
        if ($validate_code_session != $validate_code) {
            $m3_result->status = 8;
            $m3_result->message = '验证码不正确';
            return $m3_result->toJson();
        }
        
        $member = Member::where('email', $email)->first();
        if ($member != null) {
            $m3_result->status = 9;
            $m3_result->message = '邮箱['.$email.']'.'已被注册';
            return $m3_result->toJson();
        }
        $member = Member::where('nickname', $nickname)->first();
        if ($member != null) {
            $m3_result->status = 10;
            $m3_result->message = '称呼【'.$nickname.'】已存在，请填写其他称呼';
            return $m3_result->toJson();
        }
        $member = Member::where('username', $username)->first();
        if ($member != null) {
            $m3_result->status = 11;
            $m3_result->message = '用户名【'.$username.'】已存在，请填写其他用户名';
            return $m3_result->toJson();
        }
        
        $member = new Member;
        $member->nickname=$nickname;
        $member->username=$username;
        $member->email = $email;
        $member->password = md5($password);
        $member->status = 2;
        $member->save();
        
        $request->session()->put('member',$member);
        
        $uuid = UUID::create();

        $m3_email = new M3Email;
        $m3_email->to = $email;
        $m3_email->cc = 'blueeaglefly@163.com';
        $m3_email->subject = '【BlueEagle.top】邮箱验证';
        $m3_email->content = '请于1小时点击该链接完成验证. http://www.blueeagle.top/service/validate_email'
                . '?member_id=' . $member->id
                . '&code=' . $uuid;
        $validateEmail = ValidateEmail::where('member_id', $member->id)->first();
        if ($validateEmail == null) {
            $validateEmail = new ValidateEmail;
        }
        $validateEmail->member_id = $member->id;
        $validateEmail->code = $uuid;
        $validateEmail->deadline = date('Y-m-d H-i-s', time() + 60 * 60);//一小时内有效
        $validateEmail->save();

        Mail::send('email_register', ['m3_email' => $m3_email], function ($m) use ($m3_email) {
            // $m->from('hello@app.com', 'Your Application');
            $m->to($m3_email->to, '尊敬的用户')
                    ->cc($m3_email->cc)
                    ->subject($m3_email->subject);
        });

        $m3_result->status = 0;
        $m3_result->message = '注册成功';
        return $m3_result->toJson();
    }
    
    public function login(Request $request){
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
    $member=null;
    if(strpos($username,'@')==true){
        $member= Member::where('email',$username)->first();
    }else{
        $member= Member::where('username',$username)->first();
    }
    if($member==null){
        $m3_result->status=2;
        $m3_result->message="该用户不存在";
        return $m3_result->toJson();
    }else{
        if(md5($password) != $member->password){
            $m3_result->status=3;
            $m3_result->message="密码不正确";
            return $m3_result->toJson();
        }
    }
    $request->session()->put('member',$member);
    $m3_result->status=0;
    $m3_result->message="登录成功";
    return $m3_result->toJson();
    }
    
    public function logout(){
        session()->put('member',null);
        return view('login');
    }
}
