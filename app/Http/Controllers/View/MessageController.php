<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ORM\Category;
use App\ORM\Tag;
use App\ORM\Member;
use App\ORM\Comment;
use App\ORM\Message;

class MessageController extends Controller {

    public function messageList() {
        //一级分类
        $categoriesFirst = Category::whereNull('parent_id')->get();
        //所有分类
        $categories = Category::all();

        $tags = Tag::all();
        $comments = Comment::all();
        $messages = Message::all();

        $allMessages = Message::where('id','>',0)->orderBy('top','desc')->orderBy('created_at','desc')->get();

        foreach($allMessages as $message) {
            $message->nickname= Member::find($message->member_id)->nickname;
        }
        
        //取session已登录的访客信息
        $member = session()->get('member', '');
        
        return view('message')->with('categoriesFirst', $categoriesFirst)
                        ->with('categories', $categories)
                        ->with('tags', $tags)
                        ->with('comments', $comments)
                        ->with('messages', $messages)
                        ->with('allMessages', $allMessages)
                ->with('member',$member);
    }

}
