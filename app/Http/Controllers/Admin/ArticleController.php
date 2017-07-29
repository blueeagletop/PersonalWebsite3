<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\M3Result;
use App\ORM\Article;
use App\ORM\ArticleDetail;
use App\ORM\Category;
use App\ORM\Tag;

class ArticleController extends Controller
{
    public function article(){
        $articles= Article::all();
        foreach ($articles as $article){
            $article->category = Category::find($article->category_id)->name;
            $article->tag = Tag::find($article->tag_id)->name;
        }
        return view('admin.article')->with('articles',$articles);
    }
    public function addArticle(){
        $categories= Category::whereNotNull('parent_id')->get();
        
        return view('admin.articleAdd')->with('categories',$categories);
    }
    public function editArticle(){
        return view('admin.article');
    }
    
    /*********** 操作数据库 ***********/
    public function doAddArticle(Request $request){
        $title = $request->input('title', '');
        $category_id = $request->input('category_id', '');
        $tag_name = $request->input('tag', '');
        $top = $request->input('top', '');
        $detail= $request->input('detail','');
        
        $article= new Article;
        $article->title=$title;
        $article->category_id=$category_id;
        $article->top=$top;
        
        $tags=Tag::where('name',$tag_name)->get();
        if($tags == null){
            $newTag=new Tag;
            $newTag->name=$tag_name;
            $newTag->save();
        }else{
            foreach($tags as $tag){
                $article->tag_id = $tag->id;
            }
        }
        $article->save();
        
        $articleDetail=new ArticleDetail;
        $articleDetail->detail=$detail;
        $articleDetail->article_id=$article->id;
        $articleDetail->save();
        
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }
}
