<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ORM\Category;
use App\ORM\Member;

class MemberController extends Controller
{
    public function index() {
        $nav_categories= Category::whereNull('parent_id')->get();
        
        return view('mobile.member')->with('nav_categories',$nav_categories);
    }
}
