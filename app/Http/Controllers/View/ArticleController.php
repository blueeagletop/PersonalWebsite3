<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ORM\Category;
use App\ORM\Article;
use App\ORM\ArticleDetail;
use App\ORM\Tag;
use App\ORM\Comment;
use App\ORM\Message;

class ArticleController extends Controller
{
    public function detail($article_id){
        //一级分类
        $categorysFirst= Category::whereNull('parent_id')->get();
        //所有分类
        $categorys= Category::all();
        
        //获取文章标题
        $article= Article::where('id',$article_id)->first();
        
        //得到文章对应的分类名
        if($article->category_id !=null && $article != ''){
            $article->category = Category::find($article->category_id);
        }
        //文章对应的标签
        if($article->tag_id !=null && $article != ''){
            $article->tag = Tag::find($article->tag_id);
        }
        //文章分类对应的父级分类
        $categoryF= Category::where('id',$article->category->parent_id)->first();
        
        $detail= ArticleDetail::where('title_id',$article_id)->first();
        
        $tags=Tag::all();
        $comments=Comment::all();
        $messages=Message::all();
        
        return view('articleDetail')->with('categorysFirst',$categorysFirst)
                ->with('categorys',$categorys)
                ->with('article',$article)
                ->with('categoryF',$categoryF)
                ->with('detail',$detail)
                ->with('tags',$tags)
                ->with('comments',$comments)
                ->with('messages',$messages);
    }
}