<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ORM\Category;
use App\Models\M3Result;

class CategoryController extends Controller {

    public function category() {
        $categorys = Category::all();
        foreach ($categorys as $category) {
            if ($category->parent_id != null && $category != '') {
                $category->parent = Category::find($category->parent_id);
            }
        }

        return view('admin.category')->with('categorys', $categorys);
    }

    public function addCategory() {
        $categorys = Category::whereNull('parent_id')->get();
        return view('admin.addCategory')->with('categorys', $categorys);
    }
    public function editCategory($category_id){
        $categorys = Category::whereNull('parent_id')->get();
        $category= Category::find($category_id);
        $category->parent = Category::find($category->parent_id);
        return view('admin.editCategory')->with('categorys', $categorys)
                ->with('category', $category);
    }

    /*     * ***************************  操作数据库  **************************** */

    public function doAddCategory(Request $request) {
        $title = $request->input('title', '');
        $parent_id = $request->input('parent_id', '');
        $compositor = $request->input('compositor', '');

        $category = new Category;
        $category->title = $title;

        if ($parent_id == null) {
            $category->parent_id = null;
        } else {
            $category->parent_id = $parent_id;
        }
        
        if ($compositor == null) {
            $category->compositor = null;
        } else {
            $category->compositor = $compositor;
        }
        
        $category->save();

        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }
    
    public function doEditCategory(Request $request) {
        $id=$request->input('id', '');
        $title = $request->input('title', '');
        $parent_id = $request->input('parent_id', '');
        $compositor = $request->input('compositor', '');

        $category = Category::find($id);
        $category->title = $title;

        if ($parent_id == null) {
            $category->parent_id = null;
        } else {
            $category->parent_id = $parent_id;
        }
        
        if ($compositor == null) {
            $category->compositor = null;
        } else {
            $category->compositor = $compositor;
        }
        
        $category->save();

        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }
    
    public function doDelCategory(Request $request) {
        $id = $request->input('id', '');
        Category::find($id)->delete();

        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '成功删除';

        return $m3_result->toJson();
    }
}
