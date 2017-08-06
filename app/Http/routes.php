<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'View\IndexController@index');
Route::get('/category={category_id}', 'View\CategoryController@categoryArticle');
Route::get('/categoryF={categoryF_id}', 'View\CategoryController@firstCategoryArticle');
Route::get('/article={article_id}', 'View\ArticleController@articleDetail');
Route::get('/tag={tag_id}', 'View\TagController@tagArticle');
Route::get('/register','View\MemberController@register');
Route::get('/login','View\MemberController@login');

Route::group(['prefix'=>'service'],function(){
    Route::get('/validate_code/create','Service\ValidateController@create');
    
//    Route::get('category/parent_id/{parent_id}','Service\IndexController@getCategoryByParentId');
});

Route::group(['prefix'=>'member'],function(){
    Route::get('/','Service\ValidateController@create');
});

/******************  后台管理  ******************/
Route::group(['prefix'=>'admin'],function(){
    Route::get('login','Admin\LoginController@toLogin');
    Route::get('index','Admin\IndexController@index');
    Route::get('welcome','Admin\IndexController@welcome');
    
    Route::get('article','Admin\ArticleController@article');
    Route::get('addArticle','Admin\ArticleController@addArticle');
    Route::get('editArticle={article_id}','Admin\ArticleController@editArticle');
    Route::get('articleDetail={article_id}','Admin\ArticleController@articleDetail');
    
    Route::get('comment','Admin\CommentController@commentList');
    Route::get('editComment={comment_id}','Admin\CommentController@editComment');
    
    Route::get('message','Admin\MessageController@messageList');
    Route::get('editMessage={message_id}','Admin\MessageController@editMessage');
    
    Route::get('category','Admin\CategoryController@category');
    Route::get('addCategory','Admin\CategoryController@addCategory');
    Route::get('editCategory={category_id}','Admin\CategoryController@editCategory');
    
    Route::get('tag','Admin\TagController@tagList');
    Route::get('addTag','Admin\TagController@addTag');
    Route::get('editTag={tag_id}','Admin\TagController@editTag');
    
    Route::get('member','Admin\MemberController@memberList');
    Route::get('addMember','Admin\MemberController@addMember');
    Route::get('editMember={member_id}','Admin\MemberController@editMember');
    Route::get('banMember','Admin\MemberController@banMemberList');
    Route::get('addBanMember','Admin\MemberController@addBanMember');
    Route::get('editBanMember={member_id}','Admin\MemberController@editBanMember');
    
    
    Route::get('admin','Admin\AdminController@adminList');
    Route::get('addAdmin','Admin\AdminController@addAdmin');
    Route::get('editAdmin={admin_id}','Admin\AdminController@editAdmin');
    
    
    /******* 操作数据库 *******/
    Route::group(['prefix'=>'service'],function(){
        Route::post('addArticle','Admin\ArticleController@doAddArticle');
        Route::post('editArticle','Admin\ArticleController@doEditArticle');
        Route::post('delArticle','Admin\ArticleController@doDelArticle');
        
        Route::post('addCategory','Admin\CategoryController@doAddCategory');
        Route::post('editCategory','Admin\CategoryController@doEditCategory');
        Route::post('delCategory','Admin\CategoryController@doDelCategory');
        
        Route::post('addTag','Admin\TagController@doAddTag');
        Route::post('editTag','Admin\TagController@doEditTag');
        Route::post('delTag','Admin\TagController@doDelTag');
        
        Route::post('editComment','Admin\CommentController@doEditComment');
        Route::post('delComment','Admin\CommentController@doDelComment');
        
        Route::post('editMessage','Admin\MessageController@doEditMessage');
        Route::post('delMessage','Admin\MessageController@doDelMessage');
        
        Route::post('addMember','Admin\MemberController@doAddMember');
        Route::post('editMember','Admin\MemberController@doEditMember');
        Route::post('delMember','Admin\MemberController@doDelMember');
        
        Route::post('addBanMember','Admin\MemberController@doAddBanMember');
        Route::post('editBanMember','Admin\MemberController@doEditBanMember');
        Route::post('delBanMember','Admin\MemberController@doDelBanMember');
        
        Route::post('addAdmin','Admin\AdminController@doAddAdmin');
        Route::post('editAdmin','Admin\AdminController@doEditAdmin');
        Route::post('delAdmin','Admin\AdminController@doDelAdmin');
    });
});