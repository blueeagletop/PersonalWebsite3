<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\M3Result;
use App\ORM\Member;

class MemberController extends Controller
{
    public function memberList() {
        $members= Member::all();
        
        return view('admin.member')->with('members',$members);
    }
    public function addMember(){
        return view('admin.memberAdd');
    }
    public function editMember($member_id){
        $member= Member::find($member_id);
        
        return view('admin.memberEdit')->with('member',$member);
    }
    
    public function banMemberList() {
        $members= Member::where('status',0)->get();
        
        return view('admin.memberBan')->with('members',$members);
    }
    public function addBanMember(){
        return view('admin.memberAdd');
    }
    public function editBanMember($member_id){
        $member= Member::find($member_id);
        
        return view('admin.memberEdit')->with('member',$member);
    }
    
    /********** 操作数据库 *********/
    public function doAddMember(Request $request){
        $nickname=$request->input('nickname','');
        $username=$request->input('username','');
        $password=$request->input('password','');
        $email=$request->input('email','');
        $qq=$request->input('qq','');
        $weixin=$request->input('weixin','');
        
        $member=new Member;
        $member->nickname=$nickname;
        $member->username=$username;
        $member->password= md5($password);
        $member->email=$email;
        $member->qq=$qq;
        $member->weixin=$weixin;
        $member->status='1';
        
        $member->save();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }
    public function doEditMember(Request $request){
        $id=$request->input('id','');
        $nickname=$request->input('nickname','');
        $username=$request->input('username','');
        $password=$request->input('password','');
        $email=$request->input('email','');
        $qq=$request->input('qq','');
        $weixin=$request->input('weixin','');
        $status=$request->input('status','');
        
        $member=Member::find($id);
        $member->nickname=$nickname;
        $member->username=$username;
        $member->password= md5($password);
        $member->email=$email;
        $member->qq=$qq;
        $member->weixin=$weixin;
        $member->status=$status;
        $member->save();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '修改成功';

        return $m3_result->toJson();
    }
    public function doDelMember(Request $request) {
        $id=$request->input('id','');
        
        $member= Member::find($id);
        $member->delete();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '成功删除';

        return $m3_result->toJson();
    }
    
    public function doAddBanMember(Request $request){
        $nickname=$request->input('nickname','');
        $username=$request->input('username','');
        $password=$request->input('password','');
        $email=$request->input('email','');
        $qq=$request->input('qq','');
        $weixin=$request->input('weixin','');
        
        $member=new Member;
        $member->nickname=$nickname;
        $member->username=$username;
        $member->password= md5($password);
        $member->email=$email;
        $member->qq=$qq;
        $member->weixin=$weixin;
        $member->status='1';
        
        $member->save();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }
    public function doEditBanMember(Request $request){
        $id=$request->input('id','');
        $nickname=$request->input('nickname','');
        $username=$request->input('username','');
        $password=$request->input('password','');
        $email=$request->input('email','');
        $qq=$request->input('qq','');
        $weixin=$request->input('weixin','');
        $status=$request->input('status','');
        
        $member=Member::find($id);
        $member->nickname=$nickname;
        $member->username=$username;
        $member->password= md5($password);
        $member->email=$email;
        $member->qq=$qq;
        $member->weixin=$weixin;
        $member->status=$status;
        $member->save();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '修改成功';

        return $m3_result->toJson();
    }
    public function doDelBanMember(Request $request) {
        $id=$request->input('id','');
        
        $member= Member::find($id);
        $member->delete();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '成功删除';

        return $m3_result->toJson();
    }
    
}
