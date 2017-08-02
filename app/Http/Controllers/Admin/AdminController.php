<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\M3Result;
use App\ORM\Admin;

class AdminController extends Controller
{
    public function adminList() {
        $admins= Admin::all();
        
        return view('admin.admin')->with('admins',$admins);
    }
    public function addAdmin() {
        return view('admin.adminAdd');
    }
    public function editAdmin($admin_id) {
        $admin= Admin::find($admin_id);
        
        return view('admin.adminEdit')->with('admin',$admin);
    }
    
    /***** 操作数据库 *****/
    public function doAddAdmin(Request $request) {
        $username= $request->input('username','');
        $password= $request->input('password','');
        $email=$request->input('email','');
        $phone=$request->input('phone','');
        
        $admin=new Admin;
        $admin->username=$username;
        $admin->password= md5($password);
        $admin->email=$email;
        $admin->phone=$phone;
        
        $admin->save();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }
    
    public function doEditAdmin(Request $request) {
        $id=$request->input('id','');
        $username= $request->input('username','');
        $password= $request->input('password','');
        $email=$request->input('email','');
        $phone=$request->input('phone','');
        
        $admin=Admin::find($id);
        $admin->username=$username;
        $admin->password= md5($password);
        $admin->email=$email;
        $admin->phone=$phone;
        
        $admin->save();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '成功修改';

        return $m3_result->toJson();
    }
    public function doDelAdmin(Request $request) {
        $id=$request->input('id','');
        
        $admin=Admin::find($id);
        
        $admin->delete();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '成功修改';

        return $m3_result->toJson();
    }
    
    
}
