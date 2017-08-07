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
use App\ORM\Member;

class ArticleController extends Controller {

    public function articleDetail($article_id) {

        
        //一级分类
        $categoriesFirst = Category::whereNull('parent_id')->get();
        //所有分类
        $categories = Category::all();

        //获取文章标题
        $article = Article::where('id', $article_id)->first();

        //得到文章对应的分类名
        if ($article->category_id != null && $article != '') {
            $article->category = Category::find($article->category_id);
        }
        //文章对应的标签
        if ($article->tag_id != null && $article != '') {
            $article->tag = Tag::find($article->tag_id);
        }
        //文章分类对应的父级分类
        $categoryF = Category::where('id', $article->category->parent_id)->first();

        $articleDetail = ArticleDetail::where('article_id', $article_id)->first();
        $articleComments = Comment::where('article_id', $article_id)->orderBy('created_at', 'desc')->get();
        foreach ($articleComments as $comment) {
            $comment->nickname = Member::find($comment->member_id)->nickname;
        }

        $tags = Tag::all();
        $comments = Comment::all();
        $messages = Message::all();
        
        //取session已登录的访客信息
        $member = session()->get('member', '');
        
        return view('articleDetail')->with('categoriesFirst', $categoriesFirst)
                        ->with('categories', $categories)
                        ->with('article', $article)
                        ->with('categoryF', $categoryF)
                        ->with('articleDetail', $articleDetail)
                        ->with('articleComments', $articleComments)
                        ->with('tags', $tags)
                        ->with('comments', $comments)
                        ->with('messages', $messages)
                ->with('member',$member);
    }

}
