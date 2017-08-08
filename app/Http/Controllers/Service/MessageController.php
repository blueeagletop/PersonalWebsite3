<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\M3Result;
use App\ORM\Message;

class MessageController extends Controller
{
    public function addMessage(Request $request) {
        $validate_code=$request->input('validate_code','');
        $title=$request->input('title','');
        $detail=$request->input('detail','');
        
        //验证码
        $validate_code_session = $request->session()->get('validate_code');
        if ($validate_code != $validate_code_session) {
            $m3_result = new M3Result;
            $m3_result->status = 1;
            $m3_result->message = "验证码不正确";
            return $m3_result->toJson();
        }
        
        //取session已登录的访客信息
        $member = session()->get('member', '');
        
        $message=new Message;
        $message->member_id=$member->id;
        $message->title=$title;
        $message->detail=$detail;
        $message->save();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '留言成功';

        return $m3_result->toJson();
    }
}
