<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ORM\Tag;
use App\Models\M3Result;

class TagController extends Controller
{
    public function tagList() {
        $tags=Tag::where('id', '>', 0)->orderBy('id','desc')->get();
        
        return view('admin.tag')->with('tags',$tags);
    }
    public function addTag() {
        return view('admin.tagAdd');
    }
    public function editTag($tag_id) {
        $tag=Tag::find($tag_id);
        
        return view('admin.tagEdit')->with('tag',$tag);
    }
    
    /****** 操作数据库 ******/
    public function doAddTag(Request $request) {
        $name=$request->input('name','');
        
        $tag=new Tag;
        $tag->name=$name;
        
        $tag->save();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }
    public function doEditTag(Request $request) {
        $name=$request->input('name','');
        $id=$request->input('id','');
        
        $tag= Tag::find($id);
        $tag->name=$name;
        
        $tag->save();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '成功修改';

        return $m3_result->toJson();
    }
    
    public function doDelTag(Request $request) {
        $id=$request->input('id','');
        
        $tag= Tag::find($id);
        
        $tag->delete();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '成功删除';

        return $m3_result->toJson();
    }
    
}
