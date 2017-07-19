<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ORM\Category;
use App\ORM\ArticleTitle;
use App\ORM\Tag;
use App\ORM\Comment;
use App\ORM\Message;

class IndexController extends Controller
{
    public function index($category){
        $categorysFirst= Category::whereNull('parent_id')->get();
        $categorys= Category::all();
        
        $articles= ArticleTitle::where('cId',$category)->get();
        $category= Category::where('id',$category)->first();
        $categoryF= Category::where('id',$category->parent_id)->first();
        
        $tags=Tag::all();
        
        $comments=Comment::all();
        
        $messages=Message::all();
        
        return view('index')->with('categorysFirst',$categorysFirst)
                ->with('categorys',$categorys)
                ->with('articles',$articles)
                ->with('category',$category)
                ->with('categoryF',$categoryF)
                ->with('tags',$tags)
                ->with('comments',$comments)
                ->with('messages',$messages);
    }
}
