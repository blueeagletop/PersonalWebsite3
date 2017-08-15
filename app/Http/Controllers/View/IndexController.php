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

class IndexController extends Controller
{
    public function index(){
        //一级分类
        $categoriesFirst= Category::whereNull('parent_id')->get();
        //所有分类
        $categories= Category::all();
        
        //获取全部文章标题
        $articles= Article::where('status', 1)->orderBy('created_at','desc')->paginate(10);
        
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
        
        $comments = Comment::where('id','>',0)->orderBy('created_at', 'desc')->paginate(5);
        foreach ($comments as $comment){
            $comment->nickname = Member::find($comment->member_id)->nickname;
        }
        $messages = Message::where('id','>',0)->orderBy('created_at', 'desc')->paginate(5);
        foreach ($messages as $message){
            $message->nickname = Member::find($message->member_id)->nickname;
        }
        
        return view('index')->with('categoriesFirst',$categoriesFirst)
                ->with('categories',$categories)
                ->with('articles',$articles)
                ->with('tags',$tags)
                ->with('comments',$comments)
                ->with('messages',$messages);
    }
}
