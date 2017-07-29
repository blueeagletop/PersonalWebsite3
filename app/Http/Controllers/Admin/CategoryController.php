<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ORM\Category;
use App\Models\M3Result;

class CategoryController extends Controller {

    public function category() {
        $categories = Category::all();
        foreach ($categories as $category) {
            if ($category->parent_id != null && $category != '') {
                $category->parent = Category::find($category->parent_id);
            }
        }

        return view('admin.category')->with('categories', $categories);
    }

    public function addCategory() {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categoryAdd')->with('categories', $categories);
    }
    public function editCategory($category_id){
        $categories = Category::whereNull('parent_id')->get();
        $category= Category::find($category_id);
        $category->parent = Category::find($category->parent_id);
        return view('admin.categoryEdit')->with('categories', $categories)
                ->with('category', $category);
    }

    /*     * ***************************  操作数据库  **************************** */

    public function doAddCategory(Request $request) {
        $name = $request->input('name', '');
        $parent_id = $request->input('parent_id', '');
        $compositor = $request->input('compositor', '');

        $category = new Category;
        $category->name = $name;

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
        $name = $request->input('name', '');
        $parent_id = $request->input('parent_id', '');
        $compositor = $request->input('compositor', '');

        $category = Category::find($id);
        $category->name = $name;

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
