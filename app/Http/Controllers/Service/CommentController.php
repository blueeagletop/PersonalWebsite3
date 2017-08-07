<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\M3Result;
use App\ORM\Comment;

class CommentController extends Controller
{
    public function addComment(Request $request) {
        $member_id = $request->input('member_id',''); 
        $article_id = $request->input('article_id','');
        $detail = $request->input('detail','');
        $validate_code = $request->input('validate_code','');
        
        //验证码
        $validate_code_session = $request->session()->get('validate_code');
        if ($validate_code != $validate_code_session) {
            $m3_result = new M3Result;
            $m3_result->status = 1;
            $m3_result->message = "验证码不正确";
            return $m3_result->toJson();
        }
        
        $comment=new Comment;
        $comment->member_id=$member_id;
        $comment->article_id=$article_id;
        $comment->detail=$detail;
        $comment->save();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '成功评论';

        return $m3_result->toJson();
    }
}
