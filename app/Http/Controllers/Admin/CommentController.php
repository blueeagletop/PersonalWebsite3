<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\M3Result;
use App\ORM\Comment;
use App\ORM\Article;
use App\ORM\Member;

class CommentController extends Controller
{
    public function commentList() {
        $comments= Comment::all();
        foreach($comments as $comment){
            $comment->article_title=Article::find($comment->article_id)->title;
            $comment->member_nickname= Member::find($comment->member_id)->nickname;
        }
        
        return view('admin.comment')->with('comments',$comments);
    }
    public function editComment($comment_id) {
        $comment= Comment::find($comment_id);
        $comment->article_title=Article::find($comment->article_id)->title;
        $comment->member_nickname= Member::find($comment->member_id)->nickname;
        
        return view('admin.commentEdit')->with('comment',$comment);
    }
    
    /************ 操作数据库 ************/
    public function doEditComment(Request $request) {
        $id=$request->input('id','');
        $detail=$request->input('detail','');
        
        $comment= Comment::find($id);
        $comment->detail=$detail;
        
        $comment->save();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '修改成功';

        return $m3_result->toJson();
    }
    
    public function doDelComment(Request $request) {
        $id=$request->input('id','');
        
        $comment= Comment::find($id);
        
        $comment->delete();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '成功删除';

        return $m3_result->toJson();
    }
    
}
