<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ORM\Category;

class IndexController extends Controller
{
    public function getCategoryByParentId($parent_id){
        $categorys= Category::where('parent_id',$parent_id)->get();
        return $categorys;
    }
}
