<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\M3Result;
use App\ORM\Message;
use App\ORM\Member;

class MessageController extends Controller
{
    public function messageList() {
        $messages= Message::all();
        
        foreach($messages as $message){
            $message->member_nickname= Member::find($message->member_id)->nickname;
        }
        
        return view('admin.message')->with('messages',$messages);
    }
    
    public function editMessage($message_id) {
        $message= Message::find($message_id);
        $message->member_nickname= Member::find($message->member_id)->nickname;
        
        return view('admin.messageEdit')->with('message',$message);
    }
    
    /************* 操作数据库 ************/
    public function doEditMessage(Request $request) {
        $id=$request->input('id','');
        $detail=$request->input();
        
    }
    
}
