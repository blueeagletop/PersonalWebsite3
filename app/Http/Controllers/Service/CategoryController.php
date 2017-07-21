<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\M3Result;
use App\ORM\Category;

class CategoryController extends Controller
{
    
    
    /************ Service ***********/
    public function addCategory(Request $request){
        $title=$request->input('title','');
        $compositor=$request->input('compositor','');
        $parent_id=$request->input('parent_id','');

        $category=new Category;
        $category->title=$title;
        $category->compositor=$compositor;
        if($parent_id != ''){
            $category->parent_id=$parent_id;
        }
        $category->save();
        
        $m3_result= new M3Result;
        $m3_result->status=0;
        $m3_result->message='添加成功';
        
        return $m3_result->toJson();
    }
}
