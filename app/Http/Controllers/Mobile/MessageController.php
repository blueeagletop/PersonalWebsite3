<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ORM\Member;
use App\ORM\Message;
use App\ORM\Category;

class MessageController extends Controller
{
    public function messageList() {
        $messages= Message::where('id','>',0)->orderBy('top','desc')->orderBy('created_at','desc')->get();
        
        foreach($messages as $message){
            $message->nickname= Member::find($message->member_id)->nickname;
        }
        
        $nav_categories= Category::whereNull('parent_id')->get();
        
        return view('mobile.message')->with('messages',$messages)
                ->with('nav_categories',$nav_categories);
    }
}
