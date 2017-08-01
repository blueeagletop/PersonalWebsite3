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

class TagController extends Controller
{
    public function tagArticle($tag_id){
        //一级分类
        $categoriesFirst= Category::whereNull('parent_id')->get();
        //所有分类
        $categories= Category::all();
        
        //根据分类id获取文章标题
        $articles= Article::where('tag_id',$tag_id)->orderBy('created_at','desc')->get();
        //文章对应的标签
        foreach ($articles as $article){
            if($article->tag_id !=null && $article != ''){
                $article->tag = Tag::find($article->tag_id);
            }
            if($article->category_id !=null && $article != ''){
                $article->category = Category::find($article->category_id);
            }
        }
        $tag=Tag::find($tag_id);
        
        $tags=Tag::all();
        
        $comments=Comment::all();
        
        $messages=Message::all();
        
        return view('tagArticle')->with('categoriesFirst',$categoriesFirst)
                ->with('categories',$categories)
                ->with('articles',$articles)
                ->with('tag',$tag)
                
//                左侧导航栏
                ->with('tags',$tags)
                ->with('comments',$comments)
                ->with('messages',$messages);
    }
}
