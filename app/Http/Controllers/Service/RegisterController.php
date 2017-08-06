<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\M3Result;
use App\ORM\ValidateEmail;
use App\Tool\UUID;
use App\ORM\Member;

class RegisterController extends Controller {

    public function register(Request $request) {
        $email = $request->input('email', '');
        $phone = $request->input('phone', '');
        $password = $request->input('password', '');
        $confirm = $request->input('confirm', '');
        $phone_code = $request->input('phone_code', '');
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
        if ($member == null) {
            $member = new Member;
        }
        $member->email = $email;
        $member->password = md5($password);
        $member->save();

        $uuid = UUID::create();

        $m3_email = new M3Email;
        $m3_email->to = $email;
        $m3_email->cc = '869546851@qq.com';
        $m3_email->subject = '【蓝鹰书城】邮箱验证';
        $m3_email->content = '请于24小时点击该链接完成验证. http://localhost/laravel52/public/service/validate_email'
                . '?member_id=' . $member->id
                . '&code=' . $uuid;
        $tempEmail = TempEmail::where('member_id', $member->id)->first();
        if ($tempEmail == null) {
            $tempEmail = new TempEmail;
        }
        $tempEmail->member_id = $member->id;
        $tempEmail->code = $uuid;
        $tempEmail->deadline = date('Y-m-d H-i-s', time() + 24 * 60 * 60);
        $tempEmail->save();

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

}
