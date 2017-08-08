<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ORM\Member;
use App\ORM\Comment;
use App\ORM\Message;

class MemberController extends Controller
{
    public function register() {
        return view('register');
    }
    public function login() {
        return view('login');
    }
    public function index(Request $request) {
        $member = $request->session()->get('member');
        $comments = Comment::where('member_id',$member->id)->orderBy('created_at','desc')->get();
        $messages = Message::where('member_id',$member->id)->orderBy('created_at','desc')->get();
        
        return view('member.index')->with('member',$member)
                ->with('comments',$comments)
                ->with('messages',$messages);
    }
    public function registerNotice() {
        return view('registerNotice');
    }
}
