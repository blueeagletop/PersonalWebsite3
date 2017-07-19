<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\ORM\Category;


class CategoryController extends Controller
{
    public function category(){
        $categorys= Category::all();
        foreach ($categorys as $category){
            if($category->parent_id !=null && $category != ''){
                $category->parent = Category::find($category->parent_id);
            }
        }
        
        return view('admin.category')->with('categorys',$categorys);
    }    
}
