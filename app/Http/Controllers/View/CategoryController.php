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
use App\ORM\Member;

class CategoryController extends Controller
{
    public function categoryArticle($category){
        //一级分类
        $categoriesFirst= Category::whereNull('parent_id')->get();
        //所有分类
        $categories= Category::all();
        
        //根据分类id获取文章标题
        $articles= Article::where([
            'category_id'=>$category,
            'status'=>'1'
            ])->orderBy('created_at','desc')->get();
        //文章对应的标签
        foreach ($articles as $article){
            if($article->tag_id !=null && $article != ''){
                $article->tag = Tag::find($article->tag_id);
            }
        }
        
        //得到分类id对应的对象
        $category= Category::where('id',$category)->first();
        //得到当前分类的父id的对象
        $categoryF= Category::where('id',$category->parent_id)->first();
        
        $tags=Tag::all();
        
        $comments = Comment::where('id','>',0)->orderBy('created_at', 'desc')->paginate(5);
        foreach ($comments as $comment){
            $comment->nickname = Member::find($comment->member_id)->nickname;
        }
        $messages = Message::where('id','>',0)->orderBy('created_at', 'desc')->paginate(5);
        foreach ($messages as $message){
            $message->nickname = Member::find($message->member_id)->nickname;
        }
        
        return view('categoryArticle')->with('categoriesFirst',$categoriesFirst)
                ->with('categories',$categories)
                ->with('articles',$articles)
                ->with('category',$category)
                ->with('categoryF',$categoryF)
                ->with('tags',$tags)
                ->with('comments',$comments)
                ->with('messages',$messages);
    }
    
    public function firstCategoryArticle($categoryF_id){
        //一级分类
        $categoriesFirst= Category::whereNull('parent_id')->get();
        //所有分类
        $categories= Category::all();
        
        //待完成功能：根据父类ID得到子类id，然后查找文章
        //根据分类id获取文章标题
        $articles= Article::where('category_id',$category)->get();
        //文章对应的标签
        foreach ($articles as $article){
            if($article->tag_id !=null && $article != ''){
                $article->tag = Tag::find($article->tag_id);
            }
        }
        
        //得到当前分类的父id的对象
        $categoryF= Category::where('id',$categoryF_id)->first();
        
        $tags=Tag::all();
        
        $comments=Comment::all();
        
        $messages=Message::all();
        
        return view('categoryArticle')->with('categoriesFirst',$categoriesFirst)
                ->with('categories',$categories)
                ->with('articles',$articles)
                ->with('category',$category)
                ->with('categoryF',$categoryF)
                ->with('tags',$tags)
                ->with('comments',$comments)
                ->with('messages',$messages);
    }
}
