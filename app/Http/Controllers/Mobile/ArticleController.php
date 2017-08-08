<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ORM\Article;
use App\ORM\ArticleDetail;
use App\ORM\Category;
use App\ORM\Comment;
use App\ORM\Member;

class ArticleController extends Controller
{
    public function articleList(){
        $articles= Article::where('id','>',0)->orderBy('created_at','desc')->get();
        
        foreach($articles as $article){
            $article->category= Category::find($article->category_id)->name;
        }
        
        $nav_categories= Category::whereNull('parent_id')->get();
        
        return view('mobile.index')->with('articles',$articles)
                ->with('nav_categories',$nav_categories);
    }
    
    public function categoryArticle($category_id){
        $categories= Category::where('parent_id',$category_id)->get();
        
        $arr = array("");
        foreach ($categories as $category){
            $arr_category = array("$category->id");
            $arr= array_merge($arr_category,$arr);
        }
        
        $articles= Article::whereIn('category_id',$arr)->orderBy('created_at','desc')->get();
        
        foreach($articles as $article){
            $article->category= Category::find($article->category_id)->name;
        }
        
        $nav_categories= Category::whereNull('parent_id')->get();
        
        return view('mobile.categoryArticle')->with('articles',$articles)
                ->with('nav_categories',$nav_categories);
    }
    
    public function articleDetail($article_id){
        $nav_categories= Category::whereNull('parent_id')->get();
        
        $article= Article::find($article_id);
        $article->category= Category::find($article->category_id)->name;
        $article->detail= ArticleDetail::where('article_id',$article_id)->first()->detail;
        
        $comments= Comment::where('article_id',$article->id)->orderBy('created_at','desc')->get();
        foreach($comments as $comment){
            $comment->nickname= Member::find($comment->member_id)->nickname;
        }
        
        return view('mobile.articleDetail')->with('nav_categories',$nav_categories)
                ->with('article',$article)
                ->with('comments',$comments);
    }
    
}
