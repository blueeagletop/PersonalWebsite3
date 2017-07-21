<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ORM\Category;
use App\ORM\Article;
use App\ORM\Tag;
use App\ORM\Comment;
use App\ORM\Message;

class IndexController extends Controller
{
    public function index(){
        //一级分类
        $categorysFirst= Category::whereNull('parent_id')->get();
        //所有分类
        $categorys= Category::all();
        
        //获取全部文章标题
        $articles= Article::all();
        
        foreach ($articles as $article){
            //得到文章对应的分类名
            if($article->category_id !=null && $article != ''){
                $article->category = Category::find($article->category_id);
            }
            //文章对应的标签
            if($article->tag_id !=null && $article != ''){
                $article->tag = Tag::find($article->tag_id);
            }
        }
        
        $tags=Tag::all();
        
        $comments=Comment::all();
        
        $messages=Message::all();
        
        return view('index')->with('categorysFirst',$categorysFirst)
                ->with('categorys',$categorys)
                ->with('articles',$articles)
                ->with('tags',$tags)
                ->with('comments',$comments)
                ->with('messages',$messages);
    }
}
