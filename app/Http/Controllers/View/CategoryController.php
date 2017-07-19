<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ORM\ArticleTitle;

class CategoryController extends Controller
{
    public function categoryArticle($category){
        $articles= ArticleTitle::where('cId',$category)->get();
        return view('categoryArticle')->with('articles',$articles);
    }
}
